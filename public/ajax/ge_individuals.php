<?php
    require_once '../init.php';
?>
<div class="row">
    
    <div class="col-xl-12">
        <div id="panel-0" class="panel">
            <div class="panel-hdr">
                <span class="widget-icon"> <i class="fal fa-clone"></i></span>&nbsp;
                <h2><?php echo $ui_individuals; ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <a id="QUAD_PEOPLE_GE_INDIV_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                    <table id="QUAD_PEOPLE_GE_INDIV" class="table table-bordered table-hover table-striped w-100"></table>
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
                            <a class="nav-link active" data-toggle="tab" href="#Tab1" role="tab" aria-selected="true"><?php echo $ui_skills; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab2" role="tab" aria-selected="true"><?php echo $ui_objectives; ?></a>
                        </li>
                    </ul>
                </div>
            </div>   
            
            <div class="panel-container show">
                <div class="panel-content">
                    
                    <div class="tab-content">

                         <!-- TAB #1 -->
                        <div class="tab-pane fade active show" id="Tab1" role="tabpanel">
                            <a id="RH_COMPETENCIAS_INDIVIDUAIS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="RH_COMPETENCIAS_INDIVIDUAIS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            <div class="row mt-4">
                                <div class="col-xl-12">
                                    <div id="panel-11" class="panel">
                                        <div class="panel-hdr">
                                            <span class="widget-icon"> <i class="fal fa-clone"></i></span>&nbsp;
                                            <h2><?php echo $ui_behaviors; ?></h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <a id="RH_ID_COMPORTAMENTOS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="RH_ID_COMPORTAMENTOS" class="table table-bordered table-hover table-striped w-100"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- END TAB #1 -->

                         <!-- TAB #2 -->
                        <div class="tab-pane fade" id="Tab2" role="tabpanel">
                            <a id="RH_OBJECTIVOS_INDIVIDUAIS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="RH_OBJECTIVOS_INDIVIDUAIS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
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
        
        //Employees (VIEW)
        var optionQUAD_PEOPLE_GE_INDIV = {
            "tableId": "QUAD_PEOPLE_GE_INDIV",
            "table": "QUAD_PEOPLE", 
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_employee; ?>",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "RHID": {"type": "number"},
                    "DT_ADMISSAO": {"type": "date"}            
                }
            },
            "crudOnMasterInactive": {
                "condition": "data.AV_DESEMPENHO == 'S'",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },
            "detailsObjects": ['RH_COMPETENCIAS_INDIVIDUAIS','RH_OBJECTIVOS_INDIVIDUAIS'], 
            //"initialWhereClause": " TP_REGISTO = 'A' ", 
            "order_by": "EMPRESA, RHID, DT_ADMISSAO",
            "recordBundle": 7,
            "pageLenght": 7,
            "scrollY": "210", 
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
                    "title": "<?php echo mb_strtoupper($ui_company, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_company; ?>",
                    "data": 'EMPRESA',
                    "name": 'EMPRESA',
                    "className": "visibleColumn",                    
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_rhid, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_rhid; ?>",
                    "data": 'RHID',
                    "name": 'RHID',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 30%;"
                    }
                }, {
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_name, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_name; ?>",
                    "data": 'NOME',
                    "name": 'NOME',
                    "className": "visibleColumn"
                }, {
                    "title": "<?php echo mb_strtoupper($ui_name_short, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_name_short; ?>",
                    "data": 'NOME_REDZ',
                    "name": 'NOME_REDZ',
                    "className": "visibleColumn"
                }, {
                    "responsivePriority": 5, 
                    "title": "<?php echo mb_strtoupper($ui_dt_admission, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_dt_admission; ?>", //Editor
                    "data": 'DT_ADMISSAO',
                    "name": 'DT_ADMISSAO',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    } 
                }, {
                    "title": "<?php echo mb_strtoupper($ui_dt_resignation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_dt_resignation; ?>", //Editor
                    "data": 'DT_DEMISSAO',
                    "name": 'DT_DEMISSAO',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker" 
                    }                                      
                }, {
                    "responsivePriority": 6, 
                    "title": "<?php echo mb_strtoupper($ui_active, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_active; ?>", //Editor
                    "data": 'ATIVO',
                    "name": 'ATIVO',
                    "type": "select",
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
                }
            ]
        };
        QUAD_PEOPLE_GE_INDIV = new QuadTable();
        QUAD_PEOPLE_GE_INDIV.initTable( $.extend({}, datatable_instance_defaults, optionQUAD_PEOPLE_GE_INDIV) );
        //END Employees (VIEW)

        //Skills
        var optionRH_COMPETENCIAS_INDIVIDUAIS = {
            "tableId": "RH_COMPETENCIAS_INDIVIDUAIS",
            "table": "RH_COMPETENCIAS_INDIVIDUAIS", 
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_skill; ?>",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "RHID": {"type": "number"},
                    "DT_ADMISSAO": {"type": "date"},
                    "ID_COMPETENCIA": {"type": "number"},
                    "DT_INI_COMPETENCIA": {"type": "date"},  
                    "DT_INI": {"type": "date"}                  
                }
            },
            "dependsOn": {
                "QUAD_PEOPLE_GE_INDIV": { //External object key mapping( object key : external key)                    
                    "EMPRESA": "EMPRESA",
                    "RHID": "RHID",
                    "DT_ADMISSAO": "DT_ADMISSAO"
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
            "detailsObjects": ['RH_ID_COMPORTAMENTOS'], 
            "order_by": "ID_COMPETENCIA, DT_INI desc",
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
                    "data": 'RHID',
                    "name": 'RHID',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_ADMISSAO',
                    "name": 'DT_ADMISSAO',
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
                    "data": 'RHID_AVALIADOR',
                    "name": 'RHID_AVALIADOR',
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
                        "data-db-name": "A.RHID",
                        "distribute-value": "RHID_AVALIADOR",
                        "decodeFromTable": 'QUAD_NAMES A',
                        "desigColumn": "CONCAT(CONCAT(A.RHID,'-'),A.NOME_REDZ)", 
                        "orderBy": "A.RHID", 
                        "class": "form-control complexList chosen",
                        ///"disabled": true, //Permite inibir o campo no Editor
                        "filter": {
                            "create": " AND (A.RHID) IN (SELECT F.RHID FROM QUAD_PEOPLE F WHERE F.ATIVO = 'S' AND F.EMPRESA = ':EMPRESA' AND F.RHID != ':RHID')", //On-New-Record
                            "edit": " AND (A.RHID) IN (SELECT F.RHID FROM QUAD_PEOPLE F WHERE F.ATIVO = 'S' AND F.EMPRESA = ':EMPRESA' AND F.RHID != ':RHID')", //On-Edit-Record
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
                        return RH_COMPETENCIAS_INDIVIDUAIS.crudButtons(true,true,true);
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
        RH_COMPETENCIAS_INDIVIDUAIS = new QuadTable();
        RH_COMPETENCIAS_INDIVIDUAIS.initTable( $.extend({}, datatable_instance_defaults, optionRH_COMPETENCIAS_INDIVIDUAIS) );
        //END Skills

        //RH_COMPETENCIAS_INDIVIDUAIS :: EDITOR :: EVENTS
        $(document).on('RH_COMPETENCIAS_INDIVIDUAISAttachEvt', function (e) {
            var validator = $("#RH_COMPETENCIAS_INDIVIDUAIS_editorForm").validate();
            $('#RH_COMPETENCIAS_INDIVIDUAIS_editorForm').on("focusout", '#DTE_Field_PESO', function (e) {
                e.stopImmediatePropagation();
                var el = $(this);
                if (RH_COMPETENCIAS_INDIVIDUAIS.operation === "INSERT" || RH_COMPETENCIAS_INDIVIDUAIS.operation === "UPDATE") {
                    if ($(this).val()) {
                        $('#DTE_Field_PESO').rules('remove', 'avaliacao');
                        $.validator.addMethod('avaliacao', function (value, element, param) {
                            var masterRecord = QUAD_PEOPLE_GE_INDIV.tbl.row('.selected').data(),sql = [];
                            if (RH_COMPETENCIAS_INDIVIDUAIS.operation === "INSERT") {
                                sql = [
                                    "SELECT sum(PESO) AS SOMA FROM RH_COMPETENCIAS_INDIVIDUAIS WHERE EMPRESA = '" + masterRecord['EMPRESA'] + "' AND RHID = " + masterRecord['RHID'] + " AND TO_CHAR(DT_ADMISSAO,'YYYY-MM-DD') = '" + masterRecord['DT_ADMISSAO'] + "'"
                                ];
                            } else if (RH_COMPETENCIAS_INDIVIDUAIS.operation === "UPDATE") {
                                var currentRecord = RH_COMPETENCIAS_INDIVIDUAIS.tbl.row('.selected').data()
                                sql = [
                                    "SELECT sum(PESO) AS SOMA FROM RH_COMPETENCIAS_INDIVIDUAIS WHERE EMPRESA = '" + masterRecord['EMPRESA'] + "' AND RHID = " + masterRecord['RHID'] + " AND TO_CHAR(DT_ADMISSAO,'YYYY-MM-DD') = '" + masterRecord['DT_ADMISSAO'] + "'" +
                                    " AND NOT (ID_COMPETENCIA = " + currentRecord['ID_COMPETENCIA'] + " AND TO_CHAR(DT_INI_COMPETENCIA,'YYYY-MM-DD') = '" + currentRecord['DT_INI_COMPETENCIA'] + "' AND TO_CHAR(DT_INI,'YYYY-MM-DD') = '" + currentRecord['DT_INI'] +"')"
                                ];                                
                            } else {
                                return true;
                            }           
                            var rqt = RH_COMPETENCIAS_INDIVIDUAIS.getFromSql(sql, false);
                            $.when(rqt).then(function (data) {
                                    var soma_pesos = JSON.parse(data);
                                    soma_pesos = soma_pesos[0][0]['SOMA'];
                                    if (!soma_pesos) {
                                        soma_pesos = 0;
                                    }
                                    var tot = parseFloat(value) + parseFloat(soma_pesos);
                                    RH_COMPETENCIAS_INDIVIDUAIS['messager'] = {
                                        msg: function () {
                                            var txt = "<?php echo $error_more_than_100; ?>";
                                            return txt.replace("{0}", tot);
                                        },
                                        valid: tot < 100
                                    };
                                    return RH_COMPETENCIAS_INDIVIDUAIS['messager']['valid'];
                            });
                            return RH_COMPETENCIAS_INDIVIDUAIS['messager']['valid'];

                        }, function (param, element) {
                            return RH_COMPETENCIAS_INDIVIDUAIS['messager']['msg'];
                        });

                        $('#DTE_Field_PESO').rules("add", {
                            avaliacao: true,
                        });
                        validator.element($(this));
                    }
                }
            });
        });
        //END RH_COMPETENCIAS_INDIVIDUAIS :: EDITOR :: EVENTS

        //Behaviors
        var optionRH_ID_COMPORTAMENTOS = {
            "tableId": "RH_ID_COMPORTAMENTOS",
            "table": "RH_ID_COMPORTAMENTOS", 
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "RHID": {"type": "number"},
                    "DT_ADMISSAO": {"type": "date"},
                    "ID_COMPETENCIA": {"type": "number"},
                    "DT_INI_COMPETENCIA": {"type": "date"},                    
                    "DT_INI": {"type": "date"},
                    "ID_COMPORTAMENTO": {"type": "number"},
                    "DT_INI_COMPORTAMENTO": {"type": "date"},
                    "DT_INI_CC": {"type": "date"}
                }
            },
            "dependsOn": {
                "RH_COMPETENCIAS_INDIVIDUAIS": { //External object key mapping( object key : external key)                    
                    "EMPRESA": "EMPRESA",
                    "RHID": "RHID",
                    "DT_ADMISSAO": "DT_ADMISSAO",
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
                    "data": 'RHID',
                    "name": 'RHID',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_ADMISSAO',
                    "name": 'DT_ADMISSAO',
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
                        "otherValues": "A.DESCRICAO", //RETURNS data['OTHERVALUES']
                        "deferred": true,
                        "decodeFromTable": "RH_DEF_COMPORTAMENTOSA",  //TO CHANGE ON QUAD-HCM
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
                    "data": 'DT_INI_CC',
                    "name": 'DT_INI_CC',
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
                    "data": 'DT_FIM_CC',
                    "name": 'DT_FIM_CC',
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
                        return RH_ID_COMPORTAMENTOS.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DSP_COMPORTAMENTO": {
                        required: true
                    },
                    "DT_INI_CC": {
                        required: true,
                        dateISO: true,
                    },
                    "PESO": {
                        number: true,
                    },    
                    "DSP_EP": {
                        required: true
                    },
                    "DSR_NEP": {
                        required: true
                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                    "DT_FIM_CC": {
                        dateISO: true,
                        dateEqOrNextThan: 'DT_INI_CC',
                    }
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                    "DT_FIM_CC": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        RH_ID_COMPORTAMENTOS = new QuadTable();
        RH_ID_COMPORTAMENTOS.initTable( $.extend({}, datatable_instance_defaults, optionRH_ID_COMPORTAMENTOS) );
        //END Behaviors 

        //RH_ID_COMPORTAMENTOS :: EDITOR :: EVENTS
        $(document).on('RH_ID_COMPORTAMENTOSAttachEvt', function (e) {
            var validator = $("#RH_ID_COMPORTAMENTOS_editorForm").validate();
            $('#RH_ID_COMPORTAMENTOS_editorForm').on("focusout", '#DTE_Field_PESO', function (e) {
                e.stopImmediatePropagation();
                var el = $(this);
                if (RH_ID_COMPORTAMENTOS.operation === "INSERT" || RH_ID_COMPORTAMENTOS.operation === "UPDATE") {
                    if ($(this).val()) {
                        $('#DTE_Field_PESO').rules('remove', 'avaliacao');
                        $.validator.addMethod('avaliacao', function (value, element, param) {
                            var masterRecord = QUAD_PEOPLE_GE_INDIV.tbl.row('.selected').data(), sql = [];
                            if (RH_ID_COMPORTAMENTOS.operation === "INSERT") {
                                sql = [
                                    "SELECT sum(PESO) AS SOMA FROM RH_ID_COMPORTAMENTOS WHERE EMPRESA = '" + masterRecord['EMPRESA'] + "' AND RHID = " + masterRecord['RHID'] + " AND TO_CHAR(DT_ADMISSAO,'YYYY-MM-DD') = '" + masterRecord['DT_ADMISSAO'] + "'"
                                ];
                            } else if (RH_ID_COMPORTAMENTOS.operation === "UPDATE") {
                                var currentRecord = RH_ID_COMPORTAMENTOS.tbl.row('.selected').data()
                                sql = [
                                    "SELECT sum(PESO) AS SOMA FROM RH_ID_COMPORTAMENTOS WHERE EMPRESA = '" + masterRecord['EMPRESA'] + "' AND RHID = " + masterRecord['RHID'] + " AND TO_CHAR(DT_ADMISSAO,'YYYY-MM-DD') = '" + masterRecord['DT_ADMISSAO'] + "'" +
                                    " AND ID_COMPETENCIA != " + currentRecord['ID_COMPETENCIA'] + " AND TO_CHAR(DT_INI_COMPETENCIA,'YYYY-MM-DD') != '" + currentRecord['DT_INI_COMPETENCIA'] + "' AND TO_CHAR(DT_INI,'YYYY-MM-DD') != '" + currentRecord['DT_INI'] + "'" + 
                                    " AND NOT (ID_COMPORTAMENTO = " + currentRecord['ID_COMPORTAMENTO'] + " AND TO_CHAR(DT_INI_COMPORTAMENTO,'YYYY-MM-DD') = '" + currentRecord['DT_INI_COMPORTAMENTO'] + "' AND TO_CHAR(DT_INI_CC,'YYYY-MM-DD') = '" + currentRecord['DT_INI_CC'] + "')"
                                ];                                
                            } else {
                                return true;
                            }    

                            var rqt = RH_ID_COMPORTAMENTOS.getFromSql(sql, false);
                            $.when(rqt).then(function (data) {
                                    var soma_pesos = JSON.parse(data);
                                    soma_pesos = soma_pesos[0][0]['SOMA'];
                                    if (!soma_pesos) {
                                        soma_pesos = 0;
                                    }
                                    var tot = parseFloat(value) + parseFloat(soma_pesos);
                                    RH_ID_COMPORTAMENTOS['messager'] = {
                                        msg: function () {
                                            var txt = "<?php echo $error_more_than_100; ?>";
                                            return txt.replace("{0}", tot);
                                        },
                                        valid: tot < 100
                                    };
                                    return RH_ID_COMPORTAMENTOS['messager']['valid'];
                            });
                            return RH_ID_COMPORTAMENTOS['messager']['valid'];

                        }, function (param, element) {
                            return RH_ID_COMPORTAMENTOS['messager']['msg'];
                        });

                        $('#DTE_Field_PESO').rules("add", {
                            avaliacao: true,
                        });
                        validator.element($(this));
                    }
                }
            });
        });
        //END RH_ID_COMPORTAMENTOS :: EDITOR :: EVENTS

        //Objectives
        var optionRH_OBJECTIVOS_INDIVIDUAIS = {
            "tableId": "RH_OBJECTIVOS_INDIVIDUAIS",
            "table": "RH_OBJECTIVOS_INDIVIDUAIS", 
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "RHID": {"type": "number"},
                    "DT_ADMISSAO": {"type": "date"},
                    "ID_OBJECTIVO": {"type": "number"},
                    "DT_INI_OBJECTIVO": {"type": "date"},  
                    "DT_INI_OI": {"type": "date"}                  
                }
            },
            "dependsOn": {
                "QUAD_PEOPLE_GE_INDIV": { //External object key mapping( object key : external key)                    
                    "EMPRESA": "EMPRESA",
                    "RHID": "RHID",
                    "DT_ADMISSAO": "DT_ADMISSAO"
                }
            },                
            "order_by": "ID_OBJECTIVO, DT_INI_OI desc",
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
                    "data": 'RHID',
                    "name": 'RHID',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_ADMISSAO',
                    "name": 'DT_ADMISSAO',
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
                    "data": 'DT_INI_OI',
                    "name": 'DT_INI_OI',
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
                    "data": 'RHID_AVALIADOR',
                    "name": 'RHID_AVALIADOR',
                    "type": "hidden",
                    "visible": false,
                    "className": ""                        
                }, {
                    "responsivePriority": 8, 
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_rhid, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_rhid; ?>",
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
                        "distribute-value": "RHID_AVALIADOR",
                        "decodeFromTable": 'QUAD_NAMES A',
                        "desigColumn": "CONCAT(CONCAT(A.RHID,'-'),A.NOME_REDZ)", 
                        "orderBy": "A.RHID", 
                        "class": "form-control complexList chosen",
                        ///"disabled": true, //Permite inibir o campo no Editor
                        "filter": {
                            "create": " AND (A.RHID) IN (SELECT F.RHID FROM QUAD_PEOPLE F WHERE F.ATIVO = 'S' AND F.EMPRESA = ':EMPRESA' AND F.RHID != ':RHID')", //On-New-Record
                            //"create": " AND (RHID) IN (SELECT RHID FROM QUAD_PEOPLE WHERE ATIVO = 'S' AND EMPRESA = ':EMPRESA')", //On-New-Record
                            "edit": " AND (A.RHID) IN (SELECT F.RHID FROM QUAD_PEOPLE F WHERE F.ATIVO = 'S' AND F.EMPRESA = ':EMPRESA' AND F.RHID != ':RHID')", //On-Edit-Record
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
                    "data": 'DT_FIM_OI',
                    "name": 'DT_FIM_OI',
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
                        return RH_OBJECTIVOS_INDIVIDUAIS.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DSP_OBJECTIVO": {
                        required: true
                    },
                    "DT_INI_OI": {
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
                    "DT_FIM_OI": {
                        dateISO: true,
                        dateEqOrNextThan: 'DT_INI_OI',
                    }
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                    "DT_FIM_OI": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }            
        };
        RH_OBJECTIVOS_INDIVIDUAIS = new QuadTable();
        RH_OBJECTIVOS_INDIVIDUAIS.initTable( $.extend({}, datatable_instance_defaults, optionRH_OBJECTIVOS_INDIVIDUAIS) );        
        //END Objectives

        //RH_OBJECTIVOS_INDIVIDUAIS :: EDITOR :: EVENTS
        $(document).on('RH_OBJECTIVOS_INDIVIDUAISAttachEvt', function (e) {
            var validator = $("#RH_OBJECTIVOS_INDIVIDUAIS_editorForm").validate();
            $('#RH_OBJECTIVOS_INDIVIDUAIS_editorForm').on("focusout", '#DTE_Field_PESO', function (e) {
                e.stopImmediatePropagation();
                var el = $(this);
                if (RH_OBJECTIVOS_INDIVIDUAIS.operation === "INSERT" || RH_OBJECTIVOS_INDIVIDUAIS.operation === "UPDATE") {
                    if ($(this).val()) {
                        $('#DTE_Field_PESO').rules('remove', 'avaliacao');
                        $.validator.addMethod('avaliacao', function (value, element, param) {
                            var masterRecord = QUAD_PEOPLE_GE_INDIV.tbl.row('.selected').data(), sql = [];
                            if (RH_OBJECTIVOS_INDIVIDUAIS.operation === "INSERT") {
                                sql = [
                                    "SELECT sum(PESO) AS SOMA FROM RH_OBJECTIVOS_INDIVIDUAIS WHERE EMPRESA = '" + masterRecord['EMPRESA'] + "' AND RHID = " + masterRecord['RHID'] + " AND TO_CHAR(DT_ADMISSAO,'YYYY-MM-DD') = '" + masterRecord['DT_ADMISSAO'] + "'"
                                ];
                            } else if (RH_OBJECTIVOS_INDIVIDUAIS.operation === "UPDATE") {
                                var currentRecord = RH_OBJECTIVOS_INDIVIDUAIS.tbl.row('.selected').data()
                                sql = [
                                    "SELECT sum(PESO) AS SOMA FROM RH_OBJECTIVOS_INDIVIDUAIS WHERE EMPRESA = '" + masterRecord['EMPRESA'] + "' AND RHID = " + masterRecord['RHID'] + " AND TO_CHAR(DT_ADMISSAO,'YYYY-MM-DD') = '" + masterRecord['DT_ADMISSAO'] + "'" + 
                                    " AND NOT (ID_OBJECTIVO = " + currentRecord['ID_OBJECTIVO'] + " AND TO_CHAR(DT_INI_OBJECTIVO,'YYYY-MM-DD') = '" + currentRecord['DT_INI_OBJECTIVO'] + "' AND TO_CHAR(DT_INI_OI,'YYYY-MM-DD') = '" + currentRecord['DT_INI_OI'] + "')"
                                ];  
                            } else {
                                return true;
                            }                              
                            var rqt = RH_OBJECTIVOS_INDIVIDUAIS.getFromSql(sql, false);
                            $.when(rqt).then(function (data) {
                                    var soma_pesos = JSON.parse(data);
                                    soma_pesos = soma_pesos[0][0]['SOMA'];
                                    if (!soma_pesos) {
                                        soma_pesos = 0;
                                    }
                                    var tot = parseFloat(value) + parseFloat(soma_pesos);
                                    RH_OBJECTIVOS_INDIVIDUAIS['messager'] = {
                                        msg: function () {
                                            var txt = "<?php echo $error_more_than_100; ?>";
                                            return txt.replace("{0}", tot);
                                        },
                                        valid: tot < 100
                                    };
                                    return RH_OBJECTIVOS_INDIVIDUAIS['messager']['valid'];
                            });
                            return RH_OBJECTIVOS_INDIVIDUAIS['messager']['valid'];

                        }, function (param, element) {
                            return RH_OBJECTIVOS_INDIVIDUAIS['messager']['msg'];
                        });

                        $('#DTE_Field_PESO').rules("add", {
                            avaliacao: true,
                        });
                        validator.element($(this));
                    }
                }
            });
        });
        //END RH_OBJECTIVOS_INDIVIDUAIS :: EDITOR :: EVENTS
    });
</script>
