<?php
# cabeçaho do controlador
require_once 'quad_head_controller.php';

# tratamento de evocação por workers
$workerData = json_decode(file_get_contents("php://input"));
if ($workerData) {
    foreach ($workerData as $key => $val) {
        if ($key === 'request_id') {
            $ajax_id = $val;
        }

        if ($key === 'empresa') {
            $empresa = $val;
        }
    }
    $status = '';
    $mssg = '';
    //$empresa = @$_REQUEST['empresa'];
    //Executar o procedimento para a Empresa (internamente é determinado o Ano/Mês em processamento
    $sql = "BEGIN PRS_CALCULA_PREMIOS (:empresa, :msg); END;";

    $stmt = $db->prepare($sql);

    //Parâmetro de entrada
    $stmt->bindParam(':empresa', $empresa, 32);

    //Parâmetro de saída

    // oci_fetch_all($stmt, $res, 0, -1, OCI_FETCHSTATEMENT_BY_ROW);
    //$results = $res;
    $r = $stmt->execute();
    if (!$r) {
        $e = oci_error($stmt); // For oci_execute errors pass the statement handle
        $msg = $e['message'];
    }

    if ($msg != '') {
        $dadosOut = array(
            "msg" => $msg
        );
    } elseif ($mssg != '') {
        $dadosOut = array(
            "msg" => $mssg
        );
    }
    oci_free_statement($stmt);
    if ($msg != '' || $mssg != '') {
        echo json_encode($dadosOut);
    }

    $msg = 'STOP';
}

#if ($msg == '' && $operation == 'PROCEDURE' && $reference != '') {
#    $quadProc = new QuadProcedure($reference, @$_REQUEST);
#    $quadProc->execProc($db);
#    $msg = 'STOP'; # para impedir a execução da component standard do controlador
#}

require_once 'QuadCore.php';
if (QuadCore::extendedTable($_REQUEST['table']) === 'S') {
    require_once 'QuadCore_Extended.php';
    $Core = new QuadCore_Extended($_REQUEST);
}
else {
    $Core = new QuadCore($_REQUEST);
}

if (strtoupper($Core->operation) == 'SELECT') {
    $data = $Core->prepareSelect();
    $Core->doSelect($db, $data);
}
if (strtoupper($Core->operation) == 'INSERT') {
    $data = $Core->prepareForCrud();
    $Core->doInsert($db, $data);
} elseif (strtoupper($Core->operation) == 'UPDATE') {
    $data = $Core->prepareForCrud();
    $Core->doUpdate($db, $data);
} elseif (strtoupper($Core->operation) == 'DELETE') {
    $data = $Core->prepareForCrud();
    $Core->doDelete($db, $data);
}
