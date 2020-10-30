<?php
/*
 * Classe extendida da classse QuadCore para dar suporte a especializações de algumas funções da classe QuadCore
 * de forma a implementar mecanismos de PRE-DML e POST-DML.
 * 
 * Exemplo: TABELA RH_ID_REMUNERACOES em que antes da criação de um registo pode ser necessário criar registo noutra tabela (RH_DEF_LINHAS_SALARIAIS)
 *          e após a criação do registo poderá ser necessário criar registo noutra tabela (RH_DEF_VALORES_SALARIAIS)
 * 
 * Esta extensão é ativada no controlador quad_controller.php, subtituindo a classe QuadCore por esta classe quando a tabela é RH_ID_REMUNERACOES
 * 
 */

require_once 'QuadCore.php';

class QuadCore_Extended extends QuadCore
{

    # função que, de acordo com a operação de DML executada e da tabela onde a mesma é executada
    # executa ações necessárias num cenário PRE-[operação]
    #     resource = {
    #        operacao: "INSERT/UPDATE/DELETE",
    #        tabela: "RH_ID_AUSENCIAS/RH_ID_TS_HV/...",
    #        dados: "array com dados do registo devolvido (caso INSERT/UPDATE)"
    #    }
    public static function preDML($db, $resource, &$msg) {
        $msg = '';
        if (isset($resource->tabela) && isset($resource->operacao)) {
            if ($resource->tabela == 'RH_ID_REMUNERACOES' && $resource->operacao == 'INSERT') {
                $msg = '';
                $resource1 = new stdClass();
                $resource1->operacao = $resource->operacao;
                $resource1->cd_grelha_salarial = isset($resource->dados->CD_GRELHA_SALARIAL) ? $resource->dados->CD_GRELHA_SALARIAL : '';
                $resource1->cd_linha_salarial = isset($resource->dados->CD_LINHA_SALARIAL) ? $resource->dados->CD_LINHA_SALARIAL : '';
                pre_operations_grelhas_salariais($db, $resource1, $msg);
            }
            elseif ($resource->tabela == 'RH_ID_PROFISSIONAIS' && ($resource->operacao == 'UPDATE' || $resource->operacao == 'DELETE')) {
                $msg = '';
                $resource1 = new stdClass();
                $resource1->operacao = $resource->operacao;
                $resource1->empresa = isset($resource->dados->EMPRESA) ? $resource->dados->EMPRESA : '';
                $resource1->rhid = isset($resource->dados->RHID) ? $resource->dados->RHID : '';
                $resource1->dt_adm = isset($resource->dados->DT_ADMISSAO) ? $resource->dados->DT_ADMISSAO : '';
                $resource1->cd_irct = isset($resource->dados->CD_IRCT) ? $resource->dados->CD_IRCT : '';
                $resource1->dt_eficacia = isset($resource->dados->DT_EFICACIA) ? $resource->dados->DT_EFICACIA : '';
                pre_operations_info_prof($db, $resource1, $msg);
            }
            elseif ($resource->tabela == 'RH_ID_RETRIBUTIVOS' && ($resource->operacao == 'UPDATE' || $resource->operacao == 'DELETE')) {
                $msg = '';
                $resource1 = new stdClass();
                $resource1->operacao = $resource->operacao;
                $resource1->empresa = isset($resource->dados->EMPRESA) ? $resource->dados->EMPRESA : '';
                $resource1->rhid = isset($resource->dados->RHID) ? $resource->dados->RHID : '';
                $resource1->dt_adm = isset($resource->dados->DT_ADMISSAO) ? $resource->dados->DT_ADMISSAO : '';
                $resource1->tp_irs = isset($resource->dados->TP_IRS) ? $resource->dados->TP_IRS : '';
                pre_operations_info_retrib($db, $resource1, $msg);
            }
            elseif ($resource->tabela == 'DG_GD_HDR_AUTO' && $resource->operacao == 'DELETE') {
                $msg = '';
                $resource1 = new stdClass();
                $resource1->operacao = $resource->operacao;
                $resource1->id = isset($resource->dados->ID) ? $resource->dados->ID : '';
                require_once INCLUDES_PATH.'/lib/gd_lib_controller.php';
                gd_remove_template($resource1->id, $msg);        
            }            
            elseif ($resource->tabela == 'DG_DET_GESTAO_DOCUMENTAL' && $resource->operacao == 'DELETE') {
                $msg = '';
                $resource1 = new stdClass();
                $resource1->operacao = $resource->operacao;
                $resource1->cd_gd = isset($resource->dados->CD_GD) ? $resource->dados->CD_GD : '';
                $resource1->dt_ini_gd = isset($resource->dados->DT_INI_GD) ? $resource->dados->DT_INI_GD : '';
                $resource1->cd_det_gd = isset($resource->dados->CD_DET_GD) ? $resource->dados->CD_DET_GD : '';
                $resource1->dt_ini_det_gd = isset($resource->dados->DT_INI_DET_GD) ? $resource->dados->DT_INI_DET_GD : '';

                require_once INCLUDES_PATH.'/lib/gd_lib_controller.php';
                gd_remove_det_template_gd($resource1->cd_gd, $resource1->dt_ini_gd, $resource1->cd_det_gd, $resource1->dt_ini_det_gd, $msg);                
            }            
            elseif ($resource->tabela == 'RH_ID_GESTAO_DOCUMENTAL' && $resource->operacao == 'DELETE') {
                $msg = '';
                $resource1 = new stdClass();
                $resource1->operacao = $resource->operacao;
                $resource1->id_proc_gd = isset($resource->dados->ID_PROC_GD) ? $resource->dados->ID_PROC_GD : '';

                require_once INCLUDES_PATH.'/lib/gd_lib_controller.php';
                gd_remove_gd_registos($resource1->id_proc_gd, $msg); 
            }            
        }
    }
        
