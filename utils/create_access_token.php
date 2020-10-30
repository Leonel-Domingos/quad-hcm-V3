<?php

require_once 'init.utils.php';

$options = \Common\Util::get_options(['username,u:'], $exception);
if ($options) {
	$username = $options['username'];
	$user = \Models\User::with_username($username);
	if ($user) {
		$access_token = $user->create_access_token();

		plog('username: '.$user->username);
		plog('access token: '.$access_token->token);

	} else plog('user not found');
} else plog($exception);