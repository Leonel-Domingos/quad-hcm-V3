<?php
require_once 'QuadUploads.php';
require_once 'WorkFlowPostPoned.php';

class WorkFlowPostPonedUploads extends WorkFlowPostPoned
{
    public function __construct($user, $perfil, $Upload)
    {
        parent::__construct($user, $perfil);
        $this->Upload = $Upload;
    }

    public function getBeforeAndAfterValues($myArray, $db = false)
    {
        $rowData1 = new stdClass();
        $rowData2 = new stdClass();

        for ($i = 0; $i < count($myArray); $i++) {
            $field = $myArray[$i]->db;
            $fieldValue = $myArray[$i]->prv_value;
            $rowData1->$field = $fieldValue;
            $field = $myArray[$i]->db;
            $fieldValue = $myArray[$i]->nxt_value;
            $rowData2->$field = $fieldValue;
        }
        $data = [];
        $data['prvVals'] = $rowData1;
        $data['nxtVals'] = $rowData2;

        $file = array();
        if (array_key_exists('upload', @$_FILES)) {
        $file = $_FILES["upload"];
        }

        if (
            !isset($this->Upload->docsTable) &&
            isset($this->Upload->blob_embedded)
        ) {
            $tempFile = '';
            if (array_key_exists('tmp_name', $file)) {
            $tempFile = $file["tmp_name"][0];
            }
            if (is_uploaded_file($tempFile)) {
                if (
                    !isset($this->Upload->docsTable) &&
                    isset($this->Upload->blob_embedded)
                ) {
                    $doc = file_get_contents($tempFile);
                    $tmpBlobRecord = $this->getTmpBlobRecord($db, $doc);
                    $ext = pathinfo($file["name"][0], PATHINFO_EXTENSION);
                    if ($this->Upload->blob_embedded) {
                       // if ($this->Upload->blob_embedded->display) {
                            if ($db) {
                            $bddoc = $this->Upload->blob_embedded->blobField;
                                $data['nxtVals']->$bddoc =
                                    $tmpBlobRecord["BD_DOC_ANT"];
                            }
                       // }
                        $linkdoc = $this->Upload->blob_embedded->fileNameField;
                        $data['nxtVals']->$linkdoc = $file["name"][0];
                        $bdmime = $this->Upload->blob_embedded->extField;
                        $data['nxtVals']->$bdmime = $ext;
                    } else {
                        //todo not blob not embedded
                    }
                } else {
                    $targetPath =
                        dirname(__FILE__) .
                        '/../' .
                        $this->Upload->blob_embedded->savePath;

                    $targetPath .= '/' . $file["name"][0];

                    move_uploaded_file($tempFile, $targetPath);
                }
            }
        }
        return $data;
    }

    public function notifyThisUpload(
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
        $wkf_info = '';

        # obtem informação do colaborador
        $this->get_info_colab($pkstring, $empresa, $rhid, $dt_adm);
        # obtem estado de workflow do registo
        $this->get_workflow_registo(
            $db,
            $dbTable,
            $this->perfil,
            $empresa,
            $rhid,
            $dt_adm,
            $perfil_ini,
            $nxt_perfil,
            $last_perfil,
            $finished
        );

        # inicia a transação do workflow
        $db->beginTransaction();
        $data = $this->getBeforeAndAfterValues($myArray, $db);

        # estado do registo anterior à operação (todo o registo em JSON)
        $prv = json_encode($data['prvVals']);

        if ($operation == 'INSERT') {
            if (
                isset(
                    $data['nxtVals']->{$this->Upload->blob_embedded->blobField}
                )
            ) {
                $docData =
                    $data['nxtVals']->{$this->Upload->blob_embedded->blobField};
                unset(
                    $data['nxtVals']->{$this->Upload->blob_embedded->blobField}
                );
            }
        }
        # estado do registo posterior à operação (todo o registo em JSON)
        $nxt = json_encode($data['nxtVals']);

        if ($column) {
            $valAnt = $column->prv_value;
            $valPos = $column->nxt_value;
        }

        if ($operation == 'INSERT') {
            $decodedArrayData = $data['nxtVals'];

            foreach ($data['nxtVals'] as $key => $value) {
                $myDomains = [];
                foreach ($domains as $list => $value) {
                    if ($key === $list) {
                        $myDomains = get_object_vars($value);
                        //it is a domain
                        $memcache = new Memcached();
                        $memcache->addServer('localhost', 11211);

                        $domainData = $memcache->get(
                            str_replace(' ', '', $myDomains["dependent-group"])
                        );

                        $k = array_search(
                            $data["prvVals"]->$key,
                            array_column($domainData, 'RV_LOW_VALUE')
                        );
                        $resultAnt = $domainData[$k];
                        $valAnt = $resultAnt->RV_MEANING;
                        $resultAntJson = json_encode($resultAnt);

                        $k2 = array_search(
                            $data["nxtVals"]->$key,
                            array_column($domainData, 'RV_LOW_VALUE')
                        );
                        $resultPos = $domainData[$k2];
                        $valPos = $resultPos->RV_MEANING;

                        $decodedArrayData->$key = $valPos;
                    }
                }

                $myCxLists = [];
                if (isset($cxLists) && $cxLists != '') {
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
                            //unset($decodedArrayData->$key);
                            //$field = $list["name"];
                            //$decodedArrayData->$field = $decodedData[2];
                        }
                    }
                }
            }

