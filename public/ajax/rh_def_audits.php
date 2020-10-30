<?php
    require_once '../init.php';
?>
<!-- BEGIN Page Content -->
<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <span class="widget-icon"> <i class="far fa-bell"></i></span>&nbsp;
                <h2><?php echo $ui_audits; ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">                                            
                    <a id="RH_DEF_ALERTAS_PROCESSAMENTO_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                    <table id="RH_DEF_ALERTAS_PROCESSAMENTO" class="table table-bordered table-hover table-striped w-100"></table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <span class="widget-icon"> <i class="fal fa-clone"></i></span>&nbsp;
                <h2><?php echo $ui_details; ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <form action="" id="RH_DEF_ALERTAS_2" class="form-horizontal-standard" novalidate="novalidate">
                        <div class="quad-alert"></div>
                        <form-toolbar></form-toolbar>
                        
                        <!-- SQL -->
                        <fieldset class="first-line mb-4"> 
                            <header class="frmInnerHeader"><?php echo $ui_sql_statement; ?></header>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <textarea class="form-control sql" name="REGRA_VALIDACAO"></textarea>
                                        <div class="note"></div>
                                    </div>                                                                               
                                </div>                                                                            
                            </div>
                        </fieldset>
                        
                        <!-- MSG -->                        
                        <fieldset class="first-line mb-4"> 
                            <header class="frmInnerHeader"><?php echo $ui_message; ?></header>
                            <div class="row">                                
                                <div class="col-md-12">
                                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <textarea class="form-control" name="MSG"></textarea>
                                    </div>
                                </div>
                            </div>
                        </fieldset> 
                        

                        <!-- Regra -->
                        <fieldset class="first-line mb-4"> 
                            <header class="frmInnerHeader"><?php echo $ui_notification_rule; ?></header>
                            <div class="row">                                
                                <div class="col-md-12">
                                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <textarea class="form-control" name="REGRA_NOTIF"></textarea>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->
    
