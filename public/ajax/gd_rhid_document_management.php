<?php
    require_once '../init.php';
?>
<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <span class="widget-icon"> <i class="fal fa-clone"></i></span>&nbsp;
                <h2><?php echo $ui_docs_management . " - " . $ui_process; ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">                                            
                    <a id="rhid_gestao_documental_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                    <table id="rhid_gestao_documental" class="table table-bordered table-hover table-striped w-100"></table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-end">
                <div class="panel-toolbar pr-3 align-self-end tabs__">
                    <ul id="demo_panel-tabs" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#Tab1" role="tab" aria-selected="true"><?php echo $ui_form; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Tab2" role="tab" aria-selected="true"><?php echo $ui_phases; ?></a>
                        </li>
                    </ul>
                </div>
            </div>   
            
            <div class="panel-container show">
                <div class="panel-content">
                    
                    <div class="tab-content">

                         <!-- TAB #1 -->
                        <div class="tab-pane fade active show" id="Tab1" role="tabpanel">
                            <div id="formError" class="alert fade in show" style="display:none; background-color:#ff4f4f2b!important">
                                <button class="close">x</button>
                                <i class="fa-fw fa fa-warning"></i>
                                <strong><?php echo $ui_gd_error_title_form; ?></strong> <span id="formMsg"></span>
                            </div>
                            <div id="lineError" class="alert /*alert-danger*/ fade in show" style="display:none; background-color:#ff4f4f2b!important">
                                <button class="close">x</button>
                                <i class="fa-fw fa fa-times"></i>
                                <strong><?php echo $ui_gd_error_title_lines; ?>!</strong> <span id="lineMsg"></span>
                            </div>
                            <form id="varsForm" method="post">
                                <a id="rh_id_gd_variaveis_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                <table id="rh_id_gd_variaveis" class="table responsive table-bordered table-striped table-hover nowrap">
                                </table>

                                <div class="form-actions show" style="display: none;padding: 9px 14px 9px; border: 1px solid rgba(0,0,0,.1); background: rgba(249,249,249,.9); text-align: right; margin: 13px 0px -10px;">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button id="saveDetails" type="button" class="btn btn-sm btn-primary">
                                                <i class="fa fa-hand-o-right"></i>
                                                <?php echo $ui_submit; ?>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>                                      
                        </div>
                         <!-- END TAB #1 -->

                         <!-- TAB #2 -->
                        <div class="tab-pane fade" id="Tab2" role="tabpanel">
                            <table id="rh_id_gd_docs" class="table table-bordered table-hover table-striped w-100"></table>
                        </div>
                         <!-- END TAB #2 -->
                    </div>                    
                </div>                    

            </div> 
        </div>
    </div>
</div>

