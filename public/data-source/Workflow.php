<?php
/**
 * Created by PhpStorm.
 * User: led
 * Date: 04-05-2018
 * Time: 12:33
 */
require_once 'QuadCore.php';

class Workflow
{
    const INITIALSTATE = 0;
    const APROOVED = 1;
    const REJECTED = 2;
    const YES = 'S';
    const NO = 'N';

    # classe que implementa o Workflow.
    #
    #   extendida pelas classes:
    #       WorkFlowPostPoned - workflow em modo postponed
    #       WorkFlowOptimistic - workflow em modo optimistic
    #

    function __construct($data)
    {
        $this->wkfMode = $data;
    }

    #
    # função que devolve o id ou o tipo do perfil consoantes indiquemos o tipo ou id do perfil
    public function get_id_tp_perfil(
        $db,
        &$tp_perfil,
        &$id_perfil,
        &$nr_ordem_wkf
    ) {
        $nr_ordem_wkf = '';

        if (
            ($tp_perfil != '' && $id_perfil == '') ||
            ($tp_perfil == '' && $id_perfil != '')
        ) {
            $sql =
                "SELECT A.ID, A.TIPO_PERFIL, A.NR_ORDEM " .
                "FROM WEB_ADM_PERFIS A " .
                "WHERE 1 = 1 ";

            if ($tp_perfil == '' && $id_perfil != '') {
                $sql .= "AND A.ID = :ID_PERFIL_ ";
            } elseif ($tp_perfil != '' && $id_perfil == '') {
                $sql .= "AND A.TIPO_PERFIL = :TIPO_PERFIL_ ";
            } else {
                $sql .= " AND 1 = 2 ";
            }

            try {
                $stmt = $db->prepare($sql);

                if ($tp_perfil == '' && $id_perfil != '') {
                    $stmt->bindParam(':ID_PERFIL_', $id_perfil, PDO::PARAM_STR);
                } elseif ($tp_perfil != '' && $id_perfil == '') {
                    $stmt->bindParam(
                        ':TIPO_PERFIL_',
                        $tp_perfil,
                        PDO::PARAM_STR
                    );
                }
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    if ($tp_perfil == '' && $id_perfil != '') {
                        $tp_perfil = $row['TIPO_PERFIL'];
                    } elseif ($tp_perfil != '' && $id_perfil == '') {
                        $id_perfil = $row['ID'];
                    }
                    $nr_ordem_wkf = $row['NR_ORDEM'];
                }
            } catch (Exception $ex) {
                QuadCore::getErrors($db, $ex);
                #$msg = "get_id_tp_perfil#1 :" . $ex->getMessage();
            }
        }
    }

    #
    # obtenção da configuração de um workflow para um módulo (tabela)/perfil
    public function get_workflow(
        $db,
        $tabela,
        $id_perfil,
        &$estado,
        &$modo_acesso,
        &$notif_ecran,
        &$notif_email,
        &$notif_sms
    ) {
        $estado = '';
        $modo_acesso = '';
        $notif_ecran = '';
        $notif_email = '';
        $notif_sms = '';

        $sql =
            "SELECT A.* " .
            "FROM WEB_ADM_WORKFLOW A, WEB_ADM_MODULOS_PORTAL B " .
            "WHERE A.ID_PERFIL = :ID_PERFIL_ " .
            "  AND A.ID_MODULO = B.ID_MODULO " .
            "  AND B.TABELA_ASSOCIADA = :TABELA_ ";

        if ($tabela != '' && $id_perfil != '') {
            try {
                $stmt = $db->prepare($sql);

                $stmt->bindParam(':ID_PERFIL_', $id_perfil, PDO::PARAM_STR);
                $stmt->bindParam(':TABELA_', $tabela, PDO::PARAM_STR);

                $stmt->execute();
            } catch (Exception $ex) {
                QuadCore::getErrors($db, $ex);
                #$msg = "get_workflow#1 :" . $ex->getMessage();
            }

            try {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $estado = $row['ESTADO'];
                    $modo_acesso = $row['MODO_ACESSO'];
                    $notif_ecran = $row['NOTIF_ECRAN'];
                    $notif_email = $row['NOTIF_EMAIL'];
                    $notif_sms = $row['NOTIF_SMS'];
                }
            } catch (Exception $ex) {
                QuadCore::getErrors($db, $ex);
                #$msg = "get_workflow#2 :" . $ex->getMessage();
            }
        }
    }

    #
    # identificação do utilizador portal/colaborador associado a um perfil $id_perfil para o colaborador identificado
    public function get_rhid_perfil_workflow(
        $db,
        $id_perfil,
        $empresa,
        $rhid,
        $dt_adm,
        $dt_ref,
        &$rhid_chefia,
        &$id_utilizador
    ) {
        $rhid_chefia = '';
        $id_utilizador = '';

        if ($dt_ref == '') {
            $dt_ref = date("Y-m-d");
        }

        if ($id_perfil != '' && $rhid != '' && $dt_ref != '') {
            $sql =
                "SELECT A.ID_UTILIZADOR, A.RHID_CHEFIA " .
                "FROM RH_ID_WORKFLOWS A " .
                "WHERE A.ID_PERFIL = :ID_PERFIL_ " .
                "  AND A.RHID = :RHID_ " .
                "  AND :DT_REF_ BETWEEN DATE_FORMAT(A.DT_INI,'%Y-%m-%d') AND NVL(DATE_FORMAT(A.DT_FIM,'%Y-%m-%d'),:DT_REF_) ";

            if ($empresa != '') {
                $sql .= "  AND A.EMPRESA = :EMPRESA_ ";
            }

            if ($dt_adm != '') {
                $sql .= "  AND A.DT_ADMISSAO = :DT_ADM_ ";
            }

            try {
                $stmt = $db->prepare($sql);

                $stmt->bindParam(':ID_PERFIL_', $id_perfil, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_', $rhid, PDO::PARAM_STR);
                $stmt->bindParam(':DT_REF_', $dt_ref, PDO::PARAM_STR);

                if ($empresa != '') {
                    $stmt->bindParam(':EMPRESA_', $empresa, PDO::PARAM_STR);
                }
                if ($dt_adm != '') {
                    $stmt->bindParam(':DT_ADM_', $dt_adm, PDO::PARAM_STR);
                }

                $stmt->execute();
            } catch (Exception $ex) {
                #$msg = "get_rhid_perfil_workflow#1 :" . $ex->getMessage();
                QuadCore::getErrors($db, $ex);
            }

            try {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $rhid_chefia = $row['RHID_CHEFIA'];
                    $id_utilizador = $row['ID_UTILIZADOR'];
                }
            } catch (Exception $ex) {
                #$msg = "get_rhid_perfil_workflow#2 :" . $ex->getMessage();
                QuadCore::getErrors($db, $ex);
            }
        }
    }

    #
    # obtenção do estado de workflow de um registo associado a uma tabela
    public function get_workflow_registo(
        $db,
        $tabela,
        $tp_perfil,
        $empresa,
        $rhid,
        $dt_adm,
        &$perfil_ini,
        &$nxt_perfil,
        &$last_perfil,
        &$finished
    ) {
        global $ui_parse_nok;
        #$executionStartTime = microtime(true);
        $dt_ref = '';
        $perfil_ini = '';
        $nr_ordem_wkf_ini = '';
        $nxt_perfil = '';
        $last_perfil = '';
        $finished = 'N';
        $estado_wkf = '';
        $modo_acesso = '';
        $notif_ecran = '';
        $notif_email = '';
        $notif_sms = '';

        $rhid_chefia = '';
        $id_utilizador = '';

        if ($tabela != '' && $tp_perfil != '') {
            # obtém o código do perfil inicial
            $this->get_id_tp_perfil(
                $db,
                $tp_perfil,
                $perfil_ini,
                $nr_ordem_wkf_ini
            );
            if ($nr_ordem_wkf_ini == '') {
                $dadosOut = array("error" => $ui_parse_nok);
                echo json_encode($dadosOut);
                die();
            } elseif ($perfil_ini != '') {
                $this->get_workflow(
                    $db,
                    $tabela,
                    $perfil_ini,
                    $estado_wkf,
                    $modo_acesso,
                    $notif_ecran,
                    $notif_email,
                    $notif_sms
                );

                # estado workflow: A - Ativo, B - Inativo
                if ($estado_wkf == 'A') {
                    # avalia à frente a cadeia de aprovação
                    null;
                } else {
                    # perfil com workflow inativo
                    # modo acesso: A - Manutenção, B - Consulta, Z - Sem Acesso
                    if ($modo_acesso == 'A') {
                        # workflow concluído -> auto-aprovação
                        $nxt_perfil = $perfil_ini;
                        $last_perfil = $perfil_ini;
                    } else {
                        $dadosOut = array("error" => $ui_parse_nok);
                        echo json_encode($dadosOut);
                        die();
                    }
                }
            }

            if ($nr_ordem_wkf_ini != '') {
                $sql =
                    "SELECT A.ID_MODULO, B.DSP_MODULO, A.ID_PERFIL, C.DSP_PERFIL, C.NR_ORDEM NR_ORDEM_WORKFLOW, C.TIPO_PERFIL, C.HIERARQUIA " .
                    "FROM  WEB_ADM_WORKFLOW A " .
                    "     ,WEB_ADM_MODULOS_PORTAL B " .
                    "     ,WEB_ADM_PERFIS C " .
                    " WHERE B.TABELA_ASSOCIADA = :TABELA_ " .
                    "   AND A.ID_MODULO = B.ID_MODULO " .
                    "   AND A.ID_PERFIL = C.ID " .
                    "   AND A.ESTADO = 'A' " .
                    "   AND B.ESTADO = 'A' " .
                    "   AND B.WORKFLOW = 'S' " .
                    "   AND C.ESTADO = 'A' " .
                    "   AND C.WORKFLOW = 'S' " .
                    "   AND C.NR_ORDEM > :NR_ORDEM_WKF_ " .
                    "ORDER BY B.NR_ORDEM, C.NR_ORDEM ";

                try {
                    $stmt = $db->prepare($sql);
                    $stmt->bindParam(':TABELA_', $tabela, PDO::PARAM_STR);
                    $stmt->bindParam(
                        ':NR_ORDEM_WKF_',
                        $nr_ordem_wkf_ini,
                        PDO::PARAM_STR
                    );
                    $stmt->execute();

                    $nxt_perfil = '';
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        # atualiza próximo perfil da cadeia de aprovação
                        if ($nxt_perfil == '') {
                            $nxt_perfil = $row['ID_PERFIL'];

                            # Apenas para os perfis definidos como Hierarquicos é que deverá ser validada
                            # a identificação do colaborador/utilizador a aprovar
                            if ($row['HIERARQUIA'] == 'S') {
                                ## valida se o perfil se encontra identificado para o colaborador em questão, caso contrário "salta" perfil
                                $this->get_rhid_perfil_workflow(
                                    $db,
                                    $nxt_perfil,
                                    $empresa,
                                    $rhid,
                                    $dt_adm,
                                    $dt_ref,
                                    $rhid_chefia,
                                    $id_utilizador
                                );

                                # se não tem perfil identificado, passa ao próximo nível
                                if (
                                    $rhid_chefia == '' &&
                                    $id_utilizador == ''
                                ) {
                                    $nxt_perfil = '';
                                }
                            }
                        }

                        # atualiza último perfil da cadeia de aprovação
                        $last_perfil = $row['ID_PERFIL'];

                        if (
                            $nxt_perfil != '' &&
                            $last_perfil != '' &&
                            $last_perfil == $nxt_perfil
                        ) {
                            null;
                        } elseif ($last_perfil != '') {
                            # Apenas para os perfis definidos como Hierarquicos é que deverá ser validada
                            # a identificação do colaborador/utilizador a aprovar
                            if ($row['HIERARQUIA'] == 'S') {
                                ## valida se o perfil se encontra identificado para o colaborador em questão, caso contrário "salta" perfil
                                $this->get_rhid_perfil_workflow(
                                    $db,
                                    $last_perfil,
                                    $empresa,
                                    $rhid,
                                    $dt_adm,
                                    $dt_ref,
                                    $rhid_chefia,
                                    $id_utilizador
                                );

                                # se não tem perfil identificado, passa ao próximo nível
                                if (
                                    $rhid_chefia == '' &&
                                    $id_utilizador == ''
                                ) {
                                    $last_perfil = '';
                                }
                            }
                        }
                    }

                    if (
                        $perfil_ini != '' &&
                        $last_perfil == '' &&
                        $nxt_perfil == ''
                    ) {
                        $finished = 'S';
                    }
                } catch (Exception $ex) {
                    QuadCore::getErrors($db, $ex);
                    #$msg = "get_workflow_registo#1 :" . $ex->getMessage();
                }

                # quando existe aprovação final -> o last_perfil fica com o id do perfil que efetuou
                if ($finished == 'S') {
                    $last_perfil = $perfil_ini;
                }
            }
        }
        #$executionEndTime = microtime(true);
        #$seconds = $executionEndTime - $executionStartTime;
        #echo "get_workflow_registo:$seconds<br/>";
    }

    #
    # obtenção da informação do colaborador (empresa,rhid,dt_admissão) a partir de uma chave de um registo de uma tabela
    public function get_info_colab($id, &$empresa, &$rhid, &$dt_adm)
    {
        $empresa = '';
        $rhid = '';
        $dt_adm = '';
        if (!empty($id)) {
            $json = json_decode($id, true);
            foreach ($json as $key => $value) {
                if (strtoupper($key) == 'EMPRESA') {
                    $empresa = $value;
                } elseif (strtoupper($key) == 'RHID') {
                    $rhid = $value;
                } elseif (strtoupper($key) == 'DT_ADMISSAO') {
                    $dt_adm = $value;
                }
            }
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
            if (
                isset($entry[$index]->datatype) &&
                mb_strtoupper($entry[$index]->datatype) == "JUST_EDITOR"
            ) {
                $count--;
                if ($index == $count) {
                    $myQryData = rtrim($myQryData, ', ');
                }
            }
            else {
                if ($value) {
                    if (
                        isset($entry[$index]->datatype) &&
                        mb_strtoupper($entry[$index]->datatype) !== "SEQUENCE"
                    ) {
                        $prop = mb_strtoupper($entry[$index]->datatype);
                        $val =
                            QuadCore::formatDatetypeToChar($value->db, $prop) . ',';
                    } else {
                        $val = "$value->db,";
                    }
                    $myQryData .= $val;
                }
                $index++;
                if ($index == $count) {
                    $myQryData = rtrim($myQryData, ', ');
                }
            }
        }
        return $myQryData;
    }

    public function getWhereClause($pk, $id, $dbCols)
    {
        $where = '';

        $json = json_decode($id, true);
        foreach ($json as $key => $value) {
            $entry = array_filter($dbCols, function ($e) use ($key) {
                return $e->db == $key;
            });
            $entry = reset($entry);
            if (
                isset($entry) &&
                isset($entry->datatype) &&
                mb_strtoupper($entry->datatype) !== "SEQUENCE"
            ) {
                $dateType = mb_strtoupper($entry->datatype);
                $clause = QuadCore::formatDatetypeToChar(
                    $key,
                    $dateType,
                    false
                );
                $clause .= "='$value'";
            } else {
                if (
                    isset($entry) &&
                    isset($entry->datatype) &&
                    mb_strtoupper($entry->datatype) == "SEQUENCE"
                ) {
                    if ($value) {
                        $clause = $key . " = '" . $value . "'";
                    }
                } else {
                    $clause = $key . " = '" . $value . "'";
                }
            }
            if ($value) {
    if ($where === '') {
        $where = $clause;
    } else {
        $where .= ' AND ' . $clause;
    }
            }
        }

        //old aproach to flat pk with separator

        /* $idArr = explode(PK_SEPARATOR, $id);
         $b = 0;
         foreach ($pk as $key) {
             $entry = array_filter($dbCols, function ($e) use ($key) {
                 return $e->db == $key;
             });
             $entry = reset($entry);
             if (isset($entry) && isset($entry->datatype)) {
                 $dateType = mb_strtoupper($entry->datatype);
                 $clause = QuadCore::formatDatetypeToChar(
                     $key,
                     $dateType,
                     false
                 );
                 $clause .= "='$idArr[$b]'";
             } else {
                 $clause = $key . " = '" . $idArr[$b] . "'";
             }

             if ($where === '') {
                 $where = $clause;
             } else {
                 $where .= ' AND ' . $clause;
             }
             if ($key == end($pk)) {
                 $where .= "";
             }
             $b++;
         }*/
        return $where;
    }

    public function getCurrentDateTime()
    {
        $time = date("Y-m-d H:i");
        $now = "TO_DATE('$time', 'YYYY-MM-DD hh24:mi')";
        return $now;
    }

    public function getBeforeAndAfterValues($myArray, $db = false)
    {
        $rowData1 = new stdClass();
        $rowData2 = new stdClass();

        for ($i = 0; $i < count($myArray); $i++) {
            $field = $myArray[$i]->db;

            //todo DRY move to method...complexlists

            $fieldValue = $myArray[$i]->prv_value;
            $rowData1->$field = $fieldValue;
            $field = $myArray[$i]->db;
            $fieldValue = $myArray[$i]->nxt_value;
            $rowData2->$field = $fieldValue;
        }
        $data = [];
        $data['prvVals'] = $rowData1;
        $data['nxtVals'] = $rowData2;

        return $data;
    }

    public function getPkString($pk, $myArray)
    {
        $columnNr = sizeof($myArray, 0);
        $pkstr = [];
        foreach ($pk as &$key) {
            for ($b = 0; $b < $columnNr; $b++) {
                $val = '';
                if ($key === $myArray[$b]->db) {
                    if (is_numeric($myArray[$b]->nxt_value)) {
                        $val = $myArray[$b]->nxt_value;
                    } else {
                        $val = str_replace("'", "''", $myArray[$b]->nxt_value);
                    }
                    //old aproach to work with PK
                    /*if ($pkstr === '') {
                        $pkstr = $val;
                    } else {
                        $pkstr .= PK_SEPARATOR . $val;
                    }
                    if ($key == end($pk)) {
                        $pkstr .= "";
                    }*/

                    $pkstr[$key] = $val;
                }
            }
        }
        //return $pkstr;
        return json_encode($pkstr);
    }

    public function returnRecordAfterWkf($db, $table, $where, $dbCols, $action,$col=null)
    {
        if ($action === 'DELETE') {
            $deleted = array('status' => 'deleted');
            echo json_encode($deleted);
            die();
        }
        $cols = self::getColumnsToString($dbCols);
        if($col === "BD_DOC"){
            $cols.= ", TO_BASE64(BD_DOC)BD_DOC"; //worflow knows nothing about instance atributes , so we have to hardcode...
        }
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
            QuadCore::getErrors($db, $ex);
        }
    }

    # avalia se já existe um registo de workflow para a mesma operação
    # removendo-o em caso de existência
    public function analyzePrevWorkflow(
        $tabela,
        $coluna,
        $operacao,
        $pk,
        $perfil_ini,
        $nxt_perfil,
        $last_perfil,
        $finished
    ) {
        global $db;

        # procura registos de workflow para a mesma tabela/operação/registo
        $sql =
            "SELECT * " .
            "FROM RH_ID_WORKFLOW_LOGS " .
            "WHERE TABELA = :TABELA_ ";

        if ($coluna != '') {
            $sql .= "  AND COLUNA = :COLUNA_";
        }

        $sql .=
            " AND OPERACAO = :OPERACAO_ " .
            " AND PK = :PK_ " .
            " AND FINISHED = 'N' " .
            " AND REJECTED = 'N' ";
        try {
            $stmt = $db->prepare($sql);

            $stmt->bindParam(':TABELA_', $tabela, PDO::PARAM_STR);
            if ($coluna != '') {
                $stmt->bindParam(':COLUNA_', $coluna, PDO::PARAM_STR);
            }
            $stmt->bindParam(':OPERACAO_', $operacao, PDO::PARAM_STR);
            $stmt->bindParam(':PK_', $pk, PDO::PARAM_STR);
            $stmt->execute();
            #echo "sql:$sql tabela:$tabela coluna:$coluna operacao:$operacao pk:$pk";

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                #echo "REMOVER:".$row['ID'];

                ## o registo agora introduzido irá sobrepor-se ao registo existente
                try {
                    $sql1 = "DELETE FROM RH_ID_WORKFLOW_LOGS WHERE ID = :ID_";
                    $stmt1 = $db->prepare($sql1);
                    $stmt1->bindParam(':ID_', $row['ID'], PDO::PARAM_STR);
                    $stmt1->execute();
                } catch (Exception $ex) {
                    QuadCore::getErrors($db, $ex);
                }
            }
        } catch (Exception $ex) {
            QuadCore::getErrors($db, $ex);
        }
    }
    #
    # execução de todos statments associados à aprovação/rejeição de um workflow
    # todo o processo é executado numa só transação na base de dados
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
            QuadCore::getErrors($conn, $ex);
            die();
        }

        return true;
    }
    //todo LED , nao esta como ultimo desenvolvimneto
    public function deleteWorkFlow($db,$id){
        try {
            $sql= "DELETE FROM RH_ID_WORKFLOW_LOGS WHERE ID = :ID_";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':ID_', $id, PDO::PARAM_STR);
            $stmt->execute();
            $resp=array(
                "workflow" => 'ok',
                "status" => 'deleted'
            );
            echo json_encode($resp);
        } catch (Exception $ex) {
            QuadCore::getErrors($db, $ex);
        }
    }

    #
    # aprovação de uma ocorrência de workflow
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
        $finished = "N"
    ) {
        $where = $this->getWhereClause($pk, $res['PK'], $dbCols);

        # tratamento do workflow
        //$finished = 'N';
        $perfil_ini = '';
        $nxt_perfil = '';
        $last_perfil = '';
        $empresa = '';
        $rhid = '';
        $dt_adm = '';

        $this->get_info_colab($res['PK'], $empresa, $rhid, $dt_adm);
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

        if ($perfil_ini == $last_perfil) {
            $qry =
                "UPDATE RH_ID_WORKFLOW_LOGS " .
                "SET LAST_PERFIL = '$last_perfil' " .
                "   ,FINISHED = '$finished' " .
                "WHERE ID = $id " .
                "  AND TABELA = '$table' " .
                "  AND FINISHED = 'N' " .
                "  AND REJECTED = 'N' ";
        } else {
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
        #            "UPDATE FO_ON_WORKFLOW SET estado =" .
        #            self::APROOVED .
        #            ", LAST_DT=$now  where id=$id AND tabela = '$table' ";
        if ($workFlow['mode'] === 'optimistic') {
            if (
                $res[0]['OPERACAO'] === 'INSERT' ||
                $res[0]['OPERACAO'] === 'DELETE'
            ) {
                if ($res[0]['OPERACAO'] === 'INSERT') {
                } elseif ($res[0]['OPERACAO'] === 'DELETE') {
                    $qry2 = "DELETE FROM $table WHERE $where ";
                }
            } else {
                $col = $res[0]['COLUNA'];

                //todo for complexLists

                $val = $res[0]['VLR_POS'];
                $where = $this->getWhereClause($pk, $res[0]['PK'], $dbCols);
                $qry2 = "UPDATE $table SET $col= '$val' where $where ";
            }
        }
        if ($workFlow['mode'] === 'postponed') {
            if (
                $res[0]['OPERACAO'] === 'INSERT' ||
                $res[0]['OPERACAO'] === 'DELETE'
            ) {
                $vals = '(';
                $cols = '(';
                $str = (string) $res[0]['VLR_POS'];
                $arr = json_decode($str, true);
                $index = 0;
                $count = count($arr);
                if ($res[0]['OPERACAO'] === 'INSERT') {
                    foreach ($arr as $key => $value) {
                        $entry = array_filter($dbCols, function ($e) use (
                            $key
                        ) {
                            return $e->db == $key;
                        });
                        if ($value) {
                            $cols .= $key;
                            if (isset($entry[$index]->datatype)) {
                                $prop = mb_strtoupper($entry[$index]->datatype);
                                $formatDateValue = QuadCore::$prop;
                                $value = "TO_DATE('$value', $formatDateValue)";
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
                } elseif ($res[0]['OPERACAO'] === 'DELETE') {
                    $qry2 = "DELETE FROM $table WHERE $where ";
                    //todo return status :deleted with $pk, $res[0]['PK'] done inside returnRecordAfterWkf
                }
            } else {
                $col = $res[0]['COLUNA'];
                $val = $res[0]['VLR_POS'];
                $qry2 = "UPDATE $table set $col= '$val' where $where ";
            }
            //todo transaction??
        }

        if ($this->doWorkFlowTransaction($qry2, $qry, $db)) {
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
    # rejeição de uma ocorrência de workflow
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
        $this->get_id_tp_perfil(
            $db,
            @$_SESSION['perfil'],
            $last_perfil,
            $nr_ordem_wkf
        );
        $qry =
            "UPDATE RH_ID_WORKFLOW_LOGS " .
            "SET REJECTED = 'S' " .
            "   ,LAST_PERFIL  = '$last_perfil' " .
            "WHERE ID = $id " .
            "  AND TABELA = '$table' " .
            "  AND FINISHED = 'N' " .
            "  AND REJECTED = 'N' ";
        #            "UPDATE FO_ON_WORKFLOW SET estado = " .
        #            self::REJECTED .
        #            " , LAST_DT=$now  where id=$id AND tabela = '$table' ";
        $where = $this->getWhereClause($pk, $res[0]['PK'], $dbCols);
        if ($this->wkfMode === 'optimistic') {
            if (
                $res[0]['OPERACAO'] === 'INSERT' ||
                $res[0]['OPERACAO'] === 'DELETE'
            ) {
                if ($res[0]['OPERACAO'] === 'INSERT') {
                    $qry2 = "DELETE FROM $table WHERE $where ";
                } elseif ($res[0]['OPERACAO'] === 'DELETE') {
                    $qry2 =
                        "UPDATE RH_ID_WORKFLOW_LOGS " .
                        "SET REJECTED = 'S' " .
                        "WHERE ID = $id " .
                        "  AND TABELA = '$table' " .
                        "  AND FINISHED = 'N' " .
                        "  AND REJECTED = 'N' ";
                    #                        "UPDATE FO_ON_WORKFLOW SET estado = " .
                    #                        self::REJECTED .
                    #                        " , LAST_DT=$now  where id=$id AND tabela = '$table' ";
                }
            } else {
                $col = $res[0]['COLUNA'];
                $val = $res[0]['VLR_ANT'];
                $qry2 = "UPDATE $table set $col= '$val' where $where ";
            }
        }
        if ($this->wkfMode === 'postponed') {
            if (
                $res[0]['OPERACAO'] === 'INSERT' ||
                $res[0]['OPERACAO'] === 'DELETE'
            ) {
                if ($res[0]['OPERACAO'] === 'INSERT') {
                    //todo do nothing return??
                } elseif ($res[0]['OPERACAO'] === 'DELETE') {
                    $qry2 = "DELETE FROM $table WHERE $where ";
                    //todo return satus:deleted with pk or $res[0]['RHID'].....
                }
            } else {
                $col = $res[0]['COLUNA'];
                $val = $res[0]['VLR_ANT'];
                $qry2 = "UPDATE $table set $col= '$val' where $where ";
            }
        }

        if ($this->doWorkFlowTransaction($qry2, $qry, $db)) {
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
    # aprovação massiva das ocorrências de workflows para uma tabela
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
        $where = $this->getWhereClause($pk, $res[0]['PK'], $dbCols);
        echo $this->returnRecordAfterWkf(
            $db,
            $table,
            $where,
            $dbCols,
            $res[0]['OPERACAO']
        );
    }

    #
    # rejeição massiva das ocorrências de workflows para uma tabela
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
        $where = $this->getWhereClause($pk, $res[0]['PK'], $dbCols);
        echo $this->returnRecordAfterWkf(
            $db,
            $table,
            $where,
            $dbCols,
            $res[0]['OPERACAO']
        );
    }

    public function decodeComplexList($cxLists, $column, $myArray, $myCxLists)
    {
        # o operador ternário continuava a dar erro
        if (isset($myCxLists[0]['distribute-value'])) {
            $arr = explode('@', $myCxLists[0]['distribute-value']);
        } else {
            $arr = explode('@', $myCxLists[0]['data-db-name']);
        }

        $decodedList = [];
        $jsonBefore = new stdClass();
        $jsonAfter = new stdClass();
        $val_ant = '';
        $val_pos = '';
        $count = count($arr);
        $index = 0;
        foreach ($arr as $field) {
            $index++;
            $field=str_replace("A.","",$field); //todo Led
            foreach ($myArray as $key => $value) {
                if ($field === $value->db) {
                    $val_ant .= $value->prv_value
                        ? $value->prv_value . '@'
                        : "null@";
                    $val_pos .= $value->nxt_value
                        ? $value->nxt_value . '@'
                        : "null@";

                    $jsonBefore->$field = $value->prv_value;
                    //todo fix this line
                    $jsonAfter->$field = $value->nxt_value
                        ? $value->nxt_value
                        : $value->prv_value;
                    //end todo...

                    //if ($index == $count) {
                    if (stripos(strrev($val_pos), strrev("null@")) === 0) {
                        //termina com null? quer dizer que lista tem novo valor nulo

                        $jsonAfter->$field = null;
                    }
                    // }
                }
            }
        }

        array_push($decodedList, json_encode($jsonBefore));
        array_push($decodedList, json_encode($jsonAfter));
        $colName = $myCxLists[0]['name']; //todo Led , isto necessario???

        $val_ant = rtrim($val_ant, "@ ");
        if (stripos(strrev($val_ant), strrev("null")) === 0) {
            //termina com null? quer dizer que lista tinha valor nulo

            $val_ant = null;
        }
        $val_pos = rtrim($val_pos, "@ ");

        if (stripos(strrev($val_pos), strrev("null")) === 0) {
            //termina com null? quer dizer que lista tem novo valor nulo

            $val_pos = null;
        }

        $memcache = new Memcached();
        $memcache->addServer('localhost', 11211);

        $sanitizedColumn=str_replace('A.', '',$myCxLists[0]['desigColumn']);
        if ($val_ant !== null) {
            $k = array_search(
                $val_ant,
                array_column(
                    $memcache->get(
                        str_replace(' ', '', $myCxLists[0]['idx']) .
                            @$_SESSION['lang']
                    ),
                    'VAL'
                )
            );
            $result = $memcache->get(
                str_replace(' ', '', $myCxLists[0]['idx']) . @$_SESSION['lang']
            )[$k];
            $valAnt = $result[$sanitizedColumn];
        } else {
            $valAnt = null;
        }
        if ($val_pos !== null) {
            $k2 = array_search(
                $val_pos,
                array_column(
                    $memcache->get(
                        str_replace(' ', '', $myCxLists[0]['idx']) .
                            @$_SESSION['lang']
                    ),
                    'VAL'
                )
            );
            $result = $memcache->get(
                str_replace(' ', '', $myCxLists[0]['idx']) . @$_SESSION['lang']
            )[$k2];

            $valPos = $result[$sanitizedColumn];
        } else {
            $valPos = null;
        }

        return [$colName, $valAnt, $valPos, $decodedList];
    }

    #
    # registo de uma ocorrência de workflow
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
        $data = $this->getBeforeAndAfterValues($myArray);

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
                            unset($decodedArrayData->$key);
                            $field = $list["name"];
                            $decodedArrayData->$field = $decodedData[2];
                        }
                    }
                }
            }
            $nxtValDecoded = json_encode($decodedArrayData);

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
                "(TABELA, OPERACAO, PK, VLR_ANT, VLR_POS, FINISHED, PERFIL_INI, NEXT_PERFIL, LAST_PERFIL, CTXLIST_VLR_POS) " .
                "VALUES(:TABELA_, :OPERACAO_, :PK_, :VLR_ANT_, :VLR_POS_, :FINISHED_, :PERFIL_INI_, :NEXT_PERFIL_, :LAST_PERFIL_, :CTXLIST_VLR_POS_) ";

            #            $sql =
            #                "INSERT INTO FO_ON_WORKFLOW (tabela, operacao, empresa,vlr_ant,vlr_pos, PK,  estado, usr_ins,perfil, dt_ins,CXLIST_VLR_APOS) " .
            #                "values ('$dbTable', '$operation',  'CMIP', null,'$nxtValDecoded','$pkstring','$estado','$this->user', '$this->perfil', $now,'$nxt') ";

            try {
                $stmt = $db->prepare($sql);

                $stmt->bindParam(':TABELA_', $dbTable, PDO::PARAM_STR);
                $stmt->bindParam(':OPERACAO_', $operation, PDO::PARAM_STR);
                $stmt->bindParam(':PK_', $pkstring, PDO::PARAM_STR);
                $stmt->bindParam(':VLR_ANT_', $null, PDO::PARAM_NULL);

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
                    $stmt->bindParam(':CTXLIST_VLR_POS_', $nxt, PDO::PARAM_STR);
                } else {
                    $stmt->bindParam(
                        ':CTXLIST_VLR_POS_',
                        $null,
                        PDO::PARAM_NULL
                    );
                }

                $stmt->execute();

                # obtem a informação do workflow criado
                $sql =
                    "SELECT * FROM RH_ID_WORKFLOW_LOGS ORDER BY ID DESC LIMIT 1";
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $wkf_info = $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                QuadCore::getErrors($db, $ex);
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
            if (isset($cxLists) && $cxLists != '' ) {
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

                if($column->prv_value === null) {
                    $resultAnt = null;
                    $valAnt = null;
                    $resultAntJson = null;
                } 
                else{
                    $k = array_search(
                        $column->prv_value,
                        array_column($data, 'RV_LOW_VALUE')
                    );
                    $resultAnt = $data[$k];
                    $valAnt = $resultAnt->RV_MEANING;

                    $resultAntJson = json_encode($resultAnt);
                }

                if($column->nxt_value===null){
                    $resultPos = null;
                    $valPos = null;
                    $resultPosJson =null;
                }else{
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
                    QuadCore::getErrors($db, $ex);
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
                    $valueAfter = $wkfType == "record" ? $nxt : $decodedData[2];
                    $stmt = $db->prepare($sql);
                    $stmt->bindParam(':TABELA_', $dbTable, PDO::PARAM_STR );
                    $stmt->bindParam(':COLUNA_', $decodedData[0], PDO::PARAM_STR);
                    $stmt->bindParam(':OPERACAO_', $operation, PDO::PARAM_STR);
                    $stmt->bindParam(':PK_', $pkstring, PDO::PARAM_STR);
                    $stmt->bindParam(':FINISHED_', $finished, PDO::PARAM_STR);
                    $stmt->bindParam(':PERFIL_INI_', $perfil_ini, PDO::PARAM_STR);

                    if ($valueBefore != '') {
                        $stmt->bindParam(':VLR_ANT_', $valueBefore, PDO::PARAM_STR);
                    } else {
                        $stmt->bindParam(':VLR_ANT_', $null, PDO::PARAM_NULL);
                    }

                    if ($valueAfter != '') {
                        $stmt->bindParam(':VLR_POS_', $valueAfter, PDO::PARAM_STR);
                    } else {
                        $stmt->bindParam(':VLR_POS_', $null, PDO::PARAM_NULL);
                    }

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

                    if ($cxListValAnt != '') {
                        $stmt->bindParam(
                            ':CTXLIST_VLR_ANT_', $cxListValAnt, PDO::PARAM_STR);
                    } else {
                        $stmt->bindParam(':CTXLIST_VLR_ANT_', $null, PDO::PARAM_NULL);
                    }

                    if ($cxListValPos != '') {
                        $stmt->bindParam(':CTXLIST_VLR_POS_', $cxListValPos, PDO::PARAM_STR);
                    } else {
                        $stmt->bindParam(':CTXLIST_VLR_POS_', $null, PDO::PARAM_NULL);
                    }
                    $stmt->execute();
                    $stmt->runAgain=false;
                } catch (Exception $ex) {
                    QuadCore::getErrors($db, $ex);
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
                    QuadCore::getErrors($db, $ex);
                }

                #                $sql =
                #                    "INSERT INTO FO_ON_WORKFLOW (tabela, operacao, coluna, empresa, pk, vlr_ant, vlr_pos,  estado, usr_ins, dt_ins,perfil) " .
                #                    "values ('$dbTable', '$operation', '$column->db', 'CMIP', '$pkstring',  '$column->prv_value', '$column->nxt_value', '$estado', '$this->user', $now,'$this->perfil') ";
            }

            try {
                #$stmt = $db->prepare($sql);

                //se estiverem envolvidas listas complexas, nao executar pois ja foi executado em contexto
                if(isset($stmt->runAgain) && $stmt->runAgain===false){
                    $null;
                }else{
                $stmt->execute();
                }

                # obtem a informação do workflow criado
                $sql =
                    "SELECT * FROM RH_ID_WORKFLOW_LOGS ORDER BY ID DESC LIMIT 1";
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $wkf_info = $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                QuadCore::getErrors($db, $ex);
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
                QuadCore::getErrors($db, $ex);
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
            QuadCore::getErrors($db, $ex, true);
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
}
/*function myAutoloader($className) {
    include 'classes/' . $className . '.php';
}
spl_autoload_register(myAutoloader);*/
