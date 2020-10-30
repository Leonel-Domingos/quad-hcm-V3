<?php
    require_once '../init.php';
?>
<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <span class="widget-icon"> <i class="fal fa-clone"></i></span>&nbsp;
                <h2><?php echo $ui_courses; ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">                                            
                    <a id="GF_CURSOS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                    <table id="GF_CURSOS" class="table table-bordered table-hover table-striped w-100"></table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-end">
                <div class="panel-toolbar pr-3 align-self-end tabs__">
                    <ul id="demo_panel-tabs" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                        <li class="nav-item"  style="background-color: #efe1b3;">
                            <a class="nav-link active" data-toggle="tab" href="#Tab1" role="tab" aria-selected="true"><?php echo $ui_details; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab2" role="tab" aria-selected="true"><?php echo $ui_translate; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab3" role="tab" aria-selected="true"><?php echo $ui_contents; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab4" role="tab" aria-selected="true"><?php echo $ui_targets; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab5" role="tab" aria-selected="true"><?php echo $ui_prerequisites; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab6" role="tab" aria-selected="true"><?php echo $ui_precedences; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab7" role="tab" aria-selected="true"><?php echo $ui_characteristics; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab8" role="tab" aria-selected="true"><?php echo $ui_equipments; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab9" role="tab" aria-selected="true"><?php echo $ui_costs; ?></a>
                        </li>
                        <li class="nav-item" style="background-color: #efe1b3;">
                            <a class="nav-link" data-toggle="tab" href="#Tab10" role="tab" aria-selected="true"><?php echo $ui_offers; ?></a>
                        </li>
                        <li class="nav-item" style="background-color: #efe1b3;">
                            <a class="nav-link" data-toggle="tab" href="#Tab11" role="tab" aria-selected="true"><?php echo $ui_waiting_list; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab12" role="tab" aria-selected="true"><?php echo $ui_unique_report; ?></a>
                        </li>
                        <li class="nav-item" style="background-color: #efe1b3;">
                            <a class="nav-link" data-toggle="tab" href="#Tab13" role="tab" aria-selected="true"><?php echo $ui_survey; ?></a>
                        </li>
                        <li class="nav-item" style="background-color: #efe1b3;">
                            <a class="nav-link" data-toggle="tab" href="#Tab14" role="tab" aria-selected="true"><?php echo $ui_images; ?></a>
                        </li>
                    </ul>
                </div>
            </div>   
            
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="tab-content">

                        <!-- TAB #1 -->
                        <div class="tab-pane fade active show" id="Tab1" role="tabpanel">
                            <h6 class="alert alert-warning semi-bold">
                                <i class="far fa-exclamation-triangle"></i> <strong>Falta mapear as Entidades e em consequência a LOV respetiva.</strong>
                            </h6>                                
                            <form action="" id="GF_CURSOS_CONTINUED" class="form-horizontal-standard" novalidate="novalidate">
                                <form-toolbar></form-toolbar>

                                <fieldset class="first-line">
                                    <div class="form-row">
                                        <div class="form-group col-xs-12 col-sm-6 col-md-4">
                                            <label for="DSP_TIPOLOGIA"><?php echo $ui_typology; ?></label>
                                            <select class="form-control chosen complexList" name="DSP_TIPOLOGIA"></select>
                                        </div>                                        

                                        <div class="form-group col-xs-12 col-sm-6 col-md-4">
                                            <label for="DSP_PRD"><?php echo $ui_product; ?></label>
                                            <select class="form-control chosen complexList" name="DSP_PRD"></select>
                                        </div> 

                                        <div class="form-group col-xs-12 col-sm-6 col-md-4">
                                            <label for="DSP_MODALIDADE"><?php echo $ui_modality; ?></label>
                                            <select class="form-control chosen complexList" name="DSP_MODALIDADE"></select>
                                        </div>            

                                        <div class="form-group col-xs-12 col-sm-6 col-md-4">
                                            <label for="DSP_ALVO"><?php echo $ui_target_population; ?></label>
                                            <select class="form-control chosen complexList" name="DSP_ALVO"></select>
                                        </div>   

                                        <div class="form-group col-xs-12 col-sm-6 col-md-4">
                                            <label for="DSP_ORG"><?php echo $ui_organization; ?></label>
                                            <select class="form-control chosen complexList" name="DSP_ORG"></select>
                                        </div>   

                                        <div class="form-group col-xs-12 col-sm-6 col-md-4">
                                            <label for="DSP_AREA_FORM"><?php echo $ui_area; ?></label>
                                            <select class="form-control chosen complexList" name="DSP_AREA_FORM"></select>
                                        </div>                                             

                                        <div class="form-group col-xs-12 col-sm-6 col-md-4 mb-0">
                                            <label for="DSP_CURSO_SOLICITADO"><?php echo $ui_requested_course; ?></label>
                                            <select class="form-control chosen complexList" name="DSP_CURSO_SOLICITADO"></select>
                                            <div data-info="msg-info" class="help-block mt-1 golden-color-bold"><?php echo $hint_requested_course; ?> Rever LOV com PTE.</div>
                                        </div>                                            

                                        <!--                                
                                        <div class="form-group col-xs-6 col-md-4">
                                            <label for="DSP_MEMBRO"><?php echo $ui_trainer; ?></label>
                                            <select class="form-control chosen complexList" name="DSP_MEMBRO"></select>
                                        </div>                                              
                                        -->

                                        <div class="form-group col-xs-12 col-sm-6 col-md-4">
                                            <label for="DSP_DURACAO"><?php echo $ui_duration; ?></label>
                                            <select class="form-control chosen complexList" name="DSP_DURACAO"></select>
                                        </div>  

                                        <div class="form-group col-xs-6 col-sm-6 col-md-2">
                                            <table class="quad-inline">
                                                <thead>
                                                    <tr>
                                                        <th colspan="4"><?php echo $ui_recurrence; ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <input class="form-control toRight" name="ANOS_RECORRENCIA" style="width:40px;">
                                                        </td>
                                                        <td>
                                                            <input class="form-control toRight" name="MESES_RECORRENCIA" style="width:40px;">
                                                        </td>
                                                        <td>
                                                            <input class="form-control toRight" name="DIAS_RECORRENCIA" style="width:40px;">
                                                        </td>
                                                        <td>
                                                            <input class="form-control toRight" name="DIAS_ALERTA_RECORRENCIA" style="width:55px;">
                                                        </td>                                                            
                                                    <tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th><?php echo $ui_years; ?></th>
                                                        <th><?php echo $ui_months; ?></th>
                                                        <th><?php echo $ui_days; ?></th>
                                                        <th><?php echo $ui_alert_days; ?></th>
                                                    </tr>                                                                                                                
                                                </tfoot>
                                            </table>
                                        </div>  


                                        <div class="form-group col-xs-12 col-sm-6 col-md-2" style="text-align: -webkit-right;">
                                            <label for="CARGA_HORARIA"><?php echo $ui_workload; ?></label>
                                            <input class="form-control complexList toRight" name="CARGA_HORARIA" style="width: 49%;">
                                        </div>  
                                        <div class="form-group col-xs-12 col-sm-6 col-md-4">
                                            <label for="DSP_COMPETENCIA"><?php echo $ui_skill; ?></label>
                                            <select class="form-control chosen complexList" name="DSP_COMPETENCIA"></select>
                                        </div>    

                                        <div class="form-group col-xs-12 col-sm-6 col-md-4">
                                            <label for="DSP_MTD_AVAL"><?php echo $ui_evaluation_method; ?></label>
                                            <select class="form-control chosen complexList" name="DSP_MTD_AVAL"></select>
                                        </div>    

                                        <div class="form-group col-xs-12 col-sm-6 col-md-4">
                                            <label for="DSP_EP"><?php echo $ui_scale; ?></label>
                                            <select class="form-control chosen complexList" name="DSP_EP"></select>
                                        </div>    

                                        <div class="form-group col-xs-12 col-sm-6 col-md-4">
                                            <label for="DSP_TP_CERTIF"><?php echo $ui_certificate_type; ?></label>
                                            <select class="form-control chosen complexList" name="DSP_TP_CERTIF"></select>
                                        </div>    

                                        <div class="form-group col-xs-6 col-sm-6 col-md-4 col-md-offset-4">
                                        </div>  


                                        <div class="form-group col-xs-6 col-sm-6 col-md-2">
                                            <label for="SHST"><?php echo $ui_shst_short; ?></label>
                                            <select class="form-control domainLists" name="SHST"></select>

                                        </div>  

                                        <div class="form-group col-xs-6 col-sm-6 col-md-2">
                                            <label for="PORTAL"><?php echo $ui_portal; ?></label>
                                            <select class="form-control domainLists" name="PORTAL"></select>
                                        </div>
                                    </div>
                                </fieldset> 

                                <fieldset> 

                                    <div class="form-group  col-xs-12">
                                        <label><?php echo $ui_designation; ?></label>
                                        <textarea class="form-control" placeholder="Textarea" rows="3" name="DESIGNACAO"></textarea>
                                    </div>

                                    <div class="form-group  col-xs-12">
                                        <label><?php echo $ui_objectives; ?></label>
                                        <textarea class="form-control" placeholder="Textarea" rows="3" name="OBJECTIVOS"></textarea>
                                    </div>
                                </fieldset> 

                            </form>
                            
                        </div>
                        <!-- END TAB #1 -->

                        <!-- TAB #2 -->
                        <div class="tab-pane fade" id="Tab2" role="tabpanel">
                            <a id="GF_CURSO_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="GF_CURSO_TRADS" class="table table-bordered table-hover table-striped w-100"></table>
                        </div>
                        <!-- END TAB #2 -->
                            
                        <!-- TAB #3 -->
                        <div class="tab-pane fade" id="Tab3" role="tabpanel">
                            <a id="GF_CONTEUDOS_PROGRAMATICOS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="GF_CONTEUDOS_PROGRAMATICOS" class="table table-bordered table-hover table-striped w-100 nowrap"  style=""></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-31" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon trads"> <i class="far fa-language"></i></span>&nbsp;
                                            <h2><?php echo $ui_translate; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">                                            
                                                <a id="GF_CONTEUDO_PROGRAM_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="GF_CONTEUDO_PROGRAM_TRADS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END TAB #3 -->
                         
                        <!-- TAB #4 -->
                        <div class="tab-pane fade" id="Tab4" role="tabpanel">
                            <a id="GF_ALVOS_CURSOS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="GF_ALVOS_CURSOS" class="table table-bordered table-hover table-striped w-100"></table>
                        </div>
                        <!-- END TAB #4 -->

                        <!-- TAB #5 -->
                        <div class="tab-pane fade" id="Tab5" role="tabpanel">
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-51" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon trads"> <i class="fal fa-clone"></i></span>&nbsp;
                                            <h2><?php echo $ui_work_experience; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">                                            
                                                <a id="GF_CURSO_EXPERS_PROFS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="GF_CURSO_EXPERS_PROFS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-52" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon trads"> <i class="fal fa-clone"></i></span>&nbsp;
                                            <h2><?php echo $ui_professional_qualifications; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">                                            
                                                <a id="GF_CURSO_HABS_PROFS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="GF_CURSO_HABS_PROFS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-53" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon trads"> <i class="fal fa-clone"></i></span>&nbsp;
                                            <h2><?php echo $ui_academic_qualifications; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">                                            
                                                <a id="GF_CURSO_HABS_LITERARIAS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="GF_CURSO_HABS_LITERARIAS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <!-- END TAB #5 -->
                         
                        <!-- TAB #6 -->
                        <div class="tab-pane fade" id="Tab6" role="tabpanel">
                            <a id="GF_CURSOS_PRECEDENCIAS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="GF_CURSOS_PRECEDENCIAS" class="table table-bordered table-hover table-striped w-100"></table>
                        </div>
                        <!-- END TAB #6 -->                         

                        <!-- TAB #7 -->
                        <div class="tab-pane fade" id="Tab7" role="tabpanel">
                            <a id="GF_CURSO_CARACTERISTICAS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="GF_CURSO_CARACTERISTICAS" class="table table-bordered table-hover table-striped w-100"></table>
                        </div>
                        <!-- END TAB #7 -->     
                         
                        <!-- TAB #8 -->
                        <div class="tab-pane fade" id="Tab8" role="tabpanel">
                            <a id="GF_CURSO_EQUIPAMENTOS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="GF_CURSO_EQUIPAMENTOS" class="table table-bordered table-hover table-striped w-100"></table>
                        </div>
                         <!-- END TAB #8 -->     
                         
                        <!-- TAB #9 -->
                        <div class="tab-pane fade" id="Tab9" role="tabpanel">
                            <a id="GF_CURSO_CUSTOS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="GF_CURSO_CUSTOS" class="table table-bordered table-hover table-striped w-100"></table>
                        </div>
                        <!-- END TAB #9 -->                              

                        <!-- TAB #10 -->
                        <div class="tab-pane fade" id="Tab10" role="tabpanel">
                            <h6 class="alert alert-warning semi-bold">
                                <i class="far fa-exclamation-triangle"></i> <strong>Conteúdo a aguardar, revisão e re-mapeamento destas Entidades no MySql.</strong>
                                <pre style="background-color: #efe1b3; border: 0px solid #ccc;">
                                    <strong>1.</strong> Envolve conversão de conteúdos de <strong>Parametrização > Gestão Administrativa > Organização > Entidades</strong>
                                    <strong>2.</strong> Obrigará a criar Ofertas na dependência dos Produtos de Formação
                                    <strong>3.</strong> Criar vista que em Cursos que permita consultar a Oferta Formativa, tendo como base o Produto definido no curso
                                </pre>
                            </h6>                         
                            <!--<a id="GF_CURSO_CUSTOS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="GF_CURSO_CUSTOS" class="table table-bordered table-hover table-striped w-100"></table>-->
                        </div>
                        <!-- END TAB #10 -->

                        <!-- TAB #11 -->
                        <div class="tab-pane fade" id="Tab11" role="tabpanel">
                            <h6 class="alert alert-warning semi-bold">
                                <i class="far fa-exclamation-triangle"></i> <strong>Conteúdo a aguardar revisão funcional</strong>
                                <pre style="background-color: #efe1b3; border: 0px solid #ccc;">
                                    <strong>1.</strong> Acrescentar botão para efetuar o <strong>Matchup</strong>
                                    <strong>2.</strong> Verificar as condições elegíveis para os CRUD que devem estar disponíveis
                                    <strong>3.</strong> Que fazer com a coluna ESTADO_WKF ?
                                </pre>
                            </h6>                             
                            <a id="GF_LISTAS_ESPERA_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="GF_LISTAS_ESPERA" class="table table-bordered table-hover table-striped w-100"></table>
                        </div>
                        <!-- END TAB #11 -->

                        <!-- TAB #12 -->
                        <div class="tab-pane fade" id="Tab12" role="tabpanel">
                            <a id="GF_CURSOS_RU_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="GF_CURSOS_RU" class="table table-bordered table-hover table-striped w-100"></table>
                        </div>
                        <!-- END TAB #12 -->
                        
                        <!-- TAB #13 -->
                        <div class="tab-pane fade" id="Tab13" role="tabpanel">
                            <h6 class="alert alert-warning semi-bold">
                                <i class="far fa-exclamation-triangle"></i> <strong>Conteúdo a aguardar revisão</strong>
                                <pre style="background-color: #efe1b3; border: 0px solid #ccc;">
                                    <strong>1.</strong> Criar novo módulo de Questionários (<strong>revisitando o AskToAct</strong>)
                                    <strong>2.</strong> Avaliar necessidade de refazer estrutura de suporte (GF_CURSO_QUESTIONARIOS)
                                </pre>
                            </h6>          
                            <!--<a id="GF_CURSO_QUESTIONARIOS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="GF_CURSO_QUESTIONARIOS" class="table table-bordered table-hover table-striped w-100"></table>-->
                        </div>
                        <!-- END TAB #13 -->
                        
                        <!-- TAB #14 -->
                        <div class="tab-pane fade" id="Tab14" role="tabpanel">
                            <h6 class="alert alert-warning semi-bold">
                                <i class="far fa-exclamation-triangle"></i> <strong>Conteúdo a aguardar revisão</strong>
                                <pre style="background-color: #efe1b3; border: 0px solid #ccc;">
                                    <strong>1.</strong> Confirmar recurso a estrutura atual (DG_IMAGENS_OUTPUT) ou transferir para (GF_CURSOS)
                                    <strong>2.</strong> Implementar <strong>File Upload</strong>
                                </pre>
                            </h6>                             
                            <!--a id="DG_IMAGENS_OUTPUT_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="DG_IMAGENS_OUTPUT" class="table table-bordered table-hover table-striped w-100"></table-->
                        </div>
                        <!-- END TAB #14 -->
                        
                    </div>                    
                </div>                    

            </div> 
        </div>
    </div>
