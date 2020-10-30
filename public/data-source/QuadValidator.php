<?php
use Arrayy\Arrayy as Arr;

class QuadValidator
{
    #
    # instânciação a classe QuadValidator a partir dos dados fornecidos
    #
    # reference
    # array $data:
    # workflow 
    #
    #   db - ligação à base de dados
    #   reference - referência da validação a aplicar
    #   action - ação a executar pelo controlador (create, update, ...)
    #   record - dados do registo
    #   workflow - informação do workflow a utilizar
    #
    function __construct($db, $reference, $action, $data, $workflow)
    {
        # ligação à base de dados
        $this->db = $db;

        # referência da validação
        $this->reference = $reference;
        $this->action = $action;
        $this->record = $data;
        $this->ini_per_assid = '';
        $this->fim_per_assid = '';
        
        # específicos do módulo de férias
        $this->meios_dias_ferias = '';
        $this->ferias_neg = 'N';
        $this->limite_ferias_neg  = '';

        # específicos do módulo de descanso compensatório
        $this->dc_neg = 'N';
        $this->limite_dc_neg  = '';

        # específicos do módulo de adaptabilidade
        $this->adap_neg = 'N';
        $this->limite_adap_neg  = '';
        
        # inicialização do workflow para puder antecipar o estado dos registos
        $this->wkf = '';
        $this->wkfMode = '';
        $this->wkfUpdate = '';
        
        if ($workflow) {
            # lê o modo de workflow(wkfMode) (postponed ou optimistic)
            $this->wkfMode = '';
            if (array_key_exists('mode',(array)$workflow)) {
                $this->wkfMode = $workflow['mode'];
            }
            $this->wkfUpdate = '';
            if (array_key_exists('update',(array)$workflow)) {
                $this->wkfUpdate = $workflow['update'];
            }

            # se postponed => utiliza class WorkFlowPostPoned
            if ($this->wkfMode === 'postponed') {
                require_once 'WorkFlowPostPoned.php';
                $this->wkf = new WorkFlowPostPoned(
                    @$_SESSION["nome"],
                    @$_SESSION["perfil"]
                );
                # se optimistic => utiliza class WorkFlowOptimistic
            } elseif ($this->wkfMode === 'optimistic') {
                require_once 'WorkFlowOptimistic.php';
                $this->wkf = new WorkFlowOptimistic(
                    @$_SESSION["nome"],
                    @$_SESSION["perfil"]
                );
            }
        }
        
    }

    # efetua o tratamento da mensagem de erro e
    # executa o ROLBACK da operação devolvendo o erro em formato json
    public static function getErrors($e, $transaction = false)
    {
        $msg = $e->getMessage();
        if ($msg != '') {
            //todo format to development mode or production mode...
            $msg = str_replace('"', "", $msg);
            $msg = str_replace("'", "", $msg);
            $pos = strpos($msg, "EOM");
            if ($pos) {
                $msg = substr($msg, 0, $pos);
            }

            $dadosOut = array(
                "error" => $msg
            );
            if ($transaction !== false) {
                oci_rollback($this->db);
            }
            echo json_encode($dadosOut);
            die();
        }
    }
    
    /*
     * Procura em $arr (regras aplicáveis) a propriedade $nome com o valor $valor
     * Se a condição existir, as regras são filtradas por essa condição.
     * Caso não se aplique, devolve o conjunto de regras inicial
     */
    function aplica_filtro($nome, $valor, $arr) {
        $aux = $arr->filterBy($nome,$valor);
        if ($aux->count() > 0 ) {
            return $aux;
        } else {
            return $arr;
        }
    }    
    
    /*
     * Trata das mensagems de erro a reporta para a instância
     */
    function setErrorMessage($cod, &$msg, $per_assid = '', $id_rule = '') {
        global $ui_prv_value, $ui_during, $ui_nxt_value, 
               $msg_validator_out_of_bound, $msg_validator_validation_error,
               $msg_unavailable_attendance_period;
        
        if ($cod == 'OUT_OF_BOUND') {
            $msg = $msg_validator_out_of_bound;
            if ($per_assid == 'ANTES_PA') {
                $msg = str_replace("{0}", strtolower($ui_prv_value), $msg);
            }
            elseif ($per_assid == 'DURANTE_PA') {
                $msg = str_replace("{0}", strtolower($ui_during), $msg);
            }
            elseif ($per_assid == 'DEPOIS_PA') {
                $msg = str_replace("{0}", strtolower($ui_nxt_value), $msg);
            }
            $msg = str_replace("{1}", $this->ini_per_assid." - ".$this->fim_per_assid, $msg);
            $msg = str_replace("{2}", $id_rule, $msg);
        }
        elseif ($cod == 'VALIDATION') {
            $msg = $msg_validator_validation_error;
            $msg = str_replace("{0}", $id_rule, $msg);
        }
        elseif ($cod == 'NO_ATTENDANCE_PERIOD') {
            $msg = $msg_unavailable_attendance_period;
        }
    }
    
