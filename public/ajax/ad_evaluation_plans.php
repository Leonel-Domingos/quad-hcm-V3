<?php
    require_once '../init.php';
    //ATENÇÃO: Processo 66 -- formatar modal da Identificação de Avaliados e verificar restantes opção...
?>
<style>
    #RH_PROCESSOS_AVALIACAO_actions {
        display: inline-block;
        height: 28px;
        padding: 0px 0px 0px 2px !important;
        margin-right: 11px;
        margin-top: -6px;
        border-right: 1px solid rgba(0,0,0,.09);
        border-left: 0px;
    }
    #RH_PROCESSOS_AVALIACAO_actions > div {
        top: -22px;
    }
    #refresh_RH_PROCESSOS_AVALIACAO {
        margin-right: 33px;
    }
    #proc_actions {
        margin-right: 12px;
        height: 26px;
        padding: 2px 12px 1px 9px!important;
    }
    button.dropdown-item.quad-process {
        padding: 5px 15px 0px 15px;
    }
    #RH_PROCESSOS_AVALIACAO_actions > div > div.dropdown-menu.dropdown-menu-animated.fadeindown.show {
        top: 50px !important; 
        left: -149px !important; 
        transform: translate3d(0px, 50px, 0px);
    }
</style>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-end">
                <div class="panel-toolbar pr-3 align-self-end tabs__">
                    <ul id="demo_panel-tabs" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#Tab1" role="tab" aria-selected="true"><?php echo $ui_evaluation_plans; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab2" role="tab" aria-selected="true"><?php echo $ui_process; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab3" role="tab" aria-selected="true"><?php echo $ui_evaluation_sheets; ?></a>
                        </li>
                    </ul>
                </div>
            </div>   
            
            <div class="panel-container show">
                <div class="panel-content">
                    
                    <div class="tab-content">

                         <!-- TAB #1 -->
                        <div class="tab-pane fade active show" id="Tab1" role="tabpanel">
                            <a id="RH_PLANOS_AVALIACAO_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="RH_PLANOS_AVALIACAO" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                        </div>
                         <!-- END TAB #1 -->

                         <!-- TAB #2 -->
                        <div class="tab-pane fade" id="Tab2" role="tabpanel">
                            
                            <!-- FILTER:: Evaluation Plan applied on Processes -->                            
                            <form id="evalProcessesOnGoing" class="inInstanceFilter">
                                <div class="form-row">
                                    <div class="col-md-2 mb-1">
                                        <label  for="xt_DSP_EMPRESA" class=""><?php echo $ui_company; ?></label>
                                        <select name="DSP_EMPRESA" id="xt_DSP_EMPRESA"
                                                class="form-control complexList"
                                                data-db-name="EMPRESA" data-def=""
                                                dependent-group="EMPRESA" dependent-level="1">
                                        </select>
                                    </div>
                                    <div class="col-md-5 mb-4">
                                        <label  for="xt_DSP_PA" class=""><?php echo $ui_evaluation_plan; ?></label>
                                        <select name="DSP_PA" id="xt_DSP_PA"
                                                class="form-control complexList chosen"
                                                data-db-name="EMPRESA@ID_PA@DT_INI_PA" renew=true dependent-group="EMPRESA" dependent-level="2">
                                        </select>
                                    </div>

                                    <div class='alert alert-danger fade in quadAlert' style="display:none;"></div>      
                                </div>
                            </form>
                            <!-- END FILTER :: Evaluation Plan applied on Processes -->
                            
                            <a id="RH_PROCESSOS_AVALIACAO_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <!-- menu com opções -->
                            <div class="widget-toolbar quad" id="RH_PROCESSOS_AVALIACAO_actions" style="display:none">
                                
                                    <div class="btn-group float-xl-right">
                                            <button id="proc_actions" type="button" class="btn contiHeader dropdown-toggle waves-effect waves-themed mt-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                <?php echo $ui_actions; ?>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-animated fadeindown">                                            

                                                <button id="selectAvaliados" class="dropdown-item quad-process" type="button"><?php echo $ui_identification_evaluated;?></button>

                                                <button id="removeAvaliados" class="dropdown-item quad-process" type="button"><?php echo $ui_evaluated_removal;?></button>
                                                <button id="selectAvaliadores" class="dropdown-item quad-process" type="button"><?php echo $ui_selection_evaluators;?></button>
                                                <button id="removeAvaliadores" class="dropdown-item quad-process" type="button"><?php echo $ui_evaluators_removal;?></button>
                                                <button id="distribAvalidoresFases" class="dropdown-item quad-process" type="button"><?php echo $ui_distribution_evaluators_phases;?></button>
                                                <button id="removeAvalidoresFases" class="dropdown-item quad-process" type="button"><?php echo $ui_evaluators_phases_removal;?></button>
                                                <button id="gerarFichasAval" class="dropdown-item quad-process" type="button"><?php echo $ui_generate_evaluation_sheets;?></button>
                                                <button id="removeFichasAval" class="dropdown-item quad-process" type="button"><?php echo $ui_evaluation_sheets_removal;?></button>

                                                <div class="dropdown-divider" style="margin: .25rem 0;"></div>
  
                                            </div>
                                    </div>                                
<!--                                
                                    <div class="btn-group">
                                        <button class="btn dropdown-toggle btn-xs contiHeader"" data-toggle="dropdown">
                                                        <?php echo $ui_actions;?> <i class="fa fa-caret-down"></i>
                                        </button>
                                        <ul class="dropdown-menu pull-right">
                                            <li>
                                                <a id="selectAvaliados" href="javascript:void(0);"><?php echo $ui_identification_evaluated;?></a>
                                            </li>
                                            <li>
                                                <a id="removeAvaliados" href="javascript:void(0);"><?php echo $ui_evaluated_removal;?></a>
                                            </li>
                                            <li>
                                                <a id="selectAvaliadores" href="javascript:void(0);"><?php echo $ui_selection_evaluators;?></a>
                                            </li>
                                            <li>
                                                <a id="removeAvaliadores" href="javascript:void(0);"><?php echo $ui_evaluators_removal;?></a>
                                            </li>
                                            <li>
                                                <a id="distribAvalidoresFases" href="javascript:void(0);"><?php echo $ui_distribution_evaluators_phases;?></a>
                                            </li>
                                            <li>
                                                <a id="removeAvalidoresFases" href="javascript:void(0);"><?php echo $ui_evaluators_phases_removal;?></a>
                                            </li>
                                            <li>
                                                <a id="gerarFichasAval" href="javascript:void(0);"><?php echo $ui_generate_evaluation_sheets;?></a>
                                            </li>
                                            <li>
                                                <a id="removeFichasAval" href="javascript:void(0);"><?php echo $ui_evaluation_sheets_removal;?></a>
                                            </li>
                                        </ul>
                                    </div>-->
                            </div>                               
                            <table id="RH_PROCESSOS_AVALIACAO" class="table responsive table-bordered table-striped table-hover nowrap"></table>

                            
                            <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-start">
                                <div class="panel-toolbar pr-3 align-self-end">
                                    <ul id="panel-tab-2-1" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#Tab21" role="tab" aria-selected="true"><?php echo $ui_technique; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Tab22" role="tab" aria-selected="true"><?php echo $ui_phases; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Tab23" role="tab" aria-selected="true"><?php echo $ui_intervention_matrix; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Tab24" role="tab" aria-selected="true"><?php echo $ui_actors; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Tab25" role="tab" aria-selected="true"><?php echo $ui_agenda; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Tab26" role="tab" aria-selected="true"><?php echo $ui_translate; ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-container show">
                                <div class="panel-content">
                                    <div class="tab-content">
                                        <!-- TAB #2.1 -->
                                        <div class="tab-pane fade active show" id="Tab21" role="tabpanel">
                                            <a id="RH_TECNICAS_AVAL_PROCESSO_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="RH_TECNICAS_AVAL_PROCESSO" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                        </div>
                                        <!-- END TAB #2.1 -->
                                        
                                        <!-- TAB #2.2 -->
                                        <div class="tab-pane fade" id="Tab22" role="tabpanel">
                                            <a id="RH_FASES_PROCESSO_AVAL_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="RH_FASES_PROCESSO_AVAL" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                        </div>                                        
                                        <!-- END TAB #2.2 -->
                                        
                                        <!-- TAB #2.3 -->
                                        <div class="tab-pane fade" id="Tab23" role="tabpanel">
                                            <a id="RH_FASES_FONTES_PROCESSO_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <div class="widget-toolbar quad"  id="RH_FASES_FONTES_PROCESSO_actions" style="display:none">
                                                    <div class="btn-group">
                                                        <button class="btn dropdown-toggle btn-xs contiHeader" data-toggle="dropdown">
                                                                        <?php echo $ui_actions;?> <i class="fa fa-caret-down"></i>
                                                        </button>
                                                        <ul class="dropdown-menu pull-right">
                                                            <li>
                                                                <a id="generateIntervMatrix" href="javascript:void(0);"><?php echo $ui_generate_intervention_matrix;?></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                            </div>                                                         
                                            <table id="RH_FASES_FONTES_PROCESSO" class="table responsive table-bordered table-striped table-hover nowrap"></table>

                                            <div class="row mt-4">
                                                <div class="col-xl-12">
                                                    <div id="panel-51" class="panel">
                                                        <div class="panel-hdr">
                                                            <span class="widget-icon trads"> <i class="fal fa-clone"></i></span>&nbsp;
                                                            <h2><?php echo $ui_teams; ?></h2>
                                                        </div>
                                                        <div class="panel-container show">
                                                            <div class="row mt-4">
                                                                <div class="col-xl-12">
                                                                    <div id="panel-51" class="panel">
                                                                        <div class="panel-hdr">
                                                                            <span class="widget-icon trads"> <i class="fal fa-clone"></i></span>&nbsp;
                                                                            <h2><?php echo $ui_teams; ?></h2>
                                                                        </div>
                                                                        <div class="panel-container show">
                                                                            <div class="panel-content">
                                                                                <a id="RH_FASE_EQP_OBJ_PARTILHADOS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                                                <a id="RH_FASE_EQP_OBJ_PARTILHADOS_PlanoInstitucional" class="btn btn-sm btn-primary toRight" style="margin-right: 2px;" href="#">
                                                                                    <?php echo $ui_institutional_plan; ?>
                                                                                </a>
                                                                                <table id="RH_FASE_EQP_OBJ_PARTILHADOS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row mt-4">
                                                                <div class="col-xl-12">
                                                                    <div id="panel-51" class="panel">
                                                                        <div class="panel-hdr">
                                                                            <span class="widget-icon trads"> <i class="far fa-arrow-alt-from-left"></i></span>&nbsp;
                                                                            <h2><?php echo $ui_team_members; ?></h2>
                                                                        </div>
                                                                        <div class="panel-container show">
                                                                            <div class="panel-content">
                                                                                <a id="RH_EQP_AVALIACOES_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                                                <table id="RH_EQP_AVALIACOES" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>                                        
                                        <!-- END TAB #2.3 -->
                                        
                                        <!-- TAB #2.4 -->
                                        <div class="tab-pane fade" id="Tab24" role="tabpanel">
                                            <div class="row">
                                                <div>
                                                    <!-- Trigger the modal with a button -->
                                                    <!--<button type="button" class="btn btn-success quad-modal" data-title="Modal QUAD" data-url="ajax/dg_filtros.php">PTE</button>-->
                                                    <script>
                                                    /*$('.quad-modal').on('click',function(){
                                                        var el = $(this),tar, htm;

                                                        htm = '<div class="modal fade" id="FiltroQUADPEOPLE" role="dialog">'+
                                                              ' <div class="modal-dialog">'+
                                                              '  <div class="modal-content">'+
                                                              '  <div class="modal-header">'+
                                                             '       <button type="button" class="close" data-dismiss="modal">&times;</button>';
                                                         if (el.data("title")) {
                                                            htm += '       <h4 class="modal-title">'+el.data("title")+'</h4>';
                                                         } 
                                                         htm += '   </div>'+
                                                             '   <div class="modal-body" style="overflow-x: hidden;">'+
                                                             '   </div>'+
                                                            '    <div class="modal-footer">'+
                                                            '        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $ui_close;?></button>'+
                                                            '        <button type="button" class="btn btn-default returnResults"><?php echo $ui_select;?></button>'+
                                                            '    </div>'+
                                                            '</div>'+
                                                            '</div>'+
                                                            '</div>';

                                                        if  (!$(this).next('div.modal').length) {
                                                            $(this).after(htm);
                                                        }
                                                        setTimeout(function(){
                                                            $('.modal-body').load(el.data("url"),function(){
                                                                $('#FiltroQUADPEOPLE').modal({show:true});
                                                            });
                                                        },100);
                                                    }); */
                                                    </script>
                                                </div>
                                                
                                                <div class="row mt-4">
                                                    <div class="col-xl-12">
                                                        <div id="panel-51" class="panel">
                                                            <div class="panel-hdr">
                                                                <span class="widget-icon"> <i class="fal fa-clone"></i></span>&nbsp;
                                                                <h2><?php echo $ui_evaluated; ?></h2>
                                                            </div>
                                                            <div class="panel-container show">
                                                                <div class="panel-content">
                                                                    <a id="RH_AVALIADOS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                                    <table id="RH_AVALIADOS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                                                    <button id="RH_AVALIADOS_remove" class="dropdown-toggle btn-xs contiHeader" style="display: none;" data-toggle="dropdown">
                                                                            <i class="fas fa-times "></i> | <?php echo $ui_remove;?> 
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mt-4">
                                                    <div class="col-xl-12">
                                                        <div id="panel-51" class="panel">
                                                            <div class="panel-hdr">
                                                                <span class="widget-icon"> <i class="far fa-arrow-alt-from-left"></i></span>&nbsp;
                                                                <h2><?php echo $ui_evaluaters; ?></h2>
                                                            </div>
                                                            <div class="panel-container show">
                                                                <div class="panel-content">
                                                                    <a id="RH_AVALIADORES_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                                    <table id="RH_AVALIADORES" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                                                    <button id="RH_AVALIADORES_switch" class="dropdown-toggle btn-xs contiHeader" style="display: none;" data-toggle="dropdown">
                                                                            <i class="fas fa-sync-alt "></i> | <?php echo $ui_switch;?> 
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                                
                                            </div>
                                        </div>                                        
                                        <!-- END TAB #2.4 -->
                                        
                                        <!-- TAB #2.5 -->
                                        <div class="tab-pane fade" id="Tab25" role="tabpanel">
                                            <a id="RH_AVALIADOR_FASES_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="RH_AVALIADOR_FASES" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                        </div>                                        
                                        <!-- END TAB #2.5 -->
                                        
                                        <!-- TAB #2.6 -->
                                        <div class="tab-pane fade" id="Tab26" role="tabpanel">
                                            <a id="RH_PROCESSOS_AVALIACAO_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="RH_PROCESSOS_AVALIACAO_TRADS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                        </div>                                        
                                        <!-- END TAB #2.6 -->
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                         <!-- END TAB #2 -->
                        
                         <!-- TAB #3 -->
                        <div class="tab-pane fade" id="Tab3" role="tabpanel">
                            
                            <!-- FILTER:: Master Evaluation View -->                            
                            <form id="masterEvalView" class="inInstanceFilter">
                                
                                <div class="form-row">
                                    <div class="col-md-2 mb-1">
                                        <label  for="xt_DSP_EMPRESA_1" class=""><?php echo $ui_company; ?></label>
                                        <select name="DSP_EMPRESA_1" id="xt_DSP_EMPRESA_1"
                                                class="form-control complexList"
                                                data-db-name="EMPRESA" data-def=""
                                                dependent-group="EMPRESA" dependent-level="1" >
                                        </select>
                                    </div>

                                    <div class="col-md-5 mb-4">
                                        <label  for="xt_DSP_PA_1" class=""><?php echo $ui_evaluation_plan; ?></label>
                                        <select name="DSP_PA_1" id="xt_DSP_PA_1"
                                                class="form-control complexList chosen"
                                                data-db-name="EMPRESA@ID_PA@DT_INI_PA" renew=true dependent-group="EMPRESA" dependent-level="2">
                                        </select>
                                    </div>

                                    <div class="col-md-5 mb-4">
                                        <label  for="xt_DSP_PROCESSO" class=""><?php echo $ui_evaluation_process; ?></label>
                                        <select name="DSP_PROCESSO" id="xt_DSP_PROCESSO"
                                                class="form-control complexList chosen"
                                                data-db-name="EMPRESA@ID_PA@DT_INI_PA@ID_PROCESSO_AV@DT_INI_PROCESSO" renew=true dependent-group="EMPRESA" dependent-level="3">
                                        </select>
                                    </div>

                                    <div class='alert alert-danger fade in quadAlert' style="display:none;"></div>
                                </div>
                            </form>
                            <!-- END FILTER :: Master Evaluation View -->
                            
                            <a id="MASTER_AVALIACAO_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="MASTER_AVALIACAO" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            
                            <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-start">
                                <div class="panel-toolbar pr-3 align-self-end">
                                    <ul id="panel-tab-3-1" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#Tab31" role="tab" aria-selected="true"><?php echo $ui_detail; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Tab32" role="tab" aria-selected="true"><?php echo $ui_summary; ?></a>
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
                                                    <div id="panel-311" class="panel">
                                                        <div class="panel-hdr">
                                                            <span class="widget-icon"> <i class="far fa-user-chart" style="font-size: 1.1em; padding-top: 11px;"></i> </span>
                                                            <h2><?php echo $ui_evaluation_sheet .' - '.$ui_behaviors; ?></h2>
                                                        </div>
                                                        <div class="panel-container show">
                                                            <div class="panel-content">
                                                                <a id="RH_FICHA_AVAL_COMPORTAMENTOS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                                <table id="RH_FICHA_AVAL_COMPORTAMENTOS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>                                                
                                            
                                            <div class="row mt-4">
                                                <div class="col-xl-12">
                                                    <div id="panel-312" class="panel">
                                                        <div class="panel-hdr">
                                                            <span class="widget-icon"> <i class="far fa-user-chart" style="font-size: 1.1em; padding-top: 11px;"></i> </span>
                                                            <h2><?php echo $ui_evaluation_sheet .' - '.$ui_objectives; ?></h2>
                                                        </div>
                                                        <div class="panel-container show">
                                                            <div class="panel-content">
                                                                <a id="RH_ID_AVALIACAO_OBJECTIVOS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                                <table id="RH_ID_AVALIACAO_OBJECTIVOS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>                                                
                                        </div>
                                        <!-- END TAB #3.1 -->
                                        
                                        <!-- TAB #3.2 -->
                                        <div class="tab-pane fade" id="Tab32" role="tabpanel">
                                            <div class="row mt-4">
                                                <div class="col-xl-12">
                                                    <div id="panel-322" class="panel">
                                                        <div class="panel-hdr">
                                                            <span class="widget-icon"> <i class="far fa-user-chart" style="font-size: 1.1em; padding-top: 11px;"></i> </span>
                                                            <h2><?php echo $ui_evaluation_sheet .' - '.$ui_skills; ?></h2>
                                                        </div>
                                                        <div class="panel-container show">
                                                            <div class="panel-content">
                                                                <a id="RH_RESUME_COMPETENCIAS_FA_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                                <table id="RH_RESUME_COMPETENCIAS_FA" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>                                                

                                            <div class="row mt-4">
                                                <div class="col-xl-12">
                                                    <div id="panel-322" class="panel">
                                                        <div class="panel-hdr">
                                                            <span class="widget-icon"> <i class="far fa-user-chart" style="font-size: 1.1em; padding-top: 11px;"></i> </span>
                                                            <h2><?php echo $ui_evaluation_sheet .' - '.$ui_objectives; ?></h2>
                                                        </div>
                                                        <div class="panel-container show">
                                                            <div class="panel-content">
                                                                <a id="RH_RESUME_OBJECTIVOS_FA_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                                <table id="RH_RESUME_OBJECTIVOS_FA" class="table responsive table-bordered table-striped table-hover nowrap"></table>
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
                    </div>                    
                </div>                    
            </div> 
        </div>
    </div>
</div>


<!--Modal: Name-->
<div class="modal fade" id="switch_AVALIADOR" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fas fa-sync"></i>&nbsp;&nbsp;<?php echo $ui_select_new_evaluator; ?></h4>
            </div>
            <div class="modal-body" style="overflow-x: hidden;">
                <form id="chooseModelForm" class="form-horizontal" novalidate="novalidate">
                    <fieldset style="padding: 35px 30px 35px;">
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="DSP_GD"><?php echo $ui_rhid_assessed; ?></label>
                            <div class="col-md-10">
                                <div id="DSP_AVALIADO" class="form-control" disabled></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="DSP_DET_GD"><?php echo $ui_rhid_assessor; ?></label>
                            <div class="col-md-10">
                                <select name="DSP_NEW_AVALIADOR" id="DSP_NEW_AVALIADOR" class="form-control select chosen"></select>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $ui_close;?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal" id="ChangeAvaliador"><?php echo $ui_switch;?></button>
            </div>
        </div>
    </div>
</div>
<!--Modal: Name-->            
<!--/section-->