    # função que, de acordo com a operação de DML executada e da tabela onde a mesma é executada
    # executa ações necessárias num cenário POST-[operação]
    #     resource = {
    #        operacao: "INSERT/UPDATE/DELETE",
    #        tabela: "RH_ID_AUSENCIAS/RH_ID_TS_HV/...",
    #        dados: "array com dados do registo devolvido (caso INSERT/UPDATE)"
    #    }
    #
    # especialização da função para as tabelas que usam esta classe
    #
    public static function postDML($db, $resource, &$msg) {
        $msg = '';
        if (isset($resource->tabela) && isset($resource->operacao)) {
            
            if ($resource->tabela == 'RH_ID_REMUNERACOES' && 
                ($resource->operacao == 'INSERT'  || $resource->operacao == 'UPDATE' || $resource->operacao == 'DELETE' )
               ) {
                $msg = '';
                $resource1 = new stdClass();
                $resource1->operacao = $resource->operacao;
                $resource1->cd_grelha_salarial = isset($resource->dados->CD_GRELHA_SALARIAL) ? $resource->dados->CD_GRELHA_SALARIAL : '';
                $resource1->cd_linha_salarial = isset($resource->dados->CD_LINHA_SALARIAL) ? $resource->dados->CD_LINHA_SALARIAL : '';
                $resource1->valor = isset($resource->dados->INPUT_VALOR) ? $resource->dados->INPUT_VALOR : '';
                $resource1->dt_ini = isset($resource->dados->DT_INICIO) ? $resource->dados->DT_INICIO : '';
                if ($resource1->dt_ini != '') {
                    $resource1->dt_ini = substr($resource1->dt_ini,0,7).'-01';
                }
                $resource1->dt_fim = isset($resource->dados->DT_FIM) ? $resource->dados->DT_FIM : '';
                if ($resource1->dt_fim != '') {
                    $resource1->dt_fim = date("Y-m-t", strtotime(substr($resource1->dt_fim,0,7)."-01"));
                }
                post_operations_grelhas_salariais($db, $resource1, $msg);
            }
            elseif ($resource->tabela == 'RH_ID_PROFISSIONAIS' && 
                ($resource->operacao == 'INSERT'  || $resource->operacao == 'UPDATE' || $resource->operacao == 'DELETE' )
               ) {
                $msg = '';
                $resource1 = new stdClass();
                $resource1->operacao = $resource->operacao;
                $resource1->empresa = isset($resource->dados->EMPRESA) ? $resource->dados->EMPRESA : '';
                $resource1->rhid = isset($resource->dados->RHID) ? $resource->dados->RHID : '';
                $resource1->dt_adm = isset($resource->dados->DT_ADMISSAO) ? $resource->dados->DT_ADMISSAO : '';
                $resource1->cd_irct = isset($resource->dados->CD_IRCT) ? $resource->dados->CD_IRCT : '';
                $resource1->dt_eficacia = isset($resource->dados->DT_EFICACIA) ? $resource->dados->DT_EFICACIA : '';
                post_operations_info_prof($db, $resource1, $msg);
            }
            elseif ($resource->tabela == 'RH_ID_RETRIBUTIVOS' && 
                ($resource->operacao == 'INSERT'  || $resource->operacao == 'UPDATE' || $resource->operacao == 'DELETE' )
               ) {
                $msg = '';
                $resource1 = new stdClass();
                $resource1->operacao = $resource->operacao;
                $resource1->empresa = isset($resource->dados->EMPRESA) ? $resource->dados->EMPRESA : '';
                $resource1->rhid = isset($resource->dados->RHID) ? $resource->dados->RHID : '';
                $resource1->dt_adm = isset($resource->dados->DT_ADMISSAO) ? $resource->dados->DT_ADMISSAO : '';
                $resource1->tp_irs = isset($resource->dados->TP_IRS) ? $resource->dados->TP_IRS : '';
                post_operations_info_retrib($db, $resource1, $msg);
            }
            elseif ($resource->tabela == 'RH_ID_DELEGACOES' && 
                    ($resource->operacao == 'INSERT' || $resource->operacao == 'UPDATE')
               ) {

                # após inserir ou atualizar registo de delegações atualiza o respetivo estado antes de devolver os dados...
                $estado = '';
                $msg = '';
                
                $resource1 = new stdClass();
                $resource1->operacao = $resource->operacao;
                $resource1->empresa = isset($resource->dados->EMPRESA) ? $resource->dados->EMPRESA : '';
                $resource1->rhid = isset($resource->dados->RHID) ? $resource->dados->RHID : '';
                $resource1->dt_adm = isset($resource->dados->DT_ADMISSAO) ? $resource->dados->DT_ADMISSAO : '';
                $resource1->rhid_destino = isset($resource->dados->RHID_DESTINO) ? $resource->dados->RHID_DESTINO : '';
                $resource1->dt_adm_destino = isset($resource->dados->DT_ADMISSAO_DESTINO) ? $resource->dados->DT_ADMISSAO_DESTINO : '';
                $resource1->dt_inicio = isset($resource->dados->DT_INICIO) ? $resource->dados->DT_INICIO : '';
                $resource1->dt_fim = isset($resource->dados->DT_FIM) ? $resource->dados->DT_FIM : '';

                if(($resource1->operacao == 'INSERT' || $resource1->operacao == 'UPDATE') &&
                   $resource1->empresa != '' && $resource1->rhid != '' && $resource1->dt_adm != ''  && 
                   $resource1->rhid_destino != '' && $resource1->dt_adm_destino != '' && $resource1->dt_inicio != '') {
                    
                    require_once INCLUDES_PATH.'/lib/gd_lib_controller.php';
                    $estado = deleg_atualiza_estado($resource1->empresa, $resource1->rhid, $resource1->dt_adm,
                                                    $resource1->rhid_destino, $resource1->dt_adm_destino, 
                                                    $resource1->dt_inicio, $resource1->dt_fim,
                                                    $resource1->operacao, $msg);
                    
                }
            }
            
            elseif ($resource->tabela == 'DK_VALORES_INDICADOR' && 
                    ($resource->operacao == 'INSERT' || $resource->operacao == 'UPDATE')
               ) {

                # após inserir ou atualizar registo de delegações atualiza o respetivo estado antes de devolver os dados...
                $estado = '';
                $msg = '';
                $null = null;
                
                $resource1 = new stdClass();
                $resource1->operacao = $resource->operacao;
                $resource1->empresa = isset($resource->dados->EMPRESA) ? $resource->dados->EMPRESA : '';
                $resource1->data = isset($resource->dados->DATA) ? $resource->dados->DATA : '';
                $resource1->cd_indicador = isset($resource->dados->CD_INDICADOR) ? $resource->dados->CD_INDICADOR : '';
                $resource1->dt_indicador = isset($resource->dados->DT_IN_IND) ? $resource->dados->DT_IN_IND : '';
                $resource1->cd_estab = isset($resource->dados->CD_ESTAB) ? $resource->dados->CD_ESTAB : '';
                $resource1->cd_ff = isset($resource->dados->CD_FF) ? $resource->dados->CD_FF : '';
                $resource1->valor_ff = isset($resource->dados->VALOR_FF) ? $resource->dados->VALOR_FF : '';

                if(($resource1->operacao == 'INSERT' || $resource1->operacao == 'UPDATE') &&
                   $resource1->empresa != '' && $resource1->data != '' &&
                   $resource1->cd_indicador != '' && $resource1->dt_indicador != '') {
                    
                    require_once INCLUDES_PATH.'/lib/dk_lib.php';
                    $msg1 = '';
                    $fase_ = '';
                    $fase_ = dk_avalia_fase('B', '', $msg1);
                    if ($msg1 == '' && $fase_ != '') {
                        try {
                            $stmt = $db->prepare("UPDATE DK_VALORES_INDICADOR " .
                                                 "SET FASE = :fase_ ".
                                                 "WHERE EMPRESA = :empresa_ ".
                                                 "  AND DATA = :data_ ".
                                                 "  AND CD_INDICADOR = :cd_indicador_ ".
                                                 "  AND DT_IN_IND = :dt_indicador_ ".
                                                 "  AND COALESCE(CD_ESTAB,'@') = COALESCE(:cd_estab_,'@')".
                                                 "  AND COALESCE(CD_FF,'@') = COALESCE(:cd_ff_,'@')".
                                                 "  AND COALESCE(VALOR_FF,'@') = COALESCE(:valor_ff_,'@')");

                            $stmt->bindParam(':fase_', $fase_, PDO::PARAM_STR);
                            $stmt->bindParam(':empresa_', $resource1->empresa, PDO::PARAM_STR);
                            $stmt->bindParam(':data_', $resource1->data, PDO::PARAM_STR);
                            $stmt->bindParam(':cd_indicador_', $resource1->cd_indicador, PDO::PARAM_STR);
                            $stmt->bindParam(':dt_indicador_', $resource1->dt_indicador, PDO::PARAM_STR);

                            if ($resource1->cd_estab != '') {
                                $stmt->bindParam(':cd_estab_', $resource1->cd_estab, PDO::PARAM_STR);
                            } else {
                                $stmt->bindParam(':cd_estab_', $null, PDO::PARAM_NULL);
                            }
                            
                            if ($resource1->cd_ff != '') {
                                $stmt->bindParam(':cd_estab_', $resource1->cd_ff, PDO::PARAM_STR);
                            } else {
                                $stmt->bindParam(':cd_estab_', $null, PDO::PARAM_NULL);
                            }

                            if ($resource1->valor_ff != '') {
                                $stmt->bindParam(':valor_ff_', $resource1->valor_ff, PDO::PARAM_STR);
                            } else {
                                $stmt->bindParam(':valor_ff_', $null, PDO::PARAM_NULL);
                            }

                            $stmt->execute();
                        } catch (Exception $ex) {
                            $msg = "postDML[dk_valores_indicadores]#1: " . $ex->getMessage();
                        }
                        
                    } else {
                        $msg = $msg1;
                    }

                }
            }
            elseif ($resource->tabela == 'DG_GD_HDR_AUTO' && 
                    ($resource->operacao == 'INSERT' || $resource->operacao == 'UPDATE')
               ) {

                $estado = '';
                $msg = '';
                
                $resource1 = new stdClass();
                $resource1->operacao = $resource->operacao;
                $resource1->id = isset($resource->rowid) ? $resource->rowid : (isset($resource->dados->ID) ? $resource->dados->ID : '');
                $resource1->empresa = isset($resource->dados->EMPRESA) ? $resource->dados->EMPRESA : '';
                
                if ($resource1->operacao == 'INSERT' && $resource1->id != '' && $resource1->empresa != '') {
                    require_once INCLUDES_PATH.'/lib/gd_lib_controller.php';
                    gd_cria_det_auto($resource1->id, $resource1->empresa, 'INSERT', $msg);    
                }
                elseif ($resource1->operacao == 'UPDATE' && $resource1->id != '' && $resource1->empresa != '') {
                    null;
                }
            }
            elseif ($resource->tabela == 'RH_ID_GESTAO_DOCUMENTAL' && 
                    ($resource->operacao == 'INSERT' || $resource->operacao == 'UPDATE')
               ) {

                $estado = '';
                $msg = '';
                
                $resource1 = new stdClass();
                $resource1->operacao = $resource->operacao;
                $resource1->id = isset($resource->rowid) ? $resource->rowid : (isset($resource->dados->ID_PROC_GD) ? $resource->dados->ID_PROC_GD : '');
                
                if ($resource1->operacao == 'INSERT' && $resource1->id != '') {
                    require_once INCLUDES_PATH.'/lib/gd_lib_controller.php';
                    gd_cria_gd_registos($resource1->id, 'INSERT', $msg);
                }
                elseif ($resource1->operacao == 'UPDATE' && $resource1->id != '') {
                    require_once INCLUDES_PATH.'/lib/gd_lib_controller.php';
                    gd_cria_gd_registos($resource1->id, 'UPDATE', $msg);
                }
            }
        }
    }
    
