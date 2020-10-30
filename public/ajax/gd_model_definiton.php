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
                            <a class="nav-link active" data-toggle="tab" href="#Tab1" role="tab" aria-selected="true"><?php echo $ui_types; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab2" role="tab" aria-selected="true"><?php echo $ui_models; ?></a>
                        </li>
                    </ul>
                </div>
            </div>   
            
            <div class="panel-container show">
                <div class="panel-content">
                    
                    <div class="tab-content">

                         <!-- TAB #1 -->
                        <div class="tab-pane fade active show" id="Tab1" role="tabpanel">
                            <a id="dg_gestao_docs_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="dg_gestao_docs" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                        </div>
                         <!-- END TAB #1 -->

                         <!-- TAB #2 -->
                        <div class="tab-pane fade" id="Tab2" role="tabpanel">
                            <a id="dg_det_gestao_docs_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="dg_det_gestao_docs" class="table responsive table-bordered table-striped table-hover nowrap"></table>

                            <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-start">
                                <div class="panel-toolbar pr-3 align-self-end">
                                    <ul id="panel-tab-2-1" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#Tab21" role="tab" aria-selected="true"><?php echo $ui_applicability; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Tab22" role="tab" aria-selected="true"><?php echo $ui_variables; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Tab23" role="tab" aria-selected="true"><?php echo $ui_documents; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Tab24" role="tab" aria-selected="true"><?php echo $ui_workflow; ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-container show">
                                <div class="panel-content">
                                    <div class="tab-content">
                                        <div class="tab-pane fade active show" id="Tab21" role="tabpanel">
                                            <a id="dg_gd_fundamentacao_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="dg_gd_fundamentacao" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                        </div>
                                        <div class="tab-pane fade" id="Tab22" role="tabpanel">
                                            <a id="dg_gd_variaveis_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="dg_gd_variaveis" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                        </div>                                        
                                        <div class="tab-pane fade" id="Tab23" role="tabpanel">
                                            <a id="dg_gd_templates_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="dg_gd_templates" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                        </div>                                        
                                        <div class="tab-pane fade" id="Tab24" role="tabpanel">
                                            <a id="dg_gd_fases_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="dg_gd_fases" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                                                        
                        </div>
                         <!-- END TAB #2 -->
                        
                         <!-- TAB #3 -->
                        <div class="tab-pane fade" id="Tab3" role="tabpanel">
                            Tab #3
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
    
    var y = "<?php echo @$_SESSION['lang']; ?>";

    $(document).ready(function () {
        //Gestão Documental :: TIPOS
        var optionDg_Gestao_Docs = {
            "tableId": 'dg_gestao_docs',
            //"order": false, //DISABLES ORDER BY Button FROM INSTANCE!!!
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_type; ?>",
/*            
            "docsTable": { //File upload
                name: "RH_ID_TIMESHEET_LEO_DOCS",//nome da tabela onde vão ser guardados os uploads
                //mapeamos campos da tabela de documentos para campos do PK para o documento ficar ligado á TIMESHEET
                pk: [
                    {'ID_TIMESHEET': 'RHID'},
                    {'SEQ_TIMESHEET': 'RHID'}
                ],
                saveAsBlob: true, //false:: grava no filesystem (path no servidor) || true :: grava na base de dados
                fnName: "TSHET_LEO_ANEXOS_DOC(RHID,RHID)",// função com os parametros
                savePath: "tmp", //caminho onde vão ser guardados os ficheiros se saveAsBlob= false
                blobEndPoint: datatable_instance_defaults.pathToSqlFile + "blobEndpoint.php" //caminho do ficheiro que permite download de blobs
            },   
*/                    
            "table": "DG_GESTAO_DOCUMENTAL", 
            "pk": {
                "primary": {
                    "CD_GD": {"type": "number"},
                    "DT_INI_GD": {"type": "date"}            
                }
            },                    
            "order_by": "CD_GD",
            "recordBundle": 12, 
            "pageLenght": 12,
            "scrollY": "390",
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
                    //"sTitle": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    //"title": "<?php echo $ui_code; ?>", //Available on Editor to replace label (quadTable.js line 632)
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables                    
                    "label": "<?php echo $ui_code; ?>", //Editor :: Not available on Sequence label
                    "data": 'CD_GD',
                    "name": 'CD_GD',
                    "datatype": 'sequence',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": true,
                    "className": "visibleColumn",                      
                }, {
                    //"targets": 2,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_GD',
                    "name": 'DT_INI_GD',
                    "datatype": 'date',
                    "def": "1900-01-01", // hoje() OR hoje('minutes') OR "def": hoje('seconds')
                    "className": "visibleColumn",                
                    "attr": {
                        "name": 'DT_INI_GD',
                        "class": "datepicker" 
                    }
                }, {
                    //"targets": 3,
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP',
                    "name": 'DSP',
                    "className": "visibleColumn"
                }, {
                    //"targets": 4,
                    "title": "<?php echo mb_strtoupper($ui_internal_reference_short, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_internal_reference_short; ?>", //Editor
                    "data": 'REF_INTERNA',
                    "name": 'REF_INTERNA',
                    "className": "visibleColumn",            
                }, {
                    //"targets": 5,
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
                    //"targets": 6,
                    "title": "<?php echo mb_strtoupper($ui_graph, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_graph.'?'; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_gd_graph; ?>",
                    "data": 'GRAFICOS',
                    "name": 'GRAFICOS',
                    "type": "select",
                    "className": "visibleColumn",
                    attr: {
                        "domain-list": true,
                        "dependent-group": 'GD_GRAFICOS',
                        "class": "form-control",
                        "name": 'GRAFICOS',
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['GD_GRAFICOS'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }                    
                }, {                    
                    //"targets": 7,
                    "title": "<?php echo mb_strtoupper($ui_description, 'UTF-8'); ?>"+'</span>', //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DESCRICAO',
                    "name": 'DESCRICAO',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "name": "DESCRICAO",
                        "style": "max-width: 335px", 
                    },
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
                    //"targets": 12,
                    "responsivePriority": 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        //debugger;
                        return dg_gestao_docs.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "CD_GD": {
                        required: true,
                        integer: true,
                    },
                    "DT_INI_GD": {
                        required: true,
                        dateISO: true,
                    },
                    "DSP": {
                        required: true,
                        maxlength: 80,
                    },
                    "REF_INTERNA": {
                        maxlength: 50,
                    },
                    "DESCRICAO": {
                        maxlength: 4000,
                    },
                    "DT_FIM": {
                        dateISO: true,
                        dateEqOrNextThan: 'DT_INI_GD'
                    },     
                },
                /* Se aqui definido sobrepõem-se ao definido em /inc/scripts.php*/
                "messages": {
                    "DT_FIM": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        dg_gestao_docs = new QuadTable();
        dg_gestao_docs.initTable( $.extend({}, datatable_instance_defaults, optionDg_Gestao_Docs) );
        //END Gestão Documental

        //Details Gestão Documental :: MODELOS
        var optionDg_Det_Gestao_Docs = {
            //"sqlFile": "dg_det_gestao_documental_controller.php", // controller        
            "tableId": 'dg_det_gestao_docs',
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_model; ?>",
            "table": "DG_DET_GESTAO_DOCUMENTAL",
            //refreshData: true,
            "pk": {
                "primary": {
                    "CD_GD": {"type": "number"},
                    "DT_INI_GD": {"type": "date"},
                    "CD_DET_GD": {"type": "number"},
                    "DT_INI_DET_GD": {"type": "date"}            
                }
            },                   
            "order_by": "CD_DET_GD",
            "recordBundle": 5, 
            "pageLenght": 5,
            "scrollY": "117",
            "responsive": true,
            "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
            "crudOnMasterInactive": {
                "condition": "data.DT_FIM !== null",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },    
            "detailsObjects": ['dg_gd_fundamentacao', 'dg_gd_variaveis', 'dg_gd_templates','dg_gd_fases'],
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
                    "sTitle": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Available on Editor to replace label (quadTable.js line 632)
                    "label": "<?php echo $ui_code; ?>", //Editor :: Not available on Sequence label
                    "data": 'CD_GD',
                    "name": 'CD_GD',
                    //"datatype": 'sequence',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": false,
                    "className": "visibleColumn",                      
                }, {
                    //"targets": 2,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_GD',
                    "name": 'DT_INI_GD',
                    "datatype": 'date',
                    "visible": false,                    
                    "type": "hidden",
                    "className": "visibleColumn",                
                    "attr": {
                        "name": 'DT_INI_GD',
                        "class": "datepicker" 
                    }
                }, {
                    //"targets": 3,
                    "complexList": true, 
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_type, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_type; ?>",
                    "data": 'DSP_GD',
                    "name": 'DSP_GD',
                    "type": "select",
                    "className": "visibleColumn",
                    "renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-level": 1,
                        "dependent-group": "TIPOS_GD",
                        "data-db-name": "A.CD_GD@A.DT_INI_GD",
                        "decodeFromTable": "DG_GESTAO_DOCUMENTAL A",
                        "desigColumn": "CONCAT(CONCAT(A.CD_GD,'-'),A.DSP)", 
                        "orderBy": "A.CD_GD",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": ' AND A.DT_FIM IS NULL', //On-New-Record
                            "edit": ' AND A.DT_FIM IS NULL', //On-Edit-Record
                        }                        
                    }           
                }, {
                    //"targets": 4,
                    "sTitle": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "title": "<?php echo $ui_code; ?>", //Available on Editor to replace label (quadTable.js line 632)
                    "label": "<?php echo $ui_code; ?>", //Editor :: Not available on Sequence label
                    "data": 'CD_DET_GD',
                    "name": 'CD_DET_GD',
                    "datatype": 'sequence',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": true,
                    "className": "visibleColumn",  
                }, {
                    //"targets": 5,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_DET_GD',
                    "name": 'DT_INI_DET_GD',
                    "datatype": 'date',
                    "def": "1900-01-01", // hoje() OR hoje('minutes') OR "def": hoje('seconds')
                    "className": "visibleColumn",                
                    "attr": {
                        "name": 'DT_INI_DET_GD',
                        "class": "datepicker" 
                    }                    
                }, {
                    //"targets": 6,
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP',
                    "name": 'DSP',
                    "className": "visibleColumn"
                }, {
                    //"targets": 7,
                    "title": "<?php echo mb_strtoupper($ui_internal_reference_short, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_internal_reference_short; ?>", //Editor
                    "data": 'REF_INTERNA',
                    "name": 'REF_INTERNA',
                    "className": "visibleColumn",            
                }, {
                    //"targets": 8,
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
                    //"targets": 9,
                    "title": "<?php echo mb_strtoupper($ui_warning_days, 'UTF-8'); ?>"+'</span>', //Datatables
                    "label": "<?php echo $ui_warning_days; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_warning_days; ?>",
                    "data": 'NR_DIAS_AVISO',
                    "name": 'NR_DIAS_AVISO',
                    "className": "none visibleColumn",                    
                    "attr": {
                        "name": 'NR_DIAS_AVISO',
                        "style": "width: 20%;",
                    }                    
                }, {                    
                    //"targets": 10,
                    "title": "<?php echo mb_strtoupper($ui_final_actions, 'UTF-8'); ?>"+'</span>', //Datatables
                    "label": "<?php echo $ui_final_actions; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_gd_doc_final_action; ?>",
                    "data": 'ACCOES_FINAIS',
                    "name": 'ACCOES_FINAIS',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "name": 'ACCOES_FINAIS',
                        "style": "max-width: 335px",
                    }
                }, {                    
                    //"targets": 11,
                    "title": "<?php echo mb_strtoupper($ui_description, 'UTF-8'); ?>"+'</span>', //Datatables
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
                        return dg_det_gestao_docs.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "CD_GD": {
                        required: true,
                        integer: true,
                    },
                    "DT_INI_GD": {
                        required: true,
                        dateISO: true,
                    },               
                    "CD_DET_GD": {
                        required: true,
                        integer: true,
                    },
                    "DT_INI_DET_GD": {
                        required: true,
                        dateISO: true,
                    },                    
                    "DSP": {
                        required: true,
                        maxlength: 80,
                    },
                    "REF_INTERNA": {
                        maxlength: 50,
                    },
                    "NR_DIAS_AVISO": {
                        integer: true
                    },                    
                    "ACCOES_FINAIS": {
                        maxlength: 4000,
                    },
                    "DESCRICAO": {
                        maxlength: 4000,
                    },
                    "DT_FIM": {
                        dateISO: true,
                        dateEqOrNextThan: 'DT_INI_DET_GD'
                    },     
                },
                /* Se aqui definido sobrepõem-se ao definido em /inc/scripts.php*/
                "messages": {
                    "DT_FIM": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        dg_det_gestao_docs = new QuadTable();
        dg_det_gestao_docs.initTable( $.extend({}, datatable_instance_defaults, optionDg_Det_Gestao_Docs) );
        //END Details Gestão Documental

        //MODELOS -> Aplicabilidade
        var optionDg_Gd_Fundamentacao = {
            "tableId": 'dg_gd_fundamentacao',
            "table": "DG_GD_FUNDAMENTACAO",
            //refreshData: true,
            "pk": {
                "primary": {
                    "CD_GD": {"type": "number"},
                    "DT_INI_GD": {"type": "date"},
                    "CD_DET_GD": {"type": "number"},
                    "DT_INI_DET_GD": {"type": "date"},
                    "CD_FUNDAMENTO": {"type": "number"},
                    "DT_INI_FUND": {"type": "date"}
                }
            },
            "dependsOn": {
                "dg_det_gestao_docs": {
                    //External object key mapping( object key : external key)
                    "CD_GD": "CD_GD",
                    "DT_INI_GD": "DT_INI_GD",
                    "CD_DET_GD": "CD_DET_GD",
                    "DT_INI_DET_GD": "DT_INI_DET_GD"
                }
            },            
            "order_by": "CD_FUNDAMENTO",
            "recordBundle": 5, 
            "pageLenght": 5,
            "scrollY": "156",
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
                    "title": "<?php echo mb_strtoupper($ui_type, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_type; ?>", //Editor
                    "data": 'CD_GD',
                    "name": 'CD_GD',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": false,
                    "className": "visibleColumn",                      
                }, {
                    //"targets": 2,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_GD',
                    "name": 'DT_INI_GD',
                    "datatype": 'date',
                    "visible": false,                    
                    "type": "hidden",
                    "className": "visibleColumn",                
                    "attr": {
                        "name": 'DT_INI_GD',
                        "class": "datepicker" 
                    }
                }, {
                    //"targets": 3,
                    "title": "<?php echo mb_strtoupper($ui_model, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_model; ?>", //Editor
                    "data": 'CD_DET_GD',
                    "name": 'CD_DET_GD',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": false,
                    "className": "visibleColumn",  
                }, {
                    //"targets": 4,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_DET_GD',
                    "name": 'DT_INI_DET_GD',
                    "datatype": 'date',
                    "visible": false,                    
                    "type": "hidden",                    
                    "className": "visibleColumn",                
                    "attr": {
                        "name": 'DT_INI_DET_GD',
                        "class": "datepicker"
                    }             
                }, {
                    //"targets": 5,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Available on Editor to replace label (quadTable.js line 632)
                    "label": "<?php echo $ui_code; ?>", //Editor :: Not available on Sequence label
                    "data": 'CD_FUNDAMENTO',
                    "name": 'CD_FUNDAMENTO',
                    "datatype": 'sequence',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": true,
                    "className": "visibleColumn",  
                }, {
                    //"targets": 6,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_FUND',
                    "name": 'DT_INI_FUND',
                    "datatype": 'date',
                    "def": "1900-01-01", // hoje() OR hoje('minutes') OR "def": hoje('seconds')
                    "className": "visibleColumn",                
                    "attr": {
                        "name": 'DT_INI_FUND',
                        "class": "datepicker" 
                    }                    
                }, {
                    //"targets": 7,
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP',
                    "name": 'DSP',
                    "className": "visibleColumn"  
              }, {
                    //"targets": 8,
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_admission_purpose, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_admission_purpose; ?>", //Editor
                    "data": 'MOTIVO_ADMISSAO',
                    "name": 'MOTIVO_ADMISSAO',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'RH_MOTIVO_ADMISSAO',
                        "class": "form-control",
                        "name": 'MOTIVO_ADMISSAO',
                        /*
                        "style": "width: 40%;",
                        "showValues":{
                            "RV_LOW_VALUE": "RV_ABBREVIATION"
                        }   
                        */
                    },
                    "render": function (val, type, row) {
                        if (typeof (val) === "object" && val === null) {
                            return '<span class="timelogValue">&nbsp;</span>';
                        } else {
                            var o = _.find(initApp.joinsData['RH_MOTIVO_ADMISSAO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING']; //o['RV_ABBREVIATION'] ????
                        } 
                    }         
                }, {
                    //"targets": 9,
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'EMPRESA',
                    "name": 'EMPRESA',
                    "type": "hidden",
                    "visible": false,
                    "className": "visibleColumn",  
                }, {
                    //"targets": 10,
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_company, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_company; ?>",
                    "fieldInfo": "<?php echo $hint_use_to_narrow_down_scope; ?>",
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
                    //"targets": 11,
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_ESTAB',
                    "name": 'CD_ESTAB',
                    "type": "hidden",
                    "visible": false,
                    "className": "visibleColumn",  
                }, {
                    //"targets": 12,
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_facility, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_facility; ?>",
                    "fieldInfo": "<?php echo $hint_use_to_narrow_down_scope; ?>",
                    "data": 'DSP_ESTAB',
                    "name": 'DSP_ESTAB',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "EMPRESA",
                        "dependent-level": 2,
                        "data-db-name": "A.EMPRESA@A.CD_ESTAB",
                        "decodeFromTable": "DG_ESTABELECIMENTOS A", //TO CHANGE ON QUAD-HCM
                        "desigColumn": "A.DSP_ESTAB", 
                        "whereClause": '',
                        "orderBy": "A.EMPRESA,A.CD_ESTAB",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.ACTIVO = 'S' ", //On-New-Record
                            "edit": " AND A.ACTIVO = 'S' ", //On-Edit-Record
                        }
                    }                               
                }, {
                    //"targets": 13,
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
                    //"targets": 14,
                    "title": "<?php echo mb_strtoupper($ui_applicability_periods, 'UTF-8'); ?>"+'</span>', //Datatables
                    "label": "<?php echo $ui_applicability_periods; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_applicability_periods; ?>",
                    "data": 'PERIODOS_APLICABILIDADE',
                    "name": 'PERIODOS_APLICABILIDADE',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "name": 'PERIODOS_APLICABILIDADE',
                        "style": "max-width: 335px",
                    }
                }, {                    
                    //"targets": 15,
                    "title": "<?php echo mb_strtoupper($ui_description, 'UTF-8'); ?>"+'</span>', //Datatables
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
                    //"targets": 20,
                    "responsivePriority": 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        //debugger;
                        return dg_gd_fundamentacao.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "CD_GD": {
                        required: true,
                        integer: true,
                    },
                    "DT_INI_GD": {
                        required: true,
                        dateISO: true,
                    },               
                    "CD_DET_GD": {
                        required: true,
                        integer: true,
                    },
                    "DT_INI_DET_GD": {
                        required: true,
                        dateISO: true,
                    },
                    "DT_INI_FUND": {
                        required: true,
                        dateISO: true,
                    },     
                    "DSP": {
                        required: true,
                        maxlength: 80,
                    },
                    "MOTIVOS_ADMISSAO": {
                        maxlength: 2,
                    },
                    "PERIODOS_APLICABILIDADE": {
                        maxlength: 4000,
                    },
                    "DESCRICAO": {
                        maxlength: 4000,
                    },
                    "DT_FIM": {
                        dateISO: true,
                        dateEqOrNextThan: 'DT_INI_FUND'
                    },     
                },
                /* Se aqui definido sobrepõem-se ao definido em /inc/scripts.php*/
                "messages": {
                    "DT_FIM": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        dg_gd_fundamentacao = new QuadTable();
        dg_gd_fundamentacao.initTable( $.extend({}, datatable_instance_defaults, optionDg_Gd_Fundamentacao) );
        //END MODELOS -> Aplicabilidade

        //MODELOS -> Variáveis
        var optionDg_Gd_Variaveis = {
            "tableId": 'dg_gd_variaveis',
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_variable; ?>",            
            "table": "DG_GD_VARIAVEIS",
            //refreshData: true,
            "pk": {
                "primary": {
                    "CD_GD": {"type": "number"},
                    "DT_INI_GD": {"type": "date"},
                    "CD_DET_GD": {"type": "number"},
                    "DT_INI_DET_GD": {"type": "date"},
                    "COD_VAR": {"type": "varchar"},
                    "DT_INI_VAR": {"type": "date"},
                    "DT_INI_FRM": {"type": "date"}
                }
            },
            "dependsOn": {
                "dg_det_gestao_docs": {
                    //External object key mapping( object key : external key)
                    "CD_GD": "CD_GD",
                    "DT_INI_GD": "DT_INI_GD",
                    "CD_DET_GD": "CD_DET_GD",
                    "DT_INI_DET_GD": "DT_INI_DET_GD"
                }
            },
            //"detailsObjects": ['dg_gd_variavel_trads'],
            "order_by": "COD_VAR",
            "recordBundle": 5, 
            "pageLenght": 5,
            "scrollY": "156",
            "responsive": true,
            "pageResize": true, // PLUGIN :: dataTables.pageResize.min.js
            "tableCols": [     
                {
                    //"targets": 0,
                    "responsivePriority": 1,
                    "data": null,
                    "width": "1%", 
                    "className": "control toBottom toCenter details-control",
                    "orderable": false,
                    "defaultContent": ''
                }, {
                    //"targets": 1,
                    "title": "<?php echo mb_strtoupper($ui_type, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_type; ?>", //Editor
                    "data": 'CD_GD',
                    "name": 'CD_GD',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": false,
                    "className": "visibleColumn",                      
                }, {
                    //"targets": 2,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_GD',
                    "name": 'DT_INI_GD',
                    "datatype": 'date',
                    "visible": false,                    
                    "type": "hidden",
                    "className": "visibleColumn",                
                    "attr": {
                        "name": 'DT_INI_GD',
                        "class": "datepicker" 
                    }
                }, {
                    //"targets": 3,
                    "title": "<?php echo mb_strtoupper($ui_model, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_model; ?>", //Editor
                    "data": 'CD_DET_GD',
                    "name": 'CD_DET_GD',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": false,
                    "className": "visibleColumn",  
                }, {
                    //"targets": 4,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_DET_GD',
                    "name": 'DT_INI_DET_GD',
                    "datatype": 'date',
                    "visible": false,                    
                    "type": "hidden",                    
                    "className": "visibleColumn",                
                    "attr": {
                        "name": 'DT_INI_DET_GD',
                        "class": "datepicker"
                    }             
                }, {
                    //"targets": 5,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'COD_VAR',
                    "name": 'COD_VAR',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": false,
                    "className": "visibleColumn",  
                }, {
                    //"targets": 6,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_VAR',
                    "name": 'DT_INI_VAR',
                    "datatype": 'date',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": false,
                    "attr": {
                        "name": 'DT_INI_VAR',
                        "class": "datepicker"
                    }           
                }, {
                    //"targets": 7,
                    "complexList": true, 
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_variable, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_variable; ?>",
                    "data": 'DSP_VAR',
                    "name": 'DSP_VAR',
                    "type": "select",
                    "className": "visibleColumn",
                    "renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-level": 1,
                        "dependent-group": "DG_VARS",
                        "data-db-name": "A.COD_VAR@A.DT_INI_VAR",
                        "decodeFromTable": "DG_DEF_VARIAVEIS A",
                        "desigColumn": "A.LABEL", 
                        //"desigColumn": "CONCAT(CONCAT(COD_VAR,'-'),LABEL)", 
                        //"otherValues": "DESCRICAO", 
                        "orderBy": "A.COD_VAR",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": ' AND A.DT_FIM IS NULL', //On-New-Record
                            "edit": ' AND A.DT_FIM IS NULL', //On-Edit-Record
                        }                        
                    }                    
                }, {
                    //"targets": 8,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_FRM',
                    "name": 'DT_INI_FRM',
                    "datatype": 'date',
                    "def": "1900-01-01",
                    "className": "visibleColumn",
                    "attr": {
                        "name": 'DT_INI_FRM',
                        "class": "datepicker" 
                    }                    
                }, {
                    //"targets": 9,
                    "title": "<?php echo mb_strtoupper($ui_visible, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_visible; ?>", //Editor
                    "data": 'VISUALIZA',
                    "name": 'VISUALIZA',
                    "type": "select",                    
                    "className": "visibleColumn", 
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',
                        "class": "form-control",
                        "name": 'DT_FIM_OBRIGATORIA',
                        //"showValues":{
                        //    "RV_LOW_VALUE": "RV_ABBREVIATION"
                        //}
                    },
                    "render": function (val, type, row) {
                        if (typeof (val) === "object" && val === null) {
                            return val;
                        } else {
                            var o = _.find(initApp.joinsData['DG_SIM_NAO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING']; //o['RV_ABBREVIATION'] ????
                        } 
                    }                
                }, {
                    //"targets": 10,
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
                    //"targets": 10,
                    "title": "<?php echo mb_strtoupper($ui_order_nr, 'UTF-8'); ?>"+'</span>', //Datatables
                    "label": "<?php echo $ui_order_nr; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_order_number; ?>",
                    "data": 'NR_ORDEM',
                    "name": 'NR_ORDEM',
                    "className": "none right visibleColumn",
                    "attr": {
                        "name": 'NR_ORDEM',
                        "class": "toRight",
                        "style": "width: 20%;",
                    }               
                }, {                    
                    //"targets": 11,
                    "title": "<?php echo mb_strtoupper($ui_obs_short, 'UTF-8'); ?>"+'</span>', //Datatables
                    "label": "<?php echo $ui_obs_short; ?>", //Editor
                    "data": 'OBS',
                    "name": 'OBS',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "name": 'OBS',
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
                        return dg_gd_variaveis.crudButtons(true,true,true);
                    }
                }
            ],            
            "validations": {
                "rules": {
                    "CD_GD": {
                        required: true,
                        integer: true,
                    },
                    "DT_INI_GD": {
                        required: true,
                        dateISO: true,
                    },               
                    "CD_DET_GD": {
                        required: true,
                        integer: true,
                    },
                    "DT_INI_DET_GD": {
                        required: true,
                        dateISO: true,
                    },     
                    "DT_INI_FRM": {
                        required: true,
                        dateISO: true,
                    },     
                    "VISUALIZA": {
                        required: true,
                        maxlength: 1,
                    },
                    "NR_ORDEM": {
                        integer: true,
                    },
                    "OBS": {
                        maxlength: 4000,
                    },
                    "DT_FIM": {
                        dateISO: true,
                        dateEqOrNextThan: 'DT_INI_FRM'
                    },     
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                    "DT_FIM": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        dg_gd_variaveis = new QuadTable();
        dg_gd_variaveis.initTable( $.extend({}, datatable_instance_defaults, optionDg_Gd_Variaveis) );
        
        /* EDITOR EVENT
        if (1) {
            $(document).on('dg_gd_variaveisAttachEvt', function (e) {
                //A ESCOLHA DE UMA VARIÁVEL, mostra a respetiva descrição, contextualizando o utilizador sobre a sua aplicabilidade.
                $('#DTE_Field_DSP_VAR').on("change", function (e) {
                    var el = $('#dg_gd_variaveis_editorForm > div > div.DTE_Field.row.DTE_Field_Type_select.DTE_Field_Name_DSP_VAR.visibleColumn > div > div:nth-child(6)');
                    if ($(this).val()) {
                        el.html(''); //Mostrar o otherValues (DESCRICAO) da lista associada 
                    } else {
                        el.html('');
                    }
                });
            });
        }
        */
        //END MODELOS -> Variáveis
        
        //MODELOS -> Documentos
        var optionDg_Gd_Templates = {
            "tableId": 'dg_gd_templates',
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_document; ?>",            
            "table": "DG_GD_TEMPLATES",
            inRowDoc: {
                saveAsBlob:true,
                fileNameField: 'LINK_DOC',
                extField: 'BD_MIME',
                pathField: 'LINK_DOC',
                blobField:'BD_DOC',
                savePath:'tmp'
            },
            /* docsTable: {
                 name: "RH_ID_TIMESHEET_LEO_DOCS",//nome da tabela onde vão ser guardados os uploads
                 //mapeamos campos da tabela de documentos para campos do PK para o documento ficar ligado á TIMESHEET
                 pk: [
                     {'ID_TIMESHEET': 'RHID'},
                     {'SEQ_TIMESHEET': 'RHID'}
                 ],
                 column: 'whatevercolumn', //
                 saveAsBlob: true, // show name or show type of file?    //false || true
                 fnName: "TSHET_LEO_ANEXOS_DOC(RHID,RHID)",// função com os parametros
                 savePath: "tmp", //caminho onde vão ser guardados os ficheiros se saveAsBlob= false
                 blobEndPoint: datatable_instance_defaults.pathToSqlFile + "blobEndpoint.php" //caminho do ficheiro que permite download de blobs
             },*/

            //refreshData: true,
            "pk": {
                "primary": {
                    "CD_GD": {"type": "number"},
                    "DT_INI_GD": {"type": "date"},
                    "CD_DET_GD": {"type": "number"},
                    "DT_INI_DET_GD": {"type": "date"},
                    "CD_TEMPLATE": {"type": "number"},
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "dg_det_gestao_docs": {
                    //External object key mapping( object key : external key)
                    "CD_GD": "CD_GD",
                    "DT_INI_GD": "DT_INI_GD",
                    "CD_DET_GD": "CD_DET_GD",
                    "DT_INI_DET_GD": "DT_INI_DET_GD"
                }
            },
            "order_by": "CD_TEMPLATE",
            "recordBundle": 5, 
            "pageLenght": 5,
            "scrollY": "156",
            "responsive": true,
            "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
            "tableCols": [     
                {
                    //"targets": 0,
                    "responsivePriority": 1,
                    "data": null,
                    "width": "1%", 
                    "className": "control toBottom toCenter details-control",
                    "orderable": false,
                    "defaultContent": ''
                }, {
                    //"targets": 1,
                    "title": "<?php echo mb_strtoupper($ui_type, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_type; ?>", //Editor
                    "data": 'CD_GD',
                    "name": 'CD_GD',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": false,
                    "className": "visibleColumn",                      
                }, {
                    //"targets": 2,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_GD',
                    "name": 'DT_INI_GD',
                    "datatype": 'date',
                    "visible": false,                    
                    "type": "hidden",
                    "className": "visibleColumn",                
                    "attr": {
                        "name": 'DT_INI_GD',
                        "class": "datepicker" 
                    }
                }, {
                    //"targets": 3,
                    "title": "<?php echo mb_strtoupper($ui_model, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_model; ?>", //Editor
                    "data": 'CD_DET_GD',
                    "name": 'CD_DET_GD',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": false,
                    "className": "visibleColumn",  
                }, {
                    //"targets": 4,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_DET_GD',
                    "name": 'DT_INI_DET_GD',
                    "datatype": 'date',
                    "visible": false,                    
                    "type": "hidden",                    
                    "className": "visibleColumn",                
                    "attr": {
                        "name": 'DT_INI_DET_GD',
                        "class": "datepicker"
                    }             
                }, {
                    //"targets": 5,
                    "sTitle": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "title": "<?php echo $ui_code; ?>", //Available on Editor to replace label (quadTable.js line 632)
                    "label": "<?php echo $ui_code; ?>", //Editor :: Not available on Sequence label
                    "data": 'CD_TEMPLATE',
                    "name": 'CD_TEMPLATE',
                    "datatype": 'sequence',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": false,
                    "className": "visibleColumn",  
                }, {
                    //"targets": 6,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI',
                    "name": 'DT_INI',
                    "datatype": 'date',
                    "def": "1900-01-01",
                    "className": "visibleColumn",
                    "attr": {
                        "name": 'DT_INI',
                        "class": "datepicker" 
                    }           
                }, {
                    //"targets": 7,
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_designation; ?>",
                    "data": 'DSP',
                    "name": 'DSP',
                    "className": "visibleColumn",
                    "attr": {
                        "name": 'DSP',
                    }                    
                }, {
                    //"targets": 8,
                    "title": "<?php echo mb_strtoupper($ui_document, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_document; ?>", //Editor
                    "data": 'LINK_DOC',
                    "name": 'LINK_DOC',                  
                    "className": "visibleColumn", 
                    "type": "hidden",
                    "attr": {
                        "name": 'LINK_DOC'
                    },
                    "render": function (val, type, row) {
                        if (row['BD_MIME'] !== null) {
                            return dg_gd_templates.getFileIcon(row['BD_MIME'], JSON.stringify(row));
                        } else {
                            return val;
                        }                        
                    }                
                }, {
                    //"targets": 9,
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
                    //"targets": 10,
                    "title": "<?php echo mb_strtoupper($ui_extention, 'UTF-8'); ?>"+'</span>', //Datatables
                    "label": "<?php echo $ui_extention; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_file_format; ?>",
                    "data": 'BD_MIME',
                    "name": 'BD_MIME',
                    "className": "none visibleColumn",
                    "type": "hidden",
                    "attr": {
                        "name": 'BD_MIME',
                        "style": "width: 20%;",
                    }               
                }, {                    
                    //"targets": 11,
                    "title": "<?php echo mb_strtoupper($ui_description, 'UTF-8'); ?>"+'</span>', //Datatables
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
                    //"targets": 16,
                    "title": 'BD_DOC',
                    "data": null,
                    "name": 'BD_DOC',
                    "type": "upload",
                    "visible": false
                }, {
                    //"targets": 17,
                    "responsivePriority": 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        //debugger;
                        return dg_gd_templates.crudButtons(true,true,true);
                    }
                },

            ],         
            "validations": {
                "rules": {
                    "CD_GD": {
                        required: true,
                        integer: true,
                    },
                    "DT_INI_GD": {
                        required: true,
                        dateISO: true,
                    },               
                    "CD_DET_GD": {
                        required: true,
                        integer: true,
                    },
                    "DT_INI_DET_GD": {
                        required: true,
                        dateISO: true,
                    },     
                    "DT_INI": {
                        required: true,
                        dateISO: true,
                    },     
                    "DSP": {
                        required: true,
                        maxlength: 80,
                    },
                    "BD_MIME": {
                        maxlength: 10,
                    },
                    "LINK_DOC": {
                        maxlength: 500,
                    },
                    "DESCRICAO": {
                        maxlength: 4000,
                    },
                    "DT_FIM": {
                        dateISO: true,
                        dateEqOrNextThan: 'DT_INI'
                    },     
                },
                /* Se aqui definido sobrepõem-se ao definido em /inc/scripts.php*/
                "messages": {
                    "DT_FIM": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        dg_gd_templates = new QuadTable();
        dg_gd_templates.initTable( $.extend({}, datatable_instance_defaults, optionDg_Gd_Templates) );
        //END MODELOS -> Documentos
        
        //MODELOS -> Fases
        var optionDg_Gd_Fases = {
            "tableId": 'dg_gd_fases',
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_phase; ?>",            
            "table": "DG_GD_FASES",
            //refreshData: true,
            "pk": {
                "primary": {
                    "CD_GD": {"type": "number"},
                    "DT_INI_GD": {"type": "date"},
                    "CD_DET_GD": {"type": "number"},
                    "DT_INI_DET_GD": {"type": "date"},
                    "ID_FASE": {"type": "number"},
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "dg_det_gestao_docs": {
                    //External object key mapping( object key : external key)
                    "CD_GD": "CD_GD",
                    "DT_INI_GD": "DT_INI_GD",
                    "CD_DET_GD": "CD_DET_GD",
                    "DT_INI_DET_GD": "DT_INI_DET_GD"
                }
            },
            "order_by": "TIPO ASC",
            "recordBundle": 5, 
            "pageLenght": 5,
            "scrollY": "156",
            "responsive": true,
            "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
            "tableCols": [     
                {
                    //"targets": 0,
                    "responsivePriority": 1,
                    "data": null,
                    "width": "1%", 
                    "className": "control toBottom toCenter details-control",
                    "orderable": false,
                    "defaultContent": ''
                }, {
                    //"targets": 1,
                    "title": "<?php echo mb_strtoupper($ui_type, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_type; ?>", //Editor
                    "data": 'CD_GD',
                    "name": 'CD_GD',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": false,
                    "className": "visibleColumn",                      
                }, {
                    //"targets": 2,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_GD',
                    "name": 'DT_INI_GD',
                    "datatype": 'date',
                    "visible": false,                    
                    "type": "hidden",
                    "className": "visibleColumn",                
                    "attr": {
                        "name": 'DT_INI_GD',
                        "class": "datepicker" 
                    }
                }, {
                    //"targets": 3,
                    "title": "<?php echo mb_strtoupper($ui_model, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_model; ?>", //Editor
                    "data": 'CD_DET_GD',
                    "name": 'CD_DET_GD',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": false,
                    "className": "visibleColumn",  
                }, {
                    //"targets": 4,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_DET_GD',
                    "name": 'DT_INI_DET_GD',
                    "datatype": 'date',
                    "visible": false,                    
                    "type": "hidden",                    
                    "className": "visibleColumn",                
                    "attr": {
                        "name": 'DT_INI_DET_GD',
                        "class": "datepicker"
                    }             
                }, {
                    //"targets": 5,
                    "sTitle": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "title": "<?php echo $ui_code; ?>", //Available on Editor to replace label (quadTable.js line 632)
                    "label": "<?php echo $ui_code; ?>", //Editor :: Not available on Sequence label
                    "data": 'ID_FASE',
                    "name": 'ID_FASE',
                    "datatype": 'sequence',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": false,
                    "className": "visibleColumn",  
                }, {
                    //"targets": 6,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI',
                    "name": 'DT_INI',
                    "datatype": 'date',
                    "def": "1900-01-01",
                    "className": "visibleColumn",
                    "attr": {
                        "name": 'DT_INI',
                        "class": "datepicker" 
                    }           
                }, {
                    //"targets": 7,
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_phase, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_phase; ?>",
                    "data": 'TIPO',
                    "name": 'TIPO',
                    "type": "select",                    
                    "className": "visibleColumn", 
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_TIPO_FASES_GD',
                        "class": "form-control",
                        "name": 'TIPO',
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
                            var o = _.find(initApp.joinsData['DG_TIPO_FASES_GD'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING']; //o['RV_ABBREVIATION'] ????
                        } 
                    }           
                }, {
                    //"targets": 8,
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'RHID',
                    "name": 'RHID',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": false,                      
                }, {
                    //"targets": 9,
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_rhid, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_rhid; ?>",
                    "data": 'NOME',
                    "name": 'NOME',
                    "type": "select",
                    "className": "visibleColumn",
                    "complexList": true,
                    "attr": {
                        "dependent-group": "PEOPLE",
                        "dependent-level": 1,
                        "data-db-name": 'A.RHID',
                        "decodeFromTable": 'QUAD_NAMES A',
                        "class": "form-control complexList chosen",
                        "desigColumn": "CONCAT(CONCAT(A.RHID,'-'),A.NOME_REDZ)",
                        "whereClause": "",
                        "orderBy": 'A.RHID',
                        "filter": {
                            "create": " AND (A.RHID) IN (SELECT F.RHID FROM QUAD_PEOPLE F WHERE F.ATIVO = 'S')", //On-New-Record
                            "edit": " AND (A.RHID) IN (SELECT F.RHID FROM QUAD_PEOPLE F WHERE F.ATIVO = 'S')", //On-Edit-Record
                        },
                    }                     
                }, {
                    //"targets": 10,
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
                    //"targets": 11,
                    "title": "<?php echo mb_strtoupper($ui_obs_short, 'UTF-8'); ?>"+'</span>', //Datatables
                    "label": "<?php echo $ui_obs_short; ?>", //Editor
                    "data": 'OBS',
                    "name": 'OBS',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "name": 'OBS',
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
                        return dg_gd_fases.crudButtons(true,true,true);
                    }
                }
            ],         
            "validations": {
                "rules": {
                    "CD_GD": {
                        required: true,
                        integer: true,
                    },
                    "DT_INI_GD": {
                        required: true,
                        dateISO: true,
                    },               
                    "CD_DET_GD": {
                        required: true,
                        integer: true,
                    },
                    "DT_INI_DET_GD": {
                        required: true,
                        dateISO: true,
                    },     
                    "DT_INI": {
                        required: true,
                        dateISO: true,
                    },     
                    "TIPO": {
                        required: true,
                        maxlength: 8,
                    },
                    "OBS": {
                        maxlength: 240,
                    },
                    "DT_FIM": {
                        dateISO: true,
                        dateEqOrNextThan: 'DT_INI'
                    },     
                },
                /* Se aqui definido sobrepõem-se ao definido em /inc/scripts.php*/
                "messages": {
                    "DT_FIM": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        dg_gd_fases = new QuadTable();
        dg_gd_fases.initTable( $.extend({}, datatable_instance_defaults, optionDg_Gd_Fases) );
        //END MODELOS -> Fases      
        
    });

</script>
