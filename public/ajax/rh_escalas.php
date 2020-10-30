<?php
/*
 *  @autor      Pedro Mengo de Abreu <pedro.mengo.abreu@quad-systems.com>
 *  @projeto    QUAD-HCM
 *  @versão     1.0
 *  @revisão    2019.06.18
 *  @copyright  (c) 2019 QuadSystems - http://www.quad-systems.com
 *  @nome       quad_matrix_template.php
 *  @descrição  Template de renderização de dados por Calendário (Ex: Escalas Horárias, etc))
 *
 */
session_start();
require_once("../init.php");

#Inicializações
$msg = '';
$msg_aviso = '';

#Empresa
$empresa = @$_REQUEST['empresa'];

#Estabelecimento
$estab = @$_REQUEST['estab'];

#Ano/Mês por defeito
if (@$_REQUEST['ano'] != '') {
    $ano = @$_REQUEST['ano'];
} else {
    $ano = date('Y');
}

if (@$_REQUEST['mes'] != '') {
    $mes = @$_REQUEST['mes'];
} else {
    $mes = date('m');
}

if (substr($mes, 0, 1) == '0') {
    $mes = substr($mes, 1, 1);
}

$rhid = @$_REQUEST['rhid'];

$setor = @$_REQUEST['setor'];
if ($setor == "")
    $setor = "%";

#$modulo = le_modo_modulo(10, $msg);
$modulo = 'A';
$modelo = @$_REQUEST['modelo'];
if (!$modelo) {
    $modelo = "1"; //[1]-Escalas Horárias
}

//FILENAME :: To compose ERROR available to JS (FASE 2)
$frm = strtoupper( basename(__FILE__,'.php') );
//CHECK IF FILE EXISTS AND IS JSON 
$frm_definitions = go_no_go(__FILE__, $wkf_error, $seconds);
//echo "<br>". "( $seconds )" . "<br>". $frm_definitions;     
?>

<!-- CSS OPTIMIZATION STEPS -->
<!--<link rel="stylesheet" href="<?php echo ASSETS_URL . '/css/rh_escalas.min.css'; ?>">
<link rel="stylesheet" href="<?php echo ASSETS_URL . '/js/chartist/chartist.min.css'; ?>">
<link rel="stylesheet" href="<?php echo ASSETS_URL . '/js/chartist/chartist-plugin-tooltip.min.css'; ?>">-->

<!-- Fusão dos 3 ficheiros comentados -->
<!--<link rel="stylesheet" href="<?php echo ASSETS_URL . '/css/rh_escalas.full.min.css'; ?>">-->

<!-- https://web.dev/defer-non-critical-css/ -->
<link rel="preload" href="<?php echo ASSETS_URL . '/css/rh_escalas.full.min.css'; ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="<?php echo ASSETS_URL . '/css/rh_escalas.full.min.css'; ?>"></noscript>

<style>
.sticky-intersect {
    background-color: aliceblue!important;
}

/* TO CHECK */
/**/        
    /* Escalas "Inibidas" */
    .pastScale {
        color: #d6a848 !important;
    }
    .dia_descanso.pastScale {
        background-color: #ced0ce4f !important;
    }      

    th.monthClosed {
        text-align: center!important;
        vertical-align: middle!important;
        font-size: 2.5em!important;
        color: #b09b5b!important;
    }

</style>


<div id="xpto">

    <div class="row" id="escalasHorarias">
        
        <div class="col-xl-12">
            
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                        <span class="widget-icon"> <i class="far fa-calendar-alt"></i></span>
                        <h2><?php echo $ui_time_scales; ?></h2>
                </div>
                
                <div id="wid-1" class="panel-container show">
                    <div class="panel-content">
                             
                        <form action="" id="filter_form" style="height: 16vh;display: contents;" novalidate="novalidate">
                            <input id="ano_sel" type="hidden" value="<?php echo $ano; ?>">
                            <input id="empresa_sel" type="hidden" value="<?php echo $empresa; ?>">
                            <input id="mes" type="hidden" value="<?php echo $mes; ?>">
                            <input id="estab_val" type="hidden" value="<?php echo $estab; ?>">
                            <input id="setor_val" type="hidden" value="<?php echo $setor; ?>">
                            <input id="rhid_filtro" type="hidden" value="<?php echo $rhid; ?>">  

                            <div class="form-row form-group mb-0 row-no-scroll">                            
                                <div class="col-md-2 mb-3">
                                    <label class="form-label" for="empresa"><?php echo $ui_company; ?></label>
                                    <select name="empresa" id="empresa" class="form-control required" data-placeholder="<?php echo $ui_select_one_option; ?>"></select>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="form-label" for="estab"><?php echo $ui_establishment; ?></label>
                                    <select name="estab" id="estab" class="form-control" data-placeholder="<?php echo $ui_select_one_option; ?>"></select>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="form-label" for="setor"><?php echo $ui_sector; ?></label>
                                    <select name="setor" id="setor" class="form-control" data-placeholder="<?php echo $ui_select_one_option; ?>"></select>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="rhid"><?php echo $ui_employee; ?></label>
                                    <select name="rhid" id="rhid" class="form-control" data-placeholder="<?php echo $ui_select_one_option; ?>"></select>
                                </div>
                            </div>
                            <div class="form-row form-group mb-0 row-no-scroll">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="horarios_diarios"><?php echo $ui_daily_schedules; ?></label>
                                    <select name="horarios_diarios" id="horarios_diarios" class="form-control" multiple data-placeholder="<?php echo $ui_select_one_option; ?>"></select>
                                </div>

                                <div class="col-md-2 mb-3">
                                    <div class="btn-group" id="RH_PROCESSOS_AVALIACAO_actions" style="margin-top: 20px;">
                                        <button type="button" class="btn btn-primary dropdown-toggle waves-effect waves-themed" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="ni ni-energy mr-1" style="margin-left: -5px;"></i><?php echo $ui_actions; ?>
                                        </button>
                                        <div class="dropdown-menu dropdown-sm" x-placement="bottom-start" style="position: absolute; top: 37px; left: 0px; will-change: top, left;">
                                            <button id="saveEscalas" class="dropdown-item" type="button"><span><i class="fas fa-cog"></i><?php echo $ui_execute;?></span></button>
                                            <button id="clearEscalas" class="dropdown-item" type="button"><span><i class="fas fa-undo-alt"></i><?php echo $ui_reset_filter;?></span></button>
                                            <button id="clearAllEscalas" class="dropdown-item" type="button"><span><i class="fas fa-sync"></i><?php echo $ui_reset;?></span></button>
                                        </div>
                                    </div>                                
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <div class="loadingGif"></div>
                                </div>
                            </div>

                        </form>

                        <div class="details slide-in-right">
                            <div class="form-row mb-3" style="display: block;">
                                <div style="position: relative;">
                                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div>
                                            
                                            <table id="year" class="table responsive" width="100%" style="table-layout:fixed;margin-bottom: -5px;">
                                                <tr style="text-align: center;">
                                                    <th style="width:14.9666%;">
                                                        <label class="control-label hidden-xs hidden-sm hidden-md"><?php echo $ui_year; ?></label>
                                                        <select id="ano" name="ano" class=""></select>  
                                                        <?php
                                                            calendar_Year_Month($ano, $mes);
                                                        ?>
                                                    </th>
                                                </tr>
                                            </table>
                                            <div class="no_year_found">
                                                <?php echo $msg_filter_reselection_no_data_found; ?>
                                            </div>
                                        </div>

                                        <!-- Placeholder da zona do calendário -->
                                        <div id="calendario">
                                            <table class="table table-responsive">
                                                <tr class="hdr-scale">
                                                    <td class="hdr-scale" style="">&nbsp;</td>
                                                </tr>
                                            </table>
                                        </div> 
                                    </article>
                                </div>
                            </div>

                            <div class="form-row mb-3" style="display: block;">
                                <div id="dayDistribution" class="widget-body no-padding col col-lg">
                                    <h3 class="page-title"></h3>
                                    <div id="graphDay" class="ct-chart"></div>                                    
                                </div> 
                            </div>
                        </div>
                        
                    </div>
                </div>
                
            </div>            
        </div>
    </div>

    <div id="popover-escala" class="hide">
        <div id="pop-escala">
            <table>
                <tr id="1per">
                    <td><?php echo $ui_1_period; ?></td>
                    <td id="p1"></td>
                </tr>
                <tr id="2per">
                    <td ><?php echo $ui_2_period; ?></td>
                    <td id="p2"></td>
                </tr>
                <tr>
                    <td><?php echo $ui_duration; ?></td>
                    <td id="duracao"></td>
                </tr>
                <tr>
                    <td><?php echo $ui_day_start; ?></td>
                    <td id="ini_dia"></td>
                </tr>
            </table>
        </div>
    </div>    
    
