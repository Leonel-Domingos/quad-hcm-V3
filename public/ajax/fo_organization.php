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
                            <a class="nav-link active" data-toggle="tab" href="#Tab1" role="tab" aria-selected="true"><?php echo $ui_product_types; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab2" role="tab" aria-selected="true"><?php echo $ui_products; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab3" role="tab" aria-selected="true"><?php echo $ui_organization; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab4" role="tab" aria-selected="true"><?php echo $ui_target_population; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab5" role="tab" aria-selected="true"><?php echo $ui_certificate_types; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab6" role="tab" aria-selected="true"><?php echo $ui_typologies; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab7" role="tab" aria-selected="true"><?php echo $ui_evaluation_methods; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab8" role="tab" aria-selected="true"><?php echo $ui_modalities; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab9" role="tab" aria-selected="true"><?php echo $ui_areas; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab10" role="tab" aria-selected="true"><?php echo $ui_duration; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab11" role="tab" aria-selected="true"><?php echo $ui_followup; ?></a>
                        </li>
                    </ul>
                </div>
            </div>   
            
            <div class="panel-container show">
                <div class="panel-content">
                    
                    <div class="tab-content">

                         <!-- TAB #1 -->
                        <div class="tab-pane fade active show" id="Tab1" role="tabpanel">
                            <a id="GF_PRD_TIPOS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="GF_PRD_TIPOS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-11" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                            <h2><?php echo $ui_translate; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="GF_PRD_TIPO_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="GF_PRD_TIPO_TRADS" class="table table-bordered table-hover table-striped w-100"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #1 -->

                         <!-- TAB #2 -->
                        <div class="tab-pane fade" id="Tab2" role="tabpanel">
                            <a id="GF_PRODUTOS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="GF_PRODUTOS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-12" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                            <h2><?php echo $ui_translate; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="GF_PRODUTO_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="GF_PRODUTO_TRADS" class="table table-bordered table-hover table-striped w-100"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #2 -->
                        
                         <!-- TAB #3 -->
                        <div class="tab-pane fade" id="Tab3" role="tabpanel">
                            <a id="GF_ORGANIZACOES_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="GF_ORGANIZACOES" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-13" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                            <h2><?php echo $ui_translate; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="GF_ORGANIZACAO_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="GF_ORGANIZACAO_TRADS" class="table table-bordered table-hover table-striped w-100"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #3 -->
                        
                         <!-- TAB #4 -->
                        <div class="tab-pane fade" id="Tab4" role="tabpanel">
                            <a id="GF_ALVOS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="GF_ALVOS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-14" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                            <h2><?php echo $ui_translate; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="GF_ALVO_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="GF_ALVO_TRADS" class="table table-bordered table-hover table-striped w-100"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #4 -->
                        
                         <!-- TAB #5 -->
                        <div class="tab-pane fade" id="Tab5" role="tabpanel">
                            <a id="GF_TP_CERTIFICADOS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="GF_TP_CERTIFICADOS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-15" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                            <h2><?php echo $ui_translate; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="GF_TP_CERTIFICADO_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="GF_TP_CERTIFICADO_TRADS" class="table table-bordered table-hover table-striped w-100"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #5 -->
                        
                         <!-- TAB #6 -->
                        <div class="tab-pane fade" id="Tab6" role="tabpanel">
                            <a id="GF_TIPOLOGIAS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="GF_TIPOLOGIAS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-16" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                            <h2><?php echo $ui_translate; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="GF_TIPOLOGIA_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="GF_TIPOLOGIA_TRADS" class="table table-bordered table-hover table-striped w-100"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #6 -->
                        
                         <!-- TAB #7 -->
                        <div class="tab-pane fade" id="Tab7" role="tabpanel">
                            <a id="GF_METODOS_AVALIACAO_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="GF_METODOS_AVALIACAO" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-17" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                            <h2><?php echo $ui_translate; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="GF_METOD_AVAL_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="GF_METOD_AVAL_TRADS" class="table table-bordered table-hover table-striped w-100"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #7 -->
                        
                         <!-- TAB #8 -->
                        <div class="tab-pane fade" id="Tab8" role="tabpanel">
                            <a id="GF_MODALIDADES_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="GF_MODALIDADES" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-18" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                            <h2><?php echo $ui_translate; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="GF_MODALIDADE_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="GF_MODALIDADE_TRADS" class="table table-bordered table-hover table-striped w-100"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #8 -->
                        
                         <!-- TAB #9 -->
                        <div class="tab-pane fade" id="Tab9" role="tabpanel">
                            <a id="GF_AREAS_FORMACAO_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="GF_AREAS_FORMACAO" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-19" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                            <h2><?php echo $ui_translate; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="GF_AREA_FORMACAO_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="GF_AREA_FORMACAO_TRADS" class="table table-bordered table-hover table-striped w-100"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #9 -->
                        
                         <!-- TAB #10 -->
                        <div class="tab-pane fade" id="Tab10" role="tabpanel">
                            <a id="GF_DURACOES_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="GF_DURACOES" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-110" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                            <h2><?php echo $ui_translate; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="GF_DURACAO_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="GF_DURACAO_TRADS" class="table table-bordered table-hover table-striped w-100"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #10 -->
                        
                         <!-- TAB #11 -->
                        <div class="tab-pane fade" id="Tab11" role="tabpanel">
                            <a id="GF_SEGUIMENTOS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="GF_SEGUIMENTOS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                        </div>
                         <!-- END TAB #11 -->
                        
                    </div>                    
                </div>                    

            </div> 
        </div>
    </div>
