<?php

// configure Bootstrap components UI
\Bootstrap\Component::register('table', 'Bootstrap\Components\Table');
\Bootstrap\Component::register('button', 'Bootstrap\Components\Button');
\Bootstrap\Component::register('nav', 'Bootstrap\Components\Nav');
\Bootstrap\Component::register('pagination', 'Bootstrap\Components\Pagination');

$_ui = new \Bootstrap\Component;

if ($_user) {
    if ($_user->get_current_profile()->TIPO_PERFIL == 'Z' && script_name() == 'home.php') {
        require INCLUDES_PATH."/menus/quad_menu_administrador.php";
    }
    elseif ($_user->get_current_profile()->TIPO_PERFIL == 'E' && script_name() == 'home.php') {
        require INCLUDES_PATH."/menus/quad_menu_gestor.php";
    }
    elseif ($_user->get_current_profile()->TIPO_PERFIL == 'A' && script_name() == 'home.php') {
        require INCLUDES_PATH."/menus/quad_menu_colaborador.php";
    }
    elseif ($_user->get_current_profile()->TIPO_PERFIL == 'B' && script_name() == 'home.php') {
        require INCLUDES_PATH."/menus/quad_menu_gestor_adm.php";
    }
    elseif ($_user->get_current_profile()->TIPO_PERFIL == 'C' && script_name() == 'home.php') {
        require INCLUDES_PATH."/menus/quad_menu_supervisor.php";
    }
    elseif ($_user->get_current_profile()->TIPO_PERFIL == 'D' && script_name() == 'home.php') {
        require INCLUDES_PATH."/menus/quad_menu_diretor.php";
    }
    elseif (script_name() == 'home.php') {
    $_nav = [
            'dashboard' => [
                    'title' => 'Dashboard',   
                    'icon' => 'fal fa-cog',
                    'url' => 'ajax/dashboard.php'
            ],
            'templates' => [
                    'title' => 'Templates',
                    'icon' => 'fal fa-cog',
                    'items' => [
                            'template_1' => [
                                    'title' => 'Panel',
                                    'url' => 'ajax/dg_outputs.php'
                            ],
                            'template_2' => [
                                    'title' => 'Panel > Filter or Master > Tabs [ >  Sub-Tabs)',
                                    'url' => 'ajax/rh_time_template.php'
                            ],
                            'template_3' => [
                                    'title' => 'Panel > Tabs > Sub-Tabs',
                                    'url' => 'ajax/rhid_wkf_template.php'
                            ],
                            'template_4' => [
                                    'title' => 'Template Cadastro',
                                    'url' => 'ajax/rh_cad_template.php'
                            ]
                    ]
            ],
            'panel_forms' => [
                    'title' => 'Panel Forms',
                    'icon' => 'fal fa-info-circle',
                    'items' => [
                            'rhid_daily_allowances' => [
                                    'title' => 'rhid_daily_allowances',
                                    'url' => 'ajax/rhid_daily_allowances.php'
                            ],
                            'dk_results' => [
                                    'title' => 'dk_results',
                                    'url' => 'ajax/dk_results.php'
                            ],
                            'dk_load_values' => [
                                    'title' => 'dk_load_values',
                                    'url' => 'ajax/dk_load_values.php'
                            ],
                            'rhid_bank_transfers' => [
                                    'title' => 'rhid_bank_transfers',
                                    'url' => 'ajax/rhid_bank_transfers.php'
                            ],
                            'rhid_judicial_discounts' => [
                                    'title' => 'rhid_judicial_discounts',
                                    'url' => 'ajax/rhid_judicial_discounts.php'
                            ],
                            'rhid_current_accounts' => [
                                    'title' => 'rhid_current_accounts',
                                    'url' => 'ajax/rhid_current_accounts.php'
                            ],
                            'rhid_expenses' => [
                                    'title' => 'rhid_expenses',
                                    'url' => 'ajax/rhid_expenses.php'
                            ],
                            'rhid_account_settling' => [
                                    'title' => 'rhid_account_settling',
                                    'url' => 'ajax/rhid_account_settling.php'
                            ],
                            'fo_waiting_list' => [
                                    'title' => 'fo_waiting_list',
                                    'url' => 'ajax/fo_waiting_list.php'
                            ],
                            'ad_follow_up' => [
                                    'title' => 'ad_follow_up',
                                    'url' => 'ajax/ad_follow_up.php'
                            ],
                            'dg_units' => [
                                    'title' => 'dg_units',
                                    'url' => 'ajax/dg_units.php'
                            ],
                            'dg_domains' => [
                                    'title' => 'dg_domains',
                                    'url' => 'ajax/dg_domains.php'
                            ],
                            'rh_def_audits' => [
                                    'title' => 'rh_def_audits',
                                    'url' => 'ajax/rh_def_audits.php'
                            ],
                            'dk_profile_manage' => [
                                    'title' => 'dk_profile_manage',
                                    'url' => 'ajax/dk_profile_manage.php'
                            ],
                            'dg_users' => [
                                    'title' => 'dg_users',
                                    'url' => 'ajax/dg_users.php'
                            ],
                            'dg_data_dictionary' => [
                                    'title' => 'dg_data_dictionary',
                                    'url' => 'ajax/dg_data_dictionary.php'
                            ],
                            'rhid_delegations' => [
                                    'title' => 'rhid_delegations',
                                    'url' => 'ajax/rhid_delegations.php'
                            ]
                    ]                    
            ],
            'panel_tabs' => [
                    'title' => 'Panel Tabs',
                    'icon' => 'fal fa-info-circle',
                    'items' => [
                            'rhid_wkf_template' => [
                                    'title' => 'TEMPLATE',
                                    'url' => 'ajax/rhid_wkf_template.php'
                            ],
                            'dg_communications_editor' => [
                                    'title' => 'dg_communications_editor',
                                    'url' => 'ajax/dg_communications_editor.php'
                            ],
                            'dg_daily_allowances' => [
                                    'title' => 'dg_daily_allowances',
                                    'url' => 'ajax/dg_daily_allowances.php'
                            ],
                            'dg_configs' => [
                                    'title' => 'dg_configs',
                                    'url' => 'ajax/dg_configs.php'
                            ],
                            'dg_proficiency_scales' => [
                                    'title' => 'dg_proficiency_scales',
                                    'url' => 'ajax/dg_proficiency_scales.php'
                            ],
                            'fo_training_plans' => [
                                    'title' => 'fo_training_plans',
                                    'url' => 'ajax/fo_training_plans.php'
                            ],
                            'rh_def_official_resources' => [
                                    'title' => 'rh_def_official_resources',
                                    'url' => 'ajax/rh_def_official_resources.php'
                            ],
                            'rh_accounting_interface' => [
                                    'title' => 'rh_accounting_interface',
                                    'url' => 'ajax/rh_accounting_interface.php'
                            ],
                            'rh_contractual_bonds' => [
                                    'title' => 'rh_contractual_bonds',
                                    'url' => 'ajax/rh_contractual_bonds.php'
                            ],
                            'dg_geographies' => [
                                    'title' => 'dg_geographies',
                                    'url' => 'ajax/dg_geographies.php'
                            ],
                            'fo_courses' => [
                                    'title' => 'fo_courses',
                                    'url' => 'ajax/fo_courses.php'
                            ],
                            'fo_training_actions' => [
                                    'title' => 'fo_training_actions',
                                    'url' => 'ajax/fo_training_actions.php'
                            ],
                            'dg_company' => [
                                    'title' => 'dg_company',
                                    'url' => 'ajax/dg_company.php'
                            ],
                            'dg_fiscal_years' => [
                                    'title' => 'dg_fiscal_years',
                                    'url' => 'ajax/dg_fiscal_years.php'
                            ],
                            'dg_outputs_config' => [
                                    'title' => 'dg_outputs_config',
                                    'url' => 'ajax/dg_outputs_config.php'
                            ],
                            'dg_entities' => [
                                    'title' => 'dg_entities',
                                    'url' => 'ajax/dg_entities.php'
                            ],
                            'rh_def_time_management' => [
                                    'title' => 'rh_def_time_management',
                                    'url' => 'ajax/rh_def_time_management.php'
                            ],
                            'rh_def_internal_resources' => [
                                    'title' => 'rh_def_internal_resources',
                                    'url' => 'ajax/rh_def_internal_resources.php'
                            ],
                            'rh_def_payroll_management' => [
                                    'title' => 'rh_def_payroll_management',
                                    'url' => 'ajax/rh_def_payroll_management.php'
                            ],
                            'rh_discount_entities' => [
                                    'title' => 'rh_discount_entities',
                                    'url' => 'ajax/rh_discount_entities.php'
                            ],
                            'timesheet_resources' => [
                                    'title' => 'timesheet_resources',
                                    'url' => 'ajax/timesheet_resources.php'
                            ],
                            'dk_rewards_coef_environment' => [
                                    'title' => 'dk_rewards_coef_environment',
                                    'url' => 'ajax/dk_rewards_coef_environment.php'
                            ],
                            'dk_matrix' => [
                                    'title' => 'dk_matrix',
                                    'url' => 'ajax/dk_matrix.php'
                            ],
                            'gd_resources' => [
                                    'title' => 'gd_resources',
                                    'url' => 'ajax/gd_resources.php'
                            ],
                            'gd_model_definiton' => [
                                    'title' => 'gd_model_definiton',
                                    'url' => 'ajax/gd_model_definiton.php'
                            ],
                            'ge_characteristics' => [
                                    'title' => 'ge_characteristics',
                                    'url' => 'ajax/ge_characteristics.php'
                            ],
                            'ge_skills_behaviors' => [
                                    'title' => 'ge_skills_behaviors',
                                    'url' => 'ajax/ge_skills_behaviors.php'
                            ],
                            'ge_functional_groups' => [
                                    'title' => 'ge_functional_groups',
                                    'url' => 'ajax/ge_functional_groups.php'
                            ],
                            'ge_functions' => [
                                    'title' => 'ge_functions',
                                    'url' => 'ajax/ge_functions.php'
                            ],
                            'ge_individuals' => [
                                    'title' => 'ge_individuals',
                                    'url' => 'ajax/ge_individuals.php'
                            ],
                            'ad_environment' => [
                                    'title' => 'ad_environment',
                                    'url' => 'ajax/ad_environment.php'
                            ],
                            'ad_objectives' => [
                                    'title' => 'ad_objectives',
                                    'url' => 'ajax/ad_objectives.php'
                            ],
                            'ad_teams_shared_objectives' => [
                                    'title' => 'ad_teams_shared_objectives',
                                    'url' => 'ajax/ad_teams_shared_objectives.php'
                            ],
                            'ad_calibration_committees' => [
                                    'title' => 'ad_calibration_committees',
                                    'url' => 'ajax/ad_calibration_committees.php'
                            ],
                            'fo_organization' => [
                                    'title' => 'fo_organization',
                                    'url' => 'ajax/fo_organization.php'
                            ],
                            'fo_situations_reasons' => [
                                    'title' => 'fo_situations_reasons',
                                    'url' => 'ajax/fo_situations_reasons.php'
                            ],
                            'fo_costs_config' => [
                                    'title' => 'fo_costs_config',
                                    'url' => 'ajax/fo_costs_config.php'
                            ],
                            'fo_logistics' => [
                                    'title' => 'fo_logistics',
                                    'url' => 'ajax/fo_logistics.php'
                            ],
                            'dg_modules_profiles' => [
                                    'title' => 'dg_modules_profiles',
                                    'url' => 'ajax/dg_modules_profiles.php'
                            ],
                            'ad_development_plans' => [
                                    'title' => 'ad_development_plans',
                                    'url' => 'ajax/ad_development_plans.php'
                            ],
                            'ad_shared_obj_plans' => [
                                    'title' => 'ad_shared_obj_plans',
                                    'url' => 'ajax/ad_shared_obj_plans.php'
                            ],
                            'ad_frm_employee_evaluation_sheet' => [
                                    'title' => 'ad_frm_employee_evaluation_sheet',
                                    'url' => 'ajax/ad_frm_employee_evaluation_sheet.php'
                            ],
                            'ad_evaluation_plans' => [
                                    'title' => 'ad_evaluation_plans',
                                    'url' => 'ajax/ad_evaluation_plans.php'
                            ],
                            'dk_maintenance_values' => [
                                    'title' => 'dk_maintenance_values',
                                    'url' => 'ajax/dk_maintenance_values.php'
                            ],
                            'gd_renew_contracts' => [
                                    'title' => 'gd_renew_contracts',
                                    'url' => 'ajax/gd_renew_contracts.php'
                            ],
                            'gd_template_auto' => [
                                    'title' => 'gd_template_auto',
                                    'url' => 'ajax/gd_template_auto.php'
                            ],
                            'gd_rhid_document_management' => [
                                    'title' => 'gd_rhid_document_management',
                                    'url' => 'ajax/gd_rhid_document_management.php'
                            ],
                            'rh_cadastro' => [
                                    'title' => 'rh_cadastro',
                                    'url' => 'ajax/rh_cadastro.php'
                            ],
                            'rh_time_management' => [
                                    'title' => 'rh_time_management',
                                    'url' => 'ajax/rh_time_management.php'
                            ]                        
                ]
            ],
            'test_cases' => [
                    'title' => 'Test Cases',
                    'icon' => 'fal fa-info-circle',
                    'items' => [
                            'testcase_0' => [
                                    'title' => 'Test CASE 0',
                                    'url' => 'ajax/test_case_inside.php'
                            ],
                            'testcase_1' => [
                                    'title' => 'Test CASE 1 - QuadTables',
                                    'url' => 'ajax/test_case_1.php'
                            ],
                            'testcase_2' => [
                                    'title' => 'Test CASE 2 - QuadForms',
                                    'url' => 'ajax/test_case_2.php'
                            ],
                            'testcase_3' => [
                                    'title' => 'Test CASE 3 - QuadTables w Tabs',
                                    'url' => 'ajax/test_case_3.php'
                            ],
                            'test_form_plugins' => [
                                    'title' => 'Test Forms Plugins',
                                    'icon' => 'fal fa-cog',
                                    'url' => 'ajax/test_form_plugins.php'
                            ]
                    ]
            ],
            'demo' => [
                    'title' => 'DEMOSTRAÇÃO',   
                    'icon' => 'fal fa-cog',
                    'url_target' => "_blank",
                    'url' => APP_URL.'/demo/intel_analytics_dashboard.php'
            ]
   ];

}
} 
else {
    $_nav = [
            'home' => [
                    'title' => 'QUAD-HCM HOME',
                    'icon' => 'fal fa-cog',
                    'url' => APP_URL.'/../home.php'
            ],
            'notas_pte' => [
                    'title' => 'Notas PTE',
                    'icon' => 'fal fa-cog',
                    'url' => APP_URL.'/docs_pte_notes.php'
            ],
            'blank' => [
                    'title' => 'Notas Ambiente PHP',
                    'icon' => 'fal fa-cog',
                    'url' => APP_URL.'/blank.php'
            ],
            'testcase_1' => [
                    'title' => 'Test CASE 1 - QuadTables',
                    'icon' => 'fal fa-cog',
                    'url' => APP_URL.'/test_case_1.php'
            ],
            'testcase_2' => [
                    'title' => 'Test CASE 2 - QuadForms',
                    'icon' => 'fal fa-cog',
                    'url' => APP_URL.'/test_case_2.php'
            ],
            'testcase_3' => [
                    'title' => 'Test CASE 3 - QuadTables w Tabs',
                    'icon' => 'fal fa-cog',
                    'url' => APP_URL.'/test_case_3.php'
            ],
            'application_intel' => [
                    'title' => 'Application Intel',
                    'icon' => 'fal fa-info-circle',
                    'items' => [
                            'intel_analytics_dashboard' => [
                                    'title' => 'Analytics Dashboard',
                                    'url' => APP_URL.'/demo/intel_analytics_dashboard.php'
                            ],
                            'intel_marketing_dashboard' => [
                                    'title' => 'Marketing Dashboard',
                                    'url' => APP_URL.'/demo/intel_marketing_dashboard.php'
                            ],
                            'intel_introduction' => [
                                    'title' => 'Introduction',
                                    'url' => APP_URL.'/demo/intel_introduction.php'
                            ],
                            'intel_privacy' => [
                                    'title' => 'Privacy',
                                    'url' => APP_URL.'/demo/intel_privacy.php'
                            ]
                    ]
            ],
            'theme_settings' => [
                    'title' => 'Theme Settings',
                    'icon' => 'fal fa-cog',
                    'items' => [
                            'settings_how_it_works' => [
                                    'title' => 'How it works',
                                    'url' => APP_URL.'/demo/settings_how_it_works.php'
                            ],
                            'settings_layout_options' => [
                                    'title' => 'Layout Options',
                                    'url' => APP_URL.'/demo/settings_layout_options.php'
                            ],
                            'settings_skin_options' => [
                                    'title' => 'Skin Options',
                                    'url' => APP_URL.'/demo/settings_skin_options.php'
                            ],
                            'settings_saving_db' => [
                                    'title' => 'Saving to Database',
                                    'url' => APP_URL.'/demo/settings_saving_db.php'
                            ]
                    ]
            ],
            'documentation' => [
                    'title' => 'Documentation',
                    'icon' => 'fal fa-book',
                    'items' => [
                            'docs_general' => [
                                    'title' => 'General Docs',
                                    'url' => APP_URL.'/demo/docs_general.php'
                            ],
                            'docs_flavors_editions' => [
                                    'title' => 'Flavors & Editions',
                                    'url' => APP_URL.'/demo/docs_flavors_editions.php'
                            ],
                            'docs_community_support' => [
                                    'title' => 'Community Support',
                                    'url' => APP_URL.'/demo/docs_community_support.php'
                            ],
                            'docs_premium_support' => [
                                    'title' => 'Premium Support',
                                    'url' => APP_URL.'/demo/docs_premium_support.php'
                            ],
                            'docs_licensing' => [
                                    'title' => 'Licensing',
                                    'url' => APP_URL.'/demo/docs_licensing.php'
                            ],
                            'docs_buildnotes' => [
                                    'title' => 'Build Notes',
                                    'url' => APP_URL.'/demo/docs_buildnotes.php',
                                    'span' => [
                                            'text' => 'v4.4.5'
                                    ]
                            ]
                    ]
            ],
            [
                    'title' => 'PHP Features',
                    'group' => true,
            ],
            'components' => [
                    'title' => 'Components',
                    'icon' => 'fal fa-wrench',
                    'items' => [
                            'php_utils' => [
                                    'title' => 'Utilities',
                                    'url' => APP_URL.'/demo/php_utils.php'
                            ],
                            'php_navigation' => [
                                    'title' => 'Navigation',
                                    'url' => APP_URL.'/demo/php_navigation.php'
                            ],
                            'php_tables' => [
                                    'title' => 'Tables',
                                    'url' => APP_URL.'/demo/php_tables.php'
                            ],
                            'php_panels' => [
                                    'title' => 'Panels',
                                    'url' => APP_URL.'/demo/php_panels.php'
                            ]
                    ]
            ],
            'authentication' => [
                    'title' => 'Authentication',
                    'icon' => 'fal fa-lock',
                    'items' => [
                            'php_auth_docs' => [
                                    'title' => 'Documentation',
                                    'url' => APP_URL.'/demo/php_auth_docs.php'
                            ],
                            'php_auth_page' => [
                                    'title' => 'Authenticate Page',
                                    'url' => APP_URL.'/demo/php_auth_page.php'
                            ],
                            'php_auth_login' => [
                                    'title' => 'Login',
                                    'url' => APP_URL.'/demo/php_auth_login.php'
                            ],
                            'php_auth_logout' => [
                                    'title' => 'Logout',
                                    'url' => APP_URL.'/demo/php_auth_logout.php'
                            ]
                    ]
            ],
            'rest_api' => [
                    'title' => 'REST API',
                    'icon' => 'fal fa-cloud',
                    'items' => [
                            'php_api_docs' => [
                                    'title' => 'Documentation',
                                    'url' => APP_URL.'/demo/php_api_docs.php'
                            ],
                            'php_api_playground' => [
                                    'title' => 'Playground',
                                    'url' => APP_URL.'/demo/php_api_playground.php'
                            ]
                    ]
            ],
            'database' => [
                    'title' => 'Database',
                    'icon' => 'fal fa-database',
                    'items' => [
                            'php_db_intro' => [
                                    'title' => 'Introduction',
                                    'url' => APP_URL.'/demo/php_db_intro.php'
                            ],
                            'php_db_users' => [
                                    'title' => 'Users',
                                    'url' => APP_URL.'/demo/php_db_users.php'
                            ]
                    ]
            ],
            [
                    'title' => 'Tools & Components',
                    'group' => true,
            ],
            'ui_components' => [
                    'title' => 'UI Components',
                    'icon' => 'fal fa-window',
                    'items' => [
                            'ui_alerts' => [
                                    'title' => 'Alerts',
                                    'url' => APP_URL.'/demo/ui_alerts.php'
                            ],
                            'ui_accordion' => [
                                    'title' => 'Accordions',
                                    'url' => APP_URL.'/demo/ui_accordion.php'
                            ],
                            'ui_badges' => [
                                    'title' => 'Badges',
                                    'url' => APP_URL.'/demo/ui_badges.php'
                            ],
                            'ui_breadcrumbs' => [
                                    'title' => 'Breadcrumbs',
                                    'url' => APP_URL.'/demo/ui_breadcrumbs.php'
                            ],
                            'ui_buttons' => [
                                    'title' => 'Buttons',
                                    'url' => APP_URL.'/demo/ui_buttons.php'
                            ],
                            'ui_button_group' => [
                                    'title' => 'Button Group',
                                    'url' => APP_URL.'/demo/ui_button_group.php'
                            ],
                            'ui_cards' => [
                                    'title' => 'Cards',
                                    'url' => APP_URL.'/demo/ui_cards.php'
                            ],
                            'ui_carousel' => [
                                    'title' => 'Carousel',
                                    'url' => APP_URL.'/demo/ui_carousel.php'
                            ],
                            'ui_collapse' => [
                                    'title' => 'Collapse',
                                    'url' => APP_URL.'/demo/ui_collapse.php'
                            ],
                            'ui_dropdowns' => [
                                    'title' => 'Dropdowns',
                                    'url' => APP_URL.'/demo/ui_dropdowns.php'
                            ],
                            'ui_list_filter' => [
                                    'title' => 'List Filter',
                                    'url' => APP_URL.'/demo/ui_list_filter.php'
                            ],
                            'ui_modal' => [
                                    'title' => 'Modal',
                                    'url' => APP_URL.'/demo/ui_modal.php'
                            ],
                            'ui_navbars' => [
                                    'title' => 'Navbars',
                                    'url' => APP_URL.'/demo/ui_navbars.php'
                            ],
                            'ui_panels' => [
                                    'title' => 'Panels',
                                    'url' => APP_URL.'/demo/ui_panels.php'
                            ],
                            'ui_pagination' => [
                                    'title' => 'Pagination',
                                    'url' => APP_URL.'/demo/ui_pagination.php'
                            ],
                            'ui_popovers' => [
                                    'title' => 'Popovers',
                                    'url' => APP_URL.'/demo/ui_popovers.php'
                            ],
                            'ui_progress_bars' => [
                                    'title' => 'Progress Bars',
                                    'url' => APP_URL.'/demo/ui_progress_bars.php'
                            ],
                            'ui_scrollspy' => [
                                    'title' => 'ScrollSpy',
                                    'url' => APP_URL.'/demo/ui_scrollspy.php'
                            ],
                            'ui_side_panel' => [
                                    'title' => 'Side Panel',
                                    'url' => APP_URL.'/demo/ui_side_panel.php'
                            ],
                            'ui_spinners' => [
                                    'title' => 'Spinners',
                                    'url' => APP_URL.'/demo/ui_spinners.php'
                            ],
                            'ui_tabs_pills' => [
                                    'title' => 'Tabs & Pills',
                                    'url' => APP_URL.'/demo/ui_tabs_pills.php'
                            ],
                            'ui_toasts' => [
                                    'title' => 'Toasts',
                                    'url' => APP_URL.'/demo/ui_toasts.php'
                            ],
                            'ui_tooltips' => [
                                    'title' => 'Tooltips',
                                    'url' => APP_URL.'/demo/ui_tooltips.php'
                            ]
                    ]
            ],
            'utilities' => [
                    'title' => 'Utilities',
                    'icon' => 'fal fa-bolt',
                    'items' => [
                            'utilities_borders' => [
                                    'title' => 'Borders',
                                    'url' => APP_URL.'/demo/utilities_borders.php'
                            ],
                            'utilities_clearfix' => [
                                    'title' => 'Clearfix',
                                    'url' => APP_URL.'/demo/utilities_clearfix.php'
                            ],
                            'utilities_color_pallet' => [
                                    'title' => 'Color Pallet',
                                    'url' => APP_URL.'/demo/utilities_color_pallet.php'
                            ],
                            'utilities_display_property' => [
                                    'title' => 'Display Property',
                                    'url' => APP_URL.'/demo/utilities_display_property.php'
                            ],
                            'utilities_fonts' => [
                                    'title' => 'Fonts',
                                    'url' => APP_URL.'/demo/utilities_fonts.php'
                            ],
                            'utilities_flexbox' => [
                                    'title' => 'Flexbox',
                                    'url' => APP_URL.'/demo/utilities_flexbox.php'
                            ],
                            'utilities_helpers' => [
                                    'title' => 'Helpers',
                                    'url' => APP_URL.'/demo/utilities_helpers.php'
                            ],
                            'utilities_position' => [
                                    'title' => 'Position',
                                    'url' => APP_URL.'/demo/utilities_position.php'
                            ],
                            'utilities_responsive_grid' => [
                                    'title' => 'Responsive Grid',
                                    'url' => APP_URL.'/demo/utilities_responsive_grid.php'
                            ],
                            'utilities_sizing' => [
                                    'title' => 'Sizing',
                                    'url' => APP_URL.'/demo/utilities_sizing.php'
                            ],
                            'utilities_spacing' => [
                                    'title' => 'Spacing',
                                    'url' => APP_URL.'/demo/utilities_spacing.php'
                            ],
                            'utilities_typography' => [
                                    'title' => 'Typography',
                                    'tags' => 'fonts headings bold lead colors sizes link text states list styles truncate alignment',
                                    'url' => APP_URL.'/demo/utilities_typography.php'
                            ],
                            'menu_child' => [
                                    'title' => 'Menu child',
                                    'items' => [
                                            'sublevel_item' => [
                                                    'title' => 'Sublevel Item',

                                            ],
                                            'another_item' => [
                                                    'title' => 'Another Item',

                                            ]
                                    ]
                            ],
                            'disabled_item' => [
                                    'title' => 'Disabled item',

                            ]
                    ]
            ],
            'font_icons' => [
                    'title' => 'Font Icons',
                    'icon' => 'fal fa-map-marker-alt',
                    'span' => [
                            'class' => 'dl-ref bg-primary-500 hidden-nav-function-minify hidden-nav-function-top',
                            'text' => '7,500+'
                    ],
                    'items' => [
                            'fontawesome' => [
                                    'title' => 'FontAwesome',
                                    'items' => [
                                            'icons_fontawesome_light' => [
                                                    'title' => 'Light',
                                                    'url' => APP_URL.'/demo/icons_fontawesome_light.php'
                                            ],
                                            'icons_fontawesome_regular' => [
                                                    'title' => 'Regular',
                                                    'url' => APP_URL.'/demo/icons_fontawesome_regular.php'
                                            ],
                                            'icons_fontawesome_solid' => [
                                                    'title' => 'Solid',
                                                    'url' => APP_URL.'/demo/icons_fontawesome_solid.php'
                                            ],
                                            'icons_fontawesome_duotone' => [
                                                    'title' => 'Duotone',
                                                    'url' => APP_URL.'/demo/icons_fontawesome_duotone.php'
                                            ],
                                            'icons_fontawesome_brand' => [
                                                    'title' => 'Brand',
                                                    'url' => APP_URL.'/demo/icons_fontawesome_brand.php'
                                            ]
                                    ]
                            ],
                            'nextgen_icons' => [
                                    'title' => 'NextGen Icons',
                                    'items' => [
                                            'icons_nextgen_general' => [
                                                    'title' => 'General',
                                                    'url' => APP_URL.'/demo/icons_nextgen_general.php'
                                            ],
                                            'icons_nextgen_base' => [
                                                    'title' => 'Base',
                                                    'url' => APP_URL.'/demo/icons_nextgen_base.php'
                                            ]
                                    ]
                            ],
                            'stack_icons' => [
                                    'title' => 'Stack Icons',
                                    'items' => [
                                            'icons_stack_showcase' => [
                                                    'title' => 'Showcase',
                                                    'url' => APP_URL.'/demo/icons_stack_showcase.php'
                                            ],
                                            'icons_stack_generate' => [
                                                    'title' => 'Generate Stack',
                                                    'url' => APP_URL.'/demo/icons_stack_generate.php?layers=3'
                                            ]
                                    ]
                            ]
                    ]
            ],
            'tables' => [
                    'title' => 'Tables',
                    'icon' => 'fal fa-th-list',
                    'items' => [
                            'tables_basic' => [
                                    'title' => 'Basic Tables',
                                    'url' => APP_URL.'/demo/tables_basic.php'
                            ],
                            'tables_generate_style' => [
                                    'title' => 'Generate Table Style',
                                    'url' => APP_URL.'/demo/tables_generate_style.php'
                            ]
                    ]
            ],
            'form_stuff' => [
                    'title' => 'Form Stuff',
                    'icon' => 'fal fa-edit',
                    'items' => [
                            'form_basic_inputs' => [
                                    'title' => 'Basic Inputs',
                                    'url' => APP_URL.'/demo/form_basic_inputs.php'
                            ],
                            'form_checkbox_radio' => [
                                    'title' => 'Checkbox & Radio',
                                    'url' => APP_URL.'/demo/form_checkbox_radio.php'
                            ],
                            'form_input_groups' => [
                                    'title' => 'Input Groups',
                                    'url' => APP_URL.'/demo/form_input_groups.php'
                            ],
                            'form_validation' => [
                                    'title' => 'Validation',
                                    'url' => APP_URL.'/demo/form_validation.php'
                            ]
                    ]
            ],
            [
                    'title' => 'Plugins & Addons',
                    'group' => true,
            ],
            'plugins' => [
                    'title' => 'Plugins',
                    'icon' => 'fal fa-shield-alt',
                    'items' => [
                            'plugin_faq' => [
                                    'title' => 'Plugins FAQ',
                                    'url' => APP_URL.'/demo/plugins_faq.php'
                            ],
                            'plugin_waves' => [
                                    'title' => 'Waves',
                                    'url' => APP_URL.'/demo/plugins_waves.php',
                                    'span' => [
                                            'class' => 'dl-ref label bg-primary-400 ml-2',
                                            'text' => '9 KB'
                                    ]
                            ],
                            'plugin_pacejs' => [
                                    'title' => 'PaceJS',
                                    'url' => APP_URL.'/demo/plugins_pacejs.php',
                                    'span' => [
                                            'class' => 'dl-ref label bg-primary-500 ml-2',
                                            'text' => '13 KB'
                                    ]
                            ],
                            'plugin_smartpanels' => [
                                    'title' => 'SmartPanels',
                                    'url' => APP_URL.'/demo/plugins_smartpanels.php',
                                    'span' => [
                                            'class' => 'dl-ref label bg-primary-600 ml-2',
                                            'text' => '9 KB'
                                    ]
                            ],
                            'plugin_bootbox' => [
                                    'title' => 'BootBox',
                                    'tags' => 'alert sound',
                                    'url' => APP_URL.'/demo/plugins_bootbox.php',
                                    'span' => [
                                            'class' => 'dl-ref label bg-primary-600 ml-2',
                                            'text' => '15 KB'
                                    ]
                            ],
                            'plugin_slimscroll' => [
                                    'title' => 'Slimscroll',
                                    'url' => APP_URL.'/demo/plugins_slimscroll.php',
                                    'span' => [
                                            'class' => 'dl-ref label bg-primary-700 ml-2',
                                            'text' => '5 KB'
                                    ]
                            ],
                            'plugin_throttle' => [
                                    'title' => 'Throttle',
                                    'url' => APP_URL.'/demo/plugins_throttle.php',
                                    'span' => [
                                            'class' => 'dl-ref label bg-primary-700 ml-2',
                                            'text' => '1 KB'
                                    ]
                            ],
                            'plugin_navigation' => [
                                    'title' => 'Navigation',
                                    'url' => APP_URL.'/demo/plugins_navigation.php',
                                    'span' => [
                                            'class' => 'dl-ref label bg-primary-700 ml-2',
                                            'text' => '2 KB'
                                    ]
                            ],
                            'plugin_i18next' => [
                                    'title' => 'i18next',
                                    'url' => APP_URL.'/demo/plugins_i18next.php',
                                    'span' => [
                                            'class' => 'dl-ref label bg-primary-700 ml-2',
                                            'text' => '10 KB'
                                    ]
                            ],
                            'plugin_appcore' => [
                                    'title' => 'App.Core',
                                    'url' => APP_URL.'/demo/plugins_appcore.php',
                                    'span' => [
                                            'class' => 'dl-ref label bg-success-700 ml-2',
                                            'text' => '14 KB'
                                    ]
                            ]
                    ]
            ],
            'datatables' => [
                    'title' => 'Datatables',
                    'icon' => 'fal fa-table',
                    'tags' => 'datagrid',
                    'span' => [
                            'class' => 'dl-ref bg-primary-500 hidden-nav-function-minify hidden-nav-function-top',
                            'text' => '235 KB'
                    ],
                    'items' => [
                            'datatables_basic' => [
                                    'title' => 'Basic',
                                    'url' => APP_URL.'/demo/datatables_basic.php'
                            ],
                            'datatables_autofill' => [
                                    'title' => 'Autofill',
                                    'url' => APP_URL.'/demo/datatables_autofill.php'
                            ],
                            'datatables_buttons' => [
                                    'title' => 'Buttons',
                                    'url' => APP_URL.'/demo/datatables_buttons.php'
                            ],
                            'datatables_export' => [
                                    'title' => 'Export',
                                    'tags' => 'tables pdf excel print csv',
                                    'url' => APP_URL.'/demo/datatables_export.php'
                            ],
                            'datatables_colreorder' => [
                                    'title' => 'ColReorder',
                                    'url' => APP_URL.'/demo/datatables_colreorder.php'
                            ],
                            'datatables_columnfilter' => [
                                    'title' => 'ColumnFilter',
                                    'url' => APP_URL.'/demo/datatables_columnfilter.php'
                            ],
                            'datatables_fixedcolumns' => [
                                    'title' => 'FixedColumns',
                                    'url' => APP_URL.'/demo/datatables_fixedcolumns.php'
                            ],
                            'datatables_fixedheader' => [
                                    'title' => 'FixedHeader',
                                    'url' => APP_URL.'/demo/datatables_fixedheader.php'
                            ],
                            'datatables_keytable' => [
                                    'title' => 'KeyTable',
                                    'url' => APP_URL.'/demo/datatables_keytable.php'
                            ],
                            'datatables_responsive' => [
                                    'title' => 'Responsive',
                                    'url' => APP_URL.'/demo/datatables_responsive.php'
                            ],
                            'datatables_responsive_alt' => [
                                    'title' => 'Responsive Alt',
                                    'url' => APP_URL.'/demo/datatables_responsive_alt.php'
                            ],
                            'datatables_rowgroup' => [
                                    'title' => 'RowGroup',
                                    'url' => APP_URL.'/demo/datatables_rowgroup.php'
                            ],
                            'datatables_rowreorder' => [
                                    'title' => 'RowReorder',
                                    'url' => APP_URL.'/demo/datatables_rowreorder.php'
                            ],
                            'datatables_scroller' => [
                                    'title' => 'Scroller',
                                    'url' => APP_URL.'/demo/datatables_scroller.php'
                            ],
                            'datatables_select' => [
                                    'title' => 'Select',
                                    'url' => APP_URL.'/demo/datatables_select.php'
                            ],
                            'datatables_alteditor' => [
                                    'title' => 'AltEditor',
                                    'url' => APP_URL.'/demo/datatables_alteditor.php'
                            ]
                    ]
            ],
            'statistics' => [
                    'title' => 'Statistics',
                    'icon' => 'fal fa-chart-pie',
                    'tags' => 'chart, graphs',
                    'items' => [
                            'statistics_flot' => [
                                    'title' => 'Flot',
                                    'tags' => 'bar pie',
                                    'url' => APP_URL.'/demo/statistics_flot.php',
                                    'span' => [
                                            'class' => 'dl-ref label bg-primary-500 ml-2',
                                            'text' => '36 KB'
                                    ]
                            ],
                            'statistics_chartjs' => [
                                    'title' => 'Chart.js',
                                    'tags' => 'bar pie',
                                    'url' => APP_URL.'/demo/statistics_chartjs.php',
                                    'span' => [
                                            'class' => 'dl-ref label bg-primary-500 ml-2',
                                            'text' => '205 KB'
                                    ]
                            ],
                            'statistics_chartist' => [
                                    'title' => 'Chartist.js',
                                    'url' => APP_URL.'/demo/statistics_chartist.php',
                                    'span' => [
                                            'class' => 'dl-ref label bg-primary-600 ml-2',
                                            'text' => '39 KB'
                                    ]
                            ],
                            'statistics_c3' => [
                                    'title' => 'C3 Charts',
                                    'url' => APP_URL.'/demo/statistics_c3.php',
                                    'span' => [
                                            'class' => 'dl-ref label bg-primary-600 ml-2',
                                            'text' => '197 KB'
                                    ]
                            ],
                            'statistics_peity' => [
                                    'title' => 'Peity',
                                    'tags' => 'small',
                                    'url' => APP_URL.'/demo/statistics_peity.php',
                                    'span' => [
                                            'class' => 'dl-ref label bg-primary-700 ml-2',
                                            'text' => '4 KB'
                                    ]
                            ],
                            'statistics_sparkline' => [
                                    'title' => 'Sparkline',
                                    'tags' => 'small tiny',
                                    'url' => APP_URL.'/demo/statistics_sparkline.php',
                                    'span' => [
                                            'class' => 'dl-ref label bg-primary-700 ml-2',
                                            'text' => '42 KB'
                                    ]
                            ],
                            'statistics_easypiechart' => [
                                    'title' => 'Easy Pie Chart',
                                    'url' => APP_URL.'/demo/statistics_easypiechart.php',
                                    'span' => [
                                            'class' => 'dl-ref label bg-primary-700 ml-2',
                                            'text' => '4 KB'
                                    ]
                            ],
                            'statistics_dygraph' => [
                                    'title' => 'Dygraph',
                                    'tags' => 'complex',
                                    'url' => APP_URL.'/demo/statistics_dygraph.php',
                                    'span' => [
                                            'class' => 'dl-ref label bg-primary-700 ml-2',
                                            'text' => '120 KB'
                                    ]
                            ]
                    ]
            ],
            'notifications' => [
                    'title' => 'Notifications',
                    'icon' => 'fal fa-exclamation-circle',
                    'items' => [
                            'notifications_sweetalert2' => [
                                    'title' => 'SweetAlert2',
                                    'url' => APP_URL.'/demo/notifications_sweetalert2.php',
                                    'span' => [
                                            'class' => 'dl-ref label bg-primary-500 ml-2',
                                            'text' => '40 KB'
                                    ]
                            ],
                            'notifications_toastr' => [
                                    'title' => 'Toastr',
                                    'url' => APP_URL.'/demo/notifications_toastr.php',
                                    'span' => [
                                            'class' => 'dl-ref label bg-primary-600 ml-2',
                                            'text' => '5 KB'
                                    ]
                            ]
                    ]
            ],
            'form_plugins' => [
                    'title' => 'Form Plugins',
                    'icon' => 'fal fa-credit-card-front',
                    'items' => [
                            'form_plugins_colorpicker' => [
                                    'title' => 'Color Picker',
                                    'url' => APP_URL.'/demo/form_plugins_colorpicker.php'
                            ],
                            'form_plugins_datepicker' => [
                                    'title' => 'Date Picker',
                                    'url' => APP_URL.'/demo/form_plugins_datepicker.php'
                            ],
                            'form_plugins_daterange_picker' => [
                                    'title' => 'Date Range Picker',
                                    'url' => APP_URL.'/demo/form_plugins_daterange_picker.php'
                            ],
                            'form_plugins_dropzone' => [
                                    'title' => 'Dropzone',
                                    'url' => APP_URL.'/demo/form_plugins_dropzone.php'
                            ],
                            'form_plugins_ionrangeslider' => [
                                    'title' => 'Ion.RangeSlider',
                                    'url' => APP_URL.'/demo/form_plugins_ionrangeslider.php'
                            ],
                            'form_plugins_inputmask' => [
                                    'title' => 'Inputmask',
                                    'url' => APP_URL.'/demo/form_plugins_inputmask.php'
                            ],
                            'form_plugin_imagecropper' => [
                                    'title' => 'Image Cropper',
                                    'url' => APP_URL.'/demo/form_plugin_imagecropper.php'
                            ],
                            'form_plugin_select2' => [
                                    'title' => 'Select2',
                                    'url' => APP_URL.'/demo/form_plugin_select2.php'
                            ],
                            'form_plugin_summernote' => [
                                    'title' => 'Summernote',
                                    'tags' => 'texteditor editor',
                                    'url' => APP_URL.'/demo/form_plugin_summernote.php'
                            ]
                    ]
            ],
            'miscellaneous' => [
                    'title' => 'Miscellaneous',
                    'icon' => 'fal fa-globe',
                    'items' => [
                            'miscellaneous_fullcalendar' => [
                                    'title' => 'FullCalendar',
                                    'url' => APP_URL.'/demo/miscellaneous_fullcalendar.php'
                            ],
                            'miscellaneous_lightgallery' => [
                                    'title' => 'Light Gallery',
                                    'url' => APP_URL.'/demo/miscellaneous_lightgallery.php',
                                    'span' => [
                                            'class' => 'dl-ref label bg-primary-500 ml-2',
                                            'text' => '61 KB'
                                    ]
                            ],
                            'miscellaneous_treeview' => [
                                    'title' => 'Tree View',
                                    'url' => APP_URL.'/demo/miscellaneous_treeview',
                                    'span' => [
                                            'class' => 'dl-ref label bg-primary-500 ml-2',
                                            'text' => '61 KB'
                                    ]
                            ]
                        
                    ]
            ],
            [
                    'title' => 'Layouts & Apps',
                    'group' => true,
            ],
            'pages' => [
                    'title' => 'Pages',
                    'icon' => 'fal fa-plus-circle',
                    'items' => [
                            'page_chat' => [
                                    'title' => 'Chat',
                                    'url' => APP_URL.'/demo/page_chat.php'
                            ],
                            'page_contacts' => [
                                    'title' => 'Contacts',
                                    'url' => APP_URL.'/demo/page_contacts.php'
                            ],
                            'forum' => [
                                    'title' => 'Forum',
                                    'items' => [
                                            'page_forum_list' => [
                                                    'title' => 'List',
                                                    'url' => APP_URL.'/demo/page_forum_list.php'
                                            ],
                                            'page_forum_threads' => [
                                                    'title' => 'Threads',
                                                    'url' => APP_URL.'/demo/page_forum_threads.php'
                                            ],
                                            'page_forum_discussion' => [
                                                    'title' => 'Discussion',
                                                    'url' => APP_URL.'/demo/page_forum_discussion.php'
                                            ]
                                    ]
                            ],
                            'inbox' => [
                                    'title' => 'Inbox',
                                    'items' => [
                                            'page_inbox_general' => [
                                                    'title' => 'General',
                                                    'url' => APP_URL.'/demo/page_inbox_general.php'
                                            ],
                                            'page_inbox_read' => [
                                                    'title' => 'Read',
                                                    'url' => APP_URL.'/demo/page_inbox_read.php'
                                            ],
                                            'page_inbox_write' => [
                                                    'title' => 'Write',
                                                    'url' => APP_URL.'/demo/page_inbox_write.php'
                                            ]
                                    ]
                            ],
                            'page_invoice' => [
                                    'title' => 'Invoice (printable)',
                                    'url' => APP_URL.'/demo/page_invoice.php'
                            ],
                            'authentication' => [
                                    'title' => 'Authentication',
                                    'items' => [
                                            'page_forget' => [
                                                    'title' => 'Forget Password',
                                                    'url' => APP_URL.'/demo/page_forget.php'
                                            ],
                                            'page_locked' => [
                                                    'title' => 'Locked Screen',
                                                    'url' => APP_URL.'/demo/page_locked.php'
                                            ],
                                            'page_login' => [
                                                    'title' => 'Login',
                                                    'url' => APP_URL.'/demo/page_login.php'
                                            ],
                                            'page_login_alt' => [
                                                    'title' => 'Login Alt',
                                                    'url' => APP_URL.'/demo/page_login_alt.php'
                                            ],
                                            'page_register' => [
                                                    'title' => 'Register',
                                                    'url' => APP_URL.'/demo/page_register.php'
                                            ],
                                            'page_confirmation' => [
                                                    'title' => 'Confirmation',
                                                    'url' => APP_URL.'/demo/page_confirmation.php'
                                            ]
                                    ]
                            ],
                            'error_pages' => [
                                    'title' => 'Error Pages',
                                    'items' => [
                                            'page_error' => [
                                                    'title' => 'General Error',
                                                    'url' => APP_URL.'/demo/page_error.php'
                                            ],
                                            'page_error_404' => [
                                                    'title' => 'Server Error',
                                                    'url' => APP_URL.'/demo/page_error_404.php'
                                            ],
                                            'page_error_announced' => [
                                                    'title' => 'Announced Error',
                                                    'url' => APP_URL.'/demo/page_error_announced.php'
                                            ]
                                    ]
                            ],
                            'page_profile' => [
                                    'title' => 'Profile',
                                    'url' => APP_URL.'/demo/page_profile.php'
                            ],
                            'page_search' => [
                                    'title' => 'Search Results',
                                    'url' => APP_URL.'/demo/page_search.php'
                            ]
                    ]
            ]
    ];
}