<?php
    require_once '../init.php';
?>
<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-end">
                <div class="panel-toolbar pr-3 align-self-end tabs__">
                    <ul id="demo_panel-tabs" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#Tab1" role="tab" aria-selected="true"><?php echo $ui_situations; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab2" role="tab" aria-selected="true"><?php echo $ui_professional_internal_categories; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab3" role="tab" aria-selected="true"><?php echo $ui_internal_functions; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab4" role="tab" aria-selected="true"><?php echo $ui_groups; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab5" role="tab" aria-selected="true"><?php echo $ui_levels; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab6" role="tab" aria-selected="true"><?php echo $ui_jobs; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab7" role="tab" aria-selected="true"><?php echo $ui_documents; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab8" role="tab" aria-selected="true"><?php echo $ui_professional_qualifications; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab9" role="tab" aria-selected="true"><?php echo $ui_flexfields; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab10" role="tab" aria-selected="true"><?php echo $ui_curriculum; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab_11" role="tab" aria-selected="true"><?php echo $ui_time_contexts; ?></a>
                        </li>
                    </ul>
                </div>
            </div>   
            
            <div class="panel-container show">
                <div class="panel-content">
                    
                    <div class="tab-content">

                         <!-- TAB #1 -->
                        <div class="tab-pane fade active show" id="Tab1" role="tabpanel">

                            <a id="RH_DEF_SITUACOES_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="RH_DEF_SITUACOES" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            
                            <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-start">
                                <div class="panel-toolbar pr-3 align-self-end">
                                    <ul id="panel-tab-1-1" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#Tab11" role="tab" aria-selected="true"><?php echo $ui_details; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Tab12" role="tab" aria-selected="true"><?php echo $ui_next_valid_situations; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Tab13" role="tab" aria-selected="true"><?php echo $ui_outputs; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Tab14" role="tab" aria-selected="true"><?php echo $ui_translate; ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-container show boxSubTab">
                                <div class="panel-content">
                                    <div class="tab-content">
                                        <div class="tab-pane fade active show" id="Tab11" role="tabpanel">
                                            <form action="" id="RH_DEF_SITUACOES_CONTINUED" class="form-horizontal-standard" novalidate="novalidate">

                                                <div class="quad-alert"></div>
                                                <form-toolbar></form-toolbar>
<div class="form-row">
    <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-3">
        <label for="DSP_NEXT_SITUACAO"><?php echo $ui_next_situation; ?></label>
        <select name="DSP_SITUACAO_NEXT" class="form-control complexList chosen"
                data-db-name="CD_SITUACAO" data-def=""
                dependent-group="SITUACOES" dependent-level="1" >
        </select>
    </div>
    <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-3">
        <div class="onoffswitch-container vertical">
            <span class="onoffswitch-title required"><?php echo $ui_next_situation_dt_reset; ?></span> 
            <span class="onoffswitch">
                <input type="checkbox" class="onoffswitch-checkbox" id="RESET_NEXT_DT_SIT" name="RESET_NEXT_DT_SIT" style="opacity: 1;" readonly="readonly" disabled="disabled">
                <label class="onoffswitch-label" for="RESET_NEXT_DT_SIT"> 
                    <span class="onoffswitch-inner" data-swchon-text="SIM" data-swchoff-text="NÃO"></span>
                    <span class="onoffswitch-switch"></span>
                </label> 
            </span>
        </div>
    </div>
</div>
<!-- Disponibilidade da Situação -->
<div class="form-row">
    <div class="col-sm-12">
        <fieldset class="first-line"> 
            <header class="frmInnerHeader"><?php echo $ui_situation_availability_on_modules; ?></header>
            <div class="form-row">                
                <div class="form-group col-sm-6 col-xl-2">
                    <div class="onoffswitch-container vertical">
                        <span class="onoffswitch-title required"><?php echo $ui_calculation_critical_output_inhibition; ?></span> 
                        <span class="onoffswitch">
                            <input type="checkbox" class="onoffswitch-checkbox" id="INIBE_CALC_OUTPUT_CRIT" name="INIBE_CALC_OUTPUT_CRIT" style="opacity: 1;" readonly="readonly" disabled="disabled">
                            <label class="onoffswitch-label" for="INIBE_CALC_OUTPUT_CRIT"> 
                                <span class="onoffswitch-inner" data-swchon-text="SIM" data-swchoff-text="NÃO"></span>
                                <span class="onoffswitch-switch"></span>
                            </label> 
                        </span>
                    </div>
                </div>

                <div class="form-group col-sm-6 col-xl-2">
                    <div class="onoffswitch-container vertical">
                        <span class="onoffswitch-title required"><?php echo $ui_vacation; ?></span> 
                        <span class="onoffswitch">
                            <input type="checkbox" class="onoffswitch-checkbox" id="MARCACAO_FERIAS" name="MARCACAO_FERIAS" style="opacity: 1;" readonly="readonly" disabled="disabled">
                            <label class="onoffswitch-label" for="MARCACAO_FERIAS"> 
                                <span class="onoffswitch-inner" data-swchon-text="SIM" data-swchoff-text="NÃO"></span>
                                <span class="onoffswitch-switch"></span>
                            </label> 
                        </span>
                    </div>
                </div>

                <div class="form-group col-sm-6 col-xl-2">
                    <div class="onoffswitch-container vertical">
                        <span class="onoffswitch-title required"><?php echo $ui_time_attendance; ?></span> 
                        <span class="onoffswitch">
                            <input type="checkbox" class="onoffswitch-checkbox" id="TRATAMENTO_PONTO" name="TRATAMENTO_PONTO" style="opacity: 1;" readonly="readonly" disabled="disabled">
                            <label class="onoffswitch-label" for="TRATAMENTO_PONTO"> 
                                <span class="onoffswitch-inner" data-swchon-text="SIM" data-swchoff-text="NÃO"></span>
                                <span class="onoffswitch-switch"></span>
                            </label> 
                        </span>
                    </div>
                </div> 

                <div class="form-group col-sm-6 col-xl-2">
                    <div class="onoffswitch-container vertical">
                        <span class="onoffswitch-title required"><?php echo $ui_planned_absence; ?></span> 
                        <span class="onoffswitch">
                            <input type="checkbox" class="onoffswitch-checkbox" id="AUSENCIA_PROGRAMADA" name="AUSENCIA_PROGRAMADA" style="opacity: 1;" readonly="readonly" disabled="disabled">
                            <label class="onoffswitch-label" for="AUSENCIA_PROGRAMADA"> 
                                <span class="onoffswitch-inner" data-swchon-text="SIM" data-swchoff-text="NÃO"></span>
                                <span class="onoffswitch-switch"></span>
                            </label> 
                        </span>
                    </div>
                </div>

                <div class="form-group col-sm-6 col-xl-2">
                    <div class="onoffswitch-container vertical">
                        <span class="onoffswitch-title required"><?php echo $ui_absences; ?></span> 
                        <span class="onoffswitch">
                            <input type="checkbox" class="onoffswitch-checkbox" id="ABSENTISMO" name="ABSENTISMO" style="opacity: 1;" readonly="readonly" disabled="disabled">
                            <label class="onoffswitch-label" for="ABSENTISMO"> 
                                <span class="onoffswitch-inner" data-swchon-text="SIM" data-swchoff-text="NÃO"></span>
                                <span class="onoffswitch-switch"></span>
                            </label> 
                        </span>
                    </div>
                </div>

                <div class="form-group col-sm-6 col-xl-2">
                    <div class="onoffswitch-container vertical">
                        <span class="onoffswitch-title required"><?php echo $ui_overtime_work; ?></span> 
                        <span class="onoffswitch">
                            <input type="checkbox" class="onoffswitch-checkbox" id="TRABALHO_SUPLEMENTAR" name="TRABALHO_SUPLEMENTAR" style="opacity: 1;" readonly="readonly" disabled="disabled">
                            <label class="onoffswitch-label" for="TRABALHO_SUPLEMENTAR"> 
                                <span class="onoffswitch-inner" data-swchon-text="SIM" data-swchoff-text="NÃO"></span>
                                <span class="onoffswitch-switch"></span>
                            </label> 
                        </span>
                    </div>
                </div>

                <div class="form-group col-sm-6 col-xl-2">
                    <div class="onoffswitch-container vertical">
                        <span class="onoffswitch-title required"><?php echo $ui_performance_evaluation; ?></span> 
                        <span class="onoffswitch">
                            <input type="checkbox" class="onoffswitch-checkbox" id="AVALIACAO" name="AVALIACAO" style="opacity: 1;" readonly="readonly" disabled="disabled">
                            <label class="onoffswitch-label" for="AVALIACAO"> 
                                <span class="onoffswitch-inner" data-swchon-text="SIM" data-swchoff-text="NÃO"></span>
                                <span class="onoffswitch-switch"></span>
                            </label> 
                        </span>
                    </div>
                </div>

                <div class="form-group col-sm-6 col-xl-2">
                    <div class="onoffswitch-container vertical">
                        <span class="onoffswitch-title required"><?php echo $ui_selection_recruitment; ?></span> 
                        <span class="onoffswitch">
                            <input type="checkbox" class="onoffswitch-checkbox" id="SELECCAO_RECRUTA" name="SELECCAO_RECRUTA" style="opacity: 1;" readonly="readonly" disabled="disabled">
                            <label class="onoffswitch-label" for="SELECCAO_RECRUTA"> 
                                <span class="onoffswitch-inner" data-swchon-text="SIM" data-swchoff-text="NÃO"></span>
                                <span class="onoffswitch-switch"></span>
                            </label> 
                        </span>
                    </div>
                </div>

                <div class="form-group col-sm-6 col-xl-2">
                    <div class="onoffswitch-container vertical">
                        <span class="onoffswitch-title required"><?php echo $ui_training; ?></span> 
                        <span class="onoffswitch">
                            <input type="checkbox" class="onoffswitch-checkbox" id="FORMACAO" name="FORMACAO" style="opacity: 1;" readonly="readonly" disabled="disabled">
                            <label class="onoffswitch-label" for="FORMACAO"> 
                                <span class="onoffswitch-inner" data-swchon-text="SIM" data-swchoff-text="NÃO"></span>
                                <span class="onoffswitch-switch"></span>
                            </label> 
                        </span>
                    </div>
                </div>

                <div class="form-group col-sm-6 col-xl-2">
                    <div class="onoffswitch-container vertical">
                        <span class="onoffswitch-title required"><?php echo $ui_shst_short; ?></span> 
                        <span class="onoffswitch">
                            <input type="checkbox" class="onoffswitch-checkbox" id="SHST" name="SHST" style="opacity: 1;" readonly="readonly" disabled="disabled">
                            <label class="onoffswitch-label" for="SHST"> 
                                <span class="onoffswitch-inner" data-swchon-text="SIM" data-swchoff-text="NÃO"></span>
                                <span class="onoffswitch-switch"></span>
                            </label> 
                        </span>
                    </div>
                </div>

                <div class="form-group col-sm-6 col-xl-2">
                    <div class="onoffswitch-container vertical">
                        <span class="onoffswitch-title required"><?php echo $ui_career; ?></span> 
                        <span class="onoffswitch">
                            <input type="checkbox" class="onoffswitch-checkbox" id="CARREIRAS" name="CARREIRAS" style="opacity: 1;" readonly="readonly" disabled="disabled">
                            <label class="onoffswitch-label" for="CARREIRAS"> 
                                <span class="onoffswitch-inner" data-swchon-text="SIM" data-swchoff-text="NÃO"></span>
                                <span class="onoffswitch-switch"></span>
                            </label> 
                        </span>
                    </div>
                </div>

                <div class="form-group col-sm-6 col-xl-2">
                    <div class="onoffswitch-container vertical">
                        <span class="onoffswitch-title required"><?php echo $ui_timesheets; ?></span> 
                        <span class="onoffswitch">
                            <input type="checkbox" class="onoffswitch-checkbox" id="TIMESHEETS" name="TIMESHEETS" style="opacity: 1;" readonly="readonly" disabled="disabled">
                            <label class="onoffswitch-label" for="TIMESHEETS"> 
                                <span class="onoffswitch-inner" data-swchon-text="SIM" data-swchoff-text="NÃO"></span>
                                <span class="onoffswitch-switch"></span>
                            </label> 
                        </span>
                    </div>
                </div>

                <div class="form-group col-sm-6 col-xl-2">
                    <div class="onoffswitch-container vertical">
                        <span class="onoffswitch-title required"><?php echo $ui_portal; ?></span> 
                        <span class="onoffswitch">
                            <input type="checkbox" class="onoffswitch-checkbox" id="PORTAL" name="PORTAL" style="opacity: 1;" readonly="readonly" disabled="disabled">
                            <label class="onoffswitch-label" for="PORTAL"> 
                                <span class="onoffswitch-inner" data-swchon-text="SIM" data-swchoff-text="NÃO"></span>
                                <span class="onoffswitch-switch"></span>
                            </label> 
                        </span>
                    </div>
                </div>

            </div>
        </fieldset>
    </div>
</div>
<!-- Permite Cálculo de... -->
<div class="form-row mt-4">
    <div class="col-sm-12">
        <fieldset class="first-line"> 
            <header class="frmInnerHeader"><?php echo $ui_allows_calculation_of; ?></header>
            <div class="form-row">
                <div class="form-group col-sm-6 col-xl-2">
                    <div class="onoffswitch-container vertical">
                        <span class="onoffswitch-title required"><?php echo $ui_pay_slip_short; ?></span> 
                        <span class="onoffswitch">
                            <input type="checkbox" class="onoffswitch-checkbox" id="RECIBO" name="RECIBO" style="opacity: 1;" readonly="readonly" disabled="disabled">
                            <label class="onoffswitch-label" for="RECIBO"> 
                                <span class="onoffswitch-inner" data-swchon-text="SIM" data-swchoff-text="NÃO"></span>
                                <span class="onoffswitch-switch"></span>
                            </label> 
                        </span>
                    </div>
                </div>

                <div class="form-group col-sm-6 col-xl-2">
                    <div class="onoffswitch-container vertical">
                        <span class="onoffswitch-title required"><?php echo $ui_vacation_allowance; ?></span> 
                        <span class="onoffswitch">
                            <input type="checkbox" class="onoffswitch-checkbox" id="SUB_FERIAS" name="SUB_FERIAS" style="opacity: 1;" readonly="readonly" disabled="disabled">
                            <label class="onoffswitch-label" for="SUB_FERIAS"> 
                                <span class="onoffswitch-inner" data-swchon-text="SIM" data-swchoff-text="NÃO"></span>
                                <span class="onoffswitch-switch"></span>
                            </label> 
                        </span>
                    </div>
                </div>

                <div class="form-group col-sm-6 col-xl-2">
                    <div class="onoffswitch-container vertical">
                        <span class="onoffswitch-title required"><?php echo $ui_christmas_allowance; ?></span> 
                        <span class="onoffswitch">
                            <input type="checkbox" class="onoffswitch-checkbox" id="SUB_NATAL" name="SUB_NATAL" style="opacity: 1;" readonly="readonly" disabled="disabled">
                            <label class="onoffswitch-label" for="SUB_NATAL"> 
                                <span class="onoffswitch-inner" data-swchon-text="SIM" data-swchoff-text="NÃO"></span>
                                <span class="onoffswitch-switch"></span>
                            </label> 
                        </span>
                    </div>
                </div> 

                <div class="form-group col-sm-6 col-xl-2">
                    <div class="onoffswitch-container vertical">
                        <span class="onoffswitch-title required"><?php echo $ui_other_subsidies; ?></span> 
                        <span class="onoffswitch">
                            <input type="checkbox" class="onoffswitch-checkbox" id="OUTROS_SUBS" name="OUTROS_SUBS" style="opacity: 1;" readonly="readonly" disabled="disabled">
                            <label class="onoffswitch-label" for="OUTROS_SUBS"> 
                                <span class="onoffswitch-inner" data-swchon-text="SIM" data-swchoff-text="NÃO"></span>
                                <span class="onoffswitch-switch"></span>
                            </label> 
                        </span>
                    </div>
                </div>

                <div class="form-group col-sm-6 col-xl-2">
                    <div class="onoffswitch-container vertical">
                        <span class="onoffswitch-title required"><?php echo $ui_regular_remuneration_suspension; ?></span> 
                        <span class="onoffswitch">
                            <input type="checkbox" class="onoffswitch-checkbox" id="SUSP_REM" name="SUSP_REM" style="opacity: 1;" readonly="readonly" disabled="disabled">
                            <label class="onoffswitch-label" for="SUSP_REM"> 
                                <span class="onoffswitch-inner" data-swchon-text="SIM" data-swchoff-text="NÃO"></span>
                                <span class="onoffswitch-switch"></span>
                            </label> 
                        </span>
                    </div>
                </div>

                <div class="form-group col-sm-6 col-xl-2">
                    <div class="onoffswitch-container vertical">
                        <span class="onoffswitch-title required"><?php echo $ui_diuturnities; ?></span> 
                        <span class="onoffswitch">
                            <input type="checkbox" class="onoffswitch-checkbox" id="DIUTURNIDADES" name="DIUTURNIDADES" style="opacity: 1;" readonly="readonly" disabled="disabled">
                            <label class="onoffswitch-label" for="DIUTURNIDADES"> 
                                <span class="onoffswitch-inner" data-swchon-text="SIM" data-swchoff-text="NÃO"></span>
                                <span class="onoffswitch-switch"></span>
                            </label> 
                        </span>
                    </div>
                </div>

                <div class="form-group col-sm-6 col-xl-2">
                    <div class="onoffswitch-container vertical">
                        <span class="onoffswitch-title required"><?php echo $ui_seniority_rewards; ?></span> 
                        <span class="onoffswitch">
                            <input type="checkbox" class="onoffswitch-checkbox" id="PREMIO_ANTIGUIDADE" name="PREMIO_ANTIGUIDADE" style="opacity: 1;" readonly="readonly" disabled="disabled">
                            <label class="onoffswitch-label" for="PREMIO_ANTIGUIDADE"> 
                                <span class="onoffswitch-inner" data-swchon-text="SIM" data-swchoff-text="NÃO"></span>
                                <span class="onoffswitch-switch"></span>
                            </label> 
                        </span>
                    </div>
                </div>

                <div class="form-group col-sm-6 col-xl-2">
                    <div class="onoffswitch-container vertical">
                        <span class="onoffswitch-title required"><?php echo $ui_stop_age_counter; ?></span> 
                        <span class="onoffswitch">
                            <input type="checkbox" class="onoffswitch-checkbox" id="STOP_IDADE" name="STOP_IDADE" style="opacity: 1;" readonly="readonly" disabled="disabled">
                            <label class="onoffswitch-label" for="STOP_IDADE"> 
                                <span class="onoffswitch-inner" data-swchon-text="SIM" data-swchoff-text="NÃO"></span>
                                <span class="onoffswitch-switch"></span>
                            </label> 
                        </span>
                    </div>
                </div>

                <div class="form-group col-sm-6 col-xl-2">
                    <div class="onoffswitch-container vertical">
                        <span class="onoffswitch-title required"><?php echo $ui_retroactive_payments; ?></span> 
                        <span class="onoffswitch">
                            <input type="checkbox" class="onoffswitch-checkbox" id="RETROACTIVOS" name="RETROACTIVOS" style="opacity: 1;" readonly="readonly" disabled="disabled">
                            <label class="onoffswitch-label" for="RETROACTIVOS"> 
                                <span class="onoffswitch-inner" data-swchon-text="SIM" data-swchoff-text="NÃO"></span>
                                <span class="onoffswitch-switch"></span>
                            </label> 
                        </span>
                    </div>
                </div>

                <div class="form-group col-sm-6 col-xl-2">
                    <div class="onoffswitch-container vertical">
                        <span class="onoffswitch-title required"><?php echo $ui_temporary_work; ?></span> 
                        <span class="onoffswitch">
                            <input type="checkbox" class="onoffswitch-checkbox" id="TRAB_TEMPORARIOS" name="TRAB_TEMPORARIOS" style="opacity: 1;" readonly="readonly" disabled="disabled">
                            <label class="onoffswitch-label" for="TRAB_TEMPORARIOS"> 
                                <span class="onoffswitch-inner" data-swchon-text="SIM" data-swchoff-text="NÃO"></span>
                                <span class="onoffswitch-switch"></span>
                            </label> 
                        </span>
                    </div>
                </div>
            </div>
        </fieldset>
    </div>