<script>
    pageSetUp();

    //Detect Operation required by USER
    function assessementOperation(oper) {
        console.log('Operation '+oper);
    }

    $(document).ready(function () {

        /* MIN VALIDATOR w/CUSTOM MESSAGE EXAMPLE
         $.validator.addMethod('min-length', function (val, element) {
         return this.optional(element) || val.length >= $(element).data('min');
         }, function(params, element) {
         return 'The field cannot be less than than ' + $(element).data('min') + ' length.'
         });
         */

        //Assesment Plan :: TAB #1
        var optionRH_PLANOS_AVALIACAO = {
            "tableId": "RH_PLANOS_AVALIACAO",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_evaluation_plan; ?>",
            "table": "RH_PLANOS_AVALIACAO",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_PA": {"type": "number"},
                    "DT_INI_PA": {"type": "date"}
                }
            },
            "crudOnMasterInactive": {
                "condition": "data.DT_FIM_PA !== null",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },
            "order_by": "EMPRESA, ID_PA, DT_INI_PA desc",
            "recordBundle": 10,
            "pageLenght": 10,
            "scrollY": "312",
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
                    "data": 'ID_PA',
                    "name": 'ID_PA',
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_PA',
                    "name": 'DT_INI_PA',
                    "datatype": 'date',
                    "def": hoje(),
                    "className": "visibleColumn",
                    "attr": {
                        "class": "form-control datepicker"
                    }
                }, {
                    "responsivePriority": 5,
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DSP_PA',
                    "name": 'DSP_PA',
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 6,
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_PA',
                    "name": 'DSR_PA',
                    "className": "visibleColumn",
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_EP',
                    "name": 'ID_EP',
                    "type": "hidden",
                    "visible": false,
                    "className": "visibleColumn",
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
                    "data": 'DSP_EP_SMALL',
                    "name": 'DSP_EP_SMALL',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "EMPRESA",
                        "dependent-level": 2,
                        "data-db-name": 'A.EMPRESA@A.ID_EP@A.DT_INI_EP',
                        "decodeFromTable": 'RH_DEF_ESCALAS_PROFICIENCIA A',
                        "desigColumn": "A.DSP_EP", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.                        
                        "orderBy": "A.ID_EP", //usado no complexList.php
                        "class": "form-control complexList chosen small",
                        //"disabled": true, //Permite inibir o campo no Editor
                        "filter": {
                            "create": ' AND A.DT_FIM_EP IS NULL', //On-New-Record
                            "edit": ' AND A.DT_FIM_EP IS NULL', //On-Edit-Record
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
                        "name": 'DESCRICAO',
                        "style": "max-width: 335px",
                        "class": "form-control defaultWidth",
                    }
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM_PA',
                    "name": 'DT_FIM_PA',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "form-control datepicker"
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
                    //"targets": 16,
                    "responsivePriority": 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        //debugger;
                        return RH_PLANOS_AVALIACAO.crudButtons(true, true, true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DSP_EMPRESA": {
                        required: true
                    },
                    "ID_PA": {
                        required: true,
                        integer: true,
                    },
                    "DT_INI_PA": {
                        required: true,
                        dateISO: true,
                    },
                    "DSP_PA": {
                        required: true,
                        maxlength: 80,
                    },
                    "DSR_PA": {
                        maxlength: 25,
                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                    "DT_FIM_PA": {
                        dateISO: true,
                        dateEqOrNextThan: 'DT_INI_PA',
                    }
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                    "DT_FIM_PA": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        RH_PLANOS_AVALIACAO = new QuadTable();
        RH_PLANOS_AVALIACAO.initTable($.extend({}, datatable_instance_defaults, optionRH_PLANOS_AVALIACAO));
        //END Assesment Plan :: TAB #1

        //EVENTS :: Assesment Process      
        //Starts by DECLARING LOCAL Validation RULES:
        if (1 === 1) {
            // 1. PROCESS begin date should be smaller or equal to begin evaluation date
            $.validator.addMethod("INI_PROCESSO", function (value, element, param) {
                var frm_context = "#RH_PROCESSOS_AVALIACAO_editorForm",
                        operacao = RH_PROCESSOS_AVALIACAO.editor.s["action"], //PREVIOUS VERSION -> RH_PROCESSOS_AVALIACAO.editor.s.editOpts["action"];
                        target = $('[name=' + param + ']'), x = new Date(value), y = new Date(target.val());
                if (operacao !== 'query') {
                    if (x !== '') { //Process start date
                        if (y !== '') { //Assessment begin date
                            if (+x > +y) {
                                return false;
                            }
                        }
                    }
                }
                return true;
            }, function (params, element) {
                var ms = "<?php echo $error_dt_eq_smaller_than; ?>", frm_context = "#RH_PROCESSOS_AVALIACAO_editorForm";
                ms = ms.replace("{0}", $('#DTE_Field_DT_INI_AVALIACAO', frm_context).val());
                return ms;
            });

            // 2. PROCESS end date should be greater or equal to end evaluation date
            $.validator.addMethod("FIM_PROCESSO", function (value, element, param) {
                var frm_context = "#RH_PROCESSOS_AVALIACAO_editorForm",
                        operacao = RH_PROCESSOS_AVALIACAO.editor.s["action"], //PREVIOUS VERSION -> RH_PROCESSOS_AVALIACAO.editor.s.editOpts["action"];
                        target = $('[name=' + param + ']'), x = new Date(value), y = new Date(target.val());
                if (operacao !== 'query') {
                    if (x !== '') { //Process start date
                        if (y !== '') { //Assessment begin date
                            if (+x < +y) {
                                return false;
                            }
                        }
                    }
                }
                return true;
            }, function (params, element) {
                var ms = "<?php echo $error_dt_eq_smaller_than; ?>", frm_context = "#RH_PROCESSOS_AVALIACAO_editorForm";
                ms = ms.replace("{0}", $('#DTE_Field_DT_FIM_AVALIACAO', frm_context).val());
                return ms;
            });
        }
        //END DECLARING LOCAL Validation RULES

        //Assesment Process :: TAB #2 :: Editor VALIDATION events
        var optionsRH_PROCESSOS_AVALIACAO = {
            "tableId": "RH_PROCESSOS_AVALIACAO",
            "table": "RH_PROCESSOS_AVALIACAO",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_evaluation_process; ?>",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_PA": {"type": "number"},
                    "DT_INI_PA": {"type": "date"},
                    "ID_PROCESSO_AV": {"type": "number"},
                    "DT_INI_PROCESSO": {"type": "date"}
                }
            },
            "externalFilter": {
                "template": {
                    "selector": "#evalProcessesOnGoing",
                    "mandatory": ['DSP_EMPRESA'], //, 'DSP_DIRECAO', 'DSP_DEPT'], //mandatory
                    "optional": ['DSP_PA']
                }
            },
            "detailsObjects": ['RH_PROCESSOS_AVALIACAO_TRADS', 'RH_TECNICAS_AVAL_PROCESSO', 'RH_FASES_PROCESSO_AVAL', 'RH_FASES_FONTES_PROCESSO','RH_AVALIADOS','RH_AVALIADOR_FASES'],
            "order_by": "ID_PROCESSO_AV, DT_INI_PROCESSO DESC",
            "recordBundle": 8,
            "pageLenght": 8,
            "scrollY": "234", //"156",
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
                        "decodeFromTable": "DG_EMPRESAS A", //TO CHANGE ON QUAD-HCM
                        "desigColumn": "A.EMPRESA",
                        "orderBy": "A.NR_ORDEM",
                        "class": "form-control complexList chosen"
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_PA',
                    "name": 'ID_PA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_PA',
                    "name": 'DT_INI_PA',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 3,
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_evaluation_plan, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_evaluation_plan; ?>",
                    "data": 'DSP_PA',
                    "name": 'DSP_PA',
                    "type": "select",
                    "className": "visibleColumn",
                    "renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "EMPRESA",
                        "dependent-level": 2,
                        "data-db-name": "A.EMPRESA@A.ID_PA@A.DT_INI_PA",
                        "decodeFromTable": "RH_PLANOS_AVALIACAO A", //TO CHANGE ON QUAD-HCM
                        "desigColumn": "A.DSP_PA",
                        'whereClause': '',
                        "orderBy": "A.EMPRESA, A.DT_INI_PA desc",
                        "class": "form-control complexList chosen",
                        "allowUpdate":true,
                        "filter": {
                            "create": " AND A.DT_FIM_PA IS NULL", //On-New-Record
                            "edit": " AND A.DT_FIM_PA IS NULL", //On-Edit-Record
                        }
                    }
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'ID_PROCESSO_AV',
                    "name": 'ID_PROCESSO_AV',
                    "className": "visibleColumn",
                }, {
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DSP_PROCESSO',
                    "name": 'DSP_PROCESSO',
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_PROCESSO',
                    "name": 'DSR_PROCESSO',
                    "className": "visibleColumn"
                }, {
                    "title": "<?php echo mb_strtoupper($ui_hierarchy, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_hierarchy; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_assessment_hierarchy; ?>", //Editor
                    "data": 'TREE_AVALIADOR',
                    "name": 'TREE_AVALIADOR',
                    "type": "select",
                    "def": "A",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'GE_TREE_AVALIADOR',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['GE_TREE_AVALIADOR'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }           
                }, {
                    /* INSTANCE FUNCTION */
                    "func": true,
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_state, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_state; ?>", //Editor
                    "data": 'GE_ESTADO_PROC_AVALIACAO(EMPRESA,ID_PA,DT_INI_PA,ID_PROCESSO_AV,DT_INI_PROCESSO)',
                    "name": 'GE_ESTADO_PROC_AVALIACAO(EMPRESA,ID_PA,DT_INI_PA,ID_PROCESSO_AV,DT_INI_PROCESSO)', 
                    "type": "hidden",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'GE_ESTADO_PROC_AVAL',
                    },
                    "render": function (val, type, row) {
                        if (val !== null) {
                            var o = _.find(initApp.joinsData['GE_ESTADO_PROC_AVAL'], {'RV_LOW_VALUE': val});
                            return val === null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }           
                }, {
                    "responsivePriority": 5,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_PROCESSO',
                    "name": 'DT_INI_PROCESSO',
                    "datatype": 'date',
                    "def": hoje(),
                    "className": "visibleColumn",
                    "attr": {
                        "name": 'DT_INI_PROCESSO',
                        "class": "form-control datepicker"
                    }                        
                }, {
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>" + "</span>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM_PROCESSO',
                    "name": 'DT_FIM_PROCESSO',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "form-control datepicker"
                    }
                }, {
                    "title": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_assessment, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_assessment, 'UTF-8'); ?>" + "</span>", //Editor
                    "data": '',
                    "name": 'TIT_PER_AVALIACAO',
                    "type": "readonly",
                    "className": "none",
                    "defaultContent": "", //Must be used on STATIC columns content. On this case classes make there way...
                    "attr": {
                        "style": "display: none;"
                    }                      
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>" + "</span>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_AVALIACAO',
                    "name": 'DT_INI_AVALIACAO',
                    "datatype": 'date',
                    "def": hoje(),
                    "className": "none editorSubTitle visibleColumn",
                    "attr": {
                        "name": 'DT_INI_AVALIACAO',
                        "class": "form-control datepicker"
                    }
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>" + "</span>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM_AVALIACAO',
                    "name": 'DT_FIM_AVALIACAO',
                    "datatype": 'date',
                    "def": hoje(),
                    "className": "none editorSubTitle visibleColumn",
                    "attr": {
                        "class": "form-control datepicker"
                    }
                }, {
                    "title": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_skills_assessment, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_skills_assessment, 'UTF-8'); ?>" + "</span>", //Editor
                    //"fieldInfo": "<?php echo $hint_requires_previous_authorizarion; ?>",
                    "data": 'AVAL_COMPETENCIAS',
                    "name": 'AVAL_COMPETENCIAS',
                    "type": "select",
                    "def": "N",
                    "className": "none visibleColumn",
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
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_functional_group, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<?php echo $ui_functional_group; ?>", //Editor
                    "data": 'AC_GRP_FUNCIONAL',
                    "name": 'AC_GRP_FUNCIONAL',
                    "type": "select",
                    "def": "N",
                    "className": "none editorSubTitle visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',
                        "class": "form-control ac"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_SIM_NAO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_structure, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<?php echo $ui_structure; ?>", //Editor
                    "data": 'AC_ESTRUTURA',
                    "name": 'AC_ESTRUTURA',
                    "type": "select",
                    "def": "N",
                    "className": "none editorSubTitle visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',
                        "class": "form-control ac"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_SIM_NAO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_function, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<?php echo $ui_function; ?>", //Editor
                    "data": 'AC_FUNCAO',
                    "name": 'AC_FUNCAO',
                    "type": "select",
                    "def": "N",
                    "className": "none editorSubTitle visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',
                        "class": "form-control ac"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_SIM_NAO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_personal, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<?php echo $ui_personal; ?>", //Editor
                    "data": 'AC_COLABORADOR',
                    "name": 'AC_COLABORADOR',
                    "type": "select",
                    "def": "N",
                    "className": "none editorSubTitle visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',
                        "class": "form-control ac"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_SIM_NAO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_weight, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<?php echo $ui_weight; ?>", //Editor
                    "data": 'PESO_AC',
                    "name": 'PESO_AC',
                    "className": "none editorSubTitle visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 30%;"
                    }
                }, {
                    "title": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_objectives_assessment, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_objectives_assessment, 'UTF-8'); ?>" + "</span>", //Editor
                    //"fieldInfo": "<?php echo $hint_requires_previous_authorizarion; ?>",
                    "data": 'AVAL_OBJECTIVOS',
                    "name": 'AVAL_OBJECTIVOS',
                    "type": "select",
                    "def": "N",
                    "className": "none visibleColumn",
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
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_functional_group, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<?php echo $ui_functional_group; ?>", //Editor
                    "data": 'AO_GRP_FUNCIONAL',
                    "name": 'AO_GRP_FUNCIONAL',
                    "type": "select",
                    "def": "N",
                    "className": "none editorSubTitle visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',
                        "class": "form-control ao"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_SIM_NAO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_structure, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<?php echo $ui_structure; ?>", //Editor
                    "data": 'AO_ESTRUTURA',
                    "name": 'AO_ESTRUTURA',
                    "type": "select",
                    "def": "N",
                    "className": "none editorSubTitle visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',
                        "class": "form-control ao"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_SIM_NAO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_function, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<?php echo $ui_function; ?>", //Editor
                    "data": 'AO_FUNCAO',
                    "name": 'AO_FUNCAO',
                    "type": "select",
                    "def": "N",
                    "className": "none editorSubTitle visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',
                        "class": "form-control ao"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_SIM_NAO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_personal, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<?php echo $ui_personal; ?>", //Editor
                    "data": 'AO_COLABORADOR',
                    "name": 'AO_COLABORADOR',
                    "type": "select",
                    "def": "N",
                    "className": "none editorSubTitle visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',
                        "class": "form-control ao"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_SIM_NAO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_weight, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<?php echo $ui_weight; ?>", //Editor
                    "data": 'PESO_AO',
                    "name": 'PESO_AO',
                    "className": "none editorSubTitle visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 30%;"
                    }
                }, {
                    "title": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_shared_objectives_assessment, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_shared_objectives_assessment, 'UTF-8'); ?>" + "</span>", //Editor
                    "data": 'AVAL_OBJ_PARTILHADOS',
                    "name": 'AVAL_OBJ_PARTILHADOS',
                    "type": "select",
                    "def": "N",
                    "className": "none visibleColumn",
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
                    "title": "<?php echo mb_strtoupper($ui_committee, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_committee; ?>", //Editor
                    "data": 'COMITE',
                    "name": 'COMITE',
                    "type": "select",
                    "def": "Z",
                    "className": "none visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'RH_PROCESSOS_AVALIACAO.COMITE',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['RH_PROCESSOS_AVALIACAO.COMITE'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": "RHID",
                    "name": "RHID",
                    "type": "hidden",
                    "visible": false,
                    "className": ""
                }, {
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_responsible, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_responsible; ?>",
                    "fieldInfo": "<?php echo $hint_assessment_responsable; ?>",
                    "data": 'NOME_REDZ',
                    "name": 'NOME_REDZ',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                                        
                    "attr": {
                        "dependent-group": "EMPRESA",
                        "dependent-level": 2,
                        //"deferred": true,
                        "data-db-name": 'A.EMPRESA@A.RHID',
                        "decodeFromTable": 'QUAD_PEOPLE A',
                        "desigColumn": "CONCAT(CONCAT(A.RHID,'-'),A.NOME_REDZ)", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.                        
                        "orderBy": "A.RHID", //usado no complexList.php
                        "class": "form-control complexList chosen",
                        //"disabled": true, //Permite inibir o campo no Editor
                        "filter": {
                            "create": " AND A.ATIVO = 'S'", //On-New-Record
                            "edit": " AND A.ATIVO = 'S'", //On-Edit-Record
                            /*
                             "create": " AND ATIVO = 'S' AND EMPRESA = ':EMPRESA'", //On-New-Record
                             "edit": " AND ATIVO = 'S' AND EMPRESA = ':EMPRESA'", //On-Edit-Record
                             */
                        }
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_objectives, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_objectives; ?>", //Editor
                    "data": 'OBJECTIVOS',
                    "name": 'OBJECTIVOS',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 295px",
                        "class": "form-control defaultWidth",
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_disclose, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_disclose; ?>", //Editor
                    "data": 'PUB_RESULTADOS',
                    "name": 'PUB_RESULTADOS',
                    "type": "select",
                    "def": "A",
                    "className": "none visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'RH_PROCESSOS_AVALIACAO.PUB_RESULTADOS',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['RH_PROCESSOS_AVALIACAO.PUB_RESULTADOS'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }

                }, {
                    "title": "<?php echo mb_strtoupper($ui_pdi_creation, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_pdi_creation; ?>", //Editor
                    "data": 'GERACAO_PDI',
                    "name": 'GERACAO_PDI',
                    "type": "select",
                    "def": "A",
                    "className": "none visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'RH_PROCESSOS_AVALIACAO.GERACAO_PDI',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['RH_PROCESSOS_AVALIACAO.GERACAO_PDI'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }


                }, {
                    //"targets": 31,
                    "title": "<?php echo mb_strtoupper($ui_description, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DESCRICAO',
                    "name": 'DESCRICAO',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "name": 'DESCRICAO',
                        "style": "max-width: 295px",
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
                    "title": "<?php echo mb_strtoupper($ui_publish, 'UTF-8'); ?>", //Datatables
//                    "label": "<?php echo $ui_publish; ?>", //Editor
                    "data": 'RESULTADOS_PUB',
                    "name": 'RESULTADOS_PUB',
                    "className": "toCenter",
                    "def": 'N',
                    "attr": {
                        "style": "display: none;"
                    },
                    "render": function (val, type, row) {
                        if (row['PUB_RESULTADOS'] === 'C') { // publicação manual
                            var ref_ = row['EMPRESA'] + '@' + row['ID_PA'] + '@' + row['DT_INI_PA'] + '@' + row['ID_PROCESSO_AV'] + '@' + row['DT_INI_PROCESSO'];
                            if (row['RESULTADOS_PUB'] === 'N') {
                                return '<button id="publishResults" class="btn btn-xs btn-default publishButton" data-process-ref="' + 
                                        ref_
                                        + '" title="<?php echo $ui_create;?>"><i class="far fa-thumbs-up"></i></button>'+
                                        '<button id="unpublishResults" disabled class="btn btn-xs btn-default publishButton" data-process-ref="' + 
                                        ref_
                                        + '" title="<?php echo $ui_remove;?>"><i class="far fa-thumbs-down"></i></button>';
                            } else {
                                return '<button id="publishResults" disabled class="btn btn-xs btn-default publishButton" data-process-ref="' + 
                                        ref_
                                        + '" title="<?php echo $ui_create;?>"><i class="far fa-thumbs-up"></i></button>'+
                                        '<button id="unpublishResults" class="btn btn-xs btn-default publishButton" data-process-ref="' + 
                                        ref_
                                        + '" title="<?php echo $ui_remove;?>"><i class="far fa-thumbs-down"></i></button>';
                            }    
                        } else {
                            return '';                    
                        }
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
                        return RH_PROCESSOS_AVALIACAO.crudButtons(true, true, true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DSP_EMPRESA": {
                        required: true
                    },
                    "DSP_PA": {
                        required: true
                    },
                    "TREE_AVALIADOR": {
                        required: true
                    },                        
                    "ID_PROCESSO_AV": {
                        number: true,
                        required: true,
                    },
                    "DSP_PROCESSO": {
                        required: true,
                        maxlength: 80,
                    },
                    "DSR_PROCESSO": {
                        required: false,
                        maxlength: 25,
                    },
                    "AVAL_COMPETENCIAS": {
                        required: true
                    },
                    "AC_GRP_FUNCIONAL": {
                        required: true
                    },
                    "AC_ESTRUTURA": {
                        required: true
                    },
                    "AC_FUNCAO": {
                        required: true
                    },
                    "AC_COLABORADOR": {
                        required: true
                    },
                    "AVAL_OBJECTIVOS": {
                        required: true
                    },
                    "AO_GRP_FUNCIONAL": {
                        required: true
                    },
                    "AO_ESTRUTURA": {
                        required: true
                    },
                    "AO_FUNCAO": {
                        required: true
                    },
                    "AO_COLABORADOR": {
                        required: true
                    },
                    "AVAL_OBJ_PARTILHADOS": {
                        required: true
                    },
                    "COMITE": {
                        required: true
                    },
                    "PESO_AC": {
                        number: true,
                    },
                    "PESO_AO": {
                        number: true,
                    },
                    "OBJECTIVOS": {
                        required: false,
                        maxlength: 4000,
                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                    "DT_INI_PROCESSO": {
                        required: true,
                        dateISO: true,
                        prodDateEqOrLessThan: "DT_INI_AVALIACAO"
                    },
                    "DT_INI_AVALIACAO": {
                        required: true,
                        dateISO: true,
                        dateEqOrNextThan: "DT_INI_PROCESSO",
                        prodDateEqOrLessThan: "DT_FIM_PROCESSO"
                    },
                    "DT_FIM_AVALIACAO": {
                        required: true,
                        dateISO: true,
                        dateEqOrNextThan: "DT_INI_AVALIACAO",
                        prodDateEqOrLessThan: "DT_FIM_PROCESSO"
                    },
                    "DT_FIM_PROCESSO": {
                        required: true,
                        dateISO: true,
                        dateEqOrNextThan: "DT_INI_PROCESSO",
                        prodDateEqOrNextThan: "DT_FIM_AVALIACAO"
                    }
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                    "DT_INI_PROCESSO": {
                        prodDateEqOrLessThan: "<?php echo $error_proc_begin_dt_smaller_than_eval_process_begin; ?>"
                    },
                    "DT_INI_AVALIACAO": {
                        dateEqOrNextThan: "<?php echo $error_eval_begin_dt_eq_greater_than_begin_process_dt; ?>",
                        prodDateEqOrLessThan: "<?php echo $error_eval_begin_dt_smaller_than_end_process_dt; ?>"
                    },
                    "DT_FIM_AVALIACAO": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>",
                        prodDateEqOrLessThan: "<?php echo $error_eval_end_dt_smaller_than_end_process_dt; ?>"
                    },
                    "DT_FIM_PROCESSO": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        RH_PROCESSOS_AVALIACAO = new QuadTable();
        RH_PROCESSOS_AVALIACAO.initTable($.extend({}, datatable_instance_defaults, optionsRH_PROCESSOS_AVALIACAO));

        //Assesment Process :: Editor VALIDATION events :: EDITOR MANIPULATION
        if (1 === 1) {
            $(document).on('RH_PROCESSOS_AVALIACAOAttachEvt', function (e) {
                var frm_context = "#RH_PROCESSOS_AVALIACAO_editorForm", dt_1 = '', dt_2 = '', operacao = RH_PROCESSOS_AVALIACAO.editor.s["action"]; //PREVIOUS VERSION -> RH_PROCESSOS_AVALIACAO.editor.s.editOpts["action"];

                //:: TO DO :: Control needs to be implemented in order to allow changes ONLY if PROCESS hasn't yet begun

                //Process MODEL Chosen
                if (1 === 1) {
                    //Process Assessment model :: Assessment
                    $('#DTE_Field_AVAL_COMPETENCIAS', frm_context).on("change", function (e) {
                        var no_value = 'N', yes_value = 'N', valor = $('#DTE_Field_AVAL_COMPETENCIAS', frm_context).val();
                        if (operacao !== 'query') {
                            if (valor === 'S') {
                                $('#DTE_Field_AC_GRP_FUNCIONAL', frm_context).prop('disabled', false);
//                                    $('#DTE_Field_AC_GRP_FUNCIONAL', frm_context).val(yes_value); //Default value
                                $('#DTE_Field_AC_ESTRUTURA', frm_context).prop('disabled', false);
//                                    $('#DTE_Field_AC_ESTRUTURA', frm_context).val(no_value);
                                $('#DTE_Field_AC_FUNCAO', frm_context).prop('disabled', false);
//                                    $('#DTE_Field_AC_FUNCAO', frm_context).val(no_value);
                                $('#DTE_Field_AC_COLABORADOR', frm_context).prop('disabled', false);
//                                    $('#DTE_Field_AC_COLABORADOR', frm_context).val(no_value);
                                $('#DTE_Field_PESO_AC', frm_context).prop('disabled', false);
//                                    $('#DTE_Field_PESO_AC', frm_context).val('');

                                // Other models reset
/*
                                $('#DTE_Field_AVAL_OBJECTIVOS', frm_context).val(no_value);
                                $('#DTE_Field_AO_GRP_FUNCIONAL', frm_context).prop('disabled', false);
                                $('#DTE_Field_AO_GRP_FUNCIONAL', frm_context).val(no_value);
                                $('#DTE_Field_AO_ESTRUTURA', frm_context).prop('disabled', true);
                                $('#DTE_Field_AO_ESTRUTURA', frm_context).val(no_value);
                                $('#DTE_Field_AO_FUNCAO', frm_context).prop('disabled', true);
                                $('#DTE_Field_AO_FUNCAO', frm_context).val(no_value);
                                $('#DTE_Field_AO_COLABORADOR', frm_context).prop('disabled', true);
                                $('#DTE_Field_AO_COLABORADOR', frm_context).val(no_value);
                                $('#DTE_Field_PESO_AO', frm_context).prop('disabled', true);
                                $('#DTE_Field_PESO_AO', frm_context).val('');
*/                

                                $('#DTE_Field_AVAL_OBJ_PARTILHADOS', frm_context).val(no_value);
                            } else {
                                $('#DTE_Field_AC_GRP_FUNCIONAL', frm_context).prop('disabled', true);
                                $('#DTE_Field_AC_GRP_FUNCIONAL', frm_context).val(no_value);
                                $('#DTE_Field_AC_ESTRUTURA', frm_context).prop('disabled', true);
                                $('#DTE_Field_AC_ESTRUTURA', frm_context).val(no_value);
                                $('#DTE_Field_AC_FUNCAO', frm_context).prop('disabled', true);
                                $('#DTE_Field_AC_FUNCAO', frm_context).val(no_value);
                                $('#DTE_Field_AC_COLABORADOR', frm_context).prop('disabled', true);
                                $('#DTE_Field_AC_COLABORADOR', frm_context).val(no_value);
                                $('#DTE_Field_PESO_AC', frm_context).prop('disabled', true);
                                $('#DTE_Field_PESO_AC', frm_context).val('');
                            }
                        }
                    });
                    //END VALIDATION :: Process Assessment model :: Assessment

                    //Process Assessment model :: Objectives
                    $('#DTE_Field_AVAL_OBJECTIVOS', frm_context).on("change", function (e) {
                        var no_value = 'N', yes_value = 'N', valor = $('#DTE_Field_AVAL_OBJECTIVOS', frm_context).val();
                        if (operacao !== 'query') {
                            if (valor === 'S') {

                                $('#DTE_Field_AO_GRP_FUNCIONAL', frm_context).prop('disabled', false);
//                                    $('#DTE_Field_AO_GRP_FUNCIONAL', frm_context).val(yes_value); //Default value
                                $('#DTE_Field_AO_ESTRUTURA', frm_context).prop('disabled', false);
//                                    $('#DTE_Field_AO_ESTRUTURA', frm_context).val(no_value);
                                $('#DTE_Field_AO_FUNCAO', frm_context).prop('disabled', false);
//                                    $('#DTE_Field_AO_FUNCAO', frm_context).val(no_value);
                                $('#DTE_Field_AO_COLABORADOR', frm_context).prop('disabled', false);
//                                    $('#DTE_Field_AO_COLABORADOR', frm_context).val(no_value);
                                $('#DTE_Field_PESO_AO', frm_context).prop('disabled', false);
//                                    $('#DTE_Field_PESO_AO', frm_context).val('');

                                // Other models reset
/*                                    $('#DTE_Field_AVAL_COMPETENCIAS', frm_context).val(no_value);
                                $('#DTE_Field_AC_GRP_FUNCIONAL', frm_context).prop('disabled', true);
                                $('#DTE_Field_AC_GRP_FUNCIONAL', frm_context).val(no_value);
                                $('#DTE_Field_AC_ESTRUTURA', frm_context).prop('disabled', true);
                                $('#DTE_Field_AC_ESTRUTURA', frm_context).val(no_value);
                                $('#DTE_Field_AC_FUNCAO', frm_context).prop('disabled', true);
                                $('#DTE_Field_AC_FUNCAO', frm_context).val(no_value);
                                $('#DTE_Field_AC_COLABORADOR', frm_context).prop('disabled', true);
                                $('#DTE_Field_AC_COLABORADOR', frm_context).val(no_value);
                                $('#DTE_Field_PESO_AC', frm_context).prop('disabled', true);
                                $('#DTE_Field_PESO_AC', frm_context).val('');
*/
                                $('#DTE_Field_AVAL_OBJ_PARTILHADOS', frm_context).val(no_value);
                            } else {
                                $('#DTE_Field_AO_GRP_FUNCIONAL', frm_context).prop('disabled', true);
                                $('#DTE_Field_AO_GRP_FUNCIONAL', frm_context).val(no_value);
                                $('#DTE_Field_AO_ESTRUTURA', frm_context).prop('disabled', true);
                                $('#DTE_Field_AO_ESTRUTURA', frm_context).val(no_value);
                                $('#DTE_Field_AO_FUNCAO', frm_context).prop('disabled', true);
                                $('#DTE_Field_AO_FUNCAO', frm_context).val(no_value);
                                $('#DTE_Field_AO_COLABORADOR', frm_context).prop('disabled', true);
                                $('#DTE_Field_AO_COLABORADOR', frm_context).val(no_value);
                                $('#DTE_Field_PESO_AO', frm_context).prop('disabled', true);
                                $('#DTE_Field_PESO_AO', frm_context).val('');
                            }
                        }
                    });
                    //END VALIDATION :: Process Assessment model :: Objectives

                    //Process Assessment model :: Shared Objectives
                    $('#DTE_Field_AVAL_OBJ_PARTILHADOS', frm_context).on("change", function (e) {
                        var no_value = 'N', yes_value = 'N', valor = $('#DTE_Field_AVAL_OBJ_PARTILHADOS', frm_context).val();
                        if (operacao !== 'query' && valor === 'S') {
                            // Other models reset
                            $('#DTE_Field_AVAL_COMPETENCIAS', frm_context).val(no_value);
                            $('#DTE_Field_AC_GRP_FUNCIONAL', frm_context).prop('disabled', true);
                            $('#DTE_Field_AC_GRP_FUNCIONAL', frm_context).val(no_value);
                            $('#DTE_Field_AC_ESTRUTURA', frm_context).prop('disabled', true);
                            $('#DTE_Field_AC_ESTRUTURA', frm_context).val(no_value);
                            $('#DTE_Field_AC_FUNCAO', frm_context).prop('disabled', true);
                            $('#DTE_Field_AC_FUNCAO', frm_context).val(no_value);
                            $('#DTE_Field_AC_COLABORADOR', frm_context).prop('disabled', true);
                            $('#DTE_Field_AC_COLABORADOR', frm_context).val(no_value);
                            $('#DTE_Field_PESO_AC', frm_context).prop('disabled', true);
                            $('#DTE_Field_PESO_AC', frm_context).val('');
                            $('#DTE_Field_AVAL_OBJECTIVOS', frm_context).val(no_value);
                            $('#DTE_Field_AO_GRP_FUNCIONAL', frm_context).prop('disabled', true);
                            $('#DTE_Field_AO_GRP_FUNCIONAL', frm_context).val(no_value);
                            $('#DTE_Field_AO_ESTRUTURA', frm_context).prop('disabled', true);
                            $('#DTE_Field_AO_ESTRUTURA', frm_context).val(no_value);
                            $('#DTE_Field_AO_FUNCAO', frm_context).prop('disabled', true);
                            $('#DTE_Field_AO_FUNCAO', frm_context).val(no_value);
                            $('#DTE_Field_AO_COLABORADOR', frm_context).prop('disabled', true);
                            $('#DTE_Field_AO_COLABORADOR', frm_context).val(no_value);
                            $('#DTE_Field_PESO_AO', frm_context).prop('disabled', true);
                            $('#DTE_Field_PESO_AO', frm_context).val('');
                        }
                    });
                    //END VALIDATION :: Process Assessment model:: Shared Objectives
                }
                //END Process Model Chosen

                //Process Detail(s) Choice
                if (1 === 1) {

                    //Skill Assessment choice
                    $('.ac', frm_context).on("change", function (e) {
                        var x = $(this);
                        if (x && x.val() === 'S') {
                            $('.ac').each(function (index) {
                                if (x.prop('id') !== $(this).prop('id')) {
                                    $(this).val('N');
                                }
                            });
                        }
                    });
                    //END Skill Assessment choice

                    //Objectives Assessment choice
                    $('.ao', frm_context).on("change", function (e) {
                        var x = $(this);
                        if (x && x.val() === 'S') {
                            $('.ao').each(function (index) {
                                if (x.prop('id') !== $(this).prop('id')) {
                                    $(this).val('N');
                                }
                            });
                        }
                    });
                    //END /Objectives Assessment choice

                }
                //END Process Detail(s) Choice
            });

            // configura as ações do processo de avaliação consoante o seu estado
            function config_RH_PROCESSOS_AVALIACAO_actions(estado_) {
                /*
                 * ESTADO:
                 *     A - Identificação Avaliados
                 *     B - Seleção Avaliadores
                 *     C - Distribuição Avaliadores p/ Fase
                 *     D - Geração Fichas
                 *     E - Em execução
                 *     F - Terminada
                 */    
                $("#RH_FASES_FONTES_PROCESSO_actions").hide();
                if (estado_ === 'A') {
                    $("#selectAvaliados").removeClass("forbidden-bc-grey");
                    $("#removeAvaliados").addClass("forbidden-bc-grey");
                    $("#selectAvaliadores").addClass("forbidden-bc-grey");
                    $("#removeAvaliadores").addClass("forbidden-bc-grey");
                    $("#distribAvalidoresFases").addClass("forbidden-bc-grey");
                    $("#removeAvalidoresFases").addClass("forbidden-bc-grey");
                    $("#gerarFichasAval").addClass("forbidden-bc-grey");
                    $("#removeFichasAval").addClass("forbidden-bc-grey");
                    //$("#RH_FASES_FONTES_PROCESSO_actions").show();
                } else if (estado_ === 'B') {
                    $("#selectAvaliados").addClass("forbidden-bc-grey");
                    $("#removeAvaliados").removeClass("forbidden-bc-grey");
                    $("#selectAvaliadores").removeClass("forbidden-bc-grey");
                    $("#removeAvaliadores").addClass("forbidden-bc-grey");
                    $("#distribAvalidoresFases").addClass("forbidden-bc-grey");
                    $("#removeAvalidoresFases").addClass("forbidden-bc-grey");
                    $("#gerarFichasAval").addClass("forbidden-bc-grey");
                    $("#removeFichasAval").addClass("forbidden-bc-grey");
                } else if (estado_ === 'C') {
                    $("#selectAvaliados").addClass("forbidden-bc-grey");
                    $("#removeAvaliados").addClass("forbidden-bc-grey");
                    $("#selectAvaliadores").addClass("forbidden-bc-grey");
                    $("#removeAvaliadores").removeClass("forbidden-bc-grey");
                    $("#distribAvalidoresFases").removeClass("forbidden-bc-grey");
                    $("#removeAvalidoresFases").addClass("forbidden-bc-grey");
                    $("#gerarFichasAval").addClass("forbidden-bc-grey");
                    $("#removeFichasAval").addClass("forbidden-bc-grey");
                } else if (estado_ === 'D') {
                    $("#selectAvaliados").addClass("forbidden-bc-grey");
                    $("#removeAvaliados").addClass("forbidden-bc-grey");
                    $("#selectAvaliadores").addClass("forbidden-bc-grey");
                    $("#removeAvaliadores").addClass("forbidden-bc-grey");
                    $("#distribAvalidoresFases").addClass("forbidden-bc-grey");
                    $("#removeAvalidoresFases").removeClass("forbidden-bc-grey");
                    $("#gerarFichasAval").removeClass("forbidden-bc-grey");
                    $("#removeFichasAval").addClass("forbidden-bc-grey");
                } else if (estado_ === 'E') {
                    $("#selectAvaliados").addClass("forbidden-bc-grey");
                    $("#removeAvaliados").addClass("forbidden-bc-grey");
                    $("#selectAvaliadores").addClass("forbidden-bc-grey");
                    $("#removeAvaliadores").addClass("forbidden-bc-grey");
                    $("#distribAvalidoresFases").addClass("forbidden-bc-grey");
                    $("#removeAvalidoresFases").addClass("forbidden-bc-grey");
                    $("#gerarFichasAval").addClass("forbidden-bc-grey");
                    $("#removeFichasAval").removeClass("forbidden-bc-grey");
                } else if (estado_ === 'F') {
                    $("#selectAvaliados").addClass("forbidden-bc-grey");
                    $("#removeAvaliados").addClass("forbidden-bc-grey");
                    $("#selectAvaliadores").addClass("forbidden-bc-grey");
                    $("#removeAvaliadores").addClass("forbidden-bc-grey");
                    $("#distribAvalidoresFases").addClass("forbidden-bc-grey");
                    $("#removeAvalidoresFases").addClass("forbidden-bc-grey");
                    $("#gerarFichasAval").addClass("forbidden-bc-grey");
                    $("#removeFichasAval").removeClass("forbidden-bc-grey");
                }
                else {
                    $("#selectAvaliados").addClass("forbidden-bc-grey");
                    $("#removeAvaliados").addClass("forbidden-bc-grey");
                    $("#selectAvaliadores").addClass("forbidden-bc-grey");
                    $("#removeAvaliadores").addClass("forbidden-bc-grey");
                    $("#distribAvalidoresFases").addClass("forbidden-bc-grey");
                    $("#removeAvalidoresFases").addClass("forbidden-bc-grey");
                    $("#gerarFichasAval").addClass("forbidden-bc-grey");
                    $("#removeFichasAval").addClass("forbidden-bc-grey");
                }
            }

            /* Events ON MACRO-PROCESSOS instance for: SELECT / DESELECT ROW */
            // NOTE: Assertive way to lunch events BEFORE DOM availability :: EVENT BULLET PROF
            // EX. elemment on FORM > $(document).on('click',"a[data-form-action]", frm, function(e) {  ...
            $(document).on('click', '#RH_PROCESSOS_AVALIACAO > tbody', function (ev) {
                ev.stopImmediatePropagation();
                var x = RH_PROCESSOS_AVALIACAO.selectedRowData(), estado_;
                if (RH_PROCESSOS_AVALIACAO.tbl.rows( '.selected' ).any()){ //ROW on MASTER IS SELECTED

                    // inicialização do estado
                    if (x['GE_ESTADO_PROC_AVALIACAO(EMPRESA,ID_PA,DT_INI_PA,ID_PROCESSO_AV,DT_INI_PROCESSO)'] !== '' && 
                        x['GE_ESTADO_PROC_AVALIACAO(EMPRESA,ID_PA,DT_INI_PA,ID_PROCESSO_AV,DT_INI_PROCESSO)'] !== 'undefined') {
                        estado_ = x['GE_ESTADO_PROC_AVALIACAO(EMPRESA,ID_PA,DT_INI_PA,ID_PROCESSO_AV,DT_INI_PROCESSO)'];
                    } else {
                        estado_ = '';
                    }

                    // configura ações de acordo com o estado do processo
                    config_RH_PROCESSOS_AVALIACAO_actions(estado_);
                    // mostrar ações
                    $("#RH_PROCESSOS_AVALIACAO_actions").show();
                } else {  //DESELECT ROW EVENT
                    // esconder ações
                    $("#RH_FASES_FONTES_PROCESSO_actions").hide();
                    $("#RH_PROCESSOS_AVALIACAO_actions").hide();
                }            
            });

            //Identificação Avaliados
            $(document).on('click', '#selectAvaliados', function (e) {
                e.stopPropagation();
                e.preventDefault();
                var title = "<?php echo $ui_identification_evaluated;?>";
                var url_filter = "ajax/dg_filtros.php";
                filterQUAD_HCM(title,url_filter,['EMPRESA','DT_ADMISSAO'],'800px');
             });

            $(document).on('click', '#returnModalQUAD_HCM', function (e) {
                e.stopPropagation();
                e.preventDefault();

                var processTitle, empresa_, plano_, dt_plano_, processo_, dt_processo_, estado_, colabs,
                    el = $("#selectAvaliados"), btnTxt = el.html(), tmp, t1, t0 = performance.now();
                el.html(btnTxt + ' <i class="fas fa-cogs"></i>');
                el.addClass("disabled");
                quad_notification_clear();

                // obtem a lista dos colaboradores selecionados
                colabs = [];
                $('#QUAD_PEOPLE_2 > tbody  > tr').find('.sel_colab').each(function() {
                    if ($(this).is(":checked")) {
                        id_ = $(this).data("ref");
                        colabs.push(id_);
                    }
                });                

                var x = RH_PROCESSOS_AVALIACAO.selectedRowData();
                try {
                    if (x['EMPRESA'] !== '' && x['EMPRESA'] !== 'undefined') {
                        empresa_ = x['EMPRESA'];
                    } else {
                        empresa_ = '';
                    }

                    if (x['ID_PA'] !== '' && x['ID_PA'] !== 'undefined') {
                        plano_ = x['ID_PA'];
                    } else {
                        plano_ = '';
                    }

                    if (x['DT_INI_PA'] !== '' && x['DT_INI_PA'] !== 'undefined') {
                        dt_plano_ = x['DT_INI_PA'];
                    } else {
                        dt_plano_ = '';
                    }

                    if (x['ID_PROCESSO_AV'] !== '' && x['ID_PROCESSO_AV'] !== 'undefined') {
                        processo_ = x['ID_PROCESSO_AV'];
                    } else {
                        processo_ = '';
                    }

                    if (x['DT_INI_PROCESSO'] !== '' && x['DT_INI_PROCESSO'] !== 'undefined') {
                        dt_processo_ = x['DT_INI_PROCESSO'];
                    } else {
                        dt_processo_ = '';
                    }

                } catch(err) {
                    empresa_ = '';
                    plano_ = '';
                    dt_plano_ = '';
                    processo_ = '';
                    dt_processo_ = '';
                    estado_ = '';
                }    

                if (!empresa_ || !plano_ || !dt_plano_ || !processo_ || !dt_processo_ || colabs.length == 0) { 
                    processTitle = "<?php echo $warning_no_data; ?>"; 
                    quad_notification({
                            type: "info",
                            title : JS_OPERATION_ABORT,
                            content : '<i class="fas fa-clock"></i>&nbsp;<i>' + processTitle + '</i>',
                            timeout : 3500
                    });
                    el.removeClass("disabled");
                    el.html(btnTxt);
                } else {
                    var wk = new Worker(pn + "assets/lib/utils/workerAD.js"),
                        message = {
                            empresa: empresa_,
                            plano: plano_,
                            dt_plano: dt_plano_,
                            processo: processo_,
                            dt_processo: dt_processo_,
                            colabs: JSON.stringify(colabs),
                            request_id: 'IDENTIFICACAO_AVALIADOS',
                            defaults: datatable_instance_defaults.pathToSqlFile
                        },
                        mssg = '';

                    wk.postMessage(JSON.stringify(message));
                    wk.onmessage = function (event) {                
                        if (event.data === 'working') {
                            RH_PROCESSOS_AVALIACAO.showProcess("<?php echo $ui_identification_evaluated; ?>"); //Process ID;
                            return;
                        } else {
                            t1 = performance.now();
                            tmp = millisToMinutesAndSeconds(t1 - t0);
                            el.html( btnTxt );
                            el.removeClass("disabled");

                            if (event.data) {
                                if (event.data.msg) { 
                                    mssg = "<?php echo $msg_process_finished_ok; ?>";                                
                                    mssg = mssg.replace(" {0}", " " + tmp + " (MM:SS)");
                                    quad_notification({
                                            type: "success",
                                            title : JS_OPERATION_COMPLETED,
                                            content : '<i class="glyphicon glyphicon-thumbs-up"></i>&nbsp;<i>' + mssg + '</i>',
                                            timeout : 5000
                                    });
                                    $(this).prop("disabled", false);

                                    // Atualização do estado do processo de acordo com o resultado esta operação
                                    changeQuadtableColumn(RH_PROCESSOS_AVALIACAO,
                                                          'GE_ESTADO_PROC_AVALIACAO(EMPRESA,ID_PA,DT_INI_PA,ID_PROCESSO_AV,DT_INI_PROCESSO)',
                                                          6,
                                                          event.data.dsp_estado, 
                                                          event.data.estado);
                                    // Atualização das ações do menu correspondente
                                    config_RH_PROCESSOS_AVALIACAO_actions(event.data.estado);

                                    var elx = RH_PROCESSOS_AVALIACAO.tbl.rows('.selected');
                                    //Deselect current ROW (already updated on server)
                                    elx.deselect();
                                    //Select current ROW (to refresh detail results)
                                    elx.select();

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
                        RH_PROCESSOS_AVALIACAO.hideProcess();
                    };
                }
            });          
            //END Identificação Avaliados

            //Remoção Avaliados
            $(document).on('click', '#removeAvaliados', function (e) {
                e.stopPropagation();
                e.preventDefault();

                var processTitle, empresa_, plano_, dt_plano_, processo_, dt_processo_, estado_, el = $(this), btnTxt = el.html(), tmp, t1, t0 = performance.now();
                el.html(btnTxt + ' <i class="fas fa-cogs"></i>');
                el.addClass("disabled");
                quad_notification_clear();

                var x = RH_PROCESSOS_AVALIACAO.selectedRowData();
                try {
                    if (x['EMPRESA'] !== '' && x['EMPRESA'] !== 'undefined') {
                        empresa_ = x['EMPRESA'];
                    } else {
                        empresa_ = '';
                    }

                    if (x['ID_PA'] !== '' && x['ID_PA'] !== 'undefined') {
                        plano_ = x['ID_PA'];
                    } else {
                        plano_ = '';
                    }

                    if (x['DT_INI_PA'] !== '' && x['DT_INI_PA'] !== 'undefined') {
                        dt_plano_ = x['DT_INI_PA'];
                    } else {
                        dt_plano_ = '';
                    }

                    if (x['ID_PROCESSO_AV'] !== '' && x['ID_PROCESSO_AV'] !== 'undefined') {
                        processo_ = x['ID_PROCESSO_AV'];
                    } else {
                        processo_ = '';
                    }

                    if (x['DT_INI_PROCESSO'] !== '' && x['DT_INI_PROCESSO'] !== 'undefined') {
                        dt_processo_ = x['DT_INI_PROCESSO'];
                    } else {
                        dt_processo_ = '';
                    }

//                            if (x['ESTADO'] !== '' && x['ESTADO'] !== 'undefined') {
//                                estado_ = x['ESTADO'];
//                            } else {
//                                estado_ = '';
//                            }
                } catch(err) {
                    empresa_ = '';
                    plano_ = '';
                    dt_plano_ = '';
                    processo_ = '';
                    dt_processo_ = '';
                    estado_ = '';
                }    

                if (!empresa_ || !plano_ || !dt_plano_ || !processo_ || !dt_processo_) { 
                    processTitle = "<?php echo $warning_no_data; ?>"; 
                    quad_notification({
                            type: "info",
                            title : JS_OPERATION_ABORT,
                            content : '<i class="fas fa-clock"></i>&nbsp;<i>' + processTitle + '</i>',
                            timeout : 3500
                    });
                    el.removeClass("disabled");
                    el.html(btnTxt);
                } else {
                    var wk = new Worker(pn + "assets/lib/utils/workerAD.js"),
                        message = {
                            empresa: empresa_,
                            plano: plano_,
                            dt_plano: dt_plano_,
                            processo: processo_,
                            dt_processo: dt_processo_,
                            request_id: 'REMOCAO_AVALIADOS',
                            defaults: datatable_instance_defaults.pathToSqlFile
                        },
                        mssg = '';

                    wk.postMessage(JSON.stringify(message));
                    wk.onmessage = function (event) {                
                        if (event.data === 'working') {
                            RH_PROCESSOS_AVALIACAO.showProcess("<?php echo $ui_evaluated_removal; ?>"); //Process ID;
                            return;
                        } else {
                            t1 = performance.now();
                            tmp = millisToMinutesAndSeconds(t1 - t0);
                            el.html( btnTxt );
                            el.removeClass("disabled");

                            if (event.data) {
                                if (event.data.msg) { 
                                    mssg = "<?php echo $msg_process_finished_ok; ?>";                                
                                    mssg = mssg.replace(" {0}", " " + tmp + " (MM:SS)");
                                    quad_notification({
                                            type: "success",
                                            title : JS_OPERATION_COMPLETED,
                                            content : '<i class="glyphicon glyphicon-thumbs-up"></i>&nbsp;<i>' + mssg + '</i>',
                                            timeout : 5000
                                    });
                                    $(this).prop("disabled", false);

                                    // Atualização do estado do processo de acordo com o resultado esta operação
                                    changeQuadtableColumn(RH_PROCESSOS_AVALIACAO,
                                                          'GE_ESTADO_PROC_AVALIACAO(EMPRESA,ID_PA,DT_INI_PA,ID_PROCESSO_AV,DT_INI_PROCESSO)',
                                                          6,
                                                          event.data.dsp_estado, 
                                                          event.data.estado);
                                    // Atualização das ações do menu correspondente
                                    config_RH_PROCESSOS_AVALIACAO_actions(event.data.estado);

                                    var elx = RH_PROCESSOS_AVALIACAO.tbl.rows('.selected');
                                    //Deselect current ROW (already updated on server)
                                    elx.deselect();
                                    //Select current ROW (to refresh detail results)
                                    elx.select();

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
                        RH_PROCESSOS_AVALIACAO.hideProcess();
                    };
                }
            });
            //END Remoção Avaliados

            //Selecção Avaliadores
            $(document).on('click', '#selectAvaliadores', function (e) {
                e.stopPropagation();
                e.preventDefault();

                var processTitle, empresa_, plano_, dt_plano_, processo_, dt_processo_, estado_, el = $(this), btnTxt = el.html(), tmp, t1, t0 = performance.now();
                el.html(btnTxt + ' <i class="fas fa-cogs"></i>');
                el.addClass("disabled");
                quad_notification_clear();

                var x = RH_PROCESSOS_AVALIACAO.selectedRowData();
                try {
                    if (x['EMPRESA'] !== '' && x['EMPRESA'] !== 'undefined') {
                        empresa_ = x['EMPRESA'];
                    } else {
                        empresa_ = '';
                    }

                    if (x['ID_PA'] !== '' && x['ID_PA'] !== 'undefined') {
                        plano_ = x['ID_PA'];
                    } else {
                        plano_ = '';
                    }

                    if (x['DT_INI_PA'] !== '' && x['DT_INI_PA'] !== 'undefined') {
                        dt_plano_ = x['DT_INI_PA'];
                    } else {
                        dt_plano_ = '';
                    }

                    if (x['ID_PROCESSO_AV'] !== '' && x['ID_PROCESSO_AV'] !== 'undefined') {
                        processo_ = x['ID_PROCESSO_AV'];
                    } else {
                        processo_ = '';
                    }

                    if (x['DT_INI_PROCESSO'] !== '' && x['DT_INI_PROCESSO'] !== 'undefined') {
                        dt_processo_ = x['DT_INI_PROCESSO'];
                    } else {
                        dt_processo_ = '';
                    }

//                            if (x['ESTADO'] !== '' && x['ESTADO'] !== 'undefined') {
//                                estado_ = x['ESTADO'];
//                            } else {
//                                estado_ = '';
//                            }
                } catch(err) {
                    empresa_ = '';
                    plano_ = '';
                    dt_plano_ = '';
                    processo_ = '';
                    dt_processo_ = '';
                    estado_ = '';
                }    

                if (!empresa_ || !plano_ || !dt_plano_ || !processo_ || !dt_processo_) { 
                    processTitle = "<?php echo $warning_no_data; ?>"; 
                    quad_notification({
                            type: "info",
                            title : JS_OPERATION_ABORT,
                            content : '<i class="fas fa-clock"></i>&nbsp;<i>' + processTitle + '</i>',
                            timeout : 3500
                    });
                    el.removeClass("disabled");
                    el.html(btnTxt);
                } else {
                    var wk = new Worker(pn + "assets/lib/utils/workerAD.js"),
                        message = {
                            empresa: empresa_,
                            plano: plano_,
                            dt_plano: dt_plano_,
                            processo: processo_,
                            dt_processo: dt_processo_,
                            request_id: 'SELECCAO_AVALIADORES',
                            defaults: datatable_instance_defaults.pathToSqlFile
                        },
                        mssg = '';

                    wk.postMessage(JSON.stringify(message));
                    wk.onmessage = function (event) {                
                        if (event.data === 'working') {
                            RH_PROCESSOS_AVALIACAO.showProcess("<?php echo $ui_selection_evaluators; ?>"); //Process ID;
                            return;
                        } else {
                            t1 = performance.now();
                            tmp = millisToMinutesAndSeconds(t1 - t0);
                            el.html( btnTxt );
                            el.removeClass("disabled");

                            if (event.data) {
                                if (event.data.msg) { 
                                    mssg = "<?php echo $msg_process_finished_ok; ?>";                                
                                    mssg = mssg.replace(" {0}", " " + tmp + " (MM:SS)");
                                    quad_notification({
                                            type: "success",
                                            title : JS_OPERATION_COMPLETED,
                                            content : '<i class="glyphicon glyphicon-thumbs-up"></i>&nbsp;<i>' + mssg + '</i>',
                                            timeout : 5000
                                    });
                                    $(this).prop("disabled", false);

                                    // Atualização do estado do processo de acordo com o resultado esta operação
                                    changeQuadtableColumn(RH_PROCESSOS_AVALIACAO,
                                                          'GE_ESTADO_PROC_AVALIACAO(EMPRESA,ID_PA,DT_INI_PA,ID_PROCESSO_AV,DT_INI_PROCESSO)',
                                                          6,
                                                          event.data.dsp_estado, 
                                                          event.data.estado);
                                    // Atualização das ações do menu correspondente
                                    config_RH_PROCESSOS_AVALIACAO_actions(event.data.estado);

                                    var elx = RH_PROCESSOS_AVALIACAO.tbl.rows('.selected');
                                    //Deselect current ROW (already updated on server)
                                    elx.deselect();
                                    //Select current ROW (to refresh detail results)
                                    elx.select();

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
                        RH_PROCESSOS_AVALIACAO.hideProcess();
                    };
                }
            });
            //END Selecção Avaliadores

            //Remoção Avaliadores
            $(document).on('click', '#removeAvaliadores', function (e) {
                e.stopPropagation();
                e.preventDefault();

                var processTitle, empresa_, plano_, dt_plano_, processo_, dt_processo_, estado_, el = $(this), btnTxt = el.html(), tmp, t1, t0 = performance.now();
                el.html(btnTxt + ' <i class="fas fa-cogs"></i>');
                el.addClass("disabled");
                quad_notification_clear();

                var x = RH_PROCESSOS_AVALIACAO.selectedRowData();
                try {
                    if (x['EMPRESA'] !== '' && x['EMPRESA'] !== 'undefined') {
                        empresa_ = x['EMPRESA'];
                    } else {
                        empresa_ = '';
                    }

                    if (x['ID_PA'] !== '' && x['ID_PA'] !== 'undefined') {
                        plano_ = x['ID_PA'];
                    } else {
                        plano_ = '';
                    }

                    if (x['DT_INI_PA'] !== '' && x['DT_INI_PA'] !== 'undefined') {
                        dt_plano_ = x['DT_INI_PA'];
                    } else {
                        dt_plano_ = '';
                    }

                    if (x['ID_PROCESSO_AV'] !== '' && x['ID_PROCESSO_AV'] !== 'undefined') {
                        processo_ = x['ID_PROCESSO_AV'];
                    } else {
                        processo_ = '';
                    }

                    if (x['DT_INI_PROCESSO'] !== '' && x['DT_INI_PROCESSO'] !== 'undefined') {
                        dt_processo_ = x['DT_INI_PROCESSO'];
                    } else {
                        dt_processo_ = '';
                    }

//                            if (x['ESTADO'] !== '' && x['ESTADO'] !== 'undefined') {
//                                estado_ = x['ESTADO'];
//                            } else {
//                                estado_ = '';
//                            }
                } catch(err) {
                    empresa_ = '';
                    plano_ = '';
                    dt_plano_ = '';
                    processo_ = '';
                    dt_processo_ = '';
                    estado_ = '';
                }    

                if (!empresa_ || !plano_ || !dt_plano_ || !processo_ || !dt_processo_) { 
                    processTitle = "<?php echo $warning_no_data; ?>"; 
                    quad_notification({
                            type: "info",
                            title : JS_OPERATION_ABORT,
                            content : '<i class="fas fa-clock"></i>&nbsp;<i>' + processTitle + '</i>',
                            timeout : 3500
                    });
                    el.removeClass("disabled");
                    el.html(btnTxt);
                } else {
                    var wk = new Worker(pn + "assets/lib/utils/workerAD.js"),
                        message = {
                            empresa: empresa_,
                            plano: plano_,
                            dt_plano: dt_plano_,
                            processo: processo_,
                            dt_processo: dt_processo_,
                            request_id: 'REMOCAO_AVALIADORES',
                            defaults: datatable_instance_defaults.pathToSqlFile
                        },
                        mssg = '';

                    wk.postMessage(JSON.stringify(message));
                    wk.onmessage = function (event) {                
                        if (event.data === 'working') {
                            RH_PROCESSOS_AVALIACAO.showProcess("<?php echo $ui_evaluators_removal; ?>"); //Process ID;
                            return;
                        } else {
                            t1 = performance.now();
                            tmp = millisToMinutesAndSeconds(t1 - t0);
                            el.html( btnTxt );
                            el.removeClass("disabled");

                            if (event.data) {
                                if (event.data.msg) { 
                                    mssg = "<?php echo $msg_process_finished_ok; ?>";                                
                                    mssg = mssg.replace(" {0}", " " + tmp + " (MM:SS)");
                                    quad_notification({
                                            type: "success",
                                            title : JS_OPERATION_COMPLETED,
                                            content : '<i class="glyphicon glyphicon-thumbs-up"></i>&nbsp;<i>' + mssg + '</i>',
                                            timeout : 5000
                                    });
                                    $(this).prop("disabled", false);

                                    // Atualização do estado do processo de acordo com o resultado esta operação
                                    changeQuadtableColumn(RH_PROCESSOS_AVALIACAO,
                                                          'GE_ESTADO_PROC_AVALIACAO(EMPRESA,ID_PA,DT_INI_PA,ID_PROCESSO_AV,DT_INI_PROCESSO)',
                                                          6,
                                                          event.data.dsp_estado, 
                                                          event.data.estado);
                                    // Atualização das ações do menu correspondente
                                    config_RH_PROCESSOS_AVALIACAO_actions(event.data.estado);

                                    var elx = RH_PROCESSOS_AVALIACAO.tbl.rows('.selected');
                                    //Deselect current ROW (already updated on server)
                                    elx.deselect();
                                    //Select current ROW (to refresh detail results)
                                    elx.select();

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
                        RH_PROCESSOS_AVALIACAO.hideProcess();
                    };
                }
            });
            //END Selecção Avaliadores

            //Distribuição Avaliadores p/ Fases
            $(document).on('click', '#distribAvalidoresFases', function (e) {
                e.stopPropagation();
                e.preventDefault();

                var processTitle, empresa_, plano_, dt_plano_, processo_, dt_processo_, estado_, el = $(this), btnTxt = el.html(), tmp, t1, t0 = performance.now();
                el.html(btnTxt + ' <i class="fas fa-cogs"></i>');
                el.addClass("disabled");
                quad_notification_clear();

                var x = RH_PROCESSOS_AVALIACAO.selectedRowData();
                try {
                    if (x['EMPRESA'] !== '' && x['EMPRESA'] !== 'undefined') {
                        empresa_ = x['EMPRESA'];
                    } else {
                        empresa_ = '';
                    }

                    if (x['ID_PA'] !== '' && x['ID_PA'] !== 'undefined') {
                        plano_ = x['ID_PA'];
                    } else {
                        plano_ = '';
                    }

                    if (x['DT_INI_PA'] !== '' && x['DT_INI_PA'] !== 'undefined') {
                        dt_plano_ = x['DT_INI_PA'];
                    } else {
                        dt_plano_ = '';
                    }

                    if (x['ID_PROCESSO_AV'] !== '' && x['ID_PROCESSO_AV'] !== 'undefined') {
                        processo_ = x['ID_PROCESSO_AV'];
                    } else {
                        processo_ = '';
                    }

                    if (x['DT_INI_PROCESSO'] !== '' && x['DT_INI_PROCESSO'] !== 'undefined') {
                        dt_processo_ = x['DT_INI_PROCESSO'];
                    } else {
                        dt_processo_ = '';
                    }

//                            if (x['ESTADO'] !== '' && x['ESTADO'] !== 'undefined') {
//                                estado_ = x['ESTADO'];
//                            } else {
//                                estado_ = '';
//                            }
                } catch(err) {
                    empresa_ = '';
                    plano_ = '';
                    dt_plano_ = '';
                    processo_ = '';
                    dt_processo_ = '';
                    estado_ = '';
                }    

                if (!empresa_ || !plano_ || !dt_plano_ || !processo_ || !dt_processo_) { 
                    processTitle = "<?php echo $warning_no_data; ?>"; 
                    quad_notification({
                            type: "info",
                            title : JS_OPERATION_ABORT,
                            content : '<i class="fas fa-clock"></i>&nbsp;<i>' + processTitle + '</i>',
                            timeout : 3500
                    });
                    el.removeClass("disabled");
                    el.html(btnTxt);
                } else {
                    var wk = new Worker(pn + "assets/lib/utils/workerAD.js"),
                        message = {
                            empresa: empresa_,
                            plano: plano_,
                            dt_plano: dt_plano_,
                            processo: processo_,
                            dt_processo: dt_processo_,
                            request_id: 'DISTRIB_AVALIADORES_FASES',
                            defaults: datatable_instance_defaults.pathToSqlFile
                        },
                        mssg = '';

                    wk.postMessage(JSON.stringify(message));
                    wk.onmessage = function (event) {                
                        if (event.data === 'working') {
                            RH_PROCESSOS_AVALIACAO.showProcess("<?php echo $ui_distribution_evaluators_phases; ?>"); //Process ID;
                            return;
                        } else {
                            t1 = performance.now();
                            tmp = millisToMinutesAndSeconds(t1 - t0);
                            el.html( btnTxt );
                            el.removeClass("disabled");

                            if (event.data) {
                                if (event.data.msg) { 
                                    mssg = "<?php echo $msg_process_finished_ok; ?>";                                
                                    mssg = mssg.replace(" {0}", " " + tmp + " (MM:SS)");
                                    quad_notification({
                                            type: "success",
                                            title : JS_OPERATION_COMPLETED,
                                            content : '<i class="glyphicon glyphicon-thumbs-up"></i>&nbsp;<i>' + mssg + '</i>',
                                            timeout : 5000
                                    });
                                    $(this).prop("disabled", false);

                                    // Atualização do estado do processo de acordo com o resultado esta operação
                                    changeQuadtableColumn(RH_PROCESSOS_AVALIACAO,
                                                          'GE_ESTADO_PROC_AVALIACAO(EMPRESA,ID_PA,DT_INI_PA,ID_PROCESSO_AV,DT_INI_PROCESSO)',
                                                          6,
                                                          event.data.dsp_estado, 
                                                          event.data.estado);
                                    // Atualização das ações do menu correspondente
                                    config_RH_PROCESSOS_AVALIACAO_actions(event.data.estado);

                                    var elx = RH_PROCESSOS_AVALIACAO.tbl.rows('.selected');
                                    //Deselect current ROW (already updated on server)
                                    elx.deselect();
                                    //Select current ROW (to refresh detail results)
                                    elx.select();

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
                        RH_PROCESSOS_AVALIACAO.hideProcess();
                    };
                }
            });
            //END Distribuição Avaliadores p/ Fases

            //Remoção Avaliadores p/ Fases
            $(document).on('click', '#removeAvalidoresFases', function (e) {
                e.stopPropagation();
                e.preventDefault();

                var processTitle, empresa_, plano_, dt_plano_, processo_, dt_processo_, estado_, el = $(this), btnTxt = el.html(), tmp, t1, t0 = performance.now();
                el.html(btnTxt + ' <i class="fas fa-cogs"></i>');
                el.addClass("disabled");
                quad_notification_clear();

                var x = RH_PROCESSOS_AVALIACAO.selectedRowData();
                try {
                    if (x['EMPRESA'] !== '' && x['EMPRESA'] !== 'undefined') {
                        empresa_ = x['EMPRESA'];
                    } else {
                        empresa_ = '';
                    }

                    if (x['ID_PA'] !== '' && x['ID_PA'] !== 'undefined') {
                        plano_ = x['ID_PA'];
                    } else {
                        plano_ = '';
                    }

                    if (x['DT_INI_PA'] !== '' && x['DT_INI_PA'] !== 'undefined') {
                        dt_plano_ = x['DT_INI_PA'];
                    } else {
                        dt_plano_ = '';
                    }

                    if (x['ID_PROCESSO_AV'] !== '' && x['ID_PROCESSO_AV'] !== 'undefined') {
                        processo_ = x['ID_PROCESSO_AV'];
                    } else {
                        processo_ = '';
                    }

                    if (x['DT_INI_PROCESSO'] !== '' && x['DT_INI_PROCESSO'] !== 'undefined') {
                        dt_processo_ = x['DT_INI_PROCESSO'];
                    } else {
                        dt_processo_ = '';
                    }

//                            if (x['ESTADO'] !== '' && x['ESTADO'] !== 'undefined') {
//                                estado_ = x['ESTADO'];
//                            } else {
//                                estado_ = '';
//                            }
                } catch(err) {
                    empresa_ = '';
                    plano_ = '';
                    dt_plano_ = '';
                    processo_ = '';
                    dt_processo_ = '';
                    estado_ = '';
                }    

                if (!empresa_ || !plano_ || !dt_plano_ || !processo_ || !dt_processo_) { 
                    processTitle = "<?php echo $warning_no_data; ?>"; 
                    quad_notification({
                            type: "info",
                            title : JS_OPERATION_ABORT,
                            content : '<i class="fas fa-clock"></i>&nbsp;<i>' + processTitle + '</i>',
                            timeout : 3500
                    });
                    el.removeClass("disabled");
                    el.html(btnTxt);
                } else {
                    var wk = new Worker(pn + "assets/lib/utils/workerAD.js"),
                        message = {
                            empresa: empresa_,
                            plano: plano_,
                            dt_plano: dt_plano_,
                            processo: processo_,
                            dt_processo: dt_processo_,
                            request_id: 'REMOCAO_AVALIADORES_FASES',
                            defaults: datatable_instance_defaults.pathToSqlFile
                        },
                        mssg = '';

                    wk.postMessage(JSON.stringify(message));
                    wk.onmessage = function (event) {                
                        if (event.data === 'working') {
                            RH_PROCESSOS_AVALIACAO.showProcess("<?php echo $ui_evaluators_phases_removal; ?>"); //Process ID;
                            return;
                        } else {
                            t1 = performance.now();
                            tmp = millisToMinutesAndSeconds(t1 - t0);
                            el.html( btnTxt );
                            el.removeClass("disabled");

                            if (event.data) {
                                if (event.data.msg) { 
                                    mssg = "<?php echo $msg_process_finished_ok; ?>";                                
                                    mssg = mssg.replace(" {0}", " " + tmp + " (MM:SS)");
                                    quad_notification({
                                            type: "success",
                                            title : JS_OPERATION_COMPLETED,
                                            content : '<i class="glyphicon glyphicon-thumbs-up"></i>&nbsp;<i>' + mssg + '</i>',
                                            timeout : 5000
                                    });
                                    $(this).prop("disabled", false);

                                    // Atualização do estado do processo de acordo com o resultado esta operação
                                    changeQuadtableColumn(RH_PROCESSOS_AVALIACAO,
                                                          'GE_ESTADO_PROC_AVALIACAO(EMPRESA,ID_PA,DT_INI_PA,ID_PROCESSO_AV,DT_INI_PROCESSO)',
                                                          6,
                                                          event.data.dsp_estado, 
                                                          event.data.estado);
                                    // Atualização das ações do menu correspondente
                                    config_RH_PROCESSOS_AVALIACAO_actions(event.data.estado);

                                    var elx = RH_PROCESSOS_AVALIACAO.tbl.rows('.selected');
                                    //Deselect current ROW (already updated on server)
                                    elx.deselect();
                                    //Select current ROW (to refresh detail results)
                                    elx.select();

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
                        RH_PROCESSOS_AVALIACAO.hideProcess();
                    };
                }
            });
            //END Remoção Avaliadores p/ Fases

            //Geração Fichas Avaliação
            $(document).on('click', '#gerarFichasAval', function (e) {
                e.stopPropagation();
                e.preventDefault();

                var processTitle, empresa_, plano_, dt_plano_, processo_, dt_processo_, estado_, el = $(this), btnTxt = el.html(), tmp, t1, t0 = performance.now();
                el.html(btnTxt + ' <i class="fas fa-cogs"></i>');
                el.addClass("disabled");
                quad_notification_clear();

                var x = RH_PROCESSOS_AVALIACAO.selectedRowData();
                try {
                    if (x['EMPRESA'] !== '' && x['EMPRESA'] !== 'undefined') {
                        empresa_ = x['EMPRESA'];
                    } else {
                        empresa_ = '';
                    }

                    if (x['ID_PA'] !== '' && x['ID_PA'] !== 'undefined') {
                        plano_ = x['ID_PA'];
                    } else {
                        plano_ = '';
                    }

                    if (x['DT_INI_PA'] !== '' && x['DT_INI_PA'] !== 'undefined') {
                        dt_plano_ = x['DT_INI_PA'];
                    } else {
                        dt_plano_ = '';
                    }

                    if (x['ID_PROCESSO_AV'] !== '' && x['ID_PROCESSO_AV'] !== 'undefined') {
                        processo_ = x['ID_PROCESSO_AV'];
                    } else {
                        processo_ = '';
                    }

                    if (x['DT_INI_PROCESSO'] !== '' && x['DT_INI_PROCESSO'] !== 'undefined') {
                        dt_processo_ = x['DT_INI_PROCESSO'];
                    } else {
                        dt_processo_ = '';
                    }

//                            if (x['ESTADO'] !== '' && x['ESTADO'] !== 'undefined') {
//                                estado_ = x['ESTADO'];
//                            } else {
//                                estado_ = '';
//                            }
                } catch(err) {
                    empresa_ = '';
                    plano_ = '';
                    dt_plano_ = '';
                    processo_ = '';
                    dt_processo_ = '';
                    estado_ = '';
                }    

                if (!empresa_ || !plano_ || !dt_plano_ || !processo_ || !dt_processo_) { 
                    processTitle = "<?php echo $warning_no_data; ?>"; 
                    quad_notification({
                            type: "info",
                            title : JS_OPERATION_ABORT,
                            content : '<i class="fas fa-clock"></i>&nbsp;<i>' + processTitle + '</i>',
                            timeout : 3500
                    });
                    el.removeClass("disabled");
                    el.html(btnTxt);
                } else {
                    var wk = new Worker(pn + "assets/lib/utils/workerAD.js"),
                        message = {
                            empresa: empresa_,
                            plano: plano_,
                            dt_plano: dt_plano_,
                            processo: processo_,
                            dt_processo: dt_processo_,
                            request_id: 'GERACAO_FICHAS_AVAL',
                            defaults: datatable_instance_defaults.pathToSqlFile
                        },
                        mssg = '';

                    wk.postMessage(JSON.stringify(message));
                    wk.onmessage = function (event) {                
                        if (event.data === 'working') {
                            RH_PROCESSOS_AVALIACAO.showProcess("<?php echo $ui_generate_evaluation_sheets; ?>"); //Process ID;
                            return;
                        } else {
                            t1 = performance.now();
                            tmp = millisToMinutesAndSeconds(t1 - t0);
                            el.html( btnTxt );
                            el.removeClass("disabled");

                            if (event.data) {
                                if (event.data.msg) { 
                                    mssg = "<?php echo $msg_process_finished_ok; ?>";                                
                                    mssg = mssg.replace(" {0}", " " + tmp + " (MM:SS)");
                                    quad_notification({
                                            type: "success",
                                            title : JS_OPERATION_COMPLETED,
                                            content : '<i class="glyphicon glyphicon-thumbs-up"></i>&nbsp;<i>' + mssg + '</i>',
                                            timeout : 5000
                                    });
                                    $(this).prop("disabled", false);

                                    // Atualização do estado do processo de acordo com o resultado esta operação
                                    changeQuadtableColumn(RH_PROCESSOS_AVALIACAO,
                                                          'GE_ESTADO_PROC_AVALIACAO(EMPRESA,ID_PA,DT_INI_PA,ID_PROCESSO_AV,DT_INI_PROCESSO)',
                                                          6,
                                                          event.data.dsp_estado, 
                                                          event.data.estado);
                                    // Atualização das ações do menu correspondente
                                    config_RH_PROCESSOS_AVALIACAO_actions(event.data.estado);

                                    var elx = RH_PROCESSOS_AVALIACAO.tbl.rows('.selected');
                                    //Deselect current ROW (already updated on server)
                                    elx.deselect();
                                    //Select current ROW (to refresh detail results)
                                    elx.select();

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
                        RH_PROCESSOS_AVALIACAO.hideProcess();
                    };
                }
            });
            //END Geração Fichas Avaliação

            //Remoção Fichas Avaliação
            $(document).on('click', '#removeFichasAval', function (e) {
                e.stopPropagation();
                e.preventDefault();

                var processTitle, empresa_, plano_, dt_plano_, processo_, dt_processo_, estado_, el = $(this), btnTxt = el.html(), tmp, t1, t0 = performance.now();
                el.html(btnTxt + ' <i class="fas fa-cogs"></i>');
                el.addClass("disabled");
                quad_notification_clear();

                var x = RH_PROCESSOS_AVALIACAO.selectedRowData();
                try {
                    if (x['EMPRESA'] !== '' && x['EMPRESA'] !== 'undefined') {
                        empresa_ = x['EMPRESA'];
                    } else {
                        empresa_ = '';
                    }

                    if (x['ID_PA'] !== '' && x['ID_PA'] !== 'undefined') {
                        plano_ = x['ID_PA'];
                    } else {
                        plano_ = '';
                    }

                    if (x['DT_INI_PA'] !== '' && x['DT_INI_PA'] !== 'undefined') {
                        dt_plano_ = x['DT_INI_PA'];
                    } else {
                        dt_plano_ = '';
                    }

                    if (x['ID_PROCESSO_AV'] !== '' && x['ID_PROCESSO_AV'] !== 'undefined') {
                        processo_ = x['ID_PROCESSO_AV'];
                    } else {
                        processo_ = '';
                    }

                    if (x['DT_INI_PROCESSO'] !== '' && x['DT_INI_PROCESSO'] !== 'undefined') {
                        dt_processo_ = x['DT_INI_PROCESSO'];
                    } else {
                        dt_processo_ = '';
                    }

//                            if (x['ESTADO'] !== '' && x['ESTADO'] !== 'undefined') {
//                                estado_ = x['ESTADO'];
//                            } else {
//                                estado_ = '';
//                            }
                } catch(err) {
                    empresa_ = '';
                    plano_ = '';
                    dt_plano_ = '';
                    processo_ = '';
                    dt_processo_ = '';
                    estado_ = '';
                }    

                if (!empresa_ || !plano_ || !dt_plano_ || !processo_ || !dt_processo_) { 
                    processTitle = "<?php echo $warning_no_data; ?>"; 
                    quad_notification({
                            type: "info",
                            title : JS_OPERATION_ABORT,
                            content : '<i class="fas fa-clock"></i>&nbsp;<i>' + processTitle + '</i>',
                            timeout : 3500
                    });
                    el.removeClass("disabled");
                    el.html(btnTxt);
                } else {
                    var wk = new Worker(pn + "assets/lib/utils/workerAD.js"),
                        message = {
                            empresa: empresa_,
                            plano: plano_,
                            dt_plano: dt_plano_,
                            processo: processo_,
                            dt_processo: dt_processo_,
                            request_id: 'REMOCAO_FICHAS_AVAL',
                            defaults: datatable_instance_defaults.pathToSqlFile
                        },
                        mssg = '';

                    wk.postMessage(JSON.stringify(message));
                    wk.onmessage = function (event) {                
                        if (event.data === 'working') {
                            RH_PROCESSOS_AVALIACAO.showProcess("<?php echo $ui_evaluation_sheets_removal; ?>"); //Process ID;
                            return;
                        } else {
                            t1 = performance.now();
                            tmp = millisToMinutesAndSeconds(t1 - t0);
                            el.html( btnTxt );
                            el.removeClass("disabled");

                            if (event.data) {
                                if (event.data.msg) { 
                                    mssg = "<?php echo $msg_process_finished_ok; ?>";                                
                                    mssg = mssg.replace(" {0}", " " + tmp + " (MM:SS)");
                                    quad_notification({
                                            type: "success",
                                            title : JS_OPERATION_COMPLETED,
                                            content : '<i class="glyphicon glyphicon-thumbs-up"></i>&nbsp;<i>' + mssg + '</i>',
                                            timeout : 5000
                                    });
                                    $(this).prop("disabled", false);

                                    // Atualização do estado do processo de acordo com o resultado esta operação
                                    changeQuadtableColumn(RH_PROCESSOS_AVALIACAO,
                                                          'GE_ESTADO_PROC_AVALIACAO(EMPRESA,ID_PA,DT_INI_PA,ID_PROCESSO_AV,DT_INI_PROCESSO)',
                                                          6,
                                                          event.data.dsp_estado, 
                                                          event.data.estado);
                                    // Atualização das ações do menu correspondente
                                    config_RH_PROCESSOS_AVALIACAO_actions(event.data.estado);

                                    var elx = RH_PROCESSOS_AVALIACAO.tbl.rows('.selected');
                                    //Deselect current ROW (already updated on server)
                                    elx.deselect();
                                    //Select current ROW (to refresh detail results)
                                    elx.select();

                                } else { //if (msg.indexOf("NOK:")) {
                                    var mssg = event.data.error;
                                    quad_notification({
                                            type: "error",
                                            title : JS_OPERATION_ERROR,
                                            content : '<i class="glyphicon glyphicon-thumbs-down"></i>&nbsp;<i>' + mssg + '</i>'
                                            //timeout : 10000
                                    });
                                    $(this).prop("disabled", false);
                                }
                            }
                        }
                        RH_PROCESSOS_AVALIACAO.hideProcess();
                    };
                }
            });
            //END Remoção Fichas Avaliação

            //Publicação resultados
            $(document).on('click', '#publishResults', function (e) {
                e.stopPropagation();
                e.preventDefault();

                var processTitle, req_Key, masterKey, empresa_, plano_, dt_plano_, processo_, dt_processo_, el = $(this), tmp, t1, t0 = performance.now();
                req_Key = el.data('process-ref');
                if (req_Key) {
                    // DEMO@2@2012-01-01@1@2012-01-01
                    masterKey = req_Key.replace(/@/g, '');
                    tmp = req_Key.split("@");    
                    empresa_ = tmp[0];
                    plano_ = tmp[1]; 
                    dt_plano_ = tmp[2];
                    processo_ = tmp[3];
                    dt_processo_ = tmp[4];
                    el.addClass("disabled");
                    quad_notification_clear();

                    if (!empresa_ || !plano_ || !dt_plano_ || !processo_ || !dt_processo_ ) { 
                        processTitle = "<?php echo $warning_no_data; ?>"; 
                        quad_notification({
                                type: "info",
                                title : JS_OPERATION_ABORT,
                                content : '<i class="fas fa-clock"></i>&nbsp;<i>' + processTitle + '</i>',
                                timeout : 3500
                        });
                        el.removeClass("disabled");
                    } else {
                        var wk = new Worker(pn + "assets/lib/utils/workerAD.js"),
                            message = {
                                empresa: empresa_,
                                plano: plano_,
                                dt_plano: dt_plano_,
                                processo: processo_,
                                dt_processo: dt_processo_,
                                request_id: 'PUB_RESULTADOS',
                                defaults: datatable_instance_defaults.pathToSqlFile
                            },
                            mssg = '';

                        wk.postMessage(JSON.stringify(message));
                        wk.onmessage = function (event) {                
                            if (event.data === 'working') {
                                RH_PROCESSOS_AVALIACAO.showProcess("<?php echo $ui_disclose; ?>"); //Process ID;
                                return;
                            } else {
                                t1 = performance.now();
                                tmp = millisToMinutesAndSeconds(t1 - t0);
                                el.removeClass("disabled");

                                if (event.data) {
                                    if (event.data.msg) { 
                                        mssg = "<?php echo $msg_process_finished_ok; ?>";                                
                                        mssg = mssg.replace(" {0}", " " + tmp + " (MM:SS)");
                                        quad_notification({
                                                type: "success",
                                                title : JS_OPERATION_COMPLETED,
                                                content : '<i class="glyphicon glyphicon-thumbs-up"></i>&nbsp;<i>' + mssg + '</i>',
                                                timeout : 5000
                                        });
                                        $(this).prop("disabled", false);

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
                            RH_PROCESSOS_AVALIACAO.hideProcess();
                        };
                    }
                }            
            });
            //END Publicação resultados

            //Remoção de Publicação resultados
            $(document).on('click', '#unpublishResults', function (e) {
                e.stopPropagation();
                e.preventDefault();
                var processTitle, req_Key, masterKey, empresa_, plano_, dt_plano_, processo_, dt_processo_, el = $(this), tmp, t1, t0 = performance.now();
                req_Key = el.data('process-ref');

                quad_notification_clear();
                var iconStr = '<i class="fa fa-times fadeInRight animated" style="color:#ED1C24"></i>&nbsp;';
                var msg = "<?php echo $msg_unpublish_confirmation; ?>";
                bootbox.confirm({
                    title: iconStr + "<?php echo $ui_remove;?>",
                    message: msg,
                    centerVertical: !0,
                    swapButtonOrder: !0,
                    buttons: { confirm: { label: "<?php echo $ui_yes; ?>", className: "btn-danger shadow-0" }, cancel: { label: "<?php echo $ui_no; ?>", className: "btn-default" } },
                    className: "modal-alert",
                    closeButton: !1,
                    callback: function (t) {
                        if (t === 0) { // NÃO
                            null;
                        }
                        if (t === 1) { // SIM
                            if (req_Key) {
                                // DEMO@2@2012-01-01@1@2012-01-01
                                masterKey = req_Key.replace(/@/g, '');
                                tmp = req_Key.split("@");    
                                empresa_ = tmp[0];
                                plano_ = tmp[1]; 
                                dt_plano_ = tmp[2];
                                processo_ = tmp[3];
                                dt_processo_ = tmp[4];
                                el.addClass("disabled");

                                if (!empresa_ || !plano_ || !dt_plano_ || !processo_ || !dt_processo_ ) { 
                                    processTitle = "<?php echo $warning_no_data; ?>"; 
                                    quad_notification({
                                            type: "info",
                                            title : JS_OPERATION_ABORT,
                                            content : '<i class="fas fa-clock"></i>&nbsp;<i>' + processTitle + '</i>',
                                            timeout : 3500
                                    });
                                    el.removeClass("disabled");
                                } else {
                                    var wk = new Worker(pn + "assets/lib/utils/workerAD.js"),
                                        message = {
                                            empresa: empresa_,
                                            plano: plano_,
                                            dt_plano: dt_plano_,
                                            processo: processo_,
                                            dt_processo: dt_processo_,
                                            request_id: 'UNPUB_RESULTADOS',
                                            defaults: datatable_instance_defaults.pathToSqlFile
                                        },
                                        mssg = '';

                                    wk.postMessage(JSON.stringify(message));
                                    wk.onmessage = function (event) {                
                                        if (event.data === 'working') {
                                            RH_PROCESSOS_AVALIACAO.showProcess("<?php echo $ui_disclose; ?>"); //Process ID;
                                            return;
                                        } else {
                                            t1 = performance.now();
                                            tmp = millisToMinutesAndSeconds(t1 - t0);
                                            el.removeClass("disabled");

                                            if (event.data) {
                                                if (event.data.msg) { 
                                                    mssg = "<?php echo $msg_process_finished_ok; ?>";                                
                                                    mssg = mssg.replace(" {0}", " " + tmp + " (MM:SS)");
                                                    quad_notification({
                                                            type: "success",
                                                            title : JS_OPERATION_COMPLETED,
                                                            content : '<i class="glyphicon glyphicon-thumbs-up"></i>&nbsp;<i>' + mssg + '</i>',
                                                            timeout : 5000
                                                    });
                                                    $(this).prop("disabled", false);

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
                                        RH_PROCESSOS_AVALIACAO.hideProcess();
                                    };
                                }
                            }            
                        }
                    }
                })                
            });
            //END Remoção de Publicação resultados

            // forçar o refresh do quadro
         /*   $("li[x=2]").on('click',function(){
                setTimeout(function(){
                        $("#refresh_RH_PROCESSOS_AVALIACAO").click();
                },1000);

            });*/
        }
        //END Assesment Process :: TAB #2 :: Editor VALIDATION events

        //END EVENTS :: Assesment Process

        //SUB-TAB #2.1 :: Technique
        var optionsRH_TECNICAS_AVAL_PROCESSO = {
            "tableId": "RH_TECNICAS_AVAL_PROCESSO",
            "table": "RH_TECNICAS_AVAL_PROCESSO",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_PA": {"type": "number"},
                    "DT_INI_PA": {"type": "date"},
                    "ID_PROCESSO_AV": {"type": "number"},
                    "DT_INI_PROCESSO": {"type": "date"},
                    "FONTE_AVALIACAO": {"type": "varchar"},
                    "TECNICA_AVALIACAO": {"type": "varchar"},
                    "DT_INI_FA": {"type": "date"},
                    "DT_INI_TAP": {"type": "date"}
                }
            },                
            "dependsOn": {
                "RH_PROCESSOS_AVALIACAO": {//External object key mapping( object key : external key)                    
                    "EMPRESA": "EMPRESA",
                    "ID_PA": "ID_PA",
                    "DT_INI_PA": "DT_INI_PA",
                    "ID_PROCESSO_AV": "ID_PROCESSO_AV",
                    "DT_INI_PROCESSO": "DT_INI_PROCESSO"
                }
            },
            "order_by": "TECNICA_AVALIACAO, FONTE_AVALIACAO, DT_INI_TAP DESC",
            "recordBundle": 8,
            "pageLenght": 8,
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
                    "data": 'ID_PA',
                    "name": 'ID_PA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_PA',
                    "name": 'DT_INI_PA',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_PROCESSO_AV',
                    "name": 'ID_PROCESSO_AV',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_PROCESSO',
                    "name": 'DT_INI_PROCESSO',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'TECNICA_AVALIACAO',
                    "name": 'TECNICA_AVALIACAO',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'FONTE_AVALIACAO',
                    "name": 'FONTE_AVALIACAO',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_FA',
                    "name": 'DT_INI_FA',
                    "type": "hidden", //Editor
                    "datatype": 'date',
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 2,
                    "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                    "title": "<?php echo mb_strtoupper($ui_technique_source, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_technique_source; ?>",
                    "data": 'DSP_TECNICA_FONTE',
                    "name": 'DSP_TECNICA_FONTE',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "dependent-group": "TECNICAS_FONTES",
                        "dependent-level": 1,
                        "data-db-name": 'A.TECNICA_AVALIACAO@A.FONTE_AVALIACAO@A.DT_INI_FA',
                        "decodeFromTable": 'RH_DEF_FONTES_AVALIACAO_ORD_VW A',
                        "class": "form-control complexList chosen",
                        "desigColumn": "A.DSP_TECNICA_FONTE",
                        "orderBy": "A.TECNICA_AVALIACAO,A.FONTE_AVALIACAO,A.DT_INI_FA DESC",
                        "filter": {
                            "create": " AND A.DT_FIM_FA IS NULL", //On-New-Record
                            "edit": " AND A.DT_FIM_FA IS NULL", //On-Edit-Record
                        }
                    },
                    "render": function (val, type, row) {
                        if (typeof (val) === "object" && val === null) {
                            console.log ( row['TECNICA_AVALIACAO'] + ' ' + row['FONTE_AVALIACAO'] + ' ' + row['DT_INI_FA'] );
                        }
                        return val;
                    }                        
                }, {
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_TAP',
                    "name": 'DT_INI_TAP',
                    "datatype": 'date',
                    "def": "1900-01-01",
                    "className": "visibleColumn",
                    "attr": {//EDITOR CONTROL
                        "class": "datepicker" //dateTimePicker
                    }
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_weight, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_weight; ?>", //Editor
                    "data": 'PERCENTAGEM',
                    "name": 'PERCENTAGEM',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 30%;"
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_profile, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_profile; ?>", //Editor
                    "data": 'PERFIL_ASSOCIADO',
                    "name": 'PERFIL_ASSOCIADO',
                    "type": "select",
                    "className": "visibleColumn",
                    attr: {
                        "domain-list": true,
                        "dependent-group": 'GE_PERFIL',
                        "class": "form-control",
                        "name": 'PERFIL_ASSOCIADO',
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['GE_PERFIL'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }                        
                }, {
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM_TAP',
                    "name": 'DT_FIM_TAP',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {//EDITOR CONTROL
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
                        //debugger;
                        return RH_TECNICAS_AVAL_PROCESSO.crudButtons(true, true, true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DSP_TECNICA_FONTE": {//Same as defined on attr.name
                        required: true,
                    },
                    "DT_INI_TAP": {
                        required: true,
                        dateISO: true,
                    },
                    "PERCENTAGEM": {//Same as defined on attr.name
                        number: true,
                    },
                    "DESCRICAO": {
                        maxlength: 4000,
                    },
                    "DT_FIM_TAP": {
                        dateISO: true,
                        dateEqOrNextThan: "DT_INI_TAP",
                    }
                },
                "messages": {
                    "DT_FIM_TAP": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        RH_TECNICAS_AVAL_PROCESSO = new QuadTable();
        RH_TECNICAS_AVAL_PROCESSO.initTable($.extend({}, datatable_instance_defaults, optionsRH_TECNICAS_AVAL_PROCESSO));
        //END SUB-TAB #2.1 :: Technique            

        //SUB-TAB #2.2 :: Phases
        var optionsRH_FASES_PROCESSO_AVAL = {
            "tableId": "RH_FASES_PROCESSO_AVAL",
            "table": "RH_FASES_PROCESSO_AVAL",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_PA": {"type": "number"},
                    "DT_INI_PA": {"type": "date"},
                    "ID_PROCESSO_AV": {"type": "number"},
                    "DT_INI_PROCESSO": {"type": "date"},
                    "ID_FASE": {"type": "number"},
                    "DT_INI_FASE": {"type": "date"},
                    "DT_INI_FPA": {"type": "date"}
                }
            },
            "dependsOn": {
                "RH_PROCESSOS_AVALIACAO": {//External object key mapping( object key : external key)                    
                    "EMPRESA": "EMPRESA",
                    "ID_PA": "ID_PA",
                    "DT_INI_PA": "DT_INI_PA",
                    "ID_PROCESSO_AV": "ID_PROCESSO_AV",
                    "DT_INI_PROCESSO": "DT_INI_PROCESSO"
                }
            },
            "order_by": "ID_FASE, DT_INI_FPA DESC",
            "recordBundle": 8,
            "pageLenght": 8,
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
                    "data": 'EMPRESA',
                    "name": 'EMPRESA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_PA',
                    "name": 'ID_PA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_PA',
                    "name": 'DT_INI_PA',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_PROCESSO_AV',
                    "name": 'ID_PROCESSO_AV',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_PROCESSO',
                    "name": 'DT_INI_PROCESSO',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_FASE',
                    "name": 'ID_FASE',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_FASE',
                    "name": 'DT_INI_FASE',
                    "type": "hidden", //Editor
                    "datatype": 'date',
                    "visible": false, //DataTables
                }, {
                    "complexList": true,
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_phase, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_phase; ?>",
                    "data": 'DSP_FASE',
                    "name": 'DSP_FASE',
                    "type": "select",
                    "className": "visibleColumn",
                    "renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-level": 1,
                        "dependent-group": "AD_FASES",
                        "data-db-name": "A.ID_FASE@A.DT_INI_FASE",
                        "decodeFromTable": "RH_DEF_FASES A",
                        "desigColumn": "CONCAT(CONCAT(A.ID_FASE,'-'),A.DSP_FASE)",
                        //"otherValues": "DESCRICAO", 
                        "orderBy": "A.ID_FASE",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": ' AND A.DT_FIM_FASE IS NULL', //On-New-Record
                            "edit": ' AND A.DT_FIM_FASE IS NULL', //On-Edit-Record
                        }
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_FPA',
                    "name": 'DT_INI_FPA',
                    "datatype": 'date',
                    "def": "1900-01-01",
                    "className": "visibleColumn",
                    "attr": {//EDITOR CONTROL
                        "class": "datepicker" //dateTimePicker
                    }
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_alert_days_before_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_alert_days_before_begin_date; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_alert_days_before_begin_date; ?>",
                    "data": 'DIAS_ALERT_INI',
                    "name": 'DIAS_ALERT_INI',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 30%;"
                    }
                }, {
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_alert_days_before_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_alert_days_before_end_date; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_alert_days_before_end_date; ?>",
                    "data": 'DIAS_ALERT_FIM',
                    "name": 'DIAS_ALERT_FIM',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 30%;"
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM_FPA',
                    "name": 'DT_FIM_FPA',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {//EDITOR CONTROL
                        "class": "datepicker" //dateTimePicker
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
                        return RH_FASES_PROCESSO_AVAL.crudButtons(true, true, true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DSP_FASE": {//Same as defined on attr.name
                        required: true,
                    },
                    "DT_INI_FPA": {
                        required: true,
                        dateISO: true,
                    },
                    "DIAS_ALERT_INI": {
                        integer: true,
                    },
                    "DIAS_ALERT_FIM": {
                        integer: true,
                    },
                    "DESCRICAO": {
                        maxlength: 4000,
                    },
                    "DT_FIM_FPA": {
                        dateISO: true,
                        dateEqOrNextThan: "DT_INI_FPA",
                    }
                },
                "messages": {
                    "DT_FIM_FPA": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        RH_FASES_PROCESSO_AVAL = new QuadTable();
        RH_FASES_PROCESSO_AVAL.initTable($.extend({}, datatable_instance_defaults, optionsRH_FASES_PROCESSO_AVAL));
        //END SUB-TAB #2.2 :: Phases  

        //SUB-TAB #2.3 :: Intervenction Matrix
        var optionsRH_FASES_FONTES_PROCESSO = {
            "tableId": "RH_FASES_FONTES_PROCESSO",
            "table": "RH_FASES_FONTES_PROCESSO",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_phase; ?>",                
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_PA": {"type": "number"},
                    "DT_INI_PA": {"type": "date"},
                    "ID_PROCESSO_AV": {"type": "number"},
                    "DT_INI_PROCESSO": {"type": "date"},
                    "ID_FASE": {"type": "number"},
                    "DT_INI_FASE": {"type": "date"},
                    "DT_INI_FPA": {"type": "date"},
                    "TECNICA_AVALIACAO": {"type": "varchar"},
                    "DT_INI_FA": {"type": "date"},
                    "FONTE_AVALIACAO": {"type": "varchar"},
                    "DT_INI_TAP": {"type": "date"}
                }
            },
            "dependsOn": {
                "RH_PROCESSOS_AVALIACAO": {//External object key mapping( object key : external key)                    
                    "EMPRESA": "EMPRESA",
                    "ID_PA": "ID_PA",
                    "DT_INI_PA": "DT_INI_PA",
                    "ID_PROCESSO_AV": "ID_PROCESSO_AV",
                    "DT_INI_PROCESSO": "DT_INI_PROCESSO"
                }
            },
            "detailsObjects": ['RH_FASE_EQP_OBJ_PARTILHADOS'],
            "order_by": "ID_FASE, DT_INI_FPA DESC, FONTE_AVALIACAO, DT_INI_TAP DESC",
            "recordBundle": 8,
            "pageLenght": 8,
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
                    "data": 'EMPRESA',
                    "name": 'EMPRESA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_PA',
                    "name": 'ID_PA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_PA',
                    "name": 'DT_INI_PA',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_PROCESSO_AV',
                    "name": 'ID_PROCESSO_AV',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_PROCESSO',
                    "name": 'DT_INI_PROCESSO',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_FASE',
                    "name": 'ID_FASE',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_FASE',
                    "name": 'DT_INI_FASE',
                    "type": "hidden", //Editor
                    "datatype": 'date',
                    "visible": false, //DataTables                                        
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_FPA',
                    "name": 'DT_INI_FPA',
                    "type": "hidden", //Editor
                    "datatype": 'date',
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 4,
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_phase, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_phase; ?>",
                    "data": 'DSP_FASE',
                    "name": 'DSP_FASE',
                    "type": "select",
                    "className": "visibleColumn",
                    "renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "AD_FASES",
                        "dependent-level": 1,
                        "deferred": true,
                        "data-db-name": "A.ID_FASE@A.DT_INI_FASE@A.DT_INI_FPA",
                        "decodeFromTable": "RH_FASES_PROC_AVAL_VW A",
                        "desigColumn": "CONCAT(CONCAT(A.ID_FASE,'-'),A.DSP_FASE)",
                        "whereClause": "",
                        //"otherValues": "DESCRICAO", 
                        "orderBy": "A.ID_FASE",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.EMPRESA = ':EMPRESA' AND A.ID_PA = ':ID_PA' AND A.DT_INI_PA = TO_DATE(':DT_INI_PA', 'YYYY-MM-DD') AND A.ID_PROCESSO_AV = ':ID_PROCESSO_AV' AND A.DT_INI_PROCESSO = TO_DATE(':DT_INI_PROCESSO', 'YYYY-MM-DD') ", //On-New-Record
                            "edit": " AND A.EMPRESA = ':EMPRESA' AND A.ID_PA = ':ID_PA' AND A.DT_INI_PA = TO_DATE(':DT_INI_PA', 'YYYY-MM-DD') AND A.ID_PROCESSO_AV = ':ID_PROCESSO_AV' AND A.DT_INI_PROCESSO = TO_DATE(':DT_INI_PROCESSO', 'YYYY-MM-DD') ", //On-Edit-Record
                        }
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'FONTE_AVALIACAO',
                    "name": 'FONTE_AVALIACAO',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'TECNICA_AVALIACAO',
                    "name": 'TECNICA_AVALIACAO',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_FA',
                    "name": 'DT_INI_FA',
                    "type": "hidden", //Editor
                    "datatype": 'date',
                    "visible": false, //DataTables                        
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_TAP',
                    "name": 'DT_INI_TAP',
                    "type": "hidden", //Editor
                    "datatype": 'date',
                    "visible": false, //DataTables   
                }, {
                    "responsivePriority": 5,
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_source, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_source; ?>",
                    "data": 'DSP_FONTE',
                    "name": 'DSP_FONTE',
                    "type": "select",
                    "className": "visibleColumn",
                    "renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-level": 1,
                        "deferred": true,
                        "dependent-group": "AD_FONTES",
                        "data-db-name": "A.TECNICA_AVALIACAO@A.FONTE_AVALIACAO@A.DT_INI_FA@A.DT_INI_TAP",
                        "decodeFromTable": "RH_FONTES_PROC_AVAL_VW A",
                        "desigColumn": "A.DSP_FONTE",
                        "whereClause": "",
                        //"otherValues": "DESCRICAO", 
                        "orderBy": "A.FONTE_AVALIACAO",
                        "class": "form-control complexList chosen",
                        "style": "max-width: 335px;",
                        "filter": {
                            "create": " AND A.EMPRESA = ':EMPRESA' AND A.ID_PA = ':ID_PA' AND A.DT_INI_PA = TO_DATE(':DT_INI_PA', 'YYYY-MM-DD') AND A.ID_PROCESSO_AV = ':ID_PROCESSO_AV' AND A.DT_INI_PROCESSO = TO_DATE(':DT_INI_PROCESSO', 'YYYY-MM-DD') ", //On-New-Record
                            "edit": " AND A.EMPRESA = ':EMPRESA' AND A.ID_PA = ':ID_PA' AND A.DT_INI_PA = TO_DATE(':DT_INI_PA', 'YYYY-MM-DD') AND A.ID_PROCESSO_AV = ':ID_PROCESSO_AV' AND A.DT_INI_PROCESSO = TO_DATE(':DT_INI_PROCESSO', 'YYYY-MM-DD') ", //On-Edit-Record
                        }
                    }
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_FF',
                    "name": 'DT_INI_FF',
                    "datatype": 'date',
                    "def": "1900-01-01",
                    "className": "visibleColumn",
                    "attr": {//EDITOR CONTROL
                        "class": "datepicker" //dateTimePicker
                    }

                }, {
                    "title": "<?php echo mb_strtoupper($ui_event, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_event; ?>", //Editor
                    "data": 'FICHA_AVAL',
                    "name": 'FICHA_AVAL',
                    "type": "select",
                    "def": "S",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'GE_EVENTO_AVAL',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['GE_EVENTO_AVAL'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM_FF',
                    "name": 'DT_FIM_FF',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {//EDITOR CONTROL
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
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        //debugger;
                        return RH_FASES_FONTES_PROCESSO.crudButtons(true, true, true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DSP_FASE": {//Same as defined on attr.name
                        required: true,
                    },
                    "DT_INI_FF": {
                        required: true,
                        dateISO: true,
                    },
                    "DESCRICAO": {
                        maxlength: 4000,
                    },
                    "DT_FIM_FF": {
                        dateISO: true,
                        dateEqOrNextThan: "DT_INI_FF",
                    }
                },
                "messages": {
                    "DT_FIM_FF": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        RH_FASES_FONTES_PROCESSO = new QuadTable();
        RH_FASES_FONTES_PROCESSO.initTable($.extend({}, datatable_instance_defaults, optionsRH_FASES_FONTES_PROCESSO));
        //END SUB-TAB #2.3 :: Intervenction Matrix

        if (1 === 1) {

            $(document).on('RH_FASES_FONTES_PROCESSOAttachEvt', function (e) {
                // condicionamento na abertura do editor    
                setTimeout(function(){
                    var operacao_ = RH_FASES_FONTES_PROCESSO.editor.s["action"], 
                        frm_context = "#RH_FASES_FONTES_PROCESSO_editorForm"

//                        console.log("fase fontes processo oper",operacao_);
                });
            });

            //Geração de Matriz de Intervenção
            $(document).on('click', '#generateIntervMatrix', function (e) {
                e.stopPropagation();
                e.preventDefault();

                var processTitle, empresa_, plano_, dt_plano_, processo_, dt_processo_, estado_, el = $(this), btnTxt = el.html(), tmp, t1, t0 = performance.now();
                el.html(btnTxt + ' <i class="fas fa-cogs"></i>');
                el.addClass("disabled");
                quad_notification_clear();

                var x = RH_PROCESSOS_AVALIACAO.selectedRowData();
                try {
                    if (x['EMPRESA'] !== '' && x['EMPRESA'] !== 'undefined') {
                        empresa_ = x['EMPRESA'];
                    } else {
                        empresa_ = '';
                    }

                    if (x['ID_PA'] !== '' && x['ID_PA'] !== 'undefined') {
                        plano_ = x['ID_PA'];
                    } else {
                        plano_ = '';
                    }

                    if (x['DT_INI_PA'] !== '' && x['DT_INI_PA'] !== 'undefined') {
                        dt_plano_ = x['DT_INI_PA'];
                    } else {
                        dt_plano_ = '';
                    }

                    if (x['ID_PROCESSO_AV'] !== '' && x['ID_PROCESSO_AV'] !== 'undefined') {
                        processo_ = x['ID_PROCESSO_AV'];
                    } else {
                        processo_ = '';
                    }

                    if (x['DT_INI_PROCESSO'] !== '' && x['DT_INI_PROCESSO'] !== 'undefined') {
                        dt_processo_ = x['DT_INI_PROCESSO'];
                    } else {
                        dt_processo_ = '';
                    }

//                            if (x['ESTADO'] !== '' && x['ESTADO'] !== 'undefined') {
//                                estado_ = x['ESTADO'];
//                            } else {
//                                estado_ = '';
//                            }
                } catch(err) {
                    empresa_ = '';
                    plano_ = '';
                    dt_plano_ = '';
                    processo_ = '';
                    dt_processo_ = '';
                    estado_ = '';
                }    

                if (!empresa_ || !plano_ || !dt_plano_ || !processo_ || !dt_processo_) { 
                    processTitle = "<?php echo $warning_no_data; ?>"; 
                    quad_notification({
                            type: "info",
                            title : JS_OPERATION_ABORT,
                            content : '<i class="fas fa-clock"></i>&nbsp;<i>' + processTitle + '</i>',
                            timeout : 3500
                    });
                    el.removeClass("disabled");
                    el.html(btnTxt);
                } else {
                    var wk = new Worker(pn + "assets/lib/utils/workerAD.js"),
                        message = {
                            empresa: empresa_,
                            plano: plano_,
                            dt_plano: dt_plano_,
                            processo: processo_,
                            dt_processo: dt_processo_,
                            request_id: 'geracao_Matriz_Intervencao',
                            defaults: datatable_instance_defaults.pathToSqlFile
                        },
                        mssg = '';

                    wk.postMessage(JSON.stringify(message));
                    wk.onmessage = function (event) {                
                        if (event.data === 'working') {
                            RH_FASES_FONTES_PROCESSO.showProcess("<?php echo $ui_generate_intervention_matrix; ?>"); //Process ID;
                            return;
                        } else {
                            t1 = performance.now();
                            tmp = millisToMinutesAndSeconds(t1 - t0);
                            el.html( btnTxt );
                            el.removeClass("disabled");

                            if (event.data) {
                                if (event.data.msg) { 
                                    mssg = "<?php echo $msg_process_finished_ok; ?>";                                
                                    mssg = mssg.replace(" {0}", " " + tmp + " (MM:SS)");
                                    quad_notification({
                                            type: "success",
                                            title : JS_OPERATION_COMPLETED,
                                            content : '<i class="glyphicon glyphicon-thumbs-up"></i>&nbsp;<i>' + mssg + '</i>',
                                            timeout : 5000
                                    });
                                    $(this).prop("disabled", false);
                                    $('#refresh_RH_FASES_FONTES_PROCESSO').click();
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
                        RH_FASES_FONTES_PROCESSO.hideProcess();
                    };
                }
            });
            /* END Geração de Matriz de Intervenção */
        }

        //SUB-TAB #2.3.1 :: Teams (Shared Objectives)
        var optionsRH_FASE_EQP_OBJ_PARTILHADOS = {
            "tableId": "RH_FASE_EQP_OBJ_PARTILHADOS",
            "table": "RH_FASE_EQP_OBJ_PARTILHADOS",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_team; ?>",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_PA": {"type": "number"},
                    "DT_INI_PA": {"type": "date"},
                    "ID_PROCESSO_AV": {"type": "number"},
                    "DT_INI_PROCESSO": {"type": "date"},
                    "TECNICA_AVALIACAO": {"type": "varchar"},
                    "DT_INI_TAP": {"type": "date"},
                    "FONTE_AVALIACAO": {"type": "varchar"},
                    "DT_INI_FA": {"type": "date"},
                    "ID_FASE": {"type": "number"},
                    "DT_INI_FASE": {"type": "date"},
                    "DT_INI_FPA": {"type": "date"},
                    "ID_EQP_AVAL": {"type": "number"},
                    "DT_INI_DEA": {"type": "date"}
                }
            },
            "dependsOn": {
                "RH_FASES_FONTES_PROCESSO": {//External object key mapping( object key : external key)                    
                    "EMPRESA": "EMPRESA",
                    "ID_PA": "ID_PA",
                    "DT_INI_PA": "DT_INI_PA",
                    "ID_PROCESSO_AV": "ID_PROCESSO_AV",
                    "DT_INI_PROCESSO": "DT_INI_PROCESSO",
                    "ID_FASE": "ID_FASE",
                    "DT_INI_FASE": "DT_INI_FASE",
                    "DT_INI_FPA": "DT_INI_FPA",
                    "TECNICA_AVALIACAO": "TECNICA_AVALIACAO",
                    "DT_INI_FA": "DT_INI_FA",
                    "FONTE_AVALIACAO": "FONTE_AVALIACAO",
                    "DT_INI_TAP": "DT_INI_TAP"                      

                }
            },
            "detailsObjects": ['RH_EQP_AVALIACOES'],
            "order_by": "ID_EQP_AVAL",
            "recordBundle": 8,
            "pageLenght": 8,
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
                    "data": 'EMPRESA',
                    "name": 'EMPRESA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_PA',
                    "name": 'ID_PA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_PA',
                    "name": 'DT_INI_PA',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_PROCESSO_AV',
                    "name": 'ID_PROCESSO_AV',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_PROCESSO',
                    "name": 'DT_INI_PROCESSO',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'TECNICA_AVALIACAO',
                    "name": 'TECNICA_AVALIACAO',
                    "type": "hidden",
                    "visible": false,
                    "className": ""                 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_TAP',
                    "name": 'DT_INI_TAP',
                    "type": "hidden",
                    "visible": false,
                    "datatype": 'date'     
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'FONTE_AVALIACAO',
                    "name": 'FONTE_AVALIACAO',
                    "type": "hidden",
                    "visible": false,
                    "className": ""                 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_FA',
                    "name": 'DT_INI_FA',
                    "type": "hidden",
                    "visible": false,
                    "datatype": 'date'                             
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_FASE',
                    "name": 'ID_FASE',
                    "type": "hidden",
                    "visible": false,
                    "className": ""                 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_FASE',
                    "name": 'DT_INI_FASE',
                    "type": "hidden",
                    "visible": false,
                    "datatype": 'date'                      
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_FPA',
                    "name": 'DT_INI_FPA',
                    "type": "hidden",
                    "visible": false,
                    "datatype": 'date'                           
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_EQP_AVAL',
                    "name": 'ID_EQP_AVAL',
                    "type": "hidden",
                    "visible": false,
                    "className": ""                 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_DEA',
                    "name": 'DT_INI_DEA',
                    "type": "hidden",
                    "visible": false,
                    "datatype": 'date'                             
                }, {
                    "responsivePriority": 2,
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_team, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_team; ?>",
                    "data": 'DSP_EQUIPA',
                    "name": 'DSP_EQUIPA',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                                        
                    "attr": {
                        "dependent-group": "TEAMS",
                        "dependent-level": 1,
                        "deferred": true,
                        "data-db-name": 'A.EMPRESA@A.ID_EQP_AVAL@A.DT_INI_DEA',
                        "decodeFromTable": 'RH_DEF_EQUIPAS A',
                        "desigColumn": "CONCAT(CONCAT(A.ID_EQP_AVAL,'-'),A.DSP_EQUIPA)", 
                        "orderBy": "A.ID_EQP_AVAL", 
                        "class": "form-control complexList chosen",
                        //"disabled": true, //Permite inibir o campo no Editor
                        "filter": {
                            "create": " AND A.DT_FIM_DEA IS NULL AND A.EMPRESA = ':EMPRESA'", //On-New-Record
                            "edit": " AND A.DT_FIM_DEA IS NULL AND A.EMPRESA = ':EMPRESA'", //On-Edit-Record
                        }
                    }          
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_final_grade, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_final_grade; ?>", //Editor
                    "data": 'NOTA_FINAL',
                    "name": 'NOTA_FINAL',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 30%;"
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_description, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'OBS_1',
                    "name": 'OBS_1',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 335px",
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_obs_short, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_obs_short; ?>", //Editor
                    "data": 'OBS_2',
                    "name": 'OBS_2',
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
                        return RH_FASE_EQP_OBJ_PARTILHADOS.crudButtons(true, true, true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DSP_EQUIPA": {//Same as defined on attr.name
                        required: true,
                    },
                    "NOTA_FINAL": {
                        number: true
                    },
                    "DESCRICAO": {
                        maxlength: 4000,
                    },
                    "OBS_1": {
                        maxlength: 4000,
                    },
                    "OBS_2": {
                        maxlength: 4000,
                    }
                }
            }
        };
        RH_FASE_EQP_OBJ_PARTILHADOS = new QuadTable();
        RH_FASE_EQP_OBJ_PARTILHADOS.initTable($.extend({}, datatable_instance_defaults, optionsRH_FASE_EQP_OBJ_PARTILHADOS));          

        //Geração do Plano de Objetivos Institucionais
        $(document).on('click', '#RH_FASE_EQP_OBJ_PARTILHADOS_PlanoInstitucional', function (ev) {
            ev.preventDefault();
            ev.stopPropagation();
            alert('Geração do Plano de Objetivos Institucionais...');
        });
        //END SUB-TAB #2.3.1 :: Teams (Shared Objectives)

        //SUB-TAB #2.3.2 :: Team Members (Shared Objectives)
        var optionsRH_EQP_AVALIACOES = {
            "tableId": "RH_EQP_AVALIACOES",
            "table": "RH_EQP_AVALIACOES",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_EQP_AVAL": {"type": "number"},
                    "DT_INI_DEA": {"type": "date"},
                    "RHID": {"type": "number"},
                    "TP_REGISTO": {"type": "varchar"},
                    "DT_INI_EA": {"type": "date"}
                }
            },
            "dependsOn": {
                "RH_FASE_EQP_OBJ_PARTILHADOS": {//External object key mapping( object key : external key)                    
                    "EMPRESA": "EMPRESA",
                    "ID_EQP_AVAL": "ID_EQP_AVAL",
                    "DT_INI_DEA": "DT_INI_DEA"
                }
            },                 
            "order_by": "TP_REGISTO DESC, RHID",
            "recordBundle": 8,
            "pageLenght": 8,
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
                    "data": 'EMPRESA',
                    "name": 'EMPRESA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_EQP_AVAL',
                    "name": 'ID_EQP_AVAL',
                    "type": "hidden",
                    "visible": false,
                    "className": ""                 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_DEA',
                    "name": 'DT_INI_DEA',
                    "type": "hidden",
                    "visible": false,
                    "datatype": 'date'     
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'RHID',
                    "name": 'RHID',
                    "type": "hidden",
                    "visible": false,
                    "className": ""                        
                }, {
                    "responsivePriority": 2,
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_rhid, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_rhid; ?>",
                    "data": 'NOME_REDZ',
                    "name": 'NOME_REDZ',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                                        
                    "attr": {
                        "dependent-group": "COLABS",
                        "dependent-level": 1,
                        "deferred": true,
                        "data-db-name": 'A.RHID',
                        "distribute-value": "RHID",
                        "decodeFromTable": 'QUAD_NAMES A',
                        "desigColumn": "CONCAT(CONCAT(A.RHID,'-'),A.NOME_REDZ)", 
                        "orderBy": "A.RHID", 
                        "class": "form-control complexList chosen",
                        ///"disabled": true, //Permite inibir o campo no Editor
                        "filter": {
                            "create": " AND (A.RHID) IN (SELECT F.RHID FROM QUAD_PEOPLE F WHERE F.ATIVO = 'S' AND F.EMPRESA = ':EMPRESA' AND F.RHID NOT IN (SELECT G.RHID from RH_EQP_AVALIACOES G WHERE G.EMPRESA = ':EMPRESA' AND G.ID_EQP_AVAL = ':ID_EQP_AVAL' AND G.DT_INI_DEA = ':DT_INI_DEA') )", //On-New-Record
                            //"create": " AND (RHID) IN (SELECT RHID FROM QUAD_PEOPLE WHERE ATIVO = 'S' AND EMPRESA = ':EMPRESA')", //On-New-Record
                            "edit": " AND (A.RHID) IN (SELECT F.RHID FROM QUAD_PEOPLE F WHERE F.ATIVO = 'S' AND F.EMPRESA = ':EMPRESA' AND F.RHID NOT IN (SELECT G.RHID from RH_EQP_AVALIACOES G WHERE G.EMPRESA = ':EMPRESA' AND G.ID_EQP_AVAL = ':ID_EQP_AVAL' AND G.DT_INI_DEA = ':DT_INI_DEA') )", //On-Edit-Record
                        }
                    }          
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_type, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_type; ?>", //Editor
                    "data": 'TP_REGISTO',
                    "name": 'TP_REGISTO',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'RH_EQP_AVALIACOES.TP_REGISTO',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['RH_EQP_AVALIACOES.TP_REGISTO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }                             
                }, {
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_EA',
                    "name": 'DT_INI_EA',
                    "datatype": 'date',
                    //"def": "1900-01-01",
                    "className": "none visibleColumn",
                    "attr": {//EDITOR CONTROL
                        "class": "datepicker" //dateTimePicker
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM_EA',
                    "name": 'DT_FIM_EA',
                    "datatype": 'date',
                    "className": "none visibleColumn",
                    "attr": {//EDITOR CONTROL
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
                        return RH_EQP_AVALIACOES.crudButtons(true, true, true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "NOME_REDZ": {//Same as defined on attr.name
                        required: true,
                    },
                    "TP_REGISTO": {
                        required: true,
                    },            
                    "DT_INI_EA": {
                        required: true,
                        dateISO: true,
                    },                              
                    "DESCRICAO": {
                        maxlength: 4000,
                    },
                    "DT_FIM_EA": {
                        dateISO: true,
                        dateEqOrNextThan: "DT_INI_EA",
                    }
                },
                "messages": {
                    "DT_FIM_EA": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            } 
        };           
        RH_EQP_AVALIACOES = new QuadTable();
        RH_EQP_AVALIACOES.initTable($.extend({}, datatable_instance_defaults, optionsRH_EQP_AVALIACOES));
        //SUB-TAB #2.3.2 :: Team Members (Shared Objectives)

        //SUB-TAB #2.4.1 :: Evaluated
        var optionsRH_AVALIADOS = {
            "tableId": "RH_AVALIADOS",
            "table": "RH_AVALIADOS",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_evaluated; ?>",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_PA": {"type": "number"},
                    "DT_INI_PA": {"type": "date"},
                    "ID_PROCESSO_AV": {"type": "number"},
                    "DT_INI_PROCESSO": {"type": "date"},
                    "RHID": {"type": "number"},
                    "DT_ADMISSAO": {"type": "date"}
                }
            },
            "dependsOn": {
                "RH_PROCESSOS_AVALIACAO": {//External object key mapping( object key : external key)                    
                    "EMPRESA": "EMPRESA",
                    "ID_PA": "ID_PA",
                    "DT_INI_PA": "DT_INI_PA",
                    "ID_PROCESSO_AV": "ID_PROCESSO_AV",
                    "DT_INI_PROCESSO": "DT_INI_PROCESSO"
                }
            },
            "detailsObjects": ['RH_AVALIADORES'], 
            "order_by": "RHID",
            "recordBundle": 8,
            "pageLenght": 8,
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
                    "data": 'EMPRESA',
                    "name": 'EMPRESA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_PA',
                    "name": 'ID_PA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_PA',
                    "name": 'DT_INI_PA',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                    "datatype": 'date'
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_PROCESSO_AV',
                    "name": 'ID_PROCESSO_AV',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_PROCESSO',
                    "name": 'DT_INI_PROCESSO',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'RHID',
                    "name": 'RHID',
                    "type": "hidden",
                    "visible": false,
                    "className": ""                 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_ADMISSAO',
                    "name": 'DT_ADMISSAO',
                    "type": "hidden",
                    "visible": false,
                    "datatype": 'date'                    
                }, {
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_rhid, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_rhid; ?>",
                    "data": 'NOME_REDZ',
                    "name": 'NOME_REDZ',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                                        
                    "attr": {
                        "dependent-group": "COLABS",
                        "dependent-level": 1,
                        "deferred": true,
                        "data-db-name": 'A.EMPRESA@A.RHID@A.DT_ADMISSAO',
                        "decodeFromTable": 'QUAD_PEOPLE A',
                        "desigColumn": "CONCAT(CONCAT(A.RHID,'-'),A.NOME_REDZ)", 
                        "orderBy": "A.RHID", 
                        "class": "form-control complexList chosen",
                        //"disabled": true, //Permite inibir o campo no Editor
                        "filter": {
                            "create": " AND A.ATIVO = 'S' AND A.EMPRESA = ':EMPRESA'", //On-New-Record
                            "edit": " AND A.ATIVO = 'S' AND A.EMPRESA = ':EMPRESA'", //On-Edit-Record
                        }
                    }          
                }, {
                    "title": "<?php echo mb_strtoupper($ui_ok, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_ok; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_evaluated_ok; ?>",
                    "data": 'CONCORDANCIA',
                    "name": 'CONCORDANCIA',
                    "type": "hidden",
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
                        "class": "form-control defaultWidth"
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_comment, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_comment; ?>", //Editor
                    "data": 'COMENTARIO',
                    "name": 'COMENTARIO',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 335px",
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
                        return RH_AVALIADOS.crudButtons(true, true, false);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "NOME_REDZ": {
                        required: true,
                    },
                    "DESCRICAO": {
                        maxlength: 4000,
                    },
                    "COMENTARIO": {
                        maxlength: 4000,
                    }
                }
            }
        };
        RH_AVALIADOS = new QuadTable();
        RH_AVALIADOS.initTable($.extend({}, datatable_instance_defaults, optionsRH_AVALIADOS));

        //Mostra Esconde BOTAO
        $(document).on('click', '#RH_AVALIADOS > tbody', function (ev) {
            ev.stopImmediatePropagation();
            var x = RH_AVALIADOS.selectedRowData();                
            if (RH_AVALIADOS.tbl.rows( '.selected' ).any()){ //ROW IS SELECTED
                $("#RH_AVALIADOS_remove").show();
            } else {  //DESELECT ROW EVENT
                // esconder ações
                $("#RH_AVALIADOS_remove").hide();
            }            
        });

        /* TODO :: Remover AVALIADO do PROCESSO */
        $(document).on('click', '#RH_AVALIADOS_remove', function (ev) {
            ev.stopImmediatePropagation();
            var x = RH_AVALIADOS.selectedRowData(),t1, t0 = performance.now();
            if ( RH_AVALIADOS.tbl.rows( '.selected' ).any() ) {

                title = "<?php echo $ui_evaluated_removal;?>";
                quad_notification_clear();
                bootbox.confirm({
                    title: '<i class="fa fa-exclamation-triangle" style="color:#DF8505;"></i> ' + title,
                    message: "<?php echo $ui_confirm.' ?';?>",
                    centerVertical: !0,
                    swapButtonOrder: !0,
                    buttons: { confirm: { label: "<?php echo $ui_yes; ?>", className: "btn-danger shadow-0" }, cancel: { label: "<?php echo $ui_no; ?>", className: "btn-default" } },
                    className: "modal-alert",
                    closeButton: !1,
                    callback: function (t) {
                        if (t === 0) { // NÃO
                            msg = "<?php echo $ui_operation_canceled;?>";
                            quad_notification({
                                    type: "info",
                                    title: JS_OPERATION_ABORT,
                                    content: '<i class="fa fa-clock-o"></i>&nbsp;<i>' + msg + '</i>',
                                    timeout: 1500
                            });
                        }
                        if (t === 1) { // SIM
                            var wk = new Worker(pn + "assets/lib/utils/workerAD.js"),
                            message = {
                                    empresa: x["EMPRESA"],
                                    plano: x["ID_PA"],
                                    dt_plano: x["DT_INI_PA"],
                                    processo: x["ID_PROCESSO_AV"],
                                    dt_processo: x["DT_INI_PROCESSO"],
                                    rhid_avaliado: x["RHID"],
                                    request_id: 'REMOCAO_AVALIADO',
                                    defaults: datatable_instance_defaults.pathToSqlFile
                            },
                            mssg = '';

                            wk.postMessage(JSON.stringify(message));
                            wk.onmessage = function (event) {                
                                if (event.data === 'working') {
                                    //RH_AVALIADORES.showProcess("<?php echo $ui_select_new_evaluator.'(' . rhid_new_avaliador_ . ')'; ?>"); //Process ID;
                                    return;
                                } else {
                                    t1 = performance.now();
                                    tmp = millisToMinutesAndSeconds(t1 - t0);

                                    if (event.data) {
                                        if (event.data.msg) {
                                            /*
                                            mssg = "<?php echo $msg_process_finished_ok; ?>";                                
                                            mssg = mssg.replace(" {0}", " " + tmp + " (MM:SS)");
                                            quad_notification({
                                                    type: "success",
                                                    title : JS_OPERATION_COMPLETED,
                                                    content : '<i class="glyphicon glyphicon-thumbs-up"></i>&nbsp;<i>' + mssg + '</i>',
                                                    timeout : 5000
                                            });
                                            */
                                            //Refrescar os "Avaliados"
                                            //debugger;
                                            $(document).find('#refresh_RH_AVALIADOS').trigger('click');

                                        } else { //if (msg.indexOf("NOK:")) {
                                            var mssg = event.data.error;
                                            quad_notification({
                                                    type: "error",
                                                    title : JS_OPERATION_ERROR,
                                                    content : '<i class="glyphicon glyphicon-thumbs-down"></i>&nbsp;<i>' + mssg + '</i>'
                                                    //timeout : 10000
                                            });                    
                                        }
                                    }
                                }
                                //RH_AVALIADOS.hideProcess();
                            };
                        }
                    }
                })
                return false;
            }
            //console.log(x);
            //alert('TODO: Remover AVALIADO ' + x['NOME_REDZ'] + ' do processo. VER $(document).on(click, #removeAvaliados...');
        });
        //SUB-TAB #2.4.1 :: Evaluated

        //SUB-TAB #2.4.2 :: Evaluatores
        var optionsRH_AVALIADORES = {
            "tableId": "RH_AVALIADORES",
            "table": "RH_AVALIADORES",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_evaluated; ?>",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_PA": {"type": "number"},
                    "DT_INI_PA": {"type": "date"},
                    "ID_PROCESSO_AV": {"type": "number"},
                    "DT_INI_PROCESSO": {"type": "date"},
                    "RHID_AVALIADO": {"type": "number"},
                    "DT_ADMISSAO": {"type": "date"},
                    "RHID_AVALIADOR": {"type": "number"}
                }
            },
            "dependsOn": {
                "RH_AVALIADOS": {//External object key mapping( object key : external key)                    
                    "EMPRESA": "EMPRESA",
                    "ID_PA": "ID_PA",
                    "DT_INI_PA": "DT_INI_PA",
                    "ID_PROCESSO_AV": "ID_PROCESSO_AV",
                    "DT_INI_PROCESSO": "DT_INI_PROCESSO",
                    "RHID_AVALIADO": "RHID",
                    "DT_ADMISSAO": "DT_ADMISSAO"
                }
            },
            "order_by": "RHID_AVALIADO",
            "recordBundle": 8,
            "pageLenght": 8,
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
                    "data": 'EMPRESA',
                    "name": 'EMPRESA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_PA',
                    "name": 'ID_PA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_PA',
                    "name": 'DT_INI_PA',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_PROCESSO_AV',
                    "name": 'ID_PROCESSO_AV',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_PROCESSO',
                    "name": 'DT_INI_PROCESSO',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'RHID_AVALIADO',
                    "name": 'RHID_AVALIADO',
                    "type": "hidden",
                    "visible": false,
                    "className": ""                 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_ADMISSAO',
                    "name": 'DT_ADMISSAO',
                    "type": "hidden",
                    "visible": false,
                    "datatype": 'date'
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'RHID_AVALIADOR',
                    "name": 'RHID_AVALIADOR',
                    "type": "hidden",
                    "visible": false,
                    "className": ""
                }, {
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_evaluator, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_evaluator; ?>",
                    "fieldInfo": "<?php echo $hint_rhid_responsible_assesment; ?>",
                    "data": 'NOME_REDZ',
                    "name": 'NOME_REDZ',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                                        
                    "attr": {
                        "dependent-group": "COLABS",
                        "dependent-level": 1,
                        "deferred": true,
                        "data-db-name": 'A.RHID',
                        "distribute-value": "RHID_AVALIADOR",
                        "decodeFromTable": 'QUAD_NAMES A',
                        "desigColumn": "CONCAT(CONCAT(A.RHID,'-'),A.NOME_REDZ)", 
                        "orderBy": "A.RHID", 
                        "class": "form-control complexList chosen",
                        ///"disabled": true, //Permite inibir o campo no Editor
                        "filter": {
                            "create": " AND (A.RHID) IN (SELECT F.RHID FROM QUAD_PEOPLE F WHERE F.ATIVO = 'S' AND F.EMPRESA = ':EMPRESA' AND F.RHID != ':RHID_AVALIADO')", //On-New-Record
                            "edit": "  AND (A.RHID) IN (SELECT F.RHID FROM QUAD_PEOPLE F WHERE F.ATIVO = 'S' AND F.EMPRESA = ':EMPRESA' AND F.RHID != ':RHID_AVALIADO')", //On-Edit-Record
                        }
                    }  
                }, {
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_AVALIADOR',
                    "name": 'DT_INI_AVALIADOR',
                    "datatype": 'date',
                    //"def": "1900-01-01",
                    "className": "visibleColumn",
                    "attr": {//EDITOR CONTROL
                        "class": "datepicker" //dateTimePicker
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM_AVALIADOR',
                    "name": 'DT_FIM_AVALIADOR',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {//EDITOR CONTROL
                        "class": "datepicker" //dateTimePicker
                    }                        
                }, {
                    "title": "<?php echo mb_strtoupper($ui_profile, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_profile; ?>", //Editor
                    "data": 'PERFIL_ASSOCIADO',
                    "name": 'PERFIL_ASSOCIADO',
                    "type": "select",
                    "className": "visibleColumn",
                    attr: {
                        "domain-list": true,
                        "dependent-group": 'GE_PERFIL',
                        "class": "form-control",
                        "name": 'PERFIL_ASSOCIADO',
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['GE_PERFIL'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }                        
                }, {
                    "title": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_assessment, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_assessment, 'UTF-8'); ?>" + "</span>", //Editor
                    "data": 'TIT_AVALIACAO',
                    "name": '',
                    "type": "readonly",
                    "className": "none",
                    "defaultContent": "", //Must be used on STATIC columns content. On this case classes make there way...
                    "attr": {
                        "style": "display: none;"
                    }                      
                }, {
                    "responsivePriority": 3,
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_assessment_final, 'UTF-8'); ?>" + "</span>", //Datatables
                    "label": "<?php echo $ui_assessment_final; ?>", //Editor
                    "data": 'AVAL_FINAL',
                    "name": 'AVAL_FINAL',
                    "className": "none editorSubTitle visibleColumn",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 30%;"
                    }                   
                }, {
                    "responsivePriority": 3,
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_bonus_perc, 'UTF-8'); ?>" + "</span>", //Datatables
                    "label": "<?php echo $ui_bonus_perc; ?>", //Editor
                    "data": 'PERC_BONUS',
                    "name": 'PERC_BONUS',
                    "className": "none editorSubTitle visibleColumn",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 30%;"
                    } 
                }, {
                    "title": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_committee, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_committee, 'UTF-8'); ?>" + "</span>", //Editor
                    "data": '',
                    "name": 'TIT_AVALIACAO_COMITE',
                    "type": "readonly",
                    "className": "none",
                    "defaultContent": "", //Must be used on STATIC columns content. On this case classes make there way...
                    "attr": {
                        "style": "display: none;"
                    }                      
                }, {
                    "responsivePriority": 3,
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_assessment_final, 'UTF-8'); ?>" + "</span>", //Datatables
                    "label": "<?php echo $ui_assessment_final; ?>", //Editor
                    "data": 'AVAL_FINAL_EQP',
                    "name": 'AVAL_FINAL_EQP',
                    "className": "none editorSubTitle visibleColumn",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 30%;"
                    }                   
                }, {
                    "responsivePriority": 3,
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_bonus_perc, 'UTF-8'); ?>" + "</span>", //Datatables
                    "label": "<?php echo $ui_bonus_perc; ?>", //Editor
                    "data": 'PERC_BONUS_EQP',
                    "name": 'PERC_BONUS_EQP',
                    "className": "none editorSubTitle visibleColumn",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 30%;"
                    }                          
                }, {
                    "title": "<?php echo mb_strtoupper($ui_ok, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_ok; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_evaluater_ok; ?>",
                    "data": 'CONCORDANCIA',
                    "name": 'CONCORDANCIA',
                    "type": "hidden",
                    "def": "N",
                    "className": "none visibleColumn",
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
                    "title": "<?php echo mb_strtoupper($ui_comment, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_comment; ?>", //Editor
                    "data": 'COMENTARIO',
                    "name": 'COMENTARIO',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "name": 'COMENTARIO',
                        "style": "max-width: 335px",
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
                        return RH_AVALIADORES.crudButtons(true, true, true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "NOME_REDZ": {//Same as defined on attr.name
                        required: true,
                    },
                    "DT_INI_AVALIADOR": {
                        required: true,
                        dateISO: true,
                    },        
                    "NR_ORDEM": {
                        integer: true,
                        required: false,
                    },  
                    "AVAL_FINAL_EQP": {
                        number: true
                    },
                    "PERC_BONUS_EQP": {
                        number: true
                    },
                    "COMENTARIO": {
                        maxlength: 4000,
                    },
                    "DT_FIM_AVALIADOR": {
                        dateISO: true,
                        dateEqOrNextThan: "DT_INI_AVALIADOR",
                    }
                },
                "messages": {
                    "DT_FIM_AVALIADOR": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        RH_AVALIADORES = new QuadTable();
        RH_AVALIADORES.initTable($.extend({}, datatable_instance_defaults, optionsRH_AVALIADORES));

        //Mostra Esconde BOTAO
        $(document).on('click', '#RH_AVALIADORES > tbody', function (ev) {
            ev.stopImmediatePropagation();
            var x = RH_AVALIADORES.selectedRowData();
            if (RH_AVALIADORES.tbl.rows( '.selected' ).any()){ //ROW IS SELECTED
                $("#RH_AVALIADORES_switch").show();
            } else {  //DESELECT ROW EVENT
                // esconder ações
                $("#RH_AVALIADORES_switch").hide();
            }            
        });

        //Modal de TROCA de AVALIADOR
        $(document).on('click', '#RH_AVALIADORES_switch', function (ev) {
            ev.stopImmediatePropagation();
            var y = RH_AVALIADORES.selectedRowData(), x = RH_AVALIADOS.selectedRowData(), el = $("#DSP_NEW_AVALIADOR");
            if (RH_AVALIADOS.tbl.rows( '.selected' ).any() && RH_AVALIADORES.tbl.rows( '.selected' ).any()) {
                var params = [{
                    renew: true,
                    //idx: "A.RHID__QUAD_NAMES A__CONCAT(CONCAT(A.RHID,'-'),A.NOME_REDZ)__A.RHID__editRH_AVALIADORES*deferred",
                    pk: "RHID",
                    table: "QUAD_PEOPLE",
                    // TODO LEO :: whereClause vs where
                    //Deveria ser assim: mas o controlador de listas usa "where"
                    //whereClause: "AND (A.RHID) IN (SELECT F.RHID FROM QUAD_PEOPLE F WHERE F.ATIVO = 'S' AND F.EMPRESA = '" + y['EMPRESA']+ "' AND F.RHID NOT IN (" + y["RHID_AVALIADOR"] + ") )",
                    //O controlador de listas internamente usa o "where". Até esta versão estar assim, as chamadas "directas" usam este, e se for alterado no futuro usarão a de cima
                    where: "AND ATIVO = 'S' AND EMPRESA = '" + y['EMPRESA']+ "' AND RHID NOT IN (" + y["RHID_AVALIADOR"] + ") ",
                    //filter: " ..." só pode ser usado num cenário onde a ação é tb identificada no editor: "create" ou "edit"
                    orderBy: "RHID",
                    desigColumn: "CONCAT(CONCAT(RHID,'-'),NOME_REDZ)"
                }];

                var getListsData = function (params, obj, asyncBool, refresh) {
                    var promise = $.ajax({
                        type: "POST",
                        url: obj.pathToComplexListsFile,
                        data: {lists: params, multiRequest: true, refresh: refresh},
                        dataType: "text",
                        cache: false,
                        async: asyncBool,
                    });
                    return promise;
                }; 

                //Promise LOV call
                $.when( 
                    getListsData(params, RH_AVALIADORES, true, true)
                ).then(function(data) {
                    if ( data && JSON.parse(data) ) {
                        var dat= JSON.parse(data);
                        //console.log(dat);
                        if (dat["data"][0].length > 0) { //if results  fill dropdown etc.
                            var output = [];
                            output.push("<option> </option>");
                            _.map(dat["data"][0], function (ob, index) {
                                var oValues = ob["OTHERVALUES"]
                                    ? 'data-otherValues="' + ob["OTHERVALUES"] + '"'
                                    : "", unique = 'select';
                                if (dat["data"][0].length === 1) {
                                    output.push(
                                        '<option value="' +
                                        ob.VAL +
                                        '" ' +
                                        oValues +
                                        " selected='selected'>" +
                                        ob[Object.keys(ob)[0]] +
                                        "</option>"
                                    );
                                } else {
                                    output.push(
                                        '<option value="' +
                                        ob.VAL +
                                        '" ' +
                                        oValues +
                                        ">" +
                                        ob[Object.keys(ob)[0]] +
                                        "</option>"
                                    );
                                }
                            });
                            el.html(output.join(""));
                            el.removeClass("loadingList");
                            var options = {
                                no_results_text: "_RESULTS_VARIABLE",
                                placeholder_text_single: " ",
                                allow_single_deselect: true,
                                search_contains: true
                            };
                            //FORCE HOVER on CHOSEN
                            el.hover(function () {
                                el.chosen(options);
                                el.trigger("chosen:updated");
                            });                        
                            el.trigger("mouseover");
                            $('#DSP_AVALIADO').html(x['NOME_REDZ']);
                            $('#switch_AVALIADOR').modal({show:true});                    
                        } else {
                            alert('No Avaliadores');
                        }
                    }
                });        
            }
        });  

        //Botão de TROCA de AVALIADOR
        $('#ChangeAvaliador').on ('click', function (e) {
            var y = RH_AVALIADORES.selectedRowData(), x = RH_AVALIADOS.selectedRowData(), 
                rhid_new_avaliador_ = $("#DSP_NEW_AVALIADOR").val(),t1, t0 = performance.now(), selectorAvaliado;

            //DOM AVALIDOS SELECTED
            selectorAvaliado = RH_AVALIADOS.composeId(RH_AVALIADOS.pk.primary,RH_AVALIADOS.selectedRowData());

            if (rhid_new_avaliador_ !== '' && y["RHID_AVALIADOR"] !== '') {
            var wk = new Worker(pn + "assets/lib/utils/workerAD.js"),
            message = {
                    empresa: y["EMPRESA"],
                    plano: y["ID_PA"],
                    dt_plano: y["DT_INI_PA"],
                    processo: y["ID_PROCESSO_AV"],
                    dt_processo: y["DT_INI_PROCESSO"],
                    rhid_avaliado: y["RHID_AVALIADO"],
                    rhid_old_avaliador: y["RHID_AVALIADOR"],
                    rhid_new_avaliador: rhid_new_avaliador_,
                    request_id: 'TROCA_AVALIADOR',
                    defaults: datatable_instance_defaults.pathToSqlFile
            },
            mssg = '';

            wk.postMessage(JSON.stringify(message));
            wk.onmessage = function (event) {                
                if (event.data === 'working') {
                    return;
                } else {
                    t1 = performance.now();
                    tmp = millisToMinutesAndSeconds(t1 - t0);

                    if (event.data) {
                            if (event.data.error !== '') {
                                var mssg = event.data.error;
                                quad_notification({
                                        type: "error",
                                        title : JS_OPERATION_ERROR,
                                        content : '<i class="glyphicon glyphicon-thumbs-down"></i>&nbsp;<i>' + mssg + '</i>'
                                });
                            } else {
                                /*
                                mssg = "<?php echo $msg_process_finished_ok; ?>";                                
                                mssg = mssg.replace(" {0}", " " + tmp + " (MM:SS)");
                                quad_notification({
                                        type: "success",
                                        title : JS_OPERATION_COMPLETED,
                                        content : '<i class="glyphicon glyphicon-thumbs-up"></i>&nbsp;<i>' + mssg + '</i>',
                                        timeout : 5000
                                });
                                */
                                //Seleção do "Avaliado" para refrescar os "Avaliadores"
                                $(document).find('#refresh_RH_AVALIADORES').trigger('click');
                        }
                    }
                }
            };
            }
        });
        //SUB-TAB #2.4.2 :: Evaluatores

        //SUB-TAB #2.5 :: Schedule
        var optionsRH_AVALIADOR_FASES = {
            "tableId": "RH_AVALIADOR_FASES",
            "table": "RH_AVALIADOR_FASES",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_PA": {"type": "number"},
                    "DT_INI_PA": {"type": "date"},
                    "ID_PROCESSO_AV": {"type": "number"},
                    "DT_INI_PROCESSO": {"type": "date"},
                    "RHID_AVALIADO": {"type": "number"},
                    "DT_ADMISSAO": {"type": "date"},
                    "RHID_AVALIADOR": {"type": "number"},                        
                    "ID_FASE": {"type": "number"},
                    "DT_INI_FASE": {"type": "date"},                        
                    "DT_INI_FPA": {"type": "date"},
                    "DT_INI_AF": {"type": "date"}                        
                }
            },
            "dependsOn": {
                "RH_PROCESSOS_AVALIACAO": {//External object key mapping( object key : external key)                    
                    "EMPRESA": "EMPRESA",
                    "ID_PA": "ID_PA",
                    "DT_INI_PA": "DT_INI_PA",
                    "ID_PROCESSO_AV": "ID_PROCESSO_AV",
                    "DT_INI_PROCESSO": "DT_INI_PROCESSO"
                }
            },
            "order_by": "ID_FASE, DT_INI_AF, RHID_AVALIADO",
            "recordBundle": 8,
            "pageLenght": 8,
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
                    "data": 'EMPRESA',
                    "name": 'EMPRESA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_PA',
                    "name": 'ID_PA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_PA',
                    "name": 'DT_INI_PA',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_PROCESSO_AV',
                    "name": 'ID_PROCESSO_AV',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_PROCESSO',
                    "name": 'DT_INI_PROCESSO',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_FASE',
                    "name": 'ID_FASE',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_FASE',
                    "name": 'DT_INI_FASE',
                    "type": "hidden", //Editor
                    "datatype": 'date',
                    "visible": false, //DataTables                                        
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_FPA',
                    "name": 'DT_INI_FPA',
                    "type": "hidden", //Editor
                    "datatype": 'date',
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 4,
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_phase, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_phase; ?>",
                    "data": 'DSP_FASE',
                    "name": 'DSP_FASE',
                    "type": "select",
                    "className": "visibleColumn",
                    "renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-level": 1,
                        "deferred": true,
                        "dependent-group": "AD_FASES",
                        "data-db-name": "A.ID_FASE@A.DT_INI_FASE@A.DT_INI_FPA",
                        "decodeFromTable": "RH_FASES_PROC_AVAL_VW A",
                        "desigColumn": "CONCAT(CONCAT(A.ID_FASE,'-'),A.DSP_FASE)",
                        "whereClause": "",
                        //"otherValues": "DESCRICAO", 
                        "orderBy": "ID_FASE",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.EMPRESA = ':EMPRESA' AND A.ID_PA = ':ID_PA' AND A.DT_INI_PA = TO_DATE(':DT_INI_PA', 'YYYY-MM-DD') AND A.ID_PROCESSO_AV = ':ID_PROCESSO_AV' AND A.DT_INI_PROCESSO = TO_DATE(':DT_INI_PROCESSO', 'YYYY-MM-DD') ", //On-New-Record
                            "edit": " AND A.EMPRESA = ':EMPRESA' AND A.ID_PA = ':ID_PA' AND A.DT_INI_PA = TO_DATE(':DT_INI_PA', 'YYYY-MM-DD') AND A.ID_PROCESSO_AV = ':ID_PROCESSO_AV' AND A.DT_INI_PROCESSO = TO_DATE(':DT_INI_PROCESSO', 'YYYY-MM-DD') ", //On-Edit-Record
                        }
                    }                        

                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'RHID_AVALIADO',
                    "name": 'RHID_AVALIADO',
                    "type": "hidden",
                    "visible": false,
                    "className": ""                 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_ADMISSAO',
                    "name": 'DT_ADMISSAO',
                    "type": "hidden",
                    "visible": false,
                    "datatype": 'date'                
                }, {
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_rhid_assessed, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_rhid_assessed; ?>",
                    "data": 'NOME_REDZ',
                    "name": 'NOME_REDZ',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                                        
                    "attr": {
                        "dependent-group": "COLABS",
                        "dependent-level": 1,
                        "deferred": true,
                        "data-db-name": 'A.EMPRESA@A.RHID@A.DT_ADMISSAO',
                        "distribute-value": "EMPRESA@RHID_AVALIADO@DT_ADMISSAO",
                        "decodeFromTable": 'QUAD_PEOPLE A',
                        "desigColumn": "CONCAT(CONCAT(A.RHID,'-'),A.NOME_REDZ)", 
                        "orderBy": "A.RHID", 
                        "class": "form-control complexList chosen",
                        //"disabled": true, //Permite inibir o campo no Editor
                        "filter": {
                            "create": " AND A.ATIVO = 'S' AND A.EMPRESA = ':EMPRESA'", //On-New-Record
                            "edit": " AND A.ATIVO = 'S' AND A.EMPRESA = ':EMPRESA'", //On-Edit-Record
                        }
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'RHID_AVALIADOR',
                    "name": 'RHID_AVALIADOR',
                    "type": "hidden",
                    "visible": false,
                    "className": ""
                }, {
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_evaluator, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_evaluator; ?>",
                    "fieldInfo": "<?php echo $hint_rhid_responsible_assesment; ?>",
                    "data": 'NOME_AVALIADOR',
                    "name": 'NOME_AVALIADOR',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                                        
                    "attr": {
                        "dependent-group": "COLABS",
                        "dependent-level": 2,
                        "deferred": true,
                        "data-db-name": 'RHID',
                        "distribute-value": "RHID_AVALIADOR",
                        "decodeFromTable": 'QUAD_PEOPLE',
                        "desigColumn": "CONCAT(CONCAT(RHID,'-'),NOME_REDZ)",
                        "orderBy": "RHID",
                        "class": "form-control complexList chosen",
                        ///"disabled": true, //Permite inibir o campo no Editor
                        "filter": {
                            "create": " AND ATIVO = 'S' AND EMPRESA = ':EMPRESA' AND RHID != ':RHID_AVALIADO' ", //On-New-Record
                            "edit": "  AND ATIVO = 'S' AND EMPRESA = ':EMPRESA' AND RHID != ':RHID_AVALIADO' ", //On-Edit-Record
                        }
                    }           
                }, {
                    "title": "<?php echo mb_strtoupper($ui_weight, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_weight; ?>", //Editor
                    "data": 'PESO',
                    "name": 'PESO',
                    "className": "visibleColumn right",
                    "attr": {
                        "name": 'PESO',
                        "class": "form-control toRight",
                        "style": "width: 30%;"
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_AF',
                    "name": 'DT_INI_AF',
                    "datatype": 'date',
                    "def": hoje(),
                    "className": "visibleColumn",
                    "attr": {//EDITOR CONTROL
                        "class": "datepicker" //dateTimePicker
                    }      
                }, {
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM_AF',
                    "name": 'DT_FIM_AF',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {//EDITOR CONTROL
                        "class": "datepicker" //dateTimePicker
                    }                        
                }, {
                    "title": "<?php echo mb_strtoupper($ui_state, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_state; ?>", //Editor
                    "data": 'ESTADO',
                    "name": 'ESTADO',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'GE_ESTADO_FA',
                        "class": "form-control",
                        "name": 'ESTADO',
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['GE_ESTADO_FA'], {'RV_LOW_VALUE': val});
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
                        "name": 'DESCRICAO',
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
                        //debugger;
                        return RH_AVALIADOR_FASES.crudButtons(true, true, true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DSP_FASE": {
                        required: true,
                    },
                    "NOME_REDZ": {
                        required: true,
                    },
                    "NOME_AVALIADOR": {
                        required: true,
                    },
                    "PESO": {
                        number: true
                    },
                    "DT_INI_AF": {
                        required: true,
                        dateISO: true,
                    },
                    "DESCRICAO": {
                        maxlength: 4000,
                    },
                    "DT_FIM_AF": {
                        dateISO: true,
                        dateEqOrNextThan: "DT_INI_AF",
                    }
                },
                "messages": {
                    "DT_FIM_AF": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };            
        RH_AVALIADOR_FASES = new QuadTable();
        RH_AVALIADOR_FASES.initTable($.extend({}, datatable_instance_defaults, optionsRH_AVALIADOR_FASES));
        //END SUB-TAB #2.5 :: Schedule

        //SUB-TAB #2.6 :: Assessment Process Trads
        var optionsRH_PROCESSOS_AVALIACAO_TRADS = {
            "tableId": "RH_PROCESSOS_AVALIACAO_TRADS",
            "table": "RH_PROCESSOS_AVALIACAO_TRADS",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_PA": {"type": "number"},
                    "DT_INI_PA": {"type": "date"},
                    "ID_PROCESSO_AV": {"type": "number"},
                    "DT_INI_PROCESSO": {"type": "date"},
                    "CD_LINGUA": {"type": "number"},
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "RH_PROCESSOS_AVALIACAO": {//External object key mapping( object key : external key)                    
                    "EMPRESA": "EMPRESA",
                    "ID_PA": "ID_PA",
                    "DT_INI_PA": "DT_INI_PA",
                    "ID_PROCESSO_AV": "ID_PROCESSO_AV",
                    "DT_INI_PROCESSO": "DT_INI_PROCESSO"
                }
            },
            "order_by": "CD_LINGUA, DT_INI DESC",
            "recordBundle": 8,
            "pageLenght": 8,
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
                    "data": 'EMPRESA',
                    "name": 'EMPRESA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_PA',
                    "name": 'ID_PA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_PA',
                    "name": 'DT_INI_PA',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_PROCESSO_AV',
                    "name": 'ID_PROCESSO_AV',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_PROCESSO',
                    "name": 'DT_INI_PROCESSO',
                    "datatype": 'date',
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
                        "class": "form-control complexList chosen", //class complexList Mandatory . we have to catch events like change and chain select event
                        "desigColumn": "A.DSR_LINGUA", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.                        
                        "orderBy": "A.NR_ORDEM, A.CD_LINGUA", //usado no complexList.php
                        //"disabled": true, //Permite inibir o campo no Editor
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
                        "class": "datepicker" //dateTimePicker
                    }
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_TRAD',
                    "name": 'DSP_TRAD',
                    "className": "visibleColumn"
                }, {
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_TRAD',
                    "name": 'DSR_TRAD',
                    "className": "visibleColumn"
                }, {
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM',
                    "name": 'DT_FIM',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {//EDITOR CONTROL
                        "class": "datepicker" //dateTimePicker
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_objectives, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_objectives; ?>", //Editor
                    "data": 'OBJECTIVOS',
                    "name": 'OBJECTIVOS',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 335px",
                        "class": "form-control defaultWidth",
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
                        //debugger;
                        return RH_PROCESSOS_AVALIACAO_TRADS.crudButtons(true, true, true);
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
                        maxlength: 80,
                    },
                    "DSR_TRAD": {
                        required: true,
                        maxlength: 25,
                    },
                    "DT_FIM": {
                        dateISO: true,
                    },
                    "OBJETIVOS ": {
                        maxlength: 4000,
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
        RH_PROCESSOS_AVALIACAO_TRADS = new QuadTable();
        RH_PROCESSOS_AVALIACAO_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsRH_PROCESSOS_AVALIACAO_TRADS));
        //END SUB-TAB #2.6 :: Assessment Process Trads            

        //Master Assesment View :: TAB #3
        var optionsMASTER_AVALIACAO = {
            "tableId": "MASTER_AVALIACAO",
            "table": "MASTER_AVALIACAO",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_evaluation_process; ?>",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_PA": {"type": "number"},
                    "DT_INI_PA": {"type": "date"},
                    "ID_PROCESSO_AV": {"type": "number"},
                    "DT_INI_PROCESSO": {"type": "date"},
                    "RHID": {"type": "number"},
                    "DT_ADMISSAO": {"type": "date"},
                    "RHID_AVALIADOR": {"type": "number"},
                    "ID_FASE": {"type": "number"},
                    "DT_INI_FASE": {"type": "date"},
                    "DT_INI_FPA": {"type": "date"},
                    "DT_INI_AF": {"type": "date"}
                }
            }, 
            "externalFilter": {
                "template": {
                    "selector": "#masterEvalView",
                    "mandatory": ['DSP_EMPRESA_1','DSP_PA_1'], //, 'DSP_DIRECAO', 'DSP_DEPT'], //mandatory
                    "optional": ['DSP_PROCESSO']
                }
            },
            /*
            "crudOnMasterInactive": {
                "condition": "data.ESTADO != 'A' ",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },        
            */
            "initialWhereClause": " ESTADO !='Z' AND GE_ESTADO_PROC_AVALIACAO(EMPRESA,ID_PA,DT_INI_PA,ID_PROCESSO_AV,DT_INI_PROCESSO) IN ('E','F') ", //SÓ ESTADOS COM FICHAS DE AVALIAÇÃO!!!
            "detailsObjects": ['RH_FICHA_AVAL_COMPORTAMENTOS','RH_ID_AVALIACAO_OBJECTIVOS','RH_RESUME_COMPETENCIAS_FA','RH_RESUME_OBJECTIVOS_FA'],
            "order_by": "EMPRESA ASC, ID_PA DESC, ID_PROCESSO_AV DESC, RHID ASC, ID_FASE ASC",
            "recordBundle": 6,
            "pageLenght": 6,
            "scrollY": "175",
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
                    "responsivePriority": 2,
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_company, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_company; ?>",
                    "data": 'DSP_EMPRESA_1',
                    "name": 'DSP_EMPRESA_1',
                    "type": "select",
                    "className": "visibleColumn",
                    "visible": false, //DataTables
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "EMPRESA",
                        "dependent-level": 1,
                        "data-db-name": "A.EMPRESA",
                        "decodeFromTable": "DG_EMPRESAS A", //TO CHANGE ON QUAD-HCM
                        "desigColumn": "A.EMPRESA",
                        "orderBy": "A.NR_ORDEM",
                        "class": "form-control complexList chosen"
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_PA',
                    "name": 'ID_PA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_PA',
                    "name": 'DT_INI_PA',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 3,
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_evaluation_plan, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_evaluation_plan; ?>",
                    "data": 'DSP_PA_1',
                    "name": 'DSP_PA_1',
                    "type": "select",
                    "className": "visibleColumn",
                    "renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "EMPRESA",
                        "dependent-level": 2,
                        "data-db-name": "A.EMPRESA@A.ID_PA@A.DT_INI_PA",
                        "decodeFromTable": "RH_PLANOS_AVALIACAO A", //TO CHANGE ON QUAD-HCM
                        "desigColumn": "A.DSP_PA",
                        'whereClause': "",
                        "orderBy": "A.EMPRESA, A.ID_PA DESC",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.DT_FIM_PA IS NULL", //On-New-Record
                            "edit": " AND A.DT_FIM_PA IS NULL", //On-Edit-Record
                        }
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_PROCESSO_AV',
                    "name": 'ID_PROCESSO_AV',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 4,
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_evaluation_process, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_evaluation_process; ?>",
                    "data": 'DSP_PROCESSO',
                    "name": 'DSP_PROCESSO',
                    "type": "select",
                    "className": "visibleColumn",
                    "renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "EMPRESA",
                        "dependent-level": 3,
                        "data-db-name": "A.EMPRESA@A.ID_PA@A.DT_INI_PA@A.ID_PROCESSO_AV@A.DT_INI_PROCESSO",
                        "decodeFromTable": "RH_PROCESSOS_AVALIACAO A", //TO CHANGE ON QUAD-HCM
                        "desigColumn": "A.DSP_PROCESSO",
                        'whereClause': '',
                        "orderBy": "A.EMPRESA, A.ID_PA, A.ID_PROCESSO_AV DESC",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.DT_FIM_PA IS NULL", //On-New-Record
                            "edit": " AND A.DT_FIM_PA IS NULL", //On-Edit-Record
                        }
                    }                        
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'RHID',
                    "name": 'RHID',
                    "type": "hidden",
                    "visible": false,
                    "className": ""                 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_ADMISSAO',
                    "name": 'DT_ADMISSAO',
                    "type": "hidden",
                    "visible": false,
                    "datatype": 'date'                 
                }, {
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_rhid_assessed, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_rhid_assessed; ?>",
                    "data": 'NOME_REDZ',
                    "name": 'NOME_REDZ',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                                        
                    "attr": {
                        "dependent-group": "COLABS",
                        "dependent-level": 1,
                        "data-db-name": 'A.EMPRESA@A.RHID@A.DT_ADMISSAO',
                        //"distribute-value": "EMPRESA@RHID@DT_ADMISSAO",
                        "decodeFromTable": 'QUAD_PEOPLE A',
                        "desigColumn": "CONCAT(CONCAT(A.RHID,'-'),A.NOME_REDZ)", 
                        "orderBy": "A.RHID", 
                        "class": "form-control complexList chosen",
                        //"disabled": true, //Permite inibir o campo no Editor
                    }                          
               }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_FASE',
                    "name": 'ID_FASE',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_FASE',
                    "name": 'DT_INI_FASE',
                    "type": "hidden", //Editor
                    "datatype": 'date',
                    "visible": false, //DataTables                                        
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_FPA',
                    "name": 'DT_INI_FPA',
                    "type": "hidden", //Editor
                    "datatype": 'date',
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 4,
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_phase, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_phase; ?>",
                    "data": 'DSP_FASE',
                    "name": 'DSP_FASE',
                    "type": "select",
                    "className": "visibleColumn",
                    "renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-level": 1,
                        "dependent-group": "AD_FASES",
                        "data-db-name": "A.ID_FASE@A.DT_INI_FASE@A.DT_INI_FPA",
                        "decodeFromTable": "RH_FASES_PROC_AVAL_VW A",
                        "desigColumn": "CONCAT(CONCAT(A.ID_FASE,'-'),A.DSP_FASE)",
                        "whereClause": "",
                        //"otherValues": "DESCRICAO", 
                        "orderBy": "A.ID_FASE",
                        "class": "form-control complexList chosen",
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'RHID_AVALIADOR',
                    "name": 'RHID_AVALIADOR',
                    "type": "hidden",
                    "visible": false,
                    "className": ""
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_AF',
                    "name": 'DT_INI_AF',
                    "type": "hidden", //Editor
                    "datatype": 'date',
                    "visible": false, //DataTables                        
                }, {
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_evaluator, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_evaluator; ?>",
                    "fieldInfo": "<?php echo $hint_rhid_responsible_assesment; ?>",
                    "data": 'NOME_AVALIADOR',
                    "name": 'NOME_AVALIADOR',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                                        
                    "attr": {
                        "dependent-group": "EMPS",
                        "dependent-level": 1,
                        "data-db-name": 'A.RHID',
                        "distribute-value": "RHID_AVALIADOR",
                        "decodeFromTable": 'QUAD_NAMES A',
                        "desigColumn": "CONCAT(CONCAT(A.RHID,'-'),A.NOME_REDZ)", 
                        "orderBy": "A.RHID", 
                        "class": "form-control complexList chosen",
                    }                           
                }, {
                    "responsivePriority": 5,
                    "title": "<?php echo mb_strtoupper($ui_state, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_state; ?>", //Editor
                    "data": 'ESTADO',
                    "name": 'ESTADO',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'GE_ESTADO_FA',
                        "class": "form-control chosen",
                        "name": 'ESTADO',
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['GE_ESTADO_FA'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }                        
                }, {
                    "responsivePriority": 6,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_PROCESSO',
                    "name": 'DT_INI_PROCESSO',
                    "datatype": 'date',
                    "def": hoje(),
                    "className": "visibleColumn",
                    "attr": {
                        "name": 'DT_INI_PPROCESSO',
                        "class": "form-control datepicker"
                    }                        
                }, {
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>" + "</span>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM_PROCESSO',
                    "name": 'DT_FIM_PROCESSO',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "form-control datepicker"
                    }
                }, {
                    "title": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_assessment, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_assessment, 'UTF-8'); ?>" + "</span>", //Editor
                    "data": '',
                    "name": 'TIT_PER_AVALIACAO',
                    "type": "readonly",
                    "className": "none",
                    "defaultContent": "", //Must be used on STATIC columns content. On this case classes make there way...
                    "attr": {
                        "style": "display: none;"
                    }                      
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>" + "</span>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_AVALIACAO',
                    "name": 'DT_INI_AVALIACAO',
                    "datatype": 'date',
                    "def": hoje(),
                    "className": "none editorSubTitle visibleColumn",
                    "attr": {
                        "name": 'DT_INI_AVALIACAO',
                        "class": "form-control datepicker"
                    }
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>" + "</span>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM_AVALIACAO',
                    "name": 'DT_FIM_AVALIACAO',
                    "datatype": 'date',
                    "def": hoje(),
                    "className": "none editorSubTitle visibleColumn",
                    "attr": {
                        "class": "form-control datepicker"
                    }
                }, {
                    "title": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_skills_assessment, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_skills_assessment, 'UTF-8'); ?>" + "</span>", //Editor
                    //"fieldInfo": "<?php echo $hint_requires_previous_authorizarion; ?>",
                    "data": 'AVAL_COMPETENCIAS',
                    "name": 'AVAL_COMPETENCIAS',
                    "type": "select",
                    "def": "N",
                    "className": "none visibleColumn",
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
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_functional_group, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<?php echo $ui_functional_group; ?>", //Editor
                    "data": 'AC_GRP_FUNCIONAL',
                    "name": 'AC_GRP_FUNCIONAL',
                    "type": "select",
                    "def": "N",
                    "className": "none editorSubTitle visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',
                        "class": "form-control ac"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_SIM_NAO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_structure, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<?php echo $ui_structure; ?>", //Editor
                    "data": 'AC_ESTRUTURA',
                    "name": 'AC_ESTRUTURA',
                    "type": "select",
                    "def": "N",
                    "className": "none editorSubTitle visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',
                        "class": "form-control ac"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_SIM_NAO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_function, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<?php echo $ui_function; ?>", //Editor
                    "data": 'AC_FUNCAO',
                    "name": 'AC_FUNCAO',
                    "type": "select",
                    "def": "N",
                    "className": "none editorSubTitle visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',
                        "class": "form-control ac"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_SIM_NAO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_personal, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<?php echo $ui_personal; ?>", //Editor
                    "data": 'AC_COLABORADOR',
                    "name": 'AC_COLABORADOR',
                    "type": "select",
                    "def": "N",
                    "className": "none editorSubTitle visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',
                        "class": "form-control ac"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_SIM_NAO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }
                }, {
                    "title": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_objectives_assessment, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_objectives_assessment, 'UTF-8'); ?>" + "</span>", //Editor
                    //"fieldInfo": "<?php echo $hint_requires_previous_authorizarion; ?>",
                    "data": 'AVAL_OBJECTIVOS',
                    "name": 'AVAL_OBJECTIVOS',
                    "type": "select",
                    "def": "N",
                    "className": "none visibleColumn",
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
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_functional_group, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<?php echo $ui_functional_group; ?>", //Editor
                    "data": 'AO_GRP_FUNCIONAL',
                    "name": 'AO_GRP_FUNCIONAL',
                    "type": "select",
                    "def": "N",
                    "className": "none editorSubTitle visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',
                        "class": "form-control ao"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_SIM_NAO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_structure, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<?php echo $ui_structure; ?>", //Editor
                    "data": 'AO_ESTRUTURA',
                    "name": 'AO_ESTRUTURA',
                    "type": "select",
                    "def": "N",
                    "className": "none editorSubTitle visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',
                        "class": "form-control ao"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_SIM_NAO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_function, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<?php echo $ui_function; ?>", //Editor
                    "data": 'AO_FUNCAO',
                    "name": 'AO_FUNCAO',
                    "type": "select",
                    "def": "N",
                    "className": "none editorSubTitle visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',
                        "class": "form-control ao"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_SIM_NAO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_personal, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<?php echo $ui_personal; ?>", //Editor
                    "data": 'AO_COLABORADOR',
                    "name": 'AO_COLABORADOR',
                    "type": "select",
                    "def": "N",
                    "className": "none editorSubTitle visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',
                        "class": "form-control ao"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_SIM_NAO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }
                }, {
                    "title": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_shared_objectives_assessment, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_shared_objectives_assessment, 'UTF-8'); ?>" + "</span>", //Editor
                    "data": 'AVAL_OBJ_PARTILHADOS',
                    "name": 'AVAL_OBJ_PARTILHADOS',
                    "type": "select",
                    "def": "N",
                    "className": "none visibleColumn",
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
                    "title": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_final_scores, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_final_scores, 'UTF-8'); ?>" + "</span>", //Editor
                    "data": '',
                    "name": 'TIT_AVAL_FINAL',
                    "type": "readonly",
                    "className": "none",
                    "defaultContent": "", //Must be used on STATIC columns content. On this case classes make there way...
                    "attr": {
                        "style": "display: none;"
                    }              
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_skills, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<?php echo $ui_skills; ?>", //Editor
                    "data": 'TOT_COMPETENCIA',
                    "name": 'TOT_COMPETENCIA',
                    "className": "none editorSubTitle visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 30%;"
                    }                        
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_objectives, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<?php echo $ui_objectives; ?>", //Editor
                    "data": 'TOT_OBJECTIVO',
                    "name": 'TOT_OBJECTIVO',
                    "className": "none editorSubTitle visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 30%;"
                    }
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_phase_grade, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<?php echo $ui_phase_grade; ?>", //Editor
                    "data": 'NOTA_AVAL_FASE',
                    "name": 'NOTA_AVAL_FASE',
                    "className": "none editorSubTitle visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 30%;"
                    }           
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_weight, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<?php echo $ui_weight; ?>", //Editor
                    "data": 'PESO',
                    "name": 'PESO',
                    "className": "none editorSubTitle visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 30%;"
                    }
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_final_grade, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<?php echo $ui_final_grade; ?>", //Editor
                    "data": 'NOTA_FINAL',
                    "name": 'NOTA_FINAL',
                    "className": "none editorSubTitle visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 30%;"
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_committee, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_committee; ?>", //Editor
                    "data": 'COMITE',
                    "name": 'COMITE',
                    "type": "select",
                    "def": "Z",
                    "className": "none visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'RH_PROCESSOS_AVALIACAO.COMITE',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['RH_PROCESSOS_AVALIACAO.COMITE'], {'RV_LOW_VALUE': val});
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
                        return MASTER_AVALIACAO.crudButtons(false,true,false);
                    }
                }
            ],
            "validations": {
                "rules": {
                }
            }
        };
        MASTER_AVALIACAO = new QuadTable();
        MASTER_AVALIACAO.initTable($.extend({}, datatable_instance_defaults, optionsMASTER_AVALIACAO));

        $(document).on('MASTER_AVALIACAOAttachEvt', function (e) {
            var frm_context = "#MASTER_AVALIACAO_editorForm", dt_1 = '', dt_2 = '', operacao = MASTER_AVALIACAO.editor.s["action"]; //PREVIOUS VERSION -> RH_PROCESSOS_AVALIACAO.editor.s.editOpts["action"];

                if (operacao === 'edit') { 
                    $('div.DTE_Field.row.DTE_Field_Name_ESTADO', frm_context).css('display', 'block');
                    $('div.DTE_Field.row.DTE_Field_Name_DSP_PROCESSO', frm_context).css('display', 'none');
                    $('div.DTE_Field.row.DTE_Field_Name_NOME_REDZ', frm_context).css('display', 'none');
                    $('div.DTE_Field.row.DTE_Field_Name_DSP_FASE', frm_context).css('display', 'none');
                    $('div.DTE_Field.row.DTE_Field_Name_NOME_AVALIADOR', frm_context).css('display', 'none');
                    $('div.DTE_Field.row.DTE_Field_Name_DT_INI_PROCESSO', frm_context).css('display', 'none');
                    $('div.DTE_Field.row.DTE_Field_Name_DT_FIM_PROCESSO', frm_context).css('display', 'none');
                    $('div.DTE_Field.row.DTE_Field_Name_TIT_PER_AVALIACAO', frm_context).css('display', 'none');
                    $('div.DTE_Field.row.DTE_Field_Name_DT_INI_AVALIACAO', frm_context).css('display', 'none');
                    $('div.DTE_Field.row.DTE_Field_Name_DT_FIM_AVALIACAO', frm_context).css('display', 'none');
                    $('div.DTE_Field.row.DTE_Field_Name_AVAL_COMPETENCIAS', frm_context).css('display', 'none');
                    $('div.DTE_Field.row.DTE_Field_Name_AC_GRP_FUNCIONAL', frm_context).css('display', 'none');
                    $('div.DTE_Field.row.DTE_Field_Name_AC_ESTRUTURA', frm_context).css('display', 'none');
                    $('div.DTE_Field.row.DTE_Field_Name_AC_FUNCAO', frm_context).css('display', 'none');
                    $('div.DTE_Field.row.DTE_Field_Name_AC_COLABORADOR', frm_context).css('display', 'none');
                    $('div.DTE_Field.row.DTE_Field_Name_AVAL_OBJECTIVOS', frm_context).css('display', 'none');
                    $('div.DTE_Field.row.DTE_Field_Name_AO_GRP_FUNCIONAL', frm_context).css('display', 'none');
                    $('div.DTE_Field.row.DTE_Field_Name_AO_ESTRUTURA', frm_context).css('display', 'none');
                    $('div.DTE_Field.row.DTE_Field_Name_AO_FUNCAO', frm_context).css('display', 'none');
                    $('div.DTE_Field.row.DTE_Field_Name_AO_COLABORADOR', frm_context).css('display', 'none');
                    $('div.DTE_Field.row.DTE_Field_Name_AVAL_OBJ_PARTILHADOS', frm_context).css('display', 'none');
                    $('div.DTE_Field.row.DTE_Field_Name_TIT_AVAL_FINAL', frm_context).css('display', 'none');
                    $('div.DTE_Field.row.DTE_Field_Name_TOT_COMPETENCIA', frm_context).css('display', 'none');
                    $('div.DTE_Field.row.DTE_Field_Name_TOT_OBJECTIVO', frm_context).css('display', 'none');
                    $('div.DTE_Field.row.DTE_Field_Name_NOTA_AVAL_FASE', frm_context).css('display', 'none');
                    $('div.DTE_Field.row.DTE_Field_Name_PESO', frm_context).css('display', 'none');
                    $('div.DTE_Field.row.DTE_Field_Name_NOTA_FINAL', frm_context).css('display', 'none');
                    $('div.DTE_Field.row.DTE_Field_Name_COMITE', frm_context).css('display', 'none');
                } else if (operacao === 'query') {
                    $('div.DTE_Field.row.DTE_Field_Name_ESTADO', frm_context).css('display', 'block');
                    $('div.DTE_Field.row.DTE_Field_Name_DSP_PROCESSO', frm_context).css('display', 'block');
                    $('div.DTE_Field.row.DTE_Field_Name_NOME_REDZ', frm_context).css('display', 'block');
                    $('div.DTE_Field.row.DTE_Field_Name_DSP_FASE', frm_context).css('display', 'block');
                    $('div.DTE_Field.row.DTE_Field_Name_NOME_AVALIADOR', frm_context).css('display', 'block');
                    $('div.DTE_Field.row.DTE_Field_Name_DT_INI_PROCESSO', frm_context).css('display', 'block');
                    $('div.DTE_Field.row.DTE_Field_Name_DT_FIM_PROCESSO', frm_context).css('display', 'block');
                    $('div.DTE_Field.row.DTE_Field_Name_TIT_PER_AVALIACAO', frm_context).css('display', 'block');
                    $('div.DTE_Field.row.DTE_Field_Name_DT_INI_AVALIACAO', frm_context).css('display', 'block');
                    $('div.DTE_Field.row.DTE_Field_Name_DT_FIM_AVALIACAO', frm_context).css('display', 'block');
                    $('div.DTE_Field.row.DTE_Field_Name_AVAL_COMPETENCIAS', frm_context).css('display', 'block');
                    $('div.DTE_Field.row.DTE_Field_Name_AC_GRP_FUNCIONAL', frm_context).css('display', 'block');
                    $('div.DTE_Field.row.DTE_Field_Name_AC_ESTRUTURA', frm_context).css('display', 'block');
                    $('div.DTE_Field.row.DTE_Field_Name_AC_FUNCAO', frm_context).css('display', 'block');
                    $('div.DTE_Field.row.DTE_Field_Name_AC_COLABORADOR', frm_context).css('display', 'block');
                    $('div.DTE_Field.row.DTE_Field_Name_AVAL_OBJECTIVOS', frm_context).css('display', 'block');
                    $('div.DTE_Field.row.DTE_Field_Name_AO_GRP_FUNCIONAL', frm_context).css('display', 'block');
                    $('div.DTE_Field.row.DTE_Field_Name_AO_ESTRUTURA', frm_context).css('display', 'block');
                    $('div.DTE_Field.row.DTE_Field_Name_AO_FUNCAO', frm_context).css('display', 'block');
                    $('div.DTE_Field.row.DTE_Field_Name_AO_COLABORADOR', frm_context).css('display', 'block');
                    $('div.DTE_Field.row.DTE_Field_Name_AVAL_OBJ_PARTILHADOS', frm_context).css('display', 'block');
                    $('div.DTE_Field.row.DTE_Field_Name_TIT_AVAL_FINAL', frm_context).css('display', 'block');
                    $('div.DTE_Field.row.DTE_Field_Name_TOT_COMPETENCIA', frm_context).css('display', 'block');
                    $('div.DTE_Field.row.DTE_Field_Name_TOT_OBJECTIVO', frm_context).css('display', 'block');
                    $('div.DTE_Field.row.DTE_Field_Name_NOTA_AVAL_FASE', frm_context).css('display', 'block');
                    $('div.DTE_Field.row.DTE_Field_Name_PESO', frm_context).css('display', 'block');
                    $('div.DTE_Field.row.DTE_Field_Name_NOTA_FINAL', frm_context).css('display', 'block');
                    $('div.DTE_Field.row.DTE_Field_Name_COMITE', frm_context).css('display', 'block');
                }
        });

        //END Master Assesment View :: TAB #3

        //SUB-TAB #3.1.1 :: Assessment Skills & Behaviors
        var optionRH_FICHA_AVAL_COMPORTAMENTOS = {
            "tableId": "RH_FICHA_AVAL_COMPORTAMENTOS",
            "table": "RH_FICHA_AVAL_COMPORTAMENTOS", 
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_skill; ?>",
            "pk": {
                "primary": {
                    "SEQ_": {"type": "number"}                        
                }
            },
            "dependsOn": {
                "MASTER_AVALIACAO": { //External object key mapping( object key : external key)                    
                    "EMPRESA": "EMPRESA",
                    "ID_PA": "ID_PA",
                    "DT_INI_PA": "DT_INI_PA",
                    "ID_PROCESSO_AV": "ID_PROCESSO_AV",
                    "DT_INI_PROCESSO": "DT_INI_PROCESSO",                        
                    "RHID_AVALIADO": "RHID",
                    "DT_ADMISSAO": "DT_ADMISSAO",
                    "RHID_AVALIADOR": "RHID_AVALIADOR",
                    "ID_FASE": "ID_FASE",
                    "DT_INI_FASE": "DT_INI_FASE",
                    "DT_INI_FPA": "DT_INI_FPA",
                    "DT_INI_AF": "DT_INI_AF"
                }
            },
            "order_by": "ID_COMPETENCIA",
            "recordBundle": 7,
            "pageLenght": 7,
            "scrollY": "195", 
            "responsive": true,
            "pageResize": true, // PLUGIN :: dataTables.pageResize.min.js
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "className": "control toBottom toCenter",
                    "width": "1%",
                    "defaultContent": ''
                }, {
                    "title": "", //Datatables                    
                    "label": "", //Editor :: Not available on Sequence label
                    "data": 'SEQ_',
                    "name": 'SEQ_',
                    "datatype": 'sequence',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": false,
                    "className": "visibleColumn", 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'EMPRESA',
                    "name": 'EMPRESA',
                    "type": "hidden",
                    "visible": false,
                    "className": "",  
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_PA',
                    "name": 'ID_PA',
                    "type": "hidden",
                    "visible": false,
                    "className": "",  
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_PA',
                    "name": 'DT_INI_PA',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                        
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_PROCESSO_AV',
                    "name": 'ID_PROCESSO_AV',
                    "type": "hidden",
                    "visible": false,
                    "className": "",  
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_PROCESSO',
                    "name": 'DT_INI_PROCESSO',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'RHID_AVALIADO',
                    "name": 'RHID_AVALIADO',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_ADMISSAO',
                    "name": 'DT_ADMISSAO',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'RHID_AVALIADOR',
                    "name": 'RHID_AVALIADOR',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables  
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_FASE',
                    "name": 'ID_FASE',
                    "type": "hidden",
                    "visible": false,
                    "className": "",  
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_FASE',
                    "name": 'DT_INI_FASE',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_FPA',
                    "name": 'DT_INI_FPA',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_AF',
                    "name": 'DT_INI_AF',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_COMPETENCIA',
                    "name": 'ID_COMPETENCIA',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_COMPETENCIA',
                    "name": 'DT_INI_COMPETENCIA',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                }, {
                    "responsivePriority": 2,
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_skill, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_skill; ?>",
                    "data": 'DSP_COMPETENCIA',
                    "name": 'DSP_COMPETENCIA',
                    "type": "select",                        
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "SKILLS",
                        "dependent-level": 1,
                        "data-db-name": "A.EMPRESA@A.ID_COMPETENCIA@A.DT_INI_COMPETENCIA",
                        "decodeFromTable": "RH_DEF_COMPETENCIAS A",  //TO CHANGE ON QUAD-HCM
                        "desigColumn": "A.DSP_COMPETENCIA", 
                        "otherValues": "A.DESCRICAO", //RETURNS data['OTHERVALUES']
                        "orderBy": "A.ID_COMPETENCIA",
                        "class": "form-control complexList chosen",
                        "disabled": true
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_COMPORTAMENTO',
                    "name": 'ID_COMPORTAMENTO',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_COMPORTAMENTO',
                    "name": 'DT_INI_COMPORTAMENTO',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                      
                }, {
                    "responsivePriority": 3,
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_behavior, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_behavior; ?>",
                    "data": 'DSP_COMPORTAMENTO',
                    "name": 'DSP_COMPORTAMENTO',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "SKILLS",
                        "dependent-level": 2,
                        "data-db-name": "A.EMPRESA@A.ID_COMPETENCIA@A.DT_INI_COMPETENCIA@A.ID_COMPORTAMENTO@A.DT_INI_COMPORTAMENTO",                        
                        "otherValues": "A.DESCRICAO", //RETURNS data['OTHERVALUES']
                        "decodeFromTable": "RH_DEF_COMPORTAMENTOS A",  //TO CHANGE ON QUAD-HCM
                        "desigColumn": "A.DSP_COMPORTAMENTO", 
                        "orderBy": "A.ID_COMPORTAMENTO",
                        "class": "form-control complexList chosen",
                        "disabled": true
                    }     
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_EP_NV_AF',
                    "name": 'ID_EP_NV_AF',
                    "type": "hidden",
                    "visible": false,
                    "className": "visibleColumn",
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_EP_NV_AF',
                    "name": 'DT_INI_EP_NV_AF',
                    "datatype": 'date',     
                    "type": "hidden",
                    "visible": false,
                    "className": "",                        
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_NV_AF',
                    "name": 'ID_NV_AF',
                    "type": "hidden",
                    "visible": false,
                    "className": "visibleColumn",
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_NV_AF',
                    "name": 'DT_INI_NV_AF',
                    "datatype": 'date',     
                    "type": "hidden",
                    "visible": false,
                    "className": "",
                }, {
                    "responsivePriority": 3,                    
                    "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                    "title": "<?php echo mb_strtoupper($ui_assessment_final, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_assessment_final; ?>",
                    "fieldInfo": "<?php echo $hint_final_assesssement_given; ?>",
                    "data": 'DSR_NEP_AF',
                    "name": 'DSR_NEP_AF',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "dependent-group": "ESCALA_AF",
                        "dependent-level": 1,
                        "data-db-name": 'A.EMPRESA@A.ID_EP@A.DT_INI_EP@A.ID_NV_ESCALA@A.DT_INI_NV_ESCALA',
                        "distribute-value": "EMPRESA@ID_EP_NV_AF@DT_INI_EP_NV_AF@ID_NV_AF@DT_INI_NV_AF",
                        "decodeFromTable": 'RH_NIVEIS_ESCALA_PROFICIENCIA A',
                        "desigColumn": "A.DSR_NEP", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.                        
                        "orderBy": "NVL(A.NR_ORD, A.ID_NV_ESCALA)", //usado no complexList.php
                        "class": "form-control complexList chosen",
                        "disabled": true
                    } 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_EP_REQ',
                    "name": 'ID_EP_REQ',
                    "type": "hidden",
                    "visible": false,
                    "className": "visibleColumn",
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_EP_REQ',
                    "name": 'DT_INI_EP_REQ',
                    "datatype": 'date',     
                    "type": "hidden",
                    "visible": false,
                    "className": "",
                }, {
                    "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                    "title": "<?php echo mb_strtoupper($ui_proficiency_scale, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_proficiency_scale; ?>",
                    "data": 'DSP_EP',
                    "name": 'DSP_EP',
                    "type": "select",
                    "className": "none visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "ESCALA_REQ",
                        "dependent-level": 1,
                        "data-db-name": 'A.EMPRESA@A.ID_EP@A.DT_INI_EP',
                        "distribute-value": "EMPRESA@ID_EP_REQ@DT_INI_EP_REQ",
                        "decodeFromTable": 'RH_DEF_ESCALAS_PROFICIENCIA A',
                        "desigColumn": "A.DSP_EP",                
                        "orderBy": "A.ID_EP", 
                        "class": "form-control complexList chosen",
                        "disabled": true, 
                    }                       
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_NV_ESCALA_REQ',
                    "name": 'ID_NV_ESCALA_REQ',
                    "type": "hidden",
                    "visible": false,
                    "className": "visibleColumn",
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_NV_REQ',
                    "name": 'DT_INI_NV_REQ',
                    "datatype": 'date',     
                    "type": "hidden",
                    "visible": false,
                    "className": "",
                }, {
                    "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                    "title": "<?php echo mb_strtoupper($ui_level_required, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_level_required; ?>",
                    "data": 'DSR_NEP',
                    "name": 'DSR_NEP',
                    "type": "select",
                    "className": "none visibleColumn",
                    "attr": {
                        "dependent-group": "ESCALA_REQ",
                        "dependent-level": 2,
                        "data-db-name": 'A.EMPRESA@A.ID_EP@A.DT_INI_EP@A.ID_NV_ESCALA@A.DT_INI_NV_ESCALA',
                        "distribute-value": "EMPRESA@ID_EP_REQ@DT_INI_EP_REQ@ID_NV_ESCALA_REQ@DT_INI_NV_REQ",
                        "decodeFromTable": 'RH_NIVEIS_ESCALA_PROFICIENCIA A',
                        "desigColumn": "A.DSR_NEP", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.                        
                        "orderBy": "NVL(A.NR_ORD, A.ID_NV_ESCALA)", //usado no complexList.php
                        "class": "form-control complexList chosen",
                        "disabled": true, //Permite inibir o campo no Editor
                    }        
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_note_obtained, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_note_obtained; ?>", //Editor
                    "data": 'NOTA_AF',
                    "name": 'NOTA_AF',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 30%;",
                        "disabled": true
                    }    
                }, {
                    "responsivePriority": 5, 
                    "title": "<?php echo mb_strtoupper($ui_weight, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_weight; ?>", //Editor
                    "data": 'PESO_AF',
                    "name": 'PESO_AF',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 30%;",
                        "disabled": true
                    }    
                }, {
                    "responsivePriority": 6, 
                    "title": "<?php echo mb_strtoupper($ui_weighting, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_weighting; ?>", //Editor
                    "data": 'PERC_AF',
                    "name": 'PERC_AF',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 30%;",
                        "disabled": true
                    }    
                }, {
                    "title": "<?php echo mb_strtoupper($ui_comment, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_comment; ?>", //Editor
                    "data": 'COMENTARIO',
                    "name": 'COMENTARIO',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 355px",
                        "class": "form-control len-355",
                        "disabled": true
                    }                         
                }, {
                    "title": "<?php echo mb_strtoupper($ui_description, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DESCRICAO',
                    "name": 'DESCRICAO',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 355px",
                        "class": "form-control len-355",
                        "disabled": true
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
                        return RH_FICHA_AVAL_COMPORTAMENTOS.crudButtons(false,true,false);
                    }
                }
            ]
        };
        RH_FICHA_AVAL_COMPORTAMENTOS = new QuadTable();
        RH_FICHA_AVAL_COMPORTAMENTOS.initTable( $.extend({}, datatable_instance_defaults, optionRH_FICHA_AVAL_COMPORTAMENTOS) );

        $(document).on('RH_FICHA_AVAL_COMPORTAMENTOSAttachEvt', function (e) {

            var frm_context = "#RH_FICHA_AVAL_COMPORTAMENTOS_editorForm", 
                frm_field = ["#DTE_Field_DSP_COMPETENCIA", "#DTE_Field_DSP_COMPORTAMENTO"],
                operacao = RH_FICHA_AVAL_COMPORTAMENTOS.editor.s["action"]; //PREVIOUS VERSION -> RH_PROCESSOS_AVALIACAO.editor.s.editOpts["action"];

            //SHOW OTHERVALUES (Skill description) as INFO/HELP on EDITOR
            setTimeout( function() {                    
                var dsp_skill = $(frm_field[0], frm_context).find('option[value="' + $(frm_field[0], frm_context).val() + '"]').data('othervalues'),
                    dsp_behavior = $(frm_field[1], frm_context).find('option[value="' + $(frm_field[1], frm_context).val() + '"]').data('othervalues');
                if (dsp_skill) {
                    $(frm_field[0]).parent().siblings("[data-dte-e=msg-info]").css({"width": "135%", "color": "#74a02b"}).html(dsp_skill);
                }
                if (dsp_behavior) {
                    $(frm_field[1]).parent().siblings("[data-dte-e=msg-info]").css({"width": "135%", "color": "#74a02b"}).html(dsp_behavior);
                }
                //DSP_NEP :: Nota atribuída
                $('#RH_FICHA_AVAL_COMPORTAMENTOS_editorForm > div > div.DTE_Field.row.DTE_Field_Type_select.DTE_Field_Name_DSR_NEP.visibleColumn > div > div:nth-child(6)').css({"width": "135%"});
            }, 500);

        });            
        //END SUB-TAB #3.1.1 :: Assessment Skills & Behaviors

        //SUB-TAB #3.1.2 :: Objectives Assessment
        var optionRH_ID_AVALIACAO_OBJECTIVOS = {
            "tableId": "RH_ID_AVALIACAO_OBJECTIVOS",
            "table": "RH_ID_AVALIACAO_OBJECTIVOS", 
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_objective; ?>",
            "pk": {
                "primary": {
                    "SEQ_": {"type": "number"}                        
                }
            },
            "dependsOn": {
                "MASTER_AVALIACAO": { //External object key mapping( object key : external key)                    
                    "EMPRESA": "EMPRESA",
                    "ID_PA": "ID_PA",
                    "DT_INI_PA": "DT_INI_PA",
                    "ID_PROCESSO_AV": "ID_PROCESSO_AV",
                    "DT_INI_PROCESSO": "DT_INI_PROCESSO",                        
                    "RHID_AVALIADO": "RHID",
                    "DT_ADMISSAO": "DT_ADMISSAO",
                    "RHID_AVALIADOR": "RHID_AVALIADOR",
                    "ID_FASE": "ID_FASE",
                    "DT_INI_FASE": "DT_INI_FASE",
                    "DT_INI_FPA": "DT_INI_FPA",
                    "DT_INI_AF": "DT_INI_AF"
                }
            },
            "order_by": "ID_OBJECTIVO",
            "recordBundle": 7,
            "pageLenght": 7,
            "scrollY": "195", 
            "responsive": true,
            "pageResize": true, // PLUGIN :: dataTables.pageResize.min.js
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "className": "control toBottom toCenter",
                    "width": "1%",
                    "defaultContent": ''
                }, {
                    "title": "Seq.", //Datatables                    
                    "label": "Seq.", //Editor :: Not available on Sequence label
                    "data": 'SEQ_',
                    "name": 'SEQ_',
                    "datatype": 'sequence',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": false,
                    "className": "visibleColumn", 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'EMPRESA',
                    "name": 'EMPRESA',
                    "type": "hidden",
                    "visible": false,
                    "className": "",  
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_PA',
                    "name": 'ID_PA',
                    "type": "hidden",
                    "visible": false,
                    "className": "",  
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_PA',
                    "name": 'DT_INI_PA',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                        
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_PROCESSO_AV',
                    "name": 'ID_PROCESSO_AV',
                    "type": "hidden",
                    "visible": false,
                    "className": "",  
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_PROCESSO',
                    "name": 'DT_INI_PROCESSO',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'RHID_AVALIADO',
                    "name": 'RHID_AVALIADO',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_ADMISSAO',
                    "name": 'DT_ADMISSAO',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'RHID_AVALIADOR',
                    "name": 'RHID_AVALIADOR',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables  
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_FASE',
                    "name": 'ID_FASE',
                    "type": "hidden",
                    "visible": false,
                    "className": "",  
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_FASE',
                    "name": 'DT_INI_FASE',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_FPA',
                    "name": 'DT_INI_FPA',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_AF',
                    "name": 'DT_INI_AF',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_OBJECTIVO',
                    "name": 'ID_OBJECTIVO',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_OBJECTIVO',
                    "name": 'DT_INI_OBJECTIVO',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_OI', //Objetivo Individual
                    "name": 'DT_INI_OI', //Objetivo Individual
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables 
                }, {
                    "responsivePriority": 2,
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_objective, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_objective; ?>",
                    "data": 'DSP_OBJECTIVO',
                    "name": 'DSP_OBJECTIVO',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "SKILLS",
                        "dependent-level": 1,
                        "data-db-name": "A.EMPRESA@A.ID_OBJECTIVO@A.DT_INI_OBJECTIVO",
                        "otherValues": "A.TIPO_AVALIACAO", //A-Quantitativo; B-Qualitativo                            
                        "decodeFromTable": "RH_DEF_OBJECTIVOS A",  //TO CHANGE ON QUAD-HCM
                        "desigColumn": "A.DSP_OBJECTIVO", 
                        "orderBy": "A.ID_OBJECTIVO",
                        "class": "form-control complexList chosen"
                    }   
                }, {
                    "responsivePriority": 3,  
                    "title": "<?php echo mb_strtoupper($ui_quantitative_assessment, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_quantitative_assessment; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_final_objective_reached; ?>",
                    "data": 'VLR_ATRIBUIDO',
                    "name": 'VLR_ATRIBUIDO',
                    "className": "visibleColumn right",
                    "visible": false,
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 50%;",
                        "disabled": true
                    },
                    "render": function (val, type, row) {
                        if (typeof (val) === "object" && val === null) {
                            return val;
                        } else {

                            return val + ' '+row['DSR_MAGNITUDE'];
                        }
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_MAGNITUDE',
                    "name": 'ID_MAGNITUDE',
                    "type": "hidden",
                    "visible": false,
                    "className": "",
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_DM',
                    "name": 'DT_INI_DM',
                    "datatype": 'date',     
                    "type": "hidden",
                    "visible": false,
                    "datatype": 'date'                      
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_magnitude, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_magnitude; ?>",
                    "complexList": true,
                    "data": 'DSR_MAGNITUDE',
                    "name": 'DSR_MAGNITUDE',
                    "type": "select",
                    "className": "visibleColumn",
                    "visible": false,
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "UNIDADES",
                        "dependent-level": 1,
                        "data-db-name": 'A.ID_MAGNITUDE@A.DT_INI_DM',
                        "decodeFromTable": 'RH_DEF_MAGNITUDES A',
                        "desigColumn": "A.DSR_MAGNITUDE",//"CONCAT(CONCAT(ID_MAGNITUDE,'-'),DSR_MAGNITUDE)", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.                        
                        "orderBy": "A.ID_MAGNITUDE", //usado no complexList.php
                        "class": "form-control complexList chosen",
                        "disabled": true, //Permite inibir o campo no Editor
                    }                         
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_EP_AF',
                    "name": 'ID_EP_AF',
                    "type": "hidden",
                    "visible": false,
                    "className": "",
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_EP_AF',
                    "name": 'DT_INI_EP_AF',
                    "datatype": 'date',     
                    "type": "hidden",
                    "visible": false,
                    "datatype": 'date'                        
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_NV_ESCALA_AF',
                    "name": 'ID_NV_ESCALA_AF',
                    "type": "hidden",
                    "visible": false,
                    "className": "",
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_NV_ESCALA_AF',
                    "name": 'DT_INI_NV_ESCALA_AF',
                    "datatype": 'date',     
                    "type": "hidden",
                    "visible": false,
                    "className": "",
                }, {
                    "responsivePriority": 3,                    
                    "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                    "title": "<?php echo mb_strtoupper($ui_qualitative_assessment, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_qualitative_assessment; ?>",
                    "fieldInfo": "<?php echo $hint_final_assesssement_given; ?>",
                    "data": 'DSR_NEP_AF',
                    "name": 'DSR_NEP_AF',
                    "type": "select",
                    "className": "visibleColumn",
                    "visible": false,
                    "attr": {
                        "dependent-group": "ESCALA_AF",
                        "dependent-level": 1,
                        "data-db-name": 'A.EMPRESA@A.ID_EP@A.DT_INI_EP@A.ID_NV_ESCALA@A.DT_INI_NV_ESCALA',
                        "distribute-value": "EMPRESA@ID_EP_AF@DT_INI_EP_AF@ID_NV_ESCALA_AF@DT_INI_NV_ESCALA_AF",
                        "decodeFromTable": 'RH_NIVEIS_ESCALA_PROFICIENCIA A',
                        "desigColumn": "A.DSR_NEP", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.                        
                        "orderBy": "NVL(A.NR_ORD, A.ID_NV_ESCALA)", //usado no complexList.php
                        "class": "form-control complexList chosen",
                        "disabled": true
                    } 
                }, {
                    /* DUMMY :: RENDER COLUMN :: MULTIPURPOSE COLUMN :: FINAL GRADE */
                    "responsivePriority": 2,  
                    "title": "<?php echo mb_strtoupper($ui_assessment_final, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_assessment_final; ?>",
                    "data": '',
                    "name": 'DSP_RENDER',
                    "type": "readonly",
                    "className": "",
                    "defaultContent": "", //Must be used on STATIC columns content. On this case classes make there way...   
                    "render": function (val, type, row) {

                        if (typeof (row['VLR_ATRIBUIDO']) !== null && typeof (row['VLR_ATRIBUIDO']) !== 'object') {
                            return row['VLR_ATRIBUIDO'] + ' '+ row['DSR_MAGNITUDE'];
                        } else if (typeof (row['ID_NV_ESCALA_AF']) !== null && typeof (row['ID_NV_ESCALA_AF']) !== 'object') {
                            return row['DSR_NEP_AF'];
                        } else {
                            return '';
                        }
                    }                          
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_EP_REQ',
                    "name": 'ID_EP_REQ',
                    "type": "hidden",
                    "visible": false,
                    "className": "",
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_EP_REQ',
                    "name": 'DT_INI_EP_REQ',
                    "datatype": 'date',     
                    "type": "hidden",
                    "visible": false,
                    "className": "",
                }, {
                    "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                    "title": "<?php echo mb_strtoupper($ui_proficiency_scale, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_proficiency_scale; ?>",
                    "data": 'DSP_EP',
                    "name": 'DSP_EP',
                    "type": "select",
                    "className": "none visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "ESCALA_REQ",
                        "dependent-level": 1,
                        "data-db-name": 'A.EMPRESA@A.ID_EP@A.DT_INI_EP',
                        "distribute-value": "EMPRESA@ID_EP_REQ@DT_INI_EP_REQ",
                        "decodeFromTable": 'RH_DEF_ESCALAS_PROFICIENCIA A',
                        "desigColumn": "A.DSP_EP",                
                        "orderBy": "A.ID_EP", 
                        "class": "form-control complexList chosen",
                        "disabled": true, 
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_NV_ESCALA_REQ',
                    "name": 'ID_NV_ESCALA_REQ',
                    "type": "hidden",
                    "visible": false,
                    "className": "visibleColumn",
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_NV_ESCALA_REQ',
                    "name": 'DT_INI_NV_ESCALA_REQ',
                    "datatype": 'date',     
                    "type": "hidden",
                    "visible": false,
                    "className": "",
                }, {
                    "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                    "title": "<?php echo mb_strtoupper($ui_level_required, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_level_required; ?>",
                    "data": 'DSR_NEP',
                    "name": 'DSR_NEP',
                    "type": "select",
                    "className": "none visibleColumn",
                    "attr": {
                        "dependent-group": "ESCALA_REQ",
                        "dependent-level": 2,
                        "data-db-name": 'A.EMPRESA@A.ID_EP@A.DT_INI_EP@A.ID_NV_ESCALA@A.DT_INI_NV_ESCALA',
                        "distribute-value": "EMPRESA@ID_EP_REQ@DT_INI_EP_REQ@ID_NV_ESCALA_REQ@DT_INI_NV_ESCALA_REQ",
                        "decodeFromTable": 'RH_NIVEIS_ESCALA_PROFICIENCIA A',
                        "desigColumn": "A.DSR_NEP", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.                        
                        "orderBy": "NVL(A.NR_ORD, A.ID_NV_ESCALA)", //usado no complexList.php
                        "class": "form-control complexList chosen",
                        "disabled": true, //Permite inibir o campo no Editor
                    }

                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_note_obtained, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_note_obtained; ?>", //Editor
                    "data": 'NOTA_AF',
                    "name": 'NOTA_AF',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 30%;",
                        "disabled": true
                    }    
                }, {
                    "responsivePriority": 5, 
                    "title": "<?php echo mb_strtoupper($ui_weight, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_weight; ?>", //Editor
                    "data": 'PESO_AF',
                    "name": 'PESO_AF',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 30%;",
                        "disabled": true
                    }    
                }, {
                    "responsivePriority": 6, 
                    "title": "<?php echo mb_strtoupper($ui_weighting, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_weighting; ?>", //Editor
                    "data": 'PERC_AF',
                    "name": 'PERC_AF',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 30%;",
                        "disabled": true
                    }    
                }, {
                    "title": "<?php echo mb_strtoupper($ui_comment, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_comment; ?>", //Editor
                    "data": 'COMENT_AVALIADO',
                    "name": 'COMENT_AVALIADO',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 355px",
                        "class": "form-control len-355",
                        "disabled": true
                    }                         
                }, {
                    "title": "<?php echo mb_strtoupper($ui_description, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DESCRICAO',
                    "name": 'DESCRICAO',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 355px",
                        "class": "form-control len-355",
                        "disabled": true
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
                        return RH_ID_AVALIACAO_OBJECTIVOS.crudButtons(false,true,false);
                    }
                }
            ]
        };
        RH_ID_AVALIACAO_OBJECTIVOS = new QuadTable();
        RH_ID_AVALIACAO_OBJECTIVOS.initTable( $.extend({}, datatable_instance_defaults, optionRH_ID_AVALIACAO_OBJECTIVOS) );
        //END SUB-TAB #3.1.2 :: Objectives Assessment

        //SUB-TAB #3.2.1 :: Skills Resume
        var optionRH_RESUME_COMPETENCIAS_FA = {
            "tableId": "RH_RESUME_COMPETENCIAS_FA",
            "table": "RH_RESUME_COMPETENCIAS_FA", 
            "pk": {
                "primary": {
                    "SEQ_": {"type": "number"}                        
                }
            },
            "dependsOn": {
                "MASTER_AVALIACAO": { //External object key mapping( object key : external key)                    
                    "EMPRESA": "EMPRESA",
                    "ID_PA": "ID_PA",
                    "DT_INI_PA": "DT_INI_PA",
                    "ID_PROCESSO_AV": "ID_PROCESSO_AV",
                    "DT_INI_PROCESSO": "DT_INI_PROCESSO",                        
                    "RHID_AVALIADO": "RHID",
                    "DT_ADMISSAO": "DT_ADMISSAO",
                    "RHID_AVALIADOR": "RHID_AVALIADOR",
                    "ID_FASE": "ID_FASE",
                    "DT_INI_FASE": "DT_INI_FASE",
                    "DT_INI_FPA": "DT_INI_FPA",
                    "DT_INI_AF": "DT_INI_AF"
                }
            },
            "order_by": "ID_COMPETENCIA",
            "recordBundle": 7,
            "pageLenght": 7,
            "scrollY": "195", 
            "responsive": true,
            "pageResize": true, // PLUGIN :: dataTables.pageResize.min.js
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
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_PA',
                    "name": 'ID_PA',
                    "type": "hidden",
                    "visible": false,
                    "className": "",  
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_PA',
                    "name": 'DT_INI_PA',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                        
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_PROCESSO_AV',
                    "name": 'ID_PROCESSO_AV',
                    "type": "hidden",
                    "visible": false,
                    "className": "",  
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_PROCESSO',
                    "name": 'DT_INI_PROCESSO',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'RHID_AVALIADO',
                    "name": 'RHID_AVALIADO',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_ADMISSAO',
                    "name": 'DT_ADMISSAO',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'RHID_AVALIADOR',
                    "name": 'RHID_AVALIADOR',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables  
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_FASE',
                    "name": 'ID_FASE',
                    "type": "hidden",
                    "visible": false,
                    "className": "",  
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_FASE',
                    "name": 'DT_INI_FASE',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_FPA',
                    "name": 'DT_INI_FPA',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_AF',
                    "name": 'DT_INI_AF',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_COMPETENCIA',
                    "name": 'ID_COMPETENCIA',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_COMPETENCIA',
                    "name": 'DT_INI_COMPETENCIA',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                }, {
                    "responsivePriority": 2,
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_skill, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_skill; ?>",
                    "data": 'DSP_COMPETENCIA',
                    "name": 'DSP_COMPETENCIA',
                    "type": "select",                        
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "SKILLS",
                        "dependent-level": 1,
                        "data-db-name": "A.EMPRESA@A.ID_COMPETENCIA@A.DT_INI_COMPETENCIA",
                        "decodeFromTable": "RH_DEF_COMPETENCIAS A",  //TO CHANGE ON QUAD-HCM
                        "desigColumn": "A.DSP_COMPETENCIA", 
                        "otherValues": "A.DESCRICAO", //RETURNS data['OTHERVALUES']
                        "orderBy": "A.ID_COMPETENCIA",
                        "class": "form-control complexList chosen",
                        "disabled": true
                    }
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_weight, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_weight; ?>", //Editor
                    "data": 'PESO_COMPETENCIA',
                    "name": 'PESO_COMPETENCIA',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 30%;",
                        "disabled": true
                    } 
                }, {
                    "responsivePriority": 5, 
                    "title": "<?php echo mb_strtoupper($ui_accomplished, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_accomplished; ?>", //Editor
                    "data": 'VLR_COMPETENCIA',
                    "name": 'VLR_COMPETENCIA',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 30%;",
                        "disabled": true
                    } 
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_scoring, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_scoring; ?>", //Editor
                    "data": 'PERC_COMPETENCIA',
                    "name": 'PERC_COMPETENCIA',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 30%;",
                        "disabled": true
                    }                               
                }, {
                    "title": "<?php echo mb_strtoupper($ui_description, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DESCRICAO',
                    "name": 'DESCRICAO',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 355px",
                        "class": "form-control len-355",
                        "disabled": true
                    }
