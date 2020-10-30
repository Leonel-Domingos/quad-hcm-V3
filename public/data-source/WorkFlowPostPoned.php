<?php
require_once 'QuadCore.php';
require_once 'QuadCore_Extended.php';
require_once 'Workflow.php';

class WorkFlowPostPoned extends WorkFlow
{
    public $user;
    public $perfil;

    public function __construct($user, $perfil)
    {
        $this->user = $user;
        $this->perfil = $perfil;
    }

    #
    # rejeição de uma ocorrência de workflow - mode = POSTPONED
    public function rejectWorkFlow(
        $id,
        $table,
        $workFlow,
        $db,
        $now,
        $res,
        $pk,
        $dbCols,
        $bulKAction,
        $cxLists,
        $domains
    ) {
        $nr_ordem_wkf = '';
        $last_perfil = '';

        # obtém a identificação do perfil que está a rejeitar o registo
        $tp_perfil = @$_SESSION['perfil'];
        $this->get_id_tp_perfil($db, $tp_perfil, $last_perfil, $nr_ordem_wkf);

        # sinalização do workflow como rejeitado
        $qry =
            "UPDATE RH_ID_WORKFLOW_LOGS " .
            "SET REJECTED = :REJECTED_RES_ " .
            "   ,LAST_PERFIL  = :LAST_PERFIL_ " .
            "WHERE ID = :ID_ " .
            "  AND TABELA = :TABELA_ " .
            "  AND FINISHED = :FINISHED_ " .
            "  AND REJECTED = :REJECTED_ ";
        #           "UPDATE FO_ON_WORKFLOW SET estado = $estado , LAST_DT=$now  where id=$id AND tabela = '$table' ";
        try {
            $stmt = $db->prepare($qry);
            
            $yes = 'S';
            $no = 'N';
            $stmt->bindParam(':REJECTED_RES_', $yes, PDO::PARAM_STR);
            $stmt->bindParam(':LAST_PERFIL_', $last_perfil, PDO::PARAM_STR);
            $stmt->bindParam(':ID_', $id, PDO::PARAM_STR);
            $stmt->bindParam(':TABELA_', $table, PDO::PARAM_STR);
            $stmt->bindParam(':FINISHED_', $no, PDO::PARAM_STR);
            $stmt->bindParam(':REJECTED_', $no, PDO::PARAM_STR);

            $stmt->execute();
        } catch (Exception $ex) {
            QuadCore::getErrors($db, $ex);
        }

        # devolução da informação da operação de rejeição
        if ($res['OPERACAO'] === 'INSERT' || $res['OPERACAO'] === 'DELETE') {
            if ($res['OPERACAO'] === 'INSERT') {
                //return;
                $dadosOut = array(
                    "status" => "rejected",
                    "workflow" => true
                );
                echo json_encode($dadosOut);
            } elseif ($res['OPERACAO'] === 'DELETE') {
                $dadosOut = array(
                    "status" => "rejected",
                    "workflow" => true
                );
                echo json_encode($dadosOut);
            }
            die();
        } else {
            //return;
            $dadosOut = array(
                "status" => "rejected",
                "workflow" => true
            );
            echo json_encode($dadosOut);
        }
    }

