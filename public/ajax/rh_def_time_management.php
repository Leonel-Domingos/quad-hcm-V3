<?php
    require_once '../init.php';
?>
<style>
    header.frmInnerSubHeader {
        display: block;
        padding: 3px 0;
        border-bottom: 1px dashed rgba(0,0,0,.2);
        background: #fff;
        font-size: 1em;
        font-weight: 300;
        color: #232323;
        line-height: 1.42857143;
        margin: 3px 14px 10px;
    }
    span.preIcon {
        margin-right: 5px;
    }
    .box-inside {
        border: 1px dashed #c2c2c2;
        margin: 18px 15px 22px 15px;
    }
    th.lightBlue {
        background: aliceblue;
        text-align: center;
    }
</style>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-end">
                <div class="panel-toolbar pr-3 align-self-end tabs__">
                    <ul id="demo_panel-tabs" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#Tab1" role="tab" aria-selected="true"><?php echo $ui_schedule_management; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab2" role="tab" aria-selected="true"><?php echo $ui_absenteeism; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab3" role="tab" aria-selected="true"><?php echo $ui_overtime_work; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab4" role="tab" aria-selected="true"><?php echo $ui_adaptability; ?></a>
                        </li>
                    </ul>
                </div>
            </div>   
            
            <div class="panel-container show">
                <div class="panel-content">
                    
                    <div class="tab-content">

                        <!-- TAB #1 -->
                        <div class="tab-pane fade active show" id="Tab1" role="tabpanel">
                            <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-start">
                                <div class="panel-toolbar pr-3 align-self-end">
                                    <ul id="panel-tab-1-1" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#Tab11" role="tab" aria-selected="true"><?php echo $ui_daily_schedules; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Tab12" role="tab" aria-selected="true"><?php echo $ui_timetables; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Tab13" role="tab" aria-selected="true"><?php echo $ui_time_attendance_rules; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Tab14" role="tab" aria-selected="true"><?php echo $ui_teams; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Tab15" role="tab" aria-selected="true"><?php echo $ui_shifts; ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-container show boxSubTab">
                                <div class="panel-content">
                                    <div class="tab-content">
                                        <!-- TAB #1.1 -->
                                        <div class="tab-pane fade active show" id="Tab11" role="tabpanel">
                                            <a id="RH_DEF_HORARIO_DIAS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="RH_DEF_HORARIO_DIAS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                            <div class="row mt-4">
                                                <div class="col-xl-12">
                                                    <div id="panel-11" class="panel">
                                                        <div class="panel-hdr">
                                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                                            <h2><?php echo $ui_translate; ?></h2>
                                                        </div>
                                                        <div class="panel-container show">
                                                            <div class="panel-content">
                                                                <a id="RH_DEF_HORARIO_DIA_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                                <table id="RH_DEF_HORARIO_DIA_TRADS" class="table table-bordered table-hover table-striped w-100"></table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END TAB #1.1 -->
                                        
                                        <!-- TAB #1.2 -->
                                        <div class="tab-pane fade" id="Tab12" role="tabpanel">
                                            <a id="RH_DEF_HORARIOS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="RH_DEF_HORARIOS" class="table table-bordered table-hover table-striped w-100"></table>
                                            
                                            <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-start">
                                                <div class="panel-toolbar pr-3 align-self-end">
                                                    <ul id="panel-tab-1-2-1" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" data-toggle="tab" href="#Tab121" role="tab" aria-selected="true"><?php echo $ui_details; ?></a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="tab" href="#Tab122" role="tab" aria-selected="true"><?php echo $ui_translations; ?></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            
                                            <div class="panel-container show boxSubTab">
                                                <div class="panel-content">
                                                    <div class="tab-content">
                                                        <div class="tab-pane fade active show" id="Tab121" role="tabpanel">
                                                            <a id="RH_DEF_DET_HORARIOS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                            <table id="RH_DEF_DET_HORARIOS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                                        </div>
                                                        <div class="tab-pane fade" id="Tab122" role="tabpanel">
                                                            <a id="RH_DEF_HORARIO_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                            <table id="RH_DEF_HORARIO_TRADS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                        
                                        <!-- END TAB #1.2 -->
                                        
                                        <!-- TAB #1.3 -->
                                        <div class="tab-pane fade" id="Tab13" role="tabpanel">
                                            <a id="RH_DEF_REGRAS_PONTO_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="RH_DEF_REGRAS_PONTO" class="table table-bordered table-hover table-striped w-100"></table>
                                            
                                            <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-start">
                                                <div class="panel-toolbar pr-3 align-self-end">
                                                    <ul id="panel-tab-1-2-1" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" data-toggle="tab" href="#Tab131" role="tab" aria-selected="true"><?php echo $ui_details; ?></a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="tab" href="#Tab132" role="tab" aria-selected="true"><?php echo $ui_translations; ?></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            
                                            <div class="panel-container show boxSubTab">
                                                <div class="panel-content">
                                                    <div class="tab-content">
                                                        <div class="tab-pane fade active show" id="Tab131" role="tabpanel">
                                                            <form action="" id="RH_DEF_REGRAS_PONTO_CONTINUED" class="form-horizontal-standard" novalidate="novalidate">
                                                                <div class="quad-alert"></div>
                                                                <form-toolbar></form-toolbar>
                                                                
                                                                <!-- Ciclo -->
                                                                <fieldset class="first-line"> 
                                                                    <header class="frmInnerHeader"><?php echo $ui_cycle; ?></header>
                                                                    <div class="form-row">
                                                                        <div class="form-group col-sm-6 col-md-4 col-lg-2 nobreak shorten">
                                                                            <label for="TOLERANCIA_CICLO"><?php echo $ui_delay_limit; ?></label>
                                                                            <input class="form-control toRight w-70 include-help" name="TOLERANCIA_CICLO">
                                                                            <span class="quad-inner-help" rel="tooltip" data-html="true" data-placement="bottom" 
                                                                                data-original-title="<?php echo $hint_format_H_MM; ?>"><i class="fas fa-info"></i>
                                                                            </span>
                                                                        </div>                                        

                                                                        <div class="form-group col-sm-6 col-md-4 col-lg-2 nobreak shorten">
                                                                            <label for="HORAS_OBRIGATORIO"><?php echo $ui_presence_hours; ?></label>
                                                                            <input class="form-control toRight w-70 include-help" name="HORAS_OBRIGATORIO">
                                                                            <span class="quad-inner-help" rel="tooltip" data-html="true" data-placement="bottom" 
                                                                                data-original-title="<?php echo $hint_format_H_MM; ?>"><i class="fas fa-info"></i>
                                                                            </span> 
                                                                        </div> 

                                                                        <div class="form-group col-sm-6 col-md-4 col-lg-2 nobreak shorten">
                                                                            <label for="HORAS_CICLO"><?php echo $ui_cycle_hours; ?></label>
                                                                            <input class="form-control toRight w-70 include-help" name="HORAS_CICLO">
                                                                        </div> 
                                                                        <div class="form-group col-sm-6 col-md-4 col-lg-2 nobreak shorten">
                                                                            <label for="COMPENSACAO_DIARIA"><?php echo $ui_max_compensation; ?></label>
                                                                            <input class="form-control toRight w-70 include-help" name="COMPENSACAO_DIARIA">
                                                                        </div>  
                                                                        <div class="form-group col-sm-6 col-md-4 col-lg-2 nobreak shorten">
                                                                            <label for="DIA_FECHO"><?php echo $ui_close_day; ?></label>
                                                                            <select class="form-control domainLists chosen" name="DIA_FECHO"></select>
                                                                        </div>    
                                                                        <div class="form-group col-sm-6 col-md-4 col-lg-2">
                                                                            <div class="onoffswitch-container vertical">
                                                                                <span class="onoffswitch-title"><?php echo $ui_cycle_anticipation; ?></span> 
                                                                                <span class="onoffswitch">
                                                                                    <input type="checkbox" class="onoffswitch-checkbox" id="FIM_MES_ANTECIPA_CICLO" name="FIM_MES_ANTECIPA_CICLO">
                                                                                    <label class="onoffswitch-label" for="FIM_MES_ANTECIPA_CICLO"> 
                                                                                        <span class="onoffswitch-inner" data-swchon-text="<?php echo mb_strtoupper($ui_yes, 'UTF-8'); ?>" data-swchoff-text="<?php echo mb_strtoupper($ui_no, 'UTF-8'); ?>"></span> 
                                                                                        <span class="onoffswitch-switch"></span>
                                                                                    </label> 
                                                                                </span>                                                                                                                        
                                                                                <span class="quad-switch-help" rel="tooltip" data-html="true" data-placement="bottom" 
                                                                                    data-original-title="<?php echo $hint_end_process_breaks_cycle; ?>"><i class="fas fa-info"></i>
                                                                                </span> 
                                                                            </div>                                                                        
                                                                        </div>    
                                                                    </div>
                                                                    
                                                                    <!-- Sub-Row #2 -->
                                                                    <div class="form-row">
                                                                        <div class="form-group col-sm-6 col-md-4 col-lg-6">
                                                                            <label for="DSP_AUSENCIA_CICLO"><?php echo $ui_absence; ?></label>
                                                                            <select class="form-control domainLists chosen w-70 include-help" name="DSP_AUSENCIA_CICLO"></select>
                                                                            <span class="quad-inner-help" rel="tooltip" data-html="true" data-placement="bottom" 
                                                                                data-original-title="<?php echo $hint_cycle_absenteeism; ?>"><i class="fas fa-info"></i>
                                                                            </span> 
                                                                        </div>    
                                                                        <div class="form-group col-sm-6 col-md-4 col-lg-1">
                                                                            <label for="FAIXA_ANTERIOR"><?php echo $ui_before; ?></label>
                                                                            <input class="form-control toRight" name="FAIXA_ANTERIOR" style="width:50px;">
                                                                        </div>     
                                                                        <div class="form-group col-sm-6 col-md-4 col-lg-1">
                                                                            <label for="FAIXA_POSTERIOR"><?php echo $ui_after; ?></label>
                                                                            <input class="form-control toRight" name="FAIXA_POSTERIOR" style="width:50px;">
                                                                        </div>
                                                                    </div>
                                                                </fieldset>
                                                                
                                                                <!-- Trabalho Suplementar -->
                                                                <fieldset class="first-line"> 
                                                                    <header class="frmInnerHeader"><?php echo $ui_overtime_work; ?></header>
                                                                    <div class="form-row">
                                                                        <div class="form-group col-sm-6 col-md-6 col-lg-2">
                                                                            <label for="TS_MINIMO"><?php echo $ui_min; ?></label>
                                                                            <input type="number" class="form-control toRight" name="TS_MINIMO" style="width:50px;">
                                                                        </div>                

                                                                        <div class="form-group col-sm-6 col-md-6 col-lg-2">
                                                                            <label for="TS_BLOCOS"><?php echo $ui_blocks; ?></label>
                                                                            <input type="number" class="form-control toRight" name="TS_BLOCOS" style="width:50px;">
                                                                        </div>     

                                                                        <div class="form-group col-sm-6 col-md-6 col-lg-3">
                                                                            <label for="TS_ESTADO"><?php echo $ui_status; ?></label>
                                                                            <select class="form-control domainLists chosen" name="TS_ESTADO"></select>
                                                                        </div>  

                                                                        <div class="form-group col-sm-6 col-md-6 col-lg-2">
                                                                            <label for="BUILD_FROM"><?php echo $ui_way; ?></label>
                                                                            <select class="form-control domainLists chosen" name="BUILD_FROM"></select>
                                                                        </div>          

                                                                        <div class="form-group col-sm-6 col-md-6 col-lg-2">
                                                                            <div class="onoffswitch-container vertical">
                                                                                <span class="onoffswitch-title"><?php echo $ui_authorized; ?></span> 
                                                                                <span class="onoffswitch">
                                                                                    <input type="checkbox" class="onoffswitch-checkbox" id="DISTRIBUIR_TS" name="DISTRIBUIR_TS">
                                                                                    <label class="onoffswitch-label" for="DISTRIBUIR_TS"> 
                                                                                        <span class="onoffswitch-inner" data-swchon-text="<?php echo mb_strtoupper($ui_yes, 'UTF-8'); ?>" data-swchoff-text="<?php echo mb_strtoupper($ui_no, 'UTF-8'); ?>"></span> 
                                                                                        <span class="onoffswitch-switch"></span>
                                                                                    </label> 
                                                                                </span>                                                             
                                                                            </div>   
                                                                        </div>
                                                                    </div>
                                                                </fieldset>

                                                                <div class="form-row">                                                                
                                                                    <!-- 1º Período Presença Obrig. -->
                                                                    <div class="col-lg-4 pr-4">
                                                                        <fieldset class="first-line"> 
                                                                            <header class="frmInnerHeader"><?php echo $ui_1_period_mandatory_presence; ?></header>
                                                                            <div class="form-row box-inside">
                                                                                <div class="col-md-6 mb-3">
                                                                                    <fieldset class="first-line form-group"> 
                                                                                        <header class="frmInnerSubHeader"><span class="preIcon"><i class="fas fa-sign-in-alt"></i></span><?php echo $ui_entry; ?></header>

                                                                                        <div class="form-group ml-5">
                                                                                            <label for="PO_E1"><?php echo $ui_hours; ?></label>
                                                                                            <input class="form-control toRight" name="PO_E1" style="width:50px;">
                                                                                        </div>       
                                                                                        <div class="form-group ml-5">
                                                                                            <label for="TOL_E1"><?php echo $ui_delay; ?></label>
                                                                                            <input class="form-control toRight" name="TOL_E1" style="width:50px;">
                                                                                        </div>       
                                                                                    </fieldset>
                                                                                </div>
                                                                                <div class="col-md-6 mb-3">
                                                                                    <fieldset class="first-line form-group"> 
                                                                                        <header class="frmInnerSubHeader"><span class="preIcon"><i class="fas fa-sign-out-alt"></i></span><?php echo $ui_exit; ?></header>

                                                                                        <div class="form-group ml-5">
                                                                                            <label for="PO_E1"><?php echo $ui_hours; ?></label>
                                                                                            <input class="form-control toRight" name="PO_S1" style="width:50px;">
                                                                                        </div>       
                                                                                        <div class="form-group ml-5">
                                                                                            <label for="TOL_E1"><?php echo $ui_delay; ?></label>
                                                                                            <input class="form-control toRight" name="TOL_S1" style="width:50px;">
                                                                                        </div>       
                                                                                    </fieldset>
                                                                                </div>
                                                                                <div class="col-md-12 mb-3">
                                                                                    <fieldset class="first-line form-group"> 
                                                                                        <header class="frmInnerSubHeader"><?php echo $ui_absence; ?></header>

                                                                                        <div class="form-group ml-5">
                                                                                            <select style="width: 96%;" class="form-control domainLists chosen" name="DSP_AUSENCIA_PRES_OBRG_1"></select>    
                                                                                        </div>
                                                                                    </fieldset>
                                                                                </div>             
                                                                            </div>
                                                                        </fieldset>
                                                                    </div>

                                                                    <!-- Período Refeição -->
                                                                    <div class="col-lg-4 pr-4">                                                                
                                                                        <fieldset class="first-line"> 
                                                                            <header class="frmInnerHeader" style="margin-bottom: 45px;"><?php echo $ui_meal_period; ?></header>
                                                                            <div class="form-row">
                                                                                <div class="col-md-6 mb-3">
                                                                                    <fieldset class="first-line form-group"> 

                                                                                        <div class="form-group ml-5">
                                                                                            <label for="INI_REFEICAO"><?php echo $ui_begin; ?></label>
                                                                                            <input class="form-control toRight" name="INI_REFEICAO" style="width:50px;">
                                                                                        </div>       
                                                                                        <div class="form-group ml-5">
                                                                                            <label for="DURACAO_REFEICAO"><?php echo $ui_duration; ?></label>
                                                                                            <input class="form-control toRight" name="DURACAO_REFEICAO" style="width:50px;">
                                                                                        </div>       
                                                                                    </fieldset>
                                                                                </div>
                                                                                <div class="col-md-6 mb-3">
                                                                                    <fieldset class="first-line form-group"> 

                                                                                        <div class="form-group ml-5">
                                                                                            <label for="FIM_REFEICAO"><?php echo $ui_end; ?></label>
                                                                                            <input class="form-control toRight" name="FIM_REFEICAO" style="width:50px;">
                                                                                        </div>       
                                                                                        <div class="form-group ml-5">
                                                                                            <label for="TOLERANCIA_REFEICAO"><?php echo $ui_delay; ?></label>
                                                                                            <input class="form-control toRight" name="TOLERANCIA_REFEICAO" style="width:50px;">
                                                                                        </div>       
                                                                                    </fieldset>
                                                                                </div>
                                                                                <div class="col-md-12 mb-3">
                                                                                    <fieldset class="first-line form-group"> 
                                                                                        <header class="frmInnerSubHeader"><?php echo $ui_absence; ?></header>

                                                                                        <div class="form-group ml-5">
                                                                                            <select style="width: 96%;" class="form-control domainLists chosen" name="DSP_AUSENCIA_REFEICAO"></select>    
                                                                                        </div>
                                                                                    </fieldset>
                                                                                </div>
                                                                            </div>
                                                                        </fieldset>                                                                        

                                                                    </div>

                                                                    <!-- 2º Período Presença Obrig. -->
                                                                    <div class="col-lg-4 pr-4">
                                                                        <fieldset class="first-line"> 
                                                                            <header class="frmInnerHeader"><?php echo $ui_2_period_mandatory_presence; ?></header>
                                                                            <div class="form-row box-inside">
                                                                                <div class="col-md-6 mb-3">
                                                                                    <fieldset class="first-line form-group"> 
                                                                                        <header class="frmInnerSubHeader"><span class="preIcon"><i class="fas fa-sign-in-alt"></i></span><?php echo $ui_entry; ?></header>

                                                                                        <div class="form-group ml-5">
                                                                                            <label for="PO_E2"><?php echo $ui_hours; ?></label>
                                                                                            <input class="form-control toRight" name="PO_E2" style="width:50px;">
                                                                                        </div>       
                                                                                        <div class="form-group ml-5">
                                                                                            <label for="TOL_E2"><?php echo $ui_delay; ?></label>
                                                                                            <input class="form-control toRight" name="TOL_E2" style="width:50px;">
                                                                                        </div>       
                                                                                    </fieldset>
                                                                                </div>
                                                                                <div class="col-md-6 mb-3">
                                                                                    <fieldset class="first-line form-group"> 
                                                                                        <header class="frmInnerSubHeader"><span class="preIcon"><i class="fas fa-sign-out-alt"></i></span><?php echo $ui_exit; ?></header>

                                                                                        <div class="form-group ml-5">
                                                                                            <label for="PO_E2"><?php echo $ui_hours; ?></label>
                                                                                            <input class="form-control toRight" name="PO_S2" style="width:50px;">
                                                                                        </div>       
                                                                                        <div class="form-group ml-5">
                                                                                            <label for="TOL_E2"><?php echo $ui_delay; ?></label>
                                                                                            <input class="form-control toRight" name="TOL_S2" style="width:50px;">
                                                                                        </div>       
                                                                                    </fieldset>
                                                                                </div>
                                                                                <div class="col-md-12 mb-3">
                                                                                    <fieldset class="first-line form-group"> 
                                                                                        <header class="frmInnerSubHeader"><?php echo $ui_absence; ?></header>

                                                                                        <div class="form-group ml-5">
                                                                                            <select style="width: 96%;" class="form-control domainLists chosen" name="DSP_AUSENCIA_PRES_OBRG_2"></select>    
                                                                                        </div>
                                                                                    </fieldset>
                                                                                </div>
                                                                            </div>
                                                                        </fieldset>
                                                                    </div>   
                                                                </div>
                                                                
                                                                <!-- Compensações -->
                                                                <div class="row">                                                                    
                                                                    <div class="col-lg-12 pr-4">
                                                                        <fieldset class="first-line" style="display: table;margin-right: 15px;"> 
                                                                            <header class="frmInnerHeader"><?php echo $ui_compensations; ?></header>  
                                                                            
                                                                            <div class="table-responsive">
                                                                                <table id="t1" class="table responsive table-bordered table-condensed">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th rowspan="2"></th>
                                                                                            <th colspan="3" class="lightBlue">
                                                                                                <?php echo $ui_1_period; ?>
                                                                                            </th>
    <!--                                                                                        <th rowspan="2" colspan="1" style="text-align:center;vertical-align: middle;background-color: #f6f6f6;">-->
                                                                                            <th c class="lightBlue">
                                                                                                <?php echo $ui_meal_period; ?>
                                                                                            </th>
                                                                                            <th colspan="3" class="lightBlue">
                                                                                                <?php echo $ui_2_period; ?>
                                                                                            </th>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>
                                                                                                <span class="preIcon"><i class="fas fa-sign-in-alt"></i></span>
                                                                                                <?php echo $ui_entry; ?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <span class="preIcon"><i class="far fa-dot-circle"></i></span>                                                                                            
                                                                                                <?php echo $ui_middle_compensate; ?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <span class="preIcon"><i class="fas fa-sign-out-alt"></i></span>
                                                                                                <?php echo $ui_exit; ?>
                                                                                            </th>
                                                                                            <th></th>
                                                                                            <th>
                                                                                                <span class="preIcon"><i class="fas fa-sign-in-alt"></i></span>
                                                                                                <?php echo $ui_entry; ?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <span class="preIcon"><i class="far fa-dot-circle"></i></span>
                                                                                                <?php echo $ui_middle_compensate; ?>
                                                                                            </th>
                                                                                            <th>
                                                                                                <span class="preIcon"><i class="fas fa-sign-out-alt"></i></span>
                                                                                                <?php echo $ui_exit; ?>
                                                                                            </th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <?php echo $ui_where_to_compensate; ?>                                                                                       
                                                                                            </td>
                                                                                            <td>
                                                                                                <div class="onoffswitch-container ">
                                                                                                    <span class="onoffswitch">
                                                                                                        <input type="checkbox" class="onoffswitch-checkbox" id="E1_JUSTIFICA" name="E1_JUSTIFICA">
                                                                                                        <label class="onoffswitch-label" for="E1_JUSTIFICA"> 
                                                                                                            <span class="onoffswitch-inner" data-swchon-text="<?php echo mb_strtoupper($ui_yes, 'UTF-8'); ?>" data-swchoff-text="<?php echo mb_strtoupper($ui_no, 'UTF-8'); ?>"></span> 
                                                                                                            <span class="onoffswitch-switch"></span>
                                                                                                        </label> 
                                                                                                    </span>                                                             
                                                                                                </div>   
                                                                                            </td>
                                                                                            <td>
                                                                                                <div class="onoffswitch-container ">
                                                                                                    <span class="onoffswitch">
                                                                                                        <input type="checkbox" class="onoffswitch-checkbox" id="P1_JUSTIFICA" name="P1_JUSTIFICA">
                                                                                                        <label class="onoffswitch-label" for="P1_JUSTIFICA"> 
                                                                                                            <span class="onoffswitch-inner" data-swchon-text="<?php echo mb_strtoupper($ui_yes, 'UTF-8'); ?>" data-swchoff-text="<?php echo mb_strtoupper($ui_no, 'UTF-8'); ?>"></span> 
                                                                                                            <span class="onoffswitch-switch"></span>
                                                                                                        </label> 
                                                                                                    </span>                                                             
                                                                                                </div>                                                                                           
                                                                                            </td>
                                                                                            <td>
                                                                                                <div class="onoffswitch-container ">
                                                                                                    <span class="onoffswitch">
                                                                                                        <input type="checkbox" class="onoffswitch-checkbox" id="S1_JUSTIFICA" name="S1_JUSTIFICA">
                                                                                                        <label class="onoffswitch-label" for="S1_JUSTIFICA"> 
                                                                                                            <span class="onoffswitch-inner" data-swchon-text="<?php echo mb_strtoupper($ui_yes, 'UTF-8'); ?>" data-swchoff-text="<?php echo mb_strtoupper($ui_no, 'UTF-8'); ?>"></span> 
                                                                                                            <span class="onoffswitch-switch"></span>
                                                                                                        </label> 
                                                                                                    </span>                                                             
                                                                                                </div>       
                                                                                            </td>

                                                                                            <td>
                                                                                                <div class="onoffswitch-container ">
                                                                                                    <span class="onoffswitch">
                                                                                                        <input type="checkbox" class="onoffswitch-checkbox" id="REFEICAO_JUSTIFICA" name="REFEICAO_JUSTIFICA">
                                                                                                        <label class="onoffswitch-label" for="REFEICAO_JUSTIFICA"> 
                                                                                                            <span class="onoffswitch-inner" data-swchon-text="<?php echo mb_strtoupper($ui_yes, 'UTF-8'); ?>" data-swchoff-text="<?php echo mb_strtoupper($ui_no, 'UTF-8'); ?>"></span> 
                                                                                                            <span class="onoffswitch-switch"></span>
                                                                                                        </label> 
                                                                                                    </span>                                                             
                                                                                                </div>
                                                                                            </td>                                                                                        
                                                                                            <td>
                                                                                                <div class="onoffswitch-container ">
                                                                                                    <span class="onoffswitch">
                                                                                                        <input type="checkbox" class="onoffswitch-checkbox" id="E2_JUSTIFICA" name="E2_JUSTIFICA">
                                                                                                        <label class="onoffswitch-label" for="E2_JUSTIFICA"> 
                                                                                                            <span class="onoffswitch-inner" data-swchon-text="<?php echo mb_strtoupper($ui_yes, 'UTF-8'); ?>" data-swchoff-text="<?php echo mb_strtoupper($ui_no, 'UTF-8'); ?>"></span> 
                                                                                                            <span class="onoffswitch-switch"></span>
                                                                                                        </label> 
                                                                                                    </span>                                                             
                                                                                                </div>                                                                                          
                                                                                            </td>
                                                                                            <td>
                                                                                                <div class="onoffswitch-container ">
                                                                                                    <span class="onoffswitch">
                                                                                                        <input type="checkbox" class="onoffswitch-checkbox" id="P2_JUSTIFICA" name="P2_JUSTIFICA">
                                                                                                        <label class="onoffswitch-label" for="P2_JUSTIFICA"> 
                                                                                                            <span class="onoffswitch-inner" data-swchon-text="<?php echo mb_strtoupper($ui_yes, 'UTF-8'); ?>" data-swchoff-text="<?php echo mb_strtoupper($ui_no, 'UTF-8'); ?>"></span> 
                                                                                                            <span class="onoffswitch-switch"></span>
                                                                                                        </label> 
                                                                                                    </span>                                                             
                                                                                                </div>                                                                                            
                                                                                            </td>
                                                                                            <td>
                                                                                                <div class="onoffswitch-container ">
                                                                                                    <span class="onoffswitch">
                                                                                                        <input type="checkbox" class="onoffswitch-checkbox" id="S2_JUSTIFICA" name="S2_JUSTIFICA">
                                                                                                        <label class="onoffswitch-label" for="S2_JUSTIFICA"> 
                                                                                                            <span class="onoffswitch-inner" data-swchon-text="<?php echo mb_strtoupper($ui_yes, 'UTF-8'); ?>" data-swchoff-text="<?php echo mb_strtoupper($ui_no, 'UTF-8'); ?>"></span> 
                                                                                                            <span class="onoffswitch-switch"></span>
                                                                                                        </label> 
                                                                                                    </span>                                                             
                                                                                                </div>                                                                                           
                                                                                            </td>                                                                                        
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                            
                                                                            <div class="table-responsive">
                                                                                <table id="t2" class="table responsive table-bordered table-condensed">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th></th>
                                                                                            <th colspan="2" class="lightBlue">
                                                                                                <?php echo $ui_meal_period; ?>
                                                                                            </th>
                                                                                            <th colspan="2" class="lightBlue">
                                                                                                <?php echo $ui_additional_hours; ?>
                                                                                            </th>
                                                                                            <th colspan="2" class="lightBlue">
                                                                                                <?php echo $ui_overtime_work; ?>
                                                                                            </th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <?php echo $ui_how_to_compensate; ?>                                                                                       
                                                                                            </td>
                                                                                            <td>
                                                                                                <div class="onoffswitch-container ">
                                                                                                    <span class="onoffswitch">
                                                                                                        <input type="checkbox" class="onoffswitch-checkbox" id="USA_REFEICAO" name="USA_REFEICAO">
                                                                                                        <label class="onoffswitch-label" for="USA_REFEICAO"> 
                                                                                                            <span class="onoffswitch-inner" data-swchon-text="<?php echo mb_strtoupper($ui_yes, 'UTF-8'); ?>" data-swchoff-text="<?php echo mb_strtoupper($ui_no, 'UTF-8'); ?>"></span> 
                                                                                                            <span class="onoffswitch-switch"></span>
                                                                                                        </label> 
                                                                                                    </span>                                                             
                                                                                                </div>   
                                                                                            </td>
                                                                                            <td class="other">                                                                         
                                                                                                <input type="number" class="form-control toRight" name="LIM_REFEICAO" disabled style="width:50px;display: inherit;">
                                                                                                <span style="padding-left:5px;color: #999;"><?php echo $ui_limit; ?></span>
                                                                                            </td>
                                                                                            <td class="other">
                                                                                                <div class="onoffswitch-container ">
                                                                                                    <span class="onoffswitch">
                                                                                                        <input type="checkbox" class="onoffswitch-checkbox" id="USA_HORAS_MAIS" name="USA_HORAS_MAIS">
                                                                                                        <label class="onoffswitch-label" for="USA_HORAS_MAIS"> 
                                                                                                            <span class="onoffswitch-inner" data-swchon-text="<?php echo mb_strtoupper($ui_yes, 'UTF-8'); ?>" data-swchoff-text="<?php echo mb_strtoupper($ui_no, 'UTF-8'); ?>"></span> 
                                                                                                            <span class="onoffswitch-switch"></span>
                                                                                                        </label> 
                                                                                                    </span>                                                             
                                                                                                </div>   
                                                                                            </td>
                                                                                            <td class="other">
                                                                                                <input type="number" class="form-control toRight" name="LIM_HORAS_MAIS" style="width:50px;display: inherit;">
                                                                                                <span style="padding-left:5px;color: #999;"><?php echo $ui_limit; ?></span>
                                                                                            </td>
                                                                                            <td class="other">
                                                                                                <div class="onoffswitch-container ">
                                                                                                    <span class="onoffswitch">
                                                                                                        <input type="checkbox" class="onoffswitch-checkbox" id="USA_TS" name="USA_TS">
                                                                                                        <label class="onoffswitch-label" for="USA_TS"> 
                                                                                                            <span class="onoffswitch-inner" data-swchon-text="<?php echo mb_strtoupper($ui_yes, 'UTF-8'); ?>" data-swchoff-text="<?php echo mb_strtoupper($ui_no, 'UTF-8'); ?>"></span> 
                                                                                                            <span class="onoffswitch-switch"></span>
                                                                                                        </label> 
                                                                                                    </span>                                                             
                                                                                                </div>   
                                                                                            </td>
                                                                                            <td class="other">
                                                                                                <input type="number" class="form-control toRight" name="LIM_TS" style="width:50px;display: inherit;">
                                                                                                <span style="padding-left:5px;color: #999;"><?php echo $ui_limit; ?></span>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </fieldset>
                                                                                                                                               
                                                                    </div>
                                                                </div>
                                                                <script>
                                                                    //ACTIVATE TOOLTIP :: TRICK :: Didnt fire any other way !!??       
                                                                    $(function () {
                                                                        $("[rel='tooltip']").tooltip(); 
                                                                    });
                                                                </script>                                                                
                                                            </form>
                                                        </div>
                                                        <div class="tab-pane fade" id="Tab132" role="tabpanel">
                                                            <a id="RH_DEF_REGRA_PONTO_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                            <table id="RH_DEF_REGRA_PONTO_TRADS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                        
                                        <!-- END TAB #1.3 -->
                                        
                                        <!-- TAB #1.4 -->
                                        <div class="tab-pane fade" id="Tab14" role="tabpanel">
                                            <a id="DG_EQUIPAS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="DG_EQUIPAS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                            <div class="row mt-4">
                                                <div class="col-xl-12">
                                                    <div id="panel-11" class="panel">
                                                        <div class="panel-hdr">
                                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                                            <h2><?php echo $ui_translate; ?></h2>
                                                        </div>
                                                        <div class="panel-container show">
                                                            <div class="panel-content">
                                                                <a id="DG_EQUIPASTrads_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                                <table id="DG_EQUIPASTrads" class="table table-bordered table-hover table-striped w-100"></table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                        
                                        <!-- END TAB #1.4 -->
                                        
                                        <!-- TAB #1.5 -->
                                        <div class="tab-pane fade" id="Tab15" role="tabpanel">
                                            <a id="CONTI_TURNOS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="CONTI_TURNOS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                            <div class="row mt-4">
                                                <div class="col-xl-12">
                                                    <div id="panel-11" class="panel">
                                                        <div class="panel-hdr">
                                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                                            <h2><?php echo $ui_translate; ?></h2>
                                                        </div>
                                                        <div class="panel-container show">
                                                            <div class="panel-content">
                                                                <a id="CONTI_TURNOSTrads_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                                <table id="CONTI_TURNOSTrads" class="table table-bordered table-hover table-striped w-100"></table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>       
                                        <!-- END TAB #1.5 -->
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #1 -->

                         <!-- TAB #2 -->
                        <div class="tab-pane fade" id="Tab2" role="tabpanel">
                            <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-start">
                                <div class="panel-toolbar pr-3 align-self-end">
                                    <ul id="panel-tab-2-1" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#Tab21" role="tab" aria-selected="true"><?php echo $ui_definition; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Tab22" role="tab" aria-selected="true"><?php echo $ui_contexts; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Tab23" role="tab" aria-selected="true"><?php echo $ui_legal_framework; ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-container show boxSubTab">
                                <div class="panel-content">
                                    <div class="tab-content">
                                        <!-- TAB #2.1 -->
                                        <div class="tab-pane fade active show" id="Tab21" role="tabpanel">
                                            
                                            <a id="RH_DEF_AUSENCIAS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="RH_DEF_AUSENCIAS" class="table table-bordered table-hover table-striped w-100"></table>
                                            
                                            <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-start">
                                                <div class="panel-toolbar pr-3 align-self-end">
                                                    <ul id="panel-tab-2-2-1" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" data-toggle="tab" href="#Tab221" role="tab" aria-selected="true"><?php echo $ui_details; ?></a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="tab" href="#Tab222" role="tab" aria-selected="true"><?php echo $ui_integrations; ?></a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="tab" href="#Tab223" role="tab" aria-selected="true"><?php echo $ui_deductions; ?></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            
                                            <div class="panel-container show boxSubTab">
                                                <div class="panel-content">
                                                    <div class="tab-content">
                                                        <div class="tab-pane fade active show" id="Tab221" role="tabpanel">
                                                            <form action="" id="RH_DEF_AUSENCIAS_CONTINUED" class="form-horizontal-standard" novalidate="novalidate">
                                                                <div class="quad-alert"></div>
                                                                <form-toolbar></form-toolbar>                                                                        
                                                                <div class="form-row">
                                                                    <!-- Limites Anuais -->
                                                                    <div class="col-sm-6 col-xl-3">
                                                                        <fieldset class="first-line"> 
                                                                            <header class="frmInnerHeader"><?php echo $ui_year; ?></header>
                                                                            <div class="form-row">
                                                                                <div class="form-group col-sm-6">
                                                                                    <label for="MIN_ANO"><?php echo $ui_min; ?></label>
                                                                                    <input class="form-control toRight" name="MIN_ANO" style="width:50px;">
                                                                                </div>
                                                                                <div class="form-group col-sm-6">
                                                                                    <label for="MAX_ANO"><?php echo $ui_max; ?></label>
                                                                                    <input class="form-control toRight" name="MAX_ANO" style="width:50px;">
                                                                                </div>
                                                                            </div>
                                                                        </fieldset>
                                                                    </div>
                                                                    <!-- Limites Mês -->
                                                                    <div class="col-sm-6 col-xl-3">
                                                                        <fieldset class="first-line"> 
                                                                            <header class="frmInnerHeader"><?php echo $ui_month; ?></header>
                                                                            <div class="form-row">
                                                                                <div class="form-group col-sm-6">
                                                                                    <label for="MIN_MES"><?php echo $ui_min; ?></label>
                                                                                    <input class="form-control toRight" name="MIN_MES" style="width:50px;">
                                                                                </div>
                                                                                <div class="form-group col-sm-6">
                                                                                    <label for="MAX_MES"><?php echo $ui_max; ?></label>
                                                                                    <input class="form-control toRight" name="MAX_MES" style="width:50px;">
                                                                                </div>
                                                                            </div>
                                                                        </fieldset>
                                                                    </div>
                                                                    <!-- Limites Ocorrências -->
                                                                    <div class="col-sm-6 col-xl-3">
                                                                        <fieldset class="first-line"> 
                                                                            <header class="frmInnerHeader"><?php echo $ui_occurrences; ?></header>
                                                                            <div class="form-row">
                                                                                <div class="form-group col-sm-6">
                                                                                    <label for="MIN_OCORRENCIAS"><?php echo $ui_min; ?></label>
                                                                                    <input class="form-control toRight" name="MIN_OCORRENCIAS" style="width:50px;">
                                                                                </div>
                                                                                <div class="form-group col-sm-6">
                                                                                    <label for="MAX_OCORRENCIAS"><?php echo $ui_max; ?></label>
                                                                                    <input class="form-control toRight" name="MAX_OCORRENCIAS" style="width:50px;">
                                                                                </div>
                                                                            </div>
                                                                        </fieldset>
                                                                    </div>
                                                                    <!-- Limites Consecutividade -->
                                                                    <div class="col-sm-6 col-xl-3">
                                                                        <fieldset class="first-line"> 
                                                                            <header class="frmInnerHeader"><?php echo $ui_max; ?></header>
                                                                            <div class="form-row">
                                                                                <div class="form-group col-sm-6">
                                                                                    <label for="MIN_CONSECUTIVAS"><?php echo $ui_min; ?></label>
                                                                                    <input class="form-control toRight" name="MIN_CONSECUTIVAS" style="width:50px;">
                                                                                </div>
                                                                                <div class="form-group col-sm-6">
                                                                                    <label for="MAX_CONSECUTIVAS"><?php echo $ui_max; ?></label>
                                                                                    <input class="form-control toRight" name="MAX_CONSECUTIVAS" style="width:50px;">
                                                                                </div>
                                                                            </div>
                                                                        </fieldset>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row">
                                                                    <!-- Regras -->
                                                                    <div class="col-sm-12">
                                                                        <fieldset class="first-line"> 
                                                                            <header class="frmInnerHeader"><?php echo $ui_rules; ?></header>
                                                                            <div class="form-row">
                                                                                <div class="col-sm-6 col-xl-2">
                                                                                    <div class="onoffswitch-container vertical">
                                                                                        <span class="onoffswitch-title required"><?php echo $ui_ss; ?></span> 
                                                                                        <span class="onoffswitch">
                                                                                            <input type="checkbox" class="onoffswitch-checkbox" id="INCLUIR_SS" name="INCLUIR_SS">
                                                                                            <label class="onoffswitch-label" for="INCLUIR_SS"> 
                                                                                                <span class="onoffswitch-inner" data-swchon-text="<?php echo mb_strtoupper($ui_yes, 'UTF-8'); ?>" data-swchoff-text="<?php echo mb_strtoupper($ui_no, 'UTF-8'); ?>"></span> 
                                                                                                <span class="onoffswitch-switch"></span>
                                                                                            </label> 
                                                                                        </span>                                                             
                                                                                    </div>  
                                                                                </div>
                                                                                <div class="col-sm-6 col-xl-2">
                                                                                    <div class="onoffswitch-container vertical">
                                                                                        <span class="onoffswitch-title required"><?php echo $ui_paid_leave; ?></span> 
                                                                                        <span class="onoffswitch">
                                                                                            <input type="checkbox" class="onoffswitch-checkbox" id="REMUNERADA" name="REMUNERADA">
                                                                                            <label class="onoffswitch-label" for="REMUNERADA"> 
                                                                                                <span class="onoffswitch-inner" data-swchon-text="<?php echo mb_strtoupper($ui_yes, 'UTF-8'); ?>" data-swchoff-text="<?php echo mb_strtoupper($ui_no, 'UTF-8'); ?>"></span> 
                                                                                                <span class="onoffswitch-switch"></span>
                                                                                            </label> 
                                                                                        </span>                                                             
                                                                                    </div> 
                                                                                </div>
                                                                                <div class="col-sm-6 col-xl-2">
                                                                                    <div class="onoffswitch-container vertical">
                                                                                        <span class="onoffswitch-title required"><?php echo $ui_merge; ?></span> 
                                                                                        <span class="onoffswitch">
                                                                                            <input type="checkbox" class="onoffswitch-checkbox" id="AGRUPA" name="AGRUPA">
                                                                                            <label class="onoffswitch-label" for="AGRUPA"> 
                                                                                                <span class="onoffswitch-inner" data-swchon-text="<?php echo mb_strtoupper($ui_yes, 'UTF-8'); ?>" data-swchoff-text="<?php echo mb_strtoupper($ui_no, 'UTF-8'); ?>"></span> 
                                                                                                <span class="onoffswitch-switch"></span>
                                                                                            </label> 
                                                                                        </span>                                                             
                                                                                    </div> 
                                                                                </div>
                                                                                <div class="col-sm-6 col-xl-2">
                                                                                    <div class="onoffswitch-container vertical">
                                                                                        <span class="onoffswitch-title required"><?php echo $ui_cga; ?></span> 
                                                                                        <span class="onoffswitch">
                                                                                            <input type="checkbox" class="onoffswitch-checkbox" id="INCLUIR_CGA" name="INCLUIR_CGA">
                                                                                            <label class="onoffswitch-label" for="INCLUIR_CGA"> 
                                                                                                <span class="onoffswitch-inner" data-swchon-text="<?php echo mb_strtoupper($ui_yes, 'UTF-8'); ?>" data-swchoff-text="<?php echo mb_strtoupper($ui_no, 'UTF-8'); ?>"></span> 
                                                                                                <span class="onoffswitch-switch"></span>
                                                                                            </label> 
                                                                                        </span>                                                             
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6 col-xl-2">
                                                                                    <div class="onoffswitch-container vertical">
                                                                                        <span class="onoffswitch-title required"><?php echo $ui_incapacity; ?></span> 
                                                                                        <span class="onoffswitch">
                                                                                            <input type="checkbox" class="onoffswitch-checkbox" id="INCAPACIDADE" name="INCAPACIDADE">
                                                                                            <label class="onoffswitch-label" for="INCAPACIDADE"> 
                                                                                                <span class="onoffswitch-inner" data-swchon-text="<?php echo mb_strtoupper($ui_yes, 'UTF-8'); ?>" data-swchoff-text="<?php echo mb_strtoupper($ui_no, 'UTF-8'); ?>"></span> 
                                                                                                <span class="onoffswitch-switch"></span>
                                                                                            </label> 
                                                                                        </span>                                                             
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6 col-xl-2">
                                                                                    <label for="DOMINIO_INTEGRACAO"><?php echo $ui_integration_period; ?></label>
                                                                                    <select style="width: 96%;" class="form-control domainLists" name="DOMINIO_INTEGRACAO"></select>  
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-row mt-3">
                                                                                <div class="col-sm-6 col-xl-2">
                                                                                    <div class="onoffswitch-container vertical">
                                                                                        <span class="onoffswitch-title required"><?php echo $ui_portal; ?></span> 
                                                                                        <span class="onoffswitch">
                                                                                            <input type="checkbox" class="onoffswitch-checkbox" id="PORTAL" name="PORTAL">
                                                                                            <label class="onoffswitch-label" for="PORTAL"> 
                                                                                                <span class="onoffswitch-inner" data-swchon-text="<?php echo mb_strtoupper($ui_yes, 'UTF-8'); ?>" data-swchoff-text="<?php echo mb_strtoupper($ui_no, 'UTF-8'); ?>"></span> 
                                                                                                <span class="onoffswitch-switch"></span>
                                                                                            </label> 
                                                                                        </span>                                                             
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6 col-xl-2">
                                                                                    <div class="onoffswitch-container vertical">
                                                                                        <span class="onoffswitch-title required"><?php echo $ui_portal_mobilisation; ?></span> 
                                                                                        <span class="onoffswitch">
                                                                                            <input type="checkbox" class="onoffswitch-checkbox" id="PORTAL_MOB_DBH" name="PORTAL_MOB_DBH">
                                                                                            <label class="onoffswitch-label" for="PORTAL"> 
                                                                                                <span class="onoffswitch-inner" data-swchon-text="<?php echo mb_strtoupper($ui_yes, 'UTF-8'); ?>" data-swchoff-text="<?php echo mb_strtoupper($ui_no, 'UTF-8'); ?>"></span> 
                                                                                                <span class="onoffswitch-switch"></span>
                                                                                            </label> 
                                                                                        </span>                                                             
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6 col-xl-2">
                                                                                    <label for="PORTAL_ESTADO"><?php echo $ui_portal_status; ?></label>
                                                                                    <select style="width: 96%;" class="form-control domainLists" name="PORTAL_ESTADO"></select>  
                                                                                </div>                
                                                                                <div class="col-sm-6 col-xl-2">
                                                                                    <label for="RESTRICAO"><?php echo $ui_restriction; ?></label>
                                                                                    <select style="width: 96%;" class="form-control domainLists" name="RESTRICAO"></select>  
                                                                                </div>    
                                                                                <div class="col-sm-6 col-xl-2">
                                                                                    <label for="TP_AUSENCIA"><?php echo $ui_type; ?></label>
                                                                                    <select style="width: 96%;" class="form-control domainLists" name="TP_AUSENCIA"></select>  
                                                                                </div>
                                                                                <div class="col-sm-6 col-xl-2">
                                                                                    <label for="DOC_JUSTIF"><?php echo $ui_document; ?></label>
                                                                                    <input class="form-control" type="text" name="DOC_JUSTIF">
                                                                                </div> 
                                                                            </div>

                                                                            <div class="form-row mt-3">
                                                                                <div class="col-sm-6 col-xl-3">
                                                                                    <label for="DSP_BAL_SOC"><?php echo $ui_relatorio_unico; ?></label>
                                                                                    <select style="width: 96%;" class="form-control domainLists chosen" name="DSP_BAL_SOC"></select> 
                                                                                </div>
                                                                                <div class="col-sm-6 col-xl-3">
                                                                                    <label for="DSP_EJ"><?php echo $ui_legal_framework; ?></label>
                                                                                    <select style="width: 96%;" class="form-control domainLists chosen" name="DSP_EJ"></select> 
                                                                                </div>
                                                                                <div class="col-sm-6 col-xl-3">
                                                                                    <label for="SITUACAO_CGA"><?php echo $ui_cga; ?></label>
                                                                                    <select style="width: 96%;" class="form-control domainLists chosen" name="SITUACAO_CGA"></select> 
                                                                                </div>
                                                                                <div class="col-sm-6 col-xl-3">
                                                                                    <label for="INTERFACE"><?php echo $ui_interface; ?></label>
                                                                                    <select style="width: 96%;" class="form-control domainLists chosen" name="INTERFACE"></select> 
                                                                                </div>

                                                                            </div>
                                                                        </fieldset>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="tab-pane fade" id="Tab222" role="tabpanel">
                                                            <a id="RH_ID_RUBRICAS_INTEGRACAO_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                            <table id="RH_ID_RUBRICAS_INTEGRACAO" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                                        </div>
                                                        <div class="tab-pane fade" id="Tab223" role="tabpanel">
                                                            <a id="RH_DEF_INCIDENCIAS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                            <table id="RH_DEF_INCIDENCIAS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <!-- END TAB #2.1 -->
                                        
                                        <!-- TAB #2.2 -->
                                        <div class="tab-pane fade" id="Tab22" role="tabpanel">
                                            <a id="ContextoAbsent_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="ContextoAbsent" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                            <div class="row mt-4">
                                                <div class="col-xl-12">
                                                    <div id="panel-11" class="panel">
                                                        <div class="panel-hdr">
                                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                                            <h2><?php echo $ui_translate; ?></h2>
                                                        </div>
                                                        <div class="panel-container show">
                                                            <div class="panel-content">
                                                                <a id="ContextoAbsentTrads_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                                <table id="ContextoAbsentTrads" class="table table-bordered table-hover table-striped w-100"></table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                        
                                        <!-- END TAB #2.2 -->
                                        
                                        <!-- TAB #2.3 -->
                                        <div class="tab-pane fade" id="Tab23" role="tabpanel">
                                            <a id="RH_DEF_ENQ_JURIDICOS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="RH_DEF_ENQ_JURIDICOS" class="table table-bordered table-hover table-striped w-100"></table>
                                        </div>                                        
                                        <!-- END TAB #2.3 -->
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #2 -->

                         <!-- TAB #3 -->
                        <div class="tab-pane fade" id="Tab3" role="tabpanel">
                            <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-start">
                                <div class="panel-toolbar pr-3 align-self-end">
                                    <ul id="panel-tab-3-1" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#Tab31" role="tab" aria-selected="true"><?php echo $ui_definition; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Tab32" role="tab" aria-selected="true"><?php echo $ui_motifs; ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-container show boxSubTab">
                                <div class="panel-content">
                                    <div class="tab-content">
                                        <!-- TAB #3.1 -->
                                        <div class="tab-pane fade active show" id="Tab31" role="tabpanel">
                                            
                                            <a id="RH_DEF_TRAB_SUPL_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="RH_DEF_TRAB_SUPL" class="table table-bordered table-hover table-striped w-100"></table>
                                            
                                            <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-start">
                                                <div class="panel-toolbar pr-3 align-self-end">
                                                    <ul id="panel-tab-3-1-1" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" data-toggle="tab" href="#Tab311" role="tab" aria-selected="true"><?php echo $ui_details; ?></a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="tab" href="#Tab312" role="tab" aria-selected="true"><?php echo $ui_integrations; ?></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            
                                            <div class="panel-container show boxSubTab">
                                                <div class="panel-content">
                                                    <div class="tab-content">
                                                        <div class="tab-pane fade active show" id="Tab311" role="tabpanel">
                                                            <form action="" id="RH_DEF_TRAB_SUPL_CONTINUED" class="form-horizontal-standard" novalidate="novalidate">
                                                                <div class="quad-alert"></div>
                                                                <form-toolbar></form-toolbar>
                                                                <div class="form-row">    
                                                                    <div class="col-sm-12 col-lg-6 col-xl-4 pr-4">
                                                                        <!-- Primeiras Horas -->
                                                                        <fieldset class="first-line"> 
                                                                            <header class="frmInnerHeader"><?php echo $ui_first_hours; ?></header>
                                                                            <div class="form-row">                
                                                                                <div class="form-group col-sm-6">
                                                                                    <label for="TP_DISTRIBUICAO"><?php echo $ui_criteria; ?></label>
                                                                                    <select style="width: 96%;" class="form-control domainLists" name="TP_DISTRIBUICAO"></select>
                                                                                </div>
                                                                                <div class="form-group col-sm-6">
                                                                                <div class="form-group col-sm-6">
                                                                                    <div class="onoffswitch-container vertical">
                                                                                        <span class="onoffswitch-title required nobreak"><?php echo $ui_independent; ?></span> 
                                                                                        <span class="onoffswitch">
                                                                                            <input type="checkbox" class="onoffswitch-checkbox" id="HV_TS" name="HV_TS">
                                                                                            <label class="onoffswitch-label" for="HV_TS"> 
                                                                                                <span class="onoffswitch-inner" data-swchon-text="<?php echo mb_strtoupper($ui_yes, 'UTF-8'); ?>" data-swchoff-text="<?php echo mb_strtoupper($ui_no, 'UTF-8'); ?>"></span> 
                                                                                                <span class="onoffswitch-switch"></span>
                                                                                            </label> 
                                                                                        </span>                                                             
                                                                                    </div> 
                                                                                </div>

                                                                            </div>
                                                                        </fieldset>
                                                                    </div>
                                                                    <div class="col-sm-12 col-lg-6 col-xl-3 pr-4">
                                                                        <fieldset class="first-line"> 
                                                                            <header class="frmInnerHeader"><?php echo $ui_limits . " <sup>(".$ui_hours.")</sup>"; ?></header>
                                                                            <div class="form-row">
                                                                                <div class="form-group col-sm-4 nobreak shorten">
                                                                                    <label for="LIM_HRS_SEGUIDAS"><?php echo $ui_consecutive; ?></label>
                                                                                    <input class="form-control toRight half" name="LIM_HRS_SEGUIDAS">                      
                                                                                </div>
                                                                                <div class="form-group col-sm-4 nobreak shorten">
                                                                                    <label for="DESCANSO_OBRIG"><?php echo $ui_mandatory_rest; ?></label>
                                                                                    <input class="form-control toRight half" name="DESCANSO_OBRIG">                      
                                                                                </div>
                                                                                <div class="form-group col-sm-4 nobreak shorten">
                                                                                    <label for="HRS_CTRL_DESCANSO"><?php echo $ui_rest_control_period; ?></label>
                                                                                    <input class="form-control toRight half" name="HRS_CTRL_DESCANSO">                      
                                                                                </div>
                                                                            </div>
                                                                        </fieldset>
                                                                    </div>
                                                                    <div class="col-sm-12 col-lg-12 col-xl-5 pr-4">
                                                                        <fieldset class="first-line"> 
                                                                            <header class="frmInnerHeader"><?php echo $ui_rules; ?></header>
                                                                            <div class="form-row">
                                                                                <div class="form-group col-sm-4 col-lg-6 col-xl-5">
                                                                                        <label for="DSP_MOTIVO_TS_HV"><?php echo $ui_motif; ?></label>
                                                                                        <select class="form-control domainLists chosen w-70 include-help" name="DSP_MOTIVO_TS_HV"></select>
                                                                                        <span class="quad-inner-help" rel="tooltip" data-html="true" data-placement="bottom" 
                                                                                            data-original-title="<?php echo $hint_overtime_default_motif; ?>"><i class="fas fa-info"></i>
                                                                                        </span> 
                                                                                </div>
                                                                                <div class="form-group col-sm-4 col-lg-4 col-xl-5">
                                                                                    <div class="onoffswitch-container vertical">
                                                                                        <span class="onoffswitch-title nobreak shorten"><?php echo $ui_compensatory_rest; ?></span> 
                                                                                        <span class="onoffswitch">
                                                                                            <input type="checkbox" class="onoffswitch-checkbox" id="DISTR_DC_AUTO" name="DISTR_DC_AUTO">
                                                                                            <label class="onoffswitch-label" for="DISTR_DC_AUTO"> 
                                                                                                <span class="onoffswitch-inner" data-swchon-text="<?php echo mb_strtoupper($ui_yes, 'UTF-8'); ?>" data-swchoff-text="<?php echo mb_strtoupper($ui_no, 'UTF-8'); ?>"></span> 
                                                                                                <span class="onoffswitch-switch"></span>
                                                                                            </label> 
                                                                                        </span>                                                                                                                        
                                                                                        <span class="quad-switch-help" rel="tooltip" data-html="true" data-placement="bottom" 
                                                                                            data-original-title="<?php echo $hint_compensatory_rest_automatic; ?>"><i class="fas fa-info"></i>
                                                                                        </span> 
                                                                                    </div>    
                                                                                </div>
                                                                                <div class="form-group col-sm-4 col-lg-2 col-xl-2">
                                                                                    <div class="onoffswitch-container vertical">
                                                                                        <span class="onoffswitch-title"><?php echo $ui_vacation; ?></span> 
                                                                                        <span class="onoffswitch">
                                                                                            <input type="checkbox" class="onoffswitch-checkbox" id="VALIDA_FERIAS" name="VALIDA_FERIAS">
                                                                                            <label class="onoffswitch-label" for="VALIDA_FERIAS"> 
                                                                                                <span class="onoffswitch-inner" data-swchon-text="<?php echo mb_strtoupper($ui_yes, 'UTF-8'); ?>" data-swchoff-text="<?php echo mb_strtoupper($ui_no, 'UTF-8'); ?>"></span> 
                                                                                                <span class="onoffswitch-switch"></span>
                                                                                            </label> 
                                                                                        </span>                                                                                                                        
                                                                                        <span class="quad-switch-help" rel="tooltip" data-html="true" data-placement="bottom" 
                                                                                            data-original-title="<?php echo $hint_vacation_overlap; ?>"><i class="fas fa-info"></i>
                                                                                        </span> 
                                                                                    </div>  
                                                                                </div>
                                                                            </div>
                                                                        </fieldset>
                                                                    </div>
                                                                </div>

                                                                <div class="form-row">
                                                                    <div class="col-sm-12">
                                                                        <!-- Almoço -->
                                                                        <fieldset class="first-line"> 
                                                                            <header class="frmInnerHeader"><?php echo $ui_lunch; ?></header>
                                                                            <div class="form-row">                
                                                                                <div class="form-group col-sm-6 col-xl-2">
                                                                                    <div class="onoffswitch-container vertical">
                                                                                        <span class="onoffswitch-title required nobreak"><?php echo $ui_payment; ?></span> 
                                                                                        <span class="onoffswitch">
                                                                                            <input type="checkbox" class="onoffswitch-checkbox" id="PAG_SUB_ALM" name="PAG_SUB_ALM">
                                                                                            <label class="onoffswitch-label" for="PAG_SUB_ALM"> 
                                                                                                <span class="onoffswitch-inner" data-swchon-text="<?php echo mb_strtoupper($ui_yes, 'UTF-8'); ?>" data-swchoff-text="<?php echo mb_strtoupper($ui_no, 'UTF-8'); ?>"></span> 
                                                                                                <span class="onoffswitch-switch"></span>
                                                                                            </label> 
                                                                                        </span>                                                             
                                                                                    </div> 
                                                                                </div>

                                                                                <div class="form-group col-sm-6 col-xl-2">
                                                                                    <label for="NR_HRS_ABATER_ALM"><?php echo $ui_discounted_hrs; ?></label>
                                                                                    <input class="form-control toRight half" name="NR_HRS_ABATER_ALM">                      
                                                                                </div>
                                                                                <div class="form-group col-sm-6 col-xl-2">
                                                                                    <label for="HR_INI_ALM"><?php echo $ui_start_hr; ?></label>
                                                                                    <input class="form-control toRight half" name="HR_INI_ALM">                      
                                                                                </div>
                                                                                <div class="form-group col-sm-6 col-xl-2">
                                                                                    <label for="HR_FIM_ALM"><?php echo $ui_end_hr; ?></label>
                                                                                    <input class="form-control toRight half" name="HR_FIM_ALM">                      
                                                                                </div>
                                                                                <div class="form-group col-sm-6 col-xl-2">
                                                                                    <label for="HR_LIM_MIN_ALM"><?php echo $ui_min_limit; ?></label>
                                                                                    <input class="form-control toRight half" name="HR_LIM_MIN_ALM">                      
                                                                                </div>
                                                                                <div class="form-group col-sm-6 col-xl-2">
                                                                                    <label for="HR_LIM_MAX_ALM"><?php echo $ui_max_limit; ?></label>
                                                                                    <input class="form-control toRight half" name="HR_LIM_MAX_ALM">                      
                                                                                </div>
                                                                            </div>
                                                                        </fieldset>    
                                                                    </div>                
                                                                </div>

                                                                <div class="form-row">
                                                                    <div class="col-sm-12">
                                                                        <!-- Jantar -->
                                                                        <fieldset class="first-line"> 
                                                                            <header class="frmInnerHeader"><?php echo $ui_dinner; ?></header>
                                                                            <div class="form-row">                
                                                                                <div class="form-group col-sm-6 col-xl-2">
                                                                                    <div class="onoffswitch-container vertical">
                                                                                        <span class="onoffswitch-title required nobreak"><?php echo $ui_payment; ?></span> 
                                                                                        <span class="onoffswitch">
                                                                                            <input type="checkbox" class="onoffswitch-checkbox" id="PAG_SUB_JAN" name="PAG_SUB_JAN">
                                                                                            <label class="onoffswitch-label" for="PAG_SUB_JAN"> 
                                                                                                <span class="onoffswitch-inner" data-swchon-text="<?php echo mb_strtoupper($ui_yes, 'UTF-8'); ?>" data-swchoff-text="<?php echo mb_strtoupper($ui_no, 'UTF-8'); ?>"></span> 
                                                                                                <span class="onoffswitch-switch"></span>
                                                                                            </label> 
                                                                                        </span>                                                             
                                                                                    </div> 
                                                                                </div>

                                                                                <div class="form-group col-sm-6 col-xl-2">
                                                                                    <label for="NR_HRS_ABATER_JAN"><?php echo $ui_discounted_hrs; ?></label>
                                                                                    <input class="form-control toRight half" name="NR_HRS_ABATER_JAN">                      
                                                                                </div>
                                                                                <div class="form-group col-sm-6 col-xl-2">
                                                                                    <label for="HR_INI_JAN"><?php echo $ui_start_hr; ?></label>
                                                                                    <input class="form-control toRight half" name="HR_INI_JAN">                      
                                                                                </div>
                                                                                <div class="form-group col-sm-6 col-xl-2">
                                                                                    <label for="HR_FIM_JAN"><?php echo $ui_end_hr; ?></label>
                                                                                    <input class="form-control toRight half" name="HR_FIM_JAN">                      
                                                                                </div>
                                                                                <div class="form-group col-sm-6 col-xl-2">
                                                                                    <label for="HR_LIM_MIN_JAN"><?php echo $ui_min_limit; ?></label>
                                                                                    <input class="form-control toRight half" name="HR_LIM_MIN_JAN">                      
                                                                                </div>
                                                                                <div class="form-group col-sm-6 col-xl-2">
                                                                                    <label for="HR_LIM_MAX_JAN"><?php echo $ui_max_limit; ?></label>
                                                                                    <input class="form-control toRight half" name="HR_LIM_MAX_JAN">                      
                                                                                </div>
                                                                            </div>
                                                                        </fieldset>    
                                                                    </div>                
                                                                </div>
                                                                <script>
                                                                    //ACTIVATE TOOLTIP :: TRICK :: Didnt fire any other way !!??       
                                                                    $(function () {
                                                                        $("[rel='tooltip']").tooltip(); 
                                                                    });
                                                                </script>  
                                                            </form>
                                                        </div>
                                                        <div class="tab-pane fade" id="Tab312" role="tabpanel">
                                                            <a id="RH_ID_RUBRICAS_INTEGRACAO_TS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                            <table id="RH_ID_RUBRICAS_INTEGRACAO_TS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>                                            
                                        </div>
                                        <!-- END TAB #3.1 -->
                                        
                                        <!-- TAB #3.2 -->
                                        <div class="tab-pane fade" id="Tab32" role="tabpanel">
                                            <a id="RH_DEF_MOTIVOS_TS_HV_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="RH_DEF_MOTIVOS_TS_HV" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                            <div class="row mt-4">
                                                <div class="col-xl-12">
                                                    <div id="panel-11" class="panel">
                                                        <div class="panel-hdr">
                                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                                            <h2><?php echo $ui_translate; ?></h2>
                                                        </div>
                                                        <div class="panel-container show">
                                                            <div class="panel-content">
                                                                <a id="RH_DEF_MOTIVO_TS_HV_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                                <table id="RH_DEF_MOTIVO_TS_HV_TRADS" class="table table-bordered table-hover table-striped w-100"></table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                        
                                        <!-- END TAB #3.2 -->
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #3 -->
                        
                         <!-- TAB #4 -->
                        <div class="tab-pane fade" id="Tab4" role="tabpanel">
                            <a id="RH_DEF_REGRAS_ADAPTABILIDADE_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="RH_DEF_REGRAS_ADAPTABILIDADE" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            
                            <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-start">
                                <div class="panel-toolbar pr-3 align-self-end">
                                    <ul id="panel-tab-4-1" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#Tab41" role="tab" aria-selected="true"><?php echo $ui_details; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Tab42" role="tab" aria-selected="true"><?php echo $ui_timetables; ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-container show boxSubTab">
                                <div class="panel-content">
                                    <div class="tab-content">
                                        <!-- TAB #4.1 -->
                                        <div class="tab-pane fade active show" id="Tab41" role="tabpanel">
                                            <form action="" id="RH_DEF_REGRAS_ADAPTABILIDADE_CONTINUED" class="form-horizontal-standard" novalidate="novalidate">
                                                <div class="quad-alert"></div>
                                                <form-toolbar></form-toolbar>
