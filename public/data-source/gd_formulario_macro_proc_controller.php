<?php
/*
 *  @autor      Pedro Estácio <pedro.estacio@quad-systems.com>
 *  @versão     2.0
 *  @revisão    2018.10.10
 *  @copyright  (c) 2018 QuadSystems - http://www.quad-systems.com
 *  @nome     	gd_formulario_auto_controller.php
 *  @descrição  Controlador específico para atualizar os valores para o formulário associado aos macro processos.
 *
 */

# cabeçaho do controlador
require_once 'quad_head_controller.php';
require_once INCLUDES_PATH.'/lib/gd_lib_controller.php';

## inicializações
$action = '';
$id_hdr_ = '';
$myArray = '';
$empresa_ = '';
$tipoGD_ = '';
$modeloGD_ = '';
$msg = '';

## chamado a partir de um worker ?
$workerData = json_decode(file_get_contents("php://input"));

if ($workerData) {
    foreach ($workerData as $key => $val) {

        ## ação
        if ($key === 'action') {
            $action = $val;
        }

        ## chave do macro-processo
        if ($key === 'id_hdr') {
            $id_hdr_ = $val;
        }

        ## empresa
        if ($key === 'empresa') {
            $empresa_ = $val;
        }

        ## tipo de modelo
        if ($key === 'tipoGD') {
            $tipoGD_ = $val;
        }

        ## modelo
        if ($key === 'modeloGD') {
            $modeloGD_ = $val;
        }

        ## lista de colaboradores
        if ($key === 'request_data') {
            $myArray = $val;
        }
    }
} else {

    ## ação a executar pelo controlador.
    ## 
    ## por defeito efetua a gravação das variáveis recolhidas para um formulário
    ## que são indicadas nas matriz request_data
    $action = @$_REQUEST['action'];
    $myArray = json_decode(@$_REQUEST['request_data']);
}

## geração de documentos para os colaboradores fornecidos
if ($action == 'gerar') {
    if ($id_hdr_ != '') {
        $msg == '';
        foreach ($myArray as $key => $value) {
            $p = explode("@",$value);
            $empresa_ = $p[0];
            $rhid_ = $p[1];
            $dt_adm_ = $p[2];
            #echo "empresa:$empresa_ rhid:$rhid_ dt_Adm:$dt_adm_<br/>";
            gd_atrib_template($id_hdr_, $empresa_, $rhid_, $dt_adm_, 'S', $msg);
        }

        if ($msg == '') {
            gd_op_terminada($id_hdr_, $msg); 
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
} 
## lançamento de macro-processo para um conjunto de colaboradores fornecidos
elseif ($action == 'lanca') {
    $msg == '';
    $id_hdr_ = '';
    if ($empresa_ != '' && $tipoGD_ != '' && $modeloGD_ != '' && count($myArray) > 0) {

        $p = explode("@",$tipoGD_);
        $cd_gd_ = $p[0];
        $dt_ini_gd_ = $p[1];

        $p = explode("@",$modeloGD_);
        $cd_det_gd_ = $p[0];
        $dt_ini_det_gd_ = $p[1];

        $colabs_ = $myArray;
        $id_hdr_ = gd_lanca_macro_processo('S', $empresa_, $cd_gd_, $dt_ini_gd_, $cd_det_gd_, $dt_ini_det_gd_, $colabs_, $msg);
    }

    if ($msg == '') {
        $dadosOut = array(
            "error" => "",
            "msg" => $ui_successful_operation,
            "id_hdr" => $id_hdr_
        );      
    } else {
        $dadosOut = array(
            "error" => $msg,
            "msg" => "",
            "id_hdr" => ""
        );
    } 
    echo json_encode($dadosOut);        
} 
## gravação das variáveis do formulário
elseif (isset($myArray)) {
    if (isset($myArray[0]->key)) {
        $masterKey = $myArray[0]->key;
        $empresa = $myArray[1]->empresa;
        if ($masterKey) {
            $nr_records = 0;
            foreach ($myArray[2] as $key => $value) {
                $dsp = [];
                $val = '';
                $dsp = explode('|@|',$value);

                if ( count($dsp) > 1) {
                    $val = $dsp[0];
                    $dsp = $dsp[1];
//                    echo ' A.' . $key . " = " . $val . " DSP:" + $dsp ." ";

                    IF ($key != '' && $masterKey != '') {
                        $sql = "UPDATE DG_GD_DET_AUTO SET VALOR=:val, DSP_VALOR=:dsp WHERE ID = :masterKey AND COD_VAR=:key";
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

                    $sql = "UPDATE DG_GD_DET_AUTO SET VALOR=:val WHERE ID = :masterKey AND COD_VAR=:key";
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
    $macro_terminado = 'N';
    if ($msg == '') {

        # adicionar variáveis que foram criadas à posteriori no modelo
        gd_cria_det_auto($masterKey, $empresa, 'UPDATE', $msg);
        if ($msg == '') {
            $msgrowErrors = ''; 
            $msgformErrors = '';
            $msgformErrorsAplic = '';
            gd_valida_macro_proc($masterKey, $msgrowErrors, $macro_terminado, $msgformErrors);
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
        $formErrors = $array_erros ["formErrors"];

        # erros associados às linhas 
        $rowErrors = $array_erros ["rowErrors"];

        if ($formErrors == '')
            $formErrors = '""';

        if ($rowErrors == '')
            $rowErrors = '""';


        echo '{"rowErrors":'.$rowErrors.',"formErrors":'.$formErrors.'}';

    # sem erros
    } else {
        $msg = $ui_successful_operation. '<br/>'.str_replace("{0}", $nr_records, $ui_records_updated);        

        if ($newMasterStatus != '') {
            $msg = "Documento(s) gerado(s) e disponibilizado(s) no workflow.";
            $dadosOut = array(
                "msg" => $msg,
                "newMasterStatus" => $newMasterStatus,
                "macro_terminado" => $macro_terminado
            );      
        } else {
            $dadosOut = array(
                "msg" => $msg,
                "macro_terminado" => $macro_terminado
            );
        }

        echo json_encode($dadosOut);        
    }
}
?>