</div>

<script>
    pageSetUp();
    
    $(document).ready(function () {

        //Tipos Produto
        var optionGF_PRD_TIPOS = {
            "tableId": "GF_PRD_TIPOS",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_product_type; ?>",
            "table": "GF_PRD_TIPOS", 
            "pk": {
                "primary": {
                    "ID_PT": {"type": "number"},
                    "DT_INI_PT": {"type": "date"}            
                }
            },
            "crudOnMasterInactive": {
                "condition": "data.DT_FIM_PT !== null",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },                    
            "detailsObjects": ['GF_PRD_TIPO_TRADS'],
            "order_by": "ID_PT",
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
                    "data": 'ID_PT',
                    "name": 'ID_PT',
                    "className": "visibleColumn",                   
                }, {
                    "responsivePriority": 2, 
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_PT',
                    "name": 'DT_INI_PT',
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
                    "data": 'DSP_PT',
                    "name": 'DSP_PT',                    
                    "className": "visibleColumn",
                    
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_PT',
                    "name": 'DSR_PT',
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
                    "data": 'DT_FIM_PT',
                    "name": 'DT_FIM_PT',
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
                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_dt_last_updated_by, 'UTF-8'); ?>" + '</span>', //Datatables
                    "label": "<?php echo $ui_dt_last_updated_by; ?>", //Editor
                    "data": 'DT_UPDATED',
                    "name": 'DT_UPDATED',
                    "datatype": 'datetime',     // datetime OR datetimeShort OR datetime
                    "className": "none visibleColumn",
                    "type": "hidden",
                    "attr": {
                        "name": 'DT_UPDATED',
                        "class": "dateTimePicker seconds" //(.datepicker OR .dateTimePickerShort OR .dateTimePicker) AND (.minutes OR .seconds for CSS format width)
                    },
                    "render": function (val, type, row) {
                        if (typeof (val) === "object" && val === null) {
                            return '<span class="timelogValue">&nbsp;</span>';
                        } else {
                            return '<span class="timelogValue">' + val + '</span>';
                        }
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
                        return GF_PRD_TIPOS.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "ID_PT": {
                        required: true,
                        integer: true,
                    },
                    "DT_INI_PT": {
                        required: true,
                        dateISO: true,
                    },
                    "DSP_PT": {
                        required: true,
                        maxlength: 80,
                    },
                    "DSR_PT": {
                        maxlength: 25,
                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                    "DT_FIM_PT": {
                        dateISO: true,
                        dateEqOrNextThan: 'DT_INI_PT',
                    }
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                    "DT_FIM_PT": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        GF_PRD_TIPOS = new QuadTable();
        GF_PRD_TIPOS.initTable( $.extend({}, datatable_instance_defaults, optionGF_PRD_TIPOS) );
        //END Tipos Produto

        //Tipos Produto Trads
        var optionsGF_PRD_TIPO_TRADS = {
            "tableId": "GF_PRD_TIPO_TRADS",
            "table": "GF_PRD_TIPO_TRADS",
            "pk": {
                "primary": {
                    "ID_PT": {"type": "number"},
                    "DT_INI_PT": {"type": "date"},                      
                    "CD_LINGUA": {"type": "number"},                    
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "GF_PRD_TIPOS": {
                    "ID_PT": "ID_PT",
                    "DT_INI_PT": "DT_INI_PT"
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
                    "data": 'ID_PT',
                    "name": 'ID_PT',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_PT',
                    "name": 'DT_INI_PT',
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
                        return GF_PRD_TIPO_TRADS.crudButtons(true,true,true);
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
        GF_PRD_TIPO_TRADS = new QuadTable();
        GF_PRD_TIPO_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsGF_PRD_TIPO_TRADS));
        //END Tipos Produto Trads
        
        //Produtos
        var optionGF_PRODUTOS = {
            "tableId": "GF_PRODUTOS",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_product; ?>",
            "table": "GF_PRODUTOS", 
            "pk": {
                "primary": {
                    "ID_PRD": {"type": "number"},
                    "DT_INI_PRD": {"type": "date"}            
                }
            },
            "crudOnMasterInactive": {
                "condition": "data.DT_FIM_PRD !== null",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },                    
            "detailsObjects": ['GF_PRODUTO_TRADS'],
            "order_by": "ID_PRD",
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
                    "data": 'ID_PRD',
                    "name": 'ID_PRD',
                    "className": "visibleColumn",                   
                }, {
                    "responsivePriority": 2, 
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_PRD',
                    "name": 'DT_INI_PRD',
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
                    "data": 'DSP_PRD',
                    "name": 'DSP_PRD',                    
                    "className": "visibleColumn",
                    
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_PRD',
                    "name": 'DSR_PRD',
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
                    "data": 'DT_FIM_PRD',
                    "name": 'DT_FIM_PRD',
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
                        return GF_PRODUTOS.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "ID_PRD": {
                        required: true,
                        integer: true,
                    },
                    "DT_INI_PRD": {
                        required: true,
                        dateISO: true,
                    },
                    "DSP_PRD": {
                        required: true,
                        maxlength: 80,
                    },
                    "DSR_PRD": {
                        maxlength: 25,
                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                    "DT_FIM_PT": {
                        dateISO: true,
                        dateEqOrNextThan: 'DT_INI_PRD',
                    }
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                    "DT_FIM_PRD": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        GF_PRODUTOS = new QuadTable();
        GF_PRODUTOS.initTable( $.extend({}, datatable_instance_defaults, optionGF_PRODUTOS) );
        //END Produtos
        
        //Produtos Trads
        var optionsGF_PRODUTO_TRADS = {
            "tableId": "GF_PRODUTO_TRADS",
            "table": "GF_PRODUTO_TRADS",
            "pk": {
                "primary": {
                    "ID_PRD": {"type": "number"},
                    "DT_INI_PRD": {"type": "date"},                      
                    "CD_LINGUA": {"type": "number"},                    
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "GF_PRODUTOS": {
                    "ID_PRD": "ID_PRD",
                    "DT_INI_PRD": "DT_INI_PRD"
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
                    "data": 'ID_PRD',
                    "name": 'ID_PRD',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_PRD',
                    "name": 'DT_INI_PRD',
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
                        return GF_PRODUTO_TRADS.crudButtons(true,true,true);
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
        GF_PRODUTO_TRADS = new QuadTable();
        GF_PRODUTO_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsGF_PRODUTO_TRADS));
        //END Produtos Trads     
                
        //Organização
        var optionGF_ORGANIZACOES = {
            "tableId": "GF_ORGANIZACOES",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_organization; ?>",
            "table": "GF_ORGANIZACOES", 
            "pk": {
                "primary": {
                    "ID_ORG": {"type": "number"},
                    "DT_INI_ORG": {"type": "date"}            
                }
            },
            "crudOnMasterInactive": {
                "condition": "data.DT_FIM_ORG !== null",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },                    
            "detailsObjects": ['GF_ORGANIZACAO_TRADS'],
            "order_by": "ID_ORG",
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
                    "data": 'ID_ORG',
                    "name": 'ID_ORG',
                    "className": "visibleColumn",                   
                }, {
                    "responsivePriority": 2, 
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_ORG',
                    "name": 'DT_INI_ORG',
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
                    "data": 'DSP_ORG',
                    "name": 'DSP_ORG',                    
                    "className": "visibleColumn",
                    
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_ORG',
                    "name": 'DSR_ORG',
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
                    "data": 'DT_FIM_ORG',
                    "name": 'DT_FIM_ORG',
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
                        return GF_ORGANIZACOES.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "ID_ORG": {
                        required: true,
                        integer: true,
                    },
                    "DT_INI_ORG": {
                        required: true,
                        dateISO: true,
                    },
                    "DSP_ORG": {
                        required: true,
                        maxlength: 80,
                    },
                    "DSR_ORG": {
                        maxlength: 25,
                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                    "DT_FIM_ORG": {
                        dateISO: true,
                        dateEqOrNextThan: 'DT_INI_ORG',
                    }
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                    "DT_FIM_ORG": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        GF_ORGANIZACOES = new QuadTable();
        GF_ORGANIZACOES.initTable( $.extend({}, datatable_instance_defaults, optionGF_ORGANIZACOES) );
        //END Organização
        
        //Organização Trads
        var optionsGF_ORGANIZACAO_TRADS = {
            "tableId": "GF_ORGANIZACAO_TRADS",
            "table": "GF_ORGANIZACAO_TRADS",
            "pk": {
                "primary": {
                    "ID_ORG": {"type": "number"},
                    "DT_INI_ORG": {"type": "date"},                      
                    "CD_LINGUA": {"type": "number"},                    
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "GF_ORGANIZACOES": {
                    "ID_ORG": "ID_ORG",
                    "DT_INI_ORG": "DT_INI_ORG"
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
                    "data": 'ID_ORG',
                    "name": 'ID_ORG',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_ORG',
                    "name": 'DT_INI_ORG',
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
                        return GF_ORGANIZACAO_TRADS.crudButtons(true,true,true);
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
        GF_ORGANIZACAO_TRADS = new QuadTable();
        GF_ORGANIZACAO_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsGF_ORGANIZACAO_TRADS));
        //END Organização Trads        
                
        //População Alvo
        var optionGF_ALVOS = {
            "tableId": "GF_ALVOS",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_target_population; ?>",
            "table": "GF_ALVOS", 
            "pk": {
                "primary": {
                    "ID_ALVO": {"type": "number"},
                    "DT_INI_ALVO": {"type": "date"}            
                }
            },
            "crudOnMasterInactive": {
                "condition": "data.DT_FIM_ALVO !== null",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },                    
            "detailsObjects": ['GF_ALVO_TRADS'],
            "order_by": "ID_ALVO",
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
                    "data": 'ID_ALVO',
                    "name": 'ID_ALVO',
                    "className": "visibleColumn",                   
                }, {
                    "responsivePriority": 2, 
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_ALVO',
                    "name": 'DT_INI_ALVO',
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
                    "data": 'DSP_ALVO',
                    "name": 'DSP_ALVO',                    
                    "className": "visibleColumn",
                    
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_ALVO',
                    "name": 'DSR_ALVO',
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
                    "data": 'DT_FIM_ALVO',
                    "name": 'DT_FIM_ALVO',
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
                        return GF_ALVOS.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "ID_ALVO": {
                        required: true,
                        integer: true,
                    },
                    "DT_INI_ALVO": {
                        required: true,
                        dateISO: true,
                    },
                    "DSP_ALVO": {
                        required: true,
                        maxlength: 80,
                    },
                    "DSR_ALVO": {
                        maxlength: 25,
                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                    "DT_FIM_ALVO": {
                        dateISO: true,
                        dateEqOrNextThan: 'DT_INI_ALVO',
                    }
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                    "DT_FIM_ALVO": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        GF_ALVOS = new QuadTable();
        GF_ALVOS.initTable( $.extend({}, datatable_instance_defaults, optionGF_ALVOS) );
        //END População Alvo
        
        //População Alvo Trads
        var optionsGF_ALVO_TRADS = {
            "tableId": "GF_ALVO_TRADS",
            "table": "GF_ALVO_TRADS",
            "pk": {
                "primary": {
                    "ID_ALVO": {"type": "number"},
                    "DT_INI_ALVO": {"type": "date"},                      
                    "CD_LINGUA": {"type": "number"},                    
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "GF_ALVOS": {
                    "ID_ALVO": "ID_ALVO",
                    "DT_INI_ALVO": "DT_INI_ALVO"
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
                    "data": 'ID_ALVO',
                    "name": 'ID_ALVO',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_ALVO',
                    "name": 'DT_INI_ALVO',
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
                        return GF_ALVO_TRADS.crudButtons(true,true,true);
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
        GF_ALVO_TRADS = new QuadTable();
        GF_ALVO_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsGF_ALVO_TRADS));
        //END População Alvo Trads        
                
        //Tipos Certificados
        var optionGF_TP_CERTIFICADOS = {
            "tableId": "GF_TP_CERTIFICADOS",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_typology; ?>",
            "table": "GF_TP_CERTIFICADOS", 
            "pk": {
                "primary": {
                    "ID_TP_CERTIFICADO": {"type": "number"},
                    "DT_INI_TC": {"type": "date"}            
                }
            },
            "crudOnMasterInactive": {
                "condition": "data.DT_FIM_TC !== null",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },                    
            "detailsObjects": ['GF_TP_CERTIFICADO_TRADS'],
            "order_by": "ID_TP_CERTIFICADO",
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
                    "data": 'ID_TP_CERTIFICADO',
                    "name": 'ID_TP_CERTIFICADO',
                    "className": "visibleColumn",                   
                }, {
                    "responsivePriority": 2, 
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_TC',
                    "name": 'DT_INI_TC',
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
                    "data": 'DSP_TP_CERTIF',
                    "name": 'DSP_TP_CERTIF',                    
                    "className": "visibleColumn",
                    
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_TP_CERTIF',
                    "name": 'DSR_TP_CERTIF',
                    "className": "visibleColumn",                    
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'COD_OFIC_RU',
                    "name": 'COD_OFIC_RU',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "<?php echo mb_strtoupper($ui_relatorio_unico, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_relatorio_unico; ?>", //Editor
                    "complexList": true, 
                    "data": 'DSP_RU',
                    "name": 'DSP_RU',
                    "type": "select",
                    "className": "none visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "RU",
                        "dependent-level": 1,
                        "data-db-name": "A.ID_RU",
                        "distribute-value": "COD_OFIC_RU",
                        "decodeFromTable": "DG_RELATORIO_UNICO A", //TO CHANGE ON QUAD-HCM
                        "desigColumn": "A.DSP_RU",
                        'whereClause': " AND A.CTX_RU = 'D'",
                        "orderBy": "A.CTX_RU",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.DT_FIM_RU IS NULL", //On-New-Record
                            "edit": " AND A.DT_FIM_RU IS NULL", //On-Edit-Record
                        }
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
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM_TC',
                    "name": 'DT_FIM_TC',
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
                        return GF_TP_CERTIFICADOS.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "ID_TP_CERTIFICADO": {
                        required: true,
                        integer: true,
                    },
                    "DT_INI_TC": {
                        required: true,
                        dateISO: true,
                    },
                    "DSP_TP_CERTIF": {
                        required: true,
                        maxlength: 80,
                    },
                    "DSR_TP_CERTIF": {
                        maxlength: 25,
                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                    "DT_FIM_TC": {
                        dateISO: true,
                        dateEqOrNextThan: 'DT_INI_TC',
                    }
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                    "DT_FIM_TC": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        GF_TP_CERTIFICADOS = new QuadTable();
        GF_TP_CERTIFICADOS.initTable( $.extend({}, datatable_instance_defaults, optionGF_TP_CERTIFICADOS) );
        //END Tipos Certificados        
                
        //Tipos Certificado  Trads
        var optionsGF_TP_CERTIFICADO_TRADS = {
            "tableId": "GF_TP_CERTIFICADO_TRADS",
            "table": "GF_TP_CERTIFICADO_TRADS",
            "pk": {
                "primary": {
                    "ID_TP_CERTIFICADO": {"type": "number"},
                    "DT_INI_TC": {"type": "date"},                      
                    "CD_LINGUA": {"type": "number"},                    
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "GF_TP_CERTIFICADOS": {
                    "ID_TP_CERTIFICADO": "ID_TP_CERTIFICADO",
                    "DT_INI_TC": "DT_INI_TC"
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
                    "data": 'ID_TP_CERTIFICADO',
                    "name": 'ID_TP_CERTIFICADO',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_TC',
                    "name": 'DT_INI_TC',
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
                        return GF_TP_CERTIFICADO_TRADS.crudButtons(true,true,true);
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
        GF_TP_CERTIFICADO_TRADS = new QuadTable();
        GF_TP_CERTIFICADO_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsGF_TP_CERTIFICADO_TRADS));
        //END Tipos Certificado Trads          
                        
        //Tipologias
        var optionGF_TIPOLOGIAS = {
            "tableId": "GF_TIPOLOGIAS",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_target_population; ?>",
            "table": "GF_TIPOLOGIAS", 
            "pk": {
                "primary": {
                    "ID_TIPOLOGIA": {"type": "number"},
                    "DT_INI_TIPOLOGIA": {"type": "date"}            
                }
            },
            "crudOnMasterInactive": {
                "condition": "data.DT_FIM_TIPOLOGIA !== null",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },                    
            "detailsObjects": ['GF_TIPOLOGIA_TRADS'],
            "order_by": "ID_TIPOLOGIA",
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
                    "data": 'ID_TIPOLOGIA',
                    "name": 'ID_TIPOLOGIA',
                    "className": "visibleColumn",                   
                }, {
                    "responsivePriority": 2, 
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_TIPOLOGIA',
                    "name": 'DT_INI_TIPOLOGIA',
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
                    "data": 'DSP_TIPOLOGIA',
                    "name": 'DSP_TIPOLOGIA',                    
                    "className": "visibleColumn",
                    
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_TIPOLOGIA',
                    "name": 'DSR_TIPOLOGIA',
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
                    "data": 'DT_FIM_TIPOLOGIA',
                    "name": 'DT_FIM_TIPOLOGIA',
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
                        return GF_TIPOLOGIAS.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "ID_TIPOLOGIA": {
                        required: true,
                        integer: true,
                    },
                    "DT_INI_TIPOLOGIA": {
                        required: true,
                        dateISO: true,
                    },
                    "DSP_TIPOLOGIA": {
                        required: true,
                        maxlength: 80,
                    },
                    "DSR_TIPOLOGIA": {
                        maxlength: 25,
                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                    "DT_FIM_TIPOLOGIA": {
                        dateISO: true,
                        dateEqOrNextThan: 'DT_INI_TIPOLOGIA',
                    }
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                    "DT_FIM_TIPOLOGIA": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        GF_TIPOLOGIAS = new QuadTable();
        GF_TIPOLOGIAS.initTable( $.extend({}, datatable_instance_defaults, optionGF_TIPOLOGIAS) );
        //END Tipologias
                
        //Tipologias Trads
        var optionsGF_TIPOLOGIA_TRADS = {
            "tableId": "GF_TIPOLOGIA_TRADS",
            "table": "GF_TIPOLOGIA_TRADS",
            "pk": {
                "primary": {
                    "ID_TIPOLOGIA": {"type": "number"},
                    "DT_INI_TIPOLOGIA": {"type": "date"},                      
                    "CD_LINGUA": {"type": "number"},                    
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "GF_TIPOLOGIAS": {
                    "ID_TIPOLOGIA": "ID_TIPOLOGIA",
                    "DT_INI_TIPOLOGIA": "DT_INI_TIPOLOGIA"
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
                    "data": 'ID_TIPOLOGIA',
                    "name": 'ID_TIPOLOGIA',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_TIPOLOGIA',
                    "name": 'DT_INI_TIPOLOGIA',
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
                        return GF_TIPOLOGIA_TRADS.crudButtons(true,true,true);
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
        GF_TIPOLOGIA_TRADS = new QuadTable();
        GF_TIPOLOGIA_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsGF_TIPOLOGIA_TRADS));
        //END Tipologias Trads           
        
        //Métodos Avaliação
        var optionGF_METODOS_AVALIACAO = {
            "tableId": "GF_METODOS_AVALIACAO",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_evaluation_method; ?>",
            "table": "GF_METODOS_AVALIACAO", 
            "pk": {
                "primary": {
                    "ID_MTD_AVAL": {"type": "number"},
                    "DT_INI_MTD_AVAL": {"type": "date"}            
                }
            },
            "crudOnMasterInactive": {
                "condition": "data.DT_FIM_MTD_AVAL !== null",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },                    
            "detailsObjects": ['GF_METOD_AVAL_TRADS'],
            "order_by": "ID_MTD_AVAL",
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
                    "data": 'ID_MTD_AVAL',
                    "name": 'ID_MTD_AVAL',
                    "className": "visibleColumn",                   
                }, {
                    "responsivePriority": 2, 
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_MTD_AVAL',
                    "name": 'DT_INI_MTD_AVAL',
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
                    "data": 'DSP_MTD_AVAL',
                    "name": 'DSP_MTD_AVAL',                    
                    "className": "visibleColumn",
                    
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_MTD_AVAL',
                    "name": 'DSR_MTD_AVAL',
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
                    "data": 'DT_FIM_MTD_AVAL',
                    "name": 'DT_FIM_MTD_AVAL',
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
                        return GF_METODOS_AVALIACAO.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "ID_MTD_AVAL": {
                        required: true,
                        integer: true,
                    },
                    "DT_INI_MTD_AVAL": {
                        required: true,
                        dateISO: true,
                    },
                    "DSP_MTD_AVAL": {
                        required: true,
                        maxlength: 80,
                    },
                    "DSR_MTD_AVAL": {
                        maxlength: 25,
                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                    "DT_FIM_MTD_AVAL": {
                        dateISO: true,
                        dateEqOrNextThan: 'DT_INI_MTD_AVAL',
                    }
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                    "DT_FIM_MTD_AVAL": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        GF_METODOS_AVALIACAO = new QuadTable();
        GF_METODOS_AVALIACAO.initTable( $.extend({}, datatable_instance_defaults, optionGF_METODOS_AVALIACAO) );
        //END Métodos Avaliação             
        
        //Métodos Avaliação  Trads
        var optionsGF_METOD_AVAL_TRADS = {
            "tableId": "GF_METOD_AVAL_TRADS",
            "table": "GF_METOD_AVAL_TRADS",
            "pk": {
                "primary": {
                    "ID_MTD_AVAL": {"type": "number"},
                    "DT_INI_MTD_AVAL": {"type": "date"},                      
                    "CD_LINGUA": {"type": "number"},                    
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "GF_METODOS_AVALIACAO": {
                    "ID_MTD_AVAL": "ID_MTD_AVAL",
                    "DT_INI_MTD_AVAL": "DT_INI_MTD_AVAL"
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
                    "data": 'ID_MTD_AVAL',
                    "name": 'ID_MTD_AVAL',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_MTD_AVAL',
                    "name": 'DT_INI_MTD_AVAL',
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
                        return GF_METOD_AVAL_TRADS.crudButtons(true,true,true);
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
        GF_METOD_AVAL_TRADS = new QuadTable();
        GF_METOD_AVAL_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsGF_METOD_AVAL_TRADS));
        //END Métodos Avaliação Trads         
                
        //Modalidades
        var optionGF_MODALIDADES = {
            "tableId": "GF_MODALIDADES",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_modality; ?>",
            "table": "GF_MODALIDADES", 
            "pk": {
                "primary": {
                    "ID_MODALIDADE": {"type": "number"},
                    "DT_INI_MODALIDADE": {"type": "date"}            
                }
            },
            "crudOnMasterInactive": {
                "condition": "data.DT_FIM_MODALIDADE !== null",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },                    
            "detailsObjects": ['GF_MODALIDADE_TRADS'],
            "order_by": "ID_MODALIDADE",
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
                    "data": 'ID_MODALIDADE',
                    "name": 'ID_MODALIDADE',
                    "className": "visibleColumn",                   
                }, {
                    "responsivePriority": 2, 
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_MODALIDADE',
                    "name": 'DT_INI_MODALIDADE',
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
                    "data": 'DSP_MODALIDADE',
                    "name": 'DSP_MODALIDADE',                    
                    "className": "visibleColumn",
                    
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_MODALIDADE',
                    "name": 'DSR_MODALIDADE',
                    "className": "visibleColumn",      
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'COD_OFIC_RU',
                    "name": 'COD_OFIC_RU',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "<?php echo mb_strtoupper($ui_relatorio_unico, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_relatorio_unico; ?>", //Editor
                    "complexList": true, 
                    "data": 'DSP_RU',
                    "name": 'DSP_RU',
                    "type": "select",
                    "className": "none visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "RU",
                        "dependent-level": 1,
                        "data-db-name": "A.ID_RU",
                        "distribute-value": "COD_OFIC_RU",
                        "decodeFromTable": "DG_RELATORIO_UNICO A", //TO CHANGE ON QUAD-HCM
                        "desigColumn": "A.DSP_RU",
                        'whereClause': " AND A.CTX_RU = 'B'",
                        "orderBy": "A.CTX_RU",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.DT_FIM_RU IS NULL", //On-New-Record
                            "edit": " AND A.DT_FIM_RU IS NULL", //On-Edit-Record
                        }
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
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM_MODALIDADE',
                    "name": 'DT_FIM_MODALIDADE',
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
                        return GF_MODALIDADES.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "ID_MODALIDADE": {
                        required: true,
                        integer: true,
                    },
                    "DT_INI_MODALIDADE": {
                        required: true,
                        dateISO: true,
                    },
                    "DSP_MODALIDADE": {
                        required: true,
                        maxlength: 80,
                    },
                    "DSR_MODALIDADE": {
                        maxlength: 25,
                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                    "DT_FIM_MODALIDADE": {
                        dateISO: true,
                        dateEqOrNextThan: 'DT_INI_MODALIDADE',
                    }
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                    "DT_FIM_MODALIDADE": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        GF_MODALIDADES = new QuadTable();
        GF_MODALIDADES.initTable( $.extend({}, datatable_instance_defaults, optionGF_MODALIDADES) );
        //END Modalidades       
        
        //Modalidades Trads
        var optionGF_MODALIDADE_TRADS = {
            "tableId": "GF_MODALIDADE_TRADS",
            "table": "GF_MODALIDADE_TRADS",
            "pk": {
                "primary": {
                    "ID_MODALIDADE": {"type": "number"},
                    "DT_INI_MODALIDADE": {"type": "date"},                      
                    "CD_LINGUA": {"type": "number"},                    
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "GF_MODALIDADES": {
                    "ID_MODALIDADE": "ID_MODALIDADE",
                    "DT_INI_MODALIDADE": "DT_INI_MODALIDADE"
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
                    "data": 'ID_MODALIDADE',
                    "name": 'ID_MODALIDADE',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_MODALIDADE',
                    "name": 'DT_INI_MODALIDADE',
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
                        return GF_MODALIDADE_TRADS.crudButtons(true,true,true);
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
        GF_MODALIDADE_TRADS = new QuadTable();
        GF_MODALIDADE_TRADS.initTable( $.extend({}, datatable_instance_defaults, optionGF_MODALIDADE_TRADS) );       
        //END Modalidades Trads
                
        //Áreas
        var optionGF_AREAS_FORMACAO = {
            "tableId": "GF_AREAS_FORMACAO",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_area; ?>",
            "table": "GF_AREAS_FORMACAO", 
            "pk": {
                "primary": {
                    "ID_AREA_FORM": {"type": "number"},
                    "DT_INI_AREA_FORM": {"type": "date"}            
                }
            },
            "crudOnMasterInactive": {
                "condition": "data.DT_FIM_AREA_FORM !== null",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },                    
            "detailsObjects": ['GF_AREA_FORMACAO_TRADS'],
            "order_by": "ID_AREA_FORM",
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
                    "data": 'ID_AREA_FORM',
                    "name": 'ID_AREA_FORM',
                    "className": "visibleColumn",                   
                }, {
                    "responsivePriority": 2, 
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_AREA_FORM',
                    "name": 'DT_INI_AREA_FORM',
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
                    "data": 'DSP_AREA_FORM',
                    "name": 'DSP_AREA_FORM',                    
                    "className": "visibleColumn",
                    
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_AREA_FORM',
                    "name": 'DSR_AREA_FORM',
                    "className": "visibleColumn",      
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'COD_OFIC_RU',
                    "name": 'COD_OFIC_RU',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "<?php echo mb_strtoupper($ui_relatorio_unico, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_relatorio_unico; ?>", //Editor
                    "complexList": true, 
                    "data": 'DSP_RU',
                    "name": 'DSP_RU',
                    "type": "select",
                    "className": "none visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "RU",
                        "dependent-level": 1,
                        "data-db-name": "A.ID_RU",
                        "distribute-value": "COD_OFIC_RU",
                        "decodeFromTable": "DG_RELATORIO_UNICO A", //TO CHANGE ON QUAD-HCM
                        "desigColumn": "A.DSP_RU",
                        'whereClause': " AND A.CTX_RU = 'E'",
                        "orderBy": "A.CTX_RU",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.DT_FIM_RU IS NULL", //On-New-Record
                            "edit": " AND A.DT_FIM_RU IS NULL", //On-Edit-Record
                        }
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
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM_AREA_FORM',
                    "name": 'DT_FIM_AREA_FORM',
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
                        return GF_AREAS_FORMACAO.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "ID_AREA_FORM": {
                        required: true,
                        integer: true,
                    },
                    "DT_INI_AREA_FORM": {
                        required: true,
                        dateISO: true,
                    },
                    "DSP_AREA_FORM": {
                        required: true,
                        maxlength: 80,
                    },
                    "DSR_AREA_FORM": {
                        maxlength: 25,
                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                    "DT_FIM_AREA_FORM": {
                        dateISO: true,
                        dateEqOrNextThan: 'DT_INI_AREA_FORM',
                    }
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                    "DT_FIM_AREA_FORM": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        GF_AREAS_FORMACAO = new QuadTable();
        GF_AREAS_FORMACAO.initTable( $.extend({}, datatable_instance_defaults, optionGF_AREAS_FORMACAO) );
        //END Áreas
        
        //Áreas Trads
        var optionGF_AREA_FORMACAO_TRADS = {
            "tableId": "GF_AREA_FORMACAO_TRADS",
            "table": "GF_AREA_FORMACAO_TRADS",
            "pk": {
                "primary": {
                    "ID_AREA_FORM": {"type": "number"},
                    "DT_INI_AREA_FORM": {"type": "date"},                      
                    "CD_LINGUA": {"type": "number"},                    
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "GF_AREAS_FORMACAO": {
                    "ID_AREA_FORM": "ID_AREA_FORM",
                    "DT_INI_AREA_FORM": "DT_INI_AREA_FORM"
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
                    "data": 'ID_AREA_FORM',
                    "name": 'ID_AREA_FORM',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_AREA_FORM',
                    "name": 'DT_INI_AREA_FORM',
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
                        return GF_AREA_FORMACAO_TRADS.crudButtons(true,true,true);
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
        GF_AREA_FORMACAO_TRADS = new QuadTable();
        GF_AREA_FORMACAO_TRADS.initTable( $.extend({}, datatable_instance_defaults, optionGF_AREA_FORMACAO_TRADS) );       
        //END Áreas  Trads
                
        //Duração
        var optionGF_DURACOES = {
            "tableId": "GF_DURACOES",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_area; ?>",
            "table": "GF_DURACOES", 
            "pk": {
                "primary": {
                    "ID_DURACAO": {"type": "number"},
                    "DT_INI_DURACAO": {"type": "date"}            
                }
            },
            "crudOnMasterInactive": {
                "condition": "data.DT_FIM_DURACAO !== null",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },                    
            "detailsObjects": ['GF_DURACAO_TRADS'],
            "order_by": "ID_DURACAO",
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
                    "data": 'ID_DURACAO',
                    "name": 'ID_DURACAO',
                    "className": "visibleColumn",                   
                }, {
                    "responsivePriority": 2, 
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_DURACAO',
                    "name": 'DT_INI_DURACAO',
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
                    "data": 'DSP_DURACAO',
                    "name": 'DSP_DURACAO',                    
                    "className": "visibleColumn",
                    
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_DURACAO',
                    "name": 'DSR_DURACAO',
                    "className": "visibleColumn",      
                }, {
                    "title": "<?php echo mb_strtoupper($ui_min_hrs, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_min_hrs; ?>", //Editor
                    "data": 'NR_HRS_MIN',
                    "name": 'NR_HRS_MIN',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 30%;"
                    } 
                }, {
                    "title": "<?php echo mb_strtoupper($ui_max_hrs, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_max_hrs; ?>", //Editor
                    "data": 'NR_HRS_MAX',
                    "name": 'NR_HRS_MAX',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 30%;"
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
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM_DURACAO',
                    "name": 'DT_FIM_DURACAO',
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
                        return GF_DURACOES.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "ID_DURACAO": {
                        required: true,
                        integer: true,
                    },
                    "DT_INI_DURACAO": {
                        required: true,
                        dateISO: true,
                    },
                    "DSP_DURACAO": {
                        required: true,
                        maxlength: 80,
                    },
                    "DSR_DURACAO": {
                        maxlength: 25,
                    },
                    "NR_HRS_MIN": {
                        number: true
                    },
                    "NR_HRS_MAX": {
                        number: true
                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                    "DT_FIM_DURACAO": {
                        dateISO: true,
                        dateEqOrNextThan: 'DT_INI_DURACAO',
                    }
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                    "DT_FIM_DURACAO": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        GF_DURACOES = new QuadTable();
        GF_DURACOES.initTable( $.extend({}, datatable_instance_defaults, optionGF_DURACOES) );
        //END Duração 
                
        //Duração Trads
        var optionGF_DURACAO_TRADS = {
            "tableId": "GF_DURACAO_TRADS",
            "table": "GF_DURACAO_TRADS",
            "pk": {
                "primary": {
                    "ID_DURACAO": {"type": "number"},
                    "DT_INI_DURACAO": {"type": "date"},
                    "CD_LINGUA": {"type": "number"},                    
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "GF_DURACOES": {
                    "ID_DURACAO": "ID_DURACAO",
                    "DT_INI_DURACAO": "DT_INI_DURACAO"
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
                    "data": 'ID_DURACAO',
                    "name": 'ID_DURACAO',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_DURACAO',
                    "name": 'DT_INI_DURACAO',
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
                        return GF_DURACAO_TRADS.crudButtons(true,true,true);
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
        GF_DURACAO_TRADS = new QuadTable();
        GF_DURACAO_TRADS.initTable( $.extend({}, datatable_instance_defaults, optionGF_DURACAO_TRADS) );       
        //END Duração Trads
      
        //Seguimento
        var optionGF_SEGUIMENTOS = {
            "tableId": "GF_SEGUIMENTOS",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_followup; ?>",
            "table": "GF_SEGUIMENTOS", 
            "pk": {
                "primary": {
                    "ID_SEGUIMENTO": {"type": "number"},
                    "DT_INI_SEGUIMENTO": {"type": "date"}            
                }
            },
            "crudOnMasterInactive": {
                "condition": "data.DT_FIM_SEGUIMENTO !== null",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },                    
            //"detailsObjects": [''],
            "order_by": "ID_SEGUIMENTO",
            "recordBundle": 10,
            "pageLenght": 10,
            "scrollY": "312",
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
                    "data": 'ID_SEGUIMENTO',
                    "name": 'ID_SEGUIMENTO',
                    "className": "visibleColumn",                   
                }, {
                    "responsivePriority": 2, 
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_SEGUIMENTO',
                    "name": 'DT_INI_SEGUIMENTO',
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
                    "data": 'DSP_SEGUIMENTO',
                    "name": 'DSP_SEGUIMENTO',                    
                    "className": "visibleColumn",
                    
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_SEGUIMENTO',
                    "name": 'DSR_SEGUIMENTO',
                    "className": "visibleColumn",                         
                }, {
                    "title": "<?php echo mb_strtoupper($ui_internal_reference_short, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_internal_reference_short; ?>", //Editor
                    "data": 'REF_INTERNA',
                    "name": 'REF_INTERNA',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 335px",
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
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM_SEGUIMENTO',
                    "name": 'DT_FIM_SEGUIMENTO',
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
                        return GF_SEGUIMENTOS.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "ID_SEGUIMENTO": {
                        required: true,
                        integer: true,
                    },
                    "DT_INI_SEGUIMENTO": {
                        required: true,
                        dateISO: true,
                    },
                    "DSP_SEGUIMENTO": {
                        required: true,
                        maxlength: 80,
                    },
                    "DSR_SEGUIMENTO": {
                        maxlength: 25,
                    },
                    "REF_INTERNA": {
                        maxlength: 200,
                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                    "DT_FIM_SEGUIMENTO": {
                        dateISO: true,
                        dateEqOrNextThan: 'DT_INI_SEGUIMENTO',
                    }
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                    "DT_FIM_SEGUIMENTO": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        GF_SEGUIMENTOS = new QuadTable();
        GF_SEGUIMENTOS.initTable( $.extend({}, datatable_instance_defaults, optionGF_SEGUIMENTOS) );
        //END Duração 
    });
</script>
