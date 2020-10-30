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
                            <a class="nav-link active" data-toggle="tab" href="#Tab1" role="tab" aria-selected="true"><?php echo $ui_families; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab2" role="tab" aria-selected="true"><?php echo $ui_costs_type; ?></a>
                        </li>
                    </ul>
                </div>
            </div>   
            
            <div class="panel-container show">
                <div class="panel-content">
                    
                    <div class="tab-content">

                         <!-- TAB #1 -->
                        <div class="tab-pane fade active show" id="Tab1" role="tabpanel">
                            <a id="GF_FAMILIA_CUSTOS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="GF_FAMILIA_CUSTOS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-11" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                            <h2><?php echo $ui_translate; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="GF_FAMILIA_CUSTO_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="GF_FAMILIA_CUSTO_TRADS" class="table table-bordered table-hover table-striped w-100"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #1 -->

                         <!-- TAB #2 -->
                        <div class="tab-pane fade" id="Tab2" role="tabpanel">
                            <a id="GF_TIPOS_CUSTO_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="GF_TIPOS_CUSTO" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            
                            <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-start">
                                <div class="panel-toolbar pr-3 align-self-end">
                                    <ul id="panel-tab-2-1" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#Tab21" role="tab" aria-selected="true"><?php echo $ui_translate; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Tab22" role="tab" aria-selected="true"><?php echo $ui_values_deductions; ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-container show">
                                <div class="panel-content">
                                    <div class="tab-content">
                                        <div class="tab-pane fade active show" id="Tab21" role="tabpanel">
                                            <a id="GF_TP_CUSTO_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="GF_TP_CUSTO_TRADS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                        </div>
                                        <div class="tab-pane fade" id="Tab22" role="tabpanel">
                                            <div class="row mt-4">
                                                <div class="col-xl-12">
                                                    <div id="panel-51" class="panel">
                                                        <div class="panel-hdr">
                                                            <span class="widget-icon trads"> <i class="fal fa-clone"></i></span>&nbsp;
                                                            <h2><?php echo $ui_values; ?></h2>
                                                        </div>
                                                        <div class="panel-container show">
                                                            <div class="panel-content">                                            
                                                                <a id="GF_VALORES_CUSTO_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                                <table id="GF_VALORES_CUSTO" class="table responsive table-bordered table-striped table-hover nowrap"></table>
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
                                                            <h2><?php echo $ui_deductions; ?></h2>
                                                        </div>
                                                        <div class="panel-container show">
                                                            <div class="panel-content">                                            
                                                                <a id="GF_VALORES_CUSTO_PARAMS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                                <table id="GF_VALORES_CUSTO_PARAMS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
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
                         <!-- END TAB #2 -->
                    </div>                    
                </div>                    

            </div> 
        </div>
    </div>
</div>

