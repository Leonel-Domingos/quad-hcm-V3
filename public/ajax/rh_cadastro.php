<?php
    require_once '../init.php';
    
    /* CRUD + WorkFlow */
    $wkf_error = array();
    $thisFile = __FILE__;
    $thisFile = 'rh_cadastro';
    //FILENAME :: To compose ERROR available to JS (FASE 2)
    $frm = strtoupper( basename($thisFile,'.php') );
    //CHECK IF FILE EXISTS AND IS JSON 
    $frm_definitions = go_no_go($thisFile, $wkf_error, $seconds);
    //echo "<br>". "( $seconds )" . "<br>". $frm_definitions;

?>
<style>
    .photoButtons a {
        margin-left: 0.25em;
    }
    #employeeFilter > div > div > span {
        z-index: 99999;
        height: 32px;
        border-top-left-radius: 5px !important;
        border-bottom-left-radius: 5px !important;
    }
    
    #xt_RHID_chosen {
        position: absolute;
        left: 89px;
        min-width: 300px !important;
        z-index: 1;
    }
    
    .chosen-container-single .chosen-single abbr:hover {
        background-position: -42px -9px;
    }
    #xt_RHID_chosen > a {
        border-top-left-radius: 0px !important;
        border-bottom-left-radius: 0px !important;
        padding: .20rem .65rem;
        height: 37px;
        line-height: 32px;
    }   
    
    #xt_RHID_chosen {
      border: 0px; /* Removes ERROR class effect */
    }
    
    /* PHOTO */
    div.fotoGraph {
        position: absolute;
        left: 83%;
        display: table-cell;
        vertical-align: middle;
        float: none;
        text-align: center;
        height: 219px;
    }

    #borderframe {
        transition: all .3s ease-in-out;
    }

    #drop {
        min-height: 212px;
    }
    
    #photograph {
        width: 100%;
        object-fit: contain;
        height: auto;
        max-height: -webkit-fill-available;
        padding: 10px;
    }
    
    #RH_IDENTIFICACOES fieldset{
        position: initial;
    }
    
    /* Portrait tablets and small desktops */
    @media (min-width: 768px) and (max-width: 991px) {
        div.fotoGraph {
            position: inherit;
            left: unset;
            vertical-align: middle;
            display: table-cell;
            vertical-align: middle;
            float: none;
            text-align: center;
            height: 219px;
        }
    }

    /* Landscape phones and portrait tablets */
    @media (max-width: 767px) {
        div.fotoGraph {
            position: inherit;
            left: unset;
            vertical-align: middle;
            display: table-cell;
            vertical-align: middle;
            float: none;
            text-align: center;
            height: 219px;
        }

    }

    /* Portrait phones and smaller */
    @media (max-width: 480px) {
        div.fotoGraph {
            position: inherit;
            left: unset;
            vertical-align: middle;
            display: table-cell;
            vertical-align: middle;
            float: none;
            text-align: center;
            height: 219px;
        }

    }
    /* END PHOTO */

.disableInputAccessClone + .tooltip.auto > div.tooltip-inner {
    background-color: #ff00007a;
}    


/* CHOSENs ON LAST LINE, RESULTS MUST GROW to SHOW ALL RESULTS :: DSP_PAIS_CORRESPONDENCIA, DSP_MOEDA_NIB4 */
#RH_IDENTIFICACOES > fieldset:nth-child(9) > div:nth-child(3) > div > div > div:nth-child(2) > div.chosen-container,
#RH_ID_RETRIBUTIVOS > fieldset:nth-child(10) > div > div > div > div:nth-child(4) > div.chosen-container {
    max-height: fit-content;
}

/* TX_FIXA_IRS */
#RH_ID_RETRIBUTIVOS > fieldset:nth-child(5) > div:nth-child(2) > div > div > div:nth-child(8) > input {
    max-width: 89px;
}
/* DT_REGIME_SINDICAL, VLR_BI_TB */
#RH_ID_RETRIBUTIVOS > fieldset:nth-child(6) > div:nth-child(3) > div > div > div.col-md-3.inlineFlex > input,
#RH_ID_RETRIBUTIVOS > fieldset:nth-child(7) > div > div > div > div.col-md-3.inlineFlex.errorDown > input {
    margin-right: -4px;
}


</style>
<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            
            <div class="panel-hdr">
                <span class="widget-icon"> <i class="fas fa-user-edit"></i></span>&nbsp;
                <h2><?php echo $ui_cadastre; ?></h2>
            </div>

            <div class="panel-container show">
                <!-- TOP FILTER OR INSTANCE -->
                <div class="panel-content">
                    <div class="form-group" style="margin-bottom: -15px;">
                        <form id="employeeFilter" style="" class="form-inline multiInstance"  style="display:block;">
                                <div class="form-group col-xs-9 col-sm-5 col-md-5 col-lg-5" style="display:block;height:57px; align-content: baseline;">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fa fa-search"></i>
                                                &nbsp;<?php echo $ui_rhid; ?> 
                                                <sup><i class="fas fa-asterisk"></i></sup>
                                            </span>
                                        </div>
                                        <select name="RHID" id="xt_RHID" class="form-control chosen"></select>
                                        <div class='alert alert-danger fade in quadAlert' style="display:none;"></div>
                                    </div>
                                    <span class="help-block">Quad-Alert goes here</span>
                                </div>     
                                <div class="form-group col-xs-3 col-sm-7 col-md-7 col-lg-7 text-right" style="display:block;height:57px; align-content: baseline;">
                                    <button class="btn btn-labeled btn-primary masterFilter">
                                        <span class="btn-label"><i class="fas fa-filter"></i></span>
                                        <?php echo $ui_set_filter; ?>
                                    </button>
                                </div>
                        </form>
                    </div>
                </div>
                <!-- END TOP FILTER OR INSTANCE -->

                <!-- TABS MENUS -->
                <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-end">
                    <div class="panel-toolbar pr-3 align-self-end">
                        <ul id="demo_panel-tabs" class="nav nav-tabs nav-scroller border-bottom-0 justify-content-end" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#Tab1" role="tab" aria-selected="true"><?php echo $ui_rhid_folder_identification; ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#Tab2" role="tab" aria-selected="true"><?php echo $ui_rhid_folder_company; ?> </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#Tab3" role="tab" aria-selected="true"> <?php echo $ui_documents_short . ' / ' . $ui_rhid_folder_household; ?> </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#Tab4" role="tab" aria-selected="true"><?php echo $ui_rhid_folder_qualifications; ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#Tab5" role="tab" aria-selected="true"><?php echo $ui_rhid_folder_flexfields; ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#Tab6" role="tab" aria-selected="true"><?php echo $ui_rhid_folder_curriculum; ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#Tab7" role="tab" aria-selected="true"><?php echo $ui_rhid_folder_strategic_management; ?></a>
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
                                <form action="" id="RH_IDENTIFICACOES" class="form-horizontal quadFormInstanceWithInvertedRules" novalidate="novalidate">
                                    <div class="quad-alert"></div>
                                    <form-toolbar></form-toolbar>
                                    <fieldset>
                                        <legend><?php echo $ui_identification; ?></legend>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <input id="myfile" type="file"  name ="BD_DOC" >
                                                    <input id="myfile2" type="hidden"  name ="LINK_DOC">
                                                    <input id="myfile3" type="hidden"  name ="BD_MIME">
                                                    <label class="col-md-2 control-label" for="RHID"><?php echo $ui_rhid; ?></label>
                                                    <div class="col-md-2">
                                                        <input class="form-control toRight visibleColumn" name="RHID">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-2 control-label nobreak shorten"for="NOME"><?php echo $ui_name; ?></label>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control visibleColumn" name="NOME">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-2 control-label nobreak shorten" for="NOME_REDZ"><?php echo $ui_name_short; ?></label>
                                                    <div class="col-md-7">
                                                        <input class="form-control visibleColumn" name="NOME_REDZ">
                                                    </div>

                                                    <label class="col-md-2 control-label nobreak shorten" for="ACRONIMO"><?php echo $ui_acronym; ?></label>
                                                    <div class="col-md-1">
                                                        <input class="form-control visibleColumn" name="ACRONIMO">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-2 control-label nobreak shorten" for="GENERO"><?php echo $ui_gender; ?></label>
                                                    <div class="col-md-2">
                                                        <select class="form-control visibleColumn" name="GENERO"></select>
                                                    </div>

                                                    <div class="visible-xs visible-sm"><br></div>
                                                    <label class="col-md-2 control-label nobreak shorten" for="DT_NASCIMENTO"><?php echo $ui_birthdate_short; ?></label>
                                                    <div class="col-md-2">
                                                        <input class="form-control datepicker visibleColumn" data-datatype="date" name="DT_NASCIMENTO">
                                                    </div>

                                                    <label class="col-md-2 control-label nobreak shorten" for="TITULO"><?php echo $ui_title; ?></label>
                                                    <div class="col-md-2">
                                                        <input class="form-control visibleColumn" name="TITULO">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-2 control-label nobreak shorten" for="ESTADO_CIVIL"><?php echo $ui_family_status; ?></label>
                                                    <div class="col-md-2">
                                                        <select class="form-control visibleColumn" name="ESTADO_CIVIL"></select>
                                                    </div>

                                                    <label class="col-md-2 control-label nobreak shorten" for="DT_ESTADO_CIVIL"><?php echo $ui_family_status_date; ?></label>
                                                    <div class="col-md-2">
                                                        <input class="form-control datepicker visibleColumn" data-datatype="date" name="DT_ESTADO_CIVIL">
                                                    </div>

                                                    <label class="col-md-2 control-label nobreak shorten" for="DSP_NACIONALIDADE"><?php echo $ui_nationality; ?></label>
                                                    <div class="col-md-2">
                                                        <select class="form-control complexList chosen visibleColumn" name="DSP_NACIONALIDADE"></select>
                                                    </div>

                                                </div>

                                            </div>

                                            <!-- FOTOGRAFIA -->
                                            <div class="col-md-2 fotoGraph">
                                                <div id="borderframe" class="text-center">
                                                    <div id="drop" class="dropimg_">
                                                        <img id="photograph" alt="" class="dropzone-previews" src="<?php echo ASSETS_URL . '/img/fotos/user-alt.svg'; ?>"/>
                                                        <div class="photoButtons"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End FOTOGRAFIA -->
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <legend><?php echo $ui_contacts; ?></legend>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label nobreak shorten" for="EMAIL"><?php echo $ui_email; ?></label>
                                                    <div class="col-md-4">
                                                        <input class="form-control visibleColumn" name="EMAIL">
                                                    </div>

                                                    <label class="col-md-2 control-label nobreak shorten" for="EMAIL_PESSOAL"><?php echo $ui_private_email; ?></label>
                                                    <div class="col-md-4">
                                                        <input class="form-control visibleColumn" name="EMAIL_PESSOAL">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label nobreak shorten" for="TELEMOVEL_1"><?php echo $ui_mobile . " #1"; ?></label>
                                                    <div class="col-md-4">
                                                        <input class="form-control visibleColumn" name="TELEMOVEL_1">
                                                    </div>

                                                    <label class="col-md-2 control-label nobreak shorten"
                                                           for="TELEMOVEL_2"><?php echo $ui_mobile . " #2"; ?></label>
                                                    <div class="col-md-4">
                                                        <input class="form-control visibleColumn" name="TELEMOVEL_2">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label nobreak shorten" for="TELEFONE_RES"><?php echo $ui_residential_phone; ?></label>
                                                    <div class="col-md-4">
                                                        <input class="form-control visibleColumn" name="TELEFONE_RES">
                                                    </div>

                                                    <label class="col-md-2 control-label nobreak shorten" for="CONTACTO_EMERG"><?php echo $ui_emergency_contact; ?></label>
                                                    <div class="col-md-4">
                                                        <input class="form-control visibleColumn" name="CONTACTO_EMERG">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <legend><?php echo $ui_place_of_birth; ?></legend>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label nobreak shorten" for="DSP_NATURALIDADE"><?php echo $ui_country; ?></label>
                                                    <div class="col-md-4">
                                                        <select class="form-control complexList chosen visibleColumn" name="DSP_NATURALIDADE"></select>
                                                    </div>

                                                    <label class="col-md-2 control-label nobreak shorten" for="DSP_DISTRITO"><?php echo $ui_district; ?></label>
                                                    <div class="col-md-4">
                                                        <select class="form-control complexList chosen visibleColumn" name="DSP_DISTRITO"></select>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label nobreak shorten" for="DSP_CONCELHO"><?php echo $ui_municipality; ?></label>
                                                    <div class="col-md-4">
                                                        <select class="form-control complexList chosen visibleColumn" name="DSP_CONCELHO"></select>
                                                    </div>

                                                    <label class="col-md-2 control-label nobreak shorten" for="DSP_FREGUESIA"><?php echo $ui_parish; ?></label>
                                                    <div class="col-md-4">
                                                        <select class="form-control complexList chosen visibleColumn" name="DSP_FREGUESIA"></select>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </fieldset>

                                    <fieldset>
                                        <legend><?php echo $ui_home_address; ?></legend>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label nobreak shorten" for="MORADA_RES"><?php echo $ui_address; ?></label>
                                                    <div class="col-md-4">
                                                        <input class="form-control visibleColumn" name="MORADA_RES">
                                                    </div>

                                                    <label class="col-md-2 control-label nobreak shorten" for="LOCALIDADE_RES"><?php echo $ui_locale; ?></label>
                                                    <div class="col-md-4">
                                                        <input class="form-control visibleColumn" name="LOCALIDADE_RES">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label nobreak shorten" for="DSP_PAIS_RESIDENCIA"><?php echo $ui_country; ?></label>
                                                    <div class="col-md-4">
                                                        <select class="form-control complexList chosen visibleColumn" name="DSP_PAIS_RESIDENCIA"></select>
                                                    </div>

                                                    <label class="col-md-2 control-label nobreak shorten" for="CD_POSTAL_RES"><?php echo $ui_postal_code; ?></label>
                                                    <div class="col-md-4 inlineFlex">
                                                        <input class="form-control visibleColumn" name="CD_POSTAL_RES" style="width:80px; ">
                                                        <input class="form-control quad-ml-4 visibleColumn" name="NR_ORDEM_RES" style="width:80px;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <legend><?php echo $ui_postal_address; ?></legend>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label nobreak shorten" for="MORADA_COR"><?php echo $ui_address; ?></label>
                                                    <div class="col-md-4">
                                                        <input class="form-control visibleColumn" name="MORADA_COR">
                                                    </div>

                                                    <label class="col-md-2 control-label nobreak shorten" for="LOCALIDADE_COR"><?php echo $ui_locale; ?></label>
                                                    <div class="col-md-4">
                                                        <input class="form-control visibleColumn" name="LOCALIDADE_COR">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="form-group lastGroup">
                                                    <label class="col-md-2 control-label nobreak shorten" for="DSP_PAIS_CORRESPONDENCIA"><?php echo $ui_country; ?></label>
                                                    <div class="col-md-4">
                                                        <select class="form-control complexList chosen visibleColumn" name="DSP_PAIS_CORRESPONDENCIA"></select>
                                                    </div>

                                                    <label class="col-md-2 control-label nobreak shorten" for="CD_POSTAL_COR"><?php echo $ui_postal_code; ?></label>
                                                    <div class="col-md-4 inlineFlex">
                                                        <input class="form-control visibleColumn" name="CD_POSTAL_COR" style="width:80px;">
                                                        <input class="form-control quad-ml-4 visibleColumn" name="NR_ORDEM_COR" style="width:80px;">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="Tab2" role="tabpanel">
                                <a id="RH_ID_EMPRESAS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                <table id="RH_ID_EMPRESAS" class="table responsive table-bordered table-striped table-hover nowrap"></table>

                                <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-start">
                                    <div class="panel-toolbar pr-3 align-self-end">
                                        <ul id="panel-tab-2-1" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="#Tab21" role="tab" aria-selected="true"><?php echo $ui_details; ?></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#Tab22" role="tab" aria-selected="false"><?php echo $ui_remuneration_elements; ?></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#Tab23" role="tab" aria-selected="false"><?php echo $ui_rhid_folder_classifications; ?></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#Tab24" role="tab" aria-selected="false"><?php echo $ui_remunerations; ?></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#Tab25" role="tab" aria-selected="false"><?php echo $ui_structure; ?></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#Tab26" role="tab" aria-selected="false"><?php echo $ui_workflows; ?> </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-container show boxSubTab">
                                    <div class="panel-content">
                                        <div class="tab-content">
                                            <div class="tab-pane fade active show" id="Tab21" role="tabpanel">
                                                <form id="RH_ID_EMPRESAS_CONTINUED" class="form-horizontal" novalidate="novalidate">
                                                    <div class="quad-alert"></div>
                                                    <form-toolbar></form-toolbar>
                                                    <fieldset>
                                                        <legend><?php echo $ui_establishment; ?></legend>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="col-md-2 control-label nobreak shorten" for="DSP_ESTAB_TMP"><?php echo $ui_temporary_establishment; ?></label>
                                                                    <div class="col-md-4">
                                                                        <select class="form-control complexList chosen visibleColumn" name="DSP_ESTAB_TMP"></select>
                                                                    </div>

                                                                    <label class="col-md-1 control-label nobreak shorten" for="DT_ESTAB_TMP"><?php echo $ui_date; ?></label>
                                                                    <div class="col-md-1">
                                                                        <input class="form-control datepicker visibleColumn" data-datatype="date" name="DT_ESTAB_TMP">
                                                                    </div>
                                                                </div>            
                                                            </div>
                                                        </div>
                                                    </fieldset>

                                                    <fieldset>
                                                        <legend><?php echo $ui_work_modality; ?></legend>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="col-md-2 control-label nobreak shorten" for="TIPO_TRABALHO"><?php echo $ui_work_type; ?></label>
                                                                    <div class="col-md-4">
                                                                        <select class="form-control domainLists visibleColumn" name="TIPO_TRABALHO"></select>
                                                                    </div>

                                                                    <label class="col-md-2 control-label nobreak shorten" for="EMP_TRAB_TEMP"><?php echo $ui_temporary_work_agency; ?></label>
                                                                    <div class="col-md-4">
                                                                        <select class="form-control domainLists chosen visibleColumn" name="EMP_TRAB_TEMP"></select>
                                                                    </div>
                                                                </div>            
                                                            </div>
                                                        </div>
                                                    </fieldset>

                                                    <fieldset>
                                                        <legend><?php echo $ui_internal_numbers; ?></legend>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group lastGroup">
                                                                    <label class="col-md-2 control-label nobreak shorten" for="NR_MECANOGRAFICO"><?php echo $ui_mechanographic; ?></label>
                                                                    <div class="col-md-2">
                                                                        <div>
                                                                            <input class="form-control visibleColumn"
                                                                                   name="NR_MECANOGRAFICO">
                                                                        </div>
                                                                    </div>

                                                                    <label class="col-md-1 control-label nobreak" for="NR_INTERNO"><?php echo '#1 / #2'; ?></label>
                                                                    <div class="col-md-2 inlineFlex">
                                                                        <input class="form-control" name="NR_INTERNO"> 
                                                                            <label class="middleText quad-ml-4 visibleColumn"> / </label>
                                                                        <input class="form-control quad-ml-4 visibleColumn"name="NR_INTERNO_2">
                                                                    </div>


                                                                    <label class="col-md-1 control-label nobreak shorten" for="TELEFONE"><?php echo $ui_phone; ?></label>
                                                                    <div class="col-md-2">
                                                                        <div>
                                                                            <input class="form-control visibleColumn" name="TELEFONE">
                                                                        </div>
                                                                    </div>
                                                                    <label class="col-md-1 control-label nobreak shorten" for="EXTENSAO"><?php echo $ui_extention; ?></label>
                                                                    <div class="col-md-1">
                                                                        <div>
                                                                            <input class="form-control visibleColumn" name="EXTENSAO">
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                        </div>
                                                    </fieldset>
                                                </form>
                                            </div>
                                            <div class="tab-pane fade" id="Tab22" role="tabpanel">
                                                <form id="RH_ID_RETRIBUTIVOS" class="form-horizontal" novalidate="novalidate">
                                                    <div class="quad-alert"></div>
                                                    <form-toolbar></form-toolbar>
                                                    <fieldset>
                                                        <legend><?php echo $ui_cirs; ?></legend>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="col-md-2 control-label nobreak shorten" for="TP_IRS"><?php echo $ui_type; ?></label>
                                                                    <div class="col-md-2">
                                                                        <select class="form-control domainLists chosen visibleColumn" name="TP_IRS"></select>
                                                                    </div>

                                                                    <label class="col-md-1 control-label nobreak shorten" for="TABELA_IRS"><?php echo $ui_table; ?></label>
                                                                    <div class="col-md-2">
                                                                        <select class="form-control domainLists chosen visibleColumn" name="TABELA_IRS"></select>
                                                                    </div>


                                                                    <label class="col-md-1 control-label nobreak shorten" for="NR_TITULARES"><?php echo $ui_number_of_holders; ?></label>
                                                                    <div class="col-md-1">
                                                                        <input class="form-control quad-ml-4 toRight visibleColumn" name="NR_TITULARES">
                                                                    </div>

                                                                    <label class="col-md-1 control-label nobreak shorten" for="TX_FIXA_IRS"><?php echo $ui_flat_rate; ?></label>
                                                                    <div class="col-md-1">
                                                                        <input class="form-control quad-ml-4 toRight visibleColumn" name="TX_FIXA_IRS">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="col-md-2 control-label nobreak shorten" for="EST_CIVIL_IRS"><?php echo $ui_cirs_status; ?></label>
                                                                    <div class="col-md-2">
                                                                        <select class="form-control domainLists chosen visibleColumn" name="EST_CIVIL_IRS"></select>
                                                                    </div>

                                                                    <label class="col-md-1 control-label nobreak shorten" for="GRAU_DEFICIENCIA"><?php echo $ui_disability_degree_short; ?></label>
                                                                    <div class="col-md-2">
                                                                        <select class="form-control domainLists chosen visibleColumn" name="GRAU_DEFICIENCIA"></select>
                                                                    </div>


                                                                    <label class="col-md-1 control-label nobreak shorten" for="REPARTICAO_FISCAL"><?php echo $ui_tax_office_short; ?></label>
                                                                    <div class="col-md-3">
                                                                        <select class="form-control domainLists chosen visibleColumn" name="REPARTICAO_FISCAL"></select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>    
                                                    </fieldset>

                                                    <fieldset>
                                                        <legend><?php echo $ui_rewards_accounting_syndicalism; ?></legend>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="col-md-2 control-label nobreak shorten" for="DSP_REGRA_ATRIBUICAO"><?php echo $ui_rule; ?></label>
                                                                    <div class="col-md-2">
                                                                        <select class="form-control domainLists chosen visibleColumn" name="DSP_REGRA_ATRIBUICAO"></select>
                                                                    </div>

                                                                    <label class="col-md-1 control-label nobreak shorten" for="NR_DIUTURNIDADES"><?php echo $ui_diuturnities_number_short; ?></label>
                                                                    <div class="col-md-2">
                                                                        <input class="form-control toRight visibleColumn" name="NR_DIUTURNIDADES">
                                                                    </div>


                                                                    <label class="col-md-1 control-label nobreak shorten" for="TP_DIUTURNIDADE"><?php echo $ui_diuturnity_type_short; ?></label>
                                                                    <div class="col-md-1">
                                                                        <select class="form-control domainLists chosen visibleColumn" name="TP_DIUTURNIDADE"></select>
                                                                    </div>

                                                                    <label class="col-md-1 control-label nobreak shorten" for="NR_PREMIOS_ANTIG"><?php echo $ui_seniority_rewards_number_short; ?></label>
                                                                    <div class="col-md-1">
                                                                        <input class="form-control quad-ml-4 toRight visibleColumn" name="NR_PREMIOS_ANTIG">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="col-md-2 control-label nobreak shorten" for="DSP_GRP_CONTAB"><?php echo $ui_accounting_group_short; ?></label>
                                                                    <div class="col-md-2">
                                                                        <select class="form-control complexList chosen visibleColumn" name="DSP_GRP_CONTAB"></select>
                                                                    </div>

                                                                    <label class="col-md-1 control-label nobreak shorten" for="AREA_SINDICAL"><?php echo $ui_union_area; ?></label>
                                                                    <div class="col-md-2">
                                                                        <select class="form-control domainLists chosen visibleColumn" name="AREA_SINDICAL"></select>
                                                                    </div>

                                                                    <label class="col-md-1 control-label nobreak shorten" for="REGIME_SINDICAL"><?php echo $ui_union_regime; ?></label>
                                                                    <div class="col-md-3 inlineFlex">
                                                                        <select class="form-control domainLists chosen visibleColumn" name="REGIME_SINDICAL"></select>
                                                                        <input class="form-control datepicker quad-ml-4 visibleColumn" data-datatype="date" name="DT_REGIME_SINDICAL">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>

                                                    <fieldset>
                                                        <legend><?php echo $ui_bank_account . ' #1'; ?></legend>
                                                        <div class="row">
                                                            <div  class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="col-md-2 control-label nobreak shorten" for="IBAN1"><?php echo $ui_iban_short; ?></label>
                                                                    <div class="col-md-2">
                                                                        <input class="form-control quad-ml-4 visibleColumn" name="IBAN1">
                                                                    </div>

                                                                    <label class="col-md-1 control-label nobreak shorten" for="DSP_MOEDA_NIB1"><?php echo $ui_currency; ?></label>
                                                                    <div class="col-md-2">
                                                                        <select class="form-control complexList chosen visibleColumn" name="DSP_MOEDA_NIB1"></select>
                                                                    </div>

                                                                    <label class="col-md-1 control-label nobreak shorten" for="TP_VLR_BI_TB"><?php echo $ui_limit_type; ?></label>
                                                                    <div class="col-md-3 inlineFlex errorDown">
                                                                        <select class="form-control domainLists chosen visibleColumn" name="TP_VLR_BI_TB"></select>
                                                                        <input class="form-control datepicker quad-ml-4 visibleColumn" name="VLR_BI_TB">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    <fieldset>
                                                        <legend><?php echo $ui_bank_account . ' #2'; ?></legend>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="col-md-2 control-label nobreak shorten" for="IBAN2"><?php echo $ui_iban_short; ?></label>
                                                                    <div class="col-md-2">
                                                                        <input class="form-control quad-ml-4 visibleColumn" name="IBAN2">
                                                                    </div>

                                                                    <label class="col-md-1 control-label nobreak shorten" for="DSP_MOEDA_NIB2"><?php echo $ui_currency; ?></label>
                                                                    <div class="col-md-2">
                                                                        <select class="form-control domainLists chosen visibleColumn" name="DSP_MOEDA_NIB2"></select>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    <fieldset>
                                                        <legend><?php echo $ui_bank_account . ' #3'; ?></legend>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="col-md-2 control-label nobreak shorten" for="IBAN3"><?php echo $ui_iban_short; ?></label>
                                                                    <div class="col-md-2">
                                                                        <input class="form-control quad-ml-4 visibleColumn" name="IBAN3">
                                                                    </div>


                                                                    <label class="col-md-1 control-label nobreak shorten" for="DSP_MOEDA_NIB3"><?php echo $ui_currency; ?></label>
                                                                    <div class="col-md-2">
                                                                        <select class="form-control domainLists chosen visibleColumn" name="DSP_MOEDA_NIB3"></select>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    <fieldset>
                                                        <legend><?php echo $ui_bank_account . ' #4'; ?></legend>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="col-md-2 control-label nobreak shorten" for="IBAN4"><?php echo $ui_iban_short; ?></label>
                                                                    <div class="col-md-2">
                                                                        <input class="form-control quad-ml-4 visibleColumn" name="IBAN4">
                                                                    </div>


                                                                    <label class="col-md-1 control-label nobreak shorten" for="DSP_MOEDA_NIB4"><?php echo $ui_currency; ?></label>
                                                                    <div class="col-md-2">
                                                                        <select class="form-control domainLists chosen visibleColumn" name="DSP_MOEDA_NIB4"></select>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                </form>
                                            </div>
                                            <div class="tab-pane fade" id="Tab23" role="tabpanel">
                                                <form action="" id="RH_ID_PROFISSIONAIS" class="form-horizontal" novalidate="novalidate">
                                                    <div class="quad-alert"></div>
                                                    <form-toolbar></form-toolbar>
                                                    <fieldset>
                                                        <legend><?php echo $ui_professionals; ?></legend>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="col-md-2 control-label nobreak shorten" for="SITUACAO_PROF"><?php echo $ui_professional_situation; ?></label>
                                                                    <div class="col-md-4">
                                                                        <select class="form-control domainLists chosen visibleColumn" name="SITUACAO_PROF"></select>
                                                                    </div>

                                                                    <label class="col-md-2 control-label nobreak shorten" for="CATG_PROF"><?php echo $ui_professional_category; ?></label>
                                                                    <div class="col-md-4 inlineFlex">
                                                                        <select type="text" class="form-control complexList chosen" name="CATG_PROF"></select>
                                                                        <input class="form-control datepicker quad-ml-4 visibleColumn" data-datatype="date" name="DT_CATG_PROF">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="col-md-2 control-label nobreak shorten" for="CATG_PROF_INTERNA"><?php echo $ui_professional_internal_category; ?></label>
                                                                    <div class="col-md-4 inlineFlex">
                                                                        <select type="text" class="form-control complexList chosen visibleColumn" name="CATG_PROF_INTERNA"></select>
                                                                        <input class="form-control datepicker quad-ml-4 visibleColumn" data-datatype="date" name="DT_CATG_PROF_INTERNA">
                                                                    </div>

                                                                    <label class="col-md-2 control-label nobreak shorten" for="DSP_IRCT_II"><?php echo $ui_irct; ?></label>
                                                                    <div class="col-md-4 inlineFlex">
                                                                        <select type="text" class="form-control complexList chosen visibleColumn" name="DSP_IRCT_II"></select>
                                                                        <input class="form-control datepicker quad-ml-4 visibleColumn" data-datatype="date" name="DT_EFICACIA" disabled title="<?php echo $ui_effective_dt; ?>">
                                                                        <input class="form-control datepicker quad-ml-4 visibleColumn" data-datatype="date" name="DT_ADESAO_IRCT" title="<?php echo $ui_membership_dt; ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="col-md-2 control-label nobreak shorten"
                                                                           for="DSP_PROFISSAO"><?php echo $ui_occupation; ?></label>
                                                                    <div class="col-md-4 inlineFlex">
                                                                        <select type="text" class="form-control complexList chosen visibleColumn" name="DSP_PROFISSAO"></select>
                                                                        <input class="form-control datepicker quad-ml-4 visibleColumn" data-datatype="date" name="DT_PROFISSAO">
                                                                    </div>

                                                                    <label class="col-md-2 control-label nobreak shorten" for="DSP_NIVEL_QUALIF"><?php echo $ui_qualification_level; ?></label>
                                                                    <div class="col-md-4 inlineFlex">
                                                                        <select type="text" class="form-control complexList chosen visibleColumn" name="DSP_NIVEL_QUALIF"></select>
                                                                        <input class="form-control datepicker quad-ml-4 visibleColumn" data-datatype="date" name="DT_NIVEL_QUALIF">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>                
                                                    </fieldset>
                                                    <fieldset>
                                                        <legend><?php echo $ui_complementaries; ?></legend>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="col-md-2 control-label nobreak shorten" for="DSP_PONTO"><?php echo $ui_time_attendance; ?></label>
                                                                    <div class="col-md-4">
                                                                        <div>
                                                                            <select class="form-control domainLists chosen visibleColumn" name="DSP_PONTO"></select>
                                                                        </div>
                                                                    </div>

                                                                    <label class="col-md-2 control-label nobreak shorten" for="DSP_TP_HORARIO"><?php echo $ui_schedule_type; ?></label>
                                                                    <div class="col-md-4 inlineFlex">
                                                                        <select type="text" class="form-control visibleColumn" name="DSP_TP_HORARIO"></select>
                                                                        <span class="quad-ml-4"></span>
                                                                        <select type="text" class="form-control chosen visibleColumn" name="DSP_HORARIO"></select>
                                                                        <input class="form-control datepicker quad-ml-4 visibleColumn" data-datatype="date" name="DT_HORARIO">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="col-md-2 control-label nobreak shorten" for="TP_PROMOCAO"><?php echo $ui_promotion_type; ?></label>
                                                                    <div class="col-md-4 inlineFlex">
                                                                        <select type="text" class="form-control chosen visibleColumn" name="TP_PROMOCAO"></select>
                                                                        <input class="form-control datepicker quad-ml-4 visibleColumn" data-datatype="date" name="DT_ULT_PROMOCAO">
                                                                    </div>

                                                                    <label class="col-md-2 control-label nobreak shorten" for="DSP_GRUPO"><?php echo $ui_group; ?></label>
                                                                    <div class="col-md-4 inlineFlex">
                                                                        <select type="text" class="form-control complexList chosen visibleColumn" name="DSP_GRUPO"></select>
                                                                        <input class="form-control datepicker quad-ml-4 visibleColumn" data-datatype="date" name="DT_GRUPO">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="col-md-2 control-label nobreak shorten" for="DSP_SIT_CONTRIB"><?php echo $ui_contributory_status; ?></label>
                                                                    <div class="col-md-4 inlineFlex">
                                                                        <select type="text" class="form-control complexList chosen visibleColumn" name="DSP_SIT_CONTRIB"></select>
                                                                        <input class="form-control datepicker quad-ml-4 visibleColumn" data-datatype="date" name="DT_SIT_CONTRIB">
                                                                    </div>


                                                                    <label class="col-md-2 control-label nobreak shorten" for="DSP_NIVEL"><?php echo $ui_level; ?></label>
                                                                    <div class="col-md-4 inlineFlex">
                                                                        <select type="text" class="form-control complexList chosen visibleColumn" name="DSP_NIVEL"></select>
                                                                        <input class="form-control datepicker quad-ml-4 visibleColumn" data-datatype="date" name="DT_NIVEL">
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>

                                                    </fieldset>
                                                </form>
                                                
                                                <div class="row mt-4 VINCULOS">
                                                    <div class="col-xl-12 col-md-10 col-md-offset-1 rh_id_vinculos">
                                                        <div id="panel-2-3" class="panel">
                                                            <div class="panel-hdr">
                                                                <span class="widget-icon"> <i class="fas fa-edit"></i></span>&nbsp;
                                                                <h2><?php echo $ui_contractual_bonds; ?></h2>
                                                            </div>
                                                            <div class="panel-container show">
                                                                <div class="panel-content">
                                                                    <a id="RH_ID_VINCULOS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                                    <table id="RH_ID_VINCULOS" class="table table-bordered table-hover table-striped w-100"></table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                                
                                                <div class="row mt-4 FUNCOES">
                                                    <div class="col-xl-12 col-md-10 col-md-offset-1 rh_id_funcoes">
                                                        <div id="panel-2-3" class="panel">
                                                            <div class="panel-hdr">
                                                                <span class="widget-icon"> <i class="fas fa-edit"></i></span>&nbsp;
                                                                <h2><?php echo $ui_functions; ?></h2>
                                                            </div>
                                                            <div class="panel-container show">
                                                                <div class="panel-content">
                                                                    <a id="RH_ID_FUNCOES_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                                    <table id="RH_ID_FUNCOES" class="table table-bordered table-hover table-striped w-100"></table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                                
                                            </div>
                                            <div class="tab-pane fade" id="Tab24" role="tabpanel">
                                                <a id="RH_ID_REMUNERACOES_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="RH_ID_REMUNERACOES" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                                <div class="row mt-4">
                                                    <div class="col-md-6 RH_ID_ENTS_DESCONTO">
                                                        <div id="panel-2-4-0" class="panel">
                                                            <div class="panel-hdr">
                                                                <span class="widget-icon"> <i class="fas fa-edit"></i></span>&nbsp;
                                                                <h2><?php echo $ui_discount_entities; ?></h2>
                                                            </div>
                                                            <div class="panel-container show">
                                                                <div class="panel-content">
                                                                    <a id="RH_ID_ENTS_DESCONTO_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                                    <table id="RH_ID_ENTS_DESCONTO" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 RH_ID_ENT_INTERNAS">
                                                        <div id="panel-2-4-1" class="panel">
                                                            <div class="panel-hdr">
                                                                <span class="widget-icon"> <i class="fas fa-edit"></i></span>&nbsp;
                                                                <h2><?php echo $ui_cost_centers; ?></h2>
                                                            </div>
                                                            <div class="panel-container show">
                                                                <div class="panel-content">
                                                                    <a id="RH_ID_ENT_INTERNAS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                                    <table id="RH_ID_ENT_INTERNAS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 RH_ID_ADAPTABILIDADES">
                                                        <div id="panel-2-4-2" class="panel">
                                                            <div class="panel-hdr">
                                                                <span class="widget-icon"> <i class="fas fa-edit"></i></span>&nbsp;
                                                                <h2><?php echo $ui_adaptability; ?></h2>
                                                            </div>
                                                            <div class="panel-container show">
                                                                <div class="panel-content">
                                                                    <a id="RH_ID_ADAPTABILIDADES_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                                    <table id="RH_ID_ADAPTABILIDADES" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="Tab25" role="tabpanel">
                                                <a id="RH_ID_DEPTS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="RH_ID_DEPTS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                                <div class="row mt-4">
                                                    <div class="col-md-6 RH_ID_SETORES">
                                                        <div id="panel-2-5-0" class="panel">
                                                            <div class="panel-hdr">
                                                                <span class="widget-icon"> <i class="fas fa-edit"></i></span>&nbsp;
                                                                <h2><?php echo $ui_sectors; ?></h2>
                                                            </div>
                                                            <div class="panel-container show">
                                                                <div class="panel-content">
                                                                    <a id="RH_ID_SETORES_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                                    <table id="RH_ID_SETORES" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 RH_ID_JOBS">
                                                        <div id="panel-2-5-1" class="panel">
                                                            <div class="panel-hdr">
                                                                <span class="widget-icon"> <i class="fas fa-edit"></i></span>&nbsp;
                                                                <h2><?php echo $ui_jobs; ?></h2>
                                                            </div>
                                                            <div class="panel-container show">
                                                                <div class="panel-content">
                                                                    <a id="RH_ID_JOBS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                                    <table id="RH_ID_JOBS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 RH_ID_DESTACAMENTOS">
                                                        <div id="panel-2-5-1" class="panel">
                                                            <div class="panel-hdr">
                                                                <span class="widget-icon"> <i class="fas fa-edit"></i></span>&nbsp;
                                                                <h2><?php echo $ui_deployments; ?></h2>
                                                            </div>
                                                            <div class="panel-container show">
                                                                <div class="panel-content">
                                                                    <a id="RH_ID_DESTACAMENTOS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                                    <table id="RH_ID_DESTACAMENTOS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="Tab26" role="tabpanel">
                                                <a id="RH_ID_WORKFLOWS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="RH_ID_WORKFLOWS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane fade" id="Tab3" role="tabpanel">
                                <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-start">
                                    <div class="panel-toolbar pr-3 align-self-end">
                                        <ul id="panel-tab-3-1" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="#Tab31" role="tab" aria-selected="true"><?php echo $ui_documents; ?></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#Tab32" role="tab" aria-selected="true"><?php echo $ui_rhid_folder_household; ?></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-container show boxSubTab">
                                    <div class="panel-content">
                                        <div class="tab-content">
                                            <div class="tab-pane fade active show" id="Tab31" role="tabpanel">
                                                <a id="RH_ID_DOCUMENTOS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="RH_ID_DOCUMENTOS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                            </div>
                                            <div class="tab-pane fade" id="Tab32" role="tabpanel">
                                                <a id="RH_ID_AGREGADOS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="RH_ID_AGREGADOS" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                                <div class="row mt-4">
                                                    <div class="col-md-12 RH_ID_DOCUMENTOS_AGREGADO">
                                                        <div id="panel-2-4-2" class="panel">
                                                            <div class="panel-hdr">
                                                                <span class="widget-icon"> <i class="fas fa-edit"></i></span>&nbsp;
                                                                <h2><?php echo $ui_documents; ?></h2>
                                                            </div>
                                                            <div class="panel-container show">
                                                                <div class="panel-content">
                                                                    <a id="RH_ID_DOCUMENTOS_AGREGADO_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                                    <table id="RH_ID_DOCUMENTOS_AGREGADO" class="table responsive table-bordered table-striped table-hover nowrap"></table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                                                                               
                                            </div>                                        
                                        </div>
                                    </div>
                                </div>                                
                            </div>

                            <div class="tab-pane fade show" id="Tab4" role="tabpanel">
                                <div class="row mt-4 RH_ID_HAB_LITERARIAS">
                                    <div class="col-md-12">
                                        <div id="panel-4-1" class="panel">
                                            <div class="panel-hdr">
                                                <span class="widget-icon"> <i class="fas fa-edit"></i></span>&nbsp;
                                                <h2><?php echo $ui_academic_qualifications_short; ?></h2>
                                            </div>
                                            <div class="panel-container show">
                                                <div class="panel-content">
                                                    <a id="RH_ID_HAB_LITERARIAS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                    <table id="RH_ID_HAB_LITERARIAS" class="table table-bordered table-hover table-striped w-100"></table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4 RH_ID_HABS_PROFISSIONAIS">
                                    <div class="col-md-12">
                                        <div id="panel-4-1" class="panel">
                                            <div class="panel-hdr">
                                                <span class="widget-icon"> <i class="fas fa-edit"></i></span>&nbsp;
                                                <h2><?php echo $ui_professionals; ?></h2>
                                            </div>
                                            <div class="panel-container show">
                                                <div class="panel-content">
                                                    <a id="RH_ID_HABS_PROFISSIONAIS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                    <table id="RH_ID_HABS_PROFISSIONAIS" class="table table-bordered table-hover table-striped w-100"></table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade show" id="Tab5" role="tabpanel">
                                <div class="row mb-4">
                                    <form id="Filter_FF" class="form-inline" style="padding: 0rem 1rem;">
                                        <div class="form-group">
                                            <label for="DSP_CTX_FF" class="mr-2">
                                                <?php echo $ui_context; ?></label>
                                            <select id="DSP_CTX_FF" name="DSP_CTX_FF" class="form-control complexList chosen"></select>
                                        </div>
                                        <div class="alert alert-danger fade in quadAlert" style="display:none;"></div>
                                    </form>
                                </div>

                                <a id="RH_ID_FLEXFIELDS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                <table id="RH_ID_FLEXFIELDS" class="table responsive table-bordered table-striped table-hover nowrap"></table>

                            </div>
                                
                            <div class="tab-pane fade show" id="Tab6" role="tabpanel">
                                <div class="row mt-4 RH_ID_HAB_LITERARIAS">
                                    <div class="col-md-12">
                                        <div id="panel-4-1" class="panel">
                                            <div class="panel-hdr">
                                                <span class="widget-icon"> <i class="fas fa-edit"></i></span>&nbsp;
                                                <h2><?php echo $ui_curriculum; ?></h2>
                                            </div>
                                            <div class="panel-container show">
                                                <div class="panel-content">
                                                    <a id="RH_ID_CURRICULUM_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                    <table id="RH_ID_CURRICULUM" class="table table-bordered table-hover table-striped w-100"></table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4 RH_ID_HABS_PROFISSIONAIS">
                                    <div class="col-md-12">
                                        <div id="panel-4-1" class="panel">
                                            <div class="panel-hdr">
                                                <span class="widget-icon"> <i class="fas fa-edit"></i></span>&nbsp;
                                                <h2><?php echo $ui_time_contexts; ?></h2>
                                            </div>
                                            <div class="panel-container show">
                                                <div class="panel-content">
                                                    <a id="RH_ID_CONTEXTOS_TEMPO_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                    <table id="RH_ID_CONTEXTOS_TEMPO" class="table table-bordered table-hover table-striped w-100"></table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                
                            <div class="tab-pane fade show" id="Tab7" role="tabpanel">

                                <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-start">
                                    <div class="panel-toolbar pr-3 align-self-end">
                                        <ul id="panel-tab-7-1" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="#Tab71" role="tab" aria-selected="true"><?php echo $ui_characteristics; ?></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#Tab72" role="tab" aria-selected="true"><?php echo $ui_training; ?></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#Tab73" role="tab" aria-selected="true"><?php echo $ui_performance_evaluation; ?></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-container show boxSubTab">
                                    <div class="panel-content">
                                        <div class="tab-content">
                                            <div class="tab-pane fade active show" id="Tab71" role="tabpanel">
                                                <a id="RH_ID_CARACTERISTICAS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="RH_ID_CARACTERISTICAS" class="table table-bordered table-hover table-striped w-100"></table>
                                            </div>
                                            <div class="tab-pane fade" id="Tab72" role="tabpanel">
                                                <a id="RH_ID_FORMACAO_VIEW_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="RH_ID_FORMACAO_VIEW" class="table table-bordered table-hover table-striped w-100"></table>
                                            </div>
                                            <div class="tab-pane fade" id="Tab73" role="tabpanel">
                                                <a id="QUAD_PEOPLE_GE_INDIV_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                <table id="QUAD_PEOPLE_GE_INDIV" class="table table-bordered table-hover table-striped w-100"></table>

                                                <div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0 justify-content-end">
                                                    <div class="panel-toolbar pr-3 align-self-end">
                                                        <ul id="panel-tab-7-3" class="nav nav-tabs border-bottom-0 justify-content-end" role="tablist">
                                                            <li class="nav-item">
                                                                <a class="nav-link active" data-toggle="tab" href="#Tab731" role="tab" aria-selected="true"><?php echo $ui_skills; ?></a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" data-toggle="tab" href="#Tab732" role="tab" aria-selected="true"><?php echo $ui_objectives; ?></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="panel-container show boxSubTab">
                                                    <div class="panel-content">
                                                        <div class="tab-content">
                                                            <div class="tab-pane fade active show" id="Tab731" role="tabpanel">
                                                                <a id="RH_COMPETENCIAS_INDIVIDUAIS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                                <table id="RH_COMPETENCIAS_INDIVIDUAIS" class="table table-bordered table-hover table-striped w-100"></table>
                                                                <div class="row mt-4 RH_COMPETENCIAS_INDIVIDUAIS">
                                                                    <div class="col-md-12">
                                                                        <div id="panel-4-1" class="panel">
                                                                            <div class="panel-hdr">
                                                                                <span class="widget-icon"> <i class="fas fa-edit"></i></span>&nbsp;
                                                                                <h2><?php echo $ui_time_contexts; ?></h2>
                                                                            </div>
                                                                            <div class="panel-container show">
                                                                                <div class="panel-content">
                                                                                    <a id="RH_ID_COMPORTAMENTOS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed" href="#"><i class="fas fa-search"></i></a>
                                                                                    <table id="RH_ID_COMPORTAMENTOS" class="table table-bordered table-hover table-striped w-100"></table>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                            
                                                            <div class="tab-pane fade" id="Tab732" role="tabpanel">
                                                                <a id="RH_OBJECTIVOS_INDIVIDUAIS_dtAdvancedSearch" class="dtAdvancedSearch btn btn-primary btn-sm btn-icon waves-effect waves-themed"  href="#"><i class="fas fa-search"></i></a>
                                                                <table id="RH_OBJECTIVOS_INDIVIDUAIS" class="table table-bordered table-hover table-striped w-100"></table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                    
                    </div>                    

                </div>                
                <!-- TABS CONTENT -->
            </div>
        </div>
    </div>
</div>

<!--<script src="<?php echo ASSETS_URL; ?>/lib/lodash.4.17.15.min.js"></script>-->
<script>
    loadScript("<?php echo ASSETS_URL; ?>/js/scrolling-tabs/jquery.scrolling-tabs.min.js", function () {
        //initialization code
    });
    pageSetUp();
    var y = "<?php echo @$_SESSION['lang']; ?>", _rhid = "<?php echo @$_SESSION['rhid']; ?>",
        _user = "<?php echo @$_SESSION['id']; ?>", _profile = "<?php echo @$_SESSION['id_perfil']; ?>",        
        hierarquia = "<?php echo @$_SESSION['hierarquia']; ?>", user_id = "<?php echo @$_SESSION['id']; ?>",
        _rhid_delegado = "<?php echo @$_SESSION['rhid_delegado']; ?>", filter_where = '';
    console.log('Perfil:' + _profile);
    var data = JSON.stringify({
        "scope": "filter_cadastro",
        "lang": y,
        "perfil": _profile,
        "rhid": _rhid,
        "user": user_id,
        "hierarquia": hierarquia,
        "rhid_delegado": _rhid_delegado
    });
    filter_where = getFilterCondition(data);
    
    $(document).ready(function () {
    //var pagefunction = function () {   
    
        /* PHOTO CUSTOM UPLOAD --> ver upload_photo.php prototype file
         * http://cs.usi.com.tw/eRMA/dropzone.html        
        Dropzone.autoDiscover = false;
        $("#mydropzone").dropzone({
                //url: "/file/post",
                addRemoveLinks : true,
                maxFilesize: 0.5,
                dictDefaultMessage: '<span class="text-center"><span class="font-lg visible-xs-block visible-sm-block visible-lg-block"><span class="font-lg"><i class="fa fa-caret-right text-danger"></i> Drop files <span class="font-xs">to upload</span></span><span>&nbsp&nbsp<h4 class="display-inline"> (Or Click)</h4></span>',
                dictResponseError: 'Error uploading file!'
        });
        */
    
        /* CRUD + WORKFLOW */
        var nomeForm = '<?php echo json_encode($frm); ?>'.replace(/['"]+/g, ''), continue_;
                
        //IF (CRUD + WORKFLOW) problem -> EXIT
        continue_ = go_no_go ('<?php echo json_encode($wkf_error); ?>', _user, _profile); 
        
        /*Scrolling TABS :: V2 */
//        setTimeout(function () {
//            $("ul.nav.nav-tabs.nav-scroller").scrollingTabs();
//            $('#wid-id-scroll').addClass('noBottomBorder')
//        }, 100);       
       
        //TABLES :: Identificações, Empresas e suas dependências
        if (1 === 1) { 
            var conf_CADASTRO = JSON.parse('<?php echo $frm_definitions; ?>'),
                empresa_is_shown = true;
            //Valida se TODAS as PROPRIEDADES de Instanciação do interface estão OK.
            //Se não for o caso, sai do interface com ERRO!!
            // Object.keys(conf_CADASTRO) -> array TABELAS
            valid_requirements (nomeForm, conf_CADASTRO, Object.keys(conf_CADASTRO), _user, _profile);

            //IF ACCESS to RH_IDENTIFICACOES is FALSE -> EXIT
            if ( !conf_CADASTRO['RH_IDENTIFICACOES']["access"] ) {
                $('#js-nav-menu > li:nth-child(1) > a').trigger('click');
                alert('Falta remover automáticamente o Cadastro da árvore, o que só pode ser feito quando tivermos a árvore definitiva');
                //PREVIOUS VERSION : $('#left-panel li > a[href="ajax/rh_cadastro.php"]').parent('li').remove();
            }
            //RGPD
            setBulk_RGPD_on_Form ("#RH_IDENTIFICACOES", conf_CADASTRO['RH_IDENTIFICACOES']["rgpd"]);
            // -> LISTS
            setRGPD_Field_on_Form ("#RH_IDENTIFICACOES", "DSP_NATURALIDADE", conf_CADASTRO['RH_IDENTIFICACOES']["rgpd"]["CD_PAIS"]);
            setRGPD_Field_on_Form ("#RH_IDENTIFICACOES", "DSP_DISTRITO", conf_CADASTRO['RH_IDENTIFICACOES']["rgpd"]["CD_DISTRITO"]);
            setRGPD_Field_on_Form ("#RH_IDENTIFICACOES", "DSP_CONCELHO", conf_CADASTRO['RH_IDENTIFICACOES']["rgpd"]["CD_CONCELHO"]);
            setRGPD_Field_on_Form ("#RH_IDENTIFICACOES", "DSP_FREGUESIA", conf_CADASTRO['RH_IDENTIFICACOES']["rgpd"]["CD_FREGUESIA"]);
            setRGPD_Field_on_Form ("#RH_IDENTIFICACOES", "DSP_PAIS_RESIDENCIA", conf_CADASTRO['RH_IDENTIFICACOES']["rgpd"]["CD_PAIS_RES"]);            
            setRGPD_Field_on_Form ("#RH_IDENTIFICACOES", "DSP_PAIS_CORRESPONDENCIA", conf_CADASTRO['RH_IDENTIFICACOES']["rgpd"]["CD_PAIS_COR"]);

var obj = conf_CADASTRO['RH_IDENTIFICACOES']["rgpd"], std_exclude = ["BD_DOC"], columnsToExclude = [], to_exclude = [];
for (var prop in obj) {
    console.log(prop + " = " + obj[prop]);
    if ( obj[prop] === false) {
        columnsToExclude.push(prop);
    }
}
to_exclude = [...new Set(std_exclude.concat(columnsToExclude))];
console.log (obj, std_exclude, columnsToExclude, to_exclude);

            //END RGPD
            var optionsRH_IDENTIFICACOES = {
                "exclude":to_exclude, //["BD_DOC"],
                "import":{controller:"importFile.php"},
                "showWorkflowOnEdit": false,
                "workFlow":conf_CADASTRO['RH_IDENTIFICACOES']["workflow"],
                "formId": "#RH_IDENTIFICACOES",
                "table": "RH_IDENTIFICACOES",
                "info": true, //Disables INFO: (record / total records) :: HOW ????
                "externalFilter": {
                    "templateMulti": {
                        "selector": "#employeeFilter",
                        "mandatory": ['RHID'],
                        "optional": []
                    }
                },                
                "pk": {
                    "primary": {
                        "RHID": {"type": "number"}
                    }
                },
                //            "dependsOn": {
                //                "RHID_FILTER": {
                //                    "RHID": "RHID"
                //                }
                //            },
                // "initialWhereClause": " GENERO = 'M' ", optional
                "order_by": "RHID",
                //detailsObjects: ['qTableDocs', 'qTableAgregados', 'Documentos', 'Agregados'],                
                "recordBundle": 100,
                "crud": conf_CADASTRO['RH_IDENTIFICACOES']["crud"],//create,update,delete
                "defaultButtons": ['enter-query', 'new'],
                "refreshData": true, //default true
                "queryAll": false,//defaults to true ...empty search return all records
                "showMultiRecord": false, //default true
                //workflow: true, //optional defaults to false
                "order": false, //Requires view <TABLE_NAME>_VW
                "inRowDoc": {
                    "domElementId":"#drop",
                    "saveAsBlob": true, //BLOB
                    "embedded":{
                        "display":true, //true: Show DOC, false: Show Icon)
                        "dimensions":{ "x":220, "y":200}, //Just for images formats, defined on quadconfig.images_formats: ['JPG', 'JPEG', PNG', ...]
                        "watermark":false //PTE mandará select para obter a marca de água a aplicar se TRUE
                    },
                    "blobField": 'BD_DOC', //DB COLUMN BLOB
                    "pathField": 'LINK_DOC', //PATH ON FILESYSTEM
                    "fileNameField": 'LINK_DOC', //FILENAME ON FILESYSTEM
                    "extField": 'BD_MIME', //MIME
                    "savePath": 'tmp' //FILE
                },                
                "complexLists": {
                    "DSP_NACIONALIDADE": {
                        "name": "DSP_NACIONALIDADE",
                        "dependent-group": "PAIS_NACONALIDADE",
                        "dependent-level": 1,
                        "data-db-name": "A.CD_PAIS",
                        "distribute-value": "CD_PAIS_NACIONALIDADE",
                        "decodeFromTable": 'DG_PAISES A',
                        "class": "form-control complexList chosen",
                        "desigColumn": "NVL(A.DSP_NACIONALIDADE,A.DSP_PAIS)",
                        //"desigColumn": "DSP_PAIS",
                        "whereClause": '',
                        "orderBy": 'A.CD_PAIS'
                    },
                    "DSP_NATURALIDADE": {
                        "name": "DSP_NATURALIDADE",
                        "dependent-group": "PAISES",
                        "dependent-level": 1,
                        "data-db-name": "A.CD_PAIS",
                        //"distribute-value": "CD_PAIS_NACIONALIDADE",
                        "decodeFromTable": 'DG_PAISES A',
                        "class": "form-control complexList chosen",
                        "desigColumn": "A.DSP_PAIS",
                        "whereClause": '',
                        "orderBy": 'A.CD_PAIS'
                    },
                    "DSP_DISTRITO": {
                        "name": "DSP_DISTRITO",
                        "dependent-group": "PAISES",
                        "dependent-level": 2,
                        "data-db-name": "A.CD_PAIS@A.CD_DISTRITO",
                        "decodeFromTable": 'DG_DISTRITOS A',
                        "class": "form-control complexList chosen",
                        "desigColumn": "A.DSP_DISTRITO",
                        "whereClause": '',
                        "orderBy": 'A.CD_DISTRITO'
                    },
                    "DSP_CONCELHO": {
                        "name": "DSP_CONCELHO",
                        "dependent-group": "PAISES",
                        "dependent-level": 3,
                        "data-db-name": "A.CD_PAIS@A.CD_DISTRITO@A.CD_CONCELHO",
                        "decodeFromTable": 'DG_CONCELHOS A',
                        "class": "form-control complexList chosen",
                        "desigColumn": "A.DSP_CONCELHO",
                        "whereClause": '',
                        "orderBy": 'A.CD_CONCELHO'
                    },
                    "DSP_FREGUESIA": {
                        "name": "DSP_FREGUESIA",
                        "dependent-group": "PAISES",
                        "dependent-level": 4,
                        "data-db-name": "A.CD_PAIS@A.CD_DISTRITO@A.CD_CONCELHO@A.CD_FREGUESIA",
                        "decodeFromTable": 'DG_FREGUESIAS A',
                        "class": "form-control complexList chosen",
                        "desigColumn": "A.DSP_FREGUESIA",
                        "whereClause": '',
                        "orderBy": 'A.CD_FREGUESIA'
                    },
                    "DSP_PAIS_RESIDENCIA": {
                        "name": "DSP_PAIS_RESIDENCIA",
                        "dependent-group": "PAIS_RESIDENCIA",
                        "dependent-level": 1,
                        "data-db-name": "A.CD_PAIS",
                        "distribute-value": "CD_PAIS_RES",
                        //"distribute-value": "CD_PAIS",
                        "decodeFromTable": 'DG_PAISES A',
                        "class": "form-control complexList chosen",
                        "desigColumn": "A.DSP_PAIS",
                        "whereClause": '',
                        "orderBy": 'A.CD_PAIS'
                    },
                    "DSP_PAIS_CORRESPONDENCIA": {
                        "name": "DSP_PAIS_CORRESPONDENCIA",
                        "dependent-group": "PAIS_POSTAL",
                        "dependent-level": 1,
                        "data-db-name": "A.CD_PAIS",
                        "distribute-value": "CD_PAIS_COR",
                        //"distribute-value": "CD_PAIS",
                        "decodeFromTable": 'DG_PAISES A',
                        "class": "form-control complexList chosen",
                        "desigColumn": "A.DSP_PAIS",
                        "whereClause": '',
                        "orderBy": 'A.CD_PAIS'
                    },
                },
                "domainLists": {
                    "GENERO": {
                        "domain-list": true,
                        "dependent-group": "RH_IDENTIFICACOES.GENERO"
                    },
                    "ESTADO_CIVIL": {
                        "domain-list": true,
                        "dependent-group": "RH_ESTADO_CIVIL"
                    },
                },
                "validations": {
                    "rules": {
                        "RHID": {
                            required: true,
                            integer: true,
                            maxlength: 32
                        },
                        "NOME": {
                            required: true,
                            maxlength: 80
                        },
                        "NOME_REDZ": {
                            maxlength: 25
                        },
                        "ACRONIMO": {
                            maxlength: 20
                        },
                        "DT_NASCIMENTO": {
                            required: true,
                            dateISO: true
                        },
                        "GENERO": {
                            required: true,
                        },
                        "DT_ESTADO_CIVIL": {
                            dateISO: true
                        },
                        "TITULO": {
                            maxlength: 10
                        },
                        "EMAIL": {
                            email: true,
                            maxlength: 80
                        },
                        "EMAIL_PESSOAL": {
                            email: true,
                            maxlength: 80
                        },
                        "TELEMOVEL_1": {
                            maxlength: 20
                        },
                        "TELEMOVEL_2": {
                            maxlength: 20
                        },
                        "TELEFONE_RES": {
                            maxlength: 20
                        },
                        "CONTACTO_EMERG": {
                            maxlength: 150
                        },
                        "MORADA_RES": {
                            maxlength: 200
                        },
                        "LOCALIDADE_RES": {
                            maxlength: 80
                        },
                        "CD_POSTAL_RES": {
                            maxlength: 10
                        },
                        "NR_ORDEM_RES": {
                            maxlength: 10
                        },
                        "MORADA_COR": {
                            maxlength: 200
                        },
                        "LOCALIDADE_COR": {
                            maxlength: 80
                        },
                        "CD_POSTAL_COR": {
                            maxlength: 10
                        },
                        "NR_ORDEM_COR": {
                            maxlength: 10
                        }
                    }
                }
            };
            RH_IDENTIFICACOES = new QuadForm();
            RH_IDENTIFICACOES.initForm($.extend({}, datatable_instance_defaults, optionsRH_IDENTIFICACOES));
            // para efetuar o override para evitar a renderização do video...
            /*RH_IDENTIFICACOES.isVideoFile=function(){
                    alert("agora aqui .override do quadcore")
            };*/
            
            //REMOVE ENTER-QUERY
            $("#RH_IDENTIFICACOES")
                .find("a[data-form-action=enter-query]")
                .remove();
        
                //On Entrance SHOW INSERT BUTTON
                setTimeout(function(){
//                    console.log(conf_CADASTRO['RH_IDENTIFICACOES']["crud"]);
                    if (conf_CADASTRO['RH_IDENTIFICACOES']["crud"][0]) { //Insert ALLOWED
                        $("#RH_IDENTIFICACOES")
                            .find("" + "a[data-form-action=new]")
                            .show();
                    }
                },0)

            //END Identificação
            
            //IF ACCESS to RH_ID_EMPRESAS is FALSE
            if ( !conf_CADASTRO['RH_ID_EMPRESAS']["access"] ) {
                empresa_is_shown = false;
            }

            //SHOW EMPRESAS
            if (empresa_is_shown) {                
                //Empresa
                var optionRH_ID_EMPRESAS = {
                    "tableId": "RH_ID_EMPRESAS",
                    "table": "RH_ID_EMPRESAS",
                    "workFlow": conf_CADASTRO['RH_ID_EMPRESAS']["workflow"], //rh_identificacoes_wkf,                
                    "selectRecordMsg": "<?php echo $ui_please_select_record .$ui_company; ?>",
                    "pk": {
                        "primary": {
                            "EMPRESA": {"type": "varchar"},
                            "RHID": {"type": "number"},
                            "DT_ADMISSAO": {"type": "date"},
                            "CD_ESTAB": {"type": "varchar"} //Definido para ligar com RH_ID_SETORES
                        }
                    },
                    "crudOnMasterInactive": {
                        "condition": "data.DT_DEMISSAO !== null",
                        "acl": {
                            "create": false,
                            "update": false,
                            "delete": false
                        }
                    }, //,
                    "externalFilter": {
                        "templateMulti": {
                            "selector": "#employeeFilter",
                            "mandatory": ['RHID'],
                            "optional": []
                        }
                    },
                    "on_pre_submit": "RH_ID_EMPRESAS",
                    "detailsObjects": ['RH_ID_EMPRESAS_CONTINUED', 'RH_ID_DEPTS', 'RH_ID_JOBS', 'RH_ID_SETORES', 'RH_ID_ENT_INTERNAS', 'RH_ID_DESTACAMENTOS',
                        'RH_ID_ADAPTABILIDADES', 'RH_ID_WORKFLOWS', 'RH_ID_PROFISSIONAIS', 'RH_ID_RETRIBUTIVOS', 'RH_ID_ENTS_DESCONTO',
                        'RH_ID_REMUNERACOES', 'RH_ID_FUNCOES','RH_ID_VINCULOS'], //,'RH_ID_FUNCOES_OUT'],
                    //"initialWhereClause": "",
                    "order_by": "RHID, DT_ADMISSAO DESC",
                    "recordBundle": 5,
                    "pageLenght": 5,
                    "scrollY": "117",
                    "responsive": true,
                    "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
                    "tableCols": [
                        {
                            "responsivePriority": 1,
                            "data": null,
                            "className": "control toBottom toCenter",
                            "width": "1%",
                            "defaultContent": ''
                        }, {
                            "title": "RHID", //Datatables
                            "label": "RHID", //Editor
                            "data": 'RHID',
                            "name": 'RHID',
                            "exclude": !conf_CADASTRO['RH_ID_EMPRESAS']["rgpd"]["RHID"],
                            "type": "hidden",
                            "visible": false,
                        }, {
                            "title": "", //Datatables
                            "label": "", //Editor
                            "data": 'EMPRESA',
                            "name": 'EMPRESA',
                            "exclude": !conf_CADASTRO['RH_ID_EMPRESAS']["rgpd"]["EMPRESA"],
                            "type": "hidden",
                            "visible": false,
                            "className": "",
                        }, {
                            "responsivePriority": 2,
                            "complexList": true,
                            "title": "<?php echo mb_strtoupper($ui_company,'UTF-8'); ?>",
                            "label": "<?php echo $ui_company; ?>",
                            "data": 'DSP_EMPRESA',
                            "name": 'DSP_EMPRESA',
                            "exclude": !conf_CADASTRO['RH_ID_EMPRESAS']["rgpd"]["EMPRESA"],
                            "type": "select",
                            "className": "visibleColumn",
                            //"renew": true,
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
                            "title": "<?php echo mb_strtoupper($ui_dt_admission,'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_dt_admission; ?>", //Editor
                            "data": 'DT_ADMISSAO',
                            "name": 'DT_ADMISSAO',
                            "exclude": !conf_CADASTRO['RH_ID_EMPRESAS']["rgpd"]["DT_ADMISSAO"],
                            "datatype": 'date',
                            "def": "",
                            "className": "visibleColumn",
                            "attr": {
                                "class": "datepicker"
                            }
                        }, {
                            "title": "", //Datatables
                            "label": "", //Editor
                            "data": 'CD_SITUACAO',
                            "name": 'CD_SITUACAO',
                            "exclude": !conf_CADASTRO['RH_ID_EMPRESAS']["rgpd"]["CD_SITUACAO"],
                            "type": "hidden",
                            "visible": false,
                            "className": "",
                        }, {
                            "responsivePriority": 4,
                            "complexList": true,
                            "title": "<?php echo mb_strtoupper($ui_situation,'UTF-8'); ?>",
                            "label": "<?php echo $ui_situation; ?>",
                            "data": 'DSP_SITUACAO',
                            "name": 'DSP_SITUACAO',
                            "exclude": !conf_CADASTRO['RH_ID_EMPRESAS']["rgpd"]["CD_SITUACAO"],
                            "type": "select",
                            "className": "visibleColumn",
                            //"renew": true,
                            "attr": {
                                "dependent-group": "SITUACOES",
                                "dependent-level": 1,
                                "data-db-name": "A.CD_SITUACAO",
                                "decodeFromTable": "RH_DEF_SITUACOES A",
                                "desigColumn": "CONCAT(CONCAT(A.CD_SITUACAO,'-'),A.DSP_SITUACAO)",
                                "otherValues": "A.MOTIVO_SAIDA",
                                "orderBy": "A.CD_SITUACAO",
                                "class": "form-control complexList",
                                "filter": {
                                    "create": " AND A.ACTIVO = 'S'",
                                    "edit": " AND A.ACTIVO = 'S'",
                                }
                            }
                        }, {
                            "responsivePriority": 5,
                            "title": "<?php echo mb_strtoupper($ui_situation_dt,'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_situation_dt; ?>", //Editor
                            "data": 'DT_SITUACAO',
                            "name": 'DT_SITUACAO',
                            "exclude": !conf_CADASTRO['RH_ID_EMPRESAS']["rgpd"]["DT_SITUACAO"],
                            "datatype": 'date',
                            "def": "",
                            "className": "visibleColumn",
                            "attr": {
                                "class": "datepicker"
                            }
                        }, {
                            "responsivePriority": 6,
                            "title": "<?php echo mb_strtoupper($ui_dt_resignation,'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_dt_resignation; ?>", //Editor
                            "data": 'DT_DEMISSAO',
                            "name": 'DT_DEMISSAO',
                            "exclude": !conf_CADASTRO['RH_ID_EMPRESAS']["rgpd"]["DT_DEMISSAO"],
                            "datatype": 'date',
                            "def": "",
                            "className": "visibleColumn",
                            "attr": {
                                "class": "datepicker"
                            }
                        }, {
                            "title": "", //Datatables
                            "label": "", //Editor
                            "data": 'CD_ESTAB',
                            "name": 'CD_ESTAB',
                            "exclude": !conf_CADASTRO['RH_ID_EMPRESAS']["rgpd"]["EMPRESA"] && !conf_CADASTRO['RH_ID_EMPRESAS']["rgpd"]["CD_ESTAB"],
                            "type": "hidden",
                            "visible": false,
                        }, {
                            "responsivePriority": 7,
                            "complexList": true,
                            "title": "<?php echo mb_strtoupper($ui_establishment,'UTF-8'); ?>",
                            "label": "<?php echo $ui_establishment; ?>",
                            "data": 'DSP_ESTAB',
                            "name": 'DSP_ESTAB',
                            "exclude": !conf_CADASTRO['RH_ID_EMPRESAS']["rgpd"]["EMPRESA"] && !conf_CADASTRO['RH_ID_EMPRESAS']["rgpd"]["CD_ESTAB"],
                            "type": "select",
                            "className": "visibleColumn",
                            "attr": {
                                "deferred": true,
                                "dependent-group": "EMPRESA",
                                "dependent-level": 2,
                                "data-db-name": 'A.EMPRESA@A.CD_ESTAB',
                                "decodeFromTable": 'DG_ESTABELECIMENTOS A',
                                "class": "form-control complexList chosen",
                                "desigColumn": "NVL(A.DSR_ESTAB,A.DSP_ESTAB)",
                                "orderBy": "A.CD_ESTAB",
                                "filter": {
                                    "create": " AND A.ACTIVO = 'S' AND A.EMPRESA = ':EMPRESA' ",
                                    "edit": " AND A.ACTIVO = 'S' AND A.EMPRESA = ':EMPRESA' ",
                                }                            
                            }
                        }, {    
                            "responsivePriority": 8,
                            "title": "<?php echo mb_strtoupper($ui_establishment_dt_short,'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_establishment_dt_short; ?>", //Editor
                            "data": 'DT_ESTAB',
                            "name": 'DT_ESTAB',
                            "exclude": !conf_CADASTRO['RH_ID_EMPRESAS']["rgpd"]["DT_ESTAB"],
                            "datatype": 'date',
                            "def": "",
                            "className": "visibleColumn",
                            "attr": {
                                "class": "datepicker"
                            }
                        }, {
                            "title": "<?php echo mb_strtoupper($ui_seniority_dt,'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_seniority_dt; ?>", //Editor
                            "data": 'DT_ADMISS_ANTIG',
                            "name": 'DT_ADMISS_ANTIG',
                            "exclude": !conf_CADASTRO['RH_ID_EMPRESAS']["rgpd"]["DT_ADMISS_ANTIG"],
                            "datatype": 'date',
                            "def": "",
                            "className": "none visibleColumn",
                            "attr": {
                                "class": "datepicker"
                            }
                        }, {
                            "title": "<?php echo mb_strtoupper($ui_diuturnity_dt,'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_diuturnity_dt; ?>", //Editor
                            "data": 'DT_DIUTURNIDADE',
                            "name": 'DT_DIUTURNIDADE',
                            "exclude": !conf_CADASTRO['RH_ID_EMPRESAS']["rgpd"]["DT_DIUTURNIDADE"],
                            "datatype": 'date',
                            "def": "",
                            "className": "none visibleColumn",
                            "attr": {
                                "class": "datepicker"
                            }
                        }, {
                            "responsivePriority": 9,
                            "title": "<?php echo mb_strtoupper($ui_time_attendance_short,'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_time_attendance_short; ?>", //Editor
                            "data": 'PONTO',
                            "name": 'PONTO',
                            "exclude": !conf_CADASTRO['RH_ID_EMPRESAS']["rgpd"]["PONTO"],
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
    //                    }, {
    //                        "title": "<?php echo mb_strtoupper($ui_RU_code,'UTF-8'); ?>",
    //                        "label": "<?php echo $ui_RU_code; ?>",
    //                        "data": 'ID_RU',
    //                        "name": 'ID_RU',
    //                        "className": "none visibleColumn",     

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
                            "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions,'UTF-8'); ?>" + '</span>',
                            "label": '',
                            "data": null,
                            "name": 'RECORD_HISTORY',
                            "type": "hidden",
                            "className": "none visibleColumn",
                            "render": function (val, type, row) {
                                return tablesRecordHistory(val, type, row);
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
                                return RH_ID_EMPRESAS.crudButtons(conf_CADASTRO['RH_ID_EMPRESAS']["crud"][0], conf_CADASTRO['RH_ID_EMPRESAS']["crud"][1], conf_CADASTRO['RH_ID_EMPRESAS']["crud"][2]);
                            }
                        }
                    ],
                    "validations": {
                        "rules": {
                            "DSP_EMPRESA": {
                                required: true
                            },
                            "DSP_SITUACAO": {
                                required: true
                            },
                            "DSP_ESTAB": {
                                required: true
                            },
                            "DT_ESTAB": {
                                dateISO: true,
                                dateEqOrNextThan: 'DT_ADMISSAO'
                            },                            
                            "PONTO": {
                                required: true
                            },
                            "DT_ADMISSAO": {
                                required: true,
                                dateISO: true
                            },
                            "DT_SITUACAO": {
                                dateISO: true,
                                dateEqOrNextThan: 'DT_ADMISSAO'
                            },
                            "DT_DEMISSAO": {
                                dateISO: true,
                                dateEqOrNextThan: 'DT_ADMISSAO'
                            },
                            "DT_ADMISS_ANTIG": {
                                dateISO: true
                            },
                            "DT_DIUTURNIDADE": {
                                dateISO: true
                            }
                        },
                        //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                        "messages": {
                            "DT_ESTAB": {
                                dateEqOrNextThan: "<?php echo $error_end_dt_adm_greater; ?>"
                            },
                            "DT_DEMISSAO": {
                                dateEqOrNextThan: "<?php echo $error_end_dt_adm_greater; ?>"
                            },
                            "DT_SITUACAO": {
                                dateEqOrNextThan: "<?php echo $error_end_dt_adm_greater; ?>"
                            },
                        }
                    }
                };
                RH_ID_EMPRESAS = new QuadTable();
                RH_ID_EMPRESAS.initTable($.extend({}, datatable_instance_defaults, optionRH_ID_EMPRESAS));

                //Starts by DECLARING LOCAL Validation RULES:
                if (1 === 1) {
                
                    $(document).on('RH_ID_EMPRESASAttachEvt', function (e) {
                        // a mudança da situação => obrigatoriedade de preenchimento da data de demissão, caso MOTIVO_SAIDA = 'S'
                        $("#DTE_Field_DSP_SITUACAO","#RH_ID_EMPRESAS_editorForm").on('change', function(e) {
                            var operacao = RH_ID_EMPRESAS.editor.s["action"], frm_context = "#RH_ID_EMPRESAS_editorForm",
                                motivo_saida = $("#DTE_Field_DSP_SITUACAO", frm_context).children("option:selected")[0]['dataset']['othervalues'];
                            if (operacao !== 'query') {
                                if (motivo_saida === 'S') {
                                        $("#DTE_Field_DT_DEMISSAO").rules('add', {
                                                required: true
                                        });		
                                        $("#DTE_Field_DT_DEMISSAO").addClass('required');
                                        $("[for=DTE_Field_DT_DEMISSAO]").addClass('required');
                                } 
                                else {
                                        $("#DTE_Field_DT_DEMISSAO").rules('remove','required');		
                                        $("#DTE_Field_DT_DEMISSAO").removeClass('required');
                                        $("[for=DTE_Field_DT_DEMISSAO]").removeClass('required');
                                }
                            }
                        });
                    });
                }
                //END DECLARING LOCAL Validation RULES

                //Empresa Continued          
                //RGPD
                setBulk_RGPD_on_Form ("#RH_ID_EMPRESAS_CONTINUED", conf_CADASTRO['RH_ID_EMPRESAS']["rgpd"]);
                // -> LISTS
                setRGPD_Field_on_Form ("#RH_ID_EMPRESAS_CONTINUED", "DSP_ESTAB_TMP", conf_CADASTRO['RH_ID_EMPRESAS']["rgpd"]["EMPRESA"] && conf_CADASTRO['RH_ID_EMPRESAS']["rgpd"]["CD_ESTAB_TMP"]);
                //END RGPD                
                var optionsRH_ID_EMPRESAS_CONTINUED = {
                    "formId": "#RH_ID_EMPRESAS_CONTINUED",
                    "table": "RH_ID_EMPRESAS",
                    "workFlow": conf_CADASTRO['RH_ID_EMPRESAS']["workflow"],
                    "info": true, //Disables INFO: (record / total records) :: HOW ????           
                    "pk": {
                        "primary": {
                            "EMPRESA": {"type": "varchar"},
                            "RHID": {"type": "number"},
                            "DT_ADMISSAO": {"type": "date"}
                        }
                    },
                    "dependsOn": {
                        "RH_ID_EMPRESAS": {
                            "EMPRESA": "EMPRESA",
                            "RHID": "RHID",
                            "DT_ADMISSAO": "DT_ADMISSAO"
                        }
                    },
                    // "initialWhereClause": " GENERO = 'M' ", optional
                    //"order_by": "NOME",
                    //detailsObjects: ['qTableDocs', 'qTableAgregados', 'Documentos', 'Agregados'],                
                    "recordBundle": 1,
                    "crud": conf_CADASTRO['RH_ID_EMPRESAS']["crud"],//create,update,delete
                    "defaultButtons": ['enter-query', 'new'],
                    "refreshData": true, //default true
                    "queryAll": false,//defaults to true ...empty search return all records
                    "showMultiRecord": false, //default true
                    //workflow: true, //optional defaults to false
                    "showWorkflowOnEdit": false,
                    "order": false, //Requires view <TABLE_NAME>_VW
                    "complexLists": {
                        "DSP_ESTAB_TMP": {
                            "name": "DSP_ESTAB_TMP",
                            "deferred": true,
                            "dependent-group": "ESTAB_TMP",
                            "dependent-level": 1,
                            "data-db-name": 'A.EMPRESA@A.CD_ESTAB',
                            "distribute-value": 'EMPRESA@CD_ESTAB_TMP',
                            "decodeFromTable": 'DG_ESTABELECIMENTOS A',
                            "class": "form-control complexList chosen",
                            "desigColumn": "NVL(A.DSR_ESTAB,A.DSP_ESTAB)",
                            "orderBy": "A.CD_ESTAB",
                            "filter": {
                                "create": " AND A.ACTIVO = 'S' AND A.EMPRESA = ':EMPRESA' ",
                                "edit": " AND A.ACTIVO = 'S' AND A.EMPRESA = ':EMPRESA' ",
                            }
                        }
                    },
                    "domainLists": {
                        "TIPO_TRABALHO": {
                            "domain-list": true,
                            "dependent-group": "RH_ID_EMPRESAS.TIPO_TRABALHO"
                        },
                        "EMP_TRAB_TEMP": {
                            "domain-list": true,
                            "dependent-group": "RH_EMP_TRAB_TEMP"
                        },
                    },
                    "validations": {
                        "rules": {
                            "DT_ESTAB_TMP": {
                                dateISO: true
                            },
                            "NR_MECANOGRAFICO": {
                                maxlength: 10
                            },
                            "NR_INTERNO": {
                                maxlength: 20
                            },
                            "NR_INTERNO_2": {
                                maxlength: 20
                            }
                        },
                        //                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                        ////                "messages": {
                        ////                    "DT_FIM": {
                        ////                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                        ////                    }
                        ////                }
                    }
                };
                RH_ID_EMPRESAS_CONTINUED = new QuadForm();
                RH_ID_EMPRESAS_CONTINUED.initForm($.extend({}, datatable_instance_defaults, optionsRH_ID_EMPRESAS_CONTINUED));
                //REMOVE ENTER-QUERY
                $("#RH_ID_EMPRESAS_CONTINUED")
                    .find("a[data-form-action=enter-query]")
                    .remove();            
                //END Empresa Continued

                //Elementos Retributivos
                if  ( !conf_CADASTRO['RH_ID_RETRIBUTIVOS']["access"] ) {
                    $('a[href="#Tab22"]').closest('li').remove(); //Estrutura TAB.LINK
                    $('#Tab22').remove(); //Estrutura DIV.PANEL
                } else {
                    //RGPD
                    setBulk_RGPD_on_Form ("#RH_ID_RETRIBUTIVOS", conf_CADASTRO['RH_ID_RETRIBUTIVOS']["rgpd"]);
                    // -> LISTS
                    setRGPD_Field_on_Form ("#RH_ID_RETRIBUTIVOS", "DSP_REGRA_ATRIBUICAO", conf_CADASTRO['RH_ID_RETRIBUTIVOS']["rgpd"]["CD_REGRA"]);                
                    setRGPD_Field_on_Form ("#RH_ID_RETRIBUTIVOS", "DSP_GRP_CONTAB", conf_CADASTRO['RH_ID_RETRIBUTIVOS']["rgpd"]["CD_GRP_CONTAB"]);
                    setRGPD_Field_on_Form ("#RH_ID_RETRIBUTIVOS", "DSP_MOEDA", conf_CADASTRO['RH_ID_RETRIBUTIVOS']["rgpd"]["CD_MOEDA"]);
                    setRGPD_Field_on_Form ("#RH_ID_RETRIBUTIVOS", "DSP_MOEDA_NIB1", conf_CADASTRO['RH_ID_RETRIBUTIVOS']["rgpd"]["CD_MOEDA_NIB_1"]);
                    setRGPD_Field_on_Form ("#RH_ID_RETRIBUTIVOS", "DSP_MOEDA_NIB2", conf_CADASTRO['RH_ID_RETRIBUTIVOS']["rgpd"]["CD_MOEDA_NIB_2"]);
                    setRGPD_Field_on_Form ("#RH_ID_RETRIBUTIVOS", "DSP_MOEDA_NIB3", conf_CADASTRO['RH_ID_RETRIBUTIVOS']["rgpd"]["CD_MOEDA_NIB_3"]);
                    setRGPD_Field_on_Form ("#RH_ID_RETRIBUTIVOS", "DSP_MOEDA_NIB4", conf_CADASTRO['RH_ID_RETRIBUTIVOS']["rgpd"]["CD_MOEDA_NIB_4"]);
                    //END RGPD
                    var optionsRH_ID_RETRIBUTIVOS = {
                        "formId": "#RH_ID_RETRIBUTIVOS",
                        "table": "RH_ID_RETRIBUTIVOS",
                        "workFlow": conf_CADASTRO['RH_ID_RETRIBUTIVOS']["workflow"],
                        "info": true, //Disables INFO: (record / total records) :: HOW ????
                        "pk": {
                            "primary": {
                                "EMPRESA": {"type": "varchar"},
                                "RHID": {"type": "number"},
                                "DT_ADMISSAO": {"type": "date"}
                            }
                        },
                        "dependsOn": {
                            "RH_ID_EMPRESAS": {
                                "EMPRESA": "EMPRESA",
                                "RHID": "RHID",
                                "DT_ADMISSAO": "DT_ADMISSAO"
                            }
                        },
                        // "initialWhereClause": " GENERO = 'M' ", optional
                        //"order_by": "DT_ADMISSAO DESC",
                        //detailsObjects: ['qTableDocs', 'qTableAgregados', 'Documentos', 'Agregados'],                
                        "recordBundle": 1,
                        "crud": conf_CADASTRO['RH_ID_RETRIBUTIVOS']["crud"],//create,update,delete
                        "defaultButtons": ['enter-query', 'new'],
                        "refreshData": true, //default true
                        "queryAll": false,//defaults to true ...empty search return all records
                        "showMultiRecord": false, //default true
                        //workflow: true, //optional defaults to false
                        "showWorkflowOnEdit": false,
                        "order": false, //Requires view <TABLE_NAME>_VW                
        //                "dateFields": {
        //                    "DT_REGIME_SINDICAL": "date" ?????
        //                },
                        "domainLists": {
                            "TP_IRS": {
                                "domain-list": true,
                                "dependent-group": "RH_TP_IRS"
                            },
                            "TABELA_IRS": {
                                "domain-list": true,
                                "dependent-group": "RH_TABELA_IRS"
                            },
                            "EST_CIVIL_IRS": {
                                "domain-list": true,
                                "dependent-group": "RH_EST_CIVIL_IRS"
                            },
                            "GRAU_DEFICIENCIA": {
                                "domain-list": true,
                                "dependent-group": "RH_ID_RETRIBUTIVOS.GRAU_DEFICIENCIA"
                            },
                            "REPARTICAO_FISCAL": {
                                "domain-list": true,
                                "dependent-group": "DG_REPARTICAO_FISCAL"
                            },
                            "TP_DIUTURNIDADE": {
                                "domain-list": true,
                                "dependent-group": "RH_ID_RETRIBUTIVOS.TP_DIUTURNIDADE"
                            },
                            "AREA_SINDICAL": {
                                "domain-list": true,
                                "dependent-group": "RH_AREA_SINDICAL"
                            },
                            "REGIME_SINDICAL": {
                                "domain-list": true,
                                "dependent-group": "RH_REGIME_SINDICAL"
                            },
                            "FORMA_PAGAMENTO": {
                                "domain-list": true,
                                "dependent-group": "RH_FORMA_PAGAM"
                            },
                            "TP_VLR_BI_TB": {
                                "domain-list": true,
                                "dependent-group": "RH_ID_RETRIBUTIVOS.TP_VLR_BI_TB"
                            },
                        },
                        "complexLists": {
                            "DSP_REGRA_ATRIBUICAO": {
                                "name": "DSP_REGRA_ATRIBUICAO",
                                "dependent-group": "REGRAS_ATRIBUICAO",
                                "dependent-level": 1,
                                "data-db-name": "A.CD_REGRA",
                                "decodeFromTable": "RH_DEF_REGRAS_ATRIBUICAO A",
                                "desigColumn": "CONCAT(CONCAT(A.CD_REGRA, '-'), A.DSR_REGRA)",
                                "orderBy": "A.CD_REGRA",
                                "class": "form-control complexList chosen",
                                "filter": {
                                    "create": " AND A.ACTIVO = 'S'",
                                    "edit": " AND A.ACTIVO = 'S' ",
                                }
                            },
                            "DSP_GRP_CONTAB": {
                                "name": "DSP_GRP_CONTAB",
                                "dependent-group": "GRP_CONTAB",
                                "dependent-level": 1,
                                "data-db-name": "A.CD_GRP_CONTAB",
                                "decodeFromTable": "DG_DEF_GRUPOS_CONTABILISTICOS A",
                                "desigColumn": "CONCAT(CONCAT(A.CD_GRP_CONTAB, '-'), A.DSR_GRP_CONTAB)",
                                'whereClause': " AND A.RH_TP_INTERFACE = 'B'",
                                "orderBy": "A.CD_GRP_CONTAB",
                                "class": "form-control complexList chosen",
                                "filter": {
                                    "create": " AND A.ACTIVO = 'S'",
                                    "edit": " AND A.ACTIVO = 'S' ",
                                }
                            },
                            "DSP_MOEDA": {
                                "name": "DSP_MOEDA",
                                "dependent-group": "MOEDAS",
                                "dependent-level": 1,
                                "data-db-name": "CD_MOEDA",
                                "decodeFromTable": "DG_MOEDAS",
                                "desigColumn": "CONCAT(CONCAT(CD_MOEDA,'-'), DSP_MOEDA)",
                                "orderBy": "A.CD_MOEDA",
                                "class": "form-control complexList chosen",
                                "filter": {
                                    "create": " AND ACTIVO = 'S'",
                                    "edit": " AND ACTIVO = 'S' ",
                                }
                            },
                            "DSP_MOEDA_NIB1": {
                                "name": "DSP_MOEDA_NIB1",
                                "dependent-group": "MOEDAS",
                                "dependent-level": 1,
                                "data-db-name": "CD_MOEDA",
                                "distribute-value": "CD_MOEDA_NIB_1",
                                "decodeFromTable": "DG_MOEDAS",
                                "desigColumn": "CONCAT(CONCAT(A.CD_MOEDA,'-'),DSP_MOEDA)",
                                "orderBy": "CD_MOEDA",
                                "class": "form-control complexList chosen",
                                "filter": {
                                    "create": " AND ACTIVO = 'S'",
                                    "edit": " AND ACTIVO = 'S' ",
                                }
                            },
                            "DSP_MOEDA_NIB2": {
                                "name": "DSP_MOEDA_NIB2",
                                "dependent-group": "MOEDAS",
                                "dependent-level": 1,
                                "data-db-name": "CD_MOEDA",
                                "distribute-value": "CD_MOEDA_NIB_2",
                                "decodeFromTable": "DG_MOEDAS",
                                "desigColumn": "CONCAT(CONCAT(A.CD_MOEDA,'-'),DSP_MOEDA)",
                                "orderBy": "CD_MOEDA",
                                "class": "form-control complexList chosen",
                                "filter": {
                                    "create": " AND ACTIVO = 'S'",
                                    "edit": " AND ACTIVO = 'S' ",
                                }
                            },
                            "DSP_MOEDA_NIB3": {
                                "name": "DSP_MOEDA_NIB3",
                                "dependent-group": "MOEDAS",
                                "dependent-level": 1,
                                "data-db-name": "CD_MOEDA",
                                "distribute-value": "CD_MOEDA_NIB_3",
                                "decodeFromTable": "DG_MOEDAS",
                                "desigColumn": "CONCAT(CONCAT(CD_MOEDA,'-'),DSP_MOEDA)",
                                "orderBy": "CD_MOEDA",
                                "class": "form-control complexList chosen",
                                "filter": {
                                    "create": " AND ACTIVO = 'S'",
                                    "edit": " AND ACTIVO = 'S' ",
                                }
                            },
                            "DSP_MOEDA_NIB4": {
                                "name": "DSP_MOEDA_NIB4",
                                "dependent-group": "MOEDAS",
                                "dependent-level": 1,
                                "data-db-name": "CD_MOEDA",
                                "distribute-value": "CD_MOEDA_NIB_4",
                                "decodeFromTable": "DG_MOEDAS",
                                "desigColumn": "CONCAT(CONCAT(CD_MOEDA,'-'), DSP_MOEDA)",
                                "orderBy": "CD_MOEDA",
                                "class": "form-control complexList chosen",
                                "filter": {
                                    "create": " AND ACTIVO = 'S'",
                                    "edit": " AND ACTIVO = 'S' ",
                                }
                            }
                        },
                        "validations": {
                            "rules": {
                                "TP_IRS": {
                                    required: true
                                },
                                "TX_FIXA_IRS": {
                                    number: true
                                },
                                "GRAU_DEFICIENCIA": {
                                    required: true
                                },
                                "IBAN1": {
                                    iban: function (el) {
                                        if (el.value == "") {
                                            return true;
                                        } else {
                                            var x = validateIBAN(el.value);
                                            console.log(x);
                                            return true
                                        }
                                    },
                                    "metodo_pagamento": true
                                },
                                "IBAN2": {
                                    iban: function (el) {
                                        if (el.value == "") {
                                            return true;
                                        } else {
                                            var x = validateIBAN(el.value);
                                            console.log(x);
                                            return true
                                        }
                                    },
                                    "metodo_pagamento": true
                                },
                                "IBAN3": {
                                    iban: function (el) {
                                        if (el.value == "") {
                                            return true;
                                        } else {
                                            var x = validateIBAN(el.value);
                                            console.log(x);
                                            return true
                                        }
                                    },
                                    "metodo_pagamento": true
                                },
                                "IBAN4": {
                                    iban: function (el) {
                                        if (el.value == "") {
                                            return true;
                                        } else {
                                            var x = validateIBAN(el.value);
                                            console.log(x);
                                            return true
                                        }
                                    },
                                    "metodo_pagamento": true
                                },
                                "VLR_BI_TB": {
                                    number: true,
                                    "limite_pagamento": true
                                },
                                "NR_DIUTURNIDADES": {
                                    integer: true,
                                    maxlength: 4
                                },
                                "NR_PREMIOS_ANTIG": {
                                    integer: true,
                                    maxlength: 4
                                },
                                "DT_REGIME_SINDICAL": {
                                    dateISO: true
                                }
                            },
                            "messages": {
                                "IBAN1": {
                                    iban: "<?php echo $error_invalid_iban; ?>"
                                },
                                "IBAN2": {
                                    iban: "<?php echo $error_invalid_iban; ?>"
                                },
                                "IBAN3": {
                                    iban: "<?php echo $error_invalid_iban; ?>"
                                },
                                "IBAN4": {
                                    iban: "<?php echo $error_invalid_iban; ?>"
                                }
                            }
                        }
                    };
                    RH_ID_RETRIBUTIVOS = new QuadForm();
                    RH_ID_RETRIBUTIVOS.initForm($.extend({}, datatable_instance_defaults, optionsRH_ID_RETRIBUTIVOS));
                    $("#RH_ID_RETRIBUTIVOS")
                        .find("a[data-form-action=enter-query]")
                        .remove(); 
                }
                //END Elementos Retributivos

                //Starts by DECLARING LOCAL Validation RULES:
                if (1 === 1) {
                    // Se IBAN definido => forma pagamento = TRANSFERÊNCIA
                    $.validator.addMethod("metodo_pagamento", function (value, element, param) {
                        var forma_pagam_ = $("[name=FORMA_PAGAMENTO]"),
                            operation_ = RH_ID_RETRIBUTIVOS['operation'];
                            
                        if (value != '' && (operation_ == 'INSERT' || operation_ == 'UPDATE') && forma_pagam_.val() !== 'T') {
                            forma_pagam_.val("T");
                        }
                        return true;
                    }, function (params, element) {
                        return true;
                    });

                    // Limite de pagamento de vencimento associado ao IBAN1 - se tipo de limite definido obriga preenchimento do tipo de valor do limite
                    $.validator.addMethod("limite_pagamento", function (value, element, param) {
                        var tipo_lim_pag_ = $("[name=TP_VLR_BI_TB]");
                        if (tipo_lim_pag_.val() != '' && value === '') {
                            return false;
                        }
                        return true;
                    }, function (params, element) {
                        return "<?php echo $ui_required_attribute;?>";
                    });

                }
                //END DECLARING LOCAL Validation RULES
                                
                //Informação Profissional + Funções + Vínculos
                if  ( !conf_CADASTRO['RH_ID_PROFISSIONAIS']["access"] && !conf_CADASTRO['RH_ID_FUNCOES']["access"] && !conf_CADASTRO['RH_ID_VINCULOS']["access"] ) {
                    $('a[href="#Tab23"]').closest('li').remove(); //Estrutura TAB.LINK
                    $('#Tab23').remove(); //Estrutura DIV.PANEL
                    $('div.FUNCOES').remove();
                    $('div.VINCULOS').remove();
                } else {
                    if  ( conf_CADASTRO['RH_ID_PROFISSIONAIS']["access"] ) {                    
                        //RGPD
                        setBulk_RGPD_on_Form ("#RH_ID_PROFISSIONAIS", conf_CADASTRO['RH_ID_PROFISSIONAIS']["rgpd"]);
                        // -> LISTS
                        setRGPD_Field_on_Form ("#RH_ID_PROFISSIONAIS", "CATG_PROF", conf_CADASTRO['RH_ID_PROFISSIONAIS']["rgpd"]["CD_CATG_PROF"]);                
                        setRGPD_Field_on_Form ("#RH_ID_PROFISSIONAIS", "CATG_PROF_INTERNA", conf_CADASTRO['RH_ID_PROFISSIONAIS']["rgpd"]["CD_CATG_PROF_INTERNA"]);
                        setRGPD_Field_on_Form ("#RH_ID_PROFISSIONAIS", "DSP_IRCT_II", conf_CADASTRO['RH_ID_PROFISSIONAIS']["rgpd"]["CD_IRCT"] && conf_CADASTRO['RH_ID_PROFISSIONAIS']["rgpd"]["DT_EFICACIA"]);
                        setRGPD_Field_on_Form ("#RH_ID_PROFISSIONAIS", "DSP_PROFISSAO", conf_CADASTRO['RH_ID_PROFISSIONAIS']["rgpd"]["CD_PROFISSAO"]);
                        setRGPD_Field_on_Form ("#RH_ID_PROFISSIONAIS", "DSP_NIVEL_QUALIF", conf_CADASTRO['RH_ID_PROFISSIONAIS']["rgpd"]["CD_NIVEL_QUALIF"]);
                        setRGPD_Field_on_Form ("#RH_ID_PROFISSIONAIS", "DSP_PONTO", conf_CADASTRO['RH_ID_PROFISSIONAIS']["rgpd"]["CD_REGRA_PONTO"]);                
                        setRGPD_Field_on_Form ("#RH_ID_PROFISSIONAIS", "DSP_TP_HORARIO", conf_CADASTRO['RH_ID_PROFISSIONAIS']["rgpd"]["TP_HORARIO"]);
                        setRGPD_Field_on_Form ("#RH_ID_PROFISSIONAIS", "DSP_HORARIO", conf_CADASTRO['RH_ID_PROFISSIONAIS']["rgpd"]["TP_HORARIO"] && conf_CADASTRO['RH_ID_PROFISSIONAIS']["rgpd"]["CD_HORARIO"]);
                        setRGPD_Field_on_Form ("#RH_ID_PROFISSIONAIS", "DSP_GRUPO", conf_CADASTRO['RH_ID_PROFISSIONAIS']["rgpd"]["CD_GRUPO"]);
                        setRGPD_Field_on_Form ("#RH_ID_PROFISSIONAIS", "DSP_NIVEL", conf_CADASTRO['RH_ID_PROFISSIONAIS']["rgpd"]["CD_NIVEL"]);
                        setRGPD_Field_on_Form ("#RH_ID_PROFISSIONAIS", "DSP_SIT_CONTRIB", conf_CADASTRO['RH_ID_PROFISSIONAIS']["rgpd"]["CD_SIT_CONTRIB"]);
                        //END RGPD                    
                        var optionsRH_ID_PROFISSIONAIS = {
                            "formId": "#RH_ID_PROFISSIONAIS",
                            "table": "RH_ID_PROFISSIONAIS",
                            "workFlow": conf_CADASTRO['RH_ID_PROFISSIONAIS']["workflow"],
                            "info": true, //Disables INFO: (record / total records) :: HOW ????
                            "pk": {
                                "primary": {
                                    "EMPRESA": {"type": "varchar"},
                                    "RHID": {"type": "number"},
                                    "DT_ADMISSAO": {"type": "date"}
                                }
                            },
                            "dependsOn": {
                                "RH_ID_EMPRESAS": {
                                    "EMPRESA": "EMPRESA",
                                    "RHID": "RHID",
                                    "DT_ADMISSAO": "DT_ADMISSAO"
                                }
                            },
                            // "initialWhereClause": " GENERO = 'M' ", optional
                            //"order_by": "DT_ADMISSAO DESC",
                            //detailsObjects: ['qTableDocs', 'qTableAgregados', 'Documentos', 'Agregados'],                
                            "recordBundle": 1,
                            "crud": conf_CADASTRO['RH_ID_PROFISSIONAIS']["crud"],//create,update,delete
                            "defaultButtons": ['enter-query', 'new'],
                            "refreshData": true, //default true
                            "queryAll": false,//defaults to true ...empty search return all records
                            "showMultiRecord": false, //default true
                            //workflow: true, //optional defaults to false
                            "showWorkflowOnEdit": false,
                            "order": false, //Requires view <TABLE_NAME>_VW                
                            "dateFields": {
                                "DT_PROFISSAO": "date",
                                "DT_NIVEL_QUALIF": "date",
                                "DT_HORARIO": "date"
                            },
                            "domainLists": {
                                "SITUACAO_PROF": {
                                    "domain-list": true,
                                    "dependent-group": "RH_ID_PROFISSIONAIS.SITUACAO_PROF"
                                },
                                "TP_PROMOCAO": {
                                    "domain-list": true,
                                    "dependent-group": "RH_ID_PROFISSIONAIS.TP_PROMOCAO"
                                },
                                "TP_IRS": {
                                    "domain-list": true,
                                    "dependent-group": "RH_TP_IRS"
                                },
                                "TABELA_IRS": {
                                    "domain-list": true,
                                    "dependent-group": "RH_TABELA_IRS"
                                }
                            },
                            "complexLists": {
                                "CATG_PROF": {
                                    "name": "CATG_PROF",
                                    "dependent-group": "CATG_PROF",
                                    "dependent-level": 1, // use dependent-level  ***NOT***  dependent-group-level
                                    "data-db-name": 'A.CD_CATG_PROF',
                                    "decodeFromTable": 'RH_DEF_CATS_PROFISSIONAIS A',
                                    "class": "form-control complexList chosen", //class complexList Mandatory . we have to catch events like change and chain select event
                                    "desigColumn": "CONCAT(CONCAT(A.CD_CATG_PROF,'-'),A.DSP_CATG_PROF)", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.
                                    "whereClause": '', //usado no 1º carregamento de TODOS os dados de uma complexList.php para descodificações de registos activos ou inactivos
                                    "orderBy": 'A.CD_CATG_PROF', //usado no complexList.php
                                    //"disabled": true, //Permite inibir o campo no Editor
                                    "filter": {
                                        "create": " AND A.ACTIVO = 'S'",
                                        "edit": " AND A.ACTIVO = 'S' ",
                                    }
                                },
                                "CATG_PROF_INTERNA": {
                                    "name": "CATG_PROF_INTERNA",
                                    "dependent-group": "CATG_PROF_INTERNA",
                                    "dependent-level": 1, // use dependent-level  ***NOT***  dependent-group-level
                                    "data-db-name": 'A.CD_CATG_PROF_INTERNA',
                                    "decodeFromTable": 'RH_DEF_CATEG_PROF_INTERNAS A',
                                    "class": "form-control complexList chosen", //class complexList Mandatory . we have to catch events like change and chain select event
                                    "desigColumn": "CONCAT(CONCAT(A.CD_CATG_PROF_INTERNA,'-'),A.DSP_CATG_PROF_INTERNA)", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.
                                    "whereClause": '', //usado no 1º carregamento de TODOS os dados de uma complexList.php para descodificações de registos activos ou inactivos
                                    "orderBy": 'A.CD_CATG_PROF_INTERNA', //usado no complexList.php
                                    //"disabled": true, //Permite inibir o campo no Editor
                                    "filter": {
                                        "create": " AND A.ACTIVO = 'S'",
                                        "edit": " AND A.ACTIVO = 'S' ",
                                    }
                                },
                                "DSP_IRCT_II": {
                                    "name": "DSP_IRCT_II",
                                    "dependent-group": "IRCT",
                                    "dependent-level": 1,
                                    "data-db-name": "A.CD_IRCT@A.DT_EFICACIA",
                                    "decodeFromTable": "RH_DEF_IRCT A",
                                    "desigColumn": "CONCAT(CONCAT(A.CD_IRCT, '-'), A.DSR_IRCT)",
                                    "orderBy": "A.DT_EFICACIA DESC",
                                    "class": "form-control complexList chosen",
                                },
                                "DSP_PROFISSAO": {
                                    "name": "DSP_PROFISSAO",
                                    "dependent-group": "PROFISSOES",
                                    "dependent-level": 1,
                                    "data-db-name": "A.CD_PROFISSAO",
                                    "decodeFromTable": "RH_DEF_PROFISSOES A",
                                    "desigColumn": "CONCAT(CONCAT(A.CD_PROFISSAO, '-'), A.DSR_PROFISSAO)",
                                    "orderBy": "A.CD_PROFISSAO",
                                    "class": "form-control complexList chosen",
                                    "filter": {
                                        "create": " AND A.ACTIVO = 'S'",
                                        "edit": " AND A.ACTIVO = 'S' ",
                                    }
                                },
                                "DSP_NIVEL_QUALIF": {
                                    "name": "DSP_NIVEL_QUALIF",
                                    "dependent-group": "NIVEL_QUALIF",
                                    "dependent-level": 1,
                                    "data-db-name": "A.CD_NIVEL_QUALIF",
                                    "decodeFromTable": "RH_DEF_NIVEIS_QUALIFICACAO A",
                                    "desigColumn": "CONCAT(CONCAT(A.CD_NIVEL_QUALIF, '-'),A. DSP_NIVEL_QUALIF)",
                                    "orderBy": "A.CD_NIVEL_QUALIF",
                                    "class": "form-control complexList chosen",
                                    "filter": {
                                        "create": " AND A.ACTIVO = 'S'",
                                        "edit": " AND A.ACTIVO = 'S' ",
                                    }
                                },
                                "DSP_PONTO": {
                                    "name": "DSP_PONTO",
                                    "dependent-group": "REGRAS_PONTO",
                                    "dependent-level": 1,
                                    "data-db-name": "A.CD_REGRA_PONTO",
                                    "decodeFromTable": "RH_DEF_REGRAS_PONTO A",
                                    "desigColumn": "CONCAT(CONCAT(A.CD_REGRA_PONTO, '-'), A.DSR_REGRA_PONTO)",
                                    "orderBy": "A.CD_REGRA_PONTO",
                                    "class": "form-control complexList chosen",
                                    "filter": {
                                        "create": " AND A.ACTIVO = 'S'",
                                        "edit": " AND A.ACTIVO = 'S' ",
                                    }
                                },
                                "DSP_TP_HORARIO": { //RH_DEF_HORARIOS.TP_HORARIO
                                    "name": "DSP_TP_HORARIO",
                                    "dependent-group": "HORARIO",
                                    "dependent-level": 1,
                                    "data-db-name": "A.RV_LOW_VALUE",
                                    "decodeFromTable": "CG_REF_CODES A",
                                    "distribute-value": "A.TP_HORARIO",
                                    "desigColumn": "A.RV_MEANING",
                                    "orderBy": "A.RV_LOW_VALUE",
                                    "whereClause": " AND A.RV_DOMAIN = 'RH_DEF_HORARIOS.TP_HORARIO'",
                                    "class": "form-control complexList chosen",
                                },
                                "DSP_HORARIO": {
                                    "deferred": true,
                                    "name": "DSP_HORARIO",
                                    "dependent-group": "HORARIO",
                                    "dependent-level": 2,
                                    "data-db-name": "A.TP_HORARIO@A.CD_HORARIO",
                                    "decodeFromTable": "RH_DEF_HORARIOS A",
                                    "desigColumn": "CONCAT(CONCAT(A.CD_HORARIO, '-'), A.DSR_HORARIO)",
                                    //"whereClause": " AND TP_HORARIO = ':TP_HORARIO'", //
                                    "orderBy": "A.CD_HORARIO",
                                    "class": "form-control complexList chosen",
                                    "filter": {
                                        "create": " AND A.ACTIVO = 'S' AND A.TP_HORARIO = ':TP_HORARIO'",
                                        "edit": " AND A.ACTIVO = 'S' AND A.TP_HORARIO = ':TP_HORARIO'",
                                    }
                                },
                                "DSP_GRUPO": {
                                    "name": "DSP_GRUPO",
                                    "dependent-group": "GRUPOS",
                                    "dependent-level": 1,
                                    "data-db-name": "A.CD_GRUPO",
                                    "decodeFromTable": "RH_DEF_GRUPOS A",
                                    "desigColumn": "CONCAT(CONCAT(A.CD_GRUPO, '-'), A.DSP_GRUPO)",
                                    //"whereClause": " AND TP_HORARIO = ':TP_HORARIO'", //
                                    "orderBy": "A.CD_GRUPO",
                                    "class": "form-control complexList chosen",
                                    "filter": {
                                        "create": " AND A.ACTIVO = 'S'",
                                        "edit": " AND A.ACTIVO = 'S'",
                                    }
                                },
                                "DSP_NIVEL": {
                                    "name": "DSP_NIVEL",
                                    "dependent-group": "NIVEIS",
                                    "dependent-level": 1,
                                    "data-db-name": "A.CD_NIVEL",
                                    "decodeFromTable": "RH_DEF_NIVEIS A",
                                    "desigColumn": "CONCAT(CONCAT(A.CD_NIVEL, '-'), A.DSP_NIVEL)",
                                    //"whereClause": " AND TP_HORARIO = ':TP_HORARIO'", //
                                    "orderBy": "A.CD_NIVEL",
                                    "class": "form-control complexList chosen",
                                    "filter": {
                                        "create": " AND A.ACTIVO = 'S'",
                                        "edit": " AND A.ACTIVO = 'S'",
                                    }
                                },
                                "DSP_SIT_CONTRIB": {
                                    "name": "DSP_SIT_CONTRIB",
                                    "dependent-group": "SIT_CONTRIB",
                                    "dependent-level": 1,
                                    "data-db-name": "A.CD_SIT_CONTRIB",
                                    "decodeFromTable": "RH_DEF_SIT_CONTRIBUTIVAS A",
                                    "desigColumn": "CONCAT(CONCAT(A.CD_SIT_CONTRIB, '-'), A.DSP_SIT_CONTRIB)",
                                    //"whereClause": " AND TP_HORARIO = ':TP_HORARIO'", //
                                    "orderBy": "A.CD_SIT_CONTRIB",
                                    "class": "form-control complexList chosen",
                                    "filter": {
                                        "create": " AND A.ACTIVO = 'S'",
                                        "edit": " AND A.ACTIVO = 'S'",
                                    }
                                },
                            },
                            "validations": {
                                "rules": {
                                    "DT_NIVEL": {
                                        dateISO: true
                                    },
                                    "DT_GRUPO": {
                                        dateISO: true
                                    },
                                    "DT_CATG_PROF": {
                                        dateISO: true
                                    },
                                    "DT_CATG_PROF_INTERNA": {
                                        dateISO: true
                                    },
                                    "DT_PROFISSAO": {
                                        dateISO: true
                                    },
                                    "DT_NIVEL_QUALIF": {
                                        dateISO: true
                                    },
                                    "DT_FUNC_INTERNA": {
                                        dateISO: true
                                    },
                                    "DT_SIT_CONTRIB": {
                                        dateISO: true
                                    },
                                    "DT_HORARIO": {
                                        dateISO: true
                                    },
                                    "DT_ADESAO_IRCT": {
                                        dateISO: true
                                    },
                                    "DT_ULT_PROMOCAO": {
                                        dateISO: true
                                    }
                                }
                            }
                        };
                        RH_ID_PROFISSIONAIS = new QuadForm();
                        RH_ID_PROFISSIONAIS.initForm($.extend({}, datatable_instance_defaults, optionsRH_ID_PROFISSIONAIS));
                        $("#RH_ID_PROFISSIONAIS")
                            .find("a[data-form-action=enter-query]")
                            .remove();
                    } else {
                        $('#RH_ID_PROFISSIONAIS').remove();
                    }
                    
                    if  ( !conf_CADASTRO['RH_ID_FUNCOES']["access"] ) {
                        $('div.FUNCOES').remove();
                    } else {
                        //Funções "Oficiais" / "Internas"
                        var optionRH_ID_FUNCOES = {
                            "tableId": "RH_ID_FUNCOES",
                            "table": "RH_ID_FUNCOES",
                            "workFlow": conf_CADASTRO['RH_ID_FUNCOES']["workflow"],
                            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_adaptability; ?>",
                            "pk": {
                                "primary": {
                                    "EMPRESA": {"type": "varchar"},
                                    "RHID": {"type": "number"},
                                    "DT_ADMISSAO": {"type": "date"},
                                    "ID_FUNCAO": {"type": "number"},
                                    "TP_REGISTO": {"type": "varchar"},
                                    "DT_INI_FUNCAO": {"type": "date"},
                                    "TIPO": {"type": "varchar"},
                                    "DT_INI": {"type": "date"}
                                }
                            },
                            "dependsOn": {
                                "RH_ID_EMPRESAS": {
                                    "EMPRESA": "EMPRESA",
                                    "RHID": "RHID",
                                    "DT_ADMISSAO": "DT_ADMISSAO"
                                }
                            },
                            "on_pre_submit": "RH_ID_FUNCOES",
                            "initialWhereClause": " TP_REGISTO = 'A' AND TIPO IN ('A', 'B') ",
                            "order_by": "DT_INI DESC",
                            "recordBundle": 4,
                            "pageLenght": 4,
                            "scrollY": "117",
                            "responsive": true,
                            "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
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
                                    "data": 'RHID',
                                    "name": 'RHID',
                                    "exclude": !conf_CADASTRO['RH_ID_FUNCOES']["rgpd"]["RHID"],
                                    "type": "hidden",
                                    "visible": false,
                                }, {
                                    "title": "", //Datatables
                                    "label": "", //Editor
                                    "data": 'EMPRESA',
                                    "name": 'EMPRESA',
                                    "type": "hidden",
                                    "exclude": !conf_CADASTRO['RH_ID_FUNCOES']["rgpd"]["EMPRESA"],
                                    "visible": false,
                                    "className": "",
                                }, {
                                    "title": "", //Datatables
                                    "label": "", //Editor
                                    "data": 'DT_ADMISSAO',
                                    "name": 'DT_ADMISSAO',
                                    "exclude": !conf_CADASTRO['RH_ID_FUNCOES']["rgpd"]["DT_ADMISSAO"],
                                    "type": "hidden",
                                    "visible": false,
                                    "className": "",
                                    "datatype": "date"
                                }, {
                                    "title": "", //Datatables
                                    "label": "", //Editor
                                    "data": 'ID_FUNCAO',
                                    "name": 'ID_FUNCAO',
                                    "exclude": !conf_CADASTRO['RH_ID_FUNCOES']["rgpd"]["ID_FUNCAO"],
                                    "type": "hidden", //Editor
                                    "visible": false, //DataTables  
                                }, {
                                    "title": "", //Datatables
                                    "label": "", //Editor
                                    "data": 'TP_REGISTO',
                                    "name": 'TP_REGISTO',
                                    "exclude": !conf_CADASTRO['RH_ID_FUNCOES']["rgpd"]["TP_REGISTO"],
                                    "def": "A",
                                    "defaultContent": "A",
                                    "type": "hidden", //Editor
                                    "visible": false, //DataTables  
                                }, {
                                    "title": "", //Datatables
                                    "label": "", //Editor
                                    "data": 'DT_INI_FUNCAO',
                                    "name": 'DT_INI_FUNCAO',
                                    "exclude": !conf_CADASTRO['RH_ID_FUNCOES']["rgpd"]["DT_INI_FUNCAO"],
                                    "type": "hidden", //Editor
                                    "visible": false, //DataTables 
                                    "datatype": "datetime"
                                }, {
                                    "title": "", //Datatables
                                    "label": "", //Editor
                                    "data": 'TIPO',
                                    "name": 'TIPO',
                                    "exclude": !conf_CADASTRO['RH_ID_FUNCOES']["rgpd"]["TIPO"],
                                    "type": "hidden", //Editor
                                    "visible": false //DataTables 
                                }, {
                                    "responsivePriority": 2,
                                    "complexList": true,
                                    "title": "<?php echo mb_strtoupper($ui_type,'UTF-8'); ?>", //Datatables
                                    "label": "<?php echo $ui_type; ?>", //Editor
                                    "data": 'DSP_TIPO',
                                    "name": 'DSP_TIPO',
                                    "exclude": !conf_CADASTRO['RH_ID_FUNCOES']["rgpd"]["TIPO"],
                                    "type": "select",
                                    "className": "visibleColumn",
                                    //"renew": true,
                                    "attr": {
                                        "dependent-group": "TIPO_IN",
                                        "dependent-level": 1,
                                        "data-db-name": "A.CD",
                                        "distribute-value": "TIPO",
                                        "decodeFromTable": "RH_ID_FUNCOES_TIPO_IN A",
                                        "desigColumn": "A.DSP",
                                        "orderBy": "A.CD",
                                        "class": "form-control complexList chosen"
                                    },
                                }, {
                                    "responsivePriority": 3,
                                    "complexList": true,
                                    "title": "<?php echo mb_strtoupper($ui_function,'UTF-8'); ?>",
                                    "label": "<?php echo $ui_function; ?>",
                                    "data": 'DSP_FUNCAO',
                                    "name": 'DSP_FUNCAO',
                                    "exclude": !conf_CADASTRO['RH_ID_FUNCOES']["rgpd"]["EMPRESA"] && !conf_CADASTRO['RH_ID_FUNCOES']["rgpd"]["ID_FUNCAO"] && !conf_CADASTRO['RH_ID_FUNCOES']["rgpd"]["TP_REGISTO"] && !conf_CADASTRO['RH_ID_FUNCOES']["rgpd"]["DT_INI_FUNCAO"],
                                    "type": "select",
                                    "className": "visibleColumn",
                                    "renew": true,
                                    "attr": {
                                        "dependent-group": "FUNCOES",
                                        "dependent-level": 1,
                                        "data-db-name": "A.EMPRESA@A.ID_FUNCAO@A.TP_REGISTO@A.DT_INI_FUNCAO",
                                        "decodeFromTable": "RH_DEF_FUNCOES A",
                                        "whereClause": " AND A.TP_REGISTO = 'A' ",
                                        "desigColumn": "CONCAT(CONCAT(A.ID_FUNCAO, '-'), A.DSR_FUNCAO)",
                                        "orderBy": "A.ID_FUNCAO DESC",
                                        "class": "form-control complexList chosen",
                                        "filter": {
                                            "create": " AND A.DT_FIM_FUNCAO IS NULL", //On-New-Record
                                            "edit": " AND A.DT_FIM_FUNCAO IS NULL", //On-Edit-Record
                                        }
                                    },
                                }, {
                                    "responsivePriority": 4,
                                    "title": "<?php echo mb_strtoupper($ui_begin_date,'UTF-8'); ?>", //Datatables
                                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                                    "data": 'DT_INI',
                                    "name": 'DT_INI',
                                    "exclude": !conf_CADASTRO['RH_ID_FUNCOES']["rgpd"]["DT_INI"],
                                    "datatype": 'date',
                                    "className": "visibleColumn",
                                    //"type": "hidden", //Editor
                                    "attr": {
                                        "class": "datepicker"
                                    }
                                }, {
                                    "title": "<?php echo mb_strtoupper($ui_end_date,'UTF-8'); ?>", //Datatables
                                    "label": "<?php echo $ui_end_date; ?>", //Editor
                                    "data": 'DT_FIM',
                                    "name": 'DT_FIM',
                                    "exclude": !conf_CADASTRO['RH_ID_FUNCOES']["rgpd"]["DT_FIM"],
                                    "datatype": 'date',
                                    "className": "visibleColumn",
                                    //"type": "hidden", //Editor
                                    "attr": {
                                        "class": "datepicker"
                                    }
                                }, {
                                    "title": "<?php echo mb_strtoupper($ui_description,'UTF-8'); ?>", //Datatables
                                    "label": "<?php echo $ui_description; ?>", //Editor
                                    "data": 'DESCRICAO',
                                    "name": 'DESCRICAO',
                                    "exclude": !conf_CADASTRO['RH_ID_FUNCOES']["rgpd"]["DESCRICAO"],
                                    "type": 'textarea', //Editor
                                    "className": "none visibleColumn",
                                    "attr": {
                                        "style": "max-width: 355px",
                                        "class": "form-control len-355"
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
                                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions,'UTF-8'); ?>" + '</span>',
                                    "label": '',
                                    "data": null,
                                    "name": 'RECORD_HISTORY',
                                    "type": "hidden",
                                    "className": "none visibleColumn",
                                    "render": function (val, type, row) {
                                        return tablesRecordHistory(val, type, row);
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
                                        //
                                        return RH_ID_FUNCOES.crudButtons(conf_CADASTRO['RH_ID_FUNCOES']["crud"][0], conf_CADASTRO['RH_ID_FUNCOES']["crud"][1], conf_CADASTRO['RH_ID_FUNCOES']["crud"][2]);
                                    }
                                }
                            ],
                            "validations": {
                                "rules": {
                                    "TIPO": {
                                        required: true
                                    },
                                    "DSP_FUNCAO": {
                                        required: true
                                    },
                                    "DESCRICAO": {
                                        maxlength: 4000,
                                    },
                                    "DT_INI": {
                                        required: true,
                                        dateISO: true,
                                    },
                                    "DT_FIM": {
                                        dateISO: true,
                                        dateEqOrNextThan: 'DT_INI',
                                    }
                                },
                                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                                "messages": {
                                    "DT_FIM": {
                                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                                    }
                                }
                            }
                        };
                        RH_ID_FUNCOES = new QuadTable();
                        RH_ID_FUNCOES.initTable($.extend({}, datatable_instance_defaults, optionRH_ID_FUNCOES));
                        //END Funções "Oficiais" / "Internas"
                    }
                    
                    if  ( !conf_CADASTRO['RH_ID_VINCULOS']["access"] ) {
                        $('div.VINCULOS').remove();
                    } else {
                        //Vínculos contratuais
                        var optionRH_ID_VINCULOS = {
                            "tableId": "RH_ID_VINCULOS",
                            "table": "RH_ID_VINCULOS",
                            "workFlow": conf_CADASTRO['RH_ID_VINCULOS']["workflow"],
                            "pk": {
                                "primary": {
                                    "EMPRESA": {"type": "varchar"},
                                    "RHID": {"type": "number"},
                                    "DT_ADMISSAO": {"type": "date"},
                                    "CD_VINCULO": {"type": "varchar"},
                                    "DT_INI_VINCULO": {"type": "date"}
                                }
                            },
                            "dependsOn": {
                                " ": {
                                    "EMPRESA": "EMPRESA",
                                    "RHID": "RHID",
                                    "DT_ADMISSAO": "DT_ADMISSAO"
                                }
                            },
                            "on_pre_submit": "RH_ID_VINCULOS",                                
                            //"initialWhereClause": " ",
                            "order_by": "DT_INI_VINCULO DESC",
                            "recordBundle": 4,
                            "pageLenght": 4,
                            "scrollY": "117",
                            "responsive": true,
                            "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
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
                                    "data": 'RHID',
                                    "name": 'RHID',
                                    "exclude": !conf_CADASTRO['RH_ID_VINCULOS']["rgpd"]["RHID"],
                                    "type": "hidden",
                                    "visible": false,
                                }, {
                                    "title": "", //Datatables
                                    "label": "", //Editor
                                    "data": 'EMPRESA',
                                    "name": 'EMPRESA',
                                    "exclude": !conf_CADASTRO['RH_ID_VINCULOS']["rgpd"]["EMPRESA"],
                                    "type": "hidden",
                                    "visible": false,
                                    "className": "",
                                }, {
                                    "title": "", //Datatables
                                    "label": "", //Editor
                                    "data": 'DT_ADMISSAO',
                                    "name": 'DT_ADMISSAO',
                                    "exclude": !conf_CADASTRO['RH_ID_VINCULOS']["rgpd"]["DT_ADMISSAO"],
                                    "type": "hidden",
                                    "visible": false,
                                    "className": "",
                                    "datatype": "date"
                                }, {
                                    "title": "", //Datatables
                                    "label": "", //Editor
                                    "data": 'CD_VINCULO',
                                    "name": 'CD_VINCULO',
                                    "exclude": !conf_CADASTRO['RH_ID_VINCULOS']["rgpd"]["CD_VINCULO"],
                                    "type": "hidden", //Editor
                                    "visible": false, //DataTables  
                                }, {
                                    "title": "", //Datatables
                                    "label": "", //Editor
                                    "data": 'TP_VINCULO',
                                    "name": 'TP_VINCULO',
                                    "exclude": !conf_CADASTRO['RH_ID_VINCULOS']["rgpd"]["TP_VINCULO"],
                                    "type": "hidden",
                                    "visible": false,
                                    "className": ""
                                }, {
                                    "responsivePriority": 2,
                                    "complexList": true,
                                    "title": "<?php echo mb_strtoupper($ui_labour_contract,'UTF-8'); ?>", //Datatables
                                    "label": "<?php echo $ui_labour_contract; ?>", //Editor
                                    "data": 'DSP_VINCULO',
                                    "name": 'DSP_VINCULO',
                                    "exclude": !conf_CADASTRO['RH_ID_VINCULOS']["rgpd"]["TP_VINCULO"] && !conf_CADASTRO['RH_ID_VINCULOS']["rgpd"]["CD_VINCULO"] ,
                                    "type": "select",
                                    "className": "visibleColumn",
                                    //"renew": true,
                                    "attr": {
                                        "dependent-group": "VINCULOS",
                                        "dependent-level": 1,
                                        "data-db-name": "A.CD_VINCULO",
                                        "decodeFromTable": "RH_DEF_VINCULOS_CONTRATUAIS A",
                                        "desigColumn": "CONCAT(CONCAT(A.CD_VINCULO,'-'), A.DSR_VINCULO)",
                                        "otherValues": "A.TP_VINCULO",
                                        "orderBy": "A.CD_VINCULO",
                                        "class": "form-control complexList chosen"
                                    }                                        
                                }, {
                                    "responsivePriority": 3, 
                                    "title": "<?php echo mb_strtoupper($ui_admission_purpose, 'UTF-8'); ?>",
                                    "label": "<?php echo $ui_admission_purpose; ?>",
                                    "data": 'MOTIVO_ADMISSAO',
                                    "name": 'MOTIVO_ADMISSAO',
                                    "exclude": !conf_CADASTRO['RH_ID_VINCULOS']["rgpd"]["MOTIVO_ADMISSAO"],
                                    "type": "select",
                                    "className": "visibleColumn",
                                    "attr": {
                                        "domain-list": true,
                                        "dependent-group": 'RH_MOTIVO_ADMISSAO',
                                        "class": "form-control"
                                    },
                                    "render": function (val, type, row) {
                                        if (val != null) {
                                            var o = _.find(initApp.joinsData['RH_MOTIVO_ADMISSAO'], {'RV_LOW_VALUE': val});
                                            return val == null ? null : o['RV_MEANING'];
                                        }
                                        return val;
                                    }
                                }, {
                                    "responsivePriority": 4,
                                    "title": "<?php echo mb_strtoupper($ui_begin_date,'UTF-8'); ?>", //Datatables
                                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                                    "data": 'DT_INI_VINCULO',
                                    "name": 'DT_INI_VINCULO',
                                    "exclude": !conf_CADASTRO['RH_ID_VINCULOS']["rgpd"]["DT_INI_VINCULO"],
                                    "datatype": 'date',
                                    "className": "visibleColumn",
                                    "attr": {
                                        "class": "datepicker"
                                    }

                                }, {
                                    "responsivePriority": 5,
                                    "title": "<?php echo mb_strtoupper($ui_end_date,'UTF-8'); ?>", //Datatables
                                    "label": "<?php echo $ui_end_date; ?>", //Editor
                                    "data": 'DT_FIM_VINCULO',
                                    "name": 'DT_FIM_VINCULO',
                                    "exclude": !conf_CADASTRO['RH_ID_VINCULOS']["rgpd"]["DT_FIM_VINCULO"],
                                    "datatype": 'date',
                                    "className": "visibleColumn",
                                    "attr": {
                                        "class": "datepicker"
                                    }
                                }, {
                                    "responsivePriority": 6,
                                    "title": "<?php echo mb_strtoupper($ui_experimental_end_dt,'UTF-8'); ?>", //Datatables
                                    "label": "<?php echo $ui_experimental_end_dt; ?>", //Editor
                                    "data": 'DT_FIM_PER_EXP',
                                    "name": 'DT_FIM_PER_EXP',
                                    "exclude": !conf_CADASTRO['RH_ID_VINCULOS']["rgpd"]["DT_FIM_PER_EXP"],
                                    "datatype": 'date',
                                    "className": "visibleColumn",
                                    "attr": {
                                        "class": "datepicker"
                                    }
                                }, {
                                    "responsivePriority": 7,
                                    "title": "<?php echo mb_strtoupper($ui_document_short,'UTF-8'); ?>", //Datatables
                                    "label": "<?php echo $ui_document_short; ?>", //Editor
                                    "data": 'ID_PROC_GD',
                                    "name": 'ID_PROC_GD',
                                    "exclude": !conf_CADASTRO['RH_ID_VINCULOS']["rgpd"]["ID_PROC_GD"],
                                    "className": "visibleColumn",
                                    "type": "hidden",
                                    "visible": true,
                                    "width": "1%",
                                    "attr": {
                                        "class": "form-control"
                                    },
                                    "render": function (val, type, row) {
                                        //if (val)
                                        return '<a class=""><i class="far fa-file-download fa-2x"></i></a>';
                                    }                                    
//                                    }, {
//                                        "responsivePriority": 8, 
//                                        "title": "<?php echo mb_strtoupper($ui_active, 'UTF-8'); ?>",
//                                        "label": "<?php echo $ui_active; ?>",
//                                        "data": 'ACTIVO',
//                                        "name": 'ACTIVO',
//                                        "exclude": !conf_CADASTRO['RH_ID_VINCULOS']["rgpd"]["ACTIVO"],
//                                        "type": "select",
//                                        "className": "visibleColumn",
//                                        "attr": {
//                                            "domain-list": true,
//                                            "dependent-group": 'DG_SIM_NAO',
//                                            "class": "form-control"
//                                        },
//                                        "render": function (val, type, row) {
//                                            if (val != null) {
//                                                var o = _.find(initApp.joinsData['DG_SIM_NAO'], {'RV_LOW_VALUE': val});
//                                                return val == null ? null : o['RV_MEANING'];
//                                            }
//                                            return val;                          
//                                        }
                                }, {

                                    "title": "<?php echo mb_strtoupper($ui_termination_intent_dt,'UTF-8'); ?>", //Datatables
                                    "label": "<?php echo $ui_termination_intent_dt; ?>", //Editor
                                    "data": 'DT_DENUNCIA',
                                    "name": 'DT_DENUNCIA',
                                    "exclude": !conf_CADASTRO['RH_ID_VINCULOS']["rgpd"]["DT_DENUNCIA"],
                                    "datatype": 'date',
                                    "className": "none visibleColumn",
                                    "attr": {
                                        "class": "datepicker"
                                    }
                                }, {
                                    "title": "", //Datatables
                                    "label": "", //Editor
                                    "data": 'CD_MOTIVO_SAIDA',
                                    "name": 'CD_MOTIVO_SAIDA',
                                    "exclude": !conf_CADASTRO['RH_ID_VINCULOS']["rgpd"]["CD_MOTIVO_SAIDA"],
                                    "type": "hidden",
                                    "visible": false,
                                    "className": ""
                                }, {
                                    "complexList": true,
                                    "title": "<?php echo mb_strtoupper($ui_dissmissal_reason,'UTF-8'); ?>",
                                    "label": "<?php echo $ui_dissmissal_reason; ?>",
                                    "data": 'DSP_MOT_SAIDA',
                                    "name": 'DSP_MOT_SAIDA',
                                    "exclude": !conf_CADASTRO['RH_ID_VINCULOS']["rgpd"]["TP_VINCULO"] && !conf_CADASTRO['RH_ID_VINCULOS']["rgpd"]["CD_MOTIVO_SAIDA"],
                                    "type": "select",
                                    "className": "none visibleColumn",
                                    //"renew": true,
                                    "attr": {
                                        "deferred": true,
                                        "dependent-group": "MOT_SAIDA",
                                        "dependent-level": 1,
                                        "data-db-name": "A.CD_MOTIVO_SAIDA",
                                        "decodeFromTable": "RH_DEF_MOTIVOS_SAIDA A",
                                        "desigColumn": "A.DSP_MOTIVO_SAIDA",
                                        "otherValues": "A.TP_VINCULO",
                                        "orderBy": "A.CD_MOTIVO_SAIDA DESC",
                                        "class": "form-control complexList chosen",
                                        "filter": {
                                            "create": " AND A.ACTIVO = 'S' AND A.TP_VINCULO = ':TP_VINCULO' ", //On-New-Record
                                            "edit": " AND A.ACTIVO = 'S' AND A.TP_VINCULO = ':TP_VINCULO' ", //On-Edit-Record
                                        }
                                    }
                                }, {
                                    "title": "<?php echo mb_strtoupper($ui_predicted_end_date,'UTF-8'); ?>", //Datatables
                                    "label": "<?php echo $ui_predicted_end_date; ?>", //Editor
                                    "data": 'DT_FIM_PREV',
                                    "name": 'DT_FIM_PREV',
                                    "exclude": !conf_CADASTRO['RH_ID_VINCULOS']["rgpd"]["DT_FIM_PREV"],
                                    "datatype": 'date',
                                    "className": "none visibleColumn",
                                    "type": "hidden", //Editor
                                    "attr": {
                                        "class": "datepicker"
                                    }
                                }, {
                                    "title": "<?php echo mb_strtoupper($ui_net_income,'UTF-8'); ?>", //Datatables
                                    "label": "<?php echo $ui_net_income; ?>", //Editor
                                    "data": 'VLR_LIQUIDO',
                                    "name": 'VLR_LIQUIDO',
                                    "exclude": !conf_CADASTRO['RH_ID_VINCULOS']["rgpd"]["VLR_LIQUIDO"],
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
                                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions,'UTF-8'); ?>" + '</span>',
                                    "label": '',
                                    "data": null,
                                    "name": 'RECORD_HISTORY',
                                    "type": "hidden",
                                    "className": "none visibleColumn",
                                    "render": function (val, type, row) {
                                        return tablesRecordHistory(val, type, row);
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
                                        //
                                        return RH_ID_VINCULOS.crudButtons(conf_CADASTRO['RH_ID_VINCULOS']["crud"][0], conf_CADASTRO['RH_ID_VINCULOS']["crud"][1], conf_CADASTRO['RH_ID_VINCULOS']["crud"][2]);
                                    }
                                }
                            ],
                            "validations": {
                                "rules": {
                                    "DSP_VINCULO": {
                                        required: true
                                    },
                                    "DT_INI_VINCULO": {
                                        required: true,
                                        dateISO: true,
                                    },
                                    "VLR_LIQUIDO": {
                                        number: true
                                    },
                                    "DT_FIM_PER_EXP": {
                                        dateISO: true,
                                        dateEqOrNextThan: 'DT_INI_VINCULO'
                                    },
                                    "DT_DENUNCIA": {
                                        dateISO: true,
                                        dateEqOrNextThan: 'DT_INI_VINCULO'
                                    },
                                    "DT_FIM_PREV": {
                                        dateISO: true,
                                        dateEqOrNextThan: 'DT_INI_VINCULO'
                                    },
                                    "DT_FIM_VINCULO": {
                                        dateISO: true,
                                        dateEqOrNextThan: 'DT_INI_VINCULO',
                                    }
                                },
                                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                                "messages": {
                                    "DT_FIM_PER_EXP": {
                                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                                    },
                                    "DT_DENUNCIA": {
                                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                                    },
                                    "DT_FIM_PREV": {
                                       dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                                    },
                                    "DT_FIM_VINCULO": {
                                       dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                                    },
                                }
                            }
                        };
                        RH_ID_VINCULOS = new QuadTable();
                        RH_ID_VINCULOS.initTable($.extend({}, datatable_instance_defaults, optionRH_ID_VINCULOS));

                        //DECLARING LOCAL Validation RULES
                        if (1 === 1) {
                             //atualizar a lista de motivos da saida na inserção consoante o vínculo selecionado
                             $(document).on('RH_ID_VINCULOSAttachEvt', function (e) {
                                 $("#DTE_Field_DSP_VINCULO","#RH_ID_VINCULOS_editorForm").on('change', function(e) {
                                     var operacao = RH_ID_VINCULOS.editor.s["action"], frm_context = "#RH_ID_VINCULOS_editorForm",
                                         tp_vinc_val = $("#DTE_Field_DSP_VINCULO", frm_context).children("option:selected")[0]['dataset']['othervalues'],
                                         tp_vinc = $("#DTE_Field_TP_VINCULO", frm_context),
                                         mot_saida = $("#DTE_Field_DSP_MOT_SAIDA", frm_context); 
                                     if (operacao === 'create' && tp_vinc_val !== '') {
                                        tp_vinc.val(tp_vinc_val);
                                         // console.log("#3 tp_vinc",tp_vinc.val());
                                         var res = RH_ID_VINCULOS.getComplexListIndex( _.find(RH_ID_VINCULOS.tableCols, {name: "DSP_MOT_SAIDA"}));
                                         var res1 = _.filter(res,{"OTHERVALUES": tp_vinc.val()});
                                         // console.log("LISTA", res);
                                         // console.log("LISTA FILTRADA", res1);
                                         // reinicializar a lista de motivos de saída
                                         mot_saida
                                             .find('option')
                                             .remove()
                                             .end()
                                             .append($("<option></option>")
                                                     .attr("value","")
                                                     .text("")
                                             );   
                                         // percorrer os morivos de saida para os adicionar à lista    
                                         _.forEach(res1, function(value, key) {
                                             //console.log(key,value);
                                             mot_saida
                                                  .append($("<option></option>")
                                                             .attr("value",value['VAL'])
                                                             .text(value['DSP_MOTIVO_SAIDA']));   
                                         });
                                         // ativar a lista
                                         mot_saida.val("")
                                                 .trigger('change')
                                                 .trigger("chosen:updated");
                                     }
                                     else if (operacao === 'edit') {
                                             //mot_saida.chosen({allow_single_deselect: true});
                                             setTimeout(function () {
                                                 var options = {
                                                     allow_single_deselect: true
                                                 };
                                                 mot_saida.chosen(options);
                                                 mot_saida.trigger("chosen:updated");
                                             }, 300);
                                     };
                                 });
                             });
                        }
                        //END DECLARING LOCAL Validation RULE
                        //END Vínculos contratuais
                    }
                 }
                //END Informação Profissional + Funções                
                
                //Estruturas TAB
                if  ( !conf_CADASTRO['RH_ID_DEPTS']["access"] && !conf_CADASTRO['RH_ID_JOBS']["access"] &&
                      !conf_CADASTRO['RH_ID_SETORES']["access"] && !conf_CADASTRO['RH_ID_DESTACAMENTOS']["access"]
                    ) {
                    $('a[href="#Tab25"]').closest('li').remove(); //Estrutura TAB.LINK
                    $('#Tab25').remove(); //Estrutura DIV.PANEL
                } else {
                    //Departamentos
                    if ( conf_CADASTRO['RH_ID_DEPTS']["access"] ) {
                        var optionRH_ID_DEPTS = {
                            "tableId": "RH_ID_DEPTS",
                            "table": "RH_ID_DEPTS",
                            "workFlow": conf_CADASTRO['RH_ID_DEPTS']["workflow"],
                            "pk": {
                                "primary": {
                                    "EMPRESA": {"type": "varchar"},
                                    "RHID": {"type": "number"},
                                    "DT_ADMISSAO": {"type": "date"},
                                    "CD_DIRECAO": {"type": "varchar"},
                                    "DT_INI_DIRECAO": {"type": "date"},
                                    "CD_DEPT": {"type": "varchar"},
                                    "DT_INI_DEPT": {"type": "date"},
                                    "DT_INI": {"type": "date"},
                                    "TIPO": {"type": "varchar"}
                                }
                            },
                            "dependsOn": {
                                "RH_ID_EMPRESAS": {
                                    "EMPRESA": "EMPRESA",
                                    "RHID": "RHID",
                                    "DT_ADMISSAO": "DT_ADMISSAO"
                                }
                            },
                            "on_pre_submit": "RH_ID_DEPTS",
                            //"initialWhereClause": "",
                            "order_by": "DT_INI DESC",
                            "recordBundle": 4,
                            "pageLenght": 4,
                            "scrollY": "117",
                            "responsive": true,
                            "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
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
                                    "data": 'RHID',
                                    "name": 'RHID',
                                    "exclude": !conf_CADASTRO['RH_ID_DEPTS']["rgpd"]["RHID"],
                                    "type": "hidden",
                                    "visible": false,
                                }, {
                                    "title": "", //Datatables
                                    "label": "", //Editor
                                    "data": 'EMPRESA',
                                    "name": 'EMPRESA',
                                    "exclude": !conf_CADASTRO['RH_ID_DEPTS']["rgpd"]["RHID"],
                                    "type": "hidden",
                                    "visible": false,
                                    "className": "",
                                }, {
                                    "title": "", //Datatables
                                    "label": "", //Editor
                                    "data": 'DT_ADMISSAO',
                                    "name": 'DT_ADMISSAO',
                                    "exclude": !conf_CADASTRO['RH_ID_DEPTS']["rgpd"]["DT_ADMISSAO"],
                                    "type": "hidden",
                                    "visible": false,
                                    "className": "",
                                    "datatype": "date"
                                }, {
                                    "title": "", //Datatables
                                    "label": "", //Editor
                                    "data": 'CD_DIRECAO',
                                    "name": 'CD_DIRECAO',
                                    "exclude": !conf_CADASTRO['RH_ID_DEPTS']["rgpd"]["CD_DIRECAO"],
                                    "type": "hidden", //Editor
                                    "visible": false, //DataTables   
                                }, {
                                    "title": "", //Datatables
                                    "label": "", //Editor
                                    "data": 'DT_INI_DIRECAO',
                                    "name": 'DT_INI_DIRECAO',
                                    "exclude": !conf_CADASTRO['RH_ID_DEPTS']["rgpd"]["DT_INI_DIRECAO"],
                                    "type": "hidden", //Editor
                                    "visible": false, //DataTables                        
                                }, {
                                    "responsivePriority": 2,
                                    "complexList": true,
                                    "title": "<?php echo mb_strtoupper($ui_direction,'UTF-8'); ?>",
                                    "label": "<?php echo $ui_direction; ?>",
                                    "data": "DSP_DIRECAO",
                                    "name": "DSP_DIRECAO",
                                    "exclude": !conf_CADASTRO['RH_ID_DEPTS']["rgpd"]["EMPRESA"] && !conf_CADASTRO['RH_ID_DEPTS']["rgpd"]["CD_DIRECAO"] && !conf_CADASTRO['RH_ID_DEPTS']["rgpd"]["DT_INI_DIRECAO"],
                                    "className": "visibleColumn",
                                    "type": "select",
                                    "attr": {
                                        "deferred": true,
                                        "dependent-group": "EMPRESA",
                                        "dependent-level": 1,
                                        "data-db-name": 'A.EMPRESA@A.CD_DIRECAO@A.DT_INI_DIRECAO',
                                        "decodeFromTable": 'DG_DIRECOES A',
                                        "desigColumn": "CONCAT(CONCAT(A.CD_DIRECAO,'-'),A.DSP_DIRECAO)",
                                        'orderBy': 'A.EMPRESA,A.CD_DIRECAO',
                                        "class": "form-control complexList chosen",
                                        "filter": {
                                            "create": " AND A.DT_FIM IS NULL AND A.EMPRESA = ':EMPRESA' ",
                                            "edit": " AND A.DT_FIM IS NULL AND A.EMPRESA = ':EMPRESA' ",
                                        }
                                    }
                                }, {
                                    "title": "", //Datatables
                                    "label": "", //Editor
                                    "data": 'CD_DEPT',
                                    "name": 'CD_DEPT',
                                    "exclude": !conf_CADASTRO['RH_ID_DEPTS']["rgpd"]["CD_DEPT"],
                                    "type": "hidden", //Editor
                                    "visible": false, //DataTables   
                                }, {
                                    "title": "", //Datatables
                                    "label": "", //Editor
                                    "data": 'DT_INI_DEPT',
                                    "name": 'DT_INI_DEPT',
                                    "exclude": !conf_CADASTRO['RH_ID_DEPTS']["rgpd"]["DT_INI_DEPT"],
                                    "datatype": 'date',
                                    "type": "hidden", //Editor
                                    "visible": false, //DataTables   
                                }, {
                                    "responsivePriority": 3,
                                    "complexList": true,
                                    "title": "<?php echo mb_strtoupper($ui_department,'UTF-8'); ?>",
                                    "label": "<?php echo $ui_department; ?>",
                                    "data": "DSP_DEPT",
                                    "name": "DSP_DEPT",
                                    "exclude": !conf_CADASTRO['RH_ID_DEPTS']["rgpd"]["EMPRESA"] && !conf_CADASTRO['RH_ID_DEPTS']["rgpd"]["CD_DIRECAO"] && !conf_CADASTRO['RH_ID_DEPTS']["rgpd"]["DT_INI_DIRECAO"] && !conf_CADASTRO['RH_ID_DEPTS']["rgpd"]["CD_DEPT"] && !conf_CADASTRO['RH_ID_DEPTS']["rgpd"]["DT_INI_DEPT"],
                                    "type": "select",
                                    "className": "visibleColumn",
                                    "visible": true,
                                    "attr": {
                                        "dependent-group": "EMPRESA",
                                        "dependent-level": 2,
                                        "data-db-name": 'EMPRESA@CD_DIRECAO@DT_INI_DIRECAO@CD_DEPT@DT_INI_DEPT',
                                        "decodeFromTable": 'DG_DEPARTAMENTOS',
                                        "desigColumn": "CONCAT(CONCAT(CD_DEPT,'-'),DSP_DEPT)",
                                        'orderBy': 'EMPRESA,CD_DIRECAO,CD_DEPT',
                                        "class": "form-control complexList chosen",
                                        "filter": {
                                            "create": " AND DT_FIM IS NULL",
                                            "edit": " AND DT_FIM IS NULL",
                                        }
                                    }
                                }, {
                                    "responsivePriority": 4,
                                    "title": "<?php echo mb_strtoupper($ui_type,'UTF-8'); ?>", //Datatables
                                    "label": "<?php echo $ui_type; ?>", //Editor
                                    "data": 'TIPO',
                                    "name": 'TIPO',
                                    "exclude": !conf_CADASTRO['RH_ID_DEPTS']["rgpd"]["TIPO"],
                                    "type": "select",
                                    "def": "N",
                                    "className": "visibleColumn",
                                    "attr": {
                                        "domain-list": true,
                                        "dependent-group": 'RH_ID_DEPTS.TIPO',
                                        "class": "form-control"
                                    },
                                    "render": function (val, type, row) {
                                        if (val != null) {
                                            var o = _.find(initApp.joinsData['RH_ID_DEPTS.TIPO'], {'RV_LOW_VALUE': val});
                                            return val == null ? null : o['RV_MEANING'];
                                        }
                                        return val;
                                    }
                                }, {
                                    "responsivePriority": 5,
                                    "title": "<?php echo mb_strtoupper($ui_begin_date,'UTF-8'); ?>", //Datatables
                                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                                    "data": 'DT_INI',
                                    "name": 'DT_INI',
                                    "exclude": !conf_CADASTRO['RH_ID_DEPTS']["rgpd"]["DT_INI"],
                                    "datatype": 'date',
                                    "className": "visibleColumn",
                                    "attr": {
                                        "class": "datepicker"
                                    }
                                }, {
                                    "responsivePriority": 6,
                                    "title": "<?php echo mb_strtoupper($ui_end_date,'UTF-8'); ?>", //Datatables
                                    "label": "<?php echo $ui_end_date; ?>", //Editor
                                    "data": 'DT_FIM',
                                    "name": 'DT_FIM',
                                    "exclude": !conf_CADASTRO['RH_ID_DEPTS']["rgpd"]["DT_FIM"],
                                    "datatype": 'date',
                                    "className": "visibleColumn",
                                    "attr": {
                                        "class": "datepicker"
                                    }
                                }, {
                                    "title": "<?php echo mb_strtoupper($ui_obs_short,'UTF-8'); ?>", //Datatables
                                    "label": "<?php echo $ui_obs_short; ?>", //Editor
                                    "data": 'OBS',
                                    "name": 'OBS',
                                    "exclude": !conf_CADASTRO['RH_ID_DEPTS']["rgpd"]["OBS"],
                                    "type": 'textarea', //Editor
                                    "className": "none visibleColumn",
                                    "attr": {
                                        "style": "max-width: 355px",
                                        "class": "form-control len-355"
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
                                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions,'UTF-8'); ?>" + '</span>',
                                    "label": '',
                                    "data": null,
                                    "name": 'RECORD_HISTORY',
                                    "type": "hidden",
                                    "className": "none visibleColumn",
                                    "render": function (val, type, row) {
                                        return tablesRecordHistory(val, type, row);
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
                                        //
                                        return RH_ID_DEPTS.crudButtons(conf_CADASTRO['RH_ID_DEPTS']["crud"][0], conf_CADASTRO['RH_ID_DEPTS']["crud"][1], conf_CADASTRO['RH_ID_DEPTS']["crud"][2]);
                                    }
                                }
                            ],
                            "validations": {
                                "rules": {
                                    "DSP_DIRECAO": {
                                        required: true,
                                    },
                                    "DSP_DEPT": {
                                        required: true
                                    },
                                    "TIPO": {
                                        required: true
                                    },
                                    "DT_INI": {
                                        required: true,
                                        dateISO: true,
                                    },
                                    "OBS": {
                                        maxlength: 240
                                    },
                                    "DT_FIM": {
                                        dateISO: true,
                                        dateEqOrNextThan: 'DT_INI',
                                    }
                                },
                                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                                "messages": {
                                    "DT_FIM": {
                                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                                    }
                                }
                            }
                        };
                        RH_ID_DEPTS = new QuadTable();
                        RH_ID_DEPTS.initTable($.extend({}, datatable_instance_defaults, optionRH_ID_DEPTS));
                    } else {
                        $('article.RH_ID_DEPTS_container').remove();
                    }
                    //END Departamentos

                    //Jobs
                    if ( conf_CADASTRO['RH_ID_JOBS']["access"] ) {
                        var optionRH_ID_JOBS = {
                            "tableId": "RH_ID_JOBS",
                            "table": "RH_ID_JOBS",
                            "workFlow": conf_CADASTRO['RH_ID_JOBS']["workflow"],
                            "pk": {
                                "primary": {
                                    "EMPRESA": {"type": "varchar"},
                                    "RHID": {"type": "number"},
                                    "DT_ADMISSAO": {"type": "date"},
                                    "CD_JOB": {"type": "varchar"},
                                    "DT_INI_JOB": {"type": "date"},
                                    "DT_INI": {"type": "date"}
                                }
                            },
                            "dependsOn": {
                                "RH_ID_EMPRESAS": {
                                    "EMPRESA": "EMPRESA",
                                    "RHID": "RHID",
                                    "DT_ADMISSAO": "DT_ADMISSAO"
                                }
                            },
                            //"initialWhereClause": "",
                            "order_by": "DT_INI DESC",
                            "recordBundle": 4,
                            "pageLenght": 4,
                            "scrollY": "117",
                            "responsive": true,
                            "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
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
                                    "data": 'RHID',
                                    "name": 'RHID',
                                    "exclude": !conf_CADASTRO['RH_ID_JOBS']["rgpd"]["RHID"],
                                    "type": "hidden",
                                    "visible": false,
                                }, {
                                    "title": "", //Datatables
                                    "label": "", //Editor
                                    "data": 'EMPRESA',
                                    "name": 'EMPRESA',
                                    "exclude": !conf_CADASTRO['RH_ID_JOBS']["rgpd"]["EMPRESA"],
                                    "type": "hidden",
                                    "visible": false,
                                    "className": "",
                                }, {
                                    "title": "", //Datatables
                                    "label": "", //Editor
                                    "data": 'DT_ADMISSAO',
                                    "name": 'DT_ADMISSAO',
                                    "exclude": !conf_CADASTRO['RH_ID_JOBS']["rgpd"]["DT_ADMISSAO"],
                                    "type": "hidden",
                                    "visible": false,
                                    "className": "",
                                    "datatype": "date"
                                }, {
                                    "title": "", //Datatables
                                    "label": "", //Editor
                                    "data": 'CD_JOB',
                                    "name": 'CD_JOB',
                                    "exclude": !conf_CADASTRO['RH_ID_JOBS']["rgpd"]["CD_JOB"],
                                    "type": "hidden", //Editor
                                    "visible": false, //DataTables   
                                }, {
                                    "title": "", //Datatables
                                    "label": "", //Editor
                                    "data": 'DT_INI_JOB',
                                    "name": 'DT_INI_JOB',
                                    "exclude": !conf_CADASTRO['RH_ID_JOBS']["rgpd"]["DT_INI_JOB"],
                                    "type": "hidden", //Editor
                                    "visible": false, //DataTables                        
                                }, {
                                    "responsivePriority": 2,
                                    "complexList": true,
                                    "title": "<?php echo mb_strtoupper($ui_job,'UTF-8'); ?>",
                                    "label": "<?php echo $ui_job; ?>",
                                    "data": "DSP_JOB",
                                    "name": "DSP_JOB",
                                    "exclude": !conf_CADASTRO['RH_ID_JOBS']["rgpd"]["CD_JOB"] && !conf_CADASTRO['RH_ID_JOBS']["rgpd"]["DT_INI_JOB"] ,
                                    "className": "visibleColumn",
                                    "type": "select",
                                    "attr": {
                                        "dependent-group": "JOBS",
                                        "dependent-level": 1,
                                        "data-db-name": 'A.CD_JOB@A.DT_INI_JOB',
                                        "decodeFromTable": 'DG_JOBS A',
                                        "desigColumn": "CONCAT(CONCAT(A.CD_JOB,'-'),A.DSP_JOB)",
                                        'orderBy': 'A.CD_JOB',
                                        "class": "form-control complexList chosen",
                                        "filter": {
                                            "create": " AND A.DT_FIM IS NULL ",
                                            "edit": " AND A.DT_FIM IS NULL ",
                                        }
                                    }
                                }, {
                                    "responsivePriority": 3,
                                    "title": "<?php echo mb_strtoupper($ui_begin_date,'UTF-8'); ?>", //Datatables
                                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                                    "data": 'DT_INI',
                                    "name": 'DT_INI',
                                    "exclude": !conf_CADASTRO['RH_ID_JOBS']["rgpd"]["DT_INI"],
                                    "datatype": 'date',
                                    "className": "visibleColumn",
                                    "attr": {
                                        "class": "datepicker"
                                    }
                                }, {
                                    "responsivePriority": 4,
                                    "title": "<?php echo mb_strtoupper($ui_end_date,'UTF-8'); ?>", //Datatables
                                    "label": "<?php echo $ui_end_date; ?>", //Editor
                                    "data": 'DT_FIM',
                                    "name": 'DT_FIM',
                                    "exclude": !conf_CADASTRO['RH_ID_JOBS']["rgpd"]["DT_FIM"],
                                    "datatype": 'date',
                                    "className": "visibleColumn",
                                    "attr": {
                                        "class": "datepicker"
                                    }
                                }, {
                                    "title": "<?php echo mb_strtoupper($ui_obs_short,'UTF-8'); ?>", //Datatables
                                    "label": "<?php echo $ui_obs_short; ?>", //Editor
                                    "data": 'OBS',
                                    "name": 'OBS',
                                    "exclude": !conf_CADASTRO['RH_ID_JOBS']["rgpd"]["OBS"],
                                    "type": 'textarea', //Editor
                                    "className": "none visibleColumn",
                                    "attr": {
                                        "style": "max-width: 355px",
                                        "class": "form-control len-355"
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
                                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions,'UTF-8'); ?>" + '</span>',
                                    "label": '',
                                    "data": null,
                                    "name": 'RECORD_HISTORY',
                                    "type": "hidden",
                                    "className": "none visibleColumn",
                                    "render": function (val, type, row) {
                                        return tablesRecordHistory(val, type, row);
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
                                        return RH_ID_JOBS.crudButtons(conf_CADASTRO['RH_ID_JOBS']["crud"][0], conf_CADASTRO['RH_ID_JOBS']["crud"][1], conf_CADASTRO['RH_ID_JOBS']["crud"][2]);
                                    }
                                }
                            ],
                            "validations": {
                                "rules": {
                                    "DSP_JOB": {
                                        required: true,
                                    },
                                    "DT_INI": {
                                        required: true,
                                        dateISO: true,
                                    },
                                    "OBS": {
                                        maxlength: 240
                                    },
                                    "DT_FIM": {
                                        dateISO: true,
                                        dateEqOrNextThan: 'DT_INI',
                                    }
                                },
                                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                                "messages": {
                                    "DT_FIM": {
                                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                                    }
                                }
                            }
                        };
                        RH_ID_JOBS = new QuadTable();
                        RH_ID_JOBS.initTable($.extend({}, datatable_instance_defaults, optionRH_ID_JOBS));
                    } else {
                        $('article.RH_ID_JOBS_container').remove();
                    }
                    //END Jobs     

                    //Setores
                    if ( conf_CADASTRO['RH_ID_SETORES']["access"] ) {
                        var optionRH_ID_SETORES = {
                            "tableId": "RH_ID_SETORES",
                            "table": "RH_ID_SETORES",
                            "workFlow": conf_CADASTRO['RH_ID_SETORES']["workflow"],
                            "pk": {
                                "primary": {
                                    "EMPRESA": {"type": "varchar"},
                                    "RHID": {"type": "number"},
                                    "DT_ADMISSAO": {"type": "date"},
                                    "CD_ESTAB": {"type": "varchar"},
                                    "ID_SETOR": {"type": "varchar"},
                                    "DT_INI_SETOR": {"type": "date"},
                                    "DT_INI": {"type": "date"}
                                }
                            },
                            "dependsOn": {
                                "RH_ID_EMPRESAS": {
                                    "EMPRESA": "EMPRESA",
                                    "RHID": "RHID",
                                    "DT_ADMISSAO": "DT_ADMISSAO"
                                }
                            },
                            "on_pre_submit": "RH_ID_SETORES",
                            //"initialWhereClause": "",
                            "order_by": "DT_INI DESC",
                            "recordBundle": 4,
                            "pageLenght": 4,
                            "scrollY": "117",
                            "responsive": true,
                            "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
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
                                    "data": 'RHID',
                                    "name": 'RHID',
                                    "exclude": !conf_CADASTRO['RH_ID_SETORES']["rgpd"]["RHID"],
                                    "type": "hidden",
                                    "visible": false,
                                }, {
                                    "title": "", //Datatables
                                    "label": "", //Editor
                                    "data": 'EMPRESA',
                                    "name": 'EMPRESA',
                                    "exclude": !conf_CADASTRO['RH_ID_SETORES']["rgpd"]["EMPRESA"],
                                    "type": "hidden",
                                    "visible": false,
                                    "className": "",
                                }, {
                                    "title": "", //Datatables
                                    "label": "", //Editor
                                    "data": 'DT_ADMISSAO',
                                    "name": 'DT_ADMISSAO',
                                    "exclude": !conf_CADASTRO['RH_ID_SETORES']["rgpd"]["DT_ADMISSAO"],
                                    "type": "hidden",
                                    "visible": false,
                                    "className": "",
                                    "datatype": "date"
                                }, {
                                    "title": "", //Datatables
                                    "label": "", //Editor
                                    "data": 'CD_ESTAB',
                                    "name": 'CD_ESTAB',
                                    "exclude": !conf_CADASTRO['RH_ID_SETORES']["rgpd"]["CD_ESTAB"],
                                    "type": "hidden",
                                    "visible": false,
                                    "className": "",
                                }, {
                                    "responsivePriority": 2,
                                    "complexList": true,
                                    "title": "<?php echo mb_strtoupper($ui_establishment,'UTF-8'); ?>",
                                    "label": "<?php echo $ui_establishment; ?>",
                                    "data": "DSP_ESTAB",
                                    "name": "DSP_ESTAB",
                                    "exclude": !conf_CADASTRO['RH_ID_SETORES']["rgpd"]["EMPRESA"] && !conf_CADASTRO['RH_ID_SETORES']["rgpd"]["CD_ESTAB"],
                                    "className": "visibleColumn",
                                    "type": "select",
                                    "attr": {
                                        "deferred": true,
                                        //"disabled": true, //Permite inibir o campo no Editor
                                        "dependent-group": "SETORES",
                                        "dependent-level": 1,
                                        "data-db-name": 'A.EMPRESA@A.CD_ESTAB',
                                        "distribute-value": 'EMPRESA@CD_ESTAB',
                                        "decodeFromTable": 'DG_ESTABELECIMENTOS A',
                                        "desigColumn": "NVL(A.DSR_ESTAB,A.DSP_ESTAB)",
                                        'orderBy': 'A.CD_ESTAB',
                                        "class": "form-control complexList chosen",
                                        "filter": {
                                            "create": " AND A.ACTIVO = 'S' AND A.EMPRESA = ':EMPRESA'",
                                            "edit": " AND A.ACTIVO = 'S' AND A.EMPRESA = ':EMPRESA' ",
                                        }
                                    }
                                }, {
                                    "title": "", //Datatables
                                    "label": "", //Editor
                                    "data": 'ID_SETOR',
                                    "name": 'ID_SETOR',
                                    "exclude": !conf_CADASTRO['RH_ID_SETORES']["rgpd"]["ID_SETOR"],
                                    "type": "hidden", //Editor
                                    "visible": false, //DataTables   
                                }, {
                                    "title": "", //Datatables
                                    "label": "", //Editor
                                    "data": 'DT_INI_SETOR',
                                    "name": 'DT_INI_SETOR',
                                    "exclude": !conf_CADASTRO['RH_ID_SETORES']["rgpd"]["DT_INI_SETOR"],
                                    "datatype": "date",
                                    "type": "hidden", //Editor
                                    "visible": false, //DataTables                        
                                }, {
                                    "responsivePriority": 3,
                                    "complexList": true,
                                    "title": "<?php echo mb_strtoupper($ui_sector,'UTF-8'); ?>",
                                    "label": "<?php echo $ui_sector; ?>",
                                    "data": "DSP_SETOR",
                                    "name": "DSP_SETOR",
                                    "exclude": !conf_CADASTRO['RH_ID_SETORES']["rgpd"]["EMPRESA"] && !conf_CADASTRO['RH_ID_SETORES']["rgpd"]["CD_ESTAB"] && !conf_CADASTRO['RH_ID_SETORES']["rgpd"]["ID_SETOR"] && !conf_CADASTRO['RH_ID_SETORES']["rgpd"]["DT_INI_SETOR"],
                                    "className": "visibleColumn",
                                    "type": "select",
                                    "attr": {
                                        "dependent-group": "SETORES",
                                        "dependent-level": 2,
                                        "data-db-name": 'A.EMPRESA@A.CD_ESTAB@A.ID_SETOR@A.DT_INI',
                                        "distribute-value": 'EMPRESA@CD_ESTAB@ID_SETOR@DT_INI_SETOR',
                                        "decodeFromTable": 'DG_SETORES A',
                                        "desigColumn": "CONCAT(CONCAT(A.ID_SETOR,'-'),A.DSP_SETOR)",
                                        'orderBy': 'A.ID_SETOR',
                                        "class": "form-control complexList chosen",
                                        "filter": {
                                            "create": " AND A.DT_FIM IS NULL ",
                                            "edit": " AND A.DT_FIM IS NULL ",
                                        }
                                    },
            //                        "render": function (val, type, row) {
            //                            return "SELECT * FROM DG_SETORES WHERE EMPRESA = '" + row['EMPRESA'] 
            //                                    + "' AND CD_ESTAB = '" 
            //                                    + row['CD_ESTAB'] + "' AND ID_SETOR = '" + row['ID_SETOR'] 
            //                                    + "' AND DT_INI = TO_DATE('" + row['DT_INI_SETOR'] + "', 'YYYY-MM-DD') ";
            //                        }                         
                                }, {
                                    "responsivePriority": 4,
                                    "title": "<?php echo mb_strtoupper($ui_begin_date,'UTF-8'); ?>", //Datatables
                                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                                    "data": 'DT_INI',
                                    "name": 'DT_INI',
                                    "exclude": !conf_CADASTRO['RH_ID_SETORES']["rgpd"]["DT_INI"],
                                    "datatype": 'date',
                                    "className": "visibleColumn",
                                    "attr": {
                                        "class": "datepicker"
                                    }
                                }, {
                                    "responsivePriority": 5,
                                    "title": "<?php echo mb_strtoupper($ui_end_date,'UTF-8'); ?>", //Datatables
                                    "label": "<?php echo $ui_end_date; ?>", //Editor
                                    "data": 'DT_FIM',
                                    "name": 'DT_FIM',
                                    "exclude": !conf_CADASTRO['RH_ID_SETORES']["rgpd"]["DT_FIM"],
                                    "datatype": 'date',
                                    "className": "visibleColumn",
                                    "attr": {
                                        "class": "datepicker"
                                    }
                                }, {
                                    "title": "<?php echo mb_strtoupper($ui_obs_short,'UTF-8'); ?>", //Datatables
                                    "label": "<?php echo $ui_obs_short; ?>", //Editor
                                    "data": 'OBS',
                                    "name": 'OBS',
                                    "exclude": !conf_CADASTRO['RH_ID_SETORES']["rgpd"]["OBS"],
                                    "type": 'textarea', //Editor
                                    "className": "none visibleColumn",
                                    "attr": {
                                        "style": "max-width: 355px",
                                        "class": "form-control len-355"
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
                                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions,'UTF-8'); ?>" + '</span>',
                                    "label": '',
                                    "data": null,
                                    "name": 'RECORD_HISTORY',
                                    "type": "hidden",
                                    "className": "none visibleColumn",
                                    "render": function (val, type, row) {
                                        return tablesRecordHistory(val, type, row);
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
                                        return RH_ID_SETORES.crudButtons(conf_CADASTRO['RH_ID_SETORES']["crud"][0], conf_CADASTRO['RH_ID_SETORES']["crud"][1], conf_CADASTRO['RH_ID_SETORES']["crud"][2]);
                                    }
                                }
                            ],
                            "validations": {
                                "rules": {
                                    "DSP_SETOR": {
                                        required: true,
                                    },
                                    "DT_INI": {
                                        required: true,
                                        dateISO: true
                                    },
                                    "OBS": {
                                        maxlength: 1000
                                    },
                                    "DT_FIM": {
                                        dateISO: true,
                                        dateEqOrNextThan: 'DT_INI',
                                    }
                                },
                                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                                "messages": {
                                    "DT_FIM": {
                                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                                    }
                                }
                            }
                        };
                        RH_ID_SETORES = new QuadTable();
                        RH_ID_SETORES.initTable($.extend({}, datatable_instance_defaults, optionRH_ID_SETORES));
                    } else {
                        $('article.RH_ID_SETORES_container').remove();
                    }
                    //END Setores         

                    //Destacamentos
                    if ( conf_CADASTRO['RH_ID_DESTACAMENTOS']["access"] ) {
                        var optionRH_ID_DESTACAMENTOS = {
                            "tableId": "RH_ID_DESTACAMENTOS",
                            "table": "RH_ID_DESTACAMENTOS",
                            "workFlow": conf_CADASTRO['RH_ID_DESTACAMENTOS']["workflow"],
                            "pk": {
                                "primary": {
                                    "EMPRESA": {"type": "varchar"},
                                    "RHID": {"type": "number"},
                                    "DT_ADMISSAO": {"type": "date"},
                                    "DT_INI": {"type": "date"}
                                }
                            },
                            "dependsOn": {
                                "RH_ID_EMPRESAS": {
                                    "EMPRESA": "EMPRESA",
                                    "RHID": "RHID",
                                    "DT_ADMISSAO": "DT_ADMISSAO"
                                }
                            },
                            "on_pre_submit": "RH_ID_DESTACAMENTOS",
                            //"initialWhereClause": "",
                            "order_by": "DT_INI DESC",
                            "recordBundle": 4,
                            "pageLenght": 4,
                            "scrollY": "117",
                            "responsive": true,
                            "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
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
                                    "data": 'RHID',
                                    "name": 'RHID',
                                    "exclude": !conf_CADASTRO['RH_ID_DESTACAMENTOS']["rgpd"]["RHID"],
                                    "type": "hidden",
                                    "visible": false,
                                }, {
                                    "title": "", //Datatables
                                    "label": "", //Editor
                                    "data": 'EMPRESA',
                                    "name": 'EMPRESA',
                                    "exclude": !conf_CADASTRO['RH_ID_DESTACAMENTOS']["rgpd"]["EMPRESA"],
                                    "type": "hidden",
                                    "visible": false,
                                    "className": "",
                                }, {
                                    "title": "", //Datatables
                                    "label": "", //Editor
                                    "data": 'DT_ADMISSAO',
                                    "name": 'DT_ADMISSAO',
                                    "exclude": !conf_CADASTRO['RH_ID_DESTACAMENTOS']["rgpd"]["DT_ADMISSAO"],
                                    "type": "hidden",
                                    "visible": false,
                                    "className": "",
                                    "datatype": "date"
                                }, {
                                    "responsivePriority": 2,
                                    "title": "<?php echo mb_strtoupper($ui_begin_date,'UTF-8'); ?>", //Datatables
                                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                                    "data": 'DT_INI',
                                    "name": 'DT_INI',
                                    "exclude": !conf_CADASTRO['RH_ID_DESTACAMENTOS']["rgpd"]["DT_INI"],
                                    "datatype": 'date',
                                    "className": "visibleColumn",
                                    "attr": {
                                        "class": "datepicker"
                                    }
                                }, {
                                    "responsivePriority": 3,
                                    "title": "<?php echo mb_strtoupper($ui_planned_end_date,'UTF-8'); ?>", //Datatables
                                    "label": "<?php echo $ui_planned_end_date; ?>", //Editor
                                    "data": 'DT_FIM_PRV',
                                    "name": 'DT_FIM_PRV',
                                    "exclude": !conf_CADASTRO['RH_ID_DESTACAMENTOS']["rgpd"]["DT_FIM_PRV"],
                                    "datatype": 'date',
                                    "className": "visibleColumn",
                                    "attr": {
                                        "class": "datepicker"
                                    }
                                }, {
                                    "responsivePriority": 4,
                                    "title": "<?php echo mb_strtoupper($ui_end_date,'UTF-8'); ?>", //Datatables
                                    "label": "<?php echo $ui_end_date; ?>", //Editor
                                    "data": 'DT_FIM',
                                    "name": 'DT_FIM',
                                    "exclude": !conf_CADASTRO['RH_ID_DESTACAMENTOS']["rgpd"]["DT_FIM"],
                                    "datatype": 'date',
                                    "className": "visibleColumn",
                                    "attr": {
                                        "class": "datepicker"
                                    }
                                }, {
                                    "title": "", //Datatables
                                    "label": "", //Editor
                                    "data": 'CD_PAIS',
                                    "name": 'CD_PAIS',
                                    "exclude": !conf_CADASTRO['RH_ID_DESTACAMENTOS']["rgpd"]["CD_PAIS"],
                                    "type": "hidden", //Editor
                                    "visible": false, //DataTables   
                                }, {
                                    "responsivePriority": 4,
                                    "complexList": true,
                                    "title": "<?php echo mb_strtoupper($ui_country,'UTF-8'); ?>",
                                    "label": "<?php echo $ui_country; ?>",
                                    "data": 'DSP_PAIS',
                                    "name": 'DSP_PAIS',
                                    "exclude": !conf_CADASTRO['RH_ID_DESTACAMENTOS']["rgpd"]["CD_PAIS"],
                                    "type": "select",
                                    "className": "visibleColumn",
                                    //"renew": true,
                                    "attr": {
                                        "dependent-group": "PAISES",
                                        "dependent-level": 1,
                                        "data-db-name": "A.CD_PAIS",
                                        "decodeFromTable": "DG_PAISES A",
                                        "desigColumn": "A.DSP_PAIS",
                                        "orderBy": "A.CD_PAIS",
                                        "class": "form-control complexList chosen"
                                    }
                                }, {
                                    "title": "<?php echo mb_strtoupper($ui_contact,'UTF-8'); ?>", //Datatables
                                    "label": "<?php echo $ui_contact; ?>", //Editor
                                    "data": 'CONTACTO',
                                    "name": 'CONTACTO',
                                    "exclude": !conf_CADASTRO['RH_ID_DESTACAMENTOS']["rgpd"]["CONTACTO"],
                                    "type": 'textarea', //Editor
                                    "className": "none visibleColumn",
                                    "attr": {
                                        "style": "max-width: 355px",
                                        "class": "form-control len-355"
                                    }
                                }, {
                                    "title": "<?php echo mb_strtoupper($ui_obs_short,'UTF-8'); ?>", //Datatables
                                    "label": "<?php echo $ui_obs_short; ?>", //Editor
                                    "data": 'OBS',
                                    "name": 'OBS',
                                    "exclude": !conf_CADASTRO['RH_ID_DESTACAMENTOS']["rgpd"]["OBS"],
                                    "type": 'textarea', //Editor
                                    "className": "none visibleColumn",
                                    "attr": {
                                        "style": "max-width: 355px",
                                        "class": "form-control len-355"
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
                                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions,'UTF-8'); ?>" + '</span>',
                                    "label": '',
                                    "data": null,
                                    "name": 'RECORD_HISTORY',
                                    "type": "hidden",
                                    "className": "none visibleColumn",
                                    "render": function (val, type, row) {
                                        return tablesRecordHistory(val, type, row);
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
                                        //
                                        return RH_ID_DESTACAMENTOS.crudButtons(conf_CADASTRO['RH_ID_DESTACAMENTOS']["crud"][0], conf_CADASTRO['RH_ID_DESTACAMENTOS']["crud"][1], conf_CADASTRO['RH_ID_DESTACAMENTOS']["crud"][2]);
                                    }
                                }
                            ],
                            "validations": {
                                "rules": {
                                    "CONTACTO": {
                                        maxlength: 2000,
                                    },
                                    "OBS": {
                                        maxlength: 4000,
                                    },
                                    "TIPO": {
                                        required: true,
                                    },
                                    "ACTIVO": {
                                        required: true,
                                    },
                                    "DT_INI": {
                                        required: true,
                                        dateISO: true,
                                    },
                                    "DT_FIM_PRV": {
                                        dateISO: true,
                                        dateEqOrNextThan: 'DT_INI',
                                    },
                                    "DT_FIM": {
                                        dateISO: true,
                                        dateEqOrNextThan: 'DT_INI',
                                    }
                                },
                                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                                "messages": {
                                    "DT_FIM_PRV": {
                                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                                    },
                                    "DT_FIM": {
                                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                                    }
                                }
                            }
                        };
                        RH_ID_DESTACAMENTOS = new QuadTable();
                        RH_ID_DESTACAMENTOS.initTable($.extend({}, datatable_instance_defaults, optionRH_ID_DESTACAMENTOS));
                    } else {
                        $('article.RH_ID_DESTACAMENTOS_container').remove();
                    }
                    //END Destacamentos RH_ID_ADAPTABILIDADES
                }
                //END Estruturas TAB

                //Remunerações TAB
                if  ( !conf_CADASTRO['RH_ID_ENTS_DESCONTO']["access"] && !conf_CADASTRO['RH_ID_REMUNERACOES']["access"] &&
                      !conf_CADASTRO['RH_ID_ENT_INTERNAS']["access"] && !conf_CADASTRO['RH_ID_ADAPTABILIDADES']["access"]
                    ) {
                    $('a[href="#Tab24"]').closest('li').remove(); //Estrutura TAB.LINK
                    $('#Tab24').remove(); //Estrutura DIV.PANEL
                } else {
                    
                    //Grelhas
                    if ( conf_CADASTRO['RH_ID_REMUNERACOES']["access"] ) {
                        var optionRH_ID_REMUNERACOES = {
                            "tableId": "RH_ID_REMUNERACOES",
                            "table": "RH_ID_REMUNERACOES",
                            "workFlow": conf_CADASTRO['RH_ID_REMUNERACOES']["workflow"],
                            "pk": {
                                "primary": {
                                    "EMPRESA": {"type": "varchar"},
                                    "RHID": {"type": "number"},
                                    "DT_ADMISSAO": {"type": "date"},
                                    "CD_GRELHA_SALARIAL": {"type": "number"},
                                    "CD_LINHA_SALARIAL": {"type": "number"},
                                    "DT_INICIO": {"type": "date"}
                                }
                            },
                            "dependsOn": {
                                "RH_ID_EMPRESAS": {
                                    "EMPRESA": "EMPRESA",
                                    "RHID": "RHID",
                                    "DT_ADMISSAO": "DT_ADMISSAO"
                                }
                            },
                            "on_pre_submit": "RH_ID_REMUNERACOES",
                            //"initialWhereClause": "",
                            "order_by": "CD_GRELHA_SALARIAL ASC, NVL(DT_FIM, TO_DATE('1900-01-01','YYYY-MM-DD')) ASC",
                            "recordBundle": 7,
                            "pageLenght": 7,
                            "scrollY": "234",
                            "responsive": true,
                            "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
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
                                    "data": 'RHID',
                                    "name": 'RHID',
                                    "exclude": !conf_CADASTRO['RH_ID_REMUNERACOES']["rgpd"]["RHID"],
                                    "type": "hidden",
                                    "visible": false,
                                }, {
                                    "title": "", //Datatables
                                    "label": "", //Editor
                                    "data": 'EMPRESA',
                                    "name": 'EMPRESA',
                                    "exclude": !conf_CADASTRO['RH_ID_REMUNERACOES']["rgpd"]["EMPRESA"],
                                    "type": "hidden",
                                    "visible": false,
                                    "className": "",
                                }, {
                                    "title": "", //Datatables
                                    "label": "", //Editor
                                    "data": 'DT_ADMISSAO',
                                    "name": 'DT_ADMISSAO',
                                    "exclude": !conf_CADASTRO['RH_ID_REMUNERACOES']["rgpd"]["DT_ADMISSAO"],
                                    "type": "hidden",
                                    "visible": false,
                                    "className": "",
                                    "datatype": "date"
                                }, {
                                    "title": "", //Datatables
                                    "label": "", //Editor
                                    "data": 'CD_GRELHA_SALARIAL',
                                    "name": 'CD_GRELHA_SALARIAL',
                                    "exclude": !conf_CADASTRO['RH_ID_REMUNERACOES']["rgpd"]["CD_GRELHA_SALARIAL"],
                                    "type": "hidden", //Editor
                                    "visible": false, //DataTables
                                }, {
                                    "responsivePriority": 2,
                                    "complexList": true,
                                    "title": "<?php echo mb_strtoupper($ui_payroll_grid,'UTF-8'); ?>",
                                    "label": "<?php echo $ui_payroll_grid; ?>",
                                    "data": 'DSP_GS',
                                    "name": 'DSP_GS',
                                    "exclude": !conf_CADASTRO['RH_ID_REMUNERACOES']["rgpd"]["CD_GRELHA_SALARIAL"],
                                    "type": "select",
                                    "className": "visibleColumn",
                                    "renew": true,
                                    "attr": {
                                        "dependent-group": "GRELHAS",
                                        "dependent-level": 1,
                                        "data-db-name": "A.CD_GRELHA_SALARIAL",
                                        "decodeFromTable": "RH_DEF_GRELHAS_SALARIAIS A",
                                        "desigColumn": "CONCAT(CONCAT(A.CD_GRELHA_SALARIAL,'-'),A.DSP_GRELHA_SALARIAL)",
                                        "otherValues": "A.TP_GRELHA_SALARIAL",
                                        "orderBy": "A.CD_GRELHA_SALARIAL",
                                        "class": "form-control complexList chosen",
                                        "filter": {
                                            "create": " AND A.ACTIVO = 'S'",
                                            "edit": " AND A.ACTIVO = 'S'",
                                        }
                                    }
                                }, {
                                    "title": "", //Datatables
                                    "label": "", //Editor
                                    "data": 'CD_LINHA_SALARIAL',
                                    "name": 'CD_LINHA_SALARIAL',
                                    "exclude": !conf_CADASTRO['RH_ID_REMUNERACOES']["rgpd"]["CD_LINHA_SALARIAL"],
                                    "type": "hidden", //Editor
                                    "visible": false, //DataTables
                                }, {
                                    "responsivePriority": 3,
                                    "complexList": true,
                                    "title": "<?php echo mb_strtoupper($ui_line, 'UTF-8'); ?>",
                                    "label": "<?php echo $ui_line; ?>",
                                    "data": 'DSP_LS',
                                    "name": 'DSP_LS',
                                    "exclude": !conf_CADASTRO['RH_ID_REMUNERACOES']["rgpd"]["CD_GRELHA_SALARIAL"] && !conf_CADASTRO['RH_ID_REMUNERACOES']["rgpd"]["CD_LINHA_SALARIAL"],
                                    "type": "select",
                                    "className": "visibleColumn",
                                    "renew": true,
                                    "attr": {
                                        "dependent-group": "GRELHAS",
                                        "dependent-level": 2,
                                        "data-db-name": "A.CD_GRELHA_SALARIAL@A.CD_LINHA_SALARIAL",
                                        "decodeFromTable": "RH_DEF_LINHAS_SALARIAIS A",
                                        "desigColumn": "CONCAT(CONCAT(A.CD_LINHA_SALARIAL,'-'),A.DSP_LINHA_SALARIAL)",
                                        "orderBy": "A.CD_LINHA_SALARIAL",
                                        "class": "form-control complexList chosen",
                                        "filter": {
                                            "create": " AND A.ACTIVO = 'S'",
                                            "edit": " AND A.ACTIVO = 'S'",
                                        }
                                    },
                                }, {
                                    /* DUMMY LOV :: Show Value */
                                    "responsivePriority": 4,
                                    "complexList": true,
                                    "title": "<?php echo mb_strtoupper($ui_value,'UTF-8'); ?>",
                                    "label": "<?php echo $ui_value; ?>",
                                    "name": 'DSP_VALOR',
                                    "data": 'DSP_VALOR',
                                    "exclude": !conf_CADASTRO['RH_ID_REMUNERACOES']["rgpd"]["CD_GRELHA_SALARIAL"] && !conf_CADASTRO['RH_ID_REMUNERACOES']["rgpd"]["CD_LINHA_SALARIAL"],
                                    "type": "hidden", //Editor
                                    "className": "visibleColumn right",
                                    "visible": true, //DataTables
                                    "attr": {
                                        "dependent-group": "GRELHAS",
                                        "dependent-level": 3,
                                        "data-db-name": "A.CD_GRELHA_SALARIAL@A.CD_LINHA_SALARIAL",
                                        "decodeFromTable": "RH_GRELHA_VALORES A",
                                        "desigColumn": "A.VALOR",
                                        "class": "form-control",
                                        "orderBy": "A.CD_GRELHA_SALARIAL,A.CD_LINHA_SALARIAL"
                                    }
                                }, {
                                    "responsivePriority": 5,
                                    "title": "<?php echo mb_strtoupper($ui_value,'UTF-8'); ?>", //Datatables
                                    "label": "<?php echo $ui_value; ?>", //Editor
                                    "data": 'INPUT_VALOR',
                                    "name": 'INPUT_VALOR',
                                    "exclude": !conf_CADASTRO['RH_ID_REMUNERACOES']["rgpd"]["CD_GRELHA_SALARIAL"] && !conf_CADASTRO['RH_ID_REMUNERACOES']["rgpd"]["CD_LINHA_SALARIAL"],
                                    "className": "visibleColumn",
                                    //se datatype = 'just_editor', não é incluído no SELECT só no editor. -- tratado no QuadCore_Extended
                                    //esta coluna é usada para reter no editor o valor da grelha em algumas situações, e apenas visualizar o valor atribuido noutras
                                    //na tabela é na coluna DSP_VALOR que é visualizado o valor a considerar
                                    "datatype": 'just_editor', 
                                    //"type": "hidden", //Editor
                                    "visible": false, //DataTables
                                    "attr": {
                                        "class": "form-control",
                                        "autocomplete": "nope"
                                    }
                                }, {
                                    "responsivePriority": 5,
                                    "title": "<?php echo mb_strtoupper($ui_begin_date,'UTF-8'); ?>", //Datatables
                                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                                    "data": 'DT_INICIO',
                                    "name": 'DT_INICIO',
                                    "exclude": !conf_CADASTRO['RH_ID_REMUNERACOES']["rgpd"]["DT_INICIO"],
                                    "datatype": 'dateYearMonth',
                                    "className": "visibleColumn",
                                    "attr": {
                                        "class": "form-control dateYearMonth",
                                        "autocomplete": "nope"
                                    }
                                }, {
                                    "responsivePriority": 6,
                                    "title": "<?php echo mb_strtoupper($ui_end_date,'UTF-8'); ?>", //Datatables
                                    "label": "<?php echo $ui_end_date; ?>", //Editor
                                    "data": 'DT_FIM',
                                    "name": 'DT_FIM',
                                    "exclude": !conf_CADASTRO['RH_ID_REMUNERACOES']["rgpd"]["DT_FIM"],
                                    "datatype": 'dateYearMonth',
                                    "className": "visibleColumn",
                                    "attr": {
                                        "class": "form-control dateYearMonth",
                                        "autocomplete": "nope"
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
                                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions,'UTF-8'); ?>" + '</span>',
                                    "label": '',
                                    "data": null,
                                    "name": 'RECORD_HISTORY',
                                    "type": "hidden",
                                    "className": "none visibleColumn",
                                    "render": function (val, type, row) {
                                        return tablesRecordHistory(val, type, row);
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
                                        return RH_ID_REMUNERACOES.crudButtons(conf_CADASTRO['RH_ID_REMUNERACOES']["crud"][0], conf_CADASTRO['RH_ID_REMUNERACOES']["crud"][1], conf_CADASTRO['RH_ID_REMUNERACOES']["crud"][2]);
                                    }
                                }
                            ],
                            "validations": {
                                "rules": {
                                    "DSP_GS": {
                                        required: true
                                    },
                                    "DSP_LS": {
                                        required: true
                                    },
                                    "DT_INICIO": {
                                        required: true,
                                        dateYearMonth: true,
                                    },
                                    "DT_FIM": {
                                        meio: true
                                    }
                                },
                                "messages": {
                                    "DT_INICIO": {
                                        dateYearMonth: "<?php echo $msg_invalid_year_month; ?>"
                                    },
                                    "DT_FIM": {
                                        meio: "<?php echo $error_dt_eq_greather_than_begin_dt; ?>",
                                        dateYearMonth: "<?php echo $msg_invalid_year_month; ?>"
                                    }
                                }
                            },
                            //postSubmit
                            "rowCallback": function (row, data, dataIndex) {
                                console.log('rowcallback',data, row);
                            }
                        };
                        RH_ID_REMUNERACOES = new QuadTable();
                        RH_ID_REMUNERACOES.initTable($.extend({}, datatable_instance_defaults, optionRH_ID_REMUNERACOES));

                        /* ADD CUSTOM METHOD :: ON INSTANCE ** COLUMN VALIDATION */
                        $.validator.addMethod("meio", function (value, element, param) {
                            var dt_ini = $('#DTE_Field_DT_INICIO').val();
                            if (value.length === 7) {
                                if (Date.parse(value) < Date.parse(dt_ini)) {
                                    return false;
                                } else {
                                    return true;
                                }
                            }
                            return true;
                        });

                        // Condicionamento da interção com as grelhas salariais dos colaboradores de acordo com o tipo de grelha
                        // TP_GRELHA:
                        //      A - Automática
                        //      B - Individual
                        //      C - Global (não disponível neste âmbito)
                        //      Z - Discricionária
                        
                        
                        $(document).on('RH_ID_REMUNERACOESAttachEvt', function (e) {

                            // condicionamento na abertura do editor    
                            setTimeout(function(){
                                var operacao_ = RH_ID_REMUNERACOES.editor.s["action"], 
                                    frm_context = "#RH_ID_REMUNERACOES_editorForm",
                                    tp_grelha_ = $("#DTE_Field_DSP_GS", frm_context).children("option:selected")[0]['dataset']['othervalues'],
                                    linha_itm = $("#DTE_Field_DSP_LS",frm_context),
                                    input_val_label = $("[for=DTE_Field_INPUT_VALOR]",frm_context),                                
                                    input_val = $("#DTE_Field_INPUT_VALOR", frm_context),
                                    input_val_field = $(".DTE_Field_Name_INPUT_VALOR", frm_context),
                                    valor =  $("#DTE_Field_DSP_VALOR", frm_context).text();

                                    input_val.prop('disabled',false);
                                    input_val_field.show();
                                    input_val_label.removeClass("required");

                                    if (operacao_ !== 'query') {

                                        input_val.rules('add', {
                                            required: true
                                        });		
                                        input_val_label.addClass("required");

                                        if (tp_grelha_ === 'B') { // individual
                                            if (operacao_ === 'edit') {
                                                input_val.val(valor);
                                            }
                                        }
                                        else if (tp_grelha_ === 'Z') { // individual
                                            if (operacao_ === 'edit') {
                                                input_val.val(valor);
                                            }
                                            input_val.prop('disabled',true);
                                        }
                                        else {
                                            input_val_field.hide();
                                        }
                                        linha_itm.prop('disabled',true)
                                                 .trigger("chosen:updated");
                                    } 
                                    else {
                                        input_val_field.hide();
                                    }
                            },100)

                            // Condicionamento do editor na mudança da grelha
                            $("#DTE_Field_DSP_GS","#RH_ID_REMUNERACOES_editorForm").on('change', function (e) {
                                var operacao_ = RH_ID_REMUNERACOES.editor.s["action"], frm_context = "#RH_ID_REMUNERACOES_editorForm",
                                    cd_grelha_ = $("#DTE_Field_DSP_GS", frm_context).val(),
                                    tp_grelha_ = $("#DTE_Field_DSP_GS", frm_context).children("option:selected")[0]['dataset']['othervalues'],
                                    linha_itm = $("#DTE_Field_DSP_LS",frm_context),
                                    input_val = $("#DTE_Field_INPUT_VALOR", frm_context),
                                    input_val_label = $("[for=DTE_Field_INPUT_VALOR]", frm_context),
                                    input_val_field = $(".DTE_Field_Name_INPUT_VALOR", frm_context),
                                    rhid_itm = $("#xt_RHID","#employeeFilter");

                                    linha_itm.prop('disabled',false);
                                    input_val.prop('disabled',false);
                                    input_val.val("");
                                    input_val_field.show();
                                    input_val.rules('remove','required');		
                                    input_val_label.removeClass('required');
                                    
                                    // reset dos erros
                                    input_val.removeClass('error');
                                    $("#DTE_Field_INPUT_VALOR-error",frm_context).hide();
                                    
                                    if (operacao_ === 'create') {
                                        // Grelha B - Individual
                                        if (tp_grelha_ === 'B') {
                                            
                                            input_val.rules('add', {
                                                required: true
                                            });		
                                            input_val_label.addClass('required');
                                            
                                            // deverá limitar a grelha apenas à linha correspondente ao RHID
                                            // criar a linha caso não exista

                                            // identificar o colaborador
                                            var rhid_ = rhid_itm.val(),
                                                dsp_linha_ = rhid_itm.find("option:selected").text(),
                                                cd_linha_ = cd_grelha_+"@"+rhid_;

                                            setTimeout(function(){
                                                // se a linha já existe, apenas seleciona
                                                if (linha_itm.find('option[value="'+cd_linha_+'"]').length > 0) {
                                                    linha_itm.val(cd_linha_)
                                                             .trigger('change')
                                                             .prop('disabled',true)
                                                             .trigger("chosen:updated");
                                                } 
                                                // terá que adicionar a linha e seleciona-la
                                                else {
                                                    $('<option></option>').val(cd_linha_)
                                                                          .html(dsp_linha_)
                                                                          .prependTo(linha_itm);
                                                    linha_itm.val(cd_linha_)
                                                             .trigger('change')
                                                             .prop('disabled',true)
                                                             .trigger("chosen:updated");
                                                } 
                                            },100)
                                        }
                                        else if (tp_grelha_ === 'Z') {
                                            input_val.prop('disabled',true);
                                        }
                                    }
                            });

                            // Condicionamento do editor na mudança da linha grelha
                            $("#DTE_Field_DSP_LS","#RH_ID_REMUNERACOES_editorForm").on('change', function (e) {
                                
                                var operacao_ = RH_ID_REMUNERACOES.editor.s["action"], frm_context = "#RH_ID_REMUNERACOES_editorForm",
                                    tp_grelha_ = $("#DTE_Field_DSP_GS", frm_context).children("option:selected")[0]['dataset']['othervalues'],
                                    input_val = $("#DTE_Field_INPUT_VALOR", frm_context),
                                    input_val_field = $(".DTE_Field_Name_INPUT_VALOR", frm_context),
                                    valor;
                                    
                                    if (operacao_ === 'create') {
                                        if (tp_grelha_ === 'B') {
                                            // recolhe valor
                                            //input_val.val(valor);
                                            null;
                                        }
                                        else if (tp_grelha_ === 'Z') {
                                            setTimeout(function(){
                                                //caso exista uma única linha, a linha e o valor são carregados automáticamente
                                                //pelo que existe necessidade de atualizar a lista chosen
                                                $("#DTE_Field_DSP_LS","#RH_ID_REMUNERACOES_editorForm").trigger("chosen:updated");
                                                valor =  $("#DTE_Field_DSP_VALOR", frm_context).text();
                                                input_val.val(valor);
                                            },100)
                                        }
                                        else {
                                            null;
                                        }
                                    }
                            });

                            // Condicionamento do editor na mudança do valor grelha
                            $("#DTE_Field_INPUT_VALOR","#RH_ID_REMUNERACOES_editorForm").on('change', function (e) {
                                
                                var operacao_ = RH_ID_REMUNERACOES.editor.s["action"], frm_context = "#RH_ID_REMUNERACOES_editorForm",
                                    tp_grelha_ = $("#DTE_Field_DSP_GS", frm_context).children("option:selected")[0]['dataset']['othervalues'],
                                    input_val = $("#DTE_Field_INPUT_VALOR", frm_context),
                                    input_val_field = $(".DTE_Field_Name_INPUT_VALOR", frm_context),
                                    dsp_valor, valor;
                                    
                                    if (operacao_ !== 'query') {
                                        if (tp_grelha_ === 'B') {
                                            dsp_valor = $("#DTE_Field_DSP_VALOR", frm_context).text();
                                            valor = input_val.val();
                                            if (dsp_valor != '' && valor != '' && dsp_valor != valor) {
                                                $("#DTE_Field_DSP_VALOR", frm_context).text(valor);
                                                $("#DTE_Field_DSP_VALOR", frm_context).val(valor);
                                                dsp_valor = $("#DTE_Field_DSP_VALOR", frm_context).text();
                                            }
                                            //console.log("INPUT_VALOR:",valor, " DSP_VALOR:",dsp_valor);
                                        }
                                    }
                            });

                            // ação de gravação do registo de RH_ID_REMUNERACOES
                            $("#RH_ID_REMUNERACOES_editorForm").parent("div").parent("div").parent("div").find("div.DTE_Footer.modal-footer > div.DTE_Form_Buttons > button:nth-child(2)").on('click',function(e) {
//                                // esta ação força o refrescamento da lista RH_ID_REMUNERACOES.DSP_VALOR para atualizar com os valores
//                                // das grelhas agora criadas no caso de grelhas individuais
                                var operacao_ = RH_ID_REMUNERACOES.editor.s["action"], frm_context = "#RH_ID_REMUNERACOES_editorForm",
                                    tp_grelha_ = $("#DTE_Field_DSP_GS", frm_context).children("option:selected")[0]['dataset']['othervalues'];
                                    
                                setTimeout(function() {
                                    if (operacao_ != 'query' && tp_grelha_ === 'B') {
                                        var valor =  $("#DTE_Field_INPUT_VALOR", frm_context).val(),
                                            masterKey;
                                        
                                        try {
                                            masterKey = $('#RH_ID_REMUNERACOES_info > span.select-info > span.goEye > i').attr('data-rowid').replace("row_", "");
                                        } catch(e) {
                                            masterKey = null;
                                        }

                                        if (masterKey) {
                                            // atualização do valor na linha da tabela
                                            $('table#RH_ID_REMUNERACOES > tbody > tr#row_' + masterKey + ' > td:nth-child(4)').html(valor);

                                            // atualização da lista associada ao valor
                                            var params = {
                                                idx: "A.CD_GRELHA_SALARIAL@A.CD_LINHA_SALARIAL__RH_GRELHA_VALORES A__A.VALOR__A.CD_GRELHA_SALARIAL,A.CD_LINHA_SALARIAL",
                                                pk: "A.CD_GRELHA_SALARIAL@A.CD_LINHA_SALARIAL",
                                                table: "RH_GRELHA_VALORES A",
                                                orderBy: "A.CD_GRELHA_SALARIAL,A.CD_LINHA_SALARIAL",
                                                desigColumn: "A.VALOR"
                                            };

                                            $.ajax({
                                                type: "POST",
                                                url: RH_ID_REMUNERACOES.pathToComplexListsFile,
                                                data: params,
                                                cache: false,
                                                async: true,
                                                success: function (strData) {
                                                        var dat = JSON.parse(strData);
                                                        //console.log("dat:",dat);            
                                                        dataStore = "A.CD_GRELHA_SALARIAL@A.CD_LINHA_SALARIAL__RH_GRELHA_VALORES A__A.VALOR__A.CD_GRELHA_SALARIAL,A.CD_LINHA_SALARIAL";
                                                        initApp.joinsComplexData[dataStore] = dat;
                                                }
                                            });
                                        }
///*                                        
//var el = RH_ID_REMUNERACOES.tbl.rows('.selected');
//console.log("el",el);
//$("#refresh_RH_ID_REMUNERACOES").trigger("click");
////Select current ROW (to refresh detail results)
//el.select();
//console.log("SELECTED");
//*/
                                    }
                                },100)
                            });

/*
                            RH_ID_REMUNERACOES.editor.on("submitComplete", function(e, data, action) {
                                var params = {
                                    idx: "A.CD_GRELHA_SALARIAL@A.CD_LINHA_SALARIAL__RH_GRELHA_VALORES A__A.VALOR__A.CD_GRELHA_SALARIAL,A.CD_LINHA_SALARIAL",
                                    pk: "A.CD_GRELHA_SALARIAL@A.CD_LINHA_SALARIAL",
                                    table: "RH_GRELHA_VALORES A",
                                    orderBy: "A.CD_GRELHA_SALARIAL,A.CD_LINHA_SALARIAL",
                                    desigColumn: "A.VALOR"
                                };

                                $.ajax({
                                    type: "POST",
                                    url: RH_ID_REMUNERACOES.pathToComplexListsFile,
                                    data: params,
                                    cache: false,
                                    async: false, // coloquei a falso para garantir que o refrescamento é feito antes de fechar a janela...
                                    success: function (strData) {
                                            var dataStore = "A.CD_GRELHA_SALARIAL@A.CD_LINHA_SALARIAL__RH_GRELHA_VALORES A__A.VALOR__A.CD_GRELHA_SALARIAL,A.CD_LINHA_SALARIAL",
                                                dat;
                                            if (strData) {
                                                dat = JSON.parse(strData);
                                                initApp.joinsComplexData[dataStore] = dat;
                                                console.log("REFRESCA LISTA",initApp.joinsComplexData[dataStore]);
                                            }
                                    }
                                });
                            });
*/                            
                        });
                    } else {
                        $('article.RH_ID_REMUNERACOES').remove();
                    }
                    //END Grelhas              
                    
                    //Entidades Desconto 
                    if ( conf_CADASTRO['RH_ID_ENTS_DESCONTO']["access"] ) {
                        var optionRH_ID_ENTS_DESCONTO = {
                            "tableId": "RH_ID_ENTS_DESCONTO",
                            "table": "RH_ID_ENTS_DESCONTO",
                            "workFlow": conf_CADASTRO['RH_ID_ENTS_DESCONTO']["workflow"],
                            "pk": {
                                "primary": {
                                    "EMPRESA": {"type": "varchar"},
                                    "RHID": {"type": "number"},
                                    "DT_ADMISSAO": {"type": "date"},
                                    "CD_ED": {"type": "number"},
                                    "CD_REG_DESC": {"type": "varchar"}
                                }
                            },
                            "dependsOn": {
                                "RH_ID_EMPRESAS": {
                                    "EMPRESA": "EMPRESA",
                                    "RHID": "RHID",
                                    "DT_ADMISSAO": "DT_ADMISSAO"
                                }
                            },
                            "on_pre_submit": "RH_ID_ENTS_DESCONTO",
                            //"initialWhereClause": "",
                            "order_by": "ACTIVO DESC, CD_ED ASC",
                            "recordBundle": 7,
                            "pageLenght": 7,
                            "scrollY": "234",
                            "responsive": true,
                            "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
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
                                    "data": 'RHID',
                                    "name": 'RHID',
                                    "exclude": !conf_CADASTRO['RH_ID_ENTS_DESCONTO']["rgpd"]["RHID"],
                                    "type": "hidden",
                                    "visible": false,
                                }, {
                                    "title": "", //Datatables
                                    "label": "", //Editor
                                    "data": 'EMPRESA',
                                    "name": 'EMPRESA',
                                    "exclude": !conf_CADASTRO['RH_ID_ENTS_DESCONTO']["rgpd"]["EMPRESA"],
                                    "type": "hidden",
                                    "visible": false,
                                    "className": "",
                                }, {
                                    "title": "", //Datatables
                                    "label": "", //Editor
                                    "data": 'DT_ADMISSAO',
                                    "name": 'DT_ADMISSAO',
                                    "exclude": !conf_CADASTRO['RH_ID_ENTS_DESCONTO']["rgpd"]["DT_ADMISSAO"],
                                    "type": "hidden",
                                    "visible": false,
                                    "className": "",
                                    "datatype": "date"
                                }, {
                                    "title": "", //Datatables
                                    "label": "", //Editor
                                    "data": 'CD_ED',
                                    "name": 'CD_ED',
                                    "exclude": !conf_CADASTRO['RH_ID_ENTS_DESCONTO']["rgpd"]["CD_ED"],
                                    "type": "hidden", //Editor
                                    "visible": false, //DataTables
                                }, {
                                    "responsivePriority": 2,
                                    "complexList": true,
                                    "title": "<?php echo mb_strtoupper($ui_entity,'UTF-8'); ?>",
                                    "label": "<?php echo $ui_entity; ?>",
                                    "data": 'DSP_ED',
                                    "name": 'DSP_ED',
                                    "exclude": !conf_CADASTRO['RH_ID_ENTS_DESCONTO']["rgpd"]["CD_ED"],
                                    "type": "select",
                                    "className": "visibleColumn",
                                    //"renew": true,
                                    "attr": {
                                        "dependent-group": "ENT_DESCT",
                                        "dependent-level": 1,
                                        "data-db-name": "A.CD_ED",
                                        "decodeFromTable": "RH_DEF_ENTIDADES_DESCONTO A",
                                        "desigColumn": "CONCAT(CONCAT(A.CD_ED,'-'),A.DSP_ED)",
                                        "otherValues": "A.CD_GRUPO_ED",                                        
                                        "orderBy": "A.CD_ED",
                                        "class": "form-control complexList chosen",
                                        "filter": {
                                            "create": " AND A.ACTIVO = 'S'",
                                            "edit": " AND A.ACTIVO = 'S'",
                                        }
                                    }
                                }, {
                                    "title": "", //Datatables
                                    "label": "", //Editor
                                    "data": 'CD_REG_DESC',
                                    "name": 'CD_REG_DESC',
                                    "exclude": !conf_CADASTRO['RH_ID_ENTS_DESCONTO']["rgpd"]["CD_REG_DESC"],
                                    "type": "hidden", //Editor
                                    "visible": false, //DataTables
                                }, {
                                    "responsivePriority": 3,
                                    "complexList": true,
                                    "title": "<?php echo mb_strtoupper($ui_discount_regime,'UTF-8'); ?>",
                                    "label": "<?php echo $ui_discount_regime; ?>",
                                    "data": 'DSP_REG_DESC',
                                    "name": 'DSP_REG_DESC',
                                    "exclude": !conf_CADASTRO['RH_ID_ENTS_DESCONTO']["rgpd"]["CD_ED"] && !conf_CADASTRO['RH_ID_ENTS_DESCONTO']["rgpd"]["CD_REG_DESC"] ,
                                    "type": "select",
                                    "className": "visibleColumn",
                                    //"renew": true,
                                    "attr": {
//                                        "deferred": true,
                                        "dependent-group": "ENT_DESCT",
                                        "dependent-level": 2,
                                        "data-db-name": "A.CD_ED@A.CD_REG_DESC",
                                        "decodeFromTable": "RH_REGIMES_DESCONTO A",
                                        "desigColumn": "CONCAT(CONCAT(A.CD_REG_DESC,'-'),A.DSP_REG_DESC)",
                                        "otherValues": "A.TX_COLB@A.TX_ENT",                                        
                                        "orderBy": "A.CD_REG_DESC",
                                        "class": "form-control complexList chosen",
//                                        "filter": {
//                                            "create": " AND A.CD_ED = ':CD_ED' ",
//                                            "edit": " AND A.CD_ED = ':CD_ED' ",
//                                        }
                                    }
                                }, {
                                    "responsivePriority": 4,
                                    "title": "<?php echo mb_strtoupper($ui_inscription_id,'UTF-8'); ?>",
                                    "label": "<?php echo $ui_inscription_id; ?>",
                                    "data": 'NR_INSCRICAO',
                                    "name": 'NR_INSCRICAO',
                                    "exclude": !conf_CADASTRO['RH_ID_ENTS_DESCONTO']["rgpd"]["NR_INSCRICAO"],
                                    "className": "visibleColumn",
                                    "attr": {
                                        "class": "form-control"
                                    }
                                }, {
                                    "responsivePriority": 5,
                                    "title": "<?php echo mb_strtoupper($ui_active,'UTF-8'); ?>", //Datatables
                                    "label": "<?php echo $ui_active; ?>", //Editor
                                    "data": 'ACTIVO',
                                    "name": 'ACTIVO',
                                    "exclude": !conf_CADASTRO['RH_ID_ENTS_DESCONTO']["rgpd"]["ACTIVO"],
                                    "type": "select",
                                    "className": "visibleColumn",
                                    "def": "N",
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
                                    "title": "<?php echo mb_strtoupper($ui_iterative,'UTF-8'); ?>", //Datatables
                                    "label": "<?php echo $ui_iterative; ?>", //Editor
                                    "data": 'ITERATIVO',
                                    "name": 'ITERATIVO',
                                    "exclude": !conf_CADASTRO['RH_ID_ENTS_DESCONTO']["rgpd"]["ITERATIVO"],
                                    "type": "select",
                                    "className": "none visibleColumn",
                                    "def": "N",
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
                                    "title": "<?php echo mb_strtoupper($ui_max_deduction,'UTF-8'); ?>",
                                    "label": "<?php echo $ui_max_deduction; ?>",
                                    "data": 'LIM_MAX_DESCONTO',
                                    "name": 'LIM_MAX_DESCONTO',
                                    "exclude": !conf_CADASTRO['RH_ID_ENTS_DESCONTO']["rgpd"]["LIM_MAX_DESCONTO"],
                                    "className": "none visibleColumn right",
                                    "attr": {
                                        "class": "form-control toRight"
                                    }
                                }, {
                                    "title": "<?php echo mb_strtoupper($ui_description,'UTF-8'); ?>", //Datatables
                                    "label": "<?php echo $ui_description; ?>", //Editor
                                    "data": 'OBS',
                                    "name": 'OBS',
                                    "exclude": !conf_CADASTRO['RH_ID_ENTS_DESCONTO']["rgpd"]["OBS"],
                                    "type": 'textarea', //Editor
                                    "className": "none visibleColumn",
                                    "attr": {
                                        "style": "max-width: 355px",
                                        "class": "form-control len-355"
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
                                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions,'UTF-8'); ?>" + '</span>',
                                    "label": '',
                                    "data": null,
                                    "name": 'RECORD_HISTORY',
                                    "type": "hidden",
                                    "className": "none visibleColumn",
                                    "render": function (val, type, row) {
                                        return tablesRecordHistory(val, type, row);
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
                                        //
                                        return RH_ID_ENTS_DESCONTO.crudButtons(conf_CADASTRO['RH_ID_ENTS_DESCONTO']["crud"][0], conf_CADASTRO['RH_ID_ENTS_DESCONTO']["crud"][1], conf_CADASTRO['RH_ID_ENTS_DESCONTO']["crud"][2]);
                                    }
                                }
                            ],
                            "validations": {
                                "rules": {
                                    "DSP_ED": {
                                        required: true
                                    },
                                    "DSP_REG_DESC": {
                                        required: true
                                    },
                                    "ACTIVO": {
                                        required: true
                                    },
                                    "ITERATIVO": {
                                        required: true
                                    },
                                    "NR_INSCRICAO": {
                                        maxlength: 30
                                    },
                                    "LIM_MAX_DESCONTO": {
                                        number: true
                                    },
                                    "OBS": {
                                        maxlength: 250
                                    }
                                }
                            }
                        };
                        RH_ID_ENTS_DESCONTO = new QuadTable();
                        RH_ID_ENTS_DESCONTO.initTable($.extend({}, datatable_instance_defaults, optionRH_ID_ENTS_DESCONTO));
                    } else {
                        $('article.RH_ID_ADAPTABILIDADES').remove();
                    }
                    //END Entidades Desconto

                    //Centros Custo
                    if ( conf_CADASTRO['RH_ID_ENT_INTERNAS']["access"] ) {
                        var optionRH_ID_ENT_INTERNAS = {
                            "tableId": "RH_ID_ENT_INTERNAS",
                            "table": "RH_ID_ENT_INTERNAS",
                            "workFlow": conf_CADASTRO['RH_ID_ENT_INTERNAS']["workflow"],
                            "pk": {
                                "primary": {
                                    "EMPRESA": {"type": "varchar"},
                                    "RHID": {"type": "number"},
                                    "DT_ADMISSAO": {"type": "date"},
                                    "CD_ENT_INT": {"type": "varchar"},
                                    "TIPO": {"type": "varchar"},
                                    "DT_INI": {"type": "date"}
                                }
                            },
                            "dependsOn": {
                                "RH_ID_EMPRESAS": {
                                    "EMPRESA": "EMPRESA",
                                    "RHID": "RHID",
                                    "DT_ADMISSAO": "DT_ADMISSAO"
                                }
                            },
                            "on_pre_submit": "RH_ID_ENT_INTERNAS",
                            //"initialWhereClause": "",
                            "order_by": "DT_INI DESC",
                            "recordBundle": 7,
                            "pageLenght": 7,
                            "scrollY": "234",
                            "responsive": true,
                            "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
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
                                    "data": 'RHID',
                                    "name": 'RHID',
                                    "exclude": !conf_CADASTRO['RH_ID_ENT_INTERNAS']["rgpd"]["RHID"],
                                    "type": "hidden",
                                    "visible": false,
                                }, {
                                    "title": "", //Datatables
                                    "label": "", //Editor
                                    "data": 'EMPRESA',
                                    "name": 'EMPRESA',
                                    "exclude": !conf_CADASTRO['RH_ID_ENT_INTERNAS']["rgpd"]["EMPRESA"],
                                    "type": "hidden",
                                    "visible": false,
                                    "className": "",
                                }, {
                                    "title": "", //Datatables
                                    "label": "", //Editor
                                    "data": 'DT_ADMISSAO',
                                    "name": 'DT_ADMISSAO',
                                    "exclude": !conf_CADASTRO['RH_ID_ENT_INTERNAS']["rgpd"]["DT_ADMISSAO"],
                                    "type": "hidden",
                                    "visible": false,
                                    "className": "",
                                    "datatype": "date"
                                }, {
                                    "title": "", //Datatables
                                    "label": "", //Editor
                                    "data": 'CD_ENT_INT',
                                    "name": 'CD_ENT_INT',
                                    "exclude": !conf_CADASTRO['RH_ID_ENT_INTERNAS']["rgpd"]["CD_ENT_INT"],
                                    "type": "hidden",
                                    "visible": false,
                                    "className": "",
                                }, {
                                    "responsivePriority": 2,
                                    "complexList": true,
                                    "title": "<?php echo mb_strtoupper($ui_internal_entity,'UTF-8'); ?>",
                                    "label": "<?php echo $ui_internal_entity; ?>",
                                    "data": "DSP_ENT_INT",
                                    "name": "DSP_ENT_INT",
                                    "exclude": !conf_CADASTRO['RH_ID_ENT_INTERNAS']["rgpd"]["EMPRESA"] && !conf_CADASTRO['RH_ID_ENT_INTERNAS']["rgpd"]["CD_ENT_INT"] ,
                                    "className": "visibleColumn",
                                    "type": "select",
                                    "attr": {
                                        "deferred": true,
                                        "dependent-group": "ENT_INTERNA",
                                        "dependent-level": 1,
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
                                    "responsivePriority": 3,
                                    "title": "<?php echo mb_strtoupper($ui_type,'UTF-8'); ?>", //Datatables
                                    "label": "<?php echo $ui_type; ?>", //Editor
                                    "data": 'TIPO',
                                    "name": 'TIPO',
                                    "exclude": !conf_CADASTRO['RH_ID_ENT_INTERNAS']["rgpd"]["TIPO"],
                                    "type": "select",
                                    "className": "visibleColumn",
                                    "attr": {
                                        "domain-list": true,
                                        "dependent-group": 'RH_ID_ENT_INTERNAS.TIPO',
                                        "class": "form-control"
                                    },
                                    "render": function (val, type, row) {
                                        if (val != null) {
                                            var o = _.find(initApp.joinsData['RH_ID_ENT_INTERNAS.TIPO'], {'RV_LOW_VALUE': val});
                                            return val == null ? null : o['RV_MEANING'];
                                        }
                                        return val;
                                    }
                                }, {
                                    "responsivePriority": 4,
                                    "title": "<?php echo mb_strtoupper($ui_begin_date,'UTF-8'); ?>", //Datatables
                                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                                    "data": 'DT_INI',
                                    "name": 'DT_INI',
                                    "exclude": !conf_CADASTRO['RH_ID_ENT_INTERNAS']["rgpd"]["DT_INI"],
                                    "datatype": 'date',
                                    "className": "visibleColumn",
                                    "attr": {
                                        "class": "datepicker"
                                    }
                                }, {
                                    "responsivePriority": 5,
                                    "title": "<?php echo mb_strtoupper($ui_end_date,'UTF-8'); ?>", //Datatables
                                    "label": "<?php echo $ui_end_date; ?>", //Editor
                                    "data": 'DT_FIM',
                                    "name": 'DT_FIM',
                                    "exclude": !conf_CADASTRO['RH_ID_ENT_INTERNAS']["rgpd"]["DT_FIM"],
                                    "datatype": 'date',
                                    "className": "visibleColumn",
                                    "attr": {
                                        "class": "datepicker"
                                    }
                                }, {
                                    "responsivePriority": 6,
                                    "title": "<?php echo mb_strtoupper($ui_percentage_sort,'UTF-8'); ?>", //Datatables
                                    "label": "<?php echo $ui_percentage_sort; ?>", //Editor
                                    "data": 'PERCENTAGEM',
                                    "name": 'PERCENTAGEM',
                                    "exclude": !conf_CADASTRO['RH_ID_ENT_INTERNAS']["rgpd"]["PERCENTAGEM"],
                                    "className": "visibleColumn right",
                                    "attr": {
                                        "class": "form-control toRight",
                                        "style": "width: 30%;"
                                    }
                                }, {
                                    "responsivePriority": 7,
                                    "title": "<?php echo mb_strtoupper($ui_active,'UTF-8'); ?>", //Datatables
                                    "label": "<?php echo $ui_active; ?>", //Editor
                                    "data": 'ACTIVO',
                                    "name": 'ACTIVO',
                                    "exclude": !conf_CADASTRO['RH_ID_ENT_INTERNAS']["rgpd"]["ACTIVO"],
                                    "type": "select",
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
                                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions,'UTF-8'); ?>" + '</span>',
                                    "label": '',
                                    "data": null,
                                    "name": 'RECORD_HISTORY',
                                    "type": "hidden",
                                    "className": "none visibleColumn",
                                    "render": function (val, type, row) {
                                        return tablesRecordHistory(val, type, row);
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
                                        //
                                        return RH_ID_ENT_INTERNAS.crudButtons(conf_CADASTRO['RH_ID_ENT_INTERNAS']["crud"][0], conf_CADASTRO['RH_ID_ENT_INTERNAS']["crud"][1], conf_CADASTRO['RH_ID_ENT_INTERNAS']["crud"][2]);
                                    }
                                }
                            ],
                            "validations": {
                                "rules": {
                                    "DSP_ENT_INT": {
                                        required: true,
                                    },
                                    "TIPO": {
                                        required: true,
                                    },
                                    "ACTIVO": {
                                        required: true,
                                    },
                                    "DT_INI": {
                                        required: true,
                                        dateISO: true,
                                    },
                                    "PERCENTAGEM": {//Same as defined on attr.name
                                        number: true,
                                    },
                                    "DT_FIM": {
                                        dateISO: true,
                                        dateEqOrNextThan: 'DT_INI',
                                    }
                                },
                                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                                "messages": {
                                    "DT_FIM": {
                                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                                    }
                                }
                            }
                        };
                        RH_ID_ENT_INTERNAS = new QuadTable();
                        RH_ID_ENT_INTERNAS.initTable($.extend({}, datatable_instance_defaults, optionRH_ID_ENT_INTERNAS));
                    } else {
                        $('article.RH_ID_ENT_INTERNAS').remove();
                    }
                    //END Centros Custo RH_ID_DESTACAMENTOS

                    //Adaptabilidade
                    if ( conf_CADASTRO['RH_ID_ADAPTABILIDADES']["access"] ) {
                        var optionRH_ID_ADAPTABILIDADES = {
                            "tableId": "RH_ID_ADAPTABILIDADES",
                            "table": "RH_ID_ADAPTABILIDADES",
                            "workFlow": conf_CADASTRO['RH_ID_ADAPTABILIDADES']["workflow"],
                            "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_adaptability; ?>",
                            "pk": {
                                "primary": {
                                    "EMPRESA": {"type": "varchar"},
                                    "RHID": {"type": "number"},
                                    "DT_ADMISSAO": {"type": "date"},
                                    "CD_IRCT": {"type": "varchar"},
                                    "DT_EFICACIA": {"type": "date"},
                                    "DT_INI_RA": {"type": "date"},
                                    "DT_INI_HDR": {"type": "date"}
                                }
                            },
                            "dependsOn": {
                                "RH_ID_EMPRESAS": {
                                    "EMPRESA": "EMPRESA",
                                    "RHID": "RHID",
                                    "DT_ADMISSAO": "DT_ADMISSAO"
                                }
                            },
                            "on_pre_submit": "RH_ID_ADAPTABILIDADES",
                            //"initialWhereClause": "",
                            "order_by": "DT_INI_HDR DESC",
                            "recordBundle": 7,
                            "pageLenght": 7,
                            "scrollY": "234",
                            "responsive": true,
                            "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
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
                                    "data": 'RHID',
                                    "name": 'RHID',
                                    "exclude": !conf_CADASTRO['RH_ID_ADAPTABILIDADES']["rgpd"]["RHID"],
                                    "type": "hidden",
                                    "visible": false,
                                }, {
                                    "title": "", //Datatables
                                    "label": "", //Editor
                                    "data": 'EMPRESA',
                                    "name": 'EMPRESA',
                                    "exclude": !conf_CADASTRO['RH_ID_ADAPTABILIDADES']["rgpd"]["EMPRESA"],
                                    "type": "hidden",
                                    "visible": false,
                                    "className": "",
                                }, {
                                    "title": "", //Datatables
                                    "label": "", //Editor
                                    "data": 'DT_ADMISSAO',
                                    "name": 'DT_ADMISSAO',
                                    "exclude": !conf_CADASTRO['RH_ID_ADAPTABILIDADES']["rgpd"]["DT_ADMISSAO"],
                                    "type": "hidden",
                                    "visible": false,
                                    "className": "",
                                    "datatype": "date"
                                }, {
                                    "title": "", //Datatables
                                    "label": "", //Editor
                                    "data": 'CD_IRCT',
                                    "name": 'CD_IRCT',
                                    "exclude": !conf_CADASTRO['RH_ID_ADAPTABILIDADES']["rgpd"]["CD_IRCT"],
                                    "type": "hidden", //Editor
                                    "visible": false, //DataTables   
                                }, {
                                    "responsivePriority": 2,
                                    "complexList": true,
                                    "title": "<?php echo mb_strtoupper($ui_irct,'UTF-8'); ?>",
                                    "label": "<?php echo $ui_irct; ?>",
                                    "data": 'DSP_IRCT',
                                    "name": 'DSP_IRCT',
                                    "exclude": !conf_CADASTRO['RH_ID_ADAPTABILIDADES']["rgpd"]["CD_IRCT"] && !conf_CADASTRO['RH_ID_ADAPTABILIDADES']["rgpd"]["DT_EFICACIA"] && !conf_CADASTRO['RH_ID_ADAPTABILIDADES']["rgpd"]["DT_INI_RA"],
                                    "type": "select",
                                    "className": "visibleColumn",
                                    //"renew": true,
                                    "attr": {
                                        "dependent-group": "IRCT",
                                        "dependent-level": 1,
                                        "data-db-name": "A.CD_IRCT@A.DT_EFICACIA@A.DT_INI_RA",
                                        "decodeFromTable": "RH_DEF_REGRAS_ADAPTABILIDADE_VIEW A",
                                        "desigColumn": "CONCAT(CONCAT(A.CD_IRCT, '-'), A.DSP_IRCT)",
                                        "orderBy": "A.DT_INI_RA DESC",
                                        "class": "form-control complexList chosen"
                                    },
                                }, {
                                    "responsivePriority": 3,
                                    "title": "<?php echo mb_strtoupper($ui_irct_date,'UTF-8'); ?>", //Datatables
                                    "label": "<?php echo $ui_irct_date; ?>", //Editor
                                    "data": 'DT_INI_RA',
                                    "name": 'DT_INI_RA',
                                    "exclude": !conf_CADASTRO['RH_ID_ADAPTABILIDADES']["rgpd"]["DT_INI_RA"],
                                    "datatype": 'date',
                                    "className": "visibleColumn",
                                    "type": "hidden", //Editor
                                    "attr": {
                                        "class": "datepicker"
                                    }
                                }, {
                                    "responsivePriority": 4,
                                    "title": "<?php echo mb_strtoupper($ui_effective_dt,'UTF-8'); ?>", //Datatables
                                    "label": "<?php echo $ui_effective_dt; ?>", //Editor
                                    "data": 'DT_EFICACIA',
                                    "name": 'DT_EFICACIA',
                                    "exclude": !conf_CADASTRO['RH_ID_ADAPTABILIDADES']["rgpd"]["DT_EFICACIA"],
                                    "datatype": 'date',
                                    "className": "visibleColumn",
                                    "type": "hidden", //Editor
                                    "attr": {
                                        "class": "datepicker"
                                    }
                                }, {
                                    "responsivePriority": 5,
                                    "title": "<?php echo mb_strtoupper($ui_begin_date,'UTF-8'); ?>", //Datatables
                                    "label": "<?php echo $ui_begin_date; ?>", //Editor
                                    "data": 'DT_INI_HDR',
                                    "name": 'DT_INI_HDR',
                                    "exclude": !conf_CADASTRO['RH_ID_ADAPTABILIDADES']["rgpd"]["DT_INI_HDR"],
                                    "datatype": 'date',
                                    "className": "visibleColumn",
                                    "attr": {
                                        "class": "datepicker"
                                    }
                                }, {
                                    "responsivePriority": 6,
                                    "title": "<?php echo mb_strtoupper($ui_end_date,'UTF-8'); ?>", //Datatables
                                    "label": "<?php echo $ui_end_date; ?>", //Editor
                                    "data": 'DT_FIM_HDR',
                                    "name": 'DT_FIM_HDR',
                                    "exclude": !conf_CADASTRO['RH_ID_ADAPTABILIDADES']["rgpd"]["DT_FIM_HDR"],
                                    "datatype": 'date',
                                    "className": "visibleColumn",
                                    "attr": {
                                        "class": "datepicker"
                                    }
                                }, {
                                    "title": "<?php echo mb_strtoupper($ui_obs_short,'UTF-8'); ?>", //Datatables
                                    "label": "<?php echo $ui_obs_short; ?>", //Editor
                                    "data": 'OBS',
                                    "name": 'OBS',
                                    "exclude": !conf_CADASTRO['RH_ID_ADAPTABILIDADES']["rgpd"]["OBS"],
                                    "type": 'textarea', //Editor
                                    "className": "none visibleColumn",
                                    "attr": {
                                        "style": "max-width: 355px",
                                        "class": "form-control len-355"
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
                                    "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions,'UTF-8'); ?>" + '</span>',
                                    "label": '',
                                    "data": null,
                                    "name": 'RECORD_HISTORY',
                                    "type": "hidden",
                                    "className": "none visibleColumn",
                                    "render": function (val, type, row) {
                                        return tablesRecordHistory(val, type, row);
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
                                        //
                                        return RH_ID_ADAPTABILIDADES.crudButtons(conf_CADASTRO['RH_ID_ADAPTABILIDADES']["crud"][0], conf_CADASTRO['RH_ID_ADAPTABILIDADES']["crud"][1], conf_CADASTRO['RH_ID_ADAPTABILIDADES']["crud"][2]);
                                    }
                                }
                            ],
                            "validations": {
                                "rules": {
                                    "DSP_IRCT": {
                                        required: true
                                    },
                                    "OBS": {
                                        maxlength: 4000,
                                    },
                                    "DT_INI_HDR": {
                                        required: true,
                                        dateISO: true,
                                    },
                                    "DT_FIM_HDR": {
                                        dateISO: true,
                                        dateEqOrNextThan: 'DT_INI_HDR',
                                    }
                                },
                                //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                                "messages": {
                                    "DT_FIM_HDR": {
                                        dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                                    }
                                }
                            }
                        };
                        RH_ID_ADAPTABILIDADES = new QuadTable();
                        RH_ID_ADAPTABILIDADES.initTable($.extend({}, datatable_instance_defaults, optionRH_ID_ADAPTABILIDADES));
                    } else {
                        $('article.RH_ID_ADAPTABILIDADES').remove();
                    }
                    //END Adaptabilidade          
                }
                //END Remunerações TAB
                
                //Workflows -> RH_DEF_WORKFLOWS
                if  ( !conf_CADASTRO['RH_ID_WORKFLOWS']["access"] ) {
                    $('a[href="#Tab26"]').closest('li').remove(); //Estru
                } else {
                    var optionRH_ID_WORKFLOWS = {
                        "tableId": "RH_ID_WORKFLOWS",
                        "table": "RH_ID_WORKFLOWS",
                        "workFlow": conf_CADASTRO['RH_ID_WORKFLOWS']["workflow"],
                        "pk": {
                            "primary": {
                                "EMPRESA": {"type": "varchar"},
                                "RHID": {"type": "number"},
                                "DT_ADMISSAO": {"type": "date"},
                                "ID_PERFIL": {"type": "number"},
                                "DT_INI": {"type": "date"}
                            }
                        },
                        "dependsOn": {
                            "RH_ID_EMPRESAS": {
                                "EMPRESA": "EMPRESA",
                                "RHID": "RHID",
                                "DT_ADMISSAO": "DT_ADMISSAO"
                            }
                        },
                        "on_pre_submit": "RH_ID_WORKFLOWS",
                        //"initialWhereClause": "",
                        "order_by": "ID_PERFIL ASC, DT_INI DESC",
                        "recordBundle": 4,
                        "pageLenght": 4,
                        "scrollY": "117",
                        "responsive": true,
                        "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
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
                                "data": 'RHID',
                                "name": 'RHID',
                                "exclude": !conf_CADASTRO['RH_ID_WORKFLOWS']["rgpd"]["RHID"],
                                "type": "hidden",
                                "visible": false,
                            }, {
                                "title": "", //Datatables
                                "label": "", //Editor
                                "data": 'EMPRESA',
                                "name": 'EMPRESA',
                                "exclude": !conf_CADASTRO['RH_ID_WORKFLOWS']["rgpd"]["EMPRESA"],
                                "type": "hidden",
                                "visible": false,
                                "className": "",
                            }, {
                                "title": "", //Datatables
                                "label": "", //Editor
                                "data": 'DT_ADMISSAO',
                                "name": 'DT_ADMISSAO',
                                "exclude": !conf_CADASTRO['RH_ID_WORKFLOWS']["rgpd"]["DT_ADMISSAO"],
                                "type": "hidden",
                                "visible": false,
                                "className": "",
                                "datatype": "date"
                            }, {
                                "title": "", //Datatables
                                "label": "", //Editor
                                "data": 'ID_PERFIL',
                                "name": 'ID_PERFIL',
                                "exclude": !conf_CADASTRO['RH_ID_WORKFLOWS']["rgpd"]["ID_PERFIL"],
                                "type": "hidden", //Editor
                                "visible": false, //DataTables   
                            }, {
                                "responsivePriority": 2,
                                "complexList": true,
                                "title": "<?php echo mb_strtoupper($ui_workflow_intervenient,'UTF-8'); ?>",
                                "label": "<?php echo $ui_workflow_intervenient; ?>",
                                "data": 'DSP_PERFIL',
                                "name": 'DSP_PERFIL',
                                "exclude": !conf_CADASTRO['RH_ID_WORKFLOWS']["rgpd"]["ID_PERFIL"],
                                "type": "select",
                                "className": "visibleColumn",
                                //"renew": true,
                                "attr": {
                                    "dependent-group": "PERFIL",
                                    "dependent-level": 1,
                                    "data-db-name": "A.ID",
                                    "distribute-value": "ID_PERFIL", // Usado só quando os atributos destino têm nomes de colunas diferentes da tabela fonte
                                    "decodeFromTable": "WEB_ADM_PERFIS A",
                                    "desigColumn": "A.DSP_PERFIL",
                                    "orderBy": "A.ID",
                                    "class": "form-control complexList chosen",
                                    "filter": {
                                        "create": " AND A.ESTADO = 'A' AND A.WORKFLOW = 'S' ",
                                        "edit": " AND A.ESTADO = 'A' AND A.WORKFLOW = 'S' ",
                                    }
                                }
                            }, {
                                "title": "", //Datatables
                                "label": "", //Editor
                                "data": 'RHID_CHEFIA',
                                "name": 'RHID_CHEFIA',
                                "exclude": !conf_CADASTRO['RH_ID_WORKFLOWS']["rgpd"]["RHID_CHEFIA"],
                                "type": "hidden", //Editor
                                "visible": false, //DataTables
                            }, {
                                "responsivePriority": 3,
                                "complexList": true,
                                "title": "<?php echo mb_strtoupper($ui_rhid,'UTF-8'); ?>",
                                "label": "<?php echo $ui_rhid; ?>",
                                "data": 'CHEFIA',
                                "name": 'CHEFIA',
                                "exclude": !conf_CADASTRO['RH_ID_WORKFLOWS']["rgpd"]["EMPRESA"] && !conf_CADASTRO['RH_ID_WORKFLOWS']["rgpd"]["RHID_CHEFIA"],
                                "type": "select",
                                "className": "visibleColumn",
                                //"renew": true,
                                "attr": {
                                    "dependent-group": "COLABS",
                                    "dependent-level": 1,
                                    "deferred": true,
                                    "data-db-name": 'A.EMPRESA@A.RHID',
                                    "distribute-value": "EMPRESA@RHID_CHEFIA",
                                    "decodeFromTable": 'QUAD_PEOPLE A',
                                    "desigColumn": "CONCAT(CONCAT(A.RHID,'-'),A.NOME_REDZ)", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.
                                    "orderBy": "A.RHID", //usado no complexList.php
                                    "class": "form-control complexList chosen",
                                    //"disabled": true, //Permite inibir o campo no Editor
                                    "filter": {
                                        "create": " AND A.ATIVO = 'S' AND A.EMPRESA = ':EMPRESA'",
                                        "edit": " AND A.ATIVO = 'S' AND A.EMPRESA = ':EMPRESA'",
                                    }
                                }
                            }, {
                                "title": "", //Datatables
                                "label": "", //Editor
                                "data": 'ID_UTILIZADOR',
                                "name": 'ID_UTILIZADOR',
                                "exclude": !conf_CADASTRO['RH_ID_WORKFLOWS']["rgpd"]["ID_UTILIZADOR"],
                                "type": "hidden", //Editor
                                "visible": false, //DataTables
                            }, {
                                "responsivePriority": 4,
                                "complexList": true,
                                "title": "<?php echo mb_strtoupper($ui_user,'UTF-8'); ?>",
                                "label": "<?php echo $ui_user; ?>",
                                "data": 'UTILIZADOR',
                                "name": 'UTILIZADOR',
                                "exclude": !conf_CADASTRO['RH_ID_WORKFLOWS']["rgpd"]["ID_UTILIZADOR"],
                                "type": "select",
                                "className": "visibleColumn",
                                //"renew": true,
                                "attr": {
                                    "dependent-group": "USERS",
                                    "dependent-level": 1,
                                    "data-db-name": 'A.ID',
                                    "distribute-value": 'ID_UTILIZADOR',
                                    "decodeFromTable": 'WEB_ADM_UTILIZADORES A',
                                    "desigColumn": "A.UTILIZADOR", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.
                                    "orderBy": "A.ID", //usado no complexList.php
                                    "class": "form-control complexList chosen",
                                    //"disabled": true, //Permite inibir o campo no Editor
                                    "filter": {
                                        "create": " AND A.ESTADO = 'A'",
                                        "edit": " AND A.ESTADO = 'A'",
                                    }
                                }
                            }, {
                                "responsivePriority": 5,
                                "title": "<?php echo mb_strtoupper($ui_begin_date,'UTF-8'); ?>", //Datatables
                                "label": "<?php echo $ui_begin_date; ?>", //Editor
                                "data": 'DT_INI',
                                "name": 'DT_INI',
                                "exclude": !conf_CADASTRO['RH_ID_WORKFLOWS']["rgpd"]["DT_INI"],
                                "datatype": 'date',
                                "def": hoje(),
                                "className": "visibleColumn",
                                "attr": {
                                    "class": "datepicker"
                                }
                            }, {
                                "responsivePriority": 6,
                                "title": "<?php echo mb_strtoupper($ui_end_date,'UTF-8'); ?>", //Datatables
                                "label": "<?php echo $ui_end_date; ?>", //Editor
                                "data": 'DT_FIM',
                                "name": 'DT_FIM',
                                "exclude": !conf_CADASTRO['RH_ID_WORKFLOWS']["rgpd"]["DT_FIM"],
                                "datatype": 'date',
                                "className": "visibleColumn",
                                "attr": {
                                    "class": "datepicker"
                                }
                            }, {
                                "title": "<?php echo mb_strtoupper($ui_description,'UTF-8'); ?>", //Datatables
                                "label": "<?php echo $ui_description; ?>", //Editor
                                "data": 'DESCRICAO',
                                "name": 'DESCRICAO',
                                "exclude": !conf_CADASTRO['RH_ID_WORKFLOWS']["rgpd"]["DESCRICAO"],
                                "type": 'textarea', //Editor
                                "className": "none visibleColumn",
                                "attr": {
                                    "style": "max-width: 355px",
                                    "class": "form-control len-355"
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
                                "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions,'UTF-8'); ?>" + '</span>',
                                "label": '',
                                "data": null,
                                "name": 'RECORD_HISTORY',
                                "type": "hidden",
                                "className": "none visibleColumn",
                                "render": function (val, type, row) {
                                    return tablesRecordHistory(val, type, row);
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
                                    //
                                    return RH_ID_WORKFLOWS.crudButtons(conf_CADASTRO['RH_ID_WORKFLOWS']["crud"][0], conf_CADASTRO['RH_ID_WORKFLOWS']["crud"][1], conf_CADASTRO['RH_ID_WORKFLOWS']["crud"][2]);
                                }
                            }
                        ],
                        "validations": {
                            "rules": {
                                "DSP_PERFIL": {
                                    required: true
                                },
                                "DESCRICAO": {
                                    maxlength: 1000,
                                },
                                "DT_INI": {
                                    required: true,
                                    dateISO: true,
                                },
                                "DT_FIM": {
                                    dateISO: true,
                                    dateEqOrNextThan: 'DT_INI',
                                }
                            },
                            //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                            "messages": {
                                "DT_FIM": {
                                    dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                                }
                            }
                        }
                    };
                    RH_ID_WORKFLOWS = new QuadTable();
                    RH_ID_WORKFLOWS.initTable($.extend({}, datatable_instance_defaults, optionRH_ID_WORKFLOWS));                
                    
                    //DECLARING LOCAL Validation RULES
                    if (1 === 1) {
                        // validar que só é preenchido ou o colaborador ou o utilizador
                        $(document).on('RH_ID_WORKFLOWSAttachEvt', function (e) {
                        
                            $("#DTE_Field_CHEFIA", "#RH_ID_WORKFLOWS_editorForm").on('change', function(e) {
                                var operacao = RH_ID_WORKFLOWS.editor.s["action"],
                                    utilizador = $("#DTE_Field_UTILIZADOR", "#RH_ID_WORKFLOWS_editorForm");
                                if (operacao !== 'query' && $(this).val() !== '' && utilizador.val() !== '') {
                                    utilizador.val("")
                                              .trigger('change')
                                              .trigger("chosen:updated");
                                    
                                }
                            });
                        
                            $("#DTE_Field_UTILIZADOR", "#RH_ID_WORKFLOWS_editorForm").on('change', function(e) {
                                var operacao = RH_ID_WORKFLOWS.editor.s["action"],
                                    chefia = $("#DTE_Field_CHEFIA", "#RH_ID_WORKFLOWS_editorForm");
                                if (operacao !== 'query' && $(this).val() !== '' && chefia.val() !== '') {
                                    chefia.val("")
                                          .trigger('change')
                                          .trigger("chosen:updated");
                                }
                            });
                        });

                    }
                    //END DECLARING LOCAL Validation RULES
                    
                }
                //END Workflows
            } else {
                //REMOVE HMTL
                $('#widget-tab-1 li.empresa').remove();
                $('#Tab2').remove();
            }
            //END SHOW EMPRESAS
            
            //Funções "Experiência Profissional Anterior"
            if (1 === 0) {
                var optionRH_ID_FUNCOES_OUT = {
                    "tableId": "RH_ID_FUNCOES_OUT",
                    "table": "RH_ID_FUNCOES",
                    "workFlow": conf_CADASTRO['RH_ID_FUNCOES']["workflow"],
                    "selectRecordMsg": "<?php echo $ui_please_select_record .$ui_adaptability; ?>",
                    "pk": {
                        "primary": {
                            "EMPRESA": {"type": "varchar"},
                            "RHID": {"type": "number"},
                            "DT_ADMISSAO": {"type": "date"},
                            "ID_FUNCAO": {"type": "number"},
                            "TP_REGISTO": {"type": "varchar"},
                            "TIPO": {"type": "varchar"},
                            "DT_INI": {"type": "date"}
                        }
                    },
                    "dependsOn": {
                        "RH_ID_EMPRESAS": {
                            "EMPRESA": "EMPRESA",
                            "RHID": "RHID",
                            "DT_ADMISSAO": "DT_ADMISSAO"
                        }
                    },
                    "initialWhereClause": " TP_REGISTO = 'A' AND TIPO = 'C' ",
                    "order_by": "DT_INI DESC",
                    "recordBundle": 4,
                    "pageLenght": 4,
                    "scrollY": "117",
                    "responsive": true,
                    "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
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
                            "data": 'RHID',
                            "name": 'RHID',
                            "exclude": !conf_CADASTRO['RH_ID_FUNCOES']["rgpd"]["RHID"],
                            "type": "hidden",
                            "visible": false,
                        }, {
                            "title": "", //Datatables
                            "label": "", //Editor
                            "data": 'EMPRESA',
                            "name": 'EMPRESA',
                            "type": "hidden",
                            "visible": false,
                            "className": "",
                        }, {
                            "title": "", //Datatables
                            "label": "", //Editor
                            "data": 'DT_ADMISSAO',
                            "name": 'DT_ADMISSAO',
                            "type": "hidden",
                            "visible": false,
                            "className": "",
                            "datatype": "date"
                        }, {
                            "title": "", //Datatables
                            "label": "", //Editor
                            "data": 'ID_FUNCAO',
                            "name": 'ID_FUNCAO',
                            "type": "hidden", //Editor
                            "visible": false, //DataTables  
                        }, {
                            "title": "", //Datatables
                            "label": "", //Editor
                            "data": 'TP_REGISTO',
                            "name": 'TP_REGISTO',
                            "def": "A",
                            "defaultContent": "A",
                            "type": "hidden", //Editor
                            "visible": false, //DataTables  
                        }, {
                            "title": "", //Datatables
                            "label": "", //Editor
                            "data": 'DT_INI_FUNCAO',
                            "name": 'DT_INI_FUNCAO',
                            "type": "hidden", //Editor
                            "visible": false, //DataTables 
                            "datatype": "datetime"
                        }, {
                            //"responsivePriority": 2,
                            //"complexList": true,
                            "title": "", //Datatables
                            "label": "", //Editor
                            "data": 'TIPO',
                            "name": 'TIPO',
                            "def": "C",
                            "type": "hidden", //Editor
                            "visible": false, //DataTables  
                            //                        "type": "select",
                            //                        "className": "visibleColumn",
                            //                        //"renew": true,
                            //                        "attr": {
                            //                            "dependent-group": "TIPO_IN",
                            //                            "dependent-level": 1,
                            //                            "data-db-name": "A.CD",
                            //                            "distribute-value": "TIPO",
                            //                            "decodeFromTable": "RH_ID_FUNCOES_TIPO_OUT A",
                            //                            "desigColumn": "A.DSP",
                            //                            "orderBy": "A.CD",
                            //                            "class": "form-control complexList chosen"
                            //                        },
                        }, {
                            "responsivePriority": 3,
                            "complexList": true,
                            "title": "<?php echo mb_strtoupper($ui_function,'UTF-8'); ?>",
                            "label": "<?php echo $ui_function; ?>",
                            "data": 'DSP_FUNCAO',
                            "name": 'DSP_FUNCAO',
                            "type": "select",
                            "className": "visibleColumn",
                            //"renew": true,
                            "attr": {
                                "deferred": true,
                                "dependent-group": "FUNCOES",
                                "dependent-level": 1,
                                "data-db-name": "A.EMPRESA@A.ID_FUNCAO@A.TP_REGISTO@A.DT_INI_FUNCAO",
                                "distribute-value": "A.EMPRESA@A.ID_FUNCAO@A.TP_REGISTO@A.DT_INI_FUNCAO",
                                //"otherValues": "DESCRICAO",
                                "decodeFromTable": "RH_DEF_FUNCOES A",
                                "whereClause": " A.TP_REGISTO = 'A' ",
                                "desigColumn": "CONCAT(A.ID_FUNCAO, '-'), A.DSP_FUNCAO)",
                                "orderBy": "A.ID_FUNCAO DESC",
                                "class": "form-control complexList chosen",
                                "filter": {
                                    "create": " AND A.DT_FIM_FUNCAO IS NULL", //On-New-Record
                                    "edit": " AND A.DT_FIM_FUNCAO IS NULL", //On-Edit-Record
                                }
                            },
                        }, {
                            "title": "<?php echo mb_strtoupper($ui_designation,'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_description; ?>", //Editor
                            "data": 'DSP_EXPERIENCIA_ANT',
                            "name": 'DSP_EXPERIENCIA_ANT',
                            "className": "none visibleColumn",
                            "attr": {
                                "name": 'DSP_FASE',
                            }
                        }, {
                            "title": "<?php echo mb_strtoupper($ui_short_desig,'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_short_desig; ?>", //Editor
                            "data": 'DSR_EXPERIENCIA_ANT',
                            "name": 'DSR_EXPERIENCIA_ANT',
                            "className": "none visibleColumn",
                            "attr": {
                                "name": 'DSR_FASE'
                            }
                        }, {
                            "responsivePriority": 4,
                            "title": "<?php echo mb_strtoupper($ui_begin_date,'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_begin_date; ?>", //Editor
                            "data": 'DT_INI',
                            "name": 'DT_INI',
                            "datatype": 'date',
                            "className": "visibleColumn",
                            "type": "hidden", //Editor
                            "attr": {
                                "class": "datepicker"
                            }
                        }, {
                            "responsivePriority": 5,
                            "title": "<?php echo mb_strtoupper($ui_end_date,'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_end_date; ?>", //Editor
                            "data": 'DT_FIM',
                            "name": 'DT_FIM',
                            "datatype": 'date',
                            "className": "visibleColumn",
                            "type": "hidden", //Editor
                            "attr": {
                                "class": "datepicker"
                            }
                        }, {
                            "title": "<?php echo mb_strtoupper($ui_description,'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_description; ?>", //Editor
                            "data": 'DESCRICAO',
                            "name": 'DESCRICAO',
                            "type": 'textarea', //Editor
                            "className": "none visibleColumn",
                            "attr": {
                                "style": "max-width: 355px",
                                "class": "form-control len-355"
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
                            "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions,'UTF-8'); ?>" + '</span>',
                            "label": '',
                            "data": null,
                            "name": 'RECORD_HISTORY',
                            "type": "hidden",
                            "className": "none visibleColumn",
                            "render": function (val, type, row) {
                                return tablesRecordHistory(val, type, row);
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
                                return RH_ID_FUNCOES_OUT.crudButtons(conf_CADASTRO['RH_ID_FUNCOES']["crud"][0], conf_CADASTRO['RH_ID_FUNCOES']["crud"][1], conf_CADASTRO['RH_ID_FUNCOES']["crud"][2]);
                            }
                        }
                    ],
                    "validations": {
                        "rules": {
                            "TIPO": {
                                required: true
                            },
                            "DSP_FUNCAO": {
                                required: true
                            },
                            "DESCRICAO": {
                                maxlength: 4000,
                            },
                            "DT_INI": {
                                required: true,
                                dateISO: true,
                            },
                            "DT_FIM": {
                                dateISO: true,
                                dateEqOrNextThan: 'DT_INI',
                            }
                        },
                        //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                        "messages": {
                            "DT_FIM": {
                                dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                            }
                        }
                    }
                };
                RH_ID_FUNCOES_OUT = new QuadTable();
                RH_ID_FUNCOES_OUT.initTable($.extend({}, datatable_instance_defaults, optionRH_ID_FUNCOES_OUT));
            }
            //END Funções "Experiência Profissional Anterior"
        }
        //END TABLES :: Identificações, Empresas e suas dependências

        //OTHER TABLES
        if (1 === 1) {
            //Docs. / Agregado TAB
            if  ( !conf_CADASTRO['RH_ID_DOCUMENTOS']["access"] && !conf_CADASTRO['RH_ID_AGREGADOS']["access"] ) {
                //REMOVE HMTL
                $('a[href="#Tab3"]').remove();
                $('#Tab3').remove();
            } else {
                //Documentos
                if ( conf_CADASTRO['RH_ID_DOCUMENTOS']["access"] ) {
                    var optionRH_ID_DOCUMENTOS = {
                        "tableId": "RH_ID_DOCUMENTOS",
                        "table": "RH_ID_DOCUMENTOS",
                        "workFlow": conf_CADASTRO['RH_ID_DOCUMENTOS']["workflow"],
                        "pk": {
                            "primary": {
                                "RHID": {"type": "number"},
                                //"CD_AGREGADO": {"type": "varchar"},
                                "CD_DOC_ID": {"type": "varchar"},
                                "SEQ": {"type": "number"}
                            }
                        },
                        "on_pre_submit": "RH_ID_DOCUMENTOS",
                        "externalFilter": {
                            "templateMulti": {
                                "selector": "#employeeFilter",
                                "mandatory": ['RHID'],
                                "optional": []
                            }
                        },
                        "initialWhereClause": " CD_AGREGADO IS NULL",
                        "order_by": "NVL(DT_EMISSAO, TO_DATE('9999-12-31','YYYY-MM-DD')) DESC, CD_DOC_ID",
                        "recordBundle": 7,
                        "pageLenght": 7,
                        "scrollY": "234px",
                        "responsive": true,
                        "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
                        "inRowDoc": {
                            "domElementId":"#mydropzone",
                            "saveAsBlob": true, //BLOB
                            "embedded":{
                                "display": false, //true: Show DOC, false: Show Icon)
                                "dimensions":{ "x":220, "y":200}, //Just for images formats, defined on quadconfig.images_formats: ['JPG', 'JPEG', PNG', ...]
                                "watermark":false //PTE mandará select para obter a marca de água a aplicar se TRUE
                            },
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
                                "title": "", //Datatables
                                "label": "", //Editor
                                "data": 'RHID',
                                "name": 'RHID',
                                "exclude": !conf_CADASTRO['RH_ID_DOCUMENTOS']["rgpd"]["RHID"],
                                "type": "hidden",
                                "visible": false,
                            }, {
                                "title": "", //Datatables
                                "label": "", //Editor
                                "data": 'CD_DOC_ID',
                                "name": 'CD_DOC_ID',
                                "exclude": !conf_CADASTRO['RH_ID_DOCUMENTOS']["rgpd"]["CD_DOC_ID"],
                                "type": "hidden", //Editor
                                "visible": false, //DataTables 
                            }, {
                                "responsivePriority": 2,
                                "complexList": true,
                                "title": "<?php echo mb_strtoupper($ui_document,'UTF-8'); ?>",
                                "label": "<?php echo $ui_document; ?>",
                                "data": 'DSP_DOC_ID',
                                "name": 'DSP_DOC_ID',
                                "exclude": !conf_CADASTRO['RH_ID_DOCUMENTOS']["rgpd"]["CD_DOC_ID"],
                                "type": "select",
                                "className": "visibleColumn",
                                //"renew": true,                    
                                "attr": {
                                    "dependent-group": "DSP_DOC",
                                    "dependent-level": 1,
                                    "data-db-name": 'A.CD_DOC_ID',
                                    "decodeFromTable": 'DG_DOCUMENTOS A',
                                    "desigColumn": "A.DSP_DOC_ID",
                                    "orderBy": "A.CD_DOC_ID",
                                    "otherValues": "A.TP_DOCUMENTO", //RETURNS data['OTHERVALUES']
                                    "class": "form-control complexList chosen",
                                    //"disabled": true, //Permite inibir o campo no Editor
                                    "filter": {
                                        "create": " AND A.ACTIVO = 'S'", //On-New-Record
                                        "edit": " AND A.ACTIVO = 'S'", //On-Edit-Record
                                    }
                                }
                            }, {
                                "title": "<?php echo mb_strtoupper($ui_code,'UTF-8'); ?>",
                                "label": "<?php echo $ui_code; ?>",
                                "data": 'SEQ',
                                "name": 'SEQ',
                                "exclude": !conf_CADASTRO['RH_ID_DOCUMENTOS']["rgpd"]["SEQ"],
                                "type": "hidden", //Editor
                                "visible": false, //DataTables 
                                "datatype": 'sequence'
                            }, {
                                "responsivePriority": 3,
                                "title": "<?php echo mb_strtoupper($ui_document_num,'UTF-8'); ?>", //Datatables
                                "label": "<?php echo $ui_document_num; ?>", //Editor
                                "data": 'NR_DOCUMENTO',
                                "name": 'NR_DOCUMENTO',
                                "exclude": !conf_CADASTRO['RH_ID_DOCUMENTOS']["rgpd"]["NR_DOCUMENTO"],
                                "className": "visibleColumn",
                            }, {
                                "responsivePriority": 4,
                                "title": "<?php echo mb_strtoupper($ui_issuer,'UTF-8'); ?>", //Datatables
                                "label": "<?php echo $ui_issuer; ?>", //Editor
                                "data": 'EMISSOR',
                                "name": 'EMISSOR',
                                "exclude": !conf_CADASTRO['RH_ID_DOCUMENTOS']["rgpd"]["EMISSOR"],
                                "className": "visibleColumn",
                            }, {
                                "responsivePriority": 5,
                                "title": "<?php echo mb_strtoupper($ui_issuing_date,'UTF-8'); ?>", //Datatables
                                "label": "<?php echo $ui_issuing_date; ?>", //Editor
                                "data": 'DT_EMISSAO',
                                "name": 'DT_EMISSAO',
                                "exclude": !conf_CADASTRO['RH_ID_DOCUMENTOS']["rgpd"]["DT_EMISSAO"],
                                "datatype": 'date',
                                "def": hoje(),
                                "className": "visibleColumn",
                                "attr": {
                                    "class": "form-control datepicker"
                                }
                            }, {
                                "responsivePriority": 6,
                                "title": "<?php echo mb_strtoupper($ui_validity_date,'UTF-8'); ?>", //Datatables
                                "label": "<?php echo $ui_validity_date; ?>", //Editor
                                "data": 'DT_VALIDADE',
                                "name": 'DT_VALIDADE',
                                "exclude": !conf_CADASTRO['RH_ID_DOCUMENTOS']["rgpd"]["DT_VALIDADE"],
                                "datatype": 'date',
                                "className": "visibleColumn",
                                "attr": {
                                    "class": "form-control datepicker"
                                }
                            }, {
                                "responsivePriority": 7,
                                "title": "<?php echo mb_strtoupper($ui_document_short, 'UTF-8'); ?>", //Datatables
                                "label": "<?php echo $ui_document_short; ?>", //Editor
                                "data": 'LINK_DOC',
                                "name": 'LINK_DOC',
                                "className": "",
                                "type": "hidden",
                                "width": "1%",
                                "exclude": !conf_CADASTRO['RH_ID_DOCUMENTOS']["rgpd"]["LINK_DOC"],
                                "attr": {
                                    "name": 'LINK_DOC'
                                },
                                "render": function (val, type, row) {                          
                                    return RH_ID_DOCUMENTOS.getFileIcon(row['BD_MIME'], JSON.stringify(row));
                                }
                            }, {
                                "title": "<?php echo mb_strtoupper($ui_extention, 'UTF-8'); ?>" + '</span>', //Datatables
                                "label": "<?php echo $ui_extention; ?>", //Editor
                                "fieldInfo": "<?php echo $hint_file_format; ?>",
                                "data": 'BD_MIME',
                                "name": 'BD_MIME',
                                "exclude": !conf_CADASTRO['RH_ID_DOCUMENTOS']["rgpd"]["LINK_DOC"],
                                "className": "",
                                "type": "hidden",
                                "visible": false 
                            }, {
                                "title": 'BD_DOC',
                                "data": null,
                                "name": 'BD_DOC',
                                "type": "upload",
                                "exclude": !conf_CADASTRO['RH_ID_DOCUMENTOS']["rgpd"]["LINK_DOC"],
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
                                "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions,'UTF-8'); ?>" + '</span>',
                                "label": '',
                                "data": null,
                                "name": 'RECORD_HISTORY',
                                "type": "hidden",
                                "className": "none visibleColumn",
                                "render": function (val, type, row) {
                                    return tablesRecordHistory(val, type, row);
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
                                    //
                                    return RH_ID_DOCUMENTOS.crudButtons(conf_CADASTRO['RH_ID_DOCUMENTOS']["crud"][0], conf_CADASTRO['RH_ID_DOCUMENTOS']["crud"][1], conf_CADASTRO['RH_ID_DOCUMENTOS']["crud"][2]);
                                }
                            }
                        ],
                        "validations": {
                            "rules": {
                                "DSP_DOC_ID": {
                                    required: true,
                                    //valida_doc: true
                                },
                                "NR_DOCUMENTO": {
                                    required: true,
                                    maxlength: 20,
                                    valida_doc: true
                                },
                                "EMISSOR": {
                                    maxlength: 25
                                },
                                "DT_EMISSAO": {
                                    dateISO: true,
                                },
                                "DT_VALIDADE": {
                                    dateISO: true,
                                    dateEqOrNextThan: 'DT_EMISSAO',
                                }
                            },
                            //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                            "messages": {
                                "DT_VALIDADE": {
                                    dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                                }
                            }
                        }
                    };
                    RH_ID_DOCUMENTOS = new QuadTable();
                    RH_ID_DOCUMENTOS.initTable($.extend({}, datatable_instance_defaults, optionRH_ID_DOCUMENTOS));
                } else {
                    $('a[href="#Tab3_1"]').parent('li').remove();
                    $('#Tab3_1').remove();
                    
                    //Transfer "ACTIVE" class do AGREG>DOS
                    $('a[href="#Tab3_2"]').parent('li').addClass('active');
                    $('#Tab3_2').addClass('active');
                }
                //END Documentos

                //DECLARING LOCAL Validation RULES
                if (1 === 1) {
                    // 1. Validação do número de documento associado
                    $.validator.addMethod("valida_doc", function (value, element, param) {
                        var operacao = RH_ID_DOCUMENTOS.editor.s["action"], 
                            cd_pais = $("#xt_RHID", "#employeeFilter").children("option:selected")[0]['dataset']['othervalues'],
                            tp_doc = $("#DTE_Field_DSP_DOC_ID", "#RH_ID_DOCUMENTOS_editorForm").children("option:selected")[0]['dataset']['othervalues'],
                            nr_doc = $("#DTE_Field_NR_DOCUMENTO", "#RH_ID_DOCUMENTOS_editorForm").val(); 
                            
                        if (operacao !== 'query' && nr_doc !== '' && tp_doc !== '') {
                            return validaDocumento(tp_doc, cd_pais, nr_doc);
                        }
                        return true;
                    }, function (params, element) {
                        var ms = "<?php echo $error_invalid_doc_nr; ?>"
                        return ms;
                    });
                }
                //END DECLARING LOCAL Validation RULES


                //Agregado
                if ( conf_CADASTRO['RH_ID_AGREGADOS']["access"]) {
                    var optionRH_ID_AGREGADOS = {
                        "tableId": "RH_ID_AGREGADOS",
                        "table": "RH_ID_AGREGADOS",
                        "workFlow": conf_CADASTRO['RH_ID_AGREGADOS']["workflow"],
                        "selectRecordMsg": "<?php echo $ui_please_select_record .$ui_rhid_household; ?>",
                        "pk": {
                            "primary": {
                                "RHID": {"type": "number"},
                                "CD_AGREGADO": {"type": "varchar"}
                            }
                        },
                        "externalFilter": {
                            "templateMulti": {
                                "selector": "#employeeFilter",
                                "mandatory": ['RHID'],
                                "optional": []
                            }
                        },
        //                "crudOnMasterInactive": {
        //                    "condition": "data.DT_DEMISSAO !== null",
        //                    "acl": {
        //                        "create": false,
        //                        "update": false,
        //                        "delete": false
        //                    }
        //                }, //,
                        "detailsObjects": ['RH_ID_DOCUMENTOS_AGREGADO'],
                        //"initialWhereClause": "",
                        "order_by": "RHID, CD_AGREGADO",
                        "recordBundle": 5,
                        "pageLenght": 5,
                        "scrollY": "117",
                        "responsive": true,
                        "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
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
                                "data": 'RHID',
                                "name": 'RHID',
                                "exclude": !conf_CADASTRO['RH_ID_AGREGADOS']["rgpd"]["RHID"],
                                "type": "hidden",
                                "visible": false,  
                            }, {
                                "title": "<?php echo mb_strtoupper($ui_code,'UTF-8'); ?>",
                                "label": "<?php echo $ui_code; ?>",
                                "data": 'CD_AGREGADO',
                                "name": 'CD_AGREGADO',
                                "exclude": !conf_CADASTRO['RH_ID_AGREGADOS']["rgpd"]["CD_AGREGADO"],
                                "type": "hidden",
                                "datatype": 'sequence',
                                "attr": {
                                    "style": "width: 20%;",
                                }
                            }, {
                                "responsivePriority": 2,
                                "title": "<?php echo mb_strtoupper($ui_name,'UTF-8'); ?>",
                                "label": "<?php echo $ui_name; ?>",
                                "data": 'NOME_AGREGADO',
                                "name": 'NOME_AGREGADO',
                                "exclude": !conf_CADASTRO['RH_ID_AGREGADOS']["rgpd"]["NOME_AGREGADO"],
                                "className": "visibleColumn",
                            }, {
                                "responsivePriority": 3,
                                "title": "<?php echo mb_strtoupper($ui_birthdate_short,'UTF-8'); ?>", //Datatables
                                "label": "<?php echo $ui_birthdate_short; ?>", //Editor
                                "data": 'DT_NASCIMENTO',
                                "name": 'DT_NASCIMENTO',
                                "exclude": !conf_CADASTRO['RH_ID_AGREGADOS']["rgpd"]["DT_NASCIMENTO"],
                                "datatype": 'date',
                                "className": "visibleColumn",
                                "attr": {
                                    "class": "datepicker"
                                }
                            }, {
                                "responsivePriority": 4,
                                "title": "<?php echo mb_strtoupper($ui_age,'UTF-8'); ?>",
                                "name": 'AGE',
                                "data": null,
                                "exclude": !conf_CADASTRO['RH_ID_AGREGADOS']["rgpd"]["DT_NASCIMENTO"], //DOES THIS WORK ????
                                "type": "hidden",
                                "className": "control toRight",
                                "width": "1%",
                                "render": function (val, type, row) {
                                    var age_ = '';
                                    if (row['DT_NASCIMENTO'] !== '') {
                                        age_ = getAge(row['DT_NASCIMENTO']);
                                    }
                                    return age_;
                                }
                            }, {
                                "responsivePriority": 5,
                                "title": "<?php echo mb_strtoupper($ui_gender,'UTF-8'); ?>", //Datatables
                                "label": "<?php echo $ui_gender; ?>", //Editor
                                "data": 'GENERO',
                                "name": 'GENERO',
                                "exclude": !conf_CADASTRO['RH_ID_AGREGADOS']["rgpd"]["GENERO"],
                                "type": "select",
                                "className": "visibleColumn",
                                "attr": {
                                    "domain-list": true,
                                    "dependent-group": 'RH_IDENTIFICACOES.GENERO',
                                    "class": "form-control"
                                },
                                "render": function (val, type, row) {
                                    if (val != null) {
                                        var o = _.find(initApp.joinsData['RH_IDENTIFICACOES.GENERO'], {'RV_LOW_VALUE': val});
                                        return val == null ? null : o['RV_MEANING'];
                                    }
                                    return val;
                                }
                            }, {
                                "responsivePriority": 6,
                                "title": "<?php echo mb_strtoupper($ui_kinship,'UTF-8'); ?>", //Datatables
                                "label": "<?php echo $ui_kinship; ?>", //Editor
                                "data": 'GRAU_PARENTESCO',
                                "name": 'GRAU_PARENTESCO',
                                "exclude": !conf_CADASTRO['RH_ID_AGREGADOS']["rgpd"]["GRAU_PARENTESCO"],
                                "type": "select",
                                "className": "visibleColumn",
                                "attr": {
                                    "domain-list": true,
                                    "dependent-group": 'RH_GRAU_PARENTESCO',
                                    "class": "form-control"
                                },
                                "render": function (val, type, row) {
                                    if (val != null) {
                                        var o = _.find(initApp.joinsData['RH_GRAU_PARENTESCO'], {'RV_LOW_VALUE': val});
                                        return val == null ? null : o['RV_MEANING'];
                                    }
                                    return val;
                                }
                            }, {
                                "responsivePriority": 7,
                                "title": "<?php echo mb_strtoupper($ui_disability_degree_short,'UTF-8'); ?>", //Datatables
                                "label": "<?php echo $ui_disability_degree_short; ?>", //Editor
                                "data": 'GRAU_DEFICIENCIA',
                                "name": 'GRAU_DEFICIENCIA',
                                "exclude": !conf_CADASTRO['RH_ID_AGREGADOS']["rgpd"]["GRAU_DEFICIENCIA"],
                                "def": 'Z',
                                "type": "select",
                                "className": "visibleColumn",
                                "attr": {
                                    "domain-list": true,
                                    "dependent-group": 'RH_ID_RETRIBUTIVOS.GRAU_DEFICIENCIA',
                                    "class": "form-control"
                                },
                                "render": function (val, type, row) {
                                    if (val != null) {
                                        var o = _.find(initApp.joinsData['RH_ID_RETRIBUTIVOS.GRAU_DEFICIENCIA'], {'RV_LOW_VALUE': val});
                                        return val == null ? null : o['RV_MEANING'];
                                    }
                                    return val;
                                }
                            }, {
                                "responsivePriority": 8,
                                "title": "<?php echo mb_strtoupper($ui_subsidies,'UTF-8'); ?>", //Datatables
                                "label": "<?php echo $ui_subsidies; ?>", //Editor
                                "data": 'SUBSIDIOS',
                                "name": 'SUBSIDIOS',
                                "exclude": !conf_CADASTRO['RH_ID_AGREGADOS']["rgpd"]["SUBSIDIOS"],
                                "type": "select",
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
                                "responsivePriority": 9,
                                "title": "<?php echo mb_strtoupper($ui_cirs,'UTF-8'); ?>", //Datatables
                                "label": "<?php echo $ui_cirs; ?>", //Editor
                                "data": 'IRS',
                                "name": 'IRS',
                                "exclude": !conf_CADASTRO['RH_ID_AGREGADOS']["rgpd"]["IRS"],
                                "def": 'N',
                                "type": "select",
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
                                "responsivePriority": 10,
                                "title": "<?php echo mb_strtoupper($ui_health_insurance_short,'UTF-8'); ?>", //Datatables
                                "label": "<?php echo $ui_health_insurance_short; ?>", //Editor
                                "data": 'SAUDE',
                                "name": 'SAUDE',
                                "exclude": !conf_CADASTRO['RH_ID_AGREGADOS']["rgpd"]["SAUDE"],
                                "type": "select",
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
                                "responsivePriority": 11,
                                "title": "<?php echo mb_strtoupper($ui_co_participation,'UTF-8'); ?>", //Datatables
                                "label": "<?php echo $ui_co_participation; ?>", //Editor
                                "data": 'COMPARTICIPACOES',
                                "name": 'COMPARTICIPACOES',
                                "exclude": !conf_CADASTRO['RH_ID_AGREGADOS']["rgpd"]["COMPARTICIPACOES"],
                                "type": "select",
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
                                "responsivePriority": 11,
                                "title": "<?php echo mb_strtoupper($ui_family_allowance_short,'UTF-8'); ?>", //Datatables
                                "label": "<?php echo $ui_family_allowance_short; ?>", //Editor
                                "data": 'ABONO_FAMILIA',
                                "name": 'ABONO_FAMILIA',
                                "exclude": !conf_CADASTRO['RH_ID_AGREGADOS']["rgpd"]["ABONO_FAMILIA"],
                                "type": "select",
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
                                "title": "", //Datatables
                                "label": "", //Editor
                                "data": 'RHID_ID_AGREGADO',
                                "name": 'RHID_ID_AGREGADO',
                                "exclude": !conf_CADASTRO['RH_ID_AGREGADOS']["rgpd"]["RHID_ID_AGREGADO"],
                                "type": "hidden",
                                "visible": false,
                                "className": "",
                            }, {
                                "complexList": true,
                                "title": "<?php echo mb_strtoupper($ui_name . '<sup> (RHID)</sup>','UTF-8'); ?>",
                                "label": "<?php echo $ui_name .'<sup> (RHID)</sup>'; ?>",
                                "fieldInfo": "<?php echo $hint_household_as_employee; ?>",
                                "data": 'DSP_NOME_AGREGADO',
                                "name": 'DSP_NOME_AGREGADO',
                                "exclude": !conf_CADASTRO['RH_ID_AGREGADOS']["rgpd"]["RHID_ID_AGREGADO"],
                                "type": "select",
                                "className": "none visibleColumn",
                                //"renew": true,
                                "attr": {
                                    "deferred": true,
                                    "dependent-group": "SITUACOES",
                                    "dependent-level": 1,
                                    "data-db-name": "A.RHID",
                                    "distribute-value": "RHID_ID_AGREGADO",
                                    "decodeFromTable": "QUAD_PEOPLE A",
                                    "desigColumn": "CONCAT(CONCAT(A.RHID,'-'),A.NOME)",
                                    "orderBy": "A.NOME_REDZ",
                                    "class": "form-control complexList chosen",
                                    "filter": {
                                        "create": " AND A.RHID != ':RHID'",
                                        "edit": " AND A.RHID != ':RHID'",
                                    }
                                }
                            }, {
                                "title": "", //Datatables
                                "label": "", //Editor
                                "data": 'CD_HAB_LIT',
                                "name": 'CD_HAB_LIT',
                                "exclude": !conf_CADASTRO['RH_ID_AGREGADOS']["rgpd"]["CD_HAB_LIT"],
                                "type": "hidden", //Editor
                                "visible": false, //DataTables
                            }, {
                                "complexList": true,
                                "title": "<?php echo mb_strtoupper($ui_academic_qualifications,'UTF-8'); ?>",
                                "label": "<?php echo $ui_academic_qualification; ?>",
                                "data": 'DSP_HAB_LIT',
                                "name": 'DSP_HAB_LIT',
                                "exclude": !conf_CADASTRO['RH_ID_AGREGADOS']["rgpd"]["CD_HAB_LIT"],
                                "type": "select",
                                "className": "none visibleColumn",
                                //"renew": true,
                                "attr": {
                                    "dependent-group": "HABS_LIT",
                                    "dependent-level": 1,
                                    "data-db-name": 'A.CD_HAB_LIT',
                                    //"distribute-value": '',
                                    "decodeFromTable": 'RH_DEF_HAB_LITERARIAS A',
                                    "desigColumn": "CONCAT(CONCAT(A.CD_HAB_LIT,'-'),A.DSP_HAB_LIT)",
                                    "orderBy": "A.CD_HAB_LIT",
                                    "class": "form-control complexList chosen",
                                    //"disabled": true, //Permite inibir o campo no Editor
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
                                "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions,'UTF-8'); ?>" + '</span>',
                                "label": '',
                                "data": null,
                                "name": 'RECORD_HISTORY',
                                "type": "hidden",
                                "className": "none visibleColumn",
                                "render": function (val, type, row) {
                                    return tablesRecordHistory(val, type, row);
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
                                    //
                                    return RH_ID_AGREGADOS.crudButtons(conf_CADASTRO['RH_ID_AGREGADOS']["crud"][0], conf_CADASTRO['RH_ID_AGREGADOS']["crud"][1], conf_CADASTRO['RH_ID_AGREGADOS']["crud"][2]);
                                }
                            }
                        ],
                        "validations": {
                            "rules": {
                                "NOME_AGREGADO": {
                                    required: true,
                                    maxlength: 80
                                },
                                "DT_NASCIMENTO": {
                                    required: true,
                                    dateISO: true
                                },
                                "GENERO": {
                                    required: true
                                },
                                "GRAU_PARENTESCO": {
                                    required: true,
                                    irs_agreg: true
                                },
                                "GRAU_DEFICIENCIA": {
                                    irs_agreg: true
                                },
                                "IRS": {
                                    required: true,
                                    irs_agreg: true
                                },
                                "SUBSIDIOS": {
                                    required: true
                                },
                                "COMPARTICIPACOES": {
                                    required: true
                                },
                                "SAUDE": {
                                    required: true
                                },
                                "ABONO_FAMILIA": {
                                    required: true
                                }
                            }
                        }
                    };
                    RH_ID_AGREGADOS = new QuadTable();
                    RH_ID_AGREGADOS.initTable($.extend({}, datatable_instance_defaults, optionRH_ID_AGREGADOS));
                    
                    //DECLARING LOCAL Validation RULES
                    if (1 === 1) {
                        // 1. Validação do número de documento associado
                        $.validator.addMethod("irs_agreg", function (value, element, param) {
                            var operacao = RH_ID_AGREGADOS.editor.s["action"], 
                                cd_pais = $("#xt_RHID", "#employeeFilter").children("option:selected")[0]['dataset']['othervalues'],
                                grau_parent = $("#DTE_Field_GRAU_PARENTESCO", "#RH_ID_AGREGADOS_editorForm").val(),
                                grau_defic = $("#DTE_Field_GRAU_DEFICIENCIA", "#RH_ID_AGREGADOS_editorForm").val(),
                                irs_field = $("#DTE_Field_IRS", "#RH_ID_AGREGADOS_editorForm"); 

                            if (grau_parent !== '' && grau_defic !== '' && irs_field.val() !== '') {
                                irs_field.prop( "disabled",false);
                                
                                // só permite IRS = S para conjuge, se o mesmo for deficiente
                                if (grau_parent === 'C' && grau_defic !== 'Z' && irs_field.val() !== 'N') {
                                    irs_field.val("N");
                                    irs_field.prop( "disabled",true);
                                }
                                // noutros graus de parentesco que não (D - Adotado, E - Enteado, F - Filho) => IRS = N
                                else if (grau_parent !== 'D' && grau_parent !== 'E' && grau_parent !== 'F' && irs_field.val() === 'S') {
                                        irs_field.val("N");
                                        irs_field.prop( "disabled",true);
                                }
                            } else {
                                irs_field.val("N");
                                irs_field.prop( "disabled",true);
                            }
                            return true;
                        }, function (params, element) {
                            return true;
                        });
                    }
                    //END DECLARING LOCAL Validation RULES
                    
                    //Documentos Agregado
                    var optionRH_ID_DOCUMENTOS_AGREGADO = {
                        "tableId": "RH_ID_DOCUMENTOS_AGREGADO",
                        "table": "RH_ID_DOCUMENTOS",
                        "on_pre_submit": "RH_ID_DOCUMENTOS_AGREGADO",
                        "workFlow": conf_CADASTRO['RH_ID_AGREGADOS']["workflow"],
                        "pk": {
                            "primary": {
                                "RHID": {"type": "number"},
                                "CD_AGREGADO": {"type": "varchar"},
                                "CD_DOC_ID": {"type": "varchar"},
                                "SEQ": {"type": "number"}
                            }
                        },
                        "dependsOn": {
                            "RH_ID_AGREGADOS": {
                                "RHID": "RHID",
                                "CD_AGREGADO": "CD_AGREGADO"
                            }
                        },
                        //"initialWhereClause": "",
                        "order_by": "NVL(DT_EMISSAO, TO_DATE('9999-12-31','YYYY-MM-DD')) DESC, CD_DOC_ID",
                        "recordBundle": 4,
                        "pageLenght": 4,
                        "scrollY": "117",
                        "responsive": true,
                        "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
                        "inRowDoc": {
                            "domElementId":"#mydropzone",
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
                                "title": "", //Datatables
                                "label": "", //Editor
                                "data": 'RHID',
                                "name": 'RHID',
                                "exclude": !conf_CADASTRO['RH_ID_DOCUMENTOS']["rgpd"]["RHID"],
                                "type": "hidden",
                                "visible": false,
                            }, {
                                "title": "", //Datatables
                                "label": "", //Editor
                                "data": 'CD_AGREGADO',
                                "name": 'CD_AGREGADO',
                                "exclude": !conf_CADASTRO['RH_ID_DOCUMENTOS']["rgpd"]["CD_AGREGADO"],
                                "type": "hidden",
                                "visible": false,
                                "className": "",
                            }, {
                                "title": "", //Datatables
                                "label": "", //Editor
                                "data": 'CD_DOC_ID',
                                "name": 'CD_DOC_ID',
                                "exclude": !conf_CADASTRO['RH_ID_DOCUMENTOS']["rgpd"]["CD_DOC_ID"],
                                "type": "hidden", //Editor
                                "visible": false, //DataTables 
                            }, {
                                "responsivePriority": 2,
                                "complexList": true,
                                "title": "<?php echo mb_strtoupper($ui_document,'UTF-8'); ?>",
                                "label": "<?php echo $ui_document; ?>",
                                "data": 'DSP_DOC_ID',
                                "name": 'DSP_DOC_ID',
                                "exclude": !conf_CADASTRO['RH_ID_DOCUMENTOS']["rgpd"]["CD_DOC_ID"],
                                "type": "select",
                                "className": "visibleColumn",
                                //"renew": true,                    
                                "attr": {
                                    "dependent-group": "DSP_DOC",
                                    "dependent-level": 1,
                                    "data-db-name": 'A.CD_DOC_ID',
                                    "decodeFromTable": 'DG_DOCUMENTOS A',
                                    "desigColumn": "A.DSP_DOC_ID",
                                    "orderBy": "A.CD_DOC_ID",
                                    "otherValues": "A.TP_DOCUMENTO", //RETURNS data['OTHERVALUES']
                                    "class": "form-control complexList chosen",
                                    //"disabled": true, //Permite inibir o campo no Editor
                                    "filter": {
                                        "create": " AND A.ATIVO = 'S'", //On-New-Record
                                        "edit": " AND A.ATIVO = 'S'", //On-Edit-Record
                                    }
                                }
                            }, {
                                "title": "<?php echo mb_strtoupper($ui_code,'UTF-8'); ?>",
                                "label": "<?php echo $ui_code; ?>",
                                "data": 'SEQ',
                                "name": 'SEQ',
                                "exclude": !conf_CADASTRO['RH_ID_DOCUMENTOS']["rgpd"]["SEQ"],
                                "type": "hidden", //Editor
                                "visible": false, //DataTables 
                                "datatype": 'sequence'
                            }, {
                                "responsivePriority": 3,
                                "title": "<?php echo mb_strtoupper($ui_document_num,'UTF-8'); ?>", //Datatables
                                "label": "<?php echo $ui_document_num; ?>", //Editor
                                "data": 'NR_DOCUMENTO',
                                "name": 'NR_DOCUMENTO',
                                "exclude": !conf_CADASTRO['RH_ID_DOCUMENTOS']["rgpd"]["NR_DOCUMENTO"],
                                "className": "visibleColumn",
                            }, {
                                "responsivePriority": 4,
                                "title": "<?php echo mb_strtoupper($ui_issuer,'UTF-8'); ?>", //Datatables
                                "label": "<?php echo $ui_issuer; ?>", //Editor
                                "data": 'EMISSOR',
                                "name": 'EMISSOR',
                                "exclude": !conf_CADASTRO['RH_ID_DOCUMENTOS']["rgpd"]["EMISSOR"],
                                "className": "visibleColumn",
                            }, {
                                "responsivePriority": 5,
                                "title": "<?php echo mb_strtoupper($ui_issuing_date,'UTF-8'); ?>", //Datatables
                                "label": "<?php echo $ui_issuing_date; ?>", //Editor
                                "data": 'DT_EMISSAO',
                                "name": 'DT_EMISSAO',
                                "exclude": !conf_CADASTRO['RH_ID_DOCUMENTOS']["rgpd"]["DT_EMISSAO"],
                                "datatype": 'date',
                                "def": hoje(),
                                "className": "visibleColumn",
                                "attr": {
                                    "class": "form-control datepicker"
                                }
                            }, {
                                "responsivePriority": 6,
                                "title": "<?php echo mb_strtoupper($ui_validity_date,'UTF-8'); ?>", //Datatables
                                "label": "<?php echo $ui_validity_date; ?>", //Editor
                                "data": 'DT_VALIDADE',
                                "name": 'DT_VALIDADE',
                                "exclude": !conf_CADASTRO['RH_ID_DOCUMENTOS']["rgpd"]["DT_VALIDADE"],
                                "datatype": 'date',
                                "def": hoje(),
                                "className": "visibleColumn",
                                "attr": {
                                    "class": "form-control datepicker"
                                }
                            }, {
                                "responsivePriority": 7,
                                "title": "<?php echo mb_strtoupper($ui_document_short, 'UTF-8'); ?>", //Datatables
                                "label": "<?php echo $ui_document_short; ?>", //Editor
                                "data": 'LINK_DOC',
                                "name": 'LINK_DOC',
                                "className": "",
                                "type": "hidden",
                                "width": "1%",
                                "exclude": !conf_CADASTRO['RH_ID_DOCUMENTOS']["rgpd"]["LINK_DOC"],
                                "attr": {
                                    "name": 'LINK_DOC'
                                },
                                "render": function (val, type, row) {                          
                                    return RH_ID_DOCUMENTOS_AGREGADO.getFileIcon(row['BD_MIME'], JSON.stringify(row));
                                }
                            }, {
                                "title": "<?php echo mb_strtoupper($ui_extention, 'UTF-8'); ?>" + '</span>', //Datatables
                                "label": "<?php echo $ui_extention; ?>", //Editor
                                "fieldInfo": "<?php echo $hint_file_format; ?>",
                                "data": 'BD_MIME',
                                "name": 'BD_MIME',
                                "exclude": !conf_CADASTRO['RH_ID_DOCUMENTOS']["rgpd"]["LINK_DOC"],
                                "className": "",
                                "type": "hidden",
                                "visible": false 
                            }, {
                                "title": 'BD_DOC',
                                "data": null,
                                "name": 'BD_DOC',
                                "type": "upload",
                                "exclude": !conf_CADASTRO['RH_ID_DOCUMENTOS']["rgpd"]["LINK_DOC"],
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
                                "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions,'UTF-8'); ?>" + '</span>',
                                "label": '',
                                "data": null,
                                "name": 'RECORD_HISTORY',
                                "type": "hidden",
                                "className": "none visibleColumn",
                                "render": function (val, type, row) {
                                    return tablesRecordHistory(val, type, row);
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
                                    //
                                    return RH_ID_DOCUMENTOS_AGREGADO.crudButtons(conf_CADASTRO['RH_ID_AGREGADOS']["crud"][0], conf_CADASTRO['RH_ID_AGREGADOS']["crud"][1], conf_CADASTRO['RH_ID_AGREGADOS']["crud"][2]);

                                }
                            }
                        ],
                        "validations": {
                            "rules": {
                                "DSP_DOC_ID": {
                                    required: true,
                                },
                                "NR_DOCUMENTO": {
                                    required: true,
                                    maxlength: 20,
                                    valida_doc_agreg: true
                                },
                                "EMISSOR": {
                                    maxlength: 25
                                },
                                "DT_EMISSAO": {
                                    dateISO: true,
                                },
                                "DT_VALIDADE": {
                                    dateISO: true,
                                    dateEqOrNextThan: 'DT_EMISSAO',
                                }
                            },
                            //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                            "messages": {
                                "DT_VALIDADE": {
                                    dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                                }
                            }
                        }
                    };
                    RH_ID_DOCUMENTOS_AGREGADO = new QuadTable();
                    RH_ID_DOCUMENTOS_AGREGADO.initTable($.extend({}, datatable_instance_defaults, optionRH_ID_DOCUMENTOS_AGREGADO));
                    //END Documentos Agregado
                } else {
                    $('a[href="#Tab3_2"]').remove();
                    $('#Tab3_2').remove();                
                }
                //END Agregado
            }
            //DECLARING LOCAL Validation RULES
            if (1 === 1) {
                // 1. Validação do número de documento associado
                $.validator.addMethod("valida_doc_agreg", function (value, element, param) {
                    var operacao = RH_ID_DOCUMENTOS_AGREGADO.editor.s["action"], 
                        cd_pais = $("#xt_RHID", "#employeeFilter").children("option:selected")[0]['dataset']['othervalues'],
                        tp_doc = $("#DTE_Field_DSP_DOC_ID", "#RH_ID_DOCUMENTOS_AGREGADO_editorForm").children("option:selected")[0]['dataset']['othervalues'],
                        nr_doc = $("#DTE_Field_NR_DOCUMENTO", "#RH_ID_DOCUMENTOS_AGREGADO_editorForm").val(); 

                    if (operacao !== 'query' && nr_doc !== '' && tp_doc !== '') {
                        return validaDocumento(tp_doc, cd_pais, nr_doc);
                    }
                    return true;
                }, function (params, element) {
                    var ms = "<?php echo $error_invalid_doc_nr; ?>"
                    return ms;
                });
            }
            //END DECLARING LOCAL Validation RULES
            //END Docs. / Agregado TAB
            
            //Habilitações TAB
            if  ( !conf_CADASTRO['RH_ID_HAB_LITERARIAS']["access"] && !conf_CADASTRO['RH_ID_HABS_PROFISSIONAIS']["access"] ) {
                //REMOVE HMTL
                $('a[href="#Tab6"]').remove();
                $('#Tab6').remove();
            } else {
                //Habs. Literárias
                if ( conf_CADASTRO['RH_ID_HAB_LITERARIAS']["access"] ) {
                    var optionRH_ID_HAB_LITERARIAS = {
                        "tableId": "RH_ID_HAB_LITERARIAS",
                        "table": "RH_ID_HAB_LITERARIAS",
                        "workFlow": conf_CADASTRO['RH_ID_HAB_LITERARIAS']["workflow"],
                        "pk": {
                            "primary": {
                                "RHID": {"type": "number"},
                                "CD_HAB_LIT": {"type": "varchar"},
                                "DT_INI": {"type": "date"}
                            }
                        },
                        "on_pre_submit": "RH_ID_HAB_LITERARIAS",
                        "externalFilter": {
                            "templateMulti": {
                                "selector": "#employeeFilter",
                                "mandatory": ['RHID'],
                                "optional": []
                            }
                        },
                        "order_by": "DT_INI DESC",
                        "recordBundle": 7,
                        "pageLenght": 7,
                        "scrollY": "234px",
                        "responsive": true,
                        "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
                        "inRowDoc": {
                            "domElementId":"#mydropzone",
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
                                "title": "", //Datatables
                                "label": "", //Editor
                                "data": 'RHID',
                                "name": 'RHID',
                                "exclude": !conf_CADASTRO['RH_ID_HAB_LITERARIAS']["rgpd"]["RHID"],
                                "type": "hidden",
                                "visible": false
                            }, {
                                "title": "", //Datatables
                                "label": "", //Editor
                                "data": 'CD_HAB_LIT',
                                "name": 'CD_HAB_LIT',
                                "exclude": !conf_CADASTRO['RH_ID_HAB_LITERARIAS']["rgpd"]["CD_HAB_LIT"],
                                "type": "hidden",
                                "visible": false
                            }, {
                                "responsivePriority": 2,
                                "complexList": true,
                                "title": "<?php echo mb_strtoupper($ui_qualification_2,'UTF-8'); ?>",
                                "label": "<?php echo $ui_qualification_2; ?>",
                                "data": 'DSP_HAB_LIT',
                                "name": 'DSP_HAB_LIT',
                                "exclude": !conf_CADASTRO['RH_ID_HAB_LITERARIAS']["rgpd"]["CD_HAB_LIT"],
                                "type": "select",
                                "className": "visibleColumn",
                                //"renew": true,
                                "attr": {
                                    "dependent-group": "HAB_LIT",
                                    "dependent-level": 1,
                                    "data-db-name": "A.CD_HAB_LIT",
                                    "decodeFromTable": "RH_DEF_HAB_LITERARIAS A",  //TO CHANGE ON QUAD-HCM
                                    "desigColumn": "CONCAT(CONCAT(A.CD_HAB_LIT,'-'),A.DSP_HAB_LIT)",
                                    "orderBy": "A.CD_HAB_LIT",
                                    "class": "form-control complexList chosen"
                                }
                            }, {
                                "responsivePriority": 3,
                                "title": "<?php echo mb_strtoupper($ui_RU_short,'UTF-8'); ?>", //Datatables
                                "label": "<?php echo $ui_RU_short; ?>", //Editor
                                "fieldInfo": "<?php echo $ui_relatorio_unico; ?>",
                                "data": 'RU',
                                "name": 'RU',
                                "exclude": !conf_CADASTRO['RH_ID_HAB_LITERARIAS']["rgpd"]["RU"],
                                "type": "select",
                                "def": "N",
                                "className": "visibleColumn",
                                "attr": {
                                    "domain-list": true,
                                    "dependent-group": 'DG_SIM_NAO',
                                    "class": "form-control"
                                }
                            }, {
                                "responsivePriority": 4,
                                "title": "<?php echo mb_strtoupper($ui_education_institution,'UTF-8'); ?>", //Datatables
                                "label": "<?php echo $ui_education_institution; ?>", //Editor
                                "data": 'INSTITUICAO',
                                "name": 'INSTITUICAO',
                                "exclude": !conf_CADASTRO['RH_ID_HAB_LITERARIAS']["rgpd"]["INSTITUICAO"],
                                "type": "select",
                                "def": "N",
                                "className": "visibleColumn",
                                "attr": {
                                    "domain-list": true,
                                    "dependent-group": 'RH_INSTITUICOES',
                                    "class": "form-control chosen"
                                }
                            }, {
                                "responsivePriority": 5,
                                "title": "<?php echo mb_strtoupper($ui_begin_date,'UTF-8'); ?>", //Datatables
                                "label": "<?php echo $ui_begin_date; ?>", //Editor
                                "data": 'DT_INI',
                                "name": 'DT_INI',
                                "exclude": !conf_CADASTRO['RH_ID_HAB_LITERARIAS']["rgpd"]["DT_INI"],
                                "datatype": 'date',
                                "className": "visibleColumn",
                                "attr": {
                                    "class": "form-control datepicker"
                                }
                            }, {
                                "responsivePriority": 6,
                                "title": "<?php echo mb_strtoupper($ui_validity_date,'UTF-8'); ?>", //Datatables
                                "label": "<?php echo $ui_validity_date; ?>", //Editor
                                "data": 'DT_FIM_VALIDADE',
                                "name": 'DT_FIM_VALIDADE',
                                "exclude": !conf_CADASTRO['RH_ID_HAB_LITERARIAS']["rgpd"]["DT_FIM_VALIDADE"],
                                "datatype": 'date',
                                "className": "visibleColumn",
                                "attr": {
                                    "class": "form-control datepicker"
                                }
                            }, {
                                "responsivePriority": 7,
                                "title": "<?php echo mb_strtoupper($ui_end_date,'UTF-8'); ?>", //Datatables
                                "label": "<?php echo $ui_end_date; ?>", //Editor
                                "data": 'DT_FIM',
                                "name": 'DT_FIM',
                                "exclude": !conf_CADASTRO['RH_ID_HAB_LITERARIAS']["rgpd"]["DT_FIM"],
                                "datatype": 'date',
                                "className": "visibleColumn",
                                "attr": {
                                    "class": "form-control datepicker"
                                }
                            }, {
                                "title": "<?php echo mb_strtoupper($ui_study_area,'UTF-8'); ?>", //Datatables
                                "label": "<?php echo $ui_study_area; ?>", //Editor
                                "data": 'AREA_ESTUDO',
                                "name": 'AREA_ESTUDO',
                                "exclude": !conf_CADASTRO['RH_ID_HAB_LITERARIAS']["rgpd"]["AREA_ESTUDO"],
                                "type": "select",
                                "className": "none visibleColumn",
                                "attr": {
                                    "domain-list": true,
                                    "dependent-group": 'RH_AREA_ESTUDO',
                                    "class": "form-control chosen"
                                }
                            }, {
                                "title": "<?php echo mb_strtoupper($ui_academic_degree,'UTF-8'); ?>", //Datatables
                                "label": "<?php echo $ui_academic_degree; ?>", //Editor
                                "data": 'GRAU_ACADEMICO',
                                "name": 'GRAU_ACADEMICO',
                                "exclude": !conf_CADASTRO['RH_ID_HAB_LITERARIAS']["rgpd"]["GRAU_ACADEMICO"],
                                "type": "select",
                                "className": "none visibleColumn",
                                "attr": {
                                    "domain-list": true,
                                    "dependent-group": 'RH_GRAU_ACADEMICO',
                                    "class": "form-control chosen"
                                }
                            }, {
                                "title": "<?php echo mb_strtoupper($ui_description,'UTF-8'); ?>", //Datatables
                                "label": "<?php echo $ui_description; ?>", //Editor
                                "data": 'DESCRICAO',
                                "name": 'DESCRICAO',
                                "exclude": !conf_CADASTRO['RH_ID_HAB_LITERARIAS']["rgpd"]["DESCRICAO"],
                                "type": 'textarea', //Editor
                                "className": "none visibleColumn",
                                "attr": {
                                    "style": "max-width: 355px",
                                    "class": "form-control len-355"
                                }
                            }, {
                                "responsivePriority": 8,
                                "title": "<?php echo mb_strtoupper($ui_document_short, 'UTF-8'); ?>", //Datatables
                                "label": "<?php echo $ui_document_short; ?>", //Editor
                                "data": 'LINK_DOC',
                                "name": 'LINK_DOC',
                                "className": "",
                                "type": "hidden",
                                "width": "1%",
                                "exclude": !conf_CADASTRO['RH_ID_HAB_LITERARIAS']["rgpd"]["LINK_DOC"],
                                "attr": {
                                    "name": 'LINK_DOC'
                                },
                                "render": function (val, type, row) {                          
                                    return RH_ID_HAB_LITERARIAS.getFileIcon(row['BD_MIME'], JSON.stringify(row));
                                }
                            }, {
                                "title": "<?php echo mb_strtoupper($ui_extention, 'UTF-8'); ?>" + '</span>', //Datatables
                                "label": "<?php echo $ui_extention; ?>", //Editor
                                "fieldInfo": "<?php echo $hint_file_format; ?>",
                                "data": 'BD_MIME',
                                "name": 'BD_MIME',
                                "exclude": !conf_CADASTRO['RH_ID_HAB_LITERARIAS']["rgpd"]["LINK_DOC"],
                                "className": "",
                                "type": "hidden",
                                "visible": false 
                            }, {
                                "title": 'BD_DOC',
                                "data": null,
                                "name": 'BD_DOC',
                                "type": "upload",
                                "exclude": !conf_CADASTRO['RH_ID_HAB_LITERARIAS']["rgpd"]["LINK_DOC"],
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
                                "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions,'UTF-8'); ?>" + '</span>',
                                "label": '',
                                "data": null,
                                "name": 'RECORD_HISTORY',
                                "type": "hidden",
                                "className": "none visibleColumn",
                                "render": function (val, type, row) {
                                    return tablesRecordHistory(val, type, row);
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
                                    //
                                    return RH_ID_HAB_LITERARIAS.crudButtons(conf_CADASTRO['RH_ID_HAB_LITERARIAS']["crud"][0], conf_CADASTRO['RH_ID_HAB_LITERARIAS']["crud"][1], conf_CADASTRO['RH_ID_HAB_LITERARIAS']["crud"][2]);
                                }
                            }
                        ],
                        "validations": {
                            "rules": {
                                "DSP_HAB_LIT": {
                                    required: true,
                                },
                                "RU": {
                                    required: true
                                },
                                "DESCRICAO": {
                                    maxlength: 4000
                                },
                                "DT_INI": {
                                    required: true,
                                    dateISO: true
                                },
                                "DT_FIM": {
                                    dateISO: true,
                                    dateEqOrNextThan: 'DT_INI'
                                },
                                "DT_FIM_VALIDADE": {
                                    dateISO: true,
                                    dateEqOrNextThan: 'DT_INI'
                                }
                            },
                            //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                            "messages": {
                                "DT_FIM": {
                                    dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                                },
                                "DT_FIM_VALIDADE": {
                                    dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                                }
                            }
                        }
                    };
                    RH_ID_HAB_LITERARIAS = new QuadTable();
                    RH_ID_HAB_LITERARIAS.initTable($.extend({}, datatable_instance_defaults, optionRH_ID_HAB_LITERARIAS));
                } else {
                    $('#wid-6_1').closest('article').remove();
                }
                //END Habs. Literárias            

                //Habs. Profissionais
                if ( conf_CADASTRO['RH_ID_HABS_PROFISSIONAIS']["access"] ) {
                    var optionRH_ID_HABS_PROFISSIONAIS = {
                        "tableId": "RH_ID_HABS_PROFISSIONAIS",
                        "table": "RH_ID_HABS_PROFISSIONAIS",
                        "workFlow": conf_CADASTRO['RH_ID_HABS_PROFISSIONAIS']["workflow"],
                        "pk": {
                            "primary": {
                                "RHID": {"type": "number"},
                                "EMPRESA": {"type": "varchar"},
                                "CD_HAB_PROF": {"type": "varchar"},
                                "DT_INI_HAB_PROF": {"type": "date"},
                                "DT_INI": {"type": "date"}
                            }
                        },
                        "on_pre_submit": "RH_ID_HABS_PROFISSIONAIS",
                        "externalFilter": {
                            "templateMulti": {
                                "selector": "#employeeFilter",
                                "mandatory": ['RHID'],
                                "optional": []
                            }
                        },
                        "order_by": "DT_INI DESC",
                        "recordBundle": 7,
                        "pageLenght": 7,
                        "scrollY": "234px",
                        "responsive": true,
                        "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
                        "inRowDoc": {
                            "domElementId":"#mydropzone",
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
                                "title": "", //Datatables
                                "label": "", //Editor
                                "data": 'RHID',
                                "name": 'RHID',
                                "exclude": !conf_CADASTRO['RH_ID_HABS_PROFISSIONAIS']["rgpd"]["RHID"],
                                "type": "hidden",
                                "visible": false
                            }, {
                                "title": "", //Datatables
                                "label": "", //Editor
                                "data": 'EMPRESA',
                                "name": 'EMPRESA',
                                "exclude": !conf_CADASTRO['RH_ID_HABS_PROFISSIONAIS']["rgpd"]["EMPRESA"],
                                "type": "hidden",
                                "visible": false
                            }, {
                                "responsivePriority": 2,
                                "complexList": true,
                                "title": "<?php echo mb_strtoupper($ui_company,'UTF-8'); ?>",
                                "label": "<?php echo $ui_company; ?>",
                                "data": 'DSP_EMPRESA',
                                "name": 'DSP_EMPRESA',
                                "exclude": !conf_CADASTRO['RH_ID_HABS_PROFISSIONAIS']["rgpd"]["EMPRESA"],
                                "type": "select",
                                "className": "visibleColumn",
                                //"renew": true,
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
                                "data": 'CD_HAB_PROF',
                                "name": 'CD_HAB_PROF',
                                "exclude": !conf_CADASTRO['RH_ID_HABS_PROFISSIONAIS']["rgpd"]["CD_HAB_PROF"],
                                "type": "hidden",
                                "visible": false
                            }, {
                                "title": "", //Datatables
                                "label": "", //Editor
                                "data": 'DT_INI_HAB_PROF',
                                "name": 'DT_INI_HAB_PROF',
                                "exclude": !conf_CADASTRO['RH_ID_HABS_PROFISSIONAIS']["rgpd"]["DT_INI_HAB_PROF"],
                                "type": "hidden",
                                "visible": false,
                                "datatype": "date"
                            }, {
                                "responsivePriority": 3,
                                "complexList": true,
                                "title": "<?php echo mb_strtoupper($ui_qualification_2,'UTF-8'); ?>",
                                "label": "<?php echo $ui_qualification_2; ?>",
                                "data": 'DSP_HAB_PROF',
                                "name": 'DSP_HAB_PROF',
                                "exclude": !conf_CADASTRO['RH_ID_HABS_PROFISSIONAIS']["rgpd"]["EMPRESA"] && !conf_CADASTRO['RH_ID_HABS_PROFISSIONAIS']["rgpd"]["CD_HAB_PROF"] && !conf_CADASTRO['RH_ID_HABS_PROFISSIONAIS']["rgpd"]["DT_INI_HAB_PROF"],
                                "type": "select",
                                "className": "visibleColumn",
                                //"renew": true,
                                "attr": {
                                    "dependent-group": "EMPRESA",
                                    "dependent-level": 2,
                                    "data-db-name": "A.EMPRESA@A.CD_HAB_PROF@A.DT_INI_HAB_PROF",
                                    "otherValues": "A.EMPRESA@A.ID_EP@A.DT_INI_EP",
                                    "decodeFromTable": "RH_DEF_HAB_PROFISSIONAIS A",  //TO CHANGE ON QUAD-HCM
                                    "desigColumn": "A.DSP_HAB_PROF",
                                    "orderBy": "A.CD_HAB_PROF",
                                    "class": "form-control complexList chosen"
                                }
                            }, {
                                "responsivePriority": 4,
                                "title": "<?php echo mb_strtoupper($ui_begin_date,'UTF-8'); ?>", //Datatables
                                "label": "<?php echo $ui_begin_date; ?>", //Editor
                                "data": 'DT_INI',
                                "name": 'DT_INI',
                                "exclude": !conf_CADASTRO['RH_ID_HABS_PROFISSIONAIS']["rgpd"]["DT_INI"],
                                "datatype": 'date',
                                "className": "visibleColumn",
                                "attr": {
                                    "class": "form-control datepicker"
                                }
                            }, {
                                "responsivePriority": 5,
                                "title": "<?php echo mb_strtoupper($ui_validity_date,'UTF-8'); ?>", //Datatables
                                "label": "<?php echo $ui_validity_date; ?>", //Editor
                                "data": 'DT_VALIDADE',
                                "name": 'DT_VALIDADE',
                                "exclude": !conf_CADASTRO['RH_ID_HABS_PROFISSIONAIS']["rgpd"]["DT_VALIDADE"],
                                "datatype": 'date',
                                "className": "visibleColumn",
                                "attr": {
                                    "class": "form-control datepicker"
                                }
                            }, {
                                "responsivePriority": 6,
                                "title": "<?php echo mb_strtoupper($ui_end_date,'UTF-8'); ?>", //Datatables
                                "label": "<?php echo $ui_end_date; ?>", //Editor
                                "data": 'DT_FIM',
                                "name": 'DT_FIM',
                                "exclude": !conf_CADASTRO['RH_ID_HABS_PROFISSIONAIS']["rgpd"]["DT_FIM"],
                                "datatype": 'date',
                                "className": "visibleColumn",
                                "attr": {
                                    "class": "form-control datepicker"
                                }
                            }, {
                                "title": "", //Datatables
                                "label": "", //Editor
                                "data": 'ID_EP',
                                "name": 'ID_EP',
                                "exclude": !conf_CADASTRO['RH_ID_HABS_PROFISSIONAIS']["rgpd"]["ID_EP"],
                                "type": "hidden",
                                "visible": false,
                                "className": ""
                            }, {
                                "title": "", //Datatables
                                "label": "", //Editor
                                "data": 'DT_INI_EP',
                                "name": 'DT_INI_EP',
                                "exclude": !conf_CADASTRO['RH_ID_HABS_PROFISSIONAIS']["rgpd"]["DT_INI_EP"],
                                "type": "hidden",
                                "visible": false,
                                "datatype": 'date'
                            }, {
                                "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                                "title": "<?php echo mb_strtoupper($ui_proficiency_scale,'UTF-8'); ?>",
                                "label": "<?php echo $ui_proficiency_scale; ?>",
                                "data": 'DSP_EP',
                                "name": 'DSP_EP',
                                "exclude": !conf_CADASTRO['RH_ID_HABS_PROFISSIONAIS']["rgpd"]["EMPRESA"] && !conf_CADASTRO['RH_ID_HABS_PROFISSIONAIS']["rgpd"]["ID_EP"] && !conf_CADASTRO['RH_ID_HABS_PROFISSIONAIS']["rgpd"]["DT_INI_EP"],
                                "type": "select",
                                "className": "none visibleColumn",
                                //"renew": true,                    
                                "attr": {
                                    "dependent-group": "EMPRESA",
                                    "dependent-level": 3,
                                    "data-db-name": 'A.EMPRESA@A.ID_EP@A.DT_INI_EP',
                                    "decodeFromTable": 'RH_DEF_ESCALAS_PROFICIENCIA A',
                                    "desigColumn": "A.DSP_EP",                      
                                    "orderBy": "A.ID_EP",
                                    "class": "form-control complexList chosen",
                                    "filter": {
                                        "create": ' AND A.DT_FIM_EP IS NULL', //On-New-Record
                                        "edit": ' AND A.DT_FIM_EP IS NULL', //On-Edit-Record
                                    }
                                }
                            }, {
                                "title": "", //Datatables
                                "label": "", //Editor
                                "data": 'ID_NV_ESCALA',
                                "name": 'ID_NV_ESCALA',
                                "exclude": !conf_CADASTRO['RH_ID_HABS_PROFISSIONAIS']["rgpd"]["ID_NV_ESCALA"],
                                "type": "hidden",
                                "visible": false,
                                "className": ""
                            }, {
                                "title": "", //Datatables
                                "label": "", //Editor
                                "data": 'DT_INI_NV_ESCALA',
                                "name": 'DT_INI_NV_ESCALA',
                                "exclude": !conf_CADASTRO['RH_ID_HABS_PROFISSIONAIS']["rgpd"]["DT_INI_NV_ESCALA"],
                                "type": "hidden",
                                "visible": false,
                                "datatype": 'date'
                            }, {
                                "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                                "title": "<?php echo mb_strtoupper($ui_proficiency_level,'UTF-8'); ?>",
                                "label": "<?php echo $ui_proficiency_level; ?>",
                                "data": 'DSR_NEP',
                                "name": 'DSR_NEP',
                                "exclude": !conf_CADASTRO['RH_ID_HABS_PROFISSIONAIS']["rgpd"]["EMPRESA"] && !conf_CADASTRO['RH_ID_HABS_PROFISSIONAIS']["rgpd"]["ID_EP"] && !conf_CADASTRO['RH_ID_HABS_PROFISSIONAIS']["rgpd"]["DT_INI_EP"] && !conf_CADASTRO['RH_ID_HABS_PROFISSIONAIS']["rgpd"]["ID_NV_ESCALA"] && !conf_CADASTRO['RH_ID_HABS_PROFISSIONAIS']["rgpd"]["DT_INI_NV_ESCALA"],
                                "type": "select",
                                "className": "none visibleColumn",
                                //"renew": true,                    
                                "attr": {
                                    "dependent-group": "EMPRESA",
                                    "dependent-level": 4,
                                    //"deferred": true,
                                    "data-db-name": 'A.EMPRESA@A.ID_EP@A.DT_INI_EP@A.ID_NV_ESCALA@A.DT_INI_NV_ESCALA',
                                    "decodeFromTable": 'RH_NIVEIS_ESCALA_PROFICIENCIA A',
                                    "desigColumn": "NVL(A.DSR_NEP, A.DSP_NEP)", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.                        
                                    "orderBy": "A.EMPRESA,A.ID_EP,A.DT_INI_EP,A.ID_NV_ESCALA,A.DT_INI_NV_ESCALA", //usado no complexList.php
                                    "class": "form-control complexList chosen",
                                    //"disabled": true, //Permite inibir o campo no Editor
                                    //"whereClause": "",
                                    "filter": {
                                        "create": " AND A.DT_FIM_NV_ESCALA IS NULL", // AND EMPRESA = ':EMPRESA'", //On-New-Record
                                        "edit": " AND A.DT_FIM_NV_ESCALA IS NULL", // AND EMPRESA = ':EMPRESA'", //On-Edit-Record
                                    }
                                }
                            }, {
                                "title": "<?php echo mb_strtoupper($ui_document_num,'UTF-8'); ?>", //Datatables
                                "label": "<?php echo $ui_document_num; ?>", //Editor
                                "data": 'NR_DOCUMENTO',
                                "name": 'NR_DOCUMENTO',
                                "exclude": !conf_CADASTRO['RH_ID_HABS_PROFISSIONAIS']["rgpd"]["NR_DOCUMENTO"],
                                "className": "none visibleColumn"
                            }, {
                                "title": "<?php echo mb_strtoupper($ui_issuer,'UTF-8'); ?>", //Datatables
                                "label": "<?php echo $ui_issuer; ?>", //Editor
                                "data": 'EMISSOR',
                                "name": 'EMISSOR',
                                "exclude": !conf_CADASTRO['RH_ID_HABS_PROFISSIONAIS']["rgpd"]["EMISSOR"],
                                "className": "none visibleColumn"
                            }, {
                                "title": "<?php echo mb_strtoupper($ui_description,'UTF-8'); ?>", //Datatables
                                "label": "<?php echo $ui_description; ?>", //Editor
                                "data": 'DESCRICAO',
                                "name": 'DESCRICAO',
                                "exclude": !conf_CADASTRO['RH_ID_HABS_PROFISSIONAIS']["rgpd"]["DESCRICAO"],
                                "type": 'textarea', //Editor
                                "className": "none visibleColumn",
                                "attr": {
                                    "style": "max-width: 355px",
                                    "class": "form-control len-355"
                                }
                            }, {
                                "responsivePriority": 7,
                                "title": "<?php echo mb_strtoupper($ui_document_short, 'UTF-8'); ?>", //Datatables
                                "label": "<?php echo $ui_document_short; ?>", //Editor
                                "data": 'LINK_DOC',
                                "name": 'LINK_DOC',
                                "className": "",
                                "type": "hidden",
                                "width": "1%",
                                "exclude": !conf_CADASTRO['RH_ID_HABS_PROFISSIONAIS']["rgpd"]["LINK_DOC"],
                                "attr": {
                                    "name": 'LINK_DOC'
                                },
                                "render": function (val, type, row) {                          
                                    return RH_ID_HABS_PROFISSIONAIS.getFileIcon(row['BD_MIME'], JSON.stringify(row));
                                }
                            }, {
                                "title": "<?php echo mb_strtoupper($ui_extention, 'UTF-8'); ?>" + '</span>', //Datatables
                                "label": "<?php echo $ui_extention; ?>", //Editor
                                "fieldInfo": "<?php echo $hint_file_format; ?>",
                                "data": 'BD_MIME',
                                "name": 'BD_MIME',
                                "exclude": !conf_CADASTRO['RH_ID_HABS_PROFISSIONAIS']["rgpd"]["LINK_DOC"],
                                "className": "",
                                "type": "hidden",
                                "visible": false 
                            }, {
                                "title": 'BD_DOC',
                                "data": null,
                                "name": 'BD_DOC',
                                "type": "upload",
                                "exclude": !conf_CADASTRO['RH_ID_HABS_PROFISSIONAIS']["rgpd"]["LINK_DOC"],
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
                                "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions,'UTF-8'); ?>" + '</span>',
                                "label": '',
                                "data": null,
                                "name": 'RECORD_HISTORY',
                                "type": "hidden",
                                "className": "none visibleColumn",
                                "render": function (val, type, row) {
                                    return tablesRecordHistory(val, type, row);
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
                                    //
                                    return RH_ID_HABS_PROFISSIONAIS.crudButtons(conf_CADASTRO['RH_ID_HABS_PROFISSIONAIS']["crud"][0], conf_CADASTRO['RH_ID_HABS_PROFISSIONAIS']["crud"][1], conf_CADASTRO['RH_ID_HABS_PROFISSIONAIS']["crud"][2]);
                                }
                            }
                        ],
                        "validations": {
                            "rules": {
                                "DSP_EMPRESA": {
                                    required: true,
                                },
                                "DSP_HAB_PROF": {
                                    required: true,
                                },
                                "NR_DOCUMENTO": {
                                    maxlength: 20
                                },
                                "EMISSOR": {
                                    maxlength: 100
                                },
                                "DESCRICAO": {
                                    maxlength: 4000
                                },
                                "DT_INI": {
                                    required: true,
                                    dateISO: true
                                },
                                "DT_FIM": {
                                    dateISO: true,
                                    dateEqOrNextThan: 'DT_INI'
                                },
                                "DT_VALIDADE": {
                                    dateISO: true,
                                    dateEqOrNextThan: 'DT_INI'
                                }
                            },
                            //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                            "messages": {
                                "DT_FIM": {
                                    dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                                },
                                "DT_VALIDADE": {
                                    dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                                }
                            }
                        }
                    };
                    RH_ID_HABS_PROFISSIONAIS = new QuadTable();
                    RH_ID_HABS_PROFISSIONAIS.initTable($.extend({}, datatable_instance_defaults, optionRH_ID_HABS_PROFISSIONAIS));
                } else {
                    $('#wid-6_2').closest('article').remove();
                }
                //END Habs. Profissionais            
            }
            //END Habilitações TAB
            
            //FlexFields 
            if ( !conf_CADASTRO['RH_ID_FLEXFIELDS']["access"] ) {    
                $('a[href="#Tab4"]').remove();
                $('#Tab4').remove();
            } else {
                var optionRH_ID_FLEXFIELDS = {
                    "tableId": "RH_ID_FLEXFIELDS",
                    "table": "RH_ID_FLEXFIELDS",
                    //"autoWidth": false, :: NOT AN OPTION at the MOMENT :: ALWAYS TRUE
                    "workFlow": conf_CADASTRO['RH_ID_FLEXFIELDS']["workflow"],
                    "pk": {
                        "primary": {
                            "RHID": {"type": "number"},
                            "CD_FF": {"type": "varchar"},
                            "DT_INI": {"type": "date"}
                        }
                    },                    
                    "externalFilter": {
                        "templateMulti": {
                            "selector": "#employeeFilter",
                            "mandatory": ['RHID'],
                            "optional": []
                        },
                        /*"template": {
                            selector:"#Filter_FF",
                            "mandatory": [],
                            "optional": ['DSP_CTX_FF']
                        }*/
                    },
                    "order_by": "CD_FF",
                    "recordBundle": 7,
                    "pageLenght": 7,
                    "scrollY": "234px",
                    "responsive": true,
                    "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
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
                            "data": 'RHID',
                            "name": 'RHID',
                            "exclude": !conf_CADASTRO['RH_ID_FLEXFIELDS']["rgpd"]["RHID"],
                            "type": "hidden",
                            "visible": false
                        }, {
                            "title": "", //Datatables
                            "label": "", //Editor
                            "data": 'EMPRESA',
                            "name": 'EMPRESA',
                            "exclude": !conf_CADASTRO['RH_ID_FLEXFIELDS']["rgpd"]["EMPRESA"],
                            "type": "hidden",
                            "visible": false
                        }, {
                            "responsivePriority": 2,
                            "complexList": true,
                            "title": "<?php echo mb_strtoupper($ui_company,'UTF-8'); ?>",
                            "label": "<?php echo $ui_company; ?>",
                            "data": 'DSP_EMPRESA',
                            "name": 'DSP_EMPRESA',
                            "exclude": !conf_CADASTRO['RH_ID_FLEXFIELDS']["rgpd"]["EMPRESA"],
                            "type": "select",
                            "className": "visibleColumn",
                            //"renew": true,
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
                            "data": 'CD_FF',
                            "name": 'CD_FF',
                            "exclude": !conf_CADASTRO['RH_ID_FLEXFIELDS']["rgpd"]["CD_FF"],
                            "type": "hidden", //Editor
                            "visible": false //DataTables 
                        }, {
                            "responsivePriority": 3,
                            "complexList": true,
                            "title": "<?php echo mb_strtoupper($ui_attribute,'UTF-8'); ?>",
                            "label": "<?php echo $ui_attribute; ?>",
                            "data": 'DSP_FF',
                            "name": 'DSP_FF',
                            "exclude": !conf_CADASTRO['RH_ID_FLEXFIELDS']["rgpd"]["CD_FF"],
                            "type": "select",
                            "className": "visibleColumn",
                            //"renew": true,  
                            "mySource": true,
                            "attr": {
                                "dependent-group": "DSP_FF",
                                "dependent-level": 1,
                                "data-db-name": 'A.CD_FF',
                                "decodeFromTable": 'RH_DEF_FLEXFIELDS A',
                                "otherValues": "A.CONTEXTO@A.DOMINIO@A.SQL_CODE@A.SCC_ACTVO",
                                "desigColumn": "A.DSP_FF",
                                "orderBy": "NVL(A.NR_ORDEM,A.CD_FF)",
                                "class": "form-control complexList chosen",
                                //"disabled": true, //Permite inibir o campo no Editor
                                "filter": {
                                    "create": " AND A.ACTIVO = 'S'", //On-New-Record
                                    "edit": " AND A.ACTIVO = 'S'", //On-Edit-Record
                                }
                            }
                        }, {
                            "responsivePriority": 4,
                            "title": "<?php echo mb_strtoupper($ui_value,'UTF-8'); ?>",
                            "label": "<?php echo $ui_value; ?>",
                            "data": 'VALOR',
                            "name": 'VALOR',
                            "exclude": !conf_CADASTRO['RH_ID_FLEXFIELDS']["rgpd"]["VALOR"],
                            "className": "visibleColumn",
                            "render": function (val, type, row) {
                                var vlr = displayFF(val,type,row);
                                return vlr;
                            }
                        }, {
                            "responsivePriority": 7,
                            "title": "<?php echo mb_strtoupper($ui_order_nr,'UTF-8'); ?>",
                            "label": "<?php echo $ui_order_nr; ?>",
                            "name": "NR_ORDEM",
                            "data": "NR_ORDEM",
                            "exclude": !conf_CADASTRO['RH_ID_FLEXFIELDS']["rgpd"]["NR_ORDEM"],
                            "type": "hidden",
                            "className": "control toRight",
                            "width": "1%",
                        }, {
                            "responsivePriority": 5,
                            "title": "<?php echo mb_strtoupper($ui_begin_date,'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_begin_date; ?>", //Editor
                            "data": 'DT_INI',
                            "name": 'DT_INI',
                            "exclude": !conf_CADASTRO['RH_ID_FLEXFIELDS']["rgpd"]["DT_INI"],
                            "datatype": 'date',
                            "def": hoje(),
                            "className": "visibleColumn",
                            "attr": {
                                "class": "form-control datepicker"
                            }
                        }, {
                            "responsivePriority": 6,
                            "title": "<?php echo mb_strtoupper($ui_end_date,'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_end_date; ?>", //Editor
                            "data": 'DT_FIM',
                            "name": 'DT_FIM',
                            "exclude": !conf_CADASTRO['RH_ID_FLEXFIELDS']["rgpd"]["DT_FIM"],
                            "datatype": 'date',
                            "className": "visibleColumn",
                            "attr": {
                                "class": "form-control datepicker"
                            }
                        }, {
                            "title": "<?php echo mb_strtoupper($ui_description,'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_description; ?>", //Editor
                            "data": 'DESCRICAO',
                            "name": 'DESCRICAO',
                            "exclude": !conf_CADASTRO['RH_ID_FLEXFIELDS']["rgpd"]["DESCRICAO"],
                            "type": 'textarea', //Editor
                            "className": "none visibleColumn",
                            "attr": {
                                "style": "width: 322px; max-width: 335px",
                                "class": "form-control"
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
                            "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions,'UTF-8'); ?>" + '</span>',
                            "label": '',
                            "data": null,
                            "name": 'RECORD_HISTORY',
                            "type": "hidden",
                            "className": "none visibleColumn",
                            "render": function (val, type, row) {
                                return tablesRecordHistory(val, type, row);
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
                                //
                                return RH_ID_FLEXFIELDS.crudButtons(conf_CADASTRO['RH_ID_FLEXFIELDS']["crud"][0], conf_CADASTRO['RH_ID_FLEXFIELDS']["crud"][1], conf_CADASTRO['RH_ID_FLEXFIELDS']["crud"][2]);
                            }
                        }
                    ],
                    "validations": {
                        "rules": {
                            "DSP_FF": {
                                required: true,
                            },
                            "NR_DOCUMENTO": {
                                required: true,
                                maxlength: 20
                            },
                            "VALOR": {
                                required: true,
                                maxlength: 2000
                            },
                            "NR_ORDEM": {
                                integer: true,
                                maxlength: 6
                            },
                            "DT_INI": {
                                required: true,
                                dateISO: true
                            },
                            "DT_FIM": {
                                dateISO: true,
                                dateEqOrNextThan: 'DT_INI'
                            }
                        },
                        //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                        "messages": {
                            "DT_FIM": {
                                dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                            }
                        }
                    }
                };
                RH_ID_FLEXFIELDS = new QuadTable();
                RH_ID_FLEXFIELDS.initTable($.extend({}, datatable_instance_defaults, optionRH_ID_FLEXFIELDS));
                //HERE
            }
            //END FlexFields
            
            //TAB Curriculum
            if ( !conf_CADASTRO['RH_ID_CURRICULUM']["access"] && !conf_CADASTRO['RH_ID_CONTEXTOS_TEMPO']["access"] ) { 
                $('a[href="#Tab5"]').remove();
                $('#Tab5').remove();            
            } else {
                //Curriculum
                if ( conf_CADASTRO['RH_ID_CURRICULUM']["access"] ) {
                    var optionRH_ID_CURRICULUM = {
                        "tableId": "RH_ID_CURRICULUM",
                        "table": "RH_ID_CURRICULUM",
                        "workFlow": conf_CADASTRO['RH_ID_CURRICULUM']["workflow"],
                        "pk": {
                            "primary": {
                                "RHID": {"type": "number"},
                                "CD_ITEM": {"type": "varchar"},
                                "CD_SUB_ITEM": {"type": "varchar"},
                                "DT_INI": {"type": "date"}
                            }
                        },
                        "externalFilter": {
                            "templateMulti": {
                                "selector": "#employeeFilter",
                                "mandatory": ['RHID'],
                                "optional": []
                            }
                        },
                        "order_by": "CD_ITEM, CD_SUB_ITEM",
                        "recordBundle": 7,
                        "pageLenght": 7,
                        "scrollY": "234px",
                        "responsive": true,
                        "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
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
                                "data": 'RHID',
                                "name": 'RHID',
                                "exclude": !conf_CADASTRO['RH_ID_CURRICULUM']["rgpd"]["RHID"],
                                "type": "hidden",
                                "visible": false
                            }, {
                                "title": "", //Datatables
                                "label": "", //Editor
                                "data": 'EMPRESA',
                                "name": 'EMPRESA',
                                "exclude": !conf_CADASTRO['RH_ID_CURRICULUM']["rgpd"]["EMPRESA"],
                                "type": "hidden",
                                "visible": false
                            }, {
                                "responsivePriority": 2,
                                "complexList": true,
                                "title": "<?php echo mb_strtoupper($ui_company,'UTF-8'); ?>",
                                "label": "<?php echo $ui_company; ?>",
                                "data": 'DSP_EMPRESA',
                                "name": 'DSP_EMPRESA',
                                "exclude": !conf_CADASTRO['RH_ID_CURRICULUM']["rgpd"]["EMPRESA"],
                                "type": "select",
                                "className": "visibleColumn",
                                //"renew": true,
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
                                "data": 'CD_ITEM',
                                "name": 'CD_ITEM',
                                "exclude": !conf_CADASTRO['RH_ID_CURRICULUM']["rgpd"]["CD_ITEM"],
                                "type": "hidden", //Editor
                                "visible": false //DataTables 
                            }, {
                                "responsivePriority": 3,
                                "complexList": true,
                                "title": "<?php echo mb_strtoupper($ui_item,'UTF-8'); ?>",
                                "label": "<?php echo $ui_item; ?>",
                                "data": 'DSP_ITEM',
                                "name": 'DSP_ITEM',
                                "exclude": !conf_CADASTRO['RH_ID_CURRICULUM']["rgpd"]["CD_ITEM"],
                                "type": "select",
                                "className": "visibleColumn",
                                //"renew": true,                    
                                "attr": {
                                    "dependent-group": "CURRICULUM",
                                    "dependent-level": 1,
                                    "data-db-name": 'A.CD_ITEM',
                                    "decodeFromTable": 'RH_DEF_ITEMS A',
                                    //"otherValues": "",
                                    "desigColumn": "A.DSP_ITEM",
                                    "orderBy": "A.CD_ITEM",
                                    "class": "form-control complexList chosen",
                                    //"disabled": true, //Permite inibir o campo no Editor
                                    "filter": {
                                        "create": " AND A.ACTIVO = 'S'", //On-New-Record
                                        "edit": " AND A.ACTIVO = 'S'", //On-Edit-Record
                                    }
                                }
                            }, {
                                "title": "", //Datatables
                                "label": "", //Editor
                                "data": 'CD_SUB_ITEM',
                                "name": 'CD_SUB_ITEM',
                                "exclude": !conf_CADASTRO['RH_ID_CURRICULUM']["rgpd"]["CD_SUB_ITEM"],
                                "type": "hidden", //Editor
                                "visible": false //DataTables 
                            }, {
                                "responsivePriority": 4,
                                "complexList": true,
                                "title": "<?php echo mb_strtoupper($ui_sub_item,'UTF-8'); ?>",
                                "label": "<?php echo $ui_sub_item; ?>",
                                "data": 'DSP_SUB_ITEM',
                                "name": 'DSP_SUB_ITEM',
                                "exclude": !conf_CADASTRO['RH_ID_CURRICULUM']["rgpd"]["CD_ITEM"] && !conf_CADASTRO['RH_ID_CURRICULUM']["rgpd"]["CD_SUB_ITEM"],
                                "type": "select",
                                "className": "visibleColumn",
                                //"renew": true, 
                                "attr": {
                                    "dependent-group": "CURRICULUM",
                                    "dependent-level": 2,
                                    "data-db-name": 'A.CD_ITEM@A.CD_SUB_ITEM',
                                    "decodeFromTable": 'RH_DEF_SUB_ITEMS A',
                                    //"otherValues": "",
                                    "desigColumn": "A.DSP_SUB_ITEM",
                                    "orderBy": "A.CD_SUB_ITEM",
                                    "class": "form-control complexList chosen",
                                    //"disabled": true, //Permite inibir o campo no Editor
                                    "filter": {
                                        "create": " AND A.ACTIVO = 'S'", //On-New-Record
                                        "edit": " AND A.ACTIVO = 'S'", //On-Edit-Record
                                    }
                                }
                            }, {
                                "responsivePriority": 5,
                                "title": "<?php echo mb_strtoupper($ui_begin_date,'UTF-8'); ?>", //Datatables
                                "label": "<?php echo $ui_begin_date; ?>", //Editor
                                "data": 'DT_INI',
                                "name": 'DT_INI',
                                "exclude": !conf_CADASTRO['RH_ID_CURRICULUM']["rgpd"]["DT_INI"],
                                "datatype": 'date',
                                "def": hoje(),
                                "className": "visibleColumn",
                                "attr": {
                                    "class": "form-control datepicker"
                                }
                            }, {
                                "responsivePriority": 6,
                                "title": "<?php echo mb_strtoupper($ui_end_date,'UTF-8'); ?>", //Datatables
                                "label": "<?php echo $ui_end_date; ?>", //Editor
                                "data": 'DT_FIM',
                                "name": 'DT_FIM',
                                "exclude": !conf_CADASTRO['RH_ID_CURRICULUM']["rgpd"]["DT_FIM"],
                                "datatype": 'date',
                                "def": hoje(),
                                "className": "visibleColumn",
                                "attr": {
                                    "class": "form-control datepicker"
                                }
                            }, {
                                "responsivePriority": 7,
                                "title": "<?php echo mb_strtoupper($ui_duration,'UTF-8'); ?>",
                                "label": "<?php echo $ui_duration; ?>",
                                "fieldInfo": "<?php echo $hint_hours; ?>",
                                "name": "HRS_DURACAO",
                                "data": "HRS_DURACAO",
                                "exclude": !conf_CADASTRO['RH_ID_CURRICULUM']["rgpd"]["HRS_DURACAO"],
                                "type": "hidden",
                                "className": "control toRight",
                                "width": "1%",
                            }, {
                                "responsivePriority": 8,
                                "title": "<?php echo mb_strtoupper($ui_validated,'UTF-8'); ?>", //Datatables
                                "label": "<?php echo $ui_validated; ?>", //Editor
                                "data": 'VALIDADO',
                                "name": 'VALIDADO',
                                "exclude": !conf_CADASTRO['RH_ID_CURRICULUM']["rgpd"]["VALIDADO"],
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
                                "title": "<?php echo mb_strtoupper($ui_description,'UTF-8'); ?>", //Datatables
                                "label": "<?php echo $ui_description; ?>", //Editor
                                "data": 'DSP_OCORRENCIA',
                                "name": 'DSP_OCORRENCIA',
                                "exclude": !conf_CADASTRO['RH_ID_CURRICULUM']["rgpd"]["DSP_OCORRENCIA"],
                                "type": 'textarea', //Editor
                                "className": "none visibleColumn",
                                "attr": {
                                    "style": "max-width: 355px",
                                    "class": "form-control len-355"
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
                                "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions,'UTF-8'); ?>" + '</span>',
                                "label": '',
                                "data": null,
                                "name": 'RECORD_HISTORY',
                                "type": "hidden",
                                "className": "none visibleColumn",
                                "render": function (val, type, row) {
                                    return tablesRecordHistory(val, type, row);
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
                                    //
                                    return RH_ID_CURRICULUM.crudButtons(conf_CADASTRO['RH_ID_CURRICULUM']["crud"][0], conf_CADASTRO['RH_ID_CURRICULUM']["crud"][1], conf_CADASTRO['RH_ID_CURRICULUM']["crud"][2]);
                                }
                            }
                        ],
                        "validations": {
                            "rules": {
                                "DSP_ITEM": {
                                    required: true,
                                },
                                "DSP_ITEM": {
                                    required: true
                                },
                                "VALIDADO": {
                                    required: true
                                },
                                "DSP_OCORRENCIA": {
                                    maxlength: 150
                                },
                                "DT_INI": {
                                    required: true,
                                    dateISO: true
                                },
                                "DT_FIM": {
                                    dateISO: true,
                                    dateEqOrNextThan: 'DT_INI'
                                }
                            },
                            //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                            "messages": {
                                "DT_FIM": {
                                    dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                                }
                            }
                        }
                    };
                    RH_ID_CURRICULUM = new QuadTable();
                    RH_ID_CURRICULUM.initTable($.extend({}, datatable_instance_defaults, optionRH_ID_CURRICULUM));
                } else {
                    $('#wid-5_1').closest('article').remove();
                }
                //END Curriculum            

                //Contextos Temporais
                if ( conf_CADASTRO['RH_ID_CONTEXTOS_TEMPO']["access"] ) {
                    var optionRH_ID_CONTEXTOS_TEMPO = {
                        "tableId": "RH_ID_CONTEXTOS_TEMPO",
                        "table": "RH_ID_CONTEXTOS_TEMPO",
                        "workFlow": conf_CADASTRO['RH_ID_CONTEXTOS_TEMPO']["workflow"],
                        "pk": {
                            "primary": {
                                "RHID": {"type": "number"},
                                "CD_CTX": {"type": "varchar"},
                                "DT_INI": {"type": "date"}
                            }
                        },
                        "externalFilter": {
                            "templateMulti": {
                                "selector": "#employeeFilter",
                                "mandatory": ['RHID'],
                                "optional": []
                            }
                        },
                        "order_by": "DT_INI DESC",
                        "recordBundle": 7,
                        "pageLenght": 7,
                        "scrollY": "234px",
                        "responsive": true,
                        "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
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
                                "data": 'RHID',
                                "name": 'RHID',
                                "exclude": !conf_CADASTRO['RH_ID_CONTEXTOS_TEMPO']["rgpd"]["RHID"],
                                "type": "hidden",
                                "visible": false
                            }, {
                                "title": "", //Datatables
                                "label": "", //Editor
                                "data": 'EMPRESA',
                                "name": 'EMPRESA',
                                "exclude": !conf_CADASTRO['RH_ID_CONTEXTOS_TEMPO']["rgpd"]["EMPRESA"],
                                "type": "hidden",
                                "visible": false
                            }, {
                                "responsivePriority": 2,
                                "complexList": true,
                                "title": "<?php echo mb_strtoupper($ui_company,'UTF-8'); ?>",
                                "label": "<?php echo $ui_company; ?>",
                                "data": 'DSP_EMPRESA',
                                "name": 'DSP_EMPRESA',
                                "exclude": !conf_CADASTRO['RH_ID_CONTEXTOS_TEMPO']["rgpd"]["EMPRESA"],
                                "type": "select",
                                "className": "visibleColumn",
                                //"renew": true,
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
                                "title": "<?php echo mb_strtoupper($ui_context,'UTF-8'); ?>", //Datatables
                                "label": "<?php echo $ui_context; ?>", //Editor
                                "data": 'CD_CTX',
                                "name": 'CD_CTX',
                                "exclude": !conf_CADASTRO['RH_ID_CONTEXTOS_TEMPO']["rgpd"]["CD_CTX"],
                                "type": "select",
                                "className": "visibleColumn",
                                "attr": {
                                    "domain-list": true,
                                    "dependent-group": 'RH_CTX_MIS',
                                    "class": "form-control chosen"
                                }
        //                        "render": function (val, type, row) {
        //                            if (val != null) {
        //                                var o = _.find(initApp.joinsData['DG_SIM_NAO'], {'RV_LOW_VALUE': val});
        //                                return val == null ? null : o['RV_MEANING'];
        //                            }
        //                            return val;
        //                        }                         


                            }, {
                                "responsivePriority": 4,
                                "title": "<?php echo mb_strtoupper($ui_begin_date,'UTF-8'); ?>", //Datatables
                                "label": "<?php echo $ui_begin_date; ?>", //Editor
                                "data": 'DT_INI',
                                "name": 'DT_INI',
                                "exclude": !conf_CADASTRO['RH_ID_CONTEXTOS_TEMPO']["rgpd"]["DT_INI"],
                                "datatype": 'date',
                                "className": "visibleColumn",
                                "attr": {
                                    "class": "form-control datepicker"
                                }
                            }, {
                                "responsivePriority": 5,
                                "title": "<?php echo mb_strtoupper($ui_end_date,'UTF-8'); ?>", //Datatables
                                "label": "<?php echo $ui_end_date; ?>", //Editor
                                "data": 'DT_FIM',
                                "name": 'DT_FIM',
                                "exclude": !conf_CADASTRO['RH_ID_CONTEXTOS_TEMPO']["rgpd"]["DT_FIM"],
                                "datatype": 'date',
                                "className": "visibleColumn",
                                "attr": {
                                    "class": "form-control datepicker"
                                }
                            }, {
                                "title": "<?php echo mb_strtoupper($ui_description,'UTF-8'); ?>", //Datatables
                                "label": "<?php echo $ui_description; ?>", //Editor
                                "data": 'DESCRICAO',
                                "name": 'DESCRICAO',
                                "exclude": !conf_CADASTRO['RH_ID_CONTEXTOS_TEMPO']["rgpd"]["DESCRICAO"],
                                "type": 'textarea', //Editor
                                "className": "none visibleColumn",
                                "attr": {
                                    "style": "max-width: 355px",
                                    "class": "form-control len-355"
                                }
                            }, {
                                "title": "<?php echo mb_strtoupper($ui_obs_short,'UTF-8'); ?>", //Datatables
                                "label": "<?php echo $ui_obs_short; ?>", //Editor
                                "data": 'OBS',
                                "name": 'OBS',
                                "exclude": !conf_CADASTRO['RH_ID_CONTEXTOS_TEMPO']["rgpd"]["OBS"],
                                "type": 'textarea', //Editor
                                "className": "none visibleColumn",
                                "attr": {
                                    "style": "max-width: 355px",
                                    "class": "form-control len-355"
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
                                "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions,'UTF-8'); ?>" + '</span>',
                                "label": '',
                                "data": null,
                                "name": 'RECORD_HISTORY',
                                "type": "hidden",
                                "className": "none visibleColumn",
                                "render": function (val, type, row) {
                                    return tablesRecordHistory(val, type, row);
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
                                    //
                                    return RH_ID_CONTEXTOS_TEMPO.crudButtons(conf_CADASTRO['RH_ID_CONTEXTOS_TEMPO']["crud"][0], conf_CADASTRO['RH_ID_CONTEXTOS_TEMPO']["crud"][1], conf_CADASTRO['RH_ID_CONTEXTOS_TEMPO']["crud"][2]);
                                }
                            }
                        ],
                        "validations": {
                            "rules": {
                                "CD_CTX": {
                                    required: true,
                                },
                                "DESCRICAO": {
                                    maxlength: 4000
                                },
                                "OBS": {
                                    maxlength: 4000
                                },
                                "DT_INI": {
                                    required: true,
                                    dateISO: true
                                },
                                "DT_FIM": {
                                    dateISO: true,
                                    dateEqOrNextThan: 'DT_INI'
                                }
                            },
                            //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                            "messages": {
                                "DT_FIM": {
                                    dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                                }
                            }
                        }
                    };
                    RH_ID_CONTEXTOS_TEMPO = new QuadTable();
                    RH_ID_CONTEXTOS_TEMPO.initTable($.extend({}, datatable_instance_defaults, optionRH_ID_CONTEXTOS_TEMPO));
                } else {
                    $('#wid-5_2').closest('article').remove();
                }
                //END Contextos Temporais            
            }
            //END TAB Curriculum

            //Características
            if ( conf_CADASTRO['RH_ID_CARACTERISTICAS']["access"] ) {
                var optionRH_ID_CARACTERISTICAS = {
                    "tableId": "RH_ID_CARACTERISTICAS",
                    "table": "RH_ID_CARACTERISTICAS",
                    "workFlow": conf_CADASTRO['RH_ID_CARACTERISTICAS']["workflow"],
                    "pk": {
                        "primary": {
                            "EMPRESA": {"type": "number"},
                            "RHID": {"type": "number"},
                            "ID_TP_CARACT": {"type": "number"},
                            "DT_INI_TP_CARACT": {"type": "date"},
                            "ID_DOM_1": {"type": "number"},
                            "DT_INI_DOM_1": {"type": "date"},
                            "ID_DOM_2": {"type": "number"},
                            "DT_INI_DOM_2": {"type": "date"},
                            "ID_CARACTERISTICA": {"type": "number"},
                            "DT_INI_CARACTERISTICA": {"type": "date"},
                            "DT_INI": {"type": "date"}
                        }
                    },
                    "externalFilter": {
                        "templateMulti": {
                            "selector": "#employeeFilter",
                            "mandatory": ['RHID'],
                            "optional": []
                        }
                    },
                    "order_by": "DT_INI DESC",
                    "recordBundle": 7,
                    "pageLenght": 7,
                    "scrollY": "234px",
                    "responsive": true,
                    "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
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
                            "data": 'RHID',
                            "name": 'RHID',
                            "exclude": !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["RHID"],
                            "type": "hidden",
                            "visible": false
                        }, {
                            "title": "", //Datatables
                            "label": "", //Editor
                            "data": 'EMPRESA',
                            "name": 'EMPRESA',
                            "exclude": !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["EMPRESA"],
                            "type": "hidden",
                            "visible": false
                        }, {
                            "responsivePriority": 2,
                            "complexList": true,
                            "title": "<?php echo mb_strtoupper($ui_company,'UTF-8'); ?>",
                            "label": "<?php echo $ui_company; ?>",
                            "data": 'DSP_EMPRESA',
                            "name": 'DSP_EMPRESA',
                            "exclude": !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["EMPRESA"],
                            "type": "select",
                            "className": "visibleColumn",
                            //"renew": true,
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
                            "data": 'ID_TP_CARACT',
                            "name": 'ID_TP_CARACT',
                            "exclude": !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["ID_TP_CARACT"],
                            "type": "hidden", //Editor
                            "visible": false, //DataTables
                        }, {
                            "title": "", //Datatables
                            "label": "", //Editor
                            "data": 'DT_INI_TP_CARACT',
                            "name": 'DT_INI_TP_CARACT',
                            "exclude": !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["DT_INI_TP_CARACT"],
                            "datatype": 'date',
                            "type": "hidden", //Editor
                            "visible": false, //DataTables                                        
                        }, {
                            "complexList": true,
                            "responsivePriority": 3,
                            "title": "<?php echo mb_strtoupper($ui_type,'UTF-8'); ?>",
                            "label": "<?php echo $ui_type; ?>",
                            "data": 'DSP_TP_CARACT',
                            "name": 'DSP_TP_CARACT',
                            "exclude": !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["EMPRESA"] && !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["ID_TP_CARACT"] && !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["DT_INI_TP_CARACT"],
                            "type": "select",
                            "className": "visibleColumn",
                            "attr": {
                                "dependent-level": 2,
                                "dependent-group": "EMPRESA",
                                "data-db-name": "A.EMPRESA@A.ID_TP_CARACT@A.DT_INI_TP_CARACT",
                                "decodeFromTable": "RH_DEF_TP_CARACTERISTICAS A",
                                "desigColumn": "A.DSP_TP_CARACT",
                                "orderBy": "A.ID_TP_CARACT",
                                "class": "form-control complexList chosen",
                                "filter": {
                                    "create": ' AND A.DT_FIM_TP_CARACT IS NULL', //On-New-Record
                                    "edit": ' AND A.DT_FIM_TP_CARACT IS NULL', //On-Edit-Record
                                }
                            }
                        }, {
                            "title": "", //Datatables
                            "label": "", //Editor
                            "data": 'ID_DOM_1',
                            "name": 'ID_DOM_1',
                            "exclude": !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["ID_DOM_1"],
                            "type": "hidden", //Editor
                            "visible": false, //DataTables
                        }, {
                            "title": "", //Datatables
                            "label": "", //Editor
                            "data": 'DT_INI_DOM_1',
                            "name": 'DT_INI_DOM_1',
                            "exclude": !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["DT_INI_DOM_1"],
                            "datatype": 'date',
                            "type": "hidden", //Editor
                            "visible": false, //DataTables 
                        }, {
                            "complexList": true,
                            "responsivePriority": 4,
                            "title": "<?php echo mb_strtoupper($ui_characteristic_1_dom,'UTF-8'); ?>",
                            "label": "<?php echo $ui_characteristic_1_dom; ?>",
                            "data": 'DSP_DOM_1',
                            "name": 'DSP_DOM_1',
                            "exclude": !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["EMPRESA"] && !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["ID_TP_CARACT"] && !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["DT_INI_TP_CARACT"] &&
                                       !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["ID_DOM_1"] && !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["DT_INI_DOM_1"],
                            "type": "select",
                            "className": "visibleColumn",
                            "attr": {
                                "dependent-level": 3,
                                "dependent-group": "EMPRESA",
                                "data-db-name": "A.EMPRESA@A.ID_TP_CARACT@A.DT_INI_TP_CARACT@A.ID_DOM_1@A.DT_INI_DOM_1",
                                "decodeFromTable": "RH_DEF_DOMINIOS_1 A",
                                "desigColumn": "A.DSP_DOM_1",
                                "orderBy": "A.ID_DOM_1",
                                "class": "form-control complexList chosen",
                                "filter": {
                                    "create": ' AND A.DT_FIM_DOM_1 IS NULL', //On-New-Record
                                    "edit": ' AND A.DT_FIM_DOM_1 IS NULL', //On-Edit-Record
                                }
                            }
                        }, {
                            "title": "", //Datatables
                            "label": "", //Editor
                            "data": 'ID_DOM_2',
                            "name": 'ID_DOM_2',
                            "exclude": !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["ID_DOM_2"],
                            "type": "hidden", //Editor
                            "visible": false, //DataTables
                        }, {
                            "title": "", //Datatables
                            "label": "", //Editor
                            "data": 'DT_INI_DOM_2',
                            "name": 'DT_INI_DOM_2',
                            "exclude": !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["DT_INI_DOM_2"],
                            "datatype": 'date',
                            "type": "hidden", //Editor
                            "visible": false, //DataTables
                        }, {
                            "complexList": true,
                            "responsivePriority": 5,
                            "title": "<?php echo mb_strtoupper($ui_characteristic_2_dom, 'UTF-8'); ?>",
                            "label": "<?php echo $ui_characteristic_2_dom; ?>",
                            "data": 'DSP_DOM_2',
                            "name": 'DSP_DOM_2',
                            "exclude": !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["EMPRESA"] && !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["ID_TP_CARACT"] && !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["DT_INI_TP_CARACT"] &&
                                       !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["ID_DOM_1"] && !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["DT_INI_DOM_1"] && !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["ID_DOM_2"] &&
                                       !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["DT_INI_DOM_2"],
                            "type": "select",
                            "className": "visibleColumn",
                            "attr": {
                                "dependent-level": 4,
                                "dependent-group": "EMPRESA",
                                "data-db-name": "A.EMPRESA@A.ID_TP_CARACT@A.DT_INI_TP_CARACT@A.ID_DOM_1@A.DT_INI_DOM_1@A.ID_DOM_2@A.DT_INI_DOM_2",
                                "decodeFromTable": "RH_DEF_DOMINIOS_2 A",
                                "desigColumn": "A.DSP_DOM_2",
                                "orderBy": "A.ID_DOM_2",
                                "class": "form-control complexList chosen",
                                "filter": {
                                    "create": ' AND A.DT_FIM_DOM_2 IS NULL', //On-New-Record
                                    "edit": ' AND A.DT_FIM_DOM_2 IS NULL', //On-Edit-Record
                                }
                            }
                        }, {
                            "title": "", //Datatables
                            "label": "", //Editor
                            "data": 'ID_CARACTERISTICA',
                            "name": 'ID_CARACTERISTICA',
                            "exclude": !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["ID_CARACTERISTICA"],
                            "type": "hidden", //Editor
                            "visible": false, //DataTables 
                        }, {
                            "title": "", //Datatables
                            "label": "", //Editor
                            "data": 'DT_INI_CARACTERISTICA',
                            "name": 'DT_INI_CARACTERISTICA',
                            "exclude": !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["DT_INI_CARACTERISTICA"],
                            "type": "hidden", //Editor
                            "visible": false, //DataTables 
                            "datatype": 'date',
                        }, {
                            "complexList": true,
                            "responsivePriority": 6,
                            "title": "<?php echo mb_strtoupper($ui_characteristic,'UTF-8'); ?>",
                            "label": "<?php echo $ui_characteristic; ?>",
                            "data": 'DSP_CARACTERISTICA',
                            "name": 'DSP_CARACTERISTICA',
                            "exclude": !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["EMPRESA"] && !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["ID_TP_CARACT"] && !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["DT_INI_TP_CARACT"] &&
                                       !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["ID_DOM_1"] && !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["DT_INI_DOM_1"] && !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["ID_DOM_2"] &&
                                       !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["DT_INI_DOM_2"] && !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["ID_CARACTERISTICA"] && !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["DT_INI_CARACTERISTICA"],
                            "type": "select",
                            "className": "visibleColumn",
                            "attr": {
                                "dependent-level": 4,
                                "dependent-group": "EMPRESA",
                                "data-db-name": "A.EMPRESA@A.ID_TP_CARACT@A.DT_INI_TP_CARACT@A.ID_DOM_1@A.DT_INI_DOM_1@A.ID_DOM_2@A.DT_INI_DOM_2@A.ID_CARACTERISTICA@A.DT_INI_CARACT",
                                "distribute-value": "EMPRESA@ID_TP_CARACT@DT_INI_TP_CARACT@ID_DOM_1@DT_INI_DOM_1@ID_DOM_2@DT_INI_DOM_2@ID_CARACTERISTICA@DT_INI_CARACTERISTICA",
                                "decodeFromTable": "RH_DEF_CARACTERISTICAS A",
                                "desigColumn": "A.DSP_CARACTERISTICA",
                                "orderBy": "A.ID_CARACTERISTICA",
                                "class": "form-control complexList chosen",
                                "filter": {
                                    "create": ' AND A.DT_FIM_CARACT IS NULL', //On-New-Record
                                    "edit": ' AND A.DT_FIM_CARACT IS NULL', //On-Edit-Record
                                }
                            }
                        }, {
                            "responsivePriority": 7,
                            "title": "<?php echo mb_strtoupper($ui_begin_date,'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_begin_date; ?>", //Editor
                            "data": 'DT_INI',
                            "name": 'DT_INI',
                            "exclude": !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["DT_INI"],
                            "datatype": 'date',
                            "def": hoje(),
                            "className": "visibleColumn",
                            "attr": {
                                "class": "form-control datepicker"
                            }
                        }, {
                            "responsivePriority": 8,
                            "title": "<?php echo mb_strtoupper($ui_end_date,'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_end_date; ?>", //Editor
                            "data": 'DT_FIM',
                            "name": 'DT_FIM',
                            "exclude": !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["DT_FIM"],
                            "datatype": 'date',
                            "def": hoje(),
                            "className": "visibleColumn",
                            "attr": {
                                "class": "form-control datepicker"
                            }
                        }, {
                            "title": "", //Datatables
                            "label": "", //Editor
                            "data": 'ID_EP',
                            "name": 'ID_EP',
                            "exclude": !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["ID_EP"],
                            "type": "hidden",
                            "visible": false,
                            "className": ""
                        }, {
                            "title": "", //Datatables
                            "label": "", //Editor
                            "data": 'DT_INI_EP',
                            "name": 'DT_INI_EP',
                            "exclude": !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["DT_INI_EP"],
                            "type": "hidden",
                            "visible": false,
                            "datatype": 'date'
                        }, {
                            "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                            "title": "<?php echo mb_strtoupper($ui_proficiency_scale,'UTF-8'); ?>",
                            "label": "<?php echo $ui_proficiency_scale; ?>",
                            "data": 'DSP_EP',
                            "name": 'DSP_EP',
                            "exclude": !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["EMPRESA"] && !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["ID_EP"] && !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["DT_INI_EP"],
                            "type": "select",
                            "className": "none visibleColumn",
                            //"renew": true,                    
                            "attr": {
                                "dependent-group": "EMPRESA",
                                "dependent-level": 2,
                                "data-db-name": 'A.EMPRESA@A.ID_EP@A.DT_INI_EP',
                                "decodeFromTable": 'RH_DEF_ESCALAS_PROFICIENCIA A',
                                "desigColumn": "A.DSP_EP",                      
                                "orderBy": "A.ID_EP",
                                "class": "form-control complexList chosen",
                                "filter": {
                                    "create": ' AND A.DT_FIM_EP IS NULL', //On-New-Record
                                    "edit": ' AND A.DT_FIM_EP IS NULL', //On-Edit-Record
                                }
                            }
                        }, {
                            "title": "", //Datatables
                            "label": "", //Editor
                            "data": 'ID_NV_ESCALA',
                            "name": 'ID_NV_ESCALA',
                            "exclude": !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["ID_NV_ESCALA"],
                            "type": "hidden",
                            "visible": false,
                            "className": ""
                        }, {
                            "title": "", //Datatables
                            "label": "", //Editor
                            "data": 'DT_INI_NV_ESCALA',
                            "name": 'DT_INI_NV_ESCALA',
                            "exclude": !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["DT_INI_NV_ESCALA"],
                            "type": "hidden",
                            "visible": false,
                            "datatype": 'date'
                        }, {
                            "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                            "title": "<?php echo mb_strtoupper($ui_proficiency_level,'UTF-8'); ?>",
                            "label": "<?php echo $ui_proficiency_level; ?>",
                            "data": 'DSR_NEP',
                            "name": 'DSR_NEP',
                            "exclude": !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["EMPRESA"] && !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["ID_EP"] && !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["DT_INI_EP"] && !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["ID_NV_ESCALA"] && !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpd"]["DT_INI_NV_ESCALA"],
                            "type": "select",
                            "className": "none visibleColumn",
                            //"renew": true,                    
                            "attr": {
                                "dependent-group": "EMPRESA",
                                "dependent-level": 3,
                                //"deferred": true,
                                "data-db-name": 'A.EMPRESA@A.ID_EP@A.DT_INI_EP@A.ID_NV_ESCALA@A.DT_INI_NV_ESCALA',
                                "decodeFromTable": 'RH_NIVEIS_ESCALA_PROFICIENCIA A',
                                "desigColumn": "NVL(A.DSR_NEP, A.DSP_NEP)", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.                        
                                "orderBy": "A.EMPRESA,A.ID_EP,A.DT_INI_EP,A.ID_NV_ESCALA,A.DT_INI_NV_ESCALA", //usado no complexList.php
                                "class": "form-control complexList chosen",
                                //"disabled": true, //Permite inibir o campo no Editor
                                //"whereClause": "",
                                "filter": {
                                    "create": " AND A.DT_FIM_NV_ESCALA IS NULL", // AND EMPRESA = ':EMPRESA'", //On-New-Record
                                    "edit": " AND A.DT_FIM_NV_ESCALA IS NULL", // AND EMPRESA = ':EMPRESA'", //On-Edit-Record
                                }
                            }
                        }, {
                            "title": "<?php echo mb_strtoupper($ui_description,'UTF-8'); ?>", //Datatables
                            "label": "<?php echo $ui_description; ?>", //Editor
                            "data": 'DESCRICAO',
                            "name": 'DESCRICAO',
                            "exclude": !conf_CADASTRO['RH_ID_CARACTERISTICAS']["rgpdDESCRICAORHID"],
                            "type": 'textarea', //Editor
                            "className": "none visibleColumn",
                            "attr": {
                                "style": "max-width: 355px",
                                "class": "form-control len-355"
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
                            "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions,'UTF-8'); ?>" + '</span>',
                            "label": '',
                            "data": null,
                            "name": 'RECORD_HISTORY',
                            "type": "hidden",
                            "className": "none visibleColumn",
                            "render": function (val, type, row) {
                                return tablesRecordHistory(val, type, row);
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
                                //
                                return RH_ID_CARACTERISTICAS.crudButtons(conf_CADASTRO['RH_ID_CARACTERISTICAS']["crud"][0], conf_CADASTRO['RH_ID_CARACTERISTICAS']["crud"][1], conf_CADASTRO['RH_ID_CARACTERISTICAS']["crud"][2]);
                            }
                        }
                    ],
                    "validations": {
                        "rules": {
                            "DSP_EMPRESA": {
                                required: true,
                            },
                            "DSP_TP_CARACT": {
                                required: true
                            },
                            "DSP_DOM_1": {
                                required: true
                            },
                            "DSP_DOM_2": {
                                required: true
                            },
                            "DSP_CARACTERISTICA": {
                                required: true
                            },
                            "DESCRICAO": {
                                maxlength: 4000
                            },
                            "DT_INI": {
                                required: true,
                                dateISO: true
                            },
                            "DT_FIM": {
                                dateISO: true,
                                dateEqOrNextThan: 'DT_INI'
                            }
                        },
                        //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                        "messages": {
                            "DT_FIM": {
                                dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                            }
                        }
                    }
                };
                RH_ID_CARACTERISTICAS = new QuadTable();
                RH_ID_CARACTERISTICAS.initTable($.extend({}, datatable_instance_defaults, optionRH_ID_CARACTERISTICAS));
            } else {
                $('a[href="#Tab7_1"]').parent('li').remove();
                $('#Tab7_1').remove();                
                //Transfer "ACTIVE" class to FORMACAO
                $('a[href="#Tab7_2"]').parent('li').addClass('active');
                $('#Tab7_2').addClass('active');                    
            }
            //END Características            

            //Formação
            var optionRH_ID_FORMACAO_VIEW = {
                "tableId": "RH_ID_FORMACAO_VIEW",
                "table": "RH_ID_FORMACAO_VIEW",                
                "pk": {
                    "primary": {
                        "RHID": {"type": "number"}
                    }
                },
                "externalFilter": {
                    "templateMulti": {
                        "selector": "#employeeFilter",
                        "mandatory": ['RHID'],
                        "optional": []
                    }
                },
                "order_by": "DT_INI_ACAO DESC",
                "recordBundle": 7,
                "pageLenght": 7,
                "scrollY": "234px",
                "responsive": true,
                "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
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
                        "data": 'RHID',
                        "name": 'RHID',
                        "type": "hidden",
                        "visible": false
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'EMPRESA',
                        "name": 'EMPRESA',
                        "type": "hidden",
                        "visible": false
                    }, {
                        "responsivePriority": 2,
                        "complexList": true,
                        "title": "<?php echo mb_strtoupper($ui_company,'UTF-8'); ?>",
                        "label": "<?php echo $ui_company; ?>",
                        "data": 'DSP_EMPRESA',
                        "name": 'DSP_EMPRESA',
                        "type": "select",
                        "className": "visibleColumn",
                        //"renew": true,
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
                        "data": 'ID_CURSO',
                        "name": 'ID_CURSO',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'TP_REGISTO',
                        "name": 'TP_REGISTO',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'DT_INI_CURSO',
                        "name": 'DT_INI_CURSO',
                        "datatype": 'date',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables                        
                    }, {
                        "responsivePriority": 3,
                        "complexList": true,
                        "title": "<?php echo mb_strtoupper($ui_course,'UTF-8'); ?>",
                        "label": "<?php echo $ui_course; ?>",
                        "data": 'DSP_CURSO',
                        "name": 'DSP_CURSO',
                        "type": "select",
                        "className": "visibleColumn",
                        //"renew": true,
                        "attr": {
                            "dependent-group": "EMPRESA",
                            "dependent-level": 2,
                            "data-db-name": "A.EMPRESA@A.ID_CURSO@A.TP_REGISTO@A.DT_INI_CURSO",
                            "decodeFromTable": "GF_CURSOS A", //TO CHANGE ON QUAD-HCM
                            "desigColumn": "A.DSP_CURSO",
                            "orderBy": "A.ID_CURSO",
                            "class": "form-control complexList chosen",
                        }
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'ID_ACAO',
                        "name": 'ID_ACAO',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "responsivePriority": 4,
                        "complexList": true,
                        "title": "<?php echo mb_strtoupper($ui_training_action,'UTF-8'); ?>",
                        "label": "<?php echo $ui_training_action; ?>",
                        "data": 'DSP_ACAO',
                        "name": 'DSP_ACAO',
                        "type": "select",
                        "className": "visibleColumn",
                        //"renew": true,
                        "attr": {
                            "dependent-group": "EMPRESA",
                            "dependent-level": 3,
                            "data-db-name": "A.EMPRESA@A.ID_CURSO@A.TP_REGISTO@A.DT_INI_CURSO@A.ID_ACAO@A.DT_INI_ACAO",
                            "decodeFromTable": "GF_ACOES A", //TO CHANGE ON QUAD-HCM
                            "desigColumn": "A.DSP_ACAO",
                            "orderBy": "A.ID_ACAO",
                            "class": "form-control complexList chosen",
                        }
                    }, {
                        "responsivePriority": 5,
                        "title": "<?php echo mb_strtoupper($ui_begin_date,'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_begin_date; ?>", //Editor
                        "data": 'DT_INI_ACAO',
                        "name": 'DT_INI_ACAO',
                        "datatype": 'date',
                        "className": "visibleColumn",
                        "attr": {
                            "class": "form-control datepicker"
                        }
                    }, {
                        "responsivePriority": 6,
                        "title": "<?php echo mb_strtoupper($ui_end_date,'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_end_date; ?>", //Editor
                        "data": 'DT_FIM_ACAO',
                        "name": 'DT_FIM_ACAO',
                        "datatype": 'date',
                        "className": "visibleColumn",
                        "attr": {
                            "class": "form-control datepicker"
                        }
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'ID_EP',
                        "name": 'ID_EP',
                        "type": "hidden",
                        "visible": false,
                        "className": ""
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'DT_INI_EP',
                        "name": 'DT_INI_EP',
                        "type": "hidden",
                        "visible": false,
                        "datatype": 'date'
                    }, {
                        "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                        "title": "<?php echo mb_strtoupper($ui_proficiency_scale,'UTF-8'); ?>",
                        "label": "<?php echo $ui_proficiency_scale; ?>",
                        "data": 'DSP_EP',
                        "name": 'DSP_EP',
                        "type": "select",
                        "className": "none visibleColumn",
                        //"renew": true,                    
                        "attr": {
                            "dependent-group": "EMPRESA",
                            "dependent-level": 2,
                            "data-db-name": 'A.EMPRESA@A.ID_EP@A.DT_INI_EP',
                            "decodeFromTable": 'RH_DEF_ESCALAS_PROFICIENCIA A',
                            "desigColumn": "A.DSP_EP",                      
                            "orderBy": "A.ID_EP",
                            "class": "form-control complexList chosen",
                            "filter": {
                                "create": ' AND A.DT_FIM_EP IS NULL', //On-New-Record
                                "edit": ' AND A.DT_FIM_EP IS NULL', //On-Edit-Record
                            }
                        }
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'ID_NV_ESCALA',
                        "name": 'ID_NV_ESCALA',
                        "type": "hidden",
                        "visible": false,
                        "className": ""
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'DT_INI_NV_ESCALA',
                        "name": 'DT_INI_NV_ESCALA',
                        "type": "hidden",
                        "visible": false,
                        "datatype": 'date'
                    }, {
                        "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                        "title": "<?php echo mb_strtoupper($ui_proficiency_level,'UTF-8'); ?>",
                        "label": "<?php echo $ui_proficiency_level; ?>",
                        "data": 'DSR_NEP',
                        "name": 'DSR_NEP',
                        "type": "select",
                        "className": "none visibleColumn",
                        //"renew": true,                    
                        "attr": {
                            "dependent-group": "EMPRESA",
                            "dependent-level": 3,
                            //"deferred": true,
                            "data-db-name": 'A.EMPRESA@A.ID_EP@A.DT_INI_EP@A.ID_NV_ESCALA@A.DT_INI_NV_ESCALA',
                            "decodeFromTable": 'RH_NIVEIS_ESCALA_PROFICIENCIA A',
                            "desigColumn": "NVL(A.DSR_NEP, A.DSP_NEP)", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.                        
                            "orderBy": "A.EMPRESA,A.ID_EP,A.DT_INI_EP,A.ID_NV_ESCALA,A.DT_INI_NV_ESCALA", //usado no complexList.php
                            "class": "form-control complexList chosen",
                            //"disabled": true, //Permite inibir o campo no Editor
                            //"whereClause": "",
                        }
                    }
                ]
            };
            RH_ID_FORMACAO_VIEW = new QuadTable();
            RH_ID_FORMACAO_VIEW.initTable($.extend({}, datatable_instance_defaults, optionRH_ID_FORMACAO_VIEW));
            //END Formação           

            //GE - Avaliação Desempenho (VIEW)
            var optionQUAD_PEOPLE_GE_INDIV = {
                "tableId": "QUAD_PEOPLE_GE_INDIV",
                "table": "QUAD_PEOPLE",
                "selectRecordMsg": "<?php echo $ui_please_select_record .$ui_employee; ?>",
                "pk": {
                    "primary": {
                        "EMPRESA": {"type": "varchar"},
                        "RHID": {"type": "number"},
                        "DT_ADMISSAO": {"type": "date"}
                    }
                },
                "crudOnMasterInactive": {
                    "condition": "data.AV_DESEMPENHO == 'S'",
                    "acl": {
                        "create": false,
                        "update": false,
                        "delete": false
                    }
                },
                "externalFilter": {
                    "templateMulti": {
                        "selector": "#employeeFilter",
                        "mandatory": ['RHID'],
                        "optional": []
                    }
                },
                "detailsObjects": ['RH_COMPETENCIAS_INDIVIDUAIS', 'RH_OBJECTIVOS_INDIVIDUAIS'],
                //"initialWhereClause": " TP_REGISTO = 'A' ", 
                "order_by": "DT_ADMISSAO DESC",
                "recordBundle": 5,
                "pageLenght": 5,
                "scrollY": "117",
                "responsive": true,
                "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
                "tableCols": [
                    {
                        "responsivePriority": 1,
                        "data": null,
                        "className": "control toBottom toCenter",
                        "width": "1%",
                        "defaultContent": ''
                    }, {
                        "title": "RHID", //Datatables
                        "label": "RHID", //Editor
                        "data": 'RHID',
                        "name": 'RHID',
                        "type": "hidden",
                        "visible": false,
                    }, {
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
                        "title": "<?php echo mb_strtoupper($ui_company,'UTF-8'); ?>",
                        "label": "<?php echo $ui_company; ?>",
                        "data": 'DSP_EMPRESA',
                        "name": 'DSP_EMPRESA',
                        "type": "select",
                        "className": "visibleColumn",
                        //"renew": true,
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
                        "title": "<?php echo mb_strtoupper($ui_dt_admission,'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_dt_admission; ?>", //Editor
                        "data": 'DT_ADMISSAO',
                        "name": 'DT_ADMISSAO',
                        "datatype": 'date',
                        "className": "visibleColumn",
                        "attr": {
                            "class": "datepicker"
                        }
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_dt_resignation,'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_dt_resignation; ?>", //Editor
                        "data": 'DT_DEMISSAO',
                        "name": 'DT_DEMISSAO',
                        "datatype": 'date',
                        "className": "visibleColumn",
                        "attr": {
                            "class": "datepicker"
                        }
                    }, {
                        "responsivePriority": 4,
                        "title": "<?php echo mb_strtoupper($ui_active,'UTF-8'); ?>", //Datatables :: Original
                        "label": "<?php echo $ui_active; ?>", //Editor
                        "data": 'ATIVO',
                        "name": 'ATIVO',
                        "type": "select",
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
                    }
                ]
            };
            QUAD_PEOPLE_GE_INDIV = new QuadTable();
            QUAD_PEOPLE_GE_INDIV.initTable($.extend({}, datatable_instance_defaults, optionQUAD_PEOPLE_GE_INDIV));
            //END GE - Avaliação Desempenho (VIEW)

            //Skills
            var optionRH_COMPETENCIAS_INDIVIDUAIS = {
                "tableId": "RH_COMPETENCIAS_INDIVIDUAIS",
                "table": "RH_COMPETENCIAS_INDIVIDUAIS",
                "selectRecordMsg": "<?php echo $ui_please_select_record . $ui_skill; ?>",
                "pk": {
                    "primary": {
                        "EMPRESA": {"type": "varchar"},
                        "RHID": {"type": "number"},
                        "DT_ADMISSAO": {"type": "date"},
                        "ID_COMPETENCIA": {"type": "number"},
                        "DT_INI_COMPETENCIA": {"type": "date"},
                        "DT_INI": {"type": "date"}
                    }
                },
                "dependsOn": {
                    "QUAD_PEOPLE_GE_INDIV": { //External object key mapping( object key : external key)                    
                        "EMPRESA": "EMPRESA",
                        "RHID": "RHID",
                        "DT_ADMISSAO": "DT_ADMISSAO"
                    }
                },
                "crudOnMasterInactive": {
                    "condition": "data.DT_FIM !== null",
                    "acl": {
                        "create": false,
                        "update": false,
                        "delete": false
                    }
                },
                "detailsObjects": ['RH_ID_COMPORTAMENTOS'],
                "order_by": "ID_COMPETENCIA, DT_INI desc",
                "recordBundle": 7,
                "pageLenght": 7,
                "scrollY": "195",
                "responsive": true,
                "pageResize": true, // PLUGIN :: dataTables.pageResize.min.js
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
                        "data": 'EMPRESA',
                        "name": 'EMPRESA',
                        "type": "hidden",
                        "visible": false,
                        "className": "",
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'RHID',
                        "name": 'RHID',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'DT_ADMISSAO',
                        "name": 'DT_ADMISSAO',
                        "datatype": 'date',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'ID_COMPETENCIA',
                        "name": 'ID_COMPETENCIA',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'DT_INI_COMPETENCIA',
                        "name": 'DT_INI_COMPETENCIA',
                        "datatype": 'date',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables                    
                    }, {
                        "responsivePriority": 2,
                        "complexList": true,
                        "title": "<?php echo mb_strtoupper($ui_skill,'UTF-8'); ?>",
                        "label": "<?php echo $ui_skill; ?>",
                        "data": 'DSP_COMPETENCIA',
                        "name": 'DSP_COMPETENCIA',
                        "type": "select",
                        "className": "visibleColumn",
                        //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                        "attr": {
                            "dependent-group": "SKILLS",
                            "dependent-level": 1,
                            "data-db-name": "A.EMPRESA@A.ID_COMPETENCIA@A.DT_INI_COMPETENCIA",
                            "deferred": true,
                            "decodeFromTable": "RH_DEF_COMPETENCIAS A",  //TO CHANGE ON QUAD-HCM
                            "desigColumn": "A.DSP_COMPETENCIA",
                            "orderBy": "A.ID_COMPETENCIA",
                            "class": "form-control complexList chosen",
                            "filter": {
                                "create": " AND A.DT_FIM_COMPETENCIA IS NULL AND A.EMPRESA = ':EMPRESA'", //On-New-Record
                                "edit": " AND A.DT_FIM_COMPETENCIA IS NULL AND A.EMPRESA = ':EMPRESA'", //On-Edit-Record
                            }
                        }
                    }, {
                        "responsivePriority": 4,
                        "title": "<?php echo mb_strtoupper($ui_begin_date,'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_begin_date; ?>", //Editor
                        "data": 'DT_INI',
                        "name": 'DT_INI',
                        "datatype": 'date',
                        "def": "1900-01-01",
                        "className": "visibleColumn",
                        "attr": {
                            "class": "datepicker"
                        }
                    }, {
                        "responsivePriority": 5,
                        "title": "<?php echo mb_strtoupper($ui_weight,'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_weight; ?>", //Editor
                        "data": 'PESO',
                        "name": 'PESO',
                        "className": "visibleColumn right",
                        "attr": {
                            "class": "form-control toRight",
                            "style": "width: 30%;"
                        }
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'ID_EP',
                        "name": 'ID_EP',
                        "type": "hidden",
                        "visible": false,
                        "className": "visibleColumn",
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'DT_INI_EP',
                        "name": 'DT_INI_EP',
                        "datatype": 'date',
                        "type": "hidden",
                        "visible": false,
                        "className": "",
                    }, {
                        "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                        "title": "<?php echo mb_strtoupper($ui_proficiency_scale,'UTF-8'); ?>",
                        "label": "<?php echo $ui_proficiency_scale; ?>",
                        "data": 'DSP_EP',
                        "name": 'DSP_EP',
                        "type": "select",
                        "className": "visibleColumn",
                        //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                        "attr": {
                            "dependent-group": "ESCALA",
                            "dependent-level": 1,
                            "deferred": true,
                            "data-db-name": 'A.EMPRESA@A.ID_EP@A.DT_INI_EP',
                            "decodeFromTable": 'RH_DEF_ESCALAS_PROFICIENCIA A',
                            "desigColumn": "A.DSP_EP", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.                        
                            "orderBy": "A.ID_EP", //usado no complexList.php
                            "class": "form-control complexList chosen",
                            //"disabled": true, //Permite inibir o campo no Editor
                            "filter": {
                                "create": " AND A.DT_FIM_EP IS NULL AND A.EMPRESA = ':EMPRESA'", //On-New-Record
                                "edit": " AND A.DT_FIM_EP IS NULL AND A.EMPRESA = ':EMPRESA'", //On-Edit-Record
                            }
                        }
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'ID_NV_ESCALA',
                        "name": 'ID_NV_ESCALA',
                        "type": "hidden",
                        "visible": false,
                        "className": "visibleColumn",
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'DT_INI_NV_ESCALA',
                        "name": 'DT_INI_NV_ESCALA',
                        "datatype": 'date',
                        "type": "hidden",
                        "visible": false,
                        "className": "",
                    }, {
                        "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                        "title": "<?php echo mb_strtoupper($ui_level_required,'UTF-8'); ?>",
                        "label": "<?php echo $ui_level_required; ?>",
                        "fieldInfo": "<?php echo $ui_performance_evaluation; ?>",
                        "data": 'DSR_NEP',
                        "name": 'DSR_NEP',
                        "type": "select",
                        "className": "visibleColumn",
                        //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                        "attr": {
                            "dependent-group": "ESCALA",
                            "dependent-level": 2,
                            "data-db-name": 'A.EMPRESA@A.ID_EP@A.DT_INI_EP@A.ID_NV_ESCALA@A.DT_INI_NV_ESCALA',
                            "decodeFromTable": 'RH_NIVEIS_ESCALA_PROFICIENCIA A',
                            "desigColumn": "A.DSR_NEP", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.                        
                            "orderBy": "NVL(A.NR_ORD, A.ID_NV_ESCALA)", //usado no complexList.php
                            "class": "form-control complexList chosen",
                            //"disabled": true, //Permite inibir o campo no Editor
                            "filter": {
                                "create": " AND A.DT_FIM_NV_ESCALA IS NULL", //On-New-Record
                                "edit": " AND A.DT_FIM_NV_ESCALA IS NULL", //On-Edit-Record
                            }
                        }

                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'RHID_AVALIADOR',
                        "name": 'RHID_AVALIADOR',
                        "type": "hidden",
                        "visible": false,
                        "className": ""
                    }, {
                        "complexList": true,
                        "title": "<?php echo mb_strtoupper($ui_evaluator,'UTF-8'); ?>",
                        "label": "<?php echo $ui_evaluator; ?>",
                        "fieldInfo": "<?php echo $hint_rhid_responsible_assesment; ?>",
                        "data": 'NOME_REDZ',
                        "name": 'NOME_REDZ',
                        "type": "select",
                        "className": "visibleColumn",
                        //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                                        
                        "attr": {
                            "dependent-group": "COLABS",
                            "dependent-level": 1,
                            "deferred": true,
                            "data-db-name": "A.RHID",
                            "distribute-value": "RHID_AVALIADOR",
                            "decodeFromTable": 'QUAD_NAMES A',
                            "desigColumn": "CONCAT(CONCAT(A.RHID,'-'),A.NOME_REDZ)",
                            "orderBy": "A.RHID",
                            "class": "form-control complexList chosen",
                            ///"disabled": true, //Permite inibir o campo no Editor
                            "filter": {
                                "create": " AND (A.RHID) IN (SELECT F.RHID FROM QUAD_PEOPLE F WHERE F.ATIVO = 'S' AND F.EMPRESA = ':EMPRESA' AND F.RHID != ':RHID')", //On-New-Record
                                //"create": " AND (RHID) IN (SELECT RHID FROM QUAD_PEOPLE WHERE ATIVO = 'S' AND EMPRESA = ':EMPRESA')", //On-New-Record
                                "edit": " AND (A.RHID) IN (SELECT F.RHID FROM QUAD_PEOPLE F WHERE F.ATIVO = 'S' AND F.EMPRESA = ':EMPRESA' AND F.RHID != ':RHID')", //On-Edit-Record
                            }
                        }
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_description,'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_description; ?>", //Editor
                        "data": 'DESCRICAO',
                        "name": 'DESCRICAO',
                        "type": 'textarea', //Editor
                        "className": "none visibleColumn",
                        "attr": {
                            "style": "width: 355px"
                        }
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_end_date,'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_end_date; ?>", //Editor
                        "data": 'DT_FIM',
                        "name": 'DT_FIM',
                        "datatype": 'date',
                        "className": "visibleColumn",
                        "attr": {
                            "class": "datepicker"
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
                        "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions,'UTF-8'); ?>" + '</span>',
                        "label": '',
                        "data": null,
                        "name": 'RECORD_HISTORY',
                        "type": "hidden",
                        "className": "none visibleColumn",
                        "render": function (val, type, row) {
                            return tablesRecordHistory(val, type, row);
                        }
//                    }, {
//                        "responsivePriority": 1,
//                        "data": null,
//                        "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
//                        "name": 'BUTTONS',
//                        "type": "hidden",
//                        "width": "6%",
//                        "className": "toBottom toCenter",
//                        "render": function () {
//                            //
//                            return RH_COMPETENCIAS_INDIVIDUAIS.crudButtons(false, false, false);
//                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "DSP_COMPETENCIA": {
                            required: true,
                            maxlength: 80,
                        },
                        "DT_INI": {
                            required: true,
                            dateISO: true,
                        },
                        "PESO": {
                            required: true,
                            number: true,
                        },
                        "DESCRICAO": {
                            required: false,
                            maxlength: 4000,
                        },
                        "DT_FIM": {
                            dateISO: true,
                            dateEqOrNextThan: 'DT_INI',
                        }
                    },
                    //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                    "messages": {
                        "DT_FIM": {
                            dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                        }
                    }
                }
            };
            RH_COMPETENCIAS_INDIVIDUAIS = new QuadTable();
            RH_COMPETENCIAS_INDIVIDUAIS.initTable($.extend({}, datatable_instance_defaults, optionRH_COMPETENCIAS_INDIVIDUAIS));
            //END Skills

            //Behaviors
            var optionRH_ID_COMPORTAMENTOS = {
                "tableId": "RH_ID_COMPORTAMENTOS",
                "table": "RH_ID_COMPORTAMENTOS",
                "pk": {
                    "primary": {
                        "EMPRESA": {"type": "varchar"},
                        "RHID": {"type": "number"},
                        "DT_ADMISSAO": {"type": "date"},
                        "ID_COMPETENCIA": {"type": "number"},
                        "DT_INI_COMPETENCIA": {"type": "date"},
                        "DT_INI": {"type": "date"},
                        "ID_COMPORTAMENTO": {"type": "number"},
                        "DT_INI_COMPORTAMENTO": {"type": "date"},
                        "DT_INI_CC": {"type": "date"}
                    }
                },
                "dependsOn": {
                    "RH_COMPETENCIAS_INDIVIDUAIS": { //External object key mapping( object key : external key)                    
                        "EMPRESA": "EMPRESA",
                        "RHID": "RHID",
                        "DT_ADMISSAO": "DT_ADMISSAO",
                        "ID_COMPETENCIA": "ID_COMPETENCIA",
                        "DT_INI_COMPETENCIA": "DT_INI_COMPETENCIA",
                        "DT_INI": "DT_INI"
                    }
                },
                "order_by": "EMPRESA, ID_COMPORTAMENTO, DT_INI_COMPORTAMENTO desc",
                "recordBundle": 7,
                "pageLenght": 7,
                "scrollY": "195",
                "responsive": true,
                "pageResize": true, // PLUGIN :: dataTables.pageResize.min.js
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
                        "data": 'EMPRESA',
                        "name": 'EMPRESA',
                        "type": "hidden",
                        "visible": false,
                        "className": "",
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'RHID',
                        "name": 'RHID',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'DT_ADMISSAO',
                        "name": 'DT_ADMISSAO',
                        "datatype": 'date',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'ID_COMPETENCIA',
                        "name": 'ID_COMPETENCIA',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'DT_INI_COMPETENCIA',
                        "name": 'DT_INI_COMPETENCIA',
                        "datatype": 'date',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'DT_INI',
                        "name": 'DT_INI',
                        "datatype": 'date',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'ID_COMPORTAMENTO',
                        "name": 'ID_COMPORTAMENTO',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'DT_INI_COMPORTAMENTO',
                        "name": 'DT_INI_COMPORTAMENTO',
                        "datatype": 'date',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables                      
                    }, {
                        "responsivePriority": 2,
                        "complexList": true,
                        "title": "<?php echo mb_strtoupper($ui_behavior,'UTF-8'); ?>",
                        "label": "<?php echo $ui_behavior; ?>",
                        "data": 'DSP_COMPORTAMENTO',
                        "name": 'DSP_COMPORTAMENTO',
                        "type": "select",
                        "className": "visibleColumn",
                        //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                        "attr": {
                            "dependent-group": "BEHAVIOR",
                            "dependent-level": 1,
                            "data-db-name": "A.EMPRESA@A.ID_COMPETENCIA@A.DT_INI_COMPETENCIA@A.ID_COMPORTAMENTO@A.DT_INI_COMPORTAMENTO",
                            "otherValues": "A.DESCRICAO", //RETURNS data['OTHERVALUES']
                            "deferred": true,
                            "decodeFromTable": "RH_DEF_COMPORTAMENTOS A",  //TO CHANGE ON QUAD-HCM
                            "desigColumn": "A.DSP_COMPORTAMENTO",
                            "orderBy": "A.ID_COMPORTAMENTO",
                            "class": "form-control complexList chosen",
                            "filter": {
                                "create": " AND A.DT_FIM IS NULL AND A.EMPRESA = ':EMPRESA' AND A.ID_COMPETENCIA = ':ID_COMPETENCIA'", //On-New-Record
                                "edit": " AND A.DT_FIM IS NULL AND A.EMPRESA = ':EMPRESA' AND A.ID_COMPETENCIA = ':ID_COMPETENCIA'", //On-Edit-Record
                            }
                        }
                    }, {
                        "responsivePriority": 3,
                        "title": "<?php echo mb_strtoupper($ui_begin_date,'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_begin_date; ?>", //Editor
                        "data": 'DT_INI_CC',
                        "name": 'DT_INI_CC',
                        "datatype": 'date',
                        "def": "1900-01-01",
                        "className": "visibleColumn",
                        "attr": {
                            "class": "datepicker"
                        }
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'ID_EP',
                        "name": 'ID_EP',
                        "type": "hidden",
                        "visible": false,
                        "className": "visibleColumn",
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'DT_INI_EP',
                        "name": 'DT_INI_EP',
                        "datatype": 'date',
                        "type": "hidden",
                        "visible": false,
                        "className": "",
                    }, {
                        "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                        "title": "<?php echo mb_strtoupper($ui_proficiency_scale,'UTF-8'); ?>",
                        "label": "<?php echo $ui_proficiency_scale; ?>",
                        "data": 'DSP_EP',
                        "name": 'DSP_EP',
                        "type": "select",
                        "className": "visibleColumn",
                        //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                        "attr": {
                            "dependent-group": "ESCALA",
                            "dependent-level": 1,
                            "deferred": true,
                            "data-db-name": 'A.EMPRESA@A.ID_EP@A.DT_INI_EP',
                            "decodeFromTable": 'RH_DEF_ESCALAS_PROFICIENCIA A',
                            "desigColumn": "A.DSP_EP", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.                        
                            "orderBy": "A.ID_EP", //usado no complexList.php
                            "class": "form-control complexList chosen",
                            //"disabled": true, //Permite inibir o campo no Editor
                            "filter": {
                                "create": " AND A.DT_FIM_EP IS NULL AND A.EMPRESA = ':EMPRESA'", //On-New-Record
                                "edit": " AND A.DT_FIM_EP IS NULL AND A.EMPRESA = ':EMPRESA'", //On-Edit-Record
                            }
                        }
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'ID_NV_ESCALA',
                        "name": 'ID_NV_ESCALA',
                        "type": "hidden",
                        "visible": false,
                        "className": "visibleColumn",
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'DT_INI_NV_ESCALA',
                        "name": 'DT_INI_NV_ESCALA',
                        "datatype": 'date',
                        "type": "hidden",
                        "visible": false,
                        "className": "",
                    }, {
                        "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                        "title": "<?php echo mb_strtoupper($ui_level_required,'UTF-8'); ?>",
                        "label": "<?php echo $ui_level_required; ?>",
                        "fieldInfo": "<?php echo $ui_performance_evaluation; ?>",
                        "data": 'DSR_NEP',
                        "name": 'DSR_NEP',
                        "type": "select",
                        "className": "visibleColumn",
                        //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                        "attr": {
                            "dependent-group": "ESCALA",
                            "dependent-level": 2,
                            "data-db-name": 'A.EMPRESA@A.ID_EP@A.DT_INI_EP@A.ID_NV_ESCALA@A.DT_INI_NV_ESCALA',
                            "decodeFromTable": 'RH_NIVEIS_ESCALA_PROFICIENCIA A',
                            "desigColumn": "A.DSR_NEP", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.                        
                            "orderBy": "NVL(A.NR_ORD, A.ID_NV_ESCALA)", //usado no complexList.php
                            "class": "form-control complexList chosen",
                            //"disabled": true, //Permite inibir o campo no Editor
                            "filter": {
                                "create": " AND A.DT_FIM_NV_ESCALA IS NULL", //On-New-Record
                                "edit": " AND A.DT_FIM_NV_ESCALA IS NULL", //On-Edit-Record
                            }
                        }
                    }, {
                        "responsivePriority": 4,
                        "title": "<?php echo mb_strtoupper($ui_weight,'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_weight; ?>", //Editor
                        "data": 'PESO',
                        "name": 'PESO',
                        "className": "visibleColumn right",
                        "attr": {
                            "class": "form-control toRight",
                            "style": "width: 30%;"
                        }
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_description,'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_description; ?>", //Editor
                        "data": 'DESCRICAO',
                        "name": 'DESCRICAO',
                        "type": 'textarea', //Editor
                        "className": "none visibleColumn",
                        "attr": {
                            "style": "width: 355px"
                        }
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_end_date,'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_end_date; ?>", //Editor
                        "data": 'DT_FIM_CC',
                        "name": 'DT_FIM_CC',
                        "datatype": 'date',
                        "className": "visibleColumn",
                        "attr": {
                            "class": "datepicker"
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
                        "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions,'UTF-8'); ?>" + '</span>',
                        "label": '',
                        "data": null,
                        "name": 'RECORD_HISTORY',
                        "type": "hidden",
                        "className": "none visibleColumn",
                        "render": function (val, type, row) {
                            return tablesRecordHistory(val, type, row);
                        }
//                    }, {
//                        "responsivePriority": 1,
//                        "data": null,
//                        "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
//                        "name": 'BUTTONS',
//                        "type": "hidden",
//                        "width": "6%",
//                        "className": "toBottom toCenter",
//                        "render": function () {
//                            //
//                            return RH_ID_COMPORTAMENTOS.crudButtons(false, false, false);
//                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "DSP_COMPORTAMENTO": {
                            required: true
                        },
                        "DT_INI_CC": {
                            required: true,
                            dateISO: true,
                        },
                        "PESO": {
                            number: true,
                        },
                        "DSP_EP": {
                            required: true
                        },
                        "DSR_NEP": {
                            required: true
                        },
                        "DESCRICAO": {
                            required: false,
                            maxlength: 4000,
                        },
                        "DT_FIM_CC": {
                            dateISO: true,
                            dateEqOrNextThan: 'DT_INI_CC',
                        }
                    },
                    //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                    "messages": {
                        "DT_FIM_CC": {
                            dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                        }
                    }
                }
            };
            RH_ID_COMPORTAMENTOS = new QuadTable();
            RH_ID_COMPORTAMENTOS.initTable($.extend({}, datatable_instance_defaults, optionRH_ID_COMPORTAMENTOS));
            //END Behaviors 

            //Objectives
            var optionRH_OBJECTIVOS_INDIVIDUAIS = {
                "tableId": "RH_OBJECTIVOS_INDIVIDUAIS",
                "table": "RH_OBJECTIVOS_INDIVIDUAIS",
                "pk": {
                    "primary": {
                        "EMPRESA": {"type": "varchar"},
                        "RHID": {"type": "number"},
                        "DT_ADMISSAO": {"type": "date"},
                        "ID_OBJECTIVO": {"type": "number"},
                        "DT_INI_OBJECTIVO": {"type": "date"},
                        "DT_INI_OI": {"type": "date"}
                    }
                },
                "dependsOn": {
                    "QUAD_PEOPLE_GE_INDIV": { //External object key mapping( object key : external key)                    
                        "EMPRESA": "EMPRESA",
                        "RHID": "RHID",
                        "DT_ADMISSAO": "DT_ADMISSAO"
                    }
                },
                "order_by": "ID_OBJECTIVO, DT_INI_OI desc",
                "recordBundle": 7,
                "pageLenght": 7,
                "scrollY": "195",
                "responsive": true,
                "pageResize": true, //PLUGIN :: dataTables.pageResize.min.js
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
                        "data": 'EMPRESA',
                        "name": 'EMPRESA',
                        "type": "hidden",
                        "visible": false,
                        "className": "",
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'RHID',
                        "name": 'RHID',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'DT_ADMISSAO',
                        "name": 'DT_ADMISSAO',
                        "datatype": 'date',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'ID_OBJECTIVO',
                        "name": 'ID_OBJECTIVO',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'DT_INI_OBJECTIVO',
                        "name": 'DT_INI_OBJECTIVO',
                        "datatype": 'date',
                        "type": "hidden", //Editor
                        "visible": false, //DataTables                    
                    }, {
                        "responsivePriority": 2,
                        "complexList": true,
                        "title": "<?php echo mb_strtoupper($ui_objective,'UTF-8'); ?>",
                        "label": "<?php echo $ui_objective; ?>",
                        "data": 'DSP_OBJECTIVO',
                        "name": 'DSP_OBJECTIVO',
                        "type": "select",
                        "className": "visibleColumn",
                        //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                        "attr": {
                            "dependent-group": "SKILLS",
                            "dependent-level": 1,
                            "data-db-name": "A.EMPRESA@A.ID_OBJECTIVO@A.DT_INI_OBJECTIVO",
                            "deferred": true,
                            "decodeFromTable": "RH_DEF_OBJECTIVOS A",  //TO CHANGE ON QUAD-HCM
                            "desigColumn": "A.DSP_OBJECTIVO",
                            "orderBy": "A.ID_OBJECTIVO",
                            "class": "form-control complexList chosen",
                            "filter": {
                                "create": " AND A.DT_FIM IS NULL AND A.EMPRESA = ':EMPRESA'", //On-New-Record
                                "edit": " AND A.DT_FIM IS NULL AND A.EMPRESA = ':EMPRESA'", //On-Edit-Record
                            }
                        }
                    }, {
                        "responsivePriority": 3,
                        "title": "<?php echo mb_strtoupper($ui_begin_date,'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_begin_date; ?>", //Editor
                        "data": 'DT_INI_OI',
                        "name": 'DT_INI_OI',
                        "datatype": 'date',
                        "def": "1900-01-01",
                        "className": "visibleColumn",
                        "attr": {
                            "class": "datepicker"
                        }
                    }, {
                        "responsivePriority": 4,
                        "title": "<?php echo mb_strtoupper($ui_weight,'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_weight; ?>", //Editor
                        "data": 'PESO',
                        "name": 'PESO',
                        "className": "visibleColumn right",
                        "attr": {
                            "class": "form-control toRight",
                            "style": "width: 30%;"
                        }
                    }, {
                        "responsivePriority": 5,
                        "title": "<?php echo mb_strtoupper($ui_required_value,'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_required_value; ?>", //Editor
                        "data": 'VALOR_REQUERIDO',
                        "name": 'VALOR_REQUERIDO',
                        "className": "visibleColumn right",
                        "attr": {
                            "class": "form-control toRight",
                            "style": "width: 30%;"
                        }
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'ID_EP',
                        "name": 'ID_EP',
                        "type": "hidden",
                        "visible": false,
                        "className": "visibleColumn",
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'DT_INI_EP',
                        "name": 'DT_INI_EP',
                        "datatype": 'date',
                        "type": "hidden",
                        "visible": false,
                        "className": "",
                    }, {
                        "responsivePriority": 6,
                        "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                        "title": "<?php echo mb_strtoupper($ui_proficiency_scale,'UTF-8'); ?>",
                        "label": "<?php echo $ui_proficiency_scale; ?>",
                        "data": 'DSP_EP',
                        "name": 'DSP_EP',
                        "type": "select",
                        "className": "visibleColumn",
                        //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                        "attr": {
                            "dependent-group": "ESCALA",
                            "dependent-level": 1,
                            "deferred": true,
                            "data-db-name": 'A.EMPRESA@A.ID_EP@A.DT_INI_EP',
                            "decodeFromTable": 'RH_DEF_ESCALAS_PROFICIENCIA A',
                            "desigColumn": "A.DSP_EP", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.                        
                            "orderBy": "A.ID_EP", //usado no complexList.php
                            "class": "form-control complexList chosen",
                            //"disabled": true, //Permite inibir o campo no Editor
                            "filter": {
                                "create": " AND A.DT_FIM_EP IS NULL AND A.EMPRESA = ':EMPRESA'", //On-New-Record
                                "edit": " AND A.DT_FIM_EP IS NULL AND A.EMPRESA = ':EMPRESA'", //On-Edit-Record
                            }
                        }
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'ID_NV_ESCALA',
                        "name": 'ID_NV_ESCALA',
                        "type": "hidden",
                        "visible": false,
                        "className": "visibleColumn",
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'DT_INI_NV_ESCALA',
                        "name": 'DT_INI_NV_ESCALA',
                        "datatype": 'date',
                        "type": "hidden",
                        "visible": false,
                        "className": "",
                    }, {
                        "responsivePriority": 7,
                        "complexList": true, //use for complex lists, dont forget the attr.data-db-name with external keys
                        "title": "<?php echo mb_strtoupper($ui_level_required,'UTF-8'); ?>",
                        "label": "<?php echo $ui_level_required; ?>",
                        "fieldInfo": "<?php echo $ui_performance_evaluation; ?>",
                        "data": 'DSR_NEP',
                        "name": 'DSR_NEP',
                        "type": "select",
                        "className": "visibleColumn",
                        //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                    
                        "attr": {
                            "dependent-group": "ESCALA",
                            "dependent-level": 2,
                            "data-db-name": 'A.EMPRESA@A.ID_EP@A.DT_INI_EP@A.ID_NV_ESCALA@A.DT_INI_NV_ESCALA',
                            "decodeFromTable": 'RH_NIVEIS_ESCALA_PROFICIENCIA A',
                            "desigColumn": "A.DSR_NEP", // same name as the hidden column when "data-db-name": isn't composed. "name" of column when key is compose.                        
                            "orderBy": "NVL(A.NR_ORD, A.ID_NV_ESCALA)", //usado no complexList.php
                            "class": "form-control complexList chosen",
                            //"disabled": true, //Permite inibir o campo no Editor
                            "filter": {
                                "create": " AND A.DT_FIM_NV_ESCALA IS NULL", //On-New-Record
                                "edit": " AND A.DT_FIM_NV_ESCALA IS NULL", //On-Edit-Record
                            }
                        }
                    }, {
                        "title": "", //Datatables
                        "label": "", //Editor
                        "data": 'RHID_AVALIADOR',
                        "name": 'RHID_AVALIADOR',
                        "type": "hidden",
                        "visible": false,
                        "className": ""
                    }, {
                        "responsivePriority": 8,
                        "complexList": true,
                        "title": "<?php echo mb_strtoupper($ui_rhid,'UTF-8'); ?>",
                        "label": "<?php echo $ui_rhid; ?>",
                        "fieldInfo": "<?php echo $hint_rhid_responsible_assesment; ?>",
                        "data": 'NOME_REDZ',
                        "name": 'NOME_REDZ',
                        "type": "select",
                        "className": "visibleColumn",
                        //"renew": true, //FORÇA A POPULAÇÃO DA LISTA NO LANDING E NOS FILTROS (CREATE e EDIT). NA PESQUISA USA O DO LANDING...                                        
                        "attr": {
                            "dependent-group": "COLABS",
                            "dependent-level": 1,
                            "deferred": true,
                            "data-db-name": 'A.RHID',
                            "distribute-value": "RHID_AVALIADOR",
                            "decodeFromTable": 'QUAD_NAMES A',
                            "desigColumn": "CONCAT(CONCAT(A.RHID,'-'),A.NOME_REDZ)",
                            "orderBy": "A.RHID",
                            "class": "form-control complexList chosen",
                            ///"disabled": true, //Permite inibir o campo no Editor
                            "filter": {
                                "create": " AND (A.RHID) IN (SELECT F.RHID FROM QUAD_PEOPLE F WHERE F.ATIVO = 'S' AND F.EMPRESA = ':EMPRESA' AND F.RHID != ':RHID')", //On-New-Record
                                //"create": " AND (RHID) IN (SELECT RHID FROM QUAD_PEOPLE WHERE ATIVO = 'S' AND EMPRESA = ':EMPRESA')", //On-New-Record
                                "edit": " AND (A.RHID) IN (SELECT F.RHID FROM QUAD_PEOPLE F WHERE F.ATIVO = 'S' AND F.EMPRESA = ':EMPRESA' AND F.RHID != ':RHID')", //On-Edit-Record
                            }
                        }
                    }, {
                        "title": "<?php echo mb_strtoupper($ui_description,'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_description; ?>", //Editor
                        "data": 'DESCRICAO',
                        "name": 'DESCRICAO',
                        "type": 'textarea', //Editor
                        "className": "none visibleColumn",
                        "attr": {
                            "style": "width: 355px"
                        }
                    }, {
                        "responsivePriority": 9,
                        "title": "<?php echo mb_strtoupper($ui_end_date,'UTF-8'); ?>", //Datatables
                        "label": "<?php echo $ui_end_date; ?>", //Editor
                        "data": 'DT_FIM_OI',
                        "name": 'DT_FIM_OI',
                        "datatype": 'date',
                        "className": "visibleColumn",
                        "attr": {
                            "class": "datepicker"
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
                        "title": '<span class="timelogTitle">' + "<?php echo mb_strtoupper($ui_record_interventions,'UTF-8'); ?>" + '</span>',
                        "label": '',
                        "data": null,
                        "name": 'RECORD_HISTORY',
                        "type": "hidden",
                        "className": "none visibleColumn",
                        "render": function (val, type, row) {
                            return tablesRecordHistory(val, type, row);
                        }
//                    }, {
//                        "responsivePriority": 1,
//                        "data": null,
//                        "title": '<button class="btn btn-xs btn-success tblCreateBut"><i class="fas fa-plus fa-xs"></i></button>',
//                        "name": 'BUTTONS',
//                        "type": "hidden",
//                        "width": "6%",
//                        "className": "toBottom toCenter",
//                        "render": function () {
//                            //
//                            return RH_OBJECTIVOS_INDIVIDUAIS.crudButtons(false, false, false);
//                        }
                    }
                ],
                "validations": {
                    "rules": {
                        "DSP_OBJECTIVO": {
                            required: true
                        },
                        "DT_INI_OI": {
                            required: true,
                            dateISO: true,
                        },
                        "PESO": {
                            required: false,
                            number: true,
                        },
                        "VALOR_REQUERIDO": {
                            required: false,
                            number: true,
                        },
                        "DESCRICAO": {
                            required: false,
                            maxlength: 4000,
                        },
                        "DT_FIM_OI": {
                            dateISO: true,
                            dateEqOrNextThan: 'DT_INI_OI',
                        }
                    },
                    //As mensagens aqui definidas sobrepõem-se às definidas em /inc/scripts.phpp
                    "messages": {
                        "DT_FIM_OI": {
                            dateEqOrNextThan: "<?php echo $error_end_dt_greater; ?>"
                        }
                    }
                }
            };
            RH_OBJECTIVOS_INDIVIDUAIS = new QuadTable();
            RH_OBJECTIVOS_INDIVIDUAIS.initTable($.extend({}, datatable_instance_defaults, optionRH_OBJECTIVOS_INDIVIDUAIS));
            //END Objectives

            //GC_ID_DOMINIOS
        }
        //END OTHER TABLES

        //CODE : RHID Filter
        //CODE : RHID Filter
        if (1 === 1) {
            var getMasterFilterData = function (filters, formData) {
                var el = $("#xt_RHID");
                var elChosen = "#"+el.attr("id") + "_chosen";
                $(elChosen).addClass("loadingList");
                if (formData) {
                    el.append($('<option>', {
                        value: formData.RHID,
                        text: formData.RHID + "-" + formData.NOME
                    }));
                    el.trigger("chosen:updated");
                    el.val(formData.RHID);
                    el.trigger("mouseover");
                    el.trigger("change");
                    $(elChosen).removeClass("loadingList");
                    el.removeClass("loadingList");
                    return;
                }

                var params = {};
                //first roudtrip without filters
                if (!filters) {
                    params = {
                        pk: "RHID",
                        table: "RH_IDENTIFICACOES",
                        where: filter_where,
                        orderBy: "RHID",
                        desigColumn: "CONCAT(CONCAT(RHID,'-'),NOME)",
                        //otherValues: "EMPRESA@RHID@DT_ADMISSAO@DSP_SITUACAO" //not used at the moment
                        //todo problema concat NULL https://makandracards.com/makandra/825-mysql-concat-with-null-fields
                    }
                    var promise = $.ajax({
                        type: "POST",
                        url: "data-source/complexLists.php",
                        data: {lists: [params], multiRequest: false},
                        dataType: "text",
                        cache: false,
                        async: true,
                        beforeSend: function () {
                           // el.addClass("loadingList");
                        }
                    });
                } else { //form with filters submited...
                    var promise = $.ajax({
                        type: "POST",
                        url: "data-source/myfilterscontroller.php",
                        data: filters,
                        dataType: "text",
                        cache: false,
                        async: true,
                        beforeSend: function () {
                            //el.addClass("loadingList");
                        }
                    });
                }

                $.when(promise).then(function (data) {
                    var dat = JSON.parse(data);

                    if (dat["data"][0].length > 0) { //if results  fill dropdown etc.
                        var output = [];
                        output.push("<option> </option>");
                        _.map(dat["data"][0], function (ob, index) {
                            var oValues = ob["OTHERVALUES"]
                                ? 'data-otherValues="' + ob["OTHERVALUES"] + '"'
                                : "", unique = 'select';
                            if (dat["data"][0].length === 1) {
                                output.push(
                                    '<option value="' +
                                    ob.VAL +
                                    '" ' +
                                    oValues +
                                    " selected='selected'>" +
                                    ob[Object.keys(ob)[0]] +
                                    "</option>"
                                );
                            } else {
                                output.push(
                                    '<option value="' +
                                    ob.VAL +
                                    '" ' +
                                    oValues +
                                    ">" +
                                    ob[Object.keys(ob)[0]] +
                                    "</option>"
                                );
                            }
                        });
                        el.html(output.join(""));

                        var options = {
                            no_results_text: "_RESULTS_VARIABLE",
                            placeholder_text_single: " ",
                            allow_single_deselect: true,
                            search_contains: true
                        };
                        //FORCE HOVER on CHOSEN
                        el.hover(function () {
                            el.chosen(options);
                            el.trigger("chosen:updated");
                        });
                        el.trigger("mouseover");
                        $(elChosen).removeClass("loadingList");
                        el.removeClass("loadingList");
                        //JUST ONE RHID :: DISABLES LOV :: AUTO-QUERY
                        if (dat["data"][0].length === 1) {
                            $('.widget-body-toolbar').css('display', 'none');
                            $('.row.master-content').css("margin-top", '-60px');
                            el.attr('disabled', true);
                            el.trigger("chosen:updated");
                            $("#xt_RHID").trigger('change');
                        }
                    } else { //no results ...show create button
                        $("#RH_IDENTIFICACOES").find("a[data-form-action=new]").show();
                    }
                    $(elChosen).removeClass("loadingList");
                    el.removeClass("loadingList");
                });

            };
            //first call to fill employee list
            getMasterFilterData(null);
            RH_IDENTIFICACOES.acl();
            
            //Adv. Filter MODAL Open
            $(document).on("click", ".masterFilter", function (e) {
                e.preventDefault();
                if ($("#masterFilterModal", document).length === 0) {

                    var filtersForm = `<form id="masterFilterForm" action="data-source/myfiltercontroller.php ">
                                       foo<input name="foo"/>
                                       bar<input name="bar"/>
                                      </form>`;

                    var m =
                        `<div id="masterFilterModal" class="modal fade" role="dialog">
                            <div class="modal-dialog"><div class="modal-content"><div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title ">Filtros

                            </h4>
                            </div><div class="modal-body">
                            ${filtersForm}

                            </div><div class="modal-footer">
                            <button id="saveFilters" type="button" class="btn btn-default" data-dismiss="modal">
                            ${JS_SAVE}
                             </button>
                            </div> </div> </div> </div>`;
                    $(m).appendTo(document.body);
                }
                $("#masterFilterModal").modal("toggle");
            });

            //Adv. Filter MODAL EXECUTE
            $(document).on("click", "#saveFilters", function (evt) {
                getMasterFilterData(RH_IDENTIFICACOES.getNormalizedFrmData($("#masterFilterForm")));
            });

            //Change Employee :: MASTER RHID             
            $("#employeeFilter").on("change", ":input", function (evt) {
                //LIMPAR DADOS
                var rhid_ = $(this).val();

                $("xt_DSP_FF").val("");
                for (var key in window) {
                    var obj = window[key];
                    if (obj instanceof QuadTable && $.fn.DataTable.isDataTable("#" + obj.tableId)) {
                        if (obj.externalFilter && $(obj.externalFilter.templateMulti.selector).hasClass("multiInstance")) {
                            if (!rhid_) {
                                delete obj.sFilters; //USER-TAGS from previous Adv. Queries
                                delete obj.qFilters; //SQL-TAGS (WHERE CLAUSE) from previous Adv. Queries
                                obj.resetData(true);
                                obj.tbl.clear();
                                obj.clearTable();
                                obj.startIn = 0;
                                var dtEmpty =
                                    '<tr class="odd"><td valign="top" colspan="100%" class="dataTables_empty">' +
                                    JS_NO_RECORDS_FOUND +
                                    "</td></tr>";
                                $("#" + obj.tableId + " tbody").append(dtEmpty);
                                $("#" + obj.tableId + "_wrapper th:last-child").find(".tblCreateBut").hide();
                                $(window).trigger("resize");
                                obj.recursiveReset(obj);
                            } else {
                                obj.where_str = "";
                                $("#" + obj.tableId + "_wrapper th:last-child").find(".tblCreateBut").show();
                                //obj.multiInstanceFilter($(this));
                                $(window).trigger("resize");
                            }
                        }
                    } else if (obj instanceof QuadForm) {
                        if (obj.externalFilter && $(obj.externalFilter.templateMulti.selector).hasClass("multiInstance")) {
                            if (!rhid_) {
                                $(".docsViewer", RH_IDENTIFICACOES.formId)
                                    .find(".remove,.undo,.carrega")
                                    .remove();
                                $(".docsViewer", RH_IDENTIFICACOES.formId).removeClass("dropzone");
                                $("." + RH_IDENTIFICACOES.formId.substring(1) + "_spinner").hide();
                                delete obj.sFilters;
                                delete obj.qFilters;
                                obj.resetData(true);
                                obj.clearForm(obj.formId);
                                obj.clearWorkFlow(obj.formId);
                                obj.masterDetail(obj);
                                obj.resetButtonsState(obj.formId, 0, null);
                                getMasterFilterData();
                                if (obj.formId === "#RH_IDENTIFICACOES") {

                                            
                                    setTimeout(function () {
                                        if (conf_CADASTRO['RH_IDENTIFICACOES']["crud"][0]) { //Insert ALLOWED
                                            $("#RH_IDENTIFICACOES")
                                                .find("" + "a[data-form-action=new]")
                                                .show();
                                        }                                        
                                    }, 1000);
                                }                                
                                //Acrescentado por PMA
                                //obj.workMode(obj.formId,'standby');

                                setTimeout(function () {
                                    RH_IDENTIFICACOES.manageWorkflow(null, RH_IDENTIFICACOES.formId,_.remove(RH_IDENTIFICACOES["wkf"],{OPERACAO:"UPDATE"}));

                                    $(RH_IDENTIFICACOES.formId)
                                        .find("a[data-form-action=new]")
                                        .show();
                                    $(RH_IDENTIFICACOES.formId)
                                        .find("a[data-form-action=edit]")
                                        .hide();
                                }, 1000);

                            } else {
                                obj.where_str = "";
                                /*
                                if (obj.formId === "#RH_IDENTIFICACOES") {
                                    obj.multiInstanceFilter($(this), false); // If its RH_IDENTIFICACOES code is syncronous                                    
                                } else {
                                    obj.multiInstanceFilter($(this), true);
                                }
                                */
                                $("#RH_IDENTIFICACOES")
                                    .find("" + "a[data-form-action=new]")
                                    .hide();
                            }
                        }
                        //obj.acl(); //CRUD
                    }                    
                }
                
                //Se Filtro estiver "LIMPO" e o user puder INSERIR ACTIVA BOTÃO DE CREATE
                /*setTimeout ( function(){
                    if (!$(this).val() && conf_CADASTRO['RH_IDENTIFICACOES']["crud"][0]) {
                        $("#RH_IDENTIFICACOES").find("a[data-form-action=new]").css('display','inline-block');
                    }                
                },0);*/
                //todo led
                setTimeout(function () {
                    if (!rhid_) {
                        $("#testeVideo").remove();
                        $("#photograph").show();
                    }
                }, 1000);
            });

            $("a[data-form-action=save]", RH_IDENTIFICACOES.formId).on("updateFilter", function (e) {
                var frmData = RH_IDENTIFICACOES.getNormalizedFrmData($(RH_IDENTIFICACOES.formId));
                RH_IDENTIFICACOES.clearForm(RH_IDENTIFICACOES.formId);
                getMasterFilterData(null, frmData);
                $("." + RH_IDENTIFICACOES.formId.substring(1) + "_spinner").hide();
            });

            //USE Othervalues USE ... USA Othervalues USA ... <- search tags >
            //Se a Hab. Profissional tiver Escala atribuída, atribui-a ao registo no editor e coloca-a como DISABLED
            $(document).on('RH_ID_HABS_PROFISSIONAISAttachEvt', function (e) {
                $('#DTE_Field_DSP_HAB_PROF').on('change', function (event) {
                    setTimeout(function () {
                        if ($("#DTE_Field_DSP_HAB_PROF").val()) {
                            var othervalue = $("#DTE_Field_DSP_HAB_PROF").children("option:selected").data("othervalues");
                            $("#DTE_Field_DSP_EP").val(othervalue)
                                .trigger('change')
                                .prop('disabled', true)
                                .trigger("chosen:updated");
                            $("#DTE_Field_DSP_EP").next(".chosen-container").removeClass("loadingList");
                        }

                    }, 500);
                });
            });
            
        }
        //END CODE : RHID Filter

        //CODE
        if (1 === 1) {
            //Setores
            $(document).on('RH_ID_SETORESAttachEvt', function (e) {
                var operacao = RH_ID_SETORES.editor.s["action"],
                    masterRecord = RH_ID_EMPRESAS.tbl.row('.selected').data();
                if (operacao === "create") {
                    //SET DEFAULT VALUE FOR CHOSEN :: ESTAB
                    if (masterRecord['EMPRESA'] !== '' && masterRecord['CD_ESTAB'] !== '') {
                        setTimeout(function () {
                            $(document).find('#DTE_Field_DSP_ESTAB','RH_ID_SETORES_editorForm')
                                .val(masterRecord['EMPRESA'] + '@' + masterRecord['CD_ESTAB'])
                                .trigger('change')
                                .prop('disabled', true)
                                .trigger("chosen:updated");
                        }, 200);
                    } else {
                        RH_ID_SETORES.editor.close();
                        quad_notification_clear();
                        quad_notification({
                            type: "warning",
                            title : JS_OPERATION_ABORT,
                            content: "<?php echo $msg_no_estab_no_sector; ?>",
                            timeout : 5000
                        });
                    }
                }
            });
            //END Setores

            //FLEXFLIELDS :: Context Filter :: TODO LEO
            var getFF = function () {
                var params = {}
                params = {
                    pk: "A.RV_LOW_VALUE",
                    table: "CG_REF_CODES A",
                    where: " AND A.RV_DOMAIN = 'RH_CTX_FLEXFIELD'",
                    orderBy: "A.RV_LOW_VALUE",
                    desigColumn: "A.RV_MEANING",
                };

                var promise = $.ajax({
                    type: "POST",
                    url: "data-source/complexLists.php",
                    data: {lists: [params], multiRequest: false},
                    dataType: "text",
                    cache: false,
                    async: true,
                });

                $.when(promise).then(function (data) {
                    var el = $('#DSP_CTX_FF');
                    dat = JSON.parse(data)["data"]; //JSON.parse(data);

                    //if (dat["data"][0].length > 0) { //if results  fill dropdown etc.
                    if (dat[0].length > 0) { //if results  fill dropdown etc.
                        var output = [];
                        output.push("<option> </option>");
                        _.map(dat[0], function (ob, index) {
                            var oValues = ob["OTHERVALUES"] ? 'data-otherValues="' + ob["OTHERVALUES"] + '"' : "";
                            output.push('<option value="' + ob.VAL + '" ' + oValues + ">" + ob[Object.keys(ob)[0]] + "</option>");
                        });
                        el.html(output.join(""));
                        el.removeClass("loadingList");
//                        var options = {
//                            no_results_text: "_RESULTS_VARIABLE",
//                            placeholder_text_single: " ",
//                            allow_single_deselect: true,
//                            search_contains: true
//                        };
//
//                        setTimeout(function () {
//                            el.chosen(options);
//                            el.trigger("chosen:updated");
//                        }, 100);

                    } else { //no results ...show create button
                        //$("#RH_IDENTIFICACOES").find("a[data-form-action=new]").show();
                    }
                    //todo reset child Instances
                });
            }
            
            getFF();
            
            //LOCAL INSTANCE FILTER
            $(document).on("change", "#DSP_CTX_FF", function (evt) {
                if ($('#DSP_CTX_FF').val()) {
                    var formData = RH_ID_FLEXFIELDS.getFiltersFormsData();               
                    RH_ID_FLEXFIELDS.sFilters = _(RH_ID_FLEXFIELDS.sFilters)
                        .concat(formData)
                        .groupBy("name")
                        .map(_.spread(_.merge))
                        .value();
                    refreshQuadTable(RH_ID_FLEXFIELDS,
                        [{
                            'name': 'CD_FF',
                            'value': " (CD_FF) IN (SELECT CD_FF FROM RH_DEF_FLEXFIELDS WHERE CONTEXTO = '" + $('#DSP_CTX_FF').val() + "')",
                            overrideName: true
                         }
                        ], {
                            show: ['CD_FF']
                        }
                    );

                } else {
                    refreshQuadTable(RH_ID_FLEXFIELDS, false);
                }
            });
            //END FLEXFLIELDS :: Context Filter
            
            //FLEXFLIELDS :: DECODE / DISPLAY DOMAINS & SELECTS
            function displayFF(val,type,row) {
                if (val) {
                    //initApp.joinsData -> Domínio
                    //var directWay = initApp.joinsComplexData["CD_FF__RH_DEF_FLEXFIELDS__DSP_FF__NVL(NR_ORDEM,CD_FF)"];
                    //    var hasDomain = _.find(obj.tableCols, { attr: { "domain-list": true } });
                    var obj = RH_ID_FLEXFIELDS;
                    
                    /* Dynamic way to determine COMPLEXLIST defined on INSTANCE.COLUMN */                    
                    var myFieldList = _.find(RH_ID_FLEXFIELDS.tableCols, {"name": "DSP_FF" }),
                        o = myFieldList["attr"];
                    var lov = obj.getComplexListIndex(o); //LOV object VALUES ::OPTIONS
                    //console.log(lov);
                    var idx_ = _.findIndex( lov, {"VAL": row['CD_FF']} ); //Determine VALUE INDEX on array of OPTIONS
                    if (idx_ >= 0) { //Found MATCH position
                        var reg_ = lov[idx_], //"ROW" RECORD on LOV
                            oth = lov[idx_]['OTHERVALUES'].split('@'), //"otherValues": "CONTEXTO@DOMINIO@SQL_CODE@SCC_ACTVO",
                            dom_ = encodeURI(oth[1]),
                            sql_ = encodeURI(oth[2]);
                        if (dom_) { //É DOMÍNIO
                            //dom__ = "\"LIMITE TELEM\""
                            if (initApp.joinsData[dom_]) { //DOMÍNIO Já disponível
                                null;                                
                                //console.log('Domínio '+'"\dom_'+' já disponível!.');
                            } else { //Push new DOMINIO
                                //Get DOM VALUES
                                $.ajax({
                                    type: "POST",
                                    url: obj.pathToListsFile,
                                    data: { "request_id": decodeURI(dom_)},
                                    dataType: "text",
                                    cache: false,
                                    async: false,
                                    success: function(regs) {
                                        //ADD DOM to "APP.DOMAINS"
                                        initApp.joinsData[dom_] = JSON.parse(regs);
                                    },
                                    error: function (err) {
                                        console.log('DOM ::' + dom_ +':: ' +err);
                                    }
                                });
                            }
                            //Descodificação DOM
                            if (val != null) {
                                try {
                                    var o = _.find(initApp.joinsData[dom_], {'RV_LOW_VALUE': val});
                                    return val == null ? null : o['RV_ABBREVIATION'];
                                } catch (e) {
                                    var txt = "<?php echo $error_dom_value; ?>";
                                    txt = txt.replace("{0}", '[' + decodeURI(dom_) + ']');
                                    return '<span class="undecoded" title="' + txt + '">' + val + '</span>';
                                }
                            }
                        }
                        if (sql_) { //É SQL
                            //Este "refactoring" é necessário uma vez que o split(@), desmembra também o SQL
                            //que pode ter @ na concatenação de (principalmente) PK's. Daí termos de refazer:
                            var str = lov[idx_]['OTHERVALUES'],
                                ini = str.indexOf('SELECT'),
                                str = str.substr(ini),
                                fim = str.lastIndexOf("@"),
                                sql_ = str.substr(0, fim),
                                ask_key = 'LOV_FF_', //Usado para centralizar a função de execução de SQL's
                                key_ = ask_key + row['CD_FF'].replace(" ","_"); //Chave ÚNICA com que os dados são guardados no array initApp.joinsData
                            
                            if (initApp.joinsData[key_]) { //"DOMÍNIO" Já disponível
                                null;
                                //console.log('#LOV ' + key_ + ' já disponível!!!!');
                            } else { //Push new DOMINIO
                                //Get DOM VALUES
                                $.ajax({
                                    type: "POST",
                                    url: obj.pathToListsFile,
                                    data: { "request_id": ask_key, "sql_": sql_},
                                    dataType: "text",
                                    cache: false,
                                    async: false,
                                    success: function(regs) {
                                        //ADD LOV to "APP.DOMAINS"
                                        initApp.joinsData[key_] = JSON.parse(regs);
                                    },
                                    error: function (err) {
                                        console.log('LOV ::' + key_ +':: ' +err);
                                    }
                                });
                            }

                            //Descodificação LOV
                            if (val != null) {
                                try {
                                    var o = _.find(initApp.joinsData[key_], {'VALUE': val});
                                    return val == null ? null : o['LABEL'];
                                } catch (e) {
                                    var txt = "<?php echo $error_lov_value; ?>";
                                    txt = txt.replace("{0}", '[' + row['CD_FF'] + ']');
                                    return '<span class="undecoded" title="' + txt + '">' + val + '</span>';
                                }
                            }
                        }
                    }                    
                }
                //INPUT
                return val;
            }
            
            //TODO :: MOVE TO QUAD_LIB.JS // FLEXFIELD :: EDITOR :: DYNAMIC :: Transforms array of DOM or LOV into DOM SELECT OPTIONS. Returns OPTIONS string
            function resourceToOption(tipo, resource_, val) {
                var res = '<option><option>', selected_ = '';
                if (resource_.length) {
                    if (tipo === 'DOM') { //DOMAIN
                        /*
                         * RV_ABBREVIATION
                           RV_DOMAIN
                           RV_LOW_VALUE
                           RV_MEANING
                         */
                        $.each(resource_, function (index, item) {
                            if (val === resource_[index]['RV_LOW_VALUE']) {
                                selected_ = " selected ";
                            }
                            res += '<option ' + selected_ + ' value="' + resource_[index]['RV_LOW_VALUE'] + '">' +
                                resource_[index]['RV_ABBREVIATION'] +
                                    '</option>';
                        });

                    } else { // "LOV"
                        /*
                         * LABEL
                         * VALUE
                         */
                        /*
                        $.each(resource_, function( index, item ) {
                            if (val === resource_[index]['VALUE'] ) {
                                selected_ = " selected ";
                            }
                            res += '<option ' + selected_ + ' value="' + resource_[index]['VALUE'] + '">'+
                                        resource_[index]['LABEL']+
                                    '</option>';
                        });    
                        */
                        alert('NOVA VERSÃO!!! -> MOVE TO QUAD_LIB.JS');
                        /* --------------------------------------
                         * TESTAR NOVA VERSÃO
                         * --------------------------------------*/
                        var chavesArr = Object.keys(resource_[0]),
                            dsp_name = chavesArr[0], value_name = chavesArr[1], othervalues = '';

                        if (chavesArr.length === 3) {
                            othervalues = chavesArr[0];
                        }

                        $.each(resource_, function (index, item) {
                            if (val === resource_[index]['VAL']) {
                                selected_ = " selected ";
                            }

                            if (othervalues) {
                                res += '<option ' + selected_ + ' value="' + resource_[index][value_name] + '" data-othervalues="' + resource_[index][othervalues] + '">' +
                                    resource_[index][dsp_name] +
                                        '</option>';
                            } else {
                                res += '<option ' + selected_ + ' value="' + resource_[index][value_name] + '">' +
                                    resource_[index][dsp_name] +
                                        '</option>';
                            }                                
                        });    
                        
                    }
                }
                return res;
            }
            
            $(document).on('RH_ID_FLEXFIELDSAttachEvt', function (e) {
                var operacao = RH_ID_FLEXFIELDS.editor.s["action"], frm_context = "#RH_ID_FLEXFIELDS_editorForm";
                
                //DYNAMIC DOM MANIPULATION :: FF CONTEXT
                $("#DTE_Field_DSP_FF", frm_context).on("change", function (e) {
                    var $this = $(this), 
                        opcoes_chosen = {
                            "placeholder_text_single": "<?php echo $ui_select_one_option; ?>",
                            "no_results_text": "<?php echo $ui_no_records_found; ?>"
                        };
                    
                    if ($this.val()) {
                        //"otherValues": "CONTEXTO@DOMINIO@SQL_CODE@SCC_ACTVO",
                        //EX: 4@@@N -> INPUT
                        var other = $this.find(':selected').attr('data-othervalues');
                            oth = other.split('@'), //"other": "CONTEXTO@DOMINIO@SQL_CODE@SCC_ACTVO",
                            dom_ = encodeURI(oth[1]),
                            sql_ = encodeURI(oth[2]),
                            options_ = '';
                            
                        if (dom_) { //É DOMÍNIO                            
                            if (initApp.joinsData[dom_]) {
                                options_ = resourceToOption('DOM', initApp.joinsData[dom_]);
                            }
                        } else if (sql_) { //É SQL
                            var ini = other.indexOf('SELECT'),
                                other = other.substr(ini),
                                fim = other.lastIndexOf("@"),
                                sql_ = other.substr(0, fim),
                                ask_key = 'LOV_FF_', //Usado para centralizar a função de execução de SQL's
                                key_ = ask_key + $this.val().replace(" ", "_"); //Chave ÚNICA com que os dados são guardados no array initApp.joinsData
                            
                            if (initApp.joinsData[key_]) { //"LOV" Já disponível
                                options_ = resourceToOption('LOV', initApp.joinsData[key_]);
                            }
                        }

                        //Se for DOMÍNIO ou LOV :: TRANSFORM DOM from INPUT into SELECT
                        if (dom_ || sql_) {
                            var el = $('#DTE_Field_VALOR');
                                el.closest('div').html('').html('<select id="DTE_Field_VALOR" name="VALOR" class="form-control chosen" aria-invalid="false">' + options_ + '</select>');
                                $("#DTE_Field_VALOR").chosen(opcoes_chosen).trigger("chosen:updated").trigger("mouseover");
                        } else { //INPUT
                            var el = $('#DTE_Field_VALOR');
                                el.closest('div').html('').html('<input id="DTE_Field_VALOR" type="text" name="VALOR" class="form-control" aria-invalid="false">');
                            
                        }
                    } else {
                            var el = $('#DTE_Field_VALOR');
                                el.closest('div').html('').html('<input id="DTE_Field_VALOR" type="text" name="VALOR" class="form-control" aria-invalid="false">');                    
                    }
                });
                
                if (operacao === 'edit') {
                    setTimeout(function () {
                        $('#DTE_Field_VALOR', frm_context).val(RH_ID_FLEXFIELDS.selectedRowData()['VALOR']).trigger("chosen:updated");
                    }, 350);                    
                }            
            });

            $(document).on("mouseup", $('#RH_IDENTIFICACOES > form-toolbar > div > ul > li:nth-child(5) > a'), function (e) {
                //console.log('cliked new');
            });
            
            //Recalc INSTANCE on EXPAND        
            $(document).on('click', 'table.table-responsive > tbody tr > td:first-child', function (evt) {
                var instance_name = $(this).closest('table').attr('id');
                $("#" + instance_name).DataTable()
                    .columns.adjust()
                    .responsive.recalc();
                    $(window).trigger("resize");
            });            
        }
        //END CODE
        
    //};
    });

    //Run pagefunction
    //pagefunction();

    var pagedestroy = function () {
        //Destroy Instance (s)
//       
//        RH_IDENTIFICACOES = {};     //INSTANCE RESET
//        RH_ID_EMPRESAS = {};
//        RH_ID_EMPRESAS_CONTINUED = {};
//        RH_ID_DEPTS = {};
//        RH_ID_JOBS = {};
//        RH_ID_SETORES = {};
//        RH_ID_ENT_INTERNAS = {};
//        RH_ID_DESTACAMENTOS = {};
//        RH_ID_ADAPTABILIDADES = {};
//        RH_ID_WORKFLOWS = {};
//        RH_ID_PROFISSIONAIS = {};
//        RH_ID_RETRIBUTIVOS = {};
//        RH_ID_ENTS_DESCONTO = {};
//        RH_ID_REMUNERACOES = {};
//        RH_ID_FUNCOES = {};
//        RH_ID_DOCUMENTOS = {};
//        RH_ID_AGREGADOS = {};
//        RH_ID_DOCUMENTOS_AGREGADO = {};
//        RH_ID_FLEXFIELDS = {};
//        RH_ID_CURRICULUM = {};
//        RH_ID_CONTEXTOS_TEMPO = {};
//        RH_ID_HAB_LITERARIAS = {};
//        RH_ID_HABS_PROFISSIONAIS = {};
//        RH_ID_CARACTERISTICAS = {};
//        RH_ID_FORMACAO_VIEW = {};
//        QUAD_PEOPLE_GE_INDIV = {};
//        RH_COMPETENCIAS_INDIVIDUAIS = {};
//        RH_ID_COMPORTAMENTOS = {};
//        RH_OBJECTIVOS_INDIVIDUAIS = {};
//
//        delete RH_IDENTIFICACOES;   //MEMORY :: Garbage
//        delete RH_ID_EMPRESAS;
//        delete RH_ID_EMPRESAS_CONTINUED;
//        delete RH_ID_DEPTS;
//        delete RH_ID_JOBS;
//        delete RH_ID_SETORES;
//        delete RH_ID_ENT_INTERNAS;
//        delete RH_ID_DESTACAMENTOS;
//        delete RH_ID_ADAPTABILIDADES;
//        delete RH_ID_WORKFLOWS;
//        delete RH_ID_PROFISSIONAIS;
//        delete RH_ID_RETRIBUTIVOS;
//        delete RH_ID_ENTS_DESCONTO;
//        delete RH_ID_REMUNERACOES;
//        delete RH_ID_FUNCOES;
//        delete RH_ID_DOCUMENTOS;
//        delete RH_ID_AGREGADOS;
//        delete RH_ID_DOCUMENTOS_AGREGADO;
//        delete RH_ID_FLEXFIELDS;
//        delete RH_ID_CURRICULUM;
//        delete RH_ID_CONTEXTOS_TEMPO;
//        delete RH_ID_HAB_LITERARIAS;
//        delete RH_ID_HABS_PROFISSIONAIS;
//        delete RH_ID_CARACTERISTICAS;
//        delete RH_ID_FORMACAO_VIEW;
//        delete QUAD_PEOPLE_GE_INDIV;
//        delete RH_COMPETENCIAS_INDIVIDUAIS;
//        delete RH_ID_COMPORTAMENTOS;
//        delete RH_OBJECTIVOS_INDIVIDUAIS;
//
//        $('#xpto').remove(); //Clear DOM

        //After run on exit, if other interfaces miss pagedestroy, it will continue to run
        //To avoid this we reset it in order to avoid this preverse effect
        pagedestroy = function () {};
    };
</script>
