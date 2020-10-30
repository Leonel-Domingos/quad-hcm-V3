<?php
    require_once '../init.php';
?>
<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            
            <div class="panel-hdr">
                <span class="widget-icon"> <i class="fas fa-user-edit"></i></span>&nbsp;
                <h2><?php echo $ui_cadastre; ?></h2>
            </div>

            <div class="panel-container show">
                <!-- TOP INSTANCE -->
                <div class="panel-content">
                    <a id="DG_HDR_EMISSOES_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                    <table id="DG_HDR_EMISSOES" class="table table-bordered table-hover table-striped w-100"></table>
                </div>
                <!-- END INSTANCE -->

                <!-- TABS MENUS -->
                <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-end">
                    <div class="panel-toolbar pr-3 align-self-end">
                        <ul id="main-tabs" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#Tab1" role="tab" aria-selected="true"><?php echo $ui_outputs; ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#Tab2" role="tab" aria-selected="true"><?php echo $ui_month; ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#Tab3" role="tab" aria-selected="true"><?php echo $ui_year; ?></a>
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
                                Tab #1
                            </div>

                            <div class="tab-pane fade" id="Tab2" role="tabpanel">
                                Tab #2
                                <div class="panel-tag">
                                        To remove Sub-Tab borders, please remove custom class <code>.boxSubTab.</code><br>Also remove this div <code>.panel-tag</code>.
                                </div>

                                <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-start">
                                    <div class="panel-toolbar pr-3 align-self-end">
                                        <ul id="sub_tabs" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="#Tab21" role="tab" aria-selected="true"><?php echo $ui_year; ?></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#Tab22" role="tab" aria-selected="true"><?php echo $ui_month; ?></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="panel-container show boxSubTab">
                                    <div class="panel-content">
                                        <div class="tab-content">
                                            <div class="tab-pane fade active show" id="Tab21" role="tabpanel">
                                                Tab #2.1
                                            </div>
                                            <div class="tab-pane fade" id="Tab22" role="tabpanel">
                                                Tab #2.2
                                            </div>                                        
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane fade" id="Tab3" role="tabpanel">
                                Tab #3
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
    $(document).ready(function () {
        var perfil_ = "<?php echo @$_SESSION['perfil'];?>";
        var rhid_ = "<?php echo @$_SESSION['rhid'];?>";

        //Outputs
        var optionsDG_HDR_EMISSOES = {
            "tableId": "DG_HDR_EMISSOES",
            "table": "DG_HDR_EMISSOES",
            //"selectRecordMsg": "<?php echo $ui_please_select_record . $ui_retroactive_payment; ?>",
            "pk": {
                "primary": {
                    "CD_OUTPUT": {"type": "varchar"},
                    "CD_HEO": {"type": "varchar"}
                }
            },
            inRowDoc: {
                saveAsBlob: true,
                fileNameField: 'LINK_DOC',
                extField: 'BD_MIME',
                pathField: 'LINK_DOC',
                blobField: 'BD_DOC',
                savePath: 'tmp'
            },      
            "initialWhereClause": "", //SÓ ESTADOS COM FICHAS DE AVALIAÇÃO!!!
            //"detailsObjects": ['RH_DEF_GRELHAS_RETRO','RH_DEF_RUBRICAS_RETRO','RH_DEF_RETRO_COLABS'],
            "order_by": "EMPRESA, ANO DESC, MES DESC, ID_PERIODO DESC, RHID, DT_ADMISSAO ",
            "recordBundle": 13,
            "pageLenght": 13,
            "scrollY": "137",
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
                    "data": 'CD_HEO',
                    "name": 'CD_HEO',
                    "type": "hidden",
                    "visible": false,
                    "className": "",
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_OUTPUT',
                    "name": 'CD_OUTPUT',
                    "type": "hidden",
                    "visible": false,
                    "className": "",
                }, {
                    "responsivePriority": 2,
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_output, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_output; ?>",
                    "data": 'DSP_OUTPUT',
                    "name": 'DSP_OUTPUT',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "OUTUTS",
                        "dependent-level": 1,
                        "data-db-name": "A.CD_OUTPUT",
                        "decodeFromTable": "DG_DEF_OUTPUTS A", //TO CHANGE ON QUAD-HCM
                        "desigColumn": "A.DSP_OUTPUT",
                        "orderBy": "A.CD_OUTPUT",
                        "class": "form-control complexList chosen"
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'EMPRESA',
                    "name": 'EMPRESA',
                    "type": "hidden",
                    "visible": false,
                    "className": "",
                }, {
                    "responsivePriority": 3,
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
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_year, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_year; ?>", //Editor
                    "data": 'ANO',
                    "name": 'ANO',
                    "width": "1%",
                    "className": "right visibleColumn",  
                    "attr": {
                        "style": "width:25%;"
                    } 
                }, {
                    "responsivePriority": 5,
                    "title": "<?php echo mb_strtoupper($ui_month, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_month; ?>", //Editor
                    "data": 'MES',
                    "name": 'MES',
                    "type": "readonly",
                    "width": "1%",
                    "className": "right visibleColumn",  
                    "attr": {
                        "style": "width:25%;"
                    }       
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_PERIODO',
                    "name": 'ID_PERIODO',
                    "type": "hidden",
                    "visible": false,
                    "className": "",
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
                    "type": "hidden",
                    "className": ""
                }, {
                    "responsivePriority": 6,
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
                            "create": " AND A.DT_DEMISSAO IS NULL  ", //On-New-Record
                            "edit": " AND A.DT_DEMISSAO IS NULL  ", //On-Edit-Record
                        },
                    }
                }, {
                    "responsivePriority": 7,
                    "title": "<?php echo mb_strtoupper($ui_reference, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_reference; ?>", //Editor
                    "data": 'REFERENCIA',
                    "name": 'REFERENCIA',
                    "type": "readonly",
                    "className": "visibleColumn"
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
                    "title": "<?php echo mb_strtoupper($ui_document_short, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_document_short; ?>", //Editor
                    "data": 'LINK_DOC',
                    "name": 'LINK_DOC',
                    "className": "visibleColumn",
                    "type": "hidden",
                    "width": "1%",
                    "attr": {
                        "name": 'LINK_DOC'
                    },
                    "render": function (val, type, row) {                          
                        try {
                            if (row['BD_MIME'] !== null) { //FICHEIRO
                                return DG_HDR_EMISSOES.getFileIcon(row['BD_MIME'], JSON.stringify(row));
                            }
                       } catch (e) {
                            return null;
                       }
                    }
                }, {
                    "responsivePriority": 8,
                    "title": "", //Datatables
                    "label": "", //Editor
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
                        return DG_HDR_EMISSOES.crudButtons(true,true,true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DSP_OUTPUT": {
                        required: true
                    },
                    "DEFINITIVO": {
                        required: true,
                    },
                    "DSP_EMPRESA": {
                        required: false
                    },
                    "ANO": {
                        required: false,
                        integer: true,
                        maxlength: 4
                    },
                    "MES": {
                        required: false,
                        integer: true,
                        maxlength: 2
                    },
                    "ID_PERIODO": {
                        required: false,
                        integer: true,
                        maxlength: 10
                    }
                }
            }
        };
        DG_HDR_EMISSOES = new QuadTable();
        DG_HDR_EMISSOES.initTable($.extend({}, datatable_instance_defaults, optionsDG_HDR_EMISSOES));
        //END Outputs
    });
</script>
