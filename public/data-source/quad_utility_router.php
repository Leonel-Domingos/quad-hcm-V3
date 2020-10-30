<?php# cabeçaho do controladorrequire_once 'quad_head_controller.php';if (isJson(file_get_contents("php://input"))) {    //ARE PARAMETERS ON JSON FORMAT? (always used by JS Workers)    $workerData = json_decode(file_get_contents("php://input"));    if ($workerData->request_id) {        $ajax_id = $workerData->request_id; //Setting Request Id.    } else {        $msg =            'Request Id. was not provided. This way we are not able to route your request.';    }} else {    $ajax_id = $_REQUEST['request_id'];}/* ROUTING REQUEST ON LIST OF AVAILABLE GATES *///AddCell14Monthsif ($ajax_id == 'AddCell14Months') {    /* Cria 14 registos associados a uma célula de cálculo, com os 12 meses do ano + Sub. Férias + Sub. Natal */    $cell = $workerData->cell_name;    $isQueryOk = false;    //Execute INSERT    if (@$_SESSION['database'] === 'MYSQL') {        try {            $sql =                "INSERT INTO RH_DEF_CELULAS_MES (CELL, MES, ACTIVO) VALUES " .                "('" .                $cell .                "', 1, 'S'), ('" .                $cell .                "', 2, 'S'), ('" .                $cell .                "', 3, 'S'), " .                "('" .                $cell .                "', 4, 'S'), ('" .                $cell .                "', 5, 'S'), ('" .                $cell .                "', 6, 'S'), " .                "('" .                $cell .                "', 7, 'S'), ('" .                $cell .                "', 8, 'S'), ('" .                $cell .                "', 9, 'S'), " .                "('" .                $cell .                "', 10, 'S'), ('" .                $cell .                "', 11, 'S'), ('" .                $cell .                "', 12, 'S'), " .                "('" .                $cell .                "', 13, 'S'), ('" .                $cell .                "', 14, 'S') " .                "ON DUPLICATE KEY UPDATE CELL = CELL";            //echo $sql;            $stmt = $db->prepare($sql);            $isQueryOk = $stmt->execute();        } catch (PDOException $e) {            $msg = 'B. [' . $sql . '] :' . $e->getMessage();        }    } else {        //ON ORACLE (using rowid)        try {            $sql =                $sql_hdr .                "(" .                $sql_cols .                ") VALUES (" .                $sql_vals .                ") RETURNING ROWID INTO :rid";            $stmt = $db->prepare($sql);            $stmt->bindParam(':rid', $rowid);            $isQueryOk = $stmt->execute();        } catch (PDOException $e) {            $msg = 'C. ' . $ex->getMessage();        }    }    // Execute Statment    $e = '';    try {        if ($isQueryOk) {            $dadosOut = array(                "msg" => "OK"            );            echo json_encode($dadosOut);        }    } catch (Exception $ex) {        $msg = 'D-1. On [' . $sql . ']' . $ex->getMessage();    }}//END AddCell14Months//QUAD-BUILDERif (1 == 1) {    //Parse_Sql    if ($ajax_id === 'Parse_Sql') {        $sql = $workerData->sql_statement;        if (strlen($sql) > 0) {            try {                $stmt = $db->prepare($sql);                //echo '1. '.$stmt;                $isQueryOk = $stmt->execute();                //echo ' 2. '.$isQueryOk;                $dadosOut = array(                    "status" => 'OK'                );            } catch (PDOException $e) {                //$msg = 'C. ' . $e->getMessage();                $dadosOut = array(                    "status" => 'NOK',                    "trace" => $e->getMessage(),                    "length" => strlen($sql)                );            }        } else {            $dadosOut = array(                "status" => 'N/A'            );        }        $msg = '';        echo json_encode($dadosOut);    }    //END Parse_Sql    //Execute_Sql    if ($ajax_id === 'Execute_Sql') {        if ( isset($workerData->sql_statement) ) {            $sql = $workerData->sql_statement;        } else {            $sql = null;        }                if ( isset($workerData->binders) ) {            $binders = $workerData->binders;        } else {            $binders = null;                    }                if (strlen($sql) > 0) {            try {                $stmt = $db->prepare($sql);                //IF SQL uses BIND variables...                if ($binders) {                    $tmp = json_decode($binders);                    foreach ($tmp as $vlr) {                        $stmt->bindParam(':' . $vlr->name, $vlr->value);                    }                }                                $isQueryOk = $stmt->execute();                if ($isQueryOk) {                    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);                    $table_html = '';                    if (count($res) > 0) {                        $table_html .=                            '<table id="Qry" class="table table-fixed table-bordered table-striped table-hover dragtable"' .                            ' data-toggle="bootstrap-table" ' .                            ' data-show-columns="true" data-search="true" data-show-toggle="true" ' .                            ' data-pagination="false" data-url="json/data1.json" data-reorderable-columns="true"' .                            '>' .                            '   <thead>' .                            '       <tr>' .                            '           <th>#</th>' .                            '           <th>' .                            implode('</th><th>', array_keys(current($res))) .                            '</th>' .                            '       </tr>' .                            '   </thead>' .                            '   <tbody>';                        $cnt = 1;                        foreach ($res as $row) {                            array_map('htmlentities', $row);                            $table_html .=                                '   <tr>' .                                '       <td>' .                                $cnt .                                '</td>' .                                '       <td>' .                                implode('</td><td>', $row) .                                '</td>' .                                '   </tr>';                            ++$cnt;                        }                        $table_html .= '  </tbody>' . '</table>';                    }                    $dadosOut = array(                        "status" => 'OK',                        "data" => $table_html,                        "counter" => count($res)                    );                }            } catch (PDOException $e) {                //$msg = 'C. ' . $e->getMessage();                $dadosOut = array(                    "status" => 'NOK',                    "trace" => $e->getMessage(),                    "length" => strlen($sql)                );            }        } else {            $dadosOut = array(                "status" => 'N/A'            );        }        $msg = '';        echo json_encode($dadosOut);    }    //END Execute_Sql    //New_SQL :: Checks IF SQL CODE ALREADY EXISTS    if ($ajax_id === 'New_SQL') {        $sql =            "SELECT ID FROM QUAD_QUERIES_USER WHERE UPPER(TRIM(REPLACE(REPLACE(REPLACE(REPLACE(SQL_CODE,' ',''),'\t',''),'\n',''),'\r',''))) LIKE UPPER(TRIM(REPLACE(REPLACE(REPLACE(REPLACE(:SQL_CODE,' ',''),'\t',''),'\n',''),'\r','')))";                        if ( isset($workerData->sql_statement) ) {            $sql_to_verify = $workerData->sql_statement;        } else {            $sql_to_verify = null;        }        if ( ( strlen($sql) > 0 ) && ( (strlen($sql_to_verify) > 0) ) ){            try {                $stmt = $db->prepare($sql);                $stmt->bindParam(':SQL_CODE', $sql_to_verify);                $isQueryOk = $stmt->execute();                $res = $stmt->fetch(PDO::FETCH_ASSOC);                if ($res['ID'] == '') {                    //NEW SQL                    $dadosOut = array(                        "status" => 'OK'                    );                } else {                    //ALREADY EXISTS                    $dadosOut = array(                        "status" => 'NOK',                        "trace" => $res['ID'],                        "length" => strlen($sql)                    );                }            } catch (PDOException $e) {                //$msg = 'C. ' . $e->getMessage();                $dadosOut = array(                    "status" => 'NOK',                    "trace" => $e->getMessage(),                    "length" => strlen($sql)                );            }        } else {            $dadosOut = array(                "status" => 'N/A'            );        }        $msg = '';        echo json_encode($dadosOut);    }    //END Parse_Sql}//END QUAD-BUILDER//MULTIPURPOSE :: BINDSif (1 === 1) {    if ( $ajax_id === 'Go_SQL') {                 if ( isset($workerData->sql_statement) ) {            $sql = $workerData->sql_statement;        } else {            $sql = null;        }                        if ( isset($workerData->sql_statement) ) {            $binders = json_encode($workerData->binders);        } else {            $binders = null;        }         if ( strlen($sql) > 0) {                     try {                $stmt = $db->prepare($sql);                //IF SQL uses BIND variables...                if ( $binders ) {                    $tmp = json_decode($binders);                    foreach ($tmp as $vlr) {                        $stmt->bindParam(':'.$vlr->name, $vlr->value);                    }                      }                $isQueryOk = $stmt->execute();                if ($isQueryOk ) {                    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);                     $dadosOut = array(                        "status" => 'OK',                        "data" => $res,                        "counter" => count($res)                    );                }            } catch (PDOException $e) {                //$msg = 'C. ' . $e->getMessage();                $dadosOut = array(                    "status" => 'NOK',                    "trace" => $e->getMessage(),                    "length" => strlen($sql)                );            }                   } else {            $dadosOut = array(                "status" => 'N/A'            );        }        $msg = '';        echo json_encode($dadosOut);    }    //END Execute_Sql}//MULTIPURPOSE :: BINDS    //GESTAO TEMPOif (1 == 1) {    if ($ajax_id === 'GravaEscala') {        /* Cria / Atualiza registo de Escala Horária */        $chaveArray = explode('@', $workerData->key);        $isQueryOk = false;        if (@$_SESSION['database'] === 'MYSQL') {            //Check Horario exists?            global $error_daily_schedule;            $out_msg = '';            //echo  $workerData->val .' '.$existe;            //Execute INSERT OR DELETE            try {                if ($workerData->val != '') {                    $existe = horario_diario_existente(                        $workerData->val,                        'S',                        $out_msg                    );                    if (!$existe) {                        $msg = $error_daily_schedule;                    } else {                        $sql =                            "INSERT INTO RH_ID_ESCALAS_HORARIAS(EMPRESA, RHID, DT_ADMISSAO, DIA, TIPO, CD_HOR_DIA)" .                            "VALUES (:EMPRESA, :RHID, TO_DATE(:DT_ADMISSAO,'YYYY-MM-DD'), TO_DATE(:DIA,'YYYY-MM-DD'), 'A', :HORARIO)" .                            "ON DUPLICATE KEY UPDATE CD_HOR_DIA = :HORARIO";                        $branch = '1';                        $stmt = $db->prepare($sql);                        $stmt->bindParam(':EMPRESA', $chaveArray[0]);                        $stmt->bindParam(':RHID', $chaveArray[1]);                        $stmt->bindParam(':DT_ADMISSAO', $chaveArray[2]);                        $stmt->bindParam(':DIA', $chaveArray[3]);                        $stmt->bindParam(':HORARIO', $workerData->val);                        $isQueryOk = $stmt->execute();                    }                } else {                    $sql =                        "DELETE FROM RH_ID_ESCALAS_HORARIAS WHERE EMPRESA = :EMPRESA AND RHID=:RHID AND DT_ADMISSAO=TO_DATE(:DT_ADMISSAO,'YYYY-MM-DD') AND DIA = TO_DATE(:DIA,'YYYY-MM-DD') AND TIPO = 'A'";                    $branch = '2';                    $stmt = $db->prepare($sql);                    $stmt->bindParam(':EMPRESA', $chaveArray[0]);                    $stmt->bindParam(':RHID', $chaveArray[1]);                    $stmt->bindParam(':DT_ADMISSAO', $chaveArray[2]);                    $stmt->bindParam(':DIA', $chaveArray[3]);                    $isQueryOk = $stmt->execute();                    //echo ':: '.$isQueryOk. ' :: '.$chaveArray[0]." ".$chaveArray[1]." ".$chaveArray[2]." ".$chaveArray[3];                }            } catch (PDOException $e) {                $msg =                    'GravaEscala #' .                    $branch .                    ': [' .                    $sql .                    '] :' .                    $e->getMessage() .                    ' ---> ' .                    $chaveArray[0] .                    "@" .                    $chaveArray[1] .                    "@" .                    $chaveArray[2] .                    "@" .                    $chaveArray[3] .                    " -> " .                    $workerData->val;                $isQueryOk = false;            }        } else {            //ON ORACLE (using rowid)            $msg =                'Escalas Horárias Controller: Unexpected Database. Contact Suport';            $isQueryOk = false;        }        //Return Statement        $e = '';        try {            if ($isQueryOk) {                $inclui_indisp = 'S';                $origem = '';                $hor = '';                $e_1 = '';                $s_1 = '';                $e_2 = '';                $s_2 = '';                $he_1 = '';                $hs_1 = '';                $he_2 = '';                $hs_2 = '';                $he_3 = '';                $hs_3 = '';                $ini_dia = '';                $e_noct = '';                $s_noct = '';                $hor_esp_min = '';                $hor_esp_hrs = '';                $indisp_fer = '';                $indisp_dc = '';                $indisp_aus = '';                $indisp_bh = '';                $bh = '';                $th = '';                $cd_turno = '';                $dsp_turno = '';                $msg_1 = '';                //echo $chaveArray[0].' '. $chaveArray[1].' '.$chaveArray[2].' '.$chaveArray[3];                rhid_horario_diario(                    $chaveArray[0],                    $chaveArray[1],                    $chaveArray[2],                    $chaveArray[3],                    $inclui_indisp,                    $origem,                    $hor,                    $e_1,                    $s_1,                    $e_2,                    $s_2,                    $he_1,                    $hs_1,                    $he_2,                    $hs_2,                    $he_3,                    $hs_3,                    $ini_dia,                    $e_noct,                    $s_noct,                    $hor_esp_min,                    $hor_esp_hrs,                    $indisp_fer,                    $indisp_dc,                    $indisp_aus,                    $indisp_bh,                    $bh,                    $th,                    $bh_transp,                    $th_transp,                    $cd_turno,                    $dsp_turno,                    $msg                );                $dadosOut = array(                    "data" => array(                        "origem" => $origem,                        "hor" => $hor,                        "e_1" => $e_1,                        "s_1" => $s_1,                        "e_2" => $e_2,                        "s_2" => $s_2,                        "he_1" => $he_1,                        "hs_1" => $hs_1,                        "he_2" => $he_2,                        "hs_2" => $hs_2,                        "he_3" => $he_3,                        "hs_3" => $hs_3,                        "ini_dia" => $ini_dia,                        "e_noct" => $e_noct,                        "s_noct" => $s_noct,                        "hor_esp_min" => $hor_esp_min,                        "hor_esp_hrs" => $hor_esp_hrs,                        "indisp_fer" => $indisp_fer,                        "indisp_dc" => $indisp_dc,                        "indisp_aus" => $indisp_aus,                        "indisp_bh" => $indisp_bh,                        "bh" => $bh,                        "th" => $th,                        "bh_transp" => $bh_transp,                        "th_transp" => $th_transp                    ),                    "msg" => "OK"                );                echo json_encode($dadosOut);            }        } catch (Exception $ex) {            $msg = 'GravaEscala #9 On [' . $sql . ']' . $ex->getMessage();        }    }}//END GESTAO TEMPO// GESTÃO WOKFLOWSif (1 == 1) {    if ($ajax_id === 'workflows') {        $acao = isset($workerData->acao) ? $workerData->acao : '';;        $tipo = isset($workerData->tipo) ? $workerData->tipo : '';        $mod = isset($workerData->modulo) ? $workerData->modulo : '';        $perf = isset($workerData->perfil) ? $workerData->perfil : '';        $valor = isset($workerData->valor) ? $workerData->valor : '';        if ($acao == 'gera_recursos') {            $msg = '';            clear_fx_workflow($msg);            if ($msg == '') {                gera_fx_workflow('','',$msg);            }        } else {            $estado = '';            $modo_acesso = '';            $notif_ecran = '';            $notif_email = '';            $notif_sms = '';            if ($tipo == 'acessos') {                $modo_acesso = $valor;            } elseif ($tipo == 'wkf') {                $estado = $valor;            } elseif ($tipo == 'notif') {                $notif_ecran = 'N';                $notif_email = 'N';                $notif_sms = 'N';                if (in_array('A', $valor)) {                    $notif_ecran = 'S';                }                if (in_array('B', $valor)) {                    $notif_email = 'S';                }                if (in_array('C', $valor)) {                    $notif_sms = 'S';                }            }            if ($tipo != '' && $mod != '' && $perf != '') {                set_workflow(                    $mod,                    $perf,                    $estado,                    $modo_acesso,                    $notif_ecran,                    $notif_email,                    $notif_sms,                    $msg                );            }        }        if ($msg == '') {            $dadosOut = array(                "msg" => 'OK'            );            echo json_encode($dadosOut);        } else {            $dadosOut = array(                "error" => $msg            );            echo json_encode($dadosOut);        }    }    elseif ($ajax_id === 'RGPD_colunas') {        $acao = $workerData->acao;        if ($acao == 'gravar') {            $id = $workerData->id;            $mod = $workerData->modulo;            $perf = $workerData->perfil;            $valor = $workerData->valor;            $estado = $valor;            if ($id != '' && $mod != '' && $perf != '' && $estado != '') {                set_colunas_RGPD(                    $id,                    $mod,                    $perf,                    $estado,                    $msg                );            }            if ($msg == '') {                $dadosOut = array(                    "msg" => 'OK'                );                echo json_encode($dadosOut);            } else {                $dadosOut = array(                    "error" => $msg                );                echo json_encode($dadosOut);            }        }        elseif ($acao == 'muda_estado') {            $mod = $workerData->modulo;            $perf = $workerData->perfil;            $valor = $workerData->valor;            $estado = $valor;            if ($mod != '' && $perf != '' && $estado != '') {                set_colunas_RGPD(                    '',                    $mod,                    $perf,                    $estado,                    $msg                );                if ($msg == '') {                    $dadosOut = array(                        "msg" => 'OK'                    );                    echo json_encode($dadosOut);                } else {                    $dadosOut = array(                        "error" => $msg                    );                    echo json_encode($dadosOut);                }            }        }    }}/* EXITING WITH ERROR */if ($msg != '') {    //Removing "garbage" from error message    $msg = str_replace("ORA-20000: ", "", $msg);    $pos = strpos($msg, "EOM");    if ($pos) {        $msg = substr($msg, 0, $pos);    }    $dadosOut = array(        "error" => $msg    );    echo json_encode($dadosOut);    //echo "ERRO: " . $msg;}?>