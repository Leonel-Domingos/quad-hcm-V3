<?php
    require_once '../init.php';
?>
<style>
    #demo_panel-tabs li, #demo_panel-tabs li > a {
        display:inline;
    } 
</style>
<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-end">
                <div class="panel-toolbar pr-3 align-self-end tabs__">
                    <ul id="demo_panel-tabs" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#Tab1" role="tab" aria-selected="true"><?php echo $ui_doc_types; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab2" role="tab" aria-selected="true"><?php echo $ui_delegations; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab3" role="tab" aria-selected="true"><?php echo $ui_temporary_work_agencies; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab4" role="tab" aria-selected="true"><?php echo $ui_education_institutions; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab5" role="tab" aria-selected="true"><?php echo $ui_study_areas; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab6" role="tab" aria-selected="true"><?php echo $ui_academic_degrees; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab7" role="tab" aria-selected="true"><?php echo $ui_professional_qualifications_contexts; ?></a>
                        </li>
                    </ul>
                </div>
            </div>   
            
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="tab-content">
                        <!-- TAB #1 -->
                        <div class="tab-pane fade active show" id="Tab1" role="tabpanel">
                            <a id="TP_DOCS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="TP_DOCS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-11" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                            <h2><?php echo $ui_translate; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="TP_DOCS_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="TP_DOCS_TRADS" class="table table-bordered table-hover table-striped w-100"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #1 -->

                         <!-- TAB #2 -->
                        <div class="tab-pane fade" id="Tab2" role="tabpanel">
                            <a id="delegations_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="delegations" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-21" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                            <h2><?php echo $ui_translate; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="DelegationTrads_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="DelegationTrads" class="table table-bordered table-hover table-striped w-100"></table>
                                            </div>
                                        </div>
                                    </div>                            
                                </div>                            
                            </div>                            
                        </div>
                         <!-- END TAB #2 -->
                        
                         <!-- TAB #3 -->
                        <div class="tab-pane fade" id="Tab3" role="tabpanel">
                            <a id="RH_EMP_TRAB_TEMP_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="RH_EMP_TRAB_TEMP" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                        </div>
                         <!-- END TAB #3 -->

                         <!-- TAB #4 -->
                        <div class="tab-pane fade" id="Tab4" role="tabpanel">
                            <a id="RH_INSTITUICOES_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="RH_INSTITUICOES" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-41" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                            <h2><?php echo $ui_translate; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="RH_INSTITUICOES_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="RH_INSTITUICOES_TRADS" class="table table-bordered table-hover table-striped w-100"></table>
                                            </div>
                                        </div>
                                    </div>                            
                                </div>                            
                            </div>                            
                        </div>
                         <!-- END TAB #4 -->

                         <!-- TAB #5 -->
                        <div class="tab-pane fade" id="Tab5" role="tabpanel">
                            <a id="RH_AREA_ESTUDO_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="RH_AREA_ESTUDO" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-51" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                            <h2><?php echo $ui_translate; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="RH_AREA_ESTUDO_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="RH_AREA_ESTUDO_TRADS" class="table table-bordered table-hover table-striped w-100"></table>
                                            </div>
                                        </div>
                                    </div>                            
                                </div>                            
                            </div>                            
                        </div>
                         <!-- END TAB #5 -->

                         <!-- TAB #6 -->
                        <div class="tab-pane fade" id="Tab6" role="tabpanel">
                            <a id="RH_GRAU_ACADEMICO_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="RH_GRAU_ACADEMICO" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-61" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                            <h2><?php echo $ui_translate; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="RH_GRAU_ACADEMICO_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="RH_GRAU_ACADEMICO_TRADS" class="table table-bordered table-hover table-striped w-100"></table>
                                            </div>
                                        </div>
                                    </div>                            
                                </div>                            
                            </div>                            
                        </div>
                         <!-- END TAB #6 -->

                         <!-- TAB #7 -->
                        <div class="tab-pane fade" id="Tab7" role="tabpanel">
                            <a id="RH_DEF_HAB_PROFISSIONAIS_CONTEXTO_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="RH_DEF_HAB_PROFISSIONAIS_CONTEXTO" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-71" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                            <h2><?php echo $ui_translate; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="RH_DEF_HAB_PROFISSIONAIS_CONTEXTO_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="RH_DEF_HAB_PROFISSIONAIS_CONTEXTO_TRADS" class="table table-bordered table-hover table-striped w-100"></table>
                                            </div>
                                        </div>
                                    </div>                            
                                </div>                            
                            </div>                            
                        </div>
                         <!-- END TAB #7 -->
                    </div>                    
                </div>                    

            </div> 
        </div>
    </div>
