<?php
    require_once '../init.php';
?>
<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <span class="widget-icon"> <i class="fal fa-clone"></i></span>&nbsp;
                <h2><?php echo $ui_training_actions; ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">                                            
                    <a id="GF_ACOES_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                    <table id="GF_ACOES" class="table table-bordered table-hover table-striped w-100"></table>
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
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#Tab1" role="tab" aria-selected="true"><?php echo $ui_details; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab2" role="tab" aria-selected="true"><?php echo $ui_translate; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab3" role="tab" aria-selected="true"><?php echo $ui_interactions; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab4" role="tab" aria-selected="true"><?php echo $ui_targets; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab5" role="tab" aria-selected="true"><?php echo $ui_inscriptions; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab6" role="tab" aria-selected="true" style="background-color: rgb(239, 225, 179);"><?php echo $ui_sessions; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab7" role="tab" aria-selected="true"  style="background-color: rgb(239, 225, 179);"><?php echo $ui_costs; ?></a>
                        </li>
                    </ul>
                </div>
            </div>   
            
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="tab-content">

                         <!-- TAB #1 -->
                        <div class="tab-pane fade active show" id="Tab1" role="tabpanel">
                            <form action="" id="GF_ACOES_CONTINUED" class="form-horizontal-standard" novalidate="novalidate">
                                <form-toolbar></form-toolbar>
                                <fieldset class="first-line">                                         
                                    <div class="form-row">
                                        <div class="form-group col-xs-4 col-sm-4 col-md-4">
                                            <label for="DT_ELABORACAO"><?php echo $ui_elaboration_date; ?></label>
                                            <input class="form-control datepicker" name="DT_ELABORACAO" data-datatype="date">
                                        </div>            

                                        <div class="form-group col-xs-4 col-sm-4 col-md-4">
                                            <label for="DT_ACEITACAO"><?php echo $ui_acceptance_date; ?></label>
                                            <input class="form-control datepicker" name="DT_ACEITACAO" data-datatype="date">
                                        </div>     

                                        <div class="form-group col-xs-4 col-sm-4 col-md-4">
                                            <label for="DT_REJEICAO"><?php echo $ui_rejection_date; ?></label>
                                            <input class="form-control datepicker" name="DT_REJEICAO" data-datatype="date">
                                        </div>                                      

    <!--                                    <div class="form-group col-xs-6 col-sm-6 col-md-2">
                                            <table class="quad-inline">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo $ui_elaboration_date; ?></th>
                                                        <th><?php echo $ui_acceptance_date; ?></th>
                                                        <th><?php echo $ui_rejection_date; ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td style="width: 33.33%;">
                                                            <input class="form-control datepicker" name="DT_ELABORACAO" type="text": "date",
                                                        </td>
                                                        <td style="width: 33.33%;">
                                                            <input class="form-control datepicker" name="DT_ACEITACAO" type="text": "date",
                                                        </td>
                                                        <td style="width: 33.34%;">
                                                            <input class="form-control datepicker" name="DT_REJEICAO" type="text": "date",
                                                        </td>
                                                    <tr>
                                                </tbody>
                                            </table>
                                        </div>                                      -->

                                        <div class="form-group col-xs-12 col-sm-6 col-md-4">
                                            <label for="DSP_VERSAO"><?php echo $ui_version; ?></label>
                                            <select class="form-control chosen complexList" name="DSP_VERSAO"></select>
                                        </div> 

                                        <div class="form-group col-xs-12 col-sm-6 col-md-4">
                                            <label for="DSP_NOME"><?php echo $ui_responsible; ?></label>
                                            <select class="form-control chosen complexList" name="DSP_NOME"></select>
                                        </div>  

                                        <div class="form-group col-xs-12 col-sm-6 col-md-4">
                                            <label for="DSP_SIT"><?php echo $ui_situation; ?></label>
                                            <select class="form-control chosen complexList" name="DSP_SIT"></select>
                                        </div>   

                                        <div class="form-group col-xs-12 col-sm-6 col-md-4">
                                            <label for="DSP_MOTIVO"><?php echo $ui_cancellation_reason; ?></label>
                                            <select class="form-control chosen complexList" name="DSP_MOTIVO"></select>
                                        </div>   

                                        <div class="form-group col-xs-12 col-sm-6 col-md-4">
                                            <label for="DSP_DURACAO"><?php echo $ui_duration; ?></label>
                                            <select class="form-control chosen complexList" name="DSP_DURACAO"></select>
                                        </div>                                             

                                        <div class="form-group col-xs-6 col-sm-6 col-md-4">
                                            <table class="quad-inline">
                                                <thead>
                                                    <tr>
                                                        <th colspan="2"><?php echo $ui_schedule; ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td style="width: 45%;">
                                                            <select class="form-control domainLists" name="TP_HORARIO"></select>
                                                        </td>
                                                        <td>
                                                            <select class="form-control chosen complexList" name="DSP_HOR_DIA"></select>
                                                        </td>
                                                    <tr>
                                                </tbody>
                                            </table>
                                        </div>  

                                        <div class="form-group col-xs-12 col-sm-6 col-md-4">
                                            <label for="DSP_GRP_CONTAB"><?php echo $ui_accounting_group; ?></label>
                                            <select class="form-control chosen complexList" name="DSP_GRP_CONTAB"></select>
                                        </div>                                             


                                        <div class="form-group col-xs-6 col-sm-6 col-md-4">
                                            <table class="quad-inline">
                                                <thead>
                                                    <tr>
                                                        <th colspan="3"><?php echo $ui_participants; ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <input class="form-control toRight" name="NR_MIN_PARTICIPANTES" style="width:40px;">
                                                        </td>
                                                        <td>
                                                            <input class="form-control toRight" name="NR_MAX_PARTICIPANTES" style="width:40px;">
                                                        </td>
                                                        <td>
                                                            <input class="form-control toRight" name="PCT_APROVACAO" style="width:40px;">
                                                        </td>
                                                    <tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th><?php echo $ui_min_short; ?></th>
                                                        <th><?php echo $ui_max_short; ?></th>
                                                        <th style="white-space: nowrap;"><?php echo $ui_approved_perc; ?></th>
                                                    </tr>                                                                                                                
                                                </tfoot>
                                            </table>
                                        </div>  
                                    </div> 
                                </fieldset> 
                            </form>
                        </div>
                         <!-- END TAB #1 -->

                        <!-- TAB #2 -->
                        <div class="tab-pane fade" id="Tab2" role="tabpanel">
                            <a id="GF_ACAO_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="GF_ACAO_TRADS" class="table table-bordered table-hover table-striped w-100"></table>
                        </div>
                        <!-- END TAB #2 -->
                         
                        <!-- TAB #3 -->
                        <div class="tab-pane fade" id="Tab3" role="tabpanel">
                            <a id="GF_INTERACOES_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="GF_INTERACOES" class="table table-bordered table-hover table-striped w-100 nowrap"  style=""></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-31" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon trads"> <i class="far fa-language"></i></span>&nbsp;
                                            <h2><?php echo $ui_translate; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">                                            
                                                <a id="GF_INTERACAO_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="GF_INTERACAO_TRADS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END TAB #3 -->

                        <!-- TAB #4 -->
                        <div class="tab-pane fade" id="Tab4" role="tabpanel">
                            <a id="GF_ALVO_ACOES_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="GF_ALVO_ACOES" class="table table-bordered table-hover table-striped w-100"></table>
                        </div>
                        <!-- END TAB #4 -->

                        <!-- TAB #5 -->
                        <div class="tab-pane fade" id="Tab5" role="tabpanel">
                            <a id="GF_INSCRICOES_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="GF_INSCRICOES" class="table table-bordered table-hover table-striped w-100"></table>
                        </div>
                        <!-- END TAB #5 -->
                        
                         <!-- TAB #6 -->
                        <div class="tab-pane fade" id="Tab6" role="tabpanel">
                            <h6 class="alert alert-warning semi-bold">
                                <i class="far fa-exclamation-triangle"></i> <strong>Falta mapear os processos:</strong> Criar, Eliminar, Cancelar.
                                <pre style="background-color: #efe1b3; border: 0px solid #ccc;">
                                    <strong>1.</strong> Ativar o FORMADOR (membro) nas instâncias, após implementação das Entidades. Procurar no código "DG_MEMBRO". A página de "Custos" também é afetada.
                                    <strong>2.</strong> Redefinir o local onde iremos implementar as substituições dos formadores (neste momento na dependência da Agenda, embora a chave não o pondere).
                                </pre>
                            </h6>                              
                            
                            <a id="GF_SESSOES_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="GF_SESSOES" class="table table-bordered table-hover table-striped w-100"></table>
                            
                            <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-start">
                                <div class="panel-toolbar pr-3 align-self-end">
                                    <ul id="panel-tab-6-1" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#Tab61" role="tab" aria-selected="true"><?php echo $ui_translate; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Tab62" role="tab" aria-selected="true"><?php echo $ui_equipments; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Tab63" role="tab" aria-selected="true"><?php echo $ui_agenda; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Tab64" role="tab" aria-selected="true"><?php echo $ui_attendances; ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-container show">
                                <div class="panel-content">
                                    <div class="tab-content">
                                        <div class="tab-pane fade active show" id="Tab61" role="tabpanel">
                                            <a id="GF_SESSAO_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="GF_SESSAO_TRADS" class="table table-bordered table-hover table-striped w-100"></table>
                                        </div>
                                        <div class="tab-pane fade" id="Tab62" role="tabpanel">
                                            <a id="GF_SESSOES_EQUIPAMENTOS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="GF_SESSOES_EQUIPAMENTOS" class="table table-bordered table-hover table-striped w-100"></table>
                                        </div>                                        
                                        <div class="tab-pane fade" id="Tab63" role="tabpanel">
                                            <a id="GF_AGENDAS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="GF_AGENDAS" class="table table-bordered table-hover table-striped w-100 nowrap"  style=""></table>
                                            <div class="row mt-4">
                                                <div class="col-xl-12">
                                                    <div id="panel-31" class="panel">
                                                        <div class="panel-hdr">
                                                            <span class="widget-icon trads"> <i class="far fa-language"></i></span>&nbsp;
                                                            <h2><?php echo $ui_translate; ?></h2>
                                                        </div>
                                                        <div class="panel-container show">
                                                            <div class="panel-content">                                            
                                                                <a id="GF_AGENDA_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                                <table id="GF_AGENDA_TRADS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                        
                                        <div class="tab-pane fade" id="Tab64" role="tabpanel">
                                            <a id="GF_SESSAO_PRESENCAS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="GF_SESSAO_PRESENCAS" class="table table-bordered table-hover table-striped w-100"></table>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                                                        
                        </div>
                         <!-- END TAB #6 -->

                         <!-- TAB #7 -->
                        <div class="tab-pane fade" id="Tab7" role="tabpanel">
                            <h6 class="alert alert-warning semi-bold">
                                <pre style="background-color: #efe1b3; border: 0px solid #ccc;">
                                    <strong>1.</strong> Ativar o FORMADOR (membro) na instância, após implementação das Entidades. Procurar no código "DG_MEMBRO".
                                    <strong>2.</strong> Verificar necessidade de implementarmos a funcionalidade associada ao botão de "Recálculo" disponível no Oracle*Forms.
                                </pre>
                            </h6>                           
                            <div class="row">
                                <div class="row mt-4">
                                    <div class="col-xl-12">
                                        <div id="panel-71" class="panel">
                                            <div class="panel-hdr">
                                                <span class="widget-icon trads"> <i class="far fa-landmark"></i></span>&nbsp;
                                                <h2><?php echo $ui_logistics_costs; ?></h2>
                                            </div>
                                            <div class="panel-container show">
                                                <div class="panel-content">                                            
                                                    <a id="GF_CUSTO_EQPMS_LOCAIS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                    <table id="GF_CUSTO_EQPMS_LOCAIS" class="table responsive table-bordered table-striped table-hover nowrap">
                                                        <tfoot>
                                                            <tr id="tsRow-GF_CUSTO_EQPMS_LOCAIS" class="templateEditor"></tr>
                                                        </tfoot>                                                 
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="row mt-4">
                                    <div class="col-xl-12">
                                        <div id="panel-71" class="panel">
                                            <div class="panel-hdr">
                                                <span class="widget-icon trads"> <i class="fas fa-users"></i></span>&nbsp;
                                                <h2><?php echo $ui_people; ?></h2>
                                            </div>
                                            <div class="panel-container show">
                                                <div class="panel-content">                                            
                                                    <a id="GF_CUSTO_FORMADORES_FORMANDOS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                    <table id="GF_CUSTO_FORMADORES_FORMANDOS" class="table responsive table-bordered table-striped table-hover nowrap">
                                                        <tfoot>
                                                            <tr id="tsRow-GF_CUSTO_FORMADORES_FORMANDOS" class="templateEditor"></tr>
                                                        </tfoot>                                                 
                                                    </table>
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
        </div>
    </div>
</div>

