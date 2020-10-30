<?php
/*
 *  @autor      Pedro Mengo de Abreu <pedro.mengo.abreu@quad-systems.com>
 *  @versão     1.0
 *  @revisão    2016.05.23
 *  @copyright  (c) 2016 QuadSystems - http://www.quad-systems.com
 *  @nome	quad_db_lib.php
 *  @descrição  Libraria de funções:
 *               - Funções para construção de listas de valores
 *               - Funções suporte à infra-estrutra (módulos, perfis, línguas)
 *               - Funções suporte ao gerador de interfaces
 *               - Funções suporte ao PRS,
 */

// https://github.com/voku/Arrayy
#require_once(__DIR__."/../classes/Arrayy/vendor/autoload.php");    

# livraria das funções associadas a validações
# livrarias de acesso
require_once INCLUDES_PATH."/lib/quad_db_lib_valid.php";

/* Checks if $string IS JSON OR NOT */
function isJson($string) {
    json_decode($string);
    return (json_last_error() == JSON_ERROR_NONE);
}

//Função que devolve as definições associadas aos CRUD & WorkFlow para um PERFIL
function go_no_go ($frm_name, &$wkf_error, &$seconds) {
    $executionStartTime = microtime(true);
    $wkf_error = array();
    $file_name = strtoupper( basename($frm_name,'.php') );
    # echo "<br>" . WORKFLOW_PATH.'/' . $file_name . '_' . @$_SESSION['id_perfil'] . '.json?'.date("Ymdhis");


    # adiciona-se a data ao fim do ficheiro com ? antes para forçar a leitura sempre do ficheiro do filesystem e não da cache do browser
    $defs = @file_get_contents(WORKFLOW_PATH.'/' . $file_name . '_' . @$_SESSION['id_perfil'] . '.json');

    //NO FILE > ERROR
    if ($defs === false) {
        $defs = "{}";
        array_push($wkf_error, $file_name);
    } else {
        $defs = str_replace( array("\r\n", "\n", "\r"), '', $defs);
    }

    //If content is not JSON identifies INTERFACE NAME === TO JSON FILENAME > ERROR
    if ( !isJson ($defs) ) {
        array_push($wkf_error, $file_name);
    }
    $executionEndTime = microtime(true);
    $seconds = $executionEndTime - $executionStartTime;

    return $defs;
}

#
# Retorna conteúdo de um Dominio
#
function list_dominioInLine ($dominio, $cd, $mode, &$msg) {
    global $db, $dateformat, $datetimeformat;
    $msg = '';
    $result = [];
    $cd_lang = decode_lang();

    $sql =  "SELECT a.RV_DOMAIN , a.RV_LOW_VALUE , NVL(b.DSP_TRAD, a.RV_MEANING) RV_MEANING ".
            ", NVL(b.DSR_TRAD, a.RV_ABBREVIATION) RV_ABBREVIATION ".
            "FROM CG_REF_CODES a LEFT JOIN CG_REF_CODES_TRADS b ".
            "ON b.RV_DOMAIN = a.RV_DOMAIN ".
            " AND a.RV_LOW_VALUE = b.RV_LOW_VALUE ".
            " AND b.CD_LINGUA = :cd_lang ".
            "WHERE a.RV_DOMAIN = :dominio";

    if ($mode == 'one') {
        $sql .= " AND a.RV_LOW_VALUE = :cd";
    }

    $sql .= " ORDER BY 2 ";

    try {
        //echo $sql.' DOMINIO:' . $dominio. ' LANG:' . $cd_lang . ' Mode:' . $mode;
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':dominio', $dominio);
        $stmt->bindParam(':cd_lang', $cd_lang);
        if ($mode == 'one') {
            $stmt->bindParam(':cd', $cd);
        }
        $stmt->execute();
        $res = '';
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            //$res .= "<option value=\&quot;" .$row['RV_LOW_VALUE']. "\&quot;>" . $row['RV_MEANING'] . "</option>";
            $res .= "<option value=" .$row['RV_LOW_VALUE']. ">" . $row['RV_MEANING'] . "</option>";
        }
        //$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //print_r($data);
        return $res;
    } catch (Exception $e) {
        $msg = "Error FETCHING ALL [$sql] on list_dominio: " . $e->getMessage();
    }
}

function lov_FF_dominio ($sql, $cd, $mode, &$msg) {
    global $db, $dateformat, $datetimeformat;
    $msg = '';
    $result = [];
    $cd_lang = decode_lang();

    if ($mode == 'one') {
        $sql .= " AND a.RV_LOW_VALUE = :cd";
    }

    try {
        $stmt = $db->prepare($sql);
//        $stmt->bindParam(':dominio', $dominio);
//        $stmt->bindParam(':cd_lang', $cd_lang);
//        if ($mode == 'one') {
//            $stmt->bindParam(':cd', $cd);
//        }
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return json_encode($data);
    } catch (Exception $e) {
        $msg = "Error FETCHING ALL [$sql] on lov_FF_dominio: " . $e->getMessage();
    }
}

function list_dominio ($dominio, $cd, $mode, &$msg) {

    global $db, $dateformat, $datetimeformat;
    $msg = '';
    $result = [];
    $cd_lang = decode_lang();

    $sql =  "SELECT a.RV_DOMAIN , a.RV_LOW_VALUE , NVL(b.DSP_TRAD, a.RV_MEANING) RV_MEANING ".
            ", NVL(b.DSR_TRAD, a.RV_ABBREVIATION) RV_ABBREVIATION ".
            "FROM CG_REF_CODES a LEFT JOIN CG_REF_CODES_TRADS b ".
            "ON b.RV_DOMAIN = a.RV_DOMAIN ".
            " AND a.RV_LOW_VALUE = b.RV_LOW_VALUE ".
            " AND b.CD_LINGUA = :cd_lang ".
            "WHERE a.RV_DOMAIN = :dominio";

    if ($mode == 'one') {
        $sql .= " AND a.RV_LOW_VALUE = :cd";
    }

    $sql .= " ORDER BY 2 ";
    try {
//echo $sql.' DOMINIO:' . $dominio. ' LANG:' . $cd_lang . ' Mode:' . $mode;
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':dominio', $dominio);
        $stmt->bindParam(':cd_lang', $cd_lang);
        if ($mode == 'one') {
            $stmt->bindParam(':cd', $cd);
        }
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //print_r($data);
        return json_encode($data);
    } catch (Exception $e) {
        $msg = "Error FETCHING ALL [$sql] on list_dominio: " . $e->getMessage();
    }
}

function list_dominio_order_number ($dominio, $cd, $mode) {

    global $db, $dateformat, $datetimeformat;
    $msg = '';
    $result = [];
    $cd_lang = decode_lang();

    $query = "SELECT a.RV_DOMAIN , a.RV_LOW_VALUE , NVL(b.DSP_TRAD, a.RV_MEANING) RV_MEANING ".
             ", NVL(b.DSR_TRAD, a.RV_ABBREVIATION) RV_ABBREVIATION ".
             "FROM CG_REF_CODES a, CG_REF_CODES_TRADS b ".
             "WHERE A.RV_DOMAIN = '$dominio' ".
             "  AND b.CD_LINGUA (+) = '$cd_lang' ".
             "  AND b.RV_DOMAIN (+) = a.RV_DOMAIN ".
             "  AND b.RV_LOW_VALUE (+) = a.RV_LOW_VALUE ";

    if ($mode == 'one') {
        $query .= " AND a.RV_LOW_VALUE = '$cd'";
    }

    $query .= " ORDER BY to_number(a.RV_LOW_VALUE) ";

    $res = oci_parse( $db, $query );
    $isQueryOk = oci_execute($res);

    if ($isQueryOk) {
        while (($row = oci_fetch_assoc($res)) != false) {
            array_push($result, $row);
        }
        oci_free_statement($res);
        return $result;
    }
    else {
        $msg = "Error FETCHING ALL [$query] on list_dominio";
    }
    //echo json_encode($results);
}

function list_dominio_except ($dominio, $cd, $mode, $excepto) {

    global $db, $dateformat, $datetimeformat;
    $msg = '';
    $result = [];
    $cd_lang = decode_lang();

    $query = "SELECT a.RV_DOMAIN , a.RV_LOW_VALUE , NVL(b.DSP_TRAD, a.RV_MEANING) RV_MEANING ".
             ", NVL(b.DSR_TRAD, a.RV_ABBREVIATION) RV_ABBREVIATION ".
             "FROM CG_REF_CODES a, CG_REF_CODES_TRADS b ".
             "WHERE A.RV_DOMAIN = '$dominio' ".
             "  AND b.CD_LINGUA (+) = '$cd_lang' ".
             "  AND b.RV_DOMAIN (+) = a.RV_DOMAIN ".
             "  AND b.RV_LOW_VALUE (+) = a.RV_LOW_VALUE ";

    if ($mode == 'one') {
        $query .= " AND a.RV_LOW_VALUE = '$cd'";
    }

    if ($excepto !== '') {
        $query .= " AND a.RV_LOW_VALUE NOT IN (".$excepto.") ";
    }

    $query .= " ORDER BY 3 ";
    //echo $query;
    $res = oci_parse( $db, $query );
    $isQueryOk = oci_execute($res);

    if ($isQueryOk) {
        while (($row = oci_fetch_assoc($res)) != false) {
            array_push($result, $row);
        }
        oci_free_statement($res);
        return $result;
    }
    else {
        $msg = "Error FETCHING ALL [$query] on list_dominio";
    }
    //echo json_encode($results);
}

function feriado($dt, $empresa, $estab){
    global $db;
    $msg = '';
    $result = [];
    $resultado = 'N';

    $query = "SELECT DSP_FERIADO, DT_FERIADO FROM DG_FERIADOS ".
             "WHERE CD_PAIS = DG_PAIS_EMPRESA(:EMPRESA) AND (DATE_FORMAT(DT_FERIADO,'%Y-%m-%d') = :DT AND TP_FERIADO = 'A') ";

    try {
        $stmt = $db->prepare($query);
        if ($empresa != '' &&  $estab != '') {
            $query .= " OR (DATE_FORMAT(DT_FERIADO,'%Y-%m-%d') = :DT AND CD_ESTAB = :ESTAB AND EMPRESA = :EMPRESA) ";
            $stmt->bindParam(':ESTAB', $estab, PDO::PARAM_STR);
            $stmt->bindParam(':EMPRESA', $empresa, PDO::PARAM_STR);
        }
        $stmt->bindParam(':DT', $cd, PDO::PARAM_STR);
        $stmt->execute();
    } catch (PDOException $ex) {
        $msg = "feriado#1 :" . $ex->getMessage();
    }

    if ($msg == '') {
        try {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $resultado = 'S';
            }
        } catch (Exception $ex) {
            $msg = "feriado#2 :" . $ex->getMessage();
        }
    }

    return $resultado;

}

/* função que implementa a filtragem de estabelecimentos de acordo com os perfis específicos do módulo de prémios por coeficientes */
function dk_filtro_estab($id_usr, $tp_perfil, $alias, &$msg) {
    global $db;
    $msg = '';
    $filtro_ = '';

    $sql = "SELECT A.EMPRESA, A.CD_ESTAB ".
           "FROM DK_PERFIS_ESTABELECIMENTO A, WEB_ADM_PERFIS B ".
           "WHERE A.ID_UTILIZADOR = :ID_UTILIZADOR_ ".
           "  AND B.id = A.ID_PERFIL ".
           "  AND B.TIPO_PERFIL  = :TIPO_PERFIL_ ".
           "  AND A.DT_FIM IS NULL ";

    try {
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':ID_UTILIZADOR_', $id_usr, PDO::PARAM_STR);
        $stmt->bindParam(':TIPO_PERFIL_', $tp_perfil, PDO::PARAM_STR);
        $stmt->execute();
    } catch (PDOException $ex) {
        $msg = "dk_filtro_estab#1 :" . $ex->getMessage();
    }

    if ($msg == '') {
        try {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($filtro_ == '') {
                    $filtro_ = " ($alias.EMPRESA = '".$row['EMPRESA']."' AND $alias.CD_ESTAB = '".$row['CD_ESTAB']."') ";
                } else {
                    $filtro_ .= " OR ($alias.EMPRESA = '".$row['EMPRESA']."' AND $alias.CD_ESTAB = '".$row['CD_ESTAB']."') ";
                }
            }
        } catch (Exception $ex) {
            $msg = "dk_filtro_estab#2 :" . $ex->getMessage();
        }
    }

    if ($filtro_ != '') {
        $filtro_ = " AND ($filtro_) ";
    }

    return $filtro_;
}

/* 
 * E-TICKETS -> WEB_ADM_UTILIZADORES 
 * $mode : [A] -> Active USERS, [] -> All USERS
 */
function list_users ($mode, &$msg) {
    global $db;
    $msg = '';
    $result = [];

    $sql =  "SELECT a.UTILIZADOR ID , a.UTILIZADOR, a.HELPDESK_SUPORTE ".
            "FROM WEB_ADM_UTILIZADORES a ";

    if ($mode == 'A') { //Just ACTIVE Users
        $sql .= " WHERE a.ESTADO = 'A'";
    }

    $sql .= " ORDER BY 2 ";

    try {
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($data);
    } catch (Exception $e) {
        $msg = "Error FETCHING ALL [$sql] on list_users: " . $e->getMessage();
    }
}




#
# Lista com as distintas empresas no QUAD-HCM
#
function list_empresa ($cd, $mode) {
    global $db;
    $msg = '';
    $result = [];

    $sql = "SELECT a.EMPRESA , a.EMPRESA DSP_EMPRESA ".
           "FROM DG_EMPRESAS a  ";

    if (strtoupper($mode) == 'ONE') {
        $sql .= " WHERE a.EMPRESA = :EMPRESA_ ";
    }

    $sql .= "ORDER BY NVL(CAST(a.NR_ORDEM AS CHAR), a.EMPRESA) ";
    try {
        $stmt = $db->prepare($sql);
        if (strtoupper($mode) == 'ONE') {
            $stmt->bindParam(':EMPRESA_', $cd, PDO::PARAM_STR);
        }
        $stmt->execute();
    } catch (PDOException $ex) {
        $msg = "list_empresa#1 :" . $ex->getMessage();
    }

    if ($msg == '') {
        try {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($result, $row);
            }
        } catch (Exception $ex) {
            $msg = "list_empresa#2 :" . $ex->getMessage();
        }
    }

    return $result;
}

#
# Lista com os distintos estabelecimento no QUAD-HCM
#
function list_estab($empresa_, $estab_, $mode_, &$msg) {

    global $db;
    $msg = '';
    $result = array();

    $sql = "SELECT * ".
           "FROM DG_ESTABELECIMENTOS ".
           "WHERE EMPRESA = :EMPRESA_ ".
           "  AND ACTIVO = 'S' ";
    if (strtoupper($mode_) == 'ONE'){
        $sql .= "  AND CD_ESTAB = :CD_ESTAB_ ";
    }

    $sql .= "ORDER BY CD_ESTAB ";

    try {
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
        if (strtoupper($mode_) == 'ONE'){
            $stmt->bindParam(':CD_ESTAB_', $estab_, PDO::PARAM_STR);
        }
        $stmt->execute();
    } catch (Exception $ex) {
        $msg = "list_estab#1 :" . $ex->getMessage();
    }

    if ($msg == '') {
        try {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($result, $row);
            }
        } catch (Exception $ex) {
            $msg = "list_estab#2 :" . $ex->getMessage();
        }
    }

    return $result;

}

#
# Lista os estabelecimentos associados aos colaboradores associados a perfil ativo
#
function list_estabs_colabs($empresa_, $estab_, $mode_, &$msg) {

    global $db;
    $msg = '';
    $result = array();

    $ponto = 'N';

    $sql =  "SELECT DISTINCT E.EMPRESA, E.CD_ESTAB, S.DSP_ESTAB  ".
            "FROM RH_ID_EMPRESAS E, DG_ESTABELECIMENTOS S ".
            "WHERE S.EMPRESA = E.EMPRESA ".
            "  AND S.CD_ESTAB = E.CD_ESTAB ".
            "  AND E.CD_SITUACAO IN ".
            "       (SELECT CD_SITUACAO ".
            "        FROM RH_DEF_SITUACOES ".
            "        WHERE ACTIVO = 'S' ".
            "          AND (MARCACAO_FERIAS = 'S' OR TRATAMENTO_PONTO = 'S' OR AUSENCIA_PROGRAMADA = 'S' OR ABSENTISMO = 'S' OR TRABALHO_SUPLEMENTAR = 'S') ".
            "    ) ";

    if ($empresa_ != '') {
        $sql .= "  AND  E.EMPRESA = :EMPRESA_ ";
    }

    if (strtoupper($mode_) == 'ONE') {
        $sql .= "  AND  E.CD_ESTAB = = :CD_ESTAB ";
    }

    # condicionamento ao perfil
    if (@$_SESSION['perfil'] == 'A') { # colaborador
        # apenas o próprio
        $sql .= " AND E.RHID = ".@$_SESSION['rhid']." ";
    }
    elseif (@$_SESSION['perfil'] == 'B') { # gestor administrativo
        $sql .= " AND (E.RHID_GESTOR_ADM = '" . @$_SESSION['rhid'] . "' OR E.RHID = " . @$_SESSION['rhid'] . ") ";
    }
    elseif (@$_SESSION['perfil'] == 'C') { # supervisor
        $sql .= " AND (E.RHID_SUPERVISOR = '".@$_SESSION['rhid']."' OR E.RHID = ".@$_SESSION['rhid'].") ";
    }
    elseif (@$_SESSION['perfil'] == 'D') { # director
        $sql .= " AND (E.RHID_DIRECTOR = '".@$_SESSION['rhid']."' OR E.RHID = ".@$_SESSION['rhid'].") ";
    }
    elseif (@$_SESSION['perfil'] == 'H' || # Controller
            @$_SESSION['perfil'] == 'I' || # Diretor Regional
            @$_SESSION['perfil'] == 'J') { # CFO

        $sql_filtro = dk_filtro_estab(@$_SESSION['id'], @$_SESSION['perfil'], 'E', $msg);

        if ($sql_filtro != '') {
            $sql .= $sql_filtro;
        }

    }
    elseif (@$_SESSION['perfil'] == 'F'  || # dep.recursos humanos
            @$_SESSION['perfil'] == 'E'  || # Gestor - outsourcing
            @$_SESSION['perfil'] == 'W'  || # Consulta
            @$_SESSION['perfil'] == 'Y'  || # Preparador Escalas
            @$_SESSION['perfil'] == 'Z') {   # Administrador
            null;
    }

    $sql .= "ORDER BY 2 ";
    try {
        $stmt = $db->prepare($sql);
        if ($empresa_ != ''){
            $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
        }
        if (strtoupper($mode_) == 'ONE'){
            $stmt->bindParam(':CD_ESTAB_', $estab_, PDO::PARAM_STR);
        }
        $stmt->execute();
    } catch (Exception $ex) {
        $msg = "list_setores_colabs#1 :" . $ex->getMessage();
    }

    if ($msg == '') {
        try {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($result, $row);
            }
        } catch (Exception $ex) {
            $msg = "list_setores_colabs#2 :" . $ex->getMessage();
        }
    }

    return $result;

}

#
# Lista os setores no QUAD-HCM
#
function list_setores($empresa_, $estab_, $setor_, $mode_, &$msg) {

    global $db;
    $msg = '';
    $result = array();

    $estab_ = str_replace('"',"'",$estab_);

    $p = explode("@",$setor_);
    $cd_setor_ = $p[0];
    $dt_setor_ = $p[1];

    $sql = "SELECT a.*,b.DSP_ESTAB ".
           "FROM DG_SETORES a, DG_ESTABELECIMENTOS b ".
           "WHERE a.EMPRESA = :EMPRESA_ ".
           "  AND b.EMPRESA = a.EMPRESA ".
           "  AND b.CD_ESTAB = a.CD_ESTAB ".
           "  AND DT_FIM IS NULL ";

    if ($estab_ != '') {
        $sql .= "  AND a.CD_ESTAB IN ($estab_) ";
    }

    if (strtoupper($mode_) == 'ONE'){
        $sql .= "  AND ID_SETOR = :ID_SETOR_ ".
                "  AND DT_INI = :DT_INI_ ";
    }

    $sql .= "ORDER BY CD_ESTAB, ID_SETOR ";

    try {
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
        if (strtoupper($mode_) == 'ONE'){
            $stmt->bindParam(':ID_SETOR_', $cd_setor_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_', $dt_setor_, PDO::PARAM_STR);
        }
        $stmt->execute();
    } catch (Exception $ex) {
        $msg = "list_setores#1 :" . $ex->getMessage();
    }

    if ($msg == '') {
        try {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($result, $row);
            }
        } catch (Exception $ex) {
            $msg = "list_setores#2 :" . $ex->getMessage();
        }
    }

    return $result;

}

#
# Lista os setores associados aos colaboradores associados a perfil ativo
#
function list_setores_colabs($empresa_, $estab_, $setor_, $mode_, &$msg) {

    global $db;
    $msg = '';
    $result = array();

    $ponto = 'N';

    $p = explode("@",$setor_);
    $cd_setor_ = isset($p[0]) ? $p[0] : '';
    $dt_setor_ = isset($p[1]) ? $p[1] : '';

    $sql =  "SELECT DISTINCT S.EMPRESA, S.ID_SETOR, P.DT_INI_SETOR, S.DSP_SETOR  ".
            "FROM RH_ID_EMPRESAS E, RH_ID_SETORES P, DG_SETORES S ".
            "WHERE P.EMPRESA = E.EMPRESA ".
            "  AND P.RHID = E.RHID ".
            "  AND P.DT_ADMISSAO = E.DT_ADMISSAO ".
            "  AND P.CD_ESTAB = E.CD_ESTAB ".
            "  AND S.EMPRESA = P.EMPRESA ".
            "  AND S.CD_ESTAB = P.CD_ESTAB ".
            "  AND S.ID_SETOR = P.ID_SETOR ".
            "  AND S.DT_INI = P.DT_INI_SETOR ".
            "  AND DATE_FORMAT(SYSDATE(),'%Y-%m-%d') >= DATE_FORMAT(P.DT_INI,'%Y-%m-%d') ".
            "  AND DATE_FORMAT(SYSDATE(),'%Y-%m-%d') <= DATE_FORMAT(IFNULL(P.DT_FIM,SYSDATE()),'%Y-%m-%d') ".
            "  AND E.CD_SITUACAO IN ".
            "       (SELECT CD_SITUACAO ".
            "        FROM RH_DEF_SITUACOES ".
            "        WHERE ACTIVO = 'S' ".
            "          AND (MARCACAO_FERIAS = 'S' OR TRATAMENTO_PONTO = 'S' OR AUSENCIA_PROGRAMADA = 'S' OR ABSENTISMO = 'S' OR TRABALHO_SUPLEMENTAR = 'S') ".
            "    ) ";

    if ($empresa_ != '') {
        $sql .= "  AND  E.EMPRESA = :EMPRESA_ ";
    }

    if ($estab_ != '') {
        $sql .= "  AND  E.CD_ESTAB = :CD_ESTAB_ ";
    }

    if (strtoupper($mode_) == 'ONE') {
        $sql .= "  AND  E.ID_SETOR = = :ID_SETOR_ ".
                "  AND  E.DT_INI_SETOR = = :DT_INI_SETOR_ ";
    }

    # condicionamento ao perfil
    if (@$_SESSION['perfil'] == 'A') { # colaborador
        # apenas o próprio
        $sql .= " AND E.RHID = ".@$_SESSION['rhid']." ";
    }
    elseif (@$_SESSION['perfil'] == 'B') { # gestor administrativo
        $sql .= " AND (E.RHID_GESTOR_ADM = " . @$_SESSION['rhid'] . " OR E.RHID = " . @$_SESSION['rhid'] . ") ";
    }
    elseif (@$_SESSION['perfil'] == 'C') { # supervisor
        $sql .= " AND (E.RHID_SUPERVISOR = ".@$_SESSION['rhid']." OR E.RHID = ".@$_SESSION['rhid'].") ";
    }
    elseif (@$_SESSION['perfil'] == 'D') { # director
        $sql .= " AND (E.RHID_DIRECTOR = ".@$_SESSION['rhid']." OR E.RHID = ".@$_SESSION['rhid'].") ";
    }
    elseif (@$_SESSION['perfil'] == 'F'  || # dep.recursos humanos
            @$_SESSION['perfil'] == 'E'  || # Gestor - outsourcing
            @$_SESSION['perfil'] == 'W'  || # Consulta
            @$_SESSION['perfil'] == 'Y'  || # Preparador Escalas
            @$_SESSION['perfil'] == 'Z') {   # Administrador
            null;
    }

    $sql .= "ORDER BY 4 ";

    try {
        $stmt = $db->prepare($sql);
        if ($empresa_ != ''){
            $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
        }
        if ($estab_ != ''){
            $stmt->bindParam(':CD_ESTAB_', $estab_, PDO::PARAM_STR);
        }
        if (strtoupper($mode_) == 'ONE'){
            $stmt->bindParam(':ID_SETOR_', $cd_setor_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_SETOR_', $dt_setor_, PDO::PARAM_STR);
        }
        $stmt->execute();
    } catch (Exception $ex) {
        $msg = "list_setores_colabs#1 :" . $ex->getMessage();
    }

    if ($msg == '') {
        try {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($result, $row);
            }
        } catch (Exception $ex) {
            $msg = "list_setores_colabs#2 :" . $ex->getMessage();
        }
    }

    return $result;

}

#
# Lista com os distintos anos no QUAD-HCM
#
function list_anos($empresa_, $ano_, $mode_, &$msg) {

    global $db;
    $msg = '';
    $result = array();

    $sql = "SELECT MIN(a.ANO) MIN_ANO,MAX(a.ANO) MAX_ANO ".
           "FROM DG_ANOS a ".
           "WHERE EMPRESA = :EMPRESA_ ";
    if (strtoupper($mode_) == 'ONE'){
        $sql .= "  AND ANO = :ANO_ ";
    }

    $sql .= "ORDER BY ANO DESC ";

    try {
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
        if (strtoupper($mode_) == 'ONE'){
            $stmt->bindParam(':ANO_', $ano_, PDO::PARAM_STR);
        }
        $stmt->execute();
    } catch (Exception $ex) {
        $msg = "list_anos#1 :" . $ex->getMessage();
    }

    if ($msg == '') {
        try {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $ano_min = $row['MIN_ANO'];
                $ano_max = $row['MAX_ANO'];
                if ($ano_max < date("Y")) {
                    $ano_max = date("Y");
                }
                if ($ano_min != '' && $ano_max != '' && $ano_max >= $ano_min) {
                    for ($i = $ano_max; $i >= $ano_min; $i--) {
                        $r["ANO"] = $i;
                        array_push($result, $r);
                    }
                }
            }
        } catch (Exception $ex) {
            $msg = "list_anos#2 :" . $ex->getMessage();
        }
    }

    return $result;

}

#
# Lista os colaboradores ativos numa empresa no QUAD-HCM
#
function list_colabs_ativos($empresa_, $rhid_, $mode_, &$msg) {

    global $db;
    $msg = '';
    $result = array();

    $sql = "SELECT a.* ".
           "FROM QUAD_PEOPLE a ".
           "WHERE a.EMPRESA = :EMPRESA_ ".
           "  AND a.ATIVO = 'S' ";
    if (strtoupper($mode_) == 'ONE'){
        $sql .= "  AND a.RHID = :RHID_ ";
    }
    $sql .= "ORDER BY a.RHID ASC ";

    try {
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
        if (strtoupper($mode_) == 'ONE'){
            $stmt->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
        }
        $stmt->execute();
    } catch (Exception $ex) {
        $msg = "list_colabs_ativos#1 :" . $ex->getMessage();
    }

    if ($msg == '') {
        try {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($result, $row);
            }
        } catch (Exception $ex) {
            $msg = "list_colabs_ativos#2 :" . $ex->getMessage();
        }
    }
    return $result;

}

#
# Lista os colaboradores ativos associados a um perfil numa empresa no QUAD-HCM
#
function list_colabs_perfil_ativos($empresa_, $rhid_, $mode_, &$msg) {

    global $db;
    $msg = '';
    $result = array();

    $sql = "SELECT a.EMPRESA,a.RHID,a.DT_ADMISSAO,a.NOME,a.NOME_REDZ ".
           "FROM QUAD_PEOPLE a ".
           "WHERE a.EMPRESA = :EMPRESA_ ".
           "  AND a.ATIVO = 'S' ";

    # condicionamento ao perfil
    if (@$_SESSION['perfil'] == 'A') { # colaborador
        # apenas o próprio
        $sql .= " AND a.RHID = ".@$_SESSION['rhid']." ";
    }
    elseif (@$_SESSION['perfil'] == 'B') { # gestor administrativo
        $sql .= " AND (a.RHID_GESTOR_ADM = " . @$_SESSION['rhid'] . " OR a.RHID = " . @$_SESSION['rhid'] . ") ";
    }
    elseif (@$_SESSION['perfil'] == 'C') { # supervisor
        $sql .= " AND (a.RHID_SUPERVISOR = ".@$_SESSION['rhid']." OR a.RHID = ".@$_SESSION['rhid'].") ";
    }
    elseif (@$_SESSION['perfil'] == 'D') { # director
        $sql .= " AND (a.RHID_DIRECTOR = ".@$_SESSION['rhid']." OR a.RHID = ".@$_SESSION['rhid'].") ";
    }
    elseif (@$_SESSION['perfil'] == 'F'  || # dep.recursos humanos
            @$_SESSION['perfil'] == 'E'  || # Gestor - outsourcing
            @$_SESSION['perfil'] == 'W'  || # Consulta
            @$_SESSION['perfil'] == 'Y'  || # Preparador Escalas
            @$_SESSION['perfil'] == 'Z') {   # Administrador
            null;
    }

    if (strtoupper($mode_) == 'ONE'){
        $sql .= "  AND a.RHID = :RHID_ ";
    }
    $sql .= "ORDER BY a.RHID ASC ";

    try {
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
        if (strtoupper($mode_) == 'ONE'){
            $stmt->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
        }
        $stmt->execute();
    } catch (Exception $ex) {
        $msg = "list_colabs_ativos#1 :" . $ex->getMessage();
    }

    if ($msg == '') {
        try {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($result, $row);
            }
        } catch (Exception $ex) {
            $msg = "list_colabs_ativos#2 :" . $ex->getMessage();
        }
    }
    return $result;

}

#
# Lista com as distintas direções no QUAD-HCM
#
function list_direcoes($empresa_, $dir_, $mode_, &$msg) {

    global $db;
    $msg = '';
    $result = array();

    $p = explode("@",$dir_);
    $cd_dir = $p[0];
    $dt_dir = $p[1];

    $sql = "SELECT * ".
           "FROM DG_DIRECOES ".
           "WHERE EMPRESA = :EMPRESA_ ".
           "  AND DT_FIM IS NULL ";
    if (strtoupper($mode_) == 'ONE'){
        $sql .= "  AND CD_DIRECAO = :CD_DIRECAO_ ";
                "  AND DT_INI_DIRECAO = :DT_INI_DIRECAO_ ";
    }

    $sql .= "ORDER BY CD_DIRECAO ";

    try {
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
        if (strtoupper($mode_) == 'ONE'){
            $stmt->bindParam(':CD_DIRECAO_', $cd_dir, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_DIRECAO_', $dt_dir, PDO::PARAM_STR);
        }
        $stmt->execute();
    } catch (Exception $ex) {
        $msg = "list_direcoes#1 :" . $ex->getMessage();
    }

    if ($msg == '') {
        try {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($result, $row);
            }
        } catch (Exception $ex) {
            $msg = "list_direcoes#2 :" . $ex->getMessage();
        }
    }

    return $result;

}

#
# Lista com os distintos departamentos de uma direção no QUAD-HCM
#
function list_depts($empresa_, $dir_, $dept_, $mode_, &$msg) {

    global $db;
    $msg = '';
    $result = array();

    # a variável $dir_ pode ter uma lista de direções no formato "cd_dir1@dt_dir1,cd_dir2@dt_dir2" exemplo: "040@1900-01-01,070@1900-01-01"
    $p = explode(",",str_replace('"',"'",$dir_));
    $cd_dir = '';
    for ($i=0; $i<count($p); $i++) {
        $x = explode("@",$p[$i]);
        if ($cd_dir == '') {
            $cd_dir = "'".$x[0]."'";
        } else {
            $cd_dir .= ","."'".$x[0]."'";
        }

    };

    $p = explode("@",$dept_);
    $cd_dept = $p[0];
    $dt_dept = $p[1];

    $sql = "SELECT a.*,b.DSP_DIRECAO ".
           "FROM DG_DEPARTAMENTOS a, DG_DIRECOES b ".
           "WHERE a.EMPRESA = :EMPRESA_ ".
           "  AND a.DT_FIM IS NULL ".
            " AND b.EMPRESA = a.EMPRESA ".
            " AND b.CD_DIRECAO = a.CD_DIRECAO ".
            " AND b.DT_INI_DIRECAO = a.DT_INI_DIRECAO ";

    if ($cd_dir != '') {
        $sql .= "  AND a.CD_DIRECAO IN ($cd_dir) ";
    }

    if (strtoupper($mode_) == 'ONE'){
        $sql .= "  AND a.CD_DEPT = :CD_DEPT_ ".
                "  AND a.DT_INI_DEPT = :DT_INI_DEPT_ ";
    }

    $sql .= "ORDER BY a.CD_DIRECAO, a.CD_DEPT ";

    try {
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
        if (strtoupper($mode_) == 'ONE'){
            $stmt->bindParam(':CD_DEPT_', $cd_dept, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_DEPT_', $dt_dept, PDO::PARAM_STR);
        }
        $stmt->execute();
    } catch (Exception $ex) {
        $msg = "list_depts#1 :" . $ex->getMessage();
    }

    if ($msg == '') {
        try {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($result, $row);
            }
        } catch (Exception $ex) {
            $msg = "list_depts#2 :" . $ex->getMessage();
        }
    }

    return $result;

}


