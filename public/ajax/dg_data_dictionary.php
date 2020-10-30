<?php
    require_once '../init.php';
?>

<!-- BEGIN Page Content -->
<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <span class="widget-icon"> <i class="fas fa-edit"></i></span>&nbsp;
                <h2><?php echo $ui_data_dictionary; ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">                                            
                    <a id="WEB_ADM_RGPD_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                    <table id="WEB_ADM_RGPD" class="table table-bordered table-hover table-striped w-100"></table>
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
                    <a id="WEB_ADM_RGPD_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                    <table id="WEB_ADM_RGPD_TRADS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->
    
<script>
    pageSetUp();

    $(document).ready(function () {

        var optionsWEB_ADM_RGPD = {
            "tableId": 'WEB_ADM_RGPD',
            "table": "WEB_ADM_RGPD", 
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_rgpd; ?>",
            "pk": {
                "primary": {                    
                    "ID_RGPD": {"type": "number"}
                }
            },
//            "crudOnMasterInactive": {
//                "condition": "data.ESTADO === 'B'",
//                "acl": {
//                    "create": false,
//                    "update": false,
//                    "delete": false
//                }
//            },
            "detailsObjects": ['WEB_ADM_RGPD_TRADS'],            
            "order_by": "ID_RGPD",
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
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables 
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'ID_RGPD',
                    "name": 'ID_RGPD',
                    "datatype": 'sequence',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": true,
                    "className": "visibleColumn"
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_table, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_table; ?>",
                    "data": 'TABELA',
                    "name": 'TABELA',
                    "className": "visibleColumn"
                }, {
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_column, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_column; ?>",
                    "data": 'COLUNA',
                    "name": 'COLUNA',
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 5,
                    "title": "<?php echo mb_strtoupper($ui_primary_key_short, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_primary_key_short; ?>", //Editor
                    "data": 'PK',
                    "name": 'PK',
                    "type": "select",
                    "def": "N",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',
                        "class": "form-control"
                    }            
                }, {
                    "responsivePriority": 6,
                    "title": "<?php echo mb_strtoupper($ui_mandatory, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_mandatory; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_reset_password; ?>",
                    "data": 'MANDATORIA',
                    "name": 'MANDATORIA',
                    "type": "select",
                    "def": "N",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',
                        "class": "form-control"
                    }            
                }, {
                    "responsivePriority": 7,
                    "title": "<?php echo mb_strtoupper($ui_notification, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_notification; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_notification_warning; ?>", //Editor
                    "data": 'NOTIF_MANDAT',
                    "name": 'NOTIF_MANDAT',
                    "type": "select",
                    "def": "N",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',
                        "class": "form-control"
                    }                      
                }, {
                    "responsivePriority": 8,
                    "title": "<?php echo mb_strtoupper($ui_order_nr, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_order_nr; ?>", //Editor
                    "data": 'NR_ORDEM',
                    "name": 'NR_ORDEM',
                    "className": "visibleColumn"                  
                }, {
                    "responsivePriority": 9,
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_COLUNA',
                    "name": 'DSP_COLUNA',
                    "className": "visibleColumn",
                    "attr": {
                        "name": "DSP_COLUNA",
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_MODULO',
                    "name": 'ID_MODULO',
                    "type": "hidden",
                    "visible": false,
                    "className": "",  
                }, {
                    "responsivePriority": 9,
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_module, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_module; ?>",
                    "data": 'DSP_MODULO',
                    "name": 'DSP_MODULO',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                                        
                    "attr": {
                        "dependent-group": "MODULOS",
                        "dependent-level": 1,
                        "data-db-name": 'A.ID_MODULO',
                        //"distribute-value": "EMPRESA@RHID@DT_ADMISSAO",
                        "decodeFromTable": 'WEB_ADM_MODULOS_PORTAL A',
                        "desigColumn": "A.DSP_MODULO", 
                        "orderBy": "A.ID_MODULO", 
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": "AND A.ESTADO = 'A'",
                            "edit": "AND A.ESTADO = 'A'"
                        }
                    }    
                }, {
                    "responsivePriority": 10,
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_COLUNA',
                    "name": 'DSR_COLUNA',
                    "className": "none visibleColumn",
                    "attr": {
                        "name": "DSR_COLUNA",
                    }
                }, {
                    "responsivePriority": 11,
                    "title": "<?php echo mb_strtoupper($ui_description, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DESCRICAO',
                    "name": 'DESCRICAO',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn"                  
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
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "data": null,
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        //debugger;
                        return WEB_ADM_RGPD.crudButtons(true,true,true); //CREATE, UPDATE, DELETE
                    } 
                }
            ],
            "validations": {
                "rules": {
                    "TABELA": { 
                        required: true,
                        maxlength: 30
                    },
                    "COLUNA": {
                        required: true,
                        maxlength: 30
                    },
                    "PK": { 
                        required: true
                    },
                    "MANDATORIA": { 
                        required: true
                    },
                    "ID_MODULO": { 
                        required: true
                    },
                    "DESCRICAO": {
                        maxlength: 4000
                    }
                }
            }
        };
        WEB_ADM_RGPD = new QuadTable();
        WEB_ADM_RGPD.initTable( $.extend( {}, datatable_instance_defaults, optionsWEB_ADM_RGPD ) );        

        var optionsWEB_ADM_RGPD_TRADS = {
            "tableId": 'WEB_ADM_RGPD_TRADS',
            "table": "WEB_ADM_RGPD_TRADS",
            "order": false,
            "pk":{
                "primary": {
                    "ID_RGPD": {"type": "number"},
                    "CD_LINGUA": {"type": "number"},
                    "DT_INI": {"type": "date"},
                }
            },
            "dependsOn": {
                "WEB_ADM_RGPD": {
                    "ID_RGPD": "ID_RGPD"
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
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "", //Editor
                    "data": 'ID_RGPD',
                    "name": 'ID_RGPD',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                    "className": "visibleColumn",
                    "attr": {
                        "name": "ID_RGPD",
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
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_TRAD',
                    "name": 'DSR_TRAD',
                    "className": "visibleColumn",
                    "attr": {
                        "name": "DSP_TRAD",
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
                        return WEB_ADM_RGPD_TRADS.crudButtons(true, true, true);
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
        WEB_ADM_RGPD_TRADS = new QuadTable();
        WEB_ADM_RGPD_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsWEB_ADM_RGPD_TRADS));     
    });
</script>
