<?php

use \Common\Util;

function is_post() {
	return REQUEST_METHOD === 'POST';
}

function parse_float($str) {
	$number = preg_replace('/[^0-9\.]/i', '', $str);
	return floatval($number);
}

function redirect($url) {
	Util::redirect($url);
}

function parse_name($name) {
	if (!$name) return false;

	$name = Util::slugify($name, false, "'");

	$parts = explode('-', $name);
	$parts_count = count($parts);

	if ($parts_count === 1) return [$parts[0], ''];

	// last word is the last name
	$lastname = $parts[$parts_count - 1];

	// get the first elements as firstname
	unset($parts[$parts_count - 1]);
	$firstname = implode(' ', $parts);

	return [$firstname, $lastname];
}

function in_string($string, $subject) {
    return Util::in_string($string, $subject);
}

function plog($msg = '', $newline = true, $options = [], $return = false) {
	$is_cli = Util::is_cli();
    $is_ajax = Util::is_ajax();
    $is_pjax = Util::is_pjax();

    $is_html = !($is_cli || $is_ajax) || $is_pjax;

	$result = Util::debug($msg, array_merge(['newline' => $newline], $options), true);
	$result = $is_html ? '<div class="debug">'.$result.'</div>' : $result;

	if ($return) return $result;
	else echo $result;
}

function get($field, $data = null, $default = null, $possible_values = []) {
	return Util::get($field, $data, $default, $possible_values);
}

function br2nl($text) {
	return Util::br2nl($text);
}

function array_delete($array, $items) {
    return array_diff($array, is_array($items) ? $items : [$items]);
}

// formatted datetime
function dt($date = 'now', $format = \Moment\Moment::NO_TZ_MYSQL, $src_format = null) {
    if ($date) {
        try {
            if ($src_format) $date = \Moment\Moment::createFromFormat($src_format, $date) ?: $date;
            $dt = $date instanceof DateTime ? $date : new \Moment\Moment($date);

            return $dt->format($format);

        } catch (Exception $ex) {
            trigger_error($ex->getMessage());
        }
    }

    return null;
}

function token($length = 16) {
	return Util::token($length);
}

function uuid() {
	return Util::uuid();
}

function phone($input) {
	return Util::format_phone($input);
}

function escape($str, $nl2br = false) {
	return Util::escape_html($str, $nl2br);
}


function script_name () {
    $file = $_SERVER["SCRIPT_NAME"];
    if ($file == '')
        $file = $argv[0];
    $break = explode('/', $file);
    $pfile = strtolower($break[count($break) - 1]);

    return $pfile;
}

# Função que devolve o endereço da plataforma
function endereco_plataforma () {

    $url = $_SERVER['HTTP_HOST'].$_SERVER["SCRIPT_NAME"];
    $new_url = '';
    $param = explode('/',$url);

    for ($i=0; $i < (count($param)-1) ; $i++) {
        $new_url .= $param[$i]. "/";
    };

    return $new_url;
}

function logout () {
    unset( $_SESSION['id'] );
    unset( $_SESSION['utilizador'] );
    unset( $_SESSION['reset_pw'] );
    unset( $_SESSION['rhid'] );
    unset( $_SESSION['perfil'] );
    unset( $_SESSION['id_perfil'] );
    unset( $_SESSION['dsp_perfil'] );
    unset( $_SESSION['nome'] );
    unset( $_SESSION['avatar'] );
    unset( $_SESSION['lang'] );
    unset( $_SESSION['lang_db'] );
    unset( $_SESSION['URL'] );
    unset( $_SESSION['hierarquia'] );
    unset( $_SESSION['rhid_delegado'] );
    
    // unset session variables
    session_unset();
    
    //session_regenerate_id();
    session_destroy();

    redirect('login.php');    
}

?>