#
# Lista com as distintas estruturas no QUAD-HCM
#
function list_estruturas($empresa_, $estrut_, $mode_, &$msg) {

    global $db;
    
    $msg = '';
    $result = array();

    $p = explode("@",$estrut_);
    $cd_estrut = $p[0];
    $dt_estrut = $p[1];

    $sql = "SELECT * ".
           "FROM DG_ESTRUTURAS ".
           "WHERE EMPRESA = :EMPRESA_ ".
           "  AND DT_FIM_ESTRUTURA IS NULL ";
    if (strtoupper($mode_) == 'ONE'){
        $sql .= "  AND CD_ESTRUTURA = :CD_ESTRUTURA_ ";
                "  AND DT_INI_ESTRUTURA = :DT_INI_ESTRUTURA_ ";
    }

    $sql .= "ORDER BY CD_ESTRUTURA ";

    try {
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
        if (strtoupper($mode_) == 'ONE'){
            $stmt->bindParam(':CD_ESTRUTURA_', $cd_estrut, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_ESTRUTURA_', $dt_estrut, PDO::PARAM_STR);
        }
        $stmt->execute();
    } catch (Exception $ex) {
        $msg = "list_estruturas#1 :" . $ex->getMessage();
    }

    if ($msg == '') {
        try {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($result, $row);
            }
        } catch (Exception $ex) {
            $msg = "list_estruturas#2 :" . $ex->getMessage();
        }
    }

    return $result;

}

#
# Lista com os distintos grupos funcionais no QUAD-HCM
#
function list_grupos_funcionais($empresa_, $grp_func_, $mode_, &$msg) {

    global $db;
    
    $msg = '';
    $result = array();

    $p = explode("@",$grp_func_);
    $cd_grp_func = $p[0];
    $dt_grp_func = $p[1];

    $sql = "SELECT * ".
           "FROM RH_DEF_GRUPOS_FUNCIONAIS ".
           "WHERE EMPRESA = :EMPRESA_ ".
           "  AND DT_FIM_GRP_FUNC IS NULL ";
    if (strtoupper($mode_) == 'ONE'){
        $sql .= "  AND ID_GRP_FUNC = :ID_GRP_FUNC_ ";
                "  AND DT_INI_GRP_FUNC = :DT_INI_GRP_FUNC_ ";
    }

    $sql .= "ORDER BY ID_GRP_FUNC ";

    try {
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
        if (strtoupper($mode_) == 'ONE'){
            $stmt->bindParam(':ID_GRP_FUNC_', $cd_grp_func, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_GRP_FUNC_', $dt_grp_func, PDO::PARAM_STR);
        }
        $stmt->execute();
    } catch (Exception $ex) {
        $msg = "list_grupos_funcionais#1 :" . $ex->getMessage();
    }

    if ($msg == '') {
        try {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($result, $row);
            }
        } catch (Exception $ex) {
            $msg = "list_grupos_funcionais#2 :" . $ex->getMessage();
        }
    }

    return $result;

}

#
# Lista com as distintas funções no QUAD-HCM
#
function list_funcoes($empresa_, $func_, $mode_, &$msg) {

    global $db;
    
    $msg = '';
    $result = array();

    $p = explode("@",$func_);
    $id_func = $p[0];
    $dt_func = $p[1];

    $sql = "SELECT * ".
           "FROM RH_DEF_FUNCOES ".
           "WHERE EMPRESA = :EMPRESA_ ".
           "  AND TP_REGISTO = 'A' ".
           "  AND DT_FIM_FUNCAO IS NULL ";
    if (strtoupper($mode_) == 'ONE'){
        $sql .= "  AND ID_FUNCAO = :ID_FUNCAO_ ";
                "  AND DT_INI_FUNCAO = :DT_INI_FUNCAO_ ";
    }

    $sql .= "ORDER BY ID_FUNCAO ";

    try {
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
        if (strtoupper($mode_) == 'ONE'){
            $stmt->bindParam(':ID_FUNCAO_', $id_func, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_FUNCAO_', $dt_func, PDO::PARAM_STR);
        }
        $stmt->execute();
    } catch (Exception $ex) {
        $msg = "list_funcoes#1 :" . $ex->getMessage();
    }

    if ($msg == '') {
        try {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($result, $row);
            }
        } catch (Exception $ex) {
            $msg = "list_funcoes#2 :" . $ex->getMessage();
        }
    }

    return $result;

}

#
# Lista com os distintos vínculos contratuais no QUAD-HCM
#
function list_vinculos_contratuais($vinc_, $mode_, &$msg) {

    global $db;
    
    $msg = '';
    $result = array();

    $sql = "SELECT * ".
           "FROM RH_DEF_VINCULOS_CONTRATUAIS ".
           "WHERE 1 = 1 ";
    if (strtoupper($mode_) == 'ONE'){
        $sql .= "  AND CD_VINCULO = :CD_VINCULO_ ";
    }

    $sql .= "ORDER BY CD_VINCULO ";

    try {
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
        if (strtoupper($mode_) == 'ONE'){
            $stmt->bindParam(':CD_VINCULO_', $vinc_, PDO::PARAM_STR);
        }
        $stmt->execute();
    } catch (Exception $ex) {
        $msg = "list_vinculos_contratuais#1 :" . $ex->getMessage();
    }

    if ($msg == '') {
        try {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($result, $row);
            }
        } catch (Exception $ex) {
            $msg = "list_vinculos_contratuais#2 :" . $ex->getMessage();
        }
    }

    return $result;

}

#
# Lista com as distintas situações no QUAD-HCM
#
function list_situacoes($sit_, $mode_, &$msg) {

    global $db;
    
    $msg = '';
    $result = array();

    $sql = "SELECT * ".
           "FROM RH_DEF_SITUACOES ".
           "WHERE 1 = 1 ";
    if (strtoupper($mode_) == 'ONE'){
        $sql .= "  AND CD_SITUACAO = :CD_SITUACAO_ ";
    }

    $sql .= "ORDER BY CD_SITUACAO ";

    try {
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
        if (strtoupper($mode_) == 'ONE'){
            $stmt->bindParam(':CD_SITUACAO_', $sit_, PDO::PARAM_STR);
        }
        $stmt->execute();
    } catch (Exception $ex) {
        $msg = "list_situacoes#1 :" . $ex->getMessage();
    }

    if ($msg == '') {
        try {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($result, $row);
            }
        } catch (Exception $ex) {
            $msg = "list_situacoes#2 :" . $ex->getMessage();
        }
    }

    return $result;

}

#
# Lista com os Horários Diários no  QUAD-HCM
#
function list_horarios_diarios(&$msg) {

    global $db;
    
    $msg = '';
    $result = array();

    $sql = "SELECT CONCAT(CONCAT(CD_HOR_DIA, '-'), DSR_HOR_DIA) DSP, CD_HOR_DIA VAL FROM RH_DEF_HORARIO_DIAS WHERE ACTIVO = 'S'";
    $sql .= " ORDER BY DSR_HOR_DIA, CD_HOR_DIA";
//echo $sql;
    try {
        $stmt = $db->prepare($sql);
        $stmt->execute();
    } catch (Exception $ex) {
        $msg = "list_horarios_diarios#1 :" . $ex->getMessage();
    }

    if ($msg == '') {
        try {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($result, $row);
            }
        } catch (Exception $ex) {
            $msg = "list_horarios_diarios#2 :" . $ex->getMessage();
        }
    }

    return $result;
}

##
## INFRA-ESTRUTURA
##

#
# Configurações da email da plataforma
#
function get_mail_configurations(&$msg) {
    global $db;
    $msg = '';
    $resultado = array();
    try {
        $stmt = $db->prepare("SELECT w.MAIL_SERVER, w.MAIL_USR, w.MAIL_PWD, w.MAIL_PORT, w.EMAIL_FROM. w.MAIL_AUTH ".
                             "FROM WEB_ADM_CONFIGURACOES w ");
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $ex) {
        $msg = "get_mail_configurations#1 :" . $ex->getMessage();
    }

    return $resultado;
}

#
# Tratamento de MÓDULOS na plataforma
#

#
# função que devolve 1 ou 0 consoante um módulo esteja ou não ativo no portal
#
function estado_modulo($id_modulo, &$msg) {

    global $db;

    $msg = '';
    $estado = 0;
    try {
        $stmt = $db->prepare(   "SELECT w.ESTADO ".
                                "FROM WEB_ADM_MODULOS_PORTAL w ".
                                "WHERE w.ID_MODULO = :id_ ");
        $stmt->bindParam(':id_', $id_modulo, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row['ESTADO'] == 'A') {
            $estado = 1;
        }
    } catch (Exception $ex) {
        $msg = "le_estado_modulo#1 :" . $ex->getMessage();
    }

    # 1 -Ativo ou 0 - Inativo
    return $estado;
}


##
## Tratamento de PERFIS e WORKFLOWS na plataforma
##

#
# função que descodifica um perfil
function quad_dsp_perfil($cd, $tp, &$msg) {

    global $db;
    
    $msg = '';
    $perfil = '';
    $lbl_gestor_adm = '';
    $lbl_supervisor = '';
    $lbl_director = '';

    //echo @$_SESSION['rhid'] . " " . @$_SESSION['utilizador'];

    try {
        $query = "SELECT c.label_gestor_adm, c.label_supervisor, c.label_director ".
                 "FROM WEB_ADM_CONFIGURACOES c ".
                 "WHERE 1 = 1 ";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $lbl_gestor_adm = $row['label_gestor_adm'];
        $lbl_supervisor = $row['label_supervisor'];
        $lbl_director = $row['label_director'];
    } catch (Exception $ex) {
        $msg = "erro#1 :" . $ex->getMessage();
    }

    try {
        $query = "SELECT p.dsp_perfil ds_perfil, p.tipo_perfil ".
                 "FROM WEB_ADM_PERFIS p ".
                 "WHERE 1 = 1 ";

        if ($tp != '') {
             $query .= " AND p.tipo_perfil = :TP_ ";
        }

        if ($cd != '') {
             $query .= " AND p.id = :CD_ ";
        }

        $stmt = $db->prepare($query);
        if ($tp != '') {
            $stmt->bindParam(':TP_', $tp, PDO::PARAM_STR);
        }
        if ($cd != '') {
            $stmt->bindParam(':CD_', $cd, PDO::PARAM_STR);
        }

        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $lbl = '';
            if ($row['tipo_perfil'] == 'B') { # gestor adm
                $lbl = $lbl_gestor_adm;
            } elseif ($row['tipo_perfil'] == 'C') { # supervisor
                $lbl = $lbl_supervisor;
            } elseif ($row['tipo_perfil'] == 'D') { # director
                $lbl = $lbl_director;
            }

            if ($lbl != '') {
                $perfil = $lbl;
            } else {
                $perfil = $row['ds_perfil'];
            }
            break;
        }
    } catch (Exception $ex) {
        $msg = "erro#2 :" . $ex->getMessage();
    }

    return $perfil;
}

#
# função que devolve os perfis disponíveis para um colaborador
function quad_lista_perfis_utilizador($usr_id, &$msg) {

    global $db, $_user;
    

    $msg = '';

      if ($usr_id != '') {
        try {
            $query = "SELECT p.dsp_perfil ds_perfil, p.tipo_perfil, w.id_perfil ".
                     "FROM WEB_ADM_PERFIS_UTILIZADORES w, WEB_ADM_PERFIS p ".
                     "WHERE w.id_utilizador = :USR_ID_ ".
                     "  AND p.id = w.id_perfil ".
                     "  AND w.estado = 'A' ".
                     "  AND p.estado = 'A' ".
                     "  AND p.tipo_perfil NOT IN ('W','Y','G') ".
                     "ORDER BY w.id_perfil ";

           $stmt = $db->prepare($query);
           $stmt->bindParam(':USR_ID_', $usr_id, PDO::PARAM_STR);
           $stmt->execute();
           while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                 $lbl = '';
                 if ($row['tipo_perfil'] == 'B' ||  # gestor adm
                     $row['tipo_perfil'] == 'C' ||  # supervisor
                     $row['tipo_perfil'] == 'D' ) { # director
                         $lbl = quad_dsp_perfil('',$row['tipo_perfil'],$msg);
                 }
                if ($lbl != '') {
                    $perfil = $lbl;
                } else {
                    $perfil =  $row['ds_perfil'];
                }
                if ($_user->get_current_profile()->TIPO_PERFIL == '') {
                   $_SESSION['perfil'] = $row['tipo_perfil'];
                   echo ' <li class="active" data-action="profile_change" data-profile="'.$row['tipo_perfil'].'">'.
                        '   <a href="##" value="'.$row['tipo_perfil'].'">'. $perfil .'</a>'.
                        ' </li>';
                }
                elseif ($_user->get_current_profile()->TIPO_PERFIL == $row['tipo_perfil']) {
                   echo ' <li class="active" data-action="profile_change" data-profile="'.$row['tipo_perfil'].'">'.
                        '   <a href="##" value="'.$row['tipo_perfil'].'">'. $perfil .'</a>'.
                        ' </li>';
                }
                else {
                   echo ' <li data-action="profile_change" data-profile="'.$row['tipo_perfil'].'">'.
                        '   <a href="##" value="'.$row['tipo_perfil'].'">'. $perfil .'</a>'.
                        ' </li>';
                }
           }

        } catch (Exception $ex) {
            $msg = "perfis_utilizador#1 :" . $ex->getMessage();
        }
      }
}

#
# função que devolve o id ou o tipo do perfil consoantes indiquemos o tipo ou id do perfil
function get_id_tp_perfil(&$tp_perfil, &$id_perfil, &$nr_ordem_wkf, &$msg) {
    global $db;
    
    $msg = '';
    $nr_ordem_wkf = '';

    if (($tp_perfil != '' && $id_perfil == '') ||
        ($tp_perfil == '' && $id_perfil != '')) {

        $sql = "SELECT A.ID, A.TIPO_PERFIL, A.NR_ORDEM ".
               "FROM WEB_ADM_PERFIS A ".
               "WHERE 1 = 1 ";

        if ($tp_perfil == '' && $id_perfil != '') {
            $sql .= "AND A.ID = :ID_PERFIL_ ";
        } elseif ($tp_perfil != '' && $id_perfil == '') {
            $sql .= "AND A.TIPO_PERFIL = :TIPO_PERFIL_ ";
        } else {
            $sql .= " AND 1 = 2 ";
        }

        try {
            $stmt = $db->prepare($sql);

            if ($tp_perfil == '' && $id_perfil != '') {
                $stmt->bindParam(':ID_PERFIL_', $id_perfil, PDO::PARAM_STR);
            } elseif ($tp_perfil != '' && $id_perfil == '') {
                $stmt->bindParam(':TIPO_PERFIL_', $tp_perfil, PDO::PARAM_STR);
            }
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($tp_perfil == '' && $id_perfil != '') {
                    $tp_perfil = $row['TIPO_PERFIL'];
                } elseif ($tp_perfil != '' && $id_perfil == '') {
                    $id_perfil = $row['ID'];
                }
                $nr_ordem_wkf = $row['NR_ORDEM'];
            }

        } catch (Exception $ex) {
            $msg = "get_id_tp_perfil#1 :" . $ex->getMessage();
        }
    }
}

#
# Identifica se o módulo indicado é um módulo "pai"
function modulo_pai($modulo_, &$msg) {
    global $db;
    
    $msg = '';
    $result = 'N';

    $sql = "SELECT COUNT(*) CNT   ".
           "FROM WEB_ADM_MODULOS_PORTAL M ".
           "WHERE ID_PAI IS NOT NULL ".
           "  AND ID_PAI = :ID_MODULO_PAI_ ";

    try {
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':ID_MODULO_PAI_', $modulo_, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row['CNT'] > 0) {
            $result = 'S';
        }
    } catch (Exception $ex) {
        $msg = "list_adm_perfis#1 :" . $ex->getMessage();
    }

    return $result;
}

#
# Lista com os distintos perfis definidos na plataforma
function list_adm_modulos($ativos_, $wkf_, &$msg) {

    global $db;
    
    $msg = '';
    $result = array();

    $sql = "SELECT P.ID_MODULO, COALESCE(L.DSP_TRAD, P.DSP_MODULO) DSP_MODULO, P.ESTADO, P.WORKFLOW, ".
           "       COALESCE(L.DSR_TRAD, P.DSR_MODULO) DSR_MODULO, P.ESTADO, P.WORKFLOW, P.ID_PAI, P.MANUTENCAO, P.RGPD  ".
           "FROM WEB_ADM_MODULOS_PORTAL P ".
           "LEFT JOIN WEB_ADM_MOD_PORTAL_TRADS L ON L.ID_MODULO = P.ID_MODULO ".
           " AND L.CD_LINGUA = DG_LANG_CODE('".@$_SESSION['lang']."') ".
           "WHERE 1 = 1 ";

    if ($ativos_ == 'S') { // só perfis ativos
        $sql .= " AND P.ESTADO = 'A' ";
    }

    if ($wkf_ == 'S') { // só com workflow
        $sql .= " AND P.WORKFLOW = 'S' ";
    }

    $sql .= "ORDER BY COALESCE(P.ID_PAI,P.ID_MODULO), P.NR_ORDEM, P.ID_MODULO ";

    try {
        $stmt = $db->prepare($sql);
        $stmt->execute();
    } catch (Exception $ex) {
        $msg = "list_adm_modulos#1 :" . $ex->getMessage();
    }

    if ($msg == '') {
        try {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $row['MODULO_PAI'] = modulo_pai($row['ID_MODULO'], $msg);
                array_push($result, $row);
            }
        } catch (Exception $ex) {
            $msg = "list_adm_modulos#2 :" . $ex->getMessage();
        }
    }

    return $result;

}

#
# Lista com os distintos perfis definidos na plataforma
function list_adm_perfis($ativos_, $wkf_, &$msg) {

    global $db;
    
    $msg = '';
    $result = array();

    $sql = "SELECT P.ID ID_PERFIL, COALESCE(L.DSP_TRAD, P.DSP_PERFIL) DSP_PERFIL, P.ESTADO, P.WORKFLOW, ".
            "      COALESCE(L.DSR_TRAD, P.DSR_PERFIL) DSR_PERFIL, P.TIPO_PERFIL, ".
            "      P.ESTADO, P.WORKFLOW, P.DESCRICAO, P.NR_ORDEM ".
           "FROM WEB_ADM_PERFIS P ".
           "LEFT JOIN WEB_ADM_PERFIS_TRADS L ON L.ID = P.ID ".
           " AND L.CD_LINGUA = DG_LANG_CODE('".@$_SESSION['lang']."') ".
           "WHERE 1 = 1 ";

    if ($ativos_ == 'S') { // só perfis ativos
        $sql .= " AND P.ESTADO = 'A' ";
    }

    if ($wkf_ == 'S') { // só com workflow
        $sql .= " AND P.WORKFLOW = 'S' ";
    }

    $sql .= "ORDER BY COALESCE(P.NR_ORDEM,99999) ";
    try {
        $stmt = $db->prepare($sql);
        $stmt->execute();
    } catch (Exception $ex) {
        $msg = "list_adm_perfis#1 :" . $ex->getMessage();
    }

    if ($msg == '') {
        try {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($result, $row);
            }
        } catch (Exception $ex) {
            $msg = "list_adm_perfis#2 :" . $ex->getMessage();
        }
    }

    return $result;

}

#
# obtenção da configuração de um workflow para um módulo/perfil
function get_workflow($id_modulo, $id_perfil, &$estado, &$modo_acesso, &$notif_ecran, &$notif_email, &$notif_sms, &$msg) {
    global $db;
    
    $msg = '';
    $estado = '';
    $modo_acesso = '';
    $notif_ecran = '';
    $notif_email = '';
    $notif_sms = '';

    $sql =  "SELECT A.* ".
            "FROM WEB_ADM_WORKFLOW A ".
            "WHERE ID_PERFIL = :ID_PERFIL_ ".
            "  AND ID_MODULO = :ID_MODULO_ ";

    if ($id_modulo != '' && $id_perfil != '') {
        try {
            $stmt = $db->prepare($sql);

            $stmt->bindParam(':ID_PERFIL_', $id_perfil, PDO::PARAM_STR);
            $stmt->bindParam(':ID_MODULO_', $id_modulo, PDO::PARAM_STR);

            $stmt->execute();
        } catch (Exception $ex) {
            $msg = "get_workflow#1 :" . $ex->getMessage();
        }

        if ($msg == '') {
            try {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $estado = $row['ESTADO'];
                    $modo_acesso = $row['MODO_ACESSO'];
                    $notif_ecran = $row['NOTIF_ECRAN'];
                    $notif_email = $row['NOTIF_EMAIL'];
                    $notif_sms = $row['NOTIF_SMS'];
                }
            } catch (Exception $ex) {
                $msg = "get_workflow#2 :" . $ex->getMessage();
            }
        }
    }
}

#
# remoção de ficheiros de controlo de acessos/workflow na plataforma
function clear_fx_workflow (&$msg) {

    global $db;

    # se não existir diretoria de workflows, cria
    $directory = WORKFLOW_PATH."/";
    if( !is_dir( $directory ) ) {
        mkdir( $directory, 0777, true );
    }
    
    try {
        $sql =  "SELECT A.ID_MODULO, A.TABELA_ASSOCIADA, A.ESTADO, A.WORKFLOW, A.ID_PAI, B.TABELA_ASSOCIADA TABELA_ASSOCIADA_PAI ".
                "FROM WEB_ADM_MODULOS_PORTAL A ".
                "  LEFT JOIN WEB_ADM_MODULOS_PORTAL B ON (A.ID_PAI = B.ID_MODULO) ".
                "WHERE A.ESTADO = 'B' ";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($row['TABELA_ASSOCIADA_PAI'] != '') {
                null;
            } else {
                $file = $directory.$row["TABELA_ASSOCIADA"]."_*.json";
                foreach(glob($file) as $f) {
                    if (file_exists($f)) {
                        unlink($f);
                    }
                }
            }
        }
    } catch (Exception $e) {
        $msg = "clear_fx_workflow#1: " . $e->getMessage();
    }

    if ($msg == '') {
        try {
            $sql =  "SELECT A.TIPO_PERFIL, A.ID ID_PERFIL ".
                    "FROM WEB_ADM_PERFIS A ".
                    "WHERE A.ESTADO = 'B' ";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $file = $directory."*_".$row['ID_PERFIL'].".json";
                foreach(glob($file) as $f) {
                    #echo "remove file:$f<br/>";
                    if (file_exists($f)) {
                        unlink($f);
                    }
                }

            }
        } catch (Exception $e) {
            $msg = "clear_fx_workflow#2: " . $e->getMessage();
        }
    }
}

#
# geração de ficheiros de controlo de acessos/workflow na plataforma
function gera_fx_workflow ($id_modulo, $id_perfil, &$msg) {

    global $db;

    # se não existir diretoria de workflows, cria
    $directory = WORKFLOW_PATH."/";
    if( !is_dir( $directory ) ) {
        mkdir( $directory, 0777, true );
    }

    $tabela = '';
    $msg = '';

    if ($id_modulo != '') {

        $sql =  "SELECT A.ID_MODULO, A.TABELA_ASSOCIADA, A.ESTADO, A.WORKFLOW, A.ID_PAI, B.TABELA_ASSOCIADA TABELA_ASSOCIADA_PAI ".
                "FROM WEB_ADM_MODULOS_PORTAL A ".
                "  LEFT JOIN WEB_ADM_MODULOS_PORTAL B ON (A.ID_PAI = B.ID_MODULO) ".
                "WHERE A.ID_MODULO = :ID_MODULO_";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':ID_MODULO_', $id_modulo);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row['TABELA_ASSOCIADA_PAI'] != '') {
            $tabela = $row['TABELA_ASSOCIADA_PAI'];
        } else {
            $tabela = $row['TABELA_ASSOCIADA'];
        }
    }

    $sql =  "SELECT A.ID_MODULO, A.TABELA_ASSOCIADA, B.ID ID_PERFIL, B.TIPO_PERFIL ".
            "FROM WEB_ADM_MODULOS_PORTAL A, WEB_ADM_PERFIS B ".
            "WHERE A.TABELA_ASSOCIADA IS NOT NULL  ".
            "  AND A.ESTADO = 'A' ".
            "  AND A.ID_PAI IS NULL  ".
            "  AND B.ESTADO = 'A' ";


    if ($tabela != '') {
        $sql .= " AND A.TABELA_ASSOCIADA = :TABELA_ASSOCIADA_";
    }
    if ($id_perfil != '') {
        $sql .= " AND B.ID = :PERFIL_";
    }

    try {
        $stmt = $db->prepare($sql);
        if ($tabela != '') {
            $stmt->bindParam(':TABELA_ASSOCIADA_', $tabela);
        }
        if ($id_perfil != '') {
            $stmt->bindParam(':PERFIL_', $id_perfil);
        }
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $params = '{'."\r\n";
            try {
                $sql1 = "SELECT A.ID_MODULO, A.TABELA_ASSOCIADA, A.ESTADO, A.WORKFLOW, B.ID ID_PERFIL ".
                        "FROM WEB_ADM_MODULOS_PORTAL A, WEB_ADM_PERFIS B ".
                        "WHERE A.TABELA_ASSOCIADA IS NOT NULL  ".
                        "  AND ( ".
                        "       (A.ID_MODULO = :ID_MODULO_ AND A.ID_PAI IS NULL AND A.ID_MODULO NOT IN (SELECT ID_PAI FROM WEB_ADM_MODULOS_PORTAL WHERE ID_PAI IS NOT NULL)) OR ".
                        "       (A.ID_PAI = :ID_MODULO_ AND A.TABELA_ASSOCIADA != :TABELA_ASSOCIADA_) ".
                        "  ) ".
                        "  AND B.ID = :ID_PERFIL_ ".
                        "  AND B.ESTADO = 'A' ".
                        "ORDER BY A.NR_ORDEM, A.ID_MODULO";

                $stmt1 = $db->prepare($sql1);
                $stmt1->bindParam(':ID_MODULO_', $row['ID_MODULO']);
                $stmt1->bindParam(':ID_PERFIL_', $row['ID_PERFIL']);
                $stmt1->bindParam(':TABELA_ASSOCIADA_', $row['TABELA_ASSOCIADA']);
                $stmt1->execute();
                $first = true;
                while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {

                    $msg = '';
                    $estado = '';
                    $modo_acesso = '';
                    $notif_ecran = '';
                    $notif_email = '';
                    $notif_sms = '';
                    $crud_insert = 'true';
                    $crud_update = 'true';
                    $crud_delete = 'true';
                    
                    # mode de workflow: postponed or optimistic
                    $workflow_mode = '            "mode":"postponed",'."\r\n";
                    
                    if ($row1['ESTADO'] == 'A') {
                        get_workflow($row1['ID_MODULO'], $row1['ID_PERFIL'], $estado, $modo_acesso, $notif_ecran, $notif_email, $notif_sms, $msg);
                    }

                    if ($msg == '') {
                        
                        # mode de workflow: postponed or optimistic
                        $workflow_mode = '            "mode":"postponed",'."\r\n";
                        
                        # Todas as tabelas de gestão de tempo => mode de workflow: optimistic
                        if ($row['TABELA_ASSOCIADA'] == 'RH_TIME_MANAGEMENT' ||
                            $row['TABELA_ASSOCIADA'] == 'RH_ESCALAS' ) {
                            #$workflow_mode = '            "mode":"optimistic",'."\r\n";
                            null;
                        }

                        # estado workflow: A - Ativo, B - Inativo
                        if ($estado == 'A') {
                            if ($row1['TABELA_ASSOCIADA'] == 'RH_IDENTIFICACOES' || 
                                $row1['TABELA_ASSOCIADA'] == 'RH_ID_EMPRESAS' ||                                     
                                $row1['TABELA_ASSOCIADA'] == 'RH_ID_RETRIBUTIVOS' ||                                     
                                $row1['TABELA_ASSOCIADA'] == 'RH_ID_PROFISSIONAIS') {
                            $workflow = '        "workflow": {'."\r\n".
                                            $workflow_mode.
                                            '            "showWorkflowOnEdit":false,'."\r\n".
                                            '            "update":"column"'."\r\n".
                                        '        }';
                        } else {
                                $workflow = '        "workflow": {'."\r\n".
                                            $workflow_mode.
                                            '            "showWorkflowOnEdit":false,'."\r\n".
                                            '            "update":"record"'."\r\n".
                                            '        }';
                            }
                        } else {
                            $workflow = '        "workflow": false';
                        }

                        # modo acesso: A - Manutenção, B - Consulta, Z - Sem Acesso
                        if ($modo_acesso == 'A') {
                            $crud_insert = 'true';
                            $crud_update = 'true';
                            $crud_delete = 'true';
                            $crud = '        "crud":[true,true,true]';
                            $acesso = '        "access":true';
                        } elseif ($modo_acesso == 'B') {
                            $crud_insert = 'false';
                            $crud_update = 'false';
                            $crud_delete = 'false';
                            $crud = '        "crud":[false,false,false]';
                            $acesso = '        "access":true';
                        } else {
                            $crud_insert = 'false';
                            $crud_update = 'false';
                            $crud_delete = 'false';
                            $crud = '        "crud":[false,false,false]';
                            $acesso = '        "access":false';
                        }

                        # colunas RGPD    
                        # 
                        $colunasRGPD = '        "rgpd":{'."\r\n"; 
                        $colunas = get_colunas_RGPD($row1['ID_MODULO'], $row1['ID_PERFIL'],$msg);
                        if ($msg == '') {
                            $first_col = true;
                            foreach($colunas as $coluna) {
                                $estado_col = "true";
                                if ($coluna['ESTADO'] == 'B') {
                                    $estado_col = "false";
                                }

                                # se não pode aceder às colunas da PK => então não pode efetuar DML
                                if ($coluna['PK'] == 'S' && $estado_col == 'false') {
                                    $crud_insert = 'false';
                                    $crud_update = 'false';
                                    $crud_delete = 'false';
                                    # se não pode efetuar insert/delete => workflow = false
                                    $workflow = '        "workflow": false';
                                # se não pode aceder a coluna mandatória => então não pode inserir registo
                                } elseif ($coluna['MANDATORIA'] == 'S' && $estado_col == 'false') {
                                    $crud_insert = 'false';
                                    $crud_delete = 'false';
                                    # se não pode efetuar insert/delete => workflow = false
                                    $workflow = '        "workflow": false';
                                }
                        # $coluna['PK'], $coluna['MANDATORIA'] => CONDICIONAR CRUD
                                
                                if ($first_col) {
                                    $colunasRGPD .= '            "'.$coluna['COLUNA'].'":'.$estado_col; 
                                    $first_col = false;
                                } else {
                                    $colunasRGPD .= ','."\r\n".'            "'.$coluna['COLUNA'].'":'.$estado_col; 
                                }
                            }
                            $colunasRGPD .= "\r\n".'        }'; 
                        }

                        $crud = '        "crud":['.$crud_insert.','.$crud_update.','.$crud_delete.']';
                        
                        # construção da string de parametrização
                        if ($msg == '') {
                        if ($first) {
                            $first = false;
                            $linha = '    "'.$row1['TABELA_ASSOCIADA'].'":{'."\r\n".
                                     $workflow.",\r\n".
                                     $crud.",\r\n".
                                         $acesso.",\r\n".
                                         $colunasRGPD."\r\n".
                                     '    }';
                        } else {
                            $linha = ','."\r\n".
                                     '    "'.$row1['TABELA_ASSOCIADA'].'":{'."\r\n".
                                     $workflow.",\r\n".
                                     $crud.",\r\n".
                                         $acesso.",\r\n".
                                         $colunasRGPD."\r\n".
                                     '    }';
                        }
                        $params .= $linha;
                        }
                    } else {
                        break;
                    }
                }
            } catch (Exception $e) {
                $msg = "gera_fx_workflow#1: " . $e->getMessage();
                break;
            }
            $params .= "\r\n".'}'."\r\n";

            $file = $directory.$row["TABELA_ASSOCIADA"]."_".$row["ID_PERFIL"].".json";
            
            if (!is_dir($directory) || !is_writable($directory)) {
                $msg = "gera_fx_workflow#3: problema na escrita da diretoria [$directory].";
                break;
        }
            
        if (file_exists($file)) {
            unlink($file);
        }
        $return = file_put_contents($file,($params));
#ssecho "tabela:".$row['TABELA_ASSOCIADA']." FICHEIRO:$file RESULTADO:$return<br/>";
        }
    } catch (Exception $e) {
        $msg = "gera_fx_workflow#2: " . $e->getMessage();
    }
}

