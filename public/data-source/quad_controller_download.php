<?php
/*
 *  @autor      Pedro Estácio <pedro.estacio@quad-systems.com>
 *  @versão     2.0
 *  @revisão    2018.06.15
 *  @copyright  (c) 2018 QuadSystems - http://www.quad-systems.com
 *  @nome     	quad_controller_download.php
 *  @descrição  Controlador para efetuar o download aplicacional de ficheiros guardados na aplicação
 *
 */

# cabeçaho do controlador
require_once 'quad_head_controller.php';

# diretoria para leitura física dos documentos em FS
$dir = DOCS_PATH.'/';

if (@$_REQUEST['id']) {
    $pk_values = explode("@", @$_REQUEST['id']);
}

if (@$_REQUEST['ref']) {
    $pk_cols = json_decode(@$_REQUEST['ref']);
}
$tab = strtoupper(@$_REQUEST['tab']);
# constroi a condição de seleção do registo com base na informação recebida
# pk_cols - objeto json com o nome da coluna e o respetivo tipo
# pk_values = array com os valores da pk do registo pelo ordem indicada em pk_cols
function setWhereClause($pk_cols, $pk_values)
{
    $i = 0;
    $where = '';
    foreach ($pk_cols as $key => $value) {
        if ($value->type == 'date' || $value->type == 'datetime') {
            if (strlen(trim($pk_values[$i])) == 10) {
                $whr =
                    " TO_CHAR($key,'YYYY-MM-DD') = '" . $pk_values[$i] . "' ";
            } elseif (strlen(trim($pk_values[$i])) == 16) {
                $whr =
                    " TO_CHAR($key,'YYYY-MM-DD HH24:MI') = '" .
                    $pk_values[$i] .
                    "' ";
            }
        } else {
            $whr = " $key = '" . $pk_values[$i] . "' ";
        }
        if ($where == '') {
            $where = $whr;
        } else {
            $where .= " AND " . $whr;
        }
        $i += 1;
    }
    return $where;
}

# devolve o mime de acordo com o formato registado
function mime_type($mime)
{
    $dsp_mime_ = "";
    $mime = strtolower($mime);
    if ($mime == "pdf") {
        $dsp_mime_ = "application/pdf";
    }
    if ($mime == "doc") {
        $dsp_mime_ = "application/msword";
    }
    if ($mime == "dot") {
        $dsp_mime_ = "application/msword";
    }
    if ($mime == "docx") {
        $dsp_mime_ =
            "application/vnd.openxmlformats-officedocument.wordprocessingml.document";
    }
    if ($mime == "dotx") {
        $dsp_mime_ =
            "application/vnd.openxmlformats-officedocument.wordprocessingml.template";
    }
    if ($mime == "docm") {
        $dsp_mime_ = "application/vnd.ms-word.document.macroEnabled.12";
    }
    if ($mime == "dotm") {
        $dsp_mime_ = "application/vnd.ms-word.template.macroEnabled.12";
    }
    if ($mime == "xls") {
        $dsp_mime_ = "application/vnd.ms-excel";
    }
    if ($mime == "xlt") {
        $dsp_mime_ = "application/vnd.ms-excel";
    }
    if ($mime == "xla") {
        $dsp_mime_ = "application/vnd.ms-excel";
    }
    if ($mime == "xlsx") {
        $dsp_mime_ =
            "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";
    }
    if ($mime == "xltx") {
        $dsp_mime_ =
            "application/vnd.openxmlformats-officedocument.spreadsheetml.template";
    }
    if ($mime == "xlsm") {
        $dsp_mime_ = "application/vnd.ms-excel.sheet.macroEnabled.12";
    }
    if ($mime == "xltm") {
        $dsp_mime_ = "application/vnd.ms-excel.template.macroEnabled.12";
    }
    if ($mime == "xlam") {
        $dsp_mime_ = "application/vnd.ms-excel.addin.macroEnabled.12";
    }
    if ($mime == "xlsb") {
        $dsp_mime_ = "application/vnd.ms-excel.sheet.binary.macroEnabled.12";
    }
    if ($mime == "ppt") {
        $dsp_mime_ = "application/vnd.ms-powerpoint";
    }
    if ($mime == "pot") {
        $dsp_mime_ = "application/vnd.ms-powerpoint";
    }
    if ($mime == "pps") {
        $dsp_mime_ = "application/vnd.ms-powerpoint";
    }
    if ($mime == "ppa") {
        $dsp_mime_ = "application/vnd.ms-powerpoint";
    }
    if ($mime == "pptx") {
        $dsp_mime_ =
            "application/vnd.openxmlformats-officedocument.presentationml.presentation";
    }
    if ($mime == "potx") {
        $dsp_mime_ =
            "application/vnd.openxmlformats-officedocument.presentationml.template";
    }
    if ($mime == "ppsx") {
        $dsp_mime_ =
            "application/vnd.openxmlformats-officedocument.presentationml.slideshow";
    }
    if ($mime == "ppam") {
        $dsp_mime_ = "application/vnd.ms-powerpoint.addin.macroEnabled.12";
    }
    if ($mime == "pptm") {
        $dsp_mime_ =
            "application/vnd.ms-powerpoint.presentation.macroEnabled.12";
    }
    if ($mime == "potm") {
        $dsp_mime_ = "application/vnd.ms-powerpoint.template.macroEnabled.12";
    }
    if ($mime == "ppsm") {
        $dsp_mime_ = "application/vnd.ms-powerpoint.slideshow.macroEnabled.12";
    }
    if ($mime == "mdb") {
        $dsp_mime_ = "application/vnd.ms-access";
    }

    return $dsp_mime_;
}

