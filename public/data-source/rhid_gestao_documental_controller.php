<?php
# cabeçaho do controlador
require_once 'quad_head_controller.php';
require_once INCLUDES_PATH.'/lib/gd_lib_controller.php';

require_once 'QuadCore.php';
$Core = new QuadCore($_REQUEST);
if (strtoupper($Core->operation) == 'SELECT') {
    $data = $Core->prepareSelect();
    $Core->doSelect($db, $data);
}
if (strtoupper($Core->operation) == 'INSERT') {
    $data = $Core->prepareForCrud();
    $Core->doInsert($db, $data);
    gd_cria_gd_registos($Core->data[0]->nxt_value, 'INSERT', $msg);
} elseif (strtoupper($Core->operation) == 'UPDATE') {
    $data = $Core->prepareForCrud();
    $Core->doUpdate($db, $data);
    gd_cria_gd_registos($Core->data[0]->nxt_value, 'UPDATE', $msg);
} elseif (strtoupper($Core->operation) == 'DELETE') {
    $data = $Core->prepareForCrud();
    $Core->doDelete($db, $data);

    if ($Core->data[0]["prv_value"] != '') {
        gd_remove_gd_registos($Core->data[0]["prv_value"], $msg);
    }
}
