<?php
/*
 * Classe para o tratamento do registo de log de acessos
 *
 * PTE 2020.03.05
 */

class QuadLog
{
    function __construct()
    {
    }

    #
    # grava registo na tabela de acessos
    function saveRecord($dt_hr_, $usr_id_, $utilizador_, $id_perfil_, $IP_, $url_,
                        $tabela_, $coluna_, $operacao_, $pk_, $vlr_ant_, $vlr_pos_,
                        $ctx_vlr_ant_, $ctx_vlr_pos_, $id_mod_pai_, $id_mod_) {
        global $db;

        $null = null;
        
        $sql =  "INSERT INTO WEB_ADM_LOG_ACESSOS ".
                "(DT_HR, USR_ID, UTILIZADOR, ID_PERFIL, IP, URL, TABELA, COLUNA, OPERACAO, PK, VLR_ANT, VLR_POS, ".
                " CTXLIST_VLR_ANT, CTXLIST_VLR_POS, ID_MODULO_PAI, ID_MODULO) ".
                "VALUES(:DT_HR_, :USR_ID_, :UTILIZADOR_, :ID_PERFIL_, :IP_, :URL_, :TABELA_, :COLUNA_, :OPERACAO_, :PK_, :VLR_ANT_, :VLR_POS_, ".
                " :CTXLIST_VLR_ANT_, :CTXLIST_VLR_POS_, :ID_MODULO_PAI_, :ID_MODULO_) ";
        
        try {
            $stmt = $db->prepare($sql);

            $stmt->bindParam(':DT_HR_', $dt_hr_, PDO::PARAM_STR);
            $stmt->bindParam(':USR_ID_', $usr_id_, PDO::PARAM_STR);
            $stmt->bindParam(':UTILIZADOR_', $utilizador_, PDO::PARAM_STR);
            $stmt->bindParam(':ID_PERFIL_', $id_perfil_, PDO::PARAM_STR);
            $stmt->bindParam(':IP_', $IP_, PDO::PARAM_STR);
            $stmt->bindParam(':URL_', $url_, PDO::PARAM_STR);

            if ($tabela_ != '') {
                $stmt->bindParam(':TABELA_', $tabela_, PDO::PARAM_STR);
            }
            else {
                $stmt->bindParam(':TABELA_', $null, PDO::PARAM_NULL);
            }

            if ($coluna_ != '') {
                $stmt->bindParam(':COLUNA_', $coluna_, PDO::PARAM_STR);
            }
            else {
                $stmt->bindParam(':COLUNA_', $null, PDO::PARAM_NULL);
            }
            
            if ($operacao_ != '') {
                $stmt->bindParam(':OPERACAO_', $operacao_, PDO::PARAM_STR);
            }
            else {
                $stmt->bindParam(':OPERACAO_', $null, PDO::PARAM_NULL);
            }
            
            if ($pk_ != '') {
                $stmt->bindParam(':PK_', $pk_, PDO::PARAM_STR);
            }
            else {
                $stmt->bindParam(':PK_', $null, PDO::PARAM_NULL);
            }

            if ($vlr_ant_ != '') {
                $stmt->bindParam(':VLR_ANT_', $vlr_ant_, PDO::PARAM_STR);
            }
            else {
                $stmt->bindParam(':VLR_ANT_', $null, PDO::PARAM_NULL);
            }
            
            if ($vlr_pos_ != '') {
                $stmt->bindParam(':VLR_POS_', $vlr_pos_, PDO::PARAM_STR);
            } 
            else {
                $stmt->bindParam(':VLR_POS_', $null, PDO::PARAM_NULL);
            }

            if ($ctx_vlr_ant_ != '') {
                $stmt->bindParam(':CTXLIST_VLR_ANT_', $ctx_vlr_ant_, PDO::PARAM_STR);
            } else {
                $stmt->bindParam(':CTXLIST_VLR_ANT_', $null, PDO::PARAM_NULL);
            }

            if ($ctx_vlr_pos_ != '') {
                $stmt->bindParam(':CTXLIST_VLR_POS_', $ctx_vlr_pos_, PDO::PARAM_STR);
            } else {
                $stmt->bindParam(':CTXLIST_VLR_POS_', $null, PDO::PARAM_NULL);
            }

            if ($id_mod_pai_ != '') {
                $stmt->bindParam(':ID_MODULO_PAI_', $id_mod_pai_, PDO::PARAM_STR);
            } else {
                $stmt->bindParam(':ID_MODULO_PAI_', $null, PDO::PARAM_NULL);
            }

            if ($id_mod_ != '') {
                $stmt->bindParam(':ID_MODULO_', $id_mod_, PDO::PARAM_STR);
            } else {
                $stmt->bindParam(':ID_MODULO_', $null, PDO::PARAM_NULL);
            }
            
            $stmt->execute();
            
        } catch (Exception $ex) {
            QuadCore::getErrors($db, $ex);
        }
    }
    
    
    #
    # registo acesso à informação
    public function registoLog(
        $dbTable,
        $operation,
        $column,
        $pk,
        $myArray,
        $cxLists,
        $domains,
        $wkfType
    ) {
        
        $dt_hr_ = date("Y-m-d H:i:s");
        $usr_id_ = @$_SESSION['id'];
        $utilizador_ = @$_SESSION['utilizador'];
        $id_perfil_ = @$_SESSION['id_perfil'];
        $IP_ = @$_SERVER['REMOTE_ADDR'];
        $url_ = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://".@$_SERVER['HTTP_HOST'].@$_SERVER['REQUEST_URI'];
        
        $id_mod_pai_ = '';
        $id_mod_ = '';
        
        $pkstring = Workflow::getPkString($pk, $myArray);
        $data = Workflow::getBeforeAndAfterValues($myArray);

        # estado do registo anterior à operação (todo o registo em JSON)
        $prv = json_encode($data['prvVals']);

        # estado do registo posterior à operação (todo o registo em JSON)
        $nxt = json_encode($data['nxtVals']);

        if ($operation == 'INSERT') {
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
                                )
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
                if (isset($cxLists) && $cxLists != '') {
                    foreach ($cxLists as $list) {
                        $searchIn = isset($list['distribute-value'])
                            ? $list['distribute-value']
                            : $list['data-db-name'];
                        $arr = explode("@", $searchIn);

                        if (in_array($key, $arr)) {
                            array_push($myCxLists, $list);
                            $decodedData = Workflow::decodeComplexList(
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
            }
            $nxtValDecoded = json_encode($decodedArrayData);

            # grava registo 
            $this->saveRecord($dt_hr_, $usr_id_, $utilizador_, $id_perfil_, $IP_, $url_,
                        $dbTable, '', $operation, $pkstring, '', $nxtValDecoded,
                        '', $nxt, $id_mod_pai_, $id_mod_);
        } 
        elseif ($operation == 'UPDATE') {
            $myCxLists = [];
            if (isset($cxLists) && $cxLists != '' ) {
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
            }
            $myDomains = [];
            foreach ($domains as $list => $value) {
                if ($column->db === $list) {
                    $myDomains = get_object_vars($value);
                }
            }

            //it is a domain
            if (count($myDomains) > 0) {
                $memcache = new Memcached();
                $memcache->addServer('localhost', 11211);

                /*$data = json_decode(
                    $memcache->get(
                        str_replace(' ', '', $myDomains["dependent-group"])
                    )
                );*/
                $data =
                    $memcache->get(
                        str_replace(' ', '', $myDomains["dependent-group"])
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
                
                $valueBefore = $wkfType == "record" ? $prv : $valAnt;
                $valueAfter = $wkfType == "record" ? $nxt : $valPos;

                # grava registo 
                $this->saveRecord($dt_hr_, $usr_id_, $utilizador_, $id_perfil_, $IP_, $url_,
                                  $dbTable, $colmn, $operation, $pkstring, $valueBefore, $valueAfter,
                                  $resultAntJson, $resultPosJson, $id_mod_pai_, $id_mod_);

            }

            //col is a complexList
            if (count($myCxLists) > 0) {

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
                    }
                }

                # $prv - contem sempre todo o registo anterior à atualização
                # $nxt - contem sempre todo o registo posterior à atualização

                # se o tipo de update é ao registo -> passa todo o registo anterior ($prv) e seguinte ($nxt)
                # se o tipo de update é à coluna -> passa apenas o valor anterior ($column->prv_value) e seguinte ($column->nxt_value) da coluna

                $valueBefore = $wkfType == "record" ? $prv : $decodedData[1];
                $valueAfter = $wkfType == "record" ? $nxt : $decodedData[2];
                    
                # grava registo 
                $this->saveRecord($dt_hr_, $usr_id_, $utilizador_, $id_perfil_, $IP_, $url_,
                                  $dbTable, $decodedData[0], $operation, $pkstring, $valueBefore, $valueAfter,
                                  $cxListValAnt, $cxListValPos, $id_mod_pai_, $id_mod_);
            }

            if (count($myCxLists) === 0 && count($myDomains) === 0) {

                # $prv - contem sempre todo o registo anterior à atualização
                # $nxt - contem sempre todo o registo posterior à atualização

                # se o tipo de update é ao registo -> passa todo o registo anterior ($prv) e seguinte ($nxt)
                # se o tipo de update é à coluna -> passa apenas o valor anterior ($column->prv_value) e seguinte ($column->nxt_value) da coluna
                $valueBefore =
                    $wkfType == "record" ? $prv : $column->prv_value;
                $valueAfter =
                    $wkfType == "record" ? $nxt : $column->nxt_value;

                # grava registo 
                $this->saveRecord($dt_hr_, $usr_id_, $utilizador_, $id_perfil_, $IP_, $url_,
                                  $dbTable, $column->db, $operation, $pkstring, $valueBefore, $valueAfter,
                                  '', '', $id_mod_pai_, $id_mod_);
                    
            }
            
        } 
        elseif ($operation == 'DELETE') {
            $data = Workflow::getBeforeAndAfterValues($myArray);
            $prv = json_encode($data['prvVals']);
            $nxt = json_encode($data['nxtVals']);

            # grava registo 
            $this->saveRecord($dt_hr_, $usr_id_, $utilizador_, $id_perfil_, $IP_, $url_,
                              $dbTable, '', $operation, $pkstring, $prv, $nxt,
                              '', '', $id_mod_pai_, $id_mod_);
        }

    }
}