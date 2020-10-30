<?php
/*
 *  @autor      Pedro Mengo de Abreu <pedro.mengo.abreu@quad-systems.com>
 *  @versão     1.0
 *  @revisão    2016.05.23
 *  @copyright  (c) 2016 QuadSystems - http://www.quad-systems.com
 *  @nome	quad_lists_lib.php
 *  @descrição  Libraria para implementação de listas chamadas via AJAX
 *
 */
$memcache = new Memcached();
$memcache->addServer('localhost', 11211);

require_once __DIR__."/quad_head_controller.php";
$msg = '';
#require_once __DIR__."/db.php";
#$db = connect_db();
$link = $db;

$res = '';
$req = @$_REQUEST;

function returnDomainList($MultiReq = false, $memcache, $ajax_id, &$req = null, &$arrayOfResults = null) {
   
    $res="";
    $msg = "";
    $mode = isset($req['listsMod']) ? $req['listsMod'] : null;
    $parameters_array = isset($req['params_array'])
        ? $req['params_array']
        : null;
    $join = isset($req['join']) ? $req['join'] : null;
    //Opções: LIST ou DSP (este último só será utilizado em Tables com "inline edition" com comutação entre display e input)
    $request_type = isset($req['request_type']) ? $req['request_type'] : null;
    $pk = isset($req['pk']) ? $req['pk'] : null;

    if ($request_type == '') {
        $request_type = 'LIST';
    }
    if ($ajax_id == "USER_TABLES") {
        $val = $parameters_array[0];
        $res = null;
        $res = quad_tables();
        echo $res;
    } elseif ($ajax_id == "USER_TABLE_DETAILS") {
        $val = $parameters_array;
        $res = null;
        $res = quad_table_details($val);
        echo $res['html_']->read($res['html_']->size()) .
            '[[' .
            $res['info'] .
            ']]'; //Echo CLOB!!
        //echo $res;
    }

    ##
    ## QUAD-HCM
    ##
    #
    # Empresa do QUAD-HCM
    #
    elseif ($ajax_id == "EMPRESA") {
        $val = $parameters_array[0];
        if ($join) {
            $res = list_empresa($val, $mode);
        }
        if ($request_type == 'LIST') {
            $res = list_empresa($val, $mode);
        }
    }
    #
    # Estabelecimentos do QUAD-HCM
    #
    elseif ($ajax_id == "ESTAB") {
        $parameters_array = json_decode($parameters_array);
        $empresa = $parameters_array[0];
        $estab = $parameters_array[1];
        $res = list_estab($empresa, $estab, $mode, $msg);
    }
    #
    # Estabelecimentos referentes aos colaboradores disponível para o perfil selecionado
    #
    elseif ($ajax_id == "ESTAB_COLABS") {
        $parameters_array = json_decode($parameters_array);
        $empresa = $parameters_array[0];
        $estab = $parameters_array[1];
        $res = list_estabs_colabs($empresa, $estab, $mode, $msg);
    }
    #
    # Setores do QUAD-HCM
    #
    elseif ($ajax_id == "DG_SETORES") {
        $parameters_array = json_decode($parameters_array);
        $empresa = $parameters_array[0];
        $estab = $parameters_array[1];
        $setor = $parameters_array[2];
        $res = list_setores($empresa, $estab, $setor, $mode, $msg);
    }
    #
    # Setores referentes aos colaboradores disponível para o perfil selecionado
    #
    elseif ($ajax_id == "SETORES_COLABS") {
        $parameters_array = json_decode($parameters_array);
        $empresa = $parameters_array[0];
        $estab = $parameters_array[1];
        $setor = $parameters_array[2];
        $res = list_setores_colabs($empresa, $estab, $setor, $mode, $msg);
    }
    #
    # Setores referentes aos anos definidos no QUAD-HCM
    #
    elseif ($ajax_id == "DG_ANOS") {
        $parameters_array = json_decode($parameters_array);
        $empresa = $parameters_array[0];
        $ano = $parameters_array[1];
        $res = list_anos($empresa, $ano, $mode, $msg);
    }
    #
    # Colaboradores ativos numa empresas
    #
    elseif ($ajax_id == "COLABS_ACTIVE") {
        $parameters_array = json_decode($parameters_array);
        $empresa = $parameters_array[0];
        $rhid = $parameters_array[1];
        $res = list_colabs_ativos($empresa, $rhid, $mode, $msg);
    }
    #
    # Colaboradores ativos associados a um perfil numa empresas
    #
    elseif ($ajax_id == "COLABS_PERFIL_ACTIVE") {
        $parameters_array = json_decode($parameters_array);
        $empresa = $parameters_array[0];
        $rhid = $parameters_array[1];
        $res = list_colabs_perfil_ativos($empresa, $rhid, $mode, $msg);
    }
    #
    # Direções do QUAD-HCM
    #
    elseif ($ajax_id == "DG_DIRECOES") {
        $parameters_array = json_decode($parameters_array);
        $empresa = $parameters_array[0];
        $dir = $parameters_array[1];
        $res = list_direcoes($empresa, $dir, $mode, $msg);
    }
    #
    # Departamentos do QUAD-HCM
    #
    elseif ($ajax_id == "DG_DEPARTAMENTOS") {
        $parameters_array = json_decode($parameters_array);
        $empresa = $parameters_array[0];
        $dir = $parameters_array[1];
        $dept = $parameters_array[2];
        $res = list_depts($empresa, $dir, $dept, $mode, $msg);
    } elseif ($ajax_id == "DG_ESTRUTURAS") {
        $parameters_array = json_decode($parameters_array);
        $empresa = $parameters_array[0];
        $estrut = $parameters_array[1];
        $res = list_estruturas($empresa, $estrut, $mode, $msg);
    } elseif ($ajax_id == 'DG_MES') {
        //Order by to_number(rv_low_value)
        $val = $parameters_array[0];
        if ($join) {
            $res = list_dominio($ajax_id, $val, $mode, $join, $msg);
        }
        if (isset($parameters_array) && count($parameters_array) > 0) {
            $cd_pais = $parameters_array[0];
        }

        if ($request_type == 'LIST') {
            $join = true;
            $res .= list_dominio($ajax_id, $val, $mode, $join, $msg);
        }
    } elseif ($ajax_id == "RH_DEF_GRUPOS_FUNCIONAIS") {
        $parameters_array = json_decode($parameters_array);
        $empresa = $parameters_array[0];
        $grp_func = $parameters_array[1];
        $res = list_grupos_funcionais($empresa, $grp_func, $mode, $msg);
    } elseif ($ajax_id == "RH_DEF_FUNCOES") {
        $parameters_array = json_decode($parameters_array);
        $empresa = $parameters_array[0];
        $func = $parameters_array[1];
        $res = list_funcoes($empresa, $func, $mode, $msg);
    } elseif ($ajax_id == "RH_DEF_VINCULOS_CONTRATUAIS") {
        $parameters_array = json_decode($parameters_array);
        $empresa = $parameters_array[0];
        $vinc = $parameters_array[1];
        $res = list_vinculos_contratuais($empresa, $vinc, $mode, $msg);
    } elseif ($ajax_id == "RH_DEF_SITUACOES") {
        $parameters_array = json_decode($parameters_array);
        $empresa = $parameters_array[0];
        $sit = $parameters_array[1];
        $res = list_situacoes($empresa, $sit, $mode, $msg);
    } elseif ($ajax_id == "RH_DEF_HORARIO_DIAS") {
        $res = list_horarios_diarios($msg);
    #
    # UTILIZADORES
    #
    } else if ($ajax_id == "ACTIVE_USERS") {
        $res = list_users('A', $mode);
    } else if ($ajax_id == "ALL_USERS") {
        $res = list_users('', $mode);
    /* 
     * LOV :: FLEXFIELDS by SSQL
     * PMA: 2019.12.10
     */        
    } else if ($ajax_id == "LOV_FF_") {

        $sql_ = @$_REQUEST['sql_'];
        $sql_ = urldecode($sql_);

        $res = lov_FF_dominio($sql_, $cd, $mode, $msg);
        $res = json_decode($res);
        
//if ($msg) {
//    echo 'Error:'.$msg;
//} else {
//    echo 'RES:'.$ajax_id.' -> '.$sql_;
//    echo $res ;
//}
//        
    } else {
        //Domains...
        $val = $parameters_array[0];
        $res = list_dominio($ajax_id, $val, $mode, $join, $msg);
        $res = json_decode($res);
    }
    
    if (is_array($res)) {
        null;
    }
    else {
        $res = json_decode($res) ? json_decode($res) : $res;
    }
    if (count($res) > 0) {
        $memcache->set(str_replace(' ', '', $ajax_id), $res);
        if($MultiReq){
            $arrayOfResults[$ajax_id] = $res  ;
        }else{
            return ($res);
        }
    }else{
        if(!$MultiReq){
            return ($res);
    }

}
}
//END returnDomainList

if (isset($_POST["domains"])) {
    
    $domain_name = @$_REQUEST['request_id'];

    if ($domain_name == '#LOV_FF') {
        echo '#1';
    }    
    
    $msg="";
    $arrayOfResults = [];

    foreach ($_POST["domains"] as $key => $value) {
        returnDomainList(true, $memcache, $value, $req, $arrayOfResults);
    }
    if ($msg == '') {
        echo json_encode($arrayOfResults);
    }
} else {
    //Domains...
    $res = '';
    #
    # Parâmetros entrada
    #

    $domain_name = @$_REQUEST['request_id'];

    # estamos a retirar as " do nome do domínio, porque o js adicionou essas aspas derivado ao nome do domínio poder ter espaços
    $domain_name = str_replace('"','',$domain_name);
    
    $res = returnDomainList(false, $memcache, $domain_name, $req);

    # coloquei o json_encode porque os dados não vinham codificados do returnDomainList
    # nos casos em que vinham codificados (domínios) coloquei um json_decode para homogenizar
    echo json_encode($res);
}

if ($msg !== '') {
    echo $msg;
}