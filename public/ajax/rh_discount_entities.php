<?php
    require_once '../init.php';
?>
<style>
    #xt_DT_VIGOR {
        width: 85px !important;
        padding: .5rem .65rem !important;
    }
</style>
<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-end">
                <div class="panel-toolbar pr-3 align-self-end tabs__">
                    <ul id="demo_panel-tabs" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#Tab1" role="tab" aria-selected="true"><?php echo $ui_discount_groups_regimes; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab2" role="tab" aria-selected="true"><?php echo $ui_discount_entities; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab3" role="tab" aria-selected="true"><?php echo $ui_cirs_tables; ?></a>
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
                                            <a class="nav-link active" data-toggle="tab" href="#Tab11" role="tab" aria-selected="true"><?php echo $ui_discount_groups; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Tab12" role="tab" aria-selected="true"><?php echo $ui_discount_regimes; ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-container show">
                                <div class="panel-content">
                                    <div class="tab-content">
                                        <!-- TAB #1.1 -->
                                        <div class="tab-pane fade active show" id="Tab11" role="tabpanel">
                                            <a id="RH_GRP_ENT_DESCT_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="RH_GRP_ENT_DESCT" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                            <div class="row mt-4">
                                                <div class="col-xl-12">
                                                    <div id="panel-11" class="panel">
                                                        <div class="panel-hdr">
                                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                                            <h2><?php echo $ui_translate; ?></h2>
                                                        </div>
                                                        <div class="panel-container show">
                                                            <div class="panel-content">
                                                                <a id="RH_GRP_ENT_DESCT_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                                <table id="RH_GRP_ENT_DESCT_TRADS" class="table table-bordered table-hover table-striped w-100"></table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END TAB #1.1 -->
                                        
                                        <!-- TAB #1.2 -->
                                        <div class="tab-pane fade" id="Tab12" role="tabpanel">
                                            <a id="RH_DEF_REGIMES_DESCONTO_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="RH_DEF_REGIMES_DESCONTO" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                            <div class="row mt-4">
                                                <div class="col-xl-12">
                                                    <div id="panel-11" class="panel">
                                                        <div class="panel-hdr">
                                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                                            <h2><?php echo $ui_translate; ?></h2>
                                                        </div>
                                                        <div class="panel-container show">
                                                            <div class="panel-content">
                                                                <a id="RH_DEF_REGIMES_DESCONTO_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                                <table id="RH_DEF_REGIMES_DESCONTO_TRADS" class="table table-bordered table-hover table-striped w-100"></table>
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
                            <a id="RH_DEF_ENTIDADES_DESCONTO_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="RH_DEF_ENTIDADES_DESCONTO" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            
                            <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-start">
                                <div class="panel-toolbar pr-3 align-self-end">
                                    <ul id="panel-tab-1-1" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#Tab21" role="tab" aria-selected="true"><?php echo $ui_discount_taxes; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Tab22" role="tab" aria-selected="true"><?php echo $ui_member_numbers; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Tab23" role="tab" aria-selected="true"><?php echo $ui_translations; ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-container show">
                                <div class="panel-content">
                                    <div class="tab-content">
                                        <!-- TAB #2.1 -->
                                        <div class="tab-pane fade active show" id="Tab21" role="tabpanel">
                                            <a id="RH_DEF_TAXAS_DESCONTO_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="RH_DEF_TAXAS_DESCONTO" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                        </div>
                                        <!-- END TAB #2.1 -->
                                        
                                        <!-- TAB #2.2 -->
                                        <div class="tab-pane fade" id="Tab22" role="tabpanel">
                                            <a id="RH_DEF_NRS_ADERENTE_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="RH_DEF_NRS_ADERENTE" class="table table-bordered table-hover table-striped w-100"></table>
                                        </div>                                        
                                        <!-- END TAB #2.2 -->

                                        <!-- TAB #2.3 -->
                                        <div class="tab-pane fade" id="Tab23" role="tabpanel">
                                            <a id="RH_DEF_ENT_DESCONTO_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="RH_DEF_ENT_DESCONTO_TRADS" class="table table-bordered table-hover table-striped w-100"></table>
                                        </div>                                        
                                        <!-- END TAB #2.3 -->
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #2 -->
                        
                         <!-- TAB #3 -->
                        <div class="tab-pane fade" id="Tab3" role="tabpanel">
                            