#
# inicialização da estrutura de workflow de acordo com os módudos e perfis definidos
function inicializa_workflow(&$msg) {
    global $db;
    
    $msg = '';
    $executionStartTime = microtime(true);

    $sql = "SELECT A.ID_MODULO, B.ID AS ID_PERFIL ".
           "FROM WEB_ADM_MODULOS_PORTAL A, WEB_ADM_PERFIS B ".
           "WHERE A.ESTADO = 'A' ".
           "  AND A.TABELA_ASSOCIADA IS NOT NULL ".
           "  AND B.ESTADO = 'A' ".
           #"  AND B.WORKFLOW = 'S' ".
           "  AND (A.ID_MODULO, B.ID) NOT IN (SELECT ID_MODULO, ID_PERFIL FROM WEB_ADM_WORKFLOW) ";

    try {
        $stmt = $db->prepare($sql);
        $stmt->execute();
    } catch (Exception $ex) {
        $msg = "inicializa_workflow#1 :" . $ex->getMessage();
    }

    if ($msg == '') {
        try {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $sql1 = "INSERT INTO WEB_ADM_WORKFLOW ".
                        "(ID_MODULO, ID_PERFIL, ESTADO, MODO_ACESSO, NOTIF_ECRAN, NOTIF_EMAIL, NOTIF_SMS) ".
                        "VALUES(:ID_MODULO_, :ID_PERFIL_, 'B', 'Z', 'N', 'N', 'N') ".
                        "ON DUPLICATE KEY UPDATE ID_MODULO = ID_MODULO ";
                try {
                    $stmt1 = $db->prepare($sql1);
                    $stmt1->bindParam(':ID_PERFIL_', $row['ID_PERFIL'], PDO::PARAM_STR);
                    $stmt1->bindParam(':ID_MODULO_', $row['ID_MODULO'], PDO::PARAM_STR);
                    $stmt1->execute();
                } catch (Exception $ex) {
                    $msg = "grava_workflow#2 :" . $ex->getMessage();
                    break;
                }
            }
        } catch (Exception $ex) {
            $msg = "inicializa_workflow#3 :" . $ex->getMessage();
        }
    }

    if ($msg == '') {
        clear_fx_workflow($msg);
        #gera_fx_workflow('','',$msg);
    }
    $executionEndTime = microtime(true);
    $seconds = $executionEndTime - $executionStartTime;
    #echo "inicialização:$seconds<br/>";
}

#
# gravação da configuração de um workflow para um módulo
function set_workflow($id_modulo, $id_perfil, $estado, $modo_acesso, $notif_ecran, $notif_email, $notif_sms, &$msg) {
    global $db;
    
    $msg = '';

    $sql = "UPDATE WEB_ADM_WORKFLOW ".
           "SET SEQ = SEQ ";

    if ($estado != '') {
        $sql .= " ,ESTADO = :ESTADO_ ";
    }

    if ($modo_acesso != '') {
        $sql .= " ,MODO_ACESSO = :MODO_ACESSO_ ";
    }

    if ($notif_ecran != '') {
        $sql .= " ,NOTIF_ECRAN = :NOTIF_ECRAN_ ";
    }

    if ($notif_email != '') {
        $sql .= " ,NOTIF_EMAIL = :NOTIF_EMAIL_ ";
    }

    if ($notif_sms != '') {
        $sql .= " ,NOTIF_SMS = :NOTIF_SMS_ ";
    }

    $sql .= "WHERE ID_PERFIL = :ID_PERFIL_ ".
            "  AND ID_MODULO = :ID_MODULO_ ";

    if ($id_modulo != '' && $id_perfil != '' && ($estado != '' || $modo_acesso != '' || $notif_ecran != '' || $notif_email != '' || $notif_sms != '') ) {
        try {
            $stmt = $db->prepare($sql);

            if ($estado != '') {
                $stmt->bindParam(':ESTADO_', $estado, PDO::PARAM_STR);
            }

            if ($modo_acesso != '') {
                $stmt->bindParam(':MODO_ACESSO_', $modo_acesso, PDO::PARAM_STR);
            }

            if ($notif_ecran != '') {
                $stmt->bindParam(':NOTIF_ECRAN_', $notif_ecran, PDO::PARAM_STR);
            }

            if ($notif_email != '') {
                $stmt->bindParam(':NOTIF_EMAIL_', $notif_email, PDO::PARAM_STR);
            }

            if ($notif_sms != '') {
                $stmt->bindParam(':NOTIF_SMS_', $notif_sms, PDO::PARAM_STR);
            }
            $stmt->bindParam(':ID_PERFIL_', $id_perfil, PDO::PARAM_STR);
            $stmt->bindParam(':ID_MODULO_', $id_modulo, PDO::PARAM_STR);

            $stmt->execute();
        } catch (Exception $ex) {
            $msg = "set_workflow#1 :" . $ex->getMessage();
        }

        if ($msg == '') {
            gera_fx_workflow ($id_modulo, $id_perfil, $msg);
        }
    }
}

#
# identificação do utilizador portal/colaborador associado a um perfil $id_perfil para o colaborador identificado
function get_rhid_perfil_workflow($id_perfil, $empresa, $rhid, $dt_adm, $dt_ref, &$rhid_chefia, &$id_utilizador, &$msg) {

    global $db;
    
    $msg = '';
    $rhid_chefia = '';
    $id_utilizador = '';

    if ($dt_ref == '') {
        $dt_ref = date("Y-m-d");
    }

    if ($id_perfil != '' && $empresa != '' && $rhid != '' && $dt_adm != '' && $dt_ref != '') {

        $sql =  "SELECT A.ID_UTILIZADOR, A.RHID_CHEFIA ".
                "FROM RH_ID_WORKFLOWS A ".
                "WHERE A.ID_PERFIL = :ID_PERFIL_ ".
                "  AND A.EMPRESA = :EMPRESA_ ".
                "  AND A.RHID = :RHID_ ".
                "  AND A.DT_ADMISSAO = :DT_ADM_ ".
                "  AND :DT_REF_ BETWEEN DATE_FORMAT(A.DT_INI,'%Y-%m-%d) AND NVL(DATE_FORMAT(A.DT_FIM,'%Y-%m-%d'),:DT_REF_) ";

        try {
            $stmt = $db->prepare($sql);

            $stmt->bindParam(':ID_PERFIL_', $id_perfil, PDO::PARAM_STR);
            $stmt->bindParam(':EMPRESA_', $empresa, PDO::PARAM_STR);
            $stmt->bindParam(':RHID_', $rhid, PDO::PARAM_STR);
            $stmt->bindParam(':DT_ADM_', $dt_adm, PDO::PARAM_STR);
            $stmt->bindParam(':DT_REF_', $dt_ref, PDO::PARAM_STR);

            $stmt->execute();
        } catch (Exception $ex) {
            $msg = "get_rhid_perfil_workflow#1 :" . $ex->getMessage();
        }

        if ($msg == '') {
            try {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $rhid_chefia = $row['RHID_CHEFIA'];
                    $id_utilizador = $row['ID_UTILIZADOR'];
                }
            } catch (Exception $ex) {
                $msg = "get_rhid_perfil_workflow#2 :" . $ex->getMessage();
            }
        }
    }
}

#
# obtenção do estado de workflow de um registo associado a um módulo
function get_workflow_registo($id_modulo, $tp_perfil, $empresa, $rhid, $dt_adm,
                              &$perfil_ini, &$nxt_perfil, &$last_perfil, &$finished, &$msg) {
    global $db;
    
    $msg = '';
    $msg1 = '';
    $executionStartTime = microtime(true);

    $dt_ref = '';
    $perfil_ini = '';
    $nr_ordem_wkf_ini = '';
    $nxt_perfil = '';
    $last_perfil = '';
    $finished = 'N';

    $estado_wkf = '';
    $modo_acesso = '';
    $notif_ecran = '';
    $notif_email = '';
    $notif_sms = '';

    $rhid_chefia = '';
    $id_utilizador = '';

    if ($id_modulo != '' && $tp_perfil != '') {

        # obtém o código do perfil inicial
        get_id_tp_perfil($tp_perfil, $perfil_ini, $nr_ordem_wkf_ini, $msg);
        if ($nr_ordem_wkf_ini == '') {
            $msg = 'workflow inválido.';
        }
        elseif ($msg == '' && $perfil_ini != '') {

            get_workflow($id_modulo, $perfil_ini, $estado_wkf, $modo_acesso, $notif_ecran, $notif_email, $notif_sms, $msg);

            # estado workflow: A - Ativo, B - Inativo
            if ($estado_wkf == 'A') { # avalia à frente a cadeia de aprovação
                null;
            } else { # perfil com workflow inativo
                # modo acesso: A - Manutenção, B - Consulta, Z - Sem Acesso
                if ($modo_acesso == 'A') { # workflow concluído -> auto-aprovação
                    $nxt_perfil = $perfil_ini;
                    $last_perfil = $perfil_ini;
                } else {
                    $msg = 'workflow inválido.';
                }
            }
        }

        if ($msg == '' && $nr_ordem_wkf_ini != '') {

            $sql = "SELECT A.ID_MODULO, B.DSP_MODULO, A.ID_PERFIL, C.DSP_PERFIL, C.NR_ORDEM NR_ORDEM_WORKFLOW, C.TIPO_PERFIL, C.HIERARQUIA ".
                   "FROM  WEB_ADM_WORKFLOW A ".
                   "     ,WEB_ADM_MODULOS_PORTAL B ".
                   "     ,WEB_ADM_PERFIS C ".
                   " WHERE A.ID_MODULO = :ID_MODULO_ ".
                   "   AND A.ID_MODULO = B.ID_MODULO ".
                   "   AND A.ID_PERFIL = C.ID ".
                   "   AND A.ESTADO = 'A' ".
                   "   AND B.ESTADO = 'A' ".
                   "   AND B.WORKFLOW = 'S' ".
                   "   AND C.ESTADO = 'A' ".
                   "   AND C.WORKFLOW = 'S' ".
                   "   AND C.NR_ORDEM > :NR_ORDEM_WKF_ ".
                   "ORDER BY B.NR_ORDEM, C.NR_ORDEM ";

            try {
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':ID_MODULO_', $id_modulo, PDO::PARAM_STR);
                $stmt->bindParam(':NR_ORDEM_WKF_', $nr_ordem_wkf_ini, PDO::PARAM_STR);
                $stmt->execute();

                $nxt_perfil = '';
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                    # atualiza próximo perfil da cadeia de aprovação
                    if ($nxt_perfil == '') {
                        $nxt_perfil = $row['ID_PERFIL'];

                        # Apenas para os perfis definidos como Hierarquicos é que deverá ser validada
                        # a identificação do colaborador/utilizador a aprovar
                        if ($row['HIERARQUIA'] == 'S') {
                            ## valida se o perfil se encontra identificado para o colaborador em questão, caso contrário "salta" perfil
                            get_rhid_perfil_workflow($nxt_perfil, $empresa, $rhid, $dt_adm, $dt_ref, $rhid_chefia, $id_utilizador, $msg);

                            if ($msg == '') {
                                # se não tem perfil identificado, passa ao próximo nível
                                if ($rhid_chefia == '' && $id_utilizador == '') {
                                    $nxt_perfil = '';
                                }
                            } else {
                                break;
                            }
                        }
                    }

                    # atualiza último perfil da cadeia de aprovação
                    $last_perfil = $row['ID_PERFIL'];

                    if ($nxt_perfil != '' && $last_perfil != '' && $last_perfil == $nxt_perfil) {
                        null;
                    } elseif ($last_perfil != '') {

                        # Apenas para os perfis definidos como Hierarquicos é que deverá ser validada
                        # a identificação do colaborador/utilizador a aprovar
                        if ($row['HIERARQUIA'] == 'S') {
                            ## valida se o perfil se encontra identificado para o colaborador em questão, caso contrário "salta" perfil
                            get_rhid_perfil_workflow($last_perfil, $empresa, $rhid, $dt_adm, $dt_ref, $rhid_chefia, $id_utilizador, $msg);

                            if ($msg == '') {
                                # se não tem perfil identificado, passa ao próximo nível
                                if ($rhid_chefia == '' && $id_utilizador == '') {
                                    $last_perfil = '';
                                }
                            } else {
                                break;
                            }
                        }
                    }
                }

                if ($perfil_ini != '' && $last_perfil == '' && $nxt_perfil == '') {
                    $finished = 'S';
                }

            } catch (Exception $ex) {
                $msg = "get_workflow_registo#1 :" . $ex->getMessage();
            }
        }
    }
    $executionEndTime = microtime(true);
    $seconds = $executionEndTime - $executionStartTime;
    #echo "get_workflow_registo:$seconds<br/>";

}


##
## RGPD
##

function inic_colunas_RGPD(&$msg) {
    global $db;
    
    $msg = '';
    
    if ($msg == '') {
        $sql = "SELECT A.ID_RGPD, A.TABELA, A.NR_ORDEM, B.ID ID_PERFIL ".
               "FROM WEB_ADM_RGPD A, WEB_ADM_PERFIS B ".
               "WHERE (A.ID_RGPD,B.ID) NOT IN (SELECT ID_COL_RGPD, ID_PERFIL FROM WEB_ADM_RGPD_CTRL) ".
               "ORDER BY A.TABELA, A.NR_ORDEM, B.ID ";
        try {
            $stmt = $db->prepare($sql);
            $stmt->execute();
        } catch (Exception $ex) {
            $msg = "inic_colunas_RGPD#1 :" . $ex->getMessage();
        }
        
        if ($msg == '') {
            try {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $sql1 = "INSERT INTO WEB_ADM_RGPD_CTRL ".
                            "(ID_COL_RGPD, ID_PERFIL, ESTADO) ".
                            "VALUES(:ID_COL_, :ID_PERFIL_, :ESTADO_) ";
                    $stmt1 = $db->prepare($sql1);
                    $estado = 'A';
                    $stmt1->bindParam(':ID_COL_', $row['ID_RGPD'], PDO::PARAM_STR);
                    $stmt1->bindParam(':ID_PERFIL_', $row['ID_PERFIL'], PDO::PARAM_STR);
                    $stmt1->bindParam(':ESTADO_', $estado, PDO::PARAM_STR);
                    $stmt1->execute();
                }
            } catch (Exception $ex) {
                $msg = "inic_colunas_RGPD#2 :" . $ex->getMessage();
            }
        }
    }
}

#
# lista das colunas associadas a um módulo/tabela
function get_colunas_RGPD($id_modulo, $id_perfil, &$msg) {
    
    global $db;
    
    $msg = '';
    $resultado = array();
    
    $sql = "SELECT A.ID_RGPD, A.TABELA, A.COLUNA, A.PK, A.MANDATORIA, A.NR_ORDEM, A.ID_MODULO, NVL(A.DSP_COLUNA,A.COLUNA) DSP_COLUNA, B.ESTADO, B.ID  ".
           "FROM WEB_ADM_RGPD A ".
           " LEFT JOIN WEB_ADM_RGPD_CTRL B ON B.ID_COL_RGPD = A.ID_RGPD AND B.ID_PERFIL = :ID_PERFIL_ ".
           "WHERE A.ID_MODULO = :ID_MODULO_ ".
           "ORDER BY A.NR_ORDEM ";
    try {
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':ID_MODULO_', $id_modulo, PDO::PARAM_STR);
        $stmt->bindParam(':ID_PERFIL_', $id_perfil, PDO::PARAM_STR);
        $stmt->execute();
    } catch (Exception $ex) {
        $msg = "get_colunas_RGPD#1 :" . $ex->getMessage();
    }
            
    if ($msg == '') {
        try {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
                array_push($resultado,$row);
            }   
        } catch (Exception $ex) {
            $msg = "get_colunas_RGPD#2 :" . $ex->getMessage();
        }
    }   
    return $resultado;
}

#
# gravação da configuração das colunas RGPD
function set_colunas_RGPD($id_coluna, $id_modulo, $id_perfil, $estado, &$msg) {
    global $db;
    
    $msg = '';
    
    if ($id_coluna != '') {
        $sql = "UPDATE WEB_ADM_RGPD_CTRL ".
               "SET ESTADO = :ESTADO_ ".
               "WHERE ID = :ID_ ";
    }
    else {
        $sql = "UPDATE WEB_ADM_RGPD_CTRL ".
               "SET ESTADO = :ESTADO_ ".
               "WHERE ID_PERFIL = :ID_PERFIL ".
               "  AND ID_COL_RGPD IN (SELECT ID_RGPD FROM WEB_ADM_RGPD WHERE ID_MODULO = :ID_MODULO_) ";
    }
    
    if ($estado != '' && $id_modulo != '' && $id_perfil != '') {
        try {
            $stmt = $db->prepare($sql);
            
            $stmt->bindParam(':ESTADO_', $estado, PDO::PARAM_STR);
            
            if ($id_coluna != '') {
                $stmt->bindParam(':ID_', $id_coluna, PDO::PARAM_STR);
            } else {
                $stmt->bindParam(':ID_PERFIL', $id_perfil, PDO::PARAM_STR);
                $stmt->bindParam(':ID_MODULO_', $id_modulo, PDO::PARAM_STR);
            }
            
            $stmt->execute();
        } catch (Exception $ex) {
            $msg = "set_colunas_RGPD#1 :" . $ex->getMessage();
        }        
        
        if ($msg == '') {
            gera_fx_workflow ($id_modulo, $id_perfil, $msg);
        }
    }
}

##
## Tratamento de menus na plataforma
##

#
# Adiciona um elemento a um array
function array_push_assoc($array, $key, $value){
    $array[$key] = $value;
    return $array;
}

#
# Inicializa um nó de menu
function inicializa_no_menu($title_, $icon_, $class_, $url_, $active_) {
    if ($url_ == '') {
    return array(
            "title" => $title_,
            "icon" => $icon_,
            "active" => $active_,
            "items" => array()
        );
    } else {
        return array(
                "title" => $title_,
                "icon" => $icon_,
                "url" => $url_,
                "active" => $active_,
                "items" => array()
            );
    }
}

#
# Adiciona um nó a um menu
function adiciona_conteudo_menu(&$menu_, $name_, $content_) {
    $menu_["items"] = array_push_assoc($menu_["items"], $name_, $content_);
}

#
# Adiciona uma opção de menu (folha) a um nó de menu
function adiciona_interface(&$menu_, $name_, $title_, $icon_, $url_, $class_, $active_) {
    $opcao_ = array(
                "title" => $title_,
                "icon" => $icon_,
                "url" => $url_,
                'active' => $active_
            );
    adiciona_conteudo_menu($menu_,$name_,$opcao_);
}



##
## MENUS - AVALIAÇÃO DE DESEMPENHO
##

#
# Controi o nó associado às fichas de avaliação disponíveis no perfil de colaborador
# devolvendo um array com as opções disponíveis
function av_menu_fichas_aval_colab(&$msg) {
    
    global  $db
           ,$ui_evaluation_sheets;

    $msg = "";
    $cnt = 0;
    $rhid_ = @$_SESSION['rhid'];
    
    ## FICHAS AVALIAÇÃO
    $av_sheets = inicializa_no_menu($ui_evaluation_sheets, "fa-arrow-right", "", "", false);

    ## CORRENTES
    $av_correntes = inicializa_no_menu("Correntes", "fa-arrow-right", "", "", false);

    ## ANTERIORES
    $av_anteriores = inicializa_no_menu("Histórico", "fa-arrow-right", "", "", false);
    
    try {
        $sql = "SELECT A.EMPRESA, A.ID_PA, A.DT_INI_PA, A.ID_PROCESSO_AV, A.DT_INI_PROCESSO,".
               "       A.RHID_AVALIADO, A.DT_ADMISSAO, A.RHID_AVALIADOR, A.ID_FASE, A.DT_INI_FASE, A.DT_INI_FPA, A.DT_INI_AF, ".
               "       B.DSR_PROCESSO, A.ESTADO, ".
               "       GE_AVALIACAO_TERMINADA(A.ID_PA,A.DT_INI_PA,A.ID_PROCESSO_AV,A.DT_INI_PROCESSO,A.RHID_AVALIADO,A.DT_ADMISSAO,A.EMPRESA) AS TERMINADA, ".
               "       GE_AVALIACAO_HISTORICO(A.ID_PA,A.DT_INI_PA,A.ID_PROCESSO_AV,A.DT_INI_PROCESSO,A.RHID_AVALIADO,A.DT_ADMISSAO,A.EMPRESA) AS HISTORICO ".                
               "FROM RH_AVALIADOR_FASES A, RH_PROCESSOS_AVALIACAO B ".
               "WHERE A.RHID_AVALIADO = :RHID_ ".
               "  AND A.RHID_AVALIADOR = :RHID_ ".
               "  AND A.ESTADO != 'Z' ".
               "  AND B.EMPRESA = A.EMPRESA ".
               "  AND B.ID_PA = A.ID_PA ".
               "  AND B.DT_INI_PA = A.DT_INI_PA ".
               "  AND B.ID_PROCESSO_AV = A.ID_PROCESSO_AV ".
               "  AND B.DT_INI_PROCESSO = A.DT_INI_PROCESSO ".
               "  AND DATE_FORMAT(B.DT_INI_AVALIACAO,'%Y-%m-%d') <= DATE_FORMAT(SYSDATE(),'%Y-%m-%d') ".
               "  AND GE_ESTADO_PROC_AVALIACAO(B.EMPRESA,B.ID_PA,B.DT_INI_PA,B.ID_PROCESSO_AV,B.DT_INI_PROCESSO) IN ('E','F') ".
               "UNION ".
               ## nesta query são retornadas todas as fichas que estão para concordância, sendo passada a chave da ficha de avaliação, 
               ## mas a designação da fase é a correspondente à concordância do colaborador da ficha de avaliação
               "SELECT X.EMPRESA, X.ID_PA, X.DT_INI_PA, X.ID_PROCESSO_AV, X.DT_INI_PROCESSO,".
               "       X.RHID RHID_AVALIADO, X.DT_ADMISSAO, F.RHID_AVALIADOR, F.ID_FASE, F.DT_INI_FASE, F.DT_INI_FPA, F.DT_INI_AF, ".
               "       X.DSP_PROCESSO, F.ESTADO, ".
               "       GE_AVALIACAO_TERMINADA(X.ID_PA,X.DT_INI_PA,X.ID_PROCESSO_AV,X.DT_INI_PROCESSO,X.RHID,X.DT_ADMISSAO,X.EMPRESA) AS TERMINADA, ".
               "       GE_AVALIACAO_HISTORICO(X.ID_PA,X.DT_INI_PA,X.ID_PROCESSO_AV,X.DT_INI_PROCESSO,X.RHID,X.DT_ADMISSAO,X.EMPRESA) AS HISTORICO ".                
               "FROM MASTER_AVALIACAO X, MASTER_AVALIACAO F ".
               "WHERE X.ESTADO IN ('Z') ".
               "  AND GE_ESTADO_PROC_AVALIACAO(X.EMPRESA,X.ID_PA,X.DT_INI_PA,X.ID_PROCESSO_AV,X.DT_INI_PROCESSO) IN ('E','F') ".
               "  AND GE_AVALIACAO_HISTORICO(X.ID_PA,X.DT_INI_PA,X.ID_PROCESSO_AV,X.DT_INI_PROCESSO,X.RHID,X.DT_ADMISSAO,X.EMPRESA) = 'N' ".               
               "  AND X.RHID_AVALIADOR = :RHID_ ".
               "  AND DATE_FORMAT(X.DT_INI_AVALIACAO,'%Y-%m-%d') <= DATE_FORMAT(SYSDATE(),'%Y-%m-%d') ".
               "  AND DATE_FORMAT(F.DT_INI_AVALIACAO,'%Y-%m-%d') <= DATE_FORMAT(SYSDATE(),'%Y-%m-%d') ".
               "  AND (X.EMPRESA, X.ID_PA, X.DT_INI_PA, X.ID_PROCESSO_AV, X.DT_INI_PROCESSO, X.ID_FASE, X.DT_INI_FASE, X.DT_INI_FPA) IN ".
               " (SELECT A.EMPRESA, A.ID_PA, A.DT_INI_PA, A.ID_PROCESSO_AV, A.DT_INI_PROCESSO, A.ID_FASE, A.DT_INI_FASE, A.DT_INI_FPA ".
               "  FROM RH_FASES_FONTES_PROCESSO A ".
               "    , RH_TECNICAS_AVAL_PROCESSO B ".
               "  WHERE B.EMPRESA = A.EMPRESA ".
               "    AND B.ID_PA = A.ID_PA ".
               "    AND B.DT_INI_PA = A.DT_INI_PA ".
               "    AND B.ID_PROCESSO_AV = A.ID_PROCESSO_AV ".
               "    AND B.DT_INI_PROCESSO = A.DT_INI_PROCESSO ".
               "    AND B.TECNICA_AVALIACAO = A.TECNICA_AVALIACAO ".
               "    AND B.DT_INI_TAP = A.DT_INI_TAP ".
               "    AND B.FONTE_AVALIACAO = A.FONTE_AVALIACAO ".
               "    AND B.DT_INI_FA = A.DT_INI_FA ".
               "    AND A.FICHA_AVAL IN ('D') ".
               "    AND B.PERFIL_ASSOCIADO = :PERFIL_".
               "  ) ".
               "  AND F.EMPRESA = X.EMPRESA ".
               "  AND F.ID_PA = X.ID_PA ".
               "  AND F.DT_INI_PA = X.DT_INI_PA ".
               "  AND F.ID_PROCESSO_AV = X.ID_PROCESSO_AV ".
               "  AND F.DT_INI_PROCESSO = X.DT_INI_PROCESSO ".
               "  AND F.RHID = X.RHID ".
               "  AND F.DT_ADMISSAO = X.DT_ADMISSAO ".
               "  AND F.ESTADO IN ('C','D') ".
               "ORDER BY 5 DESC ";
        
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
        $stmt->bindParam(':PERFIL_', @$_SESSION['perfil'], PDO::PARAM_STR);
        $stmt->execute();
    } catch (Exception $ex) {
        $msg = "av_menu_fichas_aval_colab#1 :" . $ex->getMessage();
    }

    if ($msg == '') {
        try {
            $cnt_corr = 0;
            $cnt_hist = 0;
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ## opção "ad_plano_aval"
                $cnt += 1;

                $key = $row['EMPRESA']."@".
                       $row['ID_PA']."@".
                       $row['DT_INI_PA']."@".
                       $row['ID_PROCESSO_AV']."@".
                       $row['DT_INI_PROCESSO']."@".
                       $row['RHID_AVALIADO']."@".
                       $row['DT_ADMISSAO']."@".
                       $row['RHID_AVALIADOR']."@".
                       $row['ID_FASE']."@".
                       $row['DT_INI_FASE']."@".
                       $row['DT_INI_FPA']."@".
                       $row['DT_INI_AF'];

                $icon_ = "fa-edit";
                if ($row['ESTADO'] == 'C' || $row['ESTADO'] == 'D') { // Submetida
                    $icon_ = "fas fa-check quadColor-Ok";
                } else { // por responder
                    $icon_ = "fa-edit";
                }
                
                if ($row['TERMINADA'] == 'A' || $row['HISTORICO'] == 'N') {
                    # adiciona as fichas de avaliação em curso para um colaborador
                    $cnt_corr += 1;
                    adiciona_interface( $av_correntes, 
                                        "ad_plano_aval_$cnt", 
                                        $row['DSR_PROCESSO'],
                                        $icon_, 
                                        "ajax/ad_employee_evaluation_sheet.php?key=".base64_encode($key),
                                        "ripple grey",
                                        false
                    );                    
                } else {                                        
                    # adiciona as fichas de avaliação em curso para um colaborador
                    $cnt_hist += 1;
                    adiciona_interface( $av_anteriores, 
                                        "ad_plano_aval_$cnt", 
                                        $row['DSR_PROCESSO'],
                                        $icon_, 
                                        "ajax/ad_employee_evaluation_sheet.php?key=".base64_encode($key),
                                        "ripple grey",
                                        false
                    );                    
                }
            }
        } catch (Exception $ex) {
            $msg = "av_menu_fichas_aval_colab#2 :" . $ex->getMessage();
        }    
        if ($cnt_corr == 0) {
            $av_correntes = array();
        }
        if ($cnt_corr == 0) {
            $av_anteriores = array();
        }
    }           

    ## adiciona avaliações correntes
    if (!empty($av_correntes)) {
        $cnt +=1;
        adiciona_conteudo_menu($av_sheets, "ad_$cnt", $av_correntes);  
    }

    ## adiciona avaliações históricas
    if (!empty($av_anteriores)) {
        $cnt +=1;
        adiciona_conteudo_menu($av_sheets, "ad_$cnt", $av_anteriores);  
    }
    
    if ($cnt == 0) {
        $av_sheets = array();
    }
    return $av_sheets;
}            

