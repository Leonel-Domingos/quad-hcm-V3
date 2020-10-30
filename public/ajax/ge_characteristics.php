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
                            <a class="nav-link active" data-toggle="tab" href="#Tab1" role="tab" aria-selected="true"><?php echo $ui_characteristic_type; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab2" role="tab" aria-selected="true"><?php echo $ui_characteristic_1_dom; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab3" role="tab" aria-selected="true"><?php echo $ui_characteristic_2_dom; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab4" role="tab" aria-selected="true"><?php echo $ui_characteristics; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab5" role="tab" aria-selected="true"><?php echo $ui_record_types; ?></a>
                        </li>
                    </ul>
                </div>
            </div>   
            
            <div class="panel-container show">
                <div class="panel-content">
                    
                    <div class="tab-content">

                         <!-- TAB #1 -->
                        <div class="tab-pane fade active show" id="Tab1" role="tabpanel">
                            <a id="RH_DEF_TP_CARACTERISTICAS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="RH_DEF_TP_CARACTERISTICAS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-11" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                            <h2><?php echo $ui_translate; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="RH_DEF_TP_CARACT_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="RH_DEF_TP_CARACT_TRADS" class="table table-bordered table-hover table-striped w-100"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #1 -->

                         <!-- TAB #2 -->
                        <div class="tab-pane fade" id="Tab2" role="tabpanel">
                            <a id="RH_DEF_DOMINIOS_1_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="RH_DEF_DOMINIOS_1" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-12" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                            <h2><?php echo $ui_translate; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="RH_DEF_DOM_1_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="RH_DEF_DOM_1_TRADS" class="table table-bordered table-hover table-striped w-100"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #2 -->
                        
                         <!-- TAB #3 -->
                        <div class="tab-pane fade" id="Tab3" role="tabpanel">
                            <a id="RH_DEF_DOMINIOS_2_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="RH_DEF_DOMINIOS_2" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-13" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                            <h2><?php echo $ui_translate; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="RH_DEF_DOM_2_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="RH_DEF_DOM_2_TRADS" class="table table-bordered table-hover table-striped w-100"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #3 -->
                        
                         <!-- TAB #4 -->
                        <div class="tab-pane fade" id="Tab4" role="tabpanel">
                            <a id="RH_DEF_CARACTERISTICAS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="RH_DEF_CARACTERISTICAS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-14" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                            <h2><?php echo $ui_translate; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="RH_DEF_CARACT_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="RH_DEF_CARACT_TRADS" class="table table-bordered table-hover table-striped w-100"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #4 -->
                        
                         <!-- TAB #5 -->
                        <div class="tab-pane fade" id="Tab5" role="tabpanel">
                            <a id="CursoTpRegisto_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="CursoTpRegisto" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-15" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                            <h2><?php echo $ui_translate; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="CursoTpRegistoTrads_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="CursoTpRegistoTrads" class="table table-bordered table-hover table-striped w-100"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #5 -->
                        
                    </div>                    
                </div>                    
            </div> 
        </div>
    </div>
</div>

