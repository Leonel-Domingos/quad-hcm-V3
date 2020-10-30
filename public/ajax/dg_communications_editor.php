<?php
    require_once '../init.php';
?>
<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-end">
                <div class="panel-toolbar pr-3 align-self-end tabs__">
                    <ul id="demo_panel-tabs" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#Tab1" role="tab" aria-selected="true"><?php echo $ui_news; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab2" role="tab" aria-selected="true"><?php echo $ui_comunications; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab3" role="tab" aria-selected="true"><?php echo $ui_faqs; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab4" role="tab" aria-selected="true"><?php echo $ui_legislation_taxation; ?></a>
                        </li>
                    </ul>
                </div>
            </div>   
            
            <div class="panel-container show">
                <div class="panel-content">
                    
                    <div class="tab-content">

                        <div class="tab-pane fade active show" id="Tab1" role="tabpanel">
                            <a id="WEB_ADM_NOTICIAS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="WEB_ADM_NOTICIAS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                        </div>

                        <div class="tab-pane fade" id="Tab2" role="tabpanel">
                            <div class="alert alert-danger" role="alert">
                                <strong><b>TODO</b></strong> 
                                <ul>
                                    <li>Falta criar a vista de suporte!</li>
                                </ul>
                            </div>                            
                            <a id="WEB_ADM_COMUNICACOES_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="WEB_ADM_COMUNICACOES" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                        </div>
                        
                        <div class="tab-pane fade" id="Tab3" role="tabpanel">
                            <a id="WEB_ADM_FAQS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="WEB_ADM_FAQS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                        </div>
                        
                        <div class="tab-pane fade" id="Tab4" role="tabpanel">
                            <a id="WEB_ADM_LEG_FISC_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                            <table id="WEB_ADM_LEG_FISC" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                        </div>
                    </div>                    
                </div>                    

            </div> 
        </div>
    </div>
</div>

<script>
    pageSetUp();

    $(document).ready(function () {

        //Notícias
        var optionsWEB_ADM_NOTICIAS = {
            "tableId": 'WEB_ADM_NOTICIAS',
            "table": "WEB_ADM_NOTICIAS",        
            "pk": {
                "primary": {
                    "ID": {"type": "number"}
                }
            },
            "initialWhereClause": "",
            "order_by": "ESTADO, ID DESC", 
            "scrollY": "468", 
            "recordBundle": 13,
            "pageLenght": 13,  
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
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables 
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'ID',
                    "name": 'ID',
                    "datatype": 'sequence',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": true,
                    "className": "visibleColumn"
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_title, 'UTF-8'); ?>", //Datatables 
                    "label": "<?php echo $ui_title; ?>", //Editor
                    "data": 'TITULO',
                    "name": 'TITULO',
                    "className": "visibleColumn"
                }, {
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_date; ?>", //Editor
                    "data": 'DATA',
                    "name": 'DATA',
                    "def": hoje(),
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker"
                    }   
                }, {
                    "responsivePriority": 6,                    
                    "title": "<?php echo mb_strtoupper($ui_active, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_active; ?>", //Editor
                    "data": 'ESTADO',
                    "name": 'ESTADO',
                    "type": "select",
                    "def": "A",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'WEB_ADM_ESTADO',
                        "class": "form-control"
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
                    },
                    render: $.fn.dataTable.render.text() //SECURITY :: https://datatables.net/manual/security     
                }, {
                    "responsivePriority": 5,
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
                        return WEB_ADM_NOTICIAS.getFileIcon(row['BD_MIME'], JSON.stringify(row));
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
                        //debugger;
                        return WEB_ADM_NOTICIAS.crudButtons(true, true, true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "TITULO": {
                        required: true,
                        maxlength: 200
                    },
                    "DATA": {
                        required: true,
                        dateISO: true
                    },
                    "ESTADO": {
                        required: true
                    },
                    "DESCRICAO": {
                        required: true                        
                    }
                }
            },
        };
        WEB_ADM_NOTICIAS = new QuadTable();
        WEB_ADM_NOTICIAS.initTable($.extend({}, datatable_instance_defaults, optionsWEB_ADM_NOTICIAS));        
        //END Notícias
