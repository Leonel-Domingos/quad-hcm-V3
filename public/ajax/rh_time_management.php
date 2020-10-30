<?php
    require_once '../init.php';
    $msg = '';
    $timeRules = '';
    $seconds = '';
    /*CRUD + WorkFlow */
    $wkf_error = array();    
    
    //FILENAME :: To compose ERROR available to JS (FASE 2)
    $frm = strtoupper( basename(__FILE__,'.php') );
    //CHECK IF FILE EXISTS AND IS JSON 
    $frm_definitions = go_no_go(__FILE__, $wkf_error, $seconds);
    //echo "<br>". "( $seconds )" . "<br>". $frm_definitions;    

    //PTE: DÁ ERRO AO EXECUTAR
    $timeRules = []; //getTimeManagementRules($msg);
    if ($msg == '') {
        $timeRules = json_encode($timeRules);
    }    
?>
<style>
    .stats-anim {
        display: flex; 
        justify-content: flex-end;
    }
    
    .wkf_info {
        position: relative;
        font-size: 65%;
        padding: 1px 2px;
        top: -0.8em;
        margin-left: 4px;   
    }
    .excludeRowSelect {
        text-align: center;
    }
    .transfAusBh, .transfTsBh {
        width: 20.40px!important
        padding: 1px 4px;
        height: 22px;
    }
    
    .marcacaoReal {
        color: darkgoldenrod!important;
        /*        cursor: context-menu;*/
        border-bottom: 1px dashed darkgoldenrod;        
    }
    
    svg .sunrise {
        font-family: "Font Awesome 5 Pro";
    }
</style>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            
            <div class="panel-hdr">
                <span class="widget-icon"> <i class="far fa-clock"></i></span>&nbsp;
                <h2><?php echo $ui_time_management; ?></h2>
            </div>

            <div class="panel-container show">
                <!-- TOP FILTER OR INSTANCE -->
                <div class="panel-content qvh-13">
                    <form id="rhidTMFilter">
                        <div class="form-row mb-3">
                            <div class="col-md-4 form-group">
                                <label class="form-label required" for="xt_RHID"><?php echo $ui_rhid; ?></label>
                                <select name="RHID" id="xt_RHID" class="form-control required chosen" data-placeholder=" "></select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="form-label required" for="xt_EMPRESA"><?php echo $ui_company; ?></label>
                                <select name="EMPRESA" id="xt_EMPRESA" class="form-control required chosen" data-placeholder=" "></select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="form-label" for="xt_DT_ADMISSAO"><?php echo $ui_dt_admission; ?></label>
                                <select name="DT_ADMISSAO" id="xt_DT_ADMISSAO" class="form-control required chosen" data-placeholder=" "></select>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- END TOP FILTER OR INSTANCE -->

                <!-- TABS MENUS -->
                <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-end">
                    <div class="panel-toolbar pr-3 align-self-end">
                        <ul id="demo_panel-tabs" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#Tab1" role="tab" aria-selected="true"><?php echo $ui_absences; ?> </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#Tab2" role="tab" aria-selected="true"><?php echo $ui_adaptability; ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#Tab3" role="tab" aria-selected="true"><?php echo $ui_overtime_work; ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#Tab4" role="tab" aria-selected="true"><?php echo $ui_vacation; ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#Tab5" role="tab" aria-selected="true"><?php echo $ui_compensatory_rest; ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#Tab6" role="tab" aria-selected="true"><?php echo $ui_time_shedule_exchanges; ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#Tab7" role="tab" aria-selected="true"><?php echo $ui_attendance_registry; ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#Tab8" role="tab" aria-selected="true"><?php echo $ui_time_attendance; ?></a>
                            </li>
                        </ul>
                    </div>                    
                </div>
                <!-- END TABS MENU -->

                <!-- TABS CONTENT -->
                <div class="panel-container show">
                    <div class="panel-content">

                        <div class="tab-content">

                            <div class="tab-pane fade active show" id="Tab1" role="tabpanel">
                                <a id="RH_ID_AUSENCIAS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                <table id="RH_ID_AUSENCIAS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            </div>

                            <div class="tab-pane fade" id="Tab2" role="tabpanel">
                                <div class="row inner">
                                    <div id="AdaptabilidadeResume" class="col-sm-12 mb-3 hide stats-anim">
                                    </div>                                                                        
                                </div> 
                                <div>
                                    <a id="RH_ID_DET_ADAPTABILIDADES_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                    <table id="RH_ID_DET_ADAPTABILIDADES" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="Tab3" role="tabpanel">
                                <div class="row inner">
                                    <div id="TSResume" class="col-sm-12 mb-3 hide stats-anim">
                                    </div>
                                </div> 
                                <div>
                                    <a id="RH_ID_TS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                    <table id="RH_ID_TS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="Tab4" role="tabpanel">
                                <div class="row inner">
                                    <div id="FeriasResume" class="col-sm-12 mb-3 hide stats-anim">
                                    </div>
                                </div> 
                                <div>
                                    <a id="RH_ID_FERIAS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                    <table id="RH_ID_FERIAS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="Tab5" role="tabpanel">
                                <div class="row inner">
                                    <div id="DCResume" class="col-sm-12 mb-3 hide stats-anim">
                                        TO DO: Statistics
                                    </div>
                                </div> 
                                <div>
                                    <a id="RH_ID_DC_DEBITOS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                    <table id="RH_ID_DC_DEBITOS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                </div>
                            </div>
                            
                            <div class="tab-pane fade" id="Tab6" role="tabpanel">
                                <a id="RH_ID_ESCALAS_HORARIAS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                <table id="RH_ID_ESCALAS_HORARIAS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            </div>
                            
                            <div class="tab-pane fade" id="Tab7" role="tabpanel">
                                <a id="RH_ID_MARCACOES_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                <table id="RH_ID_MARCACOES" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                            </div>
                            
                            <div class="tab-pane fade" id="Tab8" role="tabpanel">
                                <a id="RH_ID_HDR_PONTO_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                <table id="RH_ID_HDR_PONTO" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                
                                <div id="horarioDiarioInfo" style="opacity:1.0;">
                                    <div id="DSP_HOR_DIARIO" style="display:none;">

                                        <div id="svg-0" style="margin-top: 8px;margin-bottom: 5px !important;width:100%;display: inline-table;border: 1px solid gainsboro;border-radius: 15px;padding: 18px 0px 45px 31px;">       
                                            <svg id="schedule_1" xmlns="https://www.w3.org/2000/svg" style="overflow: inherit;height: auto;width: 100%;margin-bottom: 15px;" viewBox="0 0 1055 150">
                                            </svg>    
                                        </div>                                                                    
                                    </div>  
                                </div>
                                
                                <div class="row mt-4 RH_DET_PONTOS">
                                    <div class="col-xl-12 col-md-10 col-md-offset-1 RH_DET_PONTOS">
                                        <div id="panel-8-1" class="panel">
                                            <div class="panel-hdr">
                                                <span class="widget-icon"> <i class="far fa-user-clock"></i></span>&nbsp;
                                                <h2><?php echo $ui_details; ?></h2>
                                            </div>
                                            <div class="panel-container show">
                                                <div class="panel-content">
                                                    <a id="RH_DET_PONTOS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                    <table id="RH_DET_PONTOS" class="table table-bordered table-hover table-striped w-100"></table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                  
                            </div>                            
                        </div>
                    </div>
                </div>
                <!-- TABS CONTENT -->

            </div>
        </div>
    </div>
</div>

