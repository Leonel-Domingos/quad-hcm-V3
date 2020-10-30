<?php
/*
 *  @autor      Pedro Estácio <pedro.estacio@quad-systems.com>
 *  @versão     2.0
 *  @revisão    2018.10.20
 *  @copyright  (c) 2018 QuadSystems - http://www.quad-systems.com
 *  @nome     	dk_action_controller.php
 *  @descrição  Controlador específico para implementar as ações associadas ao módulo de calculo de coeficientes de prémios.
 *
 */

# cabeçaho do controlador
require_once 'quad_head_controller.php';

require_once INCLUDES_PATH."/lib/dk_lib.php";

## inicializações
$action = '';
$empresa_ = '';
$ano_ = '';
$mes_ = '';
$request_data_ = '';

## chamado a partir de um worker ?
$workerData = json_decode(file_get_contents("php://input"));
if ($workerData) {

    foreach ($workerData as $key => $val) {

        ## ação
        if ($key === 'request_id') {
            $action = strtoupper($val);
        }

        ## empresa
        if ($key === 'empresa') {
            $empresa_ = $val;
        }

        ## ano
        if ($key === 'ano') {
            $ano_ = $val;
        }

        ## mes
        if ($key === 'mes') {
            $mes_ = $val;
        }
        ## request_data
        if ($key === 'request_data') {
            $request_data_ = $val;
        }

        ## database
        if ($key === 'database') {
            if (@$_SESSION['database'] == '') {
                    @$_SESSION['database'] = $val;
            }
        }

        ## utilizador
        if ($key === 'utilizador') {
            if (@$_SESSION['utilizador'] == '') {
                    @$_SESSION['utilizador'] = $val;
            }
        }

    }
} else {
    ## ação a executar pelo controlador sem ser chamado pelo worker
    ##
    $action = strtoupper(@$_REQUEST['request_id']);
    $key =  @$_REQUEST['pk'];
}


## cálculo de coeficientes
if ($action == 'CALCULO') {
    if ($empresa_ != '' && $ano_ != '' && $mes_ != '') {

        $msg_ = '';
        dk_calcula_premios($empresa_, $ano_, $mes_, $msg_);
        if ($msg_ == '') {
            $dadosOut = array(
                "error" => "",
                "msg" => $ui_successful_operation,
            );
        } else {
            $dadosOut = array(
                "error" => $msg_,
                "msg" => ""
            );
        }
        echo json_encode($dadosOut);
    }
}
## gravação / aprovação de alteração em coeficiente
elseif ($action == 'SAVE_COEF') {

    $key =  @$_REQUEST['pk'];
    if ($key != '') {
        $pct_ = @$_REQUEST['value'];
        $p = explode("@",$key);
        $empresa_ = $p[0];
        $ano_ = $p[1];
        $mes_ = $p[2];
        $rhid_ = $p[3];
        $dt_adm_ = $p[4];
        $cd_ind_ = $p[5];
        $dt_ind_ = $p[6];
        $msg_ = '';

        if ($empresa_ != '' && $ano_ != '' && $mes_ != '' && $rhid_ != '' && $dt_adm_ != '' && $cd_ind_ != '' && $dt_ind_ != '') {

            dk_save_pct_indicador($empresa_, $ano_, $mes_, $rhid_ , $dt_adm_, $cd_ind_, $dt_ind_, $pct_, $msg_);
            if ($msg_ == '') {
                $dadosOut = array(
                    "error" => "",
                    "msg" => $ui_successful_operation,
                );      
            } else {
                $dadosOut = array(
                    "error" => $msg_,
                    "msg" => ""
                );
            } 
            echo json_encode($dadosOut);           
        }
    }
}
## rejeição de alteração em coeficiente
elseif ($action == 'REJECT_COEF' && $key != '') {

    $key =  @$_REQUEST['pk'];
    if ($key != '') {
        $p = explode("@",$key);
        $empresa_ = $p[0];
        $ano_ = $p[1];
        $mes_ = $p[2];
        $rhid_ = $p[3];
        $dt_adm_ = $p[4];
        $cd_ind_ = $p[5];
        $dt_ind_ = $p[6];
        $msg_ = '';
        $pct_ant_ = '';
        $pct_ = '';
        $fase_ = '';

        dk_reject_pct_indicador($empresa_, $ano_, $mes_, $rhid_ , $dt_adm_, $cd_ind_, $dt_ind_, $msg_);

        if ($msg_ == '') {
            $pct_ = dk_get_pct_indicador($empresa_, $ano_, $mes_, $rhid_ , $dt_adm_, $cd_ind_, $dt_ind_, $pct_ant_, $fase_, $msg_);
        }

        if ($msg_ == '') {
            $dadosOut = array(
                "error" => "",
                "msg" => $ui_successful_operation,
                "value" => $pct_,
            );
        } else {
            $dadosOut = array(
                "error" => $msg_,
                "msg" => "",
                "value" => ""
            );
        }
        echo json_encode($dadosOut);
    }
}
## aprovação de valor de indicador
elseif ($action == 'APROV_IND' && $key != '') {
    $id_ = $key;
}
## rejeição de valor de indicador
elseif ($action == 'REJECT_IND' && $key != '') {
    $id_ = $key;
}
## encerramento de mês
elseif ($action == 'ENCERRA_MES') {
    if ($empresa_ != '' && $ano_ != '' && $mes_ != '') {
        $msg_ = '';
        dk_encerra_mes($empresa_, $ano_, $mes_, $msg_);
        if ($msg_ == '') {
            $dadosOut = array(
                "error" => "",
                "msg" => $ui_successful_operation,
            );
        } else {
            $dadosOut = array(
                "error" => $msg_,
                "msg" => ""
            );
        }
        echo json_encode($dadosOut);
    }
}
## reabertura de mês
elseif ($action == 'REABRE_MES') {
    if ($empresa_ != '' && $ano_ != '' && $mes_ != '') {
        $msg_ = '';
        dk_reabre_mes($empresa_, $ano_, $mes_, $msg_);
        if ($msg_ == '') {
            $dadosOut = array(
                "error" => "",
                "msg" => $ui_successful_operation,
            );
        } else {
            $dadosOut = array(
                "error" => $msg_,
                "msg" => ""
            );
        }
        echo json_encode($dadosOut);
    }
}
## aprovar valores de indicadores
elseif ($action == 'APROVAR_VALORES') {

    $msg = '';
    $lista = $request_data_;
    foreach ($lista as $key => $value) {
        $id_ = $value;
        dk_aprova_valor_indicador($id_, $msg);
        if ($msg != '') {
            break;
        }
    }

    if ($msg == '') {
        $dadosOut = array(
            "error" => "",
            "msg" => $ui_successful_operation,
        );
    } else {
        $dadosOut = array(
            "error" => $msg,
            "msg" => ""
        );
    }
    echo json_encode($dadosOut);
}
## rejeitar valores de indicadores
elseif ($action == 'REJEITAR_VALORES') {

    $msg = '';
    $lista = $request_data_;
    foreach ($lista as $key => $value) {
        $id_ = $value;
        dk_rejeita_valor_indicador($id_, $msg);
        if ($msg != '') {
            break;
        }
    }

    if ($msg_ == '') {
        $dadosOut = array(
            "error" => "",
            "msg" => $ui_successful_operation,
        );
    } else {
        $dadosOut = array(
            "error" => $msg_,
            "msg" => ""
        );
    }
    echo json_encode($dadosOut);
}

?>