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
                            <a class="nav-link active" data-toggle="tab" href="#Tab1" role="tab" aria-selected="true"><?php echo $ui_currencies; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab2" role="tab" aria-selected="true"><?php echo $ui_idioms; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab3" role="tab" aria-selected="true"><?php echo $ui_countries; ?></a>
                        </li>
                    </ul>
                </div>
            </div>   
            
            <div class="panel-container show">
                <div class="panel-content">
                    
                    <div class="tab-content">

                         <!-- TAB #1 -->
                        <div class="tab-pane fade active show" id="Tab1" role="tabpanel">
                            <a id="DG_MOEDAS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="DG_MOEDAS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-11" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="fas fa-exchange"></i></span>&nbsp;
                                            <h2><?php echo $ui_exchange_rates; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="DG_CAMBIOS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="DG_CAMBIOS" class="table table-bordered table-hover table-striped w-100"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #1 -->

                         <!-- TAB #2 -->
                        <div class="tab-pane fade" id="Tab2" role="tabpanel">
                            <a id="DG_LINGUAS_ESTRANGEIRAS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="DG_LINGUAS_ESTRANGEIRAS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                        </div>
                         <!-- END TAB #2 -->
                        
                         <!-- TAB #3 -->
                        <div class="tab-pane fade" id="Tab3" role="tabpanel">

                            <a id="DG_PAISES_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="DG_PAISES" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            
                            <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-start">
                                <div class="panel-toolbar pr-3 align-self-end">
                                    <ul id="panel-tab-3-1" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#Tab31" role="tab" aria-selected="true"><?php echo $ui_territorial_organization; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Tab32" role="tab" aria-selected="true"><?php echo $ui_postal_codes; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Tab33" role="tab" aria-selected="true"><?php echo $ui_holidays; ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-container show">
                                <div class="panel-content">
                                    <div class="tab-content">
                                        <div class="tab-pane fade active show" id="Tab31" role="tabpanel">

                                            <div class="row mt-4">
                                                <div class="col-xl-12">
                                                    <div id="panel-11" class="panel">
                                                        <div class="panel-hdr">
                                                            <span class="widget-icon"> <i class="fas fa-exchange"></i></span>&nbsp;
                                                            <h2><?php echo $ui_districts; ?></h2>
                                                        </div>
                                                        <div class="panel-container show">
                                                            <div class="panel-content">
                                                                <a id="DG_DISTRITOS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                                <table id="DG_DISTRITOS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row mt-4">
                                                <div class="col-xl-12">
                                                    <div id="panel-11" class="panel">
                                                        <div class="panel-hdr">
                                                            <span class="widget-icon"> <i class="fas fa-exchange"></i></span>&nbsp;
                                                            <h2><?php echo $ui_counties; ?></h2>
                                                        </div>
                                                        <div class="panel-container show">
                                                            <div class="panel-content">
                                                                <a id="DG_CONCELHOS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                                <table id="DG_CONCELHOS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-4">
                                                <div class="col-xl-12">
                                                    <div id="panel-11" class="panel">
                                                        <div class="panel-hdr">
                                                            <span class="widget-icon"> <i class="fas fa-exchange"></i></span>&nbsp;
                                                            <h2><?php echo $ui_parishes; ?></h2>
                                                        </div>
                                                        <div class="panel-container show">
                                                            <div class="panel-content">
                                                                <a id="DG_FREGUESIAS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                                <table id="DG_FREGUESIAS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="tab-pane fade" id="Tab32" role="tabpanel">
                                            <a id="DG_CODIGOS_POSTAIS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="DG_CODIGOS_POSTAIS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                        </div>                                        
                                        <div class="tab-pane fade" id="Tab33" role="tabpanel">
                                            <a id="DG_FERIADOS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="DG_FERIADOS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                        </div>                                        
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

