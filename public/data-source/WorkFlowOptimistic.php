<?php
/**
 * Created by PhpStorm.
 * User: led
 * Date: 12-02-2019
 * Time: 10:14
 */
require_once 'Workflow.php';

class WorkFlowOptimistic extends WorkFlow
{
    public $user;
    public $perfil;

    public function __construct($user, $perfil)
    {
        $this->user = $user;
        $this->perfil = $perfil;
    }

    #
    # execução de todos statments associados à aprovação/rejeição de um workflow - mode = OPTIMISTIC
    # todo o processo é executado numa só transação na base de dados
    public function doWorkFlowTransaction($statements, $conn)
    {
        $conn->beginTransaction();

        try {
            foreach ($statements as $key => $stmt) {
                try {
                    $stmt->execute();
                } catch (Exception $ex) {
                    QuadCore::getErrors($conn, $ex);
                    die();
                }
            }

            try {
                $conn->commit();
            } catch (Exception $ex) {
                QuadCore::getErrors($conn, $ex, true);
                die();
            }
        } catch (Exception $ex) {
            QuadCore::getErrors($conn, $ex);
            die();
        }

        return true;
    }

    #
    # registo de uma ocorrência de workflow - mode = OPTIMISTIC
    public function notifyThis(
        $dbTable,
        $operation,
        $column,
        $pk,
        $myArray,
        $cxLists,
        $domains,
        $wkfType
    ) {
        global $db,
            $created_by,
            $last_update_by,
            $ui_create,
            $ui_update,
            $ui_delete,
            $user,
            $perfil;
        $returnedStatements = [];
        $null = null;
        $time = date("Y-m-d H:i");
        $now = "TO_DATE('$time', 'YYYY-MM-DD hh24:mi')";
        $estado = self::INITIALSTATE;
        $pkstring = $this->getPkString($pk, $myArray);

        # tratamento do workflow
        $finished = 'N';
        $perfil_ini = '';
        $nxt_perfil = '';
        $last_perfil = '';
        $empresa = '';
        $rhid = '';
        $dt_adm = '';

        # obtenção da informação do colaborador (empresa,rhid,dt_admissão) a partir de uma chave de um registo de uma tabela
        get_info_colab($pkstring, $empresa, $rhid, $dt_adm);

        # obtenção do estado de workflow de um registo associado a uma tabela
        $this->get_workflow_registo($db, $dbTable, $this->perfil, $empresa, $rhid, $dt_adm, 
                                         $perfil_ini, $nxt_perfil, $last_perfil, $finished);        

        if ($operation == 'INSERT') {
            $data = $this->getBeforeAndAfterValues($myArray);
            $prv = json_encode($data['prvVals']);
            $nxt = json_encode($data['nxtVals']);

            //todo decode domains of $nxt
            $decodedArrayData = $data['nxtVals'];

            foreach ($data['nxtVals'] as $key => $value) {
                //todo decode domains
                $myDomains = [];
                foreach ($domains as $list => $value) {
                    if ($key === $list) {
                        $myDomains = get_object_vars($value);
                        //it is a domain
                        $memcache = new Memcached();
                        $memcache->addServer('localhost', 11211);

                        $data = json_decode(
                            $memcache->get(
                                str_replace(
                                    ' ',
                                    '',
                                    $myDomains["dependent-group"]
                                ).@$_SESSION['lang']
                            )
                        );

                        $k = array_search(
                            $column->prv_value,
                            array_column($data, 'RV_LOW_VALUE')
                        );
                        $resultAnt = $data[$k];
                        $valAnt = $resultAnt->RV_MEANING;
                        $resultAntJson = json_encode($resultAnt);

                        $k2 = array_search(
                            $column->nxt_value,
                            array_column($data, 'RV_LOW_VALUE')
                        );
                        $resultPos = $data[$k2];
                        $valPos = $resultPos->RV_MEANING;

                        $decodedArrayData->$key = $valPos;
                    }
                }

                $myCxLists = [];
                foreach ($cxLists as $list) {
                    $searchIn = isset($list['distribute-value'])
                        ? $list['distribute-value']
                        : $list['data-db-name'];
                    $arr = explode("@", $searchIn);

                    if (in_array($key, $arr)) {
                        array_push($myCxLists, $list);
                        $decodedData = $this->decodeComplexList(
                            $cxLists,
                            $key,
                            $myArray,
                            $myCxLists
                        );
                        unset($decodedArrayData->$key);
                        $field = $list["name"];
                        $decodedArrayData->$field = $decodedData[2];
                    }
                }
            }
            $nxtValDecoded = json_encode($decodedArrayData);

            ## statement para inserir registo no workflow
            $sql =  "INSERT INTO RH_ID_WORKFLOW_LOGS ".
                    "(TABELA, COLUNA, OPERACAO, PK, VLR_ANT, VLR_POS, FINISHED, PERFIL_INI, NEXT_PERFIL, LAST_PERFIL, CTXLIST_VLR_ANT, CTXLIST_VLR_POS) ".
                "VALUES(:TABELA_, :COLUNA_, :OPERACAO_, :PK_, :VLR_ANT_, :VLR_POS_, :FINISHED_, :PERFIL_INI_, :NEXT_PERFIL_, :LAST_PERFIL_, :CTXLIST_VLR_ANT_, :CTXLIST_VLR_POS_) ";
#                "INSERT INTO FO_ON_WORKFLOW (tabela, operacao, empresa,vlr_ant,vlr_pos, PK,  estado, usr_ins,perfil, dt_ins,CXLIST_VLR_APOS) " .
#                "values ('$dbTable', '$operation',  'CMIP', null,'$nxtValDecoded','$pkstring','$estado','$this->user', '$this->perfil', $now,'$nxt') ";

            # execução do statment de registo no log de workflow ($sql)
            try {
                $stmt = $db->prepare($sql);

                $stmt->bindParam(':TABELA_', $dbTable, PDO::PARAM_STR);
                $stmt->bindParam(':OPERACAO_', $operation, PDO::PARAM_STR);
                $stmt->bindParam(':PK_', $pkstring, PDO::PARAM_STR);
                $stmt->bindParam(':VLR_ANT_', $null, PDO::PARAM_NULL);
                if ($nxtValDecoded != '') {
                    $stmt->bindParam(':VLR_POS_', $nxtValDecoded, PDO::PARAM_STR);
                } else {
                    $stmt->bindParam(':VLR_POS_', $null, PDO::PARAM_NULL);
                }

                $stmt->bindParam(':FINISHED_', $finished, PDO::PARAM_STR);
                $stmt->bindParam(':PERFIL_INI_', $perfil_ini, PDO::PARAM_STR);
                if ($nxt_perfil != '') {
                    $stmt->bindParam(':NEXT_PERFIL_', $nxt_perfil, PDO::PARAM_STR);
                } else {
                    $stmt->bindParam(':NEXT_PERFIL_', $null, PDO::PARAM_NULL);
                }

                if ($last_perfil != '') {
                    $stmt->bindParam(':LAST_PERFIL_', $last_perfil, PDO::PARAM_STR);
                } else {
                    $stmt->bindParam(':LAST_PERFIL_', $null, PDO::PARAM_NULL);
                }

                $stmt->bindParam(':CTXLIST_VLR_ANT_', $null, PDO::PARAM_NULL);
                if ($nxt != '') {
                    $stmt->bindParam(':CTXLIST_VLR_POS_', $nxt, PDO::PARAM_STR);
                } else {
                    $stmt->bindParam(':CTXLIST_VLR_POS_', $null, PDO::PARAM_NULL);
                }

                array_push($returnedStatements, $stmt);
                //$stmt->execute();
            } catch (Exception $ex) {
                QuadCore::getErrors($db, $ex);
            }
            return $returnedStatements;
        }
        elseif ($operation == 'UPDATE') {
            $row_count = 0;
            //todo
            //Record is on INSERT workflow process?
            //If it's on DELETE mode, edition IS NOT ALLOWED (controled by the form)!
            //UPDATE de um registo que está em WORKFLOW de INSERT: reseta estado e identifica última alteração, com perfil de quem executa.
            /* $qry_updt = "UPDATE FO_ON_WORKFLOW set estado = :estado, last_usr = '$user', last_dt = '$now' " .
             "where tabela = '$dbTable' AND operacao = 'INSERT' AND rhid = $pkstring  ";*/

            //end todo

            $myCxLists = [];
            foreach ($cxLists as $list) {
                $searchIn = isset($list['distribute-value'])
                    ? $list['distribute-value']
                    : $list['data-db-name'];
                $arr = explode("@", $searchIn);

                if (in_array($column->db, $arr)) {
                    //if() //todo check upper level...
                    array_push($myCxLists, $list);
                }
            }

            $myDomains = [];
            foreach ($domains as $list => $value) {
                if ($column->db === $list) {
                    $myDomains = get_object_vars($value);
                }
            }

            ## statement para remover as entradas anteriores do workflow
            $delWithId = "DELETE FROM RH_ID_WORKFLOW_LOGS ".
                         "WHERE FINISHED = :FINISHED_ ".
                         "  AND REJECTED = :REJECTED_ ".
                         "  AND PERFIL_INI <= :PERFIL_ ".
                         "  AND TABELA = :TABELA_ ".
                         "  AND COLUNA = :COLUNA_ ".
                         "  AND OPERACAO = :OPERACAO_ ".
                "  AND PK = :PK_ ";

            ## statement para inserir registo no workflow
            $sql =  "INSERT INTO RH_ID_WORKFLOW_LOGS ".
                    "(TABELA, COLUNA, OPERACAO, PK, VLR_ANT, VLR_POS, FINISHED, PERFIL_INI, NEXT_PERFIL, LAST_PERFIL, CTXLIST_VLR_ANT, CTXLIST_VLR_POS) ".
                "VALUES(:TABELA_, :COLUNA_, :OPERACAO_, :PK_, :VLR_ANT_, :VLR_POS_, :FINISHED_, :PERFIL_INI_, :NEXT_PERFIL_, :LAST_PERFIL_, :CTXLIST_VLR_ANT_, :CTXLIST_VLR_POS_) ";

            //it is a domain
            if (count($myDomains) > 0) {
                $memcache = new Memcached();
                $memcache->addServer('localhost', 11211);

                $data = json_decode(
                    $memcache->get(
                        str_replace(' ', '', $myDomains["dependent-group"]).@$_SESSION['lang']
                    )
                );

                $k = array_search(
                    $column->prv_value,
                    array_column($data, 'RV_LOW_VALUE')
                );
                $resultAnt = $data[$k];
                $valAnt = $resultAnt->RV_MEANING;
                $resultAntJson = json_encode($resultAnt);

                $k2 = array_search(
                    $column->nxt_value,
                    array_column($data, 'RV_LOW_VALUE')
                );
                $resultPos = $data[$k2];
                $valPos = $resultPos->RV_MEANING;
                //subquery for delete if admin or same user and not complex list
                $colmn = $column->db;
                $resultPosJson = json_encode($resultPos);
                $qry =
                    "SELECT w.* FROM RH_ID_WORKFLOW_LOGS w ".
                    "WHERE w.PERFIL_INI <= '$perfil_ini'  ".
                    "  AND w.OPERACAO = 'UPDATE' " .
                    "  AND w.TABELA = '$dbTable' ".
                    "  AND w.COLUNA = '$colmn' ".
                    "  AND w.PK = '$pkstring' ".
                    "  AND w.FINISHED = 'N' ".
                    "  AND w.REJECTED = 'N' ";
#                    " SELECT w.* FROM FO_ON_WORKFLOW w where (w.usr_ins= '$this->user' OR w.perfil < '$this->perfil')  AND w.coluna = '$colmn' AND w.tabela = '$dbTable' AND w.operacao = 'UPDATE' " .
#                    " AND w.pk = '$pkstring' ";
                try {
                    $delWithId = "DELETE FROM RH_ID_WORKFLOW_LOGS t WHERE t.FINISHED = 'N' AND t.REJECTED = 'N' AND t.ID IN ($qry)";
#                    $delWithId = "DELETE t.* FROM FO_ON_WORKFLOW t WHERE id IN (SELECT id FROM ( $qry) x )";

                    $stmt = $db->prepare($delWithId);
                    //$stmt->execute();
                    array_push($returnedStatements, $stmt);
                } catch (Exception $ex) {
                    QuadCore::getErrors($db, $ex);
                }
                $sql =
                    "INSERT INTO RH_ID_WORKFLOW_LOGS ".
                    "(TABELA, COLUNA, OPERACAO, PK, VLR_ANT, VLR_POS, FINISHED, PERFIL_INI, NEXT_PERFIL, LAST_PERFIL, CTXLIST_VLR_ANT, CTXLIST_VLR_POS) ".
                    "VALUES('$dbTable', '$colmn', '$operation', '$pkstring', '$valAnt', '$valPos', '$finished', '$perfil_ini', '$nxt_perfil', '$last_perfil', '$resultAntJson', '$resultPosJson') ";
#                   "INSERT INTO FO_ON_WORKFLOW (tabela, operacao, coluna, empresa, pk, vlr_ant,vlr_pos,cxlist_vlr_ant, cxlist_vlr_apos,  estado, usr_ins, dt_ins,perfil) " .
#                    "values ('$dbTable', '$operation', '$colmn', 'CMIP', '$pkstring', '$valAnt', '$valPos', '$resultAntJson', '$resultPosJson', '$estado', '$this->user', $now,'$this->perfil') ";
            }

            //col is a complexList
            if (count($myCxLists) > 0) {
                /*
                                foreach ($myCxLists as &$list) {
                                  //delete all entries related to dependent group
                                    try {
                                        $delWithId = "DELETE t.* FROM FO_ON_WORKFLOW t WHERE id IN (SELECT id FROM ( $qry) x )";

                                        $stmt = $db->prepare($delWithId);
                                        $stmt->execute();
                                    } catch (Exception $ex) {
                                        QuadCore::getErrors($db, $ex);
                                    }
                                }
                                unset($list);*/
                $decodedData = $this->decodeComplexList(
                    $cxLists,
                    $column,
                    $myArray,
                    $myCxLists
                );
                $cxListValAnt = $decodedData[3][0];
                $cxListValPos = $decodedData[3][1];

                //subquery for delete if admin or same user and complexList

                foreach ($cxLists as $key => $value) {
                    //todo help on this
                    //if ($value["dependent-group"] === $myCxLists[0]["dependent-group"] && $value["dependent-level"] <= $myCxLists[0]["dependent-level"]) {
                    if (
                        $value["dependent-group"] ===
                            $myCxLists[0]["dependent-group"] &&
                        $value["dependent-level"] <=
                            $myCxLists[0]["dependent-level"]
                    ) {
                        $colmn = $value["name"];

                        $qry =
                            "SELECT w.ID FROM RH_ID_WORKFLOW_LOGS w ".
                            "WHERE w.PERFIL_INI <= '$perfil_ini' ".
                            "  AND w.TABELA = '$dbTable' ".
                            "  AND w.COLUNA = '$colmn' ".
                            "  AND w.OPERACAO = 'UPDATE' " .
                            "  AND w.pk = '$pkstring' ".
                            "  AND w.FINISHED = 'N' ".
                            "  AND w.REJECTED = 'N' ";

#                            " SELECT w.* FROM FO_ON_WORKFLOW w where (w.usr_ins= '$this->user' OR w.perfil < '$this->perfil')  AND w.coluna = '$colmn' AND w.tabela = '$dbTable' AND w.operacao = 'UPDATE' " .
#                            " AND w.pk = '$pkstring' ";
                        try {
                            $delWithId = "DELETE FROM RH_ID_WORKFLOW_LOGS t WHERE t.FINISHED = 'N' AND t.REJECTED = 'N' AND t.ID IN ($qry)";
#                            $delWithId = "DELETE t.* FROM FO_ON_WORKFLOW t WHERE id IN (SELECT id FROM ( $qry) x )";

                            $stmt = $db->prepare($delWithId);
                            //$stmt->execute();
                            array_push($returnedStatements, $stmt);
                        } catch (Exception $ex) {
                            QuadCore::getErrors($db, $ex);
                        }
                    }
                }

                $sql =
                    "INSERT INTO RH_ID_WORKFLOW_LOGS ".
                    "(TABELA, COLUNA, OPERACAO, PK, VLR_ANT, VLR_POS, FINISHED, PERFIL_INI, NEXT_PERFIL, LAST_PERFIL, CTXLIST_VLR_ANT, CTXLIST_VLR_POS) ".
                    "VALUES('$dbTable', '$decodedData[0]', '$operation', '$pkstring', '$decodedData[1]', '$decodedData[2]', '$finished', '$perfil_ini', '$nxt_perfil', '$last_perfil', '$cxListValAnt', '$cxListValPos') ";
#                    "INSERT INTO FO_ON_WORKFLOW (tabela, operacao, coluna, empresa, pk, vlr_ant,vlr_pos,cxlist_vlr_ant, cxlist_vlr_apos,  estado, usr_ins, dt_ins,perfil) " .
#                    "values ('$dbTable', '$operation', '$decodedData[0]', 'CMIP', '$pkstring', '$decodedData[1]', '$decodedData[2]', '$cxListValAnt', '$cxListValPos', '$estado', '$this->user', $now,'$this->perfil') ";
            }

            if (count($myCxLists) === 0 && count($myDomains) === 0) {
                //its not a domain neither a complex list
                //subquery for delete if admin or same user and not complex list
                $qry =
                    "SELECT w.* FROM RH_ID_WORKFLOW_LOGS w ".
                    "WHERE w.PERFIL_INI <= '$this->perfil' ".
                    "  AND w.TABELA = '$dbTable' ".
                    "  AND w.COLUNA = '$column->db' ".
                    "  AND w.OPERACAO = 'UPDATE' " .
                    "  AND w.pk = '$pkstring' ".
                    "  AND w.FINISHED = 'N' ".
                    "  AND w.REJECTED = 'N' ";

#                    " SELECT w.* FROM FO_ON_WORKFLOW w where (w.usr_ins= '$this->user' OR w.perfil < '$this->perfil') AND w.coluna = '$column->db' AND w.tabela = '$dbTable' AND w.operacao = 'UPDATE' " .
#                    " AND w.pk = '$pkstring' ";

                ## statment para inserir registo no workflow
                $sql =
                    "INSERT INTO RH_ID_WORKFLOW_LOGS ".
                    "(TABELA, COLUNA, OPERACAO, PK, VLR_ANT, VLR_POS, FINISHED, PERFIL_INI, NEXT_PERFIL, LAST_PERFIL) ".
                    "VALUES('$dbTable', '$column->db', '$operation', '$pkstring', '$column->prv_value', '$column->nxt_value', '$finished', '$perfil_ini', '$nxt_perfil', '$last_perfil') ";
#                    "INSERT INTO FO_ON_WORKFLOW (tabela, operacao, coluna, empresa, pk, vlr_ant, vlr_pos,  estado, usr_ins, dt_ins,perfil) " .
#                    "values ('$dbTable', '$operation', '$column->db', 'CMIP', '$pkstring',  '$column->prv_value', '$column->nxt_value', '$estado', '$this->user', $now,'$this->perfil') ";

                ## preparação dos statments para inserir registo no workflow
                try {
                    $delWithId = "DELETE FROM RH_ID_WORKFLOW_LOGS t WHERE t.FINISHED = 'N' AND t.REJECTED = 'N' AND t.ID IN ($qry)";
#                    $delWithId = "DELETE t.* FROM FO_ON_WORKFLOW t WHERE id IN (SELECT id FROM ( $qry) x )";

                    $stmt = $db->prepare($delWithId);
                    //$stmt->execute();
                    array_push($returnedStatements, $stmt);
                } catch (Exception $ex) {
                    QuadCore::getErrors($db, $ex);
                }
            }
            # execução dos statments
            try {
                $stmt = $db->prepare($sql);
                //$stmt->execute();
                array_push($returnedStatements, $stmt);
            } catch (Exception $ex) {
                QuadCore::getErrors($db, $ex);
            }
            return $returnedStatements;
            //}
        } 
        elseif ($operation == 'DELETE') {
            $data = $this->getBeforeAndAfterValues($myArray);
            $prv = json_encode($data['prvVals']);
            $nxt = json_encode($data['nxtVals']);

            ## statment para inserir registo no workflow
            $sql =
                "INSERT INTO RH_ID_WORKFLOW_LOGS ".
                "(TABELA, OPERACAO, PK, VLR_ANT, VLR_POS, FINISHED, PERFIL_INI, NEXT_PERFIL, LAST_PERFIL) ".
                "VALUES(:TABELA_, :OPERACAO_, :PK_, :VLR_ANT_, :VLR_POS_, :FINISHED_, :PERFIL_INI_, :NEXT_PERFIL_, :LAST_PERFIL_) ";
#                "INSERT INTO FO_ON_WORKFLOW (tabela, operacao, empresa, PK, vlr_ant,vlr_pos ,  usr_ins,perfil, dt_ins,estado, last_usr, last_dt) " .
#                "values ('$dbTable', '$operation', '$empresa','$pkstring','$prv', '$nxt', '$this->user', '$this->perfil',$now,'$estado' ,null, null) ";


            ## statment para remover as entradas anteriores do workflow
            $delWithId = "DELETE FROM RH_ID_WORKFLOW_LOGS ".
                         "WHERE FINISHED = :FINISHED_ ".
                         "  AND REJECTED = :REJECTED_ ".
                         "  AND PERFIL_INI <= :PERFIL_ ".
                         "  AND TABELA = :TABELA_ ".
                "  AND PK = :PK_ ";

#           $qry = "SELECT w.* FROM FO_ON_WORKFLOW w where ( w.perfil < '$this->perfil' || w.usr_ins='$this->user')  AND w.tabela = '$dbTable' AND w.pk = '$pkstring' ";
#           $delWithId = "DELETE t.* FROM FO_ON_WORKFLOW t WHERE id IN (SELECT id FROM ( $qry) x )";

            try {
                $stmt = $db->prepare($delWithId);
                $no = 'N';
                $stmt->bindParam(':FINISHED_', $no, PDO::PARAM_STR);
                $stmt->bindParam(':REJECTED_', $no, PDO::PARAM_STR);
                $stmt->bindParam(':PERFIL_', $perfil_ini, PDO::PARAM_STR);
                $stmt->bindParam(':TABELA_', $dbTable, PDO::PARAM_STR);
                $stmt->bindParam(':PK_', $pkstring, PDO::PARAM_STR);
                array_push($returnedStatements, $stmt);

                //$stmt->execute();
                try {
                    $stmt = $db->prepare($sql);

                    $stmt->bindParam(':TABELA_', $dbTable, PDO::PARAM_STR);
                    $stmt->bindParam(':OPERACAO_', $operation, PDO::PARAM_STR);
                    $stmt->bindParam(':PK_', $pkstring, PDO::PARAM_STR);

                    if ($prv != '') {
                        $stmt->bindParam(':VLR_ANT_', $prv, PDO::PARAM_STR);
                    } else {
                        $stmt->bindParam(':VLR_ANT_', $null, PDO::PARAM_NULL);
                    }

                    if ($nxt != '') {
                        $stmt->bindParam(':VLR_POS_', $nxt, PDO::PARAM_STR);
                    } else {
                        $stmt->bindParam(':VLR_POS_', $null, PDO::PARAM_NULL);
                    }

                    $stmt->bindParam(':FINISHED_', $finished, PDO::PARAM_STR);
                    $stmt->bindParam(':PERFIL_INI_', $perfil_ini, PDO::PARAM_STR);
                    if ($nxt_perfil != '') {
                        $stmt->bindParam(':NEXT_PERFIL_', $nxt_perfil, PDO::PARAM_STR);
                    } else {
                        $stmt->bindParam(':NEXT_PERFIL_', $null, PDO::PARAM_NULL);
                    }

                    if ($last_perfil != '') {
                        $stmt->bindParam(':LAST_PERFIL_', $last_perfil, PDO::PARAM_STR);
                    } else {
                        $stmt->bindParam(':LAST_PERFIL_', $null, PDO::PARAM_NULL);
                    }

                    array_push($returnedStatements, $stmt);
                    //$stmt->execute();
                } catch (Exception $ex) {
                    QuadCore::getErrors($db, $ex);
                }
            } catch (Exception $ex) {
                QuadCore::getErrors($db, $ex);
            }
            return $returnedStatements;
        }
    }