<script>
    //CHOSEN DOCS :: https://harvesthq.github.io/chosen/options.html#triggerable-events
    //SIZES RESPONSIVE:: https://desenvolvimentoparaweb.com/css/unidades-css-rem-vh-vw-vmin-vmax-ex-ch/
    pageSetUp();
    var y = "<?php echo @$_SESSION['lang']; ?>", _rhid = "<?php echo @$_SESSION['rhid']; ?>", _user = "<?php echo @$_SESSION['id']; ?>", _profile = "<?php echo @$_SESSION['id_perfil']; ?>",
        hierarquia = "<?php echo @$_SESSION['hierarquia']; ?>", user_id = "<?php echo @$_SESSION['id']; ?>", _rhid_delegado = "<?php echo @$_SESSION['rhid_delegado']; ?>", filter_where = '',
        php_error = "<?php echo $msg; ?>",        
        //PORTAL CONFIG
        portal = true,
        //COULDN'T SOLVE ADDING to CLASSNAME (should by explicit with all alternatives in distinct variables TO distinct columns: , "exportable": " visibleColumn"},
        justBackOffice_COL = (portal ? {"type": "hidden", "visible": false} : {"type": "text", "visible": true}),
        justSelfService_DB = (portal ? " AND A.PORTAL = 'S' " : ""),
        nomeForm = '<?php echo json_encode($frm); ?>', continue_;

    var data = JSON.stringify({"scope": "filter_time_management","lang": y, "perfil": _profile, "rhid": _rhid, "user": user_id, "hierarquia": hierarquia, "rhid_delegado": _rhid_delegado});   
    
    filter_where = getFilterCondition (data);

    //PHP ERROR :: EXIT 
    if (php_error) {
        quad_notification_clear();
        quad_notification({
            type: "error",
            title: 'PHP Error from getTimeManagementRules()',
            content: php_error,
        });
        $('#left-panel > nav > ul > li.open.active > ul > li:nth-child(1) > a').trigger('click');        
    }
    
    continue_ = go_no_go ('<?php echo json_encode($wkf_error); ?>', _user, _profile); //IF (CRUD + WORKFLOW) problem -> EXIT
    
    var pagefunction = function () {
        var rules_TM = JSON.parse('<?php echo $timeRules; ?>'),
            rhid_FeriasAno = {};
        //console.log(rules_TM);        
        /*
        ID_MODULO   DESCRIÇÃO
        ---------   ------------------------
        5           Ausências
        6           Férias
        15          Adaptabilidade
        3           Trabalho Suplementar
        18          Ponto
        4           Descanso Compensatório
        13          Trocas Horário
        10          Escalas Horárias
        */

        //Control to avoid calling instances 2 times (because DT_ADMISSION triggers 2 times if only one option is available)
        var cnt = 0;

        //Clean Horário Diário Graph
        function cleanSheduleGraph() {
            $('#schedule_1').html('');
            $('#horarioDiarioInfo').hide('slow');
        }

        //Tables
        if (1 === 1) {
            var conf_TM = JSON.parse('<?php echo $frm_definitions; ?>');
            //Valida se TODAS as PROPRIEDADES de Instanciação do interface estão OK.
            //Se não for o caso, sai do interface com ERRO!!
            valid_requirements (nomeForm, conf_TM, Object.keys(conf_TM), _user, _profile);

            //IF ACCESS to "TIME MANAGEMENT" is FALSE -> EXIT
            if ( !conf_TM['RH_ID_FERIAS']["access"] && !conf_TM['RH_ID_AUSENCIAS']["access"] && !conf_TM['RH_ID_DET_ADAPTABILIDADES']["access"] && 
                 !conf_TM['RH_ID_TS_HV']["access"] && !conf_TM['RH_ID_DC_DEBITOS']["access"] && !conf_TM['RH_ID_MARCACOES']["access"] && 
                 !conf_TM['RH_ID_ESCALAS_HORARIAS']["access"]) {
                $('#left-panel > nav > ul > li.open.active > ul > li:nth-child(1) > a').trigger('click');
                $('#left-panel li > a[href="ajax/rh_time_management.php"]').parent('li').remove();
            }   
            
            //Ausências :: ID_MODULO = 5 :: TODO STATISTICS ON footerCallback ??!!
            if ( conf_TM['RH_ID_AUSENCIAS']["access"] ) {
                var optionRH_ID_AUSENCIAS = {
                    "tableId": "RH_ID_AUSENCIAS",
                    "table": "RH_ID_AUSENCIAS",
                    "workFlow":conf_TM['RH_ID_AUSENCIAS']["workflow"],
                    "crud": conf_TM['RH_ID_AUSENCIAS']["crud"],//create,update,delete
                    "pk": {
                        "primary": {
                            "EMPRESA": {"type": "varchar"},
                            "RHID": {"type": "number"},
                            "DT_ADMISSAO": {"type": "date"},
                            "TIPO_REGISTO": {"type": "varchar"},
                            "DT_INI": {"type": "date"},
                            //Estão comentados para permitir (nos vários cenários) o UPDATE
                            //"CD_AUSENCIA": {"type": "varchar"},
                            //"DT_FIM": {"type": "date"}
                        }
                    },
                    "on_pre_submit": "RH_ID_AUSENCIAS",
                    "externalFilter": {
                        "templateMulti": {
                            "selector": "#rhidTMFilter",
                            "mandatory": ['RHID', 'EMPRESA', 'DT_ADMISSAO'],
                            "optional": ['']
                        }
                    },
                    //"detailsObjects": ['RH_ID_EMPRESAS_CONTINUED'],
                    //"initialWhereClause": "",
                    "order_by": "DT_INI DESC",
                    "recordBundle": 9,
                    "pageLenght": 9,
                    "scrollY": "368",
                    "responsive": true,
                    "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
                    "inRowDoc": {
                        "saveAsBlob": true, //BLOB
                        "blobField": 'BD_DOC', //DB COLUMN BLOB                    
                        "pathField": 'LINK_DOC', //PATH ON FILESYSTEM
                        "fileNameField": 'LINK_DOC', //FILENAME ON FILESYSTEM
                        "extField": 'BD_MIME', //MIME
                        "savePath": 'tmp' //FILE
                        },
                    "tableCols": [
                        {
                            "responsivePriority": 1,
                            "data": null,
                            "className": "control toBottom toCenter",
                            "width": "1%",
                            "defaultContent": ''
                        }, {
                            "title": "RHID", //Datatables
                            "label": "RHID", //Editor
                            "data": 'RHID',
                            "name": 'RHID',
                            "type": "hidden",
                            "visible": false,
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
                            "data": 'DT_ADMISSAO',
                            "name": 'DT_ADMISSAO',
                            "type": "hidden",
                            "visible": false,
                            "className": "",
                            "datatype": "date"
                        }, {
                            "title": "", //Datatables
                            "label": "", //Editor
                            "data": 'CD_AUSENCIA',
                            "name": 'CD_AUSENCIA',
                            "type": "hidden",
                            "visible": false,
                            "className": "",
                        }, {
                            "responsivePriority": 2,
                            "title": "<?php echo mb_strtoupper($ui_type, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_type; ?>", //Editor
                            "data": 'TIPO_REGISTO',
                            "name": 'TIPO_REGISTO',
                            "type": "select",
                            "def": "A",
                            "className": "visibleColumn",
                            "attr": {
                                "domain-list": true,
                                "dependent-group": 'RH_ID_AUSENCIAS.TIPO_REGISTO',
                                "class": "form-control chosen",
                            },
                            "render": function (val, type, row) {
                                if (val != null) {
                                    var o = _.find(initApp.joinsData['RH_ID_AUSENCIAS.TIPO_REGISTO'], {'RV_LOW_VALUE': val});
                                    return val == null ? null : o['RV_MEANING'];
                                }
                                return val;
                            }
                        }, {
                            "title": "", //Datatables
                            "label": "", //Editor
                            "data": 'ESTADO',
                            "name": 'ESTADO',
                            "type": "hidden",
                            "visible": false,
                            "className": "",
                        }, {
                            "responsivePriority": 3,
                            "complexList": true,
                            "title": "<?php echo mb_strtoupper($ui_status, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_status; ?>", //Editor
                            "data": 'DSP_ESTADO',
                            "name": 'DSP_ESTADO',
                            "type": "select",
                            "def": "A",
                            "className": "visibleColumn",                            
                            "attr": {
                                "dependent-group": "AUSENCIA_ESTADO",
                                "dependent-level": 1,
                                "data-db-name": "A.RV_LOW_VALUE",
                                "distribute-value": "ESTADO",
                                "decodeFromTable": "CG_REF_CODES A",
                                "desigColumn": "A.RV_MEANING",
                                "whereClause": " AND A.RV_DOMAIN = 'WEB_RH_AUSENCIAS.ESTADO'",
                                "orderBy": "A.RV_LOW_VALUE",
                                "class": "form-control complexList chosen",
                                "filter": {
                                    "create": " AND A.RV_LOW_VALUE IN ('A', 'B')", //On-New-Record
                                    "edit": " AND A.RV_LOW_VALUE IN ('A', 'B')", //On-Edit-Record
                                }
                            }
                        }, {
                            "responsivePriority": 4,
                            "complexList": true,
                            "title": "<?php echo mb_strtoupper($ui_absence, 'UTF-8'); ?>",
                            "label": "<?php echo $ui_absence; ?>",
                            "data": 'DSP_AUSENCIA',
                            "name": 'DSP_AUSENCIA',
                            "type": "select",
                            "className": "visibleColumn",
                            //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                            "attr": {
                                "dependent-group": "AUSENCIAS",
                                "dependent-level": 1,
                                "data-db-name": "A.CD_AUSENCIA",
                                "decodeFromTable": "RH_DEF_AUSENCIAS A", //TO CHANGE ON QUAD-HCM
                                "desigColumn": "CONCAT(CONCAT(A.CD_AUSENCIA,'-'), A.DSP_AUSENCIA)",
                                "otherValues": "A.UNIDADE_LIMITES@A.INCAPACIDADE",
                                "orderBy": "A.CD_AUSENCIA",
                                "class": "form-control complexList chosen",
                                "filter": {
                                    "create": " AND A.ACTIVO = 'S'" + justSelfService_DB, //On-New-Record
                                    "edit": " AND A.ACTIVO = 'S'" + justSelfService_DB, //On-Edit-Record
                                }
                            }
                        }, {
                            "responsivePriority": 5,
                            "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_begin_date; ?>", //Editor
                            "data": 'DT_INI',
                            "name": 'DT_INI',
                            //"def": hoje('minutes'),
                            "datatype": 'datetimeShort', // datetime OR datetimeShort OR datetime
                            "className": "visibleColumn",
                            "attr": {
                                "autocomplete": "nope",
                                //"class": "dateTimePickerShort minutes" //HACK to get INICIO HORARIO ESPERADO NO DIA
                                "class": "datepicker minutes" //(.datepicker OR .dateTimePickerShort OR .dateTimePicker) AND (.minutes OR .seconds for CSS format width)
                            }
                        }, {
                            "responsivePriority": 6,
                            "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_end_date; ?>", //Editor
                            "data": 'DT_FIM',
                            "name": 'DT_FIM',
                            "datatype": 'datetimeShort', // datetime OR datetimeShort OR datetime
                            "className": "visibleColumn",
                            "attr": {
                                "autocomplete": "nope",
                                //"class": "dateTimePickerShort minutes" //HACK to get FIM HORARIO ESPERADO NO DIA
                                "class": "datepicker minutes" //(.datepicker OR .dateTimePickerShort OR .dateTimePicker) AND (.minutes OR .seconds for CSS format width)
                            }
                        }, {
                            "responsivePriority": 7,
                            "title": "<?php echo mb_strtoupper($ui_duration, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_duration; ?>", //Editor
                            "data": '',
                            "name": 'DSP_DURACAO',
                            "type": "hidden",
                            "className": "",
                            "render": function (val, type, row) {                                
                                //RENDER COMPLEXLIST & DOMAIN
                                var lst = initApp.joinsComplexData["CD_AUSENCIA__RH_DEF_AUSENCIAS__CONCAT(CONCAT(CD_AUSENCIA,'-'), DSP_AUSENCIA)__CD_AUSENCIA"];
                                var res = '', unid = '', dsp_unid = '';
                                try {
                                    res = _.find( lst, {VAL: row['CD_AUSENCIA']} );
                                    unid_ = res["OTHERVALUES"].split('@')[0]; //UNIDADE_LIMITES@INCAPACIDADE 
                                    dsp_unid = _.find( initApp.joinsData["RH_DEF_AUSENCIAS.UNIDADE_LIMITES"], {"RV_LOW_VALUE": unid_} )["RV_ABBREVIATION"];
                                    
                                    if (unid_ === 'C') { //Calendário
                                        return row['NR_CALENDARIO'] ? (row['NR_CALENDARIO'] + ' ' + dsp_unid) : dsp_unid;
                                    } else if (unid_ === 'H') {
                                        return row['NR_MINUTOS'] ? (row['NR_MINUTOS'] + ' ' + dsp_unid) : dsp_unid;
                                    } else if (unid_ === 'U') {
                                        return row['NR_UTEIS'] ? (row['NR_UTEIS'] + ' ' + dsp_unid) : dsp_unid;
                                    }
                                } catch(e) {
                                    null;
                                }
                                return '';
                            }
                        }, {
                            "title": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_work_days_short, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                            "label": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_work_days_short, 'UTF-8'); ?>" + "</span>", //Editor
                            "data": '',
                            "name": 'TIT_DAYS',
                            "type": "readonly",
                            "className": "none",
                            "defaultContent": "", //Must be used on STATIC columns content. On this case classes make there way...
                            "attr": {
                                "style": "display: none;"
                            }
                        }, {
                            "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_work_days, 'UTF-8'); ?>" + "</span>", //Datatables
                            "label": "<span class='quadSubTitle'>" + "<?php echo $ui_work_days; ?>" + "</span>", //Editor
                            "data": 'NR_UTEIS',
                            "name": 'NR_UTEIS',
                            "className": "none editorSubTitle visibleColumn right",
                            "attr": {
                                "disabled": true, //Permite inibir o campo no Editor
                                "class": "form-control toRight",
                                "style": "width: 30%;"
                            }
                        }, {
                            "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_calendar_days_short, 'UTF-8'); ?>" + "</span>", //Datatables
                            "label": "<span class='quadSubTitle'>" + "<?php echo $ui_calendar_days_short; ?>" + "</span>", //Editor
                            "data": 'NR_CALENDARIO',
                            "name": 'NR_CALENDARIO',
                            "className": "none editorSubTitle visibleColumn right",
                            "attr": {
                                "disabled": true, //Permite inibir o campo no Editor
                                "class": "form-control toRight",
                                "style": "width: 30%;"
                            }
                        }, {
                            "title": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_minutes, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                            "label": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_minutes, 'UTF-8'); ?>" + "</span>", //Editor
                            "data": '',
                            "name": 'TIT_MINUTES',
                            "type": "readonly",
                            "className": "none",
                            "defaultContent": "", //Must be used on STATIC columns content. On this case classes make there way...
                            "attr": {
                                "style": "display: none;"
                            }
                        }, {
                            "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_work_minutes, 'UTF-8'); ?>" + "</span>", //Datatables
                            "label": "<span class='quadSubTitle'>" + "<?php echo $ui_work_minutes; ?>" + "</span>", //Editor
                            "data": 'NR_MINUTOS',
                            "name": 'NR_MINUTOS',
                            "className": "none editorSubTitle visibleColumn right",
                            "attr": {
                                "disabled": true, //Permite inibir o campo no Editor
                                "class": "form-control toRight",
                                "style": "width: 30%;"
                            }
                        }, {
                            "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_calendar_minutes, 'UTF-8'); ?>" + "</span>", //Datatables
                            "label": "<span class='quadSubTitle'>" + "<?php echo $ui_calendar_minutes; ?>" + "</span>", //Editor
                            "data": 'MIN_TOTAL',
                            "name": 'MIN_TOTAL',
                            "className": "none editorSubTitle visibleColumn right",
                            "attr": {
                                "disabled": true, //Permite inibir o campo no Editor
                                "class": "form-control toRight",
                                "style": "width: 30%;"
                            }
//                        }, {
//                            "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_night_minutes, 'UTF-8'); ?>" + "</span>", //Datatables
//                            "label": "<span class='quadSubTitle'>" + "<?php echo $ui_night_minutes; ?>" + "</span>", //Editor
//                            "data": 'MIN_NOCT',
//                            "name": 'MIN_NOCT',
//                            "className": "none editorSubTitle visibleColumn right",
//                            "attr": {
//                                "disabled": true, //Permite inibir o campo no Editor
//                                "class": "form-control toRight",
//                                "style": "width: 30%;"
//                            }
                        }, {
                            "title": "<?php echo mb_strtoupper($ui_incapacity, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_incapacity; ?>", //Editor
                            "fieldInfo": "<?php echo $hint_percentage; ?>",
                            "data": 'INCAPACIDADE',
                            "name": 'INCAPACIDADE',
                            "className": "none visibleColumn right",
                            "attr": {
                                "disabled": true, //Permite inibir o campo no Editor
                                "class": "form-control toRight",
                                "style": "width: 15%",
                                "autocomplete": "nope"
                            },
                            "render": function (val, type, row) {
                                if (val != null) {                                    
                                    return val+'%';
                                }
                                return val;
                            }
                        }, {
                            "title": "<?php echo mb_strtoupper($ui_previous_registry, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_previous_registry; ?>", //Editor
                            "data": 'REGISTO_ANTERIOR',
                            "name": 'REGISTO_ANTERIOR',
                            "type": "select",
                            //"def": "N",
                            "className": "none visibleColumn",
                            "attr": {
                                "disabled": true, //Permite inibir o campo no Editor
                                "domain-list": true,
                                "dependent-group": 'DG_SIM_NAO',
                                "class": "form-control",
                                "style": "width: 30%;"
                            },
                            "render": function (val, type, row) {
                                if (val != null) {
                                    var o = _.find(initApp.joinsData['DG_SIM_NAO'], {'RV_LOW_VALUE': val});
                                    return val == null ? null : o['RV_MEANING'];
                                }
                                return val;
                            }
                        }, {
                            "title": "<?php echo mb_strtoupper($ui_next_registry, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_next_registry; ?>", //Editor
                            "data": 'REGISTO_POSTERIOR',
                            "name": 'REGISTO_POSTERIOR',
                            "type": "select",
                            //"def": "N",
                            "className": "none visibleColumn",
                            "attr": {
                                "disabled": true, //Permite inibir o campo no Editor
                                "domain-list": true,
                                "dependent-group": 'DG_SIM_NAO',
                                "class": "form-control",
                                "style": "width: 30%;"
                            },
                            "render": function (val, type, row) {
                                if (val != null) {
                                    var o = _.find(initApp.joinsData['DG_SIM_NAO'], {'RV_LOW_VALUE': val});
                                    return val == null ? null : o['RV_MEANING'];
                                }
                                return val;
                            }
                        }, {
                            "title": "<?php echo mb_strtoupper($ui_integration_dt, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_integration_dt; ?>", //Editor
                            "data": 'DT_INTEGRACAO',
                            "name": 'DT_INTEGRACAO',
                            "datatype": 'datetime', // datetime OR datetimeShort OR datetime
                            "className": "none visibleColumn",
                            "attr": {
                                "disabled": true, //Permite inibir o campo no Editor
                                "class": "dateTimePicker seconds" //(.datepicker OR .dateTimePickerShort OR .dateTimePicker) AND (.minutes OR .seconds for CSS format width)
                            }
                        }, {
                            "title": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_document, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                            "label": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_document, 'UTF-8'); ?>" + "</span>", //Editor
                            "data": '',
                            "name": 'TIT_DOC',
                            "type": "readonly",
                            "className": "none",
                            "defaultContent": "", //Must be used on STATIC columns content. On this case classes make there way...
                            "attr": {
                                "style": "display: none;"
                            }
                        }, {
                            "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_reference, 'UTF-8'); ?>" + "</span>", //Datatables
                            "label": "<span class='quadSubTitle'>" + "<?php echo $ui_reference; ?>" + "</span>", //Editor
                            "data": 'ID_DOC_JUST',
                            "name": 'ID_DOC_JUST',
                            "className": "none editorSubTitle visibleColumn",
                            "attr": {
                                "class": "form-control"
                            }
                        }, {
                            "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_date, 'UTF-8'); ?>" + "</span>", //Datatables
                            "label": "<span class='quadSubTitle'>" + "<?php echo $ui_date; ?>" + "</span>", //Editor
                            "data": 'DT_DOC_JUST',
                            "name": 'DT_DOC_JUST',
                            "datatype": "date",
                            "className": "none editorSubTitle visibleColumn",
                            "attr": {
                                "name": 'ID_DOC_JUST',
                                "class": "form-control datepicker"
                            }
                        }, {
                            "responsivePriority": 7,
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
                                return RH_ID_AUSENCIAS.getFileIcon(row['BD_MIME'], JSON.stringify(row));
                            }
                        }, {
                            "responsivePriority": 8,
                            "title": "<?php echo mb_strtoupper($ui_swift, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_swift; ?>", //Editor
                            "data": "TRANSF_BTN",
                            "data": null,
                            "type": "select",
                            "className": "excludeRowSelect",
                            "width": "1%",
                            "render": function (val, type, row) {
                                var dados = row['EMPRESA']+'@'+row['RHID']+'@'+ row['DT_ADMISSAO']+'@'+ row['CD_AUSENCIA']+'@'+ row['TIPO_REGISTO']+'@'+ row['DT_INI']+'@'+ row['DT_FIM'],
                                    btn = '<button type="button" class="btn btn-xs btn-default btn-icon transfAusBh" data-ref="' + dados + '" title="' + "<?php echo $ui_swift_absent_hb; ?>"+ '"><i class="fas fa-share"></i></button>';
                                return btn;
                            }
                        }, {
                            "title": "<?php echo mb_strtoupper($ui_obs_short, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_obs_short; ?>", //Editor
                            "data": 'OBS',
                            "name": 'OBS',
                            "type": 'textarea', //Editor
                            "className": "none visibleColumn",
                            "attr": {
                                "style": "max-width: 362px;",
                                "class": "form-control"
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
                            "data": null,
                            "name": 'RECORD_HISTORY',
                            "type": "hidden",
                            "className": "none visibleColumn",
                            "render": function (val, type, row) {
                                return tablesRecordHistory(val, type, row);
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
                                return RH_ID_AUSENCIAS.crudButtons(conf_TM['RH_ID_AUSENCIAS']["crud"][0], conf_TM['RH_ID_AUSENCIAS']["crud"][1], conf_TM['RH_ID_AUSENCIAS']["crud"][2]);
                            }
                        }
                    ],
                    "validations": {
                        //debug: true,
                        "rules": {
                            "DSP_ESTADO": {
                                required: true
                            },
                            "DSP_AUSENCIA": {
                                required: true
                            },
                            "TIPO_REGISTO": {
                                required: true
                            },
                            "NR_CALENDARIO": {
                                number: true
                            },
                            "NR_UTEIS": {
                                number: true
                            },
                            "NR_MINUTOS": {
                                number: true
                            },
                            "MIN_TOTAL": {
                                number: true
                            },
//                            "MIN_NOCT": {
//                                number: true
//                            },
                            "INCAPACIDADE": {
                                number: true,
                                min: 0,
                                max: 100
                            },
                            "DT_INI": {
                                required: true,
                                datetimeShort: true
                            },
                            "DT_FIM": {
                                required: true,
                                datetimeShort: true,
                                dateEqOrNextThan: 'DT_INI'
                            },
                            "DT_INTEGRACAO": {
                                dateISO: true
                            },
                            "DT_DOC_JUST": {
                                dateISO: true
                            },
                            "ID_DOC_JUST": {
                                maxlength: 12
                            },
                            "NOME_FICHEIRO": {
                                maxlength: 100
                            },
                            "OBS": {
                                maxlength: 100
                            }
                        },
                        //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                        "messages": {
                            "DT_FIM": {
                                "dateEqOrNextThan": "<?php echo $error_end_dt_greater; ?>",
                                "datetimeShort": "<?php echo $error_invalid_format; ?>",
                            }
                        }
                    }
                };
                RH_ID_AUSENCIAS = new QuadTable();
                RH_ID_AUSENCIAS.initTable($.extend({}, datatable_instance_defaults, optionRH_ID_AUSENCIAS));
            } else {
                //REMOVE HMTL
                $('a[href="#Tab1"]').remove();
                $('#Tab1').remove();
            }
            //END Ausências

            //Adaptabilidade :: ID_MODULO = 15
            if ( conf_TM['RH_ID_DET_ADAPTABILIDADES']["access"] ) {
                var optionRH_ID_DET_ADAPTABILIDADES = {
                    "tableId": "RH_ID_DET_ADAPTABILIDADES",
                    "table": "RH_ID_DET_ADAPTABILIDADES",
                    "workFlow":conf_TM['RH_ID_DET_ADAPTABILIDADES']["workflow"],
                    "crud": conf_TM['RH_ID_DET_ADAPTABILIDADES']["crud"],//create,update,delete                    
                    "pk": {
                        "primary": {
                            "EMPRESA": {"type": "varchar"},
                            "RHID": {"type": "number"},
                            "DT_ADMISSAO": {"type": "date"},
                            "TP_OCORRENCIA": {"type": "varchar"},
                            "DT_INI_DET": {"type": "date"}
                        }
                    },
                    "on_pre_submit": "RH_ID_DET_ADAPTABILIDADES",
                    "externalFilter": {
                        "templateMulti": {
                            "selector": "#rhidTMFilter",
                            "mandatory": ['RHID', 'EMPRESA', 'DT_ADMISSAO'],
                            "optional": ['']
                        }
                    },                    
                    //"detailsObjects": ['RH_ID_EMPRESAS_CONTINUED'],
                    //"initialWhereClause": "",
                    "order_by": "DT_INI_DET DESC",
                    "recordBundle": 9,
                    "pageLenght": 9,
                    "scrollY": "352",
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
                            "title": "RHID", //Datatables
                            "label": "RHID", //Editor
                            "data": "RHID",
                            "name": "RHID",
                            "type": "hidden",
                            "visible": false,
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
                            "data": 'DT_ADMISSAO',
                            "name": 'DT_ADMISSAO',
                            "type": "hidden",
                            "visible": false,
                            "className": "",
                            "datatype": "date"
                        }, {
                            "title": "", //Datatables
                            "label": "", //Editor
                            "data": 'CD_IRCT',
                            "name": 'CD_IRCT',
                            "type": "hidden",
                            "visible": false,
                            "className": "",
                        }, {
                            "title": "", //Datatables
                            "label": "", //Editor
                            "data": 'DT_EFICACIA',
                            "name": 'DT_EFICACIA',
                            "type": "hidden",
                            "visible": false,
                            "className": "",
                            "datatype": "date"
                        }, {
                            "title": "", //Datatables
                            "label": "", //Editor
                            "data": 'DT_INI_RA',
                            "name": 'DT_INI_RA',
                            "type": "hidden",
                            "visible": false,
                            "className": "",
                            "datatype": "date"
                        }, {
                            "title": "", //Datatables
                            "label": "", //Editor
                            "data": 'DT_INI_HDR',
                            "name": 'DT_INI_HDR',
                            "type": "hidden",
                            "visible": false,
                            "className": "",
                            "datatype": "date"
                        }, {
                            "responsivePriority": 2,
                            "title": "<?php echo mb_strtoupper($ui_type, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_type; ?>", //Editor
                            "data": 'TP_OCORRENCIA',
                            "name": 'TP_OCORRENCIA',
                            "type": "select",
                            "className": "visibleColumn",
                            "attr": {
                                "domain-list": true,
                                "dependent-group": 'RH_ID_DET_ADAPTABILIDADES.TP_OCORRENCIA',
                                "class": "form-control chosen"
                            },
                            "render": function (val, type, row) {
                                if (val != null) {
                                    var o = _.find(initApp.joinsData['RH_ID_DET_ADAPTABILIDADES.TP_OCORRENCIA'], {'RV_LOW_VALUE': val});
                                    return val == null ? null : o['RV_MEANING'];
                                }
                                return val;
                            }
                        }, {
                            "responsivePriority": 3,
                            "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_begin_date; ?>", //Editor
                            "data": 'DT_INI_DET',
                            "name": 'DT_INI_DET',
                            //"def": hoje('minutes'),
                            "datatype": 'datetimeShort', // datetime OR datetimeShort OR datetime
                            "className": "visibleColumn",
                            "attr": {
                                "autocomplete": "nope",
                                "class": "dateTimePickerShort minutes" //(.datepicker OR .dateTimePickerShort OR .dateTimePicker) AND (.minutes OR .seconds for CSS format width)
                            }
                        }, {
                            "responsivePriority": 4,
                            "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_end_date; ?>", //Editor
                            "data": 'DT_FIM_DET',
                            "name": 'DT_FIM_DET',
                            "datatype": 'datetimeShort', // datetime OR datetimeShort OR datetime
                            "className": "visibleColumn",
                            "attr": {
                                "autocomplete": "nope",
                                "class": "dateTimePickerShort minutes" //(.datepicker OR .dateTimePickerShort OR .dateTimePicker) AND (.minutes OR .seconds for CSS format width)
                            }
                        }, {
                            "responsivePriority": 5,
                            "title": "<?php echo mb_strtoupper($ui_duration, 'UTF-8') . ' <sup> (' . $ui_minutes_short . ') </sup>'; ?>", //Datatables
                            "label": "<?php echo $ui_duration . ' <sup> (' . $ui_minutes_short. ') </sup>'; ?>", //Editor
                            "data": 'DURACAO_MINUTOS',
                            "name": 'DURACAO_MINUTOS',
                            "className": "visibleColumn right",
                            "attr": {
                                "disabled": true, //Permite inibir o campo no Editor
                                "class": "form-control toRight",
                                "style": "width: 30%;"
                            }
                            /*
                             IRCT DECODE INFO ?????
                             TP_DIA
                             ORIGEM
                             MOT_REJ
                             CD_RUBRICA     
                             */
                        }, {
                            "title": "<?php echo mb_strtoupper($ui_payment_dt, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_payment_dt; ?>", //Editor
                            "data": 'DT_PAGAMENTO',
                            "name": 'DT_PAGAMENTO',
                            "datatype": 'datetime', // datetime OR datetimeShort OR datetime
                            "className": "none visibleColumn",
                            "attr": {
                                "disabled": true, //Permite inibir o campo no Editor
                                "class": "dateTimePicker seconds" //(.datepicker OR .dateTimePickerShort OR .dateTimePicker) AND (.minutes OR .seconds for CSS format width)
                            }
                        }, {
                            "title": "<?php echo mb_strtoupper($ui_obs_short, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_obs_short; ?>", //Editor
                            "data": 'OBS',
                            "name": 'OBS',
                            "type": 'textarea', //Editor
                            "className": "none visibleColumn",
                            "attr": {
                                "style": "max-width: 335px;",
                                "class": "form-control"
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
                            "data": null,
                            "name": 'RECORD_HISTORY',
                            "type": "hidden",
                            "className": "none visibleColumn",
                            "render": function (val, type, row) {
                                return tablesRecordHistory(val, type, row);
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
                                return RH_ID_DET_ADAPTABILIDADES.crudButtons(conf_TM['RH_ID_DET_ADAPTABILIDADES']["crud"][0], conf_TM['RH_ID_DET_ADAPTABILIDADES']["crud"][1], conf_TM['RH_ID_DET_ADAPTABILIDADES']["crud"][2]);
                            }
                        }
                    ],
                    buttons: [
                        {
                            "extend": 'excelHtml5', //Reusable PLUG-IN
                            "text": '<i class="fal fa-file-excel fa-lg" aria-hidden="true"></i>',
                            "className": 'btn btn-default btn-icon btn-xs',
                            "titleAttr": "Save as Excel",
                            "action": function (e, dt, button, config) {
                                exportTo(e, dt, button, config, 'excel')
                            }
                        }, {//Seguir em QuadCore.js :: buttonManagerCentralized
                            "text": '<i class="far fa-cloud-upload-alt fa-lg" aria-hidden="true"></i>',
                            "className": 'extraCustom btn btn-default btn-icon btn-xs',
                            "titleAttr": "Upload Adaptabilidade",
                            "action": function (e, dt, button, config) {
                                adaptabilidadeExtra('upload');
                            }
                        }, {//Seguir em QuadCore.js :: buttonManagerCentralized
                            "text": '<i class="far fa-cloud-download-alt fa-lg" aria-hidden="true"></i>',
                            "className": 'extraCustom btn btn-default btn-icon btn-xs',
                            "titleAttr": "Download Template",
                            "action": function (e, dt, button, config) {
                                adaptabilidadeExtra('download');
//                            //dt.ajax.reload();
//                            $("body").css("cursor", "progress");
//                            var o = dt.settings();
//console.log(o);
//                            var obj = window[o[0].nTable.id];
//console.log(obj);
//                            if (dt.data().count() > 0) {
//                                obj.exportData(dt, e, button, config, expTo);
//                            } else {
//                                quad_notification({
//                                    type: "warning",
//                                    title: "<?php echo $ui_export; ?>",
//                                    content: '<i class="fa fa-clock-o"></i>&nbsp;<i>' + "<?php echo $warning_no_data; ?>" + '</i>',
//                                    timeout: 3000
//                                });
//                            }
//                            $("body").css("cursor", "default");                            
                            }
                        }
                    ],
                    footerCallback( tfoot, data, start, end, display ) {
                        //console.log('footer callback');
                        //HACK to run after rendering ENDS
                        setTimeout(function () {
                            console.log('BEGIN Adaptabilidade footer callback');                        
                                getRhidAdaptabilidade();
                            console.log('END Adaptabilidade footer callback');
                        }, 500);
                    },
                    "validations": {
                        "rules": {
                            "TP_OCORRENCIA": {
                                required: true
                            },
                            "DURACAO_MINUTOS": {
                                number: true
                            },
                            "DT_INI_DET": {
                                required: true,
                                datetimeShort: true
                            },
                            "DT_FIM_DET": {
                                datetimeShort: true,
                                dateEqOrNextThan: 'DT_INI_DET'
                            },
                            "DT_PAGAMENTO": {
                                dateISO: true
                            },
                            "OBS": {
                                maxlength: 100
                            }
                        },
                        //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                        "messages": {
                            "DT_FIM_DET": {
                                dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                            }
                        }
                    }
                };
                RH_ID_DET_ADAPTABILIDADES = new QuadTable();
                RH_ID_DET_ADAPTABILIDADES.initTable($.extend({}, datatable_instance_defaults, optionRH_ID_DET_ADAPTABILIDADES));
            } else {
                //REMOVE HMTL
                $('a[href="#Tab2"]').remove();
                $('#Tab2').remove();
            }
            //END Adaptabilidade

            //Trab. Suplementar :: ID_MODULO = 3 :: TODO STATISTICS ON footerCallback ??!!
            if ( conf_TM['RH_ID_TS_HV']["access"] ) {
                var optionRH_ID_TS = {
                    "tableId": "RH_ID_TS",
                    "table": "RH_ID_TS_HV",
                    "workFlow":conf_TM['RH_ID_TS_HV']["workflow"],
                    "crud": conf_TM['RH_ID_TS_HV']["crud"],//create,update,delete                    
                    "pk": {
                        "primary": {
                            "EMPRESA": {"type": "varchar"},
                            "RHID": {"type": "number"},
                            "DT_ADMISSAO": {"type": "date"},
                            "TIPO_REGISTO": {"type": "varchar"},
                            "DT_INI": {"type": "date"},                            
                            //Estão comentados para permitir (nos vários cenários) o UPDATE
                            //"DT_FIM": {"type": "date"}
                        }
                    },
                    "on_pre_submit": "RH_ID_TS_HV",
                    "externalFilter": {
                        "templateMulti": {
                            "selector": "#rhidTMFilter",
                            "mandatory": ['RHID', 'EMPRESA', 'DT_ADMISSAO'],
                            "optional": ['']
                        }
                    },
                    //"detailsObjects": ['RH_ID_EMPRESAS_CONTINUED'],
                    "initialWhereClause": "TIPO_TS_HV = 'A'",
                    "order_by": "DT_INI DESC",
                    "recordBundle": 9,
                    "pageLenght": 9,
                    "scrollY": "352",
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
                            "title": "RHID", //Datatables
                            "label": "RHID", //Editor
                            "data": "RHID",
                            "name": "RHID",
                            "type": "hidden",
                            "visible": false,
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
                            "data": 'DT_ADMISSAO',
                            "name": 'DT_ADMISSAO',
                            "type": "hidden",
                            "visible": false,
                            "className": "",
                            "datatype": "date"

                        }, {
                            "title": "", //Datatables
                            "label": "", //Editor
                            "data": 'TIPO_TS_HV',
                            "name": 'TIPO_TS_HV',
                            "def": "A",
                            "type": "hidden",
                            "visible": false
                        }, {
                            "title": "", //Datatables
                            "label": "", //Editor
                            "data": 'TIPO_REGISTO',
                            "name": 'TIPO_REGISTO',
                            "def": "A",
                            "type": "hidden",
                            "visible": false
                        }, {
                            "responsivePriority": 2,
                            "complexList": true,
                            "title": "<?php echo mb_strtoupper($ui_type, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_type; ?>", //Editor
                            "data": 'DSP_TP_REGISTO',
                            "name": 'DSP_TP_REGISTO',
                            "type": "select",
                            "def": "A",
                            "className": "visibleColumn",
                            "attr": {
                                "dependent-group": "TS_TYPE",
                                "dependent-level": 1,
                                "data-db-name": "A.RV_LOW_VALUE",
                                "distribute-value": "TIPO_REGISTO",
                                "decodeFromTable": "CG_REF_CODES A",
                                "desigColumn": "A.RV_MEANING",
                                "whereClause": " AND A.RV_DOMAIN = 'RH_ID_TS_HV.TIPO_REGISTO'",
                                "orderBy": "A.RV_LOW_VALUE",
                                "class": "form-control complexList chosen",
                                "filter": {
                                    "create": " AND A.RV_LOW_VALUE IN ('A', 'C')", //On-New-Record
                                    "edit": " AND A.RV_LOW_VALUE IN ('A', 'C')", //On-Edit-Record
                                }
                            }
                        }, {
                            "title": "", //Datatables
                            "label": "", //Editor
                            "data": 'ESTADO',
                            "name": 'ESTADO',
                            "type": "hidden",
                            "def": "A",
                            "visible": false,
                            "className": "",
                        }, {
                            "responsivePriority": 3,
                            "complexList": true,
                            "title": "<?php echo mb_strtoupper($ui_status, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_status; ?>", //Editor
                            "data": 'DSP_ESTADO',
                            "name": 'DSP_ESTADO',
                            "type": "select",
                            "def": "A",
                            "className": "visibleColumn",
                            "attr": {
                                "dependent-group": "AUSENCIA_ESTADO",
                                "dependent-level": 1,
                                "data-db-name": "A.RV_LOW_VALUE",
                                "distribute-value": "ESTADO",
                                "decodeFromTable": "CG_REF_CODES A",
                                "desigColumn": "A.RV_MEANING",
                                "whereClause": " AND A.RV_DOMAIN = 'RH_ID_TS_HV.ESTADO'",
                                "orderBy": "A.RV_LOW_VALUE",
                                "class": "form-control complexList chosen",
                                "filter": {
                                    "create": " AND A.RV_LOW_VALUE IN ('A', 'B')", //On-New-Record
                                    "edit": " AND A.RV_LOW_VALUE IN ('A', 'B')", //On-Edit-Record
                                }
                            }
                        }, {
                            "responsivePriority": 3,
                            "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_begin_date; ?>", //Editor
                            "data": 'DT_INI',
                            "name": 'DT_INI',
                            //"def": hoje('minutes'),
                            "datatype": 'datetimeShort', // datetime OR datetimeShort OR datetime
                            "className": "visibleColumn",
                            "attr": {
                                "autocomplete": "nope",
                                "class": "dateTimePickerShort minutes" //(.datepicker OR .dateTimePickerShort OR .dateTimePicker) AND (.minutes OR .seconds for CSS format width)
                            }
                        }, {
                            "responsivePriority": 4,
                            "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_end_date; ?>", //Editor
                            "data": "DT_FIM",
                            "name": "DT_FIM",
                            "datatype": 'datetimeShort', // datetime OR datetimeShort OR datetime
                            "className": "visibleColumn",
                            "attr": {
                                "autocomplete": "nope",
                                "class": "dateTimePickerShort minutes" //(.datepicker OR .dateTimePickerShort OR .dateTimePicker) AND (.minutes OR .seconds for CSS format width)
                            }
                        }, {
                            "responsivePriority": 5,
                            "title": "<?php echo mb_strtoupper($ui_duration, 'UTF-8') . ' <sup> (' . $ui_minutes_short . ') </sup>'; ?>", //Datatables
                            "label": "<?php echo $ui_duration . ' <sup> (' . $ui_minutes_short. ') </sup>'; ?>", //Editor
                            "data": "DURACAO",
                            "name": "DURACAO",
                            "className": "visibleColumn",
                            "visible": true,
                            //"type": "hidden",
                            "className": "visibleColumn right",
                            "attr": {
                                "disabled": true, //Permite inibir o campo no Editor
                                "class": "form-control toRight",
                                "style": "width: 30%;"
                            }
                        }, {
                            "title": "", //Datatables
                            "label": "", //Editor
                            "data": 'CD_MOTIVO_TS_HV',
                            "name": 'CD_MOTIVO_TS_HV',
                            "type": "hidden",
                            "visible": false
                        }, {
                            "responsivePriority": 5,
                            "complexList": true,
                            "title": "<?php echo mb_strtoupper($ui_motif, 'UTF-8'); ?>",
                            "label": "<?php echo $ui_motif; ?>",
                            "data": 'DSP_MOTIVO_TS_HV',
                            "name": 'DSP_MOTIVO_TS_HV',
                            "type": "select",
                            "className": "visibleColumn",
                            //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                            "attr": {
                                "dependent-group": "MOTIVO_TS_HV",
                                "dependent-level": 1,
                                "data-db-name": "A.CD_MOTIVO_TS_HV",
                                "decodeFromTable": "RH_DEF_MOTIVOS_TS_HV A", //TO CHANGE ON QUAD-HCM
                                "desigColumn": "A.DSP_MOTIVO_TS_HV",
                                "orderBy": "A.CD_MOTIVO_TS_HV",
                                "class": "form-control complexList chosen",
                                "filter": {
                                    "create": " AND A.ACTIVO = 'S' AND A.TIPO_TS_HV = 'A'" + justSelfService_DB, //On-New-Record
                                    "edit": " AND A.ACTIVO = 'S' AND A.TIPO_TS_HV = 'A'" + justSelfService_DB, //On-Edit-Record
                                }
                            }
                        }, {
                            "responsivePriority": 6,
                            "title": "<?php echo mb_strtoupper($ui_article, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_article; ?>", //Editor
                            "data": 'ARTIGO_TS',
                            "name": 'ARTIGO_TS',
                            "type": "select",
                            "className": "visibleColumn",
                            "attr": {
                                "domain-list": true,
                                "dependent-group": 'RH_ID_TS_HV.ARTIGO_TS',
                                "class": "form-control chosen"
                            },
                            "render": function (val, type, row) {
                                if (val != null) {
                                    var o = _.find(initApp.joinsData['RH_ID_TS_HV.ARTIGO_TS'], {'RV_LOW_VALUE': val});
                                    return val == null ? null : o['RV_MEANING'];
                                }
                                return val;
                            }
                        }, {
                            "title": "", //Datatables
                            "label": "", //Editor
                            "data": 'CD_ENT_INT',
                            "name": 'CD_ENT_INT',
                            "type": "hidden",
                            "visible": false
                        }, {
                            "responsivePriority": 7,
                            "complexList": true,
                            "title": "<?php echo mb_strtoupper($ui_internal_entity, 'UTF-8'); ?>",
                            "label": "<?php echo $ui_internal_entity; ?>",
                            "data": "DSP_ENT_INT",
                            "name": "DSP_ENT_INT",
                            "className": "visibleColumn",
                            "type": "select",
                            "attr": {
                                "deferred": true,
                                "dependent-group": "ENT_INTERNA",
                                "dependent-level": 1,
                                "data-db-name": 'A.EMPRESA@A.CD_ENT_INT',
                                "distribute-value": 'EMPRESA@CD_ENT_INT',
                                "decodeFromTable": 'DG_ENTIDADES_INTERNAS A',
                                "desigColumn": "CONCAT(CONCAT(A.CD_ENT_INT,'-'),A.DSP_ENT_INT)",
                                'orderBy': 'A.CD_ENT_INT',
                                "class": "form-control complexList chosen",
                                "filter": {
                                    "create": " AND A.EMPRESA = ':EMPRESA'",
                                    "edit": " AND A.EMPRESA = ':EMPRESA' ",
                                }
                            }
                        }, {
                            "title": "<?php echo mb_strtoupper($ui_context_day, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_context_day; ?>", //Editor
                            "data": "DT_CONTEXTO",
                            "name": "DT_CONTEXTO",
                            "datatype": "date",
                            "className": "none visibleColumn",
                            "attr": {
                                "disabled": true,
                                "class": "form-control datepicker"
                            }
                        }, {
                            "title": "<?php echo mb_strtoupper($ui_obs_short, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_obs_short; ?>", //Editor
                            "data": 'OBS',
                            "name": 'OBS',
                            "type": 'textarea', //Editor
                            "className": "none visibleColumn",
                            "attr": {
                                "style": "max-width: 335px;",
                                "class": "form-control"
                            }
                        }, {
                            "title": "<?php echo mb_strtoupper($ui_authorized_by, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_authorized_by; ?>", //Editor
                            "data": 'AUTORIZADOR',
                            "name": 'AUTORIZADOR',
                            "className": "none visibleColumn",
                            "type": justBackOffice_COL['type'],
                            "visible": justBackOffice_COL['visible'],
                            "attr": {
                                "disabled": true,
                                "class": "form-control datepicker"
                            }
                        }, {
                            "title": "<?php echo mb_strtoupper($ui_authorized_dt, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_authorized_dt; ?>", //Editor
                            "data": 'DT_AUTORIZACAO',
                            "name": 'DT_AUTORIZACAO',
                            "className": "none visibleColumn",
                            "type": justBackOffice_COL['type'],
                            "visible": justBackOffice_COL['visible'],
                            "attr": {
                                "disabled": true,
                                "class": "form-control datepicker"
                            }
                            /* FALTAM ESTAS para o Back-Office !!!
                             * -----------------------------------
                             INTEGRADO_DC
                             MAPA_TS
                             CD_TS_HV
                             QTD_HND_1A
                             QTD_HND_SEG
                             QTD_HNN_1A
                             QTD_HNN_SEG
                             QTD_HDD_ATE
                             QTD_HDD_MAIS
                             QTD_HDN_ATE
                             QTD_HDN_MAIS
                             QTD_ALM
                             QTD_JNT
                             QTD_INTERV_DESC
                             QTD_FER
                             QTD_COMPL
                             QTD_OBRIG
                             DT_RESET
                             ARTIGO_TS
                             DT_INTEGRACAO
                             DT_ANULACAO
                             DT_INT_DC
                             QTD_DC
                             REGRA_DC
                             PREMIO_CHAMADA
                             UNIDADE_DC
                             ORIGEM
                             BH_RW
                             BH_QTD
                             */
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
                            "data": null,
                            "name": 'RECORD_HISTORY',
                            "type": "hidden",
                            "className": "none visibleColumn",
                            "render": function (val, type, row) {
                                return tablesRecordHistory(val, type, row);
                            }
                        }, {
                            "responsivePriority": 8,
                            "title": "<?php echo mb_strtoupper($ui_swift, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_swift; ?>", //Editor
                            "data": "TRANSF_BTN",
                            "data": null,
                            "type": "select",
                            "className": "excludeRowSelect",
                            "width": "1%",
                            "render": function (val, type, row) {                                
                                var dados = row['EMPRESA']+'@'+row['RHID']+'@'+ row['DT_ADMISSAO']+'@'+ row['TIPO_REGISTO']+'@'+ row['DT_INI']+'@'+ row['DT_FIM'],
                                    btn = '<button type="button" class="btn btn-xs btn-default btn-icon transfTsBh" data-ref="' + dados + '" title="' + "<?php echo $ui_swift_absent_hb; ?>"+ '"><i class="fas fa-share"></i></button>';
                                return btn;
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
                                return RH_ID_TS.crudButtons(conf_TM['RH_ID_TS_HV']["crud"][0], conf_TM['RH_ID_TS_HV']["crud"][1], conf_TM['RH_ID_TS_HV']["crud"][2]);
                            }
                        }
                    ],
                    footerCallback( tfoot, data, start, end, display ) {
                        //console.log('footer callback');
                        //HACK to run after rendering ENDS
                        setTimeout(function () {
                            getRhidTS();
                        }, 500);
                    },                     

                    "validations": {
                        //debug: true,
                        "rules": {
                            "DSP_TP_REGISTO": {
                                required: true
                            },
                            "DSP_ESTADO": {
                                required: true
                            },
                            "DT_INI": {
                                required: true,
                                datetimeShort: true
                            },
                            "DT_FIM": {
                                datetimeShort: true,
                                dateEqOrNextThan: 'DT_INI'
                            },
                            "DSP_MOTIVO_TS_HV": {
                                required: false
                            },
                            "ARTIGO_TS": {
                                required: false
                            },
                            "OBS": {
                                maxlength: 100
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
                RH_ID_TS = new QuadTable();
                RH_ID_TS.initTable($.extend({}, datatable_instance_defaults, optionRH_ID_TS));
            } else {
                //REMOVE HMTL
                $('a[href="#Tab3"]').remove();
                $('#Tab3').remove();
            }
            //END Trab. Suplementar                        
            
            //Férias :: ID_MODULO = 6
            if ( conf_TM['RH_ID_FERIAS']["access"] ) {
                var optionRH_ID_FERIAS = {
                    "tableId": "RH_ID_FERIAS",
                    "table": "RH_ID_FERIAS",
                    "workFlow":conf_TM['RH_ID_FERIAS']["workflow"],
                    "crud": conf_TM['RH_ID_FERIAS']["crud"],//create,update,delete
                    "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_vacation; ?>",                    
                    "pk": {
                        "primary": {
                            "EMPRESA": {"type": "varchar"},
                            "RHID": {"type": "number"},
                            "DT_ADMISSAO": {"type": "date"},
                            "ANO": {"type": "number"},
                            "DT_INI": {"type": "date"},
                            //Estão comentados para permitir (nos vários cenários) o UPDATE
                            //"DT_FIM": {"type": "date"}

                        }
                    },
                    "on_pre_submit": "RH_ID_FERIAS",
                    "externalFilter": {
                        "templateMulti": {
                            "selector": "#rhidTMFilter",
                            "mandatory": ['RHID', 'EMPRESA', 'DT_ADMISSAO'],
                            "optional": ['']
                        }
                    },
                    //"detailsObjects": ['RH_ID_EMPRESAS_CONTINUED'],
                    //"initialWhereClause": "",
                    "order_by": "DT_INI DESC",
                    "recordBundle": 9,
                    "pageLenght": 9,
                    "scrollY": "352",
                    "responsive": true,
                    "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
//                    "cloneData": true, ?????? PARA QUE SERVE ???????
//                    "inlineOp": {
//                        edit: true,
//                        create: false
//                    },
//AQUI
                    "tableCols": [
                        {
                            "responsivePriority": 1,
                            "data": null,
                            "className": "control toBottom toCenter",
                            "width": "1%",
                            "defaultContent": ''
                        }, {
                            "title": "RHID", //Datatables
                            "label": "RHID", //Editor
                            "data": 'RHID',
                            "name": 'RHID',
                            "type": "hidden",
                            "visible": false,
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
                            "data": 'DT_ADMISSAO',
                            "name": 'DT_ADMISSAO',
                            "type": "hidden",
                            "visible": false,
                            "className": "",
                            "datatype": "date"
                        }, {
                            "responsivePriority": 1,
                            "title": "<?php echo mb_strtoupper($ui_year, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_year; ?>", //Editor
                            "data": 'ANO',
                            "name": 'ANO',
                            //"def": hoje('year'),
                            "className": "visibleColumn right",
                            "attr": {
                                "class": "form-control toRight",
                                "style": "width: 20%;"
                            }
                        }, {
                            "responsivePriority": 2,
                            "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_begin_date; ?>", //Editor
                            "data": 'DT_INI',
                            "name": 'DT_INI',
                            "datatype": 'date', // datetime OR datetimeShort OR datetime
                            "className": "visibleColumn",
                            "attr": {
                                "autocomplete": "nope",
                                "class": "datepicker" //(.datepicker OR .dateTimePickerShort OR .dateTimePicker) AND (.minutes OR .seconds for CSS format width)
                            }
                        }, {
                            "responsivePriority": 3,
                            "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_end_date; ?>", //Editor
                            "data": 'DT_FIM',
                            "name": 'DT_FIM',
                            "datatype": 'date', // datetime OR datetimeShort OR datetime
                            "className": "visibleColumn",
                            "attr": {
                                "autocomplete": "nope",
                                "class": "datepicker" //(.datepicker OR .dateTimePickerShort OR .dateTimePicker) AND (.minutes OR .seconds for CSS format width)
                            }
                        }, {
                            "responsivePriority": 4,
                            "title": "<?php echo mb_strtoupper($ui_vacation_days, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_vacation_days; ?>", //Editor
                            "data": 'NR_DIAS_UTEIS',
                            "name": 'NR_DIAS_UTEIS',
                            "className": "visibleColumn right",
                            "attr": {
                                "class": "form-control toRight",
                                "style": "width: 30%;"
                            }
                        }, {
                            "responsivePriority": 5,
                            "title": "<?php echo mb_strtoupper($ui_status, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_status; ?>", //Editor
                            "data": 'ESTADO',
                            "name": 'ESTADO',
                            "type": "select",
                            //"def": "N",
                            "className": "visibleColumn",
                            "attr": {
                                "domain-list": true,
                                "dependent-group": 'RH_ID_FERIAS.ESTADO',
                                "class": "form-control"
                            },
                            "render": function (val, type, row) {
                                if (val != null) {
                                    var o = _.find(initApp.joinsData['RH_ID_FERIAS.ESTADO'], {'RV_LOW_VALUE': val});
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
                            "data": null,
                            "name": 'RECORD_HISTORY',
                            "type": "hidden",
                            "className": "none visibleColumn",
                            "render": function (val, type, row) {
                                return tablesRecordHistory(val, type, row);
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
                                return RH_ID_FERIAS.crudButtons(conf_TM['RH_ID_FERIAS']["crud"][0], conf_TM['RH_ID_FERIAS']["crud"][1], conf_TM['RH_ID_FERIAS']["crud"][2]);
                            }
                        }
                    ],
                    footerCallback( tfoot, data, start, end, display ) {
                        //console.log('footer callback');
                        //HACK to run after rendering ENDS
                        setTimeout(function () {
                            console.log('BEGIN Férias footer callback');                        
                            rhid_FeriasAno = getRhidFerias();
                            console.log('END Férias footer callback');
                        }, 500);
                    },                    
                    "validations": {
                        "rules": {
                            "ANO": {
                                required: true
                            },
                            "NR_DIAS_UTEIS": {
                                integer: true,
                                required: false
                            },
                            "DT_INI": {
                                required: true,
                                dateISO: true
                            },
                            "DT_FIM": {
                                required: true,
                                dateISO: true,
                                dateEqOrNextThan: 'DT_INI',
                            },
                            "ESTADO": {
                                required: true
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
                RH_ID_FERIAS = new QuadTable();
                RH_ID_FERIAS.initTable($.extend({}, datatable_instance_defaults, optionRH_ID_FERIAS));
            } else {
                //REMOVE HMTL
                $('a[href="#Tab4"]').remove();
                $('#Tab4').remove();
            }
            //END Férias

            //Descanso compensatório :: ID_MODULO = 4
            if ( conf_TM['RH_ID_DC_DEBITOS']["access"] ) {
                var optionRH_ID_DC_DEBITOS = {
                    "tableId": "RH_ID_DC_DEBITOS",
                    "table": "RH_ID_DC_DEBITOS",
                    "workFlow":conf_TM['RH_ID_DC_DEBITOS']["workflow"],
                    "crud": conf_TM['RH_ID_DC_DEBITOS']["crud"],//create,update,delete                    
                    "pk": {
                        "primary": {
                            "EMPRESA": {"type": "varchar"},
                            "RHID": {"type": "number"},
                            "DT_ADMISSAO": {"type": "date"},
                            "SEQ": {"type": "date"},
                            "GOZOU_DE": {"type": "date"}
                        }
                    },
                    "on_pre_submit": "RH_ID_DC_DEBITOS",
                    "externalFilter": {
                        "templateMulti": {
                            "selector": "#rhidTMFilter",
                            "mandatory": ['RHID', 'EMPRESA', 'DT_ADMISSAO'],
                            "optional": ['']
                        }
                    },
                    //"detailsObjects": ['RH_ID_EMPRESAS_CONTINUED'],
                    "initialWhereClause": "",
                    "order_by": "GOZOU_DE DESC",
                    "recordBundle": 9,
                    "pageLenght": 9,
                    "scrollY": "352",
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
                            "title": "<?php echo mb_strtoupper($ui_id, 'UTF-8'); ?>",
                            "label": "<?php echo $ui_id; ?>",
                            "data": 'SEQ',
                            "name": 'SEQ',
                            "datatype": 'sequence',
                            "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                            "visible": true,
                            "className": "none visibleColumn",
                            "attr": {
                                "style": "width: 30%"
                            }
                        }, {
                            "title": "RHID", //Datatables
                            "label": "RHID", //Editor
                            "data": "RHID",
                            "name": "RHID",
                            "type": "hidden",
                            "visible": false,
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
                            "data": 'DT_ADMISSAO',
                            "name": 'DT_ADMISSAO',
                            "type": "hidden",
                            "visible": false,
                            "className": "",
                            "datatype": "date"
                        }, {
                            "responsivePriority": 2,
                            "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_begin_date; ?>", //Editor
                            "data": 'GOZOU_DE',
                            "name": 'GOZOU_DE',
                            //"def": hoje('minutes'),
                            "datatype": 'datetimeShort', // datetime OR datetimeShort OR datetime
                            "className": "visibleColumn",
                            "attr": {
                                "autocomplete": "nope",
                                "class": "dateTimePickerShort minutes" //(.datepicker OR .dateTimePickerShort OR .dateTimePicker) AND (.minutes OR .seconds for CSS format width)
                            }
                        }, {
                            "responsivePriority": 3,
                            "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_end_date; ?>", //Editor
                            "data": "GOZOU_A",
                            "name": "GOZOU_A",
                            "datatype": 'datetimeShort', // datetime OR datetimeShort OR datetime
                            "className": "visibleColumn",
                            "attr": {
                                "autocomplete": "nope",
                                "class": "dateTimePickerShort minutes" //(.datepicker OR .dateTimePickerShort OR .dateTimePicker) AND (.minutes OR .seconds for CSS format width)
                            }

                        }, {
                            "responsivePriority": 4,
                            "title": "<?php echo mb_strtoupper($ui_meal_allowance, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_meal_allowance; ?>", //Editor
                            "data": 'SUB_REFEICAO',
                            "name": 'SUB_REFEICAO',
                            "type": "select",
                            "className": "visibleColumn",
                            "attr": {
                                "domain-list": true,
                                "dependent-group": 'DG_SIM_NAO',
                                "class": "form-control chosen",
                                "style": "width: 50% !important;"
                            },
                            "render": function (val, type, row) {
                                if (val != null) {
                                    var o = _.find(initApp.joinsData['DG_SIM_NAO'], {'RV_LOW_VALUE': val});
                                    return val == null ? null : o['RV_MEANING'];
                                }
                                return val;
                            }
                        }, {
                            "responsivePriority": 5,
                            "title": "<?php echo mb_strtoupper($ui_duration, 'UTF-8') . ' <sup> (' . $ui_minutes_short . ') </sup>'; ?>", //Datatables
                            "label": "<?php echo $ui_duration . ' <sup> (' . $ui_minutes_short. ') </sup>'; ?>", //Editor
                            "data": "QTD_USADA",
                            "name": "QTD_USADA",
                            "className": "visibleColumn",
                            "visible": true,
                            //"type": "hidden",
                            "className": "visibleColumn right",
                            "attr": {
                                "disabled": true, //Permite inibir o campo no Editor
                                "class": "form-control toRight",
                                "style": "width: 30%;"
                            }                            
                            
                            
                        }, {
                            "responsivePriority": 6,
                            "title": "<?php echo mb_strtoupper($ui_meal_discount, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_meal_discount; ?>", //Editor
                            "data": 'DESCONTO_REFEICAO',
                            "name": 'DESCONTO_REFEICAO',
                            "className": "visibleColumn right",
                            "attr": {
                                "disabled": true, //Permite inibir o campo no Editor
                                "class": "form-control toRight",
                                "style": "width: 25%;"
                            }
                        }, {
                            "title": "<?php echo mb_strtoupper($ui_obs_short, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_obs_short; ?>", //Editor
                            "data": 'OBS',
                            "name": 'OBS',
                            "type": 'textarea', //Editor
                            "className": "none visibleColumn",
                            "attr": {
                                "style": "max-width: 335px;",
                                "class": "form-control"
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
                            "data": null,
                            "name": 'RECORD_HISTORY',
                            "type": "hidden",
                            "className": "none visibleColumn",
                            "render": function (val, type, row) {
                                return tablesRecordHistory(val, type, row);
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
                                return RH_ID_DC_DEBITOS.crudButtons(conf_TM['RH_ID_DC_DEBITOS']["crud"][0], conf_TM['RH_ID_DC_DEBITOS']["crud"][1], conf_TM['RH_ID_DC_DEBITOS']["crud"][2]);
                            }
                        }
                    ],
                    footerCallback( tfoot, data, start, end, display ) {
                        //console.log('footer callback');
                        //HACK to run after rendering ENDS
                        setTimeout(function () {
                            getRhidDC();
                        }, 500);
                    },                     
                    "validations": {
                        "rules": {
                            "DSP_TP_REGISTO": {
                                required: true
                            },
                            "DSP_ESTADO": {
                                required: true
                            },
                            "GOZOU_DE": {
                                required: true,
                                datetimeShort: true
                            },
                            "GOZOU_A": {
                                datetimeShort: true,
                                dateEqOrNextThan: 'GOZOU_DE'
                            },
                            "DSP_MOTIVO_TS_HV": {
                                required: false
                            },
                            "ARTIGO_TS": {
                                required: false
                            },
                            "OBS": {
                                maxlength: 100
                            }
                        },
                        //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                        "messages": {
                            "GOZOU_A": {
                                dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                            }
                        }
                    }
                };
                RH_ID_DC_DEBITOS = new QuadTable();
                RH_ID_DC_DEBITOS.initTable($.extend({}, datatable_instance_defaults, optionRH_ID_DC_DEBITOS));
            } else {
                //REMOVE HMTL
                $('a[href="#Tab5"]').remove();
                $('#Tab5').remove();
            }
            //END Descanso compensatório

            //TROCAS HORARIO :: ID_MODULO = 13
            if ( conf_TM['RH_ID_ESCALAS_HORARIAS']["access"] ) {
                var optionRH_ID_ESCALAS_HORARIAS = {
                    "tableId": "RH_ID_ESCALAS_HORARIAS",
                    "table": "RH_ID_ESCALAS_HORARIAS",
                    "workFlow":conf_TM['RH_ID_ESCALAS_HORARIAS']["workflow"],
                    "crud": conf_TM['RH_ID_ESCALAS_HORARIAS']["crud"],//create,update,delete
                    "pk": {
                        "primary": {
                            "EMPRESA": {"type": "varchar"},
                            "RHID": {"type": "number"},
                            "DT_ADMISSAO": {"type": "date"},
                            "DIA": {"type": "date"},
                            "TIPO": {"type": "varchar"}
                        }
                    },
                    "externalFilter": {
                        "templateMulti": {
                            "selector": "#rhidTMFilter",
                            "mandatory": ['RHID', 'EMPRESA', 'DT_ADMISSAO'],
                            "optional": ['']
                        }
                    },
                    "on_pre_submit": "RH_ID_ESCALAS_HORARIAS",
                    //"detailsObjects": ['RH_ID_EMPRESAS_CONTINUED'],
                    "initialWhereClause": " TIPO = 'B' ",
                    "order_by": "DIA DESC",
                    "recordBundle": 9,
                    "pageLenght": 9,
                    "scrollY": "352",
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
                            "data": 'TIPO',
                            "name": 'TIPO',
                            "type": "hidden",
                            "visible": false,
                            "className": "",
                            "def": "B",
                            "defaultContent": 'B'
                        }, {
                            "title": "RHID", //Datatables
                            "label": "RHID", //Editor
                            "data": "RHID",
                            "name": "RHID",
                            "type": "hidden",
                            "visible": false,
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
                            "data": 'DT_ADMISSAO',
                            "name": 'DT_ADMISSAO',
                            "type": "hidden",
                            "visible": false,
                            "className": "",
                            "datatype": "date"
                        }, {
                            "responsivePriority": 2,
                            "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_begin_date; ?>", //Editor
                            "data": 'DIA',
                            "name": 'DIA',
                            "def": hoje(),
                            "datatype": 'date', // datetime OR datetimeShort OR datetime
                            "className": "visibleColumn",
                            "attr": {
                                "autocomplete": "nope",
                                "class": "datepicker" //(.datepicker OR .dateTimePickerShort OR .dateTimePicker) AND (.minutes OR .seconds for CSS format width)
                            }
                        }, {
                            "responsivePriority": 3,
                            "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_end_date; ?>", //Editor
                            "data": "DT_FIM",
                            "name": "DT_FIM",
                            "datatype": 'date', // datetime OR datetimeShort OR datetime
                            "className": "visibleColumn",
                            "attr": {
                                "autocomplete": "nope",
                                "class": "datepicker" //(.datepicker OR .dateTimePickerShort OR .dateTimePicker) AND (.minutes OR .seconds for CSS format width)
                            }
                        }, {
                            "responsivePriority": 4,
                            "title": "<?php echo mb_strtoupper($ui_effective_dt, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_effective_dt; ?>", //Editor
                            "data": "DT_EFECTIVIDADE",
                            "name": "DT_EFECTIVIDADE",
                            "datatype": 'date', // datetime OR datetimeShort OR datetime
                            "className": "visibleColumn",
                            "attr": {
                                "class": "datepicker" //(.datepicker OR .dateTimePickerShort OR .dateTimePicker) AND (.minutes OR .seconds for CSS format width)
                            }
                        }, {
                            "responsivePriority": 5,
                            "title": "<?php echo mb_strtoupper($ui_definitive, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_definitive; ?>", //Editor
                            "data": 'DEFINITIVA',
                            "name": 'DEFINITIVA',
                            "type": "select",
                            "def": "N",
                            "className": "visibleColumn",
                            "attr": {
                                "domain-list": true,
                                "dependent-group": 'DG_SIM_NAO',
                                "class": "form-control chosen",
                                "style": "width: 50% !important;"
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
                            "data": 'TP_HORARIO_DE',
                            "name": 'TP_HORARIO_DE',
                            "type": "hidden",
                            "visible": false,
                            "className": "",
                        }, {
                            "responsivePriority": 6,
                            "complexList": true,
                            "title": "<?php echo mb_strtoupper($ui_schedule_type_from, 'UTF-8'); ?>",
                            "label": "<?php echo $ui_schedule_type_from; ?>",
                            "data": 'DSP_TP_HORARIO_DE',
                            "name": 'DSP_TP_HORARIO_DE',
                            "type": "select",
                            "className": "visibleColumn",
                            //"visible": false, //DataTables
                            //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                            "attr": {
                                "dependent-group": "HORARIO",
                                "dependent-level": 1,
                                "data-db-name": "A.RV_LOW_VALUE",
                                "distribute-value": "TP_HORARIO_DE",
                                "decodeFromTable": "CG_REF_CODES A",
                                "desigColumn": "A.RV_MEANING",
                                "orderBy": "A.RV_LOW_VALUE",
                                "whereClause": " AND A.RV_DOMAIN = 'RH_DEF_HORARIOS.TP_HORARIO'",
                                "class": "form-control complexList chosen"
                            }
                        }, {
                            "title": "", //Datatables
                            "label": "", //Editor
                            "data": 'CD_HORARIO_DE',
                            "name": 'CD_HORARIO_DE',
                            "type": "hidden",
                            "visible": false,
                            "className": "",
                        }, {
                            "responsivePriority": 7,
                            "complexList": true,
                            "title": "<?php echo mb_strtoupper($ui_daily_schedule_from, 'UTF-8'); ?>",
                            "label": "<?php echo $ui_daily_schedule_from; ?>",
                            "data": 'DSP_HORARIO_DE',
                            "name": 'DSP_HORARIO_DE',
                            "type": "select",
                            "className": "visibleColumn",
                            //"visible": false, //DataTables
                            //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                            "attr": {
                                //"deferred": true,
                                "name": "DSP_HORARIO",
                                "dependent-group": "HORARIO",
                                "dependent-level": 2,
                                "data-db-name": "A.TP_HORARIO@A.CD_HORARIO",
                                "distribute-value": "TP_HORARIO_DE@CD_HORARIO_DE",
                                "decodeFromTable": "RH_DEF_HORARIOS A",
                                "desigColumn": "CONCAT(CONCAT(A.CD_HORARIO, '-'), A.DSR_HORARIO)",
                                //"whereClause": " AND TP_HORARIO = ':TP_HORARIO'",
                                "orderBy": "A.CD_HORARIO",
                                "class": "form-control complexList chosen",
                                "filter": {
                                    "create": " AND A.ACTIVO = 'S'",// AND TP_HORARIO = ':TP_HORARIO_DE'",
                                    "edit": " AND A.ACTIVO = 'S' ",//AND TP_HORARIO = ':TP_HORARIO_DE'",
                                }
                            }
                        }, {
                            "title": "", //Datatables
                            "label": "", //Editor
                            "data": 'TP_HORARIO_PARA',
                            "name": 'TP_HORARIO_PARA',
                            "type": "hidden",
                            "visible": false,
                            "className": "",
                        }, {
                            "responsivePriority": 8,
                            "complexList": true,
                            "title": "<?php echo mb_strtoupper($ui_schedule_type_to, 'UTF-8'); ?>",
                            "label": "<?php echo $ui_schedule_type_to; ?>",
                            "data": 'DSP_TP_HORARIO_PARA',
                            "name": 'DSP_TP_HORARIO_PARA',
                            "type": "select",
                            "className": "visibleColumn",
                            //"visible": false, //DataTables
                            //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                            "attr": {
                                "dependent-group": "HORARIO_PARA",
                                "dependent-level": 1,
                                "data-db-name": "A.RV_LOW_VALUE",
                                "distribute-value": "TP_HORARIO_PARA",
                                "decodeFromTable": "CG_REF_CODES A",
                                "desigColumn": "A.RV_MEANING",
                                "orderBy": "A.RV_LOW_VALUE",
                                "whereClause": " AND A.RV_DOMAIN = 'RH_DEF_HORARIOS.TP_HORARIO'",
                                "class": "form-control complexList chosen"
                            }
                        }, {
                            "title": "", //Datatables
                            "label": "", //Editor
                            "data": 'CD_HORARIO_PARA',
                            "name": 'CD_HORARIO_PARA',
                            "type": "hidden",
                            "visible": false,
                            "className": "",
                        }, {
                            "responsivePriority": 9,
                            "complexList": true,
                            "title": "<?php echo mb_strtoupper($ui_daily_schedule_to, 'UTF-8'); ?>",
                            "label": "<?php echo $ui_daily_schedule_to; ?>",
                            "data": 'DSP_HORARIO_PARA',
                            "name": 'DSP_HORARIO_PARA',
                            "type": "select",
                            "className": "visibleColumn",
                            //"visible": false, //DataTables
                            //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                            "attr": {
                                "deferred": true,
                                "name": "DSP_HORARIO",
                                "dependent-group": "HORARIO_PARA",
                                "dependent-level": 2,
                                "data-db-name": "A.TP_HORARIO@A.CD_HORARIO",
                                "distribute-value": "TP_HORARIO_PARA@CD_HORARIO_PARA",
                                "decodeFromTable": "RH_DEF_HORARIOS A",
                                "desigColumn": "CONCAT(CONCAT(A.CD_HORARIO, '-'), A.DSR_HORARIO)",
                                //"whereClause": " AND TP_HORARIO = ':TP_HORARIO'",
                                "orderBy": "A.CD_HORARIO",
                                "class": "form-control complexList chosen",
                                "filter": {
                                    "create": " AND A.ACTIVO = 'S' AND A.TP_HORARIO = ':TP_HORARIO_PARA'",
                                    "edit": " AND A.ACTIVO = 'S' AND A.TP_HORARIO = ':TP_HORARIO_PARA'",
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
                            "data": null,
                            "name": 'RECORD_HISTORY',
                            "type": "hidden",
                            "className": "none visibleColumn",
                            "render": function (val, type, row) {
                                return tablesRecordHistory(val, type, row);
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
                                return RH_ID_ESCALAS_HORARIAS.crudButtons(conf_TM['RH_ID_ESCALAS_HORARIAS']["crud"][0], conf_TM['RH_ID_ESCALAS_HORARIAS']["crud"][1], conf_TM['RH_ID_ESCALAS_HORARIAS']["crud"][2]);
                            }
                        }
                    ],
                    "validations": {
                        "rules": {
                            "DIA": {
                                required: true,
                                dateISO: true
                            },
                            "DEFINITIVA": {
                                required: true
                            },
                            "DSP_ESTADO": {
                                required: true
                            },
                            "ARTIGO_TS": {
                                required: false
                            },
                            "DT_EFECTIVIDADE": {
                                dateISO: true,
                                dateEqOrNextThan: 'DIA',
                            },
                            "DT_FIM": {
                                dateISO: true,
                                dateEqOrNextThan: 'DIA',
                            }
                        },
                        //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                        "messages": {
                            "DT_EFECTIVIDADE": {
                                dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                            },
                            "DT_FIM": {
                                dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                            }
                        }
                    }
                };
                RH_ID_ESCALAS_HORARIAS = new QuadTable();
                RH_ID_ESCALAS_HORARIAS.initTable($.extend({}, datatable_instance_defaults, optionRH_ID_ESCALAS_HORARIAS));
            } else {
                //REMOVE HMTL
                $('a[href="#Tab6"]').remove();
                $('#Tab6').remove();
            }
            //END TROCAS HORARIO
            
            //Marcações de Ponto + Tratamento Ponto :: ID_MODULO = 18
            if ( conf_TM['RH_ID_MARCACOES']["access"] ) {
                var optionRH_ID_MARCACOES = {
                    "tableId": "RH_ID_MARCACOES",
                    "table": "RH_ID_MARCACOES",
                    "workFlow":conf_TM['RH_ID_MARCACOES']["workflow"],
                    "crud": conf_TM['RH_ID_MARCACOES']["crud"],//create,update,delete
                    "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_clock_entry; ?>",
                    "pk": {
                        "primary": {
                            "EMPRESA": {"type": "varchar"},
                            "RHID": {"type": "number"},
                            "DT_ADMISSAO": {"type": "date"},
                            "MARCACAO_HORARIA": {"type": "date"}
                        }
                    },
                    "externalFilter": {
                        "templateMulti": {
                            "selector": "#rhidTMFilter",
                            "mandatory": ['RHID', 'EMPRESA', 'DT_ADMISSAO'],
                            "optional": ['']
                        }
                    },
                    //"detailsObjects": ['RH_ID_EMPRESAS_CONTINUED'],
                    //"initialWhereClause": "",
                    "order_by": "MARCACAO_HORARIA DESC",
                    "recordBundle": 9,
                    "pageLenght": 9,
                    "scrollY": "352",
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
                            "title": "RHID", //Datatables
                            "label": "RHID", //Editor
                            "data": 'RHID',
                            "name": 'RHID',
                            "type": "hidden",
                            "visible": false,
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
                            "data": 'DT_ADMISSAO',
                            "name": 'DT_ADMISSAO',
                            "type": "hidden",
                            "visible": false,
                            "className": "",
                            "datatype": "date"
                        }, {
                            "responsivePriority": 2,
                            "title": "<?php echo mb_strtoupper($ui_clock_entry_short, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_clock_entry_short; ?>", //Editor
                            "data": 'MARCACAO_HORARIA',
                            "name": 'MARCACAO_HORARIA',
                            "datatype": 'datetimeShort', // datetime OR datetimeShort OR datetime
                            "className": "visibleColumn",
                            "attr": {
                                "class": "dateTimePickerShort minutes" //(.datepicker OR .dateTimePickerShort OR .dateTimePicker) AND (.minutes OR .seconds for CSS format width)
                            }
                        }, {
                            "responsivePriority": 3,
                            "title": "<?php echo mb_strtoupper($ui_type, 'UTF-8'); ?>", //Datatables :: Original
                            "label": "<?php echo $ui_type; ?>", //Editor
                            "data": 'TP_MARCACAO',
                            "name": 'TP_MARCACAO',
                            "type": "select",
                            "className": "visibleColumn",
                            "attr": {
                                "domain-list": true,
                                "dependent-group": 'RH_ID_MARCACOES.TP_MARCACAO',
                                "class": "form-control"
                            },
                            "render": function (val, type, row) {
                                if (val != null) {
                                    var o = _.find(initApp.joinsData['RH_ID_MARCACOES.TP_MARCACAO'], {'RV_LOW_VALUE': val});
                                    return val == null ? null : o['RV_MEANING'];
                                }
                                return val;
                            }
                        }, {
                            "responsivePriority": 4,
                            "title": "<?php echo mb_strtoupper($ui_status, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_status; ?>", //Editor
                            "data": 'ESTADO',
                            "name": 'ESTADO',
                            "type": "select",
                            "def": "A",
                            "className": "visibleColumn",
                            "attr": {
                                "domain-list": true,
                                "dependent-group": 'RH_ID_MARCACOES.ESTADO',
                                "class": "form-control"
                            },
                            "render": function (val, type, row) {
                                if (val != null) {
                                    var o = _.find(initApp.joinsData['RH_ID_MARCACOES.ESTADO'], {'RV_LOW_VALUE': val});
                                    return val == null ? null : o['RV_MEANING'];
                                }
                                return val;
                            }
                        }, {
                            "title": "<?php echo mb_strtoupper($ui_mechanographic, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_mechanographic; ?>", //Editor
                            "data": 'NR_MECANOGRAFICO',
                            "name": 'NR_MECANOGRAFICO',
                            "className": "none visibleColumn",
                            "attr": {
                                "class": "form-control",
                                "style": "width: 50%;"
                            }
                        }, {
                            "title": "<?php echo mb_strtoupper($ui_local, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_local; ?>", //Editor
                            "data": 'LOCAL',
                            "name": 'LOCAL',
                            "className": "none visibleColumn",
                            "attr": {
                                "class": "form-control",
                                "style": "width: 50%;"
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
                            "data": null,
                            "name": 'RECORD_HISTORY',
                            "type": "hidden",
                            "className": "none visibleColumn",
                            "render": function (val, type, row) {
                                return tablesRecordHistory(val, type, row);
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
                                return RH_ID_MARCACOES.crudButtons(conf_TM['RH_ID_MARCACOES']["crud"][0], conf_TM['RH_ID_MARCACOES']["crud"][1], conf_TM['RH_ID_MARCACOES']["crud"][2]);
                            }
                        }
                    ],
                    "validations": {
                        "rules": {
                            "NR_MECANOGRAFICO": {
                                maxlength: 100
                            },
                            "MARCACAO_HORARIA": {
                                required: true,
                                datetimeShort: true
                            },
                            "TP_MARCACAO": {
                                required: true
                            },
                            "ESTADO": {
                                required: true
                            }
                        }
                    }
                };
                RH_ID_MARCACOES = new QuadTable();
                RH_ID_MARCACOES.initTable($.extend({}, datatable_instance_defaults, optionRH_ID_MARCACOES));
                //END Marcações de Ponto      

                //Hdr. Tratamento Ponto            
                var optionRH_ID_HDR_PONTO = {
                    "tableId": "RH_ID_HDR_PONTO",
                    "table": "RH_ID_HDR_PONTO",
                    "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_qualified_day; ?>",
                    "pk": {
                        "primary": {
                            "EMPRESA": {"type": "varchar"},
                            "RHID": {"type": "number"},
                            "DT_ADMISSAO": {"type": "date"},
                            "DIA": {"type": "date"}
                        }
                    },
                    "externalFilter": {
                        "templateMulti": {
                            "selector": "#rhidTMFilter",
                            "mandatory": ['RHID', 'EMPRESA', 'DT_ADMISSAO'],
                            "optional": ['']
                        }
                    },
                    "detailsObjects": ['RH_DET_PONTOS'],
                    //"initialWhereClause": "",
                    "order_by": "DIA DESC",
                    "recordBundle": 6,
                    "pageLenght": 6,
                    "scrollY": "220",
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
                            "title": "RHID", //Datatables
                            "label": "RHID", //Editor
                            "data": 'RHID',
                            "name": 'RHID',
                            "type": "hidden",
                            "visible": false,
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
                            "data": 'DT_ADMISSAO',
                            "name": 'DT_ADMISSAO',
                            "type": "hidden",
                            "visible": false,
                            "className": "",
                            "datatype": "date"
                        }, {
                            "responsivePriority": 2,
                            "title": "<?php echo mb_strtoupper($ui_context_day, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_context_day; ?>", //Editor
                            "data": 'DIA',
                            "name": 'DIA',
                            "datatype": 'date', // datetime OR datetimeShort OR datetime
                            "className": "visibleColumn",
                            "attr": {
                                "class": "datepicker"
                            }
                        }, {
                            "responsivePriority": 2,
                            "title": "", //<?php echo mb_strtoupper($ui_week_day, 'UTF-8'); ?>", //Datatables
                            "label": "", //"<?php echo $ui_week_day; ?>", //Editor
                            "data": null,
                            "name": 'WEEK_DAY',
                            "type": "readonly",
                            "defaultContent": "", //Must be used on STATIC columns content. On this case classes make there way...
                            "width": "1%",
                            "attr": {
                                "style": "display: none;"
                            },
                            "render": function (val, type, row) {
                                var d = '', t = '';
                                if (row['DIA']) {
                                    d = new Date(row['DIA']).getDay();

                                    if (d == 1) {
                                        t = "<?php echo $ui_cal_monday_short; ?>";
                                    } else if (d == 2) {
                                        t = "<?php echo $ui_cal_tuesday_short; ?>";
                                    } else if (d == 3) {
                                        t = "<?php echo $ui_cal_wednesday_short; ?>";
                                    } else if (d == 4) {
                                        t = "<?php echo $ui_cal_thursday_short; ?>";
                                    } else if (d == 5) {
                                        t = "<?php echo $ui_cal_friday_short; ?>";
                                    } else if (d == 6) {
                                        t = "<?php echo $ui_cal_saturday_short; ?>";
                                    } else if (d == 0) {
                                        t = "<?php echo $ui_cal_sunday_short; ?>";
                                    }
                                }
                                return t;
                            }
                        }, {
                            "responsivePriority": 3,
                            "title": "<?php echo mb_strtoupper($ui_status, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_status; ?>", //Editor
                            "data": 'ESTADO',
                            "name": 'ESTADO',
                            "type": "select",
                            "def": "A",
                            "className": "visibleColumn",
                            "attr": {
                                "domain-list": true,
                                "dependent-group": 'RH_ESTADO_PONTO',
                                "class": "form-control"
                            },
                            "render": function (val, type, row) {
                                if (val != null) {
                                    var o = _.find(initApp.joinsData['RH_ESTADO_PONTO'], {'RV_LOW_VALUE': val});
                                    return val == null ? null : o['RV_MEANING'];
                                }
                                return val;
                            }
                        }, {
                            "responsivePriority": 4,
                            "title": "<?php echo mb_strtoupper($ui_predicted_schedule_short, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_predicted_schedule_short; ?>", //Editor
                            "data": 'PREVISTO',
                            "name": 'PREVISTO',
                            "className": "visibleColumn",
                            "attr": {
                                "class": "form-control",
                                "style": "width: 25%;"
                            },
                            "render": function (val, type, row) {
                                if (val != null) {
                                    val = QuadTimeToMinutes(val);
                                    val = val[0];
                                }
                                return val;
                            }
                        }, {
                            "responsivePriority": 5,
                            "title": "<?php echo mb_strtoupper($ui_accomplished_schedule_short, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_accomplished_schedule_short; ?>", //Editor
                            "data": 'REALIZADO',
                            "name": 'REALIZADO',
                            "className": "visibleColumn",
                            "attr": {
                                "class": "form-control",
                                "style": "width: 25%;"
                            },
                            "render": function (val, type, row) {
                                if (val != null) {
                                    val = QuadTimeToMinutes(val);
                                    val = val[0];
                                }
                                return val;
                            }
                        }, {
                            "responsivePriority": 6,
                            "title": "<?php echo mb_strtoupper($ui_1_period_difference, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_1_period_difference; ?>", //Editor
                            "data": 'DIF_1',
                            "name": 'DIF_1',
                            "className": "visibleColumn",
                            "attr": {
                                "class": "form-control",
                                "style": "width: 25%;"
                            },
                            "render": function (val, type, row) {
                                if (val != null) {
                                    val = QuadTimeToMinutes(val);
                                    val = val[0];
                                }
                                return val;
                            }
                        }, {
                            "responsivePriority": 7,
                            "title": "<?php echo mb_strtoupper($ui_2_period_difference, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_2_period_difference; ?>", //Editor
                            "data": 'DIF_2',
                            "name": 'DIF_2',
                            "className": "visibleColumn",
                            "attr": {
                                "class": "form-control",
                                "style": "width: 25%;"
                            },
                            "render": function (val, type, row) {
                                if (val != null) {
                                    val = QuadTimeToMinutes(val);
                                    val = val[0];
                                }
                                return val;
                            }
                        }, {
                            "responsivePriority": 8,
                            "title": "<?php echo mb_strtoupper($ui_tot_day_difference, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_tot_day_difference; ?>", //Editor
                            "data": 'DIF_TOTAL_DIA',
                            "name": 'DIF_TOTAL_DIA',
                            "className": "visibleColumn",
                            "attr": {
                                "class": "form-control",
                                "style": "width: 25%;"
                            },
                            "render": function (val, type, row) {
                                if (val != null) {
                                    val = QuadTimeToMinutes(val);
                                    val = val[0];
                                }
                                return val;
                            }
                        }, {
                            "responsivePriority": 9,
                            "title": "<?php echo mb_strtoupper($ui_delay, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_delay; ?>", //Editor
                            "data": 'ATRASO_TOTAL',
                            "name": 'ATRASO_TOTAL',
                            "className": "visibleColumn",
                            "attr": {
                                "class": "form-control",
                                "style": "width: 25%;"
                            },
                            "render": function (val, type, row) {
                                if (val != null) {
                                    val = QuadTimeToMinutes(val);
                                    val = val[0];
                                }
                                return val;
                            }
                        }, {
                            "title": "", //Datatables
                            "label": "", //Editor
                            "data": 'CD_HOR_DIA',
                            "name": 'CD_HOR_DIA',
                            "type": "hidden",
                            "visible": false,
                            "className": "",
                        }, {
                            "responsivePriority": 7,
                            "complexList": true,
                            "title": "<?php echo mb_strtoupper($ui_daily_schedule, 'UTF-8'); ?>",
                            "label": "<?php echo $ui_daily_schedule; ?>",
                            "data": "DSP_HOR_DIARIO",
                            "name": "DSP_HOR_DIARIO",
                            "className": "visibleColumn",
                            "type": "select",
                            "attr": {
                                "dependent-group": "HORARIO_DIARIO",
                                "dependent-level": 1,
                                "data-db-name": 'A.CD_HOR_DIA',
                                "decodeFromTable": 'RH_DEF_HORARIO_DIAS A',
                                "desigColumn": "CONCAT(CONCAT(A.CD_HOR_DIA, '-'), A.DSR_HOR_DIA)",
                                "otherValues": "A.INICIO_DIA@A.INICIO_NOITE@A.FIM_NOITE@A.TP_1@A.HI_1@A.HF_1@A.TP_2@A.HI_2@A.HF_2@A.TP_3@A.HI_3@A.HF_3@A.TP_4@A.HI_4@A.HF_4@A.TP_5@A.HI_5@A.HF_5",
                                'orderBy': 'A.CD_HOR_DIA',
                                "class": "form-control complexList chosen",
                                "filter": {
                                    "create": " AND A.ACTIVO = 'S'",
                                    "edit": " AND A.ACTIVO = 'S' ",
                                }
                            }
                        }, {
                            "title": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_context_day, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                            "label": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_context_day, 'UTF-8'); ?>" + "</span>", //Editor
                            "data": '',
                            "name": 'TIT_CTX',
                            "type": "readonly",
                            "className": "none",
                            "defaultContent": "", //Must be used on STATIC columns content. On this case classes make there way...
                            "attr": {
                                "style": "display: none;"
                            }
                        }, {
                            "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_begin, 'UTF-8'); ?>" + "</span>", //Datatables
                            "label": "<span class='quadSubTitle'>" + "<?php echo $ui_begin; ?>" + "</span>", //Editor
                            "data": 'DT_INI_CTX',
                            "name": 'DT_INI_CTX',
                            "type": "hidden",
                            "datatype": 'datetime', // datetime OR datetimeShort OR datetime
                            "className": "none visibleColumn",
                            "attr": {
                                "class": "dateTimePickerShort minutes" //(.datepicker OR .dateTimePickerShort OR .dateTimePicker) AND (.minutes OR .seconds for CSS format width)
                            }
                        }, {
                            "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_end, 'UTF-8'); ?>" + "</span>", //Datatables
                            "label": "<span class='quadSubTitle'>" + "<?php echo $ui_end; ?>" + "</span>", //Editor
                            "data": 'DT_FIM_CTX',
                            "name": 'DT_FIM_CTX',
                            "type": "hidden",
                            "datatype": 'datetime', // datetime OR datetimeShort OR datetime
                            "className": "none visibleColumn",
                            "attr": {
                                "class": "dateTimePickerShort minutes" //(.datepicker OR .dateTimePickerShort OR .dateTimePicker) AND (.minutes OR .seconds for CSS format width)
                            }
                        }, {
                            "title": "", //Datatables
                            "label": "", //Editor
                            "data": 'CD_REGRA_PONTO',
                            "name": 'CD_REGRA_PONTO',
                            "type": "hidden",
                            "visible": false,
                            "className": "",
                        }, {
                            "complexList": true,
                            "title": "<?php echo mb_strtoupper($ui_rule, 'UTF-8'); ?>",
                            "label": "<?php echo $ui_rule; ?>",
                            "data": "DSP_REGRA",
                            "name": "DSP_REGRA",
                            "className": "none visibleColumn",
                            "type": "select",
                            "attr": {
                                "dependent-group": "REGRA_PONTO",
                                "dependent-level": 1,
                                "data-db-name": 'A.CD_REGRA_PONTO',
                                "decodeFromTable": 'RH_DEF_REGRAS_PONTO A',
                                "desigColumn": "CONCAT(CONCAT(A.CD_REGRA_PONTO, '-'), A.DSR_REGRA_PONTO)",
                                'orderBy': 'A.CD_REGRA_PONTO',
                                "class": "form-control complexList chosen",
                                "filter": {
                                    "create": " AND A.ACTIVO = 'S'",
                                    "edit": " AND A.ACTIVO = 'S' ",
                                }
                            }
                        }, {
                            "responsivePriority": 4,
                            "title": "<?php echo mb_strtoupper($ui_day_type, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_day_type; ?>", //Editor
                            "data": 'TP_DIA',
                            "name": 'TP_DIA',
                            "type": "select",
                            "className": "visibleColumn",
                            "attr": {
                                "domain-list": true,
                                "dependent-group": 'RH_ID_HDR_PONTO.TP_DIA',
                                "class": "form-control"
                            },
                            "render": function (val, type, row) {
                                if (val != null) {
                                    var o = _.find(initApp.joinsData['RH_ID_HDR_PONTO.TP_DIA'], {'RV_LOW_VALUE': val});
                                    return val == null ? null : o['RV_MEANING'];
                                }
                                return val;
                            }
                        }, {
                            "title": "<?php echo mb_strtoupper($ui_obs_short, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_obs_short; ?>", //Editor
                            "data": 'OBS',
                            "name": 'OBS',
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
                            "data": null,
                            "name": 'RECORD_HISTORY',
                            "type": "hidden",
                            "className": "none visibleColumn",
                            "render": function (val, type, row) {
                                return tablesRecordHistory(val, type, row);
                            }
                        }
                    ],
                    "validations": {
                        "rules": {
                            "NR_MECANOGRAFICO": {
                                maxlength: 100
                            },
                            "MARCACAO_HORARIA": {
                                required: true,
                                datetimeShort: true
                            },
                            "TP_MARCACAO": {
                                required: true
                            },
                            "ESTADO": {
                                required: true
                            }
                        }
                    }
                };
                RH_ID_HDR_PONTO = new QuadTable();
                RH_ID_HDR_PONTO.initTable($.extend({}, datatable_instance_defaults, optionRH_ID_HDR_PONTO));
                //END Hdr. Tratamento Ponto

                //Detalhes Tratamento Ponto
                var optionRH_DET_PONTOS = {
                    "tableId": "RH_DET_PONTOS",
                    "table": "RH_DET_PONTOS",
                    "pk": {
                        "primary": {
                            "EMPRESA": {"type": "varchar"},
                            "RHID": {"type": "number"},
                            "DT_ADMISSAO": {"type": "date"},
                            "DIA": {"type": "date"},
                            "NR_ORDEM": {"type": "number"}
                        }
                    },
                    "dependsOn": {
                        "RH_ID_HDR_PONTO": {//External object key mapping( object key : external key)                    
                            "EMPRESA": "EMPRESA",
                            "RHID": "RHID",
                            "DT_ADMISSAO": "DT_ADMISSAO",
                            "DIA": "DIA"
                        }
                    },
                    //"initialWhereClause": "",
                    "order_by": "HR_IN",
                    "recordBundle": 999999999,
                    "pageLenght": 999999999,
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
                            "title": "RHID", //Datatables
                            "label": "RHID", //Editor
                            "data": 'RHID',
                            "name": 'RHID',
                            "type": "hidden",
                            "visible": false,
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
                            "data": 'DT_ADMISSAO',
                            "name": 'DT_ADMISSAO',
                            "type": "hidden",
                            "visible": false,
                            "className": "",
                            "datatype": "date"
                        }, {
                            "title": "", //Datatables
                            "label": "", //Editor
                            "data": 'DIA',
                            "name": 'DIA',
                            "type": "hidden",
                            "visible": false,
                            "className": "",
                            "datatype": "date"
                        }, {
                            "title": "", //Datatables
                            "label": "", //Editor
                            "data": 'NR_ORDEM',
                            "name": 'NR_ORDEM',
                            "type": "hidden",
                            "visible": false,
                            "className": "",
                        }, {
                            "responsivePriority": 2,
                            "title": "<?php echo mb_strtoupper($ui_type, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_type; ?>", //Editor
                            "data": 'ID_FAIXA',
                            "name": 'ID_FAIXA',
                            "type": "select",
                            "className": "visibleColumn",
                            "attr": {
                                "domain-list": true,
                                "dependent-group": 'RH_DET_PONTOS.ID_FAIXA',
                                "class": "form-control"
                            },
                            "render": function (val, type, row) {
                                if (val != null) {
                                    var o = _.find(initApp.joinsData['RH_DET_PONTOS.ID_FAIXA'], {'RV_LOW_VALUE': val});
                                    return val == null ? null : o['RV_ABBREVIATION'];
                                }
                                return val;
                            }
                        }, {
                            "responsivePriority": 5,
                            "title": "<?php echo mb_strtoupper($ui_origin, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_origin; ?>", //Editor
                            "data": 'TP_IN',
                            "name": 'TP_IN',
                            "type": "select",
                            "className": "visibleColumn",
                            "attr": {
                                "domain-list": true,
                                "dependent-group": 'RH_DET_PONTOS.TP_IN',
                                "class": "form-control"
                            },
                            "render": function (val, type, row) {
                                if (val != null) {
                                    var o = _.find(initApp.joinsData['RH_DET_PONTOS.TP_IN'], {'RV_LOW_VALUE': val});
                                    return val == null ? null : o['RV_MEANING'];
                                }
                                return val;
                            }
                        }, {
                            "responsivePriority": 7,
                            "title": "<?php echo mb_strtoupper($ui_delay, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_delay; ?>", //Editor
                            "fieldInfo": "<?php echo $hint_minutes; ?>",
                            "data": 'ATRASO_ENTRADA',
                            "name": 'ATRASO_ENTRADA',
                            "className": "visibleColumn",
                            "width": "1%",
                            "attr": {
                                "class": "form-control",
                                "style": "width: 25%;"
                            },
                            "render": function (val, type, row) {
                                if (row['TP_IN'] === 'M' || row['TP_IN'] === 'T' || row['TP_IN'] === 'U') {
                                    if (row['ID_FAIXA'] == 1 || row['ID_FAIXA'] == 2 || row['ID_FAIXA'] == 6) {
                                        if (val != null) {
                                            val = QuadTimeToMinutes(val);
                                            val = val[0];
                                        }
                                        if (val == '00:00') {
                                            val = null;
                                        }
                                        return val;
                                    }
                                }
                                return null;
                            }
                        }, {
                            "responsivePriority": 3,
                            "title": "<?php echo mb_strtoupper($ui_entrance, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_entrance; ?>", //Editor
                            "data": 'HR_IN',
                            "name": 'HR_IN',
                            "datatype": "datetimeShort", // datetime OR datetimeShort OR datetime
                            "className": "visibleColumn",
                            "attr": {
                                "class": "form-control dateTimePicker minutes"
                            },
                            "render": function (val, type, row) {
                                if (row['TP_IN'] === 'M') {
                                    return '<span class="marcacaoReal">' + val + '</span';
                                } else {
                                    return val;
                                }
                            }
                        }, {
                            "responsivePriority": 6,
                            "title": "<?php echo mb_strtoupper($ui_origin, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_origin; ?>", //Editor
                            "data": 'TP_OUT',
                            "name": 'TP_OUT',
                            "type": "select",
                            "className": "visibleColumn",
                            "attr": {
                                "domain-list": true,
                                "dependent-group": 'RH_DET_PONTOS.TP_OUT',
                                "class": "form-control"
                            },
                            "render": function (val, type, row) {
                                if (val != null) {
                                    var o = _.find(initApp.joinsData['RH_DET_PONTOS.TP_OUT'], {'RV_LOW_VALUE': val});
                                    return val == null ? null : o['RV_MEANING'];
                                }
                                return val;
                            }
                        }, {
                            "responsivePriority": 4,
                            "title": "<?php echo mb_strtoupper($ui_exit, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_exit; ?>", //Editor
                            "data": 'HR_OUT',
                            "name": 'HR_OUT',
                            "datatype": "datetimeShort", // datetime OR datetimeShort OR datetime
                            "className": "visibleColumn",
                            "attr": {
                                "class": "form-control dateTimePicker minutes"
                            },
                            "render": function (val, type, row) {
                                if (row['TP_OUT'] === 'M') {
                                    return '<span class="marcacaoReal">' + val + '</span';
                                } else {
                                    return val;
                                }
                            }
                        }, {
                            "responsivePriority": 8,
                            "title": "<?php echo mb_strtoupper($ui_delay, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_delay; ?>", //Editor
                            "fieldInfo": "<?php echo $hint_minutes; ?>",
                            "data": 'ATRASO_SAIDA',
                            "name": 'ATRASO_SAIDA',
                            "className": "visibleColumn",
                            "width": "1%",
                            "attr": {
                                "class": "form-control",
                                "style": "width: 25%;"
                            },
                            "render": function (val, type, row) {
                                if (row['TP_IN'] === 'M' || row['TP_IN'] === 'T' || row['TP_IN'] === 'U') {
                                    if (row['ID_FAIXA'] == 1 || row['ID_FAIXA'] == 2 || row['ID_FAIXA'] == 6) {
                                        if (val != null) {
                                            val = QuadTimeToMinutes(val);
                                            val = val[0];
                                        }
                                        if (val == '00:00') {
                                            val = null;
                                        }
                                        return val;
                                    }
                                }
                                return null;
                            }
                        }, {
                            "responsivePriority": 2,
                            "title": "<?php echo mb_strtoupper($ui_duration, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_duration; ?>", //Editor
                            "fieldInfo": "<?php echo $hint_minutes; ?>",
                            "data": 'TOTAL_FAIXA',
                            "name": 'TOTAL_FAIXA',
                            "className": "visibleColumn",
                            "attr": {
                                "class": "form-control",
                                "style": "width: 25%;"
                            },
                            "render": function (val, type, row) {
                                if (val != null) {
                                    val = QuadTimeToMinutes(val);
                                    val = val[0];
                                }
                                return val;
                            }
                        }, {
                            "title": "", //Datatables
                            "label": "", //Editor
                            "data": 'CD_AUSENCIA',
                            "name": 'CD_AUSENCIA',
                            "type": "hidden",
                            "visible": false,
                            "className": "",
                        }, {
                            "responsivePriority": 9,
                            "complexList": true,
                            "title": "<?php echo mb_strtoupper($ui_absence, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_absence; ?>", //Editor
                            "data": 'DSP_AUSENCIA',
                            "name": 'DSP_AUSENCIA',
                            "type": "select",
                            "className": "visibleColumn",
                            //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                            "attr": {
                                "dependent-group": "AUSENCIAS",
                                "dependent-level": 1,
                                "data-db-name": "A.CD_AUSENCIA",
                                "decodeFromTable": "RH_DEF_AUSENCIAS A", //TO CHANGE ON QUAD-HCM
                                "desigColumn": "CONCAT(CONCAT(A.CD_AUSENCIA,'-'), A.DSP_AUSENCIA)",
                                "orderBy": "A.CD_AUSENCIA",
                                "class": "form-control complexList chosen",
                                "filter": {
                                    "create": " AND A.ACTIVO = 'S'", // + justSelfService_DB, //On-New-Record
                                    "edit": " AND A.ACTIVO = 'S'", // + justSelfService_DB, //On-Edit-Record
                                }
                            }
                        }, {
                            "responsivePriority": 10,
                            "title": "<?php echo mb_strtoupper($ui_status, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_status; ?>", //Editor
                            "data": 'ESTADO',
                            "name": 'ESTADO',
                            "type": "select",
                            "def": "A",
                            "className": "visibleColumn",
                            "attr": {
                                "domain-list": true,
                                "dependent-group": 'RH_ESTADO_PONTO',
                                "class": "form-control"
                            },
                            "render": function (val, type, row) {
                                if (val != null) {
                                    var o = _.find(initApp.joinsData['RH_ESTADO_PONTO'], {'RV_LOW_VALUE': val});
                                    return val == null ? null : o['RV_MEANING'];
                                }
                                return val;
                            }
                        }, {
                            "title": "<?php echo mb_strtoupper($ui_available, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_available; ?>", //Editor
                            //"fieldInfo": "<?php echo $hint_minutes; ?>",
                            "data": 'TS_INTEGRAR',
                            "name": 'TS_INTEGRAR',
                            "className": "visibleColumn",
                            "attr": {
                                "class": "form-control",
                                "style": "width: 25%;"
                            },
                            "render": function (val, type, row) {
                                if (val != null) {
                                    val = QuadTimeToMinutes(val);
                                    val = val[0];
                                }
                                return val;
                            }
                        }, {
                            "title": "<?php echo mb_strtoupper($ui_delay_status, 'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_delay_status; ?>", //Editor
                            "data": 'ESTADO_ATRASO',
                            "name": 'ESTADO_ATRASO',
                            "type": "select",
                            "className": "none visibleColumn",
                            "attr": {
                                "domain-list": true,
                                "dependent-group": 'RH_DET_PONTOS.ESTADO_ATRASO',
                                "class": "form-control"
                            },
                            "render": function (val, type, row) {
                                if (val != null) {
                                    var o = _.find(initApp.joinsData['RH_DET_PONTOS.ESTADO_ATRASO'], {'RV_LOW_VALUE': val});
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
                            "data": null,
                            "name": 'RECORD_HISTORY',
                            "type": "hidden",
                            "className": "none visibleColumn",
                            "render": function (val, type, row) {
                                return tablesRecordHistory(val, type, row);
                            }
                        }
                    ],
                    "validations": {
                        "rules": {
                            "NR_MECANOGRAFICO": {
                                maxlength: 100
                            },
                            "MARCACAO_HORARIA": {
                                required: true,
                                datetimeShort: true
                            },
                            "TP_MARCACAO": {
                                required: true
                            },
                            "ESTADO": {
                                required: true
                            }
                        }
                    }
                };
                RH_DET_PONTOS = new QuadTable();
                RH_DET_PONTOS.initTable($.extend({}, datatable_instance_defaults, optionRH_DET_PONTOS));
                //END Detalhes Tratamento Ponto
            } else {
                //REMOVE HMTL
                $('a[href="#Tab7"]').remove();
                $('#Tab7').remove();
                $('a[href="#Tab8"]').remove();
                $('#Tab8').remove();
            }
            //END Marcações de Ponto + Tratamento Ponto   
        }
        //END Tables

        //Code Branch
        if (1 === 1) {
            //Populate FILTERS Content :: Logic
            if (1 === 1) {
            
                //Ao carregar RHID, os módulos carregam dados de contexto, esta função LIMPA-OS.
                //Invocada de getRHIDS()
                function resetRhidData () {
                    //Reset RH_ID_ANOS (Férias)
                    rhid_FeriasAno = {};
                }
                
                //Extra Buttons :: Adaptabilidade
                var adaptabilidadeExtra = function (request_) {
                    alert(request_);
                    if ( 1 === 0) {
                        var obj = this;
                        var worker1 = new Worker(pn + "lib/quad/sampleWorker.js");

                        var message = {
                          operation: "export",
                          cxLists: cxLists,
                          sql: sql,
                          defaults: datatable_instance_defaults.pathToSqlFile,
                          tableId: obj.tableId,
                          tableCols: obj.tableCols,
                          dbColumns: obj.dbColumns,
                          pk: obj.pk.primary,
                          loadedData: initApp.joinsComplexData,
                          domains: initApp.joinsData,
                          type: obj instanceof QuadForm ? "QuadForm" : "QuadTable",
                          visibleCols: arrCols ? arrCols : null,
                          formComplexLists: obj.complexLists,
                          formDomainsLists: obj.domainLists,
                          decodeExport:
                            obj["export"].decodeExport === false ? obj["export"].decodeExport : null
                        };
                        worker1.postMessage(JSON.stringify(message));
                        worker1.onmessage = function(event) {
                            if (event.data.download) {
                                //o ficheiro foi criado no servidor, é necessário fazer o download
                                var link = document.createElement("a");
                                document.body.appendChild(link);
                                link.download =
                                  initCaps(obj.tableId ? obj.tableId : obj.formId.substring(1)) + ".csv";
                                link.href = event.data.download;
                                link.click();
                                link.remove();
                                //Remoção do ficheiro temporário no servidor
                                setTimeout(function() {
                                  quad_notification_clear();
                                  obj.hideProcess();
                                  $.get(
                                        window.location.origin + datatable_instance_defaults.pathToSqlFile +
                                        "returnSqlRes.php", {
                                            file: event.data.file,
                                            action: "delete"
                                        }
                                  );
                                }, 100);
                                return;
                            }
                            
                            //processo foi despoletado, mostra informação
                            if (event.data === "working") {
                                obj.showProcess(JS_EXPORTING + " " + obj.tableId);
                                return;
                            } else {
                                //a resposta do web worker é diferente de 'working', tratar de descarregar o ficheiro...
                                // descarregado através de "clientside". Até 500 mb é seguro fazer assim
                                //persiste problema no servidor partilhado e com pouca RAM
                                quad_notification_clear();
                                //var fileData = decodeURI(event.data);
                                var fileData = "\ufeff" + decodeURI(event.data), //ADD BOM to EXCEL
                                    blobObject = new Blob([fileData], {
                                        type: "text/csv;charset=utf-8,%EF%BB%BF"
                                    });
                                
                                if (window.navigator.msSaveOrOpenBlob) {
                                    // for IE and Edge
                                    window.navigator.msSaveOrOpenBlob(
                                      blobObject,
                                      initCaps(obj.tableId ? obj.tableId : obj.formId.substring(1)) + ".csv"
                                    );
                                } else {
                                    var link = document.createElement("a");
                                    document.body.appendChild(link);
                                    link.download =
                                      initCaps(obj.tableId ? obj.tableId : obj.formId.substring(1)) +
                                      ".csv";
                                    //link.href = event.data;
                                    link.href = window.URL.createObjectURL(blobObject);
                                    link.click();
                                    link.remove();
                                }
                                quad_notification_clear();
                                obj.hideProcess();
                            }
                        }
                    }
                }
                //END Extra Buttons :: Adaptabilidade

                //GET RHID's -> Calls getEMPRESA that Calls -> getDT_ADM
                var getRHIDS = function (filters, formData) {
                    //Reset RHID statistics
                    resetRhidData();
                    var el = $("#xt_RHID");
                    $("#xt_DT_ADMISSAO").chosen('destroy');
                    $("#xt_EMPRESA").chosen('destroy');
                    el.chosen('destroy');

                    if (formData) {
                        el.append($('<option>', {
                            value: formData.RHID,
                            text: formData.RHID + "-" + formData.NOME
                        }));

                        el.trigger("chosen:updated");
                        el.val(formData.RHID);
                        el.trigger("mouseover");
                       // el.trigger("change");
                        return;
                    }
                    var params = {};
                    //first roudtrip without filters
                    if (!filters) {
                        //COMPLEXLIST FORCE KEY
                        params['EMPREGADOS'] = {
                            pk: "RHID",
                            table: "RH_IDENTIFICACOES",
                            where: filter_where,
                            orderBy: "RHID",
                            desigColumn: "CONCAT(CONCAT(RHID,'-'),NOME)",
                            //otherValues: "EMPRESA@RHID@DT_ADMISSAO@DSP_SITUACAO" //not used at the moment
                            //todo problema concat NULL https://makandracards.com/makandra/825-mysql-concat-with-null-fields
                        };
                        var promise = $.ajax({
                            type: "POST",
                            url: "data-source/complexLists.php",
                            data: {lists:  params, multiRequest: false},
                            dataType: "text",
                            cache: false,
                            async: true,
                            beforeSend: function () {
                                el.addClass("loadingList");
                            }
                        });
                    } else { //form with filters submited...
                        var promise = $.ajax({
                            type: "POST",
                            url: "data-source/myfilterscontroller.php",
                            data: filters,
                            dataType: "text",
                            cache: false,
                            async: true,
                            beforeSend: function () {
                                el.addClass("loadingList");
                            }
                        });
                    }

                    $.when(promise).then(function (data) {
                        var dat = JSON.parse(data)["data"]; //JSON.parse(data);
                        
                        if (dat['EMPREGADOS'].length > 0) { //if results  fill dropdown etc.
                            var output = [];
                            output.push("<option> </option>");
                            _.map(dat['EMPREGADOS'], function (ob, index) {
                                var oValues = ob["OTHERVALUES"]
                                        ? 'data-otherValues="' + ob["OTHERVALUES"] + '"'
                                        : "", unique = 'select';
                                if (dat["EMPREGADOS"].length === 1) {
                                    output.push(
                                        '<option value="' +
                                        ob.VAL +
                                        '" ' +
                                        oValues +
                                        " selected='selected'>" +
                                        ob[Object.keys(ob)[0]] +
                                        "</option>"
                                    );
                                } else {
                                    output.push(
                                        '<option value="' +
                                        ob.VAL +
                                        '" ' +
                                        oValues +
                                        ">" +
                                        ob[Object.keys(ob)[0]] +
                                        "</option>"
                                    );
                                }
                            });
                            el.html(output.join(""));
                            el.removeClass("loadingList");
                            var options = {
                                no_results_text: "_RESULTS_VARIABLE",
                                placeholder_text_single: " ",
                                allow_single_deselect: true,
                                search_contains: true
                            };
                            //FORCE HOVER on CHOSEN
                            el.hover(function () {
                                el.chosen(options);
                                el.trigger("chosen:updated");
                            });                        
                            el.trigger("mouseover");
                            
                             //JUST ONE RHID :: DISABLES LOV
                            if (dat['EMPREGADOS'].length === 1) {
                                el.val(dat['EMPREGADOS'][0]["VAL"]);                                
                                getEMPRESA($('#xt_RHID').val());
                                el.attr('disabled', true);
                                el.trigger("chosen:updated");
                            }
                            el.trigger("chosen:updated");
                        } else { //no results ...show create button
                            //$("#RH_IDENTIFICACOES").find("a[data-form-action=new]").show();
                        }
                    });
                };
                getRHIDS(null);
                //END GET RHID's

                //GET Empresa
                var getEMPRESA = function (rhid_) {
                    var el = $("#xt_EMPRESA"), params = {};
                    $("#xt_DT_ADMISSAO").chosen('destroy');
                    el.chosen('destroy');
                    if (rhid_) {
                        var params = {
                            pk: "EMPRESA",
                            table: "QUAD_PEOPLE",
                            where: " AND RHID = " + rhid_,
                            orderBy: "RHID",
                            desigColumn: "DISTINCT EMPRESA",
                            //otherValues: "EMPRESA@RHID@DT_ADMISSAO@DSP_SITUACAO" //not used at the moment
                            //todo problema concat NULL https://makandracards.com/makandra/825-mysql-concat-with-null-fields
                        }
                        var promise = $.ajax({
                            type: "POST",
                            url: "data-source/complexLists.php",
                            data: {lists: [params], multiRequest: true},
                            dataType: "text",
                            cache: false,
                            async: true,
                            beforeSend: function () {
                                el.addClass("loadingList");
                            }
                        });
                    }

                    $.when(promise)
                        .then(function (data) {
                            var dat = JSON.parse(data);
                            if (dat["data"][0].length > 0) { //if results  fill dropdown etc.
                                var output = [];
                                output.push("<option> </option>");
                                _.map(dat["data"][0], function (ob, index) {
                                    var oValues = ob["OTHERVALUES"] ? 'data-otherValues="' + ob["OTHERVALUES"] + '"' : "";
                                    output.push('<option value="' + ob.VAL + '" ' + oValues + ">" + ob[Object.keys(ob)[0]] + "</option>");
                                });
                                el.html(output.join(""));
                                el.removeClass("loadingList");
                                
                                var options = {
                                    no_results_text: "_RESULTS_VARIABLE",
                                    placeholder_text_single: " ",
                                    allow_single_deselect: true,
                                    search_contains: true
                                };

                                el.chosen(options);
                                //DEFAULT ONE OPTION
                                if (dat["data"][0].length === 1) {
                                    el.val(dat["data"][0][0]["VAL"]);
                                    //el.trigger("change");
                                    getDT_ADM($('#xt_RHID').val(), el.val());
                                }
                                el.trigger("chosen:updated");
                            }
                            return dat;
                        })
                        .then(function (data) {
                            var data = data['data'][0];
                            if (data.length) {
                                data.forEach( function(value, index, array) {
                                    var rw = getQim('DG_ANOS', data[index]['VAL']);
                                    //SE DG_ANOS#EMPRESA NÃO EXISTIR, carrega-a para initApp.DG_ANOS#EMPRESA
                                    //Aí termos o ANO ABERTO para a EMPRESA, com todas as colunas de DG_ANOS
                                    if ( _.isEmpty(rw) ) {
                                        var params;                                            
                                        $.ajax({
                                            type: "POST",
                                            url:  "data-source/quad_requests_lib.php",
                                            data: "request_id=getAnoAberto"+
                                                  "&empresa="+ data[index]['VAL'],
                                            async: false,
                                            cache: false,
                                            success: function(res){
                                                var res = JSON.parse(res);
                                                if ( _.isEmpty(res) ) { //EMPRESA NÃO TEM ANO ABERTO
                                                    //TODO
                                                    alert('Para a empresa ' + data[index]['VAL'] + ' não há nenhum mês Aberto. Inibir CRUD nos módulos aplicáveis ???');                                                    
                                                } else {
                                                    setQim('DG_ANOS', data[index]['VAL'], res);
                                                }
                                            }
                                        });
                                    }
                                });
                                console.log(initApp);
                            }
                        });
                };
                //GET Empresa            

                //GET DT.ADMISSAO
                var getDT_ADM = function (rhid_, empresa_) {
                    var el = $("#xt_DT_ADMISSAO"), params = {};
                    el.chosen('destroy');
                    
                    if (rhid_ && empresa_) {
                        params = {
                            pk: "DT_ADMISSAO",
                            table: "QUAD_PEOPLE",
                            where: " AND RHID = " + rhid_ + " AND EMPRESA = '" + empresa_ + "'",
                            orderBy: "DT_ADMISSAO DESC",
                            desigColumn: "DISTINCT DT_ADMISSAO",
                            otherValues: "MARCACOES_FERIAS@TRATAMENTO_PONTO@ABSENTISMO@AUSENCIA_PROGRAMADA@TRABALHO_SUPLEMENTAR@TP_HORARIO@CD_HORARIO" //not used at the moment
                            //todo problema concat NULL https://makandracards.com/makandra/825-mysql-concat-with-null-fields
                        }
                        var promise = $.ajax({
                            type: "POST",
                            url: "data-source/complexLists.php",
                            data: {lists: [params], multiRequest: true},
                            dataType: "text",
                            cache: false,
                            async: true,
                            beforeSend: function () {
                                el.addClass("loadingList");
                            }
                        });
                        
                        $.when(promise)
                            .then(function (data) {
                                var dat = JSON.parse(data);
                                if (dat["data"][0].length > 0) { 
                                    var output = [];
                                    output.push("<option> </option>");
                                    _.map(dat["data"][0], function (ob, index) {
                                        var oValues = ob["OTHERVALUES"] ? 'data-otherValues="' + ob["OTHERVALUES"] + '"' : "";
                                        output.push('<option value="' + ob.VAL + '" ' + oValues + ">" + ob[Object.keys(ob)[0]] + "</option>");
                                    });
                                    el.html(output.join(""));
                                    el.removeClass("loadingList");
                                    var options = {
                                        no_results_text: "_RESULTS_VARIABLE",
                                        placeholder_text_single: " ",
                                        allow_single_deselect: true,
                                        search_contains: true
                                    };
                                    el.chosen(options);
                                    /* DEFAULT ONE OPTION :: SELECT AUTOMATICLLY */
                                    if (dat["data"][0].length === 1) {
                                        el.val(dat["data"][0][0]["VAL"]);
                                        el.trigger("change");
                                    }
                                    el.trigger("chosen:updated");
                                }
                                return dat["data"][0][0]["VAL"];
                            })
                            .then(function (data) {
                                var tb = $("#timeResourcesList li.active > a").attr('href');
                                /*  
                                    #Tab1 -> Absentismo
                                    #Tab2 -> Adpatabilidade
                                    #Tab3 -> Trab. Suplementar
                                    #Tab4 -> Férias
                                    #Tab5 -> Desc. Compensatório
                                    #Tab6 -> Trocas Horário
                                    #Tab7 -> Registo Ponto
                                    #Tab8 -> Tratamento Ponto
                                 */
                                
                                //MODULE STATISTICS
                                if (tb === "#Tab2") {
                                    //Called by footerCallback on RH_ID_DET_ADAPTABILIDADES instance
                                    //getRhidAdaptabilidade();
                                } else if (tb === "#Tab3") {
                                    //getRhidTS();
                                } else if (tb === "#Tab4") {
                                    //Called by footerCallback on RH_ID_FERIAS instance
                                    //rhid_FeriasAno = getRhidFerias();                                   
                                } else if (tb === "#Tab5") {
                                    //getRhidDC();
                                }
                            });                        
                        
                    }
                };
                //GET DT.ADMISSAO                
            }
            //END Populate FILTERS Content :: Logic

            //Change FILTERS :: INSTANCES Propagation
            $("#rhidTMFilter").on("change", ":input",[{submit:false}], function (evt) {
                
                //Clean Horário Diário Graph
                cleanSheduleGraph();

                //console.log('Triggers by ' + evt.target.id);
                var rhid_, empresa_;
                
                //RHID changed...                
                if (evt.target.id === 'xt_RHID') {
                    rhid_ = $(this).val();
                    if (rhid_) {
                        getEMPRESA(rhid_);
                    } else { //Reset ao Valor
                        $('#xt_EMPRESA').val(rhid_).trigger('change').trigger('chosen:updated');
                    }
                }
                
                //EMPRESA changed...
                if (evt.target.id === 'xt_EMPRESA') {
                    rhid_ = $('#xt_RHID').val();
                    empresa_ = $(this).val();
                    if (empresa_ && rhid_) {
                        getDT_ADM(rhid_, empresa_);
                    } else { //Reset ao Valor
                        $('#xt_DT_ADMISSAO').val(rhid_).trigger('change').trigger('chosen:updated');
                    }
                }
            });
            //END Change FILTERS :: INSTANCES Propagation

            //Ausências
            if ( conf_TM['RH_ID_AUSENCIAS']["access"] ) {
                //BODY Trigger Ausencias -> BH
                $(document).on('click', 'button.transfAusBh', function (e) {
                    e.stopPropagation();
                    e.preventDefault();

                    var dados = $(this).data('ref');
                    if (dados) {
                        quad_notification_clear();
    /*
                        var wk = new Worker(pn + "lib/quad/workerAD.js"),
                            message = {
                                where: dados,
                                request_id: 'GERACAO_MASSIVA_PDI',
                                defaults: datatable_instance_defaults.pathToSqlFile
                            },
                            mssg = '';

                        wk.postMessage(JSON.stringify(message));
                        wk.onmessage = function (event) {                
                            if (event.data === 'working') {
                                RH_ID_AUSENCIAS.showProcess("<?php echo $ui_swift_absent_hb; ?>"); //Process ID;
                                return;
                            } else {
                                t1 = performance.now();
                                tmp = millisToMinutesAndSeconds(t1 - t0);
                                el.removeClass("disabled");

                                if (event.data) {
                                    if (event.data.msg) { 
                                        mssg = "<?php echo $msg_process_finished_ok; ?>";                                
                                        mssg = mssg.replace(" {0}", " " + tmp + " (MM:SS)");
                                        quad_notification({
                                            type: "success",
                                            title : JS_OPERATION_COMPLETED,
                                            content : '<i class="glyphicon glyphicon-thumbs-up"></i>&nbsp;<i>' + mssg + '</i>',
                                            timeout : 5000
                                        });
                                        $(this).prop("disabled", false);

                                    } else { //if (msg.indexOf("NOK:")) {
                                        var mssg = event.data.error;
                                        quad_notification({
                                            type: "error",
                                            title : JS_OPERATION_ERROR,
                                            content : '<i class="glyphicon glyphicon-thumbs-down"></i>&nbsp;<i>' + mssg + '</i>',
                                        });
                                        $(this).prop("disabled", false);
                                    }
                                }
                            }
                            RH_ID_AUSENCIAS.hideProcess();
                        };
    */
                    }                  
                });
                //END BODY Trigger Ausencias -> BH

                //Editor Fields CONTROL
                $(document).on('RH_ID_AUSENCIASAttachEvt', function (e) {
                    var frm_context = "#RH_ID_AUSENCIAS_editorForm", operacao = RH_ID_AUSENCIAS.editor.s["action"],
                        ok_style = {'display': 'block'}, nok_style = {'display': 'none'},
                        empresa_ = $('#xt_EMPRESA').val(), rhid_ = $('#xt_RHID').val(), dt_adm_ = $('#xt_DT_ADMISSAO').val();

                    //Função de cálculo da duração de um registo de Absentismo e inicialização nas colunas correspondentes
                    function duracao_absentismo (empresa_, rhid_, dt_adm_, dt_ini, dt_fim) {

                        //DURACAO :: Contabilização do registo
                        if (empresa_ && rhid_ && dt_adm_ && dt_ini && dt_fim) {
                            var tempoDetails = {
                                "tabela": 'RH_ID_AUSENCIAS',
                                "empresa": empresa_,
                                "rhid": rhid_,
                                "dt_adm": dt_adm_,
                                "dt_ini": dt_ini,
                                "dt_fim": dt_fim
                            }, resTime = getTimeDuration(tempoDetails);

                            /* restime = {DCAL: x, DUTS: y, MCAL: w, MUTS: u}
                             * DCAL (dias calendário), DUTS (dias úteis), MCAL (minutos calendário), MUTS (minutos úteis) 
                            */
                            resTime = JSON.parse(resTime);

                            //Clear (previous) ERROR 
                            $(".editorErrorContainer", frm_context).remove();
                            
                            //If NOT ERROR :: Distribute ATTRIBUTES throught FORM
                            if (resTime.error.length === 0) {
                                $('#DTE_Field_NR_CALENDARIO', frm_context).val( resTime['DCAL'] );
                                $('#DTE_Field_NR_UTEIS', frm_context).val( resTime['DUTS'] );
                                $('#DTE_Field_MIN_TOTAL', frm_context).val( resTime['MCAL'] );
                                $('#DTE_Field_NR_MINUTOS', frm_context).val( resTime['MUTS'] );
                            } else {
                                //ERROR DISPLAY
                                if ( $(frm_context).length ) {
                                    $(".editorErrorContainer").remove();
                                    $(frm_context)
                                            .append(
                                                    '<div class="editorErrorContainer"><div class="editorError">' +
                                                    resTime.error +
                                                    "</div></div>"
                                                    )
                                            .css("display", "block");
                                    $(".editorErrorContainer")
                                            .get(0)
                                            .scrollIntoView();
                                }                                
                            }
                        }
                        return;
                    }
                    
                    $('div.DTE_Field_Name_TIPO_REGISTO > div > div').css({'width': '40%'});
                    $('div.DTE_Field_Name_DSP_ESTADO > div > div').css({'width': '40%'});

                    $('#RH_ID_AUSENCIAS_editorForm > div > div.DTE_Field.row.DTE_Field_Type_select.DTE_Field_Name_DSP_AUSENCIA.visibleColumn > div > div.DTE_Field_InputControl').css({'width': '362px'});
                    //operacao ==> 'query', 'create', 'edit'

                    if (operacao === 'query') {
                        $('div.DTE_Body_Content').css({'max-height': '550px'});
                        $('div.none', frm_context).css(ok_style);
                    } else if (operacao === 'create') {
                        $('div.DTE_Body_Content').css({'max-height': 'auto'});
                        $('div.none:not(.DTE_Field_Name_OBS)', frm_context).css(nok_style);
                        
                        $('#DTE_Field_DT_INI', frm_context).on("change", function (e) {   
                            console.log('DT INI -> CREATE');
                            var reg, dia_ = $('#DTE_Field_DT_INI').val().split(' ')[0], hora_ = $('#DTE_Field_DT_INI', frm_context).val().split(' ')[1],                                
                                vlr_, unid_, aux;

                            reg = getHorarioDiarioDetails(empresa_, rhid_, dt_adm_, dia_);
                            reg = JSON.parse(reg);

                            if ( dia_ ) {
                                if ( $('#DTE_Field_DSP_AUSENCIA', frm_context).val() ) {
                                    unid_ = $('#DTE_Field_DSP_AUSENCIA', frm_context).find('option[value="' + $('#DTE_Field_DSP_AUSENCIA', frm_context).val() + '"]').data('othervalues').split('@')[0]; //UNIDADE_LIMITES@INCAPACIDADE
                                    if (unid_ === 'H') { //Horas
                                        if ( hora_ ) {
                                            if (hora_ > reg['e_1']) {
                                                vlr_ = dia_ + ' ' + hora_;
                                            } else {
                                                vlr_ = dia_ + ' ' + reg['e_1'];
                                            }
                                        } else {
                                            vlr_ = dia_ + ' ' + reg['e_1'];
                                        }
                                    } else { //Dias Calendário OU Úteis
                                        vlr_ = dia_ + ' ' + reg['inic_dia'];
                                    }
                                    $('#DTE_Field_DT_INI').val(vlr_);
                                }
                            }
                            
                            //DURACAO :: Contabilização do registo
                            var dt_ini = $('#DTE_Field_DT_INI').val(), dt_fim = $('#DTE_Field_DT_FIM').val();
                            duracao_absentismo (empresa_, rhid_, dt_adm_, dt_ini, dt_fim);   
                            
                        });                    
                        $('#DTE_Field_DT_FIM', frm_context).on("change", function (e) {
                            var reg, dia_ = $('#DTE_Field_DT_FIM').val().split(' ')[0], hora_ = $('#DTE_Field_DT_FIM', frm_context).val().split(' ')[1],                                
                                vlr_, unid_, aux, hr_fim;

                            reg = getHorarioDiarioDetails(empresa_, rhid_, dt_adm_, dia_);
                            reg = JSON.parse(reg);
                            if ( dia_ ) {
                                if ( $('#DTE_Field_DSP_AUSENCIA', frm_context).val() ) {
                                    unid_ = $('#DTE_Field_DSP_AUSENCIA', frm_context).find('option[value="' + $('#DTE_Field_DSP_AUSENCIA', frm_context).val() + '"]').data('othervalues').split('@')[0]; //UNIDADE_LIMITES@INCAPACIDADE
                                    if (unid_ === 'H') { //Horas
                                        if ( reg['s_2'] ) {
                                            hr_fim = reg['s_2'];
                                        } else {
                                            hr_fim = reg['s_1'];
                                        }
                                        if ( hora_ ) {
                                            if (hora_ < hr_fim) {
                                                vlr_ = dia_ + ' ' + hora_;
                                            } else {
                                                vlr_ = dia_ + ' ' + hr_fim;
                                            }
                                        } else {
                                            vlr_ = dia_ + ' ' + hr_fim;
                                        }
                                    } else { //Dias Calendário OU Úteis
                                        if (reg['inic_dia'] !== '00:00') {                                        
                                            vlr_ = nextDay(dia_) + ' ' + reg['inic_dia'];
                                        } else {
                                            vlr_ = dia_ + ' 23:59';
                                        }
                                    }
                                    $('#DTE_Field_DT_FIM').val(vlr_);
                                }
                            }
                            //DURACAO :: Contabilização do registo
                            var dt_ini = $('#DTE_Field_DT_INI').val(), dt_fim = $('#DTE_Field_DT_FIM').val();
                            duracao_absentismo (empresa_, rhid_, dt_adm_, dt_ini, dt_fim);                            
                        });
                        $('#DTE_Field_DSP_AUSENCIA', frm_context).on("change", function (e) {                        
                            var el = $(this);
                            if ( el.val() ) {
                                //GET OTHERVALUES
                                var aux = $(el, frm_context).find('option[value="' + $(el, frm_context).val() + '"]').data('othervalues'),
                                    //UNIDADE_LIMITES@INCAPACIDADE
                                    unid_  = aux.split('@')[0], 
                                    incap_ = aux.split('@')[1];
                                //Grau de Incapacidade é de preenchimento OBRIGATÓRIO ?
                                if (incap_ === 'S') { 
                                    //ADD VALIDATION REQUIRED
                                    setTimeout ( function() {     
                                        $('#DTE_Field_INCAPACIDADE')
                                            .rules('add', {
                                                required: true,
                                                messages: {
                                                    required: "<?php echo $error_required; ?>"
                                                }
                                        });
                                    }, 750);
                                    //Mostrar Incapacidade
                                    $('div.DTE_Field_Name_INCAPACIDADE', frm_context).css('display','block');
                                } else {
                                    //Esconder Incapacidade
                                    $('div.DTE_Field_Name_INCAPACIDADE', frm_context).css('display','none');
                                    setTimeout ( function() {     
                                        $('#DTE_Field_INCAPACIDADE').rules('remove', 'required');                             
                                    }, 750);
                                }
                                //DIAS INÍCIO e FIM já INDICADOS :: VALIDA/REFAZ UNIDADE da AUSÊNCIA
                                $('#DTE_Field_DT_INI').trigger('change');
                                $('#DTE_Field_DT_FIM').val('');
                                $('#DTE_Field_DT_FIM').focus();

                            } else {
                                $('#DTE_Field_DT_INI').val('');
                                $('#DTE_Field_DT_FIM').val('');
                                setTimeout ( function() {     
                                    $('#DTE_Field_INCAPACIDADE').rules('remove', 'required');                             
                                }, 750);                            
                            }
                        });

                    } else { //edit
                        $('div.DTE_Body_Content').css({'max-height': 'auto'});
                        $('div.none:not(.DTE_Field_Name_OBS)', frm_context).css(nok_style);
                        
                        //Se a INCAPACIDADE tiver VALOR MOSTRA-O
                        if ( $('#DTE_Field_INCAPACIDADE').val() ) {
                            //Mostrar Incapacidade
                            $('div.DTE_Field_Name_INCAPACIDADE', frm_context).css('display','block');
                        } else {
                            //Esconder Incapacidade
                            $('div.DTE_Field_Name_INCAPACIDADE', frm_context).css('display','none');
                        }
                        
                        /* POR pertencerem à CHAVE não podem ser ALTERADOS !!!
                        * ----------------------------------------------------
                        $('#DTE_Field_DT_INI', frm_context).on("change", function (e) {
                        console.log('DT INI -> EDIT');
                            var reg, dia_ = $('#DTE_Field_DT_INI').val().split(' ')[0], hora_ = $('#DTE_Field_DT_INI', frm_context).val().split(' ')[1],
                                rhid_ = $('#DTE_Field_RHID', frm_context).val(),
                                empresa_ = $('#DTE_Field_EMPRESA', frm_context).val(), dt_adm_ = $('#DTE_Field_DT_ADMISSAO', frm_context).val(),
                                vlr_, unid_, aux;
                        
                            //DURACAO :: Contabilização do registo
                            var dt_ini = $('#DTE_Field_DT_INI').val(), dt_fim = $('#DTE_Field_DT_FIM').val();
                            duracao_absentismo (empresa_, rhid_, dt_adm_, dt_ini, dt_fim);   
                            
                        });                          
                        
                        $('#DTE_Field_DT_FIM', frm_context).on("change", function (e) {
                            var reg, dia_ = $('#DTE_Field_DT_FIM').val().split(' ')[0], hora_ = $('#DTE_Field_DT_FIM', frm_context).val().split(' ')[1],
                                rhid_ = $('#DTE_Field_RHID', frm_context).val(),
                                empresa_ = $('#DTE_Field_EMPRESA', frm_context).val(), dt_adm_ = $('#DTE_Field_DT_ADMISSAO', frm_context).val(),
                                vlr_, unid_, aux, hr_fim;

                            //DURACAO :: Contabilização do registo
                            var dt_ini = $('#DTE_Field_DT_INI').val(), dt_fim = $('#DTE_Field_DT_FIM').val();
                            duracao_absentismo (empresa_, rhid_, dt_adm_, dt_ini, dt_fim);                            
                        });                        
                        */
                    }
                });
                //END Editor Fields CONTROL
            }
            //END Ausências
            
            //Adaptabilidade
            if ( conf_TM['RH_ID_DET_ADAPTABILIDADES']["access"] ) {
                
                //Estatísticas de Adaptabilidade
                function getRhidAdaptabilidade () {
                    var empresa_ = $('#xt_EMPRESA').val(), rhid_ = $('#xt_RHID').val(), dt_adm_ = $('#xt_DT_ADMISSAO').val();
                    if ( empresa_ && rhid_ && dt_adm_ ) {
                        var dados = {
                                empresa: empresa_,
                                rhid : rhid_,
                                dt_adm: dt_adm_
                        };

                        $.ajax({
                            type: "POST",
                            url:  "data-source/quad_requests_lib.php",
                            data: "request_id=getRhidAdaptabilidades"+
                                  "&params="+JSON.stringify(dados),
                            async: true,
                            cache: false,
                            success: function(res){
                                var rhid_data = JSON.parse(res), tot_cred, tmp_cred_wkf, tot_deb, tmp_deb_wkf, saldo, saldo_hrs, tmp, tool_tip = false;

                                //TOTAL Crédito (inclui em Workflow)
                                tmp = QuadTimeToMinutes( parseFloat(rhid_data["APROVADO_CRED"]) + parseFloat(rhid_data["WORKFLOW_CRED"]));
                                if (Array.isArray(tmp)) {
                                    tot_cred = tmp[0];
                                } else {
                                    tot_cred = tmp;
                                }
                                
                                //Crédito - Em Workflow
                                tmp = QuadTimeToMinutes(parseFloat(rhid_data["WORKFLOW_CRED"]));
                                if (Array.isArray(tmp)) {
                                    tmp_cred_wkf = tmp[0];
                                } else {
                                    tmp_cred_wkf = tmp;
                                }
                                
                                //TOTAL Débito (inclui em Workflow)
                                tmp = QuadTimeToMinutes( parseFloat(rhid_data["APROVADO_DEB"]) + parseFloat(rhid_data["WORKFLOW_DEB"]));
                                if (Array.isArray(tmp)) {
                                    tot_deb = tmp[0];
                                } else {
                                    tot_deb = tmp;
                                }
                                
                                //Débito - Em Workflow
                                tmp = QuadTimeToMinutes(parseFloat(rhid_data["WORKFLOW_DEB"]));
                                if (Array.isArray(tmp)) {
                                    tmp_deb_wkf = tmp[0];
                                } else {
                                    tmp_deb_wkf = tmp;
                                }
                                              
                                //SALDO TOTAL 
                                saldo = parseFloat(rhid_data["APROVADO_CRED"]) + parseFloat(rhid_data["WORKFLOW_CRED"]) - parseFloat(rhid_data["APROVADO_DEB"]) - parseFloat(rhid_data["WORKFLOW_DEB"]);
                                tmp = QuadTimeToMinutes(saldo);
                                if (Array.isArray(tmp)) {
                                    saldo_hrs = tmp[0];
                                } else {
                                    saldo_hrs = tmp;
                                }
                                
                                $('#AdaptabilidadeResume').html('').removeClass('hide');
                                var line_stats = '';
                                
                                //Crédito
                                line_stats =  '<div class="subheader-block d-lg-flex align-items-center">' +
                                                    '<div class="d-inline-flex flex-column justify-content-center mr-3"> ' +
                                                    '    <span class="fw-300 fs-xs d-block opacity-50"> ' +
                                                    '        <small>' + "<?php echo mb_strtoupper($ui_credit, 'UTF-8'); ?>" + '</small> ' +
                                                    '    </span> ' +
                                                    '    <span class="fw-500 fs-xl d-block color-success-500"> ' +
                                                    '        <i class="far fa-plus"></i>&nbsp;' + tot_cred;
                                            
                                if ( parseFloat(rhid_data["WORKFLOW_CRED"]) != 0) {
                                    tool_tip = true;
                                    var info = "<?php echo $ui_workflow_includes_hours; ?>";
                                    info = info.replace('{0}', tmp_cred_wkf);
                                    line_stats +=   '<label class="label label-warning wkf_info" rel="tooltip" data-placement="auto" title="' + info + '"> ' + tmp_cred_wkf + '</label>';
                                }
                                line_stats +=   '    </span></div></div>';
                              
                                //Débito
                                line_stats +=  '<div class="subheader-block d-lg-flex align-items-center border-faded border-right-0 border-top-0 border-bottom-0 pl-3">' +
                                                    '<div class="d-inline-flex flex-column justify-content-center mr-3"> ' +
                                                    '    <span class="fw-300 fs-xs d-block opacity-50"> ' +
                                                    '        <small>' + "<?php echo mb_strtoupper($ui_debt, 'UTF-8'); ?>" + '</small> ' +
                                                    '    </span> ' +
                                                    '    <span class="fw-500 fs-xl d-block color-danger-500"> ' +
                                                    '        <i class="far fa-minus"></i>&nbsp;' + tot_deb;
                                            
                                if ( parseFloat(rhid_data["WORKFLOW_DEB"]) != 0) { 
                                    tool_tip = true;
                                    var info = "<?php echo $ui_workflow_includes_hours; ?>";
                                    info = info.replace('{0}', tmp_deb_wkf);
                                    line_stats +=   '<label class="label label-warning wkf_info" rel="tooltip" data-placement="auto" title="' + info + '"> ' + tmp_deb_wkf + '</label>';
                                }
                                line_stats +=   '    </span></div></div>';
                                
                                //Saldo
                                line_stats +=  '<div class="subheader-block d-lg-flex align-items-center border-faded border-right-0 border-top-0 border-bottom-0 pl-3">' +
                                                    '<div class="d-inline-flex flex-column justify-content-center mr-3"> ' +
                                                    '    <span class="fw-300 fs-xs d-block opacity-50"> ' +
                                                    '        <small>' + "<?php echo mb_strtoupper($ui_balance, 'UTF-8'); ?>" + '</small> ' +
                                                    '    </span> ' +
                                                    '    <span class="fw-500 fs-xl d-block color-primary-500"> ' +
                                                    '        <i class="far fa-equals"></i>&nbsp;' + saldo_hrs + 
                                                    '    </span> ' +
                                                    '</div></div>';                                

                                $('#AdaptabilidadeResume').html(line_stats).fadeIn("slow");
                                if ( tool_tip) { 
                                    $("[rel=tooltip]").tooltip();
                                }
                            }
                        });                        
                        return;
                    }
                }
                
                $('a[href="#Tab2"]').on('shown.bs.tab', function (e) {
                    var empresa_ = $('#xt_EMPRESA').val(), rhid_ = $('#xt_RHID').val(), dt_adm_ = $('#xt_DT_ADMISSAO').val();
                    if (empresa_ && rhid_ && dt_adm_) {
                        //Called by footerCallback on RH_ID_DET_ADAPTABILIDADES instance
                        //getRhidAdaptabilidade();                        
                    } else {
                        $('#RH_ID_DET_ADAPTABILIDADES_wrapper > img').remove();
                    }
                });
                
                //Débitos :: Editor Fields CONTROL
                $(document).on('RH_ID_DET_ADAPTABILIDADESAttachEvt', function (e) {
                    var frm_context = "#RH_ID_DET_ADAPTABILIDADES_editorForm", operacao = RH_ID_DET_ADAPTABILIDADES.editor.s["action"],
                        ok_style = {'display': 'block'}, nok_style = {'display': 'none'},
                        empresa_ = $('#xt_EMPRESA').val(), rhid_ = $('#xt_RHID').val(), dt_adm_ = $('#xt_DT_ADMISSAO').val();
                    
                    //Função de cálculo da duração de um registo de Adaptabilidade
                    function duracao_adaptabilidade (empresa_, rhid_, dt_adm_, dt_ini, dt_fim, tp_registo) {

                        //DURACAO :: Contabilização do registo
                        if (empresa_ && rhid_ && dt_adm_ && dt_ini && dt_fim && tp_registo) {
                            var tempoDetails = {
                                "tabela": 'RH_ID_DET_ADAPTABILIDADES',
                                "empresa": empresa_,
                                "rhid": rhid_,
                                "dt_adm": dt_adm_,
                                "dt_ini": dt_ini,
                                "dt_fim": dt_fim,
                                "tp_ocorrencia": tp_registo
                            }, resTime = getTimeDuration(tempoDetails);

                            /* restime = {DCAL: x, DUTS: y, MCAL: w, MUTS: u}
                             * DCAL (dias calendário), DUTS (dias úteis), MCAL (minutos calendário), MUTS (minutos úteis) 
                            */
                            resTime = JSON.parse(resTime);

                            //Clear (previous) ERROR 
                            $(".editorErrorContainer", frm_context).remove();
                            
                            //If NOT ERROR :: Distribute ATTRIBUTES throught FORM
                            if (resTime.error.length === 0) {
                                $('#DTE_Field_DURACAO_MINUTOS').val( resTime['MUTS'] );
                            } else {
                                //ERROR DISPLAY
                                if ( $(frm_context).length ) {
                                    $(".editorErrorContainer").remove();
                                    $(frm_context)
                                            .append(
                                                    '<div class="editorErrorContainer"><div class="editorError">' +
                                                    resTime.error +
                                                    "</div></div>"
                                                    )
                                            .css("display", "block");
                                    $(".editorErrorContainer")
                                            .get(0)
                                            .scrollIntoView();
                                }                                
                            }
                        }
                        return;
                    }
                        
                    //operacao ==> 'query', 'create', 'edit'
                    if (operacao === 'create') {
                        
                        //A duração é calculada por procedimento específico ( Event RH_ID_DET_ADAPTABILIDADES.DT FIM )
                        $('#DTE_Field_DURACAO_MINUTOS').attr('disabled', true);
                        
                        //Event RH_ID_DET_ADAPTABILIDADES.DT_INI
                        $('#DTE_Field_DT_INI_DET', frm_context).on("change", function (e) {                    
                            var reg, dia_ = $('#DTE_Field_DT_INI_DET').val().split(' ')[0], hora_ = $('#DTE_Field_DT_INI_DET', frm_context).val().split(' ')[1],
                                rhid_ = $('#DTE_Field_RHID', frm_context).val(),
                                empresa_ = $('#DTE_Field_EMPRESA', frm_context).val(), dt_adm_ = $('#DTE_Field_DT_ADMISSAO', frm_context).val(),
                                tp_registo = $('#DTE_Field_TP_OCORRENCIA').val(), vlr_, unid_, aux;

                            if ( (tp_registo === 'FD') || (tp_registo === 'HD') ) {
                                reg = getHorarioDiarioDetails(empresa_, rhid_, dt_adm_, dia_);
                                reg = JSON.parse(reg);
                                if ( dia_ ) {
                                    if ( hora_ ) {
                                        if (hora_ > reg['e_1']) {
                                            vlr_ = dia_ + ' ' + hora_;
                                        } else {
                                            vlr_ = dia_ + ' ' + reg['e_1'];
                                        }
                                    } else {
                                        vlr_ = dia_ + ' ' + reg['e_1'];
                                    }
                                    $('#DTE_Field_DT_INI_DET').val(vlr_);
                                }
                            }
                            
                            //DURACAO :: Contabilização do registo
                            var dt_ini = $('#DTE_Field_DT_INI_DET').val(), dt_fim = $('#DTE_Field_DT_FIM_DET').val();
                            duracao_adaptabilidade (empresa_, rhid_, dt_adm_, dt_ini, dt_fim, tp_registo);                            
                            
                        });
                        
                        //Event RH_ID_DET_ADAPTABILIDADES.DT FIM
                        $('#DTE_Field_DT_FIM_DET', frm_context).on("change", function (e) {
                            var reg, dia_ = $('#DTE_Field_DT_FIM_DET').val().split(' ')[0], hora_ = $('#DTE_Field_DT_FIM_DET', frm_context).val().split(' ')[1],                                
                                tp_registo = $('#DTE_Field_TP_OCORRENCIA').val(), vlr_, unid_, aux, hr_fim;
                            reg = getHorarioDiarioDetails(empresa_, rhid_, dt_adm_, dia_);
                            reg = JSON.parse(reg);
                            
                            if ( (tp_registo === 'FD') || (tp_registo === 'HD') ) {                            
                                if ( dia_ ) {
                                    if ( reg['s_2'] ) {
                                        hr_fim = reg['s_2'];
                                    } else {
                                        hr_fim = reg['s_1'];
                                    }
                                    if ( hora_ ) {
                                        if (hora_ < hr_fim) {
                                            vlr_ = dia_ + ' ' + hora_;
                                        } else {
                                            vlr_ = dia_ + ' ' + hr_fim;
                                        }
                                    } else {
                                        vlr_ = dia_ + ' ' + hr_fim;
                                    }
                                    $('#DTE_Field_DT_FIM_DET').val(vlr_);
                                }
                            }
                            
                            //DURACAO :: Contabilização do registo
                            var dt_ini = $('#DTE_Field_DT_INI_DET').val(), dt_fim = $('#DTE_Field_DT_FIM_DET').val();
                            duracao_adaptabilidade (empresa_, rhid_, dt_adm_, dt_ini, dt_fim, tp_registo);
                        });                        
                    } else if (operacao === 'edit') {
                        //Event RH_ID_DET_ADAPTABILIDADES.DT FIM
                        $('#DTE_Field_DT_FIM_DET', frm_context).on("change", function (e) {
                            var reg, dia_ = $('#DTE_Field_DT_FIM_DET').val().split(' ')[0], hora_ = $('#DTE_Field_DT_FIM_DET', frm_context).val().split(' ')[1],                                
                                tp_registo = $('#DTE_Field_TP_OCORRENCIA').val(), vlr_, unid_, aux, hr_fim;
                            reg = getHorarioDiarioDetails(empresa_, rhid_, dt_adm_, dia_);
                            reg = JSON.parse(reg);
                            
                            if ( (tp_registo === 'FD') || (tp_registo === 'HD') ) {                            
                                if ( dia_ ) {
                                    if ( reg['s_2'] ) {
                                        hr_fim = reg['s_2'];
                                    } else {
                                        hr_fim = reg['s_1'];
                                    }
                                    if ( hora_ ) {
                                        if (hora_ < hr_fim) {
                                            vlr_ = dia_ + ' ' + hora_;
                                        } else {
                                            vlr_ = dia_ + ' ' + hr_fim;
                                        }
                                    } else {
                                        vlr_ = dia_ + ' ' + hr_fim;
                                    }
                                    $('#DTE_Field_DT_FIM_DET').val(vlr_);
                                }
                            }
                            
                            //DURACAO :: Contabilização do registo
                            var dt_ini = $('#DTE_Field_DT_INI_DET').val(), dt_fim = $('#DTE_Field_DT_FIM_DET').val();
                            duracao_adaptabilidade (empresa_, rhid_, dt_adm_, dt_ini, dt_fim, tp_registo);
                        });                        
                    } 
                    
                });
                //END Débitos :: Editor Fields CONTROL                
            }            
            
            //Trab. Suplementar
            if ( conf_TM['RH_ID_TS_HV']["access"] ) {
            
                //Get QUANTIDADE em minutos de TS APROVADO e em Workflow
                function getRhidTS () {
                    var empresa_ = $('#xt_EMPRESA').val(), rhid_ = $('#xt_RHID').val(), dt_adm_ = $('#xt_DT_ADMISSAO').val(),
                        AnoAberto = getQim('DG_ANOS', empresa_);
   
                    //ANO "CORRENTE"
                    if ( empresa_ && rhid_ && dt_adm_ ) {
                        var dados = {
                                empresa: empresa_,
                                rhid : rhid_,
                                dt_adm: dt_adm_,
                                ano: AnoAberto['ANO']
                        };

                        $.ajax({
                            type: "POST",
                            url:  "data-source/quad_requests_lib.php",
                            data: "request_id=getRhidTS"+
                                  "&params="+JSON.stringify(dados),
                            async: true,
                            cache: false,
                            success: function(res){
                                var rhid_TS = JSON.parse(res), tmp_aprov, tmp_wkf, tmp;
                                
                                //Aprovado
                                tmp = QuadTimeToMinutes(parseFloat(rhid_TS["TOT_APROVADO"]));
                                if (Array.isArray(tmp)) {
                                    tmp_aprov = tmp[0];
                                } else {
                                    tmp_aprov = tmp;
                                }
                                
                                //Em Workflow
                                tmp = QuadTimeToMinutes(parseFloat(rhid_TS["TOT_WKF"]));
                                if (Array.isArray(tmp)) {
                                    tmp_wkf = tmp[0];
                                } else {
                                    tmp_wkf = tmp;
                                }
                                
                                $('#TSResume').html('').removeClass('hide');
                                var ts_stats =  '<div class="subheader-block d-lg-flex align-items-center">' +
                                                    '<div class="d-inline-flex flex-column justify-content-center mr-3"> ' +
                                                    '    <span class="fw-300 fs-xs d-block opacity-50"> ' +
                                                    '        <small>' + "<?php echo mb_strtoupper($ui_approved, 'UTF-8'); ?>" + '</small> ' +
                                                    '    </span> ' +
                                                    '    <span class="fw-500 fs-xl d-block color-success-500"> ' +
                                                    '        <i class="far fa-user-check"></i>&nbsp;' + tmp_aprov +
                                                    '</span></div></div>';
                                            
                                ts_stats +=  '<div class="subheader-block d-lg-flex align-items-center border-faded border-right-0 border-top-0 border-bottom-0 pl-3">' +
                                                    '<div class="d-inline-flex flex-column justify-content-center mr-3"> ' +
                                                    '    <span class="fw-300 fs-xs d-block opacity-50"> ' +
                                                    '        <small>' + "<?php echo mb_strtoupper($ui_workflow, 'UTF-8'); ?>" + '</small> ' +
                                                    '    </span> ' +
                                                    '    <span class="fw-500 fs-xl d-block color-warning-900"> ' +
                                                    '        <i class="far fa-user-cog"></i>&nbsp;' + tmp_wkf +
                                                    '</span></div></div>';
                                            
                                            
                                $('#TSResume').html(ts_stats).fadeIn("slow");                                
                            }
                        });                        
                        return;
                    }
                }            

                $('a[href="#Tab3"]').on('shown.bs.tab', function (e) {
                    var empresa_ = $('#xt_EMPRESA').val(), rhid_ = $('#xt_RHID').val(), dt_adm_ = $('#xt_DT_ADMISSAO').val();
                    if (empresa_ && rhid_ && dt_adm_) {
                        getRhidTS();
                    } else {
                        $('#RH_ID_FERIAS_wrapper > img').remove();
                    }
                });
                
                //BODY Trigger TS -> BH
                $(document).on('click', 'button.transfTsBh', function (e) {
                    e.stopPropagation();
                    e.preventDefault();

                    var dados = $(this).data('ref');
                    if (dados) {
                        quad_notification_clear();
    /*
                        var wk = new Worker(pn + "lib/quad/workerAD.js"),
                            message = {
                                where: dados,
                                request_id: 'GERACAO_MASSIVA_PDI',
                                defaults: datatable_instance_defaults.pathToSqlFile
                            },
                            mssg = '';

                        wk.postMessage(JSON.stringify(message));
                        wk.onmessage = function (event) {                
                            if (event.data === 'working') {
                                RH_ID_AUSENCIAS.showProcess("<?php echo $ui_swift_absent_hb; ?>"); //Process ID;
                                return;
                            } else {
                                t1 = performance.now();
                                tmp = millisToMinutesAndSeconds(t1 - t0);
                                el.removeClass("disabled");

                                if (event.data) {
                                    if (event.data.msg) { 
                                        mssg = "<?php echo $msg_process_finished_ok; ?>";                                
                                        mssg = mssg.replace(" {0}", " " + tmp + " (MM:SS)");
                                        quad_notification({
                                            type: "success",
                                            title : JS_OPERATION_COMPLETED,
                                            content : '<i class="glyphicon glyphicon-thumbs-up"></i>&nbsp;<i>' + mssg + '</i>',
                                            timeout : 5000
                                        });
                                        $(this).prop("disabled", false);

                                    } else { //if (msg.indexOf("NOK:")) {
                                        var mssg = event.data.error;
                                        quad_notification({
                                            type: "error",
                                            title : JS_OPERATION_ERROR,
                                            content : '<i class="glyphicon glyphicon-thumbs-down"></i>&nbsp;<i>' + mssg + '</i>',
                                        });
                                        $(this).prop("disabled", false);
                                    }
                                }
                            }
                            RH_ID_AUSENCIAS.hideProcess();
                        };
    */
                    }                  
                });
                //END BODY Trigger TS -> BH
                
                //Editor Fields CONTROL
                $(document).on('RH_ID_TSAttachEvt', function (e) {
                    var frm_context = "#RH_ID_TS_editorForm", operacao = RH_ID_TS.editor.s["action"],
                        empresa_ = $('#xt_EMPRESA').val(), rhid_ = $('#xt_RHID').val(), dt_adm_ = $('#xt_DT_ADMISSAO').val();
                        
                    //Função de cálculo da duração de um registo de Absentismo e inicialização nas colunas correspondentes
                    function duracao_ts_hv (empresa_, rhid_, dt_adm_, dt_ini, dt_fim) {
                        //DURACAO :: Contabilização do registo
                        if (empresa_ && rhid_ && dt_adm_ && dt_ini && dt_fim) {
                            var tempoDetails = {
                                "tabela": 'RH_ID_TS_HV',
                                "empresa": empresa_,
                                "rhid": rhid_,
                                "dt_adm": dt_adm_,
                                "dt_ini": dt_ini,
                                "dt_fim": dt_fim
                            }, resTime = getTimeDuration(tempoDetails);

                            /* restime = {DCAL: x, DUTS: y, MCAL: w, MUTS: u}
                             * DCAL (dias calendário), DUTS (dias úteis), MCAL (minutos calendário), MUTS (minutos úteis) 
                            */
                            resTime = JSON.parse(resTime);

                            //Clear (previous) ERROR 
                            $(".editorErrorContainer", frm_context).remove();
                            
                            //If NOT ERROR :: Distribute ATTRIBUTES throught FORM
                            if (resTime.error.length === 0) {
                                $('#DTE_Field_DURACAO', frm_context).val( resTime['MUTS'] );
                            } else {
                                //ERROR DISPLAY
                                if ( $(frm_context).length ) {
                                    $(".editorErrorContainer").remove();
                                    $(frm_context)
                                            .append(
                                                    '<div class="editorErrorContainer"><div class="editorError">' +
                                                    resTime.error +
                                                    "</div></div>"
                                                    )
                                            .css("display", "block");
                                    $(".editorErrorContainer")
                                            .get(0)
                                            .scrollIntoView();
                                }                                
                            }
                        }
                        return;
                    }
                    if (operacao === 'query') {
                        setTimeout( function() {
                            $('#DTE_Field_DURACAO', frm_context).attr('disabled', false);
                        }, 500);
                        
                    } else if (operacao === 'create') {
                        setTimeout( function() {
                            $('#DTE_Field_DURACAO', frm_context).attr('disabled', true);
                        }, 250);
                        $('#DTE_Field_DT_INI', frm_context).on("change", function (e) {   
                            //DURACAO :: Contabilização do registo
                            var dt_ini = $('#DTE_Field_DT_INI', frm_context).val(), dt_fim = $('#DTE_Field_DT_FIM', frm_context).val();
                            duracao_ts_hv (empresa_, rhid_, dt_adm_, dt_ini, dt_fim);                               
                        });                    
                        $('#DTE_Field_DT_FIM', frm_context).on("change", function (e) {
                            //DURACAO :: Contabilização do registo
                            var dt_ini = $('#DTE_Field_DT_INI', frm_context).val(), dt_fim = $('#DTE_Field_DT_FIM', frm_context).val();
                            duracao_ts_hv (empresa_, rhid_, dt_adm_, dt_ini, dt_fim);                             
                        });

                    } else { //edit
                        /* POR pertencer à CHAVE não podem ser ALTERADOS !!!
                        * ----------------------------------------------------
                        $('#DTE_Field_DT_INI', frm_context).on("change", function (e) {   
                            var rhid_ = $('#DTE_Field_RHID', frm_context).val(),
                                empresa_ = $('#DTE_Field_EMPRESA', frm_context).val(), dt_adm_ = $('#DTE_Field_DT_ADMISSAO', frm_context).val();

                            //DURACAO :: Contabilização do registo
                            var dt_ini = $('#DTE_Field_DT_INI', frm_context).val(), dt_fim = $('#DTE_Field_DT_FIM', frm_context).val();
                            duracao_ts_hv (empresa_, rhid_, dt_adm_, dt_ini, dt_fim);                               
                        }); 
                        */
                        setTimeout( function() {
                            $('#DTE_Field_DURACAO', frm_context).attr('disabled', true);
                        }, 250);                       
                        $('#DTE_Field_DT_FIM', frm_context).on("change", function (e) {
                            //DURACAO :: Contabilização do registo
                            var dt_ini = $('#DTE_Field_DT_INI', frm_context).val(), dt_fim = $('#DTE_Field_DT_FIM', frm_context).val();
                            duracao_ts_hv (empresa_, rhid_, dt_adm_, dt_ini, dt_fim);                                
                        });                    
                        
                    }
                });
                //END Editor Fields CONTROL
                
            }
            //END Trab. suplementar
            
            //Férias
            if ( conf_TM['RH_ID_FERIAS']["access"] ) {
            
                //Get RH_ID_ANOS
                function getRhidFerias () {
                    var empresa_ = $('#xt_EMPRESA').val(), rhid_ = $('#xt_RHID').val(), dt_adm_ = $('#xt_DT_ADMISSAO').val(),
                        AnoAberto = getQim('DG_ANOS', empresa_);
   
                    //ANO "CORRENTE"
                    if ( empresa_ && rhid_ && dt_adm_ ) {
                        //params['RH_UNID_VAL_FER']; -> DESCONTINUADO :: SEMPRE DIAS [U]teis!!
                        var dados = {
                                empresa: empresa_,
                                rhid : rhid_,
                                dt_adm: dt_adm_,
                                ano: AnoAberto['ANO']
                        };

                        $.ajax({
                            type: "POST",
                            url:  "data-source/quad_requests_lib.php",
                            data: "request_id=getRhidFerias"+
                                  "&params="+JSON.stringify(dados),
                            async: false,
                            cache: false,
                            success: function(res){
                                rhid_FeriasAno = JSON.parse(res);                                
                                //console.log(rhid_FeriasAno);     
                                $('#FeriasResume').html('').removeClass('hide');
                                var total_creditos = parseFloat(rhid_FeriasAno["CRED_ANO"]) + parseFloat(rhid_FeriasAno["CRED_ANO_ANTERIOR"]) + parseFloat(rhid_FeriasAno["CRED_ACRESCIMO"]),
                                    por_marcar = total_creditos - parseFloat(rhid_FeriasAno["TOT_DIAS"]);
                            
                                var ferias_stats =  '<div class="subheader-block d-lg-flex align-items-center">' +
                                                    '  <div class="d-inline-flex flex-column justify-content-center mr-3"> ' +
                                                    '    <span class="fw-300 fs-xs d-block opacity-50"> ' +
                                                    '        <small>' + parseInt(AnoAberto['ANO']-1) + '</small> ' +
                                                    '    </span> ' +
                                                    '    <span class="fw-500 fs-xl d-block color-success-500"> ' +
                                                    '        <i class="far fa-plus"></i>&nbsp;' + rhid_FeriasAno["CRED_ANO_ANTERIOR"] +
                                                    '    </span></div></div>';
                                ferias_stats +=  '<div class="subheader-block d-lg-flex align-items-center border-faded border-right-0 border-top-0 border-bottom-0 pl-3">' +
                                                    '  <div class="d-inline-flex flex-column justify-content-center mr-3"> ' +
                                                    '    <span class="fw-300 fs-xs d-block opacity-50"> ' +
                                                    '        <small>' + parseInt(AnoAberto['ANO']) + '</small> ' +
                                                    '    </span> ' +
                                                    '    <span class="fw-500 fs-xl d-block color-success-500"> ' +
                                                    '        <i class="far fa-plus"></i>&nbsp;' + rhid_FeriasAno["CRED_ANO"] +
                                                    '    </span></div></div>';

                                ferias_stats +=  '<div class="subheader-block d-lg-flex align-items-center border-faded border-right-0 border-top-0 border-bottom-0 pl-3">' +
                                                    '  <div class="d-inline-flex flex-column justify-content-center mr-3"> ' +
                                                    '    <span class="fw-300 fs-xs d-block opacity-50"> ' +
                                                    '        <small>' + "<?php echo mb_strtoupper($ui_addition, 'UTF-8'); ?>" + '</small> ' +
                                                    '    </span> ' +
                                                    '    <span class="fw-500 fs-xl d-block color-success-500"> ' +
                                                    '        <i class="far fa-plus"></i>&nbsp;' + rhid_FeriasAno["CRED_ACRESCIMO"] +
                                                    '    </span></div></div>';

                                ferias_stats +=  '<div class="subheader-block d-lg-flex align-items-center border-faded border-right-0 border-top-0 border-bottom-0 pl-3">' +
                                                    '  <div class="d-inline-flex flex-column justify-content-center mr-3"> ' +
                                                    '    <span class="fw-300 fs-xs d-block opacity-50"> ' +
                                                    '        <small>' + "<?php echo mb_strtoupper($ui_dues, 'UTF-8'); ?>" + '</small> ' +
                                                    '    </span> ' +
                                                    '    <span class="fw-500 fs-xl d-block color-success-500"> ' +
                                                    '        <i class="far fa-equals"></i>&nbsp;' + total_creditos +
                                                    '    </span></div></div>';

                                ferias_stats +=  '<div class="subheader-block d-lg-flex align-items-center border-faded border-right-0 border-top-0 border-bottom-0 pl-3">' +
                                                    '<div class="d-inline-flex flex-column justify-content-center mr-3"> ' +
                                                    '    <span class="fw-300 fs-xs d-block opacity-50"> ' +
                                                    '        <small>' + "<?php echo mb_strtoupper($ui_marked, 'UTF-8'); ?>" + '</small> ' +
                                                    '    </span> ' +
                                                    '    <span class="fw-500 fs-xl d-block color-danger-500"> ' +
                                                    '        <i class="far fa-minus"></i>&nbsp;' + parseFloat(rhid_FeriasAno["TOT_DIAS"]);
                                if ( parseFloat(rhid_FeriasAno["TOT_WKF"]) != 0) { 
                                    tool_tip = true;
                                    var info = "<?php echo $ui_workflow_includes_work_days; ?>";
                                    info = info.replace('{0}', parseFloat(rhid_FeriasAno["TOT_WKF"]));
                                    ferias_stats +=   '<label class="label label-warning wkf_info" rel="tooltip" data-placement="auto" title="'  + info + '"> ' + parseFloat(rhid_FeriasAno["TOT_WKF"]) + '</label>';
                                }
                                ferias_stats +=   '    </span></div></div>';
                                
                                ferias_stats +=  '<div class="subheader-block d-lg-flex align-items-center border-faded border-right-0 border-top-0 border-bottom-0 pl-3">' +
                                                    '<div class="d-inline-flex flex-column justify-content-center mr-3"> ' +
                                                    '    <span class="fw-300 fs-xs d-block opacity-50"> ' +
                                                    '        <small>' + "<?php echo mb_strtoupper($ui_unmarked, 'UTF-8'); ?>" + '</small> ' +
                                                    '    </span> ' +
                                                    '    <span class="fw-500 fs-xl d-block color-primary-500"> ' +
                                                    '        <i class="far fa-equals"></i>&nbsp;' + por_marcar + 
                                                    '    </span> ' +
                                                    '</div></div>';

                                $('#FeriasResume').html(ferias_stats).fadeIn("slow");
                                if ( parseFloat(rhid_FeriasAno["TOT_WKF"]) > 0) { 
                                    $("[rel=tooltip]").tooltip();
                                }
                            }
                        });                        
                        return rhid_FeriasAno;
                    }
                }
                        
                //Editor Fields CONTROL
                $(document).on('RH_ID_FERIASAttachEvt', function (e) {
                    var frm_context = "#RH_ID_FERIAS_editorForm", operacao = RH_ID_FERIAS.editor.s["action"], unid_,
                        empresa_ = $('#xt_EMPRESA').val(), rhid_ = $('#xt_RHID').val(), dt_adm_ = $('#xt_DT_ADMISSAO').val(),
                        AnoAberto = getQim('DG_ANOS', empresa_);

                    //Função de cálculo da duração de um registo de Férias e inicialização na coluna correspondentes
                    function duracao_ferias (empresa_, rhid_, dt_adm_, dt_ini, dt_fim) {

                        //DURACAO :: Contabilização do registo
                        if (empresa_ && rhid_ && dt_adm_ && dt_ini && dt_fim) {
                            var tempoDetails = {
                                "tabela": 'RH_ID_FERIAS',
                                "empresa": empresa_,
                                "rhid": rhid_,
                                "dt_adm": dt_adm_,
                                "dt_ini": dt_ini,
                                "dt_fim": dt_fim
                            }, resTime = getTimeDuration(tempoDetails);

                            /* restime = {DCAL: x, DUTS: y, MCAL: w, MUTS: u}
                             * DCAL (dias calendário), DUTS (dias úteis), MCAL (minutos calendário), MUTS (minutos úteis) 
                            */
                            resTime = JSON.parse(resTime);

                            //Clear (previous) ERROR 
                            $(".editorErrorContainer", frm_context).remove();
                            
                            //If NOT ERROR :: Distribute ATTRIBUTES throught FORM
                            if (resTime.error.length === 0) {
                                $('#DTE_Field_NR_DIAS_UTEIS', frm_context).val( resTime['DUTS'] );
                            } else {
                                //ERROR DISPLAY
                                if ( $(frm_context).length ) {
                                    $(".editorErrorContainer").remove();
                                    $(frm_context)
                                            .append(
                                                    '<div class="editorErrorContainer"><div class="editorError">' +
                                                    resTime.error +
                                                    "</div></div>"
                                                    )
                                            .css("display", "block");
                                    $(".editorErrorContainer")
                                            .get(0)
                                            .scrollIntoView();
                                }                                
                            }
                        }
                        return;
                    }
                    
                    //ANO "CORRENTE"
                    if ( empresa_ && rhid_ && dt_adm_ ) {
                        
                        //operacao ==> 'query', 'create', 'edit'
                        if (operacao === 'create' || operacao === 'edit') {

                            $('#DTE_Field_ANO', frm_context).val(AnoAberto['ANO']).attr('disabled', true);
                            if (AnoAberto['RH_MEIOS_DIAS_FERIAS'] === 'S') { //Permite MEIOS DIAS de Férias, contraria o DEFAULT definido na instância
                                //Redefine Instance DATATYPES
                                RH_ID_FERIAS.tableCols[5].datatype = "datetimeShort";
                                RH_ID_FERIAS.tableCols[6].datatype = "datetimeShort";
                                RH_ID_FERIAS.dbColumns[4].datatype = "datetimeShort";
                                RH_ID_FERIAS.dbColumns[5].datatype = "datetimeShort";

                                setTimeout( function() {
                                    //Data Início TRANSFORM
                                    $('#DTE_Field_DT_INI', frm_context).rules('remove', 'dateISO');
                                    $('#DTE_Field_DT_INI', frm_context).rules('add', {datetimeShort: true});
                                    $('#DTE_Field_DT_INI', frm_context).removeClass('datepicker').addClass('dateTimePickerShort minutes');                                
                                    $("#DTE_Field_DT_INI").datepicker("destroy");                                
                                    $("#DTE_Field_DT_INI", frm_context).datetimepicker({
                                        prevText: '<i class="fa fa-chevron-left"></i>',
                                        nextText: '<i class="fa fa-chevron-right"></i>',
                                        timeFormat: quadConfig.dateTimePickerTimeFormatShort,
                                        dateFormat: quadConfig.datePickerFormat,
                                        timeInput: true,
                                        onSelect: function (dateText) {
                                            if (dateText) {
                                                $(this).trigger('change'); //PMA, 2019.12.26
                                            }
                                        }
                                    });
                                    $('#DTE_Field_DT_INI', frm_context).removeClass('error');

                                    //Data fim TRANSFORM
                                    $('#DTE_Field_DT_FIM', frm_context).rules('remove', 'dateISO');
                                    $('#DTE_Field_DT_FIM', frm_context).rules('add', {datetimeShort: true});
                                    $('#DTE_Field_DT_FIM', frm_context).removeClass('datepicker').addClass('dateTimePickerShort minutes');                                
                                    $("#DTE_Field_DT_FIM").datepicker("destroy");                                
                                    $("#DTE_Field_DT_FIM", frm_context).datetimepicker({
                                        prevText: '<i class="fa fa-chevron-left"></i>',
                                        nextText: '<i class="fa fa-chevron-right"></i>',
                                        timeFormat: quadConfig.dateTimePickerTimeFormatShort,
                                        dateFormat: quadConfig.datePickerFormat,
                                        timeInput: true,
                                        onSelect: function (dateText) {
                                            if (dateText) {
                                                $(this).trigger('change'); //PMA, 2019.12.26
                                            }
                                        }
                                    });
                                    $('#DTE_Field_DT_FIM', frm_context).removeClass('error');
                                }, 350);
                            } else {
                                //Redefine Instance DATATYPES
                                RH_ID_FERIAS.tableCols[5].datatype = "date";
                                RH_ID_FERIAS.tableCols[6].datatype = "date";
                                RH_ID_FERIAS.dbColumns[4].datatype = "date";
                                RH_ID_FERIAS.dbColumns[5].datatype = "date";                            
                            }

                            $('#DTE_Field_DT_INI', frm_context).on("change", function (e) {
                                //DURACAO :: Contabilização do registo
                                var dt_ini = $('#DTE_Field_DT_INI').val(), dt_fim = $('#DTE_Field_DT_FIM').val();
                                duracao_ferias (empresa_, rhid_, dt_adm_, dt_ini, dt_fim);   
                            });
                            
                            $('#DTE_Field_DT_FIM', frm_context).on("change", function (e) {
                                //DURACAO :: Contabilização do registo
                                var dt_ini = $('#DTE_Field_DT_INI').val(), dt_fim = $('#DTE_Field_DT_FIM').val();
                                duracao_ferias (empresa_, rhid_, dt_adm_, dt_ini, dt_fim);                               
                            });
                            
                        }
                    }
                });
                //END Editor Fields CONTROL

                $('a[href="#Tab4"]').on('shown.bs.tab', function (e) {
                    var empresa_ = $('#xt_EMPRESA').val(), rhid_ = $('#xt_RHID').val(), dt_adm_ = $('#xt_DT_ADMISSAO').val();
                    if (empresa_ && rhid_ && dt_adm_) {
                        //Called by footerCallback on RH_ID_FERIAS instance
                        //rhid_FeriasAno = getRhidFerias();                                 
                    } else {
                        $('#RH_ID_FERIAS_wrapper > img').remove();
                    }
                });

            }
            //END Férias
            
            //Descanso Compensatório
            if ( conf_TM['RH_ID_DC_DEBITOS']["access"] ) {
            
                //Get QUANTIDADE em minutos de TS APROVADO e em Workflow
                function getRhidDC () {
                    var empresa_ = $('#xt_EMPRESA').val(), rhid_ = $('#xt_RHID').val(), dt_adm_ = $('#xt_DT_ADMISSAO').val();
   
                    //ANO "CORRENTE"
                    if ( empresa_ && rhid_ && dt_adm_ ) {
                        var dados = {
                                empresa: empresa_,
                                rhid : rhid_,
                                dt_adm: dt_adm_
                        };

                        $.ajax({
                            type: "POST",
                            url:  "data-source/quad_requests_lib.php",
                            data: "request_id=getRhidDC"+
                                  "&params="+JSON.stringify(dados),
                            async: true,
                            cache: false,
                            success: function(res){
                                var rhid_data = JSON.parse(res), tot_creditos, tot_debitos, tmp_deb_wkf, saldo, saldo_hrs, tmp, tool_tip = false;
                                
                                //Créditos (não há NUNCA Crédito em Workflow)
                                tmp = QuadTimeToMinutes(parseFloat(rhid_data["CREDITOS"]));
                                if (Array.isArray(tmp)) {
                                    tot_creditos = tmp[0];
                                } else {
                                    tot_creditos = tmp;
                                }
                                
                                //Débito Total (inclui em Workflow)
                                tmp = QuadTimeToMinutes(parseFloat(rhid_data["DEBITOS_APROVADOS"]) + parseFloat(rhid_data["DEBITOS_WORKFLOW"]));
                                if (Array.isArray(tmp)) {
                                    tot_debitos = tmp[0];
                                } else {
                                    tot_debitos = tmp;
                                }
                                
                                //Débitos Workflow
                                tmp = QuadTimeToMinutes(parseFloat(rhid_data["DEBITOS_WORKFLOW"]));
                                if (Array.isArray(tmp)) {
                                    tmp_deb_wkf = tmp[0];
                                } else {
                                    tmp_deb_wkf = tmp;
                                }
                                
                                //SALDO TOTAL 
                                saldo = parseFloat(rhid_data["CREDITOS"]) - parseFloat(rhid_data["DEBITOS_APROVADOS"]) - parseFloat(rhid_data["DEBITOS_WORKFLOW"]);
                                tmp = QuadTimeToMinutes(saldo);
                                if (Array.isArray(tmp)) {
                                    saldo_hrs = tmp[0];
                                } else {
                                    saldo_hrs = tmp;
                                }                                

                                $('#DCResume').html('').removeClass('hide');
/*                                
                                //Créditos
                                var line_stats = '<ul id="sparks">' +                                        
                                                 '   <li class="sparks-info">' +
                                                 '        <h5 id="DC_Cred" style="font-weight: bold;" class="txt-color-blueLight"> <?php echo mb_strtoupper($ui_credit, 'UTF-8'); ?> <span class="txt-color-blueLight"><i class="far fa-plus"></i>&nbsp;' + tot_creditos + '</span></h5>' +
                                                 '   </li>';

                                //Débitos
                                if ( parseFloat(rhid_data["DEBITOS_WORKFLOW"]) == 0) { 
                                    line_stats +=  '    <li class="sparks-info">' +
                                                    '        <h5 id="DC_Debt" style="font-weight: bold;" class="txt-color-orange"> <?php echo mb_strtoupper($ui_debt, 'UTF-8'); ?> <span class="txt-color-orange value"><i class="far fa-minus"></i>&nbsp;' + tot_debitos + '</span></h5>' +
                                                    '    </li>';
                                } else {
                                    var info = "<?php echo $ui_workflow_includes_hours; ?>";
                                    info = info.replace('{0}', tmp_deb_wkf);
                                    line_stats += '    <li class="sparks-info" style="width: 120px;">' + 
                                                    '        <h5 id="DC_Debt" style="font-weight: bold;" class="txt-color-orange"> <?php echo mb_strtoupper($ui_debt, 'UTF-8'); ?> <span class="txt-color-orange value"><i class="far fa-minus"></i>&nbsp;' + 
                                                            tot_debitos + ' <label class="label label-warning super" rel="tooltip" data-placement="auto" title="' + info + '"> ' + tmp_deb_wkf + ' </label> </span></h5>' +
                                                    '    </li>';
                                    tool_tip = true;
                                }
                                
                                //Saldo
                                if ( saldo >= 0) { 
                                    line_stats +=  '    <li class="sparks-info">' +
                                                    '        <h5 id="DC_Balance" style="font-weight: bold;" class="txt-color-green"> <?php echo mb_strtoupper($ui_balance, 'UTF-8'); ?> <span class="txt-color-green value"><i class="far fa-equals"></i>&nbsp;' + saldo_hrs + '</span></h5>' +
                                                    '    </li>';
                                } else {
                                    line_stats +=  '    <li class="sparks-info">' +
                                                    '        <h5 id="DC_Balance" style="font-weight: bold;" class="txt-color-red"> <?php echo mb_strtoupper($ui_balance, 'UTF-8'); ?> <span class="txt-color-green value"><i class="far fa-equals"></i>&nbsp;' + saldo_hrs + '</span></h5>' +
                                                    '    </li>';
                                }
                                line_stats += '</ul>';
*/
                                var line_stats = '';
                                
                                //Crédito
                                line_stats =  '<div class="subheader-block d-lg-flex align-items-center">' +
                                                    '<div class="d-inline-flex flex-column justify-content-center mr-3"> ' +
                                                    '    <span class="fw-300 fs-xs d-block opacity-50"> ' +
                                                    '        <small>' + "<?php echo mb_strtoupper($ui_credit, 'UTF-8'); ?>" + '</small> ' +
                                                    '    </span> ' +
                                                    '    <span class="fw-500 fs-xl d-block color-success-500"> ' +
                                                    '        <i class="far fa-plus"></i>&nbsp;' + tot_creditos +'</span></div></div>';
                              
                                //Débito
                                line_stats +=  '<div class="subheader-block d-lg-flex align-items-center border-faded border-right-0 border-top-0 border-bottom-0 pl-3">' +
                                                    '<div class="d-inline-flex flex-column justify-content-center mr-3"> ' +
                                                    '    <span class="fw-300 fs-xs d-block opacity-50"> ' +
                                                    '        <small>' + "<?php echo mb_strtoupper($ui_debt, 'UTF-8'); ?>" + '</small> ' +
                                                    '    </span> ' +
                                                    '    <span class="fw-500 fs-xl d-block color-danger-500"> ' +
                                                    '        <i class="far fa-minus"></i>&nbsp;' + tot_debitos;
                                            
                                if ( parseFloat(rhid_data["DEBITOS_WORKFLOW"]) != 0) { 
                                    tool_tip = true;
                                    var info = "<?php echo $ui_workflow_includes_hours; ?>";
                                    info = info.replace('{0}', tmp_deb_wkf);
                                    line_stats +=   '<label class="label label-warning wkf_info" rel="tooltip" data-placement="bottom" data-original-title="' +
                                                     + info + '"> ' + tmp_deb_wkf + '</label>';
                                }
                                line_stats +=   '    </span></div></div>';
                                
                                //Saldo
                                line_stats +=  '<div class="subheader-block d-lg-flex align-items-center border-faded border-right-0 border-top-0 border-bottom-0 pl-3">' +
                                                    '<div class="d-inline-flex flex-column justify-content-center mr-3"> ' +
                                                    '    <span class="fw-300 fs-xs d-block opacity-50"> ' +
                                                    '        <small>' + "<?php echo mb_strtoupper($ui_balance, 'UTF-8'); ?>" + '</small> ' +
                                                    '    </span> ' +
                                                    '    <span class="fw-500 fs-xl d-block color-primary-500"> ' +
                                                    '        <i class="far fa-equals"></i>&nbsp;' + saldo_hrs + 
                                                    '    </span> ' +
                                                    '</div></div>';                                

                                $('#DCResume').html(line_stats).fadeIn("slow");
                                if ( tool_tip) { 
                                    $("[rel=tooltip]").tooltip();
                                }                              
                            }
                        });                        
                        return;
                    }
                }            

                $('a[href="#Tab5"]').on('shown.bs.tab', function (e) {
                    var empresa_ = $('#xt_EMPRESA').val(), rhid_ = $('#xt_RHID').val(), dt_adm_ = $('#xt_DT_ADMISSAO').val();
                    if (empresa_ && rhid_ && dt_adm_) {
                        getRhidDC();
                    } else {
                        $('#RH_ID_DC_DEBITOS_wrapper > img').remove();
                    }
                });

                //Débitos :: Editor Fields CONTROL
                $(document).on('RH_ID_DC_DEBITOSAttachEvt', function (e) {
                    var frm_context = "#RH_ID_DC_DEBITOS_editorForm", operacao = RH_ID_DC_DEBITOS.editor.s["action"],
                        ok_style = {'display': 'block'}, nok_style = {'display': 'none'},
                        empresa_ = $('#xt_EMPRESA').val(), rhid_ = $('#xt_RHID').val(), dt_adm_ = $('#xt_DT_ADMISSAO').val();
                    //Função de cálculo da duração de um registo de Absentismo e inicialização nas colunas correspondentes
                    function duracao_DC (empresa_, rhid_, dt_adm_, dt_ini, dt_fim) {
                        //DURACAO :: Contabilização do registo
                        if (empresa_ && rhid_ && dt_adm_ && dt_ini && dt_fim) {
                            var tempoDetails = {
                                "tabela": 'RH_ID_DC_DEBITOS',
                                "empresa": empresa_,
                                "rhid": rhid_,
                                "dt_adm": dt_adm_,
                                "dt_ini": dt_ini,
                                "dt_fim": dt_fim
                            }, resTime = getTimeDuration(tempoDetails);

                            /* restime = {DCAL: x, DUTS: y, MCAL: w, MUTS: u}
                             * DCAL (dias calendário), DUTS (dias úteis), MCAL (minutos calendário), MUTS (minutos úteis) 
                            */
                            resTime = JSON.parse(resTime);

                            //Clear (previous) ERROR 
                            $(".editorErrorContainer", frm_context).remove();
                            
                            //If NOT ERROR :: Distribute ATTRIBUTES throught FORM
                            if (resTime.error.length === 0) {
                                $('#DTE_Field_QTD_USADA', frm_context).val( resTime['MUTS'] );
                            } else {
                                //ERROR DISPLAY
                                if ( $(frm_context).length ) {
                                    $(".editorErrorContainer").remove();
                                    $(frm_context)
                                            .append(
                                                    '<div class="editorErrorContainer"><div class="editorError">' +
                                                    resTime.error +
                                                    "</div></div>"
                                                    )
                                            .css("display", "block");
                                    $(".editorErrorContainer")
                                            .get(0)
                                            .scrollIntoView();
                                }                                
                            }
                        }
                        return;
                    }
                                        
                    //operacao ==> 'query', 'create', 'edit'
                    if (operacao !== 'query') {
                        setTimeout( function() {
                            $('#DTE_Field_QTD_USADA', frm_context).attr('disabled', true);
                            $('.DTE_Field_Name_SUB_REFEICAO', frm_context).css(nok_style);
                            $('.DTE_Field_Name_DESCONTO_REFEICAO', frm_context).css(nok_style);
                            $('.DTE_Field_Name_UNIDADE_DC', frm_context).css(nok_style); //.remove();
                        }, 250);                        
                        
                        if (operacao === 'create') {                            
                            $('#DTE_Field_GOZOU_DE', frm_context).on("change", function (e) {                    
                                var reg, dia_ = $('#DTE_Field_GOZOU_DE').val().split(' ')[0], hora_ = $('#DTE_Field_GOZOU_DE', frm_context).val().split(' ')[1],
                                    rhid_ = $('#DTE_Field_RHID', frm_context).val(),
                                    empresa_ = $('#DTE_Field_EMPRESA', frm_context).val(), dt_adm_ = $('#DTE_Field_DT_ADMISSAO', frm_context).val(),
                                    vlr_, unid_, aux;
                                reg = getHorarioDiarioDetails(empresa_, rhid_, dt_adm_, dia_);
                                reg = JSON.parse(reg);
                                if ( dia_ ) {
                                    if ( hora_ ) {
                                        if (hora_ > reg['e_1']) {
                                            vlr_ = dia_ + ' ' + vlr_;
                                        } else {
                                            vlr_ = dia_ + ' ' + reg['e_1'];
                                        }
                                    } else {
                                        vlr_ = dia_ + ' ' + reg['e_1'];
                                    }
                                    $('#DTE_Field_GOZOU_DE').val(vlr_);
                                    
                                    //DURACAO :: Contabilização do registo
                                    var dt_ini = $('#DTE_Field_GOZOU_DE', frm_context).val(), dt_fim = $('#DTE_Field_GOZOU_A', frm_context).val();
                                    duracao_DC (empresa_, rhid_, dt_adm_, dt_ini, dt_fim);                                     
                                }
                            });
                            $('#DTE_Field_GOZOU_A', frm_context).on("change", function (e) {
                                var reg, dia_ = $('#DTE_Field_GOZOU_A').val().split(' ')[0], hora_ = $('#DTE_Field_GOZOU_A', frm_context).val().split(' ')[1],
                                    vlr_, unid_, aux, hr_fim;
                                reg = getHorarioDiarioDetails(empresa_, rhid_, dt_adm_, dia_);
                                reg = JSON.parse(reg);
                                if ( dia_ ) {
                                    if ( reg['s_2'] ) {
                                        hr_fim = reg['s_2'];
                                    } else {
                                        hr_fim = reg['s_1'];
                                    }
                                    if ( hora_ ) {
                                        if (hora_ < hr_fim) {
                                            vlr_ = dia_ + ' ' + hora_;
                                        } else {
                                            vlr_ = dia_ + ' ' + hr_fim;
                                        }
                                    } else {
                                        vlr_ = dia_ + ' ' + hr_fim;
                                    }
                                    $('#DTE_Field_GOZOU_A').val(vlr_);
                                    
                                    //DURACAO :: Contabilização do registo
                                    var dt_ini = $('#DTE_Field_GOZOU_DE', frm_context).val(), dt_fim = $('#DTE_Field_GOZOU_A', frm_context).val();
                                    duracao_DC (empresa_, rhid_, dt_adm_, dt_ini, dt_fim);                                    
                                }
                            });                            
                        } else {  
                            $('#DTE_Field_GOZOU_A', frm_context).on("change", function (e) {
                                var reg, dia_ = $('#DTE_Field_GOZOU_A').val().split(' ')[0], hora_ = $('#DTE_Field_GOZOU_A', frm_context).val().split(' ')[1],
                                    vlr_, unid_, aux, hr_fim;
                                reg = getHorarioDiarioDetails(empresa_, rhid_, dt_adm_, dia_);
                                reg = JSON.parse(reg);
                                if ( dia_ ) {
                                    if ( reg['s_2'] ) {
                                        hr_fim = reg['s_2'];
                                    } else {
                                        hr_fim = reg['s_1'];
                                    }
                                    if ( hora_ ) {
                                        if (hora_ < hr_fim) {
                                            vlr_ = dia_ + ' ' + hora_;
                                        } else {
                                            vlr_ = dia_ + ' ' + hr_fim;
                                        }
                                    } else {
                                        vlr_ = dia_ + ' ' + hr_fim;
                                    }
                                    $('#DTE_Field_GOZOU_A').val(vlr_);
                                    
                                    //DURACAO :: Contabilização do registo
                                    var dt_ini = $('#DTE_Field_GOZOU_DE', frm_context).val(), dt_fim = $('#DTE_Field_GOZOU_A', frm_context).val();
                                    duracao_DC (empresa_, rhid_, dt_adm_, dt_ini, dt_fim);                                    
                                }
                            });                            
                        }
                    } else {
                        setTimeout( function() {
                            $('#DTE_Field_QTD_USADA', frm_context).attr('disabled', false);
                            $('.DTE_Field_Name_SUB_REFEICAO', frm_context).css(ok_style);
                            $('.DTE_Field_Name_DESCONTO_REFEICAO', frm_context).css(ok_style);
                            $('.DTE_Field_Name_UNIDADE_DC', frm_context).css(ok_style); //.remove();
                        }, 250);                    
                    }
                });
                //END Débitos :: Editor Fields CONTROL           
            }
            //END Descanso Compensatório
            
            //Troca Horário :: Editor DEFAULT COLUMNS
            $(document).on('RH_ID_ESCALAS_HORARIASAttachEvt', function (e) {
                var frm_context = "#RH_ID_ESCALAS_HORARIAS_editorForm", operacao = RH_ID_ESCALAS_HORARIAS.editor.s["action"],
                    ov = $(document).find('#xt_DT_ADMISSAO option:selected').data('othervalues').split('@');
                        
                //operacao ==> 'query', 'create', 'edit'
                if (operacao === 'create') {
                    setTimeout( function () {
                        try {
                            if (ov[5] && ov[6]) {
                                $('#DTE_Field_DSP_TP_HORARIO_DE', frm_context)[0].value = ov[5];
                                $('#DTE_Field_DSP_TP_HORARIO_DE', frm_context).trigger('change').trigger('chosen:updated');
                            }
                        } catch(e) {
                            null;
                        }
                    }, 200);

                    //DEFERRED TIMEOUT
                    setTimeout( function () {
                        $( $('#DTE_Field_DSP_HORARIO_DE', frm_context)[0] ).val(ov[5] + '@' + ov[6]);
                        $('#DTE_Field_DSP_HORARIO_DE', frm_context).trigger('change').trigger('chosen:updated');
                    }, 400);
                }
            });
            //END Troca Horário :: Editor DEFAULT COLUMNS
        }
        //END Code Branch

        //Graphics Branch
        if (1 === 0) {
            //FERIAS GRAPH
            if (conf_TM['RH_ID_FERIAS']["access"] ) {
                var graphs = function () {

                    var randomScalingFactor = function () {
                        return Math.round(Math.random() * 25);
                        //return 0;
                    };
    //                var randomColorFactor = function() {
    //                    return Math.round(Math.random() * 255);
    //                };
    //                var randomColor = function(opacity) {
    //                    return 'rgba(' + randomColorFactor() + ',' + randomColorFactor() + ',' + randomColorFactor() + ',' + (opacity || '.3') + ')';
    //                };            

                    //ChartJS :: MIDDLE DATA on DONOUGHT (PIE ?) :: CUSTOM CHARTJS
                    Chart.pluginService.register({
                        afterDraw: function (chart) {
                            if (chart.data.total_dias_ferias) {
                                var width = chart.width,
                                        height = chart.height,
                                        len_ = chart.data.total_dias_ferias.length;
                                var fontSize = (height / 124).toFixed(2); //(height / 114).toFixed(2);

                                chart.ctx.font = fontSize + "em Verdana";
                                chart.ctx.textBaseline = "middle";

                                var text = chart.data.total_dias_ferias,
                                        textX = Math.round(((width - (len_ * ((width / height) * 7))) - chart.ctx.measureText(text).width) / 2),
                                        textY = height / 2;

                                if (chart.options.circumference < 6) {
                                    textY = height - ((width / height) * (20));
                                }
                                chart.ctx.fillText(text, textX, textY);
                            }
                        }
                    });
                    //REFERENCE:    http://www.chartjs.org/docs/
                    //(Best Match)  https://www.chartjs.org/docs/latest/configuration/ (best match)
                    var myVacationGraph = document.getElementById("myVacationGraph");
                    var DoughtnutConfig = {
                        type: 'doughnut',
                        data: {
                            total_dias_ferias: '25 dias',
                            datasets: [{
                                    data: [
                                        randomScalingFactor(),
                                        randomScalingFactor(),
                                        randomScalingFactor()
                                    ],
                                    backgroundColor: [
                                        //"#36a2eb", //Registered
                                        "#ffcd56", //Pending
                                        "#13d370", //Approved
                                        "#ff6e00", //Balance
                                    ],
                                    hoverBackgroundColor: [
                                        //"#368ee2", //Registered
                                        "#feb962", //Pending 
                                        "#0eb760", //Approved
                                        "#ff9545", //Balance                               
                                    ],
                                    //label: 'Dataset 1'
                                }],
                            labels: [
                                "<?php echo $ui_pending; ?>",
                                "<?php echo $ui_approved; ?>",
                                //"<?php echo $ui_registered; ?>",
                                "<?php echo $ui_balance; ?>"
                            ]
                        },
                        options: {
                            responsive: true,
                            rotation: -1 * Math.PI, //(180º: -1 * Math.PI) || (360º: -Math.PI / 2)
                            circumference: 1 * Math.PI, //(180º: Math.PI) || (360º: 2 * Math.PI)
                            animation: {
                                duration: 2000,
                                animateRotate: true,
                                animateScale: true,
                                //currentStep: number,
                                //numSteps: number,
                                onProgress: function (animation) {

                                    myVacationGraph.value = animation.animationObject.currentStep / animation.animationObject.numSteps;
                                },
                                onComplete: function () {
                                    window.setTimeout(function () {
                                        myVacationGraph.value = 0;
                                    }, 2000);
                                }
                            },
                            responsiveAnimationDuration: 500,
                            legend: {
                                display: true,
                                position: 'right',
                                //display: false,
                                labels: {
                                    boxWidth: 20,
                                    fontsize: 14,
                                    fontStyle: 'normal'
                                }
                            },
                            tooltips: {
                                enabled: true
                            },
                            elements: {
                                center: {
                                    text: '25 dias',
                                    color: '#ff6384',
                                    sidePadding: 20
                                }
                            }
                        }
                    };
                    myDoughnut = new Chart(myVacationGraph, DoughtnutConfig);

                    //VIEW BUTTON :: Donought (PIE) :: 360º ou 180º
                    document.getElementById('myVacationGraphChangeCircleSize').addEventListener('click', function () {
                        if (window.myDoughnut.options.circumference === Math.PI) {
                            window.myDoughnut.options.circumference = 2 * Math.PI;
                            window.myDoughnut.options.rotation = -Math.PI / 2;
                        } else {
                            window.myDoughnut.options.circumference = Math.PI;
                            window.myDoughnut.options.rotation = -Math.PI;
                        }

                        window.myDoughnut.update();
                    });
                }
            }
            //END FERIAS GRAPH
            
            loadScript("js/plugin/moment/moment.min.js", function () {
                loadScript("js/plugin/morris/raphael.min.js", function () {
                    loadScript("js/plugin/morris/morris.min.js", function () {  //https://morrisjs.github.io/morris.js/
                        loadScript("js/plugin/chartjs/Chart.min.js", graphs); //https://www.chartjs.org/docs/latest/
                    });
                });
            });

        }
        //END Graphics Branch

        //SVG :: Horario Diário + Qualificação
        if (1 === 1) {
            var $description = $(".description");

            //SVG :: Tooltip Position Control
            $(document).on('mousemove', function (e) {
                $description.css({
                    left: e.pageX - 290, //e.pageX || e.clientX-290
                    top: e.pageY - 150 //, e.pageY - 3 || e.clientY-150
                });
            });

            //SVG :: Show Tooltip
            function ShowTooltip(evt) {
                var $this = $(this),
                        duration = $this.data('duration');

                if (!duration) { //Definição do Horário
                    content = $this.data('segment_description') + '<br>' + $this.data('ini') + ' ~ ' + $this.data('fim');
                } else {
                    content = $this.data('segment_description') + ': ' + duration + '<br>' + $this.data('ini').split(" ")[1] + ' ~ ' + $this.data('fim').split(" ")[1];
                }

                if ($description.hasClass('active')) {
                    $description.removeClass('active');
                } else {
                    $this.attr("class", "enabled heyo");
                    $description.html(content);
                    $description.addClass('active');
                }
            }

            //SVG :: Hide Tooltip
            function HideTooltip() {
                $description.removeClass('active');
            }

            //Procedimento de Desenho do Horário Diário e Respetiva representação Emparelhada dos trechos de tempo Qualificados
            //PARÂMETROS:
            //  SELECTOR: nome da div onde o svg deve ser escrito
            //  DIA_CTX: dia de contexto correspondente à QUALIFICAÇÃO
            //  CD_HOR_DIARIO: toda a informação que define o horário diário aplicado - "INICIO_DIA@INICIO_NOITE@FIM_NOITE@TP_1@HI_1@HF_1@TP_2@HI_2@HF_2@TP_3@HI_3@HF_3@TP_4@HI_4@HF_4@TP_5@HI_5@HF_5"
            //  PUNCHESPAIRS: Array de Objetos com os "TRECHOS" qualificados
            function drawDaySchedule(selector, dia_ctx, cd_hor_diario_info, punchesPairs) {
                /*  punchesPairs: [ 0: {            
                 ATRASO_ENTRADA: "0",
                 ATRASO_SAIDA: "0",
                 CD_AUSENCIA: null,
                 CHANGED_BY: null,
                 DIA: "2018-10-31",
                 DSP_AUSENCIA: "",
                 DT_ADMISSAO: "2008-02-04",
                 DT_INSERTED: "2019-07-18",
                 DT_RowId: "row_DEMO12008-02-042018-10-311000",
                 DT_UPDATED: null,
                 EMPRESA: "DEMO",
                 ESTADO: "A",
                 ESTADO_ATRASO: "A",
                 HR_IN: "2018-10-31 00:00",
                 HR_OUT: "2018-10-31 06:00",
                 ID_FAIXA: "1",
                 INSERTED_BY: "quadhcm@prt19.wl-dns.com",
                 NR_ORDEM: "1000",
                 RHID: "1",
                 TOTAL_FAIXA: "360",
                 TP_IN: "M",
                 TP_OUT: "T"
                 }, 
                 ...]
                 */
                var arr = cd_hor_diario_info.split("@"), intervalosTempo = /[a-b]/gmi, nr_intervalos = 0, intervalo_idx = 0,
                        minutos, last_position = 0, lenght_px = 0, linha_1 = '', linha_1_y_position = "5", linha_2 = '', linha_2_y_position = "25", linha_2_y_pos_icon_inside = "29",
                        linha_circles = '', linha_sunrise = '', drawn_ini_dia = false, stroke_color, segment_type_class, verticalReferences = '', ratio = 0.67, prv_hr_ref = '',
                        timeResume = '', timeReef = '', sunrise_color = "orange", stroke_vl = "#daa52075", d1, d2, prv_ctx_ref, skip_ini_circle, begin_x = '', end_x = '', duration_txt_size = '.8em',
                        html_ = "", tmp, dia_ctx_prv, dia_ctx_nxt, segment_type_class, other_type_class, show_marcacoes, punchesGraph, step_trechos = 12, ini_dia_middle = false, y2_max, vp_last_y,
                        segment_description;


                //Tentativa de dimensionar as linhas verticais com os o nr. de trechos qualificados, por serem representados em "escada".
                //TODO: Falta confirmar utilidade efetiva...
                if (punchesPairs.length) {
                    nr_trechos = punchesPairs.length;

                    y2_max = 85;
                    vp_last_y = 40;

                    if (nr_trechos > 1) {
                        y2_max = y2_max + ((nr_trechos - 1) * 10);
                        vp_last_y = vp_last_y + ((nr_trechos - 1) * 10);
                    }
                } else {
                    nr_trechos = 0;
                    y2_max = 0;
                }

                //SUPPORT FUNCTION to draw QUALIFICATION PAIRS
                function drawPunchCardEntry(markersArray, y_reference, step_trechos) {
                    var arr = markersArray, htm_ = '', stroke_ok, stroke_nok, previous_interval,
                            y_reference = y_reference + 6, y_increment = 0, segment_description;
                    //console.log('MARKERS......');
                    //console.log(markersArray);
                    //console.log('TIME PAIRS......');
                    //console.log(punchesPairs);
                    //Trechos "Qualificados"
                    punchesPairs.forEach(function (obj, index) {
                        //console.log('QUALIFICADO:' + obj['HR_IN'] + ' ~ ' + obj['HR_OUT']);

                        //Intervalos de Horário Diário (TS:Trab. Suplementar ou TE:Trabalho Esperado)
                        var trecho_representado = false, deltaX;
                        for (var i = 0, x1 = '', x2 = ''; i < markersArray.length; i++) {
                            var minutos_ini = 0, minutos_fim = 0, stroke_color, stroke_width = 2, text_x_pos, duration;

                            if ((obj['HR_IN'] >= markersArray[i]['begin'] && obj['HR_IN'] < markersArray[i]['end']) &&
                                    (obj['HR_OUT'] > markersArray[i]['begin'] && obj['HR_OUT'] <= markersArray[i]['end'])
                                    ) {
//console.log('FOUND MARKER for PERIOD: ' + markersArray[i]['begin'] + ' ~ '+ markersArray[i]['end'] + ' Begin X: ' + markersArray[i]['begin_x'] + ' End X: ' + markersArray[i]['end_x']);

                                //console.log( markersArray[i] );
                                //Distância do INICIO DO SEPARADOR VERTICAL até à HORA INÍCIO do intervalo a representar
                                minutos_ini = timeDifference(markersArray[i]['begin'], obj['HR_IN']);

                                //Determina posição X1 para o Início do desenho da linha
                                x1 = Math.trunc(parseFloat(markersArray[i]['begin_x']) + parseFloat(minutos_ini * markersArray[i]['x_min_ratio'])); //minutos_ini * 0.60

                                //Distância entre a HORA FIM do intervalo a representar até ao SEPARADOR VERTICAL FINAL                                
                                minutos_fim = obj['TOTAL_FAIXA'];

                                //Se o Intervalo anterior tiver uma duração "curta" e este também, desloca o texto (com a duração) para o fim da LINHA desse intervalo
                                if (previous_interval <= 40 && minutos_fim <= 40) {
                                    deltaX = 15;
                                    previous_interval = minutos_fim;
                                } else {
                                    deltaX = 0;
                                    previous_interval = null;
                                }


                                //Formato da duração em HH24:MI
                                duration = QuadTimeToMinutes(obj['TOTAL_FAIXA'])[0];

                                //Determina posição X2 para o Início do desenho da linha
                                x2 = Math.trunc(parseFloat(x1) + parseFloat(minutos_fim * markersArray[i]['x_min_ratio']));
                                text_x_pos = parseFloat(x1 + ((x2 - x1) / 2));
//console.log('Min.Início: ' + minutos_ini + ' Min.Fim:' +  minutos_fim + ' '+ ' X1: ' + x1 + ' X2: '+ x2 + ' Text: ' + text_x_pos);

                                //Tipo de Faixa
                                if (markersArray[i]['type'] === 'ts') {
                                    stroke_color = '#3b9ff3'; //Blue
                                } else if (markersArray[i]['type'] === 'te') {
                                    stroke_color = '#008000'; //Green
                                }

                                //Especialização do Tipo de Faixa
                                if (obj['ID_FAIXA'] === 1 || obj['ID_FAIXA'] === 2) { //Períodos de Trabalho Esperado
                                    //Ótica de Ausências
                                    if (obj['TP_IN'] === 'A') { //Ausência
                                        stroke_color = "red";
                                        segment_description = "<?php echo $ui_absence; ?>";
                                    } else if (obj['TP_IN'] === 'C') { //Ausência Compensada
                                        stroke_color = "#9c1818;";
                                        segment_description = "<?php echo $ui_compensated_absence; ?>";
                                    } else if (obj['TP_IN'] === 'D') { //Ausência Justif. Descanso Compensatório
                                        stroke_color = "#9c1818;";
                                        segment_description = "<?php echo $ui_compensatory_rest; ?>";
                                    } else if (obj['TP_IN'] === 'F') { //Ausência Justif. com Férias
                                        stroke_color = "#0ee87a;";
                                        segment_description = "<?php echo $ui_vacation; ?>";
                                    } else if (obj['TP_IN'] === 'P') { //Ausência Justif. com Aus. Prevista
                                        stroke_color = "red;";
                                        segment_description = "<?php echo $ui_planned_absence; ?>";
                                    } else if (obj['TP_IN'] === 'H') { //Ausência Justif. com Banco Horas
                                        segment_description = "<?php echo $hint_hours_bank; ?>";
                                        stroke_color = "#9c1818;";
                                    } else if (obj['TP_IN'] === 'L') { //Ausência Justif. com Bolsa de Manutenção
                                        stroke_color = "#9c1818;";
                                        segment_description = "<?php echo $ui_manut_wallet; ?>";
                                    } else { // ***** Ótica de Presenças *****
                                        segment_description = "<?php echo $ui_work_done; ?>";
                                    }
                                } else if (obj['ID_FAIXA'] == 6) {//Períodos de Falta na Refeição
                                    stroke_color = "#f19499"; //Redish
                                    segment_description = "<?php echo $ui_meal_absence; ?>";
                                } else if (obj['ID_FAIXA'] === 3 || obj['ID_FAIXA'] === 4 || obj['ID_FAIXA'] === 5) { //Trab. Suplementar
                                    segment_description = "<?php echo $ui_overtime_work_short; ?>";
                                } else if (obj['ID_FAIXA'] === 7) { //Hrs. a Mais
                                    stroke_color = "#cccc"; //Grey
                                    segment_description = "<?php echo $ui_additional_hours; ?>";
                                }

                                htm_ += '<g  data-type="' + obj['TP_IN'] + '" data-segment_description="' + segment_description + '" data-ini="' + obj['HR_IN'] + '" data-fim="' + obj['HR_OUT'] + '" data-duration="' + duration + '" class="svg-tooltip">' +
                                        '<path d="M ' + parseFloat(x1) + ' ' + parseFloat(y_reference - 5 + y_increment) + " L " + parseFloat(x1) + " " + parseFloat(y_reference + 5 + y_increment) + '" style="stroke:' + stroke_color + '; stroke-width:' + stroke_width + '" fill="none" />' +
                                        '<line x1="' + parseFloat(x1) + '" y1="' + parseFloat(y_reference + y_increment) + '" x2="' + parseFloat(x2) + '" y2="' + parseFloat(y_reference + y_increment) + '" style="stroke:' + stroke_color + '; stroke-width:' + stroke_width + '"></line>';
                                if (obj['TOTAL_FAIXA']) {
                                    var val_ = QuadTimeToMinutes(obj['TOTAL_FAIXA']);
                                    val_ = val_[0];
                                    if (deltaX) {
                                        htm_ += '<text style="font-size: .70em;stroke:' + stroke_color + ';font-weight: 400;" x="' + parseFloat(x2 + deltaX) + '" y="' + parseFloat(y_reference + y_increment + 1) + '" dominant-baseline="middle" text-anchor="middle">' + val_ + '</text> ';
                                    } else {
                                        htm_ += '<text style="font-size:' + duration_txt_size + ';stroke:' + stroke_color + ';font-weight: 400;" x="' + text_x_pos + '" y="' + parseFloat(y_reference - 11) + '" dominant-baseline="middle" text-anchor="middle">' + val_ + '</text> ';
                                    }
                                }
                                htm_ += '<path d="M ' + parseFloat(x2) + ' ' + parseFloat(y_reference + y_increment - 5) + " L " + parseFloat(x2) + " " + parseFloat(y_reference + y_increment + 5) + '" style="stroke:' + stroke_color + '; stroke-width:' + stroke_width + '" fill="none" /></g>';
                                y_increment = y_increment + step_trechos;
                                trecho_representado = true;
                                break;
                            }
                        }

                        //Sinalizar "Trecho" NÃO REPRESENTADO no Gráfico, de modo a poder sinalizá-lo na INSTÂNCIA RH_DET_PONTOS
                        if (!trecho_representado) {
                            punchesPairs[index]['OFF'] = 'S';
                        }
                    });
                    return htm_;
                }

                //Se DIA CONTEXTO NÃO FOR INDICADO SAI...
                if (!dia_ctx) {
                    return;
                }

                //Se não tivermos disponível o array com as Qualificações de Ponto, renderizamos só o Horário Diário.
                //Deste modo esta funçao, poderá ser reutilizável, p. exemplo na definição de :
                //  A) Horários diários 
                //  B) Horários Semanais ou de Turno
                if (punchesPairs.length) {
                    show_marcacoes = true;
                } else {
                    show_marcacoes = false;
                }

                //Previous CONTEXT Day
                tmp = new Date(dia_ctx);
                dia_ctx_prv = formataData(tmp.setDate(tmp.getDate() - 1), 'y-m-d');

                //Next CONTEXT Day
                tmp = new Date(dia_ctx);
                dia_ctx_nxt = formataData(tmp.setDate(tmp.getDate() + 1), 'y-m-d');

                //Contador do Nr. de Intervalos de Tempo definidos num horário diário.
                //Usamos uma expressão regular que conta o Nr. de Letras no ARRAY.... um vez que cada
                //"intervalo de tempo" tém uma letra que o define: [A] Esperado, [B] Trab. Suplementar
                //Este controlo visa implementar o "desenho" de cada período de horário no TAG <g /> respetivo
                for (a = 0; a < arr.length; a++) {
                    if (intervalosTempo.test(arr[a])) {
                        nr_intervalos = nr_intervalos + 1;
                    }
                }

                //Ciclo de Desenho do Horário Diário, avaliando posição do INÍCIO de DIA no período: A) ANTES ou IGUAL ao INÍCIO; B) no MEIO; no C) FIM; D) SEM Início de DIA
                ////Exemplo do protótipo de escrita gráfica de um "trecho":
                // LINHA #1: 08:00
                // LINHA #2: <Line>
                // LINHA_CIRCLES: <circles> :: TRICK to overlap lines drawn (on LINHA #2)
                // LINHA_SUNRISE: <Sunrise> :: TRICK to overlap ALL previous
                // LINHA #3: Line VERTICAL SEPARATORS (vertical time markers)
                for (var i = 4, x1 = 0, last_x1 = 0, drawn = false, intervalo_idx = 0; i < parseInt(arr.length - 4); i) {
                    var x_ratio = 0, line_length_px = 0, dia_hora_fim_anterior;

                    intervalo_idx = intervalo_idx + 1;

                    //TIPO DE HORÁRIO :: Color Control
                    if (arr[i - 1] === 'A') {
                        stroke_color = "#008000"; //Tempo Esperado :: green
                        segment_type_class = "te";
                        segment_description = "<?php echo $ui_expected_work_short; ?>";
                        //other_type_class = "ts";
                    } else {
                        stroke_color = "#3b9ff3"; //Trabalho Suplementar :: blue
                        segment_type_class = "ts";
                        segment_description = "<?php echo $ui_overtime_work_short; ?>";
                    }

                    // (A) INÍCIO DE DIA :: ANTERIOR OU COINCIDENTE COM O INÍCIO DO INTERVALO
                    if (!drawn_ini_dia) { //Ainda não representamos o Início de DIA
                        if (arr[i] > arr[0]) { //INÍCIO DE DIA ANTERIOR AO INÍCIO DO INTERVALO    
                            minutos = timeDifference(arr[0], arr[i]);
                            lenght_px = Math.trunc(x1 + minutos + (minutos * 0.60));

                            //HORA DE INICIO DE DIA
                            linha_1 += '<text name="A1" class="gTxt" x="' + x1 + '" y="' + linha_1_y_position + '" fill="' + sunrise_color + '" style="overflow: inherit;font-weight:600;">' + arr[0] + '</text>';
                            //ICON DE INICIO DE DIA
                            linha_sunrise += '<text name="A2" class="sunrise" x="' + parseFloat(x1 + 7) + '" y="' + linha_2_y_position + '" fill="' + sunrise_color + '" style="overflow: inherit;font-weight:600;font-size:1.4em;">&#xf766</text>';

                            if (verticalReferences) {
                                verticalReferences += ',';
                            }
                            x1 = x1 + 0; //17;
                            verticalReferences += '{"ref":"1", "begin":"' + dia_ctx + ' ' + arr[0] + '", "type":"begin_day", "x": "' + parseFloat(x1) + '"}';
                            prv_ctx_ref = dia_ctx;
                            prv_hr_ref = arr[0];
                            drawn_ini_dia = true;
                            drawn = false;
                            // *************** TODO ::DRAW THE INTERVAL ***********//

                        } else if (arr[i] === arr[0]) { //INÍCIO DE DIA NO INÍCIO DO INTERVALO       
                            if (arr[i] >= arr[i + 1]) {
                                d1 = dia_ctx + ' ' + arr[i];
                                d2 = dia_ctx_nxt + ' ' + arr[i + 1];
                            } else {
                                d1 = dia_ctx + ' ' + arr[i];
                                d2 = dia_ctx + ' ' + arr[i + 1];
                            }

                            //HORA DE INICIO DO HORÁRIO
                            linha_1 += '<text name="B1" class="gTxt" x="' + x1 + '" y="' + linha_1_y_position + '" fill="' + stroke_color + '" style="overflow: inherit;font-weight:600;">' + arr[i] + '</text>';
                            //CIRCLE INICIO DE HORARIO
                            linha_circles += '<circle name="B2" data-line="' + parseFloat(x1 + 17) + '" cx="' + parseFloat(x1 + 17) + '" cy="' + linha_2_y_position + '" r="11" stroke="' + sunrise_color + '" stroke-width="3" fill="white" /> ';
                            //Vertical Line                            
                            timeReef += '<line name="TR_1" class="timeReef ' + segment_type_class + '" data-reef="' + d1 + '" x1="' + parseFloat(lenght_px + 17) + '" y1="40" x2="' + parseFloat(lenght_px + 17) + '" y2="' + y2_max + '" stroke-dasharray="5, 5" style="stroke:' + stroke_vl + ';stroke-width:1"></line>';
                            begin_x = parseFloat(lenght_px + 17);
                            //WITH ICON DE INICIO DE DIA EMBEDDED
                            linha_sunrise += '<text name="B3" class="sunrise" x="' + parseFloat(x1 + 10) + '" y="' + linha_2_y_pos_icon_inside + '" fill="' + sunrise_color + '" style="overflow: inherit;font-weight:600;font-size:1em;">&#xf766</text>';

                            //LINHA de INÍCIO ATÉ FIM do PERÍODO
                            line_length_px = Math.trunc(timeDifference(d1, d2) * ratio);
                            linha_2 += '<line name="B4" x1="' + parseFloat(x1 + 29) + '" y1="25" x2="' + parseFloat(x1 + line_length_px) + '" y2="25" style="stroke:' + stroke_color + ';stroke-width:4"></line>';
                            x1 = x1 + line_length_px;

                            //FIM DO Período
                            linha_1 += '<text name="B5" class="gTxt" x="' + parseFloat(x1 - 4) + '" y="' + linha_1_y_position + '" fill="' + stroke_color + '" style="overflow: inherit;font-weight:600;">' + arr[i + 1] + '</text>';

                            linha_circles += '<circle name="B6" data-line="' + parseFloat(x1 + 10) + '" cx="' + parseFloat(x1 + 10) + '" cy="' + linha_2_y_position + '" r="9" stroke="' + stroke_color + '" stroke-width="4" fill="white" /> ';
                            end_x = parseFloat(x1 + 10);

                            //Vertical Line                            
                            timeReef += '<line name="TR_2" class="timeReef ' + segment_type_class + '" data-reef="' + d2 + '" x1="' + parseFloat(x1 + 10) + '" y1="40" x2="' + parseFloat(x1 + 10) + '" y2="' + y2_max + '" stroke-dasharray="5, 5" style="stroke:' + stroke_vl + ';stroke-width:1"></line>';

                            x1 = x1 + 10;
                            if (verticalReferences) {
                                verticalReferences += ',';
                            }

                            //Quantos pixeis vale 1 minuto
                            x_ratio = (parseFloat(end_x) - parseFloat(begin_x)) / timeDifference(d1, d2);
                            verticalReferences += '{"ref":"2", "type":"' + segment_type_class + '", "begin":"' + d1 + '", "end":"' + d2 + '", "begin_x":"' + begin_x + '", "end_x":"' + end_x + '", "x_min_ratio": "' + x_ratio + '"}';
                            prv_ctx_ref = dia_ctx;
                            prv_hr_ref = arr[i + 1];
                            drawn_ini_dia = true;
                            drawn = true;
                        }
                    }

                    // (B) INÍCIO DE DIA :: NO MEIO INTERVAO
                    if (!drawn_ini_dia) { //Ainda não representamos o Início de DIA
                        if ((arr[0] > arr[i]) && (arr[0] < arr[i + 1])) { //INÍCIO DE DIA DENTRO DO INTERVALO. EX: INICIO_DIA: 06:00 INTERVALO: 00:00 ~ 08:00                            
                            line_length_px = Math.trunc(timeDifference(arr[i], arr[0]) * ratio);
                            var line_full_length = Math.trunc(timeDifference(arr[i], arr[i + 1]) * ratio);
                            //HORA DE INICIO DO HORÁRIO
                            linha_1 += '<text name="C1" class="gTxt" x="' + parseFloat(x1) + '" y="' + linha_1_y_position + '" fill="' + stroke_color + '" style="overflow: inherit;font-weight:600;">' + arr[i] + '</text>';
                            //CIRCLE INICIO DE HORARIO
                            linha_circles += '<circle name="C2" data-line="' + parseFloat(x1 + 17) + '" cx="' + parseFloat(x1 + 17) + '" cy="' + linha_2_y_position + '" r="9" stroke="' + stroke_color + '" stroke-width="4" fill="white" /> ';
                            //Vertical Line                            
                            timeReef += '<line name="TR_3" class="timeReef ' + segment_type_class + '" data-reef="' + dia_ctx_prv + ' ' + arr[i] + '" x1="' + parseFloat(x1 + 17) + '" y1="40" x2="' + parseFloat(x1 + 17) + '" y2="' + y2_max + '" stroke-dasharray="5, 5" style="stroke:' + stroke_vl + ';stroke-width:1"></line>';
                            begin_x = parseFloat(x1 + 17);
                            //LINHA de INÍCIO ATÉ FIM do PERÍODO
                            linha_2 += '<line name="C3" x1="' + parseFloat(x1 + 28) + '" y1="25" x2="' + parseFloat(x1 + line_full_length + 16) + '" y2="25" style="stroke:' + stroke_color + ';stroke-width:4"></line>';
                            x1 = x1 + line_length_px;

                            //INICIO DE DIA EMBEDDED
                            linha_1 += '<text name="C4" class="gTxt" x="' + parseFloat(x1 - 4) + '" y="' + linha_1_y_position + '" fill="' + sunrise_color + '" style="overflow: inherit;font-weight:600;">' + arr[0] + '</text>';
                            linha_circles += '<circle name="C5" data-line="' + parseFloat(x1 + 12) + '" cx="' + parseFloat(x1 + 12) + '" cy="' + linha_2_y_position + '" r="11" stroke="' + sunrise_color + '" stroke-width="3" fill="white" /> ';
                            linha_sunrise += '<text name="C6" class="sunrise" x="' + parseFloat(x1 + 5) + '" y="' + linha_2_y_pos_icon_inside + '" fill="' + sunrise_color + '" style="overflow: inherit;font-weight:600;font-size:1em;">&#xf766</text>';
                            x1 = x1 + 14;

                            //********************* TODO ***********************//
                            // FALTA HORA FIM DO INTERVALO -> SE o próximo intervalo não estiver colado a esta DT_FIM

                            if (verticalReferences) {
                                verticalReferences += ',';
                            }

                            //Quantos pixeis vale 1 minuto
                            d1 = dia_ctx_prv + ' ' + arr[i];
                            d2 = dia_ctx + ' ' + arr[i + 1];
                            x_ratio = (parseFloat(end_x) - parseFloat(begin_x)) / timeDifference(d1, d2);
                            verticalReferences += '{"ref":"3", "type":"' + segment_type_class + '", "begin":"' + d1 + '", "end":"' + d2 + '", "begin_x":"' + begin_x + '", "end_x":"' + end_x + '", "x_min_ratio": "' + x_ratio + '"}';
                            prv_ctx_ref = dia_ctx;
                            prv_hr_ref = arr[i + 1];
                            drawn_ini_dia = true;
                            drawn = true;
                        } else if ((arr[0] > arr[i]) && (arr[0] > arr[i + 1])) { //CASO PARTICULAR. EX: INICIO_DIA: 08:00 INTERVALO: 07:00 ~ 07:00 -> COD_HOR_DIARIO: 901
                            // ??? prv_ctx_ref = dia_ctx_prv;
                            prv_hr_ref = arr[0];
                            //********************* TODO ***********************//
                        }
                    }

                    // (C) INÍCIO DE DIA :: NO FIM DO INTERVALO
                    if (!drawn_ini_dia) { //Ainda não representamos o Início de DIA
                        if (arr[i + 1] === arr[0]) { //INÍCIO DE DIA NO FIM DO INTERVALO

                            //HORA DE INICIO DO HORÁRIO
                            linha_1 += '<text name="E1" class="gTxt" x="' + parseFloat(x1) + '" y="' + linha_1_y_position + '" fill="' + stroke_color + '" style="overflow: inherit;font-weight:600;">' + arr[i] + '</text>';
                            //CIRCLE INICIO DE HORARIO
                            linha_circles += '<circle name="E2" data-line="' + parseFloat(x1 + 17) + '" cx="' + parseFloat(x1 + 17) + '" cy="' + linha_2_y_position + '" r="9" stroke="' + stroke_color + '" stroke-width="4" fill="white" /> ';
                            begin_x = parseFloat(x1 + 17);
//Vertical Line                            
                            timeReef += '<line name="TR_4" class="timeReef ' + segment_type_class + '" data-reef="' + dia_ctx_prv + ' ' + arr[i] + '" x1="' + parseFloat(x1 + 17) + '" y1="40" x2="' + parseFloat(x1 + 17) + '" y2="' + y2_max + '" stroke-dasharray="5, 5" style="stroke:' + stroke_vl + ';stroke-width:1"></line>';

                            //LINHA de INÍCIO ATÉ INÍCIO de DIA
                            line_length_px = Math.trunc(timeDifference(arr[i], arr[i + 1]) * ratio);
                            linha_2 += '<line name="E3" x1="' + parseFloat(x1 + 28) + '" y1="25" x2="' + parseFloat(x1 + line_length_px) + '" y2="25" style="stroke:' + stroke_color + ';stroke-width:4"></line>';
                            x1 = x1 + line_length_px;

                            //INICIO DE DIA EMBEDDED
                            linha_1 += '<text name="E4" class="gTxt" x="' + parseFloat(x1 - 4) + '" y="' + linha_1_y_position + '" fill="' + sunrise_color + '" style="overflow: inherit;font-weight:600;">' + arr[i + 1] + '</text>';
                            linha_circles += '<circle name="E5" data-line="' + parseFloat(x1 + 12) + '" cx="' + parseFloat(x1 + 12) + '" cy="' + linha_2_y_position + '" r="11" stroke="' + sunrise_color + '" stroke-width="3" fill="white" /> ';
                            end_x = parseFloat(x1 + 12);
//Vertical Line                            
                            timeReef += '<line name="TR_5" class="timeReef ' + segment_type_class + '" data-reef="' + dia_ctx_prv + ' ' + arr[i + 1] + '" x1="' + parseFloat(x1 + 17) + '" y1="40" x2="' + parseFloat(x1 + 17) + '" y2="' + y2_max + '" stroke-dasharray="5, 5" style="stroke:' + stroke_vl + ';stroke-width:1"></line>';

                            linha_sunrise += '<text name="E6" class="sunrise" x="' + parseFloat(x1 + 5) + '" y="' + linha_2_y_pos_icon_inside + '" fill="' + sunrise_color + '" style="overflow: inherit;font-weight:600;font-size:1em;">&#xf766</text>';
                            x1 = x1 + 10;

                            if (verticalReferences) {
                                verticalReferences += ',';
                            }
                            //Quantos pixeis vale 1 minuto
                            d1 = dia_ctx_prv + ' ' + arr[i];
                            d2 = dia_ctx_prv + ' ' + arr[i + 1];
                            x_ratio = (parseFloat(end_x) - parseFloat(begin_x)) / timeDifference(d1, d2);
                            verticalReferences += '{"ref":"4", "type":"' + segment_type_class + '", "begin":"' + d1 + '", "end":"' + d2 + '", "begin_x":"' + begin_x + '", "end_x":"' + end_x + '", "x_min_ratio": "' + x_ratio + '"}';

                            prv_ctx_ref = dia_ctx_prv;
                            prv_hr_ref = arr[i + 1];
                            drawn_ini_dia = true;
                            drawn = true;
                        }
                    }
//console.log(i + ': ' + arr[i-1] + " > " + arr[i] + " ~ " + arr[i+1] + " Inicio Dia:" + drawn_ini_dia + " Drawn:" + drawn + ' Prv_hr_ref:' + prv_hr_ref);

                    //Se intervalo não foi desenhado pelas opções anteriores [A, B ou C], teremos um trecho "Normal", ou seja: sem influência do "Início de Dia".
                    if (!drawn) {
                        //Avalia se o INICIO do Intervalo COINCIDE com o FIM do INTERVALO Anterior                        
                        if (prv_hr_ref !== arr[i]) {
                            //Distância entre o intervalo anterior e o início deste
                            if (prv_hr_ref <= arr[i]) {
                                x1 = x1 + Math.trunc(timeDifference(prv_hr_ref, arr[i]) * ratio);
                            } else if (prv_hr_ref > arr[i]) {

                                if (intervalo_idx === 1) {
                                    x1 = x1 + Math.trunc(timeDifference(arr[i], prv_hr_ref) * ratio);
                                } else { //Como os horários são definidos com dias de contexto implícitos em ordem crescente, a partir do 1 intervalo, temos de ajustar a lógica (*)
                                    x1 = x1 + Math.trunc(timeDifference(prv_hr_ref, arr[i]) * ratio);  //(*)
                                }

                                //Intervalos não consecutivos sem "espaço" para que o FIM do Anterior e o INÍCIO deste se sobreponham, damos 22px sobre o fim do anterior
                                if (parseFloat(x1) - parseFloat(last_x1) <= 22) {
                                    x1 = last_x1 + 22;
                                }

                            } else {
                                x1 = x1; //Retoma na referência (anterior)
                                skip_ini_circle = true;
                            }
                        } else {
                            x1 = x1; //Retoma na referência (anterior)
                            skip_ini_circle = true;
                        }

                        if (drawn_ini_dia) {
                            if (verticalReferences) {
                                verticalReferences += ',';
                            }
                            if (arr[i] >= prv_hr_ref) {
                                if (arr[i + 1] > arr[i]) {
                                    //debugger;
                                    d1 = prv_ctx_ref + ' ' + arr[i];
                                    d2 = prv_ctx_ref + ' ' + arr[i + 1];
                                    verticalReferences += '{"ref":"5.1", "type":"' + segment_type_class + '", "begin":"' + d1 + '", "end":"' + d2 + '", "begin_x":"@begin_x@", "end_x":"@end_x@", "x_min_ratio": "@x_ratio@"}';
                                    prv_ctx_ref = prv_ctx_ref;
                                    prv_hr_ref = arr[i + 1];
                                } else {
                                    tmp = new Date(prv_ctx_ref);
                                    tmp = formataData(tmp.setDate(tmp.getDate() + 1), 'y-m-d');
                                    d1 = prv_ctx_ref + ' ' + arr[i];
                                    d2 = tmp + ' ' + arr[i + 1];
                                    verticalReferences += '{"ref":"6", "type":"' + segment_type_class + '", "begin":"' + d1 + '", "end":"' + d2 + '", "begin_x":"@begin_x@", "end_x":"@end_x@", "x_min_ratio": "@x_ratio@"}';
                                    prv_ctx_ref = tmp;
                                    prv_hr_ref = arr[i + 1];
                                }
                            } else {
                                tmp = new Date(prv_ctx_ref);
                                prv_ctx_ref = formataData(tmp.setDate(tmp.getDate() + 1), 'y-m-d');
                                if (arr[i + 1] > arr[i]) {
                                    d1 = prv_ctx_ref + ' ' + arr[i];
                                    d2 = prv_ctx_ref + ' ' + arr[i + 1];
                                    verticalReferences += '{"ref":"7", "type":"' + segment_type_class + '", "begin":"' + d1 + '", "end":"' + d2 + '", "begin_x":"@begin_x@", "end_x":"@end_x@", "x_min_ratio": "@x_ratio@"}';
                                    prv_hr_ref = arr[i + 1];
                                } else {
                                    var tmp = new Date(prv_ctx_ref);
                                    tmp = formataData(tmp.setDate(tmp.getDate() + 1), 'y-m-d');
                                    d1 = prv_ctx_ref + ' ' + arr[i];
                                    d2 = tmp + ' ' + arr[i + 1];
                                    verticalReferences += '{"ref":"8", "type":"' + segment_type_class + '", "begin":"' + d1 + '", "end":"' + d2 + '", "begin_x":"@begin_x@", "end_x":"@end_x@", "x_min_ratio": "@x_ratio@"}';
                                    prv_ctx_ref = tmp;
                                    prv_hr_ref = arr[i + 1];
                                }
                            }
                        } else {
                            if (verticalReferences) {
                                verticalReferences += ',';
                            }
                            if (arr[i + 1] > arr[i]) {
                                d1 = dia_ctx_prv + ' ' + arr[i];
                                d2 = dia_ctx_prv + ' ' + arr[i + 1];
                                verticalReferences += '{"ref":"F_3", "type":"' + segment_type_class + '", "begin":"' + d1 + '", "end":"' + d2 + '", "begin_x":"@begin_x@", "end_x":"@end_x@", "x_min_ratio": "@x_ratio@"}';
                                prv_ctx_ref = dia_ctx_prv;
                                prv_hr_ref = arr[i + 1];
                            } else {
                                d1 = dia_ctx_prv + ' ' + arr[i];
                                d2 = dia_ctx + ' ' + arr[i + 1];
                                verticalReferences += '{"ref":"F_4", "type":"' + segment_type_class + '", "begin":"' + d1 + '", "end":"' + d2 + '", "begin_x":"@begin_x@", "end_x":"@end_x@", "x_min_ratio": "@x_ratio@"}';
                                prv_ctx_ref = dia_ctx;
                                prv_hr_ref = arr[i + 1];
                            }
                        }
                        var consecutive_interval = null;

                        //A composição do intervalo, determinando o X1 e o X2 seria efetuada só com as referências horárias, i.e., sem contexto do dia a que pertencem.
                        //Daqui resultva que se tivermos um horário que termina as 23:59 e outro que começe às 00:00, em lugar do X2 ser 1 min. era de 1399, o que estáva incorrecto.
                        //Daí ser AQUI que faz sentido avaliarmos o tipo de "intervalo" a representar, usando os intevalos do horário contextualizados pelo dia a que dizem respeito
                        //.....
                        if (!skip_ini_circle) {
                            //HORA DE INICIO DO HORÁRIO
                            linha_1 += '<text name="F1" class="gTxt" x="' + parseFloat(x1) + '" y="' + linha_1_y_position + '" fill="' + stroke_color + '" style="overflow: inherit;font-weight:600;">' + arr[i] + '</text>';
                            //CIRCLE INICIO DE HORARIO
                            linha_circles += '<circle name="F2" data-line="' + parseFloat(x1 + 17) + '" cx="' + parseFloat(x1 + 17) + '" cy="' + linha_2_y_position + '" r="9" stroke="' + stroke_color + '" stroke-width="4" fill="white" /> ';
                            begin_x = parseFloat(x1 + 17)
                            timeReef += '<line name="TR_6" class="timeReef ' + segment_type_class + '" data-reef="' + d1 + ' ' + arr[i] + '" x1="' + parseFloat(x1 + 17) + '" y1="40" x2="' + parseFloat(x1 + 17) + '" y2="' + y2_max + '" stroke-dasharray="5, 5" style="stroke:' + stroke_vl + ';stroke-width:1"></line>';
                            x1_prv = parseFloat(x1 + 17);
                        } else {
                            begin_x = parseFloat(x1);
                        }
                        line_length_px = Math.trunc(timeDifference(arr[i], arr[i + 1]) * ratio);

                        //LINHA de INÍCIO ATÉ FIM do PERÍODO
                        linha_2 += '<line name="F3" x1="' + parseFloat(x1 + 10) + '" y1="25" x2="' + parseFloat(x1 + line_length_px) + '" y2="25" style="stroke:' + stroke_color + ';stroke-width:4"></line>';
                        x1 = x1 + line_length_px;

                        //FIM do PERÍODO
                        linha_1 += '<text name="F4" class="gTxt" x="' + parseFloat(x1 - 4) + '" y="' + linha_1_y_position + '" fill="' + stroke_color + '" style="overflow: inherit;font-weight:600;">' + arr[i + 1] + '</text>';
                        linha_circles += '<circle name="F5" data-line="' + parseFloat(x1 + 10) + '" cx="' + parseFloat(x1 + 10) + '" cy="' + linha_2_y_position + '" r="9" stroke="' + stroke_color + '" stroke-width="4" fill="white" /> ';
                        end_x = parseFloat(x1 + 10);

                        //Quantos pixeis vale 1 minuto
                        x_ratio = (parseFloat(end_x) - parseFloat(begin_x)) / timeDifference(d1, d2);
                        //Substituições na STRING
                        verticalReferences = verticalReferences.replace('@begin_x@', begin_x);
                        verticalReferences = verticalReferences.replace('@end_x@', end_x);
                        verticalReferences = verticalReferences.replace('@x_ratio@', x_ratio);

                        timeReef += '<line name="TR_7" class="timeReef ' + segment_type_class + '" data-reef="' + d2 + '" x1="' + parseFloat(x1 + 10) + '" y1="40" x2="' + parseFloat(x1 + 10) + '" y2="' + y2_max + '" stroke-dasharray="5, 5" style="stroke:' + stroke_vl + ';stroke-width:1"></line>';
                        x1 = x1 + 10;
                    }

                    //Representação Gráfica do Intervalo
                    html_ += '<g id="ew' + intervalo_idx + '" data-segment_description="' + segment_description + '" data-ini="' + arr[i] + '" data-fim="' + arr[i + 1] + '" class="svg-tooltip">' +
                            linha_1 +
                            linha_2 +
                            linha_circles +
                            linha_sunrise +
                            //linha_marcacoes + 
                            '</g>';

                    //Re-Inicializações
                    if (1 === 1) {
                        linha_1 = '';
                        linha_2 = '';
                        linha_circles = '';
                        linha_sunrise = '';
                        drawn = false;
                        d1 = null;
                        d2 = null;
                        x1_prv = null;
                        skip_ini_circle = false;
                        begin_x = '';
                        end_x = '';
                        last_x1 = x1;
                    }

                    //Próximo "triplete" TP_HORARIO+BEGIN+END, ficando as referências na próximo ciclo, respetivamente: [i-1], [i], [i+1]
                    i = i + 3;

                    //Controlo de Saída do Ciclo de Desenho
                    if (intervalo_idx === nr_intervalos) {
                        break;
                    }
                }

                if (show_marcacoes) { //Se Houver Marcações
                    //Time Reef
                    timeResume = '<g id="marcadores" class="timeReef">' +
                            timeReef +
                            '</g>';
                    //Draw TIME QUALIFICATION
                    punchesGraph = drawPunchCardEntry(JSON.parse("[" + verticalReferences + "]"), 55, step_trechos); // y=55 "middle" to draw center lines :: y1=[40] y2=[70] middle = 40 + 15 = 55 
                    //console.log(punchesGraph);
                    punchesGraph = '<g id="intervals" class="timeReef" >' +
                            punchesGraph
                    '</g>';

                    //Adjust Height to "variable" content to show...
                    $(selector).removeAttr('viewBox');
                    if (!vp_last_y) {
                        $(selector).each(function () {
                            $(this)[0].setAttribute('viewBox', '0 0 1055 90')
                        });
                    } else {
                        $(selector).each(function () {
                            $(this)[0].setAttribute('viewBox', '0 0 1055 ' + vp_last_y)
                        });
                    }

                    //Render Graph + Marcações
                    $(selector).html(html_ + timeResume + punchesGraph);

                } else { //Se não Houver Marcações (Esta modalidade permitirá reutilizar este código só para representar um Horário Diário, p.ex: na definição de Horários Diários)

                    //Adjust Height
                    $(selector).removeAttr('viewBox');
                    $(selector).each(function () {
                        $(this)[0].setAttribute('viewBox', '0 0 1055 5')
                    });
                    //Render Graph
                    $(selector).html(html_);
                }

                //BUILD ToolTip Events
                var triggers = document.getElementsByClassName('svg-tooltip');
                for (var i = 0; i < triggers.length; i++) {
                    triggers[i].addEventListener('mouseenter', ShowTooltip);
                    triggers[i].addEventListener('mouseleave', HideTooltip);
                }
            }

            //Evento de SELECÇÃO de UM DIA QUALIFICADO :: SELECT 
            //$(document).on('click', '#RH_ID_HDR_PONTO > tbody tr.selected', function (ev) {
            $(document).on('click', '#RH_ID_HDR_PONTO > tbody', function (ev) {
                ev.stopImmediatePropagation();
                $('#DSP_HOR_DIARIO').css('display', 'block');
                setTimeout(function (detailData) { // 500 mls PARA TERMOS TEMPO DE OBTER OS DETALHES COM OS PERÍODOS QUALIFICADOS....
                    var selectedRow = RH_ID_HDR_PONTO.selectedRowData();
                    var tmp, punchesData = [];
                    var punchesPairs = [], tmp = RH_DET_PONTOS.tbl.data(); //Pares de Marcações de Ponto :: DETAIL DATA                 
                    tmp.data().each(function (d) {
                        punchesPairs.push(d);
                    });

                    //Clean Horário Diário Info                
                    $('#schedule_1').html('');
                    //$('#horarioDiarioInfo').hide('slow');

                    if (RH_ID_HDR_PONTO.tbl.rows('.selected').any()) {

                        //RECURSO DOMAIN :: GET RESOURCE
                        // var res=initApp.joinsData["RH_DEF_HORARIOS.TP_HORARIO"]

                        //RECURSO LISTA COMPLEXA :: GET RESOURCE
                        var res = RH_ID_HDR_PONTO.getComplexListIndex(_.find(RH_ID_HDR_PONTO.tableCols, {name: "DSP_HOR_DIARIO"}));

                        //Procura no RECURSO o valor da COLUNA NO REGISTO SELECIONADO (Cd. Horário Diario)
                        var data = _.find(res, {VAL: selectedRow['CD_HOR_DIA']});

                        if (data['OTHERVALUES'].replace('@', '').length) {

                            //Draw Day Graph
                            drawDaySchedule('#schedule_1', selectedRow['DIA'], data['OTHERVALUES'], punchesPairs);

                            //                        $("[rel='tooltip']").tooltip();
                            $('#horarioDiarioInfo').css('opacity', '1');
                            $('#horarioDiarioInfo').show('slow');
                            //                        $('#horarioDiarioInfo').slideDown({
                            //                                    "duration": 600, 
                            //                                    "easing": 'swing',
                            //                                    "start": function() {
                            //                                        $(this).css('opacity','0.0');//.css('font-size', '0.0em');
                            //                                    },
                            //                                    "step": function() {
                            //                                        var opac = $(this).css('opacity');
                            //                                        $(this).css('opacity', Number(opac) + Number(0.1) ); //.css('font-size', Number(opac) + Number(0.1)+'em');
                            //                                    },
                            //                                    "complete": function() {
                            //                                    }
                            //                                }).css('animation-timing-function','cubic-bezier(0, 0, 0.79, 0.99)'); 

                            //Check if there's any QUAFILIFICATION "off the chart" in order to SIGNAL IT on 1st COLUMN of each ROW on instance RH_DET_PONTOS
                            punchesPairs.filter(obj => {
                                if (obj['OFF'] === 'S') {
                                    $('#' + obj['DT_RowId']).find('td:first-child').css('background-color', 'moccasin');
                                }
                            });
                        }
                    } else {
                        //Clean Horário Diário Info
                        cleanSheduleGraph();
                        $('#schedule_1').html('');
                        $('#horarioDiarioInfo').hide('slow');
                    }
                }, 500);
            });
        }
        //END SVG :: Horario Diário + Qualificação
        
    //});
    };
    
    $(document).ready(function () {
        pagefunction();
        
        //Recalc INSTANCE on EXPAND        
        $(document).on('click', 'table.table-responsive > tbody tr > td:first-child', function (evt) {
            var instance_name = $(this).closest('table').attr('id');
            $( "#" + instance_name).DataTable()
                .columns.adjust()
                .responsive.recalc();
                $(window).trigger("resize");
        });

    });

    var pagedestroy = function () {
//        RH_ID_FERIAS = {}; 
//        RH_ID_AUSENCIAS = {}; 
//        RH_ID_DET_ADAPTABILIDADES = {}; 
//        RH_ID_TS = {}; 
//        RH_ID_DC_DEBITOS = {}; 
//        RH_ID_MARCACOES = {}; 
//        RH_ID_HDR_PONTO = {}; 
//        RH_DET_PONTOS = {}; 

//        delete RH_ID_FERIAS;   //MEMORY :: Garbage
//        delete RH_ID_AUSENCIAS;
//        delete RH_ID_DET_ADAPTABILIDADES;
//        delete RH_ID_TS;
//        delete RH_ID_DC_DEBITOS;
//        delete RH_ID_MARCACOES;
//        delete RH_ID_HDR_PONTO;
//        delete RH_DET_PONTOS;

        $("#rhidTMFilter").off("change", ":input");
        $(document).off('RH_ID_AUSENCIASAttachEvt');
        $(document).off('RH_ID_DC_DEBITOSAttachEvt');
        $(document).off('click', '#myVacationGraphChangeCircleSize');

        //$('#xpto').remove(); //Clear DOM
    };
</script>