    #
    # aprovação de uma ocorrência de workflow - mode = POSTPONED
    public function aprooveWorkFlow(
        $id,
        $table,
        $workFlow,
        $db,
        $now,
        $res,
        $pk,
        $dbCols,
        $bulKAction,
        $cxLists,
        $domains,
        $finished = "N",
        $event = false,
        $userTrigered = false
    ) {
        $where = $this->getWhereClause($pk, $res['PK'], $dbCols);
        $estado = Workflow::APROOVED;

        # tratamento do workflow
        //$finished = 'N';
        $perfil_ini = '';
        $nxt_perfil = '';
        $last_perfil = '';
        $empresa = '';
        $rhid = '';
        $dt_adm = '';

        # obtenção da informação do colaborador (empresa,rhid,dt_admissão) a partir de uma chave de um registo de uma tabela
        $this->get_info_colab($res['PK'], $empresa, $rhid, $dt_adm);
        # obtenção do estado de workflow de um registo associado a uma tabela
        $this->get_workflow_registo(
            $db,
            $table,
            $this->perfil,
            $empresa,
            $rhid,
            $dt_adm,
            $perfil_ini,
            $nxt_perfil,
            $last_perfil,
            $finished
        );

        # se o perfil é o último a pronunciar-se sobre o workflow
        /*$nxt_perfil == $last_perfil ? ($finished = "S") : ($finished = "N");
        if ($finished = "N") {
            $perfil_ini == $last_perfil ? ($finished = "S") : ($finished = "N");
        }*/
        if ($perfil_ini == $last_perfil) {
            $qry =
                "UPDATE RH_ID_WORKFLOW_LOGS " .
                "SET LAST_PERFIL = '$last_perfil' " .
                "   ,FINISHED = '$finished' " .
                "WHERE ID = $id " .
                "  AND TABELA = '$table' " .
                "  AND FINISHED = 'N' " .
                "  AND REJECTED = 'N' ";
        }
        # caso contrário atualiza a informação de workflow em conformidade
        else {
            $qry =
                "UPDATE RH_ID_WORKFLOW_LOGS " .
                "SET NEXT_PERFIL = '$nxt_perfil' " .
                "   ,LAST_PERFIL = '$last_perfil' " .
                "   ,FINISHED = '$finished' " .
                "WHERE ID = $id " .
                "  AND TABELA = '$table' " .
                "  AND FINISHED = 'N' " .
                "  AND REJECTED = 'N' ";
        }

        # só executa a ação (INSERT/UPDATE/DELETE) quando atinge o final da cadeia de aprovação => $finished = 'S'
        $qry2 = '';
        if ($finished == 'S' && $event) {
            
            ## tabela utiliza versão extendida do QuadCore ?
            if (QuadCore::extendedTable($table) == 'S') {
                
                ## inicializa dados para a chamadas do PRE e POST DML
                $resource = new stdClass();
                $resource->operacao = $res['OPERACAO'];
                $resource->tabela = $table;
                # carregar dados 
                $resource->dados = new stdClass();
                if ($resource->operacao === 'DELETE') {
                    foreach ($dbCols as $record) {
                        $resource->dados->{$record->db} = $record->prv_value;
                    }
                } else {
                    foreach (json_decode($res['CTXLIST_VLR_POS']) as $key => $value) {
                        $resource->dados->{$key} = $value;
                    }
                }

                ## chamada ao preDML
                QuadCore_Extended::preDML($db, $resource, $msg);
                if ($msg != '') {
                    QuadCore::getErrors($db, null, false, $msg);
                }
            }
            
            # criação do statement de inserção ou remoção de registo
            if (
                $res['OPERACAO'] === 'INSERT' ||
                $res['OPERACAO'] === 'DELETE'
            ) {
                $vals = '(';
                $cols = '(';
                $str = (string) $res['VLR_POS'];
                $arr = json_decode($str, true);
                $index = 0;
                $count = 0;

                if ($res['BD_DOC_POS']) {
                    $arr["BD_DOC"] =":blob" ;
                    $arr["LINK_DOC"] = $res["LINK_DOC_POS"];
                    $arr["BD_MIME"] =$res["BD_MIME_POS"];
                }
                if ($arr) {
                    $count = count($arr);
                }
                if ($res['OPERACAO'] === 'INSERT') {
                    foreach ($arr as $key => $value) {
                        $entry = array_filter($dbCols, function ($e) use (
                            $key
                        ) {
                            return $e->db == $key;
                        });
                        
                        # as colunas do tipo JUST_EDITOR não são incluídas no return...
                        if (
                            isset($entry[$index]->datatype) &&
                            mb_strtoupper($entry[$index]->datatype) ==
                                "JUST_EDITOR"
                        ) {
                            $count--;
                            $index++;
                            if ($index == $count) {
                                $cols .= ')';
                                $vals .= ')';
                            }
                        } else {
                            if ($value) {
                                $cols .= $key;
                                if (
                                    isset($entry[$index]->datatype) &&
                                    mb_strtoupper($entry[$index]->datatype) !==
                                        "SEQUENCE"
                                ) {
                                    $datatype = mb_strtoupper(
                                        $entry[$index]->datatype
                                    );
                                    $value = QuadCore::formatToDatetype(
                                        $key,
                                        $datatype,
                                        $value
                                    );
                                    $vals .= $value;
                                } else {
                                    if ($key === "BD_DOC"){
                                        $vals .= "$value";//a bind nao precisa das plicas a indicar uma string
                                    }
                                    else{
                                        $vals .= "'$value'";
                                    }
                                }
                            }
                            $index++;
                            if ($index == $count) {
                                $cols = rtrim($cols, ',');
                                $vals = rtrim($vals, ',');
                                $cols .= ')';
                                $vals .= ')';
                            } else {
                                if ($value) {
                                    $cols .= ',';
                                    $vals .= ',';
                                }
                            }
                        }
                    }
                    
                    if ($res['BD_DOC_POS']) {
                        if ($this->validBase64($res["BD_DOC_POS"])) {
                            
                            //this is a string ...should get the file registered in the wkf table if user trigger the event(ui aproove event)
                            if ($userTrigered) {
                                $sql = "SELECT * FROM RH_ID_WORKFLOW_LOGS WHERE ID = $id";
                                $stmt = $db->prepare($sql);
                                $stmt->execute();
                                $wkfRecordInfo = $stmt->fetch(PDO::FETCH_ASSOC);
                                $v = $wkfRecordInfo["BD_DOC_POS"];
                            } else {
                                $v = base64_decode($res["BD_DOC_POS"]); //just keeping old code... flow is ruled by $userTrigered parameter
                            }
                        } else {
                            $v = $res["BD_DOC_POS"];
                        }
                        $myquery="INSERT INTO $table $cols values $vals";
                        $qry2=$db->prepare($myquery);
                        $qry2->bindParam(':blob', $v, PDO::PARAM_LOB);
                    }
                    else{
                        $qry2 = "INSERT INTO $table $cols values $vals";
                    }
                } 
                elseif ($res['OPERACAO'] === 'DELETE') {
                    $qry2 = "DELETE FROM $table WHERE $where ";
                }
            }
            # criação do statement de atualização de registo
            else {
                //is an update of field
                $myCxLists = [];
                foreach ($cxLists as $list) {
                    if ($list['name'] === $res['COLUNA']) {
                        array_push($myCxLists, $list);
                    }
                }
                $myDomains = [];
                if (!empty($domains)) {
                    if (is_string($domains)) {
                        foreach (json_decode($domains) as $list => $value) {
                            if ($res['COLUNA'] === $list) {
                                $myDomains = get_object_vars($value);
                            }
                        }
                    } elseif (is_object($domains)) {
                        foreach ($domains as $list => $value) {
                            if ($res['COLUNA'] === $list) {
                                $myDomains = get_object_vars($value);
                            }
                        }
                    }
                }
                if (count($myDomains) > 0) {
                    //is a domain
                }
                if (count($myCxLists) > 0) {
                    //is a list
                    //$arr = explode('@', $myCxLists[0]['data-db-name']);

                    $values = json_decode($res['CTXLIST_VLR_POS']);
                    $statement = '';
                    foreach ($values as $key => $value) {
                        $entry = array_filter($dbCols, function ($e) use (
                            $key
                        ) {
                            return $e->db == $key;
                        });
                        $entry = reset($entry);
                        # as colunas do tipo JUST_EDITOR não são incluídas no return...
                        if (
                            isset($entry->datatype) &&
                            mb_strtoupper($entry->datatype) == "JUST_EDITOR"
                        ) {
                            null;
                        }
                        else {                        
                            if (
                                isset($entry->datatype) &&
                                mb_strtoupper($entry->datatype) !== "SEQUENCE"
                            ) {
                                $value = QuadCore::formatToDatetype(
                                    $key,
                                    mb_strtoupper($entry->datatype),
                                    $value
                                );
                            } else {
                                $value = "'$value'";
                            }
                            $statement .= "$key = $value,";
                        }
                    }
                    $statement = rtrim($statement, ',');
                    $qry2 = "UPDATE $table set $statement where $where ";
                } 
                else {
                    $col = $res['COLUNA'];
                    $entry = array_filter($dbCols, function ($e) use ($col) {
                        return $e->db == $col;
                    });
                    $entry = reset($entry);

                    // se for um update de uma instância com workflow ao registo
                    if (is_object(json_decode($res['VLR_POS']))) {
                        # as colunas do tipo JUST_EDITOR não são incluídas no return...
                        if (
                            isset($entry->datatype) &&
                            mb_strtoupper($entry->datatype) == "JUST_EDITOR"
                        ) {
                            null;
                        }
                        else {
                            $v = json_decode($res['VLR_POS']);
                            if (
                                isset($entry->datatype) &&
                                mb_strtoupper($entry->datatype) !== "SEQUENCE"
                            ) {
                                $val = QuadCore::formatToDatetype(
                                    $col,
                                    $entry->datatype,
                                    $v->$col
                                );
                            } else {
                                $val ="'".$v->$col."'";
                            }
                        }
                    // se for um update de uma instância com workflow à coluna
                    } 
                    else {
                        # as colunas do tipo JUST_EDITOR não são incluídas no return...
                        if (
                            isset($entry->datatype) &&
                            mb_strtoupper($entry->datatype) == "JUST_EDITOR"
                        ) {
                            null;
                        }
                        else {
                            $v = $res['VLR_POS'];
                            if (
                                isset($entry->datatype) &&
                                mb_strtoupper($entry->datatype) !== "SEQUENCE"
                            ) {
                                $val = QuadCore::formatToDatetype(
                                    $col,
                                    $entry->datatype,
                                    $v
                                );
                            } else {
                                $val ="'".$v."'";
                            }
                        }
                    }
                    if ($col === "BD_DOC") {
                        $v = base64_decode($res["BD_DOC_POS"]);

                        $linkdoc=$res["LINK_DOC_POS"];
                        $bdmime=$res["BD_MIME_POS"];
                        $myqry2 = "UPDATE $table set $col = :media , LINK_DOC = '$linkdoc' , BD_MIME = '$bdmime'   where $where ";
                        $qry2 = $db->prepare($myqry2);
                        $qry2->bindParam(':media', $v, PDO::PARAM_LOB);

                    } else {
                        $qry2 = "UPDATE $table set $col= $val where $where ";
                    }                    
                }
            }
        }

        # executa os statments associadas à operação de aprovação de workflow
        if (!$bulKAction) {
            if ($this->doWorkFlowTransaction($qry2, $qry, $db)) {
                if ($event === true && $finished == 'S') {

                    ## tabela utiliza versão extendida do QuadCore ?
                    if (QuadCore::extendedTable($table) == 'S') {
                        ## chamada ao postDML
                        QuadCore_Extended::postDML($db, $resource, $msg);
                        if ($msg != '') {
                            QuadCore::getErrors($db, null, false, $msg);
                        }
                    }                    
                    
                    echo $this->returnRecordAfterWkf(
                        $db,
                        $table,
                        $where,
                        $dbCols,
                        $res['OPERACAO'],
                        $res['COLUNA']
                    );

                    die();
                } elseif ($event === true && $finished == 'N') {
                    $this->notifyUser('');
                } else {
                    return true;
                }
             }  else {
                return false;
             }
        } else {
            return false;
        }
    }

