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
                            <a class="nav-link active" data-toggle="tab" href="#Tab1" role="tab" aria-selected="true"><?php echo $ui_entity_classes; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab2" role="tab" aria-selected="true"><?php echo $ui_entities_types; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab3" role="tab" aria-selected="true"><?php echo $ui_situations; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab4" role="tab" aria-selected="true"><?php echo $ui_cadastre; ?></a>
                        </li>
                    </ul>
                </div>
            </div>   
            
            <div class="panel-container show">
                <div class="panel-content">
                    
                    <div class="tab-content">

                         <!-- TAB #1 -->
                        <div class="tab-pane fade active show" id="Tab1" role="tabpanel">
                            <a id="DG_CLASSES_ENTIDADE_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="DG_CLASSES_ENTIDADE" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            
                            <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-start">
                                <div class="panel-toolbar pr-3 align-self-end">
                                    <ul id="panel-tab-1-1" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#Tab11" role="tab" aria-selected="true"><?php echo $ui_translations; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Tab12" role="tab" aria-selected="true"><?php echo $ui_subclasses; ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-container show">
                                <div class="panel-content">
                                    <div class="tab-content">
                                        <div class="tab-pane fade active show" id="Tab11" role="tabpanel">
                                            <a id="DG_CLASSE_ENTIDADE_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="DG_CLASSE_ENTIDADE_TRADS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                        </div>
                                        <div class="tab-pane fade" id="Tab12" role="tabpanel">
                                            <a id="DG_SUB_CLASSES_ENTIDADE_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="DG_SUB_CLASSES_ENTIDADE" class="table table-bordered table-hover table-striped w-100 nowrap"  style=""></table>
                                            <div class="row mt-4">
                                                <div class="col-xl-12">
                                                    <div id="panel-12" class="panel">
                                                        <div class="panel-hdr">
                                                            <span class="widget-icon trads"> <i class="far fa-language"></i></span>&nbsp;
                                                            <h2><?php echo $ui_translate; ?></h2>
                                                        </div>
                                                        <div class="panel-container show">
                                                            <div class="panel-content">                                            
                                                                <a id="DG_SUB_CLASSE_ENTIDADE_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                                <table id="DG_SUB_CLASSE_ENTIDADE_TRADS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
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
                         <!-- END TAB #1 -->
                        
                         <!-- TAB #2 -->
                        <div class="tab-pane fade" id="Tab2" role="tabpanel">
                            <a id="DG_TIPOS_ENTIDADE_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="DG_TIPOS_ENTIDADE" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-21" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                            <h2><?php echo $ui_translate; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="DG_TIPO_ENTIDADE_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="DG_TIPO_ENTIDADE_TRADS" class="table table-bordered table-hover table-striped w-100"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #2 -->

                         <!-- TAB #3 -->
                        <div class="tab-pane fade" id="Tab3" role="tabpanel">
                            <a id="DG_SITUACOES_ENTS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="DG_SITUACOES_ENTS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-31" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                            <h2><?php echo $ui_translate; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <!--
                                                <a id="DG_SITUACOES_ENTS_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="DG_SITUACOES_ENTS_TRADS" class="table table-bordered table-hover table-striped w-100"></table>
                                                -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #2 -->
                        
                         <!-- TAB #4 -->
                        <div class="tab-pane fade" id="Tab4" role="tabpanel">
                            <a id="DG_ENTIDADES_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="DG_ENTIDADES" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            
                            <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-start">
                                <div class="panel-toolbar pr-3 align-self-end">
                                    <ul id="panel-tab-4-1" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#Tab41" role="tab" aria-selected="true"><?php echo $ui_types; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Tab42" role="tab" aria-selected="true"><?php echo $ui_addresses; ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-container show">
                                <div class="panel-content">
                                    <div class="tab-content">
                                        <div class="tab-pane fade active show" id="Tab41" role="tabpanel">
                                            <div class="row mt-4">
                                                <div class="col-xl-12">
                                                    <div id="panel-51" class="panel">
                                                        <div class="panel-hdr">
                                                            <span class="widget-icon trads"> <i class="fal fa-clone"></i></span>&nbsp;
                                                            <h2><?php echo $ui_types; ?></h2>
                                                        </div>
                                                        <div class="panel-container show">
                                                            <div class="panel-content">                                            
                                                                <a id="DG_TIPOS_ENTIDADES_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                                <table id="DG_TIPOS_ENTIDADES" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-4">
                                                <div class="col-xl-12">
                                                    <div id="panel-51" class="panel">
                                                        <div class="panel-hdr">
                                                            <span class="widget-icon trads"> <i class="fal fa-clone"></i></span>&nbsp;
                                                            <h2><?php echo $ui_members; ?></h2>
                                                        </div>
                                                        <div class="panel-container show">
                                                            <div class="panel-content">                                            
                                                                <a id="DG_MEMBRO_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                                <table id="DG_MEMBRO" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-4">
                                                <div class="col-xl-12">
                                                    <div id="panel-51" class="panel">
                                                        <div class="panel-hdr">
                                                            <span class="widget-icon trads"> <i class="fal fa-clone"></i></span>&nbsp;
                                                            <h2><?php echo $ui_documents; ?></h2>
                                                        </div>
                                                        <div class="panel-container show">
                                                            <div class="panel-content">                                            
                                                                <a id="DG_DOCS_MEMBRO_VIEW_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                                <table id="DG_DOCS_MEMBRO_VIEW" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="tab-pane fade" id="Tab42" role="tabpanel">
                                            <a id="DG_MORADAS_ENTS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="DG_MORADAS_ENTS" class="table table-bordered table-hover table-striped w-100 nowrap"  style=""></table>
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
        
        //Classes Entidades
        var optionDG_CLASSES_ENTIDADE = {
            "tableId": "DG_CLASSES_ENTIDADE",
            "table": "DG_CLASSES_ENTIDADE", 
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_class; ?>",
            "pk": {
                "primary": {
                    "ID_CLASSE_ENT": {"type": "number"},
                    "DT_INI_CLASSE_ENT": {"type": "date"}
                }
            },
            "crudOnMasterInactive": {
                "condition": "data.DT_FIM_CLASSE_ENT !== null ",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },                    
            "detailsObjects": ['DG_CLASSE_ENTIDADE_TRADS','DG_SUB_CLASSES_ENTIDADE'],
            "order_by": "ID_CLASSE_ENT",
            "scrollY": "117",
            "recordBundle": 4,
            "pageLenght": 4, 
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
                    "data": 'ID_CLASSE_ENT',
                    "name": 'ID_CLASSE_ENT',
                    "className": "visibleColumn",                   
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_CLASSE_ENT',
                    "name": 'DSP_CLASSE_ENT',
                    "className": "visibleColumn", 
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_CLASSE_ENT',
                    "name": 'DSR_CLASSE_ENT',                    
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 5, 
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_CLASSE_ENT',
                    "name": 'DT_INI_CLASSE_ENT',
                    "datatype": 'date',
                    "def": "1900-01-01",
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }
                }, {
                    "responsivePriority": 6, 
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM_CLASSE_ENT',
                    "name": 'DT_FIM_CLASSE_ENT',
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
                    "responsivePriority": 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        //debugger;
                        return DG_CLASSES_ENTIDADE.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "ID_CLASSE_ENT": {
                        required: true,
                        integer: true,
                        maxlength: 10
                    },
                    "DSP_CLASSE_ENT": {
                        required: true,
                        maxlength: 80,
                    },
                    "DSR_CLASSE_ENT": {
                        required: true,
                        maxlength: 25,
                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                    "DT_INI_CLASSE_ENT": {
                        required: true,
                        dateISO: true,
                    },
                    "DT_FIM_CLASSE_ENT": {
                        dateISO: true,
                        dateEqOrNextThan: "DT_INI_CLASSE_ENT",
                    }
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                    "DT_FIM_CLASSE_ENT": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        DG_CLASSES_ENTIDADE = new QuadTable();
        DG_CLASSES_ENTIDADE.initTable( $.extend({}, datatable_instance_defaults, optionDG_CLASSES_ENTIDADE) );        
        //END Classes Entidades

        //Classes Trads
        var optionsDG_CLASSE_ENTIDADE_TRADS = {
            "tableId": "DG_CLASSE_ENTIDADE_TRADS",
            "table": "DG_CLASSE_ENTIDADE_TRADS",
            "pk": {
                "primary": {
                    "ID_CLASSE_ENT": {"type": "number"},
                    "DT_INI_CLASSE_ENT": {"type": "date"},
                    "CD_LINGUA": {"type": "number"},                    
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "DG_CLASSES_ENTIDADE": {
                    "ID_CLASSE_ENT": "ID_CLASSE_ENT",
                    "DT_INI_CLASSE_ENT" : "DT_INI_CLASSE_ENT"
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
                    "data": 'ID_CLASSE_ENT',
                    "name": 'ID_CLASSE_ENT',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_CLASSE_ENT',
                    "name": 'DT_INI_CLASSE_ENT',  
                    "datatype": "date",
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
                        "style": "max-width: 335px;",
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
                        return DG_CLASSE_ENTIDADE_TRADS.crudButtons(true,true,true);
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
                        maxlength: 240,
                    },
                    "DSR_TRAD": {
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
        DG_CLASSE_ENTIDADE_TRADS = new QuadTable();
        DG_CLASSE_ENTIDADE_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsDG_CLASSE_ENTIDADE_TRADS));
        //END Classes Trads

        //Subclasses Entidades
        var optionDG_SUB_CLASSES_ENTIDADE = {
            "tableId": "DG_SUB_CLASSES_ENTIDADE",
            "table": "DG_SUB_CLASSES_ENTIDADE", 
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_subclass; ?>",
            "pk": {
                "primary": {
                    "ID_CLASSE_ENT": {"type": "number"},
                    "DT_INI_CLASSE_ENT": {"type": "date"},
                    "ID_SUB_CLASSE_ENT": {"type": "number"},
                    "DT_INI_SUB_CLASSE_ENT": {"type": "date"}
                }
            },
            "dependsOn": {
                "DG_CLASSES_ENTIDADE": {
                    "ID_CLASSE_ENT": "ID_CLASSE_ENT",
                    "DT_INI_CLASSE_ENT" : "DT_INI_CLASSE_ENT"
                }
            },
            "crudOnMasterInactive": {
                "condition": "data.DT_FIM_SUB_CLASSE_ENT !== null ",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },                    
            "detailsObjects": ['DG_SUB_CLASSE_ENTIDADE_TRADS'],
            "order_by": "ID_SUB_CLASSE_ENT",
            "scrollY": "117",
            "recordBundle": 4,
            "pageLenght": 4, 
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
                    "data": 'ID_CLASSE_ENT',
                    "name": 'ID_CLASSE_ENT',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_CLASSE_ENT',
                    "name": 'DT_INI_CLASSE_ENT',  
                    "datatype": "date",
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'ID_SUB_CLASSE_ENT',
                    "name": 'ID_SUB_CLASSE_ENT',
                    "className": "visibleColumn",                   
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_SUB_CLASSE_ENT',
                    "name": 'DSP_SUB_CLASSE_ENT',
                    "className": "visibleColumn", 
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_SUB_CLASSE_ENT',
                    "name": 'DSR_SUB_CLASSE_ENT',                    
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 5, 
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_SUB_CLASSE_ENT',
                    "name": 'DT_INI_SUB_CLASSE_ENT',
                    "datatype": 'date',
                    "def": "1900-01-01",
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }
                }, {
                    "responsivePriority": 6, 
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM_SUB_CLASSE_ENT',
                    "name": 'DT_FIM_SUB_CLASSE_ENT',
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
                    "responsivePriority": 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        //debugger;
                        return DG_SUB_CLASSES_ENTIDADE.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "ID_SUB_CLASSE_ENT": {
                        required: true,
                        integer: true,
                        maxlength: 10
                    },
                    "DSP_SUB_CLASSE_ENT": {
                        required: true,
                        maxlength: 80,
                    },
                    "DSR_SUB_CLASSE_ENT": {
                        required: true,
                        maxlength: 25,
                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                    "DT_INI_SUB_CLASSE_ENT": {
                        required: true,
                        dateISO: true,
                    },
                    "DT_FIM_SUB_CLASSE_ENT": {
                        dateISO: true,
                        dateEqOrNextThan: "DT_INI_SUB_CLASSE_ENT",
                    }
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                    "DT_FIM_SUB_CLASSE_ENT": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        DG_SUB_CLASSES_ENTIDADE = new QuadTable();
        DG_SUB_CLASSES_ENTIDADE.initTable( $.extend({}, datatable_instance_defaults, optionDG_SUB_CLASSES_ENTIDADE) );        
        //END Subclasses Entidades        
        
        //Subclasses Trads
        var optionsDG_SUB_CLASSE_ENTIDADE_TRADS = {
            "tableId": "DG_SUB_CLASSE_ENTIDADE_TRADS",
            "table": "DG_SUB_CLASSE_ENTIDADE_TRADS",
            "pk": {
                "primary": {
                    "ID_CLASSE_ENT": {"type": "number"},
                    "DT_INI_CLASSE_ENT": {"type": "date"},
                    "ID_SUB_CLASSE_ENT": {"type": "number"},
                    "DT_INI_SUB_CLASSE_ENT": {"type": "date"},
                    "CD_LINGUA": {"type": "number"},                    
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "DG_SUB_CLASSES_ENTIDADE": {
                    "ID_CLASSE_ENT": "ID_CLASSE_ENT",
                    "DT_INI_CLASSE_ENT" : "DT_INI_CLASSE_ENT",
                    "ID_SUB_CLASSE_ENT": "ID_SUB_CLASSE_ENT",
                    "DT_INI_SUB_CLASSE_ENT" : "DT_INI_SUB_CLASSE_ENT"
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
                    "data": 'ID_CLASSE_ENT',
                    "name": 'ID_CLASSE_ENT',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_CLASSE_ENT',
                    "name": 'DT_INI_CLASSE_ENT',  
                    "datatype": "date",
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_SUB_CLASSE_ENT',
                    "name": 'ID_SUB_CLASSE_ENT',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_SUB_CLASSE_ENT',
                    "name": 'DT_INI_SUB_CLASSE_ENT',  
                    "datatype": "date",
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
                        "style": "max-width: 335px;",
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
                        return DG_SUB_CLASSE_ENTIDADE_TRADS.crudButtons(true,true,true);
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
                        maxlength: 240,
                    },
                    "DSR_TRAD": {
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
        DG_SUB_CLASSE_ENTIDADE_TRADS = new QuadTable();
        DG_SUB_CLASSE_ENTIDADE_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsDG_SUB_CLASSE_ENTIDADE_TRADS));
        //END Subclasses Trads        
        
        //Tipos Entidades
        var optionDG_TIPOS_ENTIDADE = {
            "tableId": "DG_TIPOS_ENTIDADE",
            "table": "DG_TIPOS_ENTIDADE", 
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_type; ?>",
            "pk": {
                "primary": {
                    "CD_TIPO_ENT": {"type": "varchar"},
                    "DT_INI_TIPO_ENT": {"type": "date"}
                }
            },
//            "crudOnMasterInactive": {
//                "condition": "data.ACTIVO !== 'S' ",
//                "acl": {
//                    "create": false,
//                    "update": false,
//                    "delete": false
//                }
//            },                    
            "detailsObjects": ['DG_TIPO_ENTIDADE_TRADS'],
            "order_by": "CD_TIPO_ENT",
            "scrollY": "117px",
            "recordBundle": 4,
            "pageLenght": 4, 
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
                    "data": 'CD_TIPO_ENT',
                    "name": 'CD_TIPO_ENT',
                    "className": "visibleColumn",                   
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_TIPO_ENT',
                    "name": 'DSP_TIPO_ENT',
                    "className": "visibleColumn", 
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_TIPO_ENT',
                    "name": 'DSR_TIPO_ENT',                    
                    "className": "visibleColumn",
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_CLASSE_ENT',
                    "name": 'ID_CLASSE_ENT',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_CLASSE_ENT',
                    "name": 'DT_INI_CLASSE_ENT',                    
                    "datatype": "date",
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 4,
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_class, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_class; ?>",
                    "data": 'DSP_CLASSE_ENT',
                    "name": 'DSP_CLASSE_ENT',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "CLASSE_ENT",
                        "dependent-level": 1,
                        "data-db-name": "A.ID_CLASSE_ENT@A.DT_INI_CLASSE_ENT",
                        "decodeFromTable": "DG_CLASSES_ENTIDADE A",  //TO CHANGE ON QUAD-HCM
                        "desigColumn": "A.DSP_CLASSE_ENT", 
                        "orderBy": "A.ID_CLASSE_ENT",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.DT_FIM_CLASSE_ENT IS NULL", //On-New-Record
                            "edit": " AND A.DT_FIM_CLASSE_ENT IS NULL", //On-Edit-Record
                        }
                    }
                }, {
                    "responsivePriority": 6, 
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_TIPO_ENT',
                    "name": 'DT_INI_TIPO_ENT',
                    "datatype": 'date',
                    "def": "1900-01-01",
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }
                }, {
                    "responsivePriority": 7, 
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM_TIPO_ENT',
                    "name": 'DT_FIM_TIPO_ENT',
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
                    "responsivePriority": 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        //debugger;
                        return DG_TIPOS_ENTIDADE.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "CD_TIPO_ENT": {
                        required: true,
                        maxlength: 3
                    },
                    "DSP_TIPO_ENT": {
                        required: true,
                        maxlength: 40,
                    },
                    "DSR_TIPO_ENT": {
                        required: false,
                        maxlength: 25,
                    },
                    "DSP_CLASSE_ENT": {
                        required: true
                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                    "DT_INI_TIPO_ENT": {
                        required: true,
                        dateISO: true,
                    },
                    "DT_FIM_TIPO_ENT": {
                        dateISO: true,
                        dateEqOrNextThan: "DT_INI_TIPO_ENT",
                    }
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                    "DT_FIM_TIPO_ENT": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        DG_TIPOS_ENTIDADE = new QuadTable();
        DG_TIPOS_ENTIDADE.initTable( $.extend({}, datatable_instance_defaults, optionDG_TIPOS_ENTIDADE) );        
        //END Tipos Entidades
        
        //Tipos Entidades Trads
        var optionsDG_TIPO_ENTIDADE_TRADS = {
            "tableId": "DG_TIPO_ENTIDADE_TRADS",
            "table": "DG_TIPO_ENTIDADE_TRADS",
            "pk": {
                "primary": {
                    "CD_TIPO_ENT": {"type": "varchar"},
                    "DT_INI_TIPO_ENT": {"type": "date"},
                    "CD_LINGUA": {"type": "number"},                    
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "DG_TIPOS_ENTIDADE": {
                    "CD_TIPO_ENT": "CD_TIPO_ENT",
                    "DT_INI_TIPO_ENT": "DT_INI_TIPO_ENT"
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
                    "data": 'CD_TIPO_ENT',
                    "name": 'CD_TIPO_ENT',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_TIPO_ENT',
                    "name": 'DT_INI_TIPO_ENT',    
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
                        "style": "max-width: 335px;",
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
                        return DG_TIPO_ENTIDADE_TRADS.crudButtons(true,true,true);
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
                        maxlength: 240,
                    },
                    "DSR_TRAD": {
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
        DG_TIPO_ENTIDADE_TRADS = new QuadTable();
        DG_TIPO_ENTIDADE_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsDG_TIPO_ENTIDADE_TRADS));
        //END Tipos Entidades Trads
                
        //Situações Entidades Externas
        var optionDG_SITUACOES_ENTS = {
            "tableId": "DG_SITUACOES_ENTS",
            "table": "DG_SITUACOES_ENTS", 
            //"selectRecordMsg": "<?php echo $ui_please_select_record . $ui_situation; ?>",
            "pk": {
                "primary": {
                    "CD_SITUACAO_ENT": {"type": "varchar"},
                    "DT_INI": {"type": "date"}
                }
            },
//            "crudOnMasterInactive": {
//                "condition": "data.DT_FIM !== null ",
//                "acl": {
//                    "create": false,
//                    "update": false,
//                    "delete": false
//                }
//            },                    
            //"detailsObjects": ['DG_SITUACOES_ENTS_TRADS'],
            "order_by": "CD_SITUACAO_ENT",
            "scrollY": "117",
            "recordBundle": 4,
            "pageLenght": 4, 
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
                    "data": 'CD_SITUACAO_ENT',
                    "name": 'CD_SITUACAO_ENT',
                    "className": "visibleColumn",                   
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_SITUACAO_ENT',
                    "name": 'DSP_SITUACAO_ENT',
                    "className": "visibleColumn", 
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_SITUACAO_ENT',
                    "name": 'DSR_SITUACAO_ENT',                    
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 5, 
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
                    "responsivePriority": 6, 
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
                        return DG_SITUACOES_ENTS.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "CD_SITUACAO_ENT": {
                        required: true,
                        maxlength: 3
                    },
                    "DSP_SITUACAO_ENT": {
                        required: true,
                        maxlength: 80,
                    },
                    "DSR_SITUACAO_ENT": {
                        required: true,
                        maxlength: 25,
                    },
                    "DT_INI": {
                        required: true,
                        dateISO: true,
                    },
                    "DT_FIM": {
                        dateISO: true,
                        dateEqOrNextThan: "DT_INI",
                    }
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                    "DT_FIM": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        DG_SITUACOES_ENTS = new QuadTable();
        DG_SITUACOES_ENTS.initTable( $.extend({}, datatable_instance_defaults, optionDG_SITUACOES_ENTS) );        
        //END Situações Entidades Externas
        
        if (1===0) {
            //Situações Entidades Externas Trads
            var optionsDG_SITUACOES_ENTS_TRADS = {
                "tableId": "DG_SITUACOES_ENTS_TRADS",
                "table": "DG_SITUACOES_ENTS_TRADS",
                "pk": {
                    "primary": {
                        "CD_SITUACAO_ENT": {"type": "varchar"},
                        "DT_INI_SE": {"type": "date"},
                        "CD_LINGUA": {"type": "number"},                    
                        "DT_INI": {"type": "date"}
                    }
                },
                "dependsOn": {
                    "DG_SITUACOES_ENTS": {
                        "CD_SITUACAO_ENT": "CD_SITUACAO_ENT",
                        "DT_INI_SE": "DT_INI"
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
                        "data": 'CD_TIPO_ENT',
                        "name": 'CD_TIPO_ENT',                    
                        "type": "hidden", //Editor
                        "visible": false, //DataTables                    
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'DT_INI_SE',
                        "name": 'DT_INI_SE',    
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
                            "style": "max-width: 335px;",
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
                            return DG_SITUACOES_ENTS_TRADS.crudButtons(true,true,true);
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
                            maxlength: 240,
                        },
                        "DSR_TRAD": {
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
            DG_SITUACOES_ENTS_TRADS = new QuadTable();
            DG_SITUACOES_ENTS_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsDG_SITUACOES_ENTS_TRADS));
            //END Situações Entidades Externas Trads
        
        }
        
        //Cadastro Entidades Externas
        var optionDG_ENTIDADES = {
            "tableId": "DG_ENTIDADES",
            "table": "DG_ENTIDADES", 
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_external_entity; ?>",
            "pk": {
                "primary": {
                    "CD_ENT": {"type": "number"}
                }
            },
//            "crudOnMasterInactive": {
//                "condition": "data.DT_FIM_CLASSE_ENT !== null ",
//                "acl": {
//                    "create": false,
//                    "update": false,
//                    "delete": false
//                }
//            },         
            "detailsObjects": ['DG_TIPOS_ENTIDADES','DG_MORADAS_ENTS'],
            "order_by": "CD_ENT",
            "scrollY": "234", //"117", 
            "recordBundle": 8, //4
            "pageLenght": 8, //4
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
                    "data": 'CD_ENT',
                    "name": 'CD_ENT',
                    "className": "visibleColumn",                   
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_ENT',
                    "name": 'DSP_ENT',
                    "className": "visibleColumn", 
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_ENT',
                    "name": 'DSR_CLASSE_ENT',                    
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 5,
                    "title": "<?php echo mb_strtoupper($ui_nif_short, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_nif_short; ?>",
                    "data": 'NIF',
                    "name": 'NIF',
                    "className": "visibleColumn",
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_SITUACAO_ENT',
                    "name": 'CD_SITUACAO_ENT',                    
                    "type": "hidden", //Editor
                    "visible": false                    
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_SIT_ENT',
                    "name": 'DT_INI_SIT_ENT',   
                    "datatype": "date",
                    "type": "hidden", //Editor
                    "visible": false
                }, {
                    "responsivePriority": 6,
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_situation, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_situation; ?>",
                    "data": 'DSP_SITUACAO',
                    "name": 'DSP_SITUACAO',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "SITUACOES_EE",
                        "dependent-level": 1,
                        "data-db-name": "A.CD_SITUACAO_ENT@A.DT_INI",
                        "distribute-value": "CD_SITUACAO_ENT@DT_INI_SIT_ENT",
                        "decodeFromTable": "DG_SITUACOES_ENTS A",  //TO CHANGE ON QUAD-HCM
                        "desigColumn": "A.DSP_SITUACAO_ENT", 
                        "orderBy": "A.CD_SITUACAO_ENT",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.DT_FIM IS NULL ", //On-New-Record
                            "edit": " AND A.DT_FIM IS NULL ", //On-Edit-Record
                        }
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_PAIS',
                    "name": 'CD_PAIS',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables   
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'RETENCAO_FONTE',
                    "name": 'RETENCAO_FONTE',   
                    "def": "N",
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                      
                }, {
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_country, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_country; ?>",
                    "data": 'DSP_PAIS',
                    "name": 'DSP_PAIS',
                    "type": "select",
                    "className": "none visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "PAISES",
                        "dependent-level": 1,
                        "data-db-name": "A.CD_PAIS",
                        "decodeFromTable": "DG_PAISES A",  //TO CHANGE ON QUAD-HCM
                        "desigColumn": "A.DSP_PAIS", 
                        "orderBy": "A.CD_PAIS",
                        "class": "form-control complexList chosen"
                    } 
                }, {
                    "title": "<?php echo mb_strtoupper($ui_economic_activitie, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_economic_activitie; ?>", //Editor
                    "data": 'ACTIV_ECONOMICA',
                    "name": 'ACTIV_ECONOMICA',
                    "type": "select",
                    "className": "none visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_ACTIVIDADES_ECONOMICAS',
                        "class": "form-control chosen"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_ACTIVIDADES_ECONOMICAS'], {'RV_LOW_VALUE': val});
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
                        return DG_ENTIDADES.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "CD_ENT": {
                        required: true,
                        integer: true,
                        maxlength: 11
                    },
                    "DSP_ENT": {
                        required: true,
                        maxlength: 80,
                    },
                    "DSR_ENT": {
                        required: false,
                        maxlength: 25,
                    },
                    "DSP_SITUACAO": {
                        required: true
                    },
                    "NIF": {
                        required: false,
                        maxlength: 20
                    }
                }
            }
        };
        DG_ENTIDADES = new QuadTable();
        DG_ENTIDADES.initTable( $.extend({}, datatable_instance_defaults, optionDG_ENTIDADES) );        
        //END Cadastro Entidades Externas
        
        //Entidades Externas Tipos (Estatutos)        
        var optionDG_TIPOS_ENTIDADES = {
            "tableId": "DG_TIPOS_ENTIDADES",
            "table": "DG_TIPOS_ENTIDADES", 
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_type; ?>",
            "pk": {
                "primary": {
                    "CD_ENT": {"type": "number"},
                    "CD_TIPO_ENT": {"type": "varchar"},
                    "DT_INI_TIPO_ENT": {"type": "date"},
                    "DT_INI_TE": {"type": "date"}
                }
            },                    
            "dependsOn": {
                "DG_ENTIDADES": {
                    "CD_ENT": "CD_ENT"
                }
            },
            "crudOnMasterInactive": {
                "condition": "data.DT_FIM_TE !== null ",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            }, 
            "detailsObjects": ['DG_MEMBRO'],            
            "order_by": "CD_TIPO_ENT",
            "scrollY": "117",
            "recordBundle": 4,
            "pageLenght": 4, 
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
                    "data": 'CD_ENT',
                    "name": 'CD_ENT',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_TIPO_ENT',
                    "name": 'CD_TIPO_ENT',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_TIPO_ENT',
                    "name": 'DT_INI_TIPO_ENT',  
                    "datatype": "date",
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 2,
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_type, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_type; ?>",
                    "data": 'DSP_TP_ENT',
                    "name": 'DSP_TP_ENT',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "TIPO_ENT_EXT",
                        "dependent-level": 1,
                        "data-db-name": "A.CD_TIPO_ENT@A.DT_INI_TIPO_ENT",
                        "decodeFromTable": "DG_TIPOS_ENTIDADE A",  //TO CHANGE ON QUAD-HCM
                        "desigColumn": "A.DSP_TIPO_ENT", 
                        "orderBy": "A.CD_TIPO_ENT",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.DT_FIM_TIPO_ENT IS NULL", //On-New-Record
                            "edit": " AND A.DT_FIM_TIPO_ENT IS NULL", //On-Edit-Record
                        }
                    }                     
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_TE',
                    "name": 'DT_INI_TE',
                    "datatype": 'date',
                    "def": "1900-01-01",
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM_TE',
                    "name": 'DT_FIM_TE',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_relatorio_unico, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_relatorio_unico; ?>", //Editor
                    "data": 'TP_ENTIDADE_RU',
                    "name": 'TP_ENTIDADE_RU',
                    "type": "select",
                    "className": "none visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_TIPOS_ENTIDADES.TP_ENTIDADE_RU',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_TIPOS_ENTIDADES.TP_ENTIDADE_RU'], {'RV_LOW_VALUE': val});
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
                    "responsivePriority": 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        //debugger;
                        return DG_TIPOS_ENTIDADES.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DSP_TP_ENT": {
                        required: true
                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                    "DT_INI_TE": {
                        required: true,
                        dateISO: true,
                    },
                    "DT_FIM_TE": {
                        dateISO: true,
                        dateEqOrNextThan: "DT_INI_TE",
                    }
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                    "DT_FIM_TE": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        DG_TIPOS_ENTIDADES = new QuadTable();
        DG_TIPOS_ENTIDADES.initTable( $.extend({}, datatable_instance_defaults, optionDG_TIPOS_ENTIDADES) );        
        //END Entidades Externas Tipos (Estatutos)

        //Membros Ent. Externas
        var optionDG_MEMBRO = {
            "tableId": "DG_MEMBRO",
            "table": "DG_MEMBRO", 
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_member; ?>",
            "pk": {
                "primary": {
                    "ID_MEMBRO": {"type": "number"},
                    "DT_INI_MEMBRO": {"type": "date"}
                }
            },
            "dependsOn": {
                "DG_TIPOS_ENTIDADES": {
                    "CD_ENT": "CD_ENT",
                    "CD_TIPO_ENT": "CD_TIPO_ENT",
                    "DT_INI_TIPO_ENT": "DT_INI_TIPO_ENT",
                    "DT_INI_TE": "DT_INI_TE"            
                }
            },
            "detailsObjects": ['DG_DOCS_MEMBRO_VIEW'],
            "order_by": "ID_MEMBRO",
            "scrollY": "117",
            "recordBundle": 4,
            "pageLenght": 4, 
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
                    "data": 'CD_ENT',
                    "name": 'CD_ENT',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_TIPO_ENT',
                    "name": 'CD_TIPO_ENT',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_TIPO_ENT',
                    "name": 'DT_INI_TIPO_ENT', 
                    "datatype": "date",
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_TE',
                    "name": 'DT_INI_TE', 
                    "datatype": "date",
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'ID_MEMBRO',
                    "name": 'ID_MEMBRO',
                    "className": "visibleColumn",   
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'RHID',
                    "name": 'RHID',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                }, {
                    "responsivePriority": 3,
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_rhid, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_rhid; ?>",
                    "data": 'NOME_REDZ',
                    "name": 'NOME_REDZ',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                                        
                    "attr": {
                        "dependent-group": "COLABS",
                        "dependent-level": 1,
                        "deferred": true,
                        "data-db-name": 'A.EMPRESA@A.RHID',
                        "decodeFromTable": 'QUAD_PEOPLE A',
                        "desigColumn": "CONCAT(CONCAT(A.RHID,'-'),A.NOME_REDZ)",
                        "orderBy": "A.RHID",
                        "class": "form-control complexList chosen",
                        //"disabled": true, //Permite inibir o campo no Editor
                        "filter": {
                            "create": " AND A.ATIVO = 'S'", //On-New-Record
                            "edit": " AND A.ATIVO = 'S'", //On-Edit-Record
                        }
                    }
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_name, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_name; ?>", //Editor
                    "data": 'DSP_NOME',
                    "name": 'DSP_NOME',
                    "className": "visibleColumn", 
                }, {
                    "responsivePriority": 5, 
                    "title": "<?php echo mb_strtoupper($ui_name_short, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_name_short; ?>", //Editor
                    "data": 'DSR_NOME',
                    "name": 'DSR_NOME',                    
                    "className": "visibleColumn",
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_SUB_CLASSE_ENT',
                    "name": 'ID_SUB_CLASSE_ENT',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_SUB_CLASSE_ENT',
                    "name": 'DT_INI_SUB_CLASSE_ENT',                
                    "datatype": "date",
                    "type": "hidden", //Editor
                    "visible": false, //DataTables 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_CLASSE_ENT',
                    "name": 'ID_CLASSE_ENT',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_CLASSE_ENT',
                    "name": 'DT_INI_CLASSE_ENT',                
                    "datatype": "date",
                    "type": "hidden", //Editor
                    "visible": false, //DataTables 
                }, {
                    "responsivePriority": 6,
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_subclass, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_subclass; ?>",
                    "data": 'DSP_TP_ENT',
                    "name": 'DSP_TP_ENT',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "deferred": true,
                        "dependent-group": "SUB_CLASSES",
                        "dependent-level": 1,
                        "data-db-name": "A.CD_TIPO_ENT@A.DT_INI_TIPO_ENT@A.ID_CLASSE_ENT@A.DT_INI_CLASSE_ENT@A.ID_SUB_CLASSE_ENT@A.DT_INI_SUB_CLASSE_ENT",
                        "decodeFromTable": "DG_SUB_CLASSES_ENTIDADE_VIEW A",  //TO CHANGE ON QUAD-HCM
                        "desigColumn": "A.DSP_SUB_CLASSE_ENT", 
                        "orderBy": "A.ID_SUB_CLASSE_ENT",
                        "class": "form-control complexList chosen",
                        "whereClause": " AND A.CD_TIPO_ENT = ':CD_TIPO_ENT' AND TO_CHAR(A.DT_INI_TIPO_ENT,'YYYY-MM-DD') = ':DT_INI_TIPO_ENT' ",
                        "filter": {
                            "create": " AND A.DT_FIM_SUB_CLASSE_ENT IS NULL ", //On-New-Record
                            "edit": " AND A.DT_FIM_SUB_CLASSE_ENT IS NULL ", //On-Edit-Record
                        }
                    } 
                }, {
                    "responsivePriority": 7, 
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_MEMBRO',
                    "name": 'DT_INI_MEMBRO',
                    "datatype": 'date',
                    "def": "1900-01-01",
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }
                }, {
                    "responsivePriority": 8, 
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM_MEMBRO',
                    "name": 'DT_FIM_MEMBRO',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }                    
                }, {
                    "title": "<?php echo mb_strtoupper($ui_birthdate, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_birthdate; ?>", //Editor
                    "data": 'DT_NASCIMENTO',
                    "name": 'DT_NASCIMENTO',
                    "datatype": 'date',
                    "className": "none visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    } 
                }, {
                    "title": "<?php echo mb_strtoupper($ui_mobile, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_mobile; ?>", //Editor
                    "data": 'MOBILE',
                    "name": 'MOBILE',
                    "className": "none visibleColumn", 
                }, {
                    "title": "<?php echo mb_strtoupper($ui_phone, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_phone; ?>", //Editor
                    "data": 'TELF',
                    "name": 'TELF',
                    "className": "none visibleColumn", 
                }, {
                    "title": "<?php echo mb_strtoupper($ui_description, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DESCRICAO',
                    "name": 'DESCRICAO',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "name": 'DESCRICAO',
                        "style": "max-width: 335px;",
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
                        return DG_MEMBRO.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "ID_MEMBRO": {
                        required: true,
                        integer: true,
                        maxlength: 10
                    },
                    "DSP_NOME": {
                        required: false,
                        maxlength: 80
                    },
                    "DSR_NOME": {
                        required: false,
                        maxlength: 25
                    },
                    "DSP_TP_ENT": {
                        required: true
                    },
                    "DT_NASCIMENTO": {
                        dateISO: true
                    },
                    "MOBILE": {
                        maxlength: 20
                    },
                    "TELF": {
                        maxlength: 20
                    },                    
                    "DESCRICAO": {
                        maxlength: 4000
                    },
                    "DT_INI_MEMBRO": {
                        required: true,
                        dateISO: true,
                    },
                    "DT_FIM_MEMBRO": {
                        dateISO: true,
                        dateEqOrNextThan: "DT_INI_MEMBRO",
                    }
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                    "DT_FIM_MEMBRO": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        DG_MEMBRO = new QuadTable();
        DG_MEMBRO.initTable( $.extend({}, datatable_instance_defaults, optionDG_MEMBRO) );        
        //END Membros Ent. Externas
        
        //Membros Doc's
        var optionDG_DOCS_MEMBRO_VIEW = {
            "tableId": "DG_DOCS_MEMBRO_VIEW",
            "table": "DG_DOCS_MEMBRO_VIEW", 
            "pk": {
                "primary": {
                    "ID_MEMBRO": {"type": "number"},
                    "DT_INI_MEMBRO": {"type": "date"}
                }
            },
            "dependsOn": {
                "DG_MEMBRO": {
                    "ID_MEMBRO": "ID_MEMBRO",
                    "DT_INI_MEMBRO": "DT_INI_MEMBRO" 
                }
            },
            "order_by": "ID_MEMBRO",
            "scrollY": "117",
            "recordBundle": 4,
            "pageLenght": 4, 
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
                    "data": 'ID_MEMBRO',
                    "name": 'ID_MEMBRO',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_MEMBRO',
                    "name": 'DT_INI_MEMBRO', 
                    "datatype": "date",
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
//                }, {
//                    "title": "", //Datatables
//                    "label": "", //Editor
//                    "data": 'SEQ',
//                    "name": 'SEQ',
//                    "type": "hidden", //Editor
//                    "visible": false,
//                    "className": "none"
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_DOC_ID',
                    "name": 'CD_DOC_ID',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables 
                }, {
                    "responsivePriority": 2,
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_document, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_document; ?>",
                    "data": 'DSP_DOC_ID',
                    "name": 'DSP_DOC_ID',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                                        
                    "attr": {
                        "dependent-group": "DSP_DOC",
                        "dependent-level": 1,
                        "data-db-name": 'A.CD_DOC_ID',
                        "decodeFromTable": 'DG_DOCUMENTOS A',
                        "desigColumn": "A.DSP_DOC_ID",
                        "orderBy": "A.CD_DOC_ID",
                        "class": "form-control complexList chosen",
                        //"disabled": true, //Permite inibir o campo no Editor
                        "filter": {
                            "create": " AND A.ATIVO = 'S'", //On-New-Record
                            "edit": " AND A.ATIVO = 'S'", //On-Edit-Record
                        }
                    }                    
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_document_num, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_document_num; ?>", //Editor
                    "data": 'NR_DOCUMENTO',
                    "name": 'NR_DOCUMENTO',
                    "className": "visibleColumn",   
                }, {
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_issuer, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_issuer; ?>", //Editor
                    "data": 'EMISSOR',
                    "name": 'EMISSOR',
                    "className": "visibleColumn",   
                }, {
                    "responsivePriority": 5,
                    "title": "<?php echo mb_strtoupper($ui_issuing_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_issuing_date; ?>", //Editor
                    "data": 'DT_EMISSAO',
                    "name": 'DT_EMISSAO',
                    "datatype": 'date',
                    "def": hoje(),
                    "className": "visibleColumn",
                    "attr": {
                        "class": "form-control datepicker"
                    }                    
                }, {
                    "responsivePriority": 6,
                    "title": "<?php echo mb_strtoupper($ui_validity_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_validity_date; ?>", //Editor
                    "data": 'DT_VALIDADE',
                    "name": 'DT_VALIDADE',
                    "datatype": 'date',
                    "def": hoje(),
                    "className": "visibleColumn",
                    "attr": {
                        "class": "form-control datepicker"
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
                        return DG_DOCS_MEMBRO_VIEW.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DSP_DOC_ID": {
                        required: true
                    },
                    "NR_DOCUMENTO": {
                        required: false,
                        maxlength: 20,
                    },
                    "EMISSOR": {
                        maxlength: 25,
                    },
                    "DT_EMISSAO": {
                        dateISO: true
                    },
                    "DT_VALIDADE": {
                        dateISO: true
                    },
                    "DT_INI_MEMBRO": {
                        required: true,
                        dateISO: true,
                    },
                    "DT_FIM_MEMBRO": {
                        dateISO: true,
                        dateEqOrNextThan: "DT_INI_MEMBRO",
                    }
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                    "DT_FIM_MEMBRO": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        DG_DOCS_MEMBRO_VIEW = new QuadTable();
        DG_DOCS_MEMBRO_VIEW.initTable( $.extend({}, datatable_instance_defaults, optionDG_DOCS_MEMBRO_VIEW) );        
        //END Membros Doc's
        
        //Entidades Externas Moradas :: 
        var optionDG_MORADAS_ENTS = {
            "tableId": "DG_MORADAS_ENTS",
            "table": "DG_MORADAS_ENTS", 
            "pk": {
                "primary": {
                    "CD_ENT": {"type": "number"},
                    "CD_MORADA_ENT": {"type": "varchar"},
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "DG_ENTIDADES": {
                    "CD_ENT": "CD_ENT"
                }
            },
            "order_by": "CD_MORADA_ENT",
            "scrollY": "117",
            "recordBundle": 4,
            "pageLenght": 4, 
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
                    "data": 'CD_ENT',
                    "name": 'CD_ENT',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'CD_MORADA_ENT',
                    "name": 'CD_MORADA_ENT',
                    "className": "visibleColumn",                   
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_MORADA_ENT',
                    "name": 'DSP_MORADA_ENT',
                    "className": "visibleColumn", 
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_MORADA_ENT',
                    "name": 'DSR_MORADA_ENT',                    
                    "className": "visibleColumn",                       
                }, {
                    "responsivePriority": 5, 
                    "title": "<?php echo mb_strtoupper($ui_main, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_main; ?>",
                    "fieldInfo": "<?php echo $hint_preferred_mail_address; ?>",
                    "data": 'CORRESP',
                    "name": 'CORRESP',
                    "type": "select",
                    "def": "N",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_SIM_NAO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }
                }, {
                    "responsivePriority": 6, 
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
                    "responsivePriority": 7, 
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
                    "title": "<?php echo mb_strtoupper($ui_internal_reference_short, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_internal_reference_short; ?>", //Editor
                    "data": 'N_REF',
                    "name": 'N_REF',                    
                    "className": "none visibleColumn",
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
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_PAIS',
                    "name": 'CD_PAIS',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables   
                }, {
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_country, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_country; ?>",
                    "data": 'DSP_PAIS',
                    "name": 'DSP_PAIS',
                    "type": "select",
                    "className": "none visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "PAISES",
                        "dependent-level": 1,
                        "data-db-name": "A.CD_PAIS",
                        "decodeFromTable": "DG_PAISES A",  //TO CHANGE ON QUAD-HCM
                        "desigColumn": "A.DSP_PAIS", 
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
                }, {
                    "title": "<?php echo mb_strtoupper($ui_email, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_email; ?>", //Editor
                    "data": 'EMAIL',
                    "name": 'EMAIL',                    
                    "className": "none visibleColumn",
                }, {
                     "title": "<?php echo mb_strtoupper($ui_phone_short . ' #1', 'UTF-8'); ?>", //Datatables :: Original
                     "label": "<?php echo $ui_phone . ' #1'; ?>", //Editor
                     "data": 'TELF1',
                     "name": 'TELF1',
                     "className": "none visibleColumn",
                     "attr": {
                         "class": "form-control",
                         "style": "width: 50%;",
                     }
                 }, {
                     "title": "<?php echo mb_strtoupper($ui_phone_short . ' #2', 'UTF-8'); ?>", //Datatables :: Original
                     "label": "<?php echo $ui_phone . ' #2'; ?>", //Editor
                     "data": 'TELF2',
                     "name": 'TELF2',
                     "className": "none visibleColumn",
                     "attr": {
                         "class": "form-control",
                         "style": "width: 50%;",
                     }        
                }, {
                     "title": "<?php echo mb_strtoupper($ui_fax . ' #1', 'UTF-8'); ?>", //Datatables :: Original
                     "label": "<?php echo $ui_fax . ' #1'; ?>", //Editor
                     "data": 'FAX1',
                     "name": 'FAX1',
                     "className": "none visibleColumn",
                     "attr": {
                         "class": "form-control",
                         "style": "width: 50%;",
                     }
                 }, {
                     "title": "<?php echo mb_strtoupper($ui_fax . ' #2', 'UTF-8'); ?>", //Datatables :: Original
                     "label": "<?php echo $ui_fax . ' #2'; ?>", //Editor
                     "data": 'FAX2',
                     "name": 'FAX2',
                     "className": "none visibleColumn",
                     "attr": {
                         "class": "form-control",
                         "style": "width: 50%;",
                     }                     
                }, {
                    "title": "<?php echo mb_strtoupper($ui_iva, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_iva; ?>", //Editor
                    "data": 'LIQUIDA_IVA',
                    "name": 'LIQUIDA_IVA',
                    "type": "select",
                    "className": "none visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_SIM_NAO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }  
                }, {
                    "title": "<?php echo mb_strtoupper($ui_iva_tax_type_short, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_iva_tax_type_short; ?>", //Editor
                    "data": 'TP_TX_IVA',
                    "name": 'TP_TX_IVA',
                    "type": "select",
                    "className": "none visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_TIPO_TX_IVA',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_TIPO_TX_IVA'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_economic_area, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_economic_area; ?>", //Editor
                    "data": 'ESP_ECON_IVA',
                    "name": 'ESP_ECON_IVA',
                    "type": "select",
                    "className": "none visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_ESP_ECON_IVA',
                        "class": "form-control chosen"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_ESP_ECON_IVA'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_tax_office, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_tax_office; ?>", //Editor
                    "data": 'REP_FISCAL',
                    "name": 'REP_FISCAL',
                    "type": "select",
                    "className": "none visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_REPARTICAO_FISCAL',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_REPARTICAO_FISCAL'], {'RV_LOW_VALUE': val});
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
                        return DG_MORADAS_ENTS.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "CD_MORADA_ENT": {
                        required: true,
                        maxlength: 6
                    },
                    "DSP_MORADA_ENT": {
                        required: true,
                        maxlength: 40
                    },
                    "DSR_MORADA_ENT": {
                        required: false,
                        maxlength: 25
                    },
                    "LIQUIDA_IVA": {
                        required: true
                    },
                    "MORADA": {
                        maxlength: 100
                    },
                    "CD_POSTAL": {
                        maxlength: 10
                    },
                    "NR_ORDEM": {
                        maxlength: 10
                    },
                    "EMAIL": {
                        email: true,
                        maxlength: 80
                    },
                    "TELF1": {
                        maxlength: 15
                    },
                    "TELF2": {
                        maxlength: 15
                    },
                    "FAX1": {
                        maxlength: 15
                    },
                    "FAX2": {
                        maxlength: 15
                    },
                    "N_REF": {
                        maxlength: 50
                    },
                    "DT_INI": {
                        required: true,
                        dateISO: true,
                    },
                    "DT_FIM": {
                        dateISO: true,
                        dateEqOrNextThan: "DT_INI",
                    }
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                    "DT_FIM": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        DG_MORADAS_ENTS = new QuadTable();
        DG_MORADAS_ENTS.initTable( $.extend({}, datatable_instance_defaults, optionDG_MORADAS_ENTS) );        
        //END Entidades Externas Moradas

    });
</script>
