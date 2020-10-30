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
                            <h2><?php echo $ui_fiscal_years; ?></h2>
                        </div>
                        <div class="panel-container show">
                            <div class="panel-content">                                            
                                <a id="DG_ANOS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                <table id="DG_ANOS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
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
                                <a class="nav-link active" data-toggle="tab" href="#Tab1" role="tab" aria-selected="true"><?php echo $ui_months; ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#Tab2" role="tab" aria-selected="true"><?php echo $ui_discharges; ?></a>
                            </li>
                        </ul>
                    </div>
                </div>   

                <div class="panel-container show">
                    <div class="panel-content">

                        <div class="tab-content">

                             <!-- TAB #1 -->
                            <div class="tab-pane fade active show" id="Tab1" role="tabpanel">
                                <a id="DG_MESES_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                <table id="DG_MESES" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            </div>
                             <!-- END TAB #1 -->

                             <!-- TAB #2 -->
                            <div class="tab-pane fade" id="Tab2" role="tabpanel">
                                <a id="DG_RUBRICAS_QUITACOES_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                <table id="DG_RUBRICAS_QUITACOES" class="table responsive table-bordered table-striped table-hover nowrap"></table>
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

    var y = "<?php echo @$_SESSION['lang']; ?>";

    $(document).ready(function () {

        //Instance Definitions

        //Anos
        var optionDG_ANOS = {
            "tableId": "DG_ANOS",
            "table": "DG_ANOS", 
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_fiscal_year; ?>",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ANO": {"type": "number"}
                }
            },
            "crudOnMasterInactive": {
                "condition": "data.ESTADO !== 'A'",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },
            "detailsObjects": ['DG_MESES','DG_RUBRICAS_QUITACOES'], //'DG_MESES', 'DG_RUBRICAS_QUITACOES], 
            //"initialWhereClause": "",
            "order_by": "EMPRESA, ANO DESC",
            "recordBundle": 13,
            "pageLenght": 13, 
            "scrollY": "234", //"390", 
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
                    "title": "<?php echo mb_strtoupper($ui_year, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_year; ?>", //Editor
                    "data": 'ANO',
                    "name": 'ANO',
                    "className": "right visibleColumn",  
                    "attr": {
                        "style": "width:25%;"
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_MOEDA',
                    "name": 'CD_MOEDA',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables 
                }, {
                    "responsivePriority": 4,
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_currency, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_currency; ?>",
                    "data": 'DSP_MOEDA',
                    "name": 'DSP_MOEDA',
                    "type": "select",
                    "className": "visibleColumn",
                    "renew": true, 
                    "attr": {
                        "class": "form-control complexList chosen", 
                        "dependent-group": "MOEDAS",
                        "dependent-level": 1,
                        "data-db-name": "A.CD_MOEDA",
                        "decodeFromTable": "DG_MOEDAS A",
                        "desigColumn": "A.DSP_MOEDA", 
                        "orderBy": "A.CD_MOEDA",
                        "filter": {
                            "create": " AND A.ATIVO = 'S'", //On-New-Record
                            "edit": " AND A.ATIVO = 'S'", //On-Edit-Record
                        }
                    }                    
                }, {
                    "responsivePriority": 5,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INICIO',
                    "name": 'DT_INICIO',
                    "datatype": 'date',
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
                    "responsivePriority": 7, 
                    "title": "<?php echo mb_strtoupper($ui_status, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_status; ?>", //Editor
                    "data": 'ESTADO',
                    "name": 'ESTADO',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_MESES.RH_ESTADO',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_MESES.RH_ESTADO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }                        
                }, {
                    "responsivePriority": 8, 
                    "title": "<?php echo mb_strtoupper($ui_closing_dt, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_closing_dt; ?>", //Editor
                    "data": 'DT_ENCERRAMENTO',
                    "name": 'DT_ENCERRAMENTO',
                    "datatype": 'datetime',
                    "className": "visibleColumn",
                    "disabled": true, //Permite inibir o campo no Editor
                    "attr": {
                        "class": "dateTimePicker seconds" //(.datepicker OR .dateTimePickerShort OR .dateTimePicker) AND (.minutes OR .seconds for CSS format width)
                    }
                }, {
                    "title": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_vacation, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_vacation, 'UTF-8'); ?>" + "</span>", //Editor
                    "data": '',
                    "name": 'TIT_FERIAS',
                    "type": "readonly",
                    "className": "none",
                    "defaultContent": "", //Must be used on STATIC columns content. On this case classes make there way...
                    "attr": {
                        "style": "display: none;"
                    }                         
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_method, 'UTF-8'); ?>" + "</span>", //Datatables
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_method; ?>" + "</span>", //Editor
                    "data": 'RH_METODO_FERIAS',
                    "name": 'RH_METODO_FERIAS',
                    "type": "select",
                    "className": "none visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_ANOS.RH_METODO_FERIAS',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_ANOS.RH_METODO_FERIAS'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }                                       
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'RH_RUBRICA_FERIAS',
                    "name": 'RH_RUBRICA_FERIAS',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables 
                }, {
                    "complexList": true, 
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_wage_item, 'UTF-8'); ?>" + "</span>",
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_wage_item; ?>" + "</span>",
                    "data": 'DSP_RUBRICA_FERIAS',
                    "name": 'DSP_RUBRICA_FERIAS',
                    "type": "select",
                    "className": "none visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group" : "RUBRICAS",
                        "dependent-level": 1,
                        "data-db-name": 'A.CD_RUBRICA',
                        "distribute-value": "RH_RUBRICA_FERIAS",
                        "decodeFromTable": 'RH_DEF_RUBRICAS A',
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
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_days, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_days; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_hollidays_without_additions; ?>" + "</span>",
                    "data": 'RH_DIAS_FERIAS',
                    "name": 'RH_DIAS_FERIAS',
                    "className": "none visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 15%;"
                    }   
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_addition, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_addition; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_days; ?>",
                    "data": 'RH_DIAS_ACRESCIMO',
                    "name": 'RH_DIAS_ACRESCIMO',
                    "className": "none visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 15%;"
                    }                        
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_min_months, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_min_months; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_min_month_hollidays; ?>",
                    "data": 'RH_MES_VAL_FERIAS',
                    "name": 'RH_MES_VAL_FERIAS',
                    "className": "none visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 15%;"
                    }
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_half_vacation_days, 'UTF-8'); ?>" + "</span>", //Datatables
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_half_vacation_days; ?>" + "</span>", //Editor
                    "data": 'RH_MEIOS_DIAS_FERIAS',
                    "name": 'RH_MEIOS_DIAS_FERIAS',
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
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_vacation_negative_balance, 'UTF-8'); ?>" + "</span>", //Datatables
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_vacation_negative_balance; ?>" + "</span>", //Editor
                    "fieldInfo": "<?php echo $hint_vacation_negative_balance; ?>",
                    "data": 'RH_FERIAS_NEG',
                    "name": 'RH_FERIAS_NEG',
                    "type": "select",
                    "def": "N",
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
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_vacation_negative_balance_max_days, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_vacation_negative_balance_max_days; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_vacation_negative_balance_max_days; ?>",
                    "data": 'RH_LIMITE_FER_NEG',
                    "name": 'RH_LIMITE_FER_NEG',
                    "className": "none visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 15%;"
                    }                        
                }, {
                    "title": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_christmas, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_christmas, 'UTF-8'); ?>" + "</span>", //Editor
                    "data": '',
                    "name": 'TIT_NATAL',
                    "type": "readonly",
                    "className": "none",
                    "defaultContent": "", //Must be used on STATIC columns content. On this case classes make there way...
                    "attr": {
                        "style": "display: none;"
                    }                         
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_method, 'UTF-8'); ?>" + "</span>", //Datatables
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_method; ?>" + "</span>", //Editor
                    "data": 'RH_METODO_NATAL',
                    "name": 'RH_METODO_NATAL',
                    "type": "select",
                    "className": "none visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_ANOS.RH_METODO_NATAL',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_ANOS.RH_METODO_NATAL'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }                                       
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'RH_RUBRICA_NATAL',
                    "name": 'RH_RUBRICA_NATAL',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "complexList": true, 
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_wage_item, 'UTF-8'); ?>" + "</span>",
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_wage_item; ?>" + "</span>",
                    "data": 'DSP_RUBRICA_NATAL',
                    "name": 'DSP_RUBRICA_NATAL',
                    "type": "select",
                    "className": "none visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group" : "RUBRICAS",
                        "dependent-level": 1,
                        "data-db-name": 'A.CD_RUBRICA',
                        "distribute-value": "RH_RUBRICA_NATAL",
                        "decodeFromTable": 'RH_DEF_RUBRICAS A',
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
                    "title": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_interfaces, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_interfaces, 'UTF-8'); ?>" + "</span>", //Editor
                    "data": '',
                    "name": 'TIT_INTERFACES',
                    "type": "readonly",
                    "className": "none",
                    "defaultContent": "", //Must be used on STATIC columns content. On this case classes make there way...
                    "attr": {
                        "style": "display: none;"
                    }                        
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_vacation_days, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<span class='quadSubTitle '>" + "<?php echo $ui_vacation_days; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_programmatic_reference; ?>",
                    "data": 'RH_PRG_DIAS_FERIAS',
                    "name": 'RH_PRG_DIAS_FERIAS',
                    "className": "none visibleColumn",
                    "attr": {
                        "class": "form-control"
                    }                         
                }, {
                    "data": 'RH_UNID_VAL_FER',
                    "name": 'RH_UNID_VAL_FER',
                    "def": "U",
                    "type": "hidden",
                    "visible": "false",
                    "visible": false,
//                    }, {
//                        "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_vacation_unit, 'UTF-8'); ?>" + "</span>", //Datatables
//                        "label": "<span class='quadSubTitle'>" + "<?php echo $ui_vacation_unit; ?>" + "</span>", //Editor
//                        "data": 'RH_UNID_VAL_FER',
//                        "name": 'RH_UNID_VAL_FER',
//                        "type": "select",
//                        "def": "U"
//                        "className": "none visibleColumn",
//                        "attr": {
//                            "domain-list": true,
//                            "dependent-group": 'DG_ANOS.RH_UNID_VAL_FER',
//                            "class": "form-control"
//                        },
//                        "render": function (val, type, row) {
//                            if (val != null) {
//                                var o = _.find(initApp.joinsData['DG_ANOS.RH_UNID_VAL_FER'], {'RV_LOW_VALUE': val});
//                                return val == null ? null : o['RV_MEANING'];
//                            }
//                            return val;
//                        }              
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_vacation_payment, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<span class='quadSubTitle '>" + "<?php echo $ui_vacation_payment; ?>" + "</span>", //Editor
                    "fieldInfo": "<?php echo $hint_programmatic_reference; ?>",
                    "data": 'RH_PRG_PAGA_FERIAS',
                    "name": 'RH_PRG_PAGA_FERIAS',
                    "className": "none visibleColumn",
                    "attr": {
                        "class": "form-control"
                    }    

                }, {
                    "title": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_adaptability, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_adaptability, 'UTF-8'); ?>" + "</span>", //Editor
                    "data": '',
                    "name": 'TIT_ADAPABILIDADE',
                    "type": "readonly",
                    "className": "none",
                    "defaultContent": "", //Must be used on STATIC columns content. On this case classes make there way...
                    "attr": {
                        "style": "display: none;"
                    }    
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_adaptability_negative_balance, 'UTF-8'); ?>" + "</span>", //Datatables
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_adaptability_negative_balance; ?>" + "</span>", //Editor
                    "fieldInfo": "<?php echo $hint_negative_balance_minutes; ?>",
                    "data": 'RH_ADAP_NEG',
                    "name": 'RH_ADAP_NEG',
                    "type": "select",
                    "def": "N",
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
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_adaptability_negative_balance_max_minutes, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_adaptability_negative_balance_max_minutes; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_negative_balance_max_minutes; ?>",
                    "data": 'RH_LIMITE_ADAP_NEG',
                    "name": 'RH_LIMITE_ADAP_NEG',
                    "className": "none visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 15%;"
                    }                                                 
                }, {
                    "title": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_compensatory_rest_short, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_compensatory_rest_short, 'UTF-8'); ?>" + "</span>", //Editor
                    "data": '',
                    "name": 'TIT_DC',
                    "type": "readonly",
                    "className": "none",
                    "defaultContent": "", //Must be used on STATIC columns content. On this case classes make there way...
                    "attr": {
                        "style": "display: none;"
                    }    
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_compensatory_rest_negative_balance, 'UTF-8'); ?>" + "</span>", //Datatables
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_compensatory_rest_negative_balance; ?>" + "</span>", //Editor
                    "fieldInfo": "<?php echo $hint_negative_balance_minutes; ?>",
                    "data": 'RH_DC_NEG',
                    "name": 'RH_DC_NEG',
                    "type": "select",
                    "def": "N",
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
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_compensatory_rest_negative_balance_max_minutes, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_compensatory_rest_negative_balance_max_minutes; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_negative_balance_max_minutes; ?>",
                    "data": 'RH_LIMITE_DC_NEG',
                    "name": 'RH_LIMITE_DC_NEG',
                    "className": "none visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 15%;"
                    } 
                }, {
                    "title":"<?php echo mb_strtoupper($ui_work_insurance_policy, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_work_insurance_policy; ?>", //Editor       
                    "data": 'RH_MSG_APOLICE_AT',
                    "name": 'RH_MSG_APOLICE_AT',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 335px"
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
                        return DG_ANOS.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DSP_EMPRESA": {
                        required: true
                    },
                    "ANO": {
                        required: true,
                        maxlength: 4
                    },
                    "DSP_MOEDA": {
                        required: true
                    },
                    "DT_INICIO": {
                        required: true,
                        dateISO: true
                    },
                    "DT_FIM": {
                        dateISO: true,
                        dateEqOrNextThan: 'DT_INICIO',
                    },
                    "ESTADO": {
                        required: true
                    },
                    "RH_MEIOS_DIAS_FERIAS": {
                        required: true
                    },
                    "RH_DIAS_FERIAS": {
                        integer: true,
                        maxlength: 4
                    },
                    "RH_DIAS_ACRESCIMO": {
                        integer: true,
                        maxlength: 4
                    },
                    "RH_MSG_APOLICE_AT": {
                        maxlength: 150
                    },
                    "RH_MES_VAL_FERIAS": {
                        integer: true,
                        maxlength: 2
                    },
                    "RH_PRG_DIAS_FERIAS": {
                        maxlength: 15
                    },
                    "RH_PRG_PAGA_FERIAS": {
                        maxlength: 15
                    },
                    "RH_FERIAS_NEG": {
                        required: true
                    },
                    "RH_LIMITE_FER_NEG": {
                        integer: true,
                        maxlength: 2
                    },
                    "RH_ADAP_NEG": {
                        required: true
                    },
                    "RH_LIMITE_DC_NEG": {
                        integer: true,
                        maxlength: 5
                    },
                    "RH_DC_NEG": {
                        required: true
                    },
                    "RH_LIMITE_DC_NEG": {
                        integer: true,
                        maxlength: 5
                    }        
                }
            },
            //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
            "messages": {
                "DT_FIM": {
                    dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                }
            }
        };
        DG_ANOS = new QuadTable();
        DG_ANOS.initTable( $.extend({}, datatable_instance_defaults, optionDG_ANOS) );
        //END Empresa

        //Meses
        var optionsDG_MESES = {
            "tableId": "DG_MESES",
            "table": "DG_MESES",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_month; ?>",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ANO": {"type": "varchar"},                     
                    "MES": {"type": "number"}
                }
            },
            "dependsOn": {
                "DG_ANOS": {
                    "EMPRESA": "EMPRESA",
                    "ANO": "ANO"
                }
            },
            "crudOnMasterInactive": {
                "condition": " (data.RH_ESTADO !== 'A' && data.RH_ESTADO !== 'B') ",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },
            "order_by": "MES",
            "recordBundle": 15,
            "pageLenght": 15, 
            "scrollY": "546",
            "detailsObjects": ['RH_DEF_PERIODOS','DG_DEF_INTEGRACOES'],
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
                    "visible": false
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ANO',
                    "name": 'ANO',                    
                    "type": "hidden",
                    "visible": false
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_month, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_month; ?>", //Editor
                    "data": 'MES',
                    "name": 'MES',
                    "className": "right visibleColumn",  
                    "attr": {
                        "style": "width:25%;"
                    }
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'RH_DT_INICIO',
                    "name": 'RH_DT_INICIO',
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
                    "data": 'RH_DT_FIM',
                    "name": 'RH_DT_FIM',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }
                }, {
                    "responsivePriority": 5, 
                    "title": "<?php echo mb_strtoupper($ui_status, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_status; ?>", //Editor
                    "data": 'RH_ESTADO',
                    "name": 'RH_ESTADO',
                    "type": "select",
                    "def": "N",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_MESES.RH_ESTADO',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_MESES.RH_ESTADO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }
                }, {
                    "responsivePriority": 6,
                    "title": "<?php echo mb_strtoupper($ui_begin_dt_attendance_period, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_dt_attendance_period; ?>", //Editor
                    "data": 'DT_INI_PER_ASSID',
                    "name": 'DT_INI_PER_ASSID',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }
                }, {
                    "responsivePriority": 7, 
                    "title": "<?php echo mb_strtoupper($ui_end_dt_attendance_period, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_dt_attendance_period; ?>", //Editor
                    "data": 'DT_FIM_PER_ASSID',
                    "name": 'DT_FIM_PER_ASSID',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }
                }, {
                    "responsivePriority": 8, 
                    "title": "<?php echo mb_strtoupper($ui_status_attendance_period, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_status_attendance_period; ?>", //Editor
                    "data": 'ESTADO_PER_ASSID',
                    "name": 'ESTADO_PER_ASSID',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_MESES.ESTADO_PER_ASSID',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_MESES.ESTADO_PER_ASSID'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_value_dt, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_value_dt; ?>", //Editor
                    "data": 'RH_DT_VALOR',
                    "name": 'RH_DT_VALOR',
                    "datatype": 'date',
                    "className": "none visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }                        
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'OPERACAO',
                    "name": 'OPERACAO',                    
                    "type": "hidden",
                    "visible": false
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'SERIE',
                    "name": 'SERIE',                    
                    "type": "hidden",
                    "visible": false
                }, {
                    "title": "<?php echo mb_strtoupper($ui_serie, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_serie; ?>",
                    "complexList": true, 
                    "data": 'DSP_SERIE',
                    "name": 'DSP_SERIE',
                    "type": "select",
                    "className": "none visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "SERIES_DOC",
                        "dependent-level": 1,
                        "deferred": true,
                        "data-db-name": "A.EMPRESA@A.ANO@A.OPERACAO@A.SERIE",
                        "decodeFromTable": "DG_SERIE_DOCUMENTOS A",  //TO CHANGE ON QUAD-HCM
                        "desigColumn": "A.SERIE", 
                        "orderBy": "A.SERIE",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.EMPRESA = ':EMPRESA' AND A.ANO = ':ANO' AND A.OPERACAO = 'A' AND A.ACTIVA = 'S' ",
                            "edit": " AND A.EMPRESA = ':EMPRESA' AND A.ANO = ':ANO' AND A.OPERACAO = 'A' AND A.ACTIVA = 'S' "
                        }                            
                    }                         
                }, {
                    "title": "<?php echo mb_strtoupper($ui_monthly_counter, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo mb_strtoupper($ui_monthly_counter, 'UTF-8'); ?>", //Editor
                    "data": 'RESET_CONTADOR',
                    "name": 'RESET_CONTADOR',
                    "type": "select",
                    "def": "N",
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
                    "title": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_fractionation, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_fractionation, 'UTF-8'); ?>" + "</span>", //Editor
                    "data": 'FRACIONAMENTO',
                    "name": 'FRACIONAMENTO',
                    "type": "select",
                    "def": "N",
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
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_maximum_rate, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_maximum_rate; ?>" + "</span>", //Editor
                    "data": 'TX_MAX_FRAC',
                    "name": 'TX_MAX_FRAC',
                    "className": "none visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 25%;"
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CELL_FRAC',
                    "name": 'CELL_FRAC',                    
                    "type": "hidden",
                    "visible": false
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_standard_cell, 'UTF-8'); ?>" + "</span>",
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_standard_cell; ?>" + "</span>",
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
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ANO_RETRO_FRAC',
                    "name": 'ANO_RETRO_FRAC',                    
                    "type": "hidden",
                    "visible": false                        
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'RETRO_ID_FRAC',
                    "name": 'RETRO_ID_FRAC',                    
                    "type": "hidden",
                    "visible": false   
               }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_retroactive, 'UTF-8'); ?>" + "</span>",
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_retroactive; ?>" + "</span>",
                    "complexList": true, 
                    "data": 'DSP_RETRO',
                    "name": 'DSP_RETRO',
                    "type": "select",
                    "className": "none visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "DSP_RETROS",
                        "dependent-level": 1,
                        "deferred": true,
                        "data-db-name": "A.EMPRESA@A.ANO@A.RETRO_ID",
                        "distribute-value": "A.EMPRESA@A.ANO_RETRO_FRAC@A.RETRO_ID_FRAC",
                        "decodeFromTable": "RH_DEF_RETROACTIVOS A",  //TO CHANGE ON QUAD-HCM
                        "desigColumn": "CONCAT(CONCAT(A.RETRO_ID,'-'),A.DSP_RETRO)", 
                        "orderBy": "A.RETRO_ID",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.TEMPLATE = 'S' ",
                            "edit": " AND A.TEMPLATE = 'S' "
                        }                            
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CELL_FRAC_INDIV',
                    "name": 'CELL_FRAC_INDIV',                    
                    "type": "hidden",
                    "visible": false 
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_individual_cell, 'UTF-8'); ?>" + "</span>",
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_individual_cell; ?>" + "</span>",
                    "complexList": true, 
                    "data": 'DSP_CELL_INDIV',
                    "name": 'DSP_CELL_INDIV',
                    "type": "select",
                    "className": "none visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "DSP_CELLS",
                        "dependent-level": 1,
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
                        return DG_MESES.crudButtons(true,true,true);
                    }
                }
            ],
            validations: {
                rules: {
                    MES: {
                        required: true
                    },
                    CAMBIO: {
                        required: true,
                        number: true
                    },
                    RH_DT_INICIO: {
                        required: true,
                        dateISO: true
                    },
                    "RH_DT_FIM": {
                        dateISO: true,
                        dateEqOrNextThan: "RH_DT_INICIO",
                    },
                    "RH_DT_VALOR": {
                        required: false,
                        dateISO: true
                    },
                    "RH_ESTADO": {
                        required: false
                    },
                    "DT_INI_PER_ASSID": {
                        dateISO: true
                    },
                    "DT_FIM_PER_ASSID": {
                        dateISO: true,
                        dateEqOrNextThan: "DT_INI_PER_ASSID",
                    }                        
                },
                "messages": {
                    "RH_DT_FIM": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    },
                    "DT_FIM_PER_ASSID": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        DG_MESES = new QuadTable();
        DG_MESES.initTable($.extend({}, datatable_instance_defaults, optionsDG_MESES));
        //END Meses

        //Periodos
        /*
        var optionsRH_DEF_PERIODOS = {
            "tableId": "RH_DEF_PERIODOS",
            "table": "RH_DEF_PERIODOS",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_month; ?>",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ANO": {"type": "varchar"},                     
                    "MES": {"type": "number"},
                    "ID_PERIODO": {"type": "number"}
                }
            },
            "dependsOn": {
                "DG_MESES": {
                    "EMPRESA": "EMPRESA",
                    "ANO": "ANO",
                    "MES": "MES"
                }
            },
            "order_by": "MES",
            "recordBundle": 14,
            "pageLenght": 14, 
            "scrollY": "200",
            //"detailsObjects": ['RH_DEF_PERIODOS'],
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
                    "visible": false
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ANO',
                    "name": 'ANO',                    
                    "type": "hidden",
                    "visible": false
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'MES',
                    "name": 'MES',                    
                    "type": "hidden",
                    "visible": false

                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_period, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_period; ?>", //Editor
                    "data": 'ID_PERIODO',
                    "name": 'ID_PERIODO',
                    "className": "right visibleColumn",  
                    "attr": {
                        "style": "width:25%;"
                    }
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_PERIODO',
                    "name": 'DSP_PERIODO',
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_PERIODO',
                    "name": 'DSR_PERIODO',
                    "className": "visibleColumn"
                }, {
                    "responsivePriority": 5, 
                    "title": "<?php echo mb_strtoupper($ui_open, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_open; ?>", //Editor
                    "data": 'ABERTO',
                    "name": 'ABERTO',
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
                    "title": "<?php echo mb_strtoupper($ui_main, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_main; ?>", //Editor
                    "data": 'PRINCIPAL',
                    "name": 'PRINCIPAL',
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
                    "title": "<?php echo mb_strtoupper($ui_value_dt, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_value_dt; ?>", //Editor
                    "data": 'DT_VALOR',
                    "name": 'DT_VALOR',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }                        
                }, {
                    "title": "<?php echo mb_strtoupper($ui_maximum_rate, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_maximum_rate; ?>", //Editor
                    "data": 'RETRO_ID',
                    "name": 'RETRO_ID',
                    "className": "none visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 30%;"
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_close, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_close; ?>", //Editor
                    "data": 'FECHO',
                    "name": 'FECHO',
                    "def": "N",
                    "className": "none",
                    "type": "hidden",
                    "visible": false
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
                        return RH_DEF_PERIODOS.crudButtons(true,true,true);
                    }
                }
            ],
            validations: {
                rules: {
                    ID_PERIODO: {
                        required: true,
                        maxlength: 10
                    },
                    DSP_PERIODO: {
                        required: true,
                        maxlength: 40
                    },
                    DSR_PERIODO: {
                        required: true,
                        maxlength: 25
                    },
                    ABERTO: {
                        required: true
                    },
                    PRINCIPAL: {
                        required: true
                    },
                    "DT_VALOR": {
                        required: true,
                        dateISO: true,
                    },
                    FECHO: {
                        required: true
                    },
                    RETRO_ID: {
                        maxlength: 10
                    },
                },
                "messages": {
                    "RH_DT_FIM": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        RH_DEF_PERIODOS = new QuadTable();
        RH_DEF_PERIODOS.initTable($.extend({}, datatable_instance_defaults, optionsRH_DEF_PERIODOS));
        */
        //END Periodos

        //Integrações
        /*
        var optionsDG_DEF_INTEGRACOES = {
            "tableId": "DG_DEF_INTEGRACOES",
            "table": "DG_DEF_INTEGRACOES",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ANO": {"type": "varchar"},                     
                    "MES": {"type": "number"},
                    "MODULO": {"type": "varchar"}
                }
            },
            "dependsOn": {
                "DG_MESES": {
                    "EMPRESA": "EMPRESA",
                    "ANO": "ANO",
                    "MES": "MES"
                }
            },
            "order_by": "MES",
            "recordBundle": 14,
            "pageLenght": 14, 
            "scrollY": "200",
            //"detailsObjects": ['RH_DEF_PERIODOS'],
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
                    "visible": false
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ANO',
                    "name": 'ANO',                    
                    "type": "hidden",
                    "visible": false
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'MES',
                    "name": 'MES',                    
                    "type": "hidden",
                    "visible": false

                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_module, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_module; ?>", //Editor
                    "data": 'MODULO',
                    "name": 'MODULO',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_DEF_INTEGRACOES.MODULO',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_DEF_INTEGRACOES.MODULO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_day, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_day; ?>", //Editor
                    "data": 'DT_INTEGRACAO',
                    "name": 'DT_INTEGRACAO',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }                        
                }, {
                    "title": "<?php echo mb_strtoupper($ui_obs_short, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_obs_short; ?>", //Editor
                    "data": 'OBS',
                    "name": 'OBS',
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
                        //debugger;
                        return DG_DEF_INTEGRACOES.crudButtons(true,true,true);
                    }
                }
            ],
            validations: {
                rules: {
                    MODULO: {
                        required: true
                    },
                    DT_INTEGRACAO: {
                        dateISO: true
                    },
                    "OBS": {
                        maxlength: 4000
                    },
                }
            }
        };
        DG_DEF_INTEGRACOES = new QuadTable();
        DG_DEF_INTEGRACOES.initTable($.extend({}, datatable_instance_defaults, optionsDG_DEF_INTEGRACOES));
        */
        //END Integrações

        //Quitações
        var optionsDG_RUBRICAS_QUITACOES = {
            "tableId": "DG_RUBRICAS_QUITACOES",
            "table": "DG_RUBRICAS_QUITACOES",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ANO": {"type": "number"},                     
                    "CD_RUBRICA": {"type": "varchar"}
                }
            },
            "dependsOn": {
                "DG_ANOS": {
                    "EMPRESA": "EMPRESA",
                    "ANO": "ANO"
                }
            },
            "order_by": "CD_RUBRICA",
            "recordBundle": 14,
            "pageLenght": 14, 
            "scrollY": "200",
            //"detailsObjects": ['RH_DEF_PERIODOS'],
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
                    "visible": false
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ANO',
                    "name": 'ANO',                    
                    "type": "hidden",
                    "visible": false                      
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_RUBRICA',
                    "name": 'CD_RUBRICA',
                    "type": "hidden",
                    "visible": false,
                    "className": "",
                }, {
                    "responsivePriority": 2,
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_wage_item, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_wage_item; ?>",
                    "data": 'DSP_RUBRICA',
                    "name": 'DSP_RUBRICA',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "RUBRICAS",
                        "dependent-level": 1,
                        "data-db-name": "A.CD_RUBRICA",
                        "decodeFromTable": "RH_DEF_RUBRICAS A", //TO CHANGE ON QUAD-HCM
                        "desigColumn": "CONCAT(CONCAT(A.CD_RUBRICA,' - '),A.DSP_RUBRICA)",
                        "whereClause": " AND A.ACTIVO = 'S' ",
                        "orderBy": "A.CD_RUBRICA",
                        "class": "form-control complexList chosen"
                    }
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_payment, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_payment; ?>", //Editor
                    "data": 'MES_PAGAMENTO',
                    "name": 'MES_PAGAMENTO',
                    "type": "select",
                    "def": "N",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_RUBRICAS_QUITACOES.MES_PAGAMENTO',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_RUBRICAS_QUITACOES.MES_PAGAMENTO'], {'RV_LOW_VALUE': val});
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
                        return DG_RUBRICAS_QUITACOES.crudButtons(true,true,true);
                    }
                }
            ],
            validations: {
                rules: {
                    DSP_RUBRICA: {
                        required: true
                    },
                    MES_PAGAMENTO: {
                        required: true
                    }
                }
            }
        };
        DG_RUBRICAS_QUITACOES = new QuadTable();
        DG_RUBRICAS_QUITACOES.initTable($.extend({}, datatable_instance_defaults, optionsDG_RUBRICAS_QUITACOES));
        //END Quitações

        //END Instance Definition
        
        //Events Definition
        if (1 === 1) {
            //EDITOR :: Anos Fiscais
            $(document).on('DG_ANOSAttachEvt', function (e) {
                var frm_context = "#DG_ANOS_editorForm", operacao = DG_ANOS.editor.s["action"];
                
                //Só admite indicação de Nr. Máximo de Férias Negativos, se aplicável (LOV)
                $('#DTE_Field_RH_FERIAS_NEG', frm_context).on("change", function (e) {   
                    if (operacao === 'query') {
                            $('#DTE_Field_RH_LIMITE_FER_NEG').attr('disabled', false);                        
                    } else {
                        if ($(this).val() === 'N') {
                            $('#DTE_Field_RH_LIMITE_FER_NEG').attr('disabled', true);
                        } else {
                            $('#DTE_Field_RH_LIMITE_FER_NEG').attr('disabled', false);
                        }
                    }
                });        
                
                //Só admite indicação de Nr. Máximo de minutos de ADAPTABILIDADE Negativo, se aplicável (LOV)
                $('#DTE_Field_RH_ADAP_NEG', frm_context).on("change", function (e) {   
                    if (operacao === 'query') {
                            $('#DTE_Field_RH_LIMITE_DC_NEG').attr('disabled', false);                        
                    } else {
                        if ($(this).val() === 'N') {
                            $('#DTE_Field_RH_LIMITE_DC_NEG').attr('disabled', true);
                        } else {
                            $('#DTE_Field_RH_LIMITE_DC_NEG').attr('disabled', false);
                        }
                    }
                });         
          
                //Só admite indicação de Nr. Máximo de minutos de DC Negativo, se aplicável (LOV)
                $('#DTE_Field_RH_DC_NEG', frm_context).on("change", function (e) {   
                    if (operacao === 'query') {
                            $('#DTE_Field_RH_LIMITE_DC_NEG').attr('disabled', false);                        
                    } else {
                        if ($(this).val() === 'N') {
                            $('#DTE_Field_RH_LIMITE_DC_NEG').attr('disabled', true);
                        } else {
                            $('#DTE_Field_RH_LIMITE_DC_NEG').attr('disabled', false);
                        }
                    }
                });                   
                

            });
            //END EDITOR :: Anos Fiscais
        }
        //END Events Definition
        
    });
</script>
