<?php
/*
 *  @autor      Pedro Estácio <pedro.estacio@quad-systems.com>
 *  @projeto    QUAD-HCM
 *  @versão     1.0
 *  @revisão    2018.06.08
 *  @copyright  (c) 2018 QuadSystems - http://www.quad-systems.com
 *  @nome     	gd_lib_controller.php
 *  @descrição  Livraria de funções de suporte ao módulo de gestão documental
 *
 */
    #
    ## funções para tratamento de valores
    #
    function diferente($a, $b) {
        $res = 'N';
        if ($a == '' && $b == '') {
            $res = 'N';
        } elseif (($a == '' && $b != '') || ($a != '' && $b == '')) {
            $res = 'S';
        } elseif ($a != $b) {
            $res = 'S';
        }
        return $res;
    }

    function limpa_carateres($in) {

        $txt = $in;

        # remove espaços no final
        $txt = trim($txt);

        # remove CR e NL
        $txt = str_replace(chr(10), "", $txt);
        $txt = str_replace(chr(13), "", $txt);

        return $txt;
    }

    function unidades($numero) {
        $dsp_ = '';
        if ($numero == 1) {
            $dsp_ = 'um';
        } elseif ($numero == 2) {
            $dsp_ = 'dois';
        } elseif ($numero == 3) {
            $dsp_ = 'três';
        } elseif ($numero == 4) {
            $dsp_ = 'quatro';
        } elseif ($numero == 5) {
            $dsp_ = 'cinco';
        } elseif ($numero == 6) {
            $dsp_ = 'seis';
        } elseif ($numero == 7) {
            $dsp_ = 'sete';
        } elseif ($numero == 8) {
            $dsp_ = 'oito';
        } elseif ($numero == 9) {
            $dsp_ = 'nove';
        }
        return $dsp_;
    }

    function dezenas($numero) {
        $dsp_ = '';
        if ($numero == 1) {
            $dsp_ = 'dez';
        } elseif ($numero == 2) {
            $dsp_ = 'vinte';
        } elseif ($numero == 3) {
            $dsp_ = 'trinta';
        } elseif ($numero == 4) {
            $dsp_ = 'quarenta';
        } elseif ($numero == 5) {
            $dsp_ = 'cinquenta';
        } elseif ($numero == 6) {
            $dsp_ = 'sessenta';
        } elseif ($numero == 7) {
            $dsp_ = 'setenta';
        } elseif ($numero == 8) {
            $dsp_ = 'oitenta';
        } elseif ($numero == 9) {
            $dsp_ = 'noventa';
        }
        return $dsp_;
    }

    function extenso_centenas ($numero) {
        $ext = '';           # Resultado da composicao da quantia
        $casa_cent = '';     # algarismo das centenas
        $casa_dezena = '';   # algarismo das dezenas
        $casa_unidade = '';  # algarismo das unidades
        $mod_dezena = '';

	$casa_cent = floor($numero / 100);
	$casa_dezena = floor(($numero %100)/10);
	$casa_unidade = (($numero % 100) %10);
	$mod_dezena = ($numero % 100);

	# trata das centenas
	if ($casa_cent != 0) {
            if ($numero == 100) {
		$ext = 'cem';
            } elseif ($casa_cent == 1) {
		$ext = 'cento';
            } elseif ($casa_cent == 2) {
		$ext = 'duzentos';
            } elseif ($casa_cent == 3) {
		$ext = 'trezentos';
            } elseif ($casa_cent == 4) {
		$ext = 'quatrocentos';
            } elseif ($casa_cent == 5) {
		$ext = 'quinhentos';
            } elseif ($casa_cent == 6) {
            	$ext = 'seiscentos';
            } elseif ($casa_cent == 7) {
            	$ext = 'setecentos';
            } elseif ($casa_cent == 8) {
		$ext = 'oitocentos';
            } elseif ($casa_cent == 9) {
		$ext = 'novecentos';
            }

            if ($casa_dezena != 0 OR
                casa_unidade != 0) {
                $ext = $ext . ' e ';
            }
        }

        # trata das dezenas
        if ($casa_dezena != 0) {
            if ($casa_dezena == 1) {
                if ($mod_dezena == 10) {
                        $ext = $ext . 'dez';
                } elseif ($mod_dezena == 11) {
                        $ext = $ext . 'onze';
                } elseif ($mod_dezena == 12) {
                        $ext = $ext . 'doze';
                } elseif ($mod_dezena == 13) {
                        $ext = $ext . 'treze';
                } elseif ($mod_dezena == 14) {
                        $ext = $ext . 'quatorze';
                } elseif ($mod_dezena == 15) {
                        $ext = $ext . 'quinze';
                } elseif ($mod_dezena == 16) {
                        $ext = $ext . 'dezasseis';
                } elseif ($mod_dezena == 17) {
                        $ext = $ext . 'dezassete';
                } elseif ($mod_dezena == 18) {
                        $ext = $ext . 'dezoito';
                } elseif ($mod_dezena == 19) {
                        $ext = $ext . 'dezanove';
                }
            } elseif ($casa_dezena == 2) {
                    $ext = $ext . 'vinte';
            } elseif ($casa_dezena == 3) {
                    $ext = $ext . 'trinta';
            } elseif ($casa_dezena == 4) {
                    $ext = $ext . 'quarenta';
            } elseif ($casa_dezena == 5) {
                    $ext = $ext . 'cinquenta';
            } elseif ($casa_dezena == 6) {
                    $ext = $ext . 'sessenta';
            } elseif ($casa_dezena == 7) {
                    $ext = $ext . 'setenta';
            } elseif ($casa_dezena == 8) {
                    $ext = $ext . 'oitenta';
            } elseif ($casa_dezena == 9) {
                    $ext = $ext . 'noventa';
            }
            if ($casa_unidade != 0 && $casa_dezena != 1) {
                $ext = $ext . ' e ';
            }
        }
        # trata das unidades
        if ($mod_dezena != 0 && $casa_dezena != 1) {
            $ext = $ext . unidades($numero % 10);
        }
        return $ext;
    }

    function extenso_milhares ($numero) {
        $pos = "";
        $dsp_ = "";

        $pos = strlen(strval($numero));
        if ($pos <= 3) { # centenas
                $dsp_ = extenso_centenas(strval(Numero));
        } elseif ($pos > 3 && $pos <= 6) { # milhares
                if (floor($numero/1000) == 1) { # 1XXX
                    if (($numero % 1000) == 0) {  # 1000
                        $dsp_ = 'mil';
                    } elseif ((($numero % 1000) <= 100 || ($numero % 100) == 0)) { # 10XX ou 1X00
                        $dsp_ = 'mil e ' . extenso_Centenas(($numero % 1000));
                    } elseif (($numero % 1000) > 100)  { #  maior 1100 .. 1999
                        $dsp_ = 'mil ' . extenso_Centenas(($numero % 1000));
                    }
                } else { #  maior 1999
                    if (($numero % 1000) == 0) { # X000
                       $dsp_ = extenso_centenas(floor($numero/1000)) . ' mil';
                    } elseif (($numero % 1000) <= 100 || ($numero % 100) == 0) { # X0XX ou XX00
                       $dsp_ = extenso_centenas(floor($numero/1000)) . ' mil e ' .
                               extenso_centenas(($numero % 1000));
                    } elseif (($numero % 1000) > 100) { # maior X100 .. X999
                       $dsp_ = (extenso_centenas(floor($numero/1000))||' mil '||
                                extenso_centenas(MOD(Numero,1000)));
                    };
                }
        } else {
            $dsp_ = '';
        }
        return $dsp_;
    }

    # Função de devolve o leitura por extenso de um número inteiro
    function extenso ($num) {
        $pos = '';
        $pos1 = '';
        $numero = '';
        $dsp_ = '';

        $numero = round($num);
        $pos = strlen(strval($numero));

        if ($pos <= 3) { # centenas
            $dsp_ = extenso_centenas($numero);
        } elseif ($pos > 3 && $pos <=6) {  # milhares
            $dsp_ = extenso_milhares($numero);
        } elseif ($pos >6 && $pos <=9) { # milhões
            if (floor($numero/1000000) == 1) { # 1XXXXXX
                IF (($numero % 1000000) == 0) { # 1000000
                    $dsp_ = 'um milhão';
                } elseif ( ($numero % 1000000) <= 100000 || ($numero & 100000) == 0) {
                    $dsp_ = 'um milhão e ' . extenso_milhares(($numero % 1000000));
                } else {
                    $dsp_ = 'um milhão ' . extenso_milhares(($numero % 1000000));
                }
            } else { #  maior 1999999
                if (($numero % 1000000) == 0) { # X000
                        $dsp_ = (extenso_centenas(FLOOR(Numero/1000000))||' milhões');
                } elseif ( ($numero % 1000000) <= 100000 || ($numero % 100000) == 0 ) {
                        $dsp_ = (extenso_centenas(floor($numero/1000000))||' milhões e '||
                                 extenso_milhares($numero % 1000000));
                } elseif ( ($numero % 1000000) > 100000) {
                        $dsp_ = (extenso_centenas(FLOOR(Numero/1000000))||' milhões '||
                                 extenso_milhares(MOD(Numero,1000000)));
                }
            }
        } else {
           $dsp_ = '';
        }
        return $dsp_;
    }

    # Função de devolve o leitura por extenso de um número em euros (euros e cêntimos)
    function numero_extenso($valor_) {
        $p_inteira = round($valor_);
        $p_decimal = round(($valor_ - round($valor_))*100);

        $extenso_ =  trim(extenso($p_inteira)). ' euros';
        if ($p_decimal > 0) {
                $extenso_ .= ' e ' . trim(extenso($p_decimal)) . ' cêntimos';
        }
        $extenso_ = strtolower($extenso_);
        $extenso_ = strtoupper(substr($extenso_,0,1)) . substr($extenso_,1);

        return $extenso_;
    }

    # Função de devolve a designação do mês
    function mes_extenso($valor_) {

        if ($valor_ == '01' || $valor_ == '1') {
            $extenso_ = 'Janeiro';
        } elseif ($valor_ == '02' || $valor_ == '1') {
            $extenso_ = 'Fevereiro';
        } elseif ($valor_ == '03' || $valor_ == '1') {
            $extenso_ = 'Março';
        } elseif ($valor_ == '04' || $valor_ == '1') {
            $extenso_ = 'Abril';
        } elseif ($valor_ == '05' || $valor_ == '1') {
            $extenso_ = 'Maio';
        } elseif ($valor_ == '06' || $valor_ == '1') {
            $extenso_ = 'Junho';
        } elseif ($valor_ == '07' || $valor_ == '1') {
            $extenso_ = 'Julho';
        } elseif ($valor_ == '08' || $valor_ == '1') {
            $extenso_ = 'Agosto';
        } elseif ($valor_ == '09' || $valor_ == '1') {
            $extenso_ = 'Setembro';
        } elseif ($valor_ == '10') {
            $extenso_ = 'Outubro';
        } elseif ($valor_ == '11') {
            $extenso_ = 'Novembro';
        } elseif ($valor_ == '12') {
            $extenso_ = 'Dezembro';
        }
        return $extenso_;
    }

    # Função que descodifica domínio
    function dsp_dominio ($dominio, $valor, &$msg) {
        global $db;
        $cd_lang = decode_lang();
        $msg = '';

  	$sql = "SELECT a.RV_DOMAIN, a.RV_LOW_VALUE, IFNULL(b.DSP_TRAD, a.RV_MEANING) RV_MEANING, IFNULL(b.DSR_TRAD, a.RV_ABBREVIATION) RV_ABBREVIATION  ".
               "FROM CG_REF_CODES a ".
               "LEFT JOIN CG_REF_CODES_TRADS b ON a.RV_DOMAIN = b.RV_DOMAIN AND a.RV_LOW_VALUE = b.RV_LOW_VALUE ".
               "  AND b.CD_LINGUA = :cd_lang ".
               "WHERE a.RV_DOMAIN = :dominio ".
               "  AND a.RV_LOW_VALUE = :valor ";
        try {
    //echo $sql.' DOMINIO:' . $dominio. ' LANG:' . $cd_lang . ' Mode:' . $mode;
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':dominio', $dominio);
            $stmt->bindParam(':cd_lang', $cd_lang);
            $stmt->bindParam(':valor', $valor);

            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            return $row['RV_MEANING'];

        } catch (Exception $e) {
            $msg = "Error FETCHING on dsp_dominio: " . $e->getMessage();
        }

        return "";
    }

    #
    # Classe para converter documentos docx,xlsx,pptx para texto, de forma a permitir uma fácil pesquisa de conteúdos
    #
    class DocxConversion {

        private $filename;

        public function __construct($filePath) {
            $this->filename = $filePath;
        }

        private function read_doc() {
            $fileHandle = fopen($this->filename, "r");
            $line = @fread($fileHandle, filesize($this->filename));
            $lines = explode(chr(0x0D), $line);
            $outtext = "";
            foreach ($lines as $thisline) {
                $pos = strpos($thisline, chr(0x00));
                if (($pos != FALSE) || (strlen($thisline) == 0)) {

                } else {
                    $outtext .= $thisline . " ";
                }
            }
            $outtext = preg_replace("/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/", "", $outtext);
            fclose($fileHandle);
            return $outtext;
        }

        private function read_docx() {

            $striped_content = '';
            $content = '';

            $zip = zip_open($this->filename);

            if (!$zip || is_numeric($zip))
                return false;

            while ($zip_entry = zip_read($zip)) {

                if (zip_entry_open($zip, $zip_entry) == FALSE)
                    continue;

                if (zip_entry_name($zip_entry) != "word/document.xml")
                    continue;

                $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));

                zip_entry_close($zip_entry);
            }// end while

            zip_close($zip);

            $content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
            $content = str_replace('</w:r></w:p>', "\r\n", $content);
            $striped_content = strip_tags($content);

            return $striped_content;
        }

        /*         * **********************excel sheet*********************************** */

        function xlsx_to_text($input_file) {
            $xml_filename = "xl/sharedStrings.xml"; //content file name
            $zip_handle = new ZipArchive;
            $output_text = "";
            if (true == $zip_handle->open($input_file)) {
                if (($xml_index = $zip_handle->locateName($xml_filename)) != false) {
                    $xml_datas = $zip_handle->getFromIndex($xml_index);
                    $xml_handle = DOMDocument::loadXML($xml_datas, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
                    $output_text = strip_tags($xml_handle->saveXML());
                } else {
                    $output_text .= "";
                }
                $zip_handle->close();
            } else {
                $output_text .= "";
            }
            return $output_text;
        }

        /*         * ***********************power point files**************************** */

        function pptx_to_text($input_file) {
            $zip_handle = new ZipArchive;
            $output_text = "";
            if (true == $zip_handle->open($input_file)) {
                $slide_number = 1; //loop through slide files
                while (($xml_index = $zip_handle->locateName("ppt/slides/slide" . $slide_number . ".xml")) != false) {
                    $xml_datas = $zip_handle->getFromIndex($xml_index);
                    $xml_handle = DOMDocument::loadXML($xml_datas, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
                    $output_text .= strip_tags($xml_handle->saveXML());
                    $slide_number++;
                }
                if ($slide_number == 1) {
                    $output_text .= "";
                }
                $zip_handle->close();
            } else {
                $output_text .= "";
            }
            return $output_text;
        }

        public function convertToText() {

            if (isset($this->filename) && !file_exists($this->filename)) {
                return "File Not exists";
            }

            $fileArray = pathinfo($this->filename);
            $file_ext = $fileArray['extension'];
            if ($file_ext == "doc" || $file_ext == "docx" || $file_ext == "xlsx" || $file_ext == "pptx") {
                if ($file_ext == "doc") {
                    return $this->read_doc();
                } elseif ($file_ext == "docx") {
                    return $this->read_docx();
                } elseif ($file_ext == "xlsx") {
                    return $this->xlsx_to_text();
                } elseif ($file_ext == "pptx") {
                    return $this->pptx_to_text();
                }
            } else {
                return "Invalid File Type";
            }
        }

    }


    ##
    ## GESTÃO DOCUMENTAL
    ##


    #
    # Lista tipos de documento
    function list_DG_GESTAO_DOCUMENTAL ($cd, $dt, $graf, $mode, &$msg) {

        global $db;
        $msg = '';
        $result = [];

        $sql = "SELECT a.CD_GD, a.DT_INI_GD, a.DSP ".
               "FROM DG_GESTAO_DOCUMENTAL a  ".
               "WHERE a.DT_FIM IS NULL ";

        if (strtoupper($mode) == 'ONE') {
            $sql .= " AND a.CD_GD = :CD_GD_ ".
                    " AND a.DT_INI_GD = :DT_INI_GD_ ";
        }

        if ($graf != '') {
            $sql .= " AND a.GRAFICOS = :GRAFICOS_ ";
        }

        $sql .= "ORDER BY a.DSP ";

        try {
            $stmt = $db->prepare($sql);
            if (strtoupper($mode) == 'ONE') {
                $stmt->bindParam(':CD_GD', $cd, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_GD', $dt, PDO::PARAM_STR);
            }
            if ($graf != '') {
                $stmt->bindParam(':GRAFICOS_', $graf, PDO::PARAM_STR);
            }
            $stmt->execute();
        } catch (PDOException $ex) {
            $msg = "list_DG_GESTAO_DOCUMENTAL#1 :" . $ex->getMessage();
        }

        if ($msg == '') {
            try {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    array_push($result, $row);
                }
            } catch (Exception $ex) {
                $msg = "list_DG_GESTAO_DOCUMENTAL#2 :" . $ex->getMessage();
            }
        }

        return $result;
    }

    #
    # Lista modelos de documentos
    function list_DG_DET_GESTAO_DOCUMENTAL($cd_gd, $dt_gd, $cd_det_gd, $dt_det_gd, $mode, &$msg) {

        global $db;
        $msg = '';
        $result = array();

        $sql = "SELECT * ".
               "FROM DG_DET_GESTAO_DOCUMENTAL ".
               "WHERE CD_GD = :CD_GD_ ".
               "  AND DT_INI_GD = :DT_INI_GD_ ".
               "  AND DT_FIM IS NULL ";

        if (strtoupper($mode) == 'ONE'){
            $sql .= "  AND CD_DET_GD = :CD_DET_GD_ ".
                    "  AND DT_INI_DET_GD = :DT_INI_DET_GD_ ";
        }

        $sql .= "ORDER BY CD_DET_GD ";

        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':CD_GD_', $cd_gd, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_GD_', $dt_gd, PDO::PARAM_STR);
            if (strtoupper($mode) == 'ONE'){
                $stmt->bindParam(':CD_DET_GD_', $cd_det_gd, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_DET_GD_', $dt_det_gd, PDO::PARAM_STR);
            }
            $stmt->execute();
        } catch (Exception $ex) {
            $msg = "list_DG_DET_GESTAO_DOCUMENTAL#1 :" . $ex->getMessage();
        }
        if ($msg == '') {
            try {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    array_push($result, $row);
                }
            } catch (Exception $ex) {
                $msg = "list_DG_DET_GESTAO_DOCUMENTAL#2 :" . $ex->getMessage();
            }
        }

        return $result;

    }


    ##
    ## PARAMETRIZAÇÃO
    ##

    #
    # Cria todas as variáveis definidas num template de documento (DG_DET_GESTAO_DOCUMENTAL)
    # VARIÁVEIS GENÉRICAS -> DETALHE DE TEMPLATE
    #
    function gd_cria_variaveis($cd_gd_, $dt_ini_gd_, $cd_det_gd_, $dt_ini_det_gd_, &$msg) {

        global $db;

        try {
            $stmt = $db->query("SELECT COD_VAR, DT_INI_VAR, LABEL, DESCRICAO, DT_FIM, TIPO, DOMAIN_REF, TABLE_COLUMN_REF, FUNCTION_REF, QUAD_SQL_REF " .
                               "FROM DG_DEF_VARIAVEIS");
        } catch (PDOException $ex) {
            $msg = "erro#1 :" . $ex->getMessage();
        }

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
#echo "[COD_VAR:".$row['COD_VAR']." label:".$row['LABEL']." descricao:".$row['DESCRICAO']." sql:".limpa_carateres($row['QUAD_SQL_REF'])."]</br>";
            try {
                $stmt2 = $db->prepare("INSERT INTO DG_GD_VARIAVEIS " .
                                      "(CD_GD, DT_INI_GD, CD_DET_GD, DT_INI_DET_GD, COD_VAR, DT_INI_VAR, DT_INI_FRM, VISUALIZA) " . #,DT_FIM)".
                                      "VALUES(:CD_GD_,:DT_INI_GD_,:CD_DET_GD_,:DT_INI_DET_GD_,:COD_VAR_,:DT_INI_VAR_,SYSDATE(),:VISUALIZA_)");  #,:DT_FIM_)");

                $visualiza_ = 'S';
                $stmt2->bindParam(':CD_GD_', $cd_gd_, PDO::PARAM_STR);
                $stmt2->bindParam(':DT_INI_GD_', $dt_ini_gd_, PDO::PARAM_STR);
                $stmt2->bindParam(':CD_DET_GD_', $cd_det_gd_, PDO::PARAM_STR);
                $stmt2->bindParam(':DT_INI_DET_GD_', $dt_ini_det_gd_, PDO::PARAM_STR);
                $stmt2->bindParam(':COD_VAR_', $row['COD_VAR'], PDO::PARAM_STR);
                $stmt2->bindParam(':DT_INI_VAR_', $row['DT_INI_VAR'], PDO::PARAM_STR);
                $stmt2->bindParam(':VISUALIZA_', $visualiza_, PDO::PARAM_STR);
                $stmt2->execute();
            } catch (PDOException $ex) {
                $msg = "erro#2:" . $ex->getMessage();
            }
        }
    }

    #
    # Cria as fases básicas para gestão documental (Elaboração, Aprovado, Rejeitado)
    # VARIÁVEIS GENÉRICAS -> DETALHE DE TEMPLATE
    #
    function gd_cria_fases($cd_gd_, $dt_ini_gd_, $cd_det_gd_, $dt_ini_det_gd_, &$msg) {

        global $db;

        try {
            $stmt = $db->query("SELECT RV_LOW_VALUE  ".
                               "FROM CG_REF_CODES ".
                               "WHERE RV_LOW_VALUE IN ('A','O','P') ".
                               "ORDER BY 1 ");
        } catch (PDOException $ex) {
            $msg = "gd_cria_fases#1 :" . $ex->getMessage();
        }

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
#echo "[COD_VAR:".$row['COD_VAR']." label:".$row['LABEL']." descricao:".$row['DESCRICAO']." sql:".limpa_carateres($row['QUAD_SQL_REF'])."]</br>";
            try {
                $stmt2 = $db->prepare("INSERT INTO DG_GD_FASES " .
                                      "(CD_GD, DT_INI_GD, CD_DET_GD, DT_INI_DET_GD, DT_INI, TIPO) " . #,DT_FIM)".
                                      "VALUES(:CD_GD_,:DT_INI_GD_,:CD_DET_GD_,:DT_INI_DET_GD_,:DT_INI_,:TIPO_)");  #,:DT_FIM_)");

                $dt_x = '1900-01-01';

                $stmt2->bindParam(':CD_GD_', $cd_gd_, PDO::PARAM_STR);
                $stmt2->bindParam(':DT_INI_GD_', $dt_ini_gd_, PDO::PARAM_STR);
                $stmt2->bindParam(':CD_DET_GD_', $cd_det_gd_, PDO::PARAM_STR);
                $stmt2->bindParam(':DT_INI_DET_GD_', $dt_ini_det_gd_, PDO::PARAM_STR);
                $stmt2->bindParam(':DT_INI_', $dt_x, PDO::PARAM_STR);
                $stmt2->bindParam(':TIPO_', $row['TIPO'], PDO::PARAM_STR);
                $stmt2->execute();
            } catch (PDOException $ex) {
                $msg = "gd_cria_fases#2:" . $ex->getMessage();
            }
        }
    }

    #
    # Cria registo de template de documento
    function gd_cria_template_doc($cd_gd_, $dt_ini_gd_, $cd_det_gd_, $dt_ini_det_gd_, $destino, $ficheiro, $dsp, &$msg) {

        global $db;
        $msg = '';
        $blob_ = '';
        $ficheiro_ = '';
        $dsp_ = $dsp;
        if ($ficheiro != '') {

            $mime_ = pathinfo($ficheiro,PATHINFO_EXTENSION);

            ## carregar blob para inserir na base de dados
            if ($destino == 'BD') {
                $blob_ = fopen($ficheiro, 'rb');
            } else {
                $ficheiro_ = $ficheiro;
            }
            try {
                $stmt2 = $db->prepare("INSERT INTO DG_GD_TEMPLATES " .
                                      "(CD_GD, DT_INI_GD, CD_DET_GD, DT_INI_DET_GD, CD_TEMPLATE, DT_INI, DSP, BD_DOC, BD_MIME, LINK_DOC) " . #,DT_FIM)".
                                      "VALUES(:CD_GD_,:DT_INI_GD_,:CD_DET_GD_,:DT_INI_DET_GD_,0, SYSDATE(),:DSP_, :BD_DOC_, :BD_MIME_, :LINK_DOC_)");  #,:DT_FIM_)");

                $stmt2->bindParam(':CD_GD_', $cd_gd_, PDO::PARAM_STR);
                $stmt2->bindParam(':DT_INI_GD_', $dt_ini_gd_, PDO::PARAM_STR);
                $stmt2->bindParam(':CD_DET_GD_', $cd_det_gd_, PDO::PARAM_STR);
                $stmt2->bindParam(':DT_INI_DET_GD_', $dt_ini_det_gd_, PDO::PARAM_STR);
                $stmt2->bindParam(':DSP_', $dsp_, PDO::PARAM_STR);

                if ($blob_ == '') {
                    $stmt2->bindParam(':BD_DOC_', $null = null, PDO::PARAM_LOB);
                } else {
                    $stmt2->bindParam(':BD_DOC_', $blob_, PDO::PARAM_LOB);
                }

                $stmt2->bindParam(':BD_MIME_', $mime_, PDO::PARAM_STR);
                if ($ficheiro_ == '')
                    $stmt2->bindParam(':LINK_DOC_', $null = null, PDO::PARAM_STR);
                else
                    $stmt2->bindParam(':LINK_DOC_', $ficheiro_, PDO::PARAM_STR);

                $stmt2->execute();
            } catch (PDOException $ex) {
                $msg = "erro#2:" . $ex->getMessage();
            }
        }
    }


    #
    # remove os registos associado ao detalhe de templates de gestão documental
    function gd_remove_det_template_gd($cd_gd_, $dt_ini_gd_, $cd_det_gd_, $dt_ini_det_gd_, &$msg) {
        $msg = '';
        global $db;

        # remover fundamentações associada a detalhes de template de gestão documental
        try {
            $stmt = $db->prepare("DELETE FROM DG_GD_FUNDAMENTACAO ".
                                 "WHERE CD_GD = :CD_GD_ AND DT_INI_GD = :DT_INI_GD_ ".
                                 "  AND CD_DET_GD = :CD_DET_GD_ AND DT_INI_DET_GD = :DT_INI_DET_GD_ ");

            $stmt->bindParam(':CD_GD_', $cd_gd_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_GD_', $dt_ini_gd_, PDO::PARAM_STR);
            $stmt->bindParam(':CD_DET_GD_', $cd_det_gd_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_DET_GD_', $dt_ini_det_gd_, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $ex) {
            $msg = "gd_remove_det_template_gd - erro#0 :" . $ex->getMessage();
        }

        # remover variáveis existentes
        if ($msg == '') {
            try {
                $stmt = $db->prepare("DELETE FROM DG_GD_VARIAVEIS ".
                                     "WHERE CD_GD = :CD_GD_ AND DT_INI_GD = :DT_INI_GD_ ".
                                     "  AND CD_DET_GD = :CD_DET_GD_ AND DT_INI_DET_GD = :DT_INI_DET_GD_ ");

                $stmt->bindParam(':CD_GD_', $cd_gd_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_GD_', $dt_ini_gd_, PDO::PARAM_STR);
                $stmt->bindParam(':CD_DET_GD_', $cd_det_gd_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_DET_GD_', $dt_ini_det_gd_, PDO::PARAM_STR);
                $stmt->execute();
            } catch (PDOException $ex) {
                $msg = "gd_remove_det_template_gd - erro#1 :" . $ex->getMessage();
            }
        }

        # remover fases existentes
        if ($msg == '') {
            try {
                $stmt = $db->prepare("DELETE FROM DG_GD_FASES ".
                                     "WHERE CD_GD = :CD_GD_ AND DT_INI_GD = :DT_INI_GD_ ".
                                     "  AND CD_DET_GD = :CD_DET_GD_ AND DT_INI_DET_GD = :DT_INI_DET_GD_ ");

                $stmt->bindParam(':CD_GD_', $cd_gd_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_GD_', $dt_ini_gd_, PDO::PARAM_STR);
                $stmt->bindParam(':CD_DET_GD_', $cd_det_gd_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_DET_GD_', $dt_ini_det_gd_, PDO::PARAM_STR);
                $stmt->execute();
            } catch (PDOException $ex) {
                $msg = "gd_remove_det_template_gd - erro#2 :" . $ex->getMessage();
            }
        }

        # remover documentos existentes
        if ($msg == '') {
            try {
                $stmt = $db->prepare("DELETE FROM DG_GD_TEMPLATES ".
                                     "WHERE CD_GD = :CD_GD_ AND DT_INI_GD = :DT_INI_GD_ ".
                                     "  AND CD_DET_GD = :CD_DET_GD_ AND DT_INI_DET_GD = :DT_INI_DET_GD_ ");

                $stmt->bindParam(':CD_GD_', $cd_gd_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_GD_', $dt_ini_gd_, PDO::PARAM_STR);
                $stmt->bindParam(':CD_DET_GD_', $cd_det_gd_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_DET_GD_', $dt_ini_det_gd_, PDO::PARAM_STR);
                $stmt->execute();
            } catch (PDOException $ex) {
                $msg = "gd_remove_det_template_gd - erro#3 :" . $ex->getMessage();
            }
        }

    }

    ##
    ## CONSTITUIÇÃO DE REGISTO DE GESTÃO DOCUMENTAL DE UM COLABORADOR
    ##

    #
    # VARIÁVEIS
    # Cria as variáveis de recolha para um documento ($id_proc_gd_)
    #
    # $id_proc_gd_ - código do registo de gestão documental
    # $acao_ - INSERT ou UPDATE
    #
    # classe gd_var identifica os elementos que deverão ser gravados na bd
    function gd_cria_id_det_gd_variaveis($id_proc_gd_, $acao_, &$msg) {

        global $db;
        global $ui_chose_option;

        # remover variáveis já existentes
        if ($acao_ == 'INSERT') {
            try {
                $stmt = $db->prepare("DELETE FROM RH_ID_GD_VARIAVEIS " .
                                     "WHERE ID_PROC_GD = :ID_PROC_GD_ ");
                $stmt->bindParam(':ID_PROC_GD_', $id_proc_gd_, PDO::PARAM_STR);
                $stmt->execute();
            } catch (PDOException $ex) {
                $msg = "gd_cria_id_det_gd_variaveis - erro#0 :" . $ex->getMessage();
            }
        }

        # criar variáveis a partir da definição do template de documento
        try {
            if ($acao_ == 'INSERT') {

                $stmt = $db->prepare("SELECT A.ID_PROC_GD, A.EMPRESA, A.RHID, A.DT_ADMISSAO, B.CD_GD, B.DT_INI_DET_GD, B.CD_DET_GD, B.DT_INI_GD, " .
                                     " B.COD_VAR, B.DT_INI_VAR, B.DT_INI_FRM, B.VISUALIZA , C.LABEL, C.TIPO, C.QUAD_SQL_REF, C.TIPO_DADOS, C.VALOR_MIN, C.VALOR_MAX, C.INCREMENTOS " .
                                     "FROM RH_ID_GESTAO_DOCUMENTAL A, DG_GD_VARIAVEIS B, DG_DEF_VARIAVEIS C " .
                                     "WHERE A.ID_PROC_GD = :ID_PROC_GD_ " .
                                     "  AND C.COD_VAR = B.COD_VAR " .
                                     "  AND C.DT_INI_VAR = B.DT_INI_VAR " .
                                     "  AND A.CD_GD = B.CD_GD " .
                                     "  AND A.DT_INI_GD = B.DT_INI_GD " .
                                     "  AND A.CD_DET_GD = B.CD_DET_GD " .
                                     "  AND A.DT_INI_DET_GD = B.DT_INI_DET_GD ".
                                     "  AND B.DT_FIM IS NULL ");

                $stmt->bindParam(':ID_PROC_GD_', $id_proc_gd_, PDO::PARAM_STR);
                $stmt->execute();

            } elseif ($acao_ == 'UPDATE') {

                $stmt = $db->prepare("SELECT A.ID_PROC_GD, A.EMPRESA, A.RHID, A.DT_ADMISSAO, B.CD_GD, B.DT_INI_DET_GD, B.CD_DET_GD, B.DT_INI_GD, " .
                                     " B.COD_VAR, B.DT_INI_VAR, B.DT_INI_FRM, B.VISUALIZA , C.LABEL, C.TIPO, C.QUAD_SQL_REF, C.TIPO_DADOS, C.VALOR_MIN, C.VALOR_MAX, C.INCREMENTOS " .
                                     "FROM RH_ID_GESTAO_DOCUMENTAL A, DG_GD_VARIAVEIS B, DG_DEF_VARIAVEIS C " .
                                     "WHERE A.ID_PROC_GD = :ID_PROC_GD_ " .
                                     "  AND C.COD_VAR = B.COD_VAR " .
                                     "  AND C.DT_INI_VAR = B.DT_INI_VAR " .
                                     "  AND A.CD_GD = B.CD_GD " .
                                     "  AND A.DT_INI_GD = B.DT_INI_GD " .
                                     "  AND A.CD_DET_GD = B.CD_DET_GD " .
                                     "  AND A.DT_INI_DET_GD = B.DT_INI_DET_GD ".
                                     "  AND B.DT_FIM IS NULL ".
                                     "  AND (B.CD_GD, B.DT_INI_DET_GD, B.CD_DET_GD, B.DT_INI_GD, B.COD_VAR, B.DT_INI_VAR, B.DT_INI_FRM) NOT IN ".
                                     "      (SELECT X.CD_GD, X.DT_INI_DET_GD, X.CD_DET_GD, X.DT_INI_GD, X.COD_VAR, X.DT_INI_VAR, X.DT_INI_FRM ".
                                     "       FROM RH_ID_GD_VARIAVEIS X ".
                                     "       WHERE X.ID_PROC_GD = :ID_PROC_GD_)");

                $stmt->bindParam(':ID_PROC_GD_', $id_proc_gd_, PDO::PARAM_STR);
                $stmt->execute();

            }

        } catch (PDOException $ex) {
            $msg = "gd_cria_id_det_gd_variaveis - erro#1 :" . $ex->getMessage();
        }

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            try {
                $html_content_ = '';
                $html_hint_ = '';

                ## variáveis do tipo LISTA
                if ($row['TIPO'] == 'A' && $row['QUAD_SQL_REF'] != '') { # Lista
                    $stmt2 = $db->prepare($row['QUAD_SQL_REF']);
                    if (strpos($row['QUAD_SQL_REF'], ":EMPRESA") != false)
                        $stmt2->bindParam(':EMPRESA', $row['EMPRESA'], PDO::PARAM_STR);
                    if (strpos($row['QUAD_SQL_REF'], ":RHID") != false)
                        $stmt2->bindParam(':RHID', $row['RHID'], PDO::PARAM_STR);
                    if (strpos($row['QUAD_SQL_REF'], ":DT_ADMISSAO") != false)
                        $stmt2->bindParam(':DT_ADMISSAO', $row['DT_ADMISSAO'], PDO::PARAM_STR);
                    if (strpos($row['QUAD_SQL_REF'], ":CD_GD") != false)
                        $stmt2->bindParam(':CD_GD', $row['CD_GD'], PDO::PARAM_STR);
                    if (strpos($row['QUAD_SQL_REF'], ":DT_INI_GD") != false)
                        $stmt2->bindParam(':DT_INI_GD', $row['DT_INI_GD'], PDO::PARAM_STR);
                    if (strpos($row['QUAD_SQL_REF'], ":CD_DET_GD") != false)
                        $stmt2->bindParam(':CD_DET_GD', $row['CD_DET_GD'], PDO::PARAM_STR);
                    if (strpos($row['QUAD_SQL_REF'], ":DT_INI_DET_GD") != false)
                        $stmt2->bindParam(':DT_INI_DET_GD', $row['DT_INI_DET_GD'], PDO::PARAM_STR);

                    $stmt2->execute();
                    $nr_elem = 0;
                    $html_content_ = '';
                    while ($row2 = $stmt2->fetch(PDO::FETCH_NUM)) {
                        $nr_elem += 1;
                        $dsp_ = $row2[0];
                        $cd_ = $row2[1];
                        $html_content_ .= '<option value="' . $cd_ . '">' . $dsp_ . '</option>';
                    }

                    if ($nr_elem > 5) {
                        $html_content_ = '<select id="' . $row['COD_VAR'] . '" size="1" class="chosen gd_var" data-placeholder="'.$ui_chose_option.'"> ' .
                                         '<option value=""></option>'.
                                         $html_content_.
                                         '</select>';
                    } else {
                        $html_content_ = '<select id="' . $row['COD_VAR'] . '" size="1" class="gd_var"> ' .
                                         '<option value=""></option>'.
                                         $html_content_.
                                         '</select>';
                    }

#echo "#LISTA -> [COD_VAR:" . $row['COD_VAR'] . " label:" . $row['LABEL'] . " QUAD_SQL_REF:" . $row['QUAD_SQL_REF'] . "]</br>";

                ## variáveis do tipo INPUT
                } elseif ($row['TIPO'] == 'B') { # Input
                    $html_content_ = '<div class="form-group">' .
                            '   <div class="input-group">';

                    if ($row['TIPO_DADOS'] == 'A') { # Alfanumérico
                        # required
                        $html_content_ .= '<input id="' . $row['COD_VAR'] . '" class="form-control gd_var"  type="text" ' .
                                'onclick="myFunction(this, event)" onchange="LineValidation(this)">';
                    }
                    elseif ($row['TIPO_DADOS'] == 'B') { # Data
                        # required
                        $html_content_ .= '<input id="' . $row['COD_VAR'] . '" class="datepicker inline form-control gd_var"  type="text" placeholder="YYYY-MM-DD" ' .
                                'onclick="myFunction(this, event)" onchange="LineValidation(this)">' .
                                '<span class="input-group-addon"><i class="fa fa-calendar"></i></span>';
                    }
                    elseif ($row['TIPO_DADOS'] == 'C') { # Numérico
                        # required
                        $html_content_ .= '<input id="' . $row['COD_VAR'] . '" class="form-control gd_var"  type="number" ';

                        if ($row['VALOR_MIN'] != '') {
                            $html_content_ .= 'min="' . $row['VALOR_MIN'] . '" ';
                        }

                        if ($row['VALOR_MAX'] != '') {
                            $html_content_ .= 'max="' . $row['VALOR_MAX'] . '" ';
                        }

                        if ($row['INCREMENTOS'] != '') {
                            $html_content_ .= 'step="' . $row['INCREMENTOS'] . '" ';
                        }

                        $html_content_ .= 'onclick="myFunction(this, event)" onchange="LineValidation(this)" ' .
                                'autocomplete="off" style="width:150px">';
                    }
                    elseif ($row['TIPO_DADOS'] == 'D') { # Moeda
                        $html_content_ .= '<input id="' . $row['COD_VAR'] . '" class="form-control gd_var"  type="number" ';

                        if ($row['VALOR_MIN'] != '') {
                            $html_content_ .= 'min="' . $row['VALOR_MIN'] . '" ';
                        }

                        if ($row['VALOR_MAX'] != '') {
                            $html_content_ .= 'max="' . $row['VALOR_MAX'] . '" ';
                        }

                        if ($row['INCREMENTOS'] != '') {
                            $html_content_ .= 'step="' . $row['INCREMENTOS'] . '" ';
                        }

                        $html_content_ .= 'onclick="myFunction(this, event)" onchange="LineValidation(this)" ' .
                                          'autocomplete="off">';

                        $html_content_ .= '<span class="input-group-addon">€</span>';
                    }

                    $html_content_ .= '    </div>' .
                                      '</div>';

                ## variáveis do tipo AUTOMÁTICO
                } elseif ($row['TIPO'] == 'C') { # Automático
                } elseif ($row['TIPO'] == 'Z') { # Pré-validação
                }

                $stmt2 = $db->prepare("INSERT INTO RH_ID_GD_VARIAVEIS " .
                                      "(ID_PROC_GD, CD_GD, DT_INI_DET_GD, CD_DET_GD, DT_INI_GD, COD_VAR, DT_INI_VAR, DT_INI_FRM, " .
                                      " SEQ, VISUALIZA, LABEL, HTML_CONTENT, HTML_HINT, VALOR) " .
                                      "VALUES(:ID_PROC_GD_,:CD_GD_,:DT_INI_DET_GD_,:CD_DET_GD_,:DT_INI_GD_,:COD_VAR_,:DT_INI_VAR_,:DT_INI_FRM_," .
                                      " 0,:VISUALIZA_,:LABEL_,:HTML_CONTENT_,:HTML_HINT_,NULL)");

                $stmt2->bindParam(':ID_PROC_GD_', $id_proc_gd_, PDO::PARAM_STR);
                $stmt2->bindParam(':CD_GD_', $row['CD_GD'], PDO::PARAM_STR);
                $stmt2->bindParam(':DT_INI_GD_', $row['DT_INI_GD'], PDO::PARAM_STR);
                $stmt2->bindParam(':CD_DET_GD_', $row['CD_DET_GD'], PDO::PARAM_STR);
                $stmt2->bindParam(':DT_INI_DET_GD_', $row['DT_INI_DET_GD'], PDO::PARAM_STR);
                $stmt2->bindParam(':COD_VAR_', $row['COD_VAR'], PDO::PARAM_STR);
                $stmt2->bindParam(':DT_INI_VAR_', $row['DT_INI_VAR'], PDO::PARAM_STR);
                $stmt2->bindParam(':DT_INI_FRM_', $row['DT_INI_FRM'], PDO::PARAM_STR);
                $stmt2->bindParam(':VISUALIZA_', $row['VISUALIZA'], PDO::PARAM_STR);
                $stmt2->bindParam(':LABEL_', $row['LABEL'], PDO::PARAM_STR);

                if ($html_content_ == '') {
                    $stmt2->bindParam(':HTML_CONTENT_', $html_content_ = null, PDO::PARAM_STR);
                } else {
                    $stmt2->bindParam(':HTML_CONTENT_', $html_content_, PDO::PARAM_STR);
                }

                if ($html_hint_ == '') {
                    $stmt2->bindParam(':HTML_HINT_', $html_hint_ = null, PDO::PARAM_STR);
                } else {
                    $stmt2->bindParam(':HTML_HINT_', $html_hint_, PDO::PARAM_STR);
                }

                $stmt2->execute();
            } catch (PDOException $ex) {
                $msg = "gd_cria_id_det_gd_variaveis - erro#2:" . $ex->getMessage();
                echo "erro:$msg";
            }
        }
    }

    #
    # FASES
    # Cria as fases de recolha para um documento ($id_proc_gd_)
    #
    # $id_proc_gd_ - código do registo de gestão documental
    # $acao_ - INSERT ou UPDATE
    #
    function gd_cria_id_det_gd_fases($id_proc_gd_, $acao_, &$msg) {

        global $db;

        # remover fases já existentes
        if ($acao_ == 'INSERT') {
            try {
                $stmt = $db->prepare("DELETE FROM RH_ID_GD_FASES " .
                                     "WHERE ID_PROC_GD = :ID_PROC_GD_ ");
                $stmt->bindParam(':ID_PROC_GD_', $id_proc_gd_, PDO::PARAM_STR);
                $stmt->execute();
            } catch (PDOException $ex) {
                $msg = "gd_cria_id_det_gd_fases - erro#0 :" . $ex->getMessage();
            }
        }

        # criar fases a partir da definição do template de documento
        try {
            if ($acao_ == 'INSERT') {

                $stmt = $db->prepare("SELECT A.ID_PROC_GD, A.EMPRESA, A.RHID, A.DT_ADMISSAO, B.CD_GD, B.DT_INI_DET_GD, B.CD_DET_GD, B.DT_INI_GD, " .
                                     " B.ID_FASE, B.DT_INI, B.TIPO, B.RHID " .
                                     "FROM RH_ID_GESTAO_DOCUMENTAL A, DG_GD_FASES B " .
                                     "WHERE A.ID_PROC_GD = :ID_PROC_GD_ " .
                                     "  AND A.CD_GD = B.CD_GD " .
                                     "  AND A.DT_INI_GD = B.DT_INI_GD " .
                                     "  AND A.CD_DET_GD = B.CD_DET_GD " .
                                     "  AND A.DT_INI_DET_GD = B.DT_INI_DET_GD ".
                                     "  AND B.DT_FIM IS NULL ");

                $stmt->bindParam(':ID_PROC_GD_', $id_proc_gd_, PDO::PARAM_STR);
                $stmt->execute();

            } elseif ($acao_ == 'UPDATE') {

                $stmt = $db->prepare("SELECT A.ID_PROC_GD, A.EMPRESA, A.RHID, A.DT_ADMISSAO, B.CD_GD, B.DT_INI_DET_GD, B.CD_DET_GD, B.DT_INI_GD, " .
                                     " B.ID_FASE, B.DT_INI, B.TIPO, B.RHID " .
                                     "FROM RH_ID_GESTAO_DOCUMENTAL A, DG_GD_FASES B " .
                                     "WHERE A.ID_PROC_GD = :ID_PROC_GD_ " .
                                     "  AND A.CD_GD = B.CD_GD " .
                                     "  AND A.DT_INI_GD = B.DT_INI_GD " .
                                     "  AND A.CD_DET_GD = B.CD_DET_GD " .
                                     "  AND A.DT_INI_DET_GD = B.DT_INI_DET_GD ".
                                     "  AND B.DT_FIM IS NULL ".
                                     "  AND (B.CD_GD, B.DT_INI_DET_GD, B.CD_DET_GD, B.DT_INI_GD, B.ID_FASE, B.DT_INI) NOT IN ".
                                     "      (SELECT X.CD_GD, X.DT_INI_DET_GD, X.CD_DET_GD, X.DT_INI_GD, X.ID_FASE, X.DT_INI_REFERENCIA ".
                                     "       FROM RH_ID_GD_FASES X ".
                                     "       WHERE X.ID_PROC_GD = :ID_PROC_GD_)");

                $stmt->bindParam(':ID_PROC_GD_', $id_proc_gd_, PDO::PARAM_STR);
                $stmt->execute();

            }

        } catch (PDOException $ex) {
            $msg = "gd_cria_id_det_gd_fases - erro#1 :" . $ex->getMessage();
        }

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            try {

                $stmt2 = $db->prepare("INSERT INTO RH_ID_GD_FASES " .
                                      "(ID_PROC_GD, CD_GD, DT_INI_DET_GD, CD_DET_GD, DT_INI_GD, ID_FASE, DT_INI_REFERENCIA, " .
                                      " DT_INI, DT_FIM, USR_DESTINATARIO, OBS) " .
                                      "VALUES(:ID_PROC_GD_,:CD_GD_,:DT_INI_DET_GD_,:CD_DET_GD_,:DT_INI_GD_,:ID_FASE_,:DT_INI_REFERENCIA_," .
                                      " :DT_INI_, NULL, NULL, NULL)");

                $stmt2->bindParam(':ID_PROC_GD_', $id_proc_gd_, PDO::PARAM_STR);
                $stmt2->bindParam(':CD_GD_', $row['CD_GD'], PDO::PARAM_STR);
                $stmt2->bindParam(':DT_INI_GD_', $row['DT_INI_GD'], PDO::PARAM_STR);
                $stmt2->bindParam(':CD_DET_GD_', $row['CD_DET_GD'], PDO::PARAM_STR);
                $stmt2->bindParam(':DT_INI_DET_GD_', $row['DT_INI_DET_GD'], PDO::PARAM_STR);
                $stmt2->bindParam(':ID_FASE_', $row['ID_FASE'], PDO::PARAM_STR);
                $stmt2->bindParam(':DT_INI_REFERENCIA_', $row['DT_INI'], PDO::PARAM_STR);
                $stmt2->bindParam(':DT_INI_', $row['DT_INI'], PDO::PARAM_STR);

                $stmt2->execute();

            } catch (PDOException $ex) {
                $msg = "gd_cria_id_det_gd_fases - erro#2:" . $ex->getMessage();
            }
        }
    }

    #
    # Cria os registos associados à criação de um documento
    #
    # $id_proc_gd_ - código do registo de gestão documental
    # $acao_ - INSERT ou UPDATE
    #
    function gd_cria_gd_registos($id_proc_gd_, $acao_, &$msg) {
        global $db;

        $msg = '';
        gd_cria_id_det_gd_variaveis($id_proc_gd_, $acao_, $msg);
        if ($msg == '') {
            gd_cria_id_det_gd_fases($id_proc_gd_, $acao_, $msg);
        }

        # força que o registo de gestão documental inicia-se na fase A - Elaboração
        if ($msg == '') {
            try {
                $stmt = $db->prepare("UPDATE RH_ID_GESTAO_DOCUMENTAL SET FASE = :FASE_ WHERE ID_PROC_GD = :ID_PROC_GD_ AND FASE IS NULL ");
                $fase_ = "A";
                $stmt->bindParam(':ID_PROC_GD_', $id_proc_gd_, PDO::PARAM_STR);
                $stmt->bindParam(':FASE_', $fase_, PDO::PARAM_STR);
                $stmt->execute();
            } catch (PDOException $ex) {
                $msg = "gd_cria_gd_registos - erro#1:" . $ex->getMessage();
            }

            $fase_ = '';
            if ($msg == '') {
                try {
                    $stmt = $db->prepare("SELECT FASE FROM RH_ID_GESTAO_DOCUMENTAL WHERE ID_PROC_GD = :ID_PROC_GD_");
                    $stmt->bindParam(':ID_PROC_GD_', $id_proc_gd_, PDO::PARAM_STR);
                    $stmt->execute();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $fase_ = $row['FASE'];
                    }
                } catch (PDOException $ex) {
                    $msg = "gd_cria_gd_registos - erro#2:" . $ex->getMessage();
                }
            }

            if ($msg == '' && $fase_ != '') {

                if ($msg == '') {
                    try {
                        $stmt = $db->prepare("SELECT A.FASE, B.TIPO, B.RHID, C.RV_MEANING ".
                                             "FROM RH_ID_GESTAO_DOCUMENTAL A, DG_GD_FASES B, cg_ref_codes C ".
                                             "WHERE A.ID_PROC_GD = :ID_PROC_GD_ ".
                                             "  AND A.CD_GD = B.CD_GD ".
                                             "  AND A.DT_INI_GD = B.DT_INI_GD ".
                                             "  AND A.CD_DET_GD = B.CD_DET_GD ".
                                             "  AND A.DT_INI_DET_GD = B.DT_INI_DET_GD ".
                                             "  AND A.FASE >= B.TIPO ".
                                             "  AND B.TIPO = C.RV_LOW_VALUE ".
                                             "  AND C.RV_DOMAIN = 'DG_TIPO_FASES_GD' ".
                                             "  AND (B.TIPO) NOT IN (SELECT REF_DOC FROM RH_ID_GD_DOCS WHERE ID_PROC_GD = :ID_PROC_GD_) ");
                        $stmt->bindParam(':ID_PROC_GD_', $id_proc_gd_, PDO::PARAM_STR);
                        $stmt->execute();
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $dt_ref_doc_ = date("Y-m-d");
                            gd_cria_linha_doc($id_proc_gd_, $row['TIPO'], $dt_ref_doc_,'','','',$row['RHID'],$msg);
                        }
                    } catch (PDOException $ex) {
                        $msg = "gd_cria_gd_registos - erro#3:" . $ex->getMessage();
                    }
                }

                try {
                    $stmt = $db->prepare("DELETE FROM RH_ID_GD_DOCS WHERE ID_PROC_GD = :ID_PROC_GD_ AND REF_DOC > :FASE_ ");
                    $stmt->bindParam(':ID_PROC_GD_', $id_proc_gd_, PDO::PARAM_STR);
                    $stmt->bindParam(':FASE_', $fase_, PDO::PARAM_STR);
                    $stmt->execute();
                } catch (PDOException $ex) {
                    $msg = "gd_cria_gd_registos - erro#4:" . $ex->getMessage();
                }
            }

        }

    }

    #
    # Remove os registos associados a um documento
    #
    # $id_proc_gd_ - código do registo de gestão documental
    #
    function gd_remove_gd_registos($id_proc_gd_, &$msg) {
        $msg = '';
        $fase_ = '';
        global $db;

        try {
            $stmt = $db->prepare("SELECT FASE FROM RH_ID_GESTAO_DOCUMENTAL WHERE ID_PROC_GD = :ID_PROC_GD_ ");
            $stmt->bindParam(':ID_PROC_GD_', $id_proc_gd_, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $fase_ = $row['FASE'];
            if ($fase_ == '') {
                $fase_ = 'A';
            }
        } catch (PDOException $ex) {
            $msg = "gd_remove_gd_registos - erro#0 :" . $ex->getMessage();
        }

        if ($fase_ != 'A') {
            $msg = 'Não é possível remover processos que não estejam em fase de Elaboração.';
        }

        # remover documentos associados
        if ($msg == '') {
            try {
                $stmt = $db->prepare("DELETE FROM RH_ID_GD_DOCS WHERE ID_PROC_GD = :ID_PROC_GD_ ");
                $stmt->bindParam(':ID_PROC_GD_', $id_proc_gd_, PDO::PARAM_STR);
                $stmt->execute();
            } catch (PDOException $ex) {
                $msg = "gd_remove_gd_registos - erro#1 :" . $ex->getMessage();
            }
        }

        # remover fases existentes
        if ($msg == '') {
            try {
                $stmt = $db->prepare("DELETE FROM RH_ID_GD_FASES WHERE ID_PROC_GD = :ID_PROC_GD_ ");
                $stmt->bindParam(':ID_PROC_GD_', $id_proc_gd_, PDO::PARAM_STR);
                $stmt->execute();
            } catch (PDOException $ex) {
                $msg = "gd_remove_gd_registos - erro#2 :" . $ex->getMessage();
            }
        }

        # remover variáveis existentes
        if ($msg == '') {
            try {
                $stmt = $db->prepare("DELETE FROM RH_ID_GD_VARIAVEIS WHERE ID_PROC_GD = :ID_PROC_GD_ ");
                $stmt->bindParam(':ID_PROC_GD_', $id_proc_gd_, PDO::PARAM_STR);
                $stmt->execute();
            } catch (PDOException $ex) {
                $msg = "gd_remove_gd_registos - erro#3 :" . $ex->getMessage();
            }
        }
    }

    ##
    ## OPERAÇÃO SOBRE REGISTOS DE GESTÃO DOCUMENTAL
    ##

    #
    # Valida a existencia das fases básicas de workdlow num processo
    #
    function gd_valida_fases($id_proc_gd_, &$msg) {
        global $db;

        #
        # FASES possíveis:
        #
        # A	Elaboração
        # B	Valid. Gestor Adm.
        # C	Valid. Supervisor
        # D	Valid. Diretor
        # E	Valid. Gestor
        # F	Assinat. Colaborador
        # G	Assinat. Gestor Adm.
        # H	Assinat. Supervisor
        # I	Assinat. Diretor
        # J	Assinat. Gestor
        # K	Aprov. Gestor Adm.
        # L	Aprov. Supervisor
        # M	Aprov. Diretor
        # N	Aprov. Gestor
        # O	Aprovado
        # P	Rejeitado
        # Z	Cancelado

        # Determina se existem as fases básicas definidas.
        $existe_elaboracao = 'N';
        $existe_aprovado = 'N';
        $existe_rejeitado = 'N';
        try {
            $stmt = $db->prepare("SELECT B.TIPO ".
                                 "FROM RH_ID_GD_FASES A, DG_GD_FASES B ".
                                 "WHERE A.ID_PROC_GD = :ID_PROC_GD_ ".
                                 "  AND A.CD_GD = B.CD_GD ".
                                 "  AND A.DT_INI_GD = B.DT_INI_GD ".
                                 "  AND A.CD_DET_GD = B.CD_DET_GD ".
                                 "  AND A.DT_INI_DET_GD = B.DT_INI_DET_GD ".
                                 "  AND A.ID_FASE = B.ID_FASE ".
                                 "  AND A.DT_INI_REFERENCIA = B.DT_INI ");

            $stmt->bindParam(':ID_PROC_GD_', $id_proc_gd_, PDO::PARAM_STR);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                if ($row['TIPO'] == 'A') { # elaborado
                    $existe_elaboracao = 'S';
                } elseif ($row['TIPO'] == 'O') { # aprovado
                    $existe_aprovado = 'S';
                } elseif ($row['TIPO'] == 'P') { # rejeitado
                    $existe_rejeitado = 'S';
                }


            }
        } catch (PDOException $ex) {
            $msg = "erro#1:" . $ex->getMessage();
        }

        if ($existe_elaboracao != 'S' && $existe_aprovado != 'S' && $existe_rejeitado != 'S') {
            $msg = 'Não se encontram definidas para este processo as fases de workflow: Elaboração, Aprovado e Rejeitado.';
        } elseif ($existe_elaboracao != 'S') {
            $msg = 'Não se encontra definida para este processo a fase de workflow: Elaboração.';
        } elseif ($existe_aprovado != 'S') {
            $msg = 'Não se encontra definida para este processo a fase de workflow: Aprovado.';
        } elseif ($existe_rejeitado != 'S') {
            $msg = 'Não se encontra definida para este processo a fase de workflow: Rejeitado.';
        }

    }

    #
    # Determina o tipo de máscara [MASCARA ou VARIAVEL] introduzida
    #
    function gd_tipo_mascara($mask, &$msg) {
        global $db;
        $msg = '';
        $resultado = '';
        $existe = 0;

        # determina se é uma máscara
        try {
            $stmt = $db->prepare("SELECT A.* FROM DG_GD_MASCARAS A WHERE A.COD = :COD_ ");
            $stmt->bindParam(':COD_', $mask, PDO::PARAM_STR);
            $stmt->execute();
            $existe = $stmt->rowCount();
        } catch (PDOException $ex) {
            $msg = "erro#1:" . $ex->getMessage();
        }
        if ($existe == 1) {
            $resultado = 'MASCARA';
        }

        if ($resultado == '') {
            try {
                $stmt = $db->prepare("SELECT A.* FROM DG_DEF_VARIAVEIS A WHERE A.COD_VAR = :COD_VAR_ ");
                $stmt->bindParam(':COD_VAR_', $mask, PDO::PARAM_STR);
                $stmt->execute();
                $existe = $stmt->rowCount();
            } catch (PDOException $ex) {
                $msg = "erro#2:" . $ex->getMessage();
            }
            if ($existe == 1) {
                $resultado = 'VARIAVEL';
            }
        }

        return $resultado;

    }

    #
    # Obtem a informação sobre a máscara tipo:[MASCARA ou VARIAVEL] e designação
    #
    function gd_info_mascara($mask, &$tipo, &$dsp, &$msg) {
        global $db;
        $msg = '';
        $existe = 0;
        $tipo = '';
        $dsp = '';

        # determina se é uma máscara
        try {
            $stmt = $db->prepare("SELECT A.* FROM DG_GD_MASCARAS A WHERE A.COD = :COD_ ");
            $stmt->bindParam(':COD_', $mask, PDO::PARAM_STR);
            $stmt->execute();
            $existe = $stmt->rowCount();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            $msg = "erro#1:" . $ex->getMessage();
        }
        if ($existe == 1) {
            $tipo = 'MASCARA';
            $dsp = str_replace(".","",$row['DESCRICAO']);
        }

        if ($tipo == '') {
            try {
                $stmt = $db->prepare("SELECT A.* FROM DG_DEF_VARIAVEIS A WHERE A.COD_VAR = :COD_VAR_ ");
                $stmt->bindParam(':COD_VAR_', $mask, PDO::PARAM_STR);
                $stmt->execute();
                $existe = $stmt->rowCount();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $ex) {
                $msg = "erro#2:" . $ex->getMessage();
            }
            if ($existe == 1) {
                $tipo = 'VARIAVEL';
                $dsp = $row['LABEL'];
            }
        }

        return $tipo;

    }

    #
    # Determina o valor de uma máscara no contexto de um documento ($id_prod_gd_)
    #
    function gd_get_mask_value($id_proc_gd_, $cod_mask_, &$msg) {

        global $db;
        $resultado = '';

        try {
            $stmt = $db->prepare("SELECT A.ID_PROC_GD, A.EMPRESA, A.RHID, A.DT_ADMISSAO, A.CD_GD, A.DT_INI_GD, A.CD_DET_GD, A.DT_INI_DET_GD, B.SQL_TAG " .
                                 "FROM RH_ID_GESTAO_DOCUMENTAL A, DG_GD_MASCARAS B " .
                                 "WHERE A.ID_PROC_GD = :ID_PROC_GD_ " .
                                 "  AND B.COD = :COD_MASK_ ");

            $stmt->bindParam(':ID_PROC_GD_', $id_proc_gd_, PDO::PARAM_STR);
            $stmt->bindParam(':COD_MASK_', $cod_mask_, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $ex) {
            $msg = "erro#1 :" . $ex->getMessage();
        }

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            try {
                if ($row['SQL_TAG'] != '') { #
#echo "---- ## MASCARA:$cod_mask_ SQL[".$row['SQL_TAG']."]<br/>";

                    $stmt2 = $db->prepare($row['SQL_TAG']);
                    if (strpos($row['SQL_TAG'], ":EMPRESA") != false)
                        $stmt2->bindParam(':EMPRESA', $row['EMPRESA'], PDO::PARAM_STR);
                    if (strpos($row['SQL_TAG'], ":RHID") != false)
                        $stmt2->bindParam(':RHID', $row['RHID'], PDO::PARAM_STR);
                    if (strpos($row['SQL_TAG'], ":DT_ADMISSAO") != false)
                        $stmt2->bindParam(':DT_ADMISSAO', $row['DT_ADMISSAO'], PDO::PARAM_STR);
                    if (strpos($row['SQL_TAG'], ":CD_GD") != false)
                        $stmt2->bindParam(':CD_GD', $row['CD_GD'], PDO::PARAM_STR);
                    if (strpos($row['SQL_TAG'], ":DT_INI_GD") != false)
                        $stmt2->bindParam(':DT_INI_GD', $row['DT_INI_GD'], PDO::PARAM_STR);
                    if (strpos($row['SQL_TAG'], ":CD_DET_GD") != false)
                        $stmt2->bindParam(':CD_DET_GD', $row['CD_DET_GD'], PDO::PARAM_STR);
                    if (strpos($row['SQL_TAG'], ":DT_INI_DET_GD") != false)
                        $stmt2->bindParam(':DT_INI_DET_GD', $row['DT_INI_DET_GD'], PDO::PARAM_STR);

                    ## proceder à substituição de variáveis associadas ao processo na fórmula da máscara
                    try {
                        $stmt3 = $db->prepare("SELECT A.COD_VAR, A.VALOR ".
                                              "FROM RH_ID_GD_VARIAVEIS A " .
                                              "WHERE A.ID_PROC_GD = :ID_PROC_GD_ " .
                                              "  AND A.VALOR IS NOT NULL ");

                        $stmt3->bindParam(':ID_PROC_GD_', $id_proc_gd_, PDO::PARAM_STR);
                        $stmt3->execute();
                        while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)) {
                            if (strpos($row['SQL_TAG'], ":".$row3['COD_VAR']) != false) {
                                $stmt2->bindParam(":".$row3['COD_VAR'], $row3['VALOR'], PDO::PARAM_STR);
#echo "---- ## MASCARA:$cod_mask_ SUBSTITUICAO VAR [".$row3['COD_VAR']."] VALOR:[".$row3['VALOR']."]<br/>";
                            }
                        }

                    } catch (Exception $ex) {
                        $msg = "erro#1.1 :" . $ex->getMessage();
                    }

                    $stmt2->execute();
                    while ($row2 = $stmt2->fetch(PDO::FETCH_NUM)) {
                        $resultado = $row2[0];
                    }
                }
            } catch (PDOException $ex) {
                # caso resulte em erro, não dá mensagem e coloca o resutlado a nulo
                #$msg = "erro#2[" . $row['SQL_TAG'] . "]:" . $ex->getMessage();
                $resultado = '';
            }
        }

        return $resultado;
    }

    #
    # Determina o valor de uma variável no contexto de um documento ($id_prod_gd_)
    #
    function gd_get_var_value($id_proc_gd_, $cod_var_, $tipo, &$seq, &$msg) {

        global $db;
        $resultado = '';
        $seq = '';

        try {
            $stmt = $db->prepare("SELECT A.ID_PROC_GD, A.EMPRESA, A.RHID, A.DT_ADMISSAO, B.SEQ, B.VALOR, B.DSP_VALOR " .
                                 "FROM RH_ID_GESTAO_DOCUMENTAL A, RH_ID_GD_VARIAVEIS B " .
                                 "WHERE A.ID_PROC_GD = :ID_PROC_GD_ " .
                                 "  AND B.ID_PROC_GD = A.ID_PROC_GD ".
                                 "  AND B.COD_VAR = :COD_VAR_ ");

            $stmt->bindParam(':ID_PROC_GD_', $id_proc_gd_, PDO::PARAM_STR);
            $stmt->bindParam(':COD_VAR_', $cod_var_, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $ex) {
            $msg = "erro#1 :" . $ex->getMessage();
        }

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($tipo == 'DSP' && $row['DSP_VALOR'] != '') {
                $resultado = $row['DSP_VALOR'];
                $seq = $row['SEQ'];
            } else {
                $resultado = $row['VALOR'];
                $seq = $row['SEQ'];
            }
        }

        return $resultado;
    }

    #
    # Calcula os valores associados às variáveis automáticas
    #
    function gd_calcula_var_auto($id_proc_gd_, &$msg) {

        global $db;
        $resultado = '';

        try {
            $stmt = $db->prepare("SELECT A.ID_PROC_GD, A.EMPRESA, A.RHID, A.DT_ADMISSAO, A.CD_GD, A.DT_INI_GD, A.CD_DET_GD, A.DT_INI_DET_GD, B.COD_VAR, B.SEQ, C.QUAD_SQL_REF, C.FUNCTION_REF, C.TIPO " .
                                 "FROM RH_ID_GESTAO_DOCUMENTAL A, RH_ID_GD_VARIAVEIS B, DG_DEF_VARIAVEIS C " .
                                 "WHERE A.ID_PROC_GD = :ID_PROC_GD_ " .
                                 "  AND B.ID_PROC_GD = A.ID_PROC_GD ".
                                 "  AND C.COD_VAR = B.COD_VAR ".
                                 "  AND C.DT_INI_VAR = B.DT_INI_VAR ".
                                 "  AND C.TIPO = 'C' ".   ## variáveis automáticas
                                 "  AND (C.QUAD_SQL_REF IS NOT NULL OR C.FUNCTION_REF IS NOT NULL)");

            $stmt->bindParam(':ID_PROC_GD_', $id_proc_gd_, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $ex) {
            $msg = "erro#1 :" . $ex->getMessage();
        }
#echo "VARIÁVEIS AUTO #1 [$msg]------------------------------------------- <br/>";
        if ($msg == '') {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
#echo "---- ## VARIÁVEL:".$row['COD_VAR']." -------------------------------------------- <br/>";

                    $resultado = '';

                    if ($row['FUNCTION_REF'] != '') {

                        # valor por extenso
                        if (strpos($row['FUNCTION_REF'], "EXTENSO") != false) {

                            ## proceder à determinação do valor constante na máscara
                            $valor = '';
                            try {
                                $stmt3 = $db->prepare("SELECT DISTINCT A.COD_VAR, A.VALOR ".
                                                      "FROM RH_ID_GD_VARIAVEIS A " .
                                                      "WHERE A.ID_PROC_GD = :ID_PROC_GD_ " .
                                                      "  AND A.VALOR IS NOT NULL ");

                                $stmt3->bindParam(':ID_PROC_GD_', $id_proc_gd_, PDO::PARAM_STR);
                                $stmt3->execute();
                                while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)) {
                                    if (strpos($row['FUNCTION_REF'], ":".$row3['COD_VAR']) != false) {
                                        $valor = $row3['VALOR'];
                                        break;
                                    }
                                }

                            } catch (Exception $ex) {
                                # não dá erro e coloca o resultado a nulo
                                #$msg = "erro#2 [".$row['COD_VAR']."] :" . $ex->getMessage();
                                $valor = '';
                            }

                            if ($valor != '') {
                                 if (strpos($row['FUNCTION_REF'], "EXTENSO_MES") != false) {
                                        $resultado = mes_extenso($valor);
                                 } elseif (strpos($row['FUNCTION_REF'], "EXTENSO_NUMERO") != false) {
                                        $resultado = numero_extenso($valor);
                                 } else {
                                        $resultado = extenso($valor);
                                 }
                                try {

                                    $stmt3 = $db->prepare("UPDATE RH_ID_GD_VARIAVEIS ".
                                                          "SET VALOR = :VALOR_, DSP_VALOR = :VALOR_, HTML_CONTENT = :HTML_  ".
                                                          "WHERE ID_PROC_GD = :ID_PROC_GD_ ".
                                                          "  AND SEQ = :SEQ_ ".
                                                          "  AND COD_VAR = :COD_VAR_ ");

                                    $stmt3->bindParam(':ID_PROC_GD_', $row['ID_PROC_GD'], PDO::PARAM_STR);
                                    $stmt3->bindParam(':SEQ_', $row['SEQ'], PDO::PARAM_STR);
                                    $stmt3->bindParam(':COD_VAR_', $row['COD_VAR'], PDO::PARAM_STR);
                                    if ($resultado != '') {
                                        $stmt3->bindParam(':VALOR_', $resultado, PDO::PARAM_STR);
                                        $stmt3->bindParam(':HTML_',$resultado, PDO::PARAM_STR);
                                    } else {
                                        $stmt3->bindParam(':VALOR_', $nulo = null, PDO::PARAM_STR);
                                        $stmt3->bindParam(':HTML_', $nulo = null, PDO::PARAM_STR);
                                    }

                                    $stmt3->execute();

                                } catch (Exception $ex) {
                                    $msg = "erro#3 [".$row['COD_VAR']."] :" . $ex->getMessage();
                                }

                            }
#echo "---- ## VARIÁVEL:".$row['COD_VAR']." VALOR:[".$resultado."]<br/>";
                        }

                    } elseif ($row['QUAD_SQL_REF'] != '') {

#echo "---- ## VARIÁVEL:".$row['COD_VAR']." SQL:[".$row['QUAD_SQL_REF']."]<br/>";

                        $stmt2 = $db->prepare($row['QUAD_SQL_REF']);
                        if (strpos($row['QUAD_SQL_REF'], ":EMPRESA") != false)
                            $stmt2->bindParam(':EMPRESA', $row['EMPRESA'], PDO::PARAM_STR);
                        if (strpos($row['QUAD_SQL_REF'], ":RHID") != false)
                            $stmt2->bindParam(':RHID', $row['RHID'], PDO::PARAM_STR);
                        if (strpos($row['QUAD_SQL_REF'], ":DT_ADMISSAO") != false)
                            $stmt2->bindParam(':DT_ADMISSAO', $row['DT_ADMISSAO'], PDO::PARAM_STR);
                        if (strpos($row['QUAD_SQL_REF'], ":CD_GD") != false)
                            $stmt2->bindParam(':CD_GD', $row['CD_GD'], PDO::PARAM_STR);
                        if (strpos($row['QUAD_SQL_REF'], ":DT_INI_GD") != false)
                            $stmt2->bindParam(':DT_INI_GD', $row['DT_INI_GD'], PDO::PARAM_STR);
                        if (strpos($row['QUAD_SQL_REF'], ":CD_DET_GD") != false)
                            $stmt2->bindParam(':CD_DET_GD', $row['CD_DET_GD'], PDO::PARAM_STR);
                        if (strpos($row['QUAD_SQL_REF'], ":DT_INI_DET_GD") != false)
                            $stmt2->bindParam(':DT_INI_DET_GD', $row['DT_INI_DET_GD'], PDO::PARAM_STR);

                        ## proceder à substituição de variáveis associadas ao processo na fórmula da máscara
                        try {
                            $stmt3 = $db->prepare("SELECT DISTINCT A.COD_VAR, A.VALOR ".
                                                  "FROM RH_ID_GD_VARIAVEIS A " .
                                                  "WHERE A.ID_PROC_GD = :ID_PROC_GD_ " .
                                                  "  AND A.VALOR IS NOT NULL ");

                            $stmt3->bindParam(':ID_PROC_GD_', $id_proc_gd_, PDO::PARAM_STR);
                            $stmt3->execute();
                            while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)) {
                                if (strpos($row['QUAD_SQL_REF'], ":".$row3['COD_VAR']) != false) {
                                    $stmt2->bindParam(":".$row3['COD_VAR'], $row3['VALOR'], PDO::PARAM_STR);
#echo "---- ## VARIÁVEL:".$row['COD_VAR']." SUBSTITUICAO VAR [".$row3['COD_VAR']."] VALOR:[".$row3['VALOR']."]<br/>";
                                }
                            }

                        } catch (Exception $ex) {
                            # não dá erro
                            #$msg = "erro#2 [".$row['COD_VAR']."] :" . $ex->getMessage();
                            null;
                        }

                        if ($msg == '') {

                            try {
                                $stmt2->execute();
                                while ($row2 = $stmt2->fetch(PDO::FETCH_NUM)) {
                                    $resultado = $row2[0];
                                }
#echo "VARIÁVEIS AUTO [".$row['COD_VAR']."] valor:$resultado <br/>";
                                try {

                                    $sql =  "UPDATE RH_ID_GD_VARIAVEIS ".
                                            "SET VALOR = :VALOR_, DSP_VALOR = :VALOR_, HTML_CONTENT = :HTML_ ".
                                            "WHERE ID_PROC_GD = :ID_PROC_GD_ ".
                                            "  AND SEQ = :SEQ_ ".
                                            "  AND COD_VAR = :COD_VAR_ ";

                                    # se não é uma variável automática, quer dizer que o resultado é apenas para ter um valor inicial.
                               #     if ($row['TIPO'] != 'C') {
                               #         $sql .= " AND (VALOR IS NULL OR VALOR = '') ";
                               #     }

                                    $stmt3 = $db->prepare($sql);

                                    $stmt3->bindParam(':ID_PROC_GD_', $row['ID_PROC_GD'], PDO::PARAM_STR);
                                    $stmt3->bindParam(':SEQ_', $row['SEQ'], PDO::PARAM_STR);
                                    $stmt3->bindParam(':COD_VAR_', $row['COD_VAR'], PDO::PARAM_STR);

                                    if ($resultado != '') {
                                        $stmt3->bindParam(':VALOR_',$resultado, PDO::PARAM_STR);
                                        $stmt3->bindParam(':HTML_',$resultado, PDO::PARAM_STR);
                                    } else {
                                        $stmt3->bindParam(':VALOR_', $nulo = null, PDO::PARAM_STR);
                                        $stmt3->bindParam(':HTML_', $nulo = null, PDO::PARAM_STR);
                                    }
                                    $stmt3->execute();

                                } catch (Exception $ex) {
                                    $msg = "erro#3 [".$row['COD_VAR']."] :" . $ex->getMessage();
                                }

                            } catch (Exception $ex) {
                                #$msg = "erro#4 [".$row['COD_VAR']."] :" . $ex->getMessage();
                                null;
                            }

                        }
                    }
            }
        }
