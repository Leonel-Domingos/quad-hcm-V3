<?php
    /* FIXED HEADER :: TO DO
     * https://stackoverflow.com/questions/14977864/fixed-header-table-with-horizontal-scrollbar-and-vertical-scrollbar-on
     * 
     *  1. http://jsfiddle.net/X2Kmd/389/
     *  2. http://jsfiddle.net/avrahamcool/eZXtq/
     */
require_once '../init.php';

$ui_inactive = 'Inativo';
$ui_inatives = 'Inativas';
$ui_interface = 'Interface';
$ui_email = 'Email';
$ui_sms = 'SMS';

# carrega opções associadas ao modo de acesso dos workflows
$dom_wkf_modo_acesso = json_decode(list_dominio ('WEB_ADM_WORKFLOW.MODO_ACESSO', '', '', $msg));

# carrega opções associadas ao estado dos workflows
$dom_wkf_estado = json_decode(list_dominio ('WEB_ADM_WORKFLOW.ESTADO', '', '', $msg));

# inicializa os módulos/perfis que ainda não estejam em workflow
inicializa_workflow($msg);

# obtem a lista dos módulos
$modulos = list_adm_modulos('S','',$msg);

# obtem a lista dos perfis
$perfis = list_adm_perfis('S','',$msg);

# obtem as colunas de controle RGPD para módulos do cadastro
#inic_colunas_RGPD($msg);
$colunas_RGPD = array();

foreach ($modulos as $rec_mod) { 
    foreach($perfis as $rec_perfil) {
        if ($rec_mod['ID_PAI'] == 1) { # módulos de cadastro
            $colunas = get_colunas_RGPD($rec_mod['ID_MODULO'], $rec_perfil['ID_PERFIL'],$msg);
            $rec = '';
            $rec->id_modulo = $rec_mod['ID_MODULO'];
            $rec->id_perfil = $rec_perfil['ID_PERFIL'];
            $rec->colunas = $colunas;
            array_push($colunas_RGPD,$rec);
        }
    }
}

# constituição do HTML da tabela de workflows

# Cabeçalho
$thead = '';
foreach ($perfis as $rec_perf){
    $thead .= "<th>".$rec_perf['DSP_PERFIL']."</th>";
}


