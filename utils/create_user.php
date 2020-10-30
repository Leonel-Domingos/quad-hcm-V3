<?php

require_once 'init.utils.php';

$config = [
	'username,u:',
	'password,p:',
	'email,e::',
	'firstname,f::',
	'lastname,l::'
];

$options = \Common\Util::get_options($config, $exception);
if ($options) {
	$user = \App\App::add_user($options);
	if ($user) plog('OK #'.$user->id);
	else plog('FAIL');

} else {
	plog($exception);
}


?>