/*                        
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
*/
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
                        return RH_RESUME_COMPETENCIAS_FA.crudButtons(false,true,false);
                    }
                }
            ]
        };
        RH_RESUME_COMPETENCIAS_FA = new QuadTable();
        RH_RESUME_COMPETENCIAS_FA.initTable( $.extend({}, datatable_instance_defaults, optionRH_RESUME_COMPETENCIAS_FA) );
        //END SUB-TAB #3.2.1 :: Skills Resume

        //SUB-TAB #3.2.2 :: Objectives Resume
        var optionRH_RESUME_OBJECTIVOS_FA = {
            "tableId": "RH_RESUME_OBJECTIVOS_FA",
            "table": "RH_RESUME_OBJECTIVOS_FA", 
            "pk": {
                "primary": {
                    "SEQ_": {"type": "number"}                        
                }
            },
            "dependsOn": {
                "MASTER_AVALIACAO": { //External object key mapping( object key : external key)                    
                    "EMPRESA": "EMPRESA",
                    "ID_PA": "ID_PA",
                    "DT_INI_PA": "DT_INI_PA",
                    "ID_PROCESSO_AV": "ID_PROCESSO_AV",
                    "DT_INI_PROCESSO": "DT_INI_PROCESSO",                        
                    "RHID_AVALIADO": "RHID",
                    "DT_ADMISSAO": "DT_ADMISSAO",
                    "RHID_AVALIADOR": "RHID_AVALIADOR",
                    "ID_FASE": "ID_FASE",
                    "DT_INI_FASE": "DT_INI_FASE",
                    "DT_INI_FPA": "DT_INI_FPA",
                    "DT_INI_AF": "DT_INI_AF"
                }
            },
            "order_by": "ID_OBJECTIVO",
            "recordBundle": 7,
            "pageLenght": 7,
            "scrollY": "195", 
            "responsive": true,
            "pageResize": true, // PLUGIN :: dataTables.pageResize.min.js
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
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_PA',
                    "name": 'ID_PA',
                    "type": "hidden",
                    "visible": false,
                    "className": "",  
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_PA',
                    "name": 'DT_INI_PA',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                        
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_PROCESSO_AV',
                    "name": 'ID_PROCESSO_AV',
                    "type": "hidden",
                    "visible": false,
                    "className": "",  
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_PROCESSO',
                    "name": 'DT_INI_PROCESSO',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'RHID_AVALIADO',
                    "name": 'RHID_AVALIADO',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_ADMISSAO',
                    "name": 'DT_ADMISSAO',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'RHID_AVALIADOR',
                    "name": 'RHID_AVALIADOR',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables  
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_FASE',
                    "name": 'ID_FASE',
                    "type": "hidden",
                    "visible": false,
                    "className": "",  
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_FASE',
                    "name": 'DT_INI_FASE',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_FPA',
                    "name": 'DT_INI_FPA',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_AF',
                    "name": 'DT_INI_AF',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_OBJECTIVO',
                    "name": 'ID_OBJECTIVO',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_OBJECTIVO',
                    "name": 'DT_INI_OBJECTIVO',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                }, {
                    "responsivePriority": 2,
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_objective, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_objective; ?>",
                    "data": 'DSR_OBJECTIVO',
                    "name": 'DSR_OBJECTIVO',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "SKILLS",
                        "dependent-level": 1,
                        "data-db-name": "A.EMPRESA@A.ID_OBJECTIVO@A.DT_INI_OBJECTIVO",
                        "otherValues": "A.TIPO_AVALIACAO", //A-Quantitativo; B-Qualitativo                            
                        "decodeFromTable": "RH_DEF_OBJECTIVOS A",  //TO CHANGE ON QUAD-HCM
                        "desigColumn": "A.DSR_OBJECTIVO", 
                        "orderBy": "A.ID_OBJECTIVO",
                        "class": "form-control complexList chosen"
                    }   
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_weight, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_weight; ?>", //Editor
                    "data": 'PESO_OBJECTIVO',
                    "name": 'PESO_OBJECTIVO',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 30%;",
                        "disabled": true
                    }                        
                }, {
                    "responsivePriority": 4,  
                    "title": "<?php echo mb_strtoupper($ui_accomplished, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_accomplished; ?>", //Editor
                    "data": 'VLR_OBJECTIVO',
                    "name": 'VLR_OBJECTIVO',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 50%;",
                        "disabled": true
                    }
                }, {
                    "responsivePriority": 5, 
                    "title": "<?php echo mb_strtoupper($ui_scoring, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_scoring; ?>", //Editor
                    "data": 'PERC_OBJECTIVO',
                    "name": 'PERC_OBJECTIVO',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 30%;",
                        "disabled": true
                    }    
                }, {
                    "title": "<?php echo mb_strtoupper($ui_description, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DESCRICAO',
                    "name": 'DESCRICAO',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 355px",
                        "class": "form-control len-355",
                        "disabled": true
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
                        return RH_RESUME_OBJECTIVOS_FA.crudButtons(false,true,false);
                    }
                }
            ]
        };
        RH_RESUME_OBJECTIVOS_FA = new QuadTable();
        RH_RESUME_OBJECTIVOS_FA.initTable( $.extend({}, datatable_instance_defaults, optionRH_RESUME_OBJECTIVOS_FA) );
        //END SUB-TAB #3.2.2 :: Objectives Resume
    });
</script>