<script>
    pageSetUp();

    $(document).ready(function () {

        //Actions
        var optionGF_ACOES = {
            "tableId": "GF_ACOES",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_training_action; ?>",
            "table": "GF_ACOES",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_PLANO_FORM": {"type": "number"},
                    "DT_INI_PLANO_FORM": {"type": "date"},
                    "ID_CURSO": {"type": "number"},
                    "TP_REGISTO": {"type": "varchar"},
                    "DT_INI_CURSO": {"type": "date"},
                    "ID_ACAO": {"type": "number"},
                    "DT_INI_ACAO": {"type": "date"}
                }
            },
            "crudOnMasterInactive": {
                "condition": "data.DT_INI_ACAO === null", //PTE:: A fazer função que devolva S ou N, com base na situação da Ação
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },
            "detailsObjects": ['GF_ACOES_CONTINUED','GF_ACAO_TRADS','GF_INTERACOES','GF_ALVO_ACOES','GF_INSCRICOES', 'GF_SESSOES','GF_CUSTO_EQPMS_LOCAIS','GF_CUSTO_FORMADORES_FORMANDOS'],
            "order_by": "EMPRESA, ID_ACAO desc",
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
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_PLANO_FORM',
                    "name": 'ID_PLANO_FORM',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_PLANO_FORM',
                    "name": 'DT_INI_PLANO_FORM',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                        
                }, {
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_training_plan, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_training_plan; ?>",
                    "data": 'DSP_PLANO_FORM',
                    "name": 'DSP_PLANO_FORM',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "EMPRESA",
                        "dependent-level": 2,
                        "data-db-name": "A.EMPRESA@A.ID_PLANO_FORM@A.DT_INI_PLANO_FORM",
                        "decodeFromTable": "GF_PLANOS_FORMACAO A", //TO CHANGE ON QUAD-HCM
                        "desigColumn": "A.DSP_PLANO_FORM",
                        "orderBy": "A.ID_PLANO_FORM",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.DT_FIM_PLANO_FORM IS NULL", //On-New-Record
                            "edit": " AND A.DT_FIM_PLANO_FORM IS NULL", //On-Edit-Record
                        }                            
                    }
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
                    "responsivePriority": 3,
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_course, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_course; ?>",
                    "data": 'DSP_CURSO',
                    "name": 'DSP_CURSO',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "EMPRESA",
                        "dependent-level": 2,
                        "data-db-name": "A.EMPRESA@A.ID_CURSO@A.TP_REGISTO@A.DT_INI_CURSO",
                        "decodeFromTable": "GF_CURSOS A", //TO CHANGE ON QUAD-HCM
                        "desigColumn": "A.DSP_CURSO",
                        "orderBy": "A.ID_CURSO",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.DT_FIM_CURSO IS NULL", //On-New-Record
                            "edit": " AND A.DT_FIM_CURSO IS NULL", //On-Edit-Record
                        } 
                    }
                }, {
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'ID_ACAO',
                    "name": 'ID_ACAO',
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 5,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_ACAO',
                    "name": 'DT_INI_ACAO',
                    "datatype": 'date',
                    "def": hoje(),
                    "className": "visibleColumn",
                    "attr": {
                        "class": "form-control datepicker"
                    }
                }, {
                    "responsivePriority": 6,
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DSP_ACAO',
                    "name": 'DSP_ACAO',
                    "className": "visibleColumn",
                }, {
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_ACAO',
                    "name": 'DSR_ACAO',
                    "className": "visibleColumn",
               }, {
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_workload, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_workload; ?>",
                    "data": 'CARGA_HORARIA',
                    "name": 'CARGA_HORARIA',
                    "visible": true,
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 45px;"
                    }               
               }, {
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_sessions_nr, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_sessions_nr; ?>",
                    "data": 'NR_SESSOES',
                    "name": 'NR_SESSOES',
                    "visible": true,
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 45px;"
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
/* COLUMNS on QUADFORMS */                     
              }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_VERSAO',
                    "name": 'ID_VERSAO',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_VERSAO',
                    "name": 'DT_INI_VERSAO',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_version, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_version; ?>",
                    "data": 'DSP_VERSAO',
                    "name": 'DSP_VERSAO',
                    "type": "select",
                    "className": "visibleColumn",
                    "visible": false,
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "EMPRESA",
                        "dependent-level": 3,
                        "data-db-name": 'A.EMPRESA@A.ID_PLANO_FORM@A.DT_INI_PLANO_FORM@A.ID_VERSAO@A.DT_INI_VERSAO',
                        "decodeFromTable": "GF_VERSOES A", //TO CHANGE ON QUAD-HCM
                        "desigColumn": "A.DSP_VERSAO",
                        'orderBy': 'A.ID_VERSAO,A.DT_INI_VERSAO',
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.DT_FIM_VERSAO IS NULL", //On-New-Record
                            "edit": " AND A.DT_FIM_VERSAO IS NULL", //On-Edit-Record
                        }
                    }          
