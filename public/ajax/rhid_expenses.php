<?php
    require_once '../init.php';
    
    /*CRUD + WorkFlow */
    $wkf_error = array();
    $thisFile = __FILE__;
    //FILENAME :: To compose ERROR available to JS (FASE 2)
    $frm = strtoupper( basename($thisFile,'.php') );
    //CHECK IF FILE EXISTS AND IS JSON 
    $frm_definitions = go_no_go($thisFile, $wkf_error, $seconds);
    //echo "<br>". "( $seconds )" . "<br>". $frm_definitions;    
    
?>

<div class="alert alert-danger" role="alert">
    <strong><b>TODO</b></strong> 
    <ul>
        <li>PTE: Carregamento dos ficheiros de WORKFLOW -- utilizar go_no_go() de quad_db_lib.php </li>
    </ul>
</div>


<!-- BEGIN Page Content -->
<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <span class="widget-icon"> <i class="far fa-coinse"></i></span>&nbsp;
                <h2><?php echo $ui_expenses; ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">                                            
                    <a id="RH_ID_HDR_DESPESAS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                    <table id="RH_ID_HDR_DESPESAS" class="table table-bordered table-hover table-striped w-100"></table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <span class="widget-icon"> <i class="fal fa-credit-card"></i></span>&nbsp;
                <h2><?php echo $ui_details; ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <a id="RH_ID_DET_DESPESAS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                    <table id="RH_ID_DET_DESPESAS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->
    
