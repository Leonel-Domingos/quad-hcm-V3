<?php
    /*
     *  @autor      Pedro Mengo de Abreu <pedro.mengo.abreu@quad-systems.com>
     *  @versão     1.0
     *  @revisão    2018.10.08
     *  @copyright  (c) 2018 QuadSystems - http://www.quad-systems.com
     *  @nome	dk_lib.php
     *  @descrição  Libraria de funções:
     *                   - Funções para suporte ao Módulo de Prémios por Coeficiente
     */

$msg_month_closed_in_HR = "Mês encerrado no QUAD-HR";
    require (ROOT_PATH."/quad_connections.php");

    ## ativa/inibi modo de debug do cálculo
    $dk_debug = false;
    $dk_debug_rhid = '';
    $null = null;

    /* Lista de Indicadores ATIVOS */
    function dk_active_indicators(&$cnt, &$result, $colabs, $empresa, $ano, $mes) {

        global $link;
        $db = $link;
        $cd_lang = decode_lang(); //0 - PT

        $msg = '';
        $result = array();
        $cnt = 0;
        $filtro_colabs = '';
        
        if (count($colabs) > 0 && $colabs != '') {
            $rhids_ = '';
            foreach ($colabs as $row) {
                if ($rhids_ == '') {
                    $rhids_ = $row['RHID'];
                } else {
                    $rhids_ .= ",".$row['RHID'];
                }
            }
            $filtro_colabs = " AND A.CD_INDICADOR IN ".
                             "(SELECT DISTINCT X.CD_INDICADOR ".
                             " FROM DK_ID_DET_COEF_PRM_VW X ".
                             " WHERE X.EMPRESA = '$empresa' AND X.ANO = $ano AND X.MES = $mes AND X.RHID IN ($rhids_) ) ";
        }

        $sql = "SELECT DISTINCT A.CD_INDICADOR, A.DT_INICIO, NVL(B.DSP_TRAD, A.DSP_INDICADOR) DSP_INDICADOR, NVL(B.DSR_TRAD, A.DSR_INDICADOR) DSR_INDICADOR " .
                "FROM DK_DEF_INDICADORES_PREMIO A LEFT JOIN DK_DEF_INDICADOR_PREMIO_TRADS B " .
                "ON B.CD_INDICADOR = A.CD_INDICADOR " .
                "AND B.DT_INI_INDICADOR = A.DT_INICIO " .
                "AND B.DT_FIM IS NULL " .
                "AND B.CD_LINGUA = :cd_lang " .
                "WHERE A.DT_FIM IS NULL " .
                $filtro_colabs. " " .
                "ORDER BY A.CD_INDICADOR ";

        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':cd_lang', $cd_lang);
            $stmt->execute();
            $cnt = $stmt->rowCount();
        } catch (Exception $ex) {
            $msg = "dk_active_indicators#1 :" . $ex->getMessage();
        }

        if ($msg == '') {
            try {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    //print_r ($row);
                    array_push($result, $row);
                }
            } catch (Exception $ex) {
                $msg = "dk_active_indicators#2 :" . $ex->getMessage();
            }
        }
    }

    /* Lista de Colaboradores */
    function info_colabs_coefs($empresa, $estab, $cd_setor, $dt_setor, $rhid, $ano_mes_fim, $dt_fim_mes, &$cnt, &$result) {

        global $link;
        $db = $link;
        $msg = '';
        $result = array();
        $cnt = 0;
        $ano_mes_aberto = 'S';

        $ano_ = substr($ano_mes_fim,0,4);
        $mes_ = substr($ano_mes_fim,5,2);
        if ($ano_mes_aberto == 'S') { //MÊS FECHADO
            $sql = "SELECT A.RHID, A.NOME, A.NOME_REDZ, A.DT_ADMISSAO, A.DT_DEMISSAO," .
                    " A.DSP_VINCULO, A.DSP_FUNCAO, A.DSP_CATG_PROF_INTERNA, A.DSP_ESTAB, A.DSP_SETOR, " .
                    " DK_NR_COEF(A.EMPRESA, $ano_, $mes_, A.RHID, A.DT_ADMISSAO) NR_COEF, ".
                    " DK_ID_DESPORTOS(A.EMPRESA, $ano_, $mes_, A.RHID) DESPORTOS ".
                    "FROM QUAD_PEOPLE A " .
                    "WHERE 1 = 1" .
                    " AND A.ATIVO = 'S' " .
                    " AND TO_CHAR(A.DT_ADMISSAO,'YYYY-MM-DD') <= '$dt_fim_mes' " .
                    " AND (A.DT_DEMISSAO IS NULL OR TO_CHAR(A.DT_DEMISSAO,'YYYY-MM') >= '$ano_mes_fim') ";

            if ($cd_setor != '' && $dt_setor != '') {
                $sql .= " AND A.ID_SETOR = '$cd_setor' "; # AND A.DT_INI_SETOR = '$dt_setor' ";
            }

            if ($rhid != '') {  # próprio colaborador ou a pedido para um empregado específico (visões de chefia)
                if ($rhid != '') {
                    $sql .= " AND A.RHID = " . $rhid . " ";
                } else {
                    $sql .= " AND A.RHID = " . @$_SESSION['rhid'] . " ";
                }
            } elseif (@$_SESSION['perfil'] == 'B') { # gestor administrativo
                $sql .= " AND (A.RHID_GESTOR_ADM = " . @$_SESSION['rhid'] . " OR A.RHID = " . @$_SESSION['rhid'] . ") ";
            } elseif (@$_SESSION['perfil'] == 'C') { # supervisor
                $sql .= " AND (A.RHID_SUPERVISOR = " . @$_SESSION['rhid'] . " OR A.RHID = " . @$_SESSION['rhid'] . ") ";
            } elseif (@$_SESSION['perfil'] == 'D') { # director
                $sql .= " AND (A.RHID_DIRECTOR = " . @$_SESSION['rhid'] . " OR A.RHID = " . @$_SESSION['rhid'] . ") ";
            } elseif (@$_SESSION['perfil'] == 'F' || # dep.recursos humanos
                    @$_SESSION['perfil'] == 'E' || # Gestor - outsourcing
                    @$_SESSION['perfil'] == 'W' || # Consulta
                    @$_SESSION['perfil'] == 'Y' || # Preparador Escalas
                    @$_SESSION['perfil'] == 'Z') {  # Administrador
                null;
            }

            if ($empresa != '') {
                $sql .= " AND A.EMPRESA = '$empresa' ";
            }

            if ($estab != '') {
                $sql .= " AND A.CD_ESTAB = '$estab' ";
            }
            ## TODO: filtragem por estabelecimento
            #$sql = filtro_estab($query1,'E');
            $sql .= " ORDER BY 1 ";

            try {
                $stmt = $db->prepare($sql);
#                if ($empresa != '') {
#                    $stmt->bindParam(':EMPRESA_', $empresa, PDO::PARAM_STR);
#                }
#                if ($estab != '') {
#                    $stmt->bindParam(':ESTAB_', $estab, PDO::PARAM_STR);
#                }
#                $stmt->bindParam(':ANO_', $ano_, PDO::PARAM_STR);
#                $stmt->bindParam(':MES_', $mes_, PDO::PARAM_STR);
                $stmt->execute();
                $cnt = $stmt->rowCount();
            } catch (Exception $ex) {
                $msg = "info_colabs_gtempo#1 :" . $ex->getMessage();
            }

            if ($msg == '') {
                try {
                    #$sql .= " LIMIT $offset,$reg_pag ";
                    $stmt = $db->prepare($sql);
                    #$stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                    $stmt->execute();                    
                    //$result = $stmt;
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC); //Return Array so it can be reused on destiny
                } catch (Exception $ex) {
                    $msg = "info_colabs_gtempo#1 :" . $ex->getMessage();
                }
            }
        } else { //MÊS FECHADO
            null;
        }
    }

    /* Fotos de Colaboradores */
    function show_foto($rhid, $original, $html_classes, &$msg) {

        global $directory, $base_url, $link;
        $db = $link;
        $msg = '';
        $cnt = 0;
        $foto = '';
        $result = '';
        
        # Obtem directoria das fotos dos colaboradores
        $dir_fotos = ASSETS_URL."/img/";
        $physical_dir_fotos = ROOT_PATH."/public/assets/img/";
       
        if ($msg != '') {
            echo $msg;
        } else {
/*        
            $query = "SELECT foto FROM web_rh_identificacoes WHERE rhid = :RHID_ AND foto != '' ";
            try {
                $stmt = $db->prepare($query);
                $stmt->bindParam(':RHID_', $rhid);
                $stmt->execute();
                $cnt = $stmt->rowCount();
            } catch (Exception $ex) {
                $msg = "show_foto#1 :" . $ex->getMessage();
            }
            if ($msg == '') {
                try {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $foto = $row['foto'];
                    }
                } catch (Exception $ex) {
                    $msg = "show_foto#2 :" . $ex->getMessage();
                }
            }
*/            
$foto = '';

            if ($msg == '') {
                if ($foto == '') {
                    $foto = 'noimage.jpg';
                }
                
                # url da foto a mostrar
                $t_foto = $dir_fotos . $foto;                

                # obtem carateristicas da foto
                if ($original == 'S') {
                    list($width, $height, $type, $attr) = getimagesize($physical_dir_fotos.'/'.$foto);
                    $result = "<img src='" . $t_foto . "?=" . rand(100000,999999) . "' width='$width' height='" . $height . "' class='" .$html_classes. "'/>";
                } else {
                    $result = "<img src='" . $t_foto . "?=" . rand(100000,999999) . "' class='" .$html_classes. "'/>";
                }
                /* if ($foto != '') {

                    if ($t_w) {
                        $t_foto = $dir_th . 't_w' . $t_w . '_' . $foto;
                    } else {
                        $t_foto = $dir_th . 't_h' . $t_h . '_' . $foto;
                    }

                    if (!file_exists($t_foto)) {

                        //the new width of the resized image, in pixels.
                        $extlimit = "yes"; //Limit allowed extensions? (no for all extensions allowed)
                        //List of allowed extensions if extlimit = yes
                        $limitedext = array(".gif", ".jpg", ".png", ".jpeg", ".bmp");

                        list($width, $height, $type, $attr) = getimagesize($dir_fotos . $foto);
                        $file_type = $type;
                        $file_name = $foto;

                        //check the file's extension
                        $ext = strrchr($file_name, '.');
                        $ext = strtolower($ext);

                        $getExt = explode('.', $file_name);
                        $file_ext = $getExt[count($getExt) - 1];

                        /////////////////////////////////
                        // CREATE THE THUMBNAIL //
                        ////////////////////////////////
                        //keep image type
                        if ($width) {

                            ini_set('memory_limit', '-1');

                            #1 = GIF, 2 = JPG, 3 = PNG, 4 = SWF, 5 = PSD, 6 = BMP, 7 = TIFF(orden de bytes intel), 8 = TIFF(orden de bytes motorola), 9 = JPC, 10 = JP2, 11 = JPX, 12 = JB2, 13 = SWC, 14 = IFF, 15 = WBMP, 16 = XBM.
                            if ($file_type == "2" || $file_type == "10")
                                $new_img = imagecreatefromjpeg($dir_fotos . $foto);
                            elseif ($file_type == "3" || $file_type == "3")
                                $new_img = imagecreatefrompng($dir_fotos . $foto);
                            elseif ($file_type == "1")
                                $new_img = imagecreatefromgif($dir_fotos . $foto);

                            //calculate the image ratio
                            $imgratio = $width / $height;
                            if ($t_w) {
                                $newwidth = $t_w;
                                $newheight = $t_w / $imgratio;

                                if ($newheight > 60) {
                                    $newheight = 60;
                                    $newwidth = 60 * $imgratio;
                                }
                            } else {
                                $newheight = $t_h;
                                $newwidth = $t_h * $imgratio;
                            }

                            //function for resize image.
                            if (function_exists(imagecreatetruecolor)) {
                                $resized_img = imagecreatetruecolor($newwidth, $newheight);

                                //the resizing is going on here!
                                imagecopyresized($resized_img, $new_img, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

                                //finally, save the image
                                ImageJpeg($resized_img, $t_foto);
                                ImageDestroy($resized_img);
                                ImageDestroy($new_img);

                                if ($t_w != '' && $t_h != '') {
                                    $result = "<img src='" . $t_foto . "' width='$t_w' height='" . $t_h . "' class='" .$html_classes. "'/>";
                                } else {
                                    $result = "<img src='" . $t_foto . "' width='$newwidth' height='" . $newheight . "' class='" .$html_classes. "'/>";
                                }
                            } else {
                                $result = "PHP package [gd] is not installed.";
                            }
                        }
                    } else {

                        list($width, $height, $type, $attr) = getimagesize($t_foto);

                        if ($t_w != '' && $t_h != '') {
                            $result = "<img src='" . $t_foto . "?=" . filemtime($t_foto) . "' width='" . $t_w . "' height='" . $t_h . "' class='" .$html_classes. "'/>";
                        } else {
                            $result = "<img src='" . $t_foto . "?=" . filemtime($t_foto) . "' width='$width' height='" . $height . "' class='" .$html_classes. "'/>";
                        }
                    }
                } # END foto != ''  */                      
            }
        } //Photos directory
        
        return $result;
    }
    