<!--                            <form id="IRS_filter" class="smart-form" novalidate="novalidate">
                                <fieldset style="padding: 5px 0px 5px;margin-bottom: 10px">
                                    <section class="col col-xs-12 col-sm-6 col-md-6 col-lg-1">
                                        <label for="xt_ANO" class="label required"><?php echo $ui_year; ?></label>
                                        <label class="input">
                                            <input name="ANO" id="xt_ANO" type="number" step="1" class="form-control" autocomplete="nope" value="<?php echo date('Y'); ?>"/>
                                        </label>
                                    </section>                    

                                    <section class="col col-xs-12 col-sm-6 col-md-6 col-lg-3">
                                        <label for="xt_TABELA_IRS"  class="label"><?php echo $ui_table; ?></label>
                                        <label class="input">
                                            <select name="TABELA_IRS" id="xt_TABELA_IRS" domain-list="true" dependent-group="RH_TABELA_IRS" class="form-control chosen"></select>
                                        </label>
                                    </section>

                                    <section class="col col-xs-12 col-sm-6 col-md-6 col-lg-3">
                                        <label for="xt_TP_TABELA_IRS"  class="label"><?php echo $ui_type; ?></label>
                                        <label class="input">
                                            <select name="TP_TABELA_IRS" id="xt_TP_TABELA_IRS" domain-list="true" dependent-group="RH_DEF_IRS.TP_TABELA_IRS" class="form-control chosen"></select>
                                        </label>
                                    </section>

                                    <section class="col col-xs-12 col-sm-6 col-md-6 col-lg-2">
                                        <label for="xt_DT_VIGOR" class="label"><?php echo $ui_effective_dt; ?></label>
                                        <label class="input">
                                            <input name="DT_VIGOR" id="xt_DT_VIGOR" class="form-control dateYearMonth" autocomplete="nope" datatype="dateYearMonth"/>
                                        </label>
                                        <p class="note"><?php echo '('.$hint_year_month.')'; ?></p>
                                    </section>                                           
                                </fieldset>
                            </form>  -->
<form id="IRS_filter" novalidate="novalidate">
        <div class="form-row mb-3">
            <div class="col-md-1 form-group">
                <label class="form-label required" for="xt_ANO"><?php echo $ui_year; ?></label>
                <input name="ANO" id="xt_ANO" type="number" step="1" class="form-control" autocomplete="nope" value="<?php echo date('Y'); ?>"/>
            </div>
            <div class="col-md-3 form-group">
                <label class="form-label required" for="xt_TABELA_IRS"><?php echo $ui_table; ?></label>
                <select name="TABELA_IRS" id="xt_TABELA_IRS" domain-list="true" dependent-group="RH_TABELA_IRS" class="form-control chosen"></select>
            </div>
            <div class="col-md-3 form-group">
                <label class="form-label" for="xt_TP_TABELA_IRS"><?php echo $ui_type; ?></label>
                <select name="TP_TABELA_IRS" id="xt_TP_TABELA_IRS" domain-list="true" dependent-group="RH_DEF_IRS.TP_TABELA_IRS" class="form-control chosen"></select>
            </div>
            <div class="col-md-2 form-group">
                <label class="form-label" for="xt_DT_VIGOR"><?php echo $ui_year; ?></label>
                <input name="DT_VIGOR" id="xt_DT_VIGOR" class="form-control dateYearMonth" autocomplete="nope" datatype="dateYearMonth"/>
                <span class="help-block ml-1"><?php echo '('.$hint_year_month.')'; ?></span>
            </div>                        
        </div>
</form>                            
                            <a id="RH_DEF_IRS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="RH_DEF_IRS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            
                            
                        </div>
                         <!-- END TAB #3 -->
                        
                    </div>                    
                </div>                    

            </div> 
        </div>
    </div>
</div>

