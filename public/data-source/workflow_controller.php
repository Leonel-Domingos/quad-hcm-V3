<?php
/**
 * Created by PhpStorm.
 * User: led
 * Date: 27-03-2018
 * Time: 11:56
 */
require_once "quad_head_controller.php";

function setPK($primarykey)
{
    $odb = [];

    foreach ($primarykey as $key => $value) {
        array_push($odb, "" . $key);
    }
    return $odb;
}

require_once INCLUDES_PATH."/lib/quad_db_lib.php";
require_once 'Workflow.php';
$msg = '';
$oci_erro = '';

if ($_POST["pk"]) {
    $pk = $_POST["pk"];
    $primary = $_POST["pk"];
    $pk = setPK($primary);
}

$myArray = json_decode(@$_POST['columnsArray']);
$dbCols = json_decode(@$_POST['dbColumns']);
$table = @$_POST['table'];
$operation = @$_POST['operation'];
$wkfInfo = @$_POST['wkfInfo'];
$workFlow = @$_POST['workFlow'];
$cxLists = @$_POST['cxLists'];
$domains = @$_POST['domains'];

$q = $db->prepare("DESCRIBE RH_ID_WORKFLOW_LOGS");
$q->execute();
$tablefields = $q->fetchAll(PDO::FETCH_COLUMN);

$idx = array_search("BD_DOC_ANT", $tablefields);
if ($idx) {
    $tablefields[$idx] = "TO_BASE64(BD_DOC_ANT)BD_DOC_ANT";
}
$idx = array_search("BD_DOC_POS", $tablefields);
if ($idx) {
    $tablefields[$idx] = "TO_BASE64(BD_DOC_POS)BD_DOC_POS";
}

$listOfColsString = implode(",", $tablefields);
# de acordo com o modo definido na instÃ¢ncia, escolhe a classe que implementa o modelo de workflow (postponed ou optimistic)
if ($workFlow['mode'] === 'postponed') {
    require_once 'WorkFlowPostPoned.php';
    $wkf = new WorkFlowPostPoned(@$_SESSION["nome"], @$_SESSION["perfil"]);
} elseif ($workFlow['mode'] === 'optimistic') {
    require_once 'WorkFlowOptimistic.php';
    $wkf = new WorkFlowOptimistic(@$_SESSION["nome"], @$_SESSION["perfil"]);
}

//$wkf = new Workflow($workFlow);
$now = $wkf->getCurrentDateTime();
$pkstring = $wkf->getPkString($pk, $dbCols);

if (isset($_POST['idWkf'])) {
    $id = @$_POST['idWkf'];
}
if (isset($_POST['results'])) {
    $wkfList = @$_POST['results'];
}

