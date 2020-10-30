<?php
/*
 * Cabeçalho comum aos controladores utilizados pela a aplicação
 * 
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

ini_set('memory_limit', '-1');

# https://stackoverflow.com/questions/9691057/php-apache-ajax-post-limit
# post_max_size which is directly related to the POST size
# upload_max_filesize which may be unrelated, not sure
# max_input_time, if the POSt takes too long
# max_input_nesting_level if your data is an array with a lot of sublevels
# max_execution_time, but quite sure it's not that
# memory_limit, as you may reach a size exceding the subprocess allowed memory
# max_input_vars, if your data array has many elements
#ini_set('max_execution_time',3000);
#ini_set('post_max_size','1G');          # ficheiro
#ini_set('upload_max_filesize','1G');    # ficheiro
#ini_set('max_input_vars',1000);         # ficheiro


date_default_timezone_set('Europe/Lisbon');

if (session_id() == '') {
    session_start();
}

// variáveis globais
require_once '../../const.php';

// carregamento da livraria de funções
require_once ROOT_PATH.'/vendor/autoload.php';

// carregamento das configurações desde o ficheiro .env
$dotenv = Dotenv\Dotenv::create(ROOT_PATH, '.env');
$dotenv->load();

// funções globais
require_once ROOT_PATH.'/config.php';


# Línguas
// setting language variable. PORTUGUESE as default
if (!isset($_SESSION['lang']) || @$_SESSION['lang'] == '') {
    $_SESSION['lang'] = 'pt';
    $_SESSION['lang_db'] = 0;
    session_write_close();
}
require_once INCLUDES_PATH."/lang/quad_labels_" . $_SESSION['lang'] . ".php";

# ligação à base de dados
include ROOT_PATH."/db_controllers.php";
$db = connect_db();

# livrarias de acesso
require_once INCLUDES_PATH."/lib/quad_db_lib.php";

define('PK_SEPARATOR', '>');
$nulo = 'NULL';

$dateformat = "'YYYY-MM-DD'";
$datetimeShort = "'YYYY-MM-DD HH24:MI'";
$datetimeformat = "'YYYY-MM-DD HH24:MI:SS'";
