<?php
    require_once '../init.php';
?>
<style>
    #RH_ID_RECIBOS {
        width:100%;
    }
    /* HEIGHT "MESES" */
    #panel-1 > div.panel-container.show > div.panel-content {
        min-height: 44.3vh;
    }

    i.ni.ni-energy {
        margin-left: -0.7rem;
        margin-right: 0.7rem!important;
        vertical-align: middle;
        font-weight: 600;
    }

    #show_diffs {
        float: right;
        width: 16px;
        height: 16px;
    }

    #DG_MESES_wrapper {
        margin-top: -6px;
    }

</style>
<div class="row">
    <!-- PERIODO FISCAL -->
    <div class="col-xl-3 pl-1 pr-1">
        <div id="panel-1" class="panel">

            <div class="panel-hdr">
                <span class="widget-icon"> <i class="fal fa-calendar"></i></span>&nbsp;
                <h2><?php echo $ui_years_months; ?></h2>
            </div>

            <div class="panel-container show">

                <div class="panel-content">
                    <form id="empresaChoice" class="form-inline col-md-8 extendedForm" style="margin-top: -8px; padding-left: 3px;display: inline-flex;">
                        <div class="form-group">
                            <label  for="xt_DSP_EMPRESA" class="">
                                <?php echo $ui_company; ?></label>
                            <select name="DSP_EMPRESA" dependent-level="1" dependent-group="EMPRESA" id="xt_DSP_EMPRESA" class="form-control complexList" style="margin-left: 1em;"></select>
                        </div>

                        <div class='alert alert-danger fade in quadAlert' style="display:none;"></div>
                    </form>

                    <a id="DG_MESES_dtAdvancedSearch" title="<?php echo $ui_query; ?>" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed" data-toggle="modal" href="#" data-target="#modalForm">
                        <i class="fas fa-search fa-flip-horizontal"></i>
                    </a>
                    <table id="DG_MESES" class="table responsive table-bordered table-striped table-hover responsive nowrap meses"></table>
                </div>


                <div class="panel-hdr" style="border-top: 1px solid rgba(0,0,0,.07);margin-top: -8px;">
                    <span class="widget-icon"> <i class="far fa-list-ol"></i></span>&nbsp;
                    <h2><?php echo $ui_periods; ?></h2>
                </div>


                <div class="panel-container show">
                    <div class="panel-content">
                        <a id="RHID_PERIODOS_VIEW_dtAdvancedSearch" title="<?php echo $ui_query; ?>" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed" data-toggle="modal" href="#" data-target="#modalForm">
                            <i class="fas fa-search fa-flip-horizontal"></i>
                        </a>
                        <table id="RHID_PERIODOS_VIEW" class="table responsive table-bordered table-striped table-hover responsive nowrap meses"></table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- RECIBO LÓGICO -->
    <div class="col-xl-9">
        <div id="panel-2" class="panel">

            <div class="panel-hdr">
                <span class="widget-icon"> <i class="fal fa-table"></i></span>&nbsp;
                <h2><?php echo $ui_logical_receipt; ?></h2>
            </div>

            <div class="panel-container show">
                <!-- FILTRO RECIBO LÓGICO -->
                <div class="panel-content">
                    <form id="employeeFilter" style="height: 16vh;display: contents;" class=" multiInstance">
                        <div class="form-row form-group mb-0">
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="xt_RHID"><?php echo $ui_rhid; ?></label>
                                <select name="RHID" id="xt_RHID" class="form-control required"></select>
                            </div>

                            <div class="col-md-2 mb-3">
                                <label class="form-label" for="xt_DT_ADMISSAO"><?php echo $ui_dt_admission; ?></label>
                                <select name="DT_ADMISSAO" id="xt_DT_ADMISSAO" class="form-control required"></select>
                            </div>
                            <!-- REMOVING ATTRIBUTE NAME, EXCLUDES DENORMALIZED FIELDS FROM FK TO PERIODOS -->
                            <div class="col-md-2 mb-3">
                                <label class="form-label" for="DT_DEMISSAO"><?php echo $ui_dt_resignation; ?></label>
                                <input id="DT_DEMISSAO" class="form-control" disabled>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="DSP_SITUACAO"><?php echo $ui_situation; ?></label>
                                <input id="DSP_SITUACAO" class="form-control" disabled>
                            </div>

                        </div>
                        <div class="form-row form-group mb-0">
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="DSP_CONTRATO"><?php echo $ui_contractual_bond; ?></label>
                                <input id="DSP_CONTRATO" class="form-control" disabled>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="DSP_ESTAB"><?php echo $ui_establishment; ?></label>
                                <input id="DSP_ESTAB" class="form-control" disabled>
                            </div>
                            <div class="col-md-2 mb-3">

                                <div class="btn-group float-xl-right">
                                        <button id="proc_actions" type="button" class="btn btn-primary dropdown-toggle waves-effect waves-themed mt-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="ni ni-energy mr-1"></i><?php echo $ui_operations; ?>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-animated fadeindown">

                                            <div class="dropdown-item" href="javascript:void(0)">
                                                <?php echo $ui_differences; ?>
                                                <input type="checkbox" id="show_diffs">
                                            </div>

                                            <div class="dropdown-divider" style="margin: .25rem 0;"></div>
                                            <div class="dropdown-multilevel dropdown-menu-animated dropdown-multilevel-left">
                                                <div class="dropdown-item"><?php echo $ui_pay_slip_short; ?></div>
                                                <div class="dropdown-menu fadeinup">
                                                    <button id="rl_calc" class="dropdown-item quad-process" type="button"><?php echo $ui_calculation; ?></button>
                                                    <button id="rl_emit" class="dropdown-item quad-process" type="button"><?php echo $ui_emission; ?></button>
                                                    <div class="dropdown-divider" style="margin: .25rem 0;"></div>
                                                    <button class="dropdown-item disabled" type="button"><?php echo $ui_cells; ?></button>
                                                    <div class="dropdown-divider" style="margin: .25rem 0;"></div>
                                                    <button id="rl_remove" class="dropdown-item quad-process" type="button" style="margin-bottom: .525rem;"><?php echo $ui_removal; ?></button>
                                                </div>
                                            </div>

                                            <div class="dropdown-divider" style="margin: .25rem 0;"></div>
                                            <a id="open_cad" class="dropdown-item" href="javascript:void(0)"><?php echo $ui_cadastre; ?></a>

                                            <div class="dropdown-divider" style="margin: .25rem 0;"></div>
                                            <div class="dropdown-multilevel dropdown-multilevel-left">
                                                <div class="dropdown-item"><?php echo $ui_proportionate; ?></div>
                                                <div class="dropdown-menu fadeinleft">
                                                    <button id="prop_calc" class="dropdown-item quad-process" type="button"><?php echo $ui_calculation; ?></button>
                                                    <button id="prop_remove" class="dropdown-item quad-process" type="button"><?php echo $ui_removal; ?></button>
                                                    <div class="dropdown-divider" style="margin: .25rem 0;"></div>
                                                    <button id="prop_simulation" class="dropdown-item quad-process disabled" type="button"><?php echo $ui_simulation; ?></button>
                                                </div>
                                            </div>


                                            <div class="dropdown-divider" style="margin: .25rem 0;"></div>
                                            <div class="dropdown-multilevel dropdown-multilevel-left">
                                                <div class="dropdown-item"><?php echo $ui_retroactive; ?></div>
                                                <div class="dropdown-menu fadeinleft">
                                                    <button id="retro_calc" class="dropdown-item quad-process" type="button"><?php echo $ui_execution; ?></button>
                                                    <button id="retro_replace" class="dropdown-item quad-process" type="button"><?php echo $ui_replacement; ?></button>
                                                </div>
                                            </div>
                                        </div>
                                </div>

                            </div>
                        </div>
                    </form>

                </div>
                <!-- END FILTRO RECIBO LÓGICO -->

                <!-- TABS MENUS -->
                <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-end">
                    <div class="panel-toolbar pr-3 align-self-end">
                        <ul id="demo_panel-tabs" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#Tab1" role="tab" aria-selected="true"> <?php echo $ui_payroll_items; ?> </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#Tab2" role="tab" aria-selected="true"> <?php echo $ui_incidences; ?> </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#Tab3" role="tab" aria-selected="true"> <?php echo $ui_discounts; ?> </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#Tab4" role="tab" aria-selected="true"> <?php echo $ui_data; ?> </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#Tab5" role="tab" aria-selected="true"> <?php echo $ui_journal; ?> </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#Tab6" role="tab" aria-selected="true"> <?php echo $ui_cells; ?> </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- END TABS MENU -->

                <!-- TABS CONTENT -->
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="tab-content">

                            <div class="tab-pane fade active show" id="Tab1" role="tabpanel">
                                <a id="RH_ID_RUBRICAS_dtAdvancedSearch" title="<?php echo $ui_query; ?>" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed" data-toggle="modal" href="#" data-target="#modalForm"><i class="fas fa-search fa-flip-horizontal"></i></a>
                                <table id="RH_ID_RUBRICAS" class="table responsive table-bordered table-striped table-hover responsive nowrap meses"></table>
                            </div>

                            <div class="tab-pane fade" id="Tab2" role="tabpanel">
                                <a id="RH_ID_INCIDENCIAS_dtAdvancedSearch" title="<?php echo $ui_query; ?>" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed" data-toggle="modal" href="#" data-target="#modalForm"><i class="fas fa-search fa-flip-horizontal"></i></a>
                                <table id="RH_ID_INCIDENCIAS" class="table responsive table-bordered table-striped table-hover responsive nowrap meses"></table>
                            </div>

                            <div class="tab-pane fade" id="Tab3" role="tabpanel">
                                <a id="RH_ID_DESCONTOS_dtAdvancedSearch" title="<?php echo $ui_query; ?>" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed" data-toggle="modal" href="#" data-target="#modalForm"><i class="fas fa-search fa-flip-horizontal"></i></a>
                                <table id="RH_ID_DESCONTOS" class="table responsive table-bordered table-striped table-hover responsive nowrap meses"></table>
                            </div>

                            <div class="tab-pane fade" id="Tab4" role="tabpanel">
                                            <div class="row" style="margin-top: -27px; padding: 1rem 1rem;">
                                                <form action="" id="RH_ID_RECIBOS" class="form-horizontal" novalidate="novalidate">
                                                <div class="quad-alert"></div>
<!--                                                    <form-toolbar></form-toolbar>-->
                                                    <fieldset style="display:none;">
                                                        <input class="form-control" name="ILIQUIDO_DIF">
                                                        <input class="form-control" name="ILIQUIDO">
                                                        <input class="form-control" name="DESCONTO_COLAB_DIF">
                                                        <input class="form-control" name="DESCONTO_COLAB">
                                                        <input class="form-control" name="DESCONTO_EP_DIF">
                                                        <input class="form-control" name="DESCONTO_EP">
                                                        <input class="form-control" name="LIQUIDO_DIF">
                                                        <input class="form-control" name="LIQUIDO">
                                                    </fieldset>
                                                    <fieldset>
                                                        <legend><?php echo $ui_cirs . ' & '. $ui_net_income; ?></legend>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="col-md-2 control-label" for="TP_IRS"><?php echo $ui_type; ?></label>
                                                                    <div class="col-md-2">
                                                                        <select class="form-control domainLists chosen" name="TP_IRS"></select>