# Corpo
$tbody = '';
foreach ($modulos as $rec_mod) { 
    $tbody .= '<tr class="moduleRow '.'M_'.$rec_mod['ID_MODULO'].'"><th style="width: 1%"><table class="innerLabelTable"><tr>';
    if ($rec_mod['ID_PAI'] != '') {
        if ($rec_mod['RGPD'] == 'S') {
            $tbody .= '<th rowspan="4" class="MC_'.$rec_mod['ID_MODULO'].'" data-module="'.$rec_mod['ID_MODULO'].'" >';
            $tbody .= '<span class="comuter"><i class="far fa-chevron-right"></i></span><span class="moduleTitle">'.$rec_mod['DSP_MODULO'].'<span>'; 
        } else {
            $tbody .= '<th rowspan="4" data-module="'.$rec_mod['ID_MODULO'].'" >';
            $tbody .= '<span class="moduleTitle">'.$rec_mod['DSP_MODULO'].'<span>'; 
        }
    }
    else {
        $tbody .= '<th rowspan="4">';
        $tbody .= $rec_mod['DSP_MODULO']; 
    }
    $tbody .= '</th></tr>';
    
    if ($rec_mod['MODULO_PAI'] != 'S') { 
        $tbody .= '<tr><th>'.$ui_access.'</th></tr><tr><th>'.$ui_workflow.'</th></tr><tr><th>'.$ui_notification.'</th></tr><tr class="dbColumns M_'.$rec_mod['ID_MODULO'].'" ><th colspan="2" class="col rgpd">'.$ui_rgpd_short.'</th></tr>';
        # Colunas de configuração RGPD: nome das colunas  -->
        foreach ($colunas_RGPD as $rec) {
            if ($rec->id_modulo == $rec_mod['ID_MODULO'] && $rec->id_perfil == 1) {
                foreach($rec->colunas as $coluna) { 
                    $tbody .= '<tr class="dbColumns M_'.$rec_mod['ID_MODULO'].'" ><th colspan="2" class="col">'.$coluna['DSP_COLUNA'].'</th></tr>';
                }
            }
        }
    } 
    $tbody .= '</table></th>';
    
    foreach ($perfis as $rec_perf) { 
        $estado = ''; 
        $modo_acesso = ''; 
        $notif_ecran = '';
        $notif_email = '';
        $notif_sms = '';
        $msg = '';
        $class_notif = "";
        $class_wkf = "";
        $display_wkf = "display:inherit;";
        $display_notif = "display:inherit;";

        get_workflow($rec_mod['ID_MODULO'], $rec_perf['ID_PERFIL'], $estado, $modo_acesso, $notif_ecran, $notif_email, $notif_sms, $msg);
        if ($notif_ecran == 'S')
            $notif = 'A';
        else
            $notif = '';
        if ($notif_email == 'S')
            $notif .= ',B';
        else
            $notif .= ',';
        if ($notif_sms == 'S')
            $notif .= ',C';
        else
            $notif .= ',';

        if ($modo_acesso == 'B' || $modo_acesso == 'Z' || $rec_perf['WORKFLOW'] == 'N') {
            //$display_wkf = "display:none;";
            $class_wkf = "gosth"; //PMA
            $estado = 'B';

            //$display_notif = "display:none;";
            $class_notif = "gosth"; //PMA
            $notif = '';
        } 
        elseif ($estado == 'B') {
            //$display_notif = "display:none;";
            $class_notif = "gosth"; //PMA
            $notif = '';
        }
#echo $rec_mod['DSP_MODULO']."/".$rec_perf['DSP_PERFIL']." estado:$estado, acesso:$modo_acesso, ecran:$notif_ecran, email:$notif_email, sms:$notif_sms msg:$msg<br/>";
        $tbody .= '<td>';
        $tbody .= '<table class="innerLabelTable cellData '.$rec_perf['DSP_PERFIL'].'">';
        if ($rec_mod['MODULO_PAI'] != 'S') { 
            $tbody .= '<tr><td><a class="acesso" href="form-x-editable.html#" id="acessos_'.$rec_mod['ID_MODULO'].'_'.$rec_perf['ID_PERFIL'].'" data-type="select" data-value="'.$modo_acesso.'" data-original-title="'.$ui_access.'"></a></td></tr>';
            if ($rec_mod['WORKFLOW'] == 'S' && $rec_perf['WORKFLOW'] == 'S') { 
                $tbody .= '<tr><td><a class="workflow '.$class_wkf.'" href="form-x-editable.html#" id="wkf_'.$rec_mod['ID_MODULO'].'_'.$rec_perf['ID_PERFIL'].'" data-type="select" data-value="'.$estado.'" data-original-title="'.$ui_workflow.'" style="/*'.$display_wkf.'*/"></a></td></tr><tr><td><a class="notificacao '.$class_notif.'" href="form-x-editable.html#" id="notif_'.$rec_mod['ID_MODULO'].'_'.$rec_perf['ID_PERFIL'].'" data-type="checklist" data-value="'.$notif.'" data-original-title="'.$ui_notification.'" style="'.$display_notif.'"></a></td></tr>';
            } else { 
                $tbody .= '<tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr>';
            }
            $tbody .= '<tr class="dbColumns M_'.$rec_mod['ID_MODULO'].'" ><td>&nbsp;</td></tr>';

            # Colunas de configuração RGPD: desenho das opções  -->
            foreach ($colunas_RGPD as $rec) {
                if ($rec->id_modulo == $rec_mod['ID_MODULO'] && $rec->id_perfil == $rec_perf['ID_PERFIL']) {
                    foreach($rec->colunas as $coluna) {
                        $tbody .= '<tr class="dbColumns M_'.$rec_mod['ID_MODULO'].'" ><td><a class="coluna" href="form-x-editable.html#" id="coluna_'.$coluna['ID'].'_'.$rec_mod['ID_MODULO'].'_'.$rec_perf['ID_PERFIL'].'" data-type="select" data-value="'.$coluna['ESTADO'].'" data-original-title="'.$ui_visible.' ?"></a></td></tr>';
                    }
                }
            }

        }
        $tbody .= '</table></td>';
    }
    $tbody .= '</tr>';
}


