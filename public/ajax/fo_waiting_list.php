<?php
    require_once '../init.php';
?>

<!-- BEGIN Page Content -->
<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <span class="widget-icon"> <i class="fal fa-clone"></i></span>&nbsp;
                <h2><?php echo $ui_waiting_list; ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">                                            
                    <a id="GF_LISTAS_ESPERA_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                    <table id="GF_LISTAS_ESPERA" class="table table-bordered table-hover table-striped w-100"></table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->
    
<script>
    pageSetUp();

    $(document).ready(function () {

        //Waiting List
        var optionsGF_LISTAS_ESPERA = {
            "tableId": "GF_LISTAS_ESPERA",
            "table": "GF_LISTAS_ESPERA",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "ID_CURSO": {"type": "number"},
                    "TP_REGISTO": {"type": "number"},
                    "DT_INI_CURSO": {"type": "date"},
                    "ID_LISTA_ESPERA": {"type": "number"}
                }
            },
            "order_by": "ID_LISTA_ESPERA",
            "scrollY": "585",
            "recordBundle": 16,
            "pageLenght": 16,
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
                    "responsivePriority": 3,
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_course, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_course; ?>",
                    "data": 'DSP_CURSO',
                    "name": 'DSP_CURSO',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "EMPRESA",
                        "dependent-level": 2,
                        "data-db-name": "A.EMPRESA@A.ID_CURSO@A.TP_REGISTO@A.DT_INI_CURSO",
                        "decodeFromTable": "GF_CURSOS A", //TO CHANGE ON QUAD-HCM
                        "desigColumn": "A.DSP_CURSO",
                        "orderBy": "A.ID_CURSO",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.DT_FIM_CURSO IS NULL", //On-New-Record
                            "edit": " AND A.DT_FIM_CURSO IS NULL", //On-Edit-Record
                        } 
                    }                                        
                }, {
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_id, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_id; ?>",
                    "data": 'ID_LISTA_ESPERA',
                    "name": 'ID_LISTA_ESPERA',
                    "datatype": 'sequence',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": true,
                    "className": "visibleColumn", 

                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_ORIGEM',
                    "name": 'ID_ORIGEM',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_ORIGEM',
                    "name": 'DT_INI_ORIGEM',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables           
                }, {
                    "responsivePriority": 5,
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_origin, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_origin; ?>",
                    "data": 'DSP_ORIGEM',
                    "name": 'DSP_ORIGEM',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "GF_ORIGEM",
                        "dependent-level": 1,
                        "data-db-name": 'A.ID_ORIGEM@A.DT_INI_ORIGEM',
                        //"otherValues": "DOMINIO('GF_PRIORIDADE','A','')",
                        //"distribute-value": '',
                        "decodeFromTable": 'GF_ORIGEM_LISTAS_ESPERA A',
                        "desigColumn": "A.DSP_ORIGEM",
                        "whereClause": "",
                        "orderBy": "NVL(A.ID_ORIGEM, A.PRIORIDADE)",
                        "class": "form-control complexList chosen",
                        //"disabled": true, //Permite inibir o campo no Editor
                        "filter": {
                            "create": " AND A.DT_FIM_ORIGEM IS NULL", //On-New-Record
                            "edit": " AND A.DT_FIM_ORIGEM IS NULL", //On-Edit-Record
                        }
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": "RHID",
                    "name": "RHID",
                    "type": "hidden",
                    "visible": false,
                    "className": ""
                }, {
                    "responsivePriority": 6,
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_rhid, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_rhid; ?>",
                    "data": 'NOME_REDZ',
                    "name": 'NOME_REDZ',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                                        
                    "attr": {
                        "dependent-group": "EMPRESA",
                        "dependent-level": 2,
                        "data-db-name": 'A.EMPRESA@A.RHID',
                        "decodeFromTable": 'QUAD_PEOPLE A',
                        "desigColumn": "CONCAT(CONCAT(A.RHID,'-'),A.NOME_REDZ)", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.                        
                        "orderBy": "A.RHID", //usado no complexList.php
                        "class": "form-control complexList chosen",
                        //"disabled": true, //Permite inibir o campo no Editor
                        "filter": {
                            "create": " AND A.ATIVO = 'S' AND A.FORMACAO = 'S' ", //On-New-Record
                            "edit": " AND A.ATIVO = 'S' AND A.FORMACAO = 'S' ", //On-Edit-Record
                        }
                    } 
                }, {
                    "responsivePriority": 7,
                    "title": "<?php echo mb_strtoupper($ui_priority, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_priority; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_priority_given; ?>",
                    "data": 'PRIORIDADE',
                    "name": 'PRIORIDADE',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'GF_PRIORIDADE',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['GF_PRIORIDADE'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }
                }, {
                    "responsivePriority": 8,
                    "title": "<?php echo mb_strtoupper($ui_requested, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_requested; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_priority_requested; ?>",
                    "data": 'PRIO_SOLICITADA',
                    "name": 'PRIO_SOLICITADA',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'GF_PRIORIDADE',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['GF_PRIORIDADE'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_LISTA_ESPERA',
                    "name": 'DT_INI_LISTA_ESPERA',
                    "datatype": 'date',
                    "def": hoje(),
                    "className": "visibleColumn",
                    "attr": {
                        "class": "form-control datepicker"
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": "ID_SITUACAO",
                    "name": "ID_SITUACAO",
                    "type": "hidden",
                    "visible": false,
                    "className": ""
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": "TP_SITUACAO",
                    "name": "TP_SITUACAO",
                    "type": "hidden",
                    "visible": false,
                    "className": ""
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": "DT_INI_SIT",
                    "name": "DT_INI_SIT",
                    "datatype": "date",
                    "type": "hidden",
                    "visible": false,
                    "className": ""    
                }, {
                     "responsivePriority": 9,
                    "title": "ESTADO_WKF ?", //Datatables
                    "label": "ESTADO_WKF ?", //Editor
                    "data": "ESTADO_WKF",
                    "name": "ESTADO_WKF",
                }, {
                    "responsivePriority": 6,
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
                        "data-db-name": "A.ID_SITUACAO@A.DT_INI_SIT@A.TP_SITUACAO",
                        //"distribute-value": "",
                        "decodeFromTable": 'GF_SITUACOES A',
                        "desigColumn": "A.DSP_SIT", 
                        "whereClause": "AND A.TP_SITUACAO = 'B'", //Estado: 'B' Listas Espera
                        "orderBy": "A.ID_SITUACAO",
                        "class": "form-control complexList chosen",
                        //"disabled": true, //Permite inibir o campo no Editor
                        "filter": {
                            "create": " AND A.DT_FIM_SIT IS NULL", //On-New-Record
                            "edit": " AND A.DT_FIM_SIT IS NULL", //On-Edit-Record
                        }                
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_external_ref, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_external_ref; ?>", //Editor
                    "data": 'REF_EXTERNA',
                    "name": 'REF_EXTERNA',
                    "type": 'text', //Editor
                    "className": "none visibleColumn",
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
                    "data": 'DT_FIM_LISTA_ESPERA',
                    "name": 'DT_FIM_LISTA_ESPERA',
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
                        return GF_LISTAS_ESPERA.crudButtons(true, true, true);
                    }
                }
            ],
            validations: {
                rules: {
                    ID_LISTA_ESPERA: {
                        required: true,
                        integer: true
                    },
                    DSP_ORIGEM: {
                        required: true
                    },
                    NOME_REDZ: {
                        required: true
                    },
                    PRIORIDADE: {
                        required: true
                    },
                    PRIO_SOLICITADA: {
                        required: true
                    },
                    DT_INI_LISTA_ESPERA: {
                        required: true,
                        dateISO: true,
                    },
                    DSP_SITUACAO: {
                        required: true
                    },
                    "DESCRICAO": {
                        required: false,
                        maxlength: 4000,
                    },
                    REF_EXTERNA: {
                        required: false,
                        maxlength: 25,
                    },
                    "DT_FIM_LISTA_ESPERA": {
                        dateISO: true,
                        dateEqOrNextThan: "DT_INI_LISTA_ESPERA",
                    }
                },
                "messages": {
                    "DT_FIM_LISTA_ESPERA": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        GF_LISTAS_ESPERA = new QuadTable();
        GF_LISTAS_ESPERA.initTable($.extend({}, datatable_instance_defaults, optionsGF_LISTAS_ESPERA));
        //END Waiting List
    });
</script>
