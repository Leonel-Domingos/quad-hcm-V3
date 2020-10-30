<?php
/*
 *  @autor      Pedro Estácio <pedro.estacio@quad-systems.com>
 *  @versão     2.0
 *  @revisão    2018.09.03
 *  @copyright  (c) 2018 QuadSystems - http://www.quad-systems.com
 *  @nome     	av_lib_controller.php
 *  @descrição  Livraria de funções de suporte ao módulo de avaliação de desempenho
 *
 */


$ui_evals = "Avaliações";
$ui_sheet = "Ficha";
$ui_result = "Resultado";

$ui_colab = "Colaborador";
$ui_plan = "Plano";
$ui_process = "Processo";
$ui_dt_ini_short = "Dt.Início";
$ui_dt_fim_short = "Dt.Fim";
$ui_eval_dt_ini_short = "Dt.Ini.Avaliação";
$ui_eval_dt_fim_short = "Dt.Fim Avaliação";
$ui_function = "Função";
$ui_phase = "Fase";
$ui_status = "Estado";
$ui_page = "Página";
$ui_eval_sheet = "Ficha de Avaliação";
$ui_eval = "Avaliação";
$ui_qualifications = "Competências";
$ui_objectives = "Objectivos";
$ui_eval_grade = "Nota Avaliação";
$ui_grade_final = "Nota Final";
$ui_level_req = "Nível Requerido";
$ui_realized = "Realizado";
$ui_realized_perc = "% Realizado";
$ui_punctuation = "Pontuação";
$ui_totals = "Totais";
$ui_weight = "Peso";
$ui_confirm = "Confirma";
$ui_continue = "Continuar";
$ui_new_avaliator = "Novo avaliador";
$ui_comment_general = "Comentários Gerais";
$ui_comments = "Comentários";
$ui_actor = "Interveniente";
$ui_homologate = "Homologar";
$ui_agreement = "Concordância";
$ui_homologate_no = "Não Homologar";
$ui_homologation_export = "Escolha o formato para exportação da ficha de avaliação.";
$ui_result_export = "Escolha o formato para exportação dos resultados de avaliação.";
$ui_homologation_non_approval = "Indique p.f. o motivo da não homologação";
$ui_homologation_reopen = "Reabertura de Ficha de Avaliação";
$ui_submit_send = "Submissão de ficha de avaliação";
$ui_homologation_sheet = "Homologação da ficha de avaliação";
$ui_no_homologation_sheet = "Não Homologação da ficha de avaliação";
$ui_delegate_send = "Delegação de ficha de avaliação";
$ui_obs = "Observações";
$ui_no_agrees = "Não concorda";
$ui_reason_non_approval = "Motivo não homologação";
$msg_request_homologation_motive = 'Indique p.f. o motivo da não homologação :';
$msg_insuficient_info = "Informação insuficiente para gravação da resposta.";
$msg_answer_save_ok = "Resposta gravada com sucesso";
$msg_obs_save_ok = "Observação gravada com sucesso";

$msg_av_submit_ok = "Ficha de Avaliação submetida";
$msg_av_submit_nok = "Ficha de Avaliação não submetida";
$msg_av_reopen_ok = "Ficha de Avaliação reaberta";
$msg_av_reopen_nok = "Ficha de Avaliação não reaberta";
$msg_av_delegate_ok = "Ficha de Avaliação delegada";
$msg_av_delegate_nok = "Ficha de Avaliação não delegada";
$msg_aval_not_ended = "Processo de avaliação ainda não está terminado.";
$msg_missing_avaluation_tree = "Árvore de avaliação por definir. Deverá definir no Processo de Avaliação a componente a utilizar para a determinação dos Avaliadores.";
$msg_answers_to_give = "Deverá responder a toda a ficha antes da submissão.";
$error_invalid_oper_av_already_terminated = "Operação inválida. Processo de avaliação já terminado.";
$error_invalid_operation = "Operação inválida";

$dialog_homologation = "Deseja proceder à homologação da ficha de avaliação ?";
$dialog_homologation_reject = "Deseja proceder à rejeição da homologação da ficha de avaliação ?";
$dialog_homologation_reopen = "Deseja proceder à reabertura da ficha de avaliação ?";

$ui_delegation = "Delegar";
$ui_export = "Exportar";
$ui_reopen = "Reabrir";
$ui_workflow = "WorkFlow";

    ##
    ## AVALIAÇÃO DE DESEMPENHO
    ##
$msg_missing_avaluation_tree = "Árvore de avaliação por definir. Deverá definir no Processo de Avaliação a componente a utilizar para a determinação dos Avaliadores.";


    #
    # FUNÇÕES DE SUPORTE
    #

    #
    # Função que retorna a(s) letra(s) associada à coluna, função da indicação do indice
    # algoritmo excel
    function excel_col($col) {

	#    	 1 -  26  	A a Z
	#        27 -  52       AA a AZ
	#        53 -  78       BA a BZ
	#        79 - 104       CA a CZ
	#        ...

    	$res = '';
	$int_ 	 = floor($col/26);
	$resto_  = $col % 26;
	$chr0_ = '';
	$chr1_ = '';
	$chr2_ = '';
	if ($int_ == 0) {
		$chr0_ = 65 + $resto_ - 1;
	} elseif ($int_ == 1 && $resto_ == 0) {
		$chr0_ = 65 + 25;
	} else {
           if ($resto_ == 0) {
           	$int_ -= 1;
           	$resto_ = 26;
           }
	   $chr0_ = 65 + $int_ - 1;
	   $chr1_ = 65 + $resto_ -1;
        }

        if ($chr0_)
	   $res = chr($chr0_);

        if ($chr1_)
	   $res .= chr($chr1_);

        if ($chr2_)
	   $res .= chr($chr2_);

	return $res;

    }

    #
    # Visualização do símbolo do EURO
    #
    function trata_euro($str) {
           return str_replace(chr(128),"&euro;",$str);
    }

    # Função que descodifica domínio
    function dsp_dominio ($dominio, $valor, &$msg) {
        global $db;
        $cd_lang = decode_lang();
        $msg = '';

  	$sql = "SELECT a.RV_DOMAIN, a.RV_LOW_VALUE, IFNULL(b.DSP_TRAD, a.RV_MEANING) RV_MEANING, IFNULL(b.DSR_TRAD, a.RV_ABBREVIATION) RV_ABBREVIATION  ".
               "FROM CG_REF_CODES a ".
               "LEFT JOIN CG_REF_CODES_TRADS b ON a.RV_DOMAIN = b.RV_DOMAIN AND a.RV_LOW_VALUE = b.RV_LOW_VALUE ".
               "  AND b.CD_LINGUA = :cd_lang ".
               "WHERE a.RV_DOMAIN = :dominio ".
               "  AND a.RV_LOW_VALUE = :valor ";
        try {
    //echo $sql.' DOMINIO:' . $dominio. ' LANG:' . $cd_lang . ' Mode:' . $mode;
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':dominio', $dominio);
            $stmt->bindParam(':cd_lang', $cd_lang);
            $stmt->bindParam(':valor', $valor);

            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            return $row['RV_MEANING'];

        } catch (Exception $e) {
            $msg = "Error FETCHING on dsp_dominio: " . $e->getMessage();
        }

        return "";
    }

    #
    # função que devolve nome do colaborador
    function dsp_nome_colab($rhid, $tipo, &$msg) {
        global $db;
        $msg = '';
        $dsp = '';
        try {
            $query = "SELECT NOME, NOME_REDZ ".
                     "FROM RH_IDENTIFICACOES ".
                     "WHERE RHID = :RHID_ ";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':RHID_', $rhid, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($tipo = 'REDZ') {
                $dsp = $row['NOME_REDZ'];
            } else {
                $dsp = $row['NOME'];
            }
        } catch (Exception $ex) {
            $msg = "dsp_nome_colab#1 :" . $ex->getMessage();
        }
        return $dsp;
    }

    #
    # Função que obtem a informação do logotipo do portal
    #
    function get_logo_info(&$logo, &$width, &$height, &$msg) {
        global $db;
        $msg = '';
        $logo = '';
        $width = '';
        $height = '';
  	$sql = "SELECT a.logo, a.logo_width, a.logo_height  ".
               "FROM WEB_ADM_CONFIGURACOES a ";
        try {
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $logo = $row['logo'];
            $width = $row['logo_width'];
            $height = $row['logo_height'];
        } catch (Exception $e) {
            $msg = "get_logo_info#1: " . $e->getMessage();
        }

        return '';
    }

    #
    # Obtenção da informação contextual do colaborador
    #
    function info_ficha_colab ($empresa, $rhid, &$msg) {

        global $db;
        $msg = '';

        $dt_adm = '';
        $nome = '';
        $situacao = '';
        $dt_sit = '';
        $funcao = '';
        $tempo_servico = '';
        $vinculo = '';
        $hab_liter = '';
        $idade = '';

        try {

            $sql =  "SELECT a.* ".
                    "FROM QUAD_PEOPLE a ".
                    "WHERE EMPRESA = :EMPRESA_ ".
                    "  AND RHID = :RHID_ ".
                    "ORDER BY a.DT_ADMISSAO DESC ";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':EMPRESA_', $empresa, PDO::PARAM_STR);
            $stmt->bindParam(':RHID_', $rhid, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $ex) {
            $msg = "info_ficha_colab#1 :" . $ex->getMessage();
        }

        if ($msg == '') {
            try {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                return $row;
            } catch (PDOException $ex) {
                $msg = "info_ficha_colab#2 :" . $ex->getMessage();
            }
        }

        return '';

    }

    #
    # Obtenção da informação da ficha de avaliação
    #
    function info_avaliacao ($empresa_, $id_pa_, $dt_ini_pa_, $id_proc_av_, $dt_ini_proc_, $rhid_, $dt_adm_, $rhid_avaliador_,
                             $id_fase_, $dt_ini_fase_, $dt_ini_fpa_, $dt_ini_af_, &$msg) {

        global $db;
        $msg = '';

        try {

            $sql =  "SELECT a.* FROM MASTER_AVALIACAO a ".
                    "WHERE 1 = 1 ";

            if ($empresa_ != '')
                $sql .= " AND a.EMPRESA = :EMPRESA_ ";

            if ($id_pa_ != '')
                $sql .= " AND a.ID_PA = :ID_PA_ ";

            if ($dt_ini_pa_ != '')
                $sql .= " AND a.DT_INI_PA = :DT_INI_PA_ ";

            if ($id_proc_av_ != '')
                $sql .= " AND a.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ";

            if ($dt_ini_proc_ != '')
                $sql .= " AND a.DT_INI_PROCESSO = :DT_INI_PROCESSO_ ";

            if ($rhid_ != '')
                $sql .= " AND a.RHID = :RHID_ ";

            if ($dt_adm_ != '')
                $sql .= " AND a.DT_ADMISSAO = :DT_ADMISSAO_ ";

            if ($rhid_avaliador_ != '')
                $sql .= " AND a.RHID_AVALIADOR = :RHID_AVALIADOR_ ";

            if ($id_fase_ != '')
                $sql .= " AND a.ID_FASE = :ID_FASE_ ";

            if ($dt_ini_fase_ != '')
                $sql .= " AND a.DT_INI_FASE = :DT_INI_FASE_ ";

            if ($dt_ini_fpa_ != '')
                $sql .= " AND a.DT_INI_FPA = :DT_INI_FPA_ ";

            if ($dt_ini_af_ != '')
                $sql .= " AND a.DT_INI_AF = :DT_INI_AF_ ";

            $stmt = $db->prepare($sql);

            if ($empresa_ != '') {
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
            }

            if ($id_pa_ != '') {
                $stmt->bindParam(':ID_PA_', $id_pa_, PDO::PARAM_STR);
            }

            if ($dt_ini_pa_ != '') {
                $stmt->bindParam(':DT_INI_PA_', $dt_ini_pa_, PDO::PARAM_STR);
            }

            if ($id_proc_av_ != '') {
                $stmt->bindParam(':ID_PROCESSO_AV_', $id_proc_av_, PDO::PARAM_STR);
            }

            if ($dt_ini_proc_ != '') {
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_ini_proc_, PDO::PARAM_STR);
            }

            if ($rhid_ != '') {
                $stmt->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
            }

            if ($dt_adm_ != '') {
                $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_, PDO::PARAM_STR);
            }

            if ($rhid_avaliador_ != '') {
                $stmt->bindParam(':RHID_AVALIADOR_', $rhid_avaliador_, PDO::PARAM_STR);
            }

            if ($id_fase_ != '') {
                $stmt->bindParam(':ID_FASE_', $id_fase_, PDO::PARAM_STR);
            }

            if ($dt_ini_fase_ != '') {
                $stmt->bindParam(':DT_INI_FASE_', $dt_ini_fase_, PDO::PARAM_STR);
            }

            if ($dt_ini_fpa_ != '') {
                $stmt->bindParam(':DT_INI_FPA_', $dt_ini_fpa_, PDO::PARAM_STR);
            }

            if ($dt_ini_af_ != '') {
                $stmt->bindParam(':DT_INI_AF_', $dt_ini_af_, PDO::PARAM_STR);
            }

        } catch (PDOException $ex) {
            $msg = "info_avaliacao#1 :" . $ex->getMessage();
        }

        if ($msg == '') {
            try {
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    return $row;
            } catch (PDOException $ex) {
                $msg = "info_avaliacao#2 :" . $ex->getMessage();
            }
        }
        return '';
    }

    #
    # Lista as escalas aplicáveis às competências associadas a uma ficha de avaliação
    #
    function info_escalas_competencias ($empresa_, $id_pa_, $dt_ini_pa_, $id_proc_, $dt_ini_proc_, $rhid_, $dt_adm_, $rhid_avaliador_,
                                        $id_fase_, $dt_ini_fase_, $dt_ini_fpa_, $dt_ini_af_, &$msg) {

        global $db;
        $escalas = array();
        $msg = '';

        try {

            $sql = "SELECT DISTINCT ".
                     "       IFNULL(c.ID_EP,b.ID_EP) ID_EP ".
                     "      ,IFNULL(c.DT_INI_EP,b.DT_INI_EP) DT_INI_EP ".
                     "FROM RH_FICHA_AVAL_COMPORTAMENTOS a ".
                     "    ,RH_DEF_COMPETENCIAS b ".
                     "    ,RH_DEF_COMPORTAMENTOS c ".
                     "WHERE a.EMPRESA = :EMPRESA_ ".
                     "  AND a.ID_PA = :ID_PA_ ".
                     "  AND a.DT_INI_PA = :DT_INI_PA_ ".
                     "  AND a.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                     "  AND a.DT_INI_PROCESSO = :DT_INI_PROCESSO_ ".
                     "  AND a.RHID_AVALIADO = :RHID_ ".
                     "  AND a.DT_ADMISSAO = :DT_ADMISSAO_ ".
#                     "  AND a.RHID_AVALIADOR = '$rhid_avaliador_' ".
                     "  AND a.ID_FASE = :ID_FASE_ ".
                     "  AND a.DT_INI_FASE = :DT_INI_FASE_ ".
                     "  AND a.DT_INI_FPA = :DT_INI_FPA_ ".
#                     "  AND a.DT_INI_AF = '$dt_ini_af_' ".
                     "  AND b.EMPRESA = a.EMPRESA ".
                     "  AND b.ID_COMPETENCIA = a.ID_COMPETENCIA ".
                     "  AND b.DT_INI_COMPETENCIA = a.DT_INI_COMPETENCIA ".
                     "  AND c.EMPRESA = a.EMPRESA ".
                     "  AND c.ID_COMPETENCIA = a.ID_COMPETENCIA ".
                     "  AND c.DT_INI_COMPETENCIA = a.DT_INI_COMPETENCIA ".
                     "  AND c.ID_COMPORTAMENTO = a.ID_COMPORTAMENTO ".
                     "  AND c.DT_INI_COMPORTAMENTO = a.DT_INI_COMPORTAMENTO ".
                     "  AND (b.ID_EP IS NOT NULL OR c.ID_EP IS NOT NULL)";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PA_', $id_pa_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_PA_', $dt_ini_pa_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PROCESSO_AV_', $id_proc_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_PROCESSO_', $dt_ini_proc_, PDO::PARAM_STR);
            $stmt->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_, PDO::PARAM_STR);
            #$stmt->bindParam(':RHID_AVALIADOR_', $rhid_avaliador_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_FASE_', $id_fase_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_FASE_', $dt_ini_fase_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_FPA_', $dt_ini_fpa_, PDO::PARAM_STR);
            #$stmt->bindParam(':DT_INI_AF_', $dt_ini_af_, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $ex) {
            $msg = "info_escalas_competencias#1 :" . $ex->getMessage();
        }

        if ($msg == '') {
            $idx = 0;
            try {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    if ($row['ID_EP'] != '' && $row['DT_INI_EP'] != '') {
                            $idx +=1;
                            $escalas[$idx]['cd'] = $row['ID_EP'];
                            $escalas[$idx]['dt'] = $row['DT_INI_EP'];
                    }
                }
            } catch (Exception $ex) {
                $msg = "info_escalas_competencias#2 :" . $ex->getMessage();
            }
        }

        return $escalas;
    }

    #
    # Lista as competências associadas a um ficha de avaliação
    #
    function info_avaliacao_competencias ($empresa_, $id_pa_, $dt_ini_pa_, $id_proc_, $dt_ini_proc_, $rhid_, $dt_adm_, $rhid_avaliador_,
                                          $id_fase_, $dt_ini_fase_, $dt_ini_fpa_, $dt_ini_af_, &$cnt, &$msg) {
        global $db;
        $cnt = 0;
        $msg = '';

        try {

            $sql   = "SELECT a.* ".
                     "      ,b.DSP_COMPETENCIA ".
                     "      ,b.DESCRICAO DESC_COMPETENCIA ".
                     "      ,IFNULL(c.ID_EP,b.ID_EP) ID_EP ".
                     "      ,IFNULL(c.DT_INI_EP,b.DT_INI_EP) DT_INI_EP ".
                     "      ,c.DSP_COMPORTAMENTO ".
                     "      ,c.DESCRICAO DESC_COMPORTAMENTO ".
                     "FROM RH_FICHA_AVAL_COMPORTAMENTOS a ".
                     "    ,RH_DEF_COMPETENCIAS b ".
                     "    ,RH_DEF_COMPORTAMENTOS c ".
                     "WHERE a.EMPRESA = :EMPRESA_ ".
                     "  AND a.ID_PA = :ID_PA_ ".
                     "  AND a.DT_INI_PA = :DT_INI_PA_ ".
                     "  AND a.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                     "  AND a.DT_INI_PROCESSO = :DT_INI_PROCESSO_ ".
                     "  AND a.RHID_AVALIADO = :RHID_ ".
                     "  AND a.DT_ADMISSAO = :DT_ADMISSAO_ ".
#                     "  AND a.RHID_AVALIADOR = '$rhid_avaliador_' ".
                     "  AND a.ID_FASE = :ID_FASE_ ".
                     "  AND a.DT_INI_FASE = :DT_INI_FASE_ ".
                     "  AND a.DT_INI_FPA = :DT_INI_FPA_ ".
#                     "  AND a.DT_INI_AF = '$dt_ini_af_' ".
                     "  AND b.EMPRESA = a.EMPRESA ".
                     "  AND b.ID_COMPETENCIA = a.ID_COMPETENCIA ".
                     "  AND b.DT_INI_COMPETENCIA = a.DT_INI_COMPETENCIA ".
                     "  AND c.EMPRESA = a.EMPRESA ".
                     "  AND c.ID_COMPETENCIA = a.ID_COMPETENCIA ".
                     "  AND c.DT_INI_COMPETENCIA = a.DT_INI_COMPETENCIA ".
                     "  AND c.ID_COMPORTAMENTO = a.ID_COMPORTAMENTO ".
                     "  AND c.DT_INI_COMPORTAMENTO = a.DT_INI_COMPORTAMENTO ".
                     "  AND (b.ID_EP IS NOT NULL OR c.ID_EP IS NOT NULL) ";

            $sql .= "ORDER BY IFNULL(a.NR_ORDEM,0), a.ID_COMPETENCIA, a.ID_COMPORTAMENTO ";

            $stmt = $db->prepare($sql);

            $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PA_', $id_pa_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_PA_', $dt_ini_pa_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PROCESSO_AV_', $id_proc_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_PROCESSO_', $dt_ini_proc_, PDO::PARAM_STR);
            $stmt->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_, PDO::PARAM_STR);
            #$stmt->bindParam(':RHID_AVALIADOR_', $rhid_avaliador_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_FASE_', $id_fase_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_FASE_', $dt_ini_fase_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_FPA_', $dt_ini_fpa_, PDO::PARAM_STR);
            #$stmt->bindParam(':DT_INI_AF_', $dt_ini_af_, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $ex) {
            $msg = "info_avaliacao_competencias#1 :" . $ex->getMessage();
        }

        if ($msg == '') {
            try {
                $cnt = $stmt->rowCount();
                return $stmt;
            } catch (Exception $ex) {
                $msg = "info_escalas_competencias#2 :" . $ex->getMessage();
            }
        }

        return '';

    }

    #
    # Lista os resultado de avaliação de objectivos associados a um ficha de avaliação
    #
    function info_avaliacao_objectivos ($empresa_, $id_pa_, $dt_ini_pa_, $id_proc_, $dt_ini_proc_, $rhid_, $dt_adm_, $rhid_avaliador_,
                                        $id_fase_, $dt_ini_fase_, $dt_ini_fpa_, $dt_ini_af_, &$cnt, &$msg) {

        global $db;
        $cnt = 0;
        $msg = '';

        try {
            $sql =  "SELECT a.* ".
                    "      ,b.DSP_OBJECTIVO ".
                    "      ,b.DESCRICAO DESC_OBJECTIVO ".
                    "      ,b.TIPO_AVALIACAO ".
                    "      ,b.ID_EP ".
                    "      ,b.DT_INI_EP ".
                    "      ,b.ID_MAGNITUDE ".
                    "      ,b.DT_INI_DM ".
                    "      ,b.ID_TP_OBJECTIVO ".
                    "      ,b.DT_INI_DTO ".
                    "FROM RH_ID_AVALIACAO_OBJECTIVOS a ".
                    "    ,RH_DEF_OBJECTIVOS b ".
                    "WHERE a.EMPRESA = :EMPRESA_ ".
                    "  AND a.ID_PA = :ID_PA_ ".
                    "  AND a.DT_INI_PA = :DT_INI_PA_ ".
                    "  AND a.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                    "  AND a.DT_INI_PROCESSO = :DT_INI_PROCESSO_ ".
                    "  AND a.RHID_AVALIADO = :RHID_ ".
                    "  AND a.DT_ADMISSAO = :DT_ADMISSAO_ ".
#                   "  AND a.RHID_AVALIADOR = '$rhid_avaliador_' ".
                    "  AND a.ID_FASE = :ID_FASE_ ".
                    "  AND a.DT_INI_FASE = :DT_INI_FASE_ ".
                    "  AND a.DT_INI_FPA = :DT_INI_FPA_ ".
#                   "  AND a.DT_INI_AF = '$dt_ini_af_' ".
                    "  AND b.EMPRESA = a.EMPRESA ".
                    "  AND b.ID_OBJECTIVO = a.ID_OBJECTIVO ".
                    "  AND b.DT_INI_OBJECTIVO = a.DT_INI_OBJECTIVO ".
                    "ORDER BY a.ID_OBJECTIVO ";

            $stmt = $db->prepare($sql);

            $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PA_', $id_pa_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_PA_', $dt_ini_pa_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PROCESSO_AV_', $id_proc_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_PROCESSO_', $dt_ini_proc_, PDO::PARAM_STR);
            $stmt->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_, PDO::PARAM_STR);
            #$stmt->bindParam(':RHID_AVALIADOR_', $rhid_avaliador_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_FASE_', $id_fase_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_FASE_', $dt_ini_fase_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_FPA_', $dt_ini_fpa_, PDO::PARAM_STR);
            #$stmt->bindParam(':DT_INI_AF_', $dt_ini_af_, PDO::PARAM_STR);
            $stmt->execute();

        } catch (PDOException $ex) {
            $msg = "info_avaliacao_objectivos#1 :" . $ex->getMessage();
        }

        if ($msg == '') {
            try {
                $cnt = $stmt->rowCount();
                return $stmt;
            } catch (Exception $ex) {
                $msg = "info_avaliacao_objectivos#2 :" . $ex->getMessage();
            }
        }

        return '';

    }

    #
    # lista os resultado de avaliação de competencias associados a um ficha de avaliação
    #
    function info_res_avaliacao_competencias ($empresa_, $id_pa_, $dt_ini_pa_, $id_proc_, $dt_ini_proc_, $rhid_, $dt_adm_, $rhid_avaliador_,
                                              $id_fase_, $dt_ini_fase_, $dt_ini_fpa_, $dt_ini_af_, &$cnt, &$msg) {

        global $db;
        $cnt = 0;
        $msg = '';
        $res = array();

        try {
            $sql =  "SELECT a.* ".
                    #"FROM RH_RESUME_COMPETENCIAS_FA a ".
                    "FROM RH_RESULT_COMPETENCIAS a ".
                    "WHERE a.EMPRESA = :EMPRESA_ ".
                    "  AND a.ID_PA = :ID_PA_ ".
                    "  AND a.DT_INI_PA = :DT_INI_PA_ ".
                    "  AND a.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                    "  AND a.DT_INI_PROCESSO = :DT_INI_PROCESSO_ ".
                    "  AND a.RHID_AVALIADO = :RHID_ ".
                    "  AND a.DT_ADMISSAO = :DT_ADMISSAO_ ".
                    #"  AND a.RHID_AVALIADOR = :RHID_AVALIADOR_ ".
                    #"  AND a.ID_FASE = :ID_FASE_ ".
                    #"  AND a.DT_INI_FASE = :DT_INI_FASE_ ".
                    #"  AND a.DT_INI_FPA = :DT_INI_FPA_ ".
                    #"  AND a.DT_INI_AF = :DT_INI_AF_ ".
                    "ORDER BY a.ID_COMPETENCIA ";
            $stmt = $db->prepare($sql);

            $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PA_', $id_pa_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_PA_', $dt_ini_pa_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PROCESSO_AV_', $id_proc_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_PROCESSO_', $dt_ini_proc_, PDO::PARAM_STR);
            $stmt->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_, PDO::PARAM_STR);
            #$stmt->bindParam(':RHID_AVALIADOR_', $rhid_avaliador_, PDO::PARAM_STR);
            #$stmt->bindParam(':ID_FASE_', $id_fase_, PDO::PARAM_STR);
            #$stmt->bindParam(':DT_INI_FASE_', $dt_ini_fase_, PDO::PARAM_STR);
            #$stmt->bindParam(':DT_INI_FPA_', $dt_ini_fpa_, PDO::PARAM_STR);
            #$stmt->bindParam(':DT_INI_AF_', $dt_ini_af_, PDO::PARAM_STR);
            $stmt->execute();

        } catch (PDOException $ex) {
            $msg = "info_res_avaliacao_competencias#1 :" . $ex->getMessage();
        }

        if ($msg == '') {
            try {
                $cnt = $stmt->rowCount();
                return $stmt;
            } catch (Exception $ex) {
                $msg = "info_res_avaliacao_competencias#2 :" . $ex->getMessage();
            }
        }

        return $res;
    }

    #
    # Lista os resultados de avaliação de objectivos associados a um ficha de avaliação
    #
    function info_res_avaliacao_objectivos ($empresa_, $id_pa_, $dt_ini_pa_, $id_proc_, $dt_ini_proc_, $rhid_, $dt_adm_, $rhid_avaliador_,
                                            $id_fase_, $dt_ini_fase_, $dt_ini_fpa_, $dt_ini_af_, &$cnt, &$msg) {
        global $db;
        $cnt = 0;
        $msg = '';
        $res = array();

        try {
            $sql =  "SELECT a.* ".
                    #"FROM RH_RESUME_OBJECTIVOS_FA a ".
                    "FROM RH_RESULT_OBJETIVOS a ".
                    "WHERE a.EMPRESA = :EMPRESA_ ".
                    "  AND a.ID_PA = :ID_PA_ ".
                    "  AND a.DT_INI_PA = :DT_INI_PA_ ".
                    "  AND a.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                    "  AND a.DT_INI_PROCESSO = :DT_INI_PROCESSO_ ".
                    "  AND a.RHID_AVALIADO = :RHID_ ".
                    "  AND a.DT_ADMISSAO = :DT_ADMISSAO_ ".
                    #"  AND a.RHID_AVALIADOR = :RHID_AVALIADOR_ ".
                    #"  AND a.ID_FASE = :ID_FASE_ ".
                    #"  AND a.DT_INI_FASE = :DT_INI_FASE_ ".
                    #"  AND a.DT_INI_FPA = :DT_INI_FPA_ ".
                    #"  AND a.DT_INI_AF = :DT_INI_AF_ ".
                    "ORDER BY a.ID_OBJECTIVO ";

            $stmt = $db->prepare($sql);

            $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PA_', $id_pa_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_PA_', $dt_ini_pa_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PROCESSO_AV_', $id_proc_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_PROCESSO_', $dt_ini_proc_, PDO::PARAM_STR);
            $stmt->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_, PDO::PARAM_STR);
            #$stmt->bindParam(':RHID_AVALIADOR_', $rhid_avaliador_, PDO::PARAM_STR);
            #$stmt->bindParam(':ID_FASE_', $id_fase_, PDO::PARAM_STR);
            #$stmt->bindParam(':DT_INI_FASE_', $dt_ini_fase_, PDO::PARAM_STR);
            #$stmt->bindParam(':DT_INI_FPA_', $dt_ini_fpa_, PDO::PARAM_STR);
            #$stmt->bindParam(':DT_INI_AF_', $dt_ini_af_, PDO::PARAM_STR);
            $stmt->execute();

        } catch (PDOException $ex) {
            $msg = "info_res_avaliacao_objectivos#1 :" . $ex->getMessage();
        }

        if ($msg == '') {
            try {
                $cnt = $stmt->rowCount();
                return $stmt;
            } catch (Exception $ex) {
                $msg = "info_res_avaliacao_objectivos#2 :" . $ex->getMessage();
            }
        }

        return $res;

    }

    #
    # Descodificação de valores de escalas de proficiência
    #
    function dsp_valores_escalas($empresa_, $id_ , $dt_, &$msg) {

        global $db;
        $msg = '';

        $sql =  "SELECT * ".
                "FROM  RH_NIVEIS_ESCALA_PROFICIENCIA ".
                "WHERE EMPRESA = :EMPRESA_ ".
                "  AND ID_EP = :ID_EP_ ".
                "  AND DT_INI_EP = :DT_INI_EP_ ".
                "ORDER BY IFNULL(NR_ORD,0), ID_NV_ESCALA ";
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_EP_', $id_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_EP_', $dt_, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $ex) {
            $msg = "dsp_valores_escalas#1 :" . $ex->getMessage();
        }

        if ($msg == '') {
            try {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $nv_escala[] = $row;
                }
            } catch (Exception $ex) {
                $msg = "dsp_valores_escalas#2 :" . $ex->getMessage();
            }
        }

        return $nv_escala;
    }

    #
    # Descodificação de um nivel de proficiência
    #
    function dsp_nivel_escala($empresa_, $id_ , $dt_, $nv_, &$msg) {

        global $db;
        $msg = '';
        $result = '';

        $sql = "SELECT *, IFNULL(DSR_NEP,DSP_NEP) DSP_ ".
               "FROM  RH_NIVEIS_ESCALA_PROFICIENCIA ".
               "WHERE EMPRESA = :EMPRESA_ ".
               "  AND ID_EP = :ID_EP_ ".
               "  AND DT_INI_EP = :DT_INI_EP_ ".
               "  AND ID_NV_ESCALA = :ID_NV_ESCALA_ ";

        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_EP_', $id_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_EP_', $dt_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_NV_ESCALA_', $nv_, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            $msg = "dsp_nivel_escala#1 :" . $ex->getMessage();
        }

        if ($msg == '') {
            try {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                   $result =  $row['DSP_'];
                }
            } catch (Exception $e) {
                $msg = "dsp_nivel_escala#2 :" . $ex->getMessage();
            }
        }

        return $result;
    }

    #
    # lista com valores de uma escala de proficiência
    #
    function list_nivel_escala($empresa_, $id_ , $dt_, $nv_, &$msg) {

        global $db;
        $msg = '';
        $result = '';

        $sql = "SELECT *, IFNULL(DSR_NEP,DSP_NEP) DSP_ ".
               "FROM  RH_NIVEIS_ESCALA_PROFICIENCIA ".
               "WHERE EMPRESA = :EMPRESA_ ".
               "  AND ID_EP = :ID_EP_ ".
               "  AND DT_INI_EP = :DT_INI_EP_ ".
               "ORDER BY IFNULL(NR_ORD,0), ID_NV_ESCALA ";

        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_EP_', $id_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_EP_', $dt_, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            $msg = "list_nivel_escala#1 :" . $ex->getMessage();
        }

        if ($msg == '') {
            try {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    if ($nv_ == $row['ID_NV_ESCALA']) {
                        $result .= '<option value="' . $row['ID_NV_ESCALA'].'@'.$row['DT_INI_NV_ESCALA']. '" selected>' . $row['DSP_'] . '</option>';
                    } else {
                        $result .= '<option value="' . $row['ID_NV_ESCALA'].'@'.$row['DT_INI_NV_ESCALA']. '" >' . $row['DSP_'] . '</option>';
                    }
                }
            } catch (Exception $e) {
                $msg = "list_nivel_escala#2 :" . $ex->getMessage();
            }
        }

        return $result;

    }

    #
    # Descodificação uma magnitude
    #
    function dsp_magnitude($id_ , $dt_, &$msg) {

        global $db;
        $msg = '';
        $result = '';

        $sql = "SELECT *, IFNULL(DSR_MAGNITUDE,DSP_MAGNITUDE) DSP_ ".
               "FROM  RH_DEF_MAGNITUDES ".
               "WHERE ID_MAGNITUDE = :ID_MAGNITUDE_ ".
               "  AND DT_INI_DM = :DT_INI_DM_ ";

        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':ID_MAGNITUDE_', $id_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_DM_', $dt_, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            $msg = "dsp_magnitude#1 :" . $ex->getMessage();
        }

        if ($msg == '') {
            try {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                   $result =  $row['DSP_'];
                }
            } catch (Exception $e) {
                $msg = "dsp_magnitude#2 :" . $ex->getMessage();
            }
        }

        return $result;
    }

    #
    # Obtenção das observações associadas a uma avaliação
    #
    function get_obs_avaliacao($empresa_, $id_pa_, $dt_ini_pa_, $id_proc_, $dt_ini_proc_, $tp_, $rhid_, $dt_adm_, $rhid_avaliador_, &$msg) {

        global $db;
        $msg = '';
        $resultado = '';

        if ($tp_ == 'AVALIADOR') {
		$sql .=  "SELECT a.COMENTARIO_AVALIADOR ";
	} else {
		$sql .=  "SELECT a.COMENTARIO_AVALIADO ";
        }

	$sql .=  "FROM MASTER_AVALIACAO a ".
                "WHERE a.EMPRESA = :EMPRESA_ ".
                 " AND a.ID_PA = :ID_PA_ ".
                 " AND a.DT_INI_PA = :DT_INI_PA_ ".
                 " AND a.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                 " AND a.DT_INI_PROCESSO = :DT_INI_PROCESSO_ ".
                 " AND a.RHID = :RHID_ ".
                 " AND a.DT_ADMISSAO = :DT_ADMISSAO_ ";
        if ($tp_ == 'AVALIADOR') {
            $sql .= " AND a.RHID_AVALIADOR = :RHID_AVALIADOR_ ";
        }

        try {
            $stmt = $db->prepare($sql);

            $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PA_', $id_pa_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_PA_', $dt_ini_pa_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PROCESSO_AV_', $id_proc_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_PROCESSO_', $dt_ini_proc_, PDO::PARAM_STR);
            $stmt->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_, PDO::PARAM_STR);
            if ($tp_ == 'AVALIADOR') {
                $stmt->bindParam(':RHID_AVALIADOR_', $rhid_avaliador_, PDO::PARAM_STR);
            }
            $stmt->execute();

        } catch (PDOException $ex) {
            $msg = "get_obs_avaliacao#1 :" . $ex->getMessage();
        }

        if ($msg == '') {
            try {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		        if ($tp_ == 'AVALIADOR') {
	                   $resultado = $row['COMENTARIO_AVALIADOR'];
			} else {
	                   $resultado = $row['COMENTARIO_AVALIADO'];
		        }
                }
            } catch (Exception $ex) {
                $msg = "get_obs_avaliacao#2 :" . $ex->getMessage();
            }
        }

        return $resultado;
    }

    #
    # Determinação do tipo de avaliação - ficha, homologação, entrevista ou outra
    #
    function tipo_avaliacao ($empresa_, $id_pa_, $dt_ini_pa_, $id_proc_av_, $dt_ini_proc_,
                             $id_fase_, $dt_ini_fase_, $dt_ini_fpa_,
                             &$tp_aval, &$dsp_tp_aval, &$msg) {
        #
        #	Tipo Fase Avaliação (FICHA_AVAL)
        #       	S	Geração fichas de avaliação
        #       	A       Geração fichas de avaliação intermédias
        #       	B	Entrevistas
        #       	C	Homologação Resultados
        #       	F	Homologação Fichas
        #       	N	Processual DRH - não aplicável no portal
        #
        global $db;
        $msg = '';
        $tp_aval = '';
        $dsp_tp_aval = '';

        $sql =  "SELECT * FROM RH_FASES_FONTES_PROCESSO a ".
                "WHERE 1=1 ";

        if ($empresa_ != '')
            $sql .= " AND a.EMPRESA = :EMPRESA_ ";

        if ($id_pa_ != '')
            $sql .= " AND a.ID_PA = :ID_PA_ ";

        if ($dt_ini_pa_ != '')
            $sql .= " AND a.DT_INI_PA = :DT_INI_PA_ ";

        if ($id_proc_av_ != '')
           $sql .= " AND a.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ";

        if ($dt_ini_proc_ != '')
           $sql .= " AND a.DT_INI_PROCESSO = :DT_INI_PROCESSO_ ";

        if ($id_fase_ != '')
           $sql .= " AND a.ID_FASE = :ID_FASE_ ";

        if ($dt_ini_fase_ != '')
           $sql .= " AND a.DT_INI_FASE = :DT_INI_FASE_ ";

#       if ($dt_ini_fpa_ != '')
#           $sql .= " AND a.DT_INI_FPA = :DT_INI_FPA_ ";

        try {
            $stmt = $db->prepare($sql);

            $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PA_', $id_pa_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_PA_', $dt_ini_pa_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PROCESSO_AV_', $id_proc_av_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_PROCESSO_', $dt_ini_proc_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_FASE_', $id_fase_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_FASE_', $dt_ini_fase_, PDO::PARAM_STR);
#           $stmt->bindParam(':DT_INI_FPA_', $dt_ini_fpa_, PDO::PARAM_STR);

            $stmt->execute();

        } catch (PDOException $ex) {
            $msg = "tipo_avaliacao#1 :" . $ex->getMessage();
        }

        if ($msg == '') {
            try {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                   #	Tipo Fase Avaliação (FICHA_AVAL)
                   #       	S	Geração fichas de avaliação
                   #       	A       Geração fichas de avaliação intermédias
                   #       	B	Entrevistas
                   #       	C	Homologação Resultados
                   #       	F	Homologação Fichas
                   #       	N	Processual DRH - não aplicável no portal
                   $tp_aval = $row['FICHA_AVAL'];
                   $dsp_tp_aval = dsp_dominio('GE_EVENTO_AVAL', $tp_aval, $msg);
                }
            } catch (Exception $ex) {
                $msg = "tipo_avaliacao#2 :" . $ex->getMessage();
            }
        }
    }

    #
    # Determina a ficha de avaliação de mais alto nível sobre a qual é efectuada a homologação de resultados
    #
    function homologacao_aval($empresa_, $id_pa_, $dt_ini_pa_, $id_proc_, $dt_ini_proc_, $rhid_, $dt_adm_, $id_ficha_, &$cnt, &$msg) {

        global $db;
        $msg = '';
        $cnt = 0;
        $res = array();

        $sql =  "SELECT a.* ".
                "FROM MASTER_AVALIACAO a ".
                "WHERE a.EMPRESA = :EMPRESA_ ".
                " AND a.ID_PA = :ID_PA_ ".
                " AND a.DT_INI_PA = :DT_INI_PA_ ".
                " AND a.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                " AND a.DT_INI_PROCESSO = :DT_INI_PROCESSO_ ".
                " AND a.RHID = :RHID ".
                " AND a.DT_ADMISSAO = :DT_ADMISSAO_ ";
                " AND a.ID_FICHA != :ID_FICHA_ ".
                "ORDER BY a.NR_ORDEM DESC, a.ID_FASE DESC";

        try {
            $stmt = $db->prepare($sql);

            $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PA_', $id_pa_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_PA_', $dt_ini_pa_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PROCESSO_AV_', $id_proc_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_PROCESSO_', $dt_ini_proc_, PDO::PARAM_STR);
            $stmt->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_FICHA_', $id_ficha_, PDO::PARAM_STR);

            $stmt->execute();

        } catch (PDOException $ex) {
            $msg = "homologacao_aval#1 :" . $ex->getMessage();
        }

        if ($msg == '') {
            try {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                    tipo_avaliacao ($row['EMPRESA'], $row['ID_PA'], $row['DT_INI_PA'], $row['ID_PROCESSO_AV'], $row['DT_INI_PROCESSO'],
                                    $row['ID_FASE'], $row['DT_INI_FASE'], $row['DT_INI_FPA'],
                                    $tp_aval, $dsp_tp_aval, $msg);

                    #	Tipo Fase Avaliação (FICHA_AVAL)
                    #       	S	Geração fichas de avaliação
                    #       	A       Geração fichas de avaliação intermédias
                    #       	B	Entrevistas
                    #       	C	Homologação Resultados
                    #       	F	Homologação Fichas
                    #       	N	Processual DRH - não aplicável no portal
                    if ($tp_aval == 'S' && $msg == '') {
#echo "fase :".$row['ID_FASE'].' - '.$row['DSP_FASE']." tp_aval:$tp_aval <br/>";
                       $cnt = 1;
                       return $row;
                    }
                }
            } catch (Exception $ex) {
                $msg = "homologacao_aval#2 :" . $ex->getMessage();
            }
        }
        return array();
    }


    #
    # Devolve a nota final de uma avaliação
    #
    function nota_final ($empresa_, $id_pa_, $dt_ini_pa_, $id_proc_av_, $dt_ini_proc_, $rhid_, $dt_adm_, &$nota_final, &$obj_final, &$comp_final, &$msg) {

        global $db;
        $msg = '';
        $obj_final = '';
        $comp_final = '';
        $nota_final = '';

        $sql =  "SELECT a.NOTA_FINAL, a.OBJ_FINAL, a.COMP_FINAL ".
                "FROM RH_DESEMPENHO_NOTA_FINAL a ".
                "WHERE 1 = 1 ";

        if ($empresa_ != '')
            $sql .= " AND a.EMPRESA = :EMPRESA_ ";

        if ($id_pa_ != '')
            $sql .= " AND a.ID_PA = :ID_PA_ ";

        if ($dt_ini_pa_ != '')
            $sql .= " AND a.DT_INI_PA = :DT_INI_PA_ ";

        if ($id_proc_av_ != '')
            $sql .= " AND a.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ";

        if ($dt_ini_proc_ != '')
            $sql .= " AND a.DT_INI_PROCESSO = :DT_INI_PROCESSO_ ";

        if ($dt_ini_proc_ != '')
            $sql .= " AND a.DT_INI_PROCESSO = :DT_INI_PROCESSO_ ";

        if ($rhid_ != '')
            $sql .= " AND a.RHID_AVALIADO = :RHID_AVALIADO_ ";

        if ($dt_adm_ != '')
            $sql .= " AND a.DT_ADMISSAO = :DT_ADMISSAO_ ";

        try {
            $stmt = $db->prepare($sql);

            if ($empresa_ != '')
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);

            if ($id_pa_ != '')
                $stmt->bindParam(':ID_PA_', $id_pa_, PDO::PARAM_STR);

            if ($dt_ini_pa_ != '')
                $stmt->bindParam(':DT_INI_PA_', $dt_ini_pa_, PDO::PARAM_STR);

            if ($id_proc_av_ != '')
                $stmt->bindParam(':ID_PROCESSO_AV_', $id_proc_av_, PDO::PARAM_STR);

            if ($dt_ini_proc_ != '')
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_ini_proc_, PDO::PARAM_STR);

            if ($rhid_ != '')
                $stmt->bindParam(':RHID_AVALIADO_', $rhid_, PDO::PARAM_STR);

            if ($dt_adm_ != '')
                $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_, PDO::PARAM_STR);

            $stmt->execute();

        } catch (PDOException $ex) {
            $msg = "nota_final#1 :" . $ex->getMessage();
        }

        if ($msg == '') {
            try {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $nota_final = $row['NOTA_FINAL'];
                    $obj_final = $row['OBJ_FINAL'];
                    $comp_final = $row['COMP_FINAL'];
                }
            } catch (Exception $ex) {
                $msg = "nota_final#2 :" . $ex->getMessage();
            }
        }
        return '';
    }


    #
    # Determina a fase associado à Homologação de resultados da ficha de avaliação
    #
    function get_fase_homolog_fichas($empresa_, $id_pa_, $dt_ini_pa_, $id_proc_, $dt_ini_proc_, $rhid_, $dt_adm_, &$msg) {

        global $db;
        $msg = '';
        $cnt = 0;
        $res = array();

        $sql = "SELECT X.* ".
               "FROM MASTER_AVALIACAO X, RH_FASES_FONTES_PROCESSO A ".
                "WHERE X.EMPRESA = :EMPRESA_ ".
                "  AND X.ID_PA = :ID_PA_ ".
                "  AND X.DT_INI_PA = :DT_INI_PA_ ".
                "  AND X.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                "  AND X.DT_INI_PROCESSO = :DT_INI_PROCESSO_ ".
                "  AND X.RHID = :RHID_ ".
                "  AND X.DT_ADMISSAO = :DT_ADMISSAO_ ".
                "  AND A.EMPRESA = X.EMPRESA  ".
                "  AND A.ID_PA = X.ID_PA ".
                "  AND A.DT_INI_PA = X.DT_INI_PA ".
                "  AND A.ID_PROCESSO_AV = X.ID_PROCESSO_AV ".
                "  AND A.DT_INI_PROCESSO = X.DT_INI_PROCESSO ".
                "  AND A.ID_FASE = X.ID_FASE ".
                "  AND A.DT_INI_FASE = X.DT_INI_FASE ".
                "  AND A.DT_INI_FPA = X.DT_INI_FPA ".
                "  AND A.FICHA_AVAL IN ('F') ";

        try {
            $stmt = $db->prepare($sql);

            $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PA_', $id_pa_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_PA_', $dt_ini_pa_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PROCESSO_AV_', $id_proc_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_PROCESSO_', $dt_ini_proc_, PDO::PARAM_STR);
            $stmt->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_, PDO::PARAM_STR);

            $stmt->execute();

        } catch (PDOException $ex) {
            $msg = "get_fase_homolog_fichas#1 :" . $ex->getMessage();
        }

        if ($msg == '') {
            try {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                return $row;
            } catch (Exception $ex) {
                $msg = "get_fase_homolog_fichas#2 :" . $ex->getMessage();
            }
        }
        return array();
    }
    

    #
    # FUNÇÕES DE IMPLEMENTAÇÃO DO PROCESSO
    #

    function get_estado_processo($empresa_, $id_pa_, $dt_ini_pa_, $id_proc_av_, $dt_ini_proc_, &$estado_, &$dsp_estado_, &$msg) {
        global $db;
        $msg = '';
        $estado_ = '';
        $dsp_estado_ = '';
        try {
            $stmt = $db->prepare("SELECT GE_ESTADO_PROC_AVALIACAO(A.EMPRESA,A.ID_PA,A.DT_INI_PA,A.ID_PROCESSO_AV,A.DT_INI_PROCESSO) ESTADO ".
                                  "      ,DOMINIO('GE_ESTADO_PROC_AVAL',GE_ESTADO_PROC_AVALIACAO(A.EMPRESA,A.ID_PA,A.DT_INI_PA,A.ID_PROCESSO_AV,A.DT_INI_PROCESSO),'') DSP_ESTADO ".
                                  "FROM RH_PROCESSOS_AVALIACAO A ".
                                  "WHERE EMPRESA = :EMPRESA_ ".
                                  "  AND ID_PA = :ID_PA_ ".
                                  "  AND DT_INI_PA = :DT_INI_PA_ ".
                                  "  AND ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                                  "  AND DT_INI_PROCESSO = :DT_INI_PROCESSO_ ");


            $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PA_', $id_pa_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_PA_', $dt_ini_pa_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PROCESSO_AV_', $id_proc_av_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_PROCESSO_', $dt_ini_proc_, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $estado_ = $row['ESTADO'];
            $dsp_estado_ = $row['DSP_ESTADO'];
        } catch (Exception $ex) {
            $msg = "get_estado_processo#1:" . $ex->getMessage();
        }
    }


    #
    # Cria todas as combinações fases/fontes associadas a um processo de avaliação
    #
    function build_fases_fontes_proposal($empresa_, $plano_, $dt_plano_, $processo_, $dt_processo_, &$msg) {

        global  $db
               ,$error_end_dt_greater;
        $msg = '';
        $dt_ini_ =  '';
        $dt_fim_ =  '';
        $nulo = null;

        try {
            $stmt2 = $db->prepare(  "DELETE FROM  RH_FASES_FONTES_PROCESSO " .
                                    "WHERE EMPRESA = :EMPRESA_ ".
                                    "  AND ID_PA = :ID_PA_ ".
                                    "  AND DT_INI_PA = :DT_INI_PA_ ".
                                    "  AND ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                                    "  AND DT_INI_PROCESSO = :DT_INI_PROCESSO_ ");

            $stmt2->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
            $stmt2->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
            $stmt2->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
            $stmt2->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
            $stmt2->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
            $stmt2->execute();
        } catch (PDOException $ex) {
            $msg = "build_fases_fontes_proposal#0 :" . $ex->getMessage();
        }

        if ($msg == '') {

            try {
                $sql =  "SELECT A.TECNICA_AVALIACAO, A.FONTE_AVALIACAO, A.DT_INI_TAP, A.DT_FIM_TAP, A.DT_INI_FA, ".
                        " B.ID_FASE, B.DT_INI_FPA, B.DT_FIM_FPA, C.DSR_FASE, C.DT_INI_FASE, ".
                        " A.ID_PA, A.DT_INI_PA, A.ID_PROCESSO_AV, A.DT_INI_PROCESSO, A.EMPRESA, E.FICHA_AVAL ".
                        "FROM RH_TECNICAS_AVAL_PROCESSO A, RH_FASES_PROCESSO_AVAL B, ".
                        "     RH_DEF_FASES C, RH_DEF_FONTES_AVALIACAO D, RH_DEF_FASE_FONTES E ".
                        "WHERE A.ID_PA = :ID_PA_ ".
                        "  AND   A.DT_INI_PA = :DT_INI_PA_ ".
                        "  AND   A.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                        "  AND   A.DT_INI_PROCESSO = :DT_INI_PROCESSO_ ".
                        "  AND   A.EMPRESA = :EMPRESA_ ".
                        "  AND   A.ID_PA = B.ID_PA ".
                        "  AND   A.DT_INI_PA = B.DT_INI_PA ".
                        "  AND   A.ID_PROCESSO_AV = B.ID_PROCESSO_AV ".
                        "  AND   A.DT_INI_PROCESSO = B.DT_INI_PROCESSO ".
                        "  AND   A.EMPRESA = B.EMPRESA ".
                        "  AND   B.ID_FASE = C.ID_FASE ".
                        "  AND   B.DT_INI_FASE = C.DT_INI_FASE ".
                        "  AND   A.FONTE_AVALIACAO = D.FONTE_AVALIACAO ".
                        "  AND   A.TECNICA_AVALIACAO = D.TECNICA_AVALIACAO ".
                        "  AND   A.DT_INI_FA = D.DT_INI_FA ".
                        "  AND   E.ID_FASE = B.ID_FASE ".
                        "  AND   E.DT_INI_FASE = B.DT_INI_FASE ".
                        "  AND   E.TECNICA_AVALIACAO = A.TECNICA_AVALIACAO ".
                        "  AND   E.DT_INI_FA = A.DT_INI_FA ".
                        "  AND   E.FONTE_AVALIACAO = A.FONTE_AVALIACAO ".
                        "  AND   E.DT_FIM_FF IS NULL";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->execute();

            } catch (PDOException $ex) {
                $msg = "build_fases_fontes_proposal#1 :" . $ex->getMessage();
            }
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                try {

                    # Determinação da Data Início
                    if ($row['DT_INI_TAP'] >= $row['DT_INI_FPA']) {
                        $dt_ini_ = $row['DT_INI_TAP'];
                    } else {
                        $dt_ini_ = $row['DT_INI_FPA'];
                    }

                    # Determinação da Data Fim
                    if ($row['DT_FIM_TAP'] >= $row['DT_FIM_FPA']) {
                        $dt_fim_ = $row['DT_FIM_FPA'];
                    } else {
                        $dt_fim_ = $row['DT_FIM_TAP'];
                    }

                    # Validação da coerência das datas do registo
                    if ($dt_ini_ > $dt_fim_ && $dt_fim_ != '') {
                        $msg = $error_end_dt_greater;
                    }

                    # Validação da data início com a definida nas Fontes do processo
/*                    if (!($dt_ini_ >= $row['DT_INI_TAP'] && $dt_ini_ <= $row['DT_FIM_TAP']) && $row['DT_FIM_TAP'] != '' && $msg == '') {
                        $msg = "A data início [$dt_ini_] determinada é inválida, por não estar compreendida no período definido para a Fonte [" . $row['DT_INI_TAP'] . "-" . $row['DT_FIM_TAP'] . "].".
                                "PF reveja e retifique as datas definidas para as Fontes e as Fases associadas ao Processo de Avaliação.";
                    }

                    # Validação da data início com a definida na Fase do processo
                    if (!($dt_ini_ >= $row['DT_INI_FPA'] && $dt_ini_ <= $row['DT_FIM_FPA']) && $row['DT_FIM_FPA'] != '' && $msg == '') {
                        $msg = "A data início [$dt_ini_] determinada é inválida, por não estar compreendida no período definido para a Fase [" . $row['DT_INI_FPA'] . "-" . $row['DT_FIM_FPA'] . "].".
                               "PF reveja e retifique as datas definidas para as Fontes e as Fases associadas ao Processo de Avaliação.";
                    }

                    # Validação da data fim com a definida nas Fontes do processo
                    if (!($dt_fim_ >= $row['DT_INI_TAP'] && $dt_fim_ <= $row['DT_FIM_TAP']) && $dt_fim_ != '' && $row['DT_FIM_TAP'] != '' && $msg == '') {
                        $msg = "A data fim [$dt_fim_] determinada é inválida, por não estar compreendida no período definido para a Fonte.".
                               "PF reveja e retifique as datas definidas para as Fontes e as Fases associadas ao Processo de Avaliação.";
                    }

                    # Validação da data fim com a definida na Fase do processo
                    if (!($dt_fim_ >= $row['DT_INI_FPA'] && $dt_fim_ <= $row['DT_FIM_FPA']) && $dt_fim_ != '' && $row['DT_FIM_FPA'] != '' && $msg == '') {
                        $msg = "A data fim [$dt_fim_] determinada é inválida, por não estar compreendida no período definido para a Fase.".
                               "PF reveja e retifique as datas definidas para as Fontes e as Fases associadas ao Processo de Avaliação.";
                    }
*/

                    if ($msg == '') {
                        $stmt2 = $db->prepare("INSERT INTO RH_FASES_FONTES_PROCESSO " .
                                              "(EMPRESA,ID_PA,DT_INI_PA,ID_PROCESSO_AV,DT_INI_PROCESSO,FONTE_AVALIACAO,DT_INI_FA, ".
                                              " DT_INI_TAP,TECNICA_AVALIACAO,ID_FASE,DT_INI_FASE,DT_INI_FPA,DT_INI_FF,DT_FIM_FF,FICHA_AVAL,DESCRICAO) " .
                                              "VALUES(:EMPRESA_,:ID_PA_,:DT_INI_PA_,:ID_PROCESSO_AV_,:DT_INI_PROCESSO_,:FONTE_AVALIACAO_,:DT_INI_FA_".
                                              ",:DT_INI_TAP_,:TECNICA_AVALIACAO_,:ID_FASE_,:DT_INI_FASE_,:DT_INI_FPA_,:DT_INI_FF_,:DT_FIM_FF_,:FICHA_AVAL_,:DESCRICAO_) ".
                                              " ON DUPLICATE KEY UPDATE " .
                                              " DT_INI_FF = :DT_INI_FF_ ".
                                              ",DT_FIM_FF = :DT_FIM_FF_ ".
                                              ",FICHA_AVAL = :FICHA_AVAL_ ".
                                              ",DESCRICAO = :DESCRICAO_ ");

                        $stmt2->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                        $stmt2->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                        $stmt2->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                        $stmt2->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                        $stmt2->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                        $stmt2->bindParam(':FONTE_AVALIACAO_', $row['FONTE_AVALIACAO'], PDO::PARAM_STR);
                        $stmt2->bindParam(':DT_INI_FA_', $row['DT_INI_FA'], PDO::PARAM_STR);
                        $stmt2->bindParam(':DT_INI_TAP_', $row['DT_INI_TAP'], PDO::PARAM_STR);
                        $stmt2->bindParam(':TECNICA_AVALIACAO_', $row['TECNICA_AVALIACAO'], PDO::PARAM_STR);
                        $stmt2->bindParam(':ID_FASE_', $row['ID_FASE'], PDO::PARAM_STR);
                        $stmt2->bindParam(':DT_INI_FASE_', $row['DT_INI_FASE'], PDO::PARAM_STR);
                        $stmt2->bindParam(':DT_INI_FPA_', $row['DT_INI_FPA'], PDO::PARAM_STR);
                        $stmt2->bindParam(':DT_INI_FF_', $dt_ini_, PDO::PARAM_STR);

                        if ($dt_fim_ == '') {
                            $stmt2->bindParam(':DT_FIM_FF_', $nulo, PDO::PARAM_NULL);
                        } else {
                            $stmt2->bindParam(':DT_FIM_FF_', $dt_fim_, PDO::PARAM_STR);
                        }

                        if ($row['FICHA_AVAL'] == '') {
                            $stmt2->bindParam(':FICHA_AVAL_', $nulo, PDO::PARAM_NULL);
                        } else {
                            $stmt2->bindParam(':FICHA_AVAL_', $row['FICHA_AVAL'], PDO::PARAM_STR);
                        }

                        $stmt2->bindParam(':DESCRICAO_', $nulo, PDO::PARAM_NULL);

                        $stmt2->execute();
                    }

                } catch (PDOException $ex) {
                    $msg = "build_fases_fontes_proposal#2:" . $ex->getMessage();
                }
            }
        }
    }


    ##  PROCESSOS
    ##
    ##      1. Identificação Avaliados - get_avaliados
    ##      2. Selecção Avaliadores - get_avaliadores
    ##      3. Distribuição Avaliadores p/ Fases - get_avaliadores_fase
    ##      4. Geração Fichas Avaliação - get_fichas_avaliacao
    ##


    #
    # Popula os Avaliados
    #
    # Filtro por:
    #   - direção/departamento
    #   - setores
    #   - funções
    #   - grupos funcionais
    #   - limite mínimo de meses de serviço
    #
    function insere_avaliado ($empresa_, $plano_, $dt_plano_, $processo_, $dt_processo_,
                              $rhid_, $nome_, $dt_adm_, $estab_, $setor_, $dir_, $dept_, $estrut_, $sit_, $vinc_, $func_, $grpfunc_, &$msg) {
        global $db;
        $msg = '';
        $nulo = null;

        try {
            # V1: SITUACAO (CD)
            # V2: ESTAB (CD)
            # V3: DIRECAO (ID)
            # V4: DEPARTAMENTO (ID)
            # V5: SETOR (ID
            # V6: FUNCAO (ID)
            # V7: GRP_FUNCIONAL  (ID)
            # V8: ESTRUTURA (ID)
            # V9: VINC (CD)
            # V10:

            $v1 = $sit_;
            $v2 = $estab_;
            $v3 = $dir_; #.','.$row['DT_INI_DIRECAO'];
            $v4 = $dept_; #.','.$row['DT_DEPT'];
            $v5 = $setor_; #.','.$row['DT_INI_SETOR'];
            $v6 = $func_; #.','.$row['DT_INI_FUNCAO'];
            $v7 = $grpfunc_; #.','.$row['DT_INI_GRP_FUNC'];
            $v8 = $estrut_; #.','.$row['DT_INI_ESTRUTURA'];
            $v9 = $vinc_;
            $v10 = '';
            $stmt2 = $db->prepare(  "INSERT INTO RH_AVALIADOS ".
                                    "(EMPRESA, ID_PA, DT_INI_PA, ID_PROCESSO_AV, DT_INI_PROCESSO, RHID, DT_ADMISSAO, ".
                                    " CONCORDANCIA, TY_FLEXALPHA_V1, TY_FLEXALPHA_V2, TY_FLEXALPHA_V3, TY_FLEXALPHA_V4,".
                                    " TY_FLEXALPHA_V5, TY_FLEXALPHA_V6, TY_FLEXALPHA_V7, TY_FLEXALPHA_V8, TY_FLEXALPHA_V9, TY_FLEXALPHA_V10) ".
                                    "VALUES (:EMPRESA_, :ID_PA_, :DT_INI_PA_, :ID_PROCESSO_AV_, :DT_INI_PROCESSO_, :RHID_, :DT_ADMISSAO_, ".
                                    " NULL, :V1_, :V2_, :V3_, :V4_, :V5_, :V6_, :V7_, :V8_, :V9_, :V10_) ".
                                    " ON DUPLICATE KEY UPDATE " .
                                    " CONCORDANCIA = NULL ".
                                    ",TY_FLEXALPHA_V1 = :V1_ ".
                                    ",TY_FLEXALPHA_V2 = :V2_ ".
                                    ",TY_FLEXALPHA_V3 = :V3_ ".
                                    ",TY_FLEXALPHA_V4 = :V4_ ".
                                    ",TY_FLEXALPHA_V5 = :V5_ ".
                                    ",TY_FLEXALPHA_V6 = :V6_ ".
                                    ",TY_FLEXALPHA_V7 = :V7_ ".
                                    ",TY_FLEXALPHA_V8 = :V8_ ".
                                    ",TY_FLEXALPHA_V9 = :V9_ ".
                                    ",TY_FLEXALPHA_V10 = :V10_ ");

            $stmt2->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
            $stmt2->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
            $stmt2->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
            $stmt2->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
            $stmt2->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
            $stmt2->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
            $stmt2->bindParam(':DT_ADMISSAO_', $dt_adm_, PDO::PARAM_STR);

            if ($v1 == '') {
                $stmt2->bindParam(':V1_', $nulo, PDO::PARAM_NULL);
            } else {
                $stmt2->bindParam(':V1_', $v1, PDO::PARAM_STR);
            }

            if ($v2 == '') {
                $stmt2->bindParam(':V2_', $nulo, PDO::PARAM_NULL);
            } else {
                $stmt2->bindParam(':V2_', $v2, PDO::PARAM_STR);
            }

            if ($v3 == ',') {
                $stmt2->bindParam(':V3_', $nulo, PDO::PARAM_NULL);
            } else {
                $stmt2->bindParam(':V3_', $v3, PDO::PARAM_STR);
            }

            if ($v4 == ',') {
                $stmt2->bindParam(':V4_', $nulo, PDO::PARAM_NULL);
            } else {
                $stmt2->bindParam(':V4_', $v4, PDO::PARAM_STR);
            }

            if ($v5 == ',') {
                $stmt2->bindParam(':V5_', $nulo, PDO::PARAM_NULL);
            } else {
                $stmt2->bindParam(':V5_', $v5, PDO::PARAM_STR);
            }

            if ($v6 == ',') {
                $stmt2->bindParam(':V6_', $nulo, PDO::PARAM_NULL);
            } else {
                $stmt2->bindParam(':V6_', $v6, PDO::PARAM_STR);
            }

            if ($v7 == ',') {
                $stmt2->bindParam(':V7_', $nulo, PDO::PARAM_NULL);
            } else {
                $stmt2->bindParam(':V7_', $v7, PDO::PARAM_STR);
            }

            if ($v8 == '') {
                $stmt2->bindParam(':V8_', $nulo, PDO::PARAM_NULL);
            } else {
                $stmt2->bindParam(':V8_', $v8, PDO::PARAM_STR);
            }

            if ($v9 == '') {
                $stmt2->bindParam(':V9_', $nulo, PDO::PARAM_NULL);
            } else {
                $stmt2->bindParam(':V9_', $v9, PDO::PARAM_STR);
            }

            if ($v10 == '') {
                $stmt2->bindParam(':V10_', $nulo, PDO::PARAM_NULL);
            } else {
                $stmt2->bindParam(':V10_', $v10, PDO::PARAM_STR);
            }

            $stmt2->execute();

        } catch (Exception $ex) {
            $msg = "insere_avaliado#1:" . $ex->getMessage();
        }
    }


    function get_avaliados($empresa_, $plano_, $dt_plano_, $processo_, $dt_processo_,
                           $colabs, $estabs, $setores, $direcoes, $departs, $estruts, $funcoes, $grupos_func, $vincs, $sits, $lim_meses_serv, &$msg) {

        global $db;
        $msg = '';
        if ($colabs == '') {
            $colabs = array();
        }
        
        $colabs = ($colabs == '' ? array(): $colabs);
        $estabs = ($estabs == '' ? array(): $estabs);
        $setores = ($setores == '' ? array(): $setores);
        $direcoes = ($direcoes == '' ? array(): $direcoes);
        $departs = ($departs == '' ? array(): $departs);
        $estruts = ($estruts == '' ? array(): $estruts);
        $funcoes = ($funcoes == '' ? array(): $funcoes);
        $grupos_func = ($grupos_func == '' ? array(): $grupos_func);
        $vincs = ($vincs == '' ? array(): $vincs);
        $sits = ($sits == '' ? array(): $sits);
        
        if (count($colabs) > 0) {
            foreach ($colabs as $row) {

                $p = explode("@",$row);
                $emp_ = $p[0];
                $rhid_ = $p[1];
                $dt_adm_ = $p[2];

                $sql = "SELECT * FROM QUAD_PEOPLE WHERE EMPRESA = :EMPRESA_ AND RHID = :RHID_ AND DT_ADMISSAO = :DT_ADM_ ";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $emp_);
                $stmt->bindParam(':RHID_', $rhid_);
                $stmt->bindParam(':DT_ADM_', $dt_adm_);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

#echo "#1: rhid:".$row['RHID']." nome:".$row['NOME']." dt_adm:".$row['DT_ADMISSAO'].
#     " estab:".$row['CD_ESTAB']." setor:".$row['ID_SETOR']." dir:".$row['CD_DIRECAO']." dept:".$row['CD_DEPT'].
#     " estrut:".$row['CD_ESTRUTURA']." sit:".$row['CD_SITUACAO']." vinc:".$row['CD_VINCULO'].
#     " func:".$row['ID_FUNCAO']." grpfunc:".$row['ID_GRP_FUNC']."<br/>";
                insere_avaliado ($empresa_, $plano_, $dt_plano_, $processo_, $dt_processo_,
                                 $row['RHID'], $row['NOME'], $row['DT_ADMISSAO'], $row['CD_ESTAB'], $row['ID_SETOR'], $row['CD_DIRECAO'], $row['CD_DEPT'],
                                 $row['CD_ESTRUTURA'], $row['CD_SITUACAO'], $row['CD_VINCULO'], $row['ID_FUNCAO'], $row['ID_GRP_FUNC'], $msg);
                if ($msg != '') {
                    break;
                }
            }
        } else {

            try {
                $sql =  "SELECT A.EMPRESA,A.RHID,A.NOME,A.NOME_REDZ,A.DT_ADMISSAO,A.DT_DEMISSAO, ".
                        " A.CD_SITUACAO,A.DSP_SITUACAO,A.ATIVO,A.ID_FUNCAO,A.DSP_FUNCAO,A.DT_INI_FUNCAO, ".
                        " A.ID_GRP_FUNC,A.DT_INI_GRP_FUNC,A.DSP_GRP_FUNC,A.CD_ESTAB,A.DSP_ESTAB, ".
                        " A.CD_DIRECAO,A.DT_INI_DIRECAO,A.DSP_DIRECAO, ".
                        " A.CD_DEPT,A.DT_DEPT,A.DSP_DEPT,A.DT_INI_DEPT,A.DT_FIM_DEPT,A.ID_SETOR,A.DSP_SETOR,A.DT_INI_SETOR, ".
                        " A.CD_ESTRUTURA, A.DT_INI_ESTRUTURA, A.CD_VINCULO ".
                        "FROM QUAD_PEOPLE A ".
                        "WHERE A.EMPRESA = :EMPRESA_ ".
                        "  AND A.ATIVO = 'S' ";

                # filtro por direções
                $dirs = implode(",",$direcoes);
                if ($dirs != '') {
                    $sql .= "  AND A.CD_DIRECAO IN (:DIRECOES_) ";
                }

                # filtro por departamentos
                $depts = implode(",",$departs);
                if ($depts != '') {
                    $sql .= "  AND A.CD_DEPT IN (:DEPTS_) ";
                }

                # filtro por estabelecimentos
                $estbs = implode(",",$estabs);
                if ($estbs != '') {
                    $sql .= "  AND A.CD_ESTAB IN (:ESTABS_) ";
                }

                # filtro por setores
                $setrs = implode(",",$setores);
                if ($setrs != '') {
                    $sql .= "  AND A.ID_SETOR IN (:SETORES_) ";
                }

                # filtro por estruturas
                $estrts = implode(",",$estruts);
                if ($estrts != '') {
                    $sql .= "  AND A.CD_ESTRUTURA IN (:ESTRUTS_) ";
                }

                # filtro por funções
                $funcs = implode(",",$funcoes);
                if ($funcs != '') {
                    $sql .= "  AND A.ID_FUNCAO IN (:FUNCOES_) ";
                }

                # filtro por grupos funcionais
                $grp_funcs = implode(",",$grupos_func);
                if ($grp_funcs != '') {
                    $sql .= "  AND A.ID_GRP_FUNC IN (:GRP_FUNCOES_) ";
                }

                # filtro por vinculos
                $vncs = implode(",",$vincs);
                if ($vncs != '') {
                    $sql .= "  AND A.CD_VINCULO IN (:VINCULOS_) ";
                }

                # filtro por situações
                $sts = implode(",",$sits);
                if ($grp_funcs != '') {
                    $sql .= "  AND A.CD_SITUACAO IN (:SITUACOES_) ";
                }

                # limite mínimo de meses de serviço
                if ($lim_meses_serv > 0 ) {
                    $sql .= "  AND (QUADATE() - INTERVAL '$lim_meses_serv' MONTH) >= A.DT_ADMISSAO ";
                }

                $sql .= "ORDER BY 2 ";

                $stmt = $db->prepare($sql);

                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);

                if ($dirs != '') {
                    $stmt->bindParam(':DIRECOES_', $dirs, PDO::PARAM_STR);
                }

                if ($depts != '') {
                    $stmt->bindParam(':DEPTS_', $depts, PDO::PARAM_STR);
                }

                if ($estbs != '') {
                    $stmt->bindParam(':ESTABS_', $estbs, PDO::PARAM_STR);
                }

                if ($setrs != '') {
                    $stmt->bindParam(':SETORES_', $setrs, PDO::PARAM_STR);
                }

                if ($estrts != '') {
                    $stmt->bindParam(':ESTRUTS_', $estrts, PDO::PARAM_STR);
                }

                if ($funcs != '') {
                    $stmt->bindParam(':FUNCOES_', $funcs, PDO::PARAM_STR);
                }

                if ($grp_funcs != '') {
                    $stmt->bindParam(':GRP_FUNCOES_', $grp_funcs, PDO::PARAM_STR);
                }

                if ($vncs != '') {
                    $stmt->bindParam(':VINCULOS_', $vncs, PDO::PARAM_STR);
                }

                if ($sts != '') {
                    $stmt->bindParam(':SITUACOES_', $sts, PDO::PARAM_STR);
                }
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
#echo "#2: rhid:".$row['RHID']." nome:".$row['NOME']." dt_adm:".$row['DT_ADMISSAO'].
#     " estab:".$row['CD_ESTAB']." setor:".$row['ID_SETOR']." dir:".$row['CD_DIRECAO']." dept:".$row['CD_DEPT'].
#     " estrut:".$row['CD_ESTRUTURA']." sit:".$row['CD_SITUACAO']." vinc:".$row['CD_VINCULO'].
#     " func:".$row['ID_FUNCAO']." grpfunc:".$row['ID_GRP_FUNC']."<br/>";
                    insere_avaliado ($empresa_, $plano_, $dt_plano_, $processo_, $dt_processo_,
                                     $row['RHID'], $row['NOME'], $row['DT_ADMISSAO'], $row['CD_ESTAB'], $row['ID_SETOR'], $row['CD_DIRECAO'], $row['CD_DEPT'],
                                     $row['CD_ESTRUTURA'], $row['CD_SITUACAO'], $row['CD_VINCULO'], $row['ID_FUNCAO'], $row['ID_GRP_FUNC'], $msg);
                    if ($msg != '') {
                        break;
                    }
                }
            } catch (PDOException $ex) {
                $msg = "get_avaliados#1 :" . $ex->getMessage();
            }

        }

    }

    #
    # Popula os Avaliadores pelas Fases do Processo de Avaliação (RH_AVALIADOR_FASES)
    #
    function get_avaliadores($empresa_, $plano_, $dt_plano_, $processo_, $dt_processo_, &$msg) {

        global $db
               ,$msg_missing_avaluation_tree;
        $msg = '';
        $nulo = null;

        try {
            $sql =  "SELECT A.RHID, A.DT_ADMISSAO, B.DT_INI_AVALIACAO, B.DT_FIM_AVALIACAO, ".
                    "       C.TECNICA_AVALIACAO, C.FONTE_AVALIACAO, C.DT_INI_FA, ".
                    "       C.PERFIL_ASSOCIADO, ".
                    "	    C.DT_INI_TAP, C.DT_FIM_TAP, C.PERCENTAGEM, B.TREE_AVALIADOR ".
                    "FROM   RH_AVALIADOS A, RH_PROCESSOS_AVALIACAO B, RH_TECNICAS_AVAL_PROCESSO C ".
                    "WHERE  A.EMPRESA = :EMPRESA_ ".
                    "AND    A.ID_PA = :ID_PA_ ".
                    "AND    A.DT_INI_PA = :DT_INI_PA_ ".
                    "AND    A.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                    "AND    A.DT_INI_PROCESSO = :DT_INI_PROCESSO_ ".
                    "AND    A.EMPRESA = B.EMPRESA ".
                    "AND    A.ID_PA = B.ID_PA ".
                    "AND    A.DT_INI_PA = B.DT_INI_PA ".
                    "AND    A.ID_PROCESSO_AV = B.ID_PROCESSO_AV ".
                    "AND    A.DT_INI_PROCESSO = B.DT_INI_PROCESSO ".
                    "AND    A.EMPRESA = C.EMPRESA ".
                    "AND    A.ID_PA = C.ID_PA ".
                    "AND    A.DT_INI_PA = C.DT_INI_PA ".
                    "AND    A.ID_PROCESSO_AV = C.ID_PROCESSO_AV ".
                    "AND    A.DT_INI_PROCESSO = C.DT_INI_PROCESSO ".
                    "ORDER BY 1, 8 ";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $ex) {
            $msg = "get_avaliadores#1 :" . $ex->getMessage();
        }

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            try {

                # TREE_AVALIADOR:  [A] - Cadastro; [B]-Estrutura; [C]-Ent.Interna;
                if ($row['TREE_AVALIADOR'] == '') {

                    $msg = $msg_missing_avaluation_tree;

                } elseif ($row['TREE_AVALIADOR'] == 'A') { # CADASTRO

                    if ($row['PERFIL_ASSOCIADO'] != '') {

                        $rhid_ident = '';
                        # determina avaliador/chefia
                        try {

                            $stmt1 = $db->prepare(  "SELECT (CASE ".
                                                    "    WHEN :PERFIL_ = 'A' THEN X.RHID ".
                                                    "    WHEN :PERFIL_ = 'B' THEN X.RHID_GESTOR_ADM ".
                                                    "    WHEN :PERFIL_ = 'C' THEN X.RHID_SUPERVISOR ".
                                                    "    WHEN :PERFIL_ = 'D' THEN X.RHID_DIRECTOR ".
                                                    "	ELSE NULL ".
                                                    "	END)  RHID_IDENT ".
                                                    "FROM QUAD_PEOPLE X ".
                                                    "WHERE X.EMPRESA = :EMPRESA_ ".
                                                    "  AND X.RHID = :RHID_ ".
                                                    "  AND X.DT_ADMISSAO = :DT_ADMISSAO_ ".
                                                    "  AND X.ATIVO = 'S' ");

                            $stmt1->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                            $stmt1->bindParam(':RHID_', $row['RHID'], PDO::PARAM_STR);
                            $stmt1->bindParam(':DT_ADMISSAO_', $row['DT_ADMISSAO'], PDO::PARAM_STR);
                            $stmt1->bindParam(':PERFIL_', $row['PERFIL_ASSOCIADO'], PDO::PARAM_STR);
                            $stmt1->execute();

                            while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                                $rhid_ident = $row1['RHID_IDENT'];
                            }


                        } catch (PDOException $ex) {
                            $msg = "get_avaliadores#2 :" . $ex->getMessage();
                        }

                        # existe avaliador/chefia
                        if ($rhid_ident != '') {

                            $dt_ini_avaliador_ = $row['DT_INI_TAP'];
                            if ($dt_ini_avaliador_ == '') {
                                $dt_ini_avaliador_ = $row['DT_INI_AVALIACAO'];
                            }

                            $dt_fim_avaliador_ = $row['DT_FIM_TAP'];
                            if ($dt_fim_avaliador_ == '') {
                                $dt_fim_avaliador_ = $row['DT_FIM_AVALIACAO'];
                            }

                            $percentagem = 0;
                            if ($row['PERCENTAGEM'] != '') {
                                $percentagem = $row['PERCENTAGEM'];
                            }

                            try {
                                    $stmt2 = $db->prepare(  "INSERT INTO RH_AVALIADORES ".
                                                            "(EMPRESA, ID_PA, DT_INI_PA, ID_PROCESSO_AV, DT_INI_PROCESSO, RHID_AVALIADO, DT_ADMISSAO, ".
                                                            " RHID_AVALIADOR, DT_INI_AVALIADOR, PERFIL_ASSOCIADO, DT_FIM_AVALIADOR, FICHA, PONDERACAO) ".
                                                            "VALUES (:EMPRESA_, :ID_PA_, :DT_INI_PA_, :ID_PROCESSO_AV_, :DT_INI_PROCESSO_, :RHID_AVALIADO_, :DT_ADMISSAO_, ".
                                                            " :RHID_AVALIADOR_, :DT_INI_AVALIADOR_, :PERFIL_ASSOCIADO_, :DT_FIM_AVALIADOR_, 'N', :PONDERACAO_) ".
                                                            " ON DUPLICATE KEY UPDATE " .
                                                            " EMPRESA = EMPRESA ");

                                    $stmt2->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                                    $stmt2->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                                    $stmt2->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                                    $stmt2->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                                    $stmt2->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                                    $stmt2->bindParam(':RHID_AVALIADO_', $row['RHID'], PDO::PARAM_STR);
                                    $stmt2->bindParam(':DT_ADMISSAO_', $row['DT_ADMISSAO'], PDO::PARAM_STR);
                                    $stmt2->bindParam(':RHID_AVALIADOR_', $rhid_ident, PDO::PARAM_STR);
                                    $stmt2->bindParam(':DT_INI_AVALIADOR_', $dt_ini_avaliador_, PDO::PARAM_STR);

                                    if ($row['PERFIL_ASSOCIADO'] == '') {
                                        $stmt2->bindParam(':PERFIL_ASSOCIADO_', $nulo, PDO::PARAM_NULL);
                                    } else {
                                        $stmt2->bindParam(':PERFIL_ASSOCIADO_', $row['PERFIL_ASSOCIADO'], PDO::PARAM_STR);
                                    }

                                    if ($dt_fim_avaliador_ == '') {
                                        $stmt2->bindParam(':DT_FIM_AVALIADOR_', $nulo, PDO::PARAM_NULL);
                                    } else {
                                        $stmt2->bindParam(':DT_FIM_AVALIADOR_', $dt_fim_avaliador_, PDO::PARAM_STR);
                                    }

                                    $stmt2->bindParam(':PONDERACAO_', $percentagem, PDO::PARAM_STR);

                                    $stmt2->execute();

                            } catch (PDOException $ex) {
                                $msg = "get_avaliadores#3 :" . $ex->getMessage();
                            }

                        }

                    } else {
                        # Se não existe nível de avaliação quer dizer que a fase não tem colaboradores envolvidos
                        #$msg = "Deverá indicar o nível associado a cada Avaliador, definido como Fonte neste Processo de Avaliação.";
                        #break;
                    }

                # A IMPLEMENTAR POSTERIORMENTE
                } elseif ($row['TREE_AVALIADOR'] == 'B') { # Estrutura
                        null;

                # A IMPLEMENTAR POSTERIORMENTE
                } elseif ($row['TREE_AVALIADOR'] == 'C') { # Ent.Interna
                        null;
                }

            } catch (PDOException $ex) {
                $msg = "get_avaliadores#4:" . $ex->getMessage();
            }
        }

    }

    #
    # Popula os Avaliadores pelas Fases do Processo de Avaliação (RH_AVALIADOR_FASES)
    #
    function get_avaliadores_fase($empresa_, $plano_, $dt_plano_, $processo_, $dt_processo_, &$msg) {

        global $db;
        $msg = '';
        $nulo = null;

        try {
            $stmt = $db->prepare(   "SELECT A.FONTE_AVALIACAO, A.DT_INI_FA, A.DT_INI_TAP, A.TECNICA_AVALIACAO, A.ID_FASE, NVL(C.PERCENTAGEM,0) PERCENTAGEM ".
                                    "     , A.DT_INI_FASE, A.DT_INI_FPA, A.DT_INI_FF, A.DT_FIM_FF, NVL(A.FICHA_AVAL,'N') FICHA_AVAL, B.RHID_AVALIADO, B.DT_ADMISSAO, B.RHID_AVALIADOR ".
                                    "     , B.DT_INI_AVALIADOR, B.PERFIL_ASSOCIADO, B.DT_FIM_AVALIADOR, B.FICHA, B.PONDERACAO ".
                                    "FROM   RH_FASES_FONTES_PROCESSO A, RH_AVALIADORES B, RH_TECNICAS_AVAL_PROCESSO C ".
                                    "WHERE  A.EMPRESA = :EMPRESA_ ".
                                    "  AND  A.ID_PA = :ID_PA_ ".
                                    "  AND  A.DT_INI_PA = :DT_INI_PA_ ".
                                    "  AND  A.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                                    "  AND  A.DT_INI_PROCESSO = :DT_INI_PROCESSO_ ".
                                    "  AND  A.EMPRESA = B.EMPRESA ".
                                    "  AND  A.ID_PA = B.ID_PA ".
                                    "  AND  A.DT_INI_PA = B.DT_INI_PA ".
                                    "  AND  A.ID_PROCESSO_AV = B.ID_PROCESSO_AV ".
                                    "  AND  A.DT_INI_PROCESSO = B.DT_INI_PROCESSO ".
                                    "  AND  C.PERFIL_ASSOCIADO = B.PERFIL_ASSOCIADO  ".
                                    "  AND  A.EMPRESA = C.EMPRESA ".
                                    "  AND  A.ID_PA = C.ID_PA ".
                                    "  AND  A.DT_INI_PA = C.DT_INI_PA ".
                                    "  AND  A.ID_PROCESSO_AV = C.ID_PROCESSO_AV ".
                                    "  AND  A.DT_INI_PROCESSO = C.DT_INI_PROCESSO ".
                                    "  AND  A.FONTE_AVALIACAO = C.FONTE_AVALIACAO ".
                                    "  AND  A.DT_INI_FA = C.DT_INI_FA ");

            $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $ex) {
            $msg = "get_avaliadores_fase#1 :" . $ex->getMessage();
        }

        if ($msg == '') {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $estado_ = '';
                if ($row['FICHA_AVAL'] == 'S' || $row['FICHA_AVAL'] == 'A') {
                    $estado_ = 'A'; # Criado
                } else {
                    $estado_ = 'Z'; # NÃO Aplicável
                }

                try {
                    $stmt2 = $db->prepare(  "INSERT INTO RH_AVALIADOR_FASES ".
                                            "(EMPRESA, ID_PA, DT_INI_PA, ID_PROCESSO_AV, DT_INI_PROCESSO, ID_FASE, DT_INI_FASE, DT_INI_FPA, ".
                                            " RHID_AVALIADO, DT_ADMISSAO, RHID_AVALIADOR, DT_INI_AF, PESO, DESCRICAO, DT_FIM_AF, ESTADO, TOT_COMPETENCIA, TOT_OBJECTIVO) ".
                                            "VALUES (:EMPRESA_, :ID_PA_, :DT_INI_PA_, :ID_PROCESSO_AV_, :DT_INI_PROCESSO_, :ID_FASE_, :DT_INI_FASE_, :DT_INI_FPA_, ".
                                            " :RHID_AVALIADO_, :DT_ADMISSAO_, :RHID_AVALIADOR_, :DT_INI_AF_, :PESO_, NULL, :DT_FIM_AF_, :ESTADO_, NULL, NULL) ".
                                            " ON DUPLICATE KEY UPDATE " .
                                            " EMPRESA = EMPRESA ");

                    $stmt2->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                    $stmt2->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                    $stmt2->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                    $stmt2->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                    $stmt2->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                    $stmt2->bindParam(':ID_FASE_', $row['ID_FASE'], PDO::PARAM_STR);
                    $stmt2->bindParam(':DT_INI_FASE_', $row['DT_INI_FASE'], PDO::PARAM_STR);
                    $stmt2->bindParam(':DT_INI_FPA_', $row['DT_INI_FPA'], PDO::PARAM_STR);
                    $stmt2->bindParam(':RHID_AVALIADO_', $row['RHID_AVALIADO'], PDO::PARAM_STR);
                    $stmt2->bindParam(':DT_ADMISSAO_', $row['DT_ADMISSAO'], PDO::PARAM_STR);
                    $stmt2->bindParam(':RHID_AVALIADOR_', $row['RHID_AVALIADOR'], PDO::PARAM_STR);
                    $stmt2->bindParam(':DT_INI_AF_', $row['DT_INI_FF'], PDO::PARAM_STR);

                    if ($row['PONDERACAO'] == '') {
                        $stmt2->bindParam(':PESO_', $nulo, PDO::PARAM_NULL);
                    } else {
                        $stmt2->bindParam(':PESO_', $row['PONDERACAO'], PDO::PARAM_STR);
                    }

                    if ($row['DT_FIM_FF'] == '') {
                        $stmt2->bindParam(':DT_FIM_AF_', $nulo, PDO::PARAM_NULL);
                    } else {
                        $stmt2->bindParam(':DT_FIM_AF_', $row['DT_FIM_FF'], PDO::PARAM_STR);
                    }

                    $stmt2->bindParam(':ESTADO_', $estado_, PDO::PARAM_STR);

                    $stmt2->execute();

                } catch (PDOException $ex) {
                    $msg = "get_avaliadores_fase#2:" . $ex->getMessage();
                }
            }
        }
    }


    ##
    ## CRIAÇÃO DE FICHAS DE AVALIAÇÃO
    ##

    function insere_competencia ($empresa_, $plano_, $dt_plano_, $processo_, $dt_processo_,
                                 $rhid_avaliado_, $dt_adm_avaliado_, $rhid_avaliador_, $id_fase_, $dt_ini_fase_, $dt_ini_fpa_, $dt_ini_af_,
                                 $peso_,$id_ep_req_, $dt_ini_ep_req_, $id_nv_escala_req_, $dt_ini_nv_escala_req_,
                                 $id_competencia_, $dt_ini_competencia_, $id_comportamento_, $dt_ini_comportamento_,
                                 $id_grp_func_, $dt_ini_grp_func_, $dt_ini_cc_grp_func_, $dt_ini_cgf_,
                                 &$msg) {
        global $db;
        $msg = '';
        $nulo = null;

        # cria registos de fichas de avaliação
        try {
            $stmt3 = $db->prepare(  "INSERT INTO RH_FICHA_AVAL_COMPORTAMENTOS ".
                                    " (EMPRESA, ID_PA, DT_INI_PA, ID_PROCESSO_AV, DT_INI_PROCESSO, RHID_AVALIADO, DT_ADMISSAO, RHID_AVALIADOR, ID_FASE, DT_INI_FASE, DT_INI_FPA, DT_INI_AF, ".
                                    "  PESO_AF, NOTA_AF, PERC_AF, PESO_AI, NOTA_AI, PERC_AI, NOTA_REQ, COMENTARIO, DESCRICAO, NR_ORDEM, ".
                                    "  ID_EP_NV_AF, DT_INI_NV_AF, ID_NV_AF, DT_INI_EP_NV_AF, ".
                                    "  ID_EP_AI, DT_INI_EP_AI, ID_NV_ESCALA_AI, DT_INI_NV_AI, ".
                                    "  ID_EP_REQ, DT_INI_EP_REQ, ID_NV_ESCALA_REQ, DT_INI_NV_REQ, ".
                                    "  ID_COMPETENCIA, DT_INI_COMPETENCIA, ID_COMPORTAMENTO, DT_INI_COMPORTAMENTO, ".
                                    "  ID_GRP_FUNC, DT_INI_GRP_FUNC, DT_INI_CC_GRP_FUNC, DT_INI_CGF, ".
                                    "  ID_FUNCAO, TP_REGISTO, DT_INI_FUNCAO, DT_INI_CC_FUNC, DT_INI_COF, ".
                                    "  CD_ESTRUTURA, DT_INI_ESTRUTURA, DT_INI_CC_ESTRUT, ".
                                    "  DT_INI_CC, DT_INI_CC_INDIV) ".
                                    " VALUES(:EMPRESA_, :ID_PA_, :DT_INI_PA_, :ID_PROCESSO_AV_,:DT_INI_PROCESSO_,:RHID_AVALIADO_,:DT_ADMISSAO_,:RHID_AVALIADOR_,:ID_FASE_,:DT_INI_FASE_,:DT_INI_FPA_,:DT_INI_AF_, ".
                                    "  :PESO_AF_,:NOTA_AF_,:PERC_AF_,:PESO_AI_,:NOTA_AI_,:PERC_AI_,:NOTA_REQ_,NULL,NULL,NULL, ".
                                    "  NULL, NULL, NULL, NULL, ".
                                    "  NULL, NULL, NULL, NULL, ".
                                    "  :ID_EP_REQ_,:DT_INI_EP_REQ_,:ID_NV_ESCALA_REQ_,:DT_INI_NV_REQ_, ".
                                    "  :ID_COMPETENCIA_,:DT_INI_COMPETENCIA_,:ID_COMPORTAMENTO_,:DT_INI_COMPORTAMENTO_, ".
                                    "  :ID_GRP_FUNC_,:DT_INI_GRP_FUNC_,:DT_INI_CC_GRP_FUNC_,:DT_INI_CGF_, ".
                                    "  NULL, NULL, NULL, NULL, NULL, ".
                                    "  NULL, NULL, NULL, ".
                                    "  NULL, NULL) " );

            $stmt3->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
            $stmt3->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
            $stmt3->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
            $stmt3->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
            $stmt3->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);

            $stmt3->bindParam(':RHID_AVALIADO_', $rhid_avaliado_, PDO::PARAM_STR);
            $stmt3->bindParam(':DT_ADMISSAO_', $dt_adm_avaliado_, PDO::PARAM_STR);
            $stmt3->bindParam(':RHID_AVALIADOR_', $rhid_avaliador_, PDO::PARAM_STR);
            $stmt3->bindParam(':ID_FASE_', $id_fase_, PDO::PARAM_STR);
            $stmt3->bindParam(':DT_INI_FASE_', $dt_ini_fase_, PDO::PARAM_STR);
            $stmt3->bindParam(':DT_INI_FPA_', $dt_ini_fpa_, PDO::PARAM_STR);
            $stmt3->bindParam(':DT_INI_AF_', $dt_ini_af_, PDO::PARAM_STR);

            $stmt3->bindParam(':PESO_AF_', $peso_, PDO::PARAM_STR);
            $stmt3->bindParam(':NOTA_AF_', $nulo, PDO::PARAM_NULL);
            $stmt3->bindParam(':PERC_AF_', $nulo, PDO::PARAM_NULL);
            $stmt3->bindParam(':PESO_AI_', $peso_, PDO::PARAM_STR);
            $stmt3->bindParam(':NOTA_AI_', $nulo, PDO::PARAM_NULL);
            $stmt3->bindParam(':PERC_AI_', $nulo, PDO::PARAM_NULL);
            $stmt3->bindParam(':NOTA_REQ_', $nulo, PDO::PARAM_NULL);

            $stmt3->bindParam(':ID_EP_REQ_', $id_ep_req_, PDO::PARAM_STR);
            $stmt3->bindParam(':DT_INI_EP_REQ_', $dt_ini_ep_req_, PDO::PARAM_STR);
            $stmt3->bindParam(':ID_NV_ESCALA_REQ_', $id_nv_escala_req_, PDO::PARAM_STR);
            $stmt3->bindParam(':DT_INI_NV_REQ_', $dt_ini_nv_escala_req_, PDO::PARAM_STR);

            $stmt3->bindParam(':ID_COMPETENCIA_', $id_competencia_, PDO::PARAM_STR);
            $stmt3->bindParam(':DT_INI_COMPETENCIA_', $dt_ini_competencia_, PDO::PARAM_STR);
            $stmt3->bindParam(':ID_COMPORTAMENTO_', $id_comportamento_, PDO::PARAM_STR);
            $stmt3->bindParam(':DT_INI_COMPORTAMENTO_', $dt_ini_comportamento_, PDO::PARAM_STR);

            $stmt3->bindParam(':ID_GRP_FUNC_', $id_grp_func_, PDO::PARAM_STR);
            $stmt3->bindParam(':DT_INI_GRP_FUNC_', $dt_ini_grp_func_, PDO::PARAM_STR);
            $stmt3->bindParam(':DT_INI_CC_GRP_FUNC_', $dt_ini_cc_grp_func_, PDO::PARAM_STR);
            $stmt3->bindParam(':DT_INI_CGF_',$dt_ini_cgf_, PDO::PARAM_STR);

            $stmt3->execute();

        } catch (Exception $ex) {
            $msg = "insere_reg_ficha_avaliacao#1 :" . $ex->getMessage();
        }
    }


    function get_competencias($empresa_, $plano_, $dt_plano_, $processo_, $dt_processo_,
                              $ac_grp_funcional_, $ac_funcao_, $ac_estrutura_, $ac_colaborador_, &$msg) {

        global $db;
        $msg = '';
        $nulo = null;
#echo "get_competencias grpfunc:$ac_grp_funcional_ func:$ac_funcao_ estrut:$ac_estrutura_ colab:$ac_colaborador_<br/>";
        # Comportamentos por Grupo Funcional
        if ($ac_grp_funcional_ == 'S') {

            ## obtem os distintos grupos funcionais
            try {
                $stmt = $db->prepare("SELECT DISTINCT B.ID_GRP_FUNC, B.DT_INI_GRP_FUNC ".
                                     "FROM RH_AVALIADOS A, QUAD_PEOPLE B ".
                                     "WHERE A.EMPRESA = :EMPRESA_ ".
                                     "  AND A.ID_PA = :ID_PA_ ".
                                     "  AND A.DT_INI_PA = :DT_INI_PA_ ".
                                     "  AND A.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                                     "  AND A.DT_INI_PROCESSO = :DT_INI_PROCESSO_".
                                     "  AND A.EMPRESA = B.EMPRESA ".
                                     "  AND A.RHID = B.RHID ".
                                     "  AND A.DT_ADMISSAO = B.DT_ADMISSAO ".
                                     "  AND B.ID_GRP_FUNC IS NOT NULL");

                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                $stmt->execute();

            } catch (Exception $ex) {
                $msg = "get_competencias#1 :" . $ex->getMessage();
            }

            if ($msg == '') {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                    try {
                        # todos os colaboradores presentes na avaliação em todas as fases para o grupo funcional selecionado
                        $stmt2 = $db->prepare(  "SELECT DISTINCT A.ID_FASE, A.DT_INI_FASE, A.DT_INI_FPA, A.RHID_AVALIADO, A.DT_ADMISSAO, A.RHID_AVALIADOR, A.DT_INI_AF, A.DT_FIM_AF, A.ESTADO ".
                                                "FROM RH_AVALIADOR_FASES A, RH_AVALIADOS B, QUAD_PEOPLE C ".
                                                "WHERE A.EMPRESA = :EMPRESA_ ".
                                                "  AND A.ID_PA = :ID_PA_ ".
                                                "  AND A.DT_INI_PA = :DT_INI_PA_ ".
                                                "  AND A.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                                                "  AND A.DT_INI_PROCESSO = :DT_INI_PROCESSO_".
                                                "  AND A.EMPRESA = B.EMPRESA ".
                                                "  AND A.DT_INI_PA = B.DT_INI_PA ".
                                                "  AND A.ID_PROCESSO_AV = B.ID_PROCESSO_AV ".
                                                "  AND A.DT_INI_PROCESSO = B.DT_INI_PROCESSO ".
                                                "  AND A.RHID_AVALIADO = B.RHID ".
                                                "  AND A.DT_ADMISSAO = B.DT_ADMISSAO ".
                                                "  AND A.ESTADO != 'Z' ".
                                                "  AND (A.EMPRESA, A.ID_PA, A.DT_INI_PA, A.ID_PROCESSO_AV, A.DT_INI_PROCESSO, A.RHID_AVALIADO, A.DT_ADMISSAO, A.RHID_AVALIADOR) NOT IN  ".
                                                "		 (SELECT X.EMPRESA, X.ID_PA, X.DT_INI_PA, X.ID_PROCESSO_AV, X.DT_INI_PROCESSO,X.RHID_AVALIADO, X.DT_ADMISSAO,X.RHID_AVALIADOR ".
                                                "		  FROM  RH_FICHA_AVAL_COMPORTAMENTOS X ".
                                                "                 WHERE X.EMPRESA = :EMPRESA_ ".
                                                "                   AND X.ID_PA = :ID_PA_ ".
                                                "                   AND X.DT_INI_PA = :DT_INI_PA_ ".
                                                "                   AND X.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                                                "                   AND X.DT_INI_PROCESSO = :DT_INI_PROCESSO_) ".
                                                "  AND C.EMPRESA = A.EMPRESA ".
                                                "  AND C.RHID = A.RHID_AVALIADO ".
                                                "  AND C.DT_ADMISSAO = A.DT_ADMISSAO ".
                                                "  AND C.ID_GRP_FUNC = :ID_GRP_FUNC_ ");
                        $stmt2->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                        $stmt2->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                        $stmt2->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                        $stmt2->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                        $stmt2->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                        $stmt2->bindParam(':ID_GRP_FUNC_', $row['ID_GRP_FUNC'], PDO::PARAM_STR);
                        $stmt2->execute();
                    } catch (Exception $ex) {
                        $msg = "get_competencias#2 :" . $ex->getMessage();
                        break;
                    }
                    if ($msg === '') {
                        while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
#echo "avaliado:".$row2['RHID_AVALIADO'].' avaliador:'.$row2['RHID_AVALIADOR'].
#     " fase:".$row2['ID_FASE'].'/'.$row2['DT_INI_FASE'].'/'.$row2['DT_INI_FPA'].'/'.$row2['DT_INI_AF'].
#     " <br/>";
                            try {
                                ## competências/comportamentos
                                $stmt1 = $db->prepare(  "SELECT A.ID_GRP_FUNC, A.DT_INI_GRP_FUNC, A.ID_COMPETENCIA, A.DT_INI_COMPETENCIA, ".
                                                        " A.ID_COMPORTAMENTO, A.DT_INI_COMPORTAMENTO, A.DT_INI, A.DT_INI_CGF, A.PESO, ".
                                                        " A.DT_FIM_CGF, A.DESCRICAO, A.ID_EP, A.DT_INI_EP, A.ID_NV_ESCALA, A.DT_INI_NV_ESCALA ".
                                                        "FROM   RH_COMPETENCIAS_GRP_FUNCIONAIS A1 ".
                                                        "     , RH_COMPORTAMENTO_GRP_FUNCIONAL A ".
                                                        "     , RH_DEF_COMPETENCIAS B ".
                                                        "     , RH_DEF_COMPORTAMENTOS C ".
                                                        "WHERE  A.EMPRESA = :EMPRESA_ ".
                                                        "  AND  A.ID_GRP_FUNC = :ID_GRP_FUNC_ ".
                                                        "  AND  A.DT_FIM_CGF IS NULL ".
                                                        "  AND  A.EMPRESA = C.EMPRESA ".
                                                        "  AND  A.ID_COMPORTAMENTO = C.ID_COMPORTAMENTO ".
                                                        "  AND  A.ID_COMPETENCIA = C.ID_COMPETENCIA ".
                                                        "  AND  A.DT_INI_COMPETENCIA = C.DT_INI_COMPETENCIA ".
                                                        "  AND  C.DT_FIM IS NULL ".
                                                        "  AND  C.EMPRESA = B.EMPRESA ".
                                                        "  AND  C.ID_COMPETENCIA = B.ID_COMPETENCIA ".
                                                        "  AND  C.DT_INI_COMPETENCIA = B.DT_INI_COMPETENCIA ".
                                                        "  AND  B.DT_FIM_COMPETENCIA IS NULL ".
                                                        "  AND  A1.EMPRESA = A.EMPRESA ".
                                                        "  AND  A1.ID_GRP_FUNC = A.ID_GRP_FUNC ".
                                                        "  AND  A1.DT_INI_GRP_FUNC = A.DT_INI_GRP_FUNC ".
                                                        "  AND  A1.ID_COMPETENCIA = A.ID_COMPETENCIA ".
                                                        "  AND  A1.DT_INI_COMPETENCIA = A.DT_INI_COMPETENCIA ".
                                                        "  AND  A1.DT_FIM IS NULL ".
                                                        "ORDER BY A.ID_COMPETENCIA, A.ID_COMPORTAMENTO ");

                                $stmt1->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                                $stmt1->bindParam(':ID_GRP_FUNC_', $row['ID_GRP_FUNC'], PDO::PARAM_STR);
                                $stmt1->execute();

                            } catch (Exception $ex) {
                                $msg = "get_competencias#2 :" . $ex->getMessage();
                            }

                            if ($msg == '') {
                                while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
#echo "    competencia:".$row1['ID_COMPETENCIA'].
#     " comportamento:".$row1['ID_COMPORTAMENTO'].
#     " <br/>";
                                    insere_competencia ($empresa_, $plano_, $dt_plano_, $processo_, $dt_processo_,
                                                        $row2['RHID_AVALIADO'],$row2['DT_ADMISSAO'],$row2['RHID_AVALIADOR'],$row2['ID_FASE'],$row2['DT_INI_FASE'],$row2['DT_INI_FPA'],$row2['DT_INI_AF'],
                                                        $row1['PESO'],$row1['ID_EP'],$row1['DT_INI_EP'],$row1['ID_NV_ESCALA'],$row1['DT_INI_NV_ESCALA'],
                                                        $row1['ID_COMPETENCIA'],$row1['DT_INI_COMPETENCIA'],$row1['ID_COMPORTAMENTO'],$row1['DT_INI_COMPORTAMENTO'],
                                                        $row1['ID_GRP_FUNC'],$row1['DT_INI_GRP_FUNC'],$row1['DT_INI'],$row2['DT_INI_CGF'],$msg);
                                    if ($msg != '') {
                                        break;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        # Comportamentos por Função
        elseif ($ac_funcao_ == 'S') {

            ## obtem as distintas funções
            try {
                $stmt = $db->prepare("SELECT DISTINCT B.ID_FUNCAO, B.DT_INI_FUNCAO ".
                                     "FROM RH_AVALIADOS A, QUAD_PEOPLE B ".
                                     "WHERE A.EMPRESA = :EMPRESA_ ".
                                     "  AND A.ID_PA = :ID_PA_ ".
                                     "  AND A.DT_INI_PA = :DT_INI_PA_ ".
                                     "  AND A.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                                     "  AND A.DT_INI_PROCESSO = :DT_INI_PROCESSO_".
                                     "  AND A.EMPRESA = B.EMPRESA ".
                                     "  AND A.RHID = B.RHID ".
                                     "  AND A.DT_ADMISSAO = B.DT_ADMISSAO ".
                                     "  AND B.ID_FUNCAO IS NOT NULL");

                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                $stmt->execute();

            } catch (Exception $ex) {
                $msg = "get_competencias#5 :" . $ex->getMessage();
            }

            if ($msg == '') {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                    try {
                        # todos os colaboradores presentes na avaliação em todas as fases para o grupo funcional selecionado
                        $stmt2 = $db->prepare(  "SELECT DISTINCT A.ID_FASE, A.DT_INI_FASE, A.DT_INI_FPA, A.RHID_AVALIADO, A.DT_ADMISSAO, A.RHID_AVALIADOR, A.DT_INI_AF, A.DT_FIM_AF, A.ESTADO ".
                                                "FROM RH_AVALIADOR_FASES A, RH_AVALIADOS B, QUAD_PEOPLE C ".
                                                "WHERE A.EMPRESA = :EMPRESA_ ".
                                                "  AND A.ID_PA = :ID_PA_ ".
                                                "  AND A.DT_INI_PA = :DT_INI_PA_ ".
                                                "  AND A.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                                                "  AND A.DT_INI_PROCESSO = :DT_INI_PROCESSO_".
                                                "  AND A.EMPRESA = B.EMPRESA ".
                                                "  AND A.DT_INI_PA = B.DT_INI_PA ".
                                                "  AND A.ID_PROCESSO_AV = B.ID_PROCESSO_AV ".
                                                "  AND A.DT_INI_PROCESSO = B.DT_INI_PROCESSO ".
                                                "  AND A.RHID_AVALIADO = B.RHID ".
                                                "  AND A.DT_ADMISSAO = B.DT_ADMISSAO ".
                                                "  AND A.ESTADO != 'Z' ".
                                                "  AND   (A.EMPRESA, A.ID_PA, A.DT_INI_PA, A.ID_PROCESSO_AV, A.DT_INI_PROCESSO, A.RHID_AVALIADO, A.DT_ADMISSAO, A.RHID_AVALIADOR) NOT IN  ".
                                                "		 (SELECT X.EMPRESA, X.ID_PA, X.DT_INI_PA, X.ID_PROCESSO_AV, X.DT_INI_PROCESSO,X.RHID_AVALIADO, X.DT_ADMISSAO,X.RHID_AVALIADOR ".
                                                "		  FROM  RH_FICHA_AVAL_COMPORTAMENTOS X ".
                                                "                 WHERE X.EMPRESA = :EMPRESA_ ".
                                                "                   AND X.ID_PA = :ID_PA_ ".
                                                "                   AND X.DT_INI_PA = :DT_INI_PA_ ".
                                                "                   AND X.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                                                "                   AND X.DT_INI_PROCESSO = :DT_INI_PROCESSO_) ".
                                                "  AND C.EMPRESA = A.EMPRESA ".
                                                "  AND C.RHID = A.RHID_AVALIADO ".
                                                "  AND C.DT_ADMISSAO = A.DT_ADMISSAO ".
                                                "  AND C.ID_FUNCAO = :ID_FUNCAO_ ");
                        $stmt2->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                        $stmt2->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                        $stmt2->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                        $stmt2->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                        $stmt2->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                        $stmt2->bindParam(':ID_FUNCAO_', $row['ID_FUNCAO'], PDO::PARAM_STR);
                        $stmt2->execute();

                    } catch (Exception $ex) {
                        $msg = "get_competencias#6 :" . $ex->getMessage();
                        break;
                    }

                    if ($msg == '') {
                        while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                            try {
                                ## competências/comportamentos
                                $stmt1 = $db->prepare(  "SELECT A.ID_COMPETENCIA, A.DT_INI_COMPETENCIA, A.ID_COMPORTAMENTO, A.ID_FUNCAO, A.TP_REGISTO, A.DT_INI_FUNCAO, A.PESO, ".
                                                        "       A.DT_INI_COMPORTAMENTO, A.DT_INI, A.DT_INI_COF, A.DT_FIM_COF, A.ID_EP, A.DT_INI_EP, A.ID_NV_ESCALA, A.DT_INI_NV_ESCALA ".
                                                        "FROM   RH_COMPETENCIAS_FUNCOES A1, RH_COMPORTAMENTOS_FUNCAO A, RH_DEF_COMPETENCIAS B, RH_DEF_COMPORTAMENTOS C ".
                                                        "WHERE  A.EMPRESA = :EMPRESA_ ".
                                                        "  AND  A.ID_FUNCAO = :ID_FUNCAO_ ".
                                                        "  AND  A.TP_REGISTO = 'A' ".
                                                        "  AND  A.DT_FIM_COF IS NULL ".
                                                        "  AND  A.EMPRESA = C.EMPRESA ".
                                                        "  AND  A.ID_COMPORTAMENTO = C.ID_COMPORTAMENTO ".
                                                        "  AND  A.ID_COMPETENCIA = C.ID_COMPETENCIA ".
                                                        "  AND  A.DT_INI_COMPETENCIA = C.DT_INI_COMPETENCIA ".
                                                        "  AND  C.DT_FIM IS NULL ".
                                                        "  AND  C.EMPRESA = B.EMPRESA ".
                                                        "  AND  C.ID_COMPETENCIA = B.ID_COMPETENCIA ".
                                                        "  AND  C.DT_INI_COMPETENCIA = B.DT_INI_COMPETENCIA ".
                                                        "  AND  B.DT_FIM_COMPETENCIA IS NULL ".
                                                        "  AND  A1.EMPRESA = A.EMPRESA ".
                                                        "  AND  A1.ID_FUNCAO = A.ID_FUNCAO ".
                                                        "  AND  A1.TP_REGISTO = A.TP_REGISTO ".
                                                        "  AND  A1.DT_INI_FUNCAO = A.DT_INI_FUNCAO ".
                                                        "  AND  A1.ID_COMPETENCIA = A.ID_COMPETENCIA ".
                                                        "  AND  A1.DT_INI_COMPETENCIA = A.DT_INI_COMPETENCIA ".
                                                        "  AND  A1.DT_FIM IS NULL");

                                $stmt1->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                                $stmt1->bindParam(':ID_FUNCAO_', $row['ID_FUNCAO'], PDO::PARAM_STR);
                                $stmt1->execute();

                            } catch (Exception $ex) {
                                $msg = "get_competencias#7 :" . $ex->getMessage();
                                break;
                            }
                            if ($msg == '') {
                                while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                                    # cria registos de fichas de avaliação
                                    try {

                                        $stmt3 = $db->prepare(  "INSERT INTO RH_FICHA_AVAL_COMPORTAMENTOS ".
                                                                " (EMPRESA, ID_PA, DT_INI_PA, ID_PROCESSO_AV, DT_INI_PROCESSO, RHID_AVALIADO, DT_ADMISSAO, RHID_AVALIADOR, ID_FASE, DT_INI_FASE, DT_INI_FPA, DT_INI_AF, ".
                                                                "  PESO_AF, NOTA_AF, PERC_AF, PESO_AI, NOTA_AI, PERC_AI, NOTA_REQ, COMENTARIO, DESCRICAO, NR_ORDEM, ".
                                                                "  ID_EP_NV_AF, DT_INI_NV_AF, ID_NV_AF, DT_INI_EP_NV_AF, ".
                                                                "  ID_EP_AI, DT_INI_EP_AI, ID_NV_ESCALA_AI, DT_INI_NV_AI, ".
                                                                "  ID_EP_REQ, DT_INI_EP_REQ, ID_NV_ESCALA_REQ, DT_INI_NV_REQ, ".
                                                                "  ID_COMPETENCIA, DT_INI_COMPETENCIA, ID_COMPORTAMENTO, DT_INI_COMPORTAMENTO, ".
                                                                "  ID_GRP_FUNC, DT_INI_GRP_FUNC, DT_INI_CC_GRP_FUNC, DT_INI_CGF, ".
                                                                "  ID_FUNCAO, TP_REGISTO, DT_INI_FUNCAO, DT_INI_CC_FUNC, DT_INI_COF, ".
                                                                "  CD_ESTRUTURA, DT_INI_ESTRUTURA, DT_INI_CC_ESTRUT, ".
                                                                "  DT_INI_CC, DT_INI_CC_INDIV) ".
                                                                " VALUES(:EMPRESA_, :ID_PA_, :DT_INI_PA_, :ID_PROCESSO_AV_,:DT_INI_PROCESSO_,:RHID_AVALIADO_,:DT_ADMISSAO_,:RHID_AVALIADOR_,:ID_FASE_,:DT_INI_FASE_,:DT_INI_FPA_,:DT_INI_AF_, ".
                                                                "  :PESO_AF_,:NOTA_AF_,:PERC_AF_,:PESO_AI_,:NOTA_AI_,:PERC_AI_,:NOTA_REQ_,NULL,NULL,:NR_ORDEM_, ".
                                                                "  NULL, NULL, NULL, NULL, ".
                                                                "  NULL, NULL, NULL, NULL, ".
                                                                "  :ID_EP_REQ_,:DT_INI_EP_REQ_,:ID_NV_ESCALA_REQ_,:DT_INI_NV_REQ_, ".
                                                                "  :ID_COMPETENCIA_,:DT_INI_COMPETENCIA_,:ID_COMPORTAMENTO_,:DT_INI_COMPORTAMENTO_, ".
                                                                "  NULL, NULL, NULL, NULL, ".
                                                                "  :ID_FUNCAO_,:TP_REGISTO_,:DT_INI_FUNCAO_,:DT_INI_CC_FUNC_,:DT_INI_COF_, ".
                                                                "  NULL, NULL, NULL, ".
                                                                "  NULL, NULL) " );


                                        $stmt3->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                                        $stmt3->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                                        $stmt3->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);

                                        $stmt3->bindParam(':RHID_AVALIADO_', $row2['RHID_AVALIADO'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_ADMISSAO_', $row2['DT_ADMISSAO'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':RHID_AVALIADOR_', $row2['RHID_AVALIADOR'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':ID_FASE_', $row2['ID_FASE'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_FASE_', $row2['DT_INI_FASE'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_FPA_', $row2['DT_INI_FPA'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_AF_', $row2['DT_INI_AF'], PDO::PARAM_STR);

                                        $stmt3->bindParam(':PESO_AF_', $row1['PESO'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':NOTA_AF_', $nulo, PDO::PARAM_NULL);
                                        $stmt3->bindParam(':PERC_AF_', $nulo, PDO::PARAM_NULL);
                                        $stmt3->bindParam(':PESO_AI_', $row1['PESO'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':NOTA_AI_', $nulo, PDO::PARAM_NULL);
                                        $stmt3->bindParam(':PERC_AI_', $nulo, PDO::PARAM_NULL);
                                        $stmt3->bindParam(':NOTA_REQ_', $nulo, PDO::PARAM_NULL);

                                        $stmt3->bindParam(':ID_EP_REQ_', $row1['ID_EP'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_EP_REQ_', $row1['DT_INI_EP'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':ID_NV_ESCALA_REQ_', $row1['ID_NV_ESCALA'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_NV_REQ_', $row1['DT_INI_NV_ESCALA'], PDO::PARAM_STR);

                                        $stmt3->bindParam(':ID_COMPETENCIA_', $row1['ID_COMPETENCIA'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_COMPETENCIA_', $row1['DT_INI_COMPETENCIA'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':ID_COMPORTAMENTO_', $row1['ID_COMPORTAMENTO'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_COMPORTAMENTO_', $row1['DT_INI_COMPORTAMENTO'], PDO::PARAM_STR);

                                        $stmt3->bindParam(':ID_FUNCAO_', $row1['ID_FUNCAO'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':TP_REGISTO_', $row1['TP_REGISTO'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_FUNCAO_', $row1['DT_INI_FUNCAO'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_CC_FUNC_', $row1['DT_INI'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_COF_', $row2['DT_INI_COF'], PDO::PARAM_STR);

                                        $stmt3->execute();

                                    } catch (Exception $ex) {
                                        $msg = "get_competencias#8 :" . $ex->getMessage();
                                        break;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        # Comportamentos por Estrutura
        elseif ($ac_estrutura_ == 'S') {

            ## obtem os distintas estruturas
            try {
                $stmt = $db->prepare("SELECT DISTINCT B.CD_ESTRUTURA, B.DT_INI_ESTRUTURA ".
                                     "FROM RH_AVALIADOS A, RH_ESTRUTURA_CORRENTE B ".
                                     "WHERE A.EMPRESA = :EMPRESA_ ".
                                     "  AND A.ID_PA = :ID_PA_ ".
                                     "  AND A.DT_INI_PA = :DT_INI_PA_ ".
                                     "  AND A.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                                     "  AND A.DT_INI_PROCESSO = :DT_INI_PROCESSO_".
                                     "  AND A.EMPRESA = B.EMPRESA ".
                                     "  AND A.RHID = B.RHID ".
                                     "  AND A.DT_ADMISSAO = B.DT_ADMISSAO ");

                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                $stmt->execute();

            } catch (Exception $ex) {
                $msg = "get_competencias#9 :" . $ex->getMessage();
            }

            if ($msg == '') {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    try {
                        # todos os colaboradores presentes na avaliação em todas as fases para o grupo funcional selecionado
                        $stmt2 = $db->prepare(  "SELECT DISTINCT A.ID_FASE, A.DT_INI_FASE, A.DT_INI_FPA, A.RHID_AVALIADO, A.DT_ADMISSAO, A.RHID_AVALIADOR, A.DT_INI_AF, A.DT_FIM_AF, A.ESTADO ".
                                                "FROM RH_AVALIADOR_FASES A, RH_AVALIADOS B, QUAD_PEOPLE C ".
                                                "WHERE A.EMPRESA = :EMPRESA_ ".
                                                "  AND A.ID_PA = :ID_PA_ ".
                                                "  AND A.DT_INI_PA = :DT_INI_PA_ ".
                                                "  AND A.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                                                "  AND A.DT_INI_PROCESSO = :DT_INI_PROCESSO_".
                                                "  AND A.EMPRESA = B.EMPRESA ".
                                                "  AND A.DT_INI_PA = B.DT_INI_PA ".
                                                "  AND A.ID_PROCESSO_AV = B.ID_PROCESSO_AV ".
                                                "  AND A.DT_INI_PROCESSO = B.DT_INI_PROCESSO ".
                                                "  AND A.RHID_AVALIADO = B.RHID ".
                                                "  AND A.DT_ADMISSAO = B.DT_ADMISSAO ".
                                                "  AND A.ESTADO != 'Z' ".
                                                "  AND   (A.EMPRESA, A.ID_PA, A.DT_INI_PA, A.ID_PROCESSO_AV, A.DT_INI_PROCESSO, A.RHID_AVALIADO, A.DT_ADMISSAO, A.RHID_AVALIADOR) NOT IN  ".
                                                "		 (SELECT X.EMPRESA, X.ID_PA, X.DT_INI_PA, X.ID_PROCESSO_AV, X.DT_INI_PROCESSO,X.RHID_AVALIADO, X.DT_ADMISSAO,X.RHID_AVALIADOR ".
                                                "		  FROM  RH_FICHA_AVAL_COMPORTAMENTOS X ".
                                                "                 WHERE X.EMPRESA = :EMPRESA_ ".
                                                "                   AND X.ID_PA = :ID_PA_ ".
                                                "                   AND X.DT_INI_PA = :DT_INI_PA_ ".
                                                "                   AND X.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                                                "                   AND X.DT_INI_PROCESSO = :DT_INI_PROCESSO_) ".
                                                "  AND C.EMPRESA = A.EMPRESA ".
                                                "  AND C.RHID = A.RHID_AVALIADO ".
                                                "  AND C.DT_ADMISSAO = A.DT_ADMISSAO ".
                                                "  AND C.CD_ESTRUTURA = :CD_ESTRUTURA_ ");

                        $stmt2->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                        $stmt2->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                        $stmt2->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                        $stmt2->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                        $stmt2->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                        $stmt2->bindParam(':CD_ESTRUTURA_', $row['CD_ESTRUTURA'], PDO::PARAM_STR);
                        $stmt2->execute();

                    } catch (Exception $ex) {
                        $msg = "get_competencias#10 :" . $ex->getMessage();
                        break;
                    }
                    if ($msg == '') {
                        while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                            try {
                                ## competências/comportamentos
                                $stmt1 = $db->prepare(  "SELECT A.ID_COMPETENCIA, A.DT_INI_COMPETENCIA, A.ID_COMPORTAMENTO, A.CD_ESTRUTURA, A.DT_INI_ESTRUTURA, A.PESO, ".
                                                        "	   A.DT_INI_COMPORTAMENTO, A.DT_INI_CE, A.DT_FIM_CE, A.ID_EP, A.DT_INI_EP, A.ID_NV_ESCALA, A.DT_INI_NV_ESCALA ".
                                                        "FROM   RH_COMPETENCIAS_ESTRUTURAS A1, RH_COMPORTAMENTO_ESTRUTURAS A, RH_DEF_COMPETENCIAS B, RH_DEF_COMPORTAMENTOS C ".
                                                        "WHERE  A.EMPRESA = :EMPRESA_ ".
                                                        "  AND  A.CD_ESTRUTURA = :CD_ESTRUTURA_ ".
                                                        "  AND  A.DT_FIM_CE IS NULL ".
                                                        "  AND  A.EMPRESA = C.EMPRESA ".
                                                        "  AND  A.ID_COMPORTAMENTO = C.ID_COMPORTAMENTO ".
                                                        "  AND  A.ID_COMPETENCIA = C.ID_COMPETENCIA ".
                                                        "  AND  A.DT_INI_COMPETENCIA = C.DT_INI_COMPETENCIA ".
                                                        "  AND  C.DT_FIM IS NULL ".
                                                        "  AND  C.EMPRESA = B.EMPRESA ".
                                                        "  AND  C.ID_COMPETENCIA = B.ID_COMPETENCIA ".
                                                        "  AND  C.DT_INI_COMPETENCIA = B.DT_INI_COMPETENCIA ".
                                                        "  AND  B.DT_FIM_COMPETENCIA IS NULL ".
                                                        "  AND  A1.EMPRESA = A.EMPRESA ".
                                                        "  AND  A1.CD_ESTRUTURA = A.CD_ESTRUTURA ".
                                                        "  AND  A1.ID_COMPETENCIA = A.ID_COMPETENCIA ".
                                                        "  AND  A1.DT_INI_COMPETENCIA = A.DT_INI_COMPETENCIA ".
                                                        "  AND  A1.DT_FIM IS NULL ");

                                $stmt1->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                                $stmt1->bindParam(':CD_ESTRUTURA_', $row['CD_ESTRUTURA'], PDO::PARAM_STR);
                                $stmt1->execute();

                            } catch (Exception $ex) {
                                $msg = "get_competencias#11 :" . $ex->getMessage();
                                break;
                            }
                            if ($msg == '') {
                                while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                                    # cria registos de fichas de avaliação
                                    try {
                                        $stmt3 = $db->prepare(  "INSERT INTO RH_FICHA_AVAL_COMPORTAMENTOS ".
                                                                " (EMPRESA, ID_PA, DT_INI_PA, ID_PROCESSO_AV, DT_INI_PROCESSO, RHID_AVALIADO, DT_ADMISSAO, RHID_AVALIADOR, ID_FASE, DT_INI_FASE, DT_INI_FPA, DT_INI_AF, ".
                                                                "  PESO_AF, NOTA_AF, PERC_AF, PESO_AI, NOTA_AI, PERC_AI, NOTA_REQ, COMENTARIO, DESCRICAO, NR_ORDEM, ".
                                                                "  ID_EP_NV_AF, DT_INI_NV_AF, ID_NV_AF, DT_INI_EP_NV_AF, ".
                                                                "  ID_EP_AI, DT_INI_EP_AI, ID_NV_ESCALA_AI, DT_INI_NV_AI, ".
                                                                "  ID_EP_REQ, DT_INI_EP_REQ, ID_NV_ESCALA_REQ, DT_INI_NV_REQ, ".
                                                                "  ID_COMPETENCIA, DT_INI_COMPETENCIA, ID_COMPORTAMENTO, DT_INI_COMPORTAMENTO, ".
                                                                "  ID_GRP_FUNC, DT_INI_GRP_FUNC, DT_INI_CC_GRP_FUNC, DT_INI_CGF, ".
                                                                "  ID_FUNCAO, TP_REGISTO, DT_INI_FUNCAO, DT_INI_CC_FUNC, DT_INI_COF, ".
                                                                "  CD_ESTRUTURA, DT_INI_ESTRUTURA, DT_INI_CC_ESTRUT, ".
                                                                "  DT_INI_CC, DT_INI_CC_INDIV) ".
                                                                " VALUES(:EMPRESA_, :ID_PA_, :DT_INI_PA_, :ID_PROCESSO_AV_,:DT_INI_PROCESSO_,:RHID_AVALIADO_,:DT_ADMISSAO_,:RHID_AVALIADOR_,:ID_FASE_,:DT_INI_FASE_,:DT_INI_FPA_,:DT_INI_AF_, ".
                                                                "  :PESO_AF_,:NOTA_AF_,:PERC_AF_,:PESO_AI_,:NOTA_AI_,:PERC_AI_,:NOTA_REQ_,NULL,NULL,:NR_ORDEM_, ".
                                                                "  NULL, NULL, NULL, NULL, ".
                                                                "  NULL, NULL, NULL, NULL, ".
                                                                "  :ID_EP_REQ_,:DT_INI_EP_REQ_,:ID_NV_ESCALA_REQ_,:DT_INI_NV_REQ_, ".
                                                                "  :ID_COMPETENCIA_,:DT_INI_COMPETENCIA_,:ID_COMPORTAMENTO_,:DT_INI_COMPORTAMENTO_, ".
                                                                "  NULL, NULL, NULL, NULL, ".
                                                                "  NULL, NULL, NULL, NULL, NULL, ".
                                                                "  :CD_ESTRUTURA_, :DT_INI_ESTRUTURA_, :DT_INI_CC_ESTRUT_,  ".
                                                                "  NULL, NULL) " );

                                        $stmt3->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                                        $stmt3->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                                        $stmt3->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);

                                        $stmt3->bindParam(':RHID_AVALIADO_', $row2['RHID_AVALIADO'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_ADMISSAO_', $row2['DT_ADMISSAO'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':RHID_AVALIADOR_', $row2['RHID_AVALIADOR'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':ID_FASE_', $row2['ID_FASE'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_FASE_', $row2['DT_INI_FASE'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_FPA_', $row2['DT_INI_FPA'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_AF_', $row2['DT_INI_AF'], PDO::PARAM_STR);

                                        $stmt3->bindParam(':PESO_AF_', $row1['PESO'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':NOTA_AF_', $nulo, PDO::PARAM_NULL);
                                        $stmt3->bindParam(':PERC_AF_', $nulo, PDO::PARAM_NULL);
                                        $stmt3->bindParam(':PESO_AI_', $row1['PESO'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':NOTA_AI_', $nulo, PDO::PARAM_NULL);
                                        $stmt3->bindParam(':PERC_AI_', $nulo, PDO::PARAM_NULL);
                                        $stmt3->bindParam(':NOTA_REQ_', $nulo, PDO::PARAM_NULL);

                                        $stmt3->bindParam(':ID_EP_REQ_', $row1['ID_EP'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_EP_REQ_', $row1['DT_INI_EP'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':ID_NV_ESCALA_REQ_', $row1['ID_NV_ESCALA'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_NV_REQ_', $row1['DT_INI_NV_ESCALA'], PDO::PARAM_STR);

                                        $stmt3->bindParam(':ID_COMPETENCIA_', $row1['ID_COMPETENCIA'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_COMPETENCIA_', $row1['DT_INI_COMPETENCIA'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':ID_COMPORTAMENTO_', $row1['ID_COMPORTAMENTO'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_COMPORTAMENTO_', $row1['DT_INI_COMPORTAMENTO'], PDO::PARAM_STR);

                                        $stmt3->bindParam(':CD_ESTRUTURA_', $row1['CD_ESTRUTURA'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_ESTRUTURA_', $row1['DT_INI_ESTRUTURA'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_CC_ESTRUT_', $row1['DT_INI_CE'], PDO::PARAM_STR);

                                        $stmt3->execute();


                                    } catch (Exception $ex) {
                                        $msg = "get_competencias#12 :" . $ex->getMessage();
                                        break;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        # Inclusão de Comportamentos Individuais
        if ($ac_colaborador_ == 'S' && $msg == '') {

            ## obtem os distintas estruturas
            try {
                $stmt = $db->prepare("SELECT DISTINCT A.EMPRESA, A.RHID, A.DT_ADMISSAO ".
                                     "FROM RH_AVALIADOS A ".
                                     "WHERE A.EMPRESA = :EMPRESA_ ".
                                     "  AND A.ID_PA = :ID_PA_ ".
                                     "  AND A.DT_INI_PA = :DT_INI_PA_ ".
                                     "  AND A.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                                     "  AND A.DT_INI_PROCESSO = :DT_INI_PROCESSO_ ");

                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                $stmt->execute();

            } catch (Exception $ex) {
                $msg = "get_competencias#13 :" . $ex->getMessage();
            }

            if ($msg == '') {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    try {
                        # todos os colaboradores presentes na avaliação em todas as fases para o grupo funcional selecionado
                        $stmt2 = $db->prepare(  "SELECT DISTINCT A.ID_FASE, A.DT_INI_FASE, A.DT_INI_FPA, A.RHID_AVALIADO, A.DT_ADMISSAO, A.RHID_AVALIADOR, A.DT_INI_AF, A.DT_FIM_AF, A.ESTADO ".
                                                "FROM RH_AVALIADOR_FASES A, RH_AVALIADOS B, QUAD_PEOPLE C ".
                                                "WHERE A.EMPRESA = :EMPRESA_ ".
                                                "  AND A.ID_PA = :ID_PA_ ".
                                                "  AND A.DT_INI_PA = :DT_INI_PA_ ".
                                                "  AND A.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                                                "  AND A.DT_INI_PROCESSO = :DT_INI_PROCESSO_".
                                                "  AND A.EMPRESA = B.EMPRESA ".
                                                "  AND A.DT_INI_PA = B.DT_INI_PA ".
                                                "  AND A.ID_PROCESSO_AV = B.ID_PROCESSO_AV ".
                                                "  AND A.DT_INI_PROCESSO = B.DT_INI_PROCESSO ".
                                                "  AND A.RHID_AVALIADO = B.RHID ".
                                                "  AND A.DT_ADMISSAO = B.DT_ADMISSAO ".
                                                "  AND A.ESTADO != 'Z' ".
                                                "  AND   (A.EMPRESA, A.ID_PA, A.DT_INI_PA, A.ID_PROCESSO_AV, A.DT_INI_PROCESSO, A.RHID_AVALIADO, A.DT_ADMISSAO, A.RHID_AVALIADOR) NOT IN  ".
                                                "		 (SELECT X.EMPRESA, X.ID_PA, X.DT_INI_PA, X.ID_PROCESSO_AV, X.DT_INI_PROCESSO,X.RHID_AVALIADO, X.DT_ADMISSAO,X.RHID_AVALIADOR ".
                                                "		  FROM  RH_FICHA_AVAL_COMPORTAMENTOS X ".
                                                "                 WHERE X.EMPRESA = :EMPRESA_ ".
                                                "                   AND X.ID_PA = :ID_PA_ ".
                                                "                   AND X.DT_INI_PA = :DT_INI_PA_ ".
                                                "                   AND X.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                                                "                   AND X.DT_INI_PROCESSO = :DT_INI_PROCESSO_) ".
                                                "  AND C.EMPRESA = A.EMPRESA ".
                                                "  AND C.RHID = A.RHID_AVALIADO ".
                                                "  AND C.DT_ADMISSAO = A.DT_ADMISSAO ");

                        $stmt2->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                        $stmt2->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                        $stmt2->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                        $stmt2->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                        $stmt2->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                        $stmt2->execute();

                    } catch (Exception $ex) {
                        $msg = "get_competencias#14 :" . $ex->getMessage();
                        break;
                    }
                    if ($msg == '') {
                        while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                            try {
                                ## competências/comportamentos
                                $stmt1 = $db->prepare(  "SELECT A.ID_COMPETENCIA, A.DT_INI_COMPETENCIA, A.ID_COMPORTAMENTO, A.RHID, A.DT_ADMISSAO, A.PESO, ".
                                                        "	A.DT_INI_COMPORTAMENTO, A.DT_INI_CC, A.DT_FIM_CC, A.ID_EP, A.DT_INI_EP, A.ID_NV_ESCALA, A.DT_INI_NV_ESCALA ".
                                                        "FROM   RH_ID_COMPORTAMENTOS A, RH_DEF_COMPETENCIAS B, RH_DEF_COMPORTAMENTOS C ".
                                                        "WHERE  A.EMPRESA = :EMPRESA_ ".
                                                        "  AND  A.RHID = :RHID_ ".
                                                        "  AND  A.DT_ADMISSAO = :DT_ADMISSAO_ ".
                                                        "  AND  A.DT_FIM_CC IS NULL ".
                                                        "  AND  A.EMPRESA = C.EMPRESA ".
                                                        "  AND  A.ID_COMPORTAMENTO = C.ID_COMPORTAMENTO ".
                                                        "  AND  A.ID_COMPETENCIA = C.ID_COMPETENCIA ".
                                                        "  AND  A.DT_INI_COMPETENCIA = C.DT_INI_COMPETENCIA ".
                                                        "  AND  C.DT_FIM IS NULL ".
                                                        "  AND  C.EMPRESA = B.EMPRESA ".
                                                        "  AND  C.ID_COMPETENCIA = B.ID_COMPETENCIA ".
                                                        "  AND  C.DT_INI_COMPETENCIA = B.DT_INI_COMPETENCIA ".
                                                        "  AND  B.DT_FIM_COMPETENCIA IS NULL ");

                                $stmt1->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                                $stmt1->bindParam(':RHID_', $row['RHID'], PDO::PARAM_STR);
                                $stmt1->bindParam(':DT_ADMISSAO_', $row['DT_ADMISSAO'], PDO::PARAM_STR);
                                $stmt1->execute();
                            } catch (Exception $ex) {
                                $msg = "get_competencias#15 :" . $ex->getMessage();
                                break;
                            }
                            if ($msg == '') {
                                while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                                    # cria registos de fichas de avaliação
                                    try {
                                        $stmt3 = $db->prepare(  "INSERT INTO RH_FICHA_AVAL_COMPORTAMENTOS ".
                                                                " (EMPRESA, ID_PA, DT_INI_PA, ID_PROCESSO_AV, DT_INI_PROCESSO, RHID_AVALIADO, DT_ADMISSAO, RHID_AVALIADOR, ID_FASE, DT_INI_FASE, DT_INI_FPA, DT_INI_AF, ".
                                                                "  PESO_AF, NOTA_AF, PERC_AF, PESO_AI, NOTA_AI, PERC_AI, NOTA_REQ, COMENTARIO, DESCRICAO, NR_ORDEM, ".
                                                                "  ID_EP_NV_AF, DT_INI_NV_AF, ID_NV_AF, DT_INI_EP_NV_AF, ".
                                                                "  ID_EP_AI, DT_INI_EP_AI, ID_NV_ESCALA_AI, DT_INI_NV_AI, ".
                                                                "  ID_EP_REQ, DT_INI_EP_REQ, ID_NV_ESCALA_REQ, DT_INI_NV_REQ, ".
                                                                "  ID_COMPETENCIA, DT_INI_COMPETENCIA, ID_COMPORTAMENTO, DT_INI_COMPORTAMENTO, ".
                                                                "  ID_GRP_FUNC, DT_INI_GRP_FUNC, DT_INI_CC_GRP_FUNC, DT_INI_CGF, ".
                                                                "  ID_FUNCAO, TP_REGISTO, DT_INI_FUNCAO, DT_INI_CC_FUNC, DT_INI_COF, ".
                                                                "  CD_ESTRUTURA, DT_INI_ESTRUTURA, DT_INI_CC_ESTRUT, ".
                                                                "  DT_INI_CC, DT_INI_CC_INDIV) ".
                                                                " VALUES(:EMPRESA_, :ID_PA_, :DT_INI_PA_, :ID_PROCESSO_AV_,:DT_INI_PROCESSO_,:RHID_AVALIADO_,:DT_ADMISSAO_,:RHID_AVALIADOR_,:ID_FASE_,:DT_INI_FASE_,:DT_INI_FPA_,:DT_INI_AF_, ".
                                                                "  :PESO_AF_,:NOTA_AF_,:PERC_AF_,:PESO_AI_,:NOTA_AI_,:PERC_AI_,:NOTA_REQ_, NULL, NULL, NULL, ".
                                                                "  NULL, NULL, NULL, NULL, ".
                                                                "  NULL, NULL, NULL, NULL, ".
                                                                "  :ID_EP_REQ_,:DT_INI_EP_REQ_,:ID_NV_ESCALA_REQ_,:DT_INI_NV_REQ_, ".
                                                                "  :ID_COMPETENCIA_,:DT_INI_COMPETENCIA_,:ID_COMPORTAMENTO_,:DT_INI_COMPORTAMENTO_, ".
                                                                "  NULL, NULL, NULL, NULL, ".
                                                                "  NULL, NULL, NULL, NULL, NULL, ".
                                                                "  NULL, NULL, NULL,  ".
                                                                "  :DT_INI_CC_, NULL) " );
                                        $stmt3->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                                        $stmt3->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                                        $stmt3->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);

                                        $stmt3->bindParam(':RHID_AVALIADO_', $row2['RHID_AVALIADO'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_ADMISSAO_', $row2['DT_ADMISSAO'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':RHID_AVALIADOR_', $row2['RHID_AVALIADOR'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':ID_FASE_', $row2['ID_FASE'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_FASE_', $row2['DT_INI_FASE'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_FPA_', $row2['DT_INI_FPA'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_AF_', $row2['DT_INI_AF'], PDO::PARAM_STR);

                                        $stmt3->bindParam(':PESO_AF_', $row1['PESO'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':NOTA_AF_', $nulo, PDO::PARAM_NULL);
                                        $stmt3->bindParam(':PERC_AF_', $nulo, PDO::PARAM_NULL);
                                        $stmt3->bindParam(':PESO_AI_', $row1['PESO'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':NOTA_AI_', $nulo, PDO::PARAM_NULL);
                                        $stmt3->bindParam(':PERC_AI_', $nulo, PDO::PARAM_NULL);
                                        $stmt3->bindParam(':NOTA_REQ_', $nulo, PDO::PARAM_NULL);

                                        $stmt3->bindParam(':ID_EP_REQ_', $row1['ID_EP'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_EP_REQ_', $row1['DT_INI_EP'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':ID_NV_ESCALA_REQ_', $row1['ID_NV_ESCALA'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_NV_REQ_', $row1['DT_INI_NV_ESCALA'], PDO::PARAM_STR);

                                        $stmt3->bindParam(':ID_COMPETENCIA_', $row1['ID_COMPETENCIA'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_COMPETENCIA_', $row1['DT_INI_COMPETENCIA'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':ID_COMPORTAMENTO_', $row1['ID_COMPORTAMENTO'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_COMPORTAMENTO_', $row1['DT_INI_COMPORTAMENTO'], PDO::PARAM_STR);

                                        #$stmt3->bindParam(':DT_INI_CC_INDIV_', $row1['DT_INI_CC_INDIV'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_CC_', $row1['DT_INI_CC'], PDO::PARAM_STR);

                                        $stmt3->execute();
                                    } catch (Exception $ex) {
                                        $msg = "get_competencias#16 :" . $ex->getMessage();
                                        break;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    function get_objetivos($empresa_, $plano_, $dt_plano_, $processo_, $dt_processo_,
                           $ao_grp_funcional_, $ao_funcao_, $ao_estrutura_, $ao_colaborador_, &$msg) {

        global $db;
        $msg = '';
        $nulo = null;
#echo "get_objetivos grpfunc:$ao_grp_funcional_ func:$ao_funcao_ estrut:$ao_estrutura_ colab:$ao_colaborador_<br/>";

        # Objetivos por Grupo Funcional
        if ($ao_grp_funcional_ == 'S') {

            ## obtem os distintos grupos funcionais
            try {
                $stmt = $db->prepare("SELECT DISTINCT B.ID_GRP_FUNC, B.DT_INI_GRP_FUNC ".
                                     "FROM RH_AVALIADOS A, QUAD_PEOPLE B ".
                                     "WHERE A.EMPRESA = :EMPRESA_ ".
                                     "  AND A.ID_PA = :ID_PA_ ".
                                     "  AND A.DT_INI_PA = :DT_INI_PA_ ".
                                     "  AND A.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                                     "  AND A.DT_INI_PROCESSO = :DT_INI_PROCESSO_".
                                     "  AND A.EMPRESA = B.EMPRESA ".
                                     "  AND A.RHID = B.RHID ".
                                     "  AND A.DT_ADMISSAO = B.DT_ADMISSAO ".
                                     "  AND B.ID_GRP_FUNC IS NOT NULL");

                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                $stmt->execute();

            } catch (Exception $ex) {
                $msg = "get_objetivos#1 :" . $ex->getMessage();
            }
            if ($msg == '') {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
#echo "get_objetivos GRP FUNC:".$row['ID_GRP_FUNC']."<BR/>";
                    try {
                        # todos os colaboradores presentes na avaliação em todas as fases para o grupo funcional selecionado
                        $stmt2 = $db->prepare(  "SELECT DISTINCT A.ID_FASE, A.DT_INI_FASE, A.DT_INI_FPA, A.RHID_AVALIADO, A.DT_ADMISSAO, A.RHID_AVALIADOR, A.DT_INI_AF, A.DT_FIM_AF, A.ESTADO ".
                                                "FROM RH_AVALIADOR_FASES A, RH_AVALIADOS B, QUAD_PEOPLE C ".
                                                "WHERE A.EMPRESA = :EMPRESA_ ".
                                                "  AND A.ID_PA = :ID_PA_ ".
                                                "  AND A.DT_INI_PA = :DT_INI_PA_ ".
                                                "  AND A.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                                                "  AND A.DT_INI_PROCESSO = :DT_INI_PROCESSO_".
                                                "  AND A.EMPRESA = B.EMPRESA ".
                                                "  AND A.DT_INI_PA = B.DT_INI_PA ".
                                                "  AND A.ID_PROCESSO_AV = B.ID_PROCESSO_AV ".
                                                "  AND A.DT_INI_PROCESSO = B.DT_INI_PROCESSO ".
                                                "  AND A.RHID_AVALIADO = B.RHID ".
                                                "  AND A.DT_ADMISSAO = B.DT_ADMISSAO ".
                                                "  AND A.ESTADO != 'Z' ".
                                                "  AND (A.EMPRESA, A.ID_PA, A.DT_INI_PA, A.ID_PROCESSO_AV, A.DT_INI_PROCESSO, A.RHID_AVALIADO, A.DT_ADMISSAO, A.RHID_AVALIADOR) NOT IN  ".
                                                "		 (SELECT DISTINCT X.EMPRESA, X.ID_PA, X.DT_INI_PA, X.ID_PROCESSO_AV, X.DT_INI_PROCESSO, X.RHID_AVALIADO, X.DT_ADMISSAO,X.RHID_AVALIADOR ".
                                                "		  FROM  RH_ID_AVALIACAO_OBJECTIVOS X ".
                                                "                 WHERE X.EMPRESA = :EMPRESA_ ".
                                                "                   AND X.ID_PA = :ID_PA_ ".
                                                "                   AND X.DT_INI_PA = :DT_INI_PA_ ".
                                                "                   AND X.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                                                "                   AND X.DT_INI_PROCESSO = :DT_INI_PROCESSO_) ".
                                                "  AND C.EMPRESA = A.EMPRESA ".
                                                "  AND C.RHID = A.RHID_AVALIADO ".
                                                "  AND C.DT_ADMISSAO = A.DT_ADMISSAO ".
                                                "  AND C.ID_GRP_FUNC = :ID_GRP_FUNC_ ");
                        $stmt2->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                        $stmt2->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                        $stmt2->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                        $stmt2->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                        $stmt2->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                        $stmt2->bindParam(':ID_GRP_FUNC_', $row['ID_GRP_FUNC'], PDO::PARAM_STR);
                        $stmt2->execute();
                    } catch (Exception $ex) {
                        $msg = "get_objetivos#2 :" . $ex->getMessage();
                    }

                    if ($msg == '') {
                        while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
#echo "avaliado:".$row2['RHID_AVALIADO'].' avaliador:'.$row2['RHID_AVALIADOR'].
#     " fase:".$row2['ID_FASE'].'/'.$row2['DT_INI_FASE'].'/'.$row2['DT_INI_FPA'].'/'.$row2['DT_INI_AF'].
#     " <br/>";
                            try {
                                ## objetivos
                                $stmt1 = $db->prepare(  "SELECT A.ID_GRP_FUNC, A.DT_INI_GRP_FUNC, A.ID_OBJECTIVO, A.DT_INI_OBJECTIVO, A.DT_INI_OGF, A.DT_FIM_OGF, A.DT_INI_GRP_FUNC, A.RHID, ".
                                                        "       A.VALOR_REQUERIDO, A.PESO, A.ID_EP, A.DT_INI_EP, A.ID_NV_ESCALA, A.DT_INI_NV_ESCALA, ".
                                                        "       B.ID_MAGNITUDE, B.DT_INI_DM ".
                                                        "FROM   RH_OBJECTIVOS_GRP_FUNCIONAIS A, RH_DEF_OBJECTIVOS B ".
                                                        "WHERE  A.EMPRESA = :EMPRESA_ ".
                                                        " AND   A.ID_GRP_FUNC = :ID_GRP_FUNC_ ".
                                                        " AND   A.DT_FIM_OGF IS NULL ".
                                                        " AND   A.EMPRESA = B.EMPRESA ".
                                                        " AND   A.ID_OBJECTIVO = B.ID_OBJECTIVO ".
                                                        " AND   A.DT_INI_OBJECTIVO = B.DT_INI_OBJECTIVO ".
                                                        " AND   B.DT_FIM IS NULL ");

                                $stmt1->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                                $stmt1->bindParam(':ID_GRP_FUNC_', $row['ID_GRP_FUNC'], PDO::PARAM_STR);
                                $stmt1->execute();

                            } catch (Exception $ex) {
                                $msg = "get_objetivos#2 :" . $ex->getMessage();
                            }
                            if ($msg == '') {
                                while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                                    # cria registos de fichas de avaliação
                                    try {
#echo " OBJETIVO:".$row1['ID_OBJECTIVO'].
#     " <br/>";
                                        $stmt3 = $db->prepare(  "INSERT INTO RH_ID_AVALIACAO_OBJECTIVOS ".
                                                                " (EMPRESA, ID_PA, DT_INI_PA, ID_PROCESSO_AV, DT_INI_PROCESSO, RHID_AVALIADO, DT_ADMISSAO, RHID_AVALIADOR, ID_FASE, DT_INI_FASE, DT_INI_FPA, DT_INI_AF, ".
                                                                "  PESO_AF, NOTA_AF, PERC_AF, PESO_AI, NOTA_AI, PERC_AI, ID_MAGNITUDE, DT_INI_DM, ".
                                                                "  ID_EP_AF, DT_INI_EP_AF, ID_NV_ESCALA_AF, DT_INI_NV_ESCALA_AF, ".
                                                                "  ID_EP_AI, DT_INI_EP_AI, ID_NV_ESCALA_AI, DT_INI_NV_ESCALA_AI, ".
                                                                "  ID_EP_REQ, DT_INI_EP_REQ, ID_NV_ESCALA_REQ, DT_INI_NV_ESCALA_REQ, ".
                                                                "  ID_OBJECTIVO, DT_INI_OBJECTIVO, ".
                                                                "  ID_GRP_FUNC, DT_INI_GRP_FUNC, DT_INI_OGF,".
                                                                "  ID_FUNCAO, TP_REGISTO, DT_INI_FUNCAO, DT_INI_OF, ".
                                                                "  CD_ESTRUTURA, DT_INI_ESTRUTURA, DT_INI_OE, ".
                                                                "  DT_INI_OI, ".
                                                                "  NOTA_REQ, VLR_REQUERIDO, AVALIADO_CONCORDA, COMENT_AVALIADO, DESCRICAO) ".
                                                                " VALUES(:EMPRESA_, :ID_PA_, :DT_INI_PA_, :ID_PROCESSO_AV_,:DT_INI_PROCESSO_,:RHID_AVALIADO_,:DT_ADMISSAO_,:RHID_AVALIADOR_,:ID_FASE_,:DT_INI_FASE_,:DT_INI_FPA_,:DT_INI_AF_, ".
                                                                "  :PESO_AF_, :NOTA_AF_, :PERC_AF_, :PESO_AI_, :NOTA_AI_, :PERC_AI_, :ID_MAGNITUDE_, :DT_INI_DM_, ".
                                                                "  NULL, NULL, NULL, NULL, ".
                                                                "  NULL, NULL, NULL, NULL, ".
                                                                "  :ID_EP_REQ_, :DT_INI_EP_REQ_, :ID_NV_ESCALA_REQ_, :DT_INI_NV_ESCALA_REQ_, ".
                                                                "  :ID_OBJECTIVO_,:DT_INI_OBJECTIVO_, ".
                                                                "  :ID_GRP_FUNC_,:DT_INI_GRP_FUNC_, :DT_INI_OGF_, ".
                                                                "  NULL, NULL, NULL, NULL, ".
                                                                "  NULL, NULL, NULL, ".
                                                                "  NULL, ".
                                                                "  NULL, :VLR_REQUERIDO_, NULL, NULL, NULL) " );

                                        $stmt3->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                                        $stmt3->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                                        $stmt3->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);

                                        $stmt3->bindParam(':RHID_AVALIADO_', $row2['RHID_AVALIADO'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_ADMISSAO_', $row2['DT_ADMISSAO'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':RHID_AVALIADOR_', $row2['RHID_AVALIADOR'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':ID_FASE_', $row2['ID_FASE'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_FASE_', $row2['DT_INI_FASE'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_FPA_', $row2['DT_INI_FPA'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_AF_', $row2['DT_INI_AF'], PDO::PARAM_STR);

                                        $stmt3->bindParam(':NOTA_AF_', $nulo, PDO::PARAM_NULL);
                                        $stmt3->bindParam(':PERC_AF_', $nulo, PDO::PARAM_NULL);
                                        $stmt3->bindParam(':NOTA_AI_', $nulo, PDO::PARAM_NULL);
                                        $stmt3->bindParam(':PERC_AI_', $nulo, PDO::PARAM_NULL);
                                        if ($row1['PESO'] != '') {
                                            $stmt3->bindParam(':PESO_AF_', $row1['PESO'], PDO::PARAM_STR);
                                            $stmt3->bindParam(':PESO_AI_', $row1['PESO'], PDO::PARAM_STR);
                                        } else {
                                            $stmt3->bindParam(':PESO_AF_', $nulo, PDO::PARAM_NULL);
                                            $stmt3->bindParam(':PESO_AI_', $nulo, PDO::PARAM_NULL);
                                        }

                                        if ($row1['ID_MAGNITUDE'] != '' && $row1['DT_INI_DM'] != '' ) {
                                            $stmt3->bindParam(':ID_MAGNITUDE_', $row1['ID_MAGNITUDE'], PDO::PARAM_STR);
                                            $stmt3->bindParam(':DT_INI_DM_', $row1['DT_INI_DM'], PDO::PARAM_STR);
                                        } else {
                                            $stmt3->bindParam(':ID_MAGNITUDE_', $nulo, PDO::PARAM_NULL);
                                            $stmt3->bindParam(':DT_INI_DM_', $nulo, PDO::PARAM_NULL);
                                        }


                                        if ($row1['ID_EP'] != '' && $row1['DT_INI_EP'] != '') {
                                            $stmt3->bindParam(':ID_EP_REQ_', $row1['ID_EP'], PDO::PARAM_STR);
                                            $stmt3->bindParam(':DT_INI_EP_REQ_', $row1['DT_INI_EP'], PDO::PARAM_STR);
                                            if ($row1['ID_EP'] != '' && $row1['DT_INI_EP'] != '') {
                                                $stmt3->bindParam(':ID_NV_ESCALA_REQ_', $row1['ID_NV_ESCALA'], PDO::PARAM_STR);
                                                $stmt3->bindParam(':DT_INI_NV_ESCALA_REQ_', $row1['DT_INI_NV_ESCALA'], PDO::PARAM_STR);
                                            } else {
                                                $stmt3->bindParam(':ID_NV_ESCALA_REQ_',  $nulo, PDO::PARAM_NULL);
                                                $stmt3->bindParam(':DT_INI_NV_ESCALA_REQ_', $nulo, PDO::PARAM_NULL);
                                            }
                                        } else {
                                            $stmt3->bindParam(':ID_EP_REQ_', $nulo, PDO::PARAM_NULL);
                                            $stmt3->bindParam(':DT_INI_EP_REQ_', $nulo, PDO::PARAM_NULL);
                                            $stmt3->bindParam(':ID_NV_ESCALA_REQ_',  $nulo, PDO::PARAM_NULL);
                                            $stmt3->bindParam(':DT_INI_NV_ESCALA_REQ_', $nulo, PDO::PARAM_NULL);
                                        }

                                        $stmt3->bindParam(':ID_OBJECTIVO_', $row1['ID_OBJECTIVO'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_OBJECTIVO_', $row1['DT_INI_OBJECTIVO'], PDO::PARAM_STR);

                                        $stmt3->bindParam(':ID_GRP_FUNC_', $row1['ID_GRP_FUNC'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_GRP_FUNC_', $row1['DT_INI_GRP_FUNC'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_OGF_', $row1['DT_INI_OGF'], PDO::PARAM_STR);

                                        if ($row1['VALOR_REQUERIDO'] != '') {
                                            $stmt3->bindParam(':VLR_REQUERIDO_', $row1['VALOR_REQUERIDO'], PDO::PARAM_STR);
                                        } else {
                                            $stmt3->bindParam(':VLR_REQUERIDO_', $nulo, PDO::PARAM_NULL);
                                        }

                                        $stmt3->execute();

                                    } catch (Exception $ex) {
                                        $msg = "get_objetivos#4 :" . $ex->getMessage();
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        # Objetivos por Função
        elseif ($ao_funcao_ == 'S') {

            ## obtem as distintas funções
            try {
                $stmt = $db->prepare("SELECT DISTINCT B.ID_FUNCAO, B.DT_INI_FUNCAO ".
                                     "FROM RH_AVALIADOS A, QUAD_PEOPLE B ".
                                     "WHERE A.EMPRESA = :EMPRESA_ ".
                                     "  AND A.ID_PA = :ID_PA_ ".
                                     "  AND A.DT_INI_PA = :DT_INI_PA_ ".
                                     "  AND A.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                                     "  AND A.DT_INI_PROCESSO = :DT_INI_PROCESSO_".
                                     "  AND A.EMPRESA = B.EMPRESA ".
                                     "  AND A.RHID = B.RHID ".
                                     "  AND A.DT_ADMISSAO = B.DT_ADMISSAO ".
                                     "  AND B.ID_FUNCAO IS NOT NULL");

                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                $stmt->execute();

            } catch (Exception $ex) {
                $msg = "get_objetivos#5 :" . $ex->getMessage();
            }

            if ($msg == '') {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                    try {
                        ## objetivos
                        $stmt1 = $db->prepare(  "SELECT A.ID_FUNCAO, A.TP_REGISTO, A.DT_INI_FUNCAO, A.ID_OBJECTIVO, A.DT_INI_OBJECTIVO, A.DT_INI_OF, A.DT_FIM_OF, A.RHID, ".
                                                " A.VALOR_REQUERIDO, A.PESO, A.ID_EP, A.DT_INI_EP, A.ID_NV_ESCALA, A.DT_INI_NV_ESCALA, ".
                                                " B.ID_MAGNITUDE, B.DT_INI_DM ".
                                                "FROM   RH_OBJECTIVO_FUNCOES A, RH_DEF_OBJECTIVOS B ".
                                                "WHERE  A.EMPRESA = :EMPRESA_ ".
                                                " AND   A.ID_FUNCAO = :ID_FUNCAO_ ".
                                                " AND   A.TP_REGISTO = :TP_REGISTO_ ".
                                                " AND   A.DT_FIM_OF IS NULL ".
                                                " AND   A.EMPRESA = B.EMPRESA ".
                                                " AND   A.ID_OBJECTIVO = B.ID_OBJECTIVO ".
                                                " AND   A.DT_INI_OBJECTIVO = B.DT_INI_OBJECTIVO ".
                                                " AND   B.DT_FIM IS NULL ");

                        $tp_registo = 'A';
                        $stmt1->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                        $stmt1->bindParam(':ID_FUNCAO_', $row['ID_FUNCAO'], PDO::PARAM_STR);
                        $stmt1->bindParam(':TP_REGISTO_', $tp_registo, PDO::PARAM_STR);
                        $stmt1->execute();
                    } catch (Exception $ex) {
                        $msg = "get_objetivos#6 :" . $ex->getMessage();
                    }

                    if ($msg == '') {
                        while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            try {
                                # todos os colaboradores presentes na avaliação em todas as fases para a função selecionada
                                $stmt2 = $db->prepare(  "SELECT DISTINCT A.ID_FASE, A.DT_INI_FASE, A.DT_INI_FPA, A.RHID_AVALIADO, A.DT_ADMISSAO, A.RHID_AVALIADOR, A.DT_INI_AF, A.DT_FIM_AF, A.ESTADO ".
                                                        "FROM RH_AVALIADOR_FASES A, RH_AVALIADOS B, QUAD_PEOPLE C ".
                                                        "WHERE A.EMPRESA = :EMPRESA_ ".
                                                        "  AND A.ID_PA = :ID_PA_ ".
                                                        "  AND A.DT_INI_PA = :DT_INI_PA_ ".
                                                        "  AND A.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                                                        "  AND A.DT_INI_PROCESSO = :DT_INI_PROCESSO_".
                                                        "  AND A.EMPRESA = B.EMPRESA ".
                                                        "  AND A.DT_INI_PA = B.DT_INI_PA ".
                                                        "  AND A.ID_PROCESSO_AV = B.ID_PROCESSO_AV ".
                                                        "  AND A.DT_INI_PROCESSO = B.DT_INI_PROCESSO ".
                                                        "  AND A.RHID_AVALIADO = B.RHID ".
                                                        "  AND A.DT_ADMISSAO = B.DT_ADMISSAO ".
                                                        "  AND A.ESTADO != 'Z' ".
                                                        "  AND (A.EMPRESA, A.ID_PA, A.DT_INI_PA, A.ID_PROCESSO_AV, A.DT_INI_PROCESSO, A.RHID_AVALIADO, A.DT_ADMISSAO, A.RHID_AVALIADOR) NOT IN  ".
                                                        "		 (SELECT DISTINCT X.EMPRESA, X.ID_PA, X.DT_INI_PA, X.ID_PROCESSO_AV, X.DT_INI_PROCESSO, X.RHID_AVALIADO, X.DT_ADMISSAO,X.RHID_AVALIADOR ".
                                                        "		  FROM  RH_ID_AVALIACAO_OBJECTIVOS X ".
                                                        "                 WHERE X.EMPRESA = :EMPRESA_ ".
                                                        "                   AND X.ID_PA = :ID_PA_ ".
                                                        "                   AND X.DT_INI_PA = :DT_INI_PA_ ".
                                                        "                   AND X.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                                                        "                   AND X.DT_INI_PROCESSO = :DT_INI_PROCESSO_) ".
                                                        "  AND   (A.EMPRESA, A.ID_PA, A.DT_INI_PA, A.ID_PROCESSO_AV, A.DT_INI_PROCESSO, A.RHID_AVALIADO, A.DT_ADMISSAO, A.RHID_AVALIADOR) NOT IN  ".
                                                        "		 (SELECT X.EMPRESA, X.ID_PA, X.DT_INI_PA, X.ID_PROCESSO_AV, X.DT_INI_PROCESSO,X.RHID_AVALIADO, X.DT_ADMISSAO,X.RHID_AVALIADOR ".
                                                        "		  FROM  RH_FICHA_AVAL_COMPORTAMENTOS X ".
                                                        "                 WHERE X.EMPRESA = :EMPRESA_ ".
                                                        "                   AND X.ID_PA = :ID_PA_ ".
                                                        "                   AND X.DT_INI_PA = :DT_INI_PA_ ".
                                                        "                   AND X.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                                                        "                   AND X.DT_INI_PROCESSO = :DT_INI_PROCESSO_) ".
                                                        "  AND C.EMPRESA = A.EMPRESA ".
                                                        "  AND C.RHID = A.RHID_AVALIADO ".
                                                        "  AND C.DT_ADMISSAO = A.DT_ADMISSAO ".
                                                        "  AND C.ID_FUNCAO = :ID_FUNCAO_ ".
                                                        "  AND C.DT_INI_FUNCAO = :DT_INI_FUNCAO_ ");

                                $stmt2->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                                $stmt2->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                                $stmt2->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                                $stmt2->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                                $stmt2->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                                $stmt2->bindParam(':ID_FUNCAO_', $row['ID_FUNCAO'], PDO::PARAM_STR);
                                $stmt2->bindParam(':DT_INI_FUNCAO_', $row['DT_INI_FUNCAO'], PDO::PARAM_STR);
                                $stmt2->execute();

                            } catch (Exception $ex) {
                                $msg = "get_objetivos#7 :" . $ex->getMessage();
                            }
                            if ($msg == '') {
                                while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {

                                    # cria registos de fichas de avaliação
                                    try {
                                        $stmt3 = $db->prepare(  "INSERT INTO RH_ID_AVALIACAO_OBJECTIVOS ".
                                                                " (EMPRESA, ID_PA, DT_INI_PA, ID_PROCESSO_AV, DT_INI_PROCESSO, RHID_AVALIADO, DT_ADMISSAO, RHID_AVALIADOR, ID_FASE, DT_INI_FASE, DT_INI_FPA, DT_INI_AF, ".
                                                                "  PESO_AF, NOTA_AF, PERC_AF, PESO_AI, NOTA_AI, PERC_AI, ID_MAGNITUDE, DT_INI_DM, ".
                                                                "  ID_EP_AF, DT_INI_EP_AF, ID_NV_ESCALA_AF, DT_INI_NV_ESCALA_AF, ".
                                                                "  ID_EP_AI, DT_INI_EP_AI, ID_NV_ESCALA_AI, DT_INI_NV_ESCALA_AI, ".
                                                                "  ID_EP_REQ, DT_INI_EP_REQ, ID_NV_ESCALA_REQ, DT_INI_NV_ESCALA_REQ, ".
                                                                "  ID_OBJECTIVO, DT_INI_OBJECTIVO, ".
                                                                "  ID_GRP_FUNC, DT_INI_GRP_FUNC, DT_INI_OGF,".
                                                                "  ID_FUNCAO, TP_REGISTO, DT_INI_FUNCAO, DT_INI_OF, ".
                                                                "  CD_ESTRUTURA, DT_INI_ESTRUTURA, DT_INI_OE, ".
                                                                "  DT_INI_OI, ".
                                                                "  NOTA_REQ, VLR_REQUERIDO, AVALIADO_CONCORDA, COMENT_AVALIADO, DESCRICAO) ".
                                                                " VALUES(:EMPRESA_, :ID_PA_, :DT_INI_PA_, :ID_PROCESSO_AV_,:DT_INI_PROCESSO_,:RHID_AVALIADO_,:DT_ADMISSAO_,:RHID_AVALIADOR_,:ID_FASE_,:DT_INI_FASE_,:DT_INI_FPA_,:DT_INI_AF_, ".
                                                                "  :PESO_AF_, :NOTA_AF_, :PERC_AF_, :PESO_AI_, :NOTA_AI_, :PERC_AI_, :ID_MAGNITUDE_, :DT_INI_DM_, ".
                                                                "  NULL, NULL, NULL, NULL, ".
                                                                "  NULL, NULL, NULL, NULL, ".
                                                                "  :ID_EP_REQ_, :DT_INI_EP_REQ_, :ID_NV_ESCALA_REQ_, :DT_INI_NV_ESCALA_REQ_, ".
                                                                "  :ID_OBJECTIVO_,:DT_INI_OBJECTIVO_, ".
                                                                "  NULL, NULL, NULL, ".
                                                                "  :ID_FUNCAO_, :TP_REGISTO_, :DT_INI_FUNCAO_, :DT_INI_OF_, ".
                                                                "  NULL, NULL, NULL, ".
                                                                "  NULL, ".
                                                                "  NULL, :VLR_REQUERIDO_, NULL, NULL, NULL) " );

                                        $stmt3->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                                        $stmt3->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                                        $stmt3->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);

                                        $stmt3->bindParam(':RHID_AVALIADO_', $row2['RHID_AVALIADO'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_ADMISSAO_', $row2['DT_ADMISSAO'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':RHID_AVALIADOR_', $row2['RHID_AVALIADOR'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':ID_FASE_', $row2['ID_FASE'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_FASE_', $row2['DT_INI_FASE'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_FPA_', $row2['DT_INI_FPA'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_AF_', $row2['DT_INI_AF'], PDO::PARAM_STR);

                                        $stmt3->bindParam(':NOTA_AF_', $nulo, PDO::PARAM_NULL);
                                        $stmt3->bindParam(':PERC_AF_', $nulo, PDO::PARAM_NULL);
                                        $stmt3->bindParam(':NOTA_AI_', $nulo, PDO::PARAM_NULL);
                                        $stmt3->bindParam(':PERC_AI_', $nulo, PDO::PARAM_NULL);
                                        if ($row1['PESO'] != '') {
                                            $stmt3->bindParam(':PESO_AF_', $row1['PESO'], PDO::PARAM_STR);
                                            $stmt3->bindParam(':PESO_AI_', $row1['PESO'], PDO::PARAM_STR);
                                        } else {
                                            $stmt3->bindParam(':PESO_AF_', $nulo, PDO::PARAM_NULL);
                                            $stmt3->bindParam(':PESO_AI_', $nulo, PDO::PARAM_NULL);
                                        }

                                        if ($row1['ID_MAGNITUDE'] != '' && $row1['DT_INI_DM'] != '' ) {
                                            $stmt3->bindParam(':ID_MAGNITUDE_', $row1['ID_MAGNITUDE'], PDO::PARAM_STR);
                                            $stmt3->bindParam(':DT_INI_DM_', $row1['DT_INI_DM'], PDO::PARAM_STR);
                                        } else {
                                            $stmt3->bindParam(':ID_MAGNITUDE_', $nulo, PDO::PARAM_NULL);
                                            $stmt3->bindParam(':DT_INI_DM_', $nulo, PDO::PARAM_NULL);
                                        }


                                        if ($row1['ID_EP'] != '' && $row1['DT_INI_EP'] != '') {
                                            $stmt3->bindParam(':ID_EP_REQ_', $row1['ID_EP'], PDO::PARAM_STR);
                                            $stmt3->bindParam(':DT_INI_EP_REQ_', $row1['DT_INI_EP'], PDO::PARAM_STR);
                                            if ($row1['ID_EP'] != '' && $row1['DT_INI_EP'] != '') {
                                                $stmt3->bindParam(':ID_NV_ESCALA_REQ_', $row1['ID_NV_ESCALA'], PDO::PARAM_STR);
                                                $stmt3->bindParam(':DT_INI_NV_ESCALA_REQ_', $row1['DT_INI_NV_ESCALA'], PDO::PARAM_STR);
                                            } else {
                                                $stmt3->bindParam(':ID_NV_ESCALA_REQ_',  $nulo, PDO::PARAM_NULL);
                                                $stmt3->bindParam(':DT_INI_NV_ESCALA_REQ_', $nulo, PDO::PARAM_NULL);
                                            }
                                        } else {
                                            $stmt3->bindParam(':ID_EP_REQ_', $nulo, PDO::PARAM_NULL);
                                            $stmt3->bindParam(':DT_INI_EP_REQ_', $nulo, PDO::PARAM_NULL);
                                            $stmt3->bindParam(':ID_NV_ESCALA_REQ_',  $nulo, PDO::PARAM_NULL);
                                            $stmt3->bindParam(':DT_INI_NV_ESCALA_REQ_', $nulo, PDO::PARAM_NULL);
                                        }

                                        $stmt3->bindParam(':ID_OBJECTIVO_', $row1['ID_OBJECTIVO'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_OBJECTIVO_', $row1['DT_INI_OBJECTIVO'], PDO::PARAM_STR);

                                        $stmt3->bindParam(':ID_FUNCAO_', $row1['ID_FUNCAO'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':TP_REGISTO_', $row1['TP_REGISTO'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_FUNCAO_', $row1['DT_INI_FUNCAO'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_OF_', $row1['DT_INI_OF'], PDO::PARAM_STR);

                                        if ($row1['VALOR_REQUERIDO'] != '') {
                                            $stmt3->bindParam(':VLR_REQUERIDO_', $row1['VALOR_REQUERIDO'], PDO::PARAM_STR);
                                        } else {
                                            $stmt3->bindParam(':VLR_REQUERIDO_', $nulo, PDO::PARAM_NULL);
                                        }

                                        $stmt3->execute();

                                    } catch (Exception $ex) {
                                        $msg = "get_objetivos#8 :" . $ex->getMessage();
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        # Objetivos por Estrutura
        elseif ($ao_estrutura_ == 'S') {

            ## obtem as distintas estruturas
            try {
                $stmt = $db->prepare("SELECT DISTINCT B.CD_ESTRUTURA, B.DT_INI_ESTRUTURA ".
                                     "FROM RH_AVALIADOS A, QUAD_PEOPLE B ".
                                     "WHERE A.EMPRESA = :EMPRESA_ ".
                                     "  AND A.ID_PA = :ID_PA_ ".
                                     "  AND A.DT_INI_PA = :DT_INI_PA_ ".
                                     "  AND A.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                                     "  AND A.DT_INI_PROCESSO = :DT_INI_PROCESSO_".
                                     "  AND A.EMPRESA = B.EMPRESA ".
                                     "  AND A.RHID = B.RHID ".
                                     "  AND A.DT_ADMISSAO = B.DT_ADMISSAO ".
                                     "  AND B.CD_ESTRUTURA IS NOT NULL");

                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                $stmt->execute();

            } catch (Exception $ex) {
                $msg = "get_objetivos#9 :" . $ex->getMessage();
            }

            if ($msg == '') {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                    try {
                        ## objetivos
                        $stmt1 = $db->prepare(  "SELECT A.CD_ESTRUTURA, A.DT_INI_ESTRUTURA, A.ID_OBJECTIVO, A.DT_INI_OBJECTIVO, A.DT_INI_OE, A.DT_FIM_OE, A.RHID, ".
                                                " A.VALOR_REQUERIDO, A.PESO, A.ID_EP, A.DT_INI_EP, A.ID_NV_ESCALA, A.DT_INI_NV_ESCALA, ".
                                                " B.ID_MAGNITUDE, B.DT_INI_DM ".
                                                "FROM   RH_OBJECTIVO_ESTRUTURA A, RH_DEF_OBJECTIVOS B ".
                                                "WHERE  A.EMPRESA = :EMPRESA_ ".
                                                " AND   A.CD_ESTRUTURA = :CD_ESTRUTURA_ ".
                                                " AND   A.DT_INI_ESTRUTURA = :DT_INI_ESTRUTURA_ ".
                                                " AND   A.DT_FIM_OE IS NULL ".
                                                " AND   A.EMPRESA = B.EMPRESA ".
                                                " AND   A.ID_OBJECTIVO = B.ID_OBJECTIVO ".
                                                " AND   A.DT_INI_OBJECTIVO = B.DT_INI_OBJECTIVO ".
                                                " AND   B.DT_FIM IS NULL ");

                        $stmt1->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                        $stmt1->bindParam(':CD_ESTRUTURA_', $row['CD_ESTRUTURA'], PDO::PARAM_STR);
                        $stmt1->bindParam(':DT_INI_ESTRUTURA_', $row['DT_INI_ESTRUTURA_'], PDO::PARAM_STR);
                        $stmt1->execute();
                    } catch (Exception $ex) {
                        $msg = "get_objetivos#10 :" . $ex->getMessage();
                    }

                    if ($msg == '') {
                        while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            try {
                                # todos os colaboradores presentes na avaliação em todas as fases para a função selecionada
                                $stmt2 = $db->prepare(  "SELECT DISTINCT A.ID_FASE, A.DT_INI_FASE, A.DT_INI_FPA, A.RHID_AVALIADO, A.DT_ADMISSAO, A.RHID_AVALIADOR, A.DT_INI_AF, A.DT_FIM_AF, A.ESTADO ".
                                                        "FROM RH_AVALIADOR_FASES A, RH_AVALIADOS B, QUAD_PEOPLE C ".
                                                        "WHERE A.EMPRESA = :EMPRESA_ ".
                                                        "  AND A.ID_PA = :ID_PA_ ".
                                                        "  AND A.DT_INI_PA = :DT_INI_PA_ ".
                                                        "  AND A.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                                                        "  AND A.DT_INI_PROCESSO = :DT_INI_PROCESSO_".
                                                        "  AND A.EMPRESA = B.EMPRESA ".
                                                        "  AND A.DT_INI_PA = B.DT_INI_PA ".
                                                        "  AND A.ID_PROCESSO_AV = B.ID_PROCESSO_AV ".
                                                        "  AND A.DT_INI_PROCESSO = B.DT_INI_PROCESSO ".
                                                        "  AND A.RHID_AVALIADO = B.RHID ".
                                                        "  AND A.DT_ADMISSAO = B.DT_ADMISSAO ".
                                                        "  AND A.ESTADO != 'Z' ".
                                                        "  AND (A.EMPRESA, A.ID_PA, A.DT_INI_PA, A.ID_PROCESSO_AV, A.DT_INI_PROCESSO, A.RHID_AVALIADO, A.DT_ADMISSAO, A.RHID_AVALIADOR) NOT IN  ".
                                                        "		 (SELECT DISTINCT X.EMPRESA, X.ID_PA, X.DT_INI_PA, X.ID_PROCESSO_AV, X.DT_INI_PROCESSO, X.RHID_AVALIADO, X.DT_ADMISSAO,X.RHID_AVALIADOR ".
                                                        "		  FROM  RH_ID_AVALIACAO_OBJECTIVOS X ".
                                                        "                 WHERE X.EMPRESA = :EMPRESA_ ".
                                                        "                   AND X.ID_PA = :ID_PA_ ".
                                                        "                   AND X.DT_INI_PA = :DT_INI_PA_ ".
                                                        "                   AND X.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                                                        "                   AND X.DT_INI_PROCESSO = :DT_INI_PROCESSO_) ".
                                                        "  AND   (A.EMPRESA, A.ID_PA, A.DT_INI_PA, A.ID_PROCESSO_AV, A.DT_INI_PROCESSO, A.RHID_AVALIADO, A.DT_ADMISSAO, A.RHID_AVALIADOR) NOT IN  ".
                                                        "		 (SELECT X.EMPRESA, X.ID_PA, X.DT_INI_PA, X.ID_PROCESSO_AV, X.DT_INI_PROCESSO,X.RHID_AVALIADO, X.DT_ADMISSAO,X.RHID_AVALIADOR ".
                                                        "		  FROM  RH_FICHA_AVAL_COMPORTAMENTOS X ".
                                                        "                 WHERE X.EMPRESA = :EMPRESA_ ".
                                                        "                   AND X.ID_PA = :ID_PA_ ".
                                                        "                   AND X.DT_INI_PA = :DT_INI_PA_ ".
                                                        "                   AND X.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                                                        "                   AND X.DT_INI_PROCESSO = :DT_INI_PROCESSO_) ".
                                                        "  AND C.EMPRESA = A.EMPRESA ".
                                                        "  AND C.RHID = A.RHID_AVALIADO ".
                                                        "  AND C.DT_ADMISSAO = A.DT_ADMISSAO ".
                                                        "  AND C.CD_ESTRUTURA = :CD_ESTRUTURA_ ".
                                                        "  AND C.DT_INI_ESTRUTURA = :DT_INI_ESTRUTURA_ ");

                                $stmt2->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                                $stmt2->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                                $stmt2->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                                $stmt2->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                                $stmt2->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                                $stmt2->bindParam(':CD_ESTRUTURA_', $row['CD_ESTRUTURA'], PDO::PARAM_STR);
                                $stmt2->bindParam(':DT_INI_ESTRUTURA_', $row['DT_INI_ESTRUTURA'], PDO::PARAM_STR);
                                $stmt2->execute();

                            } catch (Exception $ex) {
                                $msg = "get_objetivos#11 :" . $ex->getMessage();
                            }
                            if ($msg == '') {
                                while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {

                                    # cria registos de fichas de avaliação
                                    try {
                                        $stmt3 = $db->prepare(  "INSERT INTO RH_ID_AVALIACAO_OBJECTIVOS ".
                                                                " (EMPRESA, ID_PA, DT_INI_PA, ID_PROCESSO_AV, DT_INI_PROCESSO, RHID_AVALIADO, DT_ADMISSAO, RHID_AVALIADOR, ID_FASE, DT_INI_FASE, DT_INI_FPA, DT_INI_AF, ".
                                                                "  PESO_AF, NOTA_AF, PERC_AF, PESO_AI, NOTA_AI, PERC_AI, ID_MAGNITUDE, DT_INI_DM, ".
                                                                "  ID_EP_AF, DT_INI_EP_AF, ID_NV_ESCALA_AF, DT_INI_NV_ESCALA_AF, ".
                                                                "  ID_EP_AI, DT_INI_EP_AI, ID_NV_ESCALA_AI, DT_INI_NV_ESCALA_AI, ".
                                                                "  ID_EP_REQ, DT_INI_EP_REQ, ID_NV_ESCALA_REQ, DT_INI_NV_ESCALA_REQ, ".
                                                                "  ID_OBJECTIVO, DT_INI_OBJECTIVO, ".
                                                                "  ID_GRP_FUNC, DT_INI_GRP_FUNC, DT_INI_OGF,".
                                                                "  ID_FUNCAO, TP_REGISTO, DT_INI_FUNCAO, DT_INI_OF, ".
                                                                "  CD_ESTRUTURA, DT_INI_ESTRUTURA, DT_INI_OE, ".
                                                                "  DT_INI_OI, ".
                                                                "  NOTA_REQ, VLR_REQUERIDO, AVALIADO_CONCORDA, COMENT_AVALIADO, DESCRICAO) ".
                                                                " VALUES(:EMPRESA_, :ID_PA_, :DT_INI_PA_, :ID_PROCESSO_AV_,:DT_INI_PROCESSO_,:RHID_AVALIADO_,:DT_ADMISSAO_,:RHID_AVALIADOR_,:ID_FASE_,:DT_INI_FASE_,:DT_INI_FPA_,:DT_INI_AF_, ".
                                                                "  :PESO_AF_, :NOTA_AF_, :PERC_AF_, :PESO_AI_, :NOTA_AI_, :PERC_AI_, :ID_MAGNITUDE_, :DT_INI_DM_, ".
                                                                "  NULL, NULL, NULL, NULL, ".
                                                                "  NULL, NULL, NULL, NULL, ".
                                                                "  :ID_EP_REQ_, :DT_INI_EP_REQ_, :ID_NV_ESCALA_REQ_, :DT_INI_NV_ESCALA_REQ_, ".
                                                                "  :ID_OBJECTIVO_,:DT_INI_OBJECTIVO_, ".
                                                                "  NULL, NULL, NULL, ".
                                                                "  NULL, NULL, NULL, NULL, ".
                                                                "  :CD_ESTRUTURA_, :DT_INI_ESTRUTURA_, :DT_INI_OE_, ".
                                                                "  NULL, ".
                                                                "  NULL, :VLR_REQUERIDO_, NULL, NULL, NULL) " );

                                        $stmt3->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                                        $stmt3->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                                        $stmt3->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);

                                        $stmt3->bindParam(':RHID_AVALIADO_', $row2['RHID_AVALIADO'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_ADMISSAO_', $row2['DT_ADMISSAO'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':RHID_AVALIADOR_', $row2['RHID_AVALIADOR'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':ID_FASE_', $row2['ID_FASE'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_FASE_', $row2['DT_INI_FASE'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_FPA_', $row2['DT_INI_FPA'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_AF_', $row2['DT_INI_AF'], PDO::PARAM_STR);

                                        $stmt3->bindParam(':NOTA_AF_', $nulo, PDO::PARAM_NULL);
                                        $stmt3->bindParam(':PERC_AF_', $nulo, PDO::PARAM_NULL);
                                        $stmt3->bindParam(':NOTA_AI_', $nulo, PDO::PARAM_NULL);
                                        $stmt3->bindParam(':PERC_AI_', $nulo, PDO::PARAM_NULL);
                                        if ($row1['PESO'] != '') {
                                            $stmt3->bindParam(':PESO_AF_', $row1['PESO'], PDO::PARAM_STR);
                                            $stmt3->bindParam(':PESO_AI_', $row1['PESO'], PDO::PARAM_STR);
                                        } else {
                                            $stmt3->bindParam(':PESO_AF_', $nulo, PDO::PARAM_NULL);
                                            $stmt3->bindParam(':PESO_AI_', $nulo, PDO::PARAM_NULL);
                                        }

                                        if ($row1['ID_MAGNITUDE'] != '' && $row1['DT_INI_DM'] != '' ) {
                                            $stmt3->bindParam(':ID_MAGNITUDE_', $row1['ID_MAGNITUDE'], PDO::PARAM_STR);
                                            $stmt3->bindParam(':DT_INI_DM_', $row1['DT_INI_DM'], PDO::PARAM_STR);
                                        } else {
                                            $stmt3->bindParam(':ID_MAGNITUDE_', $nulo, PDO::PARAM_NULL);
                                            $stmt3->bindParam(':DT_INI_DM_', $nulo, PDO::PARAM_NULL);
                                        }


                                        if ($row1['ID_EP'] != '' && $row1['DT_INI_EP'] != '') {
                                            $stmt3->bindParam(':ID_EP_REQ_', $row1['ID_EP'], PDO::PARAM_STR);
                                            $stmt3->bindParam(':DT_INI_EP_REQ_', $row1['DT_INI_EP'], PDO::PARAM_STR);
                                            if ($row1['ID_EP'] != '' && $row1['DT_INI_EP'] != '') {
                                                $stmt3->bindParam(':ID_NV_ESCALA_REQ_', $row1['ID_NV_ESCALA'], PDO::PARAM_STR);
                                                $stmt3->bindParam(':DT_INI_NV_ESCALA_REQ_', $row1['DT_INI_NV_ESCALA'], PDO::PARAM_STR);
                                            } else {
                                                $stmt3->bindParam(':ID_NV_ESCALA_REQ_',  $nulo, PDO::PARAM_NULL);
                                                $stmt3->bindParam(':DT_INI_NV_ESCALA_REQ_', $nulo, PDO::PARAM_NULL);
                                            }
                                        } else {
                                            $stmt3->bindParam(':ID_EP_REQ_', $nulo, PDO::PARAM_NULL);
                                            $stmt3->bindParam(':DT_INI_EP_REQ_', $nulo, PDO::PARAM_NULL);
                                            $stmt3->bindParam(':ID_NV_ESCALA_REQ_',  $nulo, PDO::PARAM_NULL);
                                            $stmt3->bindParam(':DT_INI_NV_ESCALA_REQ_', $nulo, PDO::PARAM_NULL);
                                        }

                                        $stmt3->bindParam(':ID_OBJECTIVO_', $row1['ID_OBJECTIVO'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_OBJECTIVO_', $row1['DT_INI_OBJECTIVO'], PDO::PARAM_STR);

                                        $stmt3->bindParam(':CD_ESTRUTURA_', $row1['CD_ESTRUTURA'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_ESTRUTURA_', $row1['DT_INI_ESTRUTURA'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_OE_', $row1['DT_INI_OE'], PDO::PARAM_STR);

                                        if ($row1['VALOR_REQUERIDO'] != '') {
                                            $stmt3->bindParam(':VLR_REQUERIDO_', $row1['VALOR_REQUERIDO'], PDO::PARAM_STR);
                                        } else {
                                            $stmt3->bindParam(':VLR_REQUERIDO_', $nulo, PDO::PARAM_NULL);
                                        }

                                        $stmt3->execute();

                                    } catch (Exception $ex) {
                                        $msg = "get_objetivos#12 :" . $ex->getMessage();
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        # Inclusão de Objetivos Individuais
        if ($ao_colaborador_ == 'S') {

            ## obtem os distintos colaboradores presentes na avaliação em todas as fases
            try {
                $stmt = $db->prepare(  "SELECT DISTINCT A.ID_FASE, A.DT_INI_FASE, A.DT_INI_FPA, A.RHID_AVALIADO, A.DT_ADMISSAO, A.RHID_AVALIADOR, A.DT_INI_AF, A.DT_FIM_AF, A.ESTADO ".
                                        "FROM RH_AVALIADOR_FASES A, RH_AVALIADOS B, QUAD_PEOPLE C ".
                                        "WHERE A.EMPRESA = :EMPRESA_ ".
                                        "  AND A.ID_PA = :ID_PA_ ".
                                        "  AND A.DT_INI_PA = :DT_INI_PA_ ".
                                        "  AND A.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                                        "  AND A.DT_INI_PROCESSO = :DT_INI_PROCESSO_".
                                        "  AND A.EMPRESA = B.EMPRESA ".
                                        "  AND A.DT_INI_PA = B.DT_INI_PA ".
                                        "  AND A.ID_PROCESSO_AV = B.ID_PROCESSO_AV ".
                                        "  AND A.DT_INI_PROCESSO = B.DT_INI_PROCESSO ".
                                        "  AND A.RHID_AVALIADO = B.RHID ".
                                        "  AND A.DT_ADMISSAO = B.DT_ADMISSAO ".
                                        "  AND A.ESTADO != 'Z' ".
                                        "  AND C.EMPRESA = A.EMPRESA ".
                                        "  AND C.RHID = A.RHID_AVALIADO ".
                                        "  AND C.DT_ADMISSAO = A.DT_ADMISSAO ".
                                        "  AND C.ID_GRP_FUNC = :ID_GRP_FUNC_ ");
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                $stmt->execute();
            } catch (Exception $ex) {
                $msg = "get_objetivos#13 :" . $ex->getMessage();
            }

            if ($msg == '') {
                while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)) {

                    try {
                        ## objetivos individuais
                        $stmt1 = $db->prepare(  "SELECT A.RHID, A.DT_ADMISSAO, A.ID_OBJECTIVO, A.DT_INI_OBJECTIVO, A.DT_INI_OI, A.DT_FIM_OI, ".
                                                "       A.VALOR_REQUERIDO, A.PESO, A.ID_EP, A.DT_INI_EP, A.ID_NV_ESCALA, A.DT_INI_NV_ESCALA, ".
                                                "       B.ID_MAGNITUDE, B.DT_INI_DM ".
                                                "FROM   RH_OBJECTIVOS_INDIVIDUAIS A, RH_DEF_OBJECTIVOS B ".
                                                "WHERE  A.EMPRESA = :EMPRESA_ ".
                                                " AND   A.RHID = :RHID_ ".
                                                " AND   A.DT_ADMISSAO = :DT_ADMISSAO_ ".
                                                " AND   A.DT_FIM_OI IS NULL ".
                                                " AND   A.EMPRESA = B.EMPRESA ".
                                                " AND   A.ID_OBJECTIVO = B.ID_OBJECTIVO ".
                                                " AND   A.DT_INI_OBJECTIVO = B.DT_INI_OBJECTIVO ".
                                                " AND   B.DT_FIM IS NULL ");

                        $stmt1->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                        $stmt1->bindParam(':RHID_', $row['RHID'], PDO::PARAM_STR);
                        $stmt1->bindParam(':DT_ADMISSAO_', $row['DT_ADMISSAO'], PDO::PARAM_STR);
                        $stmt1->execute();

                    } catch (Exception $ex) {
                        $msg = "get_objetivos#14 :" . $ex->getMessage();
                    }

                    if ($msg == '') {
                        while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {

                            # determina se já existe um objectivo igual ao objectivo a inserir
                            $seq_ = '';
                            try {
                                $stmt2 = $db->prepare(  "SELECT A.SEQ_ ".
                                                        "FROM RH_ID_AVALIACAO_OBJECTIVOS A ".
                                                        "WHERE A.EMPRESA = :EMPRESA_ ".
                                                        "  AND A.ID_PA = :ID_PA_ ".
                                                        "  AND A.DT_INI_PA = :DT_INI_PA_ ".
                                                        "  AND A.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                                                        "  AND A.DT_INI_PROCESSO = :DT_INI_PROCESSO_ ".
                                                        "  AND A.RHID_AVALIADO = :RHID_AVALIADO_ ".
                                                        "  AND A.DT_ADMISSAO = :DT_ADMISSAO_ ".
                                                        "  AND A.RHID_AVALIADOR = :RHID_AVALIADOR_ ".
                                                        "  AND A.ID_FASE = :ID_FASE_ ".
                                                        "  AND A.DT_INI_FASE = :DT_INI_FASE_ ".
                                                        "  AND A.DT_INI_FPA = :DT_INI_FPA_ ".
                                                        "  AND A.DT_INI_AF = :DT_INI_AF_ ".
                                                        "  AND A.ID_OBJECTIVO = :ID_OBJECTIVO_ ".
                                                        "  AND A.DT_INI_OBJECTIVO = :DT_INI_OBJECTIVO_ ");

                                $stmt2->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                                $stmt2->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                                $stmt2->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                                $stmt2->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                                $stmt2->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);

                                $stmt2->bindParam(':RHID_AVALIADO_', $row['RHID_AVALIADO'], PDO::PARAM_STR);
                                $stmt2->bindParam(':DT_ADMISSAO_', $row['DT_ADMISSAO'], PDO::PARAM_STR);
                                $stmt2->bindParam(':RHID_AVALIADOR_', $row['RHID_AVALIADOR'], PDO::PARAM_STR);
                                $stmt2->bindParam(':ID_FASE_', $row['ID_FASE'], PDO::PARAM_STR);
                                $stmt2->bindParam(':DT_INI_FASE_', $row['DT_INI_FASE'], PDO::PARAM_STR);
                                $stmt2->bindParam(':DT_INI_FPA_', $row['DT_INI_FPA'], PDO::PARAM_STR);
                                $stmt2->bindParam(':DT_INI_AF_', $row['DT_INI_AF'], PDO::PARAM_STR);

                                $stmt2->bindParam(':ID_OBJECTIVO_', $row1['ID_OBJECTIVO'], PDO::PARAM_STR);
                                $stmt2->bindParam(':DT_INI_OBJECTIVO_', $row1['DT_INI_OBJECTIVO'], PDO::PARAM_STR);
                                $stmt2->execute();

                                while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                                    $seq_ = $row2['SEQ_'];
                                }

                            } catch (Exception $ex) {
                                $msg = "get_objetivos#15 :" . $ex->getMessage();
                            }

                            if ($msg == '') {
                                # cria registos de fichas de avaliação
                                try {
                                    # não existe objectivo
                                    if ($seq_ == '') {

                                        $stmt3 = $db->prepare(  "INSERT INTO RH_ID_AVALIACAO_OBJECTIVOS ".
                                                                " (EMPRESA, ID_PA, DT_INI_PA, ID_PROCESSO_AV, DT_INI_PROCESSO, RHID_AVALIADO, DT_ADMISSAO, RHID_AVALIADOR, ID_FASE, DT_INI_FASE, DT_INI_FPA, DT_INI_AF, ".
                                                                "  PESO_AF, NOTA_AF, PERC_AF, PESO_AI, NOTA_AI, PERC_AI, ID_MAGNITUDE, DT_INI_DM, ".
                                                                "  ID_EP_AF, DT_INI_EP_AF, ID_NV_ESCALA_AF, DT_INI_NV_ESCALA_AF, ".
                                                                "  ID_EP_AI, DT_INI_EP_AI, ID_NV_ESCALA_AI, DT_INI_NV_ESCALA_AI, ".
                                                                "  ID_EP_REQ, DT_INI_EP_REQ, ID_NV_ESCALA_REQ, DT_INI_NV_ESCALA_REQ, ".
                                                                "  ID_OBJECTIVO, DT_INI_OBJECTIVO, ".
                                                                "  ID_GRP_FUNC, DT_INI_GRP_FUNC, DT_INI_OGF,".
                                                                "  ID_FUNCAO, TP_REGISTO, DT_INI_FUNCAO, DT_INI_OF, ".
                                                                "  CD_ESTRUTURA, DT_INI_ESTRUTURA, DT_INI_OE, ".
                                                                "  DT_INI_OI, ".
                                                                "  NOTA_REQ, VLR_REQUERIDO, AVALIADO_CONCORDA, COMENT_AVALIADO, DESCRICAO) ".
                                                                " VALUES(:EMPRESA_, :ID_PA_, :DT_INI_PA_, :ID_PROCESSO_AV_,:DT_INI_PROCESSO_,:RHID_AVALIADO_,:DT_ADMISSAO_,:RHID_AVALIADOR_,:ID_FASE_,:DT_INI_FASE_,:DT_INI_FPA_,:DT_INI_AF_, ".
                                                                "  :PESO_AF_, :NOTA_AF_, :PERC_AF_, :PESO_AI_, :NOTA_AI_, :PERC_AI_, :ID_MAGNITUDE_, :DT_INI_DM_, ".
                                                                "  NULL, NULL, NULL, NULL, ".
                                                                "  NULL, NULL, NULL, NULL, ".
                                                                "  :ID_EP_REQ_, :DT_INI_EP_REQ_, :ID_NV_ESCALA_REQ_, :DT_INI_NV_ESCALA_REQ_, ".
                                                                "  :ID_OBJECTIVO_,:DT_INI_OBJECTIVO_, ".
                                                                "  NULL, NULL, NULL, ".
                                                                "  NULL, NULL, NULL, NULL, ".
                                                                "  NULL, NULL, NULL, ".
                                                                "  :DT_INI_OI_, ".
                                                                "  NULL, :VLR_REQUERIDO_, NULL, NULL, NULL) " );

                                        $stmt3->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                                        $stmt3->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                                        $stmt3->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);

                                        $stmt3->bindParam(':RHID_AVALIADO_', $row['RHID_AVALIADO'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_ADMISSAO_', $row['DT_ADMISSAO'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':RHID_AVALIADOR_', $row['RHID_AVALIADOR'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':ID_FASE_', $row['ID_FASE'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_FASE_', $row['DT_INI_FASE'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_FPA_', $row['DT_INI_FPA'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_AF_', $row['DT_INI_AF'], PDO::PARAM_STR);

                                        $stmt3->bindParam(':NOTA_AF_', $nulo, PDO::PARAM_NULL);
                                        $stmt3->bindParam(':PERC_AF_', $nulo, PDO::PARAM_NULL);
                                        $stmt3->bindParam(':NOTA_AI_', $nulo, PDO::PARAM_NULL);
                                        $stmt3->bindParam(':PERC_AI_', $nulo, PDO::PARAM_NULL);
                                        if ($row1['PESO'] != '') {
                                            $stmt3->bindParam(':PESO_AF_', $row1['PESO'], PDO::PARAM_STR);
                                            $stmt3->bindParam(':PESO_AI_', $row1['PESO'], PDO::PARAM_STR);
                                        } else {
                                            $stmt3->bindParam(':PESO_AF_', $nulo, PDO::PARAM_NULL);
                                            $stmt3->bindParam(':PESO_AI_', $nulo, PDO::PARAM_NULL);
                                        }

                                        if ($row1['ID_MAGNITUDE'] != '' && $row1['DT_INI_DM'] != '' ) {
                                            $stmt3->bindParam(':ID_MAGNITUDE_', $row1['ID_MAGNITUDE'], PDO::PARAM_STR);
                                            $stmt3->bindParam(':DT_INI_DM_', $row1['DT_INI_DM'], PDO::PARAM_STR);
                                        } else {
                                            $stmt3->bindParam(':ID_MAGNITUDE_', $nulo, PDO::PARAM_NULL);
                                            $stmt3->bindParam(':DT_INI_DM_', $nulo, PDO::PARAM_NULL);
                                        }


                                        if ($row1['ID_EP'] != '' && $row1['DT_INI_EP'] != '') {
                                            $stmt3->bindParam(':ID_EP_REQ_', $row1['ID_EP'], PDO::PARAM_STR);
                                            $stmt3->bindParam(':DT_INI_EP_REQ_', $row1['DT_INI_EP'], PDO::PARAM_STR);
                                            if ($row1['ID_EP'] != '' && $row1['DT_INI_EP'] != '') {
                                                $stmt3->bindParam(':ID_NV_ESCALA_REQ_', $row1['ID_NV_ESCALA'], PDO::PARAM_STR);
                                                $stmt3->bindParam(':DT_INI_NV_ESCALA_REQ_', $row1['DT_INI_NV_ESCALA'], PDO::PARAM_STR);
                                            } else {
                                                $stmt3->bindParam(':ID_NV_ESCALA_REQ_',  $nulo, PDO::PARAM_NULL);
                                                $stmt3->bindParam(':DT_INI_NV_ESCALA_REQ_', $nulo, PDO::PARAM_NULL);
                                            }
                                        } else {
                                            $stmt3->bindParam(':ID_EP_REQ_', $nulo, PDO::PARAM_NULL);
                                            $stmt3->bindParam(':DT_INI_EP_REQ_', $nulo, PDO::PARAM_NULL);
                                            $stmt3->bindParam(':ID_NV_ESCALA_REQ_',  $nulo, PDO::PARAM_NULL);
                                            $stmt3->bindParam(':DT_INI_NV_ESCALA_REQ_', $nulo, PDO::PARAM_NULL);
                                        }

                                        $stmt3->bindParam(':ID_OBJECTIVO_', $row1['ID_OBJECTIVO'], PDO::PARAM_STR);
                                        $stmt3->bindParam(':DT_INI_OBJECTIVO_', $row1['DT_INI_OBJECTIVO'], PDO::PARAM_STR);

                                        $stmt3->bindParam(':DT_INI_OI_', $row1['DT_INI_OI'], PDO::PARAM_STR);

                                        if ($row1['VALOR_REQUERIDO'] != '') {
                                            $stmt3->bindParam(':VLR_REQUERIDO_', $row1['VALOR_REQUERIDO'], PDO::PARAM_STR);
                                        } else {
                                            $stmt3->bindParam(':VLR_REQUERIDO_', $nulo, PDO::PARAM_NULL);
                                        }

                                        $stmt3->execute();

                                    } else {

                                        $stmt3 = $db->prepare(  "UPDATE RH_ID_AVALIACAO_OBJECTIVOS ".
                                                                "SET PESO_AF = :PESO_AF_, NOTA_AF = :NOTA_AF_, PERC_AF = :PERC_AF_, PESO_AI = :PESO_AI_, NOTA_AI = :NOTA_AI_, PERC_AI = :PERC_AI_, ID_MAGNITUDE = :ID_MAGNITUDE_, DT_INI_DM = :DT_INI_DM_, ".
                                                                "  ID_EP_AF = NULL, DT_INI_EP_AF = NULL, ID_NV_ESCALA_AF = NULL, DT_INI_NV_ESCALA_AF = NULL, ".
                                                                "  ID_EP_AI = NULL, DT_INI_EP_AI = NULL, ID_NV_ESCALA_AI = NULL, DT_INI_NV_ESCALA_AI = NULL, ".
                                                                "  ID_EP_REQ = :ID_EP_REQ_, DT_INI_EP_REQ = :DT_INI_EP_REQ_, ID_NV_ESCALA_REQ = :ID_NV_ESCALA_REQ_, DT_INI_NV_ESCALA_REQ = :DT_INI_NV_ESCALA_REQ_, ".
                                                                "  ID_GRP_FUNC = NULL, DT_INI_GRP_FUNC = NULL, DT_INI_OGF = NULL,".
                                                                "  ID_FUNCAO = NULL, TP_REGISTO = NULL, DT_INI_FUNCAO = NULL, DT_INI_OF = NULL, ".
                                                                "  CD_ESTRUTURA = NULL, DT_INI_ESTRUTURA = NULL, DT_INI_OE = NULL, ".
                                                                "  DT_INI_OI =  :DT_INI_OI_, ".
                                                                "  NOTA_REQ = NULL, VLR_REQUERIDO = :VLR_REQUERIDO_, AVALIADO_CONCORDA = NULL, COMENT_AVALIADO = NULL, DESCRICAO = NULL ".
                                                                "WHERE SEQ_ = :SEQ_ ");

                                        $stmt3->bindParam(':NOTA_AF_', $nulo, PDO::PARAM_NULL);
                                        $stmt3->bindParam(':PERC_AF_', $nulo, PDO::PARAM_NULL);
                                        $stmt3->bindParam(':NOTA_AI_', $nulo, PDO::PARAM_NULL);
                                        $stmt3->bindParam(':PERC_AI_', $nulo, PDO::PARAM_NULL);
                                        if ($row1['PESO'] != '') {
                                            $stmt3->bindParam(':PESO_AF_', $row1['PESO'], PDO::PARAM_STR);
                                            $stmt3->bindParam(':PESO_AI_', $row1['PESO'], PDO::PARAM_STR);
                                        } else {
                                            $stmt3->bindParam(':PESO_AF_', $nulo, PDO::PARAM_NULL);
                                            $stmt3->bindParam(':PESO_AI_', $nulo, PDO::PARAM_NULL);
                                        }

                                        if ($row1['ID_MAGNITUDE'] != '' && $row1['DT_INI_DM'] != '' ) {
                                            $stmt3->bindParam(':ID_MAGNITUDE_', $row1['ID_MAGNITUDE'], PDO::PARAM_STR);
                                            $stmt3->bindParam(':DT_INI_DM_', $row1['DT_INI_DM'], PDO::PARAM_STR);
                                        } else {
                                            $stmt3->bindParam(':ID_MAGNITUDE_', $nulo, PDO::PARAM_NULL);
                                            $stmt3->bindParam(':DT_INI_DM_', $nulo, PDO::PARAM_NULL);
                                        }

                                        if ($row1['ID_EP'] != '' && $row1['DT_INI_EP'] != '') {
                                            $stmt3->bindParam(':ID_EP_REQ_', $row1['ID_EP'], PDO::PARAM_STR);
                                            $stmt3->bindParam(':DT_INI_EP_REQ_', $row1['DT_INI_EP'], PDO::PARAM_STR);
                                            if ($row1['ID_EP'] != '' && $row1['DT_INI_EP'] != '') {
                                                $stmt3->bindParam(':ID_NV_ESCALA_REQ_', $row1['ID_NV_ESCALA'], PDO::PARAM_STR);
                                                $stmt3->bindParam(':DT_INI_NV_ESCALA_REQ_', $row1['DT_INI_NV_ESCALA'], PDO::PARAM_STR);
                                            } else {
                                                $stmt3->bindParam(':ID_NV_ESCALA_REQ_',  $nulo, PDO::PARAM_NULL);
                                                $stmt3->bindParam(':DT_INI_NV_ESCALA_REQ_', $nulo, PDO::PARAM_NULL);
                                            }
                                        } else {
                                            $stmt3->bindParam(':ID_EP_REQ_', $nulo, PDO::PARAM_NULL);
                                            $stmt3->bindParam(':DT_INI_EP_REQ_', $nulo, PDO::PARAM_NULL);
                                            $stmt3->bindParam(':ID_NV_ESCALA_REQ_',  $nulo, PDO::PARAM_NULL);
                                            $stmt3->bindParam(':DT_INI_NV_ESCALA_REQ_', $nulo, PDO::PARAM_NULL);
                                        }

                                        $stmt3->bindParam(':DT_INI_OI_', $row1['DT_INI_OI'], PDO::PARAM_STR);

                                        if ($row1['VALOR_REQUERIDO'] != '') {
                                            $stmt3->bindParam(':VLR_REQUERIDO_', $row1['VALOR_REQUERIDO'], PDO::PARAM_STR);
                                        } else {
                                            $stmt3->bindParam(':VLR_REQUERIDO_', $nulo, PDO::PARAM_NULL);
                                        }

                                        $stmt3->bindParam(':SEQ_', $seq_, PDO::PARAM_STR);

                                        $stmt3->execute();

                                    }

                                } catch (Exception $ex) {
                                    $msg = "get_objetivos#16 :" . $ex->getMessage();
                                }
                            }

                        }
                    }
                }
            }
        }
    }

    function get_fichas_avaliacao($empresa_, $plano_, $dt_plano_, $processo_, $dt_processo_, &$msg) {

        global $db;
        $msg = '';
        try {
            $stmt = $db->prepare("SELECT A.EMPRESA, A.ID_PA, A.DT_INI_PA, A.ID_PROCESSO_AV, A.DT_INI_PROCESSO,A.DSP_PROCESSO, A.DSR_PROCESSO, ".
                                 " A.DT_FIM_PROCESSO, A.DT_INI_AVALIACAO, A.DT_FIM_AVALIACAO, ".
                                 " NVL(A.AVAL_COMPETENCIAS,'N') AVAL_COMPETENCIAS, NVL(A.AC_GRP_FUNCIONAL,'N') AC_GRP_FUNCIONAL, ".
                                 " NVL(A.AC_ESTRUTURA,'N') AC_ESTRUTURA, NVL(A.AC_FUNCAO,'N') AC_FUNCAO, NVL(A.AC_COLABORADOR,'N') AC_COLABORADOR, ".
                                 " NVL(A.AVAL_OBJECTIVOS,'N') AVAL_OBJECTIVOS, NVL(A.AO_GRP_FUNCIONAL,'N') AO_GRP_FUNCIONAL, ".
                                 " NVL(A.AO_ESTRUTURA,'N') AO_ESTRUTURA, NVL(A.AO_FUNCAO,'N') AO_FUNCAO, NVL(A.AO_COLABORADOR,'N') AO_COLABORADOR, ".
                                 " NVL(A.AVAL_OBJ_PARTILHADOS,'N') AVAL_OBJ_PARTILHADOS, A.COMITE, A.RHID, A.OBJECTIVOS, A.DESCRICAO, A.TREE_AVALIADOR ".
                                 "FROM RH_PROCESSOS_AVALIACAO A ".
                                 "WHERE A.EMPRESA = :EMPRESA_ ".
                                 "  AND A.ID_PA = :ID_PA_ ".
                                 "  AND A.DT_INI_PA = :DT_INI_PA_ ".
                                 "  AND A.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                                 "  AND A.DT_INI_PROCESSO = :DT_INI_PROCESSO_");

            $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                if ($row['AVAL_COMPETENCIAS'] == 'S' && $msg == '') {
                    get_competencias($empresa_, $plano_, $dt_plano_, $processo_, $dt_processo_,
                                     $row['AC_GRP_FUNCIONAL'], $row['AC_FUNCAO'], $row['AC_ESTRUTURA'], $row['AC_COLABORADOR'], $msg);
                }

                if ($row['AVAL_OBJECTIVOS'] == 'S' && $msg == '') {
                    get_objetivos($empresa_, $plano_, $dt_plano_, $processo_, $dt_processo_,
                                  $row['AO_GRP_FUNCIONAL'], $row['AO_FUNCAO'], $row['AO_ESTRUTURA'], $row['AO_COLABORADOR'], $msg);
                }
            }

        } catch (PDOException $ex) {
            $msg = "get_fichas_avaliacao#1 :" . $ex->getMessage();
        }
    }

    #
    # Remove as fichas de avaliação
    #   Ambito: NULL - tudo, A - Comportamentos, 'B' - Objetivos
    function remove_fichas_avaliacao($empresa_, $plano_, $dt_plano_, $processo_, $dt_processo_, $ambito_,
                                     $grpfunc_, $func_, $estrut_, $sit_, $estab_, $dir_, $dep_, $set_, $vinc_,
                                     $fase_, $rhid_avaliado_, $rhid_avaliador_, &$msg) {

        global $db;
        $msg = '';


	/*
	  ESTADOS:
		A - Criada
		B - Em preenchimento
		C - Submetida
		D - Encerrada
		Z - Não aplicável
        */

	try {
		$sql =  "SELECT COUNT(*) CNT ".
			"FROM RH_AVALIADOR_FASES ".
		        "WHERE EMPRESA = :EMPRESA_ ".
		        "  AND ID_PA = :ID_PA_ ".
		        "  AND DT_INI_PA = :DT_INI_PA_ ".
		        "  AND ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
		        "  AND DT_INI_PROCESSO = :DT_INI_PROCESSO_".
		        "  AND ESTADO IN ('C','D') ";

		$stmt = $db->prepare($sql);
		$stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
		$stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
		$stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
		$stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
		$stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($row['CNT'] > 0 ) {
			$msg = "Existem já fichas de avaliação já submetidas.";
		}


	} catch (Exception $ex) {
		$msg = "remove_fichas_avaliacao#1 :" . $ex->getMessage();
	}

        # existe filtro adicional de colaboradores
        $filtro_avaliados = '';
        if (($grpfunc_ != '' || $func_ != '' || $estrut_ != '' || $sit_ != '' || $estab_ != '' || $dir_ != '' || $dep_ != '' || $set_ != '') && $msg == '') {

            $filtro_avaliados = "  AND (EMPRESA, ID_PA, DT_INI_PA, ID_PROCESSO_AV, DT_INI_PROCESSO, RHID_AVALIADO, DT_ADMISSAO) IS ".
                                "  (SELECT B.EMPRESA, B.ID_PA, B.DT_INI_PA, B.ID_PROCESSO_AV, B.DT_INI_PROCESSO, B.RHID, B.DT_ADMISSAO  ".
                                "   FROM RH_AVALIADOS B ".
                                "   WHERE B.EMPRESA = :EMPRESA_ ".
                                "     AND B.ID_PA = :ID_PA_ ".
                                "     AND B.DT_INI_PA = :DT_INI_PA_ ".
                                "     AND B.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                                "     AND B.DT_INI_PROCESSO = :DT_INI_PROCESSO_ ";

            # RH_AVALIADOS - carateristicas armazenadas
            #
            # V1: SITUACAO (CD)
            # V2: ESTAB (CD)
            # V3: DIRECAO (ID)
            # V4: DEPARTAMENTO (ID)
            # V5: SETOR (ID)
            # V6: FUNCAO (ID)
            # V7: GRP_FUNCIONAL  (ID)
            # V8: ESTRUTURA (ID)
            # V9:
            # V10:

            if ($grpfunc_ != '') {
                $filtro_avaliados .= "     AND B.TY_FLEXALPHA_V7 = '$grpfunc_' ";
            }

            if ($func_ != '') {
                $filtro_avaliados .= "     AND B.TY_FLEXALPHA_V6 = '$func_' ";
            }

            if ($estrut_ != '') {
                $filtro_avaliados .= "     AND B.TY_FLEXALPHA_V8 = '$estrut_' ";
            }

            if ($sit_ != '') {
                $filtro_avaliados .= "     AND B.TY_FLEXALPHA_V1 = '$sit_' ";
            }

            if ($estab_ != '') {
                $filtro_avaliados .= "     AND B.TY_FLEXALPHA_V2 = '$estab_' ";
                if ($set_ != '') {
                    $filtro_avaliados .= "     AND B.TY_FLEXALPHA_V5 = '$set_' ";
                }
            }

            if ($dir_ != '') {
                $filtro_avaliados .= "     AND B.TY_FLEXALPHA_V3 = '$dir_' ";
                if ($dep_ != '') {
                    $filtro_avaliados .= "     AND B.TY_FLEXALPHA_V4 = '$dep_' ";
                }
            }

            if ($vinc_ != '') {
                $filtro_avaliados .= "     AND B.TY_FLEXALPHA_V9 = '$vinc_' ";
            }

            $filtro_avaliados .= "  )";
        }

        # remove comportamentos
        if (($ambito_ == '' || $ambito_ == 'A') && $msg == '') {
            try {
                $sql =  "DELETE FROM RH_FICHA_AVAL_COMPORTAMENTOS ".
                        "WHERE EMPRESA = :EMPRESA_ ".
                        "  AND ID_PA = :ID_PA_ ".
                        "  AND DT_INI_PA = :DT_INI_PA_ ".
                        "  AND ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                        "  AND DT_INI_PROCESSO = :DT_INI_PROCESSO_";

                if ($fase_ != '') {
                    $sql .= "  AND ID_FASE = :ID_FASE_ ";
                }

                if ($rhid_avaliado_ != '') {
                    $sql .= "  AND RHID_AVALIADO = :RHID_AVALIADO_ ";
                }

                if ($rhid_avaliador_ != '') {
                    $sql .= "  AND RHID_AVALIADOR = :RHID_AVALIADOR_ ";
                }

                if ($filtro_avaliados != '') {
                    $sql .= " " .$filtro_avaliados;
                }

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                if ($fase_ != '') {
                    $stmt->bindParam(':ID_FASE_', $fase_, PDO::PARAM_STR);
                }
                if ($rhid_avaliado_ != '') {
                    $stmt->bindParam(':RHID_AVALIADO_', $rhid_avaliado_, PDO::PARAM_STR);
                }
                if ($rhid_avaliador_ != '') {
                    $stmt->bindParam(':RHID_AVALIADOR_', $rhid_avaliador_, PDO::PARAM_STR);
                }
                $stmt->execute();
            } catch (Exception $ex) {
                $msg = "remove_fichas_avaliacao#2 :" . $ex->getMessage();
            }
        }

        # remove objetivos
        if (($ambito_ == '' || $ambito_ == 'B') && $msg == '') {
            try {
                $sql =  "DELETE FROM RH_ID_AVALIACAO_OBJECTIVOS ".
                        "WHERE EMPRESA = :EMPRESA_ ".
                        "  AND ID_PA = :ID_PA_ ".
                        "  AND DT_INI_PA = :DT_INI_PA_ ".
                        "  AND ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                        "  AND DT_INI_PROCESSO = :DT_INI_PROCESSO_";

                if ($fase_ != '') {
                    $sql .= "  AND ID_FASE = :ID_FASE_ ";
                }

                if ($rhid_avaliado_ != '') {
                    $sql .= "  AND RHID_AVALIADO = :RHID_AVALIADO_ ";
                }

                if ($rhid_avaliador_ != '') {
                    $sql .= "  AND RHID_AVALIADOR = :RHID_AVALIADOR_ ";
                }

                if ($filtro_avaliados != '') {
                    $sql .= " " .$filtro_avaliados;
                }

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                if ($fase_ != '') {
                    $stmt->bindParam(':ID_FASE_', $fase_, PDO::PARAM_STR);
                }
                if ($rhid_avaliado_ != '') {
                    $stmt->bindParam(':RHID_AVALIADO_', $rhid_avaliado_, PDO::PARAM_STR);
                }
                if ($rhid_avaliador_ != '') {
                    $stmt->bindParam(':RHID_AVALIADOR_', $rhid_avaliador_, PDO::PARAM_STR);
                }
                $stmt->execute();
            } catch (Exception $ex) {
                $msg = "remove_fichas_avaliacao#3 :" . $ex->getMessage();
            }

        }

        # reinicializar fichas avaliação
        if ($msg == '') {

            try {
                $estado_ = 'A';

                $sql =  "UPDATE RH_AVALIADOR_FASES A ".
                        "SET A.ESTADO = :ESTADO_ ".
                        "WHERE A.EMPRESA = :EMPRESA_ ".
                        "  AND A.ID_PA = :ID_PA_ ".
                        "  AND A.DT_INI_PA = :DT_INI_PA_ ".
                        "  AND A.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                        "  AND A.DT_INI_PROCESSO = :DT_INI_PROCESSO_".
                        "  AND A.ESTADO != 'Z' ";

                if ($fase_ != '') {
                    $sql .= "  AND A.ID_FASE = :ID_FASE_ ";
                }

                if ($rhid_avaliado_ != '') {
                    $sql .= "  AND A.RHID_AVALIADO = :RHID_AVALIADO_ ";
                }

                if ($rhid_avaliador_ != '') {
                    $sql .= "  AND A.RHID_AVALIADOR = :RHID_AVALIADOR_ ";
                }

                if ($filtro_avaliados != '') {
                    $sql .= " " .$filtro_avaliados;
                }

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':ESTADO_', $estado_, PDO::PARAM_STR);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                if ($fase_ != '') {
                    $stmt->bindParam(':ID_FASE_', $fase_, PDO::PARAM_STR);
                }
                if ($fase_ != '') {
                    $stmt->bindParam(':RHID_AVALIADO_', $rhid_avaliado_, PDO::PARAM_STR);
                }
                if ($fase_ != '') {
                    $stmt->bindParam(':RHID_AVALIADOR_', $rhid_avaliador_, PDO::PARAM_STR);
                }
                $stmt->execute();
            } catch (Exception $ex) {
                $msg = "remove_fichas_avaliacao#4 :" . $ex->getMessage();
            }

        }

        # remover PDI
        if ($msg == '') {

            # inicialização do statment
            $sql =  "WHERE EMPRESA = :EMPRESA_ ".
                    "  AND ID_PA = :ID_PA_ ".
                    "  AND DT_INI_PA = :DT_INI_PA_ ".
                    "  AND ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                    "  AND DT_INI_PROCESSO = :DT_INI_PROCESSO_";

            if ($fase_ != '') {
                $sql .= "  AND ID_FASE = :ID_FASE_ ";
            }

            if ($rhid_avaliado_ != '') {
                $sql .= "  AND RHID_AVALIADO = :RHID_AVALIADO_ ";
            }

            if ($rhid_avaliador_ != '') {
                $sql .= "  AND RHID_AVALIADOR = :RHID_AVALIADOR_ ";
            }

            if ($filtro_avaliados != '') {
                $sql .= " " .$filtro_avaliados;
            }

            # Competências avaliadas
            try {
                $sql1 = "DELETE FROM RH_COMPETENCIA_AVALIADAS ".$sql;
                $stmt = $db->prepare($sql1);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                if ($fase_ != '') {
                    $stmt->bindParam(':ID_FASE_', $fase_, PDO::PARAM_STR);
                }
                if ($rhid_avaliado_ != '') {
                    $stmt->bindParam(':RHID_AVALIADO_', $rhid_avaliado_, PDO::PARAM_STR);
                }
                if ($rhid_avaliador_ != '') {
                    $stmt->bindParam(':RHID_AVALIADOR_', $rhid_avaliador_, PDO::PARAM_STR);
                }
                $stmt->execute();
            } catch (Exception $ex) {
                $msg = "remove_fichas_avaliacao#5 :" . $ex->getMessage();
            }

            # Ações avalidação
            if ($msg == '') {
                try {
                    $sql1 = "DELETE FROM RH_ACCOES_AVALIACAO ".$sql;
                    $stmt = $db->prepare($sql1);
                    $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                    $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                    $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                    if ($fase_ != '') {
                        $stmt->bindParam(':ID_FASE_', $fase_, PDO::PARAM_STR);
                    }
                    if ($rhid_avaliado_ != '') {
                        $stmt->bindParam(':RHID_AVALIADO_', $rhid_avaliado_, PDO::PARAM_STR);
                    }
                    if ($rhid_avaliador_ != '') {
                        $stmt->bindParam(':RHID_AVALIADOR_', $rhid_avaliador_, PDO::PARAM_STR);
                    }
                    $stmt->execute();
                } catch (Exception $ex) {
                    $msg = "remove_fichas_avaliacao#6 :" . $ex->getMessage();
                }
            }

            # Areas Desenvolvimento
            if ($msg == '') {
                try {
                    $sql1 = "DELETE FROM RH_AREAS_DESENVOLVIMENTO ".$sql;
                    $stmt = $db->prepare($sql1);
                    $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                    $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                    $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                    if ($fase_ != '') {
                        $stmt->bindParam(':ID_FASE_', $fase_, PDO::PARAM_STR);
                    }
                    if ($rhid_avaliado_ != '') {
                        $stmt->bindParam(':RHID_AVALIADO_', $rhid_avaliado_, PDO::PARAM_STR);
                    }
                    if ($rhid_avaliador_ != '') {
                        $stmt->bindParam(':RHID_AVALIADOR_', $rhid_avaliador_, PDO::PARAM_STR);
                    }
                    $stmt->execute();
                } catch (Exception $ex) {
                    $msg = "remove_fichas_avaliacao#7 :" . $ex->getMessage();
                }
            }

        }
    }

    #
    # Remove Avaliadores da matriz das Fases (HDR das Fichas de Avaliação)
    function remove_avaliadores_fases($empresa_, $plano_, $dt_plano_, $processo_, $dt_processo_,
                                      $grpfunc_, $func_, $estrut_, $sit_, $estab_, $dir_, $dep_, $set_, $vinc_,
                                      $fase_, $rhid_avaliado_, $rhid_avaliador_, &$msg) {

        global $db;
        $msg = '';

        $filtro_avaliados = '';
        # existe filtro adicional de colaboradores
        if ($grpfunc_ != '' || $func_ != '' || $estrut_ != '' || $sit_ != '' || $estab_ != '' || $dir_ != '' || $dep_ != '' || $set_ != '' || $vinc_ != '') {

            $filtro_avaliados = "  AND (A.EMPRESA, A.ID_PA, A.DT_INI_PA, A.ID_PROCESSO_AV, A.DT_INI_PROCESSO, A.RHID_AVALIADO, A.DT_ADMISSAO) IN ".
                                "  (SELECT B.EMPRESA, B.ID_PA, B.DT_INI_PA, B.ID_PROCESSO_AV, B.DT_INI_PROCESSO, B.RHID, B.DT_ADMISSAO  ".
                                "   FROM RH_AVALIADOS B ".
                                "   WHERE B.EMPRESA = :EMPRESA_ ".
                                "     AND B.ID_PA = :ID_PA_ ".
                                "     AND B.DT_INI_PA = :DT_INI_PA_ ".
                                "     AND B.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                                "     AND B.DT_INI_PROCESSO = :DT_INI_PROCESSO_ ";

            # RH_AVALIADOS - carateristicas armazenadas
            #
            # V1: SITUACAO (CD)
            # V2: ESTAB (CD)
            # V3: DIRECAO (ID)
            # V4: DEPARTAMENTO (ID)
            # V5: SETOR (ID)
            # V6: FUNCAO (ID)
            # V7: GRP_FUNCIONAL  (ID)
            # V8: ESTRUTURA (ID)
            # V9: VINC (CD)
            # V10:

            if ($grpfunc_ != '') {
                $filtro_avaliados .= "     AND B.TY_FLEXALPHA_V7 = '$grpfunc_' ";
            }

            if ($func_ != '') {
                $filtro_avaliados .= "     AND B.TY_FLEXALPHA_V6 = '$func_' ";
            }

            if ($estrut_ != '') {
                $filtro_avaliados .= "     AND B.TY_FLEXALPHA_V8 = '$estrut_' ";
            }

            if ($sit_ != '') {
                $filtro_avaliados .= "     AND B.TY_FLEXALPHA_V1 = '$sit_' ";
            }

            if ($estab_ != '') {
                $filtro_avaliados .= "     AND B.TY_FLEXALPHA_V2 = '$estab_' ";
                if ($set_ != '') {
                    $filtro_avaliados .= "     AND B.TY_FLEXALPHA_V5 = '$set_' ";
                }
            }

            if ($dir_ != '') {
                $filtro_avaliados .= "     AND B.TY_FLEXALPHA_V3 = '$dir_' ";
                if ($dep_ != '') {
                    $filtro_avaliados .= "     AND B.TY_FLEXALPHA_V4 = '$dep_' ";
                }
            }

            if ($vinc_ != '') {
                $filtro_avaliados .= "     AND B.TY_FLEXALPHA_V9 = '$vinc_' ";
            }

            $filtro_avaliados .= "  )";
        }

        # remover avaliadores da matriz de fases
        if ($msg == '') {
            try {
                $sql = "DELETE FROM RH_AVALIADOR_FASES ".
                        "WHERE EMPRESA = :EMPRESA_ ".
                        "  AND ID_PA = :ID_PA_ ".
                        "  AND DT_INI_PA = :DT_INI_PA_ ".
                        "  AND ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                        "  AND DT_INI_PROCESSO = :DT_INI_PROCESSO_";

                if ($fase_ != '') {
                    $sql .= "  AND ID_FASE = :ID_FASE_ ";
                }

                if ($rhid_avaliado_ != '') {
                    $sql .= "  AND RHID_AVALIADO = :RHID_AVALIADO_ ";
                }

                if ($rhid_avaliador_ != '') {
                    $sql .= "  AND RHID_AVALIADOR = :RHID_AVALIADOR_ ";
                }

                if ($filtro_avaliados != '') {
                    $sql .= " " .$filtro_avaliados;
                }

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                if ($fase_ != '') {
                    $stmt->bindParam(':ID_FASE_', $fase_, PDO::PARAM_STR);
                }
                if ($rhid_avaliado_ != '') {
                    $stmt->bindParam(':RHID_AVALIADO_', $rhid_avaliado_, PDO::PARAM_STR);
                }
                if ($rhid_avaliador_ != '') {
                    $stmt->bindParam(':RHID_AVALIADOR_', $rhid_avaliador_, PDO::PARAM_STR);
                }
                $stmt->execute();
            } catch (Exception $ex) {
                $msg = "remove_avaliadores_fases#1 :" . $ex->getMessage();
            }
        }
    }

    #
    # Remove Avaliadores
    function remove_avaliadores($empresa_, $plano_, $dt_plano_, $processo_, $dt_processo_,
                                $grpfunc_, $func_, $estrut_, $sit_, $estab_, $dir_, $dep_, $set_, $vinc_,
                                $rhid_avaliado_, $rhid_avaliador_, &$msg) {

        global $db;
        $msg = '';

        $filtro_avaliados = '';
        # existe filtro adicional de colaboradores
        if ($grpfunc_ != '' || $func_ != '' || $estrut_ != '' || $sit_ != '' || $estab_ != '' || $dir_ != '' || $dep_ != '' || $set_ != '' || $vinc_ != '') {

            $filtro_avaliados = "  AND (EMPRESA, ID_PA, DT_INI_PA, ID_PROCESSO_AV, DT_INI_PROCESSO, RHID_AVALIADO, DT_ADMISSAO) IN ".
                                "  (SELECT B.EMPRESA, B.ID_PA, B.DT_INI_PA, B.ID_PROCESSO_AV, B.DT_INI_PROCESSO, B.RHID, B.DT_ADMISSAO  ".
                                "   FROM RH_AVALIADOS B ".
                                "   WHERE B.EMPRESA = :EMPRESA_ ".
                                "     AND B.ID_PA = :ID_PA_ ".
                                "     AND B.DT_INI_PA = :DT_INI_PA_ ".
                                "     AND B.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                                "     AND B.DT_INI_PROCESSO = :DT_INI_PROCESSO_ ";

            # RH_AVALIADOS - carateristicas armazenadas
            #
            # V1: SITUACAO (CD)
            # V2: ESTAB (CD)
            # V3: DIRECAO (ID)
            # V4: DEPARTAMENTO (ID)
            # V5: SETOR (ID)
            # V6: FUNCAO (ID)
            # V7: GRP_FUNCIONAL  (ID)
            # V8: ESTRUTURA (ID)
            # V9: VINC (CD)
            # V10:

            if ($grpfunc_ != '') {
                $filtro_avaliados .= "     AND B.TY_FLEXALPHA_V7 = '$grpfunc_' ";
            }

            if ($func_ != '') {
                $filtro_avaliados .= "     AND B.TY_FLEXALPHA_V6 = '$func_' ";
            }

            if ($estrut_ != '') {
                $filtro_avaliados .= "     AND B.TY_FLEXALPHA_V8 = '$estrut_' ";
            }

            if ($sit_ != '') {
                $filtro_avaliados .= "     AND B.TY_FLEXALPHA_V1 = '$sit_' ";
            }

            if ($estab_ != '') {
                $filtro_avaliados .= "     AND B.TY_FLEXALPHA_V2 = '$estab_' ";
                if ($set_ != '') {
                    $filtro_avaliados .= "     AND B.TY_FLEXALPHA_V5 = '$set_' ";
                }
            }

            if ($dir_ != '') {
                $filtro_avaliados .= "     AND B.TY_FLEXALPHA_V3 = '$dir_' ";
                if ($dep_ != '') {
                    $filtro_avaliados .= "     AND B.TY_FLEXALPHA_V4 = '$dep_' ";
                }
            }

            if ($vinc_ != '') {
                $filtro_avaliados .= "     AND B.TY_FLEXALPHA_V9 = '$vinc_' ";
            }

            $filtro_avaliados .= "  )";
        }

        # remover avaliadores
        if ($msg == '') {
            try {
                $sql =  "DELETE FROM RH_AVALIADORES ".
                        "WHERE EMPRESA = :EMPRESA_ ".
                        "  AND ID_PA = :ID_PA_ ".
                        "  AND DT_INI_PA = :DT_INI_PA_ ".
                        "  AND ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                        "  AND DT_INI_PROCESSO = :DT_INI_PROCESSO_ ";

                if ($rhid_avaliado_ != '') {
                    $sql .= "  AND RHID_AVALIADO = :RHID_AVALIADO_ ";
                }

                if ($rhid_avaliador_ != '') {
                    $sql .= "  AND RHID_AVALIADOR = :RHID_AVALIADOR_ ";
                }

                if ($filtro_avaliados != '') {
                    $sql .= " " .$filtro_avaliados;
                }

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);

                if ($rhid_avaliado_ != '') {
                    $stmt->bindParam(':RHID_AVALIADO_', $rhid_avaliado_, PDO::PARAM_STR);
                }
                if ($rhid_avaliador_ != '') {
                    $stmt->bindParam(':RHID_AVALIADOR_', $rhid_avaliador_, PDO::PARAM_STR);
                }
                $stmt->execute();
            } catch (Exception $ex) {
                $msg = "remove_avaliadores#1 :" . $ex->getMessage();
            }
        }
    }

    #
    # Remove Avaliados
    function remove_avaliados($empresa_, $plano_, $dt_plano_, $processo_, $dt_processo_,
                              $grpfunc_, $func_, $estrut_, $sit_, $estab_, $dir_, $dep_, $set_, $vinc_,
                              $rhid_avaliado_, &$msg) {

        global $db;
        $msg = '';

        $filtro_avaliados = '';
        # existe filtro adicional de colaboradores
        if ($grpfunc_ != '' || $func_ != '' || $estrut_ != '' || $sit_ != '' || $estab_ != '' || $dir_ != '' || $dep_ != '' || $set_ != '' || $vinc_ != '') {

            # RH_AVALIADOS - carateristicas armazenadas
            #
            # V1: SITUACAO (CD)
            # V2: ESTAB (CD)
            # V3: DIRECAO (ID)
            # V4: DEPARTAMENTO (ID)
            # V5: SETOR (ID
            # V6: FUNCAO (ID)
            # V7: GRP_FUNCIONAL  (ID)
            # V8: ESTRUTURA (ID)
            # V9: VINC (CD)
            # V10:

            if ($grpfunc_ != '') {
                $filtro_avaliados .= "  AND TY_FLEXALPHA_V7 = '$grpfunc_' ";
            }

            if ($func_ != '') {
                $filtro_avaliados .= "  AND TY_FLEXALPHA_V6 = '$func_' ";
            }

            if ($estrut_ != '') {
                $filtro_avaliados .= "  AND TY_FLEXALPHA_V8 = '$estrut_' ";
            }

            if ($sit_ != '') {
                $filtro_avaliados .= "  AND TY_FLEXALPHA_V1 = '$sit_' ";
            }

            if ($vinc_ != '') {
                $filtro_avaliados .= "  AND TY_FLEXALPHA_V9 = '$vinc_' ";
            }

            if ($estab_ != '') {
                $filtro_avaliados .= "  AND TY_FLEXALPHA_V2 = '$estab_' ";
                if ($set_ != '') {
                    $filtro_avaliados .= "  AND TY_FLEXALPHA_V5 = '$set_' ";
                }
            }

            if ($dir_ != '') {
                $filtro_avaliados .= "  AND TY_FLEXALPHA_V3 = '$dir_' ";
                if ($dep_ != '') {
                    $filtro_avaliados .= "  AND TY_FLEXALPHA_V4 = '$dep_' ";
                }
            }
        }

        # remover avaliados
        if ($msg == '') {
            try {
                $sql = "DELETE FROM RH_AVALIADOS ".
                        "WHERE EMPRESA = :EMPRESA_ ".
                        "  AND ID_PA = :ID_PA_ ".
                        "  AND DT_INI_PA = :DT_INI_PA_ ".
                        "  AND ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                        "  AND DT_INI_PROCESSO = :DT_INI_PROCESSO_";

                if ($rhid_avaliado_ != '') {
                    $sql .= "  AND RHID = :RHID_AVALIADO_ ";
                }

                if ($filtro_avaliados != '') {
                    $sql .= " " .$filtro_avaliados;
                }

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                if ($rhid_avaliado_ != '') {
                    $stmt->bindParam(':RHID_AVALIADO_', $rhid_avaliado_, PDO::PARAM_STR);
                }
                $stmt->execute();
            } catch (Exception $ex) {
                $msg = "remove_avaliados#1 :" . $ex->getMessage();
            }
        }
    }

    #
    # Remove Avaliado
    function remove_avaliado($empresa_, $plano_, $dt_plano_, $processo_, $dt_processo_, $rhid_avaliado_, &$msg) {

        global $db, $error_invalid_oper_av_already_terminated;
        $msg = '';

        # determina o estado do processo
        try {
            $sql =  "SELECT GE_AVALIACAO_TERMINADA(ID_PA,DT_INI_PA,ID_PROCESSO_AV,DT_INI_PROCESSO,RHID,DT_ADMISSAO,EMPRESA) ESTADO_PROC, ".
                    "       GE_ESTADO_PROC_AVALIACAO(EMPRESA,ID_PA,DT_INI_PA,ID_PROCESSO_AV,DT_INI_PROCESSO) ESTADO_AVAL ".
                    "FROM MASTER_AVALIACAO ".
                    "WHERE EMPRESA = :EMPRESA_ ".
                    "  AND ID_PA = :ID_PA_ ".
                    "  AND DT_INI_PA = :DT_INI_PA_ ".
                    "  AND ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                    "  AND DT_INI_PROCESSO = :DT_INI_PROCESSO_".
                    "  AND RHID = :RHID_AVALIADO_ ";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
            $stmt->bindParam(':RHID_AVALIADO_', $rhid_avaliado_, PDO::PARAM_STR);

            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row['ESTADO_PROC'] == 'C' || $row['ESTADO_AVAL'] == 'F' ) {
                    $msg = $error_invalid_oper_av_already_terminated;
            }

        } catch (Exception $ex) {
            $msg = "remove_avaliado#0 :" . $ex->getMessage();
        }
        
        # remove competências
        if ($msg == '') {
            try {
                $sql =  "DELETE FROM RH_FICHA_AVAL_COMPORTAMENTOS ".
                        "WHERE EMPRESA = :EMPRESA_ ".
                        "  AND ID_PA = :ID_PA_ ".
                        "  AND DT_INI_PA = :DT_INI_PA_ ".
                        "  AND ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                        "  AND DT_INI_PROCESSO = :DT_INI_PROCESSO_".
                        "  AND RHID_AVALIADO = :RHID_AVALIADO_ ";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_AVALIADO_', $rhid_avaliado_, PDO::PARAM_STR);
                
                $stmt->execute();
            } catch (Exception $ex) {
                $msg = "remove_avaliado#1 :" . $ex->getMessage();
            }
        }

        # remove objetivos
        if ($msg == '') {
            try {
                $sql =  "DELETE FROM RH_ID_AVALIACAO_OBJECTIVOS ".
                        "WHERE EMPRESA = :EMPRESA_ ".
                        "  AND ID_PA = :ID_PA_ ".
                        "  AND DT_INI_PA = :DT_INI_PA_ ".
                        "  AND ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                        "  AND DT_INI_PROCESSO = :DT_INI_PROCESSO_".
                        "  AND RHID_AVALIADO = :RHID_AVALIADO_ ";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_AVALIADO_', $rhid_avaliado_, PDO::PARAM_STR);
                $stmt->execute();
            } catch (Exception $ex) {
                $msg = "remove_avaliado#2 :" . $ex->getMessage();
            }

        }

        # remover PDI
        if ($msg == '') {

            # inicialização do statment
            $sql =  "WHERE EMPRESA = :EMPRESA_ ".
                    "  AND ID_PA = :ID_PA_ ".
                    "  AND DT_INI_PA = :DT_INI_PA_ ".
                    "  AND ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                    "  AND DT_INI_PROCESSO = :DT_INI_PROCESSO_".
                    "  AND RHID_AVALIADO = :RHID_AVALIADO_ ";
            
            # Competências avaliadas
            try {
                $sql1 = "DELETE FROM RH_COMPETENCIA_AVALIADAS ".$sql;
                $stmt = $db->prepare($sql1);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_AVALIADO_', $rhid_avaliado_, PDO::PARAM_STR);
                $stmt->execute();
            } catch (Exception $ex) {
                $msg = "remove_avaliado#3 :" . $ex->getMessage();
            }

            # Ações avalidação
            if ($msg == '') {
                try {
                    $sql1 = "DELETE FROM RH_ACCOES_AVALIACAO ".$sql;
                    $stmt = $db->prepare($sql1);
                    $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                    $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                    $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                    $stmt->bindParam(':RHID_AVALIADO_', $rhid_avaliado_, PDO::PARAM_STR);
                    $stmt->execute();
                } catch (Exception $ex) {
                    $msg = "remove_avaliado#4 :" . $ex->getMessage();
                }
            }

            # Areas Desenvolvimento
            if ($msg == '') {
                try {
                    $sql1 = "DELETE FROM RH_AREAS_DESENVOLVIMENTO ".$sql;
                    $stmt = $db->prepare($sql1);
                    $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                    $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                    $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                    $stmt->bindParam(':RHID_AVALIADO_', $rhid_avaliado_, PDO::PARAM_STR);
                    $stmt->execute();
                } catch (Exception $ex) {
                    $msg = "remove_avaliado#5 :" . $ex->getMessage();
                }
            }

        }
        
        # remover avaliadores da matriz de fases do avaliado
        if ($msg == '') {
            try {
                $sql = "DELETE FROM RH_AVALIADOR_FASES ".
                        "WHERE EMPRESA = :EMPRESA_ ".
                        "  AND ID_PA = :ID_PA_ ".
                        "  AND DT_INI_PA = :DT_INI_PA_ ".
                        "  AND ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                        "  AND DT_INI_PROCESSO = :DT_INI_PROCESSO_".
                        "  AND RHID_AVALIADO = :RHID_AVALIADO_ ";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_AVALIADO_', $rhid_avaliado_, PDO::PARAM_STR);
                
                $stmt->execute();
            } catch (Exception $ex) {
                $msg = "remove_avaliado#6 :" . $ex->getMessage();
            }
        }

        # remover avaliadores
        if ($msg == '') {
            try {
                $sql =  "DELETE FROM RH_AVALIADORES ".
                        "WHERE EMPRESA = :EMPRESA_ ".
                        "  AND ID_PA = :ID_PA_ ".
                        "  AND DT_INI_PA = :DT_INI_PA_ ".
                        "  AND ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                        "  AND DT_INI_PROCESSO = :DT_INI_PROCESSO_ ".
                        "  AND RHID_AVALIADO = :RHID_AVALIADO_ ";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_AVALIADO_', $rhid_avaliado_, PDO::PARAM_STR);
                $stmt->execute();
            } catch (Exception $ex) {
                $msg = "remove_avaliado#7 :" . $ex->getMessage();
            }
        }
        
        # remover avaliado
        if ($msg == '') {
            try {
                $sql = "DELETE FROM RH_AVALIADOS ".
                        "WHERE EMPRESA = :EMPRESA_ ".
                        "  AND ID_PA = :ID_PA_ ".
                        "  AND DT_INI_PA = :DT_INI_PA_ ".
                        "  AND ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                        "  AND DT_INI_PROCESSO = :DT_INI_PROCESSO_".
                        "  AND RHID = :RHID_AVALIADO_ ";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_AVALIADO_', $rhid_avaliado_, PDO::PARAM_STR);
                $stmt->execute();
                
            } catch (Exception $ex) {
                $msg = "remove_avaliados#8 :" . $ex->getMessage();
            }
        }
    }
    
    
    #
    # Troca Avaliador de uma fase
    function troca_avaliador($empresa_, $plano_, $dt_plano_, $processo_, $dt_processo_, $rhid_avaliado_, $rhid_old_avaliador_, $rhid_new_avaliador_, &$msg) {

        global $db, $error_invalid_oper_av_already_terminated, $error_invalid_operation;
        $msg = '';

        # determina o estado do processo
        if ($msg == '') {
	        try {
	            $sql =  "SELECT GE_AVALIACAO_TERMINADA(ID_PA,DT_INI_PA,ID_PROCESSO_AV,DT_INI_PROCESSO,RHID,DT_ADMISSAO,EMPRESA) ESTADO_PROC, ".
	                    "       GE_ESTADO_PROC_AVALIACAO(EMPRESA,ID_PA,DT_INI_PA,ID_PROCESSO_AV,DT_INI_PROCESSO) ESTADO_AVAL ".
	                    "FROM MASTER_AVALIACAO ".
	                    "WHERE EMPRESA = :EMPRESA_ ".
	                    "  AND ID_PA = :ID_PA_ ".
	                    "  AND DT_INI_PA = :DT_INI_PA_ ".
	                    "  AND ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
	                    "  AND DT_INI_PROCESSO = :DT_INI_PROCESSO_".
	                    "  AND RHID = :RHID_AVALIADO_ ";

	            $stmt = $db->prepare($sql);
	            $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
	            $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
	            $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
	            $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
	            $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
	            $stmt->bindParam(':RHID_AVALIADO_', $rhid_avaliado_, PDO::PARAM_STR);

	            $stmt->execute();
	            $row = $stmt->fetch(PDO::FETCH_ASSOC);
	            if ($row['ESTADO_PROC'] == 'C' || $row['ESTADO_AVAL'] == 'F' ) {
	                    $msg = $error_invalid_oper_av_already_terminated;
	            }
	        } catch (Exception $ex) {
	            $msg = "troca_avaliador#0.1 :" . $ex->getMessage();
	        }
        }

        if ($rhid_avaliado_ == $rhid_old_avaliador_ && $msg == '') {
		$msg = $error_invalid_operation;
        }

        # duplica registo de RH_AVALIADORES para o novo avaliador 
        if ($msg == '') {
            try {
                $sql =  "INSERT INTO RH_AVALIADORES ".
                        " (EMPRESA, ID_PA, DT_INI_PA, ID_PROCESSO_AV, DT_INI_PROCESSO, RHID_AVALIADO, DT_ADMISSAO, RHID_AVALIADOR, DT_INI_AVALIADOR,".
                        "  PERFIL_ASSOCIADO, AVAL_INTER, AVAL_FINAL, PERC_BONUS, AVAL_INTER_EQP, AVAL_FINAL_EQP, PERC_BONUS_EQP, ".
                        "  CONCORDANCIA, COMENTARIO, DT_FIM_AVALIADOR,FICHA,PONDERACAO) ".
                        "SELECT A.EMPRESA ".
                        "      ,A.ID_PA ".
                        "      ,A.DT_INI_PA ".
                        "      ,A.ID_PROCESSO_AV ".
                        "      ,A.DT_INI_PROCESSO ".
                        "      ,A.RHID_AVALIADO ".
                        "      ,A.DT_ADMISSAO ".
                        "      ,$rhid_new_avaliador_ RHID_AVALIADOR ".
                        "      ,A.DT_INI_AVALIADOR ".
                        "      ,A.PERFIL_ASSOCIADO ".
                        "      ,A.AVAL_INTER ".
                        "      ,A.AVAL_FINAL ".
                        "      ,A.PERC_BONUS ".
                        "      ,A.AVAL_INTER_EQP ".
                        "      ,A.AVAL_FINAL_EQP ".
                        "      ,A.PERC_BONUS_EQP ".
                        "      ,A.CONCORDANCIA ".
                        "      ,A.COMENTARIO ".
                        "      ,A.DT_FIM_AVALIADOR ".
                        "      ,A.FICHA ".
                        "      ,A.PONDERACAO ".
                        "FROM RH_AVALIADORES A ".
                        "WHERE EMPRESA = :EMPRESA_ ".
                        "  AND ID_PA = :ID_PA_ ".
                        "  AND DT_INI_PA = :DT_INI_PA_ ".
                        "  AND ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                        "  AND DT_INI_PROCESSO = :DT_INI_PROCESSO_".
                        "  AND RHID_AVALIADO = :RHID_AVALIADO_ ".
                        "  AND RHID_AVALIADOR = :RHID_AVALIADOR_ ";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_AVALIADO_', $rhid_avaliado_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_AVALIADOR_', $rhid_old_avaliador_, PDO::PARAM_STR);
                
                $stmt->execute();
            } catch (Exception $ex) {
                $msg = "troca_avaliador#1 :" . $ex->getMessage();
            }
        }

        # duplica registo de RH_AVALIADOR_FASES para o novo avaliador 
        if ($msg == '') {
            try {
                $sql =  "INSERT INTO RH_AVALIADOR_FASES ".
                        " (EMPRESA,ID_PA,DT_INI_PA,ID_PROCESSO_AV,DT_INI_PROCESSO,ID_FASE,DT_INI_FASE,DT_INI_FPA,RHID_AVALIADO,DT_ADMISSAO,RHID_AVALIADOR,DT_HR_AVALIADOR, ".
                        "  DT_INI_AF,DESCRICAO,DT_FIM_AF,PESO,ESTADO,TOT_COMPETENCIA,TOT_OBJECTIVO,NOTA_AVAL_FASE,OBS_HOMOLOGADOR,RHID_HOMOLOGADOR,DT_HR_HOMOLOGADOR) ".
                        "SELECT A.EMPRESA ".
                        "      ,A.ID_PA ".
                        "      ,A.DT_INI_PA ".
                        "      ,A.ID_PROCESSO_AV ".
                        "      ,A.DT_INI_PROCESSO ".
                        "      ,A.ID_FASE ".
                        "      ,A.DT_INI_FASE ".
                        "      ,A.DT_INI_FPA ".
                        "      ,A.RHID_AVALIADO ".
                        "      ,A.DT_ADMISSAO ".
                        "      ,$rhid_new_avaliador_ RHID_AVALIADOR ".
                        "      ,A.DT_HR_AVALIADOR ".
                        "      ,A.DT_INI_AF ".
                        "      ,A.DESCRICAO ".
                        "      ,A.DT_FIM_AF ".
                        "      ,A.PESO ".
                        "      ,A.ESTADO ".
                        "      ,A.TOT_COMPETENCIA ".
                        "      ,A.TOT_OBJECTIVO ".
                        "      ,A.NOTA_AVAL_FASE ".
                        "      ,A.OBS_HOMOLOGADOR ".
                        "      ,A.RHID_HOMOLOGADOR ".
                        "      ,A.DT_HR_HOMOLOGADOR ".
                        "FROM RH_AVALIADOR_FASES A ".
                        "WHERE EMPRESA = :EMPRESA_ ".
                        "  AND ID_PA = :ID_PA_ ".
                        "  AND DT_INI_PA = :DT_INI_PA_ ".
                        "  AND ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                        "  AND DT_INI_PROCESSO = :DT_INI_PROCESSO_".
                        "  AND RHID_AVALIADO = :RHID_AVALIADO_ ".
                        "  AND RHID_AVALIADOR = :RHID_AVALIADOR_ ";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_AVALIADO_', $rhid_avaliado_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_AVALIADOR_', $rhid_old_avaliador_, PDO::PARAM_STR);
                
                $stmt->execute();
            } catch (Exception $ex) {
                $msg = "troca_avaliador#2 :" . $ex->getMessage();
            }
        }
        
        # atualiza os registos de RH_ID_AVALIACAO_OBJECTIVOS para o novo avaliador
        if ($msg == '') {
            try {
                $sql =  "UPDATE RH_ID_AVALIACAO_OBJECTIVOS ".
                        "SET RHID_AVALIADOR = :RHID_AVALIADOR_NEW_ ".
                        "WHERE EMPRESA = :EMPRESA_ ".
                        "  AND ID_PA = :ID_PA_ ".
                        "  AND DT_INI_PA = :DT_INI_PA_ ".
                        "  AND ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                        "  AND DT_INI_PROCESSO = :DT_INI_PROCESSO_".
                        "  AND RHID_AVALIADO = :RHID_AVALIADO_ ".
                        "  AND RHID_AVALIADOR = :RHID_AVALIADOR_ ";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_AVALIADO_', $rhid_avaliado_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_AVALIADOR_', $rhid_old_avaliador_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_AVALIADOR_NEW_', $rhid_new_avaliador_, PDO::PARAM_STR);
                
                $stmt->execute();
            } catch (Exception $ex) {
                $msg = "troca_avaliador#3 :" . $ex->getMessage();
            }
        }
        
        # atualiza os registos de RH_FICHA_AVAL_COMPORTAMENTOS para o novo avaliador
        if ($msg == '') {
            try {
                $sql =  "UPDATE RH_FICHA_AVAL_COMPORTAMENTOS ".
                        "SET RHID_AVALIADOR = :RHID_AVALIADOR_NEW_ ".
                        "WHERE EMPRESA = :EMPRESA_ ".
                        "  AND ID_PA = :ID_PA_ ".
                        "  AND DT_INI_PA = :DT_INI_PA_ ".
                        "  AND ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                        "  AND DT_INI_PROCESSO = :DT_INI_PROCESSO_".
                        "  AND RHID_AVALIADO = :RHID_AVALIADO_ ".
                        "  AND RHID_AVALIADOR = :RHID_AVALIADOR_ ";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_AVALIADO_', $rhid_avaliado_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_AVALIADOR_', $rhid_old_avaliador_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_AVALIADOR_NEW_', $rhid_new_avaliador_, PDO::PARAM_STR);
                
                $stmt->execute();
            } catch (Exception $ex) {
                $msg = "troca_avaliador#4 :" . $ex->getMessage();
            }
        }
        
        # remove o registo de RH_AVALIADOR_FASES do avaliador antigo
        if ($msg == '') {
            try {
                $sql =  "DELETE FROM RH_AVALIADOR_FASES ".
                        "WHERE EMPRESA = :EMPRESA_ ".
                        "  AND ID_PA = :ID_PA_ ".
                        "  AND DT_INI_PA = :DT_INI_PA_ ".
                        "  AND ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                        "  AND DT_INI_PROCESSO = :DT_INI_PROCESSO_".
                        "  AND RHID_AVALIADO = :RHID_AVALIADO_ ".
                        "  AND RHID_AVALIADOR = :RHID_AVALIADOR_ ";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_AVALIADO_', $rhid_avaliado_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_AVALIADOR_', $rhid_old_avaliador_, PDO::PARAM_STR);
                
                $stmt->execute();
            } catch (Exception $ex) {
                $msg = "remove_avaliado#5 :" . $ex->getMessage();
            }
        }
        
        # remove o registo de RH_AVALIADORES do avaliador antigo
        if ($msg == '') {
            try {
                $sql =  "DELETE FROM RH_AVALIADORES ".
                        "WHERE EMPRESA = :EMPRESA_ ".
                        "  AND ID_PA = :ID_PA_ ".
                        "  AND DT_INI_PA = :DT_INI_PA_ ".
                        "  AND ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                        "  AND DT_INI_PROCESSO = :DT_INI_PROCESSO_".
                        "  AND RHID_AVALIADO = :RHID_AVALIADO_ ".
                        "  AND RHID_AVALIADOR = :RHID_AVALIADOR_ ";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_AVALIADO_', $rhid_avaliado_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_AVALIADOR_', $rhid_old_avaliador_, PDO::PARAM_STR);
                
                $stmt->execute();
            } catch (Exception $ex) {
                $msg = "remove_avaliado#6 :" . $ex->getMessage();
            }
        }

    }
    
    #
    # Atualiza estado de uma fase
    function actualiza_estado_fase($empresa_, $plano_, $dt_plano_, $processo_, $dt_processo_, $id_fase_, $dt_ini_fase_, $dt_ini_fpa_, 
                                   $rhid_avaliado_, $dt_adm_, $rhid_avaliador_, $estado_, &$msg) {

        global $db;
        $msg = '';

        if ($empresa_ != '' && $plano_ != '' && $dt_plano_ != '' && $processo_ != '' && $dt_processo_ != '' && 
            $id_fase_ != '' && $dt_ini_fase_ != '' && $dt_ini_fpa_ != '' && $rhid_avaliado_ != '' && $dt_adm_ != '' &&
            $rhid_avaliador_ != '' && $estado_ != '') {
            try {
                $sql =  "UPDATE RH_AVALIADOR_FASES ".
                        "SET ESTADO = :NEW_ESTADO_ ".
                        "WHERE EMPRESA = :EMPRESA_ ".
                        "  AND ID_PA = :ID_PA_ ".
                        "  AND DT_INI_PA = :DT_INI_PA_ ".
                        "  AND ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                        "  AND DT_INI_PROCESSO = :DT_INI_PROCESSO_".
                        "  AND ID_FASE = :ID_FASE_".
                        "  AND DT_INI_FASE = :DT_INI_FASE_".
                        "  AND DT_INI_FPA = :DT_INI_FPA_".
                        "  AND RHID_AVALIADO = :RHID_AVALIADO_ ".
                        "  AND DT_ADMISSAO = :DT_ADMISSAO_ ".
                        "  AND RHID_AVALIADOR = :RHID_AVALIADOR_ ";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_FASE_', $id_fase_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_FASE_', $dt_ini_fase_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_FPA_', $dt_ini_fpa_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_AVALIADO_', $rhid_avaliado_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_AVALIADOR_', $rhid_avaliador_, PDO::PARAM_STR);
                $stmt->bindParam(':NEW_ESTADO_', $estado_, PDO::PARAM_STR);

                $stmt->execute();
            } catch (Exception $ex) {
                $msg = "actualiza_estado_fase#1 :" . $ex->getMessage();
            }
        }
    }
    
    #
    # Publica resultados
    function publica_resultados($empresa_, $plano_, $dt_plano_, $processo_, $dt_processo_, &$msg) {

        global $db;
        $msg = '';

        try {
            $sql =  "SELECT COUNT(*) CNT ".
                    "FROM MASTER_AVALIACAO A".
                    "WHERE A.EMPRESA = :EMPRESA_ ".
                    "  AND A.ID_PA = :ID_PA_ ".
                    "  AND A.DT_INI_PA = :DT_INI_PA_ ".
                    "  AND A.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                    "  AND A.DT_INI_PROCESSO = :DT_INI_PROCESSO_".
                    "  AND A.ESTADO IN ('A','B') ";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row['CNT'] > 0 ) {
                $msg = "Existem ainda fichas de avaliação por submeter.";
            }
        } catch (Exception $ex) {
            $msg = "publica_resultados#1 :" . $ex->getMessage();
        }

        # publicar resultados
        if ($msg == '') {
            try {
                $sql =  "UPDATE RH_PROCESSOS_AVALIACAO ".
                        "SET RESULTADOS_PUB = 'S' ".
                        "WHERE EMPRESA = :EMPRESA_ ".
                        "  AND ID_PA = :ID_PA_ ".
                        "  AND DT_INI_PA = :DT_INI_PA_ ".
                        "  AND ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                        "  AND DT_INI_PROCESSO = :DT_INI_PROCESSO_";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                $stmt->execute();
            } catch (Exception $ex) {
                $msg = "publica_resultados#2 :" . $ex->getMessage();
            }
        }
    }

    #
    # Publica resultados
    function despublica_resultados($empresa_, $plano_, $dt_plano_, $processo_, $dt_processo_, &$msg) {

        global $db;
        $msg = '';

        # remoção de RH_COMPETENCIA_AVALIADAS
        if ($msg == '') {
            try {
                $sql =  "DELETE FROM RH_COMPETENCIA_AVALIADAS ".
                        "WHERE EMPRESA = :EMPRESA_ ".
                        "  AND ID_PA = :ID_PA_ ".
                        "  AND DT_INI_PA = :DT_INI_PA_ ".
                        "  AND ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                        "  AND DT_INI_PROCESSO = :DT_INI_PROCESSO_";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                $stmt->execute();
            } catch (Exception $ex) {
                $msg = "despublica_resultados#1 :" . $ex->getMessage();
            }
        }

        # remoção de RH_ACCOES_AVALIACAO
        if ($msg == '') {
            try {
                $sql =  "DELETE FROM RH_ACCOES_AVALIACAO ".
                        "WHERE EMPRESA = :EMPRESA_ ".
                        "  AND ID_PA = :ID_PA_ ".
                        "  AND DT_INI_PA = :DT_INI_PA_ ".
                        "  AND ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                        "  AND DT_INI_PROCESSO = :DT_INI_PROCESSO_";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                $stmt->execute();
            } catch (Exception $ex) {
                $msg = "despublica_resultados#2 :" . $ex->getMessage();
            }
        }

        # remoção de RH_AREAS_DESENVOLVIMENTO
        if ($msg == '') {
            try {
                $sql =  "DELETE FROM RH_AREAS_DESENVOLVIMENTO ".
                        "WHERE EMPRESA = :EMPRESA_ ".
                        "  AND ID_PA = :ID_PA_ ".
                        "  AND DT_INI_PA = :DT_INI_PA_ ".
                        "  AND ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                        "  AND DT_INI_PROCESSO = :DT_INI_PROCESSO_";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                $stmt->execute();
            } catch (Exception $ex) {
                $msg = "despublica_resultados#2 :" . $ex->getMessage();
            }
        }

        # "despublica" resultados
        if ($msg == '') {
            try {
                $sql =  "UPDATE RH_PROCESSOS_AVALIACAO ".
                        "SET RESULTADOS_PUB = 'N' ".
                        "WHERE EMPRESA = :EMPRESA_ ".
                        "  AND ID_PA = :ID_PA_ ".
                        "  AND DT_INI_PA = :DT_INI_PA_ ".
                        "  AND ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                        "  AND DT_INI_PROCESSO = :DT_INI_PROCESSO_";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                $stmt->execute();
            } catch (Exception $ex) {
                $msg = "despublica_resultados#2 :" . $ex->getMessage();
            }
        }
    }

    ##
    ## CÁLCULO DE FICHAS DE AVALIAÇÃO
    ##

    #
    # retorna peso de competência de grupo funcional
    function peso_compentencia_gf($empresa_, $id_gf_, $dt_gf_, $id_compent_, $dt_ini_compet_, &$msg) {
        global $db;
        $msg = '';
        $peso = '';

        try {
            $sql =  "SELECT A.PESO, A.ID_EP, A.DT_INI_EP, A.ID_NV_ESCALA, A.DT_INI_NV_ESCALA ".
                    "FROM RH_COMPETENCIAS_GRP_FUNCIONAIS A ".
                    "WHERE A.EMPRESA = :EMPRESA_ ".
                    "  AND A.ID_GRP_FUNC = :ID_GRP_FUNC_ ".
                    "  AND A.DT_INI_GRP_FUNC = :DT_INI_GRP_FUNC_ ".
                    "  AND A.ID_COMPETENCIA = :ID_COMPETENCIA_ ".
                    "  AND A.DT_INI_COMPETENCIA = :DT_INI_COMPETENCIA_ ".
                    "  AND A.DT_FIM IS NULL ".
                    "ORDER BY A.DT_INI desc ";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_GRP_FUNC_', $id_gf_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_GRP_FUNC_', $dt_gf_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_COMPETENCIA_', $id_compent_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_COMPETENCIA_', $dt_ini_compet_, PDO::PARAM_STR);

            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $peso = $row['PESO'];

        } catch (Exception $ex) {
            $msg = "peso_compentencia_gf#1 :" . $ex->getMessage();
        }
        return $peso;
    }

    #
    # retorna peso de um comportamento/objectivo numa ficha de avaliação
    function peso_fa($empresa_, $plano_, $dt_plano_, $processo_, $dt_processo_,
                     $rhid_avaliado_, $dt_adm_avaliado_, $rhid_avaliador_,
                     $id_fase_, $dt_ini_fase_, $dt_ini_fpa_, $dt_ini_af_,
                     $competencia_, $objetivo_, &$msg) {
        global $db;
        $msg = '';
        $peso = '';
        $nr_PD = 0;     # Nr. comportamentos p/Distribuir
        $nr_JD = 0;     # Nr. comportamentos já distribuídos
        $perc_JD = 0;   # Percentagem já distribuída

        if ($competencia_ != '') {

            # Comportamentos por Distribuir
            try {
                $sql =  "SELECT COUNT(A.SEQ_) NUM_COMPORTAMENTOS ".
                        "FROM RH_FICHA_AVAL_COMPORTAMENTOS A, RH_NIVEIS_ESCALA_PROFICIENCIA B ".
                        "WHERE A.EMPRESA = :EMPRESA_ ".
                        "  AND A.ID_PA = :ID_PA_ ".
                        "  AND A.DT_INI_PA = :DT_INI_PA_ ".
                        "  AND A.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                        "  AND A.DT_INI_PROCESSO = :DT_INI_PROCESSO_".
                        "  AND A.RHID_AVALIADO = :RHID_AVALIADO_ ".
                        "  AND A.DT_ADMISSAO = :DT_ADMISSAO_ ".
                        "  AND A.RHID_AVALIADOR = :RHID_AVALIADOR_ ".
                        "  AND A.ID_FASE = :ID_FASE_ ".
                        "  AND A.DT_INI_FASE = :DT_INI_FASE_ ".
                        "  AND A.DT_INI_FPA = :DT_INI_FPA_ ".
                        "  AND A.DT_INI_AF = :DT_INI_AF_ ".
                        "  AND A.ID_COMPETENCIA = :ID_COMPETENCIA_ ".
                        "  AND A.EMPRESA =  B.EMPRESA ".
                        "  AND A.ID_EP_NV_AF = B.ID_EP ".
                        "  AND A.DT_INI_EP_NV_AF = B.DT_INI_EP ".
                        "  AND A.ID_NV_AF = B.ID_NV_ESCALA ".
                        "  AND A.DT_INI_NV_AF = B.DT_INI_NV_ESCALA ".
                        "  AND B.EXCLUIR_CONTAGEM = 'N' ".
                        "  AND A.PESO_AF IS NULL ";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_AVALIADO_', $rhid_avaliado_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_avaliado_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_AVALIADOR_', $rhid_avaliador_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_FASE_', $id_fase_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_FASE_', $dt_ini_fase_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_FPA_', $dt_ini_fpa_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_AF_', $dt_ini_af_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_COMPETENCIA_', $competencia_, PDO::PARAM_STR);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $nr_PD = $row['NUM_COMPORTAMENTOS'];

            } catch (Exception $ex) {
                $msg = "peso_fa#1 :" . $ex->getMessage();
            }

            # Comportamentos já Distribuidos
            if ($msg == '') {
                try {
                    $sql =  "SELECT COUNT(A.SEQ_) NUM_COMPORTAMENTOS, NVL(SUM(A.PESO_AF),0) PESO ".
                            "FROM RH_FICHA_AVAL_COMPORTAMENTOS A, RH_NIVEIS_ESCALA_PROFICIENCIA B ".
                            "WHERE A.EMPRESA = :EMPRESA_ ".
                            "  AND A.ID_PA = :ID_PA_ ".
                            "  AND A.DT_INI_PA = :DT_INI_PA_ ".
                            "  AND A.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                            "  AND A.DT_INI_PROCESSO = :DT_INI_PROCESSO_".
                            "  AND A.RHID_AVALIADO = :RHID_AVALIADO_ ".
                            "  AND A.DT_ADMISSAO = :DT_ADMISSAO_ ".
                            "  AND A.RHID_AVALIADOR = :RHID_AVALIADOR_ ".
                            "  AND A.ID_FASE = :ID_FASE_ ".
                            "  AND A.DT_INI_FASE = :DT_INI_FASE_ ".
                            "  AND A.DT_INI_FPA = :DT_INI_FPA_ ".
                            "  AND A.DT_INI_AF = :DT_INI_AF_ ".
                            "  AND A.ID_COMPETENCIA = :ID_COMPETENCIA_ ".
                            "  AND A.EMPRESA =  B.EMPRESA ".
                            "  AND A.ID_EP_NV_AF = B.ID_EP ".
                            "  AND A.DT_INI_EP_NV_AF = B.DT_INI_EP ".
                            "  AND A.ID_NV_AF = B.ID_NV_ESCALA ".
                            "  AND A.DT_INI_NV_AF = B.DT_INI_NV_ESCALA ".
                            "  AND B.EXCLUIR_CONTAGEM = 'N' ".
                            "  AND A.PESO_AF IS NULL ";

                    $stmt = $db->prepare($sql);
                    $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                    $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                    $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                    $stmt->bindParam(':RHID_AVALIADO_', $rhid_avaliado_, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_avaliado_, PDO::PARAM_STR);
                    $stmt->bindParam(':RHID_AVALIADOR_', $rhid_avaliador_, PDO::PARAM_STR);
                    $stmt->bindParam(':ID_FASE_', $id_fase_, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_INI_FASE_', $dt_ini_fase_, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_INI_FPA_', $dt_ini_fpa_, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_INI_AF_', $dt_ini_af_, PDO::PARAM_STR);
                    $stmt->bindParam(':ID_COMPETENCIA_', $competencia_, PDO::PARAM_STR);
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $nr_JD = $row['NUM_COMPORTAMENTOS'];
                    $perc_JD = $row['PESO'];

                } catch (Exception $ex) {
                    $msg = "peso_fa#2 :" . $ex->getMessage();
                }
            }

            # determinação do peso
            if ($nr_PD != 0 && $nr_PD != '' && $msg == '') {
                $peso = round( (100 - $perc_JD) / $nr_PD, 2);
            } else {
                $peso = 0;
            }

        }
        elseif ($objetivo_ != '') {

            # Objetivo por Distribuir
            try {
                $sql =  "SELECT COUNT(A.SEQ_) NUM_OBJECTIVOS ".
                        "FROM RH_ID_AVALIACAO_OBJECTIVOS A,  RH_NIVEIS_ESCALA_PROFICIENCIA B ".
                        "WHERE A.EMPRESA = :EMPRESA_ ".
                        "  AND A.ID_PA = :ID_PA_ ".
                        "  AND A.DT_INI_PA = :DT_INI_PA_ ".
                        "  AND A.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                        "  AND A.DT_INI_PROCESSO = :DT_INI_PROCESSO_".
                        "  AND A.RHID_AVALIADO = :RHID_AVALIADO_ ".
                        "  AND A.DT_ADMISSAO = :DT_ADMISSAO_ ".
                        "  AND A.RHID_AVALIADOR = :RHID_AVALIADOR_ ".
                        "  AND A.ID_FASE = :ID_FASE_ ".
                        "  AND A.DT_INI_FASE = :DT_INI_FASE_ ".
                        "  AND A.DT_INI_FPA = :DT_INI_FPA_ ".
                        "  AND A.DT_INI_AF = :DT_INI_AF_ ".
                        "  AND A.EMPRESA =  B.EMPRESA ".
                        "  AND A.ID_EP_NV_AF = B.ID_EP ".
                        "  AND A.DT_INI_EP_NV_AF = B.DT_INI_EP ".
                        "  AND A.ID_NV_AF = B.ID_NV_ESCALA ".
                        "  AND A.DT_INI_NV_AF = B.DT_INI_NV_ESCALA ".
                        "  AND B.EXCLUIR_CONTAGEM = 'N' ".
                        "  AND A.PESO_AF IS NULL ";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_AVALIADO_', $rhid_avaliado_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_avaliado_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_AVALIADOR_', $rhid_avaliador_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_FASE_', $id_fase_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_FASE_', $dt_ini_fase_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_FPA_', $dt_ini_fpa_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_AF_', $dt_ini_af_, PDO::PARAM_STR);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $nr_PD = $row['NUM_OBJECTIVOS'];

            } catch (Exception $ex) {
                $msg = "peso_fa#3 :" . $ex->getMessage();
            }

            # Objetivos já Distribuidos
            if ($msg == '') {
                try {
                    $sql =  "SELECT COUNT(A.SEQ_) NUM_OBJECTIVOS, NVL(SUM(A.PESO_AF),0) PESO ".
                            "FROM RH_ID_AVALIACAO_OBJECTIVOS A, RH_NIVEIS_ESCALA_PROFICIENCIA B ".
                            "WHERE A.EMPRESA = :EMPRESA_ ".
                            "  AND A.ID_PA = :ID_PA_ ".
                            "  AND A.DT_INI_PA = :DT_INI_PA_ ".
                            "  AND A.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                            "  AND A.DT_INI_PROCESSO = :DT_INI_PROCESSO_".
                            "  AND A.RHID_AVALIADO = :RHID_AVALIADO_ ".
                            "  AND A.DT_ADMISSAO = :DT_ADMISSAO_ ".
                            "  AND A.RHID_AVALIADOR = :RHID_AVALIADOR_ ".
                            "  AND A.ID_FASE = :ID_FASE_ ".
                            "  AND A.DT_INI_FASE = :DT_INI_FASE_ ".
                            "  AND A.DT_INI_FPA = :DT_INI_FPA_ ".
                            "  AND A.DT_INI_AF = :DT_INI_AF_ ".
                            "  AND A.EMPRESA =  B.EMPRESA ".
                            "  AND A.ID_EP_NV_AF = B.ID_EP ".
                            "  AND A.DT_INI_EP_NV_AF = B.DT_INI_EP ".
                            "  AND A.ID_NV_AF = B.ID_NV_ESCALA ".
                            "  AND A.DT_INI_NV_AF = B.DT_INI_NV_ESCALA ".
                            "  AND B.EXCLUIR_CONTAGEM = 'N' ".
                            "  AND A.PESO_AF IS NULL ".
                            "GROUP BY A.ID_COMPETENCIA; ".

                    $stmt = $db->prepare($sql);
                    $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                    $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                    $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                    $stmt->bindParam(':RHID_AVALIADO_', $rhid_avaliado_, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_avaliado_, PDO::PARAM_STR);
                    $stmt->bindParam(':RHID_AVALIADOR_', $rhid_avaliador_, PDO::PARAM_STR);
                    $stmt->bindParam(':ID_FASE_', $id_fase_, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_INI_FASE_', $dt_ini_fase_, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_INI_FPA_', $dt_ini_fpa_, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_INI_AF_', $dt_ini_af_, PDO::PARAM_STR);
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $nr_JD = $row['NUM_OBJECTIVOS'];
                    $perc_JD = $row['PESO'];

                } catch (Exception $ex) {
                    $msg = "peso_fa#4 :" . $ex->getMessage();
                }
            }

            # determinação do peso
            if ($nr_PD != 0 && $nr_PD != '' && $msg == '') {
                $peso = round( (100 - $perc_JD) / $nr_PD, 2);
            } else {
                $peso = 0;
            }

        }
        return $peso;
    }

    #
    # Calcula uma Ficha de Avaliação
    #  $tp_avaliacao_: F - Final, I - Intermédia,
    function calculo_ficha_avaliacao($empresa_, $plano_, $dt_plano_, $processo_, $dt_processo_,
                                    $rhid_avaliado_, $dt_adm_avaliado_, $rhid_avaliador_,
                                    $id_fase_, $dt_ini_fase_, $dt_ini_fpa_, $dt_ini_af_,
                                    $tp_avaliacao_, &$msg) {
        global $db;
        $msg = '';
        if ($tp_avaliacao_ == '') {
            $tp_avaliacao_ = 'F';
        }
        $tot_perg_C = 0;
        $tot_resp_C = 0;
        $tot_perg_O = 0;
        $tot_resp_O = 0;
        $nota_ = 0;
        $nota_req_ = 0;
        $peso_ = 0;
        $perc_ = 0;
        $txt = '';
        $t_competencias = 0;
        $t_objetivos = 0;

        # Competências
        try {
            $sqlC = "SELECT A.EMPRESA, A.ID_PA, A.DT_INI_PA, A.ID_PROCESSO_AV, A.DT_INI_PROCESSO, A.RHID_AVALIADO, A.DT_ADMISSAO, A.RHID_AVALIADOR, A.ID_FASE, A.DT_INI_FASE, ".
                    "	    A.DT_INI_FPA, A.DT_INI_AF, A.SEQ_, A.PESO_AF, A.NOTA_AF, A.PERC_AF, A.PESO_AI, A.NOTA_AI, A.PERC_AI, A.COMENTARIO, A.DESCRICAO, A.ID_EP_NV_AF, ".
                    "	    A.DT_INI_NV_AF, A.ID_NV_AF, A.DT_INI_EP_NV_AF, A.ID_EP_AI, A.DT_INI_EP_AI,A.ID_NV_ESCALA_AI, A.DT_INI_NV_AI, A.ID_EP_REQ, A.DT_INI_EP_REQ, ".
                    "	    A.ID_NV_ESCALA_REQ, A.DT_INI_NV_REQ, A.ID_COMPETENCIA, A.DT_INI_COMPETENCIA,A.ID_COMPORTAMENTO, A.DT_INI_COMPORTAMENTO, A.ID_GRP_FUNC, ".
                    "	    A.DT_INI_GRP_FUNC, A.DT_INI_CGF, A.ID_FUNCAO, A.TP_REGISTO, A.DT_INI_FUNCAO, A.DT_INI_COF, A.CD_ESTRUTURA, A.DT_INI_ESTRUTURA, A.DT_INI_CC_ESTRUT, A.DT_INI_CC, A.DT_INI_CC, ".
                    "	    B.PESO PESO_ATRIB_NEP_1, B.ID_NV_ESCALA PESO_ATRIB_NEP_2, B.EXCLUIR_CONTAGEM, B1.PESO PESO_REQ_NEP_1, B1.ID_NV_ESCALA PESO_REQ_NEP_2 ".
                    "FROM   RH_FICHA_AVAL_COMPORTAMENTOS A ".
                    "LEFT JOIN RH_NIVEIS_ESCALA_PROFICIENCIA B  ON B.EMPRESA = A.EMPRESA AND B.ID_EP = A.ID_EP_NV_AF AND B.DT_INI_EP = A.DT_INI_EP_NV_AF AND B.ID_NV_ESCALA = A.ID_NV_AF AND B.DT_INI_NV_ESCALA = A.DT_INI_NV_AF AND B.EXCLUIR_CONTAGEM = 'N' ".
                    "LEFT JOIN RH_NIVEIS_ESCALA_PROFICIENCIA B1 ON B1.EMPRESA = A.EMPRESA AND B1.ID_EP = A.ID_EP_REQ AND B1.DT_INI_EP = A.DT_INI_EP_REQ AND B1.ID_NV_ESCALA = A.ID_NV_ESCALA_REQ AND B1.DT_INI_NV_ESCALA = A.DT_INI_NV_REQ AND B1.EXCLUIR_CONTAGEM = 'N' ".
                    "WHERE A.EMPRESA = :EMPRESA_ ".
                    "  AND A.ID_PA = :ID_PA_ ".
                    "  AND A.DT_INI_PA = :DT_INI_PA_ ".
                    "  AND A.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                    "  AND A.DT_INI_PROCESSO = :DT_INI_PROCESSO_".
                    "  AND A.RHID_AVALIADO = :RHID_AVALIADO_ ".
                    "  AND A.DT_ADMISSAO = :DT_ADMISSAO_ ".
                    "  AND A.RHID_AVALIADOR = :RHID_AVALIADOR_ ".
                    "  AND A.ID_FASE = :ID_FASE_ ".
                    "  AND A.DT_INI_FASE = :DT_INI_FASE_ ".
                    "  AND A.DT_INI_FPA = :DT_INI_FPA_ ".
                    "  AND A.DT_INI_AF = :DT_INI_AF_ ";

            $stmt = $db->prepare($sqlC);
            $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
            $stmt->bindParam(':RHID_AVALIADO_', $rhid_avaliado_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_avaliado_, PDO::PARAM_STR);
            $stmt->bindParam(':RHID_AVALIADOR_', $rhid_avaliador_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_FASE_', $id_fase_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_FASE_', $dt_ini_fase_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_FPA_', $dt_ini_fpa_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_AF_', $dt_ini_af_, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $ex) {
            $msg = "calculo_ficha_avaliacao#1 :" . $ex->getMessage();
        }
        if ($msg == '') {
            try {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    if ($tp_avaliacao_ == 'F') { # avaliação final
                        if ($row['ID_NV_AF'] != '') {
                            $tot_resp_C += 1;
                        }
                        $tot_perg_C += 1;
                    } elseif ($tp_avaliacao_ == 'I') { # avaliação intermédia
                        if ($row['ID_NV_ESCALA_AI'] != '') {
                            $tot_resp_C += 1;
                        }
                        $tot_perg_C += 1;
                    }
                }
            } catch (Exception $ex) {
                $msg = "calculo_ficha_avaliacao#2 :" . $ex->getMessage();
            }
        }

        # Objetivos
        if ($msg == '') {
            try {
                $sqlO = "SELECT A.EMPRESA, A.ID_PA, A.DT_INI_PA, A.ID_PROCESSO_AV, A.DT_INI_PROCESSO, A.RHID_AVALIADO, A.DT_ADMISSAO, A.RHID_AVALIADOR, A.ID_FASE, A.DT_INI_FASE, ".
                        "	    A.DT_INI_FPA, A.DT_INI_AF, A.SEQ_, A.PESO_AF, A.NOTA_AF, A.PERC_AF, A.PESO_AI, A.NOTA_AI, A.PERC_AI, A.ID_MAGNITUDE, A.DT_INI_DM, A.ID_EP_REQ, ".
                        "	    A.DT_INI_EP_REQ, A.ID_NV_ESCALA_REQ, A.DT_INI_NV_ESCALA_REQ, A.ID_EP_AI, A.DT_INI_EP_AI, A.ID_NV_ESCALA_AI, A.DT_INI_NV_ESCALA_AI, A.ID_EP_AF, ".
                        "	    A.DT_INI_EP_AF, A.ID_NV_ESCALA_AF, A.DT_INI_NV_ESCALA_AF, A.CD_ESTRUTURA, A.DT_INI_OE, A.ID_FUNCAO, A.TP_REGISTO, A.DT_INI_FUNCAO, A.DT_INI_OF, ".
                        "	    A.ID_GRP_FUNC, A.DT_INI_GRP_FUNC, A.ID_OBJECTIVO, A.DT_INI_OBJECTIVO, A.DT_INI_OGF, A.DT_INI_OI, A.VLR_REQUERIDO, A.AVALIADO_CONCORDA, ".
                        "	    A.COMENT_AVALIADO, A.DESCRICAO, A.VLR_ATRIBUIDO, B.PESO PESO_ATRIB_NEP_1, B.ID_NV_ESCALA PESO_ATRIB_NEP_2, B.EXCLUIR_CONTAGEM, ".
                        "	    B1.PESO PESO_REQ_NEP_1, B1.ID_NV_ESCALA PESO_REQ_NEP_2 ".
                        "FROM RH_ID_AVALIACAO_OBJECTIVOS A ".
                        "LEFT JOIN RH_NIVEIS_ESCALA_PROFICIENCIA B ON B.EMPRESA = A.EMPRESA AND B.ID_EP = A.ID_EP_AF AND B.DT_INI_EP = A.DT_INI_EP_AF AND B.ID_NV_ESCALA = A.ID_NV_ESCALA_AF AND B.DT_INI_NV_ESCALA = A.DT_INI_NV_ESCALA_AF AND B.EXCLUIR_CONTAGEM = 'N' ".
                        "LEFT JOIN RH_NIVEIS_ESCALA_PROFICIENCIA B1 ON B1.EMPRESA = A.EMPRESA AND B1.ID_EP = A.ID_EP_REQ AND B1.DT_INI_EP = A.DT_INI_EP_REQ AND B1.ID_NV_ESCALA = A.ID_NV_ESCALA_REQ AND B1.DT_INI_NV_ESCALA = A.DT_INI_NV_ESCALA_AF AND B1.EXCLUIR_CONTAGEM = 'N' ".
                        "WHERE A.EMPRESA = :EMPRESA_ ".
                        "  AND A.ID_PA = :ID_PA_ ".
                        "  AND A.DT_INI_PA = :DT_INI_PA_ ".
                        "  AND A.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                        "  AND A.DT_INI_PROCESSO = :DT_INI_PROCESSO_".
                        "  AND A.RHID_AVALIADO = :RHID_AVALIADO_ ".
                        "  AND A.DT_ADMISSAO = :DT_ADMISSAO_ ".
                        "  AND A.RHID_AVALIADOR = :RHID_AVALIADOR_ ".
                        "  AND A.ID_FASE = :ID_FASE_ ".
                        "  AND A.DT_INI_FASE = :DT_INI_FASE_ ".
                        "  AND A.DT_INI_FPA = :DT_INI_FPA_ ".
                        "  AND A.DT_INI_AF = :DT_INI_AF_ ";

                $stmt = $db->prepare($sqlO);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_AVALIADO_', $rhid_avaliado_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_avaliado_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_AVALIADOR_', $rhid_avaliador_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_FASE_', $id_fase_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_FASE_', $dt_ini_fase_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_FPA_', $dt_ini_fpa_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_AF_', $dt_ini_af_, PDO::PARAM_STR);
                $stmt->execute();
            } catch (Exception $ex) {
                $msg = "calculo_ficha_avaliacao#3 :" . $ex->getMessage();
            }

            if ($msg == '') {
                try {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        if ($tp_avaliacao_ == 'F') { # avaliação final
                            if ($row['ID_NV_ESCALA_AF'] != '' || $row[''] != 'VLR_ATRIBUIDO') {
                                $tot_resp_O += 1;
                            }
                            $tot_perg_O += 1;
                        } elseif ($tp_avaliacao_ == 'I') { # avaliação intermédia
                            if ($row['ID_NV_ESCALA_AI'] != '' || $row[''] != 'VLR_ATRIBUIDO') {
                                $tot_resp_O += 1;
                            }
                            $tot_perg_O += 1;
                        }
                    }
                } catch (Exception $ex) {
                    $msg = "calculo_ficha_avaliacao#4 :" . $ex->getMessage();
                }
            }

        }

        # validações
        if ($msg == '') {
            # Avaliação aos comportamentos INCOMPLETA
            if ($tot_perg_C > 0 && $tot_perg_C != $tot_resp_C) {
                if (($tot_perg_C - $tot_resp_C) == 1) {
                    $txt = "Falta avaliar 1 Comportamento ";
                } else {
                    $txt = "Falta avaliar ".($tot_perg_C - $tot_resp_C)." Comportamentos ";
                }
            }
            # Avaliação aos objectivos INCOMPLETA
            if ($tot_perg_O > 0 && $tot_perg_O != $tot_resp_O) {
                if ($txt == '') {
                    if (($tot_perg_O - $tot_resp_O) == 1) {
                        $txt = "Falta avaliar 1 Objetivo";
                    } else {
                        $txt = "Falta avaliar ".($tot_perg_O - $tot_resp_O)." Objetivos ";
                    }
                } else {
                    if (($tot_perg_O - $tot_resp_O) == 1) {
                        $txt .= " e 1 Objetivo";
                    } else {
                        $txt = "e ".($tot_perg_O - $tot_resp_O)." Objetivos ";
                    }
                }
            }
            $msg = $txt;
        }

        # FASE 1: Determinação dos cálculos da linha do COMPORTAMENTO
        if ($msg == '') {
            # percorre todas os comportamentos
            try {
                $stmt = $db->prepare($sqlC);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_AVALIADO_', $rhid_avaliado_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_avaliado_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_AVALIADOR_', $rhid_avaliador_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_FASE_', $id_fase_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_FASE_', $dt_ini_fase_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_FPA_', $dt_ini_fpa_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_AF_', $dt_ini_af_, PDO::PARAM_STR);
                $stmt->execute();
            } catch (Exception $ex) {
                $msg = "calculo_ficha_avaliacao#4 :" . $ex->getMessage();
            }
            if ($msg == '') {
                try {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                        if ($row['EXCLUIR_CONTAGEM'] == 'N') {

                            if ($row['PESO_ATRIB_NEP_1'] != '') {
                                ## Peso da Nota atribuída indicado no Nível de proficiência
                                $nota_ = $row['PESO_ATRIB_NEP_1'];
                                ## Peso da Nota requerida indicado no Nível de proficiência
                                $nota_req_ = $row['PESO_REQ_NEP_1'];
                            } else {
                                ## Peso da Nota atribuída NÃO indicada no Nível de proficiência, então Nível_Req = 100.
                                ## Assim (regra de 3 simples) : NOTA_AVALIADA = Nível_Avaliado * 100 / Nível_Requerido
                                $nota_ = ($row['PESO_ATRIB_NEP_2'] * 100) / $row['PESO_REQ_NEP_2'];
                                $nota_req_ = 100;
                            }

                            ## Peso do Comportamento
                            if ($row['PESO_AF'] == '') {
				$peso_ = peso_fa($empresa_, $plano_, $dt_plano_, $processo_, $dt_processo_,
                                                 $rhid_avaliado_, $dt_adm_avaliado_, $rhid_avaliador_,
                                                 $id_fase_, $dt_ini_fase_, $dt_ini_fpa_, $dt_ini_af_,
                                                 $row['ID_COMPETENCIA'], '', $msg);
                            ## Peso do comportamento na Competência
                            } else {
                                $peso_ = $row['PESO_AF'];
                            }

                            ## PERCENTAGEM do COMPORTAMENTO NA COMPETÊNCIA
                            $perc_ = round ($nota_ * $peso_, 2);

                            if ($msg == '') {
                                ## atualiza a nota do comportamento
                                try {
                                    $sql = "UPDATE RH_FICHA_AVAL_COMPORTAMENTOS A ".
                                           "SET A.NOTA_AF = :NOTA_, A.PESO_AF = :PESO_, A.PERC_AF = :PERC_, A.NOTA_REQ = :NOTA_REQ_ ".
                                           "WHERE A.SEQ_ = :SEQ_ ";

                                    $stmt1 = $db->prepare($sql);
                                    $stmt1->bindParam(':NOTA_', $nota_, PDO::PARAM_STR);
                                    $stmt1->bindParam(':PESO_', $peso_, PDO::PARAM_STR);
                                    $stmt1->bindParam(':PERC_', $perc_, PDO::PARAM_STR);
                                    $stmt1->bindParam(':NOTA_REQ_', $nota_req_, PDO::PARAM_STR);
                                    $stmt1->bindParam(':SEQ_', $row['SEQ_'], PDO::PARAM_STR);
                                    $stmt1->execute();
                                } catch (Exception $ex) {
                                    $msg = "calculo_ficha_avaliacao#5 :" . $ex->getMessage();
                                }
                            }
                        }

                    }
                } catch (Exception $ex) {
                    $msg = "calculo_ficha_avaliacao#6 :" . $ex->getMessage();
                }
            }
        }

        # FASE 2: Determinação dos cálculos da linha do COMPORTAMENTO
        if ($msg == '') {
            # percorre todas os objetivos
            try {
                $stmt = $db->prepare($sqlO);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_AVALIADO_', $rhid_avaliado_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_avaliado_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_AVALIADOR_', $rhid_avaliador_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_FASE_', $id_fase_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_FASE_', $dt_ini_fase_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_FPA_', $dt_ini_fpa_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_AF_', $dt_ini_af_, PDO::PARAM_STR);
                $stmt->execute();
            } catch (Exception $ex) {
                $msg = "calculo_ficha_avaliacao#7 :" . $ex->getMessage();
            }
            if ($msg == '') {
                try {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                        if ($row['EXCLUIR_CONTAGEM'] == 'N') {

                            if ($row['VLR_ATRIBUIDO'] != '') {

                                if ($row['PESO_ATRIB_NEP_1'] != '') {
                                    ## Peso da Nota atribuída indicado no Nível de proficiência
                                    $nota_ = $row['PESO_ATRIB_NEP_1'];
                                    ## Peso da Nota requerida indicado no Nível de proficiência
                                    $nota_req_ = $row['PESO_REQ_NEP_1'];
                                } else {
                                    ## Peso da Nota atribuída NÃO indicada no Nível de proficiência, então Nível_Req = 100.
                                    ## Assim (regra de 3 simples) : NOTA_AVALIADA = Nível_Avaliado * 100 / Nível_Requerido
                                    $nota_ = ($row['PESO_ATRIB_NEP_2'] * 100) / $row['PESO_REQ_NEP_2'];
                                    $nota_req_ = 100;
                                }

                                ## Peso do Objetivo
                                if ($row['PESO_AF'] == '') {
                                    $peso_ = peso_fa($empresa_, $plano_, $dt_plano_, $processo_, $dt_processo_,
                                                     $rhid_avaliado_, $dt_adm_avaliado_, $rhid_avaliador_,
                                                     $id_fase_, $dt_ini_fase_, $dt_ini_fpa_, $dt_ini_af_,
                                                     '', $row['ID_OBJECTIVO'], $msg);
                                ## Peso do comportamento na Competência
                                } else {
                                    $peso_ = $row['PESO_AF'];
                                }

                                ## PERCENTAGEM do COMPORTAMENTO NA COMPETÊNCIA
                                $perc_ = round ($nota_ * $peso_, 2);

                                if ($msg == '') {
                                    ## atualiza a nota do comportamento
                                    try {
                                        $sql = "UPDATE RH_ID_AVALIACAO_OBJECTIVOS A ".
                                               "SET A.NOTA_AF = :NOTA_, A.PESO_AF = :PESO_, A.PERC_AF = :PERC_, A.NOTA_REQ = :NOTA_REQ_ ".
                                               "WHERE A.SEQ_ = :SEQ_ ";

                                        $stmt1 = $db->prepare($sql);
                                        $stmt1->bindParam(':NOTA_', $nota_, PDO::PARAM_STR);
                                        $stmt1->bindParam(':PESO_', $peso_, PDO::PARAM_STR);
                                        $stmt1->bindParam(':PERC_', $perc_, PDO::PARAM_STR);
                                        $stmt1->bindParam(':NOTA_REQ_', $nota_req_, PDO::PARAM_STR);
                                        $stmt1->bindParam(':SEQ_', $row['SEQ_'], PDO::PARAM_STR);
                                        $stmt1->execute();
                                    } catch (Exception $ex) {
                                        $msg = "calculo_ficha_avaliacao#8 :" . $ex->getMessage();
                                    }
                                }

                            ## Objectivo QUANTITATIVO (NÃO usa Escala/Nível)
                            } else {
                                $nota_ = round(($row['VLR_ATRIBUIDO'] * 100) / $row['VLR_REQUERIDO'],2);

                                ## Peso do Objetivo
                                if ($row['PESO_AF'] == '') {
                                    $peso_ = peso_fa($empresa_, $plano_, $dt_plano_, $processo_, $dt_processo_,
                                                     $rhid_avaliado_, $dt_adm_avaliado_, $rhid_avaliador_,
                                                     $id_fase_, $dt_ini_fase_, $dt_ini_fpa_, $dt_ini_af_,
                                                     '', $row['ID_OBJECTIVO'], $msg);
                                ## Peso do comportamento na Competência
                                } else {
                                    $peso_ = $row['PESO_AF'];
                                }

                                ## PERCENTAGEM do COMPORTAMENTO NA COMPETÊNCIA
                                $perc_ = round ($nota_ * $peso_, 2);

                                if ($msg == '') {
                                    ## atualiza a nota do comportamento
                                    try {
                                        $sql = "UPDATE RH_ID_AVALIACAO_OBJECTIVOS A ".
                                               "SET A.NOTA_AF = :NOTA_, A.PESO_AF = :PESO_, A.PERC_AF = :PERC_ ".
                                               "WHERE A.SEQ_ = :SEQ_ ";

                                        $stmt1 = $db->prepare($sql);
                                        $stmt1->bindParam(':NOTA_', $nota_, PDO::PARAM_STR);
                                        $stmt1->bindParam(':PESO_', $peso_, PDO::PARAM_STR);
                                        $stmt1->bindParam(':PERC_', $perc_, PDO::PARAM_STR);
                                        $stmt1->bindParam(':SEQ_', $row['SEQ_'], PDO::PARAM_STR);
                                        $stmt1->execute();
                                    } catch (Exception $ex) {
                                        $msg = "calculo_ficha_avaliacao#9 :" . $ex->getMessage();
                                    }
                                }
                            }
                        }
                    }
                } catch (Exception $ex) {
                    $msg = "calculo_ficha_avaliacao#10 :" . $ex->getMessage();
                }
            }
        }

        # CÁLCULOS FINAIS
        $t_competencias = 0;
        $t_objetivos = 0;
        $t_nota = 0;

        if ($msg == '') {
            try {
                $sql  = "SELECT NVL(SUM(A.PERC_COMPETENCIA),0) TOT_COMPETENCIA ".
                        "FROM RH_RESUME_COMPETENCIAS_FA A ".
                        "WHERE A.EMPRESA = :EMPRESA_ ".
                        "  AND A.ID_PA = :ID_PA_ ".
                        "  AND A.DT_INI_PA = :DT_INI_PA_ ".
                        "  AND A.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                        "  AND A.DT_INI_PROCESSO = :DT_INI_PROCESSO_".
                        "  AND A.RHID_AVALIADO = :RHID_AVALIADO_ ".
                        "  AND A.DT_ADMISSAO = :DT_ADMISSAO_ ".
                        "  AND A.RHID_AVALIADOR = :RHID_AVALIADOR_ ".
                        "  AND A.ID_FASE = :ID_FASE_ ".
                        "  AND A.DT_INI_FASE = :DT_INI_FASE_ ".
                        "  AND A.DT_INI_FPA = :DT_INI_FPA_ ".
                        "  AND A.DT_INI_AF = :DT_INI_AF_ ";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_AVALIADO_', $rhid_avaliado_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_avaliado_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_AVALIADOR_', $rhid_avaliador_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_FASE_', $id_fase_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_FASE_', $dt_ini_fase_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_FPA_', $dt_ini_fpa_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_AF_', $dt_ini_af_, PDO::PARAM_STR);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $t_competencias = $row['TOT_COMPETENCIA'];
            } catch (Exception $ex) {
                $msg = "calculo_ficha_avaliacao#11 :" . $ex->getMessage();
            }
        }
        if ($msg == '') {
            try {
                $sql  = "SELECT NVL(SUM(A.PERC_OBJECTIVO),0) TOT_OBJECTIVO ".
                        "FROM RH_RESUME_OBJECTIVOS_FA A ".
                        "WHERE A.EMPRESA = :EMPRESA_ ".
                        "  AND A.ID_PA = :ID_PA_ ".
                        "  AND A.DT_INI_PA = :DT_INI_PA_ ".
                        "  AND A.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                        "  AND A.DT_INI_PROCESSO = :DT_INI_PROCESSO_".
                        "  AND A.RHID_AVALIADO = :RHID_AVALIADO_ ".
                        "  AND A.DT_ADMISSAO = :DT_ADMISSAO_ ".
                        "  AND A.RHID_AVALIADOR = :RHID_AVALIADOR_ ".
                        "  AND A.ID_FASE = :ID_FASE_ ".
                        "  AND A.DT_INI_FASE = :DT_INI_FASE_ ".
                        "  AND A.DT_INI_FPA = :DT_INI_FPA_ ".
                        "  AND A.DT_INI_AF = :DT_INI_AF_ ";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_AVALIADO_', $rhid_avaliado_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_avaliado_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_AVALIADOR_', $rhid_avaliador_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_FASE_', $id_fase_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_FASE_', $dt_ini_fase_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_FPA_', $dt_ini_fpa_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_AF_', $dt_ini_af_, PDO::PARAM_STR);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $t_objetivos = $row['TOT_OBJECTIVO'];
            } catch (Exception $ex) {
                $msg = "calculo_ficha_avaliacao#12 :" . $ex->getMessage();
            }
        }

        # Repartição dos PESO nas avaliações de COMPENTÊNCIAS e OBJECTIVOS
	if ($msg == '') {
            if ($t_competencias == '') {
                $t_competencias = 0;
            }
            if ($t_objetivos == '') {
                $t_objetivos = 0;
            }
            try {
                $sql  = "SELECT NVL(A.AVAL_COMPETENCIAS,'N') COMPT, NVL(A.AVAL_OBJECTIVOS,'N') OBJ_, ".
                        "       NVL(A.PESO_AC/100,0.5) PESO_AC, NVL(A.PESO_AO/100,0.5) PESO_AO ".
                        "FROM RH_PROCESSOS_AVALIACAO A ".
                        "WHERE A.EMPRESA = :EMPRESA_ ".
                        "  AND A.ID_PA = :ID_PA_ ".
                        "  AND A.DT_INI_PA = :DT_INI_PA_ ".
                        "  AND A.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                        "  AND A.DT_INI_PROCESSO = :DT_INI_PROCESSO_";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    if ($row['COMPT'] == 'S' && $row['OBJ_'] == 'S') {
                        $t_nota = round( ( $t_competencias * $row['PESO_AC'] ) + ( $t_objetivos * $row['PESO_AO'] ),2);
                    }
                    elseif ($row['COMPT'] == 'S' && $row['OBJ_'] == 'N') {
			$t_nota = $t_competencias;
		    }
                    elseif ($row['COMPT'] == 'N' && $row['OBJ_'] == 'S') {
			$t_nota = $t_objetivos;
                    }
                }
            } catch (Exception $ex) {
                $msg = "calculo_ficha_avaliacao#13 :" . $ex->getMessage();
            }
        }

        # Atualiza a nota da ficha de avaliação
	if ($msg == '') {
            $estado_ = 'C';
            $t_competencias = round($t_competencias,2);
            $t_objetivos = round($t_objetivos,2);
            $t_nota = round($t_nota,2);
            try {
                $sql =  "UPDATE RH_AVALIADOR_FASES A ".
                        "SET A.TOT_COMPETENCIA = :TOT_COMPETENCIA_, A.TOT_OBJECTIVO = :TOT_OBJECTIVO_, A.NOTA_AVAL_FASE = :NOTA_AVAL_FASE_, A.ESTADO = :ESTADO_ ".
                        "WHERE A.EMPRESA = :EMPRESA_ ".
                        "  AND A.ID_PA = :ID_PA_ ".
                        "  AND A.DT_INI_PA = :DT_INI_PA_ ".
                        "  AND A.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                        "  AND A.DT_INI_PROCESSO = :DT_INI_PROCESSO_".
                        "  AND A.RHID_AVALIADO = :RHID_AVALIADO_ ".
                        "  AND A.DT_ADMISSAO = :DT_ADMISSAO_ ".
                        "  AND A.RHID_AVALIADOR = :RHID_AVALIADOR_ ".
                        "  AND A.ID_FASE = :ID_FASE_ ".
                        "  AND A.DT_INI_FASE = :DT_INI_FASE_ ".
                        "  AND A.DT_INI_FPA = :DT_INI_FPA_ ".
                        "  AND A.DT_INI_AF = :DT_INI_AF_ ";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_AVALIADO_', $rhid_avaliado_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_avaliado_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_AVALIADOR_', $rhid_avaliador_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_FASE_', $id_fase_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_FASE_', $dt_ini_fase_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_FPA_', $dt_ini_fpa_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_AF_', $dt_ini_af_, PDO::PARAM_STR);
                $stmt->bindParam(':TOT_COMPETENCIA_', $t_competencias, PDO::PARAM_STR);
                $stmt->bindParam(':TOT_OBJECTIVO_', $t_objetivos, PDO::PARAM_STR);
                $stmt->bindParam(':NOTA_AVAL_FASE_', $t_nota, PDO::PARAM_STR);
                $stmt->bindParam(':ESTADO_', $estado_, PDO::PARAM_STR);
                $stmt->execute();
            } catch (Exception $ex) {
                $msg = "calculo_ficha_avaliacao#14 :" . $ex->getMessage();
            }
        }
    }

    #
    # Criação de um Plano Desenvolvimento Individual PDI
    function get_pdi($where_, $empresa_, $plano_, $dt_plano_, $processo_, $dt_processo_, $rhid_avaliado_, $dt_adm_avaliado_, &$msg) {
        global $db,$msg_aval_not_ended;
        $msg = '';

         try {
            $sql  = "SELECT A.EMPRESA, A.ID_PA, A.DT_INI_PA, A.ID_PROCESSO_AV, A.DT_INI_PROCESSO, A.RHID, A.DT_ADMISSAO, A.ESTADO, A.NOTA_FINAL ".
                    "FROM MASTER_AVALIACAO_PDI A ".
                    "WHERE A.ESTADO = 'C' ";

            if ($where_ != '') {
                $sql  .= " AND ".$where_." ";
                $stmt = $db->prepare($sql);
            } else {
                $sql .= "  AND A.EMPRESA = :EMPRESA_ ".
                        "  AND A.ID_PA = :ID_PA_ ".
                        "  AND A.DT_INI_PA = :DT_INI_PA_ ".
                        "  AND A.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                        "  AND A.DT_INI_PROCESSO = :DT_INI_PROCESSO_".
                        "  AND A.RHID = :RHID_ ".
                        "  AND A.DT_ADMISSAO = :DT_ADMISSAO_ ";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_', $rhid_avaliado_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_avaliado_, PDO::PARAM_STR);
            }

            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ## remoção do plano anterior
                try {
                    $sql1 =  "DELETE FROM RH_COMPETENCIA_AVALIADAS ".
                            "WHERE EMPRESA = :EMPRESA_ ".
                            "  AND ID_PA = :ID_PA_ ".
                            "  AND DT_INI_PA = :DT_INI_PA_ ".
                            "  AND ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                            "  AND DT_INI_PROCESSO = :DT_INI_PROCESSO_".
                            "  AND RHID_AVALIADO = :RHID_AVALIADO_ ".
                            "  AND DT_ADMISSAO = :DT_ADMISSAO_ ";
                    $stmt1 = $db->prepare($sql1);
                    $stmt1->bindParam(':EMPRESA_', $row['EMPRESA'], PDO::PARAM_STR);
                    $stmt1->bindParam(':ID_PA_', $row['ID_PA'], PDO::PARAM_STR);
                    $stmt1->bindParam(':DT_INI_PA_', $row['DT_INI_PA'], PDO::PARAM_STR);
                    $stmt1->bindParam(':ID_PROCESSO_AV_', $row['ID_PROCESSO_AV'], PDO::PARAM_STR);
                    $stmt1->bindParam(':DT_INI_PROCESSO_', $row['DT_INI_PROCESSO'], PDO::PARAM_STR);
                    $stmt1->bindParam(':RHID_AVALIADO_', $row['RHID'], PDO::PARAM_STR);
                    $stmt1->bindParam(':DT_ADMISSAO_', $row['DT_ADMISSAO'], PDO::PARAM_STR);
                    $stmt1->execute();
                } catch (Exception $ex) {
                    $msg = "get_pdi#1 :" . $ex->getMessage();
                    break;
                }

                # criação do novo plano
                if ($msg == '') {
                    try {
                        $sql2 = "SELECT A.ID_COMPETENCIA ,A.DT_INI_COMPETENCIA ,A.DSP_COMPETENCIA ,SUM(A.PERC_COMPETENCIA*A.PESO_NOTA_FINAL/100) NOTA_FINAL ".
                                "FROM RH_RESUME_COMPETENCIAS_FA A ".
                                "WHERE A.EMPRESA = :EMPRESA_ ".
                                "  AND A.ID_PA = :ID_PA_ ".
                                "  AND A.DT_INI_PA = :DT_INI_PA_ ".
                                "  AND A.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                                "  AND A.DT_INI_PROCESSO = :DT_INI_PROCESSO_".
                                "  AND A.RHID_AVALIADO = :RHID_AVALIADO_ ".
                                "  AND A.DT_ADMISSAO = :DT_ADMISSAO_ ".
                                "GROUP BY A.ID_COMPETENCIA ,A.DT_INI_COMPETENCIA ,A.DSP_COMPETENCIA";

                        $stmt2 = $db->prepare($sql2);
                        $stmt2->bindParam(':EMPRESA_', $row['EMPRESA'], PDO::PARAM_STR);
                        $stmt2->bindParam(':ID_PA_', $row['ID_PA'], PDO::PARAM_STR);
                        $stmt2->bindParam(':DT_INI_PA_', $row['DT_INI_PA'], PDO::PARAM_STR);
                        $stmt2->bindParam(':ID_PROCESSO_AV_', $row['ID_PROCESSO_AV'], PDO::PARAM_STR);
                        $stmt2->bindParam(':DT_INI_PROCESSO_', $row['DT_INI_PROCESSO'], PDO::PARAM_STR);
                        $stmt2->bindParam(':RHID_AVALIADO_', $row['RHID'], PDO::PARAM_STR);
                        $stmt2->bindParam(':DT_ADMISSAO_', $row['DT_ADMISSAO'], PDO::PARAM_STR);
                        $stmt2->execute();
                    } catch (Exception $ex) {
                        $msg = "get_pdi#2 :" . $ex->getMessage();
                        break;
                    }

                    if ($msg == '') {
                        $cnt_ = 0;
                        while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                            $cnt_ += 1;

                            try {
                                $sql3 = "INSERT INTO RH_COMPETENCIA_AVALIADAS ".
                                        " (EMPRESA, ID_PA, DT_INI_PA, ID_PROCESSO_AV, DT_INI_PROCESSO, RHID_AVALIADO, DT_ADMISSAO, SEQ_, ".
                                        "  ID_COMPETENCIA, DT_INI_COMPETENCIA, NOTA) ".
                                        "VALUES(:EMPRESA_, :ID_PA_, :DT_INI_PA_, :ID_PROCESSO_AV_, :DT_INI_PROCESSO_, :RHID_AVALIADO_, :DT_ADMISSAO_, :SEQ_, ".
                                        " :ID_COMPETENCIA_, :DT_INI_COMPETENCIA_, :NOTA_) ";
                                $stmt3 = $db->prepare($sql3);
                                $stmt3->bindParam(':EMPRESA_', $row['EMPRESA'], PDO::PARAM_STR);
                                $stmt3->bindParam(':ID_PA_', $row['ID_PA'], PDO::PARAM_STR);
                                $stmt3->bindParam(':DT_INI_PA_', $row['DT_INI_PA'], PDO::PARAM_STR);
                                $stmt3->bindParam(':ID_PROCESSO_AV_', $row['ID_PROCESSO_AV'], PDO::PARAM_STR);
                                $stmt3->bindParam(':DT_INI_PROCESSO_', $row['DT_INI_PROCESSO'], PDO::PARAM_STR);
                                $stmt3->bindParam(':RHID_AVALIADO_', $row['RHID'], PDO::PARAM_STR);
                                $stmt3->bindParam(':DT_ADMISSAO_', $row['DT_ADMISSAO'], PDO::PARAM_STR);
                                $stmt3->bindParam(':SEQ_', $cnt_, PDO::PARAM_STR);
                                $stmt3->bindParam(':ID_COMPETENCIA_', $row2['ID_COMPETENCIA'], PDO::PARAM_STR);
                                $stmt3->bindParam(':DT_INI_COMPETENCIA_', $row2['DT_INI_COMPETENCIA'], PDO::PARAM_STR);
                                $stmt3->bindParam(':NOTA_', $row2['NOTA_FINAL'], PDO::PARAM_STR);
                                $stmt3->execute();
                            } catch (Exception $ex) {
                                $msg = "get_pdi#3 :" . $ex->getMessage();
                                break;
                            }
                        }
                    }
                }
            }

        } catch (Exception $ex) {
            $msg = "get_pdi#4 :" . $ex->getMessage();
        }
    }


    #
    # Avalia se a geração do PDI é automática, lançando-o caso seja
    function get_pdi_automatico($empresa_, $plano_, $dt_plano_, $processo_, $dt_processo_, $rhid_avaliado_, $dt_adm_avaliado_, &$msg) {
        global $db,$msg_aval_not_ended;
        $msg = '';

        try {
            $sql  = "SELECT A.EMPRESA, A.ID_PA, A.DT_INI_PA, A.ID_PROCESSO_AV, A.DT_INI_PROCESSO, A.RHID, A.DT_ADMISSAO, A.ESTADO, A.NOTA_FINAL ".
                    "FROM MASTER_AVALIACAO_PDI A ".
                    "WHERE A.EMPRESA = :EMPRESA_ ".
                    "  AND A.ID_PA = :ID_PA_ ".
                    "  AND A.DT_INI_PA = :DT_INI_PA_ ".
                    "  AND A.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                    "  AND A.DT_INI_PROCESSO = :DT_INI_PROCESSO_".
                    "  AND A.RHID = :RHID_ ".
                    "  AND A.DT_ADMISSAO = :DT_ADMISSAO_ ".
                    "  AND A.ESTADO = 'C' ";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
            $stmt->bindParam(':RHID_', $rhid_avaliado_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_avaliado_, PDO::PARAM_STR);

            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                get_pdi('', $empresa_, $plano_, $dt_plano_, $processo_, $dt_processo_, $rhid_avaliado_, $dt_adm_avaliado_, $msg);
            }

        } catch (Exception $ex) {
            $msg = "get_pdi_automatico#1 :" . $ex->getMessage();
        }
    }

    #
    # Abertura dos Planos Ação c/criação dos Objectivos Partilhados (institucionais)
    function get_plano_acao ($empresa_, $plano_, $dt_plano_, $processo_, $dt_processo_, $id_fase_, $dt_ini_fase_, $dt_ini_fpa_,
                             $tec_, $dt_tec_, $fonte_, $dt_fonte_, $eqp_, $dt_eqp_, $institucionais_, $dt_ref_, &$msg) {
        global $db;
        $msg = '';
        $nulo = null;

        try {
            $sql =  "INSERT INTO RH_FASE_EQP_OBJ_PARTILHADOS ".
                    " (EMPRESA, ID_PA, DT_INI_PA, ID_PROCESSO_AV, DT_INI_PROCESSO, ID_FASE, DT_INI_FASE, DT_INI_FPA, ".
                    "  TECNICA_AVALIACAO, DT_INI_TAP, FONTE_AVALIACAO, DT_INI_FA, ID_EQP_AVAL, DT_INI_DEA, NOTA_FINAL, OBS_1, OBS_2) ".
                    "VALUES(:EMPRESA_, :ID_PA_, :DT_INI_PA_, :ID_PROCESSO_AV_, :DT_INI_PROCESSO_, :ID_FASE_, :DT_INI_FASE_, :DT_INI_FPA_, ".
                    " :TECNICA_AVALIACAO_, :DT_INI_TAP_, :FONTE_AVALIACAO_, :DT_INI_FA_, :ID_EQP_AVAL_, :DT_INI_DEA_, NULL, NULL, NULL) ";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_FASE_', $id_fase_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_FASE_', $dt_ini_fase_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_FPA_', $dt_ini_fpa_, PDO::PARAM_STR);
            $stmt->bindParam(':TECNICA_AVALIACAO_', $tec_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_TAP_', $dt_tec_, PDO::PARAM_STR);
            $stmt->bindParam(':FONTE_AVALIACAO_', $fonte_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_FA_', $dt_fonte_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_EQP_AVAL_', $eqp_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_DEA_', $dt_eqp_, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $ex) {
            $msg = "get_plano_acao#1 :" . $ex->getMessage();
        }

        if ($msg == '') {
            if ($institucionais_ == 'S') {
                try {
                    $sql = "SELECT A.ID_OBJECTIVO, A.DT_INI_OBJECTIVO, A.DT_INI_OE, A.RESULTADO_CONTRATADO, A.ESTRATEGIAS_TATICAS, ".
			   "       A.APOIO_REQUERIDO, A.DT_FIM_OE, A.PESO, A.ID_MAGNITUDE, A.DT_INI_DM ".
                           "FROM  RH_OBJECTIVO_EQUIPAS A ".
                           "WHERE A.EMPRESA = :EMPRESA_ ".
                           "  AND A.ID_EQP_AVAL = :ID_EQP_AVAL_ ".
                           "  AND A.DT_INI_DEA = :DT_INI_DEA_ ";
                    $stmt = $db->prepare($sql);
                    $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                    $stmt->bindParam(':ID_EQP_AVAL_', $eqp_, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_INI_DEA_', $dt_eqp_, PDO::PARAM_STR);
                    $stmt->execute();
                } catch (Exception $ex) {
                    $msg = "get_plano_acao#2 :" . $ex->getMessage();
                }
                if ($msg == '') {
                    try {
                        while ($stmt->fetch(PDO::FETCH_ASSOC)) {
                            $sql1 =  "INSERT INTO RH_OBJECTIVOS_PARTILHADOS ".
                                    " (EMPRESA, ID_PA, DT_INI_PA, ID_PROCESSO_AV, DT_INI_PROCESSO, ID_FASE, DT_INI_FASE, DT_INI_FPA, ".
                                    "  TECNICA_AVALIACAO, DT_INI_TAP, FONTE_AVALIACAO, DT_INI_FA, ID_EQP_AVAL, DT_INI_DEA, ".
                                    "  ID_OBJECTIVO, DT_INI_OBJECTIVO, DT_INI_OE, DT_INI_OP, DT_FIM_OP, ".
                                    "  PESO, RESULTADO_CONTRATADO, ESTRATEGIAS_TATICAS, APOIO_REQUERIDO, ".
                                    "  ID_MAGNITUDE, DT_INI_DM) ".
                                    "VALUES(:EMPRESA_, :ID_PA_, :DT_INI_PA_, :ID_PROCESSO_AV_, :DT_INI_PROCESSO_, :ID_FASE_, :DT_INI_FASE_, :DT_INI_FPA_, ".
                                    " :TECNICA_AVALIACAO_, :DT_INI_TAP_, :FONTE_AVALIACAO_, :DT_INI_FA_, :ID_EQP_AVAL_, :DT_INI_DEA_, ".
                                    " :ID_OBJECTIVO_, :DT_INI_OBJECTIVO_, :DT_INI_OE_, :DT_INI_OP_, NULL, ".
                                    " :PESO_, :RESULTADO_CONTRATADO_, :ESTRATEGIAS_TATICAS_, :APOIO_REQUERIDO_  ".
                                    " :ID_MAGNITUDE_, :DT_INI_DM_) ";

                            $stmt1 = $db->prepare($sql);
                            $stmt1->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                            $stmt1->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                            $stmt1->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                            $stmt1->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                            $stmt1->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                            $stmt1->bindParam(':ID_FASE_', $id_fase_, PDO::PARAM_STR);
                            $stmt1->bindParam(':DT_INI_FASE_', $dt_ini_fase_, PDO::PARAM_STR);
                            $stmt1->bindParam(':DT_INI_FPA_', $dt_ini_fpa_, PDO::PARAM_STR);
                            $stmt1->bindParam(':TECNICA_AVALIACAO_', $tec_, PDO::PARAM_STR);
                            $stmt1->bindParam(':DT_INI_TAP_', $dt_tec_, PDO::PARAM_STR);
                            $stmt1->bindParam(':FONTE_AVALIACAO_', $fonte_, PDO::PARAM_STR);
                            $stmt1->bindParam(':DT_INI_FA_', $dt_fonte_, PDO::PARAM_STR);
                            $stmt1->bindParam(':ID_EQP_AVAL_', $eqp_, PDO::PARAM_STR);
                            $stmt1->bindParam(':DT_INI_DEA_', $dt_eqp_, PDO::PARAM_STR);
                            $stmt1->bindParam(':ID_OBJECTIVO_', $row['ID_OBJECTIVO'], PDO::PARAM_STR);
                            $stmt1->bindParam(':DT_INI_OBJECTIVO_', $row['DT_INI_OBJECTIVO'], PDO::PARAM_STR);
                            $stmt1->bindParam(':DT_INI_OE_', $row['DT_INI_OE'], PDO::PARAM_STR);
                            $stmt1->bindParam(':DT_INI_OP_', $dt_ref_, PDO::PARAM_STR);

                            if ($row['PESO'] != '') {
                                $stmt1->bindParam(':PESO_', $row['PESO'], PDO::PARAM_STR);
                            } else {
                                $stmt1->bindParam(':PESO_', $nulo, PDO::PARAM_NULL);
                            }

                            if ($row['RESULTADO_CONTRATADO'] != '') {
                                $stmt1->bindParam(':RESULTADO_CONTRATADO_', $row['RESULTADO_CONTRATADO'], PDO::PARAM_STR);
                            } else {
                                $stmt1->bindParam(':RESULTADO_CONTRATADO_', $nulo, PDO::PARAM_NULL);
                            }

                            if ($row['ESTRATEGIAS_TATICAS'] != '') {
                                $stmt1->bindParam(':ESTRATEGIAS_TATICAS_', $row['ESTRATEGIAS_TATICAS'], PDO::PARAM_STR);
                            } else {
                                $stmt1->bindParam(':ESTRATEGIAS_TATICAS_', $nulo, PDO::PARAM_NULL);
                            }

                            if ($row['APOIO_REQUERIDO'] != '') {
                                $stmt1->bindParam(':APOIO_REQUERIDO_', $row['APOIO_REQUERIDO'], PDO::PARAM_STR);
                            } else {
                                $stmt1->bindParam(':APOIO_REQUERIDO_', $nulo, PDO::PARAM_NULL);
                            }

                            if ($row['ID_MAGNITUDE'] != '') {
                                $stmt1->bindParam(':ID_MAGNITUDE_', $row['ID_MAGNITUDE'], PDO::PARAM_STR);
                            } else {
                                $stmt1->bindParam(':ID_MAGNITUDE_', $nulo, PDO::PARAM_NULL);
                            }

                            if ($row['DT_INI_DM'] != '') {
                                $stmt1->bindParam(':DT_INI_DM_', $row['DT_INI_DM'], PDO::PARAM_STR);
                            } else {
                                $stmt1->bindParam(':DT_INI_DM_', $nulo, PDO::PARAM_NULL);
                            }

                            $stmt1->execute();
                        }
                    } catch (Exception $ex) {
                        $msg = "get_plano_acao#3 :" . $ex->getMessage();
                    }
                }
            }
        }
    }


    #
    # Cálculo da Nota Final dos Planos Ação
    function calculo_plano_acao($empresa_, $plano_, $dt_plano_, $processo_, $dt_processo_, $id_fase_, $dt_ini_fase_, $dt_ini_fpa_,
                                $tec_, $dt_tec_, $fonte_, $dt_fonte_, $eqp_, $dt_eqp_, &$msg) {
        global $db;
        $msg = '';

        $PD = 0;        # Total das percentagens definidas nos objectivos
        $nr_D = 0;      # Nr. objectivos sem percentagens definidas nos objectivos
        $perc_ind = 0;  # Percentagem a atribuir aos objectivos sem percentagens indicadas nos objectivos
        $nt_final = 0;  # Nota final

        # Total das percentagens definidas nos objectivos
        try {
            $sql =  "SELECT SUM(A.PESO) TOT_PERC ".
                    "FROM RH_OBJECTIVOS_PARTILHADOS A ".
                    "WHERE A.EMPRESA = :EMPRESA_ ".
                    "  AND A.ID_PA = :ID_PA_ ".
                    "  AND A.DT_INI_PA = :DT_INI_PA_ ".
                    "  AND A.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                    "  AND A.DT_INI_PROCESSO = :DT_INI_PROCESSO_".
                    "  AND A.FONTE_AVALIACAO =  :FONTE_AVALIACAO_ ".
                    "  AND A.DT_INI_FA = :DT_INI_FA_ ".
                    "  AND A.TECNICA_AVALIACAO = :TECNICA_AVALIACAO_ ".
                    "  AND A.DT_INI_TAP = :DT_INI_TAP_ ".
                    "  AND A.ID_FASE = :ID_FASE_ ".
                    "  AND A.DT_INI_FASE = :DT_INI_FASE_ ".
                    "  AND A.DT_INI_FPA = :DT_INI_FPA_ ".
                    "  AND A.ID_EQP_AVAL = :ID_EQP_AVAL_ ".
                    "  AND A.PESO IS NULL ";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
            $stmt->bindParam(':FONTE_AVALIACAO_', $fonte_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_FA_', $dt_fonte_, PDO::PARAM_STR);
            $stmt->bindParam(':TECNICA_AVALIACAO_', $tec_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_TAP_', $dt_tec_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_FASE_', $id_fase_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_FASE_', $dt_ini_fase_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_FPA_', $dt_ini_fpa_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_EQP_AVAL_', $eqp_, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $PD = $row['TOT_PERC'];
        } catch (Exception $ex) {
            $msg = "calculo_plano_acao#1 :" . $ex->getMessage();
        }

        # Nr. objectivos sem percentagens definidas nos objectivos
        if ($msg == '') {
            try {
                $sql =  "SELECT COUNT(A.ID_OBJECTIVO) NR ".
                        "FROM RH_OBJECTIVOS_PARTILHADOS A ".
                        "WHERE A.EMPRESA = :EMPRESA_ ".
                        "  AND A.ID_PA = :ID_PA_ ".
                        "  AND A.DT_INI_PA = :DT_INI_PA_ ".
                        "  AND A.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                        "  AND A.DT_INI_PROCESSO = :DT_INI_PROCESSO_".
                        "  AND A.FONTE_AVALIACAO =  :FONTE_AVALIACAO_ ".
                        "  AND A.DT_INI_FA = :DT_INI_FA_ ".
                        "  AND A.TECNICA_AVALIACAO = :TECNICA_AVALIACAO_ ".
                        "  AND A.DT_INI_TAP = :DT_INI_TAP_ ".
                        "  AND A.ID_FASE = :ID_FASE_ ".
                        "  AND A.DT_INI_FASE = :DT_INI_FASE_ ".
                        "  AND A.DT_INI_FPA = :DT_INI_FPA_ ".
                        "  AND A.ID_EQP_AVAL = :ID_EQP_AVAL_ ".
                        "  AND A.PESO IS NULL ";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                $stmt->bindParam(':FONTE_AVALIACAO_', $fonte_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_FA_', $dt_fonte_, PDO::PARAM_STR);
                $stmt->bindParam(':TECNICA_AVALIACAO_', $tec_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_TAP_', $dt_tec_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_FASE_', $id_fase_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_FASE_', $dt_ini_fase_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_FPA_', $dt_ini_fpa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_EQP_AVAL_', $eqp_, PDO::PARAM_STR);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $nr_D = $row['NR'];
            } catch (Exception $ex) {
                $msg = "calculo_plano_acao#2 :" . $ex->getMessage();
            }
        }

        # Percentagem a atribuir aos objectivos sem percentagens indicadas nos objectivos
        if ($msg == '') {
            $perc_ind = 0;
            if ($PD == '') {
                $PD = 0;
            }
            if ($nr_D == '') {
                $nr_D = 1;
            }
            if ($nr_D >= 1) {
                $perc_ind = round((100 - $PD)/$nr_D,2);
            }
        }

        # Calculo da Nota Final
        if ($msg == '') {
            try {
                $sql =  "SELECT B.ID_OBJECTIVO, B.DT_INI_OBJECTIVO, NVL(A.PESO,:PERC_) PESO, MAX(B.PERC_REAL) PERC_REAL ".
                        "FROM RH_OBJECTIVOS_PARTILHADOS A, RH_AVALIACAO_OBJ_PARTILHADOS B ".
                        "WHERE A.EMPRESA = :EMPRESA_ ".
                        "  AND A.ID_PA = :ID_PA_ ".
                        "  AND A.DT_INI_PA = :DT_INI_PA_ ".
                        "  AND A.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                        "  AND A.DT_INI_PROCESSO = :DT_INI_PROCESSO_".
                        "  AND A.FONTE_AVALIACAO =  :FONTE_AVALIACAO_ ".
                        "  AND A.DT_INI_FA = :DT_INI_FA_ ".
                        "  AND A.TECNICA_AVALIACAO = :TECNICA_AVALIACAO_ ".
                        "  AND A.DT_INI_TAP = :DT_INI_TAP_ ".
                        "  AND A.ID_FASE = :ID_FASE_ ".
                        "  AND A.DT_INI_FASE = :DT_INI_FASE_ ".
                        "  AND A.DT_INI_FPA = :DT_INI_FPA_ ".
                        "  AND A.ID_EQP_AVAL = :ID_EQP_AVAL_ ".
                        "  AND A.DT_INI_DEA = :DT_INI_DEA_".
                        "  AND A.EMPRESA = B.EMPRESA ".
                        "  AND A.ID_PA = B.ID_PA ".
                        "  AND A.DT_INI_PA = B.DT_INI_PA ".
                        "  AND A.ID_PROCESSO_AV = B.ID_PROCESSO_AV ".
                        "  AND A.DT_INI_PROCESSO = B.DT_INI_PROCESSO ".
                        "  AND A.FONTE_AVALIACAO = B.FONTE_AVALIACAO ".
                        "  AND A.DT_INI_FA = B.DT_INI_FA ".
                        "  AND A.TECNICA_AVALIACAO = B.TECNICA_AVALIACAO ".
                        "  AND A.DT_INI_TAP = B.DT_INI_TAP ".
                        "  AND A.ID_FASE = B.ID_FASE ".
                        "  AND A.DT_INI_FASE = B.DT_INI_FASE ".
                        "  AND A.DT_INI_FPA = B.DT_INI_FPA ".
                        "  AND A.ID_EQP_AVAL = B.ID_EQP_AVAL ".
                        "  AND A.DT_INI_DEA = B.DT_INI_DEA ".
                        "  AND A.ID_OBJECTIVO = B.ID_OBJECTIVO ".
                        "  AND A.DT_INI_OBJECTIVO = B.DT_INI_OBJECTIVO ".
                        "  GROUP BY B.ID_OBJECTIVO, B.DT_INI_OBJECTIVO, A.PESO ";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                $stmt->bindParam(':FONTE_AVALIACAO_', $fonte_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_FA_', $dt_fonte_, PDO::PARAM_STR);
                $stmt->bindParam(':TECNICA_AVALIACAO_', $tec_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_TAP_', $dt_tec_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_FASE_', $id_fase_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_FASE_', $dt_ini_fase_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_FPA_', $dt_ini_fpa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_EQP_AVAL_', $eqp_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_DEA_', $dt_eqp_, PDO::PARAM_STR);
                $stmt->bindParam(':PERC_', $perc_ind, PDO::PARAM_STR);
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $nt_final = $nt_final + ($row['PESO'] + $row['PERC_REAL']);
                }
            } catch (Exception $ex) {
                $msg = "calculo_plano_acao#3 :" . $ex->getMessage();
            }
        }

        # Atualiza Nota Final
        if ($msg == '') {
            $nt_final = round($nt_final,2);
            try {
                $sql =  "UPDATE RH_FASE_EQP_OBJ_PARTILHADOS A ".
                        "SET A.NOTA_FINAL = :NOTA_FINAL_ ".
                        "WHERE A.EMPRESA = :EMPRESA_ ".
                        "  AND A.ID_PA = :ID_PA_ ".
                        "  AND A.DT_INI_PA = :DT_INI_PA_ ".
                        "  AND A.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
                        "  AND A.DT_INI_PROCESSO = :DT_INI_PROCESSO_".
                        "  AND A.FONTE_AVALIACAO =  :FONTE_AVALIACAO_ ".
                        "  AND A.DT_INI_FA = :DT_INI_FA_ ".
                        "  AND A.TECNICA_AVALIACAO = :TECNICA_AVALIACAO_ ".
                        "  AND A.DT_INI_TAP = :DT_INI_TAP_ ".
                        "  AND A.ID_FASE = :ID_FASE_ ".
                        "  AND A.DT_INI_FASE = :DT_INI_FASE_ ".
                        "  AND A.DT_INI_FPA = :DT_INI_FPA_ ".
                        "  AND A.ID_EQP_AVAL = :ID_EQP_AVAL_ ".
                        "  AND A.DT_INI_DEA = :DT_INI_DEA_";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PA_', $plano_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PA_', $dt_plano_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_PROCESSO_AV_', $processo_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_PROCESSO_', $dt_processo_, PDO::PARAM_STR);
                $stmt->bindParam(':FONTE_AVALIACAO_', $fonte_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_FA_', $dt_fonte_, PDO::PARAM_STR);
                $stmt->bindParam(':TECNICA_AVALIACAO_', $tec_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_TAP_', $dt_tec_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_FASE_', $id_fase_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_FASE_', $dt_ini_fase_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_FPA_', $dt_ini_fpa_, PDO::PARAM_STR);
                $stmt->bindParam(':ID_EQP_AVAL_', $eqp_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_DEA_', $dt_eqp_, PDO::PARAM_STR);
                $stmt->bindParam(':NOTA_FINAL_', $nt_final, PDO::PARAM_STR);
                $stmt->execute();
            } catch (Exception $ex) {
                $msg = "calculo_plano_acao#4 :" . $ex->getMessage();
            }
        }
    }


    #
    # Funções de suporte ao DASHBOARD


    #
    #
    #
    function av_processos_ativos(&$msg) {
        global $link;
        $msg = '';

        $rhid_ = @$_SESSION['rhid'];
        $perfil_ = @$_SESSION['perfil'];

        $id_pa_ant_ = '';
        $id_proc_ant_ = '';
        $dsp_proc = '';
        $dsr_proc = '';
        $processos = array();
        $proc_colabs = array();
        $avaliadas = 0;
        $submetidas = 0;
        $publicadas = 0;
        $total = 0;
        try {

            #
            # FICHA AVAL:
            #       S - Fichas Avaliação
            #       A - Fichas Av.Interm.
            #       B - Entrevista
            #       C - Homologação de resultados de avaliação
            #       D - Concordância
            #       F - Homologação de fichas de avaliação
            #       N - Processual DRH
            #

            if (@$_SESSION['perfil'] == 'A') {
                    $sql = "SELECT X.EMPRESA, X.ID_PA, X.DT_INI_PA, X.ID_PROCESSO_AV, X.DT_INI_PROCESSO,".
                           "       X.RHID_AVALIADO RHID, Y.NOME NOME_AVALIADO, Y.NOME_REDZ NOME_REDZ_AVALIADO, X.DT_ADMISSAO, X.RHID_AVALIADOR, X.ID_FASE, X.DT_INI_FASE, X.DT_INI_FPA, X.DT_INI_AF, ".
                           "       Z.DSP_PROCESSO, Z.DSR_PROCESSO, X.ESTADO, DOMINIO('GE_ESTADO_FA',X.ESTADO,'') DSP_ESTADO, ".
                           "       GE_PUB_RESULTADOS(X.EMPRESA,X.ID_PA,X.DT_INI_PA,X.ID_PROCESSO_AV,X.DT_INI_PROCESSO,X.RHID_AVALIADO, X.DT_ADMISSAO) RESULTADOS ".
	                   "FROM RH_AVALIADOR_FASES X, RH_IDENTIFICACOES Y, RH_PROCESSOS_AVALIACAO Z ".
	                   "WHERE X.ESTADO != 'Z' ".
	                   "  AND (GE_AVALIACAO_HISTORICO(X.ID_PA,X.DT_INI_PA,X.ID_PROCESSO_AV,X.DT_INI_PROCESSO,X.RHID_AVALIADO,X.DT_ADMISSAO,X.EMPRESA) = 'N' OR ".
	                   "       DATE_FORMAT(Z.DT_INI_PROCESSO,'%Y') >= DATE_FORMAT(QUADATE(),'%Y')-1) ".
	                   "  AND  DATE_FORMAT(Z.DT_INI_PROCESSO,'%Y') >= DATE_FORMAT(QUADATE(),'%Y')-1 ".
	                   "  AND DATE_FORMAT(Z.DT_INI_AVALIACAO,'%Y-%m-%d') <= DATE_FORMAT(SYSDATE(),'%Y-%m-%d') ".
	                   "  AND X.RHID_AVALIADO = :RHID_ ".
                           "  AND GE_ESTADO_PROC_AVALIACAO(Z.EMPRESA,Z.ID_PA,Z.DT_INI_PA,Z.ID_PROCESSO_AV,Z.DT_INI_PROCESSO) IN ('E','F') ".
                           "  AND DATE_FORMAT(Z.DT_INI_AVALIACAO,'%Y-%m-%d') <= DATE_FORMAT(SYSDATE(),'%Y-%m-%d') ".
	                   "  AND Y.RHID = X.RHID_AVALIADO ".
	                   "  AND Z.EMPRESA = X.EMPRESA ".
	                   "  AND Z.ID_PA = X.ID_PA ".
	                   "  AND Z.DT_INI_PA = X.DT_INI_PA ".
	                   "  AND Z.ID_PROCESSO_AV = X.ID_PROCESSO_AV ".
	                   "  AND Z.DT_INI_PROCESSO = X.DT_INI_PROCESSO ".
	                   "  AND (X.EMPRESA, X.ID_PA, X.DT_INI_PA, X.ID_PROCESSO_AV, X.DT_INI_PROCESSO, X.ID_FASE, X.DT_INI_FASE, X.DT_INI_FPA) IN ".
	                   " (SELECT A.EMPRESA, A.ID_PA, A.DT_INI_PA, A.ID_PROCESSO_AV, A.DT_INI_PROCESSO, A.ID_FASE, A.DT_INI_FASE, A.DT_INI_FPA ".
	                   "  FROM RH_FASES_FONTES_PROCESSO A ".
	                   "    , RH_TECNICAS_AVAL_PROCESSO B ".
	                   "  WHERE B.EMPRESA = A.EMPRESA ".
	                   "    AND B.ID_PA = A.ID_PA ".
	                   "    AND B.DT_INI_PA = A.DT_INI_PA ".
	                   "    AND B.ID_PROCESSO_AV = A.ID_PROCESSO_AV ".
	                   "    AND B.DT_INI_PROCESSO = A.DT_INI_PROCESSO ".
	                   "    AND B.TECNICA_AVALIACAO = A.TECNICA_AVALIACAO ".
	                   "    AND B.DT_INI_TAP = A.DT_INI_TAP ".
	                   "    AND B.FONTE_AVALIACAO = A.FONTE_AVALIACAO ".
	                   "    AND B.DT_INI_FA = A.DT_INI_FA ".
#	                   "    AND B.PERFIL_ASSOCIADO = :PERFIL_ ".
	                   "    AND A.FICHA_AVAL IN ('S','A') ) ".
	                   "ORDER BY X.DT_INI_PROCESSO DESC, Z.DSP_PROCESSO, X.ID_FASE, X.RHID_AVALIADO ";

		           $stmt = $link->prepare($sql);
		           $stmt->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
#		           $stmt->bindParam(':PERFIL_', $perfil_, PDO::PARAM_STR);
            } 
            else {
                    # fichas de avaliação para preencher associadas às fases de Geração de fichas de avaliação / Geração de fichas de avaliação intermédia
	            $sql =  "SELECT X.EMPRESA, X.ID_PA, X.DT_INI_PA, X.ID_PROCESSO_AV, X.DT_INI_PROCESSO,".
	                    "       X.RHID_AVALIADO RHID, Y.NOME NOME_AVALIADO, Y.NOME_REDZ NOME_REDZ_AVALIADO, X.DT_ADMISSAO, X.RHID_AVALIADOR, X.ID_FASE, X.DT_INI_FASE, X.DT_INI_FPA, X.DT_INI_AF, ".
	                    "       Z.DSP_PROCESSO, Z.DSR_PROCESSO, X.ESTADO, DOMINIO('GE_ESTADO_FA',X.ESTADO,'') DSP_ESTADO, ".
	                    "       GE_PUB_RESULTADOS(X.EMPRESA,X.ID_PA,X.DT_INI_PA,X.ID_PROCESSO_AV,X.DT_INI_PROCESSO,X.RHID_AVALIADO, X.DT_ADMISSAO) RESULTADOS, ".
                            "       'FICHA_AVAL' TIPO_QUADRO, Z.DT_INI_AVALIACAO ".
	                    "FROM RH_AVALIADOR_FASES X, RH_IDENTIFICACOES Y, RH_PROCESSOS_AVALIACAO Z ".
                            "WHERE X.ESTADO != 'Z' ".
	                    "  AND DATE_FORMAT(Z.DT_INI_AVALIACAO,'%Y-%m-%d') <= DATE_FORMAT(SYSDATE(),'%Y-%m-%d') ".
                            "  AND GE_ESTADO_PROC_AVALIACAO(Z.EMPRESA,Z.ID_PA,Z.DT_INI_PA,Z.ID_PROCESSO_AV,Z.DT_INI_PROCESSO) IN ('E','F') ".
                            "  AND GE_PROC_TERMINADO(X.EMPRESA,X.ID_PA,X.DT_INI_PA,X.ID_PROCESSO_AV,X.DT_INI_PROCESSO) = 'N' ".
                            "  AND (GE_AVALIACAO_HISTORICO(X.ID_PA,X.DT_INI_PA,X.ID_PROCESSO_AV,X.DT_INI_PROCESSO,X.RHID_AVALIADO,X.DT_ADMISSAO,X.EMPRESA) = 'N' OR ".
                            "       DATE_FORMAT(Z.DT_INI_PROCESSO,'%Y') >= DATE_FORMAT(QUADATE(),'%Y')-1) ".
                            "  AND  DATE_FORMAT(Z.DT_INI_PROCESSO,'%Y') >= DATE_FORMAT(QUADATE(),'%Y')-1 ".
                            "  AND DATE_FORMAT(Z.DT_INI_AVALIACAO,'%Y-%m-%d') <= DATE_FORMAT(SYSDATE(),'%Y-%m-%d') ".
                            "  AND X.RHID_AVALIADOR = :RHID_ ".
                            "  AND Y.RHID = X.RHID_AVALIADO ".
                            "  AND Z.EMPRESA = X.EMPRESA ".
                            "  AND Z.ID_PA = X.ID_PA ".
                            "  AND Z.DT_INI_PA = X.DT_INI_PA ".
                            "  AND Z.ID_PROCESSO_AV = X.ID_PROCESSO_AV ".
                            "  AND Z.DT_INI_PROCESSO = X.DT_INI_PROCESSO ".
                            "  AND (X.EMPRESA, X.ID_PA, X.DT_INI_PA, X.ID_PROCESSO_AV, X.DT_INI_PROCESSO, X.ID_FASE, X.DT_INI_FASE, X.DT_INI_FPA) IN ".
                            "       (SELECT A.EMPRESA, A.ID_PA, A.DT_INI_PA, A.ID_PROCESSO_AV, A.DT_INI_PROCESSO, A.ID_FASE, A.DT_INI_FASE, A.DT_INI_FPA ".
                            "        FROM RH_FASES_FONTES_PROCESSO A ".
                            "            ,RH_TECNICAS_AVAL_PROCESSO B ".
                            "        WHERE B.EMPRESA = A.EMPRESA ".
                            "          AND B.ID_PA = A.ID_PA ".
                            "          AND B.DT_INI_PA = A.DT_INI_PA ".
                            "          AND B.ID_PROCESSO_AV = A.ID_PROCESSO_AV ".
                            "          AND B.DT_INI_PROCESSO = A.DT_INI_PROCESSO ".
                            "          AND B.TECNICA_AVALIACAO = A.TECNICA_AVALIACAO ".
                            "          AND B.DT_INI_TAP = A.DT_INI_TAP ".
                            "          AND B.FONTE_AVALIACAO = A.FONTE_AVALIACAO ".
                            "          AND B.DT_INI_FA = A.DT_INI_FA ".
                            "          AND B.PERFIL_ASSOCIADO = :PERFIL_ ".
                            "          AND A.FICHA_AVAL IN ('S','A') ".
                            "       ) ".
                            # fases sem ficha associada mas que deverão ter pronunciamento -> homologação de resultados
                            "UNION ".
                            "SELECT X.EMPRESA, X.ID_PA, X.DT_INI_PA, X.ID_PROCESSO_AV, X.DT_INI_PROCESSO,".
                            "       X.RHID_AVALIADO RHID, Y.NOME NOME_AVALIADO, Y.NOME_REDZ NOME_REDZ_AVALIADO, X.DT_ADMISSAO, X.RHID_AVALIADOR, X.ID_FASE, X.DT_INI_FASE, X.DT_INI_FPA, X.DT_INI_AF, ".
                            "       Z.DSP_PROCESSO, Z.DSR_PROCESSO, X.ESTADO, IF(X.ESTADO = 'Z', F.DSP_FASE,DOMINIO('GE_ESTADO_FA',X.ESTADO,'')) DSP_ESTADO, ".
                            "       GE_PUB_RESULTADOS(X.EMPRESA,X.ID_PA,X.DT_INI_PA,X.ID_PROCESSO_AV,X.DT_INI_PROCESSO,X.RHID_AVALIADO, X.DT_ADMISSAO) RESULTADOS, ".
                            "       'RESULTADOS' TIPO_QUADRO, Z.DT_INI_AVALIACAO ".
                            "FROM RH_AVALIADOR_FASES X, RH_IDENTIFICACOES Y, RH_PROCESSOS_AVALIACAO Z, RH_DEF_FASES F ".
                            "WHERE X.ESTADO = 'Z' ".
	                    "  AND DATE_FORMAT(Z.DT_INI_AVALIACAO,'%Y-%m-%d') <= DATE_FORMAT(SYSDATE(),'%Y-%m-%d') ".
                            "  AND GE_PROC_TERMINADO(X.EMPRESA,X.ID_PA,X.DT_INI_PA,X.ID_PROCESSO_AV,X.DT_INI_PROCESSO) = 'N' ".
                            "  AND GE_ESTADO_PROC_AVALIACAO(Z.EMPRESA,Z.ID_PA,Z.DT_INI_PA,Z.ID_PROCESSO_AV,Z.DT_INI_PROCESSO) IN ('E','F') ".
                            "  AND (GE_AVALIACAO_HISTORICO(X.ID_PA,X.DT_INI_PA,X.ID_PROCESSO_AV,X.DT_INI_PROCESSO,X.RHID_AVALIADO,X.DT_ADMISSAO,X.EMPRESA) = 'N' OR ".
                            "       DATE_FORMAT(Z.DT_INI_PROCESSO,'%Y') >= DATE_FORMAT(QUADATE(),'%Y')-1) ".
                            "  AND  DATE_FORMAT(Z.DT_INI_PROCESSO,'%Y') >= DATE_FORMAT(QUADATE(),'%Y')-1 ".
                            "  AND DATE_FORMAT(Z.DT_INI_AVALIACAO,'%Y-%m-%d') <= DATE_FORMAT(SYSDATE(),'%Y-%m-%d') ".
                            "  AND X.RHID_AVALIADOR = :RHID_ ".
                            "  AND Y.RHID = X.RHID_AVALIADO ".
                            "  AND Z.EMPRESA = X.EMPRESA ".
                            "  AND Z.ID_PA = X.ID_PA ".
                            "  AND Z.DT_INI_PA = X.DT_INI_PA ".
                            "  AND Z.ID_PROCESSO_AV = X.ID_PROCESSO_AV ".
                            "  AND Z.DT_INI_PROCESSO = X.DT_INI_PROCESSO ".
                            "  AND F.ID_FASE = X.ID_FASE ".
                            "  AND F.DT_INI_FASE = X.DT_INI_FASE ".
                            "  AND (X.EMPRESA, X.ID_PA, X.DT_INI_PA, X.ID_PROCESSO_AV, X.DT_INI_PROCESSO, X.ID_FASE, X.DT_INI_FASE, X.DT_INI_FPA) IN ".
                            " (SELECT A.EMPRESA, A.ID_PA, A.DT_INI_PA, A.ID_PROCESSO_AV, A.DT_INI_PROCESSO, A.ID_FASE, A.DT_INI_FASE, A.DT_INI_FPA ".
                            "  FROM RH_FASES_FONTES_PROCESSO A ".
                            "    , RH_TECNICAS_AVAL_PROCESSO B ".
                            "  WHERE B.EMPRESA = A.EMPRESA ".
                            "    AND B.ID_PA = A.ID_PA ".
                            "    AND B.DT_INI_PA = A.DT_INI_PA ".
                            "    AND B.ID_PROCESSO_AV = A.ID_PROCESSO_AV ".
                            "    AND B.DT_INI_PROCESSO = A.DT_INI_PROCESSO ".
                            "    AND B.TECNICA_AVALIACAO = A.TECNICA_AVALIACAO ".
                            "    AND B.DT_INI_TAP = A.DT_INI_TAP ".
                            "    AND B.FONTE_AVALIACAO = A.FONTE_AVALIACAO ".
                            "    AND B.DT_INI_FA = A.DT_INI_FA ".
                            "    AND B.PERFIL_ASSOCIADO = :PERFIL_) ".
#	                    "    AND A.FICHA_AVAL NOT IN ('S','A') ) ".
                            # fases com ficha de avaliação no estado de Para Homologação, cujo homologador seja o próprio
                            # (possivelmente faltará filtrar o :RHID_)
                            "UNION ".
                            "SELECT X.EMPRESA, X.ID_PA, X.DT_INI_PA, X.ID_PROCESSO_AV, X.DT_INI_PROCESSO,".
                            "       X.RHID_AVALIADO RHID, Y.NOME NOME_AVALIADO, Y.NOME_REDZ NOME_REDZ_AVALIADO, X.DT_ADMISSAO, X.RHID_AVALIADOR, X.ID_FASE, X.DT_INI_FASE, X.DT_INI_FPA, X.DT_INI_AF, ".
                            "       Z.DSP_PROCESSO, Z.DSR_PROCESSO, X.ESTADO, IF(X.ESTADO = 'Z', F.DSP_FASE,DOMINIO('GE_ESTADO_FA',X.ESTADO,'')) DSP_ESTADO, ".
                            "       GE_PUB_RESULTADOS(X.EMPRESA,X.ID_PA,X.DT_INI_PA,X.ID_PROCESSO_AV,X.DT_INI_PROCESSO,X.RHID_AVALIADO, X.DT_ADMISSAO) RESULTADOS, ".
                            "       'HOMOLOG_FICHAS' TIPO_QUADRO, Z.DT_INI_AVALIACAO ".
                            "FROM RH_AVALIADOR_FASES X, RH_IDENTIFICACOES Y, RH_PROCESSOS_AVALIACAO Z, RH_DEF_FASES F ".
#                            "WHERE X.ESTADO != 'Z' ".
                            "WHERE X.ESTADO IN ('B0','B1','C','D') ".
#                            "  AND GE_PROC_TERMINADO(X.EMPRESA,X.ID_PA,X.DT_INI_PA,X.ID_PROCESSO_AV,X.DT_INI_PROCESSO) = 'N' ".
#                            "  AND X.RHID_AVALIADOR = :RHID_ ".
	                    "  AND DATE_FORMAT(Z.DT_INI_AVALIACAO,'%Y-%m-%d') <= DATE_FORMAT(SYSDATE(),'%Y-%m-%d') ".
                            "  AND GE_ESTADO_PROC_AVALIACAO(Z.EMPRESA,Z.ID_PA,Z.DT_INI_PA,Z.ID_PROCESSO_AV,Z.DT_INI_PROCESSO) IN ('E','F') ".
                            "  AND (GE_AVALIACAO_HISTORICO(X.ID_PA,X.DT_INI_PA,X.ID_PROCESSO_AV,X.DT_INI_PROCESSO,X.RHID_AVALIADO,X.DT_ADMISSAO,X.EMPRESA) = 'N' OR ".
                            "       DATE_FORMAT(Z.DT_INI_PROCESSO,'%Y') >= DATE_FORMAT(QUADATE(),'%Y')-1) ".
                            "  AND  DATE_FORMAT(Z.DT_INI_PROCESSO,'%Y') >= DATE_FORMAT(QUADATE(),'%Y')-1 ".
                            "  AND Y.RHID = X.RHID_AVALIADO ".
                            "  AND Z.EMPRESA = X.EMPRESA ".
                            "  AND Z.ID_PA = X.ID_PA ".
                            "  AND Z.DT_INI_PA = X.DT_INI_PA ".
                            "  AND Z.ID_PROCESSO_AV = X.ID_PROCESSO_AV ".
                            "  AND Z.DT_INI_PROCESSO = X.DT_INI_PROCESSO ".
                            "  AND F.ID_FASE = X.ID_FASE ".
                            "  AND F.DT_INI_FASE = X.DT_INI_FASE ".
                            "  AND (X.EMPRESA, X.ID_PA, X.DT_INI_PA, X.ID_PROCESSO_AV, X.DT_INI_PROCESSO, X.RHID_AVALIADO, X.DT_ADMISSAO) IN ".
                            " (SELECT A.EMPRESA, A.ID_PA, A.DT_INI_PA, A.ID_PROCESSO_AV, A.DT_INI_PROCESSO, C.RHID_AVALIADO, C.DT_ADMISSAO ".
                            "  FROM RH_FASES_FONTES_PROCESSO A ".
                            "      ,RH_TECNICAS_AVAL_PROCESSO B ".
                            "      ,RH_AVALIADOR_FASES C ".
                            "  WHERE B.EMPRESA = A.EMPRESA ".
                            "    AND B.ID_PA = A.ID_PA ".
                            "    AND B.DT_INI_PA = A.DT_INI_PA ".
                            "    AND B.ID_PROCESSO_AV = A.ID_PROCESSO_AV ".
                            "    AND B.DT_INI_PROCESSO = A.DT_INI_PROCESSO ".
                            "    AND B.TECNICA_AVALIACAO = A.TECNICA_AVALIACAO ".
                            "    AND B.DT_INI_TAP = A.DT_INI_TAP ".
                            "    AND B.FONTE_AVALIACAO = A.FONTE_AVALIACAO ".
                            "    AND B.DT_INI_FA = A.DT_INI_FA ".
                            "    AND B.PERFIL_ASSOCIADO = :PERFIL_ ".
	                    "    AND A.FICHA_AVAL = 'F' ".
	                    "    AND C.EMPRESA = A.EMPRESA ".
	                    "    AND C.ID_PA = A.ID_PA ". 
	                    "    AND C.DT_INI_PA = A.DT_INI_PA ". 
	                    "    AND C.ID_PROCESSO_AV = A.ID_PROCESSO_AV ". 
	                    "    AND C.DT_INI_PROCESSO = A.DT_INI_PROCESSO ". 
	                    "    AND C.ID_FASE = A.ID_FASE ".
	                    "    AND C.DT_INI_FASE = A.DT_INI_FASE ".
	                    "    AND C.DT_INI_FPA = A.DT_INI_FPA) ". 
                            "ORDER BY 4 DESC, 15, 11, 6 ";
                    
                $stmt = $link->prepare($sql);
                $stmt->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
                $stmt->bindParam(':PERFIL_', $perfil_, PDO::PARAM_STR);
	    }
#echo $sql; 

            $stmt->execute();
        } catch (Exception $ex) {
            $msg = "av_processos_ativos#1 :" . $ex->getMessage();
        }

        if ($msg == '') {
            try {
                $proc_colabs = array();
                $por_avaliar = 0;
                $por_homologar = 0;
                $nao_homologadas = 0;
                $submetidas = 0;
                $publicadas = 0;
                $total = 0;
                $id_pa_ant_ = '';
                $id_proc_ant_ = '';
                $tp_quadro = '';

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
#echo "#0 ".$row['DSP_PROCESSO'].
#     " RHID:".$row['RHID']." - ".$row['NOME_AVALIADO']." - ".$row['NOME_REDZ_AVALIADO'].
#     " ESTADO:".$row['ESTADO']." - ".$row['DSP_ESTADO'].
#     " RESULTADOS:".$row['RESULTADOS']."<br/>";

                  if ((@$_SESSION['perfil'] == 'A' && $row['ESTADO'] == 'C') || @$_SESSION['perfil'] != 'A') {

                    if ($id_proc_ant_ == '') {

                        $id_pa_ant_ = $row['ID_PA'];
                        $id_proc_ant_ = $row['ID_PROCESSO_AV'];
                        $dsp_proc = $row['DSP_PROCESSO'];
                        $dsr_proc = $row['DSR_PROCESSO'];
                        $tp_quadro = $row['TIPO_QUADRO'];

                        $proc_colabs = array();
                        $por_avaliar = 0;
                        $por_homologar = 0;
                        $nao_homologadas = 0;
                        $submetidas = 0;
                        $publicadas = 0;
                        $total = 0;

                    }
                    elseif ($id_pa_ant_ != $row['ID_PA'] ||
                            $id_proc_ant_ != $row['ID_PROCESSO_AV']) {

                        $proc = array(  "DSP" => $dsp_proc,
                                        "DSR" => $dsr_proc,
                                        "TIPO_QUADRO" => $tp_quadro,
                                        "POR_AVALIAR" => $por_avaliar,
                                        "POR_HOMOLOGAR" => $por_homologar,
                                        "NAO_HOMOLOGADAS" => $nao_homologadas,
                                        "SUBMETIDAS" => $submetidas,
                                        "PUBLICADAS" => $publicadas,
                                        "TOTAL" => $total,
                                        "COLABS" => $proc_colabs,
                                );
#echo "#1 $dsp_proc total:$total<br/>";
                        if ($total != 0) {
                            array_push($processos, $proc);
                        }

                        $id_pa_ant_ = $row['ID_PA'];
                        $id_proc_ant_ = $row['ID_PROCESSO_AV'];
                        $dsp_proc = $row['DSP_PROCESSO'];
                        $dsr_proc = $row['DSR_PROCESSO'];
                        $tp_quadro = $row['TIPO_QUADRO'];

                        $proc_colabs = array();
                        $por_avaliar = 0;
                        $por_homologar = 0;
                        $nao_homologadas = 0;
                        $submetidas = 0;
                        $publicadas = 0;
                        $total = 0;
                    }

                    // Criadas Em preenchimento ou Submetidas
                    if ($row['ESTADO'] == 'A' ||
                        $row['ESTADO'] == 'B' ||
                        $row['ESTADO'] == 'C' ||
                        $row['ESTADO'] == 'B0' ||
                        $row['ESTADO'] == 'B1' ||
                        $row['ESTADO'] == 'D') {

                        $total += 1;

                        if ($row['ESTADO'] == 'A' || $row['ESTADO'] == 'B') { // Criadas Em preenchimento ou Submetidas
                            $por_avaliar += 1;
                        } elseif ($row['ESTADO'] == 'B1') { // Não Homologada
                            $nao_homologadas += 1;
                        } elseif ($row['ESTADO'] == 'C' || $row['ESTADO'] == 'D') { // Submetidas / Encerradas
                            $submetidas += 1;
                        } elseif ($row['ESTADO'] == 'B0') { // Para Homologação
                            $por_homologar += 1;
                        }

                        $key_ficha =    $row['EMPRESA']."@".
                                        $row['ID_PA']."@".
                                        $row['DT_INI_PA']."@".
                                        $row['ID_PROCESSO_AV']."@".
                                        $row['DT_INI_PROCESSO']."@".
                                        $row['RHID']."@".
                                        $row['DT_ADMISSAO']."@".
                                        $row['RHID_AVALIADOR']."@".
                                        $row['ID_FASE']."@".
                                        $row['DT_INI_FASE']."@".
                                        $row['DT_INI_FPA']."@".
                                        $row['DT_INI_AF'];

                        $key_res =  $row['EMPRESA']."@".
                                    $row['ID_PA']."@".
                                    $row['DT_INI_PA']."@".
                                    $row['ID_PROCESSO_AV']."@".
                                    $row['DT_INI_PROCESSO']."@".
                                    $row['RHID']."@".
                                    $row['DT_ADMISSAO'];

                        $ficha = "ad_employee_evaluation_sheet.php?key=".base64_encode($key_ficha);
                        $resultados = '';
                        if ($row['RESULTADOS'] == 'S') {
	                            $resultados = "ad_employee_results.php?key=".base64_encode($key_res);
                            $publicadas += 1;
                        }

                        array_push($proc_colabs, array ("RHID" => $row['RHID'],
                                                        "NOME" => $row['NOME_AVALIADO'],
                                                        "NOME_REDZ" => $row['NOME_REDZ_AVALIADO'],
                                                        "ESTADO_FICHA" => $row['DSP_ESTADO'],
                                                        "FICHA" => $ficha,
                                                        "RESULTADOS" => $resultados
                                                 )
                        );

                    }
                }

	        }
            } catch (Exception $ex) {
                $msg = "av_processos_ativos#2 :" . $ex->getMessage();
            }

            if ($total != 0) {
# echo "#2 $dsp_proc total:$total<br/>";
                $proc = array(  "DSP" => $dsp_proc,
                                "DSR" => $dsr_proc,
                                "TIPO_QUADRO" => $tp_quadro,
                                "POR_AVALIAR" => $por_avaliar,
                                "POR_HOMOLOGAR" => $por_homologar,
                                "NAO_HOMOLOGADAS" => $nao_homologadas,
                                "SUBMETIDAS" => $submetidas,
                                "PUBLICADAS" => $publicadas,
                                "TOTAL" => $total,
                                "COLABS" => $proc_colabs,
                        );

                array_push($processos, $proc);
            }
        }

        return $processos;
    }

    /* Fotos de Colaboradores */
    function show_foto_ad($rhid, $original, $html_classes, &$msg) {

        global $directory, $base_url, $link;
        $db = $link;
        $msg = '';
        $cnt = 0;
        $foto = '';
        $result = '';
        # Obtem directoria das fotos dos colaboradores
        #$dir_fotos = str_replace("/lib", "", $base_url) . '/img/fotos/'; //get_dir_path('fotos_colab', $msg);
	$dir_fotos = '/_docs/colabs/fotos/'; //get_dir_path('fotos_colab', $msg);
        $physical_dir_fotos = str_replace("quad_hcm\lib", "", $directory) . '_docs/colabs/fotos/'; //get_dir_path('fotos_colab', $msg);
#        $dir_fotos = "/_docs/colabs/fotos";

	$dir_fotos = 'img/fotos/'; //get_dir_path('fotos_colab', $msg);
        
        if ($msg != '') {
            echo $msg;
        } else {

            $query = "SELECT LINK_DOC foto FROM RH_IDENTIFICACOES WHERE rhid = :RHID_ AND LINK_DOC != '' ";
            try {
                $stmt = $db->prepare($query);
                $stmt->bindParam(':RHID_', $rhid);
                $stmt->execute();
                $cnt = $stmt->rowCount();
            } catch (Exception $ex) {
                $msg = "show_foto#1 :" . $ex->getMessage();
            }
            if ($msg == '') {
                try {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $foto = $row['foto'];
                    }
                } catch (Exception $ex) {
                    $msg = "show_foto#2 :" . $ex->getMessage();
                }
            }
            //echo "DIR:" . $dir_fotos . " Rhid: ".$rhid." Foto:" . $foto;

            if ($msg == '') {
                if ($foto == '') {
                    $foto = 'noimage.jpg';
                }

                # url da foto a mostrar
                $t_foto = $dir_fotos . $foto;

                # obtem carateristicas da foto
                if ($original == 'S') {
                    list($width, $height, $type, $attr) = getimagesize($physical_dir_fotos.'/'.$foto);
                    $result = "<img src='" . $t_foto . "?=" . rand(100000,999999) . "' width='$width' height='" . $height . "' class='" .$html_classes. "'/>";
                } else {
                    $result = "<img src='" . $t_foto . "?=" . rand(100000,999999) . "' class='" .$html_classes. "'/>";
                }
            }
        } //Photos directory

        return $result;
    }

?>