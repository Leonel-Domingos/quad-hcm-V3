<?php

// get authenticated user and the session
$app->init_web_session(LANG_PATH);
$_user = $app->get_authenticated_user();

#var_dump($_user);

@$_SESSION['id'] = $_user->ID;
@$_SESSION['utilizador'] = $_user->UTILIZADOR;

@$_SESSION['rhid'] = $_user->RHID;
@$_SESSION['nome'] = $_user->NOME != '' ? $_user->NOME : $_user->UTILIZADOR;

@$_SESSION['database'] = 'MYSQL';
@$_SESSION['URL'] = endereco_plataforma();

$_SESSION['hierarquia'] = '';
$_SESSION['rhid_delegado'] = '';

# inicialização dos perfis
if (@$_SESSION['id_perfil'] == '' && isset($_user)) {
    if ($_user)
        @$_SESSION['id_perfil'] = $_user->get_current_profile()->ID_PERFIL;
    if ($_user)
        @$_SESSION['perfil'] = $_user->get_current_profile()->TIPO_PERFIL;
}

# inicialização da língua
#if(@$_SESSION['lang'] == '' && $_user) {
    @$_SESSION['lang_db'] = $_user->LANG;
    foreach($app->get_langs() as $rec) {
        if ($rec->CD_LINGUA == $_user->LANG) {
            @$_SESSION['lang'] = $rec->CODIGO;
        }
    }
#}