/* END COLUMNS on QUADFORMS */
                }, {
                    "responsivePriority": 5,
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM_ACAO',
                    "name": 'DT_FIM_ACAO',
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
                        return GF_ACOES.crudButtons(true, true, true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DSP_EMPRESA": {
                        required: true
                    },
                    "ID_ACAO": {
                        required: true,
                        integer: true
                    },
                    "DT_INI_ACAO": {
                        required: true,
                        dateISO: true
                    },
                    "DSP_ACAO": {
                        required: true,
                        maxlength: 80
                    },
                    "DSR_ACAO": {
                        maxlength: 25
                    },
                    "CARGA_HORARIA": {
                        number: true
                    },
                    "NR_SESSOES": {
                        number: true
                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000
                    },
                    "DT_FIM_ACAO": {
                        dateISO: true,
                        dateEqOrNextThan: 'DT_INI_ACAO'
                    }
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                    "DT_FIM_ACAO": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        GF_ACOES = new QuadTable();
        GF_ACOES.initTable($.extend({}, datatable_instance_defaults, optionGF_ACOES));

        if (1 === 1) {
            //SHOW / HIDE refined control over instance columns
            var refineColumns = [ 
                {
                    "DSP_VERSAO": {
                        create: true,
                        edit: true,
                        search: true
                    }
                }, {
                    "DT_FIM_ACAO": {
                        create: true,
                        //search: true
                    }
                }
            ];
            //$(document).on('GF_ACOESAttachEvt', function (e) {
            //      console.log('Dummy attach event...');
            //});
            manageQuadTableColumns(GF_ACOES, refineColumns);
            //END Actions
        }

        //Actions Continued :: QUADFORMS
        var optionsGF_ACOES_CONTINUED = {
            formId: "#GF_ACOES_CONTINUED",
            table: "GF_ACOES",
            info: true, //Disables INFO: (record / total records) :: HOW ????
            // "initialWhereClause": " SEXO = 'M' ", optional
            //"order_by": "NOME",
            //detailsObjects: ['qTableDocs', 'qTableAgregados', 'Documentos', 'Agregados'],
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_PLANO_FORM": {"type": "number"},
                    "DT_INI_PLANO_FORM": {"type": "date"},
                    "ID_CURSO": {"type": "number"},
                    "TP_REGISTO": {"type": "varchar"},
                    "DT_INI_CURSO": {"type": "date"},
                    "ID_ACAO": {"type": "number"},
                    "DT_INI_ACAO": {"type": "date"}
                }
            },
            "dependsOn": {
                "GF_ACOES": {
                    "EMPRESA": "EMPRESA",
                    "ID_PLANO_FORM": "ID_PLANO_FORM",
                    "DT_INI_PLANO_FORM": "DT_INI_PLANO_FORM",
                    "ID_CURSO": "ID_CURSO",
                    "TP_REGISTO": "TP_REGISTO",
                    "DT_INI_CURSO": "DT_INI_CURSO",
                    "ID_ACAO": "ID_ACAO",
                    "DT_INI_ACAO": "DT_INI_ACAO"
                }
            },
            "order_by": "ID_ACAO",
            "recordBundle": 1,

            crud: [false, true, false],//create,update,delete
            defaultButtons: ['enter-query', 'new'],

            refreshData: true, //default true
            queryAll: true,//defaults to true ...empty search return all records
            showMultiRecord: false, //default true
            //workflow: true, //optional defaults to false
            showWorkflowOnEdit: false,
            dateFields: {
                "DT_INI_PLANO_FORM": "date",
                "DT_INI_CURSO": "date",
                "DT_INI_VERSAO": "date",                                        
                "DT_INI_TIPO_ENT": "date",
                "DT_INI_TE": "date",
                "DT_INI_MOTIVO": "date",                                        
                "DT_INI_SIT": "date",
                "DT_INI_DURACAO": "date"                                      
            },
            domainLists: { 
                TP_HORARIO: {
                     "domain-list": true,
                     "dependent-group": "RH_TP_HORARIO"
                 }                     
            },
            complexLists: {
                "DSP_VERSAO": {
                    "dependent-group": "PLANO_FORM",
                    "dependent-level": 1,
                    "deferred": true,
                    "name": "DSP_VERSAO",
                    "data-db-name": 'A.EMPRESA@A.ID_PLANO_FORM@A.DT_INI_PLANO_FORM@A.ID_VERSAO@A.DT_INI_VERSAO',
                    "decodeFromTable": 'GF_VERSOES A',
                    "desigColumn": "A.DSP_VERSAO",
                    'orderBy': 'A.ID_VERSAO,A.DT_INI_VERSAO',
                    "class": "form-control complexList chosen",
                    "filter": {
                        "create": " AND A.DT_FIM_VERSAO IS NULL AND A.EMPRESA = ':EMPRESA'", //On-New-Record
                        "edit": " AND A.DT_FIM_VERSAO IS NULL AND A.EMPRESA = ':EMPRESA'", //On-Edit-Record
                    }
                },
                "DSP_NOME": {
                    "dependent-group": "COLABS",
                    "dependent-level": 1,
                    "deferred": true,
                    "name": "DSP_NOME",
                    "data-db-name": 'A.RHID',
                    "decodeFromTable": 'QUAD_NAMES A',
                    "desigColumn": "CONCAT(CONCAT(A.RHID,'-'),A.NOME_REDZ)", 
                    "orderBy": "A.RHID", 
                    "class": "form-control complexList chosen",
                    "filter": {
                        "create": " AND (A.RHID) IN (SELECT F.RHID FROM QUAD_PEOPLE F WHERE F.ATIVO = 'S' AND F.EMPRESA = ':EMPRESA')", //On-New-Record
                        "edit": " AND (A.RHID) IN (SELECT F.RHID FROM QUAD_PEOPLE F WHERE F.ATIVO = 'S' AND F.EMPRESA = ':EMPRESA')", //On-Edit-Record
                    }                          
                },
/* IGUAL A GF_CURSOS
* ------------------                    
>/DG_TIPOS_ENTIDADES
CD_ENT, 
CD_TIPO_ENT, 
DT_INI_TIPO_ENT, 
DT_INI_TE,
*/
                "DSP_SIT": {
                    "dependent-group": "SITUACAO",
                    "dependent-level": 1,
                    "name": "DSP_SIT",                        
                    "data-db-name": "A.ID_SITUACAO@A.DT_INI_SIT@A.TP_SITUACAO",
                    "decodeFromTable": 'GF_SITUACOES A',
                    "desigColumn": "A.DSP_SIT", 
                    "whereClause": "AND A.TP_SITUACAO = 'A'", //Estado: 'A' :: Ação/Sessão
                    "orderBy": "A.ID_SITUACAO",
                    "filter": {
                        "create": " AND A.DT_FIM_SIT IS NULL", //On-New-Record
                        "edit": " AND A.DT_FIM_SIT IS NULL", //On-Edit-Record
                    }  
                },
                "DSP_MOTIVO": {
                    "name": "DSP_MOTIVO",
                    "dependent-group": "CANCEL",
                    "dependent-level": 1,
                    "data-db-name": 'A.ID_MOTIVO@A.TP_MOTIVO@A.DT_INI_MOTIVO',
                    "decodeFromTable": 'GF_MOTIVOS A',
                    "desigColumn": "A.DSP_MOTIVO",
                    "whereClause": "AND A.TP_MOTIVO = 'A'", //Estado: 'A' :: Cancelamento [B]-Subst. Formador
                    'orderBy': 'A.ID_MOTIVO',
                    "class": "form-control complexList chosen",
                    "filter": {
                        "create": " AND A.DT_FIM_MOTIVO IS NULL", //On-New-Record
                        "edit": " AND A.DT_FIM_MOTIVO IS NULL", //On-Edit-Record
                    }
                },       
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
                "DSP_HOR_DIA": {
                    "name": "DSP_HOR_DIA",
                    "dependent-group": "HORARIO",
                    "dependent-level": 1,
                    "data-db-name": 'A.CD_HOR_DIA',
                    "decodeFromTable": 'RH_DEF_HORARIO_DIAS A',
                    "desigColumn": "A.DSR_HOR_DIA",
                    'orderBy': 'A.CD_HOR_DIA',
                    "class": "form-control complexList chosen",
                    "filter": {
                        "create": " AND A.ACTIVO = 'S'", //On-New-Record
                        "edit": " AND A.ACTIVO = 'S'", //On-Edit-Record
                    }
                },
                "DSP_GRP_CONTAB": {
                    "name": "DSP_GRP_CONTAB",
                    "dependent-group": "GRP_CONTAB",
                    "dependent-level": 1,
                    "data-db-name": 'A.CD_GRP_CONTAB',
                    "decodeFromTable": 'DG_DEF_GRUPOS_CONTABILISTICOS A',
                    "desigColumn": "A.DSP_GRP_CONTAB",
                    'orderBy': 'A.CD_GRP_CONTAB',
                    "class": "form-control complexList chosen",
                }
            },
            validations: {
                rules: {
                    NR_MIN_PARTICIPANTES: {
                        integer: true
                    },
                    NR_MAX_PARTICIPANTES: {
                        integer: true
                    },
                    PCT_APROVACAO: {
                        number: true
                    },
                }
            }
        };
        GF_ACOES_CONTINUED = new QuadForm();
        GF_ACOES_CONTINUED.initForm($.extend({}, datatable_instance_defaults, optionsGF_ACOES_CONTINUED));

        if (1 === 1) {
            /* QUADFORMS :: DOUBLE-CLICK -> EDIT RECORD */
            $('#GF_ACOES_CONTINUED').dblclick(function() {
                var el = $("#GF_ACOES_CONTINUED").find("[data-form-action='edit']");  
                if (el.css('display') !== 'none' && (el.attr('disabled') === undefined || el.attr('disabled') === false) ) { //SÓ SE O BOTÃO ESTIVER VISÍVEL e ENABLED
                    el.trigger('click');
                }
            });
        }
        //END Actions Continued

        //Actions Trads
        var optionsGF_ACAO_TRADS = {
            "tableId": "GF_ACAO_TRADS",
            "table": "GF_ACAO_TRADS",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_PLANO_FORM": {"type": "number"},
                    "DT_INI_PLANO_FORM": {"type": "date"},
                    "ID_CURSO": {"type": "number"},
                    "TP_REGISTO": {"type": "varchar"},
                    "DT_INI_CURSO": {"type": "date"},
                    "ID_ACAO": {"type": "number"},
                    "DT_INI_ACAO": {"type": "date"},
                    "CD_LINGUA": {"type": "number"},
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "GF_ACOES": {
                    "EMPRESA": "EMPRESA",
                    "ID_PLANO_FORM": "ID_PLANO_FORM",
                    "DT_INI_PLANO_FORM": "DT_INI_PLANO_FORM",
                    "ID_CURSO": "ID_CURSO",
                    "TP_REGISTO": "TP_REGISTO",
                    "DT_INI_CURSO": "DT_INI_CURSO",
                    "ID_ACAO": "ID_ACAO",
                    "DT_INI_ACAO": "DT_INI_ACAO"
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
                    "data": 'ID_PLANO_FORM',
                    "name": 'ID_PLANO_FORM',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_PLANO_FORM',
                    "name": 'DT_INI_PLANO_FORM',
                    "datatype": 'date',
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
                    "data": 'ID_ACAO',
                    "name": 'ID_ACAO',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_ACAO',
                    "name": 'DT_INI_ACAO',
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
                        return GF_ACAO_TRADS.crudButtons(true, true, true);
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
        GF_ACAO_TRADS = new QuadTable();
        GF_ACAO_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsGF_ACAO_TRADS));
        //END Actions Trads

        //Interactions
        var optionsGF_INTERACOES = {
            "tableId": "GF_INTERACOES",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_interaction; ?>",
            "table": "GF_INTERACOES",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_PLANO_FORM": {"type": "number"},
                    "DT_INI_PLANO_FORM": {"type": "date"},
                    "ID_CURSO": {"type": "number"},
                    "TP_REGISTO": {"type": "varchar"},
                    "DT_INI_CURSO": {"type": "date"},
                    "ID_ACAO": {"type": "number"},
                    "DT_INI_ACAO": {"type": "date"},
                    "ID_INTERACAO": {"type": "number"}
                }
            },
            "dependsOn": {
                "GF_ACOES": {
                    "EMPRESA": "EMPRESA",
                    "ID_PLANO_FORM": "ID_PLANO_FORM",
                    "DT_INI_PLANO_FORM": "DT_INI_PLANO_FORM",
                    "ID_CURSO": "ID_CURSO",
                    "TP_REGISTO": "TP_REGISTO",
                    "DT_INI_CURSO": "DT_INI_CURSO",
                    "ID_ACAO": "ID_ACAO",
                    "DT_INI_ACAO": "DT_INI_ACAO"
                }
            },                
            "crudOnMasterInactive": {
                "condition": "data.DT_INI_ACAO === null", //PTE:: A fazer função que devolva S ou N, com base na situação da Ação
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },
            "detailsObjects": ['GF_INTERACAO_TRADS'],        
            "order_by": "ID_INTERACAO ASC",
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
                    "data": 'ID_PLANO_FORM',
                    "name": 'ID_PLANO_FORM',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_PLANO_FORM',
                    "name": 'DT_INI_PLANO_FORM',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_VERSAO',
                    "name": 'ID_VERSAO',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_VERSAO',
                    "name": 'DT_INI_VERSAO',
                    "datatype": 'date',     
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
                    "data": 'ID_ACAO',
                    "name": 'ID_ACAO',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_ACAO',
                    "name": 'DT_INI_ACAO',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'ID_INTERACAO',
                    "name": 'ID_INTERACAO',
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DSP_INTERACAO',
                    "name": 'DSP_INTERACAO',                    
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_INTERACAO',
                    "name": 'DSR_INTERACAO',
                    "className": "visibleColumn",
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_SITUACAO',
                    "name": 'ID_SITUACAO',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_SIT',
                    "name": 'DT_INI_SIT',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'TP_SITUACAO',
                    "name": 'TP_SITUACAO',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 5, 
                    "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                    "title": "<?php echo mb_strtoupper($ui_measure_type, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_measure_type; ?>",
                    "data": 'DSP_MEDIDA',
                    "name": 'DSP_MEDIDA',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "TIPO_MEDIDA",
                        "dependent-level": 1,
                        "data-db-name": "A.ID_SITUACAO@A.DT_INI_SIT@A.TP_SITUACAO",
                        "decodeFromTable": 'GF_SITUACOES A',
                        "desigColumn": "A.DSP_SIT", 
                        "whereClause": "AND A.TP_SITUACAO = 'D'", //Estado: 'D', Medida: 'E'
                        "orderBy": "A.ID_SITUACAO",
                        "class": "form-control complexList chosen",
                        //"disabled": true, //Permite inibir o campo no Editor
                        "filter": {
                            "create": " AND A.DT_FIM_SIT IS NULL", //On-New-Record
                            "edit": " AND A.DT_FIM_SIT IS NULL", //On-Edit-Record
                        }                
                    }
                }, {
                    "responsivePriority": 6,
                    "title": "<?php echo mb_strtoupper($ui_measure_type_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_measure_type_date; ?>", //Editor
                    "data": 'DT_TP_MEDIDA',
                    "name": 'DT_TP_MEDIDA',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_SITUACAO_ESTADO',
                    "name": 'ID_SITUACAO_ESTADO',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_SIT_ESTADO',
                    "name": 'DT_INI_SIT_ESTADO',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'TP_SITUACAO_ESTADO',
                    "name": 'TP_SITUACAO_ESTADO',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 7, 
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
                        "distribute-value": "ID_SITUACAO_ESTADO@DT_INI_SIT_ESTADO@TP_SITUACAO_ESTADO",
                        "decodeFromTable": 'GF_SITUACOES A',
                        "desigColumn": "A.DSP_SIT", 
                        "whereClause": "AND A.TP_SITUACAO = 'D'", //Estado: 'D', Medida: 'E'
                        "orderBy": "A.ID_SITUACAO",
                        "class": "form-control complexList chosen",
                        //"disabled": true, //Permite inibir o campo no Editor
                        "filter": {
                            "create": " AND A.DT_FIM_SIT IS NULL", //On-New-Record
                            "edit": " AND A.DT_FIM_SIT IS NULL", //On-Edit-Record
                        }                
                    }
                }, {
                    "responsivePriority": 8,
                    "title": "<?php echo mb_strtoupper($ui_status_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_status_date; ?>", //Editor
                    "data": 'DT_ESTADO',
                    "name": 'DT_ESTADO',
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
                        return GF_INTERACOES.crudButtons(true,true,true);
                    }
                }
            ],
            validations: {
                rules: {
                    "ID_INTERACAO": {
                        required: true,
                    },
                    "DSP_INTERACAO": {
                        required: true,
                        maxlength: 80,
                    },
                    "DSR_INTERACAO": {
                        required: true,
                        maxlength: 25,
                    },
                    "DSP_MEDIDA": {
                        required: true,
                    },
                    "DSP_SITUACAO": {
                        required: true,
                    },
                    "DT_ESTADO": {
                        dateISO: true,
                    },
                    "DT_TP_MEDIDA": {
                        dateISO: true,
                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                }
            }
        };
        GF_INTERACOES = new QuadTable();
        GF_INTERACOES.initTable($.extend({}, datatable_instance_defaults, optionsGF_INTERACOES));          
        //END Interactions

        //Interactions Trads
        var optionsGF_INTERACAO_TRADS = {
            "tableId": "GF_INTERACAO_TRADS",
            "table": "GF_INTERACAO_TRADS",
            "pk": {
                "primary": {
                    "ID_INTERACAO": {"type": "number"},
                    "CD_LINGUA": {"type": "number"},
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "GF_INTERACOES": {
                    "ID_INTERACAO": "ID_INTERACAO"
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
                    "data": 'ID_INTERACAO',
                    "name": 'ID_INTERACAO',
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
                        return GF_ACAO_TRADS.crudButtons(true, true, true);
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
        GF_INTERACAO_TRADS = new QuadTable();
        GF_INTERACAO_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsGF_INTERACAO_TRADS));
        //END Interactions Trads

        //Targets
        var optionsGF_ALVO_ACOES = {
            "tableId": "GF_ALVO_ACOES",
            "table": "GF_ALVO_ACOES",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_PLANO_FORM": {"type": "number"},
                    "DT_INI_PLANO_FORM": {"type": "date"},
                    "ID_CURSO": {"type": "number"},
                    "TP_REGISTO": {"type": "varchar"},
                    "DT_INI_CURSO": {"type": "date"},
                    "ID_ACAO": {"type": "number"},
                    "DT_INI_ACAO": {"type": "date"},
                    "SEQ": {"type": "number"}
                }
            },
            "dependsOn": {
                "GF_ACOES": {
                    "EMPRESA": "EMPRESA",
                    "ID_PLANO_FORM": "ID_PLANO_FORM",
                    "DT_INI_PLANO_FORM": "DT_INI_PLANO_FORM",
                    "ID_CURSO": "ID_CURSO",
                    "TP_REGISTO": "TP_REGISTO",
                    "DT_INI_CURSO": "DT_INI_CURSO",
                    "ID_ACAO": "ID_ACAO",
                    "DT_INI_ACAO": "DT_INI_ACAO"
                } 
            },
            "order_by": "DT_INI_ACAO",
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
                    "title": "",
                    "label": "",
                    "data": 'SEQ',
                    "name": 'SEQ',
                    "datatype": 'sequence',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": false
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
                    "data": 'ID_PLANO_FORM',
                    "name": 'ID_PLANO_FORM',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_PLANO_FORM',
                    "name": 'DT_INI_PLANO_FORM',
                    "datatype": 'date',     
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
                    "data": 'ID_ACAO',
                    "name": 'ID_ACAO',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_ACAO',
                    "name": 'DT_INI_ACAO',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                        
                }, {
                    "responsivePriority": 3,                        
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_ALVO_ACAO',
                    "name": 'DT_INI_ALVO_ACAO',
                    "datatype": 'date',
                    "def": '1900-01-01',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "form-control datepicker"
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
                    "datatype": 'date',
                    "type": "hidden",
                    "visible": false
                }, {
                    "responsivePriority": 4, 
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
                    "datatype": 'date',
                    "type": "hidden",
                    "visible": false,
                }, {
                    "responsivePriority": 5, 
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
                    "datatype": 'date',
                    "type": "hidden",
                    "visible": false
                }, {
                    "responsivePriority": 6, 
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
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": "RHID",
                    "name": "RHID",
                    "type": "hidden",
                    "visible": false,
                    "className": ""
                }, {
                    "responsivePriority": 7,
                    "title": "<?php echo mb_strtoupper($ui_rhid, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_rhid; ?>",
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
                    "data": 'DT_FIM_ALVO_ACAO',
                    "name": 'DT_FIM_ALVO_ACAO',
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
                        return GF_ALVO_ACOES.crudButtons(true, true, true);
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
        GF_ALVO_ACOES = new QuadTable();
        GF_ALVO_ACOES.initTable($.extend({}, datatable_instance_defaults, optionsGF_ALVO_ACOES));
        //END Targets

        //Inscriptions
        var optionsGF_INSCRICOES = {
            "tableId": "GF_INSCRICOES",
            "table": "GF_INSCRICOES",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_PLANO_FORM": {"type": "number"},
                    "DT_INI_PLANO_FORM": {"type": "date"},
                    "ID_CURSO": {"type": "number"},
                    "TP_REGISTO": {"type": "varchar"},
                    "DT_INI_CURSO": {"type": "date"},
                    "ID_ACAO": {"type": "number"},
                    "DT_INI_ACAO": {"type": "date"},
                    "RHID": {"type": "number"},
                    "ID_INSCRICAO": {"type": "number"},
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "GF_ACOES": {
                    "EMPRESA": "EMPRESA",
                    "ID_PLANO_FORM": "ID_PLANO_FORM",
                    "DT_INI_PLANO_FORM": "DT_INI_PLANO_FORM",
                    "ID_CURSO": "ID_CURSO",
                    "TP_REGISTO": "TP_REGISTO",
                    "DT_INI_CURSO": "DT_INI_CURSO",
                    "ID_ACAO": "ID_ACAO",
                    "DT_INI_ACAO": "DT_INI_ACAO"
                } 
            },
            "order_by": "DT_INI_ACAO",
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
                    "data": 'ID_PLANO_FORM',
                    "name": 'ID_PLANO_FORM',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_PLANO_FORM',
                    "name": 'DT_INI_PLANO_FORM',
                    "datatype": 'date',     
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
                    "data": 'ID_ACAO',
                    "name": 'ID_ACAO',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_ACAO',
                    "name": 'DT_INI_ACAO',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables   
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_id, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_id; ?>",
                    "data": 'ID_INSCRICAO',
                    "name": 'ID_INSCRICAO',
                    "datatype": 'sequence',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": true,
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
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_rhid, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_rhid; ?>",
                    "data": 'NOME_REDZ',
                    "name": 'NOME_REDZ',
                    "type": "select",
                    "className": "visibleColumn",
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
                    "responsivePriority": 5,
                    "title": "<?php echo mb_strtoupper($ui_waiting_list_short, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_waiting_list_short; ?>",
                    "data": 'ID_LISTA_ESPERA',
                    "name": 'ID_LISTA_ESPERA',
                    "type": "hidden", 
                    "visible": true,
                    "className": "visibleColumn",     
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
                    "responsivePriority": 6,
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
                        "whereClause": "AND A.TP_SITUACAO = 'C'", //Estado: 'B' Listas Espera
                        "orderBy": "A.ID_SITUACAO",
                        "class": "form-control complexList chosen",
                        //"disabled": true, //Permite inibir o campo no Editor
                        "filter": {
                            "create": " AND A.DT_FIM_SIT IS NULL", //On-New-Record
                            "edit": " AND A.DT_FIM_SIT IS NULL", //On-Edit-Record
                        }                
                    } 
                }, {
                    "responsivePriority": 7,
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
                    "responsivePriority": 8,
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
                    "responsivePriority": 9,
                    "title": "<?php echo mb_strtoupper($ui_estimated_hours, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_estimated_hours; ?>",
                    "data": 'HORAS_PREVISTAS',
                    "name": 'HORAS_PREVISTAS',
                    "visible": true,
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 45px;"
                    }                        
                }, {
                    "responsivePriority": 10,
                    "title": "<?php echo mb_strtoupper($ui_accomplished_hours, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_accomplished_hours; ?>",
                    "data": 'HORAS_REALIZADAS',
                    "name": 'HORAS_REALIZADAS',
                    "visible": true,
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 45px;"
                    } 
                }, {
                    "responsivePriority": 11,
                    "title": "<?php echo mb_strtoupper($ui_achieved_percentage_short, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_achieved_percentage_short; ?>",
                    "data": 'PERC_REALIZADAS',
                    "name": '',
                    "defaultContent": '',
                    "visible": true,
                    "className": "visibleColumn right",
                    "render": function (val, type, row) {
                        return percentage (row['HORAS_REALIZADAS'], row['HORAS_PREVISTAS'], 2);
                    }  
               }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": "ID_TP_CERTIFICADO",
                    "name": "ID_TP_CERTIFICADO",
                    "type": "hidden",
                    "visible": false,
                    "className": ""
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": "DT_INI_TC",
                    "name": "DT_INI_TC",
                    "datatype": "date",
                    "type": "hidden",
                    "visible": false,
                    "className": ""
                }, {
                    "responsivePriority": 12,
                    "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                    "title": "<?php echo mb_strtoupper($ui_certificate_type, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_certificate_type; ?>",
                    "data": 'DSP_TP_CERTIF',
                    "name": 'DSP_TP_CERTIF',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "TP_CERTIF",
                        "dependent-level": 1,
                        "data-db-name": 'A.ID_TP_CERTIFICADO@A.DT_INI_TC',
                        //"distribute-value": "",
                        "decodeFromTable": 'GF_TP_CERTIFICADOS A',
                        "desigColumn": "A.DSP_TP_CERTIF", 
                        "whereClause": "",
                        "orderBy": "A.ID_TP_CERTIFICADO",
                        "class": "form-control complexList chosen",
                        //"disabled": true, //Permite inibir o campo no Editor
                        "filter": {
                            "create": " AND A.DT_FIM_TC IS NULL", //On-New-Record
                            "edit": " AND A.DT_FIM_TC IS NULL", //On-Edit-Record
                        }                
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
                    "responsivePriority": 13,
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
                    "className": "visibleColumn",
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_NV_ESCALA',
                    "name": 'DT_INI_NV_ESCALA',
                    "datatype": 'date',     
                    "type": "hidden",
                    "visible": false,
                    "className": "",
                }, {              
                    "responsivePriority": 14,
                    "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                    "title": "<?php echo mb_strtoupper($ui_assessment_final, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_assessment_final; ?>",
                    "fieldInfo": "<?php echo $hint_final_assesssement_given; ?>",
                    "data": 'DSR_NEP_AF',
                    "name": 'DSR_NEP_AF',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "dependent-group": "PROFICIENCIA",
                        "dependent-level": 2,
                        "data-db-name": 'A.EMPRESA@A.ID_EP@A.DT_INI_EP@A.ID_NV_ESCALA@A.DT_INI_NV_ESCALA',
                        "distribute-value": "EMPRESA@ID_EP@DT_INI_EP@ID_NV_ESCALA@DT_INI_NV_ESCALA",
                        "decodeFromTable": 'RH_NIVEIS_ESCALA_PROFICIENCIA A',
                        "desigColumn": "A.DSR_NEP", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.                        
                        "orderBy": "NVL(A.NR_ORD, A.ID_NV_ESCALA)", //usado no complexList.php
                        "class": "form-control complexList chosen",
                        "disabled": true
                    } 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": "ID_MOTIVO",
                    "name": "ID_MOTIVO",
                    "type": "hidden",
                    "visible": false,
                    "className": ""
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": "DT_INI_MOTIVO",
                    "name": "DT_INI_MOTIVO",
                    "datatype": "date",
                    "type": "hidden",
                    "visible": false,
                    "className": ""
                }, {
                    "responsivePriority": 15,
                    "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                    "title": "<?php echo mb_strtoupper($ui_cancellation_reason, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_cancellation_reason; ?>",
                    "data": 'DSP_MOTIVO',
                    "name": 'DSP_MOTIVO',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "CANCEL",
                        "dependent-level": 1,
                        "data-db-name": 'A.ID_MOTIVO@A.TP_MOTIVO@A.DT_INI_MOTIVO',
                        //"distribute-value": "",
                        "decodeFromTable": 'GF_MOTIVOS A',
                        "desigColumn": "A.DSP_MOTIVO", 
                        "whereClause": "AND A.TP_MOTIVO = 'A'", //Estado: 'A' :: Cancelamento [B]-Subst. Formador
                        "orderBy": "A.ID_MOTIVO",
                        "class": "form-control complexList chosen",
                        //"disabled": true, //Permite inibir o campo no Editor
                        "filter": {
                            "create": " AND A.DT_FIM_MOTIVO IS NULL", //On-New-Record
                            "edit": " AND A.DT_FIM_MOTIVO IS NULL", //On-Edit-Record
                        }                
                    }
                }, {
                    "responsivePriority": 16,
                    "title": "<?php echo mb_strtoupper($ui_cancel_dt, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_cancel_dt; ?>", //Editor
                    "data": 'DT_CANCELAMENTO',
                    "name": 'DT_CANCELAMENTO',
                    "datatype": 'date',                        
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
                        return GF_INSCRICOES.crudButtons(true, true, true);
                    }
                }
            ],
            validations: {
                rules: {
                    ID_AC: {
                        required: true,
                        integer: true,
                    },
                    DT_INI: {
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
        GF_INSCRICOES = new QuadTable();
        GF_INSCRICOES.initTable($.extend({}, datatable_instance_defaults, optionsGF_INSCRICOES));
        //END Inscriptions

        //Logistics Costs
        var optionsGF_CUSTO_EQPMS_LOCAIS = {
            "tableId": "GF_CUSTO_EQPMS_LOCAIS",
            "table": "GF_CUSTO_EQPMS_LOCAIS",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_PLANO_FORM": {"type": "number"},
                    "DT_INI_PLANO_FORM": {"type": "date"},
                    "ID_CURSO": {"type": "number"},
                    "TP_REGISTO": {"type": "varchar"},
                    "DT_INI_CURSO": {"type": "date"},
                    "ID_ACAO": {"type": "number"},
                    "DT_INI_ACAO": {"type": "date"},                        
                    "ID_FAMILIA_CUSTO": {"type": "number"},
                    "DT_INI_FAMILIA_CUSTO": {"type": "date"},
                    "ID_TP_CUSTO": {"type": "number"},
                    "DT_INI_TP_CUSTO": {"type": "date"},                        
                    "ID_CUSTO": {"type": "number"},
                    "DT_INI_CUSTO": {"type": "date"}
                }
            },
            "dependsOn": {
                "GF_ACOES": {
                    "EMPRESA": "EMPRESA",
                    "ID_PLANO_FORM": "ID_PLANO_FORM",
                    "DT_INI_PLANO_FORM": "DT_INI_PLANO_FORM",
                    "ID_CURSO": "ID_CURSO",
                    "TP_REGISTO": "TP_REGISTO",
                    "DT_INI_CURSO": "DT_INI_CURSO",
                    "ID_ACAO": "ID_ACAO",
                    "DT_INI_ACAO": "DT_INI_ACAO"
                } 
            },
            "order_by": "ID_CUSTO, DT_INI_CUSTO",
            "recordBundle": 4,
            "pageLenght": 4,
            "scrollY": "117",
            "preDrawCallback": function (settings) {
                $("#tsRow-GF_CUSTO_EQPMS_LOCAIS").removeClass("templateEditor"); //Antes de desenhar a tabela, remove o display: none;
            },
            "footerCallback": function (settings) {
                DrawTablesFooter (GF_CUSTO_EQPMS_LOCAIS, //Instância
                            4, //First colspan (nr. of columns) to apply on footer ROW. Use Header as reference, and start counting with 1 until last column to include.
                            [{idx:4, name: "TOTAL_ESTIMADO"},{idx:5, name: "TOTAL_REAL"},{idx:6, name: "MEDIA_DESVIO"}], //Columns references to "totalize": [IDX] visible column index starting with 0 + [NAME] "db colmun name" on SQL statistics statement
                            ['select sum(VALOR_ESTIMADO) as TOTAL_ESTIMADO, sum(VALOR_REAL) as TOTAL_REAL, ROUND(sum(VALOR_REAL)/sum(VALOR_ESTIMADO)*100,2) as MEDIA_DESVIO from GF_CUSTO_EQPMS_LOCAIS'], //SQL statistics statement :: WHERE CLAUSE IS AUTOMATICALLY ADDED USING CURRENT INSTANCE WHERE CLAUSE
                            "<?php echo mb_strtoupper($ui_total, 'UTF-8'); ?>"); //Title
            },
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "className": "control toBottom toCenter hdrShow",
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
                    "data": 'ID_PLANO_FORM',
                    "name": 'ID_PLANO_FORM',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_PLANO_FORM',
                    "name": 'DT_INI_PLANO_FORM',
                    "datatype": 'date',     
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
                    "data": 'ID_ACAO',
                    "name": 'ID_ACAO',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_ACAO',
                    "name": 'DT_INI_ACAO',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables   
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_id, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_id; ?>",
                    "data": 'ID_CUSTO',
                    "name": 'ID_CUSTO',
                    "datatype": 'sequence',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": true,
                    "className": "visibleColumn hdrShow",                          
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
                    "responsivePriority": 3,
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
                            "edit": " AND A.AND DT_FIM_FAMILIA_CUSTO IS NULL", //On-Edit-Record
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
                    "responsivePriority": 4,
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
                    "responsivePriority": 5,
                    "title": "<?php echo mb_strtoupper($ui_expected_cost, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_expected_cost; ?>",
                    "data": 'VALOR_ESTIMADO',
                    "name": 'VALOR_ESTIMADO',
                    "visible": true,
                    "className": "visibleColumn right hdrShow",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 50%;"
                    }                        
                }, {
                    "responsivePriority": 5,
                    "title": "<?php echo mb_strtoupper($ui_real_cost, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_real_cost; ?>",
                    "data": 'VALOR_REAL',
                    "name": 'VALOR_REAL',
                    "visible": true,
                    "className": "visibleColumn right hdrShow",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 50%;"
                    } 
                }, {
                    "responsivePriority": 6,
                    "title": "<?php echo mb_strtoupper($ui_achieved_percentage_short, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_achieved_percentage_short; ?>",
                    "data": 'PERC_ORCAMENTADA',
                    "name": '',
                    "defaultContent": '',
                    "visible": true,
                    "className": "visibleColumn right hdrShow",
                    "render": function (val, type, row) {
                        return percentage (row['VALOR_REAL'], row['VALOR_ESTIMADO'], 2);
                    }
                }, {
                    "responsivePriority": 7,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_CUSTO',
                    "name": 'DT_INI_CUSTO',
                    "datatype": 'date',
                    "def": hoje(),
                    "className": "visibleColumn hdrShow",
                    "attr": {
                        "class": "form-control datepicker"
                    }
                }, {
                    "responsivePriority": 8,
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM_CUSTO',
                    "name": 'DT_FIM_CUSTO',
                    "datatype": 'date',
                    "className": "visibleColumn hdrShow",
                    "attr": {
                        "class": "datepicker"
                    }
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
                    "responsivePriority": 9,
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_equipment, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_equipment; ?>",
                    "data": 'DSP_EQUIPAMENTO',
                    "name": 'DSP_EQUIPAMENTO',
                    "type": "select",
                    "className": "visibleColumn hdrShow",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "EQUIPAMENTOS",
                        "dependent-level": 1,
                        "data-db-name": 'A.ID_EQUIPAMENTO@A.DT_INI_EQUIPAMENTO',
                        "otherValues": "DOMINIO('GF_EQUIPAMENTOS.CLASS_FORMACAO','A','')",
                        //"distribute-value": '',
                        "decodeFromTable": 'GF_EQUIPAMENTOS A',
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
                     "title": "", //Datatables
                     "label": "", //Editor
                     "data": 'ID_LOCAL',
                     "name": 'ID_LOCAL',                    
                     "type": "hidden", //Editor
                     "visible": false, //DataTables
                 }, {
                     "title": "", //Datatables
                     "label": "", //Editor
                     "data": 'DT_INI_LOCAL',
                     "name": 'DT_INI_LOCAL',
                     "datatype": 'date',     
                     "type": "hidden", //Editor
                     "visible": false, //DataTables
                 }, {
                     "responsivePriority": 9,
                     "complexList": true, 
                     "title": "<?php echo mb_strtoupper($ui_training_place, 'UTF-8'); ?>", //Datatables
                     "label": "<?php echo $ui_training_place; ?>", //Editor
                     "data": 'DSP_LOCAL',
                     "name": 'DSP_LOCAL',
                     "type": "select",                    
                     "className": "visibleColumn hdrShow", 
                     "renew": true,
                     //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                     "attr": {
                         "dependent-group": "LOCAIS",
                         "dependent-level": 1,
                         "data-db-name": "A.ID_LOCAL@A.DT_INI_LOCAL",
                         "decodeFromTable": "GF_LOCAIS_FORMACAO A",  //TO CHANGE ON QUAD-HCM
                         "desigColumn": "A.DSP_LOCAL", 
                         //"otherValues": "", //RETURNS data['OTHERVALUES']
                         "whereClause": "",
                         "orderBy": "A.DSP_LOCAL",
                         "class": "form-control complexList chosen",
                         "filter": {
                             "create": " AND A.DT_FIM_LOCAL IS NULL", //On-New-Record
                             "edit": " AND A.DT_FIM_LOCAL IS NULL", //On-Edit-Record
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
                    "className": "toBottom toCenter hdrShow",
                    "render": function () {
                        //debugger;
                        return GF_CUSTO_EQPMS_LOCAIS.crudButtons(true, true, true);
                    }
                }
            ],
            validations: {
                rules: {
                    "DSP_FAMILIA_CUSTO": {
                        required: true
                    },
                    "DSP_TP_CUSTO": {
                        required: true
                    },
                    "DT_INI_CUSTO": {
                        required: true,
                        dateISO: true,
                    },
                    "VALOR_ESTIMADO": {
                        number: true
                    },
                    "VALOR_REAL": {
                        number: true
                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                    "DT_FIM_CUSTO": {
                        dateISO: true,
                        dateEqOrNextThan: "DT_INI_CUSTO",
                    }
                },
                "messages": {
                    "DT_FIM_CUSTO": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        GF_CUSTO_EQPMS_LOCAIS = new QuadTable();
        GF_CUSTO_EQPMS_LOCAIS.initTable($.extend({}, datatable_instance_defaults, optionsGF_CUSTO_EQPMS_LOCAIS));
        //END Logistics Costs

        //People Costs
        var optionsGF_CUSTO_FORMADORES_FORMANDOS = {
            "tableId": "GF_CUSTO_FORMADORES_FORMANDOS",
            "table": "GF_CUSTO_FORMADORES_FORMANDOS",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_PLANO_FORM": {"type": "number"},
                    "DT_INI_PLANO_FORM": {"type": "date"},
                    "ID_CURSO": {"type": "number"},
                    "TP_REGISTO": {"type": "varchar"},
                    "DT_INI_CURSO": {"type": "date"},
                    "ID_ACAO": {"type": "number"},
                    "DT_INI_ACAO": {"type": "date"},                        
                    "ID_FAMILIA_CUSTO": {"type": "number"},
                    "DT_INI_FAMILIA_CUSTO": {"type": "date"},
                    "ID_TP_CUSTO": {"type": "number"},
                    "DT_INI_TP_CUSTO": {"type": "date"},                        
                    "ID_CUSTO": {"type": "number"},
                    "DT_INI_CUSTO": {"type": "date"}
                }
            },
            "dependsOn": {
                "GF_ACOES": {
                    "EMPRESA": "EMPRESA",
                    "ID_PLANO_FORM": "ID_PLANO_FORM",
                    "DT_INI_PLANO_FORM": "DT_INI_PLANO_FORM",
                    "ID_CURSO": "ID_CURSO",
                    "TP_REGISTO": "TP_REGISTO",
                    "DT_INI_CURSO": "DT_INI_CURSO",
                    "ID_ACAO": "ID_ACAO",
                    "DT_INI_ACAO": "DT_INI_ACAO"
                } 
            },
            "order_by": "ID_CUSTO, DT_INI_CUSTO",
            "recordBundle": 4,
            "pageLenght": 4,
            "scrollY": "117",
            "preDrawCallback": function (settings) {
                $("#tsRow-GF_CUSTO_FORMADORES_FORMANDOS").removeClass("templateEditor"); //Antes de desenhar a tabela, remove o display: none;
            },
            "footerCallback": function (settings) {
                DrawTablesFooter (GF_CUSTO_FORMADORES_FORMANDOS, //Instância
                            4, //First colspan (nr. of columns) to apply on footer ROW. Use Header as reference, and start counting with 1 until last column to include.
                            [{idx:4, name: "TOTAL_ESTIMADO"},{idx:5, name: "TOTAL_REAL"},{idx:6, name: "MEDIA_DESVIO"}], //Columns references to "totalize": [IDX] visible column index starting with 0 + [NAME] "db colmun name" on SQL statistics statement
                            ['select sum(VALOR_ESTIMADO) as TOTAL_ESTIMADO, sum(VALOR_REAL) as TOTAL_REAL, ROUND(sum(VALOR_REAL)/sum(VALOR_ESTIMADO)*100,2) as MEDIA_DESVIO from GF_CUSTO_FORMADORES_FORMANDOS'], //SQL statistics statement :: WHERE CLAUSE IS AUTOMATICALLY ADDED USING CURRENT INSTANCE WHERE CLAUSE
                            "<?php echo mb_strtoupper($ui_total, 'UTF-8'); ?>"); //Title
            },
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "className": "control toBottom toCenter hdrShow",
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
                    "data": 'ID_PLANO_FORM',
                    "name": 'ID_PLANO_FORM',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_PLANO_FORM',
                    "name": 'DT_INI_PLANO_FORM',
                    "datatype": 'date',     
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
                    "data": 'ID_ACAO',
                    "name": 'ID_ACAO',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_ACAO',
                    "name": 'DT_INI_ACAO',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables   
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_id, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_id; ?>",
                    "data": 'ID_CUSTO',
                    "name": 'ID_CUSTO',
                    "datatype": 'sequence',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": true,
                    "className": "visibleColumn hdrShow",                          
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
                    "responsivePriority": 3,
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
                    "responsivePriority": 4,
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
                    "responsivePriority": 5,
                    "title": "<?php echo mb_strtoupper($ui_expected_cost, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_expected_cost; ?>",
                    "data": 'VALOR_ESTIMADO',
                    "name": 'VALOR_ESTIMADO',
                    "visible": true,
                    "className": "visibleColumn right hdrShow",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 50%;"
                    }                        
                }, {
                    "responsivePriority": 5,
                    "title": "<?php echo mb_strtoupper($ui_real_cost, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_real_cost; ?>",
                    "data": 'VALOR_REAL',
                    "name": 'VALOR_REAL',
                    "visible": true,
                    "className": "visibleColumn right hdrShow",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 50%;"
                    } 
                }, {
                    "responsivePriority": 6,
                    "title": "<?php echo mb_strtoupper($ui_achieved_percentage_short, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_achieved_percentage_short; ?>",
                    "data": 'PERC_ORCAMENTADA',
                    "name": '',
                    "defaultContent": '',
                    "visible": true,
                    "className": "visibleColumn right hdrShow",
                    "render": function (val, type, row) {
                        return percentage (row['VALOR_REAL'], row['VALOR_ESTIMADO'], 2);
                    }
                }, {
                    "responsivePriority": 7,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_CUSTO',
                    "name": 'DT_INI_CUSTO',
                    "datatype": 'date',
                    "def": hoje(),
                    "className": "visibleColumn hdrShow",
                    "attr": {
                        "class": "form-control datepicker"
                    }
                }, {
                    "responsivePriority": 8,
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM_CUSTO',
                    "name": 'DT_FIM_CUSTO',
                    "datatype": 'date',
                    "className": "visibleColumn hdrShow",
                    "attr": {
                        "class": "datepicker"
                    }
//                    }, {
//                        "title": "", //Datatables
//                        "label": "", //Editor
//                        "data": 'ID_MEMBRO',
//                        "name": 'ID_MEMBRO',
//                        "type": "hidden", //Editor
//                        "visible": false, //DataTables
//                    }, {
//                        "title": "", //Datatables
//                        "label": "", //Editor
//                        "data": 'DT_INI_MEMBRO',
//                        "name": 'DT_INI_MEMBRO',
//                        "datatype": 'date',
//                        "type": "hidden", //Editor
//                        "visible": false, //DataTables                     
//                    }, {                    
//                        "responsivePriority": 8,
//                        "complexList": true,
//                        "title": "<?php echo mb_strtoupper($ui_trainer, 'UTF-8'); ?>",
//                        "label": "<?php echo $ui_trainer; ?>",
//                        "data": 'DSP_MEMBRO',
//                        "name": 'DSP_MEMBRO',
//                        "type": "select",
//                        "className": "visibleColumn hdrShow",
//                        "attr": {
//                            "dependent-group": "MEMBRO",
//                            "dependent-level": 1,
//                            "data-db-name": 'A.ID_MEMBRO@A.DT_INI_MEMBRO',
//                            "decodeFromTable": 'DG_MEMBRO A',
//                            "class": "form-control complexList chosen",
//                            "desigColumn": "A.DSR_NOME",
//                            "orderBy": "A.ID_MEMBRO",
//                            "filter": {
//                                "create": " AND A.ID_MEMBRO != NVL(':ID_MEMBRO_SUBS', '-9#9')", //On-New-Record
//                                "edit": " AND A.ID_MEMBRO != NVL(':ID_MEMBRO_SUBS', '-9#9')", //On-Edit-Record
//                            }
//                        }                           
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'RHID',
                    "name": 'RHID',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 9,
                    "title": "<?php echo mb_strtoupper($ui_rhid, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_rhid; ?>",
                    "data": 'NOME',
                    "name": 'NOME',
                    "type": "select",
                    "className": "visibleColumn hdrShow",
                    "complexList": true,
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                                        
                    "attr": {
                        "dependent-group": "COLABS",
                        "dependent-level": 1,
                        "deferred": true,
                        "data-db-name": 'A.EMPRESA@A.ID_PLANO_FORM@A.DT_INI_PLANO_FORM@A.ID_CURSO@A.TP_REGISTO@A.DT_INI_CURSO@A.ID_ACAO@A.DT_INI_ACAO@A.RHID',
                        "distribute-value": 'EMPRESA@ID_PLANO_FORM@DT_INI_PLANO_FORM@ID_CURSO@TP_REGISTO@DT_INI_CURSO@ID_ACAO@DT_INI_ACAO@RHID',
                        "decodeFromTable": 'GF_FORMANDOS_SESSAO A',
                        "desigColumn": "CONCAT(CONCAT(A.RHID,'-'),A.NOME)", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.                        
                        "orderBy": "A.RHID",
                        "class": "form-control complexList chosen",
                        //"disabled": true, //Permite inibir o campo no Editor
                        "filter": {
                            "create": " AND A.EMPRESA = ':EMPRESA' AND A.ID_PLANO_FORM = ':ID_PLANO_FORM' AND TO_CHAR(A.DT_INI_PLANO_FORM,'YYYY-MM-DD') = ':DT_INI_PLANO_FORM' AND A.ID_CURSO = ':ID_CURSO' AND A.TP_CURSO = ':TP_CURSO' AND TO_CHAR(A.DT_INI_CURSO,'YYYY-MM-DD') = ':DT_INI_CURSO' AND A.ID_ACAO = ':ID_ACAO' AND TO_CHAR(A.DT_INI_ACAO,'YYYY-MM-DD') = ':DT_INI_ACAO'", //On-New-Record
                            "edit": " AND A.EMPRESA = ':EMPRESA' AND A.ID_PLANO_FORM = ':ID_PLANO_FORM' AND TO_CHAR(A.DT_INI_PLANO_FORM,'YYYY-MM-DD') = ':DT_INI_PLANO_FORM' AND A.ID_CURSO = ':ID_CURSO' AND A.TP_CURSO = ':TP_CURSO' AND TO_CHAR(A.DT_INI_CURSO,'YYYY-MM-DD') = ':DT_INI_CURSO' AND A.ID_ACAO = ':ID_ACAO' AND TO_CHAR(A.DT_INI_ACAO,'YYYY-MM-DD') = ':DT_INI_ACAO'", //On-Edit-Record
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
                    "className": "toBottom toCenter hdrShow",
                    "render": function () {
                        //debugger;
                        return GF_CUSTO_FORMADORES_FORMANDOS.crudButtons(true, true, true);
                    }
                }
            ],
            validations: {
                rules: {
                    "DSP_FAMILIA_CUSTO": {
                        required: true
                    },
                    "DSP_TP_CUSTO": {
                        required: true
                    },
                    "DT_INI_CUSTO": {
                        required: true,
                        dateISO: true,
                    },
                    "VALOR_ESTIMADO": {
                        number: true
                    },
                    "VALOR_REAL": {
                        number: true
                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                    "DT_FIM_CUSTO": {
                        dateISO: true,
                        dateEqOrNextThan: "DT_INI_CUSTO",
                    }
                },
                "messages": {
                    "DT_FIM_CUSTO": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        GF_CUSTO_FORMADORES_FORMANDOS = new QuadTable();
        GF_CUSTO_FORMADORES_FORMANDOS.initTable($.extend({}, datatable_instance_defaults, optionsGF_CUSTO_FORMADORES_FORMANDOS));
        //END People Costs

        //Sessions
        var optionsGF_SESSOES = {
            "tableId": "GF_SESSOES",
            "table": "GF_SESSOES",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_session; ?>",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_PLANO_FORM": {"type": "number"},
                    "DT_INI_PLANO_FORM": {"type": "date"},
                    "ID_CURSO": {"type": "number"},
                    "TP_CURSO": {"type": "varchar"},
                    "DT_INI_CURSO": {"type": "date"},
                    "ID_ACAO": {"type": "number"},
                    "DT_INI_ACAO": {"type": "date"},
                    "ID_SESSAO": {"type": "number"}
                }
            },
            "dependsOn": {
                "GF_ACOES": {
                    "EMPRESA": "EMPRESA",
                    "ID_PLANO_FORM": "ID_PLANO_FORM",
                    "DT_INI_PLANO_FORM": "DT_INI_PLANO_FORM",
                    "ID_CURSO": "ID_CURSO",
                    "TP_CURSO": "TP_REGISTO",
                    "DT_INI_CURSO": "DT_INI_CURSO",
                    "ID_ACAO": "ID_ACAO",
                    "DT_INI_ACAO": "DT_INI_ACAO"
                } 
            },
            "order_by": "DT_INI_ACAO",
            "scrollY": "156",
            "recordBundle": 6,
            "pageLenght": 6,
            "detailsObjects": ['GF_SESSAO_TRADS','GF_SESSOES_EQUIPAMENTOS','GF_AGENDAS','GF_SESSAO_PRESENCAS'],
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
                    "data": 'ID_PLANO_FORM',
                    "name": 'ID_PLANO_FORM',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_PLANO_FORM',
                    "name": 'DT_INI_PLANO_FORM',
                    "datatype": 'date',     
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
                    "data": 'ID_ACAO',
                    "name": 'ID_ACAO',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_ACAO',
                    "name": 'DT_INI_ACAO',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables   
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_id, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_id; ?>",
                    "data": 'ID_SESSAO',
                    "name": 'ID_SESSAO',
                    "datatype": 'sequence',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": true,
                    "className": "visibleColumn", 
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DSP_SESSAO',
                    "name": 'DSP_SESSAO',
                    "className": "visibleColumn",
                }, {
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_SESSAO',
                    "name": 'DSR_SESSAO',
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_SESSAO',
                    "name": 'DT_INI_SESSAO',
                    "datatype": 'date',
                    "def": hoje(),
                    "className": "visibleColumn",
                    "attr": {
                        "class": "form-control datepicker"
                    }
                }, {
                    "responsivePriority": 6,
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM_SESSAO',
                    "name": 'DT_FIM_SESSAO',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker"
                    }   
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_LOCAL',
                    "name": 'ID_LOCAL',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_LOCAL',
                    "name": 'DT_INI_LOCAL',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 5,
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_training_place, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_training_place; ?>", //Editor
                    "data": 'DSP_LOCAL',
                    "name": 'DSP_LOCAL',
                    "type": "select",                    
                    "className": "visibleColumn", 
                    "renew": true,
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "LOCAIS",
                        "dependent-level": 1,
                        "data-db-name": "A.ID_LOCAL@A.DT_INI_LOCAL",
                        "decodeFromTable": "GF_LOCAIS_FORMACAO A",  //TO CHANGE ON QUAD-HCM
                        "desigColumn": "A.DSP_LOCAL", 
                        //"otherValues": "", //RETURNS data['OTHERVALUES']
                        "whereClause": "",
                        "orderBy": "A.DSP_LOCAL",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.DT_FIM_LOCAL IS NULL", //On-New-Record
                            "edit": " AND A.DT_FIM_LOCAL IS NULL", //On-Edit-Record
                        }
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
                    "responsivePriority": 5,
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
                        "whereClause": "AND A.TP_SITUACAO = 'A'",
                        "orderBy": "A.ID_SITUACAO",
                        "class": "form-control complexList chosen",
                        //"disabled": true, //Permite inibir o campo no Editor
                        "filter": {
                            "create": " AND A.DT_FIM_SIT IS NULL", //On-New-Record
                            "edit": " AND A.DT_FIM_SIT IS NULL", //On-Edit-Record
                        }                
                    } 