<!--                                                                            <input class="form-control" name="TP_IRS">-->
                                                                    </div>

                                                                    <label class="col-md-1 control-label" for="TABELA_IRS"><?php echo $ui_table; ?></label>
                                                                    <div class="col-md-2">
                                                                        <select class="form-control domainLists chosen" name="TABELA_IRS"></select>
<!--                                                                        <input class="form-control" name="TABELA_IRS">-->
                                                                    </div>

                                                                    <label class="col-md-1 control-label" for="ANO_TAB_IRS"><?php echo $ui_year; ?></label>
                                                                    <div class="col-md-1">
                                                                        <input class="form-control quad-ml-4 toRight" name="ANO_TAB_IRS">
                                                                    </div>

                                                                    <label class="col-md-1 control-label" for="NR_TITULARES"><?php echo $ui_number_of_holders; ?></label>
                                                                    <div class="col-md-1">
                                                                        <input class="form-control quad-ml-4 toRight" name="NR_TITULARES">
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="col-md-2 control-label" for="EST_CIVIL_IRS"><?php echo $ui_cirs_status; ?></label>
                                                                    <div class="col-md-2">
                                                                        <select class="form-control domainLists chosen" name="EST_CIVIL_IRS"></select>
                                                                    </div>

                                                                    <label class="col-md-1 control-label" for="DEFICIENTE"><?php echo $ui_disability_degree_short; ?></label>
                                                                    <div class="col-md-2">
                                                                        <select class="form-control domainLists chosen" name="DEFICIENTE"></select>
                                                                    </div>

                                                                    <label class="col-md-1 control-label" for="TX_FIXA_IRS"><?php echo $ui_flat_rate; ?></label>
                                                                    <div class="col-md-1">
                                                                        <input class="form-control quad-ml-4 toRight" name="TX_FIXA_IRS">
                                                                    </div>

                                                                    <label class="col-md-1 control-label" for="NR_DEPENDENTES"><?php echo $ui_dependants_number; ?></label>
                                                                    <div class="col-md-1">
                                                                        <input class="form-control quad-ml-4 toRight" name="NR_DEPENDENTES">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="col-md-2 control-label" for="NR_DEPEND_DEFIC"><?php echo $ui_disabled_dependents; ?></label>
                                                                    <div class="col-md-1">
                                                                        <input class="form-control quad-ml-4 toRight" name="NR_DEPEND_DEFIC">
                                                                    </div>

                                                                    <label class="col-md-2 control-label" for="LIQUIDO_CONTRATADO"><?php echo $ui_net_income_short; ?></label>
                                                                    <div class="col-md-2">
                                                                        <input class="form-control quad-ml-4 toRight" name="LIQUIDO_CONTRATADO">
                                                                    </div>

                                                                    <label class="col-md-2 control-label" for="LIM_INCID_SS"><?php echo $ui_ss_incidence_limit; ?></label>
                                                                    <div class="col-md-2">
                                                                        <input class="form-control quad-ml-4 toRight" name="LIM_INCID_SS">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>


                                                    <fieldset>
                                                        <legend><?php echo $ui_payment_mode; ?></legend>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="col-md-2 control-label" for="FORMA_PAGAMENTO"><?php echo $ui_method; ?></label>
                                                                    <div class="col-md-3">
                                                                        <select class="form-control domainLists chosen" name="FORMA_PAGAMENTO"></select>
                                                                    </div>


                                                                    <label class="col-md-2 control-label" for="NIB"><?php echo $ui_iban_short; ?></label>
                                                                    <div class="col-md-3">
                                                                        <input class="form-control quad-ml-4 iban" name="NIB">
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>

                                                    <fieldset>
                                                        <legend><?php echo $ui_documents; ?></legend>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">

                                                                    <label class="col-md-2 control-label" for="NIF"><?php echo $ui_nif_short; ?></label>
                                                                    <div class="col-md-3">
                                                                        <input class="form-control domainLists chosen" name="NIF">
                                                                    </div>


                                                                    <label class="col-md-2 control-label" for="SS"><?php echo $ui_ss_number; ?></label>
                                                                    <div class="col-md-3">
                                                                        <input class="form-control quad-ml-4 iban" name="SS">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                </form>
                                            </div>

                            </div>

                            <div class="tab-pane fade" id="Tab5" role="tabpanel">
                                <a id="RH_ID_DIARIO_dtAdvancedSearch" title="<?php echo $ui_query; ?>" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed" data-toggle="modal" href="#" data-target="#modalForm"><i class="fas fa-search fa-flip-horizontal"></i></a>
                                <table id="RH_ID_DIARIO" class="table responsive table-bordered table-striped table-hover responsive nowrap meses"></table>
                            </div>

                            <div class="tab-pane fade" id="Tab6" role="tabpanel">
                                <a id="RH_ID_CELULAS_VALUES_dtAdvancedSearch" title="<?php echo $ui_query; ?>" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed" data-toggle="modal" href="#" data-target="#modalForm"><i class="fas fa-search fa-flip-horizontal"></i></a>
                                <table id="RH_ID_CELULAS_VALUES" class="table responsive table-bordered table-striped table-hover responsive nowrap meses"></table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ENDS TABS CONTENT -->

                <!-- FOOTER -->
                <div class="panel-container show">
                    <div class="panel-content">
                        <table id="totais" class="table">
                            <thead style="background-color: #f0f2f8;">
                                <tr>
                                    <th></th>
                                    <th class="tit"><?php echo mb_strtoupper($ui_gross_income_short, 'UTF-8'); ?></th>
                                    <th class="tit"><?php echo mb_strtoupper($ui_discounts, 'UTF-8'); ?></th>
                                    <th class="tit"><?php echo mb_strtoupper($ui_net_income_short, 'UTF-8'); ?></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th><?php echo $ui_period; ?></th>
                                    <td id="per_iliq" class="data"></td>
                                    <td id="per_desct" class="data"></td>
                                    <td id="per_liq" class="data"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th><?php echo $ui_month; ?></th>
                                    <td id="mon_iliq" class="data"></td>
                                    <td id="mon_desct" class="data" ></td>
                                    <td id="mon_liq" class="data"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th><?php echo $ui_pay_slip_short; ?></th>
                                    <td id="tot_iliq" class="data"></td>
                                    <td id="tot_desct" class="data"></td>
                                    <td id="tot_liq" class="data"></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- FOOTER -->
            </div>
        </div>
    </div>

</div>

<div class="row">

</div>