    # executa as operações de INSERT
    # 
    # Implementa possibilidade de chamada PRE-DML e POST-DML
    public function doInsert($db, $info)
    {
#$dadosOut = array(
#                "error" => 'ESTOU A FORÇAR ERRO NO INSERT NO QUADCORE_EXTENTED'
#            );
#echo json_encode($dadosOut);
#die();
        $statements = [];
        $nulo = 'NULL';
        $sql_cols = '';
        $sql_vals = '';
        $submitDML = false;
        $insert = false;
        $newVal = '';
        $msg = '';

        # constroi o statment de INSERT
        $sql_hdr = "INSERT INTO " . $this->table . "  ";
        for ($i = 0; $i < $this->len; $i++) {
            $col = $this->getColName($i);
            $newVal = $this->data[$i]->nxt_value;

            if ($newVal != '') {
                $submitDML = true;

                $dateType = $this->getDatetype($i);
                if ($dateType) {
                    $newVal = $this->formatToDatetype($col, $dateType, $newVal);
                } else {
                    $newVal = "'" . str_replace("'", "''", $newVal) . "'";
                }
            } else {
                $newVal = $nulo;
            }

            if (
                (is_array($this->funcFields) &&
                    in_array($col, $this->funcFields)) ||
                (isset($this->data[$i]->datatype) &&
                    strtoupper($this->data[$i]->datatype) == 'SEQUENCE') ||
                (isset($this->data[$i]->datatype) &&
                    strtoupper($this->data[$i]->datatype) == 'JUST_EDITOR')
            ) {
                // apenas considera coluna de SEQUENCIA se for a única da PK
                if (strtoupper($this->data[$i]->datatype) === 'SEQUENCE' && count($this->pk) === 1) {
                    //PK w/ SEQUENCE (autoincrement no MySQL) ONLY FIRST ONE IS ADMITED AND ISOLETEAD
                    $select_column_sequence = $col;
                }
            } else {
                if (
                    (is_array($this->funcFields) &&
                        in_array($col, $this->funcFields)) ||
                    (isset($this->data[$i]->datatype) &&
                        strtoupper($this->data[$i]->datatype) == 'SEQUENCE') ||
                    (isset($this->data[$i]->datatype) &&
                        strtoupper($this->data[$i]->datatype) == 'JUST_EDITOR')
                ) {
                    null;
                } else {
                    // not a function field , we include in INSERT AND UPDATE
                    if ($sql_cols != '') {
                        $sql_cols .= ', ' . $col;
                        $sql_vals .= ', ' . $newVal;
                    } else {
                        $sql_cols = $col;
                        $sql_vals = $newVal;
                    }
                }
            }
        }

        # no caso de ser um workflow em modo de postponed, só efetua a notificação,
        # não criando o registo e parando o processo em notifyUser
        # com exceção do caso em que existe uma auto-aprovação e aí a variável $submitDML é colocada a true
        # e é efetuado o DML
        if (isset($this->wkf) && $this->wkfMode === 'postponed') {
            $notifyResp = $this->wkf->notifyThis(
                $this->table,
                $this->operation,
                null,
                $this->setPK($this->pk),
                $this->data,
                $this->cxLists,
                $this->domains,
                $this->wkfUpdate
            );
            $submitDML = $notifyResp[1];
            $insert = true;
        } 
        elseif (isset($this->wkf) && $this->wkfMode === 'optimistic') {
            $statements = $this->wkf->notifyThis(
                $this->table,
                $this->operation,
                null,
                $this->setPK($this->pk),
                $this->data,
                $this->cxLists,
                $this->domains,
                $this->wkfUpdate
            );
            $submitDML = true;
            $insert = true;
        } 
        else {
            $submitDML = true;
            $insert = true;
        }

        # submeter o statement
        if ($submitDML) {
            
            ## inicializa dados para a chamadas do PRE e POST DML
            $resource = new stdClass();
            $resource->operacao = $this->operation;
            $resource->tabela = $this->table;
            $resource->rowid = $this->rowid;
            # carregar dados 
            $resource->dados = new stdClass();
            foreach ($this->data as $record) {
                $resource->dados->{$record->db} = $record->nxt_value;
            }
            
            ## chamada ao preDML
            QuadCore_Extended::preDML($db, $resource, $msg);
            if ($msg != '') {
                QuadCore::getErrors($db, null, false, $msg);
            }
            
            # executa o statement de INSERT
            if (isset($select_column_sequence)) {
                $rowid = 0;
                $sql =
                    $sql_hdr .
                    "(" .
                    $sql_cols .
                    ") VALUES (" .
                    $sql_vals .
                    ") ";

                // Execute Statment
                try {
                    # ORACLE REPLICATION
                    $this->exec_DML_oracle($this->table, $sql);

                    if (isset($this->wkf)) {
                        $stmt = $db->prepare($sql);
                        array_push($statements, $stmt);
                        //$stmt->execute();
                    } else {
                        $db->query($sql);

                        $rowid = $db->lastInsertId(); //this doenst work allways return 0 , i mean ALLWAYS
                        //
                        # extensão para colunas automáticas que não sejam sequências
                        if ($rowid == 0) {
                            $selectRow =
                                "SELECT " .
                                $select_column_sequence .
                                " FROM " .
                                $this->table .
                                " " .
                                $this->alias .
                                ' ORDER BY COALESCE(DT_UPDATED,DT_INSERTED) ' .
                                ' DESC LIMIT 1';

                            $retRow = $db->prepare($selectRow);
                            $retRow->execute();
                            $data = $retRow->fetch(PDO::FETCH_ASSOC);
                            $rowid = $data[$select_column_sequence];
                        }
                        $this->rowid = $rowid;
                        
                    }
                } catch (Exception $ex) {
                    QuadCore::getErrors($db, $ex);
                }
                
                if ($rowid === 0) {
                    $selectRow =
                        "SELECT " .
                        $info['columns'] .
                        " FROM " .
                        $this->table .
                        " " .
                        $this->alias .
                        ' ORDER BY ' .
                        $select_column_sequence .
                        ' DESC LIMIT 1';
                } else {
                    $selectRow =
                        "SELECT " .
                        $info['columns'] .
                        " FROM " .
                        $this->table .
                        " " .
                        " WHERE ".$select_column_sequence . " = '" . $rowid . "' ".
                        ' LIMIT 1';
                }

                $retRow = $db->prepare($selectRow);
                //$retRow->bindValue(':rid', $rowid);
            } 
            else {
                try {
                    $sql =
                        $sql_hdr .
                        "(" .
                        $sql_cols .
                        ") VALUES (" .
                        $sql_vals .
                        ") ";

                    # ORACLE REPLICATION
                    $this->exec_DML_oracle($this->table, $sql);

                    $stmt = $db->prepare($sql);

                    if (isset($this->wkf)) {
                        $stmt = $db->prepare($sql);
                        array_push($statements, $stmt);
                        //$stmt->execute();
                    } else {
                        $stmt->execute();
                    }
                    $retRow = $db->prepare($info['selectUpdated']);
                } catch (Exception $ex) {
                    QuadCore::getErrors($db, $ex);
                }
            }

            //SELECT para devolver ao QUADTABLES/QUADFORMS o registo alvo de DML
            // Execute Query
            try {
                if (isset($this->wkf) && $this->wkfMode === 'optimistic') {
                    array_push($statements, $retRow);
                    if ($this->wkf->doWorkFlowTransaction($statements, $db)) {
                        
                        $resource->rowid = $this->rowid;
                        
                        ## chamada ao postDML
                        QuadCore_Extended::postDML($db, $resource, $msg);
                        if ($msg != '') {
                            QuadCore::getErrors($db, null, false, $msg);
                        }
                        
                        # obtem os dados após a execução das operações
                        $retRow->execute();
                        $data = $retRow->fetchAll(PDO::FETCH_ASSOC);
                    }
                } elseif (isset($this->wkf) && $this->wkfMode === 'postponed') {
                    /* if(is_array($submitDML) && $submitDML[0]==="S"){ //is finished by administrator (last perfil)
                        $retRow->execute();
                        $data = $retRow->fetchAll(PDO::FETCH_ASSOC);
                    }else{*/
                    if ($this->wkf->doWorkFlowTransaction($sql,'',$db)) {

                        $resource->rowid = $this->rowid;
                        
                        ## chamada ao postDML
                        QuadCore_Extended::postDML($db, $resource, $msg);

                        if ($msg != '') {
                            QuadCore::getErrors($db, null, false, $msg);
                        }
                        
                        # obtem os dados após a execução das operações
                        $retRow->execute();
                        $data = $retRow->fetchAll(PDO::FETCH_ASSOC);
                    }
                    // }
                } else {

                    $resource->rowid = $this->rowid;

                    ## chamada ao postDML
                    QuadCore_Extended::postDML($db, $resource, $msg);
                    if ($msg != '') {
                        QuadCore::getErrors($db, null, false, $msg);
                    }
                    
                    # obtem os dados após a execução das operações
                    $retRow->execute();
                    $data = $retRow->fetchAll(PDO::FETCH_ASSOC);
                }
            } catch (Exception $ex) {
                QuadCore::getErrors($db, $ex);
            }

            if (is_array($submitDML) && $submitDML[0] === "N") {
                die();
            }
            
            # dados de retorno do INSERT
            $dadosOut = array(
                "data" => $data
            );
            echo json_encode($dadosOut);
            
        } 
        elseif ($insert) {
            # neste caso existiu uma inserção mas a mesma não é efetivada 
            # porque entrou em processo de workflow
            $dadosOut = array(
                "msg" => "ok"
            );
            echo json_encode($dadosOut);
        }

        if ($this->active_log && $insert) {
            $wkfU = '';
            if (isset($this->wkf)) {
                $wkfU = $this->wkfUpdate;
            }
            $this->log->registoLog(
                $this->table,
                $this->operation,
                null,
                $this->setPK($this->pk),
                $this->data,
                $this->cxLists,
                $this->domains,
                $wkfU);
        }
        
    }