//        $(document).on('WEB_ADM_NOTICIASAttachEvt', function (e) {
//            debugger;
//            $('#DTE_Field_ESTADO').attr("multiple", true);
//            $('#DTE_Field_ESTADO').trigger("chosen:updated");
//        });
        
        //Comunicações
        var optionsWEB_ADM_COMUNICACOES = {
            "tableId": 'WEB_ADM_COMUNICACOES',
            "table": "WEB_ADM_COMUNICACOES",        
            "pk": {
                "primary": {
                    "ID": {"type": "number"}
                }
            },
            fixedColumns:   {
                heightMatch: 'auto' //https://datatables.net/extensions/fixedcolumns/examples/initialisation/css_size.html
            },
            "initialWhereClause": "",
            "order_by": "ESTADO, ID DESC", 
            "scrollY": "468", 
            "recordBundle": 13,
            "pageLenght": 13,  
            "inRowDoc": {
                "saveAsBlob": false, //BLOB
                "blobField": 'BD_DOC', //DB COLUMN BLOB                    
                "pathField": 'LINK_DOC', //PATH ON FILESYSTEM
                "fileNameField": 'LINK_DOC', //FILENAME ON FILESYSTEM
                "extField": 'BD_MIME', //MIME
                "savePath": 'docs/communication' //FILE
            },
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
                    "data": 'ID',
                    "name": 'ID',
                    "datatype": 'sequence',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": true,
                    "className": "visibleColumn"
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_title, 'UTF-8'); ?>", //Datatables 
                    "label": "<?php echo $ui_title; ?>", //Editor
                    "data": 'TITULO',
                    "name": 'TITULO',
                    "className": "visibleColumn"
                }, {
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_date; ?>", //Editor
                    "data": 'DATA',
                    "name": 'DATA',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker"
                    }
                }, {
                    "responsivePriority": 6,                    
                    "title": "<?php echo mb_strtoupper($ui_active, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_active; ?>", //Editor
                    "data": 'ESTADO',
                    "name": 'ESTADO',
                    "type": "select",
                    "def": "A",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'WEB_ADM_ESTADO',
                        "class": "form-control"
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
                    },
                    render: $.fn.dataTable.render.text() //SECURITY :: https://datatables.net/manual/security
                }, {
                    "responsivePriority": 5,
                    "title": "<?php echo mb_strtoupper($ui_document_short, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_document_short; ?>", //Editor
                    "data": 'LINK_DOC',
                    "name": 'LINK_DOC',
                    "className": "visibleColumn",
                    "type": "hidden",
                    "attr": {
                        "name": 'LINK_DOC'
                    },
                    "render": function (val, type, row) {                          
                            return WEB_ADM_COMUNICACOES.getFileIcon(row['BD_MIME'], JSON.stringify(row));
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
                        return WEB_ADM_COMUNICACOES.crudButtons(true, true, true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "TITULO": {
                        required: true,
                        maxlength: 200
                    },
                    "DATA": {
                        required: true,
                        dateISO: true
                    },
                    "NOTIFICAR": {
                        required: true
                    },
                    "ESTADO": {
                        required: true
                    },
                    "DESCRICAO": {
                        required: true                        
                    }
                }
            },
        };
        WEB_ADM_COMUNICACOES = new QuadTable();
        WEB_ADM_COMUNICACOES.initTable($.extend({}, datatable_instance_defaults, optionsWEB_ADM_COMUNICACOES));        
        //END Comunicações

        //FAQS
        var optionsWEB_ADM_FAQS = {
            "tableId": 'WEB_ADM_FAQS',
            "table": "WEB_ADM_FAQS",        
            "pk": {
                "primary": {
                    "ID": {"type": "number"}
                }
            },
            "initialWhereClause": "",
            "order_by": "ESTADO, ID DESC", 
            "scrollY": "468", 
            "recordBundle": 13,
            "pageLenght": 13,  
            "inRowDoc": {
                "saveAsBlob": false, //BLOB
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
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables 
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'ID',
                    "name": 'ID',
                    "datatype": 'sequence',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": true,
                    "className": "visibleColumn"
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_question, 'UTF-8'); ?>", //Datatables 
                    "label": "<?php echo $ui_question; ?>", //Editor
                    "data": 'PERGUNTA',
                    "name": 'PERGUNTA',
                    "className": "visibleColumn"
                }, {
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_date; ?>", //Editor
                    "data": 'DATA',
                    "name": 'DATA',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker"
                    }  
                }, {
                    "responsivePriority": 6,                    
                    "title": "<?php echo mb_strtoupper($ui_active, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_active; ?>", //Editor
                    "data": 'ESTADO',
                    "name": 'ESTADO',
                    "type": "select",
                    "def": "A",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'WEB_ADM_ESTADO',
                        "class": "form-control"
                    } 
                }, {
                   "title": "<?php echo mb_strtoupper($ui_answer, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_answer; ?>", //Editor
                    "data": 'RESPOSTA',
                    "name": 'RESPOSTA',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "name": 'DESCRICAO',
                        "style": "max-width: 335px",
                    },
                    render: $.fn.dataTable.render.text() //SECURITY :: https://datatables.net/manual/security
                }, {
                    "responsivePriority": 5,
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
                        return WEB_ADM_FAQS.getFileIcon(row['BD_MIME'], JSON.stringify(row));
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
                        //debugger;
                        return WEB_ADM_FAQS.crudButtons(true, true, true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "PERGUNTA": {
                        required: true,
                        maxlength: 4000
                    },
                    "DATA": {
                        required: true,
                        dateISO: true
                    },
                    "ESTADO": {
                        required: true
                    },
                    "RESPOSTA": {
                        required: true,
                        maxlength: 4000                    
                    }
                }
            },
        };
        WEB_ADM_FAQS = new QuadTable();
        WEB_ADM_FAQS.initTable($.extend({}, datatable_instance_defaults, optionsWEB_ADM_FAQS));        
        //END FAQS
        
        //Legislaçáo & Fiscalidade
        var optionsWEB_ADM_LEG_FISC = {
            "tableId": 'WEB_ADM_LEG_FISC',
            "table": "WEB_ADM_LEG_FISC",        
            "pk": {
                "primary": {
                    "ID": {"type": "number"}
                }
            },
            "initialWhereClause": "",
            "order_by": "ESTADO, ID DESC", 
            "scrollY": "468", 
            "recordBundle": 13,
            "pageLenght": 13,  
            "inRowDoc": {
                "saveAsBlob": false, //BLOB
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
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables 
                    "label": "<?php echo $ui_code; ?>", //Editor
                    "data": 'ID',
                    "name": 'ID',
                    "datatype": 'sequence',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": true,
                    "className": "visibleColumn"
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_title, 'UTF-8'); ?>", //Datatables 
                    "label": "<?php echo $ui_title; ?>", //Editor
                    "data": 'TITULO',
                    "name": 'TITULO',
                    "className": "visibleColumn"
                }, {
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_date; ?>", //Editor
                    "data": 'DATA',
                    "name": 'DATA',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "class": "datepicker"
                    }                
                }, {
                    "responsivePriority": 6,                    
                    "title": "<?php echo mb_strtoupper($ui_active, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_active; ?>", //Editor
                    "data": 'ESTADO',
                    "name": 'ESTADO',
                    "type": "select",
                    "def": "A",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'WEB_ADM_ESTADO',
                        "class": "form-control"
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
                    },
                    render: $.fn.dataTable.render.text() //SECURITY :: https://datatables.net/manual/security
                }, {
                    "responsivePriority": 5,
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
                        return WEB_ADM_LEG_FISC.getFileIcon(row['BD_MIME'], JSON.stringify(row));
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
                        //debugger;
                        return WEB_ADM_LEG_FISC.crudButtons(true, true, true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "TITULO": {
                        required: true,
                        maxlength: 200
                    },
                    "DATA": {
                        required: true,
                        dateISO: true
                    },
                    "ESTADO": {
                        required: true
                    },
                    "DESCRICAO": {
                        required: true                        
                    }
                }
            },
        };
        WEB_ADM_LEG_FISC = new QuadTable();
        WEB_ADM_LEG_FISC.initTable($.extend({}, datatable_instance_defaults, optionsWEB_ADM_LEG_FISC));        
        //END Legislaçáo & Fiscalidade        
    });
</script>