</div>
<!-- Switches -->
<div class="form-row mt-4">
    <div class="col-sm-12">
        <fieldset class="first-line"> 
            <header class="frmInnerHeader"><?php echo $ui_consider_situation_in; ?></header>
            <div class="form-row">
                <div class="form-group col-sm-6 col-xl-2">
                    <div class="onoffswitch-container vertical">
                        <span class="onoffswitch-title required"><?php echo $ui_relatorio_unico; ?></span> 
                        <span class="onoffswitch">
                            <input type="checkbox" class="onoffswitch-checkbox" id="QP_SITUACAO" name="QP_SITUACAO" style="opacity: 1;" readonly="readonly" disabled="disabled">
                            <label class="onoffswitch-label" for="QP_SITUACAO"> 
                                <span class="onoffswitch-inner" data-swchon-text="SIM" data-swchoff-text="NÃO"></span>
                                <span class="onoffswitch-switch"></span>
                            </label> 
                        </span>
                    </div>
                </div>

                <div class="form-group col-sm-6 col-xl-2">
                    <div class="onoffswitch-container vertical">
                        <span class="onoffswitch-title required"><?php echo $ui_official_statistics; ?></span> 
                        <span class="onoffswitch">
                            <input type="checkbox" class="onoffswitch-checkbox" id="MESS_SITUACAO" name="MESS_SITUACAO" style="opacity: 1;" readonly="readonly" disabled="disabled">
                            <label class="onoffswitch-label" for="MESS_SITUACAO"> 
                                <span class="onoffswitch-inner" data-swchon-text="SIM" data-swchoff-text="NÃO"></span>
                                <span class="onoffswitch-switch"></span>
                            </label> 
                        </span>
                    </div>
                </div>

                <div class="form-group col-sm-6 col-xl-2">
                    <div class="onoffswitch-container vertical">
                        <span class="onoffswitch-title required"><?php echo $ui_ss; ?></span> 
                        <span class="onoffswitch">
                            <input type="checkbox" class="onoffswitch-checkbox" id="SS_SITUACAO" name="SS_SITUACAO" style="opacity: 1;" readonly="readonly" disabled="disabled">
                            <label class="onoffswitch-label" for="SS_SITUACAO"> 
                                <span class="onoffswitch-inner" data-swchon-text="SIM" data-swchoff-text="NÃO"></span>
                                <span class="onoffswitch-switch"></span>
                            </label> 
                        </span>
                    </div>
                </div> 

                <div class="form-group col-sm-6 col-xl-2">
                    <div class="onoffswitch-container vertical">
                        <span class="onoffswitch-title required"><?php echo $ui_union; ?></span> 
                        <span class="onoffswitch">
                            <input type="checkbox" class="onoffswitch-checkbox" id="SIND_SITUACAO" name="SIND_SITUACAO" style="opacity: 1;" readonly="readonly" disabled="disabled">
                            <label class="onoffswitch-label" for="SIND_SITUACAO"> 
                                <span class="onoffswitch-inner" data-swchon-text="SIM" data-swchoff-text="NÃO"></span>
                                <span class="onoffswitch-switch"></span>
                            </label> 
                        </span>
                    </div>
                </div>

                <div class="form-group col-sm-6 col-xl-2">
                    <div class="onoffswitch-container vertical">
                        <span class="onoffswitch-title required"><?php echo $ui_dissmissal_reason; ?></span> 
                        <span class="onoffswitch">
                            <input type="checkbox" class="onoffswitch-checkbox" id="MOTIVO_SAIDA" name="MOTIVO_SAIDA" style="opacity: 1;" readonly="readonly" disabled="disabled">
                            <label class="onoffswitch-label" for="MOTIVO_SAIDA"> 
                                <span class="onoffswitch-inner" data-swchon-text="SIM" data-swchoff-text="NÃO"></span>
                                <span class="onoffswitch-switch"></span>
                            </label> 
                        </span>
                    </div>
                </div>
            </div>
        </fieldset>
    </div>
</div>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="Tab12" role="tabpanel">
                                            <a id="RH_DEF_SITUACOES_VALIDAS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="RH_DEF_SITUACOES_VALIDAS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                        </div>                                        
                                        <div class="tab-pane fade" id="Tab13" role="tabpanel">
                                            <a id="DG_DET_GRUPOS_OUTPUT_SIT_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="DG_DET_GRUPOS_OUTPUT_SIT" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                        </div>                                        
                                        <div class="tab-pane fade" id="Tab14" role="tabpanel">
                                            <a id="RH_DEF_SITUACAO_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="RH_DEF_SITUACAO_TRADS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #1 -->

                         <!-- TAB #2 -->
                        <div class="tab-pane fade" id="Tab2" role="tabpanel">
                            <a id="RH_DEF_CATEG_PROF_INTERNAS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="RH_DEF_CATEG_PROF_INTERNAS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-11" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                            <h2><?php echo $ui_translate; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="RH_DEF_CATEG_PROF_INT_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="RH_DEF_CATEG_PROF_INT_TRADS" class="table table-bordered table-hover table-striped w-100"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #2 -->
                        
                         <!-- TAB #3 -->
                        <div class="tab-pane fade" id="Tab3" role="tabpanel">
                            <a id="RH_DEF_FUNCOES_INTERNAS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="RH_DEF_FUNCOES_INTERNAS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-11" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                            <h2><?php echo $ui_translate; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="RH_DEF_FUNC_INT_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="RH_DEF_FUNC_INT_TRADS" class="table table-bordered table-hover table-striped w-100"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #3 -->
                         
                         <!-- TAB #4 -->
                        <div class="tab-pane fade" id="Tab4" role="tabpanel">
                            <a id="RH_DEF_GRUPOS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="RH_DEF_GRUPOS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-11" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                            <h2><?php echo $ui_translate; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="RH_DEF_GRUPO_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="RH_DEF_GRUPO_TRADS" class="table table-bordered table-hover table-striped w-100"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #4 -->
                         
                         <!-- TAB #5 -->
                        <div class="tab-pane fade" id="Tab5" role="tabpanel">
                            <a id="RH_DEF_NIVEIS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="RH_DEF_NIVEIS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-11" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                            <h2><?php echo $ui_translate; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="RH_DEF_NIVEL_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="RH_DEF_NIVEL_TRADS" class="table table-bordered table-hover table-striped w-100"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #5 -->
                         
                         <!-- TAB #6 -->
                        <div class="tab-pane fade" id="Tab6" role="tabpanel">
                            <a id="DG_JOBS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="DG_JOBS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-11" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                            <h2><?php echo $ui_translate; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="DG_JOBS_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="DG_JOBS_TRADS" class="table table-bordered table-hover table-striped w-100"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #6 -->

                         <!-- TAB #7 -->
                        <div class="tab-pane fade" id="Tab7" role="tabpanel">
                            <a id="DG_DOCUMENTOS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="DG_DOCUMENTOS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-11" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                            <h2><?php echo $ui_translate; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="DG_DOCUMENTO_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="DG_DOCUMENTO_TRADS" class="table table-bordered table-hover table-striped w-100"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #7 -->
                         
                         <!-- TAB #8 -->
                        <div class="tab-pane fade" id="Tab8" role="tabpanel">
                            <a id="RH_DEF_HAB_PROFISSIONAIS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="RH_DEF_HAB_PROFISSIONAIS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-11" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                            <h2><?php echo $ui_translate; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="RH_DEF_HAB_PROF_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="RH_DEF_HAB_PROF_TRADS" class="table table-bordered table-hover table-striped w-100"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #8 -->

                         <!-- TAB #9 -->
                        <div class="tab-pane fade" id="Tab9" role="tabpanel">
                            <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-start">
                                <div class="panel-toolbar pr-3 align-self-end">
                                    <ul id="panel-tab-9-1" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#Tab91" role="tab" aria-selected="true"><?php echo $ui_definition; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Tab92" role="tab" aria-selected="true"><?php echo $ui_contexts; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Tab93" role="tab" aria-selected="true"><?php echo $ui_lovs_short; ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-container show boxSubTab">
                                <div class="panel-content">
                                    <div class="tab-content">
                                         <!-- TAB #9.1 -->
                                        <div class="tab-pane fade active show" id="Tab91" role="tabpanel">
                                            <a id="RH_DEF_FLEXFIELDS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="RH_DEF_FLEXFIELDS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                            <div class="row mt-4">
                                                <div class="col-xl-12">
                                                    <div id="panel-11" class="panel">
                                                        <div class="panel-hdr">
                                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                                            <h2><?php echo $ui_translate; ?></h2>
                                                        </div>
                                                        <div class="panel-container show">
                                                            <div class="panel-content">
                                                                <a id="RH_DEF_FLEXFIELD_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                                <table id="RH_DEF_FLEXFIELD_TRADS" class="table table-bordered table-hover table-striped w-100"></table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                         <!-- END TAB #9.1 -->
                                         
                                         <!-- TAB #9.2 -->
                                        <div class="tab-pane fade" id="Tab92" role="tabpanel">
                                            <a id="AF_Contextos_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="AF_Contextos" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                            <div class="row mt-4">
                                                <div class="col-xl-12">
                                                    <div id="panel-11" class="panel">
                                                        <div class="panel-hdr">
                                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                                            <h2><?php echo $ui_translate; ?></h2>
                                                        </div>
                                                        <div class="panel-container show">
                                                            <div class="panel-content">
                                                                <a id="AF_ContextosTrads_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                                <table id="AF_ContextosTrads" class="table table-bordered table-hover table-striped w-100"></table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                        
                                         <!-- END TAB #9.2 -->
                                         
                                         <!-- TAB #9.3 -->
                                        <div class="tab-pane fade" id="Tab93" role="tabpanel">
                                            <a id="AF_LOVS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="AF_LOVS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                            <div class="row mt-4">
                                                <div class="col-xl-12">
                                                    <div id="panel-11" class="panel">
                                                        <div class="panel-hdr">
                                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                                            <h2><?php echo $ui_translate; ?></h2>
                                                        </div>
                                                        <div class="panel-container show">
                                                            <div class="panel-content">
                                                                <a id="AF_LOVSTrads_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                                <table id="AF_LOVSTrads" class="table table-bordered table-hover table-striped w-100"></table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                        
                                         <!-- END TAB #9.3 -->
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #9 -->

                         <!-- TAB #10 -->
                        <div class="tab-pane fade" id="Tab10" role="tabpanel">
                            <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-start">
                                <div class="panel-toolbar pr-3 align-self-end">
                                    <ul id="panel-tab-10-1" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#Tab101" role="tab" aria-selected="true"><?php echo $ui_definition; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Tab102" role="tab" aria-selected="true"><?php echo $ui_contexts; ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-container show boxSubTab">
                                <div class="panel-content">
                                    <div class="tab-content">
                                         <!-- TAB #10.1 -->
                                        <div class="tab-pane fade active show" id="Tab101" role="tabpanel">
                                            
                                            <a id="RH_DEF_ITEMS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="RH_DEF_ITEMS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                            
                                            <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-start">
                                                <div class="panel-toolbar pr-3 align-self-end">
                                                    <ul id="panel-tab-10-1-1" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" data-toggle="tab" href="#Tab1011" role="tab" aria-selected="true"><?php echo $ui_curriculum_sub_items; ?></a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="tab" href="#Tab1012" role="tab" aria-selected="true"><?php echo $ui_translate; ?></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="panel-container show boxSubTab">
                                                <div class="panel-content">
                                                    <div class="tab-content">
                                                         <!-- TAB #10.1.1 -->
                                                        <div class="tab-pane fade active show" id="Tab1011" role="tabpanel">
                                                            <a id="RH_DEF_SUB_ITEMS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                            <table id="RH_DEF_SUB_ITEMS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                                            <div class="row mt-4">
                                                                <div class="col-xl-12">
                                                                    <div id="panel-11" class="panel">
                                                                        <div class="panel-hdr">
                                                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                                                            <h2><?php echo $ui_translate; ?></h2>
                                                                        </div>
                                                                        <div class="panel-container show">
                                                                            <div class="panel-content">
                                                                                <a id="RH_DEF_SUB_ITEM_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                                                <table id="RH_DEF_SUB_ITEM_TRADS" class="table table-bordered table-hover table-striped w-100"></table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                         <!-- END TAB #10.1.1 -->

                                                         <!-- TAB #10.1.2 -->
                                                        <div class="tab-pane fade" id="Tab1012" role="tabpanel">
                                                            <a id="RH_DEF_ITEM_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                            <table id="RH_DEF_ITEM_TRADS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                                        </div>                                        
                                                         <!-- END TAB #10.1.2 -->
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                         <!-- END TAB #10.1 -->
                                         
                                         <!-- TAB #10.2 -->
                                        <div class="tab-pane fade" id="Tab102" role="tabpanel">
                                            <a id="RH_CONTEXTO_CURR_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="RH_CONTEXTO_CURR" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                            <div class="row mt-4">
                                                <div class="col-xl-12">
                                                    <div id="panel-11" class="panel">
                                                        <div class="panel-hdr">
                                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                                            <h2><?php echo $ui_translate; ?></h2>
                                                        </div>
                                                        <div class="panel-container show">
                                                            <div class="panel-content">
                                                                <a id="RH_CONTEXTO_CURRTrads_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                                <table id="RH_CONTEXTO_CURRTrads" class="table table-bordered table-hover table-striped w-100"></table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                        
                                         <!-- END TAB #10.2 -->
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #10 -->
                         
                         <!-- TAB #11 -->
                        <div class="tab-pane fade" id="Tab_11" role="tabpanel">
                            <a id="CONTEXTOS_TEMPORAIS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="CONTEXTOS_TEMPORAIS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-11" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                            <h2><?php echo $ui_translate; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="CONTEXTOS_TEMPORAISTrads_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="CONTEXTOS_TEMPORAISTrads" class="table table-bordered table-hover table-striped w-100"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #11 -->
                    </div>                    
                </div>                    

            </div> 
        </div>
    </div>
</div>