<div class="form-row">
    <!-- Aplicabilidade -->
    <div class="col-sm-6 col-lg-3 pr-4">
        <fieldset class="first-line"> 
            <header class="frmInnerHeader"><?php echo $ui_applicability; ?></header>
            <div class="form-row">
                <div class="form-group col-sm-8">
                    <label for="PER_REF"><?php echo $ui_duration; ?></label>
                    <input class="form-control toRight half" name="PER_REF">
                </div>
                <div class="form-group col-sm-4">
                    <div class="onoffswitch-container vertical">
                        <span class="onoffswitch-title required"><?php echo $ui_renewable; ?></span> 
                        <span class="onoffswitch">
                            <input type="checkbox" class="onoffswitch-checkbox" id="RENOVAVEL" name="RENOVAVEL" readonly="readonly" disabled="disabled" style="opacity: 1;">
                            <label class="onoffswitch-label" for="RENOVAVEL"> 
                                <span class="onoffswitch-inner" data-swchon-text="SIM" data-swchoff-text="NÃO"></span>
                                <span class="onoffswitch-switch"></span>
                            </label> 
                        </span>
                    </div>
                </div>
                <div class="form-group col-sm-12">
                    <label for="NR_OCORRENCIAS"><?php echo $ui_period; ?></label>
                    <input class="form-control toRight half" name="NR_OCORRENCIAS" style="width: 96%;">
                </div>
                <div class="form-group col-sm-12">
                    <label for="PROCESSO_CONTAGEM"><?php echo $ui_process; ?></label>
                    <select style="width: 96%;" class="form-control domainLists" name="PROCESSO_CONTAGEM"></select> 
                </div>
                <div class="form-group col-sm-12">
                    <label for="INI_CONTAGEM"><?php echo $ui_begin; ?></label>
                    <select style="width: 96%;" class="form-control domainLists" name="INI_CONTAGEM"></select>
                </div>
            </div>
        </fieldset>
    </div>
    <!-- Reduções -->
    <div class="col-sm-6 col-lg-3 pr-4">
        <fieldset class="first-line"> 
            <header class="frmInnerHeader"><?php echo $ui_reductions. ' <sup>('. $hint_hours_limits. ')</sup>'; ?></header>
            <div class="form-row">
                <div class="form-group col-sm-12">
                    <label for="LIM_MINUS_DIA"><?php echo $ui_day; ?></label>
                    <input class="form-control toRight w-50" name="LIM_MINUS_DIA">
                 </div>
                <div class="form-group col-sm-12">
                    <label for="LIM_MINUS_SEM"><?php echo $ui_week; ?></label>
                    <input class="form-control toRight w-50" name="LIM_MINUS_SEM">
                </div>  
                <div class="form-group col-sm-12">
                    <label for="LIM_MINUS_MES"><?php echo $ui_month; ?></label>
                    <input class="form-control toRight w-50" name="LIM_MINUS_MES"> 
                </div>
                <div class="form-group col-sm-12">
                    <label for="LIM_MINUS_ANO"><?php echo $ui_year; ?></label>
                    <input class="form-control toRight w-50" name="LIM_MINUS_ANO">
                </div> 
             </div>
        </fieldset>
    </div>
    
    <!-- Acréscimos -->
    <div class="col-sm-6 col-lg-3 pr-4">
        <fieldset class="first-line"> 
            <header class="frmInnerHeader"><?php echo $ui_accruals. ' <sup>('. $hint_hours_limits. ')</sup>'; ?></header>
            <div class="form-row">
                <div class="form-group col-sm-12">
                    <label for="LIM_PLUS_DIA"><?php echo $ui_day; ?></label>
                    <input class="form-control toRight w-50" name="LIM_PLUS_DIA">
                 </div>
                <div class="form-group col-sm-12">
                    <label for="LIM_PLUS_SEM"><?php echo $ui_week; ?></label>
                    <input class="form-control toRight w-50" name="LIM_PLUS_SEM">
                </div>  
                <div class="form-group col-sm-12">
                    <label for="LIM_PLUS_MES"><?php echo $ui_month; ?></label>
                    <input class="form-control toRight w-50" name="LIM_PLUS_MES">   
                </div>
                <div class="form-group col-sm-12">
                    <label for="LIM_PLUS_ANO"><?php echo $ui_year; ?></label>
                    <input class="form-control toRight w-50" name="LIM_PLUS_ANO">  
                </div> 
             </div>
        </fieldset>
    </div>
    
    <!-- Outros -->
    <div class="col-sm-6 col-lg-3 pr-4">
        <fieldset class="first-line"> 
            <header class="frmInnerHeader"><?php echo $ui_others; ?></header>
            <div class="form-row">
                <div class="form-group col-sm-12">
                    <div class="onoffswitch-container vertical">
                        <span class="onoffswitch-title"><?php echo $ui_IRCT_restrict; ?></span> 
                        <span class="onoffswitch">
                            <input type="checkbox" class="onoffswitch-checkbox" id="VINCULA_IRCT_RHID" name="VINCULA_IRCT_RHID">
                            <label class="onoffswitch-label" for="VINCULA_IRCT_RHID"> 
                                <span class="onoffswitch-inner" data-swchon-text="<?php echo mb_strtoupper($ui_yes, 'UTF-8'); ?>" data-swchoff-text="<?php echo mb_strtoupper($ui_no, 'UTF-8'); ?>"></span> 
                                <span class="onoffswitch-switch"></span>
                            </label> 
                        </span>                                                                                                                        
                        <span class="quad-switch-help" rel="tooltip" data-html="true" data-placement="bottom" 
                            data-original-title="<?php echo $hint_restrict_irct_employees; ?>"><i class="fas fa-info"></i>
                        </span> 
                    </div> 
                 </div>
                <div class="form-group col-sm-12">
                    <label for="ADMITE_PAGAMENTO"><?php echo $ui_payment; ?></label>
                    <input class="form-control toRight half" type="text" name="ADMITE_PAGAMENTO" style="width: 96%;" >
                </div>  
                <div class="form-group col-sm-12">
                    <label for="QUITACOES"><?php echo $ui_discharges; ?></label>
                    <select style="width: 96%;" class="form-control domainLists" name="QUITACOES"></select>        
                </div>
                <div class="form-group col-sm-12">
                    <label for="DSP_RUBRICA"><?php echo $ui_wage_item  ; ?></label>
                    <select style="width: 96%;" class="form-control domainLists" name="DSP_RUBRICA"></select>  
                </div> 
             </div>
        </fieldset>
    </div>    