#
# Controi o nó associado às fichas de avaliação disponíveis nos perfis de chefia (1,2 e 3 Aprovadores)
# devolvendo um array com as opções disponíveis
function av_menu_fichas_aval_chefias(&$msg) {
    
    global  $db
           ,$ui_evaluation_sheets;

    $msg = "";
    $cnt = 0;
    $rhid_ = @$_SESSION['rhid'];
    $perfil_ = @$_SESSION['perfil'];
    
    ## FICHAS AVALIAÇÃO
    $av_sheets = inicializa_no_menu($ui_evaluation_sheets, "fa-arrow-right", "", "", false);

    ## CORRENTES
    $av_correntes = inicializa_no_menu("Correntes", "fa-arrow-right", "", "", false);

    ## ANTERIORES
    $av_anteriores = inicializa_no_menu("Histórico", "fa-arrow-right", "", "", false);

    try {
        
        #
        # FICHA AVAL:
        #       S - Fichas Avaliação
        #       A - Fichas Av.Interm.
        #       B - Entrevista
        #       C - Homogação resultados
        #       D - Concordância
        #       F - Homogação fichas
        #       N - Processual DRH
        #
        $sql = "SELECT X.EMPRESA, X.ID_PA, X.DT_INI_PA, X.ID_PROCESSO_AV, X.DT_INI_PROCESSO,".
               "       X.RHID, X.NOME_AVALIADO, X.NOME_REDZ_AVALIADO, X.DT_ADMISSAO, X.RHID_AVALIADOR, X.ID_FASE, X.DT_INI_FASE, X.DT_INI_FPA, X.DT_INI_AF, ".
               "       X.DSP_PROCESSO, X.DSR_PROCESSO, X.DSP_FASE, X.ESTADO ".
               "FROM MASTER_AVALIACAO X ".
               "WHERE X.ESTADO != 'Z' ".
               "  AND GE_AVALIACAO_HISTORICO(X.ID_PA,X.DT_INI_PA,X.ID_PROCESSO_AV,X.DT_INI_PROCESSO,X.RHID,X.DT_ADMISSAO,X.EMPRESA) = 'N' ".               
               "  AND GE_ESTADO_PROC_AVALIACAO(X.EMPRESA,X.ID_PA,X.DT_INI_PA,X.ID_PROCESSO_AV,X.DT_INI_PROCESSO) IN ('E','F') ".
               "  AND X.RHID_AVALIADOR = :RHID_ ".
               "  AND DATE_FORMAT(X.DT_INI_AVALIACAO,'%Y-%m-%d') <= DATE_FORMAT(SYSDATE(),'%Y-%m-%d') ".
               "  AND (X.EMPRESA, X.ID_PA, X.DT_INI_PA, X.ID_PROCESSO_AV, X.DT_INI_PROCESSO, X.ID_FASE, X.DT_INI_FASE, X.DT_INI_FPA) IN ".
               " (SELECT A.EMPRESA, A.ID_PA, A.DT_INI_PA, A.ID_PROCESSO_AV, A.DT_INI_PROCESSO, A.ID_FASE, A.DT_INI_FASE, A.DT_INI_FPA ".
               "  FROM RH_FASES_FONTES_PROCESSO A ".
               "    , RH_TECNICAS_AVAL_PROCESSO B ".
               "  WHERE B.EMPRESA = A.EMPRESA ".
               "    AND B.ID_PA = A.ID_PA ".
               "    AND B.DT_INI_PA = A.DT_INI_PA ".
               "    AND B.ID_PROCESSO_AV = A.ID_PROCESSO_AV ".
               "    AND B.DT_INI_PROCESSO = A.DT_INI_PROCESSO ".
               "    AND B.TECNICA_AVALIACAO = A.TECNICA_AVALIACAO ".
               "    AND B.DT_INI_TAP = A.DT_INI_TAP ".
               "    AND B.FONTE_AVALIACAO = A.FONTE_AVALIACAO ".
               "    AND B.DT_INI_FA = A.DT_INI_FA ".
               "    AND A.FICHA_AVAL IN ('S','A','F') ".
               # as fichas de avaliação só sao disponibilizadas a partir da data início da fase no processo definida.
               "    AND A.DT_INI_FF <= SYSDATE() ".                
               "    AND B.PERFIL_ASSOCIADO = :PERFIL_) ".
               "UNION ".
               ## nesta query são retornadas todas as fichas que estão para homologação, sendo passada a chave da ficha de avaliação, 
               ## mas a designação da fase é a correspondente à Homologação da ficha de avaliação
               "SELECT X.EMPRESA, X.ID_PA, X.DT_INI_PA, X.ID_PROCESSO_AV, X.DT_INI_PROCESSO,".
               "       X.RHID, X.NOME_AVALIADO, X.NOME_REDZ_AVALIADO, X.DT_ADMISSAO, F.RHID_AVALIADOR, F.ID_FASE, F.DT_INI_FASE, F.DT_INI_FPA, F.DT_INI_AF, ".
               "       X.DSP_PROCESSO, X.DSR_PROCESSO, X.DSP_FASE, F.ESTADO ".
               "FROM MASTER_AVALIACAO X, MASTER_AVALIACAO F ".
               "WHERE X.ESTADO IN ('Z') ".
               "  AND GE_ESTADO_PROC_AVALIACAO(X.EMPRESA,X.ID_PA,X.DT_INI_PA,X.ID_PROCESSO_AV,X.DT_INI_PROCESSO) IN ('E','F') ".
               "  AND GE_AVALIACAO_HISTORICO(X.ID_PA,X.DT_INI_PA,X.ID_PROCESSO_AV,X.DT_INI_PROCESSO,X.RHID,X.DT_ADMISSAO,X.EMPRESA) = 'N' ".               
               "  AND X.RHID_AVALIADOR = :RHID_ ".
               "  AND DATE_FORMAT(X.DT_INI_AVALIACAO,'%Y-%m-%d') <= DATE_FORMAT(SYSDATE(),'%Y-%m-%d') ".
               "  AND (X.EMPRESA, X.ID_PA, X.DT_INI_PA, X.ID_PROCESSO_AV, X.DT_INI_PROCESSO, X.ID_FASE, X.DT_INI_FASE, X.DT_INI_FPA) IN ".
               " (SELECT A.EMPRESA, A.ID_PA, A.DT_INI_PA, A.ID_PROCESSO_AV, A.DT_INI_PROCESSO, A.ID_FASE, A.DT_INI_FASE, A.DT_INI_FPA ".
               "  FROM RH_FASES_FONTES_PROCESSO A ".
               "    , RH_TECNICAS_AVAL_PROCESSO B ".
               "  WHERE B.EMPRESA = A.EMPRESA ".
               "    AND B.ID_PA = A.ID_PA ".
               "    AND B.DT_INI_PA = A.DT_INI_PA ".
               "    AND B.ID_PROCESSO_AV = A.ID_PROCESSO_AV ".
               "    AND B.DT_INI_PROCESSO = A.DT_INI_PROCESSO ".
               "    AND B.TECNICA_AVALIACAO = A.TECNICA_AVALIACAO ".
               "    AND B.DT_INI_TAP = A.DT_INI_TAP ".
               "    AND B.FONTE_AVALIACAO = A.FONTE_AVALIACAO ".
               "    AND B.DT_INI_FA = A.DT_INI_FA ".
               "    AND A.FICHA_AVAL IN ('F') ".
               "    AND B.PERFIL_ASSOCIADO = :PERFIL_".
               "  ) ".
               "  AND F.EMPRESA = X.EMPRESA ".
               "  AND F.ID_PA = X.ID_PA ".
               "  AND F.DT_INI_PA = X.DT_INI_PA ".
               "  AND F.ID_PROCESSO_AV = X.ID_PROCESSO_AV ".
               "  AND F.DT_INI_PROCESSO = X.DT_INI_PROCESSO ".
               "  AND F.RHID = X.RHID ".
               "  AND F.DT_ADMISSAO = X.DT_ADMISSAO ".
               "  AND F.ESTADO IN ('B0','C','B1','D') ".
               "ORDER BY 5 DESC, 15, 11, 6";
        
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
        $stmt->bindParam(':PERFIL_', $perfil_, PDO::PARAM_STR);
        $stmt->execute();
    } catch (Exception $ex) {
        $msg = "av_menu_fichas_aval_chefias#1 :" . $ex->getMessage();
    }

    if ($msg == '') {
        try {
            $proc_ant_ = '';
            $fase_ant_ = '';
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ## opção "ad_plano_aval"
                $cnt += 1;
#echo $row['DSP_PROCESSO']."/".$row['DSP_FASE']."/ > ".$row['RHID']."-".$row['NOME_AVALIADO']." </br>";
                ## Adiciona novo nó de processo ou fase
                if ($proc_ant_ == '' || 
                    $proc_ant_ != $row['DSR_PROCESSO'] || 
                    $fase_ant_ != $row['DSP_FASE'] ) {
                    
                    # novo nó de processo e fase                    
                    if ($proc_ant_ == '') {
                        $menu_proc = inicializa_no_menu($row['DSR_PROCESSO'], "fa-arrow-right", "", "", false);
                        $menu_fase = inicializa_no_menu($row['DSP_FASE'], "fa-arrow-right", "", "", false);
                    }
                    elseif ($proc_ant_ != $row['DSR_PROCESSO']) {
                        
                        # adiciona o menu da fase ao menu do processo
                        adiciona_conteudo_menu($menu_proc, "ad_".$fase_ant_."_$cnt", $menu_fase);  

                        # adiciona o menu do processo ao menu principal
                        adiciona_conteudo_menu($av_sheets, "ad_".$proc_ant_."_$cnt", $menu_proc);  

                        # reinicializa o menu de processo e de fase
                        $menu_proc = inicializa_no_menu($row['DSR_PROCESSO'], "fa-arrow-right", "", "", false);
                        $menu_fase = inicializa_no_menu($row['DSP_FASE'], "fa-arrow-right", "", "", false);
                        
                    } 
                    elseif ($fase_ant_ != $row['DSP_FASE']) {
                        # adiciona o menu da fase ao menu do processo
                        adiciona_conteudo_menu($menu_proc, "ad_".$fase_ant_."_$cnt", $menu_fase);  

                        # reinicializa o menu de processo e de fase
                        $menu_fase = inicializa_no_menu($row['DSP_FASE'], "fa-arrow-right", "", "", false);
                        
                    }
                        
                    $proc_ant_ = $row['DSR_PROCESSO'];
                    $fase_ant_ = $row['DSP_FASE'];
                }

                $key = $row['EMPRESA']."@".
                       $row['ID_PA']."@".
                       $row['DT_INI_PA']."@".
                       $row['ID_PROCESSO_AV']."@".
                       $row['DT_INI_PROCESSO']."@".
                       $row['RHID']."@".
                       $row['DT_ADMISSAO']."@".
                       $row['RHID_AVALIADOR']."@".
                       $row['ID_FASE']."@".
                       $row['DT_INI_FASE']."@".
                       $row['DT_INI_FPA']."@".
                       $row['DT_INI_AF'];
                # adiciona as fichas de avaliação em curso para um colaborador
                $icon_ = "fa-edit";
                if ($row['ESTADO'] == 'C' || $row['ESTADO'] == 'D') { // Submetida
                    $icon_ = "fas fa-check quadColor-Ok";
                }
                elseif ($row['ESTADO'] == 'B0') { // Para Homologação Homologada
                    $icon_ = "fa-edit";
                } 
                elseif ($row['ESTADO'] == 'B1') { // Não Homologada
                    $icon_ = "fas fa-times quadColor-Nok";
                } 
                else { // por responder
                    $icon_ = "fa-edit";
                }
                adiciona_interface( $menu_fase, 
                                    "ad_plano_aval_$cnt", 
                                    $row['RHID']." - ".$row['NOME_REDZ_AVALIADO'],
                                    $icon_, 
                                    "ajax/ad_employee_evaluation_sheet.php?key=".base64_encode($key),
                                    "ripple grey",
                                    false
                );                    
            }
        } catch (Exception $ex) {
            $msg = "av_menu_fichas_aval_chefias#2 :" . $ex->getMessage();
        }
        
        # adiciona o menu da fase ao menu do processo
        if (!empty($menu_fase)) {
            adiciona_conteudo_menu($menu_proc, "ad_".$fase_ant_."_$cnt", $menu_fase);  
        }

        # adiciona o menu do processo ao menu principal
        if (!empty($menu_proc)) {
            adiciona_conteudo_menu($av_sheets, "ad_".$proc_ant_."_$cnt", $menu_proc);  
        }
#        if ($cnt != 0) {
#            $cnt += 1;
#            adiciona_conteudo_menu($av_sheets, "ad_$cnt", $av_correntes);  
#        }
        
    }   
    if ($cnt < 1) {
      $av_sheets = array();
    }
    return $av_sheets;
}            

#
# Controi o nó associado aos resultados de avaliação disponíveis no perfil de colaborador
# devolvendo um array com as opções disponíveis
function av_menu_resultados_colab(&$msg) {

    global  $db
           ,$ui_eval_results;

    $msg = "";
    $cnt = 0;
    $rhid_ = @$_SESSION['rhid'];
    $av_results = inicializa_no_menu($ui_eval_results, "fa-arrow-right", "", "", false);
    
    ## CORRENTES
    $av_correntes = inicializa_no_menu("Correntes", "fa-arrow-right", "", "", false);

    ## ANTERIORES
    $av_anteriores = inicializa_no_menu("Histórico", "fa-arrow-right", "", "", false);

    try {
        $sql = "SELECT A.EMPRESA, A.ID_PA, A.DT_INI_PA, A.ID_PROCESSO_AV, A.DT_INI_PROCESSO,".
               "       A.RHID_AVALIADO, A.DT_ADMISSAO, A.RHID_AVALIADOR, A.ID_FASE, A.DT_INI_FASE, A.DT_INI_FPA, A.DT_INI_AF, ".
               "       B.DSR_PROCESSO, ".
               "       GE_AVALIACAO_HISTORICO(A.ID_PA,A.DT_INI_PA,A.ID_PROCESSO_AV,A.DT_INI_PROCESSO,A.RHID_AVALIADO,A.DT_ADMISSAO,A.EMPRESA) AS HISTORICO ".                
               "FROM RH_AVALIADOR_FASES A, RH_PROCESSOS_AVALIACAO B ".
               "WHERE GE_PUB_RESULTADOS(A.EMPRESA,A.ID_PA,A.DT_INI_PA,A.ID_PROCESSO_AV,A.DT_INI_PROCESSO,A.RHID_AVALIADO,A.DT_ADMISSAO) = 'S' ".
               "  AND GE_ESTADO_PROC_AVALIACAO(B.EMPRESA,B.ID_PA,B.DT_INI_PA,B.ID_PROCESSO_AV,B.DT_INI_PROCESSO) IN ('E','F') ".
               "  AND A.RHID_AVALIADO = :RHID_ ".
              #"  AND A.RHID_AVALIADOR = :RHID_ ".
               "  AND A.ESTADO != 'Z' ".
               "  AND B.EMPRESA = A.EMPRESA ".
               "  AND B.ID_PA = A.ID_PA ".
               "  AND B.DT_INI_PA = A.DT_INI_PA ".
               "  AND B.ID_PROCESSO_AV = A.ID_PROCESSO_AV ".
               "  AND B.DT_INI_PROCESSO = A.DT_INI_PROCESSO ".
               "  AND DATE_FORMAT(B.DT_INI_AVALIACAO,'%Y-%m-%d') <= DATE_FORMAT(SYSDATE(),'%Y-%m-%d') ".
               "ORDER BY A.DT_INI_PROCESSO DESC ";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
        $stmt->execute();
    } catch (Exception $ex) {
        $msg = "av_menu_resultados_colab#1 :" . $ex->getMessage();
    }

    if ($msg == '') {
        try {
            $cnt_corr = 0;
            $cnt_hist = 0;
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ## opção "ad_plano_aval"
                $cnt += 1;

                $key = $row['EMPRESA']."@".
                       $row['ID_PA']."@".
                       $row['DT_INI_PA']."@".
                       $row['ID_PROCESSO_AV']."@".
                       $row['DT_INI_PROCESSO']."@".
                       $row['RHID_AVALIADO']."@".
                       $row['DT_ADMISSAO'];
                
                if ($row['HISTORICO'] == 'N') {
                    # adiciona os nós de resultados para um colaborador -- corrente
                    $cnt_corr += 1;
                    adiciona_interface( $av_correntes, 
                                        "ad_results_$cnt", 
                                        $row['DSR_PROCESSO'],
                                        "fa-edit", 
                                        "ajax/ad_employee_results.php?key=".base64_encode($key),
                                        "ripple grey",
                                        false
                    );
                } else {
                    # adiciona os nós de resultados para um colaborador -- histórico
                    $cnt_hist += 1;
                    adiciona_interface( $av_anteriores, 
                                        "ad_results_$cnt", 
                                        $row['DSR_PROCESSO'],
                                        "fa-edit", 
                                        "ajax/ad_employee_results.php?key=".base64_encode($key),
                                        "ripple grey",
                                        false
                    );
                }
                    
            }
        } catch (Exception $ex) {
            $msg = "av_menu_resultados_colab#2 :" . $ex->getMessage();
        } 
        
        if ($cnt_corr == 0) {
            $av_correntes = array();
        }
        
        if ($cnt_hist == 0) {
            $av_anteriores = array();
        }
    }            

    ## adiciona avaliações correntes
    if (!empty($av_correntes)) {
        $cnt +=1;
        adiciona_conteudo_menu($av_results, "ad_$cnt", $av_correntes);  
    }

    ## adiciona avaliações históricas
    if (!empty($av_anteriores)) {
        $cnt +=1;
        adiciona_conteudo_menu($av_results, "ad_$cnt", $av_anteriores);  
    }
    
    if ($cnt == 0) {
        $av_results = array();
    }
    return $av_results;
}            


#
# Controi o nó associado aos resultados de avaliação disponíveis no perfil de chefia
# devolvendo um array com as opções disponíveis
function av_menu_resultados_chefias(&$msg) {
    
    global  $db
           ,$ui_eval_results;

    $msg = "";
    $cnt = 0;
    $rhid_ = @$_SESSION['rhid'];
    $perfil_ = @$_SESSION['perfil'];
    
    $av_results = inicializa_no_menu($ui_eval_results, "fa-arrow-right", "", "", false);

    try {
        
        #
        # FICHA AVAL:
        #       S - Fichas Avaliação
        #       A - Fichas Av.Interm.
        #       B - Entrevista
        #       C - Homogação
        #       D - Concordância
        #       N - Processual DRH
        #
        $sql = "SELECT DISTINCT X.EMPRESA, X.ID_PA, X.DT_INI_PA, X.ID_PROCESSO_AV, X.DT_INI_PROCESSO,".
               "       X.RHID, X.NOME_REDZ_AVALIADO, X.DT_ADMISSAO, X.DSP_PROCESSO  ".
               "FROM MASTER_AVALIACAO X ".
               "WHERE GE_PUB_RESULTADOS(EMPRESA,ID_PA,DT_INI_PA,ID_PROCESSO_AV,DT_INI_PROCESSO,RHID,DT_ADMISSAO) = 'S' ".
               "  AND GE_ESTADO_PROC_AVALIACAO(X.EMPRESA,X.ID_PA,X.DT_INI_PA,X.ID_PROCESSO_AV,X.DT_INI_PROCESSO) IN ('E','F') ".
               #"  AND X.ESTADO != 'Z' ".
               "  AND X.RHID_AVALIADOR = :RHID_ ".
               "  AND DATE_FORMAT(X.DT_INI_AVALIACAO,'%Y-%m-%d') <= DATE_FORMAT(SYSDATE(),'%Y-%m-%d') ".
               "  AND (X.EMPRESA, X.ID_PA, X.DT_INI_PA, X.ID_PROCESSO_AV, X.DT_INI_PROCESSO, X.ID_FASE, X.DT_INI_FASE, X.DT_INI_FPA) IN ".
               " (SELECT A.EMPRESA, A.ID_PA, A.DT_INI_PA, A.ID_PROCESSO_AV, A.DT_INI_PROCESSO, A.ID_FASE, A.DT_INI_FASE, A.DT_INI_FPA ".
               "  FROM RH_FASES_FONTES_PROCESSO A ".
               "    , RH_TECNICAS_AVAL_PROCESSO B ".
               "  WHERE B.EMPRESA = A.EMPRESA ".
               "    AND B.ID_PA = A.ID_PA ".
               "    AND B.DT_INI_PA = A.DT_INI_PA ".
               "    AND B.ID_PROCESSO_AV = A.ID_PROCESSO_AV ".
               "    AND B.DT_INI_PROCESSO = A.DT_INI_PROCESSO ".
               "    AND B.TECNICA_AVALIACAO = A.TECNICA_AVALIACAO ".
               "    AND B.DT_INI_TAP = A.DT_INI_TAP ".
               "    AND B.FONTE_AVALIACAO = A.FONTE_AVALIACAO ".
               "    AND B.DT_INI_FA = A.DT_INI_FA ".
               "    AND B.PERFIL_ASSOCIADO = :PERFIL_ ".
               "    AND A.FICHA_AVAL IN ('S','A','C') ) ".
               "ORDER BY X.DT_INI_PROCESSO DESC, X.DSP_PROCESSO, X.ID_FASE, X.RHID";
        
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
        $stmt->bindParam(':PERFIL_', $perfil_, PDO::PARAM_STR);
        $stmt->execute();
    } catch (Exception $ex) {
        $msg = "av_menu_resultados_chefias#1 :" . $ex->getMessage();
    }

    if ($msg == '') {
        try {
            $proc_ant_ = '';
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ## opção "ad_plano_aval"
                $cnt += 1;
#echo $row['DSP_PROCESSO']."/".$row['DSP_FASE']."/ > ".$row['RHID']."-".$row['NOME_AVALIADO']." </br>";
                ## Adiciona novo nó de processo ou fase
                if ($proc_ant_ == '' || 
                    $proc_ant_ != $row['DSP_PROCESSO']) {
                    
                    # novo nó de processo e fase                    
                    if ($proc_ant_ == '') {
                        $menu_proc = inicializa_no_menu($row['DSP_PROCESSO'], "fa-arrow-right", "", "", false);
                    }
                    elseif ($proc_ant_ != $row['DSP_PROCESSO']) {
                        
                        # adiciona o menu do processo ao menu principal
                        adiciona_conteudo_menu($av_results, "ad_".$proc_ant_."_$cnt", $menu_proc);  

                        # reinicializa o menu de processo e de fase
                        $menu_proc = inicializa_no_menu($row['DSP_PROCESSO'], "fa-arrow-right", "", "", false);
                        
                    } 
                        
                    $proc_ant_ = $row['DSP_PROCESSO'];
                }

                $key = $row['EMPRESA']."@".
                       $row['ID_PA']."@".
                       $row['DT_INI_PA']."@".
                       $row['ID_PROCESSO_AV']."@".
                       $row['DT_INI_PROCESSO']."@".
                       $row['RHID']."@".
                       $row['DT_ADMISSAO'];
                # adiciona as fichas de avaliação em curso para um colaborador
                adiciona_interface( $menu_proc, 
                                    "ad_plano_aval_$cnt", 
                                    $row['RHID']." - ".$row['NOME_REDZ_AVALIADO'],
                                    "fa-edit", 
                                    "ajax/ad_employee_results.php?key=".base64_encode($key),
                                    "ripple grey",
                                    false
                );                    
            }
        } catch (Exception $ex) {
            $msg = "av_menu_resultados_chefias#2 :" . $ex->getMessage();
        }
        
        if ($cnt == 0) {
            $av_results = array();
        }
        
        # adiciona o menu do processo ao menu principal
        if (!empty($menu_proc)) {
            adiciona_conteudo_menu($av_results, "ad_".$proc_ant_."_$cnt", $menu_proc);  
        }
        
    }           
    
    return $av_results;
}            

##
## Tratamento de LÍNGUAS na plataforma
##

#
# função que devolve o alias da língua de acordo com a língua selecionadas
#
function decode_lang () {
   $lang = @$_SESSION['lang'];

   if ($lang == 'pt')
       return 0;
   else if ($lang == 'uk')
       return 1;
   else if ($lang == 'de') //Deutch
       return 2;
   else if ($lang == 'es') //Spanish
       return 3;
   else if ($lang == 'us')
       return 4;
}

#
# função que devolve a designação de língua de acordo com o código indicado
#
function dsp_lang($codigo_lang, &$msg) {

    global $db;

    $msg = '';
    $dsp = "";
    try {
        $stmt = $db->prepare("SELECT w.DSP_LINGUA ".
                               "FROM DG_LINGUAS_ESTRANGEIRAS w ".
                               "WHERE w.CODIGO = :CODIGO_ ");
        $stmt->bindParam(':CODIGO_', $codigo_lang, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $dsp = $row['DSP_LINGUA'];
    } catch (Exception $ex) {
        $msg = "dsp_lang#1 :" . $ex->getMessage();
    }
    return $dsp;
}

#
# função que devolve a designação de língua de acordo com o código indicado
#
function available_langs(&$msg) {

    global $db;

    $msg = '';
    $html_ = "";
    try {
        $stmt = $db->prepare("SELECT w.* ".
                               "FROM DG_LINGUAS_ESTRANGEIRAS w ".
                               "WHERE w.ATIVO = 'S' ".
                               "ORDER BY w.NR_ORDEM ");
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            # testa se o ficheiro de línguas se encontra disponível na plataforma
            $existe_ficheiro =  file_exists(dirname(__FILE__)."/lang/quad_labels_" . $row['CODIGO'] . ".php");
            #$existe_ficheiro = true;
            if (true) {

                if (!$existe_ficheiro) {
                    $html_ .= "<li class='not-available'>";
                } elseif (@$_SESSION['lang'] == $row['CODIGO'] ) {
                    $html_ .= "<li class='active'>";
                } else {
                    $html_ .= "<li>";
                }
                $html_ .= '<a href="javascript:void(0);"><img src="'.ASSETS_URL.'/img/blank.gif" class="'.$row['FLAG_CLASSES'].'" alt="'.$row['DSR_LINGUA'].'">&nbsp&nbsp'.$row['DSP_LINGUA'].'</a>';

                $html_ .= "</li>";
            }
        }

    } catch (Exception $ex) {
        $msg = "available_langs#1 :" . $ex->getMessage();
    }
    return $html_;
}


##
## Tratamento de tempo
##

#
# Seleção de colaboradores
#
function info_colabs_gtempo($empresa, $cd_setor, $dt_setor, $rhid, $ano_mes_fim, $dt_fim_mes, $offset, $reg_pag, &$cnt, &$result) {

    global $db;
    
    $msg = '';
    $result = array();
    $cnt = 0;

    $sql = "SELECT DISTINCT I.RHID, I.NOME, I.NOME_REDZ, E.DT_ADMISSAO, E.DT_DEMISSAO " .
           "FROM RH_IDENTIFICACOES I, RH_ID_EMPRESAS E, rh_id_profissionais P ";

    if ($cd_setor != '' && $dt_setor != '') {
          $sql .=   ",(SELECT x.EMPRESA, x.CD_ESTAB, x.RHID, x.DT_ADMISSAO, x.ID_SETOR, x.DT_INI_SETOR, DATE_FORMAT(x.DT_INI,'%Y-%m-%d') DT_INI ".
                    "  FROM RH_ID_SETORES x  ".
                    "  WHERE '$ano_mes_fim' BETWEEN DATE_FORMAT(x.DT_INI,'%Y-%m') AND IFNULL(DATE_FORMAT(x.DT_FIM,'%Y-%m'),'$ano_mes_fim')  ".
                    ") SS ";
    }

    $sql .= "WHERE I.RHID = E.RHID " .
            "  AND P.EMPRESA = E.EMPRESA " .
            "  AND P.RHID = E.RHID " .
            "  AND P.DT_ADMISSAO = E.DT_ADMISSAO " .
            "  AND DATE_FORMAT(E.DT_ADMISSAO,'%Y-%m-%d') <= '$dt_fim_mes' ";

    $sql .= "  AND E.CD_SITUACAO IN (SELECT CD_SITUACAO FROM RH_DEF_SITUACOES WHERE TRATAMENTO_PONTO = 'S' OR RECIBO = 'S') ".
            "  AND (E.DT_DEMISSAO IS NULL OR DATE_FORMAT(E.DT_DEMISSAO,'%Y-%m') >= '$ano_mes_fim') ";

    if ($cd_setor != '' && $dt_setor != '') {
        $sql .=  " AND SS.EMPRESA = E.EMPRESA  AND SS.CD_ESTAB = E.CD_ESTAB AND SS.RHID = E.RHID AND SS.DT_ADMISSAO = E.DT_ADMISSAO AND SS.ID_SETOR = '$cd_setor' AND SS.DT_INI_SETOR = '$dt_setor' ";
    }

    if ($rhid != '') {  # próprio colaborador ou a pedido para um empregado específico (visões de chefia)
        if ($rhid != '') {
            $sql .= " AND I.RHID = " . $rhid . " ";
        } else {
            $sql .= " AND I.RHID = " . @$_SESSION['rhid'] . " ";
        }
    }
    elseif (@$_SESSION['perfil'] == 'B')    { # gestor administrativo
        $sql .= " AND (E.RHID_GESTOR_ADM = " . @$_SESSION['rhid'] . " OR I.RHID = " . @$_SESSION['rhid'] . ") ";
    } elseif (@$_SESSION['perfil'] == 'C')  { # supervisor
        $sql .= " AND (E.RHID_SUPERVISOR = " . @$_SESSION['rhid'] . " OR I.RHID = " . @$_SESSION['rhid'] . ") ";
    } elseif (@$_SESSION['perfil'] == 'D')  { # director
        $sql .= " AND (E.RHID_DIRECTOR = " . @$_SESSION['rhid'] . " OR I.RHID = " . @$_SESSION['rhid'] . ") ";
    } elseif (@$_SESSION['perfil'] == 'F' || # dep.recursos humanos
                @$_SESSION['perfil'] == 'E' || # Gestor - outsourcing
                @$_SESSION['perfil'] == 'W' || # Consulta
                @$_SESSION['perfil'] == 'Y' || # Preparador Escalas
                @$_SESSION['perfil'] == 'Z')   # Administrador
        null;

    if ($empresa != '')
        $sql .= " AND E.EMPRESA = '$empresa' ";

    ## TODO: filtragem por estabelecimento
    #$sql = filtro_estab($query1,'E');
    $sql .= " ORDER BY 1 ";

    try {
        $stmt = $db->prepare($sql);
        #$stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
        $stmt->execute();
        $cnt = $stmt->rowCount();
    } catch (Exception $ex) {
        $msg = "info_colabs_gtempo#1 :" . $ex->getMessage();
    }

    if ($msg == '') {
        try {
            $sql .= " LIMIT $offset,$reg_pag ";
            $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            #$stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt;
        } catch (Exception $ex) {
            $msg = "info_colabs_gtempo#1 :" . $ex->getMessage();
        }
    }
}

#
# Devolve um timestamp correspondente a uma data
#
function safe_strtotime($string) {
    if(!preg_match("/\d{4}/", $string, $match)) {
        return null; //year must be in YYYY form
    }

    $year = intval($match[0]);//converting the year to integer

    if ($year >= 1970) {
        return date("Y-m-d", strtotime($string));//the year is after 1970 - no problems even for Windows
    }
    else {
#	if(stristr(PHP_OS, "WIN") && !stristr(PHP_OS, "DARWIN")) { //OS seems to be Windows, not Unix nor Mac
            $diff = 1975 - $year;//calculating the difference between 1975 and the year
            $new_year = $year + $diff;//year + diff = new_year will be for sure > 1970
            $new_date = date("Y-m-d", strtotime(str_replace($year, $new_year, $string)));//replacing the year with the new_year, try strtotime, rendering the date
            return str_replace($new_year, $year, $new_date);//returning the date with the correct year
    }
}

#
# Formata uma data
#
function data($dt) {
    if ($dt != '' && strlen($dt) >= 10) {
        $res = safe_strtotime($dt);
        if ($res == '1970-01-01') {
            $res = $dt;
        }
        return $res;
    } else {
        return '';
    }
}

#
# Indicação se a semana se inicia ao Domingo ou à Segunda
#
function inicio_semana() {
#      if (instalacao('DECATHLON'))
#              return 'DOM';
#      else
              return 'SEG';
#              return 'DOM';
}

#
# Retorna o número de dias entre duas datas
#
function days_between($dt1, $dt2) {

      $d1 = strtotime($dt1);

      ## para corrigir o problema do strtotime em dias com 31
      $d2 = strtotime($dt2 .'-01 00:00:01');

      $datediff = $d2 - $d1;
      $res = floor($datediff/(60*60*24));

      return $res;
}

#
# Retorna a semana do ano a que corresponde uma data
#
function semana_ano($dt, &$ano, &$semana) {

    $ano = '';
    $semana = '';

    # semana começa ao Domingo
    if (inicio_semana() == 'DOM') {

            $param = explode("-",$dt);
            $ano = $param[0];
            $mes = $param[1];
            $dia = $param[2];

            $first_sun_year = strtotime("sun jan $ano");

            $dif = days_between (date("Y-m-d",$first_sun_year), $dt);

            $semana = (floor($dif/7)) + 1;

            if ($semana > 52) {
               $semana = 1;
               $ano = $ano + 1;
            }

            ## ano iniciou-se em dif negativo => soma 1 semana
            $dif_ini = days_between (date("Y-m-d",$first_sun_year),"$ano-01-01");
            if ($dif_ini < 0)
                    $semana += 1;

            # verificar a semana do ano anterior
            if ($semana == 0) {
                    # como o dia 28 de dezembro pertence sempre à ultima semana do ano..
                    $ano = $ano - 1;
                    $semana = date("W",strtotime("$ano-12-27"));
            }

    } else { # por defeito começa à segunda -  ISO-8601
            $default_timestamp = date_default_timezone_get();
            date_default_timezone_set('UTC');
            $week_S = date("Y-W",strtotime($dt));
            $param = explode("-",$week_S);

            $ano = $param[0];
            $semana = $param[1];## + 1;
            date_default_timezone_set($default_timestamp);
    }
}

#
# Retorna a data do primeiro dia de uma semana
#
function primeiro_dia_semana($ano, $semana) {

    $res = '';

    # semana começa ao Domingo
    if (inicio_semana() == 'DOM') {
            ## particularidade: quando a 1 semana do ano se inicia antes do início do ano...
            $first_sun_year = strtotime("sun jan $ano");
            $dif_ini = days_between (date("Y-m-d",$first_sun_year),"$ano-01-01");
            if ($dif_ini < 0) {
               $semana -= 1;
            }

            $timestamp = mktime( 0, 0, 0, 1, 1,  $ano ) + ( $semana * 7 * 24 * 60 * 60 );
            $timestamp_for_monday = $timestamp - 86400 * ( date( 'N', $timestamp ));
            $date_for_sunday = date( 'Y-m-d', $timestamp_for_monday );
            $res = $date_for_sunday;
    } else { # por defeito começa à segunda -  ISO-8601
            $semana = $semana - 1;
            $timestamp = mktime( 0, 0, 0, 1, 1,  $ano ) + ( $semana * 7 * 24 * 60 * 60 );
            $timestamp_for_monday = $timestamp - 86400 * ( date( 'N', $timestamp ) - 1 );
            $date_for_monday = date( 'Y-m-d', $timestamp_for_monday );
            $res = $date_for_monday;
    }

    return $res;
}



##
## Funções específicas do GERADOR DE INTERFACES
##


function quad_table_details ($table) {

    global $db, $dateformat, $datetimeformat;
    $msg = '';
    $result = '';
    $db_info = '';
    $query = "SELECT QUAD_TABLE_DETAILS ('".$table."') HTML ".
             "FROM DUAL";

    $query = "BEGIN QUAD_TABLE_DETAILS (:table, :html, :db_info); END;";

    $res = oci_parse( $db, $query );
    $result = oci_new_descriptor($db, OCI_D_LOB);

    oci_bind_by_name($res,':table',$table,32);
    oci_bind_by_name($res,':html', $result,-1,OCI_B_CLOB);
    oci_bind_by_name($res,':db_info',$db_info,32);

    $isQueryOk = oci_execute($res);
    if ($isQueryOk) {
        oci_free_statement($res);
        if ($db_info != '') {
            $devolve['html_'] = $result;
            $devolve['info'] = $db_info;
            return $devolve; //$result->append('[["'.$db_info.'"]]');
        } else {
            $devolve['html_'] = $result;
            $devolve['info'] = $db_info;
            return $devolve; //$result;
        }
    }
    else {
        $msg = "Error FETCHING ALL [$query] on prs_tree_processos";
    }

    /*
    if ($isQueryOk) {
        while (($row = oci_fetch_array($res, OCI_ASSOC+OCI_RETURN_LOBS)) != false) {
             $result = $row['HTML'];
        }
        oci_free_statement($res);
        return $result;
    }
    else {
        $msg = "Error FETCHING ALL [$query] on prs_tree_processos";
    }
    //echo json_encode($results);
     */
}

function dbtables_output($data, $nr_rows ) {
    class Lista {
        public $id;
        public $valor;
    }

    $out = array();
    $i = 0;

    foreach ($data as $linha) { // ($i = 0, $ien = $cnt; $i < $ien; $i++) {
        $row = new Lista();
        $row->id = $i;
        /*$row->tipo = $linha['TYPE']; */
        $row->valor = $linha['VALUE'];
        $out[] = $row;
        ++$i;
    }
    return $out;
}

