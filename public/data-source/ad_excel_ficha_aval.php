<?php
 /*
 *  @autor      Pedro Estácio <pedro.estacio@quad-systems.com>
 *  @projeto    QUAD-HCM
 *  @versão     1.0
 *  @revisão    2018.10.02
 *  @copyright  (c) 2018 QuadSystems - http://www.quad-systems.com
 *  @nome       ad_excel_ficha_aval.php
 *  @descrição  Implementação da emissão em EXCEL da ficha de avaliação
 *
 */

# cabeçaho do controlador
require_once 'quad_head_controller.php';

# não deverá necessitar, uma vez que já foi feito o carregamento das livrarias via composer no quad_head_controller.php
#require_once ("../classes/PHPExcel.php");

require_once INCLUDES_PATH."/lib/ad_lib.php";


#
# Parâmetros
#
$msg = '';
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
		$sql = 	"SELECT B.RHID_AVALIADOR , B.ID_FASE, B.DT_INI_FASE, B.DT_INI_FPA, B.DT_INI_AF, B.TOT_COMPETENCIA, B.NOTA_FINAL  ".
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
#    info_ficha_colab ($empresa_, $avaliacao['RHID'], $d, $nome, $sexo, $situacao, $dt_sit,
#                      $funcao, $tempo_servico, $vinculo, $estrutura, $hab_liter, $idade, $msg);

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
#
#
$titulo = $ui_eval_sheet;
$autor = @$_SESSION['utilizador'];
$data = date("Y.m.d H:i");
$dt = date("Y_m_d_H_i");
$f = "ficha_av_$rhid_$fase_$dt";
$sheet = 0;

// Novo objecto
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("QUADSYSTEMS")
         ->setLastModifiedBy($autor)
         ->setTitle($titulo);
#		 ->setSubject(("Exportação de ficha de avaliação de desempenho"))
#		 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
#		 ->setKeywords(("WIPS Portal Colaborativo Avaliação Desempenho"));
#		 ->setCategory("Test result file");

$objPHPExcel->getDefaultStyle()->getFont()->setName('Calibri');
$objPHPExcel->getDefaultStyle()->getFont()->setSize(11);

$styleArrayLeft = array(
     'alignment' => array(
             'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
             'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
     )
);

$styleArrayRight = array(
     'alignment' => array(
             'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
             'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
     )
);


#
# Ficha de Avaliação
#

$col_fim = 5;
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle(substr($titulo,0,30));

$cnt = 2;

# Titulo do excel
$objPHPExcel->getActiveSheet()->getStyle('B2')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('B2')->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $cnt, $ui_eval_sheet);
$cnt += 2;

##
##	Cabeçalho
##

$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $cnt, $ui_colab." :");
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $cnt+1, $ui_plan." :");
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $cnt+2, $ui_process." :");
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $cnt+3, $ui_function." :");
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $cnt+4, $ui_phase." :");

$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $cnt, $nome);
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $cnt+1, $plano);
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $cnt+2, $processo);
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $cnt+3, $funcao);
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $cnt+4, $fase);

$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $cnt, $ui_rhid." :");
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $cnt+1, $ui_eval_dt_ini_short." :");
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $cnt+2, $ui_eval_dt_fim_short." :");
if ($nota_final_ != '')
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $cnt+3, $ui_grade_final." :");
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $cnt+4, $ui_status." :");

$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $cnt, $rhid);
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $cnt+1, $dt_ini);
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $cnt+2, $dt_fim);
if ($nota_final_ != '')
  $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $cnt+3, $nota_final_);
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $cnt+4, $estado);


## formatar cabeçalho
$objPHPExcel->getActiveSheet()->getStyle('B4:B8')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('D4:D8')->getFont()->setBold(true);

# alinhamentos
$objPHPExcel->getActiveSheet()->getStyle('B4:E8')->
        getAlignment()->applyFromArray(
                array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                    'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    'rotation'   => 0,
                    'wrap'       => true
                )
        );


# bordos
$border_style = array(
                    'borders' => array(
                        'outline' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array('rgb' => '000000')
                        )
                    )
                );

$objPHPExcel->getActiveSheet()->getStyle("B4:B8")->applyFromArray($border_style);
$objPHPExcel->getActiveSheet()->getStyle("C4:C8")->applyFromArray($border_style);
$objPHPExcel->getActiveSheet()->getStyle("D4:D8")->applyFromArray($border_style);
$objPHPExcel->getActiveSheet()->getStyle("E4:E8")->applyFromArray($border_style);

