<?php
$ad = estado_modulo(16, $msg);                  //Avaliação Desempenho :: NOT USED
$formacao = estado_modulo(17, $msg);            //Formação :: NOT USED
$gestao_doc = estado_modulo(29, $msg);          //Gestão Documental
$delegacoes = estado_modulo(30, $msg);          //Delegações
$premios_coeficiente = estado_modulo(31, $msg); //Prémios por Coeficiente (DK)
$ajudas_custo = true;

//Inicializações
$premios_coef_oper = array();
$premios_coef_config = array();

if ($ajudas_custo) {
    $ajudas_custo_menu = array(
            "title" => $ui_daily_allowances,
            "icon" => "far fa-plane-alt", //<i class="fas fa-plane-alt"></i>
            "li_class" => "",
            "items" => array(
                "dg_ajd_custo" => array(
                    "title" => $ui_config,
                    "icon" => "far fa-road",
                    "url" => "ajax/dg_daily_allowances.php",
                    "li_class" => "ripple grey",
                    'active' => false
                ),        
                "rh_ajd_custo" => array(
                    "title" => $ui_registry,
                    "icon" => "far fa-car-building",
                    "url" => "ajax/rhid_daily_allowances.php",
                    "li_class" => "ripple grey",
                    'active' => false
                ),    
            )
        );
}

// matrizes de navegação para o módulo de prémios p/ coeficientes
if ($premios_coeficiente) { //Configuração dos Prémios por Coeficiente
    $premios_coef_oper = array(
        "prmcoef_oper_1" => array(
            "title" => $ui_coefficients,
            "icon" => "fas fa-edit",
            "url" => "ajax/dk_coefficients.php",
            "li_class" => "ripple grey",
            'active' => false
        ),
        "prmcoef_oper_2" => array(
            "title" => $ui_results,
            "icon" => "fas fa-edit",
            "url" => "ajax/dk_results.php",
            "li_class" => "ripple grey",
            'active' => false
        ),
        "prmcoef_oper_3" => array(
            "title" => $ui_business_indicators,
            "icon" => "fas fa-arrow-right",
            "li_class" => "",
            "items" => array(
                "dk_manutVals" => array(
                    "title" => $ui_values,
                    "icon" => "fas fa-edit",
                    "url" => "ajax/dk_maintenance_values.php",
                    "li_class" => "ripple grey",
                    'active' => false
                ),        
                "dk_inputVals" => array(
                    "title" => $ui_import_log,
                    "icon" => "fas fa-edit",
                    "url" => "ajax/dk_load_values.php",
                    "li_class" => "ripple grey",
                    'active' => false
                ),    
            )
        ),
    );
    
    $premios_coef_config = array(
        "dk_ccr_env" => array(
            "title" => $ui_environment,
            "icon" => "fas fa-edit",
            "url" => "ajax/dk_rewards_coef_environment.php",
            "li_class" => "ripple grey",
            'active' => false
        ),
        "dk_ccr_conf" => array(
            "title" => $ui_configs,
            "icon" => "fas fa-edit",
            "url" => "ajax/dk_matrix.php",
            "li_class" => "ripple grey",
            'active' => false
        ),
        "dk_profile" => array(
            "title" => "Gestão Perfis",
            "icon" => "fas fa-edit",
            "url" => "ajax/dk_profile_manage.php",
            "li_class" => "ripple grey",
            'active' => false
        ),
    );
}