            # avalia se existe já existe um registo de workflow para a tabela/coluna/operação/registo
            $this->analyzePrevWorkflow(
                $dbTable,
                '',
                $operation,
                $pkstring,
                $perfil_ini,
                $nxt_perfil,
                $last_perfil,
                $finished
            );

            ## statment para inserir registo no workflow
            if (isset($docData)) {
                $sql =
                    "INSERT INTO RH_ID_WORKFLOW_LOGS " .
                    "(TABELA, OPERACAO, PK, VLR_ANT, VLR_POS, FINISHED, PERFIL_INI, NEXT_PERFIL, LAST_PERFIL, CTXLIST_VLR_POS,BD_DOC_POS,BD_MIME_POS,LINK_DOC_POS) " .
                    "VALUES(:TABELA_, :OPERACAO_, :PK_, :VLR_ANT_, :VLR_POS_, :FINISHED_, :PERFIL_INI_, :NEXT_PERFIL_, :LAST_PERFIL_, :CTXLIST_VLR_POS_,:BD_DOC_POS_,:BD_MIME_POS_,:LINK_DOC_POS_) ";
            } else {
                $sql =
                    "INSERT INTO RH_ID_WORKFLOW_LOGS " .
                    "(TABELA, OPERACAO, PK, VLR_ANT, VLR_POS, FINISHED, PERFIL_INI, NEXT_PERFIL, LAST_PERFIL, CTXLIST_VLR_POS) " .
                    "VALUES(:TABELA_, :OPERACAO_, :PK_, :VLR_ANT_, :VLR_POS_, :FINISHED_, :PERFIL_INI_, :NEXT_PERFIL_, :LAST_PERFIL_, :CTXLIST_VLR_POS_) ";
            }

