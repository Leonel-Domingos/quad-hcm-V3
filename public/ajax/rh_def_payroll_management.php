<?php
    require_once '../init.php';
?>
<style>
    fieldset.first-line {
        margin-bottom: 30px;
    }
    .onoffswitch-container.uniform {
        margin-top: 33px;
    }

</style>
<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-end">
                <div class="panel-toolbar pr-3 align-self-end tabs__">
                    <ul id="demo_panel-tabs" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#Tab1" role="tab" aria-selected="true"><?php echo $ui_payroll_items; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab2" role="tab" aria-selected="true"><?php echo $ui_payroll_cells; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab3" role="tab" aria-selected="true"><?php echo $ui_payroll_grids; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab4" role="tab" aria-selected="true"><?php echo $ui_payroll_promotions; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab5" role="tab" aria-selected="true"><?php echo $ui_environment; ?></a>
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
                                            <a class="nav-link active" data-toggle="tab" href="#Tab11" role="tab" aria-selected="true"><?php echo $ui_definition; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Tab12" role="tab" aria-selected="true"><?php echo $ui_contexts; ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="panel-container show">
                                <div class="panel-content">
                                    <div class="tab-content">
                                        <!-- TAB #1.1 -->
                                        <div class="tab-pane fade active show" id="Tab11" role="tabpanel">
                                            <a id="RH_DEF_RUBRICAS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="RH_DEF_RUBRICAS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                            
                                            <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-start">
                                                <div class="panel-toolbar pr-3 align-self-end">
                                                    <ul id="panel-tab-1-1-1" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" data-toggle="tab" href="#Tab111" role="tab" aria-selected="true"><?php echo $ui_details; ?></a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="tab" href="#Tab112" role="tab" aria-selected="true"><?php echo $ui_formulas; ?></a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="tab" href="#Tab113" role="tab" aria-selected="true"><?php echo $ui_incidences_and_associations; ?></a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="tab" href="#Tab114" role="tab" aria-selected="true"><?php echo $ui_outputs; ?></a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="tab" href="#Tab115" role="tab" aria-selected="true"><?php echo $ui_translations; ?></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="panel-container show">
                                                <div class="panel-content">
                                                    <div class="tab-content">
                                                        <!-- TAB #1.1.1 -->
                                                        <div class="tab-pane fade active show" id="Tab111" role="tabpanel">
                                                            <form action="" id="RH_DEF_RUBRICAS_CONTINUED" class="form-horizontal-standard" novalidate="novalidate">
                                                                <div class="quad-alert"></div>
                                                                <form-toolbar></form-toolbar>

                                                                <fieldset class="first-line"> 
                                                                    <header class="frmInnerHeader"><?php echo $ui_scenario; ?></header>
                                                                    <div class="form-row">
                                                                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-2">
                                                                            <div class="onoffswitch-container uniform">
                                                                                <span class="onoffswitch-title horizontal"><?php echo $ui_contracted_net; ?></span> 
                                                                                <span class="onoffswitch">
                                                                                    <input type="checkbox" class="onoffswitch-checkbox" id="CALCULO_ITERATIVO" name="CALCULO_ITERATIVO">
                                                                                    <label class="onoffswitch-label" for="CALCULO_ITERATIVO"> 
                                                                                        <span class="onoffswitch-inner" data-swchon-text="<?php echo mb_strtoupper($ui_yes, 'UTF-8'); ?>" data-swchoff-text="<?php echo mb_strtoupper($ui_no, 'UTF-8'); ?>"></span> 
                                                                                        <span class="onoffswitch-switch"></span>
                                                                                    </label> 
                                                                                </span>                                                                                                                        
                                                    <!--                            <span class="quad-switch-help" rel="tooltip" data-html="true" data-placement="bottom" 
                                                                                    data-original-title="<?php echo $hint_end_process_breaks_cycle; ?>"><i class="fas fa-info"></i>
                                                                                </span> -->
                                                                            </div>                                                                        
                                                                        </div>
                                                                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-2">
                                                                            <div class="onoffswitch-container uniform">
                                                                                <span class="onoffswitch-title horizontal"><?php echo $ui_compensates_discounts; ?></span> 
                                                                                <span class="onoffswitch">
                                                                                    <input type="checkbox" class="onoffswitch-checkbox" id="COMPENSA_DESCONTOS" name="COMPENSA_DESCONTOS">
                                                                                    <label class="onoffswitch-label" for="COMPENSA_DESCONTOS"> 
                                                                                        <span class="onoffswitch-inner" data-swchon-text="<?php echo mb_strtoupper($ui_yes, 'UTF-8'); ?>" data-swchoff-text="<?php echo mb_strtoupper($ui_no, 'UTF-8'); ?>"></span> 
                                                                                        <span class="onoffswitch-switch"></span>
                                                                                    </label> 
                                                                                </span>                                                                                                                        
                                                    <!--                            <span class="quad-switch-help" rel="tooltip" data-html="true" data-placement="bottom" 
                                                                                    data-original-title="<?php echo $hint_end_process_breaks_cycle; ?>"><i class="fas fa-info"></i>
                                                                                </span> -->
                                                                            </div>                                                                           
                                                                        </div>
                                                                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-2">
                                                                            <div class="onoffswitch-container uniform">
                                                                                <span class="onoffswitch-title horizontal"><?php echo $ui_vacation_allowance; ?></span> 
                                                                                <span class="onoffswitch">
                                                                                    <input type="checkbox" class="onoffswitch-checkbox" id="SUB_FERIAS" name="SUB_FERIAS">
                                                                                    <label class="onoffswitch-label" for="SUB_FERIAS"> 
                                                                                        <span class="onoffswitch-inner" data-swchon-text="<?php echo mb_strtoupper($ui_yes, 'UTF-8'); ?>" data-swchoff-text="<?php echo mb_strtoupper($ui_no, 'UTF-8'); ?>"></span> 
                                                                                        <span class="onoffswitch-switch"></span>
                                                                                    </label> 
                                                                                </span>                                                                                                                        
                                                    <!--                            <span class="quad-switch-help" rel="tooltip" data-html="true" data-placement="bottom" 
                                                                                    data-original-title="<?php echo $hint_end_process_breaks_cycle; ?>"><i class="fas fa-info"></i>
                                                                                </span> -->
                                                                            </div>   
                                                                        </div>
                                                                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-2">
                                                                            <div class="onoffswitch-container uniform">
                                                                                <span class="onoffswitch-title horizontal"><?php echo $ui_christmas_allowance; ?></span> 
                                                                                <span class="onoffswitch">
                                                                                    <input type="checkbox" class="onoffswitch-checkbox" id="SUB_NATAL" name="SUB_NATAL">
                                                                                    <label class="onoffswitch-label" for="SUB_NATAL"> 
                                                                                        <span class="onoffswitch-inner" data-swchon-text="<?php echo mb_strtoupper($ui_yes, 'UTF-8'); ?>" data-swchoff-text="<?php echo mb_strtoupper($ui_no, 'UTF-8'); ?>"></span> 
                                                                                        <span class="onoffswitch-switch"></span>
                                                                                    </label> 
                                                                                </span>                                                                                                                        
                                                    <!--                            <span class="quad-switch-help" rel="tooltip" data-html="true" data-placement="bottom" 
                                                                                    data-original-title="<?php echo $hint_end_process_breaks_cycle; ?>"><i class="fas fa-info"></i>
                                                                                </span> -->
                                                                            </div> 
                                                                        </div>
                                                                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-2">
                                                                            <div class="onoffswitch-container uniform">
                                                                                <span class="onoffswitch-title horizontal"><?php echo $ui_foreign_irs; ?></span> 
                                                                                <span class="onoffswitch">
                                                                                    <input type="checkbox" class="onoffswitch-checkbox" id="CLASS_LOC_IRS" name="CLASS_LOC_IRS">
                                                                                    <label class="onoffswitch-label" for="CLASS_LOC_IRS"> 
                                                                                        <span class="onoffswitch-inner" data-swchon-text="<?php echo mb_strtoupper($ui_yes, 'UTF-8'); ?>" data-swchoff-text="<?php echo mb_strtoupper($ui_no, 'UTF-8'); ?>"></span> 
                                                                                        <span class="onoffswitch-switch"></span>
                                                                                    </label> 
                                                                                </span>                                                                                                                        
                                                    <!--                            <span class="quad-switch-help" rel="tooltip" data-html="true" data-placement="bottom" 
                                                                                    data-original-title="<?php echo $hint_end_process_breaks_cycle; ?>"><i class="fas fa-info"></i>
                                                                                </span> -->
                                                                            </div> 
                                                                        </div>
                                                                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-2">
                                                                            <div class="onoffswitch-container uniform">
                                                                                <span class="onoffswitch-title horizontal"><?php echo $ui_portal; ?></span> 
                                                                                <span class="onoffswitch">
                                                                                    <input type="checkbox" class="onoffswitch-checkbox" id="PORTAL" name="PORTAL">
                                                                                    <label class="onoffswitch-label" for="PORTAL"> 
                                                                                        <span class="onoffswitch-inner" data-swchon-text="<?php echo mb_strtoupper($ui_yes, 'UTF-8'); ?>" data-swchoff-text="<?php echo mb_strtoupper($ui_no, 'UTF-8'); ?>"></span> 
                                                                                        <span class="onoffswitch-switch"></span>
                                                                                    </label> 
                                                                                </span>                                                                                                                        
                                                    <!--                            <span class="quad-switch-help" rel="tooltip" data-html="true" data-placement="bottom" 
                                                                                    data-original-title="<?php echo $hint_end_process_breaks_cycle; ?>"><i class="fas fa-info"></i>
                                                                                </span> -->
                                                                            </div> 
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <!-- Sub-Row #2 -->
                                                                    <div class="form-row">
                                                                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-2">
                                                                            <label for="CALCULO_FINAL"><?php echo $ui_final_calculation; ?></label>
                                                                            <select class="form-control domainLists chosen " name="CALCULO_FINAL"></select>
                                                                        </div> 
                                                                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-2">
                                                                            <label for="ID_REGRA_VALOR"><?php echo $ui_rule; ?></label>
                                                                            <select class="form-control domainLists chosen " name="ID_REGRA_VALOR"></select>
                                                    <!--                        <span class="quad-inner-help" rel="tooltip" data-html="true" data-placement="bottom" 
                                                                                data-original-title="<?php echo $hint_cycle_absenteeism; ?>"><i class="fas fa-info"></i>
                                                                            </span> -->
                                                                        </div>    
                                                                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-2">
                                                                            <label for="HIST_TIPO"><?php echo $ui_historic_variation_type; ?></label>
                                                                            <select class="form-control domainLists chosen " name="HIST_TIPO"></select>
                                                                        </div>     
                                                                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-2">
                                                                            <label for="HIST_INTER"><?php echo $ui_historic_variation_value; ?></label>
                                                                            <input class="form-control toRight" name="HIST_INTER" style="width:90px;">
                                                                        </div>  
                                                                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-2">
                                                                            <label for="BASE_ARREDONDA"><?php echo $ui_rounding_base; ?></label>
                                                                            <input class="form-control toRight" name="BASE_ARREDONDA" style="width:90px;">
                                                                        </div>     
                                                                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-2">
                                                                            <label for="TIPO_ARREDONDA"><?php echo $ui_rounding_type; ?></label>
                                                                            <select class="form-control domainLists" name="TIPO_ARREDONDA"></select>
                                                                        </div>
                                                                    </div>
                                                                </fieldset>

                                                                <!-- Impressão -->
                                                                <fieldset class="first-line"> 
                                                                    <header class="frmInnerHeader"><?php echo $ui_printout; ?></header>                                   
                                                                    <div class="form-row">
                                                                        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                                                            <label for="DSP_PRINT"><?php echo $ui_designation; ?></label>
                                                                            <input class="form-control toRight /*w-70 include-help*/" name="DSP_PRINT">
        <!--                                                                                <span class="quad-inner-help" rel="tooltip" data-html="true" data-placement="bottom" 
                                                                                data-original-title="<?php echo $hint_format_H_MM; ?>"><i class="fas fa-info"></i>
                                                                            </span>                                                                        -->
                                                                        </div>                                                                             
                                                                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                                                            <label for="CONDICAO_PRINT"><?php echo $ui_print_condition; ?></label>
                                                                             <select class="form-control domainLists" name="CONDICAO_PRINT"></select>
                                                                        </div>      
                                                                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-1">
                                                                            <label for="SEQ_PRINT"><?php echo $ui_order_nr; ?></label>
                                                                            <input class="form-control toRight /*w-70 include-help*/" name="SEQ_PRINT">
        <!--                                                                                <span class="quad-inner-help" rel="tooltip" data-html="true" data-placement="bottom" 
                                                                                data-original-title="<?php echo $hint_format_H_MM; ?>"><i class="fas fa-info"></i>
                                                                            </span> -->
                                                                        </div>      
                                                                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-1">
                                                                            <div class="onoffswitch-container uniform">
                                                                                <span class="/*onoffswitch-title horizontal*/"><?php echo $ui_zero; ?></span> 
                                                                                <span class="onoffswitch">
                                                                                    <input type="checkbox" class="onoffswitch-checkbox" id="PRINT_ZERO" name="PRINT_ZERO">
                                                                                    <label class="onoffswitch-label" for="PRINT_ZERO"> 
                                                                                        <span class="onoffswitch-inner" data-swchon-text="<?php echo mb_strtoupper($ui_yes, 'UTF-8'); ?>" data-swchoff-text="<?php echo mb_strtoupper($ui_no, 'UTF-8'); ?>"></span> 
                                                                                        <span class="onoffswitch-switch"></span>
                                                                                    </label> 
                                                                                </span>                                                                                                                        
                                                    <!--                            <span class="quad-switch-help" rel="tooltip" data-html="true" data-placement="bottom" 
                                                                                    data-original-title="<?php echo $hint_end_process_breaks_cycle; ?>"><i class="fas fa-info"></i>
                                                                                </span> -->
                                                                            </div> 
                                                                        </div>
                                                                    </div>
                                                                </fieldset>

                                                                <!-- Grupos contabilísticos -->
                                                                <fieldset class="first-line"> 
                                                                    <header class="frmInnerHeader"><?php echo $ui_accounting_groups; ?></header>
                                                                    <div class="form-row">
                                                                        <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                                                            <label for="DSP_GC_RUBRICA"><?php echo $ui_payroll_item; ?></label>
                                                                            <select class="form-control domainLists" name="DSP_GC_RUBRICA"></select>
                                                                        </div>                                        
                                                                        <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                                                            <label for="DSP_GC_DESCONTO"><?php echo $ui_discount; ?></label>
                                                                            <select class="form-control domainLists" name="DSP_GC_DESCONTO"></select>
                                                                        </div> 
                                                                    </div>
                                                                </fieldset>
                                                            </form>
                                                        </div>
                                                        <!-- END TAB #1.1.1 -->

                                                        <!-- TAB #1.1.2 -->
                                                        <div class="tab-pane fade" id="Tab112" role="tabpanel">
                                                            <form action="" id="RH_DEF_RUBRICAS_FORMULAS" class="form-horizontal-standard" novalidate="novalidate">
                                                                <div class="quad-alert"></div>
                                                                <form-toolbar></form-toolbar>

                                                                <!-- Quantidade -->
                                                                <div class="row">
                                                                    <fieldset class="col-xs-12 col-sm-12 col-md-2 col-lg-1 first-line">                                                                                
                                                                        <div class="onoffswitch-container uniform">
                                                                            <span class="onoffswitch-title horizontal sm-bold top-58">
                                                                                <?php echo $ui_quantity; ?>
                                                                            </span> 
                                                                            <span class="onoffswitch">
                                                                                <input type="checkbox" class="onoffswitch-checkbox" id="QTD_RECOLHA" name="QTD_RECOLHA">
                                                                                <label class="onoffswitch-label" for="QTD_RECOLHA"> 
                                                                                    <span class="onoffswitch-inner" data-swchon-text="<?php echo mb_strtoupper($ui_yes, 'UTF-8'); ?>" data-swchoff-text="<?php echo mb_strtoupper($ui_no, 'UTF-8'); ?>"></span> 
                                                                                    <span class="onoffswitch-switch"></span>
                                                                                </label> 
                                                                            </span>                                                                                                                        
                                                                            <span class="quad-switch-help top-58" rel="tooltip" data-html="true" data-placement="bottom" 
                                                                                data-original-title="<?php echo $hint_in_manual_input; ?>"><i class="fas fa-info"></i>
                                                                            </span> 
                                                                        </div>     
                                                                        
                                                                    </fieldset>

                                                                    <!-- IN's -->
                                                                    <fieldset class="col-xs-12 col-sm-12 col-md-7 col-lg-8 first-line"> 
                                                                        <header class="frmInnerHeader"><?php echo $ui_in; ?></header>
                                                                        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                                            <textarea class="form-control formula" name="USER_IN_QTD"></textarea>
                                                                        </div>                                                                               
                                                                    </fieldset>

                                                                    <!-- OUT's -->
                                                                    <fieldset class="col-xs-12 col-sm-12 col-md-3 col-lg-3 first-line"> 
                                                                        <header class="frmInnerHeader"><?php echo $ui_out; ?></header>
                                                                        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                                            <textarea class="form-control formula" name="USER_OUT_QTD"></textarea>
                                                                        </div>
                                                                    </fieldset>                                                                            
                                                                </div>

                                                                <!-- Preço -->
                                                                <div class="row">
                                                                    <fieldset class="col-xs-12 col-sm-12 col-md-2 col-lg-1 first-line">                                                                                
                                                                        <div class="onoffswitch-container uniform">
                                                                            <span class="onoffswitch-title horizontal sm-bold">
                                                                                <?php echo $ui_price; ?>
                                                                            </span> 
                                                                            <span class="onoffswitch">
                                                                                <input type="checkbox" class="onoffswitch-checkbox" id="PRC_RECOLHA" name="PRC_RECOLHA">
                                                                                <label class="onoffswitch-label" for="PRC_RECOLHA"> 
                                                                                    <span class="onoffswitch-inner" data-swchon-text="<?php echo mb_strtoupper($ui_yes, 'UTF-8'); ?>" data-swchoff-text="<?php echo mb_strtoupper($ui_no, 'UTF-8'); ?>"></span> 
                                                                                    <span class="onoffswitch-switch"></span>
                                                                                </label> 
                                                                            </span>     
                                                                            <span class="quad-switch-help top-flex" rel="tooltip" data-html="true" data-placement="bottom" 
                                                                                data-original-title="<?php echo $hint_in_manual_input; ?>" style=""><i class="fas fa-info"></i>
                                                                            </span> 
                                                                        </div>                                                                                
                                                                    </fieldset>

                                                                    <!-- IN's -->
                                                                    <fieldset class="col-xs-12 col-sm-12 col-md-7 col-lg-8 first-line"> 
                                                                        <header class="frmInnerHeader visible-xs visible-sm"><?php echo $ui_in; ?></header>
                                                                        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                                            <textarea class="form-control formula" name="USER_IN_PRC"></textarea>
                                                                        </div>                                                                               
                                                                    </fieldset>

                                                                    <!-- OUT's -->
                                                                    <fieldset class="col-xs-12 col-sm-12 col-md-3 col-lg-3 first-line"> 
                                                                        <header class="frmInnerHeader visible-xs visible-sm"><?php echo $ui_out; ?></header>
                                                                        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                                            <textarea class="form-control formula" name="USER_OUT_PRC"></textarea>
                                                                        </div>
                                                                    </fieldset>                                                                            
                                                                </div>

                                                                <!-- Factor -->
                                                                <div class="row">
                                                                    <fieldset class="col-xs-12 col-sm-12 col-md-2 col-lg-1 first-line">                                                                                
                                                                        <div class="onoffswitch-container uniform">
                                                                            <span class="onoffswitch-title horizontal sm-bold">
                                                                                <?php echo $ui_factor; ?>
                                                                            </span> 
                                                                            <span class="onoffswitch">
                                                                                <input type="checkbox" class="onoffswitch-checkbox" id="FACTOR_RECOLHA" name="FACTOR_RECOLHA">
                                                                                <label class="onoffswitch-label" for="FACTOR_RECOLHA"> 
                                                                                    <span class="onoffswitch-inner" data-swchon-text="<?php echo mb_strtoupper($ui_yes, 'UTF-8'); ?>" data-swchoff-text="<?php echo mb_strtoupper($ui_no, 'UTF-8'); ?>"></span> 
                                                                                    <span class="onoffswitch-switch"></span>
                                                                                </label> 
                                                                            </span>                                                                                                                        
                                                                            <span class="quad-switch-help top-flex" rel="tooltip" data-html="true" data-placement="bottom" 
                                                                                data-original-title="<?php echo $hint_in_manual_input; ?>"><i class="fas fa-info"></i>
                                                                            </span> 
                                                                        </div>                                                                                
                                                                    </fieldset>

                                                                    <!-- IN's -->
                                                                    <fieldset class="col-xs-12 col-sm-12 col-md-7 col-lg-8 first-line"> 
                                                                        <header class="frmInnerHeader visible-xs visible-sm"><?php echo $ui_in; ?></header>
                                                                        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                                            <textarea class="form-control formula" name="USER_IN_FCT"></textarea>
                                                                        </div>                                                                               
                                                                    </fieldset>

                                                                    <!-- OUT's -->
                                                                    <fieldset class="col-xs-12 col-sm-12 col-md-3 col-lg-3 first-line"> 
                                                                        <header class="frmInnerHeader visible-xs visible-sm"><?php echo $ui_out; ?></header>
                                                                        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                                            <textarea class="form-control formula" name="USER_OUT_FCT"></textarea>
                                                                        </div>
                                                                    </fieldset>                                                                            
                                                                </div>

                                                                <!-- Valor -->
                                                                <div class="row">
                                                                    <fieldset class="col-xs-12 col-sm-12 col-md-2 col-lg-1 first-line">                                                                                
                                                                        <div class="onoffswitch-container uniform">
                                                                            <span class="onoffswitch-title horizontal sm-bold">
                                                                                <?php echo $ui_value; ?>
                                                                            </span> 
                                                                        </div>                                                                                
                                                                    </fieldset>

                                                                    <!-- IN's -->
                                                                    <fieldset class="col-xs-12 col-sm-12 col-md-7 col-lg-8 first-line"> 
                                                                        <header class="frmInnerHeader visible-xs visible-sm"><?php echo $ui_in; ?></header>
                                                                        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                                            <textarea class="form-control formula" name="USER_IN_VLR"></textarea>
                                                                        </div>                                                                               
                                                                    </fieldset>

                                                                    <!-- OUT's -->
                                                                    <fieldset class="col-xs-12 col-sm-12 col-md-3 col-lg-3 first-line"> 
                                                                        <header class="frmInnerHeader visible-xs visible-sm"><?php echo $ui_out; ?></header>
                                                                        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                                            <textarea class="form-control formula" name="USER_OUT_VLR"></textarea>
                                                                        </div>
                                                                    </fieldset>                                                                            
                                                                </div>

                                                            </form>
                                                        </div>                                        
                                                        <!-- END TAB #1.1.2 -->

                                                        <!-- TAB #1.1.3 -->
                                                        <div class="tab-pane fade" id="Tab113" role="tabpanel">
                                                            <div class="row mt-4">
                                                                <div class="col-xl-12">
                                                                    <div id="panel-51" class="panel">
                                                                        <div class="panel-hdr">
                                                                            <span class="widget-icon trads"> <i class="fas fa-share-alt"></i></span>&nbsp;
                                                                            <h2><?php echo $ui_incidences; ?></h2>
                                                                        </div>
                                                                        <div class="panel-container show">
                                                                            <div class="panel-content">                                            
                                                                                <a id="RH_DEF_INCIDENCIAS_RUBRICAS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                                                <table id="RH_DEF_INCIDENCIAS_RUBRICAS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row mt-4">
                                                                <div class="col-xl-12">
                                                                    <div id="panel-51" class="panel">
                                                                        <div class="panel-hdr">
                                                                            <span class="widget-icon trads"> <i class="fas fa-wifi fa-flip-vertical"></i></span>&nbsp;
                                                                            <h2><?php echo $ui_associations; ?></h2>
                                                                        </div>
                                                                        <div class="panel-container show">
                                                                            <div class="panel-content">                                            
                                                                                <a id="RH_DEF_ASSOCIACAO_RUBRICAS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                                                <table id="RH_DEF_ASSOCIACAO_RUBRICAS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>                                        
                                                        <!-- END TAB #1.1.3 -->

                                                        <!-- TAB #1.1.4 -->
                                                        <div class="tab-pane fade" id="Tab114" role="tabpanel">
                                                            <a id="DG_DET_GRUPOS_OUTPUT_RUB_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                            <table id="DG_DET_GRUPOS_OUTPUT_RUB" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                                        </div>                                        
                                                        <!-- END TAB #1.1.4 -->

                                                        <!-- TAB #1.1.5 -->
                                                        <div class="tab-pane fade" id="Tab115" role="tabpanel">
                                                            <a id="RH_DEF_RUBRICAS_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                            <table id="RH_DEF_RUBRICAS_TRADS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                                        </div>                                        
                                                        <!-- END TAB #1.1.5 -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END TAB #1.1 -->
                                        
                                        <!-- TAB #1.2 -->
                                        <div class="tab-pane fade" id="Tab12" role="tabpanel">
                                            <a id="Contextos_Rubricas_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="Contextos_Rubricas" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                            <div class="row mt-4">
                                                <div class="col-xl-12">
                                                    <div id="panel-11" class="panel">
                                                        <div class="panel-hdr">
                                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                                            <h2><?php echo $ui_translate; ?></h2>
                                                        </div>
                                                        <div class="panel-container show">
                                                            <div class="panel-content">
                                                                <a id="Contextos_RubricasTrads_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                                <table id="Contextos_RubricasTrads" class="table table-bordered table-hover table-striped w-100"></table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                        
                                        <!-- END TAB #1.2 -->
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #1 -->

                         <!-- TAB #2 -->
                        <div class="tab-pane fade" id="Tab2" role="tabpanel">
                            <a id="RH_DEF_CELULAS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="RH_DEF_CELULAS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-51" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon trads"> <i class="far fa-calendar-alt"></i></span>&nbsp;
                                            <h2><?php echo $ui_months; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">                                            
                                                <a id="RH_DEF_CELULAS_MES_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="RH_DEF_CELULAS_MES" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #2 -->
                        
                         <!-- TAB #3 -->
                        <div class="tab-pane fade" id="Tab3" role="tabpanel">
                            <a id="RH_DEF_GRELHAS_SALARIAIS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="RH_DEF_GRELHAS_SALARIAIS" class="table responsive table-bordered table-striped table-hover nowrap"></table>

                            <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-start">
                                <div class="panel-toolbar pr-3 align-self-end">
                                    <ul id="panel-tab-3-1" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#Tab31" role="tab" aria-selected="true"><?php echo $ui_details; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Tab32" role="tab" aria-selected="true"><?php echo $ui_composition; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Tab33" role="tab" aria-selected="true"><?php echo $ui_situations; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Tab34" role="tab" aria-selected="true"><?php echo $ui_outputs; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Tab35" role="tab" aria-selected="true"><?php echo $ui_translations; ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="panel-container show">
                                <div class="panel-content">
                                    <div class="tab-content">
                                        <!-- TAB #3.1 -->
                                        <div class="tab-pane fade active show" id="Tab31" role="tabpanel">
                                            <div class="row mt-4">
                                                <div class="col-xl-12">
                                                    <div id="panel-51" class="panel">
                                                        <div class="panel-hdr">
                                                            <span class="widget-icon trads"> <i class="far fa-list-ol"></i></span>&nbsp;
                                                            <h2><?php echo $ui_lines; ?></h2>
                                                        </div>
                                                        <div class="panel-container show">
                                                            <div class="panel-content">                                            
                                                                <a id="RH_DEF_LINHAS_SALARIAIS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                                <table id="RH_DEF_LINHAS_SALARIAIS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-4">
                                                <div class="col-xl-12">
                                                    <div id="panel-51" class="panel">
                                                        <div class="panel-hdr">
                                                            <span class="widget-icon trads"> <i class="far fa-list-ol"></i></span>&nbsp;
                                                            <h2><?php echo $ui_values; ?></h2>
                                                        </div>
                                                        <div class="panel-container show">
                                                            <div class="panel-content">                                            
                                                                <a id="RH_DEF_VALORES_SALARIAIS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                                <table id="RH_DEF_VALORES_SALARIAIS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END TAB #3.1 -->
                                        
                                        <!-- TAB #3.2 -->
                                        <div class="tab-pane fade" id="Tab32" role="tabpanel">
                                            <a id="RH_DEF_AUTO_GRELHAS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="RH_DEF_AUTO_GRELHAS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                        </div>                                        
                                        <!-- END TAB #3.2 -->
                                        
                                        <!-- TAB #3.3 -->
                                        <div class="tab-pane fade" id="Tab33" role="tabpanel">
                                            <a id="RH_DEF_SITUACOES_GRELHAS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="RH_DEF_SITUACOES_GRELHAS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                        </div>
                                        <!-- END TAB #3.3 -->
                                        
                                        <!-- TAB #3.4 -->
                                        <div class="tab-pane fade" id="Tab34" role="tabpanel">
                                            <a id="DG_DET_GRUPOS_OUTPUT_GRELHAS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="DG_DET_GRUPOS_OUTPUT_GRELHAS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                        </div>
                                        <!-- END TAB #3.4 -->
                                        
                                        <!-- TAB #3.5 -->
                                        <div class="tab-pane fade" id="Tab35" role="tabpanel">
                                            <a id="RH_DEF_GRELHAS_SALARIAIS_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="RH_DEF_GRELHAS_SALARIAIS_TRADS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                        </div>
                                        <!-- END TAB #3.5 -->
                                    </div>
                                </div>
                            </div>

                        </div>
                         <!-- END TAB #3 -->

                         <!-- TAB #4 -->
                        <div class="tab-pane fade" id="Tab4" role="tabpanel">
                            <a id="RH_DEF_REGRAS_ATRIBUICAO_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="RH_DEF_REGRAS_ATRIBUICAO" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-51" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon trads"> <i class="fas fa-user-cog"></i></span>&nbsp;
                                            <h2><?php echo $ui_seniority_awards; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">                                            
                                                <a id="RH_DEF_PREMIOS_ANTIGUIDADE_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="RH_DEF_PREMIOS_ANTIGUIDADE" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-51" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon trads"> <i class="far fa-user-cog"></i></span>&nbsp;
                                            <h2><?php echo $ui_diuturnities_type_A; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">                                            
                                                <a id="RH_DEF_DIUTURNIDADES_A_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="RH_DEF_DIUTURNIDADES_A" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-51" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon trads"> <i class="far fa-user-cog"></i></span>&nbsp;
                                            <h2><?php echo $ui_diuturnities_type_B; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">                                            
                                                <a id="RH_DEF_DIUTURNIDADES_B_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="RH_DEF_DIUTURNIDADES_B" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #4 -->

                         <!-- TAB #5 -->
                        <div class="tab-pane fade" id="Tab5" role="tabpanel">
                            <div class="row mt-4">
                                <!-- Rubricas Calc. Iterativo -->
                                <div class="col-xl-4">
                                    <div id="panel-51" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon trads"> <i class="fas fa-user-cog"></i></span>&nbsp;
                                            <h2><?php echo $ui_payroll_items; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">                                            
                                                <a id="Calc_Iterativo_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="Calc_Iterativo" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                                
                                                <a id="Calc_Iterativo_CGA_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="Calc_Iterativo_CGA" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Retroativos -->
                                <div class="col-xl-4">
                                    <div id="panel-51" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon trads"> <i class="fas fa-user-cog"></i></span>&nbsp;
                                            <h2><?php echo $ui_retroactive_payments_since; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">                                            
                                                <a id="Retroativos_Desde_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="Retroativos_Desde" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- IRS -->
                                <div class="col-xl-4">
                                    <div id="panel-51" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon trads"> <i class="fas fa-user-cog"></i></span>&nbsp;
                                            <h2><?php echo $ui_cirs; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">                                            
                                                <a id="IRS_A_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="IRS_A" class="table responsive table-bordered table-striped table-hover nowrap"></table>

                                                <a id="IRS_B_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="IRS_B" class="table responsive table-bordered table-striped table-hover nowrap"></table>

                                                <a id="IRS_H_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="IRS_H" class="table responsive table-bordered table-striped table-hover nowrap"></table>

                                                <a id="IRS_Z_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="IRS_Z" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Recibos Negativos -->
                                <div class="col-xl-4">
                                    <div id="panel-51" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon trads"> <i class="fas fa-user-cog"></i></span>&nbsp;
                                            <h2><?php echo $ui_negative_pay_slips; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">                                            
                                                <a id="RN_ACERTO_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="RN_ACERTO" class="table responsive table-bordered table-striped table-hover nowrap"></table>

                                                <a id="RN_ACERTO_POS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="RN_ACERTO_POS" class="table responsive table-bordered table-striped table-hover nowrap"></table>

                                                <a id="RN_ACERTO_NEG_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="RN_ACERTO_NEG" class="table responsive table-bordered table-striped table-hover nowrap"></table>

                                                <a id="RN_ACERTO_LIMITE_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="RN_ACERTO_LIMITE" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Descontos Judiciais -->
                                <div class="col-xl-4">
                                    <div id="panel-51" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon trads"> <i class="fas fa-user-cog"></i></span>&nbsp;
                                            <h2><?php echo $ui_judicial_discounts; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">                                            
                                                <a id="Grelha_RMG_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="Grelha_RMG" class="table responsive table-bordered table-striped table-hover nowrap"></table>

                                                <a id="Val_LIM_MAXIMO_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="Val_LIM_MAXIMO" class="table responsive table-bordered table-striped table-hover nowrap"></table>

                                                <a id="Val_MAX_PERCENT_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="Val_MAX_PERCENT" class="table responsive table-bordered table-striped table-hover nowrap"></table>

                                                <a id="Val_LIM_MIN_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="Val_LIM_MIN" class="table responsive table-bordered table-striped table-hover nowrap"></table>

                                                <a id="Val_MIN_PERCENT_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="Val_MIN_PERCENT" class="table responsive table-bordered table-striped table-hover nowrap"></table>

                                                <a id="Val_MIN_LIMIT_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="Val_MIN_LIMIT" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #5 -->
                    </div>                    
                </div>                    
            </div> 
        </div>
    </div>