<script>

    pageSetUp();

    $(document).ready(function () {
        //Alertas
        var optionRH_DEF_ALERTAS_PROCESSAMENTO = {
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_audit; ?>",
            "tableId": 'RH_DEF_ALERTAS_PROCESSAMENTO',
            "table": "RH_DEF_ALERTAS_PROCESSAMENTO",
            "pk": {
                "primary": {
                    "ID": {"type": "number"}
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
            "detailsObjects": ['RH_DEF_ALERTAS_2'],
            //"initialWhereClause": whereClause_,
            "order_by": "ID",
            "scrollY": "156", //"195" "156", 
            "recordBundle": 10, //6  5
            "pageLenght": 10,  //6 5
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
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'ID',
                    "name": 'ID',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 30%;"
                    } 
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_designation; ?>",
                    "data": 'DSP',
                    "name": 'DSP',
                    "className": "visibleColumn"   
                }, {
                    "title": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_notification_channels, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_notification_channels, 'UTF-8'); ?>" + "</span>", //Editor
                    "data": '',
                    "name": 'TIT_NOTIFICATION',
                    "type": "readonly",
                    "className": "none",
                    "defaultContent": "", //Must be used on STATIC columns content. On this case classes make there way...
                    "attr": {
                        "style": "display: none;"
                    }                      
                }, {
                    "responsivePriority": 5,
                    "title": "<?php echo mb_strtoupper($ui_screen, 'UTF-8'); ?>", //Datatables
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_screen; ?>" + "</span>", //Editor
                    "data": 'NOTIF_ECRAN',
                    "name": 'NOTIF_ECRAN',
                    "type": "select",
                    "def": "N",
                    "className": "editorSubTitle visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',
                        "class": "form-control",
                        "style": "width: 30%;"
                    }
                }, {
                    "responsivePriority": 6,
                    "title": "<?php echo mb_strtoupper($ui_email, 'UTF-8'); ?>", //Datatables
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_email; ?>" + "</span>", //Editor
                    "data": 'NOTIF_EMAIL',
                    "name": 'NOTIF_EMAIL',
                    "type": "select",
                    "def": "N",
                    "className": "editorSubTitle visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',
                        "class": "form-control",
                        "style": "width: 30%;"
                    }
                }, {
                    "responsivePriority": 7,
                    "title": "<?php echo mb_strtoupper($ui_sms, 'UTF-8'); ?>", //Datatables
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_sms; ?>" + "</span>", //Editor
                    "data": 'NOTIF_SMS',
                    "name": 'NOTIF_SMS',
                    "type": "select",
                    "def": "N",
                    "className": "editorSubTitle visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',
                        "class": "form-control",
                        "style": "width: 30%;"
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'REGRA_VALIDACAO',
                    "name": 'REGRA_VALIDACAO',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 1,
                    "title": "<?php echo mb_strtoupper($ui_status, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "", //Editor
                    "data": '',
                    "name": 'SQL_PARSER',
                    "type": "readonly",
                    "className": "shortest",
                    "defaultContent": "", //Must be used on STATIC columns content. On this case classes make there way...
                    "attr": {
                        "style": "display: none;"
                    }
                }, {
                    "responsivePriority": 4,
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
                        "class": "form-control",
                        "style": "width: 30%;"
                    },
                    "render": function (val, type, row) {
                        if (typeof (val) === "object" && val === null) {
                            return val;
                        } else {
                            var o = _.find(initApp.joinsData['DG_SIM_NAO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
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
                    //"targets": 17,
                    "responsivePriority": 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        return RH_DEF_ALERTAS_PROCESSAMENTO.crudButtons(true, true, true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "ID": {
                        required: true,
                        integer: true,
                        maxlength: 11
                    },
                    "DSP": {
                        required: true,
                        maxlength: 80
                    },
                    "ACTIVO": {
                        required: true
                    }
                }
            },
            "rowCallback": function( row, data ) { //EACH ROW BEFORE HTML RENDERING : row -> HTML ELEMENT, data -> OBJECT DATA
                //console.log (data['ID'] + '> ' + data['REGRA_VALIDACAO']);
                if (data['REGRA_VALIDACAO'] !== '') {                    
                    t0 = performance.now(),
                    wk = new Worker("<?=ASSETS_URL?>/lib/quad/workerRouter.js"),
                    message = {
                        request_id: 'Parse_Sql',
                        sql_statement: data['REGRA_VALIDACAO'],
                        defaults: datatable_instance_defaults.pathToSqlFile
                    },
                    mssg = '';
                    wk.postMessage(JSON.stringify(message));
                    wk.onmessage = function (event) {                
                        if (event.data === 'working') {
                            return;
                        } else {
                            t1 = performance.now();
                            tmp = millisToMinutesAndSeconds(t1 - t0);
                            //console.log(event.data);
                            if (event.data.status == 'OK') {
                                $('td:eq(7)', row).html( '<span class="label label-success"><?php echo $ui_parse_ok; ?></span>' );
                            } else if (event.data.status == 'NOK') { 
                                $('td:eq(7)', row).html( '<span class="label label-danger" title="' + event.data.trace + '"><?php echo $ui_parse_nok; ?></span>' );
                            }
                        }                    
                    }
                }
            }
        };
        RH_DEF_ALERTAS_PROCESSAMENTO = new QuadTable();
        RH_DEF_ALERTAS_PROCESSAMENTO.initTable($.extend({}, datatable_instance_defaults, optionRH_DEF_ALERTAS_PROCESSAMENTO));    
        //END Alertas
        
        //Alertas Continued :: QUADFORMS
        var optionsRH_DEF_ALERTAS_2 = {
            formId: "#RH_DEF_ALERTAS_2",
            table: "RH_DEF_ALERTAS_PROCESSAMENTO",
            info: true, //Disables INFO: (record / total records) :: HOW ????
            "pk": {
                "primary": {
                     "ID": {"type": "number"}
                }
            },
            "dependsOn": {
                "RH_DEF_ALERTAS_PROCESSAMENTO": {
                    "ID": "ID"
                }
            },
            // "initialWhereClause": " SEXO = 'M' ", optional
            //"order_by": "NOME",
            //detailsObjects: ['qTableDocs', 'qTableAgregados', 'Documentos', 'Agregados'],                
            "recordBundle": 1,
            crud: [false, true, false],//create,update,delete
            defaultButtons: ['edit'], //['enter-query', 'new'],
            refreshData: true, //default true
            queryAll: false,//defaults to true ...empty search return all records
            showMultiRecord: false, //default true
            //workflow: true, //optional defaults to false
            showWorkflowOnEdit: false,               
        };        
        RH_DEF_ALERTAS_2 = new QuadForm();
        RH_DEF_ALERTAS_2.initForm($.extend({}, datatable_instance_defaults, optionsRH_DEF_ALERTAS_2));
        //Alertas Continued :: QUADFORMS  
        
        //TODO :: popover
        
        //On QUADFORMS SAVE -> PARSE SQL
        $('#RH_DEF_ALERTAS_2 > div.btn-toolbar > ul > li:nth-child(6) > a').on('click', function () {
            var el = $('#RH_DEF_ALERTAS_2 > div.row > fieldset:nth-child(1) > div > textarea'), sql_ = el.val(),
                masterRecord = RH_DEF_ALERTAS_PROCESSAMENTO.tbl.row('.selected').data(),                
                masterColumn = $('#row_' + masterRecord['ID'], '#RH_DEF_ALERTAS_PROCESSAMENTO').find('td:nth-child(8)');
                
            //Cleans PARSER column content on Master Record
            masterColumn.html('');
            
            if (sql_.length) {
                t0 = performance.now(),
                wk = new Worker(pn + "lib/quad/workerRouter.js"),
                message = {
                    request_id: 'Parse_Sql',
                    sql_statement: sql_,
                    defaults: datatable_instance_defaults.pathToSqlFile
                },
                mssg = '';
                wk.postMessage(JSON.stringify(message));
                wk.onmessage = function (event) {                
                    if (event.data === 'working') {
                        return;
                    } else {                   
                        console.log(event.data);
                        t1 = performance.now();
                        tmp = millisToMinutesAndSeconds(t1 - t0);
                        if (event.data.status == 'OK') {
                            //Set's OR Resets SQL input field visual effect
                            el.css({'border':'1px solid #ccc'});
                            //Reset's SQL ERROR on QuadForms element
                            $('.note').html('');
                            //Set's PARSER RESULT into column on Master Record
                            masterColumn.html( '<span class="label label-success"><?php echo $ui_parse_ok; ?></span>' ).fadeOut("slow").fadeIn("slow");
                        } else if (event.data.status == 'NOK') { 
                            //Set's SQL input field visual effect
                            el.css({'border':'2px dashed darkred'});
                            //Set's SQL ERROR on QuadForms element
                            $('.note').html(event.data.trace);
                            //Set's PARSER RESULT into column on Master Record
                            masterColumn.html( '<span class="label label-danger" title="' + event.data.trace + '"><?php echo $ui_parse_nok; ?></span>' ).fadeOut("slow").fadeIn("slow");
                        } else { // "N/A" -> Empty SQL
                            null;
                        }
                    }
                };
            }
        });
        
        //SELECT or DESELECT MASTER ROW
        $(document).on('click', "#RH_DEF_ALERTAS_PROCESSAMENTO > tbody > tr", function( ev ){
            var masterRow = $(this),
                sql_field = $('#RH_DEF_ALERTAS_2 > div.row > fieldset:nth-child(1) > div > textarea'), 
                note = $('#RH_DEF_ALERTAS_2 > div.row > fieldset:nth-child(1) > div > div'),
                masterRecord = RH_DEF_ALERTAS_PROCESSAMENTO.tbl.row('.selected').data();
                
            //Reset FIELD's CSS to "normal"
            sql_field.removeClass('error-disabled-field-error'); //.css({'border':'1px solid #ccc'});
            note.html('').removeClass('error-disabled-color')

            //MASTER ROW :: Deselect
            if ( masterRow.hasClass('selected') ) {    //MASTER ROW :: Select
                //Master STATUS column element
                var masterStatusContent = $('#row_' + masterRecord['ID'], '#RH_DEF_ALERTAS_PROCESSAMENTO').find('td:nth-child(8) > span');
                //IF master record has ERROR
                if ( masterStatusContent.hasClass('label-danger') ) {                    
                    //Set's SQL input field visual effect
                    sql_field.addClass('error-disabled-field-error');
                    //Set's SQL ERROR on QuadForms element         
                    note.addClass('error-disabled-color');
                    note.html( masterStatusContent.attr('title') );
                }
            }
        });
    });
</script>
