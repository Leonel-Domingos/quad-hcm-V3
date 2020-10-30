<?php
/*
 * Controlador das complexLists
 *
 * PTE 2019.09.24 - refatorização do código
 */
require_once 'quad_head_controller.php';

$memcache = new Memcached();
$memcache->addServer('localhost', 11211);

require_once ("ComplexList.php");

$results = [];
$msg = '';
$debug = false;

# !ATENÇÃO! - desligar a cache irá desabilitar o mecânismo de descodificação utilizado pelo workflow
$cache = true;

# obtem as variáveis de entrada
$multiReq = @$_POST['multiRequest'];

if (@$_POST['multiRequest']) {
    $dataReq = @$_POST['lists'];
} else {
    $dataReq = @$_POST;
}

# trata as variáveis obtidas
if (isset($dataReq)) {
    foreach ($dataReq as $key => $val) {
        # instanciação da class ComplexList
        isset($_POST['multiRequest'])
            ? ($lista = new ComplexList($multiReq, $dataReq[$key], $key))
            : ($lista = new ComplexList($multiReq, $dataReq, $key));

        $lista->set_debug($debug);

        # cache ativa ?
        if ($cache && $lista->renew == 'N') {
            # verifica se a lista já está em memória e restorna conteúdo caso exista
            $cached = $lista->isCached($memcache);
        } else {
            $cached = false;
        }
$cached = false;

        # se o conteúdo já se encontra em cache
        if ($cached) {
            if ($debug) {
                echo "CACHED";
            }
            # se não é um pedido multiRequest, sai devolvendo os dados obtidos
            if (!isset($_POST['multiRequest'])) {
                $results = $cached;
                break;
            } else {
                //$idx = $pk_db_name . ">" . $dbTable . ">" . $desigColumn . ">" . $where . ">" . $orderBy;
                $idx = $key;
                $results['data'][$idx] = $cached;
            }
        } 
        else {
            if ($debug) {
                echo "NOT CACHED";
            }
            # constroi o SQL para efetuar o SELECT
            $lista->buildSelectSQL();

            # executa o SQL
            $res = $lista->executeSQL($db, $memcache, $msg);

            # tratamento do erro
            if ($msg != '') {
                # para a execução e devolve o erro
                break;
            } else {
                # se não é um pedido multiRequest, sai devolvendo os dados obtidos
                if (!isset($_POST['multiRequest'])) {
                    $results = $res;
                    break;
                } else {
                    //$idx = $pk_db_name . ">" . $dbTable . ">" . $desigColumn . ">" . $where . ">" . $orderBy;
                    $idx = $key;
                    $results['data'][$idx] = $res;
                }
            }
        }
    }
}

# devolução do resultado
if ($msg == '') {
    echo json_encode($results);
} else {
    $dadosOut = array(
        "error" => $msg
    );
    echo json_encode($dadosOut);
}