    #
    # rejeição de uma ocorrência de workflow - mode = OPTIMISTIC
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
    )
    {
        $nr_ordem_wkf = '';
        $last_perfil = '';
        $tp_perfil = @$_SESSION['perfil'];
        $this->get_id_tp_perfil($db, $tp_perfil, $last_perfil, $nr_ordem_wkf);
        $qry =
            "UPDATE RH_ID_WORKFLOW_LOGS ".
            "SET REJECTED = 'S' ".
            "   ,LAST_PERFIL  = '$last_perfil' ".
            "WHERE ID = $id ".
            "  AND TABELA = '$table' ".
            "  AND FINISHED = 'N' ".
            "  AND REJECTED = 'N' ";
#        $qry = "UPDATE FO_ON_WORKFLOW SET estado = $estado  , LAST_DT=$now  where id=$id AND tabela = '$table' ";
        $where = $this->getWhereClause($pk, $res['PK'], $dbCols);
        if ($res['OPERACAO'] === 'INSERT' || $res['OPERACAO'] === 'DELETE') {
            $vals = '(';
            $cols = '(';
            $str = (string)$res['CTXLIST_VLR_ANT'];
            $arr = json_decode($str, true);
            $index = 0;
            $count = count($arr);
            if ($res['OPERACAO'] === 'INSERT') {
                foreach ($arr as $key => $value) {
                    $entry = array_filter($dbCols, function ($e) use ($key) {
                        return $e->db == $key;
                    });
                    if ($value) {
                        $cols .= $key;
                        if (
                            isset($entry[$index]->datatype) &&
                            mb_strtoupper($entry[$index]->datatype) !==
                                "SEQUENCE"
                        ) {
                            $datatype = mb_strtoupper($entry[$index]->datatype);
                            $value = QuadCore::formatToDatetype(
                                $key,
                                $datatype,
                                $value
                            );
                            $vals .= $value;
                        } else {
                            $vals .= "'$value'";
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

                $qry2 = "INSERT INTO $table $cols values $vals";
            } elseif ($res['OPERACAO'] === 'DELETE') {
                $qry2 = "DELETE FROM $table WHERE $where ";
            }
        } else {
            //is an update of field

            $myCxLists = [];
            foreach ($cxLists as $list) {
                if ($list['name'] === $res['COLUNA']) {
                    array_push($myCxLists, $list);
                }
            }

            $myDomains = [];
            foreach (json_decode($domains) as $list => $value) {
                if ($res['COLUNA'] === $list) {
                    $myDomains = get_object_vars($value);
                }
            }
            if (count($myDomains) > 0) {
                //is a domain
            }
            if (count($myCxLists) > 0) {
                //is a list
                //$arr = explode('@', $myCxLists[0]['data-db-name']);

                $values = json_decode($res['CTXLIST_VLR_ANT']);
                $statement = '';
                foreach ($values as $key => $value) {
                    $entry = array_filter($dbCols, function ($e) use ($key) {
                        return $e->db == $key;
                    });
                    $entry = reset($entry);
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
                $statement = rtrim($statement, ',');
                $qry2 = "UPDATE $table set $statement where $where ";
            } else {
                $col = $res['COLUNA'];
                $entry = array_filter($dbCols, function ($e) use ($col) {
                    return $e->db == $col;
                });
                $entry = reset($entry);
                if (
                    isset($entry->datatype) &&
                    mb_strtoupper($entry->datatype) !== "SEQUENCE"
                ) {
                    $val = QuadCore::formatToDatetype(
                        $col,
                        $entry->datatype,
                        $res['VLR_ANT']
                    );
                } else {
                    $v = $res['VLR_ANT'];
                    $val = "'$v'";
                }

                $qry2 = "UPDATE $table set $col= $val where $where ";
            }

            if (
                $this->doWorkFlowTransaction(
                    [$db->prepare($qry2), $db->prepare($qry)],
                    $db
                )
            ) {
                if (!$bulKAction) {
                    echo $this->returnRecordAfterWkf(
                        $db,
                        $table,
                        $where,
                        $dbCols,
                        $res[0]['OPERACAO']
                    );
                }
            }
        }
    }

    #
    # aprovação de uma ocorrência de workflow - mode = OPTIMISTIC
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
        $domains
        )
        {
        $statements = [];
        $where = $this->getWhereClause($pk, $res['PK'], $dbCols);
        $estado = Workflow::APROOVED;

        # tratamento do workflow
        $finished = 'N';
        $perfil_ini = '';
        $nxt_perfil = '';
        $last_perfil = '';
        $empresa = '';
        $rhid = '';
        $dt_adm = '';

        get_info_colab($res['PK'], $empresa, $rhid, $dt_adm);
            $this->get_workflow_registo($db, $table, $this->perfil, $empresa, $rhid, $dt_adm, 
                                             $perfil_ini, $nxt_perfil, $last_perfil, $finished);    

        if ($perfil_ini == $last_perfil) {
            $qry =
                    "UPDATE RH_ID_WORKFLOW_LOGS ".
                    "SET LAST_PERFIL = '$last_perfil' ".
                    "   ,FINISHED = '$finished' ".
                    "WHERE ID = $id ".
                    "  AND TABELA = '$table' ".
                    "  AND FINISHED = 'N' ".
                "  AND REJECTED = 'N' ";
        } else {
            $qry =
                    "UPDATE RH_ID_WORKFLOW_LOGS ".
                    "SET NEXT_PERFIL = '$nxt_perfil' ".
                    "   ,LAST_PERFIL = '$last_perfil' ".
                    "   ,FINISHED = '$finished' ".
                    "WHERE ID = $id ".
                    "  AND TABELA = '$table' ".
                    "  AND FINISHED = 'N' ".
                "  AND REJECTED = 'N' ";
        }
#              "UPDATE FO_ON_WORKFLOW SET estado = $estado , LAST_DT=$now  where id=$id AND tabela = '$table' ";
        array_push($statements, $db->prepare($qry));
        if ($res['OPERACAO'] === 'INSERT' || $res['OPERACAO'] === 'DELETE') {
            if ($res['OPERACAO'] === 'INSERT') {
            } elseif ($res['OPERACAO'] === 'DELETE') {
                $qry2 = "DELETE FROM $table WHERE $where ";
                array_push($statements, $db->prepare($qry2));
            }
        } else {
            //todo redundant operation
            $col = $res['COLUNA'];
            $val = $res['VLR_POS'];
            $where = $this->getWhereClause($pk, $res['PK'], $dbCols);
            $qry2 = "UPDATE $table SET $col= '$val' where $where ";
            array_push($statements, $db->prepare($qry2));
        }

        if ($this->doWorkFlowTransaction($statements, $db)) {
            if (!$bulKAction) {
                echo $this->returnRecordAfterWkf(
                    $db,
                    $table,
                    $where,
                    $dbCols,
                    $res[0]['OPERACAO']
                );
            }
        }
    }

    #
    # aprovação massiva das ocorrências de workflows para uma tabela - mode = OPTIMISTIC
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
                true
            );
        }
        $where = $this->getWhereClause($pk, $res['PK'], $dbCols);
        echo $this->returnRecordAfterWkf(
            $db,
            $table,
            $where,
            $dbCols,
            $res[0]['OPERACAO']
        );
    }

    #
    # rejeição massiva das ocorrências de workflows para uma tabela - mode = OPTIMISTIC
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
            echo $this->rejectWorkFlow(
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
        $where = $this->getWhereClause($pk, $res['PK'], $dbCols);
        $this->returnRecordAfterWkf(
            $db,
            $table,
            $where,
            $dbCols,
            $res[0]['OPERACAO']
        );
    }
}
