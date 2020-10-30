<?php
    require_once '../init.php';
?>
<style>
    #QUAD_PEOPLE_2_actions {
        display: inline-block;
        height: 28px;
        padding: 0px 0px 0px 2px !important;
        margin-right: 11px;
        margin-top: -6px;
        border-right: 1px solid rgba(0,0,0,.09);
        border-left: 0px;
    }
    #renov_actions {
        margin-right: 12px;
        height: 26px;
        padding: 2px 12px 1px 9px!important;
    }
    button.dropdown-item.quad-process {
        padding: 5px 15px 0px 15px;
    }
    
</style>
<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <span class="widget-icon"> <i class="fal fa-clone"></i></span>&nbsp;
                <h2><?php echo $ui_renewals; ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">                                            
                   <!-- FILTRO DE COLABORADORES -->
                    <form id="QUAD_PEOPLE_2_filter" style="display:none;" class="smart-form multiInstance" novalidate="novalidate">
                        <div class="form-row">
                            <!-- regulamentado pela empresa do registo master - ver trigger de seleção do registo master -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="xt_DESIGEMPRESA"><?php echo $ui_company; ?></label>
                                <select name="DESIGEMPRESA" id="xt_DESIGEMPRESA" class="form-control complexList chosen" dependent-group="EMPRESA"
                                    dependent-level="1" data-db-name="EMPRESA" decodefromtable="DG_EMPRESAS" desigcolumn="EMPRESA" orderby="NR_ORDEM">
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="xt_DSP_ESTAB"><?php echo $ui_establishment; ?></label>
                                <select name="DSP_ESTAB" id="xt_DSP_ESTAB"
                                        class="form-control complexList chosen" dependent-group="EMPRESA"
                                        dependent-level="2" data-db-name="EMPRESA@CD_ESTAB" decodefromtable="DG_ESTABELECIMENTOS"
                                        desigcolumn="DSP_ESTAB" orderby="EMPRESA,CD_ESTAB">
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="xt_DSP_SETOR"><?php echo $ui_sector; ?></label>
                                <select name="DSP_SETOR" id="xt_DSP_SETOR"
                                        class="form-control complexList chosen" dependent-group="EMPRESA"
                                        dependent-level="3" data-db-name="EMPRESA@CD_ESTAB@ID_SETOR" decodefromtable="DG_SETORES"
                                        desigcolumn="CONCAT(CONCAT(ID_SETOR,'-'),DSP_SETOR)" orderby="EMPRESA,CD_ESTAB,ID_SETOR">
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="xt_DSP_VINCULO"><?php echo $ui_contractual_bond; ?></label>
                                <select name="DSP_VINCULO" id="xt_DSP_VINCULO"
                                        class="form-control complexList chosen" dependent-group="VINCULO"
                                        dependent-level="1" data-db-name="CD_VINCULO" decodefromtable="RH_DEF_VINCULOS_CONTRATUAIS"
                                        desigcolumn="DSP_VINCULO" orderby="CD_VINCULO">
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="xt_DSP_CATG_PROF"><?php echo $ui_prof_categ; ?></label>
                                <select name="DSP_CATG_PROF" id="xt_DSP_CATG_PROF"
                                        class="form-control complexList chosen" dependent-group="CATS_PROF"
                                        dependent-level="1" data-db-name="CD_CATG_PROF" decodefromtable="RH_DEF_CATS_PROFISSIONAIS"
                                        desigcolumn="DSP_CATG_PROF" orderby="CD_CATG_PROF">
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="xt_DSP_DIRECAO"><?php echo $ui_direction; ?></label>
                                <select name="DSP_DIRECAO" id="xt_DSP_DIRECAO"
                                        class="form-control complexList chosen" dependent-group="EMPRESA"
                                        dependent-level="2" data-db-name="EMPRESA@CD_DIRECAO@DT_INI_DIRECAO" decodefromtable="DG_DIRECOES"
                                        desigcolumn="CONCAT(CONCAT(CD_DIRECAO,'-'),DSP_DIRECAO)" orderby="EMPRESA,CD_DIRECAO">
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="xt_DSP_DEPT"><?php echo $ui_department; ?></label>
                                <select name="DSP_DEPT" id="xt_DSP_DEPT"
                                        class="form-control complexList chosen" dependent-group="EMPRESA"
                                        dependent-level="3" data-db-name="EMPRESA@CD_DIRECAO@DT_INI_DIRECAO@CD_DEPT" decodefromtable="DG_DEPARTAMENTOS"
                                        desigcolumn="CONCAT(CONCAT(CD_DEPT,'-'),DSP_DEPT)" orderby="EMPRESA,CD_DIRECAO,CD_DEPT">
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="xt_DT_FIM_VINCULO"><?php echo $ui_end_date; ?></label>
                                <input name="DT_FIM_VINCULO" id="xt_DT_FIM_VINCULO" class="form-control datepicker">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="xt_NR_RENOV"><?php echo $ui_renewals_number; ?></label>
                                <input name="NR_RENOV" id="xt_NR_RENOV" class="form-control visibleColumn right" style="width:30%">
                            </div>

                            <div class="col-md-1 mb-3">
                                <label class="form-label" for="xt_NR_DIAS"><?php echo $ui_days; ?></label>
                                <input name="NR_DIAS" id="xt_NR_DIAS" class="form-control visibleColumn right" style="width:30%">
                            </div>
                        </div>
                    </form>
                   <!-- END FILTRO DE COLABORADORES -->
                </div>                     
                <div class="panel-content">                                            
                    <a id="QUAD_PEOPLE_2_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                    <div class="widget-toolbar"  id="QUAD_PEOPLE_2_actions">
                        <div class="btn-group" style="margin-bottom:5px">
                            <button id="renov_actions" class="btn btn-primary btn-sm dropdown-toggle waves-effect waves-themed mt-" data-toggle="dropdown">
                                <?php echo $ui_actions;?>
                            </button>
                            <ul class="dropdown-menu pull-right">
                                <li>
                                    <a id="gd_selectModel" href="javascript:void(0);"><?php echo $ui_generate;?></a>
                                </li>
                            </ul>
                        </div>
                    </div>                    
                    <table id="QUAD_PEOPLE_2" class="table table-bordered table-hover table-striped w-100"></table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="chooseModel" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fal fa-id-card"></i>&nbsp;&nbsp;Escolha o Modelo a Implementar</h4>
            </div>
            <div class="modal-body" style="overflow-x: hidden;">
                <form id="chooseModelForm" class="form-horizontal" novalidate="novalidate">
                    <fieldset style="padding: 35px 30px 35px;">
                        <!-- regulamentado pela empresa do registo master - ver trigger de seleção do registo master -->
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="DSP_GD"><?php echo $ui_type; ?></label>
                            <div class="col-md-10">
                                <select name="DSP_GD" id="DSP_GD" class="form-control chosen"></select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="DSP_DET_GD"><?php echo $ui_model; ?></label>
                            <div class="col-md-10">
                                <select name="DSP_DET_GD" id="DSP_DET_GD" class="form-control chosen"></select>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $ui_close;?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal" id="returnChooseModel"><?php echo $ui_select;?></button>
            </div>
        </div>
    </div>