# Inicializações de JS
# Instanciação do plugin dos módulos (não incluí RGPD) de: Acesso, Workflow e Notificações
$js_script = '';
foreach ($modulos as $rec_mod) { 
    foreach ($perfis as $rec_perf) {

        # acesso
        $js_script .= "$('#acessos_".$rec_mod['ID_MODULO']."_".$rec_perf['ID_PERFIL']."').editable({limit: 1,source: [";
        
        ## popula as opções associadas ao modo de acesso ao módulo
        $options = '';
        foreach ($dom_wkf_modo_acesso as $rec) {
            # só disponibiliza a opção de manutenção se o módulo permitir
            if (($rec_mod['MANUTENCAO'] == 'S' && $rec->RV_LOW_VALUE == 'A') ||  $rec->RV_LOW_VALUE != 'A') {
                if ($options == '') {
                    $options = "{ value: '".$rec->RV_LOW_VALUE."', text: '".$rec->RV_MEANING."'}";
                } else {
                    $options .= ",{ value: '".$rec->RV_LOW_VALUE."', text: '".$rec->RV_MEANING."'}";
                }
            }
        }
        $js_script .= $options;
        $js_script .= "]});";

        # workflow
        if ($rec_mod['WORKFLOW'] == 'N' || $rec_perf['WORKFLOW'] == 'N') {         
            $js_script .= "$('#wkf_".$rec_mod['ID_MODULO']."_".$rec_perf['ID_PERFIL']."').editable({limit: 1,\"type\": \"select\",\"disabled\": true,\"source\": [";
        } else {
            $js_script .= "$('#wkf_".$rec_mod['ID_MODULO']."_".$rec_perf['ID_PERFIL']."').editable({limit: 1,\"type\": \"select\",\"source\": [";
        }
        
        ## popula as opções associadas ao estado do workflow
        $options = '';
        foreach ($dom_wkf_estado as $rec) {
            if ($options == '') {
                $options = "{ value: '".$rec->RV_LOW_VALUE."', text: '".$rec->RV_MEANING."'}";
            } else {
                $options .= ",{ value: '".$rec->RV_LOW_VALUE."', text: '".$rec->RV_MEANING."'}";
            }
        }
        $js_script .= $options;
        $js_script .= "]});";
  
 
        # notificações
        $js_script .= "$('#notif_".$rec_mod['ID_MODULO']."_".$rec_perf['ID_PERFIL']."').editable({showbuttons: \"bottom\",limit: 3,source: [{value: 'A',text: \"".$ui_interface."\"}, {value: 'B',text: \"".$ui_email."\"}, {value: 'C',text: \"".$ui_sms."\"}]});";
    }
}

