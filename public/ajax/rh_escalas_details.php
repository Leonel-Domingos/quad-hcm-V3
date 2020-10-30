<?php
/*
 *  @autor      Pedro Estácio <pedro.estacio@quad-systems.com>
 *  @projeto    QUAD-HCM
 *  @versão     1.0
 *  @revisão    2018.09.30
 *  @copyright  (c) 2018 QuadSystems - http://www.quad-systems.com
 *  @nome       dk_coefficients_det.php
 *  @descrição  Interface para administração dos resultados dos prémios por coeficiente - detalhe chamado via AJAX
 *
 */
$time_start = microtime(true); 
require_once '../init.php';

//Módulo e Modelo
$modulo = @$_REQUEST['modulo'];
$modelo = @$_REQUEST['modelo'];

//Critérios Pesquisa
$rhid = @$_REQUEST['rhid'];

if ($rhid === '' || $rhid === '%') {
    $rhid = '';
    $empresa = @$_REQUEST['empresa'];
    $estab = @$_REQUEST['estab'];
    $setor = @$_REQUEST['setor'];
    $ano = @$_REQUEST['ano'];
    $mes = @$_REQUEST['mes'];
    if ($setor != '%') {
        $tmp_arr = explode("@",$setor);
        $cd_setor = $tmp_arr[0];
        $dt_setor = $tmp_arr[1];
    }
    else {
        $cd_setor = '';
        $dt_setor = '';
    }

//        if ($pag == '') {
//            $pag = 1;
//        }
//        $reg_pag = 12;

    $primeiro_dia_mes = gmmktime(1, 0, 0, $mes, 1, $ano);
    $dt_fim_mes = date("Y-m-t",$primeiro_dia_mes);
    $ano_mes_fim = date("Y-m",$primeiro_dia_mes);

    $col = 0;
    $hoje = date("Y-m-d");

    /* * ******************* */
//        $offset = 0;
//        if ($pag > 1)
//            $offset = $reg_pag * ($pag - 1);
//
//        $limit = $offset + $reg_pag;

    $offset = 0;
    $limit = 99999999999999999;

}
else { //Pedido de consulta para UM empregado específico!

    $empresa = @$_REQUEST['empresa'];
    $estab = '';
    $setor = '';
    $ano = @$_POST['ano'];
    $mes = @$_POST['mes'];
    $hor = '';
    $cd_setor = '';
    $dt_setor = '';
//        $pag = 1;
//        $reg_pag = 1;
    $cd_hor = '';
    $tp_hor = '';
    $primeiro_dia_mes = gmmktime(1, 0, 0, $mes, 1, $ano);
    $dt_fim_mes = date("Y-m-t",$primeiro_dia_mes);
    $ano_mes_fim = date("Y-m",$primeiro_dia_mes);

    $col = 0;
    $hoje = date("Y-m-d");
    /* * ******************* */
    $offset = 0;
    $limit = 1;
//        $limit = $offset + $reg_pag;

}

$primeiro_dia_mes = gmmktime(1, 0, 0, $mes, 1, $ano);
$col = 0;
$colabs_cursor = '';
$nr_indicadores = 0;
$indicadoresArray = '';
######################################################################################

/* Show Indicators on Header */
$css_back = '';
$existeInd = false;


$theader = '';
$tbody = '';

