<?php
/*
 *  @autor      Pedro Estácio <pedro.estacio@quad-systems.com>
 *  @versão     2.0
 *  @revisão    2019.10.20
 *  @copyright  (c) 2018 QuadSystems - http://www.quad-systems.com
 *  @nome     	quad_validador.php
 *  @descrição  Controlador específico para implementar as validações de interfaces.
 *
 */

# cabeçaho do controlador
require_once 'quad_head_controller.php';

require_once 'QuadValidator.php';

$reference = @$_REQUEST['reference'];
$action =  @$_REQUEST['action'];
$data =  @$_REQUEST['data'];
$workflow =  @$_REQUEST['workflow'];
$msg = '';

$Validator = new QuadValidator($db, $reference, $action, $data, $workflow);
$Validator->Validate($msg);

# existe erro a reportar
if ($msg != '') {
    $dadosOut = array(
        "error" => $msg
    );
} else {
    $dadosOut = array(
        "msg" => "OK"
    );
}    
echo json_encode($dadosOut);

?>