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
                            <a class="nav-link active" data-toggle="tab" href="#Tab1" role="tab" aria-selected="true"><?php echo $ui_tables; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab2" role="tab" aria-selected="true"><?php echo $ui_rules; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab3" role="tab" aria-selected="true"><?php echo $ui_routes; ?></a>
                        </li>
                    </ul>
                </div>
            </div>   
            
            <div class="panel-container show">
                <div class="panel-content">
                    
                    <div class="tab-content">

                        <div class="tab-pane fade active show" id="Tab1" role="tabpanel">
                            <a id="RH_DEF_TABELAS_AJD_CST_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="RH_DEF_TABELAS_AJD_CST" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            
                            <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-start">
                                <div class="panel-toolbar pr-3 align-self-end">
                                    <ul id="panel-tab-2-1" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#Tab11" role="tab" aria-selected="true"><?php echo $ui_indexes; ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Tab12" role="tab" aria-selected="true"><?php echo $ui_translations; ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-container show">
                                <div class="panel-content">
                                    <div class="tab-content">
                                        <div class="tab-pane fade active show" id="Tab11" role="tabpanel">
                                            <a id="RH_DEF_INDICES_AJD_CUSTO_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="RH_DEF_INDICES_AJD_CUSTO" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                        </div>
                                        <div class="tab-pane fade" id="Tab12" role="tabpanel">
                                            <div class="alert alert-info" role="alert">
                                                <strong><?php echo $ui_available_soon; ?></strong>
                                            </div>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="Tab2" role="tabpanel">
                            <a id="RH_DEF_REGRAS_AJD_CUSTO_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="RH_DEF_REGRAS_AJD_CUSTO" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                        </div>
                        
                        <div class="tab-pane fade" id="Tab3" role="tabpanel">
                            <a id="DG_DEF_ROTAS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="DG_DEF_ROTAS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                        </div>
                        
                    </div>                    
                </div>                    

            </div> 
        </div>
    </div>
</div>

