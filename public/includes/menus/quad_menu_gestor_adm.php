<?php/* *  @autor      Pedro Estácio <pedro.estacio@quad-systems.com> *  @projeto    QUAD-HCM *  @versão     1.0 *  @revisão    2018.01.01 *  @copyright  (c) 2018 QuadSystems - http://www.quad-systems.com *  @nome       quad_menu_gestor_adm.php *  @descrição  Menu aplicacional associado ao perfil de gestor administrativo (1º Aprovador) * */    # Módulos ativos    $gestao_doc = estado_modulo(29, $msg);    $delegacoes = estado_modulo(30, $msg);    $av_desempenho = estado_modulo(16, $msg);//    if ($gestao_doc && $delegacoes) {//    $_nav = array(//        "home" => array(//            "title" => 'QUAD-HCM', //$ui_admin,//            "icon" => "fa-users",//            "url" => "ajax/dashboard.php",//            'active' => true,//            "items" => array(//                "gd_home" => array(//                    "title" => $ui_home,//                    "icon" => "fa-home",//                    "url" => "ajax/dashboard.php",//                    "li_class" => "ripple grey",//                ),            //                "gd_oper" => array(//                    "title" => $ui_processes,//                    "icon" => "fa-edit",//                    "url" => "ajax/gd_rhid_document_management.php",//                    "li_class" => "ripple grey",//                    'active' => false//                ),//                "rhid_delegations" => array(//                    "title" => $ui_delegations,//                    "icon" => "fa-edit",//                    "url" => "ajax/rhid_delegations.php",//                    "li_class" => "ripple grey",//                    'active' => false//                ),              //            )//        )//    );//} elseif ($gestao_doc && !$delegacoes) {//    $_nav = array(//        "home" => array(//            "title" => 'QUAD-HCM', //$ui_admin,//            "icon" => "fa-users",//            "url" => "ajax/dashboard.php",//            'active' => true,//            "items" => array(//                "gd_home" => array(//                    "title" => $ui_home,//                    "icon" => "fa-home",//                    "url" => "ajax/dashboard.php",//                    "li_class" => "ripple grey",//                ),            //                "gd_oper" => array(//                    "title" => $ui_processes,//                    "icon" => "fa-edit",//                    "url" => "ajax/gd_rhid_document_management.php",//                    "li_class" => "ripple grey",//                    'active' => false//                ),//            )//        )//    );//}    #    # ARVORE PRINCIPAL    $_nav = array();        # Cria nó principal da aplicação    $_nav["home"] = inicializa_no_menu('QUAD-HCM', "fa-users", "", "ajax/dashboard.php", true);    # Adiciona interface de entrada - dashboard    adiciona_interface($_nav["home"], "dashboard", $ui_home, "fa-home", "ajax/dashboard.php", "ripple grey", true);                 #     # GESTÃO DOCUMENTAL    if ($gestao_doc) {                # A árvore de gestão documental para o perfil Colaborador é apenas um interface,         #´pelo que se adiciona diretamente o interface à arvore principal        adiciona_interface($_nav["home"], "gd_oper", $ui_processes, "fa-edit", "ajax/gd_rhid_document_management.php", "", false);             }       #     # DELEGAÇÕES    if ($delegacoes) {                # A árvore de delegações para o perfil Colaborador é apenas um interface,         #´pelo que se adiciona diretamente o interface à arvore principal        adiciona_interface($_nav["home"], "rhid_delegations", $ui_delegations, "fa-edit", "ajax/rhid_delegations.php", "ripple grey", false);             }             #     # AVALIAÇÃO DE DESEMPENHO    if ($av_desempenho) {                ## AVALIAÇÃO DE DESEMPENHO NÓ PRINCIPAL -> "oper_aval_desempenho"        $av_main = inicializa_no_menu($ui_performance_evaluation, "fa-arrow-right", "", "", false);        ## FICHAS DE AVALIAÇÃO - nó das fichas de avaliação associadas ao SUPERVISOR        $av_sheets = av_menu_fichas_aval_chefias($msg);            ## RESULTADOS DE AVALIAÇÃO - nó dos resultados de colaboradores associados ao SUPERVISOR        $av_results = av_menu_resultados_chefias($msg);        ## adicionar o nó das fichas de avaliação ao nó principal da avaliação de desempenho        if (!empty($av_sheets)) {            adiciona_conteudo_menu($av_main, "aval_desempenho_sheets", $av_sheets);          }        ## adicionar o nó de resultados ao nó principal da avaliação de desempenho        if (!empty($av_results)) {            adiciona_conteudo_menu($av_main, "ad_results", $av_results);          }        ## adicionar o nó principal da avaliação de desempenho à Árvore de navegação        adiciona_conteudo_menu($_nav["home"], "oper_aval_desempenho", $av_main);      }    ?>