<script>
    $(document).ready(function () {
        //TABLES
        if (1 === 1) {
              //Meses
            var optionsDG_MESES = {
                "tableId": "DG_MESES",
                "table": "DG_MESES",
                "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_rhid; ?>",
                "pk": {
                    "primary": {
                        "EMPRESA": {"type": "varchar"},
                        "ANO": {"type": "number"},
                        "MES": {"type": "number"}
                    }
                },
                "crudOnMasterInactive": {
                    "condition": " (data.RH_ESTADO !== 'A' && data.RH_ESTADO !== 'B') ",
                    "acl": {
                        "create": false,
                        "update": false,
                        "delete": false
                    }
                },
                "externalFilter": {
                    "template": {
                        "selector": "#empresaChoice",
                        "mandatory": ['DSP_EMPRESA']
                    }
                },
                "initialWhereClause": " RH_ESTADO != 'D' ",
                "order_by": "EMPRESA, ANO DESC, MES ASC",
                "recordBundle": 40,
                "pageLenght": 40,
                "scrollY": "440",
                "detailsObjects": ['RHID_PERIODOS_VIEW','RH_ID_DIARIO'],
                "export": false,
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
                        "complexList": true,
                        "title": "<?php echo mb_strtoupper($ui_company, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_company; ?>",
                        "data": 'DSP_EMPRESA',
                        "name": 'DSP_EMPRESA',
                        "type": "select",
                        "className": "visibleColumn",
                        "width": "1%",
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
                        "responsivePriority": 2,
                        "title": "<?php echo mb_strtoupper($ui_year, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_year; ?>", //Editor
                        "data": 'ANO',
                        "name": 'ANO',
                        "className": "right visibleColumn",
                        "width": "1%",
                        "attr": {
                            "style": "width:25%;"
                        }
                    }, {
                        "responsivePriority": 3,
                        "title": "<?php echo mb_strtoupper($ui_month, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_month; ?>", //Editor
                        "data": 'MES',
                        "name": 'MES',
                        "className": "right visibleColumn",
                        "width": "1%",
                        "attr": {
                            "style": "width:25%;"
                        }
    //                }, {
    //                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
    //                    "label": "<?php echo $ui_begin_date; ?>", //Editor
    //                    "data": 'RH_DT_INICIO',
    //                    "name": 'RH_DT_INICIO',
    //                    "datatype": 'date',
    //                    "def": "1900-01-01",
    //                    "className": "none visibleColumn",
    //                    "attr": {
    //                        "class": "datepicker"
    //                    }
    //                }, {
    //                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
    //                    "label": "<?php echo $ui_end_date; ?>", //Editor
    //                    "data": 'RH_DT_FIM',
    //                    "name": 'RH_DT_FIM',
    //                    "datatype": 'date',
    //                    "className": "none visibleColumn",
    //                    "attr": {
    //                        "class": "datepicker"
    //                    }
                    }, {
                        "responsivePriority": 4,
                        "title": "<?php echo mb_strtoupper($ui_status, 'UTF-8'); ?>", //Datatables :: Original
                        "label": "<?php echo $ui_status; ?>", //Editor
                        "data": 'RH_ESTADO',
                        "name": 'RH_ESTADO',
                        "type": "select",
                        "def": "N",
                        "className": "visibleColumn",
                        "width": "1%",
                        "attr": {
                            "domain-list": true,
                            "dependent-group": 'DG_MESES.RH_ESTADO',
                            "class": "form-control"
                        },
                        "render": function (val, type, row) {
                            if (val != null) {
                                var o = _.find(initApp.joinsData['DG_MESES.RH_ESTADO'], {'RV_LOW_VALUE': val});
                                var dsp = (null ? null : o['RV_ABBREVIATION']);
                                if (row['RH_ESTADO'] === 'A') { //Aberto
                                    return '<span class="label label-success">' + dsp + '</span>';
                                } else if (row['RH_ESTADO'] === 'B') { //Em Processamento
                                    row['CURRENT'] = 'S';
                                    return '<span class="label current-month" style="background-color: #3b9ff3;">' + dsp + '</span>';
                                } else if (row['RH_ESTADO'] === 'C') { //Encerrado
                                    return '<span class="label label-danger">' + dsp + '</span>';
                                } else if (row['RH_ESTADO'] === 'D') { //Fechado
                                    return '<span class="label label-info">' + dsp + '</span>';
                                }
                            }
                            return val;
                        }
    //                }, {
    //                    "title": "", //Datatables
    //                    "label": "", //Editor
    //                    "data": 'INSERTED_BY',
    //                    "name": 'INSERTED_BY',
    //                    "type": "hidden", //Editor
    //                    "visible": false, //DataTables
    //                }, {
    //                    "title": "", //Datatables
    //                    "label": "", //Editor
    //                    "data": 'DT_INSERTED',
    //                    "name": 'DT_INSERTED',
    //                    "type": "hidden", //Editor
    //                    "visible": false, //DataTables
    //                }, {
    //                    "title": "", //Datatables
    //                    "label": "", //Editor
    //                    "data": 'CHANGED_BY',
    //                    "name": 'CHANGED_BY',
    //                    "type": "hidden", //Editor
    //                    "visible": false, //DataTables
    //                }, {
    //                    "title": "", //Datatables
    //                    "label": "", //Editor
    //                    "data": 'DT_UPDATED',
    //                    "name": 'DT_UPDATED',
    //                    "type": "hidden", //Editor
    //                    "visible": false, //DataTables
    //                }, {
    //                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions, 'UTF-8'); ?>" + '</span>',
    //                    "label": '',
    //                    "data":  null,
    //                    "name": 'RECORD_HISTORY',
    //                    "type": "hidden",
    //                    "className": "none visibleColumn",
    //                    "render": function (val, type, row) {
    //                        return tablesRecordHistory (val, type, row);
    //                    }
    //                }, {
    //                    "responsivePriority": 1,
    //                    "data": null,
    //                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
    //                    "name": 'BUTTONS',
    //                    "type": "hidden",
    //                    "width": "6%",
    //                    "className": "toBottom toCenter",
    //                    "render": function () {
    //                        //debugger;
    //                        return DG_MESES.crudButtons(false,false,false);
    //                    }
                    }
                ],
                "drawCallback": function (settings) {
                    //console.log('drawCallback');
                    //console.log(setting);
                    //SELECT ROW :: MÊS EM PROCESSAMENTO
                    setTimeout( function(){
                        DG_MESES.tbl.rows().every (function (rowIdx, tableLoop, rowLoop) {
                            if (this.data().RH_ESTADO === 'B') {
                                this.select ();
                            }
                        });
                    },500);
                },
            };
            DG_MESES = new QuadTable();
            DG_MESES.initTable($.extend({}, datatable_instance_defaults, optionsDG_MESES));
            //END Meses

            //Periodos
            var optionsRHID_PERIODOS_VIEW = {
                "tableId": "RHID_PERIODOS_VIEW",
                "table": "RHID_PERIODOS_VIEW",
                "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_period; ?>",
                "pk": {
                    "primary": {
                        "EMPRESA": {"type": "varchar"},
                        "ANO": {"type": "number"},
                        "MES": {"type": "number"},
                        "ID_PERIODO": {"type": "number"},
                        "RHID": {"type": "number"},
                        "DT_ADMISSAO": {"type": "date"}
                    }
                },
                "dependsOn": {
                    "DG_MESES": {
                        "EMPRESA": "EMPRESA",
                        "ANO": "ANO",
                        "MES": "MES"
                    }
                },
                "externalFilter": {
                    "templateMulti": {
                        "selector": "#employeeFilter",
                        "mandatory": ['RHID', 'DT_ADMISSAO'],
                        "optional": ['']
                    }
                },
//                "crudOnMasterInactive": {
//                    "condition": " (data.ESTADO !== 'S') ",
//                    "acl": {
//                        "create": false,
//                        "update": false,
//                        "delete": false
//                    }
//                },
                "order_by": "ID_PERIODO",
                "recordBundle": 5,
                "pageLenght": 5,
                "scrollY": "130",
                "detailsObjects": ['RH_ID_RUBRICAS','RH_ID_INCIDENCIAS','RH_ID_DESCONTOS','RH_ID_RECIBOS','RH_ID_CELULAS_VALUES'],
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
                        "data": 'ANO',
                        "name": 'ANO',
                        "type": "hidden",
                        "visible": false
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'MES',
                        "name": 'MES',
                        "type": "hidden",
                        "visible": false
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'RHID',
                        "name": 'RHID',
                        "type": "hidden",
                        "visible": false
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'DT_ADMISSAO',
                        "name": 'DT_ADMISSAO',
                        "type": "hidden",
                        "visible": false,
                        "datatype": 'date'
                    }, {
                        "responsivePriority": 2,
                        "title": "<?php echo mb_strtoupper($ui_id, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_id; ?>", //Editor
                        "data": 'ID_PERIODO',
                        "name": 'ID_PERIODO',
                        "className": "right visibleColumn",
//                        "attr": {
//                            "style": "width:25%;"
//                        }
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_designation; ?>", //Editor
                        "data": 'DSP_PERIODO',
                        "name": 'DSP_PERIODO',
                        "className": "none visibleColumn",
                    }, {
                        "responsivePriority": 3,
                        "title": "<?php echo mb_strtoupper($ui_open, 'UTF-8'); ?>", //Datatables :: Original
                        "label": "<?php echo $ui_open; ?>", //Editor
                        "data": 'ABERTO',
                        "name": 'ABERTO',
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
                        "responsivePriority": 4,
                        "title": "<?php echo mb_strtoupper($ui_reference_dt_short, 'UTF-8'); ?>", //Datatables :: Original
                        "label": "<?php echo $ui_reference_dt_short; ?>", //Editor
                        "data": 'ANO_MES_LANCAMENTO',
//                        "name": 'ANO_MES_LANCAMENTO',
                        "className": "visibleColumn",

                    }, {
                        "responsivePriority": 5,
                        "title": "<?php echo mb_strtoupper($ui_occurrences_short, 'UTF-8'); ?>", //Datatables :: Original
                        "label": "<?php echo $ui_occurrences_short; ?>", //Editor
                        "data": 'COM_OCORRENCIA',
                        "name": 'COM_OCORRENCIA',
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
                        "responsivePriority": 1,
                        "data": null,
                        "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                        "name": 'BUTTONS',
                        "type": "hidden",
                        "width": "6%",
                        "className": "toBottom toCenter",
                        "render": function () {
                            //debugger;
                            return RHID_PERIODOS_VIEW.crudButtons(false,true,false);
                        }
                    }
                ],
                "drawCallback": function (settings) {
                    //SELECT ROW :: MÊS EM PROCESSAMENTO
                    setTimeout( function(){
                        RHID_PERIODOS_VIEW.tbl.rows().every (function (rowIdx, tableLoop, rowLoop) {
                            if (this.data().ABERTO === 'S') {
                                this.select ();
                                getTotaisRecibo();
                            }
                        });
                    },500);
                },
                validations: {
                    rules: {
                        ID_PERIODO: {
                            required: true,
                            maxlength: 10
                        },
                        DSP_PERIODO: {
                            required: true,
                            maxlength: 40
                        },
                        DSR_PERIODO: {
                            required: true,
                            maxlength: 25
                        },
                        ABERTO: {
                            required: true
                        },
                        PRINCIPAL: {
                            required: true
                        },
                        "DT_VALOR": {
                            required: true,
                            dateISO: true,
                        },
                        FECHO: {
                            required: true
                        },
                        RETRO_ID: {
                            maxlength: 10
                        },
                    },
                    "messages": {
                        "RH_DT_FIM": {
                            dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                        }
                    }
                }
            };
            RHID_PERIODOS_VIEW = new QuadTable();
            RHID_PERIODOS_VIEW.initTable($.extend({}, datatable_instance_defaults, optionsRHID_PERIODOS_VIEW));
            //END Periodos

            //Rubricas
            var optionsRH_ID_RUBRICAS = {
                "externalFilter": {
                    "templateMulti": {
                        "selector": "#employeeFilter",
                        "mandatory": ['RHID', 'DT_ADMISSAO'],
                        "optional": ['']
                    }
                },
                "tableId": "RH_ID_RUBRICAS",
                "table": "RH_ID_RUBRICAS",
                "inlineOp": {
                    edit: true,
                    create: true
                },
                "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_month; ?>",
                "pk": {
                    "primary": {
                        "EMPRESA": {"type": "varchar"},
                        "ANO": {"type": "number"},
                        "MES": {"type": "number"},
                        "ID_PERIODO": {"type": "number"},
                        "RHID": {"type": "number"},
                        "DT_ADMISSAO": {"type": "date"},
                        "CD_RUBRICA": {"type": "varchar"},
                        "SEQ_": {"type": "number"},
                    }
                },
                "dependsOn": {
                    "RHID_PERIODOS_VIEW": {
                        "EMPRESA": "EMPRESA",
                        "ANO": "ANO",
                        "MES": "MES",
                        "ID_PERIODO": "ID_PERIODO",
                        "RHID": "RHID",
                        "DT_ADMISSAO": "DT_ADMISSAO"
                    }
                },
                "order_by": "TO_NUMBER(CD_RUBRICA), DT_REFERENCIA",
                "recordBundle": 7,
                "pageLenght": 7,
                "scrollY": "264",
                //"detailsObjects": ['RH_DEF_PERIODOS'],
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
                        "data": 'ANO',
                        "name": 'ANO',
                        "type": "hidden",
                        "visible": false
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'MES',
                        "name": 'MES',
                        "type": "hidden",
                        "visible": false
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
                        "data": 'RHID',
                        "name": 'RHID',
                        "type": "hidden",
                        "visible": false
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'ID_PERIODO',
                        "name": 'ID_PERIODO',
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
                        "responsivePriority": 2,
                        "complexList": true,
                        "title": "<?php echo mb_strtoupper($ui_wage_item, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_wage_item; ?>",
                        "data": 'DSP_RUBRICA',
                        "name": 'DSP_RUBRICA',
                        "type": "select",
                        "className": "visibleColumn",
                        //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...
                        "attr": {
                            "dependent-group": "RUBRICAS",
                            "dependent-level": 1,
                            "data-db-name": "A.CD_RUBRICA",
                            "decodeFromTable": "RH_DEF_RUBRICAS A",
                            "otherValues": "", //Still to determine: .... TODO ......
                            "desigColumn": "CONCAT(CONCAT(A.CD_RUBRICA,' - '),A.DSP_RUBRICA)",
                            "orderBy": "A.DSP_RUBRICA",
                            "class": "form-control complexList chosen",
                            "filter": {
                                "create": " AND A.ACTIVO = 'S'", //On-New-Record
                                "edit": " AND A.ACTIVO = 'S' ", //On-Edit-Record
                            }
                        }
                    }, {
                        "responsivePriority": 3,
                        "title": "<?php echo mb_strtoupper($ui_quantity_short, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_quantity_short; ?>", //Editor
                        "data": 'QUANTIDADE',
                        "name": 'QUANTIDADE',
                        "className": "right visibleColumn",
                        "render": function (val, type, row) {
                            if (val) {
                                val = renderNumber(val, ',', '.', 2, '', '');
                            }
                            return val;
                        }
                    }, {
                        "responsivePriority": 4,
                        "title": "<?php echo mb_strtoupper($ui_price, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_price; ?>", //Editor
                        "data": 'PRECO',
                        "name": 'PRECO',
                        "className": "right visibleColumn",
                        "render": function (val, type, row) {
                            if (val) {
                                val = renderNumber(val, ',', '.', 2, '', '');
                            }
                            return val;
                        }
                    }, {
                        "responsivePriority": 5,
                        "title": "<?php echo mb_strtoupper($ui_factor, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_factor; ?>", //Editor
                        "data": 'FACTOR',
                        "name": 'FACTOR',
                        "className": "right visibleColumn",
                        "render": function (val, type, row) {
                            if (val) {
                                val = renderNumber(val, ',', '.', 2, '', '');
                            }
                            return val;
                        }
                    }, {
                        "responsivePriority": 2,
                        "title": "<?php echo mb_strtoupper($ui_value, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_value; ?>", //Editor
                        "data": 'VALOR',
                        "name": 'VALOR',
                        "className": "right visibleColumn",
                        "render": function (val, type, row) {
                            if (val) {
                                val = renderNumber(val, ',', '.', 2, '', '');
                            }
                            return val;
                        }
                   }, {
                        "responsivePriority": 2,
                        "title": "<?php echo mb_strtoupper($ui_difference, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_difference; ?>", //Editor
                        "data": 'VALOR_DIF',
                        "name": 'VALOR_DIF',
                        "className": "right visibleColumn",
                        "visible": false,
                        "render": function (val, type, row) {
                            if (val) {
                                val = renderNumber(val, ',', '.', 2, '', '');
                            }
                            return val;
                        }
                    }, {
                        "responsivePriority": 6,
                        "title": "<?php echo mb_strtoupper($ui_reference_dt_short, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_reference_dt_short; ?>", //Editor
                        "data": 'DT_REFERENCIA',
                        "name": 'DT_REFERENCIA',
                        //"datatype": 'dateYearMonth',
                        "className": "visibleColumn",
                        "attr": {
                            "class": "form-control dateYearMonth",
                            "autocomplete": "nope"
                        },
                        "render": function (val, type, row) {
                            if (val !== '') {
                                return val.substr(0,7);
                            } else {
                                return '';
                            }
                        }
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'CD_ENT_INT',
                        "name": 'CD_ENT_INT',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "responsivePriority": 7,
                        "complexList": true,
                        "title": "<?php echo mb_strtoupper($ui_internal_entity, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_internal_entity; ?>",
                        "data": "DSP_ENT_INT",
                        "name": "DSP_ENT_INT",
                        "className": "visibleColumn",
                        "type": "select",
                        "attr": {
                            "deferred": true,
                            "dependent-group": "ENT_INTERNA",
                            "dependent-level": 1,
                            "data-db-name": 'A.EMPRESA@A.CD_ENT_INT',
                            "distribute-value": 'EMPRESA@CD_ENT_INT',
                            "decodeFromTable": 'DG_ENTIDADES_INTERNAS A',
                            "desigColumn": "CONCAT(CONCAT(A.CD_ENT_INT,'-'),A.DSP_ENT_INT)",
                            'orderBy': 'A.CD_ENT_INT',
                            "class": "form-control complexList chosen",
                            "filter": {
                                "create": " AND A.EMPRESA = ':EMPRESA'",
                                "edit": " AND A.EMPRESA = ':EMPRESA' ",
                            }
                        }
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'CD_AGREGADO',
                        "name": 'CD_AGREGADO',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "complexList": true,
                        "title": "<?php echo mb_strtoupper($ui_rhid_household, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_rhid_household; ?>",
                        "data": "DSP_AGREGADO",
                        "name": "DSP_AGREGADO",
                        "className": "none visibleColumn",
                        "type": "select",
                        "attr": {
                            "deferred": true,
                            "dependent-group": "AGREGADOS",
                            "dependent-level": 1,
                            "data-db-name": 'A.RHID@A.CD_AGREGADO',
                            "distribute-value": 'RHID@CD_AGREGADO',
                            "decodeFromTable": 'RH_ID_AGREGADOS A',
                            "desigColumn": "A.NOME_AGREGADO",
                            'orderBy': 'A.CD_AGREGADO',
                            "class": "form-control complexList chosen",
                            "filter": {
                                "create": " AND A.RHID = ':RHID'",
                                "edit": " AND A.RHID = ':RHID' ",
                            }
                        }
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_obs_short, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_obs_short; ?>", //Editor
                        "data": 'OBS',
                        "name": 'OBS',
                        "type": 'textarea', //Editor
                        "className": "none visibleColumn",
                        "attr": {
                            "style": "max-width: 355px",
                            "class": "form-control len-355"
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
                            return RH_ID_RUBRICAS.crudButtons(true,true,true);
                        }
                    }
                ],
                validations: {
                    rules: {
                        ID_PERIODO: {
                            required: true,
                            maxlength: 10
                        },
                        "DT_VALOR": {
                            required: true,
                            dateISO: true,
                        },
                    },
                    "messages": {
                        "RH_DT_FIM": {
                            dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                        }
                    }
                }
            };
            RH_ID_RUBRICAS = new QuadTable();
            RH_ID_RUBRICAS.initTable($.extend({}, datatable_instance_defaults, optionsRH_ID_RUBRICAS));
            //END Rubricas

            //Incidências
            var optionsRH_ID_INCIDENCIAS = {
                "externalFilter": {
                    "templateMulti": {
                        "selector": "#employeeFilter",
                        "mandatory": ['RHID', 'DT_ADMISSAO'],
                        "optional": ['']
                    }
                },
                "tableId": "RH_ID_INCIDENCIAS",
                "table": "RH_ID_INCIDENCIAS",
                "pk": {
                    "primary": {
                        "EMPRESA": {"type": "varchar"},
                        "ANO": {"type": "number"},
                        "MES": {"type": "number"},
                        "ID_PERIODO": {"type": "number"},
                        "RHID": {"type": "number"},
                        "DT_ADMISSAO": {"type": "date"},
                        "CD_RUBRICA": {"type": "varchar"},
                        "SEQ_": {"type": "number"},
                        "GRUPO_ED": {"type": "varchar"}
                    }
                },
                "dependsOn": {
                    "RHID_PERIODOS_VIEW": {
                        "EMPRESA": "EMPRESA",
                        "ANO": "ANO",
                        "MES": "MES",
                        "ID_PERIODO": "ID_PERIODO",
                        "RHID": "RHID",
                        "DT_ADMISSAO": "DT_ADMISSAO"
                    }
                },
                //"order_by": "TO_NUMBER(CD_RUBRICA), DT_REFERENCIA",
                "recordBundle": 7,
                "pageLenght": 7,
                "scrollY": "264",
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
                        "data": 'ANO',
                        "name": 'ANO',
                        "type": "hidden",
                        "visible": false
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'MES',
                        "name": 'MES',
                        "type": "hidden",
                        "visible": false
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
                        "data": 'RHID',
                        "name": 'RHID',
                        "type": "hidden",
                        "visible": false
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'ID_PERIODO',
                        "name": 'ID_PERIODO',
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
                        "responsivePriority": 2,
                        "complexList": true,
                        "title": "<?php echo mb_strtoupper($ui_wage_item, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_wage_item; ?>",
                        "data": 'DSP_RUBRICA',
                        "name": 'DSP_RUBRICA',
                        "type": "select",
                        "className": "visibleColumn",
                        //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...
                        "attr": {
                            "dependent-group": "RUBRICAS",
                            "dependent-level": 1,
                            "data-db-name": "A.CD_RUBRICA",
                            "decodeFromTable": "RH_DEF_RUBRICAS A",
                            "otherValues": "", //Still to determine: .... TODO ......
                            "desigColumn": "CONCAT(CONCAT(A.CD_RUBRICA,' - '),A.DSP_RUBRICA)",
                            "orderBy": "A.DSP_RUBRICA",
                            "class": "form-control complexList chosen",
                            "filter": {
                                "create": " AND A.ACTIVO = 'S'", //On-New-Record
                                "edit": " AND A.ACTIVO = 'S' ", //On-Edit-Record
                            }
                        }
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'GRUPO_ED',
                        "name": 'GRUPO_ED',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "responsivePriority": 3,
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
                        "responsivePriority": 4,
                        "title": "<?php echo mb_strtoupper($ui_reference_dt_short, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_reference_dt_short; ?>", //Editor
                        "data": 'DT_REFERENCIA',
                        "name": 'DT_REFERENCIA',
                        //"datatype": 'dateYearMonth',
                        "className": "visibleColumn",
                        "attr": {
                            "class": "form-control dateYearMonth",
                            "autocomplete": "nope"
                        },
                        "render": function (val, type, row) {
                            if (val !== '') {
                                return val.substr(0,7);
                            } else {
                                return '';
                            }
                        }
                    }, {
                        "responsivePriority": 5,
                        "title": "<?php echo mb_strtoupper($ui_rhid_incidence, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_rhid_incidence; ?>", //Editor
                        "data": 'BI_COLABORADOR',
                        "name": 'BI_COLABORADOR',
                        "className": "right visibleColumn",
                        "render": function (val, type, row) {
                            if (val) {
                                val = renderNumber(val, ',', '.', 2, '', '');
                            }
                            return val;
                        }
                    }, {
                        "responsivePriority": 5,
                        "title": "<?php echo mb_strtoupper($ui_rhid_incidence_diff, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_rhid_incidence_diff; ?>", //Editor
                        "data": 'BI_COLAB_DIF',
                        "name": 'BI_COLAB_DIF',
                        "className": "right visibleColumn",
                        "visible": false,
                        "render": function (val, type, row) {
                            if (val) {
                                val = renderNumber(val, ',', '.', 2, '', '');
                            }
                            return val;
                        }
                    }, {
                        "responsivePriority": 6,
                        "title": "<?php echo mb_strtoupper($ui_employer_incidence, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_employer_incidence; ?>", //Editor
                        "data": 'BI_ENT_PATRONAL',
                        "name": 'BI_ENT_PATRONAL',
                        "className": "right visibleColumn",
                        "render": function (val, type, row) {
                            if (val) {
                                val = renderNumber(val, ',', '.', 2, '', '');
                            }
                            return val;
                        }
                    }, {
                        "responsivePriority": 6,
                        "title": "<?php echo mb_strtoupper($ui_employer_incidence_diff, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_employer_incidence_diff; ?>", //Editor
                        "data": 'BI_ENT_PATR_DIF',
                        "name": 'BI_ENT_PATR_DIF',
                        "className": "right visibleColumn",
                        "visible": false,
                        "render": function (val, type, row) {
                            if (val) {
                                val = renderNumber(val, ',', '.', 2, '', '');
                            }
                            return val;
                        }
                    }, {
                        "responsivePriority": 7,
                        "title": "<?php echo mb_strtoupper($ui_irs_incidence, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_irs_incidence; ?>", //Editor
                        "data": 'BI_TX_IRS',
                        "name": 'BI_TX_IRS',
                        "className": "right visibleColumn",
                        "render": function (val, type, row) {
                            if (val) {
                                val = renderNumber(val, ',', '.', 2, '', '');
                            }
                            return val;
                        }
                    }, {
                        "responsivePriority": 8,
                        "title": "<?php echo mb_strtoupper($ui_irs_prv_year_incidence, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_irs_prv_year_incidence; ?>", //Editor
                        "data": 'BI_IRS_ANO_ANT',
                        "name": 'BI_IRS_ANO_ANT',
                        "className": "right visibleColumn",
                        "render": function (val, type, row) {
                            if (val) {
                                val = renderNumber(val, ',', '.', 2, '', '');
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
                            return RH_ID_INCIDENCIAS.crudButtons(true,true,true);
                        }
                    }
                ]
            };
            RH_ID_INCIDENCIAS = new QuadTable();
            RH_ID_INCIDENCIAS.initTable($.extend({}, datatable_instance_defaults, optionsRH_ID_INCIDENCIAS));
            //END Incidências

            //Descontos
            var optionsRH_ID_DESCONTOS = {
                "externalFilter": {
                    "templateMulti": {
                        "selector": "#employeeFilter",
                        "mandatory": ['RHID', 'DT_ADMISSAO'],
                        "optional": ['']
                    }
                },
                "tableId": "RH_ID_DESCONTOS",
                "table": "RH_ID_DESCONTOS",
                "pk": {
                    "primary": {
                        "EMPRESA": {"type": "varchar"},
                        "ANO": {"type": "number"},
                        "MES": {"type": "number"},
                        "ID_PERIODO": {"type": "number"},
                        "RHID": {"type": "number"},
                        "DT_ADMISSAO": {"type": "date"},
                        "CD_ED": {"type": "number"},
                        "CD_REG_DESC": {"type": "varchar"},
                        "SEQ_": {"type": "number"}
                    }
                },
                "dependsOn": {
                    "RHID_PERIODOS_VIEW": {
                        "EMPRESA": "EMPRESA",
                        "ANO": "ANO",
                        "MES": "MES",
                        "ID_PERIODO": "ID_PERIODO",
                        "RHID": "RHID",
                        "DT_ADMISSAO": "DT_ADMISSAO"
                    }
                },
                "order_by": "CD_ED, CD_REG_DESC, SEQ_",
                "recordBundle": 7,
                "pageLenght": 7,
                "scrollY": "264",
                //"detailsObjects": ['RH_DEF_PERIODOS'],
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
                        "data": 'ANO',
                        "name": 'ANO',
                        "type": "hidden",
                        "visible": false
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'MES',
                        "name": 'MES',
                        "type": "hidden",
                        "visible": false
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
                        "data": 'RHID',
                        "name": 'RHID',
                        "type": "hidden",
                        "visible": false
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'ID_PERIODO',
                        "name": 'ID_PERIODO',
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
                        "responsivePriority": 2,
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
                        "data": 'CD_REG_DESC',
                        "name": 'CD_REG_DESC',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "responsivePriority": 3,
                        "complexList": true,
                        "title": "<?php echo mb_strtoupper($ui_discount_regime, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_discount_regime; ?>",
                        "data": 'DSP_REG_DESC',
                        "name": 'DSP_REG_DESC',
                        "type": "select",
                        "className": "visibleColumn",
                        //"renew": true,
                        "attr": {
                            "deferred": true,
                            "dependent-group": "ENT_DESCT",
                            "dependent-level": 2,
                            "data-db-name": "A.CD_ED@A.CD_REG_DESC",
                            "decodeFromTable": "RH_REGIMES_DESCONTO A",
                            "desigColumn": "CONCAT(CONCAT(A.CD_REG_DESC,'-'),A.DSP_REG_DESC)",
                            "orderBy": "A.CD_REG_DESC",
                            "class": "form-control complexList chosen",
                            "filter": {
                                "create": " AND A.CD_ED = ':CD_ED'",
                                "edit": " AND A.CD_ED = ':CD_ED'",
                            }
                        }
                    }, {
                        "responsivePriority": 4,
                        "title": "<?php echo mb_strtoupper($ui_rhid_incidence, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_rhid_incidence; ?>", //Editor
                        "data": 'BI_ED_COLAB',
                        "name": 'BI_ED_COLAB',
                        "className": "right visibleColumn",
                        "render": function (val, type, row) {
                            if (val) {
                                val = renderNumber(val, ',', '.', 2, '', '');
                            }
                            return val;
                        }
                    }, {
                        "responsivePriority": 4,
                        "title": "<?php echo mb_strtoupper($ui_rhid_incidence_diff, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_rhid_incidence_diff; ?>", //Editor
                        "data": 'BI_ED_COLAB_DIF',
                        "name": 'BI_ED_COLAB_DIF',
                        "className": "right visibleColumn",
                        "visible": false,
                        "render": function (val, type, row) {
                            if (val) {
                                val = renderNumber(val, ',', '.', 2, '', '');
                            }
                            return val;
                        }
                    }, {
                        "responsivePriority": 5,
                        "title": "<?php echo mb_strtoupper($ui_employee_tax, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_employee_tax; ?>", //Editor
                        "data": 'TX_COLAB',
                        "name": 'TX_COLAB',
                        "className": "right visibleColumn",
                        "render": function (val, type, row) {
                            if (val) {
                                val = renderNumber(val, ',', '.', 2, '', '');
                            }
                            return val;
                        }
                    }, {
                        "responsivePriority": 5,
                        "title": "<?php echo mb_strtoupper($ui_employee_tax_diff, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_employee_tax_diff; ?>", //Editor
                        "data": 'TX_COLAB_DIF',
                        "name": 'TX_COLAB_DIF',
                        "className": "right visibleColumn",
                        "visible": false,
                        "render": function (val, type, row) {
                            if (val) {
                                val = renderNumber(val, ',', '.', 2, '', '');
                            }
                            return val;
                        }
                    }, {
                        "responsivePriority": 6,
                        "title": "<?php echo mb_strtoupper($ui_rhid_deduction, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_rhid_deduction; ?>", //Editor
                        "data": 'DESCT_COLAB',
                        "name": 'DESCT_COLAB',
                        "className": "right visibleColumn",
                        "render": function (val, type, row) {
                            if (val) {
                                val = renderNumber(val, ',', '.', 2, '', '');
                            }
                            return val;
                        }
                    }, {
                        "responsivePriority": 6,
                        "title": "<?php echo mb_strtoupper($ui_rhid_deduction_diff, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_rhid_deduction_diff; ?>", //Editor
                        "data": 'DESCT_COLAB_DIF',
                        "name": 'DESCT_COLAB_DIF',
                        "className": "right visibleColumn",
                        "visible": false,
                        "render": function (val, type, row) {
                            if (val) {
                                val = renderNumber(val, ',', '.', 2, '', '');
                            }
                            return val;
                        }
                    }, {
                        "responsivePriority": 7,
                        "title": "<?php echo mb_strtoupper($ui_employer_incidence, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_employer_incidence; ?>", //Editor
                        "data": 'BI_ED_EP',
                        "name": 'BI_ED_EP',
                        "className": "right visibleColumn",
                        "render": function (val, type, row) {
                            if (val) {
                                val = renderNumber(val, ',', '.', 2, '', '');
                            }
                            return val;
                        }
                    }, {
                        "responsivePriority": 7,
                        "title": "<?php echo mb_strtoupper($ui_employer_incidence_diff, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_employer_incidence_diff; ?>", //Editor
                        "data": 'BI_ED_EP_DIF',
                        "name": 'BI_ED_EP_DIF',
                        "className": "right visibleColumn",
                        "visible": false,
                        "render": function (val, type, row) {
                            if (val) {
                                val = renderNumber(val, ',', '.', 2, '', '');
                            }
                            return val;
                        }
                    }, {
                        "responsivePriority": 8,
                        "title": "<?php echo mb_strtoupper($ui_employeer_tax, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_employeer_tax; ?>", //Editor
                        "data": 'TX_EP',
                        "name": 'TX_EP',
                        "className": "right visibleColumn",
                        "render": function (val, type, row) {
                            if (val) {
                                val = renderNumber(val, ',', '.', 2, '', '');
                            }
                            return val;
                        }
                    }, {
                        "responsivePriority": 8,
                        "title": "<?php echo mb_strtoupper($ui_employeer_tax_diff, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_employeer_tax_diff; ?>", //Editor
                        "data": 'TX_EP_DIF',
                        "name": 'TX_EP_DIF',
                        "className": "right visibleColumn",
                        "visible": false,
                        "render": function (val, type, row) {
                            if (val) {
                                val = renderNumber(val, ',', '.', 2, '', '');
                            }
                            return val;
                        }
                    }, {
                        "responsivePriority": 9,
                        "title": "<?php echo mb_strtoupper($ui_employer_deduction, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_employer_deduction; ?>", //Editor
                        "data": 'DESCT_EP',
                        "name": 'DESCT_EP',
                        "className": "right visibleColumn",
                        "render": function (val, type, row) {
                            if (val) {
                                val = renderNumber(val, ',', '.', 2, '', '');
                            }
                            return val;
                        }
                    }, {
                        "responsivePriority": 9,
                        "title": "<?php echo mb_strtoupper($ui_employer_deduction_diff, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_employer_deduction_diff; ?>", //Editor
                        "data": 'DESCT_EP_DIF',
                        "name": 'DESCT_EP_DIF',
                        "className": "right visibleColumn",
                        "visible": false,
                        "render": function (val, type, row) {
                            if (val) {
                                val = renderNumber(val, ',', '.', 2, '', '');
                            }
                            return val;
                        }
                    }, {
                        "responsivePriority": 10,
                        "title": "<?php echo mb_strtoupper($ui_reference_dt_short, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_reference_dt_short; ?>", //Editor
                        "data": 'DT_REFERENCIA',
                        "name": 'DT_REFERENCIA',
                        //"datatype": 'dateYearMonth',
                        "className": "visibleColumn",
                        "attr": {
                            "class": "form-control dateYearMonth",
                            "autocomplete": "nope"
                        },
                        "render": function (val, type, row) {
                            if (val !== '') {
                                return val.substr(0,7);
                            } else {
                                return '';
                            }
                        }
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_irs_incidence, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_irs_incidence; ?>", //Editor
                        "data": 'BI_TX_IRS',
                        "name": 'BI_TX_IRS',
                        "className": "none right visibleColumn",
                        "render": function (val, type, row) {
                            if (val) {
                                val = renderNumber(val, ',', '.', 2, '', '');
                            }
                            return val;
                        }
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_months_number, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_months_number; ?>", //Editor
                        "data": 'NR_MESES_IRS_ANO_ANT',
                        "name": 'NR_MESES_IRS_ANO_ANT',
                        "className": "none right visibleColumn",
                        "render": function (val, type, row) {
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
                            return RH_ID_DESCONTOS.crudButtons(true,true,true);
                        }
                    }
                ]
            };
            RH_ID_DESCONTOS = new QuadTable();
            debugger;
            RH_ID_DESCONTOS.initTable($.extend({}, datatable_instance_defaults, optionsRH_ID_DESCONTOS));
            //END Descontos

            //Dados
            var optionsRH_ID_RECIBOS = {
                "formId": "#RH_ID_RECIBOS",
                "table": "RH_ID_RECIBOS",
                "info": true, //Disables INFO: (record / total records) :: HOW ????
                "pk": {
                    "primary": {
                        "EMPRESA": {"type": "varchar"},
                        "ANO": {"type": "number"},
                        "MES": {"type": "number"},
                        "ID_PERIODO": {"type": "number"},
                        "RHID": {"type": "number"},
                        "DT_ADMISSAO": {"type": "date"}
                    }
                },
                "dependsOn": {
                    "RHID_PERIODOS_VIEW": {
                        "EMPRESA": "EMPRESA",
                        "ANO": "ANO",
                        "MES": "MES",
                        "ID_PERIODO": "ID_PERIODO",
                        "RHID": "RHID",
                        "DT_ADMISSAO": "DT_ADMISSAO"
                    }
                },
                "dateFields": {
                    "DT_ADMISSAO": "date"
                },
                // "initialWhereClause": " GENERO = 'M' ", optional
                //"order_by": "DT_ADMISSAO DESC",
                //detailsObjects: ['qTableDocs', 'qTableAgregados', 'Documentos', 'Agregados'],
                "recordBundle": 1,
                "crud": [false, false, false],//create,update,delete
                "defaultButtons": ['enter-query'],
                "refreshData": true, //default true
                "queryAll": false,//defaults to true ...empty search return all records
                "showMultiRecord": false, //default true
                //workflow: true, //optional defaults to false
                "showWorkflowOnEdit": false,
                "order": false, //Requires view <TABLE_NAME>_VW
//                "dateFields": {
//                    "DT_REGIME_SINDICAL": "date" ?????
//                },
                "domainLists": {
                    "TP_IRS":  {
                         "domain-list": true,
                         "dependent-group": "RH_TP_IRS"
                    },
                    "TABELA_IRS":  {
                         "domain-list": true,
                         "dependent-group": "RH_TABELA_IRS"
                    },
                    "EST_CIVIL_IRS":  {
                         "domain-list": true,
                         "dependent-group": "RH_EST_CIVIL_IRS"
                    },
                    "DEFICIENTE": {
                         "domain-list": true,
                         "dependent-group": "RH_ID_RETRIBUTIVOS.GRAU_DEFICIENCIA"
                    },
                    "FORMA_PAGAMENTO": {
                         "domain-list": true,
                         "dependent-group": "RH_FORMA_PAGAM"
                    }
                }
            };
            RH_ID_RECIBOS = new QuadForm();
            RH_ID_RECIBOS.initForm($.extend({}, datatable_instance_defaults, optionsRH_ID_RECIBOS));
            //END Rubricas

            //Diário
            var optionsRH_ID_DIARIO = {
                "tableId": "RH_ID_DIARIO",
                "table": "RH_ID_DIARIO",
                "pk": {
                    "primary": {
                        "EMPRESA": {"type": "varchar"},
                        "ANO": {"type": "number"},
                        "MES": {"type": "number"},
                        "RHID": {"type": "number"},
                        "DT_ADMISSAO": {"type": "date"},
                        "SEQ_": {"type": "number"}
                    }
                },
                "dependsOn": {
                    "DG_MESES": {
                        "EMPRESA": "EMPRESA",
                        "ANO": "ANO",
                        "MES": "MES"
                    }
                },
                "externalFilter": {
                    "templateMulti": {
                        "selector": "#employeeFilter",
                        "mandatory": ['RHID', 'DT_ADMISSAO'],
                        "optional": ['']
                    }
                },
//                "crudOnMasterInactive": {
//                    "condition": " (data.ESTADO !== 'S') ",
//                    "acl": {
//                        "create": false,
//                        "update": false,
//                        "delete": false
//                    }
//                },
                "order_by": "SEQ_",
                "recordBundle": 7,
                "pageLenght": 7,
                "scrollY": "264",
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
                        "data": 'ANO',
                        "name": 'ANO',
                        "type": "hidden",
                        "visible": false
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'MES',
                        "name": 'MES',
                        "type": "hidden",
                        "visible": false
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'RHID',
                        "name": 'RHID',
                        "type": "hidden",
                        "visible": false
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'SEQ_',
                        "name": 'SEQ_',
                        "datatype": 'sequence',
                        "type": "hidden",
                        "visible": false
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'DT_ADMISSAO',
                        "name": 'DT_ADMISSAO',
                        "type": "hidden",
                        "visible": false,
                        "datatype": 'date'
                    }, {
                        "responsivePriority": 2,
                        "title": "<?php echo mb_strtoupper($ui_request_dt, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_request_dt; ?>", //Editor
                        "data": 'DT_PEDIDO',
                        "name": 'DT_PEDIDO',
                        "datatype": "datetime", // datetime OR datetimeShort OR datetime
                        "className": "visibleColumn",
                        "attr": {
                            "class": "form-control dateTimePicker minutes"
                        },
                        "render": function (val, type, row) {
                            return val
                        }
                    }, {
                        "responsivePriority": 3,
                        "title": "<?php echo mb_strtoupper($ui_requester, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_requester; ?>", //Editor
                        "data": 'QUEM_PEDIU',
                        "name": 'QUEM_PEDIU',
                        "className": "visibleColumn",

                    }, {
                        "responsivePriority": 4,
                        "title": "<?php echo mb_strtoupper($ui_reference, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_reference; ?>", //Editor
                        "data": 'REF_PEDIDO',
                        "name": 'REF_PEDIDO',
                        "className": "visibleColumn",
                    }, {
                        "responsivePriority": 5,
                        "title": "<?php echo mb_strtoupper($ui_execution_dt, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_execution_dt; ?>", //Editor
                        "data": 'DT_EXECUCAO',
                        "name": 'DT_EXECUCAO',
                        "datatype": "datetime", // datetime OR datetimeShort OR datetime
                        "className": "visibleColumn",
                        "attr": {
                            "class": "form-control dateTimePicker minutes"
                        },
                        "render": function (val, type, row) {
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
                            return RH_ID_DIARIO.crudButtons(true,true,true);
                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "REF_PEDIDO": {
                            required: true,
                            maxlength: 250
                        },
                        "DT_PEDIDO": {
                            required: false,
                            maxlength: 16
                        },
                        "QUEM_PEDIU": {
                            required: false,
                            maxlength: 30
                        },
                        "DESCRICAO": {
                            required: false,
                            maxlength: 4000
                        },
                        "DT_EXECUCAO": {
                            required: false,
                            maxlength: 16
                        },
                        "DT_EXECUCAO": {
                            required: false,
                            maxlength: 16
                        }
                    },
                    "messages": {
                        "RH_DT_FIM": {
                            dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                        }
                    }
                }
            };
            RH_ID_DIARIO = new QuadTable();
            RH_ID_DIARIO.initTable($.extend({}, datatable_instance_defaults, optionsRH_ID_DIARIO));
            //END Diário

            //Células :: RH_ID_RUBRICAS
            var optionsRH_ID_CELULAS_VALUES = {
                "tableId": "RH_ID_CELULAS_VALUES",
                "table": "RH_ID_CELULAS_VALUES",
                "pk": {
                    "primary": {
                        "EMPRESA": {"type": "varchar"},
                        "ANO": {"type": "number"},
                        "MES": {"type": "number"},
                        "ID_PERIODO": {"type": "number"},
                        "RHID": {"type": "number"},
                        "DT_ADMISSAO": {"type": "date"},
                        "CELL": {"type": "varchar"}
                    }
                },
                "dependsOn": {
                    "RHID_PERIODOS_VIEW": {
                        "EMPRESA": "EMPRESA",
                        "ANO": "ANO",
                        "MES": "MES",
                        "ID_PERIODO": "ID_PERIODO",
                        "RHID": "RHID",
                        "DT_ADMISSAO": "DT_ADMISSAO"
                    }
                },
                "order_by": "CELL",
                "recordBundle": 7,
                "pageLenght": 7,
                "scrollY": "264",
                //"detailsObjects": ['RH_DEF_PERIODOS'],
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
                        "data": 'ANO',
                        "name": 'ANO',
                        "type": "hidden",
                        "visible": false
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'MES',
                        "name": 'MES',
                        "type": "hidden",
                        "visible": false
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
                        "data": 'RHID',
                        "name": 'RHID',
                        "type": "hidden",
                        "visible": false
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'ID_PERIODO',
                        "name": 'ID_PERIODO',
                        "type": "hidden",
                        "visible": false
                    }, {
                        "responsivePriority": 2,
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
                        }
                    }, {
                        "responsivePriority": 3,
                        "title": "<?php echo mb_strtoupper($ui_cell, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_cell; ?>",
                        "data": 'CELL',
                        "name": 'CELL',
                        "className": "visibleColumn",
                    }, {
                        "responsivePriority": 4,
                        "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>",
                        "label": "<?php echo $ui_designation; ?>",
                        "data": 'DSP_CELL',
                        "name": 'DSP_CELL',
                        "className": "visibleColumn",
                    }, {
                        "responsivePriority": 5,
                        "title": "<?php echo mb_strtoupper($ui_value, 'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_value; ?>", //Editor
                        "data": 'VALOR',
                        "name": 'VALOR',
                        "className": "right visibleColumn",
                        "render": function (val, type, row) {
                            return val;
                        }
                    }
                ]
            };
            RH_ID_CELULAS_VALUES = new QuadTable();
            RH_ID_CELULAS_VALUES.initTable($.extend({}, datatable_instance_defaults, optionsRH_ID_CELULAS_VALUES));

        }
        //END TABLES

        //RHID Filter
        if (1 === 1) {

            var cnt = 0;

            //Procede à limpeza dos Totais
            var cleanTotais = function() {
                $('#totais > tbody td.data').each(function() {
                    $(this).html('');
                });
            }

            //GET RHID's
            var getRhid = function (empresa_) {
                var el = $("#xt_RHID"), params = {};
                if (empresa_) {
                    el.empty();
                    el.trigger("chosen:updated");
                    params = {
                        pk: "RHID",
                        table: "RHID_EMPRESAS_VIEW",
                        orderBy: "RHID",
                        desigColumn: "DISTINCT CONCAT(CONCAT(RHID,'-'),NOME)",
                        where: " AND EMPRESA = '" + empresa_ + "'"
                    }
                    var promise = $.ajax({
                        type: "POST",
                        url: "data-source/complexLists.php",
                        data: {lists: [params], multiRequest: true},
                        dataType: "text",
                        cache: false,
                        async: true,
                        beforeSend: function () {
                            el.addClass("loadingList");
                            $('#xt_RHID_chosen > a').addClass("loadingList");
                        }
                    });

                    $.when(promise).then(function (data) {
                        var dat = JSON.parse(data);

                        if (dat["data"][0].length > 0) { //if results  fill dropdown etc.
                            var output = [];
                            output.push("<option> </option>");
                            _.map(dat["data"][0], function (ob, index) {
                                var oValues = ob["OTHERVALUES"]
                                    ? 'data-otherValues="' + ob["OTHERVALUES"] + '"'
                                    : "";
                                output.push(
                                    '<option value="' +
                                    ob.VAL +
                                    '" ' +
                                    oValues +
                                    ">" +
                                    ob[Object.keys(ob)[0]] +
                                    "</option>"
                                );
                            });
                            el.html(output.join(""));
                            el.removeClass("loadingList");
                            $('#xt_RHID_chosen > a').removeClass("loadingList");

                            var options = {
                                no_results_text: "_RESULTS_VARIABLE",
                                placeholder_text_single: " ",
                                allow_single_deselect: true,
                                search_contains: true
                            };

                            el.chosen(options);
                            el.trigger("chosen:updated");

                        } else { //no results ...show create button
                            null
                        }

                        setTimeout(function () {
                            //$("#employeeFilter :input").trigger("change");
                        }, 0);

                    });
                }
            };
            //END GET RHID's

            //GET DT. ADMISSAO
            var getDT_ADM = function (empresa_, rhid_) {
                var el = $("#xt_DT_ADMISSAO"), params = {};
                el.chosen('destroy');

                if (empresa_ && rhid_) {
                    params = {
                        pk: "DT_ADMISSAO",
                        table: "RHID_EMPRESAS_VIEW",
                        where: " AND EMPRESA = '" + empresa_ + "' AND RHID = " + rhid_,
                        orderBy: "DT_ADMISSAO DESC",
                        desigColumn: "DISTINCT DT_ADMISSAO",
                        otherValues: "CD_SITUACAO@DSR_SITUACAO@CD_ESTAB@DSP_ESTAB@CD_VINCULO@DSP_VINCULO@DT_INI_VINCULO@DT_FIM_VINCULO@DT_DEMISSAO" //not used at the moment
                        //todo problema concat NULL https://makandracards.com/makandra/825-mysql-concat-with-null-fields
                    }
                    var promise = $.ajax({
                        type: "POST",
                        url: "data-source/complexLists.php",
                        data: {lists: [params], multiRequest: true},
                        dataType: "text",
                        cache: false,
                        async: true,
                        beforeSend: function () {
                            el.addClass("loadingList");
                        }
                    });
                }

                $.when(promise).then(function (data) {
                    var dat = JSON.parse(data);

                    if (dat["data"][0].length > 0) { //if results  fill dropdown etc.
                        var output = [];
                        output.push("<option> </option>");
                        _.map(dat["data"][0], function (ob, index) {
                            var oValues = ob["OTHERVALUES"]
                                ? 'data-otherValues="' + ob["OTHERVALUES"] + '"'
                                : "";
                            output.push(
                                '<option value="' +
                                ob.VAL +
                                '" ' +
                                oValues +
                                ">" +
                                ob[Object.keys(ob)[0]] +
                                "</option>"
                            );
                        });
                        el.html(output.join(""));
                        el.removeClass("loadingList");
                        var options = {
                            no_results_text: "_RESULTS_VARIABLE",
                            placeholder_text_single: " ",
                            allow_single_deselect: true,
                            search_contains: true
                        };
                        el.chosen(options);
                        //Selects MOST RECENT DATE
                        el.val(dat["data"][0][0]["VAL"]);
                        el.trigger("change");
                        el.trigger("chosen:updated");
                    }

                });
            };
            //GET DT.ADMISSAO

            //DT.Admissão :: OTHERVALUES
            var displayContextInfo = function ( info_ ) {
                //info_ :: otherValues: "CD_SITUACAO@DSR_SITUACAO@CD_ESTAB@DSP_ESTAB@CD_VINCULO@DSP_VINCULO@DT_INI_VINCULO@DT_FIM_VINCULO@DT_DEMISSAO"
                var arr = info_.split("@"), contrato = '';

                //Dt. Demissão
                if ( arr[8] ) {
                    $('#DT_DEMISSAO').val( arr[8] );
                } else {
                    $('#DT_DEMISSAO').val('');
                }

                //Situação
                if (arr[0] && arr[1] ) {
                    $('#DSP_SITUACAO').val( arr[0] + '-' + arr[1]);
                } else {
                    $('#DSP_SITUACAO').val('');
                }

                //Contrato
                contrato = '';
                if ( arr[4] && arr[5] ) {
                    contrato = arr[4] + '-' + arr[5];
                    if (arr[6] && arr[7]) {
                        contrato = contrato + ' ' + "<?php echo $ui_between; ?>" + arr[6] + "<?php echo $ui_and; ?>" + arr[7];
                    } else if ( arr[6] && !arr[7] ) {
                        contrato = contrato + ' ' + "<?php echo $ui_from; ?>" + arr[6];
                    }
                }
                $('#DSP_CONTRATO').val(contrato);

                //Estabelecimento
                if (arr[2] && arr[3]) {
                    $('#DSP_ESTAB').val( arr[2] + '-' + arr[3]);
                } else {
                    $('#DSP_ESTAB').val('');
                }

            };
            //END DT.Admissão :: OTHERVALUES

            //FORCE AUTO-QUERY on FORMS to retrive TOTAIS
            var getTotaisRecibo = function () {
                var $frmInstance = RH_ID_RECIBOS, frm = '#RH_ID_RECIBOS';

                callWorker();

                function getFormDados () {
                    return $.Deferred(function () {
                        var self = this;
                        $.when(carregaForm()).then(function () {
                            self.resolve(RH_ID_RECIBOS.myData);
                        });

                    });
                };

                function carregaForm () {
                    return $.Deferred(function () {
                        var self = this;
                        var obj = RH_ID_RECIBOS;
                        obj.resetData();
                        obj.setDML();

                        obj.operation="SELECT";
                        $.when(obj.getData(true)).then(function(dat) {
                            var dat = JSON.parse(dat);
                            if (obj.checkError(dat, $(obj.formId))) {
                                return;
                            }
                            dat = obj.fixData(dat);
                            obj.myData["data"] = [];
                            obj.currentRecord = 0;

                            $.merge(obj.myData["data"], dat["data"]);
                            obj.dataRender(frm, obj.currentRecord, null);
                            $(obj.formId + " > _spinner").hide();

                            obj.acl(frm);
                            obj.masterDetail(frm);
                            self.resolve();
                        });
                    });
                };

                $.when( getFormDados() ).then(function (dat) {

                    var per_iliq, per_desct, per_liq, mon_iliq, mon_desct, mon_liq;
                    if ($frmInstance.checkError(dat, $($frmInstance.formId))) {
                        return;
                    }
                    dat = $frmInstance.fixData(dat);
                    $frmInstance.clearForm(frm);

                    $frmInstance.currentRecord = 0;
                    $frmInstance.dataRender(frm, $frmInstance.currentRecord, null);
                    $frmInstance.masterDetail(frm);

                    if (dat['data'].length) { //No data returned
                        //Ilíquido no Período
                        if ( dat['data'][0]['ILIQUIDO_DIF'] ) {
                            per_iliq = dat['data'][0]['ILIQUIDO_DIF'];
                        } else {
                            per_iliq = dat['data'][0]['ILIQUIDO'];
                        }
                        $('#per_iliq').html( renderNumber(per_iliq, ',', '.', 2, '', '') );

                        //Descontos Colab. no Período
                        if ( dat['data'][0]['DESCONTO_COLAB_DIF'] ) {
                            per_desct = dat['data'][0]['DESCONTO_COLAB_DIF'];
                        } else {
                            per_desct = dat['data'][0]['DESCONTO_COLAB'];
                        }
                        $('#per_desct').html( renderNumber(per_desct, ',', '.', 2, '', '') );

                        //Líquido no Período
                        if ( dat['data'][0]['LIQUIDO_DIF'] ) {
                            per_liq = dat['data'][0]['LIQUIDO_DIF'];
                        } else {
                            per_liq = dat['data'][0]['LIQUIDO'];
                        }
                        $('#per_liq').html( renderNumber(per_liq, ',', '.', 2, '', '') );

                        //Ilíquido no Mês
                        mon_iliq = dat['data'][0]['ILIQUIDO'];
                        $('#mon_iliq').html( renderNumber(mon_iliq, ',', '.', 2, '', '') );
                        //Descontos no Mês
                        mon_desct = dat['data'][0]['DESCONTO_COLAB'];
                        $('#mon_desct').html( renderNumber(mon_desct, ',', '.', 2, '', '') );
                        //Líquido no Mês
                        mon_liq = dat['data'][0]['LIQUIDO'];
                        $('#mon_liq').html( renderNumber(mon_liq, ',', '.', 2, '', '') );
                    }
                });

            }
            //END FORCE AUTO-QUERY on FORMS to retrive TOTAIS


            //Call SQL Worker (Bind OR Not)
            function callWorker () {
                var x = RHID_PERIODOS_VIEW.selectedRowData(), sql_str,t0, wk,bindArr = [];

                if (RHID_PERIODOS_VIEW.tbl.rows( '.selected' ).any()) { //ROW on MASTER IS SELECTED
                    t0 = performance.now(),
                    wk = new Worker(pn + "assets/lib/quad/workerRouter.js");

                    sql_str = "SELECT ILIQUIDO,  DESCONTO_COLAB,  DESCONTO_EP,  LIQUIDO" +
                              " FROM RH_ID_RECIBO_INFOS" +
                                   " WHERE EMPRESA = :EMPRESA" +
                                   " AND ANO = :ANO" +
                                   " AND MES = :MES" +
                                   " AND RHID = :RHID" +
                                   " AND DT_ADMISSAO = TO_DATE(:DT_ADMISSAO, 'YYYY-MM-DD')";

                    //BIND Variables
                    bindArr.push( {name : "EMPRESA", value : x['EMPRESA']} );
                    bindArr.push( {name : "RHID", value : x['RHID']} );
                    bindArr.push( {name : "DT_ADMISSAO", value : x['DT_ADMISSAO']} );
                    bindArr.push( {name : "ANO", value : x['ANO']} );
                    bindArr.push( {name : "MES", value : x['MES']} );

                    var message = {
                            request_id: 'Go_SQL',
                            sql_statement: sql_str,
                            binders: bindArr,
                            defaults: datatable_instance_defaults.pathToSqlFile
                        },
                        mssg = '';

                    wk.postMessage(JSON.stringify(message));
                    wk.onmessage = function (event) {
                        if (event.data === 'working') {
                            return;
                        } else {
                            var t1 = performance.now(),
                                tmp = millisToMinutesAndSeconds(t1 - t0),
                                perc_pago, perc_saldo;
                            if (event.data.status == 'OK') {
                                if (event.data.data.length) {
                                    var iliq_ = parseFloat(event.data.data[0]['ILIQUIDO']),
                                        desct_colab_ = parseFloat(event.data.data[0]['DESCONTO_COLAB']),
                                        desct_ep_ = parseFloat(event.data.data[0]['DESCONTO_EP']),
                                        liq_ = parseFloat(event.data.data[0]['LIQUIDO']);

                                    //ILIQUIDO,  DESCONTO_COLAB,  DESCONTO_EP,  LIQUIDO
                                    $('#tot_iliq').html( renderNumber(iliq_, ',', '.', 2, '', ' €') );
                                    $('#tot_desct').html( renderNumber(iliq_, ',', '.', 2, '', ' €') );
                                    $('#tot_liq').html( renderNumber(iliq_, ',', '.', 2, '', ' €') );
                                }
                            }
                        }
                    }
                }

            }
            //Call SQL Worker (Bind OR Not)

            //Change FILTER :: INSTANCES Propagation
            $("#employeeFilter").off("change", ":input");
            $("#employeeFilter").on("change", ":input", function (evt) {
                var empresa_ = $('#xt_DSP_EMPRESA').val(), rhid_, dt_adm;

                cleanTotais();

                if (empresa_) {
                    //RHID changed...
                    if (evt.target.id === 'xt_RHID') {
                        rhid_ = $('#xt_RHID').val();
                        $('#xt_DT_ADMISSAO').val('').trigger('change').trigger('chosen:update');
                        $("#xt_DT_ADMISSAO").chosen('destroy');

                        if (empresa_ && rhid_) {
                            getDT_ADM(empresa_,rhid_);
                            dt_adm = $("#xt_DT_ADMISSAO").val();
                        }
                    } else {
                        rhid_ = $('#xt_RHID').val();
                        dt_adm = $("#xt_DT_ADMISSAO").val();
                        //ALL FILTER PARAMETERS ARE COMPILED -> EXECUTE QUERY
                        if ( rhid_ && dt_adm ) {
                            displayContextInfo ( $('#xt_DT_ADMISSAO option:selected').attr('data-othervalues') );

                            ++cnt;
                            if (cnt === 1) { //TRICK :: Because DT_ADMISSAO triggers twice...
                                //CALL
                                for (var key in window) {
                                    var $obj = window[key];
                                    if ($obj instanceof QuadTable && $.fn.DataTable.isDataTable("#" + $obj.tableId)) {
                                         if ($obj.externalFilter && $($obj.externalFilter.template).hasClass("multiInstance")) {
                                             $obj.where_str = "";
                                             debugger;
                                             $obj.multiInstanceFilter($(this));
                                        //$("#" + $obj.tableId + "_wrapper th:last-child").find(".tblCreateBut").show();
                                        //$(window).trigger("resize");
                                        if ( String($obj['table']) ===  'RHID_PERIODOS_VIEW') {
                                            setTimeout(function() {

                                                var idx = _.findKey(RHID_PERIODOS_VIEW.tbl.rows().data(), {
                                                    ABERTO: 'S',
                                                    COM_OCORRENCIA: 'S'
                                                });

                                                if (idx) {
                                                    var el = RHID_PERIODOS_VIEW.tbl.row(idx).node();
                                                    RHID_PERIODOS_VIEW.tbl.row(idx).select();
                                                    $(el).trigger("click");
                                                }
                                            }, 150 );
                                        }
                                        }
                                    } else if ($obj instanceof QuadForm) {
                                    if ($obj.externalFilter && $($obj.externalFilter.template).hasClass("multiInstance")) {
                                        $obj.where_str = "";
                                        debugger;
                                        $obj.multiInstanceFilter($(this), true);
                                    }
                                }
                                }
                                cnt = 0;
                                //END CALL
                            } else {
                                //console.log('Once is enought...');
                                null;
                            }

                        }
                    }



                }
            });

            //Get Período ABERTO com OCORRÊNCIAS, para selecção automática
            function getPeriodoAberto (instance, filter) {
                    return $.Deferred(function () {
                        var self = this;

                        instance.multiInstanceFilter(filter);
                        self.resolve();
                    });
                };
            //END Get Período ABERTO com OCORRÊNCIAS, para selecção automática

            //Change INSTANCE FILTER :: OTHER FILTERS Propagation
            $("#xt_DSP_EMPRESA").off("change");
            $("#xt_DSP_EMPRESA").on("change", function (evt) {
                var empresa_ = $('#xt_DSP_EMPRESA').val(), el = $('#xt_RHID');
                if (empresa_) {
                    getRhid(empresa_);
                }
                setTimeout(function() {
                    $('#DG_MESES > tbody  > tr').each(function() {
                        if($(this).hasClass( "selected" )) {
                            $(this).removeClass("selected");
                        }

                        if($(this).find('span').hasClass('label current-month')) {
                            $(this).addClass("selected");
                        }
                    });
                },1000);
            });

            //Change Período
            $(document).off('click', "#RHID_PERIODOS_VIEW > tbody > tr");
            $(document).on('click', "#RHID_PERIODOS_VIEW > tbody > tr", function( ev ){
                var masterRow = $(this),
                    masterRecord = RHID_PERIODOS_VIEW.tbl.row('.selected').data();
                        cleanTotais();
                    if (masterRecord) {
                        getTotaisRecibo();
                    }

            });
            //Change Período

            //rl_calc, rl_emit, rl_remove, prop_calc, prop_remove, prop_simulation, retro_calc, retro_replace
            $(document).off('click', '.quad-process');
            $(document).on('click', '.quad-process', function (ev) {
               var option = $(this).attr("id"),
                   data = {};
                var x = RHID_PERIODOS_VIEW.selectedRowData(), sql_str,t0, wk,bindArr = [];
                var y  = RH_ID_RUBRICAS.sFilters;
                console.log(y);
                if (RHID_PERIODOS_VIEW.tbl.rows( '.selected' ).any()) { //ROW on MASTER IS SELECTED
                    //BIND Variables
                    bindArr.push( {name : "EMPRESA", value : x['EMPRESA']} );
                    bindArr.push( {name : "RHID", value : x['RHID']} );
                    bindArr.push( {name : "DT_ADMISSAO", value : x['DT_ADMISSAO']} );
                    bindArr.push( {name : "ANO", value : x['ANO']} );
                    bindArr.push( {name : "MES", value : x['MES']} );
                    data = {
                        "rhid": x['RHID'],
                        "empresa": x['EMPRESA'],
                        "dt_admissao": x['DT_ADMISSAO'],
                        "ano": x['ANO'],
                        "mes":x['MES']
                    }

                    if (option === 'rl_calc') {
                        alert('Cálculo do recibo :' + JSON.stringify(data) );
                    } else if (option === 'rl_emit') {
                        alert('Emissão do recibo :' + JSON.stringify(data) );
                    } else if (option === 'rl_remove') {
                        alert('Remoção do recibo :' + JSON.stringify(data) );
                    } else if (option === 'prop_calc') {
                        alert('Cálculo dos proporcionais :' + JSON.stringify(data) );
                    } else if (option === 'prop_remove') {
                        alert('Remoção dos proporcionais :' + JSON.stringify(data) );
                    } else if (option === 'prop_simulation') {
                        alert('Simulação dos proporcionais :' + JSON.stringify(data) );
                    } else if (option === 'retro_calc') {
                        alert('Cálculo do retroativo :' + JSON.stringify(data) );
                    } else if (option === 'retro_replace') {
                        alert('Substituição do retroativo :' + JSON.stringify(data) );
                    } else {
                        alert('Opção inválida');
                    }

                } else {
                    alert('PF selecione o recibo lógico de um Colaborador.');
                }
            });

            /* Mostra/esconde os valores difenenciais e os valores do mês */
            function manageInstanceColumns() {
                if ( $('#show_diffs').is(':checked') ) {
                    $('#proc_actions').removeClass('btn-primary').addClass('btn-danger');
                        QuadTablesShowHideColumns(RH_ID_RUBRICAS, {"show": ['VALOR_DIF'],"hide": ['VALOR']});


                        QuadTablesShowHideColumns(RH_ID_INCIDENCIAS, {"show": ['BI_COLAB_DIF', 'BI_ENT_PATR_DIF'],"hide": ['BI_COLABORADOR', 'BI_ENT_PATRONAL']});



                        QuadTablesShowHideColumns(RH_ID_DESCONTOS, {
                            "show": ['BI_ED_COLAB_DIF','BI_ED_EP_DIF','TX_COLAB_DIF','TX_EP_DIF','DESCT_COLAB_DIF','DESCT_EP_DIF'],
                            "hide": ['BI_ED_COLAB','BI_ED_EP','TX_COLAB','TX_EP','DESCT_COLAB','DESCT_EP']
                        });




                } else {
                    $('#proc_actions').removeClass('btn-danger').addClass('btn-primary');
                        QuadTablesShowHideColumns(RH_ID_RUBRICAS, {"hide": ['VALOR_DIF'],"show": ['VALOR']});



                        QuadTablesShowHideColumns(RH_ID_INCIDENCIAS, {"hide": ['BI_COLAB_DIF', 'BI_ENT_PATR_DIF'],"show": ['BI_COLABORADOR', 'BI_ENT_PATRONAL']});



                        QuadTablesShowHideColumns(RH_ID_DESCONTOS, {
                            "hide": ['BI_ED_COLAB_DIF','BI_ED_EP_DIF','TX_COLAB_DIF','TX_EP_DIF','DESCT_COLAB_DIF','DESCT_EP_DIF'],
                            "show": ['BI_ED_COLAB','BI_ED_EP','TX_COLAB','TX_EP','DESCT_COLAB','DESCT_EP']
                        });





                }
            }

            //Toogle VIEW "Diferenciais" or "Mês"
            $(document).off('click', '#show_diffs');
            $(document).on('click', '#show_diffs', function (ev) {
                manageInstanceColumns();
            });

            //Toogle VIEW "Diferenciais" or "Mês"
            //Need because on interface 1st run only on TAB change the instance.tbl API's are available (RH_ID_INCIDENCIAS, RH_ID_DESCONTOS)
          //$(document).off("shown.bs.tab", 'a[data-toggle="tab"]');

            $("#demo_panel-tabs a").on("shown.bs.tab",function(e) {
                var container = $(this).attr("href"); //Master tab-pane (top tab)

                if ( container === "#Tab1" ||  container === "#Tab2"  || container === "#Tab3" ) {
                    setTimeout(function() {
                        manageInstanceColumns();
                    }, 1000);
                }
            });

            setTimeout(function() {
            //tab a activar

             $("#demo_panel-tabs > li:nth-child(2) > a").trigger("click")   //.addClass("show") ???
             $('#tab2').tab('show');
            }, 1000);

        }
        //END RHID Filter


    });
</script>