function quad_tables () {
    global $db;
    $msg = '';
    $result = '';
    $query = "SELECT 'Tables' TYPE, A.TABLE_NAME VALUE ".
             "FROM USER_TABLES A ".
             "WHERE A.TABLE_NAME LIKE 'DG%' OR A.TABLE_NAME LIKE 'QUAD%' OR A.TABLE_NAME LIKE 'PRS%' OR A.TABLE_NAME LIKE 'RH%' ".
             "UNION ".
             "SELECT 'Views' TYPE, A.VIEW_NAME VALUE ".
             "FROM USER_VIEWS A ".
             "ORDER BY 1,2";
             //" OFFSET 0 ROWS FETCH NEXT 30 ROWS ONLY";

    $res = oci_parse( $db, $query );
    // Execute Query
    $isQueryOk = oci_execute($res);
    if ($isQueryOk) {
        $nr_rows = oci_fetch_all($res, $data, 0, -1, OCI_FETCHSTATEMENT_BY_ROW);
        $result = dbtables_output($data, $nr_rows);
        oci_free_statement($res);
        return json_encode($result);
    }
    else {
        $msg = "Error FETCHING ALL [$query] on quad_tables";
    }
    //echo json_encode($results);
}


##
## Funções específicas do PRS
##

#
# Qual o Ano/Mês aberto para uma dada Empresa? Devolve nullos se não houver... */
#
function prs_mes_aberto ($empresa, &$ano, &$mes, &$dt_ini, &$dt_fim) {
    global $db;
    $msg = '';
    $result = '';
    $ano_aberto = '';
    $mes_aberto = '';
    $ok = false;

    #ANO/MES ABERTO
    $sql = "SELECT A.ANO, A.MES, TO_CHAR(A.DT_INICIO,'YYYY-MM-DD') DT_INICIO, TO_CHAR(A.DT_FIM,'YYYY-MM-DD') DT_FIM " .
            "FROM PRS_MESES A " .
            "WHERE A.EMPRESA=:empresa_ " .
            "  AND ESTADO = 'A'";

    $stid = oci_parse($db, $sql);
    //echo "<br/>".$sql."<br/>";
    oci_bind_by_name($stid, ':empresa_', $empresa);
    oci_execute($stid);
    while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false) {
        $ok = true;
        $ano = $row['ANO'];
        $mes = $row['MES'];
        $dt_ini = $row['DT_INICIO'];
        $dt_fim = $row['DT_FIM'];
    }

    oci_free_statement($stid);
    oci_close($db);

    //if (!$ok) {
    //    $msg = $error_user_invalid;
    //}
}

#
# Usado nomeadamente nas ALOCAÇÕES e no REGISTO MANUAL DE PRODUÇÃO,
# devolve Empresa, Direção e Departamento e dt_admissão de um user ATIVO (data de demissão elegível)
#
function getMyInfo($rhid, &$msg) {

    global $db, $empresa_, $dt_adm_, $cd_direcao_, $dt_ini_direcao_, $cd_dept_, $dt_ini_dept_, $error_user_invalid;
    $msg = '';
    $result = '';
    $ok = false;

    #RHID information
    $sql = "SELECT A.EMPRESA, to_char(A.DT_ADMISSAO,'YYYY-MM-DD') DT_ADMISSAO, A.CD_DIRECAO, to_char(A.DT_INI_DIRECAO,'YYYY-MM-DD') DT_INI_DIRECAO, " .
            "A.CD_DEPT, to_char(A.DT_INI_DEPT,'YYYY-MM-DD') DT_INI_DEPT " .
            "FROM PRS_EMPLOYEE A " .
            "WHERE A.RHID=:rhnum " .
            "  AND SYSDATE BETWEEN A.DT_ADMISSAO AND NVL(A.DT_DEMISSAO-1,SYSDATE) " .
            "  AND SYSDATE BETWEEN A.DT_INI AND NVL(A.DT_FIM,SYSDATE)";

    $stid = oci_parse($db, $sql);
    //echo "<br/>".$sql."<br/>";
    oci_bind_by_name($stid, ':rhnum', $rhid);
    oci_execute($stid);
    while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false) {
        $ok = true;
        $empresa_ = $row['EMPRESA'];
        $dt_adm_ = $row['DT_ADMISSAO'];
        $cd_direcao_ = $row['CD_DIRECAO'];
        $dt_ini_direcao_ = $row['DT_INI_DIRECAO'];
        $cd_dept_ = $row['CD_DEPT'];
        $dt_ini_dept_ = $row['DT_INI_DEPT'];
    }

    oci_free_statement($stid);
    oci_close($db);

    if (!$ok) {
        $msg = $error_user_invalid;
    }
}

#
# Tratamento de árvore de processos
#
function prs_tree_processos () {

    global $db, $dateformat, $datetimeformat;
    $msg = '';
    $result = '';
    $cd_lang = decode_lang();

    $query = "SELECT a.HTML ".
             "FROM prs_tree_proc a ".
             "start with parent_ = 0 connect by prior id = parent_";

    $res = oci_parse( $db, $query );
    $isQueryOk = oci_execute($res);

    if ($isQueryOk) {
        while (($row = oci_fetch_assoc($res)) != false) {
            $result .= $row['HTML'];
        }
        oci_free_statement($res);
        return $result;
    }
    else {
        $msg = "Error FETCHING ALL [$query] on prs_tree_processos";
    }
    //echo json_encode($results);
}

#
# Descodificação de turnos
#
function dsp_turno ($empresa, $turno, $dt_turno, $mode) {

    global $db, $dateformat, $datetimeformat;
    $msg = '';
    $result = [];

    $query = "SELECT HRS_PRESENCA, HRS_REFEICAO, DG_LIB.DSP_DOMINIO('PRS_TP_DIA',TP_DIA_INI) TP_INI, FAIXA_INI, ".
                    " DG_LIB.DSP_DOMINIO('PRS_TP_DIA',TP_DIA_FIM) TP_FIM, FAIXA_FIM ".
             "FROM PRS_TURNOS ".
             "WHERE EMPRESA = '$empresa' AND ID_TURNO = '$turno' AND TO_CHAR(DT_INI_TURNO,'YYYY-MM-DD') = '$dt_turno' ";

    ////$query .= "ORDER BY NVL(to_char(a.NR_ORDEM), a.EMPRESA) ";
    //echo $query;
    $res = oci_parse( $db, $query );
    $isQueryOk = oci_execute($res);

    if ($isQueryOk) {
        while (($row = oci_fetch_assoc($res)) != false) {
            array_push($result, $row);
        }
        oci_free_statement($res);
        return $result;
    }
    else {
        $msg = "Error FETCHING ALL [$query] on dsp_turno";
    }

    //echo json_encode($results);
}


# converte data ($d) YYYY-MM-DD e hora $e HH24:MI em representação numérica de data do PHP
function get_gtime($d, $e) {
    $var_e = '';
    if ($e != '') {
        $date_array = explode("-",$d);
        $year = '';
        $month = '';
        $day = '';
        if (count($date_array) > 2) {
            $year = $date_array[0];
            $month = $date_array[1];
            $day = $date_array[2];
        }
        
        $time_array = explode(":",$e);
        $hour = '';
        $min = '';
        if (count($time_array) > 1) {
            $hour = $time_array[0];
            $min = $time_array[1];
        }
        
        if ($hour != '' && $min != '' && $month != '' && $day != '' && $year != '') {
            $var_e = gmmktime($hour,$min,0,$month,$day,$year);
        }
    }

      return $var_e;
}

# converte minutos em HH:MM
function convertToHH_MI($time) {
    $format = '%02d:%02d';
    if ($time < 1 || $time == '') {
        return "00:00";
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return sprintf($format, $hours, $minutes);
}

/* Obtem os minutos entre duas datas/hora */
function minutesBetweenDates($dt1, $dt2) {

    $minutos = 0;
    $data1 = substr($dt1,0,10);
    $hr1 = substr($dt1,11,5);

    $data2 = substr($dt2,0,10);
    $hr2 = substr($dt2,11,5);
    $var_e = get_gtime($data1, $hr1);
    $var_s = get_gtime($data2, $hr2);

    if ($var_e != '' && $var_s != '') {
        $minutos += ($var_s - $var_e)/60;
        if (date("i",$var_s) == '59') {
            $minutos += 1;
        }
    }
    return $minutos;
}

//TIME LAPSED FROM date to NOW
function duration($ts) {
    global $ui_years, $ui_year, $ui_months, $ui_month, $ui_week, $ui_weeks, $ui_day, $ui_days, $ui_hour, $ui_hours, $ui_minute, $ui_minutes;
    $time = time(); //NOW
    $ts = strtotime($ts);
    //$ts = date('Y-m-d',$ts);
    $years = (int)((($time - $ts)/(7*86400))/52.177457);
    $rem = (int)(($time-$ts)-($years * 52.177457 * 7 * 86400));
    $weeks = (int)(($rem)/(7*86400));
    $days = (int)(($rem)/86400) - $weeks*7;
    $hours = (int)(($rem)/3600) - $days*24 - $weeks*7*24;
    $mins = (int)(($rem)/60) - $hours*60 - $days*24*60 - $weeks*7*24*60;
    $str = '';
    if($years==1) $str .= "$years $ui_year, ";
    if($years>1) $str .= "$years $ui_years, ";
    if($weeks==1) $str .= "$weeks $ui_week, ";
    if($weeks>1) $str .= "$weeks $ui_weeks, ";
    if($days==1) $str .= "$days $ui_day,";
    if($days>1) $str .= "$days $ui_days,";
    if($hours == 1) $str .= " $hours $ui_hour";
    if($hours>1) $str .= " $hours $ui_hours";
    if($mins == 1) $str .= " 1 $ui_minute";
    else $str .= " $mins $ui_minutes";
    return strtolower($str);
}

##
## Funções específicas Geradoras de HTML
##
function calendar_Year_Month ($ano, $mes) {
        global $ui_month_01_short,$ui_month_02_short,$ui_month_03_short,$ui_month_04_short,
               $ui_month_05_short,$ui_month_06_short,$ui_month_07_short,$ui_month_08_short,
               $ui_month_09_short,$ui_month_10_short,$ui_month_11_short,$ui_month_12_short;
        $a = $ano;
        $m = $mes;

        // se o ano é o ano corrente ...
        if ($ano == date("Y")) {
            if (date('n') == 12) {
                $m = 1;
            }
            else {
                $a = $ano - 1;
                $m = date('n');
            }
            $a = $ano;
            $m = -1;
        } else {
            $a = $ano;
            $m = 0;
        }

        if ($ano == date("Y")) {
            $m += 1;
            if ($m > 12) {
                $a += 1;
                $m = 1;
            }
        }

        for ($i = 0; $i < 12; $i++) {

            $m = $m + 1;
            if ($m > 12) {
                $m = 1;
                $a = $a + 1;
            }

            if ($m == 1) {
                if ($i !== 0) {
                    $ds_mes = $ui_month_01_short; //"JAN ' " . substr($a, 2, 2);
                } else {
                    $ds_mes = $ui_month_01_short;
                }
            } elseif ($m == 2) {
                $ds_mes = $ui_month_02_short;
            } elseif ($m == 3) {
                $ds_mes = $ui_month_03_short;
            } elseif ($m == 4) {
                $ds_mes = $ui_month_04_short;
            } elseif ($m == 5) {
                $ds_mes = $ui_month_05_short;
            } elseif ($m == 6) {
                $ds_mes = $ui_month_06_short;
            } elseif ($m == 7) {
                $ds_mes = $ui_month_07_short;
            } elseif ($m == 8) {
                $ds_mes = $ui_month_08_short;
            } elseif ($m == 9) {
                $ds_mes = $ui_month_09_short;
            } elseif ($m == 10) {
                $ds_mes = $ui_month_10_short;
            } elseif ($m == 11) {
                $ds_mes = $ui_month_11_short;
            } elseif ($m == 12) {
                $ds_mes = $ui_month_12_short;
            }

            if ($a == $ano && $m == $mes) {
                echo '<td name="m' . ($i + 1) . '" data="' . $a . '@' . $m . '" style="width:7%;" class="corrente">' . $ds_mes . '</td>';
            } else {
                echo '<td name="m' . ($i + 1) . '" data="' . $a . '@' . $m . '" style="width:7%;">' . $ds_mes . '</td>';
            }
        }
}

function calendar_Week_Days ($ano, $mes, $week, $escalasModel, &$dia_fim_semana) {
    global  $ui_cal_saturday_short,$ui_cal_sunday_short,$ui_cal_monday_short,$ui_cal_tuesday_short,
            $ui_cal_wednesday_short,$ui_cal_thursday_short,$ui_cal_friday_short,$ui_cal_holiday_sort;
    $hoje = date("Y-m-d");
    $html_ = '<thead>';

    $primeiro_dia_mes = gmmktime(1, 0, 0, $mes, 1, $ano);

    if (inicio_semana() == 'DOM') {
        $dia_ini_semana = "7"; // 1: Seg. ... 7: Dom
    } else {
        $dia_ini_semana = "1";
    }

    $dia_fim_semana = ($dia_ini_semana - 1);
    if (!$dia_fim_semana) {
        $dia_fim_semana = 7;
    }

    if ($week) { //True OR False
        $html_ .= '<tr class="weekNumber">';
        $html_ .= '<th class="infoRhid" rowspan="3" style="width:165px">&nbsp;</th>';

        # imprime a semana em questão
        $cnt = 0;
        if ($escalasModel) {
            $delta = 2; //Nr. of Addicional columns each Week (totals)
        } else {
            $delta = 0;
        }
        for ($i = 0; $i < date('t', $primeiro_dia_mes); $i++) {

            $an = '';
            $semana = '';
            $dia = gmmktime(1, 0, 0, $mes, ($i + 1), $ano);
            $dia_sem = date("N",$dia);  ## 1 - Segunda, 7 - Domingo
            semana_ano(date("Y-m-d",$dia), $an, $semana);
            $dia1_sem = primeiro_dia_semana($an,$semana);

            if ($i == 0) {
                if (inicio_semana() == 'DOM') {
                    if ($dia_sem == 7) {
                        $colspan = $dia_sem + $delta;
                        $html_ .= '<th class="weekImpar" colspan="'.$colspan.'" dt_ini_sem="'.$dia1_sem.'" style="border:1px solid RGB(221,221,221);">'.($semana).'</th>';
                    } else {
                        $colspan = 7 - $dia_sem + $delta;
                        $html_ .= '<th class="weekImpar" colspan="'.$colspan.'" dt_ini_sem="'.$dia1_sem.'" style="border:1px solid RGB(221,221,221);">'.($semana).'</th>';
                    }
                } else {
                    $colspan = 8 - $dia_sem + $delta;
                    $html_ .= '<th class="weekImpar" colspan="'.$colspan.'" dt_ini_sem="'.$dia1_sem.'" style="border:1px solid RGB(221,221,221);">'.($semana).'</th>';
                }
                //$html_ .= '<th class="weekImpar" colspan="'.$colspan.'" dt_ini_sem="'.$dia1_sem.'" style="border:1px solid RGB(221,221,221);">'.($semana).'</th>';

                $cnt += 1;
            } else if ($dia_sem == $dia_ini_semana) {
                $colspan = 7 + $delta;
                if ($cnt % 2 == 0) {
                    $html_ .= '<th class="weekImpar" colspan="'.$colspan.'" dt_ini_sem="'.$dia1_sem.'" style="border:1px solid RGB(221,221,221);">'.($semana).'</th>';
                } else {
                    $html_ .= '<th class="weekPar" colspan="'.$colspan.'" dt_ini_sem="'.$dia1_sem.'" style="border:1px solid RGB(221,221,221);">'.($semana).'</th>';
                }
                $cnt += 1;
            }
        }
        $html_ .= '</tr>';
    }
    //Legenda + dias do mês
    $html_ .= '<tr class="dayNumber">';
    if (!$week) {
        $html_ .= '<th class="infoRhid" rowspan="2">&nbsp;</th>';
    }
    //imprime os dias do mês
    $cnt = 0;
    for ($i = 0; $i < date('t', $primeiro_dia_mes); $i++) {
        $dia = gmmktime(1, 0, 0, $mes, ($i + 1), $ano);
        //Sinalização do dia corrente
        if (date("Y-m-d", $dia) == $hoje) {
            $html_ .= '<th><span class="badge today">' . ($i + 1) . '</span></th>';
        } else {
            $html_ .= '<th>' . ($i + 1) . '</th>';
        }

        if ($escalasModel) {
            $dia_sem = date("N",$dia);  ## 1 - Segunda, 7 - Domingo
            if ($dia_sem == $dia_fim_semana) {
                if ($cnt % 2 == 0) {
                    $class = "impar";
                } else {
                    $class = "par";
                }
                $html_ .=   '<th class="bh '.$class.'" rowspan="2">' . 'BH' . '</th>'.
                            '<th class="th '.$class.'" rowspan="2">' . 'TH' . '</th>';
                $cnt += 1;
            }
        }
    }

    $html_ .= '</tr>';
    $html_ .= '<tr class="dayWeek">'; //'<tr class="hdr-scale"  height="25">';
    //imprime os dias da semana
    for ($i = 0; $i < date('t', $primeiro_dia_mes); $i++) {
       // $col += 1;
        $dia = gmmktime(1, 0, 0, $mes, ($i + 1), $ano);
        if (feriado(date('Y-m-d', $dia), $empresa, $estab) == 'S') {
            $html_ .= '<th><a href="javascript:void(0)" class="timeLine" data-day='.date("Y-m-d", $dia).' style="color:red;">'.$ui_cal_holiday_sort.'</a></th>';
        } elseif (date('w', $dia) == '0') {
            $html_ .= '<th><a href="javascript:void(0)" class="timeLine" data-day='.date("Y-m-d", $dia).'>'.$ui_cal_sunday_short.'</a></th>';
        } elseif (date('w', $dia) == '1') {
            $html_ .= '<th><a href="javascript:void(0)" class="timeLine" data-day='.date("Y-m-d", $dia).'>'.$ui_cal_monday_short.'</a></th>';
        } elseif (date('w', $dia) == '2') {
            $html_ .= '<th><a href="javascript:void(0)" class="timeLine" data-day='.date("Y-m-d", $dia).'>'.$ui_cal_tuesday_short.'</a></th>';
        } elseif (date('w', $dia) == '3') {
            $html_ .= '<th><a href="javascript:void(0)" class="timeLine" data-day='.date("Y-m-d", $dia).'>'.$ui_cal_wednesday_short.'</a></th>';
        } elseif (date('w', $dia) == '4') {
           $html_ .= '<th><a href="javascript:void(0)" class="timeLine" data-day='.date("Y-m-d", $dia).'>'.$ui_cal_thursday_short.'</a></th>';
        } elseif (date('w', $dia) == '5') {
            $html_ .= '<th><a href="javascript:void(0)" class="timeLine" data-day='.date("Y-m-d", $dia).'>'.$ui_cal_friday_short.'</a></th>';
        } elseif (date('w', $dia) == '6') {
            $html_ .= '<th><a href="javascript:void(0)" class="timeLine" data-day='.date("Y-m-d", $dia).'>'.$ui_cal_saturday_short.'</a></th>';
        }
    }

    $html_ .= '</tr>';
    $html_ .= '</thead>';
    return  $html_;
}

 /* Lista de Colaboradores :: Escalas */
function info_colabs_escalas($empresa, $estab, $cd_setor, $dt_setor, $rhid, $ano_mes_fim, $dt_fim_mes, $offset, $reg_pag, &$cnt, &$result, &$msg) {

    global $db;
    
    $msg = '';
    $result = array();
    $cnt = 0;
    $ano_mes_aberto = 'S';

    if ($ano_mes_aberto == 'S') { //MÊS FECHADO

        $sql = "SELECT A.RHID, A.NOME, A.NOME_REDZ, A.DT_ADMISSAO, A.DT_DEMISSAO," .
                " A.DSP_VINCULO, A.DSP_FUNCAO, A.DSP_CATG_PROF_INTERNA, A.DSP_ESTAB, A.DSP_SETOR " .
                "FROM QUAD_PEOPLE A " .
                "WHERE 1 = 1" .
                " AND A.ATIVO = 'S' " .
                " AND TO_CHAR(A.DT_ADMISSAO,'YYYY-MM-DD') <= :DT_FIM_MES " .
                " AND (A.DT_DEMISSAO IS NULL OR TO_CHAR(A.DT_DEMISSAO,'YYYY-MM') >= :ANO_MES_FIM) ";
//                " AND TO_CHAR(A.DT_ADMISSAO,'YYYY-MM-DD') <= '$dt_fim_mes' " .
//                " AND (A.DT_DEMISSAO IS NULL OR TO_CHAR(A.DT_DEMISSAO,'YYYY-MM') >= '$ano_mes_fim') ";

        if ($cd_setor != '' && $dt_setor != '') {
            $sql .= " AND A.ID_SETOR = :SETOR "; # AND A.DT_INI_SETOR = '$dt_setor' ";
        }

        if (@$_SESSION['perfil'] == 'A') {  # próprio colaborador ou a pedido para um empregado específico (visões de chefia)
            if ($rhid != '') {
                $sql .= " AND A.RHID = :RHID ";
            } else {
                $sql .= " AND A.RHID = :RHID "; //" AND A.RHID = " . @$_SESSION['rhid'] . " ";
            }
        } elseif (@$_SESSION['perfil'] == 'B') { # gestor administrativo
            $sql .= " AND (A.RHID_GESTOR_ADM = " . @$_SESSION['rhid'] . " OR A.RHID = " . @$_SESSION['rhid'] . ") ";
        } elseif (@$_SESSION['perfil'] == 'C') { # supervisor
            $sql .= " AND (A.RHID_SUPERVISOR = " . @$_SESSION['rhid'] . " OR A.RHID = " . @$_SESSION['rhid'] . ") ";
        } elseif (@$_SESSION['perfil'] == 'D') { # director
            $sql .= " AND (A.RHID_DIRECTOR = " . @$_SESSION['rhid'] . " OR A.RHID = " . @$_SESSION['rhid'] . ") ";
        } elseif (@$_SESSION['perfil'] == 'F' || # dep.recursos humanos
                @$_SESSION['perfil'] == 'E' || # Gestor - outsourcing
                @$_SESSION['perfil'] == 'W' || # Consulta
                @$_SESSION['perfil'] == 'Y' || # Preparador Escalas
                @$_SESSION['perfil'] == 'Z') {  # Administrador
            null;
        }

        if ($empresa != '') {
            $sql .= " AND A.EMPRESA = :EMPRESA ";
            //$sql .= " AND A.EMPRESA = '$empresa' ";
        }

        if ($estab != '') {
            //$sql .= " AND A.CD_ESTAB = '$estab' ";
            $sql .= " AND A.CD_ESTAB = :ESTAB ";
        }
        
        if ($rhid != '') {
            $sql .= " AND A.RHID = :RHID ";
        }
        
        ## TODO: filtragem por estabelecimento
        #$sql = filtro_estab($query1,'E');
        $sql .= " ORDER BY 1 ";
        try {
            $stmt = $db->prepare($sql);
            if ($empresa != '') {
                $stmt->bindParam(':EMPRESA', $empresa, PDO::PARAM_STR);
            }
            if ($estab != '') {
                $stmt->bindParam(':ESTAB', $estab, PDO::PARAM_STR);
            }
            if ($rhid != '') {
                $stmt->bindParam(':RHID', $rhid, PDO::PARAM_STR);
            }
            if ($cd_setor != '' && $dt_setor != '') {
                $stmt->bindParam(':SETOR', $estab, PDO::PARAM_STR);; # AND A.DT_INI_SETOR = '$dt_setor' ";
            }
            if (@$_SESSION['perfil'] == 'A') {  # próprio colaborador ou a pedido para um empregado específico (visões de chefia)
                if ($rhid != '') {
                    $stmt->bindParam(':RHID', $rhid, PDO::PARAM_STR);
                } else {
                    $stmt->bindParam(':RHID', @$_SESSION['rhid'], PDO::PARAM_STR);
                }
            }
            $stmt->bindParam(':DT_FIM_MES', $dt_fim_mes, PDO::PARAM_STR);
            $stmt->bindParam(':ANO_MES_FIM', $ano_mes_fim, PDO::PARAM_STR);

            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $cnt = $stmt->rowCount();
        } catch (Exception $ex) {
            echo 'Erro' . $ex->getMessage();
            $msg = "info_colabs_gtempo#1 :" . $ex->getMessage();
        }

    } else { //MÊS FECHADO
        null;
    }
}

/* Indisponibilidade de um RHID para um DIA indicado com data/hora de referência (início de dia) */
function indisponibilidade_no_dia ($empresa, $rhid, $dt_adm, $dt_ini_dia, $dt_fim_dia, &$fer, &$dc,&$aus, &$bh, &$msg) {

    global $db;
    
    $msg = '';

    $fer = 'N';
    $dc = 'N';
    $aus = 'N';
    $bh = 'N';

    $sql = "SELECT 'FER' MODULO, COUNT(*) CNT ".
           "FROM RH_ID_FERIAS W ".
           "WHERE W.EMPRESA = :EMPRESA ".
           "  AND W.RHID = :RHID ".
           "  AND W.DT_ADMISSAO = :DT_ADM ".
#	       "  AND W.ANO = :ANO ".
           "  AND ( :DT_INI_DIA BETWEEN TO_CHAR(W.DT_INI,'YYYY-MM-DD HH24:MI') AND TO_CHAR(W.DT_FIM,'YYYY-MM-DD HH24:MI') OR ".
           "        :DT_FIM_DIA BETWEEN TO_CHAR(W.DT_INI,'YYYY-MM-DD HH24:MI') AND TO_CHAR(W.DT_FIM,'YYYY-MM-DD HH24:MI') OR ".
           "        (:DT_INI_DIA < TO_CHAR(W.DT_INI,'YYYY-MM-DD HH24:MI') AND TO_CHAR(W.DT_FIM,'YYYY-MM-DD HH24:MI') < :DT_FIM_DIA) ".
           "      )  ".
           #"  AND (W.ESTADO_ESTORNO IS NULL OR W.ESTADO_ESTORNO <> 'E') ".
           #"  AND W.ESTADO != 'F' ".
           "UNION ".
           "SELECT 'DC' MODULO, COUNT(*) CNT ".
           "FROM RH_ID_DC_DEBITOS W ".
           "WHERE W.EMPRESA = :EMPRESA ".
           "  AND W.RHID = :RHID ".
           "  AND W.DT_ADMISSAO = :DT_ADM ".
           "  AND ( :DT_INI_DIA BETWEEN TO_CHAR(W.GOZOU_DE,'YYYY-MM-DD HH24:MI') AND TO_CHAR(W.GOZOU_A,'YYYY-MM-DD HH24:MI') OR ".
           "        :DT_FIM_DIA BETWEEN TO_CHAR(W.GOZOU_DE,'YYYY-MM-DD HH24:MI') AND TO_CHAR(W.GOZOU_A,'YYYY-MM-DD HH24:MI') OR ".
           "        (:DT_INI_DIA < TO_CHAR(W.GOZOU_DE,'YYYY-MM-DD HH24:MI') AND TO_CHAR(W.GOZOU_A,'YYYY-MM-DD HH24:MI') < :DT_FIM_DIA) ".
           "      )  ".
           #"  AND (W.ESTADO_ESTORNO IS NULL OR W.ESTADO_ESTORNO <> 'E') ".
           #"  AND W.ESTADO != 'F' ".
           "UNION ".
           "SELECT 'AUS' MODULO,COUNT(*) CNT ".
           "FROM RH_ID_AUSENCIAS W ".
           "WHERE W.EMPRESA = :EMPRESA ".
           "  AND W.RHID = :RHID ".
           "  AND W.DT_ADMISSAO = :DT_ADM ".
           "  AND ( :DT_INI_DIA BETWEEN TO_CHAR(W.DT_INI,'YYYY-MM-DD HH24:MI') AND TO_CHAR(W.DT_FIM,'YYYY-MM-DD HH24:MI') OR ".
           "        :DT_FIM_DIA BETWEEN TO_CHAR(W.DT_INI,'YYYY-MM-DD HH24:MI') AND TO_CHAR(W.DT_FIM,'YYYY-MM-DD HH24:MI') OR ".
           "        (:DT_INI_DIA < TO_CHAR(W.DT_INI,'YYYY-MM-DD HH24:MI') AND TO_CHAR(W.DT_FIM,'YYYY-MM-DD HH24:MI') < :DT_FIM_DIA) ".
           "      )  ".
           #"  AND (W.ESTADO_ESTORNO IS NULL OR W.ESTADO_ESTORNO <> 'E') ".
           #"  AND W.ESTADO != 'F' ".
           "UNION ".
           "SELECT 'BH' MODULO, COUNT(*) CNT ".
           "FROM RH_ID_DET_ADAPTABILIDADES W ".
           "WHERE W.EMPRESA = :EMPRESA ".
           "  AND W.RHID = :RHID ".
           "  AND W.DT_ADMISSAO = :DT_ADM ".
           "  AND ( :DT_INI_DIA BETWEEN TO_CHAR(W.DT_INI_DET,'YYYY-MM-DD HH24:MI') AND TO_CHAR(W.DT_FIM_DET,'YYYY-MM-DD HH24:MI') OR ".
           "        :DT_FIM_DIA BETWEEN TO_CHAR(W.DT_INI_DET,'YYYY-MM-DD HH24:MI') AND TO_CHAR(W.DT_FIM_DET,'YYYY-MM-DD HH24:MI') OR ".
           "        (:DT_INI_DIA < TO_CHAR(W.DT_INI_DET,'YYYY-MM-DD HH24:MI') AND TO_CHAR(W.DT_FIM_DET,'YYYY-MM-DD HH24:MI') < :DT_FIM_DIA) ".
           "      )  ".
           "  AND W.TP_OCORRENCIA = 'HD' ".
           #"  AND (W.ESTADO_ESTORNO IS NULL OR W.ESTADO_ESTORNO <> 'E') ".
           #"  AND W.ESTADO != 'F' ".
           "ORDER BY 1";
#echo "dt_ini_dia:$dt_ini_dia -> fim:$dt_fim_dia <br/>";

    try {
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':EMPRESA', $empresa, PDO::PARAM_STR);
        $stmt->bindParam(':RHID', $rhid, PDO::PARAM_STR);
        $stmt->bindParam(':DT_ADM', $dt_adm, PDO::PARAM_STR);
        $stmt->bindParam(':DT_INI_DIA', $dt_ini_dia, PDO::PARAM_STR);
        $stmt->bindParam(':DT_FIM_DIA', $dt_fim_dia, PDO::PARAM_STR);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($row['MODULO'] == 'FER') {
               if ($row['CNT'] > 0) {
                  $fer = 'S';
                }
            } elseif ($row['MODULO'] == 'DC') {
               if ($row['CNT'] > 0) {
                  $dc = 'S';
                }
            } elseif ($row['MODULO'] == 'TS') {
               if ($row['CNT'] > 0) {
                  $ts = 'S';
                }
            } elseif ($row['MODULO'] == 'AUS') {
                if ($row['CNT'] > 0) {
                    $aus = 'S';
                }
            } elseif ($row['MODULO'] == 'BH') {
               if ($row['CNT'] > 0) {
                  $bh = 'S';
               }
            }
        }
    } catch (Exception $ex) {
            $msg = "indisponibilidade_no_dia#1 :" . $ex->getMessage();
    }

  }

