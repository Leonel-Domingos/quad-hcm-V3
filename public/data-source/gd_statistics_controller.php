<?php
/*
 *  @autor      Pedro Estácio <pedro.estacio@quad-systems.com>
 *  @versão     2.0
 *  @revisão    2018.07.11
 *  @copyright  (c) 2018 QuadSystems - http://www.quad-systems.com
 *  @nome     	gd_statistics_controller.php
 *  @descrição  controlador para devolver resultados estatísticos para a produção de gráficos
 *
 */
    
# cabeçaho do controlador
require_once 'quad_head_controller.php';
require_once INCLUDES_PATH.'/lib/gd_lib_controller.php';

## ação a executar pelo controlador.
##
## por defeito efetua a gravação das variáveis recolhidas para um formulário
## que são indicadas nas matriz request_data
$action = @$_REQUEST['action'];

$perfil = @$_SESSION['perfil'];
$rhid = @$_SESSION['rhid'];

$fases = "";
$totais = "";
$msg = "";

$resp_fases  = '';
$resp_totais = '';
$resp_totais_mes = '';
$resp_estabs = '';

$nr_processos = 0;
$nr_admissoes = 0;
$nr_renovacoes = 0;
$nr_outros = 0;

$wkf_concluidos = 0;
$wkf_elaboracao = 0;
$wkf_validacao = 0;
$wkf_assinatura = 0;
$wkf_aprovacoes = 0;

$totais = array();
$totais_mes = array();
$fases = array();
$estabs = array();
gd_estatisticas($perfil, $rhid, $totais, $fases, $totais_mes, $estabs, $msg);

if ($msg == '') {

    ## obtenção dos valores totais
    $nr_processos = $totais[0];
    $nr_admissoes = $totais[1];
    $nr_renovacoes = $totais[2];
    $nr_outros = $totais[3];

    $wkf_concluidos = $totais[4];
    $wkf_elaboracao = $totais[5];
    $wkf_validacao = $totais[6];
    $wkf_assinatura = $totais[7];
    $wkf_aprovacoes = $totais[8];

    $resp_totais =  '{"nr_processos":'.$nr_processos.
                    ',"nr_admissoes":'.$nr_admissoes.
                    ',"nr_renovacoes":'.$nr_renovacoes.
                    ',"nr_outros":'.$nr_outros.
                    ',"wkf_concluidos":'.$wkf_concluidos.
                    ',"wkf_elaboracao":'.$wkf_elaboracao.
                    ',"wkf_validacao":'.$wkf_validacao.
                    ',"wkf_assinatura":'.$wkf_assinatura.
                    ',"wkf_aprovacoes":'.$wkf_aprovacoes.
                    '}';

    ## obtenção dos valores por fases
    $details = '';
    $total_cnt = 0;
    $med_total = 0;
    foreach($fases as $fase) {
        if ($fase[0] == 'TOTAL') {
            $total_cnt = $fase[2];
            $med_total = $fase[4];
            $med_hist = $fase[5];
        } else {
            if ($fase[2] != 0) {
                if ($details == '') {
                    $details = '{"code":"'.$fase[0].'","dsp":"'.$fase[1].'","numero":"'.$fase[2].'","percentagem":"'.$fase[3].'","media_dias":"'.$fase[4].'","media_dias_hist":"'.$fase[5].'"}';
                } else {
                    $details .= ','.'{"code":"'.$fase[0].'","dsp":"'.$fase[1].'","numero":"'.$fase[2].'","percentagem":"'.$fase[3].'","media_dias":"'.$fase[4].'","media_dias_hist":"'.$fase[5].'"}';
                }
            }
        }
    }
    $resp_fases  = '{"details":['.$details.'],"resumo":{"numero":"'.$total_cnt.'","media_dias":"'.$med_total.'"}}';

    # obtenção dos totais por mês
    $mes_total = "";
    $mes_adm = "";
    $mes_renov = "";
    $mes_outros = "";
    foreach($totais_mes as $tmes) {
        if ($mes_total == "") {
            $mes_total = $tmes[2];
        } else {
            $mes_total = $tmes[2].",".$mes_total;
        }

        if ($mes_adm == "") {
            $mes_adm = $tmes[3];
        } else {
            $mes_adm = $tmes[3].",".$mes_adm;
        }

        if ($mes_renov == "") {
            $mes_renov = $tmes[4];
        } else {
            $mes_renov = $tmes[4].",".$mes_renov;
        }

        if ($mes_outros == "") {
            $mes_outros = $tmes[5];
        } else {
            $mes_outros = $tmes[5].",".$mes_outros;
        }
    }

    $resp_totais_mes = '{"nr_processos":"'.$mes_total.'","nr_admissoes":"'.$mes_adm.'","nr_renovacoes":"'.$mes_renov.'","nr_outros":"'.$mes_outros.'"}';


    # obtenção dos totais por estabelecimento
    $resp_estabs = '';
    $ticks = "";
    $proc = "";
    $adm = "";
    $renov = "";
    $outros = "";
    $cnt = 0;

    foreach($estabs as $estab) {
        # cd: $estab[0]
        # dsp:$estab[1]
        # nr_colabs:$estab[2]
        # total_proc:$estab[3]
        # adm:$estab[4]
        # renov:$estab[5]
        # outros:$estab[6]
        $cnt += 1;
        if ($cnt == 1) {
            $ticks = '['.$cnt.',"'.$estab[1].'"]';
            $proc = '['.$cnt.','.$estab[3].']';
            $adm = '['.$cnt.','.$estab[4].']';
            $renov = '['.$cnt.','.$estab[5].']';
            $outros = '['.$cnt.','.$estab[6].']';
        } else {
            $ticks .= ',['.$cnt.',"'.$estab[1].'"]';
            $proc .= ',['.$cnt.','.$estab[3].']';
            $adm .= ',['.$cnt.','.$estab[4].']';
            $renov .= ',['.$cnt.','.$estab[5].']';
            $outros .= ',['.$cnt.','.$estab[6].']';
        }
    }
    $resp_estabs  = '{"ticks":['.$ticks.'],'.
                     '"processos":['.$proc.'],'.
                     '"admissoes":['.$adm.'],'.
                     '"renovacoes":['.$renov.'],'.
                     '"outros":['.$outros.']'.
                    '}';

}