    /*
     * Identifica para um registo de uma tabela as regras aplicáveis existentes em WEB_ADM_MODULE_RULES
     * A 1ª filtragem aplica tabela, ação e ATIVO = 'S' e no caso dos créditos e débitos (adaptabilidade) aplica a condição prévia de acordo com o registo.
     * As filtragens subsquentes e de acordo com os dados do registo filtrarão: PONTO, ESTADO.
     * 
         resource = 
            acao: "INSERT",
            tabela: "xpto"
            col_ini: "DT_INI";
            col_fim: "DT_FIM";
            empresa: "DEMO",
            rhid: "355",
            dt_adm: "2019-03-01",
            dt_ini: "2019-02-01 08:00",
            dt_fim: "2019-02-02 08:00",
            cond_adicional: ""
            id_modulo: "1"
     * 
     */
    public function getRules($resource, &$msg) {
                
        $msg = '';
        $perfil_ini = '';
        $nxt_perfil = '';
        $last_perfil = '';
        $wkf_aprovado = '';
        $result = array();
        $valida = array();
        $id_perfil = @$_SESSION['id_perfil'];

        # Workflow do registo em avaliação
        # para obter a informação se o registo será ou não aprovado wkf_aprovado = S/N
        if (isset($this->wkf)) {
#echo "tab:".$resource->tabela."/".$this->wkf->perfil."/".$resource->empresa."/".$resource->rhid."/".$resource->dt_adm;

            $this->wkf->get_workflow_registo(
                $this->db,
                $resource->tabela,
                $this->wkf->perfil,
                $resource->empresa,
                $resource->rhid,
                $resource->dt_adm,
                $perfil_ini,
                $nxt_perfil,
                $last_perfil,
                $wkf_aprovado
            );        
        }
        
        # OPERACAO: D - DELETE, I - INSERT, M - MOBILIZAÇÃO, U - UPDATE
        $operacao = '';
        if ($resource->acao == 'INSERT') {
            $operacao = 'I';
        } 
        elseif ($resource->acao == 'UPDATE') {
            $operacao = 'U';
        } 
        elseif ($resource->acao == 'DELETE') {
            $operacao = 'D';
        } 

        # TIPO:  C - Crédito, D - Débito
        $tipo = '';
        if (isset($resource->tp_ocorrencia)) {
            $tipo = $resource->tp_ocorrencia;
        }

        ## identifica se o colaborador tem ou não tratamento de ponto
        # PONTO: S - Sim. N - Não
        $ponto = getRhidTratPonto ($resource->empresa, $resource->rhid, $resource->dt_adm, $msg);
        if ($msg == '') {
            # ESTADO: A - Workflow, B - Aprovado
            $estado = $wkf_aprovado == 'N' ? 'A' : ($wkf_aprovado == 'S' ? 'B' : '');

            # PERIODO DE ASSIDUÍDADE
            # De acordo com o registo de tempo, identifica se ele se encontra ANTES, DENTRO ou APÓS
            $this->getPeriodoAssiduidade($resource->empresa, $msg);
        }
        
        if ($msg == '') {
            # identificação da coluna nas regra a ponderar de acordo com o período de assid. do registo: ANTES_PA, DURANTE_PA ou DEPOIS_PA
            $per_assid = '';
            if ($this->ini_per_assid != '' && $this->fim_per_assid != '') {
                if (substr($resource->dt_ini,0,10) < substr($this->ini_per_assid,0,10) && 
                    substr($resource->dt_fim,0,10) < substr($this->ini_per_assid,0,10)) {
                    $per_assid = 'ANTES_PA';
                } 
                elseif (substr($resource->dt_ini,0,10) > substr($this->fim_per_assid,0,10) && 
                        substr($resource->dt_fim,0,10) > substr($this->fim_per_assid,0,10)) {
                    $per_assid = 'DEPOIS_PA';
                } else {

                        ## desde que esteja um bocado dentro do período de assiduidade, valida SEMPRE 
                        ## pelas regras de DENTRO DO PA
                        /*                        PERIODO DE ASSIDUIDADE
                                REGISTO:        X------------------------X
                                        *-----------------*                                         (1)   DENTRO
                                                        *----------------------------*              (2)
                                       *-------------------------------------------------*		(3)
                                                    *----------*                                    (4)
                        */
                        $per_assid = 'DURANTE_PA';
                }

            }
            else {
                $this->setErrorMessage("NO_ATTENDANCE_PERIOD", $msg);
            }
        }
        
        if ($msg == '') {
            # obtenção das regras aplicáveis
            $sql = "SELECT A.* ".
                   "FROM WEB_ADM_MODULE_RULES A ".
                   "WHERE A.ID_MODULO = :ID_MODULO_ ".
                   "  AND A.OPERACAO = :OPERACAO_ ".
                   "  AND A.ATIVO = 'S' ";

            # TIPO:  C - Crédito, D - Débito
            if ($tipo != '') {
                $sql .= "  AND A.TIPO = :TIPO_ ";
            }

            try {
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':ID_MODULO_', $resource->id_modulo, PDO::PARAM_STR);
                $stmt->bindParam(':OPERACAO_', $operacao, PDO::PARAM_STR);

                # TIPO:  C - Crédito, D - Débito
                if ($tipo != '') {
                    $stmt->bindParam(':TIPO_', $tipo, PDO::PARAM_STR);
                }    

                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            } catch (Exception $ex) {
                    $msg = "getRules [$sql][$resource->id_modulo,$operacao,$tipo]: " . $ex->getMessage();
            }                
        }
        
        # aplicabilidade do perfil que está a efetuar a operação
        if ($msg == '') {
#echo "ANTES ------------------------------------";        
#var_dump($result);
        
            #
            # Utilização de biblioteca que manipula arrays
            # https://github.com/voku/Arrayy
            #
            $regra = Arr::create($result);

            if ($regra->count() > 0 ) {
                
                # Escolhe regra(s) aplicáveis à condição de tratamento de ponto
                $regra = $this->aplica_filtro('EMPRESA', $resource->empresa, $regra);

                # Escolhe regra(s) aplicáveis à condição de tratamento de ponto
                $regra = $this->aplica_filtro('PONTO', $ponto, $regra);

                # Escolhe regra(s) aplicáveis à condição do estado de workflow do registo
                $regra = $this->aplica_filtro('ESTADO', $estado, $regra);

            }

#echo "RESULTADO ------------------------------------";        
#var_dump($regra);
#echo "intervalo ASSID: $this->ini_per_assid - $this->fim_per_assid ";        

#$id_perfil = 1;            
#echo "per assid:$per_assid regra:".$regra[0][$per_assid]." id_perfil:".$id_perfil. " sentido:".$regra[0]['PERFIL_SENTIDO'];

            if ($per_assid != '' && $regra->count() > 0) {

                # PERFIL SENTIDO: A: menor B: menor ou igual, C: Diferente, D: Igual, E: Maior ou igual, F: Maior
                # $regra['PERFIL_SENTIDO']
                if ($regra[0][$per_assid] == '') {
                    # não é permitido a ninguem -> MENSAGEM DE ERRO
                    $this->setErrorMessage("OUT_OF_BOUND", $msg, $per_assid, $regra[0]['ID']);
                }
                elseif ($regra[0][$per_assid] == '%') {
                    # permitido a todos => OK
                } 
                elseif($id_perfil != '') {
                    if (
                        ($regra[0]['PERFIL_SENTIDO'] == 'A' && !($id_perfil < $regra[0][$per_assid]))  ||
                        ($regra[0]['PERFIL_SENTIDO'] == 'B' && !($id_perfil <= $regra[0][$per_assid])) ||
                        ($regra[0]['PERFIL_SENTIDO'] == 'C' && !($id_perfil != $regra[0][$per_assid])) ||
                        ($regra[0]['PERFIL_SENTIDO'] == 'D' && !($id_perfil == $regra[0][$per_assid])) ||
                        ($regra[0]['PERFIL_SENTIDO'] == 'E' && !($id_perfil >= $regra[0][$per_assid])) ||
                        ($regra[0]['PERFIL_SENTIDO'] == 'F' && !($id_perfil > $regra[0][$per_assid]))
                            
                       ) {
                        $this->setErrorMessage("OUT_OF_BOUND", $msg, $per_assid, $regra[0]['ID']);
                    }
                }
            }
        }
     
