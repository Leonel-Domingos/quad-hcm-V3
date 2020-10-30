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
                            <a class="nav-link active" data-toggle="tab" href="#Tab1" role="tab" aria-selected="true"><?php echo $ui_proficiency_types; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab2" role="tab" aria-selected="true"><?php echo $ui_proficiency_scales; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab3" role="tab" aria-selected="true"><?php echo $ui_proficiency_levels; ?></a>
                        </li>
                    </ul>
                </div>
            </div>   
            
            <div class="panel-container show">
                <div class="panel-content">
                    
                    <div class="tab-content">

                         <!-- TAB #1 -->
                        <div class="tab-pane fade active show" id="Tab1" role="tabpanel">
                            <a id="RH_DEF_TP_ESCALAS_PROFICIENCIA_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="RH_DEF_TP_ESCALAS_PROFICIENCIA" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-11" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                            <h2><?php echo $ui_translate; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="RH_DEF_TP_ESCALAS_PROFIC_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="RH_DEF_TP_ESCALAS_PROFIC_TRADS" class="table table-bordered table-hover table-striped w-100"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #1 -->

                         <!-- TAB #2 -->
                        <div class="tab-pane fade" id="Tab2" role="tabpanel">
                            <a id="RH_DEF_ESCALAS_PROFICIENCIA_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="RH_DEF_ESCALAS_PROFICIENCIA" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-12" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                            <h2><?php echo $ui_translate; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="RH_DEF_ESCALAS_PROFIC_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="RH_DEF_ESCALAS_PROFIC_TRADS" class="table table-bordered table-hover table-striped w-100"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #2 -->
                        
                         <!-- TAB #3 -->
                        <div class="tab-pane fade" id="Tab3" role="tabpanel">
                            <a id="RH_NIVEIS_ESCALA_PROFICIENCIA_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="RH_NIVEIS_ESCALA_PROFICIENCIA" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-13" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                            <h2><?php echo $ui_translate; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="RH_NIVEIS_ESCALA_PROFIC_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="RH_NIVEIS_ESCALA_PROFIC_TRADS" class="table table-bordered table-hover table-striped w-100"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                        </div>
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
        //Proficiency Types
        var optionsRH_DEF_TP_ESCALAS_PROFICIENCIA = {
            "tableId": 'RH_DEF_TP_ESCALAS_PROFICIENCIA',
            "table": "RH_DEF_TP_ESCALAS_PROFICIENCIA", 
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_proficiency_type; ?>",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_TP_EP": {"type": "number"},
                    "DT_INI_TP_EP": {"type": "date"}
                }
            },
            "crudOnMasterInactive": {
                "condition": "data.DT_FIM_TP_EP !== null",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },
            "detailsObjects": ['RH_DEF_TP_ESCALAS_PROFIC_TRADS'],                    
            "order_by": "EMPRESA, ID_TP_EP, DT_INI_TP_EP desc",
            "scrollY": "234", 
            "recordBundle": 10,
            "pageLenght": 10,  
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
                    "data": 'EMPRESA',
                    "name": 'EMPRESA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    //"targets": 2,
                    responsivePriority: 2,
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
                    //"targets": 3,
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_scale, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_scale; ?>", //Editor
                    "data": 'ID_TP_EP',
                    "name": 'ID_TP_EP',
                    "className": "visibleColumn",
                    attr: {
                        "name": "ID_TP_EP"
                    }
                }, {
                    //"targets": 4,
                    "label": "<?php echo $ui_begin_date; ?>",
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>",
                    "data": 'DT_INI_TP_EP',
                    "name": 'DT_INI_TP_EP',
                    "datatype": 'date',
                    "def": "1900-01-01", //default value
                    "className": "visibleColumn",
                    "attr": {
                        "name": 'DT_INI_TP_EP',
                        "class": "datepicker" 
                    }
                }, {
                    //"targets": 5,
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_TP_EP',
                    "name": 'DSP_TP_EP',
                    "className": "visibleColumn",
                    "attr": {
                        "name": 'DSP_TP_EP',
                    }
                }, {
                    //"targets": 6,
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_TP_EP',
                    "name": 'DSR_TP_EP',
                    "className": "visibleColumn",
                    "attr": {
                        "name": 'DSR_TP_EP',
                    }
                }, {
                    //"targets": 7,
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
                    //"targets": 8,
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM_TP_EP',
                    "name": 'DT_FIM_TP_EP',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "name": 'DT_FIM_TP_EP',
                        "class": "datepicker", 
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
                    //"targets": 13,
                    responsivePriority: 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        //debugger;
                        return RH_DEF_TP_ESCALAS_PROFICIENCIA.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DESIGEMPRESA": { 
                        required: true
                    },
                    "ID_TP_EP": { 
                        required: true,
                        digits: true,
                    },
                    "DT_INI_TP_EP": {
                        required: true,
                        dateISO: true,
                    },
                    "DSP_TP_EP": { 
                        required: true,
                        maxlength: 80,
                    },
                    "DSR_TP_EP": { 
                        required: true,
                        maxlength: 25,
                    },
                    "DT_FIM_TP_EP": {
                        dateISO: true,
                        dateNextThan: 'DT_INI_TP_EP',
                    },                    
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                    "DT_FIM_TP_EP": {
                        dateNextThan: "<?php echo $error_end_dt_greater; ?>"
                    },
                }
            },              
        };
        RH_DEF_TP_ESCALAS_PROFICIENCIA = new QuadTable();
        RH_DEF_TP_ESCALAS_PROFICIENCIA.initTable( $.extend( {}, datatable_instance_defaults, optionsRH_DEF_TP_ESCALAS_PROFICIENCIA ) );        
        //END Proficiency Scales
        
        //Proficiency Types Trads
        var optionRH_DEF_TP_ESCALAS_PROFIC_TRADS = {
            "tableId": 'RH_DEF_TP_ESCALAS_PROFIC_TRADS',
            "table": "RH_DEF_TP_ESCALAS_PROFIC_TRADS", // table in database
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_TP_EP": {"type": "number"},
                    "DT_INI_TP_EP": {"type": "date"},
                    "CD_LINGUA": {"type": "number"},
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "RH_DEF_TP_ESCALAS_PROFICIENCIA": {
                    //External object key mapping( object key : external key)
                    "EMPRESA": "EMPRESA",
                    "ID_TP_EP": "ID_TP_EP",
                    "DT_INI_TP_EP": "DT_INI_TP_EP"
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
                    "title": "<?php echo mb_strtoupper($ui_company, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_company; ?>", //Editor
                    "data": 'EMPRESA',
                    "name": 'EMPRESA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                    "className": "visibleColumn",                    
                    "attr": {
                        "name": 'EMPRESA'
                    }
                }, {
                    //"targets": 2,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'ID_TP_EP',
                    "name": 'ID_TP_EP',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                    "className": "visibleColumn",                    
                    "attr": {
                        "name": 'ID_TP_EP'
                    }
                }, {
                    //"targets": 3,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_TP_EP',
                    "name": 'DT_INI_TP_EP',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                    "className": "visibleColumn", 
                    "attr": {
                        "name": 'DT_INI_TP_EP',
                        "class": "datepicker" 
                    }
                }, {
                    //"targets": 4,
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
                    //"targets": 5,
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
                    //"targets": 6,
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
                    //"targets": 7,
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_TRAD',
                    "name": 'DSP_TRAD',
                }, {
                    //"targets": 8,
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_TRAD',
                    "name": 'DSR_TRAD'
                }, {
                    //"targets": 9,
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
                    //"targets": 10,
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
                    //"targets":15,
                    "responsivePriority": 1,
                    "data": null,
                    "title": "",
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        return RH_DEF_TP_ESCALAS_PROFIC_TRADS.crudButtons(true, true, true);
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
        RH_DEF_TP_ESCALAS_PROFIC_TRADS = new QuadTable();
        RH_DEF_TP_ESCALAS_PROFIC_TRADS.initTable( $.extend({}, datatable_instance_defaults, optionRH_DEF_TP_ESCALAS_PROFIC_TRADS));            
        //END Proficiency Types Trads        
        
        //Proficiency Scales
        var optionsRH_DEF_ESCALAS_PROFICIENCIA = {
            "tableId": 'RH_DEF_ESCALAS_PROFICIENCIA',
            "table": "RH_DEF_ESCALAS_PROFICIENCIA", 
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_proficiency_scale; ?>",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_EP": {"type": "number"},
                    "DT_INI_EP": {"type": "date"},
                }
            },
            "crudOnMasterInactive": {
                "condition": "data.DT_FIM_EP !== null",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },
            "detailsObjects": ['RH_DEF_ESCALAS_PROFIC_TRADS'], 
            "order_by": "EMPRESA, ID_EP, DT_INI_EP desc",
            "scrollY": "234", 
            "recordBundle": 10,
            "pageLenght": 10,         
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
                    "data": 'EMPRESA',
                    "name": 'EMPRESA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    //"targets": 2,
                    responsivePriority: 2,
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
                    //"targets": 3,
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_scale, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_scale; ?>", //Editor
                    "data": 'ID_EP',
                    "name": 'ID_EP',
                    "className": "visibleColumn",
                    attr: {
                        "name": "ID_EP"
                    }
                }, {
                    //"targets": 4,
                    "label": "<?php echo $ui_begin_date; ?>",
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>",
                    "data": 'DT_INI_EP',
                    "name": 'DT_INI_EP',
                    "datatype": 'date',
                    "def": "1900-01-01", //default value
                    "className": "visibleColumn",
                    "attr": {
                        "name": 'DT_INI_EP',
                        "class": "datepicker" 
                    }
                }, {
                    //"targets": 5,
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_EP',
                    "name": 'DSP_EP',
                    "className": "visibleColumn",
                    "attr": {
                        "name": 'DSP_EP',
                    }
                }, {
                    //"targets": 6,
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_EP',
                    "name": 'DSR_EP',
                    "className": "visibleColumn",
                    "attr": {
                        "name": 'DSR_EP',
                    }
                }, {
                    //"targets": 7,
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_TP_EP',
                    "name": 'ID_TP_EP',
                    "type": "hidden", //Editor
                    "visible": false, //DataTable       
                }, {
                    //"targets": 8,
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_TP_EP',
                    "name": 'DT_INI_TP_EP',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTable   
                }, {
                    //"targets": 9,
                    "responsivePriority": 2,
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_proficiency_type, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_proficiency_type; ?>",
                    "data": 'DSP_TP_EP',
                    "name": 'DSP_TP_EP',
                    "className": "visibleColumn",
                    "type": "select",
                    "renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING... 
                    "attr": {
                        "dependent-group" : "EMPRESA",
                        "dependent-level": 2,
                        "data-db-name": 'A.EMPRESA@A.ID_TP_EP@A.DT_INI_TP_EP',
                        "decodeFromTable": 'RH_DEF_TP_ESCALAS_PROFICIENCIA A',
                        "class": "form-control complexList chosen", 
                        "desigColumn": "CONCAT(CONCAT(A.ID_TP_EP,'-'),A.DSP_TP_EP)",
                        "orderBy": "A.EMPRESA, A.ID_TP_EP",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": ' AND A.DT_FIM_TP_EP IS NULL', //On-New-Record
                            "edit": ' AND A.DT_FIM_TP_EP IS NULL', //On-Edit-Record
                        }
                    }                   
                }, {
                    //"targets": 10,
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
                    //"targets": 11,
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM_EP',
                    "name": 'DT_FIM_EP',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "name": 'DT_FIM_EP',
                        "class": "datepicker", 
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
                    //"targets": 16,
                    responsivePriority: 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        //debugger;
                        return RH_DEF_ESCALAS_PROFICIENCIA.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DESIGEMPRESA": { 
                        required: true
                    },
                    "ID_EP": { 
                        required: true,
                        digits: true,
                    },
                    "DT_INI_EP": {
                        required: true,
                        dateISO: true,
                    },
                    "DSP_EP": { 
                        required: true,
                        maxlength: 80,
                    },
                    "DSR_EP": { 
                        required: true,
                        maxlength: 25,
                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },                    
                    "DT_FIM_EP": {
                        dateISO: true,
                        dateNextThan: 'DT_INI_EP',
                    },                    
                },
                "messages": {
                    "DT_FIM_EP": {
                        dateNextThan: "<?php echo $error_end_dt_greater; ?>"
                    },
                }
            },              
        };
        RH_DEF_ESCALAS_PROFICIENCIA = new QuadTable();
        RH_DEF_ESCALAS_PROFICIENCIA.initTable( $.extend( {}, datatable_instance_defaults, optionsRH_DEF_ESCALAS_PROFICIENCIA ) );        
        //END Proficiency Scales        

        //Proficiency Types Trads
        var optionRH_DEF_ESCALAS_PROFIC_TRADS = {
            "tableId": 'RH_DEF_ESCALAS_PROFIC_TRADS',
            "table": "RH_DEF_ESCALAS_PROFIC_TRADS", // table in database
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_EP": {"type": "number"},
                    "DT_INI_EP": {"type": "date"},
                    "CD_LINGUA": {"type": "number"},
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "RH_DEF_ESCALAS_PROFICIENCIA": {
                    //External object key mapping( object key : external key)
                    "EMPRESA": "EMPRESA",
                    "ID_EP": "ID_EP",
                    "DT_INI_EP": "DT_INI_EP"
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
                    "title": "<?php echo mb_strtoupper($ui_company, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_company; ?>", //Editor
                    "data": 'EMPRESA',
                    "name": 'EMPRESA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                    "className": "visibleColumn",                    
                    "attr": {
                        "name": 'EMPRESA'
                    }
                }, {
                    //"targets": 2,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'ID_EP',
                    "name": 'ID_EP',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                    "className": "visibleColumn",                    
                    "attr": {
                        "name": 'ID_EP'
                    }
                }, {
                    //"targets": 3,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_EP',
                    "name": 'DT_INI_EP',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                    "className": "visibleColumn", 
                    "attr": {
                        "name": 'DT_INI_EP',
                        "class": "datepicker" 
                    }
                }, {
                    //"targets": 4,
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
                    //"targets": 5,
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
                    //"targets": 6,
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
                    //"targets": 7,
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_TRAD',
                    "name": 'DSP_TRAD',
                }, {
                    //"targets": 8,
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_TRAD',
                    "name": 'DSR_TRAD',
                }, {
                    //"targets": 9,
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
                    //"targets": 10,
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
                    //"targets":15,
                    "responsivePriority": 1,
                    "data": null,
                    "title": "",
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        return RH_DEF_ESCALAS_PROFIC_TRADS.crudButtons(true, true, true);
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
        RH_DEF_ESCALAS_PROFIC_TRADS = new QuadTable();
        RH_DEF_ESCALAS_PROFIC_TRADS.initTable( $.extend({}, datatable_instance_defaults, optionRH_DEF_ESCALAS_PROFIC_TRADS));            
        //END Proficiency Types Trads        
        
        //Proficiency Levels
        var optionsRH_NIVEIS_ESCALA_PROFICIENCIA = {
            "tableId": 'RH_NIVEIS_ESCALA_PROFICIENCIA',
            "table": "RH_NIVEIS_ESCALA_PROFICIENCIA", 
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_proficiency_level; ?>",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_EP": {"type": "number"},
                    "DT_INI_EP": {"type": "date"},
                    "ID_NV_ESCALA": {"type": "number"},
                    "DT_INI_NV_ESCALA": {"type": "date"}
                }
            },
            "crudOnMasterInactive": {
                "condition": "data.DT_FIM_NV_ESCALA !== null",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },
            "detailsObjects": ['RH_NIVEIS_ESCALA_PROFIC_TRADS'], 
            "order_by": "EMPRESA, ID_EP, DT_INI_EP, nvl(NR_ORD, ID_NV_ESCALA)",
            "scrollY": "234", 
            "recordBundle": 10,
            "pageLenght": 10, 
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
                    "data": 'EMPRESA',
                    "name": 'EMPRESA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    //"targets": 2,
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
                    //"targets": 3,
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_EP',
                    "name": 'ID_EP',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {    
                    //"targets": 4,
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_EP',
                    "name": 'DT_INI_EP',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                    "attr": {
                        "name": 'DT_INI_EP',
                        "class": "datepicker" 
                    }
                }, {
                    //"targets": 5,
                    "responsivePriority": 2,
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_proficiency_scale, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_proficiency_scale; ?>",
                    "data": 'DSP_EP',
                    "name": 'DSP_EP',
                    "className": "visibleColumn",
                    "type": "select",
                    "renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING... 
                    "attr": {
                        "dependent-group" : "EMPRESA",
                        "dependent-level": 2,
                        "data-db-name": 'A.EMPRESA@A.ID_EP@A.DT_INI_EP',
                        "decodeFromTable": 'RH_DEF_ESCALAS_PROFICIENCIA A',
                        "class": "form-control complexList chosen", 
                        "desigColumn": "CONCAT(CONCAT(A.ID_EP,'-'),A.DSP_EP)",
                        "orderBy": "A.EMPRESA, A.ID_EP",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": ' AND A.DT_FIM_EP IS NULL', //On-New-Record
                            "edit": ' AND A.DT_FIM_EP IS NULL', //On-Edit-Record
                        }
                    }                                        
                }, {
                    //"targets": 6,
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_level, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_level; ?>", //Editor
                    "data": 'ID_NV_ESCALA',
                    "name": 'ID_NV_ESCALA',
                    "className": "visibleColumn",
                    "attr": {
                        "name": 'ID_NV_ESCALA',
                    }
                }, {
                    //"targets": 7,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_NV_ESCALA',
                    "name": 'DT_INI_NV_ESCALA',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "def": "1900-01-01",
                    "attr": {
                        "name": 'DT_INI_NV_ESCALA',
                        "class": "datepicker" 
                    }
                }, {
                    //"targets": 8,
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_NEP',
                    "name": 'DSP_NEP',
                    "className": "visibleColumn",
                    "attr": {
                        "name": 'DSP_NEP',
                    }
                }, {
                    //"targets": 9,
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_NEP',
                    "name": 'DSR_NEP',
                    "className": "visibleColumn",
                    "attr": {
                        "name": 'DSR_NEP',
                    }
                }, {
                    //"targets": 10,
                    "title": "<?php echo mb_strtoupper($ui_order_nr, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_order_nr; ?>", //Editor
                    "data": 'NR_ORD',
                    "name": 'NR_ORD',
                    "className": "right visibleColumn",
                    "attr": {
                        "name": 'NR_ORD',
                        "class": "toRight",
                    }
                }, {
                    //"targets": 11,
                    "title": "<?php echo mb_strtoupper($ui_weight, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_weight; ?>", //Editor                    
                    "fieldInfo": "<?php echo $hint_level_percentage_or_weight; ?>", //Editor
                    "data": 'PESO',
                    "name": 'PESO',
                    "className": "right visibleColumn",
                    "attr": {
                        "name": 'PESO',
                        "class": "toRight",
                    }
                    
                }, {
                    //"targets": 12,
                    "title": "<?php echo mb_strtoupper($ui_exclude, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_exclude; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_exclude_from_level_count; ?>", //Editor
                    "data": 'EXCLUIR_CONTAGEM',
                    "name": 'EXCLUIR_CONTAGEM',
                    "type": "select",
                    "className": "none visibleColumn",
                    "def": "N",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',
                        "class": "form-control",
                        "name": 'EXCLUIR_CONTAGEM',
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
                            var o = _.find(initApp.joinsData['DG_SIM_NAO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING']; //o['RV_ABBREVIATION'] ????                            
                        } 
                    }                       
                }, {
                    //"targets": 13,
                    "title": "<?php echo mb_strtoupper($ui_description, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DESCRICAO',
                    "name": 'DESCRICAO',
                    "className": "none visibleColumn",
                    "type": "textarea",
                    "attr": {
                        "name": 'DESCRICAO',
                        "style": "max-width: 335px",
                    }
                }, {
                    //"targets": 14,
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM_NV_ESCALA',
                    "name": 'DT_FIM_NV_ESCALA',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "name": 'DT_FIM_NV_ESCALA',
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
                    //"targets": 19,
                    "responsivePriority": 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        return RH_NIVEIS_ESCALA_PROFICIENCIA.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DESIGEMPRESA": {
                        required: true
                    },                         
                    "DSP_EP": {
                        required: true
                    },     
                    "ID_NV_ESCALA": {
                        required: true,
                        number: true,
                    },
                    "DT_INI_NV_ESCALA": {
                        required: true,
                        dateISO: true,
                    },
                    "DSP_NEP": {
                        required: true,
                        maxlength: 80,
                    },
                    "DSR_NEP": {
                        required: true,
                        maxlength: 25,
                    },
                    "NR_ORD": {
                        number: true,
                    }, 
                    "PESO": {
                        number: true,
                    },                    
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                    "DT_FIM_NV_ESCALA": {
                        dateISO: true,
                        dateNextThan: 'DT_INI_EP',
                    },
                },
                messages: {
                    DT_FIM: {
                        dateNextThan: "<?php echo $error_end_dt_greater; ?>"
                    },
                } 
            },              
        };
        RH_NIVEIS_ESCALA_PROFICIENCIA = new QuadTable();
        RH_NIVEIS_ESCALA_PROFICIENCIA.initTable( $.extend({}, datatable_instance_defaults, optionsRH_NIVEIS_ESCALA_PROFICIENCIA) );
        //END Levels
        
        //Proficiency Levels Trads
        var optionRH_NIVEIS_ESCALA_PROFIC_TRADS = {
            "tableId": 'RH_NIVEIS_ESCALA_PROFIC_TRADS',
            "table": "RH_NIVEIS_ESCALA_PROFIC_TRADS", // table in database
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_EP": {"type": "number"},
                    "DT_INI_EP": {"type": "date"},
                    "ID_NV_ESCALA": {"type": "number"},
                    "DT_INI_NV_ESCALA": {"type": "date"},
                    "CD_LINGUA": {"type": "number"},
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "RH_NIVEIS_ESCALA_PROFICIENCIA": {
                    //External object key mapping( object key : external key)
                    "EMPRESA": "EMPRESA",
                    "ID_EP": "ID_EP",
                    "DT_INI_EP": "DT_INI_EP",
                    "ID_NV_ESCALA": "ID_NV_ESCALA",
                    "DT_INI_NV_ESCALA": "DT_INI_NV_ESCALA"
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
                    "title": "<?php echo mb_strtoupper($ui_company, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_company; ?>", //Editor
                    "data": 'EMPRESA',
                    "name": 'EMPRESA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                    "className": "visibleColumn",                    
                    "attr": {
                        "name": 'EMPRESA'
                    }
                }, {
                    //"targets": 2,
                    "title": "<?php echo mb_strtoupper($ui_scale, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_scale; ?>", //Editor
                    "data": 'ID_EP',
                    "name": 'ID_EP',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                    "className": "visibleColumn",                    
                    "attr": {
                        "name": 'ID_EP'
                    }
                }, {
                    //"targets": 3,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_EP',
                    "name": 'DT_INI_EP',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                    "className": "visibleColumn", 
                    "attr": {
                        "name": 'DT_INI_EP',
                        "class": "datepicker" 
                    }
                }, {
                    //"targets": 4,
                    "title": "<?php echo mb_strtoupper($ui_level, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_level; ?>", //Editor
                    "data": 'ID_NV_ESCALA',
                    "name": 'ID_NV_ESCALA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                    "className": "visibleColumn",                    
                    "attr": {
                        "name": 'ID_NV_ESCALA'
                    }
                }, {
                    //"targets": 5,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_NV_ESCALA',
                    "name": 'DT_INI_NV_ESCALA',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                    "className": "visibleColumn", 
                    "attr": {
                        "name": 'DT_INI_NV_ESCALA',
                        "class": "datepicker" 
                    }
                }, {
                    //"targets": 6,
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
                    //"targets": 7,
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
                    //"targets": 8,
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
                    //"targets": 9,
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_TRAD',
                    "name": 'DSP_TRAD',
                    "attr": {
                        "name": "DSP_TRAD",
                    }
                }, {
                    //"targets": 10,
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_TRAD',
                    "name": 'DSR_TRAD',
                    "attr": {
                        "name": "DSR_TRAD",
                    }
                }, {
                    //"targets": 11,
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
                    //"targets": 12,
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
                    //"targets":17,
                    "responsivePriority": 1,
                    "data": null,
                    "title": "",
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        return RH_NIVEIS_ESCALA_PROFIC_TRADS.crudButtons(true, true, true);
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
        RH_NIVEIS_ESCALA_PROFIC_TRADS = new QuadTable();
        RH_NIVEIS_ESCALA_PROFIC_TRADS.initTable( $.extend({}, datatable_instance_defaults, optionRH_NIVEIS_ESCALA_PROFIC_TRADS));            
        //END Proficiency Levels Trads  
    });
</script>