//                    }, {
//                        "title": "", //Datatables
//                        "label": "", //Editor
//                        "data": "ID_MEMBRO",
//                        "name": "ID_MEMBRO",
//                        "type": "hidden",
//                        "visible": false,
//                        "className": ""
//                    }, {
//                        "title": "", //Datatables
//                        "label": "", //Editor
//                        "data": "DT_INI_MEMBRO",
//                        "name": "DT_INI_MEMBRO",
//                        "datatype": "date",
//                        "type": "hidden",
//                        "visible": false,
//                        "className": ""
//                    }, {
//                        "complexList": true, 
//                        "title": "<?php echo mb_strtoupper($ui_trainer, 'UTF-8'); ?>",
//                        "label": "<?php echo $ui_trainer; ?>",
//                        "data": 'DSP_MOTIVO',
//                        "name": 'DSP_MOTIVO',
//                        "type": "select",
//                        "className": "visibleColumn",
//                        //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
//                        "attr": {
//                            "dependent-group": "MEMBRO",
//                            "dependent-level": 1,
//                            "data-db-name": 'A.ID_MEMBRO@A.DT_INI_MEMBRO',
//                            //"distribute-value": "",
//                            "decodeFromTable": 'DG_MEMBRO A',
//                            "desigColumn": "A.DSR_NOME", 
//                            //"whereClause": "",
//                            "orderBy": "A.ID_MEMBRO",
//                            "class": "form-control complexList chosen",
//                            //"disabled": true, //Permite inibir o campo no Editor
//                            "filter": {
//                                "create": " AND A.DT_FIM_MEMBRO IS NULL", //On-New-Record
//                                "edit": " AND A.DT_FIM_MEMBRO IS NULL", //On-Edit-Record
//                            }                
//                        } 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": "ID_MOTIVO",
                    "name": "ID_MOTIVO",
                    "type": "hidden",
                    "visible": false,
                    "className": ""
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": "DT_INI_MOTIVO",
                    "name": "DT_INI_MOTIVO",
                    "datatype": "date",
                    "type": "hidden",
                    "visible": false,
                    "className": ""
                }, {
                    "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                    "title": "<?php echo mb_strtoupper($ui_cancellation_reason, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_cancellation_reason; ?>",
                    "data": 'DSP_MOTIVO',
                    "name": 'DSP_MOTIVO',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "CANCEL",
                        "dependent-level": 1,
                        "data-db-name": 'A.ID_MOTIVO@A.TP_MOTIVO@A.DT_INI_MOTIVO',
                        //"distribute-value": "",
                        "decodeFromTable": 'GF_MOTIVOS A',
                        "desigColumn": "A.DSP_MOTIVO", 
                        "whereClause": "AND A.TP_MOTIVO = 'A'", //Estado: 'A' :: Cancelamento [B]-Subst. Formador
                        "orderBy": "A.ID_MOTIVO",
                        "class": "form-control complexList chosen",
                        //"disabled": true, //Permite inibir o campo no Editor
                        "filter": {
                            "create": " AND A.DT_FIM_MOTIVO IS NULL", //On-New-Record
                            "edit": " AND A.DT_FIM_MOTIVO IS NULL", //On-Edit-Record
                        }                
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_cancel_dt, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_cancel_dt; ?>", //Editor
                    "data": 'DT_CANCELAMENTO',
                    "name": 'DT_CANCELAMENTO',
                    "datatype": 'date',                        
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
                        return GF_SESSOES.crudButtons(true, true, true);
                    }
                }
            ],
            validations: {
                rules: {
                    "ID_SESSAO": {
                        required: true,
                        integer: true,
                    },
                    "DT_INI_SESSAO": {
                        required: true,
                        dateISO: true,
                    },
                    "DSP_SESSAO": {
                        required: true,
                        maxlength: 240,
                    },
                    "DSR_SESSAO": {
                        required: true,
                        maxlength: 240,
                    },
                    "DSP_LOCAL": {
                        required: true
                    },
                    "DSP_SITUACAO": {
                        required: true
                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                    "DT_FIM_SESSAO": {
                        dateISO: true,
                        dateEqOrNextThan: "DT_INI_SESSAO",
                    }
                },
                "messages": {
                    "DT_FIM_SESSAO": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        GF_SESSOES = new QuadTable();
        GF_SESSOES.initTable($.extend({}, datatable_instance_defaults, optionsGF_SESSOES));
        //END Sessions

        //Session Trads
        var optionsGF_SESSAO_TRADS = {
            "tableId": "GF_SESSAO_TRADS",
            "table": "GF_SESSAO_TRADS",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_PLANO_FORM": {"type": "number"},
                    "DT_INI_PLANO_FORM": {"type": "date"},
                    "ID_CURSO": {"type": "number"},
                    "TP_CURSO": {"type": "varchar"},
                    "DT_INI_CURSO": {"type": "date"},
                    "ID_ACAO": {"type": "number"},
                    "DT_INI_ACAO": {"type": "date"},
                    "ID_SESSAO": {"type": "number"},
                    "CD_LINGUA": {"type": "number"},
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "GF_SESSOES": {
                    "EMPRESA": "EMPRESA",
                    "ID_PLANO_FORM": "ID_PLANO_FORM",
                    "DT_INI_PLANO_FORM": "DT_INI_PLANO_FORM",
                    "ID_CURSO": "ID_CURSO",
                    "TP_CURSO": "TP_CURSO",
                    "DT_INI_CURSO": "DT_INI_CURSO",
                    "ID_ACAO": "ID_ACAO",
                    "DT_INI_ACAO": "DT_INI_ACAO",
                    "ID_SESSAO": "ID_SESSAO"
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
                    "data": 'ID_PLANO_FORM',
                    "name": 'ID_PLANO_FORM',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_PLANO_FORM',
                    "name": 'DT_INI_PLANO_FORM',
                    "datatype": 'date',
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
                    "data": 'ID_ACAO',
                    "name": 'ID_ACAO',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_ACAO',
                    "name": 'DT_INI_ACAO',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_SESSAO',
                    "name": 'ID_SESSAO',
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
                        return GF_SESSAO_TRADS.crudButtons(true, true, true);
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
        GF_SESSAO_TRADS = new QuadTable();
        GF_SESSAO_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsGF_SESSAO_TRADS));            
        //END Session Trads

        //Session Equipments            
        var optionsGF_SESSOES_EQUIPAMENTOS = {
            "tableId": "GF_SESSOES_EQUIPAMENTOS",
            "table": "GF_SESSOES_EQUIPAMENTOS",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_PLANO_FORM": {"type": "number"},
                    "DT_INI_PLANO_FORM": {"type": "date"},
                    "ID_CURSO": {"type": "number"},
                    "TP_CURSO": {"type": "varchar"},
                    "DT_INI_CURSO": {"type": "date"},
                    "ID_ACAO": {"type": "number"},
                    "DT_INI_ACAO": {"type": "date"},
                    "ID_SESSAO": {"type": "number"},
                    "ID_EQUIPAMENTO": {"type": "number"},
                    "DT_INI_EQUIPAMENTO": {"type": "date"},
                    "DT_INI_ES": {"type": "date"}
                }
            },
            "dependsOn": {
                "GF_SESSOES": {
                    "EMPRESA": "EMPRESA",
                    "ID_PLANO_FORM": "ID_PLANO_FORM",
                    "DT_INI_PLANO_FORM": "DT_INI_PLANO_FORM",
                    "ID_CURSO": "ID_CURSO",
                    "TP_CURSO": "TP_CURSO",
                    "DT_INI_CURSO": "DT_INI_CURSO",
                    "ID_ACAO": "ID_ACAO",
                    "DT_INI_ACAO": "DT_INI_ACAO",
                    "ID_SESSAO": "ID_SESSAO"
                } 
            },
            "order_by": "ID_EQUIPAMENTO",
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
                    "data": 'ID_PLANO_FORM',
                    "name": 'ID_PLANO_FORM',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_PLANO_FORM',
                    "name": 'DT_INI_PLANO_FORM',
                    "datatype": 'date',
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
                    "data": 'ID_ACAO',
                    "name": 'ID_ACAO',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_ACAO',
                    "name": 'DT_INI_ACAO',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_SESSAO',
                    "name": 'ID_SESSAO',
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
                    "data": 'DSR_EQUIPAMENTO',
                    "name": 'DSR_EQUIPAMENTO',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "dependent-group": "EQUIPAMENTO",
                        "dependent-level": 1,
                        "data-db-name": 'A.ID_EQUIPAMENTO@A.DT_INI_EQUIPAMENTO',
                        "decodeFromTable": 'GF_EQUIPAMENTOS A',
                        "class": "form-control complexList chosen",
                        "desigColumn": "A.DSR_EQUIPAMENTO",
                        "orderBy": "A.ID_EQUIPAMENTO",
                        "filter": {
                            "create": " AND A.DT_FIM_EQUIPAMENTO IS NULL", //On-New-Record
                            "edit": " AND A.DT_FIM_EQUIPAMENTO IS NULL", //On-Edit-Record
                        }
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_units_number, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_units_number; ?>",
                    "data": 'NR_UNIDADES',
                    "name": 'NR_UNIDADES',
                    "visible": true,
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 45px;"
                    } 
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_ES',
                    "name": 'DT_INI_ES',
                    "datatype": 'date',
                    "def": hoje(),
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
                        "style": "max-width: 335px",
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM_ES',
                    "name": 'DT_FIM_ES',
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
                        return GF_SESSOES_EQUIPAMENTOS.crudButtons(true, true, true);
                    }
                }
            ],
            validations: {
                rules: {
                    DSR_EQUIPAMENTO: {
                        required: true,
                    },
                    DT_INI_ES: {
                        required: true,
                        dateISO: true,
                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                    "NR_UNIDADES": {
                        number: true,
                    },
                    "DT_FIM_ES": {
                        dateISO: true,
                        dateEqOrNextThan: "DT_INI_ES",
                    }
                },
                "messages": {
                    "DT_FIM_ES": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        GF_SESSOES_EQUIPAMENTOS = new QuadTable();
        GF_SESSOES_EQUIPAMENTOS.initTable($.extend({}, datatable_instance_defaults, optionsGF_SESSOES_EQUIPAMENTOS));  
        //END Session Equipments

        //Session Agenda            
        var optionsGF_AGENDAS = {
            "tableId": "GF_AGENDAS",                
            "table": "GF_AGENDAS",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_agenda; ?>",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_PLANO_FORM": {"type": "number"},
                    "DT_INI_PLANO_FORM": {"type": "date"},
                    "ID_CURSO": {"type": "number"},
                    "TP_CURSO": {"type": "varchar"},
                    "DT_INI_CURSO": {"type": "date"},
                    "ID_ACAO": {"type": "number"},
                    "DT_INI_ACAO": {"type": "date"},
                    "ID_SESSAO": {"type": "number"},
                    "DIA": {"type": "date"},
                    "HR_INICIO": {"type": "time24Minutes"}
                }
            },
            "dependsOn": {
                "GF_SESSOES": {
                    "EMPRESA": "EMPRESA",
                    "ID_PLANO_FORM": "ID_PLANO_FORM",
                    "DT_INI_PLANO_FORM": "DT_INI_PLANO_FORM",
                    "ID_CURSO": "ID_CURSO",
                    "TP_CURSO": "TP_CURSO",
                    "DT_INI_CURSO": "DT_INI_CURSO",
                    "ID_ACAO": "ID_ACAO",
                    "DT_INI_ACAO": "DT_INI_ACAO",
                    "ID_SESSAO": "ID_SESSAO"
                } 
            },
            "order_by": "DIA, HR_INICIO",
            "recordBundle": 4,
            "pageLenght": 4,
            "scrollY": "117",                
            "detailsObjects": ['GF_AGENDA_TRADS','GF_SUBSTITUICOES_FORMADORES'],
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
                    "data": 'ID_PLANO_FORM',
                    "name": 'ID_PLANO_FORM',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_PLANO_FORM',
                    "name": 'DT_INI_PLANO_FORM',
                    "datatype": 'date',
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
                    "data": 'ID_ACAO',
                    "name": 'ID_ACAO',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_ACAO',
                    "name": 'DT_INI_ACAO',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_SESSAO',
                    "name": 'ID_SESSAO',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_day, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_day; ?>",
                    "data": 'DIA',
                    "name": 'DIA',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker"
                    }
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_start_hr, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_start_hr; ?>",
                    "data": 'HR_INICIO',
                    "name": 'HR_INICIO',
                    "visible": true,
                    "datatype": "time24Minutes", //HH24:MI
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control dateTimePickerTimeFormatShort timeshort" //(.datepicker OR .dateTimePickerShort OR .dateTimePicker) AND (.minutes OR .seconds for CSS format width)
                    }
                }, {
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_end_hr, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_end_hr; ?>",
                    "data": 'HR_FIM',
                    "name": 'HR_FIM',
                    "visible": true,
                    "datatype": "time24Minutes", //HH24:MI
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control dateTimePickerTimeFormatShort timeshort" //(.datepicker OR .dateTimePickerShort OR .dateTimePicker) AND (.minutes OR .seconds for CSS format width)
                    }
                }, {
                    responsivePriority: 5,
                    "title": "<?php echo mb_strtoupper($ui_expected_duration, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_expected_duration; ?>",
                    "fieldInfo": "<?php echo $hint_time; ?>",
                    "data": 'DURACAO_PREV',
                    "name": 'DURACAO_PREV',
                    "datatype": "time24Minutes", //HH24:MI
                    "className": "right visibleColumn", //DATATABLES CONTROL
                    "attr": {//EDITOR CONTROL
                        "class": "toRight",
                        "style": "width: 25%;",
                    }
                }, {
                    "responsivePriority": 6,
                    "title": "<?php echo mb_strtoupper($ui_real_duration, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_real_duration; ?>",
                    "fieldInfo": "<?php echo $hint_minutes; ?>",
                    "data": 'DURACAO_REAL',
                    "name": 'DURACAO_REAL',
                    "datatype": "time24Minutes", //HH24:MI
                    "className": "right visibleColumn", //DATATABLES CONTROL
                    "attr": {//EDITOR CONTROL
                        "class": "toRight",
                        "style": "width: 25%;",
                        "disabled": true, //Permite inibir o campo no Editor
                    }   
                }, {
                     "title": "", //Datatables
                     "label": "", //Editor
                     "data": 'ID_LOCAL',
                     "name": 'ID_LOCAL',                    
                     "type": "hidden", //Editor
                     "visible": false, //DataTables
                 }, {
                     "title": "", //Datatables
                     "label": "", //Editor
                     "data": 'DT_INI_LOCAL',
                     "name": 'DT_INI_LOCAL',
                     "datatype": 'date',     
                     "type": "hidden", //Editor
                     "visible": false, //DataTables
                 }, {
                     "responsivePriority": 7,
                     "complexList": true, 
                     "title": "<?php echo mb_strtoupper($ui_training_place, 'UTF-8'); ?>", //Datatables
                     "label": "<?php echo $ui_training_place; ?>", //Editor
                     "data": 'DSP_LOCAL',
                     "name": 'DSP_LOCAL',
                     "type": "select",                    
                     "className": "visibleColumn", 
                     "renew": true,
                     //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                     "attr": {
                         "dependent-group": "LOCAIS",
                         "dependent-level": 1,
                         "data-db-name": "A.ID_LOCAL@A.DT_INI_LOCAL",
                         "decodeFromTable": "GF_LOCAIS_FORMACAO A",  //TO CHANGE ON QUAD-HCM
                         "desigColumn": "A.DSP_LOCAL", 
                         //"otherValues": "", //RETURNS data['OTHERVALUES']
                         "whereClause": "",
                         "orderBy": "A.DSP_LOCAL",
                         "class": "form-control complexList chosen",
                         "filter": {
                             "create": " AND A.DT_FIM_LOCAL IS NULL", //On-New-Record
                             "edit": " AND A.DT_FIM_LOCAL IS NULL", //On-Edit-Record
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
//                    }, {
//                        "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
//                        "label": "<?php echo $ui_end_date; ?>", //Editor
//                        "data": 'DT_FIM_ES',
//                        "name": 'DT_FIM_ES',
//                        "datatype": 'date',
//                        "className": "visibleColumn",
//                        "attr": {
//                            "class": "datepicker"
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
                        return GF_AGENDAS.crudButtons(true, true, true);
                    }
                }
            ],
            validations: {
                rules: {
                    DIA: {
                        required: true,
                        dateISO: true,
                    },
                    HR_INICIO: {
                        required: true,
                        time24Minutes: true,
                    },
                    HR_FIM: {
                        required: true,
                        time24Minutes: true,
                    },
                    DURACAO_PREV: {
                        required: false,
                        time24Minutes: true,
                    },
                    DURACAO_REAL: {
                        required: false,
                        time24Minutes: true,
                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    }
                },
                "messages": {
//                        "HR_INICIO": {
//                            time24Minutes: "<?php echo $error_end_dt_greater; ?>"
//                        }
                }
            }
        };
        GF_AGENDAS = new QuadTable();
        GF_AGENDAS.initTable($.extend({}, datatable_instance_defaults, optionsGF_AGENDAS));              
        //END Session Agenda

        //Agenda Trads
        var optionsGF_AGENDA_TRADS = {
            "tableId": "GF_AGENDA_TRADS",
            "table": "GF_AGENDA_TRADS",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_PLANO_FORM": {"type": "number"},
                    "DT_INI_PLANO_FORM": {"type": "date"},
                    "ID_CURSO": {"type": "number"},
                    "TP_CURSO": {"type": "varchar"},
                    "DT_INI_CURSO": {"type": "date"},
                    "ID_ACAO": {"type": "number"},
                    "DT_INI_ACAO": {"type": "date"},
                    "ID_SESSAO": {"type": "number"},
                    "DIA": {"type": "date"},
                    "HR_INICIO": {"type": "time24Minutes"},
                    "CD_LINGUA": {"type": "number"},
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "GF_AGENDAS": {
                    "EMPRESA": "EMPRESA",
                    "ID_PLANO_FORM": "ID_PLANO_FORM",
                    "DT_INI_PLANO_FORM": "DT_INI_PLANO_FORM",
                    "ID_CURSO": "ID_CURSO",
                    "TP_CURSO": "TP_CURSO",
                    "DT_INI_CURSO": "DT_INI_CURSO",
                    "ID_ACAO": "ID_ACAO",
                    "DT_INI_ACAO": "DT_INI_ACAO",
                    "ID_SESSAO": "ID_SESSAO",
                    "DIA": "DIA",
                    "HR_INICIO": "HR_INICIO"
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
                    "data": 'ID_PLANO_FORM',
                    "name": 'ID_PLANO_FORM',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_PLANO_FORM',
                    "name": 'DT_INI_PLANO_FORM',
                    "datatype": 'date',
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
                    "data": 'ID_ACAO',
                    "name": 'ID_ACAO',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_ACAO',
                    "name": 'DT_INI_ACAO',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_SESSAO',
                    "name": 'ID_SESSAO',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DIA',
                    "name": 'DIA',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'HR_INICIO',
                    "name": 'HR_INICIO',
                    "datatype": "time24Minutes",
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
                        return GF_AGENDA_TRADS.crudButtons(true, true, true);
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
        GF_AGENDA_TRADS = new QuadTable();
        GF_AGENDA_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsGF_AGENDA_TRADS));            
        //END Agenda Trads       

        //Trainers Substitution
        var optionsGF_SUBSTITUICOES_FORMADORES = {
            "tableId": "GF_SUBSTITUICOES_FORMADORES",
            "table": "GF_SUBSTITUICOES_FORMADORES",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_PLANO_FORM": {"type": "number"},
                    "DT_INI_PLANO_FORM": {"type": "date"},
                    "ID_CURSO": {"type": "number"},
                    "TP_REGISTO": {"type": "varchar"},
                    "DT_INI_CURSO": {"type": "date"},
                    "ID_ACAO": {"type": "number"},
                    "DT_INI_ACAO": {"type": "date"},
                    "ID_SESSAO": {"type": "number"},
                    "DIA": {"type": "date"},
                    "HR_INICIO": {"type": "time24Minutes"},
                    "CD_LINGUA": {"type": "number"},
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "GF_AGENDAS": {
                    "EMPRESA": "EMPRESA",
                    "ID_PLANO_FORM": "ID_PLANO_FORM",
                    "DT_INI_PLANO_FORM": "DT_INI_PLANO_FORM",
                    "ID_CURSO": "ID_CURSO",
                    "TP_REGISTO": "TP_CURSO",
                    "DT_INI_CURSO": "DT_INI_CURSO",
                    "ID_ACAO": "ID_ACAO",
                    "DT_INI_ACAO": "DT_INI_ACAO",
                    "ID_SESSAO": "ID_SESSAO",
                    "DIA": "DIA",
                    "HR_INICIO": "HR_INICIO"
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
                    "data": 'ID_PLANO_FORM',
                    "name": 'ID_PLANO_FORM',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_PLANO_FORM',
                    "name": 'DT_INI_PLANO_FORM',
                    "datatype": 'date',
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
                    "data": 'ID_ACAO',
                    "name": 'ID_ACAO',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_ACAO',
                    "name": 'DT_INI_ACAO',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_SESSAO',
                    "name": 'ID_SESSAO',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DIA',
                    "name": 'DIA',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'HR_INICIO',
                    "name": 'HR_INICIO',
                    "datatype": "time24Minutes",
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                        
//                    }, {
//                        "title": "", //Datatables
//                        "label": "", //Editor
//                        "data": 'ID_MEMBRO',
//                        "name": 'ID_MEMBRO',
//                        "type": "hidden", //Editor
//                        "visible": false, //DataTables
//                    }, {
//                        "title": "", //Datatables
//                        "label": "", //Editor
//                        "data": 'DT_INI_MEMBRO',
//                        "name": 'DT_INI_MEMBRO',
//                        "datatype": 'date',
//                        "type": "hidden", //Editor
//                        "visible": false, //DataTables                     
//                    }, {                    
//                        "responsivePriority": 2,
//                        "complexList": true,
//                        "title": "<?php echo mb_strtoupper($ui_trainer, 'UTF-8'); ?>",
//                        "label": "<?php echo $ui_trainer; ?>",
//                        "data": 'DSP_MEMBRO',
//                        "name": 'DSP_MEMBRO',
//                        "type": "select",
//                        "className": "visibleColumn",
//                        "attr": {
//                            "dependent-group": "MEMBRO",
//                            "dependent-level": 1,
//                            "deferred": true,
//                            "data-db-name": 'A.ID_MEMBRO@A.DT_INI_MEMBRO',
//                            "decodeFromTable": 'DG_MEMBRO A',
//                            "class": "form-control complexList chosen",
//                            "desigColumn": "A.DSR_NOME",
//                            "orderBy": "A.ID_MEMBRO",
//                            "filter": {
//                                "create": " AND A.ID_MEMBRO != NVL(':ID_MEMBRO_SUBS', '-9#9')", //On-New-Record
//                                "edit": " AND A.ID_MEMBRO != NVL(':ID_MEMBRO_SUBS', '-9#9')", //On-Edit-Record
//                            }
//                        }
//                   }, {
//                        "title": "", //Datatables
//                        "label": "", //Editor
//                        "data": 'ID_MEMBRO_SUBS',
//                        "name": 'ID_MEMBRO_SUBS',
//                        "type": "hidden", //Editor
//                        "visible": false, //DataTables
//                    }, {
//                        "title": "", //Datatables
//                        "label": "", //Editor
//                        "data": 'DT_INI_MEMBRO_SUBS',
//                        "name": 'DT_INI_MEMBRO_SUBS',
//                        "datatype": 'date',
//                        "type": "hidden", //Editor
//                        "visible": false, //DataTables                     
//                    }, {                    
//                        "responsivePriority": 3,
//                        "complexList": true,
//                        "title": "<?php echo mb_strtoupper($ui_substitute_trainer, 'UTF-8'); ?>",
//                        "label": "<?php echo $ui_substitute_trainer; ?>",
//                        "data": 'DSP_MEMBRO_SUBS',
//                        "name": 'DSP_MEMBRO_SUBS',
//                        "type": "select",
//                        "className": "visibleColumn",
//                        "attr": {
//                            "dependent-group": "MEMBRO_SUBS",
//                            "dependent-level": 1,
//                            "deferred": true,
//                            "data-db-name": 'A.ID_MEMBRO@A.DT_INI_MEMBRO',
//                            "distribute-value": 'ID_MEMBRO_SUBS@DT_INI_MEMBRO_SUBS',
//                            "decodeFromTable": 'DG_MEMBRO A',
//                            "class": "form-control complexList chosen",
//                            "desigColumn": "A.DSR_NOME",
//                            "orderBy": "A.ID_MEMBRO",
//                            "filter": {
//                                "create": " AND A.ID_MEMBRO != ':ID_MEMBRO'", //On-New-Record
//                                "edit": " AND A.ID_MEMBRO != ':ID_MEMBRO'", //On-Edit-Record
//                            }
//                        }                        
                }, {
                     "title": "", //Datatables
                     "label": "", //Editor
                     "data": "ID_MOTIVO",
                     "name": "ID_MOTIVO",
                     "type": "hidden",
                     "visible": false,
                     "className": ""
                 }, {
                     "title": "", //Datatables
                     "label": "", //Editor
                     "data": "DT_INI_MOTIVO",
                     "name": "DT_INI_MOTIVO",
                     "datatype": "date",
                     "type": "hidden",
                     "visible": false,
                     "className": ""
                 }, {
                     "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                     "title": "<?php echo mb_strtoupper($ui_cancellation_reason, 'UTF-8'); ?>",
                     "label": "<?php echo $ui_cancellation_reason; ?>",
                     "data": 'DSP_MOTIVO',
                     "name": 'DSP_MOTIVO',
                     "type": "select",
                     "className": "visibleColumn",
                     //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                     "attr": {
                         "dependent-group": "CANCEL",
                         "dependent-level": 1,
                         "data-db-name": 'A.ID_MOTIVO@A.TP_MOTIVO@A.DT_INI_MOTIVO',
                         //"distribute-value": "",
                         "decodeFromTable": 'GF_MOTIVOS A',
                         "desigColumn": "A.DSP_MOTIVO", 
                         "whereClause": "AND A.TP_MOTIVO = 'B'", //Estado: 'A' :: Cancelamento [B]-Subst. Formador
                         "orderBy": "A.ID_MOTIVO",
                         "class": "form-control complexList chosen",
                         //"disabled": true, //Permite inibir o campo no Editor
                         "filter": {
                             "create": " AND A.DT_FIM_MOTIVO IS NULL", //On-New-Record
                             "edit": " AND A.DT_FIM_MOTIVO IS NULL", //On-Edit-Record
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
                        return GF_SUBSTITUICOES_FORMADORES.crudButtons(true, true, true);
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
        GF_SUBSTITUICOES_FORMADORES = new QuadTable();
        GF_SUBSTITUICOES_FORMADORES.initTable($.extend({}, datatable_instance_defaults, optionsGF_SUBSTITUICOES_FORMADORES));            
        //END Trainers Substitution

        //Attendences            
        var optionsGF_SESSAO_PRESENCAS = {
            "tableId": "GF_SESSAO_PRESENCAS",
            "table": "GF_SESSAO_PRESENCAS",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_PLANO_FORM": {"type": "number"},
                    "DT_INI_PLANO_FORM": {"type": "date"},
                    "ID_CURSO": {"type": "number"},
                    "TP_CURSO": {"type": "varchar"},
                    "DT_INI_CURSO": {"type": "date"},
                    "ID_ACAO": {"type": "number"},
                    "DT_INI_ACAO": {"type": "date"},
                    "ID_SESSAO": {"type": "number"},
                    "RHID": {"type": "number"}
                }
            },
            "dependsOn": {
                "GF_SESSOES": {
                    "EMPRESA": "EMPRESA",
                    "ID_PLANO_FORM": "ID_PLANO_FORM",
                    "DT_INI_PLANO_FORM": "DT_INI_PLANO_FORM",
                    "ID_CURSO": "ID_CURSO",
                    "TP_CURSO": "TP_CURSO",
                    "DT_INI_CURSO": "DT_INI_CURSO",
                    "ID_ACAO": "ID_ACAO",
                    "DT_INI_ACAO": "DT_INI_ACAO",
                    "ID_SESSAO": "ID_SESSAO"
                } 
            },
            "order_by": "RHID",
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
                    "data": 'ID_PLANO_FORM',
                    "name": 'ID_PLANO_FORM',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_PLANO_FORM',
                    "name": 'DT_INI_PLANO_FORM',
                    "datatype": 'date',
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
                    "data": 'ID_ACAO',
                    "name": 'ID_ACAO',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_ACAO',
                    "name": 'DT_INI_ACAO',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_SESSAO',
                    "name": 'ID_SESSAO',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'RHID',
                    "name": 'RHID',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_rhid, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_rhid; ?>",
                    "data": 'NOME',
                    "name": 'NOME',
                    "type": "select",
                    "className": "visibleColumn",
                    "complexList": true,
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                                        
                    "attr": {
                        "dependent-group": "COLABS",
                        "dependent-level": 1,
                        "deferred": true,
                        "data-db-name": 'A.EMPRESA@A.ID_PLANO_FORM@A.DT_INI_PLANO_FORM@A.ID_CURSO@A.TP_CURSO@A.DT_INI_CURSO@A.ID_ACAO@A.DT_INI_ACAO@RHID',
                        "decodeFromTable": 'GF_FORMANDOS_SESSAO A',
                        "desigColumn": "CONCAT(CONCAT(A.RHID,'-'),A.NOME)", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.                        
                        "orderBy": "A.RHID",
                        "class": "form-control complexList chosen",
                        //"disabled": true, //Permite inibir o campo no Editor
                        "filter": {
                            "create": " AND A.EMPRESA = ':EMPRESA' AND A.ID_PLANO_FORM = ':ID_PLANO_FORM' AND TO_CHAR(A.DT_INI_PLANO_FORM,'YYYY-MM-DD') = ':DT_INI_PLANO_FORM' AND A.ID_CURSO = ':ID_CURSO' AND A.TP_CURSO = ':TP_CURSO' AND TO_CHAR(A.DT_INI_CURSO,'YYYY-MM-DD') = ':DT_INI_CURSO' AND A.ID_ACAO = ':ID_ACAO' AND TO_CHAR(A.DT_INI_ACAO,'YYYY-MM-DD') = ':DT_INI_ACAO'", //On-New-Record
                            "edit": " AND A.EMPRESA = ':EMPRESA' AND A.ID_PLANO_FORM = ':ID_PLANO_FORM' AND TO_CHAR(A.DT_INI_PLANO_FORM,'YYYY-MM-DD') = ':DT_INI_PLANO_FORM' AND A.ID_CURSO = ':ID_CURSO' AND A.TP_CURSO = ':TP_CURSO' AND TO_CHAR(A.DT_INI_CURSO,'YYYY-MM-DD') = ':DT_INI_CURSO' AND A.ID_ACAO = ':ID_ACAO' AND TO_CHAR(A.DT_INI_ACAO,'YYYY-MM-DD') = ':DT_INI_ACAO'", //On-Edit-Record
                        }
                    } 
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_present, 'UTF-8'); ?>" , //Datatables :: Original
                    "label": "<?php echo $ui_present; ?>", //Editor
                    //"fieldInfo": "<?php echo $hint_requires_previous_authorizarion; ?>",
                    "data": 'PRESENTE',
                    "name": 'PRESENTE',
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
                    "title": "<?php echo mb_strtoupper($ui_obs_short, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_obs_short; ?>", //Editor
                    "data": 'OBS',
                    "name": 'OBS',
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
                        return GF_SESSAO_PRESENCAS.crudButtons(true, true, true);
                    }
                }
            ],
            validations: {
                rules: {
                    "NOME": {
                        required: true
                    },
                    "OBS": {
                        required: false,
                        maxlength: 4000
                    },
                    "PRESENTE": {
                        required: true
                    }
                }
            }
        };
        GF_SESSAO_PRESENCAS = new QuadTable();
        GF_SESSAO_PRESENCAS.initTable($.extend({}, datatable_instance_defaults, optionsGF_SESSAO_PRESENCAS));  
        //END Attendences
    });
</script>