?>
<style>    
    table.innerLabel {        
        width: 1%;
        border: 0px!important;
    }
    
    table.innerLabelTable > tbody > tr:nth-child(1) > th {        
        font-size: 16px !important;
        color: black !important;
        padding: 10px 20px 10px 5px !important;
        font-weight: bolder !important;
        text-shadow: 0px 0px;
    }
    
    table.innerLabelTable > tbody tr > th {
        color: #bfbfbf !important;
        font-weight: 400 !important;
        text-shadow: 0px 1px #00000099;
        width: 100%;
    }
    
    .widget-body {
        max-height: 78vh;
        max-width: 90vw;
        overflow: scroll;
    }
    /* PMA :: ADDITION */
    table.w-100 {
        width: 100%;
    }
    table.w-100 > thead > tr > th {
        text-align: center;
    }
    
    /* By default Data Dictionary (DD) data is HIDDEN */
    tr.dbColumns {
        display: none;
    }
    
    /* RGPD TITLE + DD COLUMNS */
    tr.dbColumns > th.col {
        font-family: sans-serif;
        text-align: right;
        color: black!important;
        text-shadow: none!important;
    }
    
    span.moduleTitle {
        color: black;
        cursor: pointer;
        margin-left: 10px;        
    }
    
    tr.dbColumns > th.col.rgpd {
        text-align: justify;
        padding-left: 35px!important;
        color: #349df6 !important;
        font-weight: 800!important;
        font-size: 1.18em;
    }
    
    /* COMUTER ICON */
    th:not(.mostraDetails) > span.comuter {
        color: black;
        margin-left: 30px;
    }
    
    span.comuter > i.far.fa-chevron-right { 
        transition: .3s transform ease-in-out;
    }
    
    th:not(.mostraDetails) > span.comuter > i.far.fa-chevron-right {
        color: #2c3742;
    }

    th.mostraDetails > span.comuter > i.far.fa-chevron-right {
        font-size: 1.3em;
        font-weight: bold;
        padding: 2px;
        color: #349df6 !important;
        transform: rotate(90deg);
    }

    /* MODULE TITLE */
    th:not(.mostraDetails) > span.moduleTitle {
        color: black;
        cursor: pointer;
        color: black;
    }    
    th.mostraDetails > span.moduleTitle {
        color: darkred !important;
        cursor: pointer;        
    }
</style>

<div id="xpto" class="row">
    <div>
    <h1 id="loading" class="table-wrap custom-scroll animated fast fadeInRight quadWait"><i class="far fa-cog fa-spin"></i> Loading...</h1></td>
    </div>
    <article class="col-xs-12">

        <!-- Widget ID (each widget will need unique ID) jarviswidget-color-blueLight  -->
        <div class="jarviswidget jarviswidget-sortable" id="wid-id-0"
             data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-editbutton="false"
             data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false"
             data-widget-custombutton="false" data-widget-collapsed="false" data-widget-sortable="false">
            <header>
                <span class="widget-icon"> <i class="far fa-sitemap"></i></span>
                <h2><?php echo $ui_workflows; ?></h2>
                <div class="jarviswidget-ctrls" role="menu">  
                    <a href="javascript:void(0);" id="gera_recursos" class="button-icon jarviswidget-edit-btn" rel="tooltip" title="<?php echo $ui_generate_resources; ?>" data-placement="bottom" data-original-title="Edit"><i class="far fa-cog"></i></a> 
                </div>
            </header>

            <div>
                <div class="widget-body">
                    <table id="WEB_ADM_WORKFLOW" class="table table-bordered table-striped table-hover nowrap">
                      <thead>
                          <tr class="profilesRow">
                              <th>&nbsp;</th>
                              <?= $thead ?>
                          </tr>
                      </thead>
                      <tbody>
                        <?= $tbody ?>
                      </tbody>
                  </table>
                </div>
            </div>
        </div>

    </article>
    <div class="row">
        <div class="col-sm-12">
        </div>
    </div>
</div>

