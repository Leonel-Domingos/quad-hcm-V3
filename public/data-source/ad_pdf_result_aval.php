<?php
 /*
 *  @autor      Pedro Estácio <pedro.estacio@quad-systems.com>
 *  @projeto    QUAD-HCM
 *  @versão     1.0
 *  @revisão    2018.10.02
 *  @copyright  (c) 2018 QuadSystems - http://www.quad-systems.com
 *  @nome       ad_pdf_ficha_aval.php
 *  @descrição  Implementação da emissão em PDF da ficha de avaliação
 *
 */
# cabeçaho do controlador
require_once 'quad_head_controller.php';

# não deverá necessitar, uma vez que já foi feito o carregamento das livrarias via composer no quad_head_controller.php
#require_once('../classes/tcpdf/config/lang/eng.php');
#require_once('../classes/tcpdf/tcpdf.php');

require_once INCLUDES_PATH."/lib/ad_lib.php";

#
# Parâmetros
#

# modelo de escala única ativo?
$escala_unica = false;

$key = urldecode(@$_REQUEST['id']);

$param = explode("@", $key);
$empresa_ = $param[0];
$id_pa_ = $param[1];
$dt_ini_pa_ = $param[2];
$id_proc_av_ = $param[3];
$dt_ini_proc_ = $param[4];
$rhid_ = $param[5];
$dt_adm_ = $param[6];
$rhid_avaliador_ = $param[7];
$id_fase_ = $param[8];
$dt_ini_fase_ = $param[9];
$dt_ini_fpa_ = $param[10];
$dt_ini_af_ = $param[11];


#
# Extensão da classe TCPDF para configurar cabeçalho e rodapé
#
class MYPDF extends TCPDF {

    //Page header
    public function Header() {

       global $ui_eval_results_long;

       #get_logo_info($logo, $w, $h, $msg);

       $location = str_replace("data-source/ad_pdf_result_aval.php","",__FILE__);
       $location = str_replace("data-source\ad_pdf_result_aval.php","",$location);
       $logo = "$location/img/logo.png";

       list($w, $h) = getimagesize ($logo);

       if ($h > 55 ) {
           $nw = round(55 * $w / $h);
           $nw = 55;
       } else {
           $nw = $w;
           $nh = $h;
       }
       $ext = pathinfo($logo, PATHINFO_EXTENSION);

       //void Image (string $file, float $x, float $y, [float $w = 0], [float $h = 0], [string $type = ''], [mixed $link = ''], [string $align = ''])
       //		$this->Image($logo, 8, 3, 185, 55, 'JPG');
       $this->Image($logo, 8, 10, $nw, $nh, $ext);

       $this->SetFont('helvetica', 'B', 18);
       // int MultiCell (float $w, float $h, string $txt, [mixed $border = 0], [string $align = 'J'], [int $fill = 0], [int $ln = 1], [int $x = ''], [int $y = ''], [boolean $reseth = true], [int $stretch = 0])

       $this->MultiCell(592, 60, '      '.$ui_eval_results_long, 0, 'C', 0, 1, 1, 1, true, 0, false, true, 50, 'M');
       $this->SetFont('helvetica', '', 8);
    }

    public function SetHeaderData($dt_admissao,$nr_documento,$estado){
            $this->dt_admissao = $dt_admissao;
            $this->nr_documento = $nr_documento;
            $this->estado = $estado;
    }

    public function SetFooterData($footerStr){
            $this->footerStr = $footerStr;
    }


