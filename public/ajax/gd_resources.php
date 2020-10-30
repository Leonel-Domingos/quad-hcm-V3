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
                            <a class="nav-link active" data-toggle="tab" href="#Tab1" role="tab" aria-selected="true"><?php echo $ui_masks; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab2" role="tab" aria-selected="true"><?php echo $ui_variables; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab3" role="tab" aria-selected="true"><?php echo $ui_phases; ?></a>
                        </li>
                    </ul>
                </div>
            </div>   
            
            <div class="panel-container show">
                <div class="panel-content">
                    
                    <div class="tab-content">

                         <!-- TAB #1 -->
                        <div class="tab-pane fade active show" id="Tab1" role="tabpanel">
                            <a id="dg_gc_masks_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="dg_gc_masks" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                        </div>
                         <!-- END TAB #1 -->

                         <!-- TAB #2 -->
                        <div class="tab-pane fade" id="Tab2" role="tabpanel">
                            <a id="dg_gc_def_vars_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="dg_gc_def_vars" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-11" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                            <h2><?php echo $ui_translate; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="dg_gc_var_trads_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="dg_gc_var_trads" class="table table-bordered table-hover table-striped w-100"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #2 -->
                        
                         <!-- TAB #3 -->
                        <div class="tab-pane fade" id="Tab3" role="tabpanel">
                            <a id="dg_gd_fases_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="dg_gd_fases" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-11" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                            <h2><?php echo $ui_translate; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="dg_gd_fases_trads_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="dg_gd_fases_trads" class="table table-bordered table-hover table-striped w-100"></table>
                                            </div>
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
        
        //Máscaras
        var optionDgCgMasks = {
            "tableId": 'dg_gc_masks',
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_job; ?>",
            "table": "DG_GD_MASCARAS", 
            "pk": {
                "primary": {
                    "COD": {"type": "varchar"},
                    "DT_INI": {"type": "date"}            
                }
            },
            "order_by": "COD",
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
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'COD',
                    "name": 'COD',
                    "className": "visibleColumn",
                    "attr": {
                        "name": 'COD'
                    }                    
                }, {
                    //"targets": 2,
                    "responsivePriority": 3,            
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI',
                    "name": 'DT_INI',
                    "datatype": 'date',
                    "def": "1900-01-01",
                    "attr": {
                        "name": 'DT_INI',
                        "class": "datepicker" 
                    },
                    "className": "visibleColumn"
                }, {
                    //"targets": 3,
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
                    //"targets": 4,
                    "title": "<?php echo mb_strtoupper($ui_sql_tag, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_sql_tag; ?>", //Editor
                    "data": 'SQL_TAG',
                    "name": 'SQL_TAG',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "name": 'SQL_TAG',
                        "style": "max-width: 335px",
                    }                   
                }, {
                    //"targets": 5,
                    "responsivePriority": 4,            
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM',
                    "name": 'DT_FIM',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "name": 'DT_FIM',
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
                    //"targets": 10,
                    "responsivePriority": 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        //debugger;
                        return dg_gc_masks.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "COD": {
                        required: true,
                        maxlength: 400,
                    },
                    "DT_INI": {
                        required: true,
                        dateISO: true,
                    },
                    "DESCRICAO": {
                        required: true,
                        maxlength: 400,
                    },
                    "DT_FIM": {
                        dateISO: true,
                        dateEqOrNextThan: 'DT_INI',
                    }, 
                    "SQL_TAG": {
                        maxlength: 2000,
                    },
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                    "DT_FIM": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        dg_gc_masks = new QuadTable();
        dg_gc_masks.initTable( $.extend({}, datatable_instance_defaults, optionDgCgMasks) );
        //END Máscaras

        //Variáveis
        var optionDgDefVariaveis = {
            "tableId": 'dg_gc_def_vars',
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_mask; ?>",
            "table": "DG_DEF_VARIAVEIS",
            "pk": {
                "primary": {
                    "COD_VAR": {"type": "varchar"},
                    "DT_INI_VAR": {"type": "date"}
                }
            },
            "crudOnMasterInactive": {
                "condition": "data.DT_FIM !== null",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },
            "detailsObjects": ['dg_gc_var_trads'],
            "order_by": "COD_VAR",
            "recordBundle": 7, // number of records returned by server on SELECT operation
            "pageLenght": 7, // for the moment use the same as recordBundle
            "scrollY": "196", //height in pixels -- mandatory,
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
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'COD_VAR',
                    "name": 'COD_VAR',
                    "className": "visibleColumn",
                    "attr": {
                        "name": 'COD_VAR'
                    }
                }, {
                    //"targets": 2,
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_VAR',
                    "name": 'DT_INI_VAR',
                    "datatype": 'date',
                    "def": "1900-01-01",
                    "className": "visibleColumn",
                    "attr": {
                        "name": 'DT_INI_VAR',
                        "class": "datepicker"
                    }
                }, {
                    //"targets": 3,
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_label, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_label; ?>", //Editor
                    "data": 'LABEL',
                    "name": 'LABEL',
                    "fieldInfo": "<?php echo $hint_interface_label; ?>",
                    "className": "visibleColumn",
                    "attr": {
                        "name": 'LABEL'
                    }
                }, {
                    //"targets": 4,
                    "responsivePriority": 5,
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM',
                    "name": 'DT_FIM',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "name": 'DT_FIM',
                        "class": "datepicker"
                    }
                }, {
                    //"targets": 5,
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
                    //"targets": 6,
                    "responsivePriority": 1,
                    "title": "<?php echo mb_strtoupper($ui_type, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_type; ?>", //Editor
                    "data": 'TIPO',
                    "name": 'TIPO',
                    "type": "select",
                    "className": "none visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_DEF_VARIAVEIS.TIPO',
                        "class": "form-control",
                        "name": 'TIPO',
                        "style": "width: 80%;",                      
                        /*
                        "showValues":{
                            "RV_LOW_VALUE": "RV_ABBREVIATION"
                        } 
                        */
                    },
                    "render": function (val, type, row) {
                        if (typeof (val) === "object" && val === null) {
                            return val;
                        } else {
                            //if( dg_gc_def_vars['sortInfo'] ){
                            //    return val;
                            //}
                            var o = _.find(initApp.joinsData['DG_DEF_VARIAVEIS.TIPO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING']; //o['RV_ABBREVIATION'] ????                            
                        } 
                    }                    
                }, {
                    //"targets": 7,
                    "title": "<?php echo mb_strtoupper($ui_datatype, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_datatype; ?>", //Editor
                    "data": 'TIPO_DADOS',
                    "name": 'TIPO_DADOS',
                    "type": "select",
                    "className": "none visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_DEF_VARIAVEIS.TIPO_DADOS',
                        "class": "form-control",
                        "name": 'TIPO_DADOS',
                        "style": "width: 80%;",
                        /*
                        "showValues":{
                            "RV_LOW_VALUE": "RV_ABBREVIATION"
                        }
                        */
                    },
                    "render": function (val, type, row) {
                        if (typeof (val) === "object" && val === null) {
                            return val;
                        } else {
                            var o = _.find(initApp.joinsData['DG_DEF_VARIAVEIS.TIPO_DADOS'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING']; //o['RV_ABBREVIATION'] ????
                        }
                    }
                }, {
                    //"targets": 8,
                    "title": "<?php echo mb_strtoupper($ui_min, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_min; ?>", //Editor
                    "data": 'VALOR_MIN',
                    "name": 'VALOR_MIN',
                    "className": "none visibleColumn right",
                    "attr": {
                        "name": "VALOR_MIN",
                        "class": "toRight",
                        "style": "width:50%"
                    }

                }, {
                    //"targets": 9,
                    "title": "<?php echo mb_strtoupper($ui_max, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_max; ?>", //Editor
                    "data": 'VALOR_MAX',
                    "name": 'VALOR_MAX',
                    "className": "none visibleColumn right",
                    "attr": {
                        "name": "VALOR_MAX",
                        "class": "toRight",
                        "style": "width:50%"
                    }

                }, {
                    //"targets": 10,
                    "title": "<?php echo mb_strtoupper($ui_step, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_step; ?>", //Editor
                    "data": 'INCREMENTOS',
                    "name": 'INCREMENTOS',
                    "className": "none visibleColumn right",
                    "attr": {
                        "name": "INCREMENTOS",
                        "class": "toRight",
                        "style": "width:50%"
                    }

                }, {
                    //"targets": 11,
                    "title": "<?php echo mb_strtoupper($ui_domain, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_domain; ?>", //Editor
                    "data": 'DOMAIN_REF',
                    "name": 'DOMAIN_REF',
                    "className": "none visibleColumn",
                    "attr": {
                        "name": "DOMAIN_REF"
                    }
                }, {
                    //"targets": 12,
                    "title": "<?php echo mb_strtoupper($ui_table_column_ref, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_table_column_ref; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_table_column_ref; ?>",
                    "data": 'TABLE_COLUMN_REF',
                    "name": 'TABLE_COLUMN_REF',
                    "className": "none visibleColumn",
                    "attr": {
                        "name": "TABLE_COLUMN_REF"
                    }
                }, {
                    //"targets": 13,
                    "title": "<?php echo mb_strtoupper($ui_db_function, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_db_function; ?>", //Editor
                    "data": 'FUNCTION_REF',
                    "name": 'FUNCTION_REF',
                    "className": "none visibleColumn",
                    "attr": {
                        "name": "FUNCTION_REF"
                    }
                }, {
                    //"targets": 14,
                    "title": "<?php echo mb_strtoupper($ui_sql_statement, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_sql_statement; ?>", //Editor
                    "data": 'QUAD_SQL_REF',
                    "name": 'QUAD_SQL_REF',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "name": 'QUAD_SQL_REF',
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
                    //"targets": 19,
                    "responsivePriority": 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        return dg_gc_def_vars.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "COD_VAR": {
                        required: true,
                        maxlength: 100
                    },
                    "DT_INI_VAR": {
                        required: true,
                        dateISO: true
                    },
                    "LABEL": {
                        required: true,
                        maxlength: 80
                    },
                    "DESCRICAO": {
                        maxlength: 4000
                    },
                    "TIPO": {
                        maxlength: 4
                    },
                    "DOMAIN_REF": {
                        maxlength: 30
                    },
                    "TABLE_COLUMN_REF": {
                        maxlength: 150
                    },
                    "FUNCTION_REF": {
                        maxlength: 30
                    },
                    "QUAD_SQL_REF": {
                        maxlength: 4000
                    },
                    "DT_FIM": {
                        dateISO: true,
                        dateEqOrNextThan: 'DT_INI_VAR'
                    }
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                    "DT_FIM": {
                        "dateEqOrNextThan": "<?php echo $error_end_dt_greater; ?>"
                    },
                }
            }
        };
        dg_gc_def_vars = new QuadTable();
        dg_gc_def_vars.initTable( $.extend({}, datatable_instance_defaults, optionDgDefVariaveis) );
        //END Variáveis
        
        //Variáveis -> Traduções 
        var optionTradDgGcVars = {
            "tableId": 'dg_gc_var_trads',
            "order": false,
            "table": "DG_GD_VARIAVEL_TRADS", // table in database
            "pk": {
                "primary": {
                    "COD_VAR": {"type": "varchar"},
                    "DT_INI_VAR": {"type": "date"},
                    "CD_LINGUA": {"type": "number"},
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "dg_gc_def_vars": {
                    //External object key mapping( object key : external key)
                    "COD_VAR": "COD_VAR",
                    "DT_INI_VAR": "DT_INI_VAR",
                }
            },
            "order_by": "CD_LINGUA, DT_INI DESC",
            "recordBundle": 4, // number of records returned by server on SELECT operation
            "pageLenght": 4, // for the moment use the same as recordBundle
            "scrollY": "117", //height in pixels -- mandatory,
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
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'COD_VAR',
                    "name": 'COD_VAR',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                    "className": "visibleColumn",                    
                    "attr": {
                        "name": 'COD_VAR'
                    }
                }, {
                    //"targets": 2,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_VAR',
                    "name": 'DT_INI_VAR',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                    "className": "visibleColumn", 
                    "attr": {
                        "name": 'DT_INI_VAR',
                        "class": "datepicker" 
                    }
                }, {
                    //"targets": 3,
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_LINGUA',
                    "name": 'CD_LINGUA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                    attr: {
                        "name": "CD_LINGUA",
                    }
                }, {
                    //"targets": 4,
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
                    //"targets": 5,
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI',
                    "name": 'DT_INI',
                    "datatype": 'date',
                    "def": "1900-01-01",
                    "attr": {//EDITOR CONTROL
                        "name": 'DT_INI',
                        "class": "datepicker" //dateTimePicker
                    },
                    "width": "7%",
                    "bSearchable": false,
                    "orderable": false,
                }, {
                    //"targets": 6,
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_label, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_label; ?>", //Editor
                    "data": 'LABEL',
                    "name": 'LABEL',
                    "attr": {
                        "name": "LABEL",
                    }
                }, {
                    //"targets": 7,
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM',
                    "name": 'DT_FIM',
                    "datatype": 'date',
                    "attr": {//EDITOR CONTROL
                        "name": 'DT_FIM',
                        "class": "datepicker" //dateTimePicker
                    },
                    "width": "7%",
                    "bSearchable": false,
                    "orderable": false,
                }, {
                    //"targets": 8,
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
                    //"targets":13,
                    "responsivePriority": 1,
                    "data": null,
                    "title": "",
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        return dg_gc_var_trads.crudButtons(true, true, true);
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
                    "LABEL": {
                        maxlength: 80,
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
        dg_gc_var_trads = new QuadTable();
        dg_gc_var_trads.initTable( $.extend({}, datatable_instance_defaults, optionTradDgGcVars));        
        //END Variáveis -> Traduções
        
        //Fases
        var optionsGd_Fases = {
            tableId: "dg_gd_fases",
            table: "CG_REF_CODES", // table in database
            "initialWhereClause": "RV_DOMAIN = 'DG_TIPO_FASES_GD' ",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_phase; ?>",
            "pk": {
                "primary": {
                    // enumerate pk fields in db table . If is a numeric varchar or int, use numeric . If pk have alphanumeric use any other value diferent from 'numeric'
                    "RV_DOMAIN": {"type": "varchar"},
                    "RV_LOW_VALUE": {"type": "varchar"}
                }
            },
            "order_by": "RV_DOMAIN, RV_LOW_VALUE",
            "detailsObjects": ['dg_gd_fases_trads'],
            "recordBundle": 7, // number of records returned by server on SELECT operation
            "pageLenght": 7, // for the moment use the same as recordBundle
            "scrollY": "196", //height in pixels -- mandatory,
            "tableCols": [
                {
                    //"targets": 0,
                    "title": "<?php echo mb_strtoupper($ui_domain, 'UTF-8'); ?>", //Datatables
                    "label": "", //Editor
                    "data": 'RV_DOMAIN',
                    "name": 'RV_DOMAIN',
                    "def": "DG_TIPO_FASES_GD",
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                    "className": "visibleColumn"
                }, {
                    //"targets": 1,
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
                    //"targets": 2,
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'RV_MEANING',
                    "name": 'RV_MEANING',
                    "className": "visibleColumn",
                    "attr": {
                        "name": "RV_MEANING",
                    }
                }, {
                    //"targets": 3,
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'RV_ABBREVIATION',
                    "name": 'RV_ABBREVIATION',
                    "className": "visibleColumn",
                    "attr": {
                        "name": "RV_ABBREVIATION",
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
                    //"targets": 8,
                    "responsivePriority": 1,
                    "data": null,
                    "title": "",
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        return dg_gd_fases.crudButtons(true, true, true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "RV_DOMAIN": {//Same as defined on attr.name
                        required: true,
                    },
                    "RV_LOW_VALUE": {//Same as defined on attr.name
                        required: true,
                    },
                    "RV_MEANING": {
                        required: true,
                    },
                    "RV_ABBREVIATION": {
                        required: true,
                    },
                },
            },
        };
        dg_gd_fases = new QuadTable();
        dg_gd_fases.initTable($.extend({}, datatable_instance_defaults, optionsGd_Fases));
        //End Fases

        //TraduçõesFases
        var optionsTradFases = {
            "tableId": 'dg_gd_fases_trads',
            "table": "CG_REF_CODES_TRADS",
            "order": false,
            "pk":{
                "primary": {
                    "CD_LINGUA": {"type": "number"},
                    "RV_LOW_VALUE": {"type": "varchar"},
                    "RV_DOMAIN": {"type": "varchar"},
                    "DT_INI": {"type": "date"},
                }
            },
            "dependsOn": {
                dg_gd_fases: {
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
                    //"targets": 0,
                    "title": "<?php echo mb_strtoupper($ui_domain, 'UTF-8'); ?>", //Datatables
                    "label": "", //Editor
                    "data": 'RV_DOMAIN',
                    "name": 'RV_DOMAIN',
                    "width": "",
                    "defaultContent": "",
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                    "className": "visibleColumn",
                    "attr": {
                        "name": "RV_DOMAIN",
                    }
                }, {
                    //"targets": 1,
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
                    //"targets": 2,
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
                    //"targets": 3,
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
                    //"targets": 4,
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
                    //"targets": 5,
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
                    //"targets": 6,
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_TRAD',
                    "name": 'DSR_TRAD',
                    "className": "visibleColumn",
                    "attr": {
                        "name": "DSR_TRAD",
                    }
                }, {
                    //"targets": 8,
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
                    //"targets": 7,
                    "title": "<?php echo mb_strtoupper($ui_description, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DESCRICAO',
                    "name": 'DESCRICAO',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                }, {
                    //"targets": 9,
                    "responsivePriority": 1,
                    "data": null,
                    "title": "",
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        return dg_gd_fases_trads.crudButtons(true, true, true);
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
        dg_gd_fases_trads = new QuadTable();
        dg_gd_fases_trads.initTable($.extend({}, datatable_instance_defaults, optionsTradFases));
        //End Traduções Fases
        
    });
</script>
