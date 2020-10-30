<?php
    require_once '../init.php';

?>
<style>
    
    #RH_DEF_CONTABILISTICOS_RUB_editorForm > div > div.DTE_Field.form-group.row.DTE_Field_Type_text.DTE_Field_Name_MASCARA.visibleColumn > div.col-lg-8 > div.DTE_Field_InputControl {
        display: flex!important;
    }
    
    #RH_DEF_CONTABILISTICOS_DESCONTOS_editorForm > div > div.DTE_Field.form-group.row.DTE_Field_Type_text.DTE_Field_Name_MASCARA.visibleColumn > div.col-lg-8 > div.DTE_Field_InputControl {
        display: flex!important;
    }

    #RH_DEF_CONTABILISTICOS_DUO_editorForm > div > div.DTE_Field.form-group.row.DTE_Field_Type_text.DTE_Field_Name_MASCARA.visibleColumn > div.col-lg-8 > div.DTE_Field_InputControl {
        display: flex!important;
    }
        
    #RH_DEF_CONTABILISTICOS_LIQ_editorForm > div > div.DTE_Field.form-group.row.DTE_Field_Type_text.DTE_Field_Name_MASCARA.visibleColumn > div.col-lg-8 > div.DTE_Field_InputControl {
        display: flex!important;
    }
    
    #aider {
        margin-left: 8px;
        padding: 2px 3px 2px 3px;
        width: 44px;
    }
    
    #aider > span > i {
        margin-top: 9px;
        font-size: 1.2em;
    }
    
</style>    
<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-end">
                <div class="panel-toolbar pr-3 align-self-end tabs__">
                    <ul id="demo_panel-tabs" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#Tab1" role="tab" aria-selected="true"><?php echo $ui_accounting_groups; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab2" role="tab" aria-selected="true"><?php echo $ui_wage_items; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab3" role="tab" aria-selected="true"><?php echo $ui_discounts; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab4" role="tab" aria-selected="true"><?php echo $ui_twelfths; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab5" role="tab" aria-selected="true"><?php echo $ui_net; ?></a>
                        </li>
                    </ul>
                </div>
            </div>   
            
            <div class="panel-container show">
                <div class="panel-content">
                    
                    <div class="tab-content">

                         <!-- TAB #1 -->
                        <div class="tab-pane fade active show" id="Tab1" role="tabpanel">
                            <a id="DG_DEF_GRUPOS_CONTABILISTICOS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="DG_DEF_GRUPOS_CONTABILISTICOS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                        </div>
                         <!-- END TAB #1 -->

                         <!-- TAB #2 -->
                        <div class="tab-pane fade" id="Tab2" role="tabpanel">
                            <a id="RH_DEF_CONTABILISTICOS_RUB_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="RH_DEF_CONTABILISTICOS_RUB" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                        </div>
                         <!-- END TAB #2 -->
                        
                         <!-- TAB #3 -->
                        <div class="tab-pane fade" id="Tab3" role="tabpanel">
                            <a id="RH_DEF_CONTABILISTICOS_DESCONTOS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="RH_DEF_CONTABILISTICOS_DESCONTOS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                        </div>
                         <!-- END TAB #3 -->

                         <!-- TAB #4 -->
                        <div class="tab-pane fade" id="Tab4" role="tabpanel">
                            <a id="RH_DEF_CONTABILISTICOS_DUO_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="RH_DEF_CONTABILISTICOS_DUO" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                        </div>
                         <!-- END TAB #4 -->
                         
                         <!-- TAB #5 -->
                        <div class="tab-pane fade" id="Tab5" role="tabpanel">
                            <a id="RH_DEF_CONTABILISTICOS_LIQ_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="RH_DEF_CONTABILISTICOS_LIQ" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                        </div>
                         <!-- END TAB #5 -->
                         
                    </div>                    
                </div>                    

            </div> 
        </div>
    </div>
</div>
    
<!-- TOOLTIP LOV TEMPALTE to PASS to EDITOR btn btn-info waves-effect waves-themed OU "dt-button buttons-html5 btn btn-default btn-xs"-->
<div id="lov" style="display:none;">
    <a  id="aider" href="javascript:void(0);" class="btn btn-primary waves-effect waves-themed" rel="popover"   
        title="<?php echo "<span class='icoTit'><i class='fa fa-fw fa-pencil'></i></span>".$ui_masks; ?>" 
        data-placement="left" data-html="true" 
        data-content='<div id="lovMasks" novalidate style="min-width:170px"><div><label><select id="maskChoice"><?php echo list_dominioInLine ('DG_MASCARAS_CONTABILISTICAS', '', @$_SESSION['lang'], $msg); ?></select></label></div><div class="form-actions"><div class="row"><div class="col-md-12"><button id="selectMask" class="btn btn-primary btn-sm"><?php echo $ui_select; ?></button></div></div></div></div>'
        data-original-title="<i class='fa fa-fw fa-pencil'></i> Form inside popover" id="maskLov">
        <span><i class="fas fa-brackets-curly"></i></span>
    </a>
</div>