# fundos
$objPHPExcel->getActiveSheet()->getStyle('B4:B8')->getFill()->applyFromArray(
                array(
                    'type'       => PHPExcel_Style_Fill::FILL_SOLID,
                    'rotation'   => 0,
                    'startcolor' => array(
                        'rgb' => 'DAEEF3'
                    ),
                    'endcolor'   => array(
                        'rgb' => 'DAEEF3'
                    )
                )
);

$objPHPExcel->getActiveSheet()->getStyle('D4:D8')->getFill()->applyFromArray(
                array(
                    'type'       => PHPExcel_Style_Fill::FILL_SOLID,
                    'rotation'   => 0,
                    'startcolor' => array(
                        'rgb' => 'DAEEF3'
                    ),
                    'endcolor'   => array(
                        'rgb' => 'DAEEF3'
                    )
                )
);

#for ($i=4; $i<9; $i++) {
#    $objPHPExcel->getActiveSheet()->mergeCells('E'.$i.':'.excel_col($col_fim).$i);
#};


##
##	Competências
##
$lin = 10;

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

    if ($concordancia == 'S') { # concordancia de resultados

        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $lin, mb_strtoupper($ui_qualifications,"UTF-8"));
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $lin, mb_strtoupper($ui_comments,"UTF-8"));

        $objPHPExcel->getActiveSheet()->getStyle('B'.$lin.':E'.$lin)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$lin.':E'.$lin)->getFill()->applyFromArray(
                        array(
                            'type'       => PHPExcel_Style_Fill::FILL_SOLID,
                            'rotation'   => 0,
                            'startcolor' => array(
                                'rgb' => 'DAEEF3'
                            ),
                            'endcolor'   => array(
                                'rgb' => 'DAEEF3'
                            )
                        )
        );
        $objPHPExcel->getActiveSheet()->getStyle('B'.$lin.':C'.$lin)->
                getBorders()->getOutline()->applyFromArray(
                        array(
                            'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
                            'color' => array(
                                'rgb' => '000000000'
                            )
                        )
                );
        $objPHPExcel->getActiveSheet()->getStyle('D'.$lin.':E'.$lin)->
                getBorders()->getOutline()->applyFromArray(
                        array(
                            'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
                            'color' => array(
                                'rgb' => '000000000'
                            )
                        )
                );

        $objPHPExcel->getActiveSheet()->mergeCells('B'.$lin.':C'.$lin);
        $objPHPExcel->getActiveSheet()->mergeCells('D'.$lin.':E'.$lin);

    }
    else { # recolha de resultados

        #
        # Cabeçalho das competências
        #
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $lin, mb_strtoupper($ui_qualifications,"UTF-8"));

        $cnt_nv = 0;
        if (count($escalas) == 1 && $escala_unica) { # uma só escala, coloca a escala na vertical
            $aux = '';
            $nv_escala = dsp_valores_escalas($empresa_, $escalas[1]['cd'], $escalas[1]['dt'], $msg);
            foreach($nv_escala as $value) {
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3+$cnt_nv, $lin, $value['DSR_NEP']);
                    $cnt_nv += 1;
            }

            $objPHPExcel->getActiveSheet()->getStyle('B'.$lin.':'.excel_col($col_fim).$lin)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$lin.':'.excel_col($col_fim).$lin)->getFill()->applyFromArray(
                            array(
                                'type'       => PHPExcel_Style_Fill::FILL_SOLID,
                                'rotation'   => 0,
                                'startcolor' => array(
                                    'rgb' => 'DAEEF3'
                                ),
                                'endcolor'   => array(
                                    'rgb' => 'DAEEF3'
                                )
                            )
            );

            $objPHPExcel->getActiveSheet()->getStyle('B'.$lin.':C'.$lin)->
                    getBorders()->getOutline()->applyFromArray(
                            array(
                                'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
                                'color' => array(
                                    'rgb' => '000000000'
                                )
                            )
                    );

            $objPHPExcel->getActiveSheet()->getStyle('D'.$lin.':'.excel_col($col_fim).$lin)->
                    getBorders()->getOutline()->applyFromArray(
                            array(
                                'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
                                'color' => array(
                                    'rgb' => '000000000'
                                )
                            )
                    );

            $objPHPExcel->getActiveSheet()->getStyle('D'.$lin.':'.excel_col($col_fim).$lin)->
                    getAlignment()->applyFromArray(
                            array(
                                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                                'rotation'   => 0,
                                'wrap'       => true
                            )
                    );

        } else {

            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $lin, mb_strtoupper($ui_qualifications,"UTF-8"));
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $lin, mb_strtoupper($ui_eval,"UTF-8"));

            $objPHPExcel->getActiveSheet()->getStyle('B'.$lin.':E'.$lin)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$lin.':E'.$lin)->getFill()->applyFromArray(
                            array(
                                'type'       => PHPExcel_Style_Fill::FILL_SOLID,
                                'rotation'   => 0,
                                'startcolor' => array(
                                    'rgb' => 'DAEEF3'
                                ),
                                'endcolor'   => array(
                                    'rgb' => 'DAEEF3'
                                )
                            )
            );
            # bordo
            $objPHPExcel->getActiveSheet()->getStyle('B'.$lin.':C'.$lin)->applyFromArray($border_style);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$lin.':E'.$lin)->applyFromArray($border_style);

            # alinhamento
            $objPHPExcel->getActiveSheet()->mergeCells('B'.$lin.':C'.$lin);
            $objPHPExcel->getActiveSheet()->mergeCells('D'.$lin.':E'.$lin);

            $cnt_nv = -1;
        }
    }

    try {
        while ($row = $avaliacao_competencias->fetch(PDO::FETCH_ASSOC)) {

            $existe = true;

            # Mostra COMPETÊNCIAS
            if ($id_comp == '' || $id_comp != $row['ID_COMPETENCIA']) {
                $nr_ctencia += 1;
                $nr_ctmento = 0;

                $lin += 2;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $lin, $nr_ctencia.'. '.$row['DSP_COMPETENCIA']);
                $objPHPExcel->getActiveSheet()->mergeCells('B'.$lin.':C'.$lin);

                if ($row['DESC_COMPETENCIA'] != '') {
                        # adicionar comentário com descritivo da competência
                        $objPHPExcel->getActiveSheet()->getComment('B'.$lin)->getText()->createTextRun($row['DESC_COMPETENCIA']);
                }
                $id_comp = $row['ID_COMPETENCIA'];
            }

            # Mostra comportamentos
            $lin += 1;
            $nr_ctmento += 1;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $lin, $nr_ctencia.'.'.$nr_ctmento.' '.$row['DSP_COMPORTAMENTO']);
            $objPHPExcel->getActiveSheet()->mergeCells('B'.$lin.':C'.$lin);

            # Valores dos comportamentos
            $nv_ = $row['ID_NV_AF']; # valor do comportamento
            $obs_ = $row['COMENTARIO']; # comentário associado.

            if ($concordancia == 'S') { # homologação de resultados
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $lin, $row['COMENTARIO']);
                    $objPHPExcel->getActiveSheet()->mergeCells('D'.$lin.':E'.$lin);
            }
            else { # visualiza resultados
                if (count($escalas) == 1 && $escala_unica) { # uma só escala, coloca a escala na vertical

                    $xx = 0;
                    $objPHPExcel->getActiveSheet()->getStyle('C'.$lin.':'.excel_col($col_fim).$lin)->getFont()->setBold(true);
                    $objPHPExcel->getActiveSheet()->getStyle('C'.$lin.':'.excel_col($col_fim).$lin)->
                            getAlignment()->applyFromArray(
                                    array(
                                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                        'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                                        'rotation'   => 0,
                                        'wrap'       => true
                                    )
                            );
                    foreach($nv_escala as $value) {

                        if ($nv_ == $value['ID_NV_ESCALA'])
                                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3+$xx, $lin, "X");

                        # nivel requeriod
                        if ($row['ID_NV_ESCALA_REQ'] == $value['ID_NV_ESCALA']) {
                            $objPHPExcel->getActiveSheet()->getStyle(excel_col(4+$xx).$lin.':'.excel_col(4+$xx).$lin)->getFill()->applyFromArray(
                                            array(
                                                'type'       => PHPExcel_Style_Fill::FILL_SOLID,
                                                'rotation'   => 0,
                                                'startcolor' => array(
                                                    'rgb' => 'DAEEF3'
                                                ),
                                                'endcolor'   => array(
                                                    'rgb' => 'DAEEF3'
                                                )
                                            )
                            );
                            $objPHPExcel->getActiveSheet()->getComment(excel_col(4+$xx).$lin)->getText()->createTextRun($ui_level_req);
                        }
                        $xx += 1;
                    }

                }
                else {
                        $objPHPExcel->getActiveSheet()->mergeCells('D'.$lin.':'.excel_col($col_fim).$lin);
                        $dsp = dsp_nivel_escala($empresa_, $row['ID_EP'] , $row['DT_INI_EP'], $nv_, $msg);
                        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $lin, $dsp);
                }
            }

            if ($homologacao == 'S') { # homologação de resultados
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $lin, $row['COMENTARIO']);
            }
        }
    }
    catch (Exception $ex) {
        echo "avaliacao competencias#1 :" . $ex->getMessage();
    }

    $lin += 1;

    # alinhamenos
    $objPHPExcel->getActiveSheet()->getStyle('D10'.':E'.$lin)->
            getAlignment()->applyFromArray(
                    array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                        'rotation'   => 0,
                        'wrap'       => true
                    )
            );

    # bordos
    $objPHPExcel->getActiveSheet()->getStyle('B10'.':C'.$lin)->applyFromArray($border_style);
    $objPHPExcel->getActiveSheet()->getStyle('D10'.':E'.$lin)->applyFromArray($border_style);

} # existem competências