    # executa as operações de UPDATE
    # 
    # Implementa possibilidade de chamada PRE-DML e POST-DML
    public function doUpdate($db, $info)
    {
/*
$dadosOut = array(
                "error" => 'ESTOU A FORÇAR ERRO NO UPDATE'
            );
echo json_encode($dadosOut);
die();        
 */
        $statements = [];
        $nulo = 'NULL';
        $sql_body = '';
        $submitDML = false;
        $change = false;

        # constroi o statment de UPDATE
        $sql_hdr = $this->operation . " " . $this->table . " SET ";
        for ($i = 0; $i < $this->len; $i++) {
            if (
                isset($this->data[$i]->nxt_value) &&
                $this->data[$i]->nxt_value !== $this->data[$i]->prv_value
            ) {
                # existe alteração, que poderá não ser efetivada derivado ao workflow 
                $change = true;
                if (isset($this->wkf)) {
                    if ($this->wkfMode === "postponed") {
                        $submitDML = $this->wkf->notifyThis(
                            $this->table,
                            $this->operation,
                            $this->data[$i],
                            $this->setPK($this->pk),
                            $this->data,
                            $this->cxLists,
                            $this->domains,
                            $this->wkfUpdate
                        );
                    } else {
                        $stt = $this->wkf->notifyThis(
                            $this->table,
                            $this->operation,
                            $this->data[$i],
                            $this->setPK($this->pk),
                            $this->data,
                            $this->cxLists,
                            $this->domains,
                            $this->wkfUpdate
                        );
                        $statements = array_merge($statements, $stt);
                        $submitDML = true;
                    }
                } else {
                    $submitDML = true;
                }

                if ($this->getDatetype($i) != '' && strtoupper($this->getDatetype($i)) == 'JUST_EDITOR') {
                    # existe a necessidade de forçar o upgrade igualando uma coluna da chave
                    if ($sql_body == '') {
                        if ($i > 0 ) {
                            $sql_body = $this->getColName(0)." = ".$this->getColName(0);
                        } else {
                            $sql_body = $this->getColName(1)." = ".$this->getColName(1);
                        }
                    }
                } 
                else {
                    
                    $bdColumn = $this->getColName($i);
                    $newVal = $this->data[$i]->nxt_value;
                    if ($newVal == '') {
                        $newVal = $nulo;
                    } else {
                        $dateType = $this->getDatetype($i);
                        if ($dateType) {
                            $newVal = $this->formatToDatetype(
                                $bdColumn,
                                $dateType,
                                $newVal
                            );
                        } else {
                            $newVal = "'" . str_replace("'", "''", $newVal) . "'";
                        }
                    }

                    if (!empty($this->funcFields)) {
                        if ($sql_body != '') {
                            if (
                                !empty($this->funcFields) &&
                                !in_array($bdColumn, $this->funcFields)
                            ) {
                                $sql_body .= ', ' . $bdColumn . '=' . $newVal;
                            } else {
                                $sql_body .= ', ' . $bdColumn . '=' . $newVal;
                            }
                        } else {
                            if (
                                !empty($funcFields) &&
                                !in_array($bdColumn, $this->funcFields)
                            ) {
                                $sql_body .= ' ' . $bdColumn . '=' . $newVal;
                            } else {
                                $sql_body .= ' ' . $bdColumn . '=' . $newVal;
                            }
                        }
                    } else {
                        if ($sql_body != '') {
                            $sql_body .= ', ' . $bdColumn . '=' . $newVal;
                        } else {
                            $sql_body .= ' ' . $bdColumn . '=' . $newVal;
                        }
                    }
                }
            }
        }
        # submeter o statement
        if ($submitDML) {

            ## inicializa dados para a chamadas do PRE e POST DML
            $resource = new stdClass();
            $resource->operacao = $this->operation;
            $resource->tabela = $this->table;
            # carregar dados 
            $resource->dados = new stdClass();
            foreach ($this->data as $record) {
                $resource->dados->{$record->db} = $record->nxt_value;
            }

            ## chamada ao preDML
            QuadCore_Extended::preDML($db, $resource, $msg);
            if ($msg != '') {
                QuadCore::getErrors($db, null, false, $msg);
            }
            
            # executa o statement de UPDATE
            $sql =
                $sql_hdr .
                $sql_body .
                ' WHERE 1=1 ' .
                $info['whereUpdatedRecord'];

/*$dadosOut = array(
                "error" => "UPDATE[$sql]"
            );
echo json_encode($dadosOut);
die();*/

            // Execute Statment
            try {
                $stmt = $db->prepare($sql);
                //$stmt->execute();
                array_push($statements, $stmt);
                //SELECT para devolver ao QUADTABLES/QUADFORMS o registo alvo de DML
                $select_row =
                    "SELECT " .
                    $info['columns'] .
                    " FROM " .
                    $this->table .
                    " " .
                    $this->alias .
                    ' WHERE 1=1 ' .
                    $info['whereUpdatedRecord'];
                //CALL notification center
                $retRow = $db->prepare($select_row);
                // Execute Query
                //$retRow->execute();
                array_push($statements, $retRow);

                if (isset($this->wkf) && $this->wkfMode === 'optimistic') {
                    if ($this->wkf->doWorkFlowTransaction($statements, $db)) {
                        ## chamada ao postDML
                        QuadCore_Extended::postDML($db, $resource, $msg);
                        if ($msg != '') {
                            QuadCore::getErrors($db, null, false, $msg);
                        }
                        
                        $data = $retRow->fetchAll(PDO::FETCH_ASSOC);
                        //print_r($data);
                        $dadosOut = array(
                            "data" => $data
                        );
                        echo json_encode($dadosOut);
                    }
                }
                elseif (isset($this->wkf) && $this->wkfMode === 'postponed') {
                    if ($this->wkf->doWorkFlowTransaction($sql,'',$db)) {
                        ## chamada ao postDML
                        QuadCore_Extended::postDML($db, $resource, $msg);
                        if ($msg != '') {
                            QuadCore::getErrors($db, null, false, $msg);
                        }
                        
                        $retRow->execute();
                        $data = $retRow->fetchAll(PDO::FETCH_ASSOC);
                        //print_r($data);
                        $dadosOut = array(
                            "data" => $data
                        );
                        echo json_encode($dadosOut);
                    }
                } 
                else {
                    # ORACLE REPLICATION
                    $this->exec_DML_oracle($this->table, $sql);
                    $stmt->execute();
                    
                    ## chamada ao postDML
                    QuadCore_Extended::postDML($db, $resource, $msg);
                    if ($msg != '') {
                        QuadCore::getErrors($db, null, false, $msg);
                    }
                    
                    $retRow->execute();
                    $data = $retRow->fetchAll(PDO::FETCH_ASSOC);
                    //print_r($data);
                    $dadosOut = array(
                        "data" => $data
                    );
                    echo json_encode($dadosOut);
                }
            } catch (Exception $ex) {
                QuadCore::getErrors($db, $ex);
            }
        } 
        else {
            # se não existiu qualquer coluna alterada ...
            if (!$change) { 
                $dadosOut = array(
                    "status" => "unchanged"
                );
                echo json_encode($dadosOut);
            # neste caso existiu alteração mas a mesma não é efetivada 
            # porque entrou em processo de workflow
            } else {
                $dadosOut = array(
                    "status" => "ok"
                );
                echo json_encode($dadosOut);
            }
        }
        
        if ($submitDML || $change) {
            if ($this->active_log) {
                $wkfU = '';
                if (isset($this->wkf)) {
                    $wkfU = $this->wkfUpdate;
                }
                $this->log->registoLog(
                    $this->table,
                    $this->operation,
                    $this->data[$i],
                    $this->setPK($this->pk),
                    $this->data,
                    $this->cxLists,
                    $this->domains,
                    $wkfU);
            }
        }
        
    }
    