#
# devolve a informação de workflow de uma tabela para uma instância
if ($operation === 'get') {
    $empresa = '';
    $rhid = '';
    $dt_adm = '';
    $whr_empresa = '';
    $whr_rhid = '';
    $whr_dt_adm = '';
    $wkf->get_info_colab($pkstring,$empresa,$rhid,$dt_adm);
    if ($empresa != '') {
        $whr_empresa = "  AND JSON_EXTRACT(w.PK,'$.EMPRESA') = :EMPRESA_ ";
    }
    if ($rhid != '') {
        $whr_rhid = "  AND JSON_EXTRACT(w.PK,'$.RHID') = :RHID_ ";
    }
    if ($dt_adm != '') {
        $whr_dt_adm = "  AND JSON_EXTRACT(w.PK,'$.DT_ADMISSAO') = :DT_ADMISSAO_ ";
    }
    #echo "empresa:$empresa rhid:$rhid dt_adm:$dt_adm";
    try {
        # workflow ao registo
        if ($wkfInfo === 'byRecord') {
            //all wkf on table requested
#        $qry = " SELECT w.* FROM FO_ON_WORKFLOW w where estado='0' AND (w.operacao='DELETE' OR w.operacao='INSERT') AND w.tabela = '$table' ";
            $qry =
                "SELECT $listOfColsString " .
                   "FROM RH_ID_WORKFLOW_LOGS w ".
                   "WHERE w.TABELA = :TABELA_ ".
                   "  AND (w.OPERACAO = :OPERATION1_ OR w.OPERACAO = :OPERATION2_) ".
                   "  AND w.FINISHED = :FINISHED_ ".
                "  AND w.REJECTED = :REJECTED_ ";

            if ($whr_empresa != '') {
                $qry .= $whr_empresa;
            }
            /*if ($whr_rhid != '') {
                $qry .= $whr_rhid;
            }
            if ($whr_dt_adm != '') {
                $qry .= $whr_dt_adm;
            }*/

            $oper1_ = 'DELETE';
            $oper2_ = 'INSERT';
            $no = 'N';
            $stmt = $db->prepare($qry);
            $stmt->bindParam(':TABELA_', $table, PDO::PARAM_STR);
            $stmt->bindParam(':OPERATION1_', $oper1_, PDO::PARAM_STR);
            $stmt->bindParam(':OPERATION2_', $oper2_, PDO::PARAM_STR);
            $stmt->bindParam(':FINISHED_', $no, PDO::PARAM_STR);
            $stmt->bindParam(':REJECTED_', $no, PDO::PARAM_STR);
            if ($whr_empresa) {
                $stmt->bindParam(':EMPRESA_', $empresa, PDO::PARAM_STR);
            }
            /*if ($whr_rhid) {
                $stmt->bindParam(':RHID_', $rhid, PDO::PARAM_STR);
            }
            if ($whr_dt_adm) {
                $stmt->bindParam(':DT_ADMISSAO_', $dt_adm, PDO::PARAM_STR);
            }*/
            }
        # workflow Ã  coluna
        elseif ($wkfInfo === 'byColumn') {
            //wkf requested by table and id of record
#            " SELECT w.* FROM FO_ON_WORKFLOW w where  estado='0' AND w.tabela = '$table' " .
#            " AND w.operacao='UPDATE' AND w.pk = '$pkstring' ";
            $qry =
                " SELECT $listOfColsString " .
                   "FROM RH_ID_WORKFLOW_LOGS w ".
                   "WHERE w.TABELA = :TABELA_ ".
                   "  AND w.OPERACAO = :OPERATION1_ ".
                   "  AND w.FINISHED = :FINISHED_ ".
                "  AND w.REJECTED = :REJECTED_ ";

            if ($whr_empresa != '') {
                $qry .= $whr_empresa;
            }
            /*if ($whr_rhid != '') {
                $qry .= $whr_rhid;
            }
            if ($whr_dt_adm != '') {
                $qry .= $whr_dt_adm;
            }*/

            $oper1_ = 'UPDATE';
            $no = 'N';
            $stmt = $db->prepare($qry);
            $stmt->bindParam(':TABELA_', $table, PDO::PARAM_STR);
            $stmt->bindParam(':OPERATION1_', $oper1_, PDO::PARAM_STR);
            $stmt->bindParam(':FINISHED_', $no, PDO::PARAM_STR);
            $stmt->bindParam(':REJECTED_', $no, PDO::PARAM_STR);
            if ($whr_empresa) {
                $stmt->bindParam(':EMPRESA_', $empresa, PDO::PARAM_STR);
            }
            /*if ($whr_rhid) {
                $stmt->bindParam(':RHID_', $rhid, PDO::PARAM_STR);
            }
            if ($whr_dt_adm) {
                $stmt->bindParam(':DT_ADMISSAO_', $dt_adm, PDO::PARAM_STR);
            }*/
            }
        # toda a informaÃ§Ã£o de workflow da tabelas
        else {
#$qry = " SELECT w.* FROM FO_ON_WORKFLOW w where  estado='0' AND w.tabela = '$table' ";
            $qry =
                "SELECT $listOfColsString " .
                   "FROM RH_ID_WORKFLOW_LOGS w ".
                   "WHERE w.TABELA = :TABELA_ ".
                   "  AND w.FINISHED = :FINISHED_ ".
                "  AND w.REJECTED = :REJECTED_ ";

            if ($whr_empresa != '') {
                $qry .= $whr_empresa;
            }
            /*if ($whr_rhid != '') {
                $qry .= $whr_rhid;
            }
            if ($whr_dt_adm != '') {
                $qry .= $whr_dt_adm;
            }*/

            $no = 'N';
            $stmt = $db->prepare($qry);
            $stmt->bindParam(':TABELA_', $table, PDO::PARAM_STR);
            $stmt->bindParam(':FINISHED_', $no, PDO::PARAM_STR);
            $stmt->bindParam(':REJECTED_', $no, PDO::PARAM_STR);
            if ($whr_empresa) {
                $stmt->bindParam(':EMPRESA_', $empresa, PDO::PARAM_STR);
            }
            //todo LED
            // no form sem filtro e numa table master sem filtro, isto nao funciona....
            //TODO ISTO SO SE APLICA A ENTIDADES COM EMPRESA E RHID?
            /*if ($whr_rhid) {
                $stmt->bindParam(':RHID_', $rhid, PDO::PARAM_STR);
            }
            if ($whr_dt_adm) {
                $stmt->bindParam(':DT_ADMISSAO_', $dt_adm, PDO::PARAM_STR);
            }*/
            }

        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($res);
    } 
    catch (Exception $ex) {
        echo QuadCore::getErrors($db, $ex);
    }
}
#
# implementa a ação de delete de uma ocorrência workflow
if ($operation === 'delete') {
    $wkf->deleteWorkFlow($db,$id);
}
#
# implementa a ação de aprovação de uma ocorrência workflow
elseif ($operation === 'aproove') {
    $wkf->aprooveWorkFlow(
        $id,
        $table,
        $workFlow,
        $db,
        $now,
        $wkfList,
        $pk,
        $dbCols,
        false,
        $cxLists,
        $domains,
        "N",
        true,
        true
    );
}
#
# implementa a ação de rejeição de uma ocorrência de workflow
elseif ($operation === 'reject') {
    $wkf->rejectWorkFlow(
        $id,
        $table,
        $workFlow,
        $db,
        $now,
        $wkfList,
        $pk,
        $dbCols,
        false,
        $cxLists,
        $domains
    );
}
#
# implementa a ação de aprovação massiva das ocorrências de workflows para uma tabela
elseif ($operation === 'aprooveAll') {
    //todo foreach _POST results
    $wkf->aprooveWorkFlowBulk(
        $id,
        $table,
        $workFlow,
        $db,
        $wkfList,
        $now,
        $pk,
        $dbCols,
        $cxLists
    );
}
#
# implementa a ação de rejeição massiva das ocorrências de workflows para uma tabela
elseif ($operation === 'rejectAll') {
    //todo foreach _POST results
    $wkf->rejectWorkFlowBulk(
        $id,
        $table,
        $workFlow,
        $db,
        $wkfList,
        $now,
        $pk,
        $dbCols,
        $cxLists
    );
}
