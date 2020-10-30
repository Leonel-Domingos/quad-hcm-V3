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


$nota_final_ = '';
$nota_competencia_ = '';

# poderá quer dizer que é uma ficha de avaliação única, pelo que procurará a ficha respetiva
if ($rhid_avaliador_ == '' && $id_fase_ == '') {

	try {
		$sql = 	"SELECT B.RHID_AVALIADOR , B.ID_FASE, B.DT_INI_FASE, B.DT_INI_FPA, B.DT_INI_AF, B.TOT_COMPETENCIA, B.NOTA_FINAL ".
			"FROM RH_FASES_FONTES_PROCESSO A, MASTER_AVALIACAO B ".
			"WHERE A.EMPRESA = B.EMPRESA ".
			"  AND A.ID_PA = B.ID_PA ".
			"  AND A.DT_INI_PA = B.DT_INI_PA ".
			"  AND A.ID_PROCESSO_AV = B.ID_PROCESSO_AV ".
			"  AND A.DT_INI_PROCESSO = B.DT_INI_PROCESSO ".
			"  AND A.ID_FASE = B.ID_FASE ".
			"  AND A.DT_INI_FASE = B.DT_INI_FASE ".
			"  AND A.DT_INI_FPA = B.DT_INI_FPA ".
			"  AND A.FICHA_AVAL IN ('S','A') ".
	                "  AND B.EMPRESA = :EMPRESA_ ".
			"  AND B.ID_PA = :ID_PA_ ".
			"  AND B.DT_INI_PA = :DT_INI_PA_ ".
			"  AND B.ID_PROCESSO_AV = :ID_PROCESSO_AV_ ".
			"  AND B.DT_INI_PROCESSO = :DT_INI_PROCESSO_ ".
			"  AND B.RHID = :RHID_ ".
	                "  AND B.DT_ADMISSAO = :DT_ADMISSAO_ ";

		$stmt = $db->prepare($sql);
		$stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
		$stmt->bindParam(':ID_PA_', $id_pa_, PDO::PARAM_STR);
		$stmt->bindParam(':DT_INI_PA_', $dt_ini_pa_, PDO::PARAM_STR);
		$stmt->bindParam(':ID_PROCESSO_AV_', $id_proc_av_, PDO::PARAM_STR);
		$stmt->bindParam(':DT_INI_PROCESSO_', $dt_ini_proc_, PDO::PARAM_STR);
		$stmt->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
		$stmt->bindParam(':DT_ADMISSAO_', $dt_adm_, PDO::PARAM_STR);
		$stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rhid_avaliador_ = $row['RHID_AVALIADOR'];
			$id_fase_ = $row['ID_FASE'];
			$dt_ini_fase_ = $row['DT_INI_FASE'];
			$dt_ini_fpa_ = $row['DT_INI_FPA'];
			$dt_ini_af_ = $row['DT_INI_AF'];
			$nota_final_ = $row['NOTA_FINAL'];
		        $nota_competencia_ = $row['TOT_COMPETENCIA'];
                }

        } catch (PDOException $ex) {
            $msg = "info_avaliacao#1 :" . $ex->getMessage();
            echo $msg;
        }
}


#
# Extensão da classe TCPDF para configurar cabeçalho e rodapé
#
class MYPDF extends TCPDF {

