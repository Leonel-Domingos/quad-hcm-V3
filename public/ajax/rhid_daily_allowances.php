<?php
    require_once '../init.php';
?>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <span class="widget-icon"> <i class="fal fa-clone"></i></span>&nbsp;
                <h2><?php echo $ui_daily_allowances; ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <a id="RH_ID_AJUDAS_CUSTO_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                    <table id="RH_ID_AJUDAS_CUSTO" class="table table-bordered table-hover table-striped w-100"></table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    pageSetUp();
    var y = "<?php echo @$_SESSION['lang']; ?>", 
        whereClause_ = ' 1 = 1', 
        NR_DECIMALS = 2;

    $(document).ready(function () {

        //DELEGAÇÕES
        var perfil_ = "<?php echo @$_SESSION['perfil'];?>";

        var optionRH_ID_AJUDAS_CUSTO = {
            "tableId": 'RH_ID_AJUDAS_CUSTO',
            "table": "RH_ID_AJUDAS_CUSTO",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "RHID": {"type": "number"},
                    "DT_ADMISSAO": {"type": "date"},
                    "DT_INI": {"type": "date"}                
                }
                            },            
            "crudOnMasterInactive": {
                "condition": "data.ESTADO !== 'A' ",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            }, 
            //"initialWhereClause": whereClause_,
            "order_by": "EMPRESA, DT_INI DESC, RHID ASC",
            "scrollY": "390", 
            "recordBundle": 12,
            "pageLenght": 12, 
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
                    "data": 'EMPRESA',
                    "name": 'EMPRESA',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                        
                }, {
                    "responsivePriority": 2,
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_company, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_company; ?>",
                    "data": 'DESIGEMPRESA',
                    "name": 'DESIGEMPRESA',
                    "className": "visibleColumn",
                    "type": "select",
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
                    "type": "hidden",
                    "className": ""
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
                        },
                    }                           
                }, {
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_departure, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_departure; ?>", //Editor
                    "data": 'DT_INI',
                    "name": 'DT_INI',
                    "datatype": 'datetimeShort',
                    //"def": hoje(), // hoje() OR hoje('minutes') OR "def": hoje('seconds')
                    "className": "visibleColumn",
                    "attr": {
                        "class": "dateTimePickerShort minutes" //(.datepicker OR .dateTimePickerShort OR .dateTimePicker) AND (.minutes OR .seconds for CSS format width)
                    }
                }, {
                    "responsivePriority": 5,
                    "title": "<?php echo mb_strtoupper($ui_arrival, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_arrival; ?>", //Editor
                    "data": 'DT_FIM',
                    "name": 'DT_FIM',
                    "datatype": 'date',
                    "className": "datetimeShort",
                    "attr": {
                        "class": "dateTimePickerShort minutes"
                    }
                }, {
                    "responsivePriority": 6,
                    "title": "<?php echo mb_strtoupper($ui_type, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_type; ?>", //Editor
                    "data": 'TP_AJD_CUSTO',
                    "name": 'TP_AJD_CUSTO',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'RH_ID_AJUDAS_CUSTO.TP_AJD_CUSTO',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['RH_ID_AJUDAS_CUSTO.TP_AJD_CUSTO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }                        

                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_ROTA',
                    "name": 'CD_ROTA',
                    "visible": false,
                    "type": "hidden"
                }, {
                    "responsivePriority": 7,
                    "title": "<?php echo mb_strtoupper($ui_route, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_route; ?>",
                    "data": 'DSP_ROTA',
                    "name": 'DSP_ROTA',
                    "type": "select",
                    "className": "visibleColumn",
                    "complexList": true,
                    "attr": {
                        "dependent-group": "ROTA",
                        "dependent-level": 2,
                        "data-db-name": 'A.CD_ROTA',
                        "otherValues": "A.DISTANCIA_KM",
                        "decodeFromTable": 'DG_DEF_ROTAS A',
                        "class": "form-control complexList chosen",
                        "desigColumn": "A.DSP_ROTA",
                        "whereClause": "",
                        "orderBy": 'A.CD_ROTA',
                        "filter": {
                            "create": " AND A.ACTIVO = 'S' ", //On-New-Record
                            "edit": " AND A.ACTIVO = 'S' ", //On-Edit-Record
                        }
                    }   
                }, {    
                    "responsivePriority": 8,
                    "title": "<?php echo mb_strtoupper($ui_mileage, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_mileage; ?>",
                    "data": 'KMS',
                    "name": 'KMS',
                    "className": "visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 25%;"
                    }                        
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_ENT_INT',
                    "name": 'CD_ENT_INT',                    
                    "type": "hidden", //Editor
                    "visible": false, //DataTables 
                }, {
                    "responsivePriority": 9,
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_internal_entity, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_internal_entity; ?>",
                    "data": "DSP_ENT_INT",
                    "name": "DSP_ENT_INT",
                    "className": "visibleColumn",
                    "type": "select",
                    "attr": {
                        "deferred": true,
                        "dependent-group": "EMPRESA",
                        "dependent-level": 2,
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
                    "responsivePriority": 10,
                    "title": "<?php echo mb_strtoupper($ui_status, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_status; ?>", //Editor
                    "data": 'ESTADO',
                    "name": 'ESTADO',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_ESTADO_REG',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_ESTADO_REG'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    } 
                }, {
                    "title": "<?php echo mb_strtoupper($ui_obs_short, 'UTF-8'); ?>" + '</span>', //Datatables
                    "label": "<?php echo $ui_obs_short; ?>", //Editor
                    "data": 'OBS',
                    "name": 'OBS',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "name": 'OBS',
                        "style": "max-width: 326px",
                    }
                }, {
                    "title": "",
                    "label": "",
                    "data": 'AJD_CST_EMP',
                    "name": 'AJD_CST_EMP',                    
                    "type": "hidden",
                    "visible": false,
                    "className": "visibleColumn"
                }, {
                    "title": "",
                    "label": "",
                    "data": 'PRC_EMP',
                    "name": 'PRC_EMP',                    
                    "type": "hidden",
                    "visible": false,
                    "className": "visibleColumn"
                }, {
                    "title": "<?php echo mb_strtoupper($ui_company_total, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_company_total; ?>", //Editor
                    "data": '',
                    "name": 'TIT_COMPANY',
                    "className": "none",
                    "defaultContent": "", //Must be used on STATIC columns content. On this case classes make there way...
                    "render": function (val, type, row) {
                        if (row['AJD_CST_EMP'] && row['PRC_EMP']) {
                            return row['AJD_CST_EMP'] + ' X ' + row['PRC_EMP'] + ' = ' + round (parseFloat(row['AJD_CST_EMP']) * parseFloat(row['PRC_EMP']), NR_DECIMALS);
                        } else {
                            return null;
                        }
                    } 
                }, {
                    "title": "",
                    "label": "",
                    "data": 'AJD_CST_OFIC',
                    "name": 'AJD_CST_OFIC',                    
                    "type": "hidden",
                    "visible": false,
                    "className": "visibleColumn"
                }, {
                    "title": "",
                    "label": "",
                    "data": 'PRC_OFIC',
                    "name": 'PRC_OFIC',                    
                    "type": "hidden",
                    "visible": false,
                    "className": "visibleColumn"
                }, {
                    "title": "<?php echo mb_strtoupper($ui_public_administration_total, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_public_administration_total; ?>", //Editor
                    "data": '',
                    "name": 'TIT_FP',
                    "className": "none",
                    "defaultContent": "", //Must be used on STATIC columns content. On this case classes make there way...
                    "render": function (val, type, row) {
                        if (row['AJD_CST_EMP'] && row['PRC_EMP']) {
                            return row['AJD_CST_OFIC'] + ' X ' + row['PRC_OFIC'] + ' = ' + round (parseFloat(row['AJD_CST_OFIC']) * parseFloat(row['PRC_OFIC']), NR_DECIMALS);
                        } else {
                            return null;
                        }
                    }                            
                }, {
                    "title": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_meals, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_meals, 'UTF-8'); ?>" + "</span>", //Editor
                    "data": '',
                    "name": 'TIT_MEALS',
                    "className": "none insHide",
                    "defaultContent": "", //Must be used on STATIC columns content. On this case classes make there way...
                    "attr": {
                        "style": "display: none;"
                    }
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_total, 'UTF-8'); ?>" + "</span>",
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_total; ?>" + "</span>",
                    "data": 'NR_REFEICOES',
                    "name": 'NR_REFEICOES',
                    "className": "visibleColumn right insHide",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 20%;"
                    }                   
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_to_discount, 'UTF-8'); ?>" + "</span>",
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_to_discount; ?>" + "</span>",
                    "data": 'NR_REF_ABAT',
                    "name": 'NR_REF_ABAT',
                    "className": "visibleColumn right insHide",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 20%;"
                    }   

                }, {
                    "title": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_integration, 'UTF-8'); ?>" + "</span>", //Datatables :: Original
                    "label": "<span class='quadTitle'>" + "<?php echo mb_strtoupper($ui_integration, 'UTF-8'); ?>" + "</span>", //Editor
                    "data": '',
                    "name": 'TIT_CALC',
                    "className": "none insHide",
                    "defaultContent": "", //Must be used on STATIC columns content. On this case classes make there way...
                    "attr": {
                        "style": "display: none;"
                    }
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_year, 'UTF-8'); ?>" + "</span>",
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_year; ?>" + "</span>",
                    "data": 'ANO',
                    "name": 'ANO',
                    "className": "none visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 25%;"
                    }                        
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_month, 'UTF-8'); ?>" + "</span>",
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_month; ?>" + "</span>",
                    "data": 'MES',
                    "name": 'MES',
                    "className": "none visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 20%;"
                    }
                }, {
                    "title": "<span class='quadSubTitle'>" + "<?php echo mb_strtoupper($ui_period, 'UTF-8'); ?>" + "</span>",
                    "label": "<span class='quadSubTitle'>" + "<?php echo $ui_period; ?>" + "</span>",
                    "data": 'ID_PERIODO',
                    "name": 'ID_PERIODO',
                    "className": "none visibleColumn right",
                    "attr": {
                        "class": "form-control toRight",
                        "style": "width: 25%;"
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
                        return RH_ID_AJUDAS_CUSTO.crudButtons(true, true, true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DESIGEMPRESA": {
                        required: true
                    },
                    "DSP_NOME": {
                        required: true
                    },
                    "DT_INI": {
                        required: true,
                        datetimeShort: true,
                    },
                    "DT_FIM": {
                        datetimeShort: true,
                        dateEqOrNextThan: 'DT_INI'
                    },
                    "TP_AJD_CUSTO": {
                        required: true
                    },
                    "ESTADO": {
                        required: true
                    },
                    "KMS": {
                        integer: true
                    },
                    "OBS": {
                        maxlength: 4000,
                    },
                }
            }
        };
        RH_ID_AJUDAS_CUSTO = new QuadTable();
        RH_ID_AJUDAS_CUSTO.initTable($.extend({}, datatable_instance_defaults, optionRH_ID_AJUDAS_CUSTO));    


        //EDITOR EVENT                      
        $(document).on('RH_ID_AJUDAS_CUSTOAttachEvt', function (e) {
            var frm_context = "#RH_ID_AJUDAS_CUSTO_editorForm",
                operacao = RH_ID_AJUDAS_CUSTO.editor.s["action"]; //operacao ==> 'query', 'create', 'edit'
            if (operacao === 'create') {
                null;
            }

            //KM's LINKED by ROTAS VALUE
            if ( $(document).find('#DTE_Field_DSP_ROTA',frm_context).val() ) {
                $('#DTE_Field_KMS', frm_context).prop('disabled', true);
            } else {
                $('#DTE_Field_KMS', frm_context).prop('disabled', false);
            }

            if (operacao === 'create') {
                setTimeout( function () {
                    $('#RH_ID_AJUDAS_CUSTO_editorForm > div > div.DTE_Field.row.DTE_Field_Type_text.DTE_Field_Name_TIT_COMPANY.none').css('display', 'none');
                    $('#RH_ID_AJUDAS_CUSTO_editorForm > div > div.DTE_Field.row.DTE_Field_Type_text.DTE_Field_Name_TIT_FP.none').css('display', 'none');
                    $('#RH_ID_AJUDAS_CUSTO_editorForm > div > div.DTE_Field.row.DTE_Field_Type_text.DTE_Field_Name_TIT_MEALS.none.insHide').css('display', 'none');
                    $('#RH_ID_AJUDAS_CUSTO_editorForm > div > div.DTE_Field.row.DTE_Field_Type_text.DTE_Field_Name_NR_REFEICOES').css('display', 'none');
                    $('#RH_ID_AJUDAS_CUSTO_editorForm > div > div.DTE_Field.row.DTE_Field_Type_text.DTE_Field_Name_NR_REF_ABAT').css('display', 'none');
                    $('#RH_ID_AJUDAS_CUSTO_editorForm > div > div.DTE_Field.row.DTE_Field_Type_text.DTE_Field_Name_TIT_CALC').css('display', 'none');
                    $('#RH_ID_AJUDAS_CUSTO_editorForm > div > div.DTE_Field.row.DTE_Field_Type_text.DTE_Field_Name_ANO').css('display', 'none');
                    $('#RH_ID_AJUDAS_CUSTO_editorForm > div > div.DTE_Field.row.DTE_Field_Type_text.DTE_Field_Name_MES').css('display', 'none');
                    $('#RH_ID_AJUDAS_CUSTO_editorForm > div > div.DTE_Field.row.DTE_Field_Type_text.DTE_Field_Name_ID_PERIODO').css('display', 'none');
                }, 300);
            } else if (operacao === 'edit') {                    
                setTimeout( function () {
                    $('#RH_ID_AJUDAS_CUSTO_editorForm > div > div.DTE_Field.row.DTE_Field_Type_text.DTE_Field_Name_TIT_COMPANY.none').css('display', 'block');
                    $('#RH_ID_AJUDAS_CUSTO_editorForm > div > div.DTE_Field.row.DTE_Field_Type_text.DTE_Field_Name_TIT_FP.none').css('display', 'block');
                    $('#RH_ID_AJUDAS_CUSTO_editorForm > div > div.DTE_Field.row.DTE_Field_Type_text.DTE_Field_Name_TIT_MEALS.none.insHide').css('display', 'block');
                    $('#RH_ID_AJUDAS_CUSTO_editorForm > div > div.DTE_Field.row.DTE_Field_Type_text.DTE_Field_Name_NR_REFEICOES').css('display', 'block');
                    $('#RH_ID_AJUDAS_CUSTO_editorForm > div > div.DTE_Field.row.DTE_Field_Type_text.DTE_Field_Name_NR_REF_ABAT').css('display', 'block');
                    $('#RH_ID_AJUDAS_CUSTO_editorForm > div > div.DTE_Field.row.DTE_Field_Type_text.DTE_Field_Name_TIT_CALC').css('display', 'block');
                    $('#RH_ID_AJUDAS_CUSTO_editorForm > div > div.DTE_Field.row.DTE_Field_Type_text.DTE_Field_Name_ANO').css('display', 'block');
                    $('#RH_ID_AJUDAS_CUSTO_editorForm > div > div.DTE_Field.row.DTE_Field_Type_text.DTE_Field_Name_MES').css('display', 'block');
                    $('#RH_ID_AJUDAS_CUSTO_editorForm > div > div.DTE_Field.row.DTE_Field_Type_text.DTE_Field_Name_ID_PERIODO').css('display', 'block');

                    $('#DTE_Field_TIT_COMPANY').prop('disabled', true);
                    $('#DTE_Field_TIT_FP').prop('disabled', true);
                    $('#DTE_Field_NR_REFEICOES').prop('disabled', true);
                    $('#DTE_Field_NR_REF_ABAT').prop('disabled', true);
                    $('#DTE_Field_ANO').prop('disabled', true);
                    $('#DTE_Field_MES').prop('disabled', true);
                    $('#DTE_Field_ID_PERIODO').prop('disabled', true);
                }, 300);
            }


            //ROTA Changed...
            $('#DTE_Field_DSP_ROTA', frm_context).on("change", function (e) {

                if ( !$(this).val() ) {
                    $('#DTE_Field_KMS', frm_context).prop('disabled', true);
                } else {

                    //RECURSO LISTA COMPLEXA :: GET RESOURCE :: GET LOV VALUE
                    var res = RH_ID_AJUDAS_CUSTO.getComplexListIndex( _.find(RH_ID_AJUDAS_CUSTO.tableCols, {name: "DSP_ROTA"}) );

                    //Procura no RECURSO o valor de uma COLUNA NO REGISTO SELECIONADO (Cd. Horário Diario)
                    var data = _.find(res, {VAL: $(this).val()});
                    //console.log(data['OTHERVALUES']);

                    if (data['OTHERVALUES'].length) {
                        $('#DSP_HOR_DIARIO').html(data['OTHERVALUES']);                            
                        $('#DTE_Field_KMS', frm_context).val(data['OTHERVALUES'])
                        $('#DTE_Field_KMS', frm_context).prop('disabled', true);
                    } else {
                        $('#DTE_Field_KMS', frm_context).prop('disabled', false);
                    }
                }
            });

        });
        //END EDITOR EVENT
    });

</script>