#
#	OBJECTIVOS
#
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

    #
    # Cabeçalho das competências
    #

    $lin += 2;
    $lin_obj = $lin;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $lin, mb_strtoupper($ui_objectives,"UTF-8"));

    if ($concordancia == 'S')
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $lin, mb_strtoupper($ui_comments,"UTF-8"));
    else
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $lin, mb_strtoupper($ui_eval,"UTF-8"));

    $objPHPExcel->getActiveSheet()->getStyle('B'.$lin.':'.excel_col($col_fim).$lin)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$lin.':'.excel_col($col_fim).$lin)->getFill()->applyFromArray(
                    array(
                        'type'       => PHPExcel_Style_Fill::FILL_SOLID,
                        'rotation'   => 0,
                        'startcolor' => array(
                            'rgb' => 'DAEEF3'
                        ),
                        'endcolor'   => array(
                            'rgb' => 'DAEEF3'
                        )
                    )
    );

    $objPHPExcel->getActiveSheet()->getStyle('D'.$lin.':'.excel_col($col_fim).$lin)->
            getAlignment()->applyFromArray(
                    array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                        'rotation'   => 0,
                        'wrap'       => true
                    )
            );

    $objPHPExcel->getActiveSheet()->getStyle('B'.$lin.':C'.$lin)->applyFromArray($border_style);
    $objPHPExcel->getActiveSheet()->getStyle('D'.$lin.':'.excel_col($col_fim).$lin)->applyFromArray($border_style);

    $objPHPExcel->getActiveSheet()->mergeCells('B'.$lin.':C'.$lin);
    $objPHPExcel->getActiveSheet()->mergeCells('D'.$lin.':'.excel_col($col_fim).$lin);

    $existe = false;
    try {
        while ($row = $avaliacao_objetivos->fetch(PDO::FETCH_ASSOC)) {

            if (!$existe) {
                $lin += 2;
                $existe = true;
            } else
                $lin += 1;

            $nr_obj += 1;

            # Designação do objectivo
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $lin, trata_euro($nr_obj.'. '.$row['DSP_OBJECTIVO']));
            $objPHPExcel->getActiveSheet()->mergeCells('B'.$lin.':C'.$lin);

            if ($row['DESC_OBJECTIVO'] != '') {
                    # adicionar comentário com descritivo da competência
                    $objPHPExcel->getActiveSheet()->getComment('B'.$lin)->getText()->createTextRun($row['DESC_OBJECTIVO']);
            }


            # valor do objectivo
            $nv_ = $row['VLR_ATRIBUIDO'];

            if ($concordancia == 'S') { # homologação de resultados
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $lin, $row['COMENT_AVALIADO']);
            } else { # recolha de resultados
                $objPHPExcel->getActiveSheet()->mergeCells('D'.$lin.':'.excel_col($col_fim).$lin);
                $objPHPExcel->getActiveSheet()->getStyle('D'.$lin.':'.excel_col($col_fim).$lin)->
                    getAlignment()->applyFromArray(
                            array(
                                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                                'rotation'   => 0,
                                'wrap'       => true
                            )
                    );

                if ($row['ID_EP'] != '' && $row['DT_INI_EP'] != '') {
                    $dsp = dsp_nivel_escala($empresa_, $row['ID_EP'] , $row['DT_INI_EP'], $nv_, $msg);
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $lin,
                                    $dsp." ".
                                    trata_euro(dsp_magnitude($empresa_, $row['ID_MAGNITUDE'], $row['DT_INI_DM'], $msg)));
                } else {
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $lin,
                                    $nv_." ".
                                    trata_euro(dsp_magnitude($empresa, $row['ID_MAGNITUDE'], $row['DT_INI_DM'], $msg)));
                }
            }

        }

    } catch (Exception $ex) {
        echo "avaliacao objectivos#1 :" . $ex->getMessage();
    }

    $lin += 1;

    # alinhamentos
    $objPHPExcel->getActiveSheet()->getStyle('D'.$lin_obj.':E'.$lin)->
            getAlignment()->applyFromArray(
                    array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                        'rotation'   => 0,
                        'wrap'       => true
                    )
            );

    # bordos
    $objPHPExcel->getActiveSheet()->getStyle('B'.$lin_obj.':C'.$lin)->applyFromArray($border_style);
    $objPHPExcel->getActiveSheet()->getStyle('D'.$lin_obj.':E'.$lin)->applyFromArray($border_style);

}; # existem objectivos