    //Page header
    public function Header() {

       global $ui_eval_sheet;

       #get_logo_info($logo, $w, $h, $msg);

       $location = str_replace("data-source/ad_pdf_ficha_aval.php","",__FILE__);
       $location = str_replace("data-source\ad_pdf_ficha_aval.php","",$location);
       $logo = "$location/img/logo.png";
#echo "logo:$logo";
#\\LOAS018\PORTAL_TCMIP\quad_hcm\data-source\ad_pdf_ficha_aval.php/img/logo.png
       list($w, $h) = getimagesize ($logo);

       if ($h > 65 ) {
           $nw = round(55 * $w / $h);
           $nw = 65;
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

       $this->MultiCell(592, 60, '      '.$ui_eval_sheet, 0, 'C', 0, 1, 1, 1, true, 0, false, true, 50, 'M');
       $this->SetFont('helvetica', '', 8);


$this->writeHTML($this->cabecalho, true, false, true, false);

$separador = '<div style="clear:both:height:20px">&nbsp;</div>';
$this->writeHTML($separador, true, false, true, false);



    }

    public function SetHeaderData($dt_admissao,$nr_documento,$estado,$cabecalho){
            $this->dt_admissao = $dt_admissao;
            $this->nr_documento = $nr_documento;
            $this->estado = $estado;
            $this->cabecalho = $cabecalho;
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

#echo "$empresa_, $id_pa_, $dt_ini_pa_, $id_proc_av_, $dt_ini_proc_, $rhid_, $dt_adm_, $rhid_avaliador_, $id_fase_, $dt_ini_fase_, $dt_ini_fpa_, $dt_ini_af_";
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
    $nome = $avaliacao['NOME_AVALIADO'];
    $dados_colab = info_ficha_colab ($empresa_, $rhid_, $msg);
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
             '	<td align="left"></td> '.
             '	<td align="left"></td>'.
             '      </tr> '.
             '      <tr> '.
             '	<td align="left">'.$ui_phase.' :'.'</td> '.
             '	<td align="left">'.$fase.'</td>'.
             '	<td align="left">'.$ui_status.' :'.'</td> '.
             '	<td align="left">'.$estado.'</td>'.
             '      </tr> ';

if ($nota_final_ != '' && $nota_competencia_ != '') {

	$cabecalho .= '      <tr> '.
	              '	<td align="left" colspan="2"></td> '.
	              '	<td align="left">'.$ui_grade_final.' :'.'</td> '.
	              '	<td align="left">'.$nota_final_.' %</td>'.
	              '      </tr> ';

}

$cabecalho .= '   </tbody> '.
             '</table> ';


#
# Geração do PDF
#
$pdf = new MYPDF('P', 'px',  'A4', true, 'UTF-8', false);

#
# Definir dados do cabeçalho
#
$pdf->SetHeaderData(date('Y.m.d'),'DOC 1','Activo',$cabecalho);
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

$pdf->SetMargins(PDF_MARGIN_LEFT, 200, PDF_MARGIN_RIGHT);

//set auto page breaks
#$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetAutoPageBreak(TRUE, 60);


//set some language-dependent strings
$pdf->setLanguageArray($l);

$pdf->AddPage();
$pdf->SetFont('helvetica', '', 8);

#
#	CABEÇALHO
#
#$pdf->writeHTML($cabecalho, true, false, true, false);

#$separador = '<div style="clear:both:height:20px">&nbsp;</div>';
#$pdf->writeHTML($separador, true, false, true, false);

#
#	COMPETÊNCIAS E COMPORTAMENTOS
#
$competencias = '';

$existe = false;
$id_comp = '';
$nr_ctencia = 0;
$nr_ctmento = 0;
$cnt = 0;

# competências da ficha de avaliação
if ($tp_aval == 'S' || $tp_aval == 'A' || $tp_aval == 'D') { # fichas avaliação / fichas avaliação intermédia / concordância
        $avaliacao_competencias = info_avaliacao_competencias($empresa_, $id_pa_, $dt_ini_pa_, $id_proc_av_, $dt_ini_proc_, $rhid_, $dt_adm_, $rhid_avaliador_, $id_fase_, $dt_ini_fase_, $dt_ini_fpa_, $dt_ini_af_, $cnt, $msg);
}
elseif ($tp_aval == 'B') { # Entrevistas
        $cnt = 0;
}
elseif ($tp_aval == 'C') { # Homologação
        if ($existe_homolg) {
                $avaliacao_competencias = info_avaliacao_competencias($aval_homol['EMPRESA'], $aval_homol['ID_PA'], $aval_homol['DT_INI_PA'], $aval_homol['ID_PROCESSO_AV'], $aval_homol['DT_INI_PROCESSO'], $aval_homol['RHID'], $aval_homol['DT_ADMISSAO'], $aval_homol['RHID_AVALIADOR'], $aval_homol['ID_FASE'], $aval_homol['DT_INI_FASE'], $aval_homol['DT_INI_FPA'], $aval_homol['DT_INI_AF'], $cnt, $msg);
        }
}

if ($cnt !=0 ) {

    # tratamento de escalas
    $escalas = info_escalas_competencias($empresa_, $id_pa_, $dt_ini_pa_, $id_proc_av_, $dt_ini_proc_, $rhid_, $dt_adm_, $rhid_avaliador_, $id_fase_, $dt_ini_fase_, $dt_ini_fpa_, $dt_ini_af_, $msg);

    $competencias =
            '<table border="1" cellpadding="5" cellmargin="0" align="center" style="width:100%;margin-bottom:20px;"> '.
            '   <tr> ';

    if ($concordancia == 'S') { # homologação de resultados

            $competencias .= '<td align="left" style="width:75%">'.$ui_qualifications.'</td>';
            $competencias .= '<td align="left" style="width:25%">'.$ui_comments.'</td>';

    } else { # recolha de resultados

            $cnt_nv = 0;
            if (count($escalas) == 1 && $escala_unica) { # uma só escala, coloca a escala na vertical
                    $aux = '';
                    $nv_escala = dsp_valores_escalas($empresa_, $escalas[1]['cd'], $escalas[1]['dt'], $msg);
                    foreach($nv_escala as $value) {
                            $aux .= '<td align="center" style="width:9%">'.$value['DSR_NEP'].'</td>';
                            $cnt_nv += 1;
                    }

                    $size1 = (100 - 9*$cnt_nv);
                    $competencias .= '<td align="left" style="width:'.$size1.'%">'.$ui_qualifications.'</td>'.
                                     $aux;

            } else {
                    $competencias .= '<td align="left" style="width:75%">'.$ui_qualifications.'</td>';
                    $competencias .= '<td align="left" style="width:25%">'.mb_strtoupper($ui_eval, "UTF-8").'</td>';
                    $cnt_nv = -1;
            }
    }
    $competencias .= '</tr> ';

    try {
        while ($row = $avaliacao_competencias->fetch(PDO::FETCH_ASSOC)) {

            $existe = true;

            # Mostra COMPETÊNCIAS
            if ($id_comp == '' || $id_comp != $row['ID_COMPETENCIA']) {

                $nr_ctencia += 1;
                $nr_ctmento = 0;
                $competencias .= '<tr>';
                $competencias .= '	<td class="dados" colspan="10" align="left">';
                $competencias .= $nr_ctencia.'. '.$row['DSP_COMPETENCIA'];
                $competencias .= '	<div style="margin-top:8px;margin-left:20px;width:300px">';
                $competencias .= '	<small>'.$row['DESC_COMPETENCIA'].'</small>';
                $competencias .= '	</div>';
                $competencias .= '	</td>';
                $competencias .= '</tr>';

                $id_comp = $row['ID_COMPETENCIA'];
            }

            # Mostra comportamentos
            $nr_ctmento += 1;
            $competencias .= '<tr>';
            $competencias .= '<td class="dados" style="text-align:left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>'.$nr_ctencia.'.'.$nr_ctmento.' '.$row['DSP_COMPORTAMENTO'].'</span></td>';

            # Valores dos comportamentos
            $nv_ = $row['ID_NV_AF']; # valor do comportamento
            $obs_ = $row['COMENTARIO']; # comentário associado.

            if ($concordancia == 'S') { # homologação de resultados

                $competencias .= '<td class="dados" align="left">';
                $competencias .= $row['COMENTARIO'];
                $competencias .= '</td>';

            } else { # visualiza resultados

                if (count($escalas) == 1 && $escala_unica) { # uma só escala, coloca a escala na vertical
                    foreach($nv_escala as $value) {
                        if ($nv_ == $value['ID_NV_ESCALA'])
                                $competencias .= '<td class="dados">X</td>';
                        else
                                $competencias .= '<td class="dados">&nbsp;</td>';
                    }
                } else {
                    $competencias .= '<td class="dados">';
                    $dsp = dsp_nivel_escala($empresa_, $row['ID_EP'] , $row['DT_INI_EP'], $nv_, $msg);
                    $competencias .= $dsp;
                    $competencias .= '</td>';
                }

            }
            $competencias .= '</tr>';

            if ($homologacao == 'S') { # homologação de resultados
                    if ($row['COMENTARIO'] != '')
                            $competencias .= '<tr id="obs_'.$row['ID'].'">';
                    else
                            $competencias .= '<tr id="obs_'.$row['ID'].'" style="display:none">';

                    $competencias .= '<td colspan="2" style="padding-left:20px;text-align:left">';
                    $competencias .= $row['COMENTARIO'];
                    $competencias .= '</td>';
                    $competencias .= '</tr>';
            }

        }
    }
    catch (Exception $ex) {
        echo "avaliacao competencias#1 :" . $ex->getMessage();
    }

    $competencias .= '</table>';
    $pdf->writeHTML($competencias, true, false, true, false);

} # existem competências



#
#	OBJECTIVOS
#
if ($competencias != '') {
  $pdf->AddPage();
  $pdf->SetFont('helvetica', '', 8);

  #
  #	CABEÇALHO
  #
#  $pdf->writeHTML($cabecalho, true, false, true, false);

#  $separador = '<div style="clear:both:height:20px">&nbsp;</div>';
#  $pdf->writeHTML($separador, true, false, true, false);

}

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



#
#	OBSERVAÇÕES
#
#$obs = '<div style="margin:auto;width:94%;text-align:left;"><span>'.$ui_comment_general.' </span><br/><br/>'.nl2br(utf8_encode($obs_ficha)).'</div>'.
#       '<div style="height:10px;clear:both">&nbsp;</div>';

#$pdf->writeHTML($obs, true, false, true, false);


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
                '	<td align="left" style="">'.$ok_aval.'</td> ';
    $assinaturas .= '	<td align="left" style="">'.($avaliacao['COMENTARIO_AVALIADOR']).'</td> ';
$assinaturas .= ' </tr> ';


# homologação
if ($ok_homolog != '') {
    $assinaturas .= ' <tr> '.
                    '	<td align="left" style="font-weight:bold">'.$ui_homologation.'</td> '.
                    '	<td align="left" style="">'.$avaliacao['NOME_HOMOLOGADOR']. " (".$avaliacao['RHID_HOMOLOGADOR'].")".'</td> '.
                    '	<td align="left" style="">'.$avaliacao['DT_HR_HOMOLOGADOR'].'</td> '.
                    '	<td align="left" style="">'.$ok_homolog.'</td>';
    if (@$_SESSION['rhid'] != $avaliacao['RHID']) {
        $assinaturas .= '	<td align="left" style="">'.($avaliacao['OBS_HOMOLOGADOR']).'</td> ';
    } else {
        $assinaturas .= '	<td align="left" style=""></td> ';
    }

    $assinaturas .= ' </tr> ';
}

# concordância
if ($ok_concord != '') {
    $assinaturas .= ' <tr> '.
                    '	<td align="left" style="font-weight:bold">'.$ui_agreement.'</td> '.
                    '	<td align="left" style="">'.$avaliacao['NOME_AVALIADO']. " (".$avaliacao['RHID'].")".'</td> '.
                    '	<td align="left" style="">'.$avaliacao['DT_HR_AVALIADO'].'</td> '.
                    '	<td align="left" style="">'.$ok_concord.'</td>';
    $assinaturas .= '	<td align="left" style="">'. ($avaliacao['COMENTARIO_AVALIADO']).'</td> ';
    $assinaturas .= ' </tr> ';
}

$assinaturas .= '</table>';
$pdf->writeHTML($assinaturas, true, false, true, false);

//	$pdf->Output('ficha_av_'.$rec['rhid'].'_'.date('Ymd',strtotime($rec['dt_inicio'])).'.pdf', 'I');
$pdf->Output('example_021.pdf', 'I');