//    function base64EncodeImage ($image_file) {
//        $base64_image = '';
//        $image_info = mime_content_type($image_file);
//        $image_data = fread(fopen($image_file, 'r'), filesize($image_file));
//        $base64_image = 'data:' . $image_info . ';base64,' . chunk_split(base64_encode($image_data));
//        return $base64_image;
//    }
    
    function get_user_foto($rhid, $html_classes, &$msg) {

        global $db;
        $msg = '';
        $thumbnail = '';
        $mime = '';
        $src = '';
        
        $image = 'https://quad-systems.pt/QUAD_HCM_v3/public/assets/img/demo/avatars/avatar-admin.png';

        $data = '';
        try {
            $stmt = $db->prepare("SELECT TO_BASE64(BD_DOC) IMG, BD_MIME, LINK_DOC, LENGTH(BD_DOC), NOME  ".
                                 "FROM RH_IDENTIFICACOES ".
                                 "WHERE RHID = :RHID_ ");

            $stmt->bindParam(':RHID_', $rhid, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $data = $row;
        } catch (Exception $ex) {
            $msg = "get_user_foto#1: " . $ex->getMessage();
        }
        if ($msg == '') {
            if ($data['IMG']) {
                $image = APP_TMP_PATH.'/'.$data['LINK_DOC'];
                file_put_contents($image, base64_decode($data['IMG']));
                $imageData = base64_encode(file_get_contents($image));
            }
            elseif ($data['BD_MIME'] && $data['LINK_DOC']) {
                $image = ASSETS_PATH.'/img/fotos/'.$data['LINK_DOC'];
                $imageData = base64_encode(file_get_contents($image));
            }
            else {
                #$image = ASSETS_PATH.'/img/fotos/user.png';
                $image = THUMB_USER_IMG;
                
                if (strtolower(pathinfo($image, PATHINFO_EXTENSION)) == 'svg') {
                    # se for renderizar a imagem do tipo svg, deverá ser por referência e não inline...
                    #$image = APP_URL.'/assets/img/fotos/user-alt.svg';
                    $src = $image;
                } else {
                    $imageData = base64_encode(file_get_contents($image));
                }
            }

            if ($src == '') {
                #$mime = mime_content_type($image);
                $mime = image_type_to_mime_type(exif_imagetype($image));
                // Format the image SRC:  data:{mime};base64,{data};
                $src = 'data:'.$mime.';base64,'.$imageData;
            }
            
            // Echo out a sample image
            $thumbnail = '<img src="'.$src.'" class="profile-image rounded-circle '.$html_classes.'" alt="'.$data['NOME'].'" data-idx="'.sha1(time()).'">';
            
        }
        
        if ($thumbnail) {
            $thumbnail = str_replace("\"","'",$thumbnail);
        }

        return $thumbnail;
    }
    
    /* Retorna a diretoria de acordo com o conteúdo requerido ($nome) */
    function get_dir_path($nome, &$msg) {

        global $link;
        $db = $link;
        $msg = '';
        $dir = '';

        $sql = "SELECT c.* FROM web_adm_config_directorias c WHERE nome = :NOME ";

        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':NOME', $nome, PDO::PARAM_STR);
            $stmt->execute();
            $cnt = $stmt->rowCount();
        } catch (Exception $ex) {
            $msg = "get_dir_path#1 :" . $ex->getMessage();
        }

        if ($msg == '') {
            try {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $dir = $row['path'];
                }
            } catch (Exception $ex) {
                $msg = "get_dir_path#2 :" . $ex->getMessage();
            }
        }
        return $dir;
    }    

    ##
    ## Importação de indicadores de negócio
    ##
    
    /* Carregamento de resultados/objectivos de indicadores para tabela temporária */
    function dk_insere_valores_indicadores($cd_ind_, $data_, $qtd_, $montante_, $obj_min_, $obj_max_, $empresa_, $estab_, $desporto_, $ref_import_, $ref_fich_, $dt_fich_, $nr_lin_, &$msg) {

        global $db, $null;
        $msg = '';
        $estado = 'A'; # A - criado, B - processado, X - com erro
        try {

            $stmt = $db->prepare("INSERT INTO DK_LOAD_VALOR_INDICADORES " .
                                 "(CD_INDICADOR, DATA, ESTADO, QTD, MONTANTE, OBJ_MAX, OBJ_MIN, EMPRESA, CD_ESTAB, DESPORTO, REF_IMPORT, REF_FICHEIRO, DT_FICHEIRO, NR_LINHA, MSG_ERRO) " .
                                 "VALUES(:CD_INDICADOR_, :DATA_, :ESTADO_, :QTD_, :MONTANTE_, :OBJ_MAX_, :OBJ_MIN_, :EMPRESA_, :CD_ESTAB_, :DESPORTO_, :REF_IMPORT_, :REF_FICHEIRO_, :DT_FICHEIRO_, :NR_LINHA_, :MSG_ERRO_)"
            );

            if ($cd_ind_ != '') {
                $stmt->bindParam(':CD_INDICADOR_', $cd_ind_, PDO::PARAM_STR);
            } else {
                $stmt->bindParam(':CD_INDICADOR_', $null, PDO::PARAM_NULL);
            }

            if ($data_ != '') {
                $stmt->bindParam(':DATA_', $data_, PDO::PARAM_STR);
            } else {
                $stmt->bindParam(':DATA_', $null, PDO::PARAM_NULL);
            }

            $stmt->bindParam(':ESTADO_', $estado, PDO::PARAM_STR);

            if (strval($qtd_) != '' || $qtd_ == '0') {
                $stmt->bindParam(':QTD_', $qtd_, PDO::PARAM_STR);
            } else {
                $stmt->bindParam(':QTD_', $null, PDO::PARAM_NULL);
            }

            if (strval($montante_) != '' || $montante_ == '0') {
                $stmt->bindParam(':MONTANTE_', $montante_, PDO::PARAM_STR);
            } else {
                $stmt->bindParam(':MONTANTE_', $null, PDO::PARAM_NULL);
            }

            if (strval($obj_max_) != '' || $obj_max_ == '0') {
                $stmt->bindParam(':OBJ_MAX_', $obj_max_, PDO::PARAM_STR);
            } else {
                $stmt->bindParam(':OBJ_MAX_', $null, PDO::PARAM_NULL);
            }

            if (strval($obj_min_) != '' || $obj_min_ == '0') {
                $stmt->bindParam(':OBJ_MIN_', $obj_min_, PDO::PARAM_STR);
            } else {
                $stmt->bindParam(':OBJ_MIN_', $null, PDO::PARAM_NULL);
            }

            if ($empresa_ != '') {
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
            } else {
                $stmt->bindParam(':EMPRESA_', $null, PDO::PARAM_NULL);
            }

            if ($estab_ != '') {
                $stmt->bindParam(':CD_ESTAB_', $estab_, PDO::PARAM_STR);
            } else {
                $stmt->bindParam(':CD_ESTAB_', $null, PDO::PARAM_NULL);
            }

            if ($desporto_ != '') {
                $stmt->bindParam(':DESPORTO_', $desporto_, PDO::PARAM_STR);
            } else {
                $stmt->bindParam(':DESPORTO_', $null, PDO::PARAM_NULL);
            }

            if ($ref_import_ != '') {
                $stmt->bindParam(':REF_IMPORT_', $ref_import_, PDO::PARAM_STR);
            } else {
                $stmt->bindParam(':REF_IMPORT_', $null, PDO::PARAM_NULL);
            }

            if ($ref_fich_ != '') {
                $stmt->bindParam(':REF_FICHEIRO_', $ref_fich_, PDO::PARAM_STR);
            } else {
                $stmt->bindParam(':REF_FICHEIRO_', $null, PDO::PARAM_NULL);
            }

            if ($dt_fich_ != '') {
                $stmt->bindParam(':DT_FICHEIRO_', $dt_fich_, PDO::PARAM_STR);
            } else {
                $stmt->bindParam(':DT_FICHEIRO_', $null, PDO::PARAM_NULL);
            }

            if ($nr_lin_ != '' || $nr_lin_ == '0') {
                $stmt->bindParam(':NR_LINHA_', $nr_lin_, PDO::PARAM_STR);
            } else {
                $stmt->bindParam(':NR_LINHA_', $null, PDO::PARAM_NULL);
            }

            $stmt->bindParam(':MSG_ERRO_', $null, PDO::PARAM_NULL);

            $stmt->execute();
            
        } catch (Exception $ex) {
            $msg = "dk_insere_valores_indicadores#1: " . $ex->getMessage();
        }
    }
    
    /* Valida a existência de indicador */
    function dk_valida_indicador($ind_, &$cd_ind_, &$dt_ini_ind_, &$msg) {
        global $db, $null;
        $cd_ind_ = '';
        $dt_ini_ind_ = '';
        $msg = '';
        try {
            $stmt = $db->prepare("SELECT CD_INDICADOR, DT_INICIO " .
                                 "FROM DK_DEF_INDICADORES_PREMIO " .
                                 "WHERE CD_INDICADOR = :CD_INDICADOR_ " .
                                 "  AND DT_FIM IS NULL  ");

            $stmt->bindParam(':CD_INDICADOR_', $ind_, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row['CD_INDICADOR'] == '' || $row['DT_INICIO'] == '') {
                $msg = $ui_missing_indicator;
            } else {
                $cd_ind_ = $row['CD_INDICADOR'];
                $dt_ini_ind_ = $row['DT_INICIO'];
            }
        } catch (Exception $ex) {
            $msg = "dk_valida_indicador#1: " . $ex->getMessage();
        }
    }
    
    /* Valida a existência de estabelecimento */
    function dk_valida_estab($empresa_, $cd_estab_, &$msg) {
        global $db, $null;
        $msg = '';
        $dsp = '';
        try {
            $stmt = $db->prepare("SELECT EMPRESA, CD_ESTAB, DSP_ESTAB " .
                                 "FROM dg_estabelecimentos " .
                                 "WHERE EMPRESA = :EMPRESA_ " .
                                 "  AND CD_ESTAB = :ESTAB_ " .
                                 "  AND ACTIVO = 'S'  ");

            $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
            $stmt->bindParam(':ESTAB_', $cd_estab_, PDO::PARAM_STR);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $dsp = $row['DSP_ESTAB'];
            }
            
        } catch (Exception $ex) {
            $msg = "dk_valida_estab#1: " . $ex->getMessage();
        }
        
        return $dsp;
    }
    
    /* Valida a existência de desporto */
    function dk_valida_desporto($desporto_, &$msg) {
        global $db, $null;
        $msg = '';
        $dsp = '';
        $dominio_ = 'DESPORTOS';
        try {
            $stmt = $db->prepare("SELECT RV_MEANING " .
                                 "FROM cg_ref_codes " .
                                 "WHERE RV_DOMAIN = :RV_DOMAIN_ " .
                                 "  AND RV_LOW_VALUE = :RV_LOW_VALUE_  ");

            $stmt->bindParam(':RV_DOMAIN_', $dominio_, PDO::PARAM_STR);
            $stmt->bindParam(':RV_LOW_VALUE_', $desporto_, PDO::PARAM_STR);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $dsp = $row['RV_MEANING'];
            }
            
        } catch (Exception $ex) {
            $msg = "dk_valida_desporto#1: " . $ex->getMessage();
        }
        
        return $dsp;
    }

    /* Valida se já existe uma quantidade/montante  ou objectivo min/max introduzido para uma data empresa/mes/indicador/estab/desporto */
    function dk_existe_valor($empresa_, $mes_, $cd_ind_, $dt_ind_, $cd_estab_, $cd_desporto_, $tipo_, &$msg) {
        global $db, $null;
        $msg = '';
        $id = '';
        
        try {
            $sql_ = "SELECT ID " .
                    "FROM DK_VALORES_INDICADOR " .
                    "WHERE EMPRESA = :EMPRESA_ " .
                    "  AND TO_CHAR(DATA,'YYYY-MM') = :MES_ ".
                    "  AND CD_INDICADOR = :CD_INDICADOR_ ".
                    "  AND DT_IN_IND = :DT_IN_IND_ ".
                    "  AND CD_ESTAB = :CD_ESTAB_ ";
            
            if ($cd_desporto_ != '') {
                $sql_ .= "  AND VALOR_FF = :CD_DESPORTO_ ";
            } else {
                $sql_ .= "  AND VALOR_FF IS NULL ";
            }
            
            if ($tipo_ == 'RESULTADOS') {
                $sql_ .= "  AND (QTD IS NOT NULL OR MONTANTE IS NOT NULL) AND OBJ_MIN IS NULL AND OBJ_MAX IS NULL ";
            } elseif ($tipo_ == 'OBJECTIVOS') {
                $sql_ .= "  AND OBJ_MIN IS NOT NULL AND OBJ_MAX IS NOT NULL AND MONTANTE IS NULL AND QTD IS NULL ";
            }
            
            $stmt = $db->prepare($sql_);
            $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
            $stmt->bindParam(':MES_', $mes_, PDO::PARAM_STR);
            $stmt->bindParam(':CD_INDICADOR_', $cd_ind_, PDO::PARAM_STR);
            $stmt->bindParam(':DT_IN_IND_', $dt_ind_, PDO::PARAM_STR);
            $stmt->bindParam(':CD_ESTAB_', $cd_estab_, PDO::PARAM_STR);
            if ($cd_desporto_ != '') {
                $stmt->bindParam(':CD_DESPORTO_', $cd_desporto_, PDO::PARAM_STR);
            }
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $id = $row['ID'];
            }
            
        } catch (Exception $ex) {
            $msg = "dk_existe_valor#1: " . $ex->getMessage();
        }
        
        return $id;
    }
    
    /* Valida a informação de resultados/objectivos carregada dos ficheiros e coloca a informação válida em tabela */
    function dk_trata_valores_indicadores($ref_import_, $empresa_, &$cnt, &$cnt_erros, &$msg) {

        global  $db
               ,$msg_invalid_qtd
               ,$msg_invalid_amount
               ,$msg_invalid_percent
               ,$msg_invalid_indicador
               ,$msg_invalid_stablishment
               ,$msg_invalid_sport
               ,$msg_invalid_month;
        
        $msg = '';
        $cnt = 0;
        $cnt_erros = 0;
        $ff_ = 'DESPORTOS';
        $estado_ = 'A'; # A - criado, B - processado, X - com erro
        
        ## Determina a fase com base no perfil ativo ($fase_ = '')
        $fase_ = '';
        $nova_fase_ = dk_avalia_fase('B', $fase_, $msg);

        try {
            $stmt = $db->prepare(   "SELECT ID, CD_INDICADOR, DATA, ESTADO, ".
                                    " REPLACE(QTD,',','.') QTD, REPLACE(MONTANTE,',','.') MONTANTE, ".
                                    " REPLACE(OBJ_MAX,',','.') OBJ_MAX, REPLACE(OBJ_MIN,',','.') OBJ_MIN, ".
                                    " EMPRESA, CD_ESTAB, DESPORTO, NR_LINHA " .
                                    "FROM DK_LOAD_VALOR_INDICADORES " .
                                    "WHERE REF_IMPORT = :REF_IMPORT_ " .
                                    "ORDER BY NR_LINHA ");

            $stmt->bindParam(':REF_IMPORT_', $ref_import_, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $ex) {
            $msg = "dk_trata_valores_indicadores#1: " . $ex->getMessage();
        }

        if ($msg == '') {
            try {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $line_msg = '';
                    $data_ = str_replace(".", "-", $row['DATA']);
                    $id_valor_ = '';
                    $cd_ind_ = '';
                    $dt_ini_ind_ = '';
                    $msg = '';

                    # valida mês
                    if ($row['DATA'] != '') {
                        $data_ = substr($data_,0,7)."-01";
                        if (!($data_ == date("Y-m-d",strtotime($data_)))) {
                            $line_msg .= " ".$msg_invalid_month.".";
                        }
                    }
                    
                    # valida indicador
                    if ($row['CD_INDICADOR'] != '') {
                        dk_valida_indicador($row['CD_INDICADOR'], $cd_ind_, $dt_ini_ind_, $msg);
                        if ($msg != '') {
                            $line_msg .= " ".$msg.".";
                        } else {
                            if ($cd_ind_ == '' || $dt_ini_ind_ == '') {
                                $line_msg .= " ".$msg_invalid_indicador.".";
                            }
                        }
                    } else {
                        $line_msg .= " ".$msg_invalid_indicador.".";
                    }

                    # valida estabelecimento
                    if ($row['CD_ESTAB'] != '') {
                        $dsp = dk_valida_estab($empresa_, $row['CD_ESTAB'], $msg);
                        if ($msg != '') {
                            $line_msg .= " ".$msg.".";
                        } else {
                            if ($dsp == '') {
                                $line_msg .= " ".$msg_invalid_stablishment.".";
                            }
                        }
                    } else {
                        $line_msg .= " ".$msg_invalid_stablishment.".";
                    }
                    
                    # valida desporto
                    if ($row['DESPORTO'] != '') {
                        $dsp = dk_valida_desporto($row['DESPORTO'], $msg);
                        if ($msg != '') {
                            $line_msg .= " ".$msg.".";
                        } else {
                            if ($dsp == '') {
                                $line_msg .= " ".$msg_invalid_sport.".";
                            }
                        }
                    }
                    
                    # valida quantidade
                    if (strval($row['QTD']) != '' && !is_numeric($row['QTD'])) {
                        $line_msg .= " ".$msg_invalid_qtd.".";
                    }

                    # valida montante
                    if (strval($row['MONTANTE']) != '' && !is_numeric($row['MONTANTE'])) {
                        $line_msg .= " ".$msg_invalid_amount.".";
                    }
                            
                    # valida % objetivo min
                    if (strval($row['OBJ_MIN']) != '' && !is_numeric($row['OBJ_MIN'])) {
                        $line_msg .= " ".$msg_invalid_amount.".";
#                    } elseif ($row['OBJ_MIN'] != '' && $row['OBJ_MIN'] < -100 || $row['OBJ_MIN'] > 100) {
#                        $line_msg .= " ".$msg_invalid_percent.".";
                    }
                            
                    # valida % objetivo max
                    if (strval($row['OBJ_MAX']) != '' && !is_numeric($row['OBJ_MIN'])) {
                        $line_msg .= " ".$msg_invalid_amount.".";
#                    } elseif ($row['OBJ_MAX'] != '' && $row['OBJ_MAX'] < -100 || $row['OBJ_MAX'] > 100) {
#                        $line_msg .= " ".$msg_invalid_percent.".";
                    }
                    
                    if ($row['QTD'] == '' && $row['MONTANTE'] == '' && $row['OBJ_MIN'] == '' && $row['OBJ_MAX'] == '') {
                        $line_msg .= " ".$msg_line_without_values.".";
                    }

                    if ($line_msg == '') {

                        try {
                            $mes_ = substr($data_,0,7);
                            
                            $tipo_ = '';
                            if (strval($row['QTD']) != '' || strval($row['MONTANTE']) != '') {
                                $tipo_ = 'RESULTADOS';
                            }
                            elseif (strval($row['OBJ_MIN']) != '' && strval($row['OBJ_MAX']) != '') {
                                $tipo_ = 'OBJECTIVOS';
                            }
                            
                            $id_ = dk_existe_valor($row['EMPRESA'], $mes_, $cd_ind_, $dt_ini_ind_, $row['CD_ESTAB'], $row['DESPORTO'], $tipo_, $msg);
                            
                            if ($msg == '') {

                                # INSERÇÃO DE VALORES
                                if ($id_ == '') {
                                    $stmt1 = $db->prepare("INSERT INTO DK_VALORES_INDICADOR " .
                                                          "(EMPRESA, DATA, FASE, CD_INDICADOR, DT_IN_IND, CD_ESTAB, CD_FF, VALOR_FF, QTD, MONTANTE, OBJ_MAX, OBJ_MIN, QTD_ANT, MONTANTE_ANT, OBJ_MAX_ANT, OBJ_MIN_ANT) ".
                                                          "VALUES (:EMPRESA_, :DATA_, :FASE_, :CD_INDICADOR_, :DT_IN_IND_, :CD_ESTAB_, :CD_FF_, :VALOR_FF_, :QTD_, :MONTANTE_, :OBJ_MAX_, :OBJ_MIN_, :QTD_, :MONTANTE_, :OBJ_MAX_, :OBJ_MIN_)"
                                                         );
                                    
                                    $stmt1->bindParam(':EMPRESA_', $row['EMPRESA'], PDO::PARAM_STR);
                                    $stmt1->bindParam(':DATA_', $data_, PDO::PARAM_STR);
                                    $stmt1->bindParam(':FASE_', $nova_fase_, PDO::PARAM_STR);
                                    $stmt1->bindParam(':CD_INDICADOR_', $cd_ind_, PDO::PARAM_STR);
                                    $stmt1->bindParam(':DT_IN_IND_', $dt_ini_ind_, PDO::PARAM_STR);
                                    $stmt1->bindParam(':CD_ESTAB_', $row['CD_ESTAB'], PDO::PARAM_STR);
                                    
                                    if ($row['DESPORTO'] != '') {
                                        $stmt1->bindParam(':CD_FF_', $ff_, PDO::PARAM_STR);
                                        $stmt1->bindParam(':VALOR_FF_', $row['DESPORTO'], PDO::PARAM_STR);
                                    } else {
                                        $stmt1->bindParam(':CD_FF_', $null, PDO::PARAM_NULL);
                                        $stmt1->bindParam(':VALOR_FF_', $null, PDO::PARAM_NULL);
                                    }

                                    if (strval($row['QTD']) != '' || $row['QTD'] == '0') {
                                        $stmt1->bindParam(':QTD_', $row['QTD'], PDO::PARAM_STR);
                                    } else {
                                        $stmt1->bindParam(':QTD_', $null, PDO::PARAM_NULL);
                                    }

                                    if (strval($row['MONTANTE']) != '' || $row['MONTANTE'] == '0') {
                                        $stmt1->bindParam(':MONTANTE_', $row['MONTANTE'], PDO::PARAM_STR);
                                    } else {
                                        $stmt1->bindParam(':MONTANTE_', $null, PDO::PARAM_NULL);
                                    }

                                    if (strval($row['OBJ_MAX']) != '' || $row['OBJ_MAX'] == '0') {
                                        $stmt1->bindParam(':OBJ_MAX_', $row['OBJ_MAX'], PDO::PARAM_STR);
                                    } else {
                                        $stmt1->bindParam(':OBJ_MAX_', $null, PDO::PARAM_NULL);
                                    }

                                    if (strval($row['OBJ_MIN']) != '' || $row['OBJ_MIN'] == '0') {
                                        $stmt1->bindParam(':OBJ_MIN_', $row['OBJ_MIN'], PDO::PARAM_STR);
                                    } else {
                                        $stmt1->bindParam(':OBJ_MIN_', $null, PDO::PARAM_NULL);
                                    }
                                    
                                # ATUALIZAÇÃO DE VALORES
                                } else {
                                    
                                    if ($tipo_ == 'RESULTADOS') {
                                        $stmt1 = $db->prepare("UPDATE DK_VALORES_INDICADOR " .
                                                              "SET FASE = :FASE_, QTD = :QTD_, MONTANTE = :MONTANTE_ ".
                                                              "   ,QTD_ANT = :QTD_, MONTANTE_ANT = :MONTANTE_ ".
                                                              "WHERE ID = :ID_");
                                        
                                        $stmt1->bindParam(':ID_', $id_, PDO::PARAM_STR);
                                        $stmt1->bindParam(':FASE_', $nova_fase_, PDO::PARAM_STR);
                                        $stmt1->bindParam(':QTD_', $row['QTD'], PDO::PARAM_STR);
                                        $stmt1->bindParam(':MONTANTE_', $row['MONTANTE'], PDO::PARAM_STR);
                                    } 
                                    elseif ($tipo_ == 'OBJECTIVOS') {
                                        $stmt1 = $db->prepare("UPDATE DK_VALORES_INDICADOR " .
                                                              "SET FASE = :FASE_, OBJ_MAX = :OBJ_MAX_, OBJ_MIN = :OBJ_MIN_ ".
                                                              "   ,OBJ_MAX_ANT = :OBJ_MAX_, OBJ_MIN_ANT = :OBJ_MIN_ ".
                                                              "WHERE ID = :ID_");
                                        
                                        $stmt1->bindParam(':ID_', $id_, PDO::PARAM_STR);
                                        $stmt1->bindParam(':FASE_', $nova_fase_, PDO::PARAM_STR);
                                        $stmt1->bindParam(':OBJ_MAX_', $row['OBJ_MAX'], PDO::PARAM_STR);
                                        $stmt1->bindParam(':OBJ_MIN_', $row['OBJ_MIN'], PDO::PARAM_STR);
                                    }                           
                                }
                                $stmt1->execute();

                                if ($id_ == '') {
                                    $id_valor_ = $db->lastInsertId();
                                } else {
                                    $id_valor_ = $id_;
                                }

                            }
                        } catch (Exception $ex) {
                            $line_msg = $ex->getMessage();
                        }
                    }

                    try {
                        $stmt1 = $db->prepare(  "UPDATE DK_LOAD_VALOR_INDICADORES " .
                                                "SET ESTADO = :ESTADO_ " .
                                                "   ,MSG_ERRO = :MSG_ERRO_ " .
                                                "   ,ID_VALOR = :ID_VALOR_ " .
                                                "WHERE ID = :ID_");
                        $estado_ = 'B';
                        $cnt += 1;
                        if ($line_msg != '') {
                            $estado_ = 'X';
                            $cnt_erros += 1;
                        }

                        $stmt1->bindParam(':ID_', $row['ID'], PDO::PARAM_STR);
                        $stmt1->bindParam(':ESTADO_', $estado_, PDO::PARAM_STR);
                        if ($line_msg != '') {
                            $stmt1->bindParam(':MSG_ERRO_', $line_msg, PDO::PARAM_STR);
                        } else {
                            $stmt1->bindParam(':MSG_ERRO_', $null, PDO::PARAM_NULL);
                        } 
                        
                        if ($id_valor_ != '') {
                            $stmt1->bindParam(':ID_VALOR_', $id_valor_, PDO::PARAM_STR);
                        } else {
                            $stmt1->bindParam(':ID_VALOR_', $null, PDO::PARAM_NULL);
                        } 
                        
                        $stmt1->execute();
                    } catch (Exception $ex) {
                        $msg = "dk_trata_valores_indicadores#1: " . $ex->getMessage();
                    }
                }
            } catch (Exception $ex) {
                $msg = "dk_trata_valores_indicadores#3: " . $ex->getMessage();
            }
        }
    }
    
    /* Obtem a próxima referência para importação */
    function dk_get_next_ref_import(&$msg) {
        
        global $db, $null;
        $msg = '';
        $id = 0;
        try {
            $stmt = $db->prepare("SELECT RV_LOW_VALUE SEQ FROM cg_ref_codes WHERE RV_DOMAIN = 'DK_IMPORT_SEQ' ");
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $id = $row['SEQ'] + 1;
                if ($id == '') {
                    $id = 0;
                }
            }            
        } catch (Exception $ex) {
            $msg = "dk_get_next_ref_import#1: " . $ex->getMessage();
        }
        
        try {
            $stmt = $db->prepare("UPDATE cg_ref_codes SET RV_LOW_VALUE = :ID_ WHERE RV_DOMAIN = 'DK_IMPORT_SEQ' ");
            $stmt->bindParam(':ID_', $id, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $ex) {
            $msg = "dk_get_next_ref_import#2: " . $ex->getMessage();
        }
        
        return $id;
    }
    
    /* Função que aprova um valor de indicador */
    function dk_aprova_valor_indicador($id_, &$msg) {
             
        global $db, $null;
        $msg = '';
        
        ## Determina a fase com base no perfil ativo ($fase_ = '')
        $fase_ = '';
        $nova_fase_ = dk_avalia_fase('B', $fase_, $msg);
        $usr_ = @$_SESSION['utilizador'];
        if ($id_ != '' && $msg == '') {
            
            $sql =  "UPDATE DK_VALORES_INDICADOR A ".
                    "SET A.FASE = :FASE_ ".
                    "   ,A.CHANGED_BY = :USER_ ".
                    "   ,A.DT_UPDATED = QUADATE() ".
                    "WHERE A.ID = :ID_ ";
            
            try {
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':ID_', $id_, PDO::PARAM_STR);
                $stmt->bindParam(':FASE_', $nova_fase_, PDO::PARAM_STR);
                $stmt->bindParam(':USER_', $usr_, PDO::PARAM_STR);
                $stmt->execute();     
           
            } catch (PDOException $ex) {
                $msg = "dk_aprova_valor_indicador#1 :" . $ex->getMessage();
            }
        } 
    } 
    
    /* Função que rejeita um valor de indicador */
    function dk_rejeita_valor_indicador($id_, &$msg) {
             
        global $db, $null;
        $msg = '';
        $usr_ = @$_SESSION['utilizador'];
        
        ## fase de cancelada/rejeição
        ##
        $fase_rej_ = 'Z';
        if ($id_ != '' && $msg == '') {
            
            $sql =  "UPDATE DK_VALORES_INDICADOR A ".
                    "SET A.FASE = :FASE_ ".
                    "   ,A.CHANGED_BY = :USER_ ".
                    "   ,A.DT_UPDATED = QUADATE() ".
                    "WHERE A.ID = :ID_ ";
            
            try {
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':ID_', $id_, PDO::PARAM_STR);
                $stmt->bindParam(':FASE_', $fase_rej_, PDO::PARAM_STR);
                $stmt->bindParam(':USER_', $usr_, PDO::PARAM_STR);
                $stmt->execute();     
           
            } catch (PDOException $ex) {
                $msg = "dk_reject_valor_indicador#1 :" . $ex->getMessage();
            }
        } 
    } 

    ##
    ## Gestão de coeficientes
    ##

    /* Função que obtem valores de indicadores corrente */
    function dk_get_valores_indicadores($empresa_, $rhid_, $dt_adm_, $ano_, $mes_, $cd_ind_, $dt_ind_, $cd_estab_, $cd_desporto_aplic_, &$cd_desporto_,
                                        &$qtd_, &$montante_, &$obj_min_, &$obj_max_, &$msg) {

        ##
        ## presuposto:
        ##              1. SE $cd_desporto_ != '' => VALOR COM $cd_desporto => VALOR COM $estab
        ##              2. SE $cd_desporto_ == '' => VALOR COM $estab
        ##
        global $db, $null, $dk_debug;

        $msg = '';
        $qtd_ = '';
        $montante_ = '';
        $obj_min_ = '';
        $obj_max_ = '';
        $cd_desporto_ = array();
        $fase_final_ = dk_det_fase_final('B', $msg);

        if ($empresa_ != '' && $ano_ != '' && $mes_ != '' &&  $cd_ind_ != '' &&  $dt_ind_ != '') {

            ## ano/mês referência
            $ano_mes_ = str_pad($ano_,4,STR_PAD_LEFT,"0")."-".str_pad($mes_,2,STR_PAD_LEFT,"0");

            ## desporto
            $sql =  "SELECT A.QTD, A.MONTANTE, A.OBJ_MAX, A.OBJ_MIN, A.VALOR_FF ".
                    "FROM DK_VALORES_INDICADOR A ".
                    "WHERE A.EMPRESA = :EMPRESA_ ".
                    "  AND A.CD_INDICADOR = :CD_INDICADOR_ ".
                    "  AND A.DT_IN_IND = :DT_IN_IND_ ".
                    "  AND DATE_FORMAT(A.DATA,'%Y-%m') = :ANO_MES_ ".
                    "  AND COALESCE(A.CD_ESTAB,'@') = COALESCE(:CD_ESTAB_,'@') ".
		    "  AND A.FASE = :FASE_ ".
                    "  AND A.VALOR_FF IN ".
		    " 	(SELECT X.VALOR ".
                    "    FROM web_rh_id_flexfields X ".
		    "    WHERE X.CD_FF = 'DESPORTOS' ".
		    "     AND X.ESTADO = 'E' ".
		    "     AND X.ESTADO_ESTORNO IS NULL ".
		    "     AND X.REMOVIDO = 'N' ".
                    "     AND X.RHID = :RHID_ ";

            /* PTE: 2019.08.06
             * No caso das condições de aplicabilidade de um coeficiente incluírem no critério de seleção dos colaboradores um DESPORTO,
             * e caso existam valores desse desporto definidos para o ESTABELECIMENTO do(s) colaborador(es) em questão, o cálculo desse coeficiente
             * só tem em conta esse desporto, desprezando quaisquer outros desportos que o colaborador possa ter assignado, mesmo que existam valores
             * para esses desportos no ESTABELECIMENTO em questão.
             */
            if ($cd_desporto_aplic_ != '') {
                $sql .= " AND X.VALOR = :CD_DESPORTO_ ";
            }

            $sql .= "     AND :ANO_MES_ BETWEEN DATE_FORMAT(X.DT_INI,'%Y-%m') AND DATE_FORMAT(COALESCE(X.DT_FIM,SYSDATE()),'%Y-%m') )".
                    "ORDER BY A.CD_ESTAB, A.CD_FF ";

            try {
                $stmt = $db->prepare($sql);

                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':CD_INDICADOR_', $cd_ind_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_IN_IND_', $dt_ind_, PDO::PARAM_STR);
                $stmt->bindParam(':ANO_MES_', $ano_mes_, PDO::PARAM_STR);
                $stmt->bindParam(':FASE_', $fase_final_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);

                if ($cd_estab_ != '') {
                    $stmt->bindParam(':CD_ESTAB_', $cd_estab_, PDO::PARAM_STR);
                } else {
                    $stmt->bindParam(':CD_ESTAB_', $null, PDO::PARAM_NULL);
                }
                if ($cd_desporto_aplic_ != '') {
                    $stmt->bindParam(':CD_DESPORTO_', $cd_desporto_aplic_, PDO::PARAM_STR);
                }

                $stmt->execute();

            } catch (PDOException $ex) {
                $msg = "dk_get_valores_indicadores#1 :" . $ex->getMessage();
            }

            if ($msg == '') {
                try {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        if (strval($row['QTD']) != '') {
                            $qtd_ += $row['QTD'];
#			    $cd_desporto_ = $row['VALOR_FF'];
			    if(!in_array($row['VALOR_FF'], $cd_desporto_, true)){
			        array_push($cd_desporto_, $row['VALOR_FF']);
			    }
                        }
                        if (strval($row['MONTANTE']) != '') {
                            $montante_ += $row['MONTANTE'];
#			    $cd_desporto_ = $row['VALOR_FF'];
			    if(!in_array($row['VALOR_FF'], $cd_desporto_, true)){
			        array_push($cd_desporto_, $row['VALOR_FF']);
                        }
                        }
                        if (strval($row['OBJ_MIN']) != '') {
                            $obj_min_ = $row['OBJ_MIN'];
#			    $cd_desporto_ = $row['VALOR_FF'];
			    if(!in_array($row['VALOR_FF'], $cd_desporto_, true)){
			        array_push($cd_desporto_, $row['VALOR_FF']);
			    }
                        }
                        if (strval($row['OBJ_MAX']) != '') {
                            $obj_max_ = $row['OBJ_MAX'];
#			    $cd_desporto_ = $row['VALOR_FF'];
			    if(!in_array($row['VALOR_FF'], $cd_desporto_, true)){
			        array_push($cd_desporto_, $row['VALOR_FF']);
			    }
                        }
                    }
                } catch (Exception $ex) {
                    $msg = "dk_get_valores_indicadores#2 :" . $ex->getMessage();
                }

                ## se não existir valor para desporto, então procura valor do estabelecimento
                if ($msg == '' && $qtd_ == '' && $montante_ == '' && $obj_min_ == '' && $obj_max_ == '') {

	            $sql =  "SELECT A.QTD, A.MONTANTE, A.OBJ_MAX, A.OBJ_MIN, A.VALOR_FF ".
	                    "FROM DK_VALORES_INDICADOR A ".
	                    "WHERE A.EMPRESA = :EMPRESA_ ".
	                    "  AND A.CD_INDICADOR = :CD_INDICADOR_ ".
	                    "  AND A.DT_IN_IND = :DT_IN_IND_ ".
	                    "  AND DATE_FORMAT(A.DATA,'%Y-%m') = :ANO_MES_ ".
	                    "  AND COALESCE(A.CD_ESTAB,'@') = COALESCE(:CD_ESTAB_,'@') ".
			    "  AND A.FASE = :FASE_ ".
	                    "  AND A.VALOR_FF IS NULL ".
	                    "ORDER BY A.CD_ESTAB, A.CD_FF ";

                    try {
                        $stmt = $db->prepare($sql);

                        $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                        $stmt->bindParam(':CD_INDICADOR_', $cd_ind_, PDO::PARAM_STR);
                        $stmt->bindParam(':DT_IN_IND_', $dt_ind_, PDO::PARAM_STR);
                        $stmt->bindParam(':ANO_MES_', $ano_mes_, PDO::PARAM_STR);
                        $stmt->bindParam(':FASE_', $fase_final_, PDO::PARAM_STR);

                        if ($cd_estab_ != '') {
                            $stmt->bindParam(':CD_ESTAB_', $cd_estab_, PDO::PARAM_STR);
                        } else {
                            $stmt->bindParam(':CD_ESTAB_', $null, PDO::PARAM_NULL);
                        }

                        $stmt->execute();

                    } catch (Exception $ex) {
                        $msg = "dk_get_valores_indicadores#3 :" . $ex->getMessage();
                    }

                    if ($msg == '') {
                        try {
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                if (strval($row['QTD']) != '') {
                                    $qtd_ = $row['QTD'];
                                }
                                if (strval($row['MONTANTE']) != '') {
                                    $montante_ = $row['MONTANTE'];
                                }
                                if (strval($row['OBJ_MIN']) != '') {
                                    $obj_min_ = $row['OBJ_MIN'];
                                }
                                if (strval($row['OBJ_MAX']) != '') {
                                    $obj_max_ = $row['OBJ_MAX'];
                                }
                            }
                        } catch (Exception $ex) {
                            $msg = "dk_get_valores_indicadores#4 :" . $ex->getMessage();
                        }
                    }
                }

            }

