<?php
    require_once '../init.php';
?>

<!-- BEGIN Page Content -->
<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <span class="widget-icon"> <i class="fal fa-clone"></i></span>&nbsp;
                <h2><?php echo $ui_units; ?></h2>         
            </div>
            <div class="panel-container show">
                <div class="panel-content">                                            
                    <a id="RH_DEF_MAGNITUDES_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                    <table id="RH_DEF_MAGNITUDES" class="table table-bordered table-hover table-striped w-100"></table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                <h2><?php echo $ui_translate; ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <a id="RH_DEF_MAGNITUDES_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                    <table id="RH_DEF_MAGNITUDES_TRADS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->
    
<script>
    pageSetUp();

    $(document).ready(function () {
        //Units
        var optionsRH_DEF_MAGNITUDES = {
            "tableId": 'RH_DEF_MAGNITUDES',
            "table": "RH_DEF_MAGNITUDES", 
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_unit; ?>",
            "pk": {
                "primary": {                    
                    "ID_MAGNITUDE": {"type": "number"},
                    "DT_INI_DM": {"type": "date"},
                }
            },
            "crudOnMasterInactive": {
                "condition": "data.DT_FIM_DM !== null",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },
            "detailsObjects": ['RH_DEF_MAGNITUDES_TRADS'],            
            "order_by": "ID_MAGNITUDE, DT_INI_DM desc",
            "scrollY": "250", 
            "recordBundle": 8,
            "pageLenght": 8, 
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "width": "1%", 
                    "className": "control toBottom toCenter",
                    "orderable": false,
                    "defaultContent": ''
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_unit, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_unit; ?>", //Editor
                    "data": 'ID_MAGNITUDE',
                    "name": 'ID_MAGNITUDE',
                    "className": "visibleColumn"
                }, {
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_begin_date; ?>",
                    "data": 'DT_INI_DM',
                    "name": 'DT_INI_DM',
                    "datatype": 'date',
                    "def": "1900-01-01", //default value
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_MAGNITUDE',
                    "name": 'DSP_MAGNITUDE',
                    "className": "visibleColumn"
                }, {
                    //"targets": 4,
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_MAGNITUDE',
                    "name": 'DSR_MAGNITUDE',
                    "className": "visibleColumn"                  
                }, {
                    //"targets": 5,
                    "title": "<?php echo mb_strtoupper($ui_api, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_api; ?>", //Editor
                    "data": 'API_REF',
                    "name": 'API_REF',
                    "className": "visibleColumn",
                    "fieldInfo": "<?php echo $hint_api_reference; ?>"
                }, {
                    //"targets": 6,
                    "title": "<?php echo mb_strtoupper($ui_description, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DESCRICAO',
                    "name": 'DESCRICAO',
                    "type": 'textarea',
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 335px",
                    }                    
                }, {
                    //"targets": 7,
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM_DM',
                    "name": 'DT_FIM_DM',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }
                }, {
                    "responsivePriority": 1,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "data": null,
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        //debugger;
                        return RH_DEF_MAGNITUDES.crudButtons(true,true,true); //CREATE, UPDATE, DELETE
                    } 
                }
            ],
            "validations": {
                "rules": {
                    "ID_MAGNITUDE": { 
                        required: true,
                        digits: true,
                    },
                    "DT_INI_DM": {
                        required: true,
                        dateISO: true,
                    },
                    "DSP_MAGNITUDE": { 
                        required: true,
                    },
                    "DT_FIM_DM": {
                        dateISO: true,
                        dateNextThan: 'DT_INI_DM',
                    },                    
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                    "DT_FIM_DM": {
                        dateNextThan: "<?php echo $error_end_dt_greater; ?>"
                    },
                }
            },              
        };
        RH_DEF_MAGNITUDES = new QuadTable();
        RH_DEF_MAGNITUDES.initTable( $.extend( {}, datatable_instance_defaults, optionsRH_DEF_MAGNITUDES ) );        
        //END Units

        //Units Trads
        var optionRH_DEF_MAGNITUDES_TRADS = {
            "tableId": 'RH_DEF_MAGNITUDES_TRADS',
            "table": "RH_DEF_MAGNITUDES_TRADS", // table in database
            "pk": {
                "primary": {
                    "ID_MAGNITUDE": {"type": "number"},
                    "DT_INI_DM": {"type": "date"},
                    "CD_LINGUA": {"type": "number"},
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "RH_DEF_MAGNITUDES": {
                    //External object key mapping( object key : external key)
                    "ID_MAGNITUDE": "ID_MAGNITUDE",
                    "DT_INI_DM": "DT_INI_DM"
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
                    "data": 'ID_MAGNITUDE',
                    "name": 'ID_MAGNITUDE',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                    "className": "visibleColumn",                    
                    "attr": {
                        "name": 'ID_MAGNITUDE'
                    }
                }, {
                    //"targets": 2,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_DM',
                    "name": 'DT_INI_DM',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                    "className": "visibleColumn", 
                    "attr": {
                        "name": 'DT_INI_DM',
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
                            "create": " AND A.ATIVO = 'S'", 
                            "edit": " AND A. ATIVO = 'S'",
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
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_TRAD',
                    "name": 'DSP_TRAD',
                }, {
                    //"targets": 7,
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_TRAD',
                    "name": 'DSR_TRAD',
                }, {
                    //"targets": 8,
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
                    //"targets":14,
                    "responsivePriority": 1,
                    "data": null,
                    "title": "",
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        return RH_DEF_MAGNITUDES_TRADS.crudButtons(true, true, true);
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
        RH_DEF_MAGNITUDES_TRADS = new QuadTable();
        RH_DEF_MAGNITUDES_TRADS.initTable( $.extend({}, datatable_instance_defaults, optionRH_DEF_MAGNITUDES_TRADS));            
        //END Proficiency Types Trads   
    });
</script>