if ($ano != 'null') {
    $theader = calendar_Week_Days ($ano, $mes, 1, 1,$dia_fim_semana);

    /* Show Indicators on body */
    $existe = false;
    class Escala {
        public $_id;
        public $_empresa;
        public $_rhid;
        public $_dt_adm;
        public $_dia;
        public $_semana;
        public $_origem;
        public $_horario;
        public $_e_1;
        public $_s_1;
        public $_e_2;
        public $_s_2;                            
        public $_ini_dia;
        public $_e_noct;
        public $_s_noct;
        public $_hor_esp_min;
        public $_hor_esp_hrs;
        public $_indisp_fer;
        public $_indisp_dc;
        public $_indisp_aus;
        public $_indisp_bh;
        public $_bh;
        public $_th;
        public $_bh_transp;
        public $_th_transp;                            
    }                        
    $escalas = new Escala();
    $linhas = [];
    info_colabs_escalas($empresa, $estab, $cd_setor, $dt_setor, $rhid, $ano_mes_fim, $dt_fim_mes, $offset, $reg_pag, $cnt, $colabs_cursor, $msg);                    
    if ($msg == '') {
        try {                       
            foreach ($colabs_cursor as $row) {
                $tbody .= '<tr class="rhid" data-rhid="'.$row['RHID'].'">'; 
                $linha = '  <th class="masterColData"><span class="rhidOptions" data-toggle="popoverRhid" data-trigger="click" data-container="body" data-html="true" data-autoclose="true">'.$row['RHID']. ' - ' . $row['NOME_REDZ'].'</span></th>';
                $tot_bh = 0;
                $tot_th = 0;                                
                $bh_transp = 0;
                $th_transp = 0;                                
                for ($i = 0; $i < date('t', $primeiro_dia_mes); $i++) {
                    $classes = "";
                    $classes_hor = "";
                    $dia = gmmktime(1, 0, 0, $mes, ($i + 1), $ano);
                    $inclui_indisp = 'S';
                    rhid_horario_diario($empresa, $row['RHID'], $row['DT_ADMISSAO'], date('Y-m-d', $dia), $inclui_indisp, 
                                        $origem, $hor, $e_1, $s_1, $e_2, $s_2,
                                        $he_1, $hs_1, $he_2, $hs_2, $he_3, $hs_3, $ini_dia, $e_noct, $s_noct,
                                        $hor_esp_min, $hor_esp_hrs, 
                                        $indisp_fer, $indisp_dc, $indisp_aus, $indisp_bh, 
                                        $bh, $th, $bh_transp, $th_transp,
                                        $cd_turno, $dsp_turno,
                                        $msg);

                    //Horário Diário aplicável no DIA
                    if ($origem == 'E') { //Escala
                        $classes = "horario_escala";
                    } else if ($origem == 'T') { //Troca Horária
                        $classes = "horario_troca";

                    } else if ($origem == 'C') { //Cadastro
                        $classes = "horario_cadastro";                                        
                    }

                    //Indisponibilidade no dia
                    if ($hor_esp_min == 0) {
                        $classes_hor = " dia_descanso";
                    }
                    if ($indisp_fer == 'S' || $indisp_dc == 'S' || $indisp_aus == 'S' || $indisp_bh) {
                        //A função retorna todos os aplicáveis. Neste contexto vamos mostrar só a 1ª ocorrência...
                        if ($indisp_aus == 'S') {
                            $classes_hor = " indisp_aus";
                        } else if ($indisp_fer == 'S') {
                            $classes_hor = " indisp_fer";
                        } else if ($indisp_bh == 'S') {
                            $classes_hor = " indisp_bh";
                        } else if ($indisp_dc == 'S') {
                            $classes_hor = " indisp_dc";
                        }
                    }
                    semana_ano(date("Y-m-d",$dia), $an, $semana);
                    $cnt = $i + 1;
                    if ($cnt == 1) {
                        $transp = ' bh_transp="'.$bh_transp.'" th_transp="'.$th_transp.'" ';
                    } else {
                        $transp = "";
                    }
                    $linha .= '<td dia="'.date('Y-m-d', $dia).'" '.$i.'" id="'.$empresa.'@'.$row['RHID'].'@'.$row['DT_ADMISSAO'].'@'.date('Y-m-d', $dia).'" semana="'.$semana.'" '.$transp.' data-horario="'.$hor.'" data-bh="'.$bh.'" data-th="'.$th.'" class="'.$classes.'" '
                            .'data-ini_dia="'.$ini_dia.'" data-e_1="'.$e_1.'" data-s_1="'.$s_1.'" '
                            .'data-e_2="'.$e_2.'" data-s_2="'.$s_2.'" data-hor_esp_min="'.$hor_esp_min.'" '
                            .'data-hor_esp_hrs="'.$hor_esp_hrs.'" data-cd_turno="'.$cd_turno.'" data-dsp_turno="'.$dsp_turno.'" data-seq="'.$cnt.'">'.
                            '<input class="myMenu'.$classes_hor.'" type="text" value="'.$hor.'"/>';
                    $linha .= '<span class="embedded" data-toggle="popover" data-trigger="hover" data-container="body" data-html="true" data-autoclose="true"><i class="fas fa-info"></i></span></td>';

                    $dia_sem = date("N", $dia);
                    //Class DATA
                    $escalas->$_id = $i;
                    $escalas->$_empresa = $empresa;
                    $escalas->$_rhid = $row['RHID'];
                    $escalas->$_dt_adm = $row['DT_ADMISSAO'];
                    $escalas->$_dia = date('Y-m-d', $dia);
                    $escalas->$_semana = $semana;
                    $escalas->$_origem = $origem;
                    $escalas->$_horario = $hor;
                    $escalas->$_e_1 = $e_1;
                    $escalas->$_s_1 = $s_1;
                    $escalas->$_e_2 = $e_2;
                    $escalas->$_s_2 = $s_2;                            
                    $escalas->$_ini_dia = $ini_dia;
                    $escalas->$_e_noct = $e_noct;
                    $escalas->$_s_noct = $s_noct;
                    $escalas->$_hor_esp_min = $hor_esp_min;
                    $escalas->$_hor_esp_hrs = $hor_esp_hrs;
                    $escalas->$_indisp_fer = $indisp_fer;
                    $escalas->$_indisp_dc = $indisp_dc;
                    $escalas->$_indisp_aus = $indisp_aus;
                    $escalas->$_indisp_bh = $indisp_bh;
                    $escalas->$_bh = $bh;
                    $escalas->$_th = $th;
                    $escalas->$_bh_transp = $bh_transp;
                    $escalas->$_th_transp = $th_transp;   
                    //END Class DATA

                    //Totais
                    $tot_bh = $tot_bh + $bh + $bh_transp;
                    $tot_th = $tot_th + $th + $th_transp;

                    if ($dia_sem == $dia_fim_semana) {
                        $linha .= '<td id="BH@'.$row['RHID'].'@'.$an.'@'.$semana.'" semana="'.$semana.'" class="base_hor">'.$tot_bh.'</td>';
                        if ( $tot_bh == $tot_th ) {
                            $linha .= '<td id="TH@'.$row['RHID'].'@'.$an.'@'.$semana.'" semana="'.$semana.'" class="tot_hor">'.$tot_th.'</td>';
                        } else if ( $tot_bh > $tot_th) {
                            $linha .= '<td id="TH@'.$row['RHID'].'@'.$an.'@'.$semana.'" semana="'.$semana.'" class="tot_hor shortage">'.$tot_th.'</td>';
                        } else if ( $tot_bh < $tot_th) {
                            $linha .= '<td id="TH@'.$row['RHID'].'@'.$an.'@'.$semana.'" semana="'.$semana.'" class="tot_hor excedded">'.$tot_th.'</td>';
                        }
                        $tot_bh = 0;
                        $tot_th = 0;
                    }
                }    
                $tbody .= $linha.'</tr>';
            }

            # footer 
            $tbody .= '<tr class="footerLine">'; 
            $tbody .= '<th>TOTAIS</th>';
            $lin = 0;
            for ($i = 0; $i < date('t', $primeiro_dia_mes); $i++) {
                $lin += 1;
                $dia = gmmktime(1, 0, 0, $mes, ($i + 1), $ano);
                semana_ano(date("Y-m-d",$dia), $an, $semana);
                $dia_sem = date("N", $dia);
                if ($dia_sem == $dia_fim_semana) {
                    $tbody .= '<td colspan='.$lin.'>&nbsp</td>';
                    $tbody .= '<td class="tot_bh" semana="'.$semana.'">BH</td>';
                    $tbody .= '<td class="tot_th" semana="'.$semana.'">TH</td>';
                    $lin = 0;
                }
            }    
            if ($lin > 0 ) {
                $tbody .= '<td colspan='.$lin.' semana="'.$semana.'">&nbsp</td>';
            }
            $tbody .= '</tr>';
        } catch (Exception $ex) {
            echo "colabs#2 :" . $ex->getMessage();
        }

    //                        if (!$existe) {
    //                            echo '<tr>';
    //                            echo '  <td width="780"  style="text-align:center;" colspan="' . $col . '" rowspan="10">SEM DADOS</td>';
    //                            echo '</tr>';
    //                            for ($i = 0; $i < 9; $i++) {
    //                                echo '<tr><td>&nbsp;</td></tr>';
    //                            };
    //                        }
    }    
} 