    #
    # aprovação massiva das ocorrências de workflows para uma tabela - mode = POSTPONED
    public function aprooveWorkFlowBulk(
        $id,
        $table,
        $workFlow,
        $db,
        $wkfList,
        $now,
        $pk,
        $dbCols,
        $cxLists
    ) {
        foreach ($wkfList as $key => $value) {
            $res = [];
            $res[0] = $value;
            $this->aprooveWorkFlow(
                $value['ID'],
                $table,
                $workFlow,
                $db,
                $now,
                $res,
                $pk,
                $dbCols,
                true,
                $cxLists
            );
        }
        $where = $this->getWhereClause($pk, $res[0]['RHID'], $dbCols);
        echo $this->returnRecordAfterWkf(
            $db,
            $table,
            $where,
            $dbCols,
            $res[0]['OPERACAO']
        );
    }

    #
    # rejeição massiva das ocorrências de workflows para uma tabela - mode = POSTPONED
    public function rejectWorkFlowBulk(
        $id,
        $table,
        $workFlow,
        $db,
        $wkfList,
        $now,
        $pk,
        $dbCols,
        $cxLists
    ) {
        //todo delete record with pk
        foreach (array_reverse($wkfList) as $key => $value) {
            $res = [];
            $res[0] = $value;
            $this->rejectWorkFlow(
                $value['ID'],
                $table,
                $workFlow,
                $db,
                $now,
                $res,
                $pk,
                $dbCols,
                true
            );
        }
        $where = $this->getWhereClause($pk, $res[0]['RHID'], $dbCols);
        echo $this->returnRecordAfterWkf(
            $db,
            $table,
            $where,
            $dbCols,
            $res[0]['OPERACAO']
        );
    }

    #
    # notificação do utilizador após registo de workflow em modo postponed
    public function notifyUser($info) {
        $dadosOut = array(
            "status" => "ok",
            "workflow" => true
        );
        json_encode($dadosOut);
        # para a execução de forma a não executar o statement associado
        die(json_encode($dadosOut));
    }

    public function validBase64($string) {
        return (bool) preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $string);
}
}
