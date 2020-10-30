<?php
    require_once '../init.php';
?>
<div class="row">
    <div class="col-xl-12">
        <div id="panel-0" class="panel">
            <div class="panel-hdr">
                <span class="widget-icon"> <i class="fal fa-clone"></i></span>&nbsp;
                <h2><?php echo $ui_functions; ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <a id="RH_DEF_FUNCOES_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                    <table id="RH_DEF_FUNCOES" class="table table-bordered table-hover table-striped w-100"></table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-end">
                <div class="panel-toolbar pr-3 align-self-end tabs__">
                    <ul id="demo_panel-tabs" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#Tab1" role="tab" aria-selected="true"><?php echo $ui_translate; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab2" role="tab" aria-selected="true"><?php echo $ui_characteristics; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab3" role="tab" aria-selected="true"><?php echo $ui_skills; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab4" role="tab" aria-selected="true"><?php echo $ui_objectives; ?></a>
                        </li>
                    </ul>
                </div>
            </div>   
            
            <div class="panel-container show">
                <div class="panel-content">
                    
                    <div class="tab-content">

                         <!-- TAB #1 -->
                        <div class="tab-pane fade active show" id="Tab1" role="tabpanel">
                            <a id="RH_DEF_FUNCAO_TRADS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="RH_DEF_FUNCAO_TRADS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                        </div>
                         <!-- END TAB #1 -->

                         <!-- TAB #2 -->
                        <div class="tab-pane fade" id="Tab2" role="tabpanel">
                            <a id="RH_CARACTERISTICAS_FUNCAO_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="RH_CARACTERISTICAS_FUNCAO" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                        </div>
                         <!-- END TAB #2 -->
                        
                         <!-- TAB #3 -->
                        <div class="tab-pane fade" id="Tab3" role="tabpanel">
                            <a id="RH_COMPETENCIAS_FUNCOES_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="RH_COMPETENCIAS_FUNCOES" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-11" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="fal fa-clone"></i></span>&nbsp;
                                            <h2><?php echo $ui_behaviors; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="RH_COMPORTAMENTOS_FUNCAO_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="RH_COMPORTAMENTOS_FUNCAO" class="table table-bordered table-hover table-striped w-100"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #3 -->

                         <!-- TAB #4 -->
                        <div class="tab-pane fade" id="Tab4" role="tabpanel">
                            <a id="RH_OBJECTIVO_FUNCOES_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="RH_OBJECTIVO_FUNCOES" class="table responsive table-bordered table-striped table-hover nowrap"></table>
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

        //Function
        var optionRH_DEF_FUNCOES = {
            "order": true,
            "tableId": "RH_DEF_FUNCOES",
            "table": "RH_DEF_FUNCOES", 
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_function; ?>",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_FUNCAO": {"type": "number"},
                    "TP_REGISTO": {"type": "varchar"},
                    "DT_INI_FUNCAO": {"type": "date"}            
                }
            },
            "crudOnMasterInactive": {
                "condition": "data.DT_FIM_FUNCAO !== null",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },
            "detailsObjects": ['RH_DEF_FUNCAO_TRADS','RH_CARACTERISTICAS_FUNCAO','RH_COMPETENCIAS_FUNCOES','RH_OBJECTIVO_FUNCOES'], 
            "initialWhereClause": " TP_REGISTO = 'A' ", //[A] Funções; [B] Responsabilidades (não desenvolvido)
            "order_by": "EMPRESA, ID_FUNCAO, DT_INI_FUNCAO desc",
            "recordBundle": 7,
            "pageLenght": 7,
            "scrollY": "195", 
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
                    "data": 'TP_REGISTO',
                    "name": 'TP_REGISTO',
                    "type": "hidden",
                    "visible": false,
                    "className": "",
                    "def": "A",
                    "defaultContent": "A"
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
                    "data": 'ID_FUNCAO',
                    "name": 'ID_FUNCAO',
                    "className": "visibleColumn",           
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_FUNCAO',
                    "name": 'DT_INI_FUNCAO',
                    "datatype": 'date',
                    "def": "1900-01-01",
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }            
                }, {
                    "responsivePriority": 5, 
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DSP_FUNCAO',
                    "name": 'DSP_FUNCAO',                    
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 6, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_FUNCAO',
                    "name": 'DSR_FUNCAO',
                    "className": "visibleColumn",  
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_GRP_FUNC',
                    "name": 'ID_GRP_FUNC',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_GRP_FUNC',
                    "name": 'DT_INI_GRP_FUNC',
                    "datatype": 'datetime',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 2,
                    "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                    "title": "<?php echo mb_strtoupper($ui_functional_group, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_functional_group; ?>",
                    "data": 'DSP_GRP_FUNC',
                    "name": 'DSP_GRP_FUNC',
                    "type": "select",
                    "className": "visibleColumn",
                    "renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "EMPRESA",
                        "dependent-level": 2,
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
                    "title": "<?php echo mb_strtoupper($ui_description, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DESCRICAO',
                    "name": 'DESCRICAO',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 335px"
                    }                                      
                }, {        
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM_FUNCAO',
                    "name": 'DT_FIM_FUNCAO',
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
                        return RH_DEF_FUNCOES.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DSP_EMPRESA": {
                        required: true
                    },
                    "ID_FUNCAO": {
                        required: true,
                        integer: true,
                    },
                    "DT_INI_FUNCAO": {
                        required: true,
                        dateISO: true,
                    },
                    "DSP_FUNCAO": {
                        required: true,
                        maxlength: 80,
                    },
                    "DSR_FUNCAO": {
                        maxlength: 25,
                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                    "DT_FIM_FUNCAO": {
                        dateISO: true,
                        dateEqOrNextThan: 'DT_INI_FUNCAO',
                    }
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                    "DT_FIM_FUNCAO": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        RH_DEF_FUNCOES = new QuadTable();
        RH_DEF_FUNCOES.initTable( $.extend({}, datatable_instance_defaults, optionRH_DEF_FUNCOES) );
        //END Function

        //Function Trads
        var optionsRH_DEF_FUNCAO_TRADS = {
            "tableId": "RH_DEF_FUNCAO_TRADS",
            "table": "RH_DEF_FUNCAO_TRADS",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_FUNCAO": {"type": "number"},
                    "TP_REGISTO": {"type": "varchar"},
                    "DT_INI_FUNCAO": {"type": "date"},
                    "CD_LINGUA": {"type": "number"},                    
                    "DT_INI": {"type": "date"}
                }
            },
            "dependsOn": {
                "RH_DEF_FUNCOES": { //External object key mapping( object key : external key)                    
                    "EMPRESA": "EMPRESA",
                    "ID_FUNCAO": "ID_FUNCAO",
                    "TP_REGISTO": "TP_REGISTO",
                    "DT_INI_FUNCAO": "DT_INI_FUNCAO"
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
                    "data": 'EMPRESA',
                    "name": 'EMPRESA',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_FUNCAO',
                    "name": 'ID_FUNCAO',                    
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
                    "data": 'DT_INI_FUNCAO',
                    "name": 'DT_INI_FUNCAO',
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
                    "attr": {
                        "name": 'DSR_TRAD'
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_description, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_description; ?>", //Editor
                    "data": 'DESCRICAO',
                    "name": 'DESCRICAO',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 335px"
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
                        return RH_DEF_FUNCAO_TRADS.crudButtons(true,true,true);
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
                        maxlength: 80,
                    },
                    DSR_TRAD: {
                        required: false,
                        maxlength: 25,
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
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                    "DT_FIM": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        RH_DEF_FUNCAO_TRADS = new QuadTable();
        RH_DEF_FUNCAO_TRADS.initTable($.extend({}, datatable_instance_defaults, optionsRH_DEF_FUNCAO_TRADS));
        //END Function Trads 

        //TAB 2 :: Characteristics
        var optionsRH_CARACTERISTICAS_FUNCAO = {
            "tableId": 'RH_CARACTERISTICAS_FUNCAO',
            "table": "RH_CARACTERISTICAS_FUNCAO", 
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
                    "ID_CARACT": {"type": "number"},
                    "DT_INI_CARACT": {"type": "date"},                    
                    "ID_FUNCAO": {"type": "number"},
                    "TP_REGISTO": {"type": "varchar"},
                    "DT_INI_FUNCAO": {"type": "date"},
                    "DT_INI_CAF": {"type": "date"}
                }
            },            
            "dependsOn": {
                "RH_DEF_FUNCOES": { //External object key mapping( object key : external key)                    
                    "EMPRESA": "EMPRESA",
                    "ID_FUNCAO": "ID_FUNCAO",
                    "TP_REGISTO": "TP_REGISTO",
                    "DT_INI_FUNCAO": "DT_INI_FUNCAO"
                }
            },
            "order_by": "ID_TP_CARACT, ID_DOM_1, ID_DOM_2, ID_CARACT, DT_INI_CAF desc",
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
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_FUNCAO',
                    "name": 'ID_FUNCAO',
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
                    "data": 'DT_INI_FUNCAO',
                    "name": 'DT_INI_FUNCAO',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables  
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
                    "data": 'DSR_TP_CARACT',
                    "name": 'DSR_TP_CARACT',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "dependent-level": 2,
                        "dependent-group": "EMPRESA",
                        "data-db-name": "A.EMPRESA@A.ID_TP_CARACT@A.DT_INI_TP_CARACT",
                        "decodeFromTable": "RH_DEF_TP_CARACTERISTICAS A",
                        "desigColumn": "NVL(A.DSR_TP_CARACT, A.DSP_TP_CARACT)", 
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
                    "data": 'DSR_DOM_1',
                    "name": 'DSR_DOM_1',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "dependent-level": 3,
                        "dependent-group": "EMPRESA",
                        "data-db-name": "A.EMPRESA@A.ID_TP_CARACT@A.DT_INI_TP_CARACT@A.ID_DOM_1@A.DT_INI_DOM_1",
                        "decodeFromTable": "RH_DEF_DOMINIOS_1 A",
                        "desigColumn": "NVL(A.DSR_DOM_1,A.DSP_DOM_1)", 
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
                    "data": 'DSR_DOM_2',
                    "name": 'DSR_DOM_2',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "dependent-level": 4,
                        "dependent-group": "EMPRESA",
                        "data-db-name": "A.EMPRESA@A.ID_TP_CARACT@A.DT_INI_TP_CARACT@A.ID_DOM_1@A.DT_INI_DOM_1@A.ID_DOM_2@A.DT_INI_DOM_2",
                        "decodeFromTable": "RH_DEF_DOMINIOS_2 A",
                        "desigColumn": "NVL(A.DSR_DOM_2,A.DSP_DOM_2)", 
                        "orderBy": "A.ID_DOM_2",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": ' AND A.DT_FIM_DOM_2 IS NULL', //On-New-Record
                            "edit": ' AND A.DT_FIM_DOM_2 IS NULL', //On-Edit-Record
                        } 
                    }                          
               }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_CARACT',
                    "name": 'ID_CARACT',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_CARACT',
                    "name": 'DT_INI_CARACT',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables 
                }, {
                    "complexList": true, 
                    "responsivePriority": 6,
                    "title": "<?php echo mb_strtoupper($ui_characteristic, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_characteristic; ?>",
                    "data": 'DSR_CARACTERISTICA',
                    "name": 'DSR_CARACTERISTICA',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "dependent-level": 5,
                        "dependent-group": "EMPRESA",
                        "data-db-name": "A.EMPRESA@A.ID_TP_CARACT@A.DT_INI_TP_CARACT@A.ID_DOM_1@A.DT_INI_DOM_1@A.ID_DOM_2@A.DT_INI_DOM_2@A.ID_CARACTERISTICA@A.DT_INI_CARACT",
                        "distribute-value": "EMPRESA@ID_TP_CARACT@DT_INI_TP_CARACT@ID_DOM_1@DT_INI_DOM_1@ID_DOM_2@DT_INI_DOM_2@ID_CARACT@DT_INI_CARACT",
                        "decodeFromTable": "RH_DEF_CARACTERISTICAS A",
                        "desigColumn": "NVL(A.DSR_CARACTERISTICA,A.DSP_CARACTERISTICA)", 
                        "orderBy": "A.DSR_CARACTERISTICA",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": ' AND A.DT_FIM_CARACT IS NULL', //On-New-Record
                            "edit": ' AND A.DT_FIM_CARACT IS NULL', //On-Edit-Record
                        } 
                    }                  
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_EP',
                    "name": 'ID_EP',
                    "type": "hidden",
                    "visible": false,
                    "className": "visibleColumn",
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_EP',
                    "name": 'DT_INI_EP',
                    "datatype": 'date',     
                    "type": "hidden",
                    "visible": false,
                    "className": "",
                }, {
                    "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                    "title": "<?php echo mb_strtoupper($ui_proficiency_scale, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_proficiency_scale; ?>",
                    "data": 'DSP_EP',
                    "name": 'DSP_EP',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "ESCALA",
                        "dependent-level": 1,
                        "deferred": true,
                        "data-db-name": 'A.EMPRESA@A.ID_EP@A.DT_INI_EP',
                        "decodeFromTable": 'RH_DEF_ESCALAS_PROFICIENCIA A',
                        "desigColumn": "NVL(A.DSP_EP, A.DSR_EP)", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.                        
                        "orderBy": "A.ID_EP", //usado no complexList.php
                        "class": "form-control complexList chosen",
                        //"disabled": true, //Permite inibir o campo no Editor
                        "filter": {
                            "create": " AND A.DT_FIM_EP IS NULL AND A.EMPRESA = ':EMPRESA'", //On-New-Record
                            "edit": " AND A.DT_FIM_EP IS NULL AND A.EMPRESA = ':EMPRESA'", //On-Edit-Record
                        }
                    }                     
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_NV_ESCALA',
                    "name": 'ID_NV_ESCALA',
                    "type": "hidden",
                    "visible": false,
                    "className": "visibleColumn",
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_NV_ESCALA',
                    "name": 'DT_INI_NV_ESCALA',
                    "datatype": 'date',     
                    "type": "hidden",
                    "visible": false,
                    "className": "",
                }, {
                    "responsivePriority": 8,
                    "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                    "title": "<?php echo mb_strtoupper($ui_level_required, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_level_required; ?>",
                    "fieldInfo": "<?php echo $ui_performance_evaluation; ?>",
                    "data": 'DSR_NEP',
                    "name": 'DSR_NEP',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "ESCALA",
                        "dependent-level": 2,
                        "data-db-name": 'A.EMPRESA@A.ID_EP@A.DT_INI_EP@A.ID_NV_ESCALA@A.DT_INI_NV_ESCALA',
                        "decodeFromTable": 'RH_NIVEIS_ESCALA_PROFICIENCIA A',
                        "desigColumn": "NVL(A.DSR_NEP,A.DSP_NEP)", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.                        
                        "orderBy": "NVL(A.NR_ORD, A.ID_NV_ESCALA)", //usado no complexList.php
                        "class": "form-control complexList chosen",
                        //"disabled": true, //Permite inibir o campo no Editor
                        "filter": {
                            "create": " AND A.DT_FIM_NV_ESCALA IS NULL", //On-New-Record
                            "edit": " AND A.DT_FIM_NV_ESCALA IS NULL", //On-Edit-Record
                        }
                    }       
                }, {
                    "responsivePriority": 7,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_CAF',
                    "name": 'DT_INI_CAF',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker", 
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM_CAF',
                    "name": 'DT_FIM_CAF',
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
                        return RH_CARACTERISTICAS_FUNCAO.crudButtons(true,true,true);
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
                    "DT_INI_CAF": {
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
                    "DSP_EP": { 
                        required: true
                    },
                    "DSR_NEP": { 
                        required: true
                    },
                    "DESCRICAO": { 
                        maxlength: 4000,
                    },
                    "DT_FIM_CAF": {
                        dateISO: true,
                        dateNextThan: 'DT_INI_CAF',
                    },                    
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                    "DT_FIM_CAF": {
                        dateNextThan: "<?php echo $error_end_dt_greater; ?>"
                    },
                }
            },              
        };
        RH_CARACTERISTICAS_FUNCAO = new QuadTable();
        RH_CARACTERISTICAS_FUNCAO.initTable( $.extend( {}, datatable_instance_defaults, optionsRH_CARACTERISTICAS_FUNCAO ) );        
        //END TAB 2 :: Characteristics  

        //Skills
        var optionRH_COMPETENCIAS_FUNCOES = {
            "tableId": "RH_COMPETENCIAS_FUNCOES",
            "table": "RH_COMPETENCIAS_FUNCOES", 
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_skill; ?>",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_FUNCAO": {"type": "number"},
                    "TP_REGISTO": {"type": "varchar"},
                    "DT_INI_FUNCAO": {"type": "date"},
                    "ID_COMPETENCIA": {"type": "number"},
                    "DT_INI_COMPETENCIA": {"type": "date"},  
                    "DT_INI": {"type": "date"}                  
                }
            },
            "dependsOn": {
                "RH_DEF_FUNCOES": { //External object key mapping( object key : external key)                    
                    "EMPRESA": "EMPRESA",
                    "ID_FUNCAO": "ID_FUNCAO",
                    "TP_REGISTO": "TP_REGISTO",
                    "DT_INI_FUNCAO": "DT_INI_FUNCAO"
                }
            },                 
            "crudOnMasterInactive": {
                "condition": "data.DT_FIM !== null",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },
            "detailsObjects": ['RH_COMPORTAMENTOS_FUNCAO'], 
            "order_by": "ID_COMPETENCIA, DT_INI desc",
            "recordBundle": 7,
            "pageLenght": 7,
            "scrollY": "195", 
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
                    "data": 'ID_FUNCAO',
                    "name": 'ID_FUNCAO',                    
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
                    "data": 'DT_INI_FUNCAO',
                    "name": 'DT_INI_FUNCAO',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_COMPETENCIA',
                    "name": 'ID_COMPETENCIA',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_COMPETENCIA',
                    "name": 'DT_INI_COMPETENCIA',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                }, {
                    "responsivePriority": 2,
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_skill, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_skill; ?>",
                    "data": 'DSP_COMPETENCIA',
                    "name": 'DSP_COMPETENCIA',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "SKILLS",
                        "dependent-level": 1,
                        "data-db-name": "A.EMPRESA@A.ID_COMPETENCIA@A.DT_INI_COMPETENCIA",
                        "deferred": true,
                        "decodeFromTable": "RH_DEF_COMPETENCIAS A",  //TO CHANGE ON QUAD-HCM
                        "desigColumn": "A.DSP_COMPETENCIA", 
                        "orderBy": "A.ID_COMPETENCIA",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.DT_FIM_COMPETENCIA IS NULL AND A.EMPRESA = ':EMPRESA'", //On-New-Record
                            "edit": " AND A.DT_FIM_COMPETENCIA IS NULL AND A.EMPRESA = ':EMPRESA'", //On-Edit-Record
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
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }            
                }, {
                    "responsivePriority": 5, 
                    "title": "<?php echo mb_strtoupper($ui_weight, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_weight; ?>", //Editor
                    "data": 'PESO',
                    "name": 'PESO',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 30%;"
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_EP',
                    "name": 'ID_EP',
                    "type": "hidden",
                    "visible": false,
                    "className": "visibleColumn",
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_EP',
                    "name": 'DT_INI_EP',
                    "datatype": 'date',     
                    "type": "hidden",
                    "visible": false,
                    "className": "",
                }, {
                    "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                    "title": "<?php echo mb_strtoupper($ui_proficiency_scale, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_proficiency_scale; ?>",
                    "data": 'DSP_EP',
                    "name": 'DSP_EP',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "ESCALA",
                        "dependent-level": 1,
                        "deferred": true,
                        "data-db-name": 'A.EMPRESA@A.ID_EP@A.DT_INI_EP',
                        "decodeFromTable": 'RH_DEF_ESCALAS_PROFICIENCIA A',
                        "desigColumn": "A.DSP_EP", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.                        
                        "orderBy": "A.ID_EP", //usado no complexList.php
                        "class": "form-control complexList chosen",
                        //"disabled": true, //Permite inibir o campo no Editor
                        "filter": {
                            "create": " AND A.DT_FIM_EP IS NULL AND A.EMPRESA = ':EMPRESA'", //On-New-Record
                            "edit": " AND A.DT_FIM_EP IS NULL AND A.EMPRESA = ':EMPRESA'", //On-Edit-Record
                        }
                    }                     
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_NV_ESCALA',
                    "name": 'ID_NV_ESCALA',
                    "type": "hidden",
                    "visible": false,
                    "className": "visibleColumn",
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_NV_ESCALA',
                    "name": 'DT_INI_NV_ESCALA',
                    "datatype": 'date',     
                    "type": "hidden",
                    "visible": false,
                    "className": "",
                }, {
                    "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                    "title": "<?php echo mb_strtoupper($ui_level_required, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_level_required; ?>",
                    "fieldInfo": "<?php echo $ui_performance_evaluation; ?>",
                    "data": 'DSR_NEP',
                    "name": 'DSR_NEP',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "ESCALA",
                        "dependent-level": 2,
                        "data-db-name": 'A.EMPRESA@A.ID_EP@A.DT_INI_EP@A.ID_NV_ESCALA@A.DT_INI_NV_ESCALA',
                        "decodeFromTable": 'RH_NIVEIS_ESCALA_PROFICIENCIA A',
                        "desigColumn": "A.DSR_NEP", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.                        
                        "orderBy": "NVL(A.NR_ORD, A.ID_NV_ESCALA)", //usado no complexList.php
                        "class": "form-control complexList chosen",
                        //"disabled": true, //Permite inibir o campo no Editor
                        "filter": {
                            "create": " AND A.DT_FIM_NV_ESCALA IS NULL", //On-New-Record
                            "edit": " AND A.DT_FIM_NV_ESCALA IS NULL", //On-Edit-Record
                        }
                    }                            
/*                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_NV_ESCALA_GC',
                    "name": 'ID_NV_ESCALA_GC',
                    "type": "hidden",
                    "visible": false,
                    "className": "visibleColumn",
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_NV_ESCALA_GC',
                    "name": 'DT_INI_NV_ESCALA_GC',
                    "datatype": 'date',     
                    "type": "hidden",
                    "visible": false,
                    "className": "",
                    
                }, {
                    "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                    "title": "<?php echo mb_strtoupper($ui_level_minimum, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_level_minimum; ?>",
                    "fieldInfo": "<?php echo $hint_gc_knowledge_matrix; ?>",
                    "data": 'DSP_NEP_GC',
                    "name": 'DSP_NEP_GC',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "EMPRESA",
                        "dependent-level": 3,
                        "data-db-name": "A.EMPRESA@A.ID_EP@A.DT_INI_EP@A.ID_NV_ESCALA@A.DT_INI_NV_ESCALA",
                        "distribute-value": "EMPRESA@ID_EP@DT_INI_EP@ID_NV_ESCALA_GC@DT_INI_NV_ESCALA_GC",
                        "decodeFromTable": 'RH_NIVEIS_ESCALA_PROFICIENCIA A',
                        "desigColumn": "NVL(A.DSR_NEP, A.DSP_NEP)", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.                        
                        "orderBy": "NVL(A.NR_ORD, A.ID_NV_ESCALA)", //usado no complexList.php
                        "class": "form-control complexList chosen",
                        //"disabled": true, //Permite inibir o campo no Editor
                        "filter": {
                            "create": ' AND A.DT_FIM_NV_ESCALA IS NULL', //On-New-Record
                            "edit": ' AND A.DT_FIM_NV_ESCALA IS NULL', //On-Edit-Record
                        }
                    }      
*/                    
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'RHID',
                    "name": 'RHID',
                    "type": "hidden",
                    "visible": false,
                    "className": ""                        
                }, {
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_evaluator, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_evaluator; ?>",
                    "fieldInfo": "<?php echo $hint_rhid_responsible_assesment; ?>",
                    "data": 'NOME_REDZ',
                    "name": 'NOME_REDZ',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                                        
                    "attr": {
                        "dependent-group": "COLABS",
                        "dependent-level": 1,
                        "deferred": true,
                        "data-db-name": 'A.RHID',
                        "distribute-value": "RHID",
                        "decodeFromTable": 'QUAD_NAMES A',
                        "desigColumn": "CONCAT(CONCAT(A.RHID,'-'),A.NOME_REDZ)", 
                        "orderBy": "A.RHID", 
                        "class": "form-control complexList chosen",
                        ///"disabled": true, //Permite inibir o campo no Editor
                        "filter": {
                            "create": " AND (A.RHID) IN (SELECT F.RHID FROM QUAD_PEOPLE F WHERE F.ATIVO = 'S' AND F.EMPRESA = ':EMPRESA')", //On-New-Record
                            //"create": " AND (RHID) IN (SELECT RHID FROM QUAD_PEOPLE WHERE ATIVO = 'S' AND EMPRESA = ':EMPRESA')", //On-New-Record
                            "edit": " AND (A.RHID) IN (SELECT F.RHID FROM QUAD_PEOPLE F WHERE F.ATIVO = 'S' AND F.EMPRESA = ':EMPRESA')", //On-Edit-Record
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
                        "style": "width: 355px"
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
                        return RH_COMPETENCIAS_FUNCOES.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DSP_COMPETENCIA": {
                        required: true,
                        maxlength: 80,
                    },
                    "DT_INI": {
                        required: true,
                        dateISO: true,
                    },
                    "DSR_COMPETENCIA": {
                        maxlength: 25,
                    },
                    "PESO": {
                        required: true,
                        number: true,
                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                    "DT_FIM": {
                        dateISO: true,
                        dateEqOrNextThan: 'DT_INI',
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
        RH_COMPETENCIAS_FUNCOES = new QuadTable();
        RH_COMPETENCIAS_FUNCOES.initTable( $.extend({}, datatable_instance_defaults, optionRH_COMPETENCIAS_FUNCOES) );
        //END Skills

        //RH_COMPETENCIAS_FUNCOES :: EDITOR :: EVENTS
        $(document).on('RH_COMPETENCIAS_FUNCOESAttachEvt', function (e) {
            var validator = $("#RH_COMPETENCIAS_FUNCOES_editorForm").validate();
            $('#RH_COMPETENCIAS_FUNCOES_editorForm').on("focusout", '#DTE_Field_PESO', function (e) {
                e.stopImmediatePropagation();
                var el = $(this);

                if (RH_COMPETENCIAS_FUNCOES.operation === "INSERT" || RH_COMPETENCIAS_FUNCOES.operation === "UPDATE") {
                    if ($(this).val()) {
                        $('#DTE_Field_PESO').rules('remove', 'avaliacao');
                        $.validator.addMethod('avaliacao', function (value, element, param) {
                            var masterRecord = RH_DEF_FUNCOES.tbl.row('.selected').data(), sql = [];
                            if (RH_COMPETENCIAS_FUNCOES.operation === "INSERT") {
                                sql = [
                                    "SELECT sum(PESO) AS SOMA FROM RH_COMPETENCIAS_FUNCOES WHERE EMPRESA = '" + masterRecord['EMPRESA'] + "' AND ID_FUNCAO = '" + masterRecord['ID_FUNCAO'] + "' AND TP_REGISTO = '" + masterRecord['TP_REGISTO'] + "' AND TO_CHAR(DT_INI_FUNCAO,'YYYY-MM-DD') = '" + masterRecord['DT_INI_FUNCAO'] + "'"
                                ];
                            } else if (RH_COMPETENCIAS_FUNCOES.operation === "UPDATE") {
                                var currentRecord = RH_COMPETENCIAS_FUNCOES.tbl.row('.selected').data()
                                sql = [
                                    "SELECT sum(PESO) AS SOMA FROM RH_COMPETENCIAS_FUNCOES WHERE EMPRESA = '" + masterRecord['EMPRESA'] + "' AND ID_FUNCAO = '" + masterRecord['ID_FUNCAO'] + "' AND TP_REGISTO = '" + masterRecord['TP_REGISTO'] + "' AND TO_CHAR(DT_INI_FUNCAO,'YYYY-MM-DD') = '" + masterRecord['DT_INI_FUNCAO'] + 
                                    "' AND NOT(ID_COMPETENCIA = " + currentRecord['ID_COMPETENCIA'] + " AND TO_CHAR(DT_INI_COMPETENCIA,'YYYY-MM-DD') = '" + currentRecord['DT_INI_COMPETENCIA'] + "' AND TO_CHAR(DT_INI,'YYYY-MM-DD') = '" + currentRecord['DT_INI'] +"')"
                                ];                                
                            } else {
                                return true;
                            }
                            var rqt = RH_COMPETENCIAS_FUNCOES.getFromSql(sql, false);
                            $.when(rqt).then(function (data) {
                                    var soma_pesos = JSON.parse(data);
                                    soma_pesos = soma_pesos[0][0]['SOMA'];
                                    if (!soma_pesos) {
                                        soma_pesos = 0;
                                    }
                                    var tot = parseFloat(value) + parseFloat(soma_pesos);
                                    RH_COMPETENCIAS_FUNCOES['messager'] = {
                                        msg: function () {
                                            var txt = "<?php echo $error_more_than_100; ?>";
                                            return txt.replace("{0}", tot);
                                        },
                                        valid: tot < 100
                                    };
                                    return RH_COMPETENCIAS_FUNCOES['messager']['valid'];
                            });
                            return RH_COMPETENCIAS_FUNCOES['messager']['valid'];

                        }, function (param, element) {
                            return RH_COMPETENCIAS_FUNCOES['messager']['msg'];
                        });

                        $('#DTE_Field_PESO').rules("add", {
                            avaliacao: true,
                        });
                        validator.element($(this));
                    }
                }
            });
        });
        //END RH_COMPETENCIAS_FUNCOES :: EDITOR :: EVENTS

        //Behaviors
        var optionRH_COMPORTAMENTOS_FUNCAO = {
            "tableId": "RH_COMPORTAMENTOS_FUNCAO",
            "table": "RH_COMPORTAMENTOS_FUNCAO", 
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_FUNCAO": {"type": "number"},
                    "TP_REGISTO": {"type": "varchar"},
                    "DT_INI_FUNCAO": {"type": "date"},
                    "ID_COMPETENCIA": {"type": "number"},
                    "DT_INI_COMPETENCIA": {"type": "date"},                    
                    "DT_INI": {"type": "date"},
                    "ID_COMPORTAMENTO": {"type": "number"},
                    "DT_INI_COMPORTAMENTO": {"type": "date"},
                    "DT_INI_COF": {"type": "date"}
                }
            },
            "dependsOn": {
                "RH_COMPETENCIAS_FUNCOES": { //External object key mapping( object key : external key)                    
                    "EMPRESA": "EMPRESA",
                    "ID_FUNCAO": "ID_FUNCAO",
                    "TP_REGISTO": "TP_REGISTO",
                    "DT_INI_FUNCAO": "DT_INI_FUNCAO",
                    "ID_COMPETENCIA": "ID_COMPETENCIA",
                    "DT_INI_COMPETENCIA": "DT_INI_COMPETENCIA",
                    "DT_INI": "DT_INI"
                }
            },
            "order_by": "EMPRESA, ID_COMPORTAMENTO, DT_INI_COMPORTAMENTO desc",
            "recordBundle": 7,
            "pageLenght": 7,
            "scrollY": "195", 
            "responsive": true,
            "pageResize": true, // PLUGIN :: dataTables.pageResize.min.js
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
                    "data": 'ID_FUNCAO',
                    "name": 'ID_FUNCAO',                    
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
                    "data": 'DT_INI_FUNCAO',
                    "name": 'DT_INI_FUNCAO',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_COMPETENCIA',
                    "name": 'ID_COMPETENCIA',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_COMPETENCIA',
                    "name": 'DT_INI_COMPETENCIA',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI',
                    "name": 'DT_INI',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_COMPORTAMENTO',
                    "name": 'ID_COMPORTAMENTO',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_COMPORTAMENTO',
                    "name": 'DT_INI_COMPORTAMENTO',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                      
                }, {
                    "responsivePriority": 2,
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_behavior, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_behavior; ?>",
                    "data": 'DSP_COMPORTAMENTO',
                    "name": 'DSP_COMPORTAMENTO',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "BEHAVIOR",
                        "dependent-level": 1,
                        "data-db-name": "A.EMPRESA@A.ID_COMPETENCIA@A.DT_INI_COMPETENCIA@A.ID_COMPORTAMENTO@A.DT_INI_COMPORTAMENTO",
                        "deferred": true,
                        "decodeFromTable": "RH_DEF_COMPORTAMENTOS A",  //TO CHANGE ON QUAD-HCM
                        "desigColumn": "A.DSP_COMPORTAMENTO", 
                        "orderBy": "A.ID_COMPORTAMENTO",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.DT_FIM IS NULL AND A.EMPRESA = ':EMPRESA' AND A.ID_COMPETENCIA = ':ID_COMPETENCIA'", //On-New-Record
                            "edit": " AND A.DT_FIM IS NULL AND A.EMPRESA = ':EMPRESA' AND A.ID_COMPETENCIA = ':ID_COMPETENCIA'", //On-Edit-Record
                        } 
                    }
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_COF',
                    "name": 'DT_INI_COF',
                    "datatype": 'date',
                    "def": "1900-01-01",
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }                     
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_EP',
                    "name": 'ID_EP',
                    "type": "hidden",
                    "visible": false,
                    "className": "visibleColumn",
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_EP',
                    "name": 'DT_INI_EP',
                    "datatype": 'date',     
                    "type": "hidden",
                    "visible": false,
                    "className": "",
                }, {
                    "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                    "title": "<?php echo mb_strtoupper($ui_proficiency_scale, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_proficiency_scale; ?>",
                    "data": 'DSP_EP',
                    "name": 'DSP_EP',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "ESCALA",
                        "dependent-level": 1,
                        "deferred": true,
                        "data-db-name": 'A.EMPRESA@A.ID_EP@A.DT_INI_EP',
                        "decodeFromTable": 'RH_DEF_ESCALAS_PROFICIENCIA A',
                        "desigColumn": "A.DSP_EP", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.                        
                        "orderBy": "A.ID_EP", //usado no complexList.php
                        "class": "form-control complexList chosen",
                        //"disabled": true, //Permite inibir o campo no Editor
                        "filter": {
                            "create": " AND A.DT_FIM_EP IS NULL AND A.EMPRESA = ':EMPRESA'", //On-New-Record
                            "edit": " AND A.DT_FIM_EP IS NULL AND A.EMPRESA = ':EMPRESA'", //On-Edit-Record
                        }
                    }                     
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_NV_ESCALA',
                    "name": 'ID_NV_ESCALA',
                    "type": "hidden",
                    "visible": false,
                    "className": "visibleColumn",
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_NV_ESCALA',
                    "name": 'DT_INI_NV_ESCALA',
                    "datatype": 'date',     
                    "type": "hidden",
                    "visible": false,
                    "className": "",
                }, {
                    "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                    "title": "<?php echo mb_strtoupper($ui_level_required, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_level_required; ?>",
                    "fieldInfo": "<?php echo $ui_performance_evaluation; ?>",
                    "data": 'DSR_NEP',
                    "name": 'DSR_NEP',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "ESCALA",
                        "dependent-level": 2,
                        "data-db-name": 'A.EMPRESA@A.ID_EP@A.DT_INI_EP@A.ID_NV_ESCALA@A.DT_INI_NV_ESCALA',
                        "decodeFromTable": 'RH_NIVEIS_ESCALA_PROFICIENCIA A',
                        "desigColumn": "A.DSR_NEP", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.                        
                        "orderBy": "NVL(A.NR_ORD, A.ID_NV_ESCALA)", //usado no complexList.php
                        "class": "form-control complexList chosen",
                        //"disabled": true, //Permite inibir o campo no Editor
                        "filter": {
                            "create": " AND A.DT_FIM_NV_ESCALA IS NULL", //On-New-Record
                            "edit": " AND A.DT_FIM_NV_ESCALA IS NULL", //On-Edit-Record
                        }
                    }  
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_weight, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_weight; ?>", //Editor
                    "data": 'PESO',
                    "name": 'PESO',
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
                        "style": "width: 355px"
                    }                     
                }, {        
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM_COF',
                    "name": 'DT_FIM_COF',
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
                        return RH_COMPORTAMENTOS_FUNCAO.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DSP_COMPORTAMENTO": {
                        required: true
                    },
                    "DT_INI_COF": {
                        required: true,
                        dateISO: true,
                    },
                    "DSP_EP": {
                        required: true
                    },
                    "DSR_NEP": {
                        required: true
                    },
                    "PESO": {
                        number: true,
                    },                    
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                    "DT_FIM_COF": {
                        dateISO: true,
                        dateEqOrNextThan: 'DT_INI_COF',
                    }
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                    "DT_FIM_COF": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        RH_COMPORTAMENTOS_FUNCAO = new QuadTable();
        RH_COMPORTAMENTOS_FUNCAO.initTable( $.extend({}, datatable_instance_defaults, optionRH_COMPORTAMENTOS_FUNCAO) );
        //END Behaviors      

        //RH_COMPORTAMENTOS_FUNCAO :: EDITOR :: EVENTS
        $(document).on('RH_COMPORTAMENTOS_FUNCAOAttachEvt', function (e) {
            var validator = $("#RH_COMPORTAMENTOS_FUNCAO_editorForm").validate();
            $('#RH_COMPORTAMENTOS_FUNCAO_editorForm').on("focusout", '#DTE_Field_PESO', function (e) {
                e.stopImmediatePropagation();
                var el = $(this);

                if (RH_COMPORTAMENTOS_FUNCAO.operation === "INSERT" || RH_COMPORTAMENTOS_FUNCAO.operation === "UPDATE") {
                    if ($(this).val()) {
                        $('#DTE_Field_PESO').rules('remove', 'avaliacao');
                        $.validator.addMethod('avaliacao', function (value, element, param) {
                            var masterRecord = RH_COMPETENCIAS_FUNCOES.tbl.row('.selected').data(), sql = [];
                            if (RH_COMPORTAMENTOS_FUNCAO.operation === "INSERT") {
                                sql = [
                                    "SELECT sum(PESO) AS SOMA FROM RH_COMPORTAMENTOS_FUNCAO WHERE EMPRESA = '" + masterRecord['EMPRESA'] + "' AND ID_FUNCAO = '" + masterRecord['ID_FUNCAO'] + "' AND TP_REGISTO = '" + masterRecord['TP_REGISTO'] + "' AND TO_CHAR(DT_INI_FUNCAO,'YYYY-MM-DD') = '" + masterRecord['DT_INI_FUNCAO'] + "'"
                                ];
                            } else if (RH_COMPORTAMENTOS_FUNCAO.operation === "UPDATE") {
                                var currentRecord = RH_COMPORTAMENTOS_FUNCAO.tbl.row('.selected').data()
                                sql = [
                                    "SELECT sum(PESO) AS SOMA FROM RH_COMPORTAMENTOS_FUNCAO WHERE EMPRESA = '" + masterRecord['EMPRESA'] + "' AND ID_FUNCAO = '" + masterRecord['ID_FUNCAO'] + "' AND TP_REGISTO = '" + masterRecord['TP_REGISTO'] + "' AND TO_CHAR(DT_INI_FUNCAO,'YYYY-MM-DD') = '" + masterRecord['DT_INI_FUNCAO'] + 
                                    "' AND NOT(ID_COMPETENCIA = " + currentRecord['ID_COMPETENCIA'] + " AND TO_CHAR(DT_INI_COMPETENCIA,'YYYY-MM-DD') = '" + currentRecord['DT_INI_COMPETENCIA'] + "' AND TO_CHAR(DT_INI,'YYYY-MM-DD') = '" + currentRecord['DT_INI'] +
                                    "' AND ID_COMPORTAMENTO = " + currentRecord['ID_COMPORTAMENTO'] + " AND TO_CHAR(DT_INI_COMPORTAMENTO,'YYYY-MM-DD') = '" + currentRecord['DT_INI_COMPORTAMENTO'] + "' AND TO_CHAR(DT_INI_COF,'YYYY-MM-DD') = '" + currentRecord['DT_INI_COF'] + "')"
                                ];                                
                            } else {
                                return true;
                            }
                            var rqt = RH_COMPORTAMENTOS_FUNCAO.getFromSql(sql, false);
                            $.when(rqt).then(function (data) {
                                    var soma_pesos = JSON.parse(data);
                                    soma_pesos = soma_pesos[0][0]['SOMA'];
                                    if (!soma_pesos) {
                                        soma_pesos = 0;
                                    }
                                    var tot = parseFloat(value) + parseFloat(soma_pesos);
                                    RH_COMPORTAMENTOS_FUNCAO['messager'] = {
                                        msg: function () {
                                            var txt = "<?php echo $error_more_than_100; ?>";
                                            return txt.replace("{0}", tot);
                                        },
                                        valid: tot < 100
                                    };
                                    return RH_COMPORTAMENTOS_FUNCAO['messager']['valid'];
                            });
                            return RH_COMPORTAMENTOS_FUNCAO['messager']['valid'];

                        }, function (param, element) {
                            return RH_COMPORTAMENTOS_FUNCAO['messager']['msg'];
                        });

                        $('#DTE_Field_PESO').rules("add", {
                            avaliacao: true,
                        });
                        validator.element($(this));
                    }
                }
            });
        });
        //END RH_COMPORTAMENTOS_FUNCAO :: EDITOR :: EVENTS
      
        //Objectives
        var optionRH_OBJECTIVO_FUNCOES = {
            "tableId": "RH_OBJECTIVO_FUNCOES",
            "table": "RH_OBJECTIVO_FUNCOES", 
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_FUNCAO": {"type": "number"},
                    "TP_REGISTO": {"type": "varchar"},
                    "DT_INI_FUNCAO": {"type": "date"},
                    "ID_OBJECTIVO": {"type": "number"},
                    "DT_INI_OBJECTIVO": {"type": "date"},  
                    "DT_INI_OF": {"type": "date"}                  
                }
            },
            "dependsOn": {
                "RH_DEF_FUNCOES": { //External object key mapping( object key : external key)                    
                    "EMPRESA": "EMPRESA",
                    "ID_FUNCAO": "ID_FUNCAO",
                    "TP_REGISTO": "TP_REGISTO",
                    "DT_INI_FUNCAO": "DT_INI_FUNCAO"
                }
            },                 
            "order_by": "ID_OBJECTIVO, DT_INI_OF desc",
            "recordBundle": 7,
            "pageLenght": 7,
            "scrollY": "195", 
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
                    "data": 'ID_FUNCAO',
                    "name": 'ID_FUNCAO',                    
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
                    "data": 'DT_INI_FUNCAO',
                    "name": 'DT_INI_FUNCAO',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_OBJECTIVO',
                    "name": 'ID_OBJECTIVO',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_OBJECTIVO',
                    "name": 'DT_INI_OBJECTIVO',
                    "datatype": 'date',     
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                    
                }, {
                    "responsivePriority": 2,
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_objective, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_objective; ?>",
                    "data": 'DSP_OBJECTIVO',
                    "name": 'DSP_OBJECTIVO',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "SKILLS",
                        "dependent-level": 1,
                        "data-db-name": "A.EMPRESA@A.ID_OBJECTIVO@A.DT_INI_OBJECTIVO",
                        "deferred": true,
                        "decodeFromTable": "RH_DEF_OBJECTIVOS A",  //TO CHANGE ON QUAD-HCM
                        "desigColumn": "A.DSP_OBJECTIVO", 
                        "orderBy": "A.ID_OBJECTIVO",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.DT_FIM IS NULL AND A.EMPRESA = ':EMPRESA'", //On-New-Record
                            "edit": " AND A.DT_FIM IS NULL AND A.EMPRESA = ':EMPRESA'", //On-Edit-Record
                        } 
                    }                                 
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_OF',
                    "name": 'DT_INI_OF',
                    "datatype": 'date',
                    "def": "1900-01-01",
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }            
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_weight, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_weight; ?>", //Editor
                    "data": 'PESO',
                    "name": 'PESO',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 30%;"
                    }
                }, {
                    "responsivePriority": 5, 
                    "title": "<?php echo mb_strtoupper($ui_required_value, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_required_value; ?>", //Editor
                    "data": 'VALOR_REQUERIDO',
                    "name": 'VALOR_REQUERIDO',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 30%;"
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_EP',
                    "name": 'ID_EP',
                    "type": "hidden",
                    "visible": false,
                    "className": "visibleColumn",
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_EP',
                    "name": 'DT_INI_EP',
                    "datatype": 'date',     
                    "type": "hidden",
                    "visible": false,
                    "className": "",
                }, {
                    "responsivePriority": 6, 
                    "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                    "title": "<?php echo mb_strtoupper($ui_proficiency_scale, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_proficiency_scale; ?>",
                    "data": 'DSP_EP',
                    "name": 'DSP_EP',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "ESCALA",
                        "dependent-level": 1,
                        "deferred": true,
                        "data-db-name": 'A.EMPRESA@A.ID_EP@A.DT_INI_EP',
                        "decodeFromTable": 'RH_DEF_ESCALAS_PROFICIENCIA A',
                        "desigColumn": "A.DSP_EP", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.                        
                        "orderBy": "A.ID_EP", //usado no complexList.php
                        "class": "form-control complexList chosen",
                        //"disabled": true, //Permite inibir o campo no Editor
                        "filter": {
                            "create": " AND A.DT_FIM_EP IS NULL AND A.EMPRESA = ':EMPRESA'", //On-New-Record
                            "edit": " AND A.DT_FIM_EP IS NULL AND A.EMPRESA = ':EMPRESA'", //On-Edit-Record
                        }
                    }                     
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_NV_ESCALA',
                    "name": 'ID_NV_ESCALA',
                    "type": "hidden",
                    "visible": false,
                    "className": "visibleColumn",
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_NV_ESCALA',
                    "name": 'DT_INI_NV_ESCALA',
                    "datatype": 'date',     
                    "type": "hidden",
                    "visible": false,
                    "className": "",
                }, {
                    "responsivePriority": 7, 
                    "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                    "title": "<?php echo mb_strtoupper($ui_level_required, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_level_required; ?>",
                    "fieldInfo": "<?php echo $ui_performance_evaluation; ?>",
                    "data": 'DSR_NEP',
                    "name": 'DSR_NEP',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "ESCALA",
                        "dependent-level": 2,
                        "data-db-name": 'A.EMPRESA@A.ID_EP@A.DT_INI_EP@A.ID_NV_ESCALA@A.DT_INI_NV_ESCALA',
                        "decodeFromTable": 'RH_NIVEIS_ESCALA_PROFICIENCIA A',
                        "desigColumn": "A.DSR_NEP", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.                        
                        "orderBy": "NVL(A.NR_ORD, A.ID_NV_ESCALA)", //usado no complexList.php
                        "class": "form-control complexList chosen",
                        //"disabled": true, //Permite inibir o campo no Editor
                        "filter": {
                            "create": " AND A.DT_FIM_NV_ESCALA IS NULL", //On-New-Record
                            "edit": " AND A.DT_FIM_NV_ESCALA IS NULL", //On-Edit-Record
                        }
                    }                                               
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'RHID',
                    "name": 'RHID',
                    "type": "hidden",
                    "visible": false,
                    "className": ""                        
                }, {
                    "responsivePriority": 8, 
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_evaluator, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_evaluator; ?>",
                    "fieldInfo": "<?php echo $hint_rhid_responsible_assesment; ?>",
                    "data": 'NOME_REDZ',
                    "name": 'NOME_REDZ',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                                        
                    "attr": {
                        "dependent-group": "COLABS",
                        "dependent-level": 1,
                        "deferred": true,
                        "data-db-name": 'A.RHID',
                        "distribute-value": "RHID",
                        "decodeFromTable": 'QUAD_NAMES A',
                        "desigColumn": "CONCAT(CONCAT(A.RHID,'-'),A.NOME_REDZ)", 
                        "orderBy": "A.RHID", 
                        "class": "form-control complexList chosen",
                        ///"disabled": true, //Permite inibir o campo no Editor
                        "filter": {
                            "create": " AND (A.RHID) IN (SELECT F.RHID FROM QUAD_PEOPLE F WHERE F.ATIVO = 'S' AND F.EMPRESA = ':EMPRESA')", //On-New-Record
                            //"create": " AND (RHID) IN (SELECT RHID FROM QUAD_PEOPLE WHERE ATIVO = 'S' AND EMPRESA = ':EMPRESA')", //On-New-Record
                            "edit": " AND (A.RHID) IN (SELECT F.RHID FROM QUAD_PEOPLE F WHERE F.ATIVO = 'S' AND F.EMPRESA = ':EMPRESA')", //On-Edit-Record
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
                        "style": "width: 355px"
                    }                                      
                }, {      
                    "responsivePriority": 9, 
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM_OF',
                    "name": 'DT_FIM_OF',
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
                        return RH_OBJECTIVO_FUNCOES.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DSP_OBJECTIVO": {
                        required: true,
                        maxlength: 80,
                    },
                    "DT_INI_OF": {
                        required: true,
                        dateISO: true,
                    },
                    "PESO": {
                        required: false,
                        number: true,
                    },
                    "VALOR_REQUERIDO": {
                        required: false,
                        number: true,
                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                    "DT_FIM_OF": {
                        dateISO: true,
                        dateEqOrNextThan: 'DT_INI_OF',
                    }
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                    "DT_FIM_OF": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        RH_OBJECTIVO_FUNCOES = new QuadTable();
        RH_OBJECTIVO_FUNCOES.initTable( $.extend({}, datatable_instance_defaults, optionRH_OBJECTIVO_FUNCOES) );        
        //END Objectives
        
        //RH_OBJECTIVO_FUNCOES :: EDITOR :: EVENTS
        $(document).on('RH_OBJECTIVO_FUNCOESAttachEvt', function (e) {
            var validator = $("#RH_OBJECTIVO_FUNCOES_editorForm").validate();
            $('#RH_OBJECTIVO_FUNCOES_editorForm').on("focusout", '#DTE_Field_PESO', function (e) {
                e.stopImmediatePropagation();
                var el = $(this);

                if (RH_OBJECTIVO_FUNCOES.operation === "INSERT" || RH_OBJECTIVO_FUNCOES.operation === "UPDATE") {
                    if ($(this).val()) {
                        $('#DTE_Field_PESO').rules('remove', 'avaliacao');
                        $.validator.addMethod('avaliacao', function (value, element, param) {
                            var masterRecord = RH_DEF_FUNCOES.tbl.row('.selected').data(), sql = [];
                            if (RH_OBJECTIVO_FUNCOES.operation === "INSERT") {
                                sql = [
                                    "SELECT sum(PESO) AS SOMA FROM RH_OBJECTIVO_FUNCOES WHERE EMPRESA = '" + masterRecord['EMPRESA'] + "' AND ID_FUNCAO = '" + masterRecord['ID_FUNCAO'] + "' AND TP_REGISTO = '" + masterRecord['TP_REGISTO'] + "' AND TO_CHAR(DT_INI_FUNCAO,'YYYY-MM-DD') = '" + masterRecord['DT_INI_FUNCAO'] + "'"
                                ];
                            } else if (RH_OBJECTIVO_FUNCOES.operation === "UPDATE") {
                                var currentRecord = RH_OBJECTIVO_FUNCOES.tbl.row('.selected').data()
                                sql = [
                                    "SELECT sum(PESO) AS SOMA FROM RH_OBJECTIVO_FUNCOES WHERE EMPRESA = '" + masterRecord['EMPRESA'] + "' AND ID_FUNCAO = '" + masterRecord['ID_FUNCAO'] + "' AND TP_REGISTO = '" + masterRecord['TP_REGISTO'] + "' AND TO_CHAR(DT_INI_FUNCAO,'YYYY-MM-DD') = '" + masterRecord['DT_INI_FUNCAO'] + 
                                    "' AND NOT(ID_OBJECTIVO = " + currentRecord['ID_OBJECTIVO'] + " AND TO_CHAR(DT_INI_OBJECTIVO,'YYYY-MM-DD') = '" + currentRecord['DT_INI_OBJECTIVO'] + "' AND TO_CHAR(DT_INI_OF,'YYYY-MM-DD') = '" + currentRecord['DT_INI_OF'] +"')"
                                ];                                
                            } else {
                                return true;
                            }
                            var rqt = RH_OBJECTIVO_FUNCOES.getFromSql(sql, false);
                            $.when(rqt).then(function (data) {
                                    var soma_pesos = JSON.parse(data);
                                    soma_pesos = soma_pesos[0][0]['SOMA'];
                                    if (!soma_pesos) {
                                        soma_pesos = 0;
                                    }
                                    var tot = parseFloat(value) + parseFloat(soma_pesos);
                                    RH_OBJECTIVO_FUNCOES['messager'] = {
                                        msg: function () {
                                            var txt = "<?php echo $error_more_than_100; ?>";
                                            return txt.replace("{0}", tot);
                                        },
                                        valid: tot < 100
                                    };
                                    return RH_OBJECTIVO_FUNCOES['messager']['valid'];
                            });
                            return RH_OBJECTIVO_FUNCOES['messager']['valid'];

                        }, function (param, element) {
                            return RH_OBJECTIVO_FUNCOES['messager']['msg'];
                        });

                        $('#DTE_Field_PESO').rules("add", {
                            avaliacao: true,
                        });
                        validator.element($(this));
                    }
                }
            });
        });
        //END RH_OBJECTIVO_FUNCOES :: EDITOR :: EVENTS     
               
    });
</script>
