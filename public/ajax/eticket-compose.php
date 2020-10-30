<?php
    require_once '../init.php';
?>
<div class="row">

    <div class="col col-xs-8">
        <h2 class="email-open-header">
            <?php echo $ui_new_eticket_title; ?> 
        <!--        <span class="label txt-color-white"> NOT SENT </span>-->
        <!--	<a href="javascript:void(0);" rel="tooltip" data-placement="left" data-original-title="Print" class="txt-color-darken pull-right"><i class="fa fa-print"></i></a>	-->
        </h2>
    </div>
    <div class="col col-xs-4">
        STATUS
    </div>
</div>

</style>
<div class="row">
    <form id="eTicket-compose-form" enctype="multipart/form-data" action="" method="POST" class="col col-md-12 form-horizontal">
        <div class="emailResponse panel-content">        
            <div class="inbox-info-bar no-padding">
                <div class="row">
                    <div class="col col-md-12 form-group mb-0">
                        <label class="control-label col-md-1"><strong><?php echo $ui_eticket_to; ?></strong></label>
                        <div class="col-md-11">
                            <select id="to" name="to" multiple style="width:100%" class="select2"></select>
                            <em><a id="carbonCopy" href="javascript:void(0);" class="show-next" rel="tooltip" data-placement="bottom" data-original-title="Carbon Copy">CC</a></em>
                        </div>
                        <div id="to_error" class="col-md-11 div-error hide">
                            <small class="error-block"><?php echo $ui_required_attribute; ?></small>
                        </div>                              
                    </div>
                </div>	
            </div>

            <div class="inbox-info-bar no-padding hidden">
                <div class="row">
                    <div class="col col-md-12 form-group mb-0">
                        <label class="control-label col-md-1"><strong><?php echo $ui_eticket_cc; ?></strong></label>
                        <div class="col-md-11">
                            <select id="cc" multiple style="width:100%" class="select2 valida" data-select-search="true">
                            </select>
                        </div>
                    </div>
                </div>	
            </div>


            <div class="inbox-info-bar no-padding">
                <div class="row">
                    <div class="col col-md-12 form-group mb-0">
                        <label class="control-label col-md-1"><strong><?php echo $ui_eticket_subject; ?></strong></label>
                        <div class="col-md-11">
                            <input id="subject" class="form-control valida" type="text" autocomplete="off">
                            <em><a href="javascript:void(0);" class="show-next anexos" rel="tooltip" data-placement="bottom" data-original-title="<?php echo $ui_eticket_attachments; ?>"><i class="fa fa-paperclip fa-lg"></i></a></em>
                        </div>
                        <div id="subject_error" class="col-md-11 div-error hide">
                            <small class="error-block"><?php echo $ui_required_attribute; ?></small>
                        </div>
                    </div>
                </div>	
            </div>

            <div class="inbox-info-bar no-padding hidden">
                <div class="row">
                    <div class="col col-md-12 form-group mb-0">
                        <label class="control-label col-md-1"><strong><?php echo $ui_eticket_attachments; ?></strong></label>
                        <div id="fileUploadZone" class="col-md-11 dropzone" >