    // Page footer
    public function Footer() {

        global $ui_page;
        // Position at 15 mm from bottom
        $this->SetY(-15);

        $this->SetFont('helvetica', 'B', 8);
        $this->Cell(0, 10, date("Y.m.d"), 0, false, 'L', 0, '', 0, false, 'T', 'M');

        $this->SetX(0);

        $this->Cell(0, 10, $this->footerStr, 0, false, 'C', 0, '', 0, false, 'T', 'M');

        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(33, 10, $ui_page.' '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }


}


#
# Informação contextual
#
$plano = '';
$processo = '';
$dt_ini = '';
$dt_fim = '';
$fase = '';
$estado = '';
$fechado = '';
$homologacao = '';
$concordancia = '';
$rhid = '';
$nome = '';
$sexo = '';
$situacao = '';
$dt_sit = '';
$funcao = '';
$tempo_servico = '';
$vinculo = '';
$estrutura = '';
$hab_liter = '';
$idade = '';


#
# Obtenção da informação da avaliação
#
$msg = '';
$avaliacao = info_avaliacao($empresa_, $id_pa_, $dt_ini_pa_, $id_proc_av_, $dt_ini_proc_, $rhid_, $dt_adm_, $rhid_avaliador_, $id_fase_, $dt_ini_fase_, $dt_ini_fpa_, $dt_ini_af_, $msg);
if ($msg != '') {
    echo $msg;
} elseif(!$avaliacao) {
    echo "empresa_:$empresa_<br/>id_pa:$id_pa_<br/>dt_ini_pa:$dt_ini_pa_<br/>".
         "id_proc:$id_proc_av_<br/>dt_ini_proc_:$dt_ini_proc_<br/>".
         "id_fase:$id_fase_<br/>id_fase:$dt_ini_fase_<br/>dt_ini_fpa_:$dt_ini_fpa_<br/>dt_ini_af_:$dt_ini_af_<br/>".
         "rhid:$rhid_<br/>dt_adm_:$dt_adm_<br/>".
         "rhid_avaliador:$rhid_avaliador_<br/>";
}

if ($avaliacao && $msg == '') {

    #$id_ficha = $avaliacao['ID_FICHA'];
    $plano = $avaliacao['DSP_PA'];
    $processo = $avaliacao['DSP_PROCESSO'];
    $dt_ini = data($avaliacao['DT_INI_AVALIACAO']);
    $dt_fim = data($avaliacao['DT_FIM_AVALIACAO']);
    $fase = $avaliacao['DSP_FASE'];
    $obs_ficha = '';
    $rhid = $avaliacao['RHID'];
    $estado = dsp_dominio('GE_ESTADO_FA', $avaliacao['ESTADO'], $msg);
    $dados_colab = info_ficha_colab ($empresa_, $avaliacao['RHID'], $msg);

    $nome = $dados_colab['NOME'];
    $sexo = '';
    $situacao = $dados_colab['CD_SITUACAO']." - ".$dados_colab['DSP_SITUACAO'];
    $dt_sit = $dados_colab['DT_SITUACAO'];
    $funcao = $dados_colab['ID_FUNCAO']." - ".$dados_colab['DSP_FUNCAO'];
    $tempo_servico = '';
    $vinculo = $dados_colab['DSP_VINCULO'];
    $estrutura = $dados_colab['DSP_ESTRUTURA'];
    $hab_liter = '';
    $idade = '';

    if ($avaliacao['RHID'] == $avaliacao['RHID_AVALIADOR']) {
            $obs_ficha = get_obs_avaliacao($empresa_, $id_pa_, $dt_ini_pa_, $id_proc_av_, $dt_ini_proc_, 'AVALIADO', $rhid_, $dt_adm_, $rhid_avaliador_, $msg);
    } else {
            $obs_ficha = get_obs_avaliacao($empresa_, $id_pa_, $dt_ini_pa_, $id_proc_av_, $dt_ini_proc_, 'AVALIADOR', $rhid_, $dt_adm_, $rhid_avaliador_, $msg);
    }

    $peso = $avaliacao['PESO'];
    $nota_aval = $avaliacao['NOTA_AVAL_FASE'];
    nota_final($avaliacao['EMPRESA'], $avaliacao['ID_PA'], $avaliacao['DT_INI_PA'], $avaliacao['ID_PROCESSO_AV'], $avaliacao['DT_INI_PROCESSO'], $avaliacao['RHID'], $avaliacao['DT_ADMISSAO'], $nota_final, $obj_final, $comp_final, $msg);

    #
    #	DETERMINA O TIPO DE EVENTO DE AVALIAÇÃO QUE A FICHA SELECCIONADA ENDEREÇA
    #
    #	Tipo Fase Avaliação (FICHA_AVAL)
    #       	S	Geração fichas de avaliação
    #       	A       Geração fichas de avaliação intermédias
    #       	B	Entrevistas
    #       	C	Homologação
    #       	D	Concordância
    #       	N	Processual DRH - não aplicável no portal
    #
    $tp_aval = '';
    $dsp_tp_aval = '';
    tipo_avaliacao($empresa_, $id_pa_, $dt_ini_pa_, $id_proc_av_, $dt_ini_proc_, $id_fase_, $dt_ini_fase_, $dt_ini_fpa_, $tp_aval, $dsp_tp_aval, $msg);

    $concordancia = 'N';
    if ($tp_aval == 'D') {
        $concordancia = 'S';
    }

    #
    # Se é homologação, determina a ficha de avaliação base para efectuar... o carregamento....
    #
    $homologacao = 'N';
    $existe_homolg = 0;
   if ($tp_aval == 'C') {
       $homologacao = 'S';
       $aval_homol = homologacao_aval($empresa_, $id_pa_, $dt_ini_pa_, $id_proc_av_, $dt_ini_proc_, $rhid_, $dt_adm_, $id_ficha, $existe_homolg, $msg);
   }

    #
    #	DETERMINA O ESTADO DA "FICHA"
    #
    #	Estado Ficha (ESTADO_FICHA)
    #		A	Criado
    #		B	Em preechimento
    #		C	Submetido
    #		D	Encerrado
    #		Z	Não aplicável
    #
    $estado = dsp_dominio('GE_ESTADO_FA', $avaliacao['ESTADO'], $msg);

}

#
# Definição do cabeçalho
#
$cabecalho = '<table cellpadding="5" cellmargin="0" style="width:100%;border:1px solid black;text-align:center">'.
             '   <tbody> '.
#               '      <tr> '.
#	       '	<td align="left" colspan="4">'."concordancia:$concordancia homologacao:$homologacao".'</td> '.
#               '      </tr> '.
             '      <tr> '.
             '	<td align="left" style="width:15%">'.$ui_colab.' :'.'</td> '.
             '	<td align="left" style="width:55%">'.$nome.'</td>'.
             '	<td align="left" style="width:15%">'.$ui_rhid.' :'.'</td> '.
             '	<td align="left" style="width:15%">'.$rhid.'</td>'.
             '      </tr> '.
             '      <tr> '.
             '	<td align="left">'.$ui_plan.' :'.'</td> '.
             '	<td align="left">'.$plano.'</td>'.
             '	<td align="left">'.$ui_eval_dt_ini_short.' :'.'</td> '.
             '	<td align="left">'.$dt_ini.'</td> '.
             '      </tr> '.
             '      <tr> '.
             '	<td align="left">'.$ui_process.' :'.'</td> '.
             '	<td align="left">'.$processo.'</td>'.
             '	<td align="left">'.$ui_eval_dt_fim_short.' :'.'</td> '.
             '	<td align="left">'.$dt_fim.'</td> '.
             '      </tr> '.
             '      <tr> '.
             '	<td align="left">'.$ui_function.' :'.'</td> '.
             '	<td align="left">'.$funcao.'</td>'.
             '	<td align="left"><b>'.$ui_final_grade.' :'.'</b></td> '.
             '	<td align="left"><b>'.number_format($nota_final,2).'%</b></td> '.
             '      </tr> '.
             '   </tbody> '.
             '</table> ';


#
# Geração do PDF
#
$pdf = new MYPDF('P', 'px',  'A4', true, 'UTF-8', false);

#
# Definir dados do cabeçalho
#
$pdf->SetHeaderData(date('Y.m.d'),'DOC 1','Activo');
#  $pdf->SetFooterData('Rodapé da ficha');

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, 60, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(10);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set some language-dependent strings
$pdf->setLanguageArray($l);

$pdf->AddPage();
$pdf->SetFont('helvetica', '', 8);

#
#	CABEÇALHO
#
$pdf->writeHTML($cabecalho, true, false, true, false);

$separador = '<div style="clear:both:height:20px">&nbsp;</div>';
$pdf->writeHTML($separador, true, false, true, false);

#
#	COMPETÊNCIAS E COMPORTAMENTOS
#
$existe = false;
$id_comp = '';
$nr_ctencia = 0;
$cnt = 0;

# resultado de avaliação de competências da ficha de avaliação
$res_ac = info_res_avaliacao_competencias ($empresa_, $id_pa_, $dt_ini_pa_, $id_proc_av_, $dt_ini_proc_, $rhid_, $dt_adm_, $rhid_avaliador_,
                                           $id_fase_, $dt_ini_fase_, $dt_ini_fpa_, $dt_ini_af_, $nr_ctencia, $msg);
$res_aval_comp = $res_ac->fetchAll(PDO::FETCH_ASSOC);
$cnt = $nr_ctencia;

//OBJECTIVOS
$existe = false;
$nr_obj = 0;

$res_ao = info_res_avaliacao_objectivos ($empresa_, $id_pa_, $dt_ini_pa_, $id_proc_av_, $dt_ini_proc_, $rhid_, $dt_adm_, $rhid_avaliador_,
                                         $id_fase_, $dt_ini_fase_, $dt_ini_fpa_, $dt_ini_af_, $nr_obj, $msg);
$res_aval_obj = $res_ao->fetchAll(PDO::FETCH_ASSOC);
$cnt = $cnt + $nr_obj;

$nr_ctencia = 0;
$nr_obj = 0;

if ($cnt !=0 ) {

    # tratamento de escalas
#    $escalas = info_escalas_competencias($empresa_, $id_pa_, $dt_ini_pa_, $id_proc_av_, $dt_ini_proc_, $rhid_, $dt_adm_, $rhid_avaliador_, $id_fase_, $dt_ini_fase_, $dt_ini_fpa_, $dt_ini_af_, $msg);

    $competencias =
            '<table border="1" cellpadding="5" cellmargin="0" align="center" style="width:100%;margin-bottom:20px;"> '.
            '   <tr> ';

    $competencias .= '<td align="left" style="width:70%">'.$ui_qualifications.'</td>';
#    $competencias .= '<td align="left" style="width:25%">'.mb_strtoupper($ui_eval, "UTF-8").'</td>';
    $competencias .= '<td align="left" style="width:10%">'.$ui_weight.'</td>';
    $competencias .= '<td align="left" style="width:10%">'.$ui_accomplished.'</td>';
    $competencias .= '<td align="left" style="width:10%">'.$ui_scoring.'</td>';

    $competencias .= '</tr> ';

    try {
	foreach ($res_aval_comp as $key => $row) {
        #while ($row = $avaliacao_competencias->fetch(PDO::FETCH_ASSOC)) {
#var_dump($row);
            $existe = true;

            # Mostra COMPETÊNCIAS
            if ($id_comp == '' || $id_comp != $row['ID_COMPETENCIA']) {

                $nr_ctencia += 1;
                $nr_ctmento = 0;
                $competencias .= '<tr>';
                $competencias .= '	<td class="dados" align="left">';
                $competencias .= $nr_ctencia.'. '.$row['DSP_COMPETENCIA'];
                $competencias .= '	<div style="margin-top:8px;margin-left:20px;width:300px">';
                $competencias .= '	<small>'.$row['DESCRICAO'].'</small>';
                $competencias .= '	</div>';
                $competencias .= '	</td>';
                $competencias .= '<td class="dados">'.number_format($row['PESO_COMPETENCIA'],2).'% '.'</td>';
#                $competencias .= '<td class="dados" style="text-align:right">'.$row['PESO_OBJECTIVO'].'</td>';
                $competencias .= '<td class="dados">'.number_format($row['VLR_COMPETENCIA'],2).'</td>';
                $competencias .= '<td class="dados">'.number_format($row['PERC_COMPETENCIA'],2).'</td>';
                $competencias .= '</tr>';

                $id_comp = $row['ID_COMPETENCIA'];
            }

        }
    }
    catch (Exception $ex) {
        echo "avaliacao competencias#1 :" . $ex->getMessage();
    }

} # existem competências

$competencias .= '</table>';
$pdf->writeHTML($competencias, true, false, true, false);


#
#	OBJECTIVOS
#
$objectivos = '';
$existe = false;
$id_comp = '';
$nr_obj = 0;
$cnt = 0;

# objectivos da ficha de avaliação
if ($tp_aval == 'S' || $tp_aval == 'A' || $tp_aval == 'D') { # fichas avaliação / fichas avaliação intermédia / concordância
    $avaliacao_objetivos = info_avaliacao_objectivos($empresa_, $id_pa_, $dt_ini_pa_, $id_proc_av_, $dt_ini_proc_, $rhid_, $dt_adm_, $rhid_avaliador_, $id_fase_, $dt_ini_fase_, $dt_ini_fpa_, $dt_ini_af_, $cnt, $msg);
} elseif ($tp_aval == 'B') { # Entrevistas
    $cnt = 0;
} elseif ($tp_aval == 'C') { # Homologação
    if ($existe_homolg) {
        $avaliacao_objetivos = info_avaliacao_objectivos($aval_homol['EMPRESA'], $aval_homol['ID_PA'], $aval_homol['DT_INI_PA'], $aval_homol['ID_PROCESSO_AV'], $aval_homol['DT_INI_PROCESSO'], $aval_homol['RHID'], $aval_homol['DT_ADMISSAO'], $aval_homol['RHID_AVALIADOR'], $aval_homol['ID_FASE'], $aval_homol['DT_INI_FASE'], $aval_homol['DT_INI_FPA'], $aval_homol['DT_INI_AF'], $cnt, $msg);
    }
}

if ($competencias != '' && $cnt != 0) {
  $pdf->AddPage();
  $pdf->SetFont('helvetica', '', 8);
}


if ($cnt != 0) {

    $objectivos .= '<table border="1" cellpadding="5" cellmargin="0" align="center" style="width:100%;margin-bottom:20px;"> '.
                   ' <tr> '.
                   '	<td align="left" style="width:75%">'.$ui_objectives.'</td> ';

    if ($concordancia == 'S')
        $objectivos .= '	<td align="left" style="width:25%">'.$ui_qualifications.'</td> ';
    else
        $objectivos .= '	<td align="left" style="width:25%">'. $ui_eval.'</td> ';

    $objectivos .= ' </tr> ';

    try {
        while ($row = $avaliacao_objetivos->fetch(PDO::FETCH_ASSOC)) {

            $existe = true;
            $nr_obj += 1;
            $objectivos .= '<tr>';

            # Designação do objectivo
            $objectivos .= ' <td class="dados" align="left">';
            $objectivos .= trata_euro($nr_obj.'. '.$row['DSP_OBJECTIVO']);
            $objectivos .= '  <div style="margin-top:8px;margin-left:20px;font-size:10px;width:580px">';
            $objectivos .= '    <small>'.trata_euro($row['DESC_OBJECTIVO']).'</small>';
            $objectivos .= '  </div>';
            $objectivos .= ' </td>';

            # valor do objectivo
            $nv_ = $row['VLR_ATRIBUIDO'];

            if ($concordancia == 'S') { # homologação de resultados
                $objectivos .= '<td class="dados" align="left">';
                $objectivos .= $row['COMENT_AVALIADO'];
                $objectivos .= '</td>';
            } else { # recolha de resultados
                if ($row['ID_EP'] != '' && $row['DT_INI_EP'] != '') {
                        $objectivos .= '<td class="dados" style="text-align:left">';
                        $objectivos .= dsp_nivel_escala($empresa_, $row['ID_EP'] , $row['DT_INI_EP'], $nv_, $msg);
                        # magnitude
                        $objectivos .=  "&nbsp;".trata_euro(dsp_magnitude($empresa_, $row['ID_MAGNITUDE'], $row['DT_INI_DM'], $msg));
                        $objectivos .= '</td>';
                } else {
                        $objectivos .= '<td class="dados" style="text-align:left">';
                        $objectivos .= utf8_encode($nv_);
                        # magnitude
                        $objectivos .= "&nbsp;".trata_euro(dsp_magnitude($empresa_, $row['ID_MAGNITUDE'], $row['DT_INI_DM'], $msg));
                        $objectivos .= '</td>';
                }
            }
            $objectivos .= '</tr>';

/*				if ($homologacao == 'S') { # homologação de resultados
                                if ($row['COMENT_AVALIADO'] != '')
                                        $objectivos .= '<tr id="obs_'.$row['ID'].'">';
                                else
                                        $objectivos .= '<tr id="obs_'.$row['ID'].'" style="display:none">';
                                $objectivos .= '<td colspan="2" style="padding-left:20px;text-align:left">';
                                $objectivos .= '<textarea style="width:98%;color:rgb(54,135,186);font" name="o_'.$row['ID'].'" ref="obs">'.utf8_encode($row['COMENT_AVALIADO']).' </textarea>';
                                $objectivos .= '</td>';
                                $objectivos .= '</tr>';
                        }
*/
        };
    } catch (Exception $ex) {
        echo "avaliacao objectivos#1 :" . $ex->getMessage();
    }

    $objectivos .= '</table>';
    $pdf->writeHTML($objectivos, true, false, true, false);
    
} # existem objectivos


if ($obs_ficha != '' && false) {
#
#	OBSERVAÇÕES
#
$obs = '<div style="margin:auto;width:94%;text-align:left;"><span>'.$ui_comment_general.'</span><br/>'.nl2br($obs_ficha).'</div>'.
       '<div style="height:10px">&nbsp;</div>';

$pdf->writeHTML($obs, true, false, true, false);
}

#
# Tabela com:
# 
#    APROVADOR/DT_HR/COMENTÁROS
#    HOMOLOGADOR/DT_HR/COMENTÁROS
#    COLABORADOR/DT_HR/COMENTÁROS/CONCORDÂNCIA
#

$assinaturas = '<table border="1" cellpadding="5" cellmargin="0" align="center" style="width:100%;margin-bottom:20px;"> ';

# cabeçalho
$assinaturas .= ' <tr> '.
                '	<td align="left" style="width:12%"></td> '.
                '	<td align="left" style="width:36%;font-weight:bold">'.$ui_actors.'</td> '.
                '	<td align="left" style="width:16%;font-weight:bold">'.$ui_date.'</td> '.
                '	<td align="left" style="width:6%;font-weight:bold">'.$ui_ok.'</td> '.
                '	<td align="left" style="width:30%;font-weight:bold">'.$ui_comment.'</td> '.
                ' </tr> ';

# avaliação

$ok_aval = '';
$ok_homolog = '';
$ok_concord = '';

# ESTADO
# A	Criada
# B	Em preenchimento
# B0	Para Homologação
# B1	Não Homologada
# C	Submetida / Homologada
# D	Encerrada
# Z	Não aplicável
if ($avaliacao['ESTADO'] == 'BO' || $avaliacao['ESTADO'] == 'C' || $avaliacao['ESTADO'] == 'D') {
    $ok_aval = $ui_yes;
}

if ($avaliacao['ESTADO'] == 'B1') {
    $ok_homolog = $ui_no;
} elseif ($avaliacao['ESTADO'] == 'C' || $avaliacao['ESTADO'] == 'D') {
    $ok_homolog = $ui_yes;
}

if ($avaliacao['AVALIADO_OK'] == 'S') {
    $ok_concord = $ui_yes;
}
elseif ($avaliacao['AVALIADO_OK'] == 'N') {
    $ok_concord = $ui_no;
}

$assinaturas .= ' <tr> '.
                '	<td align="left" style="font-weight:bold">'.$ui_assessment.'</td> '.
                '	<td align="left" style="">'.$avaliacao['NOME_AVALIADOR']. " (".$avaliacao['RHID_AVALIADOR'].")".'</td> '.
                '	<td align="left" style="">'.$avaliacao['DT_HR_AVALIADOR'].'</td> '.
                '	<td align="left" style="">'.$ok_aval.'</td> '.
                '	<td align="left" style="">'.($avaliacao['COMENTARIO_AVALIADOR']).'</td> '.
                ' </tr> ';


# homologação
$assinaturas .= ' <tr> '.
                '	<td align="left" style="font-weight:bold">'.$ui_homologation.'</td> '.
                '	<td align="left" style="">'.$avaliacao['NOME_HOMOLOGADOR']. " (".$avaliacao['RHID_HOMOLOGADOR'].")".'</td> '.
                '	<td align="left" style="">'.$avaliacao['DT_HR_HOMOLOGADOR'].'</td> '.
                '	<td align="left" style="">'.$ok_homolog.'</td>'.
                '	<td align="left" style="">'.($avaliacao['OBS_HOMOLOGADOR']).'</td> '.
                ' </tr> ';

# concordância
$assinaturas .= ' <tr> '.
                '	<td align="left" style="font-weight:bold">'.$ui_agreement.'</td> '.
                '	<td align="left" style="">'.$avaliacao['NOME_AVALIADO']. " (".$avaliacao['RHID'].")".'</td> '.
                '	<td align="left" style="">'.$avaliacao['DT_UPDATED'].'</td> '.
                '	<td align="left" style="">'.$ok_concord.'</td>'.
                '	<td align="left" style="">'.($avaliacao['COMENTARIO_AVALIADO']).'</td> '.
                ' </tr> ';

$assinaturas .= '</table>';
$pdf->writeHTML($assinaturas, true, false, true, false);

//	$pdf->Output('ficha_av_'.$rec['rhid'].'_'.date('Ymd',strtotime($rec['dt_inicio'])).'.pdf', 'I');
$pdf->Output('example_021.pdf', 'I');