</div>

<script>
    pageSetUp();

    $(document).ready(function () {

        var perfil_ = "<?php echo @$_SESSION['perfil'];?>";
        var rhid_ = "<?php echo @$_SESSION['rhid'];?>";
        var whereClause_ =  " ATIVO = 'S' "+
                            " AND (EMPRESA,RHID,DT_ADMISSAO) NOT IN " +
                            " (SELECT DISTINCT X.EMPRESA,X.RHID,X.DT_ADMISSAO " +
                            "  FROM RH_ID_GESTAO_DOCUMENTAL X, DG_GESTAO_DOCUMENTAL Y " +
                            "  WHERE Y.CD_GD = X.CD_GD " +
                            "    AND Y.DT_INI_GD = X.DT_INI_GD " +
                            "    AND Y.GRAFICOS IN ('B') " +
                            "    AND TO_CHAR(X.DT_INI,'YYYY-MM-DD') BETWEEN  " +
                            "        TO_CHAR(DATE_SUB(QUADATE(), INTERVAL 6 MONTH),'YYYY-MM-DD') AND " +
                            "        TO_CHAR(DATE_SUB(QUADATE(), INTERVAL -6 MONTH),'YYYY-MM-DD')) ";

        if (perfil_ == 'A') {  // Colaborador
            whereClause_ += " AND RHID = "+rhid_;
        } else if (perfil_ == 'B') { // Gestor Administrativo
            whereClause_ += " AND (EMPRESA,RHID,DT_ADMISSAO_ORIGEM) IN (SELECT EMPRESA,RHID,DT_ADMISSAO FROM rh_id_empresas WHERE RHID_GESTOR_ADM = "+rhid_+") ";
        } else if (perfil_ == 'C') { // Supervisor
            whereClause_ += " AND (EMPRESA,RHID,DT_ADMISSAO_ORIGEM) IN (SELECT EMPRESA,RHID,DT_ADMISSAO FROM rh_id_empresas WHERE RHID_SUPERVISOR = "+rhid_+") ";
        } else if (perfil_ == 'D') { // Director
            whereClause_ += " AND (EMPRESA,RHID,DT_ADMISSAO_ORIGEM) IN (SELECT EMPRESA,RHID,DT_ADMISSAO FROM rh_id_empresas WHERE RHID_DIRECTOR = "+rhid_+") ";
        } else if (perfil_ == 'E') { // Gestor
            whereClause_ += " ";
        } else if (perfil_ == 'F') { // Dep.RH
            whereClause_ += " ";
        } else {
            whereClause_ += " ";
        }

        //Filtro de Seleção de Colaboradores
        var optionQUAD_PEOPLE_2 = {
            "tableId": 'QUAD_PEOPLE_2',
            "table": "QUAD_PEOPLE_TAB",
            "pk": {
                "primary": {
                    //"EMPRESA": {"type": "varchar"},
                    "RHID": {"type": "number"},
                    "DT_ADMISSAO": {"type": "date"}
                }
            },
            "initialWhereClause": whereClause_,
            "externalFilter": {                    
                "template": { //"templateMulti" : USADO PARA MULTI-INSTÂNCIAS OU SEJA POPULAÇÃO AUTÓNOMA E INDEPENDENTE DAS LISTAS DAS INSTÂNCIAS
                    "selector": "#QUAD_PEOPLE_2_filter",
                    "mandatory": ['DESIGEMPRESA'],
                    "optional": ['DSP_ESTAB','DSP_SETOR','DSP_DIRECAO','DSP_DEPT','DSP_VINCULO','DT_INI_VINCULO','DT_FIM_VINCULO','NR_RENOV','NR_DIAS']
                }
            },                
            "order_by": "RHID ASC",
            "scrollY": "385",
            "recordBundle": 12,
            "pageLenght": 12,
            "responsive": true,
            "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "width": "2%",
                    "className": "control toBottom toCenter",
                    "orderable": false,
                    "defaultContent": ''
                }, {
                    "title": '<input type="checkbox" id="sel_colab_all_2">', //Datatables
                    "responsivePriority": 1,
                    "data": null,
                    "width": "20px",
                    "className": "toBottom toCenter",
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
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_SETOR',
                    "name": 'DT_INI_SETOR',
                    "datatype": 'date',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
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
                    "visible": false, //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INI_DIRECAO',
                    "name": 'DT_INI_DIRECAO',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
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
                        'orderBy': 'EMPRESA,CD_DIRECAO',
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
                    "visible": false,
                    "attr": {
                        "dependent-group": "EMPRESA",
                        "dependent-level": 3,
                        "data-db-name": 'A.EMPRESA@A.CD_DIRECAO@A.DT_INI_DIRECAO@A.CD_DEPT',
                        "decodeFromTable": 'DG_DEPARTAMENTOS A',
                        "desigColumn": "CONCAT(CONCAT(A.CD_DEPT,'-'),A.DSP_DEPT)",
                        'orderBy': 'A.EMPRESA,A.CD_DIRECAO,A.CD_DEPT',
                        "class": "form-control complexList chosen"
                    }
                }, {
                    "title": "<?php echo mb_strtoupper($ui_rhid, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_rhid; ?>",
                    "data": "RHID",
                    "name": "RHID",
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                    "className": "visibleColumn",
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
/*                    }, {
                    "title": "<?php echo mb_strtoupper($ui_function, 'UTF-8'); ?>", //Datatables
                    "data": "CONCAT(CONCAT(ID_FUNCAO,'-'),DSP_FUNCAO)",
                    "name": "CONCAT(CONCAT(ID_FUNCAO,'-'),DSP_FUNCAO)",
                    "className": "visibleColumn",*/
//                    }, {
//                        "title": "<?php echo mb_strtoupper($ui_prof_categ, 'UTF-8'); ?>", //Datatables
//                        "label": "<?php echo $ui_prof_categ; ?>",
//                        "data": "CONCAT(CONCAT(CD_CATG_PROF,'-'),DSP_CATG_PROF)",
//                        "name": "CONCAT(CONCAT(CD_CATG_PROF,'-'),DSP_CATG_PROF)",
//                        "className": "visibleColumn",
                }, {
                    "title": "",
                    "data": "CD_CATG_PROF",
                    "name": "CD_CATG_PROF",
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "complexList": true,
                    "data": "DSP_CATG_PROF",
                    "title": "<?php echo mb_strtoupper($ui_prof_categ, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_prof_categ; ?>",
                    "name": "DSP_CATG_PROF",
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "dependent-group": "CATS_PROF",
                        "dependent-level": 1,
                        "data-db-name": 'A.CD_CATG_PROF',
                        "decodeFromTable": 'RH_DEF_CATS_PROFISSIONAIS A',
                        "desigColumn": "A.DSP_CATG_PROF",
                        'orderBy': 'A.CD_CATG_PROF',
                        "class": "form-control complexList chosen"
                    }
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
                    "data": "NR_RENOV",
                    "name": "NR_RENOV",
                    "className": "visibleColumn right",
                }, {
                    "title": "<?php echo mb_strtoupper($ui_days, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_days; ?>", //Editor
                    "data": "NR_DIAS",
                    "name": "NR_DIAS",
                    "className": "visibleColumn right",
                    "render": function (val, type, row) {
                            if (typeof (val) === "object" && val === null) {
                                return '<span></span>';
                            } else if (val > 0) {
                                return '<span>' + val + '</span>';
                            } else {
                                return '<span style="color:red">' + val + '</span>';
                            }
                    }
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
        QUAD_PEOPLE_2 = new QuadTable();
        QUAD_PEOPLE_2.initTable($.extend({}, datatable_instance_defaults, optionQUAD_PEOPLE_2));
        //END Filtro de Seleção de Colaboradores

        if (1 === 1) {
            // botão de seleção todos/nenhum
            $(document).on('click', "#sel_colab_all_2", function (evt) {
                evt.stopImmediatePropagation();
                val_ = 'N';
                if ($(this).is(':checked')) {
                    val_ = 'S';
                }
                else {
                    val_ = 'N';
                }
                $('#QUAD_PEOPLE_2 > tbody  > tr').find('.sel_colab').each(function() {
                    if (val_ === 'S') {
                        $(this).prop('checked', true);
                    } else {
                        $(this).prop('checked', false);
                    }
                });
            });

            //Popula lista de tipos de modelos GD
            function lista_tipos_GD() {
                $.ajax({
                    type: "POST",
                    url: "data-source/gd_formulario_controller.php",
                    data: "action=GD_TIPOS"+
                          "&graf=B",
                    cache: false,
                    async: false,
                    success: function (html) {
                        var lista_GD = $("#DSP_GD");
                        lista_GD.empty();

                        // trata lista recebida dos modelo
                        if (html !== '') {
                            var lista_ = JSON.parse(html);
                            lista_.forEach(function (item, index) {
                                lista_GD.append($("<option></option>")
                                        .attr("value", item.CD_GD + "@" + item.DT_INI_GD)
                                        .text(item.DSP));
                            });
                        }
                    }
                });
                $("#DSP_GD").trigger("chosen:updated");
            }

            //Popula lista de estabelecimentos
            function lista_modelos_GD(modelo_) {
                var params_ = [];
                params_[0] = $("#DSP_GD").val();
                params_[1] = modelo_;
                $.ajax({
                    type: "POST",
                    url: "data-source/gd_formulario_controller.php",
                    data: "action=GD_MODELOS" +
                          "&params_array=" + JSON.stringify(params_),
                    cache: false,
                    async: false,
                    success: function (html) {
                        var lista_DET_GD = $("#DSP_DET_GD");
                        lista_DET_GD.empty();

                        // trata lista recebida dos modelos
                        if (html !== '') {
                            var lista_ = JSON.parse(html);
                            lista_.forEach(function (item, index) {
                                lista_DET_GD.append($("<option></option>")
                                        .attr("value", item.CD_DET_GD + "@" + item.DT_INI_DET_GD)
                                        .text(item.DSP));
                            });

                            if (modelo_ !== '') {
                                lista_DET_GD.val(modelo_);
                            } else {
                                lista_DET_GD.val($("#DSP_DET_GD option:first").val());
                            }
                        }
                    }
                });
                $("#DSP_DET_GD").trigger("chosen:updated");
            }

            // botão de lamçamento de macro-processo
            $(document).on('click', "#gd_selectModel", function (e) {
                e.stopPropagation();
                e.preventDefault();

                var empresa, tipoGD, modeloGD, lista,
                    processId, processTitle,
                    msg, mssg, el = $(this), tmp, t1, t0 = performance.now();

                empresa = $("#xt_DESIGEMPRESA").val();
                tipoGD = $("#DSP_GD").val();
                modeloGD = $("#DSP_DET_GD").val();

                // obtem a lista dos colaboradores selecionados
                lista = [];
                $('#QUAD_PEOPLE_2 > tbody  > tr').find('.sel_colab').each(function() {
                    if ($(this).is(":checked")) {
                        id_ = $(this).data("ref");
                        lista.push(id_);
                    }
                });
//console.log("empresa:"+empresa+" tipo:"+tipoGD+" modelo:"+modeloGD+" nr_colabs:"+lista.length);

                if (lista.length > 0 && empresa !== '' && tipoGD !== '' && modeloGD !== '') {

                    //Filter Tipos Modelo Event
                    $(document).on('change', "#DSP_GD", function (evt) {
                        evt.stopImmediatePropagation();
                        /* Reset DISABLED if APPLYED */
                        $("#DSP_DET_GD_chosen").removeClass('forbidden-bc-grey'); //OR not-available
                        $("#DSP_DET_GD_chosen > a > span").css('color', 'inherit');
                        $("#DSP_DET_GD_chosen").parent('label.input').css('cursor', 'default');
                        lista_modelos_GD('');
                    });

                    //Inicialização das listas
                    lista_tipos_GD();
                    lista_modelos_GD('');

                    //Incicialização de Componentes :: DOM
                    $(".chosen-select").chosen();
                    $("#chooseModelForm").trigger("chosen:updated");

                    $('.chosen-container-active').each(function(i){
                        $(this).closest('div').css('z-index', 999-i);
                    });

                    $('#chooseModel').modal({show:true});
                }
            });

            // lançamento do macro-processo
            $(document).on('click', "#returnChooseModel", function (e) {
                e.stopPropagation();
                e.preventDefault();

                var empresa, tipoGD, modeloGD, lista,
                    processId, processTitle,
                    msg, mssg, el = $(this), tmp, t1, t0 = performance.now();

                empresa = $("#xt_DESIGEMPRESA").val();
                tipoGD = $("#DSP_GD").val();
                modeloGD = $("#DSP_DET_GD").val();

                // obtem a lista dos colaboradores selecionados
                lista = [];
                $('#QUAD_PEOPLE_2 > tbody  > tr').find('.sel_colab').each(function() {
                    if ($(this).is(":checked")) {
                        id_ = $(this).data("ref");
                        lista.push(id_);
                    }
                });
//console.log("empresa:"+empresa+" tipo:"+tipoGD+" modelo:"+modeloGD+" nr_colabs:"+lista.length);

                if (lista.length > 0 && empresa !== '' && tipoGD !== '' && modeloGD !== '') {
                    // pedido de confirmação da operação
                    quad_notification_clear();

                    JS_TITLE = "<?php echo $ui_macro_process_launch;?>";
                    JS_MSG = "<?php echo $msg_macro_process_launch;?>";
                    JS_MSG1 = '';

                    // reset da SmartMessageBox
                    ExistMsg = 0;
                    SmartMSGboxCount = 0;
                    PrevTop = 0;
                    $(".divMessageBox").each(function(){
                        $(this).remove();
                    });

                    $.SmartMessageBox({
                          title: '<i class="fas fa-times" style="color:#ED1C24"></i>&nbsp;' + JS_TITLE,
                          content: JS_MSG, //Warning: This action cannot be undone!
                          buttons: '[' + JS_YES + '][' + JS_NO + ']'
                      }, function (ButtonPressed) {
                          if (ButtonPressed === JS_YES) {
                            var wk = new Worker(pn + "lib/quad/workerGD.js"),
                                message = {
                                    action: 'lanca',
                                    empresa: empresa,
                                    tipoGD: tipoGD,
                                    modeloGD: modeloGD,
                                    request_data: lista,
                                    utilizador: "<?php echo @$_SESSION['utilizador'];?>",
                                    database: "<?php echo @$_SESSION['database'];?>",
                                    defaults: datatable_instance_defaults.pathToSqlFile
                                },
                                mssg = '';

                            wk.postMessage(JSON.stringify(message));
                            wk.onmessage = function (event) {
                                if (event.data === 'working') {
                                    QUAD_PEOPLE_2.showProcess("<?php echo $ui_macro_process_launch; ?>"); //Process ID;
                                    return;
                                } else {
                                    t1 = performance.now();
                                    tmp = millisToMinutesAndSeconds(t1 - t0);

                                    //var msg = result.msg;//JSON.parse(JSON.stringify(result.msg));
                                    if (event.data) {
                                        if (event.data.error === '') {//(msg.indexOf("OK:")) {
                                            // chama o interface de erros passando ID do import
                                            // setTimeout para deixar o $.SmartMessageBox terminar a sua execução...
                                            setTimeout(function () {
                                                    callInterface("gd_template_auto.php","ID=" + event.data.id_hdr);
                                            }, 100);
                                        } else { //if (msg.indexOf("NOK:")) {
                                            var mssg = event.data.error;
                                            quad_notification({
                                                    type: "error",
                                                    title : JS_OPERATION_ERROR,
                                                    content : '<i class="glyphicon glyphicon-thumbs-down"></i>&nbsp;<i>' + mssg + '</i>'
                                            });
                                        }
                                    }
                                }
                                QUAD_PEOPLE_2.hideProcess();
                            }
                          }
                          //Operação foi cancelada
                          if (ButtonPressed === JS_NO) { /* NO, record stays! */
                              quad_notification({
                                  type: "info",
                                  title: JS_OPERATION_ABORT,
                                  content: '<i class="far fa-clock"></i>&nbsp;<i>' + JS_MSG1 + '</i>',
                                  timeout: 1500
                              });
                          }
                    });

                } else {
                    console.log("SEM COLABORADORES SELECIONADOS ou PARAMETROS INDICADOS");
                }
            });
        }
    });
</script>