<script>
    pageSetUp();

    $(document).ready(function () {
        //TAB 1 :: Characteristics Type
        var optionsRH_DEF_TP_CARACTERISTICAS = {
            "tableId": 'RH_DEF_TP_CARACTERISTICAS',
            "table": "RH_DEF_TP_CARACTERISTICAS", 
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_characteristic_type; ?>",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_TP_CARACT": {"type": "number"},
                    "DT_INI_TP_CARACT": {"type": "date"}
                }
            },
            "crudOnMasterInactive": {
                "condition": "data.DT_FIM_TP_CARACT !== null",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },
            "detailsObjects": ['RH_DEF_TP_CARACT_TRADS'],                    
            "order_by": "EMPRESA, ID_TP_CARACT, DT_INI_TP_CARACT desc",
            "scrollY": "250", 
            "recordBundle": 10,
            "pageLenght": 10, 
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "width": "1%", 
                    "className": "control toBottom toCenter",
                    "orderable": false,
                    "defaultContent": ''
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
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_scale, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_scale; ?>", //Editor
                    "data": 'ID_TP_CARACT',
                    "name": 'ID_TP_CARACT',
                    "className": "visibleColumn",
                }, {
                    "label": "<?php echo $ui_begin_date; ?>",
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>",
                    "data": 'DT_INI_TP_CARACT',
                    "name": 'DT_INI_TP_CARACT',
                    "datatype": 'date',
                    "def": "1900-01-01", //default value
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }
                }, {
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_TP_CARACT',
                    "name": 'DSP_TP_CARACT',
                    "className": "visibleColumn",
                }, {
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_TP_CARACT',
                    "name": 'DSR_TP_CARACT',
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
                    "data": 'DT_FIM_TP_CARACT',
                    "name": 'DT_FIM_TP_CARACT',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
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
                    responsivePriority: 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        return RH_DEF_TP_CARACTERISTICAS.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DESIGEMPRESA": { 
                        required: true
                    },
                    "ID_TP_CARACT": { 
                        required: true,
                        digits: true,
                    },
                    "DT_INI_TP_CARACT": {
                        required: true,
                        dateISO: true,
                    },
                    "DSP_CARACT": { 
                        required: true,
                        maxlength: 80,
                    },
                    "DSR_CARACT": { 
                        required: true,
                        maxlength: 25,
                    },
                    "DESCRICAO": { 
                        maxlength: 4000,
                    },
                    "DT_FIM_TP_CARACT": {
                        dateISO: true,
                        dateNextThan: 'DT_INI_TP_CARACT',
                    },                    
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                    "DT_FIM_TP_CARACT": {
                        dateNextThan: "<?php echo $error_end_dt_greater; ?>"
                    },
                }
            },              
        };
        RH_DEF_TP_CARACTERISTICAS = new QuadTable();
        RH_DEF_TP_CARACTERISTICAS.initTable( $.extend( {}, datatable_instance_defaults, optionsRH_DEF_TP_CARACTERISTICAS ) );        
        //END TAB 1 :: Characteristics Type
        
        //TAB 1 :: Characteristics Type Trads
        var optionRH_DEF_TP_CARACT_TRADS = {
            "tableId": 'RH_DEF_TP_CARACT_TRADS',
            "table": "RH_DEF_TP_CARACT_TRADS", // table in database
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_TP_CARACT": {"type": "number"},
                    "DT_INI_TP_CARACT": {"type": "date"},
                    "CD_LINGUA": {"type": "number"},
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "RH_DEF_TP_CARACTERISTICAS": {
                    //External object key mapping( object key : external key)
                    "EMPRESA": "EMPRESA",
                    "ID_TP_CARACT": "ID_TP_CARACT",
                    "DT_INI_TP_CARACT": "DT_INI_TP_CARACT"
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
                    "responsivePriority": 1,
                    "data": null,
                    "width": "1%", 
                    "className": "control toBottom toCenter",
                    "orderable": false,
                    "defaultContent": ''
                }, {
                    "title": "<?php echo mb_strtoupper($ui_company, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_company; ?>", //Editor
                    "data": 'EMPRESA',
                    "name": 'EMPRESA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                    "className": "visibleColumn",                    
                }, {
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'ID_TP_CARACT',
                    "name": 'ID_TP_CARACT',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                    "className": "visibleColumn",                    
                }, {
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_TP_CARACT',
                    "name": 'DT_INI_TP_CARACT',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                    "className": "visibleColumn", 
                    "attr": {
                        "class": "datepicker" 
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_LINGUA',
                    "name": 'CD_LINGUA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
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
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI',
                    "name": 'DT_INI',
                    "datatype": 'date',
                    "def": "1900-01-01",
                    "width": "7%",
                    "attr": {//EDITOR CONTROL
                        "class": "datepicker" //dateTimePicker
                    }                    
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_TRAD',
                    "name": 'DSP_TRAD',
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_TRAD',
                    "name": 'DSR_TRAD',
                }, {
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM',
                    "name": 'DT_FIM',
                    "datatype": 'date',
                    "width": "7%",
                    "attr": {//EDITOR CONTROL
                        "class": "datepicker" //dateTimePicker
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
                        return RH_DEF_TP_CARACT_TRADS.crudButtons(true, true, true);
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
        RH_DEF_TP_CARACT_TRADS = new QuadTable();
        RH_DEF_TP_CARACT_TRADS.initTable( $.extend({}, datatable_instance_defaults, optionRH_DEF_TP_CARACT_TRADS));            
        //END TAB 1 :: Characteristics Type Trads       
        
        //TAB 2 :: 1st Domain 
        var optionsRH_DEF_DOMINIOS_1 = {
            "tableId": 'RH_DEF_DOMINIOS_1',
            "table": "RH_DEF_DOMINIOS_1", 
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_characteristic_1_dom; ?>",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_TP_CARACT": {"type": "number"},
                    "DT_INI_TP_CARACT": {"type": "date"},
                    "ID_DOM_1": {"type": "number"},
                    "DT_INI_DOM_1": {"type": "date"},
                }
            },            
            "crudOnMasterInactive": {
                "condition": "data.DT_FIM_DOM_1 !== null",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },
            "detailsObjects": ['RH_DEF_DOM_1_TRADS'],                    
            "order_by": "EMPRESA, ID_TP_CARACT, ID_DOM_1, DT_INI_DOM_1 desc",
            "scrollY": "273", 
            "recordBundle": 10,
            "pageLenght": 10, 
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "width": "1%", 
                    "className": "control toBottom toCenter",
                    "orderable": false,
                    "defaultContent": ''
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
                    "data": 'ID_TP_CARACT',
                    "name": 'ID_TP_CARACT',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_TP_CARACT',
                    "name": 'DT_INI_TP_CARACT',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                                        
                }, {
                    "complexList": true, 
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_type, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_type; ?>",
                    "data": 'DSP_TP_CARACT',
                    "name": 'DSP_TP_CARACT',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "dependent-level": 2,
                        "dependent-group": "EMPRESA",
                        "data-db-name": "A.EMPRESA@A.ID_TP_CARACT@DA.T_INI_TP_CARACT",
                        "decodeFromTable": "RH_DEF_TP_CARACTERISTICAS A",
                        "desigColumn": "A.DSP_TP_CARACT", 
                        "orderBy": "A.ID_TP_CARACT",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": ' AND A.DT_FIM_TP_CARACT IS NULL', //On-New-Record
                            "edit": ' AND A.DT_FIM_TP_CARACT IS NULL', //On-Edit-Record
                        } 
                    }                     
                }, {
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'ID_DOM_1',
                    "name": 'ID_DOM_1',
                    "className": "visibleColumn",
                }, {
                    "label": "<?php echo $ui_begin_date; ?>",
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>",
                    "data": 'DT_INI_DOM_1',
                    "name": 'DT_INI_DOM_1',
                    "datatype": 'date',
                    "def": "1900-01-01", //default value
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }
    
                }, {
                    "responsivePriority": 5,
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_DOM_1',
                    "name": 'DSP_DOM_1',
                    "className": "visibleColumn",
                }, {
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_DOM_1',
                    "name": 'DSR_DOM_1',
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
                    "data": 'DT_FIM_DOM_1',
                    "name": 'DT_FIM_DOM_1',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
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
                    responsivePriority: 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        return RH_DEF_DOMINIOS_1.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DESIGEMPRESA": { 
                        required: true
                    },
                    "ID_DOM_1": { 
                        required: true,
                        digits: true,
                    },
                    "DT_INI_DOM_1": {
                        required: true,
                        dateISO: true,
                    },
                    "DSP_DOM_1": { 
                        required: true,
                        maxlength: 80,
                    },
                    "DSR_DOM_1": { 
                        required: true,
                        maxlength: 25,
                    },
                    "DESCRICAO": { 
                        maxlength: 4000,
                    },
                    "DT_FIM_DOM_1": {
                        dateISO: true,
                        dateNextThan: 'DT_INI_DOM_1',
                    },                    
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                    "DT_FIM_DOM_1": {
                        dateNextThan: "<?php echo $error_end_dt_greater; ?>"
                    },
                }
            },              
        };
        RH_DEF_DOMINIOS_1 = new QuadTable();
        RH_DEF_DOMINIOS_1.initTable( $.extend( {}, datatable_instance_defaults, optionsRH_DEF_DOMINIOS_1 ) );        
        //END TAB 2 :: 1st Domain      
        
        //TAB 2 :: 1st Domain Trads
        var optionRH_DEF_DOM_1_TRADS = {
            "tableId": 'RH_DEF_DOM_1_TRADS',
            "table": "RH_DEF_DOM_1_TRADS", // table in database
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_TP_CARACT": {"type": "number"},
                    "DT_INI_TP_CARACT": {"type": "date"},
                    "ID_DOM_1": {"type": "number"},
                    "DT_INI_DOM_1": {"type": "date"},                    
                    "CD_LINGUA": {"type": "number"},
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "RH_DEF_DOMINIOS_1": {
                    //External object key mapping( object key : external key)
                    "EMPRESA": "EMPRESA",
                    "ID_TP_CARACT": "ID_TP_CARACT",
                    "DT_INI_TP_CARACT": "DT_INI_TP_CARACT",
                    "ID_DOM_1": "ID_DOM_1",
                    "DT_INI_DOM_1": "DT_INI_DOM_1",
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
                    "responsivePriority": 1,
                    "data": null,
                    "width": "1%", 
                    "className": "control toBottom toCenter",
                    "orderable": false,
                    "defaultContent": ''
                }, {
                    "title": "<?php echo mb_strtoupper($ui_company, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_company; ?>", //Editor
                    "data": 'EMPRESA',
                    "name": 'EMPRESA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                    "className": "visibleColumn"                    
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_TP_CARACT',
                    "name": 'ID_TP_CARACT',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                    "className": ""
                }, {
                    "title": "<?php echo mb_strtoupper($ui_company, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_company; ?>", //Editor
                    "data": 'DT_INI_TP_CARACT',
                    "name": 'DT_INI_TP_CARACT',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                    "className": ""   
              }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_DOM_1',
                    "name": 'ID_DOM_1',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                    "className": ""
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_DOM_1',
                    "name": 'DT_INI_DOM_1',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                    "className": ""                       
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_LINGUA',
                    "name": 'CD_LINGUA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
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
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI',
                    "name": 'DT_INI',
                    "datatype": 'date',
                    "def": "1900-01-01",
                    "width": "7%",
                    "attr": {//EDITOR CONTROL
                        "class": "datepicker" //dateTimePicker
                    }                    
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_TRAD',
                    "name": 'DSP_TRAD',
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_TRAD',
                    "name": 'DSR_TRAD',
                }, {
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM',
                    "name": 'DT_FIM',
                    "datatype": 'date',
                    "width": "7%",
                    "attr": {//EDITOR CONTROL
                        "class": "datepicker" //dateTimePicker
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
                        return RH_DEF_DOM_1_TRADS.crudButtons(true, true, true);
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
        RH_DEF_DOM_1_TRADS = new QuadTable();
        RH_DEF_DOM_1_TRADS.initTable( $.extend({}, datatable_instance_defaults, optionRH_DEF_DOM_1_TRADS));            
        //END TAB 2 :: 1st Domain Trads               
                
        //TAB 3 :: 2st Domain 
        var optionsRH_DEF_DOMINIOS_2 = {
            "tableId": 'RH_DEF_DOMINIOS_2',
            "table": "RH_DEF_DOMINIOS_2", 
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_characteristic_2_dom; ?>",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_TP_CARACT": {"type": "number"},
                    "DT_INI_TP_CARACT": {"type": "date"},
                    "ID_DOM_1": {"type": "number"},
                    "DT_INI_DOM_1": {"type": "date"},
                    "ID_DOM_2": {"type": "number"},
                    "DT_INI_DOM_2": {"type": "date"},
                }
            },            
            "crudOnMasterInactive": {
                "condition": "data.DT_FIM_DOM_2 !== null",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },
            "detailsObjects": ['RH_DEF_DOM_2_TRADS'],                    
            "order_by": "EMPRESA, ID_TP_CARACT, ID_DOM_1, ID_DOM_2, DT_INI_DOM_2 desc",
            "scrollY": "273", 
            "recordBundle": 10,
            "pageLenght": 10, 
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "width": "1%", 
                    "className": "control toBottom toCenter",
                    "orderable": false,
                    "defaultContent": ''
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
                    "data": 'ID_TP_CARACT',
                    "name": 'ID_TP_CARACT',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_TP_CARACT',
                    "name": 'DT_INI_TP_CARACT',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                                        
                }, {
                    "complexList": true, 
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_type, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_type; ?>",
                    "data": 'DSP_TP_CARACT',
                    "name": 'DSP_TP_CARACT',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "dependent-level": 2,
                        "dependent-group": "EMPRESA",
                        "data-db-name": "A.EMPRESA@A.ID_TP_CARACT@A.DT_INI_TP_CARACT",
                        "decodeFromTable": "RH_DEF_TP_CARACTERISTICAS A",
                        "desigColumn": "A.DSP_TP_CARACT", 
                        "orderBy": "A.ID_TP_CARACT",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": ' AND A.DT_FIM_TP_CARACT IS NULL', //On-New-Record
                            "edit": ' AND A.DT_FIM_TP_CARACT IS NULL', //On-Edit-Record
                        } 
                    }                     
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_DOM_1',
                    "name": 'ID_DOM_1',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_DOM_1',
                    "name": 'DT_INI_DOM_1',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables 
                }, {
                    "complexList": true, 
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_characteristic_1_dom, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_characteristic_1_dom; ?>",
                    "data": 'DSP_DOM_1',
                    "name": 'DSP_DOM_1',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "dependent-level": 3,
                        "dependent-group": "EMPRESA",
                        "data-db-name": "A.EMPRESA@A.ID_TP_CARACT@A.DT_INI_TP_CARACT@A.ID_DOM_1@DT_INI_DOM_1",
                        "decodeFromTable": "RH_DEF_DOMINIOS_1 A",
                        "desigColumn": "A.DSP_DOM_1", 
                        "orderBy": "A.ID_DOM_1",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": ' AND A.DT_FIM_DOM_1 IS NULL', //On-New-Record
                            "edit": ' AND A.DT_FIM_DOM_1 IS NULL', //On-Edit-Record
                        } 
                    }    
                }, {
                    "responsivePriority": 5,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'ID_DOM_2',
                    "name": 'ID_DOM_2',
                    "className": "visibleColumn",
                }, {
                    "label": "<?php echo $ui_begin_date; ?>",
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>",
                    "data": 'DT_INI_DOM_2',
                    "name": 'DT_INI_DOM_2',
                    "datatype": 'date',
                    "def": "1900-01-01", //default value
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }                    
                }, {
                    "responsivePriority": 6,
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_DOM_2',
                    "name": 'DSP_DOM_2',
                    "className": "visibleColumn",
                }, {
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_DOM_2',
                    "name": 'DSR_DOM_2',
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
                    "data": 'DT_FIM_DOM_2',
                    "name": 'DT_FIM_DOM_2',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
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
                    responsivePriority: 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        return RH_DEF_DOMINIOS_2.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DESIGEMPRESA": { 
                        required: true
                    },
                    "DSP_TP_CARACT": { 
                        required: true
                    },
                    "DSP_DOM_1": { 
                        required: true
                    },
                    "ID_DOM_2": { 
                        required: true,
                        digits: true,
                    },
                    "DT_INI_DOM_2": {
                        required: true,
                        dateISO: true,
                    },
                    "DSP_DOM_2": { 
                        required: true,
                        maxlength: 80,
                    },
                    "DSR_DOM_2": { 
                        required: true,
                        maxlength: 25,
                    },
                    "DESCRICAO": { 
                        maxlength: 4000,
                    },
                    "DT_FIM_DOM_2": {
                        dateISO: true,
                        dateNextThan: 'DT_INI_DOM_2',
                    },                    
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                    "DT_FIM_DOM_2": {
                        dateNextThan: "<?php echo $error_end_dt_greater; ?>"
                    },
                }
            },              
        };
        RH_DEF_DOMINIOS_2 = new QuadTable();
        RH_DEF_DOMINIOS_2.initTable( $.extend( {}, datatable_instance_defaults, optionsRH_DEF_DOMINIOS_2 ) );        
        //END TAB 3 :: 2st Domain          
        
        //TAB 3 :: 2st Domain Trads
        var optionRH_DEF_DOM_2_TRADS = {
            "tableId": 'RH_DEF_DOM_2_TRADS',
            "table": "RH_DEF_DOM_2_TRADS", // table in database
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_TP_CARACT": {"type": "number"},
                    "DT_INI_TP_CARACT": {"type": "date"},
                    "ID_DOM_1": {"type": "number"},
                    "DT_INI_DOM_1": {"type": "date"},                    
                    "ID_DOM_2": {"type": "number"},
                    "DT_INI_DOM_2": {"type": "date"},                    
                    "CD_LINGUA": {"type": "number"},
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "RH_DEF_DOMINIOS_2": {
                    //External object key mapping( object key : external key)
                    "EMPRESA": "EMPRESA",
                    "ID_TP_CARACT": "ID_TP_CARACT",
                    "DT_INI_TP_CARACT": "DT_INI_TP_CARACT",
                    "ID_DOM_1": "ID_DOM_1",
                    "DT_INI_DOM_1": "DT_INI_DOM_1",
                    "ID_DOM_2": "ID_DOM_2",
                    "DT_INI_DOM_2": "DT_INI_DOM_2",
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
                    "responsivePriority": 1,
                    "data": null,
                    "width": "1%", 
                    "className": "control toBottom toCenter",
                    "orderable": false,
                    "defaultContent": ''
                }, {
                    "title": "<?php echo mb_strtoupper($ui_company, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_company; ?>", //Editor
                    "data": 'EMPRESA',
                    "name": 'EMPRESA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                    "className": "visibleColumn"                    
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_TP_CARACT',
                    "name": 'ID_TP_CARACT',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                    "className": ""
                }, {
                    "title": "<?php echo mb_strtoupper($ui_company, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_company; ?>", //Editor
                    "data": 'DT_INI_TP_CARACT',
                    "name": 'DT_INI_TP_CARACT',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                    "className": ""   
              }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_DOM_1',
                    "name": 'ID_DOM_1',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                    "className": ""
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_DOM_1',
                    "name": 'DT_INI_DOM_1',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                    "className": ""
              }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_DOM_2',
                    "name": 'ID_DOM_2',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                    "className": ""
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_DOM_2',
                    "name": 'DT_INI_DOM_2',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                    "className": ""   
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_LINGUA',
                    "name": 'CD_LINGUA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
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
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI',
                    "name": 'DT_INI',
                    "datatype": 'date',
                    "def": "1900-01-01",
                    "width": "7%",
                    "attr": {//EDITOR CONTROL
                        "class": "datepicker" //dateTimePicker
                    }                    
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_TRAD',
                    "name": 'DSP_TRAD',
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_TRAD',
                    "name": 'DSR_TRAD',
                }, {
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM',
                    "name": 'DT_FIM',
                    "datatype": 'date',
                    "width": "7%",
                    "attr": {//EDITOR CONTROL
                        "class": "datepicker" //dateTimePicker
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
                        return RH_DEF_DOM_2_TRADS.crudButtons(true, true, true);
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
        RH_DEF_DOM_2_TRADS = new QuadTable();
        RH_DEF_DOM_2_TRADS.initTable( $.extend({}, datatable_instance_defaults, optionRH_DEF_DOM_2_TRADS));            
        //END TAB 3 :: 2st Domain Trads
                
        //TAB 4 :: Characteristics
        var optionsRH_DEF_CARACTERISTICAS = {
            "tableId": 'RH_DEF_CARACTERISTICAS',
            "table": "RH_DEF_CARACTERISTICAS", 
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_characteristic; ?>",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_TP_CARACT": {"type": "number"},
                    "DT_INI_TP_CARACT": {"type": "date"},
                    "ID_DOM_1": {"type": "number"},
                    "DT_INI_DOM_1": {"type": "date"},
                    "ID_DOM_2": {"type": "number"},
                    "DT_INI_DOM_2": {"type": "date"},
                    "ID_CARACTERISTICA": {"type": "number"},
                    "DT_INI_CARACT": {"type": "date"},
                }
            },            
            "crudOnMasterInactive": {
                "condition": "data.DT_FIM_CARACT !== null",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },
            "detailsObjects": ['RH_DEF_CARACT_TRADS'],                    
            "order_by": "EMPRESA, ID_TP_CARACT, ID_DOM_1, ID_DOM_2, ID_CARACTERISTICA, DT_INI_CARACT desc",
            "scrollY": "273", 
            "recordBundle": 10,
            "pageLenght": 10, 
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "width": "1%", 
                    "className": "control toBottom toCenter",
                    "orderable": false,
                    "defaultContent": ''
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
                    "data": 'ID_TP_CARACT',
                    "name": 'ID_TP_CARACT',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_TP_CARACT',
                    "name": 'DT_INI_TP_CARACT',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                                        
                }, {
                    "complexList": true, 
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_type, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_type; ?>",
                    "data": 'DSP_TP_CARACT',
                    "name": 'DSP_TP_CARACT',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "dependent-level": 2,
                        "dependent-group": "EMPRESA",
                        "data-db-name": "A.EMPRESA@A.ID_TP_CARACT@A.DT_INI_TP_CARACT",
                        "decodeFromTable": "RH_DEF_TP_CARACTERISTICAS A",
                        "desigColumn": "A.DSP_TP_CARACT", 
                        "orderBy": "A.ID_TP_CARACT",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": ' AND A.DT_FIM_TP_CARACT IS NULL', //On-New-Record
                            "edit": ' AND A.DT_FIM_TP_CARACT IS NULL', //On-Edit-Record
                        } 
                    }                     
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_DOM_1',
                    "name": 'ID_DOM_1',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_DOM_1',
                    "name": 'DT_INI_DOM_1',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables 
                }, {
                    "complexList": true, 
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_characteristic_1_dom, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_characteristic_1_dom; ?>",
                    "data": 'DSP_DOM_1',
                    "name": 'DSP_DOM_1',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "dependent-level": 3,
                        "dependent-group": "EMPRESA",
                        "data-db-name": "A.EMPRESA@A.ID_TP_CARACT@A.DT_INI_TP_CARACT@A.ID_DOM_1@A.DT_INI_DOM_1",
                        "decodeFromTable": "RH_DEF_DOMINIOS_1 A",
                        "desigColumn": "A.DSP_DOM_1", 
                        "orderBy": "A.ID_DOM_1",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": ' AND A.DT_FIM_DOM_1 IS NULL', //On-New-Record
                            "edit": ' AND A.DT_FIM_DOM_1 IS NULL', //On-Edit-Record
                        } 
                    }
                    
                    
               }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_DOM_2',
                    "name": 'ID_DOM_2',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_DOM_2',
                    "name": 'DT_INI_DOM_2',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables 
                }, {
                    "complexList": true, 
                    "responsivePriority": 5,
                    "title": "<?php echo mb_strtoupper($ui_characteristic_2_dom, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_characteristic_2_dom; ?>",
                    "data": 'DSP_DOM_2',
                    "name": 'DSP_DOM_2',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "dependent-level": 4,
                        "dependent-group": "EMPRESA",
                        "data-db-name": "A.EMPRESA@A.ID_TP_CARACT@A.DT_INI_TP_CARACT@A.ID_DOM_1@A.DT_INI_DOM_1@A.ID_DOM_2@A.DT_INI_DOM_2",
                        "decodeFromTable": "RH_DEF_DOMINIOS_2 A",
                        "desigColumn": "A.DSP_DOM_2", 
                        "orderBy": "A.ID_DOM_2",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": ' AND A.DT_FIM_DOM_2 IS NULL', //On-New-Record
                            "edit": ' AND A.DT_FIM_DOM_2 IS NULL', //On-Edit-Record
                        } 
                    }                    
                }, {
                    "responsivePriority": 6,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'ID_CARACTERISTICA',
                    "name": 'ID_CARACTERISTICA',
                    "className": "visibleColumn",
                }, {
                    "label": "<?php echo $ui_begin_date; ?>",
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>",
                    "data": 'DT_INI_CARACT',
                    "name": 'DT_INI_CARACT',
                    "datatype": 'date',
                    "def": "1900-01-01", //default value
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }                    
                }, {
                    "responsivePriority": 7,
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_CARACTERISTICA',
                    "name": 'DSP_CARACTERISTICA',
                    "className": "visibleColumn",
                }, {
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_CARACTERISTICA',
                    "name": 'DSR_CARACTERISTICA',
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
                    "data": 'DT_FIM_CARACT',
                    "name": 'DT_FIM_CARACT',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
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
                    responsivePriority: 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        return RH_DEF_DOMINIOS_2.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DESIGEMPRESA": { 
                        required: true
                    },
                    "DSP_TP_CARACT": { 
                        required: true
                    },
                    "DSP_DOM_1": { 
                        required: true
                    },
                    "DSP_DOM_2": { 
                        required: true
                    },
                    "ID_CARACTERISTICA": { 
                        required: true,
                        digits: true,
                    },
                    "DT_INI_CARACT": {
                        required: true,
                        dateISO: true,
                    },
                    "DSP_CARACTERISTICA": { 
                        required: true,
                        maxlength: 80,
                    },
                    "DSR_CARACTERISTICA": { 
                        required: true,
                        maxlength: 25,
                    },
                    "DESCRICAO": { 
                        maxlength: 4000,
                    },
                    "DT_FIM_CARACT": {
                        dateISO: true,
                        dateNextThan: 'DT_INI_CARACT',
                    },                    
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                    "DT_FIM_CARACT": {
                        dateNextThan: "<?php echo $error_end_dt_greater; ?>"
                    },
                }
            },              
        };
        RH_DEF_CARACTERISTICAS = new QuadTable();
        RH_DEF_CARACTERISTICAS.initTable( $.extend( {}, datatable_instance_defaults, optionsRH_DEF_CARACTERISTICAS ) );        
        //END TAB 4 :: Characteristics          

        //TAB 4 :: Characteristics Trads
        var optionRH_DEF_CARACT_TRADS = {
            "tableId": 'RH_DEF_CARACT_TRADS',
            "table": "RH_DEF_CARACT_TRADS", // table in database
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_TP_CARACT": {"type": "number"},
                    "DT_INI_TP_CARACT": {"type": "date"},
                    "ID_DOM_1": {"type": "number"},
                    "DT_INI_DOM_1": {"type": "date"},                    
                    "ID_DOM_2": {"type": "number"},
                    "DT_INI_DOM_2": {"type": "date"},                    
                    "ID_CARACTERISTICA": {"type": "number"},
                    "DT_INI_CARACT": {"type": "date"},                    
                    "CD_LINGUA": {"type": "number"},
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "RH_DEF_CARACTERISTICAS": {
                    //External object key mapping( object key : external key)
                    "EMPRESA": "EMPRESA",
                    "ID_TP_CARACT": "ID_TP_CARACT",
                    "DT_INI_TP_CARACT": "DT_INI_TP_CARACT",
                    "ID_DOM_1": "ID_DOM_1",
                    "DT_INI_DOM_1": "DT_INI_DOM_1",
                    "ID_DOM_2": "ID_DOM_2",
                    "DT_INI_DOM_2": "DT_INI_DOM_2",
                    "ID_CARACT": "ID_CARACTERISTICA",
                    "DT_INI_CARACT" : "DT_INI_CARACT"
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
                    "responsivePriority": 1,
                    "data": null,
                    "width": "1%", 
                    "className": "control toBottom toCenter",
                    "orderable": false,
                    "defaultContent": ''
                }, {
                    "title": "<?php echo mb_strtoupper($ui_company, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_company; ?>", //Editor
                    "data": 'EMPRESA',
                    "name": 'EMPRESA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                    "className": "visibleColumn"                    
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_TP_CARACT',
                    "name": 'ID_TP_CARACT',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                    "className": ""
                }, {
                    "title": "<?php echo mb_strtoupper($ui_company, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_company; ?>", //Editor
                    "data": 'DT_INI_TP_CARACT',
                    "name": 'DT_INI_TP_CARACT',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                    "className": ""   
              }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_DOM_1',
                    "name": 'ID_DOM_1',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                    "className": ""
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_DOM_1',
                    "name": 'DT_INI_DOM_1',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                    "className": ""
              }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_DOM_2',
                    "name": 'ID_DOM_2',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                    "className": ""
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_DOM_2',
                    "name": 'DT_INI_DOM_2',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                    "className": ""   
              }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_CARACTERISTICA',
                    "name": 'ID_CARACTERISTICA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                    "className": ""
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_CARACT',
                    "name": 'DT_INI_CARACT',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                    "className": ""   
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_LINGUA',
                    "name": 'CD_LINGUA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
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
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI',
                    "name": 'DT_INI',
                    "datatype": 'date',
                    "def": "1900-01-01",
                    "width": "7%",
                    "attr": {//EDITOR CONTROL
                        "class": "datepicker" //dateTimePicker
                    }                    
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_TRAD',
                    "name": 'DSP_TRAD',
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_TRAD',
                    "name": 'DSR_TRAD',
                }, {
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM',
                    "name": 'DT_FIM',
                    "datatype": 'date',
                    "width": "7%",
                    "attr": {//EDITOR CONTROL
                        "class": "datepicker" //dateTimePicker
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
                        return RH_DEF_CARACT_TRADS.crudButtons(true, true, true);
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
        RH_DEF_CARACT_TRADS = new QuadTable();
        RH_DEF_CARACT_TRADS.initTable( $.extend({}, datatable_instance_defaults, optionRH_DEF_CARACT_TRADS));            
        //END TAB 4 :: Characteristics Trads
        
        //Training Record Types
        var optionsCursoTpRegisto = {
            "tableId": 'CursoTpRegisto',
            "table": "CG_REF_CODES",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_record_type; ?>",            
            "pk": {
                "primary": {
                    "RV_DOMAIN": {"type": "varchar"},
                    "RV_LOW_VALUE": {"type": "varchar"}
                }
            },
            "detailsObjects": ['CursoTpRegistoTrads'],
            "initialWhereClause": "RV_DOMAIN = 'GF_CURSO_CARACTERISTICAS.TP_REGISTO' ",
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
                    "def": "GF_CURSO_CARACTERISTICAS.TP_REGISTO",
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
                        return CursoTpRegisto.crudButtons(true, true, true);
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
        CursoTpRegisto = new QuadTable();
        CursoTpRegisto.initTable($.extend({}, datatable_instance_defaults, optionsCursoTpRegisto));
        //Training Record Types
        
        //Training Record Types Trads
        var optionsCursoTpRegistoTrads = {
            "tableId": 'CursoTpRegistoTrads',
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
                CursoTpRegisto: {
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
                        return CursoTpRegistoTrads.crudButtons(true, true, true);
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
        CursoTpRegistoTrads = new QuadTable();
        CursoTpRegistoTrads.initTable($.extend({}, datatable_instance_defaults, optionsCursoTpRegistoTrads));
        //End Training Record Types Trads        
        
    });
</script>