<script>
    pageSetUp();
    
    $(document).ready(function () {
        
        //Moedas
        var optionDG_MOEDAS = {
            "tableId": "DG_MOEDAS",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_currency; ?>",
            "table": "DG_MOEDAS", 
            "pk": {
                "primary": {
                    "CD_MOEDA": {"type": "varchar"}       
                }
            },                  
            "crudOnMasterInactive": {
                "condition": "data.ACTIVO == 'N' ",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },                    
            "detailsObjects": ['DG_CAMBIOS'],
            "order_by": "CD_MOEDA",
            "scrollY": "234", //"390", 
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
                    "data": 'CD_MOEDA',
                    "name": 'CD_MOEDA',
                    "className": "visibleColumn",                   
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DSP_MOEDA',
                    "name": 'DSP_MOEDA',                    
                    "className": "visibleColumn",                    
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'SIGLA_MOEDA',
                    "name": 'SIGLA_MOEDA',
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 6, 
                    "title": "<?php echo mb_strtoupper($ui_decimals_number, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_decimals_number; ?>", //Editor
                    "data": 'NR_DECIMAIS',
                    "name": 'NR_DECIMAIS',
                    "className": "visibleColumn right",
                }, {
                    "responsivePriority": 7, 
                    "title": "<?php echo mb_strtoupper($ui_integer_part, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_integer_part; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_integer_part_denomination; ?>", //Editor
                    "data": 'INTEIRO',
                    "name": 'INTEIRO',
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 7, 
                    "title": "<?php echo mb_strtoupper($ui_decimal_part, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_decimal_part; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_decimal_part_denomination; ?>", //Editor
                    "data": 'DM_DECIMAL',
                    "name": 'DM_DECIMAL',
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 5, 
                    "title": "<?php echo mb_strtoupper($ui_active, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo mb_strtoupper($ui_active, 'UTF-8'); ?>", //Editor
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
                        return DG_MOEDAS.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "CD_MOEDA": {
                        required: true,
                        maxlength: 4
                    },
                    "DSP_MOEDA": {
                        required: true,
                        maxlength: 40
                    },
                    "SIGLA_MOEDA": {
                        required: true,
                        maxlength: 4,
                    },
                    "NR_DECIMAIS": {
                        required: true,
                        integer: true,
                        maxlength: 4
                    },                    
                    "CAMBIO": {
                        required: true
                    },
                    "ACTIVO": {
                        required: true
                    },
                    "INTEIRO": {
                        maxlength: 100
                    },
                    "DM_DECIMAL": {
                        maxlength: 100
                    }
                }
            }
        };
        DG_MOEDAS = new QuadTable();
        DG_MOEDAS.initTable( $.extend({}, datatable_instance_defaults, optionDG_MOEDAS) );              
        //END Moedas

        //Câmbios
        var optionsDG_CAMBIOS = {
            "tableId": "DG_CAMBIOS",
            "table": "DG_CAMBIOS",
            "pk": {
                "primary": {
                    "CD_MOEDA_DE": {"type": "varchar"},
                    "CD_MOEDA_PARA": {"type": "varchar"},                     
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "DG_MOEDAS": {
                    "CD_MOEDA_DE": "CD_MOEDA"
                }
            },
            "order_by": "CD_MOEDA_PARA, DT_INI DESC",
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
                    "data": 'CD_MOEDA_DE',
                    "name": 'CD_MOEDA_DE',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_MOEDA_PARA',
                    "name": 'CD_MOEDA_PARA',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 2,
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_currency, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_currency; ?>",
                    "data": 'DSP_MOEDA',
                    "name": 'DSP_MOEDA',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "class": "form-control complexList chosen", 
                        "dependent-group": "MOEDAS",
                        "dependent-level": 1,
                        "data-db-name": "A.CD_MOEDA",
                        "distribute-value": "CD_MOEDA_PARA",
                        "decodeFromTable": "DG_MOEDAS A",
                        "desigColumn": "A.DSP_MOEDA", 
                        "orderBy": "A.CD_MOEDA",
                        "filter": {
                            "create": " AND A.ACTIVO = 'S' AND A.CD_MOEDA != ':CD_MOEDA_DE'", //On-New-Record
                            "edit": " AND A.ACTIVO = 'S' AND A.CD_MOEDA != ':CD_MOEDA_DE'", //On-Edit-Record
                        }
                    }
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_exchange, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_exchange; ?>", //Editor
                    "data": 'CAMBIO',
                    "name": 'CAMBIO',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 30%;"
                    }                    
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
                        return DG_CAMBIOS.crudButtons(true,true,true);
                    }
                }
            ],
            validations: {
                rules: {
                    DSP_MOEDA: {
                        required: true
                    },
                    CAMBIO: {
                        required: true,
                        number: true
                    },
                    DT_INI: {
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
        DG_CAMBIOS = new QuadTable();
        DG_CAMBIOS.initTable($.extend({}, datatable_instance_defaults, optionsDG_CAMBIOS));
        //END Câmbios

        //Línguas Estrangeiras
        var optionsDG_LINGUAS_ESTRANGEIRAS = {
            "tableId": 'DG_LINGUAS_ESTRANGEIRAS',
            "table": "DG_LINGUAS_ESTRANGEIRAS", 
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_idiom; ?>",
            "pk": {
                "primary": {
                    "CD_LINGUA": {"type": "number"}
                }
            },
            "crudOnMasterInactive": {
                "condition": "data.ATIVO === 'N' ",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },
            //"detailsObjects": [''],                    
            "order_by": "CD_LINGUA",
            "scrollY": "390", 
            "recordBundle": 12,
            "pageLenght": 12, 
            "responsive": true,
            "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
            "tableCols": [
                {
                    //"targets": 0,
                    "responsivePriority": 1,
                    "data": null,
                    "width": "1%", 
                    "className": "control toBottom toCenter",
                    "orderable": false,
                    "defaultContent": ''
                }, {
                    //"targets": 1,
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_LINGUA',
                    "name": 'CD_LINGUA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    //"targets": 2,
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_designation; ?>",
                    "data": 'DSP_LINGUA',
                    "name": 'DSP_LINGUA',
                    "className": "visibleColumn",
                    "attr": {
                        "name": 'DSP_LINGUA'
                    }
                }, {
                    //"targets": 3,
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_short_desig; ?>",
                    "data": 'DSR_LINGUA',
                    "name": 'DSR_LINGUA',
                    "className": "visibleColumn",
                    "attr": {
                        "name": 'DSR_LINGUA'
                    }
                }, {
                    //"targets": 4,
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'CODIGO',
                    "name": 'CODIGO',
                    "className": "visibleColumn",
                    "attr": {
                        "name": 'CODIGO'
                    }                    
                }, {
                    //"targets": 5,
                    "responsivePriority": 5,
                    "title": "<?php echo mb_strtoupper($ui_order_nr, 'UTF-8'); ?>"+'</span>', //Datatables
                    "label": "<?php echo $ui_order_nr; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_order_number; ?>",
                    "data": 'NR_ORDEM',
                    "name": 'NR_ORDEM',
                    "className": "none right visibleColumn",
                    "attr": {
                        "name": 'NR_ORDEM',
                        "class": "toRight",
                        "style": "width: 20%;",
                    }               
                }, {
                    //"targets": 6,
                    "title": "<?php echo mb_strtoupper($ui_active, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_active; ?>", //Editor
                    "data": 'ATIVO',
                    "name": 'ATIVO',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',
                        "class": "form-control",
                        "name": 'ATIVO'
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_SIM_NAO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }                  
                }, {
                    //"targets": 7,
                    "title": "<?php echo mb_strtoupper($ui_flag_classes, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_flag_classes; ?>",
                    "fieldInfo": "<?php echo $hint_flag_classes; ?>",
                    "data": 'FLAG_CLASSES',
                    "name": 'FLAG_CLASSES',
                    "className": "none visibleColumn",
                    "attr": {
                        "name": 'FLAG_CLASSES'
                    }
                }, {
                    //"targets": 8,
                    "title": "<?php echo mb_strtoupper($ui_label, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_label; ?>",
                    "fieldInfo": "<?php echo $hint_php_label_name; ?>",
                    "data": 'UI_LABEL',
                    "name": 'UI_LABEL',
                    "className": "none visibleColumn",
                    "attr": {
                        "name": 'UI_LABEL'
                    }
                }, {
                    //"targets": 9,
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
                        return DG_LINGUAS_ESTRANGEIRAS.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DSP_LINGUA": { 
                        required: true,
                        maxlength: 40                        
                    },
                    "DSR_LINGUA": { 
                        maxlength: 25
                    },
                    "ATIVO": { 
                        required: true
                    },
                    "CODIGO": { 
                        required: true,
                        maxlength: 10
                    },
                    "NR_ORDEM": {
                        integer: true,
                    },
                    "FLAG_CLASSES": { 
                        maxlength: 200
                    },
                    "UI_LABEL": { 
                        maxlength: 200
                    },
                    "DESCRICAO": { 
                        maxlength: 4000
                    }
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                }
            },              
        };
        DG_LINGUAS_ESTRANGEIRAS = new QuadTable();
        DG_LINGUAS_ESTRANGEIRAS.initTable( $.extend( {}, datatable_instance_defaults, optionsDG_LINGUAS_ESTRANGEIRAS ) );        
        //END Línguas Estrangeiras

        //Países
        var optionDG_PAISES = {
            "tableId": "DG_PAISES",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_country; ?>",
            "table": "DG_PAISES", 
            "pk": {
                "primary": {
                    "CD_PAIS": {"type": "varchar"}       
                }
            },                  
//            "crudOnMasterInactive": {
//                "condition": "data.ACTIVO == 'N' ",
//                "acl": {
//                    "create": false,
//                    "update": false,
//                    "delete": false
//                }
//            },                    
            "detailsObjects": ['DG_DISTRITOS','DG_CODIGOS_POSTAIS','DG_FERIADOS'],
            "order_by": "CD_PAIS",
            "scrollY": "234", //"390", 
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
                    "fieldInfo": '<a target="_blank" href="https://www.iso.org/iso-3166-country-codes.html"><div>' + "<?php echo $hint_iso_3166_alpha_2; ?>" + '</div></a>',
                    //"<?php echo $hint_iso_3166_alpha_2; ?>",
                    "data": 'CD_PAIS',
                    "name": 'CD_PAIS',
                    "className": "visibleColumn",            
                    "attr": {
                        "class": "form-control",
                        "style": "width: 15%;"
                    }
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DSP_PAIS',
                    "name": 'DSP_PAIS',                    
                    "className": "visibleColumn",   
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_MOEDA',
                    "name": 'CD_MOEDA',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables 
                }, {
                    "responsivePriority": 4,
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
                            "create": " AND A.ATIVO = 'S' AND A.CD_MOEDA != ':CD_MOEDA_DE'", //On-New-Record
                            "edit": " AND A.ATIVO = 'S' AND A.CD_MOEDA != ':CD_MOEDA_DE'", //On-Edit-Record
                        }                        
                    }                    
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_LINGUA',
                    "name": 'CD_LINGUA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 5,
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_language, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_language; ?>",
                    "data": 'DSR_LINGUA',
                    "name": 'DSR_LINGUA',
                    "type": "select",
                    "className": "visibleColumn chosen",
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
                    "responsivePriority": 6, 
                    "title": "<?php echo mb_strtoupper($ui_nationality, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_nationality; ?>", //Editor
                    "data": 'DSP_NACIONALIDADE',
                    "name": 'DSP_NACIONALIDADE',
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 7, 
                    "title": "<?php echo mb_strtoupper($ui_phone_code, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_phone_code; ?>", //Editor
                    "data": 'INDICATIVO_TELEF',
                    "name": 'INDICATIVO_TELEF',
                    "className": "visibleColumn",  
                    "attr": {
                        "style": "width: 30%;"
                    }
                }, {
                    "title": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_nif, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_nif_short, 'UTF-8'); ?>" + "</span>", //Editor
                    "data": '',
                    "name": 'TIT_NIF',
                    "type": "readonly",
                    "className": "none",
                    "defaultContent": "", //Must be used on STATIC columns content. On this case classes make there way...
                    "attr": {
                        "style": "display: none;"
                    }
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_required_short, 'UTF-8'); ?>" + "</span>", //Datatables
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_required_short; ?>" + "</span>", //Editor
                    "data": 'NIF_OBRIGATORIO',
                    "name": 'NIF_OBRIGATORIO',
                    "type": "select",
                    "def": "N",
                    "className": "none editorSubTitle visibleColumn",
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
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_chars_number, 'UTF-8'); ?>" + "</span>", //Datatables
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_chars_number; ?>" + "</span>", //Editor
                    "fieldInfo": "<?php echo $hint_number_chars_required; ?>", //Editor
                    "data": 'NR_CHAR_NIF',
                    "name": 'NR_CHAR_NIF',
                    "className": "none editorSubTitle visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 15%;"
                    }
                }, {
                    "title": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_bban, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_bban_short, 'UTF-8'); ?>" + "</span>", //Editor
                    "data": '',
                    "name": 'TIT_BBAN',
                    "type": "readonly",
                    "className": "none",
                    "defaultContent": "", //Must be used on STATIC columns content. On this case classes make there way...
                    "attr": {
                        "style": "display: none;"
                    }                    
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>" + "</span>", //Datatables
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_code; ?>" + "</span>", //Editor
                    "data": 'COD_IBAN',
                    "name": 'COD_IBAN',
                    "className": "none editorSubTitle visibleColumn",   
                    "attr": {
                        "style": "width: 30%;"
                    }
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_chars_number, 'UTF-8'); ?>" + "</span>", //Datatables
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_chars_number; ?>" + "</span>", //Editor
                    "fieldInfo": "<?php echo $hint_number_chars_required; ?>", //Editor
                    "data": 'MAX_BBAN',
                    "name": 'MAX_BBAN',
                    "className": "none editorSubTitle visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 15%;"
                    }
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_validation, 'UTF-8'); ?>" + "</span>", //Datatables
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_validation; ?>" + "</span>", //Editor
                    "fieldInfo": "<?php echo $hint_validation_object; ?>", //Editor
                    "data": 'PRG_BBAN',
                    "name": 'PRG_BBAN',
                    "className": "none editorSubTitle visibleColumn",
                }, {
                    "title": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_classification, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_classification, 'UTF-8'); ?>" + "</span>", //Editor
                    "data": '',
                    "name": 'TIT_CLASSIF',
                    "type": "readonly",
                    "className": "none",
                    "defaultContent": "", //Must be used on STATIC columns content. On this case classes make there way...
                    "attr": {
                        "style": "display: none;"
                    }       
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>" + "</span>", //Datatables
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_code; ?>" + "</span>", //Editor
                    "fieldInfo": "<?php echo $hint_country_code_model_30_pt; ?>", //Editor
                    "data": 'FIN_PAIS',
                    "name": 'FIN_PAIS',
                    "className": "none editorSubTitle visibleColumn",     
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_BAL_SOC',
                    "name": 'CD_BAL_SOC',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                     
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'TP_BAL_SOC',
                    "name": 'TP_BAL_SOC',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                  
                }, {
                    "complexList": true,
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_relatorio_unico, 'UTF-8'); ?>" + "</span>", //Datatables
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_relatorio_unico; ?>" + "</span>", //Editor
                    "data": 'DSP_RU',
                    "name": 'DSP_RU',
                    "type": "select",
                    "className": "none editorSubTitle visibleColumn",      
                    "attr": {
                        "dependent-group": "RU",
                        "dependent-level": 1,
                        "data-db-name": 'A.CD_BAL_SOC@A.TP_BAL_SOC',
                        "decodeFromTable": 'RH_DEF_BALANCO_SOCIAL A',
                        "class": "form-control complexList chosen",
                        "desigColumn": "A.DSP_BAL_SOC",
                        "whereClause": " AND A.TP_BAL_SOC = 'F'",
                        "orderBy": "A.DSP_BAL_SOC",
                        "filter": {
                            "create": " AND A.TP_BAL_SOC = 'F'", //On-New-Record
                            "edit": " AND A.TP_BAL_SOC = 'F'", //On-Edit-Record
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
                        return DG_PAISES.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "CD_PAIS": {
                        required: true,
                        maxlength: 2,
                    },
                    "DSP_PAIS": {
                        required: true
                    },
                    "DSP_MOEDA": {
                        required: true
                    },
                    "DSP_PAIS": {
                        required: true,
                        maxlength: 40,
                    },
                    "DSP_NACIONALIDADE": {
                        required: false,
                        maxlength: 40,
                    },
                    "NIF_OBRIGATORIO": {
                        required: true
                    },
                    "NR_CHAR_NIF": {
                        integer: true,
                        maxlength: 2
                    },               
                    "COD_IBAN": {
                        maxlength: 10
                    },                     
                    "MAX_BBAN": {
                        integer: true,
                        maxlength: 2
                    },                     
                    "PRG_BBAN": {
                        maxlength: 100
                    },                     
                    "FIN_PAIS": {
                        maxlength: 10
                    }
                }
            }
        };
        DG_PAISES = new QuadTable();
        DG_PAISES.initTable( $.extend({}, datatable_instance_defaults, optionDG_PAISES) );              
        //END Países        
                
        //Distritos
        var optionDG_DISTRITOS = {
            "tableId": "DG_DISTRITOS",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_district; ?>",
            "table": "DG_DISTRITOS", 
            "pk": {
                "primary": {
                    "CD_PAIS": {"type": "varchar"},
                    "CD_DISTRITO": {"type": "varchar"},                     
                }
            },
            "dependsOn": {
                "DG_PAISES": {
                    "CD_PAIS": "CD_PAIS"
                }
            },                  
            "detailsObjects": ['DG_CONCELHOS'],
            "order_by": "CD_DISTRITO",
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
                    "data": 'CD_PAIS',
                    "name": 'CD_PAIS',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                     
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'CD_DISTRITO',
                    "name": 'CD_DISTRITO',
                    "className": "visibleColumn",                   
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DSP_DISTRITO',
                    "name": 'DSP_DISTRITO',                    
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
                        return DG_DISTRITOS.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "CD_DISTRITO": {
                        required: true,
                        maxlength: 10
                    },
                    "DSP_DISTRITO": {
                        required: true,
                        maxlength: 40,
                    }
                }
            }
        };
        DG_DISTRITOS = new QuadTable();
        DG_DISTRITOS.initTable( $.extend({}, datatable_instance_defaults, optionDG_DISTRITOS) );      
        //END Distritos
        
        //Concelhos
        var optionDG_CONCELHOS = {
            "tableId": "DG_CONCELHOS",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_county; ?>",
            "table": "DG_CONCELHOS", 
            "pk": {
                "primary": {
                    "CD_PAIS": {"type": "varchar"},
                    "CD_DISTRITO": {"type": "varchar"},
                    "CD_CONCELHO": {"type": "varchar"}
                }
            },
            "dependsOn": {
                "DG_DISTRITOS": {
                    "CD_PAIS": "CD_PAIS",
                    "CD_DISTRITO": "CD_DISTRITO"
                }
            },                  
            "detailsObjects": ['DG_FREGUESIAS'],
            "order_by": "CD_CONCELHO",
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
                    "data": 'CD_PAIS',
                    "name": 'CD_PAIS',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables        
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_DISTRITO',
                    "name": 'CD_DISTRITO',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables  
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'CD_CONCELHO',
                    "name": 'CD_CONCELHO',
                    "className": "visibleColumn",                   
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DSP_CONCELHO',
                    "name": 'DSP_CONCELHO',                    
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
                        return DG_CONCELHOS.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "CD_CONCELHO": {
                        required: true,
                        maxlength: 10
                    },
                    "DSP_CONCELHO": {
                        required: true,
                        maxlength: 40,
                    }
                }
            }
        };
        DG_CONCELHOS = new QuadTable();
        DG_CONCELHOS.initTable( $.extend({}, datatable_instance_defaults, optionDG_CONCELHOS) );              
        //END Concelhos        
        
        //Freguesias
        var optionDG_FREGUESIAS = {
            "tableId": "DG_FREGUESIAS",
            "table": "DG_FREGUESIAS", 
            "pk": {
                "primary": {
                    "CD_PAIS": {"type": "varchar"},
                    "CD_DISTRITO": {"type": "varchar"},
                    "CD_CONCELHO": {"type": "varchar"},
                    "CD_FREGUESIA": {"type": "varchar"}
                }
            },
            "dependsOn": {
                "DG_CONCELHOS": {
                    "CD_PAIS": "CD_PAIS",
                    "CD_DISTRITO": "CD_DISTRITO",
                    "CD_CONCELHO": "CD_CONCELHO"
                }
            },                  
            "order_by": "CD_FREGUESIA",
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
                    "data": 'CD_PAIS',
                    "name": 'CD_PAIS',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables        
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_DISTRITO',
                    "name": 'CD_DISTRITO',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables  
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_CONCELHO',
                    "name": 'CD_CONCELHO',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables  
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'CD_FREGUESIA',
                    "name": 'CD_FREGUESIA',
                    "className": "visibleColumn",                   
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DSP_FREGUESIA',
                    "name": 'DSP_FREGUESIA',                    
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
                        return DG_FREGUESIAS.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "CD_FREGUESIA": {
                        required: true,
                        maxlength: 10
                    },
                    "DSP_FREGUESIA": {
                        required: true,
                        maxlength: 40,
                    }
                }
            }
        };
        DG_FREGUESIAS = new QuadTable();
        DG_FREGUESIAS.initTable( $.extend({}, datatable_instance_defaults, optionDG_FREGUESIAS) );              
        //END Freguesias
        
        //Códs. Postais        
        var optionDG_CODIGOS_POSTAIS = {
            "tableId": "DG_CODIGOS_POSTAIS",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_district; ?>",
            "table": "DG_CODIGOS_POSTAIS", 
            "pk": {
                "primary": {
                    "CD_PAIS": {"type": "varchar"},
                    "CD_POSTAL": {"type": "varchar"},
                    "NR_ORDEM": {"type": "varchar"}
                }
            },
            "dependsOn": {
                "DG_PAISES": {
                    "CD_PAIS": "CD_PAIS"
                }
            },                  
            "order_by": "CD_POSTAL, NR_ORDEM",
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
                    "data": 'CD_PAIS',
                    "name": 'CD_PAIS',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                     
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'CD_POSTAL',
                    "name": 'CD_POSTAL',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "form-control",
                        "style": "width: 30%;"
                    }  
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_sub_postal_code, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_sub_postal_code; ?>", //Editor
                    "data": 'NR_ORDEM',
                    "name": 'NR_ORDEM',                    
                    "className": "visibleColumn",   
                    "attr": {
                        "class": "form-control",
                        "style": "width: 20%;"
                    }
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_POSTAL',
                    "name": 'DSP_POSTAL',                    
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
                        return DG_CODIGOS_POSTAIS.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "CD_POSTAL": {
                        required: true,
                        maxlength: 10
                    },
                    "NR_ORDEM": {
                        required: true,
                        maxlength: 10
                    },
                    "DSP_POSTAL": {
                        required: true,
                        maxlength: 40
                    },
                    "ACTIVO": {
                        required: true
                    }
                }
            }
        };
        DG_CODIGOS_POSTAIS = new QuadTable();
        DG_CODIGOS_POSTAIS.initTable( $.extend({}, datatable_instance_defaults, optionDG_CODIGOS_POSTAIS) );   
        //END Códs. Postais
        
        //Feriados
        var optionDG_FERIADOS = {
            "tableId": "DG_FERIADOS",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_district; ?>",
            "table": "DG_FERIADOS", 
            "pk": {
                "primary": {
                    "CD_PAIS": {"type": "varchar"},
                    "DT_FERIADO": {"type": "date"}
                }
            },                   
            "dependsOn": {
                "DG_PAISES": {
                    "CD_PAIS": "CD_PAIS"
                }
            },                  
            "order_by": "TO_CHAR(DT_FERIADO,'YYYY') DESC, TO_CHAR(DT_FERIADO,'MM-DD') ASC",
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
                    "data": 'CD_PAIS',
                    "name": 'CD_PAIS',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                     
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_day, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_day; ?>", //Editor
                    "data": 'DT_FERIADO',
                    "name": 'DT_FERIADO',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "form-control datepicker"
                    }  
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_FERIADO',
                    "name": 'DSP_FERIADO',                    
                    "className": "visibleColumn",   
                    "attr": {
                        "class": "form-control",
                        "style": "width: 20%;"
                    }
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_type, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_type; ?>", //Editor
                    "data": 'TP_FERIADO',
                    "name": 'TP_FERIADO',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_FERIADOS.TP_FERIADO',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_FERIADOS.TP_FERIADO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
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
                    "data": 'DESIGEMPRESA',
                    "name": 'DESIGEMPRESA',
                    "className": "visibleColumn",
                    "type": "select",
                    "attr": {
                        "dependent-group" : "EMPRESA",
                        "dependent-level": 1,
                        "data-db-name": 'A.EMPRESA',
                        "decodeFromTable": 'DG_EMPRESAS A',
                        "class": "form-control complexList chosen", 
                        "desigColumn": "A.EMPRESA",                         
                        "orderBy": "A.NR_ORDEM", 
                    }                     
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_ESTAB',
                    "name": 'CD_ESTAB',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                        
                }, {
                    responsivePriority: 3,
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_establishment, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_establishment; ?>",
                    "data": 'DSP_ESTAB',
                    "name": 'DSP_ESTAB',
                    "className": "visibleColumn",
                    "type": "select",
                    "attr": {
                        "dependent-group": "EMPRESA",
                        "dependent-level": 2,
                        "data-db-name": 'A.EMPRESA@A.CD_ESTAB',
                        "decodeFromTable": 'DG_ESTABELECIMENTOS A',
                        "class": "form-control complexList chosen",
                        "desigColumn": "NVL(A.DSR_ESTAB,A.DSP_ESTAB)",
                        "orderBy": "A.CD_ESTAB",
                        "filter": {
                            "create": " AND A.ACTIVO = 'S' ", //On-New-Record
                            "edit": " AND A.ACTIVO = 'S' ", //On-Edit-Record
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
                        return DG_FERIADOS.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "CD_POSTAL": {
                        required: true,
                        maxlength: 10
                    },
                    "NR_ORDEM": {
                        required: true,
                        maxlength: 10
                    },
                    "DSP_POSTAL": {
                        required: true,
                        maxlength: 40
                    },
                    "ACTIVO": {
                        required: true
                    }
                }
            }
        };
        DG_FERIADOS = new QuadTable();
        DG_FERIADOS.initTable( $.extend({}, datatable_instance_defaults, optionDG_FERIADOS) );   
        //END Feriados
      });
</script>