</div>

<script>

pageSetUp();

$(document).ready(function () {

    //Courses
    var optionGF_CURSOS = {
        "tableId": "GF_CURSOS",
        "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_course; ?>",
        "table": "GF_CURSOS",
        "pk": {
            "primary": {
                "EMPRESA": {"type": "varchar"},
                "ID_CURSO": {"type": "number"},
                "TP_REGISTO": {"type": "varchar"},
                "DT_INI_CURSO": {"type": "date"}
            }
        },
        "crudOnMasterInactive": {
            "condition": "data.DT_FIM_CURSO !== null",
            "acl": {
                "create": false,
                "update": false,
                "delete": false
            }
        },
        "detailsObjects": [ 'GF_CURSOS_CONTINUED', 'GF_CURSO_TRADS', 'GF_CONTEUDOS_PROGRAMATICOS', 'GF_ALVOS_CURSOS', 'GF_CURSO_EXPERS_PROFS', 'GF_CURSO_HABS_PROFS', 
                            'GF_CURSO_HABS_LITERARIAS', 'GF_CURSOS_PRECEDENCIAS', 'GF_CURSO_CARACTERISTICAS', 'GF_CURSO_EQUIPAMENTOS', 
                            'GF_CURSO_CUSTOS','GF_LISTAS_ESPERA','GF_CURSOS_RU'],
        "order_by": "EMPRESA, ID_CURSO, TP_REGISTO, DT_INI_CURSO desc",
        "scrollY": "234",
        "recordBundle": 7,
        "pageLenght": 7,
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
                "className": ""
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
                "title": "<?php echo mb_strtoupper($ui_type, 'UTF-8'); ?>", //Datatables
                "label": "<?php echo $ui_type; ?>", //Editor
                "data": 'TP_REGISTO',
                "name": 'TP_REGISTO',
                "type": "select",
                "className": "visibleColumn",
                "attr": {
                    "domain-list": true,
                    "dependent-group": 'GF_CURSOS.TP_REGISTO',
                    "class": "form-control",
                    "name": 'TP_REGISTO'
                },
                "render": function (val, type, row) {
                    if (val != null) {
                        var o = _.find(initApp.joinsData['GF_CURSOS.TP_REGISTO'], {'RV_LOW_VALUE': val});
                        return val == null ? null : o['RV_MEANING'];
                    }
                    return val;
                }
            }, {
                "responsivePriority": 3,
                "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                "label": "<?php echo $ui_code; ?>", //Editor
                "data": 'ID_CURSO',
                "name": 'ID_CURSO',
                "className": "visibleColumn"
            }, {
                "responsivePriority": 4,
                "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                "label": "<?php echo $ui_begin_date; ?>", //Editor
                "data": 'DT_INI_CURSO',
                "name": 'DT_INI_CURSO',
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
                "data": 'DSP_CURSO',
                "name": 'DSP_CURSO',
                "className": "visibleColumn"
            }, {
                "responsivePriority": 6,
                "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                "label": "<?php echo $ui_short_desig; ?>", //Editor
                "data": 'DSR_CURSO',
                "name": 'DSR_CURSO',
                "className": "visibleColumn"
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
                    "class": "form-control defaultWidth"
                }
            }, {
                "responsivePriority": 2,
                "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                "label": "<?php echo $ui_end_date; ?>", //Editor
                "data": 'DT_FIM_CURSO',
                "name": 'DT_FIM_CURSO',
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
                "responsivePriority": 1,
                "data": null,
                "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                "name": 'BUTTONS',
                "type": "hidden",
                "width": "6%",
                "className": "toBottom toCenter",
                "render": function () {
                    //debugger;
                    return GF_CURSOS.crudButtons(true, true, true);
                }
            }
        ],
        "validations": {
            "rules": {
                "DSP_EMPRESA": {
                    required: true
                },
                "ID_CURSO": {
                    required: true,
                    integer: true
                },
                "DT_INI_CURSO": {
                    required: true,
                    dateISO: true
                },
                "DSP_CURSO": {
                    required: true,
                    maxlength: 80
                },
                "DSR_CURSO": {
                    maxlength: 25
                },
                "DESCRICAO": {
                    required: false,
                    maxlength: 4000
                },
                "DT_FIM_CURSO": {
                    dateISO: true,
                    dateEqOrNextThan: 'DT_INI_CURSO'
                }
            },
            //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
            "messages": {
                "DT_FIM_CURSO": {
                    dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                }
            }
        }
    };
    GF_CURSOS = new QuadTable();
    GF_CURSOS.initTable($.extend({}, datatable_instance_defaults, optionGF_CURSOS));
    //END Courses

    //Courses Continued :: QUADFORMS
    var optionsGF_CURSOS_CONTINUED = {
        formId: "#GF_CURSOS_CONTINUED",
        table: "GF_CURSOS",
        info: true, //Disables INFO: (record / total records) :: HOW ????
        // "initialWhereClause": " SEXO = 'M' ", optional
        //"order_by": "NOME",
        //detailsObjects: ['qTableDocs', 'qTableAgregados', 'Documentos', 'Agregados'],
        "pk": {
            "primary": {
                "EMPRESA": {"type": "varchar"},
                "ID_CURSO": {"type": "number"},
                "TP_REGISTO": {"type": "varchar"},
                "DT_INI_CURSO": {"type": "date"}
            }
        },
        "dependsOn": {
            "GF_CURSOS": {
                "EMPRESA": "EMPRESA",
                "ID_CURSO": "ID_CURSO",
                "TP_REGISTO": "TP_REGISTO",
                "DT_INI_CURSO": "DT_INI_CURSO"
            }
        },
        "order_by": "ID_CURSO, TP_REGISTO, DT_INI_CURSO",
        "recordBundle": 1,

        crud: [false, true, false],//create,update,delete
        defaultButtons: ['enter-query', 'new'],

        refreshData: true, //default true
        queryAll: false,//defaults to true ...empty search return all records
        showMultiRecord: false, //default true
        //workflow: true, //optional defaults to false
        showWorkflowOnEdit: false,
        dateFields: {
            "DT_INI_CURSO": "date",
            "DT_INI_TIPOLOGIA": "date",
            "DT_INI_PRD": "date",
            "DT_INI_MODALIDADE": "date",
            "DT_INI_ALVO": "date",
            "DT_INI_ORG": "date",
            "DT_INI_AREA_FORM": "date",
            "DT_INI_CURSO_SOLICITADO": "date",
            "DT_INI_MEMBRO": "date",                                                 
            "DT_INI_DURACAO": "date",
            "DT_INI_COMPETENCIA": "date",
            "DT_INI_MTD_AVAL": "date",
            "DT_INI_EP": "date",
            "DT_INI_TC": "date",
            "DT_INI_TIPO_ENT": "date",
            "DT_INI_TE": "date"
        },
        domainLists: { 
            SHST: {
                 "domain-list": true,
                 "dependent-group": "DG_SIM_NAO"
             },
            PORTAL: {
                 "domain-list": true,
                 "dependent-group": "DG_SIM_NAO"
             }                     
        },
        complexLists: {
            "DSP_TIPOLOGIA": {
                "name": "DSP_TIPOLOGIA",
                "dependent-group": "TIPOLOGIA",
                "dependent-level": 1,
                "data-db-name": 'A.ID_TIPOLOGIA@A.DT_INI_TIPOLOGIA',
                "decodeFromTable": 'GF_TIPOLOGIAS A',
                "desigColumn": "A.DSP_TIPOLOGIA",
                'orderBy': 'A.ID_TIPOLOGIA,A.DT_INI_TIPOLOGIA',
                "class": "form-control complexList chosen",
                "filter": {
                    "create": " AND A.DT_FIM_TIPOLOGIA IS NULL", //On-New-Record
                    "edit": " AND A.DT_FIM_TIPOLOGIA IS NULL", //On-Edit-Record
                }
            },
            "DSP_PRD": {
                "name": "DSP_PRD",
                "dependent-group": "PROD",
                "dependent-level": 1,
                "data-db-name": 'A.ID_PRD@A.DT_INI_PRD',
                "decodeFromTable": 'GF_PRODUTOS A',
                "desigColumn": "A.DSP_PRD",
                'orderBy': 'ID_PRD',
                "class": "form-control complexList chosen",
                "filter": {
                    "create": " AND A.DT_FIM_PRD IS NULL", //On-New-Record
                    "edit": " AND A.DT_FIM_PRD IS NULL", //On-Edit-Record
                }
            },
            "DSP_MODALIDADE": {
                "name": "DSP_MODALIDADE",
                "dependent-group": "MODALIDADE",
                "dependent-level": 1,
                "data-db-name": 'A.ID_MODALIDADE@A.DT_INI_MODALIDADE',
                "decodeFromTable": 'GF_MODALIDADES A',
                "desigColumn": "A.DSP_MODALIDADE",
                'orderBy': 'A.ID_MODALIDADE',
                "class": "form-control complexList chosen",
                "filter": {
                    "create": " AND A.DT_FIM_MODALIDADE IS NULL", //On-New-Record
                    "edit": " AND A.DT_FIM_MODALIDADE IS NULL", //On-Edit-Record
                }
            },                    
            "DSP_ALVO": {
                "name": "DSP_ALVO",
                "dependent-group": "ALVO",
                "dependent-level": 1,
                "data-db-name": 'A.ID_ALVO@A.DT_INI_ALVO',
                "decodeFromTable": 'GF_ALVOS A',
                "desigColumn": "A.DSP_ALVO",
                'orderBy': 'A.ID_ALVO',
                "class": "form-control complexList chosen",
                "filter": {
                    "create": " AND A.DT_FIM_ALVO IS NULL", //On-New-Record
                    "edit": " AND A.DT_FIM_ALVO IS NULL", //On-Edit-Record
                }
            },
            "DSP_ORG": {
                "name": "DSP_ORG",
                "dependent-group": "ORGANIZACAO",
                "dependent-level": 1,
                "data-db-name": 'A.ID_ORG@A.DT_INI_ORG',
                "decodeFromTable": 'GF_ORGANIZACOES A',
                "desigColumn": "A.DSP_ORG",
                'orderBy': 'A.ID_ORG',
                "class": "form-control complexList chosen",
                "filter": {
                    "create": " AND A.DT_FIM_ORG IS NULL", //On-New-Record
                    "edit": " AND A.DT_FIM_ORG IS NULL", //On-Edit-Record
                }
            },
            "DSP_AREA_FORM": {
                "name": "DSP_AREA_FORM",
                "dependent-group": "AREA_FORM",
                "dependent-level": 1,
                "data-db-name": 'A.ID_AREA_FORM@A.DT_INI_AREA_FORM',
                "decodeFromTable": 'GF_AREAS_FORMACAO A',
                "desigColumn": "A.DSP_AREA_FORM",
                'orderBy': 'A.ID_AREA_FORM',
                "class": "form-control complexList chosen",
                "filter": {
                    "create": " AND A.DT_FIM_AREA_FORM IS NULL", //On-New-Record
                    "edit": " AND A.DT_FIM_AREA_FORM IS NULL", //On-Edit-Record
                }
            },                                           
            "DSP_CURSO_SOLICITADO": {
                "name": "DSP_CURSO_SOLICITADO",
                "dependent-group": "CURSO_SOLICITADO",
                "dependent-level": 1,
                "deferred": true,
                "data-db-name": 'A.EMPRESA@A.ID_CURSO@A.TP_REGISTO@A.DT_INI_CURSO',
                "distribute-value": 'EMPRESA@ID_CURSO_SOLICITADO@TP_REGISTO_SOLICITADO@DT_INI_CURSO_SOLICITADO',
                "decodeFromTable": 'GF_CURSOS A',
                "desigColumn": "A.DSP_CURSO",
                "whereClause": " AND A.TP_REGISTO = 'S' ",
                'orderBy': 'A.ID_CURSO',
                "class": "form-control complexList chosen",
                "filter": {
                    "create": " AND A.DT_FIM_CURSO IS NULL AND A.EMPRESA = ':EMPRESA' AND A.TP_REGISTO = 'S'", //On-New-Record
                    "edit": " AND A.DT_FIM_CURSO IS NULL AND A.EMPRESA = ':EMPRESA' AND A.TP_REGISTO = 'S'", //On-Edit-Record
                }
            },                                             
//                    "DSP_MEMBRO": {
//                        "name": "DSP_MEMBRO",
//                        "dependent-group": "MEMBRO",
//                        "dependent-level": 1,
//                        "data-db-name": 'A.ID_MEMBRO@A.DT_INI_MEMBRO',
//                        "decodeFromTable": 'DG_MEMBRO A',
//                        "desigColumn": "A.DSR_NOME",
//                        'orderBy': 'A.ID_MEMBRO',
//                        "class": "form-control complexList chosen",
//                        "filter": {
//                            "create": " AND A.DT_FIM_MEMBRO IS NULL", //On-New-Record
//                            "edit": " AND A.DT_FIM_MEMBRO IS NULL", //On-Edit-Record
//                        }
//                    }, 

            "DSP_DURACAO": {
                "name": "DSP_DURACAO",
                "dependent-group": "DURACAO",
                "dependent-level": 1,
                "data-db-name": 'A.ID_DURACAO@A.DT_INI_DURACAO',
                "decodeFromTable": 'GF_DURACOES A',
                "desigColumn": "A.DSP_DURACAO",
                'orderBy': 'A.ID_DURACAO',
                "class": "form-control complexList chosen",
                "filter": {
                    "create": " AND A.DT_FIM_DURACAO IS NULL", //On-New-Record
                    "edit": " AND A.DT_FIM_DURACAO IS NULL", //On-Edit-Record
                }
            }, 
            "DSP_COMPETENCIA": {
                "name": "DSP_COMPETENCIA",
                "dependent-group": "COMPETENCIA",
                "dependent-level": 1,
                "deferred": true,
                "data-db-name": 'A.EMPRESA@A.ID_COMPETENCIA@A.DT_INI_COMPETENCIA',
                "decodeFromTable": 'RH_DEF_COMPETENCIAS A',
                "desigColumn": "A.DSP_COMPETENCIA",
                'orderBy': 'A.ID_COMPETENCIA',
                "class": "form-control complexList chosen",
                "filter": {
                    "create": " AND A.DT_FIM_COMPETENCIA IS NULL AND A.EMPRESA = ':EMPRESA'", //On-New-Record
                    "edit": " AND A.DT_FIM_COMPETENCIA IS NULL AND A.EMPRESA = ':EMPRESA'", //On-Edit-Record
                }
            },
            "DSP_MTD_AVAL": {
                "name": "DSP_MTD_AVAL",
                "dependent-group": "DURACAO",
                "dependent-level": 1,
                "data-db-name": 'A.ID_MTD_AVAL@A.DT_INI_MTD_AVAL',
                "decodeFromTable": 'GF_METODOS_AVALIACAO A',
                "desigColumn": "A.DSP_MTD_AVAL",
                'orderBy': 'A.ID_MTD_AVAL',
                "class": "form-control complexList chosen",
                "filter": {
                    "create": " AND A.DT_FIM_MTD_AVAL IS NULL", //On-New-Record
                    "edit": " AND A.DT_FIM_MTD_AVAL IS NULL", //On-Edit-Record
                }
            },                
            "DSP_EP": {
                "name": "DSP_EP",
                "dependent-group": "ESCALA",
                "dependent-level": 1,
                "deferred": true,
                "data-db-name": 'A.EMPRESA@A.ID_EP@DA.T_INI_EP',
                "decodeFromTable": 'RH_DEF_ESCALAS_PROFICIENCIA A',
                "desigColumn": "A.DSP_EP",
                'orderBy': 'A.ID_EP',
                "class": "form-control complexList chosen",
                "filter": {
                    "create": " AND A.DT_FIM_EP IS NULL AND A.EMPRESA = ':EMPRESA'", //On-New-Record
                    "edit": " AND A.DT_FIM_EP IS NULL AND A.EMPRESA = ':EMPRESA'", //On-Edit-Record
                }
            },
            "DSP_TP_CERTIF": {
                "name": "DSP_TP_CERTIF",
                "dependent-group": "ESCALA",
                "dependent-level": 1,
                "data-db-name": 'A.ID_TP_CERTIFICADO@A.DT_INI_TC',
                "decodeFromTable": 'GF_TP_CERTIFICADOS A',
                "desigColumn": "A.DSP_TP_CERTIF",
                'orderBy': 'A.ID_TP_CERTIFICADO',
                "class": "form-control complexList chosen",
                "filter": {
                    "create": " AND A.DT_FIM_TC IS NULL", //On-New-Record
                    "edit": " AND A.DT_FIM_TC IS NULL", //On-Edit-Record
                }
            },    
/*                    
>/DG_TIPOS_ENTIDADES
CD_ENT, 
CD_TIPO_ENT, 
DT_INI_TIPO_ENT, 
DT_INI_TE,
*/
        },
        validations: {
            rules: {
                SHST: {
                    required: true,
                },
                PORTAL: {
                    required: true,
                },
                ANOS_RECORRENCIA: {
                    integer: true,
                    rangelength: [0, 99]
                },
                MESES_RECORRENCIA: {
                    integer: true,
                    rangelength: [0, 99]
                },
                DIAS_RECORRENCIA: {
                    integer: true,
                    rangelength: [0, 999]
                },
                CARGA_HORARIA: {
                    number: true
                }
            }
        }
    };
    GF_CURSOS_CONTINUED = new QuadForm();
    GF_CURSOS_CONTINUED.initForm($.extend({}, datatable_instance_defaults, optionsGF_CURSOS_CONTINUED));

    /* QUADFORMS :: DOUBLE-CLICK -> EDIT RECORD */
    $('#GF_CURSOS_CONTINUED').dblclick(function() {
        var el = $("#GF_CURSOS_CONTINUED").find("[data-form-action='edit']");  
        if (el.css('display') !== 'none' && (el.attr('disabled') === undefined || el.attr('disabled') === false) ) { //SÓ SE O BOTÃO ESTIVER VISÍVEL e ENABLED
            el.trigger('click');
        }
    });
    //END Courses Continued

    //Courses Trans
    var optionsGF_CURSO_TRADS = {
        "tableId": "GF_CURSO_TRADS",
        "table": "GF_CURSO_TRADS",
        "pk": {
            "primary": {
                "EMPRESA": {"type": "varchar"},
                "ID_CURSO": {"type": "number"},
                "TP_REGISTO": {"type": "varchar"},
                "DT_INI_CURSO": {"type": "date"},
                "CD_LINGUA": {"type": "number"},
                "DT_INI": {"type": "date"}
            }
        },
        "dependsOn": {
            "GF_CURSOS": {
                "EMPRESA": "EMPRESA",
                "ID_CURSO": "ID_CURSO",
                "TP_REGISTO": "TP_REGISTO",
                "DT_INI_CURSO": "DT_INI_CURSO"
            }
        },
        "order_by": "CD_LINGUA, DT_INI DESC",
        "recordBundle": 4,
        "pageLenght": 4,
        "scrollY": "117",
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
                "data": 'ID_CURSO',
                "name": 'ID_CURSO',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'TP_REGISTO',
                "name": 'TP_REGISTO',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'DT_INI_CURSO',
                "name": 'DT_INI_CURSO',
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
                        "create": " AND A.ATIVO = 'S'", 
                        "edit": " AND A. ATIVO = 'S'",
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
                    "style": "max-width: 335px",
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
                    return GF_CURSO_TRADS.crudButtons(true, true, true);
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
    GF_CURSO_TRADS = new QuadTable();
    GF_CURSO_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsGF_CURSO_TRADS));
    //Courses Trads

    //Programmatic Content
    var optionsGF_CONTEUDOS_PROGRAMATICOS = {
        "tableId": "GF_CONTEUDOS_PROGRAMATICOS",
        "table": "GF_CONTEUDOS_PROGRAMATICOS",
        "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_program_content; ?>",
        "pk": {
            "primary": {
                "EMPRESA": {"type": "varchar"},
                "ID_CURSO": {"type": "number"},
                "TP_REGISTO": {"type": "varchar"},
                "DT_INI_CURSO": {"type": "date"},
                "ID_MODULO": {"type": "number"},
                "DT_INI_MODULO": {"type": "date"}
            }
        },
        "dependsOn": {
            "GF_CURSOS": {
                "EMPRESA": "EMPRESA",
                "ID_CURSO": "ID_CURSO",
                "TP_REGISTO": "TP_REGISTO",
                "DT_INI_CURSO": "DT_INI_CURSO"
            }
        },
        "crudOnMasterInactive": {
            "condition": "data.DT_FIM_MODULO !== null",
            "acl": {
                "create": false,
                "update": false,
                "delete": false
            }
        },
        "detailsObjects": ['GF_CONTEUDO_PROGRAM_TRADS'],
        "order_by": "ID_MODULO, DT_INI_MODULO",
        "recordBundle": 4,
        "pageLenght": 4,
        "scrollY": "117",
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
                "data": 'ID_CURSO',
                "name": 'ID_CURSO',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'TP_REGISTO',
                "name": 'TP_REGISTO',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'DT_INI_CURSO',
                "name": 'DT_INI_CURSO',
                "datatype": 'date',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "responsivePriority": 2,
                "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                "label": "<?php echo $ui_code; ?>", //Editor
                "data": 'ID_MODULO',
                "name": 'ID_MODULO',
                "className": "visibleColumn",
            }, {
                "responsivePriority": 3,
                "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                "label": "<?php echo $ui_begin_date; ?>", //Editor
                "data": 'DT_INI_MODULO',
                "name": 'DT_INI_MODULO',
                "datatype": 'date',
                "def": '1900-01-01',
                "className": "visibleColumn",
                "attr": {
                    "class": "form-control datepicker"
                }
            }, {
                "responsivePriority": 4,
                "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                "label": "<?php echo $ui_description; ?>", //Editor
                "data": 'DSP_MODULO',
                "name": 'DSP_MODULO',
                "className": "visibleColumn",
            }, {
                "responsivePriority": 5,
                "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                "label": "<?php echo $ui_short_desig; ?>", //Editor
                "data": 'DSR_MODULO',
                "name": 'DSR_MODULO',
                "className": "visibleColumn",
            }, {
                "title": "<?php echo mb_strtoupper($ui_workload, 'UTF-8'); ?>", //Datatables :: Original
                "label": "<?php echo $ui_workload; ?>", //Editor
                "data": 'CARGA_HORARIA',
                "name": 'CARGA_HORARIA',
                "className": "visibleColumn right",
                "attr": {
                    "class": "form-control toRight",
                    "style": "width: 30%;"
                }
            }, {
                "title": "<?php echo mb_strtoupper($ui_opcional_code, 'UTF-8'); ?>", //Datatables :: Original
                "label": "<?php echo $ui_opcional_code; ?>", //Editor
                "data": 'OPCIONAL_CODE',
                "name": 'OPCIONAL_CODE',
                "className": "none visibleColumn",
                "attr": {
                    "class": "form-control"
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
                "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                "label": "<?php echo $ui_end_date; ?>", //Editor
                "data": 'DT_FIM_MODULO',
                "name": 'DT_FIM_MODULO',
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
                    return GF_CONTEUDOS_PROGRAMATICOS.crudButtons(true, true, true);
                }
            }
        ],
        validations: {
            rules: {
                ID_MODULO: {
                    integer: true,
                    required: true,
                },
                DT_INI_MODULO: {
                    required: true,
                    dateISO: true,
                },
                DSP_MODULO: {
                    required: true,
                    maxlength: 80,
                },
                DSR_MODULO: {
                    required: true,
                    maxlength: 25,
                },
                "DESCRICAO": {
                    required: false,
                    maxlength: 4000,
                },
                "DT_FIM_MODULO": {
                    dateISO: true,
                    dateEqOrNextThan: "DT_INI_MODULO",
                }
            },
            "messages": {
                "DT_FIM_MODULO": {
                    dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                }
            }
        }
    };
    GF_CONTEUDOS_PROGRAMATICOS = new QuadTable();
    GF_CONTEUDOS_PROGRAMATICOS.initTable($.extend({}, datatable_instance_defaults, optionsGF_CONTEUDOS_PROGRAMATICOS));
    //Programmatic Content 

    //Programmatic Content Trans
    var optionsGF_CONTEUDO_PROGRAM_TRADS = {
        "tableId": "GF_CONTEUDO_PROGRAM_TRADS",
        "table": "GF_CONTEUDO_PROGRAM_TRADS",
        "pk": {
            "primary": {
                "EMPRESA": {"type": "varchar"},
                "ID_CURSO": {"type": "number"},
                "TP_REGISTO": {"type": "varchar"},
                "DT_INI_CURSO": {"type": "date"},
                "ID_MODULO": {"type": "number"},
                "DT_INI_MODULO": {"type": "date"},
                "CD_LINGUA": {"type": "number"},
                "DT_INI": {"type": "date"}
            }
        },
        "dependsOn": {
            "GF_CONTEUDOS_PROGRAMATICOS": {
                "EMPRESA": "EMPRESA",
                "ID_CURSO": "ID_CURSO",
                "TP_REGISTO": "TP_REGISTO",
                "DT_INI_CURSO": "DT_INI_CURSO",
                "ID_MODULO": "ID_MODULO",
                "DT_INI_MODULO": "DT_INI_MODULO"
            }
        },
        "order_by": "CD_LINGUA, DT_INI DESC",
        "recordBundle": 4,
        "pageLenght": 4,
        "scrollY": "117",
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
                "data": 'ID_CURSO',
                "name": 'ID_CURSO',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'TP_REGISTO',
                "name": 'TP_REGISTO',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'DT_INI_CURSO',
                "name": 'DT_INI_CURSO',
                "datatype": 'date',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'ID_MODULO',
                "name": 'ID_MODULO',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'DT_INI_MODULO',
                "name": 'DT_INI_MODULO',
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
                        "create": " AND A.ATIVO = 'S'", 
                        "edit": " AND A. ATIVO = 'S'",
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
                    "style": "max-width: 335px",
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
                    return GF_CONTEUDO_PROGRAM_TRADS.crudButtons(true, true, true);
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
    GF_CONTEUDO_PROGRAM_TRADS = new QuadTable();
    GF_CONTEUDO_PROGRAM_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsGF_CONTEUDO_PROGRAM_TRADS));
    //Programmatic Content Trads

    //Target Audience
    var optionsGF_ALVOS_CURSOS = {
        "tableId": "GF_ALVOS_CURSOS",
        "table": "GF_ALVOS_CURSOS",
        "pk": {
            "primary": {
                "EMPRESA": {"type": "varchar"},
                "ID_CURSO": {"type": "number"},
                "TP_REGISTO": {"type": "varchar"},
                "DT_INI_CURSO": {"type": "date"},
                "ID_AC": {"type": "number"},
                "DT_INI_AC": {"type": "date"},
            }
        },
        "dependsOn": {
            "GF_CURSOS": {
                "EMPRESA": "EMPRESA",
                "ID_CURSO": "ID_CURSO",
                "TP_REGISTO": "TP_REGISTO",
                "DT_INI_CURSO": "DT_INI_CURSO"
            }
        },
        "order_by": "ID_AC, DT_INI_AC",
        "recordBundle": 4,
        "pageLenght": 4,
        "scrollY": "117",
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
                "data": 'ID_CURSO',
                "name": 'ID_CURSO',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'TP_REGISTO',
                "name": 'TP_REGISTO',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'DT_INI_CURSO',
                "name": 'DT_INI_CURSO',
                "datatype": 'date',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "responsivePriority": 2,
                "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                "label": "<?php echo $ui_code; ?>", //Editor
                "data": 'ID_AC',
                "name": 'ID_AC',
                "className": "visibleColumn",
            }, {
                "responsivePriority": 3,
                "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                "label": "<?php echo $ui_begin_date; ?>", //Editor
                "data": 'DT_INI_AC',
                "name": 'DT_INI_AC',
                "datatype": 'date',
                "def": '1900-01-01',
                "className": "visibleColumn",
                "attr": {
                    "class": "form-control datepicker"
                }
            }, {
                "responsivePriority": 4,
                "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                "label": "<?php echo $ui_description; ?>", //Editor
                "data": 'DSP_AC',
                "name": 'DSP_AC',
                "className": "visibleColumn",
            }, {
                "responsivePriority": 5,
                "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                "label": "<?php echo $ui_short_desig; ?>", //Editor
                "data": 'DSR_AC',
                "name": 'DSR_AC',
                "className": "visibleColumn",
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": "RHID",
                "name": "RHID",
                "type": "hidden",
                "visible": false,
                "className": ""
            }, {
                "title": "<?php echo mb_strtoupper($ui_rhid, 'UTF-8'); ?>",
                "label": "<?php echo $ui_rhid; ?>",
                "fieldInfo": "<?php echo $hint_assessment_responsable; ?>",
                "data": 'NOME_REDZ',
                "name": 'NOME_REDZ',
                "type": "select",
                "className": "none visibleColumn",
                "complexList": true,
                //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                                        
                "attr": {
                    "dependent-group": "COLABS",
                    "dependent-level": 1,
                    "deferred": true,
                    "data-db-name": 'A.EMPRESA@A.RHID',
                    "decodeFromTable": 'QUAD_PEOPLE A',
                    "desigColumn": "CONCAT(CONCAT(A.RHID,'-'),A.NOME_REDZ)", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.                        
                    "orderBy": "A.RHID",
                    "class": "form-control complexList chosen",
                    //"disabled": true, //Permite inibir o campo no Editor
                    "filter": {
                        "create": " AND A.ATIVO = 'S' AND A.FORMACAO = 'S' AND A.EMPRESA = ':EMPRESA'", //On-New-Record
                        "edit": " AND A.ATIVO = 'S' AND A.FORMACAO = 'S' AND A.EMPRESA = ':EMPRESA'", //On-Edit-Record
                    }
                }
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'ID_GRP_FUNC',
                "name": 'ID_GRP_FUNC',
                "type": "hidden",
                "visible": false,
                "className": ""
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'DT_INI_GRP_FUNC',
                "name": 'DT_INI_GRP_FUNC',
                "type": "hidden",
                "visible": false,
                "datatype": 'date'
            }, {
                "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                "title": "<?php echo mb_strtoupper($ui_functional_group, 'UTF-8'); ?>",
                "label": "<?php echo $ui_functional_group; ?>",
                "data": 'DSP_GRP_FUNC',
                "name": 'DSP_GRP_FUNC',
                "type": "select",
                "className": "visibleColumn",
                //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                "attr": {
                    "dependent-group": "GRP_FUNC",
                    "dependent-level": 1,
                    "deferred": true,
                    "data-db-name": 'A.EMPRESA@A.ID_GRP_FUNC@A.DT_INI_GRP_FUNC',
                    "decodeFromTable": 'RH_DEF_GRUPOS_FUNCIONAIS A',
                    "desigColumn": "CONCAT(CONCAT(A.ID_GRP_FUNC,'-'),A.DSP_GRP_FUNC)", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.                        
                    "orderBy": "A.ID_GRP_FUNC", //usado no complexList.php
                    "class": "form-control complexList chosen",
                    //"disabled": true, //Permite inibir o campo no Editor
                    "filter": {
                        "create": " AND A.DT_FIM_GRP_FUNC IS NULL AND A.EMPRESA = ':EMPRESA'", //On-New-Record
                        "edit": " AND A.DT_FIM_GRP_FUNC IS NULL AND A.EMPRESA = ':EMPRESA'", //On-Edit-Record
                    }
                }
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'ID_FUNCAO',
                "name": 'ID_FUNCAO',
                "type": "hidden",
                "visible": false,
                "className": ""
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'TP_REG_FUNCAO',
                "name": 'TP_REG_FUNCAO',
                "type": "hidden",
                "visible": false,
                "className": ""
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'DT_INI_FUNCAO',
                "name": 'DT_INI_FUNCAO',
                "type": "hidden",
                "visible": false,
                "datatype": 'date'
            }, {
                "complexList": true,
                "title": "<?php echo mb_strtoupper($ui_function, 'UTF-8'); ?>",
                "label": "<?php echo $ui_function; ?>",
                "data": 'DSP_FUNCAO',
                "name": 'DSP_FUNCAO',
                "type": "select",
                "className": "visibleColumn",
                //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                "attr": {
                    "dependent-group": "FUNCOES",
                    "dependent-level": 1,
                    "deferred": true,
                    "data-db-name": 'A.EMPRESA@A.ID_FUNCAO@A.TP_REGISTO@A.DT_INI_FUNCAO',
                    "distribute-value": 'EMPRESA@ID_FUNCAO@TP_REG_FUNCAO@DT_INI_FUNCAO',
                    "decodeFromTable": 'RH_DEF_FUNCOES A',
                    "desigColumn": "CONCAT(CONCAT(A.ID_FUNCAO,'-'),A.DSP_FUNCAO)",
                    "orderBy": "A.ID_FUNCAO",
                    "class": "form-control complexList chosen",
                    //"disabled": true, //Permite inibir o campo no Editor
                    "filter": {
                        "create": " AND A.TP_REGISTO = 'A' AND A.DT_FIM_FUNCAO IS NULL AND A.EMPRESA = ':EMPRESA'", //On-New-Record
                        "edit": " AND A.TP_REGISTO = 'A' AND A.DT_FIM_FUNCAO IS NULL AND A.EMPRESA = ':EMPRESA'", //On-Edit-Record
                    }
                }
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'CD_ESTRUTURA',
                "name": 'CD_ESTRUTURA',
                "type": "hidden",
                "visible": false,
                "className": ""
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'DT_INI_ESTRUTURA',
                "name": 'DT_INI_ESTRUTURA',
                "type": "hidden",
                "visible": false,
                "datatype": 'date'
            }, {
                "complexList": true,
                "title": "<?php echo mb_strtoupper($ui_structure, 'UTF-8'); ?>",
                "label": "<?php echo $ui_structure; ?>",
                "data": 'DSP_ESTRUTURA',
                "name": 'DSP_ESTRUTURA',
                "type": "select",
                "className": "visibleColumn",
                //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                "attr": {
                    "dependent-group": "ESTRUTURA",
                    "dependent-level": 1,
                    "deferred": true,
                    "data-db-name": 'A.EMPRESA@A.CD_ESTRUTURA@A.DT_INI_ESTRUTURA',
                    "decodeFromTable": 'DG_ESTRUTURAS A',
                    "desigColumn": "CONCAT(CONCAT(A.CD_ESTRUTURA,'-'),A.DSP_ESTRUTURA)",
                    "orderBy": "NVL(A.CD_ESTRUTURA, A.NR_ORDEM)",
                    "class": "form-control complexList chosen",
                    //"disabled": true, //Permite inibir o campo no Editor
                    "filter": {
                        "create": " AND A.DT_FIM_ESTRUTURA IS NULL AND A.EMPRESA = ':EMPRESA'", //On-New-Record
                        "edit": " AND A.DT_FIM_ESTRUTURA IS NULL AND A.EMPRESA = ':EMPRESA'", //On-Edit-Record
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
                    "style": "max-width: 335px",
                }
            }, {
                "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                "label": "<?php echo $ui_end_date; ?>", //Editor
                "data": 'DT_FIM_AC',
                "name": 'DT_FIM_AC',
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
                    return GF_ALVOS_CURSOS.crudButtons(true, true, true);
                }
            }
        ],
        validations: {
            rules: {
                ID_AC: {
                    required: true,
                    integer: true,
                },
                DT_INI_AC: {
                    required: true,
                    dateISO: true,
                },
                DSP_AC: {
                    required: true,
                    maxlength: 240,
                },
                DSR_AC: {
                    required: true,
                    maxlength: 240,
                },
                "DESCRICAO": {
                    required: false,
                    maxlength: 4000,
                },
                "DT_FIM_AC": {
                    dateISO: true,
                    dateEqOrNextThan: "DT_INI_AC",
                }
            },
            "messages": {
                "DT_FIM_AC": {
                    dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                }
            }
        }
    };
    GF_ALVOS_CURSOS = new QuadTable();
    GF_ALVOS_CURSOS.initTable($.extend({}, datatable_instance_defaults, optionsGF_ALVOS_CURSOS));
    //Target Audience

    //Professional Experience
    var optionsGF_CURSO_EXPERS_PROFS = {
        "tableId": "GF_CURSO_EXPERS_PROFS",
        "table": "GF_CURSO_EXPERS_PROFS",
        "pk": {
            "primary": {
                "EMPRESA": {"type": "varchar"},
                "ID_CURSO": {"type": "number"},
                "TP_CURSO": {"type": "varchar"},
                "DT_INI_CURSO": {"type": "date"},
                "ID_FUNCAO": {"type": "number"},
                "TP_REG_FUNCAO": {"type": "varchar"},
                "DT_INI_FUNCAO": {"type": "date"},
                "DT_INI_CEP": {"type": "date"},
            }
        },
        "dependsOn": {
            "GF_CURSOS": {
                "EMPRESA": "EMPRESA",
                "ID_CURSO": "ID_CURSO",
                "TP_CURSO": "TP_REGISTO",
                "DT_INI_CURSO": "DT_INI_CURSO"
            }
        },
        "order_by": "ID_FUNCAO, DT_INI_CEP",
        "recordBundle": 4,
        "pageLenght": 4,
        "scrollY": "117",
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
                "data": 'ID_CURSO',
                "name": 'ID_CURSO',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'TP_CURSO',
                "name": 'TP_CURSO',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'DT_INI_CURSO',
                "name": 'DT_INI_CURSO',
                "datatype": 'date',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'ID_FUNCAO',
                "name": 'ID_FUNCAO',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'TP_REG_FUNCAO',
                "name": 'TP_REG_FUNCAO',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'DT_INI_FUNCAO',
                "name": 'DT_INI_FUNCAO',
                "datatype": 'date',
                "type": "hidden", //Editor
                "visible": false, //DataTables

            }, {
                "responsivePriority": 2,
                "complexList": true,
                "title": "<?php echo mb_strtoupper($ui_function, 'UTF-8'); ?>",
                "label": "<?php echo $ui_function; ?>",
                "data": 'DSP_FUNCAO',
                "name": 'DSP_FUNCAO',
                "type": "select",
                "className": "visibleColumn",
                //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                "attr": {
                    "dependent-group": "FUNCOES",
                    "dependent-level": 1,
                    "deferred": true,
                    "data-db-name": 'A.EMPRESA@A.ID_FUNCAO@A.TP_REGISTO@A.DT_INI_FUNCAO',
                    "distribute-value": 'EMPRESA@ID_FUNCAO@TP_REG_FUNCAO@DT_INI_FUNCAO',
                    "decodeFromTable": 'RH_DEF_FUNCOES A',
                    "desigColumn": "CONCAT(CONCAT(A.ID_FUNCAO,'-'),A.DSP_FUNCAO)",
                    "orderBy": "A.ID_FUNCAO",
                    "class": "form-control complexList chosen",
                    //"disabled": true, //Permite inibir o campo no Editor
                    "filter": {
                        "create": " AND A.TP_REGISTO = 'A' AND A.DT_FIM_FUNCAO IS NULL AND A.EMPRESA = ':EMPRESA'", //On-New-Record
                        "edit": " AND A.TP_REGISTO = 'A' AND A.DT_FIM_FUNCAO IS NULL AND A.EMPRESA = ':EMPRESA'", //On-Edit-Record
                    }
                }
            }, {
                "responsivePriority": 2,
                "title": "<?php echo mb_strtoupper($ui_months, 'UTF-8'); ?>", //Datatables :: Original
                "label": "<?php echo $ui_months; ?>", //Editor
                "fieldInfo": "<?php echo $hint_min_months_on_function; ?>", //Editor
                "data": 'MES_MIN_FUNCAO',
                "name": 'MES_MIN_FUNCAO',
                "className": "visibleColumn right",
                "attr": {
                    "class": "form-control toRight",
                    "style": "width: 30%;"
                }
//                    }, {
//                        "title": "", //Datatables
//                        "label": "", //Editor
//                        "data": 'ID_RESPONSABILIDADE',
//                        "name": 'ID_RESPONSABILIDADE',
//                        "type": "hidden", //Editor
//                        "visible": false, //DataTables
//                    }, {
//                        "title": "", //Datatables
//                        "label": "", //Editor
//                        "data": 'TP_REG_RESPONSABILIDADE',
//                        "name": 'TP_REG_RESPONSABILIDADE',
//                        "type": "hidden", //Editor
//                        "visible": false, //DataTables
//                    }, {
//                        "title": "", //Datatables
//                        "label": "", //Editor
//                        "data": 'DT_INI_RESPONSABILIDADE',
//                        "name": 'DT_INI_RESPONSABILIDADE',
//                        "datatype": 'date',
//                        "type": "hidden", //Editor
//                        "visible": false, //DataTables
//
//                     }, {
//                        "responsivePriority": 3,
//                         "complexList": true, 
//                         "title": "<?php echo mb_strtoupper($ui_responsability, 'UTF-8'); ?>",
//                         "label": "<?php echo $ui_responsability; ?>",
//                         "data": 'DSP_RESPONSABILIDADE',
//                         "name": 'DSP_RESPONSABILIDADE',
//                         "type": "select",
//                         "className": "visibleColumn",
//                         //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
//                         "attr": {
//                             "dependent-group": "RESPONSABILITY",
//                             "dependent-level": 1,
//                             "deferred": true,
//                             "data-db-name": 'A.EMPRESA@A.ID_FUNCAO@A.TP_REGISTO@A.DT_INI_FUNCAO',
//                             "distribute-value": 'EMPRESA@ID_RESPONSABILIDADE@TP_REG_RESPONSABILIDADE@DT_INI_RESPONSABILIDADE',
//                             "decodeFromTable": 'RH_DEF_FUNCOES A',
//                             "desigColumn": "CONCAT(CONCAT(A.ID_FUNCAO,'-'),A.DSP_FUNCAO)",                  
//                             "orderBy": "A.ID_FUNCAO", 
//                             "class": "form-control complexList chosen",
//                             //"disabled": true, //Permite inibir o campo no Editor
//                             "filter": {
//                                 "create": " AND A.TP_REGISTO = 'B' AND A.DT_FIM_FUNCAO IS NULL AND A.EMPRESA = ':EMPRESA'", //On-New-Record
//                                 "edit": " AND A.TP_REGISTO = 'B' AND A.DT_FIM_FUNCAO IS NULL AND A.EMPRESA = ':EMPRESA'", //On-Edit-Record
//                             }                
//                         } 
//                    }, {
//                        "responsivePriority": 3,
//                        "title": "<?php echo mb_strtoupper($ui_months, 'UTF-8'); ?>", //Datatables :: Original
//                        "label": "<?php echo $ui_months; ?>", //Editor
//                        "fieldInfo": "<?php echo $hint_min_months_on_responsability; ?>", //Editor
//                        "data": 'MES_MIN_REPONSABILIDADE',
//                        "name": 'MES_MIN_REPONSABILIDADE',
//                        "className": "visibleColumn right",
//                        "attr": {
//                            "class": "form-control toRight",
//                            "style": "width: 30%;"
//                        }                         
            }, {
                "responsivePriority": 3,
                "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                "label": "<?php echo $ui_begin_date; ?>", //Editor
                "data": 'DT_INI_CEP',
                "name": 'DT_INI_CEP',
                "datatype": 'date',
                "def": '1900-01-01',
                "className": "visibleColumn",
                "attr": {
                    "class": "form-control datepicker"
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
                "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                "label": "<?php echo $ui_end_date; ?>", //Editor
                "data": 'DT_FIM_CEP',
                "name": 'DT_FIM_CEP',
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
                    return GF_CURSO_EXPERS_PROFS.crudButtons(true, true, true);
                }
            }
        ],
        validations: {
            rules: {
                DSP_FUNCAO: {
                    required: true,
                },
                DT_INI_CEP: {
                    required: true,
                    dateISO: true,
                },
                MES_MIN_FUNCAO: {
                    ineteger: true
                },
                MES_MIN_REPONSABILIDADE: {
                    ineteger: true
                },
                "DESCRICAO": {
                    required: false,
                    maxlength: 4000,
                },
                "DT_FIM_CEP": {
                    dateISO: true,
                    dateEqOrNextThan: "DT_INI_CEP",
                }
            },
            "messages": {
                "DT_FIM_CEP": {
                    dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                }
            }
        }
    };
    GF_CURSO_EXPERS_PROFS = new QuadTable();
    GF_CURSO_EXPERS_PROFS.initTable($.extend({}, datatable_instance_defaults, optionsGF_CURSO_EXPERS_PROFS));
    //Professional Experience

    //Professional Qualifications
    var optionsGF_CURSO_HABS_PROFS = {
        "tableId": "GF_CURSO_HABS_PROFS",
        "table": "GF_CURSO_HABS_PROFS",
        "pk": {
            "primary": {
                "EMPRESA": {"type": "varchar"},
                "ID_CURSO": {"type": "number"},
                "TP_REGISTO": {"type": "varchar"},
                "DT_INI_CURSO": {"type": "date"},
                "CD_HAB_PROF": {"type": "number"},
                "DT_INI_HAB_PROF": {"type": "date"},
                "DT_INI": {"type": "date"},
            }
        },
        "dependsOn": {
            "GF_CURSOS": {
                "EMPRESA": "EMPRESA",
                "ID_CURSO": "ID_CURSO",
                "TP_REGISTO": "TP_REGISTO",
                "DT_INI_CURSO": "DT_INI_CURSO"
            }
        },
        "order_by": "CD_HAB_PROF, DT_INI",
        "recordBundle": 4,
        "pageLenght": 4,
        "scrollY": "117",
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
                "data": 'ID_CURSO',
                "name": 'ID_CURSO',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'TP_REGISTO',
                "name": 'TP_REGISTO',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'DT_INI_CURSO',
                "name": 'DT_INI_CURSO',
                "datatype": 'date',
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
                "datatype": 'date',
                "type": "hidden", //Editor
                "visible": false, //DataTables

            }, {
                "responsivePriority": 2,
                "complexList": true,
                "title": "<?php echo mb_strtoupper($ui_professional_qualifications_short, 'UTF-8'); ?>",
                "label": "<?php echo $ui_professional_qualifications_short; ?>",
                "data": 'DSP_HAB_PROF',
                "name": 'DSP_HAB_PROF',
                "type": "select",
                "className": "visibleColumn",
                //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                "attr": {
                    "dependent-group": "HABS_PROFS",
                    "dependent-level": 1,
                    "deferred": true,
                    "data-db-name": 'A.EMPRESA@A.CD_HAB_PROF@A.DT_INI_HAB_PROF',
                    "decodeFromTable": 'RH_DEF_HAB_PROFISSIONAIS',
                    "desigColumn": "CONCAT(CONCAT(A.CD_HAB_PROF,'-'),A.DSP_HAB_PROF)",
                    "orderBy": "A.CD_HAB_PROF",
                    "class": "form-control complexList chosen",
                    "filter": {
                        "create": " AND A.DT_FIM_HAB_PROF IS NULL AND A.EMPRESA = ':EMPRESA'", //On-New-Record
                        "edit": " AND A.DT_FIM_HAB_PROF IS NULL AND A.EMPRESA = ':EMPRESA'", //On-Edit-Record
                    }
                }
            }, {
                "responsivePriority": 3,
                "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                "label": "<?php echo $ui_begin_date; ?>", //Editor
                "data": 'DT_INI',
                "name": 'DT_INI',
                "datatype": 'date',
                "def": '1900-01-01',
                "className": "visibleColumn",
                "attr": {
                    "class": "form-control datepicker"
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
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'ID_NV_ESCALA',
                "name": 'ID_NV_ESCALA',
                "type": "hidden",
                "visible": false,
                "className": ""
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'DT_INI_NV_ESCALA',
                "name": 'DT_INI_NV_ESCALA',
                "type": "hidden",
                "visible": false,
                "datatype": 'date'
            }, {
                "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                "title": "<?php echo mb_strtoupper($ui_proficiency_level, 'UTF-8'); ?>",
                "label": "<?php echo $ui_proficiency_level; ?>",
                "data": 'DSR_NEP',
                "name": 'DSR_NEP',
                "type": "select",
                "className": "visibleColumn",
                //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                                        
                "attr": {
                    "dependent-group": "PROFICIENCIA",
                    "dependent-level": 2,
                    "data-db-name": 'A.EMPRESA@A.ID_EP@A.DT_INI_EP@A.ID_NV_ESCALA@A.DT_INI_NV_ESCALA',
                    "decodeFromTable": 'RH_NIVEIS_ESCALA_PROFICIENCIA',
                    "desigColumn": "NVL(A.DSR_NEP, A.DSP_NEP)", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.                        
                    "orderBy": "A.EMPRESA,A.ID_EP,A.DT_INI_EP,A.ID_NV_ESCALA,A.DT_INI_NV_ESCALA", //usado no complexList.php
                    "class": "form-control complexList chosen",
                    //"disabled": true, //Permite inibir o campo no Editor
                    //"whereClause": "",
                    "filter": {
                        "create": " AND A.DT_FIM_NV_ESCALA IS NULL", // AND EMPRESA = ':EMPRESA'", //On-New-Record
                        "edit": " AND A.DT_FIM_NV_ESCALA IS NULL", // AND EMPRESA = ':EMPRESA'", //On-Edit-Record
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
                    "style": "max-width: 335px",
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
                    return GF_CURSO_HABS_PROFS.crudButtons(true, true, true);
                }
            }
        ],
        validations: {
            rules: {
                DSP_HAB_PROF: {
                    required: true,
                },
                DT_INI: {
                    required: true,
                    dateISO: true,
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
    GF_CURSO_HABS_PROFS = new QuadTable();
    GF_CURSO_HABS_PROFS.initTable($.extend({}, datatable_instance_defaults, optionsGF_CURSO_HABS_PROFS));
    //Professional Qualifications

    //Academic Qualifications
    var optionsGF_CURSO_HABS_LITERARIAS = {
        "tableId": "GF_CURSO_HABS_LITERARIAS",
        "table": "GF_CURSO_HABS_LITERARIAS",
        "pk": {
            "primary": {
                "EMPRESA": {"type": "varchar"},
                "ID_CURSO": {"type": "number"},
                "TP_REGISTO": {"type": "varchar"},
                "DT_INI_CURSO": {"type": "date"},
                "CD_HAB_LIT": {"type": "number"},
                "DT_INI": {"type": "date"},
            }
        },
        "dependsOn": {
            "GF_CURSOS": {
                "EMPRESA": "EMPRESA",
                "ID_CURSO": "ID_CURSO",
                "TP_REGISTO": "TP_REGISTO",
                "DT_INI_CURSO": "DT_INI_CURSO"
            }
        },
        "order_by": "CD_HAB_LIT, DT_INI",
        "recordBundle": 4,
        "pageLenght": 4,
        "scrollY": "117",
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
                "data": 'ID_CURSO',
                "name": 'ID_CURSO',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'TP_REGISTO',
                "name": 'TP_REGISTO',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'DT_INI_CURSO',
                "name": 'DT_INI_CURSO',
                "datatype": 'date',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'CD_HAB_LIT',
                "name": 'CD_HAB_LIT',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "responsivePriority": 2,
                "complexList": true,
                "title": "<?php echo mb_strtoupper($ui_academic_qualifications, 'UTF-8'); ?>",
                "label": "<?php echo $ui_academic_qualification; ?>",
                "data": 'DSP_HAB_LIT',
                "name": 'DSP_HAB_LIT',
                "type": "select",
                "className": "visibleColumn",
                //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                "attr": {
                    "dependent-group": "HABS_LIT",
                    "dependent-level": 1,
                    "data-db-name": 'A.CD_HAB_LIT',
                    "decodeFromTable": 'RH_DEF_HAB_LITERARIAS',
                    "desigColumn": "CONCAT(CONCAT(A.CD_HAB_LIT,'-'),A.DSP_HAB_LIT)",
                    "orderBy": "A.CD_HAB_LIT",
                    "class": "form-control complexList chosen",
                    //"disabled": true, //Permite inibir o campo no Editor
                }
            }, {
                "responsivePriority": 3,
                "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                "label": "<?php echo $ui_begin_date; ?>", //Editor
                "data": 'DT_INI',
                "name": 'DT_INI',
                "datatype": 'date',
                "def": '1900-01-01',
                "className": "visibleColumn",
                "attr": {
                    "class": "form-control datepicker"
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
                    return GF_CURSO_HABS_LITERARIAS.crudButtons(true, true, true);
                }
            }
        ],
        validations: {
            rules: {
                DSP_HAB_LIT: {
                    required: true,
                },
                DT_INI: {
                    required: true,
                    dateISO: true,
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
    GF_CURSO_HABS_LITERARIAS = new QuadTable();
    GF_CURSO_HABS_LITERARIAS.initTable($.extend({}, datatable_instance_defaults, optionsGF_CURSO_HABS_LITERARIAS));
    //Academic Qualifications

    //Precedences
    var optionsGF_CURSOS_PRECEDENCIAS = {
        "tableId": "GF_CURSOS_PRECEDENCIAS",
        "table": "GF_CURSOS_PRECEDENCIAS",
        "pk": {
            "primary": {
                "EMPRESA": {"type": "varchar"},
                "ID_CURSO": {"type": "number"},
                "TP_REGISTO": {"type": "varchar"},
                "DT_INI_CURSO": {"type": "date"},
                "ID_CURSO_PRE": {"type": "number"},
                "DT_INI_CURSO_PRE": {"type": "date"},
                "DT_INI_PC": {"type": "date"},
            }
        },
        "dependsOn": {
            "GF_CURSOS": {
                "EMPRESA": "EMPRESA",
                "ID_CURSO": "ID_CURSO",
                "TP_REGISTO": "TP_REGISTO",
                "DT_INI_CURSO": "DT_INI_CURSO"
            }
        },
        "order_by": "ID_CURSO_PRE, DT_INI_PC",
        "recordBundle": 4,
        "pageLenght": 4,
        "scrollY": "117",
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
                "data": 'ID_CURSO',
                "name": 'ID_CURSO',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'TP_REGISTO',
                "name": 'TP_REGISTO',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'DT_INI_CURSO',
                "name": 'DT_INI_CURSO',
                "datatype": 'date',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'ID_CURSO_PRE',
                "name": 'ID_CURSO_PRE',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'DT_INI_CURSO_PRE',
                "name": 'DT_INI_CURSO_PRE',
                "datatype": 'date',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "responsivePriority": 2,
                "complexList": true,
                "title": "<?php echo mb_strtoupper($ui_course, 'UTF-8'); ?>",
                "label": "<?php echo $ui_course; ?>",
                "data": 'DSP_CURSO',
                "name": 'DSP_CURSO',
                "type": "select",
                "className": "visibleColumn",
                //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                "attr": {
                    "dependent-group": "CURSO",
                    "dependent-level": 1,
                    "deferred": true,
                    "data-db-name": 'A.EMPRESA@A.ID_CURSO@A.TP_REGISTO@A.DT_INI_CURSO',
                    "distribute-value": 'EMPRESA@ID_CURSO_PRE@TP_REGISTO@DT_INI_CURSO_PRE',
                    "decodeFromTable": 'GF_CURSOS a',
                    "desigColumn": "A.DSP_CURSO",
                    "whereClause": "",
                    "orderBy": "A.ID_CURSO",
                    "class": "form-control complexList chosen",
                    //"disabled": true, //Permite inibir o campo no Editor
                    "filter": {
                        "create": " AND A.DT_FIM_CURSO IS NULL AND A.TP_REGISTO = 'C' AND (A.EMPRESA, A.ID_CURSO, A.TP_REGISTO, A.DT_INI_CURSO) NOT IN ((':EMPRESA', ':ID_CURSO', ':TP_REGISTO', ':DT_INI_CURSO'))", //On-New-Record
                        "edit": " AND A.DT_FIM_CURSO IS NULL AND A.TP_REGISTO = 'C'  AND (A.EMPRESA, A.ID_CURSO, A.TP_REGISTO, A.DT_INI_CURSO) NOT IN ((':EMPRESA', ':ID_CURSO', ':TP_REGISTO', ':DT_INI_CURSO'))", //On-Edit-Record
                    }
                }
            }, {
                "responsivePriority": 3,
                "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                "label": "<?php echo $ui_begin_date; ?>", //Editor
                "data": 'DT_INI_PC',
                "name": 'DT_INI_PC',
                "datatype": 'date',
                "def": '1900-01-01',
                "className": "visibleColumn",
                "attr": {
                    "class": "form-control datepicker"
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
                "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                "label": "<?php echo $ui_end_date; ?>", //Editor
                "data": 'DT_FIM_PC',
                "name": 'DT_FIM_PC',
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
                    return GF_CURSOS_PRECEDENCIAS.crudButtons(true, true, true);
                }
            }
        ],
        validations: {
            rules: {
                DSP_CURSO: {
                    required: true,
                },
                DT_INI_PC: {
                    required: true,
                    dateISO: true,
                },
                "DESCRICAO": {
                    required: false,
                    maxlength: 4000,
                },
                "DT_FIM_PC": {
                    dateISO: true,
                    dateEqOrNextThan: "DT_INI_PC",
                }
            },
            "messages": {
                "DT_FIM_PC": {
                    dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                }
            }
        }
    };
    GF_CURSOS_PRECEDENCIAS = new QuadTable();
    GF_CURSOS_PRECEDENCIAS.initTable($.extend({}, datatable_instance_defaults, optionsGF_CURSOS_PRECEDENCIAS));
    //END Precedences

    //Characteristics
    var optionsGF_CURSO_CARACTERISTICAS = {
        "tableId": "GF_CURSO_CARACTERISTICAS",
        "table": "GF_CURSO_CARACTERISTICAS",
        "pk": {
            "primary": {
                "EMPRESA": {"type": "varchar"},
                "ID_CURSO": {"type": "number"},
                "TP_REG_CURSO": {"type": "number"},
                "DT_INI_CURSO": {"type": "date"},
                "ID_TP_CARACT": {"type": "number"},
                "DT_INI_TP_CARACT": {"type": "date"},
                "ID_DOM_1": {"type": "number"},
                "DT_INI_DOM_1": {"type": "date"},
                "ID_DOM_2": {"type": "number"},
                "DT_INI_DOM_2": {"type": "date"},
                "DT_INI_PC": {"type": "date"},
                "TP_REGISTO": {"type": "number"},
            }
        },
        "dependsOn": {
            "GF_CURSOS": {
                "EMPRESA": "EMPRESA",
                "ID_CURSO": "ID_CURSO",
                "TP_REG_CURSO": "TP_REGISTO",
                "DT_INI_CURSO": "DT_INI_CURSO"
            }
        },
        "order_by": "TP_REGISTO, ID_TP_CARACT, ID_DOM_1, DT_INI_DOM_2, ID_CARACTERISTICA",
        "scrollY": "163",
        "recordBundle": 7,
        "pageLenght": 7,
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
                "data": 'ID_CURSO',
                "name": 'ID_CURSO',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'TP_REG_CURSO',
                "name": 'TP_REG_CURSO',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'DT_INI_CURSO',
                "name": 'DT_INI_CURSO',
                "datatype": 'date',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'ID_TP_CARACT',
                "name": 'ID_TP_CARACT',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'DT_INI_TP_CARACT',
                "name": 'DT_INI_TP_CARACT',
                "datatype": 'date',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "responsivePriority": 2,
                "title": "<?php echo mb_strtoupper($ui_record_type, 'UTF-8'); ?>", //Datatables :: Original
                "label": "<?php echo $ui_record_type; ?>", //Editor
                //"fieldInfo": "<?php echo $hint_requires_previous_authorizarion; ?>",
                "data": 'TP_REGISTO',
                "name": 'TP_REGISTO',
                "type": "select",
                "className": "visibleColumn",
                "attr": {
                    "domain-list": true,
                    "dependent-group": 'GF_CURSO_CARACTERISTICAS.TP_REGISTO',
                    "class": "form-control"
                },
                "render": function (val, type, row) {
                    if (val != null) {
                        var o = _.find(initApp.joinsData['GF_CURSO_CARACTERISTICAS.TP_REGISTO'], {'RV_LOW_VALUE': val});
                        return val == null ? null : o['RV_MEANING'];
                    }
                    return val;
                }
            }, {
                "responsivePriority": 3,
                "complexList": true,
                "title": "<?php echo mb_strtoupper($ui_characteristic_type, 'UTF-8'); ?>",
                "label": "<?php echo $ui_characteristic_type; ?>",
                "data": 'DSP_TP_CARACT',
                "name": 'DSP_TP_CARACT',
                "type": "select",
                "className": "visibleColumn",
                //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                "attr": {
                    "dependent-group": "CARACT",
                    "dependent-level": 1,
                    "deferred": true,
                    "data-db-name": 'A.EMPRESA@A.ID_TP_CARACT@A.DT_INI_TP_CARACT',
                    //"distribute-value": '',
                    "decodeFromTable": 'RH_DEF_TP_CARACTERISTICAS A',
                    "desigColumn": "NVL(A.DSR_TP_CARACT, A.DSP_TP_CARACT)",
                    "whereClause": "",
                    "orderBy": "A.ID_TP_CARACT",
                    "class": "form-control complexList chosen",
                    //"disabled": true, //Permite inibir o campo no Editor
                    "filter": {
                        "create": " AND A.DT_FIM_TP_CARACT IS NULL AND A.EMPRESA = ':EMPRESA'", //On-New-Record
                        "edit": " AND A.DT_FIM_TP_CARACT IS NULL AND A.EMPRESA = ':EMPRESA'", //On-Edit-Record
                    }
                }
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'ID_DOM_1',
                "name": 'ID_DOM_1',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'DT_INI_DOM_1',
                "name": 'DT_INI_DOM_1',
                "datatype": 'date',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "responsivePriority": 4,
                "complexList": true,
                "title": "<?php echo mb_strtoupper($ui_characteristic_1_dom, 'UTF-8'); ?>",
                "label": "<?php echo $ui_characteristic_1_dom; ?>",
                "data": 'DSP_DOM_1',
                "name": 'DSP_DOM_1',
                "type": "select",
                "className": "visibleColumn",
                //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                "attr": {
                    "dependent-group": "CARACT",
                    "dependent-level": 2,
                    "data-db-name": 'A.EMPRESA@A.ID_TP_CARACT@A.DT_INI_TP_CARACT@A.ID_DOM_1@A.DT_INI_DOM_1',
                    //"distribute-value": '',
                    "decodeFromTable": 'RH_DEF_DOMINIOS_1 A',
                    "desigColumn": "NVL(A.DSR_DOM_1, A.DSP_DOM_1)",
                    "whereClause": "",
                    "orderBy": "A.ID_DOM_1",
                    "class": "form-control complexList chosen",
                    //"disabled": true, //Permite inibir o campo no Editor
                    "filter": {
                        "create": " AND A.DT_FIM_DOM_1 IS NULL", //On-New-Record
                        "edit": " AND A.DT_FIM_DOM_1 IS NULL", //On-Edit-Record
                    }
                }
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'ID_DOM_2',
                "name": 'ID_DOM_2',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'DT_INI_DOM_2',
                "name": 'DT_INI_DOM_2',
                "datatype": 'date',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "responsivePriority": 5,
                "complexList": true,
                "title": "<?php echo mb_strtoupper($ui_characteristic_2_dom, 'UTF-8'); ?>",
                "label": "<?php echo $ui_characteristic_2_dom; ?>",
                "data": 'DSP_DOM_2',
                "name": 'DSP_DOM_2',
                "type": "select",
                "className": "visibleColumn",
                //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                "attr": {
                    "dependent-group": "CARACT",
                    "dependent-level": 3,
                    "data-db-name": 'A.EMPRESA@A.ID_TP_CARACT@A.DT_INI_TP_CARACT@A.ID_DOM_1@A.DT_INI_DOM_1@A.ID_DOM_2@A.DT_INI_DOM_2',
                    //"distribute-value": '',
                    "decodeFromTable": 'RH_DEF_DOMINIOS_2 A',
                    "desigColumn": "NVL(A.DSR_DOM_2, A.DSP_DOM_2)",
                    "whereClause": "",
                    "orderBy": "A.ID_DOM_2",
                    "class": "form-control complexList chosen",
                    //"disabled": true, //Permite inibir o campo no Editor
                    "filter": {
                        "create": " AND A.DT_FIM_DOM_2 IS NULL", //On-New-Record
                        "edit": " AND A.DT_FIM_DOM_2 IS NULL", //On-Edit-Record
                    }
                }
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'ID_CARACTERISTICA',
                "name": 'ID_CARACTERISTICA',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'DT_INI_CARACT',
                "name": 'DT_INI_CARACT',
                "datatype": 'date',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "responsivePriority": 6,
                "complexList": true,
                "title": "<?php echo mb_strtoupper($ui_characteristic, 'UTF-8'); ?>",
                "label": "<?php echo $ui_characteristic; ?>",
                "data": 'DSP_CARACTERISTICA',
                "name": 'DSP_CARACTERISTICA',
                "type": "select",
                "className": "visibleColumn",
                //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                "attr": {
                    "dependent-group": "CARACT",
                    "dependent-level": 4,
                    "data-db-name": 'A.EMPRESA@A.ID_TP_CARACT@A.DT_INI_TP_CARACT@A.ID_DOM_1@A.DT_INI_DOM_1@A.ID_DOM_2@A.DT_INI_DOM_2@A.ID_CARACTERISTICA@A.DT_INI_CARACT',
                    //"distribute-value": '',
                    "decodeFromTable": 'RH_DEF_CARACTERISTICAS A',
                    "desigColumn": "NVL(A.DSR_CARACTERISTICA,A.DSP_CARACTERISTICA)",
                    "whereClause": "",
                    "orderBy": "A.ID_CARACTERISTICA",
                    "class": "form-control complexList chosen",
                    //"disabled": true, //Permite inibir o campo no Editor
                    "filter": {
                        "create": " AND A.DT_FIM_CARACT IS NULL", //On-New-Record
                        "edit": " AND A.DT_FIM_CARACT IS NULL", //On-Edit-Record
                    }
                }

            }, {
                "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                "label": "<?php echo $ui_begin_date; ?>", //Editor
                "data": 'DT_INI_CC',
                "name": 'DT_INI_CC',
                "datatype": 'date',
                "def": '1900-01-01',
                "className": "visibleColumn",
                "attr": {
                    "class": "form-control datepicker"
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
                        "create": " AND A.DT_FIM_EP IS NULL AND A.EMPRESA = ':EMPRESA'", // AND EMPRESA = ':EMPRESA'", //On-New-Record
                        "edit": " AND A.DT_FIM_EP IS NULL AND A.EMPRESA = ':EMPRESA'", // AND EMPRESA = ':EMPRESA'", //On-Edit-Record
                    }
                }
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'ID_NV_ESCALA',
                "name": 'ID_NV_ESCALA',
                "type": "hidden",
                "visible": false,
                "className": ""
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'DT_INI_NV_ESCALA',
                "name": 'DT_INI_NV_ESCALA',
                "type": "hidden",
                "visible": false,
                "datatype": 'date',
                "className": "",
            }, {
                "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                "title": "<?php echo mb_strtoupper($ui_proficiency_level, 'UTF-8'); ?>",
                "label": "<?php echo $ui_proficiency_level; ?>",
                "data": 'DSR_NEP',
                "name": 'DSR_NEP',
                "type": "select",
                "className": "none visibleColumn",
                //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                                        
                "attr": {
                    "dependent-group": "PROFICIENCIA",
                    "dependent-level": 2,
                    "data-db-name": 'A.EMPRESA@A.ID_EP@A.DT_INI_EP@A.ID_NV_ESCALA@A.DT_INI_NV_ESCALA',
                    "decodeFromTable": 'RH_NIVEIS_ESCALA_PROFICIENCIA A',
                    "desigColumn": "NVL(A.DSR_NEP, A.DSP_NEP)", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.                        
                    "orderBy": "A.EMPRESA,A.ID_EP,A.DT_INI_EP,A.ID_NV_ESCALA,A.DT_INI_NV_ESCALA", //usado no complexList.php
                    "class": "form-control complexList chosen",
                    //"disabled": true, //Permite inibir o campo no Editor
                    //"whereClause": "",
                    "filter": {
                        "create": " AND A.DT_FIM_NV_ESCALA IS NULL", // AND EMPRESA = ':EMPRESA'", //On-New-Record
                        "edit": " AND A.DT_FIM_NV_ESCALA IS NULL", // AND EMPRESA = ':EMPRESA'", //On-Edit-Record
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
                    "style": "max-width: 335px",
                }
            }, {
                "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                "label": "<?php echo $ui_end_date; ?>", //Editor
                "data": 'DT_FIM_CC',
                "name": 'DT_FIM_CC',
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
                    return GF_CURSO_CARACTERISTICAS.crudButtons(true, true, true);
                }
            }
        ],
        validations: {
            rules: {
                TP_REGISTO: {
                    required: true,
                },
                DSP_TP_CARACT: {
                    required: true,
                },
                DSP_DOM_1: {
                    required: true,
                },
                DSP_DOM_2: {
                    required: true,
                },
                DSP_CARACTERISTICA: {
                    required: true,
                },
                DT_INI_CC: {
                    required: true,
                    dateISO: true,
                },
                "DESCRICAO": {
                    required: false,
                    maxlength: 4000,
                },
                "DT_FIM_CC": {
                    dateISO: true,
                    dateEqOrNextThan: "DT_INI_CC",
                }
            },
            "messages": {
                "DT_FIM_CC": {
                    dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                }
            }
        }
    };
    GF_CURSO_CARACTERISTICAS = new QuadTable();
    GF_CURSO_CARACTERISTICAS.initTable($.extend({}, datatable_instance_defaults, optionsGF_CURSO_CARACTERISTICAS));
    //Characteristics

    //Equipments
    var optionsGF_CURSO_EQUIPAMENTOS = {
        "tableId": "GF_CURSO_EQUIPAMENTOS",
        "table": "GF_CURSO_EQUIPAMENTOS",
        "pk": {
            "primary": {
                "EMPRESA": {"type": "varchar"},
                "ID_CURSO": {"type": "number"},
                "TP_REGISTO": {"type": "number"},
                "DT_INI_CURSO": {"type": "date"},
                "ID_EQUIPAMENTO": {"type": "number"},
                "DT_INI_EQUIPAMENTO": {"type": "number"},
                "DT_INI_CE": {"type": "date"}
            }
        },
        "dependsOn": {
            "GF_CURSOS": {
                "EMPRESA": "EMPRESA",
                "ID_CURSO": "ID_CURSO",
                "TP_REGISTO": "TP_REGISTO",
                "DT_INI_CURSO": "DT_INI_CURSO"
            }
        },
        "order_by": "ID_EQUIPAMENTO",
//                "scrollY": "163",
//                "recordBundle": 7,
//                "pageLenght": 7,
        "recordBundle": 4,
        "pageLenght": 4,
        "scrollY": "117",
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
                "data": 'ID_CURSO',
                "name": 'ID_CURSO',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'TP_REGISTO',
                "name": 'TP_REGISTO',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'DT_INI_CURSO',
                "name": 'DT_INI_CURSO',
                "datatype": 'date',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'ID_EQUIPAMENTO',
                "name": 'ID_EQUIPAMENTO',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'DT_INI_EQUIPAMENTO',
                "name": 'DT_INI_EQUIPAMENTO',
                "datatype": 'date',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "responsivePriority": 2,
                "complexList": true,
                "title": "<?php echo mb_strtoupper($ui_equipment, 'UTF-8'); ?>",
                "label": "<?php echo $ui_equipment; ?>",
                "data": 'DSP_EQUIPAMENTO',
                "name": 'DSP_EQUIPAMENTO',
                "type": "select",
                "className": "visibleColumn",
                //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                "attr": {
                    "dependent-group": "EQUIPAMENTOS",
                    "dependent-level": 1,
                    "data-db-name": 'A.ID_EQUIPAMENTO@A.DT_INI_EQUIPAMENTO',
                    "otherValues": "DOMINIO('GF_EQUIPAMENTOS.CLASS_FORMACAO','A','')",
                    //"distribute-value": '',
                    "decodeFromTable": 'GF_EQUIPAMENTOS ',
                    "desigColumn": "A.DSP_EQUIPAMENTO",
                    "whereClause": "",
                    "orderBy": "A.ID_EQUIPAMENTO",
                    "class": "form-control complexList chosen",
                    //"disabled": true, //Permite inibir o campo no Editor
                    "filter": {
                        "create": " AND A.DT_FIM_EQUIPAMENTO IS NULL", //On-New-Record
                        "edit": " AND A.DT_FIM_EQUIPAMENTO IS NULL", //On-Edit-Record
                    }
                }
            }, {
                "responsivePriority": 3,
                "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                "label": "<?php echo $ui_description; ?>", //Editor
                "data": 'DSP_CE',
                "name": 'DSP_CE',
                "className": "visibleColumn",
            }, {
                "responsivePriority": 4,
                "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                "label": "<?php echo $ui_short_desig; ?>", //Editor
                "data": 'DSR_CE',
                "name": 'DSR_CE',
                "className": "visibleColumn",
            }, {
                "responsivePriority": 5,
                "title": "<?php echo mb_strtoupper($ui_proportional, 'UTF-8'); ?>", //Datatables :: Original
                "label": "<?php echo $ui_proportional; ?>", //Editor
                "fieldInfo": "<?php echo $hint_equipments_proporcional_trainees; ?>",
                "data": 'PROPORC',
                "name": 'PROPORC',
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
                "title": "<?php echo mb_strtoupper($nr_units_short, 'UTF-8'); ?>", //Datatables :: Original
                "label": "<?php echo $nr_units_short; ?>", //Editor
                "data": 'NR_UNIDADES',
                "name": 'NR_UNIDADES',
                "className": "visibleColumn right",
                "attr": {
                    "class": "form-control toRight",
                    "style": "width: 30%;"
                }
            }, {
                "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                "label": "<?php echo $ui_begin_date; ?>", //Editor
                "data": 'DT_INI_CE',
                "name": 'DT_INI_CE',
                "datatype": 'date',
                "def": '1900-01-01',
                "className": "visibleColumn",
                "attr": {
                    "class": "form-control datepicker"
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
                "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                "label": "<?php echo $ui_end_date; ?>", //Editor
                "data": 'DT_FIM_CE',
                "name": 'DT_FIM_CE',
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
                    return GF_CURSO_EQUIPAMENTOS.crudButtons(true, true, true);
                }
            }
        ],
        validations: {
            rules: {
                DSP_EQUIPAMENTOS: {
                    required: true,
                },
                PROPORC: {
                    required: true,
                },
                NR_UNIDADES: {
                    integer: true,
                },
                DSP_CE: {
                    required: true,
                    maxlength: 80,
                },
                DSR_CE: {
                    required: true,
                    maxlength: 25,
                },
                DT_INI_CE: {
                    required: true,
                    dateISO: true,
                },
                "DESCRICAO": {
                    required: false,
                    maxlength: 4000,
                },
                "DT_FIM_CE": {
                    dateISO: true,
                    dateEqOrNextThan: "DT_INI_CE",
                }
            },
            "messages": {
                "DT_FIM_CE": {
                    dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                }
            }
        }
    };
    GF_CURSO_EQUIPAMENTOS = new QuadTable();
    GF_CURSO_EQUIPAMENTOS.initTable($.extend({}, datatable_instance_defaults, optionsGF_CURSO_EQUIPAMENTOS));
    if (1 === 1) {
        $(document).on('GF_CURSO_EQUIPAMENTOSAttachEvt', function (e) {

            var frm_context = "#GF_CURSO_EQUIPAMENTOS_editorForm",
                    operacao = GF_CURSO_EQUIPAMENTOS.editor.s["action"], //PREVIOUS VERSION -> RH_PROCESSOS_AVALIACAO.editor.s.editOpts["action"];
                    dsp_class_eqp = $('#DTE_Field_DSP_EQUIPAMENTO', frm_context).find('option[value="' + $('#DTE_Field_DSP_EQUIPAMENTO', frm_context).val() + '"]').data('othervalues');
            if (dsp_class_eqp) {
                $('#DTE_Field_DSP_EQUIPAMENTO').parent().siblings("[data-dte-e=msg-info]").css({"width": "135%", "color": "#74a02b", "padding-left": "3px"}).html(dsp_class_eqp);
            }

            //DSP associated w/ Equipment Classification
            $('#DTE_Field_DSP_EQUIPAMENTO', frm_context).on("change", function (e) {
                e.stopPropagation();
                var dsp_class_eqp = $('#DTE_Field_DSP_EQUIPAMENTO', frm_context).find('option[value="' + $('#DTE_Field_DSP_EQUIPAMENTO', frm_context).val() + '"]').data('othervalues');
                if (operacao !== 'query') {
                    if (dsp_class_eqp) {
                        $('#DTE_Field_DSP_EQUIPAMENTO').parent().siblings("[data-dte-e=msg-info]").css({"width": "135%", "color": "#74a02b", "padding-left": "3px"}).html(dsp_class_eqp);
                    } else {
                        $('#DTE_Field_DSP_EQUIPAMENTO').parent().siblings("[data-dte-e=msg-info]").html('');
                    }
                }
            });

            //IF "PROPORC" is YES, it disables "NR_UNIDADES" and vice-versa
            $('#DTE_Field_PROPORC', frm_context).on("change", function (e) {
                e.stopPropagation();
                var no_value = '', valor = $(this).val();
                if (operacao !== 'query') {
                    if (valor === 'S') {
                        $('#DTE_Field_NR_UNIDADES', frm_context).val(no_value);
                        $('#DTE_Field_NR_UNIDADES', frm_context).prop('disabled', true);
                    } else {
                        $('#DTE_Field_NR_UNIDADES', frm_context).prop('disabled', false);
                    }
                }
            });

        });
    }
    //END Equipments

    //Costs
    var optionsGF_CURSO_CUSTOS = {
        "tableId": "GF_CURSO_CUSTOS",
        "table": "GF_CURSO_CUSTOS",
        "pk": {
            "primary": {
                "EMPRESA": {"type": "varchar"},
                "ID_CURSO": {"type": "number"},
                "TP_REGISTO": {"type": "number"},
                "DT_INI_CURSO": {"type": "date"},
                "ID_FAMILIA_CUSTO": {"type": "number"},
                "DT_INI_FAMILIA_CUSTO": {"type": "date"},
                "ID_TP_CUSTO": {"type": "number"},
                "DT_INI_TP_CUSTO": {"type": "date"},
                "DT_INI_CC": {"type": "date"}
            }
        },
        "dependsOn": {
            "GF_CURSOS": {
                "EMPRESA": "EMPRESA",
                "ID_CURSO": "ID_CURSO",
                "TP_REGISTO": "TP_REGISTO",
                "DT_INI_CURSO": "DT_INI_CURSO"
            }
        },
        "order_by": "ID_FAMILIA_CUSTO, ID_TP_CUSTO, DT_INI_CC",
        "scrollY": "163",
        "recordBundle": 7,
        "pageLenght": 7,
        "preDrawCallback": function (settings) {
            $("#tsRow-GF_CURSO_CUSTOS").removeClass("templateEditor"); //Antes de desenhar a tabela, remove o display: none;
        },
        "footerCallback": function (settings) {
            DrawTablesFooter (GF_CURSO_CUSTOS, //Instância
                        4, //First colspan (nr. of columns) to apply on footer ROW. Use Header as reference, and start counting with 1 until last column to include.
                        [{idx:4, name: "TOTAL_ESTIMADO"},{idx:5, name: "TOTAL_REAL"}], //Columns references to "totalize": [IDX] visible column index starting with 0 + [NAME] "db colmun name" on SQL statistics statement
                        ['select sum(VALOR_ESTIMADO) as TOTAL_ESTIMADO, sum(VALOR_REAL) as TOTAL_REAL from GF_CURSO_CUSTOS'], //SQL statistics statement :: WHERE CLAUSE IS AUTOMATICALLY ADDED USING CURRENT INSTANCE WHERE CLAUSE
                        "<?php echo mb_strtoupper($ui_total, 'UTF-8'); ?>"); //Title
        },
        "tableCols": [
            {
                "responsivePriority": 1,
                "data": null,
                "className": "control toCenter hdrShow",
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
                "data": 'ID_CURSO',
                "name": 'ID_CURSO',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'TP_REGISTO',
                "name": 'TP_REGISTO',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'DT_INI_CURSO',
                "name": 'DT_INI_CURSO',
                "datatype": 'date',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'ID_FAMILIA_CUSTO',
                "name": 'ID_FAMILIA_CUSTO',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'DT_INI_FAMILIA_CUSTO',
                "name": 'DT_INI_FAMILIA_CUSTO',
                "datatype": 'date',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "responsivePriority": 2,
                "complexList": true,
                "title": "<?php echo mb_strtoupper($ui_family, 'UTF-8'); ?>",
                "label": "<?php echo $ui_family; ?>",
                "data": 'DSP_FAMILIA_CUSTO',
                "name": 'DSP_FAMILIA_CUSTO',
                "type": "select",
                "className": "visibleColumn hdrShow",
                //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                "attr": {
                    "dependent-group": "CUSTO",
                    "dependent-level": 1,
                    "data-db-name": 'A.ID_FAMILIA_CUSTO@A.DT_INI_FAMILIA_CUSTO',
                    //"distribute-value": '',
                    "decodeFromTable": 'GF_FAMILIA_CUSTOS A',
                    "desigColumn": "NVL(A.DSR_FAMILIA_CUSTO, A.DSP_FAMILIA_CUSTO)",
                    "whereClause": "",
                    "orderBy": "A.ID_FAMILIA_CUSTO",
                    "class": "form-control complexList chosen",
                    //"disabled": true, //Permite inibir o campo no Editor
                    "filter": {
                        "create": " AND A.DT_FIM_FAMILIA_CUSTO IS NULL", //On-New-Record
                        "edit": " AND A.DT_FIM_FAMILIA_CUSTO IS NULL", //On-Edit-Record
                    }
                }
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'ID_TP_CUSTO',
                "name": 'ID_TP_CUSTO',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'DT_INI_TP_CUSTO',
                "name": 'DT_INI_TP_CUSTO',
                "datatype": 'date',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "responsivePriority": 3,
                "complexList": true,
                "title": "<?php echo mb_strtoupper($ui_cost_type, 'UTF-8'); ?>",
                "label": "<?php echo $ui_cost_type; ?>",
                "data": 'DSP_TP_CUSTO',
                "name": 'DSP_TP_CUSTO',
                "type": "select",
                "className": "visibleColumn hdrShow",
                //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                "attr": {
                    "dependent-group": "CUSTO",
                    "dependent-level": 2,
                    "data-db-name": 'A.ID_FAMILIA_CUSTO@A.DT_INI_FAMILIA_CUSTO@A.ID_TP_CUSTO@A.DT_INI_TP_CUSTO',
                    //"distribute-value": '',
                    "decodeFromTable": 'GF_TIPOS_CUSTO A',
                    "desigColumn": "NVL(A.DSR_TP_CUSTO, A.DSP_TP_CUSTO)",
                    "whereClause": "",
                    "orderBy": "A.ID_TP_CUSTO",
                    "class": "form-control complexList chosen",
                    //"disabled": true, //Permite inibir o campo no Editor
                    "filter": {
                        "create": " AND A.DT_FIM_TP_CUSTO IS NULL", //On-New-Record
                        "edit": " AND A.DT_FIM_TP_CUSTO IS NULL", //On-Edit-Record
                    }
                }
            }, {
                "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                "label": "<?php echo $ui_begin_date; ?>", //Editor
                "data": 'DT_INI_CC',
                "name": 'DT_INI_CC',
                "datatype": 'date',
                "def": '1900-01-01',
                "className": "visibleColumn hdrShow",
                "attr": {
                    "class": "form-control datepicker"
                }
            }, {
                "responsivePriority": 4,
                "title": "<?php echo mb_strtoupper($ui_estimated, 'UTF-8'); ?>", //Datatables :: Original
                "label": "<?php echo $ui_estimated; ?>", //Editor
                //"fieldInfo": "<?php echo $hint_min_months_on_responsability; ?>", //Editor
                "data": 'VALOR_ESTIMADO',
                "name": 'VALOR_ESTIMADO',
                "className": "visibleColumn right hdrShow",
                "attr": {
                    "class": "form-control toRight",
                    "style": "width: 30%;"
                }
            }, {
                "responsivePriority": 5,
                "title": "<?php echo mb_strtoupper($ui_real, 'UTF-8'); ?>", //Datatables :: Original
                "label": "<?php echo $ui_real; ?>", //Editor
                //"fieldInfo": "<?php echo $hint_min_months_on_responsability; ?>", //Editor
                "data": 'VALOR_REAL',
                "name": 'VALOR_REAL',
                "className": "visibleColumn right hdrShow",
                "attr": {
                    "class": "form-control toRight",
                    "style": "width: 30%;"
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
                "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                "label": "<?php echo $ui_end_date; ?>", //Editor
                "data": 'DT_FIM_CC',
                "name": 'DT_FIM_CC',
                "datatype": 'date',
                "className": "visibleColumn hdrShow",
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
                "className": "toCenter hdrShow",
                "render": function () {
                    //debugger;
                    return GF_CURSO_CUSTOS.crudButtons(true, true, true);
                }
            }
        ],
        validations: {
            rules: {
                DSP_FAMILIA_CUSTO: {
                    required: true,
                },
                DSP_TP_CUSTO: {
                    required: true,
                },
                DT_INI_CC: {
                    required: true,
                    dateISO: true,
                },
                VALOR_ESTIMADO: {
                    number: true
                },
                VALOR_REAL: {
                    number: true
                },
                "DESCRICAO": {
                    required: false,
                    maxlength: 4000,
                },
                "DT_FIM_CC": {
                    dateISO: true,
                    dateEqOrNextThan: "DT_INI_CC",
                }
            },
            "messages": {
                "DT_FIM_CC": {
                    dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                }
            }
        }
    };
    GF_CURSO_CUSTOS = new QuadTable();
    GF_CURSO_CUSTOS.initTable($.extend({}, datatable_instance_defaults, optionsGF_CURSO_CUSTOS));
    //END Costs

    //OFERTAS DE FORMAÇÂO :: Em falta            

    //Waiting List
    var optionsGF_LISTAS_ESPERA = {
        "tableId": "GF_LISTAS_ESPERA",
        "table": "GF_LISTAS_ESPERA",
        "pk": {
            "primary": {
                "EMPRESA": {"type": "varchar"},
                "ID_CURSO": {"type": "number"},
                "TP_REGISTO": {"type": "number"},
                "DT_INI_CURSO": {"type": "date"},
                "ID_LISTA_ESPERA": {"type": "number"}
            }
        },
        "dependsOn": {
            "GF_CURSOS": {
                "EMPRESA": "EMPRESA",
                "ID_CURSO": "ID_CURSO",
                "TP_REGISTO": "TP_REGISTO",
                "DT_INI_CURSO": "DT_INI_CURSO"
            }
        },
        "order_by": "ID_LISTA_ESPERA",
        "scrollY": "163",
        "recordBundle": 7,
        "pageLenght": 7,
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
                "data": 'ID_CURSO',
                "name": 'ID_CURSO',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'TP_REGISTO',
                "name": 'TP_REGISTO',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'DT_INI_CURSO',
                "name": 'DT_INI_CURSO',
                "datatype": 'date',
                "type": "hidden", //Editor
                "visible": false, //DataTables         
            }, {
                "responsivePriority": 2,
                "title": "<?php echo mb_strtoupper($ui_id, 'UTF-8'); ?>",
                "label": "<?php echo $ui_id; ?>",
                "data": 'ID_LISTA_ESPERA',
                "name": 'ID_LISTA_ESPERA',
                "datatype": 'sequence',
                "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                "visible": true,
                "className": "visibleColumn", 

            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'ID_ORIGEM',
                "name": 'ID_ORIGEM',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'DT_INI_ORIGEM',
                "name": 'DT_INI_ORIGEM',
                "datatype": 'date',
                "type": "hidden", //Editor
                "visible": false, //DataTables           
            }, {
                "responsivePriority": 3,
                "complexList": true,
                "title": "<?php echo mb_strtoupper($ui_origin, 'UTF-8'); ?>",
                "label": "<?php echo $ui_origin; ?>",
                "data": 'DSP_ORIGEM',
                "name": 'DSP_ORIGEM',
                "type": "select",
                "className": "visibleColumn",
                //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                "attr": {
                    "dependent-group": "GF_ORIGEM",
                    "dependent-level": 1,
                    "data-db-name": 'A.ID_ORIGEM@A.DT_INI_ORIGEM',
                    //"otherValues": "DOMINIO('GF_PRIORIDADE','A','')",
                    //"distribute-value": '',
                    "decodeFromTable": 'GF_ORIGEM_LISTAS_ESPERA A',
                    "desigColumn": "A.DSP_ORIGEM",
                    "whereClause": "",
                    "orderBy": "NVL(A.ID_ORIGEM, A.PRIORIDADE)",
                    "class": "form-control complexList chosen",
                    //"disabled": true, //Permite inibir o campo no Editor
                    "filter": {
                        "create": " AND A.DT_FIM_ORIGEM IS NULL", //On-New-Record
                        "edit": " AND A.DT_FIM_ORIGEM IS NULL", //On-Edit-Record
                    }
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
                "responsivePriority": 4,
                "complexList": true, 
                "title": "<?php echo mb_strtoupper($ui_rhid, 'UTF-8'); ?>",
                "label": "<?php echo $ui_rhid; ?>",
                //"fieldInfo": "<?php echo $hint_assessment_responsable; ?>",
                "data": 'NOME_REDZ',
                "name": 'NOME_REDZ',
                "type": "select",
                "className": "visibleColumn",
                //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                                        
                "attr": {
                    "dependent-group": "COLABS",
                    "dependent-level": 1,
                    "deferred": true,
                    "data-db-name": 'A.EMPRESA@A.RHID',
                    "decodeFromTable": 'QUAD_PEOPLE A',
                    "desigColumn": "CONCAT(CONCAT(A.RHID,'-'),A.NOME_REDZ)", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.                        
                    "orderBy": "A.RHID", //usado no complexList.php
                    "class": "form-control complexList chosen",
                    //"disabled": true, //Permite inibir o campo no Editor
                    "filter": {
                        "create": " AND A.ATIVO = 'S' AND A.FORMACAO = 'S' AND A.EMPRESA = ':EMPRESA'", //On-New-Record
                        "edit": " AND A.ATIVO = 'S' AND A.FORMACAO = 'S' AND A.EMPRESA = ':EMPRESA'", //On-Edit-Record
                    }
                } 
            }, {
                "responsivePriority": 5,
                "title": "<?php echo mb_strtoupper($ui_priority, 'UTF-8'); ?>", //Datatables :: Original
                "label": "<?php echo $ui_priority; ?>", //Editor
                "fieldInfo": "<?php echo $hint_priority_given; ?>",
                "data": 'PRIORIDADE',
                "name": 'PRIORIDADE',
                "type": "select",
                "className": "visibleColumn",
                "attr": {
                    "domain-list": true,
                    "dependent-group": 'GF_PRIORIDADE',
                    "class": "form-control"
                },
                "render": function (val, type, row) {
                    if (val != null) {
                        var o = _.find(initApp.joinsData['GF_PRIORIDADE'], {'RV_LOW_VALUE': val});
                        return val == null ? null : o['RV_MEANING'];
                    }
                    return val;
                }
            }, {
                "responsivePriority": 6,
                "title": "<?php echo mb_strtoupper($ui_requested, 'UTF-8'); ?>", //Datatables :: Original
                "label": "<?php echo $ui_requested; ?>", //Editor
                "fieldInfo": "<?php echo $hint_priority_requested; ?>",
                "data": 'PRIO_SOLICITADA',
                "name": 'PRIO_SOLICITADA',
                "type": "select",
                "className": "visibleColumn",
                "attr": {
                    "domain-list": true,
                    "dependent-group": 'GF_PRIORIDADE',
                    "class": "form-control"
                },
                "render": function (val, type, row) {
                    if (val != null) {
                        var o = _.find(initApp.joinsData['GF_PRIORIDADE'], {'RV_LOW_VALUE': val});
                        return val == null ? null : o['RV_MEANING'];
                    }
                    return val;
                }
            }, {
                "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                "label": "<?php echo $ui_begin_date; ?>", //Editor
                "data": 'DT_INI_LISTA_ESPERA',
                "name": 'DT_INI_LISTA_ESPERA',
                "datatype": 'date',
                "def": hoje(),
                "className": "visibleColumn",
                "attr": {
                    "class": "form-control datepicker"
                }
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": "ID_SITUACAO",
                "name": "ID_SITUACAO",
                "type": "hidden",
                "visible": false,
                "className": ""
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": "TP_SITUACAO",
                "name": "TP_SITUACAO",
                "type": "hidden",
                "visible": false,
                "className": ""
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": "DT_INI_SIT",
                "name": "DT_INI_SIT",
                "datatype": "date",
                "type": "hidden",
                "visible": false,
                "className": ""    
            }, {
                 "responsivePriority": 4,
                "title": "ESTADO_WKF ?", //Datatables
                "label": "ESTADO_WKF ?", //Editor
                "data": "ESTADO_WKF",
                "name": "ESTADO_WKF",
            }, {
                "responsivePriority": 4,
                "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                "title": "<?php echo mb_strtoupper($ui_status, 'UTF-8'); ?>",
                "label": "<?php echo $ui_status; ?>",
                "data": 'DSP_SITUACAO',
                "name": 'DSP_SITUACAO',
                "type": "select",
                "className": "visibleColumn",
                //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                "attr": {
                    "dependent-group": "ESTADO",
                    "dependent-level": 1,
                    "data-db-name": "A.ID_SITUACAO@A.DT_INI_SIT@A.TP_SITUACAO",
                    //"distribute-value": "",
                    "decodeFromTable": 'GF_SITUACOES A',
                    "desigColumn": "A.DSP_SIT", 
                    "whereClause": "AND A.TP_SITUACAO = 'B'", //Estado: 'B' Listas Espera
                    "orderBy": "A.ID_SITUACAO",
                    "class": "form-control complexList chosen",
                    //"disabled": true, //Permite inibir o campo no Editor
                    "filter": {
                        "create": " AND A.DT_FIM_SIT IS NULL", //On-New-Record
                        "edit": " AND A.DT_FIM_SIT IS NULL", //On-Edit-Record
                    }                
                }
            }, {
                "title": "<?php echo mb_strtoupper($ui_external_ref, 'UTF-8'); ?>", //Datatables
                "label": "<?php echo $ui_external_ref; ?>", //Editor
                "data": 'REF_EXTERNA',
                "name": 'REF_EXTERNA',
                "type": 'text', //Editor
                "className": "none visibleColumn",
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
                "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                "label": "<?php echo $ui_end_date; ?>", //Editor
                "data": 'DT_FIM_LISTA_ESPERA',
                "name": 'DT_FIM_LISTA_ESPERA',
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
                    return GF_LISTAS_ESPERA.crudButtons(true, true, true);
                }
            }
        ],
        validations: {
            rules: {
                ID_LISTA_ESPERA: {
                    required: true,
                    integer: true
                },
                DSP_ORIGEM: {
                    required: true
                },
                NOME_REDZ: {
                    required: true
                },
                PRIORIDADE: {
                    required: true
                },
                PRIO_SOLICITADA: {
                    required: true
                },
                DT_INI_LISTA_ESPERA: {
                    required: true,
                    dateISO: true,
                },
                DSP_SITUACAO: {
                    required: true
                },
                "DESCRICAO": {
                    required: false,
                    maxlength: 4000,
                },
                REF_EXTERNA: {
                    required: false,
                    maxlength: 25,
                },
                "DT_FIM_LISTA_ESPERA": {
                    dateISO: true,
                    dateEqOrNextThan: "DT_INI_LISTA_ESPERA",
                }
            },
            "messages": {
                "DT_FIM_LISTA_ESPERA": {
                    dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                }
            }
        }
    };
    GF_LISTAS_ESPERA = new QuadTable();
    GF_LISTAS_ESPERA.initTable($.extend({}, datatable_instance_defaults, optionsGF_LISTAS_ESPERA));
    //END Waiting List

    //Relatório Único
    var optionsGF_CURSOS_RU = {
        "tableId": "GF_CURSOS_RU",
        "table": "GF_CURSOS_RU",
        "pk": {
            "primary": {
                "EMPRESA": {"type": "varchar"},
                "ID_CURSO": {"type": "number"},
                "TP_REGISTO": {"type": "number"},
                "DT_INI_CURSO": {"type": "date"},
                "CTX_RU": {"type": "varchar"},
                "ID_RU": {"type": "number"},
                "DT_INI_RU": {"type": "date"},
                "ANO_RU": {"type": "number"},
            }
        },
        "dependsOn": {
            "GF_CURSOS": {
                "EMPRESA": "EMPRESA",
                "ID_CURSO": "ID_CURSO",
                "TP_REGISTO": "TP_REGISTO",
                "DT_INI_CURSO": "DT_INI_CURSO"
            }
        },
        "order_by": "ANO_RU DESC, CTX_RU, ID_RU",
        "scrollY": "163",
        "recordBundle": 7,
        "pageLenght": 7,
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
                "data": 'ID_CURSO',
                "name": 'ID_CURSO',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'TP_REGISTO',
                "name": 'TP_REGISTO',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'DT_INI_CURSO',
                "name": 'DT_INI_CURSO',
                "datatype": 'date',
                "type": "hidden", //Editor
                "visible": false, //DataTables      
            }, {
                "responsivePriority": 2,
                "title": "<?php echo mb_strtoupper($ui_year, 'UTF-8'); ?>",
                "label": "<?php echo $ui_year; ?>",
                "data": 'ANO_RU',
                "name": 'ANO_RU',
                "visible": true,
                "className": "visibleColumn right",
                "attr": {
                    "class": "form-control toRight",
                    "style": "width: 45px;"
                }
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'CTX_RU',
                "name": 'CTX_RU',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "responsivePriority": 3,
                "complexList": true,
                "title": "<?php echo mb_strtoupper($ui_context, 'UTF-8'); ?>",
                "label": "<?php echo $ui_context; ?>",
                "data": 'DSP_RU_CONTEXTO',
                "name": 'DSP_RU_CONTEXTO',
                "type": "select",
                "className": "visibleColumn",
                //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                "attr": { //domain TRANSFORMED into VIEW in order to filter RU options
                    "dependent-group": "RU",
                    "dependent-level": 1,
                    "data-db-name": 'A.CTX_RU',
                    "decodeFromTable": 'DG_RU_CONTEXTO_VW A',
                    "desigColumn": "A.DSP_RU_CONTEXTO",
                    //"whereClause": "",
                    "orderBy": "A.CTX_RU",
                    "class": "form-control complexList chosen",
                }
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'ID_RU',
                "name": 'ID_RU',
                "type": "hidden", //Editor
                "visible": false, //DataTables
            }, {
                "title": "", //Datatables
                "label": "", //Editor
                "data": 'DT_INI_RU',
                "name": 'DT_INI_RU',
                "datatype": 'date',
                "type": "hidden", //Editor
                "visible": false, //DataTables           
            }, {
                "responsivePriority": 4,
                "complexList": true,
                "title": "<?php echo mb_strtoupper($ui_origin, 'UTF-8'); ?>",
                "label": "<?php echo $ui_origin; ?>",
                "data": 'DSP_ORIGEM',
                "name": 'DSP_ORIGEM',
                "type": "select",
                "className": "visibleColumn",
                //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                "attr": {
                    "dependent-group": "RU",
                    "dependent-level": 2,
                    "data-db-name": 'A.CTX_RU@A.ID_RU@A.DT_INI_RU',
                    //"distribute-value": '',
                    //"otherValues": "DOMINIO('GF_PRIORIDADE','A','')",
                    "decodeFromTable": 'DG_RELATORIO_UNICO A',
                    "desigColumn": "DA.SP_RU",
                    //"whereClause": "",
                    "orderBy": "A.CTX_RU, A.ID_RU",
                    "class": "form-control complexList chosen",
                    //"disabled": true, //Permite inibir o campo no Editor
                    "filter": {
                        "create": " AND A.DT_FIM_RU IS NULL", //On-New-Record ::  AND CTX_RU = ':CTX_RU'
                        "edit": " AND A.DT_FIM_RU IS NULL", //On-Edit-Record ::  AND CTX_RU = ':CTX_RU'
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
                    return GF_CURSOS_RU.crudButtons(true, true, true);
                }
            }
        ],
        validations: {
            rules: {
                DSP_RU_CONTEXTO: {
                    required: true,
                },
                ANO_RU: {
                    integer: true,
                    required: true
                },
                DSP_ORIGEM: {
                    required: true
                }
            }
        }
    };
    GF_CURSOS_RU = new QuadTable();
    GF_CURSOS_RU.initTable($.extend({}, datatable_instance_defaults, optionsGF_CURSOS_RU));
    //END Relatório Único

    //Questionários :: FALTA

    //Imagens :: FALTA
    
    setTimeout( function() {
        $('#GF_CURSOS_CONTINUED > div.btn-toolbar > ul > li.qryResults > div').css('display', 'inherit');
    },500);

});

</script>
