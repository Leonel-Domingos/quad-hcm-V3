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
                            <a class="nav-link active" data-toggle="tab" href="#Tab1" role="tab" aria-selected="true"><?php echo $ui_training_plans; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab2" role="tab" aria-selected="true"><?php echo $ui_versions; ?></a>
                        </li>
                    </ul>
                </div>
            </div>   
            
            <div class="panel-container show">
                <div class="panel-content">
                    
                    <div class="tab-content">

                         <!-- TAB #1 -->
                        <div class="tab-pane fade active show" id="Tab1" role="tabpanel">
                            <a id="GF_PLANOS_FORMACAO_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="GF_PLANOS_FORMACAO" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-11" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="far fa-language"></i></span>&nbsp;
                                            <h2><?php echo $ui_translate; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="GF_PLANO_FORMACAO_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="GF_PLANO_FORMACAO_TRADS" class="table table-bordered table-hover table-striped w-100"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #1 -->

                         <!-- TAB #2 -->
                        <div class="tab-pane fade" id="Tab2" role="tabpanel">
                            <a id="GF_VERSOES_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="GF_VERSOES" class="table responsive table-bordered table-striped table-hover nowrap"></table>

                           <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="versionStats" style="padding-bottom: 10px; display:none;">
                                        <table class="table table-bordered table table-striped table-condensed  stats">
                                            <thead>
                                                <tr style="text-align: center;">
                                                    <th scope="col" colspan="5"><?php echo mb_strtoupper($ui_values, 'UTF-8');?></th>
                                                    <th scope="col" colspan="5"><?php echo mb_strtoupper($ui_participants, 'UTF-8');?></th>
                                                    <th scope="col" colspan="3"><?php echo mb_strtoupper($ui_actions, 'UTF-8');?></th>                                                    
                                                </tr>
                                                <tr style="text-align: center;">
                                                    <th scope="col">[A]Orçament.</th>
                                                    <th scope="col">[B]Estimado</th>
                                                    <th scope="col">[C]Real</th>
                                                    <th scope="col">%[C/A]</th>
                                                    <th scope="col">%[C/B]</th>

                                                    <th scope="col">[A]Orç.</th>
                                                    <th scope="col">[B]Est.</th>
                                                    <th scope="col">[C]Real</th>
                                                    <th scope="col">%[C/A]</th>
                                                    <th scope="col">%[C/B]</th>

                                                    <th scope="col">Prev.</th>
                                                    <th scope="col">Realiz.</th>
                                                    <th scope="col">Taxa</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr style="text-align: center;">
                                                    <th scope="col">25000</th>
                                                    <th scope="col">22100</th>
                                                    <th scope="col">20000</th>
                                                    <th scope="col">80%</th>
                                                    <th scope="col">90.49%</th>

                                                    <th scope="col">1500</th>
                                                    <th scope="col">1000</th>
                                                    <th scope="col">755</th>
                                                    <th scope="col">50.33%</th>
                                                    <th scope="col">75.5%</th>

                                                    <th scope="col">130</th>
                                                    <th scope="col">55</th>
                                                    <th scope="col">42.30%</th>                                                    
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="15" style="text-align: center;font-size: .8em;color: darkgoldenrod;"><strong>PTE: A passar para chamada AJAX. Commits nos Orçamentos devem-nas refrescar?</strong></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-start">
                                        <div class="panel-toolbar pr-3 align-self-end">
                                            <ul id="panel-tab-2-1" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-toggle="tab" href="#Tab21" role="tab" aria-selected="true"><?php echo $ui_translate; ?></a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#Tab22" role="tab" aria-selected="true"><?php echo $ui_budgets; ?></a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#Tab23" role="tab" aria-selected="true"><?php echo $ui_interactions; ?></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="panel-container show">
                                        <div class="panel-content">
                                            <div class="tab-content">
                                                <div class="tab-pane fade active show" id="Tab21" role="tabpanel">
                                                    <a id="GF_VERSOES_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                    <table id="GF_VERSAO_TRADS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                                </div>
                                                <div class="tab-pane fade" id="Tab22" role="tabpanel">
                                                    <a id="GF_ORCAMENTOS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                    <table id="GF_ORCAMENTOS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                                </div>                                        
                                                <div class="tab-pane fade" id="Tab23" role="tabpanel">
                                                    <a id="GF_INTERACOES_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                    <table id="GF_INTERACOES" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                                </div>                                        
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #2 -->
                    </div>                    
                </div>                    

            </div> 
        </div>
    </div>
