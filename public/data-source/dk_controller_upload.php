<?php
/*
 *  @autor      Pedro Estácio <pedro.estacio@quad-systems.com>
 *  @projeto    QUAD-HCM
 *  @versão     1.0
 *  @revisão    2018.10.15
 *  @copyright  (c) 2018 QuadSystems - http://www.quad-systems.com
 *  @nome       dk_controller_upload.php
 *  @descrição  Controlador de suporte ao upload de valores no módulo de coeficientes de prémios
 *
 */

# cabeçaho do controlador
require_once 'quad_head_controller.php';

require_once INCLUDES_PATH."/lib/dk_lib.php";

$dadosOut = array();

if (isset($_FILES) && !empty($_FILES)) {
    foreach ($_FILES as $file) {
        $tempFile = $file['tmp_name'];
        if (is_uploaded_file($tempFile)) {
            //$doc = file_get_contents($tempFile);    
            $empresa_ = @$_REQUEST['empresa'];
            $nome_ficheiro = $file['name'];
            $dt_ficheiro = date("Y-m-d");
            $formato = pathinfo($file['name'], PATHINFO_EXTENSION);
            $file = fopen($tempFile, 'r');
            $cnt = -1;
            $matriz_valores = array();

            # tipo de indicador RESULTADOS ou OBJECTIVOS
            $tipo_indicador = $ui_objectives;
            while (($line = fgetcsv($file, 0, ";")) !== FALSE) {
                $cnt += 1;
                if ($cnt > 0) {
                    ## distingue se o valor da 6 coluna é um OBJECTIVO (% <= 100)
                    ## ou um montante >= 100
                    if ($line[5] != '') {
                        $vlr = str_replace(",",".",$line[5]);
                        if ((is_numeric($vlr)) && $vlr > 100) {
                            $tipo_indicador = $ui_results;
                        }
                        array_push($matriz_valores, $line);
                    }
                }
            }

            $ref_import_ = dk_get_next_ref_import($msg);
            foreach ($matriz_valores as $key => $line) {
                $ind_ =  $line[0];
                $dt_  =  $line[1];
                $estab_ =  $line[2];
                $desporto_ =  $line[3];
                if ($tipo_indicador == $ui_results) {
                    $qtd_ =  $line[4];
                    $montante_ =  $line[5];
                    $obj_min_ = '';
                    $obj_max_ = '';
                } elseif ($tipo_indicador == $ui_objectives) {
                    $obj_min_ =  $line[4];
                    $obj_max_ =  $line[5];
                    $qtd_ =  '';
                    $montante_ =  '';
                }
                dk_insere_valores_indicadores($ind_, $dt_, $qtd_, $montante_, $obj_min_, $obj_max_, $empresa_, $estab_, $desporto_, $ref_import_, $nome_ficheiro, $dt_ficheiro, $cnt, $msg);
            }

            $cnt = 0;
            $cnt_erros = 0;
            dk_trata_valores_indicadores($ref_import_, $empresa_, $cnt, $cnt_erros, $msg);

            if ($cnt_erros > 0) {
                $msg = "Existem $cnt_erros linha(s) com erro.";
            }
            fclose($file);
        }
    }
}

// Output de dados
if ($msg != '') {
    $dadosOut = array(
        "error" => $msg,
        "ref_import" => "$ref_import_",
        "status" => "NOK"
    );
    echo json_encode($dadosOut);
} else {
    $dadosOut = array(
        "error" => "Importação [$tipo_indicador] efetuada com sucesso!",
        "logFile" => "",
        "status" => "OK"
    );
    echo json_encode($dadosOut);
}
?>