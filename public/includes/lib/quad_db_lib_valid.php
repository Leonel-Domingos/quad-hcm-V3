<?php
/*
 *  @autor      Pedro Estácio <pedro.estacio@quad-systems.com>
 *  @versão     1.0
 *  @revisão    2020.04.17
 *  @copyright  (c) 2020 QuadSystems - http://www.quad-systems.com
 *  @nome	quad_db_lib_valid.php
 *  @descrição  Libraria de funções para:
 *               - Funções para validações nos interfaces
 *               - Funções para ativação de ações PRE e POST DML nos interfaces
 */


#
# FUNÇÕES DE VALIDAÇÃO
#



/*
 * Valida cruzamento de registos dentro de uma tabela.
 * 
    resource = {
        acao: "INSERT",
        empresa: "DEMO",
        rhid: "355",
        dt_adm: "2019-03-01",
        tabela: "xpto",
        col_ini: "DT_INI_SETOR",
        col_fim: "DT_FIM",
        dt_ini: "2019-01-01 12:23",
        dt_fim: "2019-01-01 17:11",
        cond_adicional: ""
    }
 */
function valida_cruzamentos($resource, &$msg) {
    global $db, $msg_time_overlap, $msg_time_overlap_wkf, $error_before_admission_dt, $error_after_resignation_dt;

    $msg = '';
    $result = array();
    $dt_ini_ = substr($resource->dt_ini,0,16);
    $dt_fim_ = substr($resource->dt_fim,0,16);

    if ($dt_fim_ === '') {
        $dt_fim_ = '2999-01-01 00:00';
    }

    // Fase 1: verifica se o registo se encontra entre datas de admissão e demissão
    if (1) {
        $query = "SELECT TO_CHAR(DT_ADMISSAO,'YYYY-MM-DD HH24:MI') DT_ADM ".
                 "      ,NVL(TO_CHAR(DT_DEMISSAO,'YYYY-MM-DD HH24:MI'),'2999-12-31 23:59') DT_DEM ".
                 "      ,TO_CHAR(DT_ADMISSAO,'YYYY-MM-DD') DT_ADMISSAO ".
                 "      ,TO_CHAR(DT_DEMISSAO,'YYYY-MM-DD') DT_DEMISSAO ".
                 "FROM RH_ID_EMPRESAS ".
                 "WHERE EMPRESA = :EMPRESA_ ".
                 "  AND RHID = :RHID_ ".
                 "  AND TO_CHAR(DT_ADMISSAO,'YYYY-MM-DD') = :DT_ADM_ ";

        try {
            $stmt = $db->prepare($query);
            $stmt->bindParam(':EMPRESA_', $resource->empresa, PDO::PARAM_STR);
            $stmt->bindParam(':RHID_', $resource->rhid, PDO::PARAM_STR);
            $stmt->bindParam(':DT_ADM_', $resource->dt_adm, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $ex) {
                $msg = "valida_cruzamentos #1[$resource->empresa,$resource->rhid,$resource->dt_adm,$resource->tabela]: " . $ex->getMessage();
        }

        if ($msg == '') {
            foreach($result as $row) {
                if ( !($dt_ini_ >= $row['DT_ADM'] && $dt_fim_ >= $row['DT_ADM'])
                    ) {
                    $msg = str_replace('{0}' , $row['DT_ADMISSAO'], $error_before_admission_dt);
                    break;
                }
                if ($row['DT_DEMISSAO'] != '') {
                    if ( !($dt_ini_ <= $row['DT_DEM'] && $dt_fim_ <= $row['DT_DEM']) ) {
                        $msg = str_replace('{0}' , $row['DT_DEMISSAO'], $error_after_resignation_dt);
                        break;
                    }
                }
            }
        }
    }
    
    // Fase 2: valida cruzamento de registo detetando sobreposições na respetiva tabela de registos efetivos
    if ($msg == '' && $resource->tabela != 'RH_ID_ENT_INTERNAS') {
        $query = "SELECT TO_CHAR($resource->col_ini,'YYYY-MM-DD HH24:MI') DT_INI, TO_CHAR($resource->col_fim,'YYYY-MM-DD HH24:MI') DT_FIM ".
                 "FROM ".$resource->tabela." ".
                 "WHERE EMPRESA = :EMPRESA_ ".
                 "  AND RHID = :RHID_ ".
                 "  AND TO_CHAR(DT_ADMISSAO,'YYYY-MM-DD') = :DT_ADM_ ";

        if ($resource->cond_adicional != '') {
            $query .= $resource->cond_adicional;
        }
        
        $query.= "  AND TO_CHAR($resource->col_ini,'YYYY-MM-DD HH24:MI') != :DT_FIM_VAL ".
                 "  AND NVL(TO_CHAR($resource->col_fim,'YYYY-MM-DD HH24:MI'),'2999-01-01 00:00') != :DT_INI_VAL ";
        
        # excluir o próprio registo
        if ($resource->acao == 'UPDATE') {

            # esta exceção visa prever a atualização de um registo de tenha sido inserido com hora 
            # e que passa a ser controlado por dia ou o inverso
            if ($resource->tabela == 'RH_ID_FERIAS') {
                $query .= "  AND TO_CHAR($resource->col_ini,'YYYY-MM-DD') != :DT_INI_VAL ";
            }
            else {
                $query .= "  AND TO_CHAR($resource->col_ini,'YYYY-MM-DD HH24:MI') != :DT_INI_VAL ";
            }
        }

        # cruzamentos
        /*
                REGISTO:        X------------------------X
                        *-----------------*                                         (1)
                                        *----------------------------*              (2)
                       *-------------------------------------------------*		(3)
                                    *----------*                                    (4)
        */
        $query .= " AND (".     ## CASO 1
                  " (:DT_INI_VAL <= TO_CHAR($resource->col_ini,'YYYY-MM-DD HH24:MI') AND ".
                  "  :DT_FIM_VAL BETWEEN TO_CHAR($resource->col_ini,'YYYY-MM-DD HH24:MI') AND NVL(TO_CHAR($resource->col_fim,'YYYY-MM-DD HH24:MI'),'2999-01-01 00:00') ".
                  " ) OR ".     ## CASO 2
                  " (:DT_INI_VAL BETWEEN TO_CHAR($resource->col_ini,'YYYY-MM-DD HH24:MI') AND NVL(TO_CHAR($resource->col_fim,'YYYY-MM-DD HH24:MI'),'2999-01-01 00:00') AND ".
                  "  :DT_FIM_VAL >= NVL(TO_CHAR($resource->col_fim,'YYYY-MM-DD HH24:MI'),'2999-01-01 00:00') ".
                  " ) OR ".     ## CASO 3
                  " (:DT_INI_VAL <= TO_CHAR($resource->col_ini,'YYYY-MM-DD HH24:MI') AND  ".
                  "  :DT_FIM_VAL >= NVL(TO_CHAR($resource->col_fim,'YYYY-MM-DD HH24:MI'),'2999-01-01 00:00') ".
                  " ) OR ".     ## CASO 4
                  " (:DT_INI_VAL >= TO_CHAR($resource->col_ini,'YYYY-MM-DD HH24:MI') AND ".
                  "  :DT_FIM_VAL <= NVL(TO_CHAR($resource->col_fim,'YYYY-MM-DD HH24:MI'),'2999-01-01 00:00') ".
                  " ) ".
                  ") ";

/*        
$out = $query;
$out = str_replace(':EMPRESA_', "'".$resource->empresa."'",$out);
$out = str_replace(':RHID_', $resource->rhid,$out);
$out = str_replace(':DT_ADM_', "'".$resource->dt_adm."'",$out);
$out = str_replace(':DT_INI_VAL', "'".$dt_ini_."'",$out);
$out = str_replace(':DT_FIM_VAL', "'".$dt_fim_."'",$out);
echo $out;
*/
        try {
            $stmt = $db->prepare($query);
            $stmt->bindParam(':EMPRESA_', $resource->empresa, PDO::PARAM_STR);
            $stmt->bindParam(':RHID_', $resource->rhid, PDO::PARAM_STR);
            $stmt->bindParam(':DT_ADM_', $resource->dt_adm, PDO::PARAM_STR);

            
            # esta exceção visa prever a atualização de um registo de tenha sido inserido com hora 
            # e que passa a ser controlado por dia ou o inverso
            if ($resource->tabela == 'RH_ID_FERIAS') {
                $dt = substr($dt_ini_,0,10);
                $stmt->bindParam(':DT_INI_VAL', $dt, PDO::PARAM_STR);
            }
            else {
                $stmt->bindParam(':DT_INI_VAL', $dt_ini_, PDO::PARAM_STR);
            }
            $stmt->bindParam(':DT_FIM_VAL', $dt_fim_, PDO::PARAM_STR);

            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $ex) {
                $msg = "valida_cruzamentos #2[$resource->empresa,$resource->rhid,$resource->dt_adm,$resource->tabela]: " . $ex->getMessage();
        }

        if ($msg == '') {
            if (count($result) > 0) {
                foreach($result as $row) {
                    $txt = $row['DT_INI'];
                    if ($row['DT_FIM']) {
                        $txt .= ' ~ ' . $row['DT_FIM'];                        
                    }
                    $msg = str_replace('{0}' , $txt, $msg_time_overlap);
                    break;
                }
            }
        }
    }
    
    // Fase 3: valida cruzamento de registo detetando sobreposições na respetiva tabela de registos em workflow
    if ($msg == '' && $resource->tabela != 'RH_ID_ENT_INTERNAS') {
        $query = "SELECT TO_CHAR($resource->col_ini,'YYYY-MM-DD HH24:MI') DT_INI, TO_CHAR($resource->col_fim,'YYYY-MM-DD HH24:MI') DT_FIM ".
                 "FROM ".$resource->tabela."_WKF ".
                 "WHERE EMPRESA = :EMPRESA_ ".
                 "  AND RHID = :RHID_ ".
                 "  AND TO_CHAR(DT_ADMISSAO,'YYYY-MM-DD') = :DT_ADM_ ".
                "   AND FINISHED = 'N' ".
                "   AND REJECTED = 'N' ".
                "   AND OPERACAO IN ('INSERT','UPDATE','DELETE') ";

        if ($resource->cond_adicional != '') {
            $query .= $resource->cond_adicional;
        }

        
        $query.= "  AND TO_CHAR($resource->col_ini,'YYYY-MM-DD HH24:MI') != :DT_FIM_VAL ".
                 "  AND NVL(TO_CHAR($resource->col_fim,'YYYY-MM-DD HH24:MI'),'2999-01-01 00:00') != :DT_INI_VAL ";
        
        # excluir o próprio registo
        if ($resource->acao == 'UPDATE') {

            # esta exceção visa prever a atualização de um registo de tenha sido inserido com hora 
            # e que passa a ser controlado por dia ou o inverso
            if ($resource->tabela == 'RH_ID_FERIAS') {
                $query .= "  AND TO_CHAR($resource->col_ini,'YYYY-MM-DD') != :DT_INI_VAL ";
            }
            else {
                $query .= "  AND TO_CHAR($resource->col_ini,'YYYY-MM-DD HH24:MI') != :DT_INI_VAL ";
            }
        }

        # cruzamentos
        /*
                REGISTO:        X------------------------X
                        *-----------------*                                         (1)
                                        *----------------------------*              (2)
                       *-------------------------------------------------*		(3)
                                    *----------*                                    (4)
        */
        $query .= " AND (".     ## CASO 1
                  " (:DT_INI_VAL <= TO_CHAR($resource->col_ini,'YYYY-MM-DD HH24:MI') AND ".
                  "  :DT_FIM_VAL BETWEEN TO_CHAR($resource->col_ini,'YYYY-MM-DD HH24:MI') AND NVL(TO_CHAR($resource->col_fim,'YYYY-MM-DD HH24:MI'),'2999-01-01 00:00') ".
                  " ) OR ".     ## CASO 2
                  " (:DT_INI_VAL BETWEEN TO_CHAR($resource->col_ini,'YYYY-MM-DD HH24:MI') AND NVL(TO_CHAR($resource->col_fim,'YYYY-MM-DD HH24:MI'),'2999-01-01 00:00') AND ".
                  "  :DT_FIM_VAL >= NVL(TO_CHAR($resource->col_fim,'YYYY-MM-DD HH24:MI'),'2999-01-01 00:00') ".
                  " ) OR ".     ## CASO 3
                  " (:DT_INI_VAL <= TO_CHAR($resource->col_ini,'YYYY-MM-DD HH24:MI') AND  ".
                  "  :DT_FIM_VAL >= NVL(TO_CHAR($resource->col_fim,'YYYY-MM-DD HH24:MI'),'2999-01-01 00:00') ".
                  " ) OR ".     ## CASO 4
                  " (:DT_INI_VAL >= TO_CHAR($resource->col_ini,'YYYY-MM-DD HH24:MI') AND ".
                  "  :DT_FIM_VAL <= NVL(TO_CHAR($resource->col_fim,'YYYY-MM-DD HH24:MI'),'2999-01-01 00:00') ".
                  " ) ".
                  ") ";

/*        
$out = $query;
$out = str_replace(':EMPRESA_', "'".$resource->empresa."'",$out);
$out = str_replace(':RHID_', $resource->rhid,$out);
$out = str_replace(':DT_ADM_', "'".$resource->dt_adm."'",$out);
$out = str_replace(':DT_INI_VAL', "'".$dt_ini_."'",$out);
$out = str_replace(':DT_FIM_VAL', "'".$dt_fim_."'",$out);
echo $out;
*/
        try {
            $stmt = $db->prepare($query);
            $stmt->bindParam(':EMPRESA_', $resource->empresa, PDO::PARAM_STR);
            $stmt->bindParam(':RHID_', $resource->rhid, PDO::PARAM_STR);
            $stmt->bindParam(':DT_ADM_', $resource->dt_adm, PDO::PARAM_STR);

            
            # esta exceção visa prever a atualização de um registo de tenha sido inserido com hora 
            # e que passa a ser controlado por dia ou o inverso
            if ($resource->tabela == 'RH_ID_FERIAS') {
                $dt = substr($dt_ini_,0,10);
                $stmt->bindParam(':DT_INI_VAL', $dt, PDO::PARAM_STR);
            }
            else {
                $stmt->bindParam(':DT_INI_VAL', $dt_ini_, PDO::PARAM_STR);
            }
            $stmt->bindParam(':DT_FIM_VAL', $dt_fim_, PDO::PARAM_STR);

            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $ex) {
                $msg = "valida_cruzamentos #3[$resource->empresa,$resource->rhid,$resource->dt_adm,$resource->tabela]: " . $ex->getMessage();
        }

        if ($msg == '') {
            if (count($result) > 0) {
                foreach($result as $row) {
                    $txt = $row['DT_INI'];
                    if ($row['DT_FIM']) {
                        $txt .= ' ~ ' . $row['DT_FIM'];                        
                    }
                    $msg = str_replace('{0}' , $txt, $msg_time_overlap_wkf);
                    break;
                }
            }
        }
    }
    
    return $msg;
}


/*
 * Valida cruzamento de registos entre tabelas onde não são admitidos cruzamentos de datas
 * 
    resource = {
        empresa: "DEMO",
        rhid: "355",
        dt_adm: "2019-03-01",
        dt_ini: "2019-01-01 12:23",
        dt_fim: "2019-01-01 17:11",
        tabela: "RH_ID_AUSENCIAS"
    }
 * 
 *  Estes são os dados da operação original.
 */
function valida_colisoes_entre_tabelas($resource, &$msg) {
    global $db;

    function colisao($db, $dados, &$msg_) {
        
        global $msg_time_table_overlap, $msg_time_table_overlap_wkf, 
               $ui_absences, $ui_adaptability, $ui_overtime_work, $ui_vacation, $ui_compensatory_rest;
        
        $res = array();

        # fase 1: valida com tabela de registos efetivos
        if (1) {
            $qry = "SELECT TO_CHAR($dados->col_ini,'YYYY-MM-DD HH24:MI') DT_INI, TO_CHAR($dados->col_fim,'YYYY-MM-DD HH24:MI') DT_FIM ".
                   "FROM $dados->tabela ".
                   "WHERE EMPRESA = :EMPRESA_ ".
                   "  AND RHID = :RHID_ ".
                   "  AND TO_CHAR(DT_ADMISSAO,'YYYY-MM-DD') = :DT_ADM_ ";

            if ($dados->cond_adicional != '') {
                $qry .= $dados->cond_adicional;
            }

            # cruzamentos
            /*
                    REGISTO:        X------------------------X
                            *-----------------*                                         (1)
                                            *----------------------------*              (2)
                           *-------------------------------------------------*		(3)
                                        *----------*                                    (4)
            */
            $qry .=   " AND (".     ## CASO 1
                      " (:DT_INI_VAL <= TO_CHAR($dados->col_ini,'YYYY-MM-DD HH24:MI') AND ".
                      "  :DT_FIM_VAL BETWEEN TO_CHAR($dados->col_ini,'YYYY-MM-DD HH24:MI') AND NVL(TO_CHAR($dados->col_fim,'YYYY-MM-DD HH24:MI'),'2999-01-01 00:00') ".
                      " ) OR ".     ## CASO 2
                      " (:DT_INI_VAL BETWEEN TO_CHAR($dados->col_ini,'YYYY-MM-DD HH24:MI') AND NVL(TO_CHAR($dados->col_fim,'YYYY-MM-DD HH24:MI'),'2999-01-01 00:00') AND ".
                      "  :DT_FIM_VAL >= NVL(TO_CHAR($dados->col_fim,'YYYY-MM-DD HH24:MI'),'2999-01-01 00:00') ".
                      " ) OR ".     ## CASO 3
                      " (:DT_INI_VAL <= TO_CHAR($dados->col_ini,'YYYY-MM-DD HH24:MI') AND  ".
                      "  :DT_FIM_VAL >= NVL(TO_CHAR($dados->col_fim,'YYYY-MM-DD HH24:MI'),'2999-01-01 00:00') ".
                      " ) OR ".     ## CASO 4
                      " (:DT_INI_VAL >= TO_CHAR($dados->col_ini,'YYYY-MM-DD HH24:MI') AND ".
                      "  :DT_FIM_VAL <= NVL(TO_CHAR($dados->col_fim,'YYYY-MM-DD HH24:MI'),'2999-01-01 00:00') ".
                      " ) ".
                      ") ";

    /*
    $out = $qry;
    $out = str_replace(':EMPRESA_', "'".$dados->empresa."'",$out);
    $out = str_replace(':RHID_', $dados->rhid,$out);
    $out = str_replace(':DT_ADM_', "'".$dados->dt_adm."'",$out);
    $out = str_replace(':DT_INI_VAL', "'".$dados->dt_ini."'",$out);
    $out = str_replace(':DT_FIM_VAL', "'".$dados->dt_fim."'",$out);
    echo $qry."<br/>";
    */
            try {
                $stmt = $db->prepare($qry);
                $stmt->bindParam(':EMPRESA_', $dados->empresa, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_', $dados->rhid, PDO::PARAM_STR);
                $stmt->bindParam(':DT_ADM_', $dados->dt_adm, PDO::PARAM_STR);

                $stmt->bindParam(':DT_INI_VAL', $dados->dt_ini, PDO::PARAM_STR);
                $stmt->bindParam(':DT_FIM_VAL', $dados->dt_fim, PDO::PARAM_STR);

                $stmt->execute();
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                    $msg_ = "colisao #2[$dados->empresa,$dados->rhid,$dados->dt_adm,$dados->tabela]: " . $ex->getMessage();
            }
            if ($msg_ == '') {
                if (count($res) > 0) {
                    foreach($res as $row) {
                        $txt = $row['DT_INI'];
                        if ($row['DT_FIM']) {
                            $txt .= ' ~ ' . $row['DT_FIM'];                        
                        }
                        $msg_ = $msg_time_table_overlap;

                        if ($dados->tabela == 'RH_ID_AUSENCIAS') {
                            $msg_ = str_replace('{0}' , $ui_absences, $msg_);
                        }
                        elseif ($dados->tabela == 'RH_ID_FERIAS') {
                            $msg_ = str_replace('{0}' , $ui_vacation, $msg_);
                        }
                        elseif ($dados->tabela == 'RH_ID_DET_ADAPTABILIDADES') {
                            $msg_ = str_replace('{0}' , $ui_adaptability, $msg_);
                        }
                        elseif ($dados->tabela == 'RH_ID_TS_HV') {
                            $msg_ = str_replace('{0}' , $ui_overtime_work, $msg_);
                        }
                        elseif ($dados->tabela == 'RH_ID_DC_DEBITOS') {
                            $msg_ = str_replace('{0}' , $ui_compensatory_rest, $msg_);
                        }

                        $msg_ = str_replace('{1}' , $txt, $msg_);
                        break;
                    }
                }
            }
            
        }
     
        
        # fase 2: valida com tabela de registos em workflow
        if ($msg_ == '') {
            
            $qry = "SELECT TO_CHAR($dados->col_ini,'YYYY-MM-DD HH24:MI') DT_INI, TO_CHAR($dados->col_fim,'YYYY-MM-DD HH24:MI') DT_FIM ".
                   "FROM ".$dados->tabela."_WKF ".
                   "WHERE EMPRESA = :EMPRESA_ ".
                   "  AND RHID = :RHID_ ".
                   "  AND TO_CHAR(DT_ADMISSAO,'YYYY-MM-DD') = :DT_ADM_ ".
                   "  AND OPERACAO IN ('INSERT','UPDATE','DELETE') ".
                   "  AND FINISHED = 'N' ".
                   "  AND REJECTED = 'N' ";

            if ($dados->cond_adicional != '') {
                $qry .= $dados->cond_adicional;
            }

            # cruzamentos
            /*
                    REGISTO:        X------------------------X
                            *-----------------*                                         (1)
                                            *----------------------------*              (2)
                           *-------------------------------------------------*		(3)
                                        *----------*                                    (4)
            */
            $qry .=   " AND (".     ## CASO 1
                      " (:DT_INI_VAL <= TO_CHAR($dados->col_ini,'YYYY-MM-DD HH24:MI') AND ".
                      "  :DT_FIM_VAL BETWEEN TO_CHAR($dados->col_ini,'YYYY-MM-DD HH24:MI') AND NVL(TO_CHAR($dados->col_fim,'YYYY-MM-DD HH24:MI'),'2999-01-01 00:00') ".
                      " ) OR ".     ## CASO 2
                      " (:DT_INI_VAL BETWEEN TO_CHAR($dados->col_ini,'YYYY-MM-DD HH24:MI') AND NVL(TO_CHAR($dados->col_fim,'YYYY-MM-DD HH24:MI'),'2999-01-01 00:00') AND ".
                      "  :DT_FIM_VAL >= NVL(TO_CHAR($dados->col_fim,'YYYY-MM-DD HH24:MI'),'2999-01-01 00:00') ".
                      " ) OR ".     ## CASO 3
                      " (:DT_INI_VAL <= TO_CHAR($dados->col_ini,'YYYY-MM-DD HH24:MI') AND  ".
                      "  :DT_FIM_VAL >= NVL(TO_CHAR($dados->col_fim,'YYYY-MM-DD HH24:MI'),'2999-01-01 00:00') ".
                      " ) OR ".     ## CASO 4
                      " (:DT_INI_VAL >= TO_CHAR($dados->col_ini,'YYYY-MM-DD HH24:MI') AND ".
                      "  :DT_FIM_VAL <= NVL(TO_CHAR($dados->col_fim,'YYYY-MM-DD HH24:MI'),'2999-01-01 00:00') ".
                      " ) ".
                      ") ";

    /*
    $out = $qry;
    $out = str_replace(':EMPRESA_', "'".$dados->empresa."'",$out);
    $out = str_replace(':RHID_', $dados->rhid,$out);
    $out = str_replace(':DT_ADM_', "'".$dados->dt_adm."'",$out);
    $out = str_replace(':DT_INI_VAL', "'".$dados->dt_ini."'",$out);
    $out = str_replace(':DT_FIM_VAL', "'".$dados->dt_fim."'",$out);
    echo $qry."<br/>";
    */
            try {
                $stmt = $db->prepare($qry);
                $stmt->bindParam(':EMPRESA_', $dados->empresa, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_', $dados->rhid, PDO::PARAM_STR);
                $stmt->bindParam(':DT_ADM_', $dados->dt_adm, PDO::PARAM_STR);

                $stmt->bindParam(':DT_INI_VAL', $dados->dt_ini, PDO::PARAM_STR);
                $stmt->bindParam(':DT_FIM_VAL', $dados->dt_fim, PDO::PARAM_STR);

                $stmt->execute();
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                    $msg_ = "colisao #2[$dados->empresa,$dados->rhid,$dados->dt_adm,$dados->tabela]: " . $ex->getMessage();
            }
            if ($msg_ == '') {
                if (count($res) > 0) {
                    foreach($res as $row) {
                        $txt = $row['DT_INI'];
                        if ($row['DT_FIM']) {
                            $txt .= ' ~ ' . $row['DT_FIM'];                        
                        }
                        $msg_ = $msg_time_table_overlap_wkf;

                        if ($dados->tabela == 'RH_ID_AUSENCIAS') {
                            $msg_ = str_replace('{0}' , $ui_absences, $msg_);
                        }
                        elseif ($dados->tabela == 'RH_ID_FERIAS') {
                            $msg_ = str_replace('{0}' , $ui_vacation, $msg_);
                        }
                        elseif ($dados->tabela == 'RH_ID_DET_ADAPTABILIDADES') {
                            $msg_ = str_replace('{0}' , $ui_adaptability, $msg_);
                        }
                        elseif ($dados->tabela == 'RH_ID_TS_HV') {
                            $msg_ = str_replace('{0}' , $ui_overtime_work, $msg_);
                        }
                        elseif ($dados->tabela == 'RH_ID_DC_DEBITOS') {
                            $msg_ = str_replace('{0}' , $ui_compensatory_rest, $msg_);
                        }

                        $msg_ = str_replace('{1}' , $txt, $msg_);
                        break;
                    }
                }
            }
            
        }
    }
        
    $msg = '';
    $dt_ini_ = $resource->dt_ini;
    $dt_fim_ = $resource->dt_fim;

    if ($dt_fim_ === '') {
        $dt_fim_ = '2999-01-01 00:00';
    }
    
    /*
                                        AUS	FER         ADAP        TS          DC
        AUSENCIAS (PREVISTAS/EFETIVAS)	 	SIM         SIM DEB                 SIM
        FERIAS                          SIM	            SIM DEB                 SIM
        ADAPTABILIDADE (+/-)            SIM DEB	SIM DEB                 SIM CRED    SIM DEB
        TRAB SUPLEMENTAR                                    SIM CRED     	
        DESCANSO COMPENSATORIO          SIM	SIM         SIM DEB                  

        Mapeamento de validações entre tabelas e respetivas condições de restrição 
    */
    $modulos = array();
    if ($resource->tabela == 'RH_ID_AUSENCIAS') {
        $modulos = array('FER','ADAPT_DEB','DC');
    }   
    elseif ($resource->tabela == 'RH_ID_FERIAS') {
        $modulos = array('AUS','ADAPT_DEB','DC');
    }   
    elseif ($resource->tabela == 'RH_ID_DET_ADAPTABILIDADES') {
        if ($resource->tp_ocorrencia == 'HD' || $resource->tp_ocorrencia == 'FD') {
            $modulos = array('AUS','FER','DC');
        } elseif ($resource->tp_ocorrencia == 'HC' || $resource->tp_ocorrencia == 'FC') {
            $modulos = array('TS');
        }
    }
    elseif ($resource->tabela == 'RH_ID_TS_HV') {
        $modulos = array('ADAPT_CRED');
    }
    elseif ($resource->tabela == 'RH_ID_DC_DEBITOS') {
        $modulos = array('AUS','FER','ADAPT_DEB');
    }
    
    ## valida...
    foreach ($modulos as $modulo) {
        
        # validar com RH_ID_AUSENCIAS
        if ($msg == '' && $modulo == 'AUS') {
            $resource1 = new stdClass();
            $resource1->tabela = "RH_ID_AUSENCIAS";
            $resource1->col_ini = "DT_INI";
            $resource1->col_fim = "DT_FIM";
            $resource1->empresa = $resource->empresa;
            $resource1->rhid = $resource->rhid;
            $resource1->dt_adm = $resource->dt_adm;

            $resource1->dt_ini = $dt_ini_;
            $resource1->dt_fim = $dt_fim_;
            $resource1->cond_adicional = "";
            colisao($db, $resource1, $msg);
        }

        # validar com RH_ID_FERIAS
        if ($msg == '' && $modulo == 'FER') {
            $resource1 = new stdClass();
            $resource1->tabela = "RH_ID_FERIAS";
            $resource1->col_ini = "DT_INI";
            $resource1->col_fim = "DT_FIM";
            $resource1->empresa = $resource->empresa;
            $resource1->rhid = $resource->rhid;
            $resource1->dt_adm = $resource->dt_adm;

            $resource1->dt_ini = $dt_ini_;
            $resource1->dt_fim = $dt_fim_;
            $resource1->cond_adicional = "";
            colisao($db, $resource1, $msg);
        }

        # validar com DÉBITOS DE RH_ID_DET_ADAPTABILIDADES
        if ($msg == '' && $modulo == 'ADAPT_DEB') {
            $resource1 = new stdClass();
            $resource1->tabela = "RH_ID_DET_ADAPTABILIDADES";
            $resource1->col_ini = "DT_INI_DET";
            $resource1->col_fim = "DT_FIM_DET";
            $resource1->empresa = $resource->empresa;
            $resource1->rhid = $resource->rhid;
            $resource1->dt_adm = $resource->dt_adm;

            $resource1->dt_ini = $dt_ini_;
            $resource1->dt_fim = $dt_fim_;
            $resource1->cond_adicional = " AND TP_OCORRENCIA IN ('HD','FD') ";
            colisao($db, $resource1, $msg);
        }

        # validar com RH_ID_DC_DEBITOS
        if ($msg == '' && $modulo == 'DC') {
            $resource1 = new stdClass();
            $resource1->tabela = "RH_ID_DC_DEBITOS";
            $resource1->col_ini = "GOZOU_DE";
            $resource1->col_fim = "GOZOU_A";
            $resource1->empresa = $resource->empresa;
            $resource1->rhid = $resource->rhid;
            $resource1->dt_adm = $resource->dt_adm;

            $resource1->dt_ini = $dt_ini_;
            $resource1->dt_fim = $dt_fim_;
            $resource1->cond_adicional = "";
            colisao($db, $resource1, $msg);
        }

        # validar com CRÉDITOS DE RH_ID_DET_ADAPTABILIDADES
        if ($msg == '' && $modulo == 'ADAPT_CRED') {
            $resource1 = new stdClass();
            $resource1->tabela = "RH_ID_DET_ADAPTABILIDADES";
            $resource1->col_ini = "DT_INI_DET";
            $resource1->col_fim = "DT_FIM_DET";
            $resource1->empresa = $resource->empresa;
            $resource1->rhid = $resource->rhid;
            $resource1->dt_adm = $resource->dt_adm;

            $resource1->dt_ini = $dt_ini_;
            $resource1->dt_fim = $dt_fim_;
            $resource1->cond_adicional = " AND TP_OCORRENCIA IN ('HC','FC') ";
            colisao($db, $resource1, $msg);
        }

        # validar com RH_ID_TS_HV
        if ($msg == '' && $modulo == 'TS') {
            $resource1 = new stdClass();
            $resource1->tabela = "RH_ID_TS_HV";
            $resource1->col_ini = "DT_INI";
            $resource1->col_fim = "DT_FIM";
            $resource1->empresa = $resource->empresa;
            $resource1->rhid = $resource->rhid;
            $resource1->dt_adm = $resource->dt_adm;

            $resource1->dt_ini = $dt_ini_;
            $resource1->dt_fim = $dt_fim_;
            $resource1->cond_adicional = "";
            colisao($db, $resource1, $msg);
        }

        if ($msg != ''){
            break;
        }
    }

    return $msg;
}


/*
 * Validações específicas de férias
 * 
     resource = {
        empresa: "DEMO",
        rhid: "355",
        dt_adm: "2019-03-01",
        dt_ini: "2019-01-01 12:23",
        dt_fim: "2019-01-01 17:11",
    }
 * 
 */
function valida_ferias($resource, &$msg) {
    global $db, $error_max_vacation_exceeded, $error_max_balance_vacation_exceeded;
  
    $msg = '';
    if ($resource->empresa != '' && $resource->rhid != '' && $resource->dt_adm != '' && $resource->ano != '') {
        /* 
         * $result:
            'CRED_ACRESCIMO' => string '3' (length=1)
            'CRED_ANO' => string '22' (length=2)
            'CRED_ANO_ANTERIOR' => string '3' (length=1)
            'DIAS_PAGOS' => string '6' (length=1)
              'TOT_DIAS' => string '3' (length=1)
              'TOT_WKF' => string '1' (length=1)
         */
        $result = getRhidFerias ($resource, $msg);
        
        $saldo = 0;
        $saldo_disp = 0;
        if (isset($result)) {
            $saldo_disp = $result['CRED_ACRESCIMO'] + $result['CRED_ANO'] + $result['CRED_ANO_ANTERIOR'] - 
                          $result['TOT_DIAS'] - $result['TOT_WKF'];
            $saldo = $saldo_disp - $resource->dias_uteis;
        }
        
        if ($resource->ferias_neg == 'N' && $saldo < 0) {
            $msg = $error_max_vacation_exceeded;
            $msg = str_replace("{0}", $resource->dias_uteis, $msg);
            $msg = str_replace("{1}", $saldo_disp, $msg);
        } 
        elseif ($resource->ferias_neg == 'S') {
            if ($resource->limite_ferias_neg != '' && $saldo < $resource->limite_ferias_neg) {
                $msg = $error_max_balance_vacation_exceeded;
                $msg = str_replace("{0}", $resource->dias_uteis, $msg);
                $msg = str_replace("{1}", ($saldo_disp - $resource->limite_ferias_neg), $msg);
            }
        }
#$msg = "duts:$resource->dias_uteis saldo:$saldo marcados def:".$result['TOT_DIAS']." + WKF:".$result['TOT_WKF'];
#        $msg = "ferias_neg:$resource->ferias_neg  --  limite:$resource->limite_ferias_neg";
   }
#    $msg = "STOP[$msg]";
}


/*
 * Validações específicas de trabalho suplementar
 * 
     resource = {
        empresa: "DEMO",
        rhid: "355",
        dt_adm: "2019-03-01",
        dt_ini: "2019-01-01 12:23",
        dt_fim: "2019-01-01 17:11",
    }
 * 
 */
function valida_ts($resource, &$msg) {
    global $db, $error_24_hours_excedded, $error_invalid_time_cross;
  
    $msg = '';
    if ($resource->empresa != '' && $resource->rhid != '' && $resource->dt_adm != '') {

        # valida duração do registo > 24 horas
        $minutes = minutesBetweenDates($resource->dt_ini, $resource->dt_fim);
        if ($minutes > (24 * 60) ) {
            $msg = $error_24_hours_excedded;
        }
        #$msg .= " --> minutos ($resource->dt_ini-$resource->dt_fim):".$minutes;
        
        # valida períodos interditos
        if ($msg == '') {
            $minutes = get_min_trab_esp($resource->empresa, $resource->rhid, $resource->dt_adm, $resource->dt_ini, $resource->dt_fim, $msg);
            if ($minutes > 0 ) {
                $msg = $error_invalid_time_cross;
            }
        }
    }
    #$msg = "STOP[$msg]";
}


/*
 * Validações específicas de descanso compensatório
 * 
     resource = {
        empresa: "DEMO",
        rhid: "355",
        dt_adm: "2019-03-01",
        dt_ini: "2019-01-01 12:23",
        dt_fim: "2019-01-01 17:11",
    }
 * 
 */
function valida_dc($resource, &$msg) {
    global $db, $error_max_balance_minutes_exceeded;
  
    $msg = '';
    if ($resource->empresa != '' && $resource->rhid != '' && $resource->dt_adm != '') {
        /* 
         * $result:
                'CREDITOS' => string '480' (length=3)
                'DEBITOS_APROVADOS' => string '0' (length=1)
                'DEBITOS_WORKFLOW' => string '0' (length=1)
         */
        $result = getRhidDC ($resource, $msg);

        $saldo = 0;
        $saldo_disp = 0;
        if (isset($result)) {
            $saldo_disp = $result['CREDITOS'] - 
                          $result['DEBITOS_APROVADOS'] - $result['DEBITOS_WORKFLOW'];
            $saldo = $saldo_disp - $resource->qtd_usada;
        }
        #$msg = "saldo:$saldo -- qtd:$resource->qtd_usada [neg:$resource->dc_neg limite:$resource->limite_dc_neg]";        

        if ($resource->dc_neg == 'N' && $saldo < 0) {
            $msg = $error_max_balance_minutes_exceeded;
            $msg = str_replace("{0}", $resource->qtd_usada, $msg);
            $msg = str_replace("{1}", $saldo_disp, $msg);
        } 
        elseif ($resource->dc_neg == 'S') {
            if ($resource->limite_dc_neg != '' && $saldo < $resource->limite_dc_neg) {
                $msg = $error_max_balance_minutes_exceeded;
                $msg = str_replace("{0}", $resource->qtd_usada, $msg);
                $msg = str_replace("{1}", ($saldo_disp - $resource->limite_dc_neg), $msg);
            }
        } 
   }
   #$msg = "STOP[$msg]";
}

/*
 * Validações específicas de adaptabilidade
 * 
     resource = {
        empresa: "DEMO",
        rhid: "355",
        dt_adm: "2019-03-01",
        dt_ini: "2019-01-01 12:23",
        dt_fim: "2019-01-01 17:11",
    }
 * 
 */
function valida_adap($resource, &$msg) {
    global $db, $error_invalid_time_cross, $error_max_balance_minutes_exceeded,
           $msg_record_over_limit, $ui_frequence_day, $ui_frequence_week, $ui_frequence_month, $ui_frequence_year;

    $db = $db;
    $msg = '';
    if ($resource->empresa != '' && $resource->rhid != '' && $resource->dt_adm != '') {
        
        # valida períodos interditos - para registos de créditos 
        if ($msg == '' && 
            ($resource->tp_ocorrencia == 'A' || 
             $resource->tp_ocorrencia == 'FC' || 
             $resource->tp_ocorrencia == 'HC')
            ){
            $minutes = get_min_trab_esp($resource->empresa, $resource->rhid, $resource->dt_adm, $resource->dt_ini, $resource->dt_fim, $msg);
            if ($minutes > 0 ) {
                $msg = $error_invalid_time_cross;
            }
        }        
        
        # valida saldos disponíveis
        if ($msg == '') {
            /* 
             * $result:
                'APROVADO_CRED' => string '0' (length=1)
                'WORKFLOW_CRED' => string '0' (length=1)
                'APROVADO_DEB' => string '0' (length=1)
                'WORKFLOW_DEB' => string '0' (length=1)
             */
            $result = getRhidAdaptabilidades ($resource, $msg);
            $saldo = 0;
            $saldo_disp = 0;
            if (isset($result)) {
                $saldo_disp = $result['APROVADO_CRED'] + $result['WORKFLOW_CRED'] - 
                              $result['APROVADO_DEB'] - $result['WORKFLOW_DEB'];
                
                # créditos
                if ($resource->tp_ocorrencia == 'A' || $resource->tp_ocorrencia == 'FC' || $resource->tp_ocorrencia == 'HC') {
                    $saldo = $saldo_disp + $resource->duracao_minutos;
                } #débitos
                else {
                    $saldo = $saldo_disp - $resource->duracao_minutos;
                }
            }
            # $msg = "saldo:$saldo -- qtd:$resource->duracao_minutos [neg:$resource->adap_neg limite:$resource->limite_adap_neg]";        

            if ($resource->adap_neg == 'N' && $saldo < 0) {
                $msg = $error_max_balance_minutes_exceeded;
                $msg = str_replace("{0}", $resource->duracao_minutos, $msg);
                $msg = str_replace("{1}", $saldo_disp, $msg);
            } 
            elseif ($resource->adap_neg == 'S') {
                if ($resource->limite_adap_neg != '' && $saldo < $resource->limite_adaç_neg) {
                    $msg = $error_max_balance_minutes_exceeded;
                    $msg = str_replace("{0}", $resource->duracao_minutos, $msg);
                    $msg = str_replace("{1}", ($saldo_disp - $resource->limite_adap_neg), $msg);
                }
            } 
        } 
        
        # valida com parametrização
        if ($msg == '') {
            $regra_adap = get_param_adap($resource->empresa, $resource->rhid, $resource->dt_adm, $msg);
            #var_dump($regra_adap);
            /*
              validações associadas ao parâmetro
                'LIM_PLUS_DIA' => null
                'LIM_PLUS_SEM' => null
                'LIM_PLUS_MES' => null
                'LIM_PLUS_ANO' => null
                'LIM_MINUS_DIA' => null
                'LIM_MINUS_SEM' => null
                'LIM_MINUS_MES' => null
                'LIM_MINUS_ANO' => null            
             */

            if ($msg == '' && count($regra_adap) > 0) {

                # statment base para contabilização
                $sql_ref =  "SELECT SUM((CASE WHEN A.TP_OCORRENCIA IN ('HC','FC','A') THEN A.DURACAO_MINUTOS ELSE 0 END)) + ".
                            "       SUM((CASE WHEN B.TP_OCORRENCIA IN ('HC','FC','A') THEN B.DURACAO_MINUTOS ELSE 0 END)) CREDITOS, ".
                            "       SUM((CASE WHEN A.TP_OCORRENCIA IN ('HD','FD','R1','R2') THEN A.DURACAO_MINUTOS ELSE 0 END)) + ".
                            "       SUM((CASE WHEN B.TP_OCORRENCIA IN ('HD','FD','R1','R2') THEN B.DURACAO_MINUTOS ELSE 0 END)) DEBITOS ".
                            "FROM RH_ID_EMPRESAS E ".
                            "  LEFT JOIN RH_ID_DET_ADAPTABILIDADES A ON A.EMPRESA = E.EMPRESA AND A.RHID = E.RHID AND A.DT_ADMISSAO = E.DT_ADMISSAO %%CONDICAO_TEMPO%% ".
                            "  LEFT JOIN RH_ID_DET_ADAPTABILIDADES_WKF B ON B.EMPRESA = E.EMPRESA AND B.RHID = E.RHID AND B.DT_ADMISSAO = E.DT_ADMISSAO AND B.REJECTED = 'N' AND B.FINISHED = 'N' AND B.OPERACAO = 'INSERT' %%CONDICAO_TEMPO%% ".
                            "WHERE E.EMPRESA = :EMPRESA ".
                            "  AND E.RHID = :RHID ".
                            "  AND A.DT_ADMISSAO = TO_DATE(:DT_ADM, 'YYYY-MM-DD') ";
                
                if (($regra_adap['LIM_PLUS_DIA'] != '' || $regra_adap['LIM_MINUS_DIA'] != '') || 
                    ($regra_adap['LIM_PLUS_SEM'] != '' || $regra_adap['LIM_MINUS_SEM'] != '') ||
                    ($regra_adap['LIM_PLUS_MES'] != '' || $regra_adap['LIM_MINUS_MES'] != '') ||
                    ($regra_adap['LIM_PLUS_ANO'] != '' || $regra_adap['LIM_MINUS_ANO'] != '') 
                    ) {

                    # validação associada ao dia
                    if (($regra_adap['LIM_PLUS_DIA'] != '' || $regra_adap['LIM_MINUS_DIA'] != '') && $msg == '') {

                        if (isset($resource->acao) && isset($resource->dt_ini) && $resource->acao == 'UPDATE') {
                            $sql = str_replace("%%CONDICAO_TEMPO%%", " AND DATE_FORMAT(A.DT_INI_DET,'%Y-%m-%d') = DATE_FORMAT(:DT_INI,'%Y-%m-%d') AND DATE_FORMAT(A.DT_INI_DET,'%Y-%m-%d %H:%i') != :DT_INI ", $sql_ref);
                        }
                        else {
                            $sql = str_replace("%%CONDICAO_TEMPO%%", " AND DATE_FORMAT(A.DT_INI_DET,'%Y-%m-%d') = DATE_FORMAT(:DT_INI,'%Y-%m-%d') ", $sql_ref);
                        }
                        
                        try {
                            $stmt = $db->prepare($sql);
                            $stmt->bindParam(':EMPRESA', $resource->empresa, PDO::PARAM_STR);
                            $stmt->bindParam(':RHID', $resource->rhid, PDO::PARAM_STR);
                            $stmt->bindParam(':DT_ADM', $resource->dt_adm, PDO::PARAM_STR);
                            $stmt->bindParam(':DT_INI', $resource->dt_ini, PDO::PARAM_STR);
                            $stmt->execute();
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            
                            if ($resource->tp_ocorrencia == 'A'     || 
                                $resource->tp_ocorrencia == 'FC'    || 
                                $resource->tp_ocorrencia == 'HC'
                                ){
                                $total = ($row['CREDITOS'] + $resource->duracao_minutos) / 60;
                                if ($regra_adap['LIM_PLUS_DIA'] != '' && $total > $regra_adap['LIM_PLUS_DIA']) {
                                    $msg = $msg_record_over_limit;
                                    $msg = str_replace("{0}",mb_strtoupper($ui_frequence_day, 'UTF-8'), $msg);
                                    $msg = str_replace("{1}",$regra_adap['LIM_PLUS_DIA'], $msg);
                                    $msg = str_replace("{2}",($total - $regra_adap['LIM_PLUS_DIA']), $msg);
                                }
                            }
                            elseif ($resource->tp_ocorrencia == 'R1' || 
                                    $resource->tp_ocorrencia == 'R2' || 
                                    $resource->tp_ocorrencia == 'FD' || 
                                    $resource->tp_ocorrencia == 'HD'
                                ) {
                                $total = ($row['DEBITOS'] + $resource->duracao_minutos) / 60;
                                if ($regra_adap['LIM_MINUS_DIA'] != '' && $total > $regra_adap['LIM_MINUS_DIA']) {
                                    $msg = $msg_record_over_limit;
                                    $msg = str_replace("{0}",mb_strtoupper($ui_frequence_day, 'UTF-8'), $msg);
                                    $msg = str_replace("{1}",$regra_adap['LIM_PLUS_DIA'], $msg);
                                    $msg = str_replace("{2}",($total - $regra_adap['LIM_PLUS_DIA']), $msg);
                                }
                            }
                        } catch (Exception $ex) {
                            $msg = "valida_adap#LIM_PLUS_DIA/LIM_MINUS_DIA [$resource->empresa, $resource->rhid, $resource->dt_adm] -> $sql: " . $ex->getMessage();
                        }
                    }
                    
                    # validação associada à semana
                    if (($regra_adap['LIM_PLUS_SEM'] != '' || $regra_adap['LIM_MINUS_SEM'] != '') && $msg == '') {

                        if (isset($resource->acao) && isset($resource->dt_ini) && $resource->acao == 'UPDATE') {
                            $sql = str_replace("%%CONDICAO_TEMPO%%", " AND DATE_FORMAT(A.DT_INI_DET,'%Y-%v') = DATE_FORMAT(:DT_INI,'%Y-%v') AND DATE_FORMAT(A.DT_INI_DET,'%Y-%m-%d %H:%i') != :DT_INI ", $sql_ref);
                        }
                        else {
                            $sql = str_replace("%%CONDICAO_TEMPO%%", " AND DATE_FORMAT(A.DT_INI_DET,'%Y-%v') = DATE_FORMAT(:DT_INI,'%Y-%v') ", $sql_ref);
                        }

                        try {
                            $stmt = $db->prepare($sql);
                            $stmt->bindParam(':EMPRESA', $resource->empresa, PDO::PARAM_STR);
                            $stmt->bindParam(':RHID', $resource->rhid, PDO::PARAM_STR);
                            $stmt->bindParam(':DT_ADM', $resource->dt_adm, PDO::PARAM_STR);
                            $stmt->bindParam(':DT_INI', $resource->dt_ini, PDO::PARAM_STR);
                            $stmt->execute();
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            if ($resource->tp_ocorrencia == 'A'     || 
                                $resource->tp_ocorrencia == 'FC'    || 
                                $resource->tp_ocorrencia == 'HC'
                                ){
                                $total = ($row['CREDITOS'] + $resource->duracao_minutos) / 60;
                                if ($regra_adap['LIM_PLUS_SEM'] != '' && $total > $regra_adap['LIM_PLUS_SEM']) {
                                    $msg = $msg_record_over_limit;
                                    $msg = str_replace("{0}",mb_strtoupper($ui_frequence_week, 'UTF-8'), $msg);
                                    $msg = str_replace("{1}",$regra_adap['LIM_PLUS_SEM'], $msg);
                                    $msg = str_replace("{2}",($total - $regra_adap['LIM_PLUS_SEM']), $msg);
                                }
                            }
                            elseif ($resource->tp_ocorrencia == 'R1' || 
                                    $resource->tp_ocorrencia == 'R2' || 
                                    $resource->tp_ocorrencia == 'FD' || 
                                    $resource->tp_ocorrencia == 'HD'
                                ) {
                                $total = ($row['DEBITOS'] + $resource->duracao_minutos) / 60;
                                if ($regra_adap['LIM_MINUS_SEM'] != '' && $total > $regra_adap['LIM_MINUS_SEM']) {
                                    $msg = $msg_record_over_limit;
                                    $msg = str_replace("{0}",mb_strtoupper($ui_frequence_week, 'UTF-8'), $msg);
                                    $msg = str_replace("{1}",$regra_adap['LIM_MINUS_SEM'], $msg);
                                    $msg = str_replace("{2}",($total - $regra_adap['LIM_MINUS_SEM']), $msg);
                                }
                            }
                        } catch (Exception $ex) {
                            $msg = "valida_adap#LIM_PLUS_SEM/LIM_MINUS_SEM [$resource->empresa, $resource->rhid, $resource->dt_adm] -> $sql: " . $ex->getMessage();
                        }
                    }

                    # validação associada ao mês
                    if (($regra_adap['LIM_PLUS_MES'] != '' || $regra_adap['LIM_MINUS_MES'] != '') && $msg == '') {

                        if (isset($resource->acao) && isset($resource->dt_ini) && $resource->acao == 'UPDATE') {
                            $sql = str_replace("%%CONDICAO_TEMPO%%", " AND DATE_FORMAT(A.DT_INI_DET,'%Y-%m') = DATE_FORMAT(:DT_INI,'%Y-%m') AND DATE_FORMAT(A.DT_INI_DET,'%Y-%m-%d %H:%i') != :DT_INI ", $sql_ref);
                        }
                        else {
                            $sql = str_replace("%%CONDICAO_TEMPO%%", " AND DATE_FORMAT(A.DT_INI_DET,'%Y-%m') = DATE_FORMAT(:DT_INI,'%Y-%m') ", $sql_ref);
                        }

                        try {
                            $stmt = $db->prepare($sql);
                            $stmt->bindParam(':EMPRESA', $resource->empresa, PDO::PARAM_STR);
                            $stmt->bindParam(':RHID', $resource->rhid, PDO::PARAM_STR);
                            $stmt->bindParam(':DT_ADM', $resource->dt_adm, PDO::PARAM_STR);
                            $stmt->bindParam(':DT_INI', $resource->dt_ini, PDO::PARAM_STR);
                            $stmt->execute();
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            if ($resource->tp_ocorrencia == 'A'     || 
                                $resource->tp_ocorrencia == 'FC'    || 
                                $resource->tp_ocorrencia == 'HC'
                                ){
                                $total = ($row['CREDITOS'] + $resource->duracao_minutos) / 60;
                                if ($regra_adap['LIM_PLUS_MES'] != '' && $total > $regra_adap['LIM_PLUS_MES']) {
                                    $msg = $msg_record_over_limit;
                                    $msg = str_replace("{0}",mb_strtoupper($ui_frequence_month, 'UTF-8'), $msg);
                                    $msg = str_replace("{1}",$regra_adap['LIM_PLUS_MES'], $msg);
                                    $msg = str_replace("{2}",($total - $regra_adap['LIM_PLUS_MES']), $msg);
                                }
                            }
                            elseif ($resource->tp_ocorrencia == 'R1' || 
                                    $resource->tp_ocorrencia == 'R2' || 
                                    $resource->tp_ocorrencia == 'FD' || 
                                    $resource->tp_ocorrencia == 'HD'
                                ) {
                                $total = ($row['DEBITOS'] + $resource->duracao_minutos) / 60;
                                if ($regra_adap['LIM_MINUS_MES'] != '' && $total > $regra_adap['LIM_MINUS_MES']) {
                                    $msg = $msg_record_over_limit;
                                    $msg = str_replace("{0}",mb_strtoupper($ui_frequence_month, 'UTF-8'), $msg);
                                    $msg = str_replace("{1}",$regra_adap['LIM_MINUS_MES'], $msg);
                                    $msg = str_replace("{2}",($total - $regra_adap['LIM_MINUS_MES']), $msg);
                                }
                            }
                        } catch (Exception $ex) {
                            $msg = "valida_adap#LIM_PLUS_MES/LIM_MINUS_MES [$resource->empresa, $resource->rhid, $resource->dt_adm] -> $sql: " . $ex->getMessage();
                        }
                    }

                    # validação associada ao ano
                    if (($regra_adap['LIM_PLUS_ANO'] != '' || $regra_adap['LIM_MINUS_ANO'] != '') && $msg == '') {

                        if (isset($resource->acao) && isset($resource->dt_ini) && $resource->acao == 'UPDATE') {
                            $sql = str_replace("%%CONDICAO_TEMPO%%", " AND DATE_FORMAT(A.DT_INI_DET,'%Y') = DATE_FORMAT(:DT_INI,'%Y') AND DATE_FORMAT(A.DT_INI_DET,'%Y-%m-%d %H:%i') != :DT_INI ", $sql_ref);
                        }
                        else {
                            $sql = str_replace("%%CONDICAO_TEMPO%%", " AND DATE_FORMAT(A.DT_INI_DET,'%Y') = DATE_FORMAT(:DT_INI,'%Y') ", $sql_ref);
                        }

                        try {
                            $stmt = $db->prepare($sql);
                            $stmt->bindParam(':EMPRESA', $resource->empresa, PDO::PARAM_STR);
                            $stmt->bindParam(':RHID', $resource->rhid, PDO::PARAM_STR);
                            $stmt->bindParam(':DT_ADM', $resource->dt_adm, PDO::PARAM_STR);
                            $stmt->bindParam(':DT_INI', $resource->dt_ini, PDO::PARAM_STR);
                            $stmt->execute();
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            if ($resource->tp_ocorrencia == 'A'     || 
                                $resource->tp_ocorrencia == 'FC'    || 
                                $resource->tp_ocorrencia == 'HC'
                                ){
                                $total = ($row['CREDITOS'] + $resource->duracao_minutos) / 60;
                                if ($regra_adap['LIM_PLUS_ANO'] != '' && $total > $regra_adap['LIM_PLUS_ANO']) {
                                    $msg = $msg_record_over_limit;
                                    $msg = str_replace("{0}",mb_strtoupper($ui_frequence_year, 'UTF-8'), $msg);
                                    $msg = str_replace("{1}",$regra_adap['LIM_PLUS_ANO'], $msg);
                                    $msg = str_replace("{2}",($total - $regra_adap['LIM_PLUS_ANO']), $msg);
                                }
                            }
                            elseif ($resource->tp_ocorrencia == 'R1' || 
                                    $resource->tp_ocorrencia == 'R2' || 
                                    $resource->tp_ocorrencia == 'FD' || 
                                    $resource->tp_ocorrencia == 'HD'
                                ) {
                                $total = ($row['DEBITOS'] + $resource->duracao_minutos) * 60;
                                if ($regra_adap['LIM_MINUS_ANO'] != '' && $total > $regra_adap['LIM_MINUS_ANO']) {
                                    $msg = $msg_record_over_limit;
                                    $msg = str_replace("{0}",mb_strtoupper($ui_frequence_year, 'UTF-8'), $msg);
                                    $msg = str_replace("{1}",$regra_adap['LIM_MINUS_ANO'], $msg);
                                    $msg = str_replace("{2}",($total - $regra_adap['LIM_MINUS_ANO']), $msg);
                                }
                            }
                        } catch (Exception $ex) {
                            $msg = "valida_adap#LIM_PLUS_ANO/LIM_MINUS_ANO [$resource->empresa, $resource->rhid, $resource->dt_adm] -> $sql: " . $ex->getMessage();
                        }
                    }
                    
                }
            }
        }
    }
    #$msg = "STOP[$msg]";
}

/*
 * Validações específicas de ausências
 * 
     resource = {
        empresa: "DEMO",
        rhid: "355",
        dt_adm: "2019-03-01",
        dt_ini: "2019-01-01 12:23",
        dt_fim: "2019-01-01 17:11",
    }
 * 
 */
function valida_ausencia($resource, &$msg) {
    global $db, $msg_record_over_limit_2, $ui_frequence_year, $ui_frequence_month,
           $ui_calendar_days, $ui_work_days, $ui_hours;
    $db = $db;
  
    $msg = '';
    if ($resource->empresa != '' && $resource->rhid != '' && $resource->dt_adm != '' && $resource->cd_ausencia != '') {

        $param_aus = get_param_aus($resource->cd_ausencia, $msg); 

        # valida com parametrização
        if ($msg == '') {
            #var_dump($param_aus);
            /*
              validações associadas ao parâmetro
                'MAX_ANO' => null
                'MIN_ANO' => null
                'MAX_MES' => null
                'MIN_MES' => null
                'MAX_CONSECUTIVAS' => null
                'MIN_CONSECUTIVAS' => null
                'MAX_OCORRENCIAS' => null
                'MIN_OCORRENCIAS' => null            
             */

            if ($msg == '' && count($param_aus) > 0) {

                # statment base para contabilização
                $sql_ref =  "SELECT SUM(NVL(A.NR_CALENDARIO,0)) + SUM(NVL(B.NR_CALENDARIO,0)) DCAL  ".
                            "      ,SUM(NVL(A.NR_UTEIS,0)) + SUM(NVL(B.NR_UTEIS,0)) DUTS ".
                            "      ,SUM(NVL(A.NR_MINUTOS,0)) + SUM(NVL(B.NR_MINUTOS,0)) MUTS ".
                            "FROM RH_ID_EMPRESAS E ".
                            "  LEFT JOIN RH_ID_AUSENCIAS A ON A.EMPRESA = E.EMPRESA AND A.RHID = E.RHID AND A.DT_ADMISSAO = E.DT_ADMISSAO AND A.CD_AUSENCIA = :CD_AUSENCIA %%CONDICAO_TEMPO%% ".
                            "  LEFT JOIN RH_ID_AUSENCIAS_WKF B ON B.EMPRESA = E.EMPRESA AND B.RHID = E.RHID AND B.DT_ADMISSAO = E.DT_ADMISSAO AND B.REJECTED = 'N' AND B.FINISHED = 'N' AND B.OPERACAO = 'INSERT' AND B.CD_AUSENCIA = :CD_AUSENCIA  %%CONDICAO_TEMPO%% ".
                            "WHERE E.EMPRESA = :EMPRESA ".
                            "  AND E.RHID = :RHID ".
                            "  AND A.DT_ADMISSAO = TO_DATE(:DT_ADM, 'YYYY-MM-DD') ";
                
                if (($param_aus['MAX_ANO'] != '' || $param_aus['MIN_ANO'] != '') || 
                    ($param_aus['MAX_MES'] != '' || $param_aus['MIN_MES'] != '') ||
                    ($param_aus['MAX_CONSECUTIVAS'] != '' || $param_aus['MIN_CONSECUTIVAS'] != '') ||
                    ($param_aus['MAX_OCORRENCIAS'] != '' || $param_aus['MIN_OCORRENCIAS'] != '') 
                    ) {

                    # validação associada ao ano
                    if (($param_aus['MAX_ANO'] != '' || $param_aus['MIN_ANO'] != '') && $msg == '') {

                        if (isset($resource->acao) && isset($resource->dt_ini) && $resource->acao == 'UPDATE') {
                            $sql = str_replace("%%CONDICAO_TEMPO%%", " AND DATE_FORMAT(A.DT_INI,'%Y') = DATE_FORMAT(:DT_INI,'%Y') AND DATE_FORMAT(A.DT_INI,'%Y-%m-%d %H:%i') != :DT_INI  ", $sql_ref);
                        }
                        else {
                            $sql = str_replace("%%CONDICAO_TEMPO%%", " AND DATE_FORMAT(A.DT_INI,'%Y') = DATE_FORMAT(:DT_INI,'%Y') ", $sql_ref);
                        }

                        try {
                            $stmt = $db->prepare($sql);
                            $stmt->bindParam(':EMPRESA', $resource->empresa, PDO::PARAM_STR);
                            $stmt->bindParam(':RHID', $resource->rhid, PDO::PARAM_STR);
                            $stmt->bindParam(':DT_ADM', $resource->dt_adm, PDO::PARAM_STR);
                            $stmt->bindParam(':CD_AUSENCIA', $resource->cd_ausencia, PDO::PARAM_STR);
                            $stmt->bindParam(':DT_INI', $resource->dt_ini, PDO::PARAM_STR);
                            $stmt->execute();
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            
                            if ($param_aus['UNIDADE_LIMITES'] == 'C') { # dias calendário
                                $total = $row['DCAL'] + $resource->nr_calendario;
                            } 
                            elseif ($param_aus['UNIDADE_LIMITES'] == 'U') { # dias úteis
                                $total = $row['DUTS'] + $resource->nr_uteis;
                            }
                            elseif ($param_aus['UNIDADE_LIMITES'] == 'H') { # horas
                                $total = ($row['MUTS'] + $resource->minutos) / 60;
                            }

                            if ($param_aus['MAX_ANO'] != '' && $total > $param_aus['MAX_ANO']) {
                                $msg = $msg_record_over_limit_2;
                                $msg = str_replace("{0}",mb_strtoupper($ui_frequence_year, 'UTF-8'), $msg);
                                $msg = str_replace("{1}",$param_aus['MAX_ANO'], $msg);
                                if ($param_aus['UNIDADE_LIMITES'] == 'C') { # dias calendário
                                    $msg = str_replace("{2}", $ui_calendar_days , $msg);
                                } 
                                elseif ($param_aus['UNIDADE_LIMITES'] == 'U') { # dias úteis
                                    $msg = str_replace("{2}", $ui_work_days , $msg);
                                }
                                elseif ($param_aus['UNIDADE_LIMITES'] == 'H') { # horas
                                    $msg = str_replace("{2}", $ui_hours , $msg);
                                }                            
                                $msg = str_replace("{3}",($total - $param_aus['MAX_ANO']), $msg);
                            }
                            elseif ($param_aus['MIN_ANO'] != '' && $total < $param_aus['MIN_ANO'] && false) {
                                $msg = "É inferior ao mínimo anual ".$param_aus['UNIDADE_LIMITES'].") [total:$total vs limite:".$param_aus['MIN_ANO']."]";
                            }
                            
                        } catch (Exception $ex) {
                            $msg = "valida_adap#MAX_ANO/MIN_ANO [$resource->empresa, $resource->rhid, $resource->dt_adm] -> $sql: " . $ex->getMessage();
                        }
                    }

                    # validação associada ao mês
                    if (($param_aus['MAX_MES'] != '' || $param_aus['MIN_MES'] != '') && $msg == '') {

                        if (isset($resource->acao) && isset($resource->dt_ini) && $resource->acao == 'UPDATE') {
                            $sql = str_replace("%%CONDICAO_TEMPO%%", " AND DATE_FORMAT(A.DT_INI,'%Y-%m') = DATE_FORMAT(:DT_INI,'%Y-%m') AND DATE_FORMAT(A.DT_INI,'%Y-%m-%d %H:%i') != :DT_INI ", $sql_ref);
                        }
                        else {
                            $sql = str_replace("%%CONDICAO_TEMPO%%", " AND DATE_FORMAT(A.DT_INI,'%Y-%m') = DATE_FORMAT(:DT_INI,'%Y-%m') ", $sql_ref);
                        }

                        try {
                            $stmt = $db->prepare($sql);
                            $stmt->bindParam(':EMPRESA', $resource->empresa, PDO::PARAM_STR);
                            $stmt->bindParam(':RHID', $resource->rhid, PDO::PARAM_STR);
                            $stmt->bindParam(':DT_ADM', $resource->dt_adm, PDO::PARAM_STR);
                            $stmt->bindParam(':CD_AUSENCIA', $resource->cd_ausencia, PDO::PARAM_STR);
                            $stmt->bindParam(':DT_INI', $resource->dt_ini, PDO::PARAM_STR);
                            $stmt->execute();
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            
                            if ($param_aus['UNIDADE_LIMITES'] == 'C') { # dias calendário
                                $total = $row['DCAL'] + $resource->nr_calendario;
                            } 
                            elseif ($param_aus['UNIDADE_LIMITES'] == 'U') { # dias úteis
                                $total = $row['DUTS'] + $resource->nr_uteis;
                            }
                            elseif ($param_aus['UNIDADE_LIMITES'] == 'H') { # horas
                                $total = ($row['MUTS'] + $resource->minutos) / 60;
                            }

                            if ($param_aus['MAX_MES'] != '' && $total > $param_aus['MAX_MES']) {
                                $msg = $msg_record_over_limit_2;
                                $msg = str_replace("{0}",mb_strtoupper($ui_frequence_month, 'UTF-8'), $msg);
                                $msg = str_replace("{1}",$param_aus['MAX_MES'], $msg);
                                if ($param_aus['UNIDADE_LIMITES'] == 'C') { # dias calendário
                                    $msg = str_replace("{2}", $ui_calendar_days , $msg);
                                } 
                                elseif ($param_aus['UNIDADE_LIMITES'] == 'U') { # dias úteis
                                    $msg = str_replace("{2}", $ui_work_days , $msg);
                                }
                                elseif ($param_aus['UNIDADE_LIMITES'] == 'H') { # horas
                                    $msg = str_replace("{2}", $ui_hours , $msg);
                                }                            
                                $msg = str_replace("{3}",($total - $param_aus['MAX_MES']), $msg);
                            }
                            elseif ($param_aus['MIN_MES'] != '' && $total < $param_aus['MIN_MES'] && false) {
                                $msg = "É inferior ao mínimo mensal (".$param_aus['UNIDADE_LIMITES'].") [total:$total vs limite:".$param_aus['MIN_MES']."]";
                            }
                            
                        } catch (Exception $ex) {
                            $msg = "valida_adap#MAX_MES/MIN_MES [$resource->empresa, $resource->rhid, $resource->dt_adm] -> $sql: " . $ex->getMessage();
                        }
                    }
                    
                    # validaçáo associada ao consecutividade
                    
                    # validação associada ào número de ocorrências
                    
                }
            }
        }
    }
   #$msg = "STOP[$msg]";
}


/*
 * Validações associadas a número de documentos 
 */

// Validação do NIF Português
// https://gist.github.com/eresende/88562d2c4dc85b62cb0c
function checkDigitNIF ($nif) {
    $c = 0;
    for ($i = 0; $i < strlen($nif) - 1; ++$i) {
        $c += intval($nif[$i]) * (10 - $i - 1);
    }
    $c = 11 - ($c % 11);
    return $c >= 10 ? 0 : $c;
};

function validateNIF_PT($str) {
    $nif = strtoupper($str);
    
    if (!preg_match('/(PT)?([123568]\d{1}|45|7[0124579]|9[0189])(\d{7})/',$nif)) {
        return false;
        //throw new Error('Invalid format');
    }
    $nif = str_replace('PT','',$nif); //remove the PT part
    
    return checkDigitNIF($nif) === intval(substr($str,strlen($str)-1,1));
}

// Validação do NISS Português
function validateNISS_PT($number) {
    $niss = str_replace(" ","",$number);
    $niss = str_replace("-","",$niss); // remove space and -
    $niss = strtoupper($niss);
    if (strlen($niss) !== 11) {
        return false;
    } else {
        $ctrlDigit = [29, 23, 19, 17, 13, 11, 7, 5, 3, 2];
        $chkDigit = $niss[10];
        $c = 0;
        for ($i = 0; $i < strlen($niss) - 1; ++$i) {
            $c += intval($niss[$i]) * $ctrlDigit[$i];
        }
        $c = 9 - ($c % 10);
        return ($c === intval($chkDigit));
    }
    return false;
}
  
// Validação do Cartão Cidadão Português
//https://gist.github.com/ReskatoR-FR/1bf8713f6a3f6e216b992339bb988984
function validateCC_PT($number) {
    
    $letter_value = array(  'A' => 10, 'B' => 11, 'C' => 12, 'D' => 13, 'E' => 14, 
                            'F' => 15, 'G' => 16, 'H' => 17, 'I' => 18, 'J' => 19, 
                            'K' => 20, 'L' => 21, 'M' => 22, 'N' => 23, 'O' => 24, 
                            'P' => 25, 'Q' => 26, 'R' => 27, 'S' => 28, 'T' => 29, 
                            'U' => 30, 'V' => 31, 'W' => 32, 'X' => 33, 'Y' => 34, 
                            'Z' => 35
                    );

    $cc_number = str_replace(" ","",$number);
    $cc_number = str_replace("-","",$cc_number); // remove space and -
    $cc_number = strtoupper($cc_number);
    
    # pelo menos tem que contemplar o número de identificação civil
    if (strlen($cc_number) < 12) {
        return false;
    }
    
    $cc_number = array_reverse(str_split($cc_number));
    $cc_number[1] = $letter_value[$cc_number[1]];
    $cc_number[2] = $letter_value[$cc_number[2]];
    $sum = 0;
    $dum = 0;
    for ($i = 0 ; $i < count($cc_number); ++$i) {
        if ( $i % 2 == 0) {
                $dum = intval($cc_number[$i]);
        }
        else {
            $dum = intval($cc_number[$i]) * 2;
            if ($dum >= 10)
                $dum -= 9;
        }
        $sum += $dum;
    }
    return ($sum % 10 == 0) ? true : false;
}

/*
 * Validações específicas de documentos de colaboradores e agregados
 * 
     resource = {
        rhid: "355",
        cd_doc_id: 1
        nr_documento: "210124322'
        dt_emissao: "2019-01-01",
        dt_validade: "2019-01-01"
    }
 * 
 */
function valida_documentos($resource, &$msg) {
    global $db, $ui_issuing_date, $ui_validity_date, $ui_required, 
           $error_dt_eq_greather_than, $error_invalid_doc_nr, $msg_time_overlap;
    $db = $db;
  
    $msg = '';
    if ($resource->rhid != '' && $resource->cd_doc_id != '' && $resource->nr_documento != '') {

        # parâmetro do documento de identificação
        $sql =  "SELECT a.* ".
                "FROM DG_DOCUMENTOS a ".
                "WHERE a.CD_DOC_ID = :CD_ ";
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':CD_', $resource->cd_doc_id, PDO::PARAM_STR);
            $stmt->execute();
            $param = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $ex) {
                $msg = "valida_documentos#1 :" . $ex->getMessage();
        }

        # valida com parametrização
        if ($msg == '') {

            ## valida o tipo de documento consoante a nacionalidade
            if ($param['TP_DOCUMENTO'] == 'A' ||  # CC
                $param['TP_DOCUMENTO'] == 'B' ||  # NIF
                $param['TP_DOCUMENTO'] == 'C' ) { # NISS

                # obtem nacionalidade do colaborador
                $sql =  "SELECT a.* ".
                        "FROM RH_IDENTIFICACOES a ".
                        "WHERE a.RHID = :RHID_ ";
                try {
                    $stmt = $db->prepare($sql);
                    $stmt->bindParam(':RHID_', $resource->rhid, PDO::PARAM_STR);
                    $stmt->execute();
                    $info_rhid = $stmt->fetch(PDO::FETCH_ASSOC);
                } catch (Exception $ex) {
                        $msg = "valida_documentos#2 :" . $ex->getMessage();
                }

                if ($msg == '') {

                    if ($param['TP_DOCUMENTO'] == 'A' && 
                        ($info_rhid['CD_PAIS_NACIONALIDADE'] === 'PT' || $info_rhid['CD_PAIS_NACIONALIDADE'] === '') ) { # CC
                        if (!validateCC_PT($resource->nr_documento)) {
                            $msg = $error_invalid_doc_nr;
                        }
                    }
                    elseif ($param['TP_DOCUMENTO'] == 'B' && 
                            ($info_rhid['CD_PAIS_NACIONALIDADE'] === 'PT' || $info_rhid['CD_PAIS_NACIONALIDADE'] === '') ) { # NIF
                        if (!validateNIF_PT($resource->nr_documento)) {
                            $msg = $error_invalid_doc_nr;
                        }
                    }
                    elseif ($param['TP_DOCUMENTO'] == 'B' && 
                            ($info_rhid['CD_PAIS_NACIONALIDADE'] === 'PT' || $info_rhid['CD_PAIS_NACIONALIDADE'] === '') ) { # NISS
                        if (!validateNISS_PT($resource->nr_documento)) {
                            $msg = $error_invalid_doc_nr;
                        }
                    }
                }
            }
            
            ## deve validar preenchimento das datas de emissão e validade e verificar potenciais cruzamentos
            if ($param['CHECK_DATES'] == 'S' && $msg == '') {
                
                if ($resource->dt_emissao == '') {
                    $msg = "$ui_issuing_date: $ui_required";
                }
                
                if ($resource->dt_validade == ''){
                    if ($msg == '') {
                        $msg = "$ui_validity_date: $ui_required";
                    }
                    else {
                        $msg .= " $ui_validity_date: $ui_required";
                    }
                }
                
                if ($msg == '' && $resource->dt_emissao > $resource->dt_validade) {
                    $msg = "$ui_validity_date: ".str_replace("[0]", $resource->dt_emissao, $error_dt_eq_greather_than);
                }
  
                # validação de cruzamentos de documentos RH_ID_DOCUMENTOS e RH_ID_DOCUMENTOS_WKF

                // Fase 1: valida cruzamento de registo detetando sobreposições na respetiva tabela de registos efetivos
                if ($msg == '') {
                    $query = "SELECT TO_CHAR(DT_EMISSAO,'YYYY-MM-DD') DT_INI, TO_CHAR(DT_VALIDADE,'YYYY-MM-DD') DT_FIM ".
                             "FROM RH_ID_DOCUMENTOS ".
                             "WHERE RHID = :RHID_ ".
                             "  AND CD_DOC_ID = :CD_DOC_ID_ ".
                             "  AND TO_CHAR(DT_EMISSAO,'YYYY-MM-DD') != :DT_FIM_VAL_ ".
                             "  AND TO_CHAR(DT_VALIDADE,'YYYY-MM-DD') != :DT_INI_VAL_ ";

                    # cruzamentos
                    /*
                            REGISTO:        X------------------------X
                                    *-----------------*                                         (1)
                                                    *----------------------------*              (2)
                                   *-------------------------------------------------*		(3)
                                                *----------*                                    (4)
                    */
                    $query .= " AND (".     ## CASO 1
                              " (:DT_INI_VAL_ <= TO_CHAR(DT_EMISSAO,'YYYY-MM-DD') AND ".
                              "  :DT_FIM_VAL_ BETWEEN TO_CHAR(DT_EMISSAO,'YYYY-MM-DD') AND NVL(TO_CHAR(DT_VALIDADE,'YYYY-MM-DD'),'2999-01-01') ".
                              " ) OR ".     ## CASO 2
                              " (:DT_INI_VAL_ BETWEEN TO_CHAR(DT_EMISSAO,'YYYY-MM-DD') AND NVL(TO_CHAR(DT_VALIDADE,'YYYY-MM-DD'),'2999-01-01') AND ".
                              "  :DT_FIM_VAL_ >= NVL(TO_CHAR(DT_VALIDADE,'YYYY-MM-DD'),'2999-01-01') ".
                              " ) OR ".     ## CASO 3
                              " (:DT_INI_VAL_ <= TO_CHAR(DT_EMISSAO,'YYYY-MM-DD') AND  ".
                              "  :DT_FIM_VAL_ >= NVL(TO_CHAR(DT_VALIDADE,'YYYY-MM-DD'),'2999-01-01') ".
                              " ) OR ".     ## CASO 4
                              " (:DT_INI_VAL_ >= TO_CHAR(DT_EMISSAO,'YYYY-MM-DD') AND ".
                              "  :DT_FIM_VAL_ <= NVL(TO_CHAR(DT_VALIDADE,'YYYY-MM-DD'),'2999-01-01') ".
                              " ) ".
                              ") ";

                    # pondera agregado
                    if ($resource->cd_agregado !== '') {
                        $query .= "  AND CD_AGREGADO = :CD_AGREGADO_ ";
                    } 
                    else {
                        $query .= "  AND CD_AGREGADO IS NULL ";
                    }

                    # excluir o próprio registo
                    if ($resource->acao == 'UPDATE') {
                        $query .= "  AND SEQ != :SEQ_ ";
                    }
/*
$out = $query;
$out = str_replace(':RHID_', $resource->rhid,$out);
$out = str_replace(':CD_DOC_ID_', "'".$resource->cd_doc_id."'",$out);
$out = str_replace(':DT_INI_VAL_', "'".$resource->dt_emissao."'",$out);
$out = str_replace(':DT_FIM_VAL_', "'".$resource->dt_validade."'",$out);
$out = str_replace(':SEQ_', "'".$resource->seq."'",$out);
$out = str_replace(':CD_AGREGADO_', "'".$resource->cd_agregado."'",$out);
echo $out;
 */
                    try {
                        $stmt = $db->prepare($query);
                        $stmt->bindParam(':RHID_', $resource->rhid, PDO::PARAM_STR);
                        $stmt->bindParam(':CD_DOC_ID_', $resource->cd_doc_id, PDO::PARAM_STR);
                        $stmt->bindParam(':DT_INI_VAL_', $resource->dt_emissao, PDO::PARAM_STR);
                        $stmt->bindParam(':DT_FIM_VAL_', $resource->dt_validade, PDO::PARAM_STR);
                        if ($resource->cd_agregado !== '') {
                            $stmt->bindParam(':CD_AGREGADO_', $resource->cd_agregado, PDO::PARAM_STR);
                        }
                        if ($resource->acao == 'UPDATE') {
                            $stmt->bindParam(':SEQ_', $resource->seq, PDO::PARAM_STR);
                        }
                        $stmt->execute();
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } catch (Exception $ex) {
                            $msg = "valida_documentos #3[$resource->rhid,$resource->cd_doc_id,$resource->tabela,$resource->cd_agregado]: " . $ex->getMessage();
                    }

                    if ($msg == '') {
                        if (count($result) > 0) {
                            foreach($result as $row) {
                                $txt = $row['DT_INI'];
                                if ($row['DT_FIM']) {
                                    $txt .= ' ~ ' . $row['DT_FIM'];                        
                                }
                                $msg = str_replace('{0}' , $txt, $msg_time_overlap);
                                break;
                            }
                        }
                    }
                }

                // Fase 2: valida cruzamento de registo detetando sobreposições na respetiva tabela de registos em workflow
                if ($msg == '') {
                    $query = "SELECT TO_CHAR(DT_EMISSAO,'YYYY-MM-DD') DT_INI, TO_CHAR(DT_VALIDADE,'YYYY-MM-DD') DT_FIM ".
                             "FROM RH_ID_DOCUMENTOS_WKF ".
                             "WHERE RHID = :RHID_ ".
                             "  AND CD_DOC_ID = :CD_DOC_ID_ ".
                             "  AND TO_CHAR(DT_EMISSAO,'YYYY-MM-DD') != :DT_FIM_VAL_ ".
                             "  AND TO_CHAR(DT_VALIDADE,'YYYY-MM-DD') != :DT_INI_VAL_ ".
                             "  AND FINISHED = 'N' ".
                             "  AND REJECTED = 'N' ".
                             "  AND OPERACAO IN ('INSERT','UPDATE','DELETE') ";

                    # cruzamentos
                    /*
                            REGISTO:        X------------------------X
                                    *-----------------*                                         (1)
                                                    *----------------------------*              (2)
                                   *-------------------------------------------------*		(3)
                                                *----------*                                    (4)
                    */
                    $query .= " AND (".     ## CASO 1
                              " (:DT_INI_VAL <= TO_CHAR(DT_EMISSAO,'YYYY-MM-DD') AND ".
                              "  :DT_FIM_VAL BETWEEN TO_CHAR(DT_EMISSAO,'YYYY-MM-DD') AND NVL(TO_CHAR(DT_VALIDADE,'YYYY-MM-DD'),'2999-01-01') ".
                              " ) OR ".     ## CASO 2
                              " (:DT_INI_VAL BETWEEN TO_CHAR(DT_EMISSAO,'YYYY-MM-DD') AND NVL(TO_CHAR(DT_VALIDADE,'YYYY-MM-DD'),'2999-01-01') AND ".
                              "  :DT_FIM_VAL >= NVL(TO_CHAR(DT_VALIDADE,'YYYY-MM-DD'),'2999-01-01') ".
                              " ) OR ".     ## CASO 3
                              " (:DT_INI_VAL <= TO_CHAR(DT_EMISSAO,'YYYY-MM-DD') AND  ".
                              "  :DT_FIM_VAL >= NVL(TO_CHAR(DT_VALIDADE,'YYYY-MM-DD'),'2999-01-01') ".
                              " ) OR ".     ## CASO 4
                              " (:DT_INI_VAL >= TO_CHAR(DT_EMISSAO,'YYYY-MM-DD') AND ".
                              "  :DT_FIM_VAL <= NVL(TO_CHAR(DT_VALIDADE,'YYYY-MM-DD'),'2999-01-01') ".
                              " ) ".
                              ") ";

                    # pondera agregado
                    if ($resource->cd_agregado !== '') {
                        $query .= "  AND CD_AGREGADO = :CD_AGREGADO_ ";
                    } 
                    else {
                        $query .= "  AND CD_AGREGADO IS NULL ";
                    }

                    # excluir o próprio registo
                    if ($resource->acao == 'UPDATE') {
                        $query .= "  AND SEQ != :SEQ_ ";
                    }
/*        
$out = $query;
$out = str_replace(':RHID_', $resource->rhid,$out);
$out = str_replace(':CD_DOC_ID_', "'".$resource->cd_doc_id."'",$out);
$out = str_replace(':DT_INI_VAL', "'".$resource->dt_emissao."'",$out);
$out = str_replace(':DT_FIM_VAL', "'".$resource->dt_validade."'",$out);
$out = str_replace(':SEQ_', "'".$resource->seq."'",$out);
$out = str_replace(':CD_AGREGADO_', "'".$resource->cd_agregado."'",$out);
echo $out;
*/
                    try {
                        $stmt->bindParam(':RHID_', $resource->rhid, PDO::PARAM_STR);
                        $stmt->bindParam(':CD_DOC_ID_', $resource->cd_doc_id, PDO::PARAM_STR);
                        $stmt->bindParam(':DT_INI_VAL', $resource->dt_emissao, PDO::PARAM_STR);
                        $stmt->bindParam(':DT_FIM_VAL', $resource->dt_validade, PDO::PARAM_STR);
                        if ($resource->cd_agregado !== '') {
                            $stmt->bindParam(':CD_AGREGADO_', $resource->cd_agregado, PDO::PARAM_STR);
                        }
                        if ($resource->acao == 'UPDATE') {
                            $stmt->bindParam(':SEQ_', $resource->seq, PDO::PARAM_STR);
                        }
                        $stmt->execute();
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } catch (Exception $ex) {
                            $msg = "valida_documentos #4[$resource->rhid,$resource->cd_doc_id,$resource->tabela]: " . $ex->getMessage();
                    }

                    if ($msg == '') {
                        if (count($result) > 0) {
                            foreach($result as $row) {
                                $txt = $row['DT_INI'];
                                if ($row['DT_FIM']) {
                                    $txt .= ' ~ ' . $row['DT_FIM'];                        
                                }
                                $msg = str_replace('{0}' , $txt, $msg_time_overlap_wkf);
                                break;
                            }
                        }
                    }
                }
               
            }
        }
    }
    #$msg = "STOP[$msg]";
}

/*
 * Validações específicas das habilitações literárias do colaborador
 * 
     resource = {
        rhid: "355",
        cd_hab_lit: "1212"
        dt_ini: "2019-01-01",
        dt_fim: "2021-01-01"
    }
 * 
 */
function valida_hab_literarias($resource, &$msg) {
    global $db, $error_dt_eq_greather_than, $error_invalid_doc_nr, $msg_time_overlap,
           $error_hab_lit_only_one_unique_report;
    $db = $db;
  
    $msg = '';
    if ($resource->rhid != '' && $resource->cd_hab_lit != '' && $resource->dt_ini != '') {

        # garantir unicidade da indicação para Relatório Único
        $sql =  "SELECT COUNT(*) CNT ".
                "FROM RH_ID_HAB_LITERARIAS a ".
                "WHERE a.RHID = :RHID_ ".
                "  AND a.RU = 'S' ";
        
        if ($resource->acao == 'UPDATE') {
            $sql .= " AND a.DT_INI != :DT_INI_ ";
        }
        
        $sql .= "UNION ".
                "SELECT COUNT(*) CNT ".
                "FROM RH_ID_HAB_LITERARIAS_WKF b ".
                "WHERE b.RHID = :RHID_ ".
                "  AND b.RU = 'S' ";
        
        if ($resource->acao == 'UPDATE') {
            $sql .= " AND b.DT_INI != :DT_INI_ ";
        }
        
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':RHID_', $resource->rhid, PDO::PARAM_STR);
            if ($resource->acao == 'UPDATE') {
                $stmt->bindParam(':DT_INI_', $resource->dt_ini, PDO::PARAM_STR);
            }
            $stmt->execute();
            if ($resource->ru === 'S') {
                $cnt = 1;
            }
            else {
                $cnt = 0;
            }
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $cnt += $row['CNT'];
            }
            
            if ($cnt > 1) {
                $msg = $error_hab_lit_only_one_unique_report;
            }
        } catch (Exception $ex) {
                $msg = "valida_hab_literarias#1 :" . $ex->getMessage();
        }

        # validação de cruzamentos de habilitações literárias RH_ID_HAB_LITERARIAS e RH_ID_HAB_LITERARIAS_WKF
        # 
        // Fase 1: valida cruzamento de registo detetando sobreposições na respetiva tabela de registos efetivos
        if ($msg == '') {
            $query = "SELECT TO_CHAR(DT_INI,'YYYY-MM-DD') DT_INI, COALESCE(TO_CHAR(DT_FIM,'YYYY-MM-DD'),'2999-01-01') DT_FIM ".
                     "FROM RH_ID_HAB_LITERARIAS ".
                     "WHERE RHID = :RHID_ ".
                     "  AND CD_HAB_LIT = :CD_HAB_LIT_ ";

            # cruzamentos
            /*
                    REGISTO:        X------------------------X
                            *-----------------*                                         (1)
                                            *----------------------------*              (2)
                           *-------------------------------------------------*		(3)
                                        *----------*                                    (4)
            */
            $query .= " AND (".     ## CASO 1
                      " (:DT_INI_VAL <= TO_CHAR(DT_INI,'YYYY-MM-DD') AND ".
                      "  :DT_FIM_VAL BETWEEN TO_CHAR(DT_INI,'YYYY-MM-DD') AND NVL(TO_CHAR(DT_FIM,'YYYY-MM-DD'),'2999-01-01') ".
                      " ) OR ".     ## CASO 2
                      " (:DT_INI_VAL BETWEEN TO_CHAR(DT_INI,'YYYY-MM-DD') AND NVL(TO_CHAR(DT_FIM,'YYYY-MM-DD'),'2999-01-01') AND ".
                      "  :DT_FIM_VAL >= NVL(TO_CHAR(DT_FIM,'YYYY-MM-DD'),'2999-01-01') ".
                      " ) OR ".     ## CASO 3
                      " (:DT_INI_VAL <= TO_CHAR(DT_INI,'YYYY-MM-DD') AND  ".
                      "  :DT_FIM_VAL >= NVL(TO_CHAR(DT_FIM,'YYYY-MM-DD'),'2999-01-01') ".
                      " ) OR ".     ## CASO 4
                      " (:DT_INI_VAL >= TO_CHAR(DT_INI,'YYYY-MM-DD') AND ".
                      "  :DT_FIM_VAL <= NVL(TO_CHAR(DT_FIM,'YYYY-MM-DD'),'2999-01-01') ".
                      " ) ".
                      ") ";

            # excluir o próprio registo
            if ($resource->acao == 'UPDATE') {
                $query .= "  AND DT_INI != :DT_INI_VAL ";
            }
/*
$out = $query;
$out = str_replace(':RHID_', $resource->rhid,$out);
$out = str_replace(':CD_DOC_ID_', "'".$resource->cd_doc_id."'",$out);
$out = str_replace(':DT_INI_VAL', "'".$resource->dt_emissao."'",$out);
$out = str_replace(':DT_FIM_VAL', "'".$resource->dt_validade."'",$out);
$out = str_replace(':SEQ_', "'".$resource->seq."'",$out);
$out = str_replace(':CD_AGREGADO_', "'".$resource->cd_agregado."'",$out);
echo $out;
*/
            try {
                $stmt = $db->prepare($query);
                $stmt->bindParam(':RHID_', $resource->rhid, PDO::PARAM_STR);
                $stmt->bindParam(':CD_HAB_LIT_', $resource->cd_hab_lit, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_VAL', $resource->dt_ini, PDO::PARAM_STR);
                $stmt->bindParam(':DT_FIM_VAL', $resource->dt_fim, PDO::PARAM_STR);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                    $msg = "valida_hab_literarias #2[$resource->rhid,$resource->cd_hab_lit,$resource->tabela]: " . $ex->getMessage();
            }

            if ($msg == '') {
                if (count($result) > 0) {
                    foreach($result as $row) {
                        $txt = $row['DT_INI'];
                        if ($row['DT_FIM']) {
                            $txt .= ' ~ ' . $row['DT_FIM'];                        
                        }
                        $msg = str_replace('{0}' , $txt, $msg_time_overlap);
                        break;
                    }
                }
            }
        }

        // Fase 2: valida cruzamento de registo detetando sobreposições na respetiva tabela de registos em workflow
        if ($msg == '') {
            $query = "SELECT TO_CHAR(DT_INI,'YYYY-MM-DD') DT_INI, COALESCE(TO_CHAR(DT_FIM,'YYYY-MM-DD'),'2999-01-01') DT_FIM ".
                     "FROM RH_ID_HAB_LITERARIAS_WKF ".
                     "WHERE RHID = :RHID_ ".
                     "  AND CD_HAB_LIT = :CD_HAB_LIT_ ";

            # cruzamentos
            /*
                    REGISTO:        X------------------------X
                            *-----------------*                                         (1)
                                            *----------------------------*              (2)
                           *-------------------------------------------------*		(3)
                                        *----------*                                    (4)
            */
            $query .= " AND (".     ## CASO 1
                      " (:DT_INI_VAL <= TO_CHAR(DT_INI,'YYYY-MM-DD') AND ".
                      "  :DT_FIM_VAL BETWEEN TO_CHAR(DT_INI,'YYYY-MM-DD') AND NVL(TO_CHAR(DT_FIM,'YYYY-MM-DD'),'2999-01-01') ".
                      " ) OR ".     ## CASO 2
                      " (:DT_INI_VAL BETWEEN TO_CHAR(DT_INI,'YYYY-MM-DD') AND NVL(TO_CHAR(DT_FIM,'YYYY-MM-DD'),'2999-01-01') AND ".
                      "  :DT_FIM_VAL >= NVL(TO_CHAR(DT_FIM,'YYYY-MM-DD'),'2999-01-01') ".
                      " ) OR ".     ## CASO 3
                      " (:DT_INI_VAL <= TO_CHAR(DT_INI,'YYYY-MM-DD') AND  ".
                      "  :DT_FIM_VAL >= NVL(TO_CHAR(DT_FIM,'YYYY-MM-DD'),'2999-01-01') ".
                      " ) OR ".     ## CASO 4
                      " (:DT_INI_VAL >= TO_CHAR(DT_INI,'YYYY-MM-DD') AND ".
                      "  :DT_FIM_VAL <= NVL(TO_CHAR(DT_FIM,'YYYY-MM-DD'),'2999-01-01') ".
                      " ) ".
                      ") ";

            # excluir o próprio registo
            if ($resource->acao == 'UPDATE') {
                $query .= "  AND DT_INI != :DT_INI_VAL ";
            }
/*
$out = $query;
$out = str_replace(':RHID_', $resource->rhid,$out);
$out = str_replace(':CD_DOC_ID_', "'".$resource->cd_doc_id."'",$out);
$out = str_replace(':DT_INI_VAL', "'".$resource->dt_emissao."'",$out);
$out = str_replace(':DT_FIM_VAL', "'".$resource->dt_validade."'",$out);
$out = str_replace(':SEQ_', "'".$resource->seq."'",$out);
$out = str_replace(':CD_AGREGADO_', "'".$resource->cd_agregado."'",$out);
echo $out;
*/
            try {
                $stmt = $db->prepare($query);
                $stmt->bindParam(':RHID_', $resource->rhid, PDO::PARAM_STR);
                $stmt->bindParam(':CD_HAB_LIT_', $resource->cd_hab_lit, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_VAL', $resource->dt_ini, PDO::PARAM_STR);
                $stmt->bindParam(':DT_FIM_VAL', $resource->dt_fim, PDO::PARAM_STR);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                    $msg = "valida_hab_literarias #3[$resource->rhid,$resource->cd_hab_lit,$resource->tabela]: " . $ex->getMessage();
            }

            if ($msg == '') {
                if (count($result) > 0) {
                    foreach($result as $row) {
                        $txt = $row['DT_INI'];
                        if ($row['DT_FIM']) {
                            $txt .= ' ~ ' . $row['DT_FIM'];                        
                        }
                        $msg = str_replace('{0}' , $txt, $msg_time_overlap);
                        break;
                    }
                }
            }
        }
    }
    #$msg = "STOP[$msg]";
}