    # executa as operações de DELETE
    # 
    # Implementa possibilidade de chamada PRE-DML e POST-DML
    public function doDelete($db, $info)
    {        
/*        
$dadosOut = array(
                "error" => 'ESTOU A FORÇAR ERRO NO DELETE'
            );
echo json_encode($dadosOut);
die();        
 */
        $statements = [];

        # constroi o statment de DELETE
        $sql_hdr = $this->operation . " FROM " . $this->table;
        $sql = $sql_hdr . ' WHERE 1=1 ' . $info['whereUpdatedRecord'];

        
        ## inicializa dados para a chamadas do PRE e POST DML
        $resource = new stdClass();
        $resource->operacao = $this->operation;
        $resource->tabela = $this->table;
        # carregar dados 
        $resource->dados = new stdClass();
        foreach ($this->data as $record) {
            $resource->dados->{$record->db} = $record->prv_value;
        }
        
        //todo is workflow postponed working different from optimistic in DELETE operation???
        # existe workflow
        if (isset($this->wkf)) {
            $submitDML = false;

            # no caso de ser um workflow em modo de postponed, só efetua a notificação,
            # não criando o registo e parando o processo em notifyUser
            # com exceção do caso em que existe uma auto-aprovação e aí a variável $submitDML é colocada a true
            # e é efetuado o DML
            if (isset($this->wkf) && $this->wkfMode === 'postponed') {
                $submitDML = $this->wkf->notifyThis(
                    $this->table,
                    'DELETE',
                    null,
                    $this->setPK($this->pk),
                    $this->data,
                    $this->cxLists,
                    $this->domains,
                    $this->wkfUpdate
                );
            } elseif (isset($this->wkf) && $this->wkfMode === 'optimistic') {
                $statements = $this->wkf->notifyThis(
                    $this->table,
                    'DELETE',
                    null,
                    $this->setPK($this->pk),
                    $this->data,
                    $this->cxLists,
                    $this->domains,
                    $this->wkfUpdate
                );

                $submitDML = true;
            } else {
                $submitDML = true;
            }

            if ($submitDML) {
                
                ## chamada ao preDML
                QuadCore_Extended::preDML($db, $resource, $msg);
                if ($msg != '') {
                    QuadCore::getErrors($db, null, false, $msg);
                }
                
                # ORACLE REPLICATION
                $this->exec_DML_oracle($this->table, $sql);

                # executa o statement
                try {
                    $stmt = $db->prepare($sql);
                    //$stmt->execute();
                    array_push($statements, $stmt);
                } catch (Exception $ex) {
                    QuadCore::getErrors($db, $ex);
                }

                if (isset($this->wkf) && $this->wkfMode === 'optimistic') {
                    if ($this->wkf->doWorkFlowTransaction($statements, $db)) {
                        
                        ## chamada ao postDML
                        QuadCore_Extended::postDML($db, $resource, $msg);
                        if ($msg != '') {
                            QuadCore::getErrors($db, null, false, $msg);
                        }
                        
                        $dadosOut = array(
                            "status" => "deleted"
                        );
                        echo json_encode($dadosOut);
                    }
                }
                elseif (isset($this->wkf) && $this->wkfMode === 'postponed') {
                    if ($this->wkf->doWorkFlowTransaction($sql,'',$db)) {
                        
                        ## chamada ao postDML
                        QuadCore_Extended::postDML($db, $resource, $msg);
                        if ($msg != '') {
                            QuadCore::getErrors($db, null, false, $msg);
                        }
                        
                        $dadosOut = array(
                            "status" => "deleted"
                        );
                        echo json_encode($dadosOut);
                    }
                }
            }
        } 
        else {

            ## chamada ao preDML
            QuadCore_Extended::preDML($db, $resource, $msg);
            if ($msg != '') {
                QuadCore::getErrors($db, null, false, $msg);
            }
            
            try {
                # ORACLE REPLICATION
                $this->exec_DML_oracle($this->table, $sql);

                $stmt = $db->prepare($sql);
                $stmt->execute();
                $dadosOut = array(
                    "status" => "deleted"
                );
                echo json_encode($dadosOut);
            } catch (Exception $ex) {
                QuadCore::getErrors($db, $ex);
            }

            ## chamada ao postDML
            QuadCore_Extended::postDML($db, $resource, $msg);
            if ($msg != '') {
                QuadCore::getErrors($db, null, false, $msg);
            }
            
        }
        
        if ($this->active_log) {
            $wkfU = '';
            if (isset($this->wkf)) {
                $wkfU = $this->wkfUpdate;
            }
            $this->log->registoLog(
                $this->table,
                'DELETE',
                null,
                $this->setPK($this->pk),
                $this->data,
                $this->cxLists,
                $this->domains,
                $wkfU);
        }
        
    }
    
}
