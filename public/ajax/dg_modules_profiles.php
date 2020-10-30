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
                            <a class="nav-link active" data-toggle="tab" href="#Tab1" role="tab" aria-selected="true"><?php echo $ui_modules; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab2" role="tab" aria-selected="true"><?php echo $ui_rules; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab3" role="tab" aria-selected="true"><?php echo $ui_profiles; ?></a>
                        </li>
                    </ul>
                </div>
            </div>   
            
            <div class="panel-container show">
                <div class="panel-content">
                    
                    <div class="tab-content">

                         <!-- TAB #1 -->
                        <div class="tab-pane fade active show" id="Tab1" role="tabpanel">
                            <a id="WEB_ADM_MODULOS_PORTAL_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="WEB_ADM_MODULOS_PORTAL" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-11" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                            <h2><?php echo $ui_translate; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="WEB_ADM_MOD_PORTAL_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="WEB_ADM_MOD_PORTAL_TRADS" class="table table-bordered table-hover table-striped w-100"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #1 -->

                         <!-- TAB #2 -->
                        <div class="tab-pane fade" id="Tab2" role="tabpanel">
                            <a id="WEB_ADM_MODULE_RULES_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="WEB_ADM_MODULE_RULES" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                        </div>
                         <!-- END TAB #2 -->
                        
                         <!-- TAB #3 -->
                        <div class="tab-pane fade" id="Tab3" role="tabpanel">
                            <a id="WEB_ADM_PERFIS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="WEB_ADM_PERFIS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-11" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                            <h2><?php echo $ui_translate; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="WEB_ADM_PERFIS_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="WEB_ADM_PERFIS_TRADS" class="table table-bordered table-hover table-striped w-100"></table>
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

        //Modules
        var optionsWEB_ADM_MODULOS_PORTAL = {
            "tableId": 'WEB_ADM_MODULOS_PORTAL',
            "table": "WEB_ADM_MODULOS_PORTAL",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_module; ?>",            
            "pk": {
                "primary": {
                    "ID_MODULO": {"type": "number"}
                }
            },
            "detailsObjects": ['WEB_ADM_MOD_PORTAL_TRADS'],
            "initialWhereClause": "",
            "order_by": "COALESCE(ID_PAI,ID_MODULO),NR_ORDEM",  // o uso do COALESCE no ORDER BY obriga a efetuar QUERYALL (recordBundle=9999, pageLenght=9999)
            "scrollY": "234", 
            "recordBundle": 9999,
            "pageLenght": 9999,  
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
                    "data": 'ID_MODULO',
                    "name": 'ID_MODULO',
                    "datatype": 'sequence',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": true,
                    "className": "visibleColumn"
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_description, 'UTF-8'); ?>", //Datatables 
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DSP_MODULO',
                    "name": 'DSP_MODULO',
                    "className": "visibleColumn",
                    "render": function (val, type, row) {
                            if (row['ID_PAI']) {
                                return '<span class="quadSubTitle">' + val + '</span>';
                            } else {
                                return val;
                            }
                    }               
                }, {
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables 
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_MODULO',
                    "name": 'DSR_MODULO',
                    "className": "visibleColumn",
                    "render": function (val, type, row) {
                            if (row['ID_PAI']) {
                                return '<span class="quadSubTitle">' + val + '</span>';
                            } else {
                                return val;
                            }
                    }               
                }, {
                    "responsivePriority": 5,                    
                    "title": "<?php echo mb_strtoupper($ui_status, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_status; ?>", //Editor
                    "data": 'ESTADO',
                    "name": 'ESTADO',
                    "type": "select",
                    "def": "A",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'WEB_ADM_MODULOS_PORTAL.ESTADO',
                        "class": "form-control"
                    }
                }, {
                    "responsivePriority": 6,                    
                    "title": "<?php echo mb_strtoupper($ui_maintenance, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_maintenance; ?>", //Editor
                    "data": 'MANUTENCAO',
                    "name": 'MANUTENCAO',
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
                    "title": "<?php echo mb_strtoupper($ui_workflow, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_workflow; ?>", //Editor
                    "data": 'WORKFLOW',
                    "name": 'WORKFLOW',
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
                    "title": "<?php echo mb_strtoupper($ui_rgpd_short, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_rgpd_short; ?>", //Editor
                    "data": 'RGPD',
                    "name": 'RGPD',
                    "type": "select",
                    "def": "N",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',
                        "class": "form-control"
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_PAI',
                    "name": 'ID_PAI',
                    "type": "hidden",
                    "visible": false,
                    "className": "",  
                }, {
                    "responsivePriority": 9,
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_context, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_context; ?>",
                    "fieldInfo": "<?php echo $hint_parent_module; ?>",
                    "data": 'DSP_MODULO_PAI',
                    "name": 'DSP_MODULO_PAI',
                    "type": "select",
                    "className": "visibleColumn",
                    "renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "MODULO_PAI",
                        "dependent-level": 1,
                        //"deferred": true,
                        "data-db-name": "A.ID_MODULO",
                        "distribute-value": "ID_PAI",
                        "desigColumn": "A.DSP_MODULO", 
                        "decodeFromTable": "WEB_ADM_MODULOS_PORTAL A",  //TO CHANGE ON QUAD-HCM
                        "orderBy": "A.ID_MODULO",
                        "class": "form-control complexList chosen",
                        /*"filter": {
                            "create": "", //On-New-Record
                            "edit": "", // @PTE_ERRO: não carrega valores, AND ID_MODULO != :ID_MODULO ", //On-Edit-Record
                        }*/
                        }

                }, {
                    "responsivePriority": 10,
                    "title": "<?php echo mb_strtoupper($ui_rules, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_rules; ?>", //Editor
                    "data": 'REGRAS',
                    "name": 'REGRAS',
                    "type": "select",
                    "def": "N",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',
                        "class": "form-control"
                    }
                }, {
                    "responsivePriority": 11,
                    "title": "<?php echo mb_strtoupper($ui_sequence_number, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_sequence_number; ?>", //Editor
                    "data": 'NR_ORDEM',
                    "name": 'NR_ORDEM',
                    "def": "0",
                    "attr": {
                        "class": "form-control"
                    }
                }, {
                    "responsivePriority": 12,                    
                    "title": "<?php echo mb_strtoupper($ui_reference, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_reference; ?>", //Editor
                    "data": 'TABELA_ASSOCIADA',
                    "name": 'TABELA_ASSOCIADA',
                    "attr": {
                        "class": "form-control"
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
                        return WEB_ADM_MODULOS_PORTAL.crudButtons(true, true, true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DSP_MODULO": {
                        required: true,
                        maxlength: 80
                    },
                    "DSR_MODULO": {
                        required: true,
                        maxlength: 30
                    },
                    "ESTADO": {
                        required: true
                    },
                    "WORKFLOW": {
                        required: true
                    },
                    "REGRAS": {
                        required: true
                    }
                }
            },
        };
        WEB_ADM_MODULOS_PORTAL = new QuadTable();
        WEB_ADM_MODULOS_PORTAL.initTable($.extend({}, datatable_instance_defaults, optionsWEB_ADM_MODULOS_PORTAL));        
        //END Modules

        //Modules Trads 
        var optionsWEB_ADM_MOD_PORTAL_TRADS = {
            "tableId": 'WEB_ADM_MOD_PORTAL_TRADS',
            "table": "WEB_ADM_MOD_PORTAL_TRADS",
            "order": false,
            "pk":{
                "primary": {
                    "ID_MODULO": {"type": "number"},
                    "CD_LINGUA": {"type": "number"},
                    "DT_INI": {"type": "date"},
                }
            },
            "dependsOn": {
                "WEB_ADM_MODULOS_PORTAL": {
                    "ID_MODULO": "ID_MODULO"
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
                    "data": 'ID_MODULO',
                    "name": 'ID_MODULO',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                    "className": "visibleColumn"
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_LINGUA',
                    "name": 'CD_LINGUA',
                    "type": "hidden", //Editor
                    "visible": false //DataTables
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
                    "className": "visibleColumn"
                }, {
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_TRAD',
                    "name": 'DSR_TRAD',
                    "className": "visibleColumn"
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
                        return WEB_ADM_MOD_PORTAL_TRADS.crudButtons(true, true, true);
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
        WEB_ADM_MOD_PORTAL_TRADS = new QuadTable();
        WEB_ADM_MOD_PORTAL_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsWEB_ADM_MOD_PORTAL_TRADS));     
        //END Modules Trads

        //Modules :: RULES
        var optionsWEB_ADM_MODULE_RULES = {
            "tableId": 'WEB_ADM_MODULE_RULES',
            "table": "WEB_ADM_MODULE_RULES",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_rule; ?>",            
            "pk": {
                "primary": {
                    "ID": {"type": "number"}
                }
            },
            "initialWhereClause": "",
            "order_by": "ID_MODULO, OPERACAO, TIPO, OPERACAO, ESTADO, ID",  // o uso do COALESCE no ORDER BY obriga a efetuar QUERYALL (recordBundle=9999, pageLenght=9999)
            "scrollY": "546", 
            "recordBundle": 9999,
            "pageLenght": 9999,  
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "className": "control toBottom toCenter",
                    "width": "1%",
                    "defaultContent": '' 
                }, {
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables 
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'ID',
                    "name": 'ID',
                    "datatype": 'sequence',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": true,
                    "className": "none visibleColumn"
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_MODULO',
                    "name": 'ID_MODULO',
                    "type": "hidden",
                    "visible": false,
                    "className": "",  
                }, {
                    "responsivePriority": 1,
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_module, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_module; ?>",
                    "data": 'DSP_MODULO',
                    "name": 'DSP_MODULO',
                    "type": "select",
                    "className": "visibleColumn",
                    "renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "MODULOS",
                        "dependent-level": 1,
                        //"deferred": true,
                        "data-db-name": "A.ID_MODULO",
                        "desigColumn": "DSP_MODULO", 
                        "decodeFromTable": "WEB_ADM_MODULOS_PORTAL A",  //TO CHANGE ON QUAD-HCM
                        "orderBy": "A.ID_MODULO",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.ESTADO = 'A' AND A.REGRAS = 'S'", //On-New-Record
                            "edit": " AND A.ESTADO = 'A' AND A.REGRAS = 'S'", //On-Edit-Record
                        }
                    }              
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
                        "dependent-group": 'WEB_ADM_MODULE_RULES.OPERACAO',
                        "class": "form-control"
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'EMPRESA',
                    "name": 'EMPRESA',                    
                    "type": "hidden",
                    "visible": false,
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
                    "title": "<?php echo mb_strtoupper($ui_type, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_type; ?>", //Editor
                    "data": 'TIPO',
                    "name": 'TIPO',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'WEB_ADM_MODULE_RULES.TIPO',
                        "class": "form-control"
                    }
                }, {
                    "responsivePriority": 4,                    
                    "title": "<?php echo mb_strtoupper($ui_time_attendance, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_time_attendance; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_time_attendance_scenery; ?>", //Editor
                    "data": 'PONTO',
                    "name": 'PONTO',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_OPCIONAL_SIM_NAO',
                        "class": "form-control"
                    }
                }, {
                    "responsivePriority": 5,                    
                    "title": "<?php echo mb_strtoupper($ui_status, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_status; ?>", //Editor
                    "data": 'ESTADO',
                    "name": 'ESTADO',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'WEB_ADM_MODULE_RULES.ESTADO',
                        "class": "form-control"
                    }                    
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ANTES_PA',
                    "name": 'ANTES_PA',
                    "type": "hidden",
                    "visible": false,
                    "className": "", 
                }, {
                    "responsivePriority": 5,                    
                    "title": "<?php echo mb_strtoupper($ui_sense, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_sense; ?>", //Editor
                    "data": 'PERFIL_SENTIDO',
                    "name": 'PERFIL_SENTIDO',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'WEB_ADM_MODULE_RULES.PERFIL_SENTIDO',
                        "class": "form-control"
                    }                                        
                }, {
                    "responsivePriority": 6,
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_before, 'UTF-8').'&nbsp;<sup><span class=\"myTitleHelp\" title=\"'.$ui_attendance_period.'\"><i class=\"far fa-info-circle\"></i><span></sup>'; ?>", //Datatables
                    "label": "<?php echo $ui_before.'&nbsp;<sup><span class=\"myTitleHelp\" title=\"'.$ui_attendance_period.'\"><i class=\"far fa-info-circle\"></i><span></sup>'; ?>", //Editor
                    "data": 'DSP_ANTES_PA',
                    "name": 'DSP_ANTES_PA',
                    "type": "select",
                    "className": "visibleColumn",
                    "renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "MODULOS",
                        "dependent-level": 2,
                        "data-db-name": "A.ID_MODULO@A.ID_PERFIL",
                        "distribute-value": "ID_MODULO@ANTES_PA",
                        "desigColumn": "A.DSP_PERFIL", 
                        "decodeFromTable": "WEB_ADM_PERFIS_RULES A",  //TO CHANGE ON QUAD-HCM
                        "orderBy": "A.ID_PERFIL ASC",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.MODO_ACESSO = 'A'", //On-New-Record
                            "edit": " AND A.MODO_ACESSO = 'A'", //On-Edit-Record
                        }
                    },
                    "render": function (val, type, row) {
                         if (val === '') {
                             return "<?php echo $ui_none; ?>"
                         }
                         return val;
                    } 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DURANTE_PA',
                    "name": 'DURANTE_PA',
                    "type": "hidden",
                    "visible": false,
                    "className": ""
                }, {
                    "responsivePriority": 6,
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_during, 'UTF-8').'&nbsp;<sup><span class=\"myTitleHelp\" title=\"'.$ui_attendance_period.'\"><i class=\"far fa-info-circle\"></i><span></sup>'; ?>", //Datatables
                    "label": "<?php echo $ui_during.'&nbsp;<sup><span class=\"myTitleHelp\" title=\"'.$ui_attendance_period.'\"><i class=\"far fa-info-circle\"></i><span></sup>'; ?>", //Editor
                    "data": 'DSP_DURANTE_PA',
                    "name": 'DSP_DURANTE_PA',
                    "type": "select",
                    "className": "visibleColumn",
                    "renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "MODULOS",
                        "dependent-level": 2,
                        "data-db-name": "A.ID_MODULO@A.ID_PERFIL",
                         "distribute-value": "ID_MODULO@DURANTE_PA",
                        "desigColumn": "A.DSP_PERFIL", 
                        "decodeFromTable": "WEB_ADM_PERFIS_RULES A",  //TO CHANGE ON QUAD-HCM
                        "orderBy": "A.ID_PERFIL ASC",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.MODO_ACESSO = 'A'", //On-New-Record
                            "edit": " AND A.MODO_ACESSO = 'A'", //On-Edit-Record
                        }
                    },
                    "render": function (val, type, row) {
                         if (val === '') {
                             return "<?php echo $ui_none; ?>"
                         }
                         return val;
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DEPOIS_PA',
                    "name": 'DEPOIS_PA',
                    "type": "hidden",
                    "visible": false,
                    "className": ""
                }, {
                    "responsivePriority": 6,
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_after, 'UTF-8').'&nbsp;<sup><span class=\"myTitleHelp\" title=\"'.$ui_attendance_period.'\"><i class=\"far fa-info-circle\"></i><span></sup>'; ?>", //Datatables
                    "label": "<?php echo $ui_after.'&nbsp;<sup><span class=\"myTitleHelp\" title=\"'.$ui_attendance_period.'\"><i class=\"far fa-info-circle\"></i><span></sup>'; ?>", //Editor
                    "data": 'DSP_DEPOIS_PA',
                    "name": 'DSP_DEPOIS_PA',
                    "type": "select",
                    "className": "visibleColumn",
                    "renew": true,
                    "attr": {
                        "dependent-group": "MODULOS",
                        "dependent-level": 2,
                        "data-db-name": "A.ID_MODULO@A.ID_PERFIL",
                        "distribute-value": "ID_MODULO@DEPOIS_PA",
                        "desigColumn": "A.DSP_PERFIL", 
                        "decodeFromTable": "WEB_ADM_PERFIS_RULES A",  //TO CHANGE ON QUAD-HCM
                        "orderBy": "A.ID_PERFIL ASC",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.MODO_ACESSO = 'A'", //On-New-Record
                            "edit": " AND A.MODO_ACESSO = 'A'", //On-Edit-Record
                        }
                    },
                    "render": function (val, type, row) {
                         if (val === '') {
                             return "<?php echo $ui_none; ?>"
                         }
                         return val;
                    }
                }, {
                    "responsivePriority": 1,                    
                    "title": "<?php echo mb_strtoupper($ui_active, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_active; ?>", //Editor
                    "data": 'ATIVO',
                    "name": 'ATIVO',
                    "type": "select",
                    "def": "S",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',
                        "class": "form-control"
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_validation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_validation; ?>", //Editor
                    "data": 'VALIDACAO',
                    "name": 'VALIDACAO',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 335px",
                    }      
                }, {                    
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_MODULO_DEST',
                    "name": 'ID_MODULO_DEST',
                    "type": "hidden",
                    "visible": false,
                    "className": "",  
                }, {
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_destiny_module, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_destiny_module; ?>",
                    "data": 'DSP_MODULO_DEST',
                    "name": 'DSP_MODULO_DEST',
                    "type": "select",
                    "className": "none visibleColumn",
                    "renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "deferred": true,
                        "dependent-group": "MODULOS",
                        "dependent-level": 2,
                        "data-db-name": "A.ID_MODULO",
                        "distribute-value": "ID_MODULO_DEST",
                        "desigColumn": "A.DSP_MODULO", 
                        "decodeFromTable": "WEB_ADM_MODULOS_PORTAL A",  //TO CHANGE ON QUAD-HCM
                        "orderBy": "A.ID_MODULO",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.ESTADO = 'A' AND A.REGRAS = 'S' AND A.ID_MODULO != ':ID_MODULO'", //On-New-Record
                            "edit": " AND A.ESTADO = 'A' AND A.REGRAS = 'S' AND A.ID_MODULO != ':ID_MODULO'", //On-Edit-Record
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
                        return WEB_ADM_MODULE_RULES.crudButtons(true, true, true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DSP_MODULO": {
                        required: true
                    },
                    "OPERACAO": {
                        required: true                        
                    },
                    "VALIDACAO": {
                        maxlength: 4000
                    },
                    "OBS": {
                        maxlength: 4000
                    }
                }
            },
        };
        WEB_ADM_MODULE_RULES = new QuadTable();
        WEB_ADM_MODULE_RULES.initTable($.extend({}, datatable_instance_defaults, optionsWEB_ADM_MODULE_RULES));        
        //END Modules :: RULES
        
        //Profiles
        var optionsWEB_ADM_PERFIS = {
            "tableId": 'WEB_ADM_PERFIS',
            "table": "WEB_ADM_PERFIS",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_profile; ?>",            
            "pk": {
                "primary": {
                    "ID": {"type": "number"}
                }
            }, 
            "detailsObjects": ['WEB_ADM_PERFIS_TRADS'],
            "initialWhereClause": "",
            "order_by": "COALESCE(NR_ORDEM,9999)",
            "scrollY": "234", 
            "recordBundle": 10,
            "pageLenght": 10,  
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
                    "data": 'ID',
                    "name": 'ID',
                    "datatype": 'sequence',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": true,
                    "className": "visibleColumn"
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_description, 'UTF-8'); ?>", //Datatables 
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DSP_PERFIL',
                    "name": 'DSP_PERFIL',
                    "className": "visibleColumn"
                }, {
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables 
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_PERFIL',
                    "name": 'DSR_PERFIL',
                    "className": "visibleColumn"
                }, {
                    "responsivePriority": 5,                    
                    "title": "<?php echo mb_strtoupper($ui_type, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_type; ?>", //Editor
                    "data": 'TIPO_PERFIL',
                    "name": 'TIPO_PERFIL',
                    "type": "select",
                    "def": "A",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'WEB_ADM_PERFIS.TIPO_PERFIL',
                        "class": "form-control"
                    }
                }, {
                    "responsivePriority": 6,                    
                    "title": "<?php echo mb_strtoupper($ui_status, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_status; ?>", //Editor
                    "data": 'ESTADO',
                    "name": 'ESTADO',
                    "type": "select",
                    "def": "A",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'WEB_ADM_PERFIS.ESTADO',
                        "class": "form-control"
                    }
                }, {
                    "responsivePriority": 7,                    
                    "title": "<?php echo mb_strtoupper($ui_workflow, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_workflow; ?>", //Editor
                    "data": 'WORKFLOW',
                    "name": 'WORKFLOW',
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
                    "title": "<?php echo mb_strtoupper($ui_hierarchy, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_hierarchy; ?>", //Editor
                    "data": 'HIERARQUIA',
                    "name": 'HIERARQUIA',
                    "type": "select",
                    "def": "N",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',
                        "class": "form-control"
                    }
                }, {                
                    "responsivePriority": 9,
                    "title": "<?php echo mb_strtoupper($ui_order_nr, 'UTF-8'); ?>", //Datatables 
                    "label": "<?php echo $ui_order_nr; ?>", //Editor
                    "data": 'NR_ORDEM',
                    "name": 'NR_ORDEM',
                    "className": "visibleColumn"
                }, {
                    "responsivePriority": 10,
                    "title": "<?php echo mb_strtoupper($ui_description, 'UTF-8'); ?>", //Datatables 
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DESCRICAO',
                    "name": 'DESCRICAO',
                    "className": "none visibleColumn"
                }, {                     "title": "", //Datatables
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
                        return WEB_ADM_PERFIS.crudButtons(true, true, true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DSP_PERFIL": {
                        required: true,
                        maxlength: 80
                    },
                    "DSR_PERFIL": {
                        required: true,
                        maxlength: 30
                    },
                    "TIPO_PERFIL": {
                        required: true
                    },
                    "ESTADO": {
                        required: true
                    },
                    "HIERARQUIA": {
                        required: true
                    },
                    "WORKFLOW": {
                        required: true
                    }
                }
            }
        };
        WEB_ADM_PERFIS = new QuadTable();
        WEB_ADM_PERFIS.initTable($.extend({}, datatable_instance_defaults, optionsWEB_ADM_PERFIS));        
        //END Profiles

        //Profile Trads 
        var optionsWEB_ADM_PERFIS_TRADS = {
            "tableId": 'WEB_ADM_PERFIS_TRADS',
            "table": "WEB_ADM_PERFIS_TRADS",
            "order": false,
            "pk":{
                "primary": {
                    "ID": {"type": "number"},
                    "CD_LINGUA": {"type": "number"},
                    "DT_INI": {"type": "date"},
                }
            },
            "dependsOn": {
                "WEB_ADM_PERFIS": {
                    "ID": "ID"
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
                    "data": 'ID',
                    "name": 'ID',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                    "className": "visibleColumn"
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_LINGUA',
                    "name": 'CD_LINGUA',
                    "type": "hidden", //Editor
                    "visible": false //DataTables
                }, {
                    "responsivePriority": 2,
                    "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                    "title": "<?php echo mb_strtoupper($ui_language, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_language; ?>",
                    "data": 'DSR_LINGUA',
                    "name": 'DSR_LINGUA',
                    "type": "select",
                    "className": "visibleColumn",
                    "complexlist": true,
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
                    "className": "visibleColumn"
                }, {
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_TRAD',
                    "name": 'DSR_TRAD',
                    "className": "visibleColumn"
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
                        return WEB_ADM_PERFIS_TRADS.crudButtons(true, true, true);
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
        WEB_ADM_PERFIS_TRADS = new QuadTable();
        WEB_ADM_PERFIS_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsWEB_ADM_PERFIS_TRADS));     
        //END Profile Trads

    });
</script>