<script>
    pageSetUp();

    $(document).ready(function () {
        
        var NR_DECIMALS = 2;
        
        //Tabelas de Ajudas Custo
        var optionsRH_DEF_TABELAS_AJD_CST = {
            "tableId": 'RH_DEF_TABELAS_AJD_CST',
            "table": "RH_DEF_TABELAS_AJD_CST", 
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_proficiency_type; ?>",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "REF_AJC": {"type": "number"}
                }
            },
            "crudOnMasterInactive": {
                "condition": "data.ACTIVO === 'N'",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },
            "detailsObjects": ['RH_DEF_INDICES_AJD_CUSTO'],                    
            "order_by": "EMPRESA, REF_AJC",
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
                    "visible": false //DataTables
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
                    "data": 'REF_AJC',
                    "name": 'REF_AJC',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 20%;"
                    }
                }, {
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_TAB_AJC',
                    "name": 'DSP_TAB_AJC',
                    "className": "visibleColumn"
                }, {
                    "responsivePriority": 5,                    
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_TAB_AJC',
                    "name": 'DSR_TAB_AJC',
                    "className": "visibleColumn"
                }, {
                    "responsivePriority": 6,
                    "title": "<?php echo mb_strtoupper($ui_active, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_active; ?>", //Editor
                    "data": 'ACTIVO',
                    "name": 'ACTIVO',
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
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CELL',
                    "name": 'CELL',                    
                    "type": "hidden",
                    "visible": false
                }, {
                    "title": "<?php echo mb_strtoupper($ui_salary_reference, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_salary_reference; ?>",
                    "fieldInfo": "<?php echo $hint_daily_allowance_ref_cell; ?>",
                    "complexList": true, 
                    "data": 'DSP_CELL',
                    "name": 'DSP_CELL',
                    "type": "select",
                    "className": "none visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "DSP_CELLS",
                        "dependent-level": 1,
                        "deferred": true,
                        "data-db-name": "A.CELL",
                        "decodeFromTable": "RH_DEF_CELULAS A",  //TO CHANGE ON QUAD-HCM
                        "desigColumn": "CONCAT(CONCAT(A.CELL,'-'),A.DSP_CELL)", 
                        "orderBy": "A.CELL",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.TP_CELL = 'A' ",
                            "edit": " AND A.TP_CELL = 'A' "
                        }                            
                    }
                }, {
                    "title": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_payment, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_payment, 'UTF-8'); ?>" + "</span>", //Editor
                    "data": '',
                    "name": 'TIT_PAGAMENTO',
                    "type": "readonly",
                    "className": "none",
                    "defaultContent": "", //Must be used on STATIC columns content. On this case classes make there way...
                    "attr": {
                        "style": "display: none;"
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_RUB_AJC_EMPRESA',
                    "name": 'CD_RUB_AJC_EMPRESA',
                    "type": "hidden", //Editor
                    "visible": false //DataTables
                }, {
                    "complexList": true, 
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_company, 'UTF-8'); ?>" + "</span>",
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_company; ?>" + "</span>",
                    "data": 'DSP_RUBRICA_1',
                    "name": 'DSP_RUBRICA_1',
                    "className": "none visibleColumn",
                    "type": "select",
                    "attr": {
                        "dependent-group" : "RUBRICAS",
                        "dependent-level": 1,
                        "data-db-name": 'A.CD_RUBRICA',
                        "distribute-value": "CD_RUB_AJC_EMPRESA",
                        "decodeFromTable": 'RH_DEF_RUBRICAS A',
                        "desigColumn": "CONCAT(CONCAT(A.CD_RUBRICA,'-'),A.DSP_RUBRICA)",
                        "orderBy": "A.CD_RUBRICA",
                        "class": "form-control complexList chosen",
                        "whereClause": "",
                        "filter": {
                            "create": " AND A.ACTIVO = 'S' AND A.QTD_RECOLHA = 'S' ", //On-New-Record
                            "edit": " AND A.ACTIVO = 'S' AND A.QTD_RECOLHA = 'S'", //On-Edit-Record
                        }
                    }                
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_RUB_AJC_LEGAL',
                    "name": 'CD_RUB_AJC_LEGAL',
                    "type": "hidden", //Editor
                    "visible": false //DataTables
                }, {
                    "complexList": true, 
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_legal, 'UTF-8'); ?>" + "</span>",
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_legal; ?>" + "</span>",
                    "data": 'DSP_RUBRICA_2',
                    "name": 'DSP_RUBRICA_2',
                    "className": "none visibleColumn",
                    "type": "select",
                    "attr": {
                        "dependent-group" : "RUBRICAS",
                        "dependent-level": 1,
                        "data-db-name": 'A.CD_RUBRICA',
                        "distribute-value": "CD_RUB_AJC_LEGAL",
                        "decodeFromTable": 'RH_DEF_RUBRICAS A',
                        "desigColumn": "CONCAT(CONCAT(A.CD_RUBRICA,'-'),A.DSP_RUBRICA)",
                        "orderBy": "A.CD_RUBRICA",
                        "class": "form-control complexList chosen",
                        "whereClause": "",
                        "filter": {
                            "create": " AND A.ACTIVO = 'S' AND A.QTD_RECOLHA = 'S' ", //On-New-Record
                            "edit": " AND A.ACTIVO = 'S' AND A.QTD_RECOLHA = 'S'", //On-Edit-Record
                        } 
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_RUB_REF_ABAT',
                    "name": 'CD_RUB_REF_ABAT',
                    "type": "hidden", //Editor
                    "visible": false //DataTables
                }, {
                    "complexList": true, 
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_meal_deduction, 'UTF-8'); ?>" + "</span>",
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_meal_deduction; ?>" + "</span>",
                    "data": 'DSP_RUBRICA_3',
                    "name": 'DSP_RUBRICA_3',
                    "className": "none visibleColumn",
                    "type": "select",
                    "attr": {
                        "dependent-group" : "RUBRICAS",
                        "dependent-level": 1,
                        "data-db-name": 'A.CD_RUBRICA',
                        "distribute-value": "CD_RUB_REF_ABAT",
                        "decodeFromTable": 'RH_DEF_RUBRICAS A',
                        "desigColumn": "CONCAT(CONCAT(A.CD_RUBRICA,'-'),A.DSP_RUBRICA)",
                        "orderBy": "A.CD_RUBRICA",
                        "class": "form-control complexList chosen",
                        "whereClause": "",
                        "filter": {
                            "create": " AND A.ACTIVO = 'S' AND A.QTD_RECOLHA = 'S' ", //On-New-Record
                            "edit": " AND A.ACTIVO = 'S' AND A.QTD_RECOLHA = 'S'", //On-Edit-Record
                        } 
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_RUB_KMS',
                    "name": 'CD_RUB_KMS',
                    "type": "hidden", //Editor
                    "visible": false //DataTables
                }, {
                    "complexList": true, 
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_mileage_payment, 'UTF-8'); ?>" + "</span>",
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_mileage_payment; ?>" + "</span>",
                    "data": 'DSP_RUBRICA_4',
                    "name": 'DSP_RUBRICA_4',
                    "className": "none visibleColumn",
                    "type": "select",
                    "attr": {
                        "dependent-group" : "RUBRICAS",
                        "dependent-level": 1,
                        "data-db-name": 'A.CD_RUBRICA',
                        "distribute-value": "CD_RUB_KMS",
                        "decodeFromTable": 'RH_DEF_RUBRICAS A',
                        "desigColumn": "CONCAT(CONCAT(A.CD_RUBRICA,'-'),A.DSP_RUBRICA)",
                        "orderBy": "A.CD_RUBRICA",
                        "class": "form-control complexList chosen",
                        "whereClause": "",
                        "filter": {
                            "create": " AND A.ACTIVO = 'S' AND A.QTD_RECOLHA = 'S' ", //On-New-Record
                            "edit": " AND A.ACTIVO = 'S' AND A.QTD_RECOLHA = 'S'", //On-Edit-Record
                        } 
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
                        return RH_DEF_TABELAS_AJD_CST.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DESIGEMPRESA": { 
                        required: true
                    },
                    "REF_AJC": { 
                        required: true,
                        integer: true,
                        maxlength: 10
                    },
                    "DSP_TAB_AJC": {
                        required: true,
                        maxlength: 40
                    },
                    "DSR_TAB_AJC": {
                        required: false,
                        maxlength: 25
                    },
                    "ACTIVO": {
                        required: true
                    }                   
                }
            },              
        };
        RH_DEF_TABELAS_AJD_CST = new QuadTable();
        RH_DEF_TABELAS_AJD_CST.initTable( $.extend( {}, datatable_instance_defaults, optionsRH_DEF_TABELAS_AJD_CST ) );        
        //END Proficiency Scales
        
        //Indices
        var optionsRH_DEF_INDICES_AJD_CUSTO = {
            "tableId": 'RH_DEF_INDICES_AJD_CUSTO',
            "table": "RH_DEF_INDICES_AJD_CUSTO", 
//            "inlineOp": {
//                    edit: true,
//                    create: true
//            },
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "REF_AJC": {"type": "number"},
                    "INDICE": {"type": "number"},
                }
            },            
            "dependsOn": {
                "RH_DEF_TABELAS_AJD_CST": {
                    //External object key mapping( object key : external key)
                    "EMPRESA": "EMPRESA",
                    "REF_AJC": "REF_AJC"
                }
            },
            "order_by": "INDICE",
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
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'REF_AJC',
                    "name": 'REF_AJC',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_index, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_index; ?>", //Editor
                    "data": 'INDICE',
                    "name": 'INDICE',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 30%;"
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_lower_limit, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_lower_limit; ?>", //Editor
                    "data": 'LIMITE_INF',
                    "name": 'LIMITE_INF',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 60%;"
                    },
                    "render": function (val, type, row) {
                        if (val) {
                            val = round (val, NR_DECIMALS);
                        }
                        return val;
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_upper_limit, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_upper_limit; ?>", //Editor
                    "data": 'LIMITE_SUP',
                    "name": 'LIMITE_SUP',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 60%;"
                    } ,
                    "render": function (val, type, row) {
                        if (val) {
                            val = round (val, NR_DECIMALS);
                        }
                        return val;
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_national_ceiling, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_national_ceiling; ?>", //Editor
                    "data": 'LIM_NAC',
                    "name": 'LIM_NAC',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 60%;"
                    },
                    "render": function (val, type, row) {
                        if (val) {
                            val = round (val, NR_DECIMALS);
                        }
                        return val;
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_country_value, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_country_value; ?>", //Editor
                    "data": 'VLR_NAC',
                    "name": 'VLR_NAC',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 60%;"
                    },
                    "render": function (val, type, row) {
                        if (val) {
                            val = round (val, NR_DECIMALS);
                        }
                        return val;
                    } 
                }, {
                    "title": "<?php echo mb_strtoupper($ui_foreign_ceiling, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_foreign_ceiling; ?>", //Editor
                    "data": 'LIM_ESTRG',
                    "name": 'LIM_ESTRG',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 60%;"
                    },
                    "render": function (val, type, row) {
                        if (val) {
                            val = round (val, NR_DECIMALS);
                        }
                        return val;
                    } 
                }, {
                    "title": "<?php echo mb_strtoupper($ui_foreign_value, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_foreign_value; ?>", //Editor
                    "data": 'VLR_ESTG',
                    "name": 'VLR_ESTG',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 60%;"
                    },
                    "render": function (val, type, row) {
                        if (val) {
                            val = round (val, NR_DECIMALS);
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
                        return RH_DEF_INDICES_AJD_CUSTO.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "INDICE": { 
                        required: true,
                        integer: true,
                        maxlength: 4
                    },
                    "LIMITE_INF": { 
                        number: true
                    },
                    "LIMITE_SUP": { 
                        number: true
                    },
                    "LIM_NAC": { 
                        number: true
                    },
                    "LIM_ESTRG": { 
                        number: true
                    },
                    "VLR_NAC": { 
                        number: true
                    },
                    "VLR_ESTG": { 
                        number: true
                    }
                }
            },              
        };
        RH_DEF_INDICES_AJD_CUSTO = new QuadTable();
        RH_DEF_INDICES_AJD_CUSTO.initTable( $.extend( {}, datatable_instance_defaults, optionsRH_DEF_INDICES_AJD_CUSTO ) );        
        //END Indices

        //Regras
        var optionsRH_DEF_REGRAS_AJD_CUSTO = {
            "tableId": 'RH_DEF_REGRAS_AJD_CUSTO',
            "table": "RH_DEF_REGRAS_AJD_CUSTO", 
            //"selectRecordMsg": "<?php echo $ui_please_select_record . $ui_proficiency_type; ?>",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_REGRA": {"type": "number"}
                }
            },
            "crudOnMasterInactive": {
                "condition": "data.ACTIVO === 'N'",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },
            //"detailsObjects": ['RH_DEF_INDICES_AJD_CUSTO'],                    
            "order_by": "EMPRESA, ID_REGRA",
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
                    "visible": false //DataTables
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
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'ID_REGRA',
                    "name": 'ID_REGRA',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 20%;"
                    }
                }, {
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_REGRA',
                    "name": 'DSP_REGRA',
                    "className": "visibleColumn"
                }, {
                    "responsivePriority": 5,                    
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_REGRA',
                    "name": 'DSR_REGRA',
                    "className": "visibleColumn"
                }, {
                    "responsivePriority": 6,
                    "title": "<?php echo mb_strtoupper($ui_active, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_active; ?>", //Editor
                    "data": 'ACTIVO',
                    "name": 'ACTIVO',
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
                    "responsivePriority": 7,
                    "title": "<?php echo mb_strtoupper($ui_travel_type, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_travel_type; ?>", //Editor
                    "data": 'TP_DESLOC',
                    "name": 'TP_DESLOC',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'RH_DEF_REGRAS_AJD_CUSTO.TP_DESLOC',
                        "class": "form-control"
                    }                    
                }, {
                    "title": "<?php echo mb_strtoupper($ui_day_type, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_day_type; ?>", //Editor
                    "data": 'TP_DIA',
                    "name": 'TP_DIA',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'RH_DEF_REGRAS_AJD_CUSTO.TP_DIA',
                        "class": "form-control"
                    }                    
                }, {
                    "title": "<?php echo mb_strtoupper($ui_public_administration, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_public_administration; ?>", //Editor
                    "data": 'OFICIAL',
                    "name": 'OFICIAL',
                    "type": "select",
                    "def": "N",
                    "className": "none visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',
                        "class": "form-control"
                    } 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_REGRA_FP',
                    "name": 'ID_REGRA_FP',                    
                    "type": "hidden",
                    "visible": false
                }, {
                    "title": "<?php echo mb_strtoupper($ui_company_rule, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_company_rule; ?>",
                    "complexList": true, 
                    "data": 'DSP_REGRA_FP',
                    "name": 'DSP_REGRA_FP',
                    "type": "select",
                    "className": "none visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "DSP_REGRA_REF",
                        "dependent-level": 1,
                        "deferred": true,
                        "data-db-name": "A.ID_REGRA",
                        "distribute-value": "ID_REGRA_FP",
                        "decodeFromTable": "RH_DEF_REGRAS_AJD_CUSTO A",  //TO CHANGE ON QUAD-HCM
                        "desigColumn": "A.DSP_REGRA", 
                        "orderBy": "A.ID_REGRA",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.EMPRESA = ':EMPRESA' AND A.ID_REGRA != ':ID_REGRA' AND A.ACTIVO = 'A' ",
                            "edit": " AND A.EMPRESA = ':EMPRESA' AND A.ID_REGRA != ':ID_REGRA' AND A.ACTIVO = 'A' "
                        }                            
                    } 
                }, {
                    "title": "<?php echo mb_strtoupper($ui_perc_before_lunch, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_perc_before_lunch; ?>", //Editor
                    "data": 'PCT_INIC',
                    "name": 'PCT_INIC',
                    "className": "none visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 20%;"
                    }                    
                }, {
                    "title": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_lunch, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_lunch, 'UTF-8'); ?>" + "</span>", //Editor
                    "data": '',
                    "name": 'TIT_LUNCH',
                    "type": "readonly",
                    "className": "none",
                    "defaultContent": "", //Must be used on STATIC columns content. On this case classes make there way...
                    "attr": {
                        "style": "display: none;"
                    }
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_begin, 'UTF-8'); ?>" + "</span>", //Datatables
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_begin; ?>" + "</span>", //Editor
                    "data": 'HR_INI_ALM',
                    "name": 'HR_INI_ALM',
                    //"datatype": "time24Minutes", //HH24:MI
                    "className": "none visibleColumn",
                    "attr": {
                        "class": "form-control dateTimePickerTimeFormatShort timeshort" //(.datepicker OR .dateTimePickerShort OR .dateTimePicker) AND (.minutes OR .seconds for CSS format width)
                    }   
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_end, 'UTF-8'); ?>" + "</span>", //Datatables
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_end; ?>" + "</span>", //Editor
                    "data": 'HR_FIM_ALM',
                    "name": 'HR_FIM_ALM',
                    //"datatype": "time24Minutes", //HH24:MI
                    "className": "none visibleColumn",
                    "attr": {
                        "class": "form-control dateTimePickerTimeFormatShort timeshort" //(.datepicker OR .dateTimePickerShort OR .dateTimePicker) AND (.minutes OR .seconds for CSS format width)
                    } 
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_perc_lunch, 'UTF-8'); ?>" + "</span>", //Datatables
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_perc_lunch; ?>" + "</span>", //Editor
                    "data": 'PCT_MEIO',
                    "name": 'PCT_MEIO',
                    "className": "none visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 20%;"
                    }
                }, {
                    "title": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_dinner, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_dinner, 'UTF-8'); ?>" + "</span>", //Editor
                    "data": '',
                    "name": 'TIT_DINNER',
                    "className": "none",
                    "defaultContent": "", //Must be used on STATIC columns content. On this case classes make there way...
                    "attr": {
                        "style": "display: none;"
                    }
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_begin, 'UTF-8'); ?>" + "</span>", //Datatables
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_begin; ?>" + "</span>", //Editor
                    "data": 'HR_INI_JAN',
                    "name": 'HR_INI_JAN',
                    //"datatype": "time24Minutes", //HH24:MI
                    "className": "none visibleColumn",
                    "attr": {
                        "class": "form-control dateTimePickerTimeFormatShort timeshort" //(.datepicker OR .dateTimePickerShort OR .dateTimePicker) AND (.minutes OR .seconds for CSS format width)
                    }   
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_end, 'UTF-8'); ?>" + "</span>", //Datatables
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_end; ?>" + "</span>", //Editor
                    "data": 'HR_FIM_JAN',
                    "name": 'HR_FIM_JAN',
                    //"datatype": "time24Minutes", //HH24:MI
                    "className": "none visibleColumn",
                    "attr": {
                        "class": "form-control dateTimePickerTimeFormatShort timeshort" //(.datepicker OR .dateTimePickerShort OR .dateTimePicker) AND (.minutes OR .seconds for CSS format width)
                    } 
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_perc_dinner, 'UTF-8'); ?>" + "</span>", //Datatables
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_perc_dinner; ?>" + "</span>", //Editor
                    "data": 'PCT_FIM',
                    "name": 'PCT_FIM',
                    "className": "none visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 20%;"
                    }                    
                }, {
                    "title": "<?php echo mb_strtoupper($ui_perc_overnight, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_perc_overnight; ?>", //Editor
                    "data": 'PCT_DORMIDA',
                    "name": 'PCT_DORMIDA',
                    "className": "none visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 20%;"
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
                        return RH_DEF_REGRAS_AJD_CUSTO.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DESIGEMPRESA": { 
                        required: true
                    },
                    "ID_REGRA": { 
                        required: true,
                        integer: true,
                        maxlength: 10
                    },
                    "DSP_REGRA": {
                        required: true,
                        maxlength: 40
                    },
                    "DSR_REGRA": {
                        required: false,
                        maxlength: 25
                    },
                    "ACTIVO": {
                        required: true
                    },
                    "OFICIAL": {
                        required: true
                    },
                    "TP_DESLOC": {
                        required: true
                    },
                    "PCT_INIC": {
                        number: true
                    },
                    "PCT_MEIO": {
                        number: true
                    },
                    "PCT_FIM": {
                        number: true
                    },
                    "PCT_DORMIDA": {
                        number: true
                    },
                    "HR_INI_ALM": {
                        required: false,
                        time24Minutes: true
                    },
                    "HR_FIM_ALM": {
                        required: false,
                        time24Minutes: true
                    },
                    "HR_INI_JAN": {
                        required: false,
                        time24Minutes: true
                    },
                    "HR_FIM_JAN": {
                        required: false,
                        time24Minutes: true
                    }
                }
            },              
        };
        RH_DEF_REGRAS_AJD_CUSTO = new QuadTable();
        RH_DEF_REGRAS_AJD_CUSTO.initTable( $.extend( {}, datatable_instance_defaults, optionsRH_DEF_REGRAS_AJD_CUSTO ) );                
        ///END Regras
        
        //Rotas :: DG_DEF_ROTAS
        var optionsDG_DEF_ROTAS = {
            "tableId": 'DG_DEF_ROTAS',
            "table": "DG_DEF_ROTAS", 
            "pk": {
                "primary": {
                    "CD_ROTA": {"type": "varchar"}
                }
            },
            "order_by": "CD_ROTA",
            "scrollY": "390", 
            "recordBundle": 11,
            "pageLenght": 11, 
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "width": "1%", 
                    "className": "control toBottom toCenter",
                    "orderable": false,
                    "defaultContent": ''
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'CD_ROTA',
                    "name": 'CD_ROTA',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 20%;"
                    }
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_ROTA',
                    "name": 'DSP_ROTA',
                    "className": "visibleColumn"
                }, {
                    "responsivePriority": 4,                    
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_ROTA',
                    "name": 'DSR_ROTA',
                    "className": "visibleColumn"
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_mileage, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_mileage; ?>", //Editor
                    "data": 'DISTANCIA_KM',
                    "name": 'DISTANCIA_KM',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 40%;"
                    }
                }, {
                    "responsivePriority": 6,
                    "title": "<?php echo mb_strtoupper($ui_active, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_active; ?>", //Editor
                    "data": 'ACTIVO',
                    "name": 'ACTIVO',
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
                        return DG_DEF_ROTAS.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "CD_ROTA": { 
                        required: true,
                        maxlength: 6
                    },
                    "DSP_ROTA": { 
                        required: true,
                        maxlength: 40
                    },
                    "DSR_ROTA": {
                        required: true,
                        maxlength: 25
                    },
                    "DISTANCIA_KM": {
                        number: true
                    },
                    "ACTIVO": {
                        required: true
                    }                   
                }
            },              
        };
        DG_DEF_ROTAS = new QuadTable();
        DG_DEF_ROTAS.initTable( $.extend( {}, datatable_instance_defaults, optionsDG_DEF_ROTAS ) );
        ///END Rotas
        
    });
</script>