<script>
    pageSetUp();

    $(document).ready(function () {
        
        //Famílias
        var optionGF_FAMILIA_CUSTOS = {
            "tableId": "GF_FAMILIA_CUSTOS",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_family; ?>",
            "table": "GF_FAMILIA_CUSTOS", 
            "pk": {
                "primary": {
                    "ID_FAMILIA_CUSTO": {"type": "number"},
                    "DT_INI_FAMILIA_CUSTO": {"type": "date"}            
                }
            },                  
            "crudOnMasterInactive": {
                "condition": "data.DT_FIM_FAMILIA_CUSTO !== null",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },                    
            "detailsObjects": ['GF_FAMILIA_CUSTO_TRADS'],
            "order_by": "ID_FAMILIA_CUSTO",
            "scrollY": "238", //"390", 
            "recordBundle": 10,
            "pageLenght": 10, 
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
                    "data": 'ID_FAMILIA_CUSTO',
                    "name": 'ID_FAMILIA_CUSTO',
                    "className": "visibleColumn",                   
                }, {
                    "responsivePriority": 2, 
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_FAMILIA_CUSTO',
                    "name": 'DT_INI_FAMILIA_CUSTO',
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
                    "data": 'DSP_FAMILIA_CUSTO',
                    "name": 'DSP_FAMILIA_CUSTO',                    
                    "className": "visibleColumn",
                    
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_FAMILIA_CUSTO',
                    "name": 'DSR_FAMILIA_CUSTO',
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
                    "data": 'DT_FIM_FAMILIA_CUSTO',
                    "name": 'DT_FIM_FAMILIA_CUSTO',
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
                        return GF_FAMILIA_CUSTOS.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "ID_FAMILIA_CUSTO": {
                        required: true,
                        integer: true,
                    },
                    "DT_INI_FAMILIA_CUSTO": {
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
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                    "DT_FIM_FAMILIA_CUSTO": {
                        dateISO: true,
                        dateEqOrNextThan: 'DT_INI_FAMILIA_CUSTO',
                    }
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                    "DT_FIM_FAMILIA_CUSTO": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        GF_FAMILIA_CUSTOS = new QuadTable();
        GF_FAMILIA_CUSTOS.initTable( $.extend({}, datatable_instance_defaults, optionGF_FAMILIA_CUSTOS) );              
        //END Situações

        //Situações Trads
        var optionsGF_FAMILIA_CUSTO_TRADS = {
            "tableId": "GF_FAMILIA_CUSTO_TRADS",
            "table": "GF_FAMILIA_CUSTO_TRADS",
            "pk": {
                "primary": {
                    "ID_FAMILIA_CUSTO": {"type": "number"},
                    "DT_INI_FAMILIA_CUSTO": {"type": "date"},                     
                    "CD_LINGUA": {"type": "number"},                    
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "GF_FAMILIA_CUSTOS": {
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
                        return GF_FAMILIA_CUSTO_TRADS.crudButtons(true,true,true);
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
        GF_FAMILIA_CUSTO_TRADS = new QuadTable();
        GF_FAMILIA_CUSTO_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsGF_FAMILIA_CUSTO_TRADS));
        //END Situações Trads
                
        //Tipos Custo
        var optionGF_TIPOS_CUSTO = {
            "tableId": "GF_TIPOS_CUSTO",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_cost_type; ?>",
            "table": "GF_TIPOS_CUSTO", 
            "pk": {
                "primary": {
                    "ID_FAMILIA_CUSTO": {"type": "number"},
                    "DT_INI_FAMILIA_CUSTO": {"type": "date"},
                    "ID_TP_CUSTO": {"type": "number"},
                    "DT_INI_TP_CUSTO": {"type": "date"}
                }
            },            
//            "externalFilter": {
//                "template": {
//                    "selector": "#familyFilter",
//                    "mandatory": ['DSP_FAMILIA'], //mandatory
//                    "optional": ['']
//                }
//            },   
            "crudOnMasterInactive": {
                "condition": "data.DT_FIM_TP_CUSTO !== null",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },                    
            "detailsObjects": ['GF_TP_CUSTO_TRADS','GF_VALORES_CUSTO', 'GF_VALORES_CUSTO_PARAMS'], 
            "order_by": "ID_FAMILIA_CUSTO, ID_TP_CUSTO",
            "scrollY": "150", //"390", 
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
                    "responsivePriority": 1,
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_family, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_family; ?>",
                    "data": 'DSP_FAMILIA',
                    "name": 'DSP_FAMILIA',
                    "type": "select",
                    "className": "visibleColumn",
                    //"visible": false, //DataTables
                    "renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "FAMILIA",
                        "dependent-level": 1,
                        "data-db-name": "A.ID_FAMILIA_CUSTO@A.DT_INI_FAMILIA_CUSTO",
                        "decodeFromTable": "GF_FAMILIA_CUSTOS A", //TO CHANGE ON QUAD-HCM
                        "desigColumn": "A.DSR_FAMILIA_CUSTO",
                        "whereClause": "",
                        "orderBy": "A.ID_FAMILIA_CUSTO",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.DT_FIM_FAMILIA_CUSTO IS NULL", //On-New-Record
                            "edit": " AND A.DT_FIM_FAMILIA_CUSTO IS NULL", //On-Edit-Record
                        }
                    }
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'ID_TP_CUSTO',
                    "name": 'ID_TP_CUSTO',
                    "className": "visibleColumn",                   
                }, {
                    "responsivePriority": 2, 
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_TP_CUSTO',
                    "name": 'DT_INI_TP_CUSTO',
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
                    "data": 'DSP_TP_CUSTO',
                    "name": 'DSP_TP_CUSTO',                    
                    "className": "visibleColumn",
                    
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_TP_CUSTO',
                    "name": 'DSR_TP_CUSTO',
                    "className": "visibleColumn",
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
                    "className": "",                        
                }, {
                    "responsivePriority": 5, 
                    "title": "<?php echo mb_strtoupper($ui_magnitude, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_magnitude; ?>",
                    "complexList": true,
                    "data": 'DSR_MAGNITUDE',
                    "name": 'DSR_MAGNITUDE',
                    "type": "select",
                    "className": "visibleColumn",
                    "visible": true,
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "UNIDADES",
                        "dependent-level": 1,
                        "data-db-name": 'A.ID_MAGNITUDE@A.DT_INI_DM',
                        "decodeFromTable": 'RH_DEF_MAGNITUDES A',
                        "desigColumn": "A.DSR_MAGNITUDE",//"CONCAT(CONCAT(ID_MAGNITUDE,'-'),DSR_MAGNITUDE)", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.                        
                        "orderBy": "A.ID_MAGNITUDE", //usado no complexList.php
                        "class": "form-control complexList chosen",
                        //"disabled": true, //Permite inibir o campo no Editor
                    } 
                }, {
                    "responsivePriority": 6, 
                    "title": "<?php echo mb_strtoupper($ui_value, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_value; ?>", //Editor
                    "data": 'VALOR',
                    "name": 'VALOR',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 30%;",
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
                    "title": "<?php echo mb_strtoupper($ui_internal_reference_short, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_internal_reference_short; ?>", //Editor
                    "data": 'REF_INTERNA',
                    "name": 'REF_INTERNA',
                    "className": "none visibleColumn"
                    
//                }, {
//                    "title": "<?php echo mb_strtoupper($ui_accounting_group, 'UTF-8'); ?>", //Datatables
//                    "label": "<?php echo $ui_accounting_group; ?>", //Editor
//                    "data": 'CD_GRP_CONTAB',
//                    "name": 'CD_GRP_CONTAB',
//                    "className": "none visibleColumn",
//                    "attr": {
//                    }    
                }, {
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM_TP_CUSTO',
                    "name": 'DT_FIM_TP_CUSTO',
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
                        return GF_TIPOS_CUSTO.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "ID_TP_CUSTO": {
                        required: true,
                        integer: true,
                    },
                    "DT_INI_TP_CUSTO": {
                        required: true,
                        dateISO: true,
                    },
                    "DSP_TP_CUSTO": {
                        required: true,
                        maxlength: 80,
                    },
                    "DSR_TP_CUSTO": {
                        maxlength: 25,
                    },    
                    "REF_INTERNA": {
                        required: false,
                        maxlength: 200,
                    },         
                    "VALOR": {
                        number: true
                    },
//                    "CD_GRP_CONTAB"{
//                        required: false
//                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                    "DT_FIM_TP_CUSTO": {
                        dateISO: true,
                        dateEqOrNextThan: 'DT_INI_TP_CUSTO',
                    }
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                    "DT_FIM_TP_CUSTO": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        GF_TIPOS_CUSTO = new QuadTable();
        GF_TIPOS_CUSTO.initTable( $.extend({}, datatable_instance_defaults, optionGF_TIPOS_CUSTO) );              
        //END Tipos Custo
        
        //Tipos Custo Trads
        var optionsGF_TP_CUSTO_TRADS = {
            "tableId": "GF_TP_CUSTO_TRADS",
            "table": "GF_TP_CUSTO_TRADS",
            "pk": {
                "primary": {
                    "ID_FAMILIA_CUSTO": {"type": "number"},
                    "DT_INI_FAMILIA_CUSTO": {"type": "date"},
                    "ID_TP_CUSTO": {"type": "number"},
                    "DT_INI_TP_CUSTO": {"type": "date"},                    
                    "CD_LINGUA": {"type": "number"},                    
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "GF_TIPOS_CUSTO": {
                    "ID_FAMILIA_CUSTO": "ID_FAMILIA_CUSTO",
                    "DT_INI_FAMILIA_CUSTO": "DT_INI_FAMILIA_CUSTO",
                    "ID_TP_CUSTO": "ID_TP_CUSTO",
                    "DT_INI_TP_CUSTO": "DT_INI_TP_CUSTO"
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
                        return GF_TP_CUSTO_TRADS.crudButtons(true,true,true);
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
        GF_TP_CUSTO_TRADS = new QuadTable();
        GF_TP_CUSTO_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsGF_TP_CUSTO_TRADS));        
        //Tipos Custo Trads
        
        //Valores
        var optionsGF_VALORES_CUSTO = {
            "tableId": "GF_VALORES_CUSTO",
            "table": "GF_VALORES_CUSTO",
            "pk": {
                "primary": {
                    "ID_FAMILIA_CUSTO": {"type": "number"},
                    "DT_INI_FAMILIA_CUSTO": {"type": "date"},
                    "ID_TP_CUSTO": {"type": "number"},
                    "DT_INI_TP_CUSTO": {"type": "date"},                    
                    "CONTEXTO": {"type": "number"},                    
                    "DT_INICIO": {"type": "date"}
                }
            },
            "dependsOn": {
                "GF_TIPOS_CUSTO": {
                    "ID_FAMILIA_CUSTO": "ID_FAMILIA_CUSTO",
                    "DT_INI_FAMILIA_CUSTO": "DT_INI_FAMILIA_CUSTO",
                    "ID_TP_CUSTO": "ID_TP_CUSTO",
                    "DT_INI_TP_CUSTO": "DT_INI_TP_CUSTO"
                }
            },
            "order_by": "CONTEXTO, DT_INICIO DESC",
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
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_context, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_context; ?>", //Editor
                    "data": 'CONTEXTO',
                    "name": 'CONTEXTO',
                    "type": "select",                    
                    "className": "visibleColumn", 
                    "renew": true,
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'GF_VALORES_CUSTO.CONTEXTO',
                        "class": "form-control",
                        "name": 'CONTEXTO'
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['GF_VALORES_CUSTO.CONTEXTO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INICIO',
                    "name": 'DT_INICIO',
                    "datatype": 'date',
                    "def": "1900-01-01",
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }
                }, {
                    "responsivePriority": 4, 
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
                        return GF_VALORES_CUSTO.crudButtons(true,true,true);
                    }
                }
            ],
            validations: {
                rules: {
                    "CONTEXTO": {
                        required: true,
                    },
                    "DT_INICIO": {
                        required: true,
                        dateISO: true,
                    },
                    "VALOR": {
                        required: false,
                        number: true,
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
        GF_VALORES_CUSTO = new QuadTable();
        GF_VALORES_CUSTO.initTable($.extend({}, datatable_instance_defaults, optionsGF_VALORES_CUSTO));        
        //Valores
        
        //Incidências
        var optionsGF_VALORES_CUSTO_PARAMS = {
            "tableId": "GF_VALORES_CUSTO_PARAMS",
            "table": "GF_VALORES_CUSTO_PARAMS",
            "pk": {
                "primary": {
                    "ID_FAMILIA_CUSTO": {"type": "number"},
                    "DT_INI_FAMILIA_CUSTO": {"type": "date"},
                    "ID_TP_CUSTO": {"type": "number"},
                    "DT_INI_TP_CUSTO": {"type": "date"},                    
                    "CONTEXTO": {"type": "number"},                    
                    "DT_INICIO": {"type": "date"},
                    "ID": {"type": "number"}
                }
            },
            "dependsOn": {
                "GF_TIPOS_CUSTO": {
                    "ID_FAMILIA_CUSTO": "ID_FAMILIA_CUSTO",
                    "DT_INI_FAMILIA_CUSTO": "DT_INI_FAMILIA_CUSTO",
                    "ID_TP_CUSTO": "ID_TP_CUSTO",
                    "DT_INI_TP_CUSTO": "DT_INI_TP_CUSTO"
                }
            },
            "order_by": "ID",
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
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CONTEXTO',
                    "name": 'CONTEXTO',    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INICIO',
                    "name": 'DT_INICIO',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                    
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
                        "decodeFromTable": "RH_DEF_RUBRICAS A",  //TO CHANGE ON QUAD-HCM
                        "desigColumn": "CONCAT(CONCAT(A.CD_RUBRICA,)A.DSP_RUBRICA)", 
                        //"otherValues": "", //RETURNS data['OTHERVALUES']
                        "whereClause": "",
                        "orderBy": "A.CD_RUBRICA",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND ACTIVO = 'S'", //On-New-Record
                            "edit": " AND ACTIVO = 'S'", //On-Edit-Record
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
                        return GF_VALORES_CUSTO.crudButtons(true,true,true);
                    }
                }
            ],
            validations: {
                rules: {
                    "CONTEXTO": {
                        required: true,
                    },
                    "DT_INICIO": {
                        required: true,
                        dateISO: true,
                    },
                    "VALOR": {
                        required: false,
                        number: true,
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
        GF_VALORES_CUSTO_PARAMS = new QuadTable();
        GF_VALORES_CUSTO_PARAMS.initTable($.extend({}, datatable_instance_defaults, optionsGF_VALORES_CUSTO_PARAMS));        
        //Incidências
        
    });
</script>