if ($gestao_doc && $delegacoes && $premios_coeficiente) {
    $page_nav = array(
        "home" => array(
            "title" => 'QUAD-HCM',
            "icon" => "fas fa-users", //fa-users
            "url" => "ajax/dashboard_dsv.php",
            'active' => true,
            "li_class" => "",
            "items" => array(
                "gd_home" => array(
                    "title" => $ui_home,
                    "icon" => "fas fa-home",
                    "url" => "ajax/dashboard_dsv.php",
                    "li_class" => "ripple grey",
                    'active' => false,
                ),
                "cadastro" => array(
                    "title" => $ui_cadastre, //.' <sup class=\'badge bg-color-blue\' style=\'font-size: .8em;\'>RGPD</sup>'
                    "icon" => "fas fa-user-edit",
                    "url" => "ajax/rh_cadastro.php",
                    "li_class" => "ripple grey",
                    'active' => false,
                ),
                "workflow" => array(
                    "title" => $ui_workflows, //<i class="fas fa-user-edit"></i>
                    "icon" => "far fa-box-check",
                    "url" => "ajax/rhid_workflows.php",
                    "li_class" => "ripple grey",
                    'active' => false,
                ),
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
                "payment_mod" => array(
                    "title" => $ui_remunerations,
                    "icon" => "fab fa-amazon-pay fs_11_em", //<i class="fab fa-amazon-pay"></i> <i class="fab fa-cc-amazon-pay"></i>
                    //"url" => "ajax/gd_dashboard.php",
                    "li_class" => "",
                    "items" => array( 
                            "logical_receipt" => array(
                                "title" => $ui_logical_receipt, 
                                "icon" => "fal fa-table fs_11_em",
                                "url" => "ajax/rh_recibo_logico.php",
                                "li_class" => "ripple grey",
                                'active' => false
                            ),
                            "retroactives_def" => array(
                                "title" => $ui_retroactive_payments, 
                                "icon" => "far fa-layer-plus fs_11_em",
                                "url" => "ajax/rh_retroactives.php",
                                "li_class" => "ripple grey",
                                'active' => false
                            ),
                    ),                    
                ),                
                "reporting" => array(
                    "title" => $ui_reporting,
                    "icon" => "far fa-clone fs_11_em", //<i class="fab fa-amazon-pay"></i> <i class="fab fa-cc-amazon-pay"></i>
                    //"url" => "ajax/gd_dashboard.php",
                    "li_class" => "",
                    "items" => array( 
                            "outputy" => array(
                                "title" => $ui_outputs, 
                                "icon" => "far fa-sticky-note fs_11_em",
                                "url" => "ajax/dg_outputs.php",
                                "li_class" => "ripple grey",
                                'active' => false
                            ),
                            "addhoc" => array(
                                "title" => $ui_others, 
                                "icon" => "far fa-file-search fs_11_em", //<i class="far fa-file-search"></i>
                                "url" => "ajax/rh_retroactives.php?none",
                                "li_class" => "ripple grey",
                                'active' => false
                            ),
                    ),                    
                ),
                "modules" => array(
                    "title" => $ui_modules,
                    "icon" => "far fa-layer-group fs_11_em", //<i class="fab fa-amazon-pay"></i> <i class="fab fa-cc-amazon-pay"></i>
                    //"url" => "ajax/gd_dashboard.php",
                    "li_class" => "",            
                    "items" => array( 
                        "adhoc" => array(
                            "title" => 'QUAD-Builder <sup class=\'badge bg-color-orange\' style=\'font-size: .8em;\'>NEW</sup>',
                            "icon" => "fal fa-database",
                            "url" => "ajax/quad_builder.php",
                            "li_class" => "ripple grey",
                            'active' => false,
                        ),                               
                        "rhid_delegations" => array(
                            "title" => $ui_delegations,
                            "icon" => "fas fa-paper-plane", //fas fa-share-square
                            "url" => "ajax/rhid_delegations.php",
                            "li_class" => "ripple grey",
                            'active' => false
                        ),                  
                        "gd_oper" => array(
                            "title" => $ui_docs_management,
                            "icon" => "far fa-clone", //"far fa-desktop-alt", far fa-window-alt, far fa-copy fal fa-book-spells
                            "url" => "ajax/gd_dashboard.php",
                            "li_class" => "",
                            "items" => array(
                                "gd_oper_1" => array(
                                    "title" => $ui_processes,
                                    "icon" => "fas fa-edit",
                                    "url" => "ajax/gd_rhid_document_management.php",
                                    "li_class" => "ripple grey",
                                    'active' => false
                                ),
                                "gd_oper_auto_1" => array(
                                    "title" => $ui_macro_processes,
                                    "icon" => "fas fa-edit",
                                    "url" => "ajax/gd_template_auto.php",
                                    "li_class" => "ripple grey",
                                    'active' => false
                                ),
                                "gd_oper_auto" => array(
                                    "title" => $ui_renewals,
                                    "icon" => "fas fa-edit",
                                    "url" => "ajax/gd_renew_contracts.php",
                                    "li_class" => "ripple grey",
                                    'active' => false
                                ),
                            )
                        ),
                        $ajudas_custo_menu, 
                        "communication" => array(
                            "title" => $ui_comunication,
                            "icon" => "fas fa-rss-square fs_11_em",
                            //"url" => "ajax/gd_dashboard.php",
                            "li_class" => "",
                            "items" => array( 
                                    "comm_editor" => array(
                                        "title" => $ui_edition, 
                                        "icon" => "far fa-newspaper fs_11_em", 
                                        "url" => "ajax/dg_communications_editor.php",
                                        "li_class" => "ripple grey",
                                        'active' => false
                                    )
                            ),                    
                        ),
                        "coefprm_oper" => array(
                            "title" => $ui_coefficient_rewards,
                            "icon" => "fas fa-award fs_11_em",
                            "li_class" => "",
                            "items" => $premios_coef_oper,
                        ),                        
                    )
                ),      
                "fin_reports" => array(
                    "title" => $ui_financial_reports,
                    "icon" => "far fa-user-chart", //"far fa-desktop-alt", far fa-window-alt, far fa-copy fal fa-book-spells
                    //"url" => "ajax/gd_dashboard.php",
                    "li_class" => "",
                    "items" => array(                        
                        "bank_transfers" => array(
                            "title" => $ui_bank_transfers,
                            "icon" => "far fa-coins",
                            "url" => "ajax/rhid_bank_transfers.php",
                            "li_class" => "ripple grey",
                            'active' => false
                        ),                        
                        "juddicial_discounts" => array(
                            "title" => $ui_judicial_discounts,
                            "icon" => "fas fa-balance-scale",
                            "url" => "ajax/rhid_judicial_discounts.php",
                            "li_class" => "ripple grey",
                            'active' => false
                        ),                        
                        "current_accounts" => array(
                            "title" => $ui_current_accounts,
                            "icon" => "far fa-sack-dollar",
                            "url" => "ajax/rhid_current_accounts.php",
                            "li_class" => "ripple grey",
                            'active' => false
                        ),
                        "rhid_expenses" => array(
                            "title" => $ui_expenses,
                            "icon" => "far fa-coins", //fal fa-credit-card far fa-coins
                            "url" => "ajax/rhid_expenses.php",
                            "li_class" => "ripple grey",
                            'active' => false
                        ),      
                        "account_settling" => array(
                            "title" => $ui_account_settling,
                            "icon" => "fas fa-user-minus",
                            "url" => "ajax/rhid_account_settling.php",
                            "li_class" => "ripple grey",
                            'active' => false
                        ),
                    )
                ),                
                "hcm_oper" => array(
                    "title" => $ui_hcm,
                    "icon" => "fas fa-user",
                    "li_class" => "",
                    //"url" => "ajax/dashboard.php?module=ge",
                    "items" => array(
                        "oper_formacao" => array(
                            "title" => $ui_training,
                            "icon" => "fas fa-arrow-right",
                            "li_class" => "",
                            "items" => array(
                                "formacao_config" => array(
                                "title" => $ui_admin,
                                "icon" => "fas fa-arrow-right",
                                "li_class" => "",
                                    "items" => array(
                                        "fo_training_plan" => array(
                                            "title" => $ui_training_plans,
                                            "icon" => "fas fa-edit",
                                            "url" => "ajax/fo_training_plans.php",
                                            "li_class" => "ripple grey",
                                            'active' => false
                                        ),
                                        "fo_courses" => array(
                                            "title" => $ui_courses,
                                            "icon" => "fas fa-edit",
                                            "url" => "ajax/fo_courses.php",
                                            "li_class" => "ripple grey",
                                            'active' => false
                                        ),
                                        "fo_training_actions" => array(
                                            "title" => $ui_training_actions,
                                            "icon" => "fas fa-edit",
                                            "url" => "ajax/fo_training_actions.php",
                                            "li_class" => "ripple grey",
                                            'active' => false
                                        ),
                                        "fo_waiting_list" => array(
                                            "title" => $ui_waiting_list,
                                            "icon" => "fas fa-edit",
                                            "url" => "ajax/fo_waiting_list.php",
                                            "li_class" => "ripple grey",
                                            'active' => false
                                        ),
                                    ),
                                ),
                            ),
                        ),
                        "oper_aval_desempenho" => array(
                            "title" => $ui_performance_evaluation,
                            "icon" => "fas fa-arrow-right",
                            "li_class" => "",
                            "items" => array(
                                "aval_desempenho_config" => array(
                                "title" => $ui_admin,
                                "icon" => "fas fa-arrow-right",
                                "li_class" => "",
                                    "items" => array(
                                        "ad_plano_aval" => array(
                                            "title" => $ui_evaluation_plans,
                                            "icon" => "fas fa-edit",
                                            "url" => "ajax/ad_evaluation_plans.php",
                                            "li_class" => "ripple grey",
                                            'active' => false
                                        ),
                                        "ad_eval_sheets_frm" => array(
                                            "title" => $ui_evaluation_sheets,
                                            "icon" => "fas fa-edit",
                                            "url" => "ajax/ad_frm_employee_evaluation_sheet.php",
                                            "li_class" => "ripple grey",
                                            'active' => false
                                        ),                                        
                                        "ad_eval_sheets_frm" => array(
                                            "title" => $ui_follow_up,
                                            "icon" => "fas fa-edit",
                                            "url" => "ajax/ad_follow_up.php",
                                            "li_class" => "ripple grey",
                                            'active' => false
                                        ),                                        
                                        "ad_eval_assessment" => array(
                                            "title" => $ui_development_plans_long,
                                            "icon" => "fas fa-edit",
                                            "url" => "ajax/ad_development_plans.php",
                                            "li_class" => "ripple grey",
                                            'active' => false
                                        ),
                                        "ad_shared_obj_plan" => array(
                                            "title" => $ui_shared_objectives_plans,
                                            "icon" => "fas fa-edit",
                                            "url" => "ajax/ad_shared_obj_plans.php",
                                            "li_class" => "ripple grey",
                                            'active' => false
                                        )
                                    ),                                     
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
                                        "ad_results_orig" => array(
                                            "title" => $ui_eval_results . ' (Original)',
                                            "icon" => "fas fa-edit",
                                            "url" => "ajax/ad_employee_results_ORIG.php",
                                            "li_class" => "ripple grey",
                                            'active' => false
                                        ),     
                                    )
                                )
                            )
                        )
                    )
                ),
            )
        ),
        
        "hcm_param" => array(
            "title" => $ui_params,
            "icon" => "fas fa-cog fs_11_em", //far fa-landmark", far fa-compass, far fa-cog, far fa-play-circle, fas fa-drafting-compass, fas fa-wifi
            "li_class" => "",
            "items" => array(
                "param_general" => array(
                    "title" => $ui_general,
                    "icon" => "fas fa-arrow-right",
                    "li_class" => "",
                    "items" => array(
                        "configs" => array(
                            "title" => $ui_configs,
                            "icon" => "fas fa-edit",
                            "url" => "ajax/dg_configs.php",
                            "li_class" => "ripple grey",
                            'active' => false
                        ),
                        "profic_sacles" => array(
                            "title" => $ui_proficiency_scales,
                            "icon" => "fas fa-edit",
                            "url" => "ajax/dg_proficiency_scales.php",
                            "li_class" => "ripple grey",
                            'active' => false
                        ),
                        "units" => array(
                            "title" => $ui_units,
                            "icon" => "fas fa-edit",
                            "url" => "ajax/dg_units.php",
                            "li_class" => "ripple grey",
                            'active' => false
                        ),
                        "domains" => array(
                            "title" => $ui_domains,
                            "icon" => "fas fa-edit",
                            "url" => "ajax/dg_domains.php",
                            "li_class" => "ripple grey",
                            'active' => false
                        )
                    )
                ),                        
                "param_administrative" => array(
                    "title" => $ui_administrative,
                    "icon" => "fas fa-arrow-right",
                    "li_class" => "",
                    "items" => array(
                        "configs" => array(
                            "title" => $ui_geographies,
                            "icon" => "fas fa-edit",
                            "url" => "ajax/dg_geographies.php",
                            "li_class" => "ripple grey",
                            'active' => false
                        ),
                        "config_company" => array(
                            "title" => $ui_company,
                            "icon" => "fas fa-edit",
                            "url" => "ajax/dg_company.php",
                            "li_class" => "ripple grey",
                            'active' => false
                        ),
                        "fiscal_years" => array(
                            "title" => $ui_fiscal_years,
                            "icon" => "fas fa-edit",
                            "url" => "ajax/dg_fiscal_years.php",
                            "li_class" => "ripple grey",
                            'active' => false
                        ),   
                        "payroll_defs" => array(
                            "title" => $ui_payroll_management,
                            "icon" => "fas fa-edit",
                            "url" => "ajax/rh_def_payroll_management.php",
                            "li_class" => "ripple grey",
                            'active' => false
                        ),      
                        "output_defs" => array(
                            "title" => $ui_outputs,
                            "icon" => "fas fa-edit",
                            "url" => "ajax/dg_outputs_config.php",
                            "li_class" => "ripple grey",
                            'active' => false
                        ),
                        "rh_def_audits" => array(
                            "title" => $ui_audits,
                            "icon" => "fas fa-edit",
                            "url" => "ajax/rh_def_audits.php",
                            "li_class" => "ripple grey",
                            'active' => false
                        ),
                        "par_time_management" => array(
                            "title" => $ui_time_management,
                            "icon" => "fas fa-edit",
                            "url" => "ajax/rh_def_time_management.php",
                            "li_class" => "ripple grey",
                            'active' => false
                        ),
                        "external_entities" => array(
                            "title" => $ui_entities,
                            "icon" => "fas fa-edit",
                            "url" => "ajax/dg_entities.php",
                            "li_class" => "ripple grey",
                            'active' => false
                        ),
                        "par_adm_resources" => array(
                            "title" => $ui_resources,
                            "icon" => "fas fa-arrow-right",
                            "li_class" => "",
                            "items" => array(                                
                                "pa_internal_resources" => array(
                                    "title" => $ui_internal_resources_short,
                                    "icon" => "fas fa-edit",
                                    "url" => "ajax/rh_def_internal_resources.php",
                                    "li_class" => "ripple grey",
                                    'active' => false
                                ),
                                "pa_official_resources" => array(
                                    "title" => $ui_official_resources_short,
                                    "icon" => "fas fa-edit",
                                    "url" => "ajax/rh_def_official_resources.php",
                                    "li_class" => "ripple grey",
                                    'active' => false
                                ),                                        
                                "pa_accounting_resources" => array(
                                    "title" => $ui_accounting_interface_menu,
                                    "icon" => "fas fa-edit",
                                    "url" => "ajax/rh_accounting_interface.php",
                                    "li_class" => "ripple grey",
                                    'active' => false
                                ),                                        
                                "pa_contractual_bonds" => array(
                                    "title" => $ui_contractual_bonds,
                                    "icon" => "fas fa-edit",
                                    "url" => "ajax/rh_contractual_bonds.php",
                                    "li_class" => "ripple grey",
                                    'active' => false
                                ),                                        
                                "pa_discount_entities" => array(
                                    "title" => $ui_discount_entities,
                                    "icon" => "fas fa-edit",
                                    "url" => "ajax/rh_discount_entities.php",
                                    "li_class" => "ripple grey",
                                    'active' => false
                                ),
                            )
                        )
                    )
                ),
                "timesheets_conf" => array(
                    "title" => $ui_timesheets,
                    "icon" => "fas fa-edit",
                    "url" => "ajax/timesheet_resources.php",
                    "li_class" => "ripple grey",
                    'active' => false
                ),
                "premios_coeficiente" => array(
                    "title" => $ui_coefficient_rewards,
                    "icon" => "fas fa-arrow-right",
                    "li_class" => "",
                    "items" => $premios_coef_config,
                ),
                "docs_management" => array(
                    "title" => $ui_docs_management,
                    "icon" => "fas fa-arrow-right",
                    "li_class" => "",
                    "items" => array(
                        "gd_resources" => array(
                            "title" => $ui_resources,
                            "icon" => "fas fa-edit",
                            "url" => "ajax/gd_resources.php",
                            "li_class" => "ripple grey",
                            'active' => false,
                        ),
                        "gd_config" => array(
                            "title" => $ui_models,
                            "icon" => "fas fa-edit",
                            "url" => "ajax/gd_model_definiton.php",
                            "li_class" => "ripple grey",
                            'active' => false,
                        )
                    )
                ),
                "ge_module" => array(
                    "title" => $ui_strategic_management,
                    "icon" => "fas fa-arrow-right",
                    "li_class" => "",
                    "items" => array(
                        "ge_functions_skills" => array(
                            "title" => $ui_functions_and_skills,
                            "icon" => "fas fa-arrow-right",
                            "li_class" => "",
                            "items" => array(
                                "ge_characteristics" => array(
                                    "title" => $ui_characteristics,
                                    "icon" => "fas fa-edit",
                                    "url" => "ajax/ge_characteristics.php",
                                    "li_class" => "ripple grey",
                                    'active' => false
                                ),
                                "ge_skills_behaviors" => array(
                                    "title" => $ui_skills,
                                    "icon" => "fas fa-edit",
                                    "url" => "ajax/ge_skills_behaviors.php",
                                    "li_class" => "ripple grey",
                                    'active' => false
                                ),
                                "ge_func_grp" => array(
                                    "title" => $ui_functional_groups,
                                    "icon" => "fas fa-edit",
                                    "url" => "ajax/ge_functional_groups.php",
                                    "li_class" => "ripple grey",
                                    'active' => false
                                ),
                                "ge_functions" => array(
                                    "title" => $ui_functions,
                                    "icon" => "fas fa-edit",
                                    "url" => "ajax/ge_functions.php",
                                    "li_class" => "ripple grey",
                                    'active' => false
                                ),
                                "ad_aval_individual" => array(
                                    "title" => $ui_individuals,
                                    "icon" => "fas fa-edit",
                                    "url" => "ajax/ge_individuals.php",
                                    "li_class" => "ripple grey",
                                    'active' => false
                                ),
                            ),
                        ),
                        "aval_desempenho" => array(
                            "title" => $ui_performance_evaluation,
                            "icon" => "fas fa-arrow-right",
                            "li_class" => "",
                            "items" => array(
                                "ad_ambiente" => array(
                                    "title" => $ui_environment,
                                    "icon" => "fas fa-edit",
                                    "url" => "ajax/ad_environment.php",
                                    "li_class" => "ripple grey",
                                    'active' => false
                                ),
                                "ad_objetivos" => array(
                                    "title" => $ui_objectives,
                                    "icon" => "fas fa-edit",
                                    "url" => "ajax/ad_objectives.php",
                                    "li_class" => "ripple grey",
                                    'active' => false
                                ),
                                "ad_teams" => array(
                                    "title" => $ui_teams,
                                    "icon" => "fas fa-edit",
                                    "url" => "ajax/ad_teams_shared_objectives.php",
                                    "li_class" => "ripple grey",
                                    'active' => false
                                ),
                                "ad_comite_calib" => array(
                                    "title" => $ui_calibration_committees,
                                    "icon" => "fas fa-edit",
                                    "url" => "ajax/ad_calibration_committees.php",
                                    "li_class" => "ripple grey",
                                    'active' => false
                                ),                                    
                            ),
                        ),
                        "param_formacao" => array(
                            "title" => $ui_training,
                            "icon" => "fas fa-arrow-right",
                            "li_class" => "",
                            "items" => array(
                                "ad_ambiente" => array(
                                    "title" => $ui_organization,
                                    "icon" => "fas fa-edit",
                                    "url" => "ajax/fo_organization.php",
                                    "li_class" => "ripple grey",
                                    'active' => false
                                ),
                                "ad_objetivos" => array(
                                    "title" => $ui_situations_and_reasons,
                                    "icon" => "fas fa-edit",
                                    "url" => "ajax/fo_situations_reasons.php",
                                    "li_class" => "ripple grey",
                                    'active' => false
                                ),
                                "ad_teams" => array(
                                    "title" => $ui_costs,
                                    "icon" => "fas fa-edit",
                                    "url" => "ajax/fo_costs_config.php",
                                    "li_class" => "ripple grey",
                                    'active' => false
                                ),
                                "ad_comite_calib" => array(
                                    "title" => $ui_logistics,
                                    "icon" => "fas fa-edit",
                                    "url" => "ajax/fo_logistics.php",
                                    "li_class" => "ripple grey",
                                    'active' => false
                                ),                                    
                            ),
                        ),                                
                    )
                ),
                "quad_conf" => array(
                    "title" => $ui_configurations,
                    "icon" => "fas fa-arrow-right",
                    "li_class" => "",
                    "items" => array(
                        "quad_conf_1" => array(
                            "title" => $ui_modules_profiles,
                            "icon" => "fas fa-edit",
                            "url" => "ajax/dg_modules_profiles.php",
                            "li_class" => "ripple grey",
                            'active' => false
                        ),
                        "quad_conf_2" => array(
                            "title" => $ui_workflows,
                            "icon" => "fas fa-edit",
                            "url" => "ajax/dg_adm_workflows.php",
                            "li_class" => "ripple grey",
                            'active' => false
                        ),
                        "quad_conf_3" => array(
                            "title" => $ui_users,
                            "icon" => "fas fa-edit",
                            "url" => "ajax/dg_users.php",
                            "li_class" => "ripple grey",
                            'active' => false
                        ),
                        "quad_conf_dd" => array(
                            "title" => $ui_data_dictionary,
                            "icon" => "fas fa-edit",
                            "url" => "ajax/dg_data_dictionary.php",
                            "li_class" => "ripple grey",
                            'active' => false
                        )

                    )
                )
            )
        ),        
        
        //Product LEVEL
        "dsv_prototipos" => array(
            "title" => 'Protótipos Dsv.',
            "icon" => "fas fa-code",
            "li_class" => "",
            "items" => array(
                "svg_exper" => array(
                    "title" => 'Timesheets Tree',
                    "icon" => "fal fa-database",
                    "url" => "ajax/timesheets_tree.php",
                    "li_class" => "ripple grey",
                    'active' => false,
                ),
                "contextMenu" => array(
                    "title" => 'Context Menus',
                    "icon" => "fal fa-database",
                    "url" => "ajax/contextMenu.php",
                    "li_class" => "ripple grey",
                    'active' => false,
                ),
                "fixed" => array(
                    "title" => 'Fixed Columns',
                    "icon" => "fal fa-database",
                    "url" => "ajax/fixed-columns.html",
                    "li_class" => "ripple grey",
                    'active' => false,
                ),
                "fixed" => array(
                    "title" => 'Fixed Cols w/Scroll',
                    "icon" => "fal fa-database",
                    "url" => "ajax/prototipos/fixed_cols_scroll_PROTO.php",
                    "li_class" => "ripple grey",
                    'active' => false,
                ),
                "tester" => array(
                    "title" => 'Workers Demo',
                    "icon" => "fas fa-chart-bar",
                    "url" => "ajax/graphics_tester.php",
                    "li_class" => "ripple grey",
                    'active' => false,
                ),
                "calend_0" => array(
                    "title" => 'Calendário PROTO',
                    "icon" => "far fa-calendar",
                    "url" => "ajax/modal_calendar.php",
                    "li_class" => "ripple grey",
                    'active' => false,
                ),  
                "calend_1" => array(
                    "title" => 'Calendário',
                    "icon" => "far fa-calendar",
                    "url" => "ajax/scheduler.php",
                    "li_class" => "ripple grey",
                    'active' => false,
                ),  
                "flip_card" => array(
                    "title" => 'Flip Card', 
                    "icon" => "far fa-clock fs_11_em",
                    "url" => "ajax/prototipos/flip_card.php",
                    "li_class" => "ripple grey",
                    'active' => false
                ), 
                "LEO_1" => array(
                    "title" => 'LEO #1',
                    "icon" => "far fa-calendar",
                    "url" => "ajax/prototipos/LEO_formComplexLists.php",
                    "li_class" => "ripple grey",
                    'active' => false,
                ), 
                "LEO_2" => array(
                    "title" => 'LEO #2',
                    "icon" => "far fa-calendar",
                    "url" => "ajax/prototipos/LEO_formMaster-DTDetail.php",
                    "li_class" => "ripple grey",
                    'active' => false,
                ), 
                "CAD_OLD" => array(
                    "title" => 'Cadastro Old',
                    "icon" => "far fa-calendar",
                    "url" => "ajax/prototipos/cadastro_w_nav.php",
                    "li_class" => "ripple grey",
                    'active' => false,
                ),                
            )
        )     
    );
}
elseif ($gestao_doc && !$delegacoes) {

    $_nav = array(
        "home" => array(
            "title" => 'QUAD-HCM', //$ui_admin,
            "icon" => "fas fa-users",
            "url" => "ajax/dashboard.php",
            'active' => true,
            "li_class" => "",
            "items" => array(
                "gd_home" => array(
                    "title" => $ui_home,
                    "icon" => "fas fa-home",
                    "url" => "ajax/dashboard.php",
                    "li_class" => "ripple grey",
                    'active' => false,
                ),
                "gd_oper" => array(
                    "title" => $ui_processes,
                    "icon" => "fas fa-edit",
                    "url" => "ajax/gd_rhid_document_management.php",
                    "li_class" => "ripple grey",
                    'active' => false
                ),
                "hcm_param" => array(
                    "title" => $ui_params,
                    "icon" => "fa fa-cubes",
                    "li_class" => "",
                    "items" => array(
                        "docs_management" => array(
                            "title" => $ui_docs_management,
                            "icon" => "fas fa-arrow-right",
                            "li_class" => "",
                            "items" => array(
                                "gd_resources" => array(
                                    "title" => $ui_resources,
                                    "icon" => "fas fa-edit",
                                    "url" => "ajax/gd_resources.php",
                                    "li_class" => "ripple grey",
                                    'active' => false,
                                ),
                                "gd_config" => array(
                                    "title" => $ui_models,
                                    "icon" => "fas fa-edit",
                                    "url" => "ajax/gd_model_definiton.php",
                                    "li_class" => "ripple grey",
                                    'active' => false,
                                )
                            )
                        )
                    )
                )
            )
        )
    );
}


