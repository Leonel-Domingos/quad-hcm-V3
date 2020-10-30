<?php
/*
 *  @autor      Pedro Estácio <pedro.estacio@quad-systems.com>
 *  @versão     2.0
 *  @revisão    2018.07.06
 *  @copyright  (c) 2018 QuadSystems - http://www.quad-systems.com
 *  @nome     	quad_controlller_muda_perfil.php
 *  @descrição  Controlador associado à mudança de perfil na plataforma
 *
 */

# cabeçaho do controlador
require_once '../init.php';

$msg = '';
$lang = @$_REQUEST['lang'];
$gravar = @$_REQUEST['save'];
$sql_txt = '';
$lang_db = '';

try {
    $sql_txt = "SELECT CD_LINGUA ".
               "FROM DG_LINGUAS_ESTRANGEIRAS ".
               "WHERE CODIGO = :CODIGO_  ".
               "  AND ATIVO = 'S' ";
    $stmt = $link->prepare($sql_txt);
    $stmt->bindValue(':CODIGO_',$lang, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $lang_db = $row['CD_LINGUA'];
} catch (Exception $ex) {
    $msg = "set_sessions#1:".$ex->getMessage();
}

if ($msg == '') {
    
    if ($gravar == 'S') {
        //Get user contect data
        try {
            $sql_txt = "UPDATE ".DB_NAME.".WEB_ADM_UTILIZADORES ".
                       "SET LANG = :LANG_ ".
                       "WHERE UTILIZADOR = :UTILIZADOR_  ";
            $stmt = $link->prepare($sql_txt);
            $stmt->bindValue(':LANG_',$lang_db, PDO::PARAM_STR);
            $stmt->bindValue(':UTILIZADOR_', $_user->UTILIZADOR, PDO::PARAM_STR);
            $stmt->execute();
            $_user->LANG = $lang_db;
            @$_SESSION['lang'] = $lang;
            @$_SESSION['lang_db'] = $lang_db;
        } catch(PDOException $ex) {
            $msg = "set_sessions#2:".$ex->getMessage();
        }        
    }

    if ($lang != '' && $lang_db != '' && $msg == '') {
        @$_SESSION['lang'] = $lang;
        @$_SESSION['lang_db'] = $lang_db;
    }
}

if ($msg != '')
    echo $msg;
?>