#echo "FIM VARIAVEIS AUTO #99999 [$msg]------------------------------------------- <br/><br/><br/>";

    }

    #
    # Obtém as máscaras existentes num documento, retornando um array
    # de três colunas (mascara, variavel associada, tipo [MASCARA,VARIAVEL,DSP])
    #
    function gd_get_doc_masks($ficheiro, &$msg) {
        $msg = '';
        $mascaras = array();
        $ext = strtolower(pathinfo($ficheiro,PATHINFO_EXTENSION));
        $docText = '';
        if ($ext == 'docx') {
            $docObj = new DocxConversion($ficheiro);
            $docText = $docObj->convertToText();
        } elseif ($ext == 'xlsx') {
            $docObj = new DocxConversion($ficheiro);
            $docText = $docObj->convertToText();
        } elseif ($ext == 'pptx') {
            $docObj = new DocxConversion($ficheiro);
            $docText = $docObj->convertToText();
        }

        if ($docText != '') {
            # número de máscaras existentes no documento
            $cnt = (strlen($docText) - strlen(str_replace("\${", "", $docText))) / 2;
            $aux = $docText;
            for ($i = 0; $i < $cnt; $i++) {
                $p1 = strpos($aux, "\${");
                $p2 = strpos($aux, "}", $p1);

                $msk_ = substr($aux, $p1, $p2 - $p1 + 1);
                $var_ = trim(str_replace("\${", "", str_replace("}", "", $msk_)));
                $aux = substr($aux, $p2 + 1);

                ## para obter mais informação sobre as máscaras do documento
                #$tipo = gd_tipo_mascara($var_,$msg);
                gd_info_mascara($var_, $tipo, $dsp, $msg);

                $mascaras[] = array($msk_, $var_, $tipo, $dsp);
    #echo "[$i]: msk:$msk_ var:$var_<br/>";
                $aux = substr($aux, $p);
            };
        }
        return $mascaras;
    }

    #
    # Obtém as variáveis associadas a um processo retornando um array
    # de três colunas (mascara, variavel associada, tipo [MASCARA,VARIAVEL,DSP])
    #
    function gd_get_doc_vars($id_proc_gd_, &$msg) {
        $msg = '';
        global $db;
        $mascaras = array();

        try {
            $stmt = $db->prepare("SELECT A.ID_PROC_GD, A.EMPRESA, A.RHID, A.DT_ADMISSAO, B.COD_VAR, B.SEQ, C.QUAD_SQL_REF, C.FUNCTION_REF " .
                                 "FROM RH_ID_GESTAO_DOCUMENTAL A, RH_ID_GD_VARIAVEIS B, DG_DEF_VARIAVEIS C " .
                                 "WHERE A.ID_PROC_GD = :ID_PROC_GD_ " .
                                 "  AND B.ID_PROC_GD = A.ID_PROC_GD ".
                                 "  AND C.COD_VAR = B.COD_VAR ".
                                 "  AND C.DT_INI_VAR = B.DT_INI_VAR ");

            $stmt->bindParam(':ID_PROC_GD_', $id_proc_gd_, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $ex) {
            $msg = "erro#1 :" . $ex->getMessage();
        }

        if ($msg == '') {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $msk_ = '';
                $var_ = $row['COD_VAR'];
                gd_info_mascara($var_, $tipo, $dsp, $msg);
                $mascaras[] = array($msk_, $var_, $tipo, $dsp);
            }
        }
        return $mascaras;
    }

    #
    # Valida existência das máscaras/variáveis indicadas em array $mascaras
    #
    function gd_valida_mascaras($mascaras, &$msg) {
        $msg = '';
        $msk_not_def = '';

        foreach ($mascaras as $mascara) {
            # máscara:  ${xxx}
            $msk_ = $mascara[0];
            # variável associada: xxx
            $var_ = $mascara[1];
            $tipo = gd_tipo_mascara($var_, $msg1);
            #echo " msk:[$msk_] var:[$var_] tipo:[$tipo]<br/>";

            if ($tipo == '') {
                if ($msk_not_def == '')
                    $msk_not_def = "$var_";
                else {
                    $msk_not_def .= ",$var_";
                }
            }
            if ($msk_not_def != '')
                $msg = "Máscara(s) [$msk_not_def] constante(s) do documento e não definida(s) no ambiente.";

        }

    }

    #
    # Cria linha de documento associado à gestão documental
    #
    function gd_cria_linha_doc($id_proc_gd_, $ref_doc_, $dt_ref_doc_, $mime_, $blob_, $ficheiro_, $rhid_, &$msg) {

        global $db;

        try {

            $stmt = $db->prepare("INSERT INTO RH_ID_GD_DOCS " .
                                 "(ID_PROC_GD, ID_DOC, REF_DOC, DT_REF_DOC, BD_DOC, BD_MIME, LINK_DOC, RHID) " .
                                 "VALUES(:ID_PROC_GD_, 0, :REF_DOC_, :DT_REF_DOC_, :BD_DOC_, :BD_MIME_, :LINK_DOC_, :RHID_)");

            $stmt->bindParam(':ID_PROC_GD_', $id_proc_gd_, PDO::PARAM_STR);

            if ($ref_doc_ == '') {
                $stmt->bindParam(':REF_DOC_', $null = null, PDO::PARAM_STR);
            } else {
                $stmt->bindParam(':REF_DOC_', $ref_doc_, PDO::PARAM_STR);
            }

            if ($dt_ref_doc_ == '') {
                $stmt->bindParam(':DT_REF_DOC_', $null = null, PDO::PARAM_STR);
            } else {
                $stmt->bindParam(':DT_REF_DOC_', $dt_ref_doc_, PDO::PARAM_STR);
            }

            if ($mime_ == '') {
                $stmt->bindParam(':BD_MIME_', $null = null, PDO::PARAM_STR);
            } else {
                $stmt->bindParam(':BD_MIME_', $mime_, PDO::PARAM_STR);
            }

            if ($blob_ == '') {
                $stmt->bindParam(':BD_DOC_', $null = null, PDO::PARAM_LOB);
            } else {
                $stmt->bindParam(':BD_DOC_', $blob_, PDO::PARAM_LOB);
            }

            if ($ficheiro_ == '') {
                $stmt->bindParam(':LINK_DOC_', $null = null, PDO::PARAM_STR);
            } else {
                $stmt->bindParam(':LINK_DOC_', $ficheiro_, PDO::PARAM_STR);
            }

            if ($rhid_ == '') {
                $stmt->bindParam(':RHID_', $null = null, PDO::PARAM_STR);
            } else {
                $stmt->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
            }

            $stmt->execute();

        } catch (PDOException $ex) {
            $msg = "gd_cria_linha_doc#1:" . $ex->getMessage();
        }
    }

    #
    # Executa as ações associadas à aprovação de um registo de gestão documental de acordo com as variáveis disponíveis
    #
    function gd_acoes_finais($id_proc_gd_,&$msg) {
        global $db;
        $msg = '';
        $msg1 = '';
        $msg2 = '';
        $msg3 = '';

        ## se estiver definido o NOVO_VINCULO e DT_INI_VINCULO => cria vínculo
        $cd_vinculo = gd_get_var_value($id_proc_gd_, 'NOVO_VINCULO', 'VALOR', $seq, $msg1);
        $dt_ini_vinculo = gd_get_var_value($id_proc_gd_, 'DT_INI_VINCULO', 'VALOR', $seq, $msg2);
        $msg = trim($msg1.$msg2);
        if ($cd_vinculo != '' && $dt_ini_vinculo != '' && $msg == '') {
            gd_cria_vinculo($id_proc_gd_,$msg);
        }

        ## se estiver definido o ESTAB_COLOC e DT_INI_VINCULO => atualiza estabelecimento de colocação
        $estab = gd_get_var_value($id_proc_gd_, 'ESTAB_COLOC', 'VALOR', $seq, $msg1);
        $msg = trim($msg.$msg1);
        if ($estab != '' && $dt_ini_vinculo != '' && $msg == '') {
            gd_grava_info_empresa($id_proc_gd_,$msg);
        }

        $cat_prof = gd_get_var_value($id_proc_gd_, 'NOVA_CATEG_PROFISSIONAL', 'VALOR', $seq, $msg1);
        $nivel = gd_get_var_value($id_proc_gd_, 'NIVEL', 'VALOR', $seq, $msg2);
        $hor_sem = gd_get_var_value($id_proc_gd_, 'HOR_SEMANAL', 'VALOR', $seq, $msg3);
        $msg = trim($msg.$msg1.$msg2.$msg3);
        ## se estiver definido o categoria profissional, nivel ou horário semanal e DT_INI_VINCULO => atualiza informação profissional
        if (($cat_prof != '' || $nivel != '' || $hor_sem != '') && $dt_ini_vinculo != '' && $msg == '') {
            gd_grava_info_prof($id_proc_gd_,$msg);
        }

        ## se estiver definido o NOVA_FUNCAO => cria novo registo de função
        $func = gd_get_var_value($id_proc_gd_, 'NOVA_FUNCAO', 'VALOR', $seq, $msg1);
        $msg = trim($msg.$msg1);
        if ($func != '' && $dt_ini_vinculo != '' && $msg == '') {
            gd_cria_nova_funcao($id_proc_gd_,$msg);
        }

        ## se estiver definido o SALARIO => atualiza o novo registo de salário
        $sal = gd_get_var_value($id_proc_gd_, 'SALARIO', 'VALOR', $seq, $msg1);
        $msg = trim($msg.$msg1);
        if ($sal != '' && $dt_ini_vinculo != '' && $msg == '') {
            gd_cria_novo_salario($id_proc_gd_,$msg);
        }

        ## se estiver definida a entidade fundo de pensões FUNDO_PENSOES => cria entidade de desconto
        $fp = gd_get_var_value($id_proc_gd_, 'FUNDO_PENSOES', 'VALOR', $seq, $msg1);
        $msg = trim($msg.$msg1);
        if ($fp == '1' && $dt_ini_vinculo != '' && $msg == '') {
            $cd_ed = '778';
            $cd_reg_desc = 'E50';
            gd_cria_entidade_desconto($id_proc_gd_, $cd_ed, $cd_reg_desc, $msg);
        }
        ## se tiver definido
/*        try {
            ## executa ações finais
            $stmt = $db->prepare("SELECT A.ACCOES_FINAIS ".
                                 "FROM DG_DET_GESTAO_DOCUMENTAL A, RH_ID_GESTAO_DOCUMENTAL B ".
                                 "WHERE B.ID_PROC_GD = :ID_PROC_GD_".
                                 "  AND A.CD_GD = B.CD_GD ".
                                 "  AND A.DT_INI_GD = B.DT_INI_GD ".
                                 "  AND A.CD_DET_GD = B.CD_DET_GD ".
                                 "  AND A.DT_INI_DET_GD = B.DT_INI_DET_GD ");
            $stmt->bindParam(':ID_PROC_GD_', $id_proc_gd_, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (strtoupper($row['ACCOES_FINAIS']) == 'GD_CRIA_VINCULO') {
                gd_cria_vinculo($id_proc_gd_, $msg);
            }

        } catch (PDOException $ex) {
            $msg = "gd_avalia_fase#2:" . $ex->getMessage();
        }*/

        $msg1 = '';
        try {
            $stmt = $db->prepare("UPDATE RH_ID_GESTAO_DOCUMENTAL ".
                                 "SET ACOES_FINAIS = 'S' , CHANGED_BY = :USR_REG_, DT_UPDATED = :DT_REG_ ".
                                 "WHERE ID_PROC_GD = :ID_PROC_GD_");
            $stmt->bindParam(':ID_PROC_GD_', $id_proc_gd_, PDO::PARAM_STR);
            if (@$_SESSION['utilizador'] != '') {
                $stmt->bindParam(':USR_REG_', @$_SESSION['utilizador'], PDO::PARAM_STR);
            } else {
                $usr_ = 'SCHED_AUTO';
                $stmt->bindParam(':USR_REG_', $usr_, PDO::PARAM_STR);
            }
            $stmt->bindParam(':DT_REG_', date("Y-m-d H:i:s"), PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $ex) {
            $msg1 = "gd_acoes_finais#1:" . $ex->getMessage();
        }
        $msg = trim($msg.$msg1);

    }

    #
    # Avalia e atualiza fase do registo de gestão documental
    #
    function gd_avalia_fase($id_proc_gd_, $nova_fase_, &$return_msg, &$msg) {

        global $db;

        $msg = "";
        $return_msg = "";
        $rhid = '';
        $seq = '';

        # determina a nova fase do registo
        if ($nova_fase_ == '') {
            try {
                $stmt = $db->prepare("SELECT B.TIPO, B.RHID, C.RV_MEANING ".
                                     "FROM RH_ID_GESTAO_DOCUMENTAL A, DG_GD_FASES B, CG_REF_CODES C ".
                                     "WHERE A.ID_PROC_GD = :ID_PROC_GD_ ".
                                     "  AND A.CD_GD = B.CD_GD ".
                                     "  AND A.DT_INI_GD = B.DT_INI_GD ".
                                     "  AND A.CD_DET_GD = B.CD_DET_GD ".
                                     "  AND A.DT_INI_DET_GD = B.DT_INI_DET_GD ".
                                     "  AND A.FASE < B.TIPO ".
                                     "  AND B.TIPO = C.RV_LOW_VALUE ".
                                     "  AND C.RV_DOMAIN = 'DG_TIPO_FASES_GD' ".
                                     "  AND B.DT_FIM IS NULL ".
                                     "ORDER BY 1 ");
                $stmt->bindParam(':ID_PROC_GD_', $id_proc_gd_, PDO::PARAM_STR);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $nova_fase_ = $row['TIPO'];
                $rhid_ = $row['RHID'];
            } catch (PDOException $ex) {
                $msg = "gd_avalia_fase#1:" . $ex->getMessage();
            }
        }
#echo "ID PROC:$id_proc_gd_ NOVA FASE : $nova_fase_<br/>";
        ## VALIDAÇÕES
        if ($nova_fase_ == 'B') {           # B - Validação Gestor Adm.
            $ref_doc_ = $nova_fase_;
            $dt_ref_doc_ = date("Y-m-d");
            gd_cria_linha_doc($id_proc_gd_, $ref_doc_, $dt_ref_doc_,'','','',$rhid_,$msg);
        } elseif ($nova_fase_ == 'C') {     # C - Validação Supervisor
            $ref_doc_ = $nova_fase_;
            $dt_ref_doc_ = date("Y-m-d");
            gd_cria_linha_doc($id_proc_gd_, $ref_doc_, $dt_ref_doc_, '','','',$rhid_,$msg);
        } elseif ($nova_fase_ == 'D') {     # D - Validação Diretor
            $ref_doc_ = $nova_fase_;
            $dt_ref_doc_ = date("Y-m-d");
            gd_cria_linha_doc($id_proc_gd_, $ref_doc_, $dt_ref_doc_, '','','',$rhid_,$msg);
        } elseif ($nova_fase_ == 'E') {     # E - Validação Gestor
            $ref_doc_ = $nova_fase_;
            $dt_ref_doc_ = date("Y-m-d");
            gd_cria_linha_doc($id_proc_gd_, $ref_doc_, $dt_ref_doc_, '','','',$rhid_,$msg);
        ## ASSINATURAS
        } elseif ($nova_fase_ == 'F') {     # F - Assinat. Colaborador
            $ref_doc_ = $nova_fase_;
            $dt_ref_doc_ = date("Y-m-d");
            gd_cria_linha_doc($id_proc_gd_, $ref_doc_, $dt_ref_doc_, '','','',$rhid_,$msg);
        } elseif ($nova_fase_ == 'G') {     # G - Assinat. Gestor Adm.
            $ref_doc_ = $nova_fase_;
            $dt_ref_doc_ = date("Y-m-d");
            gd_cria_linha_doc($id_proc_gd_, $ref_doc_, $dt_ref_doc_, '','','',$rhid_,$msg);
        } elseif ($nova_fase_ == 'H') {     # H - Assinat. Supervisor
            $ref_doc_ = $nova_fase_;
            $dt_ref_doc_ = date("Y-m-d");
            gd_cria_linha_doc($id_proc_gd_, $ref_doc_, $dt_ref_doc_, '','','',$rhid_,$msg);
        } elseif ($nova_fase_ == 'I') {     # I - Assinat. Diretor
            $ref_doc_ = $nova_fase_;
            $dt_ref_doc_ = date("Y-m-d");
            gd_cria_linha_doc($id_proc_gd_, $ref_doc_, $dt_ref_doc_, '','','',$rhid_,$msg);
        } elseif ($nova_fase_ == 'J') {     # J - Assinat. DRH
            $ref_doc_ = $nova_fase_;
            $dt_ref_doc_ = date("Y-m-d");
            gd_cria_linha_doc($id_proc_gd_, $ref_doc_, $dt_ref_doc_, '','','',$rhid_,$msg);

        ## APROVAÇÕES
        } elseif ($nova_fase_ == 'K') {     # K - Aprov. Gestor Adm.
            $ref_doc_ = $nova_fase_;
            $dt_ref_doc_ = date("Y-m-d");
            gd_cria_linha_doc($id_proc_gd_, $ref_doc_, $dt_ref_doc_, '','','',$rhid_,$msg);
        } elseif ($nova_fase_ == 'L') {     # L - Aprov. Supervisor
            $ref_doc_ = $nova_fase_;
            $dt_ref_doc_ = date("Y-m-d");
            gd_cria_linha_doc($id_proc_gd_, $ref_doc_, $dt_ref_doc_, '','','',$rhid_,$msg);
        } elseif ($nova_fase_ == 'M') {     # M - Aprov. Diretor
            $ref_doc_ = $nova_fase_;
            $dt_ref_doc_ = date("Y-m-d");
            gd_cria_linha_doc($id_proc_gd_, $ref_doc_, $dt_ref_doc_, '','','',$rhid_,$msg);
        } elseif ($nova_fase_ == 'N') {     # N - Aprov. Gestor
            $ref_doc_ = $nova_fase_;
            $dt_ref_doc_ = date("Y-m-d");
            gd_cria_linha_doc($id_proc_gd_, $ref_doc_, $dt_ref_doc_, '','','',$rhid_,$msg);
        ## APROVAÇÃO
        } elseif ($nova_fase_ == 'O') {     # N - APROVADO

            $dt_ini_vinculo = gd_get_var_value($id_proc_gd_, 'DT_INI_VINCULO', 'VALOR', $seq, $msg);

            # as ações finais só são exeecutadas na data de início do vínculo
            if (($dt_ini_vinculo == '' || $dt_ini_vinculo <= date("Y-m-d")) && $msg == '') {
            gd_acoes_finais($id_proc_gd_,$msg);
            }
        ## REJEIÇÃO
        } elseif ($nova_fase_ == 'P') {     # P - Rejeitado

            $dt_ref_doc_ = date("Y-m-d");
            $obs_ = "Rejeitado por ".@$_SESSION['utilizador']." em ".date("Y-m-d H:i");
            try {
                $stmt = $db->prepare("UPDATE RH_ID_GD_FASES ".
                                     "SET OBS = :OBS_, CHANGED_BY = :USR_REG_, DT_UPDATED = :DT_REG_ ".
                                     "WHERE (ID_PROC_GD, CD_GD, DT_INI_GD, CD_DET_GD, DT_INI_DET_GD, ID_FASE, DT_INI_REFERENCIA) IN ".
                                     "(SELECT B.ID_PROC_GD, A.CD_GD, A.DT_INI_GD, A.CD_DET_GD, A.DT_INI_DET_GD, A.ID_FASE, A.DT_INI ".
                                     " FROM `DG_GD_FASES` A, RH_ID_GESTAO_DOCUMENTAL B ".
                                     " WHERE B.ID_PROC_GD = :ID_PROC_GD_ ".
                                     "   AND A.CD_GD = B.CD_GD ".
                                     "   AND A.DT_INI_GD = B.DT_INI_GD ".
                                     "   AND A.CD_DET_GD = B.CD_DET_GD  ".
                                     "   AND A.DT_INI_DET_GD = B.DT_INI_DET_GD ".
                                     "   AND A.TIPO = :TIPO_) ");
                $stmt->bindParam(':ID_PROC_GD_', $id_proc_gd_, PDO::PARAM_STR);
                $stmt->bindParam(':OBS_', $obs_, PDO::PARAM_STR);
                $stmt->bindParam(':TIPO_', $nova_fase_, PDO::PARAM_STR);
                $stmt->bindParam(':USR_REG_', @$_SESSION['utilizador'], PDO::PARAM_STR);
                $stmt->bindParam(':DT_REG_', date("Y-m-d H:i:s"), PDO::PARAM_STR);

                $stmt->execute();
            } catch (PDOException $ex) {
                $msg = "gd_avalia_fase#3:" . $ex->getMessage();
            }

        }
        ## CANCELAMENTO
        elseif ($nova_fase_ == 'Z') {     # P - Cancelado

            $dt_ref_doc_ = date("Y-m-d");
            $obs_ = "Rejeitado por ".@$_SESSION['utilizador']." em ".date("Y-m-d H:i");
            try {
                $stmt = $db->prepare("UPDATE RH_ID_GD_FASES ".
                                     "SET OBS = :OBS_, CHANGED_BY = :USR_REG_, DT_UPDATED = :DT_REG_ ".
                                     "WHERE (ID_PROC_GD, CD_GD, DT_INI_GD, CD_DET_GD, DT_INI_DET_GD, ID_FASE, DT_INI_REFERENCIA) IN ".
                                     "(SELECT B.ID_PROC_GD, A.CD_GD, A.DT_INI_GD, A.CD_DET_GD, A.DT_INI_DET_GD, A.ID_FASE, A.DT_INI ".
                                     " FROM `DG_GD_FASES` A, RH_ID_GESTAO_DOCUMENTAL B ".
                                     " WHERE B.ID_PROC_GD = :ID_PROC_GD_ ".
                                     "   AND A.CD_GD = B.CD_GD ".
                                     "   AND A.DT_INI_GD = B.DT_INI_GD ".
                                     "   AND A.CD_DET_GD = B.CD_DET_GD  ".
                                     "   AND A.DT_INI_DET_GD = B.DT_INI_DET_GD ".
                                     "   AND A.TIPO = :TIPO_) ");
                $stmt->bindParam(':ID_PROC_GD_', $id_proc_gd_, PDO::PARAM_STR);
                $stmt->bindParam(':OBS_', $obs_, PDO::PARAM_STR);
                $stmt->bindParam(':TIPO_', $nova_fase_, PDO::PARAM_STR);
                $stmt->bindParam(':USR_REG_', @$_SESSION['utilizador'], PDO::PARAM_STR);
                $stmt->bindParam(':DT_REG_', date("Y-m-d H:i:s"), PDO::PARAM_STR);
                $stmt->execute();
            } catch (PDOException $ex) {
                $msg = "gd_avalia_fase#4:" . $ex->getMessage();
            }


        }

        # Finalização da elaboração do documento
        if ($id_proc_gd_ != '' && $nova_fase_ != '' && $msg == '') {

            try {
                $stmt = $db->prepare("UPDATE RH_ID_GD_DOCS ".
                                     "SET CHANGED_BY = :USR_REG_, DT_UPDATED = :DT_REG_ ".
                                     "WHERE ID_PROC_GD = :ID_PROC_GD_".
                                     "  AND (ID_PROC_GD, REF_DOC) IN (SELECT ID_PROC_GD, FASE FROM RH_ID_GESTAO_DOCUMENTAL WHERE ID_PROC_GD = :ID_PROC_GD_)");
                $stmt->bindParam(':ID_PROC_GD_', $id_proc_gd_, PDO::PARAM_STR);
                $stmt->bindParam(':USR_REG_', @$_SESSION['utilizador'], PDO::PARAM_STR);
                $stmt->bindParam(':DT_REG_', date("Y-m-d H:i:s"), PDO::PARAM_STR);
                $stmt->execute();
            } catch (PDOException $ex) {
                $msg = "gd_avalia_fase#5:" . $ex->getMessage();
            }

            try {
                $stmt = $db->prepare("UPDATE RH_ID_GESTAO_DOCUMENTAL ".
                                     "SET FASE = :FASE_ , CHANGED_BY = :USR_REG_, DT_UPDATED = :DT_REG_ ".
                                     "WHERE ID_PROC_GD = :ID_PROC_GD_");
                $stmt->bindParam(':ID_PROC_GD_', $id_proc_gd_, PDO::PARAM_STR);
                $stmt->bindParam(':FASE_', $nova_fase_, PDO::PARAM_STR);
                $stmt->bindParam(':USR_REG_', @$_SESSION['utilizador'], PDO::PARAM_STR);
                $stmt->bindParam(':DT_REG_', date("Y-m-d H:i:s"), PDO::PARAM_STR);
                $stmt->execute();
            } catch (PDOException $ex) {
                $msg = "gd_avalia_fase#6:" . $ex->getMessage();
            }

            $msg_1 = '';
            $value_ = $nova_fase_;
            $label_ = dsp_dominio ('DG_TIPO_FASES_GD', $value_, $msg_1);
            if ($label_ != '' && $value_ != '' && $msg_1 == '') {
                $return_msg = array("label" => $label_,"value" => $value_);
            }
        }

    }

    #
    # Cria documento a partir do template, substituíndo as máscaras
    #
    function gd_gera_documento($id_proc_gd_, $modo_, &$msg_svlr, &$msg, &$newMasterStatus) {

        global $ui_required;
        ## local físico de inicio da instalação
        $origem = str_replace("data-source","",__DIR__);

        require_once "$origem/classes/PHPWord.php";

        global $db;

        $msg = "";
        $msg_svlr = "";
        $msgOK = "";
        $tipo_fx = '';
        $newMasterStatus = '';

	##
        ## adiciona variáveis que possam ter sido adicionadas ao modelo posteriormente
        ##
	gd_cria_id_det_gd_variaveis($id_proc_gd_, 'UPDATE', $msg);

	if ($msg == '') {

	        ##
	        ## Validação do preenchimento de todas as variáveis associadas ao processo
	        ##
	        try {
	            $stmt = $db->prepare("SELECT A.ID_PROC_GD, B.SEQ ".
	                                 "FROM RH_ID_GESTAO_DOCUMENTAL A, RH_ID_GD_VARIAVEIS B, DG_DEF_VARIAVEIS C ".
	                                 "WHERE A.ID_PROC_GD = :ID_PROC_GD_ ".
	                                 "  AND B.ID_PROC_GD = A.ID_PROC_GD ".
	                                 "  AND (B.VALOR IS NULL OR B.VALOR = '') ".
	                                 "  AND B.COD_VAR = C.COD_VAR ".
	                                 "  AND B.DT_INI_VAR = C.DT_INI_VAR ".
	                                 "  AND C.TIPO IN ('A','B') ");

	            $stmt->bindParam(':ID_PROC_GD_', $id_proc_gd_, PDO::PARAM_STR);
	            $stmt->execute();

	            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	                $seq = $row['SEQ'];
	                if ($msg_svlr == '') {
	                    $msg_svlr = '{"seq":"'.$id_proc_gd_.$seq.'","msg":"'.$ui_required.'"}';
	                } else {
	                    $msg_svlr .= ",".'{"seq":"'.$id_proc_gd_.$seq.'","msg":"'.$ui_required.'"}';
	                }

	            }

	            if ($msg_svlr != '') {
	                $msg_svlr = "[$msg_svlr]";
	            }

	        } catch (PDOException $ex) {
	            $msg = "gd_gera_documento#1 :" . $ex->getMessage();
	        }

                if ($msg == '' && $msg_svlr == '') {
	            $templatefile = ''; ##tmp/template_dk.docx';
	            $filename = ''; ##tmp/contrato.docx';
	            $dir_doc = 'tmp';
	            $nr_docs = 0;
	            try {
	                $stmt = $db->prepare("SELECT A.ID_PROC_GD, A.EMPRESA, A.RHID, A.DT_ADMISSAO, B.CD_GD, B.DT_INI_DET_GD, B.CD_DET_GD, B.DT_INI_GD, ".
	                                     " B.CD_TEMPLATE, B.DSP, B.DESCRICAO, B.BD_DOC, B.BD_MIME, B.LINK_DOC, A.FASE ".
	                                     "FROM RH_ID_GESTAO_DOCUMENTAL A, DG_GD_TEMPLATES B ".
	                                     "WHERE A.ID_PROC_GD = :ID_PROC_GD_ ".
	                                     "  AND A.CD_GD = B.CD_GD ".
	                                     "  AND A.DT_INI_GD = B.DT_INI_GD ".
	                                     "  AND A.CD_DET_GD = B.CD_DET_GD ".
	                                     "  AND A.DT_INI_DET_GD = B.DT_INI_DET_GD ".
	                                     "  AND B.DT_FIM IS NULL ");

	                $stmt->bindParam(':ID_PROC_GD_', $id_proc_gd_, PDO::PARAM_STR);
	                $stmt->execute();
	            } catch (PDOException $ex) {
	                $msg = "gd_gera_documento#2 :" . $ex->getMessage();
	            }
	            if ($msg == '') {
	                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                            if ($row['FASE'] == 'A') {

	                        $nr_docs += 1;
	                        $ext = $row['BD_MIME'];
	                        $rand = rand(1000,6000);
	                        $filename = "$dir_doc/doc_$id_proc_gd_"."_$rand.$ext";

	                        ## template em ficheiro
	                        if ($row['BD_DOC'] != '') {
	                            $templatefile = "$dir_doc/template_$id_proc_gd_"."_$rand.$ext";
	                            if (file_exists($origem.$templatefile)) {
	                                unlink($origem.$templatefile);
	                            }
	                            $handle = fopen($origem.$templatefile, 'x');
	                            fwrite($handle, $row['BD_DOC']);
	                            fclose($handle);
	                            $tipo_fx = 'BD';
	                        } elseif ($row['LINK_DOC'] != '') {
	                            $templatefile = $row['LINK_DOC'];
	                            $tipo_fx = 'FILE';
	                        }

	                        if ($templatefile != '' && $filename != '' && strtoupper(substr($ext, 0, 3)) == 'DOC') {

	                            try {

	                                ## deverá ser usada esta classe PCLZIP em detrimento da standar
	                                ## para tratar corretamente a abertura de todo o tipo de DOC e DOCX.
#                                \PhpOffice\PhpWord\Settings::setZipClass(\PhpOffice\PhpWord\Settings::PCLZIP);

	                                # Criação de novo documento...
	                                $phpWord = new \PhpOffice\PhpWord\PhpWord();

	                                # Carregando template para esse documento
	                                $templateWord = $phpWord->loadTemplate($origem.$templatefile);


	                                # removendo ficheiro existente
	                                if (file_exists($origem.$filename)) {
	                                    unlink($origem.$filename);
	                                }

	                                $templateWord->saveAs($origem.$filename);

	                                # Ativando mecânismo de pesquisa
	                                $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($origem.$filename);

	                                # obtem máscaras contidas no ficheiro, carregando array máscara com [mascara doc,nome variavel,tipo,designação]
	                                $mascaras = gd_get_doc_masks($origem.$templatefile, $msg);

	                                # valida máscaras existente no template
	                                gd_valida_mascaras($mascaras, $msg);

	                                if ($msg == '') {

	                                    gd_calcula_var_auto($id_proc_gd_, $msg);

                                            ## segundo cálculo para garantir recorrência de variáveis
	                                    gd_calcula_var_auto($id_proc_gd_, $msg);

	                                    if ($msg == '') {
	                                        foreach ($mascaras as $mascara) {
	                                            $vlr = '';
	                                            $seq = '';
	                                            if ($mascara[2] == 'MASCARA') {
	                                                $vlr = gd_get_mask_value($id_proc_gd_,$mascara[1], $seq, $msg);
	                                            } elseif ($mascara[2] == 'VARIAVEL') {
	                                                $vlr = gd_get_var_value($id_proc_gd_,$mascara[1], 'DSP', $seq, $msg);
	                                            }
#echo "msk:[" . $mascara[0] . "] var:[" . $mascara[1] . "] tipo:[".$mascara[2]."] dsp:[".$mascara[3]."] valor:[<b>$vlr</b>] <br/>";
	                                            # subtituição da máscara ${xxx} por valor
	                                            if ($vlr != '') {
                                                        #
                                                        # Implementação da colocação de newlines no texto
                                                    	# https://github.com/PHPOffice/PHPWord/issues/838
                                                        #
							$vlr = str_replace(chr(13).chr(10),"</w:t><w:br/><w:t>",$vlr);
                                                        # existem circuntâncias em que os CR não têm LF
							$vlr = str_replace(chr(10),"</w:t><w:br/><w:t>",$vlr);
	                                                $templateProcessor->setValue($mascara[0], $vlr);
	                                            } else {
	                                                if ($msg == '') {
	                                                    $msg = "Variável automática: ".$mascara[1]." sem valor definido.";
	                                                } else {
	                                                    $msg = $msg." Variável automática: ".$mascara[1]." sem valor definido.";
	                                                }
	                                            }
	                                        }
	                                    }

	                                }

	                                if ($modo_ != 'VALIDAR' && $msg == '') {

	                                    # Gravação do documento
	                                    if ($msg == '') {
	                                        $templateProcessor->saveAs($origem.$filename);
	                                    }

	                                    ## GERAÇÃO DE PDF

	                             #       $fileNamePDF = 'tmp/contrato.pdf';
	                             #       echo "#6 - conversão PDF<br/>";
	                             #       $domPdfPath = realpath(__DIR__) . '/classes/PHPWord/vendor/dompdf/dompdf';

	                             #       \PhpOffice\PhpWord\Settings::setPdfRendererPath($domPdfPath);
	                             #       \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');

	                             #       $phpWord = \PhpOffice\PhpWord\IOFactory::load($fileName);
	                             #       $pdfWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'PDF');
	                             #       $pdfWriter->save($fileNamePDF);

	                                    if ($msg == '') {

	                                        # FASES DE WORKFLOW
	                                        #
	                                        # A - Elaboração
	                                        # B - Validação Gestor Adm.
	                                        # C - Validação Supervisor
	                                        # D - Validação Diretor
	                                        # E - Validação Gestor
	                                        # F - Assinatura Colaborador
	                                        # G - Assinatura Gestor Adm.
	                                        # H - Assinatura Supervisor
	                                        # I - Assinatura Diretor
	                                        # J - Assinatura DRH
	                                        # K - Aprovação Gestor Adm.
	                                        # L - Aprovação Supervisor
	                                        # M - Aprovação Diretor
	                                        # N - Aprovação Gestor
	                                        # O - Aprovado
	                                        # P - Rejeitado
	                                        # Z - Cancelado
	                                        #
	                                        try {
	                                            $stmt1 = $db->prepare("DELETE FROM RH_ID_GD_DOCS WHERE ID_PROC_GD = :ID_PROC_GD_");
	                                            $stmt1->bindParam(':ID_PROC_GD_', $id_proc_gd_, PDO::PARAM_STR);
	                                            $stmt1->execute();
	                                        } catch (PDOException $ex) {
	                                            $msg = "gd_gera_documento#3 :" . $ex->getMessage();
	                                        }

                                                if ($msg == '') {
	                                            try {
	                                                $stmt1 = $db->prepare("SELECT A.ID_PROC_GD, A.ID, A.DT_INI, A.DT_FIM, A.USR_DESTINATARIO, A.OBS, ".
	                                                                      " B.TIPO ID_TP_FASE, B.RHID, C.RV_MEANING DSP_TP_FASE ".
	                                                                      "FROM RH_ID_GD_FASES A, DG_GD_FASES B, CG_REF_CODES C ".
	                                                                      "WHERE A.ID_PROC_GD = :ID_PROC_GD_ ".
	                                                                      "  AND B.CD_GD = A.CD_GD ".
	                                                                      "  AND B.DT_INI_GD = A.DT_INI_GD ".
	                                                                      "  AND B.CD_DET_GD = A.CD_DET_GD ".
	                                                                      "  AND B.DT_INI_DET_GD = A.DT_INI_DET_GD  ".
	                                                                      "  AND B.ID_FASE = A.ID_FASE ".
	                                                                      "  AND B.DT_INI = A.DT_INI_REFERENCIA ".
	                                                                      "  AND C.RV_DOMAIN = 'DG_TIPO_FASES_GD' ".
	                                                                      "  AND C.RV_LOW_VALUE = B.TIPO ".
	                                                                      "ORDER BY B.TIPO ");

	                                                $stmt1->bindParam(':ID_PROC_GD_', $id_proc_gd_, PDO::PARAM_STR);
	                                                $stmt1->execute();
	                                            } catch (PDOException $ex) {
	                                                $msg = "gd_gera_documento#4 :" . $ex->getMessage();
	                                            }
	                                        }

                                                $fase_apos_elaboracao = 'N';
	                                        if ($msg == '') {
	                                            while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
#echo "#5 gera [".$row1['ID_TP_FASE'].",".$row1['DSP_TP_FASE']."] <br/>";
	                                                #
	                                                # Cria registo de documento
	                                                #

	                                                $ref_doc_ = '';
	                                                $dt_ref_doc_ = date("Y-m-d");
	                                                $ficheiro_ = '';
	                                                $blob_ = '';
	                                                $mime_ = '';
	                                                $rhid = '';
	                                                $insere = false;

	                                                if ($row1['ID_TP_FASE'] == 'A' ) { # A - Em elaboração

	                                                    if ($filename != '') {
	                                                        $mime_ = pathinfo($filename,PATHINFO_EXTENSION);

	                                                        ## carregar blob para inserir na base de dados
	                                                        if ($tipo_fx == 'BD') {
	                                                            $blob_ = fopen($origem.$filename, 'rb');
	                                                            $ficheiro_ = $filename;
	                                                        } else {
	                                                            $ficheiro_ = $origem.$filename;
	                                                        }
	                                                    }

	                                                    $ref_doc_ = $row1['ID_TP_FASE'];
	                                                    $dt_ref_doc_ = date("Y-m-d");
	                                                    $rhid = $row1['RHID'];
	                                                    $insere = true;

	                                                } elseif ($row1['ID_TP_FASE'] == 'F' ) { # B - Recolha assinatura Colaborador
	                                                    $ref_doc_ = $row1['DSP_TP_FASE'];
	                                                    $dt_ref_doc_ = date("Y-m-d");
	                                                    $rhid = $row1['RHID'];
	                                                    $insere = false;
	                                                } elseif ($row1['ID_TP_FASE'] == 'G' ) { # C - Recolha assinatura Gestor Administrativo
	                                                    $ref_doc_ = $row1['DSP_TP_FASE'];
	                                                    $dt_ref_doc_ = date("Y-m-d");
	                                                    $rhid = $row1['RHID'];
	                                                    $insere = false;
	                                                } elseif ($row1['ID_TP_FASE'] == 'H' ) { # D - Recolha assinatura Supervisor
	                                                    $ref_doc_ = $row1['DSP_TP_FASE'];
	                                                    $dt_ref_doc_ = date("Y-m-d");
	                                                    $rhid = $row1['RHID'];
	                                                    $insere = false;
	                                                } elseif ($row1['ID_TP_FASE'] == 'I' ) { # E - Recolha assinatura Diretor
	                                                    $ref_doc_ = $row1['DSP_TP_FASE'];
	                                                    $dt_ref_doc_ = date("Y-m-d");
	                                                    $rhid = $row1['RHID'];
	                                                    $insere = false;
	                                                } elseif ($row1['ID_TP_FASE'] == 'J' ) { # F - Recolha assinatura DRH
	                                                    $ref_doc_ = $row1['DSP_TP_FASE'];
	                                                    $dt_ref_doc_ = date("Y-m-d");
	                                                    $rhid = $row1['RHID'];
	                                                    $insere = false;
	                                                }

	                                                # atualiza o estado do documento correspondente à finalização da fase de ELABORAÇÃO DO DOCUMENTO
	                                                # ou seja, na próxima fase
	        #                                        if ($fase_apos_elaboracao == '' && $row1['ID_TP_FASE'] != 'A') {
	        #                                            $fase_apos_elaboracao = $row1['ID_TP_FASE'];
	        #                                            gd_avalia_fase($id_proc_gd_, $fase_apos_elaboracao, $newMasterStatus,$msg);
	        #                                        }

	                                                ## insere registo de documento
	                                                if ($insere) {

	                                                    $fase_apos_elaboracao = 'S';

	                                                    ## cria linha(s) de documento associado ao estado processual do DOCUMENTO
	                                                    gd_cria_linha_doc($id_proc_gd_, $ref_doc_, $dt_ref_doc_, $mime_, $blob_, $ficheiro_,$rhid_,$msg);

	                                                    ## remove ficheiro criado para suporte ao blob_
	                                                    if ($tipo_fx == 'BD') {
	                                                        unlink($origem.$filename);
	                                                    }

	                                                }

	                                            } # ciclo percorre registos de workflow
	                                        }

                                                # coloca o processo de gestão documental numa nova fase
	                                        if ($fase_apos_elaboracao == 'S' && $msg == '') {
	                                            gd_avalia_fase($id_proc_gd_, '', $newMasterStatus, $msg);
	                                        }

	                                    }
	                                }

	                               ## remover o template que já não serve
	                               #unlink($origem.$templatefile);

	                            } catch (Exception $e) {
	                                $msg = "gd_gera_documento#5 [$origem$filename] :" . $e->getMessage();
	                            }

	                            if ($modo_ == 'DEBUG' && $msg == '') {
	                                if ($msg == '') {
	                                    echo "<br/><br/>##############################################<br/>";
	                                    echo "DOCUMENTOS DISPONIBILIZADOS:<br/>";

	                                    try {
	                                        $stmt5 = $db->query("SELECT ID_DOC FROM RH_ID_GD_DOCS WHERE ID_PROC_GD = $id_proc_gd_ ORDER BY 1 DESC");
	                                        $row5 = $stmt5->fetch(PDO::FETCH_ASSOC);
	                                        echo '<br/><a target="_blank" href="//wips.com.pt/demo/v2/data-source/quad_controller_download.php?tab=RH_ID_GD_DOCS&id=' . $id_proc_gd_.'@'. $row3['ID_DOC']. '">Contrato - DOCX</a>';
	                                    } catch (PDOException $ex) {
	                                        echo "erro#2:" . $ex->getMessage();
	                                    }
	                                } else {
	                                    echo "Erro na produção do documento: $msg<br/>";
	                                }
	                            }

	                        } ## templatefile != '' and filename != ''
	                        elseif (strtoupper (substr($ext, 0, 3)) != 'DOC') {
	                            $msg = "O template associado ao documento deverá ser em formato DOC ou DOCX.";
	                            break;
	                        }
	                    }
	                    else {
	                        $msg = "O processo não se encontra em fase de Elaboração, pelo que não pode ser submetido.";
	                        break;
	                    }

	                } ## while
	            }
	        }

	        if ($nr_docs == 0 && $modo_ != 'VALIDAR' && $msg == '' && $msg_svlr == '') {
	            $msg = 'Não existe documento associado. Verifique a parametrização do documento.';
	        }
        }
    }


    ##
    ## Geração massiva de documentos - macro-processos
    ##

    #
    # Cria registo de cabeçalho do macro-processo
    function gd_cria_hdr_auto($fase_, $empresa_, $cd_gd_, $dt_ini_gd_, $cd_det_gd_, $dt_ini_det_gd_, $renov_, &$msg) {

        global $db;
        $msg = '';
        try {
            $stmt = $db->prepare("INSERT INTO DG_GD_HDR_AUTO" .
                                 "(EMPRESA,FASE_FINAL,CD_GD, DT_INI_GD, CD_DET_GD, DT_INI_DET_GD, RENOV) ".
                                 "VALUES(:EMPRESA_, :FASE_FINAL_,:CD_GD_,:DT_INI_GD_,:CD_DET_GD_,:DT_INI_DET_GD_,:RENOV_)");

            $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
            $stmt->bindParam(':FASE_FINAL_', $fase_, PDO::PARAM_STR);
            $stmt->bindParam(':RENOV_', $renov_, PDO::PARAM_STR);
            $stmt->bindParam(':CD_GD_', $cd_gd_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_GD_', $dt_ini_gd_, PDO::PARAM_STR);
            $stmt->bindParam(':CD_DET_GD_', $cd_det_gd_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_INI_DET_GD_', $dt_ini_det_gd_, PDO::PARAM_STR);

            $stmt->execute();

            $rowid = $db->lastInsertId();

            return $rowid;

        } catch (PDOException $ex) {
            $msg = "gd_cria_hdr_auto#1:" . $ex->getMessage();
        }
    }

    #
    # Cria registo de detalhe de do macro-processo
    function gd_cria_det_auto($id_hdr_, $empresa_, $acao_, &$msg) {

        global $db;
        global $ui_chose_option;
        $nulo = null;

        # remover variáveis já existentes
        if ($acao_ == 'INSERT') {
            try {
                $stmt = $db->prepare("DELETE FROM DG_GD_DET_AUTO " .
                                     "WHERE ID = :ID_ ");
                $stmt->bindParam(':ID_', $id_hdr_, PDO::PARAM_STR);
                $stmt->execute();
            } catch (PDOException $ex) {
                $msg = "gd_cria_det_auto - erro#0 :" . $ex->getMessage();
            }
        }
        # criar variáveis a partir da definição do template de documento
        try {
            if ($acao_ == 'INSERT') {

                $stmt = $db->prepare("SELECT A.ID, B.CD_GD, B.DT_INI_DET_GD, B.CD_DET_GD, B.DT_INI_GD, " .
                                     " B.COD_VAR, B.DT_INI_VAR, B.DT_INI_FRM, B.VISUALIZA , C.LABEL, C.TIPO, C.QUAD_SQL_REF, C.TIPO_DADOS, C.VALOR_MIN, C.VALOR_MAX, C.INCREMENTOS " .
                                     "FROM DG_GD_HDR_AUTO A, DG_GD_VARIAVEIS B, DG_DEF_VARIAVEIS C " .
                                     "WHERE A.ID = :ID_ " .
                                     "  AND C.COD_VAR = B.COD_VAR " .
                                     "  AND C.DT_INI_VAR = B.DT_INI_VAR " .
                                     "  AND A.CD_GD = B.CD_GD " .
                                     "  AND A.DT_INI_GD = B.DT_INI_GD " .
                                     "  AND A.CD_DET_GD = B.CD_DET_GD " .
                                     "  AND A.DT_INI_DET_GD = B.DT_INI_DET_GD ".
                                     "  AND B.DT_FIM IS NULL ");

                $stmt->bindParam(':ID_', $id_hdr_, PDO::PARAM_STR);
                $stmt->execute();

            } elseif ($acao_ == 'UPDATE') {

                $stmt = $db->prepare("SELECT A.ID, B.CD_GD, B.DT_INI_DET_GD, B.CD_DET_GD, B.DT_INI_GD, " .
                                     " B.COD_VAR, B.DT_INI_VAR, B.DT_INI_FRM, B.VISUALIZA , C.LABEL, C.TIPO, C.QUAD_SQL_REF, C.TIPO_DADOS, C.VALOR_MIN, C.VALOR_MAX, C.INCREMENTOS " .
                                     "FROM DG_GD_HDR_AUTO A, DG_GD_VARIAVEIS B, DG_DEF_VARIAVEIS C " .
                                     "WHERE A.ID = :ID_ " .
                                     "  AND C.COD_VAR = B.COD_VAR " .
                                     "  AND C.DT_INI_VAR = B.DT_INI_VAR " .
                                     "  AND A.CD_GD = B.CD_GD " .
                                     "  AND A.DT_INI_GD = B.DT_INI_GD " .
                                     "  AND A.CD_DET_GD = B.CD_DET_GD " .
                                     "  AND A.DT_INI_DET_GD = B.DT_INI_DET_GD ".
                                     "  AND B.DT_FIM IS NULL ".
                                     "  AND (B.CD_GD, B.DT_INI_DET_GD, B.CD_DET_GD, B.DT_INI_GD, B.COD_VAR, B.DT_INI_VAR, B.DT_INI_FRM) NOT IN ".
                                     "      (SELECT X.CD_GD, X.DT_INI_DET_GD, X.CD_DET_GD, X.DT_INI_GD, X.COD_VAR, X.DT_INI_VAR, X.DT_INI_FRM ".
                                     "       FROM DG_GD_DET_AUTO X ".
                                     "       WHERE X.ID = :ID_)");

                $stmt->bindParam(':ID_', $id_hdr_, PDO::PARAM_STR);
                $stmt->execute();
            }

        } catch (PDOException $ex) {
            $msg = "gd_cria_det_auto - erro#1 :" . $ex->getMessage();
        }

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            try {
                $html_content_ = '';
                $html_hint_ = '';

                ## variáveis do tipo LISTA
                if ($row['TIPO'] == 'A' && $row['QUAD_SQL_REF'] != '') { # Lista
                    $stmt2 = $db->prepare($row['QUAD_SQL_REF']);
                    if (strpos($row['QUAD_SQL_REF'], ":EMPRESA") != false)
                        $stmt2->bindParam(':EMPRESA', $empresa_, PDO::PARAM_STR);
/*                    if (strpos($row['QUAD_SQL_REF'], ":RHID") != false)
                        $stmt2->bindParam(':RHID', $row['RHID'], PDO::PARAM_STR);
                    if (strpos($row['QUAD_SQL_REF'], ":DT_ADMISSAO") != false)
                        $stmt2->bindParam(':DT_ADMISSAO', $row['DT_ADMISSAO'], PDO::PARAM_STR);*/
                    if (strpos($row['QUAD_SQL_REF'], ":CD_GD") != false)
                        $stmt2->bindParam(':CD_GD', $row['CD_GD'], PDO::PARAM_STR);
                    if (strpos($row['QUAD_SQL_REF'], ":DT_INI_GD") != false)
                        $stmt2->bindParam(':DT_INI_GD', $row['DT_INI_GD'], PDO::PARAM_STR);
                    if (strpos($row['QUAD_SQL_REF'], ":CD_DET_GD") != false)
                        $stmt2->bindParam(':CD_DET_GD', $row['CD_DET_GD'], PDO::PARAM_STR);
                    if (strpos($row['QUAD_SQL_REF'], ":DT_INI_DET_GD") != false)
                        $stmt2->bindParam(':DT_INI_DET_GD', $row['DT_INI_DET_GD'], PDO::PARAM_STR);

                    $stmt2->execute();
                    $nr_elem = 0;
                    $html_content_ = '';
                    while ($row2 = $stmt2->fetch(PDO::FETCH_NUM)) {
                        $nr_elem += 1;
                        $dsp_ = $row2[0];
                        $cd_ = $row2[1];
                        $html_content_ .= '<option value="' . $cd_ . '">' . $dsp_ . '</option>';
                    }

                    if ($nr_elem > 5) {
                        $html_content_ = '<select id="' . $row['COD_VAR'] . '" size="1" class="chosen gd_var" data-placeholder="'.$ui_chose_option.'"> ' .
                                         '<option value=""></option>'.
                                         $html_content_.
                                         '</select>';
                    } else {
                        $html_content_ = '<select id="' . $row['COD_VAR'] . '" size="1" class="gd_var"> ' .
                                         '<option value=""></option>'.
                                         $html_content_.
                                         '</select>';
                    }

#echo "#LISTA -> [COD_VAR:" . $row['COD_VAR'] . " label:" . $row['LABEL'] . " QUAD_SQL_REF:" . $row['QUAD_SQL_REF'] . "]</br>";

                ## variáveis do tipo INPUT
                } elseif ($row['TIPO'] == 'B') { # Input
                    $html_content_ = '<div class="form-group">' .
                            '   <div class="input-group">';

                    if ($row['TIPO_DADOS'] == 'A') { # Alfanumérico
                        # required
                        $html_content_ .= '<input id="' . $row['COD_VAR'] . '" class="form-control gd_var"  type="text" ' .
                                'onclick="myFunction(this, event)" onchange="LineValidation(this)">';
                    }
                    elseif ($row['TIPO_DADOS'] == 'B') { # Data
                        # required
                        $html_content_ .= '<input id="' . $row['COD_VAR'] . '" class="datepicker inline form-control gd_var"  type="text" placeholder="YYYY-MM-DD" ' .
                                'onclick="myFunction(this, event)" onchange="LineValidation(this)">' .
                                '<span class="input-group-addon"><i class="fa fa-calendar"></i></span>';
                    }
                    elseif ($row['TIPO_DADOS'] == 'C') { # Numérico
                        # required
                        $html_content_ .= '<input id="' . $row['COD_VAR'] . '" class="form-control gd_var"  type="number" ';

                        if ($row['VALOR_MIN'] != '') {
                            $html_content_ .= 'min="' . $row['VALOR_MIN'] . '" ';
                        }

                        if ($row['VALOR_MAX'] != '') {
                            $html_content_ .= 'max="' . $row['VALOR_MAX'] . '" ';
                        }

                        if ($row['INCREMENTOS'] != '') {
                            $html_content_ .= 'step="' . $row['INCREMENTOS'] . '" ';
                        }

                        $html_content_ .= 'onclick="myFunction(this, event)" onchange="LineValidation(this)" ' .
                                'autocomplete="off">';
                    }
                    elseif ($row['TIPO_DADOS'] == 'D') { # Moeda
                        $html_content_ .= '<input id="' . $row['COD_VAR'] . '" class="form-control gd_var"  type="number" ';

                        if ($row['VALOR_MIN'] != '') {
                            $html_content_ .= 'min="' . $row['VALOR_MIN'] . '" ';
                        }

                        if ($row['VALOR_MAX'] != '') {
                            $html_content_ .= 'max="' . $row['VALOR_MAX'] . '" ';
                        }

                        if ($row['INCREMENTOS'] != '') {
                            $html_content_ .= 'step="' . $row['INCREMENTOS'] . '" ';
                        }

                        $html_content_ .= 'onclick="myFunction(this, event)" onchange="LineValidation(this)" ' .
                                          'autocomplete="off">';

                        $html_content_ .= '<span class="input-group-addon">€</span>';
                    }

                    $html_content_ .= '    </div>' .
                                      '</div>';

                ## variáveis do tipo AUTOMÁTICO
                } elseif ($row['TIPO'] == 'C') { # Automático
                } elseif ($row['TIPO'] == 'Z') { # Pré-validação
                }

                $stmt2 = $db->prepare("INSERT INTO DG_GD_DET_AUTO " .
                                      "(ID, CD_GD, DT_INI_DET_GD, CD_DET_GD, DT_INI_GD, COD_VAR, DT_INI_VAR, DT_INI_FRM, " .
                                      " SEQ, VISUALIZA, LABEL, HTML_CONTENT, HTML_HINT, VALOR) " .
                                      "VALUES(:ID_,:CD_GD_,:DT_INI_DET_GD_,:CD_DET_GD_,:DT_INI_GD_,:COD_VAR_,:DT_INI_VAR_,:DT_INI_FRM_," .
                                      " 0,:VISUALIZA_,:LABEL_,:HTML_CONTENT_,:HTML_HINT_,NULL)");

                $stmt2->bindParam(':ID_', $id_hdr_, PDO::PARAM_STR);
                $stmt2->bindParam(':CD_GD_', $row['CD_GD'], PDO::PARAM_STR);
                $stmt2->bindParam(':DT_INI_GD_', $row['DT_INI_GD'], PDO::PARAM_STR);
                $stmt2->bindParam(':CD_DET_GD_', $row['CD_DET_GD'], PDO::PARAM_STR);
                $stmt2->bindParam(':DT_INI_DET_GD_', $row['DT_INI_DET_GD'], PDO::PARAM_STR);
                $stmt2->bindParam(':COD_VAR_', $row['COD_VAR'], PDO::PARAM_STR);
                $stmt2->bindParam(':DT_INI_VAR_', $row['DT_INI_VAR'], PDO::PARAM_STR);
                $stmt2->bindParam(':DT_INI_FRM_', $row['DT_INI_FRM'], PDO::PARAM_STR);
                $stmt2->bindParam(':VISUALIZA_', $row['VISUALIZA'], PDO::PARAM_STR);
                $stmt2->bindParam(':LABEL_', $row['LABEL'], PDO::PARAM_STR);

                if ($html_content_ == '') {
                    $stmt2->bindParam(':HTML_CONTENT_', $nulo, PDO::PARAM_STR);
                } else {
                    $stmt2->bindParam(':HTML_CONTENT_', $html_content_, PDO::PARAM_STR);
                }

                if ($html_hint_ == '') {
                    $stmt2->bindParam(':HTML_HINT_', $nulo, PDO::PARAM_STR);
                } else {
                    $stmt2->bindParam(':HTML_HINT_', $html_hint_, PDO::PARAM_STR);
                }

                $result = $stmt2->execute();
                
            } catch (PDOException $ex) {
                $msg = "gd_cria_det_auto - erro#2:" . $ex->getMessage();
                echo "erro:$msg";
            }
        }
    }


    #
    # Atribuição automática de um template de emissão a um colaborador
    function gd_atrib_template($id_hdr_, $empresa_, $rhid_, $dt_adm_, $valida_, &$msg) {

        global $db;
        $msg = '';
        $auto_term = '';
        $msg_svlr = '';

        if ($valida_ == 'S') {
            gd_valida_macro_proc($id_hdr_, $msg_svlr, $auto_term, $msg);
            if (msg != '' || $msg_svlr != '') {
                if ($msg_svlr != '') {
                    $msg = "Deve preencher os atributos do modelo.";
                }
            }
        }

        ##
        ## Atribuí documento ao colaborador
        ##
        if ($msg == '') {

            try {
                $stmt = $db->prepare("SELECT A.ID, A.FASE_FINAL, A.CD_GD, A.DT_INI_GD, A.CD_DET_GD, A.DT_INI_DET_GD ".
                                     "FROM DG_GD_HDR_AUTO A " .
                                     "WHERE A.ID = :ID_ ");

                $stmt->bindParam(':ID_', $id_hdr_, PDO::PARAM_STR);
                $stmt->execute();

            } catch (PDOException $ex) {
                $msg = "gd_atrib_template#1 :" . $ex->getMessage();
            }

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                ## cria cabeçalho de gestão documental
                $ref_interna_ = '';
                $obs_ = '';
                $fase_ = 'A';
                $dt_ini_ = date("Y-m-d");

                try {
                    $stmt1 = $db->prepare("INSERT INTO RH_ID_GESTAO_DOCUMENTAL " .
                                         "(DT_INI, CD_GD, DT_INI_GD, CD_DET_GD, DT_INI_DET_GD, EMPRESA, RHID, DT_ADMISSAO, FASE, DT_FIM, REF_INTERNA , OBS, ID_HDR_AUTO) ".
                                          "VALUES(:DT_INI_, :CD_GD_, :DT_INI_GD_, :CD_DET_GD_, :DT_INI_DET_GD_, :EMPRESA_, :RHID_, :DT_ADMISSAO_, :FASE_, NULL, :REF_INTERNA_ , :OBS_, :ID_HDR_AUTO_)");

                    $stmt1->bindParam(':DT_INI_', $dt_ini_, PDO::PARAM_STR);
                    $stmt1->bindParam(':CD_GD_', $row['CD_GD'], PDO::PARAM_STR);
                    $stmt1->bindParam(':DT_INI_GD_', $row['DT_INI_GD'], PDO::PARAM_STR);
                    $stmt1->bindParam(':CD_DET_GD_', $row['CD_DET_GD'], PDO::PARAM_STR);
                    $stmt1->bindParam(':DT_INI_DET_GD_', $row['DT_INI_DET_GD'], PDO::PARAM_STR);
                    $stmt1->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                    $stmt1->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
                    $stmt1->bindParam(':DT_ADMISSAO_', $dt_adm_, PDO::PARAM_STR);
                    $stmt1->bindParam(':FASE_', $fase_, PDO::PARAM_STR);

                    if ($ref_interna_ == '') {
                        $stmt1->bindParam(':REF_INTERNA_', $ref_interna_ = null, PDO::PARAM_STR);
                    } else {
                        $stmt1->bindParam(':REF_INTERNA_', $ref_interna_, PDO::PARAM_STR);
                    }

                    if ($html_content_ == '') {
                        $stmt1->bindParam(':OBS_', $obs_ = null, PDO::PARAM_STR);
                    } else {
                        $stmt1->bindParam(':OBS_', $obs_, PDO::PARAM_STR);
                    }

                    $stmt1->bindParam(':ID_HDR_AUTO_', $id_hdr_, PDO::PARAM_STR);

                    $stmt1->execute();
                } catch (PDOException $ex) {
                    $msg = "gd_cria_hdr_auto#2:" . $ex->getMessage();
                }

                ## cria variáveis com valores preenchidos a partir do template
                try {
                    $stmt1 = $db->prepare("INSERT INTO RH_ID_GD_VARIAVEIS ".
                                          "(ID_PROC_GD, CD_GD, DT_INI_DET_GD, CD_DET_GD, DT_INI_GD, COD_VAR, DT_INI_VAR, DT_INI_FRM, VISUALIZA, LABEL, HTML_CONTENT, HTML_HINT, VALOR) ".
                                          "SELECT A.ID_PROC_GD, A.CD_GD, A.DT_INI_DET_GD, A.CD_DET_GD, A.DT_INI_GD, B.COD_VAR, B.DT_INI_VAR, B.DT_INI_FRM, B.VISUALIZA, B.LABEL, B.HTML_CONTENT, B.HTML_HINT, B.VALOR ".
                                          "FROM RH_ID_GESTAO_DOCUMENTAL A, DG_GD_DET_AUTO B ".
                                          "WHERE A.ID_HDR_AUTO = :ID_HDR_AUTO_ ".
                                          "  AND B.ID = A.ID_HDR_AUTO ".
                                          "  AND A.EMPRESA = :EMPRESA_ ".
                                          "  AND A.RHID = :RHID_ ".
                                          "  AND A.DT_ADMISSAO = :DT_ADMISSAO_ ");

                    $stmt1->bindParam(':ID_HDR_AUTO_', $id_hdr_, PDO::PARAM_STR);
                    $stmt1->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                    $stmt1->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
                    $stmt1->bindParam(':DT_ADMISSAO_', $dt_adm_, PDO::PARAM_STR);
                    $stmt1->execute();

                } catch (PDOException $ex) {
                    $msg = "gd_atrib_template#3 :" . $ex->getMessage();
                }

                if ($msg == '') {
                    $masterKey = '';
                    try {
                        $stmt1 = $db->prepare("SELECT A.ID_PROC_GD ".
                                              "FROM RH_ID_GESTAO_DOCUMENTAL A ".
                                              "WHERE A.ID_HDR_AUTO = :ID_HDR_AUTO_ ".
                                              "  AND A.EMPRESA = :EMPRESA_ ".
                                              "  AND A.RHID = :RHID_ ".
                                              "  AND A.DT_ADMISSAO = :DT_ADMISSAO_ ");

                        $stmt1->bindParam(':ID_HDR_AUTO_', $id_hdr_, PDO::PARAM_STR);
                        $stmt1->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                        $stmt1->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
                        $stmt1->bindParam(':DT_ADMISSAO_', $dt_adm_, PDO::PARAM_STR);
                        $stmt1->execute();
                        $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
                        $masterKey = $row1['ID_PROC_GD'];
                    } catch (Exception $ex) {
                        $msg = "gd_atrib_template#4 :" . $ex->getMessage();
                    }
                }

                ## cria fases associadas ao processo
                if ($msg == '' && $masterKey != '') {
                    gd_cria_id_det_gd_fases($masterKey, 'INSERT', $msg);
                }

                ## submete documento
                if ($msg == '') {
                    if ($row['FASE_FINAL'] == 'N') { // não inicia processo
                        null;
                    } else {
                        if ($msg == '' && $masterKey != '') {
                            $msgrowErrors = '';
                            $msgformErrors = '';
                            $msgformErrorsAplic = '';
                            $newMasterStatus = '';
                            $return_msg = '';
                            gd_gera_documento($masterKey,'GERAR', $msgrowErrors, $msgformErrors, $newMasterStatus);
                            gd_valida_aplicabilidade($masterKey, $msgformErrorsAplic);
                        }
                    }
                }
            }
        }

    }

    # Validação do preenchimento do macro-processo
    function gd_valida_macro_proc($id_hdr_, &$msg_svlr, &$auto_terminado, &$msg) {

        global $db;
        global $ui_required;
        $msg = '';
        $msg_svlr = '';
        $renov = 'N';
        $auto_terminado = 'N';

        try {
            $stmt = $db->prepare("SELECT A.RENOV ".
                                 "FROM DG_GD_HDR_AUTO A ".
                                 "WHERE A.ID = :ID_ ");

            $stmt->bindParam(':ID_', $id_hdr_, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $renov = $row['RENOV'];
        } catch (PDOException $ex) {
            $msg = "gd_valida_template#0 :" . $ex->getMessage();
        }

        ##
        ## Validação do preenchimento de todas as variáveis associadas ao processo
        ##
        if ($msg == '') {
            try {
                $stmt = $db->prepare("SELECT A.ID, B.SEQ, A.RENOV ".
                                     "FROM DG_GD_HDR_AUTO A, DG_GD_DET_AUTO B, DG_DEF_VARIAVEIS C ".
                                     "WHERE A.ID = :ID_ ".
                                     "  AND B.ID = A.ID ".
                                     "  AND (B.VALOR IS NULL OR B.VALOR = '') ".
                                     "  AND B.COD_VAR = C.COD_VAR ".
                                     "  AND B.DT_INI_VAR = C.DT_INI_VAR ".
                                     "  AND C.TIPO IN ('A','B') ");

                $stmt->bindParam(':ID_', $id_hdr_, PDO::PARAM_STR);
                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $seq = $row['SEQ'];
                    if ($msg_svlr == '') {
                        $msg_svlr = '{"seq":"'.$id_hdr_.$seq.'","msg":"'.$ui_required.'"}';
                    } else {
                        $msg_svlr .= ",".'{"seq":"'.$id_hdr_.$seq.'","msg":"'.$ui_required.'"}';
                    }

                }

                if ($msg_svlr != '') {
                    $msg_svlr = "[$msg_svlr]";
                }

            } catch (PDOException $ex) {
                $msg = "gd_valida_template#1 :" . $ex->getMessage();
            }
        }

        # se validou sem erros o macro-processo e tem origem na renovação, então submete o processo
        if ($msg_svlr == '' && $msg == '' && $renov == 'S' && $id_hdr_ != '') {

            // gera modelo para cada um dos colaboradores
            try {
                $stmt = $db->prepare("SELECT A.EMPRESA, A.RHID, A.DT_ADMISSAO ".
                                     "FROM DG_GD_ID_AUTO A ".
                                     "WHERE A.ID_HDR = :ID_ ".
                                     "ORDER BY A.RHID ");

                $stmt->bindParam(':ID_', $id_hdr_, PDO::PARAM_STR);
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    gd_atrib_template($id_hdr_, $row['EMPRESA'], $row['RHID'], $row['DT_ADMISSAO'], 'N', $msg);
                }
            } catch (Exception $ex) {
                $msg = "gd_valida_template#2 :" . $ex->getMessage();
            }

            if ($msg == '') {
                gd_op_terminada($id_hdr_, $msg);
                $auto_terminado = 'S';
            }

        }
    }

    #
    # Sinalizar operação executada
    function gd_op_terminada($id_hdr_, &$msg) {

        global $db;
        $msg = '';

        try {
            $stmt = $db->prepare("UPDATE DG_GD_HDR_AUTO " .
                                 "SET TERMINADO = 'S' ".
                                 "WHERE ID = :ID_");

            $stmt->bindParam(':ID_', $id_hdr_, PDO::PARAM_STR);

            $stmt->execute();
        } catch (PDOException $ex) {
            $msg = "gd_op_terminada#1:" . $ex->getMessage();
        }

    }

    #
    # Remoção de todos os documentos de um template de emissão
    function gd_remove_template($id_hdr_, &$msg) {

        global $db;
        $msg = '';

        # os documentos associados a esta emissão
        try {
            $stmt = $db->prepare("SELECT A.ID_PROC_GD, A.FASE  ".
                                 "FROM RH_ID_GESTAO_DOCUMENTAL A " .
                                 "WHERE A.ID_HDR_AUTO = :ID_ ");

            $stmt->bindParam(':ID_', $id_hdr_, PDO::PARAM_STR);
            $stmt->execute();

        } catch (PDOException $ex) {
            $msg = "gd_remove_template#1 :" . $ex->getMessage();
        }

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            ## remove detalhes de documento
            gd_remove_gd_registos($row['ID_PROC_GD'],$msg);

            if ($msg == '') {
                try {
                    $stmt1 = $db->prepare("DELETE FROM RH_ID_GESTAO_DOCUMENTAL WHERE ID_PROC_GD = :ID_PROC_GD_ ");
                    $stmt1->bindParam(':ID_PROC_GD_', $row['ID_PROC_GD'], PDO::PARAM_STR);
                    $stmt1->execute();
                } catch (PDOException $ex) {
                    $msg = "gd_remove_template#2:" . $ex->getMessage();
                }
            } else {
                break;
            }

        }

        if ($msg == '') {
            try {
                $stmt1 = $db->prepare("DELETE FROM DG_GD_DET_AUTO WHERE ID = :ID_ ");
                $stmt1->bindParam(':ID_', $id_hdr_, PDO::PARAM_STR);
                $stmt1->execute();
            } catch (PDOException $ex) {
                $msg = "gd_remove_template#3:" . $ex->getMessage();
            }
        }

        if ($msg == '') {
            try {
                $stmt1 = $db->prepare("DELETE FROM DG_GD_ID_AUTO WHERE ID_HDR = :ID_ ");
                $stmt1->bindParam(':ID_', $id_hdr_, PDO::PARAM_STR);
                $stmt1->execute();
            } catch (PDOException $ex) {
                $msg = "gd_remove_template#4:" . $ex->getMessage();
            }
        }

        if ($msg == '') {
            try {
                $stmt1 = $db->prepare("DELETE FROM DG_GD_HDR_AUTO WHERE ID = :ID_ ");
                $stmt1->bindParam(':ID_', $id_hdr_, PDO::PARAM_STR);
                $stmt1->execute();
            } catch (PDOException $ex) {
                $msg = "gd_remove_template#5:" . $ex->getMessage();
            }
        }
    }

    function deleg_atualiza_estado($empresa_, $rhid_, $dt_adm_, $rhid_dest_, $dt_adm_dest_, $dt_ini_, $dt_fim_, $acao_, &$msg) {

        global $db;
        $msg = '';
        $estado_ = '';
        $msg_notif_ = '';
        $perfil_ = '';
        $dsp_colab_origem = '';
        $dsp_colab_destino = '';
        $dt_ini_reg = '';
        $dt_fim_reg = '';

        # obtem estado do registo
        $auto_prev_ = 'N';
        try {
            $stmt = $db->query("SELECT RV_LOW_VALUE  ".
                               "FROM CG_REF_CODES " .
                               "WHERE RV_DOMAIN = 'DELEG_AUTO_PREV' ");

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $auto_prev_ = $row['RV_LOW_VALUE'];

        } catch (PDOException $ex) {
            $msg = "deleg_atualiza_estado#1 :" . $ex->getMessage();
        }

        if ($msg == '') {
            try {
                $stmt = $db->prepare("SELECT A.ESTADO, A.PERFIL, A.DT_INICIO, A.DT_FIM, B.NOME, C.NOME NOME_DESTINO  ".
                                     "FROM RH_ID_DELEGACOES A, RH_IDENTIFICACOES B, RH_IDENTIFICACOES C " .
                                     "WHERE A.EMPRESA = :EMPRESA_ ".
                                     " AND A.RHID = :RHID_ ".
                                     " AND A.DT_ADMISSAO = :DT_ADMISSAO_ ".
                                     " AND A.RHID_DESTINO = :RHID_DESTINO_ ".
                                     " AND A.DT_ADMISSAO_DESTINO = :DT_ADMISSAO_DESTINO_ ".
                                     " AND A.DT_INICIO = :DT_INICIO_ ".
                                     " AND A.RHID = B.RHID ".
                                     " AND A.RHID_DESTINO = C.RHID ");

                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_DESTINO_', $rhid_dest_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_ADMISSAO_DESTINO_', $dt_adm_dest_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INICIO_', $dt_ini_, PDO::PARAM_STR);
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $estado_ = $row['ESTADO'];
                    $perfil_ = $row['PERFIL'];
                    $dsp_colab_origem = $rhid_." - ".$row['NOME'];
                    $dsp_colab_destino = $rhid_dest_." - ".$row['NOME_DESTINO'];
                    $dt_ini_reg = $row['DT_INICIO'];
                    $dt_fim_reg = $row['DT_FIM'];
                }
            } catch (PDOException $ex) {
                $msg = "deleg_atualiza_estado#1 :" . $ex->getMessage();
            }
        }

        if ($msg == '') {
            if ($estado_ == '' && $auto_prev_ == 'S') {
                $estado_ = 'Z';
            } else {
                $estado_ = 'A';
                if (@$_SESSION['perfil'] == 'A') # colaborador
                        $estado_ = 'A';
                elseif (@$_SESSION['perfil'] == 'B') # gestor administrativo
                        $estado_ = 'B';
                elseif (@$_SESSION['perfil'] == 'C') # supervisor
                        $estado_ = 'C';
                elseif (@$_SESSION['perfil'] == 'D') # director
                        $estado_ = 'D';
                elseif (@$_SESSION['perfil'] == 'F'   || # dep.recursos humanos
                        @$_SESSION['perfil'] == 'E' || # Gestor - outsourcing
                        @$_SESSION['perfil'] == 'Z')  # Administrador
                        $estado_ = 'E';
                $estado_ = altera_estado(30, $empresa_, $rhid_, $estado_);
            }

            if ($acao_ == 'INSERT') {
                $msg_notif_ = 'Criação de Delegação do rhid '.$dsp_colab_origem.' para o rhid '.$dsp_colab_destino;

                if ($dt_ini_reg != '' && $dt_fim_reg != '') {
                    $msg_notif_ .= ' entre '.$dt_ini_.' e '.$dt_fim_.' para ';
                } else {
                    $msg_notif_ .= ' desde '.$dt_ini_.' para ';
                }

                if ($perfil_ == '%') {
                    $msg_notif_ .= ' todos os perfis';
                } elseif ($perfil_ == 'B') {
                    $msg_notif_ .= ' o perfil de '.quad_dsp_perfil('', 'B', $msg);
                } elseif ($perfil_ == 'C') {
                    $msg_notif_ .= ' o perfil de '.quad_dsp_perfil('', 'C', $msg);
                } elseif ($perfil_ == 'D') {
                    $msg_notif_ .= ' o perfil de '.quad_dsp_perfil('', 'D', $msg);
                }
            } else {
                $msg_notif_ = 'Atualização de Delegação do rhid '.$dsp_colab_origem.' para o rhid '.$dsp_colab_destino.
                              ' entre ['.$dt_ini_.' - '.$dt_fim_.'] para ';
                if ($perfil_ == '%') {
                    $msg_notif_ .= ' todos os perfis';
                } elseif ($perfil_ == 'B') {
                    $msg_notif_ .= ' o perfil de '.quad_dsp_perfil('', 'B', $msg);
                } elseif ($perfil_ == 'C') {
                    $msg_notif_ .= ' o perfil de '.quad_dsp_perfil('', 'C', $msg);
                } elseif ($perfil_ == 'D') {
                    $msg_notif_ .= ' o perfil de '.quad_dsp_perfil('', 'D', $msg);
                }
            }

            if ($msg == '') {
                try {
                    $stmt = $db->prepare("UPDATE RH_ID_DELEGACOES A " .
                                         "SET A.ESTADO = :ESTADO_, MSG_NOTIF = :MSG_NOTIF_ ".
                                         "WHERE A.EMPRESA = :EMPRESA_ ".
                                         " AND A.RHID = :RHID_ ".
                                         " AND A.DT_ADMISSAO = :DT_ADMISSAO_ ".
                                         " AND A.RHID_DESTINO = :RHID_DESTINO_ ".
                                         " AND A.DT_ADMISSAO_DESTINO = :DT_ADMISSAO_DESTINO_ ".
                                         " AND A.DT_INICIO = :DT_INICIO_ ");

                    $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                    $stmt->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_, PDO::PARAM_STR);
                    $stmt->bindParam(':RHID_DESTINO_', $rhid_dest_, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_ADMISSAO_DESTINO_', $dt_adm_dest_, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_INICIO_', $dt_ini_, PDO::PARAM_STR);
                    $stmt->bindParam(':ESTADO_', $estado_, PDO::PARAM_STR);
                    $stmt->bindParam(':MSG_NOTIF_', $msg_notif_, PDO::PARAM_STR);
                    $stmt->execute();
                } catch (PDOException $ex) {
                    $msg = "deleg_atualiza_estado#10:" . $ex->getMessage();
                }
            }
        }
        return $estado_;
    }

    #
    # Cria cabeçalho de macro-processo, associa colaboradores e prepara formulário
    function gd_lanca_macro_processo($fase_, $empresa_, $cd_gd_, $dt_ini_gd_, $cd_det_gd_, $dt_ini_det_gd_, $colabs, &$msg) {
        global $db;

        $msg = '';
        $cnt_ = 0;

        # criação do cabeçalho do macro-processo
        $id_hdr_ = gd_cria_hdr_auto($fase_, $empresa_, $cd_gd_, $dt_ini_gd_, $cd_det_gd_, $dt_ini_det_gd_, 'S', $msg);

        # Atribuição dos colaboradores associados ao processo
        if ($msg == '' && $id_hdr_ != '') {
            foreach ($colabs as $key => $value) {
                $p = explode("@",$value);
                $rhid_ = $p[1];
                $dt_adm_ = $p[2];
                try {
                    $stmt = $db->prepare("INSERT INTO DG_GD_ID_AUTO" .
                                         "(ID_HDR, EMPRESA, RHID, DT_ADMISSAO) ".
                                         "VALUES(:ID_HDR, :EMPRESA_, :RHID_, :DT_ADMISSAO_)");

                    $stmt->bindParam(':ID_HDR', $id_hdr_, PDO::PARAM_STR);
                    $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                    $stmt->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_, PDO::PARAM_STR);
                    $stmt->execute();
                    $cnt_ += 1;
                } catch (PDOException $ex) {
                    $msg = "gd_lanca_macro_processo#1:" . $ex->getMessage();
                }
            }
        }

        # Criação dos registos de detalhe associados ao processo
        if ($msg == '' && $id_hdr_ != '' && $cnt_ > 0) {
            gd_cria_det_auto($id_hdr_, $empresa_, 'INSERT', $msg);
        }

        return $id_hdr_;
    }


    ##
    ## INTERAÇÃO COM O PORTAL v1
    ##
    ##
    ##
    ##

    #
    # função que descodifica um perfil
    #
    function dsp_perfil($cd, $tp, &$msg) {

        global $db;
        $msg = '';
        $perfil = '';
        $lbl_gestor_adm = '';
        $lbl_supervisor = '';
        $lbl_director = '';

        try {
            $query = "SELECT c.label_gestor_adm, c.label_supervisor, c.label_director ".
                     "FROM WEB_ADM_CONFIGURACOES c ".
                     "WHERE 1 = 1 ";
            $stmt = $db->prepare($query);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $lbl_gestor_adm = $row['label_gestor_adm'];
            $lbl_supervisor = $row['label_supervisor'];
            $lbl_director = $row['label_director'];
        } catch (Exception $ex) {
            $msg = "erro#1 :" . $ex->getMessage();
        }

        try {
            $query = "SELECT p.dsp_perfil ds_perfil, p.tipo_perfil ".
                     "FROM WEB_ADM_PERFIS p ".
                     "WHERE 1 = 1 ";

            if ($tp != '') {
                 $query .= " AND p.tipo_perfil = :TP_ ";
            }

            if ($cd != '') {
                 $query .= " AND p.id = :CD_ ";
            }

            $stmt = $db->prepare($query);
            if ($tp != '') {
                $stmt->bindParam(':TP_', $tp, PDO::PARAM_STR);
            }
            if ($cd != '') {
                $stmt->bindParam(':CD_', $cd, PDO::PARAM_STR);
            }

            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $lbl = '';
                if ($row['tipo_perfil'] == 'B') { # gestor adm
                    $lbl = $lbl_gestor_adm;
                } elseif ($row['tipo_perfil'] == 'C') { # supervisor
                    $lbl = $lbl_supervisor;
                } elseif ($row['tipo_perfil'] == 'D') { # director
                    $lbl = $lbl_director;
                }

                if ($lbl != '') {
                    $perfil = $lbl;
                } else {
                    $perfil = $row['ds_perfil'];
                }
                break;
            }
        } catch (Exception $ex) {
            $msg = "erro#2 :" . $ex->getMessage();
        }

        return $perfil;
    }

    #
    # função que devolve os perfis disponíveis para um colaborador
    #
    function lista_perfis_utilizador($usr_id, &$msg) {

          global $db;
          $msg = '';

          if ($usr_id != '') {
            try {
                $query = "SELECT p.dsp_perfil ds_perfil, p.tipo_perfil, w.id_perfil ".
                         "FROM WEB_ADM_PERFIS_UTILIZADORES w, WEB_ADM_PERFIS p ".
                         "WHERE w.id_utilizador = :USR_ID_ ".
                         "  AND p.id = w.id_perfil ".
                         "  AND w.estado = 'A' ".
                         "  AND p.estado = 'A' ".
                         "ORDER BY w.id_perfil ";

               $stmt = $db->prepare($query);
               $stmt->bindParam(':USR_ID_', $usr_id, PDO::PARAM_STR);
               $stmt->execute();
               while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                     $lbl = '';
                     if ($row['tipo_perfil'] == 'B' ||  # gestor adm
                         $row['tipo_perfil'] == 'C' ||  # supervisor
                         $row['tipo_perfil'] == 'D' ) { # director
                             $lbl = dsp_perfil('',$row['tipo_perfil'],$msg);
                     }
                    if ($lbl != '') {
                        $perfil = $lbl;
                    } else {
                        $perfil =  $row['ds_perfil'];
                    }
                    if (@$_SESSION['perfil'] == '') {
                       $_SESSION['perfil'] = $row['tipo_perfil'];
                       echo ' <li class="active">'.
                            '   <a href="javascript:void(0);"> '. $perfil .'</a>'.
                            ' </li>';
                    }
                    elseif (@$_SESSION['perfil'] == $row['tipo_perfil']) {
                       echo ' <li class="active">'.
                            '   <a href="javascript:void(0);"> '. $perfil .'</a>'.
                            ' </li>';
                    }
                    else {
                       echo ' <li>'.
                            '   <a href="javascript:void(0);"> '. $perfil .'</a>'.
                            ' </li>';
                    }
               }

            } catch (Exception $ex) {
                $msg = "perfis_utilizador#1 :" . $ex->getMessage();
            }
          }
    }

    #
    # função que devolve nome do colaborador
    function dsp_nome_colab($rhid, $tipo, &$msg) {
        global $db;
        $msg = '';
        $dsp = '';
        try {
            $query = "SELECT NOME, NOME_REDZ ".
                     "FROM RH_IDENTIFICACOES ".
                     "WHERE RHID = :RHID_ ";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':RHID_', $rhid, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($tipo = 'REDZ') {
                $dsp = $row['NOME_REDZ'];
            } else {
                $dsp = $row['NOME'];
            }
        } catch (Exception $ex) {
            $msg = "dsp_nome_colab#1 :" . $ex->getMessage();
        }
        return $dsp;
    }
    #
    # função que descodifica um estabelecimento
    function dsp_estab($empresa, $cd_estab, &$msg) {
        global $db;
        $msg = '';
        $dsp = '';
        try {
            $query = "SELECT DSP_ESTAB ".
                     "FROM DG_ESTABELECIMENTOS ".
                     "WHERE EMPRESA = :EMPRESA_ ".
                     "  AND CD_ESTAB = :CD_ESTAB_ ";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':EMPRESA_', $empresa, PDO::PARAM_STR);
            $stmt->bindParam(':CD_ESTAB_', $cd_estab, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $dsp = $row['DSP_ESTAB'];
        } catch (Exception $ex) {
            $msg = "dsp_estab#1 :" . $ex->getMessage();
        }
        return $dsp;
    }
    #
    # função que descodifica uma categoria profissional
    function dsp_cat_prof($cd_, &$msg) {
        global $db;
        $msg = '';
        $dsp = '';
        try {
            $query = "SELECT DSP_CATG_PROF ".
                     "FROM RH_DEF_CATS_PROFISSIONAIS ".
                     "WHERE CD_CATG_PROF = :CD_ ";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':CD_', $cd_, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $dsp = $row['DSP_CATG_PROF'];
        } catch (Exception $ex) {
            $msg = "dsp_cat_prof#1 :" . $ex->getMessage();
        }
        return $dsp;
    }
    #
    # função que descodifica um nível remuneratório
    function dsp_nivel($cd_, &$msg) {
        global $db;
        $msg = '';
        $dsp = '';
        try {
            $query = "SELECT DSP_NIVEL ".
                     "FROM RH_DEF_NIVEIS ".
                     "WHERE CD_NIVEL = :CD_ ";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':CD_', $cd_, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $dsp = $row['DSP_NIVEL'];
        } catch (Exception $ex) {
            $msg = "dsp_nivel#1 :" . $ex->getMessage();
        }
        return $dsp;
    }
    #
    # função que descodifica um horário
    function dsp_horario($cd_, &$msg) {
        global $db;
        $msg = '';
        $dsp = '';
        $p = explode("@",$cd_);
        $hor = $p[0];
        $tp_hor = $p[1];
        try {
            $query = "SELECT DSR_HORARIO ".
                     "FROM RH_DEF_HORARIOS ".
                     "WHERE CD_HORARIO = :CD_ ".
                     "  AND TP_HORARIO = :TP_ ";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':CD_', $cd_hor, PDO::PARAM_STR);
            $stmt->bindParam(':TP_', $tp_hor, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $dsp = $row['DSR_HORARIO'];
        } catch (Exception $ex) {
            $msg = "dsp_horario#1 :" . $ex->getMessage();
        }
        return $dsp;
    }
    #
    # função que descodifica uma entidade de desconto
    function dsp_ent_desconto($cd, &$msg) {
        global $db;
        $msg = '';
        $dsp = '';
        try {
            $query = "SELECT * FROM RH_DEF_ENTIDADES_DESCONTO WHERE CD_ED = :CD_ ";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':CD_', $cd, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $dsp = $row['DSP_ED'];
        } catch (Exception $ex) {
            $msg = "dsp_ent_desconto#1 :" . $ex->getMessage();
        }
        return $dsp;
    }
    #
    # função que descodifica um regime de desconto de uma entidade de desconto
    function dsp_regime_desconto($cd, &$msg) {
        global $db;
        $msg = '';
        $dsp = '';
        try {
            $query = "SELECT * FROM rh_def_regimes_desconto WHERE CD_REG_DESC = :CD_ ";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':CD_', $cd, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $dsp = $row['DSP_REG_DESC'];
        } catch (Exception $ex) {
            $msg = "dsp_regime_desconto#1 :" . $ex->getMessage();
        }
        return $dsp;
    }

    #
    # função que determina se existe auto-aprovação de workflow para um módulo
    #
    function auto_aprovacao($id_modulo, $perfil) {

        global $db;
        $auto_aprov = false;
        $cnt = 0;

        try {
            # determina se existe uma auto-aprovação
            $query = "SELECT W.ID_MODULO, P.DSP_PERFIL, P.TIPO_PERFIL, P.ESTADO, P.NR_ORDEM ".
                     "FROM WEB_ADM_PERFIS P, WEB_ADM_WORKFLOW W ".
                     "WHERE P.ID = W.ID_PERFIL ".
                     "  AND W.ESTADO = 'A' ".
                     "  AND P.ESTADO = 'A' ".
                     "  AND W.ID_MODULO = :ID_MODULO_ ".
                     "ORDER BY P.TIPO_PERFIL DESC ";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':id_modulo_', $id_modulo, PDO::PARAM_STR);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  $cnt += 1;

                  # último perfil de aprovação a fazer alteração => auto aprovado
                  if ($perfil >= $row['TIPO_PERFIL'] || $perfil >= 'E') {
                     $auto_aprov = true;
                     break;
                  }
                  break;
            }
        } catch (PDOException $ex) {
            $msg = "erro#1 :" . $ex->getMessage();
        }

        # não existe workflow => auto-aprovação
        if ($cnt == 0)
            $auto_aprov = true;

        return $auto_aprov;
    }

    #
    # função que determina para um colaborador que perfis estão definidos
    #
    function perfis_autorizacao_activos_rhid($empresa, $rhid, $modulo,
                                             &$gestor_adm, &$supervisor, &$director,
                                             &$dep_rh, &$gestor, &$admin) {
        global $db;
        $msg = '';

        $gestor_adm = false;
        $supervisor = false;
        $director = false;
        $dep_rh	= false;
        $gestor = false;
        $admin = false;

        $rhid_director = '';
        $rhid_supervisor = '';
        $rhid_gestor_adm = '';

        # determina os perfis que se encontram activos no workflow da instalação
        try {
            $sql = "SELECT RHID_DIRECTOR, RHID_GESTOR_ADM, RHID_SUPERVISOR ".
                   "FROM  RH_ID_EMPRESAS ".
                   "WHERE RHID = :RHID_ ";

            if ($empresa != '')
                    $sql .= "  AND EMPRESA = :EMPRESA_ ";

            $sql .= "ORDER BY DT_ADMISSAO DESC";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':RHID_', $rhid, PDO::PARAM_STR);
            if ($empresa != '') {
                $stmt->bindParam(':EMPRESA_', $empresa, PDO::PARAM_STR);
            }
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                 $rhid_director = $row['RHID_DIRECTOR'];
                 $rhid_supervisor = $row['RHID_SUPERVISOR'];
                 $rhid_gestor_adm = $row['RHID_GESTOR_ADM'];
                 break;
            }
        } catch (PDOException $ex) {
            $msg = "erro#1 :" . $ex->getMessage();
        }

        # determina os perfis que se encontram activos no workflow da instalação
        if ($msg == '') {
            try {
               $sql = "SELECT p.tipo_perfil ".
                      "FROM WEB_ADM_WORKFLOW w, WEB_ADM_PERFIS p ".
                      "WHERE p.id = w.id_perfil ".
                      "  AND w.estado = 'A' ".
                      "  AND p.estado = 'A' ".
                      "  AND w.id_modulo = :MODULO_ ";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':MODULO_', $modulo, PDO::PARAM_STR);
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    if ($row['tipo_perfil'] == 'B' && $rhid_gestor_adm != '')
                            $gestor_adm = true;
                    elseif ($row['tipo_perfil'] == 'C' && $rhid_supervisor != '')
                            $supervisor = true;
                    elseif ($row['tipo_perfil'] == 'D' && $rhid_director != '')
                            $director = true;
                    elseif ($row['tipo_perfil'] == 'E')
                            $gestor = true;
                    elseif ($row['tipo_perfil'] == 'F')
                            $dep_rh = true;
                    elseif ($row['tipo_perfil'] == 'Z')
                            $admin = true;
                }
            } catch (PDOException $ex) {
                $msg = "erro#1 :" . $ex->getMessage();
            }
        }
    }

    #
    # função que determina quais os perfis ativos para um módulo
    #
    function perfis_autorizacao_activos($modulo, &$gestor_adm, &$supervisor, &$director, &$dep_rh, &$gestor, &$admin) {

        global $db;
        $msg = '';

        $gestor_adm = false;
        $supervisor = false;
        $director = false;
        $dep_rh	= false;
        $gestor = false;
        $admin = false;

        # determina os perfis que se encontram activos no workflow da instalação
        try {
           $sql = "SELECT p.TIPO_PERFIL ".
                  "FROM WEB_ADM_WORKFLOW w, WEB_ADM_PERFIS p ".
                  "WHERE p.ID = w.id_perfil ".
                  "  AND w.ESTADO = 'A' ".
                  "  AND p.ESTADO = 'A' ".
                  "  AND w.ID_MODULO = :MODULO_ ";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':MODULO_', $modulo, PDO::PARAM_STR);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($row['TIPO_PERFIL'] == 'B') {
                    $gestor_adm = true;
                } elseif ($row['TIPO_PERFIL'] == 'C') {
                    $supervisor = true;
                } elseif ($row['TIPO_PERFIL'] == 'D') {
                    $director = true;
                } elseif ($row['TIPO_PERFIL'] == 'E') {
                    $gestor = true;
                } elseif ($row['TIPO_PERFIL'] == 'F') {
                    $dep_rh = true;
                } elseif ($row['TIPO_PERFIL'] == 'Z') {
                    $admin = true;
                }
            }

        } catch (PDOException $ex) {
            $msg = "erro#1 :" . $ex->getMessage();
        }
    }

    #
    # função que determina o estado de um registo consoante o módulo e
    # a configuração dos workflows
    #
    function altera_estado($modulo, $empresa, $rhid, $estado) {

        $novo_estado = $estado;
        $mgestor_adm = false;
        $msupervisor = false;
        $mdirector = false;
        $mdep_rh = false;
        $mgestor = false;
        $madmin = false;
        $gestor_adm = false;
        $supervisor = false;
        $director = false;
        $dep_rh = false;
        $gestor = false;
        $admin = false;

        if ($estado != '' && $modulo != '') {

            # determina os perfis que se encontram activos no workflow da instalação
            perfis_autorizacao_activos($modulo, $mgestor_adm, $msupervisor, $mdirector, $mdep_rh, $mgestor, $madmin);

            # perfis activos no ambito do colaborador
            perfis_autorizacao_activos_rhid($empresa, $rhid, $modulo, $gestor_adm, $supervisor, $director, $dep_rh, $gestor, $admin);

            if ($estado == 'A' && (!$gestor_adm || !$mgestor_adm)) {
                $novo_estado = 'B';
            }

            if ($novo_estado == 'B' && (!$supervisor || !$msupervisor)) {
                $novo_estado = 'C';
            }

            if ($novo_estado == 'C' && (!$director || !$mdirector)) {
                $novo_estado = 'D';
            }

            if ($novo_estado == 'D' && (!$gestor || !$mgestor)) {
                $novo_estado = 'E';
            }

        } else if ($modulo == '') {
            #echo "Módulo para Workflow não definido. P.f. consulte suporte.";
        }

        return $novo_estado;
    }

    function carimba_tabela_controlo($tab, &$msg) {
        global $db;
        try {
            $sql = "UPDATE web_adm_tabelas ".
                   "SET dt_alteracao = :DATA_ ".
                   "WHERE nome_tabela = :TABELA_ ".
                   "  AND origem = 'A' ".
                   "  AND tp_actualizacao = 'B' ";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':TABELA_', $tab, PDO::PARAM_STR);
            $stmt->bindParam(':DATA_', date("Y-m-d H:i:s"), PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $ex) {
            $msg = "carimba_tabela_controlo#1:".$ex->getMessage();
        }
    }

    #
    # Regista a alteração efetuada ao cadastro no respetivo log
    #
    function regista_alteracao_cadastro($sub_modulo, $atrib, $estado, $rhid, $empresa, $dt_adm, $vlr_ant, $vlr, $dsp_ant, $dsp, $sql_aprov, $sql_rej, $msg_notif,  &$msg) {

        global $db;

        $mod_identificacao = 'Identificação';		# $ui_identification
        $mod_enderecos = 'Endereços';			# $ui_addresses
        $mod_elem_retrib = 'Elem.Retributivos';         # $ui_retributive_elements
        $mod_documentos = 'Documentos';                 # $ui_docs
        $mod_info_empresas = 'Info.Empresas';		# $ui_company_info
        $mod_info_profs = 'Info.Profissional';          # $ui_master_prof
        $mod_vinculos = 'Vínculos Contratuais';  	# $ui_contracts_long
        $mod_funcoes = 'Funções';			# $ui_functions

        $perfil = @$_SESSION['perfil'];
        $estado = 'A';

        if ($perfil == 'A') { # colaborador
            $estado = 'A';
        } elseif ($perfil == 'B') { # gestor administrativo
            $estado = 'B';
        } elseif ($perfil == 'C') { # supervisor
            $estado = 'C';
        } elseif ($perfil == 'D') { # director
            $estado = 'D';
        } elseif ($perfil == 'F' || # dep.recursos humanos
                  $perfil == 'E' || # Gestor - outsourcing
                  $perfil == 'Z') {  # Administrador
            $estado = 'E';
        }

        $modulo = 1;
        $emp = $empresa;
        if ($emp == '@@') {
           $emp = '';
        }

        $estado = altera_estado($modulo, $emp, $rhid, $estado);

        if ($estado == 'E') {
            $auto_aprov = true;
        } else {
             # determina se existe uma auto-aprovação
            $auto_aprov = auto_aprovacao($modulo, $perfil);
        }

        # os statments $sql_aprov e $sql_reg contêm a tag <vlr> que deverá ser substituída pelo valor correspondente
        if ($vlr == '')
                $sql_ap = str_replace("'<vlr>'", 'NULL', $sql_aprov);
        else
                $sql_ap = str_replace("<vlr>", str_replace("'","''",$vlr), $sql_aprov);

        if ($vlr_ant == '')
                $sql_rj = str_replace("'<vlr>'", 'NULL', $sql_rej);
        else
                $sql_rj = str_replace("<vlr>", str_replace("'","''",$vlr_ant), $sql_rej);

        # remove o anterior
        try {
            $sql = "DELETE FROM WEB_RH_ALTER_CADASTRO ".
                   "WHERE sub_modulo = :SUB_MODULO_ ".
                   "  and atributo = :ATRIB_ ".
                   "  and rhid = :RHID_ ".
                   "  and estado != 'E' ".
                   "  and estado != 'F' ";

            if ($empresa != '') {
                $sql = $sql . "  and empresa = :EMPRESA_ ";
            }

            if ($dt_adm != '') {
                $sql = $sql . "  and dt_admissao = :DT_ADM_ ";
            }

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':SUB_MODULO_', $sub_modulo, PDO::PARAM_STR);
            $stmt->bindParam(':ATRIB_', $atrib, PDO::PARAM_STR);
            $stmt->bindParam(':RHID_', $rhid, PDO::PARAM_STR);
            if ($empresa != '') {
                $stmt->bindParam(':EMPRESA_', $empresa, PDO::PARAM_STR);
            }
            if ($dt_adm != '') {
                $stmt->bindParam(':DT_ADM_', $dt_adm, PDO::PARAM_STR);
            }
            $stmt->execute();
            $ja_existe = $stmt->rowCount();

        } catch (PDOException $ex) {
            $msg = "regista_alteracao_cadastro - #1 :" . $ex->getMessage();
        }

        if ($msg == '') {

            # perfil
            $tipo_perfil = @$_SESSION['perfil'];
            $dsp_perfil = dsp_perfil('', $tipo_perfil, $m);

            ## IP do sítio onde está a ser efectuada a ligação
            $ip = @$_SERVER['REMOTE_ADDR'];

            $sql = "INSERT INTO web_rh_alter_cadastro ".
                   "(sub_modulo, atributo, estado, rhid, empresa, dt_admissao, valor_anterior, valor, sql_aprov, sql_rej, msg_notif, tipo_perfil, dsp_perfil, ip, usr_reg, dt_reg) ";

            $sql = $sql . "values('".$sub_modulo."', '".$atrib."', '$estado', $rhid, ";

            if ($empresa == '')
                $sql = $sql . "NULL, ";
            else
                $sql = $sql . "'".($empresa)."', ";

            if ($dt_adm == '')
                $sql = $sql . "NULL, ";
            else
                $sql = $sql . "'$dt_adm', ";

            if ($vlr_ant == '')
                $sql = $sql . "NULL, ";
            else
                $sql = $sql . "'".($dsp_ant)."', ";

            if ($vlr == '')
                $sql = $sql . "NULL, ";
            else
                $sql = $sql . "'".($dsp)."', ";

            $sql .= "\"".($sql_ap)."\",\"".($sql_rj)."\",";

            if ($msg_notif == '')
                $sql = $sql . "NULL, ";
            else
                $sql = $sql . "'".($msg_notif)."', ";

            if ($tipo_perfil == '')
                $sql = $sql . "NULL, ";
            else
                $sql = $sql . "'".($tipo_perfil)."', ";

            if ($dsp_perfil == '')
                $sql = $sql . "NULL, ";
            else
                $sql = $sql . "'".($dsp_perfil)."', ";

            if ($ip == '')
                $sql = $sql . "NULL, ";
            else
                $sql = $sql . "'".($ip)."', ";

            $sql .= "'".@$_SESSION['utilizador']."','".date("Y-m-d H:i:s")."')";

            try {
                $stmt = $db->prepare($sql);
                $stmt->execute();
            } catch (PDOException $ex) {
                $msg = "regista_alteracao_cadastro - [$sql]#2 :" . $ex->getMessage();
            }

            # se a alteração foi produzida pelo último nível, ou não existe workflow-> automáticamente aprovada
            #
            #
            if ($auto_aprov && $sql_ap != '') {

                if (strpos($sql_ap,"_@_") == false) {
                    try {
                        $stmt = $db->prepare($sql_ap);
                        $stmt->execute();
                    } catch (PDOException $ex) {
                        $msg = "regista_alteracao_cadastro - #3 :" . $ex->getMessage();
                    }
                } else {
                    $sql_array = explode("_@_",$sql_ap);
                    $m = '';
                    for ($i=0; $i<count($sql_array); $i++) {
                        try {
                            $stmt = $db->prepare($sql_array[$i]);
                            $stmt->execute();
                        } catch (PDOException $ex) {
                            $m = $ex->getMessage();
                        }
                        if ($m != '') {
                           if ($msg == '') {
                                $msg = $m;
                           } else {
                                $msg .= '; '.$m;
                           }
                        }
                    }
                    if ($msg != '') {
                        $msg = "regista_alteracao_cadastro - #4:$msg";
                    }
                }

            } else {
                # notificação de workflow
                if ($ja_existe == 0) { # ainda não existe uma notificação
                    if (@$_SESSION['id'] != '' && @$_SESSION['perfil'] != '' && $msg_notif != '') {
                        #notificacao_workflow(@$_SESSION['id'], @$_SESSION['perfil'], 1, $sub_modulo, $msg_notif, $rhid, '', '', $msg);
                    }
                }
            }

        }

    }

    #
    # Cria o vínculo para aprovação no cadastro após conclusão do workflow da gestão documental
    #
    function gd_cria_vinculo($id_proc_gd_, &$msg) {

        global $db;

        $modulo = 1;
        $perfil = @$_SESSION['perfil'];

        $msg = '';
        try {
            $stmt = $db->prepare("SELECT * FROM RH_ID_GESTAO_DOCUMENTAL A WHERE A.ID_PROC_GD = :ID_PROC_GD_ ");
            $stmt->bindParam(':ID_PROC_GD_', $id_proc_gd_, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $ex) {
            $msg = "gd_cria_vinculo#1 :" . $ex->getMessage();
        }

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            try {

                $msg = '';
                $seq = '';
                $empresa = $row['EMPRESA'];
                $rhid = $row['RHID'];
                $dt_adm = $row['DT_ADMISSAO'];
                $cd_vinculo = gd_get_var_value($row['ID_PROC_GD'], 'NOVO_VINCULO', 'VALOR', $seq, $msg);
                $dsp_vinculo = gd_get_var_value($row['ID_PROC_GD'], 'NOVO_VINCULO', 'DSP', $seq, $msg);
                $dt_ini_vinculo = gd_get_var_value($row['ID_PROC_GD'], 'DT_INI_VINCULO', 'VALOR', $seq, $msg);
                $dt_fim = gd_get_var_value($row['ID_PROC_GD'], 'DT_FIM_VINCULO', 'VALOR', $seq, $msg);
                $motivo_admissao = gd_get_var_value($row['ID_PROC_GD'], 'MOTIVO_ADMISSAO', 'VALOR', $seq, $msg);
                $cd_motivo_saida = '';
                $tp_vinculo = '';
                $vlr_liquido = '';
                $dt_denuncia = '';
                $dt_fim_per_exp = '';

                if ($empresa != '' && $rhid != '' && $dt_adm != '' && $cd_vinculo != '' && $dt_ini_vinculo != '') {
                    $estado = 'A';
                    if ($perfil == 'A') { # colaborador
                        $estado = 'A';
                    } elseif ($perfil == 'B') { # gestor administrativo
                        $estado = 'B';
                    } elseif ($perfil == 'C') { # supervisor
                        $estado = 'C';
                    } elseif ($perfil == 'D') { # director
                        $estado = 'D';
                    } elseif ($perfil == 'F' || # dep.recursos humanos
                              $perfil == 'E' || # Gestor - outsourcing
                              $perfil == 'Z') {  # Administrador
                        $estado = 'E';
                    }

                    # statment associado à aprovação do registo
                    $sql_aprov = "INSERT rh_id_vinculos ".
                                 "(EMPRESA, RHID, DT_ADMISSAO,CD_VINCULO, DT_INI_VINCULO, DT_FIM_VINCULO, CD_MOTIVO_SAIDA, TP_VINCULO, VLR_LIQUIDO, MOTIVO_ADMISSAO, DT_DENUNCIA, DT_FIM_PER_EXP, ACTIVO, ID_PROC_GD) ".
                                 "VALUES('$empresa',$rhid,'$dt_adm','$cd_vinculo','$dt_ini_vinculo',";

                    if ($dt_fim == '') {
                        $sql_aprov .= "NULL, ";
                    } else {
                        $sql_aprov .= "'$dt_fim', ";
                    }

                    if ($cd_motivo_saida == '') {
                        $sql_aprov .= "NULL, ";
                    } else {
                        $sql_aprov .= "'$cd_motivo_saida', ";
                    }

                    if ($tp_vinculo == '') {
                        $sql_aprov .= "NULL, ";
                    } else {
                        $sql_aprov .= "'$tp_vinculo', ";
                    }

                    if ($vlr_liquido == '') {
                        $sql_aprov .= "NULL, ";
                    } else {
                        $sql_aprov .= "$vlr_liquido, ";
                    }

                    if ($motivo_admissao == '') {
                        $sql_aprov .= "NULL, ";
                    } else {
                        $sql_aprov .= "'$motivo_admissao', ";
                    }

                    if ($dt_denuncia == '') {
                        $sql_aprov .= "NULL, ";
                    } else {
                        $sql_aprov .= "'$dt_denuncia', ";
                    }

                    if ($dt_fim_per_exp == '') {
                        $sql_aprov .= "NULL, ";
                    } else {
                        $sql_aprov .= "'$dt_fim_per_exp', ";
                    }

                    $sql_aprov .= "'S',$id_proc_gd_) ON DUPLICATE KEY UPDATE REMOVIDO = 'N' ";

                    if ($dt_fim == '') {
                        $sql_aprov .= " ,DT_FIM_VINCULO = NULL ";
                    } else {
                        $sql_aprov .= " ,DT_FIM_VINCULO = '$dt_fim' ";
                    }

                    if ($cd_motivo_saida == '') {
                        $sql_aprov .= " ,CD_MOTIVO_SAIDA = NULL ";
                    } else {
                        $sql_aprov .= " ,CD_MOTIVO_SAIDA = '$cd_motivo_saida' ";
                    }

                    if ($tp_vinculo == '') {
                        $sql_aprov .= " ,TP_VINCULO =  NULL ";
                    } else {
                        $sql_aprov .= " ,TP_VINCULO =  '$tp_vinculo' ";
                    }

                    if ($vlr_liquido == '') {
                        $sql_aprov .= " ,VLR_LIQUIDO = NULL ";
                    } else {
                        $sql_aprov .= " ,VLR_LIQUIDO = $vlr_liquido ";
                    }

                    if ($motivo_admissao == '') {
                        $sql_aprov .= " ,MOTIVO_ADMISSAO = NULL ";
                    } else {
                        $sql_aprov .= " ,MOTIVO_ADMISSAO = '$motivo_admissao' ";
                    }

                    if ($dt_denuncia == '') {
                        $sql_aprov .= " ,DT_DENUNCIA = NULL ";
                    } else {
                        $sql_aprov .= " ,DT_DENUNCIA = '$dt_denuncia' ";
                    }

                    if ($dt_fim_per_exp == '') {
                        $sql_aprov .= " ,DT_FIM_PER_EXP = NULL ";
                    } else {
                        $sql_aprov .= " ,DT_FIM_PER_EXP = '$dt_fim_per_exp' ";
                    }

                    $sql_aprov .= " ,ID_PROC_GD = $id_proc_gd_ ";


                    # statment associado à rejeição do registo
                    $sql_rej = "DELETE FROM web_rh_vinculos ".
                               "WHERE empresa = '$empresa' AND rhid = $rhid AND  dt_admissao = '$dt_adm' ".
                               " AND cd_vinculo = '$cd_vinculo' AND dt_ini_vinculo = '$dt_ini_vinculo' ";


                    # notificação
                    $mensagem = 'Criação de vínculo do colaborador';

                    # criação do registo de vínculo para aprovação
                    $stmt2 = $db->prepare(
                             "INSERT INTO web_rh_vinculos ".
                             "(empresa, rhid, dt_admissao, cd_vinculo, dt_ini_vinculo, estado, motivo_admissao, cd_motivo_saida, tp_vinculo, dt_fim_vinculo, vlr_liquido, dt_denuncia, dt_fim_per_exp, ID_PROC_GD, usr_reg, dt_reg) ".
                             "VALUES(:EMPRESA_,:RHID_,:DT_ADMISSAO_,:CD_VINCULO_,:DT_INI_VINCULO_,:ESTADO_,:MOTIVO_ADMISSAO_,:CD_MOTIVO_SAIDA_,:TP_VINCULO_,:DT_FIM_VINCULO_,:VLR_LIQUIDO_,:DT_DENUNCIA_,:DT_FIM_PER_EXP_,$id_proc_gd_,:USR_REG_,:DT_REG_)"
                    );

                    $stmt2->bindParam(':EMPRESA_', $empresa, PDO::PARAM_STR);
                    $stmt2->bindParam(':RHID_', $rhid, PDO::PARAM_STR);
                    $stmt2->bindParam(':DT_ADMISSAO_', $dt_adm, PDO::PARAM_STR);
                    $stmt2->bindParam(':CD_VINCULO_', $cd_vinculo, PDO::PARAM_STR);
                    $stmt2->bindParam(':DT_INI_VINCULO_', $dt_ini_vinculo, PDO::PARAM_STR);
                    $stmt2->bindParam(':ESTADO_', $estado, PDO::PARAM_STR);

                    if ($motivo_admissao == '') {
                        $stmt2->bindParam(':MOTIVO_ADMISSAO_', $null = null, PDO::PARAM_STR);
                    } else {
                        $stmt2->bindParam(':MOTIVO_ADMISSAO_', $motivo_admissao, PDO::PARAM_STR);
                    }

                    if ($cd_motivo_saida == '') {
                        $stmt2->bindParam(':CD_MOTIVO_SAIDA_', $null = null, PDO::PARAM_STR);
                    } else {
                        $stmt2->bindParam(':CD_MOTIVO_SAIDA_', $cd_motivo_saida, PDO::PARAM_STR);
                    }

                    if ($tp_vinculo == '') {
                        $stmt2->bindParam(':TP_VINCULO_', $null = null, PDO::PARAM_STR);
                    } else {
                        $stmt2->bindParam(':TP_VINCULO_', $tp_vinculo, PDO::PARAM_STR);
                    }

                    if ($dt_fim == '') {
                        $stmt2->bindParam(':DT_FIM_VINCULO_', $null = null, PDO::PARAM_STR);
                    } else {
                        $stmt2->bindParam(':DT_FIM_VINCULO_', $dt_fim, PDO::PARAM_STR);
                    }

                    if ($vlr_liquido == '') {
                        $stmt2->bindParam(':VLR_LIQUIDO_', $null = null, PDO::PARAM_STR);
                    } else {
                        $stmt2->bindParam(':VLR_LIQUIDO_', $vlr_liquido, PDO::PARAM_STR);
                    }

                    if ($dt_denuncia == '') {
                        $stmt2->bindParam(':DT_DENUNCIA_', $null = null, PDO::PARAM_STR);
                    } else {
                        $stmt2->bindParam(':DT_DENUNCIA_', $dt_denuncia, PDO::PARAM_STR);
                    }

                    if ($dt_fim_per_exp == '') {
                        $stmt2->bindParam(':DT_FIM_PER_EXP_', $null = null, PDO::PARAM_STR);
                    } else {
                        $stmt2->bindParam(':DT_FIM_PER_EXP_', $dt_fim_per_exp, PDO::PARAM_STR);
                    }

                    $stmt2->bindParam(':USR_REG_', $_SESSION['utilizador'], PDO::PARAM_STR);
                    $stmt2->bindParam(':DT_REG_', date("Y-m-d H:i:s"), PDO::PARAM_STR);

                    $stmt2->execute();
                    $vlr = $dsp_vinculo.' em '.$dt_ini_vinculo;
                    regista_alteracao_cadastro('Vinculos', 'Criado(a) ' . $vlr, 'A', $rhid, $empresa, $dt_adm, '', $vlr, '', $vlr, $sql_aprov, $sql_rej, $mensagem, $msg);

                }
                else {
                    $msg = "Não se encontra definida informação para a criação do vínculo contratual.";
                }
            } catch (PDOException $ex) {
                $msg = "gd_cria_vinculo#2:" . $ex->getMessage();
            }
        }

    }

    #
    # Atualiza a informação de empresa associada à aprovação de um novo documento da gestão documental
    #
    # variáveis: ESTAB_COLOC
    #
    function gd_grava_info_empresa($id_proc_gd_, &$msg) {

        global $db;

        $modulo = 1;
        $perfil = @$_SESSION['perfil'];

        $msg = '';
        try {
            $stmt = $db->prepare("SELECT * FROM RH_ID_GESTAO_DOCUMENTAL A WHERE A.ID_PROC_GD = :ID_PROC_GD_ ");
            $stmt->bindParam(':ID_PROC_GD_', $id_proc_gd_, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $ex) {
            $msg = "gd_grava_info_empresa#1 :" . $ex->getMessage();
        }

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            try {
                $msg = '';
                $seq = '';
                $empresa = $row['EMPRESA'];
                $rhid = $row['RHID'];
                $dt_adm = $row['DT_ADMISSAO'];
                $estab = '';
                $dt_estab = '';
                $new_estab = gd_get_var_value($row['ID_PROC_GD'], 'ESTAB_COLOC', 'VALOR', $seq, $msg);
                $new_dt_estab = gd_get_var_value($row['ID_PROC_GD'], 'DT_INI_VINCULO', 'VALOR', $seq, $msg);

                if ($empresa != '' && $rhid != '' && $dt_adm != '' && $new_estab != '' && $new_dt_estab != '') {

                    try {
                        $stmt1 = $db->prepare("SELECT A.* FROM RH_ID_EMPRESAS A ".
                                              "WHERE A.EMPRESA = :EMPRESA_ ".
                                              "  AND A.RHID = :RHID_ ".
                                              "  AND A.DT_ADMISSAO = :DT_ADMISSAO_ ");

                        $stmt1->bindParam(':EMPRESA_', $empresa, PDO::PARAM_STR);
                        $stmt1->bindParam(':RHID_', $rhid, PDO::PARAM_STR);
                        $stmt1->bindParam(':DT_ADMISSAO_', $dt_adm, PDO::PARAM_STR);
                        $stmt1->execute();

                        $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
                        $estab = $row1['CD_ESTAB'];
                        $dt_estab = $row1['DT_ESTAB'];

                    } catch (Exception $ex) {
                        $msg = "gd_grava_info_empresa#2 :" . $ex->getMessage();
                    }

                    if ($msg == '') {

                        $mensagem = '';
                        $sql_aprov = "UPDATE RH_ID_EMPRESAS SET INTEGRADO_BO = 'N', <col> = '<vlr>' ".
                                     "WHERE RHID = '<chave1>' AND EMPRESA = '<chave2>' AND DT_ADMISSAO = '<chave3>'";
                        $sql_rej =   "UPDATE web_rh_empresas SET <col> = '<vlr>' ".
                                     "WHERE rhid = '<chave1>' and empresa = '<chave2>' and dt_admissao = '<chave3>'";

                        # chave do registo
                        $sql_aprov = str_replace('<chave1>',$rhid, $sql_aprov);
                        $sql_aprov = str_replace('<chave2>',$empresa, $sql_aprov);
                        $sql_aprov = str_replace('<chave3>',$dt_adm, $sql_aprov);

                        $sql_rej = str_replace('<chave1>',$rhid, $sql_rej);
                        $sql_rej = str_replace('<chave2>',$empresa, $sql_rej);
                        $sql_rej = str_replace('<chave3>',$dt_adm, $sql_rej);

                        if (diferente($estab,$new_estab) == 'S' && $msg == '') {
                            $ant = dsp_estab($empresa,$estab,$msg);
                            $vlr = dsp_estab($empresa,$new_estab,$msg);

                            ## estabelecimento
                            $sql_rj = str_replace('<col>','cd_estab', $sql_rej);
                            $sql_ap = str_replace('<col>','CD_ESTAB', $sql_aprov);
                            $mensagem = 'Alteração do estabelecimento do colaborador.';
                            regista_alteracao_cadastro('Info.Empresas','Estabelecimento','A',$rhid,$empresa,$dt_adm,$estab,$new_estab,$ant,$vlr,$sql_ap,$sql_rj,$mensagem,$msg);

                            ## data colocação estabelecimento
                            $sql_rj = str_replace('<col>','dt_estab', $sql_rej);
                            $sql_ap = str_replace('<col>','DT_ESTAB', $sql_aprov);
                            $mensagem = 'Alteração data de colocação no estabelecimento do colaborador.';
                            regista_alteracao_cadastro('Info.Empresas','Data colocação estabelecimento','A',$rhid,$empresa,$dt_adm,$dt_estab,$new_dt_estab,$dt_estab,$new_dt_estab,$sql_ap,$sql_rj,$mensagem,$msg);

                            try {
                                $stmt2 = $db->prepare("UPDATE web_rh_empresas A ".
                                                      "SET usr_reg = '".@$_SESSION['utilizador']."' ".
                                                      "   ,dt_reg = '".date("Y-m-d H:i:s")."' ".
                                                      "   ,cd_estab = :CD_ESTAB_, dt_estab = :DT_ESTAB_ ".
                                                      "WHERE A.empresa = :EMPRESA_ ".
                                                      "  AND A.rhid = :RHID_ ".
                                                      "  AND A.dt_admissao = :DT_ADMISSAO_ ");

                                $stmt2->bindParam(':EMPRESA_', $empresa, PDO::PARAM_STR);
                                $stmt2->bindParam(':RHID_', $rhid, PDO::PARAM_STR);
                                $stmt2->bindParam(':DT_ADMISSAO_', $dt_adm, PDO::PARAM_STR);
                                $stmt2->bindParam(':CD_ESTAB_', $new_estab, PDO::PARAM_STR);
                                $stmt2->bindParam(':DT_ESTAB_', $new_dt_estab, PDO::PARAM_STR);
                                $stmt2->execute();

                            } catch (Exception $ex) {
                                $msg = "erro#2 :" . $ex->getMessage();
                            }

                        }
                    }
                } else {
                    $msg = "Não se encontra definida informação de estabelecimento para atualizar.";
                }

            } catch (PDOException $ex) {
                $msg = "gd_grava_info_empresa#3:" . $ex->getMessage();
            }
        }

    }

    #
    # Atualiza a informação profissional associada à aprovação de um novo documento da gestão documental
    #
    # variáveis: NOVA_CATEG_PROFISSIONAL, NIVEL, HOR_SEMANAL
    #
    function gd_grava_info_prof($id_proc_gd_, &$msg) {

        global $db;

        $modulo = 1;
        $perfil = @$_SESSION['perfil'];

        $msg = '';
        try {
            $stmt = $db->prepare("SELECT * FROM RH_ID_GESTAO_DOCUMENTAL A WHERE A.ID_PROC_GD = :ID_PROC_GD_ ");
            $stmt->bindParam(':ID_PROC_GD_', $id_proc_gd_, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $ex) {
            $msg = "gd_grava_info_prof#1 :" . $ex->getMessage();
        }

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            try {
                $msg = '';
                $seq = '';
                $empresa = $row['EMPRESA'];
                $rhid = $row['RHID'];
                $dt_adm = $row['DT_ADMISSAO'];

                $cat_prof = '';
                $dt_cat_prof = '';
                $nivel = '';
                $dt_nivel = '';
                $hor_sem = '';
                $dt_hor = '';

                $new_cat_prof = gd_get_var_value($row['ID_PROC_GD'], 'NOVA_CATEG_PROFISSIONAL', 'VALOR', $seq, $msg);
                $new_nivel = gd_get_var_value($row['ID_PROC_GD'], 'NIVEL', 'VALOR', $seq, $msg);
                $new_hor_sem = gd_get_var_value($row['ID_PROC_GD'], 'HOR_SEMANAL', 'VALOR', $seq, $msg);

                $new_dt_vigor = gd_get_var_value($row['ID_PROC_GD'], 'DT_INI_VINCULO', 'VALOR', $seq, $msg);

                if ($empresa != '' && $rhid != '' && $dt_adm != '' && ($new_cat_prof != '' || $new_nivel != '' || $new_hor_sem != '') && $new_dt_vigor != '') {
                    try {
                        $stmt1 = $db->prepare("SELECT A.* FROM RH_ID_PROFISSIONAIS A ".
                                              "WHERE A.EMPRESA = :EMPRESA_ ".
                                              "  AND A.RHID = :RHID_ ".
                                              "  AND A.DT_ADMISSAO = :DT_ADMISSAO_ ");

                        $stmt1->bindParam(':EMPRESA_', $empresa, PDO::PARAM_STR);
                        $stmt1->bindParam(':RHID_', $rhid, PDO::PARAM_STR);
                        $stmt1->bindParam(':DT_ADMISSAO_', $dt_adm, PDO::PARAM_STR);
                        $stmt1->execute();

                        $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
                        $cat_prof = $row1['CD_CATG_PROF'];
                        $dt_cat_prof = $row1['DT_CATG_PROF'];
                        $nivel = $row1['CD_NIVEL'];
                        $dt_nivel = $row1['DT_NIVEL'];
                        $hor_sem = $row1['CD_HORARIO'].'@'.$row1['TP_HORARIO'];
                        $dt_hor = $row1['DT_HORARIO'];

                    } catch (Exception $ex) {
                        $msg = "gd_grava_info_prof#2 :" . $ex->getMessage();
                    }

                    if ($msg == '') {

                        $mensagem = '';
                        $sql_aprov = "UPDATE rh_id_profissionais SET INTEGRADO_BO = 'N', <col> = '<vlr>' ".
                                     "WHERE RHID = '<chave1>' AND EMPRESA = '<chave2>' AND DT_ADMISSAO = '<chave3>'";
                        $sql_rej =   "UPDATE web_rh_profissionais SET <col> = '<vlr>' ".
                                     "WHERE rhid = '<chave1>' and empresa = '<chave2>' and dt_admissao = '<chave3>'";

                        # chave do registo
                        $sql_aprov = str_replace('<chave1>',$rhid, $sql_aprov);
                        $sql_aprov = str_replace('<chave2>',$empresa, $sql_aprov);
                        $sql_aprov = str_replace('<chave3>',$dt_adm, $sql_aprov);

                        $sql_rej = str_replace('<chave1>',$rhid, $sql_rej);
                        $sql_rej = str_replace('<chave2>',$empresa, $sql_rej);
                        $sql_rej = str_replace('<chave3>',$dt_adm, $sql_rej);


                        $cp = false;
                        $nv = false;
                        $hor = false;

                        # categoria profissional
                        if (diferente($cat_prof,$new_cat_prof) == 'S' && $msg == '') {
                            $ant = dsp_cat_prof($cat_prof,$msg);
                            $vlr = dsp_cat_prof($new_cat_prof,$msg);

                            ## categoria profissional
                            $sql_rj = str_replace('<col>','cd_catg_prof', $sql_rej);
                            $sql_ap = str_replace('<col>','CD_CATG_PROF', $sql_aprov);

                            $mensagem = 'Alteração da categoria profissional do colaborador';
                            regista_alteracao_cadastro('Info.Profissional','Categ.Profissional','A',$rhid,$empresa,$dt_adm,$cat_prof,$new_cat_prof,$ant,$vlr,$sql_ap,$sql_rj,$mensagem,$msg);

                            ## data categoria profissional
                            $sql_rj = str_replace('<col>','dt_catg_prof', $sql_rej);
                            $sql_ap = str_replace('<col>','DT_CATG_PROF', $sql_aprov);

                            $mensagem = 'Alteração data da categoria profissional do '.$ui_colab;
                            regista_alteracao_cadastro('Info.Profissional','Data Categoria Profissional','A',$rhid,$empresa,$dt_adm,$dt_cat_prof,$new_dt_vigor,$dt_cat_prof,$new_dt_vigor,$sql_ap,$sql_rj,$mensagem,$msg);

                            $cp = true;
                        }

                        # nivel
                        if (diferente($nivel,$new_nivel) == 'S' && $msg == '') {
                            $ant = dsp_nivel($nivel,$msg);
                            $vlr = dsp_nivel($new_nivel,$msg);

                            ## nivel
                            $sql_rj = str_replace('<col>','cd_nivel', $sql_rej);
                            $sql_ap = str_replace('<col>','CD_NIVEL', $sql_aprov);

                            $mensagem = 'Alteração do nível retributivo do '.$ui_colab;
                            regista_alteracao_cadastro('Info.Profissional','Nível Retributivo','A',$rhid,$empresa,$dt_adm,$nivel,$new_nivel,$ant,$vlr,$sql_ap,$sql_rj,$mensagem,$msg);

                            ## data nível
                            $sql_rj = str_replace('<col>','dt_nivel', $sql_rej);
                            $sql_ap = str_replace('<col>','DT_NIVEL', $sql_aprov);

                            $mensagem = 'Alteração data do nível retributivo do '.$ui_colab;
                            regista_alteracao_cadastro('Info.Profissional','Data nível','A',$rhid,$empresa,$dt_adm,$dt_nivel,$new_dt_vigor,$dt_nivel,$new_dt_vigor,$sql_ap,$sql_rj,$mensagem,$msg);

                            $nv = true;
                        }

                        # horário semanal
                        if (diferente($hor_sem,$new_hor_sem) == 'S' && $msg == '') {
                            $ant = dsp_horario($hor_sem,$msg);
                            $vlr = dsp_horario($new_hor_sem,$msg);

                            $p = explode($hor_sem);
                            $old_cd_hor = $p[0];
                            $old_tp_hor = $p[1];

                            $p = explode($new_hor_sem);
                            $new_cd_hor = $p[0];
                            $new_tp_hor = $p[1];

                            ## horário
                            $sql_ap = "UPDATE rh_id_profissionais SET INTEGRADO_BO = 'N', <col1> = '<vlr1>',  <col2> = '<vlr2>'  ".
                                         "WHERE RHID = '<chave1>' AND EMPRESA = '<chave2>' AND DT_ADMISSAO = '<chave3>'";

                            $sql_rj =   "UPDATE web_rh_profissionais SET <col1> = '<vlr1>', <col2> = '<vlr2>' ".
                                         "WHERE rhid = '<chave1>' and empresa = '<chave2>' and dt_admissao = '<chave3>'";

                            # chave do registo
                            $sql_ap = str_replace('<chave1>',$rhid, $sql_ap);
                            $sql_ap = str_replace('<chave2>',$empresa, $sql_ap);
                            $sql_ap = str_replace('<chave3>',$dt_adm, $sql_ap);

                            $sql_rj = str_replace('<chave1>',$rhid, $sql_rj);
                            $sql_rj = str_replace('<chave2>',$empresa, $sql_rj);
                            $sql_rj = str_replace('<chave3>',$dt_adm, $sql_rj);

                            $sql_rj = str_replace('<col1>','tp_horario', $sql_rj);
                            $sql_ap = str_replace('<col1>','TP_HORARIO', $sql_ap);

                            $sql_rj = str_replace('<col2>','cd_horario', $sql_rj);
                            $sql_ap = str_replace('<col2>','CD_HORARIO', $sql_ap);

                            # efectua aqui a substituição em vez de fazer no regista_alteracao_cadastro,
                            # dado este caso ser uma excepção por ter mais do que uma coluna ...
                            $sql_rj = str_replace('<vlr1>', $old_tp_hor, $sql_rj);
                            $sql_ap = str_replace('<vlr1>', $new_tp_hor, $sql_ap);

                            $sql_rj = str_replace('<vlr2>', $old_cd_hor, $sql_rj);
                            $sql_ap = str_replace('<vlr2>', $new_cd_hor, $sql_ap);

                            $mensagem = 'Alteração do horário do colaborador';
                            regista_alteracao_cadastro('Info.Profissional','Horário','A',$rhid,$empresa,$dt_adm,$old_tp_hor.'@'.$old_cd_hor,$new_tp_hor.'@'.$new_cd_hor,$ant,$vlr,$sql_ap,$sql_rj,$mensagem,$msg);

                            ## data horário
                            $sql_rj = str_replace('<col>','dt_horario', $sql_rej);
                            $sql_ap = str_replace('<col>','DT_HORARIO', $sql_aprov);

                            $mensagem = 'Alteração data do horário do colaborador';
                            regista_alteracao_cadastro('Info.Profissional','Data Horário','A',$rhid,$empresa,$dt_adm,$dt_hor,$new_dt_vigor,$dt_hor,$new_dt_vigor,$sql_ap,$sql_rj,$mensagem,$msg);

                            $hor = true;
                        }

                        if ($cp || $nv || $hor) {
                            try {
                                $sql = "UPDATE web_rh_profissionais A ".
                                       "SET usr_reg = '".@$_SESSION['utilizador']."' ".
                                       "   ,dt_reg = '".date("Y-m-d H:i:s")."' ";

                                if ($cp) {
                                    $sql .= ",cd_catg_prof = :CD_CAT_PROF_ ".
                                            ",dt_catg_prof = :DT_CAT_PROF_ ";
                                }

                                if ($nv) {
                                    $sql .= ",cd_nivel = :CD_NIVEL_ ".
                                            ",dt_nivel = :DT_NIVEL_ ";
                                }

                                if ($hor) {
                                    $sql .= ",cd_horario = :CD_HORARIO_ ".
                                            ",tp_horario = :TP_HORARIO_ ".
                                            ",dt_horario = :DT_HORARIO_ ";
                                }

                                $sql .= "WHERE A.empresa = :EMPRESA_ ".
                                        "  AND A.rhid = :RHID_ ".
                                        "  AND A.dt_admissao = :DT_ADMISSAO_ ";

                                $stmt2 = $db->prepare($sql);

                                $stmt2->bindParam(':EMPRESA_', $empresa, PDO::PARAM_STR);
                                $stmt2->bindParam(':RHID_', $rhid, PDO::PARAM_STR);
                                $stmt2->bindParam(':DT_ADMISSAO_', $dt_adm, PDO::PARAM_STR);

                                if ($cp) {
                                    $stmt2->bindParam(':CD_CAT_PROF_', $new_cat_prof, PDO::PARAM_STR);
                                    $stmt2->bindParam(':DT_CAT_PROF_', $new_dt_vigor, PDO::PARAM_STR);
                                }
                                if ($nv) {
                                    $stmt2->bindParam(':CD_NIVEL_', $new_nivel, PDO::PARAM_STR);
                                    $stmt2->bindParam(':DT_NIVEL_', $new_dt_vigor, PDO::PARAM_STR);
                                }
                                if ($hor) {
                                    $p = explode("@",$hor);
                                    $new_cd_hor = $p[0];
                                    $new_tp_hor = $p[0];
                                    $stmt2->bindParam(':CD_HORARIO_', $new_cd_hor, PDO::PARAM_STR);
                                    $stmt2->bindParam(':TP_HORARIO_', $new_tp_hor, PDO::PARAM_STR);
                                    $stmt2->bindParam(':DT_HORARIO_', $new_dt_vigor, PDO::PARAM_STR);
                                }
                                $stmt2->execute();

                            } catch (Exception $ex) {
                                $msg = "erro#2 :" . $ex->getMessage();
                            }
                        }

                    } else {
                        $msg = "Não se encontra definida informação profissional para atualizar.";
                    }
                }

            } catch (PDOException $ex) {
                $msg = "gd_grava_info_prof#3:" . $ex->getMessage();
            }
        }

    }

    #
    # Cria uma nova função para aprovação no cadastro após conclusão do workflow da gestão documental
    #
    function gd_cria_nova_funcao($id_proc_gd_, &$msg) {

        global $db;

        $modulo = 21;
        $perfil = @$_SESSION['perfil'];

        $msg = '';
        try {
            $stmt = $db->prepare("SELECT * FROM RH_ID_GESTAO_DOCUMENTAL A WHERE A.ID_PROC_GD = :ID_PROC_GD_ ");
            $stmt->bindParam(':ID_PROC_GD_', $id_proc_gd_, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $ex) {
            $msg = "gd_cria_nova_funcao#1 :" . $ex->getMessage();
        }

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            try {

                $msg = '';
                $seq = '';
                $empresa = $row['EMPRESA'];
                $rhid = $row['RHID'];
                $dt_adm = $row['DT_ADMISSAO'];

                $cd_funcao = gd_get_var_value($row['ID_PROC_GD'], 'NOVA_FUNCAO', 'VALOR', $seq, $msg);
                $dsp_funcao = gd_get_var_value($row['ID_PROC_GD'], 'NOVA_FUNCAO', 'DSP', $seq, $msg);
                $p = explode("@",$cd_funcao);
                $id_funcao = $p[0];
                $dt_ini_funcao = $p[1];
                $tipo = 'A';
                $tp_registo = 'A';
                $dt_ini = gd_get_var_value($row['ID_PROC_GD'], 'DT_INI_VINCULO', 'VALOR', $seq, $msg);
                $dt_fim = '';
                $descricao = '';
                $dsp_exper_ant = '';
                $dsr_exper_ant = '';
                $modo_ocup = '';

                $estado = 'A';
                if ($perfil == 'A') { # colaborador
                    $estado = 'A';
                } elseif ($perfil == 'B') { # gestor administrativo
                    $estado = 'B';
                } elseif ($perfil == 'C') { # supervisor
                    $estado = 'C';
                } elseif ($perfil == 'D') { # director
                    $estado = 'D';
                } elseif ($perfil == 'F' || # dep.recursos humanos
                          $perfil == 'E' || # Gestor - outsourcing
                          $perfil == 'Z') {  # Administrador
                    $estado = 'E';
                }
                $estado = altera_estado($modulo, $sigla, $rhid, $estado);
                $auto_aprov = auto_aprovacao($modulo, $perfil);
                if ($auto_aprov) {
                    $estado = 'E';
                }

                if ($empresa != '' && $rhid != '' && $dt_adm != '' && $id_funcao != '' && $dt_ini_funcao != '' && $dt_ini != '') {

                    if ($dt_fim == '') {
                        $msg_notif = 'Novo registo de função ' . $dsp_funcao . ' de ' . substr($dt_ini, 0, 10);
                    } else {
                        $msg_notif = 'Novo registo de função ' . $dsp_funcao . ' entre ' . substr($dt_ini, 0, 10) . ' e ' . $dt_fim;
                    }

                    try {

                        $sql = "INSERT INTO web_rh_id_funcoes " .
                                " (RHID, TIPO, DT_INI, EMPRESA, ID_FUNCAO, TP_REGISTO, DT_INI_FUNCAO, DT_ADMISSAO, DESCRICAO, DSP_EXPERIENCIA_ANT, DSR_EXPERIENCIA_ANT, DT_FIM, MODO_OCUPACAO_PT_FP, REMOVIDO, ESTADO, MSG_NOTIF, INTEGRADO_BO, USR_REG, DT_REG) " .
                                " VALUES (:RHID_, :TIPO_, :DT_INI_, :EMPRESA_, :ID_FUNCAO_, :TP_REGISTO_, :DT_INI_FUNCAO_, :DT_ADMISSAO_, :DESCRICAO_, :DSP_EXPER_ANT_, :DSR_EXPER_ANT_, :DT_FIM_, :MODO_OCUP_, 'N', :ESTADO_, :MSG_NOTIF_, 'N', :USR_REG_, :DT_REG_) " .
                                "ON DUPLICATE KEY UPDATE " .
                                " DT_ADMISSAO = :DT_ADMISSAO_ " .
                                ",DESCRICAO = :DESCRICAO_ " .
                                ",DSP_EXPERIENCIA_ANT = :DSP_EXPER_ANT_ " .
                                ",DSR_EXPERIENCIA_ANT = :DSR_EXPER_ANT_ " .
                                ",DT_FIM = :DT_FIM_ " .
                                ",MODO_OCUPACAO_PT_FP = :MODO_OCUP_ " .
                                ",REMOVIDO = 'N' " .
                                ",ESTADO = :ESTADO_ " .
                                ",MSG_NOTIF = :MSG_NOTIF_ " .
                                ",INTEGRADO_BO = 'N' " .
                                ",USR_REG = :USR_REG_ " .
                                ",DT_REG = :DT_REG_ " .
                                ",USR_APROV = NULL " .
                                ",DT_APROV = NULL ";

                        # criação do registo de função
                        $stmt2 = $db->prepare($sql);

                        $stmt2->bindParam(':EMPRESA_', $empresa, PDO::PARAM_STR);
                        $stmt2->bindParam(':RHID_', $rhid, PDO::PARAM_STR);
                        $stmt2->bindParam(':DT_ADMISSAO_', $dt_adm, PDO::PARAM_STR);
                        $stmt2->bindParam(':ID_FUNCAO_', $id_funcao, PDO::PARAM_STR);
                        $stmt2->bindParam(':DT_INI_FUNCAO_', $dt_ini_funcao, PDO::PARAM_STR);
                        $stmt2->bindParam(':TIPO_', $tipo, PDO::PARAM_STR);
                        $stmt2->bindParam(':TP_REGISTO_', $tp_registo, PDO::PARAM_STR);
                        $stmt2->bindParam(':DT_INI_', $dt_ini, PDO::PARAM_STR);

                        if ($dt_fim == '') {
                            $stmt2->bindParam(':DT_FIM_', $null = null, PDO::PARAM_STR);
                        } else {
                            $stmt2->bindParam(':DT_FIM_', $dt_fim, PDO::PARAM_STR);
                        }

                        if ($descricao == '') {
                            $stmt2->bindParam(':DESCRICAO_', $null = null, PDO::PARAM_STR);
                        } else {
                            $stmt2->bindParam(':DESCRICAO_', $descricao, PDO::PARAM_STR);
                        }

                        if ($dsp_exper_ant == '') {
                            $stmt2->bindParam(':DSP_EXPER_ANT_', $null = null, PDO::PARAM_STR);
                        } else {
                            $stmt2->bindParam(':DSP_EXPER_ANT_', $dsp_exper_ant, PDO::PARAM_STR);
                        }

                        if ($dsr_exper_ant == '') {
                            $stmt2->bindParam(':DSR_EXPER_ANT_', $null = null, PDO::PARAM_STR);
                        } else {
                            $stmt2->bindParam(':DSR_EXPER_ANT_', $dsr_exper_ant, PDO::PARAM_STR);
                        }

                        if ($modo_ocup == '') {
                            $stmt2->bindParam(':MODO_OCUP_', $null = null, PDO::PARAM_STR);
                        } else {
                            $stmt2->bindParam(':MODO_OCUP_', $modo_ocup, PDO::PARAM_STR);
                        }

                        $stmt2->bindParam(':ESTADO_', $estado, PDO::PARAM_STR);
                        $stmt2->bindParam(':MSG_NOTIF_', $msg_notif, PDO::PARAM_STR);
                        $stmt2->bindParam(':USR_REG_', $_SESSION['utilizador'], PDO::PARAM_STR);
                        $stmt2->bindParam(':DT_REG_', date("Y-m-d H:i:s"), PDO::PARAM_STR);

                        $stmt2->execute();

                    } catch (PDOException $ex) {
                        $msg = "gd_cria_nova_funcao#2:" . $ex->getMessage();
                    }

                    if ($msg == '') {
                        try {
                            # fecha função anterior
                            $stmt2 = $db->prepare("SELECT a.*, b.DSP_FUNCAO ".
                                                  "FROM RH_ID_FUNCOES a, RH_DEF_FUNCOES b ".
                                                  "WHERE a.EMPRESA = :EMPRESA_ ".
                                                  "  AND a.RHID = :RHID_ ".
                                                  "  AND a.TIPO = :TIPO_ ".
                                                  #"  AND a.REMOVIDO = 'N' ".
                                                  #"  AND a.ESTADO = 'E' ".
                                                  "  AND a.ESTADO_ESTORNO IS NULL ".
                                                  "  AND a.DT_INI < :DT_INI_ ".
                                                  "  AND b.EMPRESA = a.EMPRESA ".
                                                  "  AND b.ID_FUNCAO = a.ID_FUNCAO ".
                                                  "  AND b.TP_REGISTO = a.TP_REGISTO ".
                                                  "  AND b.DT_INI_FUNCAO = a.DT_INI_FUNCAO ".
                                                  "ORDER BY DT_INI DESC ");

                            $stmt2->bindParam(':EMPRESA_', $empresa, PDO::PARAM_STR);
                            $stmt2->bindParam(':RHID_', $rhid, PDO::PARAM_STR);
                            $stmt2->bindParam(':TIPO_', $tipo, PDO::PARAM_STR);
                            $stmt2->bindParam(':DT_INI_', $dt_ini, PDO::PARAM_STR);
                            $stmt2->execute();
                            while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {

                                $msg_notif = 'Alteração da data fim do registo de função ' . $row2['DSP_FUNCAO'] . ' para ' . substr($dt_ini, 0, 10);

                                $stmt3 = $db->prepare("UPDATE web_rh_id_funcoes a ".
                                                      "SET a.DT_FIM = :DT_FIM_, a.ESTADO = :ESTADO_, a.INTEGRADO_BO = 'N', MSG_NOTIF = :MSG_NOTIF_ ".
                                                      "   ,a.USR_REG = :USR_REG_, a.DT_REG = :DT_REG_ ".
                                                      "WHERE a.RHID = :RHID_ ".
                                                      "  AND a.TIPO = :TIPO_ ".
                                                      "  AND a.DT_INI = :DT_INI_ ".
                                                      "  AND a.EMPRESA = :EMPRESA_ ".
                                                      "  AND a.ID_FUNCAO = :ID_FUNCAO_ ".
                                                      "  AND a.TP_REGISTO = :TP_REGISTO_ ".
                                                      "  AND a.DT_INI_FUNCAO = :DT_INI_FUNCAO_ ");

                                $stmt3->bindParam(':RHID_', $row2['RHID'], PDO::PARAM_STR);
                                $stmt3->bindParam(':TIPO_', $row2['TIPO'], PDO::PARAM_STR);
                                $stmt3->bindParam(':DT_INI_', $row2['DT_INI'], PDO::PARAM_STR);
                                $stmt3->bindParam(':EMPRESA_', $row2['EMPRESA'], PDO::PARAM_STR);
                                $stmt3->bindParam(':ID_FUNCAO_', $row2['ID_FUNCAO'], PDO::PARAM_STR);
                                $stmt3->bindParam(':TP_REGISTO_', $row2['TP_REGISTO'], PDO::PARAM_STR);
                                $stmt3->bindParam(':DT_INI_FUNCAO_', $row2['DT_INI_FUNCAO'], PDO::PARAM_STR);

                                $dt_fim_f = date('Y-m-d',strtotime(substr($dt_ini,0,10) . "-1 days"));
                                $stmt3->bindParam(':DT_FIM_', $dt_fim_f, PDO::PARAM_STR);
                                $stmt3->bindParam(':ESTADO_', $estado, PDO::PARAM_STR);
                                $stmt3->bindParam(':MSG_NOTIF_', $msg_notif, PDO::PARAM_STR);
                                $stmt3->bindParam(':USR_REG_', $_SESSION['utilizador'], PDO::PARAM_STR);
                                $stmt3->bindParam(':DT_REG_', date("Y-m-d H:i:s"), PDO::PARAM_STR);

                                $stmt3->execute();

                                break;
                            }

                        } catch (PDOException $ex) {
                            $msg = "gd_cria_nova_funcao#3:" . $ex->getMessage();
                        }
                    }

                    if ($msg == '') {
                        carimba_tabela_controlo('rh_id_funcoes',$msg);
                    }

                } else {
                    $msg = "Não se encontra definida informação para a criação do função.";
                }

            } catch (PDOException $ex) {
                $msg = "gd_cria_nova_funcao#4:" . $ex->getMessage();
            }
        }

    }

    #
    # Cria uma nova linha salarial com o novo salário
    #
    function gd_cria_novo_salario($id_proc_gd_, &$msg) {

        global $db;

        $modulo = 1;
        $perfil = @$_SESSION['perfil'];

        $msg = '';
        try {
            $stmt = $db->prepare("SELECT * FROM RH_ID_GESTAO_DOCUMENTAL A WHERE A.ID_PROC_GD = :ID_PROC_GD_ ");
            $stmt->bindParam(':ID_PROC_GD_', $id_proc_gd_, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $ex) {
            $msg = "gd_cria_novo_salario#1 :" . $ex->getMessage();
        }

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            try {

                $msg = '';
                $seq = '';
                $empresa = $row['EMPRESA'];
                $rhid = $row['RHID'];
                $dt_adm = $row['DT_ADMISSAO'];

                $salario = gd_get_var_value($row['ID_PROC_GD'], 'SALARIO', 'VALOR', $seq, $msg);
                $dt_ini = substr(gd_get_var_value($row['ID_PROC_GD'], 'DT_INI_VINCULO', 'VALOR', $seq, $msg),0,8).'01';

                $estado = 'A';
                if ($perfil == 'A') { # colaborador
                    $estado = 'A';
                } elseif ($perfil == 'B') { # gestor administrativo
                    $estado = 'B';
                } elseif ($perfil == 'C') { # supervisor
                    $estado = 'C';
                } elseif ($perfil == 'D') { # director
                    $estado = 'D';
                } elseif ($perfil == 'F' || # dep.recursos humanos
                          $perfil == 'E' || # Gestor - outsourcing
                          $perfil == 'Z') {  # Administrador
                    $estado = 'E';
                }
                $estado = altera_estado($modulo, $sigla, $rhid, $estado);
                $auto_aprov = auto_aprovacao($modulo, $perfil);
                if ($auto_aprov) {
                    $estado = 'E';
                }

                #determinação da grelha salarial (1º grelha individual
                $cd_grelha = '';
                try {
                    $stmt2 = $db->prepare("SELECT CD_GRELHA_SALARIAL FROM RH_DEF_GRELHAS_SALARIAIS WHERE TP_GRELHA_SALARIAL = 'B' AND ACTIVO = 'S' ORDER BY 1 ASC");
                    $stmt2->execute();
                    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
                    if ($row2['CD_GRELHA_SALARIAL'] != '') {
                        $cd_grelha = $row2['CD_GRELHA_SALARIAL'];
                    } else {
                        $msg = "Não foi possível determinar a grelha associada ao salário.";
                    }
                } catch (Exception $ex) {
                    $msg = "gd_cria_novo_salario#2:" . $ex->getMessage();
                }

                if ($empresa != '' && $rhid != '' && $dt_adm != '' && $salario != '' && $dt_ini != '' && $cd_grelha != '' && $msg == '') {

                    ## confirmar que existe linha definida
                    try {
                        $dsp_linha = dsp_nome_colab($rhid, 'COMP', $msg);
                        if ($dsp_linha == '')
                            $dsp_linha = '.';

                        $sql = "INSERT INTO rh_def_linhas_salariais " .
                                " (CD_GRELHA_SALARIAL, CD_LINHA_SALARIAL, DSP_LINHA_SALARIAL) " .
                                " VALUES (:CD_GRELHA_SALARIAL_, :CD_LINHA_SALARIAL_, :DSP_LINHA_SALARIAL_) " .
                                "ON DUPLICATE KEY UPDATE " .
                                " CD_LINHA_SALARIAL = :CD_LINHA_SALARIAL_ ";

                        # criação do registo de função
                        $stmt2 = $db->prepare($sql);
                        $stmt2->bindParam(':CD_GRELHA_SALARIAL_', $cd_grelha, PDO::PARAM_STR);
                        $stmt2->bindParam(':CD_LINHA_SALARIAL_', $rhid, PDO::PARAM_STR);
                        $stmt2->bindParam(':DSP_LINHA_SALARIAL_', $dsp_linha, PDO::PARAM_STR);
                        $stmt2->execute();

                    } catch (PDOException $ex) {
                        $msg = "gd_cria_novo_salario#3:" . $ex->getMessage();
                    }

                    # fecha linha anterior
                    if ($msg == '') {
                        try {
                            $stmt2 = $db->prepare("SELECT a.DT_VALOR, a.VALOR, a.DT_INACTIVO, a.INTEGRADO_BO ".
                                                  "FROM RH_DEF_VALORES_SALARIAIS a ".
                                                  "WHERE a.CD_GRELHA_SALARIAL = :CD_GRELHA_SALARIAL_ ".
                                                  "  AND a.CD_LINHA_SALARIAL = :CD_LINHA_SALARIAL_ ".
                                                  "  AND a.DT_VALOR < :DT_INI_ ".
                                                  "ORDER BY a.DT_VALOR DESC ");

                            $stmt2->bindParam(':CD_GRELHA_SALARIAL_', $cd_grelha, PDO::PARAM_STR);
                            $stmt2->bindParam(':CD_LINHA_SALARIAL_', $rhid, PDO::PARAM_STR);
                            $stmt2->bindParam(':DT_INI_', $dt_ini, PDO::PARAM_STR);
                            $stmt2->execute();
                            while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {

                                $msg_notif = 'Alteração da data fim do registo de função ' . $row2['DSP_FUNCAO'] . ' para ' . substr($dt_ini, 0, 10);

                                $stmt3 = $db->prepare("UPDATE rh_def_valores_salariais a ".
                                                      "SET a.DT_INACTIVO = :DT_INACTIVO_, a.INTEGRADO_BO = 'N' ".
                                                      "WHERE a.CD_GRELHA_SALARIAL = :CD_GRELHA_SALARIAL_ ".
                                                      "  AND a.CD_LINHA_SALARIAL = :CD_LINHA_SALARIAL_ ".
                                                      "  AND a.DT_VALOR = :DT_VALOR_ ");

                                $stmt3->bindParam(':CD_GRELHA_SALARIAL_', $cd_grelha, PDO::PARAM_STR);
                                $stmt3->bindParam(':CD_LINHA_SALARIAL_', $rhid, PDO::PARAM_STR);
                                $stmt3->bindParam(':DT_VALOR_', $row2['DT_VALOR'], PDO::PARAM_STR);

                                $dt_fim_f = date('Y-m-t',strtotime(substr($dt_ini,0,10) . "-1 days"));
                                $stmt3->bindParam(':DT_INACTIVO_', $dt_fim_f, PDO::PARAM_STR);

                                $stmt3->execute();

                                break;
                            }

                        } catch (PDOException $ex) {
                            $msg = "gd_cria_novo_salario#4:" . $ex->getMessage();
                        }
                    }

                    ## cria novo registo
                    if ($msg == '') {
                        try {
                            $stmt2 = $db->prepare("INSERT INTO rh_def_valores_salariais  ".
                                                  " (CD_GRELHA_SALARIAL, CD_LINHA_SALARIAL, DT_VALOR, VALOR, INTEGRADO_BO) ".
                                                  "VALUES(:CD_GRELHA_SALARIAL_, :CD_LINHA_SALARIAL_, :DT_VALOR_, :VALOR_, 'N')");

                            $stmt2->bindParam(':CD_GRELHA_SALARIAL_', $cd_grelha, PDO::PARAM_STR);
                            $stmt2->bindParam(':CD_LINHA_SALARIAL_', $rhid, PDO::PARAM_STR);
                            $stmt2->bindParam(':DT_VALOR_', $dt_ini, PDO::PARAM_STR);
                            $stmt2->bindParam(':VALOR_', $salario, PDO::PARAM_STR);

                            $stmt2->execute();

                        } catch (PDOException $ex) {
                            $msg = "gd_cria_novo_salario#5:" . $ex->getMessage();
                        }
                    }

                } else {
                    if ($msg == '') {
                        $msg = "Não se encontra definida informação para a criação do novo salário.";
                    }
                }

            } catch (PDOException $ex) {
                $msg = "gd_cria_novo_salario#6:" . $ex->getMessage();
            }
        }

    }

    #
    # Cria a entidade de desconto para aprovação no cadastro após conclusão do workflow da gestão documental
    #
    function gd_cria_entidade_desconto($id_proc_gd_, $cd_ed, $cd_reg_desc, &$msg) {

        global $db;

        $modulo = 1;
        $perfil = @$_SESSION['perfil'];

        $msg = '';
        try {
            $stmt = $db->prepare("SELECT * FROM RH_ID_GESTAO_DOCUMENTAL A WHERE A.ID_PROC_GD = :ID_PROC_GD_ ");
            $stmt->bindParam(':ID_PROC_GD_', $id_proc_gd_, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $ex) {
            $msg = "gd_cria_entidade_desconto#1 :" . $ex->getMessage();
        }

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            try {

                $msg = '';
                $seq = '';
                $empresa = $row['EMPRESA'];
                $rhid = $row['RHID'];
                $dt_adm = $row['DT_ADMISSAO'];
                $dt_ini = gd_get_var_value($row['ID_PROC_GD'], 'DT_INI_VINCULO', 'VALOR', $seq, $msg);
                $activo = 'S';
                $nr_inscricao = 'N/D';

                if ($empresa != '' && $rhid != '' && $dt_adm != '' && $cd_ed != '' && $cd_reg_desc != '' && $dt_ini != '') {
                    $estado = 'A';
                    if ($perfil == 'A') { # colaborador
                        $estado = 'A';
                    } elseif ($perfil == 'B') { # gestor administrativo
                        $estado = 'B';
                    } elseif ($perfil == 'C') { # supervisor
                        $estado = 'C';
                    } elseif ($perfil == 'D') { # director
                        $estado = 'D';
                    } elseif ($perfil == 'F' || # dep.recursos humanos
                              $perfil == 'E' || # Gestor - outsourcing
                              $perfil == 'Z') {  # Administrador
                        $estado = 'E';
                    }

                    # statment associado à aprovação do registo
                    $sql_aprov = "INSERT rh_id_ents_desconto " .
                                 "(EMPRESA, RHID, DT_ADMISSAO, CD_ED, CD_REG_DESC, ACTIVO, NR_INSCRICAO, LIM_MAX_DESCONTO, OBS, ITERATIVO) " .
                                 "VALUES('$empresa',$rhid,'$dt_adm',$cd_ed,'$cd_reg_desc','$activo','$nr_inscricao', NULL, NULL, 'N') ";

                    $sql_aprov .= " ON DUPLICATE KEY UPDATE ".
                                  "  ACTIVO = '$activo' ".
                                  " ,NR_INSCRICAO = '$nr_inscricao' ".
                                  " ,LIM_MAX_DESCONTO = NULL ".
                                  " ,OBS = NULL ".
                                  " ,ITERATIVO = 'N' ".
                                  " ,INTEGRADO_BO = 'N' ".
                                  " ,UTILIZADO_BO = 'S' ".
                                  " ,REMOVIDO = 'N' ";

                    # statment associado à rejeição do registo
                    $sql_rej = "DELETE FROM web_rh_ents_desconto " .
                               "WHERE empresa = '$empresa' AND rhid = $rhid AND  dt_admissao = '$dt_adm' " .
                               " AND cd_ed = '$cd_ed' AND cd_reg_desc = '$cd_reg_desc'";


                    # notificação
                    $vlr = dsp_ent_desconto($cd_ed, $msg);
                    $vlr .= ' / ' . dsp_regime_desconto($cd_reg_desc, $msg);
                    $mensagem = 'Criação da Entidade Desconto';
                    $ctrl_atributo = 'Criação' . ' ' . $vlr;

                    # criação do registo de entidade de desconto para aprovação
                    $query = "INSERT INTO web_rh_ents_desconto " .
                             "(empresa, rhid, dt_admissao, cd_ed, cd_reg_desc, estado, activo, nr_inscricao, lim_max_desconto, obs, iterativo, usr_reg, dt_reg) " .
                             "values('$empresa',$rhid,'$dt_adm',$cd_ed,'$cd_reg_desc','$estado','$activo','$nr_inscricao',NULL,NULL,'N','".@$_SESSION['utilizador']. "',SYSDATE() ) ";

                    $query .= " ON DUPLICATE KEY UPDATE ".
                              "  estado = '$estado' ".
                              " ,activo = '$activo' ".
                              " ,nr_inscricao = '$nr_inscricao' ".
                              " ,lim_max_desconto = NULL ".
                              " ,obs = NULL ".
                              " ,iterativo = 'N' ".
                              " ,usr_reg = '" . @$_SESSION['utilizador'] . "' ".
                              " ,dt_reg = SYSDATE() ";

                    $stmt2 = $db->prepare($query);
                    $stmt2->execute();

                    regista_alteracao_cadastro('Entidades Desconto', $ctrl_atributo, 'A', $rhid, $empresa, $dt_adm, '', $vlr, '', $vlr, $sql_aprov, $sql_rej, $mensagem, $msg);

                }
                else {
                    $msg = "Não se encontra definida informação para a criação da entidade de desconto.";
                }
            } catch (PDOException $ex) {
                $msg = "gd_cria_entidade_desconto#2:" . $ex->getMessage();
            }
        }

    }

    #
    # Valida a admissibilidade de um registo
    #
    # formato retorno de $msg: {"msg":"mensagem1"},{"msg":"mensagem2"},{"msg":"mensagem3"}
    #
    function gd_valida_aplicabilidade($id_proc_gd_, &$msg) {
        global $db;
        $msg = '';
        $seq = '';
        $msg1 = '';
        $aplicabilidade = true;

        try {

            $sql = "SELECT B.EMPRESA, B.RHID, B.DT_ADMISSAO, COUNT(*) CNT ".
                   "FROM DG_GD_FUNDAMENTACAO A, RH_ID_GESTAO_DOCUMENTAL B ".
                   "WHERE B.ID_PROC_GD = :ID_PROC_GD_ ".
                    " AND A.CD_GD = B.CD_GD ".
                    " AND A.DT_INI_GD = B.DT_INI_GD ".
                    " AND A.CD_DET_GD = B.CD_DET_GD ".
                    " AND A.DT_INI_DET_GD = B.DT_INI_DET_GD ".
                    " AND A.DT_FIM IS NULL ".
                    "GROUP BY B.EMPRESA, B.RHID, B.DT_ADMISSAO ";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':ID_PROC_GD_', $id_proc_gd_, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $cnt = $row['CNT'];
            $empresa = $row['EMPRESA'];
            $estab = gd_get_var_value($id_proc_gd_, 'ESTAB_COLOC', 'VALOR', $seq, $msg1);
            $mot_adm = gd_get_var_value($id_proc_gd_, 'MOTIVO_ADMISSAO', 'VALOR', $seq, $msg1);
            $dt_ini_vinc = gd_get_var_value($id_proc_gd_, 'DT_INI_VINCULO', 'VALOR', $seq, $msg1);
            $dt_fim_vinc = gd_get_var_value($id_proc_gd_, 'DT_FIM_VINCULO', 'VALOR', $seq, $msg1);
            $rhid = $row['RHID'];
            $dt_adm = $row['DT_ADMISSAO'];

            # existe fundamentação para proceder à validação
            if ($cnt > 0 ) {

                    $aplicabilidade = false;

                    ## obter a regra ou regras de fundamentação
                    $sql = "SELECT A.PERIODOS_APLICABILIDADE ".
                           "FROM DG_GD_FUNDAMENTACAO A, RH_ID_GESTAO_DOCUMENTAL B ".
                           "WHERE B.ID_PROC_GD = :ID_PROC_GD_ ".
                            " AND A.CD_GD = B.CD_GD ".
                            " AND A.DT_INI_GD = B.DT_INI_GD ".
                            " AND A.CD_DET_GD = B.CD_DET_GD ".
                            " AND A.DT_INI_DET_GD = B.DT_INI_DET_GD ".
                            " AND A.DT_FIM IS NULL ";

                    # empresa
                    if ($empresa != '') {
                        $sql .=  " AND (A.EMPRESA IS NULL OR A.EMPRESA = :EMPRESA_) ";
                    } else {
                        $sql .=  " AND A.EMPRESA IS NULL ";
                    }

                    # estabelecimento
                    if ($empresa != '') {
                        if ($estab != '') {
                            $sql .=  " AND (A.CD_ESTAB IS NULL OR A.CD_ESTAB = :CD_ESTAB_) ";
                        } else {
                            $sql .=  " AND A.CD_ESTAB IS NULL ";
                        }
                    }

                    # motivo de admissao
                    if ($mot_adm != '') {
                        $sql .=  " AND (A.MOTIVO_ADMISSAO IS NULL OR A.MOTIVO_ADMISSAO = :MOTIVO_ADMISSAO_) ";
                    } else {
                        $sql .=  " AND A.MOTIVO_ADMISSAO IS NULL ";
                    }

                    # para garantir que vêm primeiro os valores depois os nulos
                    $sql .= " ORDER BY A.EMPRESA DESC, A.CD_ESTAB DESC, A.MOTIVO_ADMISSAO DESC, A.PERIODOS_APLICABILIDADE DESC ";

                    try {

                        $stmt = $db->prepare($sql);

                        $stmt->bindParam(':ID_PROC_GD_', $id_proc_gd_, PDO::PARAM_STR);

                        if ($empresa != '') {
                            $stmt->bindParam(':EMPRESA_', $empresa, PDO::PARAM_STR);
                        }

                        if ($empresa != '' && $estab != '') {
                            $stmt->bindParam(':CD_ESTAB_', $estab, PDO::PARAM_STR);
                        }

                        if ($mot_adm != '') {
                            $stmt->bindParam(':MOTIVO_ADMISSAO_', $mot_adm, PDO::PARAM_STR);
                        }
                        $stmt->execute();

                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            # periodo de aplicabilidade

                            # quer dizer que não existe período de adaptabilidade específico, saíndo pela regra geral
                            if ($row['PERIODOS_APLICABILIDADE'] == '') {
                                $aplicabilidade = true;
                                break;
                            } else {

                                $mm_dd_ini_vinc = substr($dt_ini_vinc,5,5);
                                $mm_dd_fim_vinc = substr($dt_fim_vinc,5,5);

                                # avalia períodos de aplicabilidade
                                $aux = $row['PERIODOS_APLICABILIDADE'];
                                $aux = str_replace(",","",$aux);
                                $aux = str_replace("[","",$aux);
                                $aux = str_replace("]","@",$aux);
                                $p = explode("@",$aux);
                                for ($idx=0; $idx<count($p); $idx++) {

                                    # formato MM-DD
                                    $dini = trim(substr($p[$idx],0,5));
                                    $dfim = trim(substr($p[$idx],6,5));
#echo "<br/>".$p[$idx]." dtini[$dini] dtfim:[$dfim] vs ini:[$mm_dd_ini_vinc] fim:[$mm_dd_fim_vinc]";

                                    if ($dini != '' && $dfim != '') {
                                        if ($dini == $mm_dd_ini_vinc && $dfim == $mm_dd_fim_vinc) {
                                            $aplicabilidade = true;
                                            break;
                                        }
                                    } elseif ($dini != '' && $dfim == '') {
                                        if ($dini == $mm_dd_ini_vinc) {
                                            $aplicabilidade = true;
                                            break;
                                        }
                                    }

                                };

                                if ($aplicabilidade) {
                                    break;
                                }


                            }

                        }

                    } catch (PDOException $ex) {
                        $msg = "gd_valida_aplicabilidade#1 :" . $ex->getMessage();
                    }
                }

        } catch (PDOException $ex) {
            $msg = "gd_valida_aplicabilidade#2 :" . $ex->getMessage();
        }

        if ($msg != '') {
            $msg = '{"msg":"'.$msg.'"}';
        } else {
            if (!$aplicabilidade) {
                $dsp_estab = gd_get_var_value($id_proc_gd_, 'ESTAB_COLOC', 'DSP', $seq, $msg1);
                $dsp_mot_adm = gd_get_var_value($id_proc_gd_, 'MOTIVO_ADMISSAO', 'DSP', $seq, $msg1);
                $msg = "O motivo de admissão escolhido [$mot_adm-$dsp_mot_adm] não é aplicável nos periodos de aplicabilidade definidos à empresa[$empresa] e estabelecimento [$estab-$dsp_estab] escolhidos.";
                $msg = '{"msg":"'.$msg.'"}';
            }
        }

    }

    #
    # função que compoe statmente para condicionar as pesquisa ao perfil ativo
    #
    function filtro_hierarquia ($perfil, $rhid, $alias, &$msg) {

        $sql = '';

        # filtra de acordo com a hierarquia definida no portal
        if ($perfil == 'B' && $rhid != '') { # gestor administrativo
            $sql .= " AND $alias.rhid IN (SELECT E.rhid FROM RH_ID_EMPRESAS E WHERE E.RHID_GESTOR_ADM = '$rhid' AND (E.EMPRESA, E.RHID, E.DT_ADMISSAO) IN (SELECT x.EMPRESA, x.RHID, MAX(x.DT_ADMISSAO) FROM RH_ID_EMPRESAS x GROUP BY x.EMPRESA, x.RHID) ) ";
        } elseif ($perfil == 'C' && $rhid != '') { # supervisor
            $sql .= " AND $alias.rhid IN (SELECT E.rhid FROM RH_ID_EMPRESAS E WHERE E.RHID_SUPERVISOR = '$rhid' AND (E.EMPRESA, E.RHID, E.DT_ADMISSAO) IN (SELECT x.EMPRESA, x.RHID, MAX(x.DT_ADMISSAO) FROM RH_ID_EMPRESAS x  GROUP BY x.EMPRESA, x.RHID) ) ";
        } elseif ($perfil == 'D' && $rhid != '') { # director
            $sql .= " AND $alias.rhid IN (SELECT E.rhid FROM RH_ID_EMPRESAS E WHERE E.RHID_DIRECTOR = '$rhid' AND (E.EMPRESA, E.RHID, E.DT_ADMISSAO) IN (SELECT x.EMPRESA, x.RHID, MAX(x.DT_ADMISSAO) FROM RH_ID_EMPRESAS x GROUP BY x.EMPRESA, x.RHID) ) ";
        } elseif (($perfil == 'E' || $perfil == 'F' || $perfil == 'Z')) { # gestor/dep.rh/administrador
            $sql .= "";
        }

        return $sql;
    }


    #
    # Estatísticas associadas ao módulo
    function gd_estatisticas($perfil, $rhid, &$totais, &$fases, &$totais_mes, &$estabs, &$msg) {
        #
        # ESTATÍSTICAS COMPILADAS
        #
        # TOTAIS:
        # nr_processos  : número de processos concluídos na plataforma
        # nr_admissoes  : número de processos relativos a modelos de admissão contratual
        # nr_removações : número de processos relativos a modelos de renovação contratual
        # nr_outros : número de processos relativos a outros modelos (!= admissões e renovações)
        #
        # wkf_concluidos : número de processos concluído no mês
        # wkf_elaboracao : número de processos em estado de Elaboração
        # wkf_validacao  : número de processos em estado de Validação pelos diversos perfis de workflow
        # wkf_assinatura : número de processos em estado de Aguardar Assinatura pelos diversos perfis de workflow
        # wkf_aprovacoes : número de processos em estado de Aprovação pelos diversos perfis de workflow
        #
        # FASES:
        #   CODIGO, DESIGNACAO, NR_OCORRENCIA, PCT DO TOTAL, MEDIA DIAS
        #
        # TOTAIS MES:
        #   total_processos : o total de processos de cada um dos últimos 12 meses
        #   total_admissoes : o total de processos de admissão contratual de cada um dos últimos 12 meses
        #   total_renovacoes : o total de processos de renovação contratual de cada um dos últimos 12 meses
        #   total_outros : o total de processos de outros processos de cada um dos últimos 12 meses
        #
        # ESTABS
        #

        global $db;
        $msg = '';

        ## condicionamento aos colaboradores subordinados de acordo com o perfil
        $sql_perfil = '';
        if ($rhid != '' && $perfil != '') {
            $sql_perfil = filtro_hierarquia ($perfil, $rhid, 'B', $msg);
        }

        $totais = array();
        $fases = array();
        $totais_mes = array();
        $estabs = array();

        $nr_processos = 0;
        $nr_admissoes = 0;
        $nr_renovacoes = 0;
        $nr_outros = 0;

        $wkf_concluidos = 0;
        $wkf_elaboracao = 0;
        $wkf_validacao = 0;
        $wkf_assinatura = 0;
        $wkf_aprovacoes = 0;

        ## totais por modelos
        try {

            $sql =  "SELECT A.CD_GD,A.DT_INI_GD,A.CD_DET_GD,A.DT_INI_DET_GD,A.DSP,B.FASE,C.RV_MEANING DSP_FASE, D.GRAFICOS, COUNT(*) CNT ".
                    "FROM DG_DET_GESTAO_DOCUMENTAL A, RH_ID_GESTAO_DOCUMENTAL B, CG_REF_CODES C,  DG_GESTAO_DOCUMENTAL D ".
                    "WHERE A.CD_GD = B.CD_GD ".
                    "  AND A.DT_INI_GD = B.DT_INI_GD ".
                    "  AND A.CD_DET_GD = B.CD_DET_GD ".
                    "  AND A.DT_INI_DET_GD = B.DT_INI_DET_GD ".
                    "  AND C.RV_DOMAIN = 'DG_TIPO_FASES_GD' ".
                    "  AND C.RV_LOW_VALUE = B.FASE ".
                    "  AND D.CD_GD = A.CD_GD ".
                    "  AND D.DT_INI_GD = A.DT_INI_GD ";

            # condicionamento ao perfil
            $sql .= $sql_perfil;

            $sql .= "GROUP BY A.CD_GD,A.DT_INI_GD,A.CD_DET_GD,A.DT_INI_DET_GD,A.DSP,B.FASE,C.RV_MEANING, D.GRAFICOS ".
                    "ORDER BY B.FASE ";

            $stmt = $db->prepare($sql);

    #       $stmt->bindParam(':CD_GD_', $cd_gd_, PDO::PARAM_STR);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                ## tipo de processos
                $nr_processos += $row['CNT'];
                if ($row['GRAFICOS'] == 'A') {
                    $nr_admissoes += $row['CNT'];
                } elseif ($row['GRAFICOS'] == 'B') {
                    $nr_renovacoes += $row['CNT'];
                } else {
                    $nr_outros += $row['CNT'];
                }

                ## estado de processos
                # A Elaboração
                # B Valid. Gestor Adm.
                # C Valid. Supervisor
                # D Valid. Diretor
                # E Valid. Gestor
                # F Assinat. Colaborador
                # G Assinat. Gestor Adm.
                # H Assinat. Supervisor
                # I Assinat. Diretor
                # J Assinat. DRH
                # K Aprov. Gestor Adm.
                # L Aprov. Supervisor
                # M Aprov. Diretor
                # N Aprov. Gestor
                # O Aprovado
                # P Rejeitado
                # Z Cancelado
                # elaboração
                if ($row['FASE'] == 'A') {
                    $wkf_elaboracao += $row['CNT'];
                # validação
                } elseif ($row['FASE'] == 'B' || $row['FASE'] == 'C' || $row['FASE'] == 'D' || $row['FASE'] == 'E') {
                    $wkf_validacao += $row['CNT'];
                # assinatura
                } elseif ($row['FASE'] == 'F' || $row['FASE'] == 'G' || $row['FASE'] == 'H' || $row['FASE'] == 'I' || $row['FASE'] == 'J') {
                    $wkf_assinatura += $row['CNT'];
                # aprovação
                } elseif ($row['FASE'] == 'K' || $row['FASE'] == 'L' || $row['FASE'] == 'M' || $row['FASE'] == 'N') {
                    $wkf_aprovacoes += $row['CNT'];
                } else {
                    $wkf_concluidos += $row['CNT'];
                }


            }

            $totais = array($nr_processos, $nr_admissoes, $nr_renovacoes, $nr_outros,
                            $wkf_concluidos, $wkf_elaboracao,$wkf_validacao, $wkf_assinatura, $wkf_aprovacoes);

        } catch (PDOException $ex) {
            $msg = "gd_estatisticas#1: ".$ex->getMessage();
        }

        ## totais das fases
        $tot_fases = 0;
        $med_fases = 0;
        if ($msg == '') {
            try {

                $sql = "SELECT COUNT(*) CNT, AVG(GD_DURACAO_PROCESSO(B.ID_PROC_GD)) MED ".
                       "FROM RH_ID_GESTAO_DOCUMENTAL B ".
                       "WHERE 1 = 1 ";

                # condicionamento ao perfil
                $sql .= $sql_perfil;

                $stmt = $db->prepare($sql);

                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $tot_fases = $row['CNT'];
                    $med_fases = round($row['MED']);
                }
            } catch (PDOException $ex) {
                $msg = "gd_estatisticas#2: ".$ex->getMessage();
            }
        }

        ## totais por fases
        if ($msg == '') {
            try {

                $sql =  "SELECT B.FASE,C.RV_MEANING DSP_FASE,COUNT(*) CNT, AVG(GD_DURACAO_PROCESSO(B.ID_PROC_GD)) MED ".
                        "FROM RH_ID_GESTAO_DOCUMENTAL B, CG_REF_CODES C ".
                        "WHERE C.RV_DOMAIN = 'DG_TIPO_FASES_GD' ".
                        "  AND C.RV_LOW_VALUE = B.FASE ";

                # condicionamento ao perfil
                $sql .= $sql_perfil;

                $sql .= "GROUP BY B.FASE,C.RV_MEANING ".
                        "ORDER BY B.FASE ";

                $stmt = $db->prepare($sql);

        #       $stmt->bindParam(':CD_GD_', $cd_gd_, PDO::PARAM_STR);
                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                    # calcular as percentagens de cada uma das fases
                    $pct = 0;
                    if ($row['CNT'] != 0 && $tot_fases != 0) {
                        $pct = round($row['CNT']/$tot_fases*100);
                    }

                    # média histórica das fases
                    $med_hist = 0;
                    $stmt1 = $db->prepare("SELECT AVG(GD_DURACAO_FASE(A.ID_PROC_GD,A.REF_DOC)) MED_HIST ".
                                         "FROM RH_ID_GD_DOCS A ".
                                         "WHERE A.REF_DOC = :FASE_ ");

                    $stmt1->bindParam(':FASE_', $row['FASE'], PDO::PARAM_STR);
                    $stmt1->execute();
                    $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
                    if ($row1['MED_HIST'] != 0) {
                        $med_hist = $row1['MED_HIST'];
                    }

                    $fases[] = array($row['FASE'], $row['DSP_FASE'], $row['CNT'], $pct, round($row['MED']),round($med_hist));
                }

            } catch (PDOException $ex) {
                $msg = "gd_estatisticas#3: ".$ex->getMessage();
            }

            $fases[] = array('TOTAL', 'TOTAIS', $tot_fases, 100, $med_fases);
        }

        ## totais por meses (últimos 12 meses)
        if ($msg == '') {
            try {
                $ano_ini = date("Y");
                $mes_ini = intval(date("m"));
                for ($i==0; $i<12; $i++) {

                   $sql =   "SELECT A.CD_GD,A.DT_INI_GD,A.CD_DET_GD,A.DT_INI_DET_GD,C.GRAFICOS,COUNT(*) CNT ".
                            "FROM DG_DET_GESTAO_DOCUMENTAL A, RH_ID_GESTAO_DOCUMENTAL B, DG_GESTAO_DOCUMENTAL C ".
                            "WHERE A.CD_GD = B.CD_GD ".
                            "  AND A.DT_INI_GD = B.DT_INI_GD ".
                            "  AND A.CD_DET_GD = B.CD_DET_GD ".
                            "  AND A.DT_INI_DET_GD = B.DT_INI_DET_GD ".
                            "  AND TO_CHAR(B.DT_INSERTED,'YYYY-MM') = :MES_ ".
                            "  AND C.CD_GD = A.CD_GD ".
                            "  AND C.DT_INI_GD = A.DT_INI_GD ";

                    # condicionamento ao perfil
                    $sql .= $sql_perfil;

                    $sql .= "GROUP BY A.CD_GD,A.DT_INI_GD,A.CD_DET_GD,A.DT_INI_DET_GD,A.DSP,C.GRAFICOS ".
                            "ORDER BY B.FASE ";

                    $stmt = $db->prepare($sql);

                    $am_ = $ano_ini."-".str_pad($mes_ini,2,"0",STR_PAD_LEFT);
                    $stmt->bindParam(':MES_', $am_, PDO::PARAM_STR);
                    $stmt->execute();

                    $cnt_total = 0;
                    $cnt_adm = 0;
                    $cnt_renov = 0;
                    $cnt_outros = 0;

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $cnt_total += $row['CNT'];
                        if ($row['GRAFICOS'] == 'A') {
                            $cnt_adm += $row['CNT'];
                        } elseif ($row['GRAFICOS'] == 'B') {
                            $cnt_renov += $row['CNT'];
                        } else {
                            $cnt_outros += $row['CNT'];
                        }
                    }

                    #$cnt_adm = rand(0,40);
                    #$cnt_renov = rand(0,40);
                    #$cnt_outros = rand(0,40);
                    #$cnt_total = $cnt_adm + $cnt_renov + $cnt_outros;
                    $totais_mes[] = array($ano_ini, $mes_ini, $cnt_total, $cnt_adm, $cnt_renov, $cnt_outros);

                    $mes_ini -= 1;
                    if ($mes_ini == 0) {
                        $ano_ini -= 1;
                        $mes_ini = 12;
                    }
                }

            } catch (PDOException $ex) {
                $msg = "gd_estatisticas#4: ".$ex->getMessage();
            }
        }

        ## estabelecimentos
        if ($msg == '') {
            $estabs = "";

            # só visível para os perfis de administração
            if ($perfil == 'E' || $perfil == 'F' || $perfil == 'Z') {
                try {
                    $stmt = $db->prepare("SELECT A.EMPRESA, A.CD_ESTAB, B.DSR_ESTAB, COUNT(DISTINCT A.RHID) CNT_COLABS ".
                                         "FROM RH_ID_EMPRESAS A, DG_ESTABELECIMENTOS B ".
                                         "WHERE B.EMPRESA = A.EMPRESA ".
                                         "  AND B.CD_ESTAB = A.CD_ESTAB ".
                                         "  AND B.ACTIVO = 'S' ".
                                         "  AND A.CD_SITUACAO IN (SELECT CD_SITUACAO FROM RH_DEF_SITUACOES WHERE RECIBO = 'S') ".
                                         "GROUP BY A.CD_ESTAB, B.DSP_ESTAB ".
                                         "ORDER BY 2 ");

            #       $stmt->bindParam(':CD_GD_', $cd_gd_, PDO::PARAM_STR);
                    $stmt->execute();

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                        $stmt1 = $db->prepare("SELECT B.CD_DET_GD,C.GRAFICOS, COUNT(*) CNT ".
                                              "FROM RH_ID_EMPRESAS A, RH_ID_GESTAO_DOCUMENTAL B, DG_GESTAO_DOCUMENTAL C  ".
                                              "WHERE A.EMPRESA = :EMPRESA_ ".
                                              "   AND A.CD_ESTAB = :CD_ESTAB_ ".
                                              "  AND A.CD_SITUACAO IN (SELECT CD_SITUACAO FROM RH_DEF_SITUACOES WHERE RECIBO = 'S') ".
                                              "  AND B.EMPRESA = A.EMPRESA ".
                                              "  AND B.RHID = A.RHID ".
                                              "  AND B.DT_ADMISSAO = A.DT_ADMISSAO ".
                                              "  AND C.CD_GD = B.CD_GD ".
                                              "  AND C.DT_INI_GD = B.DT_INI_GD ".
                                              "GROUP BY B.CD_DET_GD,C.GRAFICOS ");

                        $stmt1->bindParam(':EMPRESA_', $row['EMPRESA'], PDO::PARAM_STR);
                        $stmt1->bindParam(':CD_ESTAB_', $row['CD_ESTAB'], PDO::PARAM_STR);
                        $stmt1->execute();

                        $cnt_total = 0;
                        $cnt_adm = 0;
                        $cnt_renov = 0;
                        $cnt_outros = 0;
                        while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            $cnt_total += $row1['CNT'];
                            if ($row1['GRAFICOS'] == 'A') {
                                $cnt_adm += $row1['CNT'];
                            } elseif ($row1['GRAFICOS'] == 'B') {
                                $cnt_renov += $row1['CNT'];
                            } else {
                                $cnt_outros += $row1['CNT'];
                            }
                        }

                        $estabs[] = array($row['CD_ESTAB'], $row['DSR_ESTAB'],$row['CNT_COLABS'],$cnt_total,$cnt_adm,$cnt_renov,$cnt_outros);

                    }

                } catch (PDOException $ex) {
                    $msg = "gd_estatisticas#5: ".$ex->getMessage();
                }
            }
        }
    }
?>