<script>

    pageSetUp();

    /* Função (de reserva) que possa ser associada a ações do user na introdução de dados (por exemplo no CLICK) */
    function myFunction(el, event) {
        var x = event.type;
        //console.log("myFunction");
        //console.log("Begin myFunction...");
        //console.log(el);
        //console.log(event.type);
        if (event.type == 'click') {
            null;
        }
        return true;
    }

    /* Validação dos inputs por linha */
    function LineValidation(el) {
        //console.log("LineValidation");
        //console.log(el);
        //console.log($(el).val()+" "+$(el).attr("max"));
        var elm = $(el);
        try {
            if (parseFloat(elm.val()) < parseFloat(elm.attr("min")) && elm.attr("min") !== '') {
                elm.val(elm.attr("min"));
            }
        } catch (er) {
            null;
        }

        try {
            if (parseFloat(elm.val()) > parseFloat(elm.attr("max")) && elm.attr("max") !== '') {
                elm.val(elm.attr("max"));
            }
        } catch (er) {
            null;
        }

        return true;
        //console.log(el.event);
        if (el) {
            // If triggered by direct event: el.validity.valueMissing
            // If triggered by deferred event: el[0].validity.valueMissing
            if (el[0].validity.valueMissing) {// === (el.required && el.value === '') {
                el[0].setCustomValidity("<?php echo $ui_required; ?>");
                return false;
                //} else if (el.validity.typeMismatch) {
                //    el.setCustomValidity('Please enter a valid email address');
                /* https://developer.mozilla.org/en-US/docs/Web/API/ValidityState
                 validity:ValidityState {
                 badInput:true,
                 customError:false,
                 patternMismatch:true,
                 rangeOverflow:true,
                 rangeUnderflow:true,
                 stepMismatch:true,
                 tooLong:true,
                 tooShort:true,
                 typeMismatch:true,
                 valid:true,
                 valueMissing:true
                 }
                 */
            } else {
                el[0].setCustomValidity('');
            }
        }
        return true;
    }

    $(document).ready(function () {
        /* Datepicker activation for date input's */
        $(document).on('click', '.datepicker', function (e) {
            var el = $(this);
            $('#' + el.attr('id')).datepicker({
                dateFormat: "yy-mm-dd",
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>',
                constrainInput: false,
                /*este código não está a fazer nada. Era para fazer pesquisas utilizando expressão mais datepicker value
                 beforeShow: function () {
                 $(this).val();
                 },
                 onSelect: function (dateText) {
                 if ($(this).data('previous')) {
                 $(this).val($(this).data('previous') + dateText);
                 }
                 $(this).focus();
                 }
                 */
            });
            $('#' + el.attr('id')).focus();
        });

        /* Hides From Errors dialog when DISPLAYED */
        $("#formError > button").on("click", function () {
            $("#formError").css('display', 'none');
        });
        /* Hides LINES Errors dialog when DISPLAYED */
        $("#lineError > button").on("click", function () {
            $("#lineError").css('display', 'none');
        });

        //Gestão Documental :: PROCESSO
        var perfil_ = "<?php echo @$_SESSION['perfil'];?>";
        var rhid_ = "<?php echo @$_SESSION['rhid'];?>";
        var whereClause_ = "";
        var insert_ = true, update_ = true, delete_ = true;

        /*
            FASE    Descrição
            A	Elaboração
            B	Valid. Gestor Adm.
            C	Valid. Supervisor
            D	Valid. Diretor
            E	Valid. Gestor
            F	Assinat. Colaborador
            G	Assinat. Gestor Adm.
            H	Assinat. Supervisor
            I	Assinat. Diretor
            J	Assinat. Gestor
            K	Aprov. Gestor Adm.
            L	Aprov. Supervisor
            M	Aprov. Diretor
            N	Aprov. Gestor
            O	Aprovado
            P	Rejeitado
            Z	Cancelado
        */

        if (perfil_ == 'A') {  // Colaborador só vê documentos Assinat. Colaborador e Aprovado
            whereClause_ = " RHID = "+rhid_+" AND FASE IN ('F','O') ";
            insert_ = false;
            update_ = false;
            delete_ = false;
        } else if (perfil_ == 'B') { // Gestor Administrativo
            whereClause_ = " ((FASE IN ('A','B','G','K') AND (EMPRESA,RHID,DT_ADMISSAO) IN (SELECT EMPRESA,RHID,DT_ADMISSAO FROM RH_ID_EMPRESAS WHERE RHID_GESTOR_ADM = '"+rhid_+"') AND (CD_GD,DT_INI_GD,CD_DET_GD,DT_INI_DET_GD,FASE) IN (SELECT CD_GD,DT_INI_GD,CD_DET_GD,DT_INI_DET_GD,TIPO FROM DG_GD_FASES WHERE RHID IS NULL) ) " +
                           "   OR " +
                           "  ((CD_GD,DT_INI_GD,CD_DET_GD,DT_INI_DET_GD,FASE) IN (SELECT CD_GD,DT_INI_GD,CD_DET_GD,DT_INI_DET_GD,TIPO FROM DG_GD_FASES WHERE RHID='"+rhid_+"') ) )";
            delete_ = false;
        } else if (perfil_ == 'C') { // Supervisor
            whereClause_ = " ((FASE IN ('A','C','H','L') AND (EMPRESA,RHID,DT_ADMISSAO) IN (SELECT EMPRESA,RHID,DT_ADMISSAO FROM RH_ID_EMPRESAS WHERE RHID_SUPERVISOR = '"+rhid_+"') AND (CD_GD,DT_INI_GD,CD_DET_GD,DT_INI_DET_GD,FASE) IN (SELECT CD_GD,DT_INI_GD,CD_DET_GD,DT_INI_DET_GD,TIPO FROM DG_GD_FASES WHERE RHID IS NULL) ) " +
                           "   OR " +
                           "  ((CD_GD,DT_INI_GD,CD_DET_GD,DT_INI_DET_GD,FASE) IN (SELECT CD_GD,DT_INI_GD,CD_DET_GD,DT_INI_DET_GD,TIPO FROM DG_GD_FASES WHERE RHID='"+rhid_+"') ) )";
            delete_ = false;
        } else if (perfil_ == 'D') { // Director
            whereClause_ = " ((FASE IN ('D','I','M') AND (EMPRESA,RHID,DT_ADMISSAO) IN (SELECT EMPRESA,RHID,DT_ADMISSAO FROM RH_ID_EMPRESAS WHERE RHID_DIRECTOR = '"+rhid_+"') AND (CD_GD,DT_INI_GD,CD_DET_GD,DT_INI_DET_GD,FASE) IN (SELECT CD_GD,DT_INI_GD,CD_DET_GD,DT_INI_DET_GD,TIPO FROM DG_GD_FASES WHERE RHID IS NULL) ) " +
                           "  OR " +
                           "  ((CD_GD,DT_INI_GD,CD_DET_GD,DT_INI_DET_GD,FASE) IN (SELECT CD_GD,DT_INI_GD,CD_DET_GD,DT_INI_DET_GD,TIPO FROM DG_GD_FASES WHERE RHID='"+rhid_+"') ) )";
            delete_ = false;
        } else if (perfil_ == 'E') { // Gestor
            whereClause_ = " 1 = 1 ";
        } else if (perfil_ == 'F') { // Dep.RH
            whereClause_ = " 1 = 1 ";
        } else { // Others
            whereClause_ = " 1 = 1 ";
        }

        // inicialização do CRUD para a instância: rhid_gestao_documental
        //window['userAllowedCrud']['RHID_GESTAO_DOCUMENTAL']=[insert_, update_, delete_];

        var optionRhid_Gestao_Docs = {
            "tableId": 'rhid_gestao_documental',
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_process; ?>",
            "table": "RH_ID_GESTAO_DOCUMENTAL",
            "pk": {
                "primary": {
                    "ID_PROC_GD": {"type": "number"}
                }
            },
            "initialWhereClause": whereClause_,
            "order_by": "ID_PROC_GD ASC",
            "recordBundle": 7,
            "pageLenght": 7,
            "scrollY": "195",
            "responsive": true,
            "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
            "detailsObjects": ['rh_id_gd_variaveis', 'rh_id_gd_docs'],
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "width": "1%",
                    "className": "control toBottom toCenter",
                    "orderable": false,
                    "defaultContent": ''
                }, {
                    "sTitle": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "title": "<?php echo $ui_code; ?>", //Available on Editor to replace label (quadTable.js line 632)
                    "label": "<?php echo $ui_code; ?>", //Editor :: Not available on Sequence label
                    "data": 'ID_PROC_GD',
                    "name": 'ID_PROC_GD',
                    "datatype": 'sequence',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": true,
                    "className": "visibleColumn",
                }, {
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI',
                    "name": 'DT_INI',
                    "datatype": 'date',
                    "def": hoje(), // hoje() OR hoje('minutes') OR "def": hoje('seconds')
                    "className": "visibleColumn",
                    "attr": {
                        "name": 'DT_INI',
                        "class": "datepicker"
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_type, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_type; ?>", //Editor
                    "data": 'CD_GD',
                    "name": 'CD_GD',
                    //"datatype": 'sequence',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": false,
                    "className": "visibleColumn",
                }, {
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_GD',
                    "name": 'DT_INI_GD',
                    "datatype": 'date',
                    "visible": false,
                    "type": "hidden",
                    "className": "visibleColumn",
                    "attr": {
                        "name": 'DT_INI_GD',
                        "class": "datepicker"
                    }
                }, {
                    "complexList": true,
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_type, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_type; ?>",
                    "data": 'DSP_GD',
                    "name": 'DSP_GD',
                    "type": "select",
                    "className": "visibleColumn",
                    "renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...
                    "attr": {
                        "dependent-level": 1,
                        "dependent-group": "TIPOS_GD",
                        "data-db-name": "A.CD_GD@A.DT_INI_GD",
                        "decodeFromTable": "DG_GESTAO_DOCUMENTAL A",
                        "desigColumn": "CONCAT(CONCAT(A.CD_GD,'-'),A.DSP)",
                        "orderBy": "A.CD_GD",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": ' AND A.DT_FIM IS NULL', //On-New-Record
                            "edit": ' AND A.DT_FIM IS NULL', //On-Edit-Record
                        }
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_type, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_type; ?>", //Editor
                    "data": 'CD_DET_GD',
                    "name": 'CD_DET_GD',
                    //"datatype": 'sequence',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": false,
                    "className": "visibleColumn",
                }, {
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_DET_GD',
                    "name": 'DT_INI_DET_GD',
                    "datatype": 'date',
                    "visible": false,
                    "type": "hidden",
                    "className": "visibleColumn",
                    "attr": {
                        "name": 'DT_INI_DET_GD',
                        "class": "datepicker"
                    }
                }, {
                    "complexList": true,
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_model, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_model; ?>",
                    "data": 'DSP_MODEL',
                    "name": 'DSP_MODEL',
                    "type": "select",
                    "className": "visibleColumn",
                    "renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...
                    "attr": {
                        "dependent-level": 2,
                        "dependent-group": "TIPOS_GD",
                        "data-db-name": "A.CD_GD@A.DT_INI_GD@A.CD_DET_GD@A.DT_INI_DET_GD",
                        "decodeFromTable": "DG_DET_GESTAO_DOCUMENTAL A",
                        "desigColumn": "CONCAT(CONCAT(A.CD_DET_GD,'-'),A.DSP)",
                        //"otherValues": "OBRIGA_ID_VINCULO@NR_MAX_OCORRENCIAS@DURACAO@DT_FIM_OBRIGATORIA",
                        "orderBy": "A.CD_DET_GD",
                        "class": "form-control complexList chosen",
                        "filter": {
                            "create": ' AND A.DT_FIM IS NULL', //On-New-Record
                            "edit": ' AND A.DT_FIM IS NULL', //On-Edit-Record
                        }
                    }
                }, {
                    "title": "",
                    "label": "",
                    "data": 'EMPRESA',
                    "name": 'EMPRESA',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": false,
                }, {
                    "responsivePriority": 2,
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_company, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_company; ?>",
                    "data": 'DESIGEMPRESA',
                    "name": 'DESIGEMPRESA',
                    "type": "select",
                    "className": "visibleColumn",
                    "visible": true, //DataTables
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
                    "title": "<?php echo mb_strtoupper($ui_rhid, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_rhid; ?>", //Editor
                    "data": 'RHID',
                    "name": 'RHID',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": false,
                    "className": "visibleColumn",
                }, {
                    "title": "<?php echo mb_strtoupper($ui_dt_admission, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_dt_admission; ?>", //Editor
                    "data": 'DT_ADMISSAO',
                    "name": 'DT_ADMISSAO',
                    "datatype": 'date',
                    "visible": false,
                    "type": "hidden",
                    "className": "visibleColumn",
                    "attr": {
                        "name": 'DT_ADMISSAO'
                    }
                }, {
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_rhid, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_rhid; ?>",
                    "data": 'NOME',
                    "name": 'NOME',
                    "type": "select",
                    "className": "visibleColumn",
                    "complexList": true,
                    "attr": {
                        "name": 'NOME',
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
                    /*                        //"targets": 14,
                     "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                     "label": "<?php echo $ui_code; ?>", //Editor
                     "data": 'CD_VINCULO',
                     "name": 'CD_VINCULO',
                     "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                     "visible": false,
                     "className": "visibleColumn",
                     }, {
                     //"targets": 15,
                     "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                     "label": "<?php echo $ui_begin_date; ?>", //Editor
                     "data": 'DT_INI_VINCULO',
                     "name": 'DT_INI_VINCULO',
                     "datatype": 'date',
                     "visible": false,
                     "type": "hidden",
                     "className": "visibleColumn",
                     "attr": {
                     "name": 'DT_INI_VINCULO',
                     "class": "datepicker"
                     }
                     }, {
                     //"targets": 16,
                     "responsivePriority": 3,
                     "complexList": true,
                     "title": "<?php echo mb_strtoupper($ui_contractual_bond, 'UTF-8'); ?>",
                     "label": "<?php echo $ui_contractual_bond; ?>",
                     "data": 'DSP_VINCULO',
                     "name": 'DSP_VINCULO',
                     "type": "select",
                     "className": "visibleColumn",
                     "attr": {
                     "dependent-group": "EMPRESA",
                     "dependent-level": 3,
                     "data-db-name": 'A.EMPRESA@A.RHID@A.DT_ADMISSAO@A.CD_VINCULO@A.DT_INI_VINCULO',
                     "decodeFromTable": 'RH_ID_VINCULOS_VIEW A',
                     "class": "form-control complexList chosen",
                     "desigColumn": "A.DSP_VINCULO",
                     "whereClause": "",
                     "orderBy": 'A.DT_INI_VINCULO desc',
                     "filter": {
                     "create": " AND TO_CHAR(QUADATE(),'YYYY-MM-DD') BETWEEN TO_CHAR(A.DT_INI_VINCULO,'YYYY-MM-DD') AND TO_CHAR(NVL(A.DT_FIM_VINCULO,QUADATE()),'YYYY-MM-DD')", //On-New-Record
                     "edit": "", //On-Edit-Record
                     },
                     }
                     }, {*/
                    /*
                     * Só disponível em modo QUERY (ver trigger rhid_gestao_documentalAtchEvent).
                     * Desnormalização da fase em que se encontra o processo.
                     * Gerido pela base de dados.
                     */
                    //"targets": 14,
                    "title": "",
                    "label": "",
                    "data": 'FASE',
                    "name": 'FASE',
                    "type": "hidden",
                    "visible": false,
                }, {
                    /*
                     * Esta atributo só é ativado no QUERY e o atributo DSP_FASE é escondido.
                     * Para que nas operações de DML, o DSP_FASE tenha efeito, deverá ser posicionado depois deste atributo
                     * caso contrário, o DSP_FASE_1 teria o valor da FASE no momento inicial e na atribuição de valores, se o DSP_FASE_1
                     * aparecesse após o DSP_FASE, o valor de FASE teria sempre o do DSP_FASE_1 o que fazia com que o valor de FASE se
                     * mantivesse inalterado.
                     */
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_phase, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_phase; ?>",
                    "fieldInfo": "<?php echo $hint_independent_gd_phases; ?>",
                    "data": 'DSP_FASE_1',
                    "name": 'DSP_FASE_1',
                    "type": "select",
                    "visible": false,
                    "complexList": true,
                    "attr": {
                        "dependent-group": "FASES_QRY",
                        "dependent-level": 1,
                        "data-db-name": 'A.VALUE',
                        "distribute-value": "FASE", // Usado só quando os atributos destino têm nomes de colunas diferentes da tabela fonte
                        "decodeFromTable": 'DG_FASES_GD_VW A',
                        "class": "form-control complexList chosen",
                        "desigColumn": "A.LABEL",
                        "whereClause": "",
                        "orderBy": 'A.VALUE'
                    }
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_phase, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_phase; ?>",
                    "data": 'DSP_FASE',
                    "name": 'DSP_FASE',
                    "type": "select",
                    "className": "visibleColumn",
                    "complexList": true,
/*                        "attr": {
                        "dependent-group": "TIPOS_GD",
                        "dependent-level": 3,
                        //"data-db-name": 'VALUE',
                        "data-db-name": "A.CD_GD@A.DT_INI_GD@A.CD_DET_GD@A.DT_INI_DET_GD@A.VALUE",
                        "distribute-value": "CD_GD@DT_INI_GD@CD_DET_GD@DT_INI_DET_GD@FASE", // Usado só quando os atributos destino têm nomes de colunas diferentes da tabela fonte
                        "decodeFromTable": 'DG_FASES_GD_NEW_VW A',
                        "class": "form-control complexList chosen",
                        "desigColumn": "A.LABEL",
                        "whereClause": "",
                        "orderBy": 'VALUE',
                        //"deferred": true,
                        "filter": {
                            "create": " AND (A.CD_GD,A.DT_INI_GD,A.CD_DET_GD,A.DT_INI_DET_GD,A.VALUE) IN "+
                                      "(SELECT F.CD_GD,F.DT_INI_GD,F.CD_DET_GD,F.DT_INI_DET_GD,MIN(F.TIPO) "+
                                      " FROM DG_GD_FASES F  " +
                                      " GROUP BY F.CD_GD,F.DT_INI_GD,F.CD_DET_GD,F.DT_INI_DET_GD)", //On-New-Record
                            "edit": " AND A.VALUE IN (SELECT X.TIPO FROM RH_ID_GESTAO_DOCUMENTAL F, DG_GD_FASES X " +
                                    "   WHERE F.CD_GD = X.CD_GD AND F.DT_INI_GD = X.DT_INI_GD AND F.CD_DET_GD = X.CD_DET_GD" +
                                    "   AND F.DT_INI_DET_GD = X.DT_INI_DET_GD AND F.ID_PROC_GD = ':ID_PROC_GD' )", //On-Update-Record
                        }
                    }
*/
                    "renew": true,
                    "attr": {
                        "dependent-group": "TIPOS_GD",
                        "dependent-level": 3,
                        "data-db-name": 'A.VALUE',
                        "distribute-value": "FASE", // Usado só quando os atributos destino têm nomes de colunas diferentes da tabela fonte
                        "decodeFromTable": 'DG_FASES_GD_VW A',
                        "class": "form-control complexList chosen",
                        "desigColumn": "A.LABEL",
                        "whereClause": "",
                        "orderBy": 'A.VALUE',
                        "deferred": true,
                        "filter": {
                            "create": " AND A.VALUE IN (SELECT MIN(F.TIPO) FROM DG_GD_FASES F  " +
                                      "   WHERE F.CD_GD = ':CD_GD' AND F.CD_DET_GD = ':CD_DET_GD' )", //On-New-Record
                            "edit": " AND A.VALUE IN (SELECT X.TIPO FROM RH_ID_GESTAO_DOCUMENTAL F, DG_GD_FASES X " +
                                    "   WHERE F.CD_GD = X.CD_GD AND F.DT_INI_GD = X.DT_INI_GD AND F.CD_DET_GD = X.CD_DET_GD" +
                                    "   AND F.DT_INI_DET_GD = X.DT_INI_DET_GD AND F.ID_PROC_GD = ':ID_PROC_GD' )", //On-Update-Record
                        }
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_internal_reference_short, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_internal_reference_short; ?>", //Editor
                    "data": 'REF_INTERNA',
                    "name": 'REF_INTERNA',
                    "className": "visibleColumn",
                }, {
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_macro_process, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_macro_process; ?>", //Editor
                    "data": 'ID_HDR_AUTO',
                    "name": 'ID_HDR_AUTO',
                    "className": "visibleColumn",
                    "attr": {
                        "disabled": true
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
                        "style": "max-width: 335px",
                    }
                }, {
                    //"targets": 18,
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
                    //"targets": 19,
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
                    //"targets": 20,
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
                    //"targets": 21,
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
                    //"targets": 22,
                    "responsivePriority": 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function (val, type, row) {
                            if (perfil_ === 'A' ) { // colaborador
                                return null;
                            }
                            else if (perfil_ === 'B' || perfil_ === 'C' || perfil_ === 'D' ) { // gestor adm, supervisor, diretor
                                if (row['FASE'] === 'A') { // documento Em Elaboração
                                    return rhid_gestao_documental.crudButtons(true,true,false);
                                } else {
                                    return rhid_gestao_documental.crudButtons(true,false,false);
                                }
                            } else {
                                return rhid_gestao_documental.crudButtons(true,true,true);
                            }
 /*                           if (perfil_ === 'E' && perfil_ === 'F' && perfil_ === 'Z') {  // GESTOR, DEP.RH, ADMINISTRADOR
console.log("1. perfil:"+perfil_+" proc:"+row['DSP_GD']+" fase:"+row['FASE']);
                            return rhid_gestao_documental.crudButtons(userAllowedCrud);
                        } else { // Se perfis != GESTOR / ADMINISTRADOR
                            if (row['FASE'] === 'A') { // documento Em Elaboração
console.log("2. perfil:"+perfil_+" proc:"+row['DSP_GD']+" fase:"+row['FASE']);
console.log(window['userAllowedCrud']['rhid_gestao_documental']);
console.log(userAllowedCrud);
                                return rhid_gestao_documental.crudButtons(userAllowedCrud);
                            } else { // não é possivel efetuar atualizações ao documento
console.log("3. perfil:"+perfil_+" proc:"+row['DSP_GD']+" fase:"+row['FASE']);
                                return rhid_gestao_documental.crudButtons(insert_,false,delete_);
                            }
                        }*/
                        //return rhid_gestao_documental.crudButtons(true, true, true);
                    }
                }
            ],
            "footerCallback": function (settings) {
                //console.log ( rhid_gestao_documental.tbl.data() );
            },
            "validations": {
                "rules": {
                    "DSP_GD": {
                        required: true
                    },
                    "DSP_MODEL": {
                        required: true
                    },
                    "DESIGEMPRESA": {
                        required: true,
                        maxlength: 80,
                    },
                    "DSP_FASE": {
                        required: true
                    },
                    "NOME": {
                        required: true,
                    },
                    "REF_INTERNA": {
                        maxlength: 100,
                    },
                    "OBS": {
                        maxlength: 4000,
                    },
                    "DT_FIM": {
                        dateISO: true,
                        dateEqOrNextThan: 'DT_INI'
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
        rhid_gestao_documental = new QuadTable();
        rhid_gestao_documental.initTable($.extend({}, datatable_instance_defaults, optionRhid_Gestao_Docs));

        //EDITOR EVENTS EXTENTION :: disable ID_HDR_AUTO on INSERT/UPDATE
        $(document).on('rhid_gestao_documentalAttachEvt', function (e) {
            setTimeout(function () {
                var frm_context = "#rhid_gestao_documental_editorForm", operacao = rhid_gestao_documental.editor.s["action"],
                    ok_style = {'display': 'block'}, nok_style = {'display': 'none'},
                    bd_fase = $("#rhid_gestao_documental_editorForm > div > div.DTE_Field.row.DTE_Field_Type_select.DTE_Field_Name_DSP_FASE"),
                    qry_fase = $("#rhid_gestao_documental_editorForm > div > div.DTE_Field.row.DTE_Field_Type_select.DTE_Field_Name_DSP_FASE_1");

                $('#DTE_Field_ID_HDR_AUTO',frm_context).attr('disabled', true);
                if (operacao !== 'query') {
                    bd_fase.css(ok_style);
                    qry_fase.css(nok_style);
                    if (operacao === 'create') {
                        $('#DTE_Field_ID_HDR_AUTO',frm_context).val("");
                    }
                } else {
                    $('#DTE_Field_ID_HDR_AUTO',frm_context).attr('disabled', false);
                    bd_fase.css(nok_style);
                    qry_fase.css(ok_style);
                }

            }, 300);
        });
        //END Gestão Documental :: PROCESSO

        //Gestão Documental :: FORMULÁRIO (variáveis)
        var optionRhid_Gd_Variaveis = {
            "tableId": 'rh_id_gd_variaveis',
            "order": false,
            "table": "RH_ID_GD_VARIAVEIS",
            "pk": {
                "primary": {
                    "ID_PROC_GD": {"type": "number"},
                    "SEQ": {"type": "number"}
                }
            },
            "dependsOn": {
                "rhid_gestao_documental": {
                    //External object key mapping( object key : external key)
                    "ID_PROC_GD": "ID_PROC_GD"
                }
            },
            "order_by": "SEQ DESC",
            "recordBundle": 9999999999,
            "pageLenght": 9999999999,
            "scrollY": "279",
            "responsive": true,
            "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
            "tableCols": [
                {
                    //"targets": 0,
                    "responsivePriority": 1,
                    "data": null,
                    "width": "1%",
                    "className": "control toBottom toCenter",
                    "orderable": false,
                    "defaultContent": ''
                }, {
                    //"targets": 1,
                    "title": "<?php echo mb_strtoupper($ui_process, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_process; ?>", //Editor
                    "data": 'ID_PROC_GD',
                    "name": 'ID_PROC_GD',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": false,
                    "className": "visibleColumn",
                }, {
                    //"targets": 2,
                    "sTitle": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "title": "<?php echo $ui_code; ?>", //Available on Editor to replace label (quadTable.js line 632)
                    "label": "<?php echo $ui_code; ?>", //Editor :: Not available on Sequence label
                    "data": 'SEQ',
                    "name": 'SEQ',
                    "datatype": 'sequence',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": false,
                    "className": "visibleColumn",
                }, {
                    //"targets": 3,
                    "title": "<?php echo mb_strtoupper($ui_type, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_type; ?>", //Editor
                    "data": 'CD_GD',
                    "name": 'CD_GD',
                    //"datatype": 'sequence',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": false,
                    "className": "visibleColumn",
                }, {
                    //"targets": 4,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_GD',
                    "name": 'DT_INI_GD',
                    "datatype": 'date',
                    "visible": false,
                    "type": "hidden",
                    "className": "visibleColumn",
                    "attr": {
                        "name": 'DT_INI_GD',
                        "class": "datepicker"
                    }
                }, {
                    //"targets": 5,
                    "title": "<?php echo mb_strtoupper($ui_type, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_type; ?>", //Editor
                    "data": 'CD_DET_GD',
                    "name": 'CD_DET_GD',
                    //"datatype": 'sequence',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": false,
                    "className": "visibleColumn",
                }, {
                    //"targets": 6,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_DET_GD',
                    "name": 'DT_INI_DET_GD',
                    "datatype": 'date',
                    "visible": false,
                    "type": "hidden",
                    "className": "visibleColumn",
                    "attr": {
                        "name": 'DT_INI_DET_GD',
                        "class": "datepicker"
                    }
                }, {
                    //"targets": 7,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_FRM',
                    "name": 'DT_INI_FRM',
                    "datatype": 'date',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": false,
                    "className": "visibleColumn",
                    "attr": {
                        "name": 'DT_INI_FRM',
                        "class": "datepicker"
                    }
                }, {
                    //"targets": 8,
                    "title": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_code; ?>",
                    "data": 'COD_VAR',
                    "name": 'COD_VAR',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": false,
                    "className": "visibleColumn",
                }, {
                    //"targets": 9,
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_VAR',
                    "name": 'DT_INI_VAR',
                    "datatype": 'date',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": false,
                    "attr": {
                        "name": 'DT_INI_VAR',
                        "class": "datepicker"
                    }
                }, {
                    //"targets": 10,
                    "title": "<?php echo mb_strtoupper($ui_visible, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_visible; ?>", //Editor
                    "data": 'VISUALIZA',
                    "name": 'VISUALIZA',
                    "className": "none visibleColumn",
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": false,
                }, {
                    //"targets": 11,
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_variable, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_variable; ?>", //Editor
                    "data": 'LABEL',
                    "name": 'LABEL',
                    "className": "visibleColumn middle",
                    "style": "width: 1%",
                    "attr": {
                        "name": 'LABEL'
                    }
                }, {
                    //"targets": 12,
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_value, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_value; ?>",
                    "data": 'HTML_CONTENT',
                    "name": 'HTML_CONTENT',
                    "type": 'hidden', //Editor
                    "className": "visibleColumn noBorder-right middle",
                    "attr": {
                        "name": 'HTML_CONTENT'
                    },
                    "render": function (val, type, row) {
                        if (row['VALOR'] !== null) {
                            //console.log(val + ' -> ' + row['COD_VAR'] + ":" + row['VALOR']);
                            setTimeout(function () {
                                $('#' + row['COD_VAR']).val(row['VALOR']);
                            }, 200);
                        }
                        return val;
                    }
                }, {
                    //"targets": 13,
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_help, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_help; ?>",
                    "data": 'HTML_HINT',
                    "name": 'HTML_HINT',
                    "type": 'hidden', //Editor
                    "className": "none visibleColumn",
                    "attr": {
                        "name": 'HTML_HINT'
                    }
                }, {
                    //"targets": 14,
                    "title": "<?php echo mb_strtoupper($ui_value, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_value; ?>",
                    "data": 'VALOR',
                    "name": 'VALOR',
                    "className": "visibleColumn",
                    "type": "hidden",
                    "visible": false,
                    "attr": {
                        "name": 'VALOR',
                    }
                }, {
                    //"targets": 15,
                    "title": "<?php echo mb_strtoupper($ui_designation, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_designation; ?>",
                    "data": 'DSP_VALOR',
                    "name": 'DSP_VALOR',
                    "className": "visibleColumn",
                    "type": "hidden",
                    "visible": false,
                    "attr": {
                        "name": 'DSP_VALOR',
                    }
                }, {
                    //"targets": 16,
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
                    //"targets": 17,
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
                    //"targets": 18,
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
                    //"targets": 19,
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
                }
                /*
                 , {
                 //"targets": 19,
                 "responsivePriority": 1,
                 "data": null,
                 "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                 "name": 'BUTTONS',
                 "type": "hidden",
                 "width": "6%",
                 "className": "toBottom toCenter",
                 "render": function () {
                 //debugger;
                 //return rh_id_gd_variaveis.crudButtons(userAllowedCrud);
                 return rh_id_gd_variaveis.crudButtons(true, true, true);
                 }
                 }*/
            ],
            "createdRow": function (row, data, dataIndex) {
                //console.log('created row');
                setTimeout(function () {
                    var el = $(row).find('td:eq(2) > select.chosen');
                    if (el.length) {
                        $(el).val(data['VALOR']).chosen({width: "auto"});
                    }
                }, 10);

            },
            "rowCallback": function (row, data, dataIndex) {
                //console.log('rowcallback');
            },
            "drawCallback": function (settings) {
                //console.log('drawCallback' + $('#productionErrors_wrapper').length);
                //console.log('Settings._firstRun: ' + settings._firstRun);
            },
            "headerCallback": function (thead, data, start, end, display) {
                //console.log('header callback' + $('#productionErrors_wrapper').length);
            },
            "preDrawCallback": function (settings) {
                /* 1º evento a ser chamado logo na instânciação. Neste momento o HTML injetado pelo Datatables já se encontra disponível no DOM
                 * É depois também o 1º evento a ser chamado após cada scroll, na sucessão seguinte:
                 *  1. preDrawCallback
                 *  2. headerCallback
                 *  3. footerCallback
                 *  4. drawCallback
                 */

                /* On the first instance run we initialize the (new control variable) in order to control the "Loading..." ONLY ON THE FIRST RUN
                 if (settings._firstRun === undefined) {
                 settings._firstRun = 1;

                 /* Tornamos transparente a DIV (parent) onde será renderizada a instância */
                //$('#prodCtrl').css({opacity: '0.0'});

                /* Tornamos transparente a DIV onde será renderizada a instância */
                //$('#productionErrors_wrapper').css({opacity: 0.0});
                //}
            },
            "initComplete": function (settings) {
                /* Último evento a correr, uma única vez por instância, na 1ª corrida para dados a renderizar...
                 * A sucessão de eventos é a seguinte na 1ª corrida:
                 *  1. preDrawCallback
                 *  2. preDrawCallback
                 *  3. headerCallback
                 *  4. footerCallback
                 *  5. drawCallback
                 *  6. initComplete
                 */
                /*
                 setTimeout(function () {
                 $(".chosen").chosen();
                 console.log('Chosen runned..')
                 }, 10);


                 setTimeout(function () {
                 $('#prodCtrl').css({
                 opacity: '0.0',
                 }).delay(90).animate({
                 opacity: '1.0'
                 }, 0);

                 $('#productionErrors_wrapper').css({
                 opacity: '0.0',
                 }).delay(90).animate({
                 opacity: '1.0'
                 }, 0);

                 //$('#productionErrors_wrapper').css({opacity: 0.0})
                 $('#hPro').css({display: 'none'});
                 }, 100);
                 settings._firstRun = 0;
                 */
                /*
                 console.log('Finish initComplete');
                 //Era necessário Ajustar a vista (2x)!?
                 //No 1º scroll down a tabela "desaparecia"...
                 $('#productionErrors').DataTable().columns.adjust().responsive.recalc();
                 $('#productionErrors').DataTable().columns.adjust().responsive.recalc();
                 */
            },
            "footerCallback": function (settings) {
                //console.log('footerCallback...');
                //setTimeout(function () {
                //    $(".chosen").chosen({width: "auto"});
                //}, 10);
            }
        };
        rh_id_gd_variaveis = new QuadTable();
        rh_id_gd_variaveis.initTable($.extend({}, datatable_instance_defaults, optionRhid_Gd_Variaveis));
        //END Gestão Documental :: FORMULÁRIO (variáveis)

        //Gestão Documental :: DOCUMENTOS (rh_id_gd_docs)
        var optionRhid_Gd_Docs = {
            "tableId": 'rh_id_gd_docs',
            "order": false,
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_process; ?>",
            "table": "RH_ID_GD_DOCS",
            inRowDoc: {
                saveAsBlob: true,
                fileNameField: 'LINK_DOC',
                extField: 'BD_MIME',
                pathField: 'LINK_DOC',
                blobField: 'BD_DOC',
                savePath: 'tmp'
            },
            "pk": {
                "primary": {
                    "ID_PROC_GD": {"type": "number"},
                    "ID_DOC": {"type": "number"}
                }
            },
            "dependsOn": {
                "rhid_gestao_documental": {
                    //External object key mapping( object key : external key)
                    "ID_PROC_GD": "ID_PROC_GD"
                }
            },
            "order_by": "ID_DOC ASC",
            "recordBundle": 9999,
            "pageLenght": 9999,
            "scrollY": "270",
            "responsive": true,
            "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
            "tableCols": [
                {
                    //"targets": 0,
                    "responsivePriority": 1,
                    "data": null,
                    "width": "1%",
                    "className": "control toBottom toCenter",
                    "orderable": false,
                    "defaultContent": ''
                }, {
                    //"targets": 1,
                    "title": "<?php echo mb_strtoupper($ui_process, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_process; ?>", //Editor
                    "data": 'ID_PROC_GD',
                    "name": 'ID_PROC_GD',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": false,
                    "className": "visibleColumn",
                }, {
                    //"targets": 2,
                    "sTitle": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "title": "<?php echo $ui_code; ?>", //Available on Editor to replace label (quadTable.js line 632)
                    "label": "<?php echo $ui_code; ?>", //Editor :: Not available on Sequence label
                    "data": 'ID_DOC',
                    "name": 'ID_DOC',
                    //"datatype": 'sequence',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": false,
                    "className": "visibleColumn",
                }, {
                    //"targets": 3,
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'REF_DOC', //Referência da FASE em que se encontra o processo
                    "name": 'REF_DOC', //Referência da FASE em que se encontra o processo
                    "type": "hidden",
                    "visible": false
                }, {
                    //"targets": 4,
                    "responsivePriority": 2,
                    "title": "<?php echo mb_strtoupper($ui_phase, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_phase; ?>",
                    "data": 'DSP_FASE',
                    "name": 'DSP_FASE',
                    "type": "select",
                    "className": "visibleColumn",
                    "complexList": true,
                    "attr": {
                        "dependent-group": "FASES_GD",
                        "dependent-level": 1,
                        "data-db-name": 'A.VALUE',
                        "distribute-value": "REF_DOC", // Usado só quando os atributos destino têm nomes de colunas diferentes da tabela fonte
                        "decodeFromTable": 'DG_FASES_GD_VW A',
                        "class": "form-control complexList chosen",
                        "desigColumn": "A.LABEL",
                        "whereClause": "",
                        "orderBy": 'A.VALUE',
                    },
                    "render": function (val, type, row) {
                        if (row['GD_DOC_RESP(ID_PROC_GD,REF_DOC)'] == '' || row['GD_DOC_RESP(ID_PROC_GD,REF_DOC)'] === null || !row['GD_DOC_RESP(ID_PROC_GD,REF_DOC)']) {
                            return row['DSP_FASE'];
                        } else {
                            return row['DSP_FASE']+" (" + row['GD_DOC_RESP(ID_PROC_GD,REF_DOC)'] + ")";
                        }
                    }
                }, {
                    "data": "GD_DOC_RESP(ID_PROC_GD,REF_DOC)",
                    "name": "GD_DOC_RESP(ID_PROC_GD,REF_DOC)",
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    //"targets": 5,
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'RHID',
                    "name": 'RHID',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": false,
/*                    }, {
                    //"targets": 6,
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_rhid, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_rhid; ?>",
                    "data": 'NOME',
                    "name": 'NOME',
                    "type": "select",
                    "className": "visibleColumn",
                    "complexList": true,
                    "attr": {
                        "dependent-group": "PEOPLE",
                        "dependent-level": 1,
                        "data-db-name": 'A.RHID',
                        "decodeFromTable": 'QUAD_NAMES A',
                        "class": "form-control complexList chosen",
                        "desigColumn": "CONCAT(CONCAT(A.RHID,'-'),A.NOME_REDZ)",
                        "whereClause": "",
                        "orderBy": 'A.RHID',
                        "filter": {
                            "create": " AND (A.RHID) IN (SELECT F.RHID FROM QUAD_PEOPLE F WHERE F.ATIVO = 'S')", //On-New-Record
                            "edit": " AND (A.RHID) IN (SELECT F.RHID FROM QUAD_PEOPLE F WHERE F.ATIVO = 'S')", //On-Edit-Record
                        }
                    }
*/
                }, {
                    //"targets": 7,
                    "title": "<?php echo mb_strtoupper($ui_day, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_day; ?>", //Editor
                    "data": 'DT_REF_DOC',
                    "name": 'DT_REF_DOC',
                    "datatype": 'date',
                    "className": "visibleColumn",
                    "attr": {
                        "name": 'DT_REF_DOC',
                        "class": "datepicker"
                    }
                }, {
                    //"targets": 8,
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
                    //"targets": 9,
                    "title": "<?php echo mb_strtoupper($ui_extention, 'UTF-8'); ?>" + '</span>', //Datatables
                    "label": "<?php echo $ui_extention; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_file_format; ?>",
                    "data": 'BD_MIME',
                    "name": 'BD_MIME',
                    "className": "none visibleColumn",
                    "type": "hidden",
                    "attr": {
                        "name": 'BD_MIME',
                        "style": "width: 20%;",
                    }
                }, {
                    //"targets": 10,
                    "title": "<?php echo mb_strtoupper($ui_document, 'UTF-8') .' / ' . mb_strtoupper($ui_decision, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_document.' / ' .$ui_decision; ?>", //Editor
                    "data": 'LINK_DOC',
                    "name": 'LINK_DOC',
                    "className": "visibleColumn",
                    "type": "hidden",
                    "attr": {
                        "name": 'LINK_DOC'
                    },
                    "render": function (val, type, row) {
                        try {
                            if (row['BD_MIME'] !== null) { //FICHEIRO
                                // FASES relevantes
                                // F - Assinatura Colaborador
                                // G - Assinatura Gestor Adm.
                                // H - Assinatura Supervisor
                                // I - Assinatura Diretor
                                // J - Assinat. Gestor
                                //
                                //do_not_enter_ = '<i class="fas fa-do-not-enter" style="font-size: 30px;color: tomato;opacity: 0.8;"></i>';
                                do_not_enter_ = '<span title="<?php echo $ui_rgpd_disabled;?>"><i class="far fa-eye-slash rgpd-30"></i></span>';
                                if (perfil_ == 'A') {  // Colaborador só vê documentos Assinat. Colaborador e Aprovado
                                    if (row['REF_DOC'] === 'F' && (row['RHID'] === null || row['RHID'] === "<?php echo @$_SESSION['rhid'];?>")) {
                                        return rh_id_gd_docs.getFileIcon(row['BD_MIME'], JSON.stringify(row));
                                    } else {
                                        return do_not_enter_;
                                    }
                                } else if (perfil_ == 'B') { // Gestor Administrativo
                                    if (row['REF_DOC'] === 'G' && (row['RHID'] === null || row['RHID'] === "<?php echo @$_SESSION['rhid'];?>")) {
                                        return rh_id_gd_docs.getFileIcon(row['BD_MIME'], JSON.stringify(row));
                                    } else {
                                        return do_not_enter_;
                                    }
                                } else if (perfil_ == 'C') { // Supervisor
                                    if (row['REF_DOC'] === 'H' && (row['RHID'] === null || row['RHID'] === "<?php echo @$_SESSION['rhid'];?>")) {
                                        return rh_id_gd_docs.getFileIcon(row['BD_MIME'], JSON.stringify(row));
                                    } else {
                                        return do_not_enter_;
                                    }
                                } else if (perfil_ == 'D') { // Director
                                    if (row['REF_DOC'] === 'I' && (row['RHID'] === null || row['RHID'] === "<?php echo @$_SESSION['rhid'];?>")) {
                                        return rh_id_gd_docs.getFileIcon(row['BD_MIME'], JSON.stringify(row));
                                    } else {
                                        return do_not_enter_;
                                    }
                                } else if (perfil_ == 'E' && (row['RHID'] === null || row['RHID'] === "<?php echo @$_SESSION['rhid'];?>")) { // Gestor
                                    return rh_id_gd_docs.getFileIcon(row['BD_MIME'], JSON.stringify(row));
                                } else if (perfil_ == 'F' && (row['RHID'] === null || row['RHID'] === "<?php echo @$_SESSION['rhid'];?>")) { // Dep.RH
                                    return rh_id_gd_docs.getFileIcon(row['BD_MIME'], JSON.stringify(row));
                                }

                                return do_not_enter_;
                            } else { //APROVAÇÕES / REJEIÇÕES
                                //REF_DOC
                                //console.log( rh_id_gd_docs.tbl.row().data() );
                                var htm = '', status = '';
                                //Todas as fases, ATÉ ONDE SE INCLUEM VALIDAÇÕES OU APROVAÇÕES
                                if ((row['REF_DOC'] >= 'B' && row['REF_DOC'] <= 'E') || //Validações
                                    (row['REF_DOC'] >= 'K' && row['REF_DOC'] <= 'N')) {// Aprovações
                                    if (rhid_gestao_documental.tbl.row('#row_' + row['ID_PROC_GD']).data()['FASE'] > row['REF_DOC']) {
                                        status = 'disabled';
                                        htm = '<a href="javascript:void(0);" ' + status + ' data-masterKey="' + row['ID_PROC_GD'] + '" class="btn btn-default btn-circle gd-approve"><i class="glyphicon glyphicon-ok"></i></a>';
                                    } else {
                                        status = 'enabled';
                                        /*  PERFIL VS FASES tunning
                                         *  PERFIS                               Fases Válidas para interações
                                                'A' Colaborador
                                                'B' Gestor Administrativo           B, G, K
                                                'C' Supervisor                      C, H, L
                                                'D' Diretor                         D, I, M
                                                'E' Gestor                          E, N
                                                'Z' Administrador                   E, N

                                            FASES:
                                                A Elaboração
                                                B Validação Gestor Adm.
                                                C Validação Supervisor
                                                D Validação Diretor
                                                E Validação Gestor
                                                F Assinatura Colaborador
                                                G Assinatura Gestor Adm.
                                                H Assinatura Supervisor
                                                I Assinatura Diretor
                                                J Assinatura DRH
                                                K Aprovação Gestor Adm.
                                                L Aprovação Supervisor
                                                M Aprovação Diretor
                                                N Aprovação Gestor
                                                O Aprovado
                                                P Rejeitado
                                                Z Cancelado
                                        */
//console.log('perfil'+perfil_+" row REF_DOC:"+row['REF_DOC']);
                                        if (perfil_ === 'B' && (row['REF_DOC'] === 'B' || row['REF_DOC'] === 'K') && (row['RHID'] === null || row['RHID'] === "<?php echo @$_SESSION['rhid'];?>") ) {
                                            status = 'enabled';
                                        }
                                        else if (perfil_ === 'C' && (row['REF_DOC'] === 'C' || row['REF_DOC'] === 'L') && (row['RHID'] === null || row['RHID'] === "<?php echo @$_SESSION['rhid'];?>") ) {
                                            status = 'enabled';
                                        }
                                        else if (perfil_ === 'D' && (row['REF_DOC'] === 'D' || row['REF_DOC'] === 'M') && (row['RHID'] === null || row['RHID'] === "<?php echo @$_SESSION['rhid'];?>") ) {
                                            status = 'enabled';
                                        }
                                        else if ( (perfil_ === 'E'|| perfil_ === 'Z') && (row['REF_DOC'] === 'E' || row['REF_DOC'] === 'N')  && (row['RHID'] === null || row['RHID'] === "<?php echo @$_SESSION['rhid'];?>") ) {
                                            status = 'enabled';
                                        }
                                        else {
                                            status = 'disabled';
                                        }
                                        //console.log('Sou perfil ' + perfil_ + ' e esta linha pertence à fase ' + row['REF_DOC']);
                                        htm = '<a href="javascript:void(0);" ' + status + ' data-masterKey="' + row['ID_PROC_GD'] + '" class="btn btn-danger btn-circle gd-reject"><i class="glyphicon glyphicon-remove"></i></a> ' +
                                              '<a href="javascript:void(0);" ' + status + ' data-masterKey="' + row['ID_PROC_GD'] + '" class="btn btn-success btn-circle gd-approve"><i class="glyphicon glyphicon-ok"></i></a>';
                                    }
                                    return htm;// val;
                                } else {
                                    return '';
                                }
                            }
                       } catch (e) {
                            return null;
                       }
                    }
                }, {
                    //"targets": 11,
                    "title": 'BD_DOC',
                    "data": null,
                    "name": 'BD_DOC',
                    "type": "upload",
                    "visible": false
                }, {
                    //"targets": 12,
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
                    //"targets": 13,
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
                    //"targets": 14,
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
                    //"targets": 15,
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
                    //"targets": 16,
                    "responsivePriority": 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function (val, type, row) {
                        //return rh_id_gd_docs.crudButtons(userAllowedCrud);
                       try {
                            var btns = rh_id_gd_docs.crudButtons(false, true, false);
                            var faseMaster = rhid_gestao_documental.tbl.row( '.selected' ).data()['FASE'],
                                faseRow = row['REF_DOC'];

                            if (faseRow === faseMaster) {
                                return btns;
                            } else {
                                return null;
                            }
                       } catch (e) {
                            return null;
                       }
                    }
                }
            ]
        };
        rh_id_gd_docs = new QuadTable();
        rh_id_gd_docs.initTable($.extend({}, datatable_instance_defaults, optionRhid_Gd_Docs));

        //"FORMULARIO" FOLDER INTERACTIONS EVENTS
        if (1 === 1) {
            //Reads Master RECORD FASE and MANAGES FORMULARIO INTERACTIONS (enabling or disabling entire FORM)
            function updateFormulario () {
                var fase = rhid_gestao_documental.tbl.rows( '.selected' ).data()[0]['FASE'];

                if (fase === 'A') {
                    $('.form-actions').css('display','block').show('slow');
                    setTimeout( function () {
                         $('input,select,textarea','#rh_id_gd_variaveis').trigger('change').trigger("chosen:updated");
                    }, 800)
                } else {
                    setTimeout( function () {
                         $('input,select,textarea','#rh_id_gd_variaveis').prop('readonly', true).prop('disabled', true).trigger("chosen:updated");
                    }, 300)

                    $("#varsForm :input,select,textarea").prop('readonly', true);
                    $('.form-actions').css('display','none');
                }
            }

            /* CONTROLADOR Específico de rh_id_gd_variaveis:: permite validar e gravar os inputs nas variáveis do documento */
            $('#varsForm').on('click', '#saveDetails', function (e) {
                var masterKey = '', matches = $('#rh_id_gd_variaveis tbody > tr > td :input.gd_var'),
                        dados = [], col = {}, name, val, str = '';
                try {
                    //On a DETAIL INSTANCE, get's the MASTER PRIMARY KEY!!!
                    masterKey = $('#rhid_gestao_documental_info > span.select-info > span.goEye > i').attr('data-rowid').replace("row_", "");
                    //masterInstancia.tbl.rows({selected: true}).data()

                    if (masterKey) {
                        col = JSON.parse('{"key" : ' + masterKey + '}');
                        dados.push(col);
                        //var t0 = performance.now();
                        var step_ = '';
                        for (var i = 0; i < matches.length; i++) {
                            var el = $(matches[i]), dsp = '';
                            name = el.attr('id');
                            val = $(matches[i]).val();
                            //$(matches[i]) vs el
                            if (name) {
                                step_ = '1';
                                if (el[0].tagName.toUpperCase() === 'SELECT') {
                                    if (el[0].selectedIndex === -1) { //NO OPTION selected by user
                                        val = '';
                                    } else {
                                        val = val + '|@|' + el[0].options[el[0].selectedIndex].text;
                                    }
                                }
                                if (val === null) { //Se o valor returnar null...
                                    val = '';
                                }
                                if (str.length === 0) {
                                    str += '{"' + name + '": "' + val + '"';
                                } else {
                                    str += ', "' + name + '": "' + val + '"';
                                }
                            }
                        }
                        if (str !== '') {
                            str += '}';
                        } else {
                            str = '{}';
                        }
                        col = JSON.parse(str);
                        dados.push(col);
                        //console.log(dados);

                        /* Save USER answers to the DATABASE */
                        $.ajax({
                            type: "POST",
                            url: window.location.pathname.replace("home.php", "") + "data-source/gd_formulario_controller.php",
                            data: 'request_data=' + JSON.stringify(dados),
                            cache: false,
                            async: false,
                            success: function (res) {
                                try {
                                    var nrErrors, rst = JSON.parse(res);

                                    /* FORM with ERRORS */
                                    if (rst['formErrors'].length) {
                                        var htm = '';
                                        //Display FORM ERROR MESSAGES box
                                        $('#formError').css({"display": "block"}).fadeIn("slow");

                                        //Signal FORM error messages
                                        $('#formMsg').html('');
                                        for (var i = 0; i < rst['formErrors'].length; i++) {
                                            if (i === rst['formErrors'].length) { //Just ONE FORM ERROR
                                                $('#formMsg').append(rst['formErrors'][i]['msg']);
                                                cnt = 0;
                                            } else {
                                                htm += '<li> ' + rst['formErrors'][i]['msg'] + '</li>';
                                            }
                                        }
                                        if (htm !== '') {
                                            $('#formMsg').append('<ol> ' + htm + '</ol>');
                                        }
                                    }
                                    /* ROWS with ERRORS */
                                    if (rst['rowErrors'].length) {
                                        var rw, ms, col;
                                        $('#lineError').css({"display": "block"}).fadeIn("slow"); //Display LINE ERROR MESSAGES box

                                        //Personalize error message identifying the number of errors detected on the form submition
                                        ms = "<?php echo $ui_doc_management_form_erros; ?>";
                                        $('#lineMsg').html(ms.replace('{0}', rst['rowErrors'].length));

                                        //Loop trought array of ERRORs and NOTIFY each on QuadTables Instance corresponding row.
                                        //EX: rst => {"error":[{"seq":"336","msg":"Valor não indicado"},{"seq":"337","msg":"Valor não indicado"}]}
                                        for (var i = 0; i < rst['rowErrors'].length; i++) {
                                            //console.log('ERROR ID = ' + rst['error'][i]['seq']);
                                            rw = $('table#rh_id_gd_variaveis > tbody > tr#row_' + rst['rowErrors'][i]['seq']); //Identifies QuadTables ROW with Error
                                            rw.css({"background-color": "rgb(255,225,225)!important", "color": "#675100!important"}); //CSS on that ROW
                                            col = rw.find('td:nth-child(2)'); //Identify the "LABEL" (2tn) column to notify ERROR MESSAGE
                                            col.html('<span rel="tooltip" data-placement="right" class="notifyThis" data-original-title="' + rst['rowErrors'][i]['msg'] + '">' + col.text() + '</span>'); //Transform column to signal ERROR msg as a TOOLTIP
                                            $("[rel=tooltip]").tooltip(); //Activate tootip plugin
                                        }
                                        var rows = $('table#rh_id_gd_variaveis > tbody > tr');
                                        rows.each(function () {
                                            var el = $(this).attr('id'),
                                                rw = el.replace('row_', '');
                                            console.log(rw);
                                        });
                                    }

                                } catch (e) {
                                    if (rst.msg) { //SUCESS OPERATION: arrives here because rst doesn't have rst['formErrors'] neither rst['rowErrors']
                                        //Como resultado de uma submissão bem sucedida o controlador atualizou (entre outras operações) a Fase no Master.
                                        var newStatusDsp = '', newStatusVal = '';
                                        try {
                                            newStatusDsp = rst.newMasterStatus.label;
                                            newStatusVal = rst.newMasterStatus.value;
                                            // ----------------------------------------------------------------------------------------------------
                                            // ATENÇÃO: rhid_gestao_documental.tbl.data() :: Devolve TODAS as ROWS do MASTER e respetivos métodos
                                            // ----------------------------------------------------------------------------------------------------
                                            //Atualizamos o valor da coluna de dados FASE, na MEMÓRIA, de modo a que a EDIÇÃO reflita o novo valor,
                                            //sem necessidade de refrescarmos TODO o registo MASTER comm mais uma roundtrip à base de dados.
                                            rhid_gestao_documental.tbl.row('#row_' + masterKey).data()['FASE'] = newStatusVal;

                                            //Atualizamos a FASE no registo MASTER respetivo no DOM
                                            $('table#rhid_gestao_documental > tbody > tr#row_' + masterKey + ' > td:nth-child(8)').html(newStatusDsp);

                                            //Aqui só ajustamos a tabela master de acordo com o novo conteúdo
                                            $('#rhid_gestao_documental').DataTable().columns.adjust().responsive.recalc();

                                            var el = rhid_gestao_documental.tbl.rows('.selected');
                                            //Deselect current ROW (already updated on server)
                                            el.deselect();

                                            //Select current ROW (to refresh detail results)
                                            el.select();

                                            updateFormulario();

                                        } catch (e) {
                                            null;
                                        }

//Refresh DATA WHEN NO ERRORS RETURNED (to retrived automatic variables)
//$('#refresh_rh_id_gd_variaveis').click();

                                        quad_notification_clear();
                                        quad_notification({
                                            type: "success",
                                            title : JS_OPERATION_COMPLETED,
                                            content: '<i class="fa fa-clock-o"></i>&nbsp;<i>' + rst.msg + '</i>',
                                            timeout : 3500
                                        });
                                    } else {
                                        $.SmartMessageBox({
                                            title: '<i class="fa fa-times" style="color:#ED1C24"></i>&nbsp;' + JS_WARNING,
                                            content: res,
                                            buttons: '[' + "<?php echo $ui_close; ?>" + ']'
                                        });
                                    }
                                }
                            }
                        });

                    }
                } catch (ex) {
                    console.log('Master record must be selected first!');
                }
                return false;
            });

            /* Events ON PROCESSOS instance for: SELECT / DESELECT ROW */
            // NOTE: Assertive way to lunch events BEFORE DOM availability
            $(document).on('click', '#rhid_gestao_documental > tbody', function (ev) {
                ev.stopImmediatePropagation();
                $('#formError').css({"display": "none"});
                $('#lineError').css({"display": "none"});

                if (rhid_gestao_documental.tbl.rows( '.selected' ).any()){ //ROW on MASTER IS SELECTED
                    updateFormulario(); //FORMULÁRIO CONTROL
                } else {  //DESELECT ROW EVENT
                    $('.form-actions').css('display','none'); //ROW on MASTER WAS DESELECTED :: Hide formulario SUBMIT button
                }
            });

        }

        //"DOCUMENTOS" FOLDER INTERACTIONS EVENTS
        if (1 === 1) {
            $(document).on('click', '.gd-approve', function (ev) {
                ev.stopImmediatePropagation();
                var resp = '';
                if ($(this).attr('enabled') !== undefined) {
                    resp = decisionToServer($(this).attr('data-masterKey'), 'aprovado'); //Approved
                }
            });
            $(document).on('click', '.gd-reject', function (ev) {
                ev.stopImmediatePropagation();
                var resp = '';
                if ($(this).attr('enabled') !== undefined) {
                    resp = decisionToServer($(this).attr('data-masterKey'), 'rejeitado');  //Rejected
                }
            });
            //Send DOCUMENT FOLDER INTERACTIONS to SERVER
            function decisionToServer(masterKey, decision) {
                /* Save USER Approval (decision=aprovado) or Rejection (decision=rejeitado) to the DATABASE */
                var el = rhid_gestao_documental.tbl.rows('.selected');
                el.deselect();
                $.ajax({
                    type: "POST",
                    url: window.location.pathname.replace("home.php", "") + "data-source/gd_formulario_controller.php",
                    data: 'action=' + decision + '&id_proc_gd=' + masterKey,
                    cache: false,
                    async: false,
                    success: function (res) {
                        try {
                            var rst = JSON.parse(res);
                            var x = 'action=' + decision + '&id_proc_gd=' + masterKey;
                            // Operation with ERRORS
                            if (rst['error'].length) {
                                quad_notification_clear();
                                quad_notification({
                                    type: "warning",
                                    title : JS_WARNING,
                                    content: '<i class="fa fa-clock-o"></i>&nbsp;<i>' + rst.error + '</i>',
                                });
                            } else {
                                //Refresh MASTER DATA WHEN NO ERRORS RETURNED (to retrive new process condition)
                                if (rst.msg) { //SUCESS OPERATION: arrives here because rst doesn't have rst['formErrors'] neither rst['rowErrors']
                                    //Como resultado de uma submissão bem sucedida o controlador atualizou (entre outras operações) a Fase no Master.
                                    var newStatusDsp = '', newStatusVal = '';
                                    try {
                                        newStatusDsp = rst.newMasterStatus.label;
                                        newStatusVal = rst.newMasterStatus.value;
                                        // ----------------------------------------------------------------------------------------------------
                                        // ATENÇÃO: rhid_gestao_documental.tbl.data() :: Devolve TODAS as ROWS do MASTER e respetivos métodos
                                        // ----------------------------------------------------------------------------------------------------
                                        //Atualizamos o valor da coluna de dados FASE, na MEMÓRIA, de modo a que a EDIÇÃO reflita o novo valor,
                                        //sem necessidade de refrescarmos TODO o registo MASTER comm mais uma roundtrip à base de dados.
                                        rhid_gestao_documental.tbl.row('#row_' + masterKey).data()['FASE'] = newStatusVal;

                                        //Atualizamos a FASE no registo MASTER respetivo no DOM
                                        $('table#rhid_gestao_documental > tbody > tr#row_' + masterKey + ' > td:nth-child(8)').html(newStatusDsp);

                                        //Aqui só ajustamos a tabela master de acordo com o novo conteúdo
                                        $('#rhid_gestao_documental').DataTable().columns.adjust().responsive.recalc();

                                        //Refresh DATA RECORD WHEN NO ERRORS RETURNED (to retrived automatic variables)
                                        el.select();

                                    } catch (e) {
                                        null;
                                    }

                                    quad_notification_clear();
                                    quad_notification({
                                        type: "success",
                                        title : JS_OPERATION_COMPLETED,
                                        content: '<i class="fa fa-clock-o"></i>&nbsp;<i>' + rst.msg + '</i>',
                                        timeout: 3500
                                    });
                                } else {
                                    $.SmartMessageBox({
                                        title: '<i class="fa fa-times" style="color:#ED1C24"></i>&nbsp;' + JS_WARNING,
                                        content: res,
                                        buttons: '[' + "<?php echo $ui_close; ?>" + ']'
                                    });
                                }
                            }

                        } catch (e) {
                            $.SmartMessageBox({
                                title: '<i class="fa fa-times" style="color:#ED1C24"></i>&nbsp;' + JS_WARNING,
                                content: e,
                                buttons: '[' + "<?php echo $ui_close; ?>" + ']'
                            });
                        }
                    }
                });
            }

            //EDITOR EVENTS EXTENTION
            $(document).on('rh_id_gd_docsAttachEvt', function (e) {
                var operacao = rh_id_gd_docs.editor.s["action"],
                    keyMaster = rhid_gestao_documental.tbl.row('.selected').data()['ID_PROC_GD'],
                    faseMaster = rhid_gestao_documental.tbl.row('.selected').data()['FASE'],
                    faseRow = rh_id_gd_docs.tbl.row('.selected').data()['REF_DOC']; //ROW could be deselected

                //PMA 2020-01-32 :: Impedir alteração indevida da fase
                if (operacao !== 'query') {
                    $('#DTE_Field_DSP_FASE').attr('disabled', 'disabled').trigger('chosen:updated');
                }

                //Pode carregar documentos ?
                if (faseRow >= 'F' && faseRow <= 'J') {
                    if (faseRow >= faseMaster) {
                        null; //Pode carregar Documentos
                    } else {
                        setTimeout(function () {
                            $('#rh_id_gd_docs_editorForm > div > a').css('display', 'none');
                            $('#rh_id_gd_docs_editorForm .upload').css('display', 'none');
                        }, 100);
                    }
                } else { //Não pode carregar Documentos
                    setTimeout(function () {
                        $('#rh_id_gd_docs_editorForm > div > a').css('display', 'none');
                        $('#rh_id_gd_docs_editorForm .upload').css('display', 'none');
                    }, 100);
                }
            });

            //SAVE ON EDITOR EXTENTION
            $(document).on('rh_id_gd_docsAttachEvtClose', function (e) {
                var keyMaster = rhid_gestao_documental.tbl.row('.selected').data()['ID_PROC_GD'],
                    faseMaster = rhid_gestao_documental.tbl.row('.selected').data()['FASE'],
                    faseRow = rh_id_gd_docs.tbl.row('.selected').data()['REF_DOC']; //ROW could be deselected

                if (faseRow >= 'F' && faseRow <= 'J') { //Pode carregar Documentos
                    //Ao submeter o novo documento pelo controlador "normal" nos details (rh_id_gd_docs) que também atualiza o master (rhid_gestao_documental) deverá então..
                    //REFRESH MASTER RECORD
                    var sql="SELECT ID_PROC_GD, TO_CHAR(DT_INI,'YYYY-MM-DD') DT_INI, CD_GD , TO_CHAR(DT_INI_GD,'YYYY-MM-DD') DT_INI_GD, CD_DET_GD, TO_CHAR(DT_INI_DET_GD,'YYYY-MM-DD') DT_INI_DET_GD, EMPRESA, RHID, TO_CHAR(DT_ADMISSAO,'YYYY-MM-DD') DT_ADMISSAO, FASE, TO_CHAR(DT_FIM,'YYYY-MM-DD') DT_FIM, REF_INTERNA, OBS, INSERTED_BY, TO_CHAR(DT_INSERTED,'YYYY-MM-DD HH24:MI:SS') DT_INSERTED, CHANGED_BY, TO_CHAR(DT_UPDATED,'YYYY-MM-DD HH24:MI:SS') DT_UPDATED FROM RH_ID_GESTAO_DOCUMENTAL WHERE ID_PROC_GD = "+ keyMaster;
                    $.post(window.location.origin + datatable_instance_defaults.pathToSqlFile + 'returnSqlRes.php',{
                            sql:{sql:  sql}
                        },function (data) {
                            var rowData=JSON.parse(data)['sql'];
                            rowData=rhid_gestao_documental.normalizeData(rowData[0]);
                            rowData=rhid_gestao_documental.fixData(rowData);
                            rhid_gestao_documental.tbl.row('#row_' + keyMaster).data(rowData.data[0]);

                            var el = rhid_gestao_documental.tbl.rows('.selected');
                            //Deselect current ROW (already updated on server)
                            el.deselect();

                            //Select current ROW (to refresh detail results)
                            el.select();
                        });

                }
            });
        }

        /* EXPERIENCES :: MODAL CODE */
        if (1 === 0) {

            /* Formulário Change Event */
            $('#rh_id_gd_variaveis').on('change', function () {
                console.log('Form Change event...');
            });

            /* Formulário SELECT :: Change Event */
            $('form#varsForm select.gd_var').on('change', function () {
                console.log('Select Change event...');
            });


            //Show modal window
            $('#showEdition').on('click', function (evt) {
                evt.stopImmediatePropagation();
                var el = $('#myEditionTemplate');
                el.css('display', 'block');
            });

            //Save button
            $(document).on('click', '#btnSave', function (evt) {
                evt.stopImmediatePropagation();
                alert("The btn Save was clicked, and it modal it will be dismissed...");
                //$('#myEditionTemplate').modal('toggle');
                var el = $('#myEditionTemplate');
                el.css('display', 'none');
            });

            //Cancel button
            $(document).on('click', '#btnCancel', function (evt) {
                evt.stopImmediatePropagation();
                var el = $('#myEditionTemplate');
                el.css('display', 'none');
            });
        }
        /* END EXPERIENCES */
    });
</script>