</div>

<script>
        pageSetUp();
        var nomeForm = '<?php echo json_encode($frm); ?>', continue_,        
            tabelas = ['RH_ESCALAS'];
    
//            continue_ = go_no_go ('<?php echo json_encode($wkf_error); ?>', _user, _profile); //IF (CRUD + WORKFLOW) problem -> EXIT
    
        var horarios_toCopy = []; //"PATTERN MODE" ARRAY of horários diários
        var pagefunction = function () {
            var horarios_toCopy = [];
            var refreshing = false;
            
            var conf_ESCALAS = JSON.parse('<?php echo $frm_definitions; ?>');            
                    
            //IF ACCESS to ESCALAS is FALSE -> EXIT
            if ( !conf_ESCALAS['RH_ESCALAS']["access"] ) {
                $('#left-panel > nav > ul > li.open.active > ul > li:nth-child(1) > a').trigger('click');
                $('#left-panel li > a[href="ajax/rh_escalas.php"]').parent('li').remove();
            }                    
                    
            //Chosen extended to "PATTERN MODE"
            $("#horarios_diarios").chosen({
                allow_duplicates: true, //PMA: Chosen extension!!
                disable_search_threshold: 10,
                no_results_text: "Oops, nothing found!",
                enable_split_word_search: true,
                search_contains: true,
                width: "95%",
                afterUpdate: function() {
                    //setTimeout ( function() {
                        //After each CHOICE interaction builds array with CHOICES VALUES ORDERED
                        horarios_toCopy = [];
                        var choices =  $(document).find('#horarios_diarios_chosen > ul > li.search-choice > span');
                        if (choices.length) {
                            choices.each ( function (i) {
                                //console.log ( i + " " + $(this).data('value') ); 
                                horarios_toCopy.push( $(this).data('value') );
                            });
                        }
                    //},100);
                } 
            });            
           
            //DATA
            if (1 === 1) {
                //Popula lista de empresas
                function lista_empresas() {
                    $.ajax({
                        type: "POST",
                        url: pn + "data-source/quad_lists_lib.php",
                        data: "request_id=EMPRESA" +
                                "&listsMod=ALL",
                        cache: true,
                        async: false,
                        success: function (html) {
                            var lista_EMPRESAS = $("#empresa");
                            lista_EMPRESAS.empty();

                            //Trata lista recebida das empresas
                            var lista_ = JSON.parse(html);
                            lista_.forEach(function (item, index) {
                                lista_EMPRESAS.append($("<option></option>")
                                        .attr("value", item.EMPRESA)
                                        .text(item.DSP_EMPRESA));
                            });
                            $("#filter_form").trigger("chosen:updated");
                        }
                    });
                }

                //Popula lista de estabelecimentos
                function lista_estabs(estab_) {
                    var params_ = [];
                    params_[0] = $("#empresa").val();
                    params_[1] = estab_;
                    $.ajax({
                        type: "POST",
                        url: pn + "data-source/quad_lists_lib.php",
                        data: "request_id=ESTAB_COLABS" +
                                "&params_array=" + JSON.stringify(params_) +
                                "&listsMod=ALL",
                        cache: true,
                        async: false,
                        success: function (html) {
                            var lista_ESTAB = $("#estab");
                            lista_ESTAB.empty();

                            // trata lista recebida dos estabelecimentos
                            var lista_ = JSON.parse(html);
                            lista_.forEach(function (item, index) {
                                lista_ESTAB.append($("<option></option>")
                                        .attr("value", item.CD_ESTAB)
                                        .text(item.DSP_ESTAB));
                            });

                            if (estab_ !== '') {
                                lista_ESTAB.val(estab_);
                            } else {
                                lista_ESTAB.val($("#estab option:first").val());
                            }
                            $("#estab").trigger("chosen:updated");
                            $("#setor").trigger("chosen:updated");
                        }
                    });
                }

                //Popula lista de setores
                function lista_setores(setor_) {
                    var params_ = [];
                    params_[0] = $("#empresa").val();
                    params_[1] = $("#estab").val();
                    params_[2] = setor_;

                    $.ajax({
                        type: "POST",
                        url: pn + "data-source/quad_lists_lib.php",
                        data: "request_id=SETORES_COLABS" +
                                "&params_array=" + JSON.stringify(params_) +
                                "&listsMod=ALL",
                        cache: true,
                        async: false,
                        success: function (html) {
                            var lista_SETOR = $("#setor");
                            lista_SETOR.empty();

                            // adiciona opção de todos os setores
                            lista_SETOR.append($("<option></option>")
                                    .attr("value", "%")
                                    .text("<?php echo $ui_all; ?>"));

                            // trata lista recebida dos estabelecimentos
                            var lista_ = JSON.parse(html);
                            lista_.forEach(function (item, index) {
                                lista_SETOR.append($("<option></option>")
                                        .attr("value", item.ID_SETOR + "@" + item.DT_INI_SETOR)
                                        .text(item.DSP_SETOR));
                            });

                            if (setor_ !== '') {
                                lista_SETOR.val(setor_);
                            } else {
                                lista_SETOR.val($("#setor option:first").val());
                            }
                            $("#setor").trigger("chosen:updated");
                        }
                    });
                }

                //Popula lista de anos disponíveis
                function lista_anos(ano_) {
                    var params_ = [];
                    params_[0] = $("#empresa").val();
                    params_[1] = ano_;
                    $.ajax({
                        type: "POST",
                        url: pn + "data-source/quad_lists_lib.php",
                        data: "request_id=DG_ANOS" +
                                "&params_array=" + JSON.stringify(params_) +
                                "&listsMod=ALL",
                        cache: true,
                        async: false,
                        success: function (html) {
                            var lista_ANOS = $("#ano");
                            lista_ANOS.empty();
                            
                            // trata lista recebida dos ano
                            var lista_ = JSON.parse(html);
                            lista_.forEach(function (item, index) {
                                lista_ANOS.append($("<option></option>")
                                        .attr("value", item.ANO)
                                        .text(item.ANO));
                            });

                            if (ano_ !== '') {
                                lista_ANOS.val(ano_);
                            } else {
                                lista_ANOS.val($("#ano option:first").val());
                            }
                        }
                    });
                }

                //Popula lista de colaboradores disponíveis
                function lista_rhids(rhid_) {
                    var params_ = [];
                    params_[0] = $("#empresa").val();
                    params_[1] = rhid_;

                    $.ajax({
                        type: "POST",
                        url: pn + "data-source/quad_lists_lib.php",
                        data: "request_id=COLABS_ACTIVE" +
                                "&params_array=" + JSON.stringify(params_) +
                                "&listsMod=ALL",
                        cache: true,
                        async: false,
                        success: function (html) {
                            var lista_RHID = $("#rhid");
                            lista_RHID.empty();

                            // adiciona opção de todos os setores
                            lista_RHID.append($("<option></option>")
                                    .attr("value", "%")
                                    .text("<?php echo $ui_all; ?>"));

                            // trata lista recebida dos estabelecimentos
                            var lista_ = JSON.parse(html);
                            lista_.forEach(function (item, index) {
                                lista_RHID.append($("<option></option>")
                                        .attr("value", item.RHID)
                                        .text(item.RHID + " - " + item.NOME));
                            });

                            if (rhid_ !== '') {
                                lista_RHID.val(rhid_);
                            } else {
                                lista_RHID.val($("#rhid option:first").val());
                            }
                            $("#rhid").trigger("chosen:updated");
                        }
                    });
                }

                //Popula dados com Tabela de Coeficientes
                function carrega_dados() {

                    //Destroy Graph if "ON"
                    if ( $('#calend1 > thead > tr.weekNumber > th.infoRhid > span.graphMode').length ) {
                        $('#calend1 > thead > tr.weekNumber > th.infoRhid > span.graphMode').trigger('click');
                    }
                    
                    //Hide "NO DATA FOUND" div
                    $('.no_year_found').hide('fast');
                    
                    //Activate "Loading GIF"
                    $('.loadingGif').removeClass('hide').addClass('show');
                     
                    $.ajax({
                        url: pn + "ajax/rh_escalas_details.php",
                        type: "POST",
                        data: "modulo=" + "<?php echo $modulo; ?>" +
                                "&modelo=" + "<?php echo $modelo; ?>" +
                                "&empresa=" + $("#empresa").chosen().val() +
                                "&estab=" + $("#estab").chosen().val() +
                                "&ano=" + $("#ano").val() +
                                "&mes=" + $("#mes").val() +
                                "&rhid=" + $("#rhid").chosen().val() +
                                "&setor=" + $("#setor").chosen().val(),
                        async: true,
                        cache: false,
                        success: function (html_) {
                            $("#calendario").html(html_);
                            setTimeout ( function() {
                                //Cálculo dos TOTAIS no FOOTER
                                var weeks = $('#calend1 > thead > tr > th[class^="week"]');
                                if (weeks) {
                                    weeks.each ( function (i) {
                                        updateFooter( parseInt($(this).text()) );
                                    });
                                }
                                //CRUD ?                                
                                if (conf_ESCALAS['RH_ESCALAS']["crud"][0] && conf_ESCALAS['RH_ESCALAS']["crud"][1] && conf_ESCALAS['RH_ESCALAS']["crud"][2]) {
                                    null;
                                } else {
                                    disabledChanges();
                                }
                                
                                $(".chosen-select").chosen();
                                $("#filter_form").trigger("chosen:updated");
                                
                                if ( !$('#ano').val() ) {
                                    $('.no_year_found').show('fast');
                                    $('#year').hide('fast');
                                    $('.executionTime').hide('fast');
                                } else {   
                                    $('#year').show('fast');
                                    $('.executionTime').show('fast');
                                }

                                //Inactivate "Loading GIF"
                                $('.loadingGif').removeClass('show').addClass('hide');

                            },10);
                        }
                    });
                    
                }

                //Popula Horários Diários
                function horarios_diarios() {
                    $.ajax({
                        type: "POST",
                        url: pn + "data-source/quad_lists_lib.php",
                        data: "request_id=RH_DEF_HORARIO_DIAS" +
                                "&listsMod=ALL",
                        cache: true,
                        async: true,
                        success: function (html) {
                            var lista_HORARIOS = $("#horarios_diarios");
                            lista_HORARIOS.empty();

                            //Trata lista recebida das empresas
                            var lista_ = JSON.parse(html);
                            lista_.forEach(function (item, index) {
                                lista_HORARIOS.append($("<option></option>")
                                        .attr("value", item.VAL)
                                        .text(item.DSP));
                            });
                            $("#horarios_diarios").trigger("chosen:updated");
                        }
                    });
                }   
                
                //INIBE alterações às Escalas
                function disabledChanges () {

                    var escalas_fields = $("#calendario input.myMenu");
                    $('#horarios_diarios').prop('disabled', true).trigger("chosen:updated");
                    $('#actions').prop('disabled', true);
                    
                    escalas_fields.each( function(idx) {
                        //Disabled ITEM also disables TOOLTIP
                        $( this ).addClass("pastScale");
                    });
                }
            }
            //END DATA

            //Filters :: EVENTS
            if ( 1 === 1 ) {
                //Filter Empresa Event
                $(document).on('change', "#empresa", function (evt) {
                    evt.stopImmediatePropagation();
                    /* Reset DISABLED if APPLYED */
                    $("#estab_chosen").removeClass('forbidden-bc-grey'); //OR not-available
                    $("#estab_chosen > a > span").css('color', 'inherit');
                    $("#estab_chosen").parent('label.input').css('cursor', 'default');
                    $("#setor_chosen").removeClass('forbidden-bc-grey');  //OR not-available
                    $("#setor_chosen > a > span").css('color', 'inherit');
                    $("#setor_chosen").parent('label.input').css('cursor', 'default');
                    
                    lista_estabs('');
                    lista_setores('%');
                    lista_anos('');
                    lista_rhids('');
                    carrega_dados();
                });

                //Filter Estab Event
                $(document).on('change', "#estab", function (evt) {
                    evt.stopImmediatePropagation();
                    lista_setores('%');
                    carrega_dados();
                });

                //Filter Sector Event
                $(document).on('change', "#setor", function (evt) {
                    evt.stopImmediatePropagation();
                    carrega_dados();
                });

                //Filter Ano Event
                $(document).on('change', "#ano", function (evt) {
                    evt.stopImmediatePropagation();
                    //$('#escalasHorarias').css( 'cursor', 'url(contiLoading.svg), auto' );
                    carrega_dados();
                });

                //Filter RHID Event
                $(document).on('change', "#rhid", function (evt) {
                    evt.stopImmediatePropagation();
                    if ($("#rhid").val() !== '%') {
                        /* Set DISABLED after RHID selection on ESTAB and SECTOR */
                        $("#estab_chosen").addClass('forbidden-bc-grey');  //OR not-available
                        $("#estab_chosen > a > span").css('color', 'darkgrey');
                        $("#estab_chosen").parent('label.input').css('cursor', 'not-allowed');

                        $("#setor_chosen").addClass('forbidden-bc-grey'); //forbidden-bc-grey
                        $("#setor_chosen > a > span").css('color', 'darkgrey');
                        $("#setor_chosen").parent('label.input').css('cursor', 'not-allowed');
                    } else {
                        /* Reset DISABLED if APPLYED */
                        $("#estab_chosen").removeClass('forbidden-bc-grey');
                        $("#estab_chosen > a > span").css('color', 'inherit');
                        $("#estab_chosen").parent('label.input').css('cursor', 'default');
                        $("#setor_chosen").removeClass('forbidden-bc-grey');
                        $("#setor_chosen > a > span").css('color', 'inherit');
                    }
                    carrega_dados();
                });

                //Filter Title Month Event #1
                $(document).on('mouseenter', "[name^=m]", function (evt) {
                    evt.stopImmediatePropagation();
                    var param_ = $(this).attr("data").split("@");
                    if (param_[0] == $("#ano").val() && param_[1] == $("#mes").val()) {
                        $(this).css("cursor", "pointer");
                        $(this).addClass("corrente");
                    } else {
                        $(this).addClass("corrente_hover");
                        $(this).css("cursor", "pointer");
                    }
                });

                //Filter Title Month Event #2
                $(document).on('mouseleave', "[name^=m]", function (evt) {
                    evt.stopImmediatePropagation();
                    $(this).removeClass("corrente_hover");
                    $(this).css("cursor", "normal");
                    $("[data='" + $("#ano").val() + "@" + $("#mes").val() + "']").addClass("corrente");
                });

                //Filter Title Month Event #3
                $(document).on('click', "[name^=m]", function (evt) {
                    evt.stopImmediatePropagation();
                    var param_ = $(this).attr("data").split("@");
                    $("#ano").val(param_[0]);
                    $("#mes").val(param_[1]);
                    $("[name^=m]").removeClass("corrente");
                    $("[name=" + $(this).attr("name") + "]").addClass("corrente");
                    $(document).css('cursor', 'not-allowed');
                    carrega_dados();
                    $(document).css('cursor', 'default');
                });
            }
            //END Filters :: EVENTS
            
            //RESOURCES
            if (1 === 1) {            
                //Reset POPOVER on CHANGED Daily Schdule
                function bruteForcePopover (elm, dados) {
                    elm.popover('dispose').popover({
                            html: true,
                            animation: true,
                            trigger: 'hover',
                            sanitize: true, // implica que o app_quad.js centralmente extenda os recursos de tags de tabela que não são incluídos por defeito
                            placement: function (context, source) {
                                  //console.log(context);
                                //console.log( $(source).offset() ); //CURSOR POSITION
                                  var position = $(source).offset();
                                  //console.log( $(this));
                                  //var position = $(source).css(position);
                                  //console.log(position.left);    
                                  if (position.left < 280) {
                                      return "right";
                                  }

                                  if (position.top < 280){
                                      return "bottom";
                                  }

                                  else {
                                      return "right";
                                      return "left";
                                  }
                              return "top";
                            },
                            title: function () {
                              var td_elem = $(this)["0"].parentNode,
                                  td_context = $(td_elem).attr('id').split("@"), //id="'.$row['RHID'].'@'.$dia.'@'.$semana.'"
                                  txt = '';
                                  txt = '<i class="far fa-calendar-edit"></i>&nbsp;&nbsp;RHID ' + td_context[1] + '&nbsp;&nbsp;em&nbsp;&nbsp;' + td_context[2];
                                return txt;
                            },
                            content: function( ) {                                
                              var td_elem = $(this)["0"].parentNode,
                                  td_context = $(td_elem).attr('id').split("@"); //id="'.$row['RHID'].'@'.$dia.'@'.$semana.'"
                                  txt = '';
                              $('#ini_dia', '#popover-escala').text('');
                              $('#p1', '#popover-escala').text('');
                              $('#p2', '#popover-escala').text('');
                              $('#duracao', '#popover-escala').text('');

                              //Início de Dia
                              if ( dados['hor_esp_min'] ) {
                                  txt =  dados['ini_dia']; // $(td_elem).data('ini_dia');
                              } else {
                                  txt = '??:??';
                              }
                              $('#ini_dia', '#popover-escala').text(txt);

                              //1º Período
                              //if ( $(td_elem).data('e_1')) {
                              if ( dados['e_1'] ) {
                                  txt = dados['e_1'] + ' ' + dados['s_1'];                
                                  $('#1per', '#popover-escala').css('display', 'table-row');
                                  $('#p1', '#popover-escala').text(txt);
                              } else {
                                  $('#1per', '#popover-escala').css('display', 'none');
                              }

                              //2º Período
                              //if ($(td_elem).data('e_2')) {
                              if ( dados['e_2'] ) {
                                  txt = dados['e_2'] + ' ' + dados['s_2'];     
                                  $('#2per', '#popover-escala').css('display', 'table-row');
                                  $('#p2', '#popover-escala').text(txt);
                              } else {
                                  $('#2per', '#popover-escala').css('display', 'none');
                              }       

                              //Duração
                              if ( dados['hor_esp_hrs'] ) {
                                  txt = dados['hor_esp_hrs'];                
                              } else {
                                  txt = '00:00';
                              }
                              $('#duracao', '#popover-escala').text(txt);
                              
                              return $('#popover-escala').html();//' + id).html();
                            }
                        });
                }    
                
                //Manage Cell PATTERN COPY (Double-Click)
                function manageCellPattern (el, operation) {
                
                    var elm = $(el),
                        nr_horarios = horarios_toCopy.length, //Nr. Horários para copiar
                        prv_cod = elm.attr('prv_cod');
                    
                    quad_notification_clear();
                    if (operation === 'reset') {
                        if (nr_horarios === 1) {
                            elm.removeClass('toCopy').removeAttr('data-reserve');
                            elm.val(prv_cod).attr('value',prv_cod).removeAttr('prv_cod');
                            elm.blur(); //Remove FOCUS to avoid related popop
                        } else {
                            for (i = 0; i < nr_horarios; ++i) {
                                prv_cod = elm.attr('prv_cod');
                                if (i === 0) {
                                    elm.removeClass('toCopy').removeAttr('data-reserve');
                                    elm.val(prv_cod).attr('value',prv_cod).removeAttr('prv_cod');
                                    elm.blur(); //Remove FOCUS to avoid related popop
                                } else {
                                    elm.removeClass('setReserve');
                                    elm.val(prv_cod).attr('value',prv_cod).removeAttr('prv_cod');
                                }
                                elm = elm.parent('td').next('td').find('input'); //Next Cell       
                                if (!elm.length) { //BH + TH :: problem
                                    elm = $(el).parent('td').next('td').next('td').next('td').find('input'); //Next Cell
                                }
                            }
                        }
                    } else {
                        for (i = 0; i < nr_horarios; ++i) {
                            if (i === 0) {
                                if ( !elm.hasClass('setReserve') ) {
                                    elm.addClass('toCopy').attr('data-reserve', nr_horarios);

                                    //Set PATTERN CD_HORARIO
                                    elm.attr('prv_cod', elm.attr('value'));
                                    elm.attr('value',horarios_toCopy[i]);
                                    elm.val(horarios_toCopy[i]);

                                    elm.blur(); //Remove FOCUS to avoid related popop
                                } else {         
                                    quad_notification({
                                            type: "info",
                                            title : JS_OPERATION_ABORT,
                                            content : "<?php echo $time_scales_reserved_cell; ?>",
                                            timeout : 3500
                                    });
                                    break;
                                }
                            } else {
                                elm.addClass('setReserve');
                                //Set PATTERN CD_HORARIO
                                elm.attr('prv_cod', elm.val());
                                elm.attr('value',horarios_toCopy[i]);
                                elm.val(horarios_toCopy[i]);

                            }
                            elm = elm.parent('td').next('td').find('input'); //Next Cell
                            if (!elm.length) { //BH + TH :: problem
                                elm = $(el).parent('td').next('td').next('td').next('td').find('input'); //Next Cell
                            }
                        }
                    }
                    //IF CELLS REFERENCED TO COPY CHOSEN -> DISABLED
                    if ( $('#calend1 input.toCopy').length ) {
                        // To avoid UPDATE, because options SELECTED are RE-ORDERED according with attribute
                        // data-option-array-index (position in the LIST). Using PATTERNS the USER would be misleaded...
                        //$("#horarios_diarios").attr('disabled', true).trigger("chosen:updated");
                        $('#horarios_diarios_chosen').addClass('chosen-disabled');
                        
                    } else {
                        $('#horarios_diarios_chosen').removeClass('chosen-disabled');
                    }
                    return false; //Avoid's propagation(s)    
                }
                
                //Save CHANGED Daily Schdule
                function saveEscala (evt, elm) {
                    //TRICK to AVOID Replication :: CLONNED HEADER
//                    if (!evt.run) {
//                        evt.run = '1';
//                    } else {
//                        return;
//                    }
                    var el = $(elm),
                        td = $(elm).parent('td'),
                        codigo = el.val(),
                        key = td.attr('id'),
                        popElement = td.find ('span'),
                        isGraphOn = $('#dataContainer thead > tr > th > span.graphMode').length;
   
                    //Destroy POPOVER
                    //this_popover = $(elm).next("span[data-toggle=popover]");
                    //this_popover.popover('dispose');

                    //Clear warnings & Input ERROR properties
                    quad_notification_clear();
                    $(elm).css({"color": "", "border" : ""});                        
                  
                    if ( key) {
                        var t0 = performance.now(),
                            wk = new Worker(pn + "assets/lib/utils/workerRouter.js"),
                            message = {
                                request_id: 'GravaEscala',
                                key: key,
                                val: codigo,
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
                                        var dados = event.data.data,
                                            semana = td.attr("semana");
                                        
                                        //Remove all previous classes
                                        td.removeClass(); //From TD
                                        el.removeClass().addClass("myMenu"); //FROM INPUT
                                        el.attr('value', event.data.data['hor']);
                                        
                                        //Horário Diário aplicável no DIA
                                        if ( event.data.data['origem'] == 'E') { //Escala
                                            td.addClass("horario_escala");
                                        } else if (event.data.data['origem'] == 'T') { //Troca Horária
                                            td.addClass("horario_troca");
                                        } else if (event.data.data['origem'] == 'C') { //Cadastro
                                            td.addClass("horario_cadastro");
                                        }
                                            
                                        //Reset TD with NEW SCHEDULE ATTRIBUTES
                                        td.attr('data-bh', event.data.data['bh']);
                                        td.attr('data-th', event.data.data['th']);
                                        td.attr('data-ini_dia', event.data.data['ini_dia']);
                                        td.attr('data-horario', event.data.data['hor']);
                                        td.attr('data-e_1', event.data.data['e_1']);
                                        td.attr('data-s_1', event.data.data['s_1']);
                                        td.attr('data-e_2', event.data.data['e_2']);
                                        td.attr('data-s_2', event.data.data['s_2']);
                                        td.attr('data-hor_esp_min', event.data.data['hor_esp_min']);
                                        td.attr('data-hor_esp_hrs', event.data.data['hor_esp_hrs']);
                                        td.attr('data-cd_turno', event.data.data['cd_turno']);
                                        td.attr('data-dsp_turno', event.data.data['dsp_turno']);

                                        //Indisponibilidade no dia
                                        if (event.data.data['hor_esp_min'] == 0) {
                                            el.addClass("dia_descanso");
                                        }
                                        if (event.data.data['indisp_fer'] == 'S' || event.data.data['indisp_dc'] == 'S' || event.data.data['indisp_aus'] == 'S' || event.data.data['indisp_bh']) {
                                            //A função retorna todos os aplicáveis. Neste contexto vamos mostrar só a 1ª ocorrência...
                                            if (event.data.data['indisp_aus'] == 'S') {
                                                el.addClass("indisp_aus");
                                            } else if (event.data.data['indisp_fer'] == 'S') {
                                                el.addClass("indisp_fer");
                                            } else if (event.data.data['indisp_bh'] == 'S') {
                                                el.addClass("indisp_bh");
                                            } else if (event.data.data['indisp_dc'] == 'S') {
                                                el.addClass("indisp_dc");
                                            }
                                        }
                                 
                                        //Totais da Semana
                                        var weekRows = $(td).parent('tr').find('td[semana="' + semana + '"]'), 
                                            bh_transp = 0.00, th_transp = 0.00, bh = 0.00, th = 0.00, tot_th = 0.00, tot_bh = 0.00,
                                            th_cell = /^TH*/g, bh_cell = /^BH*/g;
                                    
                                        weekRows.each (function (index) {
                                            var elm = $(this);
                                            
                                            if (index === 0) {
                                                bh_transp = parseFloat(elm.attr('bh_transp')) ? parseFloat(elm.attr('bh_transp')) : 0;                                                
                                                th_transp = parseFloat(elm.attr('th_transp')) ? parseFloat(elm.attr('th_transp')) : 0;
                                                bh = parseFloat(elm.attr('data-bh')) ? elm.attr('data-bh') : 0;
                                                th = parseFloat(elm.attr('data-th')) ? elm.attr('data-th'): 0;
                                                tot_bh = parseFloat(bh_transp) + parseFloat(bh);
                                                tot_th = parseFloat(th_transp) + parseFloat(th);
                                            } else {
                                                if ( th_cell.exec( elm.attr('id') ) ) {
                                                    elm.html(tot_th);
                                                } else if ( bh_cell.exec( elm.attr('id') ) ) {
                                                    elm.html(tot_bh);
                                                } else {
                                                    bh = parseFloat(elm.attr('data-bh')) ? parseFloat(elm.attr('data-bh')) : 0;
                                                    th = parseFloat(elm.attr('data-th')) ? parseFloat(elm.attr('data-th')) : 0;                                                    
                                                    tot_bh = parseFloat(tot_bh) + parseFloat(bh);
                                                    tot_th = parseFloat(tot_th) + parseFloat(th);
                                                }
                                            }
                                        });  

                                        //setTimeout (function () {
                                            bruteForcePopover(popElement, $(td)[0]['dataset']);
                                            updateFooter(semana);

                                            //Destroy GRAPH
                                            $('#dataContainer thead > tr > th > span.graphMode').trigger('click');
                                            
                                            //IF GRAPH WAS ON -> REDRAW IT
                                            if (isGraphOn) {
                                                var dia = td.attr('dia');
                                                //Redraw Graph for DAY
                                                $('table.sticky-thead > thead > tr.dayWeek th > a[data-day="' + dia +'"]').trigger('click');
                                            }
                                     
                                        //},900);
                                    } else {
                                        var mssg = event.data.error;
                                        //Typically Unexistent Daily Schedule...                                        
                                        $(elm).css({"color": "red", "border" : "1px dashed red"});
                                        $(elm).focus();
                                        $(elm).popover('hide');
                                        quad_notification({
                                                type: "error",
                                                title : JS_OPERATION_ERROR,
                                                content : '<i class="glyphicon glyphicon-thumbs-down"></i>&nbsp;<i>' + mssg + '</i>',
                                        });
                                    }
                                }
                            }                            
                        };          
                    }            
                    
                }
                
                //Update FOOTER for a given Week
                function updateFooter(semana) {
                    var bh_elements = $('table#calend1 > tbody > tr td.base_hor[semana="' + semana + '"]'),
                        //tot_th = $('table#calend1 > tbody > tr td.tot_hor[semana="' + semana + '"]'),
                        tot_bh = 0, tot_th = 0;
                    bh_elements.each( function(i) {
                        tot_bh += parseFloat( $(this).text() );
                        tot_th += parseFloat( $(this).next('td.tot_hor[semana="' + semana + '"]').text() );
                    });

                    $('table#calend1 > tbody > tr.footerLine td.tot_bh[semana="' + semana + '"]').text(tot_bh.toFixed(2));
                    $('table#calend1 > tbody > tr.footerLine td.tot_th[semana="' + semana + '"]').text(tot_th.toFixed(2));
                    //Force resize after total calculation (because of sticky header BH and TH "new" widths)
                    //$(function(){ //when DOM READY
                    $(window).trigger('resize'); 
                    //});
                };
                
                //RhID replication of Daily Scales
                function modalRhid (controller) {
                    var tar, htm, title;

                    //Título da janela
                    if (title === '') {
                        title = 'Replicação de Escalas';
                    }

                    htm = '<div class="modal fade" id="FiltroReplicacao" role="dialog">'+
                          ' <div class="modal-dialog" style="display: grid;">'+
                          '  <div class="modal-content">'+
                          '  <div class="modal-header">'+
                          '     <h6>'+ "<?  echo $ui_time_scales_replication; ?>" + 
                          '         <span style="float:right;"><button type="button" class="close" data-dismiss="modal" style="font-size: 1.5em;">&times;</button><span></h6>' +
                          '';
                     if (title) {
                        htm += '       <h4 class="modal-title"><i class="fal fa-id-card"></i>  ' + title + '</h4>';
                     } 
                     htm += '   </div>'+
                            '       <div class="modal-body">' + 
                            '<form id="rep_escalas" name="rep_escalas" action="#" method="POST">' + 
                      
                            '	<table border="0" style="width:98%">' + 
                            '       <tbody>' +
                            '           <tr>' + 
                            '               <td colspan="9">' +
                            '                   <div class="quad-alert alert alert-block alert-info" style="margin: 7px -3px 0px 0px;"><i class="far fa-info-circle" style="font-size: 18px;padding-right:8px;"></i>' + "<?php echo $hint_all_signaled_fields_are_mandatory; ?>" + '</div>' + 
                            '		    </td>' + 
                            '           </tr>' + 
                            '		<tr style="height:10px"><td colspan="9">&nbsp;</td></tr>' + 
                            '		<tr>' + 
                            '                	<td colspan="4" style="margin-top:10px;text-align:center;font-weight:bold">Período de Referência</td>' + 
                            '			<td style="width:40px">&nbsp;</td>' + 
                            '			<td colspan="4" style="text-align:center;font-weight:bold">Período de Replicação</td>' + 
                            '                </tr>' + 
                            '		<tr style="height:60px">' + 
                            '                	<td style="padding: 0px 6px;">Dt.Início<sup>*</sup></td>' + 
                            '			<td>' + 
                            '				<input type="text" name="ref_dt_ini" id="dtpicker_ref_dt_ini" value="" class="datepicker" data-datatype="date">' + 
                            '			</td>' + 
                            '                	<td style="padding: 0px 6px;">Dt.Fim<sup>*</sup></td>' + 
                            '			<td>' + 
                            '				<input type="text" name="ref_dt_fim" id="dtpicker_ref_dt_fim" value="" class="datepicker" data-datatype="date">' + 
                            '			</td>' + 
                            '			<td>&nbsp;</td>' + 
                            '                	<td style="padding: 0px 6px;">Dt.Início<sup>*</sup></td>' + 
                            '			<td>' + 
                            '				<input type="text" name="rep_dt_ini" id="dtpicker_rep_dt_ini" value="" class="datepicker" data-datatype="date">' + 
                            '			</td>' + 
                            '                	<td style="padding: 0px 6px;">Dt.Fim<sup>*</sup></td>' + 
                            '			<td>' + 
                            '				<input type="text" name="rep_dt_fim" id="dtpicker_rep_dt_fim" value="" class="datepicker" data-datatype="date">' + 
                            '			</td>' + 
                            '                </tr>' + 
                            '		<tr>' + 
                            '                	<td colspan="9" style="padding: 30px 0px 0px 0px;">' + 
                            '                        <table>' + 
                            '                          <tbody><tr>' + 
                            '                          	<td style="padding: 0px 6px;font-weight:600;">' + "<?php echo $hint_replication_period_unchanged; ?>"+ '</td>' + 
                            '                            	<td><input type="checkbox" name="rep_replace" value="ON"></td>' + 
                            '                          </tr>' + 
                            '                        </tbody></table>' + 
                            '                        </td>' + 
                            '                </tr>' + 
                            '        </tbody></table>' + 
                            '	</form>' + 
                        '   </div>'+
                        '    <div class="modal-footer" style=background-color: #e5e5e566;padding: 8px 13px 10px 4px;>'+
                        '        <button type="button" class="btn btn-default" data-dismiss="modal">' + JS_CLOSE + '</button>'+
                        '        <button type="button" class="btn btn-default" data-dismiss="modal" id="returnModalQUAD_HCM">' + JS_EXECUTE + '</button>'+
                        '    </div>'+
                        '</div>'+
                        '</div>'+
                        '</div>';

                    if  (!$("#FiltroReplicacao").length) {
                        $("#content").after(htm);
                        try {
                            $('#FiltroReplicacao > div.modal-dialog').css('width', width);
                        } catch (e) {
                            null;
                        }
                    }
                    setTimeout(function(){
                        //$('.modal-body').load(controller,{ showColumns: visibleColumns } ,function(){
                            //$("#returnModalQUAD_HCM").hide();
                            $('#FiltroReplicacao').modal({show:true});
                            
                            $(".datepicker", '#FiltroReplicacao').datepicker({
                                dateFormat: "yy-mm-dd",
                                prevText: '<i class="fa fa-chevron-left"></i>',
                                nextText: '<i class="fa fa-chevron-right"></i>',
                                constrainInput: false,
                                //este código não está a fazer nada. Era para fazer pesquisas utilizando expressão mais datepicker value
                                beforeShow: function () {
                                    $(this).val();
                                },
                                onSelect: function (dateText) {
                                    if ($(this).data("previous")) {
                                        $(this).val($(this).data("previous") + dateText);
                                    }
                                    $(this).focus();
                                }
                            });                            
                        //});
                        
                    },100);
                }                
            }
            
            //EVENTS
            if (conf_ESCALAS['RH_ESCALAS']["crud"][0] && conf_ESCALAS['RH_ESCALAS']["crud"][1] && conf_ESCALAS['RH_ESCALAS']["crud"][2]) {
                //DBLClick PATTERN COPY MASTER-EVENT to "Reserve" CELL(s)
                $(document).on("dblclick", "input.myMenu", function(evt) {
                    evt.preventDefault();
                    evt.stopPropagation();
                    if ( $(this).hasClass('toCopy') ) { //Se selecionado e houve doubleclick : remove a seleção e repõe valor
                        manageCellPattern ($(this), 'reset');
                    } else {
                        manageCellPattern ($(this), 'set');
                    }
                });
                
                //Save Escalas "PATTERN"
                $("#saveEscalas").on("click", function (evt) {
                    //TRICK to AVOID Replication :: CLONNED HEADER
                    if (!evt.run) {
                        evt.run = '1';
                    } else {
                        return;
                    }      
                    var elems = $('#calend1 input.toCopy, #calend1 input.setReserve');

                    quad_notification_clear();
                    if ( elems.length ) {
                        $.each( elems, function( key, value ) {
                            evt.run = '0';
                            saveEscala (evt, $(this));
                            //$(this).removeClass('toCopy').removeAttr('data-reserve').removeClass('setReserve');
                        });

                    }

                    //Clear Chosen -> Might be used again...
                    //$("#horarios_diarios").val('');

                    //Enable other "PATTERN" rally
                    $("#horarios_diarios").attr('disabled', false).trigger("chosen:updated");
                });
                
                //Clear Escalas "PATTERN"
                $(document).on("click", "#clearEscalas, #clearAllEscalas", function (evt) {                    
                    var elems = $('#calend1 input.toCopy');

                    quad_notification_clear();
                    if ( elems.length ) {
                        $.each( elems, function( key, value ) {
                            var el = $(this);
                            //el.removeClass('toCopy').removeAttr('data-reserve').removeClass('setReserve');
                            manageCellPattern (el, 'reset');
                        });
                    }

                    if ( $(this).attr('id') === 'clearAllEscalas' ) {
                        //Clear Chosen
                        $("#horarios_diarios").val('');
                    }
                    $("#horarios_diarios").attr('disabled', false).trigger("chosen:updated");
                });

                //Inicialização de Componentes :: DOM
                $(".chosen-select").chosen();
                $("#filter_form").trigger("chosen:updated");
                $('.chosen-container-active').each(function (i) {
                    $(this).closest('div').css('z-index', 999 - i);
                });
                
                //EVENT on CHANGED Daily Schedule
                $(document).on('change', 'input.myMenu', function (evt) {
                   if ( $(this).hasClass('toCopy') || $(this).hasClass('toReserve') ) {
                       return;
                   } else {
                       saveEscala (evt, $(this));
                   }
                });
                
                //RHID Daily Scales REPLICATION
                $(document).on('click', 'span.rhidOptions', function (evt){
                    //TRICK to AVOID Replication :: CLONNED HEADER
                    if (!evt.run) {
                        evt.run = '1';
                    } else {
                        return;
                    }  
                    modalRhid();
                });
                
                //$(document).on('focusin','#calend1 > tbody span.embedded', function (evt) {
                $(document).on('click','input.myMenu', function (evt) {
                    var elm = $(this).next('span.embedded'),
                        td = $(elm).parent('td');
                    bruteForcePopover(elm, $(td)[0]['dataset']); 
                });
                
            } else {
                //console.log('UNABLE TO INTERACT');
                $(document).on('change', 'input.myMenu', function (evt) {
                   var original = $(this).attr('value');
                   //Se USER alterou o valor -> Repõe para o valor original
                   $(this).val(original);
                });
            }
            //END EVENTS

            //GRAPH
            if (1 === 1) {   
            
                //Compile DATA to RENDER GRAPH
                function getHorarios(dia) {
                    var td_elements = $('#calend1 > tbody td[dia="' + dia + '"]'),
                        horarios = [], cnt = 0;
                
                    /* FASE #1: Criar Array de objectos com os horários distintos e contagem do Nr. de Pessoas em cada um para o "MESMO" dia. 
                     * 
                     *     OBS: Na composição de cada período esperado definido num horário, as passagens para o DIA SEGUINTE são sinalizadas, 
                     *          recorrendo-se ao prefixo ">". Ex: [22:00] ~ [06:00] será armazenado: [22:00] ~ [>06:00]
                     * */
                    if ( 1 === 1) {
                        //Selecionar todos empregados para um dado dia (DOM elements)
                        td_elements.each( function(i) {
                            var $this = $(this), details = {}, existe = false, next_day = false;

                            //Função de composição dos "TIME SLICES" com Deteção de "Dia seguinte" para cada "CÉLULA"
                            function manageExpectedWork () {
                                /* EXEMPLO: 
                                    details: {
                                            horario: "100"
                                            e_1: "06:30"
                                            s_1: "12:00"
                                            e_2: "13:00"
                                            s_2: "15:30"
                                            nr_pessoas: 1 
                                    }
                                */
                                var next_day = false;
                                details.horario = $this.attr('data-horario');
                                details.nr_pessoas = 1;

                                if ( $this.attr('data-e_1') ) {
                                    if ( $this.attr('data-s_1') > $this.attr('data-e_1') ) {
                                        details.e_1 = $this.attr('data-e_1');
                                        details.s_1 = $this.attr('data-s_1');
                                    } else {    //Next Day
                                        details.e_1 = $this.attr('data-e_1');
                                        details.s_1 = '>' + $this.attr('data-s_1');  
                                        next_day = true;
                                    }
                                }
                                if ( $this.attr('data-e_2') ) {
                                    if ( $this.attr('data-e_1') > $this.attr('data-e_2') ) {
                                        next_day = true;
                                    }
                                    if ( $this.attr('data-s_2') > $this.attr('data-e_2') ) {
                                        if (!next_day) {
                                            details.e_2 = $this.attr('data-e_2');
                                            details.s_2 = $this.attr('data-s_2');
                                        } else {
                                            details.e_2 = '>' + $this.attr('data-e_2');
                                            details.s_2 = '>' + $this.attr('data-s_2');                                                
                                        }
                                    } else {    //Next Day
                                        if (!next_day) {
                                            details.e_2 = $this.attr('data-e_2');
                                            details.s_2 = '>' + $this.attr('data-s_2');
                                        } else {
                                            details.e_2 = '>' + $this.attr('data-e_2');
                                            details.s_2 = '>' + $this.attr('data-s_2');                                                
                                        }

                                    }
                                }
                            }

                            //Procede à contagem do NR_PESSOAS com o MESMO "CÓDIGO DE HORÁRIO"
                            for (var k = 0; k < horarios.length; k++) {
                                if ( horarios[k].horario === $this.attr('data-horario') ) {
                                    horarios[k].nr_pessoas = parseInt(horarios[k].nr_pessoas) + 1;
                                    existe = true;
                                    break;
                                }
                            }

                            //Se não encontrou o novo horário acrescenta-o ao array "HORARIOS: {horario: X, nr_pessoas: Y, e_1: HH24:MI, s_1: HH24:MI, e_2: HH24:MI, s_2: HH24:MI}"
                            if (!existe) {
                                manageExpectedWork();   //Inicializa "details" dos Horários Distintos
                                horarios.push(details); //Cria NOVO elemento no Array de Horários
                            }
                        });
                        //console.log(horarios);
                    }
                    
                    /* FASE: 2: Recorrendo aos Horários criados no passo anterior, criar novo Array com as "HORAS DISTINTAS": TIMEPOINTS.
                     *          Para cada "TIMEPOINTS: percorre o Array de Horários e CONTA o NÚMERO de PESSOAS PRESENTES nessa "HORA".
                     *          Esse Array de Objectos será usado como os dados para renderização do Gráfico de "Distribuição Horária".
                     *          
                     *     OBS: Uma HORA FIM equivale a uma NÃO PRESENÇA!! */
                    if ( 1 === 1 ) {
                        var e1 = [], s1 = [], e2 = [], s2 = [], timePoints = [], graphData = [];
                        
                        //Criação do Array com os TIMEPOINTS
                        horarios.forEach (function (el) {
                            if (el.e_1 !== undefined) {
                                if (timePoints.indexOf(el.e_1) === -1) {
                                    timePoints.push(el.e_1);
                                }
                            }
                            if (el.s_1 !== undefined) {
                                if (timePoints.indexOf(el.s_1) === -1) {
                                    timePoints.push(el.s_1);
                                }
                            }
                            if (el.e_2 !== undefined) {
                                if (timePoints.indexOf(el.e_2) === -1) {
                                    timePoints.push(el.e_2);
                                }
                            }
                            if (el.s_2 !== undefined) {
                                if (timePoints.indexOf(el.s_2) === -1) {
                                    timePoints.push(el.s_2);
                                }
                            }
                        });
                        
                        //Ordenação do Array com os TIMEPOINTS
                        timePoints.sort();
                        //console.log( timePoints);
                        
                        //Criação de Array de Objetos {hour: TIMEPOINT, value: NR_PESSOAS"}, para renderização no Gráfico
                        timePoints.forEach (function (timeStamp) {
                            var nr_pessoas = 0;
                            for (var i = 0, l = horarios.length; i < l; i++) {
                                skip = false;
                                nr_pessoas;
                                //if ( horarios[i]['horario'] == 100) debugger;
                                if ( horarios[i]['e_1'] !== undefined ) {
                                    if ( ( timeStamp >= horarios[i]['e_1'] ) && ( timeStamp < horarios[i]['s_1'] ) ) {
                                        nr_pessoas = nr_pessoas + horarios[i]['nr_pessoas'];
                                        skip = true;
                                    }
                                }                            
                                if (!skip && horarios[i]['e_2'] !== undefined ) {
                                    if ( ( timeStamp >= horarios[i]['e_2'] ) && ( timeStamp < horarios[i]['s_2'] ) ) {
                                        nr_pessoas = nr_pessoas + horarios[i]['nr_pessoas'];
                                    }
                                }                            
                            }
                            graphData.push({"hour": timeStamp, "value": nr_pessoas});
                        });
                        //console.log( graphData);
                        return graphData;
                    }
                };
                   
                //DAY Graph Resources distribuition
                $(document).on('click', 'a.timeLine', function (evt){
                    //TRICK to AVOID Replication :: CLONNED HEADER
                    if (!evt.run) {
                        evt.run = '1';
                    } else {
                        return;
                    }
                    
                    //Reset Graph
                    //$('#dayDistribution').css('display','none');
                    var dia = $(this).data('day'), 
                        graph_Mode = '<span class="graphMode" title="' + "<?php echo $hint_click_to_close_graph_mode; ?>" + '"><i class="fas fa-chart-bar"></i></span>',
                        graphModeOriginal = $('#calend1 > thead > tr.weekNumber > th.infoRhid'),
                        graphModeSticky = $('#dataContainer > div > div > table.sticky-intersect > thead > tr > th'),
                        originalCol = $('#calend1 > thead > tr.dayWeek th > a.timeLine[data-day="' + dia + '"]'); //Coluna na Tabela Original

                    if ( $('#dayDistribution').attr('day') === dia ) { //Click on selected DAY 
                        if ( $('#dayDistribution').css('display') === 'block') { //Click on Day to Hide :: TOGGLE
                            //Destroy Graph :: BIG ICON "CLOSE GRAPH"
                            $('#dataContainer thead > tr > th > span.graphMode').trigger('click'); 
                        } else { // Click on Day to Show
                            //CHECKS and REMOVES previous selection effects
                            $('div.sticky-wrap thead > tr.dayWeek th > a.timeLine.daySelected').each( function(i) {
                                $(this).removeClass('daySelected');
                                $('div.mainContent').css({'border-bottom': '2px'});
                                graphModeOriginal.html('');
                                graphModeSticky.html('');
                            });
                            
                            graphModeOriginal.html(graph_Mode);
                            graphModeSticky.html(graph_Mode);                            
                            $(this).addClass('daySelected');
                            originalCol.addClass('daySelected');
                        }
                    } else { //New GRAPH DAY
                        //CHECKS and REMOVES previous selection
                        $('div.sticky-wrap thead > tr.dayWeek th > a.timeLine.daySelected').each( function(i) {
                            $(this).removeClass('daySelected');
                            $('div.mainContent').css({'border-bottom': '2px'});
                            graphModeOriginal.html('');
                            graphModeSticky.html('');
                        });
                        
                        graphModeOriginal.html(graph_Mode);
                        graphModeSticky.html(graph_Mode);                        
                        $(this).addClass('daySelected');
                        originalCol.addClass('daySelected');    
                        $('div.mainContent').css({'border-bottom': '0px'});

                        var txt = "<?php echo $ui_attendances_on_day; ?>" + dia;
                        $('#dayDistribution').attr('day',dia);
                        $('#dayDistribution > h3').html(txt);
                        
                        //Graph Draw
                        if ($('#graphDay').length){ 
                            var data = getHorarios ( dia );
                            //Destroy (previous) Graph before rendering
                            $("#graphDay").empty();
                            
                            //console.log(data);
                            var x_labels = [], y_values = [];
                            for (var [key, value] of Object.entries(data)) {
                                x_labels.push( value['hour'] );
                                y_values.push( value['value'] );
                                //console.log(value, value['hour'], value['value']);
                            }
                            //console.log(x_labels, y_values);

                            var chart = new Chartist.Line('#graphDay', {
                                labels: x_labels, //['1', '2', '3', '4', '5', '6', '7', '8'],
                                // Naming the series with the series object array notation
                                series: [{
                                    name: "<?php echo $ui_people_count_short; ?>",
                                    data: y_values//[5, 2, -4, 2, 0, -2, 5, -3]
                                }]
                            }, {
                                axisY: {
                                    onlyInteger: true
                              },
                                fullWidth: true,
                                showArea: true,
                                onlyInteger: true,
                                chartPadding: {
                                    right: 40
                                },
                                plugins: [
                                    //Tooltip
                                    Chartist.plugins.tooltip(),
                                    //AXIS Titles
                                    Chartist.plugins.ctAxisTitle({
                                      axisX: {
                                        axisTitle: "<?php echo $ui_time_frames; ?>", 
                                        axisClass: 'ct-axis-title',
                                        offset: {
                                          x: 0,
                                          y: 33
                                        },
                                        textAnchor: 'middle'
                                      },
                                      axisY: {
                                        axisTitle: "<?php echo $ui_people_count_short; ?>",
                                        axisClass: 'ct-axis-title',
                                        offset: {
                                          x: 0,
                                          y: 10
                                        },
                                        textAnchor: 'middle',
                                        flipTitle: true
                                      }
                                    })                         
                                ],
                                // Within the series options you can use the series names
                                // to specify configuration that will only be used for the
                                // specific series.
                                series: {
                                    "<?php echo $ui_people_count_short; ?>": {
                                        lineSmooth: Chartist.Interpolation.step()
                                    }
                                }
                              }, [
                                // You can even use responsive configuration overrides to
                                // customize your series configuration even further!
                                ['screen and (max-width: 320px)', {
                                    series: {
                                        'series-1': {
                                            lineSmooth: Chartist.Interpolation.none()
                                        }
                                    }
                                }]
                            ]);
                        }                    
                    }
                });
                
                //Master Graph Mode "Destroy" Event
                $(document).on('click', '#dataContainer thead > tr > th > span.graphMode', function (evt) {
                    var graphModeOriginal = $('#calend1 > thead > tr.weekNumber > th.infoRhid'),
                        graphModeSticky = $('#dataContainer > div > div > table.sticky-intersect > thead > tr > th'); //Coluna na Tabela Original    

                    //REMOVES previous selection
                    $('div.sticky-wrap thead > tr.dayWeek th > a.timeLine.daySelected').each( function(i) {
                        $(this).removeClass('daySelected');
                        //Removes Graph Icon
                        graphModeOriginal.html('');
                        graphModeSticky.html('');
                    });
                    //Reset Bottom Border Separator
                    $('div.mainContent').attr('style','');
                    //Graph Clean Up

                    $('#dayDistribution').attr('day',''); //Removes Day attribute
                    $('#dayDistribution > h3').html(''); //Removes Title
                    $("#graphDay").empty(); //Removes Graph
                });
            }
            //END GRAPH
                        
            $(window).resize(function(){
                //FORCE REDAW of CHOSENS
                redrawChosen();
            });

            //Inicialização do interface
            horarios_diarios('');
            lista_empresas('');
            lista_estabs('');
            lista_setores('%');
            lista_anos('');
            lista_rhids('');
            carrega_dados();


        };
        
        // Load morris dependencies and run pagefunction
//	loadScript(pn + "assets/js/morris/raphael.min.js", function(){
//		loadScript(pn + "assets/js/morris/morris.min.js", pagefunction);
//	});

	loadScript(pn + "assets/js/chartist/chartist.js", function() {
            loadScript(pn + "assets/js/chartist/chartist-plugin-tooltip.js", function() { //PMA CUSTOM
                loadScript(pn + "assets/js/chartist/chartist-plugin-axistitle.js", function() {
                });
            });
	});
        
        pagefunction();

        var pagedestroy = function () {
            horarios_toCopy = [];
            $(document).off('change', "#empresa");
            $(document).off('change', "#estab");
            $(document).off('change', "#setor");
            $(document).off('change', "#ano");
            $(document).off('change', "#rhid");
            $(document).off('mouseenter', "[name^=m]");
            $(document).off('mouseleave', "[name^=m]");
            $(document).off('click', "[name^=m]");
            $(document).off('change', 'input.myMenu');
            $(document).off("dblclick", "input.myMenu");
            $(document).off("click", "#clearEscalas, #clearAllEscalas");
            $(document).off('click', 'a.timeLine');
            $("#saveEscalas").off("click");
            $("#graphDay").empty();      

            $('#xpto').remove(); //Clear DOM
        };
</script>