</div>

<script>
    pageSetUp();

    $(document).ready(function () {
        
        //Document Types : TP_DOCS
        var optionsTP_DOCS = {
            "tableId": 'TP_DOCS',
            "table": "CG_REF_CODES",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_doc_type; ?>",            
            "pk": {
                "primary": {
                    "RV_DOMAIN": {"type": "varchar"},
                    "RV_LOW_VALUE": {"type": "varchar"}
                }
            },
            "detailsObjects": ['TP_DOCS_TRADS'],
            "initialWhereClause": "RV_DOMAIN = 'DG_DOCUMENTOS.TP_DOCUMENTO' ",
            "order_by": "RV_LOW_VALUE",
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
                    "title": "<?php echo mb_strtoupper($ui_domain, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_domain; ?>", //Editor
                    "data": 'RV_DOMAIN',
                    "name": 'RV_DOMAIN',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                    "def": "DG_DOCUMENTOS.TP_DOCUMENTO",
                    "className": "right visibleColumn",
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
                    "responsivePriority": 5,                    
                    "title": "<?php echo mb_strtoupper($ui_order_nr, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_order_nr; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_ad_sources_level; ?>",
                    "data": 'RV_HIGH_VALUE',
                    "name": 'RV_HIGH_VALUE',
                    "className": "visibleColumn right",
                    "attr": {
                            "class": "form-control toRight",
                            "style": "width: 30%;"
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
                        return TP_DOCS.crudButtons(true, true, true);
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
                    }
                }
            },
        };
        TP_DOCS = new QuadTable();
        TP_DOCS.initTable($.extend({}, datatable_instance_defaults, optionsTP_DOCS));        
        //END Document Types

        //Document Types Trads 
        var optionsTP_DOCS_TRADS = {
            "tableId": 'TP_DOCS_TRADS',
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
                "TP_DOCS": {
                    "RV_DOMAIN": "RV_DOMAIN",
                    "RV_LOW_VALUE": "RV_LOW_VALUE"
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
                        //"disabled": true, //Permite inibir o campo no Editor
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
                        return TP_DOCS_TRADS.crudButtons(true, true, true);
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
        TP_DOCS_TRADS = new QuadTable();
        TP_DOCS_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsTP_DOCS_TRADS));     
        //END Document Types Trads

        //Delegations
        var optionsDelegations = {
            "tableId": 'delegations',
            "export": false,
            "table": "CG_REF_CODES",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_delegation; ?>",            
            "pk": {
                "primary": {
                    "RV_DOMAIN": {"type": "varchar"},
                    "RV_LOW_VALUE": {"type": "varchar"}
                }
            },
            "detailsObjects": ['DelegationTrads'],
            "initialWhereClause": "RV_DOMAIN = 'DELEG_AUTO_PREV' ",
            "order_by": "RV_LOW_VALUE",
            "scrollY": "100", 
            "recordBundle": 1,
            "pageLenght": 1, 
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "className": "control toBottom toCenter",
                    "width": "1%",
                    "defaultContent": '' 
                }, {
                    "title": "<?php echo mb_strtoupper($ui_domain, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_domain; ?>", //Editor
                    "data": 'RV_DOMAIN',
                    "name": 'RV_DOMAIN',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                    "def": "DELEG_AUTO_PREV",
                    "className": "right visibleColumn",
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_previous_authorizarion, 'UTF-8'); ?>", //Datatables 
                    "label": "<?php echo $ui_previous_authorizarion; ?>", //Editor
                    "data": 'RV_MEANING',
                    "name": 'RV_MEANING',
                    "className": "visibleColumn",
                    "type": "hidden",
                    "attr": {
                        "name": "RV_MEANING",
                        "disabled": true
                    } 
                }, {
                    "responsivePriority": 3,                    
                    "title": "<?php echo mb_strtoupper($ui_decision, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_decision; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_requires_previous_authorizarion; ?>",
                    "data": 'RV_LOW_VALUE',
                    "name": 'RV_LOW_VALUE',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',
                        "class": "form-control",
                        "name": 'RV_LOW_VALUE',
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
                        return delegations.crudButtons(false, true, false);
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
                    }
                }
            },
        };
        delegations = new QuadTable();
        delegations.initTable($.extend({}, datatable_instance_defaults, optionsDelegations));
        //END Delegations
        
        //Delegations Trads 
        var optionsDelegationTrads = {
            "tableId": 'DelegationTrads',
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
                delegations: {
                    "RV_DOMAIN": "RV_DOMAIN",
                    "RV_LOW_VALUE": "RV_LOW_VALUE"
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
                        //"disabled": true, //Permite inibir o campo no Editor
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
                        return DelegationTrads.crudButtons(true, true, true);
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
        DelegationTrads = new QuadTable();
        DelegationTrads.initTable($.extend({}, datatable_instance_defaults, optionsDelegationTrads));     
        //END Delegations Trads
        
        //Temporary work agencies
        var optionsRH_EMP_TRAB_TEMP = {
            "tableId": 'RH_EMP_TRAB_TEMP',
            "table": "CG_REF_CODES",
            "pk": {
                "primary": {
                    "RV_DOMAIN": {"type": "varchar"},
                    "RV_LOW_VALUE": {"type": "varchar"}
                }
            },
            "initialWhereClause": "RV_DOMAIN = 'RH_EMP_TRAB_TEMP' ",
            "order_by": "RV_LOW_VALUE",
            "scrollY": "507", 
            "recordBundle": 14,
            "pageLenght": 14,  
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "className": "control toBottom toCenter",
                    "width": "1%",
                    "defaultContent": '' 
                }, {
                    "title": "<?php echo mb_strtoupper($ui_domain, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_domain; ?>", //Editor
                    "data": 'RV_DOMAIN',
                    "name": 'RV_DOMAIN',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                    "def": "RH_EMP_TRAB_TEMP",
                    "className": "right visibleColumn",
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
                    "responsivePriority": 5,                    
                    "title": "<?php echo mb_strtoupper($ui_order_nr, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_order_nr; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_ad_sources_level; ?>",
                    "data": 'RV_HIGH_VALUE',
                    "name": 'RV_HIGH_VALUE',
                    "className": "visibleColumn right",
                    "attr": {
                            "class": "form-control toRight",
                            "style": "width: 30%;"
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
                        return delegations.crudButtons(false, true, false);
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
                    }
                }
            },
        };
        RH_EMP_TRAB_TEMP = new QuadTable();
        RH_EMP_TRAB_TEMP.initTable($.extend({}, datatable_instance_defaults, optionsRH_EMP_TRAB_TEMP));
        //END Temporary work agencies
        
        //Education Institutions
        var optionsRH_INSTITUICOES = {
            "tableId": 'RH_INSTITUICOES',
            "table": "CG_REF_CODES",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_education_institution; ?>",            
            "pk": {
                "primary": {
                    "RV_DOMAIN": {"type": "varchar"},
                    "RV_LOW_VALUE": {"type": "varchar"}
                }
            },
            "detailsObjects": ['RH_INSTITUICOES_TRADS'],
            "initialWhereClause": "RV_DOMAIN = 'RH_INSTITUICOES' ",
            "order_by": "RV_LOW_VALUE",
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
                    "title": "<?php echo mb_strtoupper($ui_domain, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_domain; ?>", //Editor
                    "data": 'RV_DOMAIN',
                    "name": 'RV_DOMAIN',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                    "def": "RH_INSTITUICOES",
                    "className": "right visibleColumn",
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
                    "responsivePriority": 5,                    
                    "title": "<?php echo mb_strtoupper($ui_order_nr, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_order_nr; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_ad_sources_level; ?>",
                    "data": 'RV_HIGH_VALUE',
                    "name": 'RV_HIGH_VALUE',
                    "className": "visibleColumn right",
                    "attr": {
                            "class": "form-control toRight",
                            "style": "width: 30%;"
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
                        return RH_INSTITUICOES.crudButtons(false, true, false);
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
                    }
                }
            },
        };
        RH_INSTITUICOES = new QuadTable();
        RH_INSTITUICOES.initTable($.extend({}, datatable_instance_defaults, optionsRH_INSTITUICOES));
        //END IEducation Institutions
        
        //Education Institutions Trads 
        var optionsRH_INSTITUICOES_TRADS = {
            "tableId": 'RH_INSTITUICOES_TRADS',
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
                "RH_INSTITUICOES": {
                    "RV_DOMAIN": "RV_DOMAIN",
                    "RV_LOW_VALUE": "RV_LOW_VALUE"
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
                        //"disabled": true, //Permite inibir o campo no Editor
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
                        return RH_INSTITUICOES_TRADS.crudButtons(true, true, true);
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
        RH_INSTITUICOES_TRADS = new QuadTable();
        RH_INSTITUICOES_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsRH_INSTITUICOES_TRADS));     
        //END IEducation Institutions Trads                
        
        //Study Areas
        var optionsRH_AREA_ESTUDO = {
            "tableId": 'RH_AREA_ESTUDO',
            "export": false,
            "table": "CG_REF_CODES",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_study_area; ?>",            
            "pk": {
                "primary": {
                    "RV_DOMAIN": {"type": "varchar"},
                    "RV_LOW_VALUE": {"type": "varchar"}
                }
            },
            "detailsObjects": ['RH_AREA_ESTUDO_TRADS'],
            "initialWhereClause": "RV_DOMAIN = 'RH_AREA_ESTUDO' ",
            "order_by": "RV_LOW_VALUE",
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
                    "title": "<?php echo mb_strtoupper($ui_domain, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_domain; ?>", //Editor
                    "data": 'RV_DOMAIN',
                    "name": 'RV_DOMAIN',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                    "def": "RH_AREA_ESTUDO",
                    "className": "right visibleColumn",
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
                    "responsivePriority": 5,                    
                    "title": "<?php echo mb_strtoupper($ui_order_nr, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_order_nr; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_ad_sources_level; ?>",
                    "data": 'RV_HIGH_VALUE',
                    "name": 'RV_HIGH_VALUE',
                    "className": "visibleColumn right",
                    "attr": {
                            "class": "form-control toRight",
                            "style": "width: 30%;"
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
                        return RH_AREA_ESTUDO.crudButtons(false, true, false);
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
                    }
                }
            },
        };
        RH_AREA_ESTUDO = new QuadTable();
        RH_AREA_ESTUDO.initTable($.extend({}, datatable_instance_defaults, optionsRH_AREA_ESTUDO));
        //END Study Areas
        
        //Study Areas Trads 
        var optionsRH_AREA_ESTUDO_TRADS = {
            "tableId": 'RH_AREA_ESTUDO_TRADS',
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
                "RH_AREA_ESTUDO": {
                    "RV_DOMAIN": "RV_DOMAIN",
                    "RV_LOW_VALUE": "RV_LOW_VALUE"
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
                        //"disabled": true, //Permite inibir o campo no Editor
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
                        return RH_AREA_ESTUDO_TRADS.crudButtons(true, true, true);
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
        RH_AREA_ESTUDO_TRADS = new QuadTable();
        RH_AREA_ESTUDO_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsRH_AREA_ESTUDO_TRADS));     
        //END Study Areas Trads

        //Academic Degrees
        var optionsRH_GRAU_ACADEMICO = {
            "tableId": 'RH_GRAU_ACADEMICO',
            "export": false,
            "table": "CG_REF_CODES",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_academic_degree; ?>",            
            "pk": {
                "primary": {
                    "RV_DOMAIN": {"type": "varchar"},
                    "RV_LOW_VALUE": {"type": "varchar"}
                }
            },
            "detailsObjects": ['RH_GRAU_ACADEMICO_TRADS'],
            "initialWhereClause": "RV_DOMAIN = 'RH_GRAU_ACADEMICO' ",
            "order_by": "RV_LOW_VALUE",
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
                    "title": "<?php echo mb_strtoupper($ui_domain, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_domain; ?>", //Editor
                    "data": 'RV_DOMAIN',
                    "name": 'RV_DOMAIN',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                    "def": "RH_GRAU_ACADEMICO",
                    "className": "right visibleColumn",
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
                    "responsivePriority": 5,                    
                    "title": "<?php echo mb_strtoupper($ui_order_nr, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_order_nr; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_ad_sources_level; ?>",
                    "data": 'RV_HIGH_VALUE',
                    "name": 'RV_HIGH_VALUE',
                    "className": "visibleColumn right",
                    "attr": {
                            "class": "form-control toRight",
                            "style": "width: 30%;"
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
                        return RH_GRAU_ACADEMICO.crudButtons(false, true, false);
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
                    }
                }
            },
        };
        RH_GRAU_ACADEMICO = new QuadTable();
        RH_GRAU_ACADEMICO.initTable($.extend({}, datatable_instance_defaults, optionsRH_GRAU_ACADEMICO));
        //END Academic Degrees
        
        //Academic Degrees Trads 
        var optionsRH_GRAU_ACADEMICO_TRADS = {
            "tableId": 'RH_GRAU_ACADEMICO_TRADS',
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
                "RH_GRAU_ACADEMICO": {
                    "RV_DOMAIN": "RV_DOMAIN",
                    "RV_LOW_VALUE": "RV_LOW_VALUE"
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
                        //"disabled": true, //Permite inibir o campo no Editor
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
                        return RH_GRAU_ACADEMICO_TRADS.crudButtons(true, true, true);
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
        RH_GRAU_ACADEMICO_TRADS = new QuadTable();
        RH_GRAU_ACADEMICO_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsRH_GRAU_ACADEMICO_TRADS));     
        //END Academic Degrees Trads
        
        //
        //Professional Qualifications Contexts
        var optionsRH_DEF_HAB_PROFISSIONAIS_CONTEXTO = {
            "tableId": 'RH_DEF_HAB_PROFISSIONAIS_CONTEXTO',
            "export": false,
            "table": "CG_REF_CODES",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_context; ?>",            
            "pk": {
                "primary": {
                    "RV_DOMAIN": {"type": "varchar"},
                    "RV_LOW_VALUE": {"type": "varchar"}
                }
            },
            "detailsObjects": ['RH_DEF_HAB_PROFISSIONAIS_CONTEXTO_TRADS'],
            "initialWhereClause": "RV_DOMAIN = 'RH_DEF_HAB_PROFISSIONAIS.CONTEXTO' ",
            "order_by": "RV_LOW_VALUE",
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
                    "title": "<?php echo mb_strtoupper($ui_domain, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_domain; ?>", //Editor
                    "data": 'RV_DOMAIN',
                    "name": 'RV_DOMAIN',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                    "def": "RH_DEF_HAB_PROFISSIONAIS.CONTEXTO",
                    "className": "right visibleColumn",
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
                    "responsivePriority": 5,                    
                    "title": "<?php echo mb_strtoupper($ui_order_nr, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_order_nr; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_ad_sources_level; ?>",
                    "data": 'RV_HIGH_VALUE',
                    "name": 'RV_HIGH_VALUE',
                    "className": "visibleColumn right",
                    "attr": {
                            "class": "form-control toRight",
                            "style": "width: 30%;"
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
                        return RH_DEF_HAB_PROFISSIONAIS_CONTEXTO.crudButtons(false, true, false);
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
                    }
                }
            },
        };
        RH_DEF_HAB_PROFISSIONAIS_CONTEXTO = new QuadTable();
        RH_DEF_HAB_PROFISSIONAIS_CONTEXTO.initTable($.extend({}, datatable_instance_defaults, optionsRH_DEF_HAB_PROFISSIONAIS_CONTEXTO));
        //END Professional Qualifications Contexts
        
        //Professional Qualifications Contexts Trads 
        var optionsRH_DEF_HAB_PROFISSIONAIS_CONTEXTO_TRADS = {
            "tableId": 'RH_DEF_HAB_PROFISSIONAIS_CONTEXTO_TRADS',
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
                "RH_DEF_HAB_PROFISSIONAIS_CONTEXTO": {
                    "RV_DOMAIN": "RV_DOMAIN",
                    "RV_LOW_VALUE": "RV_LOW_VALUE"
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
                        //"disabled": true, //Permite inibir o campo no Editor
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
                        return RH_DEF_HAB_PROFISSIONAIS_CONTEXTO_TRADS.crudButtons(true, true, true);
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
        RH_DEF_HAB_PROFISSIONAIS_CONTEXTO_TRADS = new QuadTable();
        RH_DEF_HAB_PROFISSIONAIS_CONTEXTO_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsRH_DEF_HAB_PROFISSIONAIS_CONTEXTO_TRADS));     
        //END Professional Qualifications Contexts Trads

    });
</script>
