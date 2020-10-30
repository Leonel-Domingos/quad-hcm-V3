<?php
    require_once '../init.php';
?>
<div class="row">
    <div class="col-xl-12">
        <div id="panel-11" class="panel">
            <div class="panel-hdr">
                <span class="widget-icon trads"> <i class="fal fa-clone"></i></span>&nbsp;
                <h2><?php echo $ui_company; ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <a id="DG_EMPRESAS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                    <table id="DG_EMPRESAS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
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
                            <a class="nav-link" data-toggle="tab" href="#Tab2" role="tab" aria-selected="true"><?php echo $ui_configurations; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab3" role="tab" aria-selected="true"><?php echo $ui_images; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab4" role="tab" aria-selected="true"><?php echo $ui_facilities; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab5" role="tab" aria-selected="true"><?php echo $ui_directions; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab6" role="tab" aria-selected="true"><?php echo $ui_internal_entities; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab7" role="tab" aria-selected="true"><?php echo $ui_structures; ?></a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="panel-container show">
                <div class="panel-content">

                    <div class="tab-content">

                         <!-- TAB #1 -->
                        <div class="tab-pane fade active show" id="Tab1" role="tabpanel">
                            <form action="" id="DG_EMPRESAS_CONTINUED" class="form-horizontal-standard" novalidate="novalidate">
                                <div class="quad-alert"></div>
                                <form-toolbar></form-toolbar>
                                <fieldset class="first-line">
                                    <div class="form-row">
                                        <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-3">
                                            <label for="CONSERVATORIA"><?php echo $ui_registry_office; ?></label>
                                            <input class="form-control" name="CONSERVATORIA">
                                        </div>

                                        <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-3">
                                            <label for="MATRICULA"><?php echo $ui_registration_number; ?></label>
                                            <input class="form-control" name="MATRICULA">
                                        </div>

                                        <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-3">
                                            <label for="DT_INI_ACTIVIDADE"><?php echo $ui_activity_begin_dt; ?></label>
                                            <input class="form-control datepicker" data-datatype="date"
                                                   name="DT_INI_ACTIVIDADE">
                                        </div>

                                        <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-3">
                                            <label for="DT_CONSTITUICAO"><?php echo $ui_establishment_dt; ?></label>
                                            <input class="form-control datepicker" data-datatype="date"
                                                   name="DT_CONSTITUICAO">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-3">
                                            <label for="NATUREZA_JURIDICA"><?php echo $ui_legal_nature; ?></label>
                                            <select class="form-control domainLists chosen"
                                                    name="NATUREZA_JURIDICA"></select>
                                        </div>

                                        <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-3">
                                            <label for="REPARTICAO_FISCAL"><?php echo $ui_tax_office; ?></label>
                                            <select class="form-control domainLists chosen"
                                                    name="REPARTICAO_FISCAL"></select>
                                        </div>

                                        <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-3">
                                            <label for="CAPITAL_SOCIAL"><?php echo $ui_capital_share; ?></label>
                                            <input class="form-control toRight" name="CAPITAL_SOCIAL">
                                        </div>

                                        <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-3">
                                            <table class="quad-inline">
                                                <thead>
                                                <tr>
                                                    <th colspan="3"><?php echo $ui_capital_distribution_perc; ?></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        <input class="form-control toRight" name="TX_NACIONAL"
                                                               style="width:50px;">
                                                    </td>
                                                    <td style="padding-left: 7px;">
                                                        <input class="form-control toRight" name="TX_ESTRANG"
                                                               style="width:50px;">
                                                    </td>
                                                    <td style="padding-left: 7px;">
                                                        <input class="form-control toRight" name="TX_PUBLICO"
                                                               style="width:50px;">
                                                    </td>
                                                <tr>
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th><?php echo $ui_public_equity; ?></th>
                                                    <th style="padding-left: 7px;"><?php echo $ui_foreign_equity; ?></th>
                                                    <th style="padding-left: 7px;"><?php echo $ui_public_equity; ?></th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-3">
                                            <label for="VOLUME_VENDAS"><?php echo $ui_sales_volume; ?></label>
                                            <input class="form-control" name="VOLUME_VENDAS">
                                        </div>

                                        <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-3">
                                            <label for="CD_CIRS"><?php echo $ui_cirs_code; ?></label>
                                            <input class="form-control" name="CD_CIRS">
                                        </div>
                                        <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-3">
                                            <label for="NIF_RL"><?php echo $ui_legal_representative_nif; ?></label>
                                            <input class="form-control" name="NIF_RL">
                                        </div>

                                        <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-3">
                                            <label for="NIF_TOC"><?php echo $ui_accountant_nif; ?></label>
                                            <input class="form-control" name="NIF_TOC">
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset class="first-line">
                                    <header class="frmInnerHeader"><?php echo $ui_employers_associations; ?></header>
                                    <div class="form-row">
                                        <div class="form-group col-xs-12 col-sm-12 col-md-4">
                                            <label for="ASSOCIACAO_1"><?php echo $ui_first; ?></label>
                                            <select class="form-control domainLists chosen"
                                                    name="ASSOCIACAO_1"></select>
                                        </div>
                                        <div class="form-group col-xs-12 col-sm-12 col-md-4">
                                            <label for="ASSOCIACAO_2"><?php echo $ui_second; ?></label>
                                            <select class="form-control domainLists chosen"
                                                    name="ASSOCIACAO_2"></select>
                                        </div>
                                        <div class="form-group col-xs-12 col-sm-12 col-md-4">
                                            <label for="ASSOCIACAO_3"><?php echo $ui_third; ?></label>
                                            <select class="form-control domainLists chosen"
                                                    name="ASSOCIACAO_3"></select>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset class="first-line">
                                    <header class="frmInnerHeader"><?php echo $ui_economic_activities; ?></header>
                                    <div class="form-row">
                                        <div class="form-group col-xs-12 col-sm-12 col-md-4">
                                            <label for="ACTIV_ECONOMICA_1"><?php echo $ui_main; ?></label>
                                            <select class="form-control domainLists chosen"
                                                    name="ACTIV_ECONOMICA_1"></select>
                                        </div>
                                        <div class="form-group col-xs-12 col-sm-12 col-md-4">
                                            <label for="ACTIV_ECONOMICA_1"><?php echo $ui_secondary; ?></label>
                                            <select class="form-control domainLists chosen"
                                                    name="ACTIV_ECONOMICA_1"></select>
                                        </div>
                                        <div class="form-group col-xs-12 col-sm-12 col-md-4">
                                            <label for="ACTIV_ECONOMICA_1"><?php echo $ui_secondary; ?></label>
                                            <select class="form-control domainLists chosen"
                                                    name="ACTIV_ECONOMICA_1"></select>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                         <!-- END TAB #1 -->

                         <!-- TAB #2 -->
                        <div class="tab-pane fade" id="Tab2" role="tabpanel">
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div id="panel-21" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="far fa-function"></i></span>&nbsp;
                                            <h2><?php echo $ui_operations; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <form action="" id="DG_DET_EMPRESA" class="form-horizontal-standard"
                                                      novalidate="novalidate">
                                                    <form-toolbar></form-toolbar>
                                                    <fieldset style="display:none;">
                                                        <div class="form-group">
                                                            <input class="form-control" type="text" name="PRODUTO" value="A">
                                                        </div>
                                                    </fieldset>
                                                    <fieldset class="first-line">
                                                        <header class="frmInnerHeader"><?php echo $ui_economic_activities; ?></header>
                                                        <div class="form-group col-xs-6 mr-4">
                                                            <label for="RH_PRG_DC"><?php echo $ui_program; ?></label>
                                                            <input class="form-control" name="RH_PRG_DC">
                                                        </div>

                                                        <div class="form-group col-xs-6">
                                                            <label for="RH_CADUCA_DC"><?php echo $ui_validity_implementation; ?></label>
                                                            <select class="form-control domainLists required"
                                                                    name="RH_CADUCA_DC"></select>
                                                        </div>
                                                    </fieldset>
                                                    <fieldset class="first-line mt-4">
                                                        <header class="frmInnerHeader"><?php echo $ui_integration_from_time_attendance_to; ?></header>
                                                        <div class="form-group col-xs-6">
                                                            <label for="RH_PRG_PONTO_AUSENCIAS"><?php echo $ui_absences; ?></label>
                                                            <input class="form-control"
                                                                   name="RH_PRG_PONTO_AUSENCIAS">
                                                        </div>

                                                        <div class="form-group col-xs-6">
                                                            <label for="RH_PRG_PONTO_TS"><?php echo $ui_overtime_work; ?></label>
                                                            <input class="form-control" name="RH_PRG_PONTO_TS">
                                                        </div>
                                                    </fieldset>
                                                    <fieldset class="first-line mt-4">
                                                        <header class="frmInnerHeader"><?php echo $ui_integration_to_pay_slip; ?></header>
                                                        <div class="form-group col-xs-6">
                                                            <label for="RH_PRG_AUSENCIAS_RECIBO"><?php echo $ui_absences; ?></label>
                                                            <select class="form-control domainLists"
                                                                    name="RH_PRG_AUSENCIAS_RECIBO"></select>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label for="RH_PRG_TS_RECIBO"><?php echo $ui_overtime_work; ?></label>
                                                            <input class="form-control" name="RH_PRG_TS_RECIBO">
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label for="RH_PRG_HV_RECIBO"><?php echo $ui_traveling_hours; ?></label>
                                                            <select class="form-control domainLists"
                                                                    name="RH_PRG_HV_RECIBO"></select>
                                                        </div>
                                                    </fieldset>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
<!--                            </div>-->