# constroi a condição de seleção do registo com base na informação recebida
$where = setWhereClause($pk_cols, $pk_values);

# executa a query para carregar o documento
if ($tab != '' && $where != '') {
    try {
        $sql =
            "SELECT A.BD_DOC, A.BD_MIME, A.LINK_DOC " .
            "FROM $tab A " .
            "WHERE $where " .
            "  AND (A.BD_MIME IS NOT NULL OR A.LINK_DOC IS NOT NULL) ";
        $sql .= "ORDER BY 1 DESC ";

        $stmt = $db->prepare($sql);
        $stmt->execute();
        $stmt->bindColumn(1, $blob_, PDO::PARAM_LOB);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($row['BD_DOC'] != '') {
                $mime = $row['BD_MIME'];
                $ficheiro = pathinfo($row['LINK_DOC'], PATHINFO_BASENAME);
                if ($ficheiro == '') {
                    $ficheiro = substr(sha1(mt_rand()), 17, 12) . ".$mime";
                }

                header('Content-type: application/json');
                $res=new stdClass();
                $res->filename=$ficheiro;
                $res->blob=base64_encode($blob_);
                echo json_encode($res);
                //echo $blob_;
            } elseif ($row['LINK_DOC'] != '') {
                $mime = pathinfo($row['LINK_DOC'], PATHINFO_EXTENSION);
                $ficheiro = $row['LINK_DOC'];
                $blob_ = file_get_contents($dir . $ficheiro);
                $ficheiro = pathinfo($row['LINK_DOC'], PATHINFO_BASENAME);
                echo $row['LINK_DOC'];
            }
            break;
        }
    } catch (PDOException $ex) {
        echo "erro# :" . $ex->getMessage();
    }
}

# descarrega o documento para o browser
if ($mime != '' && $blob_ != '') {
    #echo "ficheiro[$ficheiro] mime[$mime] dsp_mime:[".mime_type($mime)."]<br/>";
    /*header("Content-Type: " . mime_type($mime));
    header('Accept-Ranges: bytes');
    header('Content-Transfer-Encoding: binary');
    header('Content-Length: ' . strlen($blob_));
    header('Content-Disposition: attachment; filename="' . $ficheiro . '"');
    echo $blob_;*/
}