$_nav = array(
    "home" => array(
        'title' => 'QUAD-HCM ',
        'icon' => "fas fa-users", //fa-users
        'url' => "ajax/dashboard_dsv.php",
        'active' => true,
        'items' => array(
            "gd_home" => array(
                'title' => $ui_home,
                'icon' => "fas fa-home",
                'url' => "ajax/dashboard_dsv.php",
                'active' => false,
            ),
            "cadastro" => array(
                'title' => $ui_cadastre, //.' <sup class=\'badge bg-color-blue\' style=\'font-size: .8em;\'>RGPD</sup>'
                'icon' => "fas fa-user-edit",
                'url' => "ajax/rh_cadastro.php",
                'active' => false,
            ),
            "workflow" => array(
                'title' => $ui_workflows, //<i class="fas fa-user-edit"></i>
                'icon' => "far fa-box-check",
                'url' => "ajax/rhid_workflows.php",
                'active' => false,
            ),
            "tm_mod" => array(
                'title' => $ui_time_management,
                'icon' => "far fa-clock fs_11_em", 
                //'url' => "ajax/gd_dashboard.php",
                "li_class" => "",
                'items' => array( 
                        "cadastro_tm" => array(
                            'title' => $ui_cadastre, //$ui_time_management . " <sup class='badge bg-color-greenLight' style='font-size: .8em;'> RHID</sup>", 
                            'icon' => "fal fa-user-clock", //<i class="far fa-calendar-edit"></i>
                            'url' => "ajax/rh_time_management.php",
                            "li_class" => "ripple grey",
                            'active' => false,
                            "class" => "noTitle"
                        ),            
                        "matrix" => array(
                            'title' => $ui_time_scales, 
                            'icon' => "far fa-calendar-edit fs_11_em",
                            'url' => "ajax/rh_escalas.php",
                            "li_class" => "ripple grey",
                            'active' => false
                        ),
                    ),
            ),
            "payment_mod" => array(
                'title' => $ui_remunerations,
                'icon' => "fab fa-amazon-pay fs_11_em", //<i class="fab fa-amazon-pay"></i> <i class="fab fa-cc-amazon-pay"></i>
                //'url' => "ajax/gd_dashboard.php",
                "li_class" => "",
                'items' => array( 
                        "logical_receipt" => array(
                            'title' => $ui_logical_receipt, 
                            'icon' => "fal fa-table fs_11_em",
                            'url' => "ajax/rh_recibo_logico.php",
                            "li_class" => "ripple grey",
                            'active' => false
                        ),
                        "retroactives_def" => array(
                            'title' => $ui_retroactive_payments, 
                            'icon' => "far fa-layer-plus fs_11_em",
                            'url' => "ajax/rh_retroactives.php",
                            "li_class" => "ripple grey",
                            'active' => false
                        ),
                ),                    
            ),                
            "reporting" => array(
                'title' => $ui_reporting,
                'icon' => "far fa-clone fs_11_em", //<i class="fab fa-amazon-pay"></i> <i class="fab fa-cc-amazon-pay"></i>
                //'url' => "ajax/gd_dashboard.php",
                "li_class" => "",
                'items' => array( 
                        "outputy" => array(
                            'title' => $ui_outputs, 
                            'icon' => "far fa-sticky-note fs_11_em",
                            'url' => "ajax/dg_outputs.php",
                            "li_class" => "ripple grey",
                            'active' => false
                        ),
                        "addhoc" => array(
                            'title' => $ui_others, 
                            'icon' => "far fa-file-search fs_11_em", //<i class="far fa-file-search"></i>
                            'url' => "ajax/rh_retroactives.php?none",
                            "li_class" => "ripple grey",
                            'active' => false
                        ),
                ),                    
            ),
            "modules" => array(
                'title' => $ui_modules,
                'icon' => "far fa-layer-group fs_11_em", //<i class="fab fa-amazon-pay"></i> <i class="fab fa-cc-amazon-pay"></i>
                //'url' => "ajax/gd_dashboard.php",
                "li_class" => "",            
                'items' => array( 
                    "adhoc" => array(
                        'title' => 'QUAD-Builder <sup class=\'badge bg-color-orange\' style=\'font-size: .8em;\'>NEW</sup>',
                        'icon' => "fal fa-database",
                        'url' => "ajax/quad_builder.php",
                        "li_class" => "ripple grey",
                        'active' => false,
                    ),                               
                    "rhid_delegations" => array(
                        'title' => $ui_delegations,
                        'icon' => "fas fa-paper-plane", //fas fa-share-square
                        'url' => "ajax/rhid_delegations.php",
                        "li_class" => "ripple grey",
                        'active' => false
                    ),                  
                    "gd_oper" => array(
                        'title' => $ui_docs_management,
                        'icon' => "far fa-clone", //"far fa-desktop-alt", far fa-window-alt, far fa-copy fal fa-book-spells
                        'url' => "ajax/gd_dashboard.php",
                        "li_class" => "",
                        'items' => array(
                            "gd_oper_1" => array(
                                'title' => $ui_processes,
                                'icon' => "fas fa-edit",
                                'url' => "ajax/gd_rhid_document_management.php",
                                "li_class" => "ripple grey",
                                'active' => false
                            ),
                            "gd_oper_auto_1" => array(
                                'title' => $ui_macro_processes,
                                'icon' => "fas fa-edit",
                                'url' => "ajax/gd_template_auto.php",
                                "li_class" => "ripple grey",
                                'active' => false
                            ),
                            "gd_oper_auto" => array(
                                'title' => $ui_renewals,
                                'icon' => "fas fa-edit",
                                'url' => "ajax/gd_renew_contracts.php",
                                "li_class" => "ripple grey",
                                'active' => false
                            ),
                        )
                    ),
                    $ajudas_custo_menu, 
                    "communication" => array(
                        'title' => $ui_comunication,
                        'icon' => "fas fa-rss-square fs_11_em",
                        //'url' => "ajax/gd_dashboard.php",
                        "li_class" => "",
                        'items' => array( 
                                "comm_editor" => array(
                                    'title' => $ui_edition, 
                                    'icon' => "far fa-newspaper fs_11_em", 
                                    'url' => "ajax/dg_communications_editor.php",
                                    "li_class" => "ripple grey",
                                    'active' => false
                                )
                        ),                    
                    ),
                    "coefprm_oper" => array(
                        'title' => $ui_coefficient_rewards,
                        'icon' => "fas fa-award fs_11_em",
                        "li_class" => "",
                        'items' => $premios_coef_oper,
                    ),                        
                )
            ),      
            "fin_reports" => array(
                'title' => $ui_financial_reports,
                'icon' => "far fa-user-chart", //"far fa-desktop-alt", far fa-window-alt, far fa-copy fal fa-book-spells
                //'url' => "ajax/gd_dashboard.php",
                "li_class" => "",
                'items' => array(                        
                    "bank_transfers" => array(
                        'title' => $ui_bank_transfers,
                        'icon' => "far fa-coins",
                        'url' => "ajax/rhid_bank_transfers.php",
                        "li_class" => "ripple grey",
                        'active' => false
                    ),                        
                    "juddicial_discounts" => array(
                        'title' => $ui_judicial_discounts,
                        'icon' => "fas fa-balance-scale",
                        'url' => "ajax/rhid_judicial_discounts.php",
                        "li_class" => "ripple grey",
                        'active' => false
                    ),                        
                    "current_accounts" => array(
                        'title' => $ui_current_accounts,
                        'icon' => "far fa-sack-dollar",
                        'url' => "ajax/rhid_current_accounts.php",
                        "li_class" => "ripple grey",
                        'active' => false
                    ),
                    "rhid_expenses" => array(
                        'title' => $ui_expenses,
                        'icon' => "far fa-coins", //fal fa-credit-card far fa-coins
                        'url' => "ajax/rhid_expenses.php",
                        "li_class" => "ripple grey",
                        'active' => false
                    ),      
                    "account_settling" => array(
                        'title' => $ui_account_settling,
                        'icon' => "fas fa-user-minus",
                        'url' => "ajax/rhid_account_settling.php",
                        "li_class" => "ripple grey",
                        'active' => false
                    ),
                )
            ),                
            "hcm_oper" => array(
                'title' => $ui_hcm,
                'icon' => "fas fa-user",
                "li_class" => "",
                //'url' => "ajax/dashboard.php?module=ge",
                'items' => array(
                    "oper_formacao" => array(
                        'title' => $ui_training,
                        'icon' => "fas fa-arrow-right",
                        "li_class" => "",
                        'items' => array(
                            "formacao_config" => array(
                            'title' => $ui_admin,
                            'icon' => "fas fa-arrow-right",
                            "li_class" => "",
                                'items' => array(
                                    "fo_training_plan" => array(
                                        'title' => $ui_training_plans,
                                        'icon' => "fas fa-edit",
                                        'url' => "ajax/fo_training_plans.php",
                                        "li_class" => "ripple grey",
                                        'active' => false
                                    ),
                                    "fo_courses" => array(
                                        'title' => $ui_courses,
                                        'icon' => "fas fa-edit",
                                        'url' => "ajax/fo_courses.php",
                                        "li_class" => "ripple grey",
                                        'active' => false
                                    ),
                                    "fo_training_actions" => array(
                                        'title' => $ui_training_actions,
                                        'icon' => "fas fa-edit",
                                        'url' => "ajax/fo_training_actions.php",
                                        "li_class" => "ripple grey",
                                        'active' => false
                                    ),
                                    "fo_waiting_list" => array(
                                        'title' => $ui_waiting_list,
                                        'icon' => "fas fa-edit",
                                        'url' => "ajax/fo_waiting_list.php",
                                        "li_class" => "ripple grey",
                                        'active' => false
                                    ),
                                ),
                            ),
                        ),
                    ),
                    "oper_aval_desempenho" => array(
                        'title' => $ui_performance_evaluation,
                        'icon' => "fas fa-arrow-right",
                        "li_class" => "",
                        'items' => array(
                            "aval_desempenho_config" => array(
                            'title' => $ui_admin,
                            'icon' => "fas fa-arrow-right",
                            "li_class" => "",
                                'items' => array(
                                    "ad_plano_aval" => array(
                                        'title' => $ui_evaluation_plans,
                                        'icon' => "fas fa-edit",
                                        'url' => "ajax/ad_evaluation_plans.php",
                                        "li_class" => "ripple grey",
                                        'active' => false
                                    ),
                                    "ad_eval_sheets_frm" => array(
                                        'title' => $ui_evaluation_sheets,
                                        'icon' => "fas fa-edit",
                                        'url' => "ajax/ad_frm_employee_evaluation_sheet.php",
                                        "li_class" => "ripple grey",
                                        'active' => false
                                    ),                                        
                                    "ad_eval_sheets_frm" => array(
                                        'title' => $ui_follow_up,
                                        'icon' => "fas fa-edit",
                                        'url' => "ajax/ad_follow_up.php",
                                        "li_class" => "ripple grey",
                                        'active' => false
                                    ),                                        
                                    "ad_eval_assessment" => array(
                                        'title' => $ui_development_plans_long,
                                        'icon' => "fas fa-edit",
                                        'url' => "ajax/ad_development_plans.php",
                                        "li_class" => "ripple grey",
                                        'active' => false
                                    ),
                                    "ad_shared_obj_plan" => array(
                                        'title' => $ui_shared_objectives_plans,
                                        'icon' => "fas fa-edit",
                                        'url' => "ajax/ad_shared_obj_plans.php",
                                        "li_class" => "ripple grey",
                                        'active' => false
                                    )
                                ),                                     
                            ),
                            "aval_desempenho_sheets" => array(
                            'title' => $ui_evaluation_sheets,
                            'icon' => "fas fa-arrow-right",
                            "li_class" => "",
                                'items' => array(
                                    "ad_plano_aval" => array(
                                        'title' => $ui_self_evaluation,
                                        'icon' => "fas fa-edit",
                                        'url' => "ajax/ad_employee_evaluation_sheet.php",
                                        "li_class" => "ripple grey",
                                        'active' => false
                                    ),
                                    "ad_results" => array(
                                        'title' => $ui_eval_results,
                                        'icon' => "fas fa-edit",
                                        'url' => "ajax/ad_employee_results.php",
                                        "li_class" => "ripple grey",
                                        'active' => false
                                    ),                                             
                                    "ad_results_orig" => array(
                                        'title' => $ui_eval_results . ' (Original)',
                                        'icon' => "fas fa-edit",
                                        'url' => "ajax/ad_employee_results_ORIG.php",
                                        "li_class" => "ripple grey",
                                        'active' => false
                                    ),     
                                )
                            )
                        )
                    )
                )
            ),
        )
    ),

    "hcm_param" => array(
        'title' => $ui_params,
        'icon' => "fas fa-cog fs_11_em", //far fa-landmark", far fa-compass, far fa-cog, far fa-play-circle, fas fa-drafting-compass, fas fa-wifi
        "li_class" => "",
        'items' => array(
            "param_general" => array(
                'title' => $ui_general,
                'icon' => "fas fa-arrow-right",
                "li_class" => "",
                'items' => array(
                    "configs" => array(
                        'title' => $ui_configs,
                        'icon' => "fas fa-edit",
                        'url' => "ajax/dg_configs.php",
                        "li_class" => "ripple grey",
                        'active' => false
                    ),
                    "profic_sacles" => array(
                        'title' => $ui_proficiency_scales,
                        'icon' => "fas fa-edit",
                        'url' => "ajax/dg_proficiency_scales.php",
                        "li_class" => "ripple grey",
                        'active' => false
                    ),
                    "units" => array(
                        'title' => $ui_units,
                        'icon' => "fas fa-edit",
                        'url' => "ajax/dg_units.php",
                        "li_class" => "ripple grey",
                        'active' => false
                    ),
                    "domains" => array(
                        'title' => $ui_domains,
                        'icon' => "fas fa-edit",
                        'url' => "ajax/dg_domains.php",
                        "li_class" => "ripple grey",
                        'active' => false
                    )
                )
            ),                        
            "param_administrative" => array(
                'title' => $ui_administrative,
                'icon' => "fas fa-arrow-right",
                "li_class" => "",
                'items' => array(
                    "configs" => array(
                        'title' => $ui_geographies,
                        'icon' => "fas fa-edit",
                        'url' => "ajax/dg_geographies.php",
                        "li_class" => "ripple grey",
                        'active' => false
                    ),
                    "config_company" => array(
                        'title' => $ui_company,
                        'icon' => "fas fa-edit",
                        'url' => "ajax/dg_company.php",
                        "li_class" => "ripple grey",
                        'active' => false
                    ),
                    "fiscal_years" => array(
                        'title' => $ui_fiscal_years,
                        'icon' => "fas fa-edit",
                        'url' => "ajax/dg_fiscal_years.php",
                        "li_class" => "ripple grey",
                        'active' => false
                    ),   
                    "payroll_defs" => array(
                        'title' => $ui_payroll_management,
                        'icon' => "fas fa-edit",
                        'url' => "ajax/rh_def_payroll_management.php",
                        "li_class" => "ripple grey",
                        'active' => false
                    ),      
                    "output_defs" => array(
                        'title' => $ui_outputs,
                        'icon' => "fas fa-edit",
                        'url' => "ajax/dg_outputs_config.php",
                        "li_class" => "ripple grey",
                        'active' => false
                    ),
                    "rh_def_audits" => array(
                        'title' => $ui_audits,
                        'icon' => "fas fa-edit",
                        'url' => "ajax/rh_def_audits.php",
                        "li_class" => "ripple grey",
                        'active' => false
                    ),
                    "par_time_management" => array(
                        'title' => $ui_time_management,
                        'icon' => "fas fa-edit",
                        'url' => "ajax/rh_def_time_management.php",
                        "li_class" => "ripple grey",
                        'active' => false
                    ),
                    "external_entities" => array(
                        'title' => $ui_entities,
                        'icon' => "fas fa-edit",
                        'url' => "ajax/dg_entities.php",
                        "li_class" => "ripple grey",
                        'active' => false
                    ),
                    "par_adm_resources" => array(
                        'title' => $ui_resources,
                        'icon' => "fas fa-arrow-right",
                        "li_class" => "",
                        'items' => array(                                
                            "pa_internal_resources" => array(
                                'title' => $ui_internal_resources_short,
                                'icon' => "fas fa-edit",
                                'url' => "ajax/rh_def_internal_resources.php",
                                "li_class" => "ripple grey",
                                'active' => false
                            ),
                            "pa_official_resources" => array(
                                'title' => $ui_official_resources_short,
                                'icon' => "fas fa-edit",
                                'url' => "ajax/rh_def_official_resources.php",
                                "li_class" => "ripple grey",
                                'active' => false
                            ),                                        
                            "pa_accounting_resources" => array(
                                'title' => $ui_accounting_interface_menu,
                                'icon' => "fas fa-edit",
                                'url' => "ajax/rh_accounting_interface.php",
                                "li_class" => "ripple grey",
                                'active' => false
                            ),                                        
                            "pa_contractual_bonds" => array(
                                'title' => $ui_contractual_bonds,
                                'icon' => "fas fa-edit",
                                'url' => "ajax/rh_contractual_bonds.php",
                                "li_class" => "ripple grey",
                                'active' => false
                            ),                                        
                            "pa_discount_entities" => array(
                                'title' => $ui_discount_entities,
                                'icon' => "fas fa-edit",
                                'url' => "ajax/rh_discount_entities.php",
                                "li_class" => "ripple grey",
                                'active' => false
                            ),
                        )
                    )
                )
            ),
            "timesheets_conf" => array(
                'title' => $ui_timesheets,
                'icon' => "fas fa-edit",
                'url' => "ajax/timesheet_resources.php",
                "li_class" => "ripple grey",
                'active' => false
            ),
            "premios_coeficiente" => array(
                'title' => $ui_coefficient_rewards,
                'icon' => "fas fa-arrow-right",
                "li_class" => "",
                'items' => $premios_coef_config,
            ),
            "docs_management" => array(
                'title' => $ui_docs_management,
                'icon' => "fas fa-arrow-right",
                "li_class" => "",
                'items' => array(
                    "gd_resources" => array(
                        'title' => $ui_resources,
                        'icon' => "fas fa-edit",
                        'url' => "ajax/gd_resources.php",
                        "li_class" => "ripple grey",
                        'active' => false,
                    ),
                    "gd_config" => array(
                        'title' => $ui_models,
                        'icon' => "fas fa-edit",
                        'url' => "ajax/gd_model_definiton.php",
                        "li_class" => "ripple grey",
                        'active' => false,
                    )
                )
            ),
            "ge_module" => array(
                'title' => $ui_strategic_management,
                'icon' => "fas fa-arrow-right",
                "li_class" => "",
                'items' => array(
                    "ge_functions_skills" => array(
                        'title' => $ui_functions_and_skills,
                        'icon' => "fas fa-arrow-right",
                        "li_class" => "",
                        'items' => array(
                            "ge_characteristics" => array(
                                'title' => $ui_characteristics,
                                'icon' => "fas fa-edit",
                                'url' => "ajax/ge_characteristics.php",
                                "li_class" => "ripple grey",
                                'active' => false
                            ),
                            "ge_skills_behaviors" => array(
                                'title' => $ui_skills,
                                'icon' => "fas fa-edit",
                                'url' => "ajax/ge_skills_behaviors.php",
                                "li_class" => "ripple grey",
                                'active' => false
                            ),
                            "ge_func_grp" => array(
                                'title' => $ui_functional_groups,
                                'icon' => "fas fa-edit",
                                'url' => "ajax/ge_functional_groups.php",
                                "li_class" => "ripple grey",
                                'active' => false
                            ),
                            "ge_functions" => array(
                                'title' => $ui_functions,
                                'icon' => "fas fa-edit",
                                'url' => "ajax/ge_functions.php",
                                "li_class" => "ripple grey",
                                'active' => false
                            ),
                            "ad_aval_individual" => array(
                                'title' => $ui_individuals,
                                'icon' => "fas fa-edit",
                                'url' => "ajax/ge_individuals.php",
                                "li_class" => "ripple grey",
                                'active' => false
                            ),
                        ),
                    ),
                    "aval_desempenho" => array(
                        'title' => $ui_performance_evaluation,
                        'icon' => "fas fa-arrow-right",
                        "li_class" => "",
                        'items' => array(
                            "ad_ambiente" => array(
                                'title' => $ui_environment,
                                'icon' => "fas fa-edit",
                                'url' => "ajax/ad_environment.php",
                                "li_class" => "ripple grey",
                                'active' => false
                            ),
                            "ad_objetivos" => array(
                                'title' => $ui_objectives,
                                'icon' => "fas fa-edit",
                                'url' => "ajax/ad_objectives.php",
                                "li_class" => "ripple grey",
                                'active' => false
                            ),
                            "ad_teams" => array(
                                'title' => $ui_teams,
                                'icon' => "fas fa-edit",
                                'url' => "ajax/ad_teams_shared_objectives.php",
                                "li_class" => "ripple grey",
                                'active' => false
                            ),
                            "ad_comite_calib" => array(
                                'title' => $ui_calibration_committees,
                                'icon' => "fas fa-edit",
                                'url' => "ajax/ad_calibration_committees.php",
                                "li_class" => "ripple grey",
                                'active' => false
                            ),                                    
                        ),
                    ),
                    "param_formacao" => array(
                        'title' => $ui_training,
                        'icon' => "fas fa-arrow-right",
                        "li_class" => "",
                        'items' => array(
                            "ad_ambiente" => array(
                                'title' => $ui_organization,
                                'icon' => "fas fa-edit",
                                'url' => "ajax/fo_organization.php",
                                "li_class" => "ripple grey",
                                'active' => false
                            ),
                            "ad_objetivos" => array(
                                'title' => $ui_situations_and_reasons,
                                'icon' => "fas fa-edit",
                                'url' => "ajax/fo_situations_reasons.php",
                                "li_class" => "ripple grey",
                                'active' => false
                            ),
                            "ad_teams" => array(
                                'title' => $ui_costs,
                                'icon' => "fas fa-edit",
                                'url' => "ajax/fo_costs_config.php",
                                "li_class" => "ripple grey",
                                'active' => false
                            ),
                            "ad_comite_calib" => array(
                                'title' => $ui_logistics,
                                'icon' => "fas fa-edit",
                                'url' => "ajax/fo_logistics.php",
                                "li_class" => "ripple grey",
                                'active' => false
                            ),                                    
                        ),
                    ),                                
                )
            ),
            "quad_conf" => array(
                'title' => $ui_configurations,
                'icon' => "fas fa-arrow-right",
                "li_class" => "",
                'items' => array(
                    "quad_conf_1" => array(
                        'title' => $ui_modules_profiles,
                        'icon' => "fas fa-edit",
                        'url' => "ajax/dg_modules_profiles.php",
                        "li_class" => "ripple grey",
                        'active' => false
                    ),
                    "quad_conf_2" => array(
                        'title' => $ui_workflows,
                        'icon' => "fas fa-edit",
                        'url' => "ajax/dg_adm_workflows.php",
                        "li_class" => "ripple grey",
                        'active' => false
                    ),
                    "quad_conf_3" => array(
                        'title' => $ui_users,
                        'icon' => "fas fa-edit",
                        'url' => "ajax/dg_users.php",
                        "li_class" => "ripple grey",
                        'active' => false
                    ),
                    "quad_conf_dd" => array(
                        'title' => $ui_data_dictionary,
                        'icon' => "fas fa-edit",
                        'url' => "ajax/dg_data_dictionary.php",
                        "li_class" => "ripple grey",
                        'active' => false
                    )

                )
            )
        )
    ),        

    //Product LEVEL
    "dsv_prototipos" => array(
        'title' => 'Protótipos Dsv.',
        'icon' => "fas fa-code",
        "li_class" => "",
        'items' => array(
            "svg_exper" => array(
                'title' => 'Timesheets Tree',
                'icon' => "fal fa-database",
                'url' => "ajax/timesheets_tree.php",
                "li_class" => "ripple grey",
                'active' => false,
            ),
            "contextMenu" => array(
                'title' => 'Context Menus',
                'icon' => "fal fa-database",
                'url' => "ajax/contextMenu.php",
                "li_class" => "ripple grey",
                'active' => false,
            ),
            "fixed" => array(
                'title' => 'Fixed Columns',
                'icon' => "fal fa-database",
                'url' => "ajax/fixed-columns.html",
                "li_class" => "ripple grey",
                'active' => false,
            ),
            "fixed" => array(
                'title' => 'Fixed Cols w/Scroll',
                'icon' => "fal fa-database",
                'url' => "ajax/prototipos/fixed_cols_scroll_PROTO.php",
                "li_class" => "ripple grey",
                'active' => false,
            ),
            "tester" => array(
                'title' => 'Workers Demo',
                'icon' => "fas fa-chart-bar",
                'url' => "ajax/graphics_tester.php",
                "li_class" => "ripple grey",
                'active' => false,
            ),
            "calend_0" => array(
                'title' => 'Calendário PROTO',
                'icon' => "far fa-calendar",
                'url' => "ajax/modal_calendar.php",
                "li_class" => "ripple grey",
                'active' => false,
            ),  
            "calend_1" => array(
                'title' => 'Calendário',
                'icon' => "far fa-calendar",
                'url' => "ajax/scheduler.php",
                "li_class" => "ripple grey",
                'active' => false,
            ),  
            "flip_card" => array(
                'title' => 'Flip Card', 
                'icon' => "far fa-clock fs_11_em",
                'url' => "ajax/prototipos/flip_card.php",
                "li_class" => "ripple grey",
                'active' => false
            ), 
            "LEO_1" => array(
                'title' => 'LEO #1',
                'icon' => "far fa-calendar",
                'url' => "ajax/prototipos/LEO_formComplexLists.php",
                "li_class" => "ripple grey",
                'active' => false,
            ), 
            "LEO_2" => array(
                'title' => 'LEO #2',
                'icon' => "far fa-calendar",
                'url' => "ajax/prototipos/LEO_formMaster-DTDetail.php",
                "li_class" => "ripple grey",
                'active' => false,
            ), 
            "CAD_OLD" => array(
                'title' => 'Cadastro Old',
                'icon' => "far fa-calendar",
                'url' => "ajax/prototipos/cadastro_w_nav.php",
                "li_class" => "ripple grey",
                'active' => false,
            ),                
        )
    )     
);

?>
