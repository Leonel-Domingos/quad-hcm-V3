<?php

# cabeçaho do controlador
require_once 'quad_head_controller.php';

require_once INCLUDES_PATH."/lib/gd_lib_controller.php";

//Permite sair com um retorno de dados diferente para o tratamento do dyrates
$exitCtl = 1;
$dadosOut = array();

$columns = '';
$msg = '';
$nulo = 'NULL';
$debug = false;
$columns_select = '';

//Tablename
$dbTable = @$_POST['table'];
$templateType = @$_POST['templateType'];
$where = '';
$select_where = ' WHERE 1 = 1 ';
$select_where_next = ' WHERE 1 = 1 ';

$select_where_for_update = $select_where_next;
$select_column_sequence = '';

if (@$_REQUEST['operation'] === "IMPORT_MANUAL_DYRATES" && $_FILES) {
    $flag = 0;
    UploadDyrates();
}
elseif (@$_REQUEST['operation'] === "IMPORT_AVALIADOS" && $_FILES) {
    $flag = 0;
    UploadAvaliados();
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

//UploadDyrates
function UploadDyrates()
{
    global $msg,
        $db,
        $file_imported_ok,
        $file_imported_nok,
        $exitCtl,
        $dadosOut;
    $msg = '';

    if (isset($_FILES) && !empty($_FILES)) {
        foreach ($_FILES as $file) {
            $arrLength = sizeof($file['tmp_name']); //$file['size'];
            /* http://php.net/manual/en/reserved.variables.files.php
                  [file1] => Array(
                  [name] => MyFile.txt (comes from the browser, so treat as tainted)
                  [type] => text/plain  (not sure where it gets this from - assume the browser, so treat as tainted)
                  [tmp_name] => /tmp/php/php1h4j1o (could be anywhere on your system, depending on your config settings, but the user has no control, so this isn't tainted)
                  [error] => UPLOAD_ERR_OK  (= 0)
                  [size] => 123   (the size in bytes)
                  );
                 */
            for ($i = 0, $ien = $arrLength; $i < $ien; $i++) {
                $uFile =
                    $file['tmp_name'][$i] != "/"
                        ? $file['tmp_name'][$i]
                        : $file['tmp_name'];

                $tempFile = $uFile;
                if (is_uploaded_file($tempFile)) {
                    $id = '';
                    $doc = file_get_contents($tempFile);
                    $formato = pathinfo($file['name'], PATHINFO_EXTENSION);
                    $sql = "INSERT INTO PRS_DYRATES_LOG (TIPO, CONTEUDO, FORMATO, ESTADO) values ('M', empty_blob(), '$formato', 'A') RETURNING ID, CONTEUDO INTO :id, :doc";

                    $stmt = oci_parse($db, $sql);
                    $blob = oci_new_descriptor($db, OCI_D_LOB);
                    oci_bind_by_name($stmt, ":id", $id, 32);
                    oci_bind_by_name($stmt, ":doc", $blob, -1, OCI_B_BLOB);
                    if (!oci_execute($stmt, OCI_DEFAULT)) {
                        $msg = oci_error($stmt);
                    } else {
                        if (!$blob->save($doc)) {
                            oci_rollback($db);
                        } else {
                            oci_commit($db);
                        }
                    }
                    oci_free_statement($stmt);
                    $blob->free();
                }
            }
        }
    }

    if ($msg == "") {
        $status = '';
        //Executar o procedimento que "trabalha" o ficheiro de acordo com a linha inserida em cima
        $sql =
            "BEGIN FX_CARREGA_ARTIGOS_MANUAL (:id, SYSDATE, :status, :msg, :errorFile); END;";

        $stmt = oci_parse($db, $sql);

        //Parâmetro de entrada
        oci_bind_by_name($stmt, ':id', $id, 32);

        //Parâmetro de saída
        oci_bind_by_name($stmt, ':msg', $msg, 32000);
        oci_bind_by_name($stmt, ':status', $status, 32000);

        $errorFile = oci_new_descriptor($db, OCI_D_LOB);
        oci_bind_by_name($stmt, ':errorFile', $errorFile, -1, OCI_B_CLOB);

        $r = oci_execute($stmt);
        if (!$r) {
            $e = oci_error($stmt); // For oci_execute errors pass the statement handle
            $msg = $e['message'];
        }

        if ($errorFile->size() > 0) {
            $dadosOut = array(
                "error" => $msg,
                "logFile" => $errorFile->read($errorFile->size()),
                "status" => $status
            );
        } else {
            $dadosOut = array(
                "error" => $msg,
                "logFile" => "",
                "status" => $status
            );
        }
        $exitCtl = 0;
        $errorFile->free();
        oci_free_statement($stmt);
    } else {
        $msg = $file_imported_nok;
    }
    //********************
    //echo json_encode($dadosOut);
}
//END UploadDyrates

//UploadAvaliados
function UploadAvaliados() {

    global $msg, $db, $file_imported_ok, $file_imported_nok, $exitCtl, $dadosOut, $error_dateISO, $error_number,
            $ui_company, $ui_rhid, $ui_dt_admission, $error_field_required, 
            $ui_columns_different_from_expected, $error_whatever_doesnt_exist, $ui_rejection_reason, $ui_line_nr,
            $hint_import_ok_records_uploaded, $hint_import_nok_all_records_rejected, $hint_import_nok_some_records_rejected;
    $msg = '';
    $ui_columns_expected = 3;

    if (isset($_FILES) && !empty($_FILES)) {
        foreach ($_FILES as $file) {
            //Leitura das linhas do ficheiro
            $doc = file_get_contents($file['tmp_name']);
            
            //Criação de array com TODAS as linhas do ficheiro
            #$linhas = explode("\r", $doc);
            $linhas = explode(chr(13), $doc);

            //Nr. Total de linhas no ficheiro
            $tot_linhas = count($linhas);
            //Nr. de linhas importadas com sucesso
            $nr_linhas_ins = 0;            
            //Header com o Layout das colunas esperadas neste interface
            $lines_rejected = array($ui_company.';'.$ui_rhid.';'.$ui_dt_admission.';'.$ui_line_nr.';'.$ui_rejection_reason);
            
            $lines_ok = array();
            //Contador de linhas LIDAS
            $cnt = 0; 

            //Ciclo do processo de validação e criação, "Linha a Linha"
            foreach ($linhas as $key => $line) {
                $line = str_replace("\n","",$line);
                if ($line != '') {
                    //Inicializações gerais
                    ++$cnt; 
                    $empresa = null;
                    $rhid = null;
                    $nome = null;
                    $dt_adm = null;
                    $msg = null;
                    $continue_ = false;

                    //Inicialização do eventual motivo de rejeição da linha (identificada no array $lines_rejected
                    $motivo_rejeicao = null;
                    //Array com os valores das colunas existentes na linha em processamento
                    
                    if (substr($line,strlen($line)-1,1) == ";") {
                        $line = substr($line,0,strlen($line)-1);
                    }
                    $regData = explode(";", str_replace(' ', '', $line));               
                    
                    //Validações               
                    if (count($regData) == $ui_columns_expected) { //Nr. Colunas do ficheiro == Nr. Colunas esperadas
                        // Se houver um erro para-se de continuar as validações das colunas remanescentes,
                        // reportando-se o erro da 1ª ocorrência.
                        $continue_ = true;

                         //EMPRESA
                        if ($regData[0] !== '') {
                            $empresas = list_empresa ($regData[0], 'ONE', $msg);
                            if ($msg == '') {
                                if (isset($empresas[0]['EMPRESA']) && $empresas[0]['EMPRESA'] != '') { //OK
                                    $empresa = $regData[0];
                                } else { //NOK
                                    $msg = str_replace('{0}', $ui_company ." ($regData[0])", $error_whatever_doesnt_exist);
                                    array_push($lines_rejected, $line.';'.$cnt.';'.$msg);
                                    $continue_ = false;
                                }
                            } else {
                                array_push($lines_rejected, $line.';'.$cnt.';'.$msg);
                                $continue_ = false;
                            }
                        } else {
                            $msg = $ui_company . $error_field_required;
                            array_push($lines_rejected, $line.';'.$cnt.';'.$msg);
                            $continue_ = false;
                        }
                        
                        //RHID
                        if ($continue_) { 
                            if ($regData[1] !== '') {
                                $colab = list_colabs_ativos($regData[0], $regData[1], 'one', $msg);
                                if ($msg == '') {
                                    if (isset($colab[0]['RHID']) && $colab[0]['RHID'] != '') { //OK
                                        $rhid = $regData[1];
                                        $nome = $colab[0]['NOME'];
                                    } else { //NOK
                                        $msg = str_replace('{0}', $ui_rhid ." ($regData[1])", $error_whatever_doesnt_exist);
                                        array_push($lines_rejected, $line.';'.$cnt.';'.$msg);
                                        $continue_ = false;
                                    }
                                } else {
                                    array_push($lines_rejected, $line.';'.$cnt.';'.$msg);
                                    $continue_ = false;
                                }
                            } else {
                                $msg = $ui_rhid . $error_field_required;
                                array_push($lines_rejected, $line.';'.$cnt.';'.$msg);
                                $continue_ = false;
                            }
                        }

                        //DT ADMISSAO :: YYYY-MM-DD
                        if ($continue_) { 
                            if (isset($regData[2]) && $regData[2] !== '' && $rhid !== '') {
                                #$regData[2] = str_replace("/","-",$regData[2]);
                                $dt = explode('-', $regData[2]);
                                if (count($dt) == 3) {
                                    if ( checkdate($dt[1],$dt[2],$dt[0]) ) { //checkdate($mes, $dia, $ano)
                                        $dt_adm = $regData[2];
                                        if ($colab[0]['DT_ADMISSAO'] != '' && $colab[0]['DT_ADMISSAO'] == $dt_adm) { //OK
                                            $dt_adm = $regData[2];
                                        } else { //NOK
                                            $msg = str_replace('{0}', $ui_dt_admission ." ($regData[2])", $error_whatever_doesnt_exist);
                                            array_push($lines_rejected, $line.';'.$cnt.';'.$msg);
                                            $continue_ = false;
                                        }
                                    } else {
                                        $msg = str_replace(".",":",$error_dateISO);
                                        array_push($lines_rejected, $line.';'.$cnt.';'.$msg." $regData[2]");
                                        $continue_ = false;
                                    }
                                } else {
                                    $msg = str_replace(".",":",$error_dateISO);
                                    array_push($lines_rejected, $line.';'.$cnt.';'.$msg." $regData[2]");
                                    $continue_ = false;
                                }
                            } else {
                                $msg = $ui_dt_admission . $error_field_required;
                                array_push($lines_rejected, $line.';'.$cnt.';'.$msg);
                                $continue_ = false;
                            }
                        }
                    } 
                    else { // //Nr. Colunas do ficheiro != Nr. Colunas esperadas
                        $msg = str_replace('{1}', count($regData), str_replace('{0}', $ui_columns_expected, $ui_columns_different_from_expected));
                        array_push($lines_rejected, $line.';'.$cnt.';'.$msg);
                        $continue_ = false;
                    }

                    if ($continue_) {
#echo "[$cnt]:$line OK <br/>";
                        $registo = array();
                        $registo['EMPRESA'] = $empresa;
                        $registo['RHID'] = $rhid;
                        $registo["CONCAT(CONCAT(RHID,'-'),NOME)"] = $rhid.'-'.$colab[0]['NOME'];
                        
                        $registo['DT_ADMISSAO'] = $dt_adm;
                        $registo['DT_DEMISSAO'] = $colab[0]['DT_DEMISSAO'];
                        $registo['CD_SITUACAO'] = $colab[0]['CD_SITUACAO'];
                        $registo['DSP_SITUACAO'] = $colab[0]['DSP_SITUACAO'];
                        $registo['ATIVO'] = $colab[0]['ATIVO'];
                        $registo['CD_ESTAB'] = $colab[0]['CD_ESTAB'];
                        $registo['DSP_ESTAB'] = $colab[0]['DSP_ESTAB'];

                        $registo['ID_SETOR'] = $colab[0]['ID_SETOR'];
                        $registo['DSP_SETOR'] = $colab[0]['DSP_SETOR'];
                        $registo['DT_INI_SETOR'] = $colab[0]['DT_INI_SETOR'];
                        $registo['CD_DIRECAO'] = $colab[0]['CD_DIRECAO'];
                        $registo['DT_INI_DIRECAO'] = $colab[0]['DT_INI_DIRECAO'];
                        $registo['DSP_DIRECAO'] = $colab[0]['DSP_DIRECAO'];
                        $registo['CD_DEPT'] = $colab[0]['CD_DEPT'];
                        $registo['DT_DEPT'] = $colab[0]['DT_DEPT'];
                        $registo['DSP_DEPT'] = $colab[0]['DSP_DEPT'];
                        $registo['DT_INI_DEPT'] = $colab[0]['DT_INI_DEPT'];
                        $registo['DT_FIM_DEPT'] = $colab[0]['DT_FIM_DEPT'];
                        $registo['CD_ESTRUTURA'] = $colab[0]['CD_ESTRUTURA'];
                        $registo['DT_INI_ESTRUTURA'] = $colab[0]['DT_INI_ESTRUTURA'];
                        $registo['DSP_ESTRUTURA'] = $colab[0]['DSP_ESTRUTURA'];
                        $registo['ID_FUNCAO'] = $colab[0]['ID_FUNCAO'];
                        $registo['DSP_FUNCAO'] = $colab[0]['DSP_FUNCAO'];
                        $registo['DT_INI_FUNCAO'] = $colab[0]['DT_INI_FUNCAO'];
                        $registo['ID_GRP_FUNC'] = $colab[0]['ID_GRP_FUNC'];
                        $registo['DT_INI_GRP_FUNC'] = $colab[0]['DT_INI_GRP_FUNC'];
                        $registo['DSP_GRP_FUNC'] = $colab[0]['DSP_GRP_FUNC'];
                        $registo['CD_VINCULO'] = $colab[0]['CD_VINCULO'];
                        $registo['DSP_VINCULO'] = $colab[0]['DSP_VINCULO'];
                        $registo['DT_INI_VINCULO'] = $colab[0]['DT_INI_VINCULO'];
                        $registo['DT_FIM_VINCULO'] = $colab[0]['DT_FIM_VINCULO'];
                        $registo['CD_CATG_PROF_INTERNA'] = $colab[0]['CD_CATG_PROF_INTERNA'];
                        $registo['DSP_CATG_PROF_INTERNA'] = $colab[0]['DSP_CATG_PROF_INTERNA'];
                        
                        $registo['DT_CATG_PROF_INTERNA'] = $colab[0]['DT_CATG_PROF_INTERNA'];
                        $registo['CD_CATG_PROF'] = $colab[0]['CD_CATG_PROF'];
                        $registo['DSP_CATG_PROF'] = $colab[0]['DSP_CATG_PROF'];
                        $registo['DT_CATG_PROF'] = $colab[0]['DT_CATG_PROF'];
                        $registo['RHID_GESTOR_ADM'] = $colab[0]['RHID_GESTOR_ADM'];
                        $registo['RHID_SUPERVISOR'] = $colab[0]['RHID_SUPERVISOR'];
                        $registo['RHID_DIRECTOR'] = $colab[0]['RHID_DIRECTOR'];
                        
                        array_push($lines_ok, $registo);
                        ++$nr_linhas_ins;
                    } else {
#echo "[$cnt]:$line NOK [$msg]<br/>";
                    }
                }              
            }  
        }
    }

    $status = '';
    $file = '';
    if ( count($lines_rejected) == 1 ) { //Just HEADER
        $inf_ = str_replace("{0}", $nr_linhas_ins, $hint_import_ok_records_uploaded);
        $lines_rejected = [];
        $status_ = "OK";
    } else {
        if ($nr_linhas_ins == 0) {
            $inf_ = $hint_import_nok_all_records_rejected;
            $status_ = "NOK";
        } else {
            //Nr. Linhas Rejeitadas
            $nr_rej = intval($cnt) - intval($nr_linhas_ins);
            #"Foram registadas ". $nr_linhas_ins . " alocações. Foram rejeitadas " . $nr_rej . " alocações.";   
            $inf_ = str_replace("{1}",$nr_rej,str_replace("{0}",$nr_linhas_ins,$hint_import_nok_some_records_rejected));
            $status_ = "NIM";
        }
        $file = base64_encode(implode("\r\n", $lines_rejected));
    }

    $dadosOut = array("data" => $lines_ok, 
                      "total_Records" => $nr_linhas_ins,
                      "info" => $inf_,
                      "error" => $lines_rejected,
                      "errorFileName" => "AVALIADOS_LOG.csv",
                      "errorFile" => $file,
                      "status"=> $status_);
    
    /*
    $dadosOut = array(
        "info" => $inf_,
        "error" => $lines_rejected,
        "errorFileName" => "AVALIADOS_LOG.csv",
        "errorFile" => $file,
        "status"=> $status_
    );

    */
    $exitCtl = 0;
    
#    var_dump($dadosOut);
}
//END UploadAvaliados

function setOrderBy($primarykey)
{
    $odb = [];
    foreach ($primarykey as $key => $value) {
        if (isset($value['type']) && $value['type'] === 'numeric') {
            array_push($odb, "CAST(" . $key . " AS UNSIGNED)");
        } else {
            array_push($odb, "" . $key);
        }
    }
    return $odb;
}

function setPK($primarykey)
{
    $odb = [];

    foreach ($primarykey as $key => $value) {
        array_push($odb, "" . $key);
    }
    return $odb;
}

function saveUploads($TabCols, $pk, $inRowDoc, &$msg)
{
    global $db;
    global $dbTable;
    global $nulo;
    global $funcFields;
    global $dateformat;
    global $datetimeformat;
    global $datetimeShort;

    $msg = '';

    # colunas de chave primária da tabela
    $sql_cols = '';
    $sql_vals = '';
    $wherePK = '';
    $columnNr = count($TabCols);

    # preenchimento das variaveis $sql_cols (colunas da tabelas) e $sql_vals (valores associados)
    for ($i = 0; $i < $columnNr; $i++) {
        $col = $TabCols[$i]->db;
        $colVal = $TabCols[$i]->prv_value;
        if ($colVal != '') {
            if (isset($TabCols[$i]->datatype)) {
                //Column is DATE or DATETIME: CAST it
                if (strtoupper($TabCols[$i]->datatype) == 'DATE') {
                    $colVal = "TO_DATE('" . $colVal . "'," . $dateformat . ")";
                } elseif (strtoupper($TabCols[$i]->datatype) == 'DATETIME') {
                    $colVal =
                        "TO_DATE('" . $colVal . "'," . $datetimeformat . ")";
                } elseif (
                    strtoupper($TabCols[$i]->datatype) == 'DATETIMESHORT'
                ) {
                    $colVal =
                        "TO_DATE('" . $colVal . "'," . $datetimeShort . ")";
                } else {
                    $colVal = "'" . str_replace("'", "''", $colVal) . "'";
                }
            } else {
                $colVal = "'" . str_replace("'", "''", $colVal) . "'";
            }
        } else {
            $colVal = $nulo;
        }

        if (in_array($col, $pk)) {
            if ($wherePK == '') {
                $wherePK = "$col = $colVal ";
            } else {
                $wherePK .= " AND $col = $colVal ";
            }
        }
    }

    $msg = '';
    //Implementação PDO - MySQL
    if (@$_SESSION['database'] === 'MYSQL') {
        try {
            # implementação para UM documento NUM registo de uma tabela (inRowDoc)
            if (!isset($docsTable) && isset($inRowDoc)) {
                $doc = '';
                $filename = '';
                $ext = '';
                # tratamento do ficheiro carregado
                foreach ($_FILES as $file) {
                    # nome do ficheiro a substituir
                    $filename = $file['name'][0];

                    # extensão do ficheiro
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    $arrLength = count($file['tmp_name']);
                    for ($i = 0, $ien = $arrLength; $i < $ien; $i++) {
                        $uFile =
                            $file['tmp_name'][$i] != "/"
                                ? $file['tmp_name'][$i]
                                : $file['tmp_name'];
                        $tempFile = $uFile;
                        if (is_uploaded_file($tempFile)) {
                            if (
                                !isset($docsTable) &&
                                isset($inRowDoc) &&
                                $inRowDoc->saveAsBlob
                            ) {
                                try {
                                    $doc = fopen($tempFile, 'rb'); //file_get_contents($tempFile);
                                } catch (Exception $e) {
                                    $msg =
                                        "file_get_content:" . $e->getMessage();
                                }
                            } else {
                                $targetPath =
                                    dirname(__FILE__) .
                                    '/../' .
                                    $inRowDoc->savePath;
                                $targetPath .= '/' . $filename;
                                move_uploaded_file($tempFile, $targetPath);
                            }
                        }
                    }
                }

                if ($msg == '') {
                    # PREPARAÇÃO DA QUERY DE SUBSTITUIÇÃO DO FICHEIRO
                    $sql_set_cols =
                        " " .
                        $inRowDoc->fileNameField .
                        " = " .
                        "'" .
                        $inRowDoc->savePath .
                        '/' .
                        $filename .
                        "'";
                    $sql_set_cols .=
                        " ," . $inRowDoc->extField . " = " . "'" . $ext . "'";

                    if (isset($inRowDoc) && $inRowDoc->saveAsBlob) {
                        $sql_set_cols .=
                            " ," . $inRowDoc->blobField . " = :doc ";
                    } else {
                        $sql_set_cols .=
                            " ," . $inRowDoc->blobField . " = NULL ";
                    }

                    $sql =
                        "UPDATE $dbTable " .
                        "SET $sql_set_cols " .
                        "WHERE $wherePK ";

                    $stmt = $db->prepare($sql);
                    if (isset($inRowDoc) && $inRowDoc->saveAsBlob) {
                        $stmt->bindParam(':doc', $doc, PDO::PARAM_LOB);
                    }

                    $stmt->execute();

                    # resposta do controlador à substituição do ficheiro

                    #$files = '{"seq": 1,"file": "'.'ficheiro.txt'.'"}';
                    #$cnt = 1;
                    #$linha = '{"count":'.$cnt.'},['.$files.']';
                    #echo "[".$linha."]";

                    /*
                    $stmt = $db->query(
                        "SELECT * FROM $dbTable WHERE $wherePK "
                    );
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($inRowDoc->saveAsBlob === true) {
                        //Remove BLOB column from data to return to the interface
                        unset($result[$inRowDoc->blobField]);
                    }
                    echo json_encode($result);*/
                }
            }
            # implementação para UM documento NUM registo de com ficheiro no filesystem
            elseif (!isset($docsTable) && !isset($inRowDoc)) {
                $doc = '';
                $filename = '';
                $ext = '';

                # tratamento do ficheiro carregado
                foreach ($_FILES as $file) {
                    # nome do ficheiro a substituir
                    $filename = $file['name'][0];

                    # extensão do ficheiro
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);

                    $arrLength = sizeof($file['tmp_name']);
                    for ($i = 0, $ien = $arrLength; $i < $ien; $i++) {
                        $uFile =
                            $file['tmp_name'][$i] != "/"
                                ? $file['tmp_name'][$i]
                                : $file['tmp_name'];
                        $tempFile = $uFile;
                        if (is_uploaded_file($tempFile)) {
                            if (
                                !isset($docsTable) &&
                                isset($inRowDoc) &&
                                $inRowDoc->saveAsBlob
                            ) {
                                try {
                                    $doc = fopen($tempFile, 'rb'); //file_get_contents($tempFile);
                                } catch (Exception $e) {
                                    $msg =
                                        "file_get_content:" . $e->getMessage();
                                }
                            } else {
                                $targetPath =
                                    dirname(__FILE__) .
                                    '/../' .
                                    $inRowDoc->savePath;
                                $targetPath .= '/' . $filename;
                                move_uploaded_file($tempFile, $targetPath);
                            }
                        }
                    }
                }

                if ($msg == '') {
                    # PREPARAÇÃO DA QUERY DE SUBSTITUIÇÃO DO FICHEIRO
                    $sql_set_cols =
                        " " .
                        $inRowDoc->fileNameField .
                        " = " .
                        "'" .
                        $inRowDoc->savePath .
                        '/' .
                        $filename .
                        "'";
                    $sql_set_cols .=
                        " ," . $inRowDoc->extField . " = " . "'" . $ext . "'";

                    if (isset($inRowDoc) && $inRowDoc->saveAsBlob) {
                        $sql_set_cols .=
                            " ," . $inRowDoc->blobField . " = :doc ";
                    } else {
                        $sql_set_cols .=
                            " ," . $inRowDoc->blobField . " = NULL ";
                    }

                    $sql =
                        "UPDATE $dbTable " .
                        "SET $sql_set_cols " .
                        "WHERE $wherePK ";

                    $stmt = $db->prepare($sql);
                    if (isset($inRowDoc) && $inRowDoc->saveAsBlob) {
                        $stmt->bindParam(':doc', $doc, PDO::PARAM_LOB);
                    }

                    $stmt->execute();

                    # resposta do controlador à substituição do ficheiro

                    #$files = '{"seq": 1,"file": "'.'ficheiro.txt'.'"}';
                    #$cnt = 1;
                    #$linha = '{"count":'.$cnt.'},['.$files.']';
                    #echo "[".$linha."]";

                    /*$stmt = $db->query(
                        "SELECT * FROM $dbTable WHERE $wherePK "
                    );
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($inRowDoc->saveAsBlob === true) {
                        //Remove BLOB column from data to return to the interface
                        unset($result[$inRowDoc->blobField]);
                    }
                    echo json_encode($result);*/
                }
            }
        } catch (PDOException $e) {
            $msg = 'I. [' . $sql . '] :' . $e->getMessage();
        }
    }
}