/* Escala de um RHID para um DIA */
function get_dia_escala_horaria($empresa, $rhid, $dt_adm, $dia, &$hor, &$e_1, &$s_1, &$e_2, &$s_2,
                                &$he_1, &$hs_1, &$he_2, &$hs_2, &$he_3, &$hs_3, &$inic_dia, &$e_noct, &$s_noct, &$cd_turno, &$dsp_turno,
                                &$dt_ini_dia, &$dt_fim_dia, &$min_esperados, &$msg) {
    global $db;
    
    $msg = '';
    $hor = '';

    $e_1 = '';
    $s_1 = '';
    $e_2 = '';
    $s_2 = '';
    $he_1 = '';
    $hs_1 = '';
    $he_2 = '';
    $hs_2 = '';
    $he_3 = '';
    $hs_3 = '';
    $inic_dia = '';
    $e_noct = '';
    $s_noct = '';
    $cd_turno = '';
    $dsp_turno = '';
    $dt_ini_dia = '';
    $dt_fim_dia = '';
    $min_esperados = 0;

    $sql = "SELECT e.CD_HOR_DIA, h.*, DOMINIO('CONTI_TURNOS', h.TURNO,'C') DSP_TURNO ".
             "FROM RH_ID_ESCALAS_HORARIAS e, RH_DEF_HORARIO_DIAS h ".
             "WHERE e.EMPRESA = :EMPRESA ".
             "  AND e.RHID = :RHID ".
             "  AND e.DT_ADMISSAO = :DT_ADM ".
             "  AND e.DIA = TO_DATE(:DIA,'YYYY-MM-DD') ".
             "  AND e.TIPO = 'A' ".
             "  AND e.CD_HOR_DIA IS NOT NULL ".
             "  AND h.CD_HOR_DIA = e.CD_HOR_DIA ";

    try {
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':EMPRESA', $empresa, PDO::PARAM_STR);
        $stmt->bindParam(':RHID', $rhid, PDO::PARAM_STR);
        $stmt->bindParam(':DT_ADM', $dt_adm, PDO::PARAM_STR);
        $stmt->bindParam(':DIA', $dia, PDO::PARAM_STR);
        $stmt->execute();
        while ($row1 = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $hor = $row1['CD_HOR_DIA'];
            $e_noct = $row1['INICIO_NOITE'];
            $s_noct = $row1['FIM_NOITE'];
            $inic_dia = $row1['INICIO_DIA'];
            $cd_turno = $row1['TURNO'];
            $dsp_turno = $row1['DSP_TURNO'];
            $dt_ini_dia = "$dia $inic_dia";
            $dia_1 = date('Y-m-d', strtotime($dia. ' + 1 day'));
            $dt_fim_dia = "$dia_1 $inic_dia";
            $min_esperados = $row1['MIN_ESPERADOS'];

            if ($row1['TP_1'] == 'A') {
                $e_1 = $row1['HI_1'];
                $s_1 = $row1['HF_1'];
            }

            if ($row1['TP_2'] == 'A') {
                if ($e_1 == '') {
                        $e_1 = $row1['HI_2'];
                        $s_1 = $row1['HF_2'];
                } else {
                        $e_2 = $row1['HI_2'];
                        $s_2 = $row1['HF_2'];
                }
            }

            if ($row1['TP_3'] == 'A') {
                if ($e_1 == '') {
                        $e_1 = $row1['HI_3'];
                        $s_1 = $row1['HF_3'];
                } else {
                        $e_2 = $row1['HI_3'];
                        $s_2 = $row1['HF_3'];
                }
            }

            if ($row1['TP_4'] == 'A') {
                if ($e_1 == '') {
                        $e_1 = $row1['HI_4'];
                        $s_1 = $row1['HF_4'];
                } else {
                        $e_2 = $row1['HI_4'];
                        $s_2 = $row1['HF_4'];
                }
            }

            if ($row1['TP_5'] == 'A') {
                if ($e_1 == '') {
                        $e_1 = $row1['HI_5'];
                        $s_1 = $row1['HF_5'];
                } else {
                        $e_2 = $row1['HI_5'];
                        $s_2 = $row1['HF_5'];
                }
            }

            if ($row1['TP_1'] == 'B') {
                $he_1 = $row1['HI_1'];
                $hs_1 = $row1['HF_1'];
            }

            if ($row1['TP_2'] == 'B') {
                if ($he_1 == '') {
                        $he_1 = $row1['HI_2'];
                        $hs_1 = $row1['HF_2'];
                }
                elseif($he_2 == '') {
                        $he_2 = $row1['HI_2'];
                        $hs_2 = $row1['HF_2'];
                }
                elseif($he_3 == '') {
                        $he_3 = $row1['HI_2'];
                        $hs_3 = $row1['HF_2'];
                }
            }

            if ($row1['TP_3'] == 'B') {
                if ($he_1 == '') {
                        $he_1 = $row1['HI_3'];
                        $hs_1 = $row1['HF_3'];
                }
                elseif($he_2 == '') {
                        $he_2 = $row1['HI_3'];
                        $hs_2 = $row1['HF_3'];
                }
                elseif($he_3 == '') {
                        $he_3 = $row1['HI_3'];
                        $hs_3 = $row1['HF_3'];
                }
            }

            if ($row1['TP_4'] == 'B') {
                if ($he_1 == '') {
                        $he_1 = $row1['HI_4'];
                        $hs_1 = $row1['HF_4'];
                }
                elseif($he_2 == '') {
                        $he_2 = $row1['HI_4'];
                        $hs_2 = $row1['HF_4'];
                }
                elseif($he_3 == '') {
                        $he_3 = $row1['HI_4'];
                        $hs_3 = $row1['HF_4'];
                }
            }

            if ($row1['TP_5'] == 'B') {
                if ($he_1 == '') {
                        $he_1 = $row1['HI_5'];
                        $hs_1 = $row1['HF_5'];
                }
                elseif($he_2 == '') {
                        $he_2 = $row1['HI_5'];
                        $hs_2 = $row1['HF_5'];
                }
                elseif($he_3 == '') {
                        $he_3 = $row1['HI_5'];
                        $hs_3 = $row1['HF_5'];
                }
            }

            break;
        }
    } catch (Exception $ex) {
            $msg = "get_dia_escala_horaria#1 :" . $ex->getMessage();
    }
    return $hor;
}

/* Troca horário cadastro de um RHID para um DIA */
function get_dia_troca_horario($empresa, $rhid, $dt_adm, $dia, &$cd_hor, &$tp_hor, &$msg) {
    global $db;
    
    $msg = '';
    $cd_hor = '';
    $tp_hor = '';

    $sql = "SELECT e.CD_HORARIO_PARA, e.TP_HORARIO_PARA ".
             "FROM RH_ID_ESCALAS_HORARIAS e ".
             "WHERE e.EMPRESA = :EMPRESA_ ".
             "  AND e.RHID = :RHID_ ".
             "  AND e.DT_ADMISSAO = TO_DATE(:DT_ADMISSAO_,'YYYY-MM-DD') ".
             "  AND TO_DATE(:DIA_,'YYYY-MM-DD') BETWEEN e.DIA AND COALESCE(e.DT_FIM,SYSDATE()) ".
             "  AND e.TIPO = 'B' ";
    try {
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':EMPRESA_', $empresa, PDO::PARAM_STR);
        $stmt->bindParam(':RHID_', $rhid, PDO::PARAM_STR);
        $stmt->bindParam(':DT_ADMISSAO_', $dt_adm, PDO::PARAM_STR);
        $stmt->bindParam(':DIA_', $dia, PDO::PARAM_STR);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $cd_hor = $row['CD_HORARIO_PARA'];
            $tp_hor = $row['TP_HORARIO_PARA'];
            break;
        }
    } catch (Exception $ex) {
            $msg = "get_troca_horario#1 :" . $ex->getMessage();
    }
}

/* Base horária aplicável a um colaboador/dia */
function get_base_horaria ($empresa, $rhid, $dt_adm, $dia, &$msg) {
    global $db;
    
    $msg = '';
    $bh = '';

    $sql = "SELECT NR_HORAS ".
           "FROM RH_ID_BASES_HORARIAS ".
           "WHERE empresa  = EMPRESA ".
           "  AND RHID = :RHID ".
           "  AND DT_ADMISSAO = :DT_ADMISSAO ".
           "  AND :DIA BETWEEN TO_CHAR(DT_INI,'YYYY-MM-DD') AND NVL(TO_CHAR(DT_FIM,'YYYY-MM-DD'),:DIA) ".
           "ORDER BY DT_INI DESC ";
    try {
        $stmt = $db->prepare($sql);

        $stmt->bindParam(':EMPRESA', $empresa, PDO::PARAM_STR);
        $stmt->bindParam(':RHID', $rhid, PDO::PARAM_STR);
        $stmt->bindParam(':DT_ADMISSAO', $dt_adm, PDO::PARAM_STR);
        $stmt->bindParam(':DIA', $dia, PDO::PARAM_STR);

        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row['NR_HORAS'] != '') {
            $bh = $row['NR_HORAS'];
        }

    } catch (Exception $ex) {
            $msg = "get_base_horaria#1 :" . $ex->getMessage();
    }

    return $bh;
}

/* Horário diário referente a um dia a partir de um horário semanal/turno (cadastro) */
function get_hor_diario_cadastro($empresa, $dia, $estab, $cd_hor, $tp_hor,
                                &$hor, &$e_1, &$s_1, &$e_2, &$s_2,
                                &$he_1, &$hs_1, &$he_2, &$hs_2, &$he_3, &$hs_3, &$inic_dia, &$e_noct, &$s_noct, &$cd_turno, &$dsp_turno,
                                &$dt_ini_dia, &$dt_fim_dia, &$min_esperados, &$msg) {
    global $db;
    
    $msg = '';
    $hor = '';

    $e_1 = '';
    $s_1 = '';
    $e_2 = '';
    $s_2 = '';
    $he_1 = '';
    $hs_1 = '';
    $he_2 = '';
    $hs_2 = '';
    $he_3 = '';
    $hs_3 = '';
    $inic_dia = '';
    $e_noct = '';
    $s_noct = '';
    $cd_turno = '';
    $dsp_turno = '';
    $dt_ini_dia = '';
    $dt_fim_dia = '';
    $min_esperados = 0;

    $date_array = explode("-",$dia);
    $var_year = $date_array[0];
    $var_month = $date_array[1];
    $var_day = $date_array[2];
    $var_timestamp = gmmktime(1,0,0,$var_month,$var_day,$var_year);
    $sql = '';
    $tp_dia = '';

    # horário de turno
    if ($tp_hor == 'T') {

        $sql  = "SELECT d.*, h.TP_DIA_TURNO, DOMINIO('CONTI_TURNOS',d.TURNO,'C') DSP_TURNO ".
                "FROM RH_DEF_DET_HORARIOS h, RH_DEF_HORARIO_DIAS d ".
                "WHERE h.CD_HORARIO = :CD_HORARIO_ ".
                "  AND h.TP_HORARIO = :TP_HORARIO_ ".
                "  AND h.DIA_TURNO = TO_DATE(:DIA_TURNO_,'YYYY-MM-DD') ".
                "  AND d.CD_HOR_DIA = h.CD_HOR_DIA ";

    } # horário semanal
    elseif ($tp_hor == 'S') {

        # determinação do tipo de dia
        if (feriado($dia, $empresa, $estab) == 'S') {
            $tp_dia = 8;
        } else {
            $tp_dia = (date("w",$var_timestamp)+1);
        }
        $sql =  "SELECT d.*, DOMINIO('CONTI_TURNOS',d.TURNO,'C') DSP_TURNO ".
                "FROM RH_DEF_DET_HORARIOS h, RH_DEF_HORARIO_DIAS d ".
                "WHERE h.CD_HORARIO = :CD_HORARIO_ ".
                "  AND h.TP_HORARIO = :TP_HORARIO_ ".
                "  AND h.TP_DIA_SEMANA = :TP_DIA_ ".
                "  AND d.CD_HOR_DIA = h.CD_HOR_DIA ";
    }

    if ($sql != '' && $msg == '') {
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':CD_HORARIO_', $cd_hor, PDO::PARAM_STR);
            $stmt->bindParam(':TP_HORARIO_', $tp_hor, PDO::PARAM_STR);
            if ($tp_hor == 'S') {
                $stmt->bindParam(':TP_DIA_', $tp_dia, PDO::PARAM_STR);
            } else {
                $stmt->bindParam(':DIA_TURNO_', $dia, PDO::PARAM_STR);
            }
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $hor = $row['CD_HOR_DIA'];
                $e_noct = $row['INICIO_NOITE'];
                $s_noct = $row['FIM_NOITE'];
                $inic_dia = $row['INICIO_DIA'];
                $cd_turno = $row['TURNO'];
                $dsp_turno = $row['DSP_TURNO'];
                $dt_ini_dia = "$dia $inic_dia";
                $dia_1 = date('Y-m-d', strtotime($dia. ' + 1 day'));
                $dt_fim_dia = "$dia_1 $inic_dia";
                $min_esperados = $row['MIN_ESPERADOS'];

                if ($row['TP_1'] == 'A') {
                    $e_1 = $row['HI_1'];
                    $s_1 = $row['HF_1'];
                }

                if ($row['TP_2'] == 'A') {
                    if ($e_1 == '') {
                            $e_1 = $row['HI_2'];
                            $s_1 = $row['HF_2'];
                    } else {
                            $e_2 = $row['HI_2'];
                            $s_2 = $row['HF_2'];
                    }
                }

                if ($row['TP_3'] == 'A') {
                    if ($e_1 == '') {
                            $e_1 = $row['HI_3'];
                            $s_1 = $row['HF_3'];
                    } else {
                            $e_2 = $row['HI_3'];
                            $s_2 = $row['HF_3'];
                    }
                }

                if ($row['TP_4'] == 'A') {
                    if ($e_1 == '') {
                            $e_1 = $row['HI_4'];
                            $s_1 = $row['HF_4'];
                    } else {
                            $e_2 = $row['HI_4'];
                            $s_2 = $row['HF_4'];
                    }
                }

                if ($row['TP_5'] == 'A') {
                    if ($e_1 == '') {
                            $e_1 = $row['HI_5'];
                            $s_1 = $row['HF_5'];
                    } else {
                            $e_2 = $row['HI_5'];
                            $s_2 = $row['HF_5'];
                    }
                }

                if ($row['TP_1'] == 'B') {
                    $he_1 = $row['HI_1'];
                    $hs_1 = $row['HF_1'];
                }

                if ($row['TP_2'] == 'B') {
                    if ($he_1 == '') {
                            $he_1 = $row['HI_2'];
                            $hs_1 = $row['HF_2'];
                    }
                    elseif($he_2 == '') {
                            $he_2 = $row['HI_2'];
                            $hs_2 = $row['HF_2'];
                    }
                    elseif($he_3 == '') {
                            $he_3 = $row['HI_2'];
                            $hs_3 = $row['HF_2'];
                    }
                }

                if ($row['TP_3'] == 'B') {
                    if ($he_1 == '') {
                            $he_1 = $row['HI_3'];
                            $hs_1 = $row['HF_3'];
                    }
                    elseif($he_2 == '') {
                            $he_2 = $row['HI_3'];
                            $hs_2 = $row['HF_3'];
                    }
                    elseif($he_3 == '') {
                            $he_3 = $row['HI_3'];
                            $hs_3 = $row['HF_3'];
                    }
                }

                if ($row['TP_4'] == 'B') {
                    if ($he_1 == '') {
                            $he_1 = $row['HI_4'];
                            $hs_1 = $row['HF_4'];
                    }
                    elseif($he_2 == '') {
                            $he_2 = $row['HI_4'];
                            $hs_2 = $row['HF_4'];
                    }
                    elseif($he_3 == '') {
                            $he_3 = $row['HI_4'];
                            $hs_3 = $row['HF_4'];
                    }
                }

                if ($row['TP_5'] == 'B') {
                    if ($he_1 == '') {
                            $he_1 = $row['HI_5'];
                            $hs_1 = $row['HF_5'];
                    }
                    elseif($he_2 == '') {
                            $he_2 = $row['HI_5'];
                            $hs_2 = $row['HF_5'];
                    }
                    elseif($he_3 == '') {
                            $he_3 = $row['HI_5'];
                            $hs_3 = $row['HF_5'];
                    }
                }

                break;
            }
        }
        catch (Exception $ex) {
                $msg = "get_hor_diario_cadastro#1 :" . $ex->getMessage();
        }
    }

    return $hor;
}

/* Horário diário referente a um dia para um colaborador, ponderando o cadastro e as escalas */
function get_hor_diario($empresa, $rhid, $dt_adm, $dia,
                        &$origem, &$cd_hor, &$tp_hor,
                        &$hor, &$e_1, &$s_1, &$e_2, &$s_2,
                        &$he_1, &$hs_1, &$he_2, &$hs_2, &$he_3, &$hs_3, &$inic_dia, &$e_noct, &$s_noct, &$cd_turno, &$dsp_turno,
                        &$dt_ini_dia, &$dt_fim_dia, &$msg) {
    global $db;
    
    $msg = '';
    $debug = false;

    $origem = '';
    $cd_hor = '';
    $tp_hor = '';
    $hor = '';
    $e_1 = '';
    $s_1 = '';
    $e_2 = '';
    $s_2 = '';
    $he_1 = '';
    $hs_1 = '';
    $he_2 = '';
    $hs_2 = '';
    $he_3 = '';
    $hs_3 = '';
    $inic_dia = '';
    $e_noct = '';
    $s_noct = '';
    $cd_turno = '';
    $dsp_turno = '';
    $dt_ini_dia = '';
    $dt_fim_dia = '';
    $min_esperados = 0;

    $hor_cad = '';
    $e_1_cad = '';
    $s_1_cad = '';
    $e_2_cad = '';
    $s_2_cad = '';
    $he_1_cad = '';
    $hs_1_cad = '';
    $he_2_cad = '';
    $hs_2_cad = '';
    $he_3_cad = '';
    $hs_3_cad = '';
    $inic_dia_cad = '';
    $e_noct_cad = '';
    $s_noct_cad = '';
    $cd_turno_cad = '';
    $dsp_turno_cad = '';
    $dt_ini_dia_cad = '';
    $dt_fim_dia_cad = '';
    $min_esperados_cad = 0;

    $estab = '';

    if ($debug) {
        echo "#0 empresa: $empresa rhid:$rhid dt_adm:$dt_adm dia:$dia<br/>";
    }

    # existe horário diário na escala definido ?
    get_dia_escala_horaria($empresa, $rhid, $dt_adm, $dia, $hor, $e_1, $s_1, $e_2, $s_2,
                           $he_1, $hs_1, $he_2, $hs_2, $he_3, $hs_3, $inic_dia, $e_noct, $s_noct, $cd_turno, $dsp_turno,
                           $dt_ini_dia, $dt_fim_dia, $min_esperados, $msg);

    if ($debug) {
        echo "#1 ESCALA hor:$hor pe1:$e_1-$s_1  pe2:$e_2-$s_2  phe1$he_1-$hs_1 phe2:$he_2-$hs_2 phe3:$he_3-$hs_3 inic_dia:$inic_dia  noct$e_noct-$s_noct<br/>";
    }

    if ($msg == '') {

        # existe horário na escala
        if ($hor != '') {
            $origem = 'E';
        }

        # procura horário de cadastro ponderando trocas de horário
        get_dia_troca_horario($empresa, $rhid, $dt_adm, $dia, $cd_hor, $tp_hor, $msg);

        if ($msg == '') {
            # tem troca de horário
            if ($cd_hor != '' && $tp_hor != '' && $origem == '') {
                $origem = 'T';
            }
        }

        if ($debug) {
            echo "#2 origem:$origem horsem cd:$cd_hor/$tp_hor <br/>";
        }

        # procura no cadastro
        $sql =  "SELECT p.CD_HORARIO, p.TP_HORARIO, e.CD_ESTAB, e.CD_ESTAB_TMP, h.HRS_DIA, p.DT_HORARIO ".
                "FROM RH_ID_PROFISSIONAIS p, RH_ID_EMPRESAS e, RH_DEF_HORARIOS h ".
                "WHERE p.EMPRESA = :EMPRESA_ ".
                "  AND p.RHID = :RHID_ ".
                "  AND p.DT_ADMISSAO = TO_DATE(:DT_ADMISSAO_,'YYYY-MM-DD') ".
                "  AND e.EMPRESA = p.EMPRESA ".
                "  AND e.RHID = p.RHID ".
                "  AND e.DT_ADMISSAO = p.DT_ADMISSAO ".
                "  AND h.CD_HORARIO = p.CD_HORARIO ".
                "  AND h.TP_HORARIO = p.TP_HORARIO";
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':EMPRESA_', $empresa, PDO::PARAM_STR);
            $stmt->bindParam(':RHID_', $rhid, PDO::PARAM_STR);
            $stmt->bindParam(':DT_ADMISSAO_', $dt_adm, PDO::PARAM_STR);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                # ainda não tem origem definida => cadastro
                if ($origem == '') {
                    $origem = 'C';
                }
                if ($origem != 'T') {
                    $cd_hor = $row['CD_HORARIO'];
                    $tp_hor = $row['TP_HORARIO'];
                }
                if ($row['CD_ESTAB_TMP'] != '') {
                    $estab = $row['CD_ESTAB_TMP'];
                } else {
                    $estab = $row['CD_ESTAB'];
                }

                if ($debug) {
                    echo "#3 origem:$origem horsem cd:$cd_hor/$tp_hor <br/>";
                }

                get_hor_diario_cadastro($empresa, $dia, $estab, $cd_hor, $tp_hor,
                                        $hor_cad, $e_1_cad, $s_1_cad, $e_2_cad, $s_2_cad,
                                        $he_1_cad, $hs_1_cad, $he_2_cad, $hs_2_cad, $he_3_cad, $hs_3_cad,
                                        $inic_dia_cad, $e_noct_cad, $s_noct_cad, $cd_turno_cad, $dsp_turno_cad,
                                        $dt_ini_dia_cad, $dt_fim_dia_cad, $min_esperados_cad, $msg);

                if ($debug) {
                    echo "#4 CAD hor:$hor_cad pe1:$e_1_cad-$s_1_cad  pe2:$e_2_cad-$s_2_cad  $he_1_cad-$hs_1_cad phe2:$he_2_cad-$hs_2_cad phe3:$he_3_cad-$hs_3_cad inic_dia:$inic_dia_cad  noct$e_noct_cad-$s_noct_cad<br/>";
                }

                break;
            }
        } catch (Exception $ex) {
                $msg = "get_hor_diario#1 :" . $ex->getMessage();
        }

    }

    if ($origem == 'T' || $origem == 'C') {
        $hor = $hor_cad;
        $e_1 = $e_1_cad;
        $s_1 = $s_1_cad;
        $e_2 = $e_2_cad;
        $s_2 = $s_2_cad;
        $he_1 = $he_1_cad;
        $hs_1 = $hs_1_cad;
        $he_2 = $he_2_cad;
        $hs_2 = $hs_2_cad;
        $he_3 = $he_3_cad;
        $hs_3 = $hs_3_cad;
        $inic_dia = $inic_dia_cad;
        $e_noct = $e_noct_cad;
        $s_noct = $s_noct_cad;
        $cd_turno = $cd_turno_cad;
        $dsp_turno = $dsp_turno_cad;
        $dt_ini_dia = $dt_ini_dia_cad;
        $dt_fim_dia = $dt_fim_dia_cad;
        $min_esperados = $min_esperados_cad;
    }
}

/* Minutos diários de trabalho esperado do horário do cadastro */
function get_min_trab_esp_cad($empresa, $rhid, $dt_adm, $dia, &$msg) {

    global $db;
    $msg =  '';
    $min_trab_esp_cad = 0;
    
    # procura no cadastro
    $sql =  "SELECT p.CD_HORARIO, p.TP_HORARIO, e.CD_ESTAB, e.CD_ESTAB_TMP, h.HRS_DIA, p.DT_HORARIO ".
            "FROM RH_ID_PROFISSIONAIS p, RH_ID_EMPRESAS e, RH_DEF_HORARIOS h ".
            "WHERE p.EMPRESA = :EMPRESA_ ".
            "  AND p.RHID = :RHID_ ".
            "  AND p.DT_ADMISSAO = TO_DATE(:DT_ADMISSAO_,'YYYY-MM-DD') ".
            "  AND e.EMPRESA = p.EMPRESA ".
            "  AND e.RHID = p.RHID ".
            "  AND e.DT_ADMISSAO = p.DT_ADMISSAO ".
            "  AND h.CD_HORARIO = p.CD_HORARIO ".
            "  AND h.TP_HORARIO = p.TP_HORARIO";
    try {
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':EMPRESA_', $empresa, PDO::PARAM_STR);
        $stmt->bindParam(':RHID_', $rhid, PDO::PARAM_STR);
        $stmt->bindParam(':DT_ADMISSAO_', $dt_adm, PDO::PARAM_STR);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $min_trab_esp_cad = $row['HRS_DIA'] * 60;
        }
    } 
    catch (Exception $ex) {
            $msg = "get_min_trab_esp_cad#1 :" . $ex->getMessage();
    }
    
    return $min_trab_esp_cad;
}

/* Validação de existência de um horário diário */
function horario_diario_existente ($cd_horario, $ativo, &$msg) {
    global $db;
    

    $cnt = 0;
    $sql = "SELECT CD_HOR_DIA FROM RH_DEF_HORARIO_DIAS WHERE CD_HOR_DIA = :HORARIO";
    if ($ativo) {
        $sql .= " AND ACTIVO = 'S'";
    }
    if ($cd_horario) {
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':HORARIO', $cd_horario, PDO::PARAM_STR);
            $stmt->execute();
            $cnt = $stmt->rowCount();
        } catch (Exception $ex) {
                $msg = "horario_diario_existente#1 :" . $ex->getMessage();
        }
    } else { //Se se limpar um horário de uma escala, dá como OK
        return 1;
    }
    return $cnt;

}


/* Minutos de trabalho esperado entre duas datas */
function get_min_trab_esp($empresa, $rhid, $dt_adm, $dt1, $dt2, &$msg) {

    $msg = '';
    $debug = false;
    $minutos = 0;

    $cd_hor = '';
    $tp_hor = '';
    $origem = '';
    $hor = '';
    $e_1 = '';
    $s_1 = '';
    $e_2 = '';
    $s_2 = '';
    $he_1 = '';
    $hs_1 = '';
    $he_2 = '';
    $hs_2 = '';
    $he_3 = '';
    $hs_3 = '';
    $inic_dia = '';
    $e_noct = '';
    $s_noct = '';
    $cd_turno = '';
    $dsp_turno = '';
    $dt_ini_dia = '';
    $dt_fim_dia = '';
    $dt_ini_ctx = '';
    $dt_fim_ctx = '';

    # Set timezone
    $default_timestamp = date_default_timezone_get();
    date_default_timezone_set('UTC');

    # data início
    $dia = substr($dt1,0,10);

    # obtenção da data início de contexto do 1º dia
    get_hor_diario($empresa, $rhid, $dt_adm, $dia,
                   $origem, $cd_hor, $tp_hor,
                   $hor, $e_1, $s_1, $e_2, $s_2,
                   $he_1, $hs_1, $he_2, $hs_2, $he_3, $hs_3, $inic_dia, $e_noct, $s_noct, $cd_turno, $dsp_turno,
                   $dt_ini_ctx, $dt_fim_dia, $msg);
    if ($dt1 < $dt_ini_ctx) {
        $dia = date('Y-m-d', strtotime($dia. ' - 1 day'));
        $dt_ini_ctx = $dia;
    }

    # data fim
    $end_date = substr($dt2,0,10);

    # obtenção da data de contexto do último dia
    get_hor_diario($empresa, $rhid, $dt_adm, $end_date,
                   $origem, $cd_hor, $tp_hor,
                   $hor, $e_1, $s_1, $e_2, $s_2,
                   $he_1, $hs_1, $he_2, $hs_2, $he_3, $hs_3, $inic_dia, $e_noct, $s_noct, $cd_turno, $dsp_turno,
                   $dt_fim_ctx, $dt_fim_dia, $msg);

    if ($dt2 < $dt_fim_ctx) {
        $end_date = date('Y-m-d', strtotime($end_date. ' - 1 day'));
        $dt_fim_ctx = $end_date;
    }

    if ($debug) {
        echo "rhid:$rhid  dt1:$dt1 dt2:$dt2 --- dia: $dia end_data:$end_date <br/>";
    }

    while (strtotime($dia) <= strtotime($end_date)) {

        get_hor_diario($empresa, $rhid, $dt_adm, $dia,
                       $origem, $cd_hor, $tp_hor,
                       $hor, $e_1, $s_1, $e_2, $s_2,
                       $he_1, $hs_1, $he_2, $hs_2, $he_3, $hs_3, $inic_dia, $e_noct, $s_noct, $cd_turno, $dsp_turno,
                       $dt_ini_dia, $dt_fim_dia, $msg);

        if ($dia == substr($dt_ini_ctx,0,10) && $dia == substr($dt_fim_ctx,0,10)) {
            # intervalo de tempo de trabalho esperado
            $var_h1 = get_gtime(substr($dt1,0,10), substr($dt1,11,5));
            $var_h2 = get_gtime(substr($dt2,0,10), substr($dt2,11,5));
            $passo = '#1';
        } elseif ($dia == substr($dt_ini_ctx,0,10)) {
            # intervalo de tempo de trabalho esperado
            $var_h1 = get_gtime(substr($dt1,0,10), substr($dt1,11,5));
            $var_h2 = get_gtime(substr($dt_fim_dia,0,10), substr($dt_fim_dia,11,5));
            $passo = '#2';
        } elseif ($dia == substr($dt_fim_ctx,0,10)) {
            # intervalo de tempo de trabalho esperado
            $var_h1 = get_gtime(substr($dt_ini_dia,0,10), substr($dt_ini_dia,11,5));
            $var_h2 = get_gtime(substr($dt2,0,10), substr($dt2,11,5));
            $passo = '#3';
        } else {
            # intervalo de tempo de trabalho esperado
            $var_h1 = get_gtime(substr($dt_ini_dia,0,10), substr($dt_ini_dia,11,5));
            $var_h2 = get_gtime(substr($dt_fim_dia,0,10), substr($dt_fim_dia,11,5));
            $passo = '#4';
        }

        if ($debug) {
            echo "ciclo [$passo] dia:$dia  intervalo:".date("Y-m-d H:i",$var_h1)." - ".date("Y-m-d H:i",$var_h2)."<br/>";
        }

        if ($msg == '') {

            $minutos_dia = 0;
            if ( ($e_1 != '' && $s_1 != '') || ($e_2 != '' && $s_2 != '')) {

                # horário esperado para o dia
                if ($e_1 <= $s_1) {
                    $var_e1 = get_gtime($dia, $e_1);
                    $var_s1 = get_gtime($dia, $s_1);
                } else {
                    $dia_1 = date('Y-m-d', strtotime($dia. ' + 1 day'));
                    $var_e1 = get_gtime($dia, $e_1);
                    $var_s1 = get_gtime($dia_1, $s_1);
                }

                if ($e_2 <= $s_2) {
                    $var_e2 = get_gtime($dia, $e_2);
                    $var_s2 = get_gtime($dia, $s_2);
                } else {
                    $dia_1 = date('Y-m-d', strtotime($dia. ' + 1 day'));
                    $var_e2 = get_gtime($dia, $e_2);
                    $var_s2 = get_gtime($dia_1, $s_2);
                }

                # so 1 periodo
                if ($var_e2 == '' || $var_s2 == '') {

                    $e = '';
                    $s = '';

                    if ($var_e1 >= $var_h2 || $var_s1 <= $var_h1) {
                        $minutos_dia = 0;
                    }
                    elseif ($var_e1 >= $var_h1 && $var_s1 <= $var_h2) {
                        $e = $var_e1;
                        $s = $var_s1;
                    }
                    elseif ($var_h2 > $var_e1 && $var_h2 <= $var_s1 && $var_h1 < $var_e1) {
                        $e = $var_e1;
                        $s = $var_h2;
                    }
                    elseif ($var_h1 >= $var_e1 && $var_h1 < $var_s1 && $var_h2 > $var_s1) {
                        $e = $var_h1;
                        $s = $var_s1;
                    }
                    else {
                        $e = $var_h1;
                        $s = $var_h2;
                    }

                    if ($s != '' && $e != '') {
                        $minutos_dia = ($s - $e)/60;
                        if (date("i",$s) == '59') {
                            $minutos_dia += 1;
                        }
                    } else {
                        $minutos_dia = 0;
                    }

                }
                # so 2 periodo
                elseif ($var_e1 == '' || $var_s1 == '') {

                    $e = '';
                    $s = '';

                    if ($var_e2 >= $var_h2 || $var_s2 <= $var_h1)
                        $minutos_dia = 0;
                    elseif ($var_e2 >= $var_h1 && $var_s2 <= $var_h2) {
                        $e = $var_e2;
                        $s = $var_s2;
                    }
                    elseif ($var_h2 > $var_e2 && $var_h2 <= $var_s2 && $var_h1 < $var_e2) {
                        $e = $var_e2;
                        $s = $var_h2;
                    }
                    elseif ($var_h1 >= $var_e2 && $var_h1 < $var_s2 && $var_h2 > $var_s2) {
                        $e = $var_h1;
                        $s = $var_s2;
                    }
                    else {
                        $e = $var_h1;
                        $s = $var_h2;
                    }

                    if ($s != '' && $e != '') {
                        $minutos_dia = ($s - $e)/60;
                        if (date("i",$s) == '59') {
                            $minutos_dia += 1;
                        }
                    } else {
                        $minutos_dia = 0;
                    }

                }
                # os dois periodos
                else {
                    # 1º periodo
                    $e = '';
                    $s = '';

                    if ($var_e1 >= $var_h2 || $var_s1 <= $var_h1) {
                        $minutos_dia += 0;
                    }
                    elseif ($var_e1 >= $var_h1 && $var_s1 <= $var_h2) {
                        $e = $var_e1;
                        $s = $var_s1;
                    }
                    elseif ($var_h2 > $var_e1 && $var_h2 <= $var_s1 && $var_h1 < $var_e1) {
                        $e = $var_e1;
                        $s = $var_h2;
                    }
                    elseif ($var_h1 >= $var_e1 && $var_h1 < $var_s1 && $var_h2 > $var_s1) {
                        $e = $var_h1;
                        $s = $var_s1;
                    }
                    else {
                        $e = $var_h1;
                        $s = $var_h2;
                    }
                    if ($s != '' && $e != '') {
                        $minutos_dia += ($s - $e)/60;
                        if (date("i",$s) == '59') {
                            $minutos_dia += 1;
                        }
                    }

                    # 2º periodo
                    $e = '';
                    $s = '';

                    if ($var_e2 >= $var_h2 || $var_s2 <= $var_h1) {
                        $minutos_dia += 0;
                    }
                    elseif ($var_e2 >= $var_h1 && $var_s2 <= $var_h2) {
                        $e = $var_e2;
                        $s = $var_s2;
                    }
                    elseif ($var_h2 > $var_e2 && $var_h2 <= $var_s2 && $var_h1 < $var_e2) {
                        $e = $var_e2;
                        $s = $var_h2;
                    }
                    elseif ($var_h1 >= $var_e2 && $var_h1 < $var_s2 && $var_h2 > $var_s2) {
                        $e = $var_h1;
                        $s = $var_s2;
                    }
                    else {
                        $e = $var_h1;
                        $s = $var_h2;
                    }
                    if ($s != '' && $e != '') {
                        $minutos_dia += ($s - $e)/60;
                        if (date("i",$s) == '59') {
                            $minutos_dia += 1;
                        }
                    }
                }
            }

            $minutos += $minutos_dia;

            if ($debug) {
                echo "dia ctx:$dia [$inic_dia] [$e_1-$s_1] [$e_2-$s_2] minutos:$minutos_dia <br/>";
            }

            $dia = date ("Y-m-d", strtotime("+1 day", strtotime($dia)));

        } else {
            break;
        }
    }

    date_default_timezone_set($default_timestamp);

    return $minutos;
}


