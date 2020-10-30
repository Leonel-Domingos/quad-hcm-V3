<?php
    require_once '../init.php';
?>

<!-- BEGIN Page Content -->
<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <span class="widget-icon"> <i class="fas fa-user-friends"></i></span>&nbsp;
                <h2><?php echo $ui_users; ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">                                            
                    <a id="WEB_ADM_UTILIZADORES_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                    <table id="WEB_ADM_UTILIZADORES" class="table table-bordered table-hover table-striped w-100"></table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <span class="widget-icon"> <i class="fas fa-tasks"></i></span>&nbsp;
                <h2><?php echo $ui_profiles; ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <a id="WEB_ADM_PERFIS_UTILIZADORES_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                    <table id="WEB_ADM_PERFIS_UTILIZADORES" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <span class="widget-icon"> <i class="fas fa-eye-slash"></i></span>&nbsp;
                <h2><?php echo $ui_restrictions_by_profile; ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <a id="WEB_ADM_FILTROS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                    <table id="WEB_ADM_FILTROS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- END Page Content -->
    
<script>
 //' :: ACRESCENTAR WEB_ADM_FILTROS (ATIVO : S-Sim; N-Não) Incluir Botão-Get All Active Estabs'    
    pageSetUp();

    $(document).ready(function () {
        //Users
        var optionsWEB_ADM_UTILIZADORES = {
            "tableId": 'WEB_ADM_UTILIZADORES',
            "table": "WEB_ADM_UTILIZADORES", 
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_user; ?>",
            "pk": {
                "primary": {                    
                    "ID": {"type": "number"}
                }
            },
            "crudOnMasterInactive": {
                "condition": "data.ESTADO === 'B'",
                "acl": {
                    "create": false,
                    "update": false,
                    "delete": false
                }
            },
            "detailsObjects": ['WEB_ADM_PERFIS_UTILIZADORES'],
            "order_by": "ID",
            "scrollY": "234", 
            "recordBundle": 7,
            "pageLenght": 7, 
            "tableCols": [
                {
                    "responsivePriority": 1,
                    "data": null,
                    "width": "1%", 
                    "className": "control toBottom toCenter",
                    "orderable": false,
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
                    "title": "<?php echo mb_strtoupper($ui_user, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_user; ?>",
                    "data": 'UTILIZADOR',
                    "name": 'UTILIZADOR',
                    "className": "visibleColumn"
                }, {
                    "responsivePriority": 4,
                    "title": "<?php echo mb_strtoupper($ui_password, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_password; ?>",
                    "data": 'PASSWORD',
                    "name": 'PASSWORD',
                    "type": "password", //Editor
                    "visible": false,
                    "className": "visibleColumn",
                    "attr": {
                        "autocomplete": "new-password"
                    }
                }, {
                    "responsivePriority": 5,                    
                    "title": "<?php echo mb_strtoupper($ui_type, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_type; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_user_helpdesk_suport; ?>",
                    "data": 'HELPDESK_SUPORTE',
                    "name": 'HELPDESK_SUPORTE',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'WEB_ADM_UTILIZADORES.HELPDESK_SUPORTE',
                        "class": "form-control"
                    }
                }, {
                    "responsivePriority": 6,                    
                    "title": "<?php echo mb_strtoupper($ui_status, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_status; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_user_authorized . "?"; ?>",
                    "data": 'ESTADO',
                    "name": 'ESTADO',
                    "type": "select",
                    "def": "A",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'WEB_ADM_UTILIZADORES.ESTADO',
                        "class": "form-control"
                    },
                    "render": function (val, type, row) {
                        if (val != null) {
                            var o = _.find(initApp.joinsData['WEB_ADM_UTILIZADORES.ESTADO'], {'RV_LOW_VALUE': val});
                            return val == null ? null : o['RV_MEANING'];
                        }
                        return val;
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'RHID',
                    "name": 'RHID',
                    "type": "hidden",
                    "visible": false,
                    "className": "",  
                }, {
                    "responsivePriority": 7,
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_rhid, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_rhid; ?>",
                    "data": 'NOME',
                    "name": 'NOME',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                                        
                    "attr": {
                        "dependent-group": "COLABS",
                        "dependent-level": 1,
                        "data-db-name": 'A.RHID',
                        //"distribute-value": "EMPRESA@RHID@DT_ADMISSAO",
                        "decodeFromTable": 'QUAD_NAMES A',
                        "desigColumn": "CONCAT(CONCAT(A.RHID,'-'),A.NOME)", 
                        "orderBy": "A.RHID", 
                        "class": "form-control complexList chosen"                        
                    }    
                }, {
                    "responsivePriority": 11,
                    "title": "<?php echo mb_strtoupper($ui_email, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_email; ?>", //Editor
                    "data": 'EMAIL',
                    "name": 'EMAIL',
                    "className": "visibleColumn"                  
                }, {
                    "responsivePriority": 12,
                    "title": "<?php echo mb_strtoupper($ui_mobile, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_mobile; ?>", //Editor
                    "data": 'TELEMOVEL',
                    "name": 'TELEMOVEL',
                    "className": "visibleColumn"
                }, {
                    "responsivePriority": 8,
                    "title": "<?php echo mb_strtoupper($ui_reset, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_reset; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_reset_password; ?>",
                    "data": 'PEDE_PWD',
                    "name": 'PEDE_PWD',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',
                        "class": "form-control"
                    }            
                }, {
                    //"targets": 6,
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'LANG',
                    "name": 'LANG',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                }, {
                    "responsivePriority": 9,
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_language, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_language; ?>",
                    "data": 'DSP_LINGUA',
                    "name": 'DSP_LINGUA',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "dependent-group": "LANG",
                        "dependent-level": 1,
                        "data-db-name": 'A.CD_LINGUA',
                        "distribute-value": "LANG",
                        "decodeFromTable": 'DG_LINGUAS_ESTRANGEIRAS A',
                        "class": "form-control complexList chosen", 
                        "desigColumn": "A.DSR_LINGUA",                
                        "orderBy": "A.NR_ORDEM, A.CD_LINGUA",
                        "filter": {
                            "create": " AND A.ATIVO = 'S'", 
                            "edit": " AND A. ATIVO = 'S'",
                        }                        
                    }
                }, {
                    "responsivePriority": 10,
                    "title": "<?php echo mb_strtoupper($ui_ldap_user, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_ldap_user; ?>", //Editor
                    "data": 'LDAP_USER',
                    "name": 'LDAP_USER',
                    "className": "none visibleColumn"
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
                    "title": '',
                    "data": null,
                    "name": 'NEW_PASSWORD',
                    "type": "hidden",
                    "width": "1%",
                    "className": "toBottom toCenter",
                    "render": function (val, type, row) {
                        //debugger;
                        return '<button type="button" title="<?php echo $ui_new_password;?>" class="btn btn-xs btn-default newPassword"><i class="fas fa-key fa-sm"></i></button>';
                    } 
                }, {
                    "responsivePriority": 1,
                    "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
                    "data": null,
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        //debugger;
                        return WEB_ADM_UTILIZADORES.crudButtons(true,true,true); //CREATE, UPDATE, DELETE
                    } 
                }
            ],
            "validations": {
                "rules": {
                    "UTILIZADOR": { 
                        required: true,
                        maxlength: 30
                    },
                    "PASSWORD": {
                        required: true,
                        maxlength: 30
                    },
                    "ESTADO": { 
                        required: true,
                    },
                    "EMAIL": {
                        maxlength: 80
                    },
                    "TELEMOVEL": {
                        maxlength: 30
                    },
                    "PEDE_PWD": { 
                        required: true,
                    },
                    "LANG": { 
                        required: true,
                    }
                },
            },              
        };
        WEB_ADM_UTILIZADORES = new QuadTable();
        WEB_ADM_UTILIZADORES.initTable( $.extend( {}, datatable_instance_defaults, optionsWEB_ADM_UTILIZADORES ) );        
        //END Users

        if ( 1 === 1 ) {        
            $(document).on('click','button.newPassword', function(evt) {
                var id_ = $(this).closest('td').closest('tr').find("td:nth(1)").text();
                console.log($(this).closest('td').closest('tr').find("td:nth(1)").text());
            });
        }
        
        //Users Profiles
        var optionWEB_ADM_PERFIS_UTILIZADORES = {
            "tableId": 'WEB_ADM_PERFIS_UTILIZADORES',
            "table": "WEB_ADM_PERFIS_UTILIZADORES", // table in database
            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_profile; ?>",
            "pk": {
                "primary": {
                    "ID_PERFIL": {"type": "number"},
                    "ID_UTILIZADOR": {"type": "number"}
                }
            },
            "dependsOn": {
                "WEB_ADM_UTILIZADORES": {
                    "ID_UTILIZADOR": "ID"
                }
            },
            "detailsObjects": ['WEB_ADM_FILTROS'],
            "order_by": "ESTADO, ID_PERFIL",
            "order": false,
            "scrollY": "234", 
            "recordBundle": 7,
            "pageLenght": 7, 
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
                    "data": 'ID_UTILIZADOR',
                    "name": 'ID_UTILIZADOR',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                    "className": "visibleColumn"
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_PERFIL',
                    "name": 'ID_PERFIL',
                    "type": "hidden", //Editor
                    "visible": false //DataTables
                }, {
                    "responsivePriority": 2,
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_profile, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_profile; ?>",
                    "data": 'DSP_PERFIL',
                    "name": 'DSP_PERFIL',
                    "type": "select",
                    "className": "visibleColumn",
                    //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                    "attr": {
                        "dependent-group": "PERFIS",
                        "dependent-level": 1,
                        "data-db-name": "A.ID",
                        "distribute-value": "ID_PERFIL",
                        "decodeFromTable": "WEB_ADM_PERFIS A",  //TO CHANGE ON QUAD-HCM
                        "desigColumn": "A.DSP_PERFIL", 
                        "orderBy": "A.NR_ORDEM",
                        "class": "form-control complexList chosen"
                    }                   
                }, {
                    "responsivePriority": 5,                    
                    "title": "<?php echo mb_strtoupper($ui_status, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_status; ?>", //Editor
                    "fieldInfo": "<?php echo $hint_user_authorized . "?"; ?>",
                    "data": 'ESTADO',
                    "name": 'ESTADO',
                    "type": "select",
                    "def": "A",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'WEB_ADM_UTILIZADORES.ESTADO',
                        "class": "form-control"
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'INSERTED_BY',
                    "name": 'INSERTED_BY',
                    "type": "hidden", //Editor
                    "visible": false //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INSERTED',
                    "name": 'DT_INSERTED',
                    "type": "hidden", //Editor
                    "visible": false //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CHANGED_BY',
                    "name": 'CHANGED_BY',
                    "type": "hidden", //Editor
                    "visible": false //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_UPDATED',
                    "name": 'DT_UPDATED',
                    "type": "hidden", //Editor
                    "visible": false //DataTables
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
                    "title": "",
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        return WEB_ADM_PERFIS_UTILIZADORES.crudButtons(true, true, true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "ID_PERFIL": {
                        required: true
                    },
                    "ESTADO": {
                        required: true
                    }
                }
            }
        };        
        WEB_ADM_PERFIS_UTILIZADORES = new QuadTable();
        WEB_ADM_PERFIS_UTILIZADORES.initTable( $.extend({}, datatable_instance_defaults, optionWEB_ADM_PERFIS_UTILIZADORES));            
        //END Users Profiles   
        
        //Extend Buttons :: Custom Buttons<i class=""></i>
        var extendedButtons = datatable_instance_defaults.buttons,
            new_buttons =   { //Seguir em QuadCore.js :: buttonManagerCentralized
                                "text": '<i class="fas fa-layer-group fa-lg" aria-hidden="true"></i>',
                                "className": 'quad-left-padding-5 dt-button buttons-excel buttons-html5 btn btn-default btn-xs',
                                "titleAttr": "<?php echo $ui_get_all_estabs; ?>",
                                "action": function (e, dt, button, config) {
                                    getAllEstabs();
                                }
                            };
            extendedButtons.push(new_buttons);

        //Restrictions BY User + Profile
        var optionWEB_ADM_FILTROS = {
            "tableId": 'WEB_ADM_FILTROS',
            "table": "WEB_ADM_FILTROS", // table in database
            "pk": {
                "primary": {
                    "ID": {"type": "number"},
//LEO : Estas colunas não pertencem à chave desta tabela, e comentando-as aparece o problema reportado quando se insere.
//Não testei as outras operações (UPDATE e DELETE) embora acredite que nesses caso tudo funcione. Deverá confirmar...
                    "ID_PERFIL": {"type": "number"},
                    "ID_UTILIZADOR": {"type": "number"}
                }
            },
            "dependsOn": {
                "WEB_ADM_PERFIS_UTILIZADORES": {
                    "ID_PERFIL": "ID_PERFIL",
                    "ID_UTILIZADOR": "ID_UTILIZADOR"
                }
            },
            "order_by": "ID",
            "order": false,
            "scrollY": "234", 
            "recordBundle": 7,
            "pageLenght": 7, 
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
                    "data": 'ID',
                    "name": 'ID',
                    "datatype": 'sequence',
                    "type": "hidden",
                    "visible": false,
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_UTILIZADOR',
                    "name": 'ID_UTILIZADOR',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables
                    "className": "visibleColumn"
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'ID_PERFIL',
                    "name": 'ID_PERFIL',
                    "type": "hidden", //Editor
                    "visible": false //DataTables
                }, {
                    //"targets": 1,
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'EMPRESA',
                    "name": 'EMPRESA',
                    "type": "hidden",
                    "visible": false,
                    "className": "",  
                }, {
                    "responsivePriority": 2,
                    "complexList": true, 
                    "title": "<?php echo mb_strtoupper($ui_company, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_company; ?>",
                    "fieldInfo": "<?php echo $hint_use_to_narrow_down_scope; ?>",
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
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CD_ESTAB',
                    "name": 'CD_ESTAB',
                    "type": "hidden", //Editor
                    "visible": false, //DataTables                        
                }, {
                    responsivePriority: 3,
                    "complexList": true,
                    "title": "<?php echo mb_strtoupper($ui_establishment, 'UTF-8'); ?>",
                    "label": "<?php echo $ui_establishment; ?>",
                    "data": 'DSP_ESTAB',
                    "name": 'DSP_ESTAB',
                    "className": "visibleColumn",
                    "type": "select",
                    "attr": {
                        "dependent-group": "EMPRESA",
                        "dependent-level": 2,
                        "data-db-name": 'A.EMPRESA@A.CD_ESTAB',
                        "decodeFromTable": 'DG_ESTABELECIMENTOS',
                        "class": "form-control complexList chosen",
                        "desigColumn": "NVL(A.DSR_ESTAB,A.DSP_ESTAB)",
                        "orderBy": "A.CD_ESTAB",
                        "filter": {
                            "create": " AND A.ACTIVO = 'S' ", //On-New-Record
                            "edit": " AND A.ACTIVO = 'S' ", //On-Edit-Record
                        }
                    }                    
                }, {
                    "responsivePriority": 4,                    
                    "title": "<?php echo mb_strtoupper($ui_interdict_access, 'UTF-8'); ?>", //Datatables
                    "label": "<?php echo $ui_interdict_access; ?>", //Editor
                    //"fieldInfo": "<?php echo $hint_user_authorized . "?"; ?>",
                    "data": 'ATIVO',
                    "name": 'ATIVO',
                    "type": "select",
                    "className": "visibleColumn",
                    "attr": {
                        "domain-list": true,
                        "dependent-group": 'DG_SIM_NAO',
                        "class": "form-control"
                    }
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'INSERTED_BY',
                    "name": 'INSERTED_BY',
                    "type": "hidden", //Editor
                    "visible": false //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_INSERTED',
                    "name": 'DT_INSERTED',
                    "type": "hidden", //Editor
                    "visible": false //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'CHANGED_BY',
                    "name": 'CHANGED_BY',
                    "type": "hidden", //Editor
                    "visible": false //DataTables
                }, {
                    "title": "", //Datatables
                    "label": "", //Editor
                    "data": 'DT_UPDATED',
                    "name": 'DT_UPDATED',
                    "type": "hidden", //Editor
                    "visible": false //DataTables
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
                    "title": "",
                    "name": 'BUTTONS',
                    "type": "hidden",
                    "width": "6%",
                    "className": "toBottom toCenter",
                    "render": function () {
                        return WEB_ADM_FILTROS.crudButtons(true, true, true);
                    }
                }
            ],
            "validations": {
                "rules": {
                    "DSP_EMPRESA": {
                        required: true
                    },
                    "DSP_ESTAB": {
                        required: true
                    },
                    "ATIVO": {
                        required: true
                    }
                }
            },
            extendedButtons
        };        
        WEB_ADM_FILTROS = new QuadTable();
        WEB_ADM_FILTROS.initTable( $.extend({}, datatable_instance_defaults, optionWEB_ADM_FILTROS));            
        //END Restrictions BY User + Profile
        
        //WORKER :: Extra Buttons :: Get ALL Estabs
        var getAllEstabs = function () {
            var rowMaster = WEB_ADM_PERFIS_UTILIZADORES.tbl.rows( '.selected' ).data()[0]; //['FASE'];
            quad_notification_clear();
            if (!rowMaster) {
                quad_notification({
                    type: "info",
                    title: JS_OPERATION_ABORT,
                    content: "<?php echo $ui_please_select_record . $ui_profile; ?>",
                    timeout: 2500
                });
            } else {
                var t0 = performance.now(),
                    wk = new Worker(pn + "lib/quad/workerRouter.js"),
                    message = {
                        request_id: 'CreateUserProfileAccessesAllEstabs',
                        data: rowMaster,
                        defaults: datatable_instance_defaults.pathToSqlFile
                    },
                    mssg = '';
                wk.postMessage(JSON.stringify(message));
                wk.onmessage = function (event) {                
                    if (event.data === 'working') {
                        WEB_ADM_FILTROS.showProcess("<?php echo $process_disabling_all_estabs; ?>"); //Process ID;
                        return;
                    } else {
                        t1 = performance.now();
                        tmp = millisToMinutesAndSeconds(t1 - t0);
                        if (event.data) {
                            if (event.data.msg === 'OK') {
                                $(document).find('#switch_WEB_ADM_FILTROS').trigger('click');
                                $(document).find('#refresh_WEB_ADM_FILTROS').trigger('click');
                            } else {
                                var mssg = event.data.error;
                                quad_notification({
                                        type: "error",
                                        id: "Workflow",
                                        title : JS_OPERATION_ERROR,
                                        content : '<i class="glyphicon glyphicon-thumbs-down"></i>&nbsp;<i>' + mssg + '</i>'
                                });                                        
                            }
                        }
                    }
                    WEB_ADM_FILTROS.hideProcess();                    
                };                 
            }
        }            
        //END WORKER :: Extra Buttons :: Get ALL Estabs
        
    });
</script>
