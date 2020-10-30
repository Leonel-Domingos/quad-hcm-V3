<?php
    require_once '../init.php';
?>
<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <span class="widget-icon"> <i class="fal fa-clone"></i></span>&nbsp;
                <h2><?php echo $ui_delegations; ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <a id="RH_ID_DELEGACOES_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                    <table id="RH_ID_DELEGACOES" class="table table-bordered table-hover table-striped w-100"></table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        //DELEGAÇÕES
        var perfil_ = "<?php echo @$_SESSION['perfil'];?>";
        var rhid_ = "<?php echo @$_SESSION['rhid'];?>";
        var whereClause_ = "";

        if (perfil_ == 'A') {  // Colaborador
            whereClause_ = " A.RHID = "+rhid_;
        } else if (perfil_ == 'B') { // Gestor Administrativo
            whereClause_ = " (A.RHID = '"+rhid_+"' OR (A.EMPRESA,A.RHID,A.DT_ADMISSAO) IN (SELECT F.EMPRESA,F.RHID,F.DT_ADMISSAO FROM RH_ID_EMPRESAS F WHERE F.RHID_GESTOR_ADM = "+rhid_+") ) ";
        } else if (perfil_ == 'C') { // Supervisor
            whereClause_ = " (A.RHID = '"+rhid_+"' OR (A.EMPRESA,A.RHID,A.DT_ADMISSAO) IN (SELECT F.EMPRESA,F.RHID,F.DT_ADMISSAO FROM RH_ID_EMPRESAS F WHERE F.RHID_SUPERVISOR = "+rhid_+") ) ";
        } else if (perfil_ == 'D') { // Director
            whereClause_ = " (A.RHID = '"+rhid_+"' OR (A.EMPRESA,A.RHID,A.DT_ADMISSAO) IN (SELECT F.EMPRESA,F.RHID,F.DT_ADMISSAO FROM RH_ID_EMPRESAS F WHERE F.RHID_DIRECTOR = "+rhid_+") ) ";
        } else if (perfil_ == 'E') { // Gertor
            whereClause_ = " 1=1 ";
        } else if (perfil_ == 'F') { // Dep.RH
            whereClause_ = " 1=1 ";
        } else {
            whereClause_ = " 1=1 ";
        }

        var optionRH_ID_DELEGACOES = {
            "tableId": 'RH_ID_DELEGACOES',
            "table": "RH_ID_DELEGACOES",
            "pk": {
                "primary": {
                    "EMPRESA": {"type": "varchar"},
                    "RHID": {"type": "number"},
                    "DT_ADMISSAO": {"type": "date"},
                    "RHID_DESTINO": {"type": "number"},
                    "DT_ADMISSAO_DESTINO": {"type": "date"},
                    "DT_INICIO": {"type": "date"}                
                }
            },
            "initialWhereClause": whereClause_,
            "order_by": "DT_INICIO DESC, EMPRESA ASC, RHID ASC",
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
                    "className": "",
                    "attr": {
                        "name": 'DT_ADMISSAO'
                    }
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_rhid_from, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_rhid_from; ?>",
                    "data": 'NOME',
                    "name": 'NOME',
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
                        "orderBy": 'A.RHID',
                        "filter": {
                            "create": " AND A.DT_DEMISSAO IS NULL AND A.RHID IN (SELECT F.RHID FROM DG_PERFIS_COLAB F WHERE F.ESTADO='A') AND " + whereClause_, //On-New-Record
                            "edit": " AND A.DT_DEMISSAO IS NULL AND A.RHID IN (SELECT F.RHID FROM DG_PERFIS_COLAB F WHERE F.ESTADO='A') AND " + whereClause_, //On-Edit-Record
                        },
                    }    
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'RHID_DESTINO',
                    "name": 'RHID_DESTINO',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": false,
                    "className": "",
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_ADMISSAO_DESTINO',
                    "name": 'DT_ADMISSAO_DESTINO',
                    "datatype": 'date',
                    "visible": false,
                    "type": "hidden",
                    "className": "",
                    "attr": {
                        "name": 'DT_ADMISSAO'
                    }
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_rhid_to, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_rhid_to; ?>",
                    "data": 'NOME_DESTINO',
                    "name": 'NOME_DESTINO',
                    "type": "select",
                    "className": "visibleColumn",
                    "complexList": true,
                    "attr": {
                        "dependent-group": "EMPRESA",
                        "dependent-level": 3,
                        "deferred": true,
                        "data-db-name": 'A.EMPRESA@A.RHID@A.DT_ADMISSAO',
                        "distribute-value": "EMPRESA@RHID_DESTINO@DT_ADMISSAO_DESTINO", // Usado só quando os atributos destino têm nomes de colunas diferentes da tabela fonte
                        "decodeFromTable": 'QUAD_PEOPLE A',
                        "class": "form-control complexList chosen",
                        "desigColumn": "CONCAT(CONCAT(A.RHID,'-'),A.NOME_REDZ)",
                        "whereClause": "",
                        "orderBy": 'RHID',
                        "filter": {
                            "create": " AND A.DT_DEMISSAO IS NULL AND A.RHID IN (SELECT DISTINCT F.RHID FROM DG_PERFIS_COLAB F WHERE F.ESTADO = 'A') AND (A.EMPRESA,A.RHID,A.DT_ADMISSAO) NOT IN (SELECT ':EMPRESA',':RHID',':DT_ADMISSAO' FROM DUAL) ", 
                            "edit": " AND A.DT_DEMISSAO IS NULL AND A.RHID IN (SELECT DISTINCT F.RHID FROM DG_PERFIS_COLAB F WHERE F.ESTADO = 'A') AND (A.EMPRESA,A.RHID,A.DT_ADMISSAO) NOT IN (SELECT ':EMPRESA',':RHID',':DT_ADMISSAO' FROM DUAL) ", 
                        }
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'PERFIL',
                    "name": 'PERFIL',
                    "type": "hidden",
                    "visible": false,
                    "className": "",
                }, {
                      //TODO: Implementar hipótese de não colocando o perfil => assume TODOS
                      "responsivePriority": 4,
                      "title": "<?php echo mb_strtoupper($ui_profile, 'UTF-8'); ?>", //Datatables
                      "label": "<?php echo $ui_profile; ?>", //Editor
                      "fieldInfo": "<?php echo $ui_delegated_profile; ?>",
                      "data": 'DSP_PERFIL',
                      "name": 'DSP_PERFIL',
                      "type": "select",
                      "className": "visibleColumn",
                      "complexList": true,
                      "attr": {
                        "dependent-group": "EMPRESA",
                        "dependent-level": 3,
                        "deferred": true,
                        "data-db-name": "A.TIPO_PERFIL",
                        "distribute-value": "PERFIL",
                        "decodeFromTable": 'DG_PERFIS_COLAB A',
                        "class": "form-control complexList chosen",
                        "desigColumn": "A.DS_PERFIL",
                        "whereClause": "",
                        "orderBy": 'A.TIPO_PERFIL',
                        "filter": {
                            "create": " AND A.ESTADO = 'A' AND A.RHID = ':RHID' ", 
                            "edit": " AND A.ESTADO = 'A' AND A.RHID = ':RHID' ", 
                         },
                      }
                }, {
                    //"targets": 10,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INICIO',
                    "name": 'DT_INICIO',
                    "datatype": 'date',
                    "def": hoje(), // hoje() OR hoje('minutes') OR "def": hoje('seconds')
                    "className": "visibleColumn",
                    "attr": {
                        "name": 'DT_INICIO',
                        "class": "datepicker"
                    }
                }, {
                    //"targets": 11,
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM',
                    "name": 'DT_FIM',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "name": 'DT_FIM',
                        "class": "datepicker"
                    }
                }, {
                      //"targets": 9,
                      "responsivePriority": 4,
                      "title": "<?php echo mb_strtoupper($ui_workflow, 'UTF-8'); ?>", //Datatables
                      "label": "<?php echo $ui_workflow; ?>", //Editor
                      "data": 'ESTADO',
                      "name": 'ESTADO',
                      "type": "select",
                      "className": "visibleColumn",
                      "attr": {
                          "domain-list": true,
                          "dependent-group": 'RH_ID_DELEGACOES.ESTADO',
                          "class": "form-control",
                          "name": 'ESTADO',
                          "disabled": true
                      },
                      "render": function (val, type, row) {
                          if (typeof (val) === "object" && val === null) {
                              return val;
                          } else {
                              var o = _.find(initApp.joinsData['RH_ID_DELEGACOES.ESTADO'], {'RV_LOW_VALUE': val});
                              return val == null ? null : o['RV_MEANING']; //o['RV_ABBREVIATION'] ????
                          } 
                      }     
                }, {
                    //"targets": 12,
                    "title": "<?php echo mb_strtoupper($ui_obs_short, 'UTF-8'); ?>" + '</span>', //Datatables
                    "label": "<?php echo $ui_obs_short; ?>", //Editor
                    "data": 'OBS',
                    "name": 'OBS',
                    "type": 'textarea', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "name": 'OBS',
                        "style": "max-width: 335px",
                    }
                }, {
                    //"targets": 13,
                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_created_by, 'UTF-8'); ?>" + '</span>', //Datatables
                    "label": "<?php echo $ui_created_by; ?>", //Editor
                    "data": 'INSERTED_BY',
                    "name": 'INSERTED_BY',
                    "type": "hidden",
                    "className": "none visibleColumn",
                    "render": function (val, type, row) {
                        if (typeof (val) === "object" && val === null) {
                            return '<span class="timelogValue">&nbsp;</span>';
                        } else {
                            return '<span class="timelogValue">' + val + '</span>';
                        }
                    }
                }, {
                    //"targets": 14,
                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_dt_created_by, 'UTF-8'); ?>" + '</span>', //Datatables
                    "label": "<?php echo $ui_dt_created_by; ?>", //Editor
                    "data": 'DT_INSERTED',
                    "name": 'DT_INSERTED',
                    "datatype": 'datetime', // datetime OR datetimeShort OR datetime
                    "className": "none visibleColumn",
                    "type": "hidden",
                    "attr": {
                        "name": 'DT_INSERTED',
                        "class": "dateTimePicker seconds" //(.datepicker OR .dateTimePickerShort OR .dateTimePicker) AND (.minutes OR .seconds for CSS format width)
                    },
                    "render": function (val, type, row) {
                        if (typeof (val) === "object" && val === null) {
                            return '<span class="timelogValue">&nbsp;</span>';
                        } else {
                            return '<span class="timelogValue">' + val + '</span>';
                        }
                    }
                }, {
                    //"targets": 15,
                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_last_updated_by, 'UTF-8'); ?>" + '</span>', //Datatables
                    "label": "<?php echo $ui_last_updated_by; ?>", //Editor
                    "data": 'CHANGED_BY',
                    "name": 'CHANGED_BY',
                    "type": "hidden",
                    "className": "none visibleColumn",
                    "render": function (val, type, row) {
                        if (typeof (val) === "object" && val === null) {
                            return '<span class="timelogValue">&nbsp;</span>';
                        } else {
                            return '<span class="timelogValue">' + val + '</span>';
                        }
                    }
                }, {
                    //"targets": 16,
                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_dt_last_updated_by, 'UTF-8'); ?>" + '</span>', //Datatables
                    "label": "<?php echo $ui_dt_last_updated_by; ?>", //Editor
                    "data": 'DT_UPDATED',
                    "name": 'DT_UPDATED',
                    "type": "hidden",
                    "datatype": 'datetime', // datetime OR datetimeShort OR datetime
                    "className": "none visibleColumn",
                    "attr": {
                        "name": 'DT_UPDATED',
                        "class": "dateTimePicker seconds" //(.datepicker OR .dateTimePickerShort OR .dateTimePicker) AND (.minutes OR .seconds for CSS format width)
                    },
                    "render": function (val, type, row) {
                        if (typeof (val) === "object" && val === null) {
                            return '<span class="timelogValue">&nbsp;</span>';
                        } else {
                            return '<span class="timelogValue">' + val + '</span>';
                        }
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
                        return RH_ID_DELEGACOES.crudButtons(true, true, true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DESIGEMPRESA": {
                        required: true
                    },
                    "DT_INICIO": {
                        required: true,
                        dateISO: true,
                    },
                    "NOME": {
                        required: true,
                    },
                    "NOME_DESTINO": {
                        required: true,
                    },
                    "PERFIL": {
                        required: true,
                    },
                    "OBS": {
                        maxlength: 4000,
                    },
                    "DT_FIM": {
                        dateISO: true,
                        dateEqOrNextThan: 'DT_INICIO'
                    },
                },
                /* Se aqui definido sobrepõem-se ao definido em /inc/scripts.php*/
                "messages": {
                    "DT_FIM": {
                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                    }
                }
            }
        };
        RH_ID_DELEGACOES = new QuadTable();
        RH_ID_DELEGACOES.initTable($.extend({}, datatable_instance_defaults, optionRH_ID_DELEGACOES));    

        //EDITOR EVENTS EXTENTION :: disable ESTADO on INSERT/UPDATE
        $(document).on('RH_ID_DELEGACOESAttachEvt', function (e) {   
            setTimeout(function () {
                $('#DTE_Field_ESTADO').attr('disabled', 'disabled');
            }, 100);
        });
    });
</script>