#
# comentários gerais
#

# Cabeçalho
$lin += 2;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $lin, mb_strtoupper($ui_comment_general,"UTF-8"));

# bold
$objPHPExcel->getActiveSheet()->getStyle('B'.$lin.':'.excel_col($col_fim).$lin)->getFont()->setBold(true);

# fundo
$objPHPExcel->getActiveSheet()->getStyle('B'.$lin.':'.excel_col($col_fim).$lin)->getFill()->applyFromArray(
        array(
            'type'       => PHPExcel_Style_Fill::FILL_SOLID,
            'rotation'   => 0,
            'startcolor' => array(
                'rgb' => 'DAEEF3'
            ),
            'endcolor'   => array(
                'rgb' => 'DAEEF3'
            )
        )
);

$objPHPExcel->getActiveSheet()->mergeCells('B'.$lin.':'.excel_col($col_fim).$lin);

# bordos
$objPHPExcel->getActiveSheet()->getStyle('B'.$lin.':'.excel_col($col_fim).$lin)->applyFromArray($border_style);
# alinhamento
$objPHPExcel->getActiveSheet()->getStyle('B'.$lin.':'.excel_col($col_fim).$lin)->
        getAlignment()->applyFromArray(
                array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                    'vertical'   => PHPExcel_Style_Alignment::VERTICAL_TOP,
                    'rotation'   => 0,
                    'wrap'       => true
                )
        );