            try {
                $stmt = $db->prepare($sql);
                if (isset($docData)) {
                    //$stmt->bindParam(':BD_DOC_POS_', $docData, PDO::PARAM_STR);
                    $stmt->bindParam(':BD_DOC_POS_', $docData, PDO::PARAM_LOB);

                    $linkdoc = $decodedArrayData->{$this->Upload->blob_embedded->fileNameField};
                    $extdoc = $decodedArrayData->{$this->Upload->blob_embedded->extField};

                    $stmt->bindParam(':BD_MIME_POS_', $extdoc, PDO::PARAM_STR);
                    $stmt->bindParam(':LINK_DOC_POS_', $linkdoc, PDO::PARAM_STR);
                }
                $stmt->bindParam(':TABELA_', $dbTable, PDO::PARAM_STR);
                $stmt->bindParam(':OPERACAO_', $operation, PDO::PARAM_STR);
                $stmt->bindParam(':PK_', $pkstring, PDO::PARAM_STR);
                $stmt->bindParam(':VLR_ANT_', $null, PDO::PARAM_NULL);

                if (
                    isset(
                        $decodedArrayData->{$this->Upload->blob_embedded
                            ->blobField}
                    )
                ) {
                    unset(
                        $decodedArrayData->{$this->Upload->blob_embedded
                            ->blobField}
                    );
                }
                $nxtValDecoded = json_encode($decodedArrayData);

                if ($nxtValDecoded != '') {
                    $stmt->bindParam(
                        ':VLR_POS_',
                        $nxtValDecoded,
                        PDO::PARAM_STR
                    );
                } else {
                    $stmt->bindParam(':VLR_POS_', $null, PDO::PARAM_NULL);
                }

                $stmt->bindParam(':FINISHED_', $finished, PDO::PARAM_STR);
                $stmt->bindParam(':PERFIL_INI_', $perfil_ini, PDO::PARAM_STR);
                if ($nxt_perfil != '') {
                    $stmt->bindParam(
                        ':NEXT_PERFIL_',
                        $nxt_perfil,
                        PDO::PARAM_STR
                    );
                } else {
                    $stmt->bindParam(':NEXT_PERFIL_', $null, PDO::PARAM_NULL);
                }

                if ($last_perfil != '') {
                    $stmt->bindParam(
                        ':LAST_PERFIL_',
                        $last_perfil,
                        PDO::PARAM_STR
                    );
                } else {
                    $stmt->bindParam(':LAST_PERFIL_', $null, PDO::PARAM_NULL);
                }

                if ($nxt != '') {
                    //$decodedNxt=json

                    $stmt->bindParam(':CTXLIST_VLR_POS_', $nxt, PDO::PARAM_STR);
                } else {
                    $stmt->bindParam(
                        ':CTXLIST_VLR_POS_',
                        $null,
                        PDO::PARAM_NULL
                    );
                }
                $stmt->execute();

                 # obtem a informaÃ§Ã£o do workflow criado
                $sql =
                    "SELECT * FROM RH_ID_WORKFLOW_LOGS ORDER BY ID DESC LIMIT 1";
                $stmt2 = $db->prepare($sql);
                $stmt2->execute();
                $wkf_info = $stmt2->fetch(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                QuadUploads::getErrors($db, $ex);
            }
        } elseif ($operation == 'UPDATE') {
            $row_count = 0;
            //todo
            //Record is on INSERT workflow process?
            //If it's on DELETE mode, edition IS NOT ALLOWED (controled by the form)!
            //UPDATE de um registo que está em WORKFLOW de INSERT: reseta estado e identifica última alteração, com perfil de quem executa.
            /* $qry_updt = "UPDATE FO_ON_WORKFLOW set estado = :estado, last_usr = '$user', last_dt = '$now' " .
             "where tabela = '$dbTable' AND operacao = 'INSERT' AND rhid = $pkstring  ";*/

            //end todo

            $myCxLists = [];
            if (isset($cxLists) && $cxLists != '') {
                foreach ($cxLists as $list) {
                    $searchIn = isset($list['distribute-value'])
                        ? $list['distribute-value']
                        : $list['data-db-name'];
                    $arr = explode("@", str_replace('A.', '', $searchIn)); //todo led str replace alias

                    if (in_array($column->db, $arr)) {
                        //if() //todo check upper level...
                        array_push($myCxLists, $list);
                    }
                }
            }
            $myDomains = [];
            foreach ($domains as $list => $value) {
                if ($column->db === $list) {
                    $myDomains = get_object_vars($value);
                }
            }

            ## statement para inserir registo no workflow
            $sql =
                "INSERT INTO RH_ID_WORKFLOW_LOGS " .
                "(TABELA, COLUNA, OPERACAO, PK, VLR_ANT, VLR_POS, FINISHED, PERFIL_INI, NEXT_PERFIL, LAST_PERFIL, CTXLIST_VLR_ANT, CTXLIST_VLR_POS) " .
                "VALUES(:TABELA_, :COLUNA_, :OPERACAO_, :PK_, :VLR_ANT_, :VLR_POS_, :FINISHED_, :PERFIL_INI_, :NEXT_PERFIL_, :LAST_PERFIL_, :CTXLIST_VLR_ANT_, :CTXLIST_VLR_POS_) ";

            //it is a domain
            if (count($myDomains) > 0) {
                $memcache = new Memcached();
                $memcache->addServer('localhost', 11211);

                /*$data = json_decode(
                    $memcache->get(
                        str_replace(' ', '', $myDomains["dependent-group"])
                    )
                );*/
                $data = $memcache->get(
                    str_replace(' ', '', $myDomains["dependent-group"])
                );

                if ($column->prv_value === null) {
                    $resultAnt = null;
                    $valAnt = null;
                    $resultAntJson = null;
                } else {
                    $k = array_search(
                        $column->prv_value,
                        array_column($data, 'RV_LOW_VALUE')
                    );
                    $resultAnt = $data[$k];
                    $valAnt = $resultAnt->RV_MEANING;

                    $resultAntJson = json_encode($resultAnt);
                }

                if ($column->nxt_value === null) {
                    $resultPos = null;
                    $valPos = null;
                    $resultPosJson = null;
                } else {
                    $k2 = array_search(
                        $column->nxt_value,
                        array_column($data, 'RV_LOW_VALUE')
                    );
                    $resultPos = $data[$k2];
                    $valPos = $resultPos->RV_MEANING;
                    //subquery for delete if admin or same user and not complex list
                    $resultPosJson = json_encode($resultPos);
                }
                $colmn = $column->db;

                #                $qry =
                #                    "SELECT w.* FROM FO_ON_WORKFLOW w ".
                #                    "where (w.usr_ins= '$this->user' OR w.perfil < '$this->perfil')  AND ".
                #                    " w.coluna = '$colmn' AND w.tabela = '$dbTable' AND w.operacao = 'UPDATE' " .
                #                    " AND w.pk = '$pkstring' ";

                # avalia se existe já um registo de workflow para a tabela/coluna/operação/registo
                $this->analyzePrevWorkflow(
                    $dbTable,
                    $colmn,
                    $operation,
                    $pkstring,
                    $perfil_ini,
                    $nxt_perfil,
                    $last_perfil,
                    $finished
                );

                # prepara statment de registo no log de workflow ($sql)
                try {
                    # $prv - contem sempre todo o registo anterior à atualização
                    # $nxt - contem sempre todo o registo posterior à atualização

                    # se o tipo de update é ao registo -> passa todo o registo anterior ($prv) e seguinte ($nxt)
                    # se o tipo de update é à coluna -> passa apenas o valor anterior ($column->prv_value) e seguinte ($column->nxt_value) da coluna

                    $valueBefore = $wkfType == "record" ? $prv : $valAnt;
                    $valueAfter = $wkfType == "record" ? $nxt : $valPos;
                    $stmt = $db->prepare($sql);

                    $stmt->bindParam(':TABELA_', $dbTable, PDO::PARAM_STR);
                    $stmt->bindParam(':COLUNA_', $colmn, PDO::PARAM_STR);
                    $stmt->bindParam(':OPERACAO_', $operation, PDO::PARAM_STR);
                    $stmt->bindParam(':PK_', $pkstring, PDO::PARAM_STR);
                    $stmt->bindParam(':FINISHED_', $finished, PDO::PARAM_STR);
                    $stmt->bindParam(
                        ':PERFIL_INI_',
                        $perfil_ini,
                        PDO::PARAM_STR
                    );

                    if ($valueBefore != '') {
                        $stmt->bindParam(
                            ':VLR_ANT_',
                            $valueBefore,
                            PDO::PARAM_STR
                        );
                    } else {
                        $stmt->bindParam(':VLR_ANT_', $null, PDO::PARAM_NULL);
                    }

                    if ($valueAfter != '') {
                        $stmt->bindParam(
                            ':VLR_POS_',
                            $valueAfter,
                            PDO::PARAM_STR
                        );
                    } else {
                        $stmt->bindParam(':VLR_POS_', $null, PDO::PARAM_NULL);
                    }

                    if ($nxt_perfil != '') {
                        $stmt->bindParam(
                            ':NEXT_PERFIL_',
                            $nxt_perfil,
                            PDO::PARAM_STR
                        );
                    } else {
                        $stmt->bindParam(
                            ':NEXT_PERFIL_',
                            $null,
                            PDO::PARAM_NULL
                        );
                    }

                    if ($last_perfil != '') {
                        $stmt->bindParam(
                            ':LAST_PERFIL_',
                            $last_perfil,
                            PDO::PARAM_STR
                        );
                    } else {
                        $stmt->bindParam(
                            ':LAST_PERFIL_',
                            $null,
                            PDO::PARAM_NULL
                        );
                    }

                    if ($resultAntJson != '') {
                        $stmt->bindParam(
                            ':CTXLIST_VLR_ANT_',
                            $resultAntJson,
                            PDO::PARAM_STR
                        );
                    } else {
                        $stmt->bindParam(
                            ':CTXLIST_VLR_ANT_',
                            $null,
                            PDO::PARAM_NULL
                        );
                    }

                    if ($resultPosJson != '') {
                        $stmt->bindParam(
                            ':CTXLIST_VLR_POS_',
                            $resultPosJson,
                            PDO::PARAM_STR
                        );
                    } else {
                        $stmt->bindParam(
                            ':CTXLIST_VLR_POS_',
                            $null,
                            PDO::PARAM_NULL
                        );
                    }
                } catch (Exception $ex) {
                    QuadUploads::getErrors($db, $ex);
                }
                #                $sql =
                #                    "INSERT INTO FO_ON_WORKFLOW (tabela, operacao, coluna, empresa, pk, vlr_ant,vlr_pos,cxlist_vlr_ant, cxlist_vlr_apos,  estado, usr_ins, dt_ins,perfil) " .
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
                        $colmn = $myCxLists[0]["name"];

                        # avalia se existe já um registo de workflow para a tabela/coluna/operação/registo
                        $this->analyzePrevWorkflow(
                            $dbTable,
                            $colmn,
                            $operation,
                            $pkstring,
                            $perfil_ini,
                            $nxt_perfil,
                            $last_perfil,
                            $finished
                        );
                        # prepara statment de registo no log de workflow ($sql)
                        try {
                            # $prv - contem sempre todo o registo anterior à atualização
                            # $nxt - contem sempre todo o registo posterior à atualização

                            # se o tipo de update é ao registo -> passa todo o registo anterior ($prv) e seguinte ($nxt)
                            # se o tipo de update é à coluna -> passa apenas o valor anterior ($column->prv_value) e seguinte ($column->nxt_value) da coluna

                            $valueBefore =
                                $wkfType == "record" ? $prv : $decodedData[1];
                            $valueAfter =
                                $wkfType == "record" ? $nxt : $decodedData[2];
                            $stmt = $db->prepare($sql);
                            $stmt->bindParam(
                                ':TABELA_',
                                $dbTable,
                                PDO::PARAM_STR
                            );
                            $stmt->bindParam(
                                ':COLUNA_',
                                $decodedData[0],
                                PDO::PARAM_STR
                            );
                            $stmt->bindParam(
                                ':OPERACAO_',
                                $operation,
                                PDO::PARAM_STR
                            );
                            $stmt->bindParam(':PK_', $pkstring, PDO::PARAM_STR);
                            $stmt->bindParam(
                                ':FINISHED_',
                                $finished,
                                PDO::PARAM_STR
                            );
                            $stmt->bindParam(
                                ':PERFIL_INI_',
                                $perfil_ini,
                                PDO::PARAM_STR
                            );

                            if ($valueBefore != '') {
                                $stmt->bindParam(
                                    ':VLR_ANT_',
                                    $valueBefore,
                                    PDO::PARAM_STR
                                );
                            } else {
                                $stmt->bindParam(
                                    ':VLR_ANT_',
                                    $null,
                                    PDO::PARAM_NULL
                                );
                            }

                            if ($valueAfter != '') {
                                $stmt->bindParam(
                                    ':VLR_POS_',
                                    $valueAfter,
                                    PDO::PARAM_STR
                                );
                            } else {
                                $stmt->bindParam(
                                    ':VLR_POS_',
                                    $null,
                                    PDO::PARAM_NULL
                                );
                            }

                            if ($nxt_perfil != '') {
                                $stmt->bindParam(
                                    ':NEXT_PERFIL_',
                                    $nxt_perfil,
                                    PDO::PARAM_STR
                                );
                            } else {
                                $stmt->bindParam(
                                    ':NEXT_PERFIL_',
                                    $null,
                                    PDO::PARAM_NULL
                                );
                            }

                            if ($last_perfil != '') {
                                $stmt->bindParam(
                                    ':LAST_PERFIL_',
                                    $last_perfil,
                                    PDO::PARAM_STR
                                );
                            } else {
                                $stmt->bindParam(
                                    ':LAST_PERFIL_',
                                    $null,
                                    PDO::PARAM_NULL
                                );
                            }

                            if ($cxListValAnt != '') {
                                $stmt->bindParam(
                                    ':CTXLIST_VLR_ANT_',
                                    $cxListValAnt,
                                    PDO::PARAM_STR
                                );
                            } else {
                                $stmt->bindParam(
                                    ':CTXLIST_VLR_ANT_',
                                    $null,
                                    PDO::PARAM_NULL
                                );
                            }

                            if ($cxListValPos != '') {
                                $stmt->bindParam(
                                    ':CTXLIST_VLR_POS_',
                                    $cxListValPos,
                                    PDO::PARAM_STR
                                );
                            } else {
                                $stmt->bindParam(
                                    ':CTXLIST_VLR_POS_',
                                    $null,
                                    PDO::PARAM_NULL
                                );
                            }
                            $stmt->execute();
                            $stmt->runAgain = false;
                        } catch (Exception $ex) {
                            QuadUploads::getErrors($db, $ex);
                        }
                        #                $sql =
                        #                    "INSERT INTO FO_ON_WORKFLOW (tabela, operacao, coluna, empresa, pk, vlr_ant,vlr_pos,cxlist_vlr_ant, cxlist_vlr_apos,  estado, usr_ins, dt_ins,perfil) " .
                        #                    "values ('$dbTable', '$operation', '$decodedData[0]', 'CMIP', '$pkstring', '$decodedData[1]', '$decodedData[2]', '$cxListValAnt', '$cxListValPos', '$estado', '$this->user', $now,'$this->perfil') ";
                    }
                }
            }

            if (count($myCxLists) === 0 && count($myDomains) === 0) {
                //its not a domain neither a complex list
                //subquery for delete if admin or same user and not complex list

                # avalia se existe já um registo de workflow para a tabela/coluna/operação/registo
                $this->analyzePrevWorkflow(
                    $dbTable,
                    $column->db,
                    $operation,
                    $pkstring,
                    $perfil_ini,
                    $nxt_perfil,
                    $last_perfil,
                    $finished
                );

                # prepara statment de registo no log de workflow ($sql)
                try {
                    # $prv - contem sempre todo o registo anterior à atualização
                    # $nxt - contem sempre todo o registo posterior à atualização

                    # se o tipo de update é ao registo -> passa todo o registo anterior ($prv) e seguinte ($nxt)
                    # se o tipo de update é à coluna -> passa apenas o valor anterior ($column->prv_value) e seguinte ($column->nxt_value) da coluna
                    $valueBefore =
                        $wkfType == "record" ? $prv : $column->prv_value;
                    $valueAfter =
                        $wkfType == "record" ? $nxt : $column->nxt_value;
                    $stmt = $db->prepare($sql);

                    $stmt->bindParam(':TABELA_', $dbTable, PDO::PARAM_STR);
                    $stmt->bindParam(':COLUNA_', $column->db, PDO::PARAM_STR);
                    $stmt->bindParam(':OPERACAO_', $operation, PDO::PARAM_STR);
                    $stmt->bindParam(':PK_', $pkstring, PDO::PARAM_STR);
                    $stmt->bindParam(':FINISHED_', $finished, PDO::PARAM_STR);
                    $stmt->bindParam(
                        ':PERFIL_INI_',
                        $perfil_ini,
                        PDO::PARAM_STR
                    );

                    if ($valueBefore != '') {
                        $stmt->bindParam(
                            ':VLR_ANT_',
                            $valueBefore,
                            PDO::PARAM_STR
                        );
                    } else {
                        $stmt->bindParam(':VLR_ANT_', $null, PDO::PARAM_NULL);
                    }
                    if ($valueAfter != '') {
                        $stmt->bindParam(
                            ':VLR_POS_',
                            $valueAfter,
                            PDO::PARAM_STR
                        );
                    } else {
                        $stmt->bindParam(':VLR_POS_', $null, PDO::PARAM_NULL);
                    }

                    if ($nxt_perfil != '') {
                        $stmt->bindParam(
                            ':NEXT_PERFIL_',
                            $nxt_perfil,
                            PDO::PARAM_STR
                        );
                    } else {
                        $stmt->bindParam(
                            ':NEXT_PERFIL_',
                            $null,
                            PDO::PARAM_NULL
                        );
                    }

                    if ($last_perfil != '') {
                        $stmt->bindParam(
                            ':LAST_PERFIL_',
                            $last_perfil,
                            PDO::PARAM_STR
                        );
                    } else {
                        $stmt->bindParam(
                            ':LAST_PERFIL_',
                            $null,
                            PDO::PARAM_NULL
                        );
                    }

                    $stmt->bindParam(
                        ':CTXLIST_VLR_ANT_',
                        $null,
                        PDO::PARAM_NULL
                    );
                    $stmt->bindParam(
                        ':CTXLIST_VLR_POS_',
                        $null,
                        PDO::PARAM_NULL
                    );
                } catch (Exception $ex) {
                    QuadUploads::getErrors($db, $ex);
                }

                #                $sql =
                #                    "INSERT INTO FO_ON_WORKFLOW (tabela, operacao, coluna, empresa, pk, vlr_ant, vlr_pos,  estado, usr_ins, dt_ins,perfil) " .
                #                    "values ('$dbTable', '$operation', '$column->db', 'CMIP', '$pkstring',  '$column->prv_value', '$column->nxt_value', '$estado', '$this->user', $now,'$this->perfil') ";
            }

            try {
                #$stmt = $db->prepare($sql);

                //se estiverem envolvidas listas complexas, nao executar pois ja foi executado em contexto
                if (isset($stmt->runAgain) && $stmt->runAgain === false) {
                    $null;
                } else {
                    $stmt->execute();
                }

                # obtem a informação do workflow criado
                $sql =
                    "SELECT * FROM RH_ID_WORKFLOW_LOGS ORDER BY ID DESC LIMIT 1";
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $wkf_info = $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                QuadUploads::getErrors($db, $ex);
            }
            //}
        } elseif ($operation == 'DELETE') {
            $data = $this->getBeforeAndAfterValues($myArray);
            $prv = json_encode($data['prvVals']);
            $nxt = json_encode($data['nxtVals']);

            # avalia se existe já um registo de workflow para a tabela/coluna/operação/registo
            $this->analyzePrevWorkflow(
                $dbTable,
                '',
                $operation,
                $pkstring,
                $perfil_ini,
                $nxt_perfil,
                $last_perfil,
                $finished
            );

            ## statment para inserir registo no workflow
            $sql =
                "INSERT INTO RH_ID_WORKFLOW_LOGS " .
                "(TABELA, OPERACAO, PK, VLR_ANT, VLR_POS, FINISHED, PERFIL_INI, NEXT_PERFIL, LAST_PERFIL) " .
                "VALUES(:TABELA_, :OPERACAO_, :PK_, :VLR_ANT_, :VLR_POS_, :FINISHED_, :PERFIL_INI_, :NEXT_PERFIL_, :LAST_PERFIL_) ";
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
                    $stmt->bindParam(
                        ':NEXT_PERFIL_',
                        $nxt_perfil,
                        PDO::PARAM_STR
                    );
                } else {
                    $stmt->bindParam(':NEXT_PERFIL_', $null, PDO::PARAM_NULL);
                }

                if ($last_perfil != '') {
                    $stmt->bindParam(
                        ':LAST_PERFIL_',
                        $last_perfil,
                        PDO::PARAM_STR
                    );
                } else {
                    $stmt->bindParam(':LAST_PERFIL_', $null, PDO::PARAM_NULL);
                }

                $stmt->execute();

                # obtem a informação do workflow criado
                $sql =
                    "SELECT * FROM RH_ID_WORKFLOW_LOGS ORDER BY ID DESC LIMIT 1";
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $wkf_info = $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                QuadUploads::getErrors($db, $ex);
            }
            #           $this->doWorkFlowTransaction($delWithId, $sql, $db);

            /*try {
                $stmt = $db->prepare($sql);
                $stmt->execute();
            } catch (Exception $ex) {
                QuadCore::getErrors($db, $ex);
            }*/
        }

        # finaliza a transação de workflow
        try {
            $db->commit();
        } catch (Exception $ex) {
            QuadUploads::getErrors($db, $ex, true);
            die();
        }

        # se está no último nível da cadeia
        # então efetiva a operação
        if ($finished == 'S') {
            return [
                $finished,
                $this->aprooveWorkFlow(
                    $wkf_info['ID'],
                    $dbTable,
                    null,
                    $db,
                    $now,
                    $wkf_info,
                    $pkstring,
                    $myArray,
                    false,
                    $cxLists,
                    $domains,
                    $finished,
                    true
                )
            ];
        }
        return false;
    }
    public function doWorkFlowTransaction($stt1, $stt2, $conn)
    {
        $conn->beginTransaction();

        try {
            if ($stt1 != '') {
                if ($stt1 instanceof PDOStatement) {
                    $stt1->execute();
                } else {
                    $stmt = $conn->prepare($stt1);
                    $stmt->execute();
                }
            }

            if ($stt2 != '') {
                $stmt = $conn->prepare($stt2);
                $stmt->execute();
            }

            if ($stt1 != '' || $stt2 != '') {
                $conn->commit();
            }
        } catch (Exception $ex) {
            QuadUploads::getErrors($conn, $ex);
            die();
        }

        return true;
    }
    public function notifyThisUploadedFile(
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
        $wkf_info = '';

        # obtem informação do colaborador
        $this->get_info_colab($pkstring, $empresa, $rhid, $dt_adm);
        # obtem estado de workflow do registo
        $this->get_workflow_registo(
            $db,
            $dbTable,
            $this->perfil,
            $empresa,
            $rhid,
            $dt_adm,
            $perfil_ini,
            $nxt_perfil,
            $last_perfil,
            $finished
        );

        # inicia a transação do workflow
        $db->beginTransaction();
        $data = $this->getBeforeAndAfterValues($myArray, $db);

        # estado do registo anterior à operação (todo o registo em JSON)
        $prv = json_encode($data['prvVals']);

        # estado do registo posterior à operação (todo o registo em JSON)
        $nxt = json_encode($data['nxtVals']);
        if ($column) {
            $valAnt = $column->prv_value;
            $valPos = $column->nxt_value;
        }
        $valueBefore = $wkfType == "record" ? $prv : $valAnt;
        $valueAfter = $wkfType == "record" ? $nxt : $valPos;
        if ($operation == 'UPDATE') {
            ## statement para inserir registo no workflow
            $sql =
                "INSERT INTO RH_ID_WORKFLOW_LOGS " .
                "(TABELA, COLUNA, OPERACAO, PK, FINISHED, PERFIL_INI, NEXT_PERFIL, LAST_PERFIL, BD_DOC_ANT,BD_DOC_POS,LINK_DOC_ANT,BD_MIME_ANT,LINK_DOC_POS,BD_MIME_POS) " .
                "VALUES(:TABELA_, :COLUNA_, :OPERACAO_, :PK_, :FINISHED_, :PERFIL_INI_, :NEXT_PERFIL_, :LAST_PERFIL_, :BD_DOC_ANT, :BD_DOC_POS,:LINK_DOC_ANT,:BD_MIME_ANT,:LINK_DOC_POS,:BD_MIME_POS) ";

            $stmt = $db->prepare($sql);

            $linkDocAnt = $data['prvVals']->LINK_DOC;
            $linkDocPos = $data['nxtVals']->LINK_DOC;
            $bdMimeAnt = $data['prvVals']->BD_MIME;
            $bdMimePos = $data['nxtVals']->BD_MIME;

            $stmt->bindParam(':BD_DOC_ANT', $column->prv_value, PDO::PARAM_LOB);
            $stmt->bindParam(':BD_DOC_POS', $column->nxt_value, PDO::PARAM_LOB);

            $stmt->bindParam(':TABELA_', $dbTable, PDO::PARAM_STR);
            $stmt->bindParam(':COLUNA_', $column->db, PDO::PARAM_STR);
            $stmt->bindParam(':OPERACAO_', $operation, PDO::PARAM_STR);
            $stmt->bindParam(':PK_', $pkstring, PDO::PARAM_STR);
            $stmt->bindParam(':FINISHED_', $finished, PDO::PARAM_STR);
            $stmt->bindParam(':PERFIL_INI_', $perfil_ini, PDO::PARAM_STR);
            $stmt->bindParam(':LINK_DOC_ANT', $linkDocAnt, PDO::PARAM_STR);
            $stmt->bindParam(':BD_MIME_ANT', $bdMimeAnt, PDO::PARAM_STR);

            $stmt->bindParam(':LINK_DOC_POS', $linkDocPos, PDO::PARAM_STR);
            $stmt->bindParam(':BD_MIME_POS', $bdMimePos, PDO::PARAM_STR);

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

            try {
                $stmt->execute();

                # obtem a informação do workflow criado
                $sql =
                    "SELECT * FROM RH_ID_WORKFLOW_LOGS ORDER BY ID DESC LIMIT 1";
                $stmt2 = $db->prepare($sql);
                $stmt2->execute();
                $wkf_info = $stmt2->fetch(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                QuadUploads::getErrors($db, $ex);
            }
            //}
        }

        # finaliza a transação de workflow
        try {
            $db->commit();
        } catch (Exception $ex) {
            QuadUploads::getErrors($db, $ex, true);
            die();
        }

        # se está no último nível da cadeia
        # então efetiva a operação
        if ($finished == 'S') {
            return [
                $finished,
                $this->aprooveWorkFlowUploads(
                    $wkf_info['ID'],
                    $dbTable,
                    null,
                    $db,
                    $now,
                    $wkf_info,
                    $pkstring,
                    $myArray,
                    false,
                    $cxLists,
                    $domains,
                    $finished,
                    true
                )
            ];
        }
    }
    #
    # aprovação de uma ocorrência de workflow - mode = POSTPONED
    public function aprooveWorkFlowUploads(
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
        $event = false
    ) {
        //this is true when its event based operation ex:user clicks aproove button
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
            //$finished = 'S';
        }
        #            "UPDATE FO_ON_WORKFLOW SET estado = $estado , LAST_DT=$now  where id=$id AND tabela = '$table' ";

        # só executa a ação (INSERT/UPDATE/DELETE) quando atinge o final da cadeia de aprovação => $finished = 'S'
        $qry2 = '';
        if ($finished == 'S' && $event) {
            # inserção ou remoção de registo
            if (
                $res['OPERACAO'] === 'INSERT' ||
                $res['OPERACAO'] === 'DELETE'
            ) {
                $vals = '(';
                $cols = '(';
                $str = (string) $res['CTXLIST_VLR_POS'];
                $arr = json_decode($str, true);
                $index = 0;
                $count = 0;
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
                                $value = QuadUploads::formatToDatetype(
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
            }
            # atualização de registo
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
                        if (
                            isset($entry->datatype) &&
                            mb_strtoupper($entry->datatype) !== "SEQUENCE"
                        ) {
                            $value = QuadUploads::formatToDatetype(
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

                    // se for um update de uma instância com workflow ao registo
                    if (is_object(json_decode($res['VLR_POS']))) {
                        $v = json_decode($res['VLR_POS']);
                        if (
                            isset($entry->datatype) &&
                            mb_strtoupper($entry->datatype) !== "SEQUENCE"
                        ) {
                            $val = QuadUploads::formatToDatetype(
                                $col,
                                $entry->datatype,
                                $v->$col
                            );
                        } else {
                            $val = "'" . $v->$col . "'";
                        }
                        // se for um update de uma instância com workflow à coluna
                    } else {
                        $v = $res['VLR_POS'];
                        if (
                            isset($entry->datatype) &&
                            mb_strtoupper($entry->datatype) !== "SEQUENCE"
                        ) {
                            $val = QuadUploads::formatToDatetype(
                                $col,
                                $entry->datatype,
                                $v
                            );
                        } else {
                            if (
                                isset($this->Upload->blob_embedded) &&
                                $col === $this->Upload->blob_embedded->blobField
                            ) {
                                $val = $res["BD_DOC_POS"];
                                $mime = $res["BD_MIME_POS"];
                                $linkdoc = $res["LINK_DOC_POS"];
                                $qry3 = "UPDATE $table set $col= :doc , LINK_DOC = '$linkdoc', BD_MIME = '$mime' where $where ";
                                $qry3 = $db->prepare($qry3);
                                $qry3->bindParam(':doc', $val, PDO::PARAM_LOB);
                            } else {
                                $val = "'" . $v . "'";
                            }
                        }
                    }
                    if (isset($qry3)) {
                        $qry2 = $qry3;
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
                    echo $this->returnRecordAfterWkf(
                        $db,
                        $table,
                        $where,
                        $dbCols,
                        $res['OPERACAO']
                    );
                    die();
                } elseif ($event === true && $finished == 'N') {
                    $this->notifyUser('');
                } else {
                    return true;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public static function getColumnsToString($dbCols, $obj = null)
    {
        $index = 0;
        $count = count($dbCols);
        $myQryData = '';
        foreach ($dbCols as $key => $value) {
            $entry = array_filter($dbCols, function ($e) use ($value) {
                return $e->db == $value->db;
            });
            if ($value) {
                if (
                    isset($entry[$index]->datatype) &&
                    mb_strtoupper($entry[$index]->datatype) !== "SEQUENCE"
                ) {
                    $prop = mb_strtoupper($entry[$index]->datatype);
                    $val =
                        QuadUploads::formatDatetypeToChar($value->db, $prop) .
                        ',';
                } else {
                    if ($value->db === $obj->Upload->blob_embedded->blobField) {
                        $val =
                            "TO_BASE64(" . $value->db . ")" . $value->db . ",";
                    } else {
                        $val = "$value->db,";
                    }
                }
                $myQryData .= $val;
            }
            $index++;
            if ($index == $count) {
                $myQryData = rtrim($myQryData, ', ');
            }
        }
        return $myQryData;
    }
    public function returnRecordAfterWkf(
        $db,
        $table,
        $where,
        $dbCols,
        $action,
        $col = null
    ) {
        if ($action === 'DELETE') {
            $deleted = array('status' => 'deleted');
            echo json_encode($deleted);
            die();
        }
        $cols = self::getColumnsToString($dbCols, $this);

        $seq = array_filter($dbCols, function ($value) {
            if (isset($value->datatype)) {
                return $value->datatype === "sequence";
            } else {
                return false;
            }
        });

        if (count($seq) > 0 && $action === "INSERT") {
            $seq = array_values($seq);
            $qry =
                "SELECT " .
                $cols .
                " FROM " .
                $table .
                " WHERE $where " .
                ' ORDER BY ' .
                $seq[0]->db .
                ' DESC LIMIT 1';
        } else {
            $qry = "SELECT $cols FROM $table WHERE $where";
        }

        try {
            $stmt = $db->prepare($qry);
            $stmt->execute();

            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return json_encode($res);
        } catch (Exception $ex) {
            QuadUploads::getErrors($db, $ex);
        }
    }
    public function getTmpBlobRecord($db, $doc)
    {
        //save temporary file to blob field ex:create blob field and compare to blob in original record

        $sql =
            "INSERT INTO RH_ID_WORKFLOW_LOGS " .
            "(BD_DOC_ANT) " .
            "VALUES(:BD_DOC) ";

        $stmt = $db->prepare($sql);
        //TODO bug fix EStacio , data is icccprofile when gestor add record. administrador add record tambem iccprofile
        $stmt->bindParam(':BD_DOC', $doc, PDO::PARAM_LOB);

        $stmt->execute();

        //get the blob to compare with $data->blob
        $sql = "SELECT ID,BD_DOC_ANT FROM RH_ID_WORKFLOW_LOGS ORDER BY ID DESC LIMIT 1";
        $stmt2 = $db->prepare($sql);
        $stmt2->execute();
        $tmpBlobRecord = $stmt2->fetch(PDO::FETCH_ASSOC);
        $stmt2 = $db->prepare(
            "DELETE FROM RH_ID_WORKFLOW_LOGS where ID=" . $tmpBlobRecord["ID"]
        );
        $stmt2->execute();
        return $tmpBlobRecord;
    }
}