//Formatação do array de dados
function data_output($columns, $data)
{
    $out = array();
    $cnt = 0;

    foreach ($data as $value) {
        $cnt = count($value);
        break;
    }

    for ($i = 0, $ien = $cnt; $i < $ien; $i++) {
        $row = array();

        for ($j = 0, $jen = count($columns); $j < $jen; $j++) {
            $column = $columns[$j]; //['db']
            $row[$column] = $data[$column][$i];
        }
        $out[] = $row;
    }
    return $out;
}

if (@$_REQUEST['operation'] === "UPLOAD") {
    $ColsTable = json_decode($myArray->columnsArray);
    $ColsPK = setPK($myArray->pk);
    $myArray->dbOperation = 'UPDATE';
    $msg = '';
    saveUploads($ColsTable, $ColsPK, $inRowDoc, $msg);
    if ($msg != '') {
        $exitCtl = 1;
    }
}

$ajax_id = @$_REQUEST['request_id'];
$len = 0;
if ($msg == '') {
    if ($ajax_id == '') {
        //STANDARD controller requests
        if (isset($myArray->dbTable)) {
            $table = $myArray->dbTable;
        } else {
            $table = $dbTable;
        }

        if (isset($myArray->dbOperation)) {
            $operation = $myArray->dbOperation;
        } else {
            if (isset($myArray->operacao)) {
            $operation = $myArray->operacao;
        }
        }

        if (isset($myArray->dbAlias) && $myArray->dbAlias !== '') {
            $alias = $myArray->dbAlias;
        } else {
            $alias = "A";
        } //($myData->dbAlias == '') ? "A" : $myData->dbAlias;
        //$myOrder = setOrder($primary);
        //$orderBy = implode(", ", $myOrder);
        $orderBy = @$_REQUEST['order_by'];

        if ($orderBy == '') {
            $orderBy = '1';
        }

        if (isset($myArray->dbWhere)) {
            $where = $myArray->dbWhere;
        }

        //if ($table == 'CG_REF_CODES')
        //echo "(" . $where.")</br>";

        if (isset($myArray->dbColunas)) {
            $len = sizeof($myArray->dbColunas);
        }

        $table = $dbTable;

        if ($operation == '') {
            //Usado no INSERT, UPDATE e WORKFLOW
            $operation = $myArray->operacao;
        }

        if (isset($where) && $where == '') {
            //Usado no WORKFLOW
            $where = @$_REQUEST['_pk'];
        }

        if ($where != '') {
            $where = " AND " . $where;
        }

        $bindings = [];
        $columns = "";
        $col_without_cast = "";

        /* if ($_POST["pk"]) {
              $pk = $_POST["pk"];
              $primary = $_POST["pk"];
              $pk = setPK($primary);
              } */
        $pk = setPK($myArray->pk);
        $len = count($myData);
        for ($i = 0; $i < $len; $i++) {
            isset($myData[$i]->db)
                ? ($col = $myData[$i]->db)
                : ($col = $myData[$i]->db); //hex2str( cryptDecode($myData -> dbColunas [$i]->db) );

            if (isset($myData[$i]->datatype)) {
                $tipo = $myData[$i]->datatype;
            } elseif (isset($myData[$i]->datatype)) {
                $tipo = $myData[$i]->datatype;
            } else {
                $tipo = '';
            }

            $col_without_cast = $col;

            //SELECT MANIPULATION
            $col_select = $col;
            if (strtoupper($tipo) == 'DATE') {
                $col_select = "TO_CHAR($col, $dateformat) $col";
            }
            if (strtoupper($tipo) == 'DATETIME') {
                $col_select = "TO_CHAR($col, $datetimeformat) $col";
            }
            if (strtoupper($tipo) == 'DATETIMESHORT') {
                $col_select = "TO_CHAR($col, $datetimeShort) $col";
            }

            for ($x = 0; $x < count($pk); $x++) {
                //PRIMARY KEY
                if ($pk[$x] == $col_without_cast) {
                    $pkColumn = '';
                    //CAST DATATYPES
                    if (isset($myData[$i]->datatype)) {
                        //Column is DATE or DATETIME: CAST it
                        if (strtoupper($myData[$i]->datatype) == 'DATE') {
                            $pkColumn =
                                "TO_CHAR(" . $pk[$x] . "," . $dateformat . ")";
                        } elseif (
                            strtoupper($myData[$i]->datatype) == 'DATETIME'
                        ) {
                            $pkColumn =
                                "TO_CHAR(" .
                                $pk[$x] .
                                "," .
                                $datetimeformat .
                                ")";
                        } elseif (
                            strtoupper($myData[$i]->datatype) == 'DATETIMESHORT'
                        ) {
                            $pkColumn =
                                "TO_CHAR(" .
                                $pk[$x] .
                                "," .
                                $datetimeShort .
                                ")";
                        } else {
                            $pkColumn = $pk[$x];
                        }
                    } else {
                        $pkColumn = $pk[$x];
                    }

                    $select_where .=
                        " AND " .
                        $pkColumn .
                        "='" .
                        $myData[$i]->prv_value .
                        "'";

                    //SELECT RECORD AFTER UPDATE (PK could have been updated)
                    $select_where_next .=
                        " AND " .
                        $pkColumn .
                        "='" .
                        $myData[$i]->nxt_value .
                        "'";

                    if (@$_SESSION['database'] === 'MYSQL') {
                        if (
                            isset($myData[$i]->datatype) &&
                            strtoupper($myData[$i]->datatype) === 'SEQUENCE' &&
                            $select_column_sequence === ''
                        ) {
                            //PK w/ SEQUENCE (autoincrement no MySQL) ONLY FIRST ONE IS ADMITED AND ISOLETEAD
                            $select_column_sequence = $pkColumn;
                        } //else {
                            //todo remove this else  to solve $select_where_for_update bug
                            $select_where_next .=
                                " AND " .
                                $pkColumn .
                                "='" .
                                $myData[$i]->nxt_value .
                                "'";
                            $select_where_for_update .=
                                " AND " .
                                $pkColumn .
                                "='" .
                                $myData[$i]->nxt_value .
                                "'";
                        //}
                    } else {
                        //ASSUMED ORACLE
                        //"AS IS" approach;
                    }
                }
            }
            //END SELECT MANIPULATION

            if ($i < $len - 1) {
                if ($templateType == "datatable") {
                    //$agestr = ($age < 16) ? 'child' : 'adult';
                    $columns .= $col . ", ";
                    $columns_select .= $col_select . ", ";
                } else {
                    $columns .= $alias . "." . $col . ", ";
#                    $columns_select .= $alias . "." . $col_select . ", ";
                    $columns_select .= $col_select . ", ";
                }
            } else {
                if ($templateType == "datatable") {
                    $columns .= $col;
                    $columns_select .= $col_select;
                } else {
                    $columns .= $alias . "." . $col;
#                    $columns_select .= $alias . "." . $col_select;
                    $columns_select .= $col_select;
                }
            }

            array_push($bindings, $col_without_cast);
        }
        
        # coluna com conteúdo da base de dados
        if ($inRowDoc->saveAsBlob) {
            $columns_select .= ", TO_BASE64(". $inRowDoc->blobField .")".$inRowDoc->blobField ;
        }

        //SELECT para devolver ao QUADTABLES/QUADFORMS o registo alvo de DML :: EXCEPTO no INSERT
        if (strtoupper($operation) == 'INSERT') {
            $columnNr = $len; //sizeof($myArray, 0);
            $sql_cols = '';
            $sql_vals = '';
            $submitDML = false;
            $rhid = '';
            $newVal = '';
            $sql_hdr = "INSERT INTO " . $table . "  ";
            for ($i = 0; $i < $columnNr; $i++) {
                $col = $myData[$i]->db;
                $newVal = $myData[$i]->nxt_value;
                //echo $col. ":".$myArray[$i]->datatype.":".$newVal."</br>";

                if ($newVal != '') {
                    $submitDML = true;
                    if (isset($myData[$i]->datatype)) {
                        //Column is DATE or DATETIME: CAST it
                        if (strtoupper($myData[$i]->datatype) == 'DATE') {
                            $newVal =
                                "TO_DATE('" .
                                $newVal .
                                "'," .
                                $dateformat .
                                ")";
                        } elseif (
                            strtoupper($myData[$i]->datatype) == 'DATETIME'
                        ) {
                            $newVal =
                                "TO_DATE('" .
                                $newVal .
                                "'," .
                                $datetimeformat .
                                ")";
                        } elseif (
                            strtoupper($myData[$i]->datatype) == 'DATETIMESHORT'
                        ) {
                            $newVal =
                                "TO_DATE('" .
                                $newVal .
                                "'," .
                                $datetimeShort .
                                ")";
                        } else {
                            $newVal =
                                "'" . str_replace("'", "''", $newVal) . "'";
                        }
                    } else {
                        $newVal = "'" . str_replace("'", "''", $newVal) . "'";
                    }
                } else {
                    $newVal = $nulo;
                }

                if (
                    (is_array($funcFields) && in_array($col, $funcFields)) ||
                    (isset($myData[$i]->datatype) &&
                        strtoupper($myData[$i]->datatype) == 'SEQUENCE')
                ) {
                    null;
                } else {
                    // not a function field , we include in INSERT AND UPDATE
                    if ($sql_cols != '') {
                        $sql_cols .= "|@|" . $col;
                        $sql_vals .= "|@|" . $newVal;
                    } else {
                        $sql_cols = $col;
                        $sql_vals = $newVal;
                    }
                }
            }
            if ($submitDML) {
                //echo "1." . $sql;
                // Execute Statment
                $isQueryOk = false;
                $e = '';
                $msg = '';
                
                # carregar as caracteristicas dos ficheiros 
                $filenames = '';
                $filetypes = '';
                $filetmpnames = '';
                $fileerrors = '';
                $filesizes = '';
                foreach($_FILES as $file) {
                    foreach($file as $key => $val) {
                        if ($key == 'name') {
                            $filenames = $val;
                        } elseif ($key == 'type') {
                            $filetypes = $val;
                        } elseif ($key == 'tmp_name') {
                            $filetmpnames = $val;
                        } elseif ($key == 'error') {
                            $fileerrors = $val;
                        } elseif ($key == 'size') {
                            $filesizes = $val;
                        }
                    }
                }
                
                //Execute INSERT
                if (@$_SESSION['database'] === 'MYSQL') {
                    try {
                        if (!isset($docsTable) && isset($inRowDoc)) {

                            $sql_cols_orig = $sql_cols;
                            $sql_vals_orig = $sql_vals;
                            $data_output = array();
                            
                            # trata o número de ficheiros carregados
                            for ($fileidx=0; $fileidx < count($filenames); $fileidx++) {

                                # preparação do statment para inserção
                                if ($inRowDoc->saveAsBlob) {
                                    $sql_cols = $sql_cols_orig . "|@|".$inRowDoc->blobField;
                                    $sql_vals = $sql_vals_orig . "|@|:data ";

                                    $sql_cols = explode("|@|", $sql_cols);
                                    $sql_vals = explode("|@|", $sql_vals);

                                    //todo se ja existir bd_doc remove-se e o valor tambem e volta a usar-se na forma correta. Acontece porque devido ui/ux do quadform
                                    //precisamos de um campo file etc...just a reminder

                                    if (
                                        array_count_values($sql_cols)[
                                        $inRowDoc->blobField
                                        ] > 1
                                    ) {
                                        //todo remove firts entry
                                        $indx =array_search(
                                            $inRowDoc->blobField,
                                            $sql_cols
                                        );
                                        unset($sql_cols[$indx]);
                                        unset($sql_vals[$indx]);
                                    }
                                    $filename = $filenames[$fileidx]; # $_FILES['upload']['name'][0];
                                    # obtem e grava o nome do ficheiro
                                    $idx = array_search(
                                        $inRowDoc->fileNameField,
                                        $sql_cols
                                    );
                                    foreach ($myData as $obj) {
                                        if ($sql_cols[$idx] == $obj->db) {
                                            $sql_vals[$idx] = "'" . $filename . "'";
                                            break;
                                        }
                                    }

                                    # obtem e grava a extensão do ficheiro
                                    $idx = array_search(
                                        $inRowDoc->extField,
                                        $sql_cols
                                    );
                                    foreach ($myData as $obj) {
                                        if ($sql_cols[$idx] == $obj->db) {
                                            $ext = pathinfo(
                                                $filename,
                                                PATHINFO_EXTENSION
                                            );
                                            $sql_vals[$idx] = "'" . $ext . "'";
                                            break;
                                        }
                                    }
                                    $sql_cols = implode("|@|", $sql_cols);
                                    $sql_vals = implode("|@|", $sql_vals);

                                    $sql_cols = str_replace("|@|", ",", $sql_cols);
                                    $sql_vals = str_replace("|@|", ",", $sql_vals);
                                } 
                                else {
                                    $sql_cols = explode("|@|", $sql_cols);
                                    $sql_vals = explode("|@|", $sql_vals);
                                    $filename = $filenames[$i]; # $_FILES['upload']['name'][0];

                                    # obtem e grava o nome do ficheiro
                                    $idx = array_search(
                                        $inRowDoc->fileNameField,
                                        $sql_cols
                                    );
                                    foreach ($myData as $obj) {
                                        if ($sql_cols[$idx] == $obj->db) {
                                            $sql_vals[$idx] = "'" . $filename . "'";
                                            break;
                                        }
                                    }

                                    # obtem e grava a extensão do ficheiro
                                    $idx = array_search(
                                        $inRowDoc->extField,
                                        $sql_cols
                                    );
                                    foreach ($myData as $obj) {
                                        if ($sql_cols[$idx] == $obj->db) {
                                            $ext = strtoupper(
                                                pathinfo(
                                                    $filename,
                                                    PATHINFO_EXTENSION
                                                )
                                            );
                                            $sql_vals[$idx] = "'" . $ext . "'";
                                            break;
                                        }
                                    }

                                    $idx = array_search(
                                        $inRowDoc->pathField,
                                        $sql_cols
                                    );
                                    foreach ($myData as $obj) {
                                        if ($sql_cols[$idx] == $obj->db) {
                                            $sql_vals[$idx] =
                                                "'" .
                                                $inRowDoc->savePath .
                                                '/' .
                                                $filenames[$fileidx];  #$_FILES['upload']['name'][0] .
                                                "'";
                                            break;
                                        }
                                    }
                                    $sql_cols = implode("|@|", $sql_cols);
                                    $sql_vals = implode("|@|", $sql_vals);

                                    $sql_cols = str_replace("|@|", ",", $sql_cols);
                                    $sql_vals = str_replace("|@|", ",", $sql_vals);
                                }

                                # carregamento do ficheiro
/*                                foreach ($_FILES as $file) {
                                    $arrLength = sizeof($filetmpnames[$fileidx]);#$file['tmp_name']);
                                    for (
                                        $i = 0, $ien = $arrLength;
                                        $i < $ien;
                                        $i++
                                    ) {
                                        $uFile =
                                            $file['tmp_name'][$i] != "/"
                                                ? $file['tmp_name'][$i]
                                                : $file['tmp_name'];
                                        $uFile =
                                            $filetmpnames[$fileidx] != "/"
                                                ? $filetmpnames[$fileidx]
                                                : $filetmpnames[$fileidx];
 */
                                        $tempFile = $filetmpnames[$fileidx];
                                        if (is_uploaded_file($tempFile)) {
                                            if (
                                                !isset($docsTable) &&
                                                isset($inRowDoc) &&
                                                $inRowDoc->saveAsBlob
                                            ) {
                                                $doc = file_get_contents($tempFile);
                                            } else {
                                                $targetPath =
                                                    dirname(__FILE__) .
                                                    '/../' .
                                                    $inRowDoc->savePath;
                                                #                                                if (!is_dir($targetPath)) {
                                                #                                                    mkdir($targetPath);
                                                #                                                    chmod($targetPath, 0777);
                                                #                                                }
                                                $targetPath .= '/' . $filename;

                                                move_uploaded_file(
                                                    $tempFile,
                                                    $targetPath
                                                );
                                            }
                                        }
                                    #}
                                #}
                                $sql =
                                    $sql_hdr .
                                    "(" .
                                    $sql_cols .
                                    ") VALUES (" .
                                    $sql_vals .
                                    ")";
                                $stmt = $db->prepare($sql);
                                if (isset($inRowDoc) && $inRowDoc->saveAsBlob) {
                                    $stmt->bindParam(':data', $doc, PDO::PARAM_LOB);
                                }
                                #echo "sql:$sql";
                                $stmt->execute();

                                /*
                                 * Obtenção dos dados do registo acabado de inserir
                                 */
                                if ($select_column_sequence == '') {
                                    $select_row =
                                        "SELECT " .
                                        $columns_select .
                                        " FROM " .
                                        $table .
                                        " " .
                                        $alias .
                                        " " .
                                        $select_where_for_update;
                                    //echo $select_row;
                                    try {
                                        $stmt = $db->prepare($select_row);
                                        $isQueryOk = $stmt->execute();

                                        if ($isQueryOk) {
                                            $data = $stmt->fetchAll(
                                                PDO::FETCH_ASSOC
                                            );
                                            //print_r($data);
                                            //todo why array push ???
                                            //array_push($data_output, $data);
                                            /*$dadosOut = array(
                                                "data" => $data
                                            );*/
                                            $data_output=$data;
                                        }
                                    } catch (Exception $ex) {
                                        $msg =
                                            'D. On [' .
                                            $select_row .
                                            ']' .
                                            $ex->getMessage();
                                    }
                                } else {
                                    if ($msg == '') {
                                        $select_row =
                                            "SELECT " .
                                            $columns_select .
                                            " FROM " .
                                            $table .
                                            " " .
                                            $alias .
                                            " " .
                                            $select_where_for_update .
                                            ' ORDER BY ' .
                                            $select_column_sequence .
                                            ' DESC ';
                                        try {
                                            $stmt = $db->prepare($select_row);
                                            $stmt->execute();
                                            $data[0] = $stmt->fetch(
                                                PDO::FETCH_ASSOC
                                            );
                                            array_push($data_output,$data);
                                        } catch (Exception $e) {
                                            $msg =
                                                'E. On [' .
                                                $select_row .
                                                ']' .
                                                $e->getMessage();
                                        }
                                    }
                                }
                            }
                                
                            if ($msg == '') {
                                $dadosOut = array(
                                    "data" => $data_output
                                );
                                echo json_encode($dadosOut);
                            }
                        }
                    } catch (PDOException $e) {
                        $msg = 'I. [' . $sql . '] :' . $e->getMessage();
                    }
                }

                //GET ROW Inserted
            } else {
                $msg = ""; //Nothing to insert.";
            }
        }

        if (@$_REQUEST['operation'] === "DELETE") {
            $blobField_ = @$_REQUEST['blobField'];
            $linkField_ = @$_REQUEST['linkField'];

            #echo "PK TABLE: $table WHERE:$select_where";
            if (
                $table != '' &&
                $select_where != '' &&
                $blobField_ != '' &&
                $linkField_ != ''
            ) {
                $origem = str_replace("data-source", "", __DIR__);
                try {
                    $stmt = $db->prepare(
                        "SELECT $blobField_, $linkField_ " .
                            "FROM $table " .
                            "$select_where "
                    );
                    $stmt->execute();
                    $stmt->bindColumn(1, $blob_, PDO::PARAM_LOB);

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        ## no caso do ficheiro ser gravado no Filesystem, remover fisicamente o ficheiro
                        if ($row[$linkField_] != '') {
                            $ficheiro = $origem . $row[$linkField_];

                            # só remove fisicamente o ficheiro se não existirem mais referências ao mesmo
                            $stmt1 = $db->prepare(
                                "SELECT 1 FROM $table WHERE $linkField_ = '" .
                                    $row[$linkField_] .
                                    "'"
                            );
                            if ($stmt1->rowCount() == 1) {
                                unlink($ficheiro);
                            }
                        }

                        $stmt1 = $db->prepare(
                            "UPDATE $table " .
                                "SET $blobField_ = NULL, $linkField_ = NULL " .
                                "$select_where "
                        );
                        $stmt1->execute();
                        
                    }
                } catch (PDOException $ex) {
                    $msg = 'DELETE FILE:' . $e->getMessage();
                }
            }
            /*
                   $sql = "DELETE FROM " . $docsTable->name . " WHERE SEQ = :seq"; // . ;
                   try {
                       $stmt = $db->prepare($sql);
                       $stmt->bindParam(':seq', @$_REQUEST['seq'], PDO::PARAM_STR);
                       $stmt->execute();

                       $filename = @$_REQUEST['fileName'];
                       $filePath = __DIR__ . $folder . $filename;
                       unlink($filePath);
                       //todo remove DRY
                       $pkFields = array();
                       $masterPkValues = array();
                       $dadosOut = array(
                           "data" => json_decode($myArray->data, true)
                       );
                       foreach ($docsTable->pk as $key => $item) {
                           foreach ($item as $itemKey => $val) {
                               array_push($pkFields, $itemKey);
                               $masterVal = $dadosOut['data'][0] ? $dadosOut['data'][0][$val] : $dadosOut['data'][$val];
                               array_push($masterPkValues, $masterVal);
                           }
                       }
                       /*
                       $stmt = oci_parse($db, "select TSHET_LEO_ANEXOS_DOC(" . implode(', ', $masterPkValues) . ") message from dual");
                       if ($stmt != false) {
                           oci_execute($stmt);
                           while (oci_fetch_array($stmt)) {
                               echo oci_result($stmt, "MESSAGE");
                           }
                       }*/
            //todo ok response ... with count of files to update UI OR update row data

            /*                   } catch (PDOException $e) {
                       $msg = 'B. ['.$sql.'] :' . $e->getMessage();
                   }*/
        }

        if (strtoupper($operation) == 'UPDATE') {
            $columnNr = $len; //sizeof($myArray, 0);
            $sql_cols = '';
            $sql_vals = '';
            $submitDML = false;
            $newVal = '';
            $sql_hdr = "UPDATE " . $table . "  SET ";
            for ($i = 0; $i < $columnNr; $i++) {
                $col = $myData[$i]->db;
                $newVal = $myData[$i]->nxt_value;
                //echo $col. ":".$myArray[$i]->datatype.":".$newVal."</br>";

                if ($newVal != '') {
                    $submitDML = true;
                    if (isset($myData[$i]->datatype)) {
                        //Column is DATE or DATETIME: CAST it
                        if (strtoupper($myData[$i]->datatype) == 'DATE') {
                            $newVal =
                                "TO_DATE('" .
                                $newVal .
                                "'," .
                                $dateformat .
                                ")";
                        } elseif (
                            strtoupper($myData[$i]->datatype) == 'DATETIME'
                        ) {
                            $newVal =
                                "TO_DATE('" .
                                $newVal .
                                "'," .
                                $datetimeformat .
                                ")";
                        } elseif (
                            strtoupper($myData[$i]->datatype) == 'DATETIMESHORT'
                        ) {
                            $newVal =
                                "TO_DATE('" .
                                $newVal .
                                "'," .
                                $datetimeShort .
                                ")";
                        } else {
                            $newVal =
                                "'" . str_replace("'", "''", $newVal) . "'";
                        }
                    } else {
                        $newVal = "'" . str_replace("'", "''", $newVal) . "'";
                    }
                } else {
                    $newVal = $nulo;
                }

                if (
                    (is_array($funcFields) && in_array($col, $funcFields)) ||
                    (isset($myData[$i]->datatype) &&
                        strtoupper($myData[$i]->datatype) == 'SEQUENCE')
                ) {
                    null;
                } else {
                    // not a function field , we include in INSERT AND UPDATE
                    if ($sql_cols != '') {
                        $sql_cols .= "|@|" . $col;
                        $sql_vals .= "|@|" . $newVal;
                    } else {
                        $sql_cols = $col;
                        $sql_vals = $newVal;
                    }
                }
            }

            if ($submitDML) {
                //echo "1." . $sql;
                // Execute Statment
                $isQueryOk = false;
                $e = '';
                $msg = '';
                //Execute INSERT
                if (@$_SESSION['database'] === 'MYSQL') {
                    try {
                        if (!isset($docsTable) && isset($inRowDoc)) {
                            if ($inRowDoc->saveAsBlob) {
                                $sql_cols = $sql_cols . "|@|".$inRowDoc->blobField;
                                $sql_vals = $sql_vals . "|@|:data ";

                                $sql_cols = explode("|@|", $sql_cols);
                                $sql_vals = explode("|@|", $sql_vals);

                                if (
                                    array_count_values($sql_cols)[
                                    $inRowDoc->blobField
                                    ] > 1
                                ) {
                                    //todo remove firts entry
                                    $indx =array_search(
                                        $inRowDoc->blobField,
                                        $sql_cols
                                    );
                                    unset($sql_cols[$indx]);
                                    unset($sql_vals[$indx]);
                                }

                                if (array_key_exists('upload', $_FILES)) {
                                    $filename = $_FILES['upload']['name'][0];
                                } elseif (array_key_exists('file', $_FILES)) {
                                    $filename = $_FILES['file']['name'][0];
                                }else if(count($_FILES)===0){
                                    //para a remocao do ficheiro
                                    $indx = array_search(
                                        $inRowDoc->extField,
                                        $sql_cols
                                    );

                                  $sql_vals[$indx]="''";

                                    $indx = array_search(
                                        $inRowDoc->fileNameField,
                                        $sql_cols
                                    );

                                    $sql_vals[$indx]="''";
                                }

                                # obtem e grava o nome do ficheiro
                                $idx = array_search(
                                    $inRowDoc->fileNameField,
                                    $sql_cols
                                );
                                foreach ($myData as $obj) {
                                    if ($sql_cols[$idx] == $obj->db) {
                                        $sql_vals[$idx] = "'" . $filename . "'";
                                        break;
                                    }
                                }

                                # obtem e grava a extensão do ficheiro
                                $idx = array_search(
                                    $inRowDoc->extField,
                                    $sql_cols
                                );
                                foreach ($myData as $obj) {
                                    if ($sql_cols[$idx] == $obj->db) {
                                        if (isset($filename)) {
                                        $ext = pathinfo(
                                            $filename,
                                            PATHINFO_EXTENSION
                                        );
                                        $sql_vals[$idx] = "'" . $ext . "'";
                                        }

                                        break;
                                    }
                                }
                                #                                    $sql_cols = implode("|@|", $sql_cols);
                                #                                    $sql_vals = implode("|@|", $sql_vals);

                                #                                    $sql_cols = str_replace("|@|",",",$sql_cols);
                                #                                    $sql_vals = str_replace("|@|",",",$sql_vals);
                            } else {
                                $sql_cols = explode("|@|", $sql_cols);
                                $sql_vals = explode("|@|", $sql_vals);
                                if (array_key_exists('upload', $_FILES)) {
                                    $filename = $_FILES['upload']['name'][0];
                                } 
                                elseif (array_key_exists('file', $_FILES)) {
                                    $filename = $_FILES['file']['name'][0];
                                }

                                # obtem e grava o nome do ficheiro
                                $idx = array_search(
                                    $inRowDoc->fileNameField,
                                    $sql_cols
                                );
                                foreach ($myData as $obj) {
                                    if ($sql_cols[$idx] == $obj->db) {
                                        $sql_vals[$idx] = "'" . $filename . "'";
                                        break;
                                    }
                                }

                                # obtem e grava a extensão do ficheiro
                                $idx = array_search(
                                    $inRowDoc->extField,
                                    $sql_cols
                                );
                                foreach ($myData as $obj) {
                                    if ($sql_cols[$idx] == $obj->db) {
                                        $ext = strtoupper(
                                            pathinfo(
                                                $filename,
                                                PATHINFO_EXTENSION
                                            )
                                        );
                                        $sql_vals[$idx] = "'" . $ext . "'";
                                        break;
                                    }
                                }

                                $idx = array_search(
                                    $inRowDoc->pathField,
                                    $sql_cols
                                );
                                foreach ($myData as $obj) {
                                    if ($sql_cols[$idx] == $obj->db) {
                                        if (array_key_exists('upload', $_FILES)) {
                                            $sql_vals[$idx] =
                                                "'" .
                                                $inRowDoc->savePath .
                                                '/' .
                                                $_FILES['upload']['name'][0] .
                                                "'";
                                        } 
                                        elseif (array_key_exists('file', $_FILES)) {
                                            $sql_vals[$idx] =
                                                "'" .
                                                $inRowDoc->savePath .
                                                '/' .
                                                $_FILES['file']['name'][0] .
                                                "'";
                                        }

                                        break;
                                    }
                                }
                                #                                    $sql_cols = implode("|@|", $sql_cols);
                                #                                    $sql_vals = implode("|@|", $sql_vals);

                                #                                    $sql_cols = str_replace("|@|",",",$sql_cols);
                                #                                    $sql_vals = str_replace("|@|",",",$sql_vals);
                            }

                            foreach ($_FILES as $file) {
                                //todo remove bd doc empty file
                                $arrLength = sizeof($file['tmp_name']);
                                for (
                                    $i = 0, $ien = $arrLength;
                                    $i < $ien;
                                    $i++
                                ) {
                                    $uFile =
                                        $file['tmp_name'][$i] != "/"
                                            ? $file['tmp_name'][$i]
                                            : $file['tmp_name'];
                                    $tempFile = $uFile;
                                    if (is_uploaded_file($tempFile)) {
                                        if (
                                            !isset($docsTable) &&
                                            isset($inRowDoc) &&
                                            $inRowDoc->saveAsBlob
                                        ) {
                                            $doc = file_get_contents($tempFile);
                                        } else {
                                            $targetPath =
                                                dirname(__FILE__) .
                                                '/../' .
                                                $inRowDoc->savePath;
                                            #                                                if (!is_dir($targetPath)) {
                                            #                                                    mkdir($targetPath);
                                            #                                                    chmod($targetPath, 0777);
                                            #                                                }
                                            $targetPath .= '/' . $filename;

                                            move_uploaded_file(
                                                $tempFile,
                                                $targetPath
                                            );
                                        }
                                    }
                                }
                            }

                            #  $sql_cols -- array com as colunas
                            #  $sql_vals -- array com os valores
                            #  $select_where_for_update -- condição de seleção do registo

                            $cnt_cols = count($sql_cols);
                            $sql = '';
                            for ($i = 0; $i < $cnt_cols; $i++) {
                                if ($sql == '') {
                                    $sql =
                                        $sql_cols[$i] . " = " . $sql_vals[$i];
                                } else {
                                    $sql .=
                                        ", " .
                                        $sql_cols[$i] .
                                        " = " .
                                        $sql_vals[$i];
                                }
                            }
                            $sql =
                                $sql_hdr .
                                $sql .
                                " " .
                                $select_where_for_update;

                            #                                echo "sql:[$sql]";
                            $stmt = $db->prepare($sql);
                            if (isset($inRowDoc) && $inRowDoc->saveAsBlob) {
                                $stmt->bindParam(':data', $doc, PDO::PARAM_LOB);
                            }
                            $stmt->execute();

                            /*
                             * Obtenção dos dados do registo acabado de inserir
                             */
                            if ($select_column_sequence == '') {
                                $select_row =
                                    "SELECT " .
                                    $columns_select .
                                    " FROM " .
                                    $table .
                                    " " .
                                    $alias .
                                    " " .
                                    $select_where_for_update;
                                //echo $select_row;
                                try {
                                    $stmt = $db->prepare($select_row);
                                    $isQueryOk = $stmt->execute();

                                    if ($isQueryOk) {
                                        $data = $stmt->fetchAll(
                                            PDO::FETCH_ASSOC
                                        );
                                        //print_r($data);
                                        $dadosOut = array(
                                            "data" => $data
                                        );

                                        ## especificidade associada ao controlador de RH_ID_GD_DOCS
                                        if ($msg == '' && $table == 'RH_ID_GD_DOCS' && $tempFile != '') {
                                            if ($data[0]['ID_PROC_GD'] != '') {
                                                $return_msg = '';
                                                $msg2 = '';
                                                if ($data[0]['ID_PROC_GD'] != '') {
                                                    gd_avalia_fase(
                                                        $data[0]['ID_PROC_GD'],
                                                        '',
                                                        $return_msg,
                                                        $msg2
                                                    );
                                                }
                                            }
                                        }
                                        echo json_encode($dadosOut);
                                    }
                                } catch (Exception $ex) {
                                    $msg =
                                        'D. On [' .
                                        $select_row .
                                        ']' .
                                        $ex->getMessage();
                                }
                            } else {
                                if ($msg == '') {
                                    $select_row =
                                        "SELECT " .
                                        $columns_select .
                                        " FROM " .
                                        $table .
                                        " " .
                                        $alias .
                                        " " .
                                        $select_where_for_update .
                                        ' ORDER BY ' .
                                        $select_column_sequence .
                                        ' DESC ';
                                    try {
                                        $stmt = $db->prepare($select_row);
                                        $stmt->execute();
                                        $data[0] = $stmt->fetch(
                                            PDO::FETCH_ASSOC
                                        );
                                        $dadosOut = array(
                                            "data" => $data
                                        );

                                        ## especificidade associada ao controlador de RH_ID_GD_DOCS
                                        if ($msg == '' && $table == 'RH_ID_GD_DOCS' && $tempFile != '') {
                                            if ($data[0]['ID_PROC_GD'] != '') {
                                                $return_msg = '';
                                                $msg2 = '';
                                                if ($data[0]['ID_PROC_GD'] != '') {
                                                    gd_avalia_fase(
                                                        $data[0]['ID_PROC_GD'],
                                                        '',
                                                        $return_msg,
                                                        $msg2
                                                    );
                                                }
                                            }
                                        }

                                        echo json_encode($dadosOut);
                                    } catch (Exception $e) {
                                        $msg =
                                            'E. On [' .
                                            $select_row .
                                            ']' .
                                            $e->getMessage();
                                    }
                                }
                            }
                        }
                    } catch (PDOException $e) {
                        $msg = 'I. [' . $sql . '] :' . $e->getMessage();
                    }
                }

                //GET ROW Inserted
            } else {
                $msg = ""; //Nothing to insert.";
            }
        }
    }
}

if ($exitCtl) {
    if ($msg != '') {
        $dadosOut = array(
            "error" => $msg
        );
        echo json_encode($dadosOut);
        //echo "ERRO: " . $msg;
    }
} else {
    echo json_encode($dadosOut);
}
?>
