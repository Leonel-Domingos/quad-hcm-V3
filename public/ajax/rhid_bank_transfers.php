<?php
    require_once '../init.php';
?>

<!-- BEGIN Page Content -->
<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <span class="widget-icon"> <i class="fal fa-clone"></i></span>&nbsp;
                <h2><?php echo $ui_bank_transfers; ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">                                            
                    <a id="RH_ID_RECEBIMENTOS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                    <table id="RH_ID_RECEBIMENTOS" class="table table-bordered table-hover table-striped w-100"></table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->
    
<script>
    pageSetUp();

    var perfil_ = "<?php echo @$_SESSION['perfil'];?>",
        rhid_ = "<?php echo @$_SESSION['rhid'];?>",
        whereClause_ = " A.TP_DESPESA = 'A' "; //GERAIS

    $(document).ready(function () {
        
        //Recebimentos
        var optionsRH_ID_RECEBIMENTOS = {
            "tableId": "RH_ID_RECEBIMENTOS",
            "table": "RH_ID_RECEBIMENTOS",
            "pk": {
                "primary": {
                    "ID_": {"type": "number"},    
                    "EMPRESA": {"type": "varchar"},    
                    "RHID": {"type": "number"},    
                    "DT_ADMISSAO": {"type": "date"}
                }
            },
//            inRowDoc: {
//                saveAsBlob: true,
//                fileNameField: 'LINK_DOC',
//                extField: 'BD_MIME',
//                pathField: 'LINK_DOC',
//                blobField: 'BD_DOC',
//                savePath: 'tmp'
//            },
//            "initialWhereClause": whereClause_,
            "detailsObjects": ['RH_ID_DET_CONTAS_CORRENTES'],
            "order_by": "ID_ DESC",
            "recordBundle": 8,
            "pageLenght": 8,
            "scrollY": "273",
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "className": "control toBottom toCenter",
                    "width": "1%",
                    "defaultContent": ''
                }, {
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'ID_',
                    "name": 'ID_',
                    "datatype": 'sequence',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": true,
                    "className": "none visibleColumn",
                    "width": "1%"
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
                    //"visible": false, //DataTables
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
                    "label": "", //Editor
                    "data": 'RHID',
                    "name": 'RHID',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": false,
                    "className": "",
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_ADMISSAO',
                    "name": 'DT_ADMISSAO',
                    "datatype": 'date',
                    "visible": false,
                    "type": "hidden"
                }, {
                    "label": "", //Editor
                    "data": 'TP_MOVIMENTO',
                    "name": 'TP_MOVIMENTO',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": false,
                    "className": "",
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_rhid, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_rhid; ?>",
                    "data": 'DSP_NOME',
                    "name": 'DSP_NOME',
                    "type": "select",
                    "className": "visibleColumn",
                    "complexList": true,
                    "attr": {
                        "dependent-group": "EMPRESA",
                        "dependent-level": 2,
                        "data-db-name": 'A.EMPRESA@A.RHID@A.DT_ADMISSAO',
                        "decodeFromTable": 'QUAD_PEOPLE A',
                        "class": "form-control complexList chosen",
                        "desigColumn": "CONCAT(CONCAT(A.RHID,'-'),A.NOME_REDZ)",
                        "whereClause": "",
                        "orderBy": 'A.NOME_REDZ',
                        "filter": {
                            "create": " AND A.DT_DEMISSAO IS NULL AND " + whereClause_, //On-New-Record
                            "edit": " AND A.DT_DEMISSAO IS NULL AND " + whereClause_, //On-Edit-Record
                        }
                    }
               }, {
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_year, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_year; ?>", //Editor
                    "data": 'ANO',
                    "name": 'ANO',
                    "className": "right visibleColumn",
                    "type": "readonly"
                }, {
                    "responsivePriority": 5,
                    "title": "<?php echo mb_strtoupper($ui_month, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_month; ?>", //Editor
                    "data": 'MES',
                    "name": 'MES',
                    "className": "right visibleColumn",
                    "type": "readonly"
                }, {
                    "responsivePriority": 6,
                    "title": "<?php echo mb_strtoupper($ui_reference, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_reference; ?>", //Editor
                    "data": 'REFERENCIA',
                    "name": 'REFERENCIA',
                    "className": "visibleColumn"

                }, {
                    "responsivePriority": 7,
                    "title": "<?php echo mb_strtoupper($ui_value, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_value; ?>", //Editor
                    "data": 'VALOR',
                    "name": 'VALOR',
                    "className": "right visibleColumn",
                    "render": function (val, type, row) {
                        if (val) {
                            if (!row['CD_MOEDA']) { //Default
                                val = renderNumber(val, ',', '.', 2, '', ' €');
                            } else {
                                val = renderNumber(val, ',', '.', 2, '', ' ' + row['DSP_MOEDA']);
                            }
                        }
                        return val;
                    }     
                }, {
                    "responsivePriority": 8,
                    "title": "<?php echo mb_strtoupper($ui_iban_short, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_iban_short; ?>", //Editor
                    "data": 'NIB',
                    "name": 'NIB',
                    "className": "visibleColumn"
                }, {
                    "responsivePriority": 9,
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
                    "title": "<?php echo mb_strtoupper($ui_period, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_period; ?>", //Editor
                    "data": 'ID_PERIODO',
                    "name": 'ID_PERIODO',
                    "className": "none right visibleColumn",
                    "type": "readonly"        
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
                        return RH_ID_RECEBIMENTOS.crudButtons(false,true,false);
                    }
                }
            ]
        };
        RH_ID_RECEBIMENTOS = new QuadTable();
        RH_ID_RECEBIMENTOS.initTable($.extend({}, datatable_instance_defaults, optionsRH_ID_RECEBIMENTOS));
        //END Recebimentos       

    });
</script>