/* Horas de trabalho esperado para um dia (bh = horas contratadas/horário cadastro, th = horas operacionais/escalas */
function get_bh_th_dia($empresa, $rhid, $dt_adm, $dia, &$bh, &$th, &$msg) {

    global $db;
    
    $msg = '';

    $origem = '';
    $hor = '';
    $e_1 = '';
    $s_1 = '';
    $e_2 = '';
    $s_2 = '';
    $he_1 = '';
    $hs_1 = '';
    $he_2 = '';
    $hs_2 = '';
    $he_3 = '';
    $hs_3 = '';
    $inic_dia = '';
    $e_noct = '';
    $s_noct = '';
    $cd_turno = '';
    $dsp_turno = '';
    $dt_ini_dia = '';
    $dt_fim_dia = '';

    $hor_cad = '';
    $e_1_cad = '';
    $s_1_cad = '';
    $e_2_cad = '';
    $s_2_cad = '';
    $he_1_cad = '';
    $hs_1_cad = '';
    $he_2_cad = '';
    $hs_2_cad = '';
    $he_3_cad = '';
    $hs_3_cad = '';
    $inic_dia_cad = '';
    $e_noct_cad = '';
    $s_noct_cad = '';
    $cd_turno_cad = '';
    $dsp_turno_cad = '';
    $dt_ini_dia_cad = '';
    $dt_fim_dia_cad = '';

    $cd_hor = '';
    $tp_hor = '';
    $estab = '';

    $hor_esp_min = 0;

    $th = 0;
    $bh = 0;

    # existe horário diário na escala definido ?
    get_dia_escala_horaria($empresa, $rhid, $dt_adm, $dia, $hor, $e_1, $s_1, $e_2, $s_2,
                           $he_1, $hs_1, $he_2, $hs_2, $he_3, $hs_3, $inic_dia, $e_noct, $s_noct, $cd_turno, $dsp_turno,
                           $dt_ini_dia, $dt_fim_dia, $hor_esp_min, $msg);

    if ($msg == '') {

        # existe horário na escala
        if ($hor != '') {
            $origem = 'E';
        }

        # procura horário de cadastro ponderando trocas de horário
        get_dia_troca_horario($empresa, $rhid, $dt_adm, $dia, $cd_hor, $tp_hor, $msg);

        if ($msg == '') {
            # tem troca de horário
            if ($cd_hor != '' && $tp_hor != '' && $origem == '') {
                $origem = 'T';
            }
        }

        # procura no cadastro
        $sql =  "SELECT p.CD_HORARIO, p.TP_HORARIO, e.CD_ESTAB, e.CD_ESTAB_TMP, h.HRS_DIA, p.DT_HORARIO ".
                "FROM RH_ID_PROFISSIONAIS p, RH_ID_EMPRESAS e, RH_DEF_HORARIOS h ".
                "WHERE p.EMPRESA = :EMPRESA_ ".
                "  AND p.RHID = :RHID_ ".
                "  AND p.DT_ADMISSAO = TO_DATE(:DT_ADMISSAO_,'YYYY-MM-DD') ".
                "  AND e.EMPRESA = p.EMPRESA ".
                "  AND e.RHID = p.RHID ".
                "  AND e.DT_ADMISSAO = p.DT_ADMISSAO ".
                "  AND h.CD_HORARIO = p.CD_HORARIO ".
                "  AND h.TP_HORARIO = p.TP_HORARIO";
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':EMPRESA_', $empresa, PDO::PARAM_STR);
            $stmt->bindParam(':RHID_', $rhid, PDO::PARAM_STR);
            $stmt->bindParam(':DT_ADMISSAO_', $dt_adm, PDO::PARAM_STR);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                # ainda não tem origem definida => cadastro
                if ($origem == '') {
                    $origem = 'C';
                }
                if ($origem != 'T') {
                    $cd_hor = $row['CD_HORARIO'];
                    $tp_hor = $row['TP_HORARIO'];
                }
                if ($row['CD_ESTAB_TMP'] != '') {
                    $estab = $row['CD_ESTAB_TMP'];
                } else {
                    $estab = $row['CD_ESTAB'];
                }

                get_hor_diario_cadastro($empresa, $dia, $estab, $cd_hor, $tp_hor,
                                        $hor_cad, $e_1_cad, $s_1_cad, $e_2_cad, $s_2_cad,
                                        $he_1_cad, $hs_1_cad, $he_2_cad, $hs_2_cad, $he_3_cad, $hs_3_cad,
                                        $inic_dia_cad, $e_noct_cad, $s_noct_cad, $turno_cad, $dsp_turno_cad,
                                        $dt_ini_dia_cad, $dt_fim_dia_cad, $hor_esp_min_cad, $msg);
                break;
            }
        } catch (Exception $ex) {
                $msg = "rhid_horario_diario#1 :" . $ex->getMessage();
        }

    }

    $th = 0;
    $bh = 0;

    # se não existe escala => horário a considerar é o do cadastro...
    if ($msg == '') {
        if ($origem == 'E') {
            $bh = round($hor_esp_min_cad/60,2);
        }
    }

    # verifica se existe base horária registada
    $bhor = get_base_horaria ($empresa, $rhid, $dt_adm, $dia, $msg);
    if ($bhor != '') {
        $bh = $bhor;
    }

    # contabilização tempo esperado para o horário do dia
    if ($msg == '' &&
        ( ($e_1 != '' &&  $s_1 != '') || ($e_2 != '' && $s_2 != '') ) ) { # existe tempo esperado

        ## contabilização das horas operacionais esperadas (th)
        if ($origem == 'E') { # se origem é escala
            $th = round($hor_esp_min/60,2);
        } else { # não existe escala => th = bh
            if ($bh == '') {
                $bh = round($hor_esp_min/60,2);
            }
            $th = $bh;
        }
    }
}

/* Horário diário do rhid num dia
        origem = 'E'scala, 'C'adastro, 'T'roca

   Recorre a: get_dia_escala_horaria, get_dia_troca_horario, get_hor_diario_cadastro
*/
function rhid_horario_diario($empresa, $rhid, $dt_adm, $dia, $inclui_indisp,
                             &$origem, &$hor, &$e_1, &$s_1, &$e_2, &$s_2,
                             &$he_1, &$hs_1, &$he_2, &$hs_2, &$he_3, &$hs_3, &$inic_dia, &$e_noct, &$s_noct,
                             &$hor_esp_min, &$hor_esp_hrs,
                             &$indisp_fer, &$indisp_dc, &$indisp_aus, &$indisp_bh,
                             &$bh, &$th, &$bh_transp, &$th_transp,
                             &$cd_turno, &$dsp_turno,
                             &$msg) {

    global $db;
    $debug = false;
    
    $msg = '';

    $origem = '';
    $hor = '';
    $e_1 = '';
    $s_1 = '';
    $e_2 = '';
    $s_2 = '';
    $he_1 = '';
    $hs_1 = '';
    $he_2 = '';
    $hs_2 = '';
    $he_3 = '';
    $hs_3 = '';
    $inic_dia = '';
    $e_noct = '';
    $s_noct = '';
    $cd_turno = '';
    $dsp_turno = '';
    $dt_ini_dia = '';
    $dt_fim_dia = '';

    $hor_cad = '';
    $e_1_cad = '';
    $s_1_cad = '';
    $e_2_cad = '';
    $s_2_cad = '';
    $he_1_cad = '';
    $hs_1_cad = '';
    $he_2_cad = '';
    $hs_2_cad = '';
    $he_3_cad = '';
    $hs_3_cad = '';
    $inic_dia_cad = '';
    $e_noct_cad = '';
    $s_noct_cad = '';
    $cd_turno_cad = '';
    $dsp_turno_cad = '';
    $dt_ini_dia_cad = '';
    $dt_fim_dia_cad = '';
    $hor_esp_min_cad = 0;

    $cd_hor = '';
    $tp_hor = '';
    $estab = '';

    $hor_esp_min = 0;
    $hor_esp_hrs = '00:00';
    $indisp_fer = '';
    $indisp_dc = '';
    $indisp_aus = '';
    $indisp_bh = '';

    if ($debug) {
        echo "#0 empresa: $empresa rhid:$rhid dt_adm:$dt_adm dia:$dia<br/>";
    }

    # existe horário diário na escala definido ?
    get_dia_escala_horaria($empresa, $rhid, $dt_adm, $dia, $hor, $e_1, $s_1, $e_2, $s_2,
                           $he_1, $hs_1, $he_2, $hs_2, $he_3, $hs_3, $inic_dia, $e_noct, $s_noct, $cd_turno, $dsp_turno,
                           $dt_ini_dia, $dt_fim_dia, $hor_esp_min, $msg);

    if ($debug) {
        echo "#1 ESCALA hor:$hor pe1:$e_1-$s_1  pe2:$e_2-$s_2  phe1$he_1-$hs_1 phe2:$he_2-$hs_2 phe3:$he_3-$hs_3 inic_dia:$inic_dia  noct$e_noct-$s_noct msg:$msg<br/>";
    }

    if ($msg == '') {

        # existe horário na escala
        if ($hor != '') {
            $origem = 'E';
        }

        # procura horário de cadastro ponderando trocas de horário
        #get_dia_troca_horario($empresa, $rhid, $dt_adm, $dia, $cd_hor, $tp_hor, $msg);

        if ($msg == '') {
            # tem troca de horário
            if ($cd_hor != '' && $tp_hor != '' && $origem == '') {
                $origem = 'T';
            }
        }

        if ($debug) {
            echo "#2 origem:$origem horsem cd:$cd_hor/$tp_hor <br/>";
        }

        # procura no cadastro
        $sql =  "SELECT p.CD_HORARIO, p.TP_HORARIO, e.CD_ESTAB, e.CD_ESTAB_TMP, h.HRS_DIA, p.DT_HORARIO ".
                "FROM RH_ID_PROFISSIONAIS p, RH_ID_EMPRESAS e, RH_DEF_HORARIOS h ".
                "WHERE p.EMPRESA = :EMPRESA_ ".
                "  AND p.RHID = :RHID_ ".
                "  AND p.DT_ADMISSAO = TO_DATE(:DT_ADMISSAO_,'YYYY-MM-DD') ".
                "  AND e.EMPRESA = p.EMPRESA ".
                "  AND e.RHID = p.RHID ".
                "  AND e.DT_ADMISSAO = p.DT_ADMISSAO ".
                "  AND h.CD_HORARIO = p.CD_HORARIO ".
                "  AND h.TP_HORARIO = p.TP_HORARIO";
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':EMPRESA_', $empresa, PDO::PARAM_STR);
            $stmt->bindParam(':RHID_', $rhid, PDO::PARAM_STR);
            $stmt->bindParam(':DT_ADMISSAO_', $dt_adm, PDO::PARAM_STR);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                # ainda não tem origem definida => cadastro
                if ($origem == '') {
                    $origem = 'C';
                }
                if ($origem != 'T') {
                    $cd_hor = $row['CD_HORARIO'];
                    $tp_hor = $row['TP_HORARIO'];
                }
                if ($row['CD_ESTAB_TMP'] != '') {
                    $estab = $row['CD_ESTAB_TMP'];
                } else {
                    $estab = $row['CD_ESTAB'];
                }

                if ($debug) {
                    echo "#3 origem:$origem horsem cd:$cd_hor/$tp_hor <br/>";
                }

                get_hor_diario_cadastro($empresa, $dia, $estab, $cd_hor, $tp_hor,
                                        $hor_cad, $e_1_cad, $s_1_cad, $e_2_cad, $s_2_cad,
                                        $he_1_cad, $hs_1_cad, $he_2_cad, $hs_2_cad, $he_3_cad, $hs_3_cad,
                                        $inic_dia_cad, $e_noct_cad, $s_noct_cad, $cd_turno_cad, $dsp_turno_cad,
                                        $dt_ini_dia_cad, $dt_fim_dia_cad, $hor_esp_min_cad, $msg);

                if ($debug) {
                    echo "#4 CAD hor:$hor_cad pe1:$e_1_cad-$s_1_cad  pe2:$e_2_cad-$s_2_cad  phe1:$he_1_cad-$hs_1_cad phe2:$he_2_cad-$hs_2_cad phe3:$he_3_cad-$hs_3_cad inic_dia:$inic_dia_cad  noct$e_noct_cad-$s_noct_cad<br/>";
                }

                break;
            }
        } catch (Exception $ex) {
                $msg = "rhid_horario_diario#1 :" . $ex->getMessage();
        }

    }

    $th = 0;
    $bh = 0;

    # se não existe escala => horário a considerar é o do cadastro...
    if ($msg == '') {
        if ($origem == 'T' || $origem == 'C') {
            $hor = $hor_cad;
            $e_1 = $e_1_cad;
            $s_1 = $s_1_cad;
            $e_2 = $e_2_cad;
            $s_2 = $s_2_cad;
            $he_1 = $he_1_cad;
            $hs_1 = $hs_1_cad;
            $he_2 = $he_2_cad;
            $hs_2 = $hs_2_cad;
            $he_3 = $he_3_cad;
            $hs_3 = $hs_3_cad;
            $inic_dia = $inic_dia_cad;
            $e_noct = $e_noct_cad;
            $s_noct = $s_noct_cad;
            $cd_turno = $cd_turno_cad;
            $dsp_turno = $dsp_turno_cad;
            $dt_ini_dia = $dt_ini_dia_cad;
            $dt_fim_dia = $dt_fim_dia_cad;
            $hor_esp_min = $hor_esp_min_cad;
        } else {
            # horário diário a considerar é o da escala logo th != bh e será necessário contabilizar bh (horas esperadas do horário
            $bh = round($hor_esp_min_cad/60,2);
        }
    }

    # verifica se existe base horária registada
    $bhor = get_base_horaria ($empresa, $rhid, $dt_adm, $dia, $msg);
    if ($bhor != '') {
        $bh = $bhor;
    }

    # contabilização tempo esperado para o horário do dia
    if ($msg == '') { # existe tempo esperado

        $hor_esp_hrs = convertToHH_MI($hor_esp_min);

        ## contabilização das horas operacionais esperadas (th)
        if ($origem == 'E') { # se origem é escala
            $th = round($hor_esp_min/60,2);
        } else { # não existe escala => th = bh
            if ($bh == '') {
                $bh = round($hor_esp_min/60,2);
            }
            $th = $bh;
        }
    }

    # indisponibilidades
    if ($msg == '' && $inclui_indisp == 'S' && $dt_ini_dia != '' && $dt_fim_dia != '') {
           indisponibilidade_no_dia ($empresa, $rhid, $dt_adm, $dt_ini_dia, $dt_fim_dia, $indisp_fer, $indisp_dc, $indisp_aus, $indisp_bh, $msg);
    }

    # extensibilidade ao transporte de th
    $bh_transp = 0;
    $th_transp = 0;

    # primeiro dia do mês == primeiro dia da semana ?
    if (substr($dia,8,2) == '01') {
        
        $dia_sem = date("N", strtotime($dia));
        # o início do mês coincide com o início da semana ?
        if ((inicio_semana() == 'SEG' && $dia_sem == '1') ||
            (inicio_semana() == 'DOM' && $dia_sem == '7')) {
            null;
        } else {
            $ano = '';
            $semana = '';
            semana_ano($dia, $ano, $semana);
            $dia1_semana = primeiro_dia_semana($ano, $semana);
#echo "ano:$ano semana:$semana 1dia:$dia1_semana<br/>";

            $begin = new DateTime($dia1_semana);
            $end = new DateTime($dia);
            $interval = DateInterval::createFromDateString('1 day');
            $period = new DatePeriod($begin, $interval, $end);
            foreach ($period as $dt) {
                $dia_cycle = $dt->format("Y-m-d");
                $bh_day = 0;
                $th_day = 0;
                get_bh_th_dia($empresa, $rhid, $dt_adm, $dia_cycle, $bh_day, $th_day, $msg);
                $bh_transp += $bh_day;
                $th_transp += $th_day;
#echo "dia:$dia_cycle day: bh:$bh_day th:$th_day  totais: bh:$bh_transp th:$th_transp msg:$msg<br/>";
            }
        }
    }


}

/* Obtem parâmetro de ausência */
function get_param_aus($cd_, &$msg) {

    global $db;
    $msg = '';
    $param = array();
    
    # procura no cadastro
    $sql =  "SELECT a.* ".
            "FROM RH_DEF_AUSENCIAS a ".
            "WHERE a.CD_AUSENCIA = :CD_ ";
    try {
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':CD_', $cd_, PDO::PARAM_STR);
        $stmt->execute();
        $param = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $ex) {
            $msg = "get_param_aus#1 :" . $ex->getMessage();
    }
    return $param;
}

/* Determina a regra de adaptabilidade aplicável ao colaborador */
function get_param_adap($empresa, $rhid, $dt_adm, &$msg) {

    global $db;
    $msg = '';
    $regra = array();
    
    # procura no cadastro
    $sql =  "SELECT r.* ".
            "FROM RH_ID_ADAPTABILIDADES p, RH_DEF_REGRAS_ADAPTABILIDADE r ".
            "WHERE p.EMPRESA = :EMPRESA_ ".
            "  AND p.RHID = :RHID_ ".
            "  AND p.DT_ADMISSAO = TO_DATE(:DT_ADMISSAO_,'YYYY-MM-DD') ".
            "  AND p.DT_FIM_HDR IS NULL ".
            "  AND r.CD_IRCT = p.CD_IRCT ".
            "  AND r.DT_EFICACIA = p.DT_EFICACIA ".
            "  AND r.DT_INI_RA = p.DT_INI_RA ";
    try {
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':EMPRESA_', $empresa, PDO::PARAM_STR);
        $stmt->bindParam(':RHID_', $rhid, PDO::PARAM_STR);
        $stmt->bindParam(':DT_ADMISSAO_', $dt_adm, PDO::PARAM_STR);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $regra = $row;
            break;
        }
    } catch (Exception $ex) {
            $msg = "get_param_adap#1 :" . $ex->getMessage();
    }
    return $regra;
}


/* Efetua a contabilização de registo de gestão de tempo 
 * 
 *  resource = {
 *      empresa: "DEMO",
 *      rhid: "355",
 *      dt_adm: "2019-03-01",
 *      dt_ini: "2019-01-01 12:23",
 *      dt_fim: "2019-01-01 17:11",
 *      tabela: "xpto",
 *  }
 * 
 *  devolve:
 *  
 *      $dadosOut = array(
 *                      "error" => "",
 *                      "DCAL" => $dcal,
 *                      "DUTS" => $duts,
 *                      "MCAL" => $mcal,
 *                      "MUTS" => $muts
 *                  );             
 */
function contabilizacao_registo($resource, &$msg) {
    
    $msg = '';

    $dcal = 0;
    $duts = 0;
    $muts = 0;
    $mcal = 0;
    $dadosOut = array();
    
    if ($resource->empresa != '' && $resource->rhid != '' && $resource->dt_adm != '' && 
        $resource->dt_ini != '' && $resource->dt_fim != '') {

        # contabilização dos dias e minutos de calendário
        #$date1 = strtotime(substr($resource->dt_ini,0,10));
        #$date2 = strtotime(substr($resource->dt_fim,0,10));
        $date1 = strtotime($resource->dt_ini);
        $date2 = strtotime($resource->dt_fim);
        $diff = abs($date2 - $date1);  
        $dcal = round($diff/(60*60*24)); 
        $mcal = round($diff/60); 
#echo "dt_ini:".substr($resource->dt_ini,0,10)." dt_fim:".substr($resource->dt_fim,0,10)."  date1:$date1 date2:$date2 diff:$diff dcal:$dcal mcal:$mcal<br/>";        
        if ( $resource->tabela == 'RH_ID_AUSENCIAS' ||
             $resource->tabela == 'RH_ID_FERIAS' ||
             $resource->tabela == 'RH_ID_DC_DEBITOS' ||
            ($resource->tabela == 'RH_ID_DET_ADAPTABILIDADES' && ($resource->tp_ocorrencia == 'HD' || $resource->tp_ocorrencia == 'FD'))
            ) {
            
            # contabilização dos dias e minutos úteis
            $muts = get_min_trab_esp($resource->empresa, $resource->rhid, $resource->dt_adm, 
                                     $resource->dt_ini, $resource->dt_fim, $msg);
            
            # determinar com base no nr.minutos do horário diário do cadastro..
            $min_dia_hor_cad = get_min_trab_esp_cad($resource->empresa, $resource->rhid, $resource->dt_adm, $resource->dt_ini, $msg);
            
            $duts = 0;
            if ($msg == '') {
                if ($min_dia_hor_cad != 0) {
                    $duts = round($muts / $min_dia_hor_cad);
                }
            }
            
        }
        elseif($resource->tabela == 'RH_ID_TS_HV'  ||
               ($resource->tabela == 'RH_ID_DET_ADAPTABILIDADES' && ($resource->tp_ocorrencia == 'HC' || $resource->tp_ocorrencia == 'FC'))
              ) {
            
            # contabilização dos dias e minutos úteis
            $duts = $dcal;
            $muts = $mcal;
        }
        
        if ($msg == '') {
            $dadosOut = array(
                    "error" => "",
                    "DCAL" => $dcal,
                    "DUTS" => $duts,
                    "MCAL" => $mcal,
                    "MUTS" => $muts
            );            
        }
        
    }
    
    return $dadosOut;
}


// Devolve indicação se colaborador tem tratamento de ponto
function getRhidTratPonto ($empresa, $rhid, $dt_adm, &$msg) {    
    global $db;
    
    $msg = '';
    $res = 'N';
    $sql = "SELECT A.PONTO, B.TRATAMENTO_PONTO ".
           "FROM RH_ID_EMPRESAS A, RH_DEF_SITUACOES B ".
           "WHERE A.EMPRESA = :EMPRESA_ ".
           "  AND A.RHID = :RHID_ ".
           "  AND A.DT_ADMISSAO = :DT_ADM_ ".
           "  AND A.CD_SITUACAO = B.CD_SITUACAO ";
    try {
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':EMPRESA_', $empresa, PDO::PARAM_STR);
        $stmt->bindParam(':RHID_', $rhid, PDO::PARAM_STR);
        $stmt->bindParam(':DT_ADM_', $dt_adm, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row['PONTO'] == 'S' && $row['TRATAMENTO_PONTO'] == 'S') {
            $res = 'S';
        }
    } catch (Exception $ex) {
            $msg = "getRhidTratPonto [$empresa,$rhid,$dt_adm]: " . $ex->getMessage();
    }
    return $res;
}

//Devolve todo o registo do mês em processamento
function getAnoMesProcessamento ($empresa, &$msg) {    
    global $db;
    
    $msg = '';
    $sql = "SELECT A.* ".
           "FROM DG_MESES A ".
           "WHERE A.EMPRESA = :EMPRESA AND A.RH_ESTADO = 'B' ";
    try {
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':EMPRESA', $empresa, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    } catch (Exception $ex) {
            $msg = "getAnoAberto [$empresa]: " . $ex->getMessage();
    }
}

//Devolve todos o registo do (menor) ANO ABERTO de uma EMPRESA
function getAnoAberto ($empresa, &$msg) {    
    global $db;
    $msg = '';
    $sql = "SELECT A.*, B.DT_INI_PER_ASSID, B.DT_FIM_PER_ASSID ".
           "FROM DG_ANOS A ".
           "  LEFT JOIN DG_MESES B ON B.EMPRESA = A.EMPRESA AND B.ANO = A.ANO AND B.ESTADO_PER_ASSID = 'B' ".
           "WHERE A.EMPRESA = :EMPRESA AND A.ESTADO = 'A' ".
           "ORDER BY A.ANO DESC LIMIT 1";
    try {
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':EMPRESA', $empresa, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    } catch (Exception $ex) {
        $msg = "getAnoAberto [$empresa]: " . $ex->getMessage();
    }
}

//Devolve para o ANO ABERTO os dados de FERIAS de um RHID/EMPRESA/DT_ADMISSAO
/*
     resource = {
        empresa: "DEMO",
        rhid: "355",
        dt_adm: "2019-03-01",
        ano: "2019"
    }
 */
function getRhidFerias ($resource, &$msg) {    
    global $db;
    $msg = '';
    $result = array();
    if (isset($resource->empresa) && isset($resource->rhid) && isset($resource->dt_adm)) {

        $ano = $resource->ano;
        if ($ano == '') {
            $dados = getAnoAberto($resource->empresa, $msg);
            $ano = $dados['ANO'];
        }

        $sql = "SELECT A.CRED_ACRESCIMO, A.CRED_ANO, A.CRED_ANO_ANTERIOR, A.DIAS_PAGOS, NVL(SUM(C.NR_DIAS_UTEIS),0) TOT_DIAS, NVL(SUM(B.NR_DIAS_UTEIS),0) TOT_WKF  ".
               "FROM RH_ID_ANO A ".
               "     LEFT JOIN RH_ID_FERIAS_WKF B ON B.EMPRESA = A.EMPRESA AND B.RHID = A.RHID AND B.DT_ADMISSAO = A.DT_ADMISSAO AND B.ANO = A.ANO AND B.REJECTED = 'N' AND B.FINISHED = 'N' AND B.OPERACAO = 'INSERT' ".
               "     LEFT JOIN RH_ID_FERIAS C ON C.EMPRESA = A.EMPRESA AND C.RHID = A.RHID AND C.DT_ADMISSAO = A.DT_ADMISSAO AND C.ANO = A.ANO ".
               "WHERE A.EMPRESA = :EMPRESA AND A.RHID = :RHID AND A.DT_ADMISSAO = TO_DATE(:DT_ADM, 'YYYY-MM-DD') AND A.ANO = :ANO ".
               "GROUP BY A.CRED_ACRESCIMO, A.CRED_ANO, A.CRED_ANO_ANTERIOR, A.DIAS_PAGOS";
        
        if (isset($resource->acao) && isset($resource->meios_dias_ferias) && isset($resource->dt_ini)) {
            if ($resource->acao == 'UPDATE') {
                $sql = "SELECT A.CRED_ACRESCIMO, A.CRED_ANO, A.CRED_ANO_ANTERIOR, A.DIAS_PAGOS, NVL(SUM(C.NR_DIAS_UTEIS),0) TOT_DIAS, NVL(SUM(B.NR_DIAS_UTEIS),0) TOT_WKF  ".
                       "FROM RH_ID_ANO A ".
                       "     LEFT JOIN RH_ID_FERIAS_WKF B ON B.EMPRESA = A.EMPRESA AND B.RHID = A.RHID AND B.DT_ADMISSAO = A.DT_ADMISSAO AND B.ANO = A.ANO AND B.REJECTED = 'N' AND B.FINISHED = 'N' AND B.OPERACAO = 'INSERT' ";

                if ($resource->meios_dias_ferias == 'S') {
                    $sql .= "     LEFT JOIN RH_ID_FERIAS C ON C.EMPRESA = A.EMPRESA AND C.RHID = A.RHID AND C.DT_ADMISSAO = A.DT_ADMISSAO AND C.ANO = A.ANO AND DATE_FORMAT(C.DT_INI,'%Y-%m-%d %H:%i') != :DT_INI ";
                }
                else {
                    $sql .= "     LEFT JOIN RH_ID_FERIAS C ON C.EMPRESA = A.EMPRESA AND C.RHID = A.RHID AND C.DT_ADMISSAO = A.DT_ADMISSAO AND C.ANO = A.ANO AND DATE_FORMAT(C.DT_INI,'%Y-%m-%d') != :DT_INI ";
                }

                $sql .= "WHERE A.EMPRESA = :EMPRESA AND A.RHID = :RHID AND A.DT_ADMISSAO = TO_DATE(:DT_ADM, 'YYYY-MM-DD') AND A.ANO = :ANO ".
                        "GROUP BY A.CRED_ACRESCIMO, A.CRED_ANO, A.CRED_ANO_ANTERIOR, A.DIAS_PAGOS";
            }
        }
        
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':EMPRESA', $resource->empresa, PDO::PARAM_STR);
            $stmt->bindParam(':RHID', $resource->rhid, PDO::PARAM_STR);
            $stmt->bindParam(':DT_ADM', $resource->dt_adm, PDO::PARAM_STR);
            $stmt->bindParam(':ANO', $ano, PDO::PARAM_STR);
            if (isset($resource->acao) && isset($resource->meios_dias_ferias) && isset($resource->dt_ini)) {
                if ($resource->acao == 'UPDATE') {
                    $dt = $resource->dt_ini;
                    if ($resource->meios_dias_ferias != 'S') {
                        $dt = substr($resource->dt_ini,0,10);
                    }
                    $stmt->bindParam(':DT_INI', $dt, PDO::PARAM_STR);
                }
            }
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $ex) {
                $msg = "getRhidFerias [$resource->empresa, $resource->rhid, $resource->dt_adm, $ano]: " . $ex->getMessage();
        }
    } 
    else {
        return $result;
    }
}

//Devolve a QUANTIDADE em minutos de TS TOTAL e em Workflow de um RHID/EMPRESA/DT_ADMISSAO/ANO (aberto, se parâmetro não for indicado)
function getRhidTS ($empresa, $rhid, $dt_adm, $ano, &$msg) {    
    global $db;
    
    $msg = '';
    $result = array();
    
    if ($ano == '') {
        $ano = getAnoAberto($empresa, $msg);
    }
    
    $sql = "SELECT NVL(SUM(B.DURACAO),0) TOT_APROVADO ".
           "     , NVL(SUM(A.DURACAO),0) TOT_WKF ".
           "FROM RH_ID_EMPRESAS E ".
           "     LEFT JOIN RH_ID_TS_HV_WKF A ON A.EMPRESA = E.EMPRESA AND A.RHID = E.RHID AND A.DT_ADMISSAO = E.DT_ADMISSAO AND A.FINISHED = 'N' AND A.REJECTED = 'N' AND A.OPERACAO = 'INSERT' ".
           "     LEFT JOIN RH_ID_TS_HV B ON B.EMPRESA = E.EMPRESA AND B.RHID = E.RHID AND B.DT_ADMISSAO = E.DT_ADMISSAO ".
#           "     LEFT JOIN RH_ID_TS_HV_WKF A ON A.EMPRESA = E.EMPRESA AND A.RHID = E.RHID AND A.DT_ADMISSAO = E.DT_ADMISSAO AND TO_CHAR(A.DT_INI,'YYYY') = :ANO AND A.FINISHED = 'N' AND A.REJECTED = 'N' AND A.OPERACAO = 'INSERT' ".
#           "     LEFT JOIN RH_ID_TS_HV B ON B.EMPRESA = E.EMPRESA AND B.RHID = E.RHID AND B.DT_ADMISSAO = E.DT_ADMISSAO AND TO_CHAR(B.DT_INI,'YYYY') = :ANO  ".
           "WHERE E.EMPRESA = :EMPRESA  ".
           "  AND E.RHID = :RHID  ".
           "  AND E.DT_ADMISSAO = TO_DATE(:DT_ADM, 'YYYY-MM-DD')"; 

    try {
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':EMPRESA', $empresa, PDO::PARAM_STR);
        $stmt->bindParam(':RHID', $rhid, PDO::PARAM_STR);
        $stmt->bindParam(':DT_ADM', $dt_adm, PDO::PARAM_STR);
#        $stmt->bindParam(':ANO', $ano, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    } catch (Exception $ex) {
            $msg = "getRhidTS [$empresa, $rhid, $dt_adm, $ano]: " . $ex->getMessage();
    }
}