#
# DADOS para DEMOSTRAÇÃO
#

$demo = false;
if ($demo) {

    $demo_proc = '';
    $demo_adm = '';
    $demo_renov = '';
    $demo_outros = '';

    $tproc = 0;
    $tadm = 0;
    $trenov = 0;
    $toutros = 0;

    $wkf_concluidos = 0;
    $wkf_elaboracao = 0;
    $wkf_validacao = 0;
    $wkf_assinatura = 0;
    $wkf_aprovacoes = 0;

    ## processos por tipo
    for ($x=1;$x <= 24;$x++) {

        $vadm = rand(1,5);
        $vrenov = rand(1,12);
        $voutros = rand(1,3);
        $vproc = $vadm + $vrenov + $voutros;

        $tproc += $vproc;
        $tadm += $vadm;
        $trenov += $vrenov;
        $toutros += $voutros;

        if ($x==1) {
            $demo_proc = "[".$x.",".$vproc."]";
            $demo_adm = "[".$x.",".$vadm."]";
            $demo_renov = "[".$x.",".$vrenov."]";
            $demo_outros = "[".$x.",".$voutros."]";
        } else {
            $demo_proc .= ",[".$x.",".$vproc."]";
            $demo_adm .= ",[".$x.",".$vadm."]";
            $demo_renov .= ",[".$x.",".$vrenov."]";
            $demo_outros .= ",[".$x.",".$voutros."]";
        }
    }

    ## processos por workflow
    $wkf_concluidos = rand(0,$tproc);
    $resto = $tproc-$wkf_concluidos;
    if ($resto > 0) {
        $wkf_elaboracao = rand(0,$resto);
        $resto = $tproc - $wkf_concluidos - $wkf_elaboracao;
        if ($resto > 0) {
            $wkf_validacao = rand(0,$resto);
            $resto = $tproc - $wkf_concluidos - $wkf_elaboracao - $wkf_validacao;
            if ($resto > 0) {
                $wkf_assinatura = rand(0,$resto);
                $resto = $tproc - $wkf_concluidos - $wkf_elaboracao - $wkf_validacao - $wkf_assinatura;
                if ($resto > 0) {
                    $wkf_aprovacoes = $resto;
                }
            }
        }
    }

    ## totais atuais por estabelecimento
    $resp_estabs  = '{"ticks":[[1, "Porto"],[2, "Vila Real"],[3, "Almada"],[4, "Torres Vedras"],[5, "Coimbra"],[6, "Loures"],[7, "Portimão"],[8, "Matosinhos"],[9, "Santarém"],[10, "Viseu"],[11, "Ponta Delgada"],[12, "Aveiro"],[13, "Montijo"],[14, "Barreiro"],[15, "Leiria"],[16, "Maia"],[17, "Cascais"],[18, "Braga"],[19, "Amadora"],[20, "Guarda"],[21, "Sintra"],[22, "Guimarães"],[23, "Faro"],[24, "Lisboa"]],'.
                       '"processos":['.$demo_proc.'],'.
                       '"admissoes":['.$demo_adm.'],'.
                       '"renovacoes":['.$demo_renov.'],'.
                       '"outros":['.$demo_outros.']'.
                      '}';

    ## totais gerais por tipo de processo e por workflow
    $resp_totais = '{"nr_processos":'.$tproc.','.
                    '"nr_admissoes":'.$tadm.','.
                    '"nr_renovacoes":'.$trenov.','.
                    '"nr_outros":'.$toutros.','.
                    '"wkf_concluidos":'.$wkf_concluidos.','.
                    '"wkf_elaboracao":'.$wkf_elaboracao.','.
                    '"wkf_validacao":'.$wkf_validacao.','.
                    '"wkf_assinatura":'.$wkf_assinatura.','.
                    '"wkf_aprovacoes":'.$wkf_aprovacoes.'}';

    ## totais dos últimos 12 meses
    for ($x=1;$x < 12;$x++) {

        $vadm = rand(round($tadm/2),2*$tadm);
        $vrenov = rand(round($trenov/2),2*$trenov);
        $voutros = rand(round($toutros/2),2*$toutros);
        $vproc = $vadm + $vrenov + $voutros;

        if ($x==1) {
            $demo_proc = $vproc;
            $demo_adm = $vadm;
            $demo_renov = $vrenov;
            $demo_outros = $voutros;
        } else {
            $demo_proc .= ",".$vproc;
            $demo_adm .= ",".$vadm;
            $demo_renov .= ",".$vrenov;
            $demo_outros .= ",".$voutros;
        }
    }
    $demo_proc .= ",".$tproc;
    $demo_adm .= ",".$tadm;
    $demo_renov .= ",".$trenov;
    $demo_outros .= ",".$toutros;

    $resp_totais_mes = '{"nr_processos":"'.$demo_proc.'",'.
                        '"nr_admissoes":"'.$demo_adm.'",'.
                        '"nr_renovacoes":"'.$demo_renov.'",'.
                        '"nr_outros":"'.$demo_outros.'"}';


    #   $tproc - número total de processos
    #   $wkf_concluidos
    $wkf_aprovados = 0;
    $wkf_rejeitados = 0;
    $wkf_cancelados = 0;

    $wkf_aprovados = rand(0,$wkf_concluidos);
    $resto = $wkf_concluidos - $wkf_aprovados;
    if ($resto > 0){
        $wkf_rejeitados = rand(0,$resto);
        $resto = $wkf_concluidos - $wkf_aprovados - $wkf_rejeitados;
        if ($resto > 0) {
            $wkf_cancelados = $resto;
        }
    }

    #   $wkf_elaboracao

    #   $wkf_validacao
    $wkf_validacao_A = 0;
    $wkf_validacao_B = 0;
    $wkf_validacao_C = 0;
    $wkf_validacao_D = 0;

    $wkf_validacao_A = rand(0,$wkf_validacao);
    $resto = $wkf_validacao - $wkf_validacao_A;
    if ($resto > 0){
        $wkf_validacao_B = rand(0,$resto);
        $resto = $wkf_validacao - $wkf_validacao_A - $wkf_validacao_B;
        if ($resto > 0) {
            $wkf_validacao_C = rand(0,$resto);
            $resto = $wkf_validacao - $wkf_validacao_A - $wkf_validacao_B - $wkf_validacao_C;
            if ($resto > 0 ) {
                $wkf_validacao_D = $resto;
            }
        }
    }

    #   $wkf_assinatura
    $wkf_assinatura_A = 0;
    $wkf_assinatura_B = 0;
    $wkf_assinatura_C = 0;
    $wkf_assinatura_D = 0;
    $wkf_assinatura_E = 0;

    $wkf_assinatura_A = rand(0,$wkf_assinatura);
    $resto = $wkf_assinatura - $wkf_assinatura_A;
    if ($resto > 0){
        $wkf_assinatura_B = rand(0,$resto);
        $resto = $wkf_assinatura - $wkf_assinatura_A - $wkf_assinatura_B;
        if ($resto > 0) {
            $wkf_assinatura_C = rand(0,$resto);
            $resto = $wkf_assinatura - $wkf_assinatura_A - $wkf_assinatura_B - $wkf_assinatura_C;
            if ($resto > 0 ) {
                $wkf_assinatura_D = rand(0,$resto);
                $resto = $wkf_assinatura - $wkf_assinatura_A - $wkf_assinatura_B - $wkf_assinatura_C - $wkf_assinatura_D;
                if ($resto > 0 ) {
                    $wkf_assinatura_E = $resto;
                }
            }
        }
    }

    #   $wkf_aprovacoes = 0;
    $wkf_aprovacoes_A = 0;
    $wkf_aprovacoes_B = 0;
    $wkf_aprovacoes_C = 0;
    $wkf_aprovacoes_D = 0;

    $wkf_aprovacoes_A = rand(0,$wkf_aprovacoes);
    $resto = $wkf_validacao - $wkf_aprovacoes_A;
    if ($resto > 0){
        $wkf_aprovacoes_B = rand(0,$resto);
        $resto = $wkf_aprovacoes - $wkf_aprovacoes_A - $wkf_aprovacoes_B;
        if ($resto > 0) {
            $wkf_aprovacoes_C = rand(0,$resto);
            $resto = $wkf_aprovacoes - $wkf_aprovacoes_A - $wkf_aprovacoes_B - $wkf_aprovacoes_C;
            if ($resto > 0 ) {
                $wkf_aprovacoes_D = $resto;
            }
        }
    }

    $resp_fases  = '{"details":[';
    $resp_detalhes = "";

    if ($wkf_elaboracao > 0 ) {
        if ($resp_detalhes != '') {
            $resp_detalhes .= ',';
        }
        $resp_detalhes  .= '{"code":"A","dsp":"Elaboração","numero":"'.$wkf_elaboracao.'","percentagem":"'.round($wkf_elaboracao/$proc*100).'","media_dias":"7","media_dias_hist":"4"}';
    }

    if ($wkf_validacao_A > 0 ) {
        if ($resp_detalhes != '') {
            $resp_detalhes .= ',';
        }
        $resp_detalhes  .= '{"code":"B","dsp":"Validação Gestor Adm.","numero":"'.$wkf_validacao_A.'","percentagem":"'.round($wkf_validacao_A/$proc*100).'","media_dias":"4","media_dias_hist":"4"}';
    }

    if ($wkf_validacao_B > 0 ) {
        if ($resp_detalhes != '') {
            $resp_detalhes .= ',';
        }
        $resp_detalhes  .= '{"code":"C","dsp":"Validação Supervisor","numero":"'.$wkf_validacao_B.'","percentagem":"'.round($wkf_validacao_B/$proc*100).'","media_dias":"6","media_dias_hist":"8"}';
    }

    if ($wkf_validacao_C > 0 ) {
        if ($resp_detalhes != '') {
            $resp_detalhes .= ',';
        }
        $resp_detalhes  .= '{"code":"D","dsp":"Validação Diretor","numero":"'.$wkf_validacao_C.'","percentagem":"'.round($wkf_validacao_C/$proc*100).'","media_dias":"2","media_dias_hist":"2"}';
    }

    if ($wkf_validacao_D > 0 ) {
        if ($resp_detalhes != '') {
            $resp_detalhes .= ',';
        }
        $resp_detalhes  .= '{"code":"E","dsp":"Validação Gestor","numero":"'.$wkf_validacao_D.'","percentagem":"'.round($wkf_validacao_D/$proc*100).'","media_dias":"3","media_dias_hist":"4"}';
    }

    if ($wkf_assinatura_A > 0 ) {
        if ($resp_detalhes != '') {
            $resp_detalhes .= ',';
        }
        $resp_detalhes  .= '{"code":"F","dsp":"Assinatura Colaborador","numero":"'.$wkf_assinatura_A.'","percentagem":"'.round($wkf_assinatura_A/$proc*100).'","media_dias":"7","media_dias_hist":"4"}';
    }

    if ($wkf_assinatura_B > 0 ) {
        if ($resp_detalhes != '') {
            $resp_detalhes .= ',';
        }
        $resp_detalhes  .= '{"code":"G","dsp":"Assinatura Gestor Adm.","numero":"'.$wkf_assinatura_B.'","percentagem":"'.round($wkf_assinatura_B/$proc*100).'","media_dias":"10","media_dias_hist":"10"}';
    }

    if ($wkf_assinatura_C > 0 ) {
        if ($resp_detalhes != '') {
            $resp_detalhes .= ',';
        }
        $resp_detalhes  .= '{"code":"H","dsp":"Assinatura Supervisor","numero":"'.$wkf_assinatura_C.'","percentagem":"'.round($wkf_assinatura_C/$proc*100).'","media_dias":"2","media_dias_hist":"4"}';
    }

    if ($wkf_assinatura_D > 0 ) {
        if ($resp_detalhes != '') {
            $resp_detalhes .= ',';
        }
        $resp_detalhes  .= '{"code":"I","dsp":"Assinatura Diretor","numero":"'.$wkf_assinatura_D.'","percentagem":"'.round($wkf_assinatura_D/$proc*100).'","media_dias":"6","media_dias_hist":"4"}';
    }

    if ($wkf_assinatura_E > 0 ) {
        if ($resp_detalhes != '') {
            $resp_detalhes .= ',';
        }
        $resp_detalhes  .= '{"code":"J","dsp":"Assinatura DRH","numero":"'.$wkf_assinatura_E.'","percentagem":"'.round($wkf_assinatura_E/$proc*100).'","media_dias":"6","media_dias_hist":"2"}';
    }

    if ($wkf_aprovacoes_A > 0 ) {
        if ($resp_detalhes != '') {
            $resp_detalhes .= ',';
        }
        $resp_detalhes  .= '{"code":"K","dsp":"Aprovação Gestor Adm.","numero":"'.$wkf_aprovacoes_A.'","percentagem":"'.round($wkf_aprovacoes_A/$proc*100).'","media_dias":"1","media_dias_hist":"4"}';
    }

    if ($wkf_aprovacoes_B > 0 ) {
        if ($resp_detalhes != '') {
            $resp_detalhes .= ',';
        }
        $resp_detalhes  .= '{"code":"L","dsp":"Aprovação Supervisor","numero":"'.$wkf_aprovacoes_B.'","percentagem":"'.round($wkf_aprovacoes_B/$proc*100).'","media_dias":"5","media_dias_hist":"3"}';
    }

    if ($wkf_aprovacoes_C > 0 ) {
        if ($resp_detalhes != '') {
            $resp_detalhes .= ',';
        }
        $resp_detalhes  .= '{"code":"M","dsp":"Aprovação Diretor","numero":"'.$wkf_aprovacoes_C.'","percentagem":"'.round($wkf_aprovacoes_C/$proc*100).'","media_dias":"6","media_dias_hist":"8"}';
    }

    if ($wkf_aprovacoes_D > 0 ) {
        if ($resp_detalhes != '') {
            $resp_detalhes .= ',';
        }
        $resp_detalhes  .= '{"code":"N","dsp":"Aprovação Gestor","numero":"'.$wkf_aprovacoes_D.'","percentagem":"'.round($wkf_aprovacoes_D/$proc*100).'","media_dias":"2","media_dias_hist":"4"}';
    }

    if ($wkf_aprovados > 0 ) {
        if ($resp_detalhes != '') {
            $resp_detalhes .= ',';
        }
        $resp_detalhes  .= '{"code":"O","dsp":"Aprovado","numero":"'.$wkf_aprovados.'","percentagem":"'.round($wkf_aprovados/$proc*100).'","media_dias":"3","media_dias_hist":"1"}';
    }

    if ($wkf_rejeitados > 0 ) {
        if ($resp_detalhes != '') {
            $resp_detalhes .= ',';
        }
        $resp_detalhes  .= '{"code":"P","dsp":"Rejeitado","numero":"'.$wkf_rejeitados.'","percentagem":"'.round($wkf_rejeitados/$proc*100).'","media_dias":"7","media_dias_hist":"7"}';
    }

    if ($wkf_cancelados > 0 ) {
        if ($resp_detalhes != '') {
            $resp_detalhes .= ',';
        }
        $resp_detalhes  .= '{"code":"Z","dsp":"Cancelado","numero":"'.$wkf_cancelados.'","percentagem":"'.round($wkf_cancelados/$proc*100).'","media_dias":"3","media_dias_hist":"3"}]';
    }

    $resp_fases  = '{"details":['.
                   $resp_detalhes.
                   ',"resumo":{"numero":"'.$tproc.'","media_dias":"5","media_dias_hist":"8"}}';

/*
$resp_fases  = '{"details":['.
                 '{"code":"A","dsp":"Elaboração","numero":"50","percentagem":"4","media_dias":"7","media_dias_hist":"4"},'.
                 '{"code":"B","dsp":"Validação Gestor Adm.","numero":"2","percentagem":"2","media_dias":"4","media_dias_hist":"4"},'.
                 '{"code":"C","dsp":"Validação Supervisor","numero":"99","percentagem":"8","media_dias":"6","media_dias_hist":"8"},'.
                 '{"code":"D","dsp":"Validação Diretor","numero":"90","percentagem":"8","media_dias":"2","media_dias_hist":"2"},'.
                 '{"code":"E","dsp":"Validação Gestor","numero":"97","percentagem":"8","media_dias":"3","media_dias_hist":"4"},'.
                 '{"code":"F","dsp":"Assinatura Colaborador","numero":"3","percentagem":"3","media_dias":"7","media_dias_hist":"4"},'.
                 '{"code":"G","dsp":"Assinatura Gestor Adm.","numero":"53","percentagem":"4","media_dias":"10","media_dias_hist":"10"},'.
                 '{"code":"H","dsp":"Assinatura Supervisor","numero":"50","percentagem":"4","media_dias":"2","media_dias_hist":"4"},'.
                 '{"code":"I","dsp":"Assinatura Diretor","numero":"13","percentagem":"1","media_dias":"6","media_dias_hist":"4"},'.
                 '{"code":"J","dsp":"Assinatura DRH","numero":"33","percentagem":"3","media_dias":"6","media_dias_hist":"2"},'.
                 '{"code":"K","dsp":"Aprovação Gestor Adm.","numero":"43","percentagem":"4","media_dias":"1","media_dias_hist":"4"},'.
                 '{"code":"L","dsp":"Aprovação Supervisor","numero":"87","percentagem":"7","media_dias":"5","media_dias_hist":"3"},'.
                 '{"code":"M","dsp":"Aprovação Diretor","numero":"97","percentagem":"8","media_dias":"6","media_dias_hist":"8"},'.
                 '{"code":"N","dsp":"Aprovação Gestor","numero":"98","percentagem":"8","media_dias":"2","media_dias_hist":"4"},'.
                 '{"code":"O","dsp":"Aprovado","numero":"200","percentagem":"17","media_dias":"3","media_dias_hist":"1"},'.
                 '{"code":"P","dsp":"Rejeitado","numero":"66","percentagem":"6","media_dias":"7","media_dias_hist":"7"},'.
                 '{"code":"Z","dsp":"Cancelado","numero":"60","percentagem":"5","media_dias":"3","media_dias_hist":"3"}],'.
                 '"resumo":{"numero":"1190","media_dias":"5","media_dias":"8"}}';

*/

}

$dadosOut = array(
            "estabs" => $resp_estabs,
            "fases" => $resp_fases,
            "totais_gerais" => $resp_totais,
            "totais_mes" => $resp_totais_mes,
            "error" => $msg
 );

echo json_encode($dadosOut);

 ?>
