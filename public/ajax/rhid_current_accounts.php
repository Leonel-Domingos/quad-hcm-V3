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
        <li>PTE: Carregamento dos ficheiros de WORKFLOW -- utilizar go_no_go() de quad_db_lib.php</li>
    </ul>
</div>

<!-- BEGIN Page Content -->
<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <span class="widget-icon"> <i class="far fa-sack-dollar"></i></span>&nbsp;
                <h2><?php echo $ui_current_accounts; ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">                                            
                    <a id="RH_ID_CONTAS_CORRENTES_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                    <table id="RH_ID_CONTAS_CORRENTES" class="table table-bordered table-hover table-striped w-100"></table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <span class="widget-icon"> <i class="far fa-coins"></i></span>&nbsp;
                <h2><?php echo $ui_movements; ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <a id="RH_ID_DET_CONTAS_CORRENTES_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                    <table id="RH_ID_DET_CONTAS_CORRENTES" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->
    
<script>
    pageSetUp();

    var y = "<?php echo @$_SESSION['lang']; ?>", _user = "<?php echo @$_SESSION['utilizador']; ?>", 
        _profile = "<?php echo @$_SESSION['perfil']; ?>", rhid_ = "<?php echo @$_SESSION['rhid'];?>",
        whereClause_ = " A.TP_DESPESA = 'A' "; //GERAIS

    $(document).ready(function () {
        
        /* CRUD + WORKFLOW */
        var nomeForm = '<?php echo json_encode($frm); ?>', continue_,
            tabelas = ['RHID_CURRENT_ACCOUNTS'];
                
        //IF (CRUD + WORKFLOW) problem -> EXIT
        continue_ = go_no_go ('<?php echo json_encode($wkf_error); ?>', _user, _profile);
        
        var conf_CC = JSON.parse('<?php echo $frm_definitions; ?>'),
            empresa_is_shown = true;

        //Valida se TODAS as PROPRIEDADES de Instanciação do interface estão OK.
        //Se não for o caso, sai do interface com ERRO!!
        valid_requirements (nomeForm, conf_CC, tabelas, _user, _profile);

        //IF ACCESS to RH_IDENTIFICACOES is FALSE -> EXIT
        if ( !conf_CC['RHID_CURRENT_ACCOUNTS']["access"] ) {
            $('#left-panel > nav > ul > li.open.active > ul > li:nth-child(1) > a').trigger('click');
            $('#left-panel li > a[href="ajax/rhid_judicial_discounts.php"]').parent('li').remove();
        }
        
        //Contas Correntes
        var optionsRH_ID_CONTAS_CORRENTES = {
            "tableId": "RH_ID_CONTAS_CORRENTES",
            "table": "RH_ID_CONTAS_CORRENTES",
            "workFlow": conf_CC['RHID_CURRENT_ACCOUNTS']["workflow"],
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_judicial_discount; ?>",
            "pk": {
                "primary": {
                    "ID": {"type": "number"},    
                    "EMPRESA": {"type": "varchar"},    
                    "RHID": {"type": "number"},    
                    "DT_ADMISSAO": {"type": "date"}
                }
            },
            "initialWhereClause": whereClause_,
            "detailsObjects": ['RH_ID_DET_CONTAS_CORRENTES'],
            "order_by": "ID DESC",
            "recordBundle": 8,
            "pageLenght": 8,
            "scrollY": "273",
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
                    "data": 'TP_DESPESA',
                    "name": 'TP_DESPESA',
                    "def": 'A', //*** GERAIS ***//
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
                    "title": "<?php echo mb_strtoupper($ui_notification, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_notification; ?>", //Editor
                    "data": 'REF_DOC',
                    "name": 'REF_DOC',
                    "className": "visibleColumn"
                }, {
                    "responsivePriority": 5,
                    "title": "<?php echo mb_strtoupper($ui_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_date; ?>", //Editor
                    "data": 'DT_DOC',
                    "name": 'DT_DOC',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker"
                    }
                }, {
                    "responsivePriority": 6,
                    "title": "<?php echo mb_strtoupper($ui_initial_value, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_initial_value; ?>", //Editor
                    "data": 'VALOR_PAGAR',
                    "name": 'VALOR_PAGAR',
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
                    "responsivePriority": 7,
                    "title": "<?php echo mb_strtoupper($ui_total_discounts, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_total_discounts; ?>", //Editor
                    "data": 'DSP_VALOR_PAGO',
                    "name": 'DSP_VALOR_PAGO',
                    "exclude": true,
                    "className": "right visibleColumn tot_payments"
                }, {
                    "responsivePriority": 8,
                    "title": "<?php echo mb_strtoupper($ui_balance, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_balance; ?>", //Editor
                    "data": 'DSP_SALDO',
                    "name": 'DSP_SALDO',
                    "exclude": true,
                    "className": "right visibleColumn tot_payments"
                }, {
                    "responsivePriority": 9,
                    "title": "<?php echo mb_strtoupper($ui_state, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_state; ?>", //Editor
                    "data": 'ESTADO',
                    "name": 'ESTADO',
                    "type": "select",
                    "def": "A",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'RH_ID_CONTAS_CORRENTES.ESTADO',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['RH_ID_CONTAS_CORRENTES.ESTADO'], {'RV_LOW_VALUE': val});
                            var dsp = (null ? null : o['RV_MEANING']);
                            if (row['ESTADO'] === 'A') { //Criado
                                return '<span class="label" style="background-color: #3b9ff3;">' + dsp + '</span>';
                            } else if (row['ESTADO'] === 'B') { //Em pagamento
                                return '<span class="label label-info">' + dsp + '</span>';
                            } else if (row['ESTADO'] === 'C') { //Liquidado
                                return '<span class="label label-success">' + dsp + '</span>';
                            } else if (row['ESTADO'] === 'D') { //Suspenso
                                return '<span class="label label-danger">' + dsp + '</span>';
                            }
                        }
                        return val;
                    }
                }, {
                    "responsivePriority": 10,
                    "title": "<?php echo mb_strtoupper($ui_order_nr, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_order_nr; ?>", //Editor
                    "data": 'NR_ORDEM',
                    "name": 'NR_ORDEM',
                    "className": "right visibleColumn",
                }, {
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_PAG',
                    "name": 'DT_INI_PAG',
                    "datatype": 'date',
                    "className": "none visibleColumn",
                    "attr": {
                        "class": "datepicker"
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM_PAG',
                    "name": 'DT_FIM_PAG',
                    "datatype": 'date',
                    "className": "none visibleColumn",
                    "attr": {
                        "class": "datepicker"
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_record_type, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_record_type; ?>", //Editor
                    "data": 'TP_REGISTO',
                    "name": 'TP_REGISTO',
                    "type": "select",
                    "def": "A",
                    "className": "none visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'RH_ID_CONTAS_CORRENTES.TP_REGISTO',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['RH_ID_CONTAS_CORRENTES.TP_REGISTO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_incidence, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_incidence; ?>", //Editor
                    "data": 'BASE_INCID_DESC',
                    "name": 'BASE_INCID_DESC',
                    "type": "select",
                    "className": "none visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'RH_ID_CONTAS_CORRENTES.BASE_INCID_DESC',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            try {
                                var o = _.find(initApp.joinsData['RH_ID_CONTAS_CORRENTES.BASE_INCID_DESC'], {'RV_LOW_VALUE': val});
                                return val == null ? null : o['RV_ABBREVIATION'];
                            } catch (e) {
                                return '<span class="label label-danger"> Value [ ' + val + ' ] NOT DEFINED' + '</span>';
                            }
                        }
                        return val;
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_discount_perc, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_discount_perc; ?>", //Editor
                    "data": 'PERC_DESCONTO',
                    "name": 'PERC_DESCONTO',
                    "className": "none right visibleColumn",
                }, {
                    "title": "<?php echo mb_strtoupper($ui_number_payments, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_number_payments; ?>", //Editor
                    "data": 'NR_PAGAMENTOS',
                    "name": 'NR_PAGAMENTOS',
                    "className": "none right visibleColumn",

                }, {
                    "title": "<?php echo mb_strtoupper($ui_installment, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_installment; ?>", //Editor
                    "data": 'PRESTACAO',
                    "name": 'PRESTACAO',
                    "className": "none right visibleColumn",
                    
                }, {
                    "title": "<?php echo mb_strtoupper($ui_last_payment, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_last_payment; ?>", //Editor
                    "data": 'ACERTO_FINAL',
                    "name": 'ACERTO_FINAL',
                    "className": "none right visibleColumn",
                }, {
                    "title": "<?php echo mb_strtoupper($ui_vacation_allowance_short, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_vacation_allowance_short; ?>", //Editor
                    "data": 'DESC_SFER',
                    "name": 'DESC_SFER',
                    "type": "select",
                    "def": "N",
                    "className": "none visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',
                        "class": "form-control"
                    }                                  
                }, {
                    "title": "<?php echo mb_strtoupper($ui_christmas_allowance_short, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_christmas_allowance_short; ?>", //Editor
                    "data": 'DESC_SNAT',
                    "name": 'DESC_SNAT',
                    "type": "select",
                    "def": "N",
                    "className": "none visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',
                        "class": "form-control"
                    }     
                }, {
                    "title": "<?php echo mb_strtoupper($ui_global, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_global; ?>", //Editor
                    "data": 'DESC_GLOBAL',
                    "name": 'DESC_GLOBAL',
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
                    "data": 'CD_RUBRICA',
                    "name": 'CD_RUBRICA',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables 
                }, {
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_wage_item, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_wage_item; ?>",
                    "data": 'DSP_RUBRICA',
                    "name": 'DSP_RUBRICA',
                    "type": "select",
                    "className": "none visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "RUBRICAS",
                        "dependent-level": 1,
                        "data-db-name": "A.CD_RUBRICA",
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
                    "title": "<?php echo mb_strtoupper($ui_cell, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_cell; ?>", //Editor
                    "data": 'CELL',
                    "name": 'CELL',
                    "className": "none visibleColumn",
                }, {
                    "title": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_addressee, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_addressee, 'UTF-8'); ?>" + "</span>", //Editor
                    "data": '',
                    "name": 'TIT_DESTINATARIO',
                    "type": "readonly",
                    "className": "none",
                    "defaultContent": "", //Must be used on STATIC columns content. On this case classes make there way...
                    "attr": {
                        "style": "display: none;"
                    }                
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_name, 'UTF-8'); ?>" + "</span>", //Datatables
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_name; ?>" + "</span>", //Editor
                    "data": 'NOME',
                    "name": 'NOME',
                    "className": "none visibleColumn"
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_address, 'UTF-8'); ?>" + "</span>", //Datatables
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_address; ?>" + "</span>", //Editor
                    "data": 'MORADA',
                    "name": 'MORADA',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 335px",
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_PAIS',
                    "name": 'CD_PAIS',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables   
                }, {
                    "complexList": true,
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_country, 'UTF-8'); ?>" + "</span>",
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_country; ?>" + "</span>",
                    "data": 'DSP_PAIS',
                    "name": 'DSP_PAIS',
                    "type": "select",
                    "className": "none visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "PAISES",
                        "dependent-level": 1,
                        "data-db-name": "A.CD_PAIS",
                        "decodeFromTable": "DG_PAISES A",  //TO CHANGE ON QUAD-HCM
                        "desigColumn": "A.DSP_PAIS",
                        "orderBy": "A.CD_PAIS",
                        "class": "form-control complexList chosen"
                    }                    
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_tax_office, 'UTF-8'); ?>" + "</span>", //Datatables
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_tax_office; ?>" + "</span>", //Editor
                    "data": 'REPARTICAO_FISCAL',
                    "name": 'REPARTICAO_FISCAL',
                    "type": "select",
                    "className": "none visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_REPARTICAO_FISCAL',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_REPARTICAO_FISCAL'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }                    
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_craft_number, 'UTF-8'); ?>" + "</span>", //Datatables
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_craft_number; ?>" + "</span>", //Editor
                    "data": 'NR_OFICIO',
                    "name": 'NR_OFICIO',
                    "className": "none visibleColumn"                    
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_craft_dt, 'UTF-8'); ?>" + "</span>", //Datatables
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_craft_dt; ?>" + "</span>", //Editor
                    "data": 'DT_OFICIO',
                    "name": 'DT_OFICIO',
                    "datatype": 'date',
                    "className": "none visibleColumn",
                    "attr": {
                        "class": "datepicker"
                    }    
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_iban_short, 'UTF-8'); ?>" + "</span>", //Datatables
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_iban_short; ?>" + "</span>", //Editor
                    "data": 'NIB',
                    "name": 'NIB',
                    "className": "none visibleColumn",
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_control, 'UTF-8'); ?>" + "</span>", //Datatables
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_control; ?>" + "</span>", //Editor
                    "data": 'IBAN_CHK',
                    "name": 'IBAN_CHK',
                    "className": "none visibleColumn",
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_entity, 'UTF-8'); ?>" + "</span>", //Datatables
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_entity; ?>" + "</span>", //Editor
                    "data": 'ENT_PAGAMENTO_SRV',
                    "name": 'ENT_PAGAMENTO_SRV',
                    "className": "none visibleColumn",
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_reference, 'UTF-8'); ?>" + "</span>", //Datatables
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_reference; ?>" + "</span>", //Editor
                    "data": 'REF_PAGAMENTO_SRV',
                    "name": 'REF_PAGAMENTO_SRV',
                    "className": "none visibleColumn",                    
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
                    "title": "<?php echo mb_strtoupper($ui_suspended_dt, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_suspended_dt; ?>", //Editor
                    "data": 'DT_SUSPENSAO',
                    "name": 'DT_SUSPENSAO',
                    "datatype": 'date',
                    "className": "none visibleColumn",
                    "attr": {
                        "class": "datepicker"
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_obs_short, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_obs_short; ?>", //Editor
                    "data": 'OBS',
                    "name": 'OBS',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "style": "max-width: 335px",
                    }                
                }, {
                    "responsivePriority": 11,
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
                        return RH_ID_CONTAS_CORRENTES.getFileIcon(row['BD_MIME'], JSON.stringify(row));
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_extention, 'UTF-8'); ?>" + '</span>', //Datatables
                    "label": "<?php echo $ui_extention; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_file_format; ?>",
                    "data": 'BD_MIME',
                    "name": 'BD_MIME',
                    "className": "",
                    "type": "hidden",
                    "visible": false 
                }, {
                    "title": 'BD_DOC',
                    "data": null,
                    "name": 'BD_DOC',
                    "type": "upload",
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
                        return RH_ID_CONTAS_CORRENTES.crudButtons(conf_CC['RHID_CURRENT_ACCOUNTS']["crud"][0], conf_CC['RHID_CURRENT_ACCOUNTS']["crud"][1], conf_CC['RHID_CURRENT_ACCOUNTS']["crud"][2]);
                    }
                }
            ],
            "rowCallback": function( row, data ) { //EACH ROW BEFORE HTML RENDERING : row -> HTML ELEMENT, data -> OBJECT DATA
                //console.log (data['ID'] + '> ' + data['REGRA_VALIDACAO']);
                if (data['VALOR_PAGAR'] !== '') {
                    var sql_str,
                        t0 = performance.now(),
                        wk = new Worker(pn + "lib/quad/workerRouter.js"),
                        bindArr = [];
                    
                    sql_str = "SELECT SUM(VALOR) TOT_PAGO FROM RH_ID_DET_CONTAS_CORRENTES" +
                                   " WHERE ID = :ID" +
                                   " AND EMPRESA = :EMPRESA" +
                                   " AND RHID = :RHID" +
                                   " AND DT_ADMISSAO = TO_DATE(:DT_ADMISSAO, 'YYYY-MM-DD')";

                    //BIND Variables
                    bindArr.push( {name : "ID", value : data['ID']} );
                    bindArr.push( {name : "EMPRESA", value : data['EMPRESA']} );
                    bindArr.push( {name : "RHID", value : data['RHID']} );
                    bindArr.push( {name : "DT_ADMISSAO", value : data['DT_ADMISSAO']} );
                    
                    var message = {
                            request_id: 'Go_SQL',
                            sql_statement: sql_str,
                            binders: bindArr,
                            defaults: datatable_instance_defaults.pathToSqlFile
                        },
                        mssg = '';
                           
                    wk.postMessage(JSON.stringify(message));
                    wk.onmessage = function (event) {                
                        if (event.data === 'working') {
                            return;
                        } else {
                            var t1 = performance.now(),
                                tmp = millisToMinutesAndSeconds(t1 - t0),
                                perc_pago, perc_saldo;
                            if (event.data.status == 'OK') {
                                var val_pago = parseFloat(event.data.data[0]['TOT_PAGO']),
                                    val_saldo = parseFloat(data['VALOR_PAGAR']) + val_pago;
                                    perc_pago = round( val_pago / parseFloat(data['VALOR_PAGAR'])*100 ,0); //Math.abs( round( val_pago / parseFloat(data['VALOR_PAGAR'])*100 ,0) );
                                    
                                    if (perc_pago ) {
                                        perc_pago = '&nbsp;<span class="label label-light-blue">' + perc_pago + '%</span>';
                                    } else {
                                        per_pago = '';
                                    }
//                                    perc_pago = '&nbsp;<sup><span class="label label-success">' + perc_pago + '</span></sup>';
//                                $('td:eq(7)', row).html( val_pago );
//                                $('td:eq(8)', row).html( val_saldo );

                                $('td:eq(7)', row).html( renderNumber(val_pago, ',', '.', 2, '', ' €') + perc_pago);
                                $('td:eq(8)', row).html( renderNumber(val_saldo, ',', '.', 2, '', ' €'));
                            }
                        }                    
                    }

                }
            },
            "validations": {
                "rules": {
                    "DSP_EMPRESA": {
                        required: true
                    },
                    "DSP_NOME": {
                        required: true
                    },
                    "REF_DOC": {
                        maxlength: 100
                    },
                    "DT_DOC": {
                         dateISO: true,
                    },
                    "VALOR_PAGAR": {
                        number: true
                    },
                    "TP_DESPESA": {
                        required: true
                    },
                    "ESTADO": {
                        required: true
                    },
                    "NR_ORDEM": {
                        integer: true,
                        maxlength: 10
                    },
                    "DT_INI_PAG": {
                        dateISO: true
                    },
                    "DT_FIM_PAG": {
                        dateISO: true,
                        dateEqOrNextThan: 'DT_INI_PAG',
                    },
                    "TP_REGISTO": {
                        required: true
                    },
                    "PERC_DESCONTO": {
                        number: true
                    },
                    "NR_PAGAMENTOS": {
                        integer: true,
                        maxlength: 10
                    },
                    "PRESTACAO": {
                        number: true
                    },
                    "ACERTO_FINAL": {
                        number: true
                    },
                    "DESC_SFER": {
                        required: false
                    },
                    "DESC_SNAT": {
                        required: false
                    },
                    "DESC_GLOBAL": {
                        required: false
                    },
                    "CELL": {
                        maxlength: 4
                    },
                    "NOME": {
                        maxlength: 100
                    },
                    "MORADA": {
                        maxlength: 1000
                    },
                    "NR_OFICIO": {
                        maxlength: 100
                    },
                    "DT_OFICIO": {
                        dateISO: true
                    },
                    "NIB": {
                        maxlength: 30
                    },
                    "IBAN_CHK": {
                        maxlength: 2
                    },
                    "ENT_PAGAMENTO_SRV": {
                        maxlength: 100
                    },
                    "REF_PAGAMENTO_SRV": {
                        maxlength: 100
                    },
                    "DT_SUSPENSAO": {
                        dateISO: true
                    },
                    "OBS": {
                        maxlength: 240
                    },
                    /* DEFINED ON TABLE AND NOT MAPPED IN INSTANCE */
                    "ANO_RN": {
                        integer: true,
                        maxlength: 4
                    },
                    "MES_RN": {
                        number: true,
                        maxlength: 2
                    },
                    "VALOR_PAGAR_MOV": {
                        number: true
                    },
                    "CAMBIO_MOV": {
                        number: true
                    },
                    "LIM_INF_DJ" : {
                        number: true
                    },
                    /* END DEFINED ON TABLE AND NOT MAPPED IN INSTANCE */                    
                },
                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                "messages": {
                    "DT_FIM_PAG": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        RH_ID_CONTAS_CORRENTES = new QuadTable();
        RH_ID_CONTAS_CORRENTES.initTable($.extend({}, datatable_instance_defaults, optionsRH_ID_CONTAS_CORRENTES));
        //END Contas Correntes
        
        //Detalhes
        var optionRH_ID_DET_CONTAS_CORRENTES = {
            "tableId": "RH_ID_DET_CONTAS_CORRENTES",
            "table": "RH_ID_DET_CONTAS_CORRENTES",
            "pk": {
                "primary": {
                    "ID": {"type": "number"},    
                    "EMPRESA": {"type": "varchar"},    
                    "RHID": {"type": "number"},    
                    "DT_ADMISSAO": {"type": "date"},
                    "SEQ": {"type": "number"}
                }
            },

            //"initialWhereClause": '',             
            "order_by": "SEQ DESC",
            "recordBundle": 15,
            "pageLenght": 15,
            "scrollY": "351",
            "responsive": true,
            "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
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
                    "data": 'SEQ',
                    "name": 'SEQ',
                    "type": "hidden", //Editor
                    "visible": true, //DataTables
                    "width": "1%",
                    "type": "readonly"
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_year, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_year; ?>", //Editor
                    "data": 'ANO',
                    "name": 'ANO',
                    "className": "right visibleColumn",
                    "type": "readonly"
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_month, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_month; ?>", //Editor
                    "data": 'MES',
                    "name": 'MES',
                    "className": "right visibleColumn",
                    "type": "readonly"
                }, {
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_period, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_period; ?>", //Editor
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
                    "responsivePriority": 5,
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
                    "responsivePriority": 6,
                    "title": "<?php echo mb_strtoupper($ui_type, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_type; ?>", //Editor
                    "data": 'TP_MOVIMENTO',
                    "name": 'TP_MOVIMENTO',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_CREDITO_DEBITO',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_CREDITO_DEBITO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_ABBREVIATION'];
                        }
                        return val;
                    }    
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
                    "title": "<?php echo mb_strtoupper($ui_exchange, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_exchange; ?>", //Editor
                    "data": 'CAMBIO_MOV',
                    "name": 'CAMBIO_MOV',
                    "className": "right visibleColumn",
                    //"type": "readonly",
                    "render": function (val, type, row) {
                        if (val) {
                            if (!row['CD_MOEDA']) { //Onde ir buscar a Moeda de Denominação?
                                val = renderNumber(val, ',', '.', 2, '', ' €');
                            } else {
                                val = renderNumber(val, ',', '.', 2, '', ' ' + row['DSP_MOEDA']);
                            }
                        }
                        return val;
                    }           
                }, {
                    "title": "<?php echo mb_strtoupper($ui_countervalue, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_countervalue; ?>", //Editor
                    "data": 'VALOR_MOV',
                    "name": 'VALOR_MOV',
                    "className": "right visibleColumn",
                    //"type": "readonly",
                    "render": function (val, type, row) {
                        if (val) {
                            if (!row['CD_MOEDA']) { //Onde ir buscar a Moeda de Denominação?
                                val = renderNumber(val, ',', '.', 2, '', ' €');
                            } else {
                                val = renderNumber(val, ',', '.', 2, '', ' ' + row['DSP_MOEDA']);
                            }
                        }
                        return val;
                    }           
                }, {
                    "responsivePriority": 6,
                    "title": "<?php echo mb_strtoupper($ui_status, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_status; ?>", //Editor
                    "data": 'ESTADO',
                    "name": 'ESTADO',
                    "type": "select",
                    "def": "A",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'RH_ID_DET_CONTAS_CORRENTES.ESTADO',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['RH_ID_DET_CONTAS_CORRENTES.ESTADO'], {'RV_LOW_VALUE': val});
                            var dsp = (null ? null : o['RV_MEANING']);
                            if (row['ESTADO'] === 'A') { //Criado
                                return '<span class="label" style="background-color: #3b9ff3;">' + dsp + '</span>';
                            } else if (row['ESTADO'] === 'B') { //Integrado
                                return '<span class="label label-success">' + dsp + '</span>';
                            } else if (row['ESTADO'] === 'C') { //Anulado
                                return '<span class="label label-info">' + dsp + '</span>';
                            } else if (row['ESTADO'] === 'D') { //Suspenso
                                return '<span class="label label-danger">' + dsp + '</span>';
                            }
                        }
                        return val;
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
                        return RH_ID_DET_CONTAS_CORRENTES.crudButtons(conf_CC['RHID_CURRENT_ACCOUNTS']["crud"][0], conf_CC['RHID_CURRENT_ACCOUNTS']["crud"][1], conf_CC['RHID_CURRENT_ACCOUNTS']["crud"][2]);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "ANO": {
                        integer: true,
                        maxlength: 4
                    },
                    "MES": {
                        integer: true,
                        maxlength: 2
                    },
                    "ID_PERIODO": {
                        integer: true,
                        maxlength: 10
                    },
                    "TP_MOVIMENTO": {
                        required: true
                    },
                    "VALOR": {
                        required: true,
                        number: true
                    },
                    "ESTADO": {
                        required: true
                    },
                    "OBS": {
                        maxlength: 2000
                    },
                    "VALOR_MOV": {
                        number: true
                    },
                    "CAMBIO_MOV": {
                        number: true
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
        RH_ID_DET_CONTAS_CORRENTES = new QuadTable();
        RH_ID_DET_CONTAS_CORRENTES.initTable($.extend({}, datatable_instance_defaults, optionRH_ID_DET_CONTAS_CORRENTES));   
        //END Detalhes

    });
</script>