<script>
    pageSetUp();
    
    $(document).ready(function () {

        //Situações
        var optionRH_DEF_SITUACOES = {
            "tableId": "RH_DEF_SITUACOES",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_situation; ?>",
            "table": "RH_DEF_SITUACOES", 
            "pk": {
                "primary": {
                    "CD_SITUACAO": {"type": "number"}
                }
            },
            "crudOnMasterInactive": {
                "condition": "data.ACTIVO !== 'S' ",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },                    
            "detailsObjects": ['RH_DEF_SITUACOES_CONTINUED','RH_DEF_SITUACOES_VALIDAS','RH_DEF_SITUACAO_TRADS','DG_DET_GRUPOS_OUTPUT_SIT'],
            "order_by": "CD_SITUACAO",
            "scrollY": "117",
            "recordBundle": 4,
            "pageLenght": 4, 
            "responsive": true,
            "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "className": "control toBottom toCenter",
                    "width": "1%",
                    "defaultContent": ''                    
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'CD_SITUACAO',
                    "name": 'CD_SITUACAO',
                    "className": "visibleColumn",                   
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_SITUACAO',
                    "name": 'DSP_SITUACAO',
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_SITUACAO',
                    "name": 'DSR_SITUACAO',                    
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 5, 
                    "title": "<?php echo mb_strtoupper($ui_active, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_active; ?>", //Editor
                    "data": 'ACTIVO',
                    "name": 'ACTIVO',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_SIM_NAO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    } 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'INSERTED_BY',
                    "name": 'INSERTED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INSERTED',
                    "name": 'DT_INSERTED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CHANGED_BY',
                    "name": 'CHANGED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_UPDATED',
                    "name": 'DT_UPDATED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions, 'UTF-8'); ?>" + '</span>',
                    "label": '',
                    "data":  null,
                    "name": 'RECORD_HISTORY',
                    "type": "hidden",
                    "className": "none visibleColumn",
                    "render": function (val, type, row) {
                        return tablesRecordHistory (val, type, row);
                    }                       
                }, {
                    "responsivePriority": 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        //debugger;
                        return RH_DEF_SITUACOES.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "CD_SITUACAO": {
                        required: true,
                        integer: true,
                        maxlength: 6
                    },
                    "DSP_SITUACAO": {
                        required: true,
                        maxlength: 40,
                    },
                    "DSR_SITUACAO": {
                        required: false,
                        maxlength: 25,
                    },
                    "ACTIVO": {
                        required: true
                    }
                }
            }
        };
        RH_DEF_SITUACOES = new QuadTable();
        RH_DEF_SITUACOES.initTable( $.extend({}, datatable_instance_defaults, optionRH_DEF_SITUACOES) );        
        //END Situações
        
        //Situações Continued :: QUADFORMS
        var optionsRH_DEF_SITUACOES_CONTINUED = {
            formId: "#RH_DEF_SITUACOES_CONTINUED",
            table: "RH_DEF_SITUACOES",
            info: true, //Disables INFO: (record / total records) :: HOW ????
            "pk": {
                "primary": {
                    "CD_SITUACAO": {"type": "number"}
                }
            },
            "dependsOn": {
                "RH_DEF_SITUACOES": {
                    "CD_SITUACAO": "CD_SITUACAO"
                }
            },
            // "initialWhereClause": " SEXO = 'M' ", optional
            //"order_by": "NOME",
            //detailsObjects: ['qTableDocs', 'qTableAgregados', 'Documentos', 'Agregados'],                
            "recordBundle": 1,
            crud: [false, true, false],//create,update,delete
            defaultButtons: ['enter-query', 'new'],
            refreshData: true, //default true
            queryAll: false,//defaults to true ...empty search return all records
            showMultiRecord: false, //default true
            //workflow: true, //optional defaults to false
            showWorkflowOnEdit: false,
            complexLists: {
                DSP_NEXT_SITUACAO: {
                    "dependent-group": "SITUACOES",
                    "dependent-level": 1, // use dependent-level  ***NOT***  dependent-group-level
                    //"deferred": true,
                    "name": "DSP_SITUACAO_NEXT",
                    "data-db-name": 'A.CD_SITUACAO',
                    "distribute-value": "CD_SITUACAO_NEXT",
                    "decodeFromTable": 'RH_DEF_SITUACOES A',
                    "desigColumn": "A.DSP_SITUACAO",
                    "class": "form-control complexList chosen", //class complexList Mandatory . we have to catch events like change and chain select event
                    'whereClause': '', //usado no 1º carregamento de TODOS os dados de uma complexList.php para descodificações de registos activos ou inactivos
                    'orderBy': 'A.CD_SITUACAO', //usado no complexList.php
                    "filter": {
                        "create": " AND A.ACTIVO = 'S' AND A.CD_SITUACAO != ':CD_SITUACAO' ", //On-New-Record
                        "edit": " AND A.ACTIVO = 'S' AND A.CD_SITUACAO != ':CD_SITUACAO' ", //On-Edit-Record
                    },
                },
            }
//            domainLists: { 
//                NATUREZA_JURIDICA: {
//                     "domain-list": true,
//                     "dependent-group": "DG_NATUREZA_JURIDICA"
//                },
//                REPARTICAO_FISCAL: {
//                     "domain-list": true,
//                     "dependent-group": "DG_REPARTICAO_FISCAL"
//                },
//                ASSOCIACAO_1: {
//                     "domain-list": true,
//                     "dependent-group": "DG_ASSOCIACAO_PATRONAL"
//                },
//                ASSOCIACAO_2: {
//                     "domain-list": true,
//                     "dependent-group": "DG_ASSOCIACAO_PATRONAL"
//                },
//                ASSOCIACAO_3: {
//                     "domain-list": true,
//                     "dependent-group": "DG_ASSOCIACAO_PATRONAL"
//                },
//                ACTIV_ECONOMICA_1: {
//                     "domain-list": true,
//                     "dependent-group": "DG_ACTIVIDADES_ECONOMICAS"
//                },
//                ACTIV_ECONOMICA_2: {
//                     "domain-list": true,
//                     "dependent-group": "DG_ACTIVIDADES_ECONOMICAS"
//                },
//                ACTIV_ECONOMICA_3: {
//                     "domain-list": true,
//                     "dependent-group": "DG_ACTIVIDADES_ECONOMICAS"
//                }                
//            },
//            "validations": {
//                "rules": {
//                    "CONSERVATORIA": {
//                        maxlength: 20
//                    },
//                    "MATRICULA": {
//                        maxlength: 20
//                    },
//                    "DT_INI_ACTIVIDADE": {
//                        dateISO: true
//                    },
//                    "DT_CONSTITUICAO": {
//                        dateISO: true
//                    },
//                    "VOLUME_VENDAS": {
//                        number: true
//                    },
//                    "CAPITAL_SOCIAL": {
//                        number: true
//                    },
//                    "TX_NACIONAL": {
//                        number: true
//                    },
//                    "TX_ESTRANG": {
//                        number: true
//                    },
//                    "TX_PUBLICO": {
//                        number: true
//                    },
//                    "CD_CIRS": {
//                        maxlength: 15
//                    },
//                    "NIF_RL": {
//                        maxlength: 15
//                    },
//                    "NIF_TOC": {
//                        maxlength: 15
//                    }                    
//                },
//                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
//                "messages": {
//                    "DT_FIM": {
//                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
//                    }
//                }
//            }                
        };
        RH_DEF_SITUACOES_CONTINUED = new QuadForm();
        RH_DEF_SITUACOES_CONTINUED.initForm($.extend({}, datatable_instance_defaults, optionsRH_DEF_SITUACOES_CONTINUED));
        //Situações Continued :: QUADFORMS
                
        //Próximas Situações Válidas
        var optionsRH_DEF_SITUACOES_VALIDAS = {
            "tableId": "RH_DEF_SITUACOES_VALIDAS",
            "table": "RH_DEF_SITUACOES_VALIDAS",
            "pk": {
                "primary": {
                    "CD_SITUACAO": {"type": "number"},
                    "SEQ_NXT_SITUACAO": {"type": "number"}
                }
            },
            "dependsOn": {
                "RH_DEF_SITUACOES": {
                    "CD_SITUACAO": "CD_SITUACAO"
                }
            },
            "order_by": "CD_SITUACAO_NEXT",
            "recordBundle": 11, 
            "pageLenght": 11, 
            "scrollY": "406",
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "className": "control toBottom toCenter",
                    "width": "1%",
                    "defaultContent": ''  
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_SITUACAO',
                    "name": 'CD_SITUACAO',                    
                    "type": "hidden",
                    "visible": false
                }, {
                    "title": "",
                    "label": "",
                    "data": 'SEQ_NXT_SITUACAO',
                    "name": 'SEQ_NXT_SITUACAO',
                    "type": "hidden",
                    "datatype": "sequence",
                    "visible": false,
                    "className": "none"
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_SITUACAO_NEXT',
                    "name": 'CD_SITUACAO_NEXT',                    
                    "type": "hidden",
                    "visible": false
                }, {
                    "responsivePriority": 2,
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_situation, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_situation; ?>",
                    "data": 'DSP_SITUACAO',
                    "name": 'DSP_SITUACAO',
                    "type": "select",
                    "className": "visibleColumn",
                    //"visible": false, //DataTables
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "deferred": true,
                        "dependent-group": "SITUACOES",
                        "dependent-level": 1,
                        "data-db-name": 'A.CD_SITUACAO',
                        "distribute-value": "CD_SITUACAO_NEXT",
                        "decodeFromTable": 'RH_DEF_SITUACOES A',
                        "class": "form-control complexList chosen", 
                        "desigColumn": "A.DSP_SITUACAO", 
                        "orderBy": "A.CD_SITUACAO DESC",
                        "filter": {
                            "create": " AND A.ACTIVO = 'S' AND A.CD_SITUACAO != ':CD_SITUACAO'", //On-New-Record
                            "edit": " AND A.ACTIVO = 'S' AND A.CD_SITUACAO != ':CD_SITUACAO'", //On-Edit-Record
                        }
                    }             
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI',
                    "name": 'DT_INI',
                    "datatype": 'date',
                    "def": "1900-01-01",
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM',
                    "name": 'DT_FIM',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_obs_short, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_obs_short; ?>", //Editor
                    "data": 'OBS',
                    "name": 'OBS',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 335px"
                    } 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'INSERTED_BY',
                    "name": 'INSERTED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INSERTED',
                    "name": 'DT_INSERTED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CHANGED_BY',
                    "name": 'CHANGED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_UPDATED',
                    "name": 'DT_UPDATED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions, 'UTF-8'); ?>" + '</span>',
                    "label": '',
                    "data":  null,
                    "name": 'RECORD_HISTORY',
                    "type": "hidden",
                    "className": "none visibleColumn",
                    "render": function (val, type, row) {
                        return tablesRecordHistory (val, type, row);
                    }                
                }, {
                    "responsivePriority": 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        //debugger;
                        return RH_DEF_SITUACOES_VALIDAS.crudButtons(true,true,true);
                    }
                }
            ],
            validations: {
                rules: {
                    "DSP_SITUACAO": {
                        required: true
                    },
                    "OBS": {
                        maxlength: 4000
                    },
                    "DT_INI": {
                        required: true,
                        dateISO: true
                    },
                    "DT_FIM": {
                        dateISO: true,
                        dateEqOrNextThan: "DT_INI",
                    }
                },
                "messages": {
                    "DT_FIM": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        RH_DEF_SITUACOES_VALIDAS = new QuadTable();
        RH_DEF_SITUACOES_VALIDAS.initTable($.extend({}, datatable_instance_defaults, optionsRH_DEF_SITUACOES_VALIDAS));
        //END Próximas Situações Válidas
        
        //Outputs
        var optionDG_DET_GRUPOS_OUTPUT_SIT = {
            "tableId": "DG_DET_GRUPOS_OUTPUT_SIT",
            "table": "DG_DET_GRUPOS_OUTPUT",
            "pk": {
                "primary": {
                    "CD_OUTPUT": {"type": "varchar"},
                    "CD_GRUPO": {"type": "varchar"},
                    "SEQ": {"type": "number"},
                    "CD_SITUACAO": {"type": "number"}
                }
            },
            "dependsOn": {
                "RH_DEF_SITUACOES": { //External object key mapping( object key : external key)                    
                    "CD_SITUACAO" : "CD_SITUACAO"
                }
            },
            //"initialWhereClause": '',             
            "order_by": "CD_OUTPUT, CD_GRUPO, SEQ",
            "recordBundle": 6,
            "pageLenght": 6,
            "scrollY": "175",
            "responsive": true,
            "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "width": "1%",
                    "className": "control toBottom toCenter",
                    "orderable": false,
                    "defaultContent": ''
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_SITUACAO',
                    "name": 'CD_SITUACAO',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_OUTPUT',
                    "name": 'CD_OUTPUT',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 2, 
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_output, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_output; ?>",
                    "data": 'DSP_OUTPUT',
                    "name": 'DSP_OUTPUT',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, 
                    "attr": {
                        "dependent-group": "OUTPUTS",
                        "dependent-level": 1,
                        "data-db-name": "A.CD_OUTPUT",
                        "decodeFromTable": "DG_DEF_OUTPUTS A",
                        "desigColumn": "CONCAT(CONCAT(A.CD_OUTPUT,'-'),A.DSP_OUTPUT)", 
                        "orderBy": "A.CD_OUTPUT", 
                        "class": "form-control complexList chosen",
                        "whereClause": "",
                        "filter": {
                            "create": " AND A.ACTIVO = 'S'", //On-New-Record
                            "edit": " AND A.ACTIVO = 'S'", //On-Edit-Record                            
                        }
                    } 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_GRUPO',
                    "name": 'CD_GRUPO',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 3, 
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_group, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_group; ?>",
                    "data": 'DSP_GRUPO',
                    "name": 'DSP_GRUPO',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, 
                    "attr": {
                        "dependent-group": "OUTPUTS",
                        "dependent-level": 2,
                        "data-db-name": "A.CD_OUTPUT@A.CD_GRUPO",
                        "decodeFromTable": "DG_DEF_GRUPOS_OUTPUT A",
                        "desigColumn": "CONCAT(CONCAT(A.CD_GRUPO,'-'),A.DSP_GRUPO)", 
                        "orderBy": "A.CD_GRUPO", 
                        "class": "form-control complexList chosen",
                        "whereClause": "",
                        "filter": {
                            "create": " AND A.ACTIVO = 'S'", //On-New-Record
                            "edit": " AND A.ACTIVO = 'S'", //On-Edit-Record                            
                        }
                    } 
                }, {
                    "title": "",
                    "label": "",
                    "data": 'SEQ',
                    "name": 'SEQ',
                    "datatype": 'sequence',
                    "type": "hidden",
                    "visible": false                  
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_RUBRICA',
                    "name": 'CD_RUBRICA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 4, 
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_payroll_item, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_payroll_item; ?>",
                    "data": 'DSP_RUBRICA',
                    "name": 'DSP_RUBRICA',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, 
                    "attr": {
                        "dependent-group": "RUBRICAS",
                        "dependent-level": 1,
                        "data-db-name": "A.CD_RUBRICA",
                        "decodeFromTable": "RH_DEF_RUBRICAS A",
                        "desigColumn": "CONCAT(CONCAT(A.CD_RUBRICA,'-'),A.DSP_RUBRICA)", 
                        "orderBy": "A.CD_RUBRICA", 
                        "class": "form-control complexList chosen",
                        "whereClause": "",
                        "filter": {
                            "create": " AND A.ACTIVO = 'S'", //On-New-Record
                            "edit": " AND A.ACTIVO = 'S'", //On-Edit-Record                            
                        }
                    } 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_ED',
                    "name": 'CD_ED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 5,
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_discount_entity, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_discount_entity; ?>",
                    "data": 'DSP_ED',
                    "name": 'DSP_ED',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "ENT_DESCT",
                        "dependent-level": 1,
                        "data-db-name": "A.CD_ED",
                        "decodeFromTable": "RH_DEF_ENTIDADES_DESCONTO A",  //TO CHANGE ON QUAD-HCM
                        "desigColumn": "CONCAT(CONCAT(A.CD_ED,'-'),A.DSP_ED)",
                        "orderBy": "A.CD_ED",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.ACTIVO = 'S' ", //On-New-Record
                            "edit": " AND A.ACTIVO = 'S' ", //On-Edit-Record
                        }
                    }                   
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_GRELHA_SALARIAL',
                    "name": 'CD_GRELHA_SALARIAL',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 6,
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_payroll_grid,'UTF-8'); ?>",
                    "label": "<?php echo $ui_payroll_grid; ?>",
                    "data": 'DSP_GS',
                    "name": 'DSP_GS',
                    "type": "select",
                    "className": "visibleColumn",
                    "renew": true,
                    "attr": {
                        "dependent-group": "GRELHAS",
                        "dependent-level": 1,
                        "data-db-name": "A.CD_GRELHA_SALARIAL",
                        "decodeFromTable": "RH_DEF_GRELHAS_SALARIAIS A",
                        "desigColumn": "CONCAT(CONCAT(A.CD_GRELHA_SALARIAL,'-'),A.DSP_GRELHA_SALARIAL)",
                        "otherValues": "A.TP_GRELHA_SALARIAL",
                        "orderBy": "A.CD_GRELHA_SALARIAL",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.ACTIVO = 'S'",
                            "edit": " AND A.ACTIVO = 'S'",
                        }
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_reference, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_reference; ?>", //Editor
                    "data": 'REFERENCIA',
                    "name": 'REFERENCIA',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 335px",
                    }          
                }, {
                    "title": "<?php echo mb_strtoupper($ui_help, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_help; ?>", //Editor
                    "data": 'AJUDA',
                    "name": 'AJUDA',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 335px",
                        "class": "form-control defaultWidth",
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'INSERTED_BY',
                    "name": 'INSERTED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INSERTED',
                    "name": 'DT_INSERTED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CHANGED_BY',
                    "name": 'CHANGED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_UPDATED',
                    "name": 'DT_UPDATED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions, 'UTF-8'); ?>" + '</span>',
                    "label": '',
                    "data":  null,
                    "name": 'RECORD_HISTORY',
                    "type": "hidden",
                    "className": "none visibleColumn",
                    "render": function (val, type, row) {
                        return tablesRecordHistory (val, type, row);
                    }
                }, {
                    "responsivePriority": 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        return DG_DET_GRUPOS_OUTPUT_SIT.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {               
                    "DSP_OUTPUT": {
                        required: true
                    },
                    "DSP_GRUPO": {
                        required: true
                    },
                    "REFERENCIA": {
                        maxlength: 1000
                    },
                    "AJUDA": {
                        maxlength: 1000
                    },
                }
            }
        };
        DG_DET_GRUPOS_OUTPUT_SIT = new QuadTable();
        DG_DET_GRUPOS_OUTPUT_SIT.initTable($.extend({}, datatable_instance_defaults, optionDG_DET_GRUPOS_OUTPUT_SIT));   
        //END Outputs         
        
        //Situações Trads
        var optionsRH_DEF_SITUACAO_TRADS = {
            "tableId": "RH_DEF_SITUACAO_TRADS",
            "table": "RH_DEF_SITUACAO_TRADS",
            "pk": {
                "primary": {
                    "CD_SITUACAO": {"type": "number"},                      
                    "CD_LINGUA": {"type": "number"},                    
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "RH_DEF_SITUACOES": {
                    "CD_SITUACAO": "CD_SITUACAO"
                }
            },
            "order_by": "CD_LINGUA, DT_INI DESC",
            "recordBundle": 4, 
            "pageLenght": 4, 
            "scrollY": "150",
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "className": "control toBottom toCenter",
                    "width": "1%",
                    "defaultContent": ''  
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_SITUACAO',
                    "name": 'CD_SITUACAO',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_LINGUA',
                    "name": 'CD_LINGUA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 2,
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_language, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_language; ?>",
                    "data": 'DSR_LINGUA',
                    "name": 'DSR_LINGUA',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "dependent-group": "LINGUAS",
                        "dependent-level": 1,
                        "data-db-name": 'A.CD_LINGUA',
                        "decodeFromTable": 'DG_LINGUAS_ESTRANGEIRAS A',
                        "class": "form-control complexList chosen", 
                        "desigColumn": "A.DSR_LINGUA", 
                        "orderBy": "A.NR_ORDEM, A.CD_LINGUA",
                        "filter": {
                            "create": " AND A.ATIVO = 'S'", //On-New-Record
                            "edit": " AND A.ATIVO = 'S'", //On-Edit-Record
                        }
                    }
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI',
                    "name": 'DT_INI',
                    "datatype": 'date',
                    "def": "1900-01-01",
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DSP_TRAD',
                    "name": 'DSP_TRAD',                    
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_TRAD',
                    "name": 'DSR_TRAD',
                    "className": "visibleColumn",
                }, {
                    "title": "<?php echo mb_strtoupper($ui_description, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DESCRICAO',
                    "name": 'DESCRICAO',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 335px;",
                    }                                      
                }, {
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM',
                    "name": 'DT_FIM',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'INSERTED_BY',
                    "name": 'INSERTED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INSERTED',
                    "name": 'DT_INSERTED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CHANGED_BY',
                    "name": 'CHANGED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_UPDATED',
                    "name": 'DT_UPDATED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions, 'UTF-8'); ?>" + '</span>',
                    "label": '',
                    "data":  null,
                    "name": 'RECORD_HISTORY',
                    "type": "hidden",
                    "className": "none visibleColumn",
                    "render": function (val, type, row) {
                        return tablesRecordHistory (val, type, row);
                    }                      
                }, {
                    "responsivePriority": 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        //debugger;
                        return RH_DEF_SITUACAO_TRADS.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DSR_LINGUA": {
                        required: true,
                    },
                    "DT_INI": {
                        required: true,
                        dateISO: true,
                    },
                    "DSP_TRAD": {
                        required: true,
                        maxlength: 240,
                    },
                    "DSR_TRAD": {
                        required: true,
                        maxlength: 240,
                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                    "DT_FIM": {
                        dateISO: true,
                        dateEqOrNextThan: "DT_INI",
                    }
                },
                "messages": {
                    "DT_FIM": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        RH_DEF_SITUACAO_TRADS = new QuadTable();
        RH_DEF_SITUACAO_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsRH_DEF_SITUACAO_TRADS));
        //END Situações Trads
        
        //Categorias Profissionais Internas
        var optionRH_DEF_CATEG_PROF_INTERNAS = {
            "tableId": "RH_DEF_CATEG_PROF_INTERNAS",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_professional_internal_category; ?>",
            "table": "RH_DEF_CATEG_PROF_INTERNAS", 
            "pk": {
                "primary": {
                    "CD_CATG_PROF_INTERNA": {"type": "varchar"}
                }
            },
            "crudOnMasterInactive": {
                "condition": "data.ACTIVO !== 'S' ",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },                    
            "detailsObjects": ['RH_DEF_CATEG_PROF_INT_TRADS'],
            "order_by": "CD_CATG_PROF_INTERNA",
            "scrollY": "238", //"390", 
            "recordBundle": 10,
            "pageLenght": 10, 
            "responsive": true,
            "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "className": "control toBottom toCenter",
                    "width": "1%",
                    "defaultContent": ''                    
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'CD_CATG_PROF_INTERNA',
                    "name": 'CD_CATG_PROF_INTERNA',
                    "className": "visibleColumn",                   
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_CATG_PROF_INTERNA',
                    "name": 'DSP_CATG_PROF_INTERNA',
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_CATG_PROF_INTERNA',
                    "name": 'DSR_CATG_PROF_INTERNA',                    
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 5, 
                    "title": "<?php echo mb_strtoupper($ui_active, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_active; ?>", //Editor
                    "data": 'ACTIVO',
                    "name": 'ACTIVO',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_SIM_NAO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    } 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'INSERTED_BY',
                    "name": 'INSERTED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INSERTED',
                    "name": 'DT_INSERTED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CHANGED_BY',
                    "name": 'CHANGED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_UPDATED',
                    "name": 'DT_UPDATED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions, 'UTF-8'); ?>" + '</span>',
                    "label": '',
                    "data":  null,
                    "name": 'RECORD_HISTORY',
                    "type": "hidden",
                    "className": "none visibleColumn",
                    "render": function (val, type, row) {
                        return tablesRecordHistory (val, type, row);
                    }                      
                }, {
                    "responsivePriority": 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        //debugger;
                        return RH_DEF_CATEG_PROF_INTERNAS.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "CD_CATG_PROF_INTERNA": {
                        required: true,
                        maxlength: 10
                    },
                    "DSP_CATG_PROF_INTERNA": {
                        required: true,
                        maxlength: 80,
                    },
                    "DSR_CATG_PROF_INTERNA": {
                        required: false,
                        maxlength: 40,
                    },
                    "ACTIVO": {
                        required: true
                    }
                }
            }
        };
        RH_DEF_CATEG_PROF_INTERNAS = new QuadTable();
        RH_DEF_CATEG_PROF_INTERNAS.initTable( $.extend({}, datatable_instance_defaults, optionRH_DEF_CATEG_PROF_INTERNAS) );
        //END Categorias Profissionais Internas

        //Categorias Profissionais Internas Trads
        var optionsRH_DEF_CATEG_PROF_INT_TRADS = {
            "tableId": "RH_DEF_CATEG_PROF_INT_TRADS",
            "table": "RH_DEF_CATEG_PROF_INT_TRADS",
            "pk": {
                "primary": {
                    "CD_CATG_PROF_INTERNA": {"type": "varchar"},                      
                    "CD_LINGUA": {"type": "number"},                    
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "RH_DEF_CATEG_PROF_INTERNAS": {
                    "CD_CATG_PROF_INTERNA": "CD_CATG_PROF_INTERNA",
                    "DT_INI_PT": "DT_INI_PT"
                }
            },
            "order_by": "CD_LINGUA, DT_INI DESC",
            "recordBundle": 4, 
            "pageLenght": 4, 
            "scrollY": "150",
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "className": "control toBottom toCenter",
                    "width": "1%",
                    "defaultContent": ''  
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_CATG_PROF_INTERNA',
                    "name": 'CD_CATG_PROF_INTERNA',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_LINGUA',
                    "name": 'CD_LINGUA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 2,
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_language, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_language; ?>",
                    "data": 'DSR_LINGUA',
                    "name": 'DSR_LINGUA',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "dependent-group": "LINGUAS",
                        "dependent-level": 1,
                        "data-db-name": 'A.CD_LINGUA',
                        "decodeFromTable": 'DG_LINGUAS_ESTRANGEIRAS A',
                        "class": "form-control complexList chosen", 
                        "desigColumn": "A.DSR_LINGUA", 
                        "orderBy": "A.NR_ORDEM, A.CD_LINGUA",
                        "filter": {
                            "create": " AND A.ATIVO = 'S'", //On-New-Record
                            "edit": " AND A.ATIVO = 'S'", //On-Edit-Record
                        }
                    }
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI',
                    "name": 'DT_INI',
                    "datatype": 'date',
                    "def": "1900-01-01",
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DSP_TRAD',
                    "name": 'DSP_TRAD',                    
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_TRAD',
                    "name": 'DSR_TRAD',
                    "className": "visibleColumn",
                }, {
                    "title": "<?php echo mb_strtoupper($ui_description, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DESCRICAO',
                    "name": 'DESCRICAO',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 335px;",
                    }                                      
                }, {
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM',
                    "name": 'DT_FIM',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'INSERTED_BY',
                    "name": 'INSERTED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INSERTED',
                    "name": 'DT_INSERTED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CHANGED_BY',
                    "name": 'CHANGED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_UPDATED',
                    "name": 'DT_UPDATED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions, 'UTF-8'); ?>" + '</span>',
                    "label": '',
                    "data":  null,
                    "name": 'RECORD_HISTORY',
                    "type": "hidden",
                    "className": "none visibleColumn",
                    "render": function (val, type, row) {
                        return tablesRecordHistory (val, type, row);
                    }                      
                }, {
                    "responsivePriority": 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        //debugger;
                        return RH_DEF_CATEG_PROF_INT_TRADS.crudButtons(true,true,true);
                    }
                }
            ],
            validations: {
                rules: {
                    DSR_LINGUA: {
                        required: true,
                    },
                    DT_INI: {
                        required: true,
                        dateISO: true,
                    },
                    DSP_TRAD: {
                        required: true,
                        maxlength: 240,
                    },
                    DSR_TRAD: {
                        required: true,
                        maxlength: 240,
                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                    "DT_FIM": {
                        dateISO: true,
                        dateEqOrNextThan: "DT_INI",
                    }
                },
                "messages": {
                    "DT_FIM": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        RH_DEF_CATEG_PROF_INT_TRADS = new QuadTable();
        RH_DEF_CATEG_PROF_INT_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsRH_DEF_CATEG_PROF_INT_TRADS));
        //END Categorias Profissionais Internas Trads
   
        //Funções Internas
        var optionRH_DEF_FUNCOES_INTERNAS = {
            "tableId": "RH_DEF_FUNCOES_INTERNAS",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_internal_function; ?>",
            "table": "RH_DEF_FUNCOES_INTERNAS", 
            "pk": {
                "primary": {
                    "CD_CATG_PROF_INTERNA": {"type": "varchar"}
                }
            },
            "crudOnMasterInactive": {
                "condition": "data.ACTIVO !== 'S' ",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },                    
            "detailsObjects": ['RH_DEF_FUNC_INT_TRADS'],
            "order_by": "CD_FUNC_INTERNA",
            "scrollY": "238", //"390", 
            "recordBundle": 10,
            "pageLenght": 10, 
            "responsive": true,
            "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "className": "control toBottom toCenter",
                    "width": "1%",
                    "defaultContent": ''                    
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'CD_FUNC_INTERNA',
                    "name": 'CD_FUNC_INTERNA',
                    "className": "visibleColumn",                   
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_FUNC_INTERNA',
                    "name": 'DSP_FUNC_INTERNA',
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_FUNC_INTERNA',
                    "name": 'DSR_FUNC_INTERNA',                    
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 5, 
                    "title": "<?php echo mb_strtoupper($ui_active, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_active; ?>", //Editor
                    "data": 'ACTIVO',
                    "name": 'ACTIVO',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_SIM_NAO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    } 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'INSERTED_BY',
                    "name": 'INSERTED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INSERTED',
                    "name": 'DT_INSERTED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CHANGED_BY',
                    "name": 'CHANGED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_UPDATED',
                    "name": 'DT_UPDATED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions, 'UTF-8'); ?>" + '</span>',
                    "label": '',
                    "data":  null,
                    "name": 'RECORD_HISTORY',
                    "type": "hidden",
                    "className": "none visibleColumn",
                    "render": function (val, type, row) {
                        return tablesRecordHistory (val, type, row);
                    }                       
                }, {
                    "responsivePriority": 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        //debugger;
                        return RH_DEF_FUNCOES_INTERNAS.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "CD_FUNC_INTERNA": {
                        required: true,
                        maxlength: 5
                    },
                    "DSP_FUNC_INTERNA": {
                        required: true,
                        maxlength: 40,
                    },
                    "DSR_FUNC_INTERNA": {
                        required: false,
                        maxlength: 25,
                    },
                    "ACTIVO": {
                        required: true
                    }
                }
            }
        };
        RH_DEF_FUNCOES_INTERNAS = new QuadTable();
        RH_DEF_FUNCOES_INTERNAS.initTable( $.extend({}, datatable_instance_defaults, optionRH_DEF_FUNCOES_INTERNAS) );
        //END Funções Internas
        
        //Funções Internas TRADS
        var optionsRH_DEF_FUNC_INT_TRADS = {
            "tableId": "RH_DEF_FUNC_INT_TRADS",
            "table": "RH_DEF_FUNC_INT_TRADS",
            "pk": {
                "primary": {
                    "CD_FUNC_INTERNA": {"type": "varchar"},                      
                    "CD_LINGUA": {"type": "number"},                    
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "RH_DEF_FUNCOES_INTERNAS": {
                    "CD_FUNC_INTERNA": "CD_FUNC_INTERNA"
                }
            },
            "order_by": "CD_LINGUA, DT_INI DESC",
            "recordBundle": 4, 
            "pageLenght": 4, 
            "scrollY": "150",
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "className": "control toBottom toCenter",
                    "width": "1%",
                    "defaultContent": ''  
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_FUNC_INTERNA',
                    "name": 'CD_FUNC_INTERNA',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_LINGUA',
                    "name": 'CD_LINGUA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 2,
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_language, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_language; ?>",
                    "data": 'DSR_LINGUA',
                    "name": 'DSR_LINGUA',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "dependent-group": "LINGUAS",
                        "dependent-level": 1,
                        "data-db-name": 'A.CD_LINGUA',
                        "decodeFromTable": 'DG_LINGUAS_ESTRANGEIRAS A',
                        "class": "form-control complexList chosen", 
                        "desigColumn": "A.DSR_LINGUA", 
                        "orderBy": "A.NR_ORDEM, A.CD_LINGUA",
                        "filter": {
                            "create": " AND A.ATIVO = 'S'", //On-New-Record
                            "edit": " AND A.ATIVO = 'S'", //On-Edit-Record
                        }
                    }
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI',
                    "name": 'DT_INI',
                    "datatype": 'date',
                    "def": "1900-01-01",
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DSP_TRAD',
                    "name": 'DSP_TRAD',                    
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_TRAD',
                    "name": 'DSR_TRAD',
                    "className": "visibleColumn",
                }, {
                    "title": "<?php echo mb_strtoupper($ui_description, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DESCRICAO',
                    "name": 'DESCRICAO',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 335px;",
                    }                                      
                }, {
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM',
                    "name": 'DT_FIM',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'INSERTED_BY',
                "name": 'INSERTED_BY',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'DT_INSERTED',
                "name": 'DT_INSERTED',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'CHANGED_BY',
                "name": 'CHANGED_BY',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'DT_UPDATED',
                "name": 'DT_UPDATED',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions, 'UTF-8'); ?>" + '</span>',
                "label": '',
                "data":  null,
                "name": 'RECORD_HISTORY',
                "type": "hidden",
                "className": "none visibleColumn",
                "render": function (val, type, row) {
                    return tablesRecordHistory (val, type, row);
                }                        
                }, {
                    "responsivePriority": 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        //debugger;
                        return RH_DEF_FUNC_INT_TRADS.crudButtons(true,true,true);
                    }
                }
            ],
            validations: {
                rules: {
                    DSR_LINGUA: {
                        required: true,
                    },
                    DT_INI: {
                        required: true,
                        dateISO: true,
                    },
                    DSP_TRAD: {
                        required: true,
                        maxlength: 240,
                    },
                    DSR_TRAD: {
                        required: true,
                        maxlength: 240,
                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                    "DT_FIM": {
                        dateISO: true,
                        dateEqOrNextThan: "DT_INI",
                    }
                },
                "messages": {
                    "DT_FIM": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        RH_DEF_FUNC_INT_TRADS = new QuadTable();
        RH_DEF_FUNC_INT_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsRH_DEF_FUNC_INT_TRADS));
        //END Funções Internas TRADS
        
        //Grupos
        var optionRH_DEF_GRUPOS = {
            "tableId": "RH_DEF_GRUPOS",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_group; ?>",
            "table": "RH_DEF_GRUPOS", 
            "pk": {
                "primary": {
                    "CD_GRUPO": {"type": "varchar"}
                }
            },
            "crudOnMasterInactive": {
                "condition": "data.ACTIVO !== 'S' ",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },                    
            "detailsObjects": ['RH_DEF_GRUPO_TRADS'],
            "order_by": "CD_GRUPO",
            "scrollY": "238", //"390", 
            "recordBundle": 10,
            "pageLenght": 10, 
            "responsive": true,
            "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "className": "control toBottom toCenter",
                    "width": "1%",
                    "defaultContent": ''                    
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'CD_GRUPO',
                    "name": 'CD_GRUPO',
                    "className": "visibleColumn",                   
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_GRUPO',
                    "name": 'DSP_GRUPO',
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_GRUPO',
                    "name": 'DSR_GRUPO',                    
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 5, 
                    "title": "<?php echo mb_strtoupper($ui_active, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_active; ?>", //Editor
                    "data": 'ACTIVO',
                    "name": 'ACTIVO',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_SIM_NAO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    } 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'INSERTED_BY',
                    "name": 'INSERTED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INSERTED',
                    "name": 'DT_INSERTED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CHANGED_BY',
                    "name": 'CHANGED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_UPDATED',
                    "name": 'DT_UPDATED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions, 'UTF-8'); ?>" + '</span>',
                    "label": '',
                    "data":  null,
                    "name": 'RECORD_HISTORY',
                    "type": "hidden",
                    "className": "none visibleColumn",
                    "render": function (val, type, row) {
                        return tablesRecordHistory (val, type, row);
                    }                       
                }, {
                    "responsivePriority": 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        //debugger;
                        return RH_DEF_GRUPOS.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "CD_GRUPO": {
                        required: true,
                        maxlength: 5
                    },
                    "DSP_GRUPO": {
                        required: true,
                        maxlength: 40,
                    },
                    "DSR_GRUPO": {
                        required: false,
                        maxlength: 25,
                    },
                    "ACTIVO": {
                        required: true
                    }
                }
            }
        };
        RH_DEF_GRUPOS = new QuadTable();
        RH_DEF_GRUPOS.initTable( $.extend({}, datatable_instance_defaults, optionRH_DEF_GRUPOS) );
        //END Grupos
        
        //Grupos Trads
        var optionsRH_DEF_GRUPO_TRADS = {
            "tableId": "RH_DEF_GRUPO_TRADS",
            "table": "RH_DEF_GRUPO_TRADS",
            "pk": {
                "primary": {
                    "CD_GRUPO": {"type": "varchar"},                      
                    "CD_LINGUA": {"type": "number"},                    
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "RH_DEF_GRUPOS": {
                    "CD_GRUPO": "CD_GRUPO"
                }
            },
            "order_by": "CD_LINGUA, DT_INI DESC",
            "recordBundle": 4, 
            "pageLenght": 4, 
            "scrollY": "150",
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "className": "control toBottom toCenter",
                    "width": "1%",
                    "defaultContent": ''  
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_GRUPO',
                    "name": 'CD_GRUPO',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_LINGUA',
                    "name": 'CD_LINGUA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 2,
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_language, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_language; ?>",
                    "data": 'DSR_LINGUA',
                    "name": 'DSR_LINGUA',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "dependent-group": "LINGUAS",
                        "dependent-level": 1,
                        "data-db-name": 'A.CD_LINGUA',
                        "decodeFromTable": 'DG_LINGUAS_ESTRANGEIRAS A',
                        "class": "form-control complexList chosen", 
                        "desigColumn": "A.DSR_LINGUA", 
                        "orderBy": "A.NR_ORDEM, A.CD_LINGUA",
                        "filter": {
                            "create": " AND A.ATIVO = 'S'", //On-New-Record
                            "edit": " AND A.ATIVO = 'S'", //On-Edit-Record
                        }
                    }
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI',
                    "name": 'DT_INI',
                    "datatype": 'date',
                    "def": "1900-01-01",
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DSP_TRAD',
                    "name": 'DSP_TRAD',                    
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_TRAD',
                    "name": 'DSR_TRAD',
                    "className": "visibleColumn",
                }, {
                    "title": "<?php echo mb_strtoupper($ui_description, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DESCRICAO',
                    "name": 'DESCRICAO',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 335px;",
                    }                                      
                }, {
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM',
                    "name": 'DT_FIM',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'INSERTED_BY',
                    "name": 'INSERTED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INSERTED',
                    "name": 'DT_INSERTED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CHANGED_BY',
                    "name": 'CHANGED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_UPDATED',
                    "name": 'DT_UPDATED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions, 'UTF-8'); ?>" + '</span>',
                    "label": '',
                    "data":  null,
                    "name": 'RECORD_HISTORY',
                    "type": "hidden",
                    "className": "none visibleColumn",
                    "render": function (val, type, row) {
                        return tablesRecordHistory (val, type, row);
                    }                        
                }, {
                    "responsivePriority": 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        //debugger;
                        return RH_DEF_GRUPO_TRADS.crudButtons(true,true,true);
                    }
                }
            ],
            validations: {
                rules: {
                    DSR_LINGUA: {
                        required: true,
                    },
                    DT_INI: {
                        required: true,
                        dateISO: true,
                    },
                    DSP_TRAD: {
                        required: true,
                        maxlength: 240,
                    },
                    DSR_TRAD: {
                        required: true,
                        maxlength: 240,
                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                    "DT_FIM": {
                        dateISO: true,
                        dateEqOrNextThan: "DT_INI",
                    }
                },
                "messages": {
                    "DT_FIM": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        RH_DEF_GRUPO_TRADS = new QuadTable();
        RH_DEF_GRUPO_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsRH_DEF_GRUPO_TRADS));
        //END Grupos Trads        
        
        //Níveis
        var optionRH_DEF_NIVEIS = {
            "tableId": "RH_DEF_NIVEIS",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_level; ?>",
            "table": "RH_DEF_NIVEIS", 
            "pk": {
                "primary": {
                    "CD_NIVEL": {"type": "varchar"}
                }
            },
            "crudOnMasterInactive": {
                "condition": "data.ACTIVO !== 'S' ",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },                    
            "detailsObjects": ['RH_DEF_NIVEL_TRADS'],
            "order_by": "CD_NIVEL",
            "scrollY": "238", //"390", 
            "recordBundle": 10,
            "pageLenght": 10, 
            "responsive": true,
            "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "className": "control toBottom toCenter",
                    "width": "1%",
                    "defaultContent": ''                    
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'CD_NIVEL',
                    "name": 'CD_NIVEL',
                    "className": "visibleColumn",                   
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_NIVEL',
                    "name": 'DSP_NIVEL',
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_NIVEL',
                    "name": 'DSR_NIVEL',                    
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 5, 
                    "title": "<?php echo mb_strtoupper($ui_active, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_active; ?>", //Editor
                    "data": 'ACTIVO',
                    "name": 'ACTIVO',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_SIM_NAO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    } 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'INSERTED_BY',
                    "name": 'INSERTED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INSERTED',
                    "name": 'DT_INSERTED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CHANGED_BY',
                    "name": 'CHANGED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_UPDATED',
                    "name": 'DT_UPDATED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions, 'UTF-8'); ?>" + '</span>',
                    "label": '',
                    "data":  null,
                    "name": 'RECORD_HISTORY',
                    "type": "hidden",
                    "className": "none visibleColumn",
                    "render": function (val, type, row) {
                        return tablesRecordHistory (val, type, row);
                    }                    
                }, {
                    "responsivePriority": 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        //debugger;
                        return RH_DEF_NIVEIS.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "CD_NIVEL": {
                        required: true,
                        maxlength: 5
                    },
                    "DSP_NIVEL": {
                        required: true,
                        maxlength: 40,
                    },
                    "DSR_NIVEL": {
                        required: false,
                        maxlength: 25,
                    },
                    "ACTIVO": {
                        required: true
                    }
                }
            }
        };
        RH_DEF_NIVEIS = new QuadTable();
        RH_DEF_NIVEIS.initTable( $.extend({}, datatable_instance_defaults, optionRH_DEF_NIVEIS) );
        //END Níveis
        
        //Níveis Trads
        var optionsRH_DEF_NIVEL_TRADS = {
            "tableId": "RH_DEF_NIVEL_TRADS",
            "table": "RH_DEF_NIVEL_TRADS",
            "pk": {
                "primary": {
                    "CD_NVEL": {"type": "varchar"},                      
                    "CD_LINGUA": {"type": "number"},                    
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "RH_DEF_NIVEIS": {
                    "CD_NIVEL": "CD_NIVEL"
                }
            },
            "order_by": "CD_LINGUA, DT_INI DESC",
            "recordBundle": 4, 
            "pageLenght": 4, 
            "scrollY": "150",
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "className": "control toBottom toCenter",
                    "width": "1%",
                    "defaultContent": ''  
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_NIVEL',
                    "name": 'CD_NIVEL',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_LINGUA',
                    "name": 'CD_LINGUA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 2,
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_language, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_language; ?>",
                    "data": 'DSR_LINGUA',
                    "name": 'DSR_LINGUA',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "dependent-group": "LINGUAS",
                        "dependent-level": 1,
                        "data-db-name": 'A.CD_LINGUA',
                        "decodeFromTable": 'DG_LINGUAS_ESTRANGEIRAS A',
                        "class": "form-control complexList chosen", 
                        "desigColumn": "A.DSR_LINGUA", 
                        "orderBy": "A.NR_ORDEM, A.CD_LINGUA",
                        "filter": {
                            "create": " AND A.ATIVO = 'S'", //On-New-Record
                            "edit": " AND A.ATIVO = 'S'", //On-Edit-Record
                        }
                    }
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI',
                    "name": 'DT_INI',
                    "datatype": 'date',
                    "def": "1900-01-01",
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DSP_TRAD',
                    "name": 'DSP_TRAD',                    
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_TRAD',
                    "name": 'DSR_TRAD',
                    "className": "visibleColumn",
                }, {
                    "title": "<?php echo mb_strtoupper($ui_description, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DESCRICAO',
                    "name": 'DESCRICAO',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 335px;",
                    }                                      
                }, {
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM',
                    "name": 'DT_FIM',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'INSERTED_BY',
                    "name": 'INSERTED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INSERTED',
                    "name": 'DT_INSERTED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CHANGED_BY',
                    "name": 'CHANGED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_UPDATED',
                    "name": 'DT_UPDATED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions, 'UTF-8'); ?>" + '</span>',
                    "label": '',
                    "data":  null,
                    "name": 'RECORD_HISTORY',
                    "type": "hidden",
                    "className": "none visibleColumn",
                    "render": function (val, type, row) {
                        return tablesRecordHistory (val, type, row);
                    }                      
                }, {
                    "responsivePriority": 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        //debugger;
                        return RH_DEF_NIVEL_TRADS.crudButtons(true,true,true);
                    }
                }
            ],
            validations: {
                rules: {
                    DSR_LINGUA: {
                        required: true,
                    },
                    DT_INI: {
                        required: true,
                        dateISO: true,
                    },
                    DSP_TRAD: {
                        required: true,
                        maxlength: 240,
                    },
                    DSR_TRAD: {
                        required: true,
                        maxlength: 240,
                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                    "DT_FIM": {
                        dateISO: true,
                        dateEqOrNextThan: "DT_INI",
                    }
                },
                "messages": {
                    "DT_FIM": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        RH_DEF_NIVEL_TRADS = new QuadTable();
        RH_DEF_NIVEL_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsRH_DEF_NIVEL_TRADS));
        //END Níveis Trads        
        
        //Jobs 
        var optionDG_JOBS = {
            "tableId": "DG_JOBS",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_job; ?>",
            "table": "DG_JOBS", 
            "pk": {
                "primary": {
                    "CD_JOB": {"type": "varchar"},
                    "DT_INI_JOB": {"type": "date"}
                }
            },
            "crudOnMasterInactive": {
                "condition": "data.DT_FIM !== null ",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },                    
            "detailsObjects": ['DG_JOBS_TRADS'],
            "order_by": "CD_JOB",
            "scrollY": "238", //"390", 
            "recordBundle": 10,
            "pageLenght": 10, 
            "responsive": true,
            "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "className": "control toBottom toCenter",
                    "width": "1%",
                    "defaultContent": ''                    
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'CD_JOB',
                    "name": 'CD_JOB',
                    "className": "visibleColumn",                   
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_JOB',
                    "name": 'DSP_JOB',
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_JOB',
                    "name": 'DSR_JOB',                    
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 5, 
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_begin_date; ?>",
                    "data": 'DT_INI_JOB',
                    "name": 'DT_INI_JOB',
                    "datatype": 'date',
                    "def": "1900-01-01", //default value
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM',
                    "name": 'DT_FIM',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker", 
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'INSERTED_BY',
                    "name": 'INSERTED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INSERTED',
                    "name": 'DT_INSERTED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CHANGED_BY',
                    "name": 'CHANGED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_UPDATED',
                    "name": 'DT_UPDATED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions, 'UTF-8'); ?>" + '</span>',
                    "label": '',
                    "data":  null,
                    "name": 'RECORD_HISTORY',
                    "type": "hidden",
                    "className": "none visibleColumn",
                    "render": function (val, type, row) {
                        return tablesRecordHistory (val, type, row);
                    }                       
                }, {
                    "responsivePriority": 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        //debugger;
                        return DG_JOBS.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "CD_JOB": {
                        required: true,
                        maxlength: 8
                    },
                    "DSP_JOB": {
                        required: true,
                        maxlength: 80,
                    },
                    "DSR_JOB": {
                        required: false,
                        maxlength: 25,
                    },
                    "DT_INI_JOB": {
                        required: true,
                        dateISO: true
                    },
                    "DT_FIM": {
                        dateISO: true,
                        dateNextThan: 'DT_INI_JOB'
                    },                    
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                    "DT_FIM": {
                        dateNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        DG_JOBS = new QuadTable();
        DG_JOBS.initTable( $.extend({}, datatable_instance_defaults, optionDG_JOBS) );
        //END Jobs
        
        //Níveis Trads
        var optionsDG_JOBS_TRADS = {
            "tableId": "DG_JOBS_TRADS",
            "table": "DG_JOBS_TRADS",
            "pk": {
                "primary": {
                    "CD_JOB": {"type": "varchar"},
                    "DT_INI_JOB": {"type": "date"},                    
                    "CD_LINGUA": {"type": "number"},                    
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "DG_JOBS": {
                    "CD_JOB": "CD_JOB"
                }
            },
            "order_by": "CD_LINGUA, DT_INI DESC",
            "recordBundle": 4, 
            "pageLenght": 4, 
            "scrollY": "150",
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "className": "control toBottom toCenter",
                    "width": "1%",
                    "defaultContent": ''  
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_JOB',
                    "name": 'CD_JOB',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables

                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_JOB',
                    "name": 'DT_INI_JOB',         
                    "datatype": "date",
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_LINGUA',
                    "name": 'CD_LINGUA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 2,
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_language, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_language; ?>",
                    "data": 'DSR_LINGUA',
                    "name": 'DSR_LINGUA',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "dependent-group": "LINGUAS",
                        "dependent-level": 1,
                        "data-db-name": 'A.CD_LINGUA',
                        "decodeFromTable": 'DG_LINGUAS_ESTRANGEIRAS A',
                        "class": "form-control complexList chosen", 
                        "desigColumn": "A.DSR_LINGUA", 
                        "orderBy": "A.NR_ORDEM, A.CD_LINGUA",
                        "filter": {
                            "create": " AND A.ATIVO = 'S'", //On-New-Record
                            "edit": " AND A.ATIVO = 'S'", //On-Edit-Record
                        }
                    }
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI',
                    "name": 'DT_INI',
                    "datatype": 'date',
                    "def": "1900-01-01",
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DSP_TRAD',
                    "name": 'DSP_TRAD',                    
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_TRAD',
                    "name": 'DSR_TRAD',
                    "className": "visibleColumn",
                }, {
                    "title": "<?php echo mb_strtoupper($ui_description, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DESCRICAO',
                    "name": 'DESCRICAO',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 335px;",
                    }                                      
                }, {
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM',
                    "name": 'DT_FIM',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'INSERTED_BY',
                    "name": 'INSERTED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INSERTED',
                    "name": 'DT_INSERTED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CHANGED_BY',
                    "name": 'CHANGED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_UPDATED',
                    "name": 'DT_UPDATED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions, 'UTF-8'); ?>" + '</span>',
                    "label": '',
                    "data":  null,
                    "name": 'RECORD_HISTORY',
                    "type": "hidden",
                    "className": "none visibleColumn",
                    "render": function (val, type, row) {
                        return tablesRecordHistory (val, type, row);
                    }                       
                }, {
                    "responsivePriority": 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        //debugger;
                        return DG_JOBS_TRADS.crudButtons(true,true,true);
                    }
                }
            ],
            validations: {
                rules: {
                    "DSR_LINGUA": {
                        required: true,
                    },
                    "DT_INI": {
                        required: true,
                        dateISO: true,
                    },
                    "DSP_TRAD": {
                        required: true,
                        maxlength: 240,
                    },
                    "DSR_TRAD": {
                        required: true,
                        maxlength: 240,
                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                    "DT_FIM": {
                        dateISO: true,
                        dateEqOrNextThan: "DT_INI",
                    }
                },
                "messages": {
                    "DT_FIM": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        DG_JOBS_TRADS = new QuadTable();
        DG_JOBS_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsDG_JOBS_TRADS));
        //END Níveis Trads    
        
        //Documentos
        var optionDG_DOCUMENTOS = {
            "tableId": "DG_DOCUMENTOS",
            "table": "DG_DOCUMENTOS", 
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_document; ?>",
            "pk": {
                "primary": {
                    "CD_DOC_ID": {"type": "varchar"}
                }
            },
            "crudOnMasterInactive": {
                "condition": "data.ACTIVO !== 'S' ",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },                    
            "detailsObjects": ['DG_DOCUMENTO_TRADS'],
            "order_by": "CD_DOC_ID",
            "scrollY": "238", //"390", 
            "recordBundle": 10,
            "pageLenght": 10, 
            "responsive": true,
            "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "className": "control toBottom toCenter",
                    "width": "1%",
                    "defaultContent": ''                    
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'CD_DOC_ID',
                    "name": 'CD_DOC_ID',
                    "className": "visibleColumn",                   
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_DOC_ID',
                    "name": 'DSP_DOC_ID',
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_DOC_ID',
                    "name": 'DSR_DOC_ID',                    
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 5, 
                    "title": "<?php echo mb_strtoupper($ui_type, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_type; ?>", //Editor
                    "data": 'TP_DOCUMENTO',
                    "name": 'TP_DOCUMENTO',
                    "type": "select",
                    "def": "Z",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_DOCUMENTOS.TP_DOCUMENTO',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_DOCUMENTOS.TP_DOCUMENTO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    } 

                }, {
                    "title": "<?php echo mb_strtoupper($ui_warning_days, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_warning_days; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_prior_notice_days_before_end_dt; ?>",
                    "data": 'DIAS_AVISO_PREV',
                    "name": 'DIAS_AVISO_PREV',
                    "className": "none visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 15%;"
                    } 
                }, {
                    "title": "<?php echo mb_strtoupper($ui_dates_required, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_dates_required; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_docs_dates_required; ?>",
                    "data": 'CHECK_DATES',
                    "name": 'CHECK_DATES',
                    "type": "select",
                    "def": "N",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_SIM_NAO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    } 
                }, {
                    "responsivePriority": 6, 
                    "title": "<?php echo mb_strtoupper($ui_active, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_active; ?>", //Editor
                    "data": 'ACTIVO',
                    "name": 'ACTIVO',
                    "type": "select",
                    "def": "N",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_SIM_NAO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    } 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'INSERTED_BY',
                    "name": 'INSERTED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INSERTED',
                    "name": 'DT_INSERTED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CHANGED_BY',
                    "name": 'CHANGED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_UPDATED',
                    "name": 'DT_UPDATED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions, 'UTF-8'); ?>" + '</span>',
                    "label": '',
                    "data":  null,
                    "name": 'RECORD_HISTORY',
                    "type": "hidden",
                    "className": "none visibleColumn",
                    "render": function (val, type, row) {
                        return tablesRecordHistory (val, type, row);
                    }                      
                }, {
                    "responsivePriority": 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        //debugger;
                        return DG_DOCUMENTOS.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "CD_DOC_ID": {
                        required: true,
                        maxlength: 4
                    },
                    "DSP_DOC_ID": {
                        required: true,
                        maxlength: 40
                    },
                    "DSR_DOC_ID": {
                        required: false,
                        maxlength: 25
                    },
                    "TP_DOCUMENTO": {
                        required: true
                    },
                    "ACTIVO": {
                        required: true
                    },
                    "DIAS_AVISO_PREV": {
                        integer: true,
                        maxlength: 3
                    }
                }
            }
        };
        DG_DOCUMENTOS = new QuadTable();
        DG_DOCUMENTOS.initTable( $.extend({}, datatable_instance_defaults, optionDG_DOCUMENTOS) );
        //END Documentos
        
        //Documentos Trads
        var optionsDG_DOCUMENTO_TRADS = {
            "tableId": "DG_DOCUMENTO_TRADS",
            "table": "DG_DOCUMENTO_TRADS",
            "pk": {
                "primary": {
                    "CD_DOC_ID": {"type": "varchar"},                      
                    "CD_LINGUA": {"type": "number"},                    
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "DG_DOCUMENTOS": {
                    "CD_DOC_ID": "CD_DOC_ID"
                }
            },
            "order_by": "CD_LINGUA, DT_INI DESC",
            "recordBundle": 4, 
            "pageLenght": 4, 
            "scrollY": "150",
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "className": "control toBottom toCenter",
                    "width": "1%",
                    "defaultContent": ''  
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_DOC_ID',
                    "name": 'CD_DOC_ID',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_LINGUA',
                    "name": 'CD_LINGUA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 2,
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_language, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_language; ?>",
                    "data": 'DSR_LINGUA',
                    "name": 'DSR_LINGUA',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "dependent-group": "LINGUAS",
                        "dependent-level": 1,
                        "data-db-name": 'A.CD_LINGUA',
                        "decodeFromTable": 'DG_LINGUAS_ESTRANGEIRAS A',
                        "class": "form-control complexList chosen", 
                        "desigColumn": "A.DSR_LINGUA", 
                        "orderBy": "A.NR_ORDEM, A.CD_LINGUA",
                        "filter": {
                            "create": " AND A.ATIVO = 'S'", //On-New-Record
                            "edit": " AND A.ATIVO = 'S'", //On-Edit-Record
                        }
                    }
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI',
                    "name": 'DT_INI',
                    "datatype": 'date',
                    "def": "1900-01-01",
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DSP_TRAD',
                    "name": 'DSP_TRAD',                    
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_TRAD',
                    "name": 'DSR_TRAD',
                    "className": "visibleColumn",
                }, {
                    "title": "<?php echo mb_strtoupper($ui_description, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DESCRICAO',
                    "name": 'DESCRICAO',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 335px;",
                    }                                      
                }, {
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM',
                    "name": 'DT_FIM',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'INSERTED_BY',
                    "name": 'INSERTED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INSERTED',
                    "name": 'DT_INSERTED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CHANGED_BY',
                    "name": 'CHANGED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_UPDATED',
                    "name": 'DT_UPDATED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions, 'UTF-8'); ?>" + '</span>',
                    "label": '',
                    "data":  null,
                    "name": 'RECORD_HISTORY',
                    "type": "hidden",
                    "className": "none visibleColumn",
                    "render": function (val, type, row) {
                        return tablesRecordHistory (val, type, row);
                    }                       
                }, {
                    "responsivePriority": 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        //debugger;
                        return DG_DOCUMENTO_TRADS.crudButtons(true,true,true);
                    }
                }
            ],
            validations: {
                rules: {
                    DSR_LINGUA: {
                        required: true,
                    },
                    DT_INI: {
                        required: true,
                        dateISO: true,
                    },
                    DSP_TRAD: {
                        required: true,
                        maxlength: 240,
                    },
                    DSR_TRAD: {
                        required: true,
                        maxlength: 240,
                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                    "DT_FIM": {
                        dateISO: true,
                        dateEqOrNextThan: "DT_INI",
                    }
                },
                "messages": {
                    "DT_FIM": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        DG_DOCUMENTO_TRADS = new QuadTable();
        DG_DOCUMENTO_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsDG_DOCUMENTO_TRADS));
        //END Documentos Trads
        
        //Habilitações Profissionais
        var optionRH_DEF_HAB_PROFISSIONAIS = {
            "tableId": "RH_DEF_HAB_PROFISSIONAIS",
            "table": "RH_DEF_HAB_PROFISSIONAIS", 
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_professional_qualification; ?>",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "CD_HAB_PROF": {"type": "varchar"},
                    "DT_INI_HAB_PROF": {"type": "date"}
                }
            },
            "crudOnMasterInactive": {
                "condition": "data.DT_FIM_HAB_PROF !== null",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },                    
            "detailsObjects": ['RH_DEF_HAB_PROF_TRADS'],
            "order_by": "CD_HAB_PROF",
            "scrollY": "238",
            "recordBundle": 10,
            "pageLenght": 10, 
            "responsive": true,
            "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "className": "control toBottom toCenter",
                    "width": "1%",
                    "defaultContent": ''     
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'EMPRESA',
                    "name": 'EMPRESA',
                    "type": "hidden",
                    "visible": false,
                    "className": "",  
                }, {
                    "responsivePriority": 2,
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_company, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_company; ?>",
                    "data": 'DSP_EMPRESA',
                    "name": 'DSP_EMPRESA',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "EMPRESA",
                        "dependent-level": 1,
                        "data-db-name": "A.EMPRESA",
                        "decodeFromTable": "DG_EMPRESAS A",
                        "desigColumn": "A.EMPRESA", 
                        "orderBy": "A.NR_ORDEM",
                        "class": "form-control complexList chosen"
                    }
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'CD_HAB_PROF',
                    "name": 'CD_HAB_PROF',
                    "className": "visibleColumn",                   
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_HAB_PROF',
                    "name": 'DSP_HAB_PROF',
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 5, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_HAB_PROF',
                    "name": 'DSR_HAB_PROF',                    
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 6,
                    "title": "<?php echo mb_strtoupper($ui_validity, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_validity; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_certification_validity_months; ?>",
                    "data": 'DURACAO',
                    "name": 'DURACAO',
                    "className": "none visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 15%;"
                    } 
                }, {
                    "responsivePriority": 7,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_HAB_PROF',
                    "name": 'DT_INI_HAB_PROF',
                    "datatype": 'date',
                    "def": "1900-01-01",
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }
                }, {
                    "responsivePriority": 8,
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM_HAB_PROF',
                    "name": 'DT_FIM_HAB_PROF',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_skills_assessment, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_skills_assessment; ?>", //Editor
                    //"fieldInfo": "<?php echo $hint_requires_previous_authorizarion; ?>",
                    "data": 'CONTEXTO',
                    "name": 'CONTEXTO',
                    "type": "select",
                    "className": "none visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'RH_DEF_HAB_PROFISSIONAIS.CONTEXTO',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['RH_DEF_HAB_PROFISSIONAIS.CONTEXTO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }             
               }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_EP',
                    "name": 'ID_EP',
                    "type": "hidden",
                    "visible": false,
                    "className": ""
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_EP',
                    "name": 'DT_INI_EP',
                    "type": "hidden",
                    "visible": false,
                    "datatype": 'date'                     
                }, {
                    "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                    "title": "<?php echo mb_strtoupper($ui_proficiency_scale, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_proficiency_scale; ?>",
                    "data": 'DSP_EP',
                    "name": 'DSP_EP',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                                        
                    "attr": {
                        "dependent-group": "PROFICIENCIA",
                        "dependent-level": 1,
                        "deferred": true,
                        "data-db-name": 'A.EMPRESA@A.ID_EP@A.DT_INI_EP',
                        "decodeFromTable": 'RH_DEF_ESCALAS_PROFICIENCIA A',
                        "desigColumn": "A.DSP_EP", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.                        
                        "orderBy": "A.EMPRESA,A.ID_EP,A.DT_INI_EP", //usado no complexList.php
                        "class": "form-control complexList chosen",
                        //"disabled": true, //Permite inibir o campo no Editor
                        //"whereClause": "",
                        "filter": {
                            "create": " AND A.DT_FIM_EP IS NULL AND A.EMPRESA = ':EMPRESA'", //On-New-Record
                            "edit": " AND A.DT_FIM_EP IS NULL AND A.EMPRESA = ':EMPRESA'", //On-Edit-Record
                        }
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_description, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DESCRICAO',
                    "name": 'DESCRICAO',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 335px;"
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'INSERTED_BY',
                    "name": 'INSERTED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INSERTED',
                    "name": 'DT_INSERTED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CHANGED_BY',
                    "name": 'CHANGED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_UPDATED',
                    "name": 'DT_UPDATED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions, 'UTF-8'); ?>" + '</span>',
                    "label": '',
                    "data":  null,
                    "name": 'RECORD_HISTORY',
                    "type": "hidden",
                    "className": "none visibleColumn",
                    "render": function (val, type, row) {
                        return tablesRecordHistory (val, type, row);
                    }                      
                }, {
                    "responsivePriority": 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        //debugger;
                        return RH_DEF_HAB_PROFISSIONAIS.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DSP_EMPRESA": {
                        required: true
                    },
                    "CD_HAB_PROF": {
                        required: true,
                        maxlength: 8
                    },
                    "DSP_HAB_PROF": {
                        required: true,
                        maxlength: 100
                    },
                    "DSR_HAB_PROF": {
                        required: false,
                        maxlength: 25
                    },
                    "DURACAO": {
                        integer: true,
                        maxlength: 10
                    }
                }
            }
        };
        RH_DEF_HAB_PROFISSIONAIS = new QuadTable();
        RH_DEF_HAB_PROFISSIONAIS.initTable( $.extend({}, datatable_instance_defaults, optionRH_DEF_HAB_PROFISSIONAIS) );
        //END Habilitações Profissionais
        
        //Habilitações Profissionais Trads
        var optionsRH_DEF_HAB_PROF_TRADS = {
            "tableId": "RH_DEF_HAB_PROF_TRADS",
            "table": "RH_DEF_HAB_PROF_TRADS",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"}, 
                    "CD_HAB_PROF": {"type": "varchar"},     
                    "DT_INI_HAB_PROF": {"type": "date"},
                    "CD_LINGUA": {"type": "number"},                    
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "RH_DEF_HAB_PROFISSIONAIS": {
                    "EMPRESA": "EMPRESA",
                    "CD_HAB_PROF": "CD_HAB_PROF",
                    "DT_INI_HAB_PROF": "DT_INI_HAB_PROF"
                }
            },
            "order_by": "CD_LINGUA, DT_INI DESC",
            "recordBundle": 4, 
            "pageLenght": 4, 
            "scrollY": "150",
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "className": "control toBottom toCenter",
                    "width": "1%",
                    "defaultContent": ''  
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'EMPRESA',
                    "name": 'EMPRESA',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_HAB_PROF',
                    "name": 'CD_HAB_PROF',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_HAB_PROF',
                    "name": 'DT_INI_HAB_PROF',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                    "datatype": "date"
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_LINGUA',
                    "name": 'CD_LINGUA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 2,
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_language, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_language; ?>",
                    "data": 'DSR_LINGUA',
                    "name": 'DSR_LINGUA',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "dependent-group": "LINGUAS",
                        "dependent-level": 1,
                        "data-db-name": 'A.CD_LINGUA',
                        "decodeFromTable": 'DG_LINGUAS_ESTRANGEIRAS A',
                        "class": "form-control complexList chosen", 
                        "desigColumn": "A.DSR_LINGUA", 
                        "orderBy": "A.NR_ORDEM, A.CD_LINGUA",
                        "filter": {
                            "create": " AND A.ATIVO = 'S'", //On-New-Record
                            "edit": " AND A.ATIVO = 'S'", //On-Edit-Record
                        }
                    }
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI',
                    "name": 'DT_INI',
                    "datatype": 'date',
                    "def": "1900-01-01",
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DSP_TRAD',
                    "name": 'DSP_TRAD',                    
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_TRAD',
                    "name": 'DSR_TRAD',
                    "className": "visibleColumn",
                }, {
                    "title": "<?php echo mb_strtoupper($ui_description, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DESCRICAO',
                    "name": 'DESCRICAO',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 335px;",
                    }                                      
                }, {
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM',
                    "name": 'DT_FIM',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'INSERTED_BY',
                    "name": 'INSERTED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INSERTED',
                    "name": 'DT_INSERTED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CHANGED_BY',
                    "name": 'CHANGED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_UPDATED',
                    "name": 'DT_UPDATED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions, 'UTF-8'); ?>" + '</span>',
                    "label": '',
                    "data":  null,
                    "name": 'RECORD_HISTORY',
                    "type": "hidden",
                    "className": "none visibleColumn",
                    "render": function (val, type, row) {
                        return tablesRecordHistory (val, type, row);
                    }                       
                }, {
                    "responsivePriority": 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        //debugger;
                        return RH_DEF_HAB_PROF_TRADS.crudButtons(true,true,true);
                    }
                }
            ],
            validations: {
                rules: {
                    DSR_LINGUA: {
                        required: true,
                    },
                    DT_INI: {
                        required: true,
                        dateISO: true,
                    },
                    DSP_TRAD: {
                        required: true,
                        maxlength: 240,
                    },
                    DSR_TRAD: {
                        required: true,
                        maxlength: 240,
                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                    "DT_FIM": {
                        dateISO: true,
                        dateEqOrNextThan: "DT_INI",
                    }
                },
                "messages": {
                    "DT_FIM": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        RH_DEF_HAB_PROF_TRADS = new QuadTable();
        RH_DEF_HAB_PROF_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsRH_DEF_HAB_PROF_TRADS));
        //END Habilitações Profissionais Trads
                
        //Events Definition
        if (1 === 1) {
            /* QUADFORMS :: Situações Continued :: DOUBLE-CLICK -> EDIT RECORD */
            $('#RH_DEF_SITUACOES_CONTINUED').dblclick(function() {
                var el = $("#RH_DEF_SITUACOES_CONTINUED").find("[data-form-action='edit']");  
                if (el.css('display') !== 'none' && (el.attr('disabled') === undefined || el.attr('disabled') === false) ) { //SÓ SE O BOTÃO ESTIVER VISÍVEL e ENABLED
                    el.trigger('click');
                }
            });
            
            //$('input.onoffswitch-checkbox').on('change', function () { -> DOESN't RUN IF NOT ON FIRST ACTIVE PAGE...
            $('input.onoffswitch-checkbox').on('click', function () {
                var el = $(this);
                if ( el.prop('checked') ) {
                    el.val('S');
                    el.prop("checked", true);
                } else {
                    el.val('N');
                    el.prop("checked", false);
                }
                //console.log( el.prop('checked') + " with value " + el.val() );
            });
            
        }     
        //END Events Definition     
        
        //Atributos Flexiveis
        var optionRH_DEF_FLEXFIELDS = {
            "tableId": "RH_DEF_FLEXFIELDS",
            "table": "RH_DEF_FLEXFIELDS", 
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_flexfield; ?>",
            "pk": {
                "primary": {
                    "CD_FF": {"type": "varchar"}
                }
            },
            "crudOnMasterInactive": {
                "condition": "data.ACTIVO === 'N'",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },                    
            "detailsObjects": ['RH_DEF_FLEXFIELD_TRADS'],
            "order_by": "NVL(NR_ORDEM,CD_FF)",
            "scrollY": "238",
            "recordBundle": 10,
            "pageLenght": 10, 
            "responsive": true,
            "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "className": "control toBottom toCenter",
                    "width": "1%",
                    "defaultContent": ''     
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'CD_FF',
                    "name": 'CD_FF',
                    "className": "visibleColumn",
                    "attr": {
                        "name": 'CD_FF'
                    } 
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_FF',
                    "name": 'DSP_FF',
                    "className": "visibleColumn"
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_context, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_context; ?>", //Editor                    
                    "data": 'CONTEXTO',
                    "name": 'CONTEXTO',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'RH_CTX_FLEXFIELD',  
                        "class": "form-control chosen"
                    }
                }, {
                    "responsivePriority": 5, 
                    "title": "<?php echo mb_strtoupper($ui_order_nr, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_order_nr; ?>", //Editor
                    "data": 'NR_ORDEM',
                    "name": 'NR_ORDEM',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 30%;"
                    } 
                }, {
                    "responsivePriority": 6, 
                    "title": "<?php echo mb_strtoupper($ui_scc_short, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_scc_short; ?>", //Editor                    
                    "data": 'SCC_ACTVO',
                    "name": 'SCC_ACTVO',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',  
                        "class": "form-control chosen"
                    }                
                }, {
                    "responsivePriority": 7, 
                    "title": "<?php echo mb_strtoupper($ui_active, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_active; ?>", //Editor                    
                    "data": 'ACTIVO',
                    "name": 'ACTIVO',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',  
                        "class": "form-control chosen"
                    }             
                }, {
                    "title": "<?php echo mb_strtoupper($ui_description, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DESCRICAO',
                    "name": 'DESCRICAO',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "name": 'DESCRICAO',
                        "style": "max-width: 335px",
                    }       
                }, {
                    "title": "<?php echo mb_strtoupper($ui_sql_code, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_sql_code; ?>", //Editor
                    "data": 'SQL_CODE',
                    "name": 'SQL_CODE',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 335px",
                    }                            
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DOMINIO',
                    "name": 'DOMINIO',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                
                }, {
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_domain, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_domain; ?>",
                    "data": 'DSP_LOV_FLEX',
                    "name": 'DSP_LOV_FLEX',
                    "type": "select",
                    "className": "none visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "LOV_FLEX",
                        "dependent-level": 1,
                        "data-db-name": "A.VALUE",
                        "distribute-value": "DOMINIO",
                        "decodeFromTable": "RH_LOV_FLEX A", 
                        "desigColumn": "A.LABEL", 
                        "orderBy": "A.VALUE",
                        "class": "form-control complexList chosen"
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'INSERTED_BY',
                    "name": 'INSERTED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INSERTED',
                    "name": 'DT_INSERTED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CHANGED_BY',
                    "name": 'CHANGED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_UPDATED',
                    "name": 'DT_UPDATED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions, 'UTF-8'); ?>" + '</span>',
                    "label": '',
                    "data":  null,
                    "name": 'RECORD_HISTORY',
                    "type": "hidden",
                    "className": "none visibleColumn",
                    "render": function (val, type, row) {
                        return tablesRecordHistory (val, type, row);
                    }                      
                }, {
                    "responsivePriority": 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        //debugger;
                        return RH_DEF_FLEXFIELDS.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "CD_FF": {
                        required: true,
                         maxlength: 30
                    },
                    "DSP_FF": {
                        required: true,
                        maxlength: 40
                    },
                    "ACTIVO": {
                        required: true
                    },
                    "SCC_ACTVO": {
                        required: true
                    },
                    "NR_ORDEM": {
                        integer: true,
                         maxlength: 4
                    },
                    "SQL_CODE": {
                        maxlength: 2000
                    },
                    "DESCRICAO": {
                        maxlength: 1000
                    }
                }
            }
        };
        RH_DEF_FLEXFIELDS = new QuadTable();
        RH_DEF_FLEXFIELDS.initTable( $.extend({}, datatable_instance_defaults, optionRH_DEF_FLEXFIELDS) );     
        //END Atributos Flexiveis
        
        //Atributos Flexiveis Trads
        var optionsRH_DEF_FLEXFIELD_TRADS = {
            "tableId": "RH_DEF_FLEXFIELD_TRADS",
            "table": "RH_DEF_FLEXFIELD_TRADS",
            "pk": {
                "primary": {
                    "CD_FF": {"type": "varchar"},
                    "CD_LINGUA": {"type": "number"},                    
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "RH_DEF_FLEXFIELDS": {
                    "EMPRESA": "EMPRESA",
                    "CD_HAB_PROF": "CD_HAB_PROF",
                    "DT_INI_HAB_PROF": "DT_INI_HAB_PROF"
                }
            },
            "order_by": "CD_LINGUA, DT_INI DESC",
            "recordBundle": 4, 
            "pageLenght": 4, 
            "scrollY": "150",
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "className": "control toBottom toCenter",
                    "width": "1%",
                    "defaultContent": ''  
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_FF',
                    "name": 'CD_FF',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_LINGUA',
                    "name": 'CD_LINGUA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 2,
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_language, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_language; ?>",
                    "data": 'DSR_LINGUA',
                    "name": 'DSR_LINGUA',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "dependent-group": "LINGUAS",
                        "dependent-level": 1,
                        "data-db-name": 'A.CD_LINGUA',
                        "decodeFromTable": 'DG_LINGUAS_ESTRANGEIRAS A',
                        "class": "form-control complexList chosen", 
                        "desigColumn": "A.DSR_LINGUA", 
                        "orderBy": "A.NR_ORDEM, A.CD_LINGUA",
                        "filter": {
                            "create": " AND A.ATIVO = 'S'", //On-New-Record
                            "edit": " AND A.ATIVO = 'S'", //On-Edit-Record
                        }
                    }
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI',
                    "name": 'DT_INI',
                    "datatype": 'date',
                    "def": "1900-01-01",
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DSP_TRAD',
                    "name": 'DSP_TRAD',                    
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_TRAD',
                    "name": 'DSR_TRAD',
                    "className": "visibleColumn",
                }, {
                    "title": "<?php echo mb_strtoupper($ui_description, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DESCRICAO',
                    "name": 'DESCRICAO',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 335px;",
                    }                                      
                }, {
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM',
                    "name": 'DT_FIM',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'INSERTED_BY',
                    "name": 'INSERTED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INSERTED',
                    "name": 'DT_INSERTED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CHANGED_BY',
                    "name": 'CHANGED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_UPDATED',
                    "name": 'DT_UPDATED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions, 'UTF-8'); ?>" + '</span>',
                    "label": '',
                    "data":  null,
                    "name": 'RECORD_HISTORY',
                    "type": "hidden",
                    "className": "none visibleColumn",
                    "render": function (val, type, row) {
                        return tablesRecordHistory (val, type, row);
                    }                       
                }, {
                    "responsivePriority": 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        //debugger;
                        return RH_DEF_FLEXFIELD_TRADS.crudButtons(true,true,true);
                    }
                }
            ],
            validations: {
                rules: {
                    DSR_LINGUA: {
                        required: true,
                    },
                    DT_INI: {
                        required: true,
                        dateISO: true,
                    },
                    DSP_TRAD: {
                        required: true,
                        maxlength: 240,
                    },
                    DSR_TRAD: {
                        required: true,
                        maxlength: 240,
                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                    "DT_FIM": {
                        dateISO: true,
                        dateEqOrNextThan: "DT_INI",
                    }
                },
                "messages": {
                    "DT_FIM": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        RH_DEF_FLEXFIELD_TRADS = new QuadTable();
        RH_DEF_FLEXFIELD_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsRH_DEF_FLEXFIELD_TRADS));
        //END Atributos Flexiveis Trads
        
        //Contextos Atributos Flexiveis
        var optionsAF_Contextos = {
            "tableId": 'AF_Contextos',
            "table": "CG_REF_CODES",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_context; ?>",            
            "pk": {
                "primary": {
                    "RV_DOMAIN": {"type": "varchar"},
                    "RV_LOW_VALUE": {"type": "varchar"}
                }
            },
            "detailsObjects": ['AF_ContextosTrads'],
            "initialWhereClause": "RV_DOMAIN = 'RH_CTX_FLEXFIELD' ",
            "order_by": "RV_LOW_VALUE",
            "scrollY": "234", 
            "recordBundle": 10,
            "pageLenght": 10, 
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "className": "control toBottom toCenter",
                    "width": "1%",
                    "defaultContent": ''  
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'RV_DOMAIN',
                    "name": 'RV_DOMAIN',
                    "def": "RH_CTX_FLEXFIELD",
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables 
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'RV_LOW_VALUE',
                    "name": 'RV_LOW_VALUE',
                    "className": "visibleColumn",
                    "attr": {
                        "name": "RV_LOW_VALUE"
                    }                     
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_description, 'UTF-8'); ?>", //Datatables 
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'RV_MEANING',
                    "name": 'RV_MEANING',
                    "className": "visibleColumn",
                    "attr": {
                        "name": "RV_MEANING"
                    } 
                }, {
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables 
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'RV_ABBREVIATION',
                    "name": 'RV_ABBREVIATION',
                    "className": "visibleColumn",
                    "attr": {
                        "name": "RV_ABBREVIATION"
                    }                     
                }, {
                    "responsivePriority": 5,                    
                    "title": "<?php echo mb_strtoupper($ui_order_nr, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_order_nr; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_ad_sources_level; ?>",
                    "data": 'RV_HIGH_VALUE',
                    "name": 'RV_HIGH_VALUE',
                    "className": "visibleColumn right",
                    "attr": {
                            "class": "form-control toRight",
                            "style": "width: 30%;"
                    }         
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'INSERTED_BY',
                    "name": 'INSERTED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INSERTED',
                    "name": 'DT_INSERTED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CHANGED_BY',
                    "name": 'CHANGED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_UPDATED',
                    "name": 'DT_UPDATED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions, 'UTF-8'); ?>" + '</span>',
                    "label": '',
                    "data":  null,
                    "name": 'RECORD_HISTORY',
                    "type": "hidden",
                    "className": "none visibleColumn",
                    "render": function (val, type, row) {
                        return tablesRecordHistory (val, type, row);
                    }                  
                }, {
                    "responsivePriority": 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        //debugger;
                        return AF_Contextos.crudButtons(false, true, false);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "RV_DOMAIN": {
                        required: true,
                    },
                    "RV_LOW_VALUE": {
                        required: true
                    },
                    "RV_MEANING": {
                        required: true,
                        maxlength: 240
                    },
                    "RV_ABBREVIATION": {
                        required: true,
                        maxlength: 240
                    },
                    "RV_HIGH_VALUE": {
                        integer: true
                    }                    
                }
            },
        };
        AF_Contextos = new QuadTable();
        AF_Contextos.initTable($.extend({}, datatable_instance_defaults, optionsAF_Contextos));
        //Contextos Atributos Flexiveis
        
        //Contextos Atributos Flexíveis
        var optionsAF_ContextosTrads = {
            "tableId": 'AF_ContextosTrads',
            "table": "CG_REF_CODES_TRADS",
            "order": false,
            "pk":{
                "primary": {
                    "RV_DOMAIN": {"type": "varchar"},
                    "RV_LOW_VALUE": {"type": "varchar"},
                    "CD_LINGUA": {"type": "number"},
                    "DT_INI": {"type": "date"},
                }
            },
            "dependsOn": {
                AF_Contextos: {
                    "RV_DOMAIN": "RV_DOMAIN",
                    "RV_LOW_VALUE": "RV_LOW_VALUE",
                }
            },
            "order_by": "CD_LINGUA, DT_INI DESC",
            "recordBundle": 4, 
            "pageLenght": 4, 
            "scrollY": "150",
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "className": "control toBottom toCenter",
                    "width": "1%",
                    "defaultContent": ''  
                }, {
                    "title": "<?php echo mb_strtoupper($ui_domain, 'UTF-8'); ?>", //Datatables
                    "label": "", //Editor
                    "data": 'RV_DOMAIN',
                    "name": 'RV_DOMAIN',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                    "className": "visibleColumn",
                    "attr": {
                        "name": "RV_DOMAIN",
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "", //Editor
                    "data": 'RV_LOW_VALUE',
                    "name": 'RV_LOW_VALUE',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                    "className": "visibleColumn",
                    "attr": {
                        "name": "RV_LOW_VALUE",
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_LINGUA',
                    "name": 'CD_LINGUA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                    "attr": {
                        "name": "CD_LINGUA",
                    }
                }, {
                    "responsivePriority": 2,
                    "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                    "title": "<?php echo mb_strtoupper($ui_language, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_language; ?>",
                    "data": 'DSR_LINGUA',
                    "name": 'DSR_LINGUA',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "dependent-group": "LINGUAS",
                        "dependent-level": 1,
                        "data-db-name": 'A.CD_LINGUA',
                        "decodeFromTable": 'DG_LINGUAS_ESTRANGEIRAS A',
                        "class": "form-control complexList chosen", 
                        "desigColumn": "A.DSR_LINGUA", 
                        "orderBy": "A.NR_ORDEM, A.CD_LINGUA",
                        "filter": {
                            "create": " AND A.ATIVO = 'S'", //On-New-Record
                            "edit": " AND A.ATIVO = 'S'", //On-Edit-Record
                        }
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI',
                    "name": 'DT_INI',
                    "datatype": 'date',
                    "def": "1900-01-01",
                    "className": "visibleColumn",
                    "attr": {//EDITOR CONTROL
                        "name": 'DT_INI',
                        "class": "datepicker" //dateTimePicker
                    }
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_TRAD',
                    "name": 'DSP_TRAD',
                    "className": "visibleColumn",
                    "attr": {
                        "name": "DSP_TRAD",
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_TRAD',
                    "name": 'DSR_TRAD',
                    "className": "visibleColumn",
                    "attr": {
                        "name": "DSR_TRAD",
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM',
                    "name": 'DT_FIM',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {//EDITOR CONTROL
                        "name": 'DT_FIM',
                        "class": "datepicker" //dateTimePicker
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_description, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DESCRICAO',
                    "name": 'DESCRICAO',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 335px",
                    } 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'INSERTED_BY',
                    "name": 'INSERTED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INSERTED',
                    "name": 'DT_INSERTED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CHANGED_BY',
                    "name": 'CHANGED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_UPDATED',
                    "name": 'DT_UPDATED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions, 'UTF-8'); ?>" + '</span>',
                    "label": '',
                    "data":  null,
                    "name": 'RECORD_HISTORY',
                    "type": "hidden",
                    "className": "none visibleColumn",
                    "render": function (val, type, row) {
                        return tablesRecordHistory (val, type, row);
                    }                                 
                }, {
                    "responsivePriority": 1,
                    "data": null,
                    "title": "",
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        return AF_ContextosTrads.crudButtons(true, true, true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DSR_LINGUA": {//Same as defined on attr.name
                        required: true,
                    },
                    "DT_INI": {
                        required: true,
                        dateISO: true,
                    },
                    "DSP_TRAD": {//Same as defined on attr.name
                        required: true,
                        maxlength: 240,
                    },
                    "DSR_TRAD": {
                        required: true,
                        maxlength: 240,
                    },
                    "DT_FIM": {
                        dateISO: true,
                    },
                    "DESCRICAO": {
                        maxlength: 4000,
                    },
                    "DT_FIM": {
                        dateISO: true,
                        dateEqOrNextThan: "DT_INI",
                    }
                },
                "messages": {
                    "DT_FIM": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        AF_ContextosTrads = new QuadTable();
        AF_ContextosTrads.initTable($.extend({}, datatable_instance_defaults, optionsAF_ContextosTrads));
        //End Contextos Atributos Flexíveis Trads        
            
        //LOV's Atributos Flexiveis
        var optionsAF_LOVS = {
            "tableId": 'AF_LOVS',
            "table": "CG_REF_CODES",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_lov_short; ?>",            
            "pk": {
                "primary": {
                    "RV_DOMAIN": {"type": "varchar"},
                    "RV_LOW_VALUE": {"type": "varchar"}
                }
            },
            "detailsObjects": ['AF_LOVSTrads'],
            "initialWhereClause": "RV_HIGH_VALUE = 'FLEXUSER' ",
            "order_by": "RV_DOMAIN, RV_LOW_VALUE",
            "scrollY": "234", 
            "recordBundle": 10,
            "pageLenght": 10, 
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "className": "control toBottom toCenter",
                    "width": "1%",
                    "defaultContent": '' 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'RV_HIGH_VALUE',
                    "name": 'RV_HIGH_VALUE',
                    "def": "FLEXUSER",
                    "type": "hidden", //Editor
                    "visible": false, //DataTables        
                    "className": "",
                }, {
                    "title": "<?php echo mb_strtoupper($ui_name, 'UTF-8'); ?>", //Datatables 
                    "label": "<?php echo $ui_name; ?>", //Editor
                    "data": 'RV_DOMAIN',
                    "name": 'RV_DOMAIN',
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables 
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'RV_LOW_VALUE',
                    "name": 'RV_LOW_VALUE',
                    "className": "visibleColumn",
                    "attr": {
                        "name": "RV_LOW_VALUE"
                    }                     
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_description, 'UTF-8'); ?>", //Datatables 
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'RV_MEANING',
                    "name": 'RV_MEANING',
                    "className": "visibleColumn"
                }, {
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables 
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'RV_ABBREVIATION',
                    "name": 'RV_ABBREVIATION',
                    "className": "visibleColumn"
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'INSERTED_BY',
                    "name": 'INSERTED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INSERTED',
                    "name": 'DT_INSERTED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CHANGED_BY',
                    "name": 'CHANGED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_UPDATED',
                    "name": 'DT_UPDATED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions, 'UTF-8'); ?>" + '</span>',
                    "label": '',
                    "data":  null,
                    "name": 'RECORD_HISTORY',
                    "type": "hidden",
                    "className": "none visibleColumn",
                    "render": function (val, type, row) {
                        return tablesRecordHistory (val, type, row);
                    }                  
                }, {
                    "responsivePriority": 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        //debugger;
                        return AF_LOVS.crudButtons(false, true, false);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "RV_DOMAIN": {
                        required: true,
                    },
                    "RV_LOW_VALUE": {
                        required: true
                    },
                    "RV_MEANING": {
                        required: true,
                        maxlength: 240
                    },
                    "RV_ABBREVIATION": {
                        required: true,
                        maxlength: 240
                    },
                    "RV_HIGH_VALUE": {
                        integer: true
                    }                    
                }
            },
        };
        AF_LOVS = new QuadTable();
        AF_LOVS.initTable($.extend({}, datatable_instance_defaults, optionsAF_LOVS));
        //LOV's Atributos Flexiveis

        //Contextos Atributos Flexíveis
        var optionsAF_LOVSTrads = {
            "tableId": 'AF_LOVSTrads',
            "table": "CG_REF_CODES_TRADS",
            "order": false,
            "pk":{
                "primary": {
                    "RV_DOMAIN": {"type": "varchar"},
                    "RV_LOW_VALUE": {"type": "varchar"},
                    "CD_LINGUA": {"type": "number"},
                    "DT_INI": {"type": "date"},
                }
            },
            "dependsOn": {
                AF_LOVS: {
                    "RV_DOMAIN": "RV_DOMAIN",
                    "RV_LOW_VALUE": "RV_LOW_VALUE",
                }
            },
            "order_by": "CD_LINGUA, DT_INI DESC",
            "recordBundle": 4, 
            "pageLenght": 4, 
            "scrollY": "150",
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "className": "control toBottom toCenter",
                    "width": "1%",
                    "defaultContent": ''  
                }, {
                    "title": "<?php echo mb_strtoupper($ui_domain, 'UTF-8'); ?>", //Datatables
                    "label": "", //Editor
                    "data": 'RV_DOMAIN',
                    "name": 'RV_DOMAIN',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                    "className": "visibleColumn",
                    "attr": {
                        "name": "RV_DOMAIN",
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "", //Editor
                    "data": 'RV_LOW_VALUE',
                    "name": 'RV_LOW_VALUE',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                    "className": "visibleColumn",
                    "attr": {
                        "name": "RV_LOW_VALUE",
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_LINGUA',
                    "name": 'CD_LINGUA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                    "attr": {
                        "name": "CD_LINGUA",
                    }
                }, {
                    "responsivePriority": 2,
                    "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                    "title": "<?php echo mb_strtoupper($ui_language, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_language; ?>",
                    "data": 'DSR_LINGUA',
                    "name": 'DSR_LINGUA',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "dependent-group": "LINGUAS",
                        "dependent-level": 1,
                        "data-db-name": 'A.CD_LINGUA',
                        "decodeFromTable": 'DG_LINGUAS_ESTRANGEIRAS A',
                        "class": "form-control complexList chosen", 
                        "desigColumn": "A.DSR_LINGUA", 
                        "orderBy": "A.NR_ORDEM, A.CD_LINGUA",
                        "filter": {
                            "create": " AND A.ATIVO = 'S'", //On-New-Record
                            "edit": " AND A.ATIVO = 'S'", //On-Edit-Record
                        }
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI',
                    "name": 'DT_INI',
                    "datatype": 'date',
                    "def": "1900-01-01",
                    "className": "visibleColumn",
                    "attr": {//EDITOR CONTROL
                        "name": 'DT_INI',
                        "class": "datepicker" //dateTimePicker
                    }
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_TRAD',
                    "name": 'DSP_TRAD',
                    "className": "visibleColumn",
                    "attr": {
                        "name": "DSP_TRAD",
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_TRAD',
                    "name": 'DSR_TRAD',
                    "className": "visibleColumn",
                    "attr": {
                        "name": "DSR_TRAD",
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM',
                    "name": 'DT_FIM',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {//EDITOR CONTROL
                        "name": 'DT_FIM',
                        "class": "datepicker" //dateTimePicker
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_description, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DESCRICAO',
                    "name": 'DESCRICAO',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 335px",
                    } 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'INSERTED_BY',
                    "name": 'INSERTED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INSERTED',
                    "name": 'DT_INSERTED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CHANGED_BY',
                    "name": 'CHANGED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_UPDATED',
                    "name": 'DT_UPDATED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions, 'UTF-8'); ?>" + '</span>',
                    "label": '',
                    "data":  null,
                    "name": 'RECORD_HISTORY',
                    "type": "hidden",
                    "className": "none visibleColumn",
                    "render": function (val, type, row) {
                        return tablesRecordHistory (val, type, row);
                    }                                 
                }, {
                    "responsivePriority": 1,
                    "data": null,
                    "title": "",
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        return AF_LOVSTrads.crudButtons(true, true, true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DSR_LINGUA": {//Same as defined on attr.name
                        required: true,
                    },
                    "DT_INI": {
                        required: true,
                        dateISO: true,
                    },
                    "DSP_TRAD": {//Same as defined on attr.name
                        required: true,
                        maxlength: 240,
                    },
                    "DSR_TRAD": {
                        required: true,
                        maxlength: 240,
                    },
                    "DT_FIM": {
                        dateISO: true,
                    },
                    "DESCRICAO": {
                        maxlength: 4000,
                    },
                    "DT_FIM": {
                        dateISO: true,
                        dateEqOrNextThan: "DT_INI",
                    }
                },
                "messages": {
                    "DT_FIM": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        AF_LOVSTrads = new QuadTable();
        AF_LOVSTrads.initTable($.extend({}, datatable_instance_defaults, optionsAF_LOVSTrads));
        //End Contextos Atributos Flexíveis Trads
        
        //Items Curriculum
        var optionRH_DEF_ITEMS = {
            "tableId": "RH_DEF_ITEMS",
            "table": "RH_DEF_ITEMS", 
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_curriculum_item; ?>",
            "pk": {
                "primary": {
                    "CD_ITEM": {"type": "varchar"}
                }
            },
            "crudOnMasterInactive": {
                "condition": "data.ACTIVO === 'N'",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },                    
            "detailsObjects": ['RH_DEF_SUB_ITEMS','RH_DEF_ITEM_TRADS'],
            "order_by": "CD_ITEM",
            "scrollY": "117",
            "recordBundle": 4,
            "pageLenght": 4, 
            "responsive": true,
            "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "className": "control toBottom toCenter",
                    "width": "1%",
                    "defaultContent": ''     
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'CD_ITEM',
                    "name": 'CD_ITEM',
                    "className": "visibleColumn"
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_ITEM',
                    "name": 'DSP_ITEM',
                    "className": "visibleColumn"
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSR_ITEM',
                    "name": 'DSR_ITEM',
                    "className": "visibleColumn"
                }, {
                    "responsivePriority": 5, 
                    "title": "<?php echo mb_strtoupper($ui_context, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_context; ?>", //Editor                    
                    "data": 'CONTEXTO',
                    "name": 'CONTEXTO',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'RH_CONTEXTO_CURR',  
                        "class": "form-control chosen"
                    }
                }, {
                    "responsivePriority": 6, 
                    "title": "<?php echo mb_strtoupper($ui_active, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_active; ?>", //Editor                    
                    "data": 'ACTIVO',
                    "name": 'ACTIVO',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',  
                        "class": "form-control chosen"
                    }                           
//                }, {
//                    "complexList": true, 
//                    "title": "<?php echo mb_strtoupper($ui_domain, 'UTF-8'); ?>",
//                    "label": "<?php echo $ui_domain; ?>",
//                    "data": 'DSP_LOV_FLEX',
//                    "name": 'DSP_LOV_FLEX',
//                    "type": "select",
//                    "className": "none visibleColumn",
//                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
//                    "attr": {
//                        "dependent-group": "LOV_FLEX",
//                        "dependent-level": 1,
//                        "data-db-name": "A.VALUE",
//                        "distribute-value": "DOMINIO",
//                        "decodeFromTable": "RH_LOV_FLEX A", 
//                        "desigColumn": "A.LABEL", 
//                        "orderBy": "A.VALUE",
//                        "class": "form-control complexList chosen"
//                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'INSERTED_BY',
                    "name": 'INSERTED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INSERTED',
                    "name": 'DT_INSERTED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CHANGED_BY',
                    "name": 'CHANGED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_UPDATED',
                    "name": 'DT_UPDATED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions, 'UTF-8'); ?>" + '</span>',
                    "label": '',
                    "data":  null,
                    "name": 'RECORD_HISTORY',
                    "type": "hidden",
                    "className": "none visibleColumn",
                    "render": function (val, type, row) {
                        return tablesRecordHistory (val, type, row);
                    }                      
                }, {
                    "responsivePriority": 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        //debugger;
                        return RH_DEF_ITEMS.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "CD_ITEM": {
                        required: true,
                         maxlength: 3
                    },
                    "DSP_ITEM": {
                        required: true,
                        maxlength: 40
                    },
                    "DSR_ITEM": {
                        required: false,
                        maxlength: 25
                    },
                    "ACTIVO": {
                        required: true
                    }
                }
            }
        };
        RH_DEF_ITEMS = new QuadTable();
        RH_DEF_ITEMS.initTable( $.extend({}, datatable_instance_defaults, optionRH_DEF_ITEMS) );     
        //END Items Curriculum

        //Items Trads
        var optionsRH_DEF_ITEM_TRADS = {
            "tableId": "RH_DEF_ITEM_TRADS",
            "table": "RH_DEF_ITEM_TRADS",
            "pk": {
                "primary": {
                    "CD_ITEM": {"type": "varchar"},                  
                    "CD_LINGUA": {"type": "number"},                    
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "RH_DEF_ITEMS": {
                    "CD_ITEM": "CD_ITEM"
                }
            },
            "order_by": "CD_LINGUA, DT_INI DESC",
            "recordBundle": 4, 
            "pageLenght": 4, 
            "scrollY": "150",
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "className": "control toBottom toCenter",
                    "width": "1%",
                    "defaultContent": ''  
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_ITEM',
                    "name": 'CD_ITEM',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_LINGUA',
                    "name": 'CD_LINGUA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 2,
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_language, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_language; ?>",
                    "data": 'DSR_LINGUA',
                    "name": 'DSR_LINGUA',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "dependent-group": "LINGUAS",
                        "dependent-level": 1,
                        "data-db-name": 'A.CD_LINGUA',
                        "decodeFromTable": 'DG_LINGUAS_ESTRANGEIRAS A',
                        "class": "form-control complexList chosen", 
                        "desigColumn": "A.DSR_LINGUA", 
                        "orderBy": "A.NR_ORDEM, A.CD_LINGUA",
                        "filter": {
                            "create": " AND A.ATIVO = 'S'", //On-New-Record
                            "edit": " AND A.ATIVO = 'S'", //On-Edit-Record
                        }
                    }
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI',
                    "name": 'DT_INI',
                    "datatype": 'date',
                    "def": "1900-01-01",
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DSP_TRAD',
                    "name": 'DSP_TRAD',                    
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_TRAD',
                    "name": 'DSR_TRAD',
                    "className": "visibleColumn",
                }, {
                    "title": "<?php echo mb_strtoupper($ui_description, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DESCRICAO',
                    "name": 'DESCRICAO',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 335px;",
                    }                                      
                }, {
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM',
                    "name": 'DT_FIM',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'INSERTED_BY',
                    "name": 'INSERTED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INSERTED',
                    "name": 'DT_INSERTED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CHANGED_BY',
                    "name": 'CHANGED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_UPDATED',
                    "name": 'DT_UPDATED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions, 'UTF-8'); ?>" + '</span>',
                    "label": '',
                    "data":  null,
                    "name": 'RECORD_HISTORY',
                    "type": "hidden",
                    "className": "none visibleColumn",
                    "render": function (val, type, row) {
                        return tablesRecordHistory (val, type, row);
                    }                       
                }, {
                    "responsivePriority": 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        //debugger;
                        return RH_DEF_ITEM_TRADS.crudButtons(true,true,true);
                    }
                }
            ],
            validations: {
                rules: {
                    DSR_LINGUA: {
                        required: true,
                    },
                    DT_INI: {
                        required: true,
                        dateISO: true,
                    },
                    DSP_TRAD: {
                        required: true,
                        maxlength: 240,
                    },
                    DSR_TRAD: {
                        required: true,
                        maxlength: 240,
                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                    "DT_FIM": {
                        dateISO: true,
                        dateEqOrNextThan: "DT_INI",
                    }
                },
                "messages": {
                    "DT_FIM": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        RH_DEF_ITEM_TRADS = new QuadTable();
        RH_DEF_ITEM_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsRH_DEF_ITEM_TRADS));
        //END Items Trads

        //Sub-Items Curriculum
        var optionRH_DEF_SUB_ITEMS = {
            "tableId": "RH_DEF_SUB_ITEMS",
            "table": "RH_DEF_SUB_ITEMS", 
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_curriculum_sub_item; ?>",
            "pk": {
                "primary": {
                    "CD_ITEM": {"type": "varchar"},
                    "CD_SUB_ITEM": {"type": "varchar"}
                }
            },
            "dependsOn": {
                RH_DEF_ITEMS: {
                    "CD_ITEM": "CD_ITEM",
                }
            },
            "crudOnMasterInactive": {
                "condition": "data.ACTIVO === 'N'",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },        
            "detailsObjects": ['RH_DEF_SUB_ITEM_TRADS'],
            "order_by": "CD_SUB_ITEM",
            "scrollY": "117",
            "recordBundle": 4,
            "pageLenght": 4, 
            "responsive": true,
            "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "className": "control toBottom toCenter",
                    "width": "1%",
                    "defaultContent": ''     
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_ITEM',
                    "name": 'CD_ITEM',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'CD_SUB_ITEM',
                    "name": 'CD_SUB_ITEM',
                    "className": "visibleColumn"
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_SUB_ITEM',
                    "name": 'DSP_SUB_ITEM',
                    "className": "visibleColumn"
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSR_SUB_ITEM',
                    "name": 'DSR_SUB_ITEM',
                    "className": "visibleColumn"
                }, {
                    "responsivePriority": 5, 
                    "title": "<?php echo mb_strtoupper($ui_active, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_active; ?>", //Editor                    
                    "data": 'ACTIVO',
                    "name": 'ACTIVO',
                    "type": "select",
                    "def": "S",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',  
                        "class": "form-control chosen"
                    } 
                }, {
                    "title": "<?php echo mb_strtoupper($ui_description, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'TXT',
                    "name": 'TXT',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn", 
                    "attr": {
                        "style": "max-width: 335px",
                    } 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'INSERTED_BY',
                    "name": 'INSERTED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INSERTED',
                    "name": 'DT_INSERTED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CHANGED_BY',
                    "name": 'CHANGED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_UPDATED',
                    "name": 'DT_UPDATED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions, 'UTF-8'); ?>" + '</span>',
                    "label": '',
                    "data":  null,
                    "name": 'RECORD_HISTORY',
                    "type": "hidden",
                    "className": "none visibleColumn",
                    "render": function (val, type, row) {
                        return tablesRecordHistory (val, type, row);
                    }                      
                }, {
                    "responsivePriority": 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        //debugger;
                        return RH_DEF_SUB_ITEMS.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "CD_SUB_ITEM": {
                        required: true,
                         maxlength: 3
                    },
                    "DSP_SUB_ITEM": {
                        required: true,
                        maxlength: 40
                    },
                    "DSR_SUB_ITEM": {
                        required: false,
                        maxlength: 25
                    },
                    "TXT": {
                        maxlength: 2000
                    },
                    "ACTIVO": {
                        required: true
                    }
                }
            }
        };
        RH_DEF_SUB_ITEMS = new QuadTable();
        RH_DEF_SUB_ITEMS.initTable( $.extend({}, datatable_instance_defaults, optionRH_DEF_SUB_ITEMS) );     
        //END Sub-Items Curriculum

        //Sub-Items Trads
        var optionsRH_DEF_SUB_ITEM_TRADS = {
            "tableId": "RH_DEF_SUB_ITEM_TRADS",
            "table": "RH_DEF_SUB_ITEM_TRADS",
            "pk": {
                "primary": {
                    "CD_ITEM": {"type": "varchar"},
                    "CD_SUB_ITEM": {"type": "varchar"},                      
                    "CD_LINGUA": {"type": "number"},                    
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "RH_DEF_SUB_ITEMS": {
                    "CD_ITEM": "CD_ITEM",
                    "CD_SUB_ITEM": "CD_SUB_ITEM"
                }
            },
            "order_by": "CD_LINGUA, DT_INI DESC",
            "recordBundle": 4, 
            "pageLenght": 4, 
            "scrollY": "150",
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "className": "control toBottom toCenter",
                    "width": "1%",
                    "defaultContent": ''  
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_ITEM',
                    "name": 'CD_ITEM',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_SUB_ITEM',
                    "name": 'CD_SUB_ITEM',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_LINGUA',
                    "name": 'CD_LINGUA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 2,
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_language, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_language; ?>",
                    "data": 'DSR_LINGUA',
                    "name": 'DSR_LINGUA',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "dependent-group": "LINGUAS",
                        "dependent-level": 1,
                        "data-db-name": 'A.CD_LINGUA',
                        "decodeFromTable": 'DG_LINGUAS_ESTRANGEIRAS A',
                        "class": "form-control complexList chosen", 
                        "desigColumn": "A.DSR_LINGUA", 
                        "orderBy": "A.NR_ORDEM, A.CD_LINGUA",
                        "filter": {
                            "create": " AND A.ATIVO = 'S'", //On-New-Record
                            "edit": " AND A.ATIVO = 'S'", //On-Edit-Record
                        }
                    }
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI',
                    "name": 'DT_INI',
                    "datatype": 'date',
                    "def": "1900-01-01",
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DSP_TRAD',
                    "name": 'DSP_TRAD',                    
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_TRAD',
                    "name": 'DSR_TRAD',
                    "className": "visibleColumn",
                }, {
                    "title": "<?php echo mb_strtoupper($ui_description, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DESCRICAO',
                    "name": 'DESCRICAO',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 335px;",
                    }                                      
                }, {
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM',
                    "name": 'DT_FIM',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'INSERTED_BY',
                    "name": 'INSERTED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INSERTED',
                    "name": 'DT_INSERTED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CHANGED_BY',
                    "name": 'CHANGED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_UPDATED',
                    "name": 'DT_UPDATED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions, 'UTF-8'); ?>" + '</span>',
                    "label": '',
                    "data":  null,
                    "name": 'RECORD_HISTORY',
                    "type": "hidden",
                    "className": "none visibleColumn",
                    "render": function (val, type, row) {
                        return tablesRecordHistory (val, type, row);
                    }                       
                }, {
                    "responsivePriority": 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        //debugger;
                        return RH_DEF_SUB_ITEM_TRADS.crudButtons(true,true,true);
                    }
                }
            ],
            validations: {
                rules: {
                    DSR_LINGUA: {
                        required: true,
                    },
                    DT_INI: {
                        required: true,
                        dateISO: true,
                    },
                    DSP_TRAD: {
                        required: true,
                        maxlength: 240,
                    },
                    DSR_TRAD: {
                        required: true,
                        maxlength: 240,
                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                    "DT_FIM": {
                        dateISO: true,
                        dateEqOrNextThan: "DT_INI",
                    }
                },
                "messages": {
                    "DT_FIM": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        RH_DEF_SUB_ITEM_TRADS = new QuadTable();
        RH_DEF_SUB_ITEM_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsRH_DEF_SUB_ITEM_TRADS));
        //END Sub-Items Trads

        //Items Curriculum Trads
        var optionsRH_DEF_FLEXFIELD_TRADS = {
            "tableId": "RH_DEF_FLEXFIELD_TRADS",
            "table": "RH_DEF_FLEXFIELD_TRADS",
            "pk": {
                "primary": {
                    "CD_FF": {"type": "varchar"},
                    "CD_LINGUA": {"type": "number"},                    
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "RH_DEF_FLEXFIELDS": {
                    "EMPRESA": "EMPRESA",
                    "CD_HAB_PROF": "CD_HAB_PROF",
                    "DT_INI_HAB_PROF": "DT_INI_HAB_PROF"
                }
            },
            "order_by": "CD_LINGUA, DT_INI DESC",
            "recordBundle": 4, 
            "pageLenght": 4, 
            "scrollY": "150",
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "className": "control toBottom toCenter",
                    "width": "1%",
                    "defaultContent": ''  
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_FF',
                    "name": 'CD_FF',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_LINGUA',
                    "name": 'CD_LINGUA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 2,
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_language, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_language; ?>",
                    "data": 'DSR_LINGUA',
                    "name": 'DSR_LINGUA',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "dependent-group": "LINGUAS",
                        "dependent-level": 1,
                        "data-db-name": 'A.CD_LINGUA',
                        "decodeFromTable": 'DG_LINGUAS_ESTRANGEIRAS A',
                        "class": "form-control complexList chosen", 
                        "desigColumn": "A.DSR_LINGUA", 
                        "orderBy": "A.NR_ORDEM, A.CD_LINGUA",
                        "filter": {
                            "create": " AND A.ATIVO = 'S'", //On-New-Record
                            "edit": " AND A.ATIVO = 'S'", //On-Edit-Record
                        }
                    }
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI',
                    "name": 'DT_INI',
                    "datatype": 'date',
                    "def": "1900-01-01",
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DSP_TRAD',
                    "name": 'DSP_TRAD',                    
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_TRAD',
                    "name": 'DSR_TRAD',
                    "className": "visibleColumn",
                }, {
                    "title": "<?php echo mb_strtoupper($ui_description, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DESCRICAO',
                    "name": 'DESCRICAO',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 335px;",
                    }                                      
                }, {
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM',
                    "name": 'DT_FIM',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'INSERTED_BY',
                    "name": 'INSERTED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INSERTED',
                    "name": 'DT_INSERTED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CHANGED_BY',
                    "name": 'CHANGED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_UPDATED',
                    "name": 'DT_UPDATED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions, 'UTF-8'); ?>" + '</span>',
                    "label": '',
                    "data":  null,
                    "name": 'RECORD_HISTORY',
                    "type": "hidden",
                    "className": "none visibleColumn",
                    "render": function (val, type, row) {
                        return tablesRecordHistory (val, type, row);
                    }                       
                }, {
                    "responsivePriority": 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        //debugger;
                        return RH_DEF_FLEXFIELD_TRADS.crudButtons(true,true,true);
                    }
                }
            ],
            validations: {
                rules: {
                    DSR_LINGUA: {
                        required: true,
                    },
                    DT_INI: {
                        required: true,
                        dateISO: true,
                    },
                    DSP_TRAD: {
                        required: true,
                        maxlength: 240,
                    },
                    DSR_TRAD: {
                        required: true,
                        maxlength: 240,
                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                    "DT_FIM": {
                        dateISO: true,
                        dateEqOrNextThan: "DT_INI",
                    }
                },
                "messages": {
                    "DT_FIM": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        RH_DEF_FLEXFIELD_TRADS = new QuadTable();
        RH_DEF_FLEXFIELD_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsRH_DEF_FLEXFIELD_TRADS));
        //END Items Curriculum Trads
                            
        //Contextos Items Curriculum
        var optionsRH_CONTEXTO_CURR = {
            "tableId": 'RH_CONTEXTO_CURR',
            "table": "CG_REF_CODES",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_context; ?>",            
            "pk": {
                "primary": {
                    "RV_DOMAIN": {"type": "varchar"},
                    "RV_LOW_VALUE": {"type": "varchar"}
                }
            },
            "detailsObjects": ['RH_CONTEXTO_CURRTrads'],
            "initialWhereClause": "RV_DOMAIN = 'RH_CONTEXTO_CURR' ",
            "order_by": "RV_DOMAIN, RV_LOW_VALUE",
            "scrollY": "117",
            "recordBundle": 4,
            "pageLenght": 4, 
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "className": "control toBottom toCenter",
                    "width": "1%",
                    "defaultContent": '' 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'RV_DOMAIN',
                    "name": 'RV_DOMAIN',
                    "def": "RH_CONTEXTO_CURR",
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables 
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'RV_LOW_VALUE',
                    "name": 'RV_LOW_VALUE',
                    "className": "visibleColumn",
                    "attr": {
                        "name": "RV_LOW_VALUE"
                    }                     
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_description, 'UTF-8'); ?>", //Datatables 
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'RV_MEANING',
                    "name": 'RV_MEANING',
                    "className": "visibleColumn"
                }, {
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables 
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'RV_ABBREVIATION',
                    "name": 'RV_ABBREVIATION',
                    "className": "visibleColumn"
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'INSERTED_BY',
                    "name": 'INSERTED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INSERTED',
                    "name": 'DT_INSERTED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CHANGED_BY',
                    "name": 'CHANGED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_UPDATED',
                    "name": 'DT_UPDATED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions, 'UTF-8'); ?>" + '</span>',
                    "label": '',
                    "data":  null,
                    "name": 'RECORD_HISTORY',
                    "type": "hidden",
                    "className": "none visibleColumn",
                    "render": function (val, type, row) {
                        return tablesRecordHistory (val, type, row);
                    }                  
                }, {
                    "responsivePriority": 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        //debugger;
                        return RH_CONTEXTO_CURR.crudButtons(false, true, false);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "RV_DOMAIN": {
                        required: true,
                    },
                    "RV_LOW_VALUE": {
                        required: true
                    },
                    "RV_MEANING": {
                        required: true,
                        maxlength: 240
                    },
                    "RV_ABBREVIATION": {
                        required: true,
                        maxlength: 240
                    },
                    "RV_HIGH_VALUE": {
                        integer: true
                    }                    
                }
            },
        };
        RH_CONTEXTO_CURR = new QuadTable();
        RH_CONTEXTO_CURR.initTable($.extend({}, datatable_instance_defaults, optionsRH_CONTEXTO_CURR));
        //Contextos Items Curriculum

        //Contextos Items Curriculum Trads
        var optionsRH_CONTEXTO_CURRTrads = {
            "tableId": 'RH_CONTEXTO_CURRTrads',
            "table": "CG_REF_CODES_TRADS",
            "order": false,
            "pk":{
                "primary": {
                    "RV_DOMAIN": {"type": "varchar"},
                    "RV_LOW_VALUE": {"type": "varchar"},
                    "CD_LINGUA": {"type": "number"},
                    "DT_INI": {"type": "date"},
                }
            },
            "dependsOn": {
                RH_CONTEXTO_CURR: {
                    "RV_DOMAIN": "RV_DOMAIN",
                    "RV_LOW_VALUE": "RV_LOW_VALUE",
                }
            },
            "order_by": "CD_LINGUA, DT_INI DESC",
            "recordBundle": 4, 
            "pageLenght": 4, 
            "scrollY": "150",
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "className": "control toBottom toCenter",
                    "width": "1%",
                    "defaultContent": ''  
                }, {
                    "title": "<?php echo mb_strtoupper($ui_domain, 'UTF-8'); ?>", //Datatables
                    "label": "", //Editor
                    "data": 'RV_DOMAIN',
                    "name": 'RV_DOMAIN',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                    "className": "visibleColumn",
                    "attr": {
                        "name": "RV_DOMAIN",
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "", //Editor
                    "data": 'RV_LOW_VALUE',
                    "name": 'RV_LOW_VALUE',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                    "className": "visibleColumn",
                    "attr": {
                        "name": "RV_LOW_VALUE",
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_LINGUA',
                    "name": 'CD_LINGUA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                    "attr": {
                        "name": "CD_LINGUA",
                    }
                }, {
                    "responsivePriority": 2,
                    "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                    "title": "<?php echo mb_strtoupper($ui_language, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_language; ?>",
                    "data": 'DSR_LINGUA',
                    "name": 'DSR_LINGUA',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "dependent-group": "LINGUAS",
                        "dependent-level": 1,
                        "data-db-name": 'A.CD_LINGUA',
                        "decodeFromTable": 'DG_LINGUAS_ESTRANGEIRAS A',
                        "class": "form-control complexList chosen", 
                        "desigColumn": "A.DSR_LINGUA", 
                        "orderBy": "A.NR_ORDEM, A.CD_LINGUA",
                        "filter": {
                            "create": " AND A.ATIVO = 'S'", //On-New-Record
                            "edit": " AND A.ATIVO = 'S'", //On-Edit-Record
                        }
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI',
                    "name": 'DT_INI',
                    "datatype": 'date',
                    "def": "1900-01-01",
                    "className": "visibleColumn",
                    "attr": {//EDITOR CONTROL
                        "name": 'DT_INI',
                        "class": "datepicker" //dateTimePicker
                    }
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_TRAD',
                    "name": 'DSP_TRAD',
                    "className": "visibleColumn",
                    "attr": {
                        "name": "DSP_TRAD",
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_TRAD',
                    "name": 'DSR_TRAD',
                    "className": "visibleColumn",
                    "attr": {
                        "name": "DSR_TRAD",
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM',
                    "name": 'DT_FIM',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {//EDITOR CONTROL
                        "name": 'DT_FIM',
                        "class": "datepicker" //dateTimePicker
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_description, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DESCRICAO',
                    "name": 'DESCRICAO',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 335px",
                    } 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'INSERTED_BY',
                    "name": 'INSERTED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INSERTED',
                    "name": 'DT_INSERTED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CHANGED_BY',
                    "name": 'CHANGED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_UPDATED',
                    "name": 'DT_UPDATED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions, 'UTF-8'); ?>" + '</span>',
                    "label": '',
                    "data":  null,
                    "name": 'RECORD_HISTORY',
                    "type": "hidden",
                    "className": "none visibleColumn",
                    "render": function (val, type, row) {
                        return tablesRecordHistory (val, type, row);
                    }                                 
                }, {
                    "responsivePriority": 1,
                    "data": null,
                    "title": "",
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        return RH_CONTEXTO_CURRTrads.crudButtons(true, true, true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DSR_LINGUA": {//Same as defined on attr.name
                        required: true,
                    },
                    "DT_INI": {
                        required: true,
                        dateISO: true,
                    },
                    "DSP_TRAD": {//Same as defined on attr.name
                        required: true,
                        maxlength: 240,
                    },
                    "DSR_TRAD": {
                        required: true,
                        maxlength: 240,
                    },
                    "DT_FIM": {
                        dateISO: true,
                    },
                    "DESCRICAO": {
                        maxlength: 4000,
                    },
                    "DT_FIM": {
                        dateISO: true,
                        dateEqOrNextThan: "DT_INI",
                    }
                },
                "messages": {
                    "DT_FIM": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        RH_CONTEXTO_CURRTrads = new QuadTable();
        RH_CONTEXTO_CURRTrads.initTable($.extend({}, datatable_instance_defaults, optionsRH_CONTEXTO_CURRTrads));
        //END Contextos Items Curriculum Trads        
        
        //LOV's Atributos Flexiveis
        var optionsCONTEXTOS_TEMPORAIS = {
            "tableId": 'CONTEXTOS_TEMPORAIS',
            "table": "CG_REF_CODES",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_time_context; ?>",            
            "pk": {
                "primary": {
                    "RV_DOMAIN": {"type": "varchar"},
                    "RV_LOW_VALUE": {"type": "varchar"}
                }
            },
            "detailsObjects": ['CONTEXTOS_TEMPORAISTrads'],
            "initialWhereClause": "RV_DOMAIN = 'RH_CTX_MIS' ",
            "order_by": "RV_DOMAIN, RV_LOW_VALUE",
            "scrollY": "234", 
            "recordBundle": 10,
            "pageLenght": 10, 
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "className": "control toBottom toCenter",
                    "width": "1%",
                    "defaultContent": '' 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'RV_DOMAIN',
                    "name": 'RV_DOMAIN',
                    "def": "RH_CTX_MIS",
                    "type": "hidden", //Editor
                    "visible": false, //DataTables        
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_value, 'UTF-8'); ?>", //Datatables 
                    "label": "<?php echo $ui_value; ?>", //Editor
                    "data": 'RV_LOW_VALUE',
                    "name": 'RV_LOW_VALUE',
                    "className": "visibleColumn"
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_description, 'UTF-8'); ?>", //Datatables 
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'RV_ABBREVIATION',
                    "name": 'RV_ABBREVIATION',
                    "className": "visibleColumn"
                }, {
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_sql_code, 'UTF-8'); ?>", //Datatables 
                    "label": "<?php echo $ui_sql_code; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_lov_sql_code; ?>", //Editor
                    "data": 'RV_MEANING',
                    "name": 'RV_MEANING',
                    "className": "visibleColumn"
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'INSERTED_BY',
                    "name": 'INSERTED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INSERTED',
                    "name": 'DT_INSERTED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CHANGED_BY',
                    "name": 'CHANGED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_UPDATED',
                    "name": 'DT_UPDATED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions, 'UTF-8'); ?>" + '</span>',
                    "label": '',
                    "data":  null,
                    "name": 'RECORD_HISTORY',
                    "type": "hidden",
                    "className": "none visibleColumn",
                    "render": function (val, type, row) {
                        return tablesRecordHistory (val, type, row);
                    }                  
                }, {
                    "responsivePriority": 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        //debugger;
                        return CONTEXTOS_TEMPORAIS.crudButtons(false, true, false);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "RV_DOMAIN": {
                        required: true,
                    },
                    "RV_LOW_VALUE": {
                        required: true
                    },
                    "RV_MEANING": {
                        required: true,
                        maxlength: 240
                    },
                    "RV_ABBREVIATION": {
                        required: true,
                        maxlength: 240
                    },
                    "RV_HIGH_VALUE": {
                        integer: true
                    }                    
                }
            },
        };
        CONTEXTOS_TEMPORAIS = new QuadTable();
        CONTEXTOS_TEMPORAIS.initTable($.extend({}, datatable_instance_defaults, optionsCONTEXTOS_TEMPORAIS));
        //LOV's Atributos Flexiveis

        //Contextos Atributos Flexíveis
        var optionsCONTEXTOS_TEMPORAISTrads = {
            "tableId": 'CONTEXTOS_TEMPORAISTrads',
            "table": "CG_REF_CODES_TRADS",
            "order": false,
            "pk":{
                "primary": {
                    "RV_DOMAIN": {"type": "varchar"},
                    "RV_LOW_VALUE": {"type": "varchar"},
                    "CD_LINGUA": {"type": "number"},
                    "DT_INI": {"type": "date"},
                }
            },
            "dependsOn": {
                CONTEXTOS_TEMPORAIS: {
                    "RV_DOMAIN": "RV_DOMAIN",
                    "RV_LOW_VALUE": "RV_LOW_VALUE",
                }
            },
            "order_by": "CD_LINGUA, DT_INI DESC",
            "recordBundle": 4, 
            "pageLenght": 4, 
            "scrollY": "150",
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "className": "control toBottom toCenter",
                    "width": "1%",
                    "defaultContent": ''  
                }, {
                    "title": "<?php echo mb_strtoupper($ui_domain, 'UTF-8'); ?>", //Datatables
                    "label": "", //Editor
                    "data": 'RV_DOMAIN',
                    "name": 'RV_DOMAIN',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                    "className": "visibleColumn",
                    "attr": {
                        "name": "RV_DOMAIN",
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "", //Editor
                    "data": 'RV_LOW_VALUE',
                    "name": 'RV_LOW_VALUE',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                    "className": "visibleColumn",
                    "attr": {
                        "name": "RV_LOW_VALUE",
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_LINGUA',
                    "name": 'CD_LINGUA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                    "attr": {
                        "name": "CD_LINGUA",
                    }
                }, {
                    "responsivePriority": 2,
                    "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                    "title": "<?php echo mb_strtoupper($ui_language, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_language; ?>",
                    "data": 'DSR_LINGUA',
                    "name": 'DSR_LINGUA',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "dependent-group": "LINGUAS",
                        "dependent-level": 1,
                        "data-db-name": 'A.CD_LINGUA',
                        "decodeFromTable": 'DG_LINGUAS_ESTRANGEIRAS A',
                        "class": "form-control complexList chosen", 
                        "desigColumn": "A.DSR_LINGUA", 
                        "orderBy": "A.NR_ORDEM, A.CD_LINGUA",
                        "filter": {
                            "create": " AND A.ATIVO = 'S'", //On-New-Record
                            "edit": " AND A.ATIVO = 'S'", //On-Edit-Record
                        }
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI',
                    "name": 'DT_INI',
                    "datatype": 'date',
                    "def": "1900-01-01",
                    "className": "visibleColumn",
                    "attr": {//EDITOR CONTROL
                        "name": 'DT_INI',
                        "class": "datepicker" //dateTimePicker
                    }
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_TRAD',
                    "name": 'DSP_TRAD',
                    "className": "visibleColumn",
                    "attr": {
                        "name": "DSP_TRAD",
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_TRAD',
                    "name": 'DSR_TRAD',
                    "className": "visibleColumn",
                    "attr": {
                        "name": "DSR_TRAD",
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM',
                    "name": 'DT_FIM',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {//EDITOR CONTROL
                        "name": 'DT_FIM',
                        "class": "datepicker" //dateTimePicker
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_description, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DESCRICAO',
                    "name": 'DESCRICAO',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'INSERTED_BY',
                    "name": 'INSERTED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INSERTED',
                    "name": 'DT_INSERTED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CHANGED_BY',
                    "name": 'CHANGED_BY',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_UPDATED',
                    "name": 'DT_UPDATED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions, 'UTF-8'); ?>" + '</span>',
                    "label": '',
                    "data":  null,
                    "name": 'RECORD_HISTORY',
                    "type": "hidden",
                    "className": "none visibleColumn",
                    "render": function (val, type, row) {
                        return tablesRecordHistory (val, type, row);
                    }                                 
                }, {
                    "responsivePriority": 1,
                    "data": null,
                    "title": "",
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        return AF_LOVSTrads.crudButtons(true, true, true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DSR_LINGUA": {//Same as defined on attr.name
                        required: true,
                    },
                    "DT_INI": {
                        required: true,
                        dateISO: true,
                    },
                    "DSP_TRAD": {//Same as defined on attr.name
                        required: true,
                        maxlength: 240,
                    },
                    "DSR_TRAD": {
                        required: true,
                        maxlength: 240,
                    },
                    "DT_FIM": {
                        dateISO: true,
                    },
                    "DESCRICAO": {
                        maxlength: 4000,
                    },
                    "DT_FIM": {
                        dateISO: true,
                        dateEqOrNextThan: "DT_INI",
                    }
                },
                "messages": {
                    "DT_FIM": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        CONTEXTOS_TEMPORAISTrads = new QuadTable();
        CONTEXTOS_TEMPORAISTrads.initTable($.extend({}, datatable_instance_defaults, optionsCONTEXTOS_TEMPORAISTrads));
        //END Contextos Atributos Flexíveis Trads
                
        //RH_DEF_AUTO_CURRICULUM

    });
</script>