        # aplicabilidade 
        if ($msg == '' && $regra[0]['VALIDACAO'] != '') {
            
            # CHECK_DATE(:DT_INI,'>',:TODAY,-20)
            try {

                $sql = "SELECT ".$regra[0]['VALIDACAO']." AS VALIDACAO FROM DUAL";

                $stmt = $this->db->prepare($sql);
                if (strpos($sql, ':EMPRESA') !== false) {
                    $stmt->bindValue(':EMPRESA', $resource->empresa, PDO::PARAM_STR);
                }
                
                if (strpos($sql, ':RHID') !== false) {
                    $stmt->bindValue(':RHID', $resource->rhid, PDO::PARAM_INT);
                }

                if (strpos($sql, ':DT_ADMISSAO') !== false) {
                    $stmt->bindValue(':DT_ADMISSAO', $resource->dt_adm, PDO::PARAM_STR);
                }

                if (strpos($sql, ':DT_INI') !== false) {
                    $dt = substr($resource->dt_ini,0,10);
                    $stmt->bindValue(':DT_INI', $dt, PDO::PARAM_STR);
                }
                
                if (strpos($sql, ':DT_FIM') !== false) {
                    $dt = substr($resource->dt_fim,0,10);
                    $stmt->bindValue(':DT_FIM', $dt, PDO::PARAM_STR);
                }

                if (strpos($sql, ':PERFIL') !== false) {
                    $stmt->bindValue(':PERFIL', $id_perfil, PDO::PARAM_INT);
                }

                if (strpos($sql, ':TODAY') !== false) {
                    $dt = date("Y-m-d");
                    $stmt->bindValue(':TODAY', $dt, PDO::PARAM_STR);
                }
                
                $stmt->execute();
                $valida = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($valida['VALIDACAO'] == 'N') {
                    $this->setErrorMessage("VALIDATION", $msg, '',$regra[0]['ID']);
                }
                
            } catch (Exception $ex) {
                    $msg = "getRules [$sql]: " . $ex->getMessage();
            }                
            
            
        }
        
    }
    
    
    # determina no ambiente do registo a tratar o período de assiduidade 
    # associado à empresa do colaborador em processamento
    public function getPeriodoAssiduidade($empresa,&$msg) {
        $msg = '';
        $this->ini_per_assid = '';
        $this->fim_per_assid = '';
        $this->meios_dias_ferias = '';
        $this->ferias_neg = 'N';
        $this->limite_ferias_neg  = '';
        $this->dc_neg = 'N';
        $this->limite_dc_neg  = '';
        $this->adap_neg = 'N';
        $this->limite_adap_neg  = '';


        $resultado = getAnoAberto ($empresa, $msg);
        
        if ($resultado['DT_INI_PER_ASSID'] != '' && $resultado['DT_FIM_PER_ASSID'] != '') {
            $this->ini_per_assid = $resultado['DT_INI_PER_ASSID'];
            $this->fim_per_assid = $resultado['DT_FIM_PER_ASSID'];
        }
        $this->meios_dias_ferias = $resultado['RH_MEIOS_DIAS_FERIAS'];
        $this->ferias_neg = $resultado['RH_FERIAS_NEG'];
        $this->limite_ferias_neg = $resultado['RH_LIMITE_FER_NEG'];
        $this->dc_neg = $resultado['RH_DC_NEG'];
        $this->limite_dc_neg = $resultado['RH_LIMITE_DC_NEG'];
        $this->adap_neg = $resultado['RH_ADAP_NEG'];
        $this->limite_adap_neg = $resultado['RH_LIMITE_ADAP_NEG'];
        
    }
    
    # executa as validações associadas à referência (reference) introduzida
    # retornando o erro na variável $msg
    public function Validate(&$msg)
    {
        global $error_one_of_this_is_mandatory, $ui_rhid, $ui_user;
        $msg = '';
        $link = $this->db;
        
        # PRS: alocações de operadores
        if ($this->reference == 'prs_allocations') {
            
            $accao_ = $this->action == 'create' ? 'INSERT' : ($this->action == 'edit' ? 'UPDATE' : '');
            $empresa_ = $this->record['EMPRESA'];
            $rhid_ = $this->record['RHID']; 
            $dt_adm_ = $this->record['DT_ADMISSAO']; 
            $tipo_ = $this->record['TIPO']; 
            $dt_ini_aloc_ = $this->record['DT_INI_ALOC']; 
            $dt_fim_aloc_ = $this->record['DT_FIM']; 
            
            if ($accao_ != '' && $empresa_ != '' && $rhid_ != '' && $dt_adm_ != '' && $tipo_ != '' && $dt_ini_aloc_ != '') {
                prs_valida_cruzamentos_alocacoes($accao_, $empresa_, $rhid_, $dt_adm_, $tipo_, $dt_ini_aloc_, $dt_fim_aloc_, $msg);
            }
        }
        elseif (strtoupper ($this->reference) == 'RH_ID_AUSENCIAS') {

            $resource = new stdClass();
            $resource->acao = $this->action == 'create' ? 'INSERT' : ($this->action == 'edit' ? 'UPDATE' : ($this->action == 'delete' ? 'DELETE' : '') );
            $resource->tabela = "RH_ID_AUSENCIAS";
            $resource->col_ini = "DT_INI";
            $resource->col_fim = "DT_FIM";
            $resource->empresa = $this->record['EMPRESA'];
            $resource->rhid = $this->record['RHID'];
            $resource->dt_adm = $this->record['DT_ADMISSAO'];
            $resource->dt_ini = $this->record['DT_INI'];
            $resource->dt_fim = $this->record['DT_FIM'];
            $resource->cd_ausencia = $this->record['CD_AUSENCIA'];
            $resource->nr_calendario = $this->record['NR_CALENDARIO'];
            $resource->nr_uteis = $this->record['NR_UTEIS'];
            $resource->nr_minutos = $this->record['NR_MINUTOS'];
            $resource->cond_adicional = ""; #" AND CD_AUSENCIA = '".$this->record['CD_AUSENCIA']."' ".
                                            #" AND TIPO_REGISTO = '".$this->record['TIPO_REGISTO']."' ";
            $resource->id_modulo = 5;

            #$msg = "[$this->action - $resource->empresa/$resource->rhid/$resource->dt_adm]: per assid:".$this->ini_per_assid." // ".$this->fim_per_assid;
            $this->getPeriodoAssiduidade($resource->empresa,$msg);
            if ($msg == '') {
                $this->getRules($resource, $msg);
            }

            if ($msg == '' && $resource->acao != 'DELETE') {
                valida_cruzamentos($resource, $msg);
            }
                
            if ($msg == '' && $resource->acao != 'DELETE') {
                valida_colisoes_entre_tabelas($resource, $msg);
            }
            
            # validações específicas de ausências
            if ($msg == '' && $resource->acao != 'DELETE') {
                valida_ausencia($resource, $msg);
            }                
        
        }
        elseif (strtoupper ($this->reference) == 'RH_ID_DET_ADAPTABILIDADES') {

            $resource = new stdClass();
            $resource->acao = $this->action == 'create' ? 'INSERT' : ($this->action == 'edit' ? 'UPDATE' : ($this->action == 'delete' ? 'DELETE' : '') );
            $resource->tabela = "RH_ID_DET_ADAPTABILIDADES";
            $resource->col_ini = "DT_INI_DET";
            $resource->col_fim = "DT_FIM_DET";
            $resource->empresa = $this->record['EMPRESA'];
            $resource->rhid = $this->record['RHID'];
            $resource->dt_adm = $this->record['DT_ADMISSAO'];
            $resource->dt_ini = $this->record['DT_INI_DET'];
            $resource->dt_fim = $this->record['DT_FIM_DET'];
            $resource->cond_adicional = " AND TP_OCORRENCIA = '".$this->record['TP_OCORRENCIA']."' ";
            $resource->tp_ocorrencia = $this->record['TP_OCORRENCIA'];
            $resource->duracao_minutos = $this->record['DURACAO_MINUTOS'];
            $resource->id_modulo = 15;

            if ($msg == '') {
                $this->getPeriodoAssiduidade($resource->empresa,$msg);
                $resource->adap_neg = $this->adap_neg;
                $resource->limite_adap_neg = $this->limite_adap_neg;
            }
            
            if ($msg == '') {
                $this->getRules($resource, $msg);
            }
            
            if ($msg == '' && $resource->acao != 'DELETE') {
                valida_cruzamentos($resource, $msg);
            }
            
            if ($msg == '' && $resource->acao != 'DELETE') {
                # neste caso precisamos de discriminar em tp_ocorrencia, uma vez que a lógica
                # de validação entre tabela é distinta consoante seja créditos ou débitos
                valida_colisoes_entre_tabelas($resource, $msg);
            }
            
            # validações específicas de adaptabilidade
            if ($msg == '' && $resource->acao != 'DELETE') {
                valida_adap($resource, $msg);
            }    

        }
        elseif (strtoupper ($this->reference) == 'RH_ID_TS_HV') {

            $resource = new stdClass();
            $resource->acao = $this->action == 'create' ? 'INSERT' : ($this->action == 'edit' ? 'UPDATE' : ($this->action == 'delete' ? 'DELETE' : '') );
            $resource->tabela = "RH_ID_TS_HV";
            $resource->col_ini = "DT_INI";
            $resource->col_fim = "DT_FIM";
            $resource->empresa = $this->record['EMPRESA'];
            $resource->rhid = $this->record['RHID'];
            $resource->dt_adm = $this->record['DT_ADMISSAO'];
            $resource->dt_ini = $this->record['DT_INI'];
            $resource->dt_fim = $this->record['DT_FIM'];
            $resource->cond_adicional = " AND TIPO_REGISTO = '".$this->record['TIPO_REGISTO']."' ";
            $resource->id_modulo = 3;

            $this->getPeriodoAssiduidade($resource->empresa,$msg);
            if ($msg == '') {
                $this->getRules($resource, $msg);
            }
            
            if ($msg == '' && $resource->acao != 'DELETE') {
                valida_cruzamentos($resource, $msg);
            }
            
            if ($msg == '' && $resource->acao != 'DELETE') {
                valida_colisoes_entre_tabelas($resource, $msg);
            }
            
            # validações específicas de trabalho suplementar
            if ($msg == '' && $resource->acao != 'DELETE') {
                valida_ts($resource, $msg);
            }
            
        }
        elseif (strtoupper ($this->reference) == 'RH_ID_FERIAS') {

            $resource = new stdClass();
            $resource->acao = $this->action == 'create' ? 'INSERT' : ($this->action == 'edit' ? 'UPDATE' : ($this->action == 'delete' ? 'DELETE' : '') );
            $resource->tabela = "RH_ID_FERIAS";
            $resource->col_ini = "DT_INI";
            $resource->col_fim = "DT_FIM";
            $resource->empresa = $this->record['EMPRESA'];
            $resource->rhid = $this->record['RHID'];
            $resource->dt_adm = $this->record['DT_ADMISSAO'];
            $resource->dt_ini = $this->record['DT_INI'];
            $resource->dt_fim = $this->record['DT_FIM'];
            $resource->ano = $this->record['ANO'];
            $resource->dias_uteis = $this->record['NR_DIAS_UTEIS'];
            
            $resource->cond_adicional = ""; # AND ANO = ".$this->record['ANO']." ";
            $resource->id_modulo = 6;

            #$msg = "$resource->acao - $resource->empresa/$resource->rhid/$resource->dt_adm]: per assid:".$this->ini_per_assid." // ".$this->fim_per_assid;
            if ($msg == '') {
                $this->getPeriodoAssiduidade($resource->empresa,$msg);
                $resource->meios_dias_ferias = $this->meios_dias_ferias;
                $resource->ferias_neg = $this->ferias_neg;
                $resource->limite_ferias_neg = $this->limite_ferias_neg;
            }
            
            if ($msg == '') {
                $this->getRules($resource, $msg);
            }
            
            if ($msg == '' && $resource->acao != 'DELETE') {
                
                # se as férias são marcadas em dias => adiciona hora para permitir a validação
                if ($this->meios_dias_ferias == 'N') {
                    $resource->dt_ini = substr($this->record['DT_INI'],0,10)." 00:00";
                    $resource->dt_fim = substr($this->record['DT_FIM'],0,10)." 23:59";
                }
                valida_cruzamentos($resource, $msg);
                if ($this->meios_dias_ferias == 'N') {
                    $resource->dt_ini = $this->record['DT_INI'];
                    $resource->dt_fim = $this->record['DT_FIM'];
                }
            }
                
            if ($msg == '' && $resource->acao != 'DELETE') {
                
                # se as férias são marcadas em dias => adiciona hora para permitir a validação
                if ($this->meios_dias_ferias == 'N') {
                    $resource->dt_ini = substr($this->record['DT_INI'],0,10)." 00:00";
                    $resource->dt_fim = substr($this->record['DT_FIM'],0,10)." 23:59";
                }
                valida_colisoes_entre_tabelas($resource, $msg);
                if ($this->meios_dias_ferias == 'N') {
                    $resource->dt_ini = $this->record['DT_INI'];
                    $resource->dt_fim = $this->record['DT_FIM'];
                }
            }
            
            # validações específicas de férias
            if ($msg == '' && $resource->acao != 'DELETE') {
                valida_ferias($resource, $msg);
            }
            
        }
        elseif (strtoupper ($this->reference) == 'RH_ID_DC_DEBITOS') {

            $resource = new stdClass();
            $resource->acao = $this->action == 'create' ? 'INSERT' : ($this->action == 'edit' ? 'UPDATE' : ($this->action == 'delete' ? 'DELETE' : '') );
            $resource->tabela = "RH_ID_DC_DEBITOS";
            $resource->col_ini = "GOZOU_DE";
            $resource->col_fim = "GOZOU_A";
            $resource->empresa = $this->record['EMPRESA'];
            $resource->rhid = $this->record['RHID'];
            $resource->dt_adm = $this->record['DT_ADMISSAO'];
            $resource->dt_ini = $this->record['GOZOU_DE'];
            $resource->dt_fim = $this->record['GOZOU_A'];
            $resource->qtd_usada = $this->record['QTD_USADA'];
            $resource->cond_adicional = ""; # AND SEQ = ".$this->record['SEQ']." ";
            $resource->id_modulo = 4;

            if ($msg == '') {
                $this->getPeriodoAssiduidade($resource->empresa,$msg);
                $resource->dc_neg = $this->dc_neg;
                $resource->limite_dc_neg = $this->limite_dc_neg;
            }
            
            if ($msg == '') {
                $this->getRules($resource, $msg);
            }
            
            if ($msg == '' && $resource->acao != 'DELETE') {
                valida_cruzamentos($resource, $msg);
            }
                
            if ($msg == '' && $resource->acao != 'DELETE') {
                valida_colisoes_entre_tabelas($resource, $msg);
            }
            
            # validações específicas de descanso compensatório
            if ($msg == '' && $resource->acao != 'DELETE') {
                valida_dc($resource, $msg);
            }            
        }
        elseif (strtoupper ($this->reference) == 'RH_ID_ESCALAS_HORARIAS') {

            $resource = new stdClass();
            $resource->acao = $this->action == 'create' ? 'INSERT' : ($this->action == 'edit' ? 'UPDATE' : ($this->action == 'delete' ? 'DELETE' : '') );
            $resource->tabela = "RH_ID_ESCALAS_HORARIAS";
            $resource->col_ini = "DIA";
            $resource->col_fim = "DT_FIM";
            $resource->empresa = $this->record['EMPRESA'];
            $resource->rhid = $this->record['RHID'];
            $resource->dt_adm = $this->record['DT_ADMISSAO'];
            $resource->dt_ini = $this->record['DIA'];
            $resource->dt_fim = $this->record['DT_FIM'];
            $resource->cond_adicional = "AND TIPO = 'B' "; ## apenas contempla trocas de horário e não escalas horárias
            $resource->id_modulo = 13;

            #$msg = "[$this->action - $resource->empresa/$resource->rhid/$resource->dt_adm]: per assid:".$this->ini_per_assid." // ".$this->fim_per_assid;
            $this->getPeriodoAssiduidade($resource->empresa,$msg);
            if ($msg == '') {
                $this->getRules($resource, $msg);
            }

            if ($msg == '' && $resource->acao != 'DELETE') {
                valida_cruzamentos($resource, $msg);
            }
        }
        elseif (strtoupper ($this->reference) == 'RH_ID_EMPRESAS') {      
            
            $resource = new stdClass();
            $resource->acao = $this->action == 'create' ? 'INSERT' : ($this->action == 'edit' ? 'UPDATE' : ($this->action == 'delete' ? 'DELETE' : '') );
            $resource->tabela = "RH_ID_EMPRESAS";
            $resource->col_ini = "DT_INI";
            $resource->col_fim = "DT_FIM";
            $resource->empresa = $this->record['EMPRESA'];
            $resource->rhid = $this->record['RHID'];
            $resource->dt_adm = $this->record['DT_ADMISSAO'];
            $resource->cd_sit = $this->record['CD_SITUACAO'];
            $resource->dt_sit = $this->record['DT_SITUACAO'];
            $resource->dt_demissao = $this->record['DT_DEMISSAO'];
            $resource->cond_adicional = " ";
            if ($msg == "" && $resource->acao != 'DELETE') {
                valida_info_empresas($resource, $msg);
                #$msg = "STOP[$msg]";
            }            
        }
        elseif (strtoupper ($this->reference) == 'RH_ID_DOCUMENTOS' ||
                strtoupper ($this->reference) == 'RH_ID_DOCUMENTOS_AGREGADO' ) {

            $resource = new stdClass();
            $resource->acao = $this->action == 'create' ? 'INSERT' : ($this->action == 'edit' ? 'UPDATE' : ($this->action == 'delete' ? 'DELETE' : '') );
            $resource->tabela = "RH_ID_DOCUMENTOS";
            $resource->rhid = $this->record['RHID'];
            if (isset($this->record['SEQ'])) {
                $resource->seq = $this->record['SEQ'];
            }
            else {
                $resource->seq = '';
            }
            if (isset($this->record['CD_AGREGADO'])) {
                $resource->cd_agregado = $this->record['CD_AGREGADO'];
            }
            else {
                $resource->cd_agregado = '';
            }
            $resource->cd_doc_id = $this->record['CD_DOC_ID'];
            $resource->nr_documento = $this->record['NR_DOCUMENTO'];
            $resource->dt_emissao = $this->record['DT_EMISSAO'];
            $resource->dt_validade = $this->record['DT_VALIDADE'];

            if ($msg == '' && $resource->acao != 'DELETE') {
                valida_documentos($resource, $msg);
            }
        }
        elseif (strtoupper ($this->reference) == 'RH_ID_HAB_LITERARIAS') {

            $resource = new stdClass();
            $resource->acao = $this->action == 'create' ? 'INSERT' : ($this->action == 'edit' ? 'UPDATE' : ($this->action == 'delete' ? 'DELETE' : '') );
            $resource->tabela = "RH_ID_HAB_LITERARIAS";
            $resource->rhid = $this->record['RHID'];
            $resource->cd_hab_lit = $this->record['CD_HAB_LIT'];
            $resource->dt_ini = $this->record['DT_INI'];
            $resource->dt_fim = $this->record['DT_FIM'];
            $resource->ru = $this->record['RU'];

            if ($msg == '' && $resource->acao != 'DELETE') {
                valida_hab_literarias($resource, $msg);
            }
        }
        elseif (strtoupper ($this->reference) == 'RH_ID_HABS_PROFISSIONAIS') {

            $resource = new stdClass();
            $resource->acao = $this->action == 'create' ? 'INSERT' : ($this->action == 'edit' ? 'UPDATE' : ($this->action == 'delete' ? 'DELETE' : '') );
            $resource->tabela = "RH_ID_HABS_PROFISSIONAIS";
            $resource->rhid = $this->record['RHID'];
            $resource->empresa = $this->record['EMPRESA'];
            $resource->cd_hab_prof = $this->record['CD_HAB_PROF'];
            $resource->dt_hab_prof = $this->record['DT_INI_HAB_PROF'];
            $resource->dt_ini = $this->record['DT_INI'];
            $resource->dt_fim = $this->record['DT_FIM'];

            if ($msg == '' && $resource->acao != 'DELETE') {
                valida_hab_profissionais($resource, $msg);
            }
        }
        elseif (strtoupper ($this->reference) == 'RH_ID_WORKFLOWS') {      
            
            $resource = new stdClass();
            $resource->acao = $this->action == 'create' ? 'INSERT' : ($this->action == 'edit' ? 'UPDATE' : ($this->action == 'delete' ? 'DELETE' : '') );
            $resource->tabela = "RH_ID_WORKFLOWS";
            $resource->col_ini = "DT_INI";
            $resource->col_fim = "DT_FIM";
            $resource->empresa = $this->record['EMPRESA'];
            $resource->rhid = $this->record['RHID'];
            $resource->dt_adm = $this->record['DT_ADMISSAO'];
            $resource->dt_ini = $this->record['DT_INI'];
            $resource->dt_fim = $this->record['DT_FIM'];
            $resource->id_perfil = $this->record['ID_PERFIL'];
            $resource->cond_adicional = " AND ID_PERFIL = ".$resource->id_perfil;
            
            if (($this->record['ID_UTILIZADOR'] === '' && $this->record['RHID_CHEFIA'] === '') ||
                ($this->record['ID_UTILIZADOR'] !== '' && $this->record['RHID_CHEFIA'] !== '')) {
                $msg = "$ui_rhid, $ui_user: $error_one_of_this_is_mandatory";
            }
            
            if ($msg == "" && $resource->acao != 'DELETE') {
                # a validação é efetuada à data/hora e estes registos apenas têm data
                $resource->dt_ini = substr($this->record['DT_INI'],0,10)." 00:00";
                if ($resource->dt_fim !== '') {
                    $resource->dt_fim = substr($this->record['DT_FIM'],0,10)." 23:59";
                }
                valida_cruzamentos($resource, $msg);
                #$msg = "STOP[$msg]";
            }
        }
        elseif (strtoupper ($this->reference) == 'RH_ID_ADAPTABILIDADES') {      
            
            $resource = new stdClass();
            $resource->acao = $this->action == 'create' ? 'INSERT' : ($this->action == 'edit' ? 'UPDATE' : ($this->action == 'delete' ? 'DELETE' : '') );
            $resource->tabela = "RH_ID_ADAPTABILIDADES";
            $resource->col_ini = "DT_INI_HDR";
            $resource->col_fim = "DT_FIM_HDR";
            $resource->empresa = $this->record['EMPRESA'];
            $resource->rhid = $this->record['RHID'];
            $resource->dt_adm = $this->record['DT_ADMISSAO'];
            $resource->dt_ini = $this->record['DT_INI_HDR'];
            $resource->dt_fim = $this->record['DT_FIM_HDR'];
            $resource->cond_adicional = "";
            
            if ($msg == "" && $resource->acao != 'DELETE') {
                # a validação é efetuada à data/hora e estes registos apenas têm data
                $resource->dt_ini = substr($this->record['DT_INI_HDR'],0,10)." 00:00";
                if ($resource->dt_fim !== '') {
                    $resource->dt_fim = substr($this->record['DT_FIM_HDR'],0,10)." 23:59";
                }
                valida_cruzamentos($resource, $msg);
                #$msg = "STOP[$msg]";
            }
        }
        elseif (strtoupper ($this->reference) == 'RH_ID_SETORES') {      
            
            $resource = new stdClass();
            $resource->acao = $this->action == 'create' ? 'INSERT' : ($this->action == 'edit' ? 'UPDATE' : ($this->action == 'delete' ? 'DELETE' : '') );
            $resource->tabela = "RH_ID_SETORES";
            $resource->col_ini = "DT_INI";
            $resource->col_fim = "DT_FIM";
            $resource->empresa = $this->record['EMPRESA'];
            $resource->rhid = $this->record['RHID'];
            $resource->dt_adm = $this->record['DT_ADMISSAO'];
            $resource->dt_ini = $this->record['DT_INI'];
            $resource->dt_fim = $this->record['DT_FIM'];
            $resource->cond_adicional = "";
            
            if ($msg == "" && $resource->acao != 'DELETE') {
                # a validação é efetuada à data/hora e estes registos apenas têm data
                $resource->dt_ini = substr($this->record['DT_INI'],0,10)." 00:00";
                if ($resource->dt_fim !== '') {
                    $resource->dt_fim = substr($this->record['DT_FIM'],0,10)." 23:59";
                }
                valida_cruzamentos($resource, $msg);
                #$msg = "STOP[$msg]";
            }
        }
        elseif (strtoupper ($this->reference) == 'RH_ID_DEPTS') {      
            
            $resource = new stdClass();
            $resource->acao = $this->action == 'create' ? 'INSERT' : ($this->action == 'edit' ? 'UPDATE' : ($this->action == 'delete' ? 'DELETE' : '') );
            $resource->tabela = "RH_ID_DEPTS";
            $resource->col_ini = "DT_INI";
            $resource->col_fim = "DT_FIM";
            $resource->empresa = $this->record['EMPRESA'];
            $resource->rhid = $this->record['RHID'];
            $resource->dt_adm = $this->record['DT_ADMISSAO'];
            $resource->dt_ini = $this->record['DT_INI'];
            $resource->dt_fim = $this->record['DT_FIM'];
            $resource->cond_adicional = " AND TIPO = '".$this->record['TIPO']."' ";
            
            if ($msg == "" && $resource->acao != 'DELETE') {
                # a validação é efetuada à data/hora e estes registos apenas têm data
                $resource->dt_ini = substr($this->record['DT_INI'],0,10)." 00:00";
                if ($resource->dt_fim !== '') {
                    $resource->dt_fim = substr($this->record['DT_FIM'],0,10)." 23:59";
                }
                valida_cruzamentos($resource, $msg);
                #$msg = "STOP[$msg]";
            }
        }
        elseif (strtoupper ($this->reference) == 'RH_ID_DESTACAMENTOS') {      
            
            $resource = new stdClass();
            $resource->acao = $this->action == 'create' ? 'INSERT' : ($this->action == 'edit' ? 'UPDATE' : ($this->action == 'delete' ? 'DELETE' : '') );
            $resource->tabela = "RH_ID_DESTACAMENTOS";
            $resource->col_ini = "DT_INI";
            $resource->col_fim = "DT_FIM";
            $resource->empresa = $this->record['EMPRESA'];
            $resource->rhid = $this->record['RHID'];
            $resource->dt_adm = $this->record['DT_ADMISSAO'];
            $resource->dt_ini = $this->record['DT_INI'];
            $resource->dt_fim = $this->record['DT_FIM'];
            $resource->cond_adicional = "";
            
            if ($msg == "" && $resource->acao != 'DELETE') {
                # a validação é efetuada à data/hora e estes registos apenas têm data
                $resource->dt_ini = substr($this->record['DT_INI'],0,10)." 00:00";
                if ($resource->dt_fim !== '') {
                    $resource->dt_fim = substr($this->record['DT_FIM'],0,10)." 23:59";
                }
                valida_cruzamentos($resource, $msg);
                #$msg = "STOP[$msg]";
            }
        }
        elseif (strtoupper ($this->reference) == 'RH_ID_FUNCOES') {      
            
            $resource = new stdClass();
            $resource->acao = $this->action == 'create' ? 'INSERT' : ($this->action == 'edit' ? 'UPDATE' : ($this->action == 'delete' ? 'DELETE' : '') );
            $resource->tabela = "RH_ID_FUNCOES";
            $resource->col_ini = "DT_INI";
            $resource->col_fim = "DT_FIM";
            $resource->empresa = $this->record['EMPRESA'];
            $resource->rhid = $this->record['RHID'];
            $resource->dt_adm = $this->record['DT_ADMISSAO'];
            $resource->dt_ini = $this->record['DT_INI'];
            $resource->dt_fim = $this->record['DT_FIM'];
            $resource->cond_adicional = " AND TP_REGISTO = 'A' AND TIPO = '".$this->record['TIPO']."' ";
            
            if ($msg == "" && $resource->acao != 'DELETE') {
                # a validação é efetuada à data/hora e estes registos apenas têm data
                $resource->dt_ini = substr($this->record['DT_INI'],0,10)." 00:00";
                if ($resource->dt_fim !== '') {
                    $resource->dt_fim = substr($this->record['DT_FIM'],0,10)." 23:59";
                }
                valida_cruzamentos($resource, $msg);
                #$msg = "STOP[$msg]";
            }
        }
        elseif (strtoupper ($this->reference) == 'RH_ID_VINCULOS') {      
            
            $resource = new stdClass();
            $resource->acao = $this->action == 'create' ? 'INSERT' : ($this->action == 'edit' ? 'UPDATE' : ($this->action == 'delete' ? 'DELETE' : '') );
            $resource->tabela = "RH_ID_VINCULOS";
            $resource->col_ini = "DT_INI_VINCULO";
            $resource->col_fim = "DT_FIM_VINCULO";
            $resource->empresa = $this->record['EMPRESA'];
            $resource->rhid = $this->record['RHID'];
            $resource->dt_adm = $this->record['DT_ADMISSAO'];
            $resource->dt_ini = $this->record['DT_INI_VINCULO'];
            $resource->dt_fim = $this->record['DT_FIM_VINCULO'];
            $resource->cd_vinculo = $this->record['DT_FIM_VINCULO'];
            $resource->cd_motivo_saida = $this->record['CD_MOTIVO_SAIDA'];
            $resource->tp_vinculo = $this->record['TP_VINCULO'];
            $resource->cond_adicional = "";
            
            if ($msg == "" && $resource->acao != 'DELETE') {
                # a validação é efetuada à data/hora e estes registos apenas têm data
                $resource->dt_ini = substr($this->record['DT_INI_VINCULO'],0,10)." 00:00";
                if ($resource->dt_fim !== '') {
                    $resource->dt_fim = substr($this->record['DT_FIM_VINCULO'],0,10)." 23:59";
                }
                valida_cruzamentos($resource, $msg);
                #$msg = "STOP[$msg]";
            }
        }
        elseif (strtoupper ($this->reference) == 'RH_ID_ENT_INTERNAS') {      
            
            $resource = new stdClass();
            $resource->acao = $this->action == 'create' ? 'INSERT' : ($this->action == 'edit' ? 'UPDATE' : ($this->action == 'delete' ? 'DELETE' : '') );
            $resource->tabela = "RH_ID_ENT_INTERNAS";
            $resource->col_ini = "DT_INI";
            $resource->col_fim = "DT_FIM";
            $resource->empresa = $this->record['EMPRESA'];
            $resource->rhid = $this->record['RHID'];
            $resource->dt_adm = $this->record['DT_ADMISSAO'];
            $resource->dt_ini = $this->record['DT_INI'];
            $resource->dt_fim = $this->record['DT_FIM'];
            $resource->cond_adicional = " AND TIPO = '".$this->record['TIPO']."' ";
            
            if ($msg == "" && $resource->acao != 'DELETE') {
                # a validação é efetuada à data/hora e estes registos apenas têm data
                $resource->dt_ini = substr($this->record['DT_INI'],0,10)." 00:00";
                if ($resource->dt_fim !== '') {
                    $resource->dt_fim = substr($this->record['DT_FIM'],0,10)." 23:59";
                }
                valida_cruzamentos($resource, $msg);
                #$msg = "STOP[$msg]";
            }
        }
        elseif (strtoupper ($this->reference) == 'RH_ID_ENTS_DESCONTO') {      
            
            $resource = new stdClass();
            $resource->acao = $this->action == 'create' ? 'INSERT' : ($this->action == 'edit' ? 'UPDATE' : ($this->action == 'delete' ? 'DELETE' : '') );
            $resource->tabela = "RH_ID_ENTS_DESCONTO";
            $resource->empresa = $this->record['EMPRESA'];
            $resource->rhid = $this->record['RHID'];
            $resource->dt_adm = $this->record['DT_ADMISSAO'];
            $resource->cd_ed = $this->record['CD_ED'];
            $resource->cd_reg_desc = $this->record['CD_REG_DESC'];
            $resource->nr_inscricao = $this->record['NR_INSCRICAO'];
            $resource->activo = $this->record['ACTIVO'];
            $resource->cond_adicional = "";
            
            if ($msg == "" && $resource->acao != 'DELETE') {
                valida_ents_desconto($resource, $msg);
                $msg = "STOP[$msg]";
            }
        }
        elseif (strtoupper ($this->reference) == 'RH_ID_REMUNERACOES') {      
            
            $resource = new stdClass();
            $resource->acao = $this->action == 'create' ? 'INSERT' : ($this->action == 'edit' ? 'UPDATE' : ($this->action == 'delete' ? 'DELETE' : '') );
            $resource->tabela = "RH_ID_REMUNERACOES";
            $resource->col_ini = "DT_INICIO";
            $resource->col_fim = "DT_FIM";
            $resource->empresa = $this->record['EMPRESA'];
            $resource->rhid = $this->record['RHID'];
            $resource->dt_adm = $this->record['DT_ADMISSAO'];
            $resource->cd_grelha_salarial = $this->record['CD_GRELHA_SALARIAL'];
            $resource->cd_linha_salarial = $this->record['CD_LINHA_SALARIAL'];
            $resource->dt_ini = $this->record['DT_INICIO'];
            $resource->dt_fim = $this->record['DT_FIM'];
            $resource->valor = $this->record['INPUT_VALOR'];
            $resource->cond_adicional = " AND CD_GRELHA_SALARIAL = '".$this->record['CD_GRELHA_SALARIAL']."' ";
            
            
            if ($msg == "" && $resource->acao != 'DELETE') {
                # a validação é efetuada à data/hora e estes registos apenas têm data
                $resource->dt_ini = substr($resource->dt_ini,0,7)."-01 00:00";
                if ($resource->dt_fim !== '') {
                    $resource->dt_fim = date("Y-m-t", strtotime(substr($this->record['DT_FIM'],0,7)."-01"))." 23:59";
                }
                valida_cruzamentos($resource, $msg);
                #$resource->dt_ini = $this->record['DT_INICIO'];
                #$resource->dt_fim = $this->record['DT_FIM'];
            }
            
            # impedir atualização de grelhas com datas anterior ao mês corrente
            if ($msg == '') {
                valida_grelhas_salariais($resource, $msg);
            }
            
#$msg = "STOP[$msg]";
        }
    }
    

}
