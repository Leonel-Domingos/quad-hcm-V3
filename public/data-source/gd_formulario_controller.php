<?php
/*
 *  @autor      Pedro Estácio <pedro.estacio@quad-systems.com>
 *  @versão     2.0
 *  @revisão    2018.07.11
 *  @copyright  (c) 2018 QuadSystems - http://www.quad-systems.com
 *  @nome     	gd_formulario_controller.php
 *  @descrição  controlador de suporte ao preenchimento de formulário de gestáo documental.
 *
 */

# cabeçaho do controlador
require_once 'quad_head_controller.php';
require_once INCLUDES_PATH.'/lib/gd_lib_controller.php';

##
## ação a executar pelo controlador.
## 
## por defeito efetua a gravação das variáveis recolhidas para um formulário
## que são indicadas nas matriz request_data
$action = @$_REQUEST['action'];
$myArray = json_decode(@$_REQUEST['request_data']);


## aprovação de uma etapa de gestão documental
if ($action == 'aprovado') {
    $id_proc_gd_ = @$_REQUEST['id_proc_gd'];
    $newMasterStatus = "";
    if ($id_proc_gd_ != '') {
        $msg == '';
        gd_avalia_fase($id_proc_gd_, '', $newMasterStatus, $msg);

        if ($msg == '') {
            $dadosOut = array(
                "error" => "",
                "msg" => $hint_gd_wkf_approved,
                "newMasterStatus" => $newMasterStatus
            );      
        } else {
            $dadosOut = array(
                "error" => $msg,
                "msg" => "",
                "newMasterStatus" => ""
            );
        } 
        echo json_encode($dadosOut);        
    }
} 
## rejeição de uma etapa de gestão documental
elseif ($action == 'rejeitado') {
    $id_proc_gd_ = @$_REQUEST['id_proc_gd'];
    $newMasterStatus = "";
    if ($id_proc_gd_ != '') {
        $msg == '';
        gd_avalia_fase($id_proc_gd_, 'P', $newMasterStatus, $msg);

        if ($msg == '') {
            $dadosOut = array(
                "error" => "",
                "msg" => $hint_gd_wkf_rejecteded,
                "newMasterStatus" => $newMasterStatus
            );      
        } else {
            $dadosOut = array(
                "error" => $msg,
                "msg" => "",
                "newMasterStatus" => ""
            );
        } 
        echo json_encode($dadosOut);        
    }
} 
## lista de tipo de modelos de documentos
elseif ($action == "GD_TIPOS") {
    $msg = '';
    $graf = @$_REQUEST['graf'];
    $mode = @$_REQUEST['mode'];
    $val = @$_REQUEST['value'];
    $cd = '';
    $dt = '';
    if ($val) {
        $p = explode("@",$val);
        $cd = $p[0];
        $dt = $p[1];
    }
    $res = array();
    $res = list_DG_GESTAO_DOCUMENTAL ($cd, $dt, $graf, $mode, $msg);
    echo json_encode($res);
}
## lista de modelos de documentos
elseif ($action == "GD_MODELOS") {
    $msg = '';
    $mode = @$_REQUEST['mode'];
    $parameters_array = json_decode (@$_REQUEST['params_array']);

    $gd = $parameters_array[0];
    $p = explode("@",$gd);
    $cd_gd = $p[0];
    $dt_gd = $p[1];

    $det_gd = $parameters_array[1];
    $p = explode("@",$det_gd);
    $cd_det_gd = $p[0];
    if (count($p) > 1) {
        $dt_det_gd = $p[1];
    } else {
        $dt_det_gd = '';
    }
    $res = array();
    $res = list_DG_DET_GESTAO_DOCUMENTAL($cd_gd, $dt_gd, $cd_det_gd, $dt_det_gd, $mode, $msg);
    echo json_encode($res);
}    
## gravação das variáveis do formulário
elseif (isset($myArray)) {

    $msg = '';
    if (isset($myArray[0]->key)) {
        $masterKey = $myArray[0]->key;
        if ($masterKey) {
            $nr_records = 0;
            foreach ($myArray[1] as $key => $value) {
                $dsp = [];
                $val = '';
                $dsp = explode('|@|',$value);

                if ( count($dsp) > 1) {
                    $val = $dsp[0];
                    $dsp = $dsp[1];
//                    echo ' A.' . $key . " = " . $val . " DSP:" + $dsp ." ";

                    IF ($key != '' && $masterKey != '') {
                        $sql = "UPDATE RH_ID_GD_VARIAVEIS SET VALOR=:val, DSP_VALOR=:dsp WHERE ID_PROC_GD = :masterKey AND COD_VAR=:key";
                        try {
                            $stmt = $db->prepare($sql);

                            if ($val != '') {
                                $stmt->bindParam(':val', $val, PDO::PARAM_STR);
                            } else {
                                $stmt->bindParam(':val', $nulo = null, PDO::PARAM_STR);
                            }

                            if ($dsp != '') {
                                $stmt->bindParam(':dsp', $dsp, PDO::PARAM_STR);
                            } else {
                                $stmt->bindParam(':dsp', $nulo = null, PDO::PARAM_STR);
                            }

                            $stmt->bindParam(':key', $key);
                            $stmt->bindParam(':masterKey', $masterKey);
                            $stmt->execute();
                            ++$nr_records;
                        } catch (PDOException $ex) {
                            $msg = 'A. ' . $ex->getMessage();
                        } 
                    } 


                } else {
                    $val = $value;
//                    echo ' B.' . $key . " = " . $val ." ";

                    $sql = "UPDATE RH_ID_GD_VARIAVEIS SET VALOR=:val WHERE ID_PROC_GD = :masterKey AND COD_VAR=:key";
                    try {
                        $stmt = $db->prepare($sql);
                        $stmt->bindParam(':val', $val);
                        $stmt->bindParam(':key', $key);
                        $stmt->bindParam(':masterKey', $masterKey);
                        $stmt->execute();
                        ++$nr_records;
                    } catch (PDOException $ex) {
                        $msg = 'A. ' . $ex->getMessage();
                    } 

                }
                //'|@|'

            }
        } 
    }

    // valida documento e trata erros
    $array_erros = array();
    $newMasterStatus = "";
    if ($msg == '') {

        # adicionar variáveis que foram criadas à posteriori no modelo
        gd_cria_id_det_gd_variaveis($masterKey,'UPDATE',$msg);

        # adicionar fases que foram criadas à posteriori no modelo
        if ($msg == '') {
            gd_cria_id_det_gd_fases($masterKey,'UPDATE',$msg);
        }

        # valida existência de fases basicas de workflow
        if ($msg == '') {
            gd_valida_fases($masterKey,$msg);
        }

        if ($msg == '') {
            $msgrowErrors = ''; 
            $msgformErrors = '';
            $msgformErrorsAplic = '';
            gd_gera_documento($masterKey,'GERAR', $msgrowErrors, $msgformErrors, $newMasterStatus);
            gd_valida_aplicabilidade($masterKey, $msgformErrorsAplic);

            if ($msgrowErrors != '' || $msgformErrors != '') {

                if ($msgformErrors != '' || $msgformErrorsAplic != '') {

                    $mx = '';
                    if ($msgformErrors != '') {
                        $mx = '{"msg":"'.$msgformErrors.'"}';
                    }

                    if ($msgformErrorsAplic != '') {
                        if ($mx == '') {
                            $mx = $msgformErrorsAplic;
                        } else {
                            $mx = $mx.",".$msgformErrorsAplic;
                        }
                    }


                    $array_erros ["formErrors"] = '['.$mx.']';
                }

                if ($msgrowErrors != '') {
                    $array_erros ["rowErrors"] = $msgrowErrors;
                }
            }
        } else {
            if ($msg != '')
                $array_erros ["formErrors"] = '[{"msg":"'.$msg.'"}]';
        }
    } else {
        if ($msg != '')
            $array_erros ["formErrors"] = '[{"msg":"'.$msg.'"}]';
    }

    ## existem erros a mostrar ?
    if (count($array_erros) > 0) {
        # exemplo de erros
        #$formErrors = '[{"msg":"Este é um erro do form."},{"msg":"Este é 2 erro do form."}]';
        #$rowErrors  = '[{"seq":"1","msg":"Erro da coluna 1"},{"seq":"2","msg":"Erro da coluna 2"},{"seq":"1","msg":"Erro da coluna 3."}]';

        # erros gerais
        $formErrors = '';
        if (array_key_exists("formErrors", $array_erros)) {
            $formErrors = $array_erros ["formErrors"];
        }

        # erros associados às linhas 
        $rowErrors = '';
        if (array_key_exists("rowErrors", $array_erros)) {
            $rowErrors = $array_erros ["rowErrors"];
        }

        if ($formErrors == '')
            $formErrors = '""';

        if ($rowErrors == '')
            $rowErrors = '""';


        echo '{"rowErrors":'.$rowErrors.',"formErrors":'.$formErrors.'}';

    # sem erros
    } else {
        $msg = $ui_successful_operation. '<br/>'.str_replace("{0}", $nr_records, $ui_records_updated);        

        if ($newMasterStatus != '') {
            $msg = "Documento gerado e disponibilizado no workflow.";
            $dadosOut = array(
                "msg" => $msg,
                "newMasterStatus" => $newMasterStatus
            );      
        } else {
            $dadosOut = array(
                "msg" => $msg
            );
        }

        echo json_encode($dadosOut);        
    }
}
?>