//Devolve a QUANTIDADE dos Saldos em minutos de Créditos e Débitos Aprovados e em Workflow para um RHID/EMPRESA/DT_ADMISSAO/ANO (aberto, se parâmetro não for indicado)
function getRhidAdaptabilidades ($resource, &$msg) {    
    global $db;
    
    $msg = '';
    $result = array();
    
    if (isset($resource->empresa) && isset($resource->rhid) && isset($resource->dt_adm)) {
        $sql = "SELECT NVL(SUM(IF (A.TP_OCORRENCIA = 'HC',A.DURACAO_MINUTOS, 0)),0) APROVADO_CRED, ".
               "       NVL(SUM(IF (B.TP_OCORRENCIA = 'HC',B.DURACAO_MINUTOS, 0)),0) WORKFLOW_CRED, ".
               "       NVL(SUM(IF (A.TP_OCORRENCIA = 'HD',A.DURACAO_MINUTOS, 0)),0) APROVADO_DEB, ".
               "       NVL(SUM(IF (B.TP_OCORRENCIA = 'HD',B.DURACAO_MINUTOS, 0)),0) WORKFLOW_DEB ".
               "FROM RH_ID_EMPRESAS E ";
        
        if (isset($resource->acao) && isset($resource->dt_ini) && $resource->acao == 'UPDATE') {
            $sql.= "     LEFT JOIN RH_ID_DET_ADAPTABILIDADES A ON A.EMPRESA = E.EMPRESA AND A.RHID = E.RHID AND A.DT_ADMISSAO = E.DT_ADMISSAO AND DATE_FORMAT(DT_INI_DET,'%Y-%m-%d %H:%i') != :DT_INI ";
        }
        else {
            $sql.= "     LEFT JOIN RH_ID_DET_ADAPTABILIDADES A ON A.EMPRESA = E.EMPRESA AND A.RHID = E.RHID AND A.DT_ADMISSAO = E.DT_ADMISSAO ";
        }

        $sql.= "     LEFT JOIN RH_ID_DET_ADAPTABILIDADES_WKF B ON B.EMPRESA = E.EMPRESA AND B.RHID = E.RHID AND B.DT_ADMISSAO = E.DT_ADMISSAO AND B.REJECTED = 'N' AND B.FINISHED = 'N' AND B.OPERACAO = 'INSERT' ".
               "WHERE E.EMPRESA = :EMPRESA ".
               "  AND E.RHID = :RHID ".
               "  AND A.DT_ADMISSAO = TO_DATE(:DT_ADM, 'YYYY-MM-DD') ";

        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':EMPRESA', $resource->empresa, PDO::PARAM_STR);
            $stmt->bindParam(':RHID', $resource->rhid, PDO::PARAM_STR);
            $stmt->bindParam(':DT_ADM', $resource->dt_adm, PDO::PARAM_STR);
            if (isset($resource->acao) && isset($resource->dt_ini) && $resource->acao == 'UPDATE') {
                $stmt->bindParam(':DT_INI', $resource->dt_ini, PDO::PARAM_STR);
            }
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        } catch (Exception $ex) {
            $msg = "getRhidAdaptabilidades [$resource->empresa, $resource->rhid, $resource->dt_adm] -> $sql: " . $ex->getMessage();
        }
    } 
    else {
        return $result;
    }
}

//Devolve a QUANTIDADE dos Saldos em minutos de DESCANSO COMEPNSATÓRIO COM Créditos e Débitos Aprovados e em Workflow para um RHID/EMPRESA/DT_ADMISSAO
function getRhidDC ($resource, &$msg) {    
    global $db;
    
    $msg = '';
    $result = array();
    
    if (isset($resource->empresa) && isset($resource->rhid) && isset($resource->dt_adm)) {
            
        $sql =  "SELECT  ROUND(NVL(SUM(A.QTD_INICIAL),0))  CREDITOS,  ".
                "        ROUND(NVL(B.QTD_USADA,0)) DEBITOS_APROVADOS,  ".
                " 	     ROUND(NVL(C.QTD_USADA,0)) DEBITOS_WORKFLOW  ".
                "FROM RH_ID_DC_CREDITOS A  ";
        
        if (isset($resource->acao) && isset($resource->dt_ini) && $resource->acao == 'UPDATE') {
            $sql .= "	LEFT JOIN  ".
                    "		(SELECT EMPRESA, RHID, DT_ADMISSAO, NVL(SUM(QTD_USADA),0) QTD_USADA ".
                    "		 FROM RH_ID_DC_DEBITOS  ".
                    "            WHERE EMPRESA = :EMPRESA ".
                    "              AND RHID = :RHID ".
                    "              AND DT_ADMISSAO = :DT_ADM ".
                    "              AND DATE_FORMAT(GOZOU_DE,'%Y-%m-%d %H:%i') != :DT_INI ".
                    "		 GROUP BY EMPRESA, RHID, DT_ADMISSAO ".
                    "		) B ON B.EMPRESA = A.EMPRESA AND B.RHID = A.RHID AND B.DT_ADMISSAO = A.DT_ADMISSAO  ";
        }
        else {
            $sql .= "	LEFT JOIN  ".
                    "		(SELECT EMPRESA, RHID, DT_ADMISSAO, NVL(SUM(QTD_USADA),0) QTD_USADA ".
                    "		 FROM RH_ID_DC_DEBITOS  ".
                    "            WHERE EMPRESA = :EMPRESA ".
                    "              AND RHID = :RHID ".
                    "              AND DT_ADMISSAO = :DT_ADM ".
                    "		 GROUP BY EMPRESA, RHID, DT_ADMISSAO ".
                    "		) B ON B.EMPRESA = A.EMPRESA AND B.RHID = A.RHID AND B.DT_ADMISSAO = A.DT_ADMISSAO  ";
        }
        
        $sql .= "	LEFT JOIN  ".
                "		(SELECT EMPRESA, RHID, DT_ADMISSAO, NVL(SUM(QTD_USADA),0) QTD_USADA ".
                "		 FROM RH_ID_DC_DEBITOS_WKF  ".
                "		 WHERE EMPRESA = :EMPRESA ".
                "                  AND RHID = :RHID ".
                "                  AND DT_ADMISSAO = :DT_ADM ".
                "		   AND REJECTED = 'N'  ".
                "		   AND FINISHED = 'N'  ".
                "		   AND OPERACAO = 'INSERT'  ".
                "		 GROUP BY EMPRESA, RHID, DT_ADMISSAO ".
                "		) C ON C.EMPRESA = A.EMPRESA AND C.RHID = A.RHID AND C.DT_ADMISSAO = A.DT_ADMISSAO  ".
                "WHERE A.EMPRESA = :EMPRESA ". 
                "  AND A.RHID = :RHID ".
                "  AND A.DT_ADMISSAO = TO_DATE(:DT_ADM, 'YYYY-MM-DD')";
        
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':EMPRESA', $resource->empresa, PDO::PARAM_STR);
            $stmt->bindParam(':RHID', $resource->rhid, PDO::PARAM_STR);
            $stmt->bindParam(':DT_ADM', $resource->dt_adm, PDO::PARAM_STR);
            if (isset($resource->acao) && isset($resource->dt_ini) && $resource->acao == 'UPDATE') {
                $stmt->bindParam(':DT_INI', $resource->dt_ini, PDO::PARAM_STR);
            }
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        } catch (Exception $ex) {
            $msg = "getRhidAdaptabilidades [$resource->empresa, $resource->rhid, $resource->dt_adm] -> $sql: " . $ex->getMessage();
        }
    } 
    else {
        return $result;
    }
}

//Devolve todas as Regras definidas para os MÒDULOS de Gestão de Tempo
function getTimeManagementRules (&$msg) {    
    global $db;
    
    $msg = '';
    $cnt = '';
    $rows = array();
    $sql = "SELECT A.ID_MODULO, A.TIPO, A.PONTO, A.ESTADO, A.ANTES_PA, A.DURANTE_PA, A.DEPOIS_PA, A.VALIDACAO, A.ID_MODULO_DEST FROM WEB_ADM_MODULE_RULES A";
    
    try {
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    } catch (Exception $ex) {
        $msg = "getTimeManagementRules [$empresa]: " . $ex->getMessage();
    }
}

function prs_valida_cruzamentos_alocacoes($accao_, $empresa_, $rhid_, $dt_adm_, $tipo_, $dt_ini_aloc_, $dt_fim_aloc_, &$msg) {
    global $db, $error_time_overlap, $msg_time_overlap;

    $msg = '';
    $result = array();
    $dt_ini_aloc_orig_ = $dt_ini_aloc_;
    $dt_fim_aloc_orig_ = $dt_fim_aloc_;
#       if ($dt_fim_aloc_orig_ == '') {
            $dt_fim_aloc_orig_ = '2999-01-01 00:00';
#       }

    $dt_ini_aloc_ = str_replace("-","",$dt_ini_aloc_);
    $dt_ini_aloc_ = str_replace(" ","",$dt_ini_aloc_);

    $dt_fim_aloc_ = str_replace("-","",$dt_fim_aloc_);
    $dt_fim_aloc_ = str_replace(" ","",$dt_fim_aloc_);

    if ($dt_fim_aloc_ === '') {
        $dt_fim_aloc_ = '2999010100:00';
    }

    $query = "SELECT TO_CHAR(DT_INI_ALOC,'YYYY-MM-DD HH24:MI') DT_INI_ALOC, TO_CHAR(DT_FIM,'YYYY-MM-DD HH24:MI') DT_FIM ".
             "FROM PRS_HR_ALLOCATIONS ".
             "WHERE EMPRESA = '$empresa_' ".
             "  AND RHID = '$rhid_' ".
             "  AND TO_CHAR(DT_ADMISSAO,'YYYY-MM-DD') = '$dt_adm_' ".
             "  AND TIPO = '$tipo_' ".
             "  AND TO_CHAR(DT_INI_ALOC,'YYYY-MM-DD HH24:MI') != '$dt_fim_aloc_orig_' ".
             "  AND NVL(TO_CHAR(DT_FIM,'YYYY-MM-DD HH24:MI'),'2999010100:00') != '$dt_ini_aloc_orig_' ";

    # excluir o próprio registo
    if ($accao_ == 'UPDATE') {
        $query .= "  AND TO_CHAR(DT_INI_ALOC,'YYYY-MM-DD HH24:MI') != '$dt_ini_aloc_orig_' ";
    }

    # cruzamentos
    /*
            REGISTO:        X------------------------X
                    *-----------------*                                         (1)
                                    *----------------------------*              (2)
                   *-------------------------------------------------*		(3)
                                *----------*                                    (4)
    */
    $query .= " AND (".     ## CASO 1
              " ('$dt_ini_aloc_' <= TO_CHAR(DT_INI_ALOC,'YYYYMMDDHH24:MI') AND ".
              "  '$dt_fim_aloc_' BETWEEN TO_CHAR(DT_INI_ALOC,'YYYYMMDDHH24:MI') AND NVL(TO_CHAR(DT_FIM,'YYYYMMDDHH24:MI'),'2999010100:00') ".
              " ) OR ".     ## CASO 2
              " ('$dt_ini_aloc_' BETWEEN TO_CHAR(DT_INI_ALOC,'YYYYMMDDHH24:MI') AND NVL(TO_CHAR(DT_FIM,'YYYYMMDDHH24:MI'),'2999010100:00') AND ".
              "  '$dt_fim_aloc_' >= NVL(TO_CHAR(DT_FIM,'YYYYMMDDHH24:MI'),'2999010100:00') ".
              " ) OR ".     ## CASO 3
              " ('$dt_ini_aloc_' <= TO_CHAR(DT_INI_ALOC,'YYYYMMDDHH24:MI') AND  ".
              "  '$dt_fim_aloc_' >= NVL(TO_CHAR(DT_FIM,'YYYYMMDDHH24:MI'),'2999010100:00') ".
              " ) OR ".     ## CASO 4
              " ('$dt_ini_aloc_' >= TO_CHAR(DT_INI_ALOC,'YYYYMMDDHH24:MI') AND ".
              "  '$dt_fim_aloc_' <= NVL(TO_CHAR(DT_FIM,'YYYYMMDDHH24:MI'),'2999010100:00') ".
              " ) ".
              ") ";

      $res = oci_parse($db, $query);
      $isQueryOk = oci_execute($res);
      $e = oci_error($db);
      if ($isQueryOk) {
          while (($row = oci_fetch_assoc($res)) != false) {
              array_push($result, $row);
          }
          oci_free_statement($res);
      }
      else {
          $msg = str_replace('{0}' , $e['message'], $error_time_overlap); //"Erro no processamento dos cruzamentos [".$e['message']."].";
      }

    #$msg = "Validação de cruzamentos antes de $accao_ do registo pk[empresa:[$empresa_] rhid:[$rhid_] dt_adm:[$dt_adm_] tipo:[$tipo_] dt_ini_aloc:[$dt_ini_aloc_] dt_fim_aloc:[$dt_fim_aloc_]";
#$msg = 'KO';
    if ($msg == '') {
        if (count($result) > 0) {
            foreach($result as $row) {
                $txt = $row['DT_INI_ALOC'];
                if ($row['DT_FIM']) {
                    $txt .= ' ~ ' . $row['DT_FIM'];                        
                }
                $msg = str_replace('{0}' , $txt, $msg_time_overlap);//"Já existe uma alocação para o intervalo [".$row['DT_INI_ALOC']." - ".$row['DT_FIM']."] que cruza com a alocação indicada.";
                break;
            }
#            } else {
#                $msg = "Não existem cruzamentos [$query]!.";
        }
    }

    return $msg;
}


/*
 * Devolve o número de documento do colaborador
 * 
     resource = {
        rhid: "1",
        tp_doc: "A"
    }
 */
function nr_documento($db, $resource, &$msg) {
    $msg = '';
    $nr_doc = '';
    
    # TP_DOC - 
    # Domínio  DG_DOCUMENTOS.TP_DOCUMENTO 
    #   A - Cartão Cidadão
    #   B - NIF
    #   C - NISS
    #   D - ADSE
    #   E - CGA
    #   F - Cartáo ùnicio
    #   Z - Outro
    if ($resource->rhid != '' && $resource->tp_doc == '') {
        # obtem número de documento 
        $sql = "SELECT A.NR_DOCUMENTO ".
               "FROM RH_ID_DOCUMENTOS A, DG_DOCUMENTOS B ".
               "WHERE A.RHID = :RHID_ ".
               "  AND A.CD_AGREGADO IS NULL ".
               "  AND A.CD_DOC_ID = B.CD_DOC_ID ".
               "  AND B.TP_DOCUMENTO = :TP_DOC_ ";
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':RHID_', $resource->rhid, PDO::PARAM_STR);
            $stmt->bindParam(':TP_DOC_', $resource->tp_doc, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $nr_doc = $row['NR_DOCUMENTO'];
        } catch (Exception $ex) {
                  $msg = "nr_documento #1[$resource->rhid,$resource->tp_doc]: " . $ex->getMessage();
        }            
    }
    return $nr_doc;
}

/*
 * Cria informação base do colaborador com base na criação da informação de empresa
 * 
     resource = {
        empresa: "DEMO",
        rhid: "1",
        dt_adm: "2002-02-01",
    }
 * 
 */
function cria_info_colab_base($db, $resource, &$msg) {
    $msg = '';
 
    if ($resource->empresa != '' && $resource->rhid != '' && $resource->dt_adm != '') {
    
        $sql = "INSERT IGNORE INTO RH_ID_RETRIBUTIVOS ".
               "(EMPRESA, RHID, DT_ADMISSAO, TP_IRS, GRAU_DEFICIENCIA, FORMA_PAGAMENTO) ".
               "VALUES(:EMPRESA_, :RHID_, :DT_ADMISSAO_, 'N', 'Z', 'X') ";
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':EMPRESA_', $resource->empresa, PDO::PARAM_STR);
            $stmt->bindParam(':RHID_', $resource->rhid, PDO::PARAM_STR);
            $stmt->bindParam(':DT_ADMISSAO_', $resource->dt_adm, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $ex) {
                  $msg = "cria_info_colab_base #1[$resource->empresa,$resource->rhid,$resource->dt_adm]: " . $ex->getMessage();
        }            
        
        if ($msg == '') {
            $sql = "INSERT IGNORE INTO RH_ID_PROFISSIONAIS ".
                   "(EMPRESA, RHID, DT_ADMISSAO) ".
                   "VALUES(:EMPRESA_, :RHID_, :DT_ADMISSAO_) ";
            try {
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $resource->empresa, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_', $resource->rhid, PDO::PARAM_STR);
                $stmt->bindParam(':DT_ADMISSAO_', $resource->dt_adm, PDO::PARAM_STR);
                $stmt->execute();
            } catch (Exception $ex) {
                      $msg = "cria_info_colab_base #2[$resource->empresa,$resource->rhid,$resource->dt_adm]: " . $ex->getMessage();
            }            
        }
    }
}



/*
 * Atribui/Inativar regra de adaptabilidade por defeito
 * 
     resource = {
        acao: "ATIVAR/INATIVAR"
        empresa: "DEMO",
        rhid: "1",
        dt_adm: "2002-02-01",
        cd_irct: "1000",
        dt_eficacia: "2012-02-01"
    }
 * 
 */
function gere_regra_adapt($db, $resource, &$msg) {
    
    $msg = '';
    if ($resource->empresa != '' && $resource->rhid != '' && $resource->dt_adm != '' &&
        $resource->acao != '') {
        
        if (strtoupper($resource->acao) == 'ATIVAR' &&
            $resource->cd_irct != '' && $resource->dt_eficacia != '') {
            $dt_ini_ra = '';
            $sql = "SELECT CD_IRCT, DT_EFICACIA, DT_INI_RA ".
                   "FROM RH_DEF_REGRAS_ADAPTABILIDADE ".
                   "WHERE CD_IRCT = :CD_IRCT_ ".
                   "  AND DT_EFICACIA = :DT_EFICACIA_ ".
                   "  AND DT_FIM_RA IS NULL ";
            try {
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':CD_IRCT_', $resource->cd_irct, PDO::PARAM_STR);
                $stmt->bindParam(':DT_EFICACIA_', $resource->dt_eficacia, PDO::PARAM_STR);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $dt_ini_ra = $row['DT_INI_RA'];
            } catch (Exception $ex) {
                      $msg = "gere_regra_adapt #1[$resource->empresa,$resource->rhid,$resource->dt_adm]: " . $ex->getMessage();
            }            

            if ($msg == '' && $dt_ini_ra != '') {

                $sql = "INSERT INTO RH_ID_ADAPTABILIDADES ".
                       "(EMPRESA, RHID, DT_ADMISSAO, CD_IRCT, DT_EFICACIA, DT_INI_RA, DT_INI_HDR, DT_FIM_HDR) ".
                       "VALUES(:EMPRESA_, :RHID_, :DT_ADMISSAO_, :CD_IRCT_, :DT_EFICACIA_, :DT_INI_RA_, :DT_INI_HDR_, NULL) ".
                       "ON DUPLICATE KEY UPDATE ".
                       " DT_FIM_HDR = NULL ";
                try {
                    $stmt = $db->prepare($sql);
                    $stmt->bindParam(':EMPRESA_', $resource->empresa, PDO::PARAM_STR);
                    $stmt->bindParam(':RHID_', $resource->rhid, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_ADMISSAO_', $resource->dt_adm, PDO::PARAM_STR);
                    $stmt->bindParam(':CD_IRCT_', $resource->cd_irct, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_EFICACIA_', $resource->dt_eficacia, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_INI_RA_', $dt_ini_ra, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_INI_HDR_', $resource->dt_adm, PDO::PARAM_STR);
                    $stmt->execute();
                } catch (Exception $ex) {
                          $msg = "gere_regra_adapt #2[$resource->empresa,$resource->rhid,$resource->dt_adm]: " . $ex->getMessage();
                }            
            }
        }
        elseif (strtoupper($resource->acao) == 'INATIVAR') {
            $sql = "SELECT COUNT(*) CNT ".
                   "FROM RH_ID_DET_ADAPTABILIDADES A, RH_ID_PROFISSIONAIS B ".
                   "WHERE A.EMPRESA = :EMPRESA_ ".
                   "  AND A.RHID = :RHID_ ".
                   "  AND A.DT_ADMISSAO = :DT_ADMISSAO_ ".
                   "  AND B.EMPRESA = A.EMPRESA ".
                   "  AND B.RHID = A.RHID ".
                   "  AND B.DT_ADMISSAO = A.DT_ADMISSAO ".
                   "  AND B.CD_IRCT = A.CD_IRCT ".
                   "  AND B.DT_EFICACIA = A.DT_EFICACIA ";
            try {
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $resource->empresa, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_', $resource->rhid, PDO::PARAM_STR);
                $stmt->bindParam(':DT_ADMISSAO_', $resource->dt_adm, PDO::PARAM_STR);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $cnt = $row['CNT'];
            } catch (Exception $ex) {
                $msg = "gere_regra_adapt #3[$resource->empresa,$resource->rhid,$resource->dt_adm]: " . $ex->getMessage();
            }            

            if ($msg == '') {
                if ($cnt > 0) {
                    # inativar a regra de adaptabilidade
                    $sql = "UPDATE RH_ID_ADAPTABILIDADES ".
                           "SET DT_FIM_HDR = SYSDATE() ".
                           "WHERE DT_FIM_HDR IS NULL ".
                           "  AND (EMPRESA,RHID,DT_ADMISSAO,CD_IRCT,DT_EFICACIA) IN ".
                           "      (SELECT EMPRESA,RHID,DT_ADMISSAO,CD_IRCT,DT_EFICACIA ".
                           "       FROM RH_ID_PROFISSIONAIS ".
                           "       WHERE EMPRESA = :EMPRESA_ ".
                           "         AND RHID = :RHID_ ".
                           "         AND DT_ADMISSAO = :DT_ADMISSAO_ ".
                           "         AND CD_IRCT IS NOT NULL ".
                           "         AND DT_EFICACIA IS NOT NULL) ";
                }
                else {
                    # remover a regra de adaptabilidade
                    $sql = "DELETE FROM RH_ID_ADAPTABILIDADES ".
                           "WHERE DT_FIM_HDR IS NULL ".
                           "  AND (EMPRESA,RHID,DT_ADMISSAO,CD_IRCT,DT_EFICACIA) IN ".
                           "      (SELECT EMPRESA,RHID,DT_ADMISSAO,CD_IRCT,DT_EFICACIA ".
                           "       FROM RH_ID_PROFISSIONAIS ".
                           "       WHERE EMPRESA = :EMPRESA_ ".
                           "         AND RHID = :RHID_ ".
                           "         AND DT_ADMISSAO = :DT_ADMISSAO_ ".
                           "         AND CD_IRCT IS NOT NULL ".
                           "         AND DT_EFICACIA IS NOT NULL) ";
                }    
                try {
                    $stmt = $db->prepare($sql);
                    $stmt->bindParam(':EMPRESA_', $resource->empresa, PDO::PARAM_STR);
                    $stmt->bindParam(':RHID_', $resource->rhid, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_ADMISSAO_', $resource->dt_adm, PDO::PARAM_STR);
                    $stmt->execute();
                } catch (Exception $ex) {
                    $msg = "gere_regra_adapt #4[$resource->empresa,$resource->rhid,$resource->dt_adm]: " . $ex->getMessage();
                }            
            }
        }
    }
    
}


/*
 * Atribui/Inativar entidades de descontos
 * 
     resource = {
        acao: "ATIVAR/INATIVAR"
        empresa: "DEMO",
        rhid: "1",
        dt_adm: "2002-02-01",
        entidade: "IRS/SS/SG",  -- grupo de desconto
        tp_irs: "A"
    }
 */
function ent_desconto_por_defeito ($db, $resource, &$msg) {
    $msg = '';
    
    if ($resource->empresa != '' && $resource->rhid != '' && $resource->dt_adm != '' &&
        $resource->acao != '') {

        # entidade de IRS
        if ($resource->entidade == 'IRS' && $msg == '') {

            $cd_ed = '';
            $cd_reg_desc = '';
            $nr_inscricao = '';
            
            # determinar entidade e regime de desconto
            if (isset($resource->tp_irs) && $msg == '') {

                # Domínio RH_TP_IRS	
                #   A		Conta outrém
                #   B		Conta própria
                #   H		Reforma/Pensão
                #   N		Não desconta
                #   W		Res.não habitual
                #   Z		Não residentes

                # determina entidade
                $sql = "SELECT RV_HIGH_VALUE CD_ED ".
                       "FROM CG_REF_CODES ".
                       "WHERE RV_DOMAIN = 'RH_TP_IRS' ".
                       "  AND RV_LOW_VALUE = :TP_IRS_ ";
                try {
                    $stmt = $db->prepare($sql);
                    $stmt->bindParam(':TP_IRS_', $resource->tp_irs, PDO::PARAM_STR);
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $cd_ed = $row['CD_ED'];
                } catch (Exception $ex) {
                          $msg = "ent_desconto_por_defeito #1[$resource->empresa,$resource->rhid]: " . $ex->getMessage();
                }            

                # determina regime
                if ($cd_ed != '' && $msg == '') {
                    $sql = "SELECT CD_ED, CD_REG_DESC ".
                           "FROM RH_DEF_TAXAS_DESCONTO ".
                           "WHERE CD_ED = :CD_ED_ ";
                    try {
                        $stmt = $db->prepare($sql);
                        $stmt->bindParam(':CD_ED_', $cd_ed, PDO::PARAM_STR);
                        $stmt->execute();
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        $cd_reg_desc = $row['CD_REG_DESC'];
                    } catch (Exception $ex) {
                              $msg = "ent_desconto_por_defeito #2[$resource->empresa,$resource->rhid]: " . $ex->getMessage();
                    }            
                }
            }
            # ativar entidade
            if (strtoupper($resource->acao) == 'ATIVAR' && $cd_ed != '' && $cd_reg_desc != '' && $msg == '') {

                # cria entidade IRS
                if ($cd_ed != '' && $cd_reg_desc != '' && $msg == '') {

                    # obtem nr inscricao - NIF
                    $resource1 = new stdClass;
                    $resource1->rhid = $resource->rhid;
                    $resource1->tp_doc = 'B'; # NIF
                    $nr_inscricao = nr_documento($db, $resource1, $msg);
                    if ($nr_inscricao == '') {
                        $nr_inscricao = 'N/D';
                    }

                    if ($msg == '') {
                        $sql = "INSERT IGNORE INTO RH_ID_ENTS_DESCONTO ".
                               "(EMPRESA, RHID, DT_ADMISSAO, CD_ED, CD_REG_DESC, ACTIVO, ITERATIVO, NR_INSCRICAO, LIM_MAX_DESCONTO, OBS) ".
                               "VALUES (:EMPRESA_, :RHID_, :DT_ADMISSAO_, :CD_ED_, :CD_REG_DESC_, 'S', 'N', :NR_INSCRICAO_, NULL, NULL) ".
                               "ON DUPLICATE KEY UPDATE ".
                               " RHID = RHID ";
                        try {
                            $stmt = $db->prepare($sql);
                            $stmt->bindParam(':EMPRESA_', $resource->empresa, PDO::PARAM_STR);
                            $stmt->bindParam(':RHID_', $resource->rhid, PDO::PARAM_STR);
                            $stmt->bindParam(':DT_ADMISSAO_', $resource->dt_adm, PDO::PARAM_STR);
                            $stmt->bindParam(':CD_ED_', $cd_ed, PDO::PARAM_STR);
                            $stmt->bindParam(':CD_REG_DESC_', $cd_reg_desc, PDO::PARAM_STR);
                            $stmt->bindParam(':NR_INSCRICAO_', $nr_inscricao, PDO::PARAM_STR);
                            $stmt->execute();
                        } catch (Exception $ex) {
                            $msg = "ent_desconto_por_defeito #3[$resource->empresa,$resource->rhid]: " . $ex->getMessage();
                        }            
                    }
                }
            }
            # inativar entidade
            elseif (strtoupper($resource->acao) == 'INATIVAR' && $cd_ed != '' && $cd_reg_desc != '' && $msg == '') {
                
                $cnt = 0;
                $sql = "SELECT COUNT(*) CNT ".
                       "FROM RH_ID_DESCONTOS ".
                       "WHERE EMPRESA = :EMPRESA_ ".
                       "  AND RHID = :RHID_ ".
                       "  AND DT_ADMISSAO = :DT_ADMISSAO_ ".
                       "  AND CD_ED = :CD_ED_ ".
                       "  AND CD_REG_DESC = :CD_REG_DESC_ ";
                try {
                    $stmt = $db->prepare($sql);
                    $stmt->bindParam(':EMPRESA_', $resource->empresa, PDO::PARAM_STR);
                    $stmt->bindParam(':RHID_', $resource->rhid, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_ADMISSAO_', $resource->dt_adm, PDO::PARAM_STR);
                    $stmt->bindParam(':CD_ED_', $cd_ed, PDO::PARAM_STR);
                    $stmt->bindParam(':CD_REG_DESC_', $cd_reg_desc, PDO::PARAM_STR);
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $cnt = $row['CNT'];
                } catch (Exception $ex) {
                    $msg = "ent_desconto_por_defeito #4[$resource->empresa,$resource->rhid]: " . $ex->getMessage();
                }            
                
                if ($msg == '') {
                    if ($cnt > 0) {
                        $sql = "UPDATE RH_ID_ENTS_DESCONTO ".
                               "SET ACTIVO = 'N' ".
                               "WHERE EMPRESA = :EMPRESA_ ".
                               "  AND RHID = :RHID_ ".
                               "  AND DT_ADMISSAO = :DT_ADMISSAO_ ".
                               "  AND CD_ED = :CD_ED_ ".
                               "  AND CD_REG_DESC = :CD_REG_DESC_ ";
                    } 
                    else {
                        $sql = "DELETE FROM RH_ID_ENTS_DESCONTO ".
                               "WHERE EMPRESA = :EMPRESA_ ".
                               "  AND RHID = :RHID_ ".
                               "  AND DT_ADMISSAO = :DT_ADMISSAO_ ".
                               "  AND CD_ED = :CD_ED_ ".
                               "  AND CD_REG_DESC = :CD_REG_DESC_ ";
                    }
                    try {
                        $stmt = $db->prepare($sql);
                        $stmt->bindParam(':EMPRESA_', $resource->empresa, PDO::PARAM_STR);
                        $stmt->bindParam(':RHID_', $resource->rhid, PDO::PARAM_STR);
                        $stmt->bindParam(':DT_ADMISSAO_', $resource->dt_adm, PDO::PARAM_STR);
                        $stmt->bindParam(':CD_ED_', $cd_ed, PDO::PARAM_STR);
                        $stmt->bindParam(':CD_REG_DESC_', $cd_reg_desc, PDO::PARAM_STR);
                        $stmt->execute();
                    } catch (Exception $ex) {
                        $msg = "ent_desconto_por_defeito #5[$resource->empresa,$resource->rhid]: " . $ex->getMessage();
                    }            
                }
            }
        }

        # entidade de Segurança Social
        if ($resource->entidade == 'SS' && $msg == '') {

            $cd_ed = '';
            $cd_reg_desc = '';
            
            # determina entidade/ regime
            if ($cd_ed != '' && $msg == '') {
                $sql = "SELECT CD_ED, CD_REG_DESC ".
                       "FROM RH_DEF_TAXAS_DESCONTO ".
                       "WHERE DEFEITO = 'S' ".
                       "  AND CD_ED IN (SELECT CD_ED FROM RH_DEF_ENTIDADES_DESCONTO WHERE CD_GRUPO_ED = 'SS') ";
                try {
                    $stmt = $db->prepare($sql);
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $cd_ed = $row['CD_REG_DESC'];
                    $cd_reg_desc = $row['CD_REG_DESC'];
                } catch (Exception $ex) {
                          $msg = "ent_desconto_por_defeito #4[$resource->empresa,$resource->rhid]: " . $ex->getMessage();
                }            
            }

            # ativar entidade
            if (strtoupper($resource->acao) == 'ATIVAR' && $cd_ed != '' && $cd_reg_desc != '' && $msg == '') {
                
                # obtem nr inscricao - NISS
                $resource1 = new stdClass;
                $resource1->rhid = $resource->rhid;
                $resource1->tp_doc = 'C'; # NISS
                $nr_inscricao = nr_documento($db, $resource1, $msg);
                if ($nr_inscricao == '') {
                    $nr_inscricao = 'N/D';
                }

                if ($msg == '') {
                    $sql = "INSERT IGNORE INTO RH_ID_ENTS_DESCONTO ".
                           "(EMPRESA, RHID, DT_ADMISSAO, CD_ED, CD_REG_DESC, ACTIVO, ITERATIVO, NR_INSCRICAO, LIM_MAX_DESCONTO, OBS) ".
                           "VALUES (:EMPRESA_, :RHID_, :DT_ADMISSAO_, :CD_ED_, :CD_REG_DESC_, 'S', 'N', :NR_INSCRICAO_, NULL, NULL) ".
                           "ON DUPLICATE KEY UPDATE ".
                           " RHID = RHID ";
                    try {
                        $stmt = $db->prepare($sql);
                        $stmt->bindParam(':EMPRESA_', $resource->empresa, PDO::PARAM_STR);
                        $stmt->bindParam(':RHID_', $resource->rhid, PDO::PARAM_STR);
                        $stmt->bindParam(':DT_ADMISSAO_', $resource->dt_adm, PDO::PARAM_STR);
                        $stmt->bindParam(':CD_ED_', $cd_ed, PDO::PARAM_STR);
                        $stmt->bindParam(':CD_REG_DESC_', $cd_reg_desc, PDO::PARAM_STR);
                        $stmt->bindParam(':NR_INSCRICAO_', $nr_inscricao, PDO::PARAM_STR);
                        $stmt->execute();
                    } catch (Exception $ex) {
                              $msg = "ent_desconto_por_defeito #3[$resource->empresa,$resource->rhid]: " . $ex->getMessage();
                    }            
                }
            }
            
        }
    }
}

?>