<script>
    pageSetUp();

    var y = "<?php echo @$_SESSION['lang']; ?>", _user = "<?php echo @$_SESSION['utilizador']; ?>", 
        _profile = "<?php echo @$_SESSION['perfil']; ?>", rhid_ = "<?php echo @$_SESSION['rhid'];?>",whereClause_ = " 1=1 ";

    $(document).ready(function () {

        /* CRUD + WORKFLOW */
        var nomeForm = '<?php echo json_encode($frm); ?>', continue_,
            tabelas = ['RHID_EXPENSES'];
                
        //IF (CRUD + WORKFLOW) problem -> EXIT
        continue_ = go_no_go ('<?php echo json_encode($wkf_error); ?>', _user, _profile);
        
        var conf_EXPENSES = JSON.parse('<?php echo $frm_definitions; ?>'),
            empresa_is_shown = true;

        //Valida se TODAS as PROPRIEDADES de Instanciação do interface estão OK.
        //Se não for o caso, sai do interface com ERRO!!
        valid_requirements (nomeForm, conf_EXPENSES, tabelas, _user, _profile);

        //IF ACCESS to RH_IDENTIFICACOES is FALSE -> EXIT
        if ( !conf_EXPENSES['RHID_EXPENSES']["access"] ) {
            $('#left-panel > nav > ul > li.open.active > ul > li:nth-child(1) > a').trigger('click');
            $('#left-panel li > a[href="ajax/rhid_expenses.php"]').parent('li').remove();
        }
        
        //Despesas
        var optionsRH_ID_HDR_DESPESAS = {
            "tableId": "RH_ID_HDR_DESPESAS",
            "table": "RH_ID_HDR_DESPESAS",
            "workFlow": conf_EXPENSES['RHID_EXPENSES']["workflow"],
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_expenses; ?>",
            "pk": {
                "primary": {
                    "ID": {"type": "number"},    
//                    "EMPRESA": {"type": "varchar"},    
//                    "RHID": {"type": "number"},    
//                    "DT_ADMISSAO": {"type": "date"}
                }
            },
            //"initialWhereClause": whereClause_,
            "detailsObjects": ['RH_ID_DET_DESPESAS'],
            "order_by": "ID DESC",
            "recordBundle": 5,
            "pageLenght": 5,
            "scrollY": "156",
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "className": "control toBottom toCenter",
                    "width": "1%",
                    "defaultContent": ''
                }, {
                    "responsivePriority": 1,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'ID',
                    "name": 'ID',
                    "datatype": 'sequence',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": true,
                    "className": "visibleColumn",
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
                    "responsivePriority": 5,
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
                    "responsivePriority": 6,
                    "title": "<?php echo mb_strtoupper($ui_total, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_total; ?>", //Editor
                    "data": 'TOTAL_DESPESA',
                    "name": 'TOTAL_DESPESA',
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
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_MOEDA',
                    "name": 'CD_MOEDA',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables 
                }, {
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_currency, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_currency; ?>",
                    "data": 'DSP_MOEDA',
                    "name": 'DSP_MOEDA',
                    "type": "select",
                    "className": "none visibleColumn",
                    "renew": true, 
                    "width": "1%",
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
                    "responsivePriority": 8,
                    "title": "<?php echo mb_strtoupper($ui_state, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_state; ?>", //Editor
                    "data": 'ESTADO',
                    "name": 'ESTADO',
                    "type": "select",
                    "def": "A",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'RH_ID_HDR_DESPESAS.ESTADO',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['RH_ID_HDR_DESPESAS.ESTADO'], {'RV_LOW_VALUE': val});
                            var dsp = (null ? null : o['RV_MEANING']);
                            if (row['ESTADO'] === 'A') { //Criada
                                return '<span class="label" style="background-color: #3b9ff3;">' + dsp + '</span>';
                            } else if (row['ESTADO'] === 'B') { //Integrada
                                return '<span class="label label-success">' + dsp + '</span>';
                            } else if (row['ESTADO'] === 'C') { //Anulada
                                return '<span class="label label-danger">' + dsp + '</span>';
                            }
                        }
                        return val;                        
                    }                     
                }, {
                    "title": "<?php echo mb_strtoupper($ui_document_num, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_document_num; ?>", //Editor
                    "data": 'NR_DOCUMENTO',
                    "name": 'NR_DOCUMENTO',
                    "className": "none visibleColumn",                                      
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
                        return RH_ID_HDR_DESPESAS.crudButtons(conf_EXPENSES['RHID_EXPENSES']["crud"][0], conf_EXPENSES['RHID_EXPENSES']["crud"][1], conf_EXPENSES['RHID_EXPENSES']["crud"][2]);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DSP_EMPRESA": {
                        required: true
                    },
                    "DSP_NOME": {
                        required: true
                    },
                    "TOTAL_DESPESA": {
                        number: true
                    },
                    "DT_INICIO": {
                        required: false,
                        dateISO: true,
                    },
                    "ESTADO": {
                        required: true
                        //maxlength: 25,
                    },
                    "NR_DOCUMENTO": {
                        maxlength: 25,
                    },
                    "DT_FIM": {
                        required: false,
                        dateISO: true,
                        dateEqOrNextThan: 'DT_INICIO',
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
        RH_ID_HDR_DESPESAS = new QuadTable();
        RH_ID_HDR_DESPESAS.initTable($.extend({}, datatable_instance_defaults, optionsRH_ID_HDR_DESPESAS));
        //END Despesas
        
        //Detalhe Despesas
        var optionRH_ID_DET_DESPESAS = {
            "tableId": "RH_ID_DET_DESPESAS",
            "table": "RH_ID_DET_DESPESAS",
            "pk": {
                "primary": {
                    "ID": {"type": "number"},   
//                    "EMPRESA": {"type": "varchar"},    
//                    "RHID": {"type": "number"},    
//                    "DT_ADMISSAO": {"type": "date"},
                    "NR_LINHA": {"type": "number"}
                }
            },
            "dependsOn": {
                "RH_ID_HDR_DESPESAS": { //External object key mapping( object key : external key)                    
                    "ID": "ID"
                }
            },
            //"initialWhereClause": '',             
            "order_by": "NR_LINHA ASC",
            "recordBundle": 11,
            "pageLenght": 11,
            "scrollY": "356",
            "responsive": true,
            "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
            "inRowDoc": {
                saveAsBlob: true,
                fileNameField: 'LINK_DOC',
                extField: 'BD_MIME',
                pathField: 'LINK_DOC',
                blobField: 'BD_DOC',
                savePath: 'tmp'
            },
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
                    "data": 'ID',
                    "name": 'ID',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
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
                    "visible": false,
                    "type": "hidden"
                }, {
                    "title": "<?php echo mb_strtoupper($ui_id, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_id; ?>", //Editor
                    "data": 'NR_LINHA',
                    "name": 'NR_LINHA',
                    "type": "hidden", //Editor
                    "visible": true, //DataTables
                    "width": "1%"
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_day, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_day; ?>", //Editor
                    "data": 'DT_DESPESA',
                    "name": 'DT_DESPESA',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker"
                    }
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_type, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_type; ?>", //Editor
                    "data": 'TP_DESPESA',
                    "name": 'TP_DESPESA',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'WEB_TIPO_DESPESA',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['WEB_TIPO_DESPESA'], {'RV_LOW_VALUE': val});
                            try {
                                return val == null ? null : o['RV_MEANING'];
                            } catch (e) {
                                return '<span class="label label-danger"> Value [ ' + val + ' ] NOT DEFINED' + '</span>';
                            }
                        }
                        return val;
                    }    
                }, {
                    "responsivePriority": 4,
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
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_MOEDA',
                    "name": 'CD_MOEDA',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables 
                }, {
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_currency, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_currency; ?>",
                    "data": 'DSP_MOEDA',
                    "name": 'DSP_MOEDA',
                    "type": "select",
                    "className": "none visibleColumn",
                    "renew": true, 
                    "width": "1%",
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
                    "title": "<?php echo mb_strtoupper($ui_exchange, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_exchange; ?>", //Editor
                    "data": 'CAMBIO',
                    "name": 'CAMBIO',
                    "className": "none right visibleColumn",    
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'PRECO_DENOM',
                    "name": 'PRECO_DENOM',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables 
                }, {
                    "title": "<?php echo mb_strtoupper($ui_countervalue, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_countervalue; ?>", //Editor
                    "data": 'VALOR_DENOM',
                    "name": 'VALOR_DENOM',
                    "className": "none right visibleColumn",      
                }, {
                    "responsivePriority": 9,
                    "title": "<?php echo mb_strtoupper($ui_motif, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_motif; ?>", //Editor
                    "data": 'MOTIVO',
                    "name": 'MOTIVO',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'WEB_MOTIVO_DESPESA',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['WEB_MOTIVO_DESPESA'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }
                }, {
                    "responsivePriority": 8,
                    "title": "<?php echo mb_strtoupper($ui_state, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_state; ?>", //Editor
                    "data": 'ESTADO',
                    "name": 'ESTADO',
                    "type": "select",
                    "def": "A",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'RH_ID_DET_DESPESAS.ESTADO',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['RH_ID_DET_DESPESAS.ESTADO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
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
                    }                    
                }, {
                    "title": "<?php echo mb_strtoupper($ui_internal_reference_short, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_internal_reference_short; ?>", //Editor
                    "data": 'REFERENCIA_INTERNA',
                    "name": 'REFERENCIA_INTERNA',
                    "className": "none visibleColumn",                    

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
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_year, 'UTF-8'); ?>" + "</span>", //Datatables
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_year; ?>" + "</span>", //Editor
                    "data": 'ANO',
                    "name": 'ANO',
                    "className": "none right visibleColumn",
                    "type": "readonly"
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_month, 'UTF-8'); ?>" + "</span>", //Datatables
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_month; ?>" + "</span>", //Editor
                    "data": 'MES',
                    "name": 'MES',
                    "className": "none right visibleColumn",
                    "type": "readonly"
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_period, 'UTF-8'); ?>" + "</span>", //Datatables
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_period; ?>" + "</span>", //Editor
                    "data": 'ID_PERIODO',
                    "name": 'ID_PERIODO',
                    "className": "none right visibleColumn",
                    "type": "readonly"
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_RUBRICA',
                    "name": 'CD_RUBRICA',                    
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
                        "dependent-group": "RUBRICAS",
                        "dependent-level": 1,
                        "data-db-name": "A.CD_RUBRICA",
                        "distribute-value": "RH_RUBRICA_FERIAS",
                        "decodeFromTable": "RH_DEF_RUBRICAS A",  //TO CHANGE ON QUAD-HCM
                        "desigColumn": "A.DSP_RUBRICA", 
                        "orderBy": "A.DSP_RUBRICA",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": " AND A.ACTIVO = 'S'", //On-New-Record
                            "edit": " AND A.ACTIVO = 'S' ", //On-Edit-Record
                        }                                
                    }
                }, {
                    "responsivePriority": 9,
                    "title": "<?php echo mb_strtoupper($ui_document_short, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_document_short; ?>", //Editor
                    "data": 'LINK_DOC',
                    "name": 'LINK_DOC',
                    "className": "",
                    "type": "hidden",
                    "width": "1%",
                    "attr": {
                        "name": 'LINK_DOC'
                    },
                    "render": function (val, type, row) {                          
                        return RH_ID_DET_DESPESAS.getFileIcon(row['BD_MIME'], JSON.stringify(row));
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_extention, 'UTF-8'); ?>" + '</span>', //Datatables
                    "label": "<?php echo $ui_extention; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_file_format; ?>",
                    "data": 'BD_MIME',
                    "name": 'BD_MIME',
                    "className": "",
                    "type": "hidden",
                    "visible": false,
                    "attr": {
                        "name": 'BD_MIME',
                        "style": "width: 20%;",
                    }                        
                }, {
                    "title": 'BD_DOC',
                    "data": null,
                    "name": 'BD_DOC',
                    "type": "upload",
                    "visible": false
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'SEQ_',
                    "name": 'SEQ_',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables  
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
                        return RH_ID_DET_DESPESAS.crudButtons(conf_EXPENSES['RHID_EXPENSES']["crud"][0], conf_EXPENSES['RHID_EXPENSES']["crud"][1], conf_EXPENSES['RHID_EXPENSES']["crud"][2]);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DT_DESPESA": {
                        required: true,
                         dateISO: true,
                    },
                    "TP_DESPESA": {
                        required: true
                    },
                    "ESTADO": {
                        required: true
                        //maxlength: 25,
                    },
                    "DESCRICAO": {
                        maxlength: 250,
                    },
                    "VALOR": {
                        number: true
                    },
                    "BD_MIME": {
                        maxlength: 10,
                    },
                    "LINK_DOC": {
                        maxlength: 500,
                    },
                    "CAMBIO": {
                        number: true
                    },
                    "PRECO_DENOM": {
                        number: true
                    },
                    "VALOR_DENOM": {
                        number: true
                    },
                    "REFERENCIA_INTERNA": {
                        maxlength: 250,
                    },
                    "ANO": {
                      integer: true,
                      maxlength: 4
                    },
                    "MES": {
                      integer: true,
                      maxlength: 2
                    },
                    "PERIODO": {
                      integer: true,
                      maxlength: 6
                    },
                    "SEQ_": {
                      integer: true,
                      maxlength: 10
                    },
                    /* DEFINED ON TABLE AND NOT MAPPED IN INSTANCE */
                    "QUANTIDADE": {
                        number: true
                    },
                    "PRECO": {
                        number: true
                    },
                    /* END DEFINED ON TABLE AND NOT MAPPED IN INSTANCE */                    
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
//                    "DT_FIM": {
//                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
//                    }
                }
            }
        };
        RH_ID_DET_DESPESAS = new QuadTable();
        RH_ID_DET_DESPESAS.initTable($.extend({}, datatable_instance_defaults, optionRH_ID_DET_DESPESAS));   
        //END Detalhe Despesas

    });
        
</script>
