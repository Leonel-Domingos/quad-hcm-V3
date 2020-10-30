<?php
require_once 'init.utils.php';

$config = [
	'username,u:',
	'password,p:'
];

# Parâmetros de entrada
# [0] => nome do comando
# [1] => username
# 
#var_dump($_SERVER['argv']);
$username = $_SERVER['argv'][1];

#$options = \Common\Util::get_options($config, $exception);
if ($username) {
	$user = \Models\User::with_username($username);

        echo \Common\Util::debug($user);
        
	#$result = $user->set_password(get('password', $options));
	if ($user->UTILIZADOR) plog('OK');
	else plog('FAIL');
} else {
	plog("Username is required.");
}
?>