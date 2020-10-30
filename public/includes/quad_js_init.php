<?php
/* 
 * Inicialização do ambiente JS da aplicação
 * 
 * Funções JS específicas QUAD
 * 
 */
?>
<script>
    
    /* Permite converter milisegundos em Minutos:Segundos
     * var t0 = performance.now();
     * execute_me();
     * var t1 = performance.now();
     * console.log("Call Database Tables & Views took " + millisToMinutesAndSeconds(t1 - t0) + " (MM:SS)");
     */

    function millisToMinutesAndSeconds(millis) {
        var minutes = Math.floor(millis / 60000);
        var seconds = ((millis % 60000) / 1000).toFixed(0);
        return minutes + ":" + (seconds < 10 ? '0' : '') + seconds;
    }

    /* Permite injetar scripts em modo async */
    function loadScript(url, callback) {
        var script = document.createElement("script")
        script.type = "text/javascript";
        if (script.readyState) {  //IE
            script.onreadystatechange = function () {
                if (script.readyState == "loaded" ||
                    script.readyState == "complete") {
                    script.onreadystatechange = null;
                    callback();
                }
            };
        } else {  //Others
            script.onload = function () {
                callback();
            };
        }
        script.src = url;
        document.getElementsByTagName("head")[0].appendChild(script);
    }

    //Permite controlar o expand/collappse do menu de navegação
    function showQuadMenu(modo) {
        if (modo == undefined)
            modo = true;
        //Minify Navigator :: Used for heavy interfaces
        var elem = $('body');

        if (!modo) {
            !elem.hasClass('minified') ? elem.addClass('minified') : null;
        } else {
            elem.hasClass('minified') ? elem.removeClass('minified') : null;
        }
    }
    
    //Inicialização das variáveis GLOBAIS para o JS
    var JS_PROFILE = "<?php echo $appProfile; ?>",
        JS_LANG = "<?php echo $lang_js; ?>",
        JS_LANG_DB = "<?php echo @$_SESSION['lang']; ?>",
        JS_CREATE_RECORD_TITLE = "<?php echo $ui_create_record_title; ?>",
        JS_UPDATE_RECORD_TITLE = "<?php echo $ui_update_record_title; ?>",
        JS_ADVANCE_SEARCH_TITLE = "<?php echo $ui_advance_search; ?>",
        JS_ORDER_BY_TITLE = "<?php echo $ui_order_by_title; ?>",
        JS_ORDER_BUTTON = "<?php echo $ui_order_button; ?>",        
        JS_QUERY = "<?php echo $ui_query; ?>",
        JS_QUERY_EXECUTE = "<?php echo $ui_execute_query; ?>",
        JS_EDIT = "<?php echo $ui_edit; ?>",
        JS_SAVE = "<?php echo $ui_save; ?>",
        JS_CREATE = "<?php echo $ui_create; ?>",
        JS_CANCEL = "<?php echo $ui_cancel; ?>",
        JS_DELETE = "<?php echo $ui_remove; ?>",
        JS_PREVIOUS = "<?php echo $ui_previous; ?>",
        JS_NEXT = "<?php echo $ui_next; ?>",
        JS_DELETE_CONFIRMATION = "<?php echo $ui_delete_record; ?>",
        JS_WARNING_UNDONE = "<?php echo $warning_undone; ?>",
        JS_WARNING = "<?php echo $ui_warning; ?>",
        JS_YES = "<?php echo $ui_yes; ?>",
        JS_NO = "<?php echo $ui_no; ?>",
        JS_CLOSE = "<?php echo $ui_close; ?>";
        JS_OPERATION_ABORT = "<?php echo $ui_operation_canceled; ?>",
        JS_RECORD_NOT_DELETED = "<?php echo $ui_record_not_deleted; ?>",
        JS_OPERATION_COMPLETED = "<?php echo $ui_operation_completed; ?>",
        JS_OPERATION_ERROR = "<?php echo $ui_operation_error; ?>",
        JS_OPERATION_CONFIRMATION = "<?php echo $msg_operation_confirmation; ?>",
        JS_NO_RECORDS_FOUND = "<?php echo $ui_no_records_found; ?>",
        JS_LOGOUT = "<?php echo $ui_logout; ?>",
        JS_SAVE_NEW_LANG = "<?php echo $ui_save_new_lang; ?>",
        JS_HINT_PREFERENCE = "<?php echo $hint_preference; ?>",
        JS_COMPILING_DATA = "<?php echo $ui_action_collect_data; ?>",
        JS_EXPORTING = "<?php echo $ui_action_exporting; ?>",
        JS_IMPORT = "<?php echo $ui_action_import; ?>",
        JS_LONG_OPERATION = "<?php echo $warning_long_operation; ?>",
        JS_DAY = "<?php echo $ui_day; ?>",
        JS_DAYS = "<?php echo $ui_days; ?>",
        JS_HOUR = "<?php echo $ui_hour; ?>",
        JS_HOURS = "<?php echo $ui_hours; ?>",
        JS_MINUTE = "<?php echo $ui_minute; ?>",
        JS_MINUTES = "<?php echo $ui_minutes; ?>",
        JS_SECOND = "<?php echo $ui_second; ?>",
        JS_SECONDS = "<?php echo $ui_seconds; ?>",
        JS_HOURS_SHORT = "<?php echo $ui_hours_short; ?>",
        JS_HOUR_SHORT = "<?php echo $ui_hour_short; ?>",
        JS_MINUTES_SHORT = "<?php echo $ui_minutes_short; ?>",
        JS_AND = "<?php echo $ui_and; ?>",
        JS_COMMUNICATION_ERROR = "<?php echo $error_comunications; ?>",
        JS_UNDO_REMOVE_FILE = "<?php echo $hint_undo_remove_file; ?>",
        JS_CHOOSE_FILE = "<?php echo $ui_choose_file; ?>",
        JS_GO_URL = "<?php echo @$_SESSION['GO_URL']; ?>",
        JS_FIELD_REQUIRED = "<?php echo $error_field_required; ?>",
        JS_QUAD_HCM_FILTER_SELECT = "<?php echo $ui_select; ?>",
        JS_QUAD_HCM_FILTER_TITLE = "<?php echo $ui_filter_modal_title; ?>",
        JS_CREATED = "<?php echo $ui_created_by_on; ?>", 
        JS_LAST_CHANGED = "<?php echo $ui_last_change_by_on; ?> ";
        JS_WORKFLOW_ERROR = "<?php echo $msg_invalid_workflow_resources; ?> ";
        JS_HELPDESK_CONTACT = "<?php echo $hint_contact_tecnical_suport; ?> ";
        JS_REPORT_ERROR_CODE = "<?php echo $helpdesk_print_screen; ?>";
        JS_NO_ACCESS = "<?php echo $prohibited_access; ?>";
        JS_ELAPSED_TIME = "<?php echo $ui_elapsed_time; ?>";
        JS_LAST_CHANGED = "<?php echo $ui_last_change_by_on; ?> "
        JS_REPORT_ERROR_CODE ="<?php echo $ui_last_change_by_on; ?> "
        JS_WORKFLOW_ERROR="<?php echo $ui_last_change_by_on; ?> ";
        JS_ID_PERFIL = "<?php echo @$_SESSION['id_perfil']; ?>";
        JS_CREATED_AD = "<?php echo $ui_creation; ?>";
        JS_EVALUATION_AD = "<?php echo $ui_assessment; ?>";
        JS_HOMOLOGATION_AD = "<?php echo $ui_homologation; ?>";
        JS_AGREMENT_AD = "<?php echo $ui_agreement; ?>";
        JS_REQUIRED_QUERY = "<?php echo $hint_required_query; ?>";
        JS_CHANGE_REJECTED = "<?php echo $msg_change_rejected; ?>";
        JS_CHANGE_REGISTERED = "<?php echo $msg_change_registered; ?>";
        JS_APPROVE = "<?php echo $ui_approve; ?>";
        JS_REJECT = "<?php echo $ui_reject; ?>";
        JS_DELETE = "<?php echo $ui_delete; ?>";
        JS_APPROVE_ALL = "<?php echo $ui_approve_all; ?>";
        JS_REJECT_ALL = "<?php echo $ui_reject_all; ?>";
        JS_BEFORE = "<?php echo $ui_before; ?>";
        JS_AFTER = "<?php echo $ui_after; ?>";
        JS_COLUMN = "<?php echo $ui_column; ?>";
        JS_OPERATION = "<?php echo $ui_operation; ?>";
        JS_ON_DATE = "<?php echo $ui_on_date; ?>";
        JS_TIT_PROFILE = "<?php echo $ui_profile; ?>";
        JS_USER = "<?php echo $ui_user; ?>";
        JS_REPLACE_FILE = "<?php echo $ui_replace_file; ?>";
        JS_RECORDS_CHANGE_BY_OTHER_USER = "<?php echo $hint_record_changed_by_other_user; ?>";
        JS_GO_RECORD = "<?php echo $hint_go_to_record; ?>";
        JS_EXECUTE = "<?php echo $ui_execute; ?>";
        JS_CHANGE_BEFORE_PROCEED = "<?php echo $msg_need_change_field; ?>";
        JS_INVALID_OPERATION = "<?php echo $msg_invalid_operation; ?>";
        JS_ACCESS_DENIED = "<?php echo $msg_access_denied; ?>";
    var exportBox = {
            title: JS_EXPORTING,
            content: '<i class="fa fa-clock-o"></i>&nbsp;<i>' + JS_LONG_OPERATION + '</i>',
            color: "#8ae0f2",
            iconSmall: "fa fa-times fa-2x fadeInRight animated"
            //timeout: 1500
        },
        extBut = '<span class="demo-liveupdate-1 switchSpan">' +
            '<span class="onoffswitch-title">Extras</span>' +
            '<span class="onoffswitch">' +
            '<input type="checkbox"   class="onoffswitch-checkbox exportForm"  id="teste22" data-exclude=true>' +
            '<label class="onoffswitch-label" for="teste22">' +
            ' <span class="onoffswitch-inner" data-swchon-text="ON" data-swchoff-text="OFF"></span>' +
            '<span class="onoffswitch-switch"></span>' +
            '</label>' +
            ' </span>' +
            '</span>';
    
    // obtenção do URL para utilizar nas chamadas dos controladores
    var pn = "<?= APP_URL?>/";
    
    /* Função de exportação de dados de uma instância QuadTable e quadForm */
    function exportTo(e, dt, button, config, expTo) {
        $("body").css("cursor", "progress");
        if (this instanceof QuadForm) {
            if (this.myData["data"] && this.myData["data"].length > 0) {
                this.exportData();
                quad_notification(exportBox);
            } else {
                quad_notification({
                    type: "warning",
                    title: "<?php echo $ui_export; ?>",
                    content: '<i class="fa fa-clock-o"></i>&nbsp;<i>' + "<?php echo $warning_no_data; ?>" + '</i>',
                    timeout: 3000
                });
            }
            return;
        }
        var o = dt.settings();
        var obj = window[o[0].nTable.id];
        if (dt.data().count() > 0) {
            obj.exportData(dt, e, button, config, expTo);
            //quad_notification(exportBox); Manage by Process.js
        } else {
            quad_notification({
                type: "warning",
                title: "<?php echo $ui_export; ?>",
                content: '<i class="fa fa-clock-o"></i>&nbsp;<i>' + "<?php echo $warning_no_data; ?>" + '</i>',
                timeout: 3000
            });
        }
        $("body").css("cursor", "default");
    }

    function importTo(e, dt, button, config, expTo) {
        var obj = this;
        if ($("#importToTable").length === 0) {
            var endpoint= "data-source/importFile.php";
            var fileinput = "<form  method=\"post\" action='"+endpoint+"' enctype=\"multipart/form-data\"><input type=\"file\" id=\"importToTable\">,</form>";
            $(fileinput).appendTo("body");
            $("#importToTable").css('opacity', '0');
        }
        $("#importToTable").trigger('click');

        $("#importToTable").on("change", function (e) {
            e.stopImmediatePropagation();
            var frmData = new FormData();
            frmData.append( 'file', $(this)[0].files[0] );
            var funcFields = [];
            if (obj instanceof QuadTable) {
                _.map(obj.tableCols, function(o, i) {
                    if (o && o.func) {
                        funcFields.push(o.data);
                    }
                });
            } else if (obj instanceof QuadForm) {
                _.map(obj.dbColumns, function(o, i) {
                    if (o && o.funcField) {
                        funcFields.push(o.db);
                    }
                });
            }

            //dados para o servidor interpretar
            var cxLists = obj.getInstanceComplexLists();

            var domains = obj.getInstanceDomains();
            var mData = {
                domains: JSON.stringify(domains),
                cxLists: cxLists,
                pk: obj.pk.primary,
                workFlow: obj.workFlow,
                operation: obj.operation,
                operacao: obj.operation,
                columnsArray: JSON.stringify(obj.dbColumns),
                validations: JSON.stringify( obj.validations),
                table: obj.table,
                dbAlias: "A1",
                funcFields: funcFields
            };
          frmData.append("fieldsData", JSON.stringify(mData));
            $("#importToTable").val('');
            $.ajax({
                async:true,
                url: datatable_instance_defaults.pathToSqlFile+obj.import.controller,
                data: frmData,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function(data){
                }
            });



        });


    }

    lang_db = "<?php echo @$_SESSION['lang_db']; ?>";
    
    /* Validation messages: https://jqueryvalidation.org */
    jQuery.extend(jQuery.validator.messages, {
        required: "<?php echo $error_required; ?>",
        remote: "<?php echo $error_remote; ?>",
        email: "<?php echo $error_email; ?>",
        url: "<?php echo $error_url; ?>",
        date: "<?php echo $error_date; ?>",
        dateISO: "<?php echo $error_dateISO; ?>",
        datetimeShort: "<?php echo $datetimeShort; ?>",
        integer: "<?php echo $error_integer; ?>",
        number: "<?php echo $error_number; ?>",
        digits: "<?php echo $error_digits; ?>",
        creditcard: "<?php echo $error_creditcard; ?>",
        equalTo: "<?php echo $error_equalTo; ?>",
        accept: "<?php echo $error_accept; ?>",
        maxlength: jQuery.validator.format("<?php echo $error_maxlength; ?>"),
        minlength: jQuery.validator.format("<?php echo $error_minlength; ?>"),
        rangelength: jQuery.validator.format("<?php echo $error_rangelength; ?>"),
        range: jQuery.validator.format("<?php echo $error_range; ?>"),
        max: jQuery.validator.format("<?php echo $error_max; ?>"),
        min: jQuery.validator.format("<?php echo $error_min; ?>"),
        dateNextThan: "<?php echo $error_end_dt_greater; ?>",
        notEqualToField: "<?php echo $error_evaluator; ?>",
        time24Minutes: "<?php echo $error_time24Minutes; ?>",
        time24Seconds: "<?php echo $error_time24Seconds; ?>"
    });

    //DataTables defaults
    datatable_instance_defaults = {
        order: false,
        colReorder: false,
        export: true,
        responsive: true,
        uploadController: "quad_controller_upload.php",
        sqlFile: "quad_controller.php", // controller
        pathToSqlFile: pn + "data-source/", //controller path
        pathToListsFile: pn + "data-source/quad_lists_lib.php", // lists controller path
        pathToComplexListsFile: pn + "data-source/complexLists.php",
        sqlValidator: "quad_validator.php", // controller
        info: true, //Bottom left info. It's not working!!
        joinsData: [], // we save data for decode lists
        serverSideProcessing: true, //mandatory (true) because client side operation is not fully functional
        processing: false,
        searching: false, //enable global search input element
        scrollCollapse: true, //adjust table height --- not mandatory
        searching: false, // no search input on datatables
        paging: false, // in use . mandatory(true) . After scrolling implementation this will be removed
        workFlow: false, //todo --- is Partially implemented(dont show or save workflow) but Column must also be hidden if FALSE???
        hideExternalPk: true, // if it is dependent object(details) show/hide external key fields in table and editor todo method not fully tested . Now we have to must add("type": 'hidden' , visible: false) on external key fields
        tbl: {},
        editor: {},
        "bDeferRender": true,
        i18nEntries: {
            uploadModalTitle: '<?php echo " " . $ui_file_management; ?>',
            record: '<?php echo " " . $ui_records; ?>',
            rowSelected: '<?php echo " " . $ui_rowSelected; ?>',
            clickRow: '<?php echo " " . $ui_clickRow; ?>'
        },       
        // Centralized "Extras" Version
        buttons: [
            {
                "extend": 'excelHtml5',
                "text": '<i class="fal fa-file-excel fa-lg" aria-hidden="true"></i>',
                "className": 'btn btn-default btn-xs',
                "titleAttr": "Save as Excel",
                "action": function (e, dt, button, config) {
                    exportTo(e, dt, button, config, 'excel')
                }
                //,exportOptions: {
                // columns: ':visible'
                //}
            }
        ]
    };
    /* Set the defaults for DataTables initialisation
     l - length changing input control
     f - filtering input
     t - The table!
     i - Table information summary
     p - pagination control
     r - processing display element
     https://datatables.net/reference/option/dom
     */
    var DataTable = $.fn.dataTable;
    $.extend(true, DataTable.defaults, {
        dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12'i>>", //"<'row'<'col-sm-5'i><'col-sm-7'p>>",
        renderer: 'bootstrap'
    });

    //Allow us to "truncate" content after cutoff lenght.
    //Ex: render: $.fn.dataTable.render.ellipsis(15) -> "Até comprimento"...
    $.fn.dataTable.render.ellipsis = function (cutoff) {
        return function (data, type, row) {
            if (type === 'display') {
                var str = data.toString(); // cast numbers
                return str.length < cutoff ?
                    str :
                    str.substr(0, cutoff - 1) + '&#8230;';
            }
            // Search, order and type can use the original data
            return data;
        };
    };
    //});

</script>