if ($dk_debug) {
    echo "VALORES ind:$cd_ind_ dt_ind:$dt_ind_ estab:$cd_estab_  desp:$cd_desporto_  ano_mes:$ano_mes_ ano:$ano_ mes:$mes_ ".
         "qtd:$qtd_ montante:$montante_ obj min:$obj_min_ max:$obj_max_<br/>";
}
        }
        else {
            $msg = $msg_insuficient_data;
        }
    }

    function dk_get_obj_min_max_desporto($empresa_, $ano_, $mes_, $cd_ind_, $dt_ind_, $cd_estab_, $cd_desporto_, &$objt_min_, &$objt_max_, &$msg) {

        global $db, $null, $dk_debug;

        $msg = '';
        $objt_min_ = '';
        $objt_max_ = '';
        $fase_final_ = dk_det_fase_final('B', $msg);

        if ($empresa_ != '' && $ano_ != '' && $mes_ != '' &&  $cd_ind_ != '' &&  $dt_ind_ != '' && $cd_estab_ != '' && $cd_desporto_ != '') {

            ## ano/mês referência
            $ano_mes_ = str_pad($ano_,4,STR_PAD_LEFT,"0")."-".str_pad($mes_,2,STR_PAD_LEFT,"0");

            $sql =  "SELECT A.OBJ_MAX, A.OBJ_MIN  ".
                    "FROM DK_VALORES_INDICADOR A ".
                    "WHERE A.EMPRESA = :EMPRESA_ ".
                    "  AND A.CD_INDICADOR = :CD_INDICADOR_ ".
                    "  AND A.DT_IN_IND = :DT_IN_IND_ ".
                    "  AND DATE_FORMAT(A.DATA,'%Y-%m') = :ANO_MES_ ".
                    "  AND A.CD_ESTAB = :CD_ESTAB_ ".
		    "  AND A.FASE = :FASE_ ".
                    "  AND A.VALOR_FF = :CD_DESPORTO_ ".
                    "  AND A.OBJ_MIN IS NOT NULL ".
                    "  AND A.OBJ_MAX IS NOT NULL ".
                    "  AND A.VALOR_FF IS NOT NULL ".
                    "ORDER BY A.CD_ESTAB, A.CD_FF ";

            try {
                $stmt = $db->prepare($sql);

                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':CD_INDICADOR_', $cd_ind_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_IN_IND_', $dt_ind_, PDO::PARAM_STR);
                $stmt->bindParam(':ANO_MES_', $ano_mes_, PDO::PARAM_STR);
                $stmt->bindParam(':FASE_', $fase_final_, PDO::PARAM_STR);
                $stmt->bindParam(':CD_ESTAB_', $cd_estab_, PDO::PARAM_STR);
                $stmt->bindParam(':CD_DESPORTO_', $cd_desporto_, PDO::PARAM_NULL);

                $stmt->execute();

            } catch (PDOException $ex) {
                $msg = "dk_get_obj_min_max_desporto#1 :" . $ex->getMessage();
            }

            if ($msg == '') {
                try {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$objt_min_ = $row['OBJ_MIN'];
			$objt_max_ = $row['OBJ_MAX'];

#if ($cd_ind_ == '914' and ($cd_desporto_ == '00005' || $cd_desporto_ == '09046'))
#	echo "desporto:$cd_desporto_ min:".$row['OBJ_MIN']."($objt_min_) max:".$row['OBJ_MAX']."($objt_max_) <br/>";

                    }
                } catch (Exception $ex) {
                    $msg = "dk_get_obj_min_max_desporto#2 :" . $ex->getMessage();
                }

            }
        }
        else {
            $msg = $msg_insuficient_data;
        }
    }


    /* Função que obtem valores de indicadores homologos */
    function dk_get_valores_indicadores_homologos($empresa_, $rhid_, $dt_adm_, $ano_, $mes_, $cd_ind_, $dt_ind_, $cd_estab_, $cd_desporto_, $tipo_obj_,
	                                          &$qtd_, &$montante_, &$obj_min_, &$obj_max_, &$msg) {

        ##
        ## presuposto:
        ##              1. SE $cd_desporto_ != '' => VALOR COM $cd_desporto => VALOR COM $estab
        ##              2. SE $cd_desporto_ == '' => VALOR COM $estab
        ##
        global $db, $null, $dk_debug;

        $msg = '';
        $qtd_ = '';
        $montante_ = '';

        $qtd_max_ = '';
        $qtd_min_ = '';
        $montante_max_ = '';
        $montante_min_ = '';
        $obj_min_desp_ = '';
        $obj_max_desp_ = '';

        $fase_final_ = dk_det_fase_final('B', $msg);

	$desportos_ = implode(",",$cd_desporto_);

        if ($empresa_ != '' && $ano_ != '' && $mes_ != '' &&  $cd_ind_ != '' &&  $dt_ind_ != '') {

            ## ano/mês referência
            $ano_mes_ = str_pad($ano_,4,STR_PAD_LEFT,"0")."-".str_pad($mes_,2,STR_PAD_LEFT,"0");

            ## desporto
            if ($desportos_ != '') {

                ## a ordenação é VITAL para obter primeiro os OBJ's e depois as quantidade ou montantes
                ## para poder calcular a seguir as PCT ponderadas de OBJ_MAX e OBJ_MIN
                $sql =  "SELECT A.QTD, A.MONTANTE, A.VALOR_FF ".
                    "FROM DK_VALORES_INDICADOR A ".
                    "WHERE A.EMPRESA = :EMPRESA_ ".
                    "  AND A.CD_INDICADOR = :CD_INDICADOR_ ".
                    "  AND A.DT_IN_IND = :DT_IN_IND_ ".
                    "  AND DATE_FORMAT(A.DATA,'%Y-%m') = :ANO_MES_ ".
                    "  AND A.CD_ESTAB = :CD_ESTAB_ ".
		    "  AND A.FASE = :FASE_ ".
                        "  AND A.VALOR_FF IN ($desportos_) ".
                        "  AND (A.QTD IS NOT NULL OR A.MONTANTE IS NOT NULL) ".
                        "ORDER BY A.CD_FF, A.OBJ_MAX DESC ";

            try {
                $stmt = $db->prepare($sql);

                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':CD_INDICADOR_', $cd_ind_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_IN_IND_', $dt_ind_, PDO::PARAM_STR);
                $stmt->bindParam(':ANO_MES_', $ano_mes_, PDO::PARAM_STR);
                $stmt->bindParam(':FASE_', $fase_final_, PDO::PARAM_STR);

                if ($cd_estab_ != '') {
                    $stmt->bindParam(':CD_ESTAB_', $cd_estab_, PDO::PARAM_STR);
                } else {
                    $stmt->bindParam(':CD_ESTAB_', $null, PDO::PARAM_NULL);
                }

                    #if ($cd_desporto_ != '') {
                    #    $stmt->bindParam(':VALOR_FF_', $cd_desporto_, PDO::PARAM_STR);
                    #} else {
                    #    $stmt->bindParam(':VALOR_FF_', $null, PDO::PARAM_NULL);
                    #}

                $stmt->execute();

            } catch (PDOException $ex) {
                $msg = "dk_get_valores_indicadores_homologos#1 :" . $ex->getMessage();
            }

            if ($msg == '') {
                try {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                            if (strval($row['QTD']) != '') {
                                $qtd_ += $row['QTD'];

                                ## obtenção dos objectivos mínimos e máximos do desporto para o período corrente
                                dk_get_obj_min_max_desporto($empresa_, ($ano_ + 1), $mes_, $cd_ind_, $dt_ind_, $cd_estab_, $row['VALOR_FF'], $obj_min_desp_, $obj_max_desp_, $msg);

                                if ($tipo_obj_ == 'B') { # objectivo registado em grandeza
	                                $qtd_min_ += $obj_min_desp_;
        	                        $qtd_max_ += $obj_max_desp_;
                                } else { # objectivo registado em percentagem
	                                $qtd_min_ += $row['QTD'] * (1 + $obj_min_desp_ / 100);
        	                        $qtd_max_ += $row['QTD'] * (1 + $obj_max_desp_ / 100);
                                }

                            }

                            if (strval($row['MONTANTE']) != '') {

                                $montante_ += $row['MONTANTE'];

                                ## obtenção dos objectivos mínimos e máximos do desporto para o período corrente
                                dk_get_obj_min_max_desporto($empresa_, ($ano_ + 1), $mes_, $cd_ind_, $dt_ind_, $cd_estab_, $row['VALOR_FF'], $obj_min_desp_, $obj_max_desp_, $msg);

                                if (strval($obj_min_desp_) != '' && strval($obj_max_desp_) != '')  {
	                                if ($tipo_obj_ == 'B') { # objectivo registado em grandeza
		                                $montante_min_ += $obj_min_desp_;
		                                $montante_max_ += $obj_max_desp_;
	                                } else { # objectivo registado em percentagem
		                                $montante_min_ += $row['MONTANTE'] * (1 + $obj_min_desp_ / 100);
		                                $montante_max_ += $row['MONTANTE'] * (1 + $obj_max_desp_ / 100);
	                                }
                                }
#if ($rhid_ == 529 && $cd_ind_ == '600')
#	echo "desporto:".$row['VALOR_FF']." montante:$montante_ obj min:$obj_min_desp_ max:$obj_max_desp_ montante min:$montante_min_ max:$montante_max_ msg:$msg <br/>";
                        }

                        }

                        ## determina novos obj_min e max
                        if (strval($montante_min_) != '' && strval($montante_max_) != '') {
                            if ($montante_ == 0) {
                                    $obj_min_ = 0;
                                    $obj_max_ = 0;
                            } else {
                                    $obj_min_ = ($montante_min_ / $montante_ - 1) * 100;
                                    $obj_max_ = ($montante_max_ / $montante_ - 1) * 100;
                        }
                        } elseif (strval($qtd_min_) != '' && strval($qtd_max_) != '') {
                            if ($qtd_ == 0) {
                                    $obj_min_ = 0;
                                    $obj_max_ = 0;
                            } else {
                                    $obj_min_ = ($qtd_min_ / $qtd_ - 1) * 100;
                                    $obj_max_ = ($qtd_max_ / $qtd_ - 1) * 100;
                        }
                    }

                } catch (Exception $ex) {
                    $msg = "dk_get_valores_indicadores_homologos#2 :" . $ex->getMessage();
                }
                }

            } ## desporto ?

                ## se não existir valor para desporto, então procura valor do estabelecimento
            if ($msg == '' && $qtd_ == '' && $montante_ == '') {

	            $sql =  "SELECT A.QTD, A.MONTANTE, A.OBJ_MAX, A.OBJ_MIN, A.VALOR_FF ".
	                    "FROM DK_VALORES_INDICADOR A ".
	                    "WHERE A.EMPRESA = :EMPRESA_ ".
	                    "  AND A.CD_INDICADOR = :CD_INDICADOR_ ".
	                    "  AND A.DT_IN_IND = :DT_IN_IND_ ".
	                    "  AND DATE_FORMAT(A.DATA,'%Y-%m') = :ANO_MES_ ".
	                    "  AND A.CD_ESTAB = :CD_ESTAB_ ".
			    "  AND A.FASE = :FASE_ ".
	                    "  AND A.VALOR_FF IS NULL ".
	                    "ORDER BY A.CD_ESTAB, A.CD_FF ";

                    try {
                        $stmt = $db->prepare($sql);

                        $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                        $stmt->bindParam(':CD_INDICADOR_', $cd_ind_, PDO::PARAM_STR);
                        $stmt->bindParam(':DT_IN_IND_', $dt_ind_, PDO::PARAM_STR);
                        $stmt->bindParam(':ANO_MES_', $ano_mes_, PDO::PARAM_STR);
                        $stmt->bindParam(':FASE_', $fase_final_, PDO::PARAM_STR);

                        if ($cd_estab_ != '') {
                            $stmt->bindParam(':CD_ESTAB_', $cd_estab_, PDO::PARAM_STR);
                        } else {
                            $stmt->bindParam(':CD_ESTAB_', $null, PDO::PARAM_NULL);
                        }

                        $stmt->execute();

                    } catch (Exception $ex) {
                        $msg = "dk_get_valores_indicadores_homologos#3 :" . $ex->getMessage();
                    }

                    if ($msg == '') {
                        try {
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                            if (strval($row['QTD']) != '') {
                                    $qtd_ = $row['QTD'];
                                }
                            if (strval($row['MONTANTE']) != '') {
                                    $montante_ = $row['MONTANTE'];
                                }

                            ## Não são recolhidos os objetivos max e mínimos do período homólogo no caso de ser por estabelecimento
                            #if ($row['OBJ_MIN'] != '') {
                            #    $obj_min_ = $row['OBJ_MIN'];
                            #}
                            #if ($row['OBJ_MAX'] != '') {
                            #    $obj_max_ = $row['OBJ_MAX'];
                            #}
                            }
                        } catch (Exception $ex) {
                            $msg = "dk_get_valores_indicadores_homologos#4 :" . $ex->getMessage();
                        }
                    }
                }


