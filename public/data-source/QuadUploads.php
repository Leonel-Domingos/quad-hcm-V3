<?php
require_once 'QuadCore.php';

class QuadUploads extends QuadCore
{
    public function __construct($data)
    {
        parent::__construct($data);
        # se postponed => utiliza class WorkFlowPostPoned
        if ($this->wkfMode === 'postponed') {
            require_once 'WorkFlowPostPonedUploads.php';
            $this->wkf = new WorkFlowPostPonedUploads(
                @$_SESSION["nome"],
                @$_SESSION["perfil"],
                $this
            );
            # se optimistic => utiliza class WorkFlowOptimistic
        } elseif ($this->wkfMode === 'optimistic') {
            require_once 'WorkFlowOptimistic.php';
            $this->wkf = new WorkFlowOptimistic(
                $_SESSION["nome"],
                $_SESSION["perfil"]
            );
        }
    }

    public function UploadAvaliados()
    {
        global $msg,
            $db,
            $file_imported_ok,
            $file_imported_nok,
            $exitCtl,
            $dadosOut,
            $error_dateISO,
            $error_number,
            $ui_company,
            $ui_rhid,
            $ui_dt_admission,
            $error_field_required,
            $ui_columns_different_from_expected,
            $error_whatever_doesnt_exist,
            $ui_rejection_reason,
            $ui_line_nr,
            $hint_import_ok_records_uploaded,
            $hint_import_nok_all_records_rejected,
            $hint_import_nok_some_records_rejected;
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
                $lines_rejected = array(
                    $ui_company .
                        ';' .
                        $ui_rhid .
                        ';' .
                        $ui_dt_admission .
                        ';' .
                        $ui_line_nr .
                        ';' .
                        $ui_rejection_reason
                );

                $lines_ok = array();
                //Contador de linhas LIDAS
                $cnt = 0;

                //Ciclo do processo de validação e criação, "Linha a Linha"
                foreach ($linhas as $key => $line) {
                    $line = str_replace("\n", "", $line);
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

                        if (substr($line, strlen($line) - 1, 1) == ";") {
                            $line = substr($line, 0, strlen($line) - 1);
                        }
                        $regData = explode(";", str_replace(' ', '', $line));

                        //Validações
                        if (count($regData) == $ui_columns_expected) {
                            //Nr. Colunas do ficheiro == Nr. Colunas esperadas
                            // Se houver um erro para-se de continuar as validações das colunas remanescentes,
                            // reportando-se o erro da 1ª ocorrência.
                            $continue_ = true;

                            //EMPRESA
                            if ($regData[0] !== '') {
                                $empresas = list_empresa(
                                    $regData[0],
                                    'ONE',
                                    $msg
                                );
                                if ($msg == '') {
                                    if (
                                        isset($empresas[0]['EMPRESA']) &&
                                        $empresas[0]['EMPRESA'] != ''
                                    ) {
                                        //OK
                                        $empresa = $regData[0];
                                    } else {
                                        //NOK
                                        $msg = str_replace(
                                            '{0}',
                                            $ui_company . " ($regData[0])",
                                            $error_whatever_doesnt_exist
                                        );
                                        array_push(
                                            $lines_rejected,
                                            $line . ';' . $cnt . ';' . $msg
                                        );
                                        $continue_ = false;
                                    }
                                } else {
                                    array_push(
                                        $lines_rejected,
                                        $line . ';' . $cnt . ';' . $msg
                                    );
                                    $continue_ = false;
                                }
                            } else {
                                $msg = $ui_company . $error_field_required;
                                array_push(
                                    $lines_rejected,
                                    $line . ';' . $cnt . ';' . $msg
                                );
                                $continue_ = false;
                            }

                            //RHID
                            if ($continue_) {
                                if ($regData[1] !== '') {
                                    $colab = list_colabs_ativos(
                                        $regData[0],
                                        $regData[1],
                                        'one',
                                        $msg
                                    );
                                    if ($msg == '') {
                                        if (
                                            isset($colab[0]['RHID']) &&
                                            $colab[0]['RHID'] != ''
                                        ) {
                                            //OK
                                            $rhid = $regData[1];
                                            $nome = $colab[0]['NOME'];
                                        } else {
                                            //NOK
                                            $msg = str_replace(
                                                '{0}',
                                                $ui_rhid . " ($regData[1])",
                                                $error_whatever_doesnt_exist
                                            );
                                            array_push(
                                                $lines_rejected,
                                                $line . ';' . $cnt . ';' . $msg
                                            );
                                            $continue_ = false;
                                        }
                                    } else {
                                        array_push(
                                            $lines_rejected,
                                            $line . ';' . $cnt . ';' . $msg
                                        );
                                        $continue_ = false;
                                    }
                                } else {
                                    $msg = $ui_rhid . $error_field_required;
                                    array_push(
                                        $lines_rejected,
                                        $line . ';' . $cnt . ';' . $msg
                                    );
                                    $continue_ = false;
                                }
                            }

                            //DT ADMISSAO :: YYYY-MM-DD
                            if ($continue_) {
                                if (
                                    isset($regData[2]) &&
                                    $regData[2] !== '' &&
                                    $rhid !== ''
                                ) {
                                    #$regData[2] = str_replace("/","-",$regData[2]);
                                    $dt = explode('-', $regData[2]);
                                    if (count($dt) == 3) {
                                        if (checkdate($dt[1], $dt[2], $dt[0])) {
                                            //checkdate($mes, $dia, $ano)
                                            $dt_adm = $regData[2];
                                            if (
                                                $colab[0]['DT_ADMISSAO'] !=
                                                    '' &&
                                                $colab[0]['DT_ADMISSAO'] ==
                                                    $dt_adm
                                            ) {
                                                //OK
                                                $dt_adm = $regData[2];
                                            } else {
                                                //NOK
                                                $msg = str_replace(
                                                    '{0}',
                                                    $ui_dt_admission .
                                                        " ($regData[2])",
                                                    $error_whatever_doesnt_exist
                                                );
                                                array_push(
                                                    $lines_rejected,
                                                    $line .
                                                        ';' .
                                                        $cnt .
                                                        ';' .
                                                        $msg
                                                );
                                                $continue_ = false;
                                            }
                                        } else {
                                            $msg = str_replace(
                                                ".",
                                                ":",
                                                $error_dateISO
                                            );
                                            array_push(
                                                $lines_rejected,
                                                $line .
                                                    ';' .
                                                    $cnt .
                                                    ';' .
                                                    $msg .
                                                    " $regData[2]"
                                            );
                                            $continue_ = false;
                                        }
                                    } else {
                                        $msg = str_replace(
                                            ".",
                                            ":",
                                            $error_dateISO
                                        );
                                        array_push(
                                            $lines_rejected,
                                            $line .
                                                ';' .
                                                $cnt .
                                                ';' .
                                                $msg .
                                                " $regData[2]"
                                        );
                                        $continue_ = false;
                                    }
                                } else {
                                    $msg =
                                        $ui_dt_admission .
                                        $error_field_required;
                                    array_push(
                                        $lines_rejected,
                                        $line . ';' . $cnt . ';' . $msg
                                    );
                                    $continue_ = false;
                                }
                            }
                        } else {
                            // //Nr. Colunas do ficheiro != Nr. Colunas esperadas
                            $msg = str_replace(
                                '{1}',
                                count($regData),
                                str_replace(
                                    '{0}',
                                    $ui_columns_expected,
                                    $ui_columns_different_from_expected
                                )
                            );
                            array_push(
                                $lines_rejected,
                                $line . ';' . $cnt . ';' . $msg
                            );
                            $continue_ = false;
                        }

                        if ($continue_) {
                            #echo "[$cnt]:$line OK <br/>";
                            $registo = array();
                            $registo['EMPRESA'] = $empresa;
                            $registo['RHID'] = $rhid;
                            $registo["CONCAT(CONCAT(RHID,'-'),NOME)"] =
                                $rhid . '-' . $colab[0]['NOME'];

                            $registo['DT_ADMISSAO'] = $dt_adm;
                            $registo['DT_DEMISSAO'] = $colab[0]['DT_DEMISSAO'];
                            $registo['CD_SITUACAO'] = $colab[0]['CD_SITUACAO'];
                            $registo['DSP_SITUACAO'] =
                                $colab[0]['DSP_SITUACAO'];
                            $registo['ATIVO'] = $colab[0]['ATIVO'];
                            $registo['CD_ESTAB'] = $colab[0]['CD_ESTAB'];
                            $registo['DSP_ESTAB'] = $colab[0]['DSP_ESTAB'];

                            $registo['ID_SETOR'] = $colab[0]['ID_SETOR'];
                            $registo['DSP_SETOR'] = $colab[0]['DSP_SETOR'];
                            $registo['DT_INI_SETOR'] =
                                $colab[0]['DT_INI_SETOR'];
                            $registo['CD_DIRECAO'] = $colab[0]['CD_DIRECAO'];
                            $registo['DT_INI_DIRECAO'] =
                                $colab[0]['DT_INI_DIRECAO'];
                            $registo['DSP_DIRECAO'] = $colab[0]['DSP_DIRECAO'];
                            $registo['CD_DEPT'] = $colab[0]['CD_DEPT'];
                            $registo['DT_DEPT'] = $colab[0]['DT_DEPT'];
                            $registo['DSP_DEPT'] = $colab[0]['DSP_DEPT'];
                            $registo['DT_INI_DEPT'] = $colab[0]['DT_INI_DEPT'];
                            $registo['DT_FIM_DEPT'] = $colab[0]['DT_FIM_DEPT'];
                            $registo['CD_ESTRUTURA'] =
                                $colab[0]['CD_ESTRUTURA'];
                            $registo['DT_INI_ESTRUTURA'] =
                                $colab[0]['DT_INI_ESTRUTURA'];
                            $registo['DSP_ESTRUTURA'] =
                                $colab[0]['DSP_ESTRUTURA'];
                            $registo['ID_FUNCAO'] = $colab[0]['ID_FUNCAO'];
                            $registo['DSP_FUNCAO'] = $colab[0]['DSP_FUNCAO'];
                            $registo['DT_INI_FUNCAO'] =
                                $colab[0]['DT_INI_FUNCAO'];
                            $registo['ID_GRP_FUNC'] = $colab[0]['ID_GRP_FUNC'];
                            $registo['DT_INI_GRP_FUNC'] =
                                $colab[0]['DT_INI_GRP_FUNC'];
                            $registo['DSP_GRP_FUNC'] =
                                $colab[0]['DSP_GRP_FUNC'];
                            $registo['CD_VINCULO'] = $colab[0]['CD_VINCULO'];
                            $registo['DSP_VINCULO'] = $colab[0]['DSP_VINCULO'];
                            $registo['DT_INI_VINCULO'] =
                                $colab[0]['DT_INI_VINCULO'];
                            $registo['DT_FIM_VINCULO'] =
                                $colab[0]['DT_FIM_VINCULO'];
                            $registo['CD_CATG_PROF_INTERNA'] =
                                $colab[0]['CD_CATG_PROF_INTERNA'];
                            $registo['DSP_CATG_PROF_INTERNA'] =
                                $colab[0]['DSP_CATG_PROF_INTERNA'];

                            $registo['DT_CATG_PROF_INTERNA'] =
                                $colab[0]['DT_CATG_PROF_INTERNA'];
                            $registo['CD_CATG_PROF'] =
                                $colab[0]['CD_CATG_PROF'];
                            $registo['DSP_CATG_PROF'] =
                                $colab[0]['DSP_CATG_PROF'];
                            $registo['DT_CATG_PROF'] =
                                $colab[0]['DT_CATG_PROF'];
                            $registo['RHID_GESTOR_ADM'] =
                                $colab[0]['RHID_GESTOR_ADM'];
                            $registo['RHID_SUPERVISOR'] =
                                $colab[0]['RHID_SUPERVISOR'];
                            $registo['RHID_DIRECTOR'] =
                                $colab[0]['RHID_DIRECTOR'];

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
        if (count($lines_rejected) == 1) {
            //Just HEADER
            $inf_ = str_replace(
                "{0}",
                $nr_linhas_ins,
                $hint_import_ok_records_uploaded
            );
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
                $inf_ = str_replace(
                    "{1}",
                    $nr_rej,
                    str_replace(
                        "{0}",
                        $nr_linhas_ins,
                        $hint_import_nok_some_records_rejected
                    )
                );
                $status_ = "NIM";
            }
            $file = base64_encode(implode("\r\n", $lines_rejected));
        }

        $dadosOut = array(
            "data" => $lines_ok,
            "total_Records" => $nr_linhas_ins,
            "info" => $inf_,
            "error" => $lines_rejected,
            "errorFileName" => "AVALIADOS_LOG.csv",
            "errorFile" => $file,
            "status" => $status_
        );

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

    public function UploadDyrates()
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

    public function saveUploads($TabCols, $pk, $inRowDoc, &$msg)
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
                        $colVal =
                            "TO_DATE('" . $colVal . "'," . $dateformat . ")";
                    } elseif (
                        strtoupper($TabCols[$i]->datatype) == 'DATETIME'
                    ) {
                        $colVal =
                            "TO_DATE('" .
                            $colVal .
                            "'," .
                            $datetimeformat .
                            ")";
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
                                    isset($this->inRowDoc) &&
                                    $this->blob_embedded->saveAsBlob
                                ) {
                                    try {
                                        $doc = fopen($tempFile, 'rb'); //file_get_contents($tempFile);
                                    } catch (Exception $e) {
                                        $msg =
                                            "file_get_content:" .
                                            $e->getMessage();
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
                            " ," .
                            $inRowDoc->extField .
                            " = " .
                            "'" .
                            $ext .
                            "'";

                        if (
                            isset($this->inRowDoc) &&
                            $this->blob_embedded->saveAsBlob
                        ) {
                            $sql_set_cols .=
                                " ," .
                                $this->blob_embedded->blobField .
                                " = :doc ";
                        } else {
                            null;
                        }

                        $sql =
                            "UPDATE $dbTable " .
                            "SET $sql_set_cols " .
                            "WHERE $wherePK ";

                        $stmt = $db->prepare($sql);
                        if (
                            isset($this->inRowDoc) &&
                            $this->blob_embedded->saveAsBlob
                        ) {
                            $stmt->bindParam(':doc', $doc, PDO::PARAM_LOB);
                        }

                        $stmt->execute();
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
                                    isset($this->inRowDoc) &&
                                    $this->blob_embedded->saveAsBlob
                                ) {
                                    try {
                                        $doc = fopen($tempFile, 'rb'); //file_get_contents($tempFile);
                                    } catch (Exception $e) {
                                        $msg =
                                            "file_get_content:" .
                                            $e->getMessage();
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
                            " ," .
                            $inRowDoc->extField .
                            " = " .
                            "'" .
                            $ext .
                            "'";

                        if (
                            isset($this->inRowDoc) &&
                            $this->blob_embedded->saveAsBlob
                        ) {
                            $sql_set_cols .=
                                " ," .
                                $this->blob_embedded->blobField .
                                " = :doc ";
                        } else {
                            $sql_set_cols .=
                                " ," .
                                $this->blob_embedded->blobField .
                                " = NULL ";
                        }

                        $sql =
                            "UPDATE $dbTable " .
                            "SET $sql_set_cols " .
                            "WHERE $wherePK ";

                        $stmt = $db->prepare($sql);
                        if (
                            isset($this->inRowDoc) &&
                            $this->blob_embedded->saveAsBlob
                        ) {
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
    # recolhe a informação e prepara o statment
    # para a operação de CRUD que irá efetuar
    #
    # se datatype = 'just_editor', não é incluído no SELECT de retorno da informação
    public function prepareForCrud()
    {
        $bindings = [];
        $columns = "";
        $info = [];
        if ($this->pk) {
            $pk = $this->setPK($this->pk);
        }
        $info['whereUpdatedRecord'] = '';
        for ($i = 0; $i < $this->len; $i++) {
            $col = $this->getColName($i);
            array_push($bindings, $col);
            $dateType = $this->getDatetype($i);

            # as colunas do tipo JUST_EDITOR não são incluídas no return...
            if (strtoupper($dateType) == 'JUST_EDITOR') {
                null;
            } else {
                if ($dateType) {
                    $col = self::formatDatetypeToChar($col, $dateType);
                }
                $info['whereUpdatedRecord'] .= $this->getUpdatedRecordQuery(
                    $pk,
                    $i,
                    $this->getColName($i)
                )['getUpdatedRecord'];
                if ($i < $this->len - 1) {
                    $columns .= $col . ", ";
                } else {
                    $columns .= $col;
                }
            }
        }

        # adicionar às colunas de retorno, as colunas associadas a um documento/imagem
        # com base nas propriedades inRow
        //if ($this->blob_embedded->display) {
            $columns .=
                ", TO_BASE64(" .
                $this->blob_embedded->blobField .
                ")" .
                $this->blob_embedded->blobField;
        //}

        if (isset($this->isSequencePk) && $this->isSequencePk === true) {
            $selectUpdated =
                "SELECT " .
                $columns .
                " FROM " .
                $this->table .
                ' WHERE 1 = 1 ' .
                $info['whereUpdatedRecord'] .
                " " .
                $this->alias .
                ' ORDER BY ' .
                $this->sequenceField .
                ' DESC LIMIT 1';
        } else {
            $selectUpdated =
                "SELECT " .
                $columns .
                " FROM " .
                $this->table .
                " " .
                $this->alias .
                ' WHERE 1 = 1 ' .
                $info['whereUpdatedRecord'];
        }

        $info['bindings'] = $bindings;
        $info['columns'] = $columns;
        $info['selectUpdated'] = $selectUpdated;
        return $info;
    }
    public function getColsAndVals($nulo, $sql_cols, $sql_vals)
    {
        $arrData = [];
        for ($i = 0; $i < $this->len; $i++) {
            $col = $this->getColName($i);
            $newVal = $this->data[$i]->nxt_value;

            if ($newVal != '') {
                $submitDML = true;

                $dateType = $this->getDatetype($i);
                if ($dateType) {
                    $newVal = $this->formatToDatetype($col, $dateType, $newVal);
                } else {
                    $newVal = "'" . str_replace("'", "''", $newVal) . "'";
                }
            } else {
                $newVal = $nulo;
            }

            if (
                (is_array($this->funcFields) &&
                    in_array($col, $this->funcFields)) ||
                (isset($this->data[$i]->datatype) &&
                    strtoupper($this->data[$i]->datatype) == 'SEQUENCE') ||
                (isset($this->data[$i]->datatype) &&
                    strtoupper($this->data[$i]->datatype) == 'JUST_EDITOR')
            ) {
                null;
            } else {
                $arrData[$col] = "$newVal";
            }
        }
        return [$arrData, $submitDML];
    }
    public function filesOnWorkflow($db)
    {
        if (isset($this->wkf)) {
            $file = $_FILES['upload']['tmp_name'][0];
            if (is_uploaded_file($file)) {
                $doc = file_get_contents($file);
            }
            $info = $this->prepareForCrud();

            $select_row =
                "SELECT " .
                $info["columns"] .
                " FROM " .
                $this->table .
                " " .
                $this->alias .
                ' WHERE 1=1 ' .
                $info['whereUpdatedRecord'];

            $retRow = $db->prepare($select_row);
            $retRow->execute();
            $data = $retRow->fetch(PDO::FETCH_ASSOC);

            $tmpBlobRecord = $this->wkf->getTmpBlobRecord($db, $doc);

            if (
                $tmpBlobRecord["BD_DOC_ANT"] !==
                $data[$this->blob_embedded->blobField] // compare blob and file
            ) {
            }

            $docClass = new stdClass();
            $dbentry = "db";
            $preventry = "prv_value";
            $nxtentry = "nxt_value";
            $docClass->{$dbentry} = $this->blob_embedded->blobField;
            $docClass->{$preventry} = base64_decode(
                $data[$this->blob_embedded->blobField]
            );
            $docClass->{$nxtentry} = $tmpBlobRecord["BD_DOC_ANT"];

            array_push($this->data, $docClass);
            $idxDoc = count($this->data) - 1;

            if ($this->wkfMode === "postponed") {
                $submitDML = $this->wkf->notifyThisUploadedFile(
                    $this->table,
                    $this->operation,
                    $this->data[$idxDoc],
                    $this->setPK($this->pk),
                    $this->data,
                    $this->cxLists,
                    $this->domains,
                    $this->wkfUpdate
                );
            } else {
                $stt = $this->wkf->notifyThisUploadedFile(
                    $this->table,
                    $this->operation,
                    $this->data[$idxDoc],
                    $this->setPK($this->pk),
                    $this->data,
                    $this->cxLists,
                    $this->domains,
                    $this->wkfUpdate
                );
                $statements = array_merge($statements, $stt);
                $submitDML = true;
            }

            return true;
        } else {
            return false;
        }
    }

    public function runUpdateActions(
        $info,
        $db,
        $nulo,
        $statements,
        &$change,
        &$submitDML
    ) {
        $sql_body = '';
        if (isset($this->wkf)) {
            $change = $this->filesOnWorkflow($db);
        } else {
            $select_row = $info["selectUpdated"];
            $retRow = $db->prepare($select_row);
            $retRow->execute();
            $data = $retRow->fetchAll(PDO::FETCH_ASSOC);
            $file_content = $data[0][$this->blob_embedded->blobField];
            $file_content = base64_decode($file_content);
            //file_put_contents($target_folder.'/'.$name, $file_content);
            $file = $_FILES['upload'];

            if (is_uploaded_file($file['tmp_name'][0])) {
                $doc = file_get_contents($file['tmp_name'][0]);
                if (
                    $data[0][$this->blob_embedded->fileNameField] !=
                        $file["name"][0] ||
                    $data[0][$this->blob_embedded->extField] !=
                        pathinfo($file["name"][0], PATHINFO_EXTENSION)
                ) {
                    $change = true;
                    $submitDML = true;

                    $sql_body .= $this->blob_embedded->blobField . '=:data';

                    $sql_body .=
                        ', ' .
                        $this->blob_embedded->extField .
                        "='" .
                        pathinfo($file["name"][0] . "'", PATHINFO_EXTENSION);
                    $sql_body .=
                        ', ' .
                        $this->blob_embedded->fileNameField .
                        "='" .
                        $file["name"][0] .
                        "'";
                } else {
                    null; // todo  same file?? not best technique to say...;
                    $change = false;
                    $submitDML = false;
                }
            }
        }
        for ($i = 0; $i < $this->len; $i++) {
            //nao registamos operacoes no campo nome do ficheiro e no campo extensao do ficheiro
            if($this->data[$i]->db === $this->blob_embedded->fileNameField  || $this->data[$i]->db===$this->blob_embedded->extField){
                continue;
            }

            if (
                (isset($this->data[$i]->nxt_value) ||
                    $this->data[$i]->nxt_value === null) &&
                $this->data[$i]->nxt_value !== $this->data[$i]->prv_value
            ) {
                # existe alteração, que poderá não ser efetivada derivado ao workflow
                $change = true;
                if (isset($this->wkf)) {
                    if ($this->wkfMode === "postponed") {
                        $submitDML = $this->wkf->notifyThisUpload(
                            $this->table,
                            $this->operation,
                            $this->data[$i],
                            $this->setPK($this->pk),
                            $this->data,
                            $this->cxLists,
                            $this->domains,
                            $this->wkfUpdate
                        );
                    } else {
                        $stt = $this->wkf->notifyThisUpload(
                            $this->table,
                            $this->operation,
                            $this->data[$i],
                            $this->setPK($this->pk),
                            $this->data,
                            $this->cxLists,
                            $this->domains,
                            $this->wkfUpdate
                        );
                        $statements = array_merge($statements, $stt);
                        $submitDML = true;
                    }
                } else {
                    $submitDML = true;
                }

                if (
                    $this->getDatetype($i) != '' &&
                    strtoupper($this->getDatetype($i)) == 'JUST_EDITOR'
                ) {
                    # existe a necessidade de forçar o upgrade igualando uma coluna da chave
                    if ($sql_body == '') {
                        if ($i > 0) {
                            $sql_body =
                                $this->getColName(0) .
                                " = " .
                                $this->getColName(0);
                        } else {
                            $sql_body =
                                $this->getColName(1) .
                                " = " .
                                $this->getColName(1);
                        }
                    }
                } else {
                    $bdColumn = $this->getColName($i);
                    $newVal = $this->data[$i]->nxt_value;
                    if ($newVal == '') {
                        $newVal = $nulo;
                    } else {
                        $dateType = $this->getDatetype($i);
                        if ($dateType) {
                            $newVal = $this->formatToDatetype(
                                $bdColumn,
                                $dateType,
                                $newVal
                            );
                        } else {
                            $newVal =
                                "'" . str_replace("'", "''", $newVal) . "'";
                        }
                    }

                    if (!empty($this->funcFields)) {
                        if ($sql_body != '') {
                            if (
                                !empty($this->funcFields) &&
                                !in_array($bdColumn, $this->funcFields)
                            ) {
                                $sql_body .= ', ' . $bdColumn . '=' . $newVal;
                            } else {
                                $sql_body .= ', ' . $bdColumn . '=' . $newVal;
                            }
                        } else {
                            if (
                                !empty($funcFields) &&
                                !in_array($bdColumn, $this->funcFields)
                            ) {
                                $sql_body .= ' ' . $bdColumn . '=' . $newVal;
                            } else {
                                $sql_body .= ' ' . $bdColumn . '=' . $newVal;
                            }
                        }
                    } else {
                        if ($sql_body != '') {
                            $sql_body .= ', ' . $bdColumn . '=' . $newVal;
                        } else {
                            $sql_body .= ' ' . $bdColumn . '=' . $newVal;
                        }
                        if (isset($this->blob_embedded)) {
                            if ($_FILES) {
                                $file = $_FILES["upload"];
                                $sql_body .=
                                    ', ' .
                                    $this->blob_embedded->blobField .
                                    '=:data';

                                $sql_body .=
                                    ', ' .
                                    $this->blob_embedded->extField .
                                    "='" .
                                    pathinfo(
                                        $file["name"][0] . "'",
                                        PATHINFO_EXTENSION
                                    );
                                $sql_body .=
                                    ', ' .
                                    $this->blob_embedded->fileNameField .
                                    "='" .
                                    $file["name"][0] .
                                    "'";
                            }
                        }
                    }
                }
            }
            null;
        }
        return $sql_body;
    }

    # executa as operações de INSERT
    public function doInsert($db, $info)
    {
        $statements = [];
        $nulo = 'NULL';
        $sql_cols = '';
        $sql_vals = '';
        $submitDML = false;
        $insert = false;
        $newVal = '';
        $msg = '';

        # constroi o statment de INSERT
        $sql_hdr = "INSERT INTO " . $this->table . "  ";

        $infoData = $this->getColsAndVals($nulo, $sql_cols, $sql_vals);
        $sqlData = $infoData[0];
        $submitDML == $infoData[1];
        # no caso de ser um workflow em modo de postponed, só efetua a notificação,
        # não criando o registo e parando o processo em notifyUser
        # com exceção do caso em que existe uma auto-aprovação e aí a variável $submitDML é colocada a true
        # e é efetuado o DML

        if (isset($this->wkf) && $this->wkfMode === 'postponed') {
            $notifyResp = $this->wkf->notifyThisUpload(
                $this->table,
                $this->operation,
                null,
                $this->setPK($this->pk),
                $this->data,
                $this->cxLists,
                $this->domains,
                $this->wkfUpdate
            );
            $submitDML = is_array($notifyResp) ? $notifyResp[1] : $notifyResp;
            $insert = true;
        } elseif (isset($this->wkf) && $this->wkfMode === 'optimistic') {
            $statements = $this->wkf->notifyThisUpload(
                $this->table,
                $this->operation,
                null,
                $this->setPK($this->pk),
                $this->data,
                $this->cxLists,
                $this->domains,
                $this->wkfUpdate
            );
            $submitDML = true;
            $insert = true;
        } else {
            $submitDML = true;
            $insert = true;
        }

        # submeter o statement
        if ($submitDML) {
            $file = $_FILES["upload"];
            if (!isset($this->docsTable) && isset($this->blob_embedded)) {
                # trata o número de ficheiros carregados

                $ext = pathinfo($file["name"][0], PATHINFO_EXTENSION);
                if ($this->blob_embedded) {
                    //if ($this->blob_embedded->display) {
                        $sqlData[$this->blob_embedded->blobField] = ":data";
                   // }

                    $sqlData[$this->blob_embedded->fileNameField] =
                        "'" . $file["name"][0] . "'";
                    $sqlData[$this->blob_embedded->extField] = "'" . $ext . "'";
                } else {
                    //todo not blob not embedded
                }

                $tempFile = $file["tmp_name"][0];
                if (is_uploaded_file($tempFile)) {
                    if (
                        !isset($this->docsTable) &&
                        isset($this->blob_embedded)
                    ) {
                        $doc = file_get_contents($tempFile);
                    } else {
                        $targetPath =
                            dirname(__FILE__) .
                            '/../' .
                            $this->blob_embedded->savePath;

                        $targetPath .= '/' . $file["name"][0];

                        move_uploaded_file($tempFile, $targetPath);
                    }
                }

                $sql =
                    $sql_hdr .
                    "(" .
                    implode( ",",array_keys($sqlData)) .
                    ") VALUES (" .
                    implode( ",",array_values($sqlData)) .
                    ")";
                $this->exec_DML_oracle($this->table, $sql);
                $stmt = $db->prepare($sql);
                $select_row = $info["selectUpdated"];

                $retRow = $db->prepare($select_row);
                if (isset($this->blob_embedded)) {
                    $stmt->bindParam(':data', $doc, PDO::PARAM_LOB);
                }
                if (isset($this->wkf)) {
                    array_push($statements, $stmt);
                } else {
                    try {
                        $stmt->execute();
                    } catch (Exception $ex) {
                        QuadUploads::getErrors($db, $ex);
                    }
                }
                //SELECT para devolver ao QUADTABLES/QUADFORMS o registo alvo de DML
                // Execute Query
                try {
                    if (isset($this->wkf) && $this->wkfMode === 'optimistic') {
                        array_push($statements, $retRow);
                        if (
                            $this->wkf->doWorkFlowTransaction($statements, $db)
                        ) {
                            # obtem os dados após a execução das operações
                            $retRow->execute();
                            $data = $retRow->fetchAll(PDO::FETCH_ASSOC);
                        }
                    } elseif (
                        isset($this->wkf) &&
                        $this->wkfMode === 'postponed'
                    ) {
                        if ($this->wkf->doWorkFlowTransaction($stmt, '', $db)) {
                            # obtem os dados após a execução das operações
                            $retRow->execute();
                            $data = $retRow->fetchAll(PDO::FETCH_ASSOC);
                        }
                        // }
                    } else {
                        # obtem os dados após a execução das operações
                        $retRow->execute();
                        $data = $retRow->fetchAll(PDO::FETCH_ASSOC);
                    }
                } catch (Exception $ex) {
                    QuadUploads::getErrors($db, $ex);
                }
            }

            if (is_array($submitDML) && $submitDML[0] === "N") {
                die();
            }

            $dadosOut = array(
                "data" => $data
            );
            ###Estacio code here??
            echo json_encode($dadosOut);
        } elseif ($insert) {
            # neste caso existiu uma inserção mas a mesma não é efetivada
            # porque entrou em processo de workflow
            $dadosOut = array(
                "msg" => "ok"
            );
            echo json_encode($dadosOut);
        }
        ###Estacio code here??
        $this->saveOperationLog($insert);
    }

    public function doUpdate($db, $info)
    {
        $sql_cols = '';
        $sql_vals = '';
        $statements = [];
        $nulo = 'NULL';
        $submitDML = false;
        $change = false;
        $sql = "";

        # constroi o statment de UPDATE
        $sql_hdr = $this->operation . " " . $this->table . " SET ";

        $sql_body = $this->runUpdateActions(
            $info,
            $db,
            $nulo,
            $statements,
            $change,
            $submitDML
        );
        # submeter o statement
        if ($submitDML) {
            # executa o statement de UPDATE
            $sqlStatement =
                $sql_hdr .
                $sql_body .
                ' WHERE 1=1 ' .
                $info['whereUpdatedRecord'];

            // Execute Statment
            try {
                $file = $_FILES["upload"];
                $tempFile = $file["tmp_name"][0];
                if (is_uploaded_file($tempFile)) {
                    if (
                        !isset($this->docsTable) &&
                        isset($this->blob_embedded)
                    ) {
                        $doc = file_get_contents($tempFile);
                    } else {
                        $targetPath =
                            dirname(__FILE__) .
                            '/../' .
                            $this->blob_embedded->savePath;

                        $targetPath .= '/' . $file["name"][0];

                        move_uploaded_file($tempFile, $targetPath);
                    }
                }

                $stmt = $db->prepare($sqlStatement);
                if (isset($this->blob_embedded)) {
                    $stmt->bindParam(':data', $doc, PDO::PARAM_LOB);
                }

                //SELECT para devolver ao QUADTABLES/QUADFORMS o registo alvo de DML

                $select_row =
                    "SELECT " .
                    $info['columns'] .
                    " FROM " .
                    $this->table .
                    " " .
                    $this->alias .
                    ' WHERE 1=1 ' .
                    $info['whereUpdatedRecord'];
                $retRow = $db->prepare($select_row);
                array_push($statements, $stmt);
                array_push($statements, $retRow);

                if (isset($this->wkf) && $this->wkfMode === 'optimistic') {
                    if ($this->wkf->doWorkFlowTransaction($statements, $db)) {
                        $data = $retRow->fetchAll(PDO::FETCH_ASSOC);
                        //print_r($data);
                        $dadosOut = array(
                            "data" => $data
                        );
                        echo json_encode($dadosOut);
                    }
                } elseif (isset($this->wkf) && $this->wkfMode === 'postponed') {
                    if (
                        $this->wkf->doWorkFlowTransaction(
                            $sqlStatement,
                            '',
                            $db
                        )
                    ) {
                        $retRow->execute();
                        $data = $retRow->fetchAll(PDO::FETCH_ASSOC);
                        //Torna possivel o json encode de blob
                        if (isset($this->blob_embedded->blobField)) {
                            if (
                                isset($data[0][$this->blob_embedded->blobField])
                            ) {
                                $data[0][
                                    $this->blob_embedded->blobField
                                ] = base64_encode(
                                    $data[0][$this->blob_embedded->blobField]
                                );
                            }
                        }
                        $dadosOut = array(
                            "data" => $data
                        );
                        echo json_encode($dadosOut);
                    }
                } else {
                    # ORACLE REPLICATION
                    $this->exec_DML_oracle($this->table, $sql);
                    $stmt->execute();

                    $retRow->execute();
                    $data = $retRow->fetchAll(PDO::FETCH_ASSOC);

                    $dadosOut = array(
                        "data" => $data
                    );
                    echo json_encode($dadosOut);
                }
            } catch (Exception $ex) {
                QuadUploads::getErrors($db, $ex);
            }
        } else {
            # se não existiu qualquer coluna alterada ...
            if (!$change) {
                $dadosOut = array(
                    "status" => "unchanged"
                );
                echo json_encode($dadosOut);
                # neste caso existiu alteração mas a mesma não é efetivada
                # porque entrou em processo de workflow
            } else {
                $dadosOut = array(
                    "status" => "ok"
                );
                echo json_encode($dadosOut);
            }
        }
        $this->saveOperationLog($change);
    }

    public function saveOperationLog($flag)
    {
        if ($this->active_log && $flag) {
            $wkfU = '';
            if (isset($this->wkf)) {
                $wkfU = $this->wkfUpdate;
            }
            $this->log->registoLog(
                $this->table,
                $this->operation,
                null,
                $this->setPK($this->pk),
                $this->data,
                $this->cxLists,
                $this->domains,
                $wkfU
            );
        }
    }
}