# DADOS
$lin += 1;

$objPHPExcel->getActiveSheet()->mergeCells('B'.$lin.':'.excel_col($col_fim).($lin+3));

# bordos
$objPHPExcel->getActiveSheet()->getStyle('B'.$lin.':'.excel_col($col_fim).($lin+3))->applyFromArray($border_style);
# alinhamento
$objPHPExcel->getActiveSheet()->getStyle('B'.$lin.':'.excel_col($col_fim).($lin+3))->
        getAlignment()->applyFromArray(
                array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                    'vertical'   => PHPExcel_Style_Alignment::VERTICAL_TOP,
                    'rotation'   => 0,
                    'wrap'       => true
                )
        );

# escrever observações
$objPHPExcel->getActiveSheet()->getStyle('B'.$lin.':'.excel_col($col_fim).($lin+3))->getFont()->setSize(9);
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $lin, $obs_ficha);


### redimensionamento da largura das colunas
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(4);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(16);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(64);

if ($col_fim == 5) {
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(16);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
} else {
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
}


$objPHPExcel->setActiveSheetIndex(0);


#
# escrita física do ficheiro
#
#$root_dir = get_dir_path('root_dir', $msg);
#$tmp_dir = get_dir_path('temp_export_dir', $msg);

$root_dir = str_replace("/data-source/ad_excel_ficha_aval.php","",__FILE__);
$root_dir = str_replace("\data-source\ad_excel_ficha_aval.php","",$root_dir);
$tmp_dir = "/tmp";

$ficheiro = str_replace("//","/",$tmp_dir."/$f.xls");
$ficheiro = str_replace("\\\\","\\",$tmp_dir."\\$f.xls");
$file = str_replace("//","/",$root_dir.$ficheiro);

echo "[$file]";

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
#$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
$objWriter->setPreCalculateFormulas(false);
$objWriter->save($file);

$objPHPExcel->disconnectWorksheets();
unset($objPHPExcel);


# retirar a 1ª barra / para permitir endereçamento relativo
$ficheiro = substr($ficheiro,1);
echo  $ficheiro;
?>