if ($dk_debug) {
    echo "VALORES HOMOLOGOS ind:$cd_ind_ dt_ind:$dt_ind_ estab:$cd_estab_  desp:DESPORTO:".implode("|",$desporto_valor_)."  ano_mes:$ano_mes_ ano:$ano_ mes:$mes_ ".
         "qtd:$qtd_ montante:$montante_ obj min:$obj_min_ max:$obj_max_<br/>";
}
        }
        else {
            $msg = $msg_insuficient_data;
        }
    }


    /* Cálculo do prémio e geração de cabeçalho de prémio */
    function dk_cria_hdr_coef_premio($empresa_, $ano_, $mes_, $cd_premio_, $obs_, &$msg) {
        global $db, $null,
               $msg_insuficient_data;
        $msg = '';
        
        if ($empresa_ != '' && $ano_ != '' && $mes_ != '' && $cd_premio_ != '') {
            try {
                $stmt = $db->prepare(
                            "INSERT INTO DK_ID_HDR_COEF_PREMIOS " .
                            "(EMPRESA, ANO, MES, CD_PREMIO, OBS) ".
                            "VALUES (:EMPRESA_, :ANO, :MES_, :CD_PREMIO_, :OBS_)"
                        );
                
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ANO', $ano_, PDO::PARAM_STR);
                $stmt->bindParam(':MES_', $mes_, PDO::PARAM_STR);
                $stmt->bindParam(':CD_PREMIO_', $cd_premio_, PDO::PARAM_STR);
                if ($obs_ != '') {
                    $stmt->bindParam(':OBS_', $obs_, PDO::PARAM_STR);
                } else {
                    $stmt->bindParam(':OBS_', $null, PDO::PARAM_NULL);
                }

                $stmt->execute();
          } catch (Exception $ex) {
                $msg = "dk_cria_hdr_coef_premio#1: " . $ex->getMessage();
            }
        } else {
            $msg = $msg_insuficient_data;
        }
    }

    /* Calculo da % do prémio aplicável ao colaborador */
    function dk_cria_det_coef_premio($empresa_, $ano_, $mes_, $cd_premio_, $cd_ind_, $dt_ind_, $grandeza_, $tipo_obj_, $coef_max_, $rhid_, $dt_adm_,
                                     $cd_estab_, $id_setor_, $dt_setor_, $cd_catg_prof_int_,
                                     $id_func_, $dt_func_, $cd_vinc_, $cd_desporto_, $obs_, &$msg) {
        global $db
              ,$null
              ,$msg_insuficient_data
              ,$dk_debug
              ,$dk_debug_rhid;

        # inicialização
        $msg = '';
        $pct_ = 0;
        $obj_min_ = '';
        $obj_max_= '';
        $valor_ = '';
        $qtd_ = '';
        $montante_ = '';
        $amplitude = '';
        $fator = '';

        # ano anterior
        $qtd_ano_ant_ = '';
        $montante_ano_ant_ = '';
        $dummy_ = '';

        $tp_func_ = '';
        if ($id_func_ != '' && $dt_func_ != '') {
            $tp_func_ = 'A';
        }

        $ff_ = '';
        if ($cd_desporto_ != '') {
            $ff_ = 'DESPORTOS';
        }

        ## o cálculo de coeficientes coloca-os na fase final de aprovação (workflow de alteração de coeficientes)
        $fase_ = dk_det_fase_final('A', $msg);

        ## desporto associado à obtenção dos valores correntes
        $desporto_valor_ = array();

        ## obtenção do valor corrente e objetivo associado ao indicador
        dk_get_valores_indicadores($empresa_,  $rhid_, $dt_adm_, $ano_, $mes_, $cd_ind_, $dt_ind_, $cd_estab_, $cd_desporto_, $desporto_valor_,
                                   $qtd_, $montante_, $obj_min_, $obj_max_, $msg);

if ($dk_debug) {
echo "DESPORTOS EXISTENTES:<br/>";
if (count($desporto_valor_) > 0) {
	print_r($desporto_valor_);
} else {
	echo "NAO EXISTEM DESPORTOS PARA CALCULO.";
}
echo "<br/>";
echo "obj_min:$obj_min_  obj_max:$obj_max_ <br/>";

}
        ## obtenção do valor ano anterior (homologo)
        dk_get_valores_indicadores_homologos($empresa_, $rhid_, $dt_adm_, ($ano_ - 1), $mes_, $cd_ind_, $dt_ind_, $cd_estab_, $desporto_valor_, $tipo_obj_,
         				     $qtd_ano_ant_, $montante_ano_ant_, $obj_min_, $obj_max_, $msg);


if ($dk_debug || $dk_debug_rhid == $rhid_) {
    echo "PARAM[$empresa_, $ano_, $mes_, IND:$cd_ind_/$dt_ind_, ESTAB:$cd_estab_, DESPORTO:".implode("|",$desporto_valor_).", RHID:$rhid_] ".
         "RES[$qtd_, $montante_, $obj_min_, $obj_max_] ".
         "RES HOMOLOG[$qtd_ano_ant_, $montante_ano_ant_] ".
         "MSG:[$msg]<br/>";
}

        if ($msg == '') {

            if ($tipo_obj_ == 'A') { # objectivos em percentagem

                # quantidade variação crescente em % [(vlr_ano_corrente / vlr_ano_anterior) - 1 ]
            if ($grandeza_ == 'A') {
                if ($qtd_ano_ant_ == 0 || $qtd_ano_ant_ == '') {
                    $valor_ = -1;
                } else {
                    $valor_ = ($qtd_ / $qtd_ano_ant_) - 1;
                }
                $valor_ = $valor_ * 100;

                    # PTE 2019.04.23: o valor a considerar é absoluto, uma vez que poderemos ter variações entre valores negativos.
                    if ($qtd_ < 0 && $qtd_ano_ant_ < 0) {
                            $valor_ = abs($valor_);
                    }
                }
                # montante variação crescente em % [(vlr_ano_corrente / vlr_ano_anterior) - 1 ]
                elseif ($grandeza_ == 'B') {
                if ($montante_ano_ant_ == 0 || $montante_ano_ant_ == '') {
                    $valor_ = -1;
                } else {
                    $valor_ = ($montante_ / $montante_ano_ant_) - 1;
                }
                $valor_ = $valor_ * 100;

                    # PTE 2019.04.23: o valor a considerar é absoluto, uma vez que poderemos ter variações entre valores negativos.
                    if ($montante_ < 0 && $montante_ano_ant_ < 0) {
                            $valor_ = abs($valor_);
                    }

                }
                # quantidade variação decrescente em % [(vlr_ano_anterior / vlr_ano_corrente) - 1 ]
                elseif ($grandeza_ == 'C') {
                    if ($qtd_ano_ant_ == 0 || $qtd_ano_ant_ == '') {
                        $valor_ = -1;
                    } else {
                        $valor_ = ($qtd_ano_ant_ / $qtd_) - 1;
                    }
                    $valor_ = $valor_ * 100;

                    # PTE 2019.04.23: o valor a considerar é absoluto, uma vez que poderemos ter variações entre valores negativos.
                    if ($qtd_ < 0 && $qtd_ano_ant_ < 0) {
                            $valor_ = abs($valor_);
                    }

                }
                # montante variação decrescente em % [(vlr_ano_anterior / vlr_ano_corrente) - 1 ]
                elseif ($grandeza_ == 'D') {
                    if ($montante_ano_ant_ == 0 || $montante_ano_ant_ == '') {
                        $valor_ = -1;
                    } else {
                        $valor_ = ($montante_ano_ant_ / $montante_) - 1;
                    }
                    $valor_ = $valor_ * 100;

                    # PTE 2019.04.23: o valor a considerar é absoluto, uma vez que poderemos ter variações entre valores negativos.
                    if ($montante_ < 0 && $montante_ano_ant_ < 0) {
                            $valor_ = abs($valor_);
                    }

            }

            } elseif ($tipo_obj_ == 'B') { # objectivos em montente

                # quantidade variação crescente em % [(vlr_ano_corrente / vlr_ano_anterior) - 1 ]
                if ($grandeza_ == 'A') {
                    $valor_ = $qtd_;
                }
                # montante variação crescente em % [(vlr_ano_corrente / vlr_ano_anterior) - 1 ]
                elseif ($grandeza_ == 'B') {
                    $valor_ = $montante_;
                }
                # quantidade variação decrescente em % [(vlr_ano_anterior / vlr_ano_corrente) - 1 ]
                elseif ($grandeza_ == 'C') {
                    $valor_ = $qtd_;
                }
                # montante variação decrescente em % [(vlr_ano_anterior / vlr_ano_corrente) - 1 ]
                elseif ($grandeza_ == 'D') {
                    $valor_ = $montante_;
                }

            }

if ($dk_debug || $dk_debug_rhid == $rhid_) {

   if ($tipo_obj_ == 'A') { # objectivos em percentagem
echo "TIPO_OBJECTIVO -> EM PERCENTAGEM <br/>";
   } elseif ($tipo_obj_ == 'B') { # objectivos em montente
echo "TIPO_OBJECTIVO -> EM MONTANTE <br/>";
   }

    if ($grandeza_ == 'A') {
echo "VARIACAO CRESCENTE qtd_ant:$qtd_ano_ant_ qtd:$qtd_ valor:$valor_<br/>";
    } elseif ($grandeza_ == 'B') {
echo "VARIACAO CRESCENTE montante_ant:$montante_ano_ant_ montante:$montante_ valor:$valor_<br/>";
    }
    elseif ($grandeza_ == 'C') {
echo "VARIACAO DECRESCENTE qtd_ant:$qtd_ano_ant_ qtd:$qtd_ valor:$valor_<br/>";
    } elseif ($grandeza_ == 'D') {
echo "VARIACAO DECRESCENTE montante_ant:$montante_ano_ant_ montante:$montante_ valor:$valor_<br/>";
    }

echo "obj_min:$obj_min_  obj_max:$obj_max_ <br/>";
}
            # cálcula a percentagem a aplicar de acordo com o valor obtido
            $pct_ = '';
            if (strval($valor_) != '' && strval($obj_min_) != '' && strval($obj_max_) != '') {
	            dk_calcula_pct_premio($valor_, $obj_min_, $obj_max_, $coef_max_, $tipo_obj_, $amplitude_, $fator_, $pct_);
            }

            # verifica se já existe resultado para o indicador em questão
            $existe_ = false;
            if (strval($pct_) != '') {
	            try {
			$stmt = $db->prepare(	"SELECT 1 FROM DK_ID_DET_COEF_PREMIOS A ".
						"WHERE A.EMPRESA = :EMPRESA_ ".
						"  AND A.ANO = :ANO_ ".
						"  AND A.MES = :MES_ ".
						"  AND A.CD_PREMIO IN ".
						"(SELECT DISTINCT X.CD_PREMIO ".
						" FROM DK_DEF_MATRIZ_PREMIOS X ".
						" WHERE X.DT_FIM IS NULL ".
						"   AND X.CD_INDICADOR IN ".
                                                "	(SELECT Z.CD_INDICADOR ".
                                                "	 FROM DK_DEF_MATRIZ_PREMIOS Z ".
                                                "	 WHERE Z.CD_PREMIO = :CD_PREMIO_ ".
                                                "	   AND Z.DT_FIM IS NULL ) ".
                                                ") ".
						"  AND A.RHID = :RHID_ ".
						"  AND A.DT_ADMISSAO = :DT_ADMISSAO_ ".
                                                "  AND A.PCT_PREMIO != 0 ");

			$stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
			$stmt->bindParam(':ANO_', $ano_, PDO::PARAM_STR);
			$stmt->bindParam(':MES_', $mes_, PDO::PARAM_STR);
			$stmt->bindParam(':CD_PREMIO_', $cd_premio_, PDO::PARAM_STR);
			$stmt->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
			$stmt->bindParam(':DT_ADMISSAO_', $dt_adm_, PDO::PARAM_STR);
			$stmt->execute();
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	                	$existe_ = true;
                                break;
	            	}

		    } catch (Exception $ex) {
		    	$msg = "dk_cria_det_coef_premio#0: " . $ex->getMessage();
		    }
	    }

            if ($msg == '' && $empresa_ != '' && $ano_ != '' && $mes_ != '' && $cd_premio_ != '' && $rhid_ != '' && $dt_adm_ != '' && (strval($pct_) != '' || strval($pct_) == '0') && !$existe_) {
                try {
                    $stmt = $db->prepare(
                                "INSERT INTO DK_ID_DET_COEF_PREMIOS " .
                                "(EMPRESA, ANO, MES, CD_PREMIO, RHID, DT_ADMISSAO, ".
                                " PCT_PREMIO, PCT_PREMIO_ANT, FASE, FASE_ANT, VALOR_LIDO, COEF_MAX, OBJ_MIN, OBJ_MAX, AMPLITUDE, FATOR_APLICAVEL, ".
                                " CD_ESTAB, ID_SETOR, DT_INI_SETOR, CD_CATG_PROF_INTERNA, ".
                                " ID_FUNCAO, TP_REGISTO, DT_INI_FUNCAO, CD_VINCULO, CD_FF, VALOR_FF, OBS) ".
                                "VALUES (:EMPRESA_, :ANO_, :MES_, :CD_PREMIO_, :RHID_, :DT_ADMISSAO_, ".
                                " :PCT_PREMIO_, :PCT_PREMIO_, :FASE_, :FASE_, :VALOR_LIDO_, :COEF_MAX_, :OBJ_MIN_, :OBJ_MAX_, :AMPLITUDE_, :FATOR_APLICAVEL_, ".
                                " :CD_ESTAB_, :ID_SETOR_, :DT_INI_SETOR_, :CD_CATG_PROF_INTERNA_, ".
                                " :ID_FUNCAO_, :TP_REGISTO_, :DT_INI_FUNCAO_, :CD_VINCULO_, :CD_FF_, :VALOR_FF_, :OBS_) ".
                                "ON DUPLICATE KEY UPDATE ".
                                "   PCT_PREMIO = :PCT_PREMIO_ ".
                                "  ,PCT_PREMIO_ANT = :PCT_PREMIO_ ".
                                "  ,FASE = :FASE_ ".
                                "  ,VALOR_LIDO = :VALOR_LIDO_ ".
                                "  ,COEF_MAX = :COEF_MAX_ ".
                                "  ,OBJ_MIN = :OBJ_MIN_ ".
                                "  ,OBJ_MAX = :OBJ_MAX_ ".
                                "  ,AMPLITUDE = :AMPLITUDE_ ".
                                "  ,FATOR_APLICAVEL = :FATOR_APLICAVEL_ "
                            );

                    $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                    $stmt->bindParam(':ANO_', $ano_, PDO::PARAM_STR);
                    $stmt->bindParam(':MES_', $mes_, PDO::PARAM_STR);
                    $stmt->bindParam(':CD_PREMIO_', $cd_premio_, PDO::PARAM_STR);
                    $stmt->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_, PDO::PARAM_STR);

                    $stmt->bindParam(':FASE_', $fase_, PDO::PARAM_STR);

                    if (strval($pct_) != '' || $pct_ == '0') {
			$stmt->bindParam(':PCT_PREMIO_', $pct_, PDO::PARAM_STR);
                    } else {
			$stmt->bindParam(':PCT_PREMIO_', $null, PDO::PARAM_NULL);
		    }

                    if (strval($valor_) != '' || $valor_ == '0') {
			$stmt->bindParam(':VALOR_LIDO_', $valor_, PDO::PARAM_STR);
                    } else {
			$stmt->bindParam(':VALOR_LIDO_', $null, PDO::PARAM_NULL);
		    }

                    if (strval($coef_max_) != '' || $coef_max_ == '0') {
			$stmt->bindParam(':COEF_MAX_', $coef_max_, PDO::PARAM_STR);
                    } else {
			$stmt->bindParam(':COEF_MAX_', $null, PDO::PARAM_NULL);
		    }

                    if (strval($obj_min_) != '' || $obj_min_ == '0') {
			$stmt->bindParam(':OBJ_MIN_', $obj_min_, PDO::PARAM_STR);
                    } else {
			$stmt->bindParam(':OBJ_MIN_', $null, PDO::PARAM_NULL);
		    }

                    if (strval($obj_max_) != '' || $obj_max_ == '0') {
			$stmt->bindParam(':OBJ_MAX_', $obj_max_, PDO::PARAM_STR);
                    } else {
			$stmt->bindParam(':OBJ_MAX_', $null, PDO::PARAM_NULL);
		    }

                    if (strval($amplitude_) != '' || $amplitude_ == '0') {
			$stmt->bindParam(':AMPLITUDE_', $amplitude_, PDO::PARAM_STR);
                    } else {
			$stmt->bindParam(':AMPLITUDE_', $null, PDO::PARAM_NULL);
		    }

                    if (strval($fator_) != '' || $fator_ == '0') {
			$stmt->bindParam(':FATOR_APLICAVEL_', $fator_, PDO::PARAM_STR);
                    } else {
			$stmt->bindParam(':FATOR_APLICAVEL_', $null, PDO::PARAM_NULL);
		    }

                    if ($cd_estab_ != '') {
                        $stmt->bindParam(':CD_ESTAB_', $cd_estab_, PDO::PARAM_STR);
                    } else {
                        $stmt->bindParam(':CD_ESTAB_', $null, PDO::PARAM_NULL);
                    }

                    if ($id_setor_ != '') {
                        $stmt->bindParam(':ID_SETOR_', $id_setor_, PDO::PARAM_STR);
                    } else {
                        $stmt->bindParam(':ID_SETOR_', $null, PDO::PARAM_NULL);
                    }

                    if ($dt_setor_ != '') {
                        $stmt->bindParam(':DT_INI_SETOR_', $dt_setor_, PDO::PARAM_STR);
                    } else {
                        $stmt->bindParam(':DT_INI_SETOR_', $null, PDO::PARAM_NULL);
                    }

                    if ($cd_catg_prof_int_ != '') {
                        $stmt->bindParam(':CD_CATG_PROF_INTERNA_', $cd_catg_prof_int_, PDO::PARAM_STR);
                    } else {
                        $stmt->bindParam(':CD_CATG_PROF_INTERNA_', $null, PDO::PARAM_NULL);
                    }

                    if ($id_func_ != '') {
                        $stmt->bindParam(':ID_FUNCAO_', $id_func_, PDO::PARAM_STR);
                    } else {
                        $stmt->bindParam(':ID_FUNCAO_', $null, PDO::PARAM_NULL);
                    }

                    if ($tp_func_ != '') {
                        $stmt->bindParam(':TP_REGISTO_', $tp_func_, PDO::PARAM_STR);
                    } else {
                        $stmt->bindParam(':TP_REGISTO_', $null, PDO::PARAM_NULL);
                    }

                    if ($dt_func_ != '') {
                        $stmt->bindParam(':DT_INI_FUNCAO_', $dt_func_, PDO::PARAM_STR);
                    } else {
                        $stmt->bindParam(':DT_INI_FUNCAO_', $null, PDO::PARAM_NULL);
                    }

                    if ($cd_vinc_ != '') {
                        $stmt->bindParam(':CD_VINCULO_', $cd_vinc_, PDO::PARAM_STR);
                    } else {
                        $stmt->bindParam(':CD_VINCULO_', $null, PDO::PARAM_NULL);
                    }

                    if ($ff_ != '') {
                        $stmt->bindParam(':CD_FF_', $ff_, PDO::PARAM_STR);
                    } else {
                        $stmt->bindParam(':CD_FF_', $null, PDO::PARAM_NULL);
                    }

                    if ($cd_desporto_ != '') {
                        $stmt->bindParam(':VALOR_FF_', $cd_desporto_, PDO::PARAM_STR);
                    } else {
                        $stmt->bindParam(':VALOR_FF_', $null, PDO::PARAM_NULL);
                    }

                    if ($obs_ != '') {
                        $stmt->bindParam(':OBS_', $obs_, PDO::PARAM_STR);
                    } else {
                        $stmt->bindParam(':OBS_', $null, PDO::PARAM_NULL);
                    }

                    $stmt->execute();
if ($dk_debug || $dk_debug_rhid == $rhid_) {
    echo "[RHID:".$rhid_."] ".
    	 "[CD_ESTAB:$cd_estab_] ".
    	 "[DESPORTO:$cd_desporto_] ".
         "[VALOR:".$valor_."] ".
         "[OBJ_MIN:".$obj_min_."] ".
         "[OBJ_MAX:".$obj_max_."] ".
         "[COEF_MAX:".$coef_max_."] ".
         "[AMPLITUDE:".$amplitude_."] ".
         "[FATOR:".$fator_."] ".
         "[PCT:".$pct_."]<br/> ";
}
              } catch (Exception $ex) {

$msg1 =  "ERRO [RHID:".$rhid_."] ".
         "[VALOR:".$valor_."] ".
         "[OBJ_MIN:".$obj_min_."] ".
         "[OBJ_MAX:".$obj_max_."] ".
         "[COEF_MAX:".$coef_max_."] ".
         "[AMPLITUDE:".$amplitude_."] ".
         "[FATOR:".$fator_."] ".
         "[PCT:".$pct_."]";

                    $msg = "dk_cria_det_coef_premio#1 [$msg1]: " . $ex->getMessage();
              }
            }
        }

    }

    /* calcula a percentagem do prémio de acordo com a variável introduzida */
    function dk_calcula_pct_premio($valor_, $obj_min_, $obj_max_, $coef_max_, $tipo_obj_, &$amplitude_, &$fator_, &$pct_) {

        global $dk_debug;

        #
        # Determinação da amplitude do objectivo
        #
        #   Amplitude = OBJ_MAX - OBJ_MIN
        #
        $amplitude_ = 0;
        if (strval($obj_max_) != '' && strval($obj_min_) != '') {
            $amplitude_ = $obj_max_ - $obj_min_;
        }

        #
        # Determinação do fator
        # Valor no intervalo entre obj_min e obj_max;
        #   -> Se valor < obj_min => 0%,
        #   -> Se > obj_max => $coef_max
        $fator_ = 0;
        if ($tipo_obj_ == 'A') { # objectivos em percentagem

           # objetivos com percentagens crescentes
	   if ($obj_max_ >  $obj_min_) {
        if ($valor_ < $obj_min_) {
            $fator_ = 0;
        } elseif ($valor_ > $obj_max_) {
            $fator_ = $coef_max_;
	                $amplitude_ = $coef_max_;
	            } else {
	               $fator_ = $valor_ - $obj_min_;
	            }
           # objetivos com percentagens decrescentes
           } else {
		    $amplitude = $obj_min_ - $obj_max_;
		    if ($valor_ < $obj_min_ && $valor_ > $obj_max_) {
	                $fator_ = $valor_ - $obj_min_;
	            } elseif ($valor_ > $obj_min_) {
	                $fator_ = 0;
        } else {
	                $fator_ = $coef_max_;
	                $amplitude_ = $coef_max_;
	            }
            }
        } elseif ($tipo_obj_ == 'B') { # objectivos em montante
           $fator_ = $valor_ - $obj_min_;
        }

        #
        # Determinação da percentagem prémio
        #
        # PCT = FATOR / AMPLITUDE * COEF_MAX
        $pct_ = 0;

        if ($tipo_obj_ == 'A') { # objectivos em percentagem
        if ($fator_ == 0 || $amplitude_ == 0 || $coef_max_ == 0) {
            $pct_ = 0;
        } else {
            $pct_ = ($fator_ / $amplitude_ * $coef_max_);
        }
        } elseif ($tipo_obj_ == 'B') { # objectivos em montante
            if ($valor_ < $obj_min_) {
                $pct_ = 0;
            } elseif ($valor_ >= $obj_max_) {
                $pct_ = $coef_max_;
            } else {
                $pct_ = ($fator_ / $amplitude_ * $coef_max_);
            }
        }

        # arredondamento da percentagem
        $pct_ = round($pct_,2);

        if ($pct_ > $coef_max_) {
		$pct_ = $coef_max_;
        }
if ($dk_debug) {
    echo "[valor:$valor_] [obj_min:$obj_min_] [obj_max:$obj_max_] [coef_max:$coef_max_] [amplitude:$amplitude_] [fator:$fator_] [PCT:$pct_]<br/>";
}        

    }
        
    /* Procedimento de cálculo de prémios */
    function dk_calcula_premios($empresa_, $ano_, $mes_, &$msg) {

        global $db
              ,$null
              ,$msg_insuficient_data
              ,$dk_debug;
        $msg = '';
        $ff_ = 'DESPORTOS';

        if ($empresa_ != '' && $ano_ != '' && $mes_ != '') {

            ## remove valores anteriores
            try {
                $sql = "DELETE FROM DK_ID_DET_COEF_PREMIOS WHERE EMPRESA = :EMPRESA_ AND ANO = :ANO_ AND MES = :MES_ ";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ANO_', $ano_, PDO::PARAM_STR);
                $stmt->bindParam(':MES_', $mes_, PDO::PARAM_STR);
                $stmt->execute();

                $sql = "DELETE FROM DK_ID_HDR_COEF_PREMIOS WHERE EMPRESA = :EMPRESA_ AND ANO = :ANO_ AND MES = :MES_ ";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ANO_', $ano_, PDO::PARAM_STR);
                $stmt->bindParam(':MES_', $mes_, PDO::PARAM_STR);
                $stmt->execute();
            } catch (PDOException $ex) {
                $msg = "dk_calcula_premios#0 :" . $ex->getMessage();
            }

            ## ano/mês referência
            $ano_mes_ = str_pad($ano_,4,STR_PAD_LEFT,"0")."-".str_pad($mes_,2,STR_PAD_LEFT,"0");
            $mes_sel_ = '@'.$mes_.'@';

            ## seleciona as matrizes de prémios a aplicar
            try {
                $stmt = $db->prepare(
                            "SELECT A.CD_PREMIO, A.CD_INDICADOR, A.DT_INI_INDICADOR, A.GRANDEZA, A.MODELO, A.FREQ_CALCULO, A.TIPO_OBJECTIVO, A.FORMULA, A.COEF_MAX, ".
                            "       A.RHID, A.MESES_INTEGRACAO, A.CD_RUBRICA " .
                            "FROM DK_DEF_MATRIZ_PREMIOS A ".
                            "WHERE COALESCE(A.EMPRESA,COALESCE(:EMPRESA_,'@')) = COALESCE(:EMPRESA_,'@') ".
                            "  AND :ANO_MES_ BETWEEN DATE_FORMAT(A.DT_INICIO,'%Y-%m') AND COALESCE(DATE_FORMAT(A.DT_FIM,'%Y-%m'),:ANO_MES_) ".
                            "  AND ((A.FREQ_CALCULO = 'A') OR ".
                            "       (A.FREQ_CALCULO != 'A' AND INSTR(CONCAT(CONCAT('@',REPLACE(REPLACE(A.MESES_INTEGRACAO,' ',''),',','@')),'@'),:MES_SEL_) > 0 ) ".
                            "      )".
                            "ORDER BY A.CD_PREMIO "
                        );




                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ANO_MES_', $ano_mes_, PDO::PARAM_STR);
                $stmt->bindParam(':MES_SEL_', $mes_sel_, PDO::PARAM_STR);
                $stmt->execute();
            } catch (PDOException $ex) {
                $msg = "dk_calcula_premios#1 :" . $ex->getMessage();
            }

            if ($msg == '') {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

if ($dk_debug) {
    echo "#############################################################################<br/>";
    echo "[PREMIO:".$row['CD_PREMIO']."] ".
         "[CD_INDICADOR:".$row['CD_INDICADOR']."] ".
         "[GRANDEZA:".$row['GRANDEZA']."] ".
         "[MODELO:".$row['MODELO']."] ".
         "[TIPO OBJ:".$row['TIPO_OBJECTIVO']."] ".
         "[ANO_MES:".$ano_mes_."]<br/>";
}

                    ##
                    ## GRANDEZA: A - Quantidade, B - Montante
                    ## MODELO: A - Individual, B - Grupo
                    ## FREQ_CALCULO: A - Mensal, B - Anual, C - Trimestral, Z - Pontual
                    ##

                    ## inicialização
                    $obs_ = '';

                    ## cria registo de cabeçalho
                    dk_cria_hdr_coef_premio($empresa_, $ano_, $mes_, $row['CD_PREMIO'], $obs_, $msg);

                    if ($msg == '') {
                        
                        ## ciclo das regras a aplicar 
                        try {
                            $stmt1 = $db->prepare( 
                                        "SELECT A.ID, A.EMPRESA, A.CD_ESTAB, A.ID_SETOR, A.DT_INI_SETOR, A.ID_FUNCAO, A.DT_INI_FUNCAO, A.TP_REGISTO, ".
                                        "       A.CD_VINCULO, A.CD_CATG_PROF_INTERNA, A.CD_FF, A.VALOR_FF, A.RHID, A.DT_ADMISSAO ".
                                        "FROM DK_DEF_PREMIOS_APLIC A ".
                                        "WHERE A.CD_PREMIO = :CD_PREMIO_ ".
                                        "  AND :ANO_MES_ BETWEEN DATE_FORMAT(A.DT_INI,'%Y-%m') AND COALESCE(DATE_FORMAT(A.DT_FIM,'%Y-%m'),:ANO_MES_) ".
                                        "ORDER BY A.ID "
                                    );
                            $stmt1->bindParam(':CD_PREMIO_', $row['CD_PREMIO'], PDO::PARAM_STR);
                            $stmt1->bindParam(':ANO_MES_', $ano_mes_, PDO::PARAM_STR);
                            $stmt1->execute();                
                        } catch (PDOException $ex) {
                            $msg = "dk_calcula_premios#2 :" . $ex->getMessage();
                        }

                        if ($msg == '') {
                            while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {

if ($dk_debug) {
        echo "[REGRA:".$row1['ID']."] ".
             "[MODELO:".$row['MODELO']."] ".
             "[EMPRESA:".$empresa_."] ".
             "[CD_ESTAB:".$row1['CD_ESTAB']."] ".
             "[ID_SETOR:".$row1['ID_SETOR']."] ".
             "[ID_FUNCAO:".$row1['ID_FUNCAO']."] ".
             "[CD_VINCULO:".$row1['CD_VINCULO']."] ".
             "[CD_CATG_PROF_INTERNA:".$row['CD_CATG_PROF_INTERNA']."] ".
             "[VALOR_FF:".$row['VALOR_FF']."]<br/> ";
}

                                ## seleção dos colaboradores afetos a esta regra
                                $sql = "SELECT * ".
                                       "FROM QUAD_PEOPLE A ".
                                       "WHERE A.EMPRESA = :EMPRESA_ ".
                                       "  AND A.ATIVO = 'S' ";

/*                                if ($row['MODELO'] == 'A') {        # A - Individual
                                        
                                        $sql .= "  AND A.RHID = :RHID_ ".
                                                "  AND A.DT_ADMISSAO = :DT_ADMISSAO_ ";
                                    
                                } elseif ($row['MODELO'] == 'B') {  # B - Grupo
 */
                                    # filtro por colaborador
                                    if ($row1['RHID'] != '' && $row1['DT_ADMISSAO'] != '') {
                                        $sql .= "  AND A.RHID = :RHID_ ".
                                                "  AND A.DT_ADMISSAO = :DT_ADMISSAO_ ";
                                    }
                                    
                                    # filtro por estabelecimento
                                    if ($row1['CD_ESTAB'] != '') {
                                        $sql .= "  AND A.CD_ESTAB = :CD_ESTAB_ ";
                                    }

                                    # filtro por setor
                                    if ($row1['ID_SETOR'] != '' && $row1['DT_INI_SETOR'] != '' ) {
                                        $sql .= "  AND A.ID_SETOR = :ID_SETOR_ ";
                                        #        "  AND A.DT_INI_SETOR = :DT_INI_SETOR_ ";
                                    }

                                    # filtro por função
                                    if ($row1['ID_FUNCAO'] != '' && $row1['DT_INI_FUNCAO'] != '') {
                                        $sql .= "  AND A.ID_FUNCAO = :ID_FUNCAO_ ";
                                        #        "  AND A.DT_INI_FUNCAO = :DT_INI_FUNCAO_ ";
                                    }

                                    # filtro por vínculo
                                    if ($row1['CD_VINCULO'] != '') {
                                        $sql .= "  AND A.CD_VINCULO = :CD_VINCULO_ ";
                                    }

                                    # filtro por categoria profissional interna
                                    if ($row1['CD_CATG_PROF_INTERNA'] != '') {
                                        $sql .= "  AND A.CD_CATG_PROF_INTERNA = :CD_CATG_PROF_INTERNA_ ";
                                    }

                                    # filtro por desporto
                                    if ($row1['VALOR_FF'] != '') {
                                        $sql .= "  AND (A.EMPRESA,A.RHID) IN ".
                                                " (SELECT F.EMPRESA, F.RHID ".
                                                "  FROM web_rh_id_flexfields F ".
                                                "  WHERE F.CD_FF = :CD_FF_ ".
                                                "    AND F.ESTADO = 'E' ".
                                                "    AND F.REMOVIDO = 'N' ".
                                                "    AND F.VALOR = :VALOR_FF_".
                                                "    AND :ANO_MES_ BETWEEN DATE_FORMAT(F.DT_INI,'%Y-%m') AND COALESCE(DATE_FORMAT(F.DT_FIM,'%Y-%m'),:ANO_MES_) ".
                                                " )";
                                    }
if ($dk_debug ) {
    echo "QUERY COLABS:[$sql]<br/>";
}
#                                }
                                
                                try {
                                    $stmt2 = $db->prepare($sql);

                                    $stmt2->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);

 
 /*                                 
  *                                 if ($row['MODELO'] == 'A') {        # A - Individual
                                        $stmt2->bindParam(':RHID_', $row1['RHID'], PDO::PARAM_STR);
                                        $stmt2->bindParam(':DT_ADMISSAO_', $row1['DT_ADMISSAO'], PDO::PARAM_STR);
                                    } 
                                    elseif ($row['MODELO'] == 'B') {  # B - Grupo
*/
                                        # filtro por colaborador
                                        if ($row1['RHID'] != '' && $row1['DT_ADMISSAO'] != '') {
                                            $stmt2->bindParam(':RHID_', $row1['RHID'], PDO::PARAM_STR);
                                            $stmt2->bindParam(':DT_ADMISSAO_', $row1['DT_ADMISSAO'], PDO::PARAM_STR);
                                        }
                                    
                                        # filtro por estabelecimento
                                        if ($row1['CD_ESTAB'] != '') {
                                            $stmt2->bindParam(':CD_ESTAB_', $row1['CD_ESTAB'], PDO::PARAM_STR);
                                        }

                                        # filtro por setor
                                        if ($row1['ID_SETOR'] != '' && $row1['DT_INI_SETOR'] != '' ) {
                                            $stmt2->bindParam(':ID_SETOR_', $row1['ID_SETOR'], PDO::PARAM_STR);
                                            #$stmt2->bindParam(':DT_INI_SETOR_', $row1['DT_INI_SETOR'], PDO::PARAM_STR);
                                        }

                                        # filtro por função
                                        if ($row1['ID_FUNCAO'] != '' && $row1['DT_INI_FUNCAO'] != '') {
                                            $stmt2->bindParam(':ID_FUNCAO_', $row1['ID_FUNCAO'], PDO::PARAM_STR);
                                            #$stmt2->bindParam(':DT_INI_FUNCAO_', $row1['DT_INI_FUNCAO'], PDO::PARAM_STR);
                                        }

                                        # filtro por vínculo
                                        if ($row1['CD_VINCULO'] != '') {
                                            $stmt2->bindParam(':CD_VINCULO_', $row1['CD_VINCULO'], PDO::PARAM_STR);
                                        }

                                        # filtro por categoria profissional interna
                                        if ($row1['CD_CATG_PROF_INTERNA'] != '') {
                                            $stmt2->bindParam(':CD_CATG_PROF_INTERNA_', $row1['CD_CATG_PROF_INTERNA'], PDO::PARAM_STR);
                                        }

                                        # filtro por desporto
                                        if ($row1['VALOR_FF'] != '') {
                                            $stmt2->bindParam(':CD_FF_', $ff_, PDO::PARAM_STR);
                                            $stmt2->bindParam(':VALOR_FF_', $row1['VALOR_FF'], PDO::PARAM_STR);
                                            $stmt2->bindParam(':ANO_MES_', $ano_mes_, PDO::PARAM_STR);
                                        }
                                        
##                                  }
                                    $stmt2->execute();                

                                } catch (PDOException $ex) {
                                    $msg = "dk_calcula_premios#3 :" . $ex->getMessage();
                                }

                                if ($msg == '') {
                                    ## ciclo dos colaboradores a aplicar a regra
                                    while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                                        if ($msg == '') {
                                            dk_cria_det_coef_premio($row2['EMPRESA'], $ano_, $mes_, $row['CD_PREMIO'],
                                                                    $row['CD_INDICADOR'], $row['DT_INI_INDICADOR'], $row['GRANDEZA'], $row['TIPO_OBJECTIVO'], $row['COEF_MAX'],
                                                                    $row2['RHID'], $row2['DT_ADMISSAO'], 
                                                                    $row2['CD_ESTAB'], $row2['ID_SETOR'], $row2['DT_INI_SETOR'], $row2['CD_CATG_PROF_INTERNA'], 
                                                                    $row2['ID_FUNCAO'], $row2['DT_INI_FUNCAO'], $row2['CD_VINCULO'], $row1['VALOR_FF'], $obs_, $msg);
if ($dk_debug) {
    echo "COLAB:[".$row2['RHID']."] msg:$msg<br/>";
}                                        }
                                    }
                                }
                            }
                        }
                    }
                }        
            }
        } 
        else {
            $msg = $msg_insuficient_data;
        }
    }
    
    /* Função que obtem a percentagem associada a um colaborador/ano/mês/indicador */
    function dk_get_pct_indicador($empresa_, $ano_, $mes_, $rhid_ , $dt_adm_, $cd_ind_, $dt_ind_, &$pct_ant_, &$fase_, &$msg) {
        
        global $db, $null;
        $msg = '';
        $pct_ = '';
        $pct_ant_ = '';
        $fase_ = '';

        if ($empresa_ != '' && $ano_ != '' && $mes_ != '' &&  $rhid_ != '' && $dt_adm_ != '' && $cd_ind_ != '' &&  $dt_ind_ != '') {
            
            $sql =  "SELECT A.PCT_PREMIO, A.PCT_PREMIO_ANT, A.FASE " .
                    "FROM DK_ID_DET_COEF_PRM_VW A ".
                    "WHERE A.EMPRESA = :EMPRESA_ ".
                    "  AND A.RHID = :RHID_ ".
                    "  AND A.DT_ADMISSAO = :DT_ADMISSAO_ ".
                    "  AND A.CD_INDICADOR = :CD_INDICADOR_ ".
                    "  AND A.DT_INI_INDICADOR = :DT_INI_INDICADOR_ ".
                    "  AND A.ANO = :ANO_ ".
                    "  AND A.MES = :MES_ ".
                    "ORDER BY A.CD_PREMIO ";
            
            try {
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ANO_', $ano_, PDO::PARAM_STR);
                $stmt->bindParam(':MES_', $mes_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_, PDO::PARAM_STR);
                $stmt->bindParam(':CD_INDICADOR_', $cd_ind_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_INDICADOR_', $dt_ind_, PDO::PARAM_STR);
                $stmt->execute();                
            } catch (PDOException $ex) {
                $msg = "dk_get_pct_indicador#1 :" . $ex->getMessage();
            }

            if ($msg == '') {
                try {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $pct_ = $row['PCT_PREMIO'];
                        $pct_ant_ = $row['PCT_PREMIO_ANT'];
                        $fase_ = $row['FASE'];
                        break;
                    }
                } catch (Exception $ex) {
                    $msg = "dk_get_pct_indicador#2 :" . $ex->getMessage();
                }
            }
            
        } 
        return $pct_;
    } 

    /* Função que obtem a percentagem associada a um colaborador/ano/mês/indicador */
    function dk_save_pct_indicador($empresa_, $ano_, $mes_, $rhid_ , $dt_adm_, $cd_ind_, $dt_ind_, $pct_, &$msg) {
             
        global $db, $null;
        $msg = '';
        $fase_ = '';
        $nova_fase_ = '';
        $pct_ant_ = '';
        $x_ = '';
        $continua = true;
        $user = @$_SESSION['utilizador'];
        
        
        # caso particular: no perfil de Controller, caso não haja alteração de valor, não é necessário colocar em workflow
        if (@$_SESSION['perfil'] == 'H') { ## perfil controller
            $pct_ant_ = dk_get_pct_indicador($empresa_, $ano_, $mes_, $rhid_ , $dt_adm_, $cd_ind_, $dt_ind_, $x_, $x_, $x_);
            if ($pct_ == $pct_ant_)  {
                $continua = false;
            }
        }
            
        if ($continua) {
            ## Determina a fase com base no perfil ativo ($fase_ = '')
            $nova_fase_ = dk_avalia_fase('A', $fase_, $msg);

            if ($empresa_ != '' && $ano_ != '' && $mes_ != '' &&  $rhid_ != '' && $dt_adm_ != '' && $cd_ind_ != '' && $dt_ind_ != '' && $msg == '') {
                $sql =  "UPDATE DK_ID_DET_COEF_PRM_VW A ".
                        "  SET A.PCT_PREMIO = :PCT_ ".
                        "     ,A.FASE_ANT = A.FASE ".
                        "     ,A.FASE = :FASE_ ".
                        "     ,A.CHANGED_BY = :USER_ ".
                        "     ,A.DT_UPDATED = QUADATE() ".
                        "WHERE A.EMPRESA = :EMPRESA_ ".
                        "  AND A.RHID = :RHID_ ".
                        "  AND A.DT_ADMISSAO = :DT_ADMISSAO_ ".
                        "  AND A.CD_INDICADOR = :CD_INDICADOR_ ".
                        "  AND A.DT_INI_INDICADOR = :DT_INI_INDICADOR_ ".
                        "  AND A.ANO = :ANO_ ".
                        "  AND A.MES = :MES_ ";

                try {
                    
                    $stmt = $db->prepare($sql);
                    $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                    $stmt->bindParam(':ANO_', $ano_, PDO::PARAM_STR);
                    $stmt->bindParam(':MES_', $mes_, PDO::PARAM_STR);
                    $stmt->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_, PDO::PARAM_STR);
                    $stmt->bindParam(':CD_INDICADOR_', $cd_ind_, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_INI_INDICADOR_', $dt_ind_, PDO::PARAM_STR);
                    if (strval($pct_) != '' || $pct_ == '0') {
                        $stmt->bindParam(':PCT_', $pct_, PDO::PARAM_STR);
                    } else {
                        $stmt->bindParam(':PCT_', $null, PDO::PARAM_NULL);
                    }
                    $stmt->bindParam(':FASE_', $nova_fase_, PDO::PARAM_STR);
                    $stmt->bindParam(':USER_', $user, PDO::PARAM_STR);
                    $stmt->execute();     

                } catch (PDOException $ex) {
                    $msg = "dk_save_pct_indicador#1 :" . $ex->getMessage();
                }
            } 
        } 
    } 
    
    /* Função que rejeita a percentagem associada a um colaborador/ano/mês/indicador */
    function dk_reject_pct_indicador($empresa_, $ano_, $mes_, $rhid_ , $dt_adm_, $cd_ind_, $dt_ind_, &$msg) {
             
        global $db, $null;
        $msg = '';
        $usr_ = @$_SESSION['utilizador'];
        
        ## rejeição significa que repoe fase e valor inicial
        ##
        $fase_ini_ = 'K';
        
        if ($empresa_ != '' && $ano_ != '' && $mes_ != '' &&  $rhid_ != '' && $dt_adm_ != '' && $cd_ind_ != '' && $dt_ind_ != '' && $msg == '') {
            
            $sql =  "UPDATE DK_ID_DET_COEF_PRM_VW A ".
                    "SET A.PCT_PREMIO = A.PCT_PREMIO_ANT ".
                    "   ,A.FASE = :FASE_ ".
                    "   ,A.CHANGED_BY = :USER_ ".
                    "   ,A.DT_UPDATED = QUADATE() ".
                    "WHERE A.EMPRESA = :EMPRESA_ ".
                    "  AND A.RHID = :RHID_ ".
                    "  AND A.DT_ADMISSAO = :DT_ADMISSAO_ ".
                    "  AND A.CD_INDICADOR = :CD_INDICADOR_ ".
                    "  AND A.DT_INI_INDICADOR = :DT_INI_INDICADOR_ ".
                    "  AND A.ANO = :ANO_ ".
                    "  AND A.MES = :MES_ ";
            
            try {
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ANO_', $ano_, PDO::PARAM_STR);
                $stmt->bindParam(':MES_', $mes_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_, PDO::PARAM_STR);
                $stmt->bindParam(':CD_INDICADOR_', $cd_ind_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_INDICADOR_', $dt_ind_, PDO::PARAM_STR);
                $stmt->bindParam(':FASE_', $fase_ini_, PDO::PARAM_STR);
                $stmt->bindParam(':USER_', $usr_, PDO::PARAM_STR);
                $stmt->execute();     
           
            } catch (PDOException $ex) {
                $msg = "dk_save_pct_indicador#1 :" . $ex->getMessage();
            }
        } 
    } 
    
    /* Função que obtem o total dos coeficientes de um colaborador/ano/mês/indicador */
    function dk_get_total_coef($empresa_, $ano_, $mes_, $rhid_ , $dt_adm_, &$msg) {
        
        global $db, $null;
        $msg = '';
        $res_ = '';

        if ($empresa_ != '' && $ano_ != '' && $mes_ != '' &&  $rhid_ != '' && $dt_adm_ != '') {
            
            $sql =  "SELECT A.CD_INDICADOR, A.PCT_PREMIO ".
                    "FROM DK_ID_DET_COEF_PRM_VW A ".
                    "WHERE A.EMPRESA = :EMPRESA_ ".
                    "  AND A.RHID = :RHID_ ".
                    "  AND A.DT_ADMISSAO = :DT_ADMISSAO_ ".
                    "  AND A.ANO = :ANO_ ".
                    "  AND A.MES = :MES_ ".
                    "  AND A.PCT_PREMIO IS NOT NULL ".
                    "ORDER BY A.CD_PREMIO ";
            
            try {
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ANO_', $ano_, PDO::PARAM_STR);
                $stmt->bindParam(':MES_', $mes_, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_', $rhid_, PDO::PARAM_STR);
                $stmt->bindParam(':DT_ADMISSAO_', $dt_adm_, PDO::PARAM_STR);
                $stmt->execute();                
            } catch (PDOException $ex) {
                $msg = "dk_get_total_coef#1 :" . $ex->getMessage();
            }

            if ($msg == '') {
                try {
                    $indicador_ant = '';
                    $res_ = 0;
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			if (($indicador_ant == '' || $indicador_ant != $row['CD_INDICADOR']) && $row['PCT_PREMIO'] != 0) {
                            $res_ += round($row['PCT_PREMIO'],2);
                            $indicador_ant = $row['CD_INDICADOR'];
                        }
                    }
                } catch (Exception $ex) {
                    $msg = "dk_get_total_coef#2 :" . $ex->getMessage();
                }
            }
            
        } 
        return $res_;
    } 

    ##
    ## Gestão do mês
    ##
    
    /* Encerra mês `*/
    function dk_encerra_mes($empresa_, $ano_, $mes_, &$msg) {
        global $db, $null, $oracle;
        $msg = '';
        
        if ($empresa_ != '' && $ano_ != '' && $mes_ != '' && $msg == '') {
            
	    $usr_ = @$_SESSION['utilizador'];
            $sql =  "UPDATE DK_ID_HDR_COEF_PREMIOS A ".
                    "SET A.ESTADO = 'C' ".
                    "   ,A.CHANGED_BY = :USER_ ".
                    "   ,A.DT_UPDATED = QUADATE() ".
                    "WHERE A.EMPRESA = :EMPRESA_ ".
                    "  AND A.ANO = :ANO_ ".
                    "  AND A.MES = :MES_ ";
            
            try {
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ANO_', $ano_, PDO::PARAM_STR);
                $stmt->bindParam(':MES_', $mes_, PDO::PARAM_STR);
                $stmt->bindParam(':USER_', $usr_, PDO::PARAM_STR);
                $stmt->execute();                
            } catch (PDOException $ex) {
                $msg = "dk_encerra_mes#1 :" . $ex->getMessage();
            }
        }

        
        $connection_string = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = {$oracle['server'] })(PORT = {$oracle['port'] })))(CONNECT_DATA=(SID={$oracle['sid']})))";

        if ($msg == '') {
            try {
                $conn = oci_connect($oracle['user'], $oracle['password'], $connection_string, $oracle['charset']);
                if (!$conn) {
                    $e = oci_error();
                    //trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
                    $msg  = "dk_encerra_mes#2 :" .oci_error();
                }
                $stid = oci_parse($conn, 'ALTER SESSION SET NLS_LANGUAGE = "PORTUGUESE"');
                oci_execute($stid);        
            } catch (PDOException $ex) {
                $msg = "dk_encerra_mes#3 :" . $ex->getMessage();
            }

            if ($msg == '') {
                try {
                    $sql = "BEGIN RH_INTEGRA_COEF_PREMIOS('$empresa_',$ano_,$mes_); END;";
                    $stid = oci_parse($conn, $sql);
                    if (!$stid) {
                        $e = oci_error($conn);
                        $msg = $e['message'];
                    } else {
                        if (!oci_execute($stid)) {
                            $e = oci_error();
                            $msg = $e['message'];
                        }
                    }
                } catch (PDOException $ex) {
                    $msg = "dk_encerra_mes#4 :" . $ex->getMessage();
                }
            }
        }
        
    }

    /* Reabre mês `*/
    function dk_reabre_mes($empresa_, $ano_, $mes_, &$msg) {
        global $db, $null;
        global $msg_month_closed_in_HR;
        $msg = '';
        $estado_ = 'A';
        $usr_ = @$_SESSION['utilizador'];
        
        if ($empresa_ != '' && $ano_ != '' && $mes_ != '' && $msg == '') {
            
            $sql = "SELECT RH_ESTADO ".
                   "FROM DG_MESES A ".
                    "WHERE A.EMPRESA = :EMPRESA_ ".
                    "  AND A.ANO = :ANO_ ".
                    "  AND A.MES = :MES_ ";
            try {
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ANO_', $ano_, PDO::PARAM_STR);
                $stmt->bindParam(':MES_', $mes_, PDO::PARAM_STR);
                $stmt->execute();     
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $estado_ = $row['RH_ESTADO'];
                }
            } catch (PDOException $ex) {
                $msg = "dk_reabre_mes#1 :" . $ex->getMessage();
            }

            if ($estado_ == 'C' && $msg == '') {
                $msg = $msg_month_closed_in_HR;
            }
            
            if ($msg == '') {
                $sql =  "UPDATE DK_ID_HDR_COEF_PREMIOS A ".
                        "SET A.ESTADO = 'B' ".
                        "   ,A.CHANGED_BY = :USER_ ".
                        "   ,A.DT_UPDATED = QUADATE() ".
                        "WHERE A.EMPRESA = :EMPRESA_ ".
                        "  AND A.ANO = :ANO_ ".
                        "  AND A.MES = :MES_ ";

                try {
                    $stmt = $db->prepare($sql);
                    $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                    $stmt->bindParam(':ANO_', $ano_, PDO::PARAM_STR);
                    $stmt->bindParam(':MES_', $mes_, PDO::PARAM_STR);
                    $stmt->bindParam(':USER_', $usr_, PDO::PARAM_STR);
                    $stmt->execute();     

                } catch (PDOException $ex) {
                    $msg = "dk_encerra_mes#1 :" . $ex->getMessage();
                }
            }
        }
    }

    /* Estado mês `*/
    /* A - Aberto, B - Em processamento, C - Encerrado */
    function dk_estado_mes($empresa_, $ano_, $mes_, &$msg) {
        global $db, $null;
        $msg = '';
        $estado_ = 'A';
        if ($empresa_ != '' && $ano_ != '' && $mes_ != '' && $msg == '') {
            $sql = "SELECT DK_ESTADO_MES(A.EMPRESA,A.ANO,A.MES) ESTADO ".
                   "FROM DG_MESES A ".
                    "WHERE A.EMPRESA = :EMPRESA_ ".
                    "  AND A.ANO = :ANO_ ".
                    "  AND A.MES = :MES_ ";
            try {
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':EMPRESA_', $empresa_, PDO::PARAM_STR);
                $stmt->bindParam(':ANO_', $ano_, PDO::PARAM_STR);
                $stmt->bindParam(':MES_', $mes_, PDO::PARAM_STR);
                $stmt->execute();     
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $estado_ = $row['ESTADO'];
                }
            } catch (PDOException $ex) {
                $msg = "dk_estado_mes#1 :" . $ex->getMessage();
            }
            return $estado_;
        }
    }
    
    
    ##
    ## gestão de wokflow
    ##
    
    /* Determina a fase correspondente ao estado final do workflow */
    function dk_det_fase_final($id_proc_, &$msg) {
        global $db;
        $msg = '';
        $fase_ = '';
        
        // ID_PROC: A - Alteração Coeficientes, B - Alteração Indicadores Negócio
        if ($id_proc_ != '' && $msg == '') {
            $sql = "SELECT A.FASE ".
                   "FROM DK_PREMIOS_WORKFLOWS A ".
                    "WHERE A.PROC = :PROC_ ".
                    "  AND A.NR_ORDEM IS NOT NULL ".
                    "  AND A.DT_FIM IS NULL ".
                    "ORDER BY A.NR_ORDEM DESC ";
            try {
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':PROC_', $id_proc_, PDO::PARAM_STR);
                $stmt->execute();     
                
                // o primeiro valor é o valor com o último nr.ordem => APROVADO
                // o cancelado não tem nr.ordem
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $fase_ = $row['FASE'];
                
            } catch (PDOException $ex) {
                $msg = "dk_det_fase_final#1 :" . $ex->getMessage();
            }
        }    
        return $fase_;
    }
    
    /* Determina a fase correspondente ao estado inicial do workflow */
    function dk_det_fase_inicial($id_proc_, &$msg) {
        global $db;
        $msg = '';
        $fase_ = '';
        
        // ID_PROC: A - Alteração Coeficientes, B - Alteração Indicadores Negócio
        if ($id_proc_ != '' && $msg == '') {
            $sql = "SELECT FASE ".
                   "FROM DK_PREMIOS_WORKFLOWS A ".
                    "WHERE A.PROC = :PROC_ ".
                    "  AND A.NR_ORDEM IS NOT NULL ".
                    "  AND A.DT_FIM IS NULL ".
                    "ORDER BY A.NR_ORDEM ASC ";
            try {
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':PROC_', $id_proc_, PDO::PARAM_STR);
                $stmt->execute();     
                
                // o primeiro valor é o valor com o último nr.ordem => APROVADO
                // o cancelado não tem nr.ordem
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $fase_ = $row['ESTADO'];
            } catch (PDOException $ex) {
                $msg = "dk_det_fase_inicial#1 :" . $ex->getMessage();
            }
        }        
        return $fase_;
    }
    
    /* Determina a fase seguinte à indicada para um processo do workflow */
    function dk_det_prox_fase($id_proc_, $fase_, &$msg) {
        global $db;
        $msg = '';
        $nova_fase_ = '';
        
        // ID_PROC: A - Alteração Coeficientes, B - Alteração Indicadores Negócio
        if ($id_proc_ != '' && $msg == '') {
            $sql = "SELECT FASE ".
                   "FROM DK_PREMIOS_WORKFLOWS A ".
                    "WHERE A.PROC = :PROC_ ".
                    "  AND A.NR_ORDEM IS NOT NULL ".
                    "  AND A.DT_FIM IS NULL ".
                    "ORDER BY A.NR_ORDEM ASC ";
            try {
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':PROC_', $id_proc_, PDO::PARAM_STR);
                $stmt->execute();     
                
                // percorre o circuito de workflow, determinando a próxima fase
                // a seguir à indicada
                $avalia_ = 'N';
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    if ($avalia_ == 'S') {
                        $nova_fase_ = $row['FASE'];
                        break;
                    }
                    elseif ($row['FASE'] == $fase_) {
                        $avalia_ = 'S';
                    }
                }
            } catch (PDOException $ex) {
                $msg = "dk_det_prox_fase#1 :" . $ex->getMessage();
            }
        }        
        return $nova_fase_;
    }
    
    /* Avalia e atualiza fase dos registos de coeficientes e valores de negócio de indicadores */
    function dk_avalia_fase($id_proc_, $fase_, &$msg) {

        global $db, $null;

        $msg = "";
        
        #
        # FASES PONDERADAS
        # A | Criado
        # B | Aprovação Gestor Adm.
        # C | Aprovação Supervisor
        # D | Aprovação Diretor
        # E | Aprovação Gestor
        # H | Aprovação Controller
        # I | Aprovação Diretor Regional
        # J | Aprovação CFO
        # K | Aprovado
        # Z | Cancelado     
        #

        ## determina fase inicial, a partir do perfil ativo, caso não esteja indicada
        if ($fase_ == '') {
            if (@$_SESSION['perfil'] == 'H') { # Controller
                $fase_ = 'A';  # caso particular: o controller não aprova, introduz, pelo que é equivalente a CRIADO
            } else {
                $fase_ = @$_SESSION['perfil'];
            }
        }

        ## determina nova fase
        $nova_fase_ = dk_det_prox_fase($id_proc_, $fase_, $msg);
        
        ## excepção: Caso seja o Gestor a registar -> fica logo aprovado
        if (@$_SESSION['perfil'] == 'E' && $nova_fase_ == '') {
            $nova_fase_ = 'K';
        }
        return $nova_fase_;
                                                    
    }
  
    /* Valida a existência de sequências de workflow duplicadas */
    function dk_valida_seq_workflow($id_, $proc_, $nr_ordem_, &$msg) {
        global $db;
        $msg = '';
        $cnt = 0;
        
        // ID_PROC: A - Alteração Coeficientes, B - Alteração Indicadores Negócio
        if ($id_proc_ != '' && $msg == '') {
            $sql = "SELECT FASE ".
                   "FROM DK_PREMIOS_WORKFLOWS A ".
                    "WHERE A.PROC = :PROC_ ".
                    "  AND A.DT_FIM IS NULL ".
                    "  AND A.NR_ORDEM = :NR_ORDEM_ ";
            
            if ($id_ != '') {
                $sql .= "  AND A.ID != :ID_ ";
            }
            
            try {
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':PROC_', $id_proc_, PDO::PARAM_STR);
                $stmt->bindParam(':NR_ORDEM_', $nr_ordem_, PDO::PARAM_STR);
                if ($id_ != '') {
                    $stmt->bindParam(':ID_', $id_, PDO::PARAM_STR);
                }
                $stmt->execute();
                $cnt = $stmt->rowCount();
                
            } catch (PDOException $ex) {
                $msg = "dk_valida_seq_workflow#1 :" . $ex->getMessage();
            }
        }        
        return $cnt;        
    }
?>