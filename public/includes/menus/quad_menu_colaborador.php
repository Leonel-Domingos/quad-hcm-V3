<?php
/*
 *  @autor      Pedro Estácio <pedro.estacio@quad-systems.com>
 *  @projeto    QUAD-HCM
 *  @versão     1.0
 *  @revisão    2018.01.01
 *  @copyright  (c) 2018 QuadSystems - http://www.quad-systems.com
 *  @nome       quad_menu_colaborador.php
 *  @descrição  Menu aplicacional associado ao perfil de colaborador
 *
 */

    # Módulos ativos
    $gestao_doc = estado_modulo(29, $msg);
    $delegacoes = estado_modulo(30, $msg);
    $av_desempenho = estado_modulo(16, $msg);

/*    
    $_nav = array(
        "home" => array(
            "title" => 'QUAD-HCM', //$ui_admin,
            "icon" => "fas fa-users",
            "url" => "ajax/gd_rhid_document_management.php",
            'active' => true,
            "items" => array(
                "gd_oper" => array(
                    "title" => $ui_processes,
                    "icon" => "fas fa-edit",
                    "url" => "ajax/gd_rhid_document_management.php",
                    'active' => false
                ),
                "rhid_delegations" => array(
                    "title" => $ui_delegations,
                    "icon" => "fas fa-edit",
                    "url" => "ajax/rhid_delegations.php",
                    "li_class" => "ripple grey",
                    'active' => false
                ),
                "aval_desempenho_sheets" => array(
                "title" => $ui_evaluation_sheets,
                "icon" => "fas fa-arrow-right",
                "li_class" => "",
                    "items" => array(
                        "ad_plano_aval" => array(
                            "title" => $ui_self_evaluation,
                            "icon" => "fas fa-edit",
                            "url" => "ajax/ad_employee_evaluation_sheet.php",
                            "li_class" => "ripple grey",
                            'active' => false
                        ),
                        "ad_results" => array(
                            "title" => $ui_eval_results,
                            "icon" => "fas fa-edit",
                            "url" => "ajax/ad_employee_results.php",
                            "li_class" => "ripple grey",
                            'active' => false
                        ),                                           
                    )
                )                
            )
        )
    );
    ## menu base, sem opções, e apenas com a página de entrada
    /*$_nav = array(
        "home" => array(
            "title" => 'QUAD-HCM', //$ui_admin,
            "icon" => "fas fa-users",
            "url" => "ajax/gd_rhid_document_management.php",
            'active' => true,
            "items" => array()
        )
    );
 */

    #
    # ARVORE PRINCIPAL
    $_nav = array();;
    
    # Cria nó principal da aplicação
    $_nav["home"] = inicializa_no_menu('QUAD-HCM', "fas fa-users", "", "ajax/gd_rhid_document_management.php", true);

    # cadastro
    adiciona_interface($_nav["home"], "cadastro", $ui_cadastre, "fas fa-user-edit", "ajax/rh_cadastro.php", "", false);         

    
    # criar menu de time management
    $tm_mod = inicializa_no_menu($ui_time_management, "far fa-clock fs_11_em", "", "", false);
    adiciona_interface($tm_mod, "cadastro_tm", $ui_cadastre, "fal fa-user-clock", "ajax/rh_time_management.php", "ripple grey", false);         
    adiciona_interface($tm_mod, "matrix", $ui_time_scales, "far fa-calendar-edit fs_11_em", "ajax/rh_escalas.php", "ripple grey", false);         

    # adicionar menu de time management ao menu principal
    adiciona_conteudo_menu($_nav["home"], "tm_mod", $tm_mod);  
    
/*
                "tm_mod" => array(
                    "title" => $ui_time_management,
                    "icon" => "far fa-clock fs_11_em", 
                    //"url" => "ajax/gd_dashboard.php",
                    "li_class" => "",
                    "items" => array( 
                            "cadastro_tm" => array(
                                "title" => $ui_cadastre, //$ui_time_management . " <sup class='badge bg-color-greenLight' style='font-size: .8em;'> RHID</sup>", 
                                "icon" => "fal fa-user-clock", //<i class="far fa-calendar-edit"></i>
                                "url" => "ajax/rh_time_management.php",
                                "li_class" => "ripple grey",
                                'active' => false,
                                "class" => "noTitle"
                            ),            
                            "matrix" => array(
                                "title" => $ui_time_scales, 
                                "icon" => "far fa-calendar-edit fs_11_em",
                                "url" => "ajax/rh_escalas.php",
                                "li_class" => "ripple grey",
                                'active' => false
                            ),
                        ),
                ),
*/

    
    # 
    # GESTÃO DOCUMENTAL
    if ($gestao_doc) {
        
        # A árvore de gestão documental para o perfil Colaborador é apenas um interface, 
        #´pelo que se adiciona diretamente o interface à arvore principal
        adiciona_interface($_nav["home"], "gd_oper", $ui_processes, "fas fa-edit", "ajax/gd_rhid_document_management.php", "", false);         

    }
   
    # 
    # DELEGAÇÕES
    if ($delegacoes) {
        
        # A árvore de delegações para o perfil Colaborador é apenas um interface, 
        #´pelo que se adiciona diretamente o interface à arvore principal
        adiciona_interface($_nav["home"], "rhid_delegations", $ui_delegations, "fas fa-edit", "ajax/rhid_delegations.php", "ripple grey", false);         
    }
     
    # 
    # AVALIAÇÃO DE DESEMPENHO
    if ($av_desempenho) {
        
        ## AVALIAÇÃO DE DESEMPENHO NÓ PRINCIPAL -> "oper_aval_desempenho"
        $av_main = inicializa_no_menu($ui_performance_evaluation, "fas fa-arrow-right", "", "", false);

        ## FICHAS DE AVALIAÇÃO - nó das fichas de avaliação do colaborador
        $av_sheets = av_menu_fichas_aval_colab($msg);
    
        ## RESULTADOS DE AVALIAÇÃO - nó dos resultados de avaliações do colaborador
        $av_results = av_menu_resultados_colab($msg);

        ## adicionar o nó das fichas de avaliação ao nó principal da avaliação de desempenho
        if (!empty($av_sheets)) {
            adiciona_conteudo_menu($av_main, "aval_desempenho_sheets", $av_sheets);  
        }

        ## adicionar o nó de resultados ao nó principal da avaliação de desempenho
        if (!empty($av_results)) {
            adiciona_conteudo_menu($av_main, "ad_results", $av_results);  
        }

        ## adicionar o nó principal da avaliação de desempenho à Árvore de navegação
        adiciona_conteudo_menu($_nav["home"], "oper_aval_desempenho", $av_main);  
    }    
?>