//place this before any script you want to calculate time

$time_end = microtime(true);

//dividing with 60 will give the execution time in minutes otherwise seconds
$execution_time = ($time_end - $time_start); #/60;

//execution time of the script
//echo '<b>Total Execution Time:</b> '.$execution_time.' segs';

?>

<div class="row slide-in-right" style="width: 100%;margin: 0px;">

    <div class="col-xs-12" id="dataContainer" >
        <div class="component">
            <!-- ESCALAS HORARIAS -->
            <table id="calend1" class="stickyTable overflow-y" style="background:#fff;font-weight:bold" border="0" cellpadding="0" cellmargin="0">            
                <?= $theader ?>
                <tbody>
                    <?= $tbody ?>
                </tbody>
            </table>
                      
            <!-- END ESCALAS HORARIAS -->
        </div>

    </div>
    <div style="clear:both">&nbsp;</div>  
    <div class="executionTime">
        <?php echo $ui_execution_time.': ' .round($execution_time, 2) . ' '. substr(strtolower($ui_seconds), 0, 3). '.'; ?>
    </div>    
</div>

<script>
    pageSetUp();
    
    var pagefunction = function() {
        
        var closeMonth = "<?php echo $nr_indicadores;?>";
        if (closeMonth == "0") {
            $("#dataContainer").css('overflow-y','hidden')
        }
        
        loadScript(pn + "assets/js/StickyTableHeaders/jquery.stickyheader.js", function () {                    
            /* PMA VERSION */
            $('table.stickyTable').each(function() {
                    if( $(this).find('thead').length > 0 && $(this).find('th').length > 0) {
                            // Clone <thead>
                            var $w = $(window),
                                $rows = $(this).find('thead').find('tr').length,
                                $t	   = $(this),
                                $thead = $t.find('thead').clone(),
                                $col   = $t.find('thead, tbody').clone();
                            // Add class, remove margins, reset width and wrap table
                            $t
                            .addClass('sticky-enabled')
                            .css({
                                    margin: 0,
                                    width: '100%'
                            }).wrap('<div class="sticky-wrap" />');

                            if($t.hasClass('overflow-y')) $t.removeClass('overflow-y').parent().addClass('overflow-y');

                            // Create new sticky table head (basic)
                            $t.after('<table class="sticky-thead" />');

                            // If <tbody> contains <th>, then we create sticky column and intersect (advanced)
                            if($t.find('tbody th').length > 0) {
                                    $t.after('<table class="sticky-col" /><table class="sticky-intersect" />');
                            }

                            // Create shorthand for things
                            var $stickyHead  = $(this).siblings('.sticky-thead'),
                                    $stickyCol   = $(this).siblings('.sticky-col'),
                                    $stickyInsct = $(this).siblings('.sticky-intersect'),
                                    $stickyWrap  = $(this).parent('.sticky-wrap');

                            $stickyHead.append($thead);

                            $stickyCol
                            .append($col)
                                    .find('thead th:gt(0)').remove()
                                    .end()
                                    .find('tbody td').remove();

                            $stickyInsct.html('<thead><tr><th>'+$t.find('thead th:first-child').html()+'</th></tr></thead>');

                            // Set widths
                            var setWidths = function () {
                                            $t
                                            .find('thead th').each(function (i) {
                                                    $stickyHead.find('th').eq(i).width($(this).width());
                                            })
                                            .end()
                                            .find('tr').each(function (i) {
                                                    $stickyCol.find('tr').eq(i).height($(this).height());
                                            });

                                            // Set width of sticky table head
                                            $stickyHead.width($t.width());

                                            // Set width of sticky table col
                                            $stickyCol.find('th').add($stickyInsct.find('th')).width($t.find('thead th').width())
                                    },
                                    repositionStickyHead = function () {
                                            // Return value of calculated allowance
                                            var allowance = calcAllowance();

                                            // Check if wrapper parent is overflowing along the y-axis
                                            if($t.height() > $stickyWrap.height()) {
                                                    // If it is overflowing (advanced layout)
                                                    // Position sticky header based on wrapper scrollTop()
                                                    if($stickyWrap.scrollTop() > 0) {
                                                            // When top of wrapping parent is out of view
                                                            $stickyHead.add($stickyInsct).css({
                                                                    opacity: 1,
                                                                    top: $stickyWrap.scrollTop()
                                                            });
                                                    } else {
                                                            // When top of wrapping parent is in view
                                                            $stickyHead.add($stickyInsct).css({
                                                                    opacity: 0, //PMA: opacity: 0 -> This way events can always be indexed to sticky component
                                                                    top: 0
                                                            });
                                                    }
                                            } else {
                                                    // If it is not overflowing (basic layout)
                                                    // Position sticky header based on viewport scrollTop
                                                    if($w.scrollTop() > $t.offset().top && $w.scrollTop() < $t.offset().top + $t.outerHeight() - allowance) {
                                                            // When top of viewport is in the table itself
                                                            $stickyHead.add($stickyInsct).css({
                                                                    opacity: 1,
                                                                    top: $w.scrollTop() - $t.offset().top
                                                            });
                                                    } else {
                                                            // When top of viewport is above or below table
                                                            $stickyHead.add($stickyInsct).css({
                                                                    opacity: 0, //PMA: opacity: 0 -> This way events can always be indexed to sticky component
                                                                    top: 0
                                                            });
                                                    }
                                            }
                                    },
                                    repositionStickyCol = function () {
                                            if($stickyWrap.scrollLeft() > 0) {
                                                    // When left of wrapping parent is out of view
                                                    $stickyCol.add($stickyInsct).css({
                                                            opacity: 1,
                                                            left: $stickyWrap.scrollLeft()
                                                    });
                                            } else {
                                                    // When left of wrapping parent is in view
                                                    $stickyCol
                                                    //.css({ opacity: 0 })
                                                    .css({ opacity: 0 }) //PMA: This way events can always be indexed to sticky component
                                                    .add($stickyInsct).css({ left: 0 });
                                            }
                                    },
                                    calcAllowance = function () {
                                            var a = 0;
                                            // Calculate allowance
                                            $t.find('tbody tr:lt(3)').each(function () {
                                                    a += $(this).height();
                                            });

                                            // Set fail safe limit (last three row might be too tall)
                                            // Set arbitrary limit at 0.25 of viewport height, or you can use an arbitrary pixel value
                                            if(a > $w.height()*0.25) {
                                                    a = $w.height()*0.25;
                                            }

                                            // Add the height of sticky header
                                            a += $stickyHead.height();
                                            return a;
                                    };

                            setWidths();

                            $t.parent('.sticky-wrap').scroll($.throttle(250, function() {
                                    repositionStickyHead();
                                    repositionStickyCol();
                            }));
                            $w
                            .on("load", setWidths)
                            .resize($.debounce(250, function () {
                                    setWidths();
                                    repositionStickyHead();
                                    repositionStickyCol();
                            }))
                            .scroll($.throttle(250, repositionStickyHead));
                    }
            });
        });
    };

    pagefunction();

    var pagedestroy = function(){
        
    }    
</script>