<script type="text/javascript">
    pageSetUp();

    var y = "<?php echo @$_SESSION['lang']; ?>";
    
    var pagefunction = function () {
        loadScript("assets/js/x-editable-bs4/bootstrap-editable.min.js", loadScripting);        
        function loadScripting () {       
            
            //Setting (new) DEFAULT's 
            //https://vitalets.github.io/x-editable/docs.html#editable
            $.fn.editable.defaults = $.extend({}, $.fn.editable.defaults, {
                "inputclass": 'input-xxlarge',
                "type": "text", //Type of input. Can be text|textarea|select|date|checklist and more
                "disabled": !1, //Sets disabled state of editable
                "toggle": "click", //How to toggle editable. Can be click|dblclick|mouseenter|manual. When set to manual you should manually call show/hide methods of editable.
                "emptytext": "<?php echo $ui_inatives;?>", //Text shown when element is empty.
                "autotext": "auto", //Allows to automatically set element's text based on it's value. Can be auto|always|never
                "value": null,
                "display": function(value, sourceData) {
                        //Display checklist as comma-separated values
                        var html = [],
                            checked = $.fn.editableutils.itemsByValue(value, sourceData);

                        if(checked.length) {
                            $.each(checked, function(i, v) { html.push($.fn.editableutils.escape(v.text)); });
                            $(this).html(html.join(', '));
                        } else {
                            $(this).empty(); 
                        }
                },
                showbuttons: false, //left(true)|bottom|false OBS:Form without buttons is auto-submitted.
                "emptyclass": "editable-empty",
                "unsavedclass": "editable-unsaved",
                "selector": null,
                "highlight": "#3b9ff3",
                "placement": "right",
                "autohide": !0,
                "onblur": "cancel", //Action when user clicks outside the container. Can be cancel|submit|ignore. Setting ignore allows to have several containers open.
                "anim": !1,
                "mode": "popup" //'inline'
            });             
            
            // instanciação do plugin dos módulos (não incluí RGPD) de: Acesso, Workflow e Notificações
            <?= $js_script ?>

            //Gravar estados de coluna
            function saveCOL (acao, id, modulo, perfil, valor) {

                //Clear warnings & Input ERROR properties
                quad_notification_clear();

                if ( acao && modulo && valor ) {
                    var t0 = performance.now(),
                        wk = new Worker(pn + "assets/lib/utils/workerRouter.js"),
                        message = {
                            request_id: 'RGPD_colunas',
                            acao: acao,
                            id: id,
                            modulo: modulo,
                            perfil: perfil,
                            valor: valor,
                            defaults: datatable_instance_defaults.pathToSqlFile
                        },
                        mssg = '';
                    wk.postMessage(JSON.stringify(message));
                    wk.onmessage = function (event) {                
                        if (event.data === 'working') {
                            return;
                        } else {
                            t1 = performance.now();
                            tmp = millisToMinutesAndSeconds(t1 - t0);
                            if (event.data) {
                                if (event.data.msg === 'OK') { 
/*                                    mssg = "<?php echo $msg_process_finished_ok; ?>";                                
                                    mssg = mssg.replace(" {0}", " " + tmp + " (MM:SS)");
                                    quad_notification({
                                            type: "success",
                                            title : JS_OPERATION_COMPLETED,
                                            content : '<i class="glyphicon glyphicon-thumbs-up"></i>&nbsp;<i>' + mssg + '</i>',
                                            timeout : 5000
                                    });
                                    $(this).prop("disabled", false);*/
                                    null;
                                } else {
                                    var mssg = event.data.error;
                                    quad_notification({
                                            type: "error",
                                            title : JS_OPERATION_ERROR,
                                            content : '<i class="glyphicon glyphicon-thumbs-down"></i>&nbsp;<i>' + mssg + '</i>'
                                    });
                                }
                            }
                        }
                        //RH_DEF_CELULAS_MES.hideProcess();
                    };          
                }                
            }

            // gravação das parametrizações de acesso às colunas RGPD
            $('.coluna').on('save', function(e, params) {
                var key_ = $(this).attr('id');
                var param_ = key_.split("_");
                var id_ = param_[1];
                var mod_ = param_[2];
                var perf_ = param_[3];
                var val_ =  params.newValue;
                //console.log("key:",key_," id:",id_," mod:",mod_," perf:",perf_," val:",val_);                
                saveCOL ('gravar', id_, mod_, perf_, val_);
            });
                
            //Gravar estados de workflow
            function saveWKF (tipo, modulo, perfil, valor) {

                //Clear warnings & Input ERROR properties
                quad_notification_clear();

                if ( tipo && modulo && perfil && valor ) {
                    var t0 = performance.now(),
                        wk = new Worker(pn + "assets/lib/utils/workerRouter.js"),
                        message = {
                            request_id: 'workflows',
                            acao: 'gravar',
                            tipo: tipo,
                            modulo: modulo,
                            perfil: perfil,
                            valor: valor,
                            defaults: datatable_instance_defaults.pathToSqlFile
                        },
                        mssg = '';
                    wk.postMessage(JSON.stringify(message));
                    wk.onmessage = function (event) {                
                        if (event.data === 'working') {
                            //RH_DEF_CELULAS_MES.showProcess("<?php echo $hint_create_14_cells; ?>"); //Process ID;
                            return;
                        } else {
                            t1 = performance.now();
                            tmp = millisToMinutesAndSeconds(t1 - t0);
                            if (event.data) {
                                if (event.data.msg === 'OK') { 
/*                                    mssg = "<?php echo $msg_process_finished_ok; ?>";                                
                                    mssg = mssg.replace(" {0}", " " + tmp + " (MM:SS)");
                                    quad_notification({
                                            type: "success",
                                            title : JS_OPERATION_COMPLETED,
                                            content : '<i class="glyphicon glyphicon-thumbs-up"></i>&nbsp;<i>' + mssg + '</i>',
                                            timeout : 5000
                                    });
                                    $(this).prop("disabled", false);*/
                                    null;
                                } else {
                                    var mssg = event.data.error;
                                    quad_notification({
                                            type: "error",
                                            title : JS_OPERATION_ERROR,
                                            content : '<i class="glyphicon glyphicon-thumbs-down"></i>&nbsp;<i>' + mssg + '</i>'
                                    });
                                }
                            }
                        }
                        //RH_DEF_CELULAS_MES.hideProcess();
                    };          
                }                
            }
                
            // gravação das parametrizações de modo de acesso , estado workflow e notificações
            $('.acesso,.workflow,.notificacao').on('save', function(e, params) {
                var id_ = $(this).attr('id');
                var param_ = id_.split("_");
                var tipo_ = param_[0];
                var mod_ = param_[1];
                var perf_ = param_[2];
                var val_ =  params.newValue;
                saveWKF (tipo_, mod_, perf_, val_);
                
                var id_notif_ = $(document).find("#notif_"+mod_+"_"+perf_);
                if (tipo_ === 'wkf') {
                    var id_notif_ = $(document).find("#notif_"+mod_+"_"+perf_);
                    if (val_ === 'B') {
                        //id_notif_.hide();
                        id_notif_.addClass("gosth");
                        id_notif_.editable('setValue',[]);
                        saveWKF ('notif', mod_, perf_,[]);
                    } 
                    else {
                        //id_notif_.show();
                        id_notif_.removeClass("gosth");
                        id_notif_.editable('setValue',"A");
                        saveWKF ('notif', mod_, perf_, ['A']);
                    }
                } else if (tipo_ === 'acessos') {
                    var id_wkf_ = $(document).find("#wkf_"+mod_+"_"+perf_);
                    if (val_ === 'B' || val_ === 'Z' ) {
                        //id_wkf_.hide();
                        id_wkf_.addClass("gosth");
                        id_wkf_.editable('setValue','B');
                        saveWKF ('wkf', mod_, perf_,'B');
                        
                        //id_notif_.hide();
                        id_notif_.addClass("gosth");
                        id_notif_.editable('setValue',[]);
                        saveWKF ('notif', mod_, perf_,[]);
                        
                        // se muda acesso para Sem Acesso => colunas RGPD = inativas
                        if (val_ === 'Z') {
                            $("[id^=coluna_").each(function(){
                                id_ = $(this).attr("id");
                                if (id_.indexOf("_"+mod_+"_"+perf_) >= 0 ) {
                                    id_coluna_ = $(document).find("#"+id_);
                                    id_coluna_.editable('setValue','B');
                                }
                            });
                            saveCOL ('muda_estado', '', mod_, perf_, 'B');
                        }
                    } else {
                        //id_wkf_.show();
                        id_wkf_.removeClass("gosth");
                        id_wkf_.editable('setValue','B');
                        saveWKF ('wkf', mod_, perf_,'B');
                        
                        // se muda acesso para Manutenção => colunas RGPD = ativas
                        $("[id^=coluna_").each(function(){
                            id_ = $(this).attr("id");
                            if (id_.indexOf("_"+mod_+"_"+perf_) >= 0 ) {
                                id_coluna_ = $(document).find("#"+id_);
                                id_coluna_.editable('setValue','A');
                            }
                        });
                        saveCOL ('muda_estado', '', mod_, perf_, 'A');
                    }
                }
            });

        } 
        
        $("#loading").hide();
        
        //SHOW or HIDE -> RGPD DETAILS
        $(document).on('click','[class^=MC_]', function(e) {
            var el = $(this),
                module = el.data('module'),
                details = $('table.innerLabelTable tr.dbColumns.M_' + module);

            if ( !el.hasClass('mostraDetails') ) { //Show DATA
                el.addClass('mostraDetails');
                
                details.each(function( index ) {
                    det_ = $(this);
                    det_.css('display','table-row');
                    // inicialização do plugin Editable associado à ativação/inativaçao de colunas do RGPD
                    if (!el.hasClass('pluginDone')) {
                        det_.find("a.coluna").each(function(res) {
                            $(this).editable({limit: 1,source: [{value: 'A',text: "<?php echo $ui_active;?>"}, {value: 'B',text: "<?php echo $ui_inactive;?>"}]});
                        });
                    }
                });
                
                if (!el.hasClass('pluginDone')) {
                    el.addClass('pluginDone');
                }
                
            } else { //Hide DATA
                details.each(function( index ) {
                    //console.log( index + ": " + $( this ).text() );
                    $(this).css('display','none');
                });
                el.removeClass('mostraDetails');
            }

        });
        //END SHOW or HIDE -> RGPD DETAILS
        
        $(document).on('click','#gera_recursos', function(e) {
            e.stopImmediatePropagation();

            //            
            //Clear warnings & Input ERROR properties
            quad_notification_clear();

            var t0 = performance.now(),
                wk = new Worker(pn + "assets/lib/utils/workerRouter.js"),
                message = {
                    request_id: 'workflows',
                    acao: 'gera_recursos',
                    defaults: datatable_instance_defaults.pathToSqlFile
                },
                mssg = '',
                this_ = $(this);
            wk.postMessage(JSON.stringify(message));
            this_.prop("disabled", true);
            wk.onmessage = function (event) {                
                if (event.data === 'working') {
                    return;
                } else {
                    t1 = performance.now();
                    tmp = millisToMinutesAndSeconds(t1 - t0);
                    if (event.data) {
                        this_.prop("disabled", false);
                        if (event.data.msg === 'OK') { 
                            mssg = "<?php echo $ui_successful_operation; ?>";                                
                            //mssg = mssg.replace(" {0}", " " + tmp + " (MM:SS)");
                            quad_notification({
                                    type: "success",
                                    title : JS_OPERATION_COMPLETED,
                                    content : '<i class="glyphicon glyphicon-thumbs-up"></i>&nbsp;<i>' + mssg + '</i>',
                                    timeout : 5000
                            });
                        } 
                        else {
                            var mssg = event.data.msg.substr(5);
                            quad_notification({
                                    type: "error",
                                    title : JS_OPERATION_ERROR,
                                    content : '<i class="glyphicon glyphicon-thumbs-down"></i>&nbsp;<i>' + mssg + '</i>'
                            });
                        }
                    }
                }
            };          
        });
        
    };
    
    $(document).ready(function () {
        pagefunction();
    });
    
    //runAllForms();
    var pagedestroy = function() {
        //Remove EVENTS
        $(document).off('click','[class^=MC_]');
        $('.acesso,.workflow,.notificacao').off('save');
        $('.coluna').off('save');
        //Clear DOM
        $('#xpto').remove();
    }
</script>