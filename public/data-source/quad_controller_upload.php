<?php

# cabeçaho do controlador
require_once 'quad_head_controller.php';
require_once 'QuadUploads.php';

require_once INCLUDES_PATH."/lib/gd_lib_controller.php";

$Upload = new QuadUploads($_REQUEST);

if (@$_REQUEST['operation'] === "IMPORT_MANUAL_DYRATES" && $_FILES) {
    $flag = 0;
    $Upload->UploadDyrates();
} elseif (@$_REQUEST['operation'] === "IMPORT_AVALIADOS" && $_FILES) {
    $flag = 0;
    $Upload->UploadAvaliados();
    # para parar o processo de upload standard
    $msg = 'STOP';
} else {
    $myArray = json_decode(@$_REQUEST['fieldsData']);
    $docsTable = json_decode(@$_REQUEST['docsTable']);
    $inRowDoc = json_decode(@$_REQUEST['inRowDoc']);

    if (is_object($myArray)) {
        $myData = json_decode($myArray->columnsArray);
        $dbTable = $myArray->table;
        if (isset($myArray->templateType)) {
            $templateType = $myArray->templateType;
        } else {
            $templateType = '';
        }
        if (isset($myArray->funcFields)) {
            $funcFields = $myArray->funcFields;
        } else {
            $funcFields = '';
        }
    }
    if (is_object($docsTable)) {
        $folder =
            DIRECTORY_SEPARATOR .
            ".." .
            DIRECTORY_SEPARATOR .
            $docsTable->savePath .
            DIRECTORY_SEPARATOR;
    }
}
if (@$_REQUEST['operation'] === "UPLOAD") {
    $ColsTable = json_decode($myArray->columnsArray);
    $ColsPK = $Upload->setPK($myArray->pk);
    $myArray->dbOperation = 'UPDATE';
    $msg = '';
    $Upload->saveUploads($ColsTable, $ColsPK, $inRowDoc, $msg);
    }

$ajax_id = @$_REQUEST['request_id'];
$len = 0;
if (strtoupper($Upload->operation) == 'SELECT') {
    //dont need to override quadCore, its ok
    $data = $Upload->prepareSelect();
    $Upload->doSelect($db, $data);
        }
if (strtoupper($Upload->operation) == 'INSERT') {
    $data = $Upload->prepareForCrud();
    $Upload->doInsert($db, $data);
} elseif (strtoupper($Upload->operation) == 'UPDATE') {
    $data = $Upload->prepareForCrud();
    $Upload->doUpdate($db, $data);
} elseif (strtoupper($Upload->operation) == 'DELETE') {
    $data = $Upload->prepareForCrud();
    $Upload->doDelete($db, $data);
        }

//todo search for ID_PROC_GD refator/integrate  search for ###Estacio code here?? bookmark
## especificidade associada ao controlador de RH_ID_GD_DOCS
/*if (
    $msg == '' &&
    $table == 'RH_ID_GD_DOCS' &&
    $tempFile != ''
                        ) {
                                            if ($data[0]['ID_PROC_GD'] != '') {
                                                $return_msg = '';
                                                $msg2 = '';
        if (
            $data[0]['ID_PROC_GD'] != ''
        ) {
                                                    gd_avalia_fase(
                                                        $data[0]['ID_PROC_GD'],
                                                        '',
                                                        $return_msg,
                                                        $msg2
                                                    );
                                                }
                                            }
}*/