</div>

<script>
    pageSetUp();    
    
    $(document).ready(function () {

        //Módulo de Rubricas & Células
        if (1 === 1) {
            //Definição Rubricas
            var optionRH_DEF_RUBRICAS = {
                "tableId": "RH_DEF_RUBRICAS",
                "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_payroll_item; ?>",
                "table": "RH_DEF_RUBRICAS", 
                "pk": {
                    "primary": {
                        "CD_RUBRICA": {"type": "varchar"}
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
                "detailsObjects": ['RH_DEF_RUBRICAS_CONTINUED','RH_DEF_RUBRICAS_FORMULAS','RH_DEF_RUBRICAS_TRADS','RH_DEF_INCIDENCIAS_RUBRICAS','RH_DEF_ASSOCIACAO_RUBRICAS','DG_DET_GRUPOS_OUTPUT_RUB'],
                "order_by": "CD_RUBRICA",
                "scrollY": "156", //"195" "156", 
                "recordBundle": 10, //6  5
                "pageLenght": 10,  //6 5
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
                        "data": 'CD_RUBRICA',
                        "name": 'CD_RUBRICA',
                        "className": "visibleColumn",                   
                    }, {
                        "responsivePriority": 3, 
                        "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_designation; ?>", //Editor
                        "data": 'DSP_RUBRICA',
                        "name": 'DSP_RUBRICA',
                        "className": "visibleColumn",
                    }, {
                        "responsivePriority": 4, 
                        "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_short_desig; ?>", //Editor
                        "data": 'DSR_RUBRICA',
                        "name": 'DSR_RUBRICA',
                        "className": "visibleColumn",
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
                            "dependent-group": 'RH_DEF_RUBRICAS.CONTEXTO',
                            "class": "form-control"
                        },
                        "render": function (val, type, row) {
                            if (val != null) {
                                var o = _.find(initApp.joinsData['RH_DEF_RUBRICAS.CONTEXTO'], {'RV_LOW_VALUE': val});
                                return val == null ? null : o['RV_MEANING'];
                            }
                            return val;
                        }
                    }, {
                        "responsivePriority": 6, 
                        "title": "<?php echo mb_strtoupper($ui_order_nr, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_order_nr; ?>", //Editor
                        "data": 'NR_ORDEM_PROC',
                        "name": 'NR_ORDEM_PROC',
                        "className": "visibleColumn right",
                        "type": "hidden", //Editor
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
                        "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                        "name": 'BUTTONS',
                        "type": "hidden",
                        "width": "6%",
                        "className": "toBottom toCenter",
                        "render": function () {
                            //debugger;
                            return RH_DEF_RUBRICAS.crudButtons(true,true,true);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "CD_RUBRICA": {
                            required: true,
                            maxlength: 4
                        },
                        "DSP_RUBRICA": {
                            required: true,
                            maxlength: 45,
                        },
                        "DSR_RUBRICA": {
                            required: false,
                            maxlength: 25,
                        },
                        "ACTIVO": {
                            required: true
                        },
                        "DESCRICAO": {
                            required: false,
                            maxlength: 4000,
                        },
                    }
                }
            };
            RH_DEF_RUBRICAS = new QuadTable();
            RH_DEF_RUBRICAS.initTable( $.extend({}, datatable_instance_defaults, optionRH_DEF_RUBRICAS) );
            //END Definição Rubricas
            
            //Rubricas Continued :: QUADFORMS
            var optionsRH_DEF_RUBRICAS_CONTINUED = {
                formId: "#RH_DEF_RUBRICAS_CONTINUED",
                table: "RH_DEF_RUBRICAS",
                info: true, //Disables INFO: (record / total records) :: HOW ????
                "pk": {
                    "primary": {
                        "CD_RUBRICA": {"type": "varchar"}
                    }
                },
                "dependsOn": {
                    "RH_DEF_RUBRICAS": {
                        "CD_RUBRICA": "CD_RUBRICA"
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
                    ID_REGRA_VALOR: {
                         "domain-list": true,
                         "dependent-group": "RH_DEF_TAB_ALT_VLR_RUBRICAS.ID_REGRA_VALOR"
                    },
                    HIST_TIPO: {
                         "domain-list": true,
                         "dependent-group": "RH_DEF_RUBRICAS.HIST_TIPO"
                    },
                    CALCULO_FINAL: {
                         "domain-list": true,
                         "dependent-group": "RH_DEF_RUBRICAS.CALCULO_FINAL"
                    },
                    TIPO_ARREDONDA: {
                         "domain-list": true,
                         "dependent-group": "DG_TP_ARRED"
                    },
                    CONDICAO_PRINT: {
                         "domain-list": true,
                         "dependent-group": "RH_DEF_RUBRICAS.CONDICAO_PRINT"
                    },
                },
                complexLists: {
                    "DSP_GC_RUBRICA": {
                        "name": "DSP_GC_RUBRICA",
                        "dependent-group": "GRP_CONTAB",
                        "dependent-level": 1,
                        "data-db-name": 'A.CD_GRP_CONTAB',
                        "distribute-value": "CD_GC_RUBRICA",
                        "decodeFromTable": 'DG_DEF_GRUPOS_CONTABILISTICOS A',
                        "desigColumn": "A.DSP_GRP_CONTAB",
                        "orderBy": "A.DSP_GRP_CONTAB",
                        "class": "form-control complexList chosen",
                        "whereClause": " AND A.AMBITO_GRP_CONTAB = 'A' AND A.RH_TP_INTERFACE = 'A' ",
                        "filter": {
                            "create": "  AND A.AMBITO_GRP_CONTAB = 'A' AND A.RH_TP_INTERFACE = 'A' AND A.ACTIVO = 'S' ", //On-New-Record
                            "edit": "  AND A.AMBITO_GRP_CONTAB = 'A' AND A.RH_TP_INTERFACE = 'A' AND A.ACTIVO = 'S' ", //On-Edit-Record
                        }
                    },
                    "DSP_GC_DESCONTO": {
                        "name": "DSP_GC_DESCONTO",
                        "dependent-group": "GRP_CONTAB",
                        "dependent-level": 1,
                        "data-db-name": 'A.CD_GRP_CONTAB',
                        "distribute-value": "CD_GC_DESCONTO",
                        "decodeFromTable": 'DG_DEF_GRUPOS_CONTABILISTICOS A',
                        "desigColumn": "A.DSP_GRP_CONTAB",
                        "orderBy": "A.DSP_GRP_CONTAB",
                        "class": "form-control complexList chosen",
                        "whereClause": " AND A.AMBITO_GRP_CONTAB = 'A' AND A.RH_TP_INTERFACE = 'A' ",
                        "filter": {
                            "create": "  AND A.AMBITO_GRP_CONTAB = 'A' AND A.RH_TP_INTERFACE = 'A' AND A.ACTIVO = 'S' ", //On-New-Record
                            "edit": "  AND A.AMBITO_GRP_CONTAB = 'A' AND A.RH_TP_INTERFACE = 'A' AND A.ACTIVO = 'S' ", //On-Edit-Record
                        }
                    }  
                }
//                "validations": {
//                    "rules": {
//                        "HIST_INTER": {
//                            number: true
//                        },
//                        "INCLUIR_SS": {
//                            required: true
//                        },                      
//                        "DOC_JUSTIF": {
//                            maxlength: 30
//                        }
//                    }
//                }                
            };        
            RH_DEF_RUBRICAS_CONTINUED = new QuadForm();
            RH_DEF_RUBRICAS_CONTINUED.initForm($.extend({}, datatable_instance_defaults, optionsRH_DEF_RUBRICAS_CONTINUED));
            //Rubricas Continued :: QUADFORMS  
                        
            //Rubricas Formulas :: QUADFORMS
            var optionsRH_DEF_RUBRICAS_FORMULAS = {
                formId: "#RH_DEF_RUBRICAS_FORMULAS",
                table: "RH_DEF_RUBRICAS",
                info: true, //Disables INFO: (record / total records) :: HOW ????
                "pk": {
                    "primary": {
                        "CD_RUBRICA": {"type": "varchar"}
                    }
                },
                "dependsOn": {
                    "RH_DEF_RUBRICAS": {
                        "CD_RUBRICA": "CD_RUBRICA"
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
            };        
            RH_DEF_RUBRICAS_FORMULAS = new QuadForm();
            RH_DEF_RUBRICAS_FORMULAS.initForm($.extend({}, datatable_instance_defaults, optionsRH_DEF_RUBRICAS_FORMULAS));
            //Rubricas Formulas :: QUADFORMS              

            //Outputs : Rubricas
            var optionDG_DET_GRUPOS_OUTPUT_RUB = {
                "tableId": "DG_DET_GRUPOS_OUTPUT_RUB",
                "table": "DG_DET_GRUPOS_OUTPUT",
                "pk": {
                    "primary": {
                        "CD_OUTPUT": {"type": "varchar"},
                        "CD_GRUPO": {"type": "varchar"},
                        "SEQ": {"type": "number"},
                        "CD_RUBRICA": {"type": "varchar"},
                    }
                },
                "dependsOn": {
                    "RH_DEF_RUBRICAS": {
                        "CD_RUBRICA": "CD_RUBRICA"
                    }
                },
                "initialWhereClause": '',             
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
                        "data": 'CD_RUBRICA',
                        "name": 'CD_RUBRICA',
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
                        "data": 'CD_ED',
                        "name": 'CD_ED',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "responsivePriority": 4,
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
                            "data-db-name": "CD_ED",
                            "decodeFromTable": "RH_DEF_ENTIDADES_DESCONTO",  //TO CHANGE ON QUAD-HCM
                            "desigColumn": "CONCAT(CONCAT(CD_ED,'-'),DSP_ED)",
                            "orderBy": "CD_ED",
                            "class": "form-control complexList chosen",
                            "filter": {
                                "create": " AND ACTIVO = 'S' ", //On-New-Record
                                "edit": " AND ACTIVO = 'S' ", //On-Edit-Record
                            }
                        }                   
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'CD_SITUACAO',
                        "name": 'CD_SITUACAO',
                        "type": "hidden",
                        "visible": false,
                        "className": "",
                    }, {
                        "responsivePriority": 5,
                        "complexList": true,
                        "title": "<?php echo mb_strtoupper($ui_situation,'UTF-8'); ?>",
                        "label": "<?php echo $ui_situation; ?>",
                        "data": 'DSP_SITUACAO',
                        "name": 'DSP_SITUACAO',
                        "type": "select",
                        "className": "visibleColumn",
                        //"renew": true,
                        "attr": {
                            "dependent-group": "SITUACOES",
                            "dependent-level": 1,
                            "data-db-name": "A.CD_SITUACAO",
                            "decodeFromTable": "RH_DEF_SITUACOES A",
                            "desigColumn": "CONCAT(CONCAT(A.CD_SITUACAO,'-'),A.DSP_SITUACAO)",
                            "orderBy": "A.CD_SITUACAO",
                            "class": "form-control complexList chosen",
                            "filter": {
                                "create": " AND A.ACTIVO = 'S'",
                                "edit": " AND A.ACTIVO = 'S'",
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
                            return DG_DET_GRUPOS_OUTPUT_RUB.crudButtons(true,true,true);
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
            DG_DET_GRUPOS_OUTPUT_RUB = new QuadTable();
            DG_DET_GRUPOS_OUTPUT_RUB.initTable($.extend({}, datatable_instance_defaults, optionDG_DET_GRUPOS_OUTPUT_RUB));   
            //Outputs : Rubricas

            //Rúbricas Trads
            var optionsRH_DEF_RUBRICAS_TRADS = {
                "tableId": "RH_DEF_RUBRICAS_TRADS",
                "table": "RH_DEF_RUBRICAS_TRADS",
                "pk": {
                    "primary": {
                        "CD_RUBRICA": {"type": "varchar"},                      
                        "CD_LINGUA": {"type": "number"},                    
                        "DT_INI": {"type": "date"}
                    }
                },
                "dependsOn": {
                    "RH_DEF_RUBRICAS": {
                        "CD_RUBRICA": "CD_RUBRICA"
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
                        "data": 'CD_RUBRICA',
                        "name": 'CD_RUBRICA',                    
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
                        "label": "<?php echo $ui_description; ?>", //Editor
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
                            return RH_DEF_RUBRICAS_TRADS.crudButtons(true,true,true);
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
            RH_DEF_RUBRICAS_TRADS = new QuadTable();
            RH_DEF_RUBRICAS_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsRH_DEF_RUBRICAS_TRADS));             
            //END Rubricas Trads
            
            //Rubricas Incidências
            var optionsRH_DEF_INCIDENCIAS_RUBRICAS = {
                "tableId": "RH_DEF_INCIDENCIAS_RUBRICAS",
                "table": "RH_DEF_INCIDENCIAS_RUBRICAS",
                "pk": {
                    "primary": {
                        "CD_RUBRICA": {"type": "varchar"},                      
                        "GRUPO_ED": {"type": "varchar"}
                    }
                },
                "dependsOn": {
                    "RH_DEF_RUBRICAS": {
                        "CD_RUBRICA": "CD_RUBRICA"
                    }
                },
                "order_by": "GRUPO_ED",
                "recordBundle": 7, 
                "pageLenght": 7, 
                "scrollY": "237", //234
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
                        "data": 'CD_RUBRICA',
                        "name": 'CD_RUBRICA',                    
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'GRUPO_ED',
                        "name": 'GRUPO_ED',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "responsivePriority": 2, 
                        "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                        "title": "<?php echo mb_strtoupper($ui_discount_group, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_discount_group; ?>",
                        "data": 'DSP_GRUPO_ED',
                        "name": 'DSP_GRUPO_ED',
                        "type": "select",
                        "className": "visibleColumn",
                        //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                                        
                        "attr": {
                            "dependent-group": "GRUPO_ED",
                            "dependent-level": 1,
                            "data-db-name": "A.RV_LOW_VALUE",
                            "distribute-value": "GRUPO_ED",
                            "decodeFromTable": "CG_REF_CODES A",
                            "desigColumn": "A.RV_MEANING", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.                        
                            "orderBy": "A.RV_LOW_VALUE", //usado no complexList.php
                            "class": "form-control complexList chosen",
                            //"disabled": true, //Permite inibir o campo no Editor
                            "whereClause": " AND A.RV_DOMAIN = 'RH_GRP_ENT_DESCT'"
                        } 
                    }, {
                        "responsivePriority": 3, 
                        "title": "<?php echo mb_strtoupper($ui_deduction_type, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_deduction_type; ?>", //Editor
                        "data": 'TP_INCIDENCIA',
                        "name": 'TP_INCIDENCIA',   
                        "type": "select",
                        "className": "visibleColumn",
                        "attr": {
                            "domain-list": true,
                            "dependent-group": 'RH_DEF_INCIDENCIAS_RUBRICAS.TP_INCIDENCIA',
                            "class": "form-control"
                        },
                        "render": function (val, type, row) {
                            if (val != null) {
                                var o = _.find(initApp.joinsData['RH_DEF_INCIDENCIAS_RUBRICAS.TP_INCIDENCIA'], {'RV_LOW_VALUE': val});
                                return val == null ? null : o['RV_MEANING'];
                            }
                            return val;
                        }       
                    }, {
                        "responsivePriority": 4, 
                        "title": "<?php echo mb_strtoupper($ui_scope, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_scope; ?>", //Editor
                        "data": 'AMBITO_INCIDENCIA',
                        "name": 'AMBITO_INCIDENCIA',  
                        "type": "select",
                        "className": "visibleColumn",
                        "attr": {
                            "domain-list": true,
                            "dependent-group": 'RH_AMBITO_INCIDENCIA',
                            "class": "form-control complexList chosen",
                        } 
                    }, {
                        "responsivePriority": 5, 
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
                        }
                    }, {
                        "title": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_cirs, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                        "label": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_cirs, 'UTF-8'); ?>" + "</span>", //Editor
                        "data": '',
                        "name": 'TIT_PER_AVALIACAO',
                        "type": "readonly",
                        "className": "none",
                        "defaultContent": "", //Must be used on STATIC columns content. On this case classes make there way...
                        "attr": {
                            "style": "display: none;"
                        }                      
                    }, {
                        "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_exclude, 'UTF-8'); ?>" + "</span>", //Datatables
                        "label": "<span class='quadSubTitle'>" + "<?php echo $ui_exclude; ?>" + "</span>", //Editor
                        "data": 'IRS_N_INCID_TX',
                        "name": 'IRS_N_INCID_TX',  
                        "type": "select",
                        "def": "N",
                        "className": "none visibleColumn",
                        "attr": {
                            "domain-list": true,
                            "dependent-group": 'DG_SIM_NAO',
                            "class": "form-control"
                        }    
                    }, {
                        "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_irs_prev_year, 'UTF-8'); ?>" + "</span>", //Datatables
                        "label": "<span class='quadSubTitle'>" + "<?php echo $ui_irs_prev_year; ?>" + "</span>", //Editor
                        "data": 'IRS_ANO_ANT',
                        "name": 'IRS_ANO_ANT',      
                        "type": "select",
                        "className": "none visibleColumn",
                        "attr": {
                            "domain-list": true,
                            "dependent-group": 'RH_DEF_INCIDENCIAS_RUBRICAS.IRS_ANO_ANT',
                            "class": "form-control"
                        }  
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_formula, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_formula; ?>", //Editor
                        "data": 'USER_IN',
                        "name": 'USER_IN',
                        "type": 'textarea', //Editor
                        "className": "none visibleColumn",
                        "attr": {
                            "style": "max-width: 335px;",
                            "autocomplete": "nope",
                            "autocorrect":"off",
                            "autocapitalize": "off",
                            "spellcheck": "false"
                        }
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_cells_to_update, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_cells_to_update; ?>", //Editor
                        "data": 'USER_OUT',
                        "name": 'USER_OUT',
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
                            return RH_DEF_INCIDENCIAS_RUBRICAS.crudButtons(true,true,true);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "DSP_GRUPO_ED": {
                            required: true,
                        },
                        "TP_INCIDENCIA": {
                            required: true
                        },
                        "AMBITO_INCIDENCIA": {
                            required: true
                        },
                        "USER_IN": {
                            maxlength: 4000,
                        },
                        "USER_OUT": {
                             maxlength: 4000,
                        },
                        "ACTIVO": {
                            required: true
                        }
                    }
                }
            };
            RH_DEF_INCIDENCIAS_RUBRICAS = new QuadTable();
            RH_DEF_INCIDENCIAS_RUBRICAS.initTable($.extend({}, datatable_instance_defaults, optionsRH_DEF_INCIDENCIAS_RUBRICAS));
            //END Rubricas Incidências

            //Rubricas Associações
            var optionsRH_DEF_ASSOCIACAO_RUBRICAS = {
                "tableId": "RH_DEF_ASSOCIACAO_RUBRICAS",
                "table": "RH_DEF_ASSOCIACAO_RUBRICAS",
                "pk": {
                    "primary": {
                        "CD_RUBRICA": {"type": "varchar"},                      
                        "SEQ_": {"type": "number"}
                    }
                },
                "dependsOn": {
                    "RH_DEF_RUBRICAS": {
                        "CD_RUBRICA": "CD_RUBRICA"
                    }
                },
                "order_by": "SEQ_",
                "recordBundle": 7, 
                "pageLenght": 7, 
                "scrollY": "237", //234
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
                        "data": 'CD_RUBRICA',
                        "name": 'CD_RUBRICA',                    
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "responsivePriority": 2,
                        "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_code; ?>", //Editor
                        "data": 'SEQ_',
                        "name": 'SEQ_',
                        "className": "visibleColumn right",
                        "attr": {
                            "class": "form-control toRight",
                            "style": "width: 30%;"
                        }
                    }, {
                        "responsivePriority": 2, 
                        "title": "<?php echo mb_strtoupper($ui_type, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_type; ?>", //Editor
                        "data": 'TP_ASSOCIACAO',
                        "name": 'TP_ASSOCIACAO',   
                        "type": "select",
                        "className": "visibleColumn",
                        "attr": {
                            "domain-list": true,
                            "dependent-group": 'RH_DEF_ASSOCIACAO_RUBRICAS.TP_ASSOCIACAO',
                            "class": "form-control"
                        },
                        "render": function (val, type, row) {
                            if (val != null) {
                                var o = _.find(initApp.joinsData['RH_DEF_ASSOCIACAO_RUBRICAS.TP_ASSOCIACAO'], {'RV_LOW_VALUE': val});
                                return val == null ? null : o['RV_MEANING'];
                            }
                            return val;
                        }   
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'CD_RUBRICA_ACCAO',
                        "name": 'CD_RUBRICA_ACCAO',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "responsivePriority": 3, 
                        "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                        "title": "<?php echo mb_strtoupper($ui_payroll_item, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_payroll_item; ?>",
                        "data": 'DSP_RUBRICA',
                        "name": 'DSP_RUBRICA',
                        "type": "select",
                        "className": "visibleColumn",
                        //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                                        
                        "attr": {
                            "dependent-group": "RUBRICAS",
                            "dependent-level": 1,
                            //"deferred": true,
                            "data-db-name": "A.CD_RUBRICA",
                            "distribute-value": "CD_RUBRICA_ACCAO",
                            "decodeFromTable": "RH_DEF_RUBRICAS A",
                            "desigColumn": "CONCAT(CONCAT(A.CD_RUBRICA,'-'),A.DSP_RUBRICA)", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.                        
                            "orderBy": "A.CD_RUBRICA", //usado no complexList.php
                            "class": "form-control complexList chosen",
                            //"disabled": true, //Permite inibir o campo no Editor
                            "whereClause": "",
                            "filter": {
                                "create": " AND A.ACTIVO = 'S'", //On-New-Record
                                "edit": " AND A.ACTIVO = 'S'", //On-Edit-Record
                                /* A versão tem de ser como está, por causa do agrupamento de Impressões, 
                                 * onde a própria rubrica tem de ser incluída no lote de outras eventuais rubricas!!
                                "create": " AND CD_RUBRICA != ':CD_RUBRICA' AND ACTIVO = 'S'", //On-New-Record
                                "edit": " AND CD_RUBRICA != ':CD_RUBRICA' AND ACTIVO = 'S'", //On-Edit-Record
                                */
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
                            return RH_DEF_ASSOCIACAO_RUBRICAS.crudButtons(true,true,true);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "SEQ_": {
                            integer: true,
                            required: true,
                            maxlength: 11
                        },
                        "DSP_RUBRICA": {
                            required: true,
                        },
                        "TP_ASSOCIACAO": {
                            required: true
                        }
                    }
                }
            };
            RH_DEF_ASSOCIACAO_RUBRICAS = new QuadTable();
            RH_DEF_ASSOCIACAO_RUBRICAS.initTable($.extend({}, datatable_instance_defaults, optionsRH_DEF_ASSOCIACAO_RUBRICAS));
            //END Rubricas Associações

            //Contextos Rubricas
            var optionsContextos_Rubricas = {
                "tableId": 'Contextos_Rubricas',
                "table": "CG_REF_CODES",
                "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_context; ?>",            
                "pk": {
                    "primary": {
                        "RV_DOMAIN": {"type": "varchar"},
                        "RV_LOW_VALUE": {"type": "varchar"}
                    }
                },
                "detailsObjects": ['Contextos_RubricasTrads'],
                "initialWhereClause": "RV_DOMAIN = 'RH_DEF_RUBRICAS.CONTEXTO' ",
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
                        "def": "RH_DEF_RUBRICAS.CONTEXTO",
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
                            return Contextos_Rubricas.crudButtons(false, true, false);
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
            Contextos_Rubricas = new QuadTable();
            Contextos_Rubricas.initTable($.extend({}, datatable_instance_defaults, optionsContextos_Rubricas));
            //Contextos Rubricas

            //Contextos Rubricas Trads
            var optionsContextos_RubricasTrads = {
                "tableId": 'Contextos_RubricasTrads',
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
                    Contextos_Rubricas: {
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
                            return Contextos_RubricasTrads.crudButtons(true, true, true);
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
            Contextos_RubricasTrads = new QuadTable();
            Contextos_RubricasTrads.initTable($.extend({}, datatable_instance_defaults, optionsContextos_RubricasTrads));
            // End Contextos Rubricas Trads
            
            //Células
            var optionRH_DEF_CELULAS = {
                "tableId": "RH_DEF_CELULAS",
                "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_cell; ?>",
                "table": "RH_DEF_CELULAS",
                "pk": {
                    "primary": {
                        "CELL": {"type": "varchar"}
                    }
                },
    //            "crudOnMasterInactive": {
    //                "condition": "data.DT_FIM !== null",
    //                "acl": {
    //                    "create": false,
    //                    "update": false,
    //                    "delete": false
    //                }
    //            },
                "detailsObjects": ['RH_DEF_CELULAS_MES'],
                "order_by": "TP_CELL, TO_NUMBER(LOCAL)",
                "scrollY": "117", //117 -> 4 records; 156 -> 5 records
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
                        "data": 'CELL',
                        "name": 'CELL',
                        "className": "visibleColumn",
                        "attr": {
                            "style": "width:30%;"
                        }
                    }, {
                        "responsivePriority": 3,
                        "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_description; ?>", //Editor
                        "data": 'DSP_CELL',
                        "name": 'DSP_CELL',
                        "className": "visibleColumn"
                    }, {
                        "responsivePriority": 4,
                        "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_short_desig; ?>", //Editor
                        "data": 'DSR_CELL',
                        "name": 'DSR_CELL',
                        "className": "visibleColumn"
                    }, {
                        "responsivePriority": 5,
                        "title": "<?php echo mb_strtoupper($ui_type, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_type; ?>", //Editor
                        "data": 'TP_CELL',
                        "name": 'TP_CELL',
                        "type": "select",
                        "className": "visibleColumn",
                        "attr": {
                            "domain-list": true,
                            "dependent-group": 'RH_DEF_CELULAS.TP_CELL',
                            "class": "form-control"
                        },
                        "render": function (val, type, row) {
                            if (val != null) {
                                var o = _.find(initApp.joinsData['RH_DEF_CELULAS.TP_CELL'], {'RV_LOW_VALUE': val});
                                return val == null ? null : o['RV_MEANING'];
                            }
                            return val;
                        }
                    }, {
                        "responsivePriority": 6,
                        "title": "<?php echo mb_strtoupper($ui_index, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_index; ?>", //Editor
                        "data": 'LOCAL',
                        "name": 'LOCAL',
                        "className": "visibleColumn right",                    
                        "attr": {
                            "disabled": true, //DOES'T WORK ?!!!
                            "class": "form-control toRight",
                            "style": "width: 30%;",
                            "autocomplete": "nope"
                        }
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_formula, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_formula; ?>", //Editor
                        "data": 'EXECUCAO',
                        "name": 'EXECUCAO',
                        "type": 'textarea', //Editor
                        "className": "none visibleColumn",
                        "attr": {
                            "style": "max-width: 335px;",
                            "class": "form-control defaultWidth"
                        }
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_obs_short, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_obs_short; ?>", //Editor
                        "data": 'OBS',
                        "name": 'OBS',
                        "type": 'textarea', //Editor
                        "className": "none visibleColumn",
                        "attr": {
                            "style": "max-width: 335px;",
                            "class": "form-control defaultWidth"
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
                            return RH_DEF_CELULAS.crudButtons(true, true, true);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "CELL": {
                            required: true,
                            maxlength: 4
                        },
                        "DSP_CELL": {
                            required: true,
                            maxlength: 40
                        },
                        "DSR_CELL": {
                            maxlength: 25
                        },                    
                        "TP_CELL": {
                            required: true
                        },
                        "lOCAL": {
                            required: true,
                            integer: true
                        },
                        "EXECUCAO": {
                            required: false,
                            maxlength: 4000
                        },
                        "OBS": {
                            required: false,
                            maxlength: 1000
                        }
                    }
                }
            };
            RH_DEF_CELULAS = new QuadTable();
            RH_DEF_CELULAS.initTable($.extend({}, datatable_instance_defaults, optionRH_DEF_CELULAS));
            //END Células        

            //Células por MESES
            var optionRH_DEF_CELULAS_MES = {
                "tableId": "RH_DEF_CELULAS_MES",
                "table": "RH_DEF_CELULAS_MES",
                "pk": {
                    "primary": {
                        "CELL": {"type": "varchar"},
                        "MES": {"type": "number"}
                    }
                },
                "dependsOn": {
                    "RH_DEF_CELULAS": {
                        "CELL": "CELL"
                    }
                },
                "order_by": "MES",
                "scrollY": "546",
                "recordBundle": 15,
                "pageLenght": 15,
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
                        "data": 'CELL',
                        "name": 'CELL',                    
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "responsivePriority": 2,
                        "title": "<?php echo mb_strtoupper($ui_month, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_month; ?>", //Editor
                        "data": 'MES',
                        "name": 'MES',
                        "type": "select",
                        "className": "visibleColumn",
                        "attr": {
                            "domain-list": true,
                            "dependent-group": 'RH_MESES_PAGAVEIS',
                            "class": "form-control"
                        },
                        "render": function (val, type, row) {
                            if (val != null) {
                                var o = _.find(initApp.joinsData['RH_MESES_PAGAVEIS'], {'RV_LOW_VALUE': val});
                                return val == null ? null : o['RV_MEANING'];
                            }
                            return val;
                        }                        
                    }, {
                        "responsivePriority": 3,
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
                        "responsivePriority": 1,
                        "data": null,
                        "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                        "name": 'BUTTONS',
                        "type": "hidden",
                        "width": "6%",
                        "className": "toBottom toCenter",
                        "render": function () {
                            //debugger;
                            return RH_DEF_CELULAS_MES.crudButtons(true, true, true);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "MES": {
                            required: true,
                            maxlength: 2
                        },
                        "ACTIVO": {
                            required: true
                        }
                    }
                }
            };
            RH_DEF_CELULAS_MES = new QuadTable();
            RH_DEF_CELULAS_MES.initTable($.extend({}, datatable_instance_defaults, optionRH_DEF_CELULAS_MES));
            //END Células por MESES        
                        
            //Events
            if (1 === 1) {
                $(document).on('RH_DEF_INCIDENCIAS_RUBRICASAttachEvt', function (e) {
                    var frm_context = "#RH_DEF_INCIDENCIAS_RUBRICAS_editorForm", operacao = RH_DEF_INCIDENCIAS_RUBRICAS.editor.s["action"]; //PREVIOUS VERSION -> RH_PROCESSOS_AVALIACAO.editor.s.editOpts["action"];
//                      operacao ==> 'query', 'create', 'edit'

                    $('#DTE_Field_DSP_GRUPO_ED', frm_context).on("change", function (e) {
                        if ($(this).val() === 'IRS') {
                            $('#DTE_Field_IRS_N_INCID_TX', frm_context).prop('disabled', false);
                            $('#DTE_Field_IRS_N_INCID_TX', frm_context).val('S');
                            $('#DTE_Field_IRS_ANO_ANT', frm_context).prop('disabled', false);
                            $('#DTE_Field_IRS_ANO_ANT', frm_context).val('A');
                        } else {
                            $('#DTE_Field_IRS_N_INCID_TX', frm_context).prop('disabled', true);
                            $('#DTE_Field_IRS_N_INCID_TX', frm_context).val('N');
                            $('#DTE_Field_IRS_ANO_ANT', frm_context).prop('disabled', true);
                            $('#DTE_Field_IRS_ANO_ANT', frm_context).val('A');                            
                        }
                    });

                    $('#DTE_Field_TP_INCIDENCIA', frm_context).on("change", function (e) {
                        if ($(this).val() === 'F') { //Formula
                            $('#DTE_Field_USER_IN', frm_context).prop('disabled', false);
                            $('#DTE_Field_USER_IN', frm_context).val('');
                            $('#DTE_Field_USER_OUT', frm_context).prop('disabled', false);
                            $('#DTE_Field_USER_OUT', frm_context).val('');    
                            //Add validation RULE programmatically :: Auto Validation
                            $('#DTE_Field_USER_IN').rules('add', {'required': true});
                            //Add CLASS required to LABEL
                            $('#RH_DEF_INCIDENCIAS_RUBRICAS_editorForm > div > div.DTE_Field.row.DTE_Field_Type_textarea.DTE_Field_Name_USER_IN.none.visibleColumn > label').addClass('required');
                        } else { //Valor
                            $('#DTE_Field_USER_IN', frm_context).prop('disabled', true);
                            $('#DTE_Field_USER_IN', frm_context).val('');
                            $('#DTE_Field_USER_OUT', frm_context).prop('disabled', true);
                            $('#DTE_Field_USER_OUT', frm_context).val('');
                            ///Remove validation RULE
                            $('#DTE_Field_USER_IN').rules('remove', 'required');
                            //Remove CLASS required to LABEL
                            $('#RH_DEF_INCIDENCIAS_RUBRICAS_editorForm > div > div.DTE_Field.row.DTE_Field_Type_textarea.DTE_Field_Name_USER_IN.none.visibleColumn > label').removeClass('required');
                        }
                    });
                    
                });
                                
                $(document).on('RH_DEF_CELULASAttachEvt', function (e) {
                    var frm_context = "#RH_DEF_CELULAS_editorForm", operacao = RH_DEF_CELULAS.editor.s["action"]; //PREVIOUS VERSION -> RH_PROCESSOS_AVALIACAO.editor.s.editOpts["action"];
//                      operacao ==> 'query', 'create', 'edit'
                    alert('Disabling LOCAL is not working....');
                    if (operacao !== 'query') {                        
                        $('#DTE_Field_LOCAL', frm_context).prop('disabled', true);
                        
                    } else {
                        $('#DTE_Field_LOCAL', frm_context).prop('disabled', false);
                    }                    
                });
                
                $(document).on('click', '#RH_DEF_CELULAS > tbody', function (ev) {
                    ev.stopImmediatePropagation();
                    
                    if (RH_DEF_CELULAS.tbl.rows( '.selected' ).any()){ //ROW on MASTER IS SELECTED
                        $('#RH_DEF_CELULAS_MES_addMonths').show('slow');
                    } else {  //DESELECT ROW EVENT
                        $('#RH_DEF_CELULAS_MES_addMonths').hide('slow'); //ROW on MASTER WAS DESELECTED :: Hide formulario SUBMIT button 
                    }            
                });     
                
                /* Local WORKER :: Add 14 months to RH_DEF_CELULAS_MES */
                $(document).on('click', '#RH_DEF_CELULAS_MES_addMonths', function (ev) {
                    var masterRecordData = RH_DEF_CELULAS.selectedRowData(), masterRowSelected = RH_DEF_CELULAS.tbl.rows('.selected'),
                        t0 = performance.now(),
                        wk = new Worker(pn + "lib/quad/workerRouter.js"),
                        message = {
                            request_id: 'AddCell14Months',
                            cell_name: masterRecordData['CELL'],
                            defaults: datatable_instance_defaults.pathToSqlFile
                        },
                        mssg = '';
                    wk.postMessage(JSON.stringify(message));
                    wk.onmessage = function (event) {                
                        if (event.data === 'working') {
                            RH_DEF_CELULAS_MES.showProcess("<?php echo $hint_create_14_cells; ?>"); //Process ID;
                            return;
                        } else {
                            t1 = performance.now();
                            tmp = millisToMinutesAndSeconds(t1 - t0);

                            if (event.data) {
                                if (event.data.msg) { 
                                    mssg = "<?php echo $msg_process_finished_ok; ?>";    
                                    if (tmp === "0:00") {
                                        tmp === "0:01";
                                    }
                                    mssg = mssg.replace(" {0}", " " + tmp + " (MM:SS)");
                                    quad_notification({
                                            type: "success",
                                            title : JS_OPERATION_COMPLETED,
                                            content : '<i class="glyphicon glyphicon-thumbs-up"></i>&nbsp;<i>' + mssg + '</i>',
                                            timeout : 5000
                                    });
                                    //Deselect current ROW (already updated on server)
                                    masterRowSelected.deselect();
                                    //Select current ROW (to refresh detail results)
                                    masterRowSelected.select();

                                } else { //if (msg.indexOf("NOK:")) {
                                    var mssg = event.data.error;
                                    quad_notification({
                                            type: "error",
                                            title : JS_OPERATION_ERROR,
                                            content : '<i class="glyphicon glyphicon-thumbs-down"></i>&nbsp;<i>' + mssg + '</i>'
                                    });
                                    $(this).prop("disabled", false);
                                }
                            }
                        }
                        RH_DEF_CELULAS_MES.hideProcess();
                    };                    
                });
            }
            //END Events

        }
        //END Módulo de Rubricas & Células
        
        //Módulo de Grelhas Salariais
        if (1 === 1) {
            //Definição 
            var optionRH_DEF_GRELHAS_SALARIAIS = {
                "tableId": "RH_DEF_GRELHAS_SALARIAIS",
                "table": "RH_DEF_GRELHAS_SALARIAIS", 
                "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_payroll_grid; ?>",
                "pk": {
                    "primary": {
                        "CD_GRELHA_SALARIAL": {"type": "number"}
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
                "detailsObjects": ['RH_DEF_LINHAS_SALARIAIS','RH_DEF_GRELHAS_SALARIAIS_TRADS','RH_DEF_AUTO_GRELHAS','RH_DEF_SITUACOES_GRELHAS','DG_DET_GRUPOS_OUTPUT_GRELHAS'],
                "order_by": "CD_GRELHA_SALARIAL",
                "scrollY": "156", //"195" "156", 
                "recordBundle": 10, //6  5
                "pageLenght": 10,  //6 5
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
                        "data": 'CD_GRELHA_SALARIAL',
                        "name": 'CD_GRELHA_SALARIAL',
                        "className": "visibleColumn",                   
                    }, {
                        "responsivePriority": 3, 
                        "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_designation; ?>", //Editor
                        "data": 'DSP_GRELHA_SALARIAL',
                        "name": 'DSP_GRELHA_SALARIAL',
                        "className": "visibleColumn",
                    }, {
                        "responsivePriority": 4, 
                        "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_short_desig; ?>", //Editor
                        "data": 'DSR_GRELHA_SALARIAL',
                        "name": 'DSR_GRELHA_SALARIAL',
                        "className": "visibleColumn",
                    }, {
                        "responsivePriority": 5, 
                        "title": "<?php echo mb_strtoupper($ui_type, 'UTF-8'); ?>", //Datatables :: Original
                        "label": "<?php echo $ui_type; ?>", //Editor
                        "data": 'TP_GRELHA_SALARIAL',
                        "name": 'TP_GRELHA_SALARIAL',
                        "type": "select",
                        "className": "visibleColumn",
                        "attr": {
                            "domain-list": true,
                            "dependent-group": 'RH_DEF_GRELHAS_SALARIAIS.TP_GRELHA_SALARIAL',
                            "class": "form-control"
                        },
                        "render": function (val, type, row) {
                            if (val != null) {
                                var o = _.find(initApp.joinsData['RH_DEF_GRELHAS_SALARIAIS.TP_GRELHA_SALARIAL'], {'RV_LOW_VALUE': val});
                                return val == null ? null : o['RV_MEANING'];
                            }
                            return val;
                        }
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'CELL',
                        "name": 'CELL',                    
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "responsivePriority": 6,
                        "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                        "title": "<?php echo mb_strtoupper($ui_cell, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_cell; ?>",
                        "data": 'DSP_CELL',
                        "name": 'DSP_CELL',
                        "type": "select",
                        "className": "visibleColumn",
                        "attr": {
                            "dependent-group": "CELULAS",
                            "dependent-level": 1,
                            "data-db-name": 'A.CELL',
                            "decodeFromTable": 'RH_DEF_CELULAS A',
                            "class": "form-control complexList chosen", //class complexList Mandatory . we have to catch events like change and chain select event
                            "desigColumn": "CONCAT(CONCAT(A.CELL,'-'),A.DSP_CELL)", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.                        
                            "orderBy": "A.LOCAL", //usado no complexList.php
                            //"disabled": true, //Permite inibir o campo no Editor,
                            //"filter": {
                                //"create": " AND ACTIVO = 'S'", //On-New-Record
                                //"edit": " AND ACTIVO = 'S'", //On-Edit-Record
                            //}
                        }       
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'CD_MOEDA',
                        "name": 'CD_MOEDA',                    
                        "type": "hidden", //Editor
                        "visible": false, //DataTables 
                    }, {
                        "responsivePriority": 7,
                        "complexList": true,
                        "title": "<?php echo mb_strtoupper($ui_currency, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_currency; ?>",
                        "data": 'DSP_MOEDA',
                        "name": 'DSP_MOEDA',
                        "type": "select",
                        "className": "visibleColumn",
                        "renew": true, 
                        "attr": {
                            "class": "form-control complexList chosen", 
                            "dependent-group": "MOEDAS",
                            "dependent-level": 1,
                            "data-db-name": "A.CD_MOEDA",
                            "decodeFromTable": "DG_MOEDAS A",
                            "desigColumn": "A.DSP_MOEDA", 
                            "orderBy": "A.CD_MOEDA",
                            "filter": {
                                "create": " AND A.ATIVO = 'S'", //On-New-Record
                                "edit": " AND A.ATIVO = 'S'", //On-Edit-Record
                            }
                        }                         
                    }, {
                        "responsivePriority": 8, 
                        "title": "<?php echo mb_strtoupper($ui_portal, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_portal; ?>", //Editor
                        "data": 'PORTAL',
                        "name": 'PORTAL',
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
                        "responsivePriority": 9, 
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
                        "responsivePriority": 10,
                        "title": "<?php echo mb_strtoupper($ui_inactive_dt, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_inactive_dt; ?>", //Editor
                        "data": 'DT_INACTIVIDADE',
                        "name": 'DT_INACTIVIDADE',
                        "datatype": 'date',
                        "className": "visibleColumn",
                        "attr": {
                            "name": 'DT_INACTIVIDADE',
                            "class": "datepicker" 
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
                        "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                        "name": 'BUTTONS',
                        "type": "hidden",
                        "width": "6%",
                        "className": "toBottom toCenter",
                        "render": function () {
                            //debugger;
                            return RH_DEF_GRELHAS_SALARIAIS.crudButtons(true,true,true);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "CD_GRELHA_SALARIAL": {
                            required: true,
                            integer: true,
                            maxlength: 4
                        },
                        "DSP_GRELHA_SALARIAL": {
                            required: true,
                            maxlength: 40,
                        },
                        "DSR_GRELHA_SALARIAL": {
                            required: false,
                            maxlength: 25,
                        },
                        "TP_GRELHA_SALARIAL": {
                            required: true
                        },
                        "PORTAL": {
                            required: true
                        },
                        "ACTIVO": {
                            required: true
                        },
                        "DESCRICAO": {
                            required: false,
                            maxlength: 4000,
                        },
                    }
                }
            };
            RH_DEF_GRELHAS_SALARIAIS = new QuadTable();
            RH_DEF_GRELHAS_SALARIAIS.initTable( $.extend({}, datatable_instance_defaults, optionRH_DEF_GRELHAS_SALARIAIS) );
            //END Definição 
        
            //Linhas de Grelhas
            var optionsRH_DEF_LINHAS_SALARIAIS = {
                "tableId": "RH_DEF_LINHAS_SALARIAIS",
                "table": "RH_DEF_LINHAS_SALARIAIS",
                "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_line; ?>",
                "pk": {
                    "primary": {
                        "CD_GRELHA_SALARIAL": {"type": "number"},                      
                        "CD_LINHA_SALARIAL": {"type": "number"}
                    }
                },
                "dependsOn": {
                    "RH_DEF_GRELHAS_SALARIAIS": {
                        "CD_GRELHA_SALARIAL": "CD_GRELHA_SALARIAL"
                    }
                },
                "detailsObjects": ['RH_DEF_VALORES_SALARIAIS'],
                "order_by": "CD_LINHA_SALARIAL",
                "recordBundle": 7, 
                "pageLenght": 7, 
                "scrollY": "237", //234
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
                        "data": 'CD_GRELHA_SALARIAL',
                        "name": 'CD_GRELHA_SALARIAL',                    
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "responsivePriority": 2, 
                        "title": "<?php echo mb_strtoupper($ui_index, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_index; ?>",
                        "data": 'CD_LINHA_SALARIAL',
                        "name": 'CD_LINHA_SALARIAL',
                        "className": "visibleColumn right",
                        "attr": {
                            "class": "form-control toRight",
                            "style": "width: 30%;"
                        }
                    }, {
                        "responsivePriority": 3, 
                        "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_designation; ?>", //Editor
                        "data": 'DSP_LINHA_SALARIAL',
                        "name": 'DSP_LINHA_SALARIAL',
                        "className": "visibleColumn",
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
                            return RH_DEF_LINHAS_SALARIAIS.crudButtons(true,true,true);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "CD_LINHA_SALARIAL": {
                            required: true,
                            number: true
                        },
                        "DSP_LINHA_SALARIAL": {
                            required: true,
                            maxlength: 500
                        }
                    }
                }
            };
            RH_DEF_LINHAS_SALARIAIS = new QuadTable();
            RH_DEF_LINHAS_SALARIAIS.initTable($.extend({}, datatable_instance_defaults, optionsRH_DEF_LINHAS_SALARIAIS));
            //END Linhas de Grelhas
            
            //Valores de Grelhas
            var optionsRH_DEF_VALORES_SALARIAIS = {
                "tableId": "RH_DEF_VALORES_SALARIAIS",
                "table": "RH_DEF_VALORES_SALARIAIS",
                "pk": {
                    "primary": {
                        "CD_GRELHA_SALARIAL": {"type": "number"},                      
                        "CD_LINHA_SALARIAL": {"type": "number"},
                        "DT_VALOR": {"type": "date"}
                    }
                },
                "dependsOn": {
                    "RH_DEF_LINHAS_SALARIAIS": {
                        "CD_GRELHA_SALARIAL": "CD_GRELHA_SALARIAL",
                        "CD_LINHA_SALARIAL": "CD_LINHA_SALARIAL"
                    }
                },
                "order_by": "CD_LINHA_SALARIAL",
                "recordBundle": 7, 
                "pageLenght": 7, 
                "scrollY": "237", //234
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
                        "data": 'CD_GRELHA_SALARIAL',
                        "name": 'CD_GRELHA_SALARIAL',                    
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'CD_LINHA_SALARIAL',
                        "name": 'CD_LINHA_SALARIAL',                    
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "responsivePriority": 2, 
                        "title": "<?php echo mb_strtoupper($ui_value_dt, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_value_dt; ?>", //Editor
                        "data": 'DT_VALOR',
                        "name": 'DT_VALOR',
                        "datatype": 'dateYearMonth',
                        "className": "visibleColumn",
                        "attr": {
                            "class": "form-control dateYearMonth",
                            "autocomplete": "nope"
                        },
//                        "render": function (val, type, row) {
//                            if (val !== '') {
//                                return val.substr(0,7);
//                            } else {
//                                return '';
//                            } 
//                        } 
                    }, {
                        "responsivePriority": 3, 
                        "title": "<?php echo mb_strtoupper($ui_value, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_value; ?>", //Editor
                        "data": 'VALOR',
                        "name": 'VALOR',                    
                        "className": "visibleColumn right",
                        "attr": {
                            "class": "form-control toRight",
                            "style": "width: 30%;",
                        }
                    }, {
                        "responsivePriority": 2, 
                        "title": "<?php echo mb_strtoupper($ui_inactive_dt, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_inactive_dt; ?>", //Editor
                        "data": 'DT_INACTIVO',
                        "name": 'DT_INACTIVO',
                        "datatype": 'dateYearMonth',
                        "className": "visibleColumn",
                        "attr": {
                            "class": "form-control dateYearMonth",
                            "autocomplete": "nope"
                        },
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
                            return RH_DEF_VALORES_SALARIAIS.crudButtons(true,true,true);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "CD_LINHA_SALARIAL": {
                            required: true,
                            number: true
                        },
                        "VALOR": {
                            required: true,
                            number: true
                        },
                        "DT_VALOR": {
                            required: true,
                            dateYearMonth: true,
                        },
                        "DT_INACTIVO": {
                            dateYearMonth: true,
                            dateEqOrNextThan: 'DT_VALOR'
                        }
                    }
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                    "DT_VALOR": {
                        dateYearMonth: "<?php echo $msg_invalid_year_month; ?>"
                    }, 
                    "DT_INACTIVO": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            };
            RH_DEF_VALORES_SALARIAIS = new QuadTable();
            RH_DEF_VALORES_SALARIAIS.initTable($.extend({}, datatable_instance_defaults, optionsRH_DEF_VALORES_SALARIAIS));
            //END Valores de Grelhas            
            
            //Outputs : Grelhas
            var optionDG_DET_GRUPOS_OUTPUT_GRELHAS = {
                "tableId": "DG_DET_GRUPOS_OUTPUT_GRELHAS",
                "table": "DG_DET_GRUPOS_OUTPUT",
                "pk": {
                    "primary": {
                        "CD_OUTPUT": {"type": "varchar"},
                        "CD_GRUPO": {"type": "varchar"},
                        "SEQ": {"type": "number"},
                        "CD_GRELHA_SALARIAL": {"type": "varchar"}
                    }
                },
                "dependsOn": {
                    "RH_DEF_GRELHAS_SALARIAIS": {
                        "CD_GRELHA_SALARIAL": "CD_GRELHA_SALARIAL"
                    }
                },
                "initialWhereClause": '',             
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
                        "data": 'CD_GRELHA_SALARIAL',
                        "name": 'CD_GRELHA_SALARIAL',
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
                        "data": 'CD_SITUACAO',
                        "name": 'CD_SITUACAO',
                        "type": "hidden",
                        "visible": false,
                        "className": "",
                    }, {
                        "responsivePriority": 6,
                        "complexList": true,
                        "title": "<?php echo mb_strtoupper($ui_situation,'UTF-8'); ?>",
                        "label": "<?php echo $ui_situation; ?>",
                        "data": 'DSP_SITUACAO',
                        "name": 'DSP_SITUACAO',
                        "type": "select",
                        "className": "visibleColumn",
                        //"renew": true,
                        "attr": {
                            "dependent-group": "SITUACOES",
                            "dependent-level": 1,
                            "data-db-name": "A.CD_SITUACAO",
                            "decodeFromTable": "RH_DEF_SITUACOES A",
                            "desigColumn": "CONCAT(CONCAT(A.CD_SITUACAO,'-'),A.DSP_SITUACAO)",
                            "orderBy": "A.CD_SITUACAO",
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
                            return DG_DET_GRUPOS_OUTPUT_GRELHAS.crudButtons(true,true,true);
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
            DG_DET_GRUPOS_OUTPUT_GRELHAS = new QuadTable();
            DG_DET_GRUPOS_OUTPUT_GRELHAS.initTable($.extend({}, datatable_instance_defaults, optionDG_DET_GRUPOS_OUTPUT_GRELHAS));   
            //Outputs : Grelhas            
            
            //Grelhas Trads
            var optionsRH_DEF_GRELHAS_SALARIAIS_TRADS = {
                "tableId": "RH_DEF_GRELHAS_SALARIAIS_TRADS",
                "table": "RH_DEF_GRELHAS_SALARIAIS_TRADS",
                "pk": {
                    "primary": {
                        "CD_GRELHA_SALARIAL": {"type": "number"},                      
                        "CD_LINGUA": {"type": "number"},                    
                        "DT_INI": {"type": "date"}
                    }
                },
                "dependsOn": {
                    "RH_DEF_GRELHAS_SALARIAIS": {
                        "CD_GRELHA_SALARIAL": "CD_GRELHA_SALARIAL"
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
                        "data": 'CD_GRELHA_SALARIAL',
                        "name": 'CD_GRELHA_SALARIAL',                    
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
                        "label": "<?php echo $ui_description; ?>", //Editor
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
                            return RH_DEF_GRELHAS_SALARIAIS_TRADS.crudButtons(true,true,true);
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
            RH_DEF_GRELHAS_SALARIAIS_TRADS = new QuadTable();
            RH_DEF_GRELHAS_SALARIAIS_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsRH_DEF_GRELHAS_SALARIAIS_TRADS));             
            //END Grelhas Trads

            //Composição de Grelhas
            var optionsRH_DEF_AUTO_GRELHAS = {
                "tableId": "RH_DEF_AUTO_GRELHAS",
                "table": "RH_DEF_AUTO_GRELHAS",
                "pk": {
                    "primary": {
                        "CD_GRELHA_SALARIAL": {"type": "number"},
                        "TABELA": {"type": "varchar"},
                        "COLUNA": {"type": "varchar"}
                    }
                },
                "dependsOn": {
                    "RH_DEF_GRELHAS_SALARIAIS": {
                        "CD_GRELHA_SALARIAL": "CD_GRELHA_SALARIAL"
                    }
                },
                "order_by": "POSICAO",
                "recordBundle": 7, 
                "pageLenght": 7, 
                "scrollY": "237", //234
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
                        "data": 'CD_GRELHA_SALARIAL',
                        "name": 'CD_GRELHA_SALARIAL',                    
                        "type": "hidden", //Editor
                        "visible": false, //DataTables                        
                    }, {
                        "responsivePriority": 2, 
                        "title": "<?php echo mb_strtoupper($ui_mapped_table, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_mapped_table; ?>",
                        "data": 'TABELA',
                        "name": 'TABELA',
                        "className": "visibleColumn"
                    }, {
                        "responsivePriority": 3, 
                        "title": "<?php echo mb_strtoupper($ui_mapped_column, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_mapped_column; ?>", //Editor
                        "data": 'COLUNA',
                        "name": 'COLUNA',
                        "className": "visibleColumn",
                    }, {
                        "responsivePriority": 3, 
                        "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_designation; ?>", //Editor
                        "data": 'DSP_ORIG',
                        "name": 'DSP_ORIG',
                        "className": "visibleColumn",    
                    }, {
                        "responsivePriority": 3, 
                        "title": "<?php echo mb_strtoupper($ui_controlled_table, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_controlled_table; ?>", //Editor
                        "data": 'TAB_DESTINO',
                        "name": 'TAB_DESTINO',
                        "className": "visibleColumn",
                    }, {
                        "responsivePriority": 3, 
                        "title": "<?php echo mb_strtoupper($ui_controlled_column, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_controlled_column; ?>", //Editor
                        "data": 'COL_DESTINO',
                        "name": 'COL_DESTINO',
                        "className": "visibleColumn",
                    }, {
                        "responsivePriority": 3, 
                        "title": "<?php echo mb_strtoupper($ui_order_nr, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_order_nr; ?>", //Editor
                        "data": 'POSICAO',
                        "name": 'POSICAO',
                        "className": "visibleColumn",                    
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_table, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_table; ?>", //Editor
                        "data": 'NOME_TABELA',
                        "name": 'NOME_TABELA',
                        "className": "none visibleColumn",
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_trigger, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_trigger; ?>", //Editor
                        "data": 'NOME_TRG',
                        "name": 'NOME_TRG',
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
                        "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                        "name": 'BUTTONS',
                        "type": "hidden",
                        "width": "6%",
                        "className": "toBottom toCenter",
                        "render": function () {
                            //debugger;
                            return RH_DEF_AUTO_GRELHAS.crudButtons(false,false,false);
                        }
                    }
                ]
            };
            RH_DEF_AUTO_GRELHAS = new QuadTable();
            RH_DEF_AUTO_GRELHAS.initTable($.extend({}, datatable_instance_defaults, optionsRH_DEF_AUTO_GRELHAS));
            //END Composição de Grelhas
            
            //Situações com Grelhas
            var optionsRH_DEF_SITUACOES_GRELHAS = {
                "tableId": "RH_DEF_SITUACOES_GRELHAS",
                "table": "RH_DEF_SITUACOES_GRELHAS",
                "pk": {
                    "primary": {
                        "CD_GRELHA_SALARIAL": {"type": "number"},                      
                        "CD_SITUACAO": {"type": "number"}
                    }
                },
                "dependsOn": {
                    "RH_DEF_GRELHAS_SALARIAIS": {
                        "CD_GRELHA_SALARIAL": "CD_GRELHA_SALARIAL"
                    }
                },
                "order_by": "CD_SITUACAO",
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
                        "data": 'CD_GRELHA_SALARIAL',
                        "name": 'CD_GRELHA_SALARIAL',                    
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'CD_SITUACAO',
                        "name": 'CD_SITUACAO',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "responsivePriority": 2,
                        "complexList": true,
                        "title": "<?php echo mb_strtoupper($ui_situation, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_situation; ?>",
                        "data": 'DSP_SITUACAO',
                        "name": 'DSP_SITUACAO',
                        "type": "select",
                        "className": "visibleColumn",
                        "attr": {
                            "dependent-group": "RHID_SITUACOES",
                            "dependent-level": 1,
                            "data-db-name": 'A.CD_SITUACAO',
                            "decodeFromTable": 'RH_DEF_SITUACOES A',
                            "class": "form-control complexList chosen", 
                            "desigColumn": "CONCAT(CONCAT(A.CD_SITUACAO,'-'),A.DSP_SITUACAO)", 
                            "orderBy": "A.CD_SITUACAO",
                            "filter": {
                                "create": " AND A.ACTIVO = 'S'", //On-New-Record
                                "edit": " AND A.ACTIVO = 'S'", //On-Edit-Record
                            }
                        }
                    }, {
                        "responsivePriority": 3, 
                        "title": "<?php echo mb_strtoupper($ui_after_assigning, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_after_assigning; ?>", //Editor
                        "data": 'POST_INSERT',
                        "name": 'POST_INSERT',
                        "type": "select",
                        "className": "visibleColumn",
                        "attr": {
                            "domain-list": true,
                            "dependent-group": 'RH_DEF_SITUACOES_GRELHAS.POST_INSERT',
                            "class": "form-control"
                        },
                        "render": function (val, type, row) {
                            if (val != null) {
                                var o = _.find(initApp.joinsData['RH_DEF_SITUACOES_GRELHAS.POST_INSERT'], {'RV_LOW_VALUE': val});
                                return val == null ? null : o['RV_MEANING'];
                            }
                            return val;
                        }                        
                    }, {
                        "responsivePriority": 4, 
                        "title": "<?php echo mb_strtoupper($ui_after_updating, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_after_updating; ?>", //Editor
                        "data": 'PRE_UPDATE',
                        "name": 'PRE_UPDATE',
                        "type": "select",
                        "className": "visibleColumn",
                        "attr": {
                            "domain-list": true,
                            "dependent-group": 'RH_DEF_SITUACOES_GRELHAS.POST_INSERT',
                            "class": "form-control"
                        },
                        "render": function (val, type, row) {
                            if (val != null) {
                                var o = _.find(initApp.joinsData['RH_DEF_SITUACOES_GRELHAS.POST_INSERT'], {'RV_LOW_VALUE': val});
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
                            return RH_DEF_SITUACOES_GRELHAS.crudButtons(true,true,true);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "DSP_SITUACAO": {
                            required: true,
                        },
                        "POST_INSERT": {
                            required: true
                        },
                        "PRE_UPDATE": {
                            required: true
                        }
                    },
                }
            };
            RH_DEF_SITUACOES_GRELHAS = new QuadTable();
            RH_DEF_SITUACOES_GRELHAS.initTable($.extend({}, datatable_instance_defaults, optionsRH_DEF_SITUACOES_GRELHAS));             
            //END Situações com Grelhas
        }
        //END Módulo de Grelhas Salariais
        
        //Módulo de Promoções
        if (1 === 1) {
            //Regras de Promoções 
            var optionRH_DEF_REGRAS_ATRIBUICAO = {
                "tableId": "RH_DEF_REGRAS_ATRIBUICAO",
                "table": "RH_DEF_REGRAS_ATRIBUICAO", 
                "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_rule; ?>",
                "pk": {
                    "primary": {
                        "CD_REGRA": {"type": "number"}
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
                "detailsObjects": ['RH_DEF_PREMIOS_ANTIGUIDADE','RH_DEF_DIUTURNIDADES_A','RH_DEF_DIUTURNIDADES_B'],
                "order_by": "CD_REGRA",
                "scrollY": "156", //"195" "156", 
                "recordBundle": 5, //6  5
                "pageLenght": 5,  //6 5
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
                        "data": 'CD_REGRA',
                        "name": 'CD_REGRA',
                        "className": "visibleColumn",                   
                    }, {
                        "responsivePriority": 3, 
                        "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_designation; ?>", //Editor
                        "data": 'DSP_REGRA',
                        "name": 'DSP_REGRA',
                        "className": "visibleColumn",
                    }, {
                        "responsivePriority": 4, 
                        "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_short_desig; ?>", //Editor
                        "data": 'DSR_REGRA',
                        "name": 'DSR_REGRA',
                        "className": "visibleColumn",                    
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
                            return RH_DEF_REGRAS_ATRIBUICAO.crudButtons(true,true,true);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "CD_REGRA": {
                            required: true,
                            integer: true,
                            maxlength: 6
                        },
                        "DSP_REGRA": {
                            required: true,
                            maxlength: 40,
                        },
                        "DSR_REGRA": {
                            required: false,
                            maxlength: 25,
                        },
                        "ACTIVO": {
                            required: true
                        }
                    }
                }
            };
            RH_DEF_REGRAS_ATRIBUICAO = new QuadTable();
            RH_DEF_REGRAS_ATRIBUICAO.initTable( $.extend({}, datatable_instance_defaults, optionRH_DEF_REGRAS_ATRIBUICAO) );
            //END Regras de Promoções
                        
            //Prémios antiguidade
            var optionsRH_DEF_PREMIOS_ANTIGUIDADE = {
                "tableId": "RH_DEF_PREMIOS_ANTIGUIDADE",
                "table": "RH_DEF_PREMIOS_ANTIGUIDADE",
                "pk": {
                    "primary": {
                        "CD_REGRA": {"type": "number"},                      
                        "CD_ANTIGUIDADE": {"type": "number"}
                    }
                },
                "dependsOn": {
                    "RH_DEF_REGRAS_ATRIBUICAO": {
                        "CD_REGRA": "CD_REGRA"
                    }
                },
                "order_by": "CD_ANTIGUIDADE",
                "recordBundle": 7, 
                "pageLenght": 7, 
                "scrollY": "237", //234
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
                        "data": 'CD_REGRA',
                        "name": 'CD_REGRA',                    
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_code; ?>", //Editor
                        "data": 'CD_ANTIGUIDADE',
                        "name": 'CD_ANTIGUIDADE',
                        "className": "none visibleColumn right",
                        "attr": {
                            "class": "toRight",
                            "style": "width:20%"
                        }                        
                    }, {
                        "responsivePriority": 2,
                        "title": "<?php echo mb_strtoupper($ui_years, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_years; ?>", //Editor
                        "data": 'NR_ANOS',
                        "name": 'NR_ANOS',
                        "className": "visibleColumn right",
                        "attr": {
                            "class": "toRight",
                            "style": "width:20%"
                        }
                    }, {
                        "responsivePriority": 2, 
                        "title": "<?php echo mb_strtoupper($ui_rewards, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_rewards; ?>", //Editor
                        "data": 'NR_PREMIO',
                        "name": 'NR_PREMIO',
                        "className": "visibleColumn right",
                        "attr": {
                            "class": "toRight",
                            "style": "width:20%"
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
                            return RH_DEF_PREMIOS_ANTIGUIDADE.crudButtons(true,true,true);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "CD_ANTIGUIDADE": {
                            required: true,
                            integer: true,
                            maxlength: 2
                        },
                        "NR_ANOS": {
                            required: true,
                            integer: true,
                            maxlength: 2
                        },
                        "NR_PREMIO": {
                            required: true,
                            integer: true,
                            maxlength: 2
                        }
                    }
                }
            };
            RH_DEF_PREMIOS_ANTIGUIDADE = new QuadTable();
            RH_DEF_PREMIOS_ANTIGUIDADE.initTable($.extend({}, datatable_instance_defaults, optionsRH_DEF_PREMIOS_ANTIGUIDADE));
            //END Prémios Antiguidade
            
            //Diuturnidades Tipo A
            var optionsRH_DEF_DIUTURNIDADES_A = {
                "tableId": "RH_DEF_DIUTURNIDADES_A",
                "table": "RH_DEF_DIUTURNIDADES",
                "pk": {
                    "primary": {
                        "CD_REGRA": {"type": "number"},                      
                        "CD_DIUTURNIDADE": {"type": "number"}
                    }
                },
                "dependsOn": {
                    "RH_DEF_REGRAS_ATRIBUICAO": {
                        "CD_REGRA": "CD_REGRA"
                    }
                },
                "initialWhereClause": "TP_DIUTURNIDADE = 'A' ",
                "order_by": "CD_DIUTURNIDADE",
                "recordBundle": 7, 
                "pageLenght": 7, 
                "scrollY": "237", //234
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
                        "data": 'CD_REGRA',
                        "name": 'CD_REGRA',                    
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'TP_DIUTURNIDADE',
                        "name": 'TP_DIUTURNIDADE',
                        "def": "A",
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_code; ?>", //Editor
                        "data": 'CD_DIUTURNIDADE',
                        "name": 'CD_DIUTURNIDADE',
                        "className": "none visibleColumn right",
                        "attr": {
                            "class": "toRight",
                            "style": "width:20%"
                        }
                    }, {
                        "responsivePriority": 3,
                        "title": "<?php echo mb_strtoupper($ui_years_interval, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_years; ?>", //Editor
                        "data": 'NR_ANOS_TP_A',
                        "name": 'NR_ANOS_TP_A',
                        "className": "visibleColumn right",
                        "attr": {
                            "class": "toRight",
                            "style": "width:20%"
                        }
                    }, {
                        "responsivePriority": 4,
                        "title": "<?php echo mb_strtoupper($ui_diuturnities, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_diuturnities; ?>", //Editor
                        "data": 'NR_DIUTURNIDADES',
                        "name": 'NR_DIUTURNIDADES',
                        "className": "visibleColumn right",
                        "attr": {
                            "class": "toRight",
                            "style": "width:20%"
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
                            return RH_DEF_DIUTURNIDADES_A.crudButtons(true,true,true);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "CD_ANTIGUIDADE": {
                            required: true,
                            integer: true,
                            maxlength: 2
                        },
                        "NR_ANOS_TP_A": {
                            required: true,
                            number: true
                        },
                        "NR_DIUTURNIDADES": {
                            required: true,
                            number: true
                        }
                    }
                }
            };
            RH_DEF_DIUTURNIDADES_A = new QuadTable();
            RH_DEF_DIUTURNIDADES_A.initTable($.extend({}, datatable_instance_defaults, optionsRH_DEF_DIUTURNIDADES_A));
            //END Diuturnidades Tipo A

            //Diuturnidades Tipo B
            var optionsRH_DEF_DIUTURNIDADES_B = {
                "tableId": "RH_DEF_DIUTURNIDADES_B",
                "table": "RH_DEF_DIUTURNIDADES",
                "pk": {
                    "primary": {
                        "CD_REGRA": {"type": "number"},                      
                        "CD_DIUTURNIDADE": {"type": "number"}
                    }
                },
                "dependsOn": {
                    "RH_DEF_REGRAS_ATRIBUICAO": {
                        "CD_REGRA": "CD_REGRA"
                    }
                },
                "initialWhereClause": "TP_DIUTURNIDADE = 'B' ",
                "order_by": "CD_DIUTURNIDADE",
                "recordBundle": 7, 
                "pageLenght": 7, 
                "scrollY": "237", //234
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
                        "data": 'CD_REGRA',
                        "name": 'CD_REGRA',                    
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'TP_DIUTURNIDADE',
                        "name": 'TP_DIUTURNIDADE',
                        "def": "B",
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_code; ?>", //Editor
                        "data": 'CD_DIUTURNIDADE',
                        "name": 'CD_DIUTURNIDADE',
                        "className": "none visibleColumn right",
                        "attr": {
                            "class": "toRight",
                            "style": "width:20%"
                        }                        
                    }, {
                        "responsivePriority": 3,
                        "title": "<?php echo mb_strtoupper($ui_years_interval, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_years; ?>", //Editor
                        "data": 'NR_ANOS_TP_A',
                        "name": 'NR_ANOS_TP_A',
                        "className": "visibleColumn right",
                        "attr": {
                            "class": "toRight",
                            "style": "width:20%"
                        }
                    }, {
                        "responsivePriority": 4,
                        "title": "<?php echo mb_strtoupper($ui_factor, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_factor; ?>", //Editor
                        "data": 'TX_AFECT_TP_B',
                        "name": 'TX_AFECT_TP_B',
                        "className": "visibleColumn right",
                        "attr": {
                            "class": "toRight",
                            "style": "width: 50%"
                        }
                    }, {
                        "responsivePriority": 5,
                        "title": "<?php echo mb_strtoupper($ui_diuturnities, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_diuturnities; ?>", //Editor
                        "data": 'NR_DIUTURNIDADES',
                        "name": 'NR_DIUTURNIDADES',
                        "className": "visibleColumn right",
                        "attr": {
                            "class": "toRight",
                            "style": "width:20%"
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
                            return RH_DEF_DIUTURNIDADES_B.crudButtons(true,true,true);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "CD_ANTIGUIDADE": {
                            required: true,
                            integer: true,
                            maxlength: 2
                        },
                        "NR_ANOS_TP_A": {
                            required: true,
                            number: true
                        },
                        "NR_DIUTURNIDADES": {
                            required: true,
                            number: true
                        },
                        "TX_AFECT_TP_B": {
                            required: true,
                            number: true
                        }
                    }
                }
            };
            RH_DEF_DIUTURNIDADES_B = new QuadTable();
            RH_DEF_DIUTURNIDADES_B.initTable($.extend({}, datatable_instance_defaults, optionsRH_DEF_DIUTURNIDADES_B));
            //END Diuturnidades Tipo A
        }
        //END Módulo de Promoções
        
        //Módulo de Ambiente
        if (1 === 1) {
            //1. Rubricas
            //1.1 Cálculo Interativo
            var optionsCalc_Iterativo = {
                "tableId": 'Calc_Iterativo',
                "export": false,
                "table": "CG_REF_CODES",
                //"selectRecordMsg": "<?php echo $ui_please_select_record . $ui_delegation; ?>",            
                "pk": {
                    "primary": {
                        "RV_DOMAIN": {"type": "varchar"},
                        "RV_LOW_VALUE": {"type": "varchar"}
                    }
                },
                //"detailsObjects": [''],
                "initialWhereClause": "RV_DOMAIN = 'RH_CONFIG_GERAIS' AND RV_LOW_VALUE = 'RUB_CALC_ITER' ",
                "order_by": "RV_LOW_VALUE",
                "scrollY": "95", 
                "recordBundle": 1,
                "pageLenght": 1, 
                "tableCols": [
                    {
                        "responsivePriority": 1,
                        "data": null,
                        "className": "control toBottom toCenter",
                        "width": "1%",
                        "defaultContent": '' 
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_domain, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_domain; ?>", //Editor
                        "data": 'RV_DOMAIN',
                        "name": 'RV_DOMAIN',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "def": "RH_CONFIG_GERAIS",
                        "className": "right visibleColumn",
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "fieldInfo": "",
                        "data": 'RV_LOW_VALUE',
                        "name": 'RV_LOW_VALUE',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "className": "",
                        "def": "RUB_CALC_ITER"
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "fieldInfo": "",
                        "data": 'RV_ABBREVIATION',
                        "name": 'RV_ABBREVIATION',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "defaultContent": "",
                        "render": function (val, type, row) {
                            if (val !== null) {
                                $('#Calc_Iterativo_wrapper > div:nth-child(4) > div > div > div.dataTables_scrollHead > div > table > thead > tr > th:nth-child(4) > button').hide('slow');
                            }
                        }
                    }, {
                        "responsivePriority": 2,
                        "complexList": true, 
                        "title": "<?php echo mb_strtoupper($ui_iterative_calc, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_iterative_calc; ?>",
                        "data": 'DSP_RUBRICA',
                        "name": 'DSP_RUBRICA',
                        "type": "select",
                        "className": "visibleColumn",
                        //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                        "attr": {
                            "dependent-group": "RUBRICAS",
                            "dependent-level": 1,
                            "data-db-name": "A.CD_RUBRICA",
                            "distribute-value": "RV_ABBREVIATION",
                            "decodeFromTable": "RH_DEF_RUBRICAS A",  //TO CHANGE ON QUAD-HCM
                            "desigColumn": "CONCAT(CONCAT(A.CD_RUBRICA,'-'),A.DSP_RUBRICA)", 
                            "orderBy": "A.DSP_RUBRICA",
                            "class": "form-control complexList chosen",
                            "filter": {
                                "create": " AND A.ACTIVO = 'S' AND A.PRC_RECOLHA = 'S'", //On-New-Record
                                "edit": " AND A.ACTIVO = 'S' AND A.PRC_RECOLHA = 'S'", //On-Edit-Record
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
                            return Calc_Iterativo.crudButtons(true, true, false);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "DSP_RUBRICA": {
    //                        required: true,
                        }
                    }
                },
            };
            Calc_Iterativo = new QuadTable();
            Calc_Iterativo.initTable($.extend({}, datatable_instance_defaults, optionsCalc_Iterativo));

            //1.2 Cálculo Interativo - CGA (Benefício Complementar)
            var optionsCalc_Iterativo_CGA = {
                "tableId": 'Calc_Iterativo_CGA',
                "export": false,
                "table": "CG_REF_CODES",
                //"selectRecordMsg": "<?php echo $ui_please_select_record . $ui_delegation; ?>",            
                "pk": {
                    "primary": {
                        "RV_DOMAIN": {"type": "varchar"},
                        "RV_LOW_VALUE": {"type": "varchar"}
                    }
                },
                //"detailsObjects": [''],
                "initialWhereClause": "RV_DOMAIN = 'RH_CONFIG_GERAIS' AND RV_LOW_VALUE = 'RUB_CALC_ITER_CGA' ",
                "order_by": "RV_LOW_VALUE",
                "scrollY": "95", 
                "recordBundle": 1,
                "pageLenght": 1, 
                "tableCols": [
                    {
                        "responsivePriority": 1,
                        "data": null,
                        "className": "control toBottom toCenter",
                        "width": "1%",
                        "defaultContent": '' 
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_domain, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_domain; ?>", //Editor
                        "data": 'RV_DOMAIN',
                        "name": 'RV_DOMAIN',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "def": "RH_CONFIG_GERAIS",
                        "className": "right visibleColumn",
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "fieldInfo": "",
                        "data": 'RV_LOW_VALUE',
                        "name": 'RV_LOW_VALUE',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "className": "",
                        "def": "RUB_CALC_ITER_CGA"
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "fieldInfo": "",
                        "data": 'RV_ABBREVIATION',
                        "name": 'RV_ABBREVIATION',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "defaultContent": "",
                        "render": function (val, type, row) {
                            if (val !== null) {
                                $('#Calc_Iterativo_CGA_wrapper > div:nth-child(4) > div > div > div.dataTables_scrollHead > div > table > thead > tr > th:nth-child(4) > button').hide('slow');
                            }
                        }

                    }, {
                        "responsivePriority": 2,
                        "complexList": true, 
                        "title": "<?php echo mb_strtoupper($ui_complementary_benefit_cga, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_complementary_benefit_cga; ?>",
                        "data": 'DSP_RUBRICA',
                        "name": 'DSP_RUBRICA',
                        "type": "select",
                        "className": "visibleColumn",
                        //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                        "attr": {
                            "dependent-group": "RUBRICAS",
                            "dependent-level": 1,
                            "data-db-name": "A.CD_RUBRICA",
                            "distribute-value": "RV_ABBREVIATION",
                            "decodeFromTable": "RH_DEF_RUBRICAS A",  //TO CHANGE ON QUAD-HCM
                            "desigColumn": "CONCAT(CONCAT(A.CD_RUBRICA,'-'),A.DSP_RUBRICA)", 
                            "orderBy": "A.DSP_RUBRICA",
                            "class": "form-control complexList chosen",
                            "filter": {
                                "create": " AND A.ACTIVO = 'S' AND A.PRC_RECOLHA = 'S'", //On-New-Record
                                "edit": " AND A.ACTIVO = 'S' AND A.PRC_RECOLHA = 'S'", //On-Edit-Record
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
                            return Calc_Iterativo_CGA.crudButtons(true, true, false);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "DSP_RUBRICA": {
    //                        required: true,
                        }
                    }
                },
            };
            Calc_Iterativo_CGA = new QuadTable();
            Calc_Iterativo_CGA.initTable($.extend({}, datatable_instance_defaults, optionsCalc_Iterativo_CGA));
            //END Rubricas :: Cálculos Interativos

            //Retroativos
            var optionsRetroativos_Desde = {
                "tableId": 'Retroativos_Desde',
                "export": false,
                "table": "CG_REF_CODES",
                //"selectRecordMsg": "<?php echo $ui_please_select_record . $ui_delegation; ?>",            
                "pk": {
                    "primary": {
                        "RV_DOMAIN": {"type": "varchar"},
                        "RV_LOW_VALUE": {"type": "varchar"}
                    }
                },
                //"detailsObjects": [''],
                "initialWhereClause": "RV_DOMAIN = 'RH_CONFIG_GERAIS' AND RV_LOW_VALUE = 'RETRO_LIM_INF' ",
                "order_by": "RV_LOW_VALUE",
                "scrollY": "95", 
                "recordBundle": 1,
                "pageLenght": 1, 
                "tableCols": [
                    {
                        "responsivePriority": 1,
                        "data": null,
                        "className": "control toBottom toCenter",
                        "width": "1%",
                        "defaultContent": '' 
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_domain, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_domain; ?>", //Editor
                        "data": 'RV_DOMAIN',
                        "name": 'RV_DOMAIN',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "def": "RH_CONFIG_GERAIS",
                        "className": "right visibleColumn",
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "fieldInfo": "",
                        "data": 'RV_LOW_VALUE',
                        "name": 'RV_LOW_VALUE',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "className": "",
                        "def": "RETRO_LIM_INF"
                    }, {
                        "responsivePriority": 2,
                        "title": "<?php echo mb_strtoupper($ui_lower_limit, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_lower_limit; ?>", //Editor
                        "fieldInfo": "<?php echo $hint_year_month; ?>",
                        "data": 'RV_ABBREVIATION',
                        "name": 'RV_ABBREVIATION',
                        "defaultContent": "",
                        //"datatype": 'dateYearMonth',
                        "className": "visibleColumn",
                        "attr": {
                            "class": "form-control dateYearMonth",
                            "autocomplete": "nope"
                        },
                        "render": function (val, type, row) {
                            if (val !== '') {
                                $('#Retroativos_Desde_wrapper > div:nth-child(4) > div > div > div.dataTables_scrollHead > div > table > thead > tr > th:nth-child(4) > button').hide('slow');
                                try {
                                    return val.substr(0,7);
                                } catch(e) {
                                    return val;
                                }                            
                            } else {
                                return '';
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
                            return Retroativos_Desde.crudButtons(true, true, false);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "DSP_RUBRICA": {
    //                        required: true,
                        }
                    }
                },
            };
            Retroativos_Desde = new QuadTable();
            Retroativos_Desde.initTable($.extend({}, datatable_instance_defaults, optionsRetroativos_Desde));
            //END Retroativos

            //IRS
            //2.1 IRS - Catg. A
            var optionsIRS_A = {
                "tableId": 'IRS_A',
                "export": false,
                "table": "CG_REF_CODES",
                //"selectRecordMsg": "<?php echo $ui_please_select_record . $ui_delegation; ?>",            
                "pk": {
                    "primary": {
                        "RV_DOMAIN": {"type": "varchar"},
                        "RV_LOW_VALUE": {"type": "varchar"}
                    }
                },
                //"detailsObjects": [''],
                "initialWhereClause": "RV_DOMAIN = 'RH_CONFIG_GERAIS' AND RV_LOW_VALUE = 'IRS_TIPO_A' ",
                "order_by": "RV_LOW_VALUE",
                "scrollY": "95", 
                "recordBundle": 1,
                "pageLenght": 1, 
                "tableCols": [
                    {
                        "responsivePriority": 1,
                        "data": null,
                        "className": "control toBottom toCenter",
                        "width": "1%",
                        "defaultContent": '' 
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_domain, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_domain; ?>", //Editor
                        "data": 'RV_DOMAIN',
                        "name": 'RV_DOMAIN',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "def": "RH_CONFIG_GERAIS",
                        "className": "right visibleColumn",
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "fieldInfo": "",
                        "data": 'RV_LOW_VALUE',
                        "name": 'RV_LOW_VALUE',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "className": "",
                        "def": "IRS_TIPO_A"
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "fieldInfo": "",
                        "data": 'RV_ABBREVIATION',
                        "name": 'RV_ABBREVIATION',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "defaultContent": "",
                        "render": function (val, type, row) {
                            if (val !== null) {
                                $('#IRS_A_wrapper > div:nth-child(4) > div > div > div.dataTables_scrollHead > div > table > thead > tr > th:nth-child(4) > button').hide('slow');
                            }
                        }
                    }, {
                        "responsivePriority": 2,
                        "complexList": true, 
                        "title": "<?php echo mb_strtoupper($ui_cirs_A, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_cirs_A; ?>",
                        "data": 'DSP_ED',
                        "name": 'DSP_ED',
                        "type": "select",
                        "className": "visibleColumn",
                        //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                        "attr": {
                            "dependent-group": "ENTIDADES_DESCONTO",
                            "dependent-level": 1,
                            "data-db-name": "A.CD_ED",
                            "distribute-value": "RV_ABBREVIATION",
                            "decodeFromTable": "RH_DEF_ENTIDADES_DESCONTO A",  //TO CHANGE ON QUAD-HCM
                            "desigColumn": "CONCAT(CONCAT(A.CD_ED,'-'),A.DSP_ED)",
                            "orderBy": "A.CD_ED",
                            "class": "form-control complexList chosen",
                            "filter": {
                                "create": " AND A.ACTIVO = 'S' AND A.CD_GRUPO_ED != 'SS' ", //On-New-Record
                                "edit": " AND A.ACTIVO = 'S' AND A.CD_GRUPO_ED != 'SS' ", //On-Edit-Record
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
                            return IRS_A.crudButtons(true, true, false);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "DSP_ED": {
    //                        required: true,
                        }
                    }
                },
            };
            IRS_A = new QuadTable();
            IRS_A.initTable($.extend({}, datatable_instance_defaults, optionsIRS_A));
            //2.2 IRS - Catg. B
            var optionsIRS_B = {
                "tableId": 'IRS_B',
                "export": false,
                "table": "CG_REF_CODES",
                //"selectRecordMsg": "<?php echo $ui_please_select_record . $ui_delegation; ?>",            
                "pk": {
                    "primary": {
                        "RV_DOMAIN": {"type": "varchar"},
                        "RV_LOW_VALUE": {"type": "varchar"}
                    }
                },
                //"detailsObjects": [''],
                "initialWhereClause": "RV_DOMAIN = 'RH_CONFIG_GERAIS' AND RV_LOW_VALUE = 'IRS_TIPO_B' ",
                "order_by": "RV_LOW_VALUE",
                "scrollY": "95", 
                "recordBundle": 1,
                "pageLenght": 1, 
                "tableCols": [
                    {
                        "responsivePriority": 1,
                        "data": null,
                        "className": "control toBottom toCenter",
                        "width": "1%",
                        "defaultContent": '' 
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_domain, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_domain; ?>", //Editor
                        "data": 'RV_DOMAIN',
                        "name": 'RV_DOMAIN',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "def": "RH_CONFIG_GERAIS",
                        "className": "right visibleColumn",
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "fieldInfo": "",
                        "data": 'RV_LOW_VALUE',
                        "name": 'RV_LOW_VALUE',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "className": "",
                        "def": "IRS_TIPO_B"
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "fieldInfo": "",
                        "data": 'RV_ABBREVIATION',
                        "name": 'RV_ABBREVIATION',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "defaultContent": "",
                        "render": function (val, type, row) {
                            if (val !== null) {
                                $('#IRS_B_wrapper > div:nth-child(4) > div > div > div.dataTables_scrollHead > div > table > thead > tr > th:nth-child(4) > button').hide('slow');
                            }
                        }
                    }, {
                        "responsivePriority": 2,
                        "complexList": true, 
                        "title": "<?php echo mb_strtoupper($ui_cirs_B, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_cirs_B; ?>",
                        "data": 'DSP_ED',
                        "name": 'DSP_ED',
                        "type": "select",
                        "className": "visibleColumn",
                        //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                        "attr": {
                            "dependent-group": "ENTIDADES_DESCONTO",
                            "dependent-level": 1,
                            "data-db-name": "A.CD_ED",
                            "distribute-value": "RV_ABBREVIATION",
                            "decodeFromTable": "RH_DEF_ENTIDADES_DESCONTO A",  //TO CHANGE ON QUAD-HCM
                            "desigColumn": "CONCAT(CONCAT(A.CD_ED,'-'),A.DSP_ED)", 
                            "orderBy": "A.CD_ED",
                            "class": "form-control complexList chosen",
                            "filter": {
                                "create": " AND A.ACTIVO = 'S' AND A.CD_GRUPO_ED != 'SS' ", //On-New-Record
                                "edit": " AND A.ACTIVO = 'S' AND A.CD_GRUPO_ED != 'SS' ", //On-Edit-Record
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
                            return IRS_B.crudButtons(true, true, false);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "DSP_ED": {
    //                        required: true,
                        }
                    }
                },
            };
            IRS_B = new QuadTable();
            IRS_B.initTable($.extend({}, datatable_instance_defaults, optionsIRS_B));
            //2.3 IRS - Catg. H
            var optionsIRS_H = {
                "tableId": 'IRS_H',
                "export": false,
                "table": "CG_REF_CODES",
                //"selectRecordMsg": "<?php echo $ui_please_select_record . $ui_delegation; ?>",            
                "pk": {
                    "primary": {
                        "RV_DOMAIN": {"type": "varchar"},
                        "RV_LOW_VALUE": {"type": "varchar"}
                    }
                },
                //"detailsObjects": [''],
                "initialWhereClause": "RV_DOMAIN = 'RH_CONFIG_GERAIS' AND RV_LOW_VALUE = 'IRS_TIPO_H' ",
                "order_by": "RV_LOW_VALUE",
                "scrollY": "95", 
                "recordBundle": 1,
                "pageLenght": 1, 
                "tableCols": [
                    {
                        "responsivePriority": 1,
                        "data": null,
                        "className": "control toBottom toCenter",
                        "width": "1%",
                        "defaultContent": '' 
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_domain, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_domain; ?>", //Editor
                        "data": 'RV_DOMAIN',
                        "name": 'RV_DOMAIN',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "def": "RH_CONFIG_GERAIS",
                        "className": "right visibleColumn",
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "fieldInfo": "",
                        "data": 'RV_LOW_VALUE',
                        "name": 'RV_LOW_VALUE',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "className": "",
                        "def": "IRS_TIPO_H"
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "fieldInfo": "",
                        "data": 'RV_ABBREVIATION',
                        "name": 'RV_ABBREVIATION',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "defaultContent": "",
                        "render": function (val, type, row) {
                            if (val !== null) {
                                $('#IRS_B_wrapper > div:nth-child(4) > div > div > div.dataTables_scrollHead > div > table > thead > tr > th:nth-child(4) > button').hide('slow');
                            }
                        }
                    }, {
                        "responsivePriority": 2,
                        "complexList": true, 
                        "title": "<?php echo mb_strtoupper($ui_cirs_H, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_cirs_H; ?>",
                        "data": 'DSP_ED',
                        "name": 'DSP_ED',
                        "type": "select",
                        "className": "visibleColumn",
                        //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                        "attr": {
                            "dependent-group": "ENTIDADES_DESCONTO",
                            "dependent-level": 1,
                            "data-db-name": "A.CD_ED",
                            "distribute-value": "RV_ABBREVIATION",
                            "decodeFromTable": "RH_DEF_ENTIDADES_DESCONTO A",  //TO CHANGE ON QUAD-HCM
                            "desigColumn": "CONCAT(CONCAT(A.CD_ED,'-'),A.DSP_ED)", 
                            "orderBy": "A.CD_ED",
                            "class": "form-control complexList chosen",
                            "filter": {
                                "create": " AND A.ACTIVO = 'S' AND A.CD_GRUPO_ED != 'SS' ", //On-New-Record
                                "edit": " AND A.ACTIVO = 'S' AND A.CD_GRUPO_ED != 'SS' ", //On-Edit-Record
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
                            return IRS_H.crudButtons(true, true, false);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "DSP_ED": {
    //                        required: true,
                        }
                    }
                },
            };
            IRS_H = new QuadTable();
            IRS_H.initTable($.extend({}, datatable_instance_defaults, optionsIRS_H));
            //2.4 IRS - Não Residentes
            var optionsIRS_Z = {
                "tableId": 'IRS_Z',
                "export": false,
                "table": "CG_REF_CODES",
                //"selectRecordMsg": "<?php echo $ui_please_select_record . $ui_delegation; ?>",            
                "pk": {
                    "primary": {
                        "RV_DOMAIN": {"type": "varchar"},
                        "RV_LOW_VALUE": {"type": "varchar"}
                    }
                },
                //"detailsObjects": [''],
                "initialWhereClause": "RV_DOMAIN = 'RH_CONFIG_GERAIS' AND RV_LOW_VALUE = 'IRS_TIPO_Z' ",
                "order_by": "RV_LOW_VALUE",
                "scrollY": "95", 
                "recordBundle": 1,
                "pageLenght": 1, 
                "tableCols": [
                    {
                        "responsivePriority": 1,
                        "data": null,
                        "className": "control toBottom toCenter",
                        "width": "1%",
                        "defaultContent": '' 
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_domain, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_domain; ?>", //Editor
                        "data": 'RV_DOMAIN',
                        "name": 'RV_DOMAIN',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "def": "RH_CONFIG_GERAIS",
                        "className": "right visibleColumn",
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "fieldInfo": "",
                        "data": 'RV_LOW_VALUE',
                        "name": 'RV_LOW_VALUE',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "className": "",
                        "def": "IRS_TIPO_Z"
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "fieldInfo": "",
                        "data": 'RV_ABBREVIATION',
                        "name": 'RV_ABBREVIATION',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "defaultContent": "",
                        "render": function (val, type, row) {
                            if (val !== null) {
                                $('#IRS_Z_wrapper > div:nth-child(4) > div > div > div.dataTables_scrollHead > div > table > thead > tr > th:nth-child(4) > button').hide('slow');
                            }
                        }
                    }, {
                        "responsivePriority": 2,
                        "complexList": true, 
                        "title": "<?php echo mb_strtoupper($ui_cirs_non_residents, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_cirs_non_residents; ?>",
                        "data": 'DSP_ED',
                        "name": 'DSP_ED',
                        "type": "select",
                        "className": "visibleColumn",
                        //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                        "attr": {
                            "dependent-group": "ENTIDADES_DESCONTO",
                            "dependent-level": 1,
                            "data-db-name": "A.CD_ED",
                            "distribute-value": "RV_ABBREVIATION",
                            "decodeFromTable": "RH_DEF_ENTIDADES_DESCONTO A",  //TO CHANGE ON QUAD-HCM
                            "desigColumn": "CONCAT(CONCAT(A.CD_ED,'-'),A.DSP_ED)", 
                            "orderBy": "A.CD_ED",
                            "class": "form-control complexList chosen",
                            "filter": {
                                "create": " AND A.ACTIVO = 'S' AND A.CD_GRUPO_ED != 'SS' ", //On-New-Record
                                "edit": " AND A.ACTIVO = 'S' AND A.CD_GRUPO_ED != 'SS' ", //On-Edit-Record
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
                            return IRS_Z.crudButtons(true, true, false);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "DSP_ED": {
    //                        required: true,
                        }
                    }
                },
            };
            IRS_Z = new QuadTable();
            IRS_Z.initTable($.extend({}, datatable_instance_defaults, optionsIRS_Z));
            //END IRS

            //Acertos Automáticos
            //3.1 S ou N 
            var optionsRN_ACERTO = {
                "tableId": 'RN_ACERTO',
                "export": false,
                "table": "CG_REF_CODES",
                //"selectRecordMsg": "<?php echo $ui_please_select_record . $ui_delegation; ?>",            
                "pk": {
                    "primary": {
                        "RV_DOMAIN": {"type": "varchar"},
                        "RV_LOW_VALUE": {"type": "varchar"}
                    }
                },
                //"detailsObjects": [''],
                "initialWhereClause": "RV_DOMAIN = 'RH_ACERTO_AUTO' AND RV_LOW_VALUE = 'ACERTOS' ",
                "order_by": "RV_LOW_VALUE",
                "scrollY": "95", 
                "recordBundle": 1,
                "pageLenght": 1, 
                "tableCols": [
                    {
                        "responsivePriority": 1,
                        "data": null,
                        "className": "control toBottom toCenter",
                        "width": "1%",
                        "defaultContent": '' 
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_domain, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_domain; ?>", //Editor
                        "data": 'RV_DOMAIN',
                        "name": 'RV_DOMAIN',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "def": "RH_ACERTO_AUTO",
                        "className": "right visibleColumn",
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "fieldInfo": "",
                        "data": 'RV_LOW_VALUE',
                        "name": 'RV_LOW_VALUE',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "className": "",
                        "def": "ACERTOS"
                    }, {
                        "responsivePriority": 2,
                        "title": "<?php echo mb_strtoupper($ui_active, 'UTF-8'); ?>", //Datatables :: Original
                        "label": "<?php echo mb_strtoupper($ui_active, 'UTF-8'); ?>", //Editor
                        //"fieldInfo": "<?php echo $hint_requires_previous_authorizarion; ?>",
                        "data": 'RV_ABBREVIATION',
                        "name": 'RV_ABBREVIATION',
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
                                //Logically dependent Instances control
                                setTimeout( function () {
                                    if (o['RV_LOW_VALUE'] === 'S') {
                                        $('div.conditionalAcerto').removeClass('not-available-and-not-visible');
                                    } else {
                                        $('div.conditionalAcerto').addClass('not-available-and-not-visible');
                                    }
                                },500);
                                return val == null ? null : o['RV_MEANING']; // + '<span id="RN_CONTROL" style="display:none;">' + o['RV_LOW_VALUE'] + '</span>';
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
                            return RN_ACERTO.crudButtons(true, true, false);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "DSP_ED": {
    //                        required: true,
                        }
                    }
                },
            };
            RN_ACERTO = new QuadTable();
            RN_ACERTO.initTable($.extend({}, datatable_instance_defaults, optionsRN_ACERTO));              
            //3.2 Limite
            var optionsRN_ACERTO_LIMITE = {
                "tableId": 'RN_ACERTO_LIMITE',
                "export": false,
                "table": "CG_REF_CODES",
                //"selectRecordMsg": "<?php echo $ui_please_select_record . $ui_delegation; ?>",            
                "pk": {
                    "primary": {
                        "RV_DOMAIN": {"type": "varchar"},
                        "RV_LOW_VALUE": {"type": "varchar"}
                    }
                },
                //"detailsObjects": [''],
                "initialWhereClause": "RV_DOMAIN = 'RH_ACERTO_AUTO' AND RV_LOW_VALUE = 'LIM_MIN_NEG' ",
                "order_by": "RV_LOW_VALUE",
                "scrollY": "95", 
                "recordBundle": 1,
                "pageLenght": 1, 
                "tableCols": [
                    {
                        "responsivePriority": 1,
                        "data": null,
                        "className": "control toBottom toCenter",
                        "width": "1%",
                        "defaultContent": '' 
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_domain, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_domain; ?>", //Editor
                        "data": 'RV_DOMAIN',
                        "name": 'RV_DOMAIN',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "def": "RH_ACERTO_AUTO",
                        "className": "right visibleColumn",
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "fieldInfo": "",
                        "data": 'RV_LOW_VALUE',
                        "name": 'RV_LOW_VALUE',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "className": "",
                        "def": "LIM_MIN_NEG"
                    }, {
                        "responsivePriority": 2,
                        "title": "<?php echo mb_strtoupper($ui_lower_limit_adjustment, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_lower_limit_adjustment; ?>", //Editor
                        "fieldInfo": "<?php echo $hint_limit_payroll_adjustment; ?>",
                        "data": 'RV_ABBREVIATION',
                        "name": 'RV_ABBREVIATION',
                        "defaultContent": "",
                        //"datatype": 'dateYearMonth',
                        "className": "visibleColumn right",
                        "attr": {
                            "class": "form-control toRight",
                            "style": "width: 30%;",
                            "autocomplete": "nope"
                        },
                        "render": function (val, type, row) {
                            if (val !== '') {
                                $('#RN_LIMITE_wrapper > div:nth-child(4) > div > div > div.dataTables_scrollHead > div > table > thead > tr > th:nth-child(4) > button').hide('slow');
                                return val;                           
                            } else {
                                return '';
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
                            return RN_ACERTO_LIMITE.crudButtons(true, true, false);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "RV_ABBREVIATION": {
                            number: true,
                        }
                    }
                },
            };
            RN_ACERTO_LIMITE = new QuadTable();
            RN_ACERTO_LIMITE.initTable($.extend({}, datatable_instance_defaults, optionsRN_ACERTO_LIMITE));            
            //3.3 Acerto +
            var optionsRN_ACERTO_POS = {
                "tableId": 'RN_ACERTO_POS',
                "export": false,
                "table": "CG_REF_CODES",
                //"selectRecordMsg": "<?php echo $ui_please_select_record . $ui_delegation; ?>",            
                "pk": {
                    "primary": {
                        "RV_DOMAIN": {"type": "varchar"},
                        "RV_LOW_VALUE": {"type": "varchar"}
                    }
                },
                //"detailsObjects": [''],
                "initialWhereClause": "RV_DOMAIN = 'RH_ACERTO_AUTO' AND RV_LOW_VALUE = 'RUB_POS' ",
                "order_by": "RV_LOW_VALUE",
                "scrollY": "95", 
                "recordBundle": 1,
                "pageLenght": 1, 
                "tableCols": [
                    {
                        "responsivePriority": 1,
                        "data": null,
                        "className": "control toBottom toCenter",
                        "width": "1%",
                        "defaultContent": '' 
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_domain, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_domain; ?>", //Editor
                        "data": 'RV_DOMAIN',
                        "name": 'RV_DOMAIN',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "def": "RH_ACERTO_AUTO",
                        "className": "right visibleColumn",
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "fieldInfo": "",
                        "data": 'RV_LOW_VALUE',
                        "name": 'RV_LOW_VALUE',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "className": "",
                        "def": "RUB_POS"
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "fieldInfo": "",
                        "data": 'RV_ABBREVIATION',
                        "name": 'RV_ABBREVIATION',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "defaultContent": "",
                        "render": function (val, type, row) {
                            if (val !== null) {
                                $('#RN_ACERTO_POS_wrapper > div:nth-child(4) > div > div > div.dataTables_scrollHead > div > table > thead > tr > th:nth-child(4) > button').hide('slow');
                            }
                        }
                    }, {
                        "responsivePriority": 2,
                        "complexList": true, 
                        "title": "<?php echo mb_strtoupper($ui_positive_adjustment_payroll_item, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_positive_adjustment_payroll_item; ?>",
                        "data": 'DSP_RUBRICA',
                        "name": 'DSP_RUBRICA',
                        "type": "select",
                        "className": "visibleColumn",
                        //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                        "attr": {
                            "dependent-group": "RUBRICAS",
                            "dependent-level": 1,
                            "data-db-name": "A.CD_RUBRICA",
                            "distribute-value": "RV_ABBREVIATION",
                            "decodeFromTable": "RH_DEF_RUBRICAS A",  //TO CHANGE ON QUAD-HCM
                            "desigColumn": "CONCAT(CONCAT(A.CD_RUBRICA,'-'),A.DSP_RUBRICA)", 
                            "orderBy": "A.DSP_RUBRICA",
                            "class": "form-control complexList chosen",
                            "filter": {
                                "create": " AND A.ACTIVO = 'S' AND A.PRC_RECOLHA = 'S'", //On-New-Record
                                "edit": " AND A.ACTIVO = 'S' AND A.PRC_RECOLHA = 'S'", //On-Edit-Record
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
                            return RN_ACERTO_POS.crudButtons(true, true, false);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "DSP_RUBRICA": {
    //                        required: true,
                        }
                    }
                },
            };
            RN_ACERTO_POS = new QuadTable();
            RN_ACERTO_POS.initTable($.extend({}, datatable_instance_defaults, optionsRN_ACERTO_POS));            
            //3.4 Acerto -
            var optionsRN_ACERTO_NEG = {
                "tableId": 'RN_ACERTO_NEG',
                "export": false,
                "table": "CG_REF_CODES",
                //"selectRecordMsg": "<?php echo $ui_please_select_record . $ui_delegation; ?>",            
                "pk": {
                    "primary": {
                        "RV_DOMAIN": {"type": "varchar"},
                        "RV_LOW_VALUE": {"type": "varchar"}
                    }
                },
                //"detailsObjects": [''],
                "initialWhereClause": "RV_DOMAIN = 'RH_ACERTO_AUTO' AND RV_LOW_VALUE = 'RUB_NEG' ",
                "order_by": "RV_LOW_VALUE",
                "scrollY": "95", 
                "recordBundle": 1,
                "pageLenght": 1, 
                "tableCols": [
                    {
                        "responsivePriority": 1,
                        "data": null,
                        "className": "control toBottom toCenter",
                        "width": "1%",
                        "defaultContent": '' 
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_domain, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_domain; ?>", //Editor
                        "data": 'RV_DOMAIN',
                        "name": 'RV_DOMAIN',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "def": "RH_ACERTO_AUTO",
                        "className": "right visibleColumn",
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "fieldInfo": "",
                        "data": 'RV_LOW_VALUE',
                        "name": 'RV_LOW_VALUE',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "className": "",
                        "def": "RUB_NEG"
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "fieldInfo": "",
                        "data": 'RV_ABBREVIATION',
                        "name": 'RV_ABBREVIATION',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "defaultContent": "",
                        "render": function (val, type, row) {
                            if (val !== null) {
                                $('#RN_ACERTO_POS_wrapper > div:nth-child(4) > div > div > div.dataTables_scrollHead > div > table > thead > tr > th:nth-child(4) > button').hide('slow');
                            }
                        }
                    }, {
                        "responsivePriority": 2,
                        "complexList": true, 
                        "title": "<?php echo mb_strtoupper($ui_negative_adjustment_payroll_item, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_negative_adjustment_payroll_item; ?>",
                        "data": 'DSP_RUBRICA',
                        "name": 'DSP_RUBRICA',
                        "type": "select",
                        "className": "visibleColumn",
                        //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                        "attr": {
                            "dependent-group": "RUBRICAS",
                            "dependent-level": 1,
                            "data-db-name": "A.CD_RUBRICA",
                            "distribute-value": "RV_ABBREVIATION",
                            "decodeFromTable": "RH_DEF_RUBRICAS A",  //TO CHANGE ON QUAD-HCM
                            "desigColumn": "CONCAT(CONCAT(A.CD_RUBRICA,'-'),A.DSP_RUBRICA)", 
                            "orderBy": "A.DSP_RUBRICA",
                            "class": "form-control complexList chosen",
                            "filter": {
                                "create": " AND A.ACTIVO = 'S' AND A.PRC_RECOLHA = 'S'", //On-New-Record
                                "edit": " AND A.ACTIVO = 'S' AND A.PRC_RECOLHA = 'S'", //On-Edit-Record
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
                            return RN_ACERTO_NEG.crudButtons(true, true, false);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "DSP_RUBRICA": {
    //                        required: true,
                        }
                    }
                },
            };
            RN_ACERTO_NEG = new QuadTable();
            RN_ACERTO_NEG.initTable($.extend({}, datatable_instance_defaults, optionsRN_ACERTO_NEG));
            //END Acertos Automáticos

            //Descontos Judiciais
            //4.1 Grelha            
            var optionsGrelha_RMG = {
                "tableId": 'Grelha_RMG',
                "export": false,
                "table": "CG_REF_CODES",
                //"selectRecordMsg": "<?php echo $ui_please_select_record . $ui_delegation; ?>",            
                "pk": {
                    "primary": {
                        "RV_DOMAIN": {"type": "varchar"},
                        "RV_LOW_VALUE": {"type": "varchar"}
                    }
                },
                //"detailsObjects": [''],
                "initialWhereClause": "RV_DOMAIN = 'RH_ACERTO_AUTO' AND RV_LOW_VALUE = 'GRH_SAL_MIN' ",
                "order_by": "RV_LOW_VALUE",
                "scrollY": "95", 
                "recordBundle": 1,
                "pageLenght": 1, 
                "tableCols": [
                    {
                        "responsivePriority": 1,
                        "data": null,
                        "className": "control toBottom toCenter",
                        "width": "1%",
                        "defaultContent": '' 
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_domain, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_domain; ?>", //Editor
                        "data": 'RV_DOMAIN',
                        "name": 'RV_DOMAIN',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "def": "RH_ACERTO_AUTO",
                        "className": "right visibleColumn",
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_value, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_value; ?>", //Editor
                        "data": 'RV_LOW_VALUE',
                        "name": 'RV_LOW_VALUE',
                        "def": "GRH_SAL_MIN",
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "className": "visibleColumn",
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "fieldInfo": "",
                        "data": 'RV_ABBREVIATION',
                        "name": 'RV_ABBREVIATION',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "defaultContent": "",
                        "render": function (val, type, row) {
                            if (val !== null) {
                                if (val.length) {
                                    setTimeout( function () {
                                        $('div.conditionalJudicial').removeClass('not-available-and-not-visible');
                                    },500);                                    
                                } else {
                                    setTimeout( function () {
                                        console.log('GRID');
                                        $('div.conditionalJudicial').addClass('not-available-and-not-visible');
                                    },500);                                    
                                }
                                dj_ctrl = 'S';
                                $('#Grelha_RMG_wrapper > div:nth-child(4) > div > div > div.dataTables_scrollHead > div > table > thead > tr > th:nth-child(4) > button').hide('slow');
                            } else {
                                dj_ctrl = 'N'
                                setTimeout( function () {
                                    console.log('GRID');
                                    $('div.conditionalJudicial').addClass('not-available-and-not-visible');
                                },500); 
                            }
                            return val;
                        }
                    }, {
                        "responsivePriority": 2,
                        "complexList": true, 
                        "title": "<?php echo mb_strtoupper($ui_payroll_grid, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_payroll_grid; ?>",
                        "data": 'DSP_GS',
                        "name": 'DSP_GS',
                        "type": "select",
                        "className": "visibleColumn",
                        //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                        "attr": {
                            "dependent-group": "GRELHAS",
                            "dependent-level": 1,
                            "data-db-name": "A.CD_GRELHA_SALARIAL",
                            "distribute-value": "RV_ABBREVIATION",
                            "decodeFromTable": "RH_DEF_GRELHAS_SALARIAIS A",  //TO CHANGE ON QUAD-HCM
                            "desigColumn": "CONCAT(CONCAT(A.CD_GRELHA_SALARIAL,'-'),A.DSP_GRELHA_SALARIAL)", 
                            "orderBy": "A.CD_GRELHA_SALARIAL",
                            "class": "form-control complexList chosen",
                            "filter": {
                                "create": " AND A.ACTIVO = 'S'", //On-New-Record
                                "edit": " AND A.ACTIVO = 'S'", //On-Edit-Record
                            }
                        },
//                        "render": function (val, type, row) {
//                            //Logically dependent Instances control                            
//                            if (val !== "") {                                
//                                setTimeout( function () {
//                                    console.log('GRID');
//                                    $('div.conditionalJudicial').removeClass('not-available-and-not-visible');
//                                },500);
//
//                            } else {
//                                setTimeout( function () {
//                                    console.log('GRID');
//                                    $('div.conditionalJudicial').addClass('not-available-and-not-visible');
//                                },500);                                
//                            }
//                            return val;
//                        }      
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
                            return Grelha_RMG.crudButtons(true, true, false);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "DSP_GS": {
    //                        required: true,
                        }
                    }
                },
            };
            Grelha_RMG = new QuadTable();
            Grelha_RMG.initTable($.extend({}, datatable_instance_defaults, optionsGrelha_RMG));    
            
            //4.2 Valida limite máximo
            var optionsVal_LIM_MAXIMO = {
                "tableId": 'Val_LIM_MAXIMO',
                "export": false,
                "table": "CG_REF_CODES",
                //"selectRecordMsg": "<?php echo $ui_please_select_record . $ui_delegation; ?>",            
                "pk": {
                    "primary": {
                        "RV_DOMAIN": {"type": "varchar"},
                        "RV_LOW_VALUE": {"type": "varchar"}
                    }
                },
                //"detailsObjects": [''],
                "initialWhereClause": "RV_DOMAIN = 'RH_ACERTO_AUTO' AND RV_LOW_VALUE = 'DJ_LIM_MAX_1_3' ",
                "order_by": "RV_LOW_VALUE",
                "scrollY": "95", 
                "recordBundle": 1,
                "pageLenght": 1, 
                "tableCols": [
                    {
                        "responsivePriority": 1,
                        "data": null,
                        "className": "control toBottom toCenter",
                        "width": "1%",
                        "defaultContent": '' 
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_domain, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_domain; ?>", //Editor
                        "data": 'RV_DOMAIN',
                        "name": 'RV_DOMAIN',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "def": "RH_ACERTO_AUTO",
                        "className": "right visibleColumn",
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "fieldInfo": "",
                        "data": 'RV_LOW_VALUE',
                        "name": 'RV_LOW_VALUE',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "className": "",
                        "def": "DJ_LIM_MAX_1_3"
                    }, {
                        "responsivePriority": 2,
                        "title": "<?php echo mb_strtoupper($ui_seized_max_limit_validation, 'UTF-8'); ?>", //Datatables :: Original
                        "label": "<?php echo $ui_seized_max_limit_validation; ?>", //Editor
                        //"fieldInfo": "<?php echo $hint_requires_previous_authorizarion; ?>",
                        "data": 'RV_ABBREVIATION',
                        "name": 'RV_ABBREVIATION',
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
                                //Logically dependent Instances control                            
                                if (val.length) {
                                    if (dj_ctrl === 'S' && val === 'S') {
                                        setTimeout( function () {
                                            console.log('Max #1');
                                            $('div.conditionalJudicial.max').removeClass('not-available-and-not-visible');
                                        },550);                                           
                                    } else {
                                        setTimeout( function () {
                                            console.log('Max #2');
                                            $('div.conditionalJudicial.max').addClass('not-available-and-not-visible');
                                        },550); 
                                    }
                                }                                
                                return val == null ? null : o['RV_MEANING']; // + '<span id="RN_CONTROL" style="display:none;">' + o['RV_LOW_VALUE'] + '</span>';
                            } else {
                                setTimeout( function () {
                                    console.log('Max #3');
                                    $('div.conditionalJudicial.max').addClass('not-available-and-not-visible');
                                },550); 
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
                            return Val_LIM_MAXIMO.crudButtons(true, true, false);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "RV_ABBREVIATION": {
//                            number: true,
                        }
                    }
                },
            };
            Val_LIM_MAXIMO = new QuadTable();
            Val_LIM_MAXIMO.initTable($.extend({}, datatable_instance_defaults, optionsVal_LIM_MAXIMO));            
            //4.3 %
            var optionsVal_MAX_PERCENT = {
                "tableId": 'Val_MAX_PERCENT',
                "export": false,
                "table": "CG_REF_CODES",
                //"selectRecordMsg": "<?php echo $ui_please_select_record . $ui_delegation; ?>",            
                "pk": {
                    "primary": {
                        "RV_DOMAIN": {"type": "varchar"},
                        "RV_LOW_VALUE": {"type": "varchar"}
                    }
                },
                //"detailsObjects": [''],
                "initialWhereClause": "RV_DOMAIN = 'RH_ACERTO_AUTO' AND RV_LOW_VALUE = 'DJ_PCT_MAX_DJ' ",
                "order_by": "RV_LOW_VALUE",
                "scrollY": "95", 
                "recordBundle": 1,
                "pageLenght": 1, 
                "tableCols": [
                    {
                        "responsivePriority": 1,
                        "data": null,
                        "className": "control toBottom toCenter",
                        "width": "1%",
                        "defaultContent": '' 
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_domain, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_domain; ?>", //Editor
                        "data": 'RV_DOMAIN',
                        "name": 'RV_DOMAIN',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "def": "RH_ACERTO_AUTO",
                        "className": "right visibleColumn",
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "fieldInfo": "",
                        "data": 'RV_LOW_VALUE',
                        "name": 'RV_LOW_VALUE',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "className": "",
                        "def": "DJ_PCT_MAX_DJ"
                    }, {
                        "responsivePriority": 2,
                        "title": "<?php echo mb_strtoupper($ui_seized_max_limit_percentage, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_seized_max_limit_percentage; ?>", //Editor
                        //"fieldInfo": "<?php echo $hint_limit_payroll_adjustment; ?>",
                        "data": 'RV_ABBREVIATION',
                        "name": 'RV_ABBREVIATION',
                        "defaultContent": "",
                        //"datatype": 'dateYearMonth',
                        "className": "visibleColumn right",
                        "attr": {
                            "class": "form-control toRight",
                            "style": "width: 30%;",
                            "autocomplete": "nope"
                        },
                        "render": function (val, type, row) {
                            if (val !== '') {
                                $('#DJ_PCT_MAX_DJ_wrapper > div:nth-child(4) > div > div > div.dataTables_scrollHead > div > table > thead > tr > th:nth-child(4) > button').hide('slow');
                                return val;                           
                            } else {
                                return '';
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
                            return Val_MAX_PERCENT.crudButtons(true, true, false);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "RV_ABBREVIATION": {
                            number: true,
                        }
                    }
                },
            };
            Val_MAX_PERCENT = new QuadTable();
            Val_MAX_PERCENT.initTable($.extend({}, datatable_instance_defaults, optionsVal_MAX_PERCENT)); 
            //4.4 Valida impenhorabilidade            
            var optionsVal_LIM_MIN = {
                "tableId": 'Val_LIM_MIN',
                "export": false,
                "table": "CG_REF_CODES",
                //"selectRecordMsg": "<?php echo $ui_please_select_record . $ui_delegation; ?>",            
                "pk": {
                    "primary": {
                        "RV_DOMAIN": {"type": "varchar"},
                        "RV_LOW_VALUE": {"type": "varchar"}
                    }
                },
                //"detailsObjects": [''],
                "initialWhereClause": "RV_DOMAIN = 'RH_ACERTO_AUTO' AND RV_LOW_VALUE = 'DJ_LIM_SUP_2_3' ",
                "order_by": "RV_LOW_VALUE",
                "scrollY": "95", 
                "recordBundle": 1,
                "pageLenght": 1, 
                "tableCols": [
                    {
                        "responsivePriority": 1,
                        "data": null,
                        "className": "control toBottom toCenter",
                        "width": "1%",
                        "defaultContent": '' 
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_domain, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_domain; ?>", //Editor
                        "data": 'RV_DOMAIN',
                        "name": 'RV_DOMAIN',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "def": "RH_ACERTO_AUTO",
                        "className": "right visibleColumn",
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "fieldInfo": "",
                        "data": 'RV_LOW_VALUE',
                        "name": 'RV_LOW_VALUE',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "className": "",
                        "def": "DJ_LIM_SUP_2_3"
                    }, {
                        "responsivePriority": 2,
                        "title": "<?php echo mb_strtoupper($ui_seized_unseizability_validation, 'UTF-8'); ?>", //Datatables :: Original
                        "label": "<?php echo $ui_seized_unseizability_validation; ?>", //Editor
                        //"fieldInfo": "<?php echo $hint_requires_previous_authorizarion; ?>",
                        "data": 'RV_ABBREVIATION',
                        "name": 'RV_ABBREVIATION',
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
                                //Logically dependent Instances control                            
                                if (val.length) {
                                    if (dj_ctrl === 'S' && val === 'S') {
                                        setTimeout( function () {
                                            console.log('Min #1');
                                            $('div.conditionalJudicial.min').removeClass('not-available-and-not-visible');
                                        },550);                                           
                                    } else {
                                        setTimeout( function () {
                                            console.log('Min #2');
                                            $('div.conditionalJudicial.min').addClass('not-available-and-not-visible');
                                        },550); 
                                    }
                                }                                
                                return val == null ? null : o['RV_MEANING']; // + '<span id="RN_CONTROL" style="display:none;">' + o['RV_LOW_VALUE'] + '</span>';
                            } else {
                                setTimeout( function () {
                                    console.log('Min #3');
                                    $('div.conditionalJudicial.min').addClass('not-available-and-not-visible');
                                },550); 
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
                            return Val_LIM_MIN.crudButtons(true, true, false);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "RV_ABBREVIATION": {
//                            number: true,
                        }
                    }
                },
            };
            Val_LIM_MIN = new QuadTable();
            Val_LIM_MIN.initTable($.extend({}, datatable_instance_defaults, optionsVal_LIM_MIN));            
            //4.5 %
            var optionsVal_MIN_PERCENT = {
                "tableId": 'Val_MIN_PERCENT',
                "export": false,
                "table": "CG_REF_CODES",
                //"selectRecordMsg": "<?php echo $ui_please_select_record . $ui_delegation; ?>",            
                "pk": {
                    "primary": {
                        "RV_DOMAIN": {"type": "varchar"},
                        "RV_LOW_VALUE": {"type": "varchar"}
                    }
                },
                //"detailsObjects": [''],
                "initialWhereClause": "RV_DOMAIN = 'RH_ACERTO_AUTO' AND RV_LOW_VALUE = 'DJ_PCT_NOT_DJ' ",
                "order_by": "RV_LOW_VALUE",
                "scrollY": "95", 
                "recordBundle": 1,
                "pageLenght": 1, 
                "tableCols": [
                    {
                        "responsivePriority": 1,
                        "data": null,
                        "className": "control toBottom toCenter",
                        "width": "1%",
                        "defaultContent": '' 
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_domain, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_domain; ?>", //Editor
                        "data": 'RV_DOMAIN',
                        "name": 'RV_DOMAIN',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "def": "RH_ACERTO_AUTO",
                        "className": "right visibleColumn",
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "fieldInfo": "",
                        "data": 'RV_LOW_VALUE',
                        "name": 'RV_LOW_VALUE',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "className": "",
                        "def": "DJ_PCT_NOT_DJ"
                    }, {
                        "responsivePriority": 2,
                        "title": "<?php echo mb_strtoupper($ui_seized_min_limit_validation, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_seized_min_limit_validation; ?>", //Editor
                        //"fieldInfo": "<?php echo $hint_limit_payroll_adjustment; ?>",
                        "data": 'RV_ABBREVIATION',
                        "name": 'RV_ABBREVIATION',
                        "defaultContent": "",
                        //"datatype": 'dateYearMonth',
                        "className": "visibleColumn right",
                        "attr": {
                            "class": "form-control toRight",
                            "style": "width: 30%;",
                            "autocomplete": "nope"
                        },
                        "render": function (val, type, row) {
                            if (val !== '') {
                                $('#DJ_PCT_NOT_DJ_wrapper > div:nth-child(4) > div > div > div.dataTables_scrollHead > div > table > thead > tr > th:nth-child(4) > button').hide('slow');
                                return val;                           
                            } else {
                                return '';
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
                            return Val_MIN_PERCENT.crudButtons(true, true, false);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "RV_ABBREVIATION": {
                            number: true,
                        }
                    }
                },
            };
            Val_MIN_PERCENT = new QuadTable();
            Val_MIN_PERCENT.initTable($.extend({}, datatable_instance_defaults, optionsVal_MIN_PERCENT)); 
            //4.6 Limite
            var optionsVal_MIN_LIMIT = {
                "tableId": 'Val_MIN_LIMIT',
                "export": false,
                "table": "CG_REF_CODES",
                //"selectRecordMsg": "<?php echo $ui_please_select_record . $ui_delegation; ?>",            
                "pk": {
                    "primary": {
                        "RV_DOMAIN": {"type": "varchar"},
                        "RV_LOW_VALUE": {"type": "varchar"}
                    }
                },
                //"detailsObjects": [''],
                "initialWhereClause": "RV_DOMAIN = 'RH_ACERTO_AUTO' AND RV_LOW_VALUE = 'DJ_NR_MAX_RMG' ",
                "order_by": "RV_LOW_VALUE",
                "scrollY": "95", 
                "recordBundle": 1,
                "pageLenght": 1, 
                "tableCols": [
                    {
                        "responsivePriority": 1,
                        "data": null,
                        "className": "control toBottom toCenter",
                        "width": "1%",
                        "defaultContent": '' 
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_domain, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_domain; ?>", //Editor
                        "data": 'RV_DOMAIN',
                        "name": 'RV_DOMAIN',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "def": "RH_ACERTO_AUTO",
                        "className": "right visibleColumn",
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "fieldInfo": "",
                        "data": 'RV_LOW_VALUE',
                        "name": 'RV_LOW_VALUE',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                        "className": "",
                        "def": "DJ_NR_MAX_RMG"
                    }, {
                        "responsivePriority": 2,
                        "title": "<?php echo mb_strtoupper($ui_limit, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_limit; ?>", //Editor
                        //"fieldInfo": "<?php echo $hint_limit_payroll_adjustment; ?>",
                        "data": 'RV_ABBREVIATION',
                        "name": 'RV_ABBREVIATION',
                        "defaultContent": "",
                        //"datatype": 'dateYearMonth',
                        "className": "visibleColumn right",
                        "attr": {
                            "class": "form-control toRight",
                            "style": "width: 30%;",
                            "autocomplete": "nope"
                        },
                        "render": function (val, type, row) {
                            if (val !== '') {
                                $('#DJ_NR_MAX_RMG_wrapper > div:nth-child(4) > div > div > div.dataTables_scrollHead > div > table > thead > tr > th:nth-child(4) > button').hide('slow');
                                return val;                           
                            } else {
                                return '';
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
                            return Val_MIN_LIMIT.crudButtons(true, true, false);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "RV_ABBREVIATION": {
                            number: true,
                        }
                    }
                },
            };
            Val_MIN_LIMIT = new QuadTable();
            Val_MIN_LIMIT.initTable($.extend({}, datatable_instance_defaults, optionsVal_MIN_LIMIT)); 
            //END Descontos Judiciais

        }
    });
</script>