</div>

<script>
    pageSetUp();

    $(document).ready(function () {

        //Training Plan
        var optionGF_PLANOS_FORMACAO = {
            "tableId": "GF_PLANOS_FORMACAO",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_training_plan; ?>",
            "table": "GF_PLANOS_FORMACAO",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_PLANO_FORM": {"type": "number"},
                    "DT_INI_PLANO_FORM": {"type": "date"}
                }
            },
            "crudOnMasterInactive": {
                "condition": "data.DT_FIM_PLANO_FORM !== null",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },
            "detailsObjects": ['GF_PLANO_FORMACAO_TRADS'],
            "order_by": "EMPRESA, ID_PLANO_FORM, DT_INI_PLANO_FORM desc",
            "scrollY": "234", 
            "recordBundle": 7,
            "pageLenght": 7,
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
                    "data": 'EMPRESA',
                    "name": 'EMPRESA',
                    "type": "hidden",
                    "visible": false,
                    "className": "",
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
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'ID_PLANO_FORM',
                    "name": 'ID_PLANO_FORM',
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_PLANO_FORM',
                    "name": 'DT_INI_PLANO_FORM',
                    "datatype": 'date',
                    "def": hoje(),
                    "className": "visibleColumn",
                    "attr": {
                        "class": "form-control datepicker"
                    }
                }, {
                    "responsivePriority": 5,
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DSP_PLANO_FORM',
                    "name": 'DSP_PLANO_FORM',
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 6,
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_PLANO_FORM',
                    "name": 'DSR_PLANO_FORM',
                    "className": "visibleColumn",
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
                        "class": "form-control defaultWidth",
                    }
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM_PLANO_FORM',
                    "name": 'DT_FIM_PLANO_FORM',
                    "datatype": 'date',
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
                    //"targets": 16,
                    "responsivePriority": 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        //debugger;
                        return GF_PLANOS_FORMACAO.crudButtons(true, true, true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DSP_EMPRESA": {
                        required: true
                    },
                    "ID_PLANO_FORM": {
                        required: true,
                        integer: true,
                    },
                    "DT_INI_PLANO_FORM": {
                        required: true,
                        dateISO: true,
                    },
                    "DSP_PLANO_FORM": {
                        required: true,
                        maxlength: 80,
                    },
                    "DSR_PLANO_FORM": {
                        maxlength: 25,
                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                    "DT_FIM_PLANO_FORM": {
                        dateISO: true,
                        dateEqOrNextThan: 'DT_INI_PLANO_FORM',
                    }
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                    "DT_FIM_PLANO_FORM": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        GF_PLANOS_FORMACAO = new QuadTable();
        GF_PLANOS_FORMACAO.initTable($.extend({}, datatable_instance_defaults, optionGF_PLANOS_FORMACAO));
        //END Training Plan

        //Training Plan Trans
        var optionsGF_PLANO_FORMACAO_TRADS = {
            "tableId": "GF_PLANO_FORMACAO_TRADS",
            "table": "GF_PLANO_FORMACAO_TRADS",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_PLANO_FORM": {"type": "number"},
                    "DT_INI_PLANO_FORM": {"type": "date"},              
                    "CD_LINGUA": {"type": "number"},                    
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "GF_PLANOS_FORMACAO": {
                    "EMPRESA": "EMPRESA",
                    "ID_PLANO_FORM": "ID_PLANO_FORM",
                    "DT_INI_PLANO_FORM": "DT_INI_PLANO_FORM"
                }
            },  
            "order_by": "CD_LINGUA, DT_INI DESC",
            "recordBundle": 4,
            "pageLenght": 4,
            "scrollY": "117",
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
                    "data": 'EMPRESA',
                    "name": 'EMPRESA',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_PLANO_FORM',
                    "name": 'ID_PLANO_FORM',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_PLANO_FORM',
                    "name": 'DT_INI_PLANO_FORM',
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
                            "create": " AND A.ATIVO = 'S'", //On-New-Record
                            "edit": " AND A.ATIVO = 'S'", //On-Edit-Record
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
                        return GF_PLANO_FORMACAO_TRADS.crudButtons(true,true,true);
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
        GF_PLANO_FORMACAO_TRADS = new QuadTable();
        GF_PLANO_FORMACAO_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsGF_PLANO_FORMACAO_TRADS));
        //Training Plan Trans

        //Versions
        var optionGF_VERSOES = {
            "tableId": "GF_VERSOES",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_version; ?>",
            "table": "GF_VERSOES",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_PLANO_FORM": {"type": "number"},
                    "DT_INI_PLANO_FORM": {"type": "date"},
                    "ID_VERSAO": {"type": "number"},
                    "DT_INI_VERSAO": {"type": "date"}
                }
            },                  
            "detailsObjects": ['GF_VERSAO_TRADS','GF_ORCAMENTOS','GF_INTERACOES'],
            "crudOnMasterInactive": {
                "condition": "data.DT_FIM_VERSAO !== null",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },
            "order_by": "ID_VERSAO desc, DT_INI_VERSAO desc",
            "scrollY": "78", 
            "recordBundle": 3,
            "pageLenght": 3,
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
                    "data": 'EMPRESA',
                    "name": 'EMPRESA',
                    "type": "hidden",
                    "visible": false,
                    "className": "",
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_PLANO_FORM',
                    "name": 'ID_PLANO_FORM',
                    "type": "hidden",
                    "visible": false,
                    "className": "",
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_PLANO_FORM',
                    "name": 'DT_INI_PLANO_FORM',
                    "type": "hidden",
                    "datatype": "date",
                    "visible": false,
                    "className": "",
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'ID_VERSAO',
                    "name": 'ID_VERSAO',
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_VERSAO',
                    "name": 'DT_INI_VERSAO',
                    "datatype": 'date',
                    "def": hoje(),
                    "className": "visibleColumn",
                    "attr": {
                        "class": "form-control datepicker"
                    }
                }, {
                    "responsivePriority": 9,
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DSP_VERSAO',
                    "name": 'DSP_VERSAO',
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_VERSAO',
                    "name": 'DSR_VERSAO',
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 5, 
                    "title": "<?php echo mb_strtoupper($ui_budget, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_budget; ?>", //Editor
                    "data": 'ORCAMENTO',
                    "name": 'ORCAMENTO',                    
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 30%;",
                    } 
                }, {
                    "responsivePriority": 6,
                    "title": "<?php echo mb_strtoupper($ui_presentaton_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_presentaton_date; ?>", //Editor
                    "data": 'DT_APRESENTACAO',
                    "name": 'DT_APRESENTACAO',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "form-control datepicker"
                    }                    
                }, {
                    "responsivePriority": 7,
                    "title": "<?php echo mb_strtoupper($ui_acceptance_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_acceptance_date; ?>", //Editor
                    "data": 'DT_ACEITACAO',
                    "name": 'DT_ACEITACAO',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "form-control datepicker"
                    }                        
                }, {
                    "responsivePriority": 8,
                    "title": "<?php echo mb_strtoupper($ui_rejection_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_rejection_date; ?>", //Editor
                    "data": 'DT_REJEICAO',
                    "name": 'DT_REJEICAO',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "form-control datepicker"
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
                        "class": "form-control defaultWidth",
                    }
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM_VERSAO',
                    "name": 'DT_FIM_VERSAO',
                    "datatype": 'date',
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
                    //"targets": 16,
                    "responsivePriority": 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        //debugger;
                        return GF_VERSOES.crudButtons(true, true, true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DSP_EMPRESA": {
                        required: true
                    },
                    "ID_PLANO_FORM": {
                        required: true,
                        integer: true,
                    },
                    "DT_INI_PLANO_FORM": {
                        required: true,
                        dateISO: true,
                    },
                    "DSP_PLANO_FORM": {
                        required: true,
                        maxlength: 80,
                    },
                    "DSR_PLANO_FORM": {
                        maxlength: 25,
                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                    "DT_FIM_PLANO_FORM": {
                        dateISO: true,
                        dateEqOrNextThan: 'DT_INI_PLANO_FORM',
                    }
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                    "DT_FIM_PLANO_FORM": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        GF_VERSOES = new QuadTable();
        GF_VERSOES.initTable($.extend({}, datatable_instance_defaults, optionGF_VERSOES));
        
        //Mostra/Esconde Estatísticas associadas à VERSÃO
        $(document).on('click', '#GF_VERSOES > tbody', function (ev) {
            var recordData = GF_VERSOES.selectedRowData();
            if (GF_VERSOES.tbl.rows( '.selected' ).any()){ //ROW on MASTER IS SELECTED
                //console.log(recordData);
                slideMe ( $('#versionStats'), 'Down');
                
                //PTE :: CALL VERSION STATISTICS
                //Será que COMMITS NO ORÇAMENTO NÃO AS DEVERIAM ATUALIZAR???

/*
            $.ajax({
                type: "POST",
                url:  "data-source/ad_action_controller.php",
                data: "request_id=GRAVAR_CONCORDANCIA"+
                      "&id_ficha="+$("#key").val()+
                      "&tipo=<?php echo $tp_concordancia; ?>"+
                      "&ok="+ok_+
                      "&obs="+escape(obs),
                cache: false,
                success: function(msg){
                    data = JSON.parse(msg);
                    // Refrescar Interface ou re-renderizar form#saveEvalResponse ????
                    if (data.erro === '') {
                        //Se for a 2ª hipótese e tudo tiver corrido bem:
                        $('#saveEvalResponse').hide().empty();
                        //O controlador devolverá o HTML a renderizar (adaptar o que está neste interface)
                        msg = 'Feito!!!!';
                        $('#saveEvalResponse')
                            .append(msg)
                            .slideDown({
                                "duration": 1500, 
                                "easing": 'swing',
                                start: function() {
                                    $(this).css('opacity','0.0');
                                },
                                step: function() {
                                    var opac = $(this).css('opacity');
                                    $(this).css('opacity', Number(opac) + Number(0.1) );
                                }
                            })
                            .css('animation-timing-function','cubic-bezier(0, 0, 0.79, 0.99)');
                    } else {
                        quad_notification({
                                type: "error",
                                title : JS_OPERATION_ERROR,
                                content : '<i class="glyphicon glyphicon-thumbs-down"></i>&nbsp;<i>' + data.erro + '</i>'
                        });
                    }
                }
            });                   
*/
                
            } else {  //DESELECT ROW EVENT
                    slideMe ( $('#versionStats'));
            }        
        });
        //END Versions
 
         //Versions Trads
        var optionsGF_VERSAO_TRADS = {
            "tableId": "GF_VERSAO_TRADS",
            "table": "GF_VERSAO_TRADS",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_PLANO_FORM": {"type": "number"},
                    "DT_INI_PLANO_FORM": {"type": "date"},
                    "ID_VERSAO": {"type": "number"},
                    "DT_INI_VERSAO": {"type": "date"},                    
                    "CD_LINGUA": {"type": "number"},                    
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "GF_VERSOES": {
                    "EMPRESA": "EMPRESA",
                    "ID_PLANO_FORM": "ID_PLANO_FORM",
                    "DT_INI_PLANO_FORM": "DT_INI_PLANO_FORM",
                    "ID_VERSAO": "ID_VERSAO",
                    "DT_INI_VERSAO": "DT_INI_VERSAO"
                }
            },
            "order_by": "CD_LINGUA, DT_INI DESC",
            "recordBundle": 4,
            "pageLenght": 4,
            "scrollY": "117",
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
                    "data": 'EMPRESA',
                    "name": 'EMPRESA',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_PLANO_FORM',
                    "name": 'ID_PLANO_FORM',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_PLANO_FORM',
                    "name": 'DT_INI_PLANO_FORM',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_VERSAO',
                    "name": 'ID_VERSAO',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_VERSAO',
                    "name": 'DT_INI_VERSAO',
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
                            "create": " AND A.ATIVO = 'S'", //On-New-Record
                            "edit": " AND A.ATIVO = 'S'", //On-Edit-Record
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
                        return GF_VERSAO_TRADS.crudButtons(true,true,true);
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
        GF_VERSAO_TRADS = new QuadTable();
        GF_VERSAO_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsGF_VERSAO_TRADS));
        //END Versions Trads

        //Budget
        var optionsGF_ORCAMENTOS = {
            "tableId": "GF_ORCAMENTOS",
            "table": "GF_ORCAMENTOS",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_PLANO_FORM": {"type": "number"},
                    "DT_INI_PLANO_FORM": {"type": "date"},
                    "ID_VERSAO": {"type": "number"},
                    "DT_INI_VERSAO": {"type": "date"},                    
                    "ID_ORCAMENTO": {"type": "number"},                    
                    "DT_INI_ORCAMENTO": {"type": "date"}
                }
            },
            "dependsOn": {
                "GF_VERSOES": {
                    "EMPRESA": "EMPRESA",
                    "ID_PLANO_FORM": "ID_PLANO_FORM",
                    "DT_INI_PLANO_FORM": "DT_INI_PLANO_FORM",
                    "ID_VERSAO": "ID_VERSAO",
                    "DT_INI_VERSAO": "DT_INI_VERSAO"
                }
            },
            "order_by": "ID_ORCAMENTO DESC, DT_INI_ORCAMENTO DESC",
            "recordBundle": 4,
            "pageLenght": 4,
            "scrollY": "117",
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
                    "data": 'EMPRESA',
                    "name": 'EMPRESA',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_PLANO_FORM',
                    "name": 'ID_PLANO_FORM',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_PLANO_FORM',
                    "name": 'DT_INI_PLANO_FORM',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_VERSAO',
                    "name": 'ID_VERSAO',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_VERSAO',
                    "name": 'DT_INI_VERSAO',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'ID_ORCAMENTO',
                    "name": 'ID_ORCAMENTO',
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_ORCAMENTO',
                    "name": 'DT_INI_ORCAMENTO',
                    "datatype": 'date',
                    "def": hoje(),
                    "className": "visibleColumn",
                    "attr": {
                        "class": "form-control datepicker"
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DSP_ORCAMENTO',
                    "name": 'DSP_ORCAMENTO',                    
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_ORCAMENTO',
                    "name": 'DSR_ORCAMENTO',
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 6, 
                    "title": "<?php echo mb_strtoupper($ui_attendees, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_attendees; ?>", //Editor
                    "data": 'NR_PARTICIPANTES',
                    "name": 'NR_PARTICIPANTES',                    
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 30%;",
                    }                    
                }, {
                    "responsivePriority": 5, 
                    "title": "<?php echo mb_strtoupper($ui_budgeted, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_budgeted; ?>", //Editor
                    "data": 'ORCAMENTADO',
                    "name": 'ORCAMENTADO',                    
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 30%;",
                    }    
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_GRP_FUNC',
                    "name": 'ID_GRP_FUNC',
                    "type": "hidden",
                    "visible": false,
                    "className": ""                 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_GRP_FUNC',
                    "name": 'DT_INI_GRP_FUNC',
                    "type": "hidden",
                    "visible": false,
                    "datatype": 'date'
                }, {
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_functional_group, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_functional_group; ?>",
                    "data": 'DSP_GRP_FUNC',
                    "name": 'DSP_GRP_FUNC',
                    "type": "select",
                    "className": "none visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "GRP_FUNC",
                        "dependent-level": 1,
                        "deferred": true,
                        "data-db-name": 'A.EMPRESA@A.ID_GRP_FUNC@A.DT_INI_GRP_FUNC',
                        "decodeFromTable": 'RH_DEF_GRUPOS_FUNCIONAIS A',
                        "desigColumn": "CONCAT(CONCAT(A.ID_GRP_FUNC,'-'),A.DSP_GRP_FUNC)", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.                        
                        "orderBy": "A.ID_GRP_FUNC", //usado no complexList.php
                        "class": "form-control complexList chosen",
                        //"disabled": true, //Permite inibir o campo no Editor
                        "filter": {
                            "create": " AND A.DT_FIM_GRP_FUNC IS NULL AND A.EMPRESA = ':EMPRESA'", //On-New-Record
                            "edit": " AND A.DT_FIM_GRP_FUNC IS NULL AND A.EMPRESA = ':EMPRESA'", //On-Edit-Record
                        }                
                    }                    
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_FUNCAO',
                    "name": 'ID_FUNCAO',
                    "type": "hidden",
                    "visible": false,
                    "className": ""                    
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'TP_FUNCAO',
                    "name": 'TP_FUNCAO',
                    "type": "hidden",
                    "visible": false,
                    "className": ""        
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_FUNCAO',
                    "name": 'DT_INI_FUNCAO',
                    "type": "hidden",
                    "visible": false,
                    "datatype": 'date'
                }, {
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_function, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_function; ?>",
                    "data": 'DSP_FUNCAO',
                    "name": 'DSP_FUNCAO',
                    "type": "select",
                    "className": "none visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "FUNCOES",
                        "dependent-level": 1,
                        "deferred": true,
                        "data-db-name": 'A.EMPRESA@A.ID_FUNCAO@A.TP_REGISTO@A.DT_INI_FUNCAO',
                        "distribute-value": 'EMPRESA@ID_FUNCAO@TP_FUNCAO@DT_INI_FUNCAO',
                        "decodeFromTable": 'RH_DEF_FUNCOES A',
                        "desigColumn": "CONCAT(CONCAT(A.ID_FUNCAO,'-'),A.DSP_FUNCAO)", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.                        
                        "orderBy": "A.ID_FUNCAO", //usado no complexList.php
                        "class": "form-control complexList chosen",
                        //"disabled": true, //Permite inibir o campo no Editor
                        "filter": {
                            "create": " AND A.TP_REGISTO = 'A' AND A.DT_FIM_FUNCAO IS NULL AND A.EMPRESA = ':EMPRESA'", //On-New-Record
                            "edit": " AND A.TP_REGISTO = 'A' AND A.DT_FIM_FUNCAO IS NULL AND A.EMPRESA = ':EMPRESA'", //On-Edit-Record
                        }                
                    }        
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_ESTRUTURA',
                    "name": 'CD_ESTRUTURA',
                    "type": "hidden",
                    "visible": false,
                    "className": ""                 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_ESTRUTURA',
                    "name": 'DT_INI_ESTRUTURA',
                    "type": "hidden",
                    "visible": false,
                    "datatype": 'date'
                }, {
                    "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                    "title": "<?php echo mb_strtoupper($ui_structure, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_structure; ?>",
                    "data": 'DSP_ESTRUTURA',
                    "name": 'DSP_ESTRUTURA',
                    "type": "select",
                    "className": "none visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "ESTRUTURA",
                        "dependent-level": 1,
                        "deferred": true,
                        "data-db-name": 'A.EMPRESA@A.CD_ESTRUTURA@A.DT_INI_ESTRUTURA',
                        "decodeFromTable": 'DG_ESTRUTURAS A',
                        "desigColumn": "CONCAT(CONCAT(A.CD_ESTRUTURA,'-'),A.DSP_ESTRUTURA)", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.                        
                        "orderBy": "NVL(A.CD_ESTRUTURA, A.NR_ORDEM)", //usado no complexList.php
                        "class": "form-control complexList chosen",
                        //"disabled": true, //Permite inibir o campo no Editor
                        "filter": {
                            "create": " AND A.DT_FIM_ESTRUTURA IS NULL AND A.EMPRESA = ':EMPRESA'", //On-New-Record
                            "edit": " AND A.DT_FIM_ESTRUTURA IS NULL AND A.EMPRESA = ':EMPRESA'", //On-Edit-Record
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
                    "data": 'DT_FIM_ORCAMENTO',
                    "name": 'DT_FIM_ORCAMENTO',
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
                        return GF_ORCAMENTOS.crudButtons(true,true,true);
                    }
                }
            ],
            validations: {
                rules: {
                    ID_ORCAMENTO: {
                        required: true,
                    },
                    DT_INI_ORCAMENTO: {
                        required: true,
                        dateISO: true,
                    },
                    DSP_ORCAMENTO: {
                        required: true,
                        maxlength: 80,
                    },
                    DSR_ORCAMENTO: {
                        required: true,
                        maxlength: 25,
                    },
                    NR_PARTICIPANTES: {
                        integer: true
                    },
                    ORCAMENTADO: {
                        number: true
                    },                    
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                    "DT_FIM_ORCAMENTO": {
                        dateISO: true,
                        dateEqOrNextThan: "DT_INI_ORCAMENTO",
                    }
                },
                "messages": {
                    "DT_FIM_ORCAMENTO": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        GF_ORCAMENTOS = new QuadTable();
        GF_ORCAMENTOS.initTable($.extend({}, datatable_instance_defaults, optionsGF_ORCAMENTOS));
        //END Budget

        //Interactions
        var optionsGF_INTERACOES = {
            "tableId": "GF_INTERACOES",
            "table": "GF_INTERACOES",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_PLANO_FORM": {"type": "number"},
                    "DT_INI_PLANO_FORM": {"type": "date"},
                    "ID_VERSAO": {"type": "number"},
                    "DT_INI_VERSAO": {"type": "date"},                    
                    "ID_INTERACAO": {"type": "number"}
                }
            },
            "dependsOn": {
                "GF_VERSOES": {
                    "EMPRESA": "EMPRESA",
                    "ID_PLANO_FORM": "ID_PLANO_FORM",
                    "DT_INI_PLANO_FORM": "DT_INI_PLANO_FORM",
                    "ID_VERSAO": "ID_VERSAO",
                    "DT_INI_VERSAO": "DT_INI_VERSAO"
                }
            },
            "order_by": "ID_INTERACAO ASC",
            "recordBundle": 4,
            "pageLenght": 4,
            "scrollY": "117",
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
                    "data": 'EMPRESA',
                    "name": 'EMPRESA',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_PLANO_FORM',
                    "name": 'ID_PLANO_FORM',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_PLANO_FORM',
                    "name": 'DT_INI_PLANO_FORM',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_VERSAO',
                    "name": 'ID_VERSAO',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_VERSAO',
                    "name": 'DT_INI_VERSAO',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'ID_INTERACAO',
                    "name": 'ID_INTERACAO',
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DSP_INTERACAO',
                    "name": 'DSP_INTERACAO',                    
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_INTERACAO',
                    "name": 'DSR_INTERACAO',
                    "className": "visibleColumn",
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_SITUACAO',
                    "name": 'ID_SITUACAO',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_SIT',
                    "name": 'DT_INI_SIT',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'TP_SITUACAO',
                    "name": 'TP_SITUACAO',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 5, 
                    "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                    "title": "<?php echo mb_strtoupper($ui_measure_type, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_measure_type; ?>",
                    "data": 'DSP_MEDIDA',
                    "name": 'DSP_MEDIDA',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "TIPO_MEDIDA",
                        "dependent-level": 1,
                        "data-db-name": "A.ID_SITUACAO@A.DT_INI_SIT@A.TP_SITUACAO",
                        "decodeFromTable": 'GF_SITUACOESA',
                        "desigColumn": "A.DSP_SIT", 
                        "whereClause": "AND A.TP_SITUACAO = 'D'", //Estado: 'D', Medida: 'E'
                        "orderBy": "A.ID_SITUACAO",
                        "class": "form-control complexList chosen",
                        //"disabled": true, //Permite inibir o campo no Editor
                        "filter": {
                            "create": " AND A.DT_FIM_SIT IS NULL", //On-New-Record
                            "edit": " AND A.DT_FIM_SIT IS NULL", //On-Edit-Record
                        }                
                    }
                }, {
                    "responsivePriority": 6,
                    "title": "<?php echo mb_strtoupper($ui_measure_type_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_measure_type_date; ?>", //Editor
                    "data": 'DT_TP_MEDIDA',
                    "name": 'DT_TP_MEDIDA',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_SITUACAO_ESTADO',
                    "name": 'ID_SITUACAO_ESTADO',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_SIT_ESTADO',
                    "name": 'DT_INI_SIT_ESTADO',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'TP_SITUACAO_ESTADO',
                    "name": 'TP_SITUACAO_ESTADO',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 7, 
                    "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                    "title": "<?php echo mb_strtoupper($ui_status, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_status; ?>",
                    "data": 'DSP_SITUACAO',
                    "name": 'DSP_SITUACAO',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "ESTADO",
                        "dependent-level": 1,
                        "data-db-name": "ID_SITUACAO@DT_INI_SIT@TP_SITUACAO",
                        "distribute-value": "ID_SITUACAO_ESTADO@DT_INI_SIT_ESTADO@TP_SITUACAO_ESTADO",
                        "decodeFromTable": 'GF_SITUACOES',
                        "desigColumn": "DSP_SIT", 
                        "whereClause": "AND TP_SITUACAO = 'D'", //Estado: 'D', Medida: 'E'
                        "orderBy": "ID_SITUACAO",
                        "class": "form-control complexList chosen",
                        //"disabled": true, //Permite inibir o campo no Editor
                        "filter": {
                            "create": " AND DT_FIM_SIT IS NULL", //On-New-Record
                            "edit": " AND DT_FIM_SIT IS NULL", //On-Edit-Record
                        }                
                    }
                }, {
                    "responsivePriority": 8,
                    "title": "<?php echo mb_strtoupper($ui_status_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_status_date; ?>", //Editor
                    "data": 'DT_ESTADO',
                    "name": 'DT_ESTADO',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_CURSO',
                    "name": 'ID_CURSO',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'TP_REGISTO',
                    "name": 'TP_REGISTO',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_CURSO',
                    "name": 'DT_INI_CURSO',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                    "title": "<?php echo mb_strtoupper($ui_course, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_course; ?>",
                    "data": 'DSP_CURSO',
                    "name": 'DSP_CURSO',
                    "type": "select",
                    "className": "none visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "CURSOS",
                        "dependent-level": 1,
                        "deferred": true,
                        "data-db-name": "EMPRESA@ID_CURSO@TP_REGISTO@DT_INI_CURSO",
                        //"distribute-value": "",
                        "decodeFromTable": 'GF_CURSOS',
                        "desigColumn": "DSP_CURSO", 
                        "whereClause": "AND TP_REGISTO = 'C'",
                        "orderBy": "ID_CURSO",
                        "class": "form-control complexList chosen",
                        //"disabled": true, //Permite inibir o campo no Editor
                        "filter": {
                            "create": " AND DT_FIM_CURSO IS NULL AND EMPRESA = ':EMPRESA'", //On-New-Record
                            "edit": " AND DT_FIM_CURSO IS NULL AND EMPRESA = ':EMPRESA'", //On-Edit-Record
                        }                
                    }    
              }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_ACAO',
                    "name": 'ID_ACAO',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_ACAO',
                    "name": 'DT_INI_ACAO',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 7, 
                    "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                    "title": "<?php echo mb_strtoupper($ui_course, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_course; ?>",
                    "data": 'DSP_ACAO',
                    "name": 'DSP_ACAO',
                    "type": "select",
                    "className": "none visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "CURSOS",
                        "dependent-level": 2,
                        "data-db-name": "A.EMPRESA@A.ID_CURSO@A.TP_REGISTO@A.DT_INI_CURSO@A.ID_ACAO@A.DT_INI_ACAO",
                        //"distribute-value": "",
                        "decodeFromTable": 'GF_ACOES A',
                        "desigColumn": "A.DSP_ACAO", 
                        "whereClause": "AND A.TP_REGISTO = 'C'",
                        "orderBy": "A.ID_CURSO",
                        "class": "form-control complexList chosen",
                        //"disabled": true, //Permite inibir o campo no Editor
                        "filter": {
                            "create": " AND A.DT_FIM_ACAO IS NULL", //On-New-Record
                            "edit": " AND A.DT_FIM_ACAO IS NULL", //On-Edit-Record
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
                        return GF_INTERACOES.crudButtons(true,true,true);
                    }
                }
            ],
            validations: {
                rules: {
                    ID_INTERACAO: {
                        required: true,
                    },
                    DSP_INTERACAO: {
                        required: true,
                        maxlength: 80,
                    },
                    DSR_INTERACAO: {
                        required: true,
                        maxlength: 25,
                    },
                    DSP_MEDIDA: {
                        required: true,
                    },
                    DSP_SITUACAO: {
                        required: true,
                    },
                    DT_ESTADO: {
                        dateISO: true,
                    },
                    DT_TP_MEDIDA: {
                        dateISO: true,
                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                }
            }
        };
        GF_INTERACOES = new QuadTable();
        GF_INTERACOES.initTable($.extend({}, datatable_instance_defaults, optionsGF_INTERACOES));
        //END Interactions 
        
    });
</script>