<script>
    pageSetUp();
    
    $(document).ready(function () {

        //Tipos Vínculos Contratuais
        var optionsRH_GRP_ENT_DESCT = {
            "tableId": 'RH_GRP_ENT_DESCT',
            "table": "CG_REF_CODES",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_discount_group; ?>",            
            "pk": {
                "primary": {
                    "RV_DOMAIN": {"type": "varchar"},
                    "RV_LOW_VALUE": {"type": "varchar"}
                }
            },
            "detailsObjects": ['RH_GRP_ENT_DESCT_TRADS'],
            "initialWhereClause": "RV_DOMAIN = 'RH_GRP_ENT_DESCT' ",
            "order_by": "RV_LOW_VALUE",
            "scrollY": "234", 
            "recordBundle": 8,
            "pageLenght": 8,  
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
                    "def": "RH_GRP_ENT_DESCT",
                    "className": "right visibleColumn",
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
                    "title": "<?php echo mb_strtoupper($ui_retirement.' <sup>('.$ui_relatorio_unico.')</sup>', 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_retirement; ?>", //Editor
                    "fieldInfo": "<?php echo $ui_relatorio_unico; ?>",
                    "data": 'RV_HIGH_VALUE',
                    "name": 'RV_HIGH_VALUE',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'RU_REG_REFORMA',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['RU_REG_REFORMA'], {'RV_LOW_VALUE': val});
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
                        return RH_GRP_ENT_DESCT.crudButtons(true, true, true);
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
                    }
                }
            },
        };
        RH_GRP_ENT_DESCT = new QuadTable();
        RH_GRP_ENT_DESCT.initTable($.extend({}, datatable_instance_defaults, optionsRH_GRP_ENT_DESCT));        
        //END Tipos Vínculos Contratuais

        //Document Types Trads 
        var optionsRH_GRP_ENT_DESCT_TRADS = {
            "tableId": 'RH_GRP_ENT_DESCT_TRADS',
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
                "RH_GRP_ENT_DESCT": {
                    "RV_DOMAIN": "RV_DOMAIN",
                    "RV_LOW_VALUE": "RV_LOW_VALUE"
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
                }, {
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_TRAD',
                    "name": 'DSR_TRAD',
                    "className": "visibleColumn",
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
                        return RH_GRP_ENT_DESCT_TRADS.crudButtons(true, true, true);
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
                    "DSR_TRAD": {
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
        RH_GRP_ENT_DESCT_TRADS = new QuadTable();
        RH_GRP_ENT_DESCT_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsRH_GRP_ENT_DESCT_TRADS));     
        //END Document Types Trads        
        
        //Regimes Desconto
        var optionRH_DEF_REGIMES_DESCONTO = {
            "tableId": "RH_DEF_REGIMES_DESCONTO",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_discount_regime; ?>",
            "table": "RH_DEF_REGIMES_DESCONTO", 
            "pk": {
                "primary": {
                    "CD_REG_DESC": {"type": "varchar"}
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
            "detailsObjects": ['RH_DEF_REGIMES_DESCONTO_TRADS'],
            "order_by": "CD_REG_DESC",
            "scrollY": "234", 
            "recordBundle": 8,
            "pageLenght": 8, 
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
                    "data": 'CD_REG_DESC',
                    "name": 'CD_REG_DESC',
                    "className": "visibleColumn",                   
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_REG_DESC',
                    "name": 'DSP_REG_DESC',
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_REG_DESC',
                    "name": 'DSR_REG_DESC',                    
                    "className": "visibleColumn",                    
                }, {
                    "responsivePriority": 5, 
                    "title": "<?php echo mb_strtoupper($ui_complement, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_complement; ?>", //Editor
                    "data": 'COMPLEM_NR_ADR',
                    "name": 'COMPLEM_NR_ADR',                    
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
                        return RH_DEF_REGIMES_DESCONTO.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "CD_REG_DESC": {
                        required: true,
                        maxlength: 8
                    },
                    "DSP_REG_DESC": {
                        required: true,
                        maxlength: 40,
                    },
                    "DSR_REG_DESC": {
                        required: false,
                        maxlength: 25,
                    },
                    "COMPLEM_NR_ADR": {
                        maxlength: 3
                    }
                }
            }
        };
        RH_DEF_REGIMES_DESCONTO = new QuadTable();
        RH_DEF_REGIMES_DESCONTO.initTable( $.extend({}, datatable_instance_defaults, optionRH_DEF_REGIMES_DESCONTO) );
        //END Regimes Desconto

        //Regimes Desconto Trads
        var optionsRH_DEF_REGIMES_DESCONTO_TRADS = {
            "tableId": "RH_DEF_REGIMES_DESCONTO_TRADS",
            "table": "RH_DEF_REGIMES_DESCONTO_TRADS",
            "pk": {
                "primary": {
                    "CD_REG_DESC": {"type": "varchar"},                      
                    "CD_LINGUA": {"type": "number"},                    
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "RH_DEF_REGIMES_DESCONTO": {
                    "CD_REG_DESC": "CD_REG_DESC"
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
                    "data": 'CD_REG_DESC',
                    "name": 'CD_REG_DESC',                    
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
                        return RH_DEF_VINCULO_CONTRAT_TRADS.crudButtons(true,true,true);
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
        RH_DEF_REGIMES_DESCONTO_TRADS = new QuadTable();
        RH_DEF_REGIMES_DESCONTO_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsRH_DEF_REGIMES_DESCONTO_TRADS));
        //END Regimes Desconto Trads
        
        //Entidades Desconto        
        var optionRH_DEF_ENTIDADES_DESCONTO = {
            "tableId": "RH_DEF_ENTIDADES_DESCONTO",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_discount_entity; ?>",
            "table": "RH_DEF_ENTIDADES_DESCONTO", 
            "pk": {
                "primary": {
                    "CD_ED": {"type": "number"}
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
            "detailsObjects": ['RH_DEF_TAXAS_DESCONTO','RH_DEF_NRS_ADERENTE','RH_DEF_ENT_DESCONTO_TRADS'],
            "order_by": "CD_ED",
            "scrollY": "234", 
            "recordBundle": 8,
            "pageLenght": 8, 
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
                    "data": 'CD_ED',
                    "name": 'CD_ED',
                    "className": "visibleColumn",                   
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_ED',
                    "name": 'DSP_ED',
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_ED',
                    "name": 'DSR_ED',                    
                    "className": "visibleColumn",     
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_GRUPO_ED',
                    "name": 'CD_GRUPO_ED',                    
                    "type": "hidden",
                    "visible": false
                }, {
                    "responsivePriority": 5, 
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
                        "distribute-value": "CD_GRUPO_ED",
                        "decodeFromTable": "CG_REF_CODES A",
                        "desigColumn": "A.RV_MEANING", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.                        
                        "orderBy": "A.RV_LOW_VALUE", //usado no complexList.php
                        "class": "form-control complexList chosen",
                        //"disabled": true, //Permite inibir o campo no Editor
                        "whereClause": " AND A.RV_DOMAIN = 'RH_GRP_ENT_DESCT'"
                    }                     
                }, {
                    "responsivePriority": 6, 
                    "title": "<?php echo mb_strtoupper($ui_accounting_interface_short, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_accounting_interface_short; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_accounting_interface_short; ?>",
                    "data": 'INCLUIR_IC',
                    "name": 'INCLUIR_IC',
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
                    "responsivePriority": 7, 
                    "title": "<?php echo mb_strtoupper($ui_reimbursements, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_reimbursements; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_allows_reimbursements; ?>",
                    "data": 'ESTORNOS',
                    "name": 'ESTORNOS',
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
                    "title": "<?php echo mb_strtoupper($ui_pay_slip_short, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_pay_slip_short; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_pay_slip_description; ?>", //Editor
                    "data": 'TXT_RECIBO',
                    "name": 'TXT_RECIBO',                    
                    "className": "none visibleColumn",
                }, {
                    "title": "<?php echo mb_strtoupper($ui_union_area, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_union_area; ?>", //Editor
                    "data": 'AREA_SINDICAL',
                    "name": 'AREA_SINDICAL',
                    "type": "select",
                    "className": "none visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'RH_AREA_SINDICAL',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['RH_AREA_SINDICAL'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_tax_id_number_short, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_tax_id_number_short; ?>", //Editor
                    "data": 'NIF',
                    "name": 'NIF',                    
                    "className": "none visibleColumn",
                }, {
                    "title": "<?php echo mb_strtoupper($ui_address, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_address; ?>", //Editor
                    "data": 'MORADA',
                    "name": 'MORADA',                    
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
                        return RH_DEF_ENTIDADES_DESCONTO.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "CD_ED": {
                        required: true,
                        integer: true,
                        maxlength: 6
                    },
                    "DSP_ED": {
                        required: true,
                        maxlength: 40,
                    },
                    "DSR_ED": {
                        required: false,
                        maxlength: 25,
                    },
                    "DSP_GRUPO_ED": {
                        required: false
                    },
                    "INCLUIR_IC": {
                        required: true
                    },
                    "ESTORNOS": {
                        required: true
                    },
                    "ACTIVO": {
                        required: true
                    },
                    "NIF": {
                        maxlength: 10
                    },
                    "MORADA": {
                        maxlength: 200
                    },
                    "TXT_RECIBO": {
                        maxlength: 25
                    },
                }
            }
        };
        RH_DEF_ENTIDADES_DESCONTO = new QuadTable();
        RH_DEF_ENTIDADES_DESCONTO.initTable( $.extend({}, datatable_instance_defaults, optionRH_DEF_ENTIDADES_DESCONTO) );
        //END Entidades Desconto

        //Taxas de Desconto
        var optionsRH_DEF_TAXAS_DESCONTO = {
            "tableId": "RH_DEF_TAXAS_DESCONTO",
            "table": "RH_DEF_TAXAS_DESCONTO",
            "pk": {
                "primary": {
                    "CD_ED": {"type": "number"},
                    "CD_REG_DESC": {"type": "varchar"}
                }
            },
            "dependsOn": {
                "RH_DEF_ENTIDADES_DESCONTO": {
                    "CD_ED": "CD_ED"
                }
            },
            "order_by": "CD_ED",
            "recordBundle": 11, 
            "pageLenght": 11, 
            "scrollY": "406",
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "className": "control toBottom toCenter",
                    "width": "1%",
                    "style": "width:1%;",
                    "defaultContent": ''  
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_ED',
                    "name": 'CD_ED',                    
                    "type": "hidden",
                    "visible": false
                }, {
                    "title": "",
                    "label": "",
                    "data": 'CD_REG_DESC',
                    "name": 'CD_REG_DESC',
                    "type": "hidden",
                    "visible": false
                }, {
                    "responsivePriority": 2,
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_discount_regime, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_discount_regime; ?>",
                    "data": 'DSP_REG_DESC',
                    "name": 'DSP_REG_DESC',
                    "type": "select",
                    "className": "visibleColumn",
                    //"visible": false, //DataTables
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "REGIME",
                        "dependent-level": 1,
                        "data-db-name": 'A.CD_REG_DESC',
                        "decodeFromTable": 'RH_DEF_REGIMES_DESCONTO A',
                        "class": "form-control complexList chosen", 
                        "desigColumn": "A.DSP_REG_DESC", 
                        "orderBy": "A.CD_REG_DESC",
//                        "filter": {
//                            "create": " AND ACTIVO = 'S' AND CD_SITUACAO != ':CD_SITUACAO'", //On-New-Record
//                            "edit": " AND ACTIVO = 'S' AND CD_SITUACAO != ':CD_SITUACAO'", //On-Edit-Record
//                        }
                    }             
                }, {
                   "responsivePriority": 3, 
                   "title": "<?php echo mb_strtoupper($ui_default_assign, 'UTF-8'); ?>", //Datatables :: Original
                   "label": "<?php echo $ui_default_assign; ?>", //Editor
                   "data": 'DEFEITO',
                   "name": 'DEFEITO',
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
                    "title": "",
                    "label": "",
                    "data": 'CD_GRP_CONTAB',
                    "name": 'CD_GRP_CONTAB',
                    "type": "hidden",
                    "datatype": "sequence",
                    "visible": false
                }, {
                    "responsivePriority": 4,
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_discount_group, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_discount_group; ?>",
                    "data": 'DSP_GRP_DESC',
                    "name": 'DSP_GRP_DESC',
                    "type": "select",
                    "className": "visibleColumn",
                    //"visible": false, //DataTables
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "GRUPO_DESCONTO",
                        "dependent-level": 1,
                        "data-db-name": 'A.RV_LOW_VALUE',
                        "distribute-value": "CD_GRP_CONTAB",
                        "decodeFromTable": 'CG_REF_CODES A',
                        "class": "form-control complexList chosen", 
                        "desigColumn": "A.RV_MEANING", 
                        "whereClause": " AND A.RV_DOMAIN = 'RH_GRP_ENT_DESCT' ",
                        "orderBy": "A.RV_LOW_VALUE"
                    }
                }, {
                    "responsivePriority": 5,
                    "title": "<?php echo mb_strtoupper($ui_employee_quota, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_employee_quota; ?>", //Editor
                    "data": 'QUOTA_COLB',
                    "name": 'QUOTA_COLB',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 30%;"
                    }
                }, {
                    "responsivePriority": 6,
                    "title": "<?php echo mb_strtoupper($ui_employee_tax, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_employee_tax; ?>", //Editor
                    "data": 'TX_COLB',
                    "name": 'TX_COLB',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 30%;"
                    }
                }, {
                    "responsivePriority": 7,
                    "title": "<?php echo mb_strtoupper($ui_compensatory_tax, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_compensatory_tax; ?>", //Editor
                    "data": 'TX_COMP_COLB',
                    "name": 'TX_COMP_COLB',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 30%;"
                    }                    
                }, {
                    "responsivePriority": 8,
                    "title": "<?php echo mb_strtoupper($ui_employeer_quota, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_employeer_quota; ?>", //Editor
                    "data": 'QUOTA_ENT',
                    "name": 'QUOTA_ENT',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 30%;"
                    }                    
                }, {
                    "responsivePriority": 9,
                    "title": "<?php echo mb_strtoupper($ui_employeer_tax, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_employeer_tax; ?>", //Editor
                    "data": 'TX_ENT',
                    "name": 'TX_ENT',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 30%;"
                    }                    
                }, {
                    "responsivePriority": 10,
                    "title": "<?php echo mb_strtoupper($ui_rounding_base_short, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_rounding_base_short; ?>", //Editor
                    "data": 'BASE_ARRED',
                    "name": 'BASE_ARRED',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 30%;"
                    }
                }, {
                     "responsivePriority": 11, 
                     "title": "<?php echo mb_strtoupper($ui_rounding_type_short, 'UTF-8'); ?>", //Datatables :: Original
                     "label": "<?php echo $ui_rounding_type_short; ?>", //Editor
                     "data": 'TP_ARRED',
                     "name": 'TP_ARRED',
                     "type": "select",
                     "def": "S",
                     "className": "visibleColumn",
                     "attr": {
                         "domain-list": true,
                         "dependent-group": 'DG_TP_ARRED',
                         "class": "form-control"
                     },
                     "render": function (val, type, row) {
                         if (val != null) {
                             var o = _.find(initApp.joinsData['DG_TP_ARRED'], {'RV_LOW_VALUE': val});
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
                        return RH_DEF_TAXAS_DESCONTO.crudButtons(true,true,true);
                    }
                }
            ],
            validations: {
                rules: {
                    "DSP_REG_DESC": {
                        required: true
                    },
                    "DEFEITO": {
                        required: true
                    },
                    "DSP_REG_DESC": {
                        required: true
                    },
                    "BASE_ARRED": {
                        number: true
                    },
                    "QUOTA_COLB": {
                        number: true
                    },
                    "QUOTA_ENT": {
                        number: true
                    },
                    "TX_COMP_COLB": {
                        number: true
                    },
                    "TX_COLB": {
                        number: true
                    },
                    "TX_ENT": {
                        number: true
                    },
                }
            }
        };
        RH_DEF_TAXAS_DESCONTO = new QuadTable();
        RH_DEF_TAXAS_DESCONTO.initTable($.extend({}, datatable_instance_defaults, optionsRH_DEF_TAXAS_DESCONTO));
        //END Taxas de Desconto        

        //Números de Aderente
        var optionsRH_DEF_NRS_ADERENTE = {
            "tableId": "RH_DEF_NRS_ADERENTE",
            "table": "RH_DEF_NRS_ADERENTE",
            "pk": {
                "primary": {
                    "CD_ED": {"type": "number"},
                    "EMPRESA": {"type": "varchar"}
                }
            },
            "dependsOn": {
                "RH_DEF_ENTIDADES_DESCONTO": {
                    "CD_ED": "CD_ED"
                }
            },
            "order_by": "NR_ADERENTE",
            "recordBundle": 11, 
            "pageLenght": 11, 
            "scrollY": "406",
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "className": "control toBottom toCenter",
                    "width": "1%",
                    "style": "width:1%;",
                    "defaultContent": ''  
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_ED',
                    "name": 'CD_ED',                    
                    "type": "hidden",
                    "visible": false
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
                    "title": "<?php echo mb_strtoupper($ui_member_number, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_member_number; ?>", //Editor
                    "data": 'NR_ADERENTE',
                    "name": 'NR_ADERENTE',
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_reference, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_reference; ?>", //Editor
                    "data": 'REFERENCIA',
                    "name": 'REFERENCIA',
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 5,
                    "title": "<?php echo mb_strtoupper($ui_password, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_password; ?>", //Editor
                    "data": 'SENHA',
                    "name": 'SENHA',
                    "className": "visibleColumn",
                }, {
                   "responsivePriority": 6, 
                   "title": "<?php echo mb_strtoupper($ui_active, 'UTF-8'); ?>", //Datatables :: Original
                   "label": "<?php echo $ui_active; ?>", //Editor
                   "data": 'ACTIVA',
                   "name": 'ACTIVA',
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
                        return RH_DEF_NRS_ADERENTE.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DSP_EMPRESA": {
                        required: true
                    },
                    "NR_ADERENTE": {
                        maxlength: 15
                    },
                    "REFERENCIA": {
                        maxlength: 100
                    },
                    "SENHA": {
                        maxlength: 150
                    },
                    "ACTIVA": {
                        required: true
                    }
                }
            }
        };
        RH_DEF_NRS_ADERENTE = new QuadTable();
        RH_DEF_NRS_ADERENTE.initTable($.extend({}, datatable_instance_defaults, optionsRH_DEF_NRS_ADERENTE));
        //END Números de Aderente

        //Entidades Desconto Trads
        var optionsRH_DEF_ENT_DESCONTO_TRADS = {
            "tableId": "RH_DEF_ENT_DESCONTO_TRADS",
            "table": "RH_DEF_ENT_DESCONTO_TRADS",
            "pk": {
                "primary": {
                    "CD_ED": {"type": "number"},                      
                    "CD_LINGUA": {"type": "number"},                    
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "RH_DEF_ENTIDADES_DESCONTO": {
                    "CD_ED": "CD_ED"
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
                    "data": 'CD_ED',
                    "name": 'CD_ED',                    
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
                        return RH_DEF_ENT_DESCONTO_TRADS.crudButtons(true,true,true);
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
        RH_DEF_ENT_DESCONTO_TRADS = new QuadTable();
        RH_DEF_ENT_DESCONTO_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsRH_DEF_ENT_DESCONTO_TRADS));
        //END Entidades Desconto Trads
        
        //Tabelas IRS
        var optionsRH_DEF_IRS = {
            "tableId": "RH_DEF_IRS",
            "table": "RH_DEF_IRS",
            "pk": {
                "primary": {
                    "ANO": {"type": "number"},
                    "TABELA_IRS": {"type": "varchar"},
                    "TP_TABELA_IRS": {"type": "varchar"},
                    "LIMITE": {"type": "number"}
                }
            },
            "externalFilter": {
                "template": {
                    "selector": "#IRS_filter",
                    "mandatory": ['ANO','TABELA_IRS','TP_TABELA_IRS'],
                    "optional": ['DT_VIGOR']                    
                }
            },    
            "order_by": "LIMITE",
            "recordBundle": 13, 
            "pageLenght": 13, 
            "scrollY": "391px",
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "className": "control toBottom toCenter",
                    "width": "1%",
                    "style": "width:1%;",
                    "defaultContent": ''  
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_year, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_year; ?>",
                    "data": 'ANO',
                    "name": 'ANO',
                    "className": "visibleColumn",
                    "render": function (val, type, row) {
                        val = new Date().getFullYear();
                        return val;
                   }
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_table, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_table; ?>", //Editor
                    "data": 'TABELA_IRS',
                    "name": 'TABELA_IRS',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'RH_TABELA_IRS',
                        "class": "form-control chosen"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['RH_TABELA_IRS'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }                   
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_type, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_type; ?>", //Editor
                    "data": 'TP_TABELA_IRS',
                    "name": 'TP_TABELA_IRS',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'RH_DEF_IRS.TP_TABELA_IRS',
                        "class": "form-control chosen"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['RH_DEF_IRS.TP_TABELA_IRS'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }
                }, {
                    "responsivePriority": 5,
                    "title": "<?php echo mb_strtoupper($ui_effective_dt, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_effective_dt; ?>", //Editor
                    "data": 'DT_VIGOR',
                    "name": 'DT_VIGOR',
                    "datatype": 'dateYearMonth',
                    "className": "none visibleColumn",
                    "attr": {
                        "class": "form-control dateYearMonth",
                        "autocomplete": "nope"
                    },
//                    "render": function (val, type, row) {
//                        if (val !== '') {
//                            return val.substr(0,7);
//                        } else {
//                            return '';
//                        }
//                    }
                }, {
                    "responsivePriority": 6,
                    "title": "<?php echo mb_strtoupper($ui_limit, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_limit; ?>", //Editor
                    "data": 'LIMITE',
                    "name": 'LIMITE',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 40%;"
                    }
                }, {
                    "responsivePriority": 7,
                    "title": "<?php echo mb_strtoupper(0, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo 0; ?>", //Editor
                    "data": 'TX_1',
                    "name": 'TX_1',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 40%;"
                    },
                    "render": function (val, type, row) {
                        return val + "%";
                    }    
                }, {
                    "responsivePriority": 8,
                    "title": "<?php echo mb_strtoupper(1, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo 1; ?>", //Editor
                    "data": 'TX_2',
                    "name": 'TX_2',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 40%;"
                    },
                    "render": function (val, type, row) {
                        return val + "%";
                    }
                }, {
                    "responsivePriority": 9,
                    "title": "<?php echo mb_strtoupper(2, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo 2  ; ?>", //Editor
                    "data": 'TX_3',
                    "name": 'TX_3',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 40%;"
                    },
                    "render": function (val, type, row) {
                        return val + "%";
                    }
                }, {
                    "responsivePriority": 10,
                    "title": "<?php echo mb_strtoupper(3, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo 3; ?>", //Editor
                    "data": 'TX_4',
                    "name": 'TX_4',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 40%;"
                    },
                    "render": function (val, type, row) {
                        return val + "%";
                    }
                }, {
                    "responsivePriority": 11,
                    "title": "<?php echo mb_strtoupper(4, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo 4; ?>", //Editor
                    "data": 'TX_5',
                    "name": 'TX_5',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 40%;"
                    }                    
                }, {
                    "responsivePriority": 12,
                    "title": "<?php echo mb_strtoupper(">=5", 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo ">=5"; ?>", //Editor
                    "data": 'TX_6',
                    "name": 'TX_6',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 40%;"
                    },
                    "render": function (val, type, row) {
                        return val + "%";
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
                        return RH_DEF_IRS.crudButtons(true,true,true);
                    }
                }
            ],
            validations: {
                rules: {
                    "ANO": {
                        required: true
                    },
                    "TABELA_IRS": {
                        required: true
                    },
                    "TP_TABELA_IRS": {
                        required: true
                    },
                    "LIMITE": {
                        number: true
                    },
                    "TX_1": {
                        number: true
                    },
                    "TX_2": {
                        number: true
                    },
                    "TX_3": {
                        number: true
                    },
                    "TX_4": {
                        number: true
                    },
                    "TX_5": {
                        number: true
                    },
                    "TX_6": {
                        number: true
                    },
                    "DT_VIGOR": {
                        required: true,
                        dateYearMonth: true
                    }
                }
            }
        };
        RH_DEF_IRS = new QuadTable();
        RH_DEF_IRS.initTable($.extend({}, datatable_instance_defaults, optionsRH_DEF_IRS));
        //END Tabelas IRS        
        
    });
</script>
