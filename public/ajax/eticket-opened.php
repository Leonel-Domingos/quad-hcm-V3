<?php     
    require_once '../init.php';
?>

<div class="eticketTemplate hide">
    <h2 class="email-open-header"></h2>
    <div class="inbox-info-bar">      
        <div class="row">
            <div class="col-sm-9 distribuition">
                <div><?php echo $ui_eticket_from.': '; ?><span class="from"></span> <span class="ref_date"></span></div>
                <div><?php echo $ui_eticket_to.': '; ?> <span class="to"></span></div>
                <div class="last"><?php echo $ui_eticket_cc.': '; ?> <span class="cc"></span></div>
            </div>
            <div class="col-sm-3 text-right">
                <div class="btn-group text-left">
                    <button class="btn btn-primary btn-sm replythis waves-effect waves-themed hide">
                        <i class="fa fa-reply"></i><?php echo $ui_reply; ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="eticket-body"></div>
    <div class="inbox-download mt-0 hide">
        <span class="attachement-resume"></span><a id ="downloadAll" href="javascript:void(0);"> <?php echo ' — '.$ui_download_all; ?> </a>
        <ul class="inbox-download-list"></ul>
    </div>    
</div>

<div class="etc"></div>

<script type="text/javascript">
        pageSetUp();
        var pagefunction = function() {
            //RESETs
            $(document).off("click",".replythis");
            $(document).off("click","a.docsViewer.attach");
            $(document).off("click","#downloadAll");     
            
            var masterRecord = WEB_ETICKETS.tbl.row('.selected').data(),
                eticket_template = $(".eticketTemplate").clone().html();
        
            //Remove "E-TICKET" template after CLONE IT
            $(".eticketTemplate").remove();

            $(".table-wrap-quad [rel=tooltip]").tooltip();
            
            //EVENTS
            if (1 === 1) {
                //"REPLY" to E-Ticket
                $(document).on("click",".replythis", function () {                
                    $('#eticketContent').addClass('email-reply-text').show("slow");
                    loadURL("ajax/eticket-compose.php", $('#newEticket')); //$('#inbox-content > .table-wrap'));
                    $('#newEticket').show("slow");
                    $(this).hide("fast");
                });

                //Download file(s)...
                $(document).on("click","a.docsViewer.attach", function(e) {
                    e.preventDefault();
                    e.stopImmediatePropagation();

                    $.post(
                        "data-source/" + quadConfig.download_file_controller,
                        {
                            tab: $(this).data("table"),
                            id:  $(this).data("reference"),
                            ref: '{"ID_DOC":{"type":"number"}}'
                        },
                        function(url) {
                            var link = document.createElement("a");
                            document.body.appendChild(link);
                            if (url.blob) {
                                var dados = base64ToArrayBuffer(url["blob"]);
                                var blob = new Blob([dados], { type: "application/pdf" });
                                var downloadBlob = URL.createObjectURL(blob);
                                link.download = url["filename"];
                                link.href = downloadBlob;
                                link.click();
                            } else {
                                var path = location.origin + window.location.pathname.replace("home.php", "") + url;
                                var arr = url.split("/");
                                link.download = url;
                                link.href = path;
                                link.click();
                            }
                            link.remove();
                        }
                    );
                });            
                $(document).on("click","#downloadAll", function(e) {
                    var docs = $('.inbox-download a.docsViewer.attach');
                    alert('Still to do... > ' + docs.length);
                });
            }
            
            //GENERIC "Show E-Ticket"
            function show_Eticket (tipo, record_data) {
                var from_ = record_data['FROM_'], to_ = record_data['TO_'], cc_ = record_data['CC'],
                    dt_ref;
            
                //Clone E-TICKET Template
                $('.etc').append(eticket_template);
                //Reference Date
                function data_referencia (data_ref) {
                    var dia = '', dia_semana = '';
                    if (data_ref) {
                        dia = new Date(data_ref).getDay();
                        if (dia == 1) {
                            dia_semana = "<?php echo $ui_cal_monday; ?>";
                        } else if (dia == 2) {
                            dia_semana = "<?php echo $ui_cal_tuesday; ?>";
                        } else if (dia == 3) {
                            dia_semana = "<?php echo $ui_cal_wednesday; ?>";
                        } else if (dia == 4) {
                            dia_semana = "<?php echo $ui_cal_thursday; ?>";
                        } else if (dia == 5) {
                            dia_semana = "<?php echo $ui_cal_friday; ?>";
                        } else if (dia == 6) {
                            dia_semana = "<?php echo $ui_cal_saturday; ?>";
                        } else if (dia == 0) {
                            dia_semana = "<?php echo $ui_cal_sunday; ?>";
                        }
                        dia = dia_semana + ' ' + data_ref;
                    } else {
                        dia = data_ref;
                    }
                    return dia;
                }
                
                //1. Subject
                if (tipo === 'M') { //Master Record === Original E-Ticket
                    $('.email-open-header:last').prepend(record_data['ASSUNTO'] + '<span class="label txt-color-white">original</span>');
                } else {
                    $('.email-open-header:last').prepend(record_data['ASSUNTO']);
                }
                    
                //2. Distribuition List
                if (from_) {
                    $('.from:last').html(from_);
                    if (tipo === 'M') { //Master Record === Original E-Ticket
                        $('.ref_date:last').html( '<i class="far fa-alarm-plus"></i>&nbsp;&nbsp;' + data_referencia( record_data['DT_ABERTURA'] ) );
                    } else {
                        $('.ref_date:last').html( '<i class="far fa-alarm-plus"></i>&nbsp;&nbsp;' + data_referencia( record_data['DT_INSERTED'] ) );
                    }
                }
                
                if (to_) {
                    $('.to:last').html(JSON.parse(to_).join('; '));
                }
                
                if (cc_) {
                    $('.cc:last').html(JSON.parse(cc_).join('; '));
                }
                
                //4. Body
                var msg_ ;
                if (tipo === 'M') {
                    msg_ = record_data['DESCRICAO'];
                } else {
                    msg_ = record_data['MSG'];
                } 
                
                //Write down "E-TICKET" content (except attachements)
                $('.eticket-body:last').append( $.parseHTML( msg_ ) );
                
                return;
            }
            
            //GENERIC "Show E-Ticket Attachements"
            function getETicket_Attachments(eticket_id, eticket_interaction) {
            
                //RETURNS HTML TO FILE ATTACHMENT DOWNLOAD
                function showFileAttachement (fileDetails) {
                    var file_extension = '', linhas = '', file_size = '';
                    if (fileDetails.length) {
                        for (i=0; i < fileDetails.length; i++) {

                            //File extension ICON                        
                            if (fileDetails[i]['BD_MIME']) {                            
                                switch (fileDetails[i]['BD_MIME'].toLowerCase()) {
                                    case "doc":
                                    case "docx":
                                        file_extension = "word";
                                        break;
                                    case "pdf":
                                        file_extension = "pdf";
                                        break;
                                    case "xls":
                                    case "xlsx":
                                        file_extension = "excel";
                                        break;
                                    case "csv":
                                        file_extension = "csv";
                                        break;
                                    case "gif":
                                    case "jpg":
                                    case "jpeg":
                                    case "png":
                                        file_extension = "image";
                                        break;
                                    case "zip":
                                    case "rar":
                                        file_extension = "archive";
                                        break;
                                    default:
                                        file_extension = "alt";
                                        break;
                                }
                                file_size = formatBytes(fileDetails[i]['OCTET_LENGTH(BD_DOC)'],0);
                            }
                            file_extension = '<i style="" class="far fa-file-' +  file_extension + ' fa-2x"></i>'; //font-size: 50px;color: #3b9ff3;
                            linhas += '<li>'+
                                        '   <div class="well well-sm">'+ //background-color: #f3fff0 || #ecf3f896 || #ecf3f8;border-radius: 10px;
                                        '       <a class="docsViewer attach" href="javascript:void(0);" data-table="WEB_ETICKET_DOCS" data-reference="' + fileDetails[i]['ID_DOC']+ '">' +
                                        '           <span title="' + fileDetails[i]['LINK_DOC'] + '">' + file_extension + '</span>' + '</a>' +
                                        '       <div style="float:left;display: inline-flex;">'+
                                        '           <span class="fileName">' + fileDetails[i]['LINK_DOC']+ '</span> ' +
                                        '           <span class="fileSize"> - ' + file_size + '</span>' +
                                        '           <br> '+
                                        '       </div>'
                                        '   </div>'+
                                        '</li>';
                                
                            file_extension = '';
                        }
                        return linhas;   
                    }
                    return;
                }
                var where_ = '';
                if (!eticket_interaction) { //ORIGINAL E-Ticket attachements
                    
                    if (eticket_id) {
                        where_ = " ID_ETICKET = '" + eticket_id + "'";
                        if (eticket_interaction) {
                            where_ += " AND ID_INTERACTION = '" + eticket_interaction + "'";
                        }
                    }
                    
                    //E-TICKET data to pass to SELECT DOC's on quad_controller.php
                    var data = {
                        "pk": {
                            "ID_DOC": {"type": "number"}
                        },
                        "workflow": false,
                        "operation": "SELECT",
                        "operacao": "SELECT",
                        "columnsArray": JSON.stringify([
                            {"db":"ID_DOC","prv_value":"","nxt_value":"","diagnostic":"","datatype":"sequence"},
                            {"db":"ID_ETICKET","prv_value":"","nxt_value":"","diagnostic":"","datatype":""},
                            {"db":"ID_INTERACTION","prv_value":"","nxt_value":"","diagnostic":"","datatype":""},
//                            {"db":"BD_DOC","prv_value":"","nxt_value":"","diagnostic":"","datatype":""},
                            {"db":"BD_MIME","prv_value":"","nxt_value":"A","diagnostic":"","datatype":""},
                            {"db":"LINK_DOC","prv_value":"","nxt_value":"A","diagnostic":"","datatype":""},
                            {"db":"OCTET_LENGTH(BD_DOC)","prv_value":"","nxt_value":"","diagnostic":"","datatype":""}
                        ]),
                        "table": "WEB_ETICKET_DOCS",
                        "dbWhere": where_
                    }; 
                    
                    //SELECT "E-TICKET" files
                    $.ajax({
                        type: "POST",
                        url: pn + 'data-source/quad_controller.php',
                        data: data,
                        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                        cache: false,
                        async: true,
                        beforeSend: function() {
                        },
                        success: function(data) {
                            var dados = JSON.parse(data).data,
                                anexo_linha = showFileAttachement(dados),
                                attach_resume = "<?php echo $ui_attachement_counter; ?>";
                            //Write File attachements RESUME
                            var file_counter = dados.length;
                            if (file_counter > 0) {
                                //Inibir o "Download All" se houver só um anexo
                                if (file_counter === 1) {
                                    $('#downloadAll:last').addClass('hide');
                                }
                                
                                $('.inbox-download:last').removeClass('hide');
                                //TODO :: ITERATION
                                attach_resume = attach_resume.replace('{0}', file_counter);                 
                                $('span.attachement-resume:last').html(attach_resume);

                                //Create attachements LINKS
                                $('div.inbox-download:last > ul.inbox-download-list').html( anexo_linha );
                            } 
                            
                            
                        }
                    });
                    
                } else { //Interaction E-Ticket attachements
                    null;
                }
                return;
            }
            
            //Get ORIGINAL E-Ticket DATA
            function getOriginalETicket (tipo, record_data) {
                //TIPO: [M]aster Record, [I]nteraction
                show_Eticket (tipo, record_data);
                getETicket_Attachments(record_data['ID_ETICKET']);
                return;
            }

            //Get E-Ticket INTERACTIONS
            function getETicket_Interactions(eticket_id) {
                //WEB_ETICKET_INTERACTIONS data to pass to SELECT DOC's on quad_controller.php
                var data = {
                    "pk": {
                        "ID_DOC": {"type": "number"}
                    },
                    "workflow": false,
                    "operation": "SELECT",
                    "operacao": "SELECT",
                    "columnsArray": JSON.stringify([
                        {"db":"ID_TICKET","prv_value":"","nxt_value":"","diagnostic":"","datatype":""},
                        {"db":"ID_INTERACTION","prv_value":"","nxt_value":"","diagnostic":"","datatype":""},
                        {"db":"ASSUNTO","prv_value":"","nxt_value":"","diagnostic":"","datatype":""},
                        {"db":"FROM_","prv_value":"","nxt_value":"","diagnostic":"","datatype":""},
                        {"db":"TO_","prv_value":"","nxt_value":"","diagnostic":"","datatype":""},
                        {"db":"CC","prv_value":"","nxt_value":"","diagnostic":"","datatype":""},
                        {"db":"MSG","prv_value":"","nxt_value":"","diagnostic":"","datatype":""},
                        {"db":"MSG","prv_value":"","nxt_value":"","diagnostic":"","datatype":""},
                        {"db":"INSERTED_BY","prv_value":"","nxt_value":"","diagnostic":"","datatype":""},
                        {"db":"DT_INSERTED","prv_value":"","nxt_value":"","diagnostic":"","datatype":"datetime"}                        
                    ]),
                    "table": "WEB_ETICKET_INTERACTIONS",
                    "dbWhere": " ID_TICKET = '" + eticket_id + "'",
                    "order_by": "DT_INSERTED ASC"
                }; 

                //SELECT "E-TICKET" files
                $.ajax({
                    type: "POST",
                    url: pn + 'data-source/quad_controller.php',
                    data: data,
                    contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                    cache: false,
                    async: true,
                    beforeSend: function() {
                    },
                    success: function(data) {
                        var dados = JSON.parse(data).data,
                            nr_interactions = dados.length;

                        //Write E-TICKET Interactions (from recent to oldest)
                        if (nr_interactions > 0) {
                            //console.log('INTERACTIONS', eticket_id, dados);
                            for (let i=0; i<dados.length; i++) {
                                show_Eticket ('I', dados[i]);
                                getETicket_Attachments(dados[i]['ID_ETICKET'], dados[i]['ID_INTERACTION']);
                            }
                        }
                        // SHOW "ORIGINAL" E-Ticket LAST
                        getOriginalETicket('M', masterRecord); //[M]aster Record, [I]nteraction
                        //SHOW REPLY BUTTON on "LAST E-Ticket"
                        $( $('.etc button.replythis')[0] ).removeClass('hide');                        
                    }
                });
                return;
            }

            //Cycle LOGIC CONTROL
            if (masterRecord) {
                //1. Clear PREVIOUS content
                $('.etc').empty();
                //2. SHOW "E-Ticket Interactions" from RECENT to OLDEST
                getETicket_Interactions(masterRecord['ID_ETICKET']);
                //debugger;
                //3. SHOW "ORIGINAL" E-Ticket LAST
                //getOriginalETicket('M', masterRecord); //[M]aster Record, [I]nteraction
            }
        }
        
        $(document).ready(function () {
            pagefunction();    
        });        
</script>