<!--                                        <input id="files" name="files" class="form-control fileinput" type="file" multiple autocomplete="off">-->
                        </div>
                    </div>
                </div>	
            </div>

            <div class="inbox-info-bar no-padding" style="border-bottom: 0px solid #bfbfbf;">
                <div class="form-row form-group mb-0 row-no-scroll mtb-10 ml-8">
                    <div class="col col-md-2 fc0">
                        <select id="fc0" class="form-control input-sm chosen" title="<?php echo $ui_priority; ?>" data-placeholder="<?php echo $ui_priority; ?>">
                            <option value="" selected></option>
                        </select>
                        <small id="fc0_error" class="error-block hide"><?php echo $ui_required_attribute; ?></small>
                    </div>
                    <div class="col col-md-2 fc1">
                        <select id="fc1" class="form-control input-sm chosen" title="<?php echo $ui_eticket_category; ?>" data-placeholder="<?php echo $ui_eticket_category; ?>">
                            <option></option>
                        </select>
                        <small id="fc1_error" class="error-block hide"><?php echo $ui_required_attribute; ?></small>
                    </div>     
                    <div class="col col-md-3 fc2">
                        <select id="fc2" class="form-control input-sm chosen" title="<?php echo $ui_eticket_request_type; ?>" data-placeholder="<?php echo $ui_eticket_request_type; ?>">
                            <option value="" selected></option>
                        </select>          
                        <small id="fc2_error" class="error-block hide"><?php echo $ui_required_attribute; ?></small>
                    </div>
                    <div class="col col-md-3 fc3">
                        <select id="fc3" class="form-control input-sm chosen" title="<?php echo $ui_eticket_process; ?>" data-placeholder="<?php echo $ui_eticket_process; ?>">
                            <option></option>
                        </select>   
                        <small id="fc3_error" class="error-block hide"><?php echo $ui_required_attribute; ?></small>
                    </div>
                </div>	
            </div>            
        </div>

        <div class="inbox-message no-padding">

            <div id="eTicketBody" formnovalidate></div>	
        </div>

        <div class="inbox-compose-footer">

            <button id="clear" class="btn btn-danger" type="button">
                <?php echo $ui_cancel; ?>
            </button>

            <button id="send" data-loading-text="&lt;i class='fa fa-refresh fa-spin'&gt;&lt;/i&gt; &nbsp; Sending..." class="btn btn-primary pull-right disabled" type="button">
                <?php echo $ui_send; ?> <i class="fa fa-arrow-circle-right fa-lg"></i>
            </button>

        </div>

    </form>
</div>