/*
 * Validações específicas das habilitações literárias do colaborador
 * 
     resource = {
        rhid: "355",
        cd_hab_lit: "1212"
        dt_ini: "2019-01-01",
        dt_fim: "2021-01-01"
    }
 * 
 */
function valida_hab_profissionais($resource, &$msg) {
    global $db, $error_dt_eq_greather_than, $error_invalid_doc_nr, $msg_time_overlap;
    $db = $db;
  
    $msg = '';
    if ($resource->rhid != '' && $resource->cd_hab_prof != '' && $resource->dt_hab_prof != '' && $resource->dt_ini != '') {

        # validação de cruzamentos de habilitações profissionais RH_ID_HABS_PROFISSIONAIS e RH_ID_HABS_PROFISSIONAIS_WKF
        # 
        // Fase 1: valida cruzamento de registo detetando sobreposições na respetiva tabela de registos efetivos
        if ($msg == '') {
            $query = "SELECT TO_CHAR(DT_INI,'YYYY-MM-DD') DT_INI, COALESCE(TO_CHAR(DT_FIM,'YYYY-MM-DD'),'2999-01-01') DT_FIM ".
                     "FROM RH_ID_HABS_PROFISSIONAIS ".
                     "WHERE RHID = :RHID_ ".
                     "  AND EMPRESA = :EMPRESA_ ".
                     "  AND CD_HAB_PROF = :CD_HAB_PROF_ ".
                     "  AND DT_INI_HAB_PROF = :DT_INI_HAB_PROF_ ";

            # cruzamentos
            /*
                    REGISTO:        X------------------------X
                            *-----------------*                                         (1)
                                            *----------------------------*              (2)
                           *-------------------------------------------------*		(3)
                                        *----------*                                    (4)
            */
            $query .= " AND (".     ## CASO 1
                      " (:DT_INI_VAL <= TO_CHAR(DT_INI,'YYYY-MM-DD') AND ".
                      "  :DT_FIM_VAL BETWEEN TO_CHAR(DT_INI,'YYYY-MM-DD') AND NVL(TO_CHAR(DT_FIM,'YYYY-MM-DD'),'2999-01-01') ".
                      " ) OR ".     ## CASO 2
                      " (:DT_INI_VAL BETWEEN TO_CHAR(DT_INI,'YYYY-MM-DD') AND NVL(TO_CHAR(DT_FIM,'YYYY-MM-DD'),'2999-01-01') AND ".
                      "  :DT_FIM_VAL >= NVL(TO_CHAR(DT_FIM,'YYYY-MM-DD'),'2999-01-01') ".
                      " ) OR ".     ## CASO 3
                      " (:DT_INI_VAL <= TO_CHAR(DT_INI,'YYYY-MM-DD') AND  ".
                      "  :DT_FIM_VAL >= NVL(TO_CHAR(DT_FIM,'YYYY-MM-DD'),'2999-01-01') ".
                      " ) OR ".     ## CASO 4
                      " (:DT_INI_VAL >= TO_CHAR(DT_INI,'YYYY-MM-DD') AND ".
                      "  :DT_FIM_VAL <= NVL(TO_CHAR(DT_FIM,'YYYY-MM-DD'),'2999-01-01') ".
                      " ) ".
                      ") ";

            # excluir o próprio registo
            if ($resource->acao == 'UPDATE') {
                $query .= "  AND DT_INI != :DT_INI_VAL ";
            }
/*
$out = $query;
$out = str_replace(':RHID_', $resource->rhid,$out);
$out = str_replace(':CD_DOC_ID_', "'".$resource->cd_doc_id."'",$out);
$out = str_replace(':DT_INI_VAL', "'".$resource->dt_emissao."'",$out);
$out = str_replace(':DT_FIM_VAL', "'".$resource->dt_validade."'",$out);
$out = str_replace(':SEQ_', "'".$resource->seq."'",$out);
$out = str_replace(':CD_AGREGADO_', "'".$resource->cd_agregado."'",$out);
echo $out;
*/
            try {
                $stmt = $db->prepare($query);
                $stmt->bindParam(':RHID_', $resource->rhid, PDO::PARAM_STR);
                $stmt->bindParam(':EMPRESA_', $resource->empresa, PDO::PARAM_STR);
                $stmt->bindParam(':CD_HAB_PROF_', $resource->cd_hab_prof, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_HAB_PROF_', $resource->dt_hab_prof, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_VAL', $resource->dt_ini, PDO::PARAM_STR);
                $stmt->bindParam(':DT_FIM_VAL', $resource->dt_fim, PDO::PARAM_STR);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                    $msg = "valida_hab_profissionais #1[$resource->rhid,$resource->cd_hab_lit,$resource->tabela]: " . $ex->getMessage();
            }

            if ($msg == '') {
                if (count($result) > 0) {
                    foreach($result as $row) {
                        $txt = $row['DT_INI'];
                        if ($row['DT_FIM']) {
                            $txt .= ' ~ ' . $row['DT_FIM'];                        
                        }
                        $msg = str_replace('{0}' , $txt, $msg_time_overlap);
                        break;
                    }
                }
            }
        }

        // Fase 2: valida cruzamento de registo detetando sobreposições na respetiva tabela de registos em workflow
        if ($msg == '') {
            $query = "SELECT TO_CHAR(DT_INI,'YYYY-MM-DD') DT_INI, COALESCE(TO_CHAR(DT_FIM,'YYYY-MM-DD'),'2999-01-01') DT_FIM ".
                     "FROM RH_ID_HABS_PROFISSIONAIS_WKF ".
                     "WHERE RHID = :RHID_ ".
                     "  AND EMPRESA = :EMPRESA_ ".
                     "  AND CD_HAB_PROF = :CD_HAB_PROF_ ".
                     "  AND DT_INI_HAB_PROF = :DT_INI_HAB_PROF_ ";

            # cruzamentos
            /*
                    REGISTO:        X------------------------X
                            *-----------------*                                         (1)
                                            *----------------------------*              (2)
                           *-------------------------------------------------*		(3)
                                        *----------*                                    (4)
            */
            $query .= " AND (".     ## CASO 1
                      " (:DT_INI_VAL <= TO_CHAR(DT_INI,'YYYY-MM-DD') AND ".
                      "  :DT_FIM_VAL BETWEEN TO_CHAR(DT_INI,'YYYY-MM-DD') AND NVL(TO_CHAR(DT_FIM,'YYYY-MM-DD'),'2999-01-01') ".
                      " ) OR ".     ## CASO 2
                      " (:DT_INI_VAL BETWEEN TO_CHAR(DT_INI,'YYYY-MM-DD') AND NVL(TO_CHAR(DT_FIM,'YYYY-MM-DD'),'2999-01-01') AND ".
                      "  :DT_FIM_VAL >= NVL(TO_CHAR(DT_FIM,'YYYY-MM-DD'),'2999-01-01') ".
                      " ) OR ".     ## CASO 3
                      " (:DT_INI_VAL <= TO_CHAR(DT_INI,'YYYY-MM-DD') AND  ".
                      "  :DT_FIM_VAL >= NVL(TO_CHAR(DT_FIM,'YYYY-MM-DD'),'2999-01-01') ".
                      " ) OR ".     ## CASO 4
                      " (:DT_INI_VAL >= TO_CHAR(DT_INI,'YYYY-MM-DD') AND ".
                      "  :DT_FIM_VAL <= NVL(TO_CHAR(DT_FIM,'YYYY-MM-DD'),'2999-01-01') ".
                      " ) ".
                      ") ";

            # excluir o próprio registo
            if ($resource->acao == 'UPDATE') {
                $query .= "  AND DT_INI != :DT_INI_VAL ";
            }
/*
$out = $query;
$out = str_replace(':RHID_', $resource->rhid,$out);
$out = str_replace(':CD_DOC_ID_', "'".$resource->cd_doc_id."'",$out);
$out = str_replace(':DT_INI_VAL', "'".$resource->dt_emissao."'",$out);
$out = str_replace(':DT_FIM_VAL', "'".$resource->dt_validade."'",$out);
$out = str_replace(':SEQ_', "'".$resource->seq."'",$out);
$out = str_replace(':CD_AGREGADO_', "'".$resource->cd_agregado."'",$out);
echo $out;
*/
            try {
                $stmt = $db->prepare($query);
                $stmt->bindParam(':RHID_', $resource->rhid, PDO::PARAM_STR);
                $stmt->bindParam(':EMPRESA_', $resource->empresa, PDO::PARAM_STR);
                $stmt->bindParam(':CD_HAB_PROF_', $resource->cd_hab_prof, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_HAB_PROF_', $resource->dt_hab_prof, PDO::PARAM_STR);
                $stmt->bindParam(':DT_INI_VAL', $resource->dt_ini, PDO::PARAM_STR);
                $stmt->bindParam(':DT_FIM_VAL', $resource->dt_fim, PDO::PARAM_STR);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                    $msg = "valida_hab_profissionais #1[$resource->rhid,$resource->cd_hab_lit,$resource->tabela]: " . $ex->getMessage();
            }

            if ($msg == '') {
                if (count($result) > 0) {
                    foreach($result as $row) {
                        $txt = $row['DT_INI'];
                        if ($row['DT_FIM']) {
                            $txt .= ' ~ ' . $row['DT_FIM'];                        
                        }
                        $msg = str_replace('{0}' , $txt, $msg_time_overlap);
                        break;
                    }
                }
            }
        }
    }
    #$msg = "STOP[$msg]";
}

/*
 * Validações específicas da informação de empresa
 * 
     resource = {
        empresa: "DEMO",
        rhid: "355",
        dt_adm: "2019-03-01",
        cd_sit: "01"
        dt_sit: "2020-01-01"
    }
 * 
 */
function valida_info_empresas($resource, &$msg) {
    global $db, $error_change_sit_dt_sup, $ui_dt_resignation, $error_required;
    $db = $db;
  
    $msg = '';
    if ($resource->empresa != '' && $resource->rhid != '' && $resource->dt_adm != '') {

        # Na atualização da situação, valida se a data de situação é superior à anterior….
        # 
        if ($msg == '' && $resource->acao == 'UPDATE' && false) {
            $query = "SELECT * ".
                     "FROM RH_ID_EMPRESAS ".
                     "WHERE EMPRESA = :EMPRESA_ ".
                     "  AND RHID = :RHID_ ".
                     "  AND DT_ADMISSAO = :DT_ADM_ ";

            try {
                $stmt = $db->prepare($query);
                $stmt->bindParam(':EMPRESA_', $resource->empresa, PDO::PARAM_STR);
                $stmt->bindParam(':RHID_', $resource->rhid, PDO::PARAM_STR);
                $stmt->bindParam(':DT_ADM_', $resource->dt_adm, PDO::PARAM_STR);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                    $msg = "valida_info_empresas #1[$resource->empresa,$resource->rhid,$resource->dt_adm,$resource->tabela]: " . $ex->getMessage();
            }

            if ($msg == '') {
                # existiu mudança situação ?
                if ($resource->cd_sit != $result['CD_SITUACAO']) {
                    # a data de situação deverá ser superior à anterior
                    if ($resource->dt_sit <= $result['DT_SITUACAO']) {
                        $msg = $error_change_sit_dt_sup;
                    }
                }
            }
        }
        
        if ($msg == '') {
            $query = "SELECT * ".
                     "FROM RH_DEF_SITUACOES ".
                     "WHERE CD_SITUACAO = :CD_SIT_ ";

            try {
                $stmt = $db->prepare($query);
                $stmt->bindParam(':CD_SIT_', $resource->cd_sit, PDO::PARAM_STR);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                
                #if ($result['MOTIVO_SAIDA'] == 'S' && $resource->dt_demissao === '') {
                #    $msg = "$ui_dt_resignation: $error_required";
                #}
            } catch (Exception $ex) {
                    $msg = "valida_info_empresas #2[$resource->empresa,$resource->rhid,$resource->dt_adm,$resource->tabela]: " . $ex->getMessage();
            }
        }
    }
}

/*
 * Validações específicas da entidades de desconto de um colaborador
 * 
     resource = {
        empresa: "DEMO",
        rhid: "355",
        dt_adm: "2019-03-01",
        cd_ed: "1"
        cd_reg_desc: "N"
        activo : "S"
    }
 * 
 */
function valida_ents_desconto($resource, &$msg) {
    global $db, $error_same_ed_multiple_reg, $error_invalid_doc_nr, $ui_inscription_id, $error_required;
    $db = $db;
  
    $msg = '';
    if ($resource->empresa != '' && $resource->rhid != '' && $resource->dt_adm != '' && 
        $resource->cd_ed != '' && $resource->cd_reg_desc != '') {

        # validar número de inscrição introduzido
        if ($msg == '') {
            # obtêm informação de contexto
            $query = "SELECT A.CD_GRUPO_ED, B.CD_PAIS_NACIONALIDADE ".
                     "FROM RH_DEF_ENTIDADES_DESCONTO A, RH_IDENTIFICACOES B ".
                     "WHERE A.CD_ED = :CD_ED_ ".
                     "  AND B.RHID = :RHID_ ";
            try {
                $stmt = $db->prepare($query);
                $stmt->bindParam(':RHID_', $resource->rhid, PDO::PARAM_STR);
                $stmt->bindParam(':CD_ED_', $resource->cd_ed, PDO::PARAM_STR);
                $stmt->execute();
                $param = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if ($resource->nr_inscricao == '') {
                    $msg = "$ui_inscription_id: $error_required";
                }
                
                if ($msg == '' && ($param['CD_PAIS_NACIONALIDADE'] == '' || $param['CD_PAIS_NACIONALIDADE'] === 'PT')) {

                    if ($param['CD_GRUPO_ED'] == 'IRS') { # NIF
                        if (!validateNIF_PT($resource->nr_inscricao)) {
                            $msg = $error_invalid_doc_nr;
                        }
                    }
                    elseif ($param['CD_GRUPO_ED'] == 'SS') { # NISS
                        if (!validateNISS_PT($resource->nr_inscricao)) {
                            $msg = $error_invalid_doc_nr;
                        }
                    }
                }
            } catch (Exception $ex) {
                    $msg = "valida_ents_desconto #1[$resource->empresa,$resource->rhid,$resource->dt_adm,$resource->tabela]: " . $ex->getMessage();
            }
        }
        
        # Impedir registar dois regimes distintos ativos para a mesma entidade desconto
        if ($msg == '' && $resource->activo == 'S') {

            # contagem
            $query = "SELECT COUNT(*) CNT ".
                     "FROM RH_ID_ENTS_DESCONTO A ".
                     "WHERE A.CD_ED = :CD_ED_ ".
                     "  AND A.RHID = :RHID_ ".
                     "  AND A.ACTIVO = 'S' ";
            
            if ($resource->acao == 'UPDATE') {
                $query .= "  AND A.CD_REG_DESC != :CD_REG_DESC_ ";
            }

            $query .= "UNION ".
                      "SELECT COUNT(*) CNT ".
                      "FROM RH_ID_ENTS_DESCONTO_WKF B ".
                      "WHERE B.CD_ED = :CD_ED_ ".
                      "  AND B.RHID = :RHID_ ".
                      "  AND B.ACTIVO = 'S' ".
                      "  AND B.FINISHED = 'N' ".
                      "  AND B.REJECTED = 'N' ";
            
            if ($resource->acao == 'UPDATE') {
                $query .= "  AND B.CD_REG_DESC != :CD_REG_DESC_ ";
            }

            try {
                $stmt = $db->prepare($query);
                $stmt->bindParam(':RHID_', $resource->rhid, PDO::PARAM_STR);
                $stmt->bindParam(':CD_ED_', $resource->cd_ed, PDO::PARAM_STR);
                if ($resource->acao == 'UPDATE') {
                    $stmt->bindParam(':CD_REG_DESC_', $resource->cd_reg_desc, PDO::PARAM_STR);
                }
                $stmt->execute();
                $cnt = 0;
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $cnt = $cnt + $row['CNT'];
                }
                
                if ($cnt > 0) {
                    $msg = $error_same_ed_multiple_reg;
                }
            } catch (Exception $ex) {
                    $msg = "valida_ents_desconto #2[$resource->empresa,$resource->rhid,$resource->dt_adm,$resource->tabela]: " . $ex->getMessage();
            }            
        }
    }
}

