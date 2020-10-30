<?php

// the main entry point for your web content
// note that this is not required on utils and api php scripts

ini_set("display_errors","1");
ini_set("display_startup_errors","1");

chdir(__DIR__);
require_once '../const.php';

// initialize composer
$autoload_file = ROOT_PATH.'/vendor/autoload.php';
if (!file_exists($autoload_file)) {
	include_once '_install.php';
	exit;
}
// check folder permissions
if (!is_writable(ROOT_PATH)) {
	include_once '_permissions.php';
        exit;
}
require_once ROOT_PATH.'/root.php';

# ligação à base de dados
require_once 'init.db.php';

# autenticação
require_once 'init.auth.php';

# línguas

// setting language variable. PORTUGUESE as default
if (!isset($_SESSION['lang']) || @$_SESSION['lang'] == '') {
    $_SESSION['lang'] = 'pt';
    $_SESSION['lang_db'] = 0;
}
if (file_exists(LANG_PATH."/quad_labels_" . @$_SESSION['lang'] . ".php")) {
    require_once(LANG_PATH."/quad_labels_" . @$_SESSION['lang'] . ".php");
} else {
    @$_SESSION['lang'] = 'pt';
    @$_SESSION['lang_db'] = 0;
    require_once(LANG_PATH."/quad_labels_" . $_SESSION['lang'] . ".php");
}

// setting language for datepickers
if ($_SESSION['lang'] == 'us') {
    $lang_js = ''; //DATEPICKER
} else {
    $lang_js = $_SESSION['lang'];
}

# livraria de suporte
require_once INCLUDES_PATH."/lib/quad_db_lib.php";


# menu da aplicação
require_once 'init.ui.php';

# força a autenticação para ficheiros que não o da autenticação
$script_name = script_name();
if (!$app->is_authenticated() &&  $script_name != 'login.php') {
    redirect(APP_URL.'/login.php');
}