<script type="text/javascript">   
        pageSetUp();
        var tipo_user = '';
        var pagefunction = function () {
            //RESETs
            tipo_user = null;
            quad_notification_clear();
            $('#to').off('change');
            $('.show-next').off('click');
            $('#clear').off('click');
            $('#send').off('click');
            $('#s2id_to').off('mouseenter');
            $('#subject').off('mouseenter');
            $('.fc0').off('mouseenter');
            $('.fc1').off('mouseenter');
            $('.fc2').off('mouseenter');
            $('.fc3').off('mouseenter');
            $('#filter-options select.chosen').chosen("destroy");
            
            var utilizador = "<?php echo @$_SESSION['utilizador']; ?>", now_ = '';

            //Files Attachment :: PLUG-IN & CONFIGURATION 
            loadScript("assets/js/dropzone/dropzone.min.js", function () {
                var configUpload = new Dropzone('#fileUploadZone', {
                    url: "/file/post",
                    maxFiles: 5,
                    dictDefaultMessage: "<?php echo $ui_drop_files_here; ?>",
                    dictFileTooBig: "<?php echo $hint_max_file_size; ?>",
                    dictInvalidFileType: "<?php echo $hint_invalid_file_extension; ?>",
                    dictRemoveFile: "<?php echo $hint_remove_file; ?>",
                    dictMaxFilesExceeded: "<?php echo $hint_max_files_exceeded; ?>",
                    autoProcessQueue: false,
                    paramName: "files",
                    maxFilesize: 5, //MB
                    addRemoveLinks: true,
                    uploadMultiple: true,
                    maxThumbnailFilesize: 5, //MB
                    thumbnailWidth: 32,
                    thumbnailHeight: 32,
                    acceptedFiles: "image/*, application/pdf,.doc,.docx,.csv,.xls,.xlsx,.zip,.rar",
                    init: function () {
//                    this.on("addedfile", handleFileAdded);
                        this.on("removedfile", handleFileRemoved);
                        this.on("error", function (file) {
                            if (!file.accepted)
                                this.removeFile(file);
                        });
                    }
                });
            });

            //Notify INVALID EXtention
            function handleFileRemoved(fx) {
                var tamanho_ = fx.size / 1024 / 1024, txt = '';
                if (tamanho_ > quadConfig.file_max_size) {
                    txt = "<?php echo $error_file_too_large; ?>".replace("{0}", quadConfig.file_max_size);
                    quad_notification({
                        type: "info",
                        title: '<i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;' + JS_OPERATION_ABORT,
                        content: txt
                    });
                } else {
                    quad_notification({
                        type: "info",
                        title: '<i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;' + JS_OPERATION_ABORT,
                        content: "<?php echo $error_invalid_extension_file; ?>"
                    });
                }
            }

            // PAGE RELATED SCRIPTS
            $(".table-wrap-quad [rel=tooltip]").tooltip();

            /*
             * SUMMERNOTE EDITOR
             */               
            loadScript("assets/js/summernote/summernote-bs4.js", iniTicketBody);

            function iniTicketBody() {
                var y = "<?php echo @$_SESSION['lang']; ?>", editorLang = 'en-US', //Default
                    mySignature = "<?=$_user->ASSINATURA?>";
                    
                //Destroy Instância antes de Criar (língua pode mudar no entretanto)
                $('#eTicketBody').summernote('destroy');                

                //TODO :: DEFINE GLOBAL PROTOCOL TO INDEX FILES ACCORDING TO CURRENT LANGUAGE
                if (y === 'pt') {
                    editorLang = 'pt-PT';
                }
                var resource = "assets/js/summernote/lang/summernote-" + editorLang +  ".js";                
                loadScript(resource, function () {
                    $('#eTicketBody').summernote({
                        //XSS protection for CodeView :: https://summernote.org/deep-dive/#xss-protection-for-codeview
                        codeviewFilter: false,
                        codeviewIframeFilter: true,
                        height: 300,
                        focus: true,
                        tabsize: 2,
                        toolbar: [
                            ['style', ['style']],
                            ['font', ['bold', 'underline', 'clear']],
                            ['fontname', ['fontname']],
                            ['color', ['color']],
                            ['height', ['height']],
                            ['para', ['ul', 'ol', 'paragraph']],
                            ['table', ['link']],
                        ],                        
                        lang: editorLang, /* default: 'en-US' */
                        callbacks: {
                            onInit: function() {
                                //INJECT HTML SIGNATURE (if available)
                                $(this).summernote('code', "<br><br>" + mySignature);

                                //Custom BUTTON for TOOLTIP 
                                if ( !$('#makeRnote').length ) {
                                    var noteBtn = '<button id="makeRnote" type="button" class="note-btn btn btn-light btn-sm infoTooltip" data-html="true" data-toggle="tooltip" data-trigger="hover" data-original-title="' + "<?=$hint_summernote_br?>" +'" tabindex="-1"><i class="fas fa-info"></i></button>';
                                    var fileGroup = '<div class="note-btn-group btn-group" style="float:right;">' + noteBtn + '</div>';
                                    $(fileGroup).appendTo( $('#eTicketBody').next('div').find('.note-toolbar') );

                                    // Button tooltips
                                    $('#makeRnote').tooltip({container: 'body', placement: 'bottom'});
                                    // Button events
                                    //$('#makeSnote').click(function(event) {                                        
                                    //});
                                }
                                //AUTO-SCROLL
                                $("html, body").animate({ 
                                    scrollTop: 300
                                }, 200); 
                            }
                        }                        
                    });
                });
                

            }
            
            //DOMAIN LISTS
            function loadLists() {
                var listas = ['ACTIVE_USERS'], output = ''
                for (i = 0, list_data = []; i < listas.length; i++) {
                    output = '';
                    list_data = initApp.joinsData[ listas[i] ];
                    _.map(list_data, function (o, idx) {
                        if (o['UTILIZADOR'] !== utilizador) {
                            if (o['HELPDESK_SUPORTE']) {
                                output += '<option value="' + o['ID'] + '" data-type="' + o['HELPDESK_SUPORTE'] + '">' + o['UTILIZADOR'] + '</option>';
                            } else {
                                output += '<option value="' + o['ID'] + '">' + o['UTILIZADOR'] + '</option>';
                            }
                        } else {
                            tipo_user = o['HELPDESK_SUPORTE'];
                        }
                    });
                    $('#to').append(output);
                    $('#cc').html('');
                }

                //Clone Filters to E-TICKECT
                $('#fc0').html($('#f0').html());
                $('#fc1').html($('#f1').html());
                $('#fc2').html($('#f2').html());
                $('#fc3').html($('#f3').html());

                var options = {
                    no_results_text: "_RESULTS_VARIABLE",
                    placeholder_text_single: " ",
                    allow_single_deselect: true,
                    search_contains: true
                };

                setTimeout(function () {
                    var elms = $('.attributes select.chosen');
                    elms.chosen(options);
                    elms.trigger("chosen:updated");
                }, 1);

            }

            loadLists();

            //Changes on TO CHANGES CC LIST removing USERS already MENTIONED
            $('#to').on('change', function () {
                if ( $('#to').val() ) {
                    var listas = ['ACTIVE_USERS'], output = '';
                    $('#cc').html('');
                    for (i = 0, list_data = []; i < listas.length; i++) {
                        output = '';
                        list_data = initApp.joinsData[ listas[i] ];
                        _.map(list_data, function (o, idx) {
                            if (o['UTILIZADOR'] !== utilizador) {
                                if (!$('#to').val().includes(o['UTILIZADOR'])) {
                                    if (o['HELPDESK_SUPORTE']) {
                                        output += '<option value="' + o['ID'] + ' data-type="' + o['HELPDESK_SUPORTE'] + '">' + o['UTILIZADOR'] + '</option>';
                                    } else {
                                        output += '<option value="' + o['ID'] + '">' + o['UTILIZADOR'] + '</option>';
                                    }
                                } else {
                                    //User excluded once is on the TO list
                                }
                            } else { //Own USER
                                tipo = o['HELPDESK_SUPORTE'];
                            }
                        });
                        $('#cc').append(output);
                    }
                }
            });

            //HEADER NEW LINE MESSAGE ATTRIBUTES (CC + Attachements)
            $(".show-next").click(function () {
                var $this = $(this),
                    $parent = $this.parent().parent().parent().parent().parent().next();
                if ($this.hasClass('anexos')) { //Anexos :: TOGGLE MODE                    
                    if ( $parent.hasClass("hidden") ) {                        
                        $parent.removeClass("hidden");
                    } else {
                        $parent.addClass("hidden");
                    }
                } else { //Outros Casos
                    $this.hide();
                    $parent.removeClass("hidden");

                }
            })

            /* Clear ERROR's */
            // TO :: REQUIRIED
            $('#s2id_to').on("mouseenter", function (e) {
                $('#to_error').removeClass('show').addClass('hide');
            });

            // SUBJECT :: REQUIRIED
            $('#subject').on("mouseenter", function (e) {
                $('#subject_error').removeClass('show').addClass('hide');
            });

            // PRIORITY :: REQUIRIED
            $('.fc0').on("mouseenter", function (e) {
                $('#fc0_error').removeClass('show').addClass('hide');
            });
            // CATEGORY :: REQUIRIED
            $('.fc1').on("mouseenter", function (e) {
                $('#fc1_error').removeClass('show').addClass('hide');
            });
            // REQUEST TYPE :: REQUIRIED
            $('.fc2').on("mouseenter", function (e) {
                $('#fc2_error').removeClass('show').addClass('hide');
            });
            // PROCESS :: REQUIRIED
            $('.fc3').on("mouseenter", function (e) {
                $('#fc3_error').removeClass('show').addClass('hide');
            });

            //CLEAR NEW E-TICKET
            $("#clear").on('click', function () {
                $('#newEticket').hide("slow").html('');
                $('#eticketContent').removeClass('email-reply-text');
                $('#eticketContent button.replythis').show("slow");
            });

            //SEND / SAVE NEW E-TICKET
            $("#send").click(function () {
                var masterRecord = {};
                masterRecord = WEB_ETICKETS.tbl.row('.selected').data();

                var send = true;
                //$(".SmallBox").remove();
                quad_notification_clear();
                $('#to_error').hide("fast").removeClass('show').addClass('hide');

                /* Validations */
                //to :: REQUIRED :: ARRAY
                if (JSON.stringify($('#to').val()) === "[]") {
                    $('#to_error').removeClass('hide').addClass("show");
                    send = false;
                }

                //subject :: REQUIRED :: STRING
                if (!$('#subject').val()) {
                    $('#subject_error').removeClass('hide').addClass("show");
                    send = false;
                }

                //priority :: REQUIRED
                if (!$('#fc0').val()) {
                    $('#fc0_error').removeClass('hide').addClass("show");
                    send = false;
                }

                //category :: REQUIRED
                if (!$('#fc1').val()) {
                    $('#fc1_error').removeClass('hide').addClass("show");
                    send = false;
                }

                //request type :: REQUIRED
                if (!$('#fc2').val()) {
                    $('#fc2_error').removeClass('hide').addClass("show");
                    send = false;
                }

                //process :: REQUIRED
                if (!$('#fc3').val()) {
                    $('#fc3_error').removeClass('hide').addClass("show");
                    send = false;
                }

                if ($('#eTicket-compose-form div.note-editable').text().length === 0) {
                    quad_notification({
                        type: "warning",
                        title: JS_OPERATION_ABORT,
                        content: "<?php echo $hint_please_fill_eticket_attributes; ?>"
                    });
                }

                //SELECT2 -> el.selectedOptions.val
                var $btn = $(this);
                $btn.button('loading');

                if (send) {
                    if (!masterRecord) { //NEW E-TICKET :: ORIGINAL
                        setTimeout(function () {
                            //AJAX CALL to INSERT NEW 
                            newTicket();
                        }, 250);
                    } else { //NEW E-TICKET :: INTERACTION
                        newTicketInteraction(masterRecord);
                    }
                } else {
                    null;
                }
            });

            //E-TICKET OR INTERACTION :: Detect Attachement File(s) and SAVE if ANY
            function saveFiles(id_ticket_, id_interaction_) {
                var ficheiros = $('#fileUploadZone')[0]['dropzone']['files'], data_attach = {}, id_interaction_ = '', formData = new FormData(document.getElementById('eTicket-compose-form')); //'#eTicket-compose-form');

                //E-Ticket HAS Attachements :: WEB_ETICKET_DOCS
                if (ficheiros.length) {

                    //Se for um attach de um E-TICKET ORIGINAL, esta propriedade não é aplicável (nem passada). 
                    //Daí a inicialização, que o controlador re-interpretará como NULL.
                    if (!id_interaction_) {
                        id_interaction_ = "";
                    }

                    /* Processo de debug para identificar os FORM parameters de #eTicket-compose-form
                     //Display the Keys
                     for (var key of formData.keys()) {
                     console.log(key);
                     }                    
                     // Display the values
                     for (var value of formData.values()) {
                     console.log(value); 
                     }
                     */

                    //Clean PARAMETERS UNSUED for FILE
                    for (var key of formData.keys()) {
                        formData.delete(key);
                    }
                    //Esta chave não é apagada, no cilo anterior!? Daí forçarmos a sua remoção
                    formData.delete('files');

                    //Criação de Array de Ficheiros (ficheiro a ficheiro) como parâmetros a passar para o controlador
                    $.each(ficheiros, function (idx, val) {
                        formData.append("upload[]", val);
                    });

                    //Criação de parâmetros Adicionais para o controlador
                    formData.append('inRowDoc', JSON.stringify({
                        "saveAsBlob": true,
                        "blobField": "BD_DOC",
                        "pathField": "LINK_DOC",
                        "fileNameField": "LINK_DOC",
                        "extField": "BD_MIME",
                        "savePath": "tmp"
                    }));

                    //Inicialização e criação dos dados a inserir, como parâmetro a passar para o controlador
                    data_attach = {
                        "pk": {
                            "ID_DOC": {"type": "numner"}
                        },
                        "workflow": false,
                        "operation": "INSERT",
                        "operacao": "INSERT",
                        "columnsArray": JSON.stringify([
                            {"db": "ID_DOC", "prv_value": "", "nxt_value": "", "diagnostic": "", "datatype": "sequence"},
                            {"db": "ID_ETICKET", "prv_value": id_ticket_, "nxt_value": id_ticket_, "diagnostic": "", "datatype": ""},
                            {"db": "ID_INTERACTION", "prv_value": id_interaction_, "nxt_value": id_interaction_, "diagnostic": "", "datatype": ""},
                            {"db": "BD_MIME", "prv_value": "", "nxt_value": "", "diagnostic": "", "datatype": ""},
                            {"db": "LINK_DOC", "prv_value": "", "nxt_value": "", "diagnostic": "", "datatype": ""}
                        ]),
                        "table": "WEB_ETICKET_DOCS",
                        "dbAlias": "A1",
                    };
                    formData.append('fieldsData', JSON.stringify(data_attach));

                    //Chamada de INSERT com o registo dos documentos associados ao E-TIcket
                    $.ajax({
                        type: "POST",
                        url: pn + '/data-source/quad_controller_upload.php',
                        data: formData,
                        processData: false,
                        contentType: false,
                        cache: false,
                        async: true,
                        beforeSend: function () {
                        },
                        success: function (data) {
                            try {
                                var x = JSON.parse(data)['error'];
                                if (x) {
                                    $(".SmallBox").remove();
                                    $.smallBox({
                                        title: '<i class="fas fa-times"></i>&nbsp;&nbsp;' + JS_OPERATION_ERROR,
                                        content: x + "<?php echo '<br><br>' . $error_on_upload_file; ?>",
                                        color: "#C46A69",
                                        //iconSmall: "fa fa-times fa-2x fadeInRight animated",
                                        //timeout: 1500 -> Se isto estiver comentado tem de fazer “dismiss” no canto superior direito, senão demoraria 1.5 seg até desaparecer
                                    });
                                }
                            } catch (e) {
                                null;
                            }
                            console.log(data);
//                            console.log('Files Returned...');
//                            console.log(data);
//                            var dados = JSON.parse(data).data[0];
                        }
                    });

                }
                return;
            }

            //Compile NEW E-Ticket data and save it to DB
            function newTicket() {
                //Insert send script here
                var utilizador = "<?php echo @$_SESSION['utilizador']; ?>", now_ = hoje("seconds"),
                        to_ = JSON.stringify($('#to').val()), cc_ = '', assunto_ = $('#subject').val(),
                        prioridade_pedida_ = $('#fc0').val(), categoria_ = $('#fc1').val(), tp_pedido_ = $('#fc2').val(), processo_ = $('#fc3').val(),
                        prioridade_ = '', descricao_ = $('#eTicket-compose-form div.note-editable').html();

                if ($('#cc').val()) {
                    cc_ = JSON.stringify($('#cc').val());
                }

                if (tipo === 'S') { //Suporte
                    prioridade_ = prioridade_pedida_;
                }

                //E-TICKET data to pass to INSERT on quad_controller.php
                var data = {
                    "table": "WEB_ETICKETS",
                    "dbAlias": "A1",
                    "pk": {
                        "ID_ETICKET": {"type": "number"}
                    },
                    "workflow": false,
                    "operation": "INSERT",
                    "operacao": "INSERT",
                    "columnsArray": JSON.stringify([
                        {"db": "ID_ETICKET", "prv_value": "", "nxt_value": "", "diagnostic": "", "datatype": "sequence"},
                        {"db": "FROM_", "prv_value": utilizador, "nxt_value": utilizador, "diagnostic": "", "datatype": ""},
                        {"db": "TO_", "prv_value": to_, "nxt_value": to_, "diagnostic": "", "datatype": ""},
                        {"db": "CC", "prv_value": cc_, "nxt_value": cc_, "diagnostic": "", "datatype": ""},
                        {"db": "ESTADO", "prv_value": "A", "nxt_value": "A", "diagnostic": "", "datatype": ""},
                        {"db": "DT_ABERTURA", "prv_value": now_, "nxt_value": now_, "diagnostic": "", "datatype": "datetime"},
                        {"db": "PROCESSO", "prv_value": processo_, "nxt_value": processo_, "diagnostic": "", "datatype": ""},
                        {"db": "CATEGORIA", "prv_value": categoria_, "nxt_value": categoria_, "diagnostic": "", "datatype": ""},
                        {"db": "PRIO_SOLICITADA", "prv_value": prioridade_pedida_, "nxt_value": prioridade_pedida_, "diagnostic": "", "datatype": ""},
                        {"db": "PRIO_ATRIB", "prv_value": prioridade_, "nxt_value": prioridade_, "diagnostic": "", "datatype": ""},
                        {"db": "TIPO_PEDIDO", "prv_value": tp_pedido_, "nxt_value": tp_pedido_, "diagnostic": "", "datatype": ""},
                        {"db": "ASSUNTO", "prv_value": assunto_, "nxt_value": assunto_, "diagnostic": "", "datatype": ""},
                        {"db": "DESCRICAO", "prv_value": descricao_, "nxt_value": descricao_, "diagnostic": "", "datatype": ""},
                                //{"db":"DT_FECHO","prv_value":"","nxt_value":"","diagnostic":"","datatype":"datetime"},
                                //{"db":"JUSTIF_PRIO_ATRIB","prv_value":"","nxt_value":"","diagnostic":"","datatype":""}
                    ])
                };
                //console.log(data);

                //INSERT "E-TICKET" and "FILE(S) ATTACHEMENT(S) IF ANY"
                $.ajax({
                    type: "POST",
                    url: pn + '/data-source/quad_controller.php',
                    data: data,
                    contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                    cache: false,
                    async: true,
                    beforeSend: function () {
                    },
                    success: function (data) {
                        //console.log('E-TICKET inserted...');
                        var dados = JSON.parse(data).data[0];
                        //console.log(dados["ID_ETICKET"]);

                        //Detect and SAVE files if applicable
                        saveFiles(dados["ID_ETICKET"]);

                        $('#refresh_WEB_ETICKETS').trigger('click');
                        $('#newEticket').hide("slow").html('');

                    }
                });
            }

            //Compile NEW E-Ticket INTERACTION data and save it to DB
            function newTicketInteraction(masterRecord) {

                //Insert send script here
                var utilizador = "<?php echo @$_SESSION['utilizador']; ?>", now_ = hoje("seconds"),
                        to_ = JSON.stringify($('#to').val()), cc_ = '',
                        prioridade_pedida_ = $('#fc0').val(),
                        descricao_ = $('#eTicket-compose-form div.note-editable').html();

                if ($('#cc').val()) {
                    cc_ = JSON.stringify($('#cc').val());
                }

                //***** ?????? ******//
                if (tipo === 'S') {
                    prioridade_ = prioridade_pedida_;
                }

                //E-TICKET data to pass to INSERT on quad_controller.php
                var data = {
                    "table": "WEB_ETICKET_INTERACTIONS",
                    "dbAlias": "A1",
                    "pk": {
                        "ID_INTERACTION": {"type": "number"}
                    },
                    "workflow": false,
                    "operation": "INSERT",
                    "operacao": "INSERT",
                    "columnsArray": JSON.stringify([
                        {"db": "ID_INTERACTION", "prv_value": "", "nxt_value": "", "diagnostic": "", "datatype": "sequence"},
                        {"db": "ID_TICKET", "prv_value": masterRecord['ID_ETICKET'], "nxt_value": masterRecord['ID_ETICKET'], "diagnostic": "", "datatype": ""},
                        {"db": "FROM_", "prv_value": utilizador, "nxt_value": utilizador, "diagnostic": "", "datatype": ""},
                        {"db": "TO_", "prv_value": to_, "nxt_value": to_, "diagnostic": "", "datatype": ""},
                        {"db": "CC", "prv_value": cc_, "nxt_value": cc_, "diagnostic": "", "datatype": ""},
                        {"db": "MSG", "prv_value": descricao_, "nxt_value": descricao_, "diagnostic": "", "datatype": ""}
                    ])
                };
                //console.log(data);

                //INSERT "E-TICKET" and "FILE(S) ATTACHEMENT(S) IF ANY"
                $.ajax({
                    type: "POST",
                    url: pn + '/data-source/quad_controller.php',
                    data: data,
                    contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                    cache: false,
                    async: true,
                    beforeSend: function () {
                    },
                    success: function (data) {
                        console.log('E-TICKET INTERACTION inserted...');
                        var dados = JSON.parse(data).data[0];
                        console.log(dados["ID_INTERACTION"]);

                        //Detect and SAVE files if applicable
                        saveFiles(dados["ID_ETICKET"], dados["ID_INTERACTION"]);

                        $('#refresh_WEB_ETICKETS').trigger('click');
                        $('#newEticket').hide("slow").html('');
                    }
                });
            }
        }

        var reply = function () {
            var utilizador = "<?php echo @$_SESSION['utilizador']; ?>", now_ = '';
            //CUSTOMIZE REPLY MODE
            var masterRecord = {};
            
            masterRecord = WEB_ETICKETS.tbl.row('.selected').data();

            if (masterRecord) {
                $('#newEticket > div:nth-child(1) > div.col.col-xs-8 > h2.email-open-header:first-child').html('').html("<?php echo $ui_reply_eticket_title; ?>");
                console.log(masterRecord);
                /* ON REPLY ...*/

                //1. TO keeps value of FROM_
                var s2 = $("#to").select2(), vals = '';
                if (masterRecord['FROM_'] === utilizador) { //Reply of "my own" E-Ticket
                    try {
                        vals = JSON.parse(masterRecord['TO_']);
                    } catch (e) {
                        vals = new Array(masterRecord['TO_']);
                    }
                } else { //Reply to "other" than "me"
                    try {
                        vals = JSON.parse(masterRecord['FROM_']);
                    } catch (e) {
                        vals = new Array(masterRecord['FROM_']);
                    }
                }

                vals.forEach(function (e) {
                    if (!s2.find('option:contains(' + e + ')').length) {
                        s2.append($('<option>').text(e));
                    }
                });
                s2.val(vals).trigger("change");

                //CC 
                if (masterRecord['CC']) {
                    //Open CC line
                    $('#carbonCopy').trigger('click');
                    var s2 = $("#cc").select2(), vals = '';
                    try {
                        vals = JSON.parse(masterRecord['CC']);
                    } catch (e) {
                        vals = new Array(masterRecord['CC']);
                    }
                    vals.forEach(function (e) {
                        if (!s2.find('option:contains(' + e + ')').length) {
                            s2.append($('<option>').text(e));
                        }
                    });
                    s2.val(vals).trigger("change");
                }


                //2. SUBJECT 
                $('#subject').val(masterRecord['ASSUNTO']);

                //3. E-TICKET LISTS
                if (masterRecord['PRIO_ATRIB']) {
                    $('#fc0').val(masterRecord['PRIO_ATRIB']);
                } else {
                    $('#fc0').val(masterRecord['PRIO_SOLICITADA']);
                }

                //4. PRIORITY
                if (masterRecord['PRIO_ATRIB']) {
                    $('#fc0').val(masterRecord['PRIO_ATRIB']);
                } else {
                    $('#fc0').val(masterRecord['PRIO_SOLICITADA']);
                }
                //5. CATEGORY
                $('#fc1').val(masterRecord['CATEGORIA']);

                //6. TYPE
                $('#fc2').val(masterRecord['TIPO_PEDIDO']);

                //6. PROCESS
                $('#fc3').val(masterRecord['PROCESSO']);

                //Custom OPERATIONS depending on TIPO.
                // Ex: Only "Suporte" can change PRIORITY
                // + Username 
                // + TIPO ['': common user; 'H': Helpdesk (ex: Gestor); 'S': Suporte (ex: WIPS)] 
                // + Now: current week day + current date + current HH24:MI:SS
                console.log(utilizador + ' ' + tipo_user + ' ' + now_); //admin S
                if (tipo_user === 'S') { //Só o [S]uporte pode ALTERAR  PRIORIDADE
                    $('#fc0').attr('disabled', false);
                    $('#fc0').trigger("chosen:updated");
                } else {
                    $('#fc0').attr('disabled', 'disabled');
                    $('#fc0').trigger("chosen:updated");
                }
                $('#fc1').attr('disabled', 'disabled');
                $('#fc1').trigger("chosen:updated");
                $('#fc2').attr('disabled', 'disabled');
                $('#fc2').trigger("chosen:updated");
                $('#fc3').attr('disabled', 'disabled');
                $('#fc3').trigger("chosen:updated");

            } else { //NEW E-TICKET
                null;
            }
        };

        $(document).ready(function () {
            pagefunction();
            //CALLED as REPLY?
            setTimeout(function () {
                reply();
            }, 400);
        });

</script>
