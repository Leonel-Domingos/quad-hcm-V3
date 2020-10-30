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
                            <a class="nav-link active" data-toggle="tab" href="#Tab1" role="tab" aria-selected="true"><?php echo $ui_local_types; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab2" role="tab" aria-selected="true"><?php echo $ui_training_places; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab3" role="tab" aria-selected="true"><?php echo $ui_equipments_classification; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab4" role="tab" aria-selected="true"><?php echo $ui_equipments; ?></a>
                        </li>
                    </ul>
                </div>
            </div>   
            
            <div class="panel-container show">
                <div class="panel-content">
                    
                    <div class="tab-content">

                         <!-- TAB #1 -->
                        <div class="tab-pane fade active show" id="Tab1" role="tabpanel">
                            <a id="Tipos_Locais_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="Tipos_Locais" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-11" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                            <h2><?php echo $ui_translate; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="Tipos_Locais_Trads_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="Tipos_Locais_Trads" class="table table-bordered table-hover table-striped w-100"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #1 -->

                         <!-- TAB #2 -->
                        <div class="tab-pane fade" id="Tab2" role="tabpanel">
                            <a id="GF_LOCAIS_FORMACAO_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="GF_LOCAIS_FORMACAO" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-11" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                            <h2><?php echo $ui_translate; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="GF_LOCAL_FORMACAO_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="GF_LOCAL_FORMACAO_TRADS" class="table table-bordered table-hover table-striped w-100"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #2 -->
                        
                         <!-- TAB #3 -->
                        <div class="tab-pane fade" id="Tab3" role="tabpanel">
                            <a id="ClassEquipamento_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="ClassEquipamento" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-11" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                            <h2><?php echo $ui_translate; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="ClassEquipamento_Trads_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="ClassEquipamento_Trads" class="table table-bordered table-hover table-striped w-100"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #3 -->

                         <!-- TAB #4 -->
                        <div class="tab-pane fade" id="Tab4" role="tabpanel">
                            <a id="GF_EQUIPAMENTOS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="GF_EQUIPAMENTOS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            
                            <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-start">
                                <div class="panel-toolbar pr-3 align-self-end">
                                    <ul id="panel-tab-4-1" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#Tab41" role="tab" aria-selected="true"><?php echo $ui_translate; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Tab42" role="tab" aria-selected="true"><?php echo $ui_training_places; ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-container show">
                                <div class="panel-content">
                                    <div class="tab-content">
                                        <div class="tab-pane fade active show" id="Tab41" role="tabpanel">
                                            <a id="GF_EQUIPAMENTO_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="GF_EQUIPAMENTO_TRADS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                        </div>
                                        <div class="tab-pane fade" id="Tab42" role="tabpanel">
                                            <a id="GF_EQUIPAMENTOS_LOCAL_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="GF_EQUIPAMENTOS_LOCAL" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                        </div>                                        
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

        //Tipos Locais
        var optionsTipos_Locais = {
            "tableId": 'Tipos_Locais',
            "table": "CG_REF_CODES",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_local_types; ?>",            
            "pk": {
                "primary": {
                    "RV_DOMAIN": {"type": "varchar"},
                    "RV_LOW_VALUE": {"type": "varchar"}
                }
            },
            "detailsObjects": ['Tipos_Locais_Trads'],
            "initialWhereClause": "RV_DOMAIN = 'GF_TP_LOCAL' ",
            "order_by": "RV_LOW_VALUE",
            "scrollY": "156",
            "recordBundle": 5,
            "pageLenght": 5, 
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
                    "def": "GF_TP_LOCAL",
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
                        return Tipos_Locais.crudButtons(true, true, true);
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
        Tipos_Locais = new QuadTable();
        Tipos_Locais.initTable($.extend({}, datatable_instance_defaults, optionsTipos_Locais));
        //Tipos Locais
        
        //Tipos Locais Trads
        var optionsTipos_Locais_Trads = {
            "tableId": 'Tipos_Locais_Trads',
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
                "Tipos_Locais": {
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
                            "create": " AND A.ATIVO = 'S'", 
                            "edit": " AND A. ATIVO = 'S'",
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
                        return Tipos_Locais_Trads.crudButtons(true, true, true);
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
        Tipos_Locais_Trads = new QuadTable();
        Tipos_Locais_Trads.initTable($.extend({}, datatable_instance_defaults, optionsTipos_Locais_Trads));
        // End Tipos Locais Trads
        
        //Locais
        var optionGF_LOCAIS_FORMACAO = {
            "tableId": "GF_LOCAIS_FORMACAO",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_training_place; ?>",
            "table": "GF_LOCAIS_FORMACAO", 
            "pk": {
                "primary": {
                    "ID_LOCAL": {"type": "number"},
                    "DT_INI_LOCAL": {"type": "date"}            
                }
            },                  
            "crudOnMasterInactive": {
                "condition": "data.DT_FIM_LOCAL !== null",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },                    
            "detailsObjects": ['GF_LOCAL_FORMACAO_TRADS'],
            "order_by": "ID_LOCAL",
            "scrollY": "156",
            "recordBundle": 5,
            "pageLenght": 5, 
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
                    "title": "<?php echo mb_strtoupper($ui_type, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_type; ?>", //Editor
                    "data": 'TP_LOCAL',
                    "name": 'TP_LOCAL',
                    "type": "select",                    
                    "className": "visibleColumn", 
                    "renew": true,
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'GF_TP_LOCAL',
                        "class": "form-control",
                        "name": 'TP_LOCAL'
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['GF_TP_LOCAL'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }                    
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'ID_LOCAL',
                    "name": 'ID_LOCAL',
                    "className": "visibleColumn",                   
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_LOCAL',
                    "name": 'DT_INI_LOCAL',
                    "datatype": 'date',
                    "def": "1900-01-01",
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }            
                }, {
                    "responsivePriority": 5, 
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DSP_LOCAL',
                    "name": 'DSP_LOCAL',                    
                    "className": "visibleColumn",
                    
                }, {
                    "responsivePriority": 6, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_LOCAL',
                    "name": 'DSR_LOCAL',
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 7, 
                    "title": "<?php echo mb_strtoupper($ui_seats_number, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_seats_number; ?>", //Editor
                    "data": 'NR_LUGARES',
                    "name": 'NR_LUGARES',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 20%;",
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_phone, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_phone; ?>", //Editor
                    "data": 'TELF',
                    "name": 'TELF',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "form-control",
                        "style": "width: 50%;",
                    }                    
                }, {
                    "title": "<?php echo mb_strtoupper($ui_fax, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_fax; ?>", //Editor
                    "data": 'FAX',
                    "name": 'FAX',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "form-control",
                        "style": "width: 50%;",
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
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_PAIS',
                    "name": 'CD_PAIS',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables   
                }, {
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_company, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_company; ?>",
                    "data": 'DSP_PAIS',
                    "name": 'DSP_PAIS',
                    "type": "select",
                    "className": "none visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "PAISES",
                        "dependent-level": 1,
                        "data-db-name": "A.CD_PAIS",
                        "decodeFromTable": "dg_paises",  //TO CHANGE ON QUAD-HCM
                        "desigColumn": "DSP_PAIS A", 
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
                    "data": 'NR_ORDEM',
                    "name": 'NR_ORDEM',                    
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 25%",
                    }                    
//                }, { //DO NOT USE :: DB VALIDATIONS :: TO MANY RECORDS!!!!
//                    "complexList": true, 
//                    "title": "<?php echo mb_strtoupper($ui_company, 'UTF-8'); ?>",
//                    "label": "<?php echo $ui_company; ?>",
//                    "data": 'DSP_POSTAL',
//                    "name": 'DSP_POSTAL',
//                    "type": "select",
//                    "className": "none visibleColumn",
//                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
//                    "attr": {
//                        "dependent-group": "PAISES_2",
//                        "dependent-level": 1,
//                        "data-db-name": "CD_PAIS@CD_POSTAL@NR_ORDEM",
//                        "decodeFromTable": "dg_codigos_postais",  //TO CHANGE ON QUAD-HCM
//                        "desigColumn": "CONCAT(CONCAT(CD_POSTAL, '-'),NR_ORDEM)", 
//                        "orderBy": "CD_POSTAL, NR_ORDEM",
//                        "class": "form-control complexList chosen"
//                    }                                        
                }, {
                    "title": "<?php echo mb_strtoupper($ui_city, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_city; ?>", //Editor
                    "data": 'CIDADE',
                    "name": 'CIDADE',                    
                    "className": "none visibleColumn",                    
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
                    "data": 'DT_FIM_LOCAL',
                    "name": 'DT_FIM_LOCAL',
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
                        return GF_LOCAIS_FORMACAO.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "TP_LOCAL": {
                        required: true
                    },
                    "ID_LOCAL": {
                        required: true,
                        integer: true,
                    },
                    "DT_INI_LOCAL": {
                        required: true,
                        dateISO: true,
                    },
                    "DSP_FAMILIA_CUSTO": {
                        required: true,
                        maxlength: 80,
                    },
                    "DSR_FAMILIA_CUSTO": {
                        maxlength: 25,
                    },       
                    "NR_LUGARES": {
                        required: false,
                        integer: true,
                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                    "DT_FIM_LOCAL": {
                        dateISO: true,
                        dateEqOrNextThan: 'DT_INI_LOCAL',
                    }
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                    "DT_FIM_LOCAL": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        GF_LOCAIS_FORMACAO = new QuadTable();
        GF_LOCAIS_FORMACAO.initTable( $.extend({}, datatable_instance_defaults, optionGF_LOCAIS_FORMACAO) );              
        //END Locais

        //Locais Trads
        var optionsGF_LOCAL_FORMACAO_TRADS = {
            "tableId": "GF_LOCAL_FORMACAO_TRADS",
            "table": "GF_LOCAL_FORMACAO_TRADS",
            "pk": {
                "primary": {
                    "ID_LOCAL": {"type": "number"},
                    "DT_INI_LOCAL": {"type": "date"}   ,                     
                    "CD_LINGUA": {"type": "number"},                    
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "GF_LOCAIS_FORMACAO": {
                    "ID_FAMILIA_CUSTO": "ID_FAMILIA_CUSTO",
                    "DT_INI_FAMILIA_CUSTO": "DT_INI_FAMILIA_CUSTO"
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
                        return GF_LOCAL_FORMACAO_TRADS.crudButtons(true,true,true);
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
        GF_LOCAL_FORMACAO_TRADS = new QuadTable();
        GF_LOCAL_FORMACAO_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsGF_LOCAL_FORMACAO_TRADS));
        //END Locais Trads

        //Classificação Equipamentos
        var optionsClassEquipamento = {
            "tableId": 'ClassEquipamento',
            "table": "CG_REF_CODES",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_classification; ?>",            
            "pk": {
                "primary": {
                    "RV_DOMAIN": {"type": "varchar"},
                    "RV_LOW_VALUE": {"type": "varchar"}
                }
            },
            "detailsObjects": ['ClassEquipamento_Trads'],
            "initialWhereClause": "RV_DOMAIN = 'GF_EQUIPAMENTOS.CLASS_FORMACAO' ",
            "order_by": "RV_LOW_VALUE",
            "scrollY": "156",
            "recordBundle": 5,
            "pageLenght": 5,  
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
                    "def": "GF_EQUIPAMENTOS.CLASS_FORMACAO",
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
                        return ClassEquipamento.crudButtons(true, true, true);
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
        ClassEquipamento = new QuadTable();
        ClassEquipamento.initTable($.extend({}, datatable_instance_defaults, optionsClassEquipamento));
        //Classificação Equipamentos
        
        //Classificação Equipamentos Trads
        var optionsClassEquipamento_Trads = {
            "tableId": 'ClassEquipamento_Trads',
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
                "ClassEquipamento": {
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
                            "create": " AND A.ATIVO = 'S'", 
                            "edit": " AND A. ATIVO = 'S'",
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
                        return ClassEquipamento_Trads.crudButtons(true, true, true);
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
        ClassEquipamento_Trads = new QuadTable();
        ClassEquipamento_Trads.initTable($.extend({}, datatable_instance_defaults, optionsClassEquipamento_Trads));
        // End Classificação Equipamentos Trads

        //Equipamentos
        var optionGF_EQUIPAMENTOS = {
            "tableId": "GF_EQUIPAMENTOS",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_equipment; ?>",
            "table": "GF_EQUIPAMENTOS", 
            "pk": {
                "primary": {
                    "ID_EQUIPAMENTO": {"type": "number"},
                    "DT_INI_EQUIPAMENTO": {"type": "date"}
                }
            },             
            "crudOnMasterInactive": {
                "condition": "data.DT_FIM_EQUIPAMENTO !== null",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },                    
            "detailsObjects": ['GF_EQUIPAMENTO_TRADS', 'GF_EQUIPAMENTOS_LOCAL'], 
            "order_by": "ID_EQUIPAMENTO",
            "scrollY": "156",
            "recordBundle": 5,
            "pageLenght": 5, 
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
                    "data": 'ID_EQUIPAMENTO',
                    "name": 'ID_EQUIPAMENTO',
                    "className": "visibleColumn", 
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_EQUIPAMENTO',
                    "name": 'DT_INI_EQUIPAMENTO',
                    "datatype": 'date',
                    "def": "1900-01-01",
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }              
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DSP_EQUIPAMENTO',
                    "name": 'DSP_EQUIPAMENTO',                    
                    "className": "visibleColumn",
                    
                }, {
                    "responsivePriority": 5, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_EQUIPAMENTO',
                    "name": 'DSR_EQUIPAMENTO',
                    "className": "visibleColumn",  
                    
         
                }, {
                    "responsivePriority": 6,
                    "title": "<?php echo mb_strtoupper($ui_training_classif, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_training_classif; ?>", //Editor
                    "data": 'CLASS_FORMACAO',
                    "name": 'CLASS_FORMACAO',
                    "type": "select",                    
                    "className": "visibleColumn", 
                    "renew": true,
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'GF_EQUIPAMENTOS.CLASS_FORMACAO',
                        "class": "form-control",
                        "name": 'CLASS_FORMACAO'
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['GF_EQUIPAMENTOS.CLASS_FORMACAO'], {'RV_LOW_VALUE': val});
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
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM_EQUIPAMENTO',
                    "name": 'DT_FIM_EQUIPAMENTO',
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
                        return GF_EQUIPAMENTOS.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "ID_EQUIPAMENTO": {
                        required: true,
                        integer: true,
                    },
                    "DT_INI_EQUIPAMENTO": {
                        required: true,
                        dateISO: true,
                    },
                    "DSP_EQUIPAMENTO": {
                        required: true,
                        maxlength: 80,
                    },
                    "DSR_EQUIPAMENTO": {
                        maxlength: 25,
                    },    
                    "CLASS_FORMACAO": {
                        required: false
                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                    "DT_FIM_EQUIPAMENTO": {
                        dateISO: true,
                        dateEqOrNextThan: 'DT_INI_EQUIPAMENTO',
                    }
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                    "DT_FIM_EQUIPAMENTO": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        GF_EQUIPAMENTOS = new QuadTable();
        GF_EQUIPAMENTOS.initTable( $.extend({}, datatable_instance_defaults, optionGF_EQUIPAMENTOS) );              
        //END Equipamentos Custo
        
        //Equipamentos Trads
        var optionsGF_EQUIPAMENTO_TRADS = {
            "tableId": "GF_EQUIPAMENTO_TRADS",
            "table": "GF_EQUIPAMENTO_TRADS",
            "pk": {
                "primary": {
                    "ID_EQUIPAMENTO": {"type": "number"},
                    "DT_INI_EQUIPAMENTO": {"type": "date"},                    
                    "CD_LINGUA": {"type": "number"},                    
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "GF_EQUIPAMENTOS": {
                    "ID_EQUIPAMENTO": "ID_EQUIPAMENTO",
                    "DT_INI_EQUIPAMENTO": "DT_INI_EQUIPAMENTO"
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
                        return GF_EQUIPAMENTO_TRADS.crudButtons(true,true,true);
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
        GF_EQUIPAMENTO_TRADS = new QuadTable();
        GF_EQUIPAMENTO_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsGF_EQUIPAMENTO_TRADS));        
        //Equipamentos Trads
        
        //Valores
        var optionsGF_EQUIPAMENTOS_LOCAL = {
            "tableId": "GF_EQUIPAMENTOS_LOCAL",
            "table": "GF_EQUIPAMENTOS_LOCAL",
            "pk": {
                "primary": {
                    "ID_EQUIPAMENTO": {"type": "number"},
                    "DT_INI_EQUIPAMENTO": {"type": "date"},
                    "ID_LOCAL": {"type": "number"},
                    "DT_INI_LOCAL": {"type": "date"},                    
                    "DT_INI_EL": {"type": "date"}
                }
            },
            "dependsOn": {
                "GF_EQUIPAMENTOS": {
                    "ID_EQUIPAMENTO": "ID_EQUIPAMENTO",
                    "DT_INI_EQUIPAMENTO": "DT_INI_EQUIPAMENTO"
                }
            },
            "order_by": "ID_LOCAL, DT_INI_EL DESC",
            "scrollY": "156",
            "recordBundle": 5,
            "pageLenght": 5, 
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
                    "responsivePriority": 2,
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
                        "data-db-name": "ID_LOCAL@DT_INI_LOCAL",
                        "decodeFromTable": "GF_LOCAIS_FORMACAO",  //TO CHANGE ON QUAD-HCM
                        "desigColumn": "DSP_LOCAL", 
                        //"otherValues": "", //RETURNS data['OTHERVALUES']
                        "whereClause": "",
                        "orderBy": "DSP_LOCAL",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND DT_FIM_LOCAL IS NULL", //On-New-Record
                            "edit": " AND DT_FIM_LOCAL IS NULL", //On-Edit-Record
                        }
                    }
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_EL',
                    "name": 'DT_INI_EL',
                    "datatype": 'date',
                    "def": "1900-01-01",
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_nr_units_short, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_nr_units_short; ?>", //Editor
                    "data": 'NR_UNIDADES',
                    "name": 'NR_UNIDADES',                    
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 20%;",
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
                    "data": 'DT_FIM_EL',
                    "name": 'DT_FIM_EL',
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
                        return GF_EQUIPAMENTOS_LOCAL.crudButtons(true,true,true);
                    }
                }
            ],
            validations: {
                rules: {
                    "DSP_LOCAL": {
                        required: true,
                    },
                    "DT_INI_EL": {
                        required: true,
                        dateISO: true,
                    },
                    "NR_UNIDADES": {
                        required: false,
                        number: true,
                    },
                    "DT_FIM_EL": {
                        dateISO: true,
                        dateEqOrNextThan: "DT_INI_EL",
                    }
                },
                "messages": {
                    "DT_FIM_EL": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        GF_EQUIPAMENTOS_LOCAL = new QuadTable();
        GF_EQUIPAMENTOS_LOCAL.initTable($.extend({}, datatable_instance_defaults, optionsGF_EQUIPAMENTOS_LOCAL));        
        //Valores
//        
//        //Incidências
//        var optionsGF_VALORES_CUSTO_PARAMS = {
//            "tableId": "GF_VALORES_CUSTO_PARAMS",
//            "table": "GF_VALORES_CUSTO_PARAMS",
//            "pk": {
//                "primary": {
//                    "ID_FAMILIA_CUSTO": {"type": "number"},
//                    "DT_INI_FAMILIA_CUSTO": {"type": "date"},
//                    "ID_TP_CUSTO": {"type": "number"},
//                    "DT_INI_TP_CUSTO": {"type": "date"},                    
//                    "CONTEXTO": {"type": "number"},                    
//                    "DT_INICIO": {"type": "date"},
//                    "ID": {"type": "number"}
//                }
//            },
//            "dependsOn": {
//                "GF_TIPOS_CUSTO": {
//                    "ID_FAMILIA_CUSTO": "ID_FAMILIA_CUSTO",
//                    "DT_INI_FAMILIA_CUSTO": "DT_INI_FAMILIA_CUSTO",
//                    "ID_TP_CUSTO": "ID_TP_CUSTO",
//                    "DT_INI_TP_CUSTO": "DT_INI_TP_CUSTO"
//                }
//            },
//            "order_by": "ID",
//            "scrollY": "156",
//            "recordBundle": 5,
//            "pageLenght": 5, 
//            "tableCols": [
//                {
//                    "responsivePriority": 1,
//                    "data": null,
//                    "className": "control toBottom toCenter",
//                    "width": "1%",
//                    "defaultContent": ''  
//                }, {
//                    "title": "", //Datatables
//                    "label": "", //Editor
//                    "data": 'ID_FAMILIA_CUSTO',
//                    "name": 'ID_FAMILIA_CUSTO',                    
//                    "type": "hidden", //Editor
//                    "visible": false, //DataTables
//                }, {
//                    "title": "", //Datatables
//                    "label": "", //Editor
//                    "data": 'DT_INI_FAMILIA_CUSTO',
//                    "name": 'DT_INI_FAMILIA_CUSTO',
//                    "datatype": 'date',     
//                    "type": "hidden", //Editor
//                    "visible": false, //DataTables
//                }, {
//                    "title": "", //Datatables
//                    "label": "", //Editor
//                    "data": 'ID_TP_CUSTO',
//                    "name": 'ID_TP_CUSTO',                    
//                    "type": "hidden", //Editor
//                    "visible": false, //DataTables
//                }, {
//                    "title": "", //Datatables
//                    "label": "", //Editor
//                    "data": 'DT_INI_TP_CUSTO',
//                    "name": 'DT_INI_TP_CUSTO',
//                    "datatype": 'date',     
//                    "type": "hidden", //Editor
//                    "visible": false, //DataTables
//                }, {
//                    "title": "", //Datatables
//                    "label": "", //Editor
//                    "data": 'CONTEXTO',
//                    "name": 'CONTEXTO',    
//                    "type": "hidden", //Editor
//                    "visible": false, //DataTables                    
//                }, {
//                    "title": "", //Datatables
//                    "label": "", //Editor
//                    "data": 'DT_INICIO',
//                    "name": 'DT_INICIO',
//                    "datatype": 'date',     
//                    "type": "hidden", //Editor
//                    "visible": false, //DataTables
//                    
//                }, {
//                    "title": "", //Datatables
//                    "label": "", //Editor
//                    "data": 'CD_RUBRICA',
//                    "name": 'CD_RUBRICA',    
//                    "type": "hidden", //Editor
//                    "visible": false, //DataTables                    
//                }, {
//                    "responsivePriority": 2,
//                    "complexList": true, 
//                    "title": "<?php echo mb_strtoupper($ui_wage_item, 'UTF-8'); ?>",
//                    "label": "<?php echo $ui_wage_item; ?>",
//                    "data": 'DSP_RUBRICA',
//                    "name": 'DSP_RUBRICA',
//                    "type": "select",                        
//                    "className": "visibleColumn",
//                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
//                    "attr": {
//                        "dependent-group": "RUBRICAS",
//                        "dependent-level": 1,
//                        "data-db-name": "A.CD_RUBRICA",
//                        "decodeFromTable": "RH_DEF_RUBRICAS A",  //TO CHANGE ON QUAD-HCM
//                        "desigColumn": "CONCAT(CONCAT(A.CD_RUBRICVA,'-'),A.DSP_RUBRICA)", 
//                        //"otherValues": "", //RETURNS data['OTHERVALUES']
//                        "whereClause": "",
//                        "orderBy": "A.CD_RUBRICA",
//                        "class": "form-control complexList chosen",
//                        "filter": {
//                            "create": " AND A.ACTIVO = 'S'", //On-New-Record
//                            "edit": " AND A.ACTIVO = 'S'", //On-Edit-Record
//                        }
//                    }                   
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
//                        return GF_VALORES_CUSTO.crudButtons(true,true,true);
//                    }
//                }
//            ],
//            validations: {
//                rules: {
//                    "CONTEXTO": {
//                        required: true,
//                    },
//                    "DT_INICIO": {
//                        required: true,
//                        dateISO: true,
//                    },
//                    "VALOR": {
//                        required: false,
//                        number: true,
//                    },
//                    "DT_FIM": {
//                        dateISO: true,
//                        dateEqOrNextThan: "DT_INICIO",
//                    }
//                },
//                "messages": {
//                    "DT_FIM": {
//                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
//                    }
//                }
//            }
//        };
//        GF_VALORES_CUSTO_PARAMS = new QuadTable();
//        GF_VALORES_CUSTO_PARAMS.initTable($.extend({}, datatable_instance_defaults, optionsGF_VALORES_CUSTO_PARAMS));        
        //Incidências
        
    });
</script>
