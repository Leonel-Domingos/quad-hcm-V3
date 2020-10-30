<?php

\Models\Model::connect(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD, DB_PORT);
\Models\Model::$db->on_error(function($msg) {
	plog($msg);
});

\Models\Model::$db->setAttribute(PDO::ATTR_PERSISTENT, false);


// configure models
\Models\User::register('WEB_ADM_UTILIZADORES');
\Models\AccessToken::register('access_tokens');
\Models\Session::register('sessions');
\Models\APIRequest::register('api_requests');

\Models\Profile::register('WEB_ADM_PERFIS_UTILIZADORES');

# Línguas registadas na plataforma
\Models\Language::register('DG_LINGUAS_ESTRANGEIRAS');