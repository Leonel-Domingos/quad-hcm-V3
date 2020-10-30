<?php

require_once 'init.utils.php';

$config = [
	'username,u:',
	'password,p:'
];

$options = \Common\Util::get_options($config, $exception);
if ($options) {
	$user = \Models\User::with_username(get('username', $options));
	$result = $user->set_password(get('password', $options));
	if ($result) plog('OK');
	else plog('FAIL');

} else {
	plog($exception);
}


?>