<!--                            <div class="row mt-4">-->
                                <div class="col-md-6">
                                    <div id="panel-22" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="far fa-list-ol"></i></span>&nbsp;
                                            <h2><?php echo $ui_docs_series; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="DG_SERIE_DOCUMENTOS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="DG_SERIE_DOCUMENTOS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                         <!-- END TAB #2 -->

                         <!-- TAB #3 -->
                        <div class="tab-pane fade" id="Tab3" role="tabpanel">
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-21" class="panel">
                                        <style>
                                            .chip:active, .z-depth-1 {
                                                -webkit-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, .16), 0 2px 10px 0 rgba(0, 0, 0, .12) !important;
                                                box-shadow: 0 2px 5px 0 rgba(0, 0, 0, .16), 0 2px 10px 0 rgba(0, 0, 0, .12) !important;
                                            }
                                        </style>
                                        <!-- <img src="img/superbox/superbox-full-9.jpg" id="target-3" alt="[Jcrop Example]" />-->
                                        <!--https://mdbootstrap.com/snippets/jquery/temp/351441?action=prism_export-->
                                        <!--Modal: Name :: GO PRO GOPRO MOVIE -->
                                        <div class="modal fade" id="modal1" tabindex="-1" role="dialog"
                                             aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">

                                                <!--Content-->
                                                <div class="modal-content">

                                                    <!--Body-->
                                                    <div class="modal-body mb-0 p-0">
                                                        <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
                                                            <iframe class="embed-responsive-item"
                                                                    src="https://www.youtube.com/embed/A3PDXmYoF5U"
                                                                    allowfullscreen
                                                                    style="width: 100%;height: 550px;"></iframe>
                                                        </div>
                                                    </div>

                                                    <!--Footer-->
                                                    <div class="modal-footer justify-content-center">
                                                        <span class="mr-4">Spread the word!</span>
                                                        <a type="button" class="btn-floating btn-sm btn-fb"><i
                                                                    class="fab fa-facebook-f"></i></a>
                                                        <!--Twitter-->
                                                        <a type="button" class="btn-floating btn-sm btn-tw"><i
                                                                    class="fab fa-twitter"></i></a>
                                                        <!--Google +-->
                                                        <a type="button" class="btn-floating btn-sm btn-gplus"><i
                                                                    class="fab fa-google-plus-g"></i></a>
                                                        <!--Linkedin-->
                                                        <a type="button" class="btn-floating btn-sm btn-ins"><i
                                                                    class="fab fa-linkedin-in"></i></a>

                                                        <button type="button"
                                                                class="btn btn-outline-primary btn-rounded btn-md ml-4"
                                                                data-dismiss="modal">Close
                                                        </button>

                                                    </div>

                                                </div>
                                                <!--/.Content-->

                                            </div>
                                        </div>
                                        <!--Modal: Name-->

                                        <a>
                                            <img class="img-fluid boxRelevo quad-center-content"
                                                 src="https://mdbootstrap.com/img/screens/yt/screen-video-1.jpg"
                                                 alt="video"
                                                 data-toggle="modal" data-target="#modal1">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #3 -->

                         <!-- TAB #4 -->
                        <div class="tab-pane fade" id="Tab4" role="tabpanel">
                            <a id="DG_ESTABELECIMENTOS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="DG_ESTABELECIMENTOS" class="table responsive table-bordered table-striped table-hover nowrap"></table>

                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-41" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="fal fa-clone"></i></span>&nbsp;
                                            <h2><?php echo $ui_sectors; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="DG_SETORES_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="DG_SETORES" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-41" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="fal fa-clone"></i></span>&nbsp;
                                            <h2><?php echo $ui_activity_situation; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="DG_ESTAB_SITUACOES_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="DG_ESTAB_SITUACOES" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #4 -->

                         <!-- TAB #5 -->
                        <div class="tab-pane fade" id="Tab5" role="tabpanel">
                            <a id="DG_DIRECOES_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="DG_DIRECOES" class="table responsive table-bordered table-striped table-hover nowrap"></table>

                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-51" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="fal fa-clone"></i></span>&nbsp;
                                            <h2><?php echo $ui_departments; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="DG_DEPARTAMENTOS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="DG_DEPARTAMENTOS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #5 -->

                         <!-- TAB #6 -->
                        <div class="tab-pane fade" id="Tab6" role="tabpanel">
                            <a id="DG_ENTIDADES_INTERNAS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="DG_ENTIDADES_INTERNAS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-11" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                            <h2><?php echo $ui_translate; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="DG_ENTIDADE_INTERNA_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="DG_ENTIDADE_INTERNA_TRADS" class="table table-bordered table-hover table-striped w-100"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #6 -->

                         <!-- TAB #7 -->
                        <div class="tab-pane fade" id="Tab7" role="tabpanel">
                            <a id="DG_ESTRUTURAS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="DG_ESTRUTURAS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                        </div>
                         <!-- END TAB #7 -->
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    pageSetUp();
    $(document).ready(function () {

        //Instance Definitions
        if (1 === 1) {

            //Empresa
            var optionDG_EMPRESAS = {
                "tableId": "DG_EMPRESAS",
                "table": "DG_EMPRESAS",
                "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_company; ?>",
                "pk": {
                    "primary": {
                        "EMPRESA": {"type": "varchar"}
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
                "detailsObjects": ['DG_EMPRESAS_CONTINUED', 'DG_DET_EMPRESA', 'DG_SERIE_DOCUMENTOS', 'DG_ESTABELECIMENTOS', 'DG_DIRECOES', 'DG_SETORES', 'DG_ENTIDADES_INTERNAS', 'DG_ESTRUTURAS'],
                //"initialWhereClause": "",
                "order_by": "NVL(NR_ORDEM, EMPRESA)",
                "recordBundle": 4,
                "pageLenght": 4,
                "scrollY": "117",
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
                        "title": "<?php echo mb_strtoupper($ui_company_acronym, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_company_acronym; ?>", //Editor
                        "data": 'EMPRESA',
                        "name": 'EMPRESA',
                        "className": "visibleColumn",
                        "attr": {
                            "style": "width:30%;",
                        }
                    }, {
                        "responsivePriority": 2,
                        "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_designation; ?>",
                        "data": 'DSP_EMPRESA',
                        "name": 'DSP_EMPRESA',
                        "className": "visibleColumn",
                    }, {
                        "responsivePriority": 3,
                        "title": "<?php echo mb_strtoupper($ui_nif_short, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_nif_short; ?>",
                        "data": 'NIF',
                        "name": 'NIF',
                        "className": "visibleColumn",
                    }, {
                        "responsivePriority": 4,
                        "title": "<?php echo mb_strtoupper($ui_RU_code, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_RU_code; ?>",
                        "data": 'ID_RU',
                        "name": 'ID_RU',
                        "className": "visibleColumn",
                    }, {
                        "responsivePriority": 5,
                        "title": "<?php echo mb_strtoupper($ui_active, 'UTF-8'); ?>", //Datatables
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
                        "responsivePriority": 6,
                        "title": "<?php echo mb_strtoupper($ui_inactive_dt, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_inactive_dt; ?>", //Editor
                        "data": 'DT_INACTIVO',
                        "name": 'DT_INACTIVO',
                        "datatype": 'date',
                        "className": "visibleColumn",
                        "attr": {
                            "class": "datepicker"
                        }
                    }, {
                        "responsivePriority": 7,
                        "title": "<?php echo mb_strtoupper($ui_order_nr, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_order_nr; ?>", //Editor
                        "data": 'NR_ORDEM',
                        "name": 'NR_ORDEM',
                        "className": "visibleColumn",
                        "attr": {
                            "style": "width:20%;"
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
                        "data": null,
                        "name": 'RECORD_HISTORY',
                        "type": "hidden",
                        "className": "none visibleColumn",
                        "render": function (val, type, row) {
                            return tablesRecordHistory(val, type, row);
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
                            return DG_EMPRESAS.crudButtons(true, true, true);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "EMPRESA": {
                            required: true,
                            maxlength: 10
                        },
                        "DSP_EMPRESA": {
                            required: true,
                            maxlength: 100,
                        },
                        "NIF": {
                            required: false,
                            maxlength: 15
                        },
                        "ACTIVO": {
                            required: true
                        },
                        "DT_INACTIVO": {
                            required: false,
                            dateISO: true
                        },
                        "NR_ORDEM": {
                            required: false,
                            number: true
                        }
                    }
                }
            };
            DG_EMPRESAS = new QuadTable();
            DG_EMPRESAS.initTable($.extend({}, datatable_instance_defaults, optionDG_EMPRESAS));
            //END Empresa

            //Empresas Continued :: QUADFORMS
            var optionsDG_EMPRESAS_CONTINUED = {
                formId: "#DG_EMPRESAS_CONTINUED",
                table: "DG_EMPRESAS",
                info: true, //Disables INFO: (record / total records) :: HOW ????
                "pk": {
                    "primary": {
                        "EMPRESA": {"type": "varchar"}
                    }
                },
                "dependsOn": {
                    "DG_EMPRESAS": {
                        "EMPRESA": "EMPRESA"
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
                domainLists: {
                    NATUREZA_JURIDICA: {
                        "domain-list": true,
                        "dependent-group": "DG_NATUREZA_JURIDICA"
                    },
                    REPARTICAO_FISCAL: {
                        "domain-list": true,
                        "dependent-group": "DG_REPARTICAO_FISCAL"
                    },
                    ASSOCIACAO_1: {
                        "domain-list": true,
                        "dependent-group": "DG_ASSOCIACAO_PATRONAL"
                    },
                    ASSOCIACAO_2: {
                        "domain-list": true,
                        "dependent-group": "DG_ASSOCIACAO_PATRONAL"
                    },
                    ASSOCIACAO_3: {
                        "domain-list": true,
                        "dependent-group": "DG_ASSOCIACAO_PATRONAL"
                    },
                    ACTIV_ECONOMICA_1: {
                        "domain-list": true,
                        "dependent-group": "DG_ACTIVIDADES_ECONOMICAS"
                    },
                    ACTIV_ECONOMICA_2: {
                        "domain-list": true,
                        "dependent-group": "DG_ACTIVIDADES_ECONOMICAS"
                    },
                    ACTIV_ECONOMICA_3: {
                        "domain-list": true,
                        "dependent-group": "DG_ACTIVIDADES_ECONOMICAS"
                    }
                },
                "validations": {
                    "rules": {
                        "CONSERVATORIA": {
                            maxlength: 20
                        },
                        "MATRICULA": {
                            maxlength: 20
                        },
                        "DT_INI_ACTIVIDADE": {
                            dateISO: true
                        },
                        "DT_CONSTITUICAO": {
                            dateISO: true
                        },
                        "VOLUME_VENDAS": {
                            number: true
                        },
                        "CAPITAL_SOCIAL": {
                            number: true
                        },
                        "TX_NACIONAL": {
                            number: true
                        },
                        "TX_ESTRANG": {
                            number: true
                        },
                        "TX_PUBLICO": {
                            number: true
                        },
                        "CD_CIRS": {
                            maxlength: 15
                        },
                        "NIF_RL": {
                            maxlength: 15
                        },
                        "NIF_TOC": {
                            maxlength: 15
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
            DG_EMPRESAS_CONTINUED = new QuadForm();
            DG_EMPRESAS_CONTINUED.initForm($.extend({}, datatable_instance_defaults, optionsDG_EMPRESAS_CONTINUED));
            //Empresas Continued :: QUADFORMS

            //Empresas Configuração :: QUADFORMS
            var optionsDG_DET_EMPRESA = {
                formId: "#DG_DET_EMPRESA",
                table: "DG_DET_EMPRESA",
                info: true, //Disables INFO: (record / total records) :: HOW ????
                "pk": {
                    "primary": {
                        "EMPRESA": {"type": "varchar"}
                    }
                },
                "dependsOn": {
                    "DG_EMPRESAS": {
                        "EMPRESA": "EMPRESA"
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
                domainLists: {
                    NATUREZA_JURIDICA: {
                        "domain-list": true,
                        "dependent-group": "DG_NATUREZA_JURIDICA"
                    },
                    REPARTICAO_FISCAL: {
                        "domain-list": true,
                        "dependent-group": "DG_REPARTICAO_FISCAL"
                    },
                    ASSOCIACAO_1: {
                        "domain-list": true,
                        "dependent-group": "DG_ASSOCIACAO_PATRONAL"
                    },
                    ASSOCIACAO_2: {
                        "domain-list": true,
                        "dependent-group": "DG_ASSOCIACAO_PATRONAL"
                    },
                    ASSOCIACAO_3: {
                        "domain-list": true,
                        "dependent-group": "DG_ASSOCIACAO_PATRONAL"
                    },
                    ACTIV_ECONOMICA_1: {
                        "domain-list": true,
                        "dependent-group": "DG_ACTIVIDADES_ECONOMICAS"
                    },
                    ACTIV_ECONOMICA_2: {
                        "domain-list": true,
                        "dependent-group": "DG_ACTIVIDADES_ECONOMICAS"
                    },
                    ACTIV_ECONOMICA_3: {
                        "domain-list": true,
                        "dependent-group": "DG_ACTIVIDADES_ECONOMICAS"
                    }
                },
                validations: {
                    rules: {
                        RH_CADUCA_DC: {
                            required: true,
                        },
                        RH_PRG_TS_RECIBO: {
                            maxlength: 30
                        },
                        RH_PRG_AUSENCIAS_RECIBO: {
                            maxlength: 30
                        },
                        RH_PRG_HV_RECIBO: {
                            maxlength: 30
                        },
                        RH_PRG_PONTO_TS: {
                            maxlength: 30
                        },
                        RH_PRG_PONTO_AUSENCIAS: {
                            maxlength: 30
                        },
                        RH_PRG_DC: {
                            maxlength: 30
                        }
                    }
                }

            };
            DG_DET_EMPRESA = new QuadForm();
            DG_DET_EMPRESA.initForm($.extend({}, datatable_instance_defaults, optionsDG_DET_EMPRESA));
            //END Empresas Configuração :: QUADFORMS

            //Séries Documentos
            var optionsDG_SERIE_DOCUMENTOS = {
                "tableId": "DG_SERIE_DOCUMENTOS",
                "table": "DG_SERIE_DOCUMENTOS",
                "pk": {
                    "primary": {
                        "EMPRESA": {"type": "varchar"},
                        "ANO": {"type": "number"},
                        "SERIE": {"type": "varchar"},
                        "OPERACAO": {"type": "varchar"}
                    }
                },
                "dependsOn": {
                    "DG_EMPRESAS": {
                        "EMPRESA": "EMPRESA"
                    }
                },
                "order_by": "ANO DESC, DT_INICIO ASC, OPERACAO ASC, SERIE ASC",
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
                        "data": 'EMPRESA',
                        "name": 'EMPRESA',
                        "type": "hidden",
                        "visible": false,
                    }, {
                        "responsivePriority": 2,
                        "title": "<?php echo mb_strtoupper($ui_operation, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_operation; ?>", //Editor
                        "data": 'OPERACAO',
                        "name": 'OPERACAO',
                        "type": "select",
                        "className": "visibleColumn",
                        "attr": {
                            "domain-list": true,
                            "dependent-group": 'DG_SERIE_DOCUMENTOS.OPERACAO',
                            "class": "form-control",
                            "name": 'ATIVO'
                        },
                        "render": function (val, type, row) {
                            if (val != null) {
                                var o = _.find(initApp.joinsData['DG_SERIE_DOCUMENTOS.OPERACAO'], {'RV_LOW_VALUE': val});
                                return val == null ? null : o['RV_MEANING'];
                            }
                            return val;
                        }
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'ANO',
                        "name": 'ANO',
                        "type": "hidden",
                        "visible": false,
                    }, {
                        "responsivePriority": 3,
                        "complexList": true,
                        "title": "<?php echo mb_strtoupper($ui_year, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_year; ?>",
                        "data": 'DSP_ANO',
                        "name": 'DSP_ANO',
                        "type": "select",
                        "className": "visibleColumn",
                        //"visible": false, //DataTables
                        //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...
                        "attr": {
                            "deferred": true,
                            "dependent-group": "ANOS_FISCAIS",
                            "dependent-level": 1,
                            "data-db-name": 'A.ANO',
                            "decodeFromTable": 'DG_ANOS A',
                            "class": "form-control complexList chosen",
                            "desigColumn": "A.ANO",
                            "orderBy": "A.ANO DESC",
                            "filter": {
                                "create": " AND A.ESTADO = 'A' AND A.EMPRESA = ':EMPRESA'", //On-New-Record
                                "edit": " AND A.ESTADO = 'A' AND A.EMPRESA = ':EMPRESA'", //On-Edit-Record
                            }
                        }
                    }, {
                        "responsivePriority": 4,
                        "title": "<?php echo mb_strtoupper($ui_serie, 'UTF-8'); ?>", //Datatables :: Original
                        "label": "<?php echo $ui_serie; ?>", //Editor
                        "data": 'SERIE',
                        "name": 'SERIE',
                        "className": "visibleColumn",
                        "attr": {
                            "class": "form-control",
                            "style": "width: 15%;"
                        }
                    }, {
                        "responsivePriority": 5,
                        "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_begin_date; ?>", //Editor
                        "data": 'DT_INICIO',
                        "name": 'DT_INICIO',
                        "datatype": 'date',
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
                        "responsivePriority": 7,
                        "title": "<?php echo mb_strtoupper($ui_counter, 'UTF-8'); ?>", //Datatables :: Original
                        "label": "<?php echo $ui_counter; ?>", //Editor
                        "data": 'CONTADOR',
                        "name": 'CONTADOR',
                        "className": "visibleColumn right",
                        "def": 0,
                        "attr": {
                            "class": "form-control toRight",
                            "style": "width: 50%;"
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
                        "data": null,
                        "name": 'RECORD_HISTORY',
                        "type": "hidden",
                        "className": "none visibleColumn",
                        "render": function (val, type, row) {
                            return tablesRecordHistory(val, type, row);
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
                            return DG_SERIE_DOCUMENTOS.crudButtons(true, true, true);
                        }
                    }
                ],
                validations: {
                    rules: {
                        ANO: {
                            required: true,
                            integer: true,
                            maxlength: 4
                        },
                        OPERACAO: {
                            required: true
                        },
                        SERIE: {
                            required: true,
                            maxlength: 2
                        },
                        CONTADOR: {
                            required: true,
                            integer: true,
                            maxlength: 6
                        },
                        DT_INICIO: {
                            required: true,
                            dateISO: true
                        },
                        ACTIVA: {
                            required: true
                        },
                        "DT_FIM": {
                            dateISO: true,
                            dateEqOrNextThan: "DT_INICIO",
                        }
                    },
                    "messages": {
                        "DT_FIM": {
                            dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                        }
                    }
                }
            };
            DG_SERIE_DOCUMENTOS = new QuadTable();
            DG_SERIE_DOCUMENTOS.initTable($.extend({}, datatable_instance_defaults, optionsDG_SERIE_DOCUMENTOS));
            //END Séries Documentos

            //Estabelecimentos :: DG_ESTABELECIMENTOS
            var optionDG_ESTABELECIMENTOS = {
                "tableId": "DG_ESTABELECIMENTOS",
                "table": "DG_ESTABELECIMENTOS",
                "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_establishment; ?>",
                "pk": {
                    "primary": {
                        "EMPRESA": {"type": "varchar"},
                        "CD_ESTAB": {"type": "varchar"}
                    }
                },
                "dependsOn": {
                    "DG_EMPRESAS": {
                        "EMPRESA": "EMPRESA"
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
                "detailsObjects": ['DG_SETORES', 'DG_ESTAB_SITUACOES'],
                //"initialWhereClause": "",
                "order_by": "CD_ESTAB",
                "recordBundle": 5,
                "pageLenght": 5,
                "scrollY": "156",
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
                        "visible": false
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_code; ?>", //Editor
                        "data": 'CD_ESTAB',
                        "name": 'CD_ESTAB',
                        "className": "visibleColumn",
                        "attr": {
                            "style": "width:30%;",
                        }
                    }, {
                        "responsivePriority": 2,
                        "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_designation; ?>",
                        "data": 'DSP_ESTAB',
                        "name": 'DSP_ESTAB',
                        "className": "visibleColumn",
                    }, {
                        "responsivePriority": 3,
                        "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_short_desig; ?>",
                        "data": 'DSR_ESTAB',
                        "name": 'DSR_ESTAB',
                        "className": "visibleColumn",
                    }, {
                        "responsivePriority": 4,
                        "title": "<?php echo mb_strtoupper($ui_headquarters, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_headquarters; ?>", //Editor
                        "data": 'SEDE',
                        "name": 'SEDE',
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
                        "responsivePriority": 5,
                        "title": "<?php echo mb_strtoupper($ui_active, 'UTF-8'); ?>", //Datatables
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
                        "responsivePriority": 6,
                        "title": "<?php echo mb_strtoupper($ui_inactive_dt, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_inactive_dt; ?>", //Editor
                        "data": 'DT_INACTIVO',
                        "name": 'DT_INACTIVO',
                        "datatype": 'date',
                        "className": "visibleColumn",
                        "attr": {
                            "class": "datepicker"
                        }
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_address, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_address; ?>", //Editor
                        "data": 'MORADA',
                        "name": 'MORADA',
                        "type": 'textarea', //Editor
                        "className": "none visibleColumn",
                        "attr": {
                            "style": "max-width: 335px",
                        }
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_locale, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_locale; ?>", //Editor
                        "data": 'LOCALIDADE',
                        "name": 'LOCALIDADE',
                        "className": "none visibleColumn"
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_iva_geo, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_iva_geo; ?>", //Editor
                        "data": 'GEO_SITUACAO',
                        "name": 'GEO_SITUACAO',
                        "type": "select",
                        "className": "none visibleColumn",
                        "attr": {
                            "domain-list": true,
                            "dependent-group": 'DG_GEO_SITUACAO',
                            "class": "form-control",
                            "name": 'GEO_SITUACAO'
                        },
                        "render": function (val, type, row) {
                            if (val != null) {
                                var o = _.find(initApp.joinsData['DG_GEO_SITUACAO'], {'RV_LOW_VALUE': val});
                                return val == null ? null : o['RV_MEANING'];
                            }
                            return val;
                        }
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'CD_PAIS',
                        "name": 'CD_PAIS',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "complexList": true,
                        "title": "<?php echo mb_strtoupper($ui_country, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_country; ?>",
                        "data": 'DSP_PAIS',
                        "name": 'DSP_PAIS',
                        "type": "select",
                        "className": "none visibleColumn",
                        //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...
                        "attr": {
                            "dependent-group": "PAISES",
                            "dependent-level": 1,
                            "data-db-name": "A.CD_PAIS",
                            "decodeFromTable": "DG_PAISES A",  //TO CHANGE ON QUAD-HCM
                            "desigColumn": "A.DSP_PAIS",
                            "orderBy": "A.CD_PAIS",
                            "class": "form-control complexList chosen"
                        }
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_postal_code, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_postal_code; ?>", //Editor
                        "data": 'CD_POSTAL',
                        "name": 'CD_POSTAL',
                        "className": "none visibleColumn",
                        "attr": {
                            "style": "width: 25%;",
                        }
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_postal_num, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_postal_num; ?>", //Editor
                        "data": 'NR_ORDEM_POSTAL',
                        "name": 'NR_ORDEM_POSTAL',
                        "className": "none visibleColumn",
                        "attr": {
                            "style": "max-width: 25%",
                        }
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_phone_short . ' #1', 'UTF-8'); ?>", //Datatables :: Original
                        "label": "<?php echo $ui_phone . ' #1'; ?>", //Editor
                        "data": 'TELEFONE_1',
                        "name": 'TELEFONE_1',
                        "className": "none visibleColumn",
                        "attr": {
                            "class": "form-control",
                            "style": "width: 50%;",
                        }
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_phone_short . ' #2', 'UTF-8'); ?>", //Datatables :: Original
                        "label": "<?php echo $ui_phone . ' #2'; ?>", //Editor
                        "data": 'TELEFONE_2',
                        "name": 'TELEFONE_2',
                        "className": "none visibleColumn",
                        "attr": {
                            "class": "form-control",
                            "style": "width: 50%;",
                        }
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_phone_short . ' #3', 'UTF-8'); ?>", //Datatables :: Original
                        "label": "<?php echo $ui_phone . ' #2'; ?>", //Editor
                        "data": 'TELEFONE_3',
                        "name": 'TELEFONE_3',
                        "className": "none visibleColumn",
                        "attr": {
                            "class": "form-control",
                            "style": "width: 50%;",
                        }
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_fax, 'UTF-8'); ?>", //Datatables :: Original
                        "label": "<?php echo $ui_fax; ?>", //Editor
                        "data": 'FAX',
                        "name": 'FAX',
                        "className": "none visibleColumn",
                        "attr": {
                            "class": "form-control",
                            "style": "width: 50%;",
                        }
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_email, 'UTF-8'); ?>", //Datatables :: Original
                        "label": "<?php echo $ui_email; ?>", //Editor
                        "fieldInfo": "<?php echo $hint_intrastat; ?>",
                        "data": 'EMAIL_INTRASTAT',
                        "name": 'EMAIL_INTRASTAT',
                        "className": "none visibleColumn",
                        "attr": {
                            "class": "form-control"
                        }
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_period_operation, 'UTF-8'); ?>", //Datatables :: Original
                        "label": "<?php echo $ui_period_operation; ?>", //Editor
                        "data": 'PER_FUNCIONAMENTO',
                        "name": 'PER_FUNCIONAMENTO',
                        "className": "none visibleColumn",
                        "attr": {
                            "class": "form-control"
                        }
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_closing_days, 'UTF-8'); ?>", //Datatables :: Original
                        "label": "<?php echo $ui_closing_days; ?>", //Editor
                        "data": 'DIAS_ENCERR',
                        "name": 'DIAS_ENCERR',
                        "className": "none visibleColumn",
                        "attr": {
                            "class": "form-control"
                        }
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'CD_DISTRITO',
                        "name": 'CD_DISTRITO',
                        "type": "hidden", //Editor
                        "visible": false
                    }, {
                        "complexList": true,
                        "title": "<?php echo mb_strtoupper($ui_district, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_district; ?>",
                        "data": 'DSP_DISTRITO',
                        "name": 'DSP_DISTRITO',
                        "type": "select",
                        "className": "none visibleColumn",
                        //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...
                        "attr": {
                            "dependent-group": "PAISES",
                            "dependent-level": 2,
                            "data-db-name": "A.CD_PAIS@A.CD_DISTRITO",
                            "decodeFromTable": "DG_DISTRITOS A",  //TO CHANGE ON QUAD-HCM
                            "desigColumn": "A.DSP_DISTRITO",
                            "orderBy": "A.DSP_DISTRITO",
                            "class": "form-control complexList chosen"
                        }
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'CD_CONCELHO',
                        "name": 'CD_CONCELHO',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "complexList": true,
                        "title": "<?php echo mb_strtoupper($ui_municipality, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_municipality; ?>",
                        "data": 'DSP_CONCELHO',
                        "name": 'DSP_CONCELHO',
                        "type": "select",
                        "className": "none visibleColumn",
                        //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...
                        "attr": {
                            "dependent-group": "PAISES",
                            "dependent-level": 3,
                            "data-db-name": "A.CD_PAIS@A.CD_DISTRITO@A.CD_CONCELHO",
                            "decodeFromTable": "DG_CONCELHOS A",  //TO CHANGE ON QUAD-HCM
                            "desigColumn": "A.DSP_CONCELHO",
                            "orderBy": "A.DSP_CONCELHO",
                            "class": "form-control complexList chosen"
                        }
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'CD_FREGUESIA',
                        "name": 'CD_FREGUESIA',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "complexList": true,
                        "title": "<?php echo mb_strtoupper($ui_parish, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_parish; ?>",
                        "data": 'DSP_FREGUESIA',
                        "name": 'DSP_FREGUESIA',
                        "type": "select",
                        "className": "none visibleColumn",
                        //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...
                        "attr": {
                            "dependent-group": "PAISES",
                            "dependent-level": 4,
                            "data-db-name": "A.CD_PAIS@A.CD_DISTRITO@A.CD_CONCELHO@A.CD_FREGUESIA",
                            "decodeFromTable": "DG_FREGUESIAS A",  //TO CHANGE ON QUAD-HCM
                            "desigColumn": "A.DSP_FREGUESIA",
                            "orderBy": "A.DSP_FREGUESIA",
                            "class": "form-control complexList chosen"
                        }
                    }, {
                        "title": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_holiday_pay, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                        "label": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_holiday_pay, 'UTF-8'); ?>" + "</span>", //Editor
                        "data": '',
                        "name": 'TIT_PAGA_FERIAS',
                        "type": "readonly",
                        "className": "none",
                        "defaultContent": "", //Must be used on STATIC columns content. On this case classes make there way...
                        "attr": {
                            "style": "display: none;"
                        }
                    }, {
                        "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_holiday_pay, 'UTF-8'); ?>" + "</span>", //Datatables
                        "label": "<span class='quadSubTitle'>" + "<?php echo $ui_holiday_pay; ?>" + "</span>", //Editor
                        "data": 'MOMENTO_PAG_FERIAS',
                        "name": 'MOMENTO_PAG_FERIAS',
                        "type": "select",
                        "className": "none visibleColumn",
                        "attr": {
                            "domain-list": true,
                            "dependent-group": 'DG_ESTABELECIMENTOS.MOMENTO_PAG_FERIAS',
                            "class": "form-control",
                            "name": 'MOMENTO_PAG_FERIAS'
                        },
                        "render": function (val, type, row) {
                            if (val != null) {
                                var o = _.find(initApp.joinsData['DG_ESTABELECIMENTOS.MOMENTO_PAG_FERIAS'], {'RV_LOW_VALUE': val});
                                return val == null ? null : o['RV_MEANING'];
                            }
                            return val;
                        }
                    }, {
                        "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_month, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                        "label": "<span class='quadSubTitle'>" + "<?php echo $ui_month; ?>" + "</span>", //Editor
                        "data": 'MES_PAG_FERIAS',
                        "name": 'MES_PAG_FERIAS',
                        "className": "none visibleColumn right",
                        "attr": {
                            "class": "form-control toRight",
                            "style": "width: 20%;"
                        }
                    }, {
                        "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_admission, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                        "label": "<span class='quadSubTitle'>" + "<?php echo $ui_admission; ?>" + "</span>", //Editor
                        "fieldInfo": "<?php echo $hint_holliday_pay_on_admission; ?>",
                        "data": 'MES_PAG_FERIAS_ADM',
                        "name": 'MES_PAG_FERIAS_ADM',
                        "className": "none visibleColumn right",
                        "attr": {
                            "class": "form-control toRight",
                            "style": "width: 20%;"
                        }
                    }, {
                        "title": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_time_management_night_time, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                        "label": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_time_management_night_time, 'UTF-8'); ?>" + "</span>", //Editor
                        "data": '',
                        "name": 'TIT_PONTO',
                        "type": "readonly",
                        "className": "none",
                        "defaultContent": "", //Must be used on STATIC columns content. On this case classes make there way...
                        "attr": {
                            "style": "display: none;"
                        }
                    }, {
                        "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_begin, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                        "label": "<span class='quadSubTitle'>" + "<?php echo $ui_begin; ?>" + "</span>", //Editor
                        "data": 'INICIO_NOITE',
                        "name": 'INICIO_NOITE',
                        "className": "none visibleColumn right",
                        "attr": {
                            "class": "form-control toRight",
                            "style": "width: 20%;"
                        }
                    }, {
                        "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_end, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                        "label": "<span class='quadSubTitle'>" + "<?php echo $ui_end; ?>" + "</span>", //Editor
                        "data": 'FIM_NOITE',
                        "name": 'FIM_NOITE',
                        "className": "none visibleColumn right",
                        "attr": {
                            "class": "form-control toRight",
                            "style": "width: 20%;"
                        }
                    }, {
                        "title": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_official_reports, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                        "label": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_official_reports, 'UTF-8'); ?>" + "</span>", //Editor
                        "data": '',
                        "name": 'TIT_RELATORIOS',
                        "type": "readonly",
                        "className": "none",
                        "defaultContent": "", //Must be used on STATIC columns content. On this case classes make there way...
                        "attr": {
                            "style": "display: none;"
                        }
                    }, {
                        "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_economic_activitie, 'UTF-8'); ?>" + "</span>", //Datatables
                        "label": "<span class='quadSubTitle'>" + "<?php echo $ui_economic_activitie; ?>" + "</span>", //Editor
                        "data": 'ACTIV_ECON_QP',
                        "name": 'ACTIV_ECON_QP',
                        "type": "select",
                        "className": "none visibleColumn",
                        "attr": {
                            "domain-list": true,
                            "dependent-group": 'DG_ACTIVIDADES_ECONOMICAS',
                            "class": "form-control",
                            "name": 'ACTIV_ECON_QP'
                        },
                        "render": function (val, type, row) {
                            if (val != null) {
                                var o = _.find(initApp.joinsData['DG_ACTIVIDADES_ECONOMICAS'], {'RV_LOW_VALUE': val});
                                return val == null ? null : o['RV_MEANING'];
                            }
                            return val;
                        }
                    }, {
                        "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_unique_report_id_short, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                        "label": "<span class='quadSubTitle'>" + "<?php echo $ui_unique_report_id_short; ?>" + "</span>", //Editor
                        "data": 'ID_RU',
                        "name": 'ID_RU',
                        "className": "none visibleColumn right",
                        "attr": {
                            "class": "form-control toRight",
                            "style": "width: 20%;"
                        }
                    }, {
                        "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_overseas, 'UTF-8'); ?>" + "</span>", //Datatables
                        "label": "<span class='quadSubTitle'>" + "<?php echo $ui_overseas; ?>" + "</span>", //Editor
                        "data": 'ESTRG_RU',
                        "name": 'ESTRG_RU',
                        "type": "select",
                        "def": "N",
                        "className": "none visibleColumn",
                        "attr": {
                            "domain-list": true,
                            "dependent-group": 'DG_SIM_NAO',
                            "class": "form-control",
                            "name": 'DG_SIM_NAO',
                            "style": "width: 30%"
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
                        "data": 'CD_ED',
                        "name": 'CD_ED',
                        "type": "hidden",
                        "visible": false
                    }, {
                        "complexList": true,
                        "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_discount_entity, 'UTF-8'); ?>" + "</span>",
                        "label": "<span class='quadSubTitle'>" + "<?php echo $ui_discount_entity; ?>" + "</span>",
                        "data": 'DSP_ED',
                        "name": 'DSP_ED',
                        "type": "select",
                        "className": "visibleColumn",
                        //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...
                        "attr": {
                            "dependent-group": "ENTIDADES_DESCONTO",
                            "dependent-level": 1,
                            "data-db-name": "A.CD_ED",
                            "decodeFromTable": "RH_DEF_ENTIDADES_DESCONTO A",  //TO CHANGE ON QUAD-HCM
                            "desigColumn": "CONCAT(CONCAT(A.CD_ED,'-'),A.DSP_ED)",
                            "orderBy": "A.CD_ED",
                            "class": "form-control complexList chosen",
                            "filter": {
                                "create": " AND A.ACTIVO = 'S' AND A.CD_GRUPO_ED = 'SS' ", //On-New-Record
                                "edit": " AND A.ACTIVO = 'S' AND A.CD_GRUPO_ED = 'SS' ", //On-Edit-Record
                            }
                        }
                    }, {
                        "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_ss_id, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                        "label": "<span class='quadSubTitle'>" + "<?php echo $ui_ss_id; ?>" + "</span>", //Editor
                        "data": 'REF_SS',
                        "name": 'REF_SS',
                        "className": "none visibleColumn right",
                        "attr": {
                            "class": "form-control toRight",
                            "style": "width: 20%;"
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
                        "data": null,
                        "name": 'RECORD_HISTORY',
                        "type": "hidden",
                        "className": "none visibleColumn",
                        "render": function (val, type, row) {
                            return tablesRecordHistory(val, type, row);
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
                            return DG_ESTABELECIMENTOS.crudButtons(true, true, true);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "CD_ESTAB": {
                            required: true,
                            maxlength: 10
                        },
                        "DSP_ESTAB": {
                            maxlength: 80,
                        },
                        "DSR_ESTAB": {
                            maxlength: 25,
                        },
                        "SEDE": {
                            required: true
                        },
                        "ACTIVO": {
                            required: true
                        },
                        "DT_INACTIVO": {
                            dateISO: true
                        },
                        "MORADA": {
                            maxlength: 200
                        },
                        "LOCALIDADE": {
                            maxlength: 30
                        },
                        "CD_POSTAL": {
                            maxlength: 10
                        },
                        "NR_ORDEM_POSTAL": {
                            maxlength: 10
                        },
                        "TELEFONE_1": {
                            maxlength: 20
                        },
                        "TELEFONE_2": {
                            maxlength: 20
                        },
                        "TELEFONE_3": {
                            maxlength: 20
                        },
                        "FAX": {
                            maxlength: 20
                        },
                        "EMAIL_INTRASTAT": {
                            email: true,
                            maxlength: 80
                        },
                        "PER_FUNCIONAMENTO": {
                            maxlength: 100
                        },
                        "DIAS_ENCERR": {
                            maxlength: 100
                        },
                        "MES_PAG_FERIAS": {
                            integer: true,
                            rangelength: [1, 12]
                        },
                        "INICIO_NOITE": {
                            maxlength: 5
                        },
                        "FIM_NOITE": {
                            maxlength: 5
                        },
                        "ID_RU": {
                            maxlength: 30
                        },
                        "REF_SS": {
                            maxlength: 100
                        }
                    }
                }
            };
            DG_ESTABELECIMENTOS = new QuadTable();
            DG_ESTABELECIMENTOS.initTable($.extend({}, datatable_instance_defaults, optionDG_ESTABELECIMENTOS));
            //END Estabelecimentos

            //Sectores
            var optionDG_SETORES = {
                "tableId": "DG_SETORES",
                "table": "DG_SETORES",
                "pk": {
                    "primary": {
                        "EMPRESA": {"type": "varchar"},
                        "CD_ESTAB": {"type": "varchar"},
                        "ID_SETOR": {"type": "number"},
                        "DT_INI": {"type": "date"}
                    }
                },
                "dependsOn": {
                    "DG_ESTABELECIMENTOS": {
                        "EMPRESA": "EMPRESA",
                        "CD_ESTAB": "CD_ESTAB"
                    }
                },
                //"initialWhereClause": "",
                "order_by": "ID_SETOR",
                "recordBundle": 3,
                "pageLenght": 3,
                "scrollY": "117",
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
                        "visible": false
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'CD_ESTAB',
                        "name": 'CD_ESTAB',
                        "type": "hidden",
                        "visible": false
                    }, {
                        "responsivePriority": 2,
                        "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_code; ?>", //Editor
                        "data": 'ID_SETOR',
                        "name": 'ID_SETOR',
                        "className": "visibleColumn",
                        "attr": {
                            "style": "width:30%;",
                        }
                    }, {
                        "responsivePriority": 3,
                        "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_designation; ?>",
                        "data": 'DSP_SETOR',
                        "name": 'DSP_SETOR',
                        "className": "visibleColumn",
                    }, {
                        "responsivePriority": 5,
                        "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_short_desig; ?>",
                        "data": 'DSR_SETOR',
                        "name": 'DSR_SETOR',
                        "className": "visibleColumn",
                    }, {
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
                        "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_end_date; ?>", //Editor
                        "data": 'DT_FIM',
                        "name": 'DT_FIM',
                        "datatype": 'date',
                        "className": "none visibleColumn",
                        "attr": {
                            "class": "datepicker"
                        }
                    }, {
                        "responsivePriority": 4,
                        "title": "<?php echo mb_strtoupper($ui_employee_min_short, 'UTF-8'); ?>", //Datatables :: Original
                        "label": "<?php echo $ui_employee_min_short; ?>", //Editor
                        "data": 'NR_MIN_COLABS',
                        "name": 'NR_MIN_COLABS',
                        "className": "visibleColumn right",
                        "attr": {
                            "class": "form-control toRight",
                            "style": "width: 20%;"
                        }
                    }, {
                        "title": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_maintenance_wallet, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                        "label": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_maintenance_wallet, 'UTF-8'); ?>" + "</span>", //Editor
                        "data": '',
                        "name": 'TIT_BOLSA_MANUT',
                        "type": "readonly",
                        "className": "none",
                        "defaultContent": "", //Must be used on STATIC columns content. On this case classes make there way...
                        "attr": {
                            "style": "display: none;"
                        }
                    }, {
                        "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_scope, 'UTF-8'); ?>" + "</span>", //Datatables
                        "label": "<span class='quadSubTitle'>" + "<?php echo $ui_scope; ?>" + "</span>", //Editor
                        "data": 'MANUT_TP_VALID',
                        "name": 'MANUT_TP_VALID',
                        "type": "select",
                        "className": "none visibleColumn",
                        "attr": {
                            "domain-list": true,
                            "dependent-group": 'DG_SETORES.MANUT_TP_VALID',
                            "class": "form-control",
                            "name": 'MANUT_TP_VALID'
                        },
                        "render": function (val, type, row) {
                            if (val != null) {
                                var o = _.find(initApp.joinsData['DG_SETORES.MANUT_TP_VALID'], {'RV_LOW_VALUE': val});
                                return val == null ? null : o['RV_MEANING'];
                            }
                            return val;
                        }
                    }, {
                        "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_min, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                        "label": "<span class='quadSubTitle'>" + "<?php echo $ui_min; ?>" + "</span>", //Editor
                        "fieldInfo": "<?php echo $hint_lim_min_manut_wallet; ?>",
                        "data": 'MANUT_LIM_MIN',
                        "name": 'MANUT_LIM_MIN',
                        "className": "none visibleColumn right",
                        "attr": {
                            "class": "form-control toRight",
                            "style": "width: 20%;"
                        }
                    }, {
                        "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_max, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                        "label": "<span class='quadSubTitle'>" + "<?php echo $ui_max; ?>" + "</span>", //Editor
                        "fieldInfo": "<?php echo $hint_lim_max_manut_wallet; ?>",
                        "data": 'MANUT_LIM_MAX',
                        "name": 'MANUT_LIM_MAX      ',
                        "className": "none visibleColumn right",
                        "attr": {
                            "class": "form-control toRight",
                            "style": "width: 20%;"
                        }
                    }, {
                        "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_applicability, 'UTF-8'); ?>" + "</span>", //Datatables
                        "label": "<span class='quadSubTitle'>" + "<?php echo $ui_applicability; ?>" + "</span>", //Editor
                        "fieldInfo": "<?php echo $hint_maintenance_wallet_prg; ?>",
                        "data": 'MANUT_PROGRAMA',
                        "name": 'MANUT_PROGRAMA',
                        "type": "select",
                        "className": "none visibleColumn",
                        "attr": {
                            "domain-list": true,
                            "dependent-group": 'DG_SIM_NAO',
                            "class": "form-control",
                            "name": 'MANUT_PROGRAMA',
                            "style": "width: 30%"
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
                        "data": null,
                        "name": 'RECORD_HISTORY',
                        "type": "hidden",
                        "className": "none visibleColumn",
                        "render": function (val, type, row) {
                            return tablesRecordHistory(val, type, row);
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
                            return DG_SETORES.crudButtons(true, true, true);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "ID_SETOR": {
                            required: true,
                            maxlength: 10
                        },
                        "DSP_SETOR": {
                            required: true,
                            maxlength: 80
                        },
                        "DSR_SETOR": {
                            required: true,
                            maxlength: 25
                        },
                        "DT_INI": {
                            required: true,
                            dateISO: true
                        },
                        "NR_MIN_COLABS": {
                            integer: true,
                            maxlength: 10
                        },
                        "MANUT_TP_VALID": {
                            required: false
                        },
                        "MANUT_LIM_MIN": {
                            integer: true,
                            maxlength: 10
                        },
                        "MANUT_LIM_MAX": {
                            integer: true,
                            maxlength: 10
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
            DG_SETORES = new QuadTable();
            DG_SETORES.initTable($.extend({}, datatable_instance_defaults, optionDG_SETORES));
            //END Sectores

            // Estab. Situação na Atividade ::
            var optionsDG_ESTAB_SITUACOES = {
                "tableId": "DG_ESTAB_SITUACOES",
                "table": "DG_ESTAB_SITUACOES",
                "pk": {
                    "primary": {
                        "EMPRESA": {"type": "varchar"},
                        "CD_ESTAB": {"type": "varchar"},
                        "DT_INI": {"type": "date"}
                    }
                },
                "dependsOn": {
                    "DG_ESTABELECIMENTOS": {
                        "EMPRESA": "EMPRESA",
                        "CD_ESTAB": "CD_ESTAB"
                    }
                },
                "order_by": "DT_INI DESC",
                "recordBundle": 3,
                "pageLenght": 3,
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
                        "type": "hidden",
                        "visible": false,
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'CD_ESTAB',
                        "name": 'CD_ESTAB',
                        "type": "hidden",
                        "visible": false,
                    }, {
                        "responsivePriority": 2,
                        "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_begin_date; ?>", //Editor
                        "data": 'DT_INI',
                        "name": 'DT_INI',
                        "datatype": 'date',
                        "className": "visibleColumn",
                        "attr": {
                            "class": "datepicker"
                        }
                    }, {
                        "responsivePriority": 3,
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
                        "title": "<?php echo mb_strtoupper($ui_situation, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_situation; ?>", //Editor
                        "data": 'SITUACAO',
                        "name": 'SITUACAO',
                        "type": "select",
                        "className": "visibleColumn",
                        "attr": {
                            "domain-list": true,
                            "dependent-group": 'DG_ESTAB_SITUACOES.SITUACAO',
                            "class": "form-control",
                            "name": 'SITUACAO'
                        },
                        "render": function (val, type, row) {
                            if (val != null) {
                                var o = _.find(initApp.joinsData['DG_ESTAB_SITUACOES.SITUACAO'], {'RV_LOW_VALUE': val});
                                return val == null ? null : o['RV_MEANING'];
                            }
                            return val;
                        }
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_motif, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_motif; ?>", //Editor
                        "data": 'MOTIVO',
                        "name": 'MOTIVO',
                        "type": "select",
                        "className": "visibleColumn",
                        "attr": {
                            "domain-list": true,
                            "dependent-group": 'DG_ESTAB_SITUACOES.MOTIVO',
                            "class": "form-control",
                            "name": 'MOTIVO'
                        },
                        "render": function (val, type, row) {
                            if (val != null) {
                                var o = _.find(initApp.joinsData['DG_ESTAB_SITUACOES.MOTIVO'], {'RV_LOW_VALUE': val});
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
                        "data": null,
                        "name": 'RECORD_HISTORY',
                        "type": "hidden",
                        "className": "none visibleColumn",
                        "render": function (val, type, row) {
                            return tablesRecordHistory(val, type, row);
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
                            return DG_ESTAB_SITUACOES.crudButtons(true, true, true);
                        }
                    }
                ],
                validations: {
                    rules: {
                        DT_INI: {
                            required: true,
                            dateISO: true
                        },
                        "DT_FIM": {
                            dateISO: true,
                            dateEqOrNextThan: "DT_INI",
                        },
                        SITUACAO: {
                            required: true
                        }
                    },
                    "messages": {
                        "DT_FIM": {
                            dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                        }
                    }
                }
            };
            DG_ESTAB_SITUACOES = new QuadTable();
            DG_ESTAB_SITUACOES.initTable($.extend({}, datatable_instance_defaults, optionsDG_ESTAB_SITUACOES));
            //END Estab. Situação na Atividade

            //Direções
            var optionDG_DIRECOES = {
                "tableId": "DG_DIRECOES",
                "table": "DG_DIRECOES",
                "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_direction; ?>",
                "pk": {
                    "primary": {
                        "EMPRESA": {"type": "varchar"},
                        "CD_DIRECAO": {"type": "varchar"},
                        "DT_INI_DIRECAO": {"type": "date"}
                    }
                },
                "dependsOn": {
                    "DG_EMPRESAS": {
                        "EMPRESA": "EMPRESA"
                    }
                },
                "detailsObjects": ['DG_DEPARTAMENTOS'],
                //"initialWhereClause": "",
                "order_by": "CD_DIRECAO",
                "recordBundle": 4,
                "pageLenght": 4,
                "scrollY": "117",
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
                        "visible": false
                    }, {
                        "responsivePriority": 2,
                        "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_code; ?>", //Editor
                        "data": 'CD_DIRECAO',
                        "name": 'CD_DIRECAO',
                        "className": "visibleColumn",
                        "attr": {
                            "style": "width:30%;",
                        }
                    }, {
                        "responsivePriority": 3,
                        "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_designation; ?>",
                        "data": 'DSP_DIRECAO',
                        "name": 'DSP_DIRECAO',
                        "className": "visibleColumn",
                    }, {
                        "responsivePriority": 4,
                        "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_short_desig; ?>",
                        "data": 'DSR_DIRECAO',
                        "name": 'DSR_DIRECAO',
                        "className": "visibleColumn",
                    }, {
                        "responsivePriority": 5,
                        "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_begin_date; ?>", //Editor
                        "data": 'DT_INI_DIRECAO',
                        "name": 'DT_INI_DIRECAO',
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
                        "data": null,
                        "name": 'RECORD_HISTORY',
                        "type": "hidden",
                        "className": "none visibleColumn",
                        "render": function (val, type, row) {
                            return tablesRecordHistory(val, type, row);
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
                            return DG_DIRECOES.crudButtons(true, true, true);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "CD_DIRECAO": {
                            required: true,
                            maxlength: 8
                        },
                        "DSP_DIRECAO": {
                            required: true,
                            maxlength: 150
                        },
                        "DSR_DIRECAO": {
                            required: true,
                            maxlength: 25
                        },
                        "DT_INI_DIRECAO": {
                            required: true,
                            dateISO: true
                        },
                        "DT_INI_DIRECAO": {
                            required: true,
                            dateISO: true
                        },
                        "DT_FIM": {
                            dateISO: true,
                            dateEqOrNextThan: "DT_INI_DIRECAO",
                        }
                    },
                    "messages": {
                        "DT_FIM": {
                            dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                        }
                    }
                }
            };
            DG_DIRECOES = new QuadTable();
            DG_DIRECOES.initTable($.extend({}, datatable_instance_defaults, optionDG_DIRECOES));
            //END Direções

            //Departamentos
            var optionsDG_DEPARTAMENTOS = {
                "tableId": "DG_DEPARTAMENTOS",
                "table": "DG_DEPARTAMENTOS",
                "pk": {
                    "primary": {
                        "EMPRESA": {"type": "varchar"},
                        "CD_DIRECAO": {"type": "varchar"},
                        "DT_INI_DIRECAO": {"type": "date"},
                        "CD_DEPT": {"type": "varchar"},
                        "DT_INI_DEPT": {"type": "date"}
                    }
                },
                "dependsOn": {
                    "DG_DIRECOES": {
                        "EMPRESA": "EMPRESA",
                        "CD_DIRECAO": "CD_DIRECAO",
                        "DT_INI_DIRECAO": "DT_INI_DIRECAO"
                    }
                },
                "order_by": "CD_DEPT",
                "recordBundle": 3,
                "pageLenght": 3,
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
                        "type": "hidden",
                        "visible": false,
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'CD_DIRECAO',
                        "name": 'CD_DIRECAO',
                        "type": "hidden",
                        "visible": false,
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'DT_INI_DIRECAO',
                        "name": 'DT_INI_DIRECAO',
                        "datatype": "date",
                        "type": "hidden",
                        "visible": false
                    }, {
                        "responsivePriority": 2,
                        "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_code; ?>", //Editor
                        "data": 'CD_DEPT',
                        "name": 'CD_DEPT',
                        "className": "visibleColumn",
                    }, {
                        "responsivePriority": 3,
                        "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_designation; ?>",
                        "data": 'DSP_DEPT',
                        "name": 'DSP_DEPT',
                        "className": "visibleColumn",
                    }, {
                        "responsivePriority": 4,
                        "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_short_desig; ?>",
                        "data": 'DSR_DEPT',
                        "name": 'DSR_DEPT',
                        "className": "visibleColumn",
                    }, {
                        "responsivePriority": 5,
                        "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_begin_date; ?>", //Editor
                        "data": 'DT_INI_DEPT',
                        "name": 'DT_INI_DEPT',
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
                        "data": null,
                        "name": 'RECORD_HISTORY',
                        "type": "hidden",
                        "className": "none visibleColumn",
                        "render": function (val, type, row) {
                            return tablesRecordHistory(val, type, row);
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
                            return DG_DEPARTAMENTOS.crudButtons(true, true, true);
                        }
                    }
                ],
                validations: {
                    rules: {
                        "CD_DEPT": {
                            required: true,
                            maxlength: 8
                        },
                        "DSP_DEPT": {
                            required: true,
                            maxlength: 150,
                        },
                        "DSR_DEPT": {
                            required: true,
                            maxlength: 25,
                        },
                        "DT_INI_DEPT": {
                            required: true,
                            dateISO: true
                        },
                        "DT_FIM": {
                            dateISO: true,
                            dateEqOrNextThan: "DT_INI_DEPT",
                        }
                    },
                    "messages": {
                        "DT_FIM": {
                            dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                        }
                    }
                }
            };
            DG_DEPARTAMENTOS = new QuadTable();
            DG_DEPARTAMENTOS.initTable($.extend({}, datatable_instance_defaults, optionsDG_DEPARTAMENTOS));
            //END Departamentos

            //Entidades Internas
            var optionDG_ENTIDADES_INTERNAS = {
                "tableId": "DG_ENTIDADES_INTERNAS",
                "table": "DG_ENTIDADES_INTERNAS",
                "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_internal_entity; ?>",
                "pk": {
                    "primary": {
                        "EMPRESA": {"type": "varchar"},
                        "CD_ENT_INT": {"type": "varchar"}
                    }
                },
                "dependsOn": {
                    "DG_EMPRESAS": {
                        "EMPRESA": "EMPRESA"
                    }
                },
                "detailsObjects": ['DG_ENTIDADE_INTERNA_TRADS'],
                //"initialWhereClause": "",
                "order_by": "CD_ENT_INT",
                "recordBundle": 5,
                "pageLenght": 5,
                "scrollY": "156",
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
                        "visible": false
                    }, {
                        "responsivePriority": 2,
                        "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_code; ?>", //Editor
                        "data": 'CD_ENT_INT',
                        "name": 'CD_ENT_INT',
                        "className": "visibleColumn",
                        "attr": {
                            "style": "width:30%;",
                        }
                    }, {
                        "responsivePriority": 3,
                        "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_designation; ?>",
                        "data": 'DSP_ENT_INT',
                        "name": 'DSP_ENT_INT',
                        "className": "visibleColumn",
                    }, {
                        "responsivePriority": 4,
                        "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_short_desig; ?>",
                        "data": 'DSR_ENT_INT',
                        "name": 'DSR_ENT_INT',
                        "className": "visibleColumn",
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'CD_SITUACAO_EI',
                        "name": 'CD_SITUACAO_EI',
                        "type": "hidden",
                        "visible": false
                    }, {
                        "responsivePriority": 5,
                        "complexList": true,
                        "title": "<?php echo mb_strtoupper($ui_situation, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_situation; ?>",
                        "data": 'DSP_SITUACAO_EI',
                        "name": 'DSP_SITUACAO_EI',
                        "type": "select",
                        "className": "visibleColumn",
                        //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...
                        "attr": {
                            "dependent-group": "ENTIDADES_INTERNAS",
                            "dependent-level": 1,
                            "data-db-name": "A.CD_SITUACAO_EI",
                            "decodeFromTable": "DG_SITUACOES_EI A",  //TO CHANGE ON QUAD-HCM
                            "desigColumn": "A.DSP_SITUACAO_EI",
                            "orderBy": "A.CD_SITUACAO_EI",
                            "class": "form-control complexList chosen",
                            "filter": {
                                "create": " AND A.ACTIVO = 'S'", //On-New-Record
                                "edit": " AND A.ACTIVO = 'S'", //On-Edit-Record
                            }
                        }
                    }, {
                        "responsivePriority": 6,
                        "title": "<?php echo mb_strtoupper($ui_situation_dt, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_situation_dt; ?>", //Editor
                        "data": 'DT_SITUACAO',
                        "name": 'DT_SITUACAO',
                        "datatype": 'date',
                        "def": "1900-01-01",
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
                        "data": null,
                        "name": 'RECORD_HISTORY',
                        "type": "hidden",
                        "className": "none visibleColumn",
                        "render": function (val, type, row) {
                            return tablesRecordHistory(val, type, row);
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
                            return DG_ENTIDADES_INTERNAS.crudButtons(true, true, true);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "CD_ENT_INT": {
                            required: true,
                            maxlength: 10
                        },
                        "DSP_SITUACAO_EI": {
                            required: true
                        },
                        "DSP_ENT_INT": {
                            required: true,
                            maxlength: 40
                        },
                        "DSR_ENT_INT": {
                            required: false,
                            maxlength: 25
                        },
                        "DT_SITUACAO": {
                            required: true,
                            dateISO: true
                        }
                    }
                }
            };
            DG_ENTIDADES_INTERNAS = new QuadTable();
            DG_ENTIDADES_INTERNAS.initTable($.extend({}, datatable_instance_defaults, optionDG_ENTIDADES_INTERNAS));
            //END Entidades Internas

            //Entidades Internas :: Trads
            var optionDG_ENTIDADE_INTERNA_TRADS = {
                "tableId": 'DG_ENTIDADE_INTERNA_TRADS',
                "table": "DG_ENTIDADE_INTERNA_TRADS", // table in database
                "pk": {
                    "primary": {
                        "EMPRESA": {"type": "varchar"},
                        "CD_ENT_INT": {"type": "varchar"},
                        "CD_LINGUA": {"type": "number"},
                        "DT_INI": {"type": "date"}
                    }
                },
                "dependsOn": {
                    "DG_ENTIDADES_INTERNAS": {
                        //External object key mapping( object key : external key)
                        "EMPRESA": "EMPRESA",
                        "CD_ENT_INT": "CD_ENT_INT"
                    }
                },
                "order_by": "CD_LINGUA, DT_INI DESC",
                "order": false,
                "recordBundle": 4, // number of records returned by server on SELECT operation
                "pageLenght": 4, // for the moment use the same as recordBundle
                "scrollY": "117", //height in pixels -- mandatory,
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
                        "data": 'EMPRESA',
                        "name": 'EMPRESA',
                        "type": "hidden",
                        "visible": false
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'CD_ENT_INT',
                        "name": 'CD_ENT_INT',
                        "type": "hidden",
                        "visible": false
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'CD_LINGUA',
                        "name": 'CD_LINGUA',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "complexList": true,
                        "responsivePriority": 2,
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
                        "responsivePriority": 4,
                        "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_begin_date; ?>", //Editor
                        "data": 'DT_INI',
                        "name": 'DT_INI',
                        "datatype": 'date',
                        "def": "1900-01-01",
                        "width": "7%",
                        "attr": {//EDITOR CONTROL
                            "class": "datepicker" //dateTimePicker
                        }
                    }, {
                        "responsivePriority": 3,
                        "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_designation; ?>", //Editor
                        "data": 'DSP_TRAD',
                        "name": 'DSP_TRAD',
                    }, {
                        "responsivePriority": 3,
                        "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_short_desig; ?>", //Editor
                        "data": 'DSR_TRAD',
                        "name": 'DSR_TRAD',
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_end_date; ?>", //Editor
                        "data": 'DT_FIM',
                        "name": 'DT_FIM',
                        "datatype": 'date',
                        "width": "7%",
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
                            "style": "max-width: 335px;",
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
                        "data": null,
                        "name": 'RECORD_HISTORY',
                        "type": "hidden",
                        "className": "none visibleColumn",
                        "render": function (val, type, row) {
                            return tablesRecordHistory(val, type, row);
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
                            return DG_ENTIDADE_INTERNA_TRADS.crudButtons(true, true, true);
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
                            maxlength: 80,
                        },
                        "DSR_TRAD": {
                            maxlength: 25,
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
            DG_ENTIDADE_INTERNA_TRADS = new QuadTable();
            DG_ENTIDADE_INTERNA_TRADS.initTable($.extend({}, datatable_instance_defaults, optionDG_ENTIDADE_INTERNA_TRADS));
            //END Entidades Internas :: Trads

            //Estruturas
            var optionDG_ESTRUTURAS = {
                "tableId": "DG_ESTRUTURAS",
                "table": "DG_ESTRUTURAS",
                //"selectRecordMsg": "<?php echo $ui_please_select_record . $ui_structure; ?>",
                "pk": {
                    "primary": {
                        "EMPRESA": {"type": "varchar"},
                        "CD_ESTRUTURA": {"type": "number"},
                        "DT_INI_ESTRUTURA": {"type": "date"}
                    }
                },
                "dependsOn": {
                    "DG_EMPRESAS": {
                        "EMPRESA": "EMPRESA"
                    }
                },
                //"detailsObjects": [''],
                //"initialWhereClause": "",
                "order_by": "NVL(CD_ESTRUTURA_PAI, CD_ESTRUTURA), CD_ESTRUTURA",
                "recordBundle": 10,
                "pageLenght": 10,
                "scrollY": "351",
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
                        "visible": false
                    }, {
                        "responsivePriority": 2,
                        "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_code; ?>", //Editor
                        "data": 'CD_ESTRUTURA',
                        "name": 'CD_ESTRUTURA',
                        "className": "visibleColumn",
                        "attr": {
                            "style": "width:30%;",
                        }
                    }, {
                        "responsivePriority": 3,
                        "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_designation; ?>",
                        "data": 'DSP_ESTRUTURA',
                        "name": 'DSP_ESTRUTURA',
                        "className": "visibleColumn",
                    }, {
                        "responsivePriority": 4,
                        "title": "<?php echo mb_strtoupper($ui_acronym, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_acronym; ?>",
                        "data": 'SIGLA_ESTRUTURA',
                        "name": 'SIGLA_ESTRUTURA',
                        "className": "visibleColumn",
                    }, {
                        "responsivePriority": 5,
                        "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_begin_date; ?>", //Editor
                        "data": 'DT_INI_ESTRUTURA',
                        "name": 'DT_INI_ESTRUTURA',
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
                        "data": 'DT_FIM_ESTRUTURA',
                        "name": 'DT_FIM_ESTRUTURA',
                        "datatype": 'date',
                        "className": "visibleColumn",
                        "attr": {
                            "class": "datepicker"
                        }
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'CD_ESTRUTURA_PAI',
                        "name": 'CD_ESTRUTURA_PAI',
                        "type": "hidden",
                        "visible": false
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'DT_INI_ESTRUTURA_PAI',
                        "name": 'DT_INI_ESTRUTURA_PAI',
                        "datatype": "date",
                        "type": "hidden",
                        "visible": false
                    }, {
                        "complexList": true,
                        "responsivePriority": 1,
                        "title": "<?php echo mb_strtoupper($ui_parent_structure, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_parent_structure; ?>",
                        "data": 'DSP_ESTRUTURA_PAI',
                        "name": 'DSP_ESTRUTURA_PAI',
                        "type": "select",
                        "className": "visibleColumn",
                        "attr": {
                            "deferred": true,
                            "dependent-group": "ESTRUTURA",
                            "dependent-level": 1,
                            "data-db-name": 'A.EMPRESA@A.CD_ESTRUTURA@A.DT_INI_ESTRUTURA',
                            "distribute-value": "EMPRESA@CD_ESTRUTURA_PAI@DT_INI_ESTRUTURA_PAI",
                            "decodeFromTable": 'DG_ESTRUTURAS A',
                            "class": "form-control complexList chosen",
                            "desigColumn": "A.DSP_ESTRUTURA",
                            "orderBy": "A.CD_ESTRUTURA",
                            "filter": {
                                "create": " AND A.DT_FIM_ESTRUTURA IS NULL AND A.EMPRESA = ':EMPRESA' AND (A.EMPRESA,A.CD_ESTRUTURA,A.DT_INI_ESTRUTURA) NOT IN ((':EMPRESA', ':CD_ESTRUTURA', ':DT_INI_ESTRUTURA')) ", //On-New-Record
                                "edit": " AND A.DT_FIM_ESTRUTURA IS NULL AND A.EMPRESA = ':EMPRESA' AND (A.EMPRESA,A.CD_ESTRUTURA,A.DT_INI_ESTRUTURA) NOT IN ((':EMPRESA', ':CD_ESTRUTURA', ':DT_INI_ESTRUTURA')) ", //On-Edit-Record
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
                        "data": null,
                        "name": 'RECORD_HISTORY',
                        "type": "hidden",
                        "className": "none visibleColumn",
                        "render": function (val, type, row) {
                            return tablesRecordHistory(val, type, row);
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
                            return DG_ESTRUTURAS.crudButtons(true, true, true);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "CD_ESTRUTURA": {
                            required: true,
                            integer: true,
                            maxlength: 10
                        },
                        "DSP_ESTRUTURA": {
                            required: true,
                            maxlength: 80
                        },
                        "SIGLA_ESTRUTURA": {
                            required: true,
                            maxlength: 15
                        },
                        "DT_INI_ESTRUTURA": {
                            required: true,
                            dateISO: true
                        },
                        "DT_INI_DIRECAO": {
                            required: true,
                            dateISO: true
                        },
                        "DT_FIM_ESTRUTURA": {
                            dateISO: true,
                            dateEqOrNextThan: "DT_INI_ESTRUTURA"
                        }
                    },
                    "messages": {
                        "DT_FIM_ESTRUTURA": {
                            dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                        }
                    }
                }
            };
            DG_ESTRUTURAS = new QuadTable();
            DG_ESTRUTURAS.initTable($.extend({}, datatable_instance_defaults, optionDG_ESTRUTURAS));
            //END Estruturas
        }
        //END Instance Definition

        //Events Definition
        if (1 === 1) {
            /* QUADFORMS :: Empresas Continued :: DOUBLE-CLICK -> EDIT RECORD */
            $('#DG_EMPRESAS_CONTINUED').dblclick(function () {
                var el = $("#DG_EMPRESAS_CONTINUED").find("[data-form-action='edit']");
                if (el.css('display') !== 'none' && (el.attr('disabled') === undefined || el.attr('disabled') === false)) { //SÓ SE O BOTÃO ESTIVER VISÍVEL e ENABLED
                    el.trigger('click');
                }
            });
        }
        //END Events Definition

    });
</script>
