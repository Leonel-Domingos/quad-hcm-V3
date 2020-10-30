<?php
    require_once '../init.php';
?>
<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <span class="widget-icon"> <i class="fal fa-clone"></i></span>&nbsp;
                <h2><?php echo $ui_docs_management . " - " . $ui_macro_processes; ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">                                            
                    <a id="dg_gd_hdr_auto_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                    <table id="dg_gd_hdr_auto" class="table table-bordered table-hover table-striped w-100"></table>

                    <div id="panel-1" class="panel">
                        <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-end">
                            <div class="panel-toolbar pr-3 align-self-end tabs__">
                                <ul id="demo_panel-tabs" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#Tab1" role="tab" aria-selected="true"><?php echo $ui_renewals; ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#Tab2" role="tab" aria-selected="true"><?php echo $ui_form; ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#Tab3" role="tab" aria-selected="true"><?php echo $ui_scope; ?></a>
                                    </li>
                                </ul>
                            </div>
                        </div>   

                        <div class="panel-container show">
                            <div class="panel-content">
                                <div class="tab-content">

                                     <!-- TAB #1 -->
                                    <div class="tab-pane fade active show" id="Tab1" role="tabpanel">
                                        <a id="DG_GD_ID_AUTO_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                        <table id="DG_GD_ID_AUTO" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                    </div>
                                     <!-- END TAB #1 -->

                                     <!-- TAB #2 -->
                                    <div class="tab-pane fade" id="Tab2" role="tabpanel">
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
                                            <!--a id="dg_gd_det_auto_dtAdvancedSearch" style="display: none;"
                                               class="dtAdvancedSearch btn btn-sm btn-primary toRight" data-toggle="modal" href="#"
                                               data-target="#modalForm"><?php echo $ui_query; ?></a-->    
                                            <a id="dg_gd_det_auto_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                            <table id="dg_gd_det_auto" class="table responsive table-bordered table-striped table-hover nowrap"></table>

                                            <div class="form-actions" style="display: none;padding: 9px 14px 9px; border: 1px solid rgba(0,0,0,.1); background: rgba(249,249,249,.9); text-align: right; margin: 13px 0px -10px;">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <button id="saveMacroDetails" type="button" class="btn btn-sm btn-primary">
                                                            <i class="fa fa-hand-o-right"></i>
                                                            <?php echo $ui_save; ?>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>                            
                                        </form>                                      
                                    </div>
                                     <!-- END TAB #2 -->

                                     <!-- TAB #3 -->
                                    <div class="tab-pane fade" id="Tab3" role="tabpanel">
                                       <!-- FILTRO DE COLABORADORES -->
                                        <form id="QUAD_PEOPLE_1_filter" style="display:none;" class="smart-form show" novalidate="novalidate">
                                            <div class="form-row">
                                                <!-- regulamentado pela empresa do registo master - ver trigger de seleção do registo master -->
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label" for="xt_DESIGEMPRESA"><?php echo $ui_company; ?></label>
                                                    <select name="DESIGEMPRESA" id="xt_DESIGEMPRESA" 
                                                            class="form-control complexList" dependent-group="EMPRESA"
                                                            dependent-level="1" data-db-name="EMPRESA" decodefromtable="dg_empresas"
                                                            desigcolumn="EMPRESA" orderby="NR_ORDEM">                                             
                                                    </select>                         
                                                </div>

                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label" for="xt_DSP_ESTAB"><?php echo $ui_establishment; ?></label>
                                                    <select name="DSP_ESTAB" id="xt_DSP_ESTAB" 
                                                            class="form-control complexList" dependent-group="EMPRESA"
                                                            dependent-level="2" data-db-name="EMPRESA@CD_ESTAB" decodefromtable="dg_estabelecimentos"
                                                            desigcolumn="DSP_ESTAB" orderby="EMPRESA,CD_ESTAB">                                             
                                                    </select>
                                                </div>

                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label" for="xt_DSP_SETOR"><?php echo $ui_sector; ?></label>
                                                    <select name="DSP_SETOR" id="xt_DSP_SETOR" 
                                                            class="form-control complexList" dependent-group="EMPRESA"
                                                            dependent-level="3" data-db-name="EMPRESA@CD_ESTAB@ID_SETOR" decodefromtable="dg_setores"
                                                            desigcolumn="CONCAT(CONCAT(ID_SETOR,'-'),DSP_SETOR)" orderby="EMPRESA,CD_ESTAB,ID_SETOR">                                             
                                                    </select>
                                                </div>

                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label" for="xt_DSP_VINCULO"><?php echo $ui_contractual_bond; ?></label>
                                                    <select name="DSP_VINCULO" id="xt_DSP_VINCULO" 
                                                            class="form-control complexList" dependent-group="VINCULO"
                                                            dependent-level="1" data-db-name="CD_VINCULO" decodefromtable="rh_def_vinculos_contratuais"
                                                            desigcolumn="DSP_VINCULO" orderby="CD_VINCULO">                                             
                                                    </select>
                                                </div>

                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label" for="xt_DSP_DIRECAO"><?php echo $ui_direction; ?></label>
                                                    <select name="DSP_DIRECAO" id="xt_DSP_DIRECAO" 
                                                            class="form-control complexList" dependent-group="EMPRESA"
                                                            dependent-level="2" data-db-name="EMPRESA@CD_DIRECAO@DT_INI_DIRECAO" decodefromtable="dg_direcoes"
                                                            desigcolumn="CONCAT(CONCAT(CD_DIRECAO,'-'),DSP_DIRECAO)" orderby="EMPRESA,CD_DIRECAO">                                             
                                                    </select>
                                                </div>

                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label" for="xt_DSP_DEPT"><?php echo $ui_department; ?></label>
                                                    <select name="DSP_DEPT" id="xt_DSP_DEPT" 
                                                            class="form-control complexList" dependent-group="EMPRESA"
                                                            dependent-level="3" data-db-name="EMPRESA@CD_DIRECAO@DT_INI_DIRECAO@CD_DEPT" decodefromtable="dg_departamentos"
                                                            desigcolumn="CONCAT(CONCAT(CD_DEPT,'-'),DSP_DEPT)" orderby="EMPRESA,CD_DIRECAO,CD_DEPT">                                             
                                                    </select>
                                                </div>

                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label" for="xt_DT_FIM_VINCULO"><?php echo $ui_end_date; ?></label>
                                                    <input name="DT_FIM_VINCULO" class="form-control datepicker">
                                                </div>

                                                <div class="col-md-3 mb-3">
                                                    <label class="form-label" for="xt_NR_RENOV"><?php echo $ui_renewals_number; ?></label>
                                                    <input name="NR_RENOV" id="xt_NR_RENOV" class="form-control" style="width:30%">
                                                </div>

                                                <div class="col-md-3 mb-3">
                                                    <label class="form-label" for="xt_NR_DIAS"><?php echo $ui_days; ?></label>
                                                    <input name="NR_DIAS" id="xt_NR_DIAS" class="form-control" style="width:30%">
                                                </div>
                                            </div>
                                        </form>
                                        
                                        <a id="QUAD_PEOPLE_1_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                        <table id="QUAD_PEOPLE_1" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                        <div class="form-actions" style="display: block;padding: 9px 14px 9px; border: 1px solid rgba(0,0,0,.1); background: rgba(249,249,249,.9); text-align: right; margin: 13px 0px -10px;">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <button id="gd_gerar_docs_async" type="button" class="btn btn-sm btn-primary">
                                                        <i class="fa fa-hand-o-right"></i>
                                                        <?php echo $ui_generate; ?>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>                                                                                       
                                    </div>
                                     <!-- END TAB #3 -->

                                </div>                    
                            </div>                    

                        </div> 
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

        // função que controla os tabs de acordo com o registo master seleecionado 
        var controlaTabs = function (select, renov, terminado) {
            // is row selected ?
            if (select === 'S'){
                if (renov === 'S') { 
                    // mostra tab de Renovações
                    $("#t0").css('display','block');
                    $('[href="#Tab1"]').tab('show');

                    // esconde tab de Âmbito
                    $("#t2").css('display','none');
                } else {
                    // mostra tab de Formulário
                    $("#t1").css('display','block');
                    $('[href="#Tab2"]').tab('show');

                    if (terminado === 'S') {
                        // esconde tab de Ambito
                        $("#t2").css('display','none');
                    } else {    
                        // mostra tab de Ambito
                        $("#t2").css('display','block');
                    }

                    // esconde tab de Renovações
                    $("#t0").css('display','none');
                }
            } 
            else {

                // mostra tab de Formulário
                $("#t1").css('display','block');
                $('[href="#Tab2"]').tab('show');

                if (terminado === 'S') {
                    // esconde tab de Ambito
                    $("#t2").css('display','none');
                } else {    
                    // mostra tab de Ambito
                    $("#t2").css('display','block');
                }

                // esconde tab de Renovações
                $("#t0").css('display','none');

            }    
        }
        
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
        var whereClause_ = " ATIVO = 'S' ";
        var insert_ = true, update_ = true, delete_ = true;

        // inicialização do CRUD para a instância: dg_gd_hdr_auto
        window['userAllowedCrud']['dg_gd_hdr_auto']=[insert_, update_, delete_];

        var optionDG_GD_HDR_AUTO = {
            "tableId": 'dg_gd_hdr_auto',
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_macro_process; ?>",
            "table": "DG_GD_HDR_AUTO",
            "pk": {
                "primary": {
                    "ID": {"type": "number"}
                }
            },
            "order_by": "ID DESC",
            "recordBundle": 7,
            "pageLenght": 7,
            "scrollY": "195",
            "responsive": true,
            "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
            "detailsObjects": ['DG_GD_ID_AUTO','dg_gd_det_auto','QUAD_PEOPLE_1'],
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "width": "2%",
                    "className": "control toBottom toCenter",
                    "orderable": false,
                    "defaultContent": ''
                }, {
                    "sTitle": "<?php echo mb_strtoupper($ui_code, 'UTF-8'); ?>", //Datatables
                    "title": "<?php echo $ui_code; ?>", //Available on Editor to replace label (quadTable.js line 632)
                    "label": "<?php echo $ui_code; ?>", //Editor :: Not available on Sequence label
                    "data": 'ID',
                    "name": 'ID',
                    "datatype": 'sequence',
                    "type": "hidden", //Editor :: USED JUST ON QUERY MODE!!! (Should try sequence)!!!
                    "visible": true,
                    "className": "visibleColumn",
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
                    //"targets": 8,
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
                    "responsivePriority": 3,
                    "title": "<?php echo mb_strtoupper($ui_renewal, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_renewal; ?>", //Editor
                    "data": 'RENOV',
                    "name": 'RENOV',
                    "type": "hidden",
                    "def": "N",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_SIM_NAO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }                         
                }, {
                    "title": "<?php echo mb_strtoupper($ui_workflow, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_workflow; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_gd_macro_process_status; ?>", //Editor
                    "data": 'FASE_FINAL',
                    "name": 'FASE_FINAL',
                    "type": "select",
                    "def": "N",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_SIM_NAO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_submitted, 'UTF-8'); ?>", //Datatables :: Original
                    "label": "<?php echo $ui_submitted; ?>", //Editor
                    "data": 'TERMINADO',
                    "name": 'TERMINADO',
                    "type": "hidden",
                    "def": "N",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['DG_SIM_NAO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }                       
                }, {
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
                    "responsivePriority": 1,
                    "data": null,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function (val, type, row) {
                        if (typeof (row) === "object" && row === null) {
                            if (row['TERMINADO'] !== 'S') {
                                return dg_gd_hdr_auto.crudButtons(true,true,true);
                            // se está terminado já não pode editar
                            } else {
                                // se houve submissão autom+atica já não pode remover
                                if (row['FASE_FINAL'] !== 'S') {
                                    return dg_gd_hdr_auto.crudButtons(true,false,true);
                                } else {
                                    return dg_gd_hdr_auto.crudButtons(true,false,false);
                                }        
                            }
                        } else {
                                return dg_gd_hdr_auto.crudButtons(true,true,true);
                        }
                    }
                }
            ],
            "footerCallback": function (settings) {
                //console.log ( dg_gd_hdr_auto.tbl.data() );                   
            },
            /*                
            "onDelete": function () { //When defined, replaces de instance delete event: full control here !!!
                obj = this;
                console.log(obj.detailsObjects);
                _.forEach(obj.detailsObjects, function (key, o) {    
                    setTimeout(function () {
                        //$.fn.DataTable.isDataTable('#' + window[o].tableId)
                        var det_ = window[key]; //GET QUADTABLE (DETAIL) INSTANCE USING STRING W/ NAME
                        console.log(det_);
                        //$('#'+key).DataTable().clear().draw();
                        det_.tbl.clear().draw();
                    }, 1500);
                });
            },
            */                
            "validations": {
                "rules": {
                    "DSP_GD": {
                        required: true
                    },
                    "DSP_MODEL": {
                        required: true
                    },
                    "DESIGEMPRESA": {
                        required: true
                    },
                },
            }
        };

        // chamada do interface de Renovações
        if(detectQueryString()){
            //console.log(QueryStringToJSON());
            optionDG_GD_HDR_AUTO['sFilters'] = QueryStringToJSON();
        }            
        dg_gd_hdr_auto = new QuadTable();
        dg_gd_hdr_auto.initTable($.extend({}, datatable_instance_defaults, optionDG_GD_HDR_AUTO));    

        //Colaboradores selecionados para processo de renovações
        var optionDG_GD_ID_AUTO = {
            "tableId": 'DG_GD_ID_AUTO',
            "table": "DG_GD_ID_AUTO_VW",
            "pk": {
                "primary": {
                    "ID_HDR": {"type": "number"},
                    "EMPRESA": {"type": "varchar"},
                    "RHID": {"type": "number"},
                    "DT_ADMISSAO": {"type": "date"}
                }
            },
            "dependsOn": {
                "dg_gd_hdr_auto": {
                    //External object key mapping( object key : external key)
                    "ID_HDR": "ID"
                }
            },
            "order_by": "RHID ASC",
            "scrollY": "390", 
            "recordBundle": 30,
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
                    "data": 'ID_HDR',
                    "name": 'ID_HDR',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                        
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
                    "visible": false,
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
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_DIRECAO',
                    "name": 'CD_DIRECAO',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables   
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_DIRECAO',
                    "name": 'DT_INI_DIRECAO',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                    "datatype": 'date'
                }, {
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_direction, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_direction; ?>",
                    "data": "DSP_DIRECAO",
                    "name": "DSP_DIRECAO",
                    "className": "visibleColumn",
                    "type": "select",
                    "visible": true,
                    "attr": {
                        "dependent-group": "EMPRESA",
                        "dependent-level": 2,
                        "data-db-name": 'A.EMPRESA@A.CD_DIRECAO@A.DT_INI_DIRECAO',
                        "decodeFromTable": 'DG_DIRECOES A',
                        "desigColumn": "CONCAT(CONCAT(A.CD_DIRECAO,'-'),A.DSP_DIRECAO)",
                        'orderBy': 'A.EMPRESA,A.CD_DIRECAO',
                        "class": "form-control complexList chosen"
                    }    
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_DEPT',
                    "name": 'CD_DEPT',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables   
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_DEPT',
                    "name": 'DT_INI_DEPT',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables   
                }, {
                    "complexList": true, 
                    "data": "DSP_DEPT",
                    "title": "<?php echo mb_strtoupper($ui_department, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_department; ?>",
                    "name": "DSP_DEPT",
                    "type": "select",
                    "className": "visibleColumn",
                    "visible": true,
                    "attr": {
                        "dependent-group": "EMPRESA",
                        "dependent-level": 3,
                        "data-db-name": 'A.EMPRESA@A.CD_DIRECAO@A.DT_INI_DIRECAO@CD_DEPT',
                        "decodeFromTable": 'DG_DEPARTAMENTOS A',
                        "desigColumn": "CONCAT(CONCAT(A.CD_DEPT,'-'),A.DSP_DEPT)",
                        'orderBy': 'A.EMPRESA,A.CD_DIRECAO,A.CD_DEPT',
                        "class": "form-control complexList chosen"
                    }
                }, {
                    "title": "",
                    "data": "RHID",
                    "name": "RHID",
                    "type": "hidden", //Editor
                    "visible": false, //DataTables   
                }, {
                    "title": "<?php echo mb_strtoupper($ui_employee, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_employee; ?>",
                    "data": "CONCAT(CONCAT(RHID,'-'),NOME)",
                    "name": "CONCAT(CONCAT(RHID,'-'),NOME)",
                    "className": "visibleColumn",
                }, {
                    "title": "<?php echo mb_strtoupper($ui_dt_admission, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_dt_admission; ?>",
                    "data": 'DT_ADMISSAO',
                    "name": 'DT_ADMISSAO',
                    "datatype": 'date',
                    "className": "visibleColumn"
                }, {
                    "title": "",
                    "data": "CD_VINCULO",
                    "name": "CD_VINCULO",
                    "type": "hidden", //Editor
                    "visible": false, //DataTables   
                }, {
                    "complexList": true, 
                    "data": "DSP_VINCULO",
                    "title": "<?php echo mb_strtoupper($ui_contractual_bond, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_contractual_bond; ?>",
                    "name": "DSP_VINCULO",
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "dependent-group": "VINCULO",
                        "dependent-level": 1,
                        "data-db-name": 'A.CD_VINCULO',
                        "decodeFromTable": 'RH_DEF_VINCULOS_CONTRATUAIS A',
                        "desigColumn": "A.DSP_VINCULO",
                        'orderBy': 'A.CD_VINCULO',
                        "class": "form-control complexList chosen"
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_VINCULO',
                    "name": 'DT_INI_VINCULO',
                    "datatype": 'date',
                    "def": hoje(), // hoje() OR hoje('minutes') OR "def": hoje('seconds')
                    "className": "visibleColumn",
                }, {
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM_VINCULO',
                    "name": 'DT_FIM_VINCULO',
                    "datatype": 'date',
                    "className": "visibleColumn",
                }, {
                    "title": "<?php echo mb_strtoupper($ui_renewals_number, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_renewals_number; ?>", //Editor
                    "data": "RH_NR_RENOV(EMPRESA,RHID,DT_ADMISSAO)",
                    "name": "RH_NR_RENOV(EMPRESA,RHID,DT_ADMISSAO)",
                    "className": "visibleColumn right",
                }, {
                    "title": "<?php echo mb_strtoupper($ui_days, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_days; ?>", //Editor
                    "data": "DATEDIFF(QUADATE(),DT_FIM_VINCULO)",
                    "name": "DATEDIFF(QUADATE(),DT_FIM_VINCULO)",
                    "className": "visibleColumn right",
                }
            ],
            "validations": {
                "rules": {
                    "DESIGEMPRESA": {
                        required: true
                    },
                },
            }
        };
        DG_GD_ID_AUTO = new QuadTable();
        DG_GD_ID_AUTO.initTable($.extend({}, datatable_instance_defaults, optionDG_GD_ID_AUTO));    

        //Atribuição Automática :: FORMULÁRIO (variáveis)  
        var optionDG_GD_DET_AUTO = {
            "tableId": 'dg_gd_det_auto',
            "order": false,
            "table": "DG_GD_DET_AUTO",
            "pk": {
                "primary": {
                    "ID": {"type": "number"},
                    "SEQ": {"type": "number"}
                }
            },
            "dependsOn": {
                "dg_gd_hdr_auto": {
                    //External object key mapping( object key : external key)
                    "ID": "ID"
                }
            },
            "order_by": "SEQ DESC",
            "recordBundle": 9999999999,
            "pageLenght": 9999999999,
            "scrollY": "275",
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
                    "data": 'ID',
                    "name": 'ID',
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
                    //"style": "width: 20%",
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
                 //return dg_gd_det_auto.crudButtons(userAllowedCrud);
                 return dg_gd_det_auto.crudButtons(true, true, true);
                 }
                 }*/
            ],
            "createdRow": function (row, data, dataIndex) {
                //console.log('created row');
                setTimeout(function () {
                    //Atualização do ecran do formulário
                    var el = $(row).find('td:eq(2) > select.chosen');
                    if (el.length) {
                        $(el).val(data['VALOR']).chosen({width: "auto"});
                    }
                    $('.form-actions').css('display','block').show('slow');
                }, 10);
            },
            "rowCallback": function (row, data, dataIndex) {
                //console.log('rowcallback');                    
            },
            "drawCallback": function (settings) {
                //console.log('drawCallback');
                //console.log(setting);
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
        dg_gd_det_auto = new QuadTable();
        dg_gd_det_auto.initTable($.extend({}, datatable_instance_defaults, optionDG_GD_DET_AUTO)); 
        //END Atribuição Automática :: FORMULÁRIO (variáveis)

        //Filtro de Seleção de Colaboradores
        var optionQUAD_PEOPLE_1 = {
            "tableId": 'QUAD_PEOPLE_1',
            "table": "QUAD_PEOPLE",
            "pk": {
                "primary": {
                    //"EMPRESA": {"type": "varchar"},
                    "RHID": {"type": "number"},
                    "DT_ADMISSAO": {"type": "date"}
                }
            },
            "dependsOn": {
                "dg_gd_hdr_auto": {
                    //External object key mapping( object key : external key)
                    "EMPRESA": "EMPRESA"
                }
            },
            "initialWhereClause": whereClause_,
            "externalFilter": {
                "template": "#QUAD_PEOPLE_1_filter",
                "mandatory": ['DESIGEMPRESA'], 
                "optional": ['DSP_ESTAB','DSP_SETOR','DSP_DIRECAO','DSP_DEPT','DSP_VINCULO','DT_FIM_VINCULO','NR_RENOV','NR_DIAS'] 
            },                
            "order_by": "RHID ASC",
            "scrollY": "390", 
            "recordBundle": 30,
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
                    "title": '<input type="checkbox" id="sel_colab_all">', //Datatables
                    "responsivePriority": 1,
                    "data": null,
                    "width": "11px",
                    "className": "visibleColumn toBottom toCenter",
                    "orderable": false,
//                        "defaultContent": '',
                    "render": function (val, type, row) {
                        html_ = '<input type="checkbox" class="sel_colab" data-ref="'+row['EMPRESA']+'@'+row['RHID']+'@'+row['DT_ADMISSAO']+'">';
                        return html_;
                    }                        
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
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_ESTAB',
                    "name": 'CD_ESTAB',
                    "type": "hidden", //Editor
                    "visible": false //DataTables   
                }, {
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_establishment, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_establishment; ?>",
                    "data": "DSP_ESTAB",
                    "name": "DSP_ESTAB",
                    "className": "visibleColumn",
                    "type": "select",
                    "visible": false,
                    "attr": {
                        "dependent-group": "EMPRESA",
                        "dependent-level": 2,
                        "data-db-name": 'A.EMPRESA@A.CD_ESTAB',
                        "decodeFromTable": 'DG_ESTABELECIMENTOS A',
                        "desigColumn": "CONCAT(CONCAT(A.CD_ESTAB,'-'),A.DSP_ESTAB)",
                        'orderBy': 'A.EMPRESA,A.CD_ESTAB',
                        "class": "form-control complexList chosen"
                    }    
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_SETOR',
                    "name": 'ID_SETOR',
                    "type": "hidden", //Editor
                    "visible": false //DataTables   
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_SETOR',
                    "name": 'DT_INI_SETOR',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false //DataTables   
                }, {
                    "complexList": true, 
                    "data": "DSP_SETOR",
                    "title": "<?php echo mb_strtoupper($ui_sector, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_sector; ?>",
                    "name": "DSP_SETOR",
                    "type": "select",
                    "className": "visibleColumn",
                    "visible": false,
                    "attr": {
                        "dependent-group": "EMPRESA",
                        "dependent-level": 3,
                        "data-db-name": 'A.EMPRESA@A.CD_ESTAB@A.ID_SETOR',
                        "decodeFromTable": 'DG_SETORES A',
                        "desigColumn": "CONCAT(CONCAT(A.ID_SETOR,'-'),A.DSP_SETOR)",
                        'orderBy': 'A.EMPRESA,A.CD_ESTAB,A.ID_SETOR',
                        "class": "form-control complexList chosen"
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_DIRECAO',
                    "name": 'CD_DIRECAO',
                    "type": "hidden", //Editor
                    "visible": false //DataTables   
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_DIRECAO',
                    "name": 'DT_INI_DIRECAO',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                    "datatype": 'date'
                }, {
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_direction, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_direction; ?>",
                    "data": "DSP_DIRECAO",
                    "name": "DSP_DIRECAO",
                    "className": "visibleColumn",
                    "type": "select",
                    "visible": false,
                    "attr": {
                        "dependent-group": "EMPRESA",
                        "dependent-level": 2,
                        "data-db-name": 'A.EMPRESA@A.CD_DIRECAO@A.DT_INI_DIRECAO',
                        "decodeFromTable": 'DG_DIRECOES A',
                        "desigColumn": "CONCAT(CONCAT(A.CD_DIRECAO,'-'),A.DSP_DIRECAO)",
                        'orderBy': 'A.EMPRESA,A.CD_DIRECAO',
                        "class": "form-control complexList chosen"
                    }    
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_DEPT',
                    "name": 'CD_DEPT',
                    "type": "hidden", //Editor
                    "visible": false //DataTables   
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_DEPT',
                    "name": 'DT_INI_DEPT',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false //DataTables   
                }, {
                    "complexList": true, 
                    "data": "DSP_DEPT",
                    "title": "<?php echo mb_strtoupper($ui_department, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_department; ?>",
                    "name": "DSP_DEPT",
                    "type": "select",
                    "className": "visibleColumn",
                    "visible": false,
                    "attr": {
                        "dependent-group": "EMPRESA",
                        "dependent-level": 3,
                        "data-db-name": 'A.EMPRESA@A.CD_DIRECAO@A.DT_INI_DIRECAO@CD_DEPT',
                        "decodeFromTable": 'DG_DEPARTAMENTOS A',
                        "desigColumn": "CONCAT(CONCAT(A.CD_DEPT,'-'),A.DSP_DEPT)",
                        'orderBy': 'A.EMPRESA,A.CD_DIRECAO,A.CD_DEPT',
                        "class": "form-control complexList chosen"
                    }
                }, {
                    "title": "",
                    "data": "RHID",
                    "name": "RHID",
                    "type": "hidden", //Editor
                    "visible": false //DataTables   
                }, {
                    "title": "<?php echo mb_strtoupper($ui_employee, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_employee; ?>",
                    "data": "CONCAT(CONCAT(RHID,'-'),NOME)",
                    "name": "CONCAT(CONCAT(RHID,'-'),NOME)",
                    "className": "visibleColumn"
                }, {
                    "title": "<?php echo mb_strtoupper($ui_dt_admission, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_dt_admission; ?>",
                    "data": 'DT_ADMISSAO',
                    "name": 'DT_ADMISSAO',
                    "datatype": 'date',
                    "className": "visibleColumn"
/*                    }, {
                    "title": "<?php echo mb_strtoupper($ui_function, 'UTF-8'); ?>", //Datatables
                    "data": "CONCAT(CONCAT(ID_FUNCAO,'-'),DSP_FUNCAO)",
                    "name": "CONCAT(CONCAT(ID_FUNCAO,'-'),DSP_FUNCAO)",
                    "className": "visibleColumn",*/
                }, {
                    "title": "<?php echo mb_strtoupper($ui_prof_categ, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_prof_categ; ?>",
                    "data": "CONCAT(CONCAT(CD_CATG_PROF,'-'),DSP_CATG_PROF)",
                    "name": "CONCAT(CONCAT(CD_CATG_PROF,'-'),DSP_CATG_PROF)",
                    "className": "visibleColumn"
                }, {
                    "title": "",
                    "data": "CD_VINCULO",
                    "name": "CD_VINCULO",
                    "type": "hidden", //Editor
                    "visible": false //DataTables   
                }, {
                    "complexList": true, 
                    "data": "DSP_VINCULO",
                    "title": "<?php echo mb_strtoupper($ui_contractual_bond, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_contractual_bond; ?>",
                    "name": "DSP_VINCULO",
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "dependent-group": "VINCULO",
                        "dependent-level": 1,
                        "data-db-name": 'A.CD_VINCULO',
                        "decodeFromTable": 'RH_DEF_VINCULOS_CONTRATUAIS A',
                        "desigColumn": "A.DSP_VINCULO",
                        'orderBy': 'A.CD_VINCULO',
                        "class": "form-control complexList chosen"
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_begin_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                    "data": 'DT_INI_VINCULO',
                    "name": 'DT_INI_VINCULO',
                    "datatype": 'date',
                    "def": hoje(), // hoje() OR hoje('minutes') OR "def": hoje('seconds')
                    "className": "visibleColumn"
                }, {
                    "title": "<?php echo mb_strtoupper($ui_end_date, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_end_date; ?>", //Editor
                    "data": 'DT_FIM_VINCULO',
                    "name": 'DT_FIM_VINCULO',
                    "datatype": 'date',
                    "className": "visibleColumn"
                }, {
                    "title": "<?php echo mb_strtoupper($ui_renewals_number, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_renewals_number; ?>", //Editor
                    "data": "NR_RENOV",
                    "name": "NR_RENOV",
                    "className": "visibleColumn right"
                }, {
                    "title": "<?php echo mb_strtoupper($ui_days, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_days; ?>", //Editor
                    "data": "NR_DIAS",
                    "name": "NR_DIAS",
                    "className": "visibleColumn right"
                }
            ],
            "validations": {
                "rules": {
                    "DESIGEMPRESA": {
                        required: true
                    },
                },
            }
        };
        QUAD_PEOPLE_1 = new QuadTable();
        QUAD_PEOPLE_1.initTable($.extend({}, datatable_instance_defaults, optionQUAD_PEOPLE_1));    
        //END Filtro de Seleção de Colaboradores

        // Código associado ao cabeçalho e formulário
        if (1 === 1) {
            //Reads Master RECORD FASE and MANAGES FORMULARIO INTERACTIONS (enabling or disabling entire FORM)
            function updateFormulario () {
                var terminado_ = dg_gd_hdr_auto.tbl.rows( '.selected' ).data()[0]['TERMINADO'];

                if (terminado_ !== 'S') { //Process IS OPEN
                    // botão de gravação de recolha de formulários
                    $('.form-actions').css('display','block').show('slow');
                    $("#saveMacroDetails").removeClass("disabled");

                } else { //Process IS CLOSE

                    setTimeout( function () {
                        $('table#dg_gd_det_auto > tbody :input,select,textarea').prop('readonly', true).prop('disabled', true).trigger("chosen:updated");
                    }, 300)

                    $("#varsForm :input,select,textarea").prop('readonly', true);

                    // botão de gravação de recolha de formulários
                    $('.form-actions').css('display','none');
                    $("#saveMacroDetails").addClass("disabled");
                }
            }

            /* CONTROLADOR Específico de dg_gd_det_auto:: permite validar e gravar os inputs nas variáveis do documento */
            $('#varsForm').on('click', '#saveMacroDetails', function (e) {

                var masterKey = '', matches = $('#dg_gd_det_auto tbody > tr > td :input.gd_var'),
                        dados = [], col = {}, name, val, str = '';
                try {
                    //On a DETAIL INSTANCE, get's the MASTER PRIMARY KEY!!!
                    //masterKey = $('#dg_gd_hdr_auto_info > span.select-info > span.goEye > i').attr('data-rowid').replace("row_", "");
                    // 
                    data_ = dg_gd_hdr_auto.selectedRowData();
                    empresa_ = '';
                    masterKey_ = '';

                    // obter o valor da EMPRESA da cabeçalho do Macro-Processo
                    if (typeof data_ !== 'undefined') {
                        // the array is defined and has at least one element
                        masterKey = data_['ID'];
                        empresa_ = data_['EMPRESA'];
                    }                        

                    //console.log(data_);
                    //console.log('id:'+masterKey+' empresa:'+empresa_);

                    if (masterKey !== '' && empresa_ !== '') {
                        col = JSON.parse('{"key" : ' + masterKey + '}');
                        dados.push(col);

                        col = JSON.parse('{"empresa" : "' + empresa_ + '" }');
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
                        str += '}';
                        col = JSON.parse(str);
                        dados.push(col);
                        //console.log(dados);

                        /* Save USER answers to the DATABASE */
                        $.ajax({
                            type: "POST",
                            url: pn + "/data-source/gd_formulario_macro_proc_controller.php",
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
                                            rw = $('table#dg_gd_det_auto > tbody > tr#row_' + rst['rowErrors'][i]['seq']); //Identifies QuadTables ROW with Error
                                            rw.css({"background-color": "rgb(255,225,225)!important", "color": "#675100!important"}); //CSS on that ROW
                                            col = rw.find('td:nth-child(2)'); //Identify the "LABEL" (2tn) column to notify ERROR MESSAGE
                                            col.html('<span rel="tooltip" data-placement="right" class="notifyThis" data-original-title="' + rst['rowErrors'][i]['msg'] + '">' + col.text() + '</span>'); //Transform column to signal ERROR msg as a TOOLTIP
                                            $("[rel=tooltip]").tooltip(); //Activate tootip plugin
                                        }
                                        var rows = $('table#dg_gd_det_auto > tbody > tr');
                                        rows.each(function () {
                                            var el = $(this).attr('id'),
                                                rw = el.replace('row_', '');
                                            console.log(rw);
                                        });
                                    }

                                } catch (e) {
                                    if (rst.msg) { //SUCESS OPERATION: arrives here because rst doesn't have rst['formErrors'] neither rst['rowErrors']
//Refresh DATA WHEN NO ERRORS RETURNED (to retrived automatic variables)
//$('#refresh_dg_gd_det_auto').click();

                                        quad_notification_clear();;
                                        quad_notification({
                                            type: "success",
                                            title: JS_OPERATION_COMPLETED,
                                            content: '<i class="fa fa-clock-o"></i>&nbsp;<i>' + rst.msg + '</i>',
                                            timeout: 3500
                                        });
                                        // foi terminado um processo automático de renovação
                                        // atualiza estado do interface
                                        if (rst.macro_terminado === 'S') {
                                            changeQuadtableColumn(dg_gd_hdr_auto,'TERMINADO', 7, JS_YES, rst.macro_terminado);                                            

                                            var el = dg_gd_hdr_auto.tbl.rows('.selected');
                                            //Deselect current ROW (already updated on server)
                                            el.deselect();
                                            //Select current ROW (to refresh detail results)
                                            el.select();
                                        }
                                    } else {

                                        // reset da SmartMessageBox
                                        ExistMsg = 0;
                                        SmartMSGboxCount = 0;
                                        PrevTop = 0;
                                        $(".divMessageBox").each(function(){
                                            $(this).remove();
                                        });

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
                    console.log('Master record must be selected first ['+masterKey+','+empresa_+']! '+ex.message);
                }
                return false;
            });     

            /* Events ON MACRO-PROCESSOS instance for: SELECT / DESELECT ROW */
            // NOTE: Assertive way to lunch events BEFORE DOM availability
            $(document).on('click', '#dg_gd_hdr_auto > tbody', function (ev) {
                ev.stopImmediatePropagation();
                var empresa_ = '', select_, renov_,
                    x = dg_gd_hdr_auto.selectedRowData(); 

                $('#formError').css({"display": "none"});
                $('#lineError').css({"display": "none"});
                $("#saveMacroDetails").removeClass("disabled");

                //IS Master RECORD DATA SELECTED ??
                if (x) {            //Yes
                    select_ = 'S';
                    empresa_ = x['EMPRESA'];
                    renov_  = x['RENOV'];
                    terminado_ = x['TERMINADO']; 
                    if (renov_ === 'N' ) {
                        //Força a passagem da EMPRESA no registo master, passando-a para o FILTRO da TAB "Âmbito"
                        $("#xt_DESIGEMPRESA").val(empresa_).trigger('change');
                        if (x['TERMINADO'] !== 'S') { //Macro Process is Finished                                
                            $("#QUAD_PEOPLE_1_filter :input,select,textarea").prop('readonly', false);
                            $("#QUAD_PEOPLE_1_filter :input,select,textarea").prop('disabled', false);
                        }
                    }
                    updateFormulario(); //FORMULÁRIO CONTROL                        
                } else {            //No
                    select_ = 'N';
                    renov_  = '';
                    terminado_ = '';

                    $("#QUAD_PEOPLE_1_filter :input,select,textarea").prop('readonly', false);
                    $("#QUAD_PEOPLE_1_filter :input,select,textarea").prop('disabled', false);

                    //Show "Scope" tab when master doesn't have any record selected
                    $('#widget-tab-1 > li:nth-child(2)').css({"display": "block"});      

                    $('.form-actions').css('display','none'); //ROW on MASTER WAS DESELECTED :: Hide formulario SUBMIT button 
                    $("#saveMacroDetails").addClass("disabled");
                }

                //Managing TAB contents
                controlaTabs(select_,renov_, terminado_);

            });

        }

        // Código associado ao filtro de seleção de colaboradores
        if (1 === 1) {
            // botão de seleção todos/nenhum
            $(document).on('click', "#sel_colab_all", function (evt) {
                evt.stopImmediatePropagation();
                val_ = 'N';
                if ($(this).is(':checked')) {
                    val_ = 'S';
                } 
                else {
                    val_ = 'N';
                }
                $('#QUAD_PEOPLE_1 > tbody  > tr').find('.sel_colab').each(function() {
console.log("elem",$(this).attr("data-ref"), " val ",val_);

                    if (val_ === 'S') {
                        $(this).prop('checked', true);
                    } else {
                        $(this).prop('checked', false);
                    }
                });                
            });

            // trigger para garantir a inicialização da empresa sempre que o tab de Âmbito é acionado
            $(document).on('click', "#widget-tab-1 > li:eq(2) a", function (evt) {
                setTimeout( function () {
                    var x = dg_gd_hdr_auto.selectedRowData();
                    var empresa_ = '';
                    if (dg_gd_hdr_auto.tbl.rows( '.selected' ).any()){ //ROW on MASTER IS SELECTED
                        // inicialização da empresa para dar suporte às restantes listas
                        empresa_ = x['EMPRESA'];
                        $("#xt_DESIGEMPRESA").val(empresa_).trigger('change');
                    }
                }, 1000)
            });

            // Geração de documentos -- versão sincrona
            $(document).on('click', "#gd_gerar_docs_sync", function (evt) {
                evt.stopImmediatePropagation();

                // Obtem a chave do registo selecionado
                data_ = dg_gd_hdr_auto.selectedRowData();
                id_hdr_ = '';

                // obter o valor da EMPRESA da cabeçalho do Macro-Processo
                if (typeof data_ !== 'undefined') {
                    // the array is defined and has at least one element
                    id_hdr_ = data_['ID'];
                } 

                // registo selecionado
                if (typeof id_hdr_ !== 'undefined' && id_hdr_ !== '') {

                    // obtem a lista dos colaboradores selecionados
                    lista = [];
                    $('#QUAD_PEOPLE_1 > tbody  > tr').find('.sel_colab').each(function() {
                        if ($(this).is(":checked")) {
                            id_ = $(this).data("ref");
                            lista.push(id_);
                        }
                    });                

                    if (lista.length > 0) {

                        // pedido de confirmação da operação 
                        JS_TITLE = "<?php echo $ui_massive_doc_generation;?>";
                        JS_MSG = "<?php echo $msg_massive_doc_generation;?>";
                        JS_MSG1 = '';

                        // reset da SmartMessageBox
                        ExistMsg = 0;
                        SmartMSGboxCount = 0;
                        PrevTop = 0;
                        $(".divMessageBox").each(function(){
                            $(this).remove();
                        });

                        $.SmartMessageBox({
                              title: '<i class="fa fa-times" style="color:#ED1C24"></i>&nbsp;' + JS_TITLE,
                              content: JS_MSG, //Warning: This action cannot be undone!
                              buttons: '[' + JS_YES + '][' + JS_NO + ']'
                          }, function (ButtonPressed) {
                              if (ButtonPressed === JS_YES) { 
                                //Object.keys(lista).forEach(function(key) {
                                //    console.log(key, lista[key]);
                                //});                              

                                /* executar geração de documentos */
                                $.ajax({
                                    type: "POST",
                                    url: pn + "/data-source/gd_formulario_macro_proc_controller.php",
                                    data: "action=gerar"+
                                          "&id_hdr="+id_hdr_+
                                          "&request_data=" + JSON.stringify(lista),
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
                                                        //$('#formMsg').append(rst['formErrors'][i]['msg']);
                                                        htm += '<li> ' + rst['formErrors'][i]['msg'] + '</li>';
                                                        cnt = 0;
                                                    } else {
                                                        htm += '<li> ' + rst['formErrors'][i]['msg'] + '</li>';
                                                    }
                                                }
                                                if (htm !== '') {
                                                    $('#formMsg').append('<ol> ' + htm + '</ol>');
                                                }
                                            }

                                        } catch (e) {
                                            if (rst['error']) { 
                                                res = rst['error'];
                                                $.SmartMessageBox({
                                                    title: '<i class="fa fa-times" style="color:#ED1C24"></i>&nbsp;' + JS_WARNING,
                                                    content: res,
                                                    buttons: '[' + "<?php echo $ui_close; ?>" + ']'
                                                });
                                            } else if (rst.msg ) { 
                                                //SUCESS OPERATION: arrives here because rst doesn't have rst['formErrors'] neither rst['rowErrors']
                                                //Refresh DATA WHEN NO ERRORS RETURNED (to retrived automatic variables)
                                                $('#refresh_dg_gd_hdr_auto').click();
                                                quad_notification_clear();;
                                                quad_notification({
                                                    type: "success",
                                                    title: JS_OPERATION_COMPLETED,
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
                                    }
                                });
                              }
                              //Operação foi cancelada
                              if (ButtonPressed === JS_NO) { /* NO, record stays! */
                                quad_notification({
                                    type: "info",
                                    title: JS_OPERATION_ABORT,
                                    content: '<i class="fa fa-clock-o"></i>&nbsp;<i>' + JS_MSG1 + '</i>',
                                    timeout: 1500
                                  });
                              }
                        });
                    }
                }
            });

            // Geração de documentos -- versão assincrona
            var processId, processTitle;
            setTimeout(function () {   
                $('#gd_gerar_docs_async').on("click", function (e) {
                    e.stopImmediatePropagation();

                    var data_, id_hdr_, lista, 
                        processId, processTitle,
                        msg, mssg,
                        el = $(this), btnTxt = el.html(), tmp, t1, t0 = performance.now();

                    $(this).html( '<i class="fa fa-gear fa-spin"></i> ' + btnTxt );
                    $(this).prop("disabled", true);
                    quad_notification_clear();;

                    // reset da SmartMessageBox
                    ExistMsg = 0;
                    SmartMSGboxCount = 0;
                    PrevTop = 0;
                    $(".divMessageBox").each(function(){
                        $(this).remove();
                    });

                    // Obtem a chave do registo selecionado
                    data_ = dg_gd_hdr_auto.selectedRowData();
                    id_hdr_ = '';

                    // obter o valor da EMPRESA da cabeçalho do Macro-Processo
                    if (typeof data_ !== 'undefined') {
                        // the array is defined and has at least one element
                        id_hdr_ = data_['ID'];
                    } 

                    // registo selecionado
                    if (typeof id_hdr_ !== 'undefined' && id_hdr_ !== '') {

                        // obtem a lista dos colaboradores selecionados
                        lista = [];
                        $('#QUAD_PEOPLE_1 > tbody  > tr').find('.sel_colab').each(function() {
                            if ($(this).is(":checked")) {
                                id_ = $(this).data("ref");
                                lista.push(id_);
                            }
                        });                

                        if (lista.length > 0) {

                            // pedido de confirmação da operação 
                            JS_TITLE = "<?php echo $ui_massive_doc_generation;?>";
                            JS_MSG = "<?php echo $msg_massive_doc_generation;?>";
                            JS_MSG1 = '';

                            $.SmartMessageBox({
                                  title: '<i class="fa fa-times" style="color:#ED1C24"></i>&nbsp;' + JS_TITLE,
                                  content: JS_MSG, //Warning: This action cannot be undone!
                                  buttons: '[' + JS_YES + '][' + JS_NO + ']'
                              }, function (ButtonPressed) {
                                  if (ButtonPressed === JS_YES) { 

                                    var wk = new Worker(pn + "assets/lib/utils/workerGD.js"),
                                        message = {
                                            action: 'gerar',
                                            id_hdr: id_hdr_,
                                            request_data: lista,
                                            defaults: datatable_instance_defaults.pathToSqlFile
                                        },
                                        mssg = '';

                                    wk.postMessage(JSON.stringify(message));
                                    wk.onmessage = function (event) {                
                                        if (event.data === 'working') {
                                            dg_gd_hdr_auto.showProcess("<?php echo $ui_massive_doc_generation; ?>"); //Process ID;
                                            return;
                                        } else {
                                            t1 = performance.now();
                                            tmp = millisToMinutesAndSeconds(t1 - t0);
                                            el.html( btnTxt );
                                            el.removeAttr("disabled"); 

                                            //var msg = result.msg;//JSON.parse(JSON.stringify(result.msg));
                                            if (event.data) {
                                                var regex1 = /^OK+/;
                                                if (event.data.error === '') {//(msg.indexOf("OK:")) {
                                                    mssg = "<?php echo $ui_massive_doc_generation_ok; ?>";                                
                                                    mssg = mssg.replace(" {0}", " " + tmp + " (MM:SS)");
                                                    quad_notification({
                                                            type: "success",
                                                            title : JS_OPERATION_COMPLETED,
                                                            content : '<i class="glyphicon glyphicon-thumbs-up"></i>&nbsp;<i>' + mssg + '</i>',
                                                            timeout : 5000
                                                    });
                                                    $(this).prop("disabled", false);
                                                    $('#refresh_dg_gd_hdr_auto').click();
                                                } else { //if (msg.indexOf("NOK:")) {
                                                    var mssg = event.data.error;
                                                    quad_notification({
                                                            type: "error",
                                                            title : JS_OPERATION_ERROR,
                                                            content : '<i class="glyphicon glyphicon-thumbs-down"></i>&nbsp;<i>' + mssg + '</i>'
                                                    });
                                                    $(this).prop("disabled", false);
                                                }
                                            }
                                        }
                                        dg_gd_hdr_auto.hideProcess();
                                    }
                                    /* versão sincrona da execução */
                                    /*
                                    $.ajax({
                                        type: "POST",
                                        url: window.location.pathnapn + "/data-source/gd_formulario_macro_proc_controller.php",
                                        data: "action=gerar"+
                                              "&id_hdr="+id_hdr_+
                                              "&request_data=" + JSON.stringify(lista),
                                        cache: false,
                                        async: false,
                                        success: function (res) {
                                            try {
                                                var nrErrors, rst = JSON.parse(res);

                                                // FORM with ERRORS 
                                                if (rst['formErrors'].length) {
                                                    var htm = '';
                                                    //Display FORM ERROR MESSAGES box
                                                    $('#formError').css({"display": "block"}).fadeIn("slow");

                                                    //Signal FORM error messages
                                                    $('#formMsg').html('');
                                                    for (var i = 0; i < rst['formErrors'].length; i++) {
                                                        if (i === rst['formErrors'].length) { //Just ONE FORM ERROR
                                                            //$('#formMsg').append(rst['formErrors'][i]['msg']);
                                                            htm += '<li> ' + rst['formErrors'][i]['msg'] + '</li>';
                                                            cnt = 0;
                                                        } else {
                                                            htm += '<li> ' + rst['formErrors'][i]['msg'] + '</li>';
                                                        }
                                                    }
                                                    if (htm !== '') {
                                                        $('#formMsg').append('<ol> ' + htm + '</ol>');
                                                    }
                                                }

                                            } catch (e) {
                                                if (rst['error']) { 
                                                    res = rst['error'];
                                                    $.SmartMessageBox({
                                                        title: '<i class="fa fa-times" style="color:#ED1C24"></i>&nbsp;' + JS_WARNING,
                                                        content: res,
                                                        buttons: '[' + "<?php echo $ui_close; ?>" + ']'
                                                    });
                                                } else if (rst.msg ) { 
                                                    //SUCESS OPERATION: arrives here because rst doesn't have rst['formErrors'] neither rst['rowErrors']
                                                    //Refresh DATA WHEN NO ERRORS RETURNED (to retrived automatic variables)
                                                    $('#refresh_dg_gd_hdr_auto').click();
                                                    quad_notification_clear();;
                                                    quad_notification({
                                                        type: "success",
                                                        title: JS_OPERATION_COMPLETED,
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
                                        }
                                    });
                                    */
                                  }
                                  //Operação foi cancelada
                                  if (ButtonPressed === JS_NO) { /* NO, record stays! */
                                        quad_notification({
                                            type: "info",
                                            title: JS_OPERATION_ABORT,
                                            content: '<i class="fa fa-clock-o"></i>&nbsp;<i>' + JS_MSG1 + '</i>',
                                            timeout: 1500
                                      });
                                  }
                            });
                        }
                    }

                });

            }, 500);
            // END: Geração de documentos -- versão assincrona

        }

        //No caso da chamada ser proveniente das RENOVAÇÕES, reconfigura os tabs disponíveis
        if(detectQueryString()){
            setTimeout(function(){
                var el = dg_gd_hdr_auto.tbl.rows();
                //Select current ROW (to refresh detail results)
                el.select();

                controlaTabs('S','S','N');                    

            },500);
        } 
        else {
            controlaTabs('N','N','N');                    
        }

    });
</script>