</div>
                                                <script>
                                                    //ACTIVATE TOOLTIP :: TRICK :: Didnt fire any other way !!??       
                                                    $(function () {
                                                        $("[rel='tooltip']").tooltip(); 
                                                    });
                                                </script>                                                                
                                            </form>
                                        </div>
                                        <!-- END TAB #4.1 -->
                                        
                                        <!-- TAB #4.2 -->
                                        <div class="tab-pane fade" id="Tab42" role="tabpanel">
                                            <a id="RH_DEF_DET_ADAPTABILIDADES_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="RH_DEF_DET_ADAPTABILIDADES" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                        </div>                                        
                                        <!-- END TAB #4.2 -->
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #4 -->
                    </div>                    
                </div>                    

            </div> 
        </div>
    </div>
</div>

<script>
    pageSetUp();    

    $(document).ready(function () {
        
        //Módulo de Gestão Horários
        if (1 === 1) {
            //Horários Diários
            var optionRH_DEF_HORARIO_DIAS = {
                "tableId": "RH_DEF_HORARIO_DIAS",
                "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_daily_schedule; ?>",
                "table": "RH_DEF_HORARIO_DIAS", 
                "pk": {
                    "primary": {
                        "CD_HOR_DIA": {"type": "varchar"}
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
                "detailsObjects": ['RH_DEF_HORARIO_DIA_TRADS'],
                "order_by": "CD_HOR_DIA",
                "scrollY": "507", 
                "recordBundle": 14,
                "pageLenght": 14, 
                "responsive": true,
    //          #CUSTOM DETAIL
    //            https://datatables.net/reference/option/responsive.details.renderer
    //            "responsive": {
    //                "details": {
    //                    renderer: function ( api, rowIdx, columns ) {
    //                        console.log(columns);
    //                        var data = $.map( columns, function ( col, i ) {
    //                            return col.hidden ?
    //                                '<tr data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+
    //                                    '<td>'+col.title+':'+'</td> '+
    //                                    '<td>'+col.data+'</td>'+
    //                                '</tr>' :
    //                                '';
    //                        } ).join('');
    //
    //                        return data ?
    //                            $('<table/>').append( data ) :
    //                            false;
    //                    }
    //                }
    //            },            
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
                        "data": 'CD_HOR_DIA',
                        "name": 'CD_HOR_DIA',
                        "className": "visibleColumn",                   
                    }, {
                        "responsivePriority": 3, 
                        "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_designation; ?>", //Editor
                        "data": 'DSR_HOR_DIA',
                        "name": 'DSR_HOR_DIA',
                        "className": "visibleColumn",
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'CD_REGRA_PONTO',
                        "name": 'CD_REGRA_PONTO',                    
                        "type": "hidden",
                        "visible": false
                    }, {
                        "responsivePriority": 4, 
                        "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                        "title": "<?php echo mb_strtoupper($ui_time_attendance_rule, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_time_attendance_rule; ?>",
                        "data": 'DSP_REGRAS_TP',
                        "name": 'DSP_REGRAS_TP',
                        "type": "select",
                        "className": "visibleColumn",
                        //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                                        
                        "attr": {
                            "dependent-group": "REGRA_PONTO",
                            "dependent-level": 1,
                            "data-db-name": "A.CD_REGRA_PONTO",
                            "decodeFromTable": "RH_DEF_REGRAS_PONTO A",
                            "desigColumn": "CONCAT(CONCAT(A.CD_REGRA_PONTO,'-'),A.DSR_REGRA_PONTO)", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.                        
                            "orderBy": "A.CD_REGRA_PONTO", //usado no complexList.php
                            "class": "form-control complexList chosen",
                            //"disabled": true, //Permite inibir o campo no Editor
                            "whereClause": "",
                            "filter": {
                                "create": " AND A.ACTIVO = 'S'", //On-New-Record
                                "edit": " AND A.ACTIVO = 'S'", //On-Edit-Record
                            }
                        }        
                    }, {
                        "responsivePriority": 5, 
                        "title": "<?php echo mb_strtoupper($ui_day_start, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_day_start; ?>", //Editor
                        "data": 'INICIO_DIA',
                        "name": 'INICIO_DIA',
                        //"datatype": "time24Minutes", //HH24:MI
                        "className": "visibleColumn",
                        "attr": {
                            "class": "form-control dateTimePickerTimeFormatShort timeshort" //(.datepicker OR .dateTimePickerShort OR .dateTimePicker) AND (.minutes OR .seconds for CSS format width)
                        }
                    }, {
                        "responsivePriority": 8, 
                        "title": "<?php echo mb_strtoupper($ui_night_start, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_night_start; ?>", //Editor
                        "data": 'INICIO_NOITE',
                        "name": 'INICIO_NOITE',
                        //"datatype": "time24Minutes", //HH24:MI
                        "className": "visibleColumn",
                        "attr": {
                            "class": "form-control dateTimePickerTimeFormatShort timeshort" //(.datepicker OR .dateTimePickerShort OR .dateTimePicker) AND (.minutes OR .seconds for CSS format width)
                        }
                    }, {
                        "responsivePriority": 9, 
                        "title": "<?php echo mb_strtoupper($ui_night_end, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_night_end; ?>", //Editor
                        "data": 'FIM_NOITE',
                        "name": 'FIM_NOITE',
                        //"datatype": "time24Minutes", //HH24:MI
                        "className": "visibleColumn",
                        "attr": {
                            "class": "form-control dateTimePickerTimeFormatShort timeshort" //(.datepicker OR .dateTimePickerShort OR .dateTimePicker) AND (.minutes OR .seconds for CSS format width)
                        }
                    }, {
                        "responsivePriority": 6, 
                        "title": "<?php echo mb_strtoupper($ui_bh_short, 'UTF-8'); ?>", 
                        "label": "<?php echo $ui_bh_short; ?>", //Editor
                        "data": 'MIN_ESPERADOS',
                        "name": 'MIN_ESPERADOS',
                        "className": "visibleColumn",
                        "type": "hidden", //Editor
                        "visible": true, //DataTables
                        "render": function (val, type, row) {                            
                            if (val != null) {
                                val = QuadTimeToMinutes(val);
                            }
                            return val;
                        }
                    }, {
                        "responsivePriority": 7, 
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
                        "title": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_1_period, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                        "label": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_1_period, 'UTF-8'); ?>" + "</span>", //Editor
                        "data": 'TP_1',
                        "name": 'TP_1',
                        "type": "select",
                        "className": "none visibleColumn",
                        "attr": {
                            "domain-list": true,
                            "dependent-group": 'RH_FAIXA_HORARIA',
                            "class": "form-control"
                        }                
                    }, {
                        "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_entry, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                        "label": "<span class='quadSubTitle'>" + "<?php echo $ui_entry; ?>" + "</span>", //Editor
                        "data": 'HI_1',
                        "name": 'HI_1',
                        "className": "none editorSubTitle visibleColumn",
                        //"datatype": "time24Minutes", //HH24:MI
                        "attr": {
                            "class": "form-control dateTimePickerTimeFormatShort timeshort" //(.datepicker OR .dateTimePickerShort OR .dateTimePicker) AND (.minutes OR .seconds for CSS format width)
                        }                    
                    }, {
                        "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_exit, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                        "label": "<span class='quadSubTitle'>" + "<?php echo $ui_exit; ?>" + "</span>", //Editor
                        "data": 'HF_1',
                        "name": 'HF_1',
                        "className": "none editorSubTitle visibleColumn",
                        //"datatype": "time24Minutes", //HH24:MI
                        "attr": {
                            "class": "form-control dateTimePickerTimeFormatShort timeshort" //(.datepicker OR .dateTimePickerShort OR .dateTimePicker) AND (.minutes OR .seconds for CSS format width)
                        }                    
                    }, {
                        "title": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_2_period, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                        "label": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_2_period, 'UTF-8'); ?>" + "</span>", //Editor
                        "data": 'TP_2',
                        "name": 'TP_2',
                        "type": "select",
                        "className": "none visibleColumn",
                        "attr": {
                            "domain-list": true,
                            "dependent-group": 'RH_FAIXA_HORARIA',
                            "class": "form-control"
                        }              
                    }, {
                        "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_entry, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                        "label": "<span class='quadSubTitle'>" + "<?php echo $ui_entry; ?>" + "</span>", //Editor
                        "data": 'HI_2',
                        "name": 'HI_2',
                        "className": "none editorSubTitle visibleColumn",
                        //"datatype": "time24Minutes", //HH24:MI
                        "attr": {
                            "class": "form-control dateTimePickerTimeFormatShort timeshort" //(.datepicker OR .dateTimePickerShort OR .dateTimePicker) AND (.minutes OR .seconds for CSS format width)
                        }                    
                    }, {
                        "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_exit, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                        "label": "<span class='quadSubTitle'>" + "<?php echo $ui_exit; ?>" + "</span>", //Editor
                        "data": 'HF_2',
                        "name": 'HF_2',
                        "className": "none editorSubTitle visibleColumn",
                        //"datatype": "time24Minutes", //HH24:MI
                        "attr": {
                            "class": "form-control dateTimePickerTimeFormatShort timeshort" //(.datepicker OR .dateTimePickerShort OR .dateTimePicker) AND (.minutes OR .seconds for CSS format width)
                        }                    
                    }, {
                        "title": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_3_period, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                        "label": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_3_period, 'UTF-8'); ?>" + "</span>", //Editor
                        "data": 'TP_3',
                        "name": 'TP_3',
                        "type": "select",
                        "className": "none visibleColumn",
                        "attr": {
                            "domain-list": true,
                            "dependent-group": 'RH_FAIXA_HORARIA',
                            "class": "form-control"
                        }              
                    }, {
                        "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_entry, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                        "label": "<span class='quadSubTitle'>" + "<?php echo $ui_entry; ?>" + "</span>", //Editor
                        "data": 'HI_3',
                        "name": 'HI_3',
                        "className": "none editorSubTitle visibleColumn",
                        //"datatype": "time24Minutes", //HH24:MI
                        "attr": {
                            "class": "form-control dateTimePickerTimeFormatShort timeshort" //(.datepicker OR .dateTimePickerShort OR .dateTimePicker) AND (.minutes OR .seconds for CSS format width)
                        }                    
                    }, {
                        "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_exit, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                        "label": "<span class='quadSubTitle'>" + "<?php echo $ui_exit; ?>" + "</span>", //Editor
                        "data": 'HF_3',
                        "name": 'HF_3',
                        "className": "none editorSubTitle visibleColumn",
                        //"datatype": "time24Minutes", //HH24:MI
                        "attr": {
                            "class": "form-control dateTimePickerTimeFormatShort timeshort" //(.datepicker OR .dateTimePickerShort OR .dateTimePicker) AND (.minutes OR .seconds for CSS format width)
                        }                    
                   }, {
                        "title": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_4_period, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                        "label": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_4_period, 'UTF-8'); ?>" + "</span>", //Editor
                        "data": 'TP_4',
                        "name": 'TP_4',
                        "type": "select",
                        "className": "none visibleColumn",
                        "attr": {
                            "domain-list": true,
                            "dependent-group": 'RH_FAIXA_HORARIA',
                            "class": "form-control"
                        }               
                    }, {
                        "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_entry, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                        "label": "<span class='quadSubTitle'>" + "<?php echo $ui_entry; ?>" + "</span>", //Editor
                        "data": 'HI_4',
                        "name": 'HI_4',
                        "className": "none editorSubTitle visibleColumn",
                        //"datatype": "time24Minutes", //HH24:MI
                        "attr": {
                            "class": "form-control dateTimePickerTimeFormatShort timeshort" //(.datepicker OR .dateTimePickerShort OR .dateTimePicker) AND (.minutes OR .seconds for CSS format width)
                        }                    
                    }, {
                        "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_exit, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                        "label": "<span class='quadSubTitle'>" + "<?php echo $ui_exit; ?>" + "</span>", //Editor
                        "data": 'HF_4',
                        "name": 'HF_4',
                        "className": "none editorSubTitle visibleColumn",
                        //"datatype": "time24Minutes", //HH24:MI
                        "attr": {
                            "class": "form-control dateTimePickerTimeFormatShort timeshort" //(.datepicker OR .dateTimePickerShort OR .dateTimePicker) AND (.minutes OR .seconds for CSS format width)
                        }                    
                   }, {
                        "title": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_5_period, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                        "label": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_5_period, 'UTF-8'); ?>" + "</span>", //Editor
                        "data": 'TP_5',
                        "name": 'TP_5',
                        "type": "select",
                        "className": "none visibleColumn",
                        "attr": {
                            "domain-list": true,
                            "dependent-group": 'RH_FAIXA_HORARIA',
                            "class": "form-control"
                        }                   
                    }, {
                        "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_entry, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                        "label": "<span class='quadSubTitle'>" + "<?php echo $ui_entry; ?>" + "</span>", //Editor
                        "data": 'HI_5',
                        "name": 'HI_5',
                        "className": "none editorSubTitle visibleColumn",
                        //"datatype": "time24Minutes", //HH24:MI
                        "attr": {
                            "class": "form-control dateTimePickerTimeFormatShort timeshort" //(.datepicker OR .dateTimePickerShort OR .dateTimePicker) AND (.minutes OR .seconds for CSS format width)
                        }                    
                    }, {
                        "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_exit, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                        "label": "<span class='quadSubTitle'>" + "<?php echo $ui_exit; ?>" + "</span>", //Editor
                        "data": 'HF_5',
                        "name": 'HF_5',
                        "className": "none editorSubTitle visibleColumn",
                        //"datatype": "time24Minutes", //HH24:MI
                        "attr": {
                            "class": "form-control dateTimePickerTimeFormatShort timeshort" //(.datepicker OR .dateTimePickerShort OR .dateTimePicker) AND (.minutes OR .seconds for CSS format width)
                        }
                   }, {
                        "title": "<?php echo mb_strtoupper($ui_shift, 'UTF-8'); ?>", //Datatables :: Original
                        "label": "<?php echo $ui_shift; ?>" + "</span>", //Editor
                        "data": 'TURNO',
                        "name": 'TURNO',
                        "type": "select",
                        "className": "none visibleColumn",
                        "attr": {
                            "domain-list": true,
                            "dependent-group": 'CONTI_TURNOS',
                            "class": "form-control"
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
                            return RH_DEF_HORARIO_DIAS.crudButtons(true,true,true);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "CD_HOR_DIA": {
                            required: true,
                            maxlength: 6
                        },
                        "DSR_HOR_DIA": {
                            required: true,
                            maxlength: 25,
                        },
                        "INICIO_DIA": {
                            required: true,
                            time24Minutes: true
                        },
                        "INICIO_NOITE": {
                            time24Minutes: true
                        },
                        "FIM_NOITE": {
                            maxlength: 5,
                        },
                        "ACTIVO": {
                            required: true
                        },
                        "HI_1": {
                            time24Minutes: true
                        },
                        "HF_1": {
                            time24Minutes: true
                        },
                        "HI_2": {
                            time24Minutes: true
                        },
                        "HF_2": {
                            time24Minutes: true
                        },
                        "HI_3": {
                            time24Minutes: true
                        },
                        "HF_3": {
                            time24Minutes: true
                        },
                        "HI_4": {
                            time24Minutes: true
                        },
                        "HF_4": {
                            time24Minutes: true
                        },
                        "HI_5": {
                            time24Minutes: true
                        },
                        "HF_5": {
                            time24Minutes: true
                        }
                    }
                }
            };
            RH_DEF_HORARIO_DIAS = new QuadTable();
            RH_DEF_HORARIO_DIAS.initTable( $.extend({}, datatable_instance_defaults, optionRH_DEF_HORARIO_DIAS) );
            //END Horários Diários

            //Horários Diários Trads
            var optionsRH_DEF_HORARIO_DIA_TRADS = {
                "tableId": "RH_DEF_HORARIO_DIA_TRADS",
                "table": "RH_DEF_HORARIO_DIA_TRADS",
                "pk": {
                    "primary": {
                        "CD_HOR_DIA": {"type": "varchar"},                      
                        "CD_LINGUA": {"type": "number"},                    
                        "DT_INI": {"type": "date"}
                    }
                },
                "dependsOn": {
                    "RH_DEF_HORARIO_DIAS": {
                        "CD_HOR_DIA": "CD_HOR_DIA"
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
                        "data": 'CD_HOR_DIA',
                        "name": 'CD_HOR_DIA',                    
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
                        "responsivePriority": 3, 
                        "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_description; ?>", //Editor
                        "data": 'DSR_TRAD',
                        "name": 'DSR_TRAD',                    
                        "className": "visibleColumn",
                    }, {
                        "responsivePriority": 4,
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
                        "responsivePriority": 5, 
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
                            return RH_DEF_HORARIO_DIA_TRADS.crudButtons(true,true,true);
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
                        "DSR_TRAD": {
                            required: true,
                            maxlength: 240,
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
            RH_DEF_HORARIO_DIA_TRADS = new QuadTable();
            RH_DEF_HORARIO_DIA_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsRH_DEF_HORARIO_DIA_TRADS));        
            //END Horários Diários Trads

            //Horários
            var optionRH_DEF_HORARIOS = {
                "tableId": "RH_DEF_HORARIOS",
                "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_schedule; ?>",
                "table": "RH_DEF_HORARIOS", 
                "pk": {
                    "primary": {
                        "CD_HORARIO": {"type": "varchar"},
                        "TP_HORARIO": {"type": "varchar"}
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
                "detailsObjects": ['RH_DEF_DET_HORARIOS','RH_DEF_HORARIO_TRADS'], //,'RH_DEF_HORARIO_DIA_TRADS'],
                "order_by": "CD_HORARIO",
                "scrollY": "195", 
                "recordBundle": 6,
                "pageLenght": 6, 
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
                        "title": "<?php echo mb_strtoupper($ui_type, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                        "label": "<?php echo $ui_type; ?>" + "</span>", //Editor
                        "data": 'TP_HORARIO',
                        "name": 'TP_HORARIO',
                        "type": "select",
                        "className": "visibleColumn",
                        "attr": {
                            "domain-list": true,
                            "dependent-group": 'RH_DEF_HORARIOS.TP_HORARIO',
                            "class": "form-control"
                        },
                        /* DOMAIN'S USADOS COMO BIND VAR's TÊM DE TER O RENDER (fixdata) */
                        "render": function (val, type, row) {
                            if (val != null && val != '') {
                                var o = _.find(initApp.joinsData['RH_DEF_HORARIOS.TP_HORARIO'], {'RV_LOW_VALUE': val});
                                return val == null ? null : o['RV_MEANING'];
                            }
                            return val;
                        }
                    }, {
                        "responsivePriority": 2,
                        "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_code; ?>", //Editor
                        "data": 'CD_HORARIO',
                        "name": 'CD_HORARIO',
                        "className": "visibleColumn",                   
                    }, {
                        "responsivePriority": 3, 
                        "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_designation; ?>", //Editor
                        "data": 'DSR_HORARIO',
                        "name": 'DSR_HORARIO',
                        "className": "visibleColumn",                    
                    }, {
                        "responsivePriority": 4, 
                        "title": "<?php echo mb_strtoupper($ui_week_hours, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_week_hours; ?>", //Editor
                        "data": 'HRS_SEMANA',
                        "name": 'HRS_SEMANA',
                        "className": "visibleColumn right",
                        "attr": {
                            "class": "form-control toRight",
                            "style": "width: 30%;"
                        }
                    }, {
                        "responsivePriority": 5, 
                        "title": "<?php echo mb_strtoupper($ui_daily_hours, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_daily_hours; ?>", //Editor
                        "data": 'HRS_DIA',
                        "name": 'HRS_DIA',
                        "className": "visibleColumn right",
                        "attr": {
                            "class": "form-control toRight",
                            "style": "width: 30%;"
                        }
                    }, {
                        "responsivePriority": 6,
                        "title": "<?php echo mb_strtoupper($ui_partial, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                        "label": "<?php echo $ui_partial; ?>" + "</span>", //Editor
                        "data": 'PARCIAL',
                        "name": 'PARCIAL',
                        "type": "select",
                        "className": "none visibleColumn",
                        "attr": {
                            "domain-list": true,
                            "dependent-group": 'DG_SIM_NAO',
                            "class": "form-control"
                        }                     
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'CD_HORARIO_REF',
                        "name": 'CD_HORARIO_REF',                    
                        "type": "hidden",
                        "visible": false
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'TP_HORARIO_REF',
                        "name": 'TP_HORARIO_REF',                    
                        "type": "hidden",
                        "visible": false
                    }, {
                        "responsivePriority": 7, 
                        "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                        "title": "<?php echo mb_strtoupper($ui_reference_schedule, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_reference_schedule; ?>",
                        "data": 'DSP_HORARIO_REF',
                        "name": 'DSP_HORARIO_REF',
                        "type": "select",
                        "className": "visibleColumn",
                        //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                                        
                        "attr": {
                            "dependent-group": "HORARIO_REF",
                            "dependent-level": 1,
                            "deferred": true,
                            "data-db-name": "A.CD_HORARIO@A.TP_HORARIO",
                            "distribute-value": "CD_HORARIO_REF@TP_HORARIO_REF",
                            "decodeFromTable": "RH_DEF_HORARIOS A",
                            "desigColumn": "CONCAT(CONCAT(A.CD_HORARIO,'-'),A.DSR_HORARIO)", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.                        
                            "orderBy": "A.CD_HORARIO", //usado no complexList.php
                            "class": "form-control complexList chosen",
                            //"disabled": true, //Permite inibir o campo no Editor
                            "whereClause": "",
                            "filter": {
                                "create": " AND A.ACTIVO = 'S' AND (A.CD_HORARIO, A.TP_HORARIO) NOT IN ( SELECT ':CD_HORARIO', ':TP_HORARIO' FROM DUAL) ", //On-New-Record
                                "edit": " AND A.ACTIVO = 'S' AND (A.CD_HORARIO, A.TP_HORARIO) NOT IN ( SELECT ':CD_HORARIO', ':TP_HORARIO' FROM DUAL) ", //On-Edit-Record
                            }
                        }        
                    }, {
                        "responsivePriority": 8,
                        "title": "<?php echo mb_strtoupper($ui_team, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                        "label": "<?php echo $ui_team; ?>" + "</span>", //Editor
                        "data": 'EQUIPA',
                        "name": 'EQUIPA',
                        "type": "select",
                        "className": "visibleColumn",
                        "attr": {
                            "domain-list": true,
                            "dependent-group": 'DG_EQUIPAS',
                            "class": "form-control"
                        }
                    }, {
                        "responsivePriority": 9, 
                        "title": "<?php echo mb_strtoupper($ui_night_start, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_night_start; ?>", //Editor
                        "data": 'INICIO_NOITE',
                        "name": 'INICIO_NOITE',
                        "datatype": "time24Minutes", //HH24:MI
                        "className": "visibleColumn",
                        "attr": {
                            "class": "form-control dateTimePickerTimeFormatShort timeshort" //(.datepicker OR .dateTimePickerShort OR .dateTimePicker) AND (.minutes OR .seconds for CSS format width)
                        }
                    }, {
                        "responsivePriority": 10, 
                        "title": "<?php echo mb_strtoupper($ui_night_end, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_night_end; ?>", //Editor
                        "data": 'FIM_NOITE',
                        "name": 'FIM_NOITE',
                        "datatype": "time24Minutes", //HH24:MI
                        "className": "visibleColumn",
                        "attr": {
                            "class": "form-control dateTimePickerTimeFormatShort timeshort" //(.datepicker OR .dateTimePickerShort OR .dateTimePicker) AND (.minutes OR .seconds for CSS format width)
                        }
                    }, {
                        "responsivePriority": 11, 
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
                            return RH_DEF_HORARIOS.crudButtons(true,true,true);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "CD_HORARIO": {
                            required: true,
                            maxlength: 5
                        },
                        "TP_HORARIO": {
                            required: true
                        },
                        "PARCIAL": {
                            required: true
                        },
                        "DSR_HORARIO": {
                            required: false,
                            maxlength: 50,
                        },
                        "HRS_SEMANA": {
                            number: true,
                        },
                        "HRS_DIA": {
                            number: true,
                        },
                        "INICIO_NOITE": {
                            required: false,
                            maxlength: 5,
                        },
                        "FIM_NOITE": {
                            required: false,
                            maxlength: 5,
                        },
                        "ACTIVO": {
                            required: true
                        }
                    }
                }          
            };
            RH_DEF_HORARIOS = new QuadTable();
            RH_DEF_HORARIOS.initTable( $.extend({}, datatable_instance_defaults, optionRH_DEF_HORARIOS) );
            //END Horários

            //Detalhes de Horários Trads
            var optionsRH_DEF_DET_HORARIOS = {
                "tableId": "RH_DEF_DET_HORARIOS",
                "table": "RH_DEF_DET_HORARIOS",
                "pk": {
                    "primary": {
                        "CD_HORARIO": {"type": "varchar"},
                        "TP_HORARIO": {"type": "varchar"},
                        "CD_HOR_DIA": {"type": "varchar"}
                    }
                },
                "dependsOn": {
                    "RH_DEF_HORARIOS": {
                        "CD_HORARIO": "CD_HORARIO",
                        "TP_HORARIO": "TP_HORARIO"
                    }
                },
                "order_by": "SEQ ASC",
                "recordBundle": 6, 
                "pageLenght": 6, 
                "scrollY": "195",            
                //https://datatables.net/extensions/select/examples/initialisation/single.html
                //JUST ONE ROW SELECTED
                "select": {
                    "style": 'single' //multi
                },
                //"detailsObjects": ['RH_DEF_HORARIO_DIAS_CONTINUED'],
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
                        "data": 'CD_HORARIO',
                        "name": 'CD_HORARIO',                    
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'TP_HORARIO',
                        "name": 'TP_HORARIO',                    
                        "type": "hidden", //Editor
                        "visible": false, //DataTables               
                    }, {
                        "responsivePriority": 2,
                        "title": "<?php echo mb_strtoupper($ui_day, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_day; ?>",
                        "data": 'DIA_TURNO',
                        "name": 'DIA_TURNO',
                        "datatype": 'date',
                        "className": "visibleColumn shift",
                        "attr": {
                            "class": "datepicker shift"
                        },
                        "render": function (val, type, row) {
                            if (val !== null) {
                                var x = new Date(row['DIA_TURNO']).toLocaleString(JS_LANG, {weekday: 'short'});
                                return val + '  <sup class="weekDay"> ' + x.toUpperCase() + ' </sup>';
                            }
                            return val;
                        }
                    }, {
                        "responsivePriority": 2, 
                        "title": "<?php echo mb_strtoupper($ui_week_day, 'UTF-8'); ?>", //Datatables :: Original
                        "label": "<?php echo $ui_week_day; ?>", //Editor
                        "data": 'TP_DIA_SEMANA',
                        "name": 'TP_DIA_SEMANA',
                        "type": "select",
                        "className": "visibleColumn week",
                        "attr": {
                            "domain-list": true,
                            "dependent-group": 'RH_DEF_DET_HORARIOS.TP_DIA_SEMANA',
                            "class": "form-control week"
                        }
                    }, {
                        "responsivePriority": 3, 
                        "title": "<?php echo mb_strtoupper($ui_day_type, 'UTF-8'); ?>", //Datatables :: Original
                        "label": "<?php echo $ui_day_type; ?>", //Editor
                        "data": 'TP_DIA_TURNO',
                        "name": 'TP_DIA_TURNO',
                        "type": "select",
                        "className": "visibleColumn",
                        "attr": {
                            "domain-list": true,
                            "dependent-group": 'RH_DEF_DET_HORARIOS.TP_DIA_TURNO',
                            "class": "form-control"
                        }
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'CD_HOR_DIA',
                        "name": 'CD_HOR_DIA',                    
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "responsivePriority": 2,
                        "complexList": true,
                        "title": "<?php echo mb_strtoupper($ui_daily_schedule, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_daily_schedule; ?>",
                        "data": 'DSR_HOR_DIA',
                        "name": 'DSR_HOR_DIA',
                        "type": "select",
                        "className": "visibleColumn",
                        "attr": {
                            "dependent-group": "HOR_DIA",
                            "dependent-level": 1,
                            "data-db-name": 'A.CD_HOR_DIA',
                            "decodeFromTable": 'RH_DEF_HORARIO_DIAS A',
                            //"otherValues": "DOMINIO('RH_FAIXA_HORARIA',TP_1,'A')@HI_1@HF_1@DOMINIO('RH_FAIXA_HORARIA',TP_2,'A')@HI_2@HF_2@DOMINIO('RH_FAIXA_HORARIA',TP_3,'A')@HI_3@HF_3@DOMINIO('RH_FAIXA_HORARIA',TP_4,'A')@HI_4@HF_4@DOMINIO('RH_FAIXA_HORARIA',TP_5,'A')@HI_5@HF_5",
                            "otherValues": "A.INICIO_DIA@A.INICIO_NOITE@A.FIM_NOITE@A.TP_1@A.HI_1@A.HF_1@A.TP_2@A.HI_2@A.HF_2@A.TP_3@A.HI_3@A.HF_3@A.TP_4@A.HI_4@A.HF_4@A.TP_5@A.HI_5@A.HF_5",
                            "class": "form-control complexList chosen", 
                            "desigColumn": "CONCAT(CONCAT(A.CD_HOR_DIA,'-'),A.DSR_HOR_DIA)", 
                            "orderBy": "A.CD_HOR_DIA",
                            "filter": {
                                "create": " AND A.ACTIVO = 'S'", //On-New-Record
                                "edit": " AND A.ACTIVO = 'S'", //On-Edit-Record
                            }
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
                            return RH_DEF_DET_HORARIOS.crudButtons(true,true,true);
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
                        "DSR_TRAD": {
                            required: true,
                            maxlength: 240,
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
            RH_DEF_DET_HORARIOS = new QuadTable();
            RH_DEF_DET_HORARIOS.initTable($.extend({}, datatable_instance_defaults, optionsRH_DEF_DET_HORARIOS));        
            //END Detalhes de Horários Trads

            //Horários Trads
            var optionsRH_DEF_HORARIO_TRADS = {
                "tableId": "RH_DEF_HORARIO_TRADS",
                "table": "RH_DEF_HORARIO_TRADS",
                "pk": {
                    "primary": {
                        "CD_HORARIO": {"type": "varchar"},
                        "TP_HORARIO": {"type": "varchar"},                      
                        "CD_LINGUA": {"type": "number"},                    
                        "DT_INI": {"type": "date"}
                    }
                },
                "dependsOn": {
                    "RH_DEF_HORARIOS": {
                        "CD_HORARIO": "CD_HORARIO",
                        "TP_HORARIO": "TP_HORARIO"
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
                        "data": 'CD_HORARIO',
                        "name": 'CD_HORARIO',                    
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'TP_HORARIO',
                        "name": 'TP_HORARIO',                    
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
                        "responsivePriority": 3, 
                        "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_description; ?>", //Editor
                        "data": 'DSR_TRAD',
                        "name": 'DSR_TRAD',                    
                        "className": "visibleColumn",
                    }, {
                        "responsivePriority": 4,
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
                        "responsivePriority": 5, 
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
                            return RH_DEF_HORARIO_TRADS.crudButtons(true,true,true);
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
                        "DSR_TRAD": {
                            required: true,
                            maxlength: 240,
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
            RH_DEF_HORARIO_TRADS = new QuadTable();
            RH_DEF_HORARIO_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsRH_DEF_HORARIO_TRADS));        
            //END Horários Trads

            if (1 === 1) {

                function parseHorarioDiario (dados) {  
                    //dados = "INICIO_DIA@INICIO_NOITE@FIM_NOITE@TP_1@HI_1@HF_1@TP_2@HI_2@HF_2@TP_3@HI_3@HF_3@TP_4@HI_4@HF_4@TP_5@HI_5@HF_5",
                    //        "08:00@20:00@08:00@A@07:00@15:00@B@15:00@23:59@B@00:00@06:59@@@@@@"
                    var arr = dados.split("@"), cnt = arr.length - 1, html_ = "";
                    for (var i = 0; i < arr.length; i++) {
                        if ( arr[i].length ) {
                            if (i === 0) {
                                html_ = '<div class="row one">';
                                //<i class="far fa-calendar-day"></i> OU <i class="far fa-alarm-clock"></i> OU <i class="far fa-clock"></i>
                                html_ += '<span class="dayStart" rel="tooltip" data-placement="top" class="notifyThis" data-original-title=" ' + "<?php echo $ui_day_start; ?>"+ '"><i class="far fa-calendar-day"></i> ' + arr[i]+ '</span>';
                                i++;
                                html_ += '<span class="nightStart" rel="tooltip" data-placement="top" class="notifyThis" data-original-title=" ' + "<?php echo $ui_night_start; ?>"+ '"><i class="far fa-sunset"></i> ' + arr[i]+ '</span>';
                                i++;
                                html_ += '<span class="nightEnd" rel="tooltip" data-placement="top" class="notifyThis" data-original-title=" ' + "<?php echo $ui_night_end; ?>"+ '"><i class="far fa-sunrise"></i> ' + arr[i]+ '</span>';
                                html_ += '</div>';
                            }

                            //Tipos de Dia
                            if (i === 3 || i === 6 || i === 9 || i === 12 || i === 15) {                            

                                if (arr[i] === 'A') { //Ponto Esperado
                                    html_ += '<div class="row period expected">';
                                    html_ += '<span rel="tooltip" data-placement="left" class="notifyThis" data-original-title=" ' + "<?php echo $ui_workhours_foreseen_long; ?>"+ '"><i class="far fa-alarm-clock"></i>  ';
                                } else { //Potencial Trabalho Suplmentar
                                    html_ += '<div class="row period overtime">';
                                    html_ += '<span rel="tooltip" data-placement="left" class="notifyThis" data-original-title=" ' + "<?php echo $ui_potencial_overtime; ?>"+ '"><i class="far fa-calendar-plus"></i>  ';
                                }
                                i++;

                                //Entradas ~ Saidas
                                if (i === 4 || i === 7 || i === 10 || i === 13 || i === 16) {                            
                                    html_ += arr[i] + ' ~ ' + arr[++i] + '</span>';
                                }
                                html_ += '</div>';                            
                            }

                        } else {
                            break;
                        }
                    }
                    return html_;
                }

                //DEF HORARIOS :: SHOW HIDE COLUMNS on DETAIL
                $(document).on('click', '#RH_DEF_HORARIOS > tbody', function (ev) {
                    ev.stopImmediatePropagation();
                    var masterRecordData = RH_DEF_HORARIOS.selectedRowData();

                    //Clean Horário Diário Info
                    $('#DSP_HOR_DIARIO').html('');
                    $('#horarioDiarioInfo').hide('slow');

                    if (RH_DEF_HORARIOS.tbl.rows( '.selected' ).any()){ //ROW on MASTER IS SELECTED
                        if (masterRecordData['TP_HORARIO'] === 'S') { //Horário Semanal
                            refreshQuadTable(RH_DEF_DET_HORARIOS, null, 
                                {
                                    show: ['TP_DIA_SEMANA'],
                                    hide: ['DIA_TURNO']
                                }
                            );
                        } else { //Horário Turno
                            refreshQuadTable(RH_DEF_DET_HORARIOS, null, 
                                {
                                    hide: ['TP_DIA_SEMANA'],
                                    show: ['DIA_TURNO']
                                }
                            );
                        }
                    }
                });

                //DEF HORARIOS :: SHOW HIDE COLUMNS on EDITOR
                $(document).on('#RH_DEF_DET_HORARIOSAttachEvt', function (e) {
                    var masterRecordData = RH_DEF_HORARIOS.selectedRowData();
                    if (RH_DEF_HORARIOS.tbl.rows( '.selected' ).any()){ //ROW on MASTER IS SELECTED
                        if (masterRecordData['TP_HORARIO'] === 'S') { //Horário Semanal

                            setTimeout( function() {
                                    //SHOW SEMANAL INFO:
                                    $(':input','#RH_DEF_DET_HORARIOS_editorForm').each(function( index ) {
                                        if ( $(this).hasClass('week') ) {
                                            $( this ).parents().eq(2).css('display', '');
                                        }
                                    });

                                    //HIDE TURNO INFO:
                                    $(':input','#RH_DEF_DET_HORARIOS_editorForm').each(function( index ) {
                                        if ( $(this).hasClass('shift') ) {
                                            $( this ).parents().eq(2).css('display', 'none');
                                        }
                                    });
                            }, 250);  

                        } else { //Horário Turno

                            setTimeout( function() {
                                    //HIDE SEMANAL INFO:
                                    $(':input','#RH_DEF_DET_HORARIOS_editorForm').each(function( index ) {
                                        if ( $(this).hasClass('week') ) {
                                            $( this ).parents().eq(2).css('display', 'none');
                                        }
                                    });

                                    //SHOW TURNO INFO:
                                    $(':input','#RH_DEF_DET_HORARIOS_editorForm').each(function( index ) {
                                        if ( $(this).hasClass('shift') ) {
                                            $( this ).parents().eq(2).css('display', '');
                                        }
                                    });
                            }, 250);  
                        }
                    }                
                });

                //DEF HORARIOS :: SHOW DETAIL
                $(document).on('click', '#RH_DEF_DET_HORARIOS > tbody', function (ev) {
                    ev.stopImmediatePropagation();
                    var selectedRow = RH_DEF_DET_HORARIOS.selectedRowData();

                    //Clean Horário Diário Info                
                    $('#DSP_HOR_DIARIO').html('');
                    $('#horarioDiarioInfo').hide('slow');

                    if (RH_DEF_DET_HORARIOS.tbl.rows( '.selected' ).any()){ 

                        //RECURSO DOMAIN :: GET RESOURCE
                        // var res=initApp.joinsData["RH_DEF_HORARIOS.TP_HORARIO"]

                        //RECURSO LISTA COMPLEXA :: GET RESOURCE :: GET LOV VALUE
                        var res = RH_DEF_DET_HORARIOS.getComplexListIndex( _.find(RH_DEF_DET_HORARIOS.tableCols, {name: "DSR_HOR_DIA"}) );

                        //Procura no RECURSO o valor de uma COLUNA NO REGISTO SELECIONADO (Cd. Horário Diario)
                        var data = _.find(res, {VAL: selectedRow['CD_HOR_DIA']});
                        //console.log(data['OTHERVALUES']);

                        if (data['OTHERVALUES'].replace('@','').length) {
                            var html_ = parseHorarioDiario (data['OTHERVALUES']); //data['OTHERVALUES']);                        
                            $('#DSP_HOR_DIARIO').html(html_);
                            $("[rel='tooltip']").tooltip();
                            $('#horarioDiarioInfo').slideDown({
                                        "duration": 600, 
                                        "easing": 'swing',
                                        "start": function() {
                                            $(this).css('opacity','0.0');//.css('font-size', '0.0em');
                                        },
                                        "step": function() {
                                            var opac = $(this).css('opacity');
                                            $(this).css('opacity', Number(opac) + Number(0.1) ); //.css('font-size', Number(opac) + Number(0.1)+'em');
                                        },
                                        "complete": function() {
                                        }
                                    }).css('animation-timing-function','cubic-bezier(0, 0, 0.79, 0.99)'); 
                        }
                    } else {
                        //Clean Horário Diário Info
                        $('#DSP_HOR_DIARIO').html('');
                        $('#horarioDiarioInfo').hide('slow');

                    }
                });
            }

            //Regras Tratamento Ponto
            var optionRH_DEF_REGRAS_PONTO = {
                "tableId": "RH_DEF_REGRAS_PONTO",
                "table": "RH_DEF_REGRAS_PONTO", 
                "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_time_attendance_rule; ?>",
                "pk": {
                    "primary": {
                        "CD_REGRA_PONTO": {"type": "varchar"}
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
                "detailsObjects": ['RH_DEF_REGRAS_PONTO_CONTINUED','RH_DEF_REGRA_PONTO_TRADS'],
                "order_by": "CD_REGRA_PONTO",
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
                        "data": 'CD_REGRA_PONTO',
                        "name": 'CD_REGRA_PONTO',
                        "className": "visibleColumn",                   
                    }, {
                        "responsivePriority": 3, 
                        "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_designation; ?>", //Editor
                        "data": 'DSR_REGRA_PONTO',
                        "name": 'DSR_REGRA_PONTO',
                        "className": "visibleColumn",       
                    }, {
                        "responsivePriority": 4, 
                        "title": "<?php echo mb_strtoupper($ui_cycle, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_cycle; ?>", //Editor
                        "data": 'DIAS_CICLO',
                        "name": 'DIAS_CICLO',
                        "def": "1",
                        "className": "visibleColumn right",
                        "attr": {
                            "class": "form-control toRight",
                            "style": "width: 30%;"
                        }   
                    }, {
                        "responsivePriority": 5, 
                        "title": "<?php echo mb_strtoupper($ui_time_expected_entries, 'UTF-8'); ?>", //Datatables :: Original
                        "label": "<?php echo $ui_time_expected_entries; ?>", //Editor
                        "data": 'MARCACOES_ESPERADAS',
                        "name": 'MARCACOES_ESPERADAS',
                        "type": "select",
                        "def": "S",
                        "className": "visibleColumn",
                        "attr": {
                            "domain-list": true,
                            "dependent-group": 'RH_DEF_REGRAS_PONTO.MARCACOES_ESPERADAS',
                            "class": "form-control"
                        }                  
                    }, {
                        "responsivePriority": 6, 
                        "title": "<?php echo mb_strtoupper($ui_rejection_time, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_rejection_time; ?>", //Editor
                        "data": 'INTERVALO_REJEICAO',
                        "name": 'INTERVALO_REJEICAO',
                        "className": "visibleColumn right",
                        "attr": {
                            "class": "form-control toRight",
                            "style": "width: 30%;"
                        }      
                    }, {
                        "responsivePriority": 7, 
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
                            "class": "form-control"
                        },
                        //Tem de ser incluído por ser uma coluna usada no CRUD que (sem o render) o compara com o RV_MEANING e não com o valor
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
                            return RH_DEF_REGRAS_PONTO.crudButtons(true,true,true);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "CD_REGRA_PONTO": {
                            required: true,
                            maxlength: 5
                        },
                        "DSR_REGRA_PONTO": {
                            required: true,
                            maxlength: 25,
                        },
                        "DIAS_CICLO": {
                            required: true,
                            number: true
                        },
                        "MARCACOES_ESPERADAS": {
                            required: true
                        },
                        "HORAS_OBRIGATORIO": {
                            required: false,
                            number: true
                        },
                        "ACTIVO": {
                            required: true
                        }
                    }
                }
            };
            RH_DEF_REGRAS_PONTO = new QuadTable();
            RH_DEF_REGRAS_PONTO.initTable( $.extend({}, datatable_instance_defaults, optionRH_DEF_REGRAS_PONTO) );
            //END Regras Tratamento Ponto

            //Regras Tratamento Ponto Continued :: QUADFORMS
            var optionsRH_DEF_REGRAS_PONTO_CONTINUED = {
                formId: "#RH_DEF_REGRAS_PONTO_CONTINUED",
                table: "RH_DEF_REGRAS_PONTO",
                info: true, //Disables INFO: (record / total records) :: HOW ????
                "pk": {
                    "primary": {
                        "CD_REGRA_PONTO": {"type": "varchar"}
                    }
                },
                "dependsOn": {
                    "RH_DEF_REGRAS_PONTO": {
                        "CD_REGRA_PONTO": "CD_REGRA_PONTO"
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
                dateFields: {
                    "DT_EFICACIA": "date",
                    "DT_INI_RA": "date"                                                                
                },
                domainLists: { 
                    DIA_FECHO: {
                         "domain-list": true,
                         "dependent-group": "DG_DIAS_SEMANA"
                    },
                    TS_ESTADO: {
                         "domain-list": true,
                         "dependent-group": "RH_ESTADO_PONTO"
                    },
                    BUILD_FROM: {
                         "domain-list": true,
                         "dependent-group": "RH_DEF_REGRAS_PONTO.BUILD_FROM"
                    },
                },
                complexLists: {
                    "DSP_AUSENCIA_CICLO": {
                        "name": "DSP_AUSENCIA_CICLO",
                        "dependent-group": "AUSENCIAS",
                        "dependent-level": 1,
                        "data-db-name": 'A.CD_AUSENCIA',
                        "distribute-value": "CD_AUSENCIA_CICLO",
                        "decodeFromTable": 'RH_DEF_AUSENCIAS A',
                        "desigColumn": "A.DSP_AUSENCIA",
                        'orderBy': 'A.CD_AUSENCIA',
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.ACTIVO = 'S'", //On-New-Record
                            "edit": " AND A.ACTIVO = 'S'", //On-Edit-Record
                        }
                    },
                    "DSP_AUSENCIA_PRES_OBRG_1": {
                        "name": "DSP_AUSENCIA_PRES_OBRG_1",
                        "dependent-group": "AUSENCIAS",
                        "dependent-level": 1,
                        "data-db-name": 'A.CD_AUSENCIA',
                        "distribute-value": "CD_AUSENCIA_PRESENCA_OBRG_2",
                        "decodeFromTable": 'RH_DEF_AUSENCIAS A',
                        "desigColumn": "A.DSP_AUSENCIA",
                        'orderBy': 'A.CD_AUSENCIA',
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.ACTIVO = 'S'", //On-New-Record
                            "edit": " AND A.ACTIVO = 'S'", //On-Edit-Record
                        }
                    },
                    "DSP_AUSENCIA_PRES_OBRG_2": {
                        "name": "DSP_AUSENCIA_PRES_OBRG_2",
                        "dependent-group": "AUSENCIAS",
                        "dependent-level": 1,
                        "data-db-name": 'A.CD_AUSENCIA',
                        "distribute-value": "CD_AUSENCIA_PRESENCA_OBRG_2",
                        "decodeFromTable": 'RH_DEF_AUSENCIAS A',
                        "desigColumn": "A.DSP_AUSENCIA",
                        'orderBy': 'A.CD_AUSENCIA',
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.ACTIVO = 'S'", //On-New-Record
                            "edit": " AND A.ACTIVO = 'S'", //On-Edit-Record
                        }
                    },
                    "DSP_AUSENCIA_REFEICAO": {
                        "name": "DSP_AUSENCIA_REFEICAO",
                        "dependent-group": "AUSENCIAS",
                        "dependent-level": 1,
                        "data-db-name": 'A.CD_AUSENCIA',
                        "distribute-value": "CD_AUSENCIA_REFEICAO",
                        "decodeFromTable": 'RH_DEF_AUSENCIAS A',
                        "desigColumn": "A.DSP_AUSENCIA",
                        'orderBy': 'A.CD_AUSENCIA',
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.ACTIVO = 'S'", //On-New-Record
                            "edit": " AND A.ACTIVO = 'S'", //On-Edit-Record
                        }
                    },
                },           
                "validations": {
                    "rules": {
                        "TOLERANCIA_CICLO": {
                            required: true,
                            number: true
                        },
                        "HORAS_OBRIGATORIO": {
                            required: true,
                            number: true
                        },
                        "HORAS_CICLO": {
                            number: true
                        },
                        "COMPENSACAO_DIARIA": {
                            number: true
                        },
                        "FIM_MES_ANTECIPA_CICLO": {
                            required: true
                        },
                        "FAIXA_ANTERIOR": {
                            number: true
                        },
                        "FAIXA_POSTERIOR": {
                            number: true
                        },
                        "TS_MINIMO": {
                            number: true
                        },
                        "TS_BLOCOS": {
                            number: true
                        },
                        "DISTRIBUIR_TS": {
                            required: true
                        },
                        "TS_ESTADO": {
                            required: true
                        },
                        "PO_E1": {
                            maxlength: 5
                        },
                        "PO_S1": {
                            maxlength: 5
                        },
                        "PO_E2": {
                            maxlength: 5
                        },
                        "PO_S2": {
                            maxlength: 5
                        },
                        "INI_REFEICAO": {
                            maxlength: 5
                        },
                        "FIM_REFEICAO": {
                            maxlength: 5
                        },
                        "INICIO_NOITE": {
                            maxlength: 5
                        },
                        "FIM_NOITE": {
                            maxlength: 5
                        },
                        "TOL_E1": {
                            number: true
                        },
                        "TOL_S1": {
                            number: true
                        },
                        "TOL_E2": {
                            number: true
                        },
                        "TOL_S2": {
                            number: true
                        },
                        "DURACAO_REFEICAO": {
                            number: true
                        },
                        "TOLERANCIA_REFEICAO": {
                            number: true
                        },
                        "LIM_REFEICAO": {
                            number: true
                        },
                        "LIM_TS": {
                            number: true
                        },
                        "LIM_HORAS_MAIS": {
                            number: true
                        }
                    }
                }                
            };        
            RH_DEF_REGRAS_PONTO_CONTINUED = new QuadForm();
            RH_DEF_REGRAS_PONTO_CONTINUED.initForm($.extend({}, datatable_instance_defaults, optionsRH_DEF_REGRAS_PONTO_CONTINUED));
            //Regras Tratamento Ponto Continued :: QUADFORMS        

            //Events Definition
            if (1 === 1) {
                /* QUADFORMS :: Situações Continued :: DOUBLE-CLICK -> EDIT RECORD */
                $('#RH_DEF_REGRAS_PONTO_CONTINUED').dblclick(function() {
                    var el = $("#RH_DEF_REGRAS_PONTO_CONTINUED").find("[data-form-action='edit']");  
                    if (el.css('display') !== 'none' && (el.attr('disabled') === undefined || el.attr('disabled') === false) ) { //SÓ SE O BOTÃO ESTIVER VISÍVEL e ENABLED
                        el.trigger('click');
                    }
                });

                //$('input.onoffswitch-checkbox').on('change', function () { -> DOESN't RUN IF NOT ON FIRST ACTIVE PAGE...
                $(document).on('click', 'input.onoffswitch-checkbox', function () {
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

                //Specific validations
                $(document).on('click', "#USA_REFEICAO", function (evt) {
                    if ($(this).val() === 'S') {
                        $('input[name="LIM_REFEICAO"]', '#RH_DEF_REGRAS_PONTO_CONTINUED').prop('disabled', true);
                    } else {
                        $('input[name="LIM_REFEICAO"]', '#RH_DEF_REGRAS_PONTO_CONTINUED').prop('disabled', false);
                    }            
                });

                $(document).on('click', "#USA_HORAS_MAIS", function (evt) {
                    if ($(this).val() === 'S') {
                        $('input[name="LIM_HORAS_MAIS"]', '#RH_DEF_REGRAS_PONTO_CONTINUED').prop('disabled', true);
                    } else {
                        $('input[name="LIM_HORAS_MAIS"]', '#RH_DEF_REGRAS_PONTO_CONTINUED').prop('disabled', false);
                    }            
                });        

                $(document).on('click', "#USA_TS", function (evt) {
                    if ($(this).val() === 'S') {
                        $('input[name="LIM_TS"]', '#RH_DEF_REGRAS_PONTO_CONTINUED').prop('disabled', true);
                    } else {
                        $('input[name="LIM_TS"]', '#RH_DEF_REGRAS_PONTO_CONTINUED').prop('disabled', false);
                    }            
                });     
                //END Specific validations
            }     
            //END Events Definition           

            //Regras Tratamento Ponto Trads
            var optionsRH_DEF_REGRA_PONTO_TRADS = {
                "tableId": "RH_DEF_REGRA_PONTO_TRADS",
                "table": "RH_DEF_REGRA_PONTO_TRADS",
                "pk": {
                    "primary": {
                        "CD_REGRA_PONTO": {"type": "varchar"},                     
                        "CD_LINGUA": {"type": "number"},                    
                        "DT_INI": {"type": "date"}
                    }
                },
                "dependsOn": {
                    "RH_DEF_REGRAS_PONTO": {
                        "CD_REGRA_PONTO": "CD_REGRA_PONTO"
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
                        "data": 'CD_REGRA_PONTO',
                        "name": 'CD_REGRA_PONTO',                    
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
                        "responsivePriority": 3, 
                        "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_description; ?>", //Editor
                        "data": 'DSR_TRAD',
                        "name": 'DSR_TRAD',                    
                        "className": "visibleColumn",
                    }, {
                        "responsivePriority": 4,
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
                        "responsivePriority": 5, 
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
                            return RH_DEF_REGRA_PONTO_TRADS.crudButtons(true,true,true);
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
                        "DSR_TRAD": {
                            required: true,
                            maxlength: 240,
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
            RH_DEF_REGRA_PONTO_TRADS = new QuadTable();
            RH_DEF_REGRA_PONTO_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsRH_DEF_REGRA_PONTO_TRADS));        
            //END Regras Tratamento Ponto Trads        

            //Equipas Domain
            var optionsDG_EQUIPAS = {
                "tableId": 'DG_EQUIPAS',
                "table": "CG_REF_CODES",
                "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_team; ?>",            
                "pk": {
                    "primary": {
                        "RV_DOMAIN": {"type": "varchar"},
                        "RV_LOW_VALUE": {"type": "varchar"}
                    }
                },
                "detailsObjects": ['DG_EQUIPASTrads'],
                "initialWhereClause": "RV_DOMAIN = 'DG_EQUIPAS' ",
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
                        "def": "DG_EQUIPAS",
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
                            return DG_EQUIPAS.crudButtons(false, true, false);
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
            DG_EQUIPAS = new QuadTable();
            DG_EQUIPAS.initTable($.extend({}, datatable_instance_defaults, optionsDG_EQUIPAS));
            //END Equipas Domain

            //Equipas Domain Trads
            var optionsDG_EQUIPASTrads = {
                "tableId": 'DG_EQUIPASTrads',
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
                    DG_EQUIPAS: {
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
                            return DG_EQUIPASTrads.crudButtons(true, true, true);
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
            DG_EQUIPASTrads = new QuadTable();
            DG_EQUIPASTrads.initTable($.extend({}, datatable_instance_defaults, optionsDG_EQUIPASTrads));
            // End Equipas Domain Trads        

            //Turnos Domain
            var optionsCONTI_TURNOS = {
                "tableId": 'CONTI_TURNOS',
                "table": "CG_REF_CODES",
                "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_shift; ?>",            
                "pk": {
                    "primary": {
                        "RV_DOMAIN": {"type": "varchar"},
                        "RV_LOW_VALUE": {"type": "varchar"}
                    }
                },
                "detailsObjects": ['CONTI_TURNOSTrads'],
                "initialWhereClause": "RV_DOMAIN = 'CONTI_TURNOS' ",
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
                        "def": "CONTI_TURNOS",
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
                            return CONTI_TURNOS.crudButtons(false, true, false);
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
            CONTI_TURNOS = new QuadTable();
            CONTI_TURNOS.initTable($.extend({}, datatable_instance_defaults, optionsCONTI_TURNOS));
            //Turnos Domain

            //Turnos Domain Trads
            var optionsCONTI_TURNOSTrads = {
                "tableId": 'CONTI_TURNOSTrads',
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
                    CONTI_TURNOS: {
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
                            return CONTI_TURNOSTrads.crudButtons(true, true, true);
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
            CONTI_TURNOSTrads = new QuadTable();
            CONTI_TURNOSTrads.initTable($.extend({}, datatable_instance_defaults, optionsCONTI_TURNOSTrads));
            // End Turnos Domain Trads
        }
        //END Módulo de Gestão Horários
        
        //Módulo de Absentismo
        if (1 === 1) {
            //Ausências
            var optionRH_DEF_AUSENCIAS = {
                "tableId": "RH_DEF_AUSENCIAS",
                "table": "RH_DEF_AUSENCIAS", 
                "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_absence; ?>",
                "pk": {
                    "primary": {
                        "CD_AUSENCIA": {"type": "varchar"}
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
                "detailsObjects": ['RH_DEF_AUSENCIAS_CONTINUED','RH_ID_RUBRICAS_INTEGRACAO','RH_DEF_INCIDENCIAS'],
                "order_by": "CD_AUSENCIA",
                "recordBundle": 6, 
                "pageLenght": 6, 
                "scrollY": "195",   
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
                        "data": 'CD_AUSENCIA',
                        "name": 'CD_AUSENCIA',
                        "className": "visibleColumn",                   
                    }, {
                        "responsivePriority": 3, 
                        "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_designation; ?>", //Editor
                        "data": 'DSP_AUSENCIA',
                        "name": 'DSP_AUSENCIA',
                        "className": "visibleColumn",       
                    }, {
                        "responsivePriority": 4, 
                        "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_short_desig; ?>", //Editor
                        "data": 'DSR_AUSENCIA',
                        "name": 'DSR_AUSENCIA',
                        "className": "visibleColumn",
                    }, {
                        "responsivePriority": 5, 
                        "title": "<?php echo mb_strtoupper($ui_unit, 'UTF-8'); ?>", //Datatables :: Original
                        "label": "<?php echo $ui_unit; ?>", //Editor
                        "data": 'UNIDADE_LIMITES',
                        "name": 'UNIDADE_LIMITES',
                        "type": "select",
                        "className": "visibleColumn",
                        "attr": {
                            "domain-list": true,
                            "dependent-group": 'RH_DEF_AUSENCIAS.UNIDADE_LIMITES',
                            "class": "form-control"
                        }
                    }, {
                        "responsivePriority": 6, 
                        "title": "<?php echo mb_strtoupper($ui_context, 'UTF-8'); ?>", //Datatables :: Original
                        "label": "<?php echo $ui_context; ?>", //Editor
                        "data": 'CONTEXTO',
                        "name": 'CONTEXTO',
                        "type": "select",
                        "className": "visibleColumn",
                        "attr": {
                            "domain-list": true,
                            "dependent-group": 'RH_DEF_AUSENCIAS.CONTEXTO',
                            "class": "form-control chosen"
                        },
                        "render": function (val, type, row) { 
                            if (val != null) {
                                var o = _.find(initApp.joinsData['RH_DEF_AUSENCIAS.CONTEXTO'], {'RV_LOW_VALUE': val});
                                return val == null ? null : o['RV_MEANING'];
                            }
                            return val;
                        } 
                    }, {
                        "responsivePriority": 7, 
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
                            "class": "form-control"
                        },
                        //Tem de ser incluído por ser uma coluna usada no CRUD que (sem o render) o compara com o RV_MEANING e não com o valor
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
                            return RH_DEF_AUSENCIAS.crudButtons(true,true,true);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "CD_AUSENCIA": {
                            required: true,
                            maxlength: 4
                        },
                        "DSP_AUSENCIA": {
                            required: true,
                            maxlength: 150,
                        },
                        "DSR_AUSENCIA": {
                            required: true,
                            maxlength: 40,
                        },
                        "ACTIVO": {
                            required: true
                        }
                    }
                }
            };
            RH_DEF_AUSENCIAS = new QuadTable();
            RH_DEF_AUSENCIAS.initTable( $.extend({}, datatable_instance_defaults, optionRH_DEF_AUSENCIAS) );
            //END Ausências

            //Ausências Continued :: QUADFORMS
            var optionsRH_DEF_AUSENCIAS_CONTINUED = {
                formId: "#RH_DEF_AUSENCIAS_CONTINUED",
                table: "RH_DEF_AUSENCIAS",
                info: true, //Disables INFO: (record / total records) :: HOW ????
                "pk": {
                    "primary": {
                        "CD_AUSENCIA": {"type": "varchar"}
                    }
                },
                "dependsOn": {
                    "RH_DEF_AUSENCIAS": {
                        "CD_AUSENCIA": "CD_AUSENCIA"
                    }
                },
                // "initialWhereClause": " SEXO = 'M' ", optional
                //"order_by": "NOME",
                //detailsObjects: ['qTableDocs', 'qTableAgregados', 'Documentos', 'Agregados'],                
                "recordBundle": 1,
                crud: [false, true, false],//create,update,delete
                defaultButtons: ['edit'], //['enter-query', 'new'],
                refreshData: true, //default true
                queryAll: false,//defaults to true ...empty search return all records
                showMultiRecord: false, //default true
                //workflow: true, //optional defaults to false
                showWorkflowOnEdit: false,
                domainLists: { 
                    RESTRICAO: {
                         "domain-list": true,
                         "dependent-group": "RH_DEF_AUSENCIAS.RESTRICAO"
                    },
                    TS_ESTADO: {
                         "domain-list": true,
                         "dependent-group": "RH_ESTADO_PONTO"
                    },
                    BUILD_FROM: {
                         "domain-list": true,
                         "dependent-group": "RH_DEF_REGRAS_PONTO.BUILD_FROM"
                    },
                    DOMINIO_INTEGRACAO: {
                         "domain-list": true,
                         "dependent-group": "RH_DEF_AUSENCIAS.DOMINIO_INTEGRACAO"
                    },
                    RESTRICAO: {
                         "domain-list": true,
                         "dependent-group": "RH_DEF_AUSENCIAS.RESTRICAO"
                    },
                    TP_AUSENCIA: {
                         "domain-list": true,
                         "dependent-group": "RH_DEF_AUSENCIAS.TP_AUSENCIA"
                    },
                    PORTAL_ESTADO: {
                         "domain-list": true,
                         "dependent-group": "RH_DEF_AUSENCIAS.PORTAL_ESTADO"
                    },
                    SITUACAO_CGA: {
                         "domain-list": true,
                         "dependent-group": "RH_DEF_AUSENCIAS.SITUACAO_CGA"
                    },
                    INTERFACE: {
                         "domain-list": true,
                         "dependent-group": "RH_DEF_AUSENCIAS.INTERFACE"
                    },
                },
                complexLists: {
                    "DSP_BAL_SOC": {
                        "name": "DSP_BAL_SOC",
                        "dependent-group": "RU",
                        "dependent-level": 1,
                        "data-db-name": 'A.CD_BAL_SOC@A.TP_BAL_SOC',
                        "decodeFromTable": 'RH_DEF_BALANCO_SOCIAL A',
                        "desigColumn": "A.DSP_BAL_SOC",
                        "orderBy": "A.DSP_BAL_SOC",
                        "class": "form-control complexList chosen",
                        "whereClause": " AND A.TP_BAL_SOC = 'A'",
                        "filter": {
                            "create": " AND A.TP_BAL_SOC = 'A'", //On-New-Record
                            "edit": " AND A.TP_BAL_SOC = 'A'", //On-Edit-Record
                        }
                    },
                    "DSP_EJ": {
                        "name": "DSP_EJ",
                        "dependent-group": "EJ",
                        "dependent-level": 1,
                        "data-db-name": 'A.CD_EJ',
                        "decodeFromTable": 'RH_DEF_ENQ_JURIDICOS A',
                        "desigColumn": "A.DSP_ENQ_JUR",
                        "orderBy": "A.DSP_ENQ_JUR",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.ACTIVO = 'S'", //On-New-Record
                            "edit": " AND A.ACTIVO = 'S'", //On-Edit-Record
                        }
                    }
                },           
                "validations": {
                    "rules": {
                        "MIN_ANO": {
                            number: true
                        },
                        "MAX_ANO": {
                            number: true
                        },                    
                        "MIN_MES": {
                            number: true
                        },
                        "MAX_MES": {
                            number: true
                        },
                        "MIN_CONSECUTIVAS": {
                            number: true
                        },
                        "MAX_CONSECUTIVAS": {
                            number: true
                        },
                        "MIN_OCORRENCIAS": {
                            number: true
                        },
                        "MAX_OCORRENCIAS": {
                            number: true
                        },
                        "INCLUIR_SS": {
                            required: true
                        },                    
                        "REMUNERADA": {
                            required: true
                        },
                        "AGRUPA": {
                            required: true
                        },
                        "INCLUIR_CGA": {
                            required: true
                        },
                        "INCAPACIDADE": {
                            required: true
                        },
                        "RESTRICAO": {
                            required: true
                        },
                        "TP_AUSENCIA": {
                            required: true
                        }, 
                        "UNIDADE_LIMITES": {
                            required: true
                        }, 
                        "INCLUIR_SS": {
                            required: true
                        },                     
                        "AGRUPA": {
                            required: true
                        },                     
                        "INCLUIR_CGA": {
                            required: true
                        },                     
                        "PORTAL": {
                            required: true
                        },                     
                        "PORTAL_MOB_DBH": {
                            required: true
                        },                     
                        "DOC_JUSTIF": {
                            maxlength: 30
                        }
                    }
                }                
            };        
            RH_DEF_AUSENCIAS_CONTINUED = new QuadForm();
            RH_DEF_AUSENCIAS_CONTINUED.initForm($.extend({}, datatable_instance_defaults, optionsRH_DEF_AUSENCIAS_CONTINUED));
            //Ausências Continued :: QUADFORMS        

            //Absentismo Integrações
            var optionsRH_ID_RUBRICAS_INTEGRACAO = {
                "tableId": 'RH_ID_RUBRICAS_INTEGRACAO',
                "table": "RH_ID_RUBRICAS_INTEGRACAO",
                "order": false,
                "pk":{
                    "primary": {
                        "CD_RUBRICA": {"type": "varchar"},
                        "SEQ_": {"type": "number"},
                        "CD_AUSENCIA": {"type": "varchar"}                        
                    }
                },
                "dependsOn": {
                    RH_DEF_AUSENCIAS: {
                        "CD_AUSENCIA": "CD_AUSENCIA"
                    }
                },
                "order_by": "SEQ_",
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
                        "data": 'CD_AUSENCIA',
                        "name": 'CD_AUSENCIA',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "className": "",
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_code; ?>", //Editor
                        "data": 'SEQ_',
                        "name": 'SEQ_',
                        //"type": "hidden", //Editor
                        //"visible": false, //DataTables
                        "className": "visibleColumn right",
                        "attr": {
                            "name": "RV_LOW_VALUE",
                            "style": "width: 30%",
                            "class": "form-control toRight"
                        }
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'EMPRESA',
                        "name": 'EMPRESA',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "responsivePriority": 2,
                        "complexList": true,
                        "title": "<?php echo mb_strtoupper($ui_company, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_company; ?>",
                        "data": 'DSP_EMPRESA',
                        "name": 'DSP_EMPRESA',
                        "type": "select",
                        "className": "visibleColumn",
                        //"visible": false, //DataTables
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
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'CD_RUBRICA',
                        "name": 'CD_RUBRICA',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "responsivePriority": 3,
                        "complexList": true,
                        "title": "<?php echo mb_strtoupper($ui_in_presence_of_wage_item, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_in_presence_of_wage_item; ?>",
                        "data": 'DSP_RUBRICA',
                        "name": 'DSP_RUBRICA',
                        "type": "select",
                        "className": "visibleColumn",
                        //"visible": false, //DataTables
                        //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                        "attr": {
                            "dependent-group": "RUBRICAS",
                            "dependent-level": 1,
                            "data-db-name": "A.CD_RUBRICA",
                            "decodeFromTable": "RH_DEF_RUBRICAS A", //TO CHANGE ON QUAD-HCM
                            "desigColumn": "CONCAT(CONCAT(A.CD_RUBRICA,'-'),A.DSP_RUBRICA)",
                            "orderBy": "A.CD_RUBRICA",
                            "class": "form-control complexList chosen",
                            "filter": {
                                "create": " AND A.ACTIVO = 'S'", //On-New-Record
                                "edit": " AND A.ACTIVO = 'S'", //On-Edit-Record
                            }
                        }                                         
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'CD_RUBRICA_CRIA',
                        "name": 'CD_RUBRICA_CRIA',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "responsivePriority": 4,
                        "complexList": true,
                        "title": "<?php echo mb_strtoupper($ui_attach_wage_item, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_attach_wage_item; ?>",
                        "data": 'DSP_INTEGRA_RUBRICA',
                        "name": 'DSP_INTEGRA_RUBRICA',
                        "type": "select",
                        "className": "visibleColumn",
                        //"visible": false, //DataTables
                        //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                        "attr": {
                            "dependent-group": "RUBRICAS",
                            "dependent-level": 1,
                            "data-db-name": "A.CD_RUBRICA",
                            "distribute-value": "CD_RUBRICA_CRIA",
                            "decodeFromTable": "RH_DEF_RUBRICAS A", //TO CHANGE ON QUAD-HCM
                            "desigColumn": "CONCAT(CONCAT(A.CD_RUBRICA,'-'),A.DSP_RUBRICA)",
                            "orderBy": "A.CD_RUBRICA",
                            "class": "form-control complexList chosen",
                            "filter": {
                                "create": " AND A.ACTIVO = 'S' AND A.QTD_RECOLHA = 'S' ", //On-New-Record
                                "edit": " AND A.ACTIVO = 'S' AND A.QTD_RECOLHA = 'S' ", //On-Edit-Record
                            }
                        } 
                    }, {
                        "responsivePriority": 5, 
                        "title": "<?php echo mb_strtoupper($ui_type, 'UTF-8'); ?>", //Datatables :: Original
                        "label": "<?php echo $ui_type; ?>", //Editor
                        "data": 'TP_INTEGRACAO',
                        "name": 'TP_INTEGRACAO',
                        "type": "select",
                        "className": "visibleColumn",
                        "attr": {
                            "domain-list": true,
                            "dependent-group": 'RH_ID_RUBRICAS_INTEGRACAO.TP_INTEGRACAO',
                            "class": "form-control"
                        }
                    }, {
                        "responsivePriority": 6, 
                        "title": "<?php echo mb_strtoupper($ui_active, 'UTF-8'); ?>", //Datatables :: Original
                        "label": "<?php echo $ui_active; ?>", //Editor
                        "data": 'ACTIVO',
                        "name": 'ACTIVO',
                        "def": "S",
                        "type": "select",
                        "className": "visibleColumn",
                        "attr": {
                            "domain-list": true,
                            "dependent-group": 'DG_SIM_NAO',
                            "class": "form-control"
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
                            return RH_ID_RUBRICAS_INTEGRACAO.crudButtons(true, true, true);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "TP_INTEGRACAO": {//Same as defined on attr.name
                            required: true,
                        },
                        "ACTIVO": {
                            required: true
                        },
                        "DSP_TRAD": {//Same as defined on attr.name
                            required: true,
                            maxlength: 240,
                        }
                    }
                }
            };
            RH_ID_RUBRICAS_INTEGRACAO = new QuadTable();
            RH_ID_RUBRICAS_INTEGRACAO.initTable($.extend({}, datatable_instance_defaults, optionsRH_ID_RUBRICAS_INTEGRACAO));
            // End Absentismo Integrações

            //Absentismo Incidências
            var optionsRH_DEF_INCIDENCIAS = {
                "tableId": 'RH_DEF_INCIDENCIAS',
                "table": "RH_DEF_INCIDENCIAS",
                "order": false,
                "pk":{
                    "primary": {
                        "CD_AUSENCIA": {"type": "varchar"},
                        "AMBITO_INCIDENCIA": {"type": "varchar"},
                    }
                },
                "dependsOn": {
                    RH_DEF_AUSENCIAS: {
                        "CD_AUSENCIA": "CD_AUSENCIA"
                    }
                },
                "order_by": "AMBITO_INCIDENCIA",
                "recordBundle": 5, 
                "pageLenght": 5, 
                "scrollY": "156",
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
                        "data": 'CD_AUSENCIA',
                        "name": 'CD_AUSENCIA',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "className": "",                      
                    }, {
                        "responsivePriority": 2,
                        "title": "<?php echo mb_strtoupper($ui_scope, 'UTF-8'); ?>", //Datatables :: Original
                        "label": "<?php echo $ui_type; ?>", //Editor
                        "data": 'AMBITO_INCIDENCIA',
                        "name": 'AMBITO_INCIDENCIA',
                        "type": "select",
                        "className": "visibleColumn",
                        "attr": {
                            "domain-list": true,
                            "dependent-group": 'RH_DEF_INCIDENCIAS.AMBITO_INCIDENCIA',
                            "class": "form-control chosen"
                        },
                        "render": function (val, type, row) {
                            if (val != null) {
                                var o = _.find(initApp.joinsData['RH_DEF_INCIDENCIAS.AMBITO_INCIDENCIA'], {'RV_LOW_VALUE': val});
                                return val == null ? null : o['RV_MEANING'];
                            }
                            return val;
                        }
                    }, {
                        "responsivePriority": 3, 
                        "title": "<?php echo mb_strtoupper($ui_limit, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_limit; ?>", //Editor
                        "data": 'TOLERANCIA',
                        "name": 'TOLERANCIA',
                        //"type": "hidden", //Editor
                        //"visible": false, //DataTables
                        "className": "visibleColumn right",
                        "attr": {
                            "style": "width: 30%",
                            "class": "form-control toRight"
                        }
                    }, {
                        "responsivePriority": 4, 
                        "title": "<?php echo mb_strtoupper($ui_tolerance_unit, 'UTF-8'); ?>", //Datatables :: Original
                        "label": "<?php echo $ui_tolerance_unit; ?>", //Editor
                        "data": 'UNIDADE_TOLERANCIA',
                        "name": 'UNIDADE_TOLERANCIA',
                        "type": "select",
                        "className": "visibleColumn",
                        "attr": {
                            "domain-list": true,
                            "dependent-group": 'RH_DEF_INCIDENCIAS.UNIDADE_TOLERANCIA',
                            "class": "form-control"
                        },
                        "render": function (val, type, row) {
                            if (val != null) {
                                var o = _.find(initApp.joinsData['RH_DEF_INCIDENCIAS.UNIDADE_TOLERANCIA'], {'RV_LOW_VALUE': val});
                                return val == null ? null : o['RV_MEANING'];
                            }
                            return val;
                        }
                    }, {
                        "responsivePriority": 5, 
                        "title": "<?php echo mb_strtoupper($ui_allocation_unit, 'UTF-8'); ?>", //Datatables :: Original
                        "label": "<?php echo $ui_allocation_unit; ?>", //Editor
                        "data": 'UNIDADE_AFECTACAO',
                        "name": 'UNIDADE_AFECTACAO',
                        "type": "select",
                        "className": "visibleColumn",
                        "attr": {
                            "domain-list": true,
                            "dependent-group": 'RH_DEF_INCIDENCIAS.UNIDADE_AFECTACAO',
                            "class": "form-control"
                        },
                        "render": function (val, type, row) {
                            if (val != null) {
                                var o = _.find(initApp.joinsData['RH_DEF_INCIDENCIAS.UNIDADE_AFECTACAO'], {'RV_LOW_VALUE': val});
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
                        "title": "",
                        "name": 'BUTTONS',
                        "type": "hidden",
                        "width": "6%",
                        "className": "toBottom toCenter",
                        "render": function () {
                            return RH_DEF_INCIDENCIAS.crudButtons(true, true, true);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "AMBITO_INCIDENCIA": {
                            required: true,
                        },
                        "TOLERANCIA": {
                            required: true,
                            number: true
                        },
                        "UNIDADE_TOLERANCIA": {
                            required: true
                        },
                        "UNIDADE_AFECTACAO": {
                            required: true
                        }

                    }
                }
            };
            RH_DEF_INCIDENCIAS = new QuadTable();
            RH_DEF_INCIDENCIAS.initTable($.extend({}, datatable_instance_defaults, optionsRH_DEF_INCIDENCIAS));
            // End Absentismo Incidências

            //Contextos Absentismo Domain
            var optionsContextoAbsent = {
                "tableId": 'ContextoAbsent',
                "table": "CG_REF_CODES",
                "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_context; ?>",            
                "pk": {
                    "primary": {
                        "RV_DOMAIN": {"type": "varchar"},
                        "RV_LOW_VALUE": {"type": "varchar"}
                    }
                },
                "detailsObjects": ['ContextoAbsentTrads'],
                "initialWhereClause": "RV_DOMAIN = 'RH_DEF_AUSENCIAS.CONTEXTO' ",
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
                        "def": "RH_DEF_AUSENCIAS.CONTEXTO",
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
                            return ContextoAbsent.crudButtons(true, true, true);
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
            ContextoAbsent = new QuadTable();
            ContextoAbsent.initTable($.extend({}, datatable_instance_defaults, optionsContextoAbsent));
            //END Contextos Absentismo Domain  

            //Contextos Absentismo Trads
            var optionsContextoAbsentTrads = {
                "tableId": 'ContextoAbsentTrads',
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
                    ContextoAbsent: {
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
                            return ContextoAbsentTrads.crudButtons(true, true, true);
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
            ContextoAbsentTrads = new QuadTable();
            ContextoAbsentTrads.initTable($.extend({}, datatable_instance_defaults, optionsContextoAbsentTrads));
            //END Contextos Absentismo Trads          

            //Enquadramento Jurídico de Absentismo 
            var optionsRH_DEF_ENQ_JURIDICOS = {
                "tableId": 'RH_DEF_ENQ_JURIDICOS',
                "table": "RH_DEF_ENQ_JURIDICOS", 
                //"selectRecordMsg": "<?php echo $ui_please_select_record . $ui_idiom; ?>",
                "pk": {
                    "primary": {
                        "CD_EJ": {"type": "varchar"}
                    }
                },
                "crudOnMasterInactive": {
                    "condition": "data.ACTIVO === 'N' ",
                    "acl": {
                        "create": false,
                        "update": false,
                        "delete": false
                    }
                },
                //"detailsObjects": [''],                    
                "order_by": "CD_EJ",
                "scrollY": "390", 
                "recordBundle": 12,
                "pageLenght": 12, 
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
                        "responsivePriority": 2,
                        "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_code; ?>",
                        "data": 'CD_EJ',
                        "name": 'CD_EJ',
                        "className": "visibleColumn",
                        "attr": {
                            "style": "width:40%;"
                        }
                    }, {
                        "responsivePriority": 3,
                        "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_designation; ?>",
                        "data": 'DSP_ENQ_JUR',
                        "name": 'DSP_ENQ_JUR',
                        "className": "visibleColumn"
                    }, {
                        "responsivePriority": 4,
                        "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_short_desig; ?>",
                        "data": 'DSR_ENQ_JUR',
                        "name": 'DSR_ENQ_JUR',
                        "className": "visibleColumn"

                    }, {
                        "responsivePriority": 5,
                        "title": "<?php echo mb_strtoupper($ui_origin, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_origin; ?>", //Editor
                        "data": 'ORIGEM_JUR',
                        "name": 'ORIGEM_JUR',
                        "type": "select",
                        "className": "visibleColumn",
                        "attr": {
                            "domain-list": true,
                            "dependent-group": 'RH_ORIGEM_JUR',
                            "class": "form-control"
                        }            
                    }, {
                        "responsivePriority": 6,
                        "title": "<?php echo mb_strtoupper($ui_active, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_active; ?>", //Editor
                        "data": 'ACTIVO',
                        "name": 'ACTIVO',
                        "type": "select",
                        "def": "S",
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
                        //"targets": 14,
                        responsivePriority: 1,
                        "data": null,
                        "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                        "name": 'BUTTONS',
                        "type": "hidden",
                        "width": "6%",
                        "className": "toBottom toCenter",
                        "render": function () {
                            //debugger;
                            return RH_DEF_ENQ_JURIDICOS.crudButtons(true,true,true);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "CD_EJ": { 
                            required: true,
                            maxlength: 8                        
                        },
                        "DSP_ENQ_JUR": { 
                            required: true,
                            maxlength: 150
                        },
                        "DSR_ENQ_JUR": { 
                            required: true,
                            maxlength: 40
                        },
                        "ATIVO": { 
                            required: true
                        },
                        "ORIGEM_JUR": { 
                            required: true
                        }
                    }
                },              
            };
            RH_DEF_ENQ_JURIDICOS = new QuadTable();
            RH_DEF_ENQ_JURIDICOS.initTable( $.extend( {}, datatable_instance_defaults, optionsRH_DEF_ENQ_JURIDICOS ) );        
            //END Enquadramento Jurídico de Absentismo 
        }
        //END Módulo de Absentismo
        
        //Módulo de Trabalho Suplementar (e Horas de Viagem)
        if (1 === 1) {
            //Trabalho Suplementar (e Horas de Viagem)
            var optionRH_DEF_TRAB_SUPL = {
                "tableId": "RH_DEF_TRAB_SUPL",
                "table": "RH_DEF_TRAB_SUPL", 
                "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_overtime_work; ?>",
                "pk": {
                    "primary": {
                        "CD_TS_HV": {"type": "varchar"}
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
                "detailsObjects": ['RH_DEF_TRAB_SUPL_CONTINUED','RH_ID_RUBRICAS_INTEGRACAO_TS'],
                "order_by": "CD_TS_HV",
                "recordBundle": 6, 
                "pageLenght": 6, 
                "scrollY": "195",   
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
                        "data": 'CD_TS_HV',
                        "name": 'CD_TS_HV',
                        "className": "visibleColumn",                   
                    }, {
                        "responsivePriority": 3, 
                        "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_designation; ?>", //Editor
                        "data": 'DSP_TS_HV',
                        "name": 'DSP_TS_HV',
                        "className": "visibleColumn",       
                    }, {
                        "responsivePriority": 4, 
                        "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_short_desig; ?>", //Editor
                        "data": 'DSR_TS_HV',
                        "name": 'DSR_TS_HV',
                        "className": "visibleColumn",
                    }, {
                        "responsivePriority": 5, 
                        "title": "<?php echo mb_strtoupper($ui_type, 'UTF-8'); ?>", //Datatables :: Original
                        "label": "<?php echo $ui_type; ?>", //Editor
                        "data": 'TIPO_TS_HV',
                        "name": 'TIPO_TS_HV',
                        "type": "select",
                        "def": "S",
                        "className": "visibleColumn",
                        "attr": {
                            "domain-list": true,
                            "dependent-group": 'RH_TIPO_TS_HV',
                            "class": "form-control"
                        },
                        //Tem de ser incluído por ser uma coluna usada no CRUD que (sem o render) o compara com o RV_MEANING e não com o valor
                        "render": function (val, type, row) { 
                            if (val != null) {
                                var o = _.find(initApp.joinsData['RH_TIPO_TS_HV'], {'RV_LOW_VALUE': val});
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
                        "def": "S",
                        "className": "visibleColumn",
                        "attr": {
                            "domain-list": true,
                            "dependent-group": 'DG_SIM_NAO',
                            "class": "form-control"
                        },
                        //Tem de ser incluído por ser uma coluna usada no CRUD que (sem o render) o compara com o RV_MEANING e não com o valor
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
                            return RH_DEF_TRAB_SUPL.crudButtons(true,true,true);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "CD_TS_HV": {
                            required: true,
                            maxlength: 4
                        },
                        "DSP_TS_HV": {
                            required: true,
                            maxlength: 40,
                        },
                        "DSR_TS_HV": {
                            required: false,
                            maxlength: 25,
                        },
                        "TIPO_TS_HV": {
                            required: true
                        },
                        "ACTIVO": {
                            required: true
                        }
                    }
                }
            };
            RH_DEF_TRAB_SUPL = new QuadTable();
            RH_DEF_TRAB_SUPL.initTable( $.extend({}, datatable_instance_defaults, optionRH_DEF_TRAB_SUPL) );
            //END Trabalho Suplementar (e Horas de Viagem)
            
            //Trabalho Suplementar Continued :: QUADFORMS
            var optionsRH_DEF_TRAB_SUPL_CONTINUED = {
                formId: "#RH_DEF_TRAB_SUPL_CONTINUED",
                table: "RH_DEF_TRAB_SUPL",
                info: true, //Disables INFO: (record / total records) :: HOW ????
                "pk": {
                    "primary": {
                        "CD_TS_HV": {"type": "varchar"}
                    }
                },
                "dependsOn": {
                    "RH_DEF_TRAB_SUPL": {
                        "CD_TS_HV": "CD_TS_HV"
                    }
                },
                // "initialWhereClause": " SEXO = 'M' ", optional
                //"order_by": "NOME",
                //detailsObjects: ['qTableDocs', 'qTableAgregados', 'Documentos', 'Agregados'],                
                "recordBundle": 1,
                crud: [false, true, false],//create,update,delete
                defaultButtons: ['edit'], //['enter-query', 'new'],
                refreshData: true, //default true
                queryAll: false,//defaults to true ...empty search return all records
                showMultiRecord: false, //default true
                //workflow: true, //optional defaults to false
                showWorkflowOnEdit: false,
                domainLists: { 
                    TP_DISTRIBUICAO: {
                         "domain-list": true,
                         "dependent-group": "RH_DEF_TRAB_SUPL.TP_DISTRIBUICAO"
                    }
                },
                complexLists: {
                    "DSP_MOTIVO_TS_HV": {
                        "name": "DSP_MOTIVO_TS_HV",
                        "dependent-group": "MOTIVO_TS_HV",
                        "dependent-level": 1,
                        "data-db-name": 'A.CD_MOTIVO_TS_HV',
                        "decodeFromTable": 'RH_DEF_MOTIVOS_TS_HV A',
                        "desigColumn": "A.DSP_MOTIVO_TS_HV",
                        "orderBy": "A.CD_MOTIVO_TS_HV",
                        "class": "form-control complexList chosen",
                        "whereClause": "",
                        "filter": {
                            "create": " AND A.ACTIVO = 'S'", //On-New-Record
                            "edit": " AND A.ACTIVO = 'S'", //On-Edit-Record
                        }
                    }
                },           
                "validations": {
                    "rules": {
//                        "MIN_ANO": {
//                            number: true
//                        },
                        "TP_DISTRIBUICAO": {
                            required: true
                        },                 
//                        "DOC_JUSTIF": {
//                            maxlength: 30
//                        }
                    }
                }                
            };        
            RH_DEF_TRAB_SUPL_CONTINUED = new QuadForm();
            RH_DEF_TRAB_SUPL_CONTINUED.initForm($.extend({}, datatable_instance_defaults, optionsRH_DEF_TRAB_SUPL_CONTINUED));
            //Trabalho Suplementar Continued :: QUADFORMS           
            
            //Integrações
            var optionsRH_ID_RUBRICAS_INTEGRACAO_TS = {
                "tableId": 'RH_ID_RUBRICAS_INTEGRACAO_TS',
                "table": "RH_ID_RUBRICAS_INTEGRACAO",
                "order": false,
                "pk":{
                    "primary": {
                        "CD_RUBRICA": {"type": "varchar"},
                        "SEQ_": {"type": "number"},
                        "CD_TS_HV": {"type": "varchar"}
                    }
                },
                "dependsOn": {
                    RH_DEF_TRAB_SUPL: {
                        "CD_TS_HV": "CD_TS_HV"
                    }
                },
                "order_by": "SEQ_",
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
                        "data": 'CD_TS_HV',
                        "name": 'CD_TS_HV',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "className": "",
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_code; ?>", //Editor
                        "data": 'SEQ_',
                        "name": 'SEQ_',
                        //"type": "hidden", //Editor
                        //"visible": false, //DataTables
                        "className": "visibleColumn right",
                        "attr": {
                            "name": "RV_LOW_VALUE",
                            "style": "width: 30%",
                            "class": "form-control toRight"
                        }
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'EMPRESA',
                        "name": 'EMPRESA',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "responsivePriority": 2,
                        "complexList": true,
                        "title": "<?php echo mb_strtoupper($ui_company, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_company; ?>",
                        "data": 'DSP_EMPRESA',
                        "name": 'DSP_EMPRESA',
                        "type": "select",
                        "className": "visibleColumn",
                        //"visible": false, //DataTables
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
                        "title": "<?php echo mb_strtoupper($ui_type, 'UTF-8'); ?>", //Datatables :: Original
                        "label": "<?php echo $ui_type; ?>", //Editor
                        "data": 'TP_INTEGRACAO',
                        "name": 'TP_INTEGRACAO',
                        "type": "select",
                        "className": "visibleColumn",
                        "attr": {
                            "domain-list": true,
                            "dependent-group": 'RH_ID_RUBRICAS_INTEGRACAO.TP_HORA_TS',
                            "class": "form-control chosen"
                        }
                    }, {
                        "responsivePriority": 4, 
                        "title": "<?php echo mb_strtoupper($ui_limit, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_limit; ?>", //Editor
                        "fieldInfo":"<?php echo $hint_minutes; ?>", //Editor 
                        "data": 'LIMITE_MINUTOS',
                        "name": 'LIMITE_MINUTOS',
                        //"type": "hidden", //Editor
                        //"visible": false, //DataTables
                        "className": "visibleColumn right",
                        "attr": {
                            "name": "RV_LOW_VALUE",
                            "style": "width: 30%",
                            "class": "form-control toRight"
                        }                        
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'CD_RUBRICA',
                        "name": 'CD_RUBRICA',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "responsivePriority": 5,
                        "complexList": true,
                        "title": "<?php echo mb_strtoupper($ui_wage_item, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_wage_item; ?>",
                        "data": 'DSP_RUBRICA',
                        "name": 'DSP_RUBRICA',
                        "type": "select",
                        "className": "visibleColumn",
                        //"visible": false, //DataTables
                        //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                        "attr": {
                            "dependent-group": "RUBRICAS",
                            "dependent-level": 1,
                            "data-db-name": "A.CD_RUBRICA",
                            "decodeFromTable": "RH_DEF_RUBRICAS A", //TO CHANGE ON QUAD-HCM
                            "desigColumn": "CONCAT(CONCAT(A.CD_RUBRICA,'-'),A.DSP_RUBRICA)",
                            "orderBy": "A.CD_RUBRICA",
                            "class": "form-control complexList chosen",
                            "filter": {
                                "create": " AND A.ACTIVO = 'S'", //On-New-Record
                                "edit": " AND A.ACTIVO = 'S'" //On-Edit-Record
                            }
                        }                                         
                    }, {
                        "responsivePriority": 6,
                        "title": "<?php echo mb_strtoupper($ui_hours_bank_addition_percentage, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_hours_bank_addition_percentage; ?>", //Editor
                        "fieldInfo":"<?php echo $hint_hours_bank; ?>", //Editor 
                        "data": 'PCT_ACRESC_BH',
                        "name": 'PCT_ACRESC_BH',
                        //"type": "hidden", //Editor
                        //"visible": false, //DataTables
                        "className": "visibleColumn right",
                        "attr": {
                            "name": "RV_LOW_VALUE",
                            "style": "width: 30%",
                            "class": "form-control toRight"
                        }                         
                    }, {
                        "responsivePriority": 7, 
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
                            "class": "form-control"
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
                            return RH_ID_RUBRICAS_INTEGRACAO_TS.crudButtons(true, true, true);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "TP_INTEGRACAO": {//Same as defined on attr.name
                            required: true,
                        },
                        "ACTIVO": {
                            required: true
                        },
                        "DSP_TRAD": {//Same as defined on attr.name
                            required: true,
                            maxlength: 240,
                        }
                    }
                }
            };
            RH_ID_RUBRICAS_INTEGRACAO_TS = new QuadTable();
            RH_ID_RUBRICAS_INTEGRACAO_TS.initTable($.extend({}, datatable_instance_defaults, optionsRH_ID_RUBRICAS_INTEGRACAO_TS));
            //END Integrações
            
            //Motivos TS / HV            
            var optionRH_DEF_MOTIVOS_TS_HV = {
                "tableId": "RH_DEF_MOTIVOS_TS_HV",
                "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_motif; ?>",
                "table": "RH_DEF_MOTIVOS_TS_HV", 
                "pk": {
                    "primary": {
                        "CD_MOTIVO_TS_HV": {"type": "varchar"}
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
                "detailsObjects": ['RH_DEF_MOTIVO_TS_HV_TRADS'],
                "order_by": "CD_MOTIVO_TS_HV",
                "recordBundle": 6, 
                "pageLenght": 6, 
                "scrollY": "195", 
                "responsive": true,
    //          #CUSTOM DETAIL
    //            https://datatables.net/reference/option/responsive.details.renderer
    //            "responsive": {
    //                "details": {
    //                    renderer: function ( api, rowIdx, columns ) {
    //                        console.log(columns);
    //                        var data = $.map( columns, function ( col, i ) {
    //                            return col.hidden ?
    //                                '<tr data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+
    //                                    '<td>'+col.title+':'+'</td> '+
    //                                    '<td>'+col.data+'</td>'+
    //                                '</tr>' :
    //                                '';
    //                        } ).join('');
    //
    //                        return data ?
    //                            $('<table/>').append( data ) :
    //                            false;
    //                    }
    //                }
    //            },            
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
                        "data": 'CD_MOTIVO_TS_HV',
                        "name": 'CD_MOTIVO_TS_HV',
                        "className": "visibleColumn",                   
                    }, {
                        "responsivePriority": 3, 
                        "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_designation; ?>", //Editor
                        "data": 'DSP_MOTIVO_TS_HV',
                        "name": 'DSP_MOTIVO_TS_HV',
                        "className": "visibleColumn",
                    }, {
                        "responsivePriority": 4, 
                        "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_short_desig; ?>", //Editor
                        "data": 'DSR_MOTIVO_TS_HV',
                        "name": 'DSR_MOTIVO_TS_HV',
                        "className": "visibleColumn",                        
                    }, {
                        "responsivePriority": 5, 
                        "title": "<?php echo mb_strtoupper($ui_type, 'UTF-8'); ?>", //Datatables :: Original
                        "label": "<?php echo $ui_type; ?>", //Editor
                        "data": 'TIPO_TS_HV',
                        "name": 'TIPO_TS_HV',
                        "type": "select",
                        "def": "S",
                        "className": "visibleColumn",
                        "attr": {
                            "domain-list": true,
                            "dependent-group": 'RH_TIPO_TS_HV',
                            "class": "form-control"
                        },
                        //Tem de ser incluído por ser uma coluna usada no CRUD que (sem o render) o compara com o RV_MEANING e não com o valor
                        "render": function (val, type, row) { 
                            if (val != null) {
                                var o = _.find(initApp.joinsData['RH_TIPO_TS_HV'], {'RV_LOW_VALUE': val});
                                return val == null ? null : o['RV_MEANING'];
                            }
                            return val;
                        }
                    }, {
                        "responsivePriority": 6, 
                        "title": "<?php echo mb_strtoupper($ui_portal, 'UTF-8'); ?>", //Datatables :: Original
                        "label": "<?php echo $ui_portal; ?>", //Editor
                        "data": 'PORTAL',
                        "name": 'PORTAL',
                        "type": "select",
                        "className": "visibleColumn",
                        "attr": {
                            "domain-list": true,
                            "dependent-group": 'DG_SIM_NAO',
                            "class": "form-control"
                        }
                    }, {
                        "responsivePriority": 7, 
                        "title": "<?php echo mb_strtoupper($ui_hours_bank_addition, 'UTF-8'); ?>", //Datatables :: Original
                        "label": "<?php echo $ui_hours_bank_addition; ?>", //Editor
                        "fieldInfo": "<?php echo $hint_hours_bank; ?>", //Editor
                        "data": 'TF_BH_ACRED',
                        "name": 'TF_BH_ACRED',
                        "type": "select",
                        "className": "visibleColumn",
                        "attr": {
                            "domain-list": true,
                            "dependent-group": 'DG_SIM_NAO',
                            "class": "form-control"
                        }
                    }, {
                        "responsivePriority": 8, 
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
                            return RH_DEF_MOTIVOS_TS_HV.crudButtons(true,true,true);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "CD_MOTIVO_TS_HV": {
                            required: true,
                            maxlength: 4
                        },
                        "DSP_MOTIVO_TS_HV": {
                            required: true,
                            maxlength: 40,
                        },
                        "DSR_MOTIVO_TS_HV": {
                            required: false,
                            maxlength: 25,
                        },
                        "TIPO_TS_HV": {
                            required: true
                        },
                        "PORTAL": {
                            required: true
                        },
                        "TF_BH_ACRED": {
                            required: true
                        },
                        "ACTIVO": {
                            required: true
                        }
                    }
                }
            };
            RH_DEF_MOTIVOS_TS_HV = new QuadTable();
            RH_DEF_MOTIVOS_TS_HV.initTable( $.extend({}, datatable_instance_defaults, optionRH_DEF_MOTIVOS_TS_HV) );
            //END Motivos TS / HV

            //Motivos TS / HV Trads
            var optionsRH_DEF_MOTIVO_TS_HV_TRADS = {
                "tableId": "RH_DEF_MOTIVO_TS_HV_TRADS",
                "table": "RH_DEF_MOTIVO_TS_HV_TRADS",
                "pk": {
                    "primary": {
                        "CD_MOTIVO_TS_HV": {"type": "varchar"},               
                        "CD_LINGUA": {"type": "number"},                    
                        "DT_INI": {"type": "date"}
                    }
                },
                "dependsOn": {
                    "RH_DEF_MOTIVOS_TS_HV": {
                        "CD_MOTIVO_TS_HV": "CD_MOTIVO_TS_HV"
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
                        "data": 'CD_MOTIVO_TS_HV',
                        "name": 'CD_MOTIVO_TS_HV',                    
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
                        "responsivePriority": 5,
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
                        "responsivePriority": 6, 
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
                            return RH_DEF_MOTIVO_TS_HV_TRADS.crudButtons(true,true,true);
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
                            maxlength: 40,
                        },
                        "DSR_TRAD": {
                            required: false,
                            maxlength: 25,
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
            RH_DEF_MOTIVO_TS_HV_TRADS = new QuadTable();
            RH_DEF_MOTIVO_TS_HV_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsRH_DEF_MOTIVO_TS_HV_TRADS));        
            //END Motivos TS / HV Trads
        }
        //END Módulo de Trabalho Suplementar (e Horas de Viagem)


        //Módulo de Adaptabilidade
        if (1 === 1) {

            //Adapatabilidade           
            var optionRH_DEF_REGRAS_ADAPTABILIDADE = {
                "tableId": "RH_DEF_REGRAS_ADAPTABILIDADE",
                "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_adaptability_rule; ?>",
                "table": "RH_DEF_REGRAS_ADAPTABILIDADE", 
                "pk": {
                    "primary": {
                        "CD_IRCT": {"type": "varchar"},
                        "DT_EFICACIA": {"type": "date"},
                        "DT_INI_RA": {"type": "date"}
                    }
                },            
                "crudOnMasterInactive": {
                    "condition": "data.DT_FIM_RA !== null ",
                    "acl": {
                        "create": false,
                        "update": false,
                        "delete": false
                    }
                }, 
                "detailsObjects": ['RH_DEF_REGRAS_ADAPTABILIDADE_CONTINUED','RH_DEF_DET_ADAPTABILIDADES'],
                "order_by": "DT_INI_RA",
                "recordBundle": 3,
                "pageLenght": 3,
                "scrollY": "117", 
                "responsive": true,
    //          #CUSTOM DETAIL
    //            https://datatables.net/reference/option/responsive.details.renderer
    //            "responsive": {
    //                "details": {
    //                    renderer: function ( api, rowIdx, columns ) {
    //                        console.log(columns);
    //                        var data = $.map( columns, function ( col, i ) {
    //                            return col.hidden ?
    //                                '<tr data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+
    //                                    '<td>'+col.title+':'+'</td> '+
    //                                    '<td>'+col.data+'</td>'+
    //                                '</tr>' :
    //                                '';
    //                        } ).join('');
    //
    //                        return data ?
    //                            $('<table/>').append( data ) :
    //                            false;
    //                    }
    //                }
    //            },            
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
                        "data": 'CD_IRCT',
                        "name": 'CD_IRCT',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'DT_EFICACIA',
                        "name": 'DT_EFICACIA',
                        "datatype": "date",
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "responsivePriority": 2,
                        "complexList": true,
                        "title": "<?php echo mb_strtoupper($ui_irct, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_irct; ?>",
                        "data": 'DSP_IRCT',
                        "name": 'DSP_IRCT',
                        "type": "select",
                        "className": "visibleColumn",
                        "attr": {
                            "dependent-group": "IRCT",
                            "dependent-level": 1,
                            "data-db-name": 'A.CD_IRCT@A.DT_EFICACIA',
                            "decodeFromTable": 'RH_DEF_IRCT A',
                            "class": "form-control complexList chosen", 
                            "desigColumn": "A.DSP_IRCT", 
                            "orderBy": "A.CD_IRCT, A.DT_EFICACIA desc",
                            "filter": {
                                "create": " AND A.ACTIVO = 'S'", //On-New-Record
                                "edit": " AND A.ACTIVO = 'S'", //On-Edit-Record
                            }
                        }
                    }, {
                        "responsivePriority": 3, 
                        "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_begin_date; ?>", //Editor
                        "data": 'DT_INI_RA',
                        "name": 'DT_INI_RA',
                        "datatype": 'date',
                        "className": "visibleColumn",
                        "attr": {
                            "class": "datepicker" 
                        }  
                    }, {
                        "responsivePriority": 4, 
                        "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_end_date; ?>", //Editor
                        "data": 'DT_FIM_RA',
                        "name": 'DT_FIM_RA',
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
                            return RH_DEF_REGRAS_ADAPTABILIDADE.crudButtons(true,true,true);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "CD_IRCT": {
                            required: true,
                            maxlength: 5
                        },
                        "DT_INI_RA": {
                            required: true,
                            dateISO: true
                        },
                        "DT_FIM_RA": {
                            dateISO: true,
                            dateEqOrNextThan: 'DT_INI_RA',
                        }
                    },
                    //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                    "messages": {
                        "DT_FIM_RA": {
                            dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                        }
                    }
                }
            };
            RH_DEF_REGRAS_ADAPTABILIDADE = new QuadTable();
            RH_DEF_REGRAS_ADAPTABILIDADE.initTable( $.extend({}, datatable_instance_defaults, optionRH_DEF_REGRAS_ADAPTABILIDADE) );
            //END Adapatabilidade

            //Adapatabilidade Continued :: QUADFORMS
            var optionsRH_DEF_REGRAS_ADAPTABILIDADE_CONTINUED = {
                formId: "#RH_DEF_REGRAS_ADAPTABILIDADE_CONTINUED",
                table: "RH_DEF_REGRAS_ADAPTABILIDADE",
                info: true, //Disables INFO: (record / total records) :: HOW ????
                "pk": {
                    "primary": {
                        "CD_IRCT": {"type": "varchar"},
                        "DT_EFICACIA": {"type": "date"},
                        "DT_INI_RA": {"type": "date"}
                    }
                },
                "dependsOn": {
                    "RH_DEF_REGRAS_ADAPTABILIDADE": {
                        "CD_IRCT": "CD_IRCT",
                        "DT_EFICACIA": "DT_EFICACIA",
                        "DT_INI_RA": "DT_INI_RA"
                    }
                },
                // "initialWhereClause": " SEXO = 'M' ", optional
                //"order_by": "NOME",
                //detailsObjects: ['qTableDocs', 'qTableAgregados', 'Documentos', 'Agregados'],                
                "recordBundle": 1,
                crud: [false, true, false],//create,update,delete
                defaultButtons: ['edit'], //['enter-query', 'new'],
                refreshData: true, //default true
                queryAll: false,//defaults to true ...empty search return all records
                showMultiRecord: false, //default true
                //workflow: true, //optional defaults to false
                showWorkflowOnEdit: false,
                domainLists: { 
                    "PROCESSO_CONTAGEM": {
                         "domain-list": true,
                         "dependent-group": "RH_RA_TIPO"
                    },
                    "INI_CONTAGEM": {
                         "domain-list": true,
                         "dependent-group": "RH_RA_INI_CONTAGEM"
                    },
                    "ADMITE_PAGAMENTO": {
                         "domain-list": true,
                         "dependent-group": "RH_RA_AMBITO"
                    },
                    "QUITACOES": {
                         "domain-list": true,
                         "dependent-group": "RH_RA_AMBITO"
                    },
                },
                complexLists: {
                    "DSP_RUBRICA": {
                        "name": "DSP_RUBRICA",
                        "dependent-group": "RUBRICAS",
                        "dependent-level": 1,
                        "data-db-name": 'A.CD_RUBRICA',
                        "decodeFromTable": 'RH_DEF_RUBRICAS A',
                        "desigColumn": "CONCAT(CONCAT(A.CD_RUBRICA,'-'),A.DSP_RUBRICA)",
                        "orderBy": "A.CD_RUBRICA",
                        "class": "form-control complexList chosen",
                        "whereClause": "",
                        "filter": {
                            "create": " AND A.ACTIVO = 'S' AND A.QTD_RECOLHA = 'S' ", //On-New-Record
                            "edit": " AND A.ACTIVO = 'S' AND A.QTD_RECOLHA = 'S'", //On-Edit-Record
                        }
                    }
                },           
                "validations": {
                    "rules": {
                        "VINCULA_IRCT_RHID": {
                            required: true
                        },
                        "PER_REF": {
                            integer: true,
                            maxlength: 4
                        },
                        "NR_OCORRENCIAS": {
                            integer: true,
                            maxlength: 4
                        },
                        "LIM_PLUS_DIA": {
                            integer: true,
                            maxlength: 4
                        },
                        "LIM_PLUS_SEM": {
                            integer: true,
                            maxlength: 4
                        },
                        "LIM_PLUS_MES": {
                            integer: true,
                            maxlength: 4
                        },
                        "LIM_PLUS_ANO": {
                            integer: true,
                            maxlength: 4
                        },
                        "LIM_MINUS_DIA": {
                            integer: true,
                            maxlength: 4
                        },
                        "LIM_MINUS_SEM": {
                            integer: true,
                            maxlength: 4
                        },
                        "LIM_MINUS_MES": {
                            integer: true,
                            maxlength: 4
                        },
                        "LIM_MINUS_ANO": {
                            integer: true,
                            maxlength: 4
                        },
                        "RENOVAVEL": {
                            required: true
                        }
                    }
                }                
            };        
            RH_DEF_REGRAS_ADAPTABILIDADE_CONTINUED = new QuadForm();
            RH_DEF_REGRAS_ADAPTABILIDADE_CONTINUED.initForm($.extend({}, datatable_instance_defaults, optionsRH_DEF_REGRAS_ADAPTABILIDADE_CONTINUED));
            //Adapatabilidade Continued :: QUADFORMS           

            //Adapatabilidade Detalhes
            var optionsRH_DEF_DET_ADAPTABILIDADES = {
                "tableId": 'RH_DEF_DET_ADAPTABILIDADES',
                "table": "RH_DEF_DET_ADAPTABILIDADES",
                "order": false,
                "pk": {
                    "primary": {
                        "CD_IRCT": {"type": "varchar"},
                        "DT_EFICACIA": {"type": "date"},
                        "DT_INI_RA": {"type": "date"},
                        "DT_INI": {"type": "date"},
                        "TP_HORARIO": {"type": "varchar"},
                        "TP_DIA": {"type": "varchar"}
                    }
                },
                "dependsOn": {
                    RH_DEF_REGRAS_ADAPTABILIDADE: {
                        "CD_IRCT": "CD_IRCT",
                        "DT_EFICACIA": "DT_EFICACIA",
                        "DT_INI_RA": "DT_INI_RA",
                    }
                },
                "order_by": "TP_HORARIO, TP_DIA",
                "recordBundle": 5, 
                "pageLenght": 5, 
                "scrollY": "156",
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
                        "data": 'CD_IRCT',
                        "name": 'CD_IRCT',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "className": "",
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'DT_EFICACIA',
                        "name": 'DT_EFICACIA',
                        "datatype": "date",
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "className": "",
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'DT_INI_RA',
                        "name": 'DT_INI_RA',
                        "datatype": "date",
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "className": "",
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'TP_HORARIO',
                        "name": 'TP_HORARIO',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "responsivePriority": 2,
                        "complexList": true,
                        "title": "<?php echo mb_strtoupper($ui_schedule_type, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_schedule_type; ?>",
                        "data": 'DSP_TP_HORARIO',
                        "name": 'DSP_TP_HORARIO',
                        "type": "select",
                        "className": "visibleColumn",
                        //"visible": false, //DataTables
                        //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                        "attr": {
                            "dependent-group": "TP_HORARIO",
                            "dependent-level": 1,
                            "data-db-name": "A.RV_LOW_VALUE",
                            "distribute-value": "TP_HORARIO",
                            "decodeFromTable": "CG_REF_CODES A", //TO CHANGE ON QUAD-HCM
                            "desigColumn": "A.RV_MEANING",
                            "whereClause": " AND A.RV_DOMAIN = 'RH_DEF_HORARIOS.TP_HORARIO'",
                            "orderBy": "A.RV_LOW_VALUE",
                            "class": "form-control complexList"
                        } 
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'TP_DIA',
                        "name": 'TP_DIA',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "responsivePriority": 3,
                        "complexList": true,
                        "title": "<?php echo mb_strtoupper($ui_day_type, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_day_type; ?>",
                        "data": 'DSP_TP_DIA',
                        "name": 'DSP_TP_DIA',
                        "type": "select",
                        "className": "visibleColumn",
                        //"visible": false, //DataTables
                        //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                        "attr": {
                            "dependent-group": "TP_HORARIO",
                            "dependent-level": 2,
                            "deferred": true,
                            "data-db-name": "A.RV_LOW_VALUE",
                            "distribute-value": "TP_DIA",
                            "decodeFromTable": "CG_REF_CODES A", //TO CHANGE ON QUAD-HCM
                            "desigColumn": "A.RV_MEANING",
                            "whereClause": " AND A.RV_DOMAIN = 'RH_RA_TP_DIA' ",
                            "orderBy": "A.RV_LOW_VALUE",
                            "class": "form-control complexList chosen",
                            "filter" : {
                                "create":" AND SUBSTR(A.RV_LOW_VALUE,1,1) = ':TP_HORARIO' ",
                                "edit":" AND SUBSTR(A.RV_LOW_VALUE,1,1) = ':TP_HORARIO' ",
                            }
                        }                        
                    }, {
                        "responsivePriority": 4, 
                        "title": "<?php echo mb_strtoupper($ui_scope, 'UTF-8'); ?>", //Datatables :: Original
                        "label": "<?php echo $ui_scope; ?>", //Editor
                        "data": 'AMBITO',
                        "name": 'AMBITO',
                        "type": "select",
                        "className": "visibleColumn",
                        "attr": {
                            "domain-list": true,
                            "dependent-group": 'RH_RA_AMBITO',
                            "class": "form-control chosen"
                        }

                    }, {
                        "responsivePriority": 5, 
                        "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_begin_date; ?>", //Editor
                        "data": 'DT_INI',
                        "name": 'DT_INI',
                        "datatype": 'date',
                        "def": hoje(),
                        "className": "visibleColumn",
                        "attr": {
                            "name": 'DT_INI',
                            "class": "datepicker" 
                        }                         
                    }, {
                        "responsivePriority": 6,
                        "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_end_date; ?>", //Editor
                        "data": 'DT_FIM',
                        "name": 'DT_FIM',
                        "datatype": 'date',
                        "className": "visibleColumn",
                        "attr": {
                            "name": 'DT_FIM',
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
                        "title": "",
                        "name": 'BUTTONS',
                        "type": "hidden",
                        "width": "6%",
                        "className": "toBottom toCenter",
                        "render": function () {
                            return RH_DEF_DET_ADAPTABILIDADES.crudButtons(true, true, true);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "DSP_TP_HORARIO": {
                            required: true,
                        },
                        "DSP_TP_DIA": {
                            required: true
                        },
                        "AMBITO": {
                            required: true
                        },
                        "DT_INI": {
                            required: true,
                            dateISO: true,
                        },             
                        "DT_FIM": {
                            dateISO: true,
                            dateEqOrNextThan: 'DT_INI',
                        }
                    },
                    //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                    "messages": {
                        "DT_FIM": {
                            dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                        }
                    }                        
                }
            };
            RH_DEF_DET_ADAPTABILIDADES = new QuadTable();
            RH_DEF_DET_ADAPTABILIDADES.initTable($.extend({}, datatable_instance_defaults, optionsRH_DEF_DET_ADAPTABILIDADES));
            //END Adapatabilidade Detalhes

        }
        //END Módulo de Adaptabilidade

    });
</script>
