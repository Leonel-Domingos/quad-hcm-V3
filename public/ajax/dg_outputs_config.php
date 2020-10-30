<?php
    require_once '../init.php';
?>
<div class="row">
    <div class="col-xl-12">

            <div class="row mt-4">
                <div class="col-xl-12">
                    <div id="panel-51" class="panel">
                        <div class="panel-hdr">
                            <span class="widget-icon trads"> <i class="fal fa-clone"></i></span>&nbsp;
                            <h2><?php echo $ui_outputs; ?></h2>
                        </div>
                        <div class="panel-container show">
                            <div class="panel-content">                                            
                                <a id="DG_DEF_OUTPUTS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                <table id="DG_DEF_OUTPUTS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                                        
            <div id="panel-1" class="panel">
                <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-end">
                    <div class="panel-toolbar pr-3 align-self-end tabs__">
                        <ul id="demo_panel-tabs" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#Tab1" role="tab" aria-selected="true"><?php echo $ui_params; ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#Tab2" role="tab" aria-selected="true"><?php echo $ui_images; ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#Tab3" role="tab" aria-selected="true"><?php echo $ui_translate; ?></a>
                            </li>
                        </ul>
                    </div>
                </div>   

                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="tab-content">

                             <!-- TAB #1 -->
                            <div class="tab-pane fade active show" id="Tab1" role="tabpanel">
                                <div class="row mt-4">
                                    <div class="col-xl-12">
                                        <div id="panel-11" class="panel">
                                            <div class="panel-hdr">
                                                <span class="widget-icon trads"> <i class="fal fa-clone"></i></span>&nbsp;
                                                <h2><?php echo $ui_groups; ?></h2>
                                            </div>
                                            <div class="panel-container show">
                                                <div class="panel-content">                                            
                                                    <a id="DG_DEF_GRUPOS_OUTPUT_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                    <table id="DG_DEF_GRUPOS_OUTPUT" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-xl-12">
                                        <div id="panel-12" class="panel">
                                            <div class="panel-hdr">
                                                <span class="widget-icon trads"> <i class="fal fa-clone"></i></span>&nbsp;
                                                <h2><?php echo $ui_details; ?></h2>
                                            </div>
                                            <div class="panel-container show">
                                                <div class="panel-content">                                            
                                                    <a id="DG_DET_GRUPOS_OUTPUT_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                    <table id="DG_DET_GRUPOS_OUTPUT" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <!-- END TAB #1 -->

                             <!-- TAB #2 -->
                            <div class="tab-pane fade" id="Tab2" role="tabpanel">
                                <p>Brevemente...</p>
                            </div>
                             <!-- END TAB #2 -->
                             
                             <!-- TAB #3 -->
                            <div class="tab-pane fade" id="Tab3" role="tabpanel">
                                <a id="DG_DEF_OUTPUT_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                <table id="DG_DEF_OUTPUT_TRADS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
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
        var perfil_ = "<?php echo @$_SESSION['perfil'];?>";
        var rhid_ = "<?php echo @$_SESSION['rhid'];?>";

        //Outputs
        var optionsDG_DEF_OUTPUTS = {
            "tableId": "DG_DEF_OUTPUTS",
            "table": "DG_DEF_OUTPUTS",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_output; ?>",
            "pk": {
                "primary": {
                    "CD_OUTPUT": {"type": "varchar"}
                }
            },
            "crudOnMasterInactive": {
                "condition": "data.ACTIVO != 'S' ",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },        
            "initialWhereClause": "", //SÓ ESTADOS COM FICHAS DE AVALIAÇÃO!!!
            "detailsObjects": ['DG_DEF_OUTPUT_TRADS', 'DG_DEF_GRUPOS_OUTPUT'],
            "order_by": "CD_OUTPUT",
            "recordBundle": 6,
            "pageLenght": 6,
            "scrollY": "195",
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "className": "control toBottom toCenter",
                    "width": "1%",
                    "defaultContent": ''
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_code; ?>",
                    "data": 'CD_OUTPUT',
                    "name": 'CD_OUTPUT',
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_designation; ?>",
                    "data": 'DSP_OUTPUT',
                    "name": 'DSP_OUTPUT',
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_interface, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_interface; ?>",
                    "data": 'NOME_INTERFACE',
                    "name": 'NOME_INTERFACE',
                    "className": "visibleColumn",         
                }, {
                    "responsivePriority": 5,
                    "title": "<?php echo mb_strtoupper($ui_type, 'UTF-8'); ?>" , //Datatables :: Original
                    "label": "<?php echo $ui_type; ?>", //Editor
                    "data": 'TIPO',
                    "name": 'TIPO',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_DEF_OUTPUTS.TIPO',
                        "class": "form-control"
                    }
                }, {
                    "responsivePriority": 6,
                    "exclude": true,
                    "title": "<?php echo mb_strtoupper($ui_critical, 'UTF-8'); ?>" , //Datatables :: Original
                    "label": "<?php echo $ui_critical; ?>", //Editor
                    "data": 'CRITICO',
                    "name": 'CRITICO',
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
                    "title": "<?php echo mb_strtoupper($ui_inhibitor_calculation, 'UTF-8'); ?>" , //Datatables :: Original
                    "label": "<?php echo $ui_inhibitor_calculation; ?>", //Editor
                    "data": 'INIBIDOR_CALCULO',
                    "name": 'INIBIDOR_CALCULO',
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
                    "title": "<?php echo mb_strtoupper($ui_active, 'UTF-8'); ?>" , //Datatables :: Original
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
                            return val == null ? null : o['RV_ABBREVIATION'];
                        }
                        return val;
                    }  
                }, {
                    "title": "<?php echo mb_strtoupper($ui_programmatic_reference, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_programmatic_reference; ?>", //Editor
                    "data": 'PRG_NOME',
                    "name": 'PRG_NOME',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 335px",
                    }                
                }, {
                    "title": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_back_office, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_back_office, 'UTF-8'); ?>" + "</span>", //Editor
                    "data": '',
                    "name": 'TIT_BO',
                    "type": "readonly",
                    "className": "none",
                    "defaultContent": "", //Must be used on STATIC columns content. On this case classes make there way...
                    "attr": {
                        "style": "display: none;"
                    }              
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_location, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_location; ?>"+ "</span>", //Editor
                    "data": 'LOC_BACKOFFICE',
                    "name": 'LOC_BACKOFFICE',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 335px",
                    }                
                    
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_mask, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_mask; ?>"+ "</span>", //Editor
                    "data": 'MASCARA_FX',
                    "name": 'MASCARA_FX',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 335px",
                    }
                }, {
                    "title": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_portal, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_portal, 'UTF-8'); ?>" + "</span>", //Editor
                    "data": '',
                    "name": 'TIT_PORTAL',
                    "type": "readonly",
                    "className": "none",
                    "defaultContent": "", //Must be used on STATIC columns content. On this case classes make there way...
                    "attr": {
                        "style": "display: none;"
                    } 
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_output, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_output; ?>"+ "</span>", //Editor
                    "data": 'ID_OUTPUT_PORTAL',
                    "name": 'ID_OUTPUT_PORTAL',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 335px",
                    }                
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_location, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_location; ?>"+ "</span>", //Editor
                    "data": 'LOC_PORTAL',
                    "name": 'LOC_PORTAL',
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
                        return DG_DEF_OUTPUTS.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "CD_OUTPUT": {
                        required: true,
                        maxlength: 5
                    },
                    "DSP_OUTPUT": {
                        required: true,
                        maxlength: 40
                    },
                    "NOME_INTERFACE": {
                        required: false,
                        maxlength: 20
                    },
                    "PRG_NOME": {
                        maxlength: 100
                    },
                    "CRITICO": {
                        required: true
                    },
                    "ACTIVO": {
                        required: true
                    },
                    "INIBIDOR_CALCULO": {
                        required: true
                    },
                    "ID_OUTPUT_PORTAL": {
                        maxlength: 240
                    },
                    "LOC_PORTAL": {
                        maxlength: 240
                    },
                    "MASCARA_FX": {
                        maxlength: 240
                    },
                    "LOC_BACKOFFICE": {
                        maxlength: 200
                    },
                }
            }
        };
        DG_DEF_OUTPUTS = new QuadTable();
        DG_DEF_OUTPUTS.initTable($.extend({}, datatable_instance_defaults, optionsDG_DEF_OUTPUTS));
        //Outputs

        ////Outputs Trads 
        var optionsDG_DEF_OUTPUT_TRADS = {
            "tableId": 'DG_DEF_OUTPUT_TRADS',
            "table": "DG_DEF_OUTPUT_TRADS",
            "order": false,
            "pk":{
                "primary": {
                    "CD_OUTPUT": {"type": "varchar"},
                    "CD_LINGUA": {"type": "number"},
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "DG_DEF_OUTPUTS": {
                    "CD_OUTPUT": "CD_OUTPUT"
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
                    "data": 'CD_OUTPUT',
                    "name": 'CD_OUTPUT',
                    "type": "hidden", //Editor
                    "visible": false //DataTables                    
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
                    "attr": {
                        "class": "datepicker"
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
                    "attr": {
                        "class": "datepicker"
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
                        return DG_DEF_OUTPUT_TRADS.crudButtons(true, true, true);
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
        DG_DEF_OUTPUT_TRADS = new QuadTable();
        DG_DEF_OUTPUT_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsDG_DEF_OUTPUT_TRADS));     
        //END //Outputs Trads        
        
        //Grupos
        var optionDG_DEF_GRUPOS_OUTPUT = {
            "tableId": "DG_DEF_GRUPOS_OUTPUT",
            "table": "DG_DEF_GRUPOS_OUTPUT",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_group; ?>",
            "pk": {
                "primary": {
                    "CD_OUTPUT": {"type": "varchar"},
                    "CD_GRUPO": {"type": "varchar"}
                }
            },
            "dependsOn": {
                "DG_DEF_OUTPUTS": { //External object key mapping( object key : external key)                    
                    "CD_OUTPUT" : "CD_OUTPUT"
                }
            },
            "crudOnMasterInactive": {
                "condition": "data.ACTIVO != 'S' ",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            }, 
            //"initialWhereClause": '',   
            "detailsObjects": ['DG_DET_GRUPOS_OUTPUT'],
            "order_by": "CD_GRUPO",
            "recordBundle": 6,
            "pageLenght": 6,
            "scrollY": "175",
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
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_OUTPUT',
                    "name": 'CD_OUTPUT',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'CD_GRUPO',
                    "name": 'CD_GRUPO',
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_GRUPO',
                    "name": 'DSP_GRUPO',
                    "className": "visibleColumn"
                }, {
                    "responsivePriority": 4,
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
                            return val == null ? null : o['RV_ABBREVIATION'];
                        }
                        return val;
                    }    
                }, {
                    "title": "<?php echo mb_strtoupper($ui_reference, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_reference; ?>", //Editor
                    "data": 'REFERENCIA',
                    "name": 'REFERENCIA',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 335px",
                    }          
                }, {
                    "title": "<?php echo mb_strtoupper($ui_help, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_help; ?>", //Editor
                    "data": 'AJUDA',
                    "name": 'AJUDA',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 335px",
                        "class": "form-control defaultWidth",
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
                        return DG_DEF_GRUPOS_OUTPUT.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "CD_GRUPO": {
                        required: true,
                        maxlength: 6
                    },
                    "DSP_GRUPO": {
                        required: true,
                        maxlength: 40
                    },
                    "ACTIVO": {
                        required: true
                    },
                    "REFERENCIA": {
                        maxlength: 1000
                    },
                    "AJUDA": {
                        maxlength: 1000
                    },
                }
            }
        };
        DG_DEF_GRUPOS_OUTPUT = new QuadTable();
        DG_DEF_GRUPOS_OUTPUT.initTable($.extend({}, datatable_instance_defaults, optionDG_DEF_GRUPOS_OUTPUT));   
        //END Grupos
        
        //Detalhes
        var optionDG_DET_GRUPOS_OUTPUT = {
            "tableId": "DG_DET_GRUPOS_OUTPUT",
            "table": "DG_DET_GRUPOS_OUTPUT",
            "pk": {
                "primary": {
                    "CD_OUTPUT": {"type": "varchar"},
                    "CD_GRUPO": {"type": "varchar"},
                    "SEQ": {"type": "number"}
                }
            },
            "dependsOn": {
                "DG_DEF_GRUPOS_OUTPUT": { //External object key mapping( object key : external key)                    
                    "CD_OUTPUT" : "CD_OUTPUT",
                    "CD_GRUPO": "CD_GRUPO"
                }
            },
            //"initialWhereClause": '',             
            "order_by": "CD_GRUPO",
            "recordBundle": 6,
            "pageLenght": 6,
            "scrollY": "175",
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
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_OUTPUT',
                    "name": 'CD_OUTPUT',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables   
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_GRUPO',
                    "name": 'CD_GRUPO',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "",
                    "label": "",
                    "data": 'SEQ',
                    "name": 'SEQ',
                    "datatype": 'sequence',
                    "type": "hidden",
                    "visible": false
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
                    "title": "<?php echo mb_strtoupper($ui_payroll_item, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_payroll_item; ?>",
                    "data": 'DSP_RUBRICA',
                    "name": 'DSP_RUBRICA',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, 
                    "attr": {
                        "dependent-group": "RUBRICAS",
                        "dependent-level": 1,
                        "data-db-name": "A.CD_RUBRICA",
                        "decodeFromTable": "RH_DEF_RUBRICAS A",
                        "desigColumn": "CONCAT(CONCAT(A.CD_RUBRICA,'-'),A.DSP_RUBRICA)", 
                        "orderBy": "A.CD_RUBRICA", 
                        "class": "form-control complexList chosen",
                        "whereClause": "",
                        "filter": {
                            "create": " AND A.ACTIVO = 'S'", //On-New-Record
                            "edit": " AND A.ACTIVO = 'S'", //On-Edit-Record                            
                        }
                    } 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_ED',
                    "name": 'CD_ED',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 3,
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_discount_entity, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_discount_entity; ?>",
                    "data": 'DSP_ED',
                    "name": 'DSP_ED',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "ENT_DESCT",
                        "dependent-level": 1,
                        "data-db-name": "A.CD_ED",
                        "decodeFromTable": "RH_DEF_ENTIDADES_DESCONTO a",  //TO CHANGE ON QUAD-HCM
                        "desigColumn": "CONCAT(CONCAT(A.CD_ED,'-'),A.DSP_ED)",
                        "orderBy": "A.CD_ED",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.ACTIVO = 'S' ", //On-New-Record
                            "edit": " AND A.ACTIVO = 'S' ", //On-Edit-Record
                        }
                    }                   
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_SITUACAO',
                    "name": 'CD_SITUACAO',
                    "type": "hidden",
                    "visible": false,
                    "className": "",
                }, {
                    "responsivePriority": 4,
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_situation,'UTF-8'); ?>",
                    "label": "<?php echo $ui_situation; ?>",
                    "data": 'DSP_SITUACAO',
                    "name": 'DSP_SITUACAO',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true,
                    "attr": {
                        "dependent-group": "SITUACOES",
                        "dependent-level": 1,
                        "data-db-name": "A.CD_SITUACAO",
                        "decodeFromTable": "RH_DEF_SITUACOES a",
                        "desigColumn": "CONCAT(CONCAT(A.CD_SITUACAO,'-'),A.DSP_SITUACAO)",
                        "orderBy": "A.CD_SITUACAO",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.ACTIVO = 'S'",
                            "edit": " AND A.ACTIVO = 'S'",
                        }
                    }                    
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_GRELHA_SALARIAL',
                    "name": 'CD_GRELHA_SALARIAL',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 5,
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_payroll_grid,'UTF-8'); ?>",
                    "label": "<?php echo $ui_payroll_grid; ?>",
                    "data": 'DSP_GS',
                    "name": 'DSP_GS',
                    "type": "select",
                    "className": "visibleColumn",
                    "renew": true,
                    "attr": {
                        "dependent-group": "GRELHAS",
                        "dependent-level": 1,
                        "data-db-name": "A.CD_GRELHA_SALARIAL",
                        "decodeFromTable": "RH_DEF_GRELHAS_SALARIAIS a",
                        "desigColumn": "CONCAT(CONCAT(A.CD_GRELHA_SALARIAL,'-'),A.DSP_GRELHA_SALARIAL)",
                        "otherValues": "A.TP_GRELHA_SALARIAL",
                        "orderBy": "A.CD_GRELHA_SALARIAL",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.ACTIVO = 'S'",
                            "edit": " AND A.ACTIVO = 'S'",
                        }
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_reference, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_reference; ?>", //Editor
                    "data": 'REFERENCIA',
                    "name": 'REFERENCIA',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 335px",
                    }          
                }, {
                    "title": "<?php echo mb_strtoupper($ui_help, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_help; ?>", //Editor
                    "data": 'AJUDA',
                    "name": 'AJUDA',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 335px",
                        "class": "form-control defaultWidth",
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
                        return DG_DET_GRUPOS_OUTPUT.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {                    
                    "REFERENCIA": {
                        maxlength: 1000
                    },
                    "AJUDA": {
                        maxlength: 1000
                    },
                }
            }
        };
        DG_DET_GRUPOS_OUTPUT = new QuadTable();
        DG_DET_GRUPOS_OUTPUT.initTable($.extend({}, datatable_instance_defaults, optionDG_DET_GRUPOS_OUTPUT));   
        //END Detalhes        
    });
</script>