<script>
    pageSetUp();

    $(document).ready(function () {
        
        //Grupos Contabilísticos
        var optionDG_DEF_GRUPOS_CONTABILISTICOS = {
            "tableId": "DG_DEF_GRUPOS_CONTABILISTICOS",
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_accounting_group; ?>",
            "table": "DG_DEF_GRUPOS_CONTABILISTICOS", 
            "pk": {
                "primary": {
                    "CD_GRP_CONTAB": {"type": "number"}
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
            //"detailsObjects": ['GF_HAB_LITER_TRADS'],
            "order_by": "CD_GRP_CONTAB",
            "scrollY": "234", 
            "recordBundle": 8,
            "pageLenght": 8, 
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
                    "data": 'CD_GRP_CONTAB',
                    "name": 'CD_GRP_CONTAB',
                    "className": "visibleColumn",                   
                }, {
                    "responsivePriority": 3, 
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_designation; ?>", //Editor
                    "data": 'DSP_GRP_CONTAB',
                    "name": 'DSP_GRP_CONTAB',
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 4, 
                    "title": "<?php echo mb_strtoupper($ui_short_desig, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_short_desig; ?>", //Editor
                    "data": 'DSR_GRP_CONTAB',
                    "name": 'DSR_GRP_CONTAB',                    
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 5, 
                    "title": "<?php echo mb_strtoupper($ui_type, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_type; ?>", //Editor
                    "data": 'RH_TP_INTERFACE',
                    "name": 'RH_TP_INTERFACE',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_DEF_GRUPOS_CONTABILISTICOS.RH_TP_INTERFACE',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_DEF_GRUPOS_CONTABILISTICOS.RH_TP_INTERFACE'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }
                }, {
                    "responsivePriority": 6, 
                    "title": "<?php echo mb_strtoupper($ui_active, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_active; ?>", //Editor
                    "data": 'ACTIVO',
                    "name": 'ACTIVO',
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
                        return DG_DEF_GRUPOS_CONTABILISTICOS.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "CD_GRP_CONTAB": {
                        required: true,
                        integer: true,
                        maxlength: 10
                    },
                    "DSP_GRP_CONTAB": {
                        required: true,
                        maxlength: 40,
                    },
                    "DSR_GRP_CONTAB": {
                        required: false,
                        maxlength: 25,
                    },
                    "ACTIVO": {
                        required: true
                    },
                    "	RH_TP_INTERFACE": {
                        required: true
                    }
                }
            }
        };
        DG_DEF_GRUPOS_CONTABILISTICOS = new QuadTable();
        DG_DEF_GRUPOS_CONTABILISTICOS.initTable( $.extend({}, datatable_instance_defaults, optionDG_DEF_GRUPOS_CONTABILISTICOS) );
        //END Grupos Contabilísticos
    
        //Regras - Rúbricas
        var optionRH_DEF_CONTABILISTICOS_RUB = {
            "tableId": "RH_DEF_CONTABILISTICOS_RUB",
            //"selectRecordMsg": "<?php echo $ui_please_select_record . $ui_professional_category; ?>",
            "table": "RH_DEF_CONTABILISTICOS", 
            "pk": {
                "primary": {
                    "CD_APIC": {"type": "varchar"}
                }
            },
            "crudOnMasterInactive": {
                "condition": "data.ACTIVO !== 'S' ",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },             
            "initialWhereClause": " PROVENIENCIA = 'A' ",
            //"detailsObjects": ['RH_DEF_CATS_PROFISSIONAL_TRADS'],
            "order_by": "CD_APIC",
            "scrollY": "234", 
            "recordBundle": 8,
            "pageLenght": 8, 
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
                    "data": 'PROVENIENCIA',
                    "name": 'PROVENIENCIA',
                    "def": "A",
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
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
                    "data": 'CD_APIC',
                    "name": 'CD_APIC',
                    "className": "visibleColumn", 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_GRP_CONTAB_COLABORADOR',
                    "name": 'CD_GRP_CONTAB_COLABORADOR',
                    "type": "hidden",
                    "visible": false,
                    "className": "",  
                }, {
                    "responsivePriority": 4, 
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_employee, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_employee; ?>",
                    "data": 'DSP_GRP_CONTAB_EMP',
                    "name": 'DSP_GRP_CONTAB_EMP',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "GRP_CONTAB_EMP",
                        "dependent-level": 1,
                        "data-db-name": "A.CD_GRP_CONTAB",
                        "distribute-value": "CD_GRP_CONTAB_COLABORADOR",
                        "decodeFromTable": "DG_DEF_GRUPOS_CONTABILISTICOS A",  //TO CHANGE ON QUAD-HCM
                        "desigColumn": "A.DSR_GRP_CONTAB", 
                        "orderBy": "A.DSR_GRP_CONTAB",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.ACTIVO = 'S' AND A.AMBITO_GRP_CONTAB = 'A' AND A.RH_TP_INTERFACE = 'B' ", //On-New-Record
                            "edit": "  AND A.ACTIVO = 'S' AND A.AMBITO_GRP_CONTAB = 'A' AND A.RH_TP_INTERFACE = 'B' ", //On-Edit-Record
                        }
                    }   
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_GRP_CONTAB_RUBRICA',
                    "name": 'CD_GRP_CONTAB_RUBRICA',
                    "type": "hidden",
                    "visible": false,
                    "className": "",  
                }, {
                    "responsivePriority": 5, 
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_wage_item, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_wage_item; ?>",
                    "data": 'DSP_GRP_CONTAB_RUB',
                    "name": 'DSP_GRP_CONTAB_RUB',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "GRP_CONTAB_RUB",
                        "dependent-level": 1,
                        "data-db-name": "A.CD_GRP_CONTAB",
                        "distribute-value": "CD_GRP_CONTAB_RUBRICA",
                        "decodeFromTable": "DG_DEF_GRUPOS_CONTABILISTICOS A",  //TO CHANGE ON QUAD-HCM
                        "desigColumn": "A.DSR_GRP_CONTAB", 
                        "orderBy": "A.DSR_GRP_CONTAB",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.ACTIVO = 'S' AND A.AMBITO_GRP_CONTAB = 'A' AND A.RH_TP_INTERFACE = 'A' ", //On-New-Record
                            "edit": "  AND A.ACTIVO = 'S' AND A.AMBITO_GRP_CONTAB = 'A' AND A.RH_TP_INTERFACE = 'A' ", //On-Edit-Record
                        }
                    }  
                }, {
                    "responsivePriority": 6, 
                    "title": "<?php echo mb_strtoupper($ui_scope, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_scope; ?>", //Editor
                    "data": 'AMBITO',
                    "name": 'AMBITO',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'RH_DEF_CONTABILISTICOS.AMBITO',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['RH_DEF_CONTABILISTICOS.AMBITO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }                              
                }, {
                    "responsivePriority": 7, 
                    "title": "<?php echo mb_strtoupper($ui_movement_rule, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_movement_rule; ?>", //Editor
                    "data": 'MSK_SINAL',
                    "name": 'MSK_SINAL',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_NATUREZA_CONTA',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_NATUREZA_CONTA'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }  
                }, {
                    "responsivePriority": 8, 
                    "title": "<?php echo mb_strtoupper($ui_mask, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_mask; ?>", //Editor
                    "data": 'MASCARA',
                    "name": 'MASCARA',
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 9, 
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
                        return RH_DEF_CONTABILISTICOS_RUB.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DSP_EMPRESA": {
                        required: true
                    },
                    "CD_APIC": {
                        integer: true,
                        maxlength: 10,
                        required: true
                    },
                    "AMBITO": {
                       required: true
                    },
                    "MASCARA": {
                       required: true,
                       maxlength: 200,
                    },
                    "ACTIVO": {
                       required: true
                    }
                }
            }
        };
        RH_DEF_CONTABILISTICOS_RUB = new QuadTable();
        RH_DEF_CONTABILISTICOS_RUB.initTable( $.extend({}, datatable_instance_defaults, optionRH_DEF_CONTABILISTICOS_RUB) );        
        //END Regras - Rúbricas
        
        //Regras - Descontos
        var optionRH_DEF_CONTABILISTICOS_DESCONTOS = {
            "tableId": "RH_DEF_CONTABILISTICOS_DESCONTOS",
            //"selectRecordMsg": "<?php echo $ui_please_select_record . $ui_professional_category; ?>",
            "table": "RH_DEF_CONTABILISTICOS", 
            "pk": {
                "primary": {
                    "CD_APIC": {"type": "varchar"}
                }
            },
            "crudOnMasterInactive": {
                "condition": "data.ACTIVO !== 'S' ",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },             
            "initialWhereClause": " PROVENIENCIA = 'B' ",
            //"detailsObjects": ['RH_DEF_CATS_PROFISSIONAL_TRADS'],
            "order_by": "CD_APIC",
            "scrollY": "234", 
            "recordBundle": 8,
            "pageLenght": 8,  
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
                    "data": 'PROVENIENCIA',
                    "name": 'PROVENIENCIA',
                    "def": "B",
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
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
                    "data": 'CD_APIC',
                    "name": 'CD_APIC',
                    "className": "visibleColumn", 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_GRP_CONTAB_COLABORADOR',
                    "name": 'CD_GRP_CONTAB_COLABORADOR',
                    "type": "hidden",
                    "visible": false,
                    "className": "",  
                }, {
                    "responsivePriority": 4, 
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_employee, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_employee; ?>",
                    "data": 'DSP_GRP_CONTAB_EMP',
                    "name": 'DSP_GRP_CONTAB_EMP',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "GRP_CONTAB_EMP",
                        "dependent-level": 1,
                        "data-db-name": "A.CD_GRP_CONTAB",
                        "distribute-value": "CD_GRP_CONTAB_COLABORADOR",
                        "decodeFromTable": "DG_DEF_GRUPOS_CONTABILISTICOS A",  //TO CHANGE ON QUAD-HCM
                        "desigColumn": "A.DSR_GRP_CONTAB", 
                        "orderBy": "A.DSR_GRP_CONTAB",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.ACTIVO = 'S' AND A.AMBITO_GRP_CONTAB = 'A' AND A.RH_TP_INTERFACE = 'B' ", //On-New-Record
                            "edit": "  AND A.ACTIVO = 'S' AND A.AMBITO_GRP_CONTAB = 'A' AND A.RH_TP_INTERFACE = 'B' ", //On-Edit-Record
                        }
                    }   
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_GRP_CONTAB_RUBRICA',
                    "name": 'CD_GRP_CONTAB_RUBRICA',
                    "type": "hidden",
                    "visible": false,
                    "className": "",  
                }, {
                    "responsivePriority": 5, 
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_wage_item, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_wage_item; ?>",
                    "data": 'DSP_GRP_CONTAB_RUB',
                    "name": 'DSP_GRP_CONTAB_RUB',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "GRP_CONTAB_RUB",
                        "dependent-level": 1,
                        "data-db-name": "A.CD_GRP_CONTAB",
                        "distribute-value": "CD_GRP_CONTAB_RUBRICA",
                        "decodeFromTable": "DG_DEF_GRUPOS_CONTABILISTICOS A",  //TO CHANGE ON QUAD-HCM
                        "desigColumn": "A.DSR_GRP_CONTAB", 
                        "orderBy": "A.DSR_GRP_CONTAB",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.ACTIVO = 'S' AND A.AMBITO_GRP_CONTAB = 'A' AND A.RH_TP_INTERFACE = 'A' ", //On-New-Record
                            "edit": "  AND A.ACTIVO = 'S' AND A.AMBITO_GRP_CONTAB = 'A' AND A.RH_TP_INTERFACE = 'A' ", //On-Edit-Record
                        }
                    }  
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_GRP_CONTAB_ENT_DESCONTO',
                    "name": 'CD_GRP_CONTAB_ENT_DESCONTO',
                    "type": "hidden",
                    "visible": false,
                    "className": "",  
                }, {
                    "responsivePriority": 6, 
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_discount_entity_short, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_discount_entity; ?>",
                    "data": 'DSP_GRP_CONTAB_DESCT',
                    "name": 'DSP_GRP_CONTAB_DESCT',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "GRP_CONTAB_DESCT",
                        "dependent-level": 1,
                        "data-db-name": "A.CD_GRP_CONTAB",
                        "distribute-value": "CD_GRP_CONTAB_ENT_DESCONTO",
                        "decodeFromTable": "DG_DEF_GRUPOS_CONTABILISTICOS A",  //TO CHANGE ON QUAD-HCM
                        "desigColumn": "A.DSR_GRP_CONTAB", 
                        "orderBy": "A.DSR_GRP_CONTAB",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.ACTIVO = 'S' AND A.AMBITO_GRP_CONTAB = 'A' AND A.RH_TP_INTERFACE = 'C' ", //On-New-Record
                            "edit": "  AND A.ACTIVO = 'S' AND A.AMBITO_GRP_CONTAB = 'A' AND A.RH_TP_INTERFACE = 'C' ", //On-Edit-Record
                        }
                    }                     
                }, {
                    "responsivePriority": 7, 
                    "title": "<?php echo mb_strtoupper($ui_scope, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_scope; ?>", //Editor
                    "data": 'AMBITO',
                    "name": 'AMBITO',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'RH_DEF_CONTABILISTICOS.AMBITO',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['RH_DEF_CONTABILISTICOS.AMBITO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }                              
                }, {
                    "responsivePriority": 8, 
                    "title": "<?php echo mb_strtoupper($ui_movement_rule, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_movement_rule; ?>", //Editor
                    "data": 'MSK_SINAL',
                    "name": 'MSK_SINAL',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_NATUREZA_CONTA',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_NATUREZA_CONTA'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }  
                }, {
                    "responsivePriority": 9, 
                    "title": "<?php echo mb_strtoupper($ui_mask, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_mask; ?>", //Editor
                    "data": 'MASCARA',
                    "name": 'MASCARA',
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 10, 
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
                        return RH_DEF_CONTABILISTICOS_DESCONTOS.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DSP_EMPRESA": {
                        required: true
                    },
                    "CD_APIC": {
                        integer: true,
                        maxlength: 10,
                        required: true
                    },
                    "AMBITO": {
                       required: true
                    },
                    "MASCARA": {
                       required: true,
                       maxlength: 200,
                    },
                    "ACTIVO": {
                       required: true
                    }
                }
            }
        };
        RH_DEF_CONTABILISTICOS_DESCONTOS = new QuadTable();
        RH_DEF_CONTABILISTICOS_DESCONTOS.initTable( $.extend({}, datatable_instance_defaults, optionRH_DEF_CONTABILISTICOS_DESCONTOS) );                
        //END Regras - Descontos
        
        //Regras - Duodécimos
        var optionRH_DEF_CONTABILISTICOS_DUO = {
            "tableId": "RH_DEF_CONTABILISTICOS_DUO",
            //"selectRecordMsg": "<?php echo $ui_please_select_record . $ui_professional_category; ?>",
            "table": "RH_DEF_CONTABILISTICOS", 
            "pk": {
                "primary": {
                    "CD_APIC": {"type": "varchar"}
                }
            },
            "crudOnMasterInactive": {
                "condition": "data.ACTIVO !== 'S' ",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },             
            "initialWhereClause": " PROVENIENCIA = 'D' ",
            //"detailsObjects": ['RH_DEF_CATS_PROFISSIONAL_TRADS'],
            "order_by": "CD_APIC",
            "scrollY": "234", 
            "recordBundle": 8,
            "pageLenght": 8, 
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
                    "data": 'PROVENIENCIA',
                    "name": 'PROVENIENCIA',
                    "def": "D",
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
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
                    "data": 'CD_APIC',
                    "name": 'CD_APIC',
                    "className": "visibleColumn", 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_GRP_CONTAB_COLABORADOR',
                    "name": 'CD_GRP_CONTAB_COLABORADOR',
                    "type": "hidden",
                    "visible": false,
                    "className": "",  
                }, {
                    "responsivePriority": 4, 
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_employee, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_employee; ?>",
                    "data": 'DSP_GRP_CONTAB_EMP',
                    "name": 'DSP_GRP_CONTAB_EMP',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "GRP_CONTAB_EMP",
                        "dependent-level": 1,
                        "data-db-name": "A.CD_GRP_CONTAB",
                        "distribute-value": "CD_GRP_CONTAB_COLABORADOR",
                        "decodeFromTable": "DG_DEF_GRUPOS_CONTABILISTICOS A",  //TO CHANGE ON QUAD-HCM
                        "desigColumn": "A.DSR_GRP_CONTAB", 
                        "orderBy": "A.DSR_GRP_CONTAB",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.ACTIVO = 'S' AND A.AMBITO_GRP_CONTAB = 'A' AND A.RH_TP_INTERFACE = 'B' ", //On-New-Record
                            "edit": "  AND A.ACTIVO = 'S' AND A.AMBITO_GRP_CONTAB = 'A' AND A.RH_TP_INTERFACE = 'B' ", //On-Edit-Record
                        }
                    } 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'AMBITO',
                    "name": 'AMBITO',
                    "type": "hidden",
                    "visible": false,
                    "className": "", 
                    "def": "A"
                }, {
                    "responsivePriority": 5, 
                    "title": "<?php echo mb_strtoupper($ui_movement_rule, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_movement_rule; ?>", //Editor
                    "data": 'MSK_SINAL',
                    "name": 'MSK_SINAL',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_NATUREZA_CONTA',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_NATUREZA_CONTA'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }  
                }, {
                    "responsivePriority": 6, 
                    "title": "<?php echo mb_strtoupper($ui_mask, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_mask; ?>", //Editor
                    "data": 'MASCARA',
                    "name": 'MASCARA',
                    "className": "visibleColumn",
                }, {
                    "title": "<?php echo mb_strtoupper($ui_formula, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_formula; ?>", //Editor
                    "data": 'FORMULA_DUO',
                    "name": 'FORMULA_DUO',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 335px;",
                    } 
                }, {
                    "title": "<?php echo mb_strtoupper($ui_forecast_formula, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_forecast_formula; ?>", //Editor
                    "data": 'FORMULA_DUO_PREV',
                    "name": 'FORMULA_DUO_PREV',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 335px;",
                    } 
                }, {
                    "responsivePriority": 7, 
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
                        return RH_DEF_CONTABILISTICOS_DUO.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DSP_EMPRESA": {
                        required: true
                    },
                    "CD_APIC": {
                        integer: true,
                        maxlength: 10,
                        required: true
                    },
                    "MASCARA": {
                       required: true,
                       maxlength: 200,
                    },
                    "FORMULA_DUO": {
                       required: true,
                       maxlength: 4000,
                    },
                    "FORMULA_DUO_PREV": {
                       required: false,
                       maxlength: 4000,
                    },
                    "ACTIVO": {
                       required: true
                    }
                }
            }
        };
        RH_DEF_CONTABILISTICOS_DUO = new QuadTable();
        RH_DEF_CONTABILISTICOS_DUO.initTable( $.extend({}, datatable_instance_defaults, optionRH_DEF_CONTABILISTICOS_DUO) );
        //END Regras - Duodécimos
        
        //Regras - Líquido
        var optionRH_DEF_CONTABILISTICOS_LIQ = {
            "tableId": "RH_DEF_CONTABILISTICOS_LIQ",
            //"selectRecordMsg": "<?php echo $ui_please_select_record . $ui_professional_category; ?>",
            "table": "RH_DEF_CONTABILISTICOS", 
            "pk": {
                "primary": {
                    "CD_APIC": {"type": "varchar"}
                }
            },
            "crudOnMasterInactive": {
                "condition": "data.ACTIVO !== 'S' ",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },             
            "initialWhereClause": " PROVENIENCIA = 'C' ",
            //"detailsObjects": ['RH_DEF_CATS_PROFISSIONAL_TRADS'],
            "order_by": "CD_APIC",
            "scrollY": "234", 
            "recordBundle": 8,
            "pageLenght": 8,  
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
                    "data": 'PROVENIENCIA',
                    "name": 'PROVENIENCIA',
                    "def": "A",
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
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
                    "data": 'CD_APIC',
                    "name": 'CD_APIC',
                    "className": "visibleColumn", 
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_GRP_CONTAB_COLABORADOR',
                    "name": 'CD_GRP_CONTAB_COLABORADOR',
                    "type": "hidden",
                    "visible": false,
                    "className": "",  
                }, {
                    "responsivePriority": 4, 
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_employee, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_employee; ?>",
                    "data": 'DSP_GRP_CONTAB_EMP',
                    "name": 'DSP_GRP_CONTAB_EMP',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "GRP_CONTAB_EMP",
                        "dependent-level": 1,
                        "data-db-name": "A.CD_GRP_CONTAB",
                        "distribute-value": "CD_GRP_CONTAB_COLABORADOR",
                        "decodeFromTable": "DG_DEF_GRUPOS_CONTABILISTICOS A",  //TO CHANGE ON QUAD-HCM
                        "desigColumn": "A.DSR_GRP_CONTAB", 
                        "orderBy": "A.DSR_GRP_CONTAB",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.ACTIVO = 'S' AND A.AMBITO_GRP_CONTAB = 'A' AND A.RH_TP_INTERFACE = 'B' ", //On-New-Record
                            "edit": "  AND A.ACTIVO = 'S' AND A.AMBITO_GRP_CONTAB = 'A' AND A.RH_TP_INTERFACE = 'B' ", //On-Edit-Record
                        }
                    }   
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_GRP_CONTAB_RUBRICA',
                    "name": 'CD_GRP_CONTAB_RUBRICA',
                    "type": "hidden",
                    "visible": false,
                    "className": "",  
                }, {
                    "responsivePriority": 5, 
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_wage_item, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_wage_item; ?>",
                    "data": 'DSP_GRP_CONTAB_RUB',
                    "name": 'DSP_GRP_CONTAB_RUB',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "GRP_CONTAB_RUB",
                        "dependent-level": 1,
                        "data-db-name": "A.CD_GRP_CONTAB",
                        "distribute-value": "CD_GRP_CONTAB_RUBRICA",
                        "decodeFromTable": "DG_DEF_GRUPOS_CONTABILISTICOS A",  //TO CHANGE ON QUAD-HCM
                        "desigColumn": "A.DSR_GRP_CONTAB", 
                        "orderBy": "A.DSR_GRP_CONTAB",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.ACTIVO = 'S' AND A.AMBITO_GRP_CONTAB = 'A' AND A.RH_TP_INTERFACE = 'A' ", //On-New-Record
                            "edit": "  AND A.ACTIVO = 'S' AND A.AMBITO_GRP_CONTAB = 'A' AND A.RH_TP_INTERFACE = 'A' ", //On-Edit-Record
                        }
                    }  
                }, {
                    "responsivePriority": 6, 
                    "title": "<?php echo mb_strtoupper($ui_scope, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_scope; ?>", //Editor
                    "data": 'AMBITO',
                    "name": 'AMBITO',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'RH_DEF_CONTABILISTICOS.AMBITO',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['RH_DEF_CONTABILISTICOS.AMBITO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }                              
                }, {
                    "responsivePriority": 7, 
                    "title": "<?php echo mb_strtoupper($ui_movement_rule, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_movement_rule; ?>", //Editor
                    "data": 'MSK_SINAL',
                    "name": 'MSK_SINAL',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_NATUREZA_CONTA',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_NATUREZA_CONTA'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }  
                }, {
                    "responsivePriority": 8, 
                    "title": "<?php echo mb_strtoupper($ui_mask, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_mask; ?>", //Editor
                    "data": 'MASCARA',
                    "name": 'MASCARA',
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 9, 
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
                        return RH_DEF_CONTABILISTICOS_LIQ.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DSP_EMPRESA": {
                        required: true
                    },
                    "CD_APIC": {
                        integer: true,
                        maxlength: 10,
                        required: true
                    },
                    "AMBITO": {
                       required: true
                    },
                    "MASCARA": {
                       required: true,
                       maxlength: 200,
                    },
                    "ACTIVO": {
                       required: true
                    }
                }
            }
        };
        RH_DEF_CONTABILISTICOS_LIQ = new QuadTable();
        RH_DEF_CONTABILISTICOS_LIQ.initTable( $.extend({}, datatable_instance_defaults, optionRH_DEF_CONTABILISTICOS_LIQ) );        
        //END Regras - Líquido
        
        //MÁSCARA COMPOSITION :: Editor VALIDATION events :: EDITOR MANIPULATION EVENTS
        if (1 === 1) {
            //Rúbricas :: Editor
            $(document).on('RH_DEF_CONTABILISTICOS_RUBAttachEvt', function (event) {                                
                event.preventDefault();
                event.stopPropagation();
                
                //Removing (previous) events
                $("#aider", "#RH_DEF_CONTABILISTICOS_RUB_editorForm").off('click');
                
                //popopManager("#RH_DEF_CONTABILISTICOS_RUB_editorForm", RH_DEF_CONTABILISTICOS_RUB);
                var frm_context = "#RH_DEF_CONTABILISTICOS_RUB_editorForm", dt_1 = '', dt_2 = '', operacao = RH_DEF_CONTABILISTICOS_RUB.editor.s["action"]; //PREVIOUS VERSION -> RH_PROCESSOS_AVALIACAO.editor.s.editOpts["action"];
                var ctrl = 0;
                
                //Insert TOOLTIP button on EDITOR (if nedded)
                if ( !$('#aider',"#RH_DEF_CONTABILISTICOS_RUB_editorForm").length ) {
                    //Clone TOOLTIP button
                    var btn = $('#lov').clone(true, true);
                    btn.html(btn.html().replace("rel=\"popover\"","rel=\"popover_rub\""));
                                        
                    $('#DTE_Field_MASCARA', "#RH_DEF_CONTABILISTICOS_RUB_editorForm").after(btn.html());
                    
                    // ativa a popover com a máscara para rubricas e atribuir a classe mask_rub para ativar trigger
                    $("[rel=popover_rub]").popover(
                        {placement: function(context, src) {
                            $(context).addClass('mask_rub');
                            return 'left'; 
                        }}            
                    );
                }

                function dismissPopop(el,evt) {
                    evt.preventDefault();
                    evt.stopPropagation(); 
                    setTimeout(function() {
                         el.popover('hide').delay(250);
                    },150);
                }
                
                //MASCATA ADD BUTTON
                if (1 === 1) {
                    //TOOLTIP "click" EVENT                    
                    //$('#RH_DEF_CONTABILISTICOS_RUB_editorForm').on('click' , '[rel="popover"]' , function(evt){
                    $("#aider", "#RH_DEF_CONTABILISTICOS_RUB_editorForm").off('click');
                    $("#aider", "#RH_DEF_CONTABILISTICOS_RUB_editorForm").on('click', function(evt){
                        console.log( 'Rubricas :: POPOP :: Click Event...');
                        evt.preventDefault();
                        evt.stopPropagation();
                        //Popover button
                        var i = $(this, '#RH_DEF_CONTABILISTICOS_RUB_editorForm'); 
                        
                        //Popover control: ctrl==0 is closed, need to open; else is open need to dismiss
                        var popoverId = i.attr('aria-describedby');                        
                        if (popoverId === undefined) {
                            ctrl = 0;
                        } else {
                            ctrl = 1;
                        }                            
                        
                        setTimeout(function() {                                                    
                            if( !ctrl ) { //Open popover
                                i.popover('show',evt);                                
                                //TOOLTIP SELECT EVENT
//                                $("#selectMask", '#RH_DEF_CONTABILISTICOS_RUB_editorForm').on('click', function(evt_){
                                  $(document).off("click", ".mask_rub #selectMask");
                                  $(document).on("click", ".mask_rub #selectMask", function(evt_){
                                    console.log( 'Rubricas :: POPOP :: SELECT MASK Event...');
                                    evt_.preventDefault();
                                    evt_.stopPropagation();                                    
//                                    var valor = $('#maskChoice', '#RH_DEF_CONTABILISTICOS_RUB_editorForm').val();
                                    var valor = $('.mask_rub .popover-body #maskChoice').val();
                                    if (valor.length) {
                                        var elm = $('#DTE_Field_MASCARA', '#RH_DEF_CONTABILISTICOS_RUB_editorForm');
                                        elm.val( (elm.val() + valor) );
                                        
                                        //After select :: DISMISSES TOOLTIP :: Only effective way of dismissing popover
                                        //i.trigger('click');
                                        dismissPopop(i,evt_);
                                    }
                                 }); 
                            } else { //Close popover
                                dismissPopop(i,evt);
                            }                            
                        },150);
                    });
                }                
            });
            //END Rúbricas :: Editor
        
            //Descontos :: Editor
            $(document).on('RH_DEF_CONTABILISTICOS_DESCONTOSAttachEvt', function (event) {
                event.preventDefault();
                event.stopPropagation();
                
                //Removing (previous) events
                $("#aider", "#RH_DEF_CONTABILISTICOS_DESCONTOS_editorForm").off('click');
                $("#selectMask", '#RH_DEF_CONTABILISTICOS_DESCONTOS_editorForm').off('click');                
                
                var frm_context = "#RH_DEF_CONTABILISTICOS_DESCONTOS_editorForm", dt_1 = '', dt_2 = '', operacao = RH_DEF_CONTABILISTICOS_DESCONTOS.editor.s["action"]; //PREVIOUS VERSION -> RH_PROCESSOS_AVALIACAO.editor.s.editOpts["action"];
                var ctrl = 0;
                
                //Insert TOOLTIP button on EDITOR (if nedded)
                if ( !$('#aider',"#RH_DEF_CONTABILISTICOS_DESCONTOS_editorForm").length ) {
                    //Clone TOOLTIP button
                    var btn = $('#lov').clone(true, true);
                    btn.html(btn.html().replace("rel=\"popover\"","rel=\"popover_desc\""));
                    $('#DTE_Field_MASCARA', "#RH_DEF_CONTABILISTICOS_DESCONTOS_editorForm").after(btn.html());
                    
                    // ativa a popover com a máscara para rubricas e atribuir a classe mask_rub para ativar trigger
                    $("[rel=popover_desc]").popover(
                        {placement: function(context, src) {
                            $(context).addClass('mask_desc');
                            return 'left'; 
                        }}            
                    );
                }

                function dismissPopop(el,evt) {
                    evt.preventDefault();
                    evt.stopPropagation(); 
                    setTimeout(function() {
                         el.popover('hide').delay(250);
                    },150);
                }
                
                //MASCATA ADD BUTTON
                if (1 === 1) {                    
                    //$('#RH_DEF_CONTABILISTICOS_RUB_editorForm').on('click' , '[rel="popover"]' , function(evt){
                    $("#aider", "#RH_DEF_CONTABILISTICOS_DESCONTOS_editorForm").on('click', function(evt){
                        evt.preventDefault();
                        evt.stopPropagation();
                        //Popover button
                        var i = $(this, '#RH_DEF_CONTABILISTICOS_DESCONTOS_editorForm'); 
                        
                        //Popover control: ctrl==0 is closed, need to open; else is open need to dismiss
                        var popoverId = i.attr('opened');
                        if (popoverId === undefined) {
                            ctrl = 0;
                            i.attr('opened','opened');
                        } else {
                            ctrl = 1;
                            i.removeAttr('opened','opened');
                        }
                        
                        setTimeout(function() {                                                    
                            if( !ctrl ) { //Open popover
                                i.popover('show',evt);                                
                                //TOOLTIP SELECT EVENT
                                $(document).off("click", ".mask_desc #selectMask");
                                $(document).on("click", ".mask_desc #selectMask", function(evt_){
                                    evt_.preventDefault();
                                    evt_.stopPropagation();                                    
                                    var valor = $('.mask_desc .popover-body #maskChoice').val();
                                    if (valor.length) {
                                        var elm = $('#DTE_Field_MASCARA', '#RH_DEF_CONTABILISTICOS_DESCONTOS_editorForm');
                                        elm.val( (elm.val() + valor) );
                                        //After select :: DISMISSES TOOLTIP :: Only effective way of dismissing popover
                                        dismissPopop(i,evt_);
                                    }
                                }); 
                            } else { //Close popover
                                dismissPopop(i,evt);
                            }                     
                        },150);
                    });
                }
            });
            //END Descontos :: Editor
            
            //Duodécimos :: Editor
            $(document).on('RH_DEF_CONTABILISTICOS_DUOAttachEvt', function (event) {                                
                event.preventDefault();
                event.stopPropagation();
                //Removing (previous) events
                $("#aider", "#RH_DEF_CONTABILISTICOS_DUO_editorForm").off('click');
                
                var frm_context = "#RH_DEF_CONTABILISTICOS_DUO_editorForm", dt_1 = '', dt_2 = '', operacao = RH_DEF_CONTABILISTICOS_DUO.editor.s["action"]; //PREVIOUS VERSION -> RH_PROCESSOS_AVALIACAO.editor.s.editOpts["action"];
                var ctrl = 0;
                
                //Insert TOOLTIP button on EDITOR (if nedded)
                if ( !$('#aider',"#RH_DEF_CONTABILISTICOS_DUO_editorForm").length ) {
                    //Clone TOOLTIP button
                    var btn = $('#lov').clone(true, true);
                    btn.html(btn.html().replace("rel=\"popover\"","rel=\"popover_duo\""));
                    $('#DTE_Field_MASCARA', "#RH_DEF_CONTABILISTICOS_DUO_editorForm").after(btn.html());
                    
                    // ativa a popover com a máscara para rubricas e atribuir a classe mask_rub para ativar trigger
                    $("[rel=popover_duo]").popover(
                        {placement: function(context, src) {
                            $(context).addClass('mask_duo');
                            return 'left'; 
                        }}            
                    );
                }

                function dismissPopop(el,evt) {
                    evt.preventDefault();
                    evt.stopPropagation(); 
                    setTimeout(function() {
                         el.popover('hide').delay(250);
                    },150);
                }
                
                //MASCATA ADD BUTTON
                if (1 === 1) {
                    //TOOLTIP "click" EVENT
                    
                    //$('#RH_DEF_CONTABILISTICOS_RUB_editorForm').on('click' , '[rel="popover"]' , function(evt){
                    $("#aider", "#RH_DEF_CONTABILISTICOS_DUO_editorForm").on('click', function(evt){
                        evt.preventDefault();
                        evt.stopPropagation();
                        //Popover button
                        var i = $(this, '#RH_DEF_CONTABILISTICOS_DUO_editorForm'); 
                        
                        //Popover control: ctrl==0 is closed, need to open; else is open need to dismiss
                        var popoverId = i.attr('opened');
                        if (popoverId === undefined) {
                            ctrl = 0;
                            i.attr('opened','opened');
                        } else {
                            ctrl = 1;
                            i.removeAttr('opened','opened');
                        }
                        
                        setTimeout(function() {                                                    
                            if( !ctrl ) { //Open popover
                                i.popover('show',evt);

                                //TOOLTIP SELECT EVENT
                                $(document).off("click", ".mask_duo #selectMask");
                                $(document).on("click", ".mask_duo #selectMask", function(evt_){
                                    evt_.preventDefault();
                                    evt_.stopPropagation();                                    
                                    var valor = $('.mask_duo .popover-body #maskChoice').val();
                                    if (valor.length) {
                                        var elm = $('#DTE_Field_MASCARA', '#RH_DEF_CONTABILISTICOS_DUO_editorForm');
                                        elm.val( (elm.val() + valor) );                                        
                                        //After select :: DISMISSES TOOLTIP :: Only effective way of dismissing popover
                                        dismissPopop(i,evt_);
                                    }
                                }); 

                            } else { //Close popover
                                dismissPopop(i,evt);
                            }                            
                        },150);
                    });
                }
                
            });
            //END Duodécimos :: Editor

            //Líquido :: Editor
            $(document).on('RH_DEF_CONTABILISTICOS_LIQAttachEvt', function (event) {                                
                event.preventDefault();
                event.stopPropagation();
                
                //Removing (previous) events
                $("#aider", "#RH_DEF_CONTABILISTICOS_LIQ_editorForm").off('click');
                $("#selectMask", '#RH_DEF_CONTABILISTICOS_LIQ_editorForm').off('click');                
                
                var frm_context = "#RH_DEF_CONTABILISTICOS_LIQ_editorForm", dt_1 = '', dt_2 = '', operacao = RH_DEF_CONTABILISTICOS_LIQ.editor.s["action"]; //PREVIOUS VERSION -> RH_PROCESSOS_AVALIACAO.editor.s.editOpts["action"];
                var ctrl = 0;
                
                //Insert TOOLTIP button on EDITOR (if nedded)
                if ( !$('#aider',"#RH_DEF_CONTABILISTICOS_LIQ_editorForm").length ) {
                    //Clone TOOLTIP button
                    var btn = $('#lov').clone(true, true);
                    btn.html(btn.html().replace("rel=\"popover\"","rel=\"popover_liq\""));
                    $('#DTE_Field_MASCARA', "#RH_DEF_CONTABILISTICOS_LIQ_editorForm").after(btn.html());
                    
                    // ativa a popover com a máscara para rubricas e atribuir a classe mask_rub para ativar trigger
                    $("[rel=popover_liq]").popover(
                        {placement: function(context, src) {
                            $(context).addClass('mask_liq');
                            return 'left'; 
                        }}            
                    );
                }

                function dismissPopop(el,evt) {
                    evt.preventDefault();
                    evt.stopPropagation(); 
                    setTimeout(function() {
                         el.popover('hide').delay(250);
                    },150);
                }
                
                //MASCATA ADD BUTTON
                if (1 === 1) {
                    //TOOLTIP "click" EVENT
                    
                    //$('#RH_DEF_CONTABILISTICOS_RUB_editorForm').on('click' , '[rel="popover"]' , function(evt){
                    $("#aider", "#RH_DEF_CONTABILISTICOS_LIQ_editorForm").on('click', function(evt){
                        evt.preventDefault();
                        evt.stopPropagation();
                        //Popover button
                        var i = $(this, '#RH_DEF_CONTABILISTICOS_LIQ_editorForm'); 
                        
                        //Popover control: ctrl==0 is closed, need to open; else is open need to dismiss
                        var popoverId = i.attr('opened');
                        if (popoverId === undefined) {
                            ctrl = 0;
                            i.attr('opened','opened');
                        } else {
                            ctrl = 1;
                            i.removeAttr('opened','opened');
                        }
                        
                        setTimeout(function() {                                                    
                            if( !ctrl ) { //Open popover
                                i.popover('show',evt);
                                
                                //TOOLTIP SELECT EVENT
                                $(document).off("click", ".mask_liq #selectMask");
                                $(document).on("click", ".mask_liq #selectMask", function(evt_){
                                    evt_.preventDefault();
                                    evt_.stopPropagation();                                    
                                    var valor = $('.mask_liq .popover-body #maskChoice').val();
                                    if (valor.length) {
                                        var elm = $('#DTE_Field_MASCARA', '#RH_DEF_CONTABILISTICOS_LIQ_editorForm');
                                        elm.val( (elm.val() + valor) );                                        
                                        //After select :: DISMISSES TOOLTIP :: Only effective way of dismissing popover
                                        dismissPopop(i,evt_);
                                    }
                                }); 

                            } else { //Close popover
                                dismissPopop(i,evt);
                            }                            
                        },150);
                    });
                }
                
            });
            //END Líquido :: Editor
        }
        
    });
</script>