/*
 * Validações específicas da grelhas salariais de um colaborador
 * 
     resource = {
        empresa: "DEMO",
        rhid: "355",
        dt_adm: "2019-03-01",
        cd_grelha_salarial: "1"
        cd_linha_salarial: "1"
        dt_ini: "2020-01"
        dt_fim: "2020-02"
    }
 * 
 */
function valida_grelhas_salariais($resource, &$msg) {
    global $db, $error_invalid_op_record_before_proc_month;
    $db = $db;
  
    $msg = '';
    if ($resource->empresa != '' && $resource->rhid != '' && $resource->dt_adm != '' && 
        $resource->cd_grelha_salarial != '' && $resource->cd_linha_salarial != '') {
        
        # mês em processamento
        $mes_proc = getAnoMesProcessamento($resource->empresa, $msg);
        $ano_mes_proc = $mes_proc['ANO']."-".str_pad($mes_proc['MES'],2,'0',STR_PAD_LEFT);
#$msg =  "mes procesamento mes proc:".$ano_mes_proc;

        # impedir atualização de grelhas com datas anterior ao mês corrente
        if ($msg == '') {
            if ($resource->acao === 'INSERT') {
                if ($resource->dt_ini < $ano_mes_proc) {
                    $msg = str_replace("{0}",$ano_mes_proc,$error_invalid_op_record_before_proc_month);
                }
            } 
            elseif ($resource->acao === 'UPDATE') {
                
                if ($resource->dt_fim != '' && $resource->dt_fim < $ano_mes_proc && $msg == '') {
                    $msg = str_replace("{0}",$ano_mes_proc,$error_invalid_op_record_before_proc_month);
                }
                
                $query = "SELECT A.*, B.VALOR ".
                         "FROM RH_ID_REMUNERACOES A ".
                         "  LEFT JOIN RH_GRELHA_VALORES B ON B.CD_GRELHA_SALARIAL = A.CD_GRELHA_SALARIAL AND B.CD_LINHA_SALARIAL = A.CD_LINHA_SALARIAL ".
                         "WHERE A.EMPRESA = :EMPRESA_ ".
                         "  AND A.RHID = :RHID_ ".
                         "  AND A.DT_ADMISSAO = :DT_ADM_ ".
                         "  AND A.CD_GRELHA_SALARIAL = :CD_GRELHA_ ".
                         "  AND A.CD_LINHA_SALARIAL = :CD_LINHA_ ".
                         "  AND A.DT_INICIO = :DT_INI_ ";
                try {
                    $stmt = $db->prepare($query);
                    $stmt->bindParam(':EMPRESA_', $resource->empresa, PDO::PARAM_STR);
                    $stmt->bindParam(':RHID_', $resource->rhid, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_ADM_', $resource->dt_adm, PDO::PARAM_STR);
                    $stmt->bindParam(':CD_GRELHA_', $resource->cd_grelha_salarial, PDO::PARAM_STR);
                    $stmt->bindParam(':CD_LINHA_', $resource->cd_linha_salarial, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_INI_', $resource->dt_ini, PDO::PARAM_STR);
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    if (($row['DT_FIM'] == '' || $row['DT_FIM'] !== $resource->dt_fim) && 
                         $resource->dt_fim !== '' && $resource->dt_fim < $ano_mes_proc && $msg == '') {
                        $msg = str_replace("{0}",$ano_mes_proc,$error_invalid_op_record_before_proc_month);
                    }

                    # se altero valor, só posso fazer se a data início >= ano/mês corrente
                    if ($msg == '') {
                        if ( ($resource->valor == '' && $row['VALOR'] != '') ||
                             ($resource->valor != '' && $row['VALOR'] == '') ||
                             ($resource->valor != $row['VALOR'])
                            ) {
                            if ($resource->dt_ini < $ano_mes_proc && $resource-> valor ) {
                                $msg = str_replace("{0}",$ano_mes_proc,$error_invalid_op_record_before_proc_month);
                            }
                        }
                    }
                    
                } catch (Exception $ex) {
                        $msg = "valida_grelhas_salariais #1[$resource->empresa,$resource->rhid,$resource->dt_adm,$resource->tabela]: " . $ex->getMessage();
                }            
            }
            elseif ($resource->acao === 'DELETE') {
                if ($resource->dt_ini < $ano_mes_proc) {
                    $msg = str_replace("{0}",$ano_mes_proc,$error_invalid_op_record_before_proc_month);
                }
            }
            
        }
        
#$msg =  "STOP[$msg]";
        
    }
}



#
# FUNÇÕES PRE e POST DML
#

/*
 * Procedimento de pre-DML na tabela RH_ID_REMUNERACOES
 * 
     resource = {
        cd_grelha_salarial: "1"
        cd_linha_salarial: "1"
    }
 * 
 */
function pre_operations_grelhas_salariais($db, $resource, &$msg) {
    
    $msg = '';
    $tp_grelha = '';
    
    if ($resource->operacao == 'INSERT') {
        
        if ($resource->cd_grelha_salarial != '' && $resource->cd_linha_salarial != '') {

            $query = "SELECT A.* ".
                     "FROM RH_DEF_GRELHAS_SALARIAIS A ".
                     "WHERE A.CD_GRELHA_SALARIAL = :CD_GRELHA_ ";
            try {
                $stmt = $db->prepare($query);
                $stmt->bindParam(':CD_GRELHA_', $resource->cd_grelha_salarial, PDO::PARAM_STR);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $tp_grelha = $row['TP_GRELHA_SALARIAL'];
            } catch (Exception $ex) {
                    $msg = "pre_operations_grelhas_salariais #1[$resource->cd_grelha_salarial,$resource->cd_linha_salarial]: " . $ex->getMessage();
            }            

            // grelha salarial individual --> verifica se existe linha criada, caso contrário cria grelha salarial
            if ($tp_grelha == 'B' && $msg == '') {

                $query = "INSERT IGNORE INTO RH_DEF_LINHAS_SALARIAIS ".
                         " (CD_GRELHA_SALARIAL,CD_LINHA_SALARIAL,DSP_LINHA_SALARIAL) ".
                         "SELECT ".$resource->cd_grelha_salarial.", RHID, NOME ".
                         "FROM RH_IDENTIFICACOES ".
                         "WHERE RHID = :RHID_ ";
                try {
                    $stmt = $db->prepare($query);
                    #$stmt->bindParam(':GRELHA_', $resource->cd_grelha_salarial, PDO::PARAM_STR);
                    $stmt->bindParam(':RHID_', $resource->cd_linha_salarial, PDO::PARAM_STR);
                    $stmt->execute();
                } catch (Exception $ex) {
                        $msg = "pre_operations_grelhas_salariais #2[$resource->cd_grelha_salarial,$resource->cd_linha_salarial]: " . $ex->getMessage();
                }            
            }
        }
    }
}


/*
 * Procedimento de post-DML na tabela RH_ID_REMUNERACOES
 * 
     resource = {
        cd_grelha_salarial: "1",
        cd_linha_salarial: "1",
        dt_ini: "2020-01",
        valor: "1000",
        dt_fim: ""
    }
 * 
 */
function post_operations_grelhas_salariais($db, $resource, &$msg) {
    
    $msg = '';
    $tp_grelha = '';
    $nulo = null;

    // tipo de grelha ? 
    if ($resource->cd_grelha_salarial != '' && $msg == '') {
        $query = "SELECT A.* ".
                 "FROM RH_DEF_GRELHAS_SALARIAIS A ".
                 "WHERE A.CD_GRELHA_SALARIAL = :CD_GRELHA_ ";
        try {
            
            $stmt = $db->prepare($query);
            $stmt->bindParam(':CD_GRELHA_', $resource->cd_grelha_salarial, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $tp_grelha = $row['TP_GRELHA_SALARIAL'];
            
        } catch (Exception $ex) {
                $msg = "post_operations_grelhas_salariais #1[$resource->cd_grelha_salarial,$resource->cd_linha_salarial]: " . $ex->getMessage();
        }            
    }
    
    if ($resource->operacao == 'INSERT' && $msg == '') {
        if ($resource->cd_grelha_salarial != '' && $resource->cd_linha_salarial != '' && 
            $resource->dt_ini != '' && $resource->valor != '' && $tp_grelha != '') {
            // grelha salarial individual --> verifica se existe valor criado, caso contrário cria valor para a grelha salarial
            if ($tp_grelha == 'B') {

                $query = "INSERT IGNORE INTO RH_DEF_VALORES_SALARIAIS ".
                         " (CD_GRELHA_SALARIAL, CD_LINHA_SALARIAL, DT_VALOR, VALOR, DT_INACTIVO) ".
                         "VALUES (:CD_GRELHA_SALARIAL_, :CD_LINHA_SALARIAL_, :DT_VALOR_, :VALOR_, :DT_INACTIVO_) ".
                         "ON DUPLICATE KEY UPDATE ".
                         " VALOR = :VALOR_ ".
                         ",DT_INACTIVO = :DT_INACTIVO_ ";
                try {
                    $stmt = $db->prepare($query);
                    $stmt->bindParam(':CD_GRELHA_SALARIAL_', $resource->cd_grelha_salarial, PDO::PARAM_STR);
                    $stmt->bindParam(':CD_LINHA_SALARIAL_', $resource->cd_linha_salarial, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_VALOR_', $resource->dt_ini, PDO::PARAM_STR);
                    $stmt->bindParam(':VALOR_', $resource->valor, PDO::PARAM_STR);
                    if ($resource->dt_fim != '') {
                        $stmt->bindParam(':DT_INACTIVO_', $resource->dt_fim, PDO::PARAM_STR);
                    }
                    else {
                        $stmt->bindParam(':DT_INACTIVO_', $nulo, PDO::PARAM_NULL);
                    }
                    $stmt->execute();
                } catch (Exception $ex) {
                        $msg = "post_operations_grelhas_salariais #2[$resource->cd_grelha_salarial,$resource->cd_linha_salarial]: " . $ex->getMessage();
                }            
            }
        }
    }
    elseif ($resource->operacao == 'UPDATE' && $msg == '') {
        // se é grelha salarial INDIVIDUAL, e TENTAR ATUALIZAR VALOR
        //
        // tentar abrir/fechar valor de grelha em consonancia com a linha em RH_ID_REMUNERACOES
        // DT_FIM  --> UPDATE RH_DEF_VALORES_SALARIAL SET DT_INACTIVO = DT_FIM WHERE DT_VALOR = DT_INI
        if ($resource->cd_grelha_salarial != '' && $resource->cd_linha_salarial != '' && 
            $resource->dt_ini != '' && $resource->valor != '' && $tp_grelha != '') {
            // grelha salarial individual --> verifica se existe valor criado, atualiazndo-o
            if ($tp_grelha == 'B') {

                $query = "UPDATE RH_DEF_VALORES_SALARIAIS ".
                         "SET VALOR = :VALOR_ ".
                         "   ,DT_INACTIVO = :DT_INACTIVO_ ".
                         "WHERE CD_GRELHA_SALARIAL = :CD_GRELHA_SALARIAL_ ".
                         "  AND CD_LINHA_SALARIAL = :CD_LINHA_SALARIAL_ ".
                         "  AND DT_VALOR = :DT_VALOR_ ";
                try {
                    $stmt = $db->prepare($query);
                    $stmt->bindParam(':CD_GRELHA_SALARIAL_', $resource->cd_grelha_salarial, PDO::PARAM_STR);
                    $stmt->bindParam(':CD_LINHA_SALARIAL_', $resource->cd_linha_salarial, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_VALOR_', $resource->dt_ini, PDO::PARAM_STR);
                    $stmt->bindParam(':VALOR_', $resource->valor, PDO::PARAM_STR);
                    if ($resource->dt_fim != '') {
                        $stmt->bindParam(':DT_INACTIVO_', $resource->dt_fim, PDO::PARAM_STR);
                    }
                    else {
                        $stmt->bindParam(':DT_INACTIVO_', $nulo, PDO::PARAM_NULL);
                    }
                    $stmt->execute();
                } catch (Exception $ex) {
                        $msg = "post_operations_grelhas_salariais #3[$resource->cd_grelha_salarial,$resource->cd_linha_salarial]: " . $ex->getMessage();
                }            
            }
        }
    }
    elseif ($resource->operacao == 'DELETE' && $msg == '') {
        if ($resource->cd_grelha_salarial != '' && $resource->cd_linha_salarial != '' && 
            $resource->dt_ini != '' && $tp_grelha != '') {
            // grelha salarial individual --> verifica se existe linha criada, caso contrário cria grelha salarial
            if ($tp_grelha == 'B') {
                $query = "DELETE FROM RH_DEF_VALORES_SALARIAIS ".
                         "WHERE CD_GRELHA_SALARIAL = :CD_GRELHA_SALARIAL_ ".
                         "  AND CD_LINHA_SALARIAL = :CD_LINHA_SALARIAL_ ".
                         "  AND DT_VALOR = :DT_VALOR_ ";
                try {
                    $stmt = $db->prepare($query);
                    $stmt->bindParam(':CD_GRELHA_SALARIAL_', $resource->cd_grelha_salarial, PDO::PARAM_STR);
                    $stmt->bindParam(':CD_LINHA_SALARIAL_', $resource->cd_linha_salarial, PDO::PARAM_STR);
                    $stmt->bindParam(':DT_VALOR_', $resource->dt_ini, PDO::PARAM_STR);
                    $stmt->execute();
                } catch (Exception $ex) {
                        $msg = "post_operations_grelhas_salariais #4[$resource->cd_grelha_salarial,$resource->cd_linha_salarial]: " . $ex->getMessage();
                }            
            }
        }
    }

}



/*
 * Procedimento de post-DML na tabela RH_ID_PROFISSIONAIS
 * 
     resource = {
        empresa: "DEMO",
        rhid: "1"
        dt_adm: "2020-01-01",
        cd_irct: "1000",
        dt_eficacia: "1900-01-01"
    }
 * 
 */
function pre_operations_info_retrib($db, $resource, &$msg) {
    
    $msg = '';
    if ($resource->empresa != '' && $resource->rhid != '' && $resource->dt_adm != '') {

        # ativação/inativação entidade de IRS
        if ($resource->operacao == 'UPDATE' || $resource->operacao == 'DELETE') {

            # se já houve atribuída uma regra de adaptabilidade para este colaborador,
            # remove ou inativa a regra de adaptabilidade
            if ($resource->operacao == 'UPDATE') {

                if (isset($resource->tp_irs) && $msg == '') {
                    $sql = "SELECT TP_IRS ".
                           "FROM RH_ID_RETRIBUTIVOS ".
                           "WHERE EMPRESA = :EMPRESA_ ".
                           "  AND RHID = :RHID_ ".
                           "  AND DT_ADMISSAO = :DT_ADMISSAO_ ";
                    try {
                        $stmt = $db->prepare($sql);
                        $stmt->bindParam(':EMPRESA_', $resource->empresa, PDO::PARAM_STR);
                        $stmt->bindParam(':RHID_', $resource->rhid, PDO::PARAM_STR);
                        $stmt->bindParam(':DT_ADMISSAO_', $resource->dt_adm, PDO::PARAM_STR);
                        $stmt->execute();
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    } catch (Exception $ex) {
                        $msg = "pre_operations_info_retrib #1[$resource->empresa,$resource->rhid,$resource->dt_adm]: " . $ex->getMessage();
                    }    
                    # remoção do IRCT
                    if ($row['TP_IRS'] != $resource->tp_irs && $msg == '') {
                        $resource->acao = 'INATIVAR';
                        $resource->entidade = 'IRS';
                        $resource->tp_irs = $row['TP_IRS'];
                        ent_desconto_por_defeito($db, $resource, $msg);
#$msg = "ent desc:$msg]";
                    }
                }
            } 
            elseif ($resource->operacao == 'DELETE' && $msg == '') {
                $resource->acao = 'INATIVAR';
                $resource->entidade = 'IRS';
                ent_desconto_por_defeito($db, $resource, $msg);
            }
        } 
    }
    
#    $msg = "STOP [$msg]";
}

/*
 * Procedimento de post-DML na tabela RH_ID_PROFISSIONAIS
 * 
     resource = {
        empresa: "DEMO",
        rhid: "1"
        dt_adm: "2020-01-01",
        cd_irct: "1000",
        dt_eficacia: "1900-01-01"
    }
 * 
 */
function post_operations_info_retrib($db, $resource, &$msg) {
    
    $msg = '';
    if ($resource->empresa != '' && $resource->rhid != '' && $resource->dt_adm != '') {
        # ativação/inativação entidade de IRS
        if ($msg == '') {
            if ($resource->operacao == 'INSERT' || $resource->operacao == 'UPDATE') {
                $resource->acao = 'ATIVAR';
                $resource->entidade = 'IRS';
                ent_desconto_por_defeito($db, $resource, $msg);
            } 
        } 
    }
}


/*
 * Procedimento de post-DML na tabela RH_ID_PROFISSIONAIS
 * 
     resource = {
        empresa: "DEMO",
        rhid: "1"
        dt_adm: "2020-01-01",
        cd_irct: "1000",
        dt_eficacia: "1900-01-01"
    }
 * 
 */
function pre_operations_info_prof($db, $resource, &$msg) {
    
    $msg = '';
    if ($resource->empresa != '' && $resource->rhid != '' && $resource->dt_adm != '') {

        # gestão da regra de adaptabilidade
        if ($resource->operacao == 'UPDATE' || $resource->operacao == 'DELETE') {

            # se já houve atribuída uma regra de adaptabilidade para este colaborador,
            # remove ou inativa a regra de adaptabilidade
            if ($resource->operacao == 'UPDATE') {
                if ($resource->cd_irct == '' && $resource->dt_eficacia == '' && $msg == '') {

                    $sql = "SELECT CD_IRCT, DT_EFICACIA ".
                           "FROM RH_ID_PROFISSIONAIS ".
                           "WHERE EMPRESA = :EMPRESA_ ".
                           "  AND RHID = :RHID_ ".
                           "  AND DT_ADMISSAO = :DT_ADMISSAO_ ";
                    try {
                        $stmt = $db->prepare($sql);
                        $stmt->bindParam(':EMPRESA_', $resource->empresa, PDO::PARAM_STR);
                        $stmt->bindParam(':RHID_', $resource->rhid, PDO::PARAM_STR);
                        $stmt->bindParam(':DT_ADMISSAO_', $resource->dt_adm, PDO::PARAM_STR);
                        $stmt->execute();
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    } catch (Exception $ex) {
                        $msg = "pre_operations_info_prof #1[$resource->empresa,$resource->rhid,$resource->dt_adm]: " . $ex->getMessage();
                    }            
                    # remoção do IRCT
                    if ($row['CD_IRCT'] != '' && $row['DT_EFICACIA'] != '' && $msg == '') {
                        $resource->acao = 'INATIVAR';
                        gere_regra_adapt($db, $resource, $msg);
                    }
                }
            } 
            elseif ($resource->operacao == 'DELETE' && $msg == '') {
                $resource->acao = 'INATIVAR';
                gere_regra_adapt($db, $resource, $msg);
            }
        } 
    }
}

/*
 * Procedimento de post-DML na tabela RH_ID_PROFISSIONAIS
 * 
     resource = {
        empresa: "DEMO",
        rhid: "1"
        dt_adm: "2020-01-01",
        cd_irct: "1000",
        dt_eficacia: "1900-01-01"
    }
 * 
 */
function post_operations_info_prof($db, $resource, &$msg) {
    
    $msg = '';
    if ($resource->empresa != '' && $resource->rhid != '' && $resource->dt_adm != '') {
        # atribuição por defeito da regra de adaptabilidade
        if ($resource->cd_irct != '' && $resource->dt_eficacia != '' && $msg == '') {
            if ($resource->operacao == 'INSERT' || $resource->operacao == 'UPDATE') {
                $resource->acao = 'ATIVAR';
                gere_regra_adapt($db, $resource, $msg);
            } 
        